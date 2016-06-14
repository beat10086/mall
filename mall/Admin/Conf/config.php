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
    //图片上传路径
    'UPLOAD_PATH'=>'./Uploads/',
    'LOGO_PATH'=>'./logo/',
    'GALLERY_PATH'=>'./gallery/',
);