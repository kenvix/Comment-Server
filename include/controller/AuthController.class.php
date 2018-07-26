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
            $this->islogin = $this->checkLoginByCookieString($_COOKIE['commentserver_user'], $_COOKIE['commentserver_pass']);
        }
        try {
            $childClassName = get_called_class();
            if($childClassName !== false && $childClassName != __CLASS__) {
                $childClass = new ReflectionClass($childClassName);
                if($childClass->hasConstant('RequireLogged') && $childClass->getConstant('RequireLogged')) $this->checkLogin();
                elseif($childClass->hasConstant('DisallowLogged') && $childClass->getConstant('DisallowLogged')) $this->checkLogin(true);
            }
        } catch (Exception $ex) {
            //TODO: 记录日志
        }
    }

    /**
     * 通过输入生成的cookie字符串检查是否登录了
     * @param $user
     * @param $pass
     * @return bool
     */
    protected function checkLoginByCookieString($user, $pass) {
        $name = $this->decryptLoginCookie($user);
        $password = $this->decryptLoginCookie($pass);
        if(!empty($name) && !empty($password)) {
            $name = strtolower($name);
            if(($name == strtolower(AdminName) || $name == strtolower(AdminEmail)) && $password == AdminPassword) return true;
        }
        return false;
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