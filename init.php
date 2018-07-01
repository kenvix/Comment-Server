<?php
// +----------------------------------------------------------------------
// 初始化
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

define('Root', dirname(__FILE__ ) . '/');
define('IsCli', (defined('FlagCliMode') || PHP_SAPI == "cli") ? true : false);
define('IsAjax', (isset($_GET['ajax']) || (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest")) ? true : false);

require 'config/advanced.php';
require 'config/database.php';
require 'config/site.php';

error_reporting(ErrorReportLevel);
spl_autoload_register(function ($class){
    if(strlen($class) > 5 && substr($class, -5) == 'Model') $folder = 'model';
    elseif(strlen($class) > 9 && substr($class, -9) == 'Exception') $folder = 'library/class/exception';
    elseif(strlen($class) > 10 && substr($class, -10) == 'Controller') $folder = 'controller';
    else $folder = 'library/class';
    $path = Root . "include/{$folder}/{$class}.class.php";
    if(file_exists($path)) include $path;
});

if(!file_exists('vendor/autoload.php')) {
    echo 'Composer 未初始化，请先安装Composer并在此目录运行 composer install';
    die(255);
}
require 'vendor/autoload.php';
require 'include/library/function.php';

set_exception_handler(function ($ex) {
    if(!IsCli && !IsAjax) {
        View::Assign('ex', $ex);
        View::Load('Default/Exception');
        die($ex->getCode());
    } else {
        msg('发生异常：' . $ex->getMessage(), $ex->getCode());
    }
});