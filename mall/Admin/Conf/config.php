<?php
header("Content-type:text/html;charset=utf-8");
return array(
	//设置模版替换变量
	'TMPL_PARSE_STRING' => array(
		'__CSS__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/css',
		'__JS__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/js',
		'__IMG__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/img',
	),
    'PAGE_SIZE'=>10
);