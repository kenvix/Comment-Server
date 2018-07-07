<?php
// +----------------------------------------------------------------------
// 简易单用户认证控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class AuthController extends BaseController {
    /**
     * @var bool 是否已登录
     */
    public $islogin = false;

    public function __construct() {
        if(!empty($_COOKIE['commentserver_user']) && !empty($_COOKIE['commentserver_pass'])) {
            $name = $this->decryptLoginCookie($_COOKIE['commentserver_user']);
            $password = $this->decryptLoginCookie($_COOKIE['commentserver_pass']);
            if(!empty($name) && !empty($password)) {
                $name = strtolower($name);
                if(($name == strtolower(AdminName) || $name == strtolower(AdminEmail)) && $password == AdminPassword) $this->islogin = true;
            }
        }
    }

    /**
     * 检查是否登录了
     * @param bool $mode 如果为true，则登录了会拒绝用户继续操作
     */
    final protected function checkLogin($mode = false) {
        if(!$mode && !$this->islogin) {
            redirect(U('User/Login','error=请先登录'));
        } elseif($mode && $this->islogin) {
            msg('你已经登录了', 10);
        }
    }

    /**
     * 是否已登录
     * @return bool
     */
    final protected function isLogin() {
        if($this->islogin) {
            return true;
        } else {
            return false;
        }
    }

    protected function encryptLoginCookie($str) {
        return (new \Adbar\Encrypter(AdminLoginEncryptKey))->encrypt($str);
    }

    protected function decryptLoginCookie($str) {
        return (new \Adbar\Encrypter(AdminLoginEncryptKey))->decrypt($str);
    }
}