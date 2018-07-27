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
            <ul class="nav navbar-nav">
                <li class="topNavi"><a href="<?php echo U('Admin/Adminer'); ?>" target="_blank"><span class="glyphicon glyphicon-compressed"></span> Adminer</a></li>
                <li class="topNavi"><a href="<?php echo U('Admin/PHPInfo'); ?>" target="_blank"><span class="glyphicon glyphicon glyphicon-oil"></span> PHPInfo</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
    <div class="container bs-docs-container">