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
        if(!empty($_GET['callback'])) {
            echo strip_tags($_GET['callback']) . "({$result});";
        } else {
            echo $result;
        }
    } elseif(IsCli) {
        $result = "{$code}: {$text}";
        if(!empty($data)) print_r($data);
        echo $result;
    } else {
        try {
            View::Assign('text', str_replace('\r\n', '<br/>', $text));
            View::Assign('code', $code);
            View::Assign('data', $data);
            View::Load('Default/Message');
        } catch (Exception $ex) {
            echo "[$code]: $text";
        }
    }
    die($code);
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

/**
 * 只允许英文,数字以及有限的符号防止注入
 * @param $str
 * @return mixed
 */
function removeSpecialStr($str) {
    return str_replace(['"', "'"], '', $str);
}


/**
 * 验证邮箱格式是否正确
 * @param $mail
 * @return bool
 */
function checkEmail($mail) {
    if(preg_match('/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',$mail)) return true;
    else return false;
}

/**
 * 验证网址格式是否正确
 * @param $url
 * @return bool
 */
function checkURL($url) {
    if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
    =~_|]/i",$url)) return true;
    else return false;
}

/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @return void
 */
function redirect($url) {
    if (!headers_sent()) {
        header('Location: ' . $url);
        die(0);
    } else {
        $str    = "<meta http-equiv='Refresh' content='0;URL={$url}'>";
        echo $str;
        die(0);
    }
}

/**
 * URL组装
 * @param string $url URL表达式，格式：'[控制器/操作#锚点@域名]?参数1=值1&参数2=值2...'
 * @param string|array $vars 传入的参数，支持数组和字符串
 * @param bool $domain 是否在URL中添加域名
 * @return string
 */
function U($url = '', $vars = [] , $domain = false) {
    $controller = Controller;
    $action     = Action;
    // 解析URL
    $info   =  parse_url($url);
    if(isset($info['path'])) {
        $u = explode('/', $info['path']);
        if (isset($u[0]) && isset($u[1])) {
            $controller = $u[0];
            $action = $u[1];
        } elseif (isset($u[0]) && !isset($u[1])) {
            $action = $u[0];
        }
    }
    if(isset($info['fragment'])) { // 解析锚点
        $anchor =   $info['fragment'];
        if(false !== strpos($anchor,'?')) { // 解析参数
            list($anchor,$info['query']) = explode('?',$anchor,2);
        }
        if(false !== strpos($anchor,'@')) { // 解析域名
            list($anchor,$host)    =   explode('@',$anchor, 2);
        }
    }elseif(false !== strpos($url,'@')) { // 解析域名
        list($url,$host)    =   explode('@',$info['path'], 2);
    }

    if(isset($host)) {
        $domain = $host.(strpos($host,'.')?'':strstr($_SERVER['HTTP_HOST'],'.'));
    }

    // 解析参数
    if(is_string($vars)) { // aaa=1&bbb=2 转换成数组
        parse_str($vars,$vars);
    }elseif(!is_array($vars)){
        $vars = array();
    }
    if(isset($info['query'])) { // 解析地址里面参数 合并到vars
        parse_str($info['query'],$params);
        $vars = array_merge($params,$vars);
    }

    $vars['c'] = $controller;
    $vars['a'] = $action;


    $url = 'index.php';
    if(!empty($vars)) {
        $vars   =   http_build_query($vars);
        $url   .=   '?'.$vars;
    }
    if(isset($anchor)){
        $url  .= '#'.$anchor;
    }
    if($domain) {
        $url   =  (isSSL() ? 'https://' : 'http://') . $domain . '/' . $url;
    }
    return $url;
}

/**
 * 判断是否SSL协议
 * @return boolean
 */
function isSSL() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return true;
    }
    return false;
}

/**
 * 生成Token，若为Ajax请求，将送出token头
 * @return string token
 */
function generateToken(){
    static $tokenName  = TokenName;
    static $tokenType  = TokenType;
    if(!isset($_SESSION[$tokenName])) {
        $_SESSION[$tokenName]  = array();
    }
    // 标识当前页面唯一性
    $tokenKey   =  md5($_SERVER['REQUEST_URI']);
    if(isset($_SESSION[$tokenName][$tokenKey])) {// 相同页面不重复生成session
        $tokenValue = $_SESSION[$tokenName][$tokenKey];
    }else{
        $tokenValue = is_callable($tokenType) ? $tokenType(microtime(true)) : md5(microtime(true));
        $_SESSION[$tokenName][$tokenKey]   =  $tokenValue;
        if(IsAjax)
            header($tokenName.': ' . $tokenKey.'_'.$tokenValue); //ajax需要获得这个header并替换页面中meta中的token值
    }
    return $tokenKey.'_'.$tokenValue;
}

/**
 * 快捷发送一封邮件
 * @author Kenvix
 * @source Tieba-Cloud-Sign Project
 * @param string $to 收件人
 * @param string $sub 邮件主题
 * @param string $msg 邮件内容(HTML)
 * @param array $att 附件，每个键为文件名称，值为附件内容（可以为二进制文件），例如array('a.txt' => 'abcd' , 'b.png' => file_get_contents('x.png'))
 * @return bool 成功:true 失败：错误消息. 使用 === true 确定是否成功
 */
function sendMail($to, $sub = '无主题', $msg = '无内容', $att = array()) {
    $From = EmailNoticeSenderMail;
    switch (EmailNoticeDriver) {
        case 'smtp':
            /*
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = EmailNoticeSMTPHost;
            $mail->Port = EmailNoticeSMTPPort;
            $mail->SMTPAuth = EmailNoticeSMTPAuth;
            if(EmailNoticeSMTPAuth) {
                $mail->Username = EmailNoticeSMTPAuthName;                 // SMTP username
                $mail->Password = EmailNoticeSMTPAuthPassword;                           // SMTP password
            }
            $mail->SMTPSecure = EmailNoticeSMTPEncryption;
            $mail->isHTML(true);
            $mail->setFrom(EmailNoticeSenderMail, EmailNoticeSenderName)
            */
            $mail = new SMTP(EmailNoticeSMTPHost, EmailNoticeSMTPPort, EmailNoticeSMTPAuth, EmailNoticeSMTPAuthName, EmailNoticeSMTPAuthPassword, EmailNoticeSMTPEncryption);
            $mail->att = $att;
            $mail->sleep = EmailNoticeSMTPSleep;
            if ($mail->send($to, $From, $sub, $msg, EmailNoticeSenderName)) {
                return true;
            } else {
                return $mail->log;
            }
            break;

        default:
            $header  = "MIME-Version:1.0\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header .= "To: " . $to . "\r\n";
            $header .= "From: " . $From . "\r\n";
            $header .= "Subject: " . $sub . "\r\n";
            $header .= 'Reply-To: ' . $From . "\r\n";
            $header .= "Date: " . date("r") . "\r\n";
            $header .= "Content-Transfer-Encoding: base64\r\n";
            return mail(
                $to,
                $sub,
                base64_encode($msg),
                $header
            );
            break;
    }
}

/**
 * URL是否可以信任
 * @param $url
 * @return bool
 */
function isURLTrusted($url) {
    $data = parse_url($url);
    if(!empty($data['host'])) {
        $data['host'] = strtolower($data['host']);
        if((empty($data['port']) && in_array($data['host'], Option::getTrustedDomain())) || (!empty($data['port']) && in_array($data['host'] . ':' . $data['port'], Option::getTrustedDomain()))) {
            return true;
        }
    }
    return false;
}


/**
 * 获取指定邮箱的的Gravatar头像URL
 * http://en.gravatar.com/site/implement/images/
 * @param        $email
 * @param int    $s
 * @param string $d
 * @param string $g
 * @param string $site
 * @return string
 */
function getGravatarURL($email, $s = 140, $d = 'mm', $g = 'g', $site = 'secure') {
    $hash = md5($email);
    if($site == 'secure') {
        return "https://secure.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
    } else {
        return "//{$site}.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
    }
}