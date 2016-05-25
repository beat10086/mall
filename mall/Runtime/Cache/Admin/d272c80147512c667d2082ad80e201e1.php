<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="/mall/PUBLIC/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/mall/PUBLIC/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/mall/PUBLIC/Admin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top !== window.self){ window.top.location = window.location;}
    </script>
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">H+</h1>
            </div>
            <h3>欢迎使用 H+</h3>
            <form class="m-t" method="POST" action="<?php echo U('Admin/index');?>">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" name="username" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" name="passwd">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>
    <script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
</body>

</html>