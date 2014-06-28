/* Table structure for table `ps_minic_options` */
DROP TABLE IF EXISTS `ps_minic_options`;

CREATE TABLE `ps_minic_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_shop` int(10) unsigned NOT NULL,
  `effect` varchar(300) DEFAULT NULL,
  `current` varchar(300) DEFAULT NULL,
  `slices` int(3) NOT NULL DEFAULT '15',
  `cols` int(3) NOT NULL DEFAULT '8',
  `rows` int(3) NOT NULL DEFAULT '4',
  `speed` int(4) NOT NULL DEFAULT '500',
  `pause` int(4) NOT NULL DEFAULT '3000',
  `manual` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hover` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buttons` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `control` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `thumbnail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `random` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `start_slide` int(2) unsigned NOT NULL DEFAULT '0',
  `single` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `min_width` varchar(10) DEFAULT NULL,
  `max_width` varchar(10) DEFAULT NULL,
  `max_height` varchar(10) DEFAULT NULL,
  `front` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`id_shop`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/* dumping data for table `ps_minic_options` */
INSERT INTO `ps_minic_options` VALUES
(1,1,'sliceDown,sliceDownLeft,sliceUp,sliceUpLeft,sliceUpDown,sliceUpDownLeft,fold,slideInRight,slideInLeft,boxRandom,boxRain,boxRainReverse,boxRainGrow,boxRainGrowReverse','fade',15,8,4,500,3000,0,1,1,0,0,0,0,1,'','','',1);

/* Table structure for table `ps_minic_slider` */
DROP TABLE IF EXISTS `ps_minic_slider`;

CREATE TABLE `ps_minic_slider` (
  `id_slide` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_shop` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `id_order` int(10) unsigned NOT NULL,
  `lang_iso` varchar(5) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `target` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `image` varchar(100) DEFAULT NULL,
  `alt` varchar(100) DEFAULT NULL,
  `caption` varchar(600) DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_slide`,`id_shop`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/* dumping data for table `ps_minic_slider` */
INSERT INTO `ps_minic_slider` VALUES
(1,1,1,1,'en','','index.php?id_category=3&controller=category',0,'slide-1-15-41.jpg','','',1),
(2,1,1,2,'en','','index.php?id_category=4&controller=category',0,'slide-2-15-47.jpg','','',1),
(3,1,1,3,'en','','index.php?id_category=5&controller=category',0,'slide-3-15-54.jpg','','',1),
(4,1,2,1,'de','','index.php?id_category=3&controller=category',0,'slide-1.jpg','','',1),
(5,1,2,2,'de','','index.php?id_category=4&controller=category',0,'slide-2.jpg','','',1),
(6,1,2,3,'de','','index.php?id_category=5&controller=category',0,'slide-3.jpg','','',1),
(7,1,3,1,'ru','','index.php?id_category=3&controller=category',0,'slide-1-17-59.jpg','','',1),
(8,1,3,2,'ru','','index.php?id_category=4&controller=category',0,'slide-2-18-07.jpg','','',1),
(9,1,3,3,'ru','','index.php?id_category=5&controller=category',0,'slide-3-18-17.jpg','','',1),
(10,1,4,1,'es','','index.php?id_category=3&controller=category',0,'slide-1-28-57.jpg','','',1),
(11,1,4,2,'es','','index.php?id_category=4&controller=category',0,'slide-2-29-08.jpg','','',1),
(12,1,4,3,'es','','index.php?id_category=5&controller=category',0,'slide-3-29-15.jpg','','',1),
(13,1,5,1,'fr','','index.php?id_category=3&controller=category',0,'slide-1-30-17.jpg','','',1),
(14,1,5,2,'fr','','index.php?id_category=4&controller=category',0,'slide-2-30-24.jpg','','',1),
(15,1,5,3,'fr','','index.php?id_category=5&controller=category',0,'slide-3-30-33.jpg','','',1),
(16,1,1,4,'en','','index.php?id_category=6&controller=category',0,'slide-4.jpg','','',1),
(17,1,1,5,'en','','index.php?id_category=5&controller=category',0,'slide-5.jpg','','',1),
(18,1,2,4,'de','','index.php?id_category=4&controller=category',0,'slide-4-17-19.jpg','','',1),
(19,1,2,5,'de','','index.php?id_category=6&controller=category',0,'slide-5-17-32.jpg','','',1),
(20,1,3,4,'ru','','index.php?id_category=4&controller=category',0,'slide-4-18-29.jpg','','',1),
(21,1,3,5,'ru','','index.php?id_category=6&controller=category',0,'slide-5-18-40.jpg','','',1),
(22,1,4,4,'es','','index.php?id_category=5&controller=category',0,'slide-4-29-30.jpg','','',1),
(23,1,4,5,'es','','index.php?id_category=6&controller=category',0,'slide-5-29-45.jpg','','',1),
(24,1,5,4,'fr','','index.php?id_category=6&controller=category',0,'slide-4-30-45.jpg','','',1),
(25,1,5,5,'fr','','index.php?id_category=3&controller=category',0,'slide-5-30-56.jpg','','',1);