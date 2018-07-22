<?php
// +----------------------------------------------------------------------
// 应用程序类
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class Application {
    protected $controller;
    protected $action;
    protected $controllerDefault = 'Default';
    protected $actionDefault = 'Other';

    public function Run() {
        if(empty($this->controller)) $this->controller = I('get.c');
        if(empty($this->action))     $this->action     = I('get.a');
        if(strpos($this->action, '_') === 0) throw new InvalidArgumentException('ACTION非法', 3);
        if(strpos($this->controller, '_') === 0) throw new InvalidArgumentException('CONTROLLER非法', 3);
        if(empty($this->controller)) $this->controller = $this->controllerDefault;
        if(empty($this->action)) $this->action = $this->actionDefault;
        else $this->controller = ucfirst($this->controller);
        if(!file_exists("include/controller/{$this->controller}Controller.class.php")) $this->controller = $this->controllerDefault;
        $controllerClassName = "{$this->controller}Controller";
        define('Controller', $controllerClassName);
        define('ControllerName', $this->controller);

        include "include/controller/{$controllerClassName}.class.php";
        $instance = new $controllerClassName();
        if(method_exists($instance, '_initialize')) $instance->_initialize();
        if(method_exists($instance, $this->action)) {
            define('Action', $this->action);
            $instance->{$this->action}();
        } else {
            if(method_exists($instance, $this->actionDefault)) {
                define('Action', $this->actionDefault);
                $instance->{$this->actionDefault}();
            }
            else throw new InvalidArgumentException('没有这种操作！', 2);
        }
        return $this;
    }

    /**
     * 强制设置控制器
     * @param $controller
     * @return $this
     */
    public function SetController($controller) {
        $this->controller = $controller;
        return $this;
    }

    /**
     * 强制设置操作
     * @param $action
     * @return $this
     */
    public function SetAction($action) {
        $this->action = $action;
        return $this;
    }

    public function SetDefaultController($controller) {
        $this->controllerDefault = $controller;
        return $this;
    }

    public function SetDefaultAction($action) {
        $this->actionDefault = $action;
        return $this;
    }

}