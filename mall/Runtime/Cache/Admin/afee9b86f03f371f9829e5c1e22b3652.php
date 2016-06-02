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

	<link href="/mall/PUBLIC/Admin/css/uploadify.css" rel="stylesheet">
	<link rel="stylesheet" href="/mall/PUBLIC/Admin/uploadify/jquery.uploadify.min.js">
	<link rel="stylesheet" href="/mall/PUBLIC/Admin/uploadify/uploadify.css">
	<style type="text/css">
		 .show_status{
		 	  cursor:pointer;
		 }
	</style>
	<script>
	    var Think={
	    	  'uploadify':'/mall/PUBLIC/Admin/uploadify',
	    	  'IMAGEURL' :'<?php echo U("File/image");?>',
	    	  'checkBrand':'<?php echo U("Brand/check_brand");?>',
	    	  'editBrand':'<?php echo U("Brand/editBrand");?>',
	    	  'delBrand':'<?php echo U("Brand/delBrand");?>'
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
                              <li>商品管理</li>
                              <li class="active">品牌管理</li>
                       </ol>
                    </div>
                    <div id="addGoods">
                          <button type="button" class="btn btn-primary btn-xs pull-right" id="brandType">
                              <span class="glyphicon glyphicon-plus"></span>添加品牌
                          </button>
                    </div>
                    <div class="ibox-content">
                    	 <table class="table table-condensed table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>品牌名称</th>
                                    <th>L0GO</th>
                                    <th style="width:400px;">描述</th>
                                    <th style="width:80px;">排序</th>
                                    <th style="width:120px;">状态</th>
                                    <th style="width:190px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i;?><tr data-brand-id="<?php echo ($brand["brand_id"]); ?>">
	                                    <td><?php echo ($i); ?></td>
	                                    <td><?php echo ($brand["brand_name"]); ?></td>
	                                    <td>
	                                       <img src="/mall<?php echo ($brand["brand_logo"]); ?>" />	
                                        </td>
                                        <td>
                                        	<?php echo (mb_substr($brand["desc"],0,120)); ?>
                                        </td>
                                        <td>
                                        	  <input type="text" class="form-control" autocomplete="off" value="<?php echo ($brand["sort"]); ?>">
                                        </td>
                                        <td>
                                        	<?php if($brand["status"] == 1): ?><span class="label label-primary show_status" data-status="<?php echo ($brand["status"]); ?>">显示</span>
                                        		 <?php else: ?>
                                        		   <span class="label label-primary show_status" data-status="<?php echo ($brand["status"]); ?>">隐藏</span><?php endif; ?>
                                        </td>
                                        <td>
                                        	<button type="button" class="btn btn-primary btn-xs edit_brand_btn">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>编辑
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs del_brand_btn">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除
                                            </button>
                                        </td>
	                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="brandmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                  <form action='<?php echo U("Brand/addBrand");?>' method="POST" id="brandForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        			        	<span aria-hidden="true">&times;</span>
        			        </button>
        			        <h4 class="modal-title" id="myModalLabel">添加品牌</h4>
        			      </div>
        			      <div class="modal-body">        
                                <div class="form-group">
                                    <label for="brand_name" class="col-sm-4 control-label">品牌名称：</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="brand_name"  name="brand_name"  
                                        autocomplete="off" placeholder="品牌名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                     <label for="brand_name_en" class="col-sm-4 control-label">品牌名称（英文）：</label>
                                     <div class="col-sm-8">
                                         <input type="text" class="form-control" id="brand_name_en"  name="brand_name_en"  
                                         autocomplete="off" placeholder="品牌名称(英文)">
                                     </div>
                                </div>
                                <div class="form-group">
                                	 <label for="brand_name_en" class="col-sm-4 control-label">品牌LOGO:</label>
                                	 <div class="col-sm-8">
                                	       <input type="file" name="brand_logo" id="brand_logo"/>
                                	       <input type="text" name="brand_logo_url" readonly="readonly">
                                	 </div>
                                </div>
                                <div class="form-group">
                                	 <label for="website" class="col-sm-4 control-label">品牌官网：</label>
                                	 <div class="col-sm-8">
                                	     <input type="text" class="form-control" id="website"  name="website"  autocomplete="off" placeholder="品牌官网">
                                     </div>
                                </div>
                                <div class="form-group">
                                	<label style="padding-top:0" class="col-sm-4 control-label">状态</label>
                                	<div class="col-sm-8">
										<label style="margin-right:20px;">
												     <input type="radio" name="brand_status"  value="1" checked>开启
										</label>
										<label>
												     <input type="radio" name="brand_status"  value="0">关闭
										</label>
									</div>
                                </div>
                                <div class="form-group">
                                	 <label for="desc" class="col-sm-4 control-label">品牌描述</label>
                                	 <div class="col-sm-8">
                                	    <textarea class="form-control" autocomplete="off" rows="3" style="resize:none;" name="desc" id="desc"></textarea>
                                     </div>
                                </div>
                                <div id="errors" style="color:#c90000;"></div>
                                
        			      </div>
        			      <div class="modal-footer">
        			        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        			        <button type="submit" class="btn btn-primary" id="add_good_type">确定</button>
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

	<script src="/mall/PUBLIC/Admin/js/jquery.uploadify.min.js"></script>
	<script src="/mall/PUBLIC/Admin/js/brand.js"></script>

</body>
</html>