<?php View::Load('Default/Header','首页'); ?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">统计信息 <small>(已缓存)</small></h3>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <b>文章数量：</b><?php echo (new Counter(Counter::TypePost))->getNum(); ?>
        </li>
        <li class="list-group-item">
            <b>评论数量：</b><?php echo (new Counter(Counter::TypeCommentAll))->getNum(); ?>
        </li>
        <li class="list-group-item">
            <b>待审核评论数量：</b><?php echo (new Counter(Counter::TypeCommentPending))->getNum(); ?>
        </li>
        <li class="list-group-item">
            <b>垃圾评论数量：</b><?php echo (new Counter(Counter::TypeCommentSpam))->getNum(); ?>
        </li>
        <li class="list-group-item">
            <b>回收站评论数量：</b><?php echo (new Counter(Counter::TypeCommentDeleted))->getNum(); ?>
        </li>
        <?php if(AkismetAsync): ?>
        <li class="list-group-item">
            <b>Akismet 待处理队列评论数量：</b><?php echo (new Counter(Counter::TypeCommentWaitingAkismet))->getNum(); ?>
        </li>
        <?php endif; ?>
    </ul>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">账户资料</h3>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <b>用户名：</b><?php echo AdminName; ?>
        </li>
        <li class="list-group-item">
            <b>邮箱：</b><?php echo AdminEmail; ?>
        </li>
    </ul>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">站点信息</h3>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
        </li>
        <li class="list-group-item">
            <b>服务器系统：</b><?php echo php_uname('a') ?>
        </li>
        <li class="list-group-item">
            <b>数据库驱动：</b><?php echo ucwords(DBType); ?>
        </li>
        <li class="list-group-item">
            <b>缓存驱动：</b><?php echo ucwords(CacheDriver); ?>
        </li>
        <li class="list-group-item">
            <b>默认站点地址：</b><?php echo SiteUrl; ?>
        </li>
        <li class="list-group-item">
            <b>博客地址：</b><?php echo BlogUrl; ?>
        </li>
    </ul>
</div>


<?php View::Load('Default/Footer'); ?>
