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

<script>
	  var ThinkPHP={
	    		'CONTROLLER':'/mall/Admin/GoodType',
	    		'PAGE':'<?php echo ($_GET['p']); ?>',
	    		'typeid':'<?php echo ($_GET['typeid']); ?>',
	    		'name':'<?php echo ($_GET['name']); ?>'
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
	                              <li><a href="<?php echo U('GoodType/index');?>">商品管理</a></li>
	                              <li><a href="<?php echo U('GoodType/index');?>">商品类型</a></li>
	                              <li class="active">
	                              	 <?php if($type == ''): ?>全部
	                              	     <?php elseif($type == 0): ?>
	                              	             参数
	                              	     <?php else: ?>
	                              	             规格<?php endif; ?>    
	                              </li>
	                       </ol>
	                    </div>
	                    <div id="addGoods" style="padding:5px 0;overflow:hidden;">
	                    	  <select id="change-type" class="form-control pull-left" style="width:200px;padding:3px 0;height:25px;font-size:12px;margin-left:10px;">
	                    	  	     <?php if(is_array($good_type)): $i = 0; $__LIST__ = $good_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good_type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($good_type["goods_type_id"]); ?>" <?php if(($good_type["goods_type_id"]) == $_GET['typeid']): ?>selected='selected'<?php endif; ?> ><?php echo ($good_type["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	                    	  </select>
	                    	  <select id="change-param" class="form-control pull-left" style="width:200px;padding:3px 0;height:25px;font-size:12px;margin-left:10px;">
	                    	  	    <option  value=""  <?php if(empty($type)): if(($type) == ""): ?>selected='selected'<?php endif; endif; ?>>全部</option>
	                    	  	    <option  value="0" <?php if(($type) == "0"): ?>selected='selected'<?php endif; ?>>参数</option>
	                    	  	    <option  value="1" <?php if(($type) == "1"): ?>selected='selected'<?php endif; ?>>规格</option>
	                    	  </select>
	                          <button type="button" class="btn btn-primary btn-xs pull-right" id="addGoodTypeAttr">
	                              <span class="glyphicon glyphicon-plus"></span>添加参数
	                          </button>
	                    </div>
	                    <div class="ibox-content">
	                     <?php if($typeAttr): ?><table class="table table-condensed table-striped table-bordered table-hover">
	                            <thead>
	                                <tr>
	                                        <th width="3%">ID</th>
									        <th width="10%">参数名称</th>
									        <th width="50%">可选值</th>
									        <th width="8%">排序</th>
									        <th width="10%">类型</th>
									        <th width="10%">操作</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                               <?php if(is_array($typeAttr)): $i = 0; $__LIST__ = $typeAttr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$typeAttr): $mod = ($i % 2 );++$i;?><tr data-goods-attr="<?php echo ($typeAttr["goods_attr_id"]); ?>">
		                                <td><?php echo ($i); ?></td>
		                                <td><?php echo ($typeAttr["attr_name"]); ?></td>
		                                <td>
		                                  <?php
 echo preg_replace('/\s/','',$typeAttr['attr_may_value']) ?>
		                                </td>
		                                <td>
		                                	<input type="text" AUTOCOMPLETE="off" value="<?php echo ($typeAttr["sort"]); ?>" class="attr_sort">
		                                </td>
		                                <td>
		                                	<?php if($typeAttr["attr_type"] == 0): ?><span class="label label-primary">参数</span>
		                                	  <?php else: ?>
		                                	      <span class="label label-primary">规格</span><?php endif; ?>
		                                </td>
		                                <td>
		                                	<button type="button" class="btn btn-primary btn-xs edit_attr_btn">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>编辑
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除
                                            </button>
		                                </td>
		                              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	                            </tbody>
	                            </table>
	                            <div class="pagination"><?php echo ($page); ?></div>
	                           <?php else: ?> 
	                           <span class="error_info">没有数据</span><?php endif; ?>
	                    </div>
	                </div>
	            </div>
	     </div> 
    </div>
    <div class="modal fade" id="goodtypeAttrmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="<?php echo U('GoodType/addTypeAttr');?>" method="POST" id="goodTypeAttrForm">
                    <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			        <h4 class="modal-title" id="myModalLabel">添加类型---<?php echo (urldecode($_GET['name'])); ?></h4>
        			      </div>
        			      <div class="modal-body">
                                <div class="form-group">
                                     <label for="attr_name">参数名称</label>
                                     <input type="text" class="form-control" autocomplete="off" id="attr_name"  name="attr_name"  autocomplete="off" placeholder="参数名称">
                                </div>
                                 <div class="form-group">
                                 	<label >类型</label>
                                    <label style="margin-right:20px;">
											     <input type="radio" name="attr_type"  value="0" <?php if($_GET['type']== 0): ?>checked<?php endif; ?> >参数
									</label>
									<label>
											     <input type="radio" name="attr_type"  value="1" <?php if($_GET['type']== 1): ?>checked<?php endif; ?>>规格
									</label>    	
                                </div>
                                <div class="form-group">
                                     <label for="attr_may_value">预可选值</label>
                                     <textarea class="form-control" autocomplete="off" rows="3" style="resize:none;" name="attr_may_value" id="attr_may_value"></textarea>
                                </div>
                                <input type="hidden" value="<?php echo ($_GET['typeid']); ?>" name="type">
                                <input type="hidden" value="<?php echo ($_GET['name']); ?>" name="name">
                                <div id="errors" style="color:#c90000;"></div>
        			      </div>
        			      <div class="modal-footer">
        			        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        			        <button type="submit" class="btn btn-primary" id="add_good_typeAttr">确定</button>
        			      </div>
                  </div>
                </form>
            </div>
          </div>
          <div class="modal fade" id="editortypeAttrmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="<?php echo U('GoodType/editorTypeAttr');?>" method="POST" id="editorTypeAttrForm">
                    <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			        <h4 class="modal-title" id="myModalLabel">添加类型---<?php echo (urldecode($_GET['name'])); ?></h4>
        			      </div>
        			      <div class="modal-body">
                                <div class="form-group">
                                     <label for="attr_name_editor">参数名称</label>
                                     <input type="text" class="form-control" autocomplete="off" id="attr_name_editor"  name="attr_name_editor"  autocomplete="off" placeholder="参数名称">
                                </div>
                                 <div class="form-group">
                                     <label style="margin-right:20px;">类型</label>
									 <label style="margin-right:20px;">
											     <input type="radio" name="attr_type_editor"  value="0" checked>参数
									 </label>
									 <label>
											     <input type="radio" name="attr_type_editor"  value="1">规格
									 </label>
                                </div>
                                <div class="form-group">
                                     <label for="attr_may_value_editor">预可选值</label>
                                     <textarea class="form-control" autocomplete="off" rows="3" style="resize:none;" name="attr_may_value_editor" id="attr_may_value_editor"></textarea>
                                </div>
                                <input type="text" value="" name="goods_attr_id">
                                <input type="text" value="<?php echo ($_GET['typeid']); ?>" name="type">
                                <input type="text" value="<?php echo ($_GET['name']); ?>" name="name">
                                <div id="errors" style="color:#c90000;"></div>
        			      </div>
        			      <div class="modal-footer">
        			        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        			        <button type="submit" class="btn btn-primary" id="add_good_typeAttr">确定</button>
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

	<script src="/mall/PUBLIC/Admin/js/typeattr.js"></script>

</body>
</html>