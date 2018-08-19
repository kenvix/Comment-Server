<?php
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

trait CommentTrait {
    protected function getComments(array $comments, CommentModel $model) {
        $return = [];
        foreach ($comments as $value) {
            $return[$value['cid']] = [
                'content'  => $value['content'],
                'date'     => $value['date'],
                'agent'    => $value['agent'],
                'cid'      => $value['cid'],
                'pid'      => $value['pid'],
                'child'    => $this->getChildComments($value['cid'], $model)
            ];
            if($value['email'] == self::AdminEmailSign) {
                $return[$value['cid']]['author']   = AdminName;
                $return[$value['cid']]['avatar']   = md5(AdminEmail);
                $return[$value['cid']]['url']      = BlogUrl;
            } else {
                $return[$value['cid']]['author']   = $value['author'];
                $return[$value['cid']]['avatar']   = md5($value['email']);
                $return[$value['cid']]['url']      = $value['url'];
            }
        }
        return $return;
    }

    protected function getChildComments($pid, CommentModel $model) {
        $return    = [];
        $comments  = $model->getCommentsByPID($pid);
        foreach ($comments as $value) {
            $return[$value['cid']] = [
                'author'   => $value['author'],
                'avatar'   => md5($value['email']),
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
}