<?php
header("Content-type:text/html;charset=utf-8");
return array(
	//设置模版替换变量
	'TMPL_PARSE_STRING' => array(
		'__CSS__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/css',
		'__JS__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/js',
		'__IMG__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/img',
	    '__UPLOADIFY__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/uploadify',
	    '__UEDITOR__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/ueditor',
	),
    'PAGE_SIZE'=>10,
    //页面Trace
    'SHOW_PAGE_TRACE'=>true,
    //图片上传路径
    'UPLOAD_PATH'=>'./Uploads/',
    'LOGO_PATH'=>'./logo/',
    'GALLERY_PATH'=>'./gallery/',
    'UPLOAD_NUM' =>8,
    //订单状态
    'orderStatus'=>array(
        1 => '未确认',
        2 => '已确认',
        3 => '已取消',
        4 => '已完成'
    ),
    //发货状态
    'shipStatus'=>array(
        1 => '未发货',
        2 => '配货中',
        3 => '已发货',
        4 => '已签收'
    ),
    //付款状态
    'payStatus' => array(
        0 => '未付款',
        1 => '已付款'
    )
);