<?php
// +----------------------------------------------------------------------
// 首页控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class IndexController extends AuthController {
    function Index() {
        $this->checkLogin();
        View::Load();
    }
}
