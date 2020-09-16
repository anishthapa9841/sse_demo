# Dump of table tbl_notification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_notification`;

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `notification_data` text,
  `icon` tinytext,
  `badge` tinytext,
  `tag` tinytext,
  `action_link` tinytext,
  `sound_link` tinytext,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `order_code` int(11) DEFAULT '1',
  `priority` int(11) DEFAULT '1' COMMENT 'top priority',
  `ttl` varchar(50) DEFAULT '' COMMENT 'time to live value',
  `rel_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_notification` WRITE;
/*!40000 ALTER TABLE `tbl_notification` DISABLE KEYS */;

INSERT INTO `tbl_notification` (`id`, `title`, `notification_data`, `icon`, `badge`, `tag`, `action_link`, `sound_link`, `created_datetime`, `is_active`, `order_code`, `priority`, `ttl`, `rel_id`, `type`)
VALUES
	(1,'first notification\n','You have your first notification',NULL,NULL,NULL,NULL,NULL,'2020-03-20 11:04:21','Y',1,1,'',0,'0');

/*!40000 ALTER TABLE `tbl_notification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_notification_consumer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_notification_consumer`;

CREATE TABLE `tbl_notification_consumer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `not_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_read_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `read_datetime` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `not_id` (`not_id`),
  CONSTRAINT `tbl_notification_consumer_ibfk_1` FOREIGN KEY (`not_id`) REFERENCES `tbl_notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_notification_consumer` WRITE;
/*!40000 ALTER TABLE `tbl_notification_consumer` DISABLE KEYS */;

INSERT INTO `tbl_notification_consumer` (`id`, `not_id`, `user_id`, `is_read_status`, `read_datetime`, `is_active`, `created_datetime`)
VALUES
	(1,1,1,'N','','Y','2020-03-20 11:02:51');

/*!40000 ALTER TABLE `tbl_notification_consumer` ENABLE KEYS */;
UNLOCK TABLES;


