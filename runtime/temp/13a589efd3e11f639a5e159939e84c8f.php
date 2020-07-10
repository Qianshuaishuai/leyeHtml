<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"./views/home/mobile/invite/silver.phtml";i:1592363385;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/header.phtml";i:1541935409;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/footer.phtml";i:1592421926;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>邀请好友</title>
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
    <link rel="shortcut icon" href="clientapp/images/new_images/favicon.ico" />
    <link href="/static/home/mobile/css/reset_5.css" rel="stylesheet" type="text/css" />
    <link href="/static/home/mobile/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/static/home/mobile/css/new_style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/static/home/mobile/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/home/mobile/css/new_page.css">
    <link rel="stylesheet" href="/static/home/mobile/css/layui.css">
    <style type="text/css">
        .mx_list li {
            min-height: 26px;
            line-height: 26px;
        }
    </style>
</head>
<body>
<header class="site-header header-fixed">
    <a onclick="window.history.back();" class="back"></a>
    <div class="tit-name">
        邀请好友
    </div>
</header>
<div class="main inviteList">
    <div class="member-tab">
        <ul class="add_friend_tab">
            <li>
                <a href="/home/invite.html"> <span>邀请好友</span></a>
            </li>
            <li class="active">
                <span>邀请记录</span>
            </li>
            <li>
                <a href="/home/invite/gold.html"> <span>邀请返利</span></a>
            </li>
        </ul>
    </div>
    <div class="update-box mx_list" id="table">
        <ul id="flow">
        </ul>
        <!-- <div class="alipa-box">
            <div class="task-none" style="display: none;text-align: center;">暂无数据</div>
        </div> -->
    </div>
</div>
<!--
<link rel="stylesheet" href="/index/common/weui.css"><!--官方css-->
<footer class="new-footer">
    <div class="weui-tabbar">
        <a href="/index.html" class="weui-tabbar__item js_item weui-bar__item_on" data-id="one">
            <img src="/index/common/tab1.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">首页</p>
        </a>
        <a href="/task.html" class="weui-tabbar__item js_item" data-id="two" >
            <img src="/index/common/tab2.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">任务中心</p>
        </a>
        <a href="/home/account.html" class="weui-tabbar__item js_item" data-id="three" >
            <img src="/index/common/tab3.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">个人中心</p>
        </a>
    </div>
</footer>-->

<script type="text/javascript" src="/static/home/mobile/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){
        //流加载
        layui.use('flow', function(){
            var flow = layui.flow;
            flow.load({
                elem: '#table'
                ,done: function(page, next){
                    var lis = [];
                    $.get('/home/invite/silver_ajax?page='+page, function(res){
                        layui.each(res.data, function(index, item){
                            $("#flow").append('<li><b><time>'+item.level_title+'</time></b><p>邀请用户：'+item.username+'<span>'+(item.username ? '成功邀请用户：'+item.username+'，编号：'+item.uid : '')+'</span></p>    </li>');
                        });
                        next(lis.join(''), false);
                    });
                }
            });
        });
    });
</script>
</body>
</html>