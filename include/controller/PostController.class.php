<?php
// +----------------------------------------------------------------------
// 文章控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class PostController extends BaseController {
    function Add() {
        $title = I('get.title');
        if(empty($title)) msg('文章标题不能为空',110);

    }
}
