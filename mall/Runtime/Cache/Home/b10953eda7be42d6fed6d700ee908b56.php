<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    
	<title><?php echo ($goodsOne["goods_name"]); ?></title>
	<meta name="keywords" content="<?php echo ($goods_info["keywords"]); ?>">
	<meta name="description" content="<?php echo ($goods_info["description"]); ?>">
	<link href="/mall/PUBLIC/Home/css/base.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/public.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/goods.css" rel="stylesheet">
	<link href="/mall/PUBLIC/Home/css/zoom/base.css" rel="stylesheet">
    <style>
      ul#thumblist li a{
      	  border:2px solid #fff;
      }
    </style>
    <script>
    	var Thinkphp={
    		  'getProduct':'<?php echo U("Detail/getProduct");?>',
    		  'goods_id':'<?php echo ($_GET['id']); ?>',
    		  'addToCart':'<?php echo U("Cart/addToCart");?>'
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

	
	<div class="hd-w">
        <div class="site-here">
            <strong><a href="/mall">首页</a></strong> &gt;
            <?php if(is_array($ur_here)): $i = 0; $__LIST__ = $ur_here;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ur_here_1): $mod = ($i % 2 );++$i;?><a href="<?php echo U('List/index',array('id'=>$ur_here_1['category_id']));?>" ><?php echo ($ur_here_1["category_name"]); ?></a> &gt;<?php endforeach; endif; else: echo "" ;endif; ?>
            <a href="/mall/Detail/index/id/95"><?php echo ($goodsOne["goods_name"]); ?></a>
       </div>
<div id="goods-info">
<!--相册-->
<div id="gallery">
    <div class="clearfix" style="margin-bottom: 5px;" >
    	<div id="preview" class="spec-preview">
           <span class="jqzoom">
           	  <img src="/mall/<?php echo ($goodsOne["thunb_pic"]["unfold"]); ?>" class="jqzoom-change-small" jqimg="/mall/<?php echo ($goodsOne["thunb_pic"]["big"]); ?>" style="border: 1px solid #DDD">   
           </span>
        </div>
    </div>
    <div class="clearfix" id="small-thumb">
        <div class="gallery-move moveL"></div>
        <ul id="thumblist" class="clearfix" >
            <li >
                <img src='/mall/<?php echo ($goodsOne["thunb_pic"]["thumb"]); ?>' class="zoomThumbActive" onmousemove="preview(this);" smallImage="/mall/<?php echo ($goodsOne["thunb_pic"]["unfold"]); ?>" largeimage="/mall/<?php echo ($goodsOne["thunb_pic"]["big"]); ?>">
            </li>
            <?php if(is_array($gallery)): $i = 0; $__LIST__ = $gallery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><li>
                <img src='/mall/<?php echo ($pic["gallery_pic"]["thumb"]); ?>' onmousemove="preview(this);" smallImage="/mall/<?php echo ($pic["gallery_pic"]["unfold"]); ?>" largeimage="/mall/<?php echo ($pic["gallery_pic"]["big"]); ?>">
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="gallery-move moveR"></div>
    </div>
</div>
<!--/相册-->
<div id="goods">
    <div class="goods_name">
        <h2><?php echo ($goodsOne["goods_name"]); ?></h2>
        <strong><?php echo ($goodsOne["promote_word"]); ?></strong>
    </div>
    <div class="goods-info">
        <ul class="info-list">
            <li>
                <div class="title">
                                        商品编号：
                </div>
                <div class="con" id="goods-sn">
                <?php echo ($goodsOne["goods_sn"]); ?>
                </div>
            </li>
            <li>
                <div class="title">
                                         商店价：
                </div>
                <div class="con shop-price">
                    &yen;<?php echo ($goodsOne["goods_price"]); ?>
                </div>
            </li>
            <?php if($goodsOne["is_promote"] == 1 && $goodsOne["promote_stime"] < time() && $goodsOne["promote_etime"] > time()): ?><li>
	                <div class="title">
	                                        促销信息：
	                </div>
	                <div class="con">
	                    <span class="down-price">直降</span>
	                    <span><?php echo ($goodsOne["promote_price"]); ?></span>
	                </div>
	            </li><?php endif; ?>
        </ul>
        <br />
        <ul class="goods_kc">
            <li>
                <div class="title">
                	 库存：
                </div>
                <div class="con">
                    <span id="SKU"><?php echo ($goodsOne["sku"]); ?></span><?php echo ($goodsOne["unit"]); ?>
                </div>
            </li>
            <li>
                <div class="title">服务：</div>
                <div class="con">由后盾提供强大的技术支持</div>
            </li>
        </ul>
        <ul class="goods-spec">
        	<?php if(is_array($specs)): $key = 0; $__LIST__ = $specs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$specs): $mod = ($key % 2 );++$key;?><li class="spec-item">
	                <div class="title">
	                	 <?php echo ($specs["spec_name"]); ?>:
	                </div>
	                <div class="con">
	                    <?php if(is_array($specs["spec_value"])): foreach($specs["spec_value"] as $k=>$vo): ?><a href="javascript:void(0)" class="spec" title="<?php echo ($vo); ?>">
		                        <b></b><?php echo ($vo); ?>
		                        <input type="hidden" name="spec[<?php echo ($key); ?>]" value="<?php echo ($k); ?>" />
		                    </a><?php endforeach; endif; ?>
	                </div>
	            </li><?php endforeach; endif; else: echo "" ;endif; ?>
            <li class="buy-number">
                <div class="title">
                                         购买数量：
                </div>
                <div class="con changePrice" max="9">
                    <span type="minues">-</span><input type="text" id="buy-number" value="1" /><span type="plus">+</span>
                </div>
            </li>
            <li>
                <div class="seletc-spec">
                    <span>已选择 </span><strong></strong>
                </div>
                <div class="buy-button">
                    <a href="" class="buy-goods"></a>
                    <a href="javascript:void(0);" class="join-cart" onclick="addToCart(Thinkphp.goods_id)"></a>
                </div>
                <a href="" class="fav-goods">收藏商品</a>
            </li>
        </ul>
    </div>
</div>
</div>
<div id="con">
<div id="con-left">
    <div class="module">
        <div class="md-title">
            <h2>同类分类</h2>
        </div>
        <div class="md-content">
            <ul class="item-list">
                <li><a href="__WEB__/category/index/id/<?php echo ($related["category_id"]); ?>"></a></li>
            </ul>
        </div>
    </div>
    <div class="module">
        <div class="md-title">
            <h2>同类其他品牌</h2>
        </div>
        <div class="md-content">
            <ul class="item-list">
                <li><a href="/mall/brand/index/id/<?php echo ($brand["brand_id"]); ?>"><?php echo ($brand["brand_name"]); ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div id="con-right">
    <div class="goods-attr">
        <table width="100%" class="goods_table">
            <tr>
                <th>商品名称：</th>
                <td><?php echo ($goodsOne["goods_name"]); ?></td>
                <th>商品编号：</th>
                <td><?php echo ($goodsOne["goods_sn"]); ?></td>
                <th>品牌：</th>
                <td>
                    <?php echo ($goodsOne["brand_name"]["brand_name"]); ?>
                </td>
            </tr>
            <tr>
            <?php if(is_array($attrs)): $k = 0; $__LIST__ = $attrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attrs): $mod = ($k % 2 );++$k; if(($k%3) == "0"): ?><th><?php echo ($attrs["attr_name"]); ?>：</th>
                          <td><?php echo ($attrs["attr_value"]); ?></td>
	             	     <tr/>
	             	     <tr>
                      <?php else: ?>
                        <th><?php echo ($attrs["attr_name"]); ?>：</th>
                        <td><?php echo ($attrs["attr_value"]); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </tr>
        </table>
    </div>
    <div id="good-con">
    	   <?php echo ($goods_info["content"]); ?>
    </div>
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
 	<!--<script src="/mall/PUBLIC/Home/js/jqzoom/jquery.jqzoom-core-pack.js"></script>-->
 	<script src="/mall/PUBLIC/Home/js/zoom/jquery.jqzoom.js"></script>
	<script src="/mall/PUBLIC/Home/js/common.js"></script>
	<script src="/mall/PUBLIC/Home/js/goods.js"></script>
	<script src="/mall/PUBLIC/Home/js/public.js"></script>

</body>
</html>