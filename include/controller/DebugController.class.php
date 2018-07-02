<?php
// +----------------------------------------------------------------------
// 仅供调试
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class DebugController extends AuthController {

    public function GetTables() {
        $this->checkLogin();
        $m = new BaseModel();
        print_r($m->query("SHOW TABLES;")->fetchAll());
    }

    public function GetPosts() {
        $this->checkLogin();
        $m = new BaseModel();
        print_r($m->execute()->fetchAll());
    }
}
