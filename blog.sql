/*
Navicat MySQL Data Transfer

Source Server         : wyz
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-12 01:56:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_article`
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章表',
  `title` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `save_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `reading_volume` int(11) DEFAULT '0' COMMENT '阅读量',
  `content` text COMMENT '文章内容',
  `cid` int(11) DEFAULT NULL COMMENT '分类id',
  `is_del` int(11) NOT NULL DEFAULT '1' COMMENT '是否删除 1为有效  2为删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10007 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_article
-- ----------------------------
INSERT INTO `blog_article` VALUES ('10000', '这是帝天1', '2019-02-26 22:53:07', '2019-07-10 10:58:55', '41', '范德萨范德萨发方法广泛大概的  高峰时段告诉对方公司股东给给发', '1', '1');
INSERT INTO `blog_article` VALUES ('10001', '头发以后规范化风格好的1', '2019-02-26 22:54:08', '2019-07-10 10:58:58', '42', '东莞佛山官方干活干活干活就会更加', '2', '1');
INSERT INTO `blog_article` VALUES ('10002', '反对法给发格1', '2019-02-26 23:36:36', '2019-07-10 10:58:57', '54', '地方发生的发', '3', '1');
INSERT INTO `blog_article` VALUES ('10003', '方式发格发格1', '2019-02-26 23:36:47', '2019-07-10 10:58:58', '72', '的说法', '4', '1');
INSERT INTO `blog_article` VALUES ('10004', '反对发格1', '2019-02-26 23:37:02', '2019-07-10 10:58:53', '52', '            对方的 是法国                        对方的 是法国         \r\n            对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国                     对方的 是法国         ', '2', '1');
INSERT INTO `blog_article` VALUES ('10005', '听妈妈的话1', '2019-03-05 23:27:38', '2019-07-10 10:58:53', '82', '> Markdown\r\n\r\n# test1            ', '1', '1');
INSERT INTO `blog_article` VALUES ('10006', 'tp框架路由模式', '2019-03-08 15:36:52', '2019-07-10 10:58:52', '56', '①  基本get形式\r\nhttp://网址/index.php?m=分组&c=控制器&a=操作方法\r\n该方式是最底层的get形式、传统的参数传递方式，不时尚、不安全。\r\n②  pathinfo路径形式[默认方式]\r\nhttp://网址/index.php/分组/控制器/操作方法\r\nhttp://网址/index.php/Home/Index/advert\r\n③  rewrite重写形式(伪静态技术)省略index.php入口文件\r\n    http://网址/分组/控制器/操作方法\r\n    http://网址/Home/Index/index\r\n④  兼容形式\r\nhttp://网址/index.php?s=/分组/控制器/操作方法\r\nhttp://网址/index.php?s=/Home/Index/advert\r\n', '1', '1');

-- ----------------------------
-- Table structure for `blog_classify`
-- ----------------------------
DROP TABLE IF EXISTS `blog_classify`;
CREATE TABLE `blog_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类表',
  `class_name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `is_del` int(11) DEFAULT '1' COMMENT '1为有效 2为删除',
  `style` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL COMMENT '颜色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_classify
-- ----------------------------
INSERT INTO `blog_classify` VALUES ('1', 'PHP', '1', 'iconfont icon-php2', '#7014e8');
INSERT INTO `blog_classify` VALUES ('2', '数据库', '1', 'fa fa-database', '#f65314');
INSERT INTO `blog_classify` VALUES ('3', '随笔', '1', 'fa fa-pencil', '#ffbb00');
INSERT INTO `blog_classify` VALUES ('4', '阅读', '1', 'iconfont icon-yuedureading19', '#7cbb00');

-- ----------------------------
-- Table structure for `blog_user`
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `user_name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES ('1', 'zhouxuezhong', '9291a65ee13e179f0ee059f95e2ee3b1');
