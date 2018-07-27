<?php
// +----------------------------------------------------------------------
// Adminer代理程序
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

if(!session_start()) die('to use adminer tool, the server must support PHP Session');
require "../config/site.php";
require "../config/database.php";
require '../vendor/autoload.php';

if(empty($_SESSION['ADMINER_PW'])) die('AErr0');
define('ADMINER_PW', $_SESSION['ADMINER_PW']);
if(empty($_COOKIE['commentserver_pass']) || (new \Adbar\Encrypter(AdminLoginEncryptKey))->decrypt($_COOKIE['commentserver_pass']) != AdminPassword) die('AErr2');
if(ADMINER_PW != hash('sha512', $_COOKIE['commentserver_pass'] . $_SERVER['DOCUMENT_ROOT'] . $_SERVER['SERVER_NAME'])) die('AErr1');

if(DBType == 'mysql') {
    ini_set("mysql.default_host", DBHost);
    ini_set("mysql.default_user", DBUser);
    ini_set("mysql.default_pw", DBPassword);
    ini_set("mysql.default_port", DBPort);
    ini_set("mysqli.default_host", DBHost);
    ini_set("mysqli.default_user", DBUser);
    ini_set("mysqli.default_pw", DBPassword);
    ini_set("mysqli.default_port", DBPort);
} elseif(DBType == 'sqlite') {

}

require "../include/library/adminer.php";