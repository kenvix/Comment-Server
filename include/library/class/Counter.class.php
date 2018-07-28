<?php
// +----------------------------------------------------------------------
// 计数器类
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class Counter {
    const TypePost                   = 'NumTypePost';
    const TypeCommentAll             = 'NumTypeCommentAll';
    const TypeCommentNormal          = 'NumTypeCommentNormal'; //正常
    const TypeCommentPending         = 'NumTypeCommentPending'; //待人工审核
    const TypeCommentDeleted         = 'NumTypeCommentDeleted'; //在回收站
    const TypeCommentSpam            = 'NumTypeCommentSpam'; //被akismet认为是垃圾评论
    const TypeCommentWaitingAkismet  = 'NumTypeCommentWaitingAkismet'; //待人工审核且待AKISMET处理(在AKISMET处理队列)
    const TypeCommentPerPost         = 'NumTypeCommentG';
    private $type;
    private $cache;

    public function __construct($type) {
        $this->type = $type;
        $this->cache = new Cache();
    }

    public function getNum() {
        try {
            $cachedNum = $this->cache->getValue($this->type);
            if(is_null($cachedNum)) {
                $num = $this->countNumFormDatabase();
                $this->cache->setValue($this->type, $num);
                return $num;
            } else {
                return $cachedNum;
            }
        } catch (Exception $ex) {
            return $this->countNumFormDatabase();
        }
    }

    public function countNumFormDatabase() {
        switch ($this->type) {
            case self::TypePost:
                return (new PostModel())->countNum();
                break;

            case self::TypeCommentAll:
                return (new CommentModel())->countNum(CommentModel::StatusAll);
                break;

            case self::TypeCommentDeleted:
                return (new CommentModel())->countNum(CommentModel::StatusDeleted);
                break;

            case self::TypeCommentNormal:
                return (new CommentModel())->countNum(CommentModel::StatusNormal);
                break;

            case self::TypeCommentPending:
                return (new CommentModel())->countNum(CommentModel::StatusPending);
                break;

            case self::TypeCommentSpam:
                return (new CommentModel())->countNum(CommentModel::StatusSpam);
                break;

            case self::TypeCommentWaitingAkismet:
                return (new CommentModel())->countNum(CommentModel::StatusWaitingAkismet);
                break;

            default:
                throw new InvalidArgumentException('无效的计数器类型');
                break;
        }
    }
}