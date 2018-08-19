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
        $akismet = new KAkismet();
        if($akismet->verifyKey()) msg('Akismet APIKey 有效');
        else msg('Akismet APIKey 无效');
    }

    public function SendTestMail() {
        $result = sendMail(AdminEmail, SiteName . ' 测试邮件', '如果你收到了这封邮件，表明邮件设置正确。' . date('Y-m-d H:i:s'));
        if($result === true) msg('测试邮件发送成功');
        else msg('测试邮件发送失败：' . $result,201);
    }

    public function Comment() {
        $type = (empty($_GET['type']) || !is_numeric($_GET['type'])) ? CommentModel::StatusAll : $_GET['type'];
        $model = new CommentModel();
        View::Assign('comments', $model->getCommentsAll($type, AdminPageLineNum, $this->getPageLimitationBegins()));
        View::Assign('type', $type);
        View::Load();
    }

    public function Adminer() {
        if(!session_start()) msg('服务器不支持PHP SESSION');
        $_SESSION['ADMINER_PW'] = hash('sha512', $_COOKIE['commentserver_pass'] . $_SERVER['DOCUMENT_ROOT'] . $_SERVER['SERVER_NAME']);
        if(DBType == 'sqlite')
            redirect('adminer.php');
        else
            redirect('adminer.php?username=&db=' . DBName);
    }

    public function PHPInfo() {
        phpinfo();
    }

    public function TestCache() {
        $cache = new Cache();
        if(!$cache->setValue('test','ggg')) msg('设置缓存失败', 70);
        $get = $cache->getValue('test');
        if(empty($get)) msg('设置缓存失败', 70);
        msg('缓存测试通过，Driver:'.CacheDriver.' Key:test Value:' . $get);
    }
}