<?php
// +----------------------------------------------------------------------
// 评论表模型
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class CommentModel extends BaseModel {

    const StatusAll             = -1;
    const StatusNormal          = 0; //正常
    const StatusPending         = 1; //待人工审核
    const StatusDeleted         = 2; //在回收站
    const StatusSpam            = 3; //被akismet认为是垃圾评论
    const StatusWaitingAkismet  = 4; //待人工审核且待AKISMET处理(在AKISMET处理队列)

    /**
     * @param int $postid
     * @param int $pid
     * @param     $author
     * @param     $email
     * @param     $url
     * @param     $content
     * @param     $date
     * @param     $status
     * @param     $ip
     * @param     $agent
     * @return bool|int 成功时返回自增值，否则为false
     */
    public function add($postid, $pid, $author, $email, $url, $content, $date, $status, $ip, $agent) {
        $this->prepare("INSERT INTO `comment`(`postid`, `pid`, `author`, `email`, `url`, `content`, `status`, `ip`, `agent`) VALUES (:postid, :pid, :author, :email, :url, :content, :status, :ip, :agent)")
            ->execute([
                ':postid' => $postid,
                ':pid' => $pid,
                ':author' => $author,
                ':email' => $email,
                ':url' => $url,
                ':content' => $content,
                ':date' => $date,
                ':status' => $status,
                ':ip' => $ip,
                ':agent' => $agent
            ]);
        return $this->lastInsertId();
    }

    /**
     * @param int $cid
     * @return bool
     */
    public function deleteByCID($cid) {
        return $this->prepare('DELETE FROM comment WHERE cid = ?')->execute([$cid]);
    }

    /**
     * @param int $postid
     * @return bool
     */
    public function deleteByPostID($postid) {
        return $this->prepare('DELETE FROM comment WHERE postid = ?')->execute([$postid]);
    }

    /**
     * delete by pid(parent id). used for delete all child comments
     * @param int $pid
     * @return bool
     */
    public function deleteByPID($pid) {
        return $this->prepare('DELETE FROM comment WHERE pid = ?')->execute([$pid]);
    }


    /**
     * get all comments by postid
     * @param int $postid
     * @param int $status
     * @return array
     */
    public function getComments($postid, $status = self::StatusNormal) {
        $db = $this->prepare('SELECT * FROM comment WHERE postid = :postid' . $this->buildCommentStatusSQL($status));
        $db->bindParam(':postid', $postid);
        $db->execute();
        return $db->fetchAll();
    }


    /**
     * @param     $cid
     * @param int $status
     * @return mixed
     */
    public function getCommentByCID($cid, $status = self::StatusNormal) {
        $db = $this->prepare('SELECT * FROM comment WHERE cid = :cid' . $this->buildCommentStatusSQL($status));
        $db->bindParam(':cid', $cid);
        $db->execute();
        return $db->fetch();
    }

    /**
     * 通过PID获取评论. 混淆警告：若是通过PID获取父评论，应该使用getCommentByCID
     * @param int $pid
     * @param int $status
     * @return array
     */
    public function getCommentsByPID($pid, $status = self::StatusNormal) {
        $db = $this->prepare('SELECT * FROM comment WHERE pid = :pid' . $this->buildCommentStatusSQL($status));
        $db->bindParam(':pid', $pid);
        $db->execute();
        return $db->fetchAll();
    }

    /**
     * get comments which are not child comments
     * @param int $postid
     * @param int $status
     * @return array
     */
    public function getCommentsParentOnly($postid, $status = self::StatusNormal) {
        $db = $this->prepare('SELECT * FROM comment WHERE postid = :postid AND pid = 0 ' . $this->buildCommentStatusSQL($status));
        $db->bindParam(':postid', $postid);
        $db->execute();
        return $db->fetchAll();
    }

    /**
     * build COMMENT STATUS sql
     * @param int  $status
     * @param bool $and
     * @return string
     */
    protected function buildCommentStatusSQL($status, $and = true) {
        if($status == self::StatusAll) return ' ';
        $sql = ' ';
        if($and) $sql .= 'AND ';
        return $sql . "`status` = $status ";
    }
}
