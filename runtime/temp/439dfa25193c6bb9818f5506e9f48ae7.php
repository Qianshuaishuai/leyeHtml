<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:42:"./views/home/mobile/mytaskjoin/index.phtml";i:1544348692;s:62:"/www/wwwroot/leye/public/views/home/mobile/common/header.phtml";i:1541935409;s:65:"/www/wwwroot/leye/public/views/home/mobile/mytaskjoin/_list.phtml";i:1541935409;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>我参与的</title>
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
    <style type="text/css">
        .task-list-remain-num span {
            width: 33.33%;
            float: left;
            text-align: center;
        }
        .paging {
            margin: 30px 0;
        }
        .dialog {
          position: fixed;
          left: 0;
          top: 0;
          z-index: 10001;
          width: 100%;
          height: 100%;
        }
        .dialog-content {
            width: 70%;
        }
        .dialog-overlay {
          position: absolute;
          top: 0;
          left: 0;
          z-index: 10002;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body data-offset="140" id="htmlBody">
<div class="site-header header-fixed">
    <a onclick="history.back()" class="back"></a>
    <div class="tit-name">我参与的</div>
</div>
<div class="main myAttend">
    <div class="zhuanghu-tab2">
        <ul class="zh-tab-tit">
            <li id="all" class="<?php echo $category_type=='all'?'active':'libg'; ?>" onclick="location.href='/home/mytaskjoin.html'">全部</li>
            <li id="lock" class="<?php echo $category_type=='lock'?'active':'libg'; ?>" onclick="location.href='/home/mytaskjoin/category/t/lock.html'">已抢单</li>
            <li id="wait" class="<?php echo $category_type=='wait'?'active':'libg'; ?>" onclick="location.href='/home/mytaskjoin/category/t/wait.html'">待审核</li>
            <li id="pass" class="<?php echo $category_type=='pass'?'active':'libg'; ?>" onclick="location.href='/home/mytaskjoin/category/t/pass.html'">通过</li>
            <li id="nopass" class="<?php echo $category_type=='nopass'?'active':'libg'; ?>" onclick="location.href='/home/mytaskjoin/category/t/nopass.html'">不通过</li>
        </ul>
    </div>
    <div class="task-list">
        <?php if(!empty($tasks)): ?>
        <div class="new-task-list">
                        <?php if(is_array($tasks) || $tasks instanceof \think\Collection || $tasks instanceof \think\Paginator): $task_index = 0; $__LIST__ = $tasks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$task): $mod = ($task_index % 2 );++$task_index;?>
            <ul class="ui-list-text reward-icon">
                <li class="clearfix">
                    <i class="iconfont" style="background-image: url(<?php echo $task['category_icon']; ?>);"></i>
                    <div class="ui-vertical">
                        <h3 class="ui-row"><span class="text-color-orange fr">￥<?php echo $task['unit_price']; ?></span><?php echo $task['title']; ?></h3>
                        <p>
                            <?php if($task['join_status'] == 1): ?>
                            <span class="fr">等待上传验证</span>
                            <?php echo $task['join_create_time']; ?>&nbsp;
                            抢单
                            <?php endif; if($task['join_status'] == 2): ?>
                            <span class="fr">等待雇主审核</span>
                            <?php echo $task['join_create_time']; ?>&nbsp;
                            抢单
                            <?php endif; if($task['join_status'] == 3): ?>
                            <span class="fr">奖励已发放</span>
                            <?php echo $task['join_audit_time']; ?>&nbsp;
                            审核
                            <?php endif; if($task['join_status'] == 4): ?>
                            <span class="fr">雇主拒绝了验证</span>
                            <?php echo $task['join_audit_time']; ?>&nbsp;
                            审核不通过
                            <?php endif; ?>
                        </p>
                    </div>
                </li>
                <?php if($task['join_status'] == 1): ?>
                <li class="operate ui-flex mb15">
                    <div class="ui-col text-color-blue l" onclick="check(<?php echo $task['id']; ?>)">
                    上传验证
                    </div>
                    <div class="ui-col text-color-blue l" onclick="remove(<?php echo $task['join_id']; ?>)">
                    放弃接单
                    </div>
                </li>
                <?php endif; if($task['join_status'] == 4): ?>
                <li class="operate ui-flex mb15">
                    <div class="ui-col text-color-blue l" onclick="check(<?php echo $task['id']; ?>)">
                    重新上传验证
                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="task-del" style="display:none;">
            <a href="#" class="button4" onclick="MySaveTask.delSave()">删除(0)</a>
        </div>
        <div class="paging" style="display: block;">
            <span class="paging-prev">上一页</span>
            <span class="paging-num-total">
                    <select name="page" class="paging-selct">
                        <?php $__FOR_START_650236507__=1;$__FOR_END_650236507__=$pageCount+1;for($i=$__FOR_START_650236507__;$i < $__FOR_END_650236507__;$i+=1){ ?>
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

<script type="text/javascript" src="/static/home/mobile/js/mytaskjoin.js?v=4"></script>
<script type="text/javascript">
function check(id){
    window.location.href = "/home/taskcheck/index/id/"+id+".html";
}

function remove(id) {
    $(document).dialog({
        type : 'confirm',
        titleText: '放弃接单',
        content: '确定要放弃任务ID为：' + id + '任务吗？',
        onClickConfirmBtn: function(){
            Common.loading.show();
            $.post('/home/mytaskjoin/del.html', { id: id }, function(res) {
                message(res.message,res.redirect,res.type);
                Common.loading.hide();
            });
        }
    });
}
</script>
</body>
</html>