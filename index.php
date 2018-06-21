<?php
// +----------------------------------------------------------------------
// 入口
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------
require 'init.php';

$controller = I('get.c');
$action     = I('get.a');

if(empty($controller)) $controller = 'Default';
if(empty($action)) $action = 'Other';
else $controller = ucfirst($controller);
if(!file_exists("include/controller/{$controller}Controller.class.php")) $controller = 'Default';
$controllerClassName = "{$controller}Controller";

include "include/controller/{$controllerClassName}.class.php";
$instance = new $controllerClassName();
if(method_exists($instance, $action)) {
    $instance->$action();
} else {
    if(method_exists($instance, 'Other')) $instance->Other();
    else msg('没有这种操作！', 1);
}