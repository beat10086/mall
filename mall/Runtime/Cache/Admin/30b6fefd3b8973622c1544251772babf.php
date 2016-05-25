<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>电商后台</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/mall/PUBLIC/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="/mall/PUBLIC/Admin/img/profile_small.jpg" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs">
                                    	<strong class="font-bold"><?php echo ($_SESSION['admin']['username']); ?></strong>
                                    </span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                                </li>
                                <li><a class="J_menuItem" href="profile.html">个人资料</a>
                                </li>
                                <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                                </li>
                                <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo U('Login/layout');?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">H+
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">商品管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Goods/index');?>">商品列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Goods/addGoods');?>">添加商品</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Category/index');?>">商品栏目</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Goods/goodType');?>">商品类型</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Brand/index');?>">品牌管理</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">用户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Goods/index');?>">管理员</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Goods/index');?>">管理员日志</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Goods/index');?>">用户管理</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1" >
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                           <i class="fa fa-bars"></i> 
                        </a>
                    </div>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<?php echo U('Login/layout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="" frameborder="0" >
                </iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2014-2015 
                   <a href="javascript:void(0)">lei</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--mini聊天窗口开始-->
        
    </div>
    <script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/mall/PUBLIC/Admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/mall/PUBLIC/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/mall/PUBLIC/Admin/js/plugins/layer/layer.min.js"></script>
    <script src="/mall/PUBLIC/Admin/js/hplus.min.js?v=4.0.0"></script>
    <script type="text/javascript" src="/mall/PUBLIC/Admin/js/contabs.min.js"></script>
    <script src="/mall/PUBLIC/Admin/js/plugins/pace/pace.min.js"></script>
</body>

</html>