<?php

class View {

    private static $vars = array();

    /**
     * 加载视图
     * @param null $path 留空将自动加载
     * @param mixed ...$args 直接传递给视图的可选参数，在视图内通过 $args 数组获取
     * @throws FileInaccessibleException
     */
    public static function Load($path = null, ...$args) {
        $path = self::GetPath($path);
        $file = Root . "include/view/{$path}.php";
        if(file_exists($file)) {
            if(!empty(self::$vars['[G]'])) {
                extract(self::$vars['[G]'], EXTR_OVERWRITE);
                unset(self::$vars['[G]']);
            }
            if(!empty(self::$vars[$path])) {
                extract(self::$vars[$path], EXTR_OVERWRITE);
            }
            include $file;
        } else {
            throw new FileInaccessibleException('找不到或无法访问视图文件：' . $file);
        }
    }

    /**
     * 只获取视图即将输出的内容
     * @param null $path 留空将自动加载
     * @param mixed ...$args
     * @return string
     * @throws FileInaccessibleException
     */
    public static function Get($path = null, ...$args) {
        ob_start();
        self::Load($path, $args);
        return ob_get_clean();
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
        if(empty($path)) $path = ControllerName . "/" . Action;
        return $path;
    }
}