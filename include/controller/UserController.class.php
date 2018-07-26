<?php
// +----------------------------------------------------------------------
// 简易用户控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class UserController extends AuthController {

    public function Login() {
        $this->checkLogin(true);
        View::Load();
    }

    public function LoginAction() {
        $this->checkLogin(true);
        $name = I('post.user');
        $password = I('post.pw');
        if(empty($name) || empty($password)) redirect(U('User/Login','error=用户名或密码不能为空'));
        $password = hash(AdminPasswordEncryptionAlgorithm, $password);
        if($password == AdminPassword && (strtolower($name) == strtolower(AdminName) || strtolower($name) == strtolower(AdminEmail))) {
            $time = time() + (isset($_POST['ispersis']) ? 9999999 : 86400);
            setcookie('commentserver_user', $this->encryptLoginCookie($name), $time);
            setcookie('commentserver_pass', $this->encryptLoginCookie($password), $time);
            redirect(U('Default/Other'));
        } else {
            redirect(U('User/Login','error=用户名或密码错误'));
        }
    }

    /**
     * 获取当前登录后的用户的Cookie API, 用于在博客页面点击登录按钮
     */
    public function GetCookie() {
        $this->checkLogin();
        $this->writeCORSHeader();
        if(empty($_SERVER['HTTP_REFERER']) || !isURLTrusted($_SERVER['HTTP_REFERER'])) msg('无效的请求来源', 149);
        $data = [
            'commentserver_user' => $_COOKIE['commentserver_user'],
            'commentserver_pass' => $_COOKIE['commentserver_pass'],
            'commentserver_name' => AdminName,
            'commentserver_avatar' => md5(AdminEmail),
        ];
        if(isset($_GET['redirect'])) {
            redirect(BlogUrl . '?' . http_build_query($data));
        } else {
            msg('OK',0, $data);
        }
    }

    /**
     * 获取当前用户信息,可以用于鉴权. 在请求中添加cookie确定用户
     */
    public function GetInfo() {
        $this->checkLogin();
        msg('OK',0,[
           'name' => AdminName,
           'email' => AdminEmail,
           'avatar' => md5(AdminEmail)
        ]);
    }
}