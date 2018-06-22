<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统错误</title>
    <style type="text/css">
        html {
            background: #eee;
        }
        body {
            background: #fff;
            color: #333;
            font-family: "微软雅黑","Microsoft YaHei", sans-serif;
            margin: 2em auto;
            padding: 1em 2em;
            max-width: 700px;
            -webkit-box-shadow: 10px 10px 10px rgba(0,0,0,0.13);
            box-shadow: 10px 10px 10px rgba(0,0,0,0.13);
            opacity:0.8;
        }
        h1 {
            border-bottom: 1px solid #dadada;
            clear: both;
            color: #666;
            font: 24px "微软雅黑","Microsoft YaHei",, sans-serif;
            margin: 30px 0 0 0;
            padding: 0;
            padding-bottom: 7px;
        }
        #error-page {
            margin-top: 50px;
        }
        h3 {
            text-align:center;
        }
        #error-page p {
            font-size: 9px;
            line-height: 1.5;
            margin: 25px 0 20px;
        }
        #error-page code {
            font-family: Consolas, Monaco, monospace;
        }
        ul li {
            margin-bottom: 10px;
            font-size: 9px ;
        }
        a {
            color: #21759B;
            text-decoration: none;
            margin-top:-10px;
        }
        a:hover {
            color: #D54E21;
        }
        .button {
            background: #f7f7f7;
            border: 1px solid #cccccc;
            color: #555;
            display: inline-block;
            text-decoration: none;
            font-size: 9px;
            line-height: 26px;
            height: 28px;
            margin: 0;
            padding: 0 10px 1px;
            cursor: pointer;
            -webkit-border-radius: 3px;
            -webkit-appearance: none;
            border-radius: 3px;
            white-space: nowrap;
            -webkit-box-sizing: border-box;
            -moz-box-sizing:    border-box;
            box-sizing:         border-box;

            -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
            box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
            vertical-align: top;
        }

        .button.button-large {
            height: 29px;
            line-height: 28px;
            padding: 0 12px;
        }

        .button:hover,
        .button:focus {
            background: #fafafa;
            border-color: #999;
            color: #222;
        }

        .button:focus  {
            -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,.2);
            box-shadow: 1px 1px 1px rgba(0,0,0,.2);
        }

        .button:active {
            background: #eee;
            border-color: #999;
            color: #333;
            -webkit-box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
            box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
        }
        table {
            table-layout:auto;
            border:1px solid #333;
            empty-cells:show;
            border-collapse:collapse;
        }
        th {
            padding:4px;
            border:1px solid #333;
            overflow:hidden;
            color:#333;
            background: #eee;
        }
        td {
            padding:4px;
            border:1px solid #333;
            overflow:hidden;
            color:#333;
        }
    </style>
</head>
<body id="error-page">
<h3>系统发生错误: 未处理的异常</h3>
<br/><b>消息：</b>#<?php echo $ex->getCode(); ?> - <?php echo $ex->getMessage(); ?><br/><br/>
<table style="width:100%"><thead><th>文件</th><th>行</th><th>代码</th></thead><tbody>
    <?php
    $trace = $ex->getTrace();
    echo '<tr><td>' . $ex->getFile() . '</td><td>' . $ex->getLine() . '' . '</td><td>[抛出异常]</td></tr>';
    foreach ($trace as $v) {
        $tracefile = isset($v['file']) ? $v['file'] : '';
        $traceline = isset($v['line']) ? $v['line'] : '';
        echo '<tr><td>' . $tracefile . '</td><td>' .  $traceline . '</td><td>' . $v['function'] . '</td></tr>';
    }
    echo '</tbody></table>';
    ?>
<br/><a style="float:right" href="javascript:history.back(-1)"><< 返回上一页</a>
<br/>
</body>
</html>