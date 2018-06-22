<?php
require '../config/site.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>密码生成器</title>
</head>
<body>
当前加密算法：<?php echo AdminPasswordEncryptionAlgorithm; ?>
<br/>
<?php if(!isset($_POST['password'])){ ?>
<form method="post">
    请输入您希望设置的密码：<input type="text" name="password">
    <input type="submit">
</form>
<?php } else { ?>
加密结果：<input type="text" value="<?php echo hash(AdminPasswordEncryptionAlgorithm, $_POST['password']) ?>">
<br/>复制它，然后粘贴到站点 config 目录下的 site.php 中的 AdminPassword 字段
<?php } ?>
</body>