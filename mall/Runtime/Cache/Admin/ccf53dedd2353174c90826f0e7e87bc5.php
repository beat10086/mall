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
	     	    'delGoods':'<?php echo U("Goods/delGoods");?>',
	     	    'modifyPromote':'<?php echo U("Goods/modifyPromote");?>'
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
                              <li>订单管理</li>
                              <li class="active">订单列表</li>
                       </ol>
                    </div>
                    <div id="addGoods" >
                       <form  action="<?php echo U('Goods/index');?>" method="get">
                    	<div class="row">
                    	  <div class="col-md-3">
                    		 <select name="category_id" class="form-control">
	                                <option value="">所有栏目</option>
	                                <?php if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$categoryadd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($categoryadd["category_id"]); ?>" <?php if(($categoryadd["category_id"]) == $category_id): ?>selected="selected"<?php endif; ?>  path="<?php echo ($categoryadd["path"]); ?>">
                                           	   	   	 <?php if($categoryadd["path"] == '0' ): ?>├─<?php echo ($categoryadd["category_name"]); ?>
                                           	   	   	 <?php else: ?>
                                           	   	   	     <?php
 $nums=substr_count($categoryadd['path'],'-'); echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$nums).'└'; echo str_repeat('─',$nums).$categoryadd['category_name']; endif; ?>
                                           	   	   </option><?php endforeach; endif; else: echo "" ;endif; ?>
	                           </select>
	                      </div>
	                      <div class="col-md-3">
	                      	   <select name="brand_id" class="form-control">
	                      	   	    <option value="">所有品牌</option>
	                      	   	    <?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i;?><option value="<?php echo ($brand["brand_id"]); ?>" <?php if(($brand["brand_id"]) == $show_brand): ?>selected="selected"<?php endif; ?>   ><?php echo ($brand["brand_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	                      	   </select>
	                      </div>
	                      <div class="col-md-3">
	                      	   <select name="promote_type"  class="form-control">
						            <option value="">全部</option>
						            <option value="is_hot" <?php if(($promote_type) == "is_hot"): ?>selected="selected"<?php endif; ?> >热卖</option>
						            <option value="is_well" <?php if(($promote_type) == "is_well"): ?>selected="selected"<?php endif; ?> >人气</option>
						            <option value="is_first" <?php if(($promote_type) == "is_first"): ?>selected="selected"<?php endif; ?> >首发</option>
						        </select>
	                      </div>
	                      <div class="col-md-3">
	                      	    <select name="is_on_sale" class="form-control">
							            <option value="">全部</option>
							            <option value="1" <?php if(($is_on_sale) == "1"): ?>selected="selected"<?php endif; ?>>上架</option>
							            <option value="0" <?php if(($is_on_sale) == "0"): ?>selected="selected"<?php endif; ?>>下架</option>
							    </select>
	                      </div>
	                   </div>
	                   <div class="row" style="margin-top:10px;">
	                   	   <div class="col-md-3">
	                   	   	   <input type="text" name="keywords" value="<?php echo ($keywords); ?>" id="keywords" class="form-control">
	                   	   </div>
	                   	   <div class="col-md-3">
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
                    </div>
                    <div class="ibox-content" id="goods" style="margin-top:20px;border:none;">
                    	 <table class="table table-condensed table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                	<th style="width:2%;"><input type="checkbox" name="" class="select-all"></th>
                                    <th>订单号</th>
                                    <th>下单时间</th>
                                    <th>收货人</th>
                                    <th>收货地址</th>
                                    <th>总金额</th>
                                    <th>订单状态</th>
                                    <th>快递</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody> 	
                            	<?php if(is_array($allorder)): $i = 0; $__LIST__ = $allorder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$allorder): $mod = ($i % 2 );++$i;?><tr>
                            		<td style="width:2%;"><input type="checkbox" name="" class="select-name"></td>
                                    <td><?php echo ($allorder["order_sn"]); ?></td>
                                    <td><?php echo ($allorder["created"]); ?></td>
                                    <td>
                                    	<?php echo ($allorder["consignee"]); ?> [Mobile: <span style="color:#4face5;"><?php echo ($allorder["mobile"]); ?></span>]
                                    </td>
                                    <td><?php echo ($allorder["province"]); ?>-<?php echo ($allorder["city"]); ?>-<?php echo ($allorder["district"]); ?> <?php echo ($allorder["address"]); ?></td>
                                    <td>￥ <?php echo ($allorder["total_price"]); ?></td>
                                    <td><?php echo ($allorder["order_status"]); ?>,<?php echo ($allorder["pay_status"]); ?>,<?php echo ($allorder["ship_status"]); ?></td>
                                    <td><?php echo ($allorder["ship_name"]); ?></td>
                                    <td>
                                    	<a class="btn btn-primary btn-xs" href="/mall/Admin/Order/OrderInfo/id/<?php echo ($allorder["order_id"]); ?>" >
                                                <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> 查看
                                        </a>
                                        <a class="btn btn-success btn-xs cannel" href="" >
                                                <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> 取消
                                        </a>
                                    	<a class="btn btn-danger btn-xs del" href="" >
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 删除
                                        </a>
                                    </td>
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

	  <script src="/mall/PUBLIC/Admin/js/order.js"></script>

</body>
</html>