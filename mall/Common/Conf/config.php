<?php
return array(
    //设置可访问目录
    'MODULE_ALLOW_LIST'=>array('Home','Admin'),
    //设置默认目录
    'DEFAULT_MODULE'=>'Home',
    //设置模版后缀
    'TMPL_TEMPLATE_SUFFIX'=>'.html',
    //设置默认主题目录
    'DEFAULT_THEME'=>'Default',
    //数据库配置
    'DB_TYPE'=>'pdo',
    'DB_USER'=>'root',
    'DB_PWD'=>'',
    'DB_PREFIX'=>'ts_',
    'DB_DSN'=>'mysql:host=localhost;dbname=tsmall;charset=UTF8',
    //URL模式
    'URL_MODEL'=>2,
    'LOAD_EXT_FILE'=> 'function.php',
    'DB_BACKUP'=>'./backup/',
    'DB_NAME'  =>'tsmall',
    'DB_BACKUP_SIZE'         =>200,
    'ORDER_CONFIRM'=>false,//订单是否需要确认
    'alipay_config'=>array(
        'partner' =>'2088002532839633',   //这里是你在成功申请支付宝接口后获取到的PID；
        'key'=>'pn0rx8w7zx7ymlfqpt6jdqiya4q635gc',//这里是你在成功申请支付宝接口后获取到的Key
        'sign_type'=>strtoupper('MD5'),
        'input_charset'=> strtolower('utf-8'),
        'cacert'=> getcwd().'\\cacert.pem',
        'transport'=> 'http',
    ),
    'alipay'=>array(
      //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
      'seller_email'=>'yc60.com@gmail.com',
      //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
     'notify_url'=>'http://127.0.0.1/Pay/notifyurl',
     //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
     'return_url'=>'http://127.0.0.1/Pay/returnurl',   
     //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
     'successpage'=>'User/myorder?ordtype=payed',
      //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
     'errorpage'=>'User/myorder?ordtype=unpay',
    ),
);