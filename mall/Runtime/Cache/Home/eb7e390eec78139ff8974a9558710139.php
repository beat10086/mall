<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    
	<title>账户信息</title>
	<meta name="keywords" content="<?php echo ($goods_info["keywords"]); ?>">
	<meta name="description" content="<?php echo ($goods_info["description"]); ?>">
	<link href="/mall/PUBLIC/Home/css/base.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/public.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/jquery.ui.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/profile.css" rel="stylesheet">
	<script src="/mall/PUBLIC/Home/js/jquery.js"></script> 
	<script src="/mall/PUBLIC/Home/js/jquery.ui.js"></script>
    <script src="/mall/PUBLIC/Home/js/jquery.form.js"></script>
    <script src="/mall/PUBLIC/Home/js/jquery.validate.js"></script>
	<script>
	  var ThinkPHP = {
				'MODULE' : '/mall/Home',
				'IMG' : '/mall/Public/<?php echo MODULE_NAME;?>/images',
			};
	</script>

</head>  
<body>
	<div id="public-top">
    <div id="shortcut">
        <div id="shortcut-left" class="fn-left">
            <ul>
                <li class="icon-li"><i class="icon-fav"></i><a href="">收藏后盾商城</a></li>
                <li><a href="">HDPHP框架</a></li>
                <li><a href="">迷你挑</a></li>
                <li class="no-bd"><a href="">后盾论坛</a></li>
            </ul>
        </div>
        <div id="shortcut-right" class="fn-right">
            <ul>
            	<?php if($_SESSION['user_auth']['id']): ?><li>您好，！
	                	<a href="<?php echo U('Auth/account');?>">
	                    <?php echo $_SESSION['user_auth']['username'];?>
	                   </a>
	                 </li>
	                <li><a href="<?php echo U('Auth/layout');?>">[注销]</a></li>
                <?php else: ?>
	                <li>您好，欢迎来到后盾商城！<a href="<?php echo U('Auth/login');?>">[登录]</a></li>
	                <li><a href="<?php echo U('Auth/register');?>">[免费注册]</a></li><?php endif; ?>
                <li><a href="">我的订单</a></li>
                <!--  li-activate 鼠标放上去加上此class -->
                <li class="icon-li li-dropdown">
                    <dl>
                        <dt><i class="icon-dropdown"></i><a href="">特色栏目</a></dt>
                        <dd class="fn-hide">
                            <p><a href="###">为我推荐</a></p>
                            <p><a href="###">视频购物</a></p>
                            <p><a href="###">京东社区</a></p>
                            <p><a href="###">校园频道</a></p>
                            <p><a href="###">在线读书</a></p>
                            <p><a href="###">装机大师</a></p>
                            <p><a href="###">礼品卡</a></p>
                        </dd>
                    </dl>
                </li>
                <li><a href="">手机京东</a></li>
                <li class="icon-li li-dropdown">
                    <dl>
                        <dt><i class="icon-dropdown"></i><a href="">企业服务</a></dt>
                        <dd class="fn-hide">
                            <p><a href="###">为我推荐</a></p>
                            <p><a href="###">视频购物</a></p>
                            <p><a href="###">京东社区</a></p>
                            <p><a href="###">校园频道</a></p>
                            <p><a href="###">在线读书</a></p>
                            <p><a href="###">装机大师</a></p>
                            <p><a href="###">礼品卡</a></p>
                        </dd>
                    </dl>
                </li>
                <li class="no-bd"><a href="">客户服务</a></li>
            </ul>
        </div>
    </div>
</div>
	<div class="hd-w" id="profile">
	    <div id="menu">
    <h2 class="menu-title">我的商城</h2>
    <dl>
        <dt>订单中心</dt>
        <dd>
            <ul>
                <li><a href="<?php echo U('Auth/orders');?>">我的订单</a></li>
                <li><a href="__CONTROL__/account">浏览历史</a></li>
            </ul>
        </dd>
    </dl>
    <dl>
        <dt>账户中心</dt>
        <dd>
            <ul>
                <li><a href="<?php echo U('Auth/account');?>">账户信息</a></li>
                <li><a href="__CONTROL__/address">收货地址</a></li>
            </ul>
        </dd>
    </dl>
</div>
	    
	   <div class="right">
                <div class="opt-title">
                    <h2>订单列表</h2>
                </div>
                <div class="opt-content">
                    <ul class="extra-l">
                       <li><a href="/mall/Auth/orders" <?php if(($curr) == ""): ?>class="curr"<?php endif; ?>>全部订单</a></li>
                       <li><a href="/mall/Auth/orders/s/1" <?php if(($curr) == "1"): ?>class="curr"<?php endif; ?>  >待付款</a></li>
                       <li><a href="/mall/Auth/orders/s/2" <?php if(($curr) == "2"): ?>class="curr"<?php endif; ?> >待收货</a></li>
                       <li><a href="/mall/Auth/orders/s/3" <?php if(($curr) == "3"): ?>class="curr"<?php endif; ?> >待评价</a></li>
                    </ul>
                   <?php if(is_array($orderAll)): $i = 0; $__LIST__ = $orderAll;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orderAll): $mod = ($i % 2 );++$i;?><dl class="opt-content-dl">
                    	 <dt class="sep-row">
                    	 	  <span><?php echo ($orderAll["created"]); ?></span>
                    	 	  <span>订单号:<span class="order_num"><?php echo ($orderAll["order_sn"]); ?></span></span>
                    	 </dt>
                    	 <dd>
                    	 	 <table style="width:100%;" class="table-order">
                    	 	 	  <tr> 
                    	 	 	  	  <?php if(is_array($orderAll["order_goods"])): foreach($orderAll["order_goods"] as $key=>$order_goods): if(($key) == "0"): ?><td width="50%">
		                    	 	 	  	  	  <div class="p-img">
		                    	 	 	  	  	  	 <a href="/mall/Detail/index/id/<?php echo ($order_goods["goods_id"]); ?>" target="_blank">
		                    	 	 	  	  	  	   	<img class="" width="60" height="60"  title="" src="/mall/<?php echo ($order_goods["thunb_pic"]["thumb"]); ?>">
		                    	 	 	  	  	  	  </a>
		                    	 	 	  	  	  </div>
		                    	 	 	  	  	  <div class="p-msg">
		                    	 	 	  	  	  	   <div class="p-name-order">
		                                                  <a class="a-link" title="<?php echo ($order_goods["goods_name"]); ?>" target="_blank"  href="/mall/Detail/index/id/<?php echo ($order_goods["goods_id"]); ?>">
		                                                  	<?php echo ($order_goods["goods_name"]); ?>
		                                                  </a>
		                                               </div>
		                                               <div class="goods-number"> x<?php echo ($order_goods["nums"]); ?></div>
		                    	 	 	  	  	  </div>
		                    	 	 	  	  </td><?php endif; endforeach; endif; ?>
                    	 	 	  	  <td width="10%" rowspan="<?php echo ($orderAll["order_num"]); ?>">
                    	 	 	  	  	  <div class="consignee tooltip">
											<span class="txt" ><?php echo ($orderAll["consignee"]); ?></span>
											<b onclick="alert('有空做')"></b>
											<!------鼠标移动到头像的效果,有空做-------->
											<div class="prompt-01 prompt-02" style="display: none;">
												<div class="pc">
													<strong>dsfsad</strong>
													<p>河北张家口市张北县单晶河乡sdafsd</p>
													<p>138****6387</p>
												</div>
											     <div class="p-arrow p-arrow-left"></div>
											</div>
										</div>                    	 	 	  	  	
                    	 	 	  	  </td>
                    	 	 	  	  <td width="10%" rowspan="<?php echo ($orderAll["order_num"]); ?>">
                    	 	 	  	  	  <div class="amount">
                	                             <span>总额 ¥<?php echo ($orderAll["total_price"]); ?></span> <br>
                	                    	     <strong>应付</strong> <br>
                    	                         <strong>¥<?php echo ($orderAll["total_price"]); ?></strong> <br>
                                                 <span class="ftx-13"><?php echo ($orderAll["pay_name"]); ?></span>
                                         </div>  	
                    	 	 	  	  </td>
                    	 	 	  	  <td width="10%" rowspan="<?php echo ($orderAll["order_num"]); ?>">
                    	 	 	  	  	  <div class="status">
                    	 	 	  	  	  	<?php if($orderAll["pay_status"] == 0): ?><span class="order-status ftx-04"> 等待付款 </span><br>
                    	 	 	  	  	  		 <?php elseif($orderAll["ship_status"] == 2): ?>
                    	 	 	  	  	  		    <span class="order-status ftx-04"> 正在出货 </span><br> 
                    	 	 	  	  	  		 <?php elseif($orderAll["ship_status"] == 3): ?>
                    	 	 	  	  	  		    <span class="order-status ftx-04"> 发货中 </span><br><?php endif; ?>
                                            <div class="tooltip">
                                                <a target="_blank"  href="">订单详情</a>
                                            </div>
                    	 	 	  	  	  </div> 
                    	 	 	  	  </td>
                    	 	 	  	  <td width="10%" rowspan="<?php echo ($orderAll["order_num"]); ?>">
                    	 	 	  	  	  <div class="operate">
                                             <div _val="83431" class="count-time" style="display: block;"><i class="time-icon"></i>剩余23时11分</div>
                                             <?php if($orderAll["pay_status"] == 0): ?><a target="_blank" >付款</a><?php endif; ?>
                                             <a href="javascript:void(0);" class="a-link order-cancel">取消订单</a>
                                             <br>
                                          </div>
                    	 	 	  	  </td>
                    	 	 	  </tr>
                    	 	 	  <?php if(is_array($orderAll["order_goods"])): foreach($orderAll["order_goods"] as $key=>$order_goods1): if(($key) > "0"): ?><tr>
		                    	 	 	  	  <td width="50%">
		                    	 	 	  	  	  <div class="p-img">
		                    	 	 	  	  	  	 <a href="/mall/Detail/index/id/<?php echo ($order_goods["goods_id"]); ?>" target="_blank">
		                    	 	 	  	  	  	   	<img class="" width="60" height="60"  title="" src="/mall/<?php echo ($order_goods1["thunb_pic"]["thumb"]); ?>">
		                    	 	 	  	  	  	  </a>
		                    	 	 	  	  	  </div>
		                    	 	 	  	  	  <div class="p-msg">
		                    	 	 	  	  	  	   <div class="p-name-order">
		                                                  <a class="a-link" title="<?php echo ($order_goods1["goods_name"]); ?>" target="_blank"  href="/mall/Detail/index/id/<?php echo ($order_goods["goods_id"]); ?>">
		                                                      	<?php echo ($order_goods1["goods_name"]); ?>
		                                                  </a>
		                                               </div>
		                                               <div class="goods-number"> x1 </div>
		                    	 	 	  	  	  </div>
		                    	 	 	  	  </td>
		                    	 	 	 </tr><?php endif; endforeach; endif; ?>
                    	 	 </table>
                    	 </dd>
                    <dl><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>

	 </div>
	<div id="link" class="hd-w">
    <div id="link-page">    
    </div>
    <div id="son-com">
        <h2>后盾商城各地分公司</h2>
        <p class="com-desc">
            后盾商城已在全国360个城市建立了自己的分公司。提供上门自提、货到付款、POS机刷卡和售后上门服务。
        </p>
        <p class="com-link">
            <a href="">查看各地分公司 ></a>
        </p>
    </div>
</div>
<div id="copy-right" class="hd-w">
    <div class="copy-link">
        <a href="###">关于我们</a>
        |
        <a href="###">联系我们</a>
        |
        <a href="###">人才招聘</a>
        |
        <a href="###">商家入驻</a>
        |
        <a href="###">迷你挑</a>
        |
        <a href="###">奢侈品网</a>
        |
        <a href="###">广告服务</a>
        |
        <a href="###">手机京东</a>
        |
        <a href="###">友情链接</a>
        |
        <a href="###">销售联盟</a>
        |
        <a href="###">京东社区</a>
        |
        <a href="###">京东公益</a>
        |
        <a href="###">english site</a>
    </div>
    <div class="cp-info">
        <p>北京市公安局朝阳分局备案编号110105014669  |  京ICP证070359号  |   <a href="###">互联网药品信息服务资格证编号(京)-非经营性-2011-0034</a></p>
        <p>音像制品经营许可证苏宿批005号  |  出版物经营许可证编号新出发(苏)批字第N-012号  |  互联网出版许可证编号新出网证(京)字150号</p>
        <p>Copyright&copy;2004-2012  360buy京东商城 版权所有</p>
    </div>
    <div class="cp-ba">
    	
        <a href=""><img src="/mall/PUBLIC/Home/images/ba1.gif" alt=""></a>
        <a href=""><img src="/mall/PUBLIC/Home/images/ba2.gif" alt=""></a>
        <a href=""><img src="/mall/PUBLIC/Home/images/ba3.gif" alt=""></a>
        <a href=""><img src="/mall/PUBLIC/Home/images/ba4.gif" alt=""></a>
    </div>
</div>
	
	 <script src="/mall/PUBLIC/Home/js/account.js"></script>

</body>
</html>