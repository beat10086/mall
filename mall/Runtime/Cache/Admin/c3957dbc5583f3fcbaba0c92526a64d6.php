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
	    var Thinkphp={
	    	   'updateProduct':'<?php echo U("Goods/updateProduct");?>'
	    }
	 </script>
	 <style>
	     
	 </style>

</head>  
<body>
	
	   <div  class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <ol class="breadcrumb">
                              <li>商品管理</li>
                              <li class="active">商品货号</li>
                       </ol>
                    </div>
                     <div>
                          <a href="<?php echo ($url); ?>" class="btn btn-primary  pull-right">
                              <span class="glyphicon glyphicon-backward"></span>返回
                          </a>
                    </div>
                    <div id="addGoods"></div>
                    <div class="ibox-content" id="goods" style="margin-top:20px;border:none;">
                    	 <div id="product-list">
                    	  <table class="table table-condensed table-striped table-bordered table-hover">
                    	  	  <tr colspan='5'>
                    	  	  	  <p class="text-info">商品名称：<?php echo ($goods["goods_name"]); ?></p>
                    	  	  </tr>
                    	  	  <tr>
					            <th>规格组合</th>
					            <th>编号</th>
					            <th>价格</th>
					            <th>库存</th>
					            <th>操作</th>
					        </tr>
					        <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($i % 2 );++$i;?><tr product-id="<?php echo ($product["product_id"]); ?>">
						            <td>
						                <?php echo ($product["spec"]); ?>
						            </td>
						            <td>
						                <input type="text" name="goods_sn" class="form-control" value="<?php echo ($product["goods_sn"]); ?>" />
						            </td>
						            <td>
						                <input type="text" name="goods_price" class="form-control" value="<?php echo ($product["goods_price"]); ?>" />
						            </td>
						            <td>
						                <input type="text" name="sku" class="form-control" value="<?php echo ($product["SKU"]); ?>" />
						            </td>
						            <td>
						                <a href="" class="del"><i class="icon-trash"></i> 删除</a>
						            </td>
						        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                          </table>
                        </div>
                        <div id="add-product">
                        	 <table class="table table-condensed table-striped table-bordered table-hover">
                        	    <tr>
                        	      <td>
                                     <b>添加新货品</b>
                                  </td>
                                 </tr>
                                 <tr>
                                 	  <?php if(is_array($specs )): $i = 0; $__LIST__ = $specs ;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$specs1): $mod = ($i % 2 );++$i;?><th><?php echo ($specs1["attr_name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                                 	  <th>编号</th><th>价格</th><th>库存</th>
                                 </tr>
                                 <tr>
	                                 	  <?php if(is_array($specs)): $i = 0; $__LIST__ = $specs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$specs2): $mod = ($i % 2 );++$i;?><td>
		                                 	 	 <select name="spec[0][spec_id][<?php echo ($specs2["goods_attr_id"]); ?>]" id="" class="form-control">
		                                 	 	    <option value="">请选择</option>
		                                 	 	    <?php
 $option=''; $specs2['attr_may_value']=str_replace("，",",",$specs2['attr_may_value']); $attr_may_value=explode(',',$specs2['attr_may_value']); if(is_array($attr_may_value)){ foreach($attr_may_value as $v){ $option.='<option value="'.$v.'">'.$v.'</option>'; } } echo $option; ?>
		                                 	 	 </select>
	                                 	 	 </td><?php endforeach; endif; else: echo "" ;endif; ?>
	                                 	  <td><input type="text" name="spec[0][goods_sn]" id="" class="form-control"></td>
	                                 	  <td><input type="text" name="spec[0][goods_price]" id="" class="form-control"></td>
	                                 	  </td>
	                                 	  <td><input type="text" name="spec[0][goods_SKU]" id="" class="form-control"></td>  
                                 </tr>
                                 <tr>
                                 	 <td colspan="<?php echo count($specs)+3;?>">
                                          <a href="javascript:void(0)" id="add-product"><i class="icon-plus"></i> 增加一项</a>
                                          <input type="submit" value="添加货品" class="btn btn-primary" />
                                     </td>
                                 </tr>
                        	 </table>
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

	  <script src="/mall/PUBLIC/Admin/js/goodsproduct.js"></script>

</body>
</html>