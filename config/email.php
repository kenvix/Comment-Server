<?php
// +----------------------------------------------------------------------
// 站点评论邮件通知配置文件
// +----------------------------------------------------------------------
// 请勿使用记事本编辑！
// +----------------------------------------------------------------------

//////----------------------评论邮件通知----------------------//////
//评论邮件通知：是否启用
define('EmailNoticeEnabled', true);
//评论邮件通知：处理策略：是否异步处理（将邮件通知任务添加到队列，然后由计划任务来抽空发邮件）。填写为false将在用户提交评论时操作，会导致用户等待时间变长
define('EmailNoticeAsync', false);
//评论邮件通知：发件人名称
define('EmailNoticeSenderName', 'Kenvix');
//评论邮件通知：发件人邮箱
define('EmailNoticeSenderMail', 'i@kenvix.com');
//评论邮件通知驱动
/*
可以填写下列选项：
php             : 调用php mail函数。不需要填写任何设置
smtp            : 使用SMTP，需要填写SMTP设置
*/
define('EmailNoticeDriver', 'smtp');

////////评论邮件通知驱动为SMTP时需填写下列选项////////
//SMTP服务器地址
define('EmailNoticeSMTPHost', 'smtp.sendcloud.net');
//SMTP服务器端口
define('EmailNoticeSMTPPort', '25');
//SMTP服务器加密类型
/*
可以填写下列选项：
none            : 无加密明文传输
tls             : 使用TLS（通常端口号和无加密的一样）
ssl             : 使用SSL（通常是端口号为465的为ssl）
*/
define('EmailNoticeSMTPEncryption', 'none');
//SMTP服务器是否需要身份验证
define('EmailNoticeSMTPAuth', true);
//SMTP服务器需要身份验证时填写：用户名
define('EmailNoticeSMTPAuthName', 'Kenvix');
//SMTP服务器需要身份验证时填写：密码
define('EmailNoticeSMTPAuthPassword', 'PFCjHpyKfPvfZrgs');
//发送完成后等待多长时间再关闭连接。时间以微秒计。1微秒（micro second）是百万分之一秒。
//Sendcloud等第三方平台需要配置此选项，否则可能导致邮件显示发送成功但实际没发
define('EmailNoticeSMTPSleep', 1000000);
/* SendCloud 配置说明
define('EmailNoticeSMTPHost', 'smtp.sendcloud.net');
define('EmailNoticeSMTPPort', '25');
define('EmailNoticeSMTPEncryption', 'tls');
define('EmailNoticeSMTPAuth', true);
//填写 SendCloud API_USER
define('EmailNoticeSMTPAuthName', '');
//填写 SendCloud API_KEY
define('EmailNoticeSMTPAuthPassword', '');
*/
//是否使用破坏性代码暴力隐藏退订按钮
define('EmailHideUnsubscribeButton', true);