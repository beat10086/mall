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
                    <h2>账户信息</h2>
                </div>
                <div class="opt-content">
                    <div class="opt-nav">
                        <ul>
                            <li class="active"><a href="">基本信息</a></li>
                            <li><a href="">更多个人信息</a></li>
                        </ul>
                    </div>
                    <div>
                    	<form id="account" class="form_style">
                            <table class="table-form">
                                <tr>
                                    <th>用户名：</th>
                                    <td><?php echo ($userFindDate["username"]); ?></td>
                                </tr>
                                <tr>
                                    <th><span class="star">*</span>昵称：</th>
                                    <td>
                                    	<?php if(empty($userFindDate["nickname"])): ?><input type="text" name="nickname" class="input" value="<?php echo ($userFindDate["username"]); ?>" />
                                    	  <?php else: ?>
                                    	    <input type="text" name="nickname" class="input" value="<?php echo ($userFindDate["nickname"]); ?>" /><?php endif; ?>
                                    	<span></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><span class="star">*</span>真实姓名：</th>
                                    <td>
                                    	<input type="text" name="realname" class="input" value="<?php echo ($userFindDate["realname"]); ?>" />
                                    	<span></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>性别：</th>
                                    <td>
                                        <label class="radio"><input type="radio" name="gender" value="0" <?php if(($userFindDate["sex"]) == "0"): ?>checked='checked'<?php endif; ?> />保密</label>
                                        <label class="radio"><input type="radio" name="gender" value="1" <?php if(($userFindDate["sex"]) == "1"): ?>checked='checked'<?php endif; ?>/>男</label>
                                        <label class="radio"><input type="radio" name="gender" value="2" <?php if(($userFindDate["sex"]) == "2"): ?>checked='checked'<?php endif; ?> />女</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>邮箱：</th>
                                    <td><input type="text" name="email" class="input" disabled value="<?php echo ($userFindDate["email"]); ?>" /></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <button type="submit" class="btn">提交</button>
                                    </td>
                                </tr>
                            </table>
                         </form>
                    </div>
                </div>
            </div>
            <div id="loading">数据交互中...</div>

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