<?php
// +----------------------------------------------------------------------
// 高级配置文件
// +----------------------------------------------------------------------
// 请勿使用记事本编辑！
// +----------------------------------------------------------------------

//当API调用的文章不存在时，是否自动调用PostController::Add
define('AutoAddPostWhenNotExists', true);

//VarAutoString: 输入变量强制转换为字符串
define('VarAutoString', true);
//DefuaultFilter: 输入变量过滤方法
define('DefuaultFilter', 'htmlspecialchars');
//错误报告级别
define('ErrorReportLevel', E_ALL);

define('TokenName', 'X-Kenvix-Comment-Token');
define('TokenType', 'md5');