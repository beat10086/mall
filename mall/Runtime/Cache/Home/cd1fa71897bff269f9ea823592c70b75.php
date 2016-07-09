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
	<link href="/mall/PUBLIC/Home/css/orderInfo.css" rel="stylesheet">
	<script>
	  var Thinkphp={}
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
	                	<a href="__WEB__/user">
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
                        <img src="/mall/PUBLIC/Home/images/hd_logo.png" alt="">
                    </a>
                </div>
                <div id="cart-step">
                    <ul>
                        <li class="step-1"><b></b>1.我的购物车</li>
                        <li class="step-2  stepping"><b></b>2.填写核对订单信息</li>
                        <li class="step-3">3.成功提交订单</li>
                    </ul>
                </div>
            </div>
            <div id="orderInfoMain">
                <div id="info-header">
                    <h2>填写核对订单信息</h2>
                </div>
                <div id="order-info">
                    <!--收货人信息-->
                    <div class="item">
                        <div class="item-nav">
                        	<h2>收货人信息
                                <a href="__METH__">[返回]</a>
                                <a href="__METH__/edit/address">[修改]</a>
                            </h2>
                        </div>
                        <!-- 用户的地址列表 -->
                        <form action="__METH__" method="post"> 
                            <ul class="address-list" id="address-list">
                                <li>
                                    <label>
                                    	<input type="radio" name="address_id" value="<?php echo ($value["address_id"]); ?>" /><span to="consignee"></span>
                                        <span to="province" val="<?php echo ($value["province"]); ?>"></span>-
                                        <span to="city" val="<?php echo ($value["city"]); ?>"></span>-
                                        <span to="district" val="<?php echo ($value["district"]); ?>"></span>
                                        <span to="address"></span>
                                        <span to="mobile"></span>
                                        <span to="tel"></span>
                                        <span to="zipcode"></span></label>
                                </li>
                            </ul>
                            <table class="title-l table-form">
                                <tr>
                                    <th>收货人姓名：</th>
                                    <td><input type="text" name="consignee" id="consignee" value="<?php echo ($address["consignee"]); ?>" /></td>
                                </tr>
                                <tr>
                                    <th>省份：</th>
                                    <td>
                                        <select name="province" id="province" class="user-add">
                                            <option value="">请选择</option>
                                            
                                        </select>
                                        <select name="city" id="city" class="user-add">
                                            <option value="">请选择</option>
                                            
                                        </select>
                                        <select name="district" id="district">
                                            <option value="">请选择</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>地址：</th>
                                    <td><input type="text" id="address" value="" name="address" /></td>
                                </tr>
                                <tr>
                                    <th>手机：</th>
                                    <td><input type="text" id="mobile" value="" name="mobile" /></td>
                                </tr>
                                <tr>
                                    <th>电话：</th>
                                    <td><input type="text" id="tel" value="" name="tel" /></td>
                                </tr>
                                <tr>
                                    <th>邮编：</th>
                                    <td><input type="text" id="zipcode" value="" name="zipcode" /></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="hidden" name="action" value="address" />
                                        <input type="submit" class="btn" value="配送至这里" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <!-- 默认的收货地址 -->
                        <div class="item-info">
                            <table class="title-l">
                                <tr>
                                    <th>收货人姓名：</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>省份：</th>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>地址：</th>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>手机：</th>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>电话：</th>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>邮编：</th>
                                    <td>
                                        <input type="hidden" name="address_id" value="" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--/收货人信息-->
                    <form action="__CONTROL__/addOrder" method="post">
                        <!--支付及配送方式-->
                        <div class="item">
                            <div class="item-nav"><h2>支付及配送方式<a href="">[修改]</a></h2></div>
                            <div class="item-info">
                                <table>
                                    <tr>
                                        <th>支付方式：</th>
                                        <td>货到付款</td>
                                    </tr>
                                    <tr>
                                        <th>配送方式：</th>
                                        <td>
                                            后盾快递
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>运　　费：</th>
                                        <td>0.00元 (免运费)</td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="pay_id" value="1" />
                            <input type="hidden" name="shipping_id" value="1" />
                        </div>
                        <!--/支付及配送方式-->
                        <!--商品清单-->
                        <div class="item">
                            <div class="item-nav"><h2>商品清单<a href="__CONTROL__">[修改]</a></h2></div>
                            <div class="item-info">
                                <table width="90%">
                                    <tr>
                                        <th>商品编号</th>
                                        <th>商品名称</th>
                                        <th>后盾价</th>
                                        <th>数量</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--/商品清单-->
                        <div id="settle-accounts">
                            <p class="price-list"></p>
                            <p>应付总额：￥元</p>
                            <p>
                                <input class="sub-order" type="image" src="__TPL__/images/sub_ord.jpg" alt="" />
                            </p>
                        </div>
                    </form>
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
	
	<script src="/mall/PUBLIC/Home/js/jquery-1.7.2.min.js"></script> 
	<script src="/mall/PUBLIC/Home/js/common.js"></script>
	<script src="/mall/PUBLIC/Home/js/public.js"></script>
	<script src="/mall/PUBLIC/Home/js/order.js"></script>

</body>
</html>