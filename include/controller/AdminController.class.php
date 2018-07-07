<?php
// +----------------------------------------------------------------------
// 管理控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class AdminController extends AuthController {
    public const RequireLogged = true;

    public function CheckAkismetAPIKey() {
        $akismet = new KAksimet();
        if($akismet->verifyKey()) msg('Akismet APIKey 有效');
        else msg('Akismet APIKey 无效');
    }

    public function SendTestMail() {
        $result = sendMail(EmailNoticeSenderMail, SiteName . ' 测试邮件', '如果你收到了这封邮件，表明邮件设置正确。' . date('Y-m-d H:m:s'));
        if($result === true) msg('测试邮件发送成功');
        else msg('测试邮件发送失败：' . $result,201);
    }
}