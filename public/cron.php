<?php
// +----------------------------------------------------------------------
// 计划任务快捷入口
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

require '../init.php';

(new Application())->SetController('Cron')->Run();