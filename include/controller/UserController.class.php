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
}