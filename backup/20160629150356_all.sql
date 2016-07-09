-- MySQL database dump

-- Created by DBAction class, Power By TaoTao. 

-- http://blog.kisscn.com 

--

-- 主机: localhost

-- 生成日期: 2016 年  06 月 29 日 15:03

-- MySQL版本: 5.6.17

-- PHP 版本: 5.5.12



--

-- 数据库: `tsmall`

--

-- -------------------------------------------------------



--

-- 表的结构ts_admin

--

DROP TABLE IF EXISTS `ts_admin`

CREATE TABLE `ts_admin` (
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



--

-- 转存表中的数据 ts_admin

--



INSERT INTO `ts_admin` VALUES('1','admin','e10adc3949ba59abbe56e057f20f883e','2130706433','1467164795','','0','0');

--

-- 表的结构ts_admin_log

--

DROP TABLE IF EXISTS `ts_admin_log`

CREATE TABLE `ts_admin_log` (
  `admin_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员的日志ID',
  `created_time` int(10) NOT NULL COMMENT '创建时间',
  `con` varchar(200) NOT NULL COMMENT '操作的内容',
  `user_id` int(10) NOT NULL COMMENT '管理员ID',
  `login_ip` int(10) NOT NULL COMMENT '登陆IP',
  PRIMARY KEY (`admin_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_admin_log

--



INSERT INTO `ts_admin_log` VALUES('1','1465604308','添加栏目测试分类3成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('2','1465609253','添加栏目:测试分类7成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('3','1465610254','添加栏目:测试分类8成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('4','1465610332','添加栏目:测试分类9成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('5','1465610681','添加栏目:测试分类10成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('6','1465610704','添加栏目:测试分类11成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('7','1465610766','添加栏目:测试12成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('8','1465610799','添加栏目:测试分类15成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('9','1465610879','添加栏目:测试分类12成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('10','1465610896','添加栏目:测试分类13成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('11','1465611170','添加栏目:测试分类16成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('12','1465611693','添加栏目:测试分类17成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('13','1465611985','添加栏目:测试栏目18成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('14','1465612228','删除栏目成功！','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('15','1465612244','删除栏目成功！','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('16','1465697571','添加栏目:测试分类20成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('17','1465872035','添加商品      Apple iPhone 6s (A1700) 64G 玫瑰金色 移动联通电信4G手机  商品编号：1856588 关注商品 分享 Apple iPhone 6s (A1700) 64G 玫瑰金色 移动联通电信4G手机成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('18','1466130706','添加商品 小米 Note 全网通 黑色 移动联通电信4G手机 双卡双待 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('19','1466216023','添加商品 测试商品1 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('20','1466216032','添加商品 测试商品1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('21','1466216041','添加商品  失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('22','1466216046','添加商品  失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('23','1466216075','添加商品 测试商品2 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('24','1466216084','添加商品 测试商品2 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('25','1466216090','添加商品 测试商品2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('26','1466218549','添加商品 测试商品3 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('27','1466218741','添加商品 测试商品5 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('28','1466219181','添加商品 测试1 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('29','1466219259','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('30','1466219794','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('31','1466220040','添加商品 测试3 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('32','1466220887','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('33','1466221049','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('34','1466221194','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('35','1466221418','添加商品 测试5 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('36','1466222109','添加商品 测试1 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('37','1466222115','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('38','1466222209','添加商品 测试1 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('39','1466222219','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('40','1466222252','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('41','1466222505','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('42','1466222518','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('43','1466222642','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('44','1466222798','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('45','1466222813','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('46','1466222826','添加商品 测试3 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('47','1466223294','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('48','1466223505','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('49','1466223722','添加商品 测试4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('50','1466223735','添加商品 测试6 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('51','1466223782','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('52','1466223792','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('53','1466259402','添加商品 测试3 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('54','1466324153','添加商品 Apple iPhone 5s (A1530) 16GB 金色 移动联通4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('55','1466324327','添加商品 Apple iPhone 6 (A1586) 16GB 银色 移动联通电信4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('56','1466324548','添加商品 Apple iPhone 6s (A1700) 64G 玫瑰金色 移动联通电信4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('57','1466325995','添加栏目:手机成功','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('58','1466326286','添加商品 荣耀 V8 全网通 标准版 4GB+32GB 铂光金 移动联通电信4G手机 双卡双待双通 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('59','1466334723','添加商品 联想（Lenovo）天逸100 14英寸笔记本电脑（i5-5200U 4G 500G 1G独显 DVD 摄像头 win10）黑色 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('60','1466559209','添加商品 测试1 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('61','1466559322','添加商品 测试2 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('62','1466559336','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('63','1466560126','添加商品 测试3 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('64','1466560331','添加商品 测试5 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('65','1466566232','添加商品 测试6 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('66','1466566237','添加商品 测试6 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('67','1466572807','添加商品 测试6 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('68','1466572846','添加商品 测试2 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('69','1466572850','添加商品 测试2 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('70','1466573433','添加商品 测试7 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('71','1466573608','添加商品 测试10 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('72','1466573809','添加商品 测试11 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('73','1466573815','添加商品 测试11 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('74','1466574010','添加商品 测试12 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('75','1466574162','添加商品 测试12 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('76','1466575335','添加商品 小米 红米Note3 高配全网通版 3GB+32GB 金色 移动联通电信4G手机 双卡双待 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('77','1466610503','添加商品 小米5 全网通 标准版 3GB内存 32GB ROM 黑色 移动联通电信4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('78','1466652312','添加商品 我是普通商品 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('79','1466652316','添加商品 我是普通商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('80','1466672138','添加商品 测试商品的样式 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('81','1466770267','添加商品 小米5 全网通 标准版 3GB内存 32GB ROM 黑色 移动联通电信4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('82','1466840242','添加商品 添加商品 失败!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('83','1466840247','添加商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('84','1466850968','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('85','1466851009','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('86','1466851086','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('87','1466851282','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('88','1466851307','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('89','1466851422','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('90','1466851486','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('91','1466851552','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('92','1466851787','删除栏目成功！','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('93','1466851793','删除栏目成功！','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('94','1466855709','删除栏目成功！','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('95','1466856065','删除栏目成功！','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('96','1466861940','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('97','1466862044','修改商品 添加商品 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('98','1466862109','修改商品 小米5 全网通 标准版 3GB内存 32GB ROM 黑色 移动联通电信4G手机111 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('99','1466862673','添加商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('100','1466862780','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('101','1466862986','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('102','1466863733','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('103','1466864510','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('104','1466864771','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('105','1466864896','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('106','1466865383','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('107','1466865599','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('108','1466865650','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('109','1466866473','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('110','1466866502','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('111','1466866540','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('112','1466866570','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('113','1466867596','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('114','1466867637','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('115','1466867663','修改商品 Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('116','1466867858','添加商品 Apple iPhone 5s (A1530) 16GB 银色 移动联通4G手机 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('117','1466868346','添加商品 小米 红米Note3 高配全网通版 3GB+32GB 金色 移动联通电信4G手机 双卡双待 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('118','1466956307','修改商品 小米 红米Note3 高配全网通版 3GB+32GB 金色 移动联通电信4G手机 双卡双待 成功!','1','2130706433');

INSERT INTO `ts_admin_log` VALUES('119','1467011770','修改商品 Apple iPhone 5s (A1530) 16GB 银色 移动联通4G手机 成功!','1','2130706433');

--

-- 表的结构ts_brand

--

DROP TABLE IF EXISTS `ts_brand`

CREATE TABLE `ts_brand` (
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



--

-- 转存表中的数据 ts_brand

--



INSERT INTO `ts_brand` VALUES('12','诺基亚','Nokia','./Uploads/logo/574d5b9f48f64.jpg','诺基亚（Nokia Corporation）是一家总部位于芬兰埃斯波 ，主要从事移动通信产品生产的跨国公司。诺基亚成立于1865年，当时以造纸为主业，后来逐步向胶鞋、轮胎、电缆等领域扩展，最后发展成为一家手机制造商。自1996年以来，诺基亚连续14年占据市场份额第一。面对新操作系统的智能手机的崛起，诺基亚全球手机销量第一的地位在2011年第二季被苹果及三星双双超越。','1','http://www.nokia.com','12');

INSERT INTO `ts_brand` VALUES('13','苹果','apple','./Uploads/logo/574d5c876d56c.jpg','','1','','13');

INSERT INTO `ts_brand` VALUES('14','飞利浦','philips','./Uploads/logo/574d5c998f84c.jpg','官方咨询电话：4008800008 售后网点：','1','http://www.philips.com','14');

INSERT INTO `ts_brand` VALUES('15','三星','su','./Uploads/logo/574d5cf0f12cc.jpg','三星集团是韩国最大的跨国企业集团，同时也是上市企业全球500强，三星集团包括众多的国际下属企业，旗下子公司有：三星电子、三星物产、三星航空、三星人寿保险等等，业务涉及电子、金融、机械、化学等众多领域。','0','','15');

INSERT INTO `ts_brand` VALUES('16','联想',' Lenovo','./Uploads/logo/575ea07b668a0.jpg','','1','http://www.baidu.com','16');

INSERT INTO `ts_brand` VALUES('17','小米','MI','./Uploads/logo/575f61f2c8708.jpg','','1','','17');

INSERT INTO `ts_brand` VALUES('18','魅族','mz','./Uploads/logo/575f6541203a0.png','','1','','18');

--

-- 表的结构ts_category

--

DROP TABLE IF EXISTS `ts_category`

CREATE TABLE `ts_category` (
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



--

-- 转存表中的数据 ts_category

--



INSERT INTO `ts_category` VALUES('34','家用电器','','','0','1','34','','0','1','0','0');

INSERT INTO `ts_category` VALUES('35','手机、数码、京东通信','','','0','1','35','55,54','0','1','23','0');

INSERT INTO `ts_category` VALUES('36','电脑、办公','','','0','1','36','','0','1','0','0');

INSERT INTO `ts_category` VALUES('37','家居、家具、家装、厨具','','','0','1','37','','0','1','0','0');

INSERT INTO `ts_category` VALUES('38','男装、女装、童装、内衣','','','0','1','38','','0','1','0','0');

INSERT INTO `ts_category` VALUES('39','个护化妆、清洁用品、宠物','','','0','1','39','','0','1','0','0');

INSERT INTO `ts_category` VALUES('40',' 鞋靴、箱包、珠宝、奢侈品 ','','','0','1','40','','0','1','0','0');

INSERT INTO `ts_category` VALUES('41','运动户外、钟表','','','0','1','41','','0','1','0','0');

INSERT INTO `ts_category` VALUES('42','汽车、汽车用品','','','0','1','42','','0','1','0','0');

INSERT INTO `ts_category` VALUES('43','母婴、玩具乐器','','','0','1','43','','0','1','0','0');

INSERT INTO `ts_category` VALUES('44','食品、酒类、生鲜、特产','','','0','1','44','','0','1','0','0');

INSERT INTO `ts_category` VALUES('45','医药保健','','','0','1','45','','0','1','0','0');

INSERT INTO `ts_category` VALUES('46','图书、音像、电子书','','','0','1','46','','0','1','0','0');

INSERT INTO `ts_category` VALUES('47','大家电','','','34','1','47','','0-34','1','0','0');

INSERT INTO `ts_category` VALUES('48','平板电视','','','47','1','48','','0-34-47','1','0','0');

INSERT INTO `ts_category` VALUES('49','空调','','','47','1','49','','0-34-47','1','0','0');

INSERT INTO `ts_category` VALUES('50','测试分类','','','0','1','50','','0','1','0','0');

INSERT INTO `ts_category` VALUES('51','测试分类1','','','0','1','51','','0','1','0','0');

INSERT INTO `ts_category` VALUES('55','测试分类2','','','0','1','55','','0','1','0','0');

INSERT INTO `ts_category` VALUES('56','测试分类3','','','0','1','56','','0','1','0','0');

INSERT INTO `ts_category` VALUES('57','测试分类4','','','0','1','57','','0','1','0','0');

INSERT INTO `ts_category` VALUES('58','测试分类5','','','0','1','58','','0','1','0','0');

INSERT INTO `ts_category` VALUES('59','测试分类6','','','0','1','59','','0','1','0','0');

INSERT INTO `ts_category` VALUES('60','测试分类7','','','0','1','60','','0','1','0','0');

INSERT INTO `ts_category` VALUES('61','测试分类8','','','0','1','61','','0','1','0','0');

INSERT INTO `ts_category` VALUES('62','测试分类9','','','0','1','62','','0','1','0','0');

INSERT INTO `ts_category` VALUES('63','测试分类10','','','0','1','63','','0','1','0','0');

INSERT INTO `ts_category` VALUES('64','测试分类11','','','0','1','64','','0','1','0','0');

INSERT INTO `ts_category` VALUES('66','测试分类15','','','0','1','66','','0','1','0','0');

INSERT INTO `ts_category` VALUES('71','手机','','','35','1','71','','0-35','1','0','5');

--

-- 表的结构ts_gallery

--

DROP TABLE IF EXISTS `ts_gallery`

CREATE TABLE `ts_gallery` (
  `gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) DEFAULT NULL,
  `pic_name` varchar(16) DEFAULT NULL,
  `gallery_pic` text,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_gallery

--



INSERT INTO `ts_gallery` VALUES('14','49','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764ba8b825f6.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('15','49','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764ba8bb42d6.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('16','49','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764ba8be251e.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('17','50','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764bd049cfbe.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('18','50','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764bd04d810e.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('19','50','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764bd051ffbe.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('20','51','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764bdfdcaa36.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('21','51','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764bdfe080ee.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('22','52','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764c15595a8e.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('23','53','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764c1f208ca6.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('24','54','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_5764c28750cfe.jpg&quot;,&quot;unfold&quot;:&quot;.\\');

INSERT INTO `ts_gallery` VALUES('143','97','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_576ea25dda4f8.jpg&quot;,&quot;unfold&quot;:&quot;.\\/Uploads\\/gallery\\/350_576ea25dda4f8.jpg&quot;,&quot;big&quot;:&quot;.\\/Uploads\\/gallery\\/800_576ea25dda4f8.jpg&quot;,&quot;source&quot;:&quot;.\\/Uploads\\/gallery\\/576ea25dda4f8.jpg&quot;}');

INSERT INTO `ts_gallery` VALUES('144','97','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_576ea25e21408.jpg&quot;,&quot;unfold&quot;:&quot;.\\/Uploads\\/gallery\\/350_576ea25e21408.jpg&quot;,&quot;big&quot;:&quot;.\\/Uploads\\/gallery\\/800_576ea25e21408.jpg&quot;,&quot;source&quot;:&quot;.\\/Uploads\\/gallery\\/576ea25e21408.jpg&quot;}');

INSERT INTO `ts_gallery` VALUES('145','96','','{&quot;thumb&quot;:&quot;.\\/Uploads\\/gallery\\/54_576ea08180f48.jpg&quot;,&quot;unfold&quot;:&quot;.\\/Uploads\\/gallery\\/350_576ea08180f48.jpg&quot;,&quot;big&quot;:&quot;.\\/Uploads\\/gallery\\/800_576ea08180f48.jpg&quot;,&quot;source&quot;:&quot;.\\/Uploads\\/gallery\\/576ea08180f48.jpg&quot;}');

--

-- 表的结构ts_goods

--

DROP TABLE IF EXISTS `ts_goods`

CREATE TABLE `ts_goods` (
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



--

-- 转存表中的数据 ts_goods

--



INSERT INTO `ts_goods` VALUES('95','1','13','23','Apple iPhone 6s Plus (A1699) 64G 玫瑰金色 移动联通电信4','','选择下方购买方式→【移动优惠购】→【北京老用户优惠购机】即享优惠【套餐享7折+免费宽带】','ECS576e8c51dcff0','6388.00','1','1466784000','1471708800','0.00','1','1','1','1','1466867663','1466867663','10','100','件','71','{&quot;thumb&quot;:&quot;.\\/Uploads\\/54_576e8b78b7e30.jpg&quot;,&quot;unfold&quot;:&quot;.\\/Uploads\\/350_576e8b78b7e30.jpg&quot;,&quot;big&quot;:&quot;.\\/Uploads\\/800_576e8b78b7e30.jpg&quot;,&quot;source&quot;:&quot;.\\/Uploads\\/576e8b78b7e30.jpg&quot;}');

INSERT INTO `ts_goods` VALUES('96','1','13','23','Apple iPhone 5s (A1530) 16GB 银色 移动联通4G手机','','','ECS576ea0921e910','2200.00','0','0','0','0.00','0','0','0','1','1467011770','1467011770','10','10','件','71','{&quot;thumb&quot;:&quot;.\\/Uploads\\/54_576ea06b494a8.jpg&quot;,&quot;unfold&quot;:&quot;.\\/Uploads\\/350_576ea06b494a8.jpg&quot;,&quot;big&quot;:&quot;.\\/Uploads\\/800_576ea06b494a8.jpg&quot;,&quot;source&quot;:&quot;.\\/Uploads\\/576ea06b494a8.jpg&quot;}');

INSERT INTO `ts_goods` VALUES('97','1','17','23','小米 红米Note3 高配全网通版 3GB+32GB 金色 移动联通电信4G手机 双卡双待','','高通骁龙650处理器，指纹解锁快至0.3秒，轻薄 4000mAh 电池！','ECS576ea27ac4568','1099.00','0','0','0','0.00','0','0','0','1','1466956307','1466956307','10','10','件','71','{&quot;thumb&quot;:&quot;.\\/Uploads\\/54_576ea23ee2db0.jpg&quot;,&quot;unfold&quot;:&quot;.\\/Uploads\\/350_576ea23ee2db0.jpg&quot;,&quot;big&quot;:&quot;.\\/Uploads\\/800_576ea23ee2db0.jpg&quot;,&quot;source&quot;:&quot;.\\/Uploads\\/576ea23ee2db0.jpg&quot;}');

--

-- 表的结构ts_goods_attr

--

DROP TABLE IF EXISTS `ts_goods_attr`

CREATE TABLE `ts_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型参数的ID',
  `attr_name` varchar(15) NOT NULL COMMENT '参数名称',
  `attr_may_value` varchar(200) NOT NULL COMMENT '参数的可能值',
  `attr_type` tinyint(1) NOT NULL COMMENT '参数类型',
  `sort` smallint(5) NOT NULL COMMENT '排序',
  `goods_type_id` int(10) NOT NULL COMMENT '类型ID',
  PRIMARY KEY (`goods_attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_goods_attr

--



INSERT INTO `ts_goods_attr` VALUES('53','机身颜色','白色,金色,黑色,银色,灰色,粉色,蓝色,红色,黄色,绿色,紫色,其它','0','53','23');

INSERT INTO `ts_goods_attr` VALUES('54','网络','移动4G，电信4G，联通4G，双卡移动4G/联通4G/电信4G，双卡双4G，双卡单4G，其他','0','54','23');

INSERT INTO `ts_goods_attr` VALUES('55','屏幕尺寸','3.0英寸及以下，4.5-3.1英寸，5.0-4.6英寸，5.5-5.1英寸，5.6英寸及以上','0','55','23');

INSERT INTO `ts_goods_attr` VALUES('56','运行内存',' 2GB，3GB，4GB，6GB，无，其他','0','56','23');

INSERT INTO `ts_goods_attr` VALUES('57','系统',' 安卓（Android）,苹果（IOS）,微软（WindowsPhone）,无,其他','0','57','23');

INSERT INTO `ts_goods_attr` VALUES('58','机身内存',' 8GB以下，8GB，16GB，32GB，64GB，128GB，支持内存卡，无','0','58','23');

INSERT INTO `ts_goods_attr` VALUES('59','像素','500万以下，500-1000万，1000-1600万 ，1600万以上，无','0','59','23');

INSERT INTO `ts_goods_attr` VALUES('60','套餐','套餐一，套餐二，套餐三，套餐四，套餐五，套餐六','1','60','23');

INSERT INTO `ts_goods_attr` VALUES('62','颜色','红色,蓝色,绿色 ,粉红色','1','62','23');

INSERT INTO `ts_goods_attr` VALUES('63','网络制式','GSM/WCDMA,GSM/CDMA,GSM/TD-SCDMA','1','63','23');

INSERT INTO `ts_goods_attr` VALUES('64','选择容量','16G,54G,64G','1','64','23');

--

-- 表的结构ts_goods_attr_list

--

DROP TABLE IF EXISTS `ts_goods_attr_list`

CREATE TABLE `ts_goods_attr_list` (
  `attr_list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_value` varchar(100) DEFAULT NULL,
  `goods_id` int(10) DEFAULT NULL,
  `goods_attr_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`attr_list_id`)
) ENGINE=MyISAM AUTO_INCREMENT=321 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_goods_attr_list

--



INSERT INTO `ts_goods_attr_list` VALUES('284','500万以下','95','59');

INSERT INTO `ts_goods_attr_list` VALUES('285',' 8GB以下','95','58');

INSERT INTO `ts_goods_attr_list` VALUES('286','苹果（IOS）','95','57');

INSERT INTO `ts_goods_attr_list` VALUES('287','4GB','95','56');

INSERT INTO `ts_goods_attr_list` VALUES('288','5.0-4.6英寸','95','55');

INSERT INTO `ts_goods_attr_list` VALUES('289','移动4G','95','54');

INSERT INTO `ts_goods_attr_list` VALUES('290','白色','95','53');

INSERT INTO `ts_goods_attr_list` VALUES('305','红色','95','62');

INSERT INTO `ts_goods_attr_list` VALUES('306','套餐一','95','60');

INSERT INTO `ts_goods_attr_list` VALUES('307','蓝色','95','62');

INSERT INTO `ts_goods_attr_list` VALUES('308','套餐二','95','60');

INSERT INTO `ts_goods_attr_list` VALUES('309','500-1000万','96','59');

INSERT INTO `ts_goods_attr_list` VALUES('310','16GB','96','58');

INSERT INTO `ts_goods_attr_list` VALUES('311','苹果（IOS）','96','57');

INSERT INTO `ts_goods_attr_list` VALUES('312','500-1000万','97','59');

INSERT INTO `ts_goods_attr_list` VALUES('313','16GB','97','58');

INSERT INTO `ts_goods_attr_list` VALUES('314',' 安卓（Android）','97','57');

INSERT INTO `ts_goods_attr_list` VALUES('315','4GB','97','56');

INSERT INTO `ts_goods_attr_list` VALUES('316','4.5-3.1英寸','97','55');

INSERT INTO `ts_goods_attr_list` VALUES('319','蓝色','97','62');

INSERT INTO `ts_goods_attr_list` VALUES('320','套餐一','97','60');

--

-- 表的结构ts_goods_info

--

DROP TABLE IF EXISTS `ts_goods_info`

CREATE TABLE `ts_goods_info` (
  `keywords` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `content` text,
  `goods_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_goods_info

--



INSERT INTO `ts_goods_info` VALUES('','','&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/kwUgMcKVQJpdf1.html&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2953/325/776398610/161480/974f1df1/57689d57N2235d44f.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://huishou.jd.com&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2668/344/1180752391/111928/198211dc/5735a94fN3fe94b63.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/QJTDmIvthRan1Ul.html&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2905/93/2186799156/124730/7a6e17d8/575d3191N7f066393.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t1954/3/2074819795/82844/6883aa5a/56f0b912Nca2a4922.jpg&quot; alt=&quot;&quot;/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;	&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/fbUDvBVGQ8kFotE0.html&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2656/84/2290807699/34835/b944bc52/576133d8N9534c205.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2146/99/2563483512/378777/1eab3022/570e11e4N8c82868a.jpg&quot; alt=&quot;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2788/302/336398130/332995/de4c6196/570e11e6N2a5447a7.jpg&quot; alt=&quot;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://img30.360buyimg.com/jgsq-productsoa/jfs/t2302/238/2586573688/94150/160b660a/570e122eN266b852e.jpg&quot; alt=&quot;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','95');

INSERT INTO `ts_goods_info` VALUES('','','&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/kwUgMcKVQJpdf1.html&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466867834508420.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://huishou.jd.com&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466867834134934.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/QJTDmIvthRan1Ul.html&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466867835634718.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466867835721255.jpg&quot; alt=&quot;&quot;/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;	&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466867835651286.jpg&quot; alt=&quot;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','96');

INSERT INTO `ts_goods_info` VALUES('','','&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/g5iCqmlGj6M.html&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868307136828.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://sale.jd.com/act/K8i1dm7kDZq.html?cpdad=1DLSUE&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868307117024.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://huishou.jd.com&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868307426229.jpg&quot; alt=&quot;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868307122378.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868308137619.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868308112033.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868308135399.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868308463323.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868308102058.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868308971270.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868309331904.jpg&quot;/&gt; \r\n &lt;br/&gt; \r\n &lt;img src=&quot;/ueditor/php/upload/image/20160625/1466868309837527.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','97');

--

-- 表的结构ts_goods_type

--

DROP TABLE IF EXISTS `ts_goods_type`

CREATE TABLE `ts_goods_type` (
  `goods_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型ID',
  `type_name` varchar(10) DEFAULT NULL COMMENT '类型名称',
  PRIMARY KEY (`goods_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_goods_type

--



INSERT INTO `ts_goods_type` VALUES('23','手机');

INSERT INTO `ts_goods_type` VALUES('24','音乐');

INSERT INTO `ts_goods_type` VALUES('25','电影');

INSERT INTO `ts_goods_type` VALUES('26','笔记本电脑');

INSERT INTO `ts_goods_type` VALUES('27','数码相机');

INSERT INTO `ts_goods_type` VALUES('28','数码摄像机');

INSERT INTO `ts_goods_type` VALUES('29','化妆品');

INSERT INTO `ts_goods_type` VALUES('30','精品手机');

INSERT INTO `ts_goods_type` VALUES('43','测试17');

INSERT INTO `ts_goods_type` VALUES('50','1234');

INSERT INTO `ts_goods_type` VALUES('51','2313213');

INSERT INTO `ts_goods_type` VALUES('52','测试5');

--

-- 表的结构ts_product

--

DROP TABLE IF EXISTS `ts_product`

CREATE TABLE `ts_product` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sku` smallint(5) DEFAULT NULL,
  `goods_price` decimal(10,2) DEFAULT NULL,
  `attr_list` varchar(80) DEFAULT NULL,
  `goods_sn` varchar(45) DEFAULT NULL,
  `good_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_product

--



INSERT INTO `ts_product` VALUES('75','0','6000.00','305,306,','ECS576e9f8c49c78','95');

INSERT INTO `ts_product` VALUES('76','100','6100.00','307,308,','ECS576e9fcf5a618','95');

INSERT INTO `ts_product` VALUES('78','100','1200.00','319,320,','ECS576ea27acddc0','97');

--

-- 表的结构ts_user

--

DROP TABLE IF EXISTS `ts_user`

CREATE TABLE `ts_user` (
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8



--

-- 转存表中的数据 ts_user

--



INSERT INTO `ts_user` VALUES('3','caolei','e10adc3949ba59abbe56e057f20f883e','','','1467091869','0','0','0','');

INSERT INTO `ts_user` VALUES('4','曹磊','e10adc3949ba59abbe56e057f20f883e','','','1467092304','0','0','0','');

INSERT INTO `ts_user` VALUES('5','user1','e10adc3949ba59abbe56e057f20f883e','','','1467093240','0','0','0','');

INSERT INTO `ts_user` VALUES('6','user2','e10adc3949ba59abbe56e057f20f883e','','','1467094076','0','0','0','');

INSERT INTO `ts_user` VALUES('8','user3','e10adc3949ba59abbe56e057f20f883e','616576976@qq.com','','1467107973','1467113627','2130706433','0','');

INSERT INTO `ts_user` VALUES('9','user4','e10adc3949ba59abbe56e057f20f883e','user4@qq.com','','1467108137','0','0','0','');

INSERT INTO `ts_user` VALUES('10','user5','e10adc3949ba59abbe56e057f20f883e','user5@qq.com','','1467108241','0','0','0','');

