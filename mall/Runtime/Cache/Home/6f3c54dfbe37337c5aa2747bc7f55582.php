<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    
	<title>我的购物车</title>
	<meta name="keywords" content="<?php echo ($goods_info["keywords"]); ?>">
	<meta name="description" content="<?php echo ($goods_info["description"]); ?>">
	<link href="/mall/PUBLIC/Home/css/base.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/public.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/cart.css" rel="stylesheet">
	<script>
	  var Thinkphp={
	  	    'updateCartNums':'<?php echo U("Cart/updateCartNums");?>',
	  	    'delCartGoods':'<?php echo U("Cart/delCartGoods");?>',
	  	    'login_status':'<?php echo ($_SESSION['user_auth']['id']); ?>',
	  	    'modifly':'<?php echo U("Cart/modifly");?>',
	  	    'orderInfo':'<?php echo U("Cart/orderInfo",array("act"=>"cart"));?>'
	  }
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
	<script>
   var think={
   	    'getCart':'<?php echo U("Cart/getCart");?>',
   	     'ROOT':'/mall',
   	     'Detail':'/mall/Detail/index',
   	     'delCartGoods':'<?php echo U("Cart/delCartGoods");?>',
   }
</script>
<div class="hd-w">
    <div id="header">
        <div id="logo">
            <a href="/mall">
                <img src="" alt="">
            </a>
            <div class="logo-ads">
                <a href="">
                </a>
            </div>
        </div>
        <div id="search">
            <form action="" method="post">
                <div id="search-form">
                    <div class="search-form-left"></div>
                    <div class="search-form-center">
                        <input type="text" name="keyword" default="后盾网、人人做后盾" value="后盾网、人人做后盾" id="keyword">
                    </div>
                    <div class="search-form-right"></div>
                    <div class="search-button">
                        <input type="button" value="搜索">
                    </div>
                </div>
            </form>
            <div id="hot-keyword">
                <span>热门搜索：</span>
                <a href="###" class="hot-words">新一代APU</a>
                <a href="###">跑步机</a>
                <a href="###">老板烟机</a>
                <a href="###">和田新枣</a>
                <a href="###">华为Y210</a>
                <a href="###">聚焦十八大</a>
                <a href="###">诺基亚800</a>
            </div>
        </div>
        <div id="header-cart">
            <div id="shopping-cart" >
                <dl>
                    <dt >
                    	<i class="ci-left"></i>
	                    <i class="icon-account">
	                        <span><?php echo ($cateNum); ?></span>
	                    </i>
                         <a href='<?php echo U("Cart/index");?>'>我的购物车</a>
                         <i class="icon-dropdown"></i>
                    </dt>
                    <dd></dd>
                </dl>
            </div>
        </div>
    </div>
    <div id="nav">
        <div id="nav-bg-left"></div>
        <div id="cate">
            <div id="cate-all-btn"><h2><a href="">全部商品分类</a></h2></div>
            <div id="cate-list" class="fn-hide">
                <ul id="cate-list-show">
                </ul>
                <div class="cate-all-link">
                    <a href="">全部商品分类</a>
                </div>
            </div>
        </div>
        <ul id="nav-list">
            <li class="nav-activate" activate="true"><a href="/mall">首页</a></li>
            
        </ul>
        <div id="nav-bg-right"></div>
        <div id="nav-ads">
        </div>
    </div>
</div>

	
	  <div class="h hd-wm">
            <div id="header">
                <div id="logo">
                    <a href="/mall">
                        <img src="" alt="">
                    </a>
                </div>
                <div id="cart-step">
                    <ul>
                        <li class="step-1 stepping"><b></b>1.我的购物车</li>
                        <li class="step-2"><b></b>2.填写核对订单信息</li>
                        <li class="step-3">3.成功提交订单</li>
                    </ul>
                </div>
            </div>
           <?php if($cart_info): ?><div id="cart-list">
                <div class="head">
                    <div class="opt-checked">
                    	<?php if($_SESSION['user_auth']['id']): ?><input type="checkbox" class="checkbox select-all" <?php if(($allselect) == "true"): ?>checked="checked"<?php endif; ?> />
                          <?php else: ?>
                             <input type="checkbox" class="checkbox select-all" checked="checked" /><?php endif; ?>
                        <label for="select-all">全选</label>
                    </div>
                    <div class="head-goods">商品</div>
                    <div class="head-price">单价(元)</div>
                    <div class="head-nums">数量</div>
                    <div >小计(元)</div>
                    <div class="opt">操作</div>
                </div>
                <div class="cart-content">	
	                  <?php if(is_array($cart_info)): $i = 0; $__LIST__ = $cart_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart_info): $mod = ($i % 2 );++$i; if($_SESSION['user_auth']['id']): if(($cart_info["sel"]) == "1"): ?><div class="cart-item checked" cart-id="<?php echo ($key); ?>">
		                       <?php else: ?>
		                         <div class="cart-item" cart-id="<?php echo ($key); ?>"><?php endif; ?>
		                 <?php else: ?>
		                     <div class="cart-item checked" cart-id="<?php echo ($key); ?>"><?php endif; ?>
	                        <div class="cart-item-checked">
	                          <?php if($_SESSION['user_auth']['id']): if(($cart_info["sel"]) == "1"): ?><input type="checkbox" name="select-name"  checked="checked" />
		                              <?php else: ?>
		                                <input type="checkbox" name="select-name" /><?php endif; ?>
	                             <?php else: ?>
	                                <input type="checkbox" name="select-name"  checked="checked" /><?php endif; ?>
	                        </div>
	                        <div class="cart-goods">
	                            <div class="goods-img">
	                                <a href="<?php echo U('Detail/index',array('id'=>$cart_info['goods_id']));?>">
	                                	 <img src="/mall/<?php echo ($cart_info["goods_thumb"]); ?>" alt="" width="49" height="49" />
	                                </a>
	                            </div>
	                            <div class="goods-name">
	                                <a href="<?php echo U('Detail/index',array('id'=>$cart_info['goods_id']));?>">
	                                	<?php echo ($cart_info["goods_name"]); ?>
	                                </a>
	                                <p><?php echo ($cart_info["spec_desc"]); ?></p>
	                            </div>
	                        </div>
	                        <div class="goods-price" style="width:90px;">
	                        	    <?php echo ($cart_info["price"]); ?>
	                        </div>
	                        <div class="goods-nums" >
	                            <a href="javascript:void(0)" class="num-btn minus"></a>
	                            <input type="text" name="" class="item-nums" autocomplete="off" old-nums="<?php echo ($cart_info["nums"]); ?>" value="<?php echo ($cart_info["nums"]); ?>" />
	                            <a href="javascript:void(0)" class="num-btn plus"></a>
	                        </div>
	                        <div class="goods-total">
	                        	<?php echo ($cart_info['price']*$cart_info['nums']); ?>
	                        </div>
	                        <div class="goods-opt">
	                            <a href="javascript:void(0)" class="del">删除</a>
	                        </div>
	                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                     </div>
                   <?php else: ?>
                                                            购物车内暂时没有商品，登录后将显示您之前加入的商品<?php endif; ?>
            </div>
            <?php if($cart_info): ?><div class="total-price">
	                <p>
	                    <strong>总价：</strong>
	                    <span>￥<b>
	                       <?php if($_SESSION['cart']): echo (session('total_price')); ?>
	                          <?php else: ?>
	                    	    <?php echo ($totalprice); endif; ?>
	                     </b>元</span>
	                </p>
	            </div>
	            <div class="cart-btn">
	                <a href="javascript:void(0)" class="fn-right go-order">去结算</a>
	            </div><?php endif; ?>
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
	
	<script src="/mall/PUBLIC/Home/js/jquery-1.7.2.min.js"></script> 
	<script src="/mall/PUBLIC/Home/js/common.js"></script>
	<script src="/mall/PUBLIC/Home/js/public.js"></script>
	<script src="/mall/PUBLIC/Home/js/cart.js"></script>

</body>
</html>