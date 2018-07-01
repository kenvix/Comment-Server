<?php

class View {

    private static $vars = array();

    /**
     * 加载视图
     * @param null $path 留空将自动加载
     * @param bool $guess 是否允许使用推断赋值（用完会销毁）
     * @throws FileInaccessibleException
     */
    public static function Load($path = null, $guess = true) {
        $path = self::GetPath($path);
        $file = Root . "include/view/{$path}.php";
        if(file_exists($file)) {
            if(!empty(self::$vars[$path])) {
                extract(self::$vars[$path], EXTR_OVERWRITE);
            }
            if($guess && !empty(self::$vars['[G]'])) {
                extract(self::$vars['[G]'], EXTR_OVERWRITE);
                unset(self::$vars['[G]']);
            }
            include $file;
        } else {
            throw new FileInaccessibleException('找不到或无法访问视图文件：' . $file);
        }
    }

    /**
     * 视图变量赋值(推断)
     * @param mixed $name
     * @param mixed $value
     */
    public static function Assign($name, $value = ''){
        self::$vars['[G]'][$name] = $value;
    }

    /**
     * 视图变量赋值
     * @param mixed $name
     * @param mixed $value
     * @param mixed $path 留空将自动加载
     */
    public static function AssignByPath($name, $value = '', $path = ''){
        $path = self::GetPath($path);
        self::$vars[$path][$name] = $value;
    }

    private static function GetPath($path) {
        global $controller;
        global $action;
        if(empty($path)) $path = "{$controller}/{$action}";
        return $path;
    }
}