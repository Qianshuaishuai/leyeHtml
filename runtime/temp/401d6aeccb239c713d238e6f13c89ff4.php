<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:37:"./views/admin/pc/taskjoin/index.phtml";i:1541935409;s:59:"/www/wwwroot/leye/public/views/admin/pc/common/header.phtml";i:1541935409;s:60:"/www/wwwroot/leye/public/views/admin/pc/common/sidebar.phtml";i:1592312768;s:58:"/www/wwwroot/leye/public/views/admin/pc/taskjoin/nav.phtml";i:1541935409;s:59:"/www/wwwroot/leye/public/views/admin/pc/taskjoin/tabs.phtml";i:1541935409;s:59:"/www/wwwroot/leye/public/views/admin/pc/common/footer.phtml";i:1592313406;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理系统 | 管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- 弹出框 -->
    <link rel="stylesheet" type="text/css" href="/static/plugins/SmallPop/spop.min.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/static/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/static/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/static/plugins/Ionicons/css/ionicons.min.css">
    <!-- 图片展示插件样式 -->
    <link rel="stylesheet" href="/static/plugins/magnify/dist/jquery.magnify.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/static/plugins/AdminLTE/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/static/plugins/AdminLTE/css/skins/_all-skins.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/static/plugins/html5shiv.min.js"></script>
    <script src="/static/plugins/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/static/plugins/SmallPop/spop.min.js"></script>
    <!-- jQuery 3 -->
    <script src="/static/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- 剪切板 -->
    <script type="text/javascript" src="/static/plugins/clipboard.min.js"></script>
    <!-- 图片展示插件 -->
    <script type="text/javascript" src="/static/plugins/magnify/dist/jquery.magnify.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/static/plugins/AdminLTE/js/adminlte.min.js"></script>
    <!--引入JS-->
    <script src="/static/admin/web/js/global.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>系统</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>管理系统</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img onerror="this.src='/static/admin/web/images/avatar.png'" src="<?php echo to_media($admin['avatar']); ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $admin['username']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img onerror="this.src='/static/admin/web/images/avatar.png'" src="<?php echo to_media($admin['avatar']); ?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $admin['username']; ?>
                                    <small><?php echo date('Y年m月d日'); ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo U('index/profile'); ?>" class="btn btn-default btn-flat">资料设置</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo U('auth/login'); ?>" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img onerror="this.src='/static/admin/web/images/avatar.png'" src="<?php echo to_media($admin['avatar']); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $admin['username']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i>&#22312;&#32447;</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">&#21151;&#33021;&#33756;&#21333;</li>

            <?php if(is_array($treeMenu) || $treeMenu instanceof \think\Collection || $treeMenu instanceof \think\Paginator): $i = 0; $__LIST__ = $treeMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oo): $mod = ($i % 2 );++$i;if($oo['childnum'] == '0'): ?>
                <li <?php if(menuActive($oo['name'], $oo['level'])): ?>class="active"<?php endif; ?>><a href="<?php echo U($oo['name']); ?>"><i class="<?php echo $oo['icon']; ?>"></i><span><?php echo $oo['title']; ?></span></a></li>
                <?php elseif($oo['level'] == '1'): ?>
                <li class="treeview <?php if(menuActive($oo['name'], $oo['level'])): ?>active<?php endif; ?>">
                    <a href="javascript:void(0);">
                        <i class="<?php echo $oo['icon']; ?>"></i><span><?php echo $oo['title']; ?></span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                        <?php if(is_array($oo['children']) || $oo['children'] instanceof \think\Collection || $oo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $oo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$to): $mod = ($i % 2 );++$i;?>
                        <li <?php if(menuActive($to['name'])): ?>class="active"<?php endif; ?>><a href="<?php echo U($to['name']); ?>"><i class="<?php echo $to['icon']; ?>"></i><?php echo $to['title']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>

         

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <section class="content-header">
    <h1>
        任务数据
        <small>
            <?php if($action == 'index'): ?>
            任务数据
            <?php else: if(empty($item)): ?>添加任务<?php else: ?>修改任务<?php endif; endif; ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 任务数据</a></li>
        <li class="active">
            <?php if($action == 'index'): ?>
            任务列表
            <?php else: ?>
            查看任务
            <?php endif; ?>
        </li>
    </ol>
</section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
    <li <?php if(in_array($action,['index'])): ?>class="active"<?php endif; ?>>
        <a href="<?php echo U('index'); ?>">任务数据</a>
    </li>
    <?php if(in_array($action,['post']) && !empty($row['id'])): ?>
        <li class="active">
            <a href="<?php echo U('post', 'id=' . $row['id']); ?>">查看任务数据</a>
        </li>
    <?php endif; ?>
</ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="page-content">
                                <div class="panel panel-info">
                                    <div class="panel-heading">筛选</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员编号</label>
                                                <div class="col-sm-6 col-md-3 col-lg-3 col-xs-12">
                                                    <input type="text" class="form-control" name="uid" value="<?php echo !empty($params['uid'])?$params['uid']:''; ?>" placeholder="请输入会员编号">
                                                </div>
                                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">任务编号</label>
                                                <div class="col-sm-6 col-md-3 col-lg-3 col-xs-12 .col-md-offset-2">
                                                    <input type="text" class="form-control" name="title" value="<?php echo !empty($params['title'])?$params['title']:''; ?>" placeholder="请输入任务编号">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                 <label class="col-xs-12 col-sm-3 col-md-2 control-label">开始时间</label>
                                                 <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                    <input size="16" id="start_time" name="start_time" type="text" value="<?php echo !empty($params['start_time'])?$params['start_time']:''; ?>"  class="form-control datetime" placeholder="请选择开始时间" />
                                                 </div>
                                                 <label class="col-xs-12 col-sm-3 col-md-2 control-label">结束时间</label>
                                                 <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                    <input size="16" id="end_time" name="end_time" type="text" value="<?php echo !empty($params['end_time'])?$params['end_time']:''; ?>"  class="form-control datetime" placeholder="请选择结束时间" />
                                                 </div>

                                                <link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" />
                                                <script type="text/javascript" src="/static/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
                                                <script type="text/javascript" src="/static/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
                                                <script type="text/javascript">
                                                    $(function(){
                                                        $("#start_time").datetimepicker({
                                                            minView: "month",
                                                            format: 'yyyy-mm-dd',
                                                            language: 'zh-CN',
                                                            weekStart: 1,
                                                            todayBtn:  1,
                                                            todayHighlight: 1,
                                                            showClear: 1,
                                                            autoclose: true
                                                        }).on("click",function(){
                                                            $("#start_time").datetimepicker("setEndDate", $("#end_time").val());
                                                            $("#end_time").datetimepicker("setStartDate", $("#start_time").val());
                                                        });
                                                        $("#end_time").datetimepicker({
                                                            minView: "month",
                                                            format: 'yyyy-mm-dd',
                                                            language: 'zh-CN',
                                                            weekStart: 1,
                                                            todayBtn:  1,
                                                            todayHighlight: 1,
                                                            showClear: 1,
                                                            autoclose: true
                                                        }).on("click",function(){
                                                            $("#start_time").datetimepicker("setEndDate", $("#end_time").val());
                                                            $("#end_time").datetimepicker("setStartDate", $("#start_time").val());
                                                        });
                                                    });
                                                </script>
                                            </div>  

                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                                                <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="status[]" <?php if(!empty($_GET['status']) && in_array(1,$_GET['status'])): ?>checked<?php endif; ?> value="1">
                                                        已抢单
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="status[]" <?php if(!empty($_GET['status']) && in_array(2,$_GET['status'])): ?>checked<?php endif; ?> value="2">
                                                        待审核
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="status[]" <?php if(!empty($_GET['status']) && in_array(3,$_GET['status'])): ?>checked<?php endif; ?> value="3">
                                                        已审核
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="status[]" <?php if(!empty($_GET['status']) && in_array(4,$_GET['status'])): ?>checked<?php endif; ?> value="4">
                                                        审核未通过
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12 col-md-offset-2 col-lg-offset-2 col-sm-offset-4">
                                                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                                                    <!-- <input type="hidden" name="token" value="28ab76d3">
                                                    <input class="btn btn-primary" type="submit" name="export_submit" value="导出"> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <form method="post" class="form-horizontal" id="display_form">
                                    <input type="hidden" name="op" value="post_category">
                                    <input type="hidden" name="ac" value="delete">
                                    <div class="panel panel-default ">
                                        <div class="table-responsive panel-body">
                                            <table class="table table-hover">
                                                <thead class="navbar-inner">
                                                <tr>
                                                    <th style="width: 45px">删?</th>
                                                    <th>编号</th>
                                                    <th>会员编号</th>
                                                    <th>任务编号</th>
                                                    <th>审核状态</th>
                                                    <th>提交时间</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(!empty($list)): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ids[]" value="<?php echo $item['id']; ?>">
                                                        </td>
                                                        <td><?php echo $item['id']; ?></td>
                                                        <td><?php echo $item['uid']; ?></td>
                                                        <td><?php echo $item['task_id']; ?></td>
                                                        <td>
                                                            <?php if($item['status'] == 2): ?>
                                                            <label class="label label-info">待审核</label>
                                                            <?php elseif($item['status'] == 3): ?>
                                                            <label class="label label-success">通过审核</label>
                                                            <?php elseif($item['status'] == 4): ?>
                                                            <label class="label label-success">审核未通过</label>
                                                            <?php else: ?>
                                                            <label class="label label-danger">已抢单</label>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['update_time']; ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo U('post', 'id=' . $item['id']); ?>"  class="btn btn-sm btn-success">查看</a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" onclick="var ck = this.checked;$('table').find(':checkbox').each(function(){this.checked = ck});">
                                                        </td>
                                                        <td colspan="6">
                                                            <button class="btn btn-sm btn-danger" name="submit" type="button">删除</button>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                                <?php echo $pager; ?>
                                <script type="text/javascript">
                                    $(function () {
                                        $('button[name="submit"]').bind('click',function() {
                                            if (confirm('删除后不可恢复，您确定删除吗？')) {
                                                $.post(
                                                    window.location.href,
                                                    $('#display_form').serialize(),
                                                    function (ret) {
                                                        message(ret.message, ret.redirect, ret.type);
                                                    }, 'json'
                                                );
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>
            <!-- /.content-wrapper -->
            <footer class="main-footer"><div class="pull-right hidden-xs"></div>Copyright &copy; 2020 All rights reserved.</footer>
            <div class="control-sidebar-bg"></div>
        </div>
    </body>
</html>

