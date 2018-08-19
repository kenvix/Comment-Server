<?php
// +----------------------------------------------------------------------
// 站点基本信息配置文件
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
define('AdminLoginEncryptKey', 'xew33xqxeycysgqw6rbqavx7r0wutsqf');

//////----------------------文章设置----------------------//////
//文章首次被评论时是否探测文章是否存在，防止恶意用户恶意增加文章
define('VerifyArticleExistence', true);
//以下设置用于探测文章是否的确存在，防止恶意用户恶意增加文章
//例如，Kenvix's Blog的一篇文章的地址是 https://kenvix.com/post/guestbook/ ，则应该这样写：
//博客的名称
define('BlogName', 'Kenvix\'s Blog');
//博客的地址，必须以 / 结尾
define('BlogUrl', 'http://127.0.0.1:4000/');
//博客文章前缀，没有的话可以忽略
define('BlogArticlePrefix','post/');
//博客文章后缀，没有的话可以忽略
define('BlogArticleSuffix','/');
//博客文章后缀是否包含参数？
define('BlogArticleSuffixWithQuery',false);

//////----------------------管理面板设置----------------------//////
//管理面板分页，一次显示多少行
define('AdminPageLineNum', 100);