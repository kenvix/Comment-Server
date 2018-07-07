<?php
// +----------------------------------------------------------------------
// 评论控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class CommentController extends AuthController {
    public function Add() {
        $name     = I('post.name');
        $email    = I('post.email');
        $url      = I('post.url');
        $content  = I('post.content');
        $title    = I('post.title');
        $pid      = I('post.pid');
        $postText = empty(I('post.posttext')) ? $title : I('post.posttext');
        $ip       = GetIPMethod == 'none' ? '' : $_SERVER[GetIPMethod];
        if(empty($content) || empty($name) || empty($title)) msg('昵称和评论内容不能为空',100);
        if(!AllowEmptyEmail && empty($email)) msg('邮箱地址不能为空',100);
        if(empty($pid)) $pid = 0;
        else $pid = intval($pid);
        if(!checkEmail($email)) msg('邮箱格式错误', 101);
        if(!empty($url) && !checkURL($url)) msg('网址格式错误', 101);
        $blackName  = explode(' ', BlockedName);
        $blackEmail = explode(' ', BlockedEmail);
        $blackWord  = explode(' ', BlockedWord);
        if(in_array($name, $blackName)) msg('禁止使用该名称', 104);
        if(in_array($email, $blackEmail)) msg('禁止使用该名称', 104);
        foreach($blackWord as $value) {
            if(stripos($name, $value) !== false) msg('昵称中存在违禁词：' . $value,103);
            if(stripos($content, $value) !== false) msg('评论内容中存在违禁词：' . $value,103);
        }
        unset($value);
        $PostModel = new PostModel();
        $postid = $PostModel->getPostID($title);
        if(empty($postid)) msg('该文章不存在，请先添加该文章', 105);
        $m = new CommentModel();
        if($pid != 0) {
            $parent = $m->getCommentByCID($pid);
            if(empty($parent)) msg('指定的父评论不存在或不可用', 102);
            if($PostModel->getTitle($parent['postid']) != $title) msg('父评论文章不匹配', 102);
        }
        $status = CommentModel::StatusNormal;
        if(AkismetEnabled) $status = CommentModel::StatusWaitingAkismet;
        elseif(ManuallyCheckComment) $status = CommentModel::StatusPending;
        if(!AkismetAsync) {
            $akismet = new KAksimet();
            try {
                $akismetResult = $akismet->isSpam($content, $name, $email, $url, BlogUrl . BlogArticlePrefix . urlencode($title) . BlogArticleSuffix, 'comment');
                if($akismetResult) {
                    if(AkismetDeleteSpamDirectly) msg('您的评论被识别为垃圾评论，无法提交，请联系站长以了解更多', 108);
                    else $status = CommentModel::StatusSpam;
                }
            } catch (Exception $ex) {}
        } else {
            //TODO: 实现异步AKISMET
        }
        $newCID = $m->add($postid, $pid, $name, $email, $url, $content, date('Y-m-d H:m:s'), $status, $ip, I('server.HTTP_USER_AGENT'));
        if($newCID !== false) {
            if($status == CommentModel::StatusNormal) {
                if(!EmailNoticeAsync) {
                    try {
                        if($pid != 0) {
                            $sendMailTo = $parent['email'];
                            $sendMail = new TemplatedMail('Comment', [
                                'CommentAuthor1'  => $parent['author'],
                                'CommentAuthor2'  => $name,
                                'CommentAuthorUrl1'  => $parent['url'],
                                'CommentAuthorUrl2'  => $url,
                                'CommentAuthorEmail1'  => $parent['email'],
                                'CommentAuthorEmail2'  => $email,
                                'CommentContent1' => $parent['content'],
                                'CommentContent2' => $content,
                                'CommentUrl' => BlogUrl . BlogArticlePrefix . urlencode($title) . BlogArticleSuffix . '#x-comment-' . $newCID,
                                'BlogName' => BlogName,
                                'BlogUrl'  => BlogUrl,
                                'PostTitle' => $postText
                            ]);
                        } else {
                            $sendMailTo = AdminEmail;
                            $sendMail = new TemplatedMail('CommentToAdmin', [
                                'CommentAuthor'  => $name,
                                'CommentAuthorUrl'  => $url,
                                'CommentAuthorEmail'  => $email,
                                'CommentContent' => $content,
                                'CommentUrl' => BlogUrl . BlogArticlePrefix . urlencode($title) . BlogArticleSuffix . '#x-comment-' . $newCID,
                                'BlogName' => BlogName,
                                'BlogUrl'  => BlogUrl,
                                'PostTitle' => $postText
                            ]);
                        }
                        $sendMail->send($sendMailTo);
                    } catch (Exception $ex) {
                        //TODO: 实现发送失败日志记录
                    }
                } else {
                    //TODO: 实现异步邮件通知
                }
            }
            msg('操作成功');
        }
        else msg('操作失败，未知错误', 109);
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
                'cid'      => $value['cid'],
                'pid'      => $value['pid'],
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
                'cid'      => $value['cid'],
                'pid'      => $value['pid'],
                'child'    => $this->getChildComments($value['cid'], $model)
            ];
        }
        return $return;
    }

    public function Delete() {
        $this->checkLogin();
    }
}
