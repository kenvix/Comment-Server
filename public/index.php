<?php
// +----------------------------------------------------------------------
// 入口
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------
require '../init.php';

(new Application())->SetDefaultController('Index')->SetDefaultAction('Index')->Run();