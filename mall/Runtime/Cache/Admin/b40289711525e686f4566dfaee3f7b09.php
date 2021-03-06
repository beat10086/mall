<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="/mall/PUBLIC/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/mall/PUBLIC/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
       if(window.top !== window.self){ window.top.location = window.location;}
    </script>
    <script>
    	var ThinkPHP={
    		'INDEX':'<?php echo U("Index/index");?>'
    	}
    </script>
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">H+</h1>
            </div>
            <h3>欢迎使用 H+</h3>
            <form class="m-t" id="loginForm"  action="<?php echo U('Login/login');?>">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" name="username" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" name="passwd" autocomplete="off">
                </div>
                <div class="form-group show_code hide" >
                      <input type="text" class="form-control"  name="verify" autocomplete="off"
                      style="display:inline-block;width:150px;padding-left:0;float:left;">
                      <img src="<?php echo U('Login/verity');?>" width="100" height="30" style="cursor:pointer;" id="get_img">
                </div>
                <div id="errors" style="color:#c90000;"></div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>
    <script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/mall/PUBLIC/Admin/js/bootstrapValidator.min.js"></script>
    <script src="/mall/PUBLIC/Admin/js/login.js"></script>
</body>
</html>