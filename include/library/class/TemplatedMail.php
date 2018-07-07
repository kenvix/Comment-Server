<?php
// +----------------------------------------------------------------------
// 发送各种模板化邮件
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class TemplatedMail {
    private $var;
    private $type;

    /**
     * SendTemplatedMail constructor.
     * @param string $type
     * @param array $var
     */
    public function __construct($type, array $var) {
        $this->var = $var;
        $this->type = ucfirst($type);
    }

    /**
     * 发送评论通知邮件
     * @param string $to 收件人
     * @return bool 成功:true 失败：错误消息. 使用 === true 确定是否成功
     * @throws FileInaccessibleException
     */
    public function send($to) {
        $content = $this->getContent();
        $title   = $this->getTitle();
        return sendMail($to, $title, $content);
    }

    /**
     * @return string
     * @throws FileInaccessibleException
     */
    private function getContent() {
        foreach($this->var as $key => $value)
            View::Assign($key, $value);
        return View::Get("Mail/{$this->type}/Content");
    }

    /**
     * @return string
     * @throws FileInaccessibleException
     */
    private function getTitle() {
        foreach($this->var as $key => $value)
            View::Assign($key, $value);
        return View::Get("Mail/{$this->type}/Content");
    }
}