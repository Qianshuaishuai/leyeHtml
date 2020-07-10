<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"./views/home/mobile/profile/password.phtml";i:1541935409;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/header.phtml";i:1541935409;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改密码</title>
    <link rel="shortcut icon" href="clientapp/images/new_images/favicon.ico"/>
    <link href="/static/home/mobile/css/reset_5.css" rel="stylesheet" type="text/css"/>
    <link href="/static/home/mobile/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/static/home/mobile/css/new_style.css"/>
    <link rel="stylesheet" href="/static/home/mobile/css/font-awesome.min.css">
    <link rel="shortcut icon" href="clientapp/images/new_images/favicon.ico" />
<link href="/static/home/mobile/css/reset_5.css" rel="stylesheet" type="text/css" />
<link href="/static/home/mobile/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/static/home/mobile/css/font-awesome.min.css">
<link href="/static/home/mobile/css/new_style.css" rel="stylesheet" type="text/css" />
<!-- 弹出层 -->
<link rel="stylesheet" href="/static/plugins/dialog/css/dialog.css" />
<script src="/static/home/mobile/js/jquery-2.0.3.min.js"></script>
<script src="/static/plugins/dialog/js/dialog.js"></script>
<!-- 弹出层 -->
<script type="text/javascript" src="/static/plugins/clipboard.min.js"></script>
<script type="text/javascript" src="/static/home/mobile/js/global.js?v=2"></script>
</head>
<body>
    <div class="find-pwd">
        <div class="site-header">
            <a onclick="window.history.back();" class="back"></a>
            <div class="tit-name">修改密码</div>
        </div>
        <div class="main" style="margin-bottom: 0;">
            <form id="post_form">
                <div class="member-form">
                    <div class="item-box">
                        <input type="password" name="old_password" class="m_txt" placeholder="输入原始密码" id="pwd">
                    </div>
                    <div class="item-box">
                        <input type="password" name="password" class="m_txt" placeholder="输入新密码" id="newPwd" >
                    </div>
                    <div class="item-box">
                        <input type="password" name="password_confirm" class="m_txt" placeholder="重复新密码" id="againPwd" >
                    </div>
                </div>
            </form>
        </div>
        <div class="member-btn">
            <input type="button" class="button1" value="提交">
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            //设置邮箱
            $('.button1').click(function () {
                $.post(
                    window.location.href,
                    $('#post_form').serialize(),
                    function (ret) {
                        message(ret.message,ret.redirect,ret.type);
                    },'json'
                );
            });
        });
    </script>
</body>
</html>