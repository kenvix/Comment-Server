<?php
// +----------------------------------------------------------------------
// 站点评论配置文件
// +----------------------------------------------------------------------
// 请勿使用记事本编辑！
// +----------------------------------------------------------------------

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
X_FORWARDED_FOR : 若你的服务器使用了CDN（例如cloud flare、百度云加速）填写这个。
*/
define('GetIPMethod', 'REMOTE_ADDR');

//是否人工审核所有评论。开启后AKISMET仍然会检测评论，但检测通过的评论将标记为待审核
define('ManuallyCheckComment', true);

//////----------------------AKISMET反垃圾评论----------------------//////
//Akismet 反垃圾评论: 是否启用
define('AkismetEnabled', true);
//Akismet 反垃圾评论：处理策略：是否异步处理（评论暂时标记为待审核，然后由计划任务来抽空上传AKISMET检测）。填写为false将在用户提交评论时检测，会导致用户等待时间变长
define('AkismetAsync', false);
//Akismet API Key
define('AkismetAPIKey', '');
//Akismet 反垃圾评论：是否直接删除垃圾评论
define('AkismetDeleteSpamDirectly', false);