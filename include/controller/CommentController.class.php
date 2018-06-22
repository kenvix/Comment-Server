<?php
// +----------------------------------------------------------------------
// 评论控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class CommentController extends BaseController {
    function add() {
        $name    = I('post.name');
        $email   = I('post.email');
        $url     = I('post.url');
        $content = I('post.content');
        $ip      = GetIPMethod == 'none' ? '' : $_SERVER[GetIPMethod];
        if(empty($content) || empty($name)) msg('昵称和评论内容不能为空',100);
        if(!AllowEmptyEmail && empty($email)) msg('邮箱地址不能为空',100);
    }
}
