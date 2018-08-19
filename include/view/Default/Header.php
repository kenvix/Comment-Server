<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="charset" content="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(!empty($args[0])): ?>
        <title><?php echo $args[0] . ' - ' . SiteName; ?></title>
    <?php else: ?>
        <title><?php echo SiteName; ?></title>
    <?php endif; ?>
    <meta name="generator" content="Kenvix Comment Server" />
    <link href="favicon.ico" rel="shortcut icon"/>
    <meta name="author" content="Kenvix <i@kenvix.com>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <script src="source/js/jquery.min.js"></script>
    <link rel="stylesheet" href="source/css/bootstrap.min.css">
    <script src="source/js/bootstrap.min.js"></script>
    <style type="text/css">body{font-family:"微软雅黑","Microsoft YaHei";background:#eee;}.input-group{width:100%;}.control-title{margin-top:0;}</style>
    <script type="text/javascript" src="source/js/js.js"></script>
    <script type="text/javascript" src="source/js/jquery.backstretch.js"></script>
    <link rel="stylesheet" href="source/css/ui.css">
    <link rel="stylesheet" href="source/css/theme.css" id="theme-css">
</head>
<body>
<?php View::Load('Default/Navi'); ?>