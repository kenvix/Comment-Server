<?php
// +----------------------------------------------------------------------
// 默认控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class DefaultController extends AuthController {
    function Other() {
        $this->checkLogin();
        View::Load();
    }
}
