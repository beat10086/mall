-- MySQL database dump




































  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `last_ip` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  `note` text NOT NULL,
  `create_time` int(10) NOT NULL,
  `ban` smallint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8






















  `admin_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员的日志ID',
  `created_time` int(10) NOT NULL COMMENT '创建时间',
  `con` varchar(200) NOT NULL COMMENT '操作的内容',
  `user_id` int(10) NOT NULL COMMENT '管理员ID',
  `login_ip` int(10) NOT NULL COMMENT '登陆IP',
  PRIMARY KEY (`admin_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8


































































































































































































































































  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) NOT NULL COMMENT '品牌名称',
  `brand_name_en` varchar(45) NOT NULL,
  `brand_logo` varchar(145) DEFAULT NULL,
  `desc` text,
  `status` smallint(1) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `sort` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8


































  `category_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `category_name` varchar(20) NOT NULL COMMENT '栏目名称',
  `keywords` varchar(100) DEFAULT NULL COMMENT '栏目的关键字',
  `desc` varchar(120) DEFAULT NULL COMMENT '栏目的描述',
  `pid` smallint(5) DEFAULT NULL,
  `is_nav` tinyint(1) DEFAULT NULL COMMENT '是否显示导航',
  `sort` smallint(5) DEFAULT NULL,
  `fiter_attr` varchar(100) DEFAULT NULL COMMENT '筛选条件',
  `path` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '是否关闭',
  `goods_type_id` int(10) DEFAULT NULL COMMENT '商品类型',
  `price_nums` tinyint(1) DEFAULT NULL COMMENT '价格区间',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8
















































































  `gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) DEFAULT NULL,
  `pic_name` varchar(16) DEFAULT NULL,
  `gallery_pic` text,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8
















































  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品的ID',
  `user_id` int(11) DEFAULT NULL,
  `brand_id` int(10) DEFAULT NULL,
  `goods_type_id` smallint(5) DEFAULT NULL,
  `goods_name` varchar(45) DEFAULT NULL,
  `goods_style_name` varchar(180) DEFAULT NULL COMMENT '商品名称样式',
  `promote_word` varchar(100) DEFAULT NULL,
  `goods_sn` varchar(45) DEFAULT NULL COMMENT '货号',
  `goods_price` decimal(10,2) DEFAULT NULL COMMENT '商品价格',
  `is_promote` tinyint(1) DEFAULT NULL,
  `promote_stime` int(10) DEFAULT NULL,
  `promote_etime` int(10) DEFAULT NULL,
  `promote_price` decimal(10,2) DEFAULT NULL,
  `is_hot` tinyint(1) DEFAULT NULL,
  `is_first` tinyint(1) DEFAULT NULL,
  `is_well` tinyint(1) DEFAULT NULL,
  `is_on_sale` tinyint(1) DEFAULT NULL,
  `created` int(10) DEFAULT NULL,
  `updated` int(10) DEFAULT NULL,
  `view` smallint(5) DEFAULT NULL,
  `sku` smallint(5) DEFAULT NULL,
  `unit` char(5) DEFAULT NULL,
  `category_id` smallint(5) DEFAULT NULL,
  `thunb_pic` text,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8


























  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型参数的ID',
  `attr_name` varchar(15) NOT NULL COMMENT '参数名称',
  `attr_may_value` varchar(200) NOT NULL COMMENT '参数的可能值',
  `attr_type` tinyint(1) NOT NULL COMMENT '参数类型',
  `sort` smallint(5) NOT NULL COMMENT '排序',
  `goods_type_id` int(10) NOT NULL COMMENT '类型ID',
  PRIMARY KEY (`goods_attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8










































  `attr_list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_value` varchar(100) DEFAULT NULL,
  `goods_id` int(10) DEFAULT NULL,
  `goods_attr_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`attr_list_id`)
) ENGINE=MyISAM AUTO_INCREMENT=321 DEFAULT CHARSET=utf8






























































  `keywords` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `content` text,
  `goods_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8


























  `goods_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型ID',
  `type_name` varchar(10) DEFAULT NULL COMMENT '类型名称',
  PRIMARY KEY (`goods_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8












































  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sku` smallint(5) DEFAULT NULL,
  `goods_price` decimal(10,2) DEFAULT NULL,
  `attr_list` varchar(80) DEFAULT NULL,
  `goods_sn` varchar(45) DEFAULT NULL,
  `good_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8


























  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passwd` char(32) NOT NULL,
  `email` varchar(40) NOT NULL,
  `face` varchar(200) NOT NULL,
  `created` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  `last_ip` int(10) NOT NULL,
  `ban` tinyint(1) NOT NULL,
  `ban_reason` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8





























