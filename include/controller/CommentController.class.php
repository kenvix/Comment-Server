<?php
// +----------------------------------------------------------------------
// 评论控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class CommentController extends BaseController {
    public function Add() {
        $name    = I('post.name');
        $email   = I('post.email');
        $url     = I('post.url');
        $content = I('post.content');
        $ip      = GetIPMethod == 'none' ? '' : $_SERVER[GetIPMethod];
        if(empty($content) || empty($name)) msg('昵称和评论内容不能为空',100);
        if(!AllowEmptyEmail && empty($email)) msg('邮箱地址不能为空',100);
        $m = new CommentModel();
        $m->add($postid, $pid, $name, $email, $url, $content, date('Y-m-d H:m:s'), $status, $ip, I('server.HTTP_USER_AGENT'));

    }

    public function Get() {
        $title = I('get.title');
        if(empty($title)) msg('文章标题不能为空',100);
        $PostModel = new PostModel();
        $postid = $PostModel->getPostID($title);
        if(empty($postid)) msg('指定的文章不存在', 121);
        $CommentModel = new CommentModel();
        $fathers  = $CommentModel->getCommentsParentOnly($postid);
        $comments = $this->getComments($fathers, $CommentModel);
        msg('',0, $comments);
    }

    private function getComments(array $comments, CommentModel $model) {
        $return = [];
        foreach ($comments as $value) {
            $return[$value['cid']] = [
                'author'   => $value['author'],
                'email'    => $value['email'],
                'url'      => $value['url'],
                'content'  => $value['content'],
                'date'     => $value['date'],
                'agent'    => $value['agent'],
                'child'    => $this->getChildComments($value['cid'], $model)
            ];
        }
        return $return;
    }

    private function getChildComments($pid, CommentModel $model) {
        $return    = [];
        $comments  = $model->getCommentsByPID($pid);
        foreach ($comments as $value) {
            $return[$value['cid']] = [
                'author'   => $value['author'],
                'email'    => $value['email'],
                'url'      => $value['url'],
                'content'  => $value['content'],
                'date'     => $value['date'],
                'agent'    => $value['agent'],
                'child'    => $this->getChildComments($value['cid'], $model)
            ];
        }
        return $return;
    }

    public function Delete() {

    }
}
