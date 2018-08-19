<?php View::Load('Default/Header', '登录'); ?>

<div class="panel panel-primary" style="margin:1% 1% 1% 1%;">
    <div class="panel-heading">
        <h3 class="panel-title">请输入您的账号信息</h3>
    </div>
    <div style="margin:0% 5% 5% 5%;">
        <div class="login-top"></div><br/>
        <b>您需要输入账户和密码才能继续使用，请输入您的账号信息</b><br/><br/>
        <?php if (isset($_GET['error'])): ?><div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            错误：<?php echo strip_tags($_GET['error']); ?></div><?php endif;?>
        <?php if (isset($_GET['msg'])): ?><div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo strip_tags($_GET['msg']); ?></div><?php endif;?>
        <form name="f" method="post" action="<?php echo U('User/LoginAction'); ?>">
            <div class="input-group">
                <span class="input-group-addon">账户</span>
                <input type="text" class="form-control" name="user" placeholder="用户名或者邮箱地址" required>
            </div><br/>
            <div class="input-group">
                <span class="input-group-addon">密码</span>
                <input type="password" class="form-control" name="pw" id="pw" required>
            </div>
            <BR/>
            <label><input type="checkbox" name="ispersis" value="1" /> 记住密码及账户</label>
            <div class="login-button"><br/>
                <button type="submit" class="btn btn-primary" style="width:100%;float:left;">立即登录</button>
            </div><br/><br/><br/>
            <?php echo SiteName ?> V<?php echo SystemVersion; ?> // 作者: <a href="https://kenvix.com" target="_blank">Kenvix</a>
            <div style=" clear:both;"></div>
            <div class="login-ext"></div>
            <div class="login-bottom"></div>
    </div>