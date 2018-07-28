<div class="page-frame">
    <div class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php echo SiteName; ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php echo SiteName; ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(IsLogin): ?>
            <ul class="nav navbar-nav">
                <li class="topNavi"><a href="<?php echo U('Admin/Adminer'); ?>" target="_blank"><span class="glyphicon glyphicon-compressed"></span> Adminer</a></li>
                <li class="topNavi"><a href="<?php echo U('Admin/PHPInfo'); ?>" target="_blank"><span class="glyphicon glyphicon glyphicon-oil"></span> PHPInfo</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th-list"></span> 测试<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="topNavi"><a href="<?php echo U('Admin/SendTestMail'); ?>"><span class="glyphicon glyphicon-envelope"></span> 发送测试邮件</a></li>
                        <li class="topNavi"><a href="<?php echo U('Admin/CheckAkismetAPIKey'); ?>"><span class="glyphicon glyphicon-asterisk"></span> 测试 Akismet API</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo U('User/Logout'); ?>"><span class="glyphicon glyphicon-off"></span> 退出</a></li>
            </ul>
            <?php endif; ?>
        </div><!-- /.navbar-collapse -->
    </div>
    <div class="container bs-docs-container">