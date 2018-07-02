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
//管理员的名字，未认证的任何人不得填写名字
define('AdminName',  'Kenvix');
//管理员的邮箱地址，未认证的任何人不得填写该邮箱
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
//博客的地址，必须以 / 结尾
define('BlogUrl', 'https://kenvix.com/');
//博客文章前缀，没有的话可以忽略
define('BlogArticlePrefix','post/');
//博客文章后缀，没有的话可以忽略
define('BlogArticleSuffix','/');

//////----------------------垃圾评论设置----------------------//////