<?php
// +----------------------------------------------------------------------
// 类库
// +----------------------------------------------------------------------
// Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

/**
 * 获取输入参数 支持过滤和默认值
 * 使用方法:
 * <code>
 * I('id',0); 获取id参数 自动判断get或者post
 * I('post.name','','htmlspecialchars'); 获取$_POST['name']
 * I('get.'); 获取$_GET
 * </code>
 * @param string $name 变量的名称 支持指定类型
 * @param mixed $default 不存在的时候默认值
 * @param mixed $filter 参数过滤方法
 * @param mixed $datas 要获取的额外数据源
 * @return mixed
 */
function I($name,$default='',$filter=null,$datas=null) {
    static $_PUT	=	null;
    if(strpos($name,'/')){ // 指定修饰符
        list($name,$type) 	=	explode('/',$name,2);
    }elseif(VarAutoString){ // 默认强制转换为字符串
        $type   =   's';
    }
    if(strpos($name,'.')) { // 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ // 默认为自动判断
        $method =   'param';
    }
    switch(strtolower($method)) {
        case 'get'     :
            $input =& $_GET;
            break;
        case 'post'    :
            $input =& $_POST;
            break;
        case 'put'     :
            if(is_null($_PUT)){
                parse_str(file_get_contents('php://input'), $_PUT);
            }
            $input 	=	$_PUT;
            break;
        case 'param'   :
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input  =  $_POST;
                    break;
                case 'PUT':
                    if(is_null($_PUT)){
                        parse_str(file_get_contents('php://input'), $_PUT);
                    }
                    $input 	=	$_PUT;
                    break;
                default:
                    $input  =  $_GET;
            }
            break;
        case 'request' :
            $input =& $_REQUEST;
            break;
        case 'session' :
            $input =& $_SESSION;
            break;
        case 'cookie'  :
            $input =& $_COOKIE;
            break;
        case 'server'  :
            $input =& $_SERVER;
            break;
        case 'globals' :
            $input =& $GLOBALS;
            break;
        case 'data'    :
            $input =& $datas;
            break;
        default:
            return null;
    }
    if(''==$name) { // 获取全部变量
        $data       =   $input;
        $filters    =   isset($filter)?$filter:DefuaultFilter;
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); // 参数过滤
            }
        }
    }elseif(isset($input[$name])) { // 取值操作
        $data       =   $input[$name];
        $filters    =   isset($filter)?$filter:DefuaultFilter;
        if($filters) {
            if(is_string($filters)){
                if(0 === strpos($filters,'/')){
                    if(1 !== preg_match($filters,(string)$data)){
                        // 支持正则验证
                        return   isset($default) ? $default : null;
                    }
                }else{
                    $filters    =   explode(',',$filters);
                }
            }elseif(is_int($filters)){
                $filters    =   array($filters);
            }

            if(is_array($filters)){
                foreach($filters as $filter){
                    if(function_exists($filter)) {
                        $data   =   is_array($data) ? array_map_recursive($filter,$data) : $filter($data); // 参数过滤
                    }else{
                        $data   =   filter_var($data,is_int($filter) ? $filter : filter_id($filter));
                        if(false === $data) {
                            return   isset($default) ? $default : null;
                        }
                    }
                }
            }
        }
        if(!empty($type)){
            switch(strtolower($type)){
                case 'a':	// 数组
                    $data 	=	(array)$data;
                    break;
                case 'd':	// 数字
                    $data 	=	(int)$data;
                    break;
                case 'f':	// 浮点
                    $data 	=	(float)$data;
                    break;
                case 'b':	// 布尔
                    $data 	=	(boolean)$data;
                    break;
                case 's':   // 字符串
                default:
                    $data   =   (string)$data;
            }
        }
    }else{ // 变量默认值
        $data       =    isset($default)?$default:null;
    }
    is_array($data) && array_walk_recursive($data,'think_filter');
    return $data;
}

function array_map_recursive($filter, $data) {
    $result = array();
    foreach ($data as $key => $val) {
        $result[$key] = is_array($val)
            ? array_map_recursive($filter, $val)
            : call_user_func($filter, $val);
    }
    return $result;
}

/**
 * 显示一条消息并退出，CLI模式将同时返回相应退出码
 * @param string  $text 文本
 * @param int     $code 错误代码，0为无错误
 * @param array   $data 额外数据
 */
function msg($text , $code = 0 , $data = array()) {
    if(IsAjax) {
        $result = json_encode(array(
            'code' => $code,
            'text' => $text,
            'data' => $data
        ));
    } elseif(IsCli) {
        $result = "{$code}: {$text}";
        if(!empty($data)) print_r($data);
    } else {
        view('Default/Message');
    }
    echo $result;
    die($code);
}

/**
 * 加载视图
 * @param null $path 留空将自动加载
 * @throws FileInaccessibleException
 */
function view($path = null) {
    global $controller;
    global $action;
    if(empty($name)) $path = "{$controller}/{$action}";
    $file = Root . "include/view/{$path}.php";
    if(file_exists($file)) {
        include $file;
    } else {
        throw new FileInaccessibleException('找不到或无法访问视图文件：' . $file);
    }
}

/**
 * 获取错误类型
 * @param int $errno 错误代码
 * @return string 错误类型
 */
function getErrorType($errno) {
    switch ($errno) {
        case E_ERROR:               case E_USER_ERROR:      $errnoo = '致命错误';                  break;
        case E_WARNING:             case E_USER_WARNING:    $errnoo = '警告';                      break;
        case E_PARSE:                                       $errnoo = '解析错误';                  break;
        case E_NOTICE:              case E_USER_NOTICE:     $errnoo = '提示';                      break;
        case E_CORE_ERROR:                                  $errnoo = '核心错误';                  break;
        case E_CORE_WARNING:                                $errnoo = '核心警告';                  break;
        case E_COMPILE_ERROR:                               $errnoo = '编译错误';                  break;
        case E_COMPILE_WARNING:                             $errnoo = '编译警告';                  break;
        case E_STRICT:                                      $errnoo = '严谨性提示';                break;
        default:                                            $errnoo = '未知错误 [ #'.$errno.' ]';  break;
    }
    return $errnoo;
}