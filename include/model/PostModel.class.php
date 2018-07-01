<?php
// +----------------------------------------------------------------------
// 文章表模型
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class PostModel extends BaseModel {

    /**
     * @param $title
     * @return bool
     */
    public function add($title) {
        return $this->prepare('INSERT INTO post(title) VALUES (:title)')
            ->execute([
                'title' => $title
            ]);
    }

    /**
     * get postid by title
     * @param $title
     * @return bool|int
     */
    public function getPostID($title) {
        $db = $this->prepare('SELECT * FROM post WHERE title = :title');
        $db->bindParam(':title', $title);
        $db->execute();
        $result = $db->fetch();
        if(empty($result)) return false;
        return $result['postid'];
    }

    /**
     * @param int $postid
     * @return bool
     */
    public function getTitle($postid) {
        $db = $this->prepare('SELECT * FROM post WHERE postid = :postid');
        $db->bindParam(':postid', $postid);
        $db->execute();
        $result = $db->fetch();
        if(empty($result)) return false;
        return $result['title'];
    }

    /**
     * @param int $postid
     * @return bool
     */
    public function deleteByPostID($postid) {
        return $this->prepare('DELETE FROM post WHERE postid = ?')->execute([$postid]);
    }

    /**
     * @param $title
     * @return bool
     */
    public function deleteByTitle($title) {
        return $this->prepare('DELETE FROM post WHERE title = ?')->execute([$title]);
    }

    /**
     * @param int $postid
     * @param     $title
     * @return bool
     */
    public function updateByPostID($postid, $title) {
        $db = $this->prepare('UPDATE `post` SET `title` = :title WHERE `postid` = :postid');
        $db->bindParam(':title', $title);
        $db->bindParam(':postid', $postid);
        return $db->execute();
    }

    /**
     * @param $titleOld
     * @param $title
     * @return bool
     */
    public function updateByOldTitle($titleOld, $title) {
        $db = $this->prepare('UPDATE `post` SET `title` = :title WHERE `title` = :titleOld');
        $db->bindParam(':title', $title);
        $db->bindParam(':titleOld', $titleOld);
        return $db->execute();
    }
}