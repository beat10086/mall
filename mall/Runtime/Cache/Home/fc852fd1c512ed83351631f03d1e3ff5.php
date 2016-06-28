<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>商城登陆</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/mall/PUBLIC/Home/css/base.css" rel="stylesheet">
        <link href="/mall/PUBLIC/Home/css/public.css" rel="stylesheet">
        <link href="/mall/PUBLIC/Home/css/jquery.ui.css" rel="stylesheet">
        <link href="/mall/PUBLIC/Home/css/register.css" rel="stylesheet">
        <script src="/mall/PUBLIC/Home/js/jquery.js"></script> 
        <script src="/mall/PUBLIC/Home/js/jquery.ui.js"></script>
        <script src="/mall/PUBLIC/Home/js/jquery.form.js"></script>
        <script src="/mall/PUBLIC/Home/js/jquery.validate.js"></script>
        <style type="text/css">
            .hd-w{
                width: 990px;
            }
            #register{
                width: 990px;
                margin: 10px auto;
            }
            #register #form{
                width: 700px;
                margin: 10px auto;
            }
            #register #form tr{
                height: 55px;
            }
            #register #form input{
                width: 240px;
                height: 16px;
                border:1px solid #bbb;
                padding: 4px 3px;
                margin-bottom: 28px;
            }
            #register #form .checkbox{
                width: 15px;
                height: 15px;
                background: #FFF;
                border: 1px #CCCCCC solid;
            }
            #register #form .input-focus{
                border: 1px solid #EFA100;
                margin-bottom: 0px;
            }
            #register #form #code input{
                width: 80px;
                float: left;
                margin-top: 2px;
                margin-right: 8px;
            }
            #register #form #code img{
                display: inline-block;
            }
            #register #form th{
                text-align: right;
                padding-right: 5px;
                width: 110px;
            }
            #register #form th span{
                color: #f00;
                /*border: 1px #f00 solid;*/
            }
            #register #form th label{
                display: block;
                height: 50px;
                padding-top: 5px;
                font-size: 14px;
                color: #333;
                /*border: 1px #0f0 solid;*/
            }
            #son-com{
                display: none;
            }
            .module .md-title{
                height: 33px;
                line-height: 33px;
            }
            #register #form .btn-reg{
                width: 169px;
                height: 30px;
                border: none;
                background: url(/mall/PUBLIC/Home/images/new-regist.jpg) no-repeat;
                color: #fff;
                font-weight: bold;
                font-size: 14px;
                margin-top: 5px;
            }
            #register #form .btn-login{
                width: 100px;
                background-position: 0px -31px;
            }
            .tips{
                color: #999;
                padding: 5px 0px;
            }
            #form .tips{
                display: none;
            }
            #code .tips{
                display: none;
                padding: 0px 0px 3px;
            }
            #form .error{
                color: #f00;
            }
            #register #form .error input{
                border:1px #f00 solid;
            }
            #form .success{
                display: inline-block;
                width: 16px;
                height: 16px;
                background: url(/mall/PUBLIC/Home/images/pwdstrength.gif) no-repeat right 0px;
                margin-left: 5px;
            }
            #register #form th label{
                height: auto;
            }
            #register #form input{
                margin-bottom: 0px;
            }
        </style>
        <script type="text/javascript">
			var ThinkPHP = {
				'MODULE' : '/mall/Home',
				'IMG' : '/mall/Public/<?php echo MODULE_NAME;?>/images',
				'INDEX' : '<?php echo U("Index/index");?>',
				'PREV_URL':'<?php echo ($PREV_URL); ?>'
			};
      </script>
    </head>
    <body>
        <div class="hd-w">
            <div id="header">
                <div id="logo">
                    <a href="">
                        <img src="/mall/PUBLIC/Home/images/hd_logo.png" alt="">
                    </a>
                    <div class="logo-ads">
                        <a href="">
                            <img src="/mall/PUBLIC/Home/images/logo_ads.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="module" id="register">
                <h2 class="md-title">
                    <span>Z商城登录</span>
                    <a href="<?php echo U('Auth/register');?>">没有帐号？立即注册</a>
                </h2>
                <div class="md-content">
                    <form id="login">
                        <table id="form">
                            <tr>
                                <th>
                                	<label>用户名：</label>
                                </th>
                                <td>
                                	<input type="text" name="username" autocomplete="off" id="username" value="" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>密码：</label></th>
                                <td><input type="password" name="passwd" autocomplete="off" id="passwd" /><b></b>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <label>
                                        <input type="checkbox" class="checkbox" checked name="autologin" value="1" />
                                                                                                      自动登录
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" class="btn-reg btn-login" value="登录" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div id="loading">数据交互中...</div>
        <script src="/mall/PUBLIC/Home/js/login.js"></script>
    </body>
</html>