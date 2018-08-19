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

        include Root . "include/controller/{$controllerClassName}.class.php";
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

    public function SetupAll() {
        $this->SetupConfiguration()->SetupConstants()->SetupThingHandler()->SetupDatabase()->SetupComposer()->SetupFunctions();
    }

    public function SetupConfiguration() {
        require Root . 'config/advanced.php';
        require Root . 'config/database.php';
        require Root . 'config/site.php';
        require Root . 'config/comment.php';
        require Root . 'config/email.php';
        require Root . 'config/cache.php';
        return $this;
    }

    public function SetupFunctions() {
        require Root . 'include/library/function.php';
        return $this;
    }

    public function SetupComposer() {
        if(!file_exists('vendor/autoload.php'))
            throw new RuntimeException('Composer 未初始化，请先安装Composer并在此目录运行 composer install',253);
        require Root . 'vendor/autoload.php';
        return $this;
    }

    public function SetupConstants() {
        define('SystemVersion', '1.0');
        define('IsCli', (defined('FlagCliMode') || PHP_SAPI == "cli") ? true : false);
        define('IsAjax', (isset($_GET['ajax']) || isset($_SERVER['HTTP_ORIGIN']) || isset($_SERVER["HTTP_X_REQUESTED_WITH"])) ? true : false);
        chdir(Root);
        return $this;
    }

    public function SetupThingHandler() {
        spl_autoload_register(function ($class){
            if(strlen($class) > 5 && substr($class, -5) == 'Model') $folder = 'model';
            elseif(strlen($class) > 9 && substr($class, -9) == 'Exception') $folder = 'library/class/exception';
            elseif(strlen($class) > 10 && substr($class, -10) == 'Controller') $folder = 'controller';
            elseif(strlen($class) > 10 && substr($class, -5) == 'Trait') $folder = 'library/class/trait';
            else $folder = 'library/class';
            $path = Root . "include/{$folder}/{$class}.class.php";
            if(file_exists($path)) include $path;
        });
        error_reporting(ErrorReportLevel);
        set_exception_handler(function ($ex) {
            if(!IsCli && !IsAjax) {
                View::Assign('ex', $ex);
                View::Load('Default/Exception');
                die($ex->getCode());
            } else {
                msg('发生异常：' . $ex->getMessage(), $ex->getCode());
            }
        });
        ini_set('request_order', 'GP');
        return $this;
    }

    public function SetupDatabase() {
        if(DBType == 'mysql') {
            define('DSN', 'mysql://charset=utf8;dbname='.DBName.';host='.DBHost.';port='.DBPort);
        } elseif(DBType == 'sqlite') {

        } else {
            throw new InvalidArgumentException('数据库类型填写错误，请检查配置文件', 254);
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