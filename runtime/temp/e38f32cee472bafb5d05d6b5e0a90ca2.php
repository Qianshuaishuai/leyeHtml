<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:36:"./views/home/mobile/fans/index.phtml";i:1592420194;s:59:"/www/wwwroot/leye/public/views/home/mobile/fans/_list.phtml";i:1541935409;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/footer.phtml";i:1592421926;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

    <head>
        <meta name="apple-mobile-web-app-capable" content="yes">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>推推-微信投票,微信助力,APP下载,游戏推广……可以拉票推广也可以赚钱</title>
        <link href="/static/home/mobile/css/reset_5.css" rel="stylesheet" type="text/css" />
        <link href="/static/home/mobile/css/style.css" rel="stylesheet" type="text/css" />
        <link href="/static/home/mobile/css/new_style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/static/home/mobile/css/font-awesome.min.css">
        <link rel="stylesheet" href="/static/plugins/dialog/css/dialog.css" />
        <script src="/static/home/mobile/js/jquery-2.0.3.min.js"></script>
        <script src="/static/plugins/dialog/js/dialog.js"></script>
        <script type="text/javascript" src="/static/plugins/clipboard.min.js"></script>
        <script type="text/javascript" src="/static/home/mobile/js/global.js"></script>
        <style type="text/css">
        .button5, .button5:link, .button5:visited {
            width: 100%;
            height: auto;
            border-radius: 3px;
            outline: none;
            -webkit-appearance: none;
            font-weight: normal;
            line-height: 35px;
            font-weight: bold;
            color: #fff;
            font-size: 17px;
            background: #FE4B1C;
            border: none;
            border-radius: 15px;
            display: block;
            margin: 10px 0;
            padding: 0;
            float: none;
        }
        .add_friend_tab li {
            width: 50%;
        }
        .task-list-remain-num span {
            width: 33.33%;
            float: left;
            text-align: center;
        }
        .paging {
            padding: 30px 0;
        }
.data_red_bg{
    display:block;
    width:100%;
    height:auto;
    background: #FE4B1C;
    color:#fff;
    padding:10px 0 ;
    border-top: 1px solid #fff;
}
#userList.android_list{
    /* margin:6.9rem 0 0 0; */
}
.data_img,.data_name,.data_time{
    float:left;
}
.data_red_bg .data_time{
    color:#fff;
}
.data_img{
    width:50px;
    height:50px;
    padding:0 10px 0 12px;
}
.data_img img{
    width:100%;
    height:100%;
    border-radius:100%;
}
.data_name{
    font-size:16px;
    text-overflow:ellipsis;
    overflow:hidden;
    white-space:nowrap;
    color:#000;
}
.data_time{
    float:right;
    color:#656565;
    font-size:0.6rem;
    padding:0 0.6rem 0 0;
}
.data_name,.data_time{
    height:2rem;
    line-height:2rem;
}
.data_infor_wrapper{
    float:left;
}
.data_id{
    font-size:0.5rem;
    line-height:1.5rem;
    color:#fbc5bf;
}
.data_use_name{
    max-width:150px;
    font-size:16px;
    line-height:30px;
    color:#fff;
    margin-right:26px;
    text-overflow:ellipsis;
    overflow:hidden;
    white-space:nowrap;
}
.data_infor_title,.data_all{
    font-size:12px;
    line-height:24px;
    color:#fbc5bf;
}
.data_all span{
    display:inline-block;
    color:#fff;
    padding: 0 3px;
    font-size:12px;
    text-align:center;
}
.ui-list-text li a {
    display: block;
}
.ui-list-text li i {
    width: 50px;
    height: 50px;
    background-size: 100%;
    border-radius: 100%;
}
        </style>
    </head>

    <body>
        <header class="site-header header-fixed">
            <a onclick="window.history.back();" class="back"></a>
            <div class="tit-name">粉丝关注</div>
        </header>
        <div class="main inivteFriend">
            <!-- 个人头像部分-->
            <div class="data_red_bg  android_infor  clearfix">
                <div class="data_img">
                    <img src="<?php echo to_media($member['avatar']?$member['avatar']:''); ?>" id="show_img" onerror="javascript:this.src='/uploads/avatar.png';" alt='用户头像' />
                </div>
                <div class="data_infor_wrapper">
                    <div class="data_infor">
                        <div class="data_use_name"><?php echo $member['username']; ?></div>
                    </div>
                    <div class="data_all">ID:<?php echo $member['uid']; ?>&nbsp;&nbsp;&nbsp;&nbsp;我的粉丝<span><?php echo $fans; ?></span>人&nbsp;&nbsp;&nbsp;&nbsp;我的关注<span><?php echo $follows; ?></span>人</div>
                </div>
                <div class="cl clear"></div>
            </div>
            <div class="member-tab">
                <ul class="add_friend_tab">
                    <li class="active">
                        <span>我的粉丝</span>
                    </li>
                    <li>
                        <a href="/home/fans/follow.html"><span>我的关注</span></a>
                    </li>
                </ul>
            </div>
            <div class="bk10">
            </div>
            <div class="task-list">
                <?php if(!empty($items)): ?>
                <div class="new-task-list">
                                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $list_index = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($list_index % 2 );++$list_index;?>
            <a href="/home/user/view/id/<?php echo $item['uid']; ?>">
            <ul class="ui-list-text reward-icon">
                <li class="clearfix">
                    <i class="iconfont" style="background-image: url(<?php echo to_media($item['avatar']?$item['avatar']:''); ?>);"></i>
                    <div class="ui-vertical">
                        <h3 class="ui-row">
                            <span class="fr"><?php echo $item['create_time']; ?></span>
                            <?php echo $item['username']; ?>
                        </h3>
                    </div>
                </li>
            </ul>
            </a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="paging" style="display: block;">
                    <span class="paging-prev">上一页</span>
                    <span class="paging-num-total">
                            <select name="page" class="paging-selct">
                                <?php $__FOR_START_1184248576__=1;$__FOR_END_1184248576__=$pageCount+1;for($i=$__FOR_START_1184248576__;$i < $__FOR_END_1184248576__;$i+=1){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </span>
                    <span class="paging-next" data-page="<?php echo $pageCount; ?>">下一页</span>
                    <form id="page_form">
                        <input type="hidden" name="page" value="1">
                    </form>
                </div>
                <?php endif; ?>
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

        <script type="text/javascript" src="/static/home/mobile/js/mytaskjoin.js?v=4"></script>
</body>

</html>