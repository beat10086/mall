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

	<link rel="stylesheet" href="/mall/PUBLIC/Admin/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="all" href="/mall/PUBLIC/Admin/css/daterangepicker-bs3.css" />
	<link rel="stylesheet" href="/mall/PUBLIC/Admin/css/daterangepicker.css" rel="stylesheet">
	 <script>
	     var Thinkphp={
	     	   'updateAttr':'<?php echo U("User/updateAttr");?>'
	     }
	 </script>
	 <style>
	  .sursor{
	  	  cursor:pointer;
	  }
	 </style>

</head>  
<body>
	
	   <div  class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <ol class="breadcrumb">
                              <li>用户管理</li>
                              <li class="active">用户列表</li>
                       </ol>
                    </div>
                    <div id="addGoods" >
                       <form  action="<?php echo U('User/index');?>" method="get">
	                     <div class="row">
	                    	  <div class="col-md-4">
	                    	       <input type="text" name="username" autocomplete="off" placeholder="查询账号" value="<?php echo ($username); ?>"  class="form-control">
		                      </div>
		                      <div class="col-md-4">
		                      	<div class="input-prepend input-group">
								    <span class="add-on input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
									<?php if($created_start and $created_end): ?><input type="text"  id="created_time" autocomplete="off" readonly="readonly" placeholder="创建时间" value="<?php echo ($created_start); ?> - <?php echo ($created_end); ?>"  class="form-control">
		                              <?php else: ?>
		                                <input type="text"  id="created_time" autocomplete="off" readonly="readonly" placeholder="创建时间" value=""  class="form-control"><?php endif; ?>
		                           <input type="hidden"  name="created_start" value="<?php echo ($created_start); ?>" autocomplete="off">
		                           <input type="hidden"  name="created_end" value="<?php echo ($created_end); ?>"  autocomplete="off">
		                        </div>
		                      </div>
		                      <div class="col-md-4">
		                      	  <button type="submit" id="" class="btn btn-success">
	                   	   	   	       <i class="icon-search icon-white"></i> 搜索
	                   	   	      </button>
		                      </div>
		                </div>
                      </form>
                    </div>
                    <div>  
                          <a href="javascript:window.location.reload();" class="btn btn-primary  pull-right">
                              <span class="glyphicon glyphicon-refresh"></span> 刷新
                          </a>
                          <a href="javascript:void(0)" class="btn btn-primary  pull-right" onclick="alert('添加后面完成')" style="margin-right:10px;">
                              <span class="glyphicon glyphicon-plus"></span> 添加会员
                          </a>
                    </div>
                    <div class="ibox-content" id="goods" style="margin-top:20px;border:none;">
                    	 <table class="table table-condensed table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                	<th style="width:2%;">
                                		<input type="checkbox" name="" class="select-all">
                                    </th>
                                    <th style="width:5%;">用户名</th>
                                    <th style="width:15%;">电子邮件</th>
                                    <th style="width:15%;">注册时间</th>
                                    <th>最后登录时间</th>
                                    <th>最后登录IP</th>
                                    <th>是否禁止登陆</th>
                                    <th>禁止登陆原因</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody> 
                            	<?php if(is_array($userall)): $i = 0; $__LIST__ = $userall;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userall): $mod = ($i % 2 );++$i;?><tr class="user_tr" data-id="<?php echo ($userall["user_id"]); ?>">
                            	  	  <td>
                            	  	  	<input type="checkbox" name="select-name" value="<?php echo ($good["goods_id"]); ?>" />
                            	  	  </td>
                            	  	  <td><?php echo ($userall["username"]); ?></td>
                            	  	  <td><?php echo ($userall["email"]); ?></td>
                            	  	  <td><?php echo ($userall["created"]); ?></td>
                            	  	  <td><?php echo ($userall["last_login"]); ?></td>
                            	  	  <td><?php echo ($userall["last_ip"]); ?></td>
                            	  	  <td class="ban-click">
                            	  	  	 <?php if(($userall["ban"]) == "1"): ?><span class="label label-success sursor" type="ban" value="0">
                            	  	  	 	 	 <i class="glyphicon glyphicon-ok"></i>正常
                            	  	  	 	 </span>
                            	  	  	   <?php else: ?>
                            	  	  	     <span class="label label-important sursor" type="ban" value="1">
                            	  	  	     	  <i class="glyphicon glyphicon-remove"></i>禁用
                            	  	  	     </span><?php endif; ?>
                            	  	  </td> 
                            	  	  <td>
                            	  	  	<?php echo ($userall["ban_reason"]); ?>
                            	  	  </td>
                            	  	  <td>
                            	  	  	 <a  class="btn btn-primary btn-xs edit_brand_btn" href="javascript:void(0)" onclick="alert('编辑后面完成')">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 编辑
                                         </a>
                                         <button type="button" class="btn btn-danger btn-xs del_user_btn">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 删除
                                         </button>
                            	  	  </td>
                            	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                          </table>
                          <div class="pagination"><?php echo ($page); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="modal fade" id="userFiltermodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="" method="POST" id="userBanForm" class="form-horizontal">
                    <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">你确定要禁止要该用户</h4>
                    </div>
                    <div class="modal-body fiter-modal-body">
                    	 <textarea class="form-control" name="ban_reason" rows="3" style="resize:none;">禁止该用户的原因</textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                      <button type="submit" class="btn btn-primary" id="banAttr">确定</button>
                    </div>
                  </div>
                </form>
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

	  <script src="/mall/PUBLIC/Admin/js/moment.min.js"></script>
	  <script src="/mall/PUBLIC/Admin/js/daterangepicker.js"></script>
	  <script src="/mall/PUBLIC/Admin/js/user.js"></script>

</body>
</html>