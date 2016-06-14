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
    <meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">  
<link rel="shortcut icon" href="favicon.ico">
<link href="/mall/PUBLIC/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
<!-- Data Tables -->
<link href="/mall/PUBLIC/Admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/animate.min.css" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/page.css?v=4.0.0" rel="stylesheet">

</head>  
<body>
	
    <div  class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <ol class="breadcrumb">
                              <li>用户管理</li>
                              <li class="active">管理员日志</li>
                       </ol>
                    </div>
                    <div class="ibox-content">
                    	 <table class="table table-condensed table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>管理员</th>
                                    <th>操作时间</th>
                                    <th>登陆IP</th>
                                    <th style="width:400px;">操作的内容</th>
                                </tr>
                            </thead>
                            <tbody>
                            	 <?php if(is_array($admin_log)): $i = 0; $__LIST__ = $admin_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_log): $mod = ($i % 2 );++$i;?><tr>
	                            	  	 <td><?php echo ($i); ?></td>
	                                     <td><?php echo ($admin_log["admin_username"]); ?></td>
	                                     <td><?php echo (date("Y-m-d h:i:s",$admin_log["created_time"])); ?></td>
	                                     <td><?php echo ($admin_log["login_ip"]); ?></td>
	                                     <td><p class="text-success"><?php echo ($admin_log["con"]); ?></p></td>
	                            	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/layer/layer.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrapValidator.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/common.js"></script>

</body>
</html>