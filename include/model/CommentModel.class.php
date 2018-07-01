<?php
// +----------------------------------------------------------------------
// 评论表模型
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class CommentModel extends BaseModel {

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
     * @return bool
     */
    public function add(int $postid, int $pid, $author, $email, $url, $content, $date, $status, $ip, $agent) {
        return $this->prepare("INSERT INTO `comment`(`postid`, `pid`, `author`, `email`, `url`, `content`, `status`, `ip`, `agent`) VALUES (:postid, :pid, :author, :email, :url, :content, :status, :ip, :agent)")
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
    }

    /**
     * @param int $cid
     * @return bool
     */
    public function deleteByCID(int $cid) {
        return $this->prepare('DELETE FROM comment WHERE cid = ?')->execute([$cid]);
    }

    /**
     * @param int $postid
     * @return bool
     */
    public function deleteByPostID(int $postid) {
        return $this->prepare('DELETE FROM comment WHERE postid = ?')->execute([$postid]);
    }

    /**
     * delete by pid(parent id). used for delete all child comments
     * @param int $pid
     * @return bool
     */
    public function deleteByPID(int $pid) {
        return $this->prepare('DELETE FROM comment WHERE pid = ?')->execute([$pid]);
    }
}
