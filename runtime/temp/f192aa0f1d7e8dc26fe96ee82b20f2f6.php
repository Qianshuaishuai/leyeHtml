<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:40:"./views/home/mobile/feedback/index.phtml";i:1592363015;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/header.phtml";i:1541935409;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/footer.phtml";i:1592421926;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>我的反馈</title>
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
    <link rel="shortcut icon" href="clientapp/images/new_images/favicon.ico"/>
    <link href="/static/home/mobile/css/reset_5.css" rel="stylesheet" type="text/css"/>
    <link href="/static/home/mobile/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/static/home/mobile/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/home/mobile/css/new_page.css">
    <link rel="stylesheet" href="/static/home/mobile/css/layui.css">
</head>
<body>
<header class="new-header">
    <a onclick="history.back()" class="back">
        <img src="/static/home/mobile/picture/return.png"/>
    </a>
    <div class="tit-name">我的反馈</div>
    <span class="dowm-btn publish-task-btn">
        <a href="/home/feedback/add.html" class="sc" style="color: #fff;">新增</a>
    </span>
</header>
<div class="new-gold-detial">
    <div class="update-box mx_list" id="table">
        <ul id="flow">
        </ul>
        <!-- <div class="alipa-box">
            <div class="task-none" style="display: none;text-align: center;">暂无数据</div>
        </div> -->
    </div>
</div>

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
</footer>
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
                            $.get('/home/feedback/ajax/page/'+page, function(res){
                                layui.each(res.data.data, function(index, item){
                                    var status = item.is_reply == 1 ? '已回复' : '待回复';
                                    $("#flow").append('<li onclick="window.location.href=\'/home/feedback/detail/id/'+item.id+'.html\'"><b><time>'+item.create_time+'</time></b><p>'+status+'<span>'+(item.content)+'</span></p>    </li>');
                                });
                                next(lis.join(''), res.data.length > 0 ? true : false);
                            });
                    }
            });
        });
});
</script>
</body>
</html>