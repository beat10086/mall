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

	<style>
	      #addGoods{
	        background:#fff;
	        overflow:hidden;
	        padding-right:1.4%;
	      }
	 </style>
	 <script>
	    	var ThinkPHP={
	    		'CheckType':'<?php echo U("GoodType/checkType");?>',
	    		'INDEX':'<?php echo U("GoodType/Index");?>',
	    		'DELETE':'<?php echo U("GoodType/delType");?>'
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
                              <li class="active">商品类型</li>
                       </ol>
                    </div>
                    <div id="addGoods">
                          <button type="button" class="btn btn-primary btn-xs pull-right" id="addGoodType">
                              <span class="glyphicon glyphicon-plus"></span>添加类型
                          </button>
                    </div>
                    <div class="ibox-content">
                    	<?php if($type): ?><table class="table table-condensed table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>类型名称</th>
                                    <th style="width:190px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><tr>
	                                    <td><?php echo ($i); ?></td>
	                                    <td><?php echo ($type["type_name"]); ?></td>
	                                    <td>
	                                    	<button type="button" class="btn btn-primary btn-xs param_btn" data-url="/mall/Admin/GoodType/typeAttr/typeid/<?php echo ($type["goods_type_id"]); ?>/name/<?php echo ($type["type_name"]); ?>/type/0">
                                                 <span class="glyphicon  glyphicon-list" aria-hidden="true"></span>
                                                                                                                           参数
                                            </button>
                                            <button type="button" class="btn btn-primary btn-xs Spec_btn" data-url="/mall/Admin/GoodType/typeAttr/typeid/<?php echo ($type["goods_type_id"]); ?>/name/<?php echo ($type["type_name"]); ?>/type/1">
                                                 <span class="glyphicon glyphicon-th" aria-hidden="true"></span> 
                                                                                                                            规格
                                            </button>  
                                            <button type="button" class="btn btn-danger btn-xs deltype" data-id="<?php echo ($type["goods_type_id"]); ?>">
                                                 <span class="glyphicon  glyphicon-remove" aria-hidden="true"></span> 
                                                                                                                           删除
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
    <div class="modal fade" id="goodtypemodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="<?php echo U('GoodType/add');?>" method="POST" id="goodTypeForm">
                    <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			        <h4 class="modal-title" id="myModalLabel">添加类型</h4>
        			      </div>
        			      <div class="modal-body">
                                <div class="form-group">
                                    <label for="type_name">类型名称</label>
                                     <input type="text" class="form-control" id="type_name"  name="type_name"  
                                     autocomplete="off" placeholder="类型名称">
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

	<script src="/mall/PUBLIC/Admin/js/type.js"></script>

</body>
</html>