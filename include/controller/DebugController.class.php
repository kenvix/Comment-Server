<?php
// +----------------------------------------------------------------------
// 仅供调试
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class DebugController extends AuthController {
    public const RequireLogged = true;

    public function GetTables() {
        $m = new BaseModel();
        print_r($m->query("SHOW TABLES;")->fetchAll());
    }

    public function GetPosts() {
        $m = new BaseModel();
        print_r($m->execute()->fetchAll());
    }

    public function getCommentMailTitle() {
        $sendMail = new TemplatedMail('Comment', [
            'CommentAuthor1'  => 'Author',
            'CommentAuthor2'  => 'CommentAuthor2',
            'CommentAuthorUrl1'  => 'CommentAuthorUrl1',
            'CommentAuthorUrl2'  => 'CommentAuthorUrl2',
            'CommentAuthorEmail1'  => 'CommentAuthorEmail1',
            'CommentAuthorEmail2'  => 'CommentAuthorEmail2',
            'CommentContent1' => '',
            'CommentContent2' => '',
            'CommentUrl' => BlogUrl . BlogArticlePrefix . urlencode('test') . BlogArticleSuffix . '#x-comment-1',
            'BlogName' => BlogName,
            'BlogUrl'  => BlogUrl,
            'PostTitle' => 'PostTitle'
        ]);
        header('Content-type: text/plain');
        echo $sendMail->getTitle();
    }

    public function getCommentMailContent() {
        $sendMail = new TemplatedMail('Comment', [
            'CommentAuthor1'  => 'Author',
            'CommentAuthor2'  => 'CommentAuthor2',
            'CommentAuthorUrl1'  => 'CommentAuthorUrl1',
            'CommentAuthorUrl2'  => 'CommentAuthorUrl2',
            'CommentAuthorEmail1'  => 'CommentAuthorEmail1',
            'CommentAuthorEmail2'  => 'CommentAuthorEmail2',
            'CommentContent1' => '',
            'CommentContent2' => '',
            'CommentUrl' => BlogUrl . BlogArticlePrefix . urlencode('test') . BlogArticleSuffix . '#x-comment-1',
            'BlogName' => BlogName,
            'BlogUrl'  => BlogUrl,
            'PostTitle' => 'PostTitle'
        ]);
        echo $sendMail->getContent();
    }
}
