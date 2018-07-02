<?php
// +----------------------------------------------------------------------
// 管理控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class AdminController extends AuthController {
    public function CheckAkismetAPIKey() {
        $this->checkLogin();
        $akismet = new KAksimet();
        if($akismet->verifyKey()) msg('Akismet APIKey 有效');
        else msg('Akismet APIKey 无效');
    }
}