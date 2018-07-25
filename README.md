# 博客文章评论服务端
一个为 Hexo 等静态博客设计的评论服务端，效果类似 Wordpress等博客系统的评论。该评论端有如下特色：   
     
1. 支持评论邮件通知(支持PHP/SMTP/Sendcloud等第三方平台)
2. 支持Akismet反垃圾评论
3. 邮件通知和反垃圾评论支持异步处理，提高用户体验
4. 具有独立web管理面板
5. 支持使用 SQLite 和 Mysql 数据库
6. 支持评论盖楼，评论关键词屏蔽

# 安装
请确保服务端安装了 Composer
```shell
git clone https://github.com/kenvix/Comment-Server.git
composer install
```
修改 config 目录下的所有设置。参考注释修改。

# 入口
位于public文件夹