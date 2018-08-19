<?php
// +----------------------------------------------------------------------
// 初始化
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

define('Root', dirname(__FILE__ ) . DIRECTORY_SEPARATOR );

require 'include/library/class/Application.class.php';

(new Application())->SetupAll();