/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : holiday

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 12/06/2020 18:52:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_obj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图片名',
  `link_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图片描述',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES (1, 'banner.jpg', NULL, NULL, NULL, NULL);
INSERT INTO `banner` VALUES (2, 'banner.jpg', NULL, NULL, NULL, NULL);
INSERT INTO `banner` VALUES (3, 'banner.jpg', NULL, NULL, NULL, NULL);
INSERT INTO `banner` VALUES (4, 'banner.jpg', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for banner_images
-- ----------------------------
DROP TABLE IF EXISTS `banner_images`;
CREATE TABLE `banner_images`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_product` smallint(8) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES (1, '深圳华利达包装展示有限公司', 302, '2020-06-03 10:59:45');
INSERT INTO `company` VALUES (2, '山东恒硕塑业有限公司', 187, '2020-06-03 11:07:14');
INSERT INTO `company` VALUES (3, '东莞市泽林纸托包装制品有限公司', 525, '2020-06-03 11:07:22');
INSERT INTO `company` VALUES (4, '永顺和纸业有限公司\r\n', 1186, '2020-06-03 11:07:32');
INSERT INTO `company` VALUES (5, '安徽鑫科生物有限公司\r\n', 64, '2020-06-03 11:08:13');
INSERT INTO `company` VALUES (6, '腾亚包装(营口)有限公司\r\n', 47, '2020-06-03 11:08:14');
INSERT INTO `company` VALUES (7, '中山诚展铝塑复合包装有限公司\r\n', 344, '2020-06-03 11:08:15');
INSERT INTO `company` VALUES (8, '中山市三叶花日用品有限公司\r\n', 876, '2020-06-03 11:08:16');
INSERT INTO `company` VALUES (9, '义乌市古邑工艺品有限公司\r\n', 58, '2020-06-03 11:08:17');
INSERT INTO `company` VALUES (10, '汕头高新区贝吉塔网络科技有限公司\r\n', 49, '2020-06-03 11:08:19');
INSERT INTO `company` VALUES (11, '合肥盒盒美包装科技有限公司', 562, '2020-06-03 13:52:14');
INSERT INTO `company` VALUES (12, '东莞宇宙环保科技有限公司', 1016, '2020-06-04 11:48:30');
INSERT INTO `company` VALUES (13, '昆山长菁包装材料有限公司', 56, '2020-06-04 19:14:27');
INSERT INTO `company` VALUES (14, '山东飞鹏塑料包装有限公司', 1791, '2020-06-05 10:42:44');
INSERT INTO `company` VALUES (15, '天津市鑫淼家联塑料制品有限公司', 18, '2020-06-08 18:41:54');
INSERT INTO `company` VALUES (16, '安平县杰昌丝网制品有有限公司', 8, '2020-06-11 16:47:29');

-- ----------------------------
-- Table structure for desc_type
-- ----------------------------
DROP TABLE IF EXISTS `desc_type`;
CREATE TABLE `desc_type`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` tinyint(2) NULL DEFAULT NULL COMMENT '1:文字 |2：图片 |3：视频',
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of desc_type
-- ----------------------------
INSERT INTO `desc_type` VALUES (1, '产品信息', 1, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (2, '产品信息', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (3, '产品详情', 1, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (4, '产品详情', 2, '2020-06-03 14:06:13');
INSERT INTO `desc_type` VALUES (5, '产品实拍', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (6, '产品特点', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (7, '适用场景', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (8, '证书展示', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (9, '包装展示', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (10, '产品规格', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (11, '产品展示', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (12, '产品用途', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (13, '工厂环境', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (14, '定制路程', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (15, '产品具体参数', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (16, '包装运输', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (17, '企业介绍', 2, '2020-06-03 14:04:48');
INSERT INTO `desc_type` VALUES (18, '产品用料', 2, '2020-06-03 14:04:48');

-- ----------------------------
-- Table structure for display_ranking
-- ----------------------------
DROP TABLE IF EXISTS `display_ranking`;
CREATE TABLE `display_ranking`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `product_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `keyword_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `ranking` tinyint(11) NULL DEFAULT NULL COMMENT '展示排名第几位',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `ranking_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 81 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of display_ranking
-- ----------------------------
INSERT INTO `display_ranking` VALUES (1, 1, 3, 1, 2, '2020-06-03 11:13:35', '2020-06-02');
INSERT INTO `display_ranking` VALUES (2, 2, 2, 1, 1, '2020-06-03 11:14:06', '2020-06-02');
INSERT INTO `display_ranking` VALUES (3, 3, 1, 1, 3, '2020-06-03 11:15:06', '2020-06-02');
INSERT INTO `display_ranking` VALUES (4, 4, 4, 1, 4, '2020-06-03 11:15:08', '2020-06-02');
INSERT INTO `display_ranking` VALUES (5, 5, 5, 1, 5, '2020-06-03 11:15:09', '2020-06-02');
INSERT INTO `display_ranking` VALUES (6, 1, 3, 1, 3, '2020-06-03 11:20:09', '2020-06-03');
INSERT INTO `display_ranking` VALUES (7, 2, 2, 1, 1, '2020-06-03 11:20:10', '2020-06-03');
INSERT INTO `display_ranking` VALUES (8, 3, 1, 1, 2, '2020-06-03 11:20:11', '2020-06-03');
INSERT INTO `display_ranking` VALUES (9, 4, 4, 1, 4, '2020-06-03 11:20:13', '2020-06-03');
INSERT INTO `display_ranking` VALUES (10, 5, 5, 1, 5, '2020-06-03 11:20:14', '2020-06-03');
INSERT INTO `display_ranking` VALUES (11, 1, 3, 2, 17, '2020-06-03 13:56:58', '2020-06-02');
INSERT INTO `display_ranking` VALUES (12, 6, 7, 2, 1, '2020-06-03 13:56:58', '2020-06-02');
INSERT INTO `display_ranking` VALUES (13, 7, 6, 2, 2, '2020-06-03 13:56:58', '2020-06-02');
INSERT INTO `display_ranking` VALUES (14, 8, 7, 2, 3, '2020-06-03 13:56:58', '2020-06-02');
INSERT INTO `display_ranking` VALUES (15, 9, 11, 2, 4, '2020-06-03 13:56:58', '2020-06-02');
INSERT INTO `display_ranking` VALUES (16, 10, 10, 2, 5, '2020-06-03 13:56:58', '2020-06-02');
INSERT INTO `display_ranking` VALUES (17, 1, 3, 2, 18, '2020-06-03 14:01:45', '2020-06-03');
INSERT INTO `display_ranking` VALUES (18, 6, 7, 2, 1, '2020-06-03 14:01:45', '2020-06-03');
INSERT INTO `display_ranking` VALUES (19, 7, 8, 2, 2, '2020-06-03 14:01:45', '2020-06-03');
INSERT INTO `display_ranking` VALUES (20, 8, 9, 2, 3, '2020-06-03 14:01:45', '2020-06-03');
INSERT INTO `display_ranking` VALUES (21, 10, 10, 2, 4, '2020-06-03 14:01:45', '2020-06-03');
INSERT INTO `display_ranking` VALUES (22, 11, 6, 2, 5, '2020-06-03 14:01:45', '2020-06-03');
INSERT INTO `display_ranking` VALUES (23, 1, 3, 1, 41, '2020-06-04 18:44:29', '2020-06-04');
INSERT INTO `display_ranking` VALUES (24, 3, 1, 1, 2, '2020-06-04 18:57:25', '2020-06-04');
INSERT INTO `display_ranking` VALUES (25, 4, 4, 1, 3, '2020-06-04 19:09:49', '2020-06-04');
INSERT INTO `display_ranking` VALUES (26, 5, 5, 1, 4, '2020-06-04 19:10:06', '2020-06-04');
INSERT INTO `display_ranking` VALUES (27, 6, 7, 2, 1, '2020-06-04 19:10:36', '2020-06-04');
INSERT INTO `display_ranking` VALUES (28, 8, 13, 2, 2, '2020-06-04 19:13:02', '2020-06-04');
INSERT INTO `display_ranking` VALUES (29, 10, 10, 2, 3, '2020-06-04 19:13:25', '2020-06-04');
INSERT INTO `display_ranking` VALUES (30, 9, 11, 2, 4, '2020-06-04 19:13:52', '2020-06-04');
INSERT INTO `display_ranking` VALUES (31, 913, 14, 2, 5, '2020-06-04 19:15:33', '2020-06-04');
INSERT INTO `display_ranking` VALUES (32, 14, 15, 1, 2, '2020-06-05 10:45:46', '2020-06-05');
INSERT INTO `display_ranking` VALUES (33, 2, 2, 1, 1, '2020-06-05 10:46:06', '2020-06-05');
INSERT INTO `display_ranking` VALUES (34, 4, 4, 1, 5, '2020-06-05 10:50:56', '2020-06-05');
INSERT INTO `display_ranking` VALUES (35, 1, 3, 1, 3, '2020-06-05 10:49:55', '2020-06-05');
INSERT INTO `display_ranking` VALUES (36, 4, 4, 1, 4, '2020-06-05 10:47:23', '2020-06-05');
INSERT INTO `display_ranking` VALUES (37, 7, 8, 2, 1, '2020-06-05 10:48:58', '2020-06-05');
INSERT INTO `display_ranking` VALUES (38, 8, 13, 2, 3, '2020-06-05 18:31:15', '2020-06-05');
INSERT INTO `display_ranking` VALUES (39, 10, 10, 2, 4, '2020-06-05 18:31:47', '2020-06-05');
INSERT INTO `display_ranking` VALUES (40, 11, 16, 2, 5, '2020-06-05 18:35:09', '2020-06-05');
INSERT INTO `display_ranking` VALUES (41, 1, 3, 1, 1, '2020-06-06 11:52:44', '2020-06-06');
INSERT INTO `display_ranking` VALUES (42, 3, 1, 1, 2, '2020-06-06 11:52:54', '2020-06-06');
INSERT INTO `display_ranking` VALUES (43, 4, 4, 1, 3, '2020-06-06 11:54:34', '2020-06-06');
INSERT INTO `display_ranking` VALUES (44, 5, 5, 1, 4, '2020-06-06 11:54:51', '2020-06-06');
INSERT INTO `display_ranking` VALUES (45, 12, 12, 1, 5, '2020-06-06 11:55:16', '2020-06-06');
INSERT INTO `display_ranking` VALUES (46, 7, 8, 2, 1, '2020-06-06 11:55:40', '2020-06-06');
INSERT INTO `display_ranking` VALUES (47, 6, 7, 2, 2, '2020-06-06 11:56:46', '2020-06-06');
INSERT INTO `display_ranking` VALUES (48, 8, 13, 2, 3, '2020-06-06 11:57:13', '2020-06-06');
INSERT INTO `display_ranking` VALUES (49, 13, 14, 2, 4, '2020-06-06 11:57:32', '2020-06-06');
INSERT INTO `display_ranking` VALUES (50, 10, 10, 2, 5, '2020-06-06 11:58:05', '2020-06-06');
INSERT INTO `display_ranking` VALUES (51, 8, 13, 2, 1, '2020-06-08 18:39:51', '2020-06-08');
INSERT INTO `display_ranking` VALUES (52, 11, 6, 2, 2, '2020-06-08 18:40:31', '2020-06-08');
INSERT INTO `display_ranking` VALUES (53, 7, 8, 2, 3, '2020-06-08 18:40:54', '2020-06-08');
INSERT INTO `display_ranking` VALUES (54, 6, 7, 2, 4, '2020-06-08 18:41:24', '2020-06-08');
INSERT INTO `display_ranking` VALUES (55, 15, 17, 2, 5, '2020-06-08 18:42:52', '2020-06-08');
INSERT INTO `display_ranking` VALUES (56, 2, 2, 1, 1, '2020-06-08 18:43:02', '2020-06-08');
INSERT INTO `display_ranking` VALUES (57, 14, 15, 1, 2, '2020-06-08 18:43:22', '2020-06-08');
INSERT INTO `display_ranking` VALUES (58, 1, 3, 1, 3, '2020-06-08 18:43:46', '2020-06-08');
INSERT INTO `display_ranking` VALUES (59, 3, 1, 1, 4, '2020-06-08 18:43:59', '2020-06-08');
INSERT INTO `display_ranking` VALUES (60, 4, 4, 1, 5, '2020-06-08 18:44:17', '2020-06-08');
INSERT INTO `display_ranking` VALUES (61, 14, 18, 2, 1, '2020-06-09 18:32:14', '2020-06-09');
INSERT INTO `display_ranking` VALUES (62, 7, 8, 2, 2, '2020-06-09 18:32:29', '2020-06-09');
INSERT INTO `display_ranking` VALUES (63, 6, 7, 2, 3, '2020-06-09 18:32:55', '2020-06-09');
INSERT INTO `display_ranking` VALUES (64, 9, 11, 2, 4, '2020-06-09 18:33:17', '2020-06-09');
INSERT INTO `display_ranking` VALUES (65, 8, 13, 2, 5, '2020-06-09 18:33:41', '2020-06-09');
INSERT INTO `display_ranking` VALUES (66, 2, 2, 1, 1, '2020-06-09 18:34:05', '2020-06-09');
INSERT INTO `display_ranking` VALUES (67, 14, 15, 1, 2, '2020-06-09 18:34:14', '2020-06-09');
INSERT INTO `display_ranking` VALUES (68, 3, 1, 1, 3, '2020-06-09 18:34:29', '2020-06-09');
INSERT INTO `display_ranking` VALUES (69, 1, 3, 1, 4, '2020-06-09 18:34:51', '2020-06-09');
INSERT INTO `display_ranking` VALUES (70, 5, 5, 1, 5, '2020-06-09 18:35:03', '2020-06-09');
INSERT INTO `display_ranking` VALUES (71, 2, 2, 1, 1, '2020-06-11 16:46:11', '2020-06-11');
INSERT INTO `display_ranking` VALUES (72, 14, 15, 1, 2, '2020-06-11 16:46:23', '2020-06-11');
INSERT INTO `display_ranking` VALUES (73, 3, 1, 1, 4, '2020-06-11 16:46:47', '2020-06-11');
INSERT INTO `display_ranking` VALUES (74, 1, 3, 1, 5, '2020-06-11 16:47:15', '2020-06-11');
INSERT INTO `display_ranking` VALUES (75, 16, 19, 1, 3, '2020-06-11 16:48:23', '2020-06-11');
INSERT INTO `display_ranking` VALUES (76, 14, 18, 2, 1, '2020-06-11 17:02:03', '2020-06-11');
INSERT INTO `display_ranking` VALUES (77, 7, 8, 2, 2, '2020-06-11 17:02:16', '2020-06-11');
INSERT INTO `display_ranking` VALUES (78, 6, 7, 2, 3, '2020-06-11 17:02:42', '2020-06-11');
INSERT INTO `display_ranking` VALUES (79, 9, 11, 2, 4, '2020-06-11 17:02:55', '2020-06-11');
INSERT INTO `display_ranking` VALUES (80, 8, 13, 2, 5, '2020-06-11 17:03:12', '2020-06-11');

-- ----------------------------
-- Table structure for friend_link
-- ----------------------------
DROP TABLE IF EXISTS `friend_link`;
CREATE TABLE `friend_link`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of friend_link
-- ----------------------------
INSERT INTO `friend_link` VALUES (1, 'http://www.bad.com', '百度adas', NULL, NULL);
INSERT INTO `friend_link` VALUES (2, 'http://www.hengfeng.com', '珩丰', NULL, NULL);
INSERT INTO `friend_link` VALUES (3, 'http://www.taobao.com', '淘宝', NULL, NULL);
INSERT INTO `friend_link` VALUES (4, 'http://www.baidu.com', 'baidu0', NULL, NULL);
INSERT INTO `friend_link` VALUES (5, 'http://www.apple.com', '苹果', NULL, NULL);
INSERT INTO `friend_link` VALUES (6, 'http://www.huawei.com', '华为', NULL, NULL);
INSERT INTO `friend_link` VALUES (7, 'http://www.baidu.com', 'baidu1asdadadadad', NULL, NULL);
INSERT INTO `friend_link` VALUES (8, 'http://www.baidu.com', 'baidu2', NULL, NULL);
INSERT INTO `friend_link` VALUES (9, 'http://www.hengfeng.com', '珩丰', NULL, NULL);
INSERT INTO `friend_link` VALUES (10, 'http://www.taobao.com', '淘宝', NULL, NULL);
INSERT INTO `friend_link` VALUES (11, 'http://www.baidu.com', 'baidu0', NULL, NULL);
INSERT INTO `friend_link` VALUES (12, 'http://www.apple.com', '苹果', NULL, NULL);

-- ----------------------------
-- Table structure for keyword
-- ----------------------------
DROP TABLE IF EXISTS `keyword`;
CREATE TABLE `keyword`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keyword
-- ----------------------------
INSERT INTO `keyword` VALUES (1, '可降解餐盒', '2020-06-03 10:59:22');
INSERT INTO `keyword` VALUES (2, '环保餐盒', '2020-06-03 10:59:29');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `inter_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '友情链接',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, '一次性饭盒质量怎样检测1', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (2, '\r\n一次性饭盒质量怎样检测2？', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (3, '一次性饭盒质量怎样检3', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (4, '一次性饭盒质量怎样检测？4', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (5, '一次性饭盒质量怎样检测？5', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (6, '一次性饭盒质量怎样检测？6', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (7, '一次性饭盒质量怎样检测？7', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');
INSERT INTO `news` VALUES (8, '一次性饭盒质量怎样检8', '一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。', '<p>\r\n							<span>一次性饭盒质量怎样检测</span><br />\r\n							一次性饭盒产品设计美观实用，不渗漏饭菜汤水的优良产品。厂房无尘车间设计，环境干净卫生，已得到国家QS单位验证通过。\r\n						</p>\r\n						<p>\r\n							建立完善质量管理体系、全方位规范化的管理制度，并拥有一批高素质技术人员，确保产品的质量!坚持以“技术领先、开拓创新”为原则，不断开发新产品，提升技术含量，让产品设计更多样化!\r\n						</p>\r\n						<p>\r\n							1、产品颜色、质地均匀，手感好，强度高;<br />\r\n							2、盛冷热食品时没有异味散发;<br />\r\n							3、易于回收和利用或环境降解;<br />\r\n							4、对生态环境和人体健康无害，达到国家食品卫生标准;<br />\r\n							5、产品上有企业名称或产品代号的明显标识。\r\n						</p>', 'http://baidu.com', '2020-06-11 18:29:10', '2020-06-11 18:29:10');

-- ----------------------------
-- Table structure for news_product
-- ----------------------------
DROP TABLE IF EXISTS `news_product`;
CREATE TABLE `news_product`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `bottom_price` decimal(10, 2) NULL DEFAULT NULL,
  `top_price` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 3, '沙拉打包盒 环保纸浆模塑 一次性餐具可降解纸浆餐盒', NULL, 0.60, 0.60, '2020-06-03 11:09:21', NULL);
INSERT INTO `product` VALUES (2, 2, '可降解餐盒', NULL, NULL, NULL, '2020-06-03 11:09:42', NULL);
INSERT INTO `product` VALUES (3, 1, '华利达一次性纸浆饭盒 环保可降解餐盒 轻食沙拉盒便当盒 外卖快餐盒 可冷藏可微波加热 量大价优', NULL, 0.62, 0.67, '2020-06-03 11:10:29', NULL);
INSERT INTO `product` VALUES (4, 4, '现货 批发 一次性纸餐盒 快餐外卖打包盒 饭盒环保可降解餐盒加厚', NULL, 0.16, 0.20, NULL, NULL);
INSERT INTO `product` VALUES (5, 5, '鑫科 便携环保一次性玉米淀粉三格餐盒带盖可降解餐具 餐厅外卖盒', NULL, 0.49, 0.49, NULL, NULL);
INSERT INTO `product` VALUES (6, 11, '盒小美环保牛皮纸快餐盒定做 一次性打包盒 沙拉外卖餐盒 一次性饭盒批发加印LOGO', NULL, 0.43, 0.43, NULL, NULL);
INSERT INTO `product` VALUES (7, 6, '方盒650_麦田_食品外卖打包饭盒_透明餐盒批发_一次性环保餐盒便当餐_设备厂家', NULL, 125.00, 125.00, NULL, NULL);
INSERT INTO `product` VALUES (8, 7, '厂家批发定制一次性环保餐盒 可封口铝箔盒 外卖打包饭盒', NULL, 1.20, 1.20, NULL, NULL);
INSERT INTO `product` VALUES (9, 8, '厂家直销一次性环保餐盒生产厂家', NULL, 0.80, 9.00, NULL, NULL);
INSERT INTO `product` VALUES (10, 10, '麦秆餐具盒三层便当盒带叉勺微波炉环保餐盒学生露营饭盒定制LOGO', NULL, 7.80, 8.20, NULL, NULL);
INSERT INTO `product` VALUES (11, 9, '厂家直销 新款日式单层木质便当盒 创意便携环保餐盒 榉木饭盒', NULL, 50.00, 50.00, NULL, NULL);
INSERT INTO `product` VALUES (12, 12, '一款健康环保一次性餐盒-快递打包盒-防水防油可降解餐盒', NULL, 0.03, 0.03, '2020-06-04 19:06:36', NULL);
INSERT INTO `product` VALUES (13, 8, '一次性环保餐盒批发', NULL, 0.80, 0.90, '2020-06-04 19:12:41', NULL);
INSERT INTO `product` VALUES (14, 13, '工厂直销一次性寿司盒 竹浆环保日式吸塑包装外卖盒餐盒打包盒长菁包装', NULL, 0.55, 0.60, '2020-06-04 19:15:17', NULL);
INSERT INTO `product` VALUES (15, 14, '可降解餐盒', NULL, 1.00, 1.00, '2020-06-05 10:45:27', NULL);
INSERT INTO `product` VALUES (16, 11, '环保级牛皮纸快餐盒定做 一次性打包盒 沙拉外卖餐盒 一次性饭盒批发加印LOGO', NULL, 0.43, 0.43, '2020-06-05 18:34:44', NULL);
INSERT INTO `product` VALUES (17, 15, '多格餐盒_鑫淼家联_环保餐盒', NULL, 90.00, 90.00, '2020-06-08 18:42:27', NULL);
INSERT INTO `product` VALUES (18, 14, '环保餐盒', NULL, 1.00, 1.00, '2020-06-09 18:31:45', NULL);
INSERT INTO `product` VALUES (19, 16, '可降解餐盒_可降解餐盒_北京可降解餐盒_可降解餐盒厂家 杰昌', NULL, 1.20, 1.20, '2020-06-11 16:48:04', NULL);

-- ----------------------------
-- Table structure for product_category
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pid` tinyint(4) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO `product_category` VALUES (1, '快餐盒系列', 0, '2020-06-12 13:47:07', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (2, '杯子系列', 0, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (3, '单格', 1, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (4, '两格', 1, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (5, '三格', 1, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (6, '四格', 1, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (7, '五格', 1, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (8, '500ML', 2, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (9, '带盖子', 3, '2020-06-12 13:47:21', '2020-06-12 13:47:21');
INSERT INTO `product_category` VALUES (10, '不带盖子', 3, '2020-06-12 13:47:21', '2020-06-12 13:47:21');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NULL DEFAULT NULL,
  `image_obj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图片名',
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (1, 1, 'show_d_img1.jpg', NULL);
INSERT INTO `product_images` VALUES (2, 2, 'show_d_img2.jpg', NULL);
INSERT INTO `product_images` VALUES (3, 3, 'show_img2.jpg', NULL);
INSERT INTO `product_images` VALUES (4, 4, 'show_img3.jpg', NULL);
INSERT INTO `product_images` VALUES (5, 5, 'zpc_img3jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (6, 6, 'zpc_img6jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (7, 7, 'zpc_img8jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (8, 8, 'zpc_img4jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (9, 9, 'zpc_img5jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (10, 10, 'show_d_img1.jpg', NULL);
INSERT INTO `product_images` VALUES (11, 11, 'show_d_img2.jpg', NULL);
INSERT INTO `product_images` VALUES (12, 12, 'show_img2.jpg', NULL);
INSERT INTO `product_images` VALUES (13, 13, 'show_img3.jpg', NULL);
INSERT INTO `product_images` VALUES (14, 14, 'zpc_img3jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (15, 15, 'zpc_img6jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (16, 16, 'zpc_img8jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (17, 17, 'zpc_img4jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (18, 18, 'zpc_img5jpg.jpg', NULL);
INSERT INTO `product_images` VALUES (19, 19, 'zpc_img6jpg.jpg', NULL);

-- ----------------------------
-- Table structure for web_config
-- ----------------------------
DROP TABLE IF EXISTS `web_config`;
CREATE TABLE `web_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '网站标题,这是SEO的重点。',
  `keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '网站关键词,这是SEO的重点。',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '网站描述,这是SEO的重点。',
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '公司名称',
  `logo_obj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'logo名, logo.jpg',
  `head_obj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '网站头部图片名,image.jpg',
  `news_banner_obj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '新闻banner',
  `product_banner_obj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '内部产品广告banner',
  `company_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系电话',
  `phone` int(10) NULL DEFAULT NULL COMMENT '联系人手机号码',
  `home_img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '主页详情图1',
  `home_img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '主页详情图2',
  `home_img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '主页详情图3',
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '版权部分加上网站名称和链接',
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of web_config
-- ----------------------------
INSERT INTO `web_config` VALUES (1, 1, '华利达官网', '可降解 环保', '一次性高档环保餐盒、可降解餐盒便当盒、外卖打包盒、多款式图案寿司盒、食品包装盒、酱料杯、分餐碟、汤碗、烧烤碗等由天然材料纸浆、甘蔗浆、秸秆制成。', '华利达餐盒', 'logo.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '华利达@2020 www.baidu.com', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
