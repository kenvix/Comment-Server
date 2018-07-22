<?php
// +----------------------------------------------------------------------
// 站点信息配置文件
// +----------------------------------------------------------------------
// 请勿使用记事本编辑！
// +----------------------------------------------------------------------


//////----------------------基本设置----------------------//////
//本评论系统站点的地址，必须以 / 结尾
define('SiteUrl', 'http://localhost/Comment-Server/');
define('SiteName', '评论服务器管理系统');
//信任的域名。允许来自下列域名的XHR请求，用空格分隔 必须全部小写！
define('TrustedDomain', 'localhost:4000 127.0.0.1:4000 kenvix.com www.kenvix.com');
//管理员的名字，未认证的任何人不得填写名字
define('AdminName',  'Kenvix');
//管理员的邮箱地址，未认证的任何人不得填写该邮箱
//若开启了评论邮件通知，此邮箱用于通知管理员
define('AdminEmail',  'kenvixzure@live.com');
//管理员的登录密码(按照下面的选项的加密结果)
//访问 http://站点地址/setup/password.php 生成密码
define('AdminPassword', 'b0412597dcea813655574dc54a5b74967cf85317f0332a2591be7953a016f8de56200eb37d5ba593b1e4aa27cea5ca27100f94dccd5b04bae5cadd4454dba67d');
//上面的加密结果代表默认密码111111

//管理员的登录密码的加密算法
/*
可以使用下列选项：
none   : × 明文，不加密，容易被盗号，十分不推荐
md5    : × MD5加密，安全性很差，不推荐
sha1   : × SHA-1加密，安全性很差，不推荐
sha256 : × SHA-256 加密，安全性一般
sha512 : √ SHA-512 加密，安全性较高
*/
define('AdminPasswordEncryptionAlgorithm',  'sha512');

//登录COOKIE加密密钥，请随便打32个英文和数字
define('AdminLoginEncryptKey', 'xew33xqxdocysgqw6rbqavx7r0wutsqf');

//////----------------------基本评论设置----------------------//////

//是否允许空邮箱。警告：允许将会导致无法搜索某个用户的评论
define('AllowEmptyEmail', false);
//未认证的任何人不得填写下列邮箱，用一个空格分隔。不区分大小写
define('BlockedEmail', 'kenvix@qq.com kenvix@vip.qq.com kenvixzure@gmail.com');
//未认证的任何人不得填写下列名字，用一个空格分隔。不区分大小写
define('BlockedName', 'Kenvixzure 无名智者');
//违禁词，在名字、邮箱、网址、评论内容均不得出现，用一个空格分隔。不区分大小写
define('BlockedWord', '习近平 江泽民');
//如何获得评论者的IP地址
/*
可以填写下列选项：
none            : 不记录IP
REMOTE_ADDR     : 在你的服务器没有使用CDN的前提下，填写这个可获得真实的IP
X-Forwarded-For : 若你的服务器使用了CDN（例如cloud flare、百度云加速）填写这个。
*/
define('GetIPMethod', 'REMOTE_ADDR');

////////评论邮件通知////////
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

////////AKISMET反垃圾评论////////
//是否人工审核所有评论。开启后AKISMET仍然会检测评论，但检测通过的评论将标记为待审核
define('ManuallyCheckComment', true);
//Akismet 反垃圾评论: 是否启用
define('AkismetEnabled', true);
//Akismet 反垃圾评论：处理策略：是否异步处理（评论暂时标记为待审核，然后由计划任务来抽空上传AKISMET检测）。填写为false将在用户提交评论时检测，会导致用户等待时间变长
define('AkismetAsync', false);
//Akismet API Key
define('AkismetAPIKey', '');
//Akismet 反垃圾评论：是否直接删除垃圾评论
define('AkismetDeleteSpamDirectly', false);

//////----------------------文章设置----------------------//////
//文章首次被评论时是否探测文章是否存在，防止恶意用户恶意增加文章
define('VerifyArticleExistence', true);
//以下设置用于探测文章是否的确存在，防止恶意用户恶意增加文章
//例如，Kenvix's Blog的一篇文章的地址是 https://kenvix.com/post/guestbook/ ，则应该这样写：
//博客的名称
define('BlogName', 'Kenvix\'s Blog');
//博客的地址，必须以 / 结尾
define('BlogUrl', 'https://kenvix.com/');
//博客文章前缀，没有的话可以忽略
define('BlogArticlePrefix','post/');
//博客文章后缀，没有的话可以忽略
define('BlogArticleSuffix','/');

//////----------------------垃圾评论设置----------------------//////