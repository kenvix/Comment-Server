<?php
// +----------------------------------------------------------------------
// 评论控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class CommentController extends AuthController {
    const AdminEmailSign = '!1';
    use CommentTrait;

    public function Add() {
        $this->writeCORSHeader();
        $content  = I('post.content');
        $title    = $this->getTitle();
        $pid      = I('post.pid');
        $postText = empty(I('post.posttext')) ? $title : I('post.posttext');
        $ip       = GetIPMethod == 'none' ? '' : $_SERVER[GetIPMethod];
        if(!empty($_POST['commentserver_user']) && !empty($_POST['commentserver_pass'])) {
            if(!$this->islogin)
                msg('管理员登录会话已失效，请重新登录或以非管理员身份登录',198);
            $this->islogin = true;
            $name     = '';
            $email    = self::AdminEmailSign;
            $url      = '';
        } else {
            $name     = I('post.author');
            $email    = I('post.email');
            $url      = I('post.url');
            if(empty($content) || empty($name) || empty($title)) msg('昵称和评论内容不能为空',100);
            if(!AllowEmptyEmail && empty($email)) msg('邮箱地址不能为空',100);
            $email    = strtolower($email);
            if(empty($pid)) $pid = 0;
            else $pid = intval($pid);
            if($email == self::AdminEmailSign || !checkEmail($email)) msg('邮箱格式错误，请更正', 101);
            if(!empty($url) && !checkURL($url)) msg('网址格式错误，请更正或直接留空', 101);
            $blackName  = explode(' ', BlockedName);
            $blackEmail = explode(' ', BlockedEmail);
            $blackWord  = explode(' ', BlockedWord);
            if(in_array($name, $blackName)) msg('禁止使用该名称', 104);
            if(in_array($email, $blackEmail)) msg('禁止使用该邮箱地址', 104);
            foreach($blackWord as $value) {
                if(stripos($name, $value) !== false) msg('昵称中存在违禁词：' . $value,103);
                if(stripos($content, $value) !== false) msg('评论内容中存在违禁词：' . $value,103);
            }
            unset($value);
        }
        $PostModel = new PostModel();
        $postid = $PostModel->getPostID($title);
        if(empty($postid)) {
            if(AutoAddPostWhenNotExists) (new PostController())->Add();
            else msg('该文章不存在，请先添加该文章', 105);
        }
        $m = new CommentModel();
        if($pid != 0) {
            $parent = $m->getCommentByCID($pid);
            if(empty($parent)) msg('指定的父评论不存在或不可用', 102);
            if($PostModel->getTitle($parent['postid']) != $title) msg('父评论文章不匹配', 102);
        }
        $status = CommentModel::StatusNormal;
        if(!$this->islogin) {
            if(AkismetEnabled) $status = CommentModel::StatusWaitingAkismet;
            elseif(ManuallyCheckComment) $status = CommentModel::StatusPending;
            if(!AkismetAsync) {
                $akismet = new KAkismet();
                try {
                    $akismetResult = $akismet->isSpam($content, $name, $email, $url, BlogUrl . BlogArticlePrefix . urlencode($title) . BlogArticleSuffix, 'comment');
                    if($akismetResult) {
                        if(AkismetDeleteSpamDirectly) msg('您的评论被识别为垃圾评论，无法提交，请联系站长了解详情', 108);
                        else $status = CommentModel::StatusSpam;
                    }
                } catch (Exception $ex) {}
            } else {
                //TODO: 实现异步AKISMET
            }
        }
        $date = date('Y-m-d H:i:s');
        $newCID = $m->add($postid, $pid, $name, $email, $url, $content, $date, $status, $ip, I('server.HTTP_USER_AGENT'));
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
                        if(!$sendMail->send($sendMailTo)) {
                            //TODO: 实现发送失败日志记录
                        }
                    } catch (Exception $ex) {
                        //TODO: 实现发送失败日志记录
                    }
                } else {
                    //TODO: 实现异步邮件通知
                }
            }
            $newCommentInfo = [
                'content'  => $content,
                'date'     => $date,
                'agent'    => I('server.HTTP_USER_AGENT'),
                'cid'      => $newCID,
                'pid'      => $pid,
                'child'    => []
            ];
            if($email == self::AdminEmailSign) {
                $newCommentInfo['author']   = AdminName;
                $newCommentInfo['avatar']   = md5(AdminEmail);
                $newCommentInfo['url']      = BlogUrl;
            } else {
                $newCommentInfo['author']   = $name;
                $newCommentInfo['avatar']   = md5($email);
                $newCommentInfo['url']      = $url;
            }
            (new Counter(Counter::TypeCommentAll))->add();
            switch ($status) {
                case CommentModel::StatusSpam: $counterType = Counter::TypeCommentSpam; break;
                case CommentModel::StatusPending: $counterType = Counter::TypeCommentPending; break;
                case CommentModel::StatusNormal: $counterType = Counter::TypeCommentNormal; break;
                case CommentModel::StatusWaitingAkismet: $counterType = Counter::TypeCommentWaitingAkismet; break;
            }
            if(!empty($counterType)) (new Counter($counterType))->add();
            if($status != CommentModel::StatusNormal) {
                msg('评论提交成功，待管理员审核后即可显示', 200, $newCommentInfo);
            } else {
                msg('评论提交成功', 0, $newCommentInfo);
            }
        }
        else msg('操作失败，未知错误', 109);
    }

    /**
     * 获取文章评论，同时返回一个可以用于发布评论的token
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function Get() {
        $this->writeCORSHeader();
        $title = $this->getTitle();
        if(empty($title)) msg('应至少填充文章标题或文章URL',100);
        $PostModel = new PostModel();
        $postid = $PostModel->getPostID($title);
        if(empty($postid)) {
            if(AutoAddPostWhenNotExists) (new PostController())->Add();
            else msg('该文章不存在，请先添加该文章', 105);
        }
        $CommentModel = new CommentModel();
        $fathers  = $CommentModel->getCommentsParentOnly($postid);
        $comments = $this->getComments($fathers, $CommentModel);
        //$comments[TokenName] = generateToken();
        msg('OK',0, ['comments' => $comments]);
    }

    public function testTitleParse() {
        echo $this->getTitle();
    }

    public function Delete() {
        $this->checkLogin();
    }
}
