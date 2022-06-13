# Host: localhost  (Version: 5.5.62-log)
# Date: 2022-06-13 13:39:24
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '用户姓名',
  `password` varchar(255) DEFAULT NULL COMMENT '用户密码',
  `age` tinyint(3) DEFAULT NULL COMMENT '年龄',
  `regtime` int(11) DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'me张傻','111111',48,1654997254),(2,'me张傻1','123456',33,1654997424),(3,'zwpzwp','123456',48,1655037239),(4,'me张傻11','111111',48,1655097667);
