<?php View::Load('Default/Header'); ?>
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

<?php View::Load('Default/Footer'); ?>
