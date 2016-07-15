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
	    .table-base-style{
	    	  margin-top:10px;
	    }
	    .table-base-tr-title{
	    	 background:#d5fff6;
	    	 color:#666;
	    }
	    .table-base-tr-title th{
	    	text-align:center;
	    }
	    .th-center th,.td-center td{
	    	  text-align:center;
	    }
	    .img_b{
	    	 border:1px solid #ddd;
	    }
	    .total_price{
	    	 color:red;
	    }
	  </style>
	  <script>
	      var flage_type=false;
		  var Thinkphp={ 
		  	      url:'<?php echo ($url); ?>'
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
                              <li>订单管理</li>
                              <li class="active">订单信息</li>
                       </ol>
                    </div>
                    <div>
                          <a href="<?php echo ($url); ?>" class="btn btn-primary  pull-right">
                              <span class="glyphicon glyphicon-backward"></span> 返回
                          </a>
                    </div>
                    <div class="ibox-content" style="padding:0;">	
                    	 <table class="table table-bordered table-base-style">
                    	 	<tr class="table-base-tr-title">
                    	 	    <th  colspan="4">基本信息</th>
                    	    </tr>
                    	    <tr>
						        <td style="width:20%;">订单号：</td>
						        <td style="width:30%;"><?php echo ($order["order_sn"]); ?></td>
						        <td style="width:20%;">购买用户：</td>
						        <td style="width:30%;">
						            <?php echo ($order["extend"]["username"]); ?>
						        </td>
                            </tr>
                            <tr>
						        <td style="width:20%;">订单状态：</td>
						        <td style="width:30%;"><?php echo ($order["order_status"]); ?>,<?php echo ($order["pay_status"]); ?>,<?php echo ($order["ship_status"]); ?></td>
						        <td style="width:20%;">下单时间：</td>
						        <td style="width:30%;">
						            <?php echo ($order["created"]); ?>
						        </td>
                            </tr>
                            <tr>
						        <td style="width:20%;">物流方式：</td>
						        <td style="width:30%;"><?php echo ($order["ship_name"]); ?></td>
						        <td style="width:20%;">支付时间：</td>
						        <td style="width:30%;">
						            <?php if(order.pay_time != 0): echo ($order["pay_time"]); ?>
						            	   <?php else: ?>
						            	未支付<?php endif; ?>
						        </td>
                            </tr>
                            <tr>
						        <td style="width:20%;">付款方式：</td>
						        <td style="width:30%;"><?php echo ($order["pay_name"]); ?></td>
						        <td style="width:20%;">发货时间：</td>
						        <td style="width:30%;">
						            <?php if(order.ship_time != 0): echo ($order["pay_time"]); ?>
						            	   <?php else: ?>
						            	 未发货<?php endif; ?>
						        </td>
                            </tr>
                    	 </table>
                    	 <table class="table table-bordered table-base-style">
                    	 	<tr class="table-base-tr-title">
                    	 	    <th  colspan="4">收货人信息</th>
                    	    </tr>
                    	    <tr>
						        <td style="width:20%;">收货人:</td>
						        <td style="width:30%;"><?php echo ($order["consignee"]); ?></td>
						        <td style="width:20%;">手机：</td>
						        <td style="width:30%;">
						            <?php echo ($order["mobile"]); ?>
						        </td>
                            </tr>
                            <tr>
						        <td style="width:20%;">地区:</td>
						        <td style="width:30%;"><?php echo ($order["province"]); ?>-<?php echo ($order["city"]); ?>-<?php echo ($order["district"]); ?></td>
						        <td style="width:20%;">详细地址：</td>
						        <td style="width:30%;">
						            <?php echo ($order["address"]); ?>
						        </td>
                            </tr>
                            <tr>
						        <td style="width:20%;">电话:</td>
						        <td style="width:30%;"><?php echo ($order["tel"]); ?></td>
						        <td style="width:20%;">邮编：</td>
						        <td style="width:30%;">
						            <?php echo ($order["zipcode"]); ?>
						        </td>
                            </tr>
                    	 </table>
                    	 <table class="table table-bordered table-base-style">
                    	 	<tr class="table-base-tr-title">
                    	 	    <th  colspan="8">商品列表</th>
                    	    </tr>
                    	    <tr class='th-center'>
						        <th width="12%">图片</th>
						        <th width="30%">名称</th>
						        <th>货号</th>
						        <th>规格</th>
						        <th>价格</th>
						        <th>购买数量</th>
						        <th>剩余库存</th>
						        <th>小计</th>
						    </tr>
                            <?php if(is_array($goodInfo)): $i = 0; $__LIST__ = $goodInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodInfo1): $mod = ($i % 2 );++$i;?><tr class='td-center'>
						        <td><img src="/mall/<?php echo ($goodInfo1["thunb_pic"]["thumb"]); ?>" width="40" height="40"  class="img_b"></td>
						        <td><?php echo ($goodInfo1["goods_name"]); ?></td>
						        <td><?php echo ($goodInfo1["goods_sn"]); ?></td>
						        <td><?php echo ($goodInfo1["spec_value"]); ?></td>
						        <td><?php echo ($goodInfo1["price"]); ?></td>
						        <td><?php echo ($goodInfo1["nums"]); ?></td>
						        <td><?php echo ($goodInfo1["sku"]); ?></td>
						        <td><?php echo ($goodInfo1["totol_price"]); ?></td>
						      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    	 </table>
                    	 <table class="table table-bordered table-base-style">
                    	 	<tr class="table-base-tr-title">
                    	 	    <th  colspan="8">费用信息</th>
                    	    </tr>
                    	    <tr class='th-center'>
						        <th colspan="8" style="text-align:right;padding:5px 5px 5px 0;">
						        	 商品总价：￥<span class="total_price"><?php echo ($order["total_price"]); ?></span> 元 + 物流费： ￥0 元
						        </th>  
						    </tr>
						    <tr class='th-center'>
						        <th colspan="8" style="text-align:right;padding:5px 5px 5px 0;">
						        	 合计：￥<span class="total_price"><?php echo ($order["total_price"]); ?></span>元
						        </th>   
						    </tr>
                    	 </table>
                    	<form action="<?php echo U('Order/addOrderLog');?>" method="post" id="addOrderLog">
                    	 <table class="table table-bordered table-base-style" style="margin-top:10px;">
                    	 	<tr class="table-base-tr-title">
                    	 	    <th  colspan="2">操作信息</th>
                    	    </tr>
                    	    <tr>
                    	 	    <td style="width:35%;">操作备注(*)：</td>
                    	 	    <td style="width:65%;">
                    	 	    	<div class="form-group" style="padding:0;margin:0;">
                    	 	     	    <textarea class="form-control" autocomplete="off" name="action_note" rows="3" style="resize:none;"></textarea>
                    	 	        </div>
                    	 	    </td>
                    	    </tr>
                    	    <tr>
                    	 	    <td style="width:35%;">可执行操作：</td>
                    	 	    <td style="width:65%;">
                    	 	    	  <input type="hidden" name="order_id" value="<?php echo ($order["order_id"]); ?>" />
                    	 	    	  <?php if($order["order_status"] != '已取消' ): if($order["order_status"] == '未确认' ): ?><input type="hidden" name="orderStatus" name="way" value="confirmOrder"/>
							                   <input type="submit"  class="btn btn-small btn-info" onclick="return check_order_opt();"   value="确认" />
							                 <?php elseif($order["order_status"] == '已确认' ): ?>
							                   <input type="hidden" name="way" value="canncelOrder" />
							                   <input type="submit"  class="btn btn-small btn-info" onclick="return check_order_opt();"  value="取消" /><?php endif; ?>
							              <?php if($order["order_status"] == '已确认' && $order["pay_status"] == '未付款' ): ?><input type="hidden" name="way" value="payPrice" />
	                                          <input type="submit" value="付款" onclick="return check_order_opt();"  class="btn btn-small btn-info" /><?php endif; ?>
								          <?php if($order["order_status"] == '已确认' && $order["ship_status"] == '未发货' && $order["pay_status"] == '已付款' ): ?><input type="hidden" name="way" value="sendGoods" />
		                                            <input type="submit" onclick="return check_order_opt();"  class="btn btn-small btn-info" value="配货"  />
		                                         <?php elseif($order["order_status"] == '已确认' && $order["ship_status"] == '配货中' && $order["pay_status"] == '已付款'): ?>
		                                            <input type="hidden" name="way" value="readySend" />
		                                            <input type="submit" onclick="return check_order_opt();"  class="btn btn-small btn-info"  value="去发货" />
		                                         <?php elseif($order["order_status"] == '已确认' && $order["ship_status"] == '已发货' && $order["pay_status"] == '已付款'): ?>
		                                             <input type="hidden" name="way" value="hadRecive" />
		                                            <input type="submit" onclick="return check_order_opt();"  value="签收"  class="btn btn-small btn-info" /><?php endif; ?>
							            <?php else: ?>
							               <span class="label label-important">无效订单</span><?php endif; ?>
                    	 	    </td>
                    	    </tr>
                    	 </table>
                    	</form>
                    	<table class="table table-bordered table-base-style">
                    	 	<tr class="table-base-tr-title">
                    	 	    <th  colspan="8">操作日志</th>
                    	    </tr>
                    	    <tr class='th-center'>
						        <th>操作时间</th>
						        <th>管理员</th>
						        <th>订单状态</th>
						        <th>物流状态</th>
						        <th>支付状态</th>
						        <th>操作注释</th>
						    </tr>
                            <?php if(is_array($orderlog)): $i = 0; $__LIST__ = $orderlog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orderlog): $mod = ($i % 2 );++$i;?><tr class='td-center'>
						        <td><?php echo ($orderlog["created"]); ?></td>
						        <td><?php echo ($orderlog["username"]); ?></td>
						        <td><?php echo ($orderlog["order_status"]); ?></td>
						        <td><?php echo ($orderlog["ship_status"]); ?></td>
						        <td><?php echo ($orderlog["pay_status"]); ?></td>
						        <td><?php echo ($orderlog["opt_note"]); ?></td>
						      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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

	 <script src="/mall/PUBLIC/Admin/js/orderinfo.js"></script>

</body>
</html>