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
	  <link rel="stylesheet" href="/mall/PUBLIC/Admin/uploadify/uploadify.css">
	  <style>
	     .tips{
	     	display:inline-block; 
	     	padding: 6px 12px;
	     	}
	  </style>
	  <script type="text/javascript" charset="utf-8">
	      var flage_type=true;
		  var Thinkphp={
		  	    ROOT:'/mall',
		  }
	  </script>

</head>  
<body>
	
	<div  class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <ol class="breadcrumb">
                              <li>广告管理</li>
                              <li class="active">广告列表</li>
                       </ol>
                    </div>
                    <div class="ibox-content">
                    	  <ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class="active">
							    	<a href="#ads_list" aria-controls="ads_list" role="tab" data-toggle="tab">广告列表</a>
							    </li>
							    <li role="presentation">
							    	<a href="#add_ads" aria-controls="add_ads" role="tab" data-toggle="tab">添加广告</a>
							    </li>
							    <li role="presentation">
							    	<a href="#ads_position_manage" aria-controls="ads_position_manage" role="tab" data-toggle="tab">广告位管理</a>
							    </li>
							    <li role="presentation">
							    	<a href="#ads_position" aria-controls="ads_position" role="tab" data-toggle="tab">添加广告位</a>
							    </li>
                         </ul>
                         
	                         <div class="tab-content" style="margin-top:10px;">
								    <div role="tabpanel" class="tab-pane fade in active" id="ads_list">
								    </div>
								    <div role="tabpanel" class="tab-pane fade" id="add_ads">
								    	<form action="<?php echo U('Ads/addAds');?>" method="post" class="form-horizontal" enctype="multipart/form-data"> 	
								    	 	<div class="form-group">
                                               <label class="col-sm-2 control-label" for="ads_title">广告标题：</label>
                                                 <div class="col-sm-4">
                                                   <input id="ads_title" class="form-control" type="text" placeholder="广告标题" autocomplete="off" name="ads_title">
											     </div>
											</div>
											<div class="form-group">
                                               <label class="col-sm-2 control-label" for="ads_title">位置：</label>
                                               <div class="col-sm-4">
                                                   <select name="position_id" class="form-control">
                                                   	  <option value="">请选择</option>
                                                   	  <?php if(is_array($adsposition)): $i = 0; $__LIST__ = $adsposition;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adsposition2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($adsposition2["position_id"]); ?>"><?php echo ($adsposition2["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                   </select>
											   </div>
											</div>
											<div class="form-group">
			                                    <label class="col-sm-2 control-label" for="ads_time">广告日期：</label>
			                                    <div class="col-sm-4"> 
			                                    	  <div class="input-prepend input-group">
		                                                   <span class="add-on input-group-addon">
		                                                       <i class="glyphicon glyphicon-calendar"></i>
		                                                   </span>
		                                                   <input type="text" readonly="readonly" style="width: 200px" name="ads_time" value="" autocomplete="off" class="form-control" id="ads_time">
		                                                   <input type="hidden" autocomplete="off" name="addtime">
		                                                   <input type="hidden" autocomplete="off" name="endtime">
		                                              </div>
			                                    </div>
		                                     </div>
		                                     <div class="form-group">
                                               <label class="col-sm-2 control-label" for="ads_status">状态：</label>
                                               <div class="col-sm-4">
                                                      <label class="radio-inline">
													      <input type="radio" name="ads_status" value="1" style="margin-top:2px;">开启
													  </label>
													  <label class="radio-inline">
													      <input type="radio" name="ads_status"  value="0" style="margin-top:2px;">关闭
													  </label>
											   </div>
											</div>
											<div class="form-group">
                                               <label class="col-sm-2 control-label" for="ads_title">投放栏目：</label>
                                               <div class="col-sm-4">
                                                   <select name="category_id" class="form-control">
                                                   	  <option value="">请选择</option>
                                                   	    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$categoryadd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($categoryadd["category_id"]); ?>" path="<?php echo ($categoryadd["path"]); ?>">
		                                           	   	   	 <?php if($categoryadd["path"] == '0' ): ?>├─<?php echo ($categoryadd["category_name"]); ?>
		                                           	   	   	 <?php else: ?>
		                                           	   	   	     <?php
 $nums=substr_count($categoryadd['path'],'-'); echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$nums).'└'; echo str_repeat('─',$nums).$categoryadd['category_name']; endif; ?>
		                                           	   	   </option><?php endforeach; endif; else: echo "" ;endif; ?> 
                                                   </select>
											   </div>
											</div>
									    </form>
								    </div>
								    <div role="tabpanel" class="tab-pane fade" id="ads_position_manage">
								    	 <table class="table table-striped">
								    	 	 <tr>
									            <th>广告位名称</th>
									            <th>调用ID</th>
									            <th>调用名称</th>
									            <th>属性</th>
									            <th>编辑</th>
									        </tr>
									        <?php if(is_array($adsposition)): $i = 0; $__LIST__ = $adsposition;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adsposition1): $mod = ($i % 2 );++$i;?><tr>
										            <td><?php echo ($adsposition1["title"]); ?></td>
										            <td><?php echo ($adsposition1["position_id"]); ?></td>
										            <td><?php echo ($adsposition1["pname"]); ?></td>
										            <td><?php echo ($adsposition1["type"]); ?></td>
										            <td>
										            	<a class="btn btn-primary btn-xs edit_brand_btn" href="javascript:void(0)">
                                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>编辑
                                                        </a>
                                                        <button class="btn btn-danger btn-xs del_brand_btn" type="button">
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除
                                                        </button>
										            </td>
										        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                         </table>	  
								    </div>
									 <div role="tabpanel" class="tab-pane fade" id="ads_position">
									 	<form action="<?php echo U('Ads/addAdvert');?>" class="form-horizontal" method="post" id="addAdsPositionForm">
										    <div class="form-group">
								    	  	        	<label for="ads_title" class="col-sm-2 control-label">广告位名称</label>
												        <div class="col-sm-6">
								                           <input type="text" class="form-control" name="ads_title" id="ads_title" autocomplete="off" placeholder="广告位名称">	        
												        </div>
								    	  	 </div>
								    	  	 <div class="form-group">
								    	  	  	     <label for="ads_call" class="col-sm-2 control-label">调用名称：</label>
												     <div class="col-sm-5">
												     	    <div class="form-group">
												     	    	 <div class="col-sm-8">
														            <input type="text" class="form-control" name="ads_call" id="ads_call" placeholder="调用名称">
														         </div>
														         <div class="col-sm-4">
														           <span class="tips">* 在模板中调用，只能为字母</span>
														         </div>
														    </div>
													 </div>
								    	  	  </div>
								    	  	  <div class="form-group">
								    	  	  	     <label  class="col-sm-2 control-label">广告位类型：</label>
												     <div class="col-sm-5">
												     	    <div class="form-group">
												     	    	<?php if(is_array($add_type)): foreach($add_type as $key=>$add_type): ?><label class="radio-inline" style="margin-left:8px;">
		                                                                 <input type="radio" name="type"  value="<?php echo ($key); ?>" <?php if(($key) == "1"): ?>checked<?php endif; ?> style="margin-top:3px;"> <?php echo ($add_type); ?>
		                                                             </label><?php endforeach; endif; ?>
														    </div>
													 </div>
								    	  	  </div>  
						                      <p style="margin-top:10px;margin-left:170px;">
													 <input class="btn btn-primary" type="submit" onclick="return checkAdsPosition()" value="添加">
										      </p>	
								        </form>
								     </div>
	                         </div>
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

	<script src="/mall/PUBLIC/Admin/js/jquery.uploadify.min.js"></script>
	<script src="/mall/PUBLIC/Admin/js/moment.min.js"></script>
	<script src="/mall/PUBLIC/Admin/js/daterangepicker.js"></script>
 	<script src="/mall/PUBLIC/Admin/js/ads.js"></script>

</body>
</html>