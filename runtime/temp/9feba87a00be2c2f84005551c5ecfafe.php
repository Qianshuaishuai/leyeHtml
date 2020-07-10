<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./views/home/mobile/profile/channel.phtml";i:1541935409;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/header.phtml";i:1541935409;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/footer.phtml";i:1592421926;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>用户中心-推广帐号</title>
    <link rel="shortcut icon" href="clientapp/images/new_images/favicon.ico"/>
    <link href="/static/home/mobile/css/reset_5.css" rel="stylesheet" type="text/css"/>
    <link href="/static/home/mobile/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/static/home/mobile/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/static/home/mobile/css/new_style.css"/>
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
<header class="header-fixed site-header">
    <a href="javascript:history.go(-1)" class="back">
        <!--<img src="picture/return.png" />-->
    </a>
    <div class="tit-name">合作渠道</div>
</header>
<div class="main" style="padding-top: 60px;margin-bottom: 0;">
    <!--<div class="member-ts"></div>-->
    <div class="task-tab">
        <ul class="task-tab-tit">
            <li class="task-tit1" style="width:100%;">
                <?php if(!empty($member['is_bind_channel'])): ?>
                <div class="li_txt"><?php echo !empty($member['channel_name'])?$member['channel_name']:''; ?></div>
                <?php else: ?>
                <div class="li_txt" id="select_reward">选择合作渠道<i class="sj"></i></div>
                <?php endif; ?>
            </li>
        </ul>
        <div class="task-tab-cont" style="display: none">
            <ul class="second-nav second-nav-one">
                <?php if(!empty($channels)): if(is_array($channels) || $channels instanceof \think\Collection || $channels instanceof \think\Paginator): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
                        <li data-id="<?php echo $channel['id']; ?>"><?php echo $channel['title']; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
        </div>
    </div>
    <div class="member-form">
        <div class="item-box">
            <form id="post_form">
                <input type="hidden" name="channel_id" value="0">
                <input type="text" name="desc" class="m_txt" <?php echo !empty($member['is_bind_channel'])?'readonly':''; ?> value="<?php echo !empty($member['channel_desc'])?$member['channel_desc']:''; ?>" placeholder="请输入群号、号码、网址备注信息" id="account">
            </form>
        </div>
    </div>
</div>
<div class="member-btn">
    <input type="button" class="button1" value="提交" <?php echo !empty($member['is_bind_channel'])?'disabled':''; ?> >
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
<script type="text/javascript">
    $(function () {
        $('#select_reward').click(function () {
            $('.task-tab-cont').toggle();
        });
        
        $('.second-nav li').click(function () {
            var channel_id = $(this).attr('data-id');
            var html = $(this).text();
            $("input[name='channel_id']").val(channel_id);
            $('#select_reward').html(html+'<i class="sj"></i>');
            $(this).parent().parent().hide();
        });

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