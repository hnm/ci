CREATE TABLE IF NOT EXISTS `ci_accordion` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ci_accordion` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_accordion` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ci_accordion_content_items` (
  `ci_accordion_id` int(10) unsigned NOT NULL,
  `content_item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ci_accordion_id`,`content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ci_accordion_content_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_accordion_content_items` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
