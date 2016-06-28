<?php
header("Content-type:text/html;charset=UTF-8");
return array(
	//设置模版替换变量
	'TMPL_PARSE_STRING' => array(
		'__CSS__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/css',
		'__JS__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/js',
		'__IMG__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/images',
	    '__UPLOADIFY__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/uploadify',
	    '__UEDITOR__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/ueditor',
	),
    //页面Trace
    'SHOW_PAGE_TRACE'=>true,
    //COOKIE密钥
    'COOKIE_key'=>'www.ycku.com',
);