
CREATE TABLE `z5_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "z5_categories"
#

INSERT INTO `z5_categories` VALUES (1,'Category 1','0000-00-00 00:00:00'),(2,'Category 2','0000-00-00 00:00:00'),(3,'Category 3','0000-00-00 00:00:00'),(4,'Category 4','0000-00-00 00:00:00'),(5,'Category 5','0000-00-00 00:00:00'),(6,'Category 6','0000-00-00 00:00:00'),(7,'Category 7','0000-00-00 00:00:00');

#
# Source for table "z5_topics"
#

CREATE TABLE `z5_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `z5_topics_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `z5_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "z5_topics"
#

INSERT INTO `z5_topics` VALUES (1,'Topic adsf asdf ',1,'0000-00-00 00:00:00'),(2,'topic 2',1,'0000-00-00 00:00:00'),(3,'topic 3',2,'0000-00-00 00:00:00'),(4,'adsf',2,'0000-00-00 00:00:00'),(5,'546dsfg',3,'0000-00-00 00:00:00'),(6,'dfgasdfadfs',1,'0000-00-00 00:00:00'),(7,'123123123',1,'0000-00-00 00:00:00'),(8,'asdf',1,'0000-00-00 00:00:00'),(9,'1',1,'0000-00-00 00:00:00'),(10,'2',1,'0000-00-00 00:00:00'),(11,'3',1,'0000-00-00 00:00:00'),(12,'4',1,'0000-00-00 00:00:00');

#
# Source for table "z5_users"
#

CREATE TABLE `z5_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "z5_users"
#

INSERT INTO `z5_users` VALUES (1,'admin','d8578edf8458ce06fbc5bb76a58c5ca4','0000-00-00 00:00:00','admin'),(2,'korvin0','d8578edf8458ce06fbc5bb76a58c5ca4','0000-00-00 00:00:00','admin'),(3,'qwerty','d8578edf8458ce06fbc5bb76a58c5ca4','2013-08-02 14:40:16','user'),(4,'user2','d8578edf8458ce06fbc5bb76a58c5ca4','2013-08-02 15:15:51','user'),(5,'a','d8578edf8458ce06fbc5bb76a58c5ca4','2013-08-02 15:19:44','user'),(6,'b','d8578edf8458ce06fbc5bb76a58c5ca4','2013-08-02 15:20:00','user'),(7,'d','d8578edf8458ce06fbc5bb76a58c5ca4','2013-08-02 15:21:17','user');

#
# Source for table "z5_posts"
#

CREATE TABLE `z5_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text,
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `topic_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `z5_posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `z5_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `z5_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `z5_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "z5_posts"
#

INSERT INTO `z5_posts` VALUES (1,'krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 krovin0 ','2013-08-01 23:13:00',1,1),(6,'7\r\n8\r\n977354','2013-08-02 13:28:33',1,2),(7,'<b>asdf</b>','2013-08-02 13:54:39',1,2),(8,'&lt;h1&gt;adsf&lt;/h1&gt;','2013-08-02 13:57:18',1,2),(9,'asdfasdf','2013-08-02 14:09:27',2,2),(10,'asdfasdfasdf asdf asdf \r\n\r\n111\r\n3\r\n222','2013-08-02 14:41:07',5,3),(11,'444','2013-08-02 14:48:42',5,3),(12,'55556','2013-08-02 14:48:48',5,3),(13,'1','2013-08-02 14:59:05',1,2),(14,'2','2013-08-02 14:59:29',1,2),(15,'4','2013-08-02 15:00:12',1,2),(16,'1','2013-08-02 15:03:49',1,2),(17,'4','2013-08-02 15:05:56',1,2),(19,'5','2013-08-02 15:24:05',5,2),(20,'6','2013-08-02 15:24:17',5,2),(21,'6666','2013-08-02 15:26:33',5,2),(22,'888877779','2013-08-02 15:33:45',5,2),(23,'9999','2013-08-02 15:33:54',5,2),(25,'1','0000-00-00 00:00:00',5,2),(26,'2','0000-00-00 00:00:00',5,2),(28,'7','0000-00-00 00:00:00',5,2),(30,'7','0000-00-00 00:00:00',5,2),(31,'6666','0000-00-00 00:00:00',5,2),(33,'5555','0000-00-00 00:00:00',5,2),(34,'4','0000-00-00 00:00:00',5,2),(35,'3','0000-00-00 00:00:00',5,2),(36,'123123','2013-08-02 15:38:01',5,2),(37,'123123','2013-08-02 15:41:37',5,2),(38,'1111','2013-08-02 15:43:27',5,2);
