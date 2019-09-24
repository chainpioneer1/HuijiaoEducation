/*
 Navicat Premium Data Transfer

 Source Server         : qdzyxm.hulalaedu.com
 Source Server Type    : MySQL
 Source Server Version : 50639
 Source Host           : qdzyxm.hulalaedu.com:3306
 Source Schema         : qdzyxm_db

 Target Server Type    : MySQL
 Target Server Version : 50639
 File Encoding         : 65001

 Date: 01/09/2019 09:05:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `admin_pass` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '账号',
  `admin_label` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `permission` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `admin_status` tinyint(2) NULL DEFAULT 0,
  `login_first_time` datetime(0) NULL DEFAULT NULL,
  `login_latest_time` datetime(0) NULL DEFAULT NULL,
  `login_count` int(10) NULL DEFAULT 0,
  `auth_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `access_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'admin', '8ddd9f255d7de5ff85f81eac6f8238de9d415e43cf133fb193d348262d0e6d6ce9ea17d6aed89a204124b90887e2241f2bf06f5327c1197f7b52fd4be8763b00', '最高管理员', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"1\",\"menu_30\":\"1\",\"menu_40\":\"1\",\"menu_50\":\"1\",\"menu_51\":\"1\",\"menu_52\":\"1\",\"menu_53\":\"1\"}', '2018-04-29 13:23:27', '2019-02-28 11:07:11', 1, '2018-08-18 02:25:52', '2019-08-30 17:17:39', 336, 'zypttaijiaoshi', '4224804d-d874-430d-821b-21176e0f734b');
INSERT INTO `admins` VALUES (7, 'manager', 'd641f4863642b84935f29f61be3eeb692ff337370a7e871776da0a8598ad692866bd66d4be57183fd910366e6794bc4aa0cf22939b7e363823eee3d2c245d056', 'manager', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"0\",\"menu_30\":\"0\",\"menu_40\":\"0\",\"menu_50\":\"1\",\"menu_51\":\"1\",\"menu_52\":\"1\",\"menu_53\":\"1\"}', '2018-04-29 13:28:57', '2019-02-28 11:07:35', 1, '2018-08-10 23:20:20', '2018-08-18 10:35:34', 6, '3150563', NULL);
INSERT INTO `admins` VALUES (8, 'hulala', 'f8350d92b4fcd210afdb391fc8fd56e2f09130f07c24a5670914ec2ee2a346a2485794b65f414a55712d6a4d9bf3cb4dced4ff78c90eccc3a74f4d84d6068d93', 'hulala', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"1\",\"menu_30\":\"0\",\"menu_40\":\"0\",\"menu_50\":\"0\",\"menu_51\":\"0\",\"menu_52\":\"0\",\"menu_53\":\"0\"}', '2018-05-09 15:05:23', '2019-02-25 01:06:35', 1, '2018-08-12 13:20:20', NULL, 3, NULL, NULL);
INSERT INTO `admins` VALUES (12, 'user', '921f25795ea569463f04e422c4b162b06f7885b80fd18d3e8d7936efa42975806ad7e9d73e7c5ca2c002e3d97f1ae099e2597087a8261b36cc38a4b5e5c9f27d', '123123', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"1\",\"menu_30\":\"1\",\"menu_40\":\"1\",\"menu_50\":\"1\",\"menu_51\":\"1\",\"menu_52\":\"1\",\"menu_53\":\"1\"}', '2019-02-25 00:56:04', '2019-02-25 01:06:40', 0, NULL, NULL, 0, NULL, NULL);
INSERT INTO `admins` VALUES (14, 'course_admin1', '7b1ddcff6d1b1e4844bcf2eca448ac49b99f91fbb5903dfe49009ac004ed9a8b416534639aef020063deb4f270d62b41958f87eb977584faa77b43bfabee382a', '课程小管1', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"0\",\"menu_30\":\"0\",\"menu_40\":\"0\",\"menu_50\":\"0\",\"menu_51\":\"0\",\"menu_52\":\"0\",\"menu_53\":\"0\"}', '2019-03-12 10:15:36', '2019-03-13 16:58:19', 0, '2019-03-13 16:57:45', '2019-05-06 13:13:14', 19, NULL, NULL);
INSERT INTO `admins` VALUES (15, 'course_admin2', '7b1ddcff6d1b1e4844bcf2eca448ac49b99f91fbb5903dfe49009ac004ed9a8b416534639aef020063deb4f270d62b41958f87eb977584faa77b43bfabee382a', '课程小管2', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"0\",\"menu_30\":\"0\",\"menu_40\":\"0\",\"menu_50\":\"0\",\"menu_51\":\"0\",\"menu_52\":\"0\",\"menu_53\":\"0\"}', '2019-03-12 10:17:11', '2019-03-13 17:13:34', 0, '2019-03-14 13:47:30', '2019-03-22 18:34:28', 39, NULL, NULL);
INSERT INTO `admins` VALUES (16, 'course_admin3', '7b1ddcff6d1b1e4844bcf2eca448ac49b99f91fbb5903dfe49009ac004ed9a8b416534639aef020063deb4f270d62b41958f87eb977584faa77b43bfabee382a', '课程小管3', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"0\",\"menu_30\":\"0\",\"menu_40\":\"0\",\"menu_50\":\"0\",\"menu_51\":\"0\",\"menu_52\":\"0\",\"menu_53\":\"0\"}', '2019-03-12 10:17:43', '2019-03-12 10:18:26', 0, '2019-03-18 11:25:58', '2019-03-22 18:38:13', 43, NULL, NULL);
INSERT INTO `admins` VALUES (20, 'course_admin4', '7b1ddcff6d1b1e4844bcf2eca448ac49b99f91fbb5903dfe49009ac004ed9a8b416534639aef020063deb4f270d62b41958f87eb977584faa77b43bfabee382a', '课程小管4', '{\"menu_00\":\"1\",\"menu_01\":\"1\",\"menu_02\":\"1\",\"menu_03\":\"1\",\"menu_10\":\"1\",\"menu_11\":\"1\",\"menu_20\":\"0\",\"menu_30\":\"0\",\"menu_40\":\"0\",\"menu_50\":\"0\",\"menu_51\":\"0\",\"menu_52\":\"0\",\"menu_53\":\"0\"}', '2019-03-18 09:22:57', '2019-03-18 09:23:10', 0, '2019-03-18 13:49:00', '2019-03-22 14:40:12', 10, NULL, NULL);

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner`  (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `banner_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `sort_order` int(5) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `icon_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `icon_path_m` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `course_id` int(2) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES (1, 'banner1', 1, 1, 'banner1bnr.png', NULL, 'banner1', 0, '2019-04-05 13:23:56', '2019-08-01 20:46:02');
INSERT INTO `banner` VALUES (2, 'banner2', 3, 1, 'banner2bnr.png', NULL, '', 0, '2019-04-22 08:28:57', '2019-06-26 16:56:09');
INSERT INTO `banner` VALUES (4, 'banner3', 2, 1, 'banner3bnr.png', NULL, '', 0, '2019-04-22 08:39:07', '2019-06-27 09:00:59');

-- ----------------------------
-- Table structure for tbl_class
-- ----------------------------
DROP TABLE IF EXISTS `tbl_class`;
CREATE TABLE `tbl_class`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `teacher_id` int(10) NULL DEFAULT NULL,
  `class_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_class
-- ----------------------------
INSERT INTO `tbl_class` VALUES (21, '1-3', 370, '12354684', '2018-07-28 17:13:09');
INSERT INTO `tbl_class` VALUES (25, '1-4', 370, NULL, '2019-04-15 22:56:49');
INSERT INTO `tbl_class` VALUES (32, '1-3', 380, NULL, '2019-04-17 20:08:40');
INSERT INTO `tbl_class` VALUES (33, '1-6', 370, NULL, '2019-04-18 16:00:05');
INSERT INTO `tbl_class` VALUES (34, '1-3', 383, NULL, '2019-04-25 10:54:53');

-- ----------------------------
-- Table structure for tbl_huijiao_content_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_content_type`;
CREATE TABLE `tbl_huijiao_content_type`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `contenttype_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `icon_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `icon_path_m` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_content_type
-- ----------------------------
INSERT INTO `tbl_huijiao_content_type` VALUES (11, '01', '课文动画', 1, 'uploads/contents/01019031917512706718jb.png', 'uploads/contents/01019031917512706718jbm.png', '2019-03-18 11:52:52', '2019-03-19 17:51:27');
INSERT INTO `tbl_huijiao_content_type` VALUES (12, '16', '生字课件', 1, 'uploads/contents/02019031917520006764jb.png', 'uploads/contents/02019031917520006764jbm.png', '2019-03-18 11:54:34', '2019-03-20 10:28:01');
INSERT INTO `tbl_huijiao_content_type` VALUES (13, '17', '拓展阅读', 1, 'uploads/contents/03019031917542607648jb.png', 'uploads/contents/03019031917542607648jbm.png', '2019-03-18 11:55:17', '2019-03-20 10:28:19');
INSERT INTO `tbl_huijiao_content_type` VALUES (14, '04', '经典诵读', 1, 'uploads/contents/04019031917544506844jb.png', 'uploads/contents/04019031917544506844jbm.png', '2019-03-18 11:56:04', '2019-03-19 17:54:45');
INSERT INTO `tbl_huijiao_content_type` VALUES (15, '05', '课堂助手', 1, 'uploads/contents/05019031917550306272jb.png', 'uploads/contents/05019031917550306272jbm.png', '2019-03-18 11:57:02', '2019-03-19 17:55:03');
INSERT INTO `tbl_huijiao_content_type` VALUES (16, '06', '教学设计', 1, 'uploads/contents/06019031917552402640jb.png', 'uploads/contents/06019031917552402640jbm.png', '2019-03-18 11:57:57', '2019-03-19 17:55:24');
INSERT INTO `tbl_huijiao_content_type` VALUES (17, '07', '参考资料', 1, 'uploads/contents/07019031918012508950jb.png', 'uploads/contents/07019031918012508950jbm.png', '2019-03-18 11:59:19', '2019-03-19 18:01:25');
INSERT INTO `tbl_huijiao_content_type` VALUES (18, '08', '数学故事', 1, 'uploads/contents/08019031918021406599jb.png', 'uploads/contents/08019031918021406599jbm.png', '2019-03-18 11:59:57', '2019-03-19 18:02:14');
INSERT INTO `tbl_huijiao_content_type` VALUES (19, '09', '教学助手', 1, 'uploads/contents/09019031918024007144jb.png', 'uploads/contents/09019031918024007144jbm.png', '2019-03-18 12:00:52', '2019-03-19 18:02:40');
INSERT INTO `tbl_huijiao_content_type` VALUES (20, '10', '微课视频', 1, 'uploads/contents/10019031918025403387jb.png', 'uploads/contents/10019031918025403387jbm.png', '2019-03-18 12:34:48', '2019-03-19 18:02:54');
INSERT INTO `tbl_huijiao_content_type` VALUES (21, '11', '套卷资源', 1, 'uploads/contents/11019031918034106519jb.png', 'uploads/contents/11019031918034106519jbm.png', '2019-03-18 12:35:30', '2019-03-19 18:03:41');
INSERT INTO `tbl_huijiao_content_type` VALUES (22, '12', '字词句知识', 1, 'uploads/contents/12019031918035504203jb.png', 'uploads/contents/12019031918035504203jbm.png', '2019-03-18 12:36:23', '2019-03-19 18:03:55');
INSERT INTO `tbl_huijiao_content_type` VALUES (23, '13', '数学小工具', 1, 'uploads/contents/13019031918041705065jb.png', 'uploads/contents/13019031918041705065jbm.png', '2019-03-18 12:36:56', '2019-03-19 18:04:17');
INSERT INTO `tbl_huijiao_content_type` VALUES (24, '14', '随课练习套卷', 1, 'uploads/contents/14019031918043601106jb.png', 'uploads/contents/14019031918043601106jbm.png', '2019-03-18 12:37:31', '2019-03-19 18:04:36');
INSERT INTO `tbl_huijiao_content_type` VALUES (25, '15', '单元练习套卷', 1, 'uploads/contents/15019031918045406163jb.png', 'uploads/contents/15019031918045406163jbm.png', '2019-03-18 12:38:11', '2019-03-19 18:04:54');

-- ----------------------------
-- Table structure for tbl_huijiao_contents
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_contents`;
CREATE TABLE `tbl_huijiao_contents`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content_no` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `additional_info` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `status` int(1) NULL DEFAULT 0 COMMENT '0-created, 1-published, 2-favorited',
  `is_download` int(1) NULL DEFAULT 1,
  `is_mobile` int(1) NULL DEFAULT 1,
  `user_id` int(10) NULL DEFAULT NULL,
  `course_type_id` int(10) NULL DEFAULT NULL,
  `content_type_no` int(10) NULL DEFAULT NULL,
  `content_type_id` int(10) NULL DEFAULT NULL COMMENT '1-zip,2-video,3-image,4-docx,5-pdf,6-html',
  `icon_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon_path_m` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sort_order` int(10) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1197 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_contents
-- ----------------------------
INSERT INTO `tbl_huijiao_contents` VALUES (88, '45', '2', '', 1, 1, 1, 0, 37, 10, 2, NULL, NULL, 'uploads/contents/0019031811250003888nr.mp4', 0, '2019-03-18 11:25:00', '2019-03-18 11:25:00');
INSERT INTO `tbl_huijiao_contents` VALUES (90, 'bb0201030101001', '小蝌蚪找妈妈', '', 1, 1, 1, 0, 46, 11, 2, NULL, NULL, 'uploads/contents/0019031813510801817nr.mp4', 0, '2019-03-18 13:51:08', '2019-03-18 13:51:08');
INSERT INTO `tbl_huijiao_contents` VALUES (91, 'qd0202020102001', '十几减9的退位减法', '', 1, 1, 0, 0, 38, 16, 0, NULL, NULL, 'uploads/contents/0019031814132401022nr.doc', 0, '2019-03-18 14:13:24', '2019-03-18 14:22:37');
INSERT INTO `tbl_huijiao_contents` VALUES (92, 'qd0202020202001', '十几减8、7的退位减法', '', 1, 1, 0, 0, 39, 16, 0, NULL, NULL, 'uploads/contents/0019031814141903705nr.doc', 0, '2019-03-18 14:14:19', '2019-03-18 14:22:44');
INSERT INTO `tbl_huijiao_contents` VALUES (93, 'qd0202020302001', '十几减6、5、4、3、2', '', 1, 1, 0, 0, 40, 16, 0, NULL, NULL, 'uploads/contents/0019031814145302374nr.doc', 0, '2019-03-18 14:14:53', '2019-03-18 14:22:49');
INSERT INTO `tbl_huijiao_contents` VALUES (94, 'qd0202020402001', '认识钟表', '', 1, 1, 0, 0, 41, 16, 0, NULL, NULL, 'uploads/contents/0019031814161309051nr.doc', 0, '2019-03-18 14:16:13', '2019-03-18 14:22:53');
INSERT INTO `tbl_huijiao_contents` VALUES (95, 'qd0202020502001', '100以内数的认识', '', 1, 1, 0, 0, 42, 16, 0, NULL, NULL, 'uploads/contents/0019031814184204375nr.doc', 0, '2019-03-18 14:18:42', '2019-03-18 14:22:58');
INSERT INTO `tbl_huijiao_contents` VALUES (96, 'qd0202020602001', '100以内数的大小比较', '', 1, 1, 0, 0, 43, 16, 0, NULL, NULL, 'uploads/contents/0019031814210201033nr.doc', 0, '2019-03-18 14:21:02', '2019-03-18 14:23:03');
INSERT INTO `tbl_huijiao_contents` VALUES (97, 'qd0202020702001', '整十数的加减法', '', 1, 1, 0, 0, 44, 16, 4, NULL, NULL, 'uploads/contents/97019031910173502801nr.doc', 0, '2019-03-18 14:21:46', '2019-03-19 10:17:35');
INSERT INTO `tbl_huijiao_contents` VALUES (98, 'qd0202020802001', '整十数加减一位数', '', 1, 1, 0, 0, 50, 16, 4, NULL, NULL, 'uploads/contents/98019031910162506330nr.doc', 0, '2019-03-18 14:24:26', '2019-03-19 10:16:25');
INSERT INTO `tbl_huijiao_contents` VALUES (99, 'qd0202021002001', '认识图形', '', 1, 1, 0, 0, 49, 16, 0, NULL, NULL, 'uploads/contents/0019031814253701388nr.doc', 0, '2019-03-18 14:25:37', '2019-03-18 14:25:44');
INSERT INTO `tbl_huijiao_contents` VALUES (100, 'qd0202021202001', '两位数加一位数和整十数', '', 1, 1, 0, 0, 51, 16, 0, NULL, NULL, 'uploads/contents/0019031814263608973nr.doc', 0, '2019-03-18 14:26:36', '2019-03-18 14:57:41');
INSERT INTO `tbl_huijiao_contents` VALUES (101, 'qd0202021402001', '一个数比另一个数多几或少几', '', 1, 1, 0, 0, 53, 16, 4, NULL, NULL, 'uploads/contents/101019031910241705251nr.doc', 0, '2019-03-18 14:30:37', '2019-03-19 10:24:17');
INSERT INTO `tbl_huijiao_contents` VALUES (102, 'qd0202021502001', '两位数减一位数（退位）', 'uploads/contents/102019031910272809321fj.doc', 1, 1, 0, 0, 54, 16, 4, NULL, NULL, 'uploads/contents/102019031910321206153nr.doc', 0, '2019-03-18 14:32:07', '2019-03-19 10:32:12');
INSERT INTO `tbl_huijiao_contents` VALUES (103, 'qd0202020106001', '十几减9的退位减法', 'uploads/contents/103019031814452102639fj.doc', 1, 1, 1, 0, 38, 24, 4, NULL, NULL, 'uploads/contents/103019031814452102639nr.doc', 0, '2019-03-18 14:42:46', '2019-03-18 14:45:21');
INSERT INTO `tbl_huijiao_contents` VALUES (104, 'qd0202021602001', '认识人民币和人民币的换算', '', 1, 1, 0, 0, 55, 16, 4, NULL, NULL, 'uploads/contents/104019031910342204831nr.doc', 0, '2019-03-18 14:46:15', '2019-03-19 10:34:22');
INSERT INTO `tbl_huijiao_contents` VALUES (105, 'qd0202021802001', '两位数加两位数（不进位）', '', 1, 1, 0, 0, 57, 16, 0, NULL, NULL, 'uploads/contents/0019031814472507420nr.doc', 0, '2019-03-18 14:47:25', '2019-03-18 14:48:12');
INSERT INTO `tbl_huijiao_contents` VALUES (106, 'qd0202020206001', '十几减8、7的退位减法', 'uploads/contents/0019031814473408428fj.doc', 1, 1, 1, 0, 39, 24, 4, NULL, NULL, 'uploads/contents/0019031814473408428nr.doc', 0, '2019-03-18 14:47:34', '2019-03-18 14:47:34');
INSERT INTO `tbl_huijiao_contents` VALUES (107, 'qd0202021902001', '两位数减两位数（不退位）', '', 1, 1, 0, 0, 58, 16, 4, NULL, NULL, 'uploads/contents/0019031814480208432nr.doc', 0, '2019-03-18 14:48:02', '2019-03-18 14:48:02');
INSERT INTO `tbl_huijiao_contents` VALUES (108, 'qd0202020306001', '十几减6、5、4、3、2', 'uploads/contents/0019031814485008615fj.doc', 1, 1, 1, 0, 40, 24, 4, NULL, NULL, 'uploads/contents/0019031814485008615nr.doc', 0, '2019-03-18 14:48:50', '2019-03-18 14:48:50');
INSERT INTO `tbl_huijiao_contents` VALUES (109, 'qd0202022002001', '两位数加两位数（进位）', '', 1, 1, 0, 0, 59, 16, 0, NULL, NULL, 'uploads/contents/0019031814490209093nr.doc', 0, '2019-03-18 14:49:02', '2019-03-18 14:49:17');
INSERT INTO `tbl_huijiao_contents` VALUES (110, 'qd0202020406001', '认识钟表', 'uploads/contents/0019031814493105833fj.doc', 1, 1, 1, 0, 41, 24, 4, NULL, NULL, 'uploads/contents/0019031814493105833nr.doc', 0, '2019-03-18 14:49:31', '2019-03-18 14:49:31');
INSERT INTO `tbl_huijiao_contents` VALUES (111, 'qd0202022102001', '两位数减两位数（退位）', '', 1, 1, 0, 0, 60, 16, 4, NULL, NULL, 'uploads/contents/0019031814501208650nr.doc', 0, '2019-03-18 14:50:12', '2019-03-18 14:50:12');
INSERT INTO `tbl_huijiao_contents` VALUES (112, 'qd0202020506001', '100以内数的认识', 'uploads/contents/0019031814503006863fj.doc', 1, 1, 1, 0, 42, 24, 4, NULL, NULL, 'uploads/contents/0019031814503006863nr.doc', 0, '2019-03-18 14:50:30', '2019-03-18 14:50:30');
INSERT INTO `tbl_huijiao_contents` VALUES (113, 'qd0202020606001', '100以内数的大小比较', 'uploads/contents/113019031910463409578fj.doc', 1, 1, 1, 0, 43, 24, 4, NULL, NULL, 'uploads/contents/113019031910463409578nr.doc', 0, '2019-03-18 14:51:42', '2019-03-19 10:46:34');
INSERT INTO `tbl_huijiao_contents` VALUES (114, 'qd0202022202001', '100以内连加、连减、加减混合运算', '', 1, 1, 0, 0, 61, 16, 4, NULL, NULL, 'uploads/contents/0019031814515304381nr.doc', 0, '2019-03-18 14:51:53', '2019-03-18 14:51:53');
INSERT INTO `tbl_huijiao_contents` VALUES (115, 'qd0202020706001', '整十数的加减法', 'uploads/contents/115019031817182207811fj.doc', 1, 1, 1, 0, 44, 24, 4, NULL, NULL, 'uploads/contents/115019031817182207811nr.doc', 0, '2019-03-18 14:52:53', '2019-03-18 17:18:22');
INSERT INTO `tbl_huijiao_contents` VALUES (116, 'qd0202022502001', '认识长度单位“米”', '', 1, 1, 0, 0, 63, 16, 0, NULL, NULL, 'uploads/contents/116019031814552905861nr.doc', 0, '2019-03-18 14:53:57', '2019-03-18 14:56:34');
INSERT INTO `tbl_huijiao_contents` VALUES (117, 'qd0202020806001', '整十数加减一位数', 'uploads/contents/117019031817170905744fj.doc', 1, 1, 1, 0, 50, 24, 4, NULL, NULL, 'uploads/contents/117019031817170905744nr.doc', 0, '2019-03-18 14:54:01', '2019-03-18 17:17:09');
INSERT INTO `tbl_huijiao_contents` VALUES (118, 'qd0202022402001', '认识长度单位“厘米”', '', 1, 1, 0, 0, 62, 16, 4, NULL, NULL, 'uploads/contents/0019031814545801302nr.doc', 0, '2019-03-18 14:54:58', '2019-03-18 14:54:58');
INSERT INTO `tbl_huijiao_contents` VALUES (119, 'qd0202022702001', '简单的数据收集和整理', '', 1, 1, 0, 0, 64, 16, 4, NULL, NULL, 'uploads/contents/0019031814555907252nr.doc', 0, '2019-03-18 14:55:59', '2019-03-18 14:55:59');
INSERT INTO `tbl_huijiao_contents` VALUES (120, 'qd0202021006001', '认识图形', 'uploads/contents/0019031814590101564fj.doc', 1, 1, 1, 0, 49, 24, 4, NULL, NULL, 'uploads/contents/0019031814590101564nr.doc', 0, '2019-03-18 14:59:01', '2019-03-18 14:59:01');
INSERT INTO `tbl_huijiao_contents` VALUES (121, 'qd0202021206001', '两位数加一位数和整十数', 'uploads/contents/0019031815010407805fj.doc', 1, 1, 1, 0, 51, 24, 4, NULL, NULL, 'uploads/contents/0019031815010407805nr.doc', 0, '2019-03-18 15:01:04', '2019-03-18 15:01:04');
INSERT INTO `tbl_huijiao_contents` VALUES (122, 'qd0202021306001', '两位数加一位数进位加', 'uploads/contents/0019031815024704697fj.doc', 1, 1, 1, 0, 52, 24, 4, NULL, NULL, 'uploads/contents/0019031815024704697nr.doc', 0, '2019-03-18 15:02:47', '2019-03-18 15:02:47');
INSERT INTO `tbl_huijiao_contents` VALUES (123, 'qd0202021406001', '一个数比另一个数多几或少几', 'uploads/contents/123019031910345604659fj.doc', 1, 1, 1, 0, 53, 24, 4, NULL, NULL, 'uploads/contents/123019031910345604659nr.doc', 0, '2019-03-18 15:04:09', '2019-03-19 10:34:56');
INSERT INTO `tbl_huijiao_contents` VALUES (124, 'qd0202021506001', '两位数减一位数（退位）', 'uploads/contents/0019031815055103586fj.doc', 1, 1, 1, 0, 54, 24, 4, NULL, NULL, 'uploads/contents/0019031815055103586nr.doc', 0, '2019-03-18 15:05:51', '2019-03-18 15:05:51');
INSERT INTO `tbl_huijiao_contents` VALUES (125, 'qd0202020103001', '十几减9的退位减法', '', 1, 1, 0, 0, 38, 15, 4, NULL, NULL, 'uploads/contents/125019032017351409787nr.ppt', 0, '2019-03-18 15:05:58', '2019-03-20 17:35:14');
INSERT INTO `tbl_huijiao_contents` VALUES (126, 'qd0202021606001', '认识人民币和人民币的换算', 'uploads/contents/0019031815072807091fj.doc', 1, 1, 1, 0, 55, 24, 4, NULL, NULL, 'uploads/contents/0019031815072807091nr.doc', 0, '2019-03-18 15:07:28', '2019-03-18 15:07:28');
INSERT INTO `tbl_huijiao_contents` VALUES (127, 'qd0202020401001', '认识钟表', '', 1, 0, 1, 0, 41, 18, 2, NULL, NULL, 'uploads/contents/0019031815074303289nr.mp4', 0, '2019-03-18 15:07:43', '2019-03-18 15:07:43');
INSERT INTO `tbl_huijiao_contents` VALUES (128, 'qd0202021706001', '人民币之间的加减法', 'uploads/contents/0019031815091003259fj.doc', 1, 1, 1, 0, 56, 24, 4, NULL, NULL, 'uploads/contents/0019031815091003259nr.doc', 0, '2019-03-18 15:09:10', '2019-03-18 15:09:10');
INSERT INTO `tbl_huijiao_contents` VALUES (129, 'qd0202021806001', '两位数加两位数（不进位）', 'uploads/contents/0019031815104804592fj.doc', 1, 1, 1, 0, 57, 24, 4, NULL, NULL, 'uploads/contents/0019031815104804592nr.doc', 0, '2019-03-18 15:10:48', '2019-03-18 15:10:48');
INSERT INTO `tbl_huijiao_contents` VALUES (130, 'qd0202021906001', '两位数减两位数（不退位）', 'uploads/contents/0019031815120106639fj.doc', 1, 1, 1, 0, 58, 24, 4, NULL, NULL, 'uploads/contents/0019031815120106639nr.doc', 0, '2019-03-18 15:12:01', '2019-03-18 15:12:01');
INSERT INTO `tbl_huijiao_contents` VALUES (131, 'qd0202022006001', '两位数加两位数（进位）', 'uploads/contents/0019031815133805679fj.doc', 1, 1, 1, 0, 59, 24, 4, NULL, NULL, 'uploads/contents/0019031815133805679nr.doc', 0, '2019-03-18 15:13:38', '2019-03-18 15:13:38');
INSERT INTO `tbl_huijiao_contents` VALUES (132, 'qd0202022106001', '两位数减两位数（退位）', 'uploads/contents/0019031815150809084fj.doc', 1, 1, 1, 0, 60, 24, 4, NULL, NULL, 'uploads/contents/0019031815150809084nr.doc', 0, '2019-03-18 15:15:08', '2019-03-18 15:15:08');
INSERT INTO `tbl_huijiao_contents` VALUES (133, 'qd0202020203001', '十几减8、7的退位减法', '', 1, 1, 0, 0, 39, 15, 4, NULL, NULL, 'uploads/contents/133019032017354609473nr.ppt', 0, '2019-03-18 15:16:36', '2019-03-20 17:35:46');
INSERT INTO `tbl_huijiao_contents` VALUES (134, 'qd0202022206001', '100以内连加、连减、加减混合运算', 'uploads/contents/0019031815165307528fj.doc', 1, 1, 1, 0, 61, 24, 4, NULL, NULL, 'uploads/contents/0019031815165307528nr.doc', 0, '2019-03-18 15:16:53', '2019-03-18 15:16:53');
INSERT INTO `tbl_huijiao_contents` VALUES (135, 'qd0202022406001', '认识长度单位“厘米”', 'uploads/contents/0019031815183406688fj.doc', 1, 1, 1, 0, 62, 24, 0, NULL, NULL, 'uploads/contents/0019031815183406688nr.doc', 0, '2019-03-18 15:18:34', '2019-03-19 13:18:08');
INSERT INTO `tbl_huijiao_contents` VALUES (136, 'qd0202020303001', '十几减6、5、4、3、2', '', 1, 1, 0, 0, 40, 15, 4, NULL, NULL, 'uploads/contents/136019032017360308330nr.ppt', 0, '2019-03-18 15:19:33', '2019-03-20 17:36:03');
INSERT INTO `tbl_huijiao_contents` VALUES (137, 'qd0202022506001', '认识长度单位“米”', 'uploads/contents/0019031815194709899fj.doc', 1, 1, 1, 0, 63, 24, 4, NULL, NULL, 'uploads/contents/0019031815194709899nr.doc', 0, '2019-03-18 15:19:47', '2019-03-18 15:19:47');
INSERT INTO `tbl_huijiao_contents` VALUES (138, 'qd0202020403001', '认识钟表', '', 1, 1, 0, 0, 41, 15, 4, NULL, NULL, 'uploads/contents/138019032017362101126nr.ppt', 0, '2019-03-18 15:20:19', '2019-03-20 17:36:21');
INSERT INTO `tbl_huijiao_contents` VALUES (139, 'qd0202020503001', '100以内数的认识', '', 1, 1, 0, 0, 42, 15, 4, NULL, NULL, 'uploads/contents/139019032017363905594nr.ppt', 0, '2019-03-18 15:21:02', '2019-03-20 17:36:39');
INSERT INTO `tbl_huijiao_contents` VALUES (140, 'qd0202020603001', '100以内数的大小比较', '', 1, 1, 0, 0, 43, 15, 4, NULL, NULL, 'uploads/contents/140019032017365601671nr.ppt', 0, '2019-03-18 15:21:42', '2019-03-20 17:36:56');
INSERT INTO `tbl_huijiao_contents` VALUES (141, 'qd0202022706001', '简单的数据收集和整理', 'uploads/contents/0019031815223407419fj.doc', 1, 1, 1, 0, 64, 24, 4, NULL, NULL, 'uploads/contents/0019031815223407419nr.doc', 0, '2019-03-18 15:22:34', '2019-03-18 15:22:34');
INSERT INTO `tbl_huijiao_contents` VALUES (142, 'qd0202020703001', '整十数的加减法', '', 1, 1, 0, 0, 44, 15, 4, NULL, NULL, 'uploads/contents/142019032017371901291nr.ppt', 0, '2019-03-18 15:23:25', '2019-03-20 17:37:19');
INSERT INTO `tbl_huijiao_contents` VALUES (143, 'qd0202020803001', '整十数加减一位数', '', 1, 1, 0, 0, 50, 15, 4, NULL, NULL, 'uploads/contents/143019032017373807155nr.ppt', 0, '2019-03-18 15:25:48', '2019-03-20 17:37:38');
INSERT INTO `tbl_huijiao_contents` VALUES (144, 'qd0202021003001', '认识图形', '', 1, 1, 0, 0, 49, 15, 4, NULL, NULL, 'uploads/contents/144019032017380205898nr.ppt', 0, '2019-03-18 15:27:16', '2019-03-20 17:38:02');
INSERT INTO `tbl_huijiao_contents` VALUES (145, 'qd0202020108001', '第一单元 20以内的退位减法', 'uploads/contents/145019031911054901454fj.doc', 1, 1, 1, 0, 40, 25, 4, NULL, NULL, 'uploads/contents/145019031911054901454nr.doc', 0, '2019-03-18 15:32:36', '2019-03-19 11:05:49');
INSERT INTO `tbl_huijiao_contents` VALUES (146, 'bb0201030107001', '小蝌蚪找妈妈', '', 1, 1, 0, 0, 46, 16, 5, NULL, NULL, 'uploads/contents/146019031913591008650nr.pdf', 0, '2019-03-18 15:32:50', '2019-03-19 13:59:10');
INSERT INTO `tbl_huijiao_contents` VALUES (147, 'qd0202020208001', '第二单元 认识钟表', 'uploads/contents/147019031911053004412fj.doc', 1, 1, 1, 0, 41, 25, 4, NULL, NULL, 'uploads/contents/147019031911053004412nr.doc', 0, '2019-03-18 15:34:05', '2019-03-19 11:05:30');
INSERT INTO `tbl_huijiao_contents` VALUES (148, 'bsd0302020102001', '同底数幂的乘法', '', 1, 1, 0, 0, 65, 19, 0, NULL, NULL, 'uploads/contents/0019031815344201608nr.pptx', 0, '2019-03-18 15:34:42', '2019-03-19 14:34:50');
INSERT INTO `tbl_huijiao_contents` VALUES (149, 'qd0202021203001', '两位数加一位数和整十数', '', 1, 1, 0, 0, 51, 15, 4, NULL, NULL, 'uploads/contents/149019032017382007874nr.ppt', 0, '2019-03-18 15:35:39', '2019-03-20 17:38:20');
INSERT INTO `tbl_huijiao_contents` VALUES (150, 'qd0202020308001', '第三单元 100以内数的认识', 'uploads/contents/150019031911050704193fj.doc', 1, 1, 1, 0, 50, 25, 4, NULL, NULL, 'uploads/contents/150019031911050704193nr.doc', 0, '2019-03-18 15:35:55', '2019-03-19 11:05:07');
INSERT INTO `tbl_huijiao_contents` VALUES (151, 'qd0202020408001', '第四单元 认识图形', 'uploads/contents/151019031911044309088fj.doc', 1, 1, 1, 0, 49, 25, 4, NULL, NULL, 'uploads/contents/151019031911044309088nr.doc', 0, '2019-03-18 15:37:00', '2019-03-19 11:04:43');
INSERT INTO `tbl_huijiao_contents` VALUES (152, 'bsd0302020202001', '幂的乘方与积的乘方', '', 1, 1, 0, 0, 66, 19, 0, NULL, NULL, 'uploads/contents/0019031815372201833nr.pptx', 0, '2019-03-18 15:37:22', '2019-03-19 14:34:34');
INSERT INTO `tbl_huijiao_contents` VALUES (153, 'bsd0302020302001', '同底数幂的除法', '', 1, 1, 1, 0, 67, 19, 0, NULL, NULL, 'uploads/contents/0019031815382608003nr.pptx', 0, '2019-03-18 15:38:26', '2019-03-19 14:34:20');
INSERT INTO `tbl_huijiao_contents` VALUES (154, 'qd0202020508001', '第五单元 100以内的加减法（一）', 'uploads/contents/154019031911041701776fj.doc', 1, 1, 1, 0, 54, 25, 4, NULL, NULL, 'uploads/contents/154019031911041701776nr.doc', 0, '2019-03-18 15:38:27', '2019-03-19 11:04:17');
INSERT INTO `tbl_huijiao_contents` VALUES (155, 'qd0202020608001', '第六单元 认识人民币', 'uploads/contents/155019031911024306583fj.doc', 1, 1, 1, 0, 56, 25, 4, NULL, NULL, 'uploads/contents/155019031911024306583nr.doc', 0, '2019-03-18 15:39:43', '2019-03-19 11:02:43');
INSERT INTO `tbl_huijiao_contents` VALUES (156, 'bsd0302020402001', '整式的乘法', '', 1, 1, 1, 0, 68, 19, 0, NULL, NULL, 'uploads/contents/0019031815411101900nr.pptx', 0, '2019-03-18 15:41:11', '2019-03-19 14:34:06');
INSERT INTO `tbl_huijiao_contents` VALUES (157, 'qd0202020708001', '第七单元 100以内的加减法（二）', 'uploads/contents/0019031815411502805fj.doc', 1, 1, 1, 0, 61, 25, 0, NULL, NULL, 'uploads/contents/0019031815411502805nr.doc', 0, '2019-03-18 15:41:15', '2019-03-19 13:17:42');
INSERT INTO `tbl_huijiao_contents` VALUES (158, 'qd0202020808001', '第八单元 厘米、米的认识', 'uploads/contents/158019031910531502077fj.doc', 1, 1, 1, 0, 63, 25, 4, NULL, NULL, 'uploads/contents/158019031910531502077nr.doc', 0, '2019-03-18 15:42:28', '2019-03-19 10:53:15');
INSERT INTO `tbl_huijiao_contents` VALUES (159, 'qd0202020908001', '第九单元 统计', 'uploads/contents/159019031816373201476fj.doc', 1, 1, 1, 0, 64, 25, 4, NULL, NULL, 'uploads/contents/159019031816373201476nr.doc', 0, '2019-03-18 15:43:24', '2019-03-18 16:37:32');
INSERT INTO `tbl_huijiao_contents` VALUES (160, 'qd0202021303001', '两位数加一位数进位加', '', 1, 1, 0, 0, 52, 15, 4, NULL, NULL, 'uploads/contents/160019032017391304387nr.ppt', 0, '2019-03-18 15:44:19', '2019-03-20 17:39:13');
INSERT INTO `tbl_huijiao_contents` VALUES (161, 'qd0202021403001', '一个数比另一个数多几或少几', '', 1, 1, 0, 0, 53, 15, 4, NULL, NULL, 'uploads/contents/161019032017392903002nr.ppt', 0, '2019-03-18 15:46:35', '2019-03-20 17:39:29');
INSERT INTO `tbl_huijiao_contents` VALUES (162, 'bsd0302020502001', '平方差公式', '', 1, 1, 0, 0, 69, 19, 0, NULL, NULL, 'uploads/contents/0019031815544601398nr.pptx', 0, '2019-03-18 15:54:46', '2019-03-19 14:33:51');
INSERT INTO `tbl_huijiao_contents` VALUES (163, 'bsd0302020602001', '完全平方公式', '', 1, 1, 0, 0, 70, 19, 0, NULL, NULL, 'uploads/contents/0019031815572704895nr.pptx', 0, '2019-03-18 15:57:27', '2019-03-19 14:33:36');
INSERT INTO `tbl_huijiao_contents` VALUES (164, 'bsd0302020702001', '整式的除法', '', 1, 1, 0, 0, 71, 19, 0, NULL, NULL, 'uploads/contents/0019031816040301623nr.pptx', 0, '2019-03-18 16:04:03', '2019-03-19 14:33:23');
INSERT INTO `tbl_huijiao_contents` VALUES (165, 'bsd0302020802001', '两条直线的位置关系', '', 1, 1, 0, 0, 72, 19, 0, NULL, NULL, 'uploads/contents/0019031816053404835nr.pptx', 0, '2019-03-18 16:05:34', '2019-03-19 14:33:07');
INSERT INTO `tbl_huijiao_contents` VALUES (166, 'bsd0302020902001', '探索直线平行的条件', '', 1, 1, 0, 0, 73, 19, 0, NULL, NULL, 'uploads/contents/0019031816064108083nr.pptx', 0, '2019-03-18 16:06:41', '2019-03-19 14:32:50');
INSERT INTO `tbl_huijiao_contents` VALUES (167, 'bsd0302021002001', '平行线的性质', '', 1, 1, 0, 0, 74, 19, 0, NULL, NULL, 'uploads/contents/0019031816073001318nr.pptx', 0, '2019-03-18 16:07:30', '2019-03-19 14:32:34');
INSERT INTO `tbl_huijiao_contents` VALUES (168, 'bsd0302021102001', '用尺规作角', '', 1, 1, 0, 0, 75, 19, 0, NULL, NULL, 'uploads/contents/0019031816091403123nr.pptx', 0, '2019-03-18 16:09:14', '2019-03-19 14:31:11');
INSERT INTO `tbl_huijiao_contents` VALUES (169, 'bsd0302021202001', '认识三角形', '', 1, 1, 0, 0, 76, 19, 4, NULL, NULL, 'uploads/contents/169019032111084402621nr.pptx', 0, '2019-03-18 16:12:57', '2019-03-21 11:08:44');
INSERT INTO `tbl_huijiao_contents` VALUES (170, 'bsd0302021302001', '图形的全等', '', 1, 1, 0, 0, 77, 19, 4, NULL, NULL, 'uploads/contents/170019032111093904321nr.pptx', 0, '2019-03-18 16:14:44', '2019-03-21 11:09:39');
INSERT INTO `tbl_huijiao_contents` VALUES (171, 'qd0202021503001', '两位数减一位数（退位）', '', 1, 1, 0, 0, 54, 15, 4, NULL, NULL, 'uploads/contents/171019032017395106902nr.ppt', 0, '2019-03-18 16:15:51', '2019-03-20 17:39:51');
INSERT INTO `tbl_huijiao_contents` VALUES (172, 'bsd0302020103001', '同底数幂的乘法', '', 1, 1, 0, 0, 65, 16, 0, NULL, NULL, 'uploads/contents/0019031816155805435nr.doc', 0, '2019-03-18 16:15:58', '2019-03-19 14:30:39');
INSERT INTO `tbl_huijiao_contents` VALUES (173, 'qd0202020501001', '100以内数的认识', '', 1, 0, 1, 0, 42, 18, 2, NULL, NULL, 'uploads/contents/0019031816161202176nr.mp4', 0, '2019-03-18 16:16:13', '2019-03-18 16:16:13');
INSERT INTO `tbl_huijiao_contents` VALUES (174, 'bsd0302020203001', '幂的乘方与积的乘方', '', 1, 1, 1, 0, 66, 16, 0, NULL, NULL, 'uploads/contents/0019031816170601622nr.doc', 0, '2019-03-18 16:17:06', '2019-03-19 14:30:29');
INSERT INTO `tbl_huijiao_contents` VALUES (175, 'bsd0302020303001', '同底数幂的除法', '', 1, 1, 0, 0, 67, 16, 0, NULL, NULL, 'uploads/contents/0019031816180005175nr.doc', 0, '2019-03-18 16:18:00', '2019-03-19 14:30:19');
INSERT INTO `tbl_huijiao_contents` VALUES (176, 'bsd0302020403001', '整式的乘法', '', 1, 1, 1, 0, 68, 16, 0, NULL, NULL, 'uploads/contents/0019031816184606039nr.doc', 0, '2019-03-18 16:18:46', '2019-03-19 14:30:09');
INSERT INTO `tbl_huijiao_contents` VALUES (177, 'bsd0302020503001', '平方差公式', '', 1, 1, 1, 0, 69, 16, 0, NULL, NULL, 'uploads/contents/0019031816195201245nr.doc', 0, '2019-03-18 16:19:52', '2019-03-19 14:29:58');
INSERT INTO `tbl_huijiao_contents` VALUES (178, 'bsd0302020603001', '完全平方公式', '', 1, 1, 0, 0, 70, 16, 0, NULL, NULL, 'uploads/contents/0019031816204306032nr.doc', 0, '2019-03-18 16:20:43', '2019-03-19 14:29:47');
INSERT INTO `tbl_huijiao_contents` VALUES (179, 'bsd0302020703001', '整式的除法', '', 1, 1, 0, 0, 71, 16, 0, NULL, NULL, 'uploads/contents/0019031816212208036nr.doc', 0, '2019-03-18 16:21:22', '2019-03-19 14:29:33');
INSERT INTO `tbl_huijiao_contents` VALUES (180, 'bsd0302020803001', '两条直线的位置关系', '', 1, 1, 0, 0, 72, 16, 0, NULL, NULL, 'uploads/contents/0019031816222602689nr.doc', 0, '2019-03-18 16:22:26', '2019-03-19 14:28:53');
INSERT INTO `tbl_huijiao_contents` VALUES (181, 'bsd0302020903001', '探索直线平行的条件', '', 1, 1, 0, 0, 73, 16, 0, NULL, NULL, 'uploads/contents/0019031816231804949nr.doc', 0, '2019-03-18 16:23:18', '2019-03-19 14:28:39');
INSERT INTO `tbl_huijiao_contents` VALUES (182, 'bsd0302021003001', '平行线的性质', '', 1, 1, 0, 0, 74, 16, 0, NULL, NULL, 'uploads/contents/0019031816241405836nr.doc', 0, '2019-03-18 16:24:14', '2019-03-19 14:28:28');
INSERT INTO `tbl_huijiao_contents` VALUES (183, 'qd0202021603001', '认识人民币和人民币的换算', '', 1, 1, 0, 0, 55, 15, 4, NULL, NULL, 'uploads/contents/183019032017400801999nr.ppt', 0, '2019-03-18 16:25:37', '2019-03-20 17:40:08');
INSERT INTO `tbl_huijiao_contents` VALUES (184, 'bsd0302021103001', '用尺规作角', '', 1, 1, 0, 0, 75, 16, 0, NULL, NULL, 'uploads/contents/0019031816254406884nr.doc', 0, '2019-03-18 16:25:44', '2019-03-19 14:28:16');
INSERT INTO `tbl_huijiao_contents` VALUES (185, 'bsd0302021203001', '认识三角形', '', 1, 1, 0, 0, 76, 16, 4, NULL, NULL, 'uploads/contents/185019032111391903428nr.doc', 0, '2019-03-18 16:27:14', '2019-03-21 11:39:19');
INSERT INTO `tbl_huijiao_contents` VALUES (186, 'qd0202021703001', '人民币之间的加减法', '', 1, 1, 0, 0, 56, 15, 4, NULL, NULL, 'uploads/contents/186019032017403008235nr.ppt', 0, '2019-03-18 16:27:37', '2019-03-20 17:40:30');
INSERT INTO `tbl_huijiao_contents` VALUES (187, 'bsd0302021303001', '图形的全等', '', 1, 1, 0, 0, 77, 16, 4, NULL, NULL, 'uploads/contents/187019032111393609608nr.doc', 0, '2019-03-18 16:28:13', '2019-03-21 11:39:36');
INSERT INTO `tbl_huijiao_contents` VALUES (190, 'qd0202022203001', '100以内连加、连减、加减混合运算', '', 1, 1, 0, 0, 61, 15, 4, NULL, NULL, 'uploads/contents/190019032019221209725nr.ppt', 0, '2019-03-18 16:32:37', '2019-03-20 19:22:12');
INSERT INTO `tbl_huijiao_contents` VALUES (193, 'qd0202020603001', '100以内数的大小比较', '', 1, 0, 1, 0, 43, 18, 2, NULL, NULL, 'uploads/contents/0019031816341105427nr.mp4', 0, '2019-03-18 16:34:11', '2019-03-18 16:34:11');
INSERT INTO `tbl_huijiao_contents` VALUES (195, 'qd0202021903001', '两位数减两位数（不退位）', '', 1, 1, 0, 0, 58, 15, 4, NULL, NULL, 'uploads/contents/195019032017410306507nr.ppt', 0, '2019-03-18 16:35:22', '2019-03-20 17:41:03');
INSERT INTO `tbl_huijiao_contents` VALUES (197, 'qd0202021803001', '两位数加两位数（不进位）', '', 1, 1, 0, 0, 57, 15, 4, NULL, NULL, 'uploads/contents/197019032017404602001nr.ppt', 0, '2019-03-18 16:38:38', '2019-03-20 17:40:46');
INSERT INTO `tbl_huijiao_contents` VALUES (198, 'qd0202021001001', '认识图形', '', 1, 0, 1, 0, 49, 18, 0, NULL, NULL, 'uploads/contents/0019031816505607534nr.mp4', 0, '2019-03-18 16:50:56', '2019-03-18 16:53:22');
INSERT INTO `tbl_huijiao_contents` VALUES (199, 'qd0202022103001', '两位数加两位数（退位）', '', 1, 1, 0, 0, 60, 15, 4, NULL, NULL, 'uploads/contents/199019032017413808279nr.ppt', 0, '2019-03-18 16:56:21', '2019-03-20 17:41:38');
INSERT INTO `tbl_huijiao_contents` VALUES (200, 'qd0202021401001', '一个数比另一个数多几或少几', '', 1, 0, 1, 0, 53, 18, 2, NULL, NULL, 'uploads/contents/0019031816563904977nr.mp4', 0, '2019-03-18 16:56:39', '2019-03-18 16:56:39');
INSERT INTO `tbl_huijiao_contents` VALUES (201, 'qd0202022003001', '两位数加两位数（进位）', '', 1, 1, 0, 0, 59, 15, 4, NULL, NULL, 'uploads/contents/201019032017412103841nr.ppt', 0, '2019-03-18 16:58:01', '2019-03-20 17:41:21');
INSERT INTO `tbl_huijiao_contents` VALUES (202, 'qd0202022403001', '认识长度单位“厘米”', '', 1, 1, 0, 0, 62, 15, 4, NULL, NULL, 'uploads/contents/202019032017430803607nr.ppt', 0, '2019-03-18 17:00:47', '2019-03-20 17:43:08');
INSERT INTO `tbl_huijiao_contents` VALUES (203, 'qd0202022401001', '认识长度单位“厘米”', '', 1, 0, 1, 0, 62, 18, 2, NULL, NULL, 'uploads/contents/203019031913511806113nr.mp4', 0, '2019-03-18 17:01:21', '2019-03-19 13:51:18');
INSERT INTO `tbl_huijiao_contents` VALUES (204, 'qd0202022503001', '认识长度单位“米”', '', 1, 1, 0, 0, 63, 15, 4, NULL, NULL, 'uploads/contents/204019032017432305183nr.ppt', 0, '2019-03-18 17:02:03', '2019-03-20 17:43:23');
INSERT INTO `tbl_huijiao_contents` VALUES (205, 'qd0202022703001', '简单的数据收集和整理', '', 1, 1, 0, 0, 64, 15, 4, NULL, NULL, 'uploads/contents/205019032017434109993nr.ppt', 0, '2019-03-18 17:03:20', '2019-03-20 17:43:41');
INSERT INTO `tbl_huijiao_contents` VALUES (206, 'bsd0302020105001', '同底数幂的乘法', 'uploads/contents/206019031817132504624fj.docx', 1, 1, 1, 0, 65, 21, 4, NULL, NULL, 'uploads/contents/206019032214413005606nr.doc', 0, '2019-03-18 17:06:46', '2019-03-22 14:41:30');
INSERT INTO `tbl_huijiao_contents` VALUES (207, 'qd0202022701001', '简单的数据收集和整理', '', 1, 0, 1, 0, 64, 18, 0, NULL, NULL, 'uploads/contents/0019031817121909392nr.mp4', 0, '2019-03-18 17:12:19', '2019-03-19 13:15:50');
INSERT INTO `tbl_huijiao_contents` VALUES (208, 'bsd0302020205001', '幂的乘方与积的乘方', 'uploads/contents/0019031817194802689fj.doc', 1, 1, 1, 0, 66, 21, 4, NULL, NULL, 'uploads/contents/208019032214463001474nr.doc', 0, '2019-03-18 17:19:48', '2019-03-22 14:46:30');
INSERT INTO `tbl_huijiao_contents` VALUES (209, 'qd0202022501001', '认识长度单位“米”', '', 1, 0, 1, 0, 63, 18, 2, NULL, NULL, 'uploads/contents/209019031913205001753nr.mp4', 0, '2019-03-18 18:11:22', '2019-03-19 13:20:50');
INSERT INTO `tbl_huijiao_contents` VALUES (210, 'qd0202021601001', '认识人民币和人民币的换算', '', 1, 0, 1, 0, 55, 18, 2, NULL, NULL, 'uploads/contents/0019031909254004872nr.mp4', 0, '2019-03-19 09:25:40', '2019-03-19 09:25:40');
INSERT INTO `tbl_huijiao_contents` VALUES (211, 'qd0202021701001', '人民币之间的加减法', '', 1, 0, 1, 0, 56, 18, 2, NULL, NULL, 'uploads/contents/211019031909325304158nr.mp4', 0, '2019-03-19 09:28:47', '2019-03-19 09:32:53');
INSERT INTO `tbl_huijiao_contents` VALUES (212, 'qd0202021801001', '两位数加两位数（不进位）', '', 1, 0, 1, 0, 57, 18, 0, NULL, NULL, 'uploads/contents/0019031910570108139nr.mp4', 0, '2019-03-19 10:57:01', '2019-03-19 17:05:45');
INSERT INTO `tbl_huijiao_contents` VALUES (214, 'qd0202021901001', '两位数减两位数（不退位）', '', 1, 0, 1, 0, 58, 18, 0, NULL, NULL, 'uploads/contents/0019031911033408859nr.mp4', 0, '2019-03-19 11:03:34', '2019-03-19 17:03:52');
INSERT INTO `tbl_huijiao_contents` VALUES (215, 'qd0202022001001', '两位数加两位数（进位）', '', 1, 0, 1, 0, 59, 18, 2, NULL, NULL, 'uploads/contents/0019031911072703148nr.mp4', 0, '2019-03-19 11:07:27', '2019-03-19 11:07:27');
INSERT INTO `tbl_huijiao_contents` VALUES (216, 'bb0201030102001', '两', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/216019032117102001594nr', 0, '2019-03-19 13:18:02', '2019-03-21 17:10:20');
INSERT INTO `tbl_huijiao_contents` VALUES (217, 'bb0201030102002', '哪', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913183808506nr', 0, '2019-03-19 13:18:38', '2019-03-19 13:18:38');
INSERT INTO `tbl_huijiao_contents` VALUES (218, 'bb0201030102003', '宽', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913190201227nr', 0, '2019-03-19 13:19:02', '2019-03-19 13:19:02');
INSERT INTO `tbl_huijiao_contents` VALUES (219, 'bb0201030102004', '顶', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913193806497nr', 0, '2019-03-19 13:19:39', '2019-03-19 13:19:39');
INSERT INTO `tbl_huijiao_contents` VALUES (220, 'bb0201030102005', '眼', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913200204736nr', 0, '2019-03-19 13:20:02', '2019-03-19 13:20:02');
INSERT INTO `tbl_huijiao_contents` VALUES (221, 'bb0201030102006', '睛', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913203506865nr', 0, '2019-03-19 13:20:35', '2019-03-19 13:20:35');
INSERT INTO `tbl_huijiao_contents` VALUES (222, 'bb0201030102007', '肚', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913210407523nr', 0, '2019-03-19 13:21:04', '2019-03-19 13:21:04');
INSERT INTO `tbl_huijiao_contents` VALUES (223, 'bb0201030102008', '皮', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913214301948nr', 0, '2019-03-19 13:21:43', '2019-03-19 13:21:43');
INSERT INTO `tbl_huijiao_contents` VALUES (224, 'bb0201030102009', '孩', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913221005382nr', 0, '2019-03-19 13:22:10', '2019-03-19 13:22:10');
INSERT INTO `tbl_huijiao_contents` VALUES (225, 'bb0201030102010', '跳', '', 1, 1, 1, 0, 46, 12, 1, NULL, NULL, 'uploads/contents/0019031913222909408nr', 0, '2019-03-19 13:22:29', '2019-03-19 13:22:29');
INSERT INTO `tbl_huijiao_contents` VALUES (226, 'bb0201030103001', '重难点词语', '', 1, 1, 1, 0, 46, 22, 1, NULL, NULL, 'uploads/contents/0019031913232409972nr', 0, '2019-03-19 13:23:24', '2019-03-19 13:23:24');
INSERT INTO `tbl_huijiao_contents` VALUES (227, 'bb0201030103002', '近反义词', '', 1, 1, 1, 0, 46, 22, 1, NULL, NULL, 'uploads/contents/0019031913234602301nr', 0, '2019-03-19 13:23:46', '2019-03-19 13:23:46');
INSERT INTO `tbl_huijiao_contents` VALUES (228, 'bb0201030103003', '词语搭配', '', 1, 1, 1, 0, 46, 22, 1, NULL, NULL, 'uploads/contents/0019031913240602014nr', 0, '2019-03-19 13:24:06', '2019-03-19 13:24:06');
INSERT INTO `tbl_huijiao_contents` VALUES (229, 'bb0201030104001', '丑小鸭', '', 1, 1, 1, 0, 46, 13, 1, NULL, NULL, 'uploads/contents/0019031913244406495nr', 0, '2019-03-19 13:24:44', '2019-03-19 13:24:44');
INSERT INTO `tbl_huijiao_contents` VALUES (230, 'bb0201030104002', '小动物过冬', '', 1, 1, 1, 0, 46, 13, 1, NULL, NULL, 'uploads/contents/0019031913255908307nr', 0, '2019-03-19 13:25:59', '2019-03-19 13:25:59');
INSERT INTO `tbl_huijiao_contents` VALUES (232, 'bb0201030106001', '小蝌蚪找妈妈', '', 1, 1, 0, 0, 46, 15, 1, NULL, NULL, 'uploads/contents/0019031913304808815nr', 0, '2019-03-19 13:30:48', '2019-03-19 13:30:48');
INSERT INTO `tbl_huijiao_contents` VALUES (233, 'bb0201030309001', '第一单元练习', 'uploads/contents/0019031913323106342fj.docx', 1, 1, 1, 0, 86, 25, 0, NULL, NULL, 'uploads/contents/0019031913323106342nr.docx', 0, '2019-03-19 13:32:31', '2019-03-19 16:20:55');
INSERT INTO `tbl_huijiao_contents` VALUES (234, 'bb0201030110001', '小蝌蚪找妈妈', '', 1, 1, 1, 0, 46, 17, 1, NULL, NULL, 'uploads/contents/0019031913331605225nr', 0, '2019-03-19 13:33:16', '2019-03-19 13:33:16');
INSERT INTO `tbl_huijiao_contents` VALUES (235, 'bb0201030201001', '我是什么', 'uploads/content_packages/235019083016492407479fj.png', 1, 1, 0, 0, 85, 11, 0, 'uploads/content_icons/235019072721460501809fm.png', 'uploads/content_icons/235019072721370307091fm_m.png', 'uploads/contents/0019031914165607813nr.mp4', 0, '2019-03-19 14:16:56', '2019-08-30 16:49:24');
INSERT INTO `tbl_huijiao_contents` VALUES (236, 'bb0201030301001', '植物妈妈有办法', '', 1, 1, 1, 0, 86, 11, 2, NULL, NULL, 'uploads/contents/0019031914180504789nr.mp4', 0, '2019-03-19 14:18:05', '2019-03-19 14:18:05');
INSERT INTO `tbl_huijiao_contents` VALUES (237, 'bsd0302021402001', '探索三角形全等的条件', '', 1, 1, 0, 0, 78, 19, 4, NULL, NULL, 'uploads/contents/237019032111111601046nr.pptx', 0, '2019-03-19 14:19:10', '2019-03-21 11:11:16');
INSERT INTO `tbl_huijiao_contents` VALUES (238, 'bb0201030401001', '场景歌', '', 1, 1, 1, 0, 88, 11, 2, NULL, NULL, 'uploads/contents/0019031914201209586nr.mp4', 0, '2019-03-19 14:20:13', '2019-03-19 14:20:13');
INSERT INTO `tbl_huijiao_contents` VALUES (239, 'bb0201030501001', '树之歌', '', 1, 1, 1, 0, 89, 11, 2, NULL, NULL, 'uploads/contents/0019031914204505237nr.mp4', 0, '2019-03-19 14:20:45', '2019-03-19 14:20:45');
INSERT INTO `tbl_huijiao_contents` VALUES (240, 'bb0201030601001', '拍手歌', '', 1, 1, 1, 0, 92, 11, 2, NULL, NULL, 'uploads/contents/0019031914210804990nr.mp4', 0, '2019-03-19 14:21:08', '2019-03-19 14:21:08');
INSERT INTO `tbl_huijiao_contents` VALUES (241, 'bb0201030701001', '田家四季歌', '', 1, 1, 1, 0, 93, 11, 2, NULL, NULL, 'uploads/contents/0019031914214405698nr.mp4', 0, '2019-03-19 14:21:44', '2019-03-19 14:21:44');
INSERT INTO `tbl_huijiao_contents` VALUES (242, 'bb0201030801001', '曹冲称象', '', 1, 1, 1, 0, 94, 11, 2, NULL, NULL, 'uploads/contents/0019031914214707963nr.mp4', 0, '2019-03-19 14:21:47', '2019-03-19 14:21:47');
INSERT INTO `tbl_huijiao_contents` VALUES (243, 'bsd0302021502001', '用尺规作三角形', '', 1, 1, 0, 0, 79, 19, 4, NULL, NULL, 'uploads/contents/243019032111114802496nr.pptx', 0, '2019-03-19 14:22:09', '2019-03-21 11:11:48');
INSERT INTO `tbl_huijiao_contents` VALUES (244, 'bb0201031001001', '一封信', '', 1, 1, 1, 0, 97, 11, 2, NULL, NULL, 'uploads/contents/0019031914225103117nr.mp4', 0, '2019-03-19 14:22:51', '2019-03-19 14:22:51');
INSERT INTO `tbl_huijiao_contents` VALUES (245, 'bb0201031101001', '妈妈睡了', '', 1, 1, 1, 0, 96, 11, 2, NULL, NULL, 'uploads/contents/0019031914232803492nr.mp4', 0, '2019-03-19 14:23:28', '2019-03-19 14:23:28');
INSERT INTO `tbl_huijiao_contents` VALUES (246, 'bb0201031201001', '登鹳雀楼', '', 1, 1, 1, 0, 98, 11, 2, NULL, NULL, 'uploads/contents/0019031914235603595nr.mp4', 0, '2019-03-19 14:23:56', '2019-03-19 14:23:56');
INSERT INTO `tbl_huijiao_contents` VALUES (247, 'bb0201031201002', '望庐山瀑布', '', 1, 1, 1, 0, 98, 11, 2, NULL, NULL, 'uploads/contents/0019031914242002537nr.mp4', 0, '2019-03-19 14:24:20', '2019-03-19 14:24:20');
INSERT INTO `tbl_huijiao_contents` VALUES (248, 'bb0201031301001', '黄山奇石', '', 1, 1, 1, 0, 99, 11, 2, NULL, NULL, 'uploads/contents/0019031914245305303nr.mp4', 0, '2019-03-19 14:24:53', '2019-03-19 14:24:53');
INSERT INTO `tbl_huijiao_contents` VALUES (249, 'bb0201031401001', '日月潭', '', 1, 1, 1, 0, 100, 11, 2, NULL, NULL, 'uploads/contents/0019031914254904026nr.mp4', 0, '2019-03-19 14:25:49', '2019-03-19 14:25:49');
INSERT INTO `tbl_huijiao_contents` VALUES (250, 'bb0201031501001', '葡萄沟', '', 1, 1, 1, 0, 101, 11, 2, NULL, NULL, 'uploads/contents/0019031914261606751nr.mp4', 0, '2019-03-19 14:26:16', '2019-03-19 14:26:16');
INSERT INTO `tbl_huijiao_contents` VALUES (251, 'bb0201031601001', '坐井观天', '', 1, 1, 1, 0, 102, 11, 2, NULL, NULL, 'uploads/contents/0019031914264301844nr.mp4', 0, '2019-03-19 14:26:43', '2019-03-19 14:26:43');
INSERT INTO `tbl_huijiao_contents` VALUES (252, 'bb0201030901001', '玲玲的画', '', 1, 1, 1, 0, 95, 11, 2, NULL, NULL, 'uploads/contents/0019031914265809506nr.mp4', 0, '2019-03-19 14:26:59', '2019-03-19 14:26:59');
INSERT INTO `tbl_huijiao_contents` VALUES (253, 'bb0201031701001', '寒号鸟', '', 1, 1, 1, 0, 103, 11, 2, NULL, NULL, 'uploads/contents/0019031914272004415nr.mp4', 0, '2019-03-19 14:27:20', '2019-03-19 14:27:20');
INSERT INTO `tbl_huijiao_contents` VALUES (254, 'bb0201031901001', '大禹治水', '', 1, 1, 1, 0, 105, 11, 2, NULL, NULL, 'uploads/contents/0019031914275507763nr.mp4', 0, '2019-03-19 14:27:55', '2019-03-19 14:27:55');
INSERT INTO `tbl_huijiao_contents` VALUES (255, 'bb0201032001001', '朱德的扁担', '', 1, 1, 1, 0, 106, 11, 2, NULL, NULL, 'uploads/contents/0019031914282007013nr.mp4', 0, '2019-03-19 14:28:20', '2019-03-19 14:28:20');
INSERT INTO `tbl_huijiao_contents` VALUES (256, 'bb0201031801001', '我要的是葫芦', '', 1, 1, 1, 0, 104, 11, 2, NULL, NULL, 'uploads/contents/0019031914285802380nr.mp4', 0, '2019-03-19 14:28:58', '2019-03-19 14:28:58');
INSERT INTO `tbl_huijiao_contents` VALUES (257, 'bb0201032101001', '难忘的泼水节', '', 1, 1, 1, 0, 107, 11, 2, NULL, NULL, 'uploads/contents/0019031914290005007nr.mp4', 0, '2019-03-19 14:29:00', '2019-03-19 14:29:00');
INSERT INTO `tbl_huijiao_contents` VALUES (258, 'bb0201032201001', '夜宿山寺', '', 1, 1, 1, 0, 108, 11, 2, NULL, NULL, 'uploads/contents/0019031914294903397nr.mp4', 0, '2019-03-19 14:29:49', '2019-03-19 14:29:49');
INSERT INTO `tbl_huijiao_contents` VALUES (259, 'bb0201032201002', '敕勒歌', '', 1, 1, 1, 0, 108, 11, 2, NULL, NULL, 'uploads/contents/0019031914300902394nr.mp4', 0, '2019-03-19 14:30:09', '2019-03-19 14:30:09');
INSERT INTO `tbl_huijiao_contents` VALUES (260, 'bb0201032401001', '雪孩子', '', 1, 1, 1, 0, 110, 11, 2, NULL, NULL, 'uploads/contents/0019031914305606798nr.mp4', 0, '2019-03-19 14:30:56', '2019-03-19 14:30:56');
INSERT INTO `tbl_huijiao_contents` VALUES (261, 'bb0201032501001', '狐假虎威', '', 1, 1, 1, 0, 112, 11, 2, NULL, NULL, 'uploads/contents/0019031914312608924nr.mp4', 0, '2019-03-19 14:31:26', '2019-03-19 14:31:26');
INSERT INTO `tbl_huijiao_contents` VALUES (262, 'bb0201032601001', '狐狸分奶酪', '', 1, 1, 1, 0, 113, 11, 2, NULL, NULL, 'uploads/contents/0019031914320006263nr.mp4', 0, '2019-03-19 14:32:01', '2019-03-19 14:32:01');
INSERT INTO `tbl_huijiao_contents` VALUES (263, 'bb0201032301001', '雾在哪里', '', 1, 1, 1, 0, 109, 11, 2, NULL, NULL, 'uploads/contents/0019031914320804938nr.mp4', 0, '2019-03-19 14:32:08', '2019-03-19 14:32:08');
INSERT INTO `tbl_huijiao_contents` VALUES (264, 'qd0202022101001', '两位数减两位数（退位）', '', 1, 0, 1, 0, 60, 18, 0, NULL, NULL, 'uploads/contents/0019031914330409388nr.mp4', 0, '2019-03-19 14:33:04', '2019-03-19 17:06:01');
INSERT INTO `tbl_huijiao_contents` VALUES (265, 'bb0201032801001', '风娃娃', '', 1, 1, 1, 0, 116, 11, 2, NULL, NULL, 'uploads/contents/0019031914331507852nr.mp4', 0, '2019-03-19 14:33:15', '2019-03-19 14:33:15');
INSERT INTO `tbl_huijiao_contents` VALUES (266, 'bb0201030105001', '《笠翁对韵（一）》一东第1则', '', 1, 1, 1, 0, 46, 14, 2, NULL, NULL, 'uploads/contents/0019031914350902368nr.mp4', 0, '2019-03-19 14:35:09', '2019-03-19 14:35:09');
INSERT INTO `tbl_huijiao_contents` VALUES (267, 'bb0201032701001', '纸船和风筝', '', 1, 1, 1, 0, 115, 11, 2, NULL, NULL, 'uploads/contents/0019031914353701553nr.mp4', 0, '2019-03-19 14:35:38', '2019-03-19 14:35:38');
INSERT INTO `tbl_huijiao_contents` VALUES (268, 'bb0201030205001', '《笠翁对韵（一）》一东第2则', '', 1, 1, 1, 0, 85, 14, 2, NULL, NULL, 'uploads/contents/0019031914354202113nr.mp4', 0, '2019-03-19 14:35:42', '2019-03-19 14:35:42');
INSERT INTO `tbl_huijiao_contents` VALUES (269, 'bb0201030305001', '《笠翁对韵（一）》一东第3则', '', 1, 1, 1, 0, 86, 14, 0, NULL, NULL, 'uploads/contents/0019031914372209603nr.mp4', 0, '2019-03-19 14:37:22', '2019-03-19 14:51:19');
INSERT INTO `tbl_huijiao_contents` VALUES (270, 'bb0201030405001', '《笠翁对韵（一）》一东第4则', '', 1, 1, 1, 0, 88, 14, 2, NULL, NULL, 'uploads/contents/0019031914372607141nr.mp4', 0, '2019-03-19 14:37:26', '2019-03-19 14:37:26');
INSERT INTO `tbl_huijiao_contents` VALUES (271, 'bb0201030505001', '《笠翁对韵（一）》二冬第1则', '', 1, 1, 1, 0, 89, 14, 0, NULL, NULL, 'uploads/contents/0019031914382509359nr.mp4', 0, '2019-03-19 14:38:25', '2019-03-19 14:40:13');
INSERT INTO `tbl_huijiao_contents` VALUES (272, 'bb0201030605001', '《笠翁对韵（一）》二冬第2则', '', 1, 1, 1, 0, 92, 14, 2, NULL, NULL, 'uploads/contents/0019031914383706083nr.mp4', 0, '2019-03-19 14:38:37', '2019-03-19 14:38:37');
INSERT INTO `tbl_huijiao_contents` VALUES (273, 'bb0201030805001', '《笠翁对韵（一）》二冬第4则', '', 1, 1, 1, 0, 94, 14, 0, NULL, NULL, 'uploads/contents/0019031914392807328nr.mp4', 0, '2019-03-19 14:39:28', '2019-03-19 14:40:07');
INSERT INTO `tbl_huijiao_contents` VALUES (274, 'bb0201030905001', '《笠翁对韵（二）》三江第1则', '', 1, 1, 1, 0, 95, 14, 2, NULL, NULL, 'uploads/contents/0019031914400005247nr.mp4', 0, '2019-03-19 14:40:00', '2019-03-19 14:40:00');
INSERT INTO `tbl_huijiao_contents` VALUES (275, 'bsd0302021602001', '利用三角形全等测距离', '', 1, 1, 0, 0, 80, 19, 4, NULL, NULL, 'uploads/contents/275019032111122609513nr.pptx', 0, '2019-03-19 14:41:04', '2019-03-21 11:12:26');
INSERT INTO `tbl_huijiao_contents` VALUES (276, 'bb0201031005001', '《笠翁对韵（二）》三江第2则', '', 1, 1, 1, 0, 97, 14, 2, NULL, NULL, 'uploads/contents/0019031914411808128nr.mp4', 0, '2019-03-19 14:41:18', '2019-03-19 14:41:18');
INSERT INTO `tbl_huijiao_contents` VALUES (277, 'bb0201030705001', '《笠翁对韵（一）》二冬第3则', '', 1, 1, 1, 0, 93, 14, 0, NULL, NULL, 'uploads/contents/0019031914412203126nr.mp4', 0, '2019-03-19 14:41:22', '2019-03-19 14:51:08');
INSERT INTO `tbl_huijiao_contents` VALUES (278, 'bb0201031105001', '《笠翁对韵（二）》三江第3则', '', 1, 1, 1, 0, 96, 14, 0, NULL, NULL, 'uploads/contents/0019031914422003926nr.mp4', 0, '2019-03-19 14:42:20', '2019-03-20 18:58:14');
INSERT INTO `tbl_huijiao_contents` VALUES (279, 'bb0201031205001', '《笠翁对韵（二）》三江第4则', '', 1, 1, 1, 0, 98, 14, 0, NULL, NULL, 'uploads/contents/0019031914424202044nr.mp4', 0, '2019-03-19 14:42:42', '2019-03-19 14:51:03');
INSERT INTO `tbl_huijiao_contents` VALUES (280, 'bsd0302021702001', '用表格表示的变量间关系', '', 1, 1, 1, 0, 81, 19, 4, NULL, NULL, 'uploads/contents/280019032111131406138nr.pptx', 0, '2019-03-19 14:43:01', '2019-03-21 11:13:14');
INSERT INTO `tbl_huijiao_contents` VALUES (281, 'bb0201031305001', '《笠翁对韵（二）》四支第1则', '', 1, 1, 1, 0, 99, 14, 2, NULL, NULL, 'uploads/contents/0019031914431603604nr.mp4', 0, '2019-03-19 14:43:16', '2019-03-19 14:43:16');
INSERT INTO `tbl_huijiao_contents` VALUES (282, 'bb0201031405001', '《笠翁对韵（二）》四支第2则', '', 1, 1, 1, 0, 100, 14, 0, NULL, NULL, 'uploads/contents/0019031914434806837nr.mp4', 0, '2019-03-19 14:43:48', '2019-03-19 14:50:58');
INSERT INTO `tbl_huijiao_contents` VALUES (283, 'bb0201031505001', '《笠翁对韵（二）》四支第3则', '', 1, 1, 1, 0, 101, 14, 2, NULL, NULL, 'uploads/contents/0019031914441306688nr.mp4', 0, '2019-03-19 14:44:13', '2019-03-19 14:44:13');
INSERT INTO `tbl_huijiao_contents` VALUES (284, 'bsd0302021802001', '用关系式表示的变量间关系', '', 1, 1, 1, 0, 82, 19, 4, NULL, NULL, 'uploads/contents/284019032111155003721nr.pptx', 0, '2019-03-19 14:44:33', '2019-03-21 11:15:50');
INSERT INTO `tbl_huijiao_contents` VALUES (285, 'bb0201031605001', '《笠翁对韵（二）》四支第4则', '', 1, 1, 1, 0, 102, 14, 0, NULL, NULL, 'uploads/contents/0019031914444809968nr.mp4', 0, '2019-03-19 14:44:48', '2019-03-19 14:50:52');
INSERT INTO `tbl_huijiao_contents` VALUES (286, 'bb0201031705001', '《笠翁对韵（三）》五微第1则', '', 1, 1, 1, 0, 103, 14, 2, NULL, NULL, 'uploads/contents/0019031914451506858nr.mp4', 0, '2019-03-19 14:45:15', '2019-03-19 14:45:15');
INSERT INTO `tbl_huijiao_contents` VALUES (287, 'bb0201031805001', '《笠翁对韵（三）》五微第2则', '', 1, 1, 1, 0, 104, 14, 2, NULL, NULL, 'uploads/contents/0019031914454703873nr.mp4', 0, '2019-03-19 14:45:47', '2019-03-19 14:45:47');
INSERT INTO `tbl_huijiao_contents` VALUES (288, 'bb0201031905001', '《笠翁对韵（三）》五微第3则', '', 1, 1, 1, 0, 105, 14, 2, NULL, NULL, 'uploads/contents/0019031914461209264nr.mp4', 0, '2019-03-19 14:46:12', '2019-03-19 14:46:12');
INSERT INTO `tbl_huijiao_contents` VALUES (289, 'bsd0302021902001', '用图象表示的变量间关系', '', 1, 1, 0, 0, 83, 19, 4, NULL, NULL, 'uploads/contents/289019032111182203539nr.pptx', 0, '2019-03-19 14:46:30', '2019-03-21 11:18:22');
INSERT INTO `tbl_huijiao_contents` VALUES (290, 'bb0201032005001', '《笠翁对韵（三）》五微第4则', '', 1, 1, 1, 0, 106, 14, 2, NULL, NULL, 'uploads/contents/0019031914465502195nr.mp4', 0, '2019-03-19 14:46:55', '2019-03-19 14:46:55');
INSERT INTO `tbl_huijiao_contents` VALUES (291, 'bb0201032105001', '《笠翁对韵（三）》六鱼第1则', '', 1, 1, 1, 0, 107, 14, 2, NULL, NULL, 'uploads/contents/0019031914471807107nr.mp4', 0, '2019-03-19 14:47:19', '2019-03-19 14:47:19');
INSERT INTO `tbl_huijiao_contents` VALUES (292, 'bb0201032205001', '《笠翁对韵（三）》六鱼第2则', '', 1, 1, 1, 0, 108, 14, 0, NULL, NULL, 'uploads/contents/0019031914480007383nr.mp4', 0, '2019-03-19 14:48:00', '2019-03-19 14:50:42');
INSERT INTO `tbl_huijiao_contents` VALUES (293, 'bsd0302022002001', '轴对称现象', '', 1, 1, 0, 0, 84, 19, 4, NULL, NULL, 'uploads/contents/0019031914480202898nr.pptx', 0, '2019-03-19 14:48:02', '2019-03-19 14:48:02');
INSERT INTO `tbl_huijiao_contents` VALUES (294, 'bb0201032305001', '《笠翁对韵（三）》六鱼第3则', '', 1, 1, 1, 0, 109, 14, 2, NULL, NULL, 'uploads/contents/0019031914481402191nr.mp4', 0, '2019-03-19 14:48:14', '2019-03-19 14:48:14');
INSERT INTO `tbl_huijiao_contents` VALUES (295, 'bb0201032405001', '《笠翁对韵（三）》六鱼第4则', '', 1, 1, 1, 0, 110, 14, 2, NULL, NULL, 'uploads/contents/0019031914485803369nr.mp4', 0, '2019-03-19 14:48:58', '2019-03-19 14:48:58');
INSERT INTO `tbl_huijiao_contents` VALUES (296, 'bsd0302022102001', '探索轴对称的性质', '', 1, 1, 0, 0, 87, 19, 4, NULL, NULL, 'uploads/contents/0019031914490907396nr.pptx', 0, '2019-03-19 14:49:09', '2019-03-19 14:49:09');
INSERT INTO `tbl_huijiao_contents` VALUES (297, 'bb0201032505001', '《笠翁对韵（四）》七虞第1则', '', 1, 1, 1, 0, 112, 14, 2, NULL, NULL, 'uploads/contents/0019031914491203738nr.mp4', 0, '2019-03-19 14:49:12', '2019-03-19 14:49:12');
INSERT INTO `tbl_huijiao_contents` VALUES (298, 'qd0202022201001', '100以内连加、连减、加减混合运算', '', 1, 0, 1, 0, 61, 18, 0, NULL, NULL, 'uploads/contents/0019031914495104040nr.mp4', 0, '2019-03-19 14:49:51', '2019-03-19 15:49:47');
INSERT INTO `tbl_huijiao_contents` VALUES (299, 'bb0201032605001', '《笠翁对韵（四）》七虞第2则', '', 1, 1, 1, 0, 113, 14, 2, NULL, NULL, 'uploads/contents/0019031914495907770nr.mp4', 0, '2019-03-19 14:49:59', '2019-03-19 14:49:59');
INSERT INTO `tbl_huijiao_contents` VALUES (300, 'bb0201032705001', '《笠翁对韵（四）》七虞第3则', '', 1, 1, 1, 0, 115, 14, 2, NULL, NULL, 'uploads/contents/0019031914501903873nr.mp4', 0, '2019-03-19 14:50:19', '2019-03-19 14:50:19');
INSERT INTO `tbl_huijiao_contents` VALUES (301, 'bb0201032805001', '《笠翁对韵（四）》七虞第4则', '', 1, 1, 1, 0, 116, 14, 2, NULL, NULL, 'uploads/contents/0019031914510102299nr.mp4', 0, '2019-03-19 14:51:01', '2019-03-19 14:51:01');
INSERT INTO `tbl_huijiao_contents` VALUES (302, 'bsd0302022202001', '简单的轴对称图形', '', 1, 1, 0, 0, 90, 19, 4, NULL, NULL, 'uploads/contents/0019031914532102124nr.pptx', 0, '2019-03-19 14:53:21', '2019-03-19 14:53:21');
INSERT INTO `tbl_huijiao_contents` VALUES (303, 'bb0201030206001', '我是什么', '', 1, 1, 0, 0, 85, 15, 1, NULL, NULL, 'uploads/contents/0019031914561401136nr', 0, '2019-03-19 14:56:14', '2019-03-19 14:56:14');
INSERT INTO `tbl_huijiao_contents` VALUES (304, 'bb0201030306001', '植物妈妈有办法', '', 1, 1, 0, 0, 86, 15, 0, NULL, NULL, 'uploads/contents/0019031915004405318nr', 0, '2019-03-19 15:00:44', '2019-03-19 15:00:48');
INSERT INTO `tbl_huijiao_contents` VALUES (305, 'bb0201030406001', '场景歌', '', 1, 1, 0, 0, 88, 15, 1, NULL, NULL, 'uploads/contents/0019031915011109110nr', 0, '2019-03-19 15:01:11', '2019-03-19 15:01:11');
INSERT INTO `tbl_huijiao_contents` VALUES (306, 'bb0201030506001', '树之歌', '', 1, 1, 0, 0, 89, 15, 1, NULL, NULL, 'uploads/contents/0019031915013907282nr', 0, '2019-03-19 15:01:39', '2019-03-19 15:01:39');
INSERT INTO `tbl_huijiao_contents` VALUES (307, 'bb0201030606001', '拍手歌', '', 1, 1, 0, 0, 92, 15, 1, NULL, NULL, 'uploads/contents/0019031915025609873nr', 0, '2019-03-19 15:02:56', '2019-03-19 15:02:56');
INSERT INTO `tbl_huijiao_contents` VALUES (308, 'bb0201030706001', '田家四季歌', '', 1, 1, 0, 0, 93, 15, 1, NULL, NULL, 'uploads/contents/0019031915032001206nr', 0, '2019-03-19 15:03:20', '2019-03-19 15:03:20');
INSERT INTO `tbl_huijiao_contents` VALUES (309, 'bb0201030806001', '曹冲称象', '', 1, 1, 0, 0, 94, 15, 1, NULL, NULL, 'uploads/contents/0019031915034607028nr', 0, '2019-03-19 15:03:46', '2019-03-19 15:03:46');
INSERT INTO `tbl_huijiao_contents` VALUES (310, 'bb0201030906001', '玲玲的画', '', 1, 1, 0, 0, 95, 15, 1, NULL, NULL, 'uploads/contents/0019031915041402731nr', 0, '2019-03-19 15:04:14', '2019-03-19 15:04:14');
INSERT INTO `tbl_huijiao_contents` VALUES (311, 'bb0201031006001', '一封信', '', 1, 1, 0, 0, 97, 15, 1, NULL, NULL, 'uploads/contents/0019031915043903904nr', 0, '2019-03-19 15:04:39', '2019-03-19 15:04:39');
INSERT INTO `tbl_huijiao_contents` VALUES (312, 'bb0201031106001', '妈妈睡了', '', 1, 1, 0, 0, 96, 15, 1, NULL, NULL, 'uploads/contents/0019031915050602521nr', 0, '2019-03-19 15:05:06', '2019-03-19 15:05:06');
INSERT INTO `tbl_huijiao_contents` VALUES (313, 'bb0201031206001', '古诗二首', '', 1, 1, 0, 0, 98, 15, 1, NULL, NULL, 'uploads/contents/0019031915053607624nr', 0, '2019-03-19 15:05:36', '2019-03-19 15:05:36');
INSERT INTO `tbl_huijiao_contents` VALUES (314, 'bb0201031306001', '黄山奇石', '', 1, 1, 0, 0, 99, 15, 1, NULL, NULL, 'uploads/contents/0019031915060109048nr', 0, '2019-03-19 15:06:01', '2019-03-19 15:06:01');
INSERT INTO `tbl_huijiao_contents` VALUES (315, 'bb0201031406001', '日月潭', '', 1, 1, 0, 0, 100, 15, 1, NULL, NULL, 'uploads/contents/0019031915062205079nr', 0, '2019-03-19 15:06:22', '2019-03-19 15:06:22');
INSERT INTO `tbl_huijiao_contents` VALUES (316, 'bb0201031506001', '葡萄沟', '', 1, 1, 0, 0, 101, 15, 1, NULL, NULL, 'uploads/contents/0019031915064605273nr', 0, '2019-03-19 15:06:46', '2019-03-19 15:06:46');
INSERT INTO `tbl_huijiao_contents` VALUES (317, 'bb0201031606001', '坐井观天', '', 1, 1, 0, 0, 102, 15, 1, NULL, NULL, 'uploads/contents/0019031915071009494nr', 0, '2019-03-19 15:07:10', '2019-03-19 15:07:10');
INSERT INTO `tbl_huijiao_contents` VALUES (318, 'bb0201031706001', '寒号鸟', '', 1, 1, 0, 0, 103, 15, 1, NULL, NULL, 'uploads/contents/0019031915074001091nr', 0, '2019-03-19 15:07:40', '2019-03-19 15:07:40');
INSERT INTO `tbl_huijiao_contents` VALUES (319, 'bb0201031806001', '我要的是葫芦', '', 1, 1, 0, 0, 104, 15, 1, NULL, NULL, 'uploads/contents/0019031915080404312nr', 0, '2019-03-19 15:08:04', '2019-03-19 15:08:04');
INSERT INTO `tbl_huijiao_contents` VALUES (320, 'bb0201031906001', '大禹治水', '', 1, 1, 0, 0, 105, 15, 0, NULL, NULL, 'uploads/contents/0019031915082507607nr', 0, '2019-03-19 15:08:25', '2019-03-19 15:13:47');
INSERT INTO `tbl_huijiao_contents` VALUES (321, 'bb0201032006001', '朱德的扁担', '', 1, 1, 0, 0, 106, 15, 1, NULL, NULL, 'uploads/contents/0019031915085008419nr', 0, '2019-03-19 15:08:50', '2019-03-19 15:08:50');
INSERT INTO `tbl_huijiao_contents` VALUES (322, 'bb0201032106001', '难忘的泼水节', '', 1, 1, 0, 0, 107, 15, 1, NULL, NULL, 'uploads/contents/0019031915091607901nr', 0, '2019-03-19 15:09:16', '2019-03-19 15:09:16');
INSERT INTO `tbl_huijiao_contents` VALUES (323, 'bb0201032206001', '古诗二首', '', 1, 1, 0, 0, 108, 15, 0, NULL, NULL, 'uploads/contents/0019031915094509030nr', 0, '2019-03-19 15:09:45', '2019-03-19 17:06:54');
INSERT INTO `tbl_huijiao_contents` VALUES (324, 'bb0201032306001', '雾在哪里', '', 1, 1, 0, 0, 109, 15, 1, NULL, NULL, 'uploads/contents/0019031915101501723nr', 0, '2019-03-19 15:10:15', '2019-03-19 15:10:15');
INSERT INTO `tbl_huijiao_contents` VALUES (325, 'bsd0302022302001', '利用轴对称进行设计', '', 1, 1, 0, 0, 91, 19, 4, NULL, NULL, 'uploads/contents/0019031915102009730nr.pptx', 0, '2019-03-19 15:10:20', '2019-03-19 15:10:20');
INSERT INTO `tbl_huijiao_contents` VALUES (326, 'bb0201032406001', '雪孩子', '', 1, 1, 0, 0, 110, 15, 1, NULL, NULL, 'uploads/contents/0019031915114805674nr', 0, '2019-03-19 15:11:48', '2019-03-19 15:11:48');
INSERT INTO `tbl_huijiao_contents` VALUES (327, 'bb0201032506001', '狐假虎威', '', 1, 1, 0, 0, 112, 15, 1, NULL, NULL, 'uploads/contents/0019031915121404376nr', 0, '2019-03-19 15:12:14', '2019-03-19 15:12:14');
INSERT INTO `tbl_huijiao_contents` VALUES (328, 'bb0201032606001', '狐狸分奶酪', '', 1, 1, 0, 0, 113, 15, 1, NULL, NULL, 'uploads/contents/0019031915123605129nr', 0, '2019-03-19 15:12:36', '2019-03-19 15:12:36');
INSERT INTO `tbl_huijiao_contents` VALUES (329, 'bb0201032706001', '纸船和风筝', '', 1, 1, 0, 0, 115, 15, 1, NULL, NULL, 'uploads/contents/0019031915130808029nr', 0, '2019-03-19 15:13:08', '2019-03-19 15:13:08');
INSERT INTO `tbl_huijiao_contents` VALUES (330, 'bb0201032806001', '风娃娃', '', 1, 1, 0, 0, 116, 15, 1, NULL, NULL, 'uploads/contents/0019031915133005005nr', 0, '2019-03-19 15:13:30', '2019-03-19 15:13:30');
INSERT INTO `tbl_huijiao_contents` VALUES (331, 'bsd0302022402001', '感受可能性', '', 1, 1, 0, 0, 111, 19, 4, NULL, NULL, 'uploads/contents/0019031915141901893nr.pptx', 0, '2019-03-19 15:14:19', '2019-03-19 15:14:19');
INSERT INTO `tbl_huijiao_contents` VALUES (332, 'bsd0302022502001', '频率的稳定性', '', 1, 1, 0, 0, 114, 19, 4, NULL, NULL, 'uploads/contents/0019031915152109012nr.pptx', 0, '2019-03-19 15:15:21', '2019-03-19 15:15:21');
INSERT INTO `tbl_huijiao_contents` VALUES (333, 'bsd0302022602001', '等可能事件的概率', '', 1, 1, 0, 0, 117, 19, 4, NULL, NULL, 'uploads/contents/0019031915163907109nr.pptx', 0, '2019-03-19 15:16:39', '2019-03-19 15:16:39');
INSERT INTO `tbl_huijiao_contents` VALUES (334, 'bb0201030207001', '我是什么', '', 1, 1, 0, 0, 85, 16, 5, NULL, NULL, 'uploads/contents/0019031915182604849nr.pdf', 0, '2019-03-19 15:18:26', '2019-03-19 15:18:26');
INSERT INTO `tbl_huijiao_contents` VALUES (335, 'bb0201030307001', '植物妈妈有办法', '', 1, 1, 0, 0, 86, 16, 5, NULL, NULL, 'uploads/contents/0019031915185007580nr.pdf', 0, '2019-03-19 15:18:50', '2019-03-19 15:18:50');
INSERT INTO `tbl_huijiao_contents` VALUES (336, 'bb0201030407001', '场景歌', '', 1, 1, 0, 0, 88, 16, 0, NULL, NULL, 'uploads/contents/0019031915190909464nr.pdf', 0, '2019-03-19 15:19:09', '2019-03-19 15:32:06');
INSERT INTO `tbl_huijiao_contents` VALUES (337, 'bsd0302021403001', '探索三角形全等的条件', '', 1, 1, 0, 0, 78, 16, 4, NULL, NULL, 'uploads/contents/337019032111395208994nr.doc', 0, '2019-03-19 15:19:20', '2019-03-21 11:39:52');
INSERT INTO `tbl_huijiao_contents` VALUES (338, 'bb0201030507001', '树之歌', '', 1, 1, 0, 0, 89, 16, 5, NULL, NULL, 'uploads/contents/0019031915192608699nr.pdf', 0, '2019-03-19 15:19:26', '2019-03-19 15:19:26');
INSERT INTO `tbl_huijiao_contents` VALUES (339, 'bb0201030607001', '拍手歌', '', 1, 1, 0, 0, 92, 16, 5, NULL, NULL, 'uploads/contents/0019031915194201871nr.pdf', 0, '2019-03-19 15:19:42', '2019-03-19 15:19:42');
INSERT INTO `tbl_huijiao_contents` VALUES (340, 'bb0201030707001', '田家四季歌', '', 1, 1, 0, 0, 93, 16, 5, NULL, NULL, 'uploads/contents/0019031915200506758nr.pdf', 0, '2019-03-19 15:20:05', '2019-03-19 15:20:05');
INSERT INTO `tbl_huijiao_contents` VALUES (341, 'bb0201030807001', '曹冲称象', '', 1, 1, 0, 0, 94, 16, 5, NULL, NULL, 'uploads/contents/0019031915202306316nr.pdf', 0, '2019-03-19 15:20:23', '2019-03-19 15:20:23');
INSERT INTO `tbl_huijiao_contents` VALUES (342, 'bsd0302021503001', '用尺规作三角形', '', 1, 1, 0, 0, 79, 16, 4, NULL, NULL, 'uploads/contents/342019032111401407818nr.doc', 0, '2019-03-19 15:20:38', '2019-03-21 11:40:14');
INSERT INTO `tbl_huijiao_contents` VALUES (343, 'bb0201030907001', '玲玲的画', '', 1, 1, 0, 0, 95, 16, 0, NULL, NULL, 'uploads/contents/0019031915203905160nr.pdf', 0, '2019-03-19 15:20:39', '2019-03-19 15:31:56');
INSERT INTO `tbl_huijiao_contents` VALUES (344, 'bb0201031007001', '一封信', '', 1, 1, 0, 0, 97, 16, 0, NULL, NULL, 'uploads/contents/0019031915205903481nr.pdf', 0, '2019-03-19 15:20:59', '2019-03-19 15:31:51');
INSERT INTO `tbl_huijiao_contents` VALUES (345, 'bb0201031107001', '妈妈睡了', '', 1, 1, 0, 0, 96, 16, 5, NULL, NULL, 'uploads/contents/0019031915211804953nr.pdf', 0, '2019-03-19 15:21:18', '2019-03-19 15:21:18');
INSERT INTO `tbl_huijiao_contents` VALUES (346, 'bb0201031207001', '古诗二首', '', 1, 1, 0, 0, 98, 16, 5, NULL, NULL, 'uploads/contents/0019031915213709505nr.pdf', 0, '2019-03-19 15:21:37', '2019-03-19 15:21:37');
INSERT INTO `tbl_huijiao_contents` VALUES (347, 'bb0201031307001', '黄山奇石', '', 1, 1, 0, 0, 99, 16, 5, NULL, NULL, 'uploads/contents/0019031915222601469nr.pdf', 0, '2019-03-19 15:22:26', '2019-03-19 15:22:26');
INSERT INTO `tbl_huijiao_contents` VALUES (348, 'bb0201031407001', '日月潭', '', 1, 1, 0, 0, 100, 16, 0, NULL, NULL, 'uploads/contents/0019031915225607646nr.pdf', 0, '2019-03-19 15:22:56', '2019-03-19 15:31:44');
INSERT INTO `tbl_huijiao_contents` VALUES (349, 'bb0201031507001', '葡萄沟', '', 1, 1, 0, 0, 101, 16, 5, NULL, NULL, 'uploads/contents/0019031915232509858nr.pdf', 0, '2019-03-19 15:23:25', '2019-03-19 15:23:25');
INSERT INTO `tbl_huijiao_contents` VALUES (350, 'bb0201031607001', '坐井观天', '', 1, 1, 0, 0, 102, 16, 5, NULL, NULL, 'uploads/contents/0019031915234204625nr.pdf', 0, '2019-03-19 15:23:42', '2019-03-19 15:23:42');
INSERT INTO `tbl_huijiao_contents` VALUES (351, 'bb0201031707001', '寒号鸟', '', 1, 1, 0, 0, 103, 16, 5, NULL, NULL, 'uploads/contents/0019031915240305138nr.pdf', 0, '2019-03-19 15:24:03', '2019-03-19 15:24:03');
INSERT INTO `tbl_huijiao_contents` VALUES (352, 'bb0201031807001', '我要的是葫芦', '', 1, 1, 0, 0, 104, 16, 0, NULL, NULL, 'uploads/contents/0019031915242107866nr.pdf', 0, '2019-03-19 15:24:21', '2019-03-19 15:30:55');
INSERT INTO `tbl_huijiao_contents` VALUES (353, 'bb0201031907001', '大禹治水', '', 1, 1, 0, 0, 105, 16, 5, NULL, NULL, 'uploads/contents/0019031915244806570nr.pdf', 0, '2019-03-19 15:24:48', '2019-03-19 15:24:48');
INSERT INTO `tbl_huijiao_contents` VALUES (354, 'bb0201032007001', '朱德的扁担', '', 1, 1, 0, 0, 106, 16, 5, NULL, NULL, 'uploads/contents/0019031915251004799nr.pdf', 0, '2019-03-19 15:25:10', '2019-03-19 15:25:10');
INSERT INTO `tbl_huijiao_contents` VALUES (355, 'bb0201032107001', '难忘的泼水节', '', 1, 1, 0, 0, 107, 16, 5, NULL, NULL, 'uploads/contents/0019031915260305513nr.pdf', 0, '2019-03-19 15:26:03', '2019-03-19 15:26:03');
INSERT INTO `tbl_huijiao_contents` VALUES (356, 'bb0201032207001', '古诗二首', '', 1, 1, 0, 0, 108, 16, 5, NULL, NULL, 'uploads/contents/0019031915262602887nr.pdf', 0, '2019-03-19 15:26:26', '2019-03-19 15:26:26');
INSERT INTO `tbl_huijiao_contents` VALUES (357, 'bb0201032307001', '雾在哪里', '', 1, 1, 0, 0, 109, 16, 5, NULL, NULL, 'uploads/contents/0019031915264508110nr.pdf', 0, '2019-03-19 15:26:45', '2019-03-19 15:26:45');
INSERT INTO `tbl_huijiao_contents` VALUES (358, 'bb0201032407001', '雪孩子', '', 1, 1, 0, 0, 110, 16, 5, NULL, NULL, 'uploads/contents/0019031915271403233nr.pdf', 0, '2019-03-19 15:27:14', '2019-03-19 15:27:14');
INSERT INTO `tbl_huijiao_contents` VALUES (359, 'bsd0302021603001', '利用三角形全等测距离', '', 1, 1, 0, 0, 80, 16, 4, NULL, NULL, 'uploads/contents/359019032111403002592nr.doc', 0, '2019-03-19 15:28:02', '2019-03-21 11:40:30');
INSERT INTO `tbl_huijiao_contents` VALUES (360, 'bb0201032507001', '狐假虎威', '', 1, 1, 0, 0, 112, 16, 5, NULL, NULL, 'uploads/contents/0019031915280501516nr.pdf', 0, '2019-03-19 15:28:05', '2019-03-19 15:28:05');
INSERT INTO `tbl_huijiao_contents` VALUES (361, 'bb0201032607001', '狐狸分奶酪', '', 1, 1, 0, 0, 113, 16, 5, NULL, NULL, 'uploads/contents/0019031915282607688nr.pdf', 0, '2019-03-19 15:28:26', '2019-03-19 15:28:26');
INSERT INTO `tbl_huijiao_contents` VALUES (362, 'bb0201032707001', '纸船和风筝', '', 1, 1, 0, 0, 115, 16, 5, NULL, NULL, 'uploads/contents/0019031915285203589nr.pdf', 0, '2019-03-19 15:28:52', '2019-03-19 15:28:52');
INSERT INTO `tbl_huijiao_contents` VALUES (363, 'bb0201032807001', '风娃娃', '', 1, 1, 0, 0, 116, 16, 5, NULL, NULL, 'uploads/contents/0019031915300502963nr.pdf', 0, '2019-03-19 15:30:05', '2019-03-19 15:30:05');
INSERT INTO `tbl_huijiao_contents` VALUES (364, 'bb0201030204001', '地球的清洁工', '', 1, 1, 1, 0, 85, 13, 1, NULL, NULL, 'uploads/contents/0019031915500304672nr', 0, '2019-03-19 15:50:03', '2019-03-19 15:50:03');
INSERT INTO `tbl_huijiao_contents` VALUES (365, 'bsd0302021703001', '用表格表示的变量间关系', '', 1, 1, 0, 0, 81, 16, 4, NULL, NULL, 'uploads/contents/365019032111404708908nr.doc', 0, '2019-03-19 15:50:06', '2019-03-21 11:40:47');
INSERT INTO `tbl_huijiao_contents` VALUES (366, 'bb0201030204002', '我多大了', '', 1, 1, 1, 0, 85, 13, 1, NULL, NULL, 'uploads/contents/0019031915503304803nr', 0, '2019-03-19 15:50:33', '2019-03-19 15:50:33');
INSERT INTO `tbl_huijiao_contents` VALUES (367, 'bsd0302021803001', '用关系式表示的变量间关系', '', 1, 1, 0, 0, 82, 16, 4, NULL, NULL, 'uploads/contents/367019032111410202755nr.doc', 0, '2019-03-19 15:50:54', '2019-03-21 11:41:02');
INSERT INTO `tbl_huijiao_contents` VALUES (368, 'bb0201030304001', '植物的睡眠', '', 1, 1, 1, 0, 86, 13, 1, NULL, NULL, 'uploads/contents/0019031915510701001nr', 0, '2019-03-19 15:51:07', '2019-03-19 15:51:07');
INSERT INTO `tbl_huijiao_contents` VALUES (369, 'bb0201030304002', '种子的旅行', '', 1, 1, 1, 0, 86, 13, 1, NULL, NULL, 'uploads/contents/0019031915513707400nr', 0, '2019-03-19 15:51:37', '2019-03-19 15:51:37');
INSERT INTO `tbl_huijiao_contents` VALUES (370, 'bsd0302021903001', '用图象表示的变量间关系', '', 1, 1, 0, 0, 83, 16, 4, NULL, NULL, 'uploads/contents/370019032111411503097nr.doc', 0, '2019-03-19 15:51:41', '2019-03-21 11:41:15');
INSERT INTO `tbl_huijiao_contents` VALUES (371, 'bb0201030404001', '颠倒歌', '', 1, 1, 1, 0, 88, 13, 1, NULL, NULL, 'uploads/contents/0019031915520109882nr', 0, '2019-03-19 15:52:01', '2019-03-19 15:52:01');
INSERT INTO `tbl_huijiao_contents` VALUES (372, 'bsd0302022003001', '轴对称现象', '', 1, 1, 0, 0, 84, 16, 4, NULL, NULL, 'uploads/contents/0019031915522608160nr.doc', 0, '2019-03-19 15:52:26', '2019-03-19 15:52:26');
INSERT INTO `tbl_huijiao_contents` VALUES (373, 'bb0201030404002', '量词歌', '', 1, 1, 1, 0, 88, 13, 1, NULL, NULL, 'uploads/contents/0019031915522702345nr', 0, '2019-03-19 15:52:27', '2019-03-19 15:52:27');
INSERT INTO `tbl_huijiao_contents` VALUES (374, 'bb0201030504001', '核桃树赞', '', 1, 1, 1, 0, 89, 13, 1, NULL, NULL, 'uploads/contents/0019031915525802358nr', 0, '2019-03-19 15:52:58', '2019-03-19 15:52:58');
INSERT INTO `tbl_huijiao_contents` VALUES (376, 'bsd0302022103001', '探索轴对称的性质', '', 1, 1, 0, 0, 87, 16, 4, NULL, NULL, 'uploads/contents/0019031915534701217nr.doc', 0, '2019-03-19 15:53:47', '2019-03-19 15:53:47');
INSERT INTO `tbl_huijiao_contents` VALUES (378, 'bb0201030604002', '拍手歌', '', 1, 1, 1, 0, 92, 13, 1, NULL, NULL, 'uploads/contents/0019031915541507373nr', 0, '2019-03-19 15:54:15', '2019-03-19 15:54:15');
INSERT INTO `tbl_huijiao_contents` VALUES (379, 'bsd0302022203001', '简单的轴对称图形', '', 1, 1, 0, 0, 90, 16, 4, NULL, NULL, 'uploads/contents/0019031915544105608nr.doc', 0, '2019-03-19 15:54:41', '2019-03-19 15:54:41');
INSERT INTO `tbl_huijiao_contents` VALUES (380, 'bb0201030704001', '十二月菜', '', 1, 1, 1, 0, 93, 13, 1, NULL, NULL, 'uploads/contents/0019031915544106788nr', 0, '2019-03-19 15:54:41', '2019-03-19 15:54:41');
INSERT INTO `tbl_huijiao_contents` VALUES (382, 'bsd0302022303001', '利用轴对称进行设计', '', 1, 1, 0, 0, 91, 16, 4, NULL, NULL, 'uploads/contents/0019031915553201258nr.doc', 0, '2019-03-19 15:55:32', '2019-03-19 15:55:32');
INSERT INTO `tbl_huijiao_contents` VALUES (383, 'bb0201030804001', '捞铁牛', '', 1, 1, 1, 0, 94, 13, 1, NULL, NULL, 'uploads/contents/0019031915553703158nr', 0, '2019-03-19 15:55:37', '2019-03-19 15:55:37');
INSERT INTO `tbl_huijiao_contents` VALUES (384, 'bb0201030804002', '徐童保树', '', 1, 1, 1, 0, 94, 13, 1, NULL, NULL, 'uploads/contents/0019031915560101106nr', 0, '2019-03-19 15:56:01', '2019-03-19 15:56:01');
INSERT INTO `tbl_huijiao_contents` VALUES (385, 'bsd0302022403001', '感受可能性', '', 1, 1, 0, 0, 111, 16, 4, NULL, NULL, 'uploads/contents/0019031915561203162nr.doc', 0, '2019-03-19 15:56:12', '2019-03-19 15:56:12');
INSERT INTO `tbl_huijiao_contents` VALUES (386, 'bb0201030904001', '窗前的红气球', '', 1, 1, 1, 0, 95, 13, 1, NULL, NULL, 'uploads/contents/0019031915561904163nr', 0, '2019-03-19 15:56:19', '2019-03-19 15:56:19');
INSERT INTO `tbl_huijiao_contents` VALUES (387, 'bsd0302022503001', '频率的稳定性', '', 1, 1, 0, 0, 114, 16, 4, NULL, NULL, 'uploads/contents/0019031915565401638nr.doc', 0, '2019-03-19 15:56:54', '2019-03-19 15:56:54');
INSERT INTO `tbl_huijiao_contents` VALUES (388, 'bb0201030904002', '小鹿的玫瑰花', '', 1, 1, 1, 0, 95, 13, 1, NULL, NULL, 'uploads/contents/0019031915573407667nr', 0, '2019-03-19 15:57:34', '2019-03-19 15:57:34');
INSERT INTO `tbl_huijiao_contents` VALUES (389, 'bsd0302022603001', '等可能事件的概率', '', 1, 1, 0, 0, 117, 16, 4, NULL, NULL, 'uploads/contents/0019031915573608895nr.doc', 0, '2019-03-19 15:57:36', '2019-03-19 15:57:36');
INSERT INTO `tbl_huijiao_contents` VALUES (390, 'bb0201031004001', '不想长大的小姑娘', '', 1, 1, 1, 0, 97, 13, 1, NULL, NULL, 'uploads/contents/0019031915575908608nr', 0, '2019-03-19 15:58:00', '2019-03-19 15:58:00');
INSERT INTO `tbl_huijiao_contents` VALUES (391, 'bb0201031004002', '信', '', 1, 1, 1, 0, 97, 13, 1, NULL, NULL, 'uploads/contents/0019031915582402360nr', 0, '2019-03-19 15:58:24', '2019-03-19 15:58:24');
INSERT INTO `tbl_huijiao_contents` VALUES (392, 'bb0201031104001', '别人的妈妈', '', 1, 1, 1, 0, 96, 13, 1, NULL, NULL, 'uploads/contents/0019031915585008668nr', 0, '2019-03-19 15:58:50', '2019-03-19 15:58:50');
INSERT INTO `tbl_huijiao_contents` VALUES (393, 'bb0201031104002', '午睡', '', 1, 1, 1, 0, 96, 13, 1, NULL, NULL, 'uploads/contents/0019031915591301332nr', 0, '2019-03-19 15:59:13', '2019-03-19 15:59:13');
INSERT INTO `tbl_huijiao_contents` VALUES (394, 'bb0201031204001', '鹳雀楼诗二首', '', 1, 1, 1, 0, 98, 13, 1, NULL, NULL, 'uploads/contents/0019031915593701286nr', 0, '2019-03-19 15:59:37', '2019-03-19 15:59:37');
INSERT INTO `tbl_huijiao_contents` VALUES (395, 'bb0201031204002', '瀑布', '', 1, 1, 1, 0, 98, 13, 1, NULL, NULL, 'uploads/contents/0019031915595801932nr', 0, '2019-03-19 15:59:58', '2019-03-19 15:59:58');
INSERT INTO `tbl_huijiao_contents` VALUES (396, 'bb0201031304001', '人间仙境九寨沟', '', 1, 1, 1, 0, 99, 13, 1, NULL, NULL, 'uploads/contents/0019031916001807525nr', 0, '2019-03-19 16:00:18', '2019-03-19 16:00:18');
INSERT INTO `tbl_huijiao_contents` VALUES (397, 'bb0201031304002', '爬天都峰', '', 1, 1, 1, 0, 99, 13, 1, NULL, NULL, 'uploads/contents/0019031916004008705nr', 0, '2019-03-19 16:00:40', '2019-03-19 16:00:40');
INSERT INTO `tbl_huijiao_contents` VALUES (398, 'bsd0302020305001', '同底数幂的除法', 'uploads/contents/0019031916004305091fj.doc', 1, 1, 1, 0, 67, 21, 4, NULL, NULL, 'uploads/contents/398019032214464701659nr.doc', 0, '2019-03-19 16:00:43', '2019-03-22 14:46:47');
INSERT INTO `tbl_huijiao_contents` VALUES (399, 'bb0201031404001', '华北明珠白洋淀', '', 1, 1, 1, 0, 100, 13, 1, NULL, NULL, 'uploads/contents/0019031916010407603nr', 0, '2019-03-19 16:01:04', '2019-03-19 16:01:04');
INSERT INTO `tbl_huijiao_contents` VALUES (400, 'bb0201031404002', '迷人的蝴蝶谷', '', 1, 1, 1, 0, 100, 13, 1, NULL, NULL, 'uploads/contents/0019031916012603848nr', 0, '2019-03-19 16:01:26', '2019-03-19 16:01:26');
INSERT INTO `tbl_huijiao_contents` VALUES (401, 'bsd0302020405001', '整式的乘法', 'uploads/contents/0019031916012602281fj.doc', 1, 1, 1, 0, 68, 21, 4, NULL, NULL, 'uploads/contents/401019032214470803207nr.doc', 0, '2019-03-19 16:01:26', '2019-03-22 14:47:08');
INSERT INTO `tbl_huijiao_contents` VALUES (402, 'bb0201031504001', '石榴', '', 1, 1, 1, 0, 101, 13, 1, NULL, NULL, 'uploads/contents/0019031916015006572nr', 0, '2019-03-19 16:01:50', '2019-03-19 16:01:50');
INSERT INTO `tbl_huijiao_contents` VALUES (403, 'bb0201031504002', '我爱故乡的杨梅', '', 1, 1, 1, 0, 101, 13, 1, NULL, NULL, 'uploads/contents/0019031916021406209nr', 0, '2019-03-19 16:02:14', '2019-03-19 16:02:14');
INSERT INTO `tbl_huijiao_contents` VALUES (404, 'bsd0302020505001', '平方差公式', 'uploads/contents/0019031916021808839fj.doc', 1, 1, 1, 0, 69, 21, 4, NULL, NULL, 'uploads/contents/404019032214472803914nr.doc', 0, '2019-03-19 16:02:18', '2019-03-22 14:47:28');
INSERT INTO `tbl_huijiao_contents` VALUES (405, 'bb0201031604001', '囫囵吞枣', '', 1, 1, 1, 0, 102, 13, 1, NULL, NULL, 'uploads/contents/0019031916023605308nr', 0, '2019-03-19 16:02:36', '2019-03-19 16:02:36');
INSERT INTO `tbl_huijiao_contents` VALUES (406, 'bsd0302020605001', '完全平方公式', 'uploads/contents/0019031916030402971fj.doc', 1, 1, 1, 0, 70, 21, 4, NULL, NULL, 'uploads/contents/406019032214474702769nr.doc', 0, '2019-03-19 16:03:04', '2019-03-22 14:47:47');
INSERT INTO `tbl_huijiao_contents` VALUES (407, 'bb0201031604002', '盲人摸象', '', 1, 1, 1, 0, 102, 13, 1, NULL, NULL, 'uploads/contents/0019031916032403860nr', 0, '2019-03-19 16:03:24', '2019-03-19 16:03:24');
INSERT INTO `tbl_huijiao_contents` VALUES (408, 'rj0304040102001', '力', '', 1, 0, 0, 0, 119, 19, 0, NULL, NULL, 'uploads/contents/0019031916034803170nr.pptx', 0, '2019-03-19 16:03:48', '2019-03-20 11:12:47');
INSERT INTO `tbl_huijiao_contents` VALUES (409, 'bsd0302020705001', '整式的除法', 'uploads/contents/0019031916040307492fj.doc', 1, 1, 1, 0, 71, 21, 4, NULL, NULL, 'uploads/contents/409019032214481302139nr.doc', 0, '2019-03-19 16:04:03', '2019-03-22 14:48:13');
INSERT INTO `tbl_huijiao_contents` VALUES (410, 'bb0201031704001', '杞人忧天', '', 1, 1, 1, 0, 103, 13, 1, NULL, NULL, 'uploads/contents/0019031916041107667nr', 0, '2019-03-19 16:04:11', '2019-03-19 16:04:11');
INSERT INTO `tbl_huijiao_contents` VALUES (412, 'bsd0302020805001', '两条直线的位置关系', 'uploads/contents/0019031916045104926fj.doc', 1, 1, 1, 0, 72, 21, 4, NULL, NULL, 'uploads/contents/412019032214483506414nr.doc', 0, '2019-03-19 16:04:51', '2019-03-22 14:48:35');
INSERT INTO `tbl_huijiao_contents` VALUES (413, 'bb0201031804001', '酸的和甜的', '', 1, 1, 1, 0, 104, 13, 1, NULL, NULL, 'uploads/contents/0019031916045808929nr', 0, '2019-03-19 16:04:58', '2019-03-19 16:04:58');
INSERT INTO `tbl_huijiao_contents` VALUES (414, 'bb0201031804002', '掩耳盗铃', '', 1, 1, 1, 0, 104, 13, 1, NULL, NULL, 'uploads/contents/0019031916052202293nr', 0, '2019-03-19 16:05:23', '2019-03-19 16:05:23');
INSERT INTO `tbl_huijiao_contents` VALUES (415, 'bb0201031904001', '女娲和人', '', 1, 1, 1, 0, 105, 13, 1, NULL, NULL, 'uploads/contents/0019031916054401715nr', 0, '2019-03-19 16:05:44', '2019-03-19 16:05:44');
INSERT INTO `tbl_huijiao_contents` VALUES (416, 'bsd0302020905001', '探索直线平行的条件', 'uploads/contents/0019031916055406131fj.doc', 1, 1, 1, 0, 73, 21, 4, NULL, NULL, 'uploads/contents/416019032214485802380nr.doc', 0, '2019-03-19 16:05:54', '2019-03-22 14:48:58');
INSERT INTO `tbl_huijiao_contents` VALUES (417, 'bb0201031904002', '盘古开天', '', 1, 1, 1, 0, 105, 13, 1, NULL, NULL, 'uploads/contents/0019031916061008977nr', 0, '2019-03-19 16:06:10', '2019-03-19 16:06:10');
INSERT INTO `tbl_huijiao_contents` VALUES (418, 'bb0201032004001', '吃水不忘挖井人', '', 1, 1, 1, 0, 106, 13, 1, NULL, NULL, 'uploads/contents/0019031916063305158nr', 0, '2019-03-19 16:06:33', '2019-03-19 16:06:33');
INSERT INTO `tbl_huijiao_contents` VALUES (419, 'bb0201032004002', '这个规矩不能有', '', 1, 1, 1, 0, 106, 13, 1, NULL, NULL, 'uploads/contents/0019031916070008849nr', 0, '2019-03-19 16:07:00', '2019-03-19 16:07:00');
INSERT INTO `tbl_huijiao_contents` VALUES (420, 'bsd0302021005001', '平行线的性质', 'uploads/contents/0019031916071204677fj.doc', 1, 1, 1, 0, 74, 21, 4, NULL, NULL, 'uploads/contents/420019032214492402872nr.doc', 0, '2019-03-19 16:07:12', '2019-03-22 14:49:24');
INSERT INTO `tbl_huijiao_contents` VALUES (421, 'bb0201032104001', '老北京的春节', '', 1, 1, 1, 0, 107, 13, 1, NULL, NULL, 'uploads/contents/0019031916072604543nr', 0, '2019-03-19 16:07:26', '2019-03-19 16:07:26');
INSERT INTO `tbl_huijiao_contents` VALUES (422, 'bb0201032104002', '立夏节到了', '', 1, 1, 1, 0, 107, 13, 1, NULL, NULL, 'uploads/contents/0019031916075005613nr', 0, '2019-03-19 16:07:50', '2019-03-19 16:07:50');
INSERT INTO `tbl_huijiao_contents` VALUES (423, 'bsd0302021105001', '用尺规作角', 'uploads/contents/0019031916075706024fj.docx', 1, 1, 1, 0, 75, 21, 4, NULL, NULL, 'uploads/contents/423019032214494901051nr.docx', 0, '2019-03-19 16:07:57', '2019-03-22 14:49:49');
INSERT INTO `tbl_huijiao_contents` VALUES (424, 'bb0201032204001', '草原诗三首', '', 1, 1, 1, 0, 108, 13, 1, NULL, NULL, 'uploads/contents/0019031916081603875nr', 0, '2019-03-19 16:08:16', '2019-03-19 16:08:16');
INSERT INTO `tbl_huijiao_contents` VALUES (425, 'bb0201032204002', '古朗月行', '', 1, 1, 1, 0, 108, 13, 1, NULL, NULL, 'uploads/contents/0019031916084105903nr', 0, '2019-03-19 16:08:41', '2019-03-19 16:08:41');
INSERT INTO `tbl_huijiao_contents` VALUES (426, 'bsd0302021205001', '认识三角形', 'uploads/contents/426019032111505109141fj.doc', 1, 1, 1, 0, 76, 21, 4, NULL, NULL, 'uploads/contents/426019032215451608978nr.doc', 0, '2019-03-19 16:08:54', '2019-03-22 15:45:16');
INSERT INTO `tbl_huijiao_contents` VALUES (427, 'bb0201032304001', '初冬', '', 1, 1, 1, 0, 109, 13, 1, NULL, NULL, 'uploads/contents/0019031916090405687nr', 0, '2019-03-19 16:09:04', '2019-03-19 16:09:04');
INSERT INTO `tbl_huijiao_contents` VALUES (428, 'bb0201032304002', '海上气象员', '', 1, 1, 1, 0, 109, 13, 1, NULL, NULL, 'uploads/contents/0019031916092702035nr', 0, '2019-03-19 16:09:27', '2019-03-19 16:09:27');
INSERT INTO `tbl_huijiao_contents` VALUES (429, 'bsd0302021305001', '图形的全等', 'uploads/contents/429019032111511603655fj.doc', 1, 1, 1, 0, 77, 21, 4, NULL, NULL, 'uploads/contents/429019032215453408173nr.doc', 0, '2019-03-19 16:09:40', '2019-03-22 15:45:34');
INSERT INTO `tbl_huijiao_contents` VALUES (430, 'bb0201032404001', '冬去春来的雪孩子', '', 1, 1, 1, 0, 110, 13, 1, NULL, NULL, 'uploads/contents/0019031916095104789nr', 0, '2019-03-19 16:09:51', '2019-03-19 16:09:51');
INSERT INTO `tbl_huijiao_contents` VALUES (431, 'bb0201032404002', '雪人的心', '', 1, 1, 1, 0, 110, 13, 1, NULL, NULL, 'uploads/contents/0019031916101505753nr', 0, '2019-03-19 16:10:15', '2019-03-19 16:10:15');
INSERT INTO `tbl_huijiao_contents` VALUES (432, 'bsd0302021405001', '探索三角形全等的条件', 'uploads/contents/432019032111514609803fj.doc', 1, 1, 1, 0, 78, 21, 4, NULL, NULL, 'uploads/contents/432019032215455102243nr.doc', 0, '2019-03-19 16:10:29', '2019-03-22 15:45:51');
INSERT INTO `tbl_huijiao_contents` VALUES (433, 'bb0201032504001', '从现在开始', '', 1, 1, 1, 0, 112, 13, 1, NULL, NULL, 'uploads/contents/0019031916103701353nr', 0, '2019-03-19 16:10:37', '2019-03-19 16:10:37');
INSERT INTO `tbl_huijiao_contents` VALUES (434, 'bb0201032504002', '狮子和山羊', '', 1, 1, 1, 0, 112, 13, 1, NULL, NULL, 'uploads/contents/0019031916110006420nr', 0, '2019-03-19 16:11:00', '2019-03-19 16:11:00');
INSERT INTO `tbl_huijiao_contents` VALUES (435, 'bb0201032604001', '聪明的猴子', '', 1, 1, 1, 0, 113, 13, 1, NULL, NULL, 'uploads/contents/0019031916112703864nr', 0, '2019-03-19 16:11:27', '2019-03-19 16:11:27');
INSERT INTO `tbl_huijiao_contents` VALUES (436, 'bb0201032604002', '饭钱', '', 1, 1, 1, 0, 113, 13, 1, NULL, NULL, 'uploads/contents/0019031916114907727nr', 0, '2019-03-19 16:11:50', '2019-03-19 16:11:50');
INSERT INTO `tbl_huijiao_contents` VALUES (437, 'bb0201032704001', '爱写诗的小螃蟹', '', 1, 1, 1, 0, 115, 13, 1, NULL, NULL, 'uploads/contents/0019031916120909780nr', 0, '2019-03-19 16:12:09', '2019-03-19 16:12:09');
INSERT INTO `tbl_huijiao_contents` VALUES (438, 'bb0201032704002', '高山流水', '', 1, 1, 1, 0, 115, 13, 1, NULL, NULL, 'uploads/contents/0019031916123009449nr', 0, '2019-03-19 16:12:30', '2019-03-19 16:12:30');
INSERT INTO `tbl_huijiao_contents` VALUES (439, 'bb0201032804001', '风', '', 1, 1, 1, 0, 116, 13, 1, NULL, NULL, 'uploads/contents/0019031916125308075nr', 0, '2019-03-19 16:12:54', '2019-03-19 16:12:54');
INSERT INTO `tbl_huijiao_contents` VALUES (440, 'bb0201032804002', '最后的玉米', '', 1, 1, 1, 0, 116, 13, 1, NULL, NULL, 'uploads/contents/0019031916131509943nr', 0, '2019-03-19 16:13:16', '2019-03-19 16:13:16');
INSERT INTO `tbl_huijiao_contents` VALUES (441, 'bb0201031704002', '小柳树和小枣树', '', 1, 1, 1, 0, 103, 13, 1, NULL, NULL, 'uploads/contents/0019031916145005184nr', 0, '2019-03-19 16:14:50', '2019-03-19 16:14:50');
INSERT INTO `tbl_huijiao_contents` VALUES (442, 'bb0201030604001', '九九歌', '', 1, 1, 1, 0, 92, 13, 1, NULL, NULL, 'uploads/contents/0019031916153407534nr', 0, '2019-03-19 16:15:34', '2019-03-19 16:15:34');
INSERT INTO `tbl_huijiao_contents` VALUES (443, 'bb0201030704002', '四季童谣', '', 1, 1, 1, 0, 93, 13, 1, NULL, NULL, 'uploads/contents/0019031916163309357nr', 0, '2019-03-19 16:16:34', '2019-03-19 16:16:34');
INSERT INTO `tbl_huijiao_contents` VALUES (444, 'bb0201030504002', '树', '', 1, 1, 1, 0, 89, 13, 1, NULL, NULL, 'uploads/contents/0019031916180906896nr', 0, '2019-03-19 16:18:09', '2019-03-19 16:18:09');
INSERT INTO `tbl_huijiao_contents` VALUES (445, 'bb0201030709001', '第二单元练习', 'uploads/contents/0019031916215107370fj.docx', 1, 1, 1, 0, 93, 25, 4, NULL, NULL, 'uploads/contents/0019031916215107370nr.docx', 0, '2019-03-19 16:21:51', '2019-03-19 16:21:51');
INSERT INTO `tbl_huijiao_contents` VALUES (447, 'bb0201031509001', '第四单元练习', 'uploads/contents/0019031916225206168fj.docx', 1, 1, 1, 0, 101, 25, 4, NULL, NULL, 'uploads/contents/0019031916225206168nr.docx', 0, '2019-03-19 16:22:52', '2019-03-19 16:22:52');
INSERT INTO `tbl_huijiao_contents` VALUES (448, 'bsd0302021505001', '用尺规作三角形', 'uploads/contents/448019032111520607724fj.doc', 1, 1, 1, 0, 79, 21, 4, NULL, NULL, 'uploads/contents/448019032215461101585nr.doc', 0, '2019-03-19 16:23:16', '2019-03-22 15:46:11');
INSERT INTO `tbl_huijiao_contents` VALUES (449, 'bb0201031809001', '第五单元练习', 'uploads/contents/0019031916231809303fj.docx', 1, 1, 1, 0, 104, 25, 4, NULL, NULL, 'uploads/contents/0019031916231809303nr.docx', 0, '2019-03-19 16:23:18', '2019-03-19 16:23:18');
INSERT INTO `tbl_huijiao_contents` VALUES (450, 'bb0201032109001', '第六单元练习', 'uploads/contents/0019031916234709601fj.docx', 1, 1, 1, 0, 107, 25, 4, NULL, NULL, 'uploads/contents/0019031916234709601nr.docx', 0, '2019-03-19 16:23:47', '2019-03-19 16:23:47');
INSERT INTO `tbl_huijiao_contents` VALUES (451, 'bb0201032409001', '第七单元练习', 'uploads/contents/0019031916241407970fj.docx', 1, 1, 1, 0, 110, 25, 0, NULL, NULL, 'uploads/contents/0019031916241407970nr.docx', 0, '2019-03-19 16:24:14', '2019-03-19 17:08:36');
INSERT INTO `tbl_huijiao_contents` VALUES (452, 'bb0201032809001', '第八单元练习', 'uploads/contents/0019031916243509635fj.docx', 1, 1, 1, 0, 116, 25, 4, NULL, NULL, 'uploads/contents/0019031916243509635nr.docx', 0, '2019-03-19 16:24:35', '2019-03-19 16:24:35');
INSERT INTO `tbl_huijiao_contents` VALUES (453, 'bb0201031109001', '第三单元练习', 'uploads/contents/0019031916251207307fj.docx', 1, 1, 1, 0, 96, 25, 4, NULL, NULL, 'uploads/contents/0019031916251207307nr.docx', 0, '2019-03-19 16:25:12', '2019-03-19 16:25:12');
INSERT INTO `tbl_huijiao_contents` VALUES (454, 'bsd0302021605001', '利用三角形全等测距离', 'uploads/contents/454019032111523109101fj.doc', 1, 1, 1, 0, 80, 21, 4, NULL, NULL, 'uploads/contents/454019032215463101505nr.doc', 0, '2019-03-19 16:25:28', '2019-03-22 15:46:31');
INSERT INTO `tbl_huijiao_contents` VALUES (455, 'bsd0302021705001', '用表格表示的变量间关系', 'uploads/contents/455019032111525301063fj.docx', 1, 1, 1, 0, 81, 21, 4, NULL, NULL, 'uploads/contents/455019032215465907689nr.docx', 0, '2019-03-19 16:26:20', '2019-03-22 15:46:59');
INSERT INTO `tbl_huijiao_contents` VALUES (456, 'bsd0302021805001', '用关系式表示的变量间关系', 'uploads/contents/456019032111531206370fj.doc', 1, 1, 1, 0, 82, 21, 4, NULL, NULL, 'uploads/contents/456019032215472403154nr.doc', 0, '2019-03-19 16:27:05', '2019-03-22 15:47:24');
INSERT INTO `tbl_huijiao_contents` VALUES (457, 'bsd0302021905001', '用图象表示的变量间关系', 'uploads/contents/457019032111533708056fj.doc', 1, 1, 1, 0, 83, 21, 4, NULL, NULL, 'uploads/contents/457019032215474407752nr.doc', 0, '2019-03-19 16:27:47', '2019-03-22 15:47:44');
INSERT INTO `tbl_huijiao_contents` VALUES (458, 'bsd0302022005001', '轴对称现象', 'uploads/contents/0019031916283405233fj.doc', 1, 1, 1, 0, 84, 21, 4, NULL, NULL, 'uploads/contents/458019032215481301341nr.doc', 0, '2019-03-19 16:28:34', '2019-03-22 15:48:13');
INSERT INTO `tbl_huijiao_contents` VALUES (459, 'bb0201030210001', '我是什么', '', 1, 1, 1, 0, 85, 17, 1, NULL, NULL, 'uploads/contents/0019031916290106197nr', 0, '2019-03-19 16:29:01', '2019-03-19 16:29:01');
INSERT INTO `tbl_huijiao_contents` VALUES (460, 'bsd0302022105001', '探索轴对称的性质', 'uploads/contents/0019031916292203546fj.doc', 1, 1, 1, 0, 87, 21, 4, NULL, NULL, 'uploads/contents/460019032215483401070nr.doc', 0, '2019-03-19 16:29:22', '2019-03-22 15:48:34');
INSERT INTO `tbl_huijiao_contents` VALUES (463, 'bsd0302022205001', '简单的轴对称图形', 'uploads/contents/0019031916302508047fj.doc', 1, 1, 1, 0, 90, 21, 4, NULL, NULL, 'uploads/contents/463019032215485404485nr.doc', 0, '2019-03-19 16:30:25', '2019-03-22 15:48:54');
INSERT INTO `tbl_huijiao_contents` VALUES (464, 'bsd0302022305001', '利用轴对称进行设计', 'uploads/contents/0019031916314101712fj.doc', 1, 1, 1, 0, 91, 21, 4, NULL, NULL, 'uploads/contents/464019032215491706640nr.doc', 0, '2019-03-19 16:31:41', '2019-03-22 15:49:17');
INSERT INTO `tbl_huijiao_contents` VALUES (465, 'bb0201030310001', '植物妈妈有办法', '', 1, 1, 1, 0, 86, 17, 1, NULL, NULL, 'uploads/contents/0019031916314506917nr', 0, '2019-03-19 16:31:45', '2019-03-19 16:31:45');
INSERT INTO `tbl_huijiao_contents` VALUES (466, 'bb0201030410001', '场景歌', '', 1, 1, 1, 0, 88, 17, 1, NULL, NULL, 'uploads/contents/0019031916320905715nr', 0, '2019-03-19 16:32:10', '2019-03-19 16:32:10');
INSERT INTO `tbl_huijiao_contents` VALUES (467, 'bb0201030510001', '树之歌', '', 1, 1, 1, 0, 89, 17, 1, NULL, NULL, 'uploads/contents/0019031916323106421nr', 0, '2019-03-19 16:32:31', '2019-03-19 16:32:31');
INSERT INTO `tbl_huijiao_contents` VALUES (468, 'bsd0302022405001', '感受可能性', 'uploads/contents/0019031916323709261fj.doc', 1, 1, 1, 0, 111, 21, 4, NULL, NULL, 'uploads/contents/468019032215493308925nr.doc', 0, '2019-03-19 16:32:37', '2019-03-22 15:49:33');
INSERT INTO `tbl_huijiao_contents` VALUES (469, 'bb0201030610001', '拍手歌', '', 1, 1, 1, 0, 92, 17, 1, NULL, NULL, 'uploads/contents/0019031916330005532nr', 0, '2019-03-19 16:33:00', '2019-03-19 16:33:00');
INSERT INTO `tbl_huijiao_contents` VALUES (470, 'bb0201030710001', '田家四季歌', '', 1, 1, 1, 0, 93, 17, 1, NULL, NULL, 'uploads/contents/0019031916332304726nr', 0, '2019-03-19 16:33:23', '2019-03-19 16:33:23');
INSERT INTO `tbl_huijiao_contents` VALUES (471, 'bsd0302022505001', '频率的稳定性', 'uploads/contents/0019031916332406848fj.doc', 1, 1, 1, 0, 114, 21, 4, NULL, NULL, 'uploads/contents/471019032215495201587nr.doc', 0, '2019-03-19 16:33:24', '2019-03-22 15:49:52');
INSERT INTO `tbl_huijiao_contents` VALUES (472, 'bb0201030810001', '曹冲称象', '', 1, 1, 1, 0, 94, 17, 1, NULL, NULL, 'uploads/contents/0019031916335001518nr', 0, '2019-03-19 16:33:50', '2019-03-19 16:33:50');
INSERT INTO `tbl_huijiao_contents` VALUES (473, 'bsd0302022605001', '等可能事件的概率', 'uploads/contents/0019031916340502809fj.doc', 1, 1, 1, 0, 117, 21, 4, NULL, NULL, 'uploads/contents/473019032215500904784nr.doc', 0, '2019-03-19 16:34:05', '2019-03-22 15:50:09');
INSERT INTO `tbl_huijiao_contents` VALUES (474, 'bb0201030910001', '玲玲的画', '', 1, 1, 1, 0, 95, 17, 1, NULL, NULL, 'uploads/contents/0019031916340906336nr', 0, '2019-03-19 16:34:09', '2019-03-19 16:34:09');
INSERT INTO `tbl_huijiao_contents` VALUES (475, 'bb0201031010001', '一封信', '', 1, 1, 1, 0, 97, 17, 1, NULL, NULL, 'uploads/contents/0019031916343305200nr', 0, '2019-03-19 16:34:33', '2019-03-19 16:34:33');
INSERT INTO `tbl_huijiao_contents` VALUES (476, 'bb0201031110001', '妈妈睡了', '', 1, 1, 1, 0, 96, 17, 1, NULL, NULL, 'uploads/contents/0019031916345507402nr', 0, '2019-03-19 16:34:55', '2019-03-19 16:34:55');
INSERT INTO `tbl_huijiao_contents` VALUES (477, 'bb0201031210001', '古诗二首', '', 1, 1, 1, 0, 98, 17, 1, NULL, NULL, 'uploads/contents/0019031916352106357nr', 0, '2019-03-19 16:35:21', '2019-03-19 16:35:21');
INSERT INTO `tbl_huijiao_contents` VALUES (478, 'bb0201031310001', '黄山奇石', '', 1, 1, 1, 0, 99, 17, 1, NULL, NULL, 'uploads/contents/0019031916355003948nr', 0, '2019-03-19 16:35:50', '2019-03-19 16:35:50');
INSERT INTO `tbl_huijiao_contents` VALUES (479, 'bb0201031410001', '日月潭', '', 1, 1, 1, 0, 100, 17, 1, NULL, NULL, 'uploads/contents/0019031916361807045nr', 0, '2019-03-19 16:36:18', '2019-03-19 16:36:18');
INSERT INTO `tbl_huijiao_contents` VALUES (480, 'bb0201031510001', '葡萄沟', '', 1, 1, 1, 0, 101, 17, 1, NULL, NULL, 'uploads/contents/0019031916364602550nr', 0, '2019-03-19 16:36:46', '2019-03-19 16:36:46');
INSERT INTO `tbl_huijiao_contents` VALUES (481, 'bb0201031610001', '坐井观天', '', 1, 1, 1, 0, 102, 17, 1, NULL, NULL, 'uploads/contents/0019031916374603703nr', 0, '2019-03-19 16:37:47', '2019-03-19 16:37:47');
INSERT INTO `tbl_huijiao_contents` VALUES (482, 'bb0201031710001', '寒号鸟', '', 1, 1, 1, 0, 103, 17, 0, NULL, NULL, 'uploads/contents/0019031916380906252nr', 0, '2019-03-19 16:38:09', '2019-03-19 16:52:53');
INSERT INTO `tbl_huijiao_contents` VALUES (483, 'bb0201031810001', '我要的是葫芦', '', 1, 1, 1, 0, 104, 17, 1, NULL, NULL, 'uploads/contents/0019031916390209471nr', 0, '2019-03-19 16:39:02', '2019-03-19 16:39:02');
INSERT INTO `tbl_huijiao_contents` VALUES (485, 'bb0201031910001', '大禹治水', '', 1, 1, 1, 0, 105, 17, 1, NULL, NULL, 'uploads/contents/0019031916404509230nr', 0, '2019-03-19 16:40:45', '2019-03-19 16:40:45');
INSERT INTO `tbl_huijiao_contents` VALUES (486, 'bb0201032010001', '朱德的扁担', '', 1, 1, 1, 0, 106, 17, 0, NULL, NULL, 'uploads/contents/0019031916410908529nr', 0, '2019-03-19 16:41:09', '2019-03-19 17:06:25');
INSERT INTO `tbl_huijiao_contents` VALUES (487, 'bb0201032110001', '难忘的泼水节', '', 1, 1, 1, 0, 107, 17, 1, NULL, NULL, 'uploads/contents/0019031916425801085nr', 0, '2019-03-19 16:42:58', '2019-03-19 16:42:58');
INSERT INTO `tbl_huijiao_contents` VALUES (488, 'bb0201032210001', '古诗二首', '', 1, 1, 1, 0, 108, 17, 1, NULL, NULL, 'uploads/contents/0019031916441509661nr', 0, '2019-03-19 16:44:15', '2019-03-19 16:44:15');
INSERT INTO `tbl_huijiao_contents` VALUES (489, 'qd0202021302001', '两位数加一位数进位加', '', 1, 1, 0, 0, 52, 16, 4, NULL, NULL, 'uploads/contents/0019031916555906139nr.doc', 0, '2019-03-19 16:55:59', '2019-03-19 16:55:59');
INSERT INTO `tbl_huijiao_contents` VALUES (490, 'bb0201032310001', '雾在哪里', '', 1, 1, 1, 0, 109, 17, 1, NULL, NULL, 'uploads/contents/0019031916570508224nr', 0, '2019-03-19 16:57:05', '2019-03-19 16:57:05');
INSERT INTO `tbl_huijiao_contents` VALUES (491, 'qd0202021702001', '人民币之间的加减法', '', 1, 1, 0, 0, 56, 16, 4, NULL, NULL, 'uploads/contents/491019031916591803032nr.doc', 0, '2019-03-19 16:57:33', '2019-03-19 16:59:18');
INSERT INTO `tbl_huijiao_contents` VALUES (492, 'bb0201032410001', '雪孩子', '', 1, 1, 1, 0, 110, 17, 0, NULL, NULL, 'uploads/contents/0019031916574108950nr', 0, '2019-03-19 16:57:41', '2019-03-19 17:07:18');
INSERT INTO `tbl_huijiao_contents` VALUES (493, 'bb0201032510001', '狐假虎威', '', 1, 1, 1, 0, 112, 17, 1, NULL, NULL, 'uploads/contents/0019031916580708613nr', 0, '2019-03-19 16:58:07', '2019-03-19 16:58:07');
INSERT INTO `tbl_huijiao_contents` VALUES (494, 'bb0201032610001', '狐狸分奶酪', '', 1, 1, 1, 0, 113, 17, 1, NULL, NULL, 'uploads/contents/0019031916582803713nr', 0, '2019-03-19 16:58:28', '2019-03-19 16:58:28');
INSERT INTO `tbl_huijiao_contents` VALUES (495, 'bb0201032710001', '纸船和风筝', '', 1, 1, 1, 0, 115, 17, 1, NULL, NULL, 'uploads/contents/0019031916585306760nr', 0, '2019-03-19 16:58:53', '2019-03-19 16:58:53');
INSERT INTO `tbl_huijiao_contents` VALUES (496, 'bb0201032810001', '风娃娃', '', 1, 1, 1, 0, 116, 17, 0, NULL, NULL, 'uploads/contents/0019031916591207015nr', 0, '2019-03-19 16:59:12', '2019-03-19 17:07:38');
INSERT INTO `tbl_huijiao_contents` VALUES (499, 'rj0304040202001', '弹力', '', 1, 0, 0, 0, 120, 19, 0, NULL, NULL, 'uploads/contents/0019031917023103093nr.pptx', 0, '2019-03-19 17:02:31', '2019-03-20 11:13:05');
INSERT INTO `tbl_huijiao_contents` VALUES (501, 'rj0304040302001', '重力', '', 1, 0, 0, 0, 121, 19, 0, NULL, NULL, 'uploads/contents/0019031917034407350nr.pptx', 0, '2019-03-19 17:03:44', '2019-03-20 11:13:13');
INSERT INTO `tbl_huijiao_contents` VALUES (505, 'rj0304040502001', '二力平衡', '', 1, 0, 0, 0, 123, 19, 0, NULL, NULL, 'uploads/contents/0019031917054609086nr.pptx', 0, '2019-03-19 17:05:46', '2019-03-20 11:13:29');
INSERT INTO `tbl_huijiao_contents` VALUES (508, 'rj0304040602001', '摩擦力', 'uploads/contents/508019031918225607028fj.docx', 0, 0, 1, 0, 124, 19, 0, NULL, NULL, 'uploads/contents/0019031917070006426nr.ppt', 0, '2019-03-19 17:07:00', '2019-03-19 18:22:56');
INSERT INTO `tbl_huijiao_contents` VALUES (511, 'rj0304040702001', '压强', '', 1, 0, 0, 0, 125, 19, 0, NULL, NULL, 'uploads/contents/0019031917081508233nr.pptx', 0, '2019-03-19 17:08:15', '2019-03-20 11:13:48');
INSERT INTO `tbl_huijiao_contents` VALUES (513, 'rj0304040802001', '液体的压强', '', 1, 0, 0, 0, 126, 19, 0, NULL, NULL, 'uploads/contents/0019031917090202450nr.pptx', 0, '2019-03-19 17:09:02', '2019-03-20 11:13:56');
INSERT INTO `tbl_huijiao_contents` VALUES (515, 'rj0304040902001', '大气压强', '', 1, 0, 0, 0, 127, 19, 0, NULL, NULL, 'uploads/contents/0019031917093704528nr.pptx', 0, '2019-03-19 17:09:37', '2019-03-20 11:14:29');
INSERT INTO `tbl_huijiao_contents` VALUES (516, 'rj0304041002001', '流体压强与流速的关系', '', 1, 0, 0, 0, 128, 19, 0, NULL, NULL, 'uploads/contents/0019031917102107641nr.pptx', 0, '2019-03-19 17:10:21', '2019-03-20 11:14:37');
INSERT INTO `tbl_huijiao_contents` VALUES (517, 'rj0304041102001', ' 浮力', '', 1, 0, 0, 0, 129, 19, 0, NULL, NULL, 'uploads/contents/0019031917110206309nr.pptx', 0, '2019-03-19 17:11:02', '2019-03-20 11:17:55');
INSERT INTO `tbl_huijiao_contents` VALUES (518, 'bb0201030303001', '重难点词语', '', 1, 1, 1, 0, 86, 22, 1, NULL, NULL, 'uploads/contents/518019031920212805788nr', 0, '2019-03-19 17:11:31', '2019-03-19 20:21:28');
INSERT INTO `tbl_huijiao_contents` VALUES (519, 'rj0304041202001', '阿基米德原理', '', 1, 0, 0, 0, 130, 19, 0, NULL, NULL, 'uploads/contents/0019031917114008299nr.pptx', 0, '2019-03-19 17:11:40', '2019-03-20 11:15:16');
INSERT INTO `tbl_huijiao_contents` VALUES (520, 'rj0304041302001', '物体的浮沉条件及应用', '', 1, 0, 0, 0, 131, 19, 0, NULL, NULL, 'uploads/contents/0019031917122706104nr.pptx', 0, '2019-03-19 17:12:27', '2019-03-20 11:15:23');
INSERT INTO `tbl_huijiao_contents` VALUES (521, 'bb0201030202001', '变', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/0019031917153609636nr', 0, '2019-03-19 17:15:36', '2019-03-19 17:15:36');
INSERT INTO `tbl_huijiao_contents` VALUES (522, 'bb0201030202002', '极', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/522019032117104509129nr', 0, '2019-03-19 17:16:17', '2019-03-21 17:10:45');
INSERT INTO `tbl_huijiao_contents` VALUES (523, 'bb0201030303002', '近反义词', '', 1, 1, 1, 0, 86, 22, 1, NULL, NULL, 'uploads/contents/523019031920215902768nr', 0, '2019-03-19 17:16:20', '2019-03-19 20:21:59');
INSERT INTO `tbl_huijiao_contents` VALUES (524, 'bb0201030303003', '词语搭配', '', 1, 1, 1, 0, 86, 22, 1, NULL, NULL, 'uploads/contents/524019031920214608433nr', 0, '2019-03-19 17:16:50', '2019-03-19 20:21:46');
INSERT INTO `tbl_huijiao_contents` VALUES (525, 'rj0304041402001', '功', '', 1, 0, 0, 0, 132, 19, 0, NULL, NULL, 'uploads/contents/0019031917173903720nr.pptx', 0, '2019-03-19 17:17:39', '2019-03-20 11:15:31');
INSERT INTO `tbl_huijiao_contents` VALUES (526, 'bb0201030202003', '片', '', 1, 1, 1, 0, 85, 12, 0, NULL, NULL, 'uploads/contents/0019031917174701918nr', 0, '2019-03-19 17:17:48', '2019-03-19 17:19:33');
INSERT INTO `tbl_huijiao_contents` VALUES (527, 'rj0304041502001', '功率', '', 1, 0, 0, 0, 133, 19, 0, NULL, NULL, 'uploads/contents/0019031917182209532nr.pptx', 0, '2019-03-19 17:18:22', '2019-03-20 11:15:36');
INSERT INTO `tbl_huijiao_contents` VALUES (528, 'bb0201030202004', '傍', '', 1, 1, 1, 0, 85, 12, 0, NULL, NULL, 'uploads/contents/0019031917184404249nr', 0, '2019-03-19 17:18:44', '2019-03-19 17:19:12');
INSERT INTO `tbl_huijiao_contents` VALUES (529, 'rj0304041602001', '动能和势能', '', 1, 0, 0, 0, 134, 19, 0, NULL, NULL, 'uploads/contents/0019031917185904603nr.pptx', 0, '2019-03-19 17:18:59', '2019-03-20 11:15:47');
INSERT INTO `tbl_huijiao_contents` VALUES (530, 'bb0201030202005', '海', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/0019031917200707511nr', 0, '2019-03-19 17:20:07', '2019-03-19 17:20:07');
INSERT INTO `tbl_huijiao_contents` VALUES (531, 'rj0304041702001', '机械能及其转化', '', 1, 0, 0, 0, 135, 19, 0, NULL, NULL, 'uploads/contents/0019031917200905944nr.pptx', 0, '2019-03-19 17:20:09', '2019-03-20 11:15:54');
INSERT INTO `tbl_huijiao_contents` VALUES (532, 'bb0201030803001', '重难点词语', '', 1, 1, 1, 0, 94, 22, 1, NULL, NULL, 'uploads/contents/532019031920222208536nr', 0, '2019-03-19 17:20:23', '2019-03-19 20:22:22');
INSERT INTO `tbl_huijiao_contents` VALUES (533, 'bb0201030202006', '洋', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/0019031917202702426nr', 0, '2019-03-19 17:20:27', '2019-03-19 17:20:27');
INSERT INTO `tbl_huijiao_contents` VALUES (534, 'bb0201030803002', '近反义词', '', 1, 1, 1, 0, 94, 22, 1, NULL, NULL, 'uploads/contents/534019031920223805574nr', 0, '2019-03-19 17:20:48', '2019-03-19 20:22:38');
INSERT INTO `tbl_huijiao_contents` VALUES (535, 'bb0201030202007', '作', '', 1, 1, 1, 0, 85, 12, 0, NULL, NULL, 'uploads/contents/0019031917204806688nr', 0, '2019-03-19 17:20:48', '2019-03-21 17:11:44');
INSERT INTO `tbl_huijiao_contents` VALUES (536, 'rj0304041802001', '杠杆 ', '', 1, 0, 0, 0, 136, 19, 0, NULL, NULL, 'uploads/contents/0019031917210602665nr.pptx', 0, '2019-03-19 17:21:06', '2019-03-20 11:16:01');
INSERT INTO `tbl_huijiao_contents` VALUES (537, 'bb0201030202008', '坏', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/0019031917211602705nr', 0, '2019-03-19 17:21:16', '2019-03-19 17:21:16');
INSERT INTO `tbl_huijiao_contents` VALUES (538, 'bb0201030803003', '词语搭配', '', 1, 1, 1, 0, 94, 22, 1, NULL, NULL, 'uploads/contents/538019031920225305262nr', 0, '2019-03-19 17:21:20', '2019-03-19 20:22:53');
INSERT INTO `tbl_huijiao_contents` VALUES (539, 'rj0304041902001', '滑轮', '', 1, 0, 0, 0, 137, 19, 0, NULL, NULL, 'uploads/contents/0019031917214107215nr.pptx', 0, '2019-03-19 17:21:41', '2019-03-20 11:16:07');
INSERT INTO `tbl_huijiao_contents` VALUES (540, 'bb0201030202009', '给', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/0019031917214506813nr', 0, '2019-03-19 17:21:45', '2019-03-19 17:21:45');
INSERT INTO `tbl_huijiao_contents` VALUES (541, 'bb0201030903001', '重难点词语', '', 1, 1, 1, 0, 95, 22, 1, NULL, NULL, 'uploads/contents/541019031920231406798nr', 0, '2019-03-19 17:21:59', '2019-03-19 20:23:14');
INSERT INTO `tbl_huijiao_contents` VALUES (542, 'bb0201030202010', '带', '', 1, 1, 1, 0, 85, 12, 1, NULL, NULL, 'uploads/contents/0019031917220203455nr', 0, '2019-03-19 17:22:02', '2019-03-19 17:22:02');
INSERT INTO `tbl_huijiao_contents` VALUES (543, 'bb0201030903002', '近反义词', '', 1, 1, 1, 0, 95, 22, 1, NULL, NULL, 'uploads/contents/543019031920232509795nr', 0, '2019-03-19 17:22:29', '2019-03-19 20:23:26');
INSERT INTO `tbl_huijiao_contents` VALUES (544, 'rj0304042002001', '机械效率', 'uploads/contents/544019031917470002815fj.doc', 1, 0, 0, 0, 138, 19, 0, NULL, NULL, 'uploads/contents/0019031917223501874nr.pptx', 0, '2019-03-19 17:22:35', '2019-03-20 11:16:12');
INSERT INTO `tbl_huijiao_contents` VALUES (545, 'bb0201030302001', '法', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/0019031917223801478nr', 0, '2019-03-19 17:22:38', '2019-03-19 17:22:38');
INSERT INTO `tbl_huijiao_contents` VALUES (546, 'bb0201030903003', '词语搭配', '', 1, 1, 1, 0, 95, 22, 1, NULL, NULL, 'uploads/contents/546019031920233704429nr', 0, '2019-03-19 17:22:57', '2019-03-19 20:23:37');
INSERT INTO `tbl_huijiao_contents` VALUES (547, 'bb0201030302002', '如', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/0019031917230301430nr', 0, '2019-03-19 17:23:03', '2019-03-19 17:23:03');
INSERT INTO `tbl_huijiao_contents` VALUES (548, 'bb0201030302003', '脚', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/0019031917232401788nr', 0, '2019-03-19 17:23:24', '2019-03-19 17:23:24');
INSERT INTO `tbl_huijiao_contents` VALUES (549, 'bb0201030302004', '它', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/549019032117121106258nr', 0, '2019-03-19 17:23:50', '2019-03-21 17:12:11');
INSERT INTO `tbl_huijiao_contents` VALUES (550, 'bb0201031003001', '重难点词语', '', 1, 1, 1, 0, 97, 22, 1, NULL, NULL, 'uploads/contents/550019031920251702083nr', 0, '2019-03-19 17:24:28', '2019-03-19 20:25:17');
INSERT INTO `tbl_huijiao_contents` VALUES (551, 'bb0201030302005', '娃', '', 1, 1, 1, 0, 86, 12, 0, NULL, NULL, 'uploads/contents/0019031917244807785nr', 0, '2019-03-19 17:24:49', '2019-03-19 17:25:14');
INSERT INTO `tbl_huijiao_contents` VALUES (552, 'bb0201031003002', '近反义词', '', 1, 1, 1, 0, 97, 22, 1, NULL, NULL, 'uploads/contents/552019031920253303835nr', 0, '2019-03-19 17:24:59', '2019-03-19 20:25:33');
INSERT INTO `tbl_huijiao_contents` VALUES (553, 'rj0304040105001', '力', 'uploads/contents/553019031917404005626fj.doc', 1, 1, 1, 0, 119, 24, 0, NULL, NULL, 'uploads/contents/0019031917250204469nr.doc', 0, '2019-03-19 17:25:02', '2019-03-20 11:20:11');
INSERT INTO `tbl_huijiao_contents` VALUES (554, 'bb0201031003003', '词语搭配', '', 1, 1, 1, 0, 97, 22, 1, NULL, NULL, 'uploads/contents/554019031920254606722nr', 0, '2019-03-19 17:25:29', '2019-03-19 20:25:46');
INSERT INTO `tbl_huijiao_contents` VALUES (555, 'bb0201030302006', '她', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/0019031917254401275nr', 0, '2019-03-19 17:25:44', '2019-03-19 17:25:44');
INSERT INTO `tbl_huijiao_contents` VALUES (556, 'bb0201031103001', '重难点词语', '', 1, 1, 1, 0, 96, 22, 1, NULL, NULL, 'uploads/contents/556019031920290709280nr', 0, '2019-03-19 17:26:19', '2019-03-19 20:29:07');
INSERT INTO `tbl_huijiao_contents` VALUES (557, 'rj0304040205001', '弹力', 'uploads/contents/557019031917410007644fj.doc', 1, 1, 1, 0, 120, 24, 0, NULL, NULL, 'uploads/contents/0019031917261901866nr.doc', 0, '2019-03-19 17:26:19', '2019-03-20 11:20:20');
INSERT INTO `tbl_huijiao_contents` VALUES (558, 'bb0201030302007', '毛', '', 1, 1, 1, 0, 86, 12, 0, NULL, NULL, 'uploads/contents/0019031917262304526nr', 0, '2019-03-19 17:26:23', '2019-03-19 17:28:03');
INSERT INTO `tbl_huijiao_contents` VALUES (559, 'bb0201030302008', '更', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/0019031917264402290nr', 0, '2019-03-19 17:26:44', '2019-03-19 17:26:44');
INSERT INTO `tbl_huijiao_contents` VALUES (560, 'bb0201031103002', '近反义词', '', 1, 1, 1, 0, 96, 22, 1, NULL, NULL, 'uploads/contents/560019031920291707728nr', 0, '2019-03-19 17:26:47', '2019-03-19 20:29:17');
INSERT INTO `tbl_huijiao_contents` VALUES (562, 'bb0201030302009', '知', '', 1, 1, 1, 0, 86, 12, 1, NULL, NULL, 'uploads/contents/0019031917270203886nr', 0, '2019-03-19 17:27:02', '2019-03-19 17:27:02');
INSERT INTO `tbl_huijiao_contents` VALUES (563, 'bb0201031103003', '词语搭配', '', 1, 1, 1, 0, 96, 22, 1, NULL, NULL, 'uploads/contents/563019031920293203145nr', 0, '2019-03-19 17:27:16', '2019-03-19 20:29:32');
INSERT INTO `tbl_huijiao_contents` VALUES (564, 'bb0201030302010', '识', '', 1, 1, 1, 0, 86, 12, 0, NULL, NULL, 'uploads/contents/0019031917273004294nr', 0, '2019-03-19 17:27:30', '2019-03-19 17:28:09');
INSERT INTO `tbl_huijiao_contents` VALUES (565, 'rj0304040305001', '重力', 'uploads/contents/565019031917412302288fj.doc', 1, 1, 1, 0, 121, 24, 0, NULL, NULL, 'uploads/contents/0019031917273407491nr.doc', 0, '2019-03-19 17:27:34', '2019-03-20 11:20:29');
INSERT INTO `tbl_huijiao_contents` VALUES (566, 'rj03040405001', '牛顿第一定律', 'uploads/contents/566019031917414303419fj.doc', 0, 1, 1, 0, 122, 24, 0, NULL, NULL, 'uploads/contents/0019031917281208376nr.doc', 0, '2019-03-19 17:28:12', '2019-03-19 17:41:43');
INSERT INTO `tbl_huijiao_contents` VALUES (567, 'rj0304040505001', '二力平衡', 'uploads/contents/567019031917421506773fj.doc', 1, 1, 1, 0, 123, 24, 0, NULL, NULL, 'uploads/contents/0019031917283908757nr.doc', 0, '2019-03-19 17:28:39', '2019-03-20 11:20:41');
INSERT INTO `tbl_huijiao_contents` VALUES (568, 'bb0201030402001', '园', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917284505243nr', 0, '2019-03-19 17:28:45', '2019-03-19 17:28:45');
INSERT INTO `tbl_huijiao_contents` VALUES (569, 'rj0304040605001', '摩擦力', 'uploads/contents/569019031917424108070fj.docx', 0, 1, 1, 0, 124, 24, 0, NULL, NULL, 'uploads/contents/0019031917291201406nr.docx', 0, '2019-03-19 17:29:12', '2019-03-19 17:42:41');
INSERT INTO `tbl_huijiao_contents` VALUES (570, 'rj0304040705001', '压强', 'uploads/contents/570019031917430307155fj.doc', 1, 1, 1, 0, 125, 24, 0, NULL, NULL, 'uploads/contents/0019031917294506211nr.doc', 0, '2019-03-19 17:29:45', '2019-03-20 11:21:24');
INSERT INTO `tbl_huijiao_contents` VALUES (571, 'bb0201030402002', '孔', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917300209333nr', 0, '2019-03-19 17:30:02', '2019-03-19 17:30:02');
INSERT INTO `tbl_huijiao_contents` VALUES (572, 'bb0201030402003', '桥', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/572019032117124209408nr', 0, '2019-03-19 17:30:22', '2019-03-21 17:12:42');
INSERT INTO `tbl_huijiao_contents` VALUES (573, 'rj0304040805001', '液体的压强', 'uploads/contents/573019031917432408701fj.doc', 1, 1, 1, 0, 126, 24, 0, NULL, NULL, 'uploads/contents/0019031917303107691nr.doc', 0, '2019-03-19 17:30:31', '2019-03-20 11:21:31');
INSERT INTO `tbl_huijiao_contents` VALUES (574, 'bb0201030402004', '群', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917304602722nr', 0, '2019-03-19 17:30:46', '2019-03-19 17:30:46');
INSERT INTO `tbl_huijiao_contents` VALUES (575, 'rj0304040905001', '大气压强 ', 'uploads/contents/575019031917433802113fj.doc', 1, 1, 1, 0, 127, 24, 0, NULL, NULL, 'uploads/contents/0019031917310706613nr.doc', 0, '2019-03-19 17:31:07', '2019-03-20 11:21:38');
INSERT INTO `tbl_huijiao_contents` VALUES (576, 'bb0201030402005', '队', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917310802503nr', 0, '2019-03-19 17:31:08', '2019-03-19 17:31:08');
INSERT INTO `tbl_huijiao_contents` VALUES (577, 'bb0201031203002', '近反义词', '', 1, 1, 1, 0, 98, 22, 1, NULL, NULL, 'uploads/contents/577019031920294305364nr', 0, '2019-03-19 17:31:22', '2019-03-19 20:29:43');
INSERT INTO `tbl_huijiao_contents` VALUES (578, 'bb0201030402006', '旗', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917313007708nr', 0, '2019-03-19 17:31:30', '2019-03-19 17:31:30');
INSERT INTO `tbl_huijiao_contents` VALUES (579, 'rj0304041005001', '流体压强与流速的关系', 'uploads/contents/579019031917440001939fj.doc', 1, 1, 1, 0, 128, 24, 0, NULL, NULL, 'uploads/contents/0019031917313606041nr.doc', 0, '2019-03-19 17:31:36', '2019-03-20 11:21:51');
INSERT INTO `tbl_huijiao_contents` VALUES (580, 'bb0201030402007', '铜', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917315806833nr', 0, '2019-03-19 17:31:58', '2019-03-19 17:31:58');
INSERT INTO `tbl_huijiao_contents` VALUES (581, 'rj0304041105001', '浮力', 'uploads/contents/581019031917442205671fj.doc', 1, 1, 1, 0, 129, 24, 0, NULL, NULL, 'uploads/contents/0019031917320707538nr.doc', 0, '2019-03-19 17:32:07', '2019-03-20 11:21:58');
INSERT INTO `tbl_huijiao_contents` VALUES (582, 'bb0201031303001', '重难点词语', '', 1, 1, 1, 0, 99, 22, 1, NULL, NULL, 'uploads/contents/582019031920295603180nr', 0, '2019-03-19 17:32:12', '2019-03-19 20:29:56');
INSERT INTO `tbl_huijiao_contents` VALUES (583, 'bb0201030402008', '号', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917323608851nr', 0, '2019-03-19 17:32:36', '2019-03-19 17:32:36');
INSERT INTO `tbl_huijiao_contents` VALUES (584, 'bb0201031303002', '近反义词', '', 1, 1, 1, 0, 99, 22, 1, NULL, NULL, 'uploads/contents/584019031920300706013nr', 0, '2019-03-19 17:32:38', '2019-03-19 20:30:07');
INSERT INTO `tbl_huijiao_contents` VALUES (585, 'rj0304041205001', '阿基米德原理', 'uploads/contents/585019031917443503372fj.doc', 1, 1, 1, 0, 130, 24, 0, NULL, NULL, 'uploads/contents/0019031917324906676nr.doc', 0, '2019-03-19 17:32:49', '2019-03-20 11:22:31');
INSERT INTO `tbl_huijiao_contents` VALUES (586, 'bb0201030402009', '领', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917330407267nr', 0, '2019-03-19 17:33:04', '2019-03-19 17:33:04');
INSERT INTO `tbl_huijiao_contents` VALUES (587, 'bb0201031303003', '词语搭配', '', 1, 1, 1, 0, 99, 22, 1, NULL, NULL, 'uploads/contents/587019031920302006040nr', 0, '2019-03-19 17:33:06', '2019-03-19 20:30:20');
INSERT INTO `tbl_huijiao_contents` VALUES (588, 'bb0201030402010', '巾', '', 1, 1, 1, 0, 88, 12, 1, NULL, NULL, 'uploads/contents/0019031917332204457nr', 0, '2019-03-19 17:33:22', '2019-03-19 17:33:22');
INSERT INTO `tbl_huijiao_contents` VALUES (589, 'rj0304041305001', '物体的浮沉条件及应用', 'uploads/contents/589019031917445706136fj.doc', 1, 1, 1, 0, 131, 24, 0, NULL, NULL, 'uploads/contents/0019031917332806433nr.doc', 0, '2019-03-19 17:33:28', '2019-03-20 11:22:46');
INSERT INTO `tbl_huijiao_contents` VALUES (590, 'bb0201031403001', '重难点词语', '', 1, 1, 1, 0, 100, 22, 1, NULL, NULL, 'uploads/contents/590019031920303509312nr', 0, '2019-03-19 17:33:42', '2019-03-19 20:30:35');
INSERT INTO `tbl_huijiao_contents` VALUES (591, 'bb0201030502001', '杨', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917334609473nr', 0, '2019-03-19 17:33:46', '2019-03-19 17:33:46');
INSERT INTO `tbl_huijiao_contents` VALUES (592, 'bb0201031403002', '近反义词', '', 1, 1, 1, 0, 100, 22, 1, NULL, NULL, 'uploads/contents/592019031920305001859nr', 0, '2019-03-19 17:34:06', '2019-03-19 20:30:50');
INSERT INTO `tbl_huijiao_contents` VALUES (593, 'rj0304041405001', '功', 'uploads/contents/593019031917451506611fj.doc', 1, 1, 1, 0, 132, 24, 0, NULL, NULL, 'uploads/contents/0019031917340705557nr.doc', 0, '2019-03-19 17:34:07', '2019-03-20 11:22:53');
INSERT INTO `tbl_huijiao_contents` VALUES (594, 'bb0201030502002', '壮', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917340907005nr', 0, '2019-03-19 17:34:09', '2019-03-19 17:34:09');
INSERT INTO `tbl_huijiao_contents` VALUES (595, 'bb0201031403003', '词语搭配', '', 1, 1, 1, 0, 100, 22, 1, NULL, NULL, 'uploads/contents/595019031920311001066nr', 0, '2019-03-19 17:34:32', '2019-03-19 20:31:11');
INSERT INTO `tbl_huijiao_contents` VALUES (596, 'bb0201030502003', '桐', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917343608940nr', 0, '2019-03-19 17:34:37', '2019-03-19 17:34:37');
INSERT INTO `tbl_huijiao_contents` VALUES (597, 'rj0304041505001', '功率 ', 'uploads/contents/597019031917453007847fj.doc', 1, 1, 1, 0, 133, 24, 0, NULL, NULL, 'uploads/contents/0019031917344009544nr.doc', 0, '2019-03-19 17:34:40', '2019-03-20 11:22:59');
INSERT INTO `tbl_huijiao_contents` VALUES (598, 'bb0201030502004', '枫', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917345503890nr', 0, '2019-03-19 17:34:55', '2019-03-19 17:34:55');
INSERT INTO `tbl_huijiao_contents` VALUES (599, 'rj0304041605001', '动能和势能', 'uploads/contents/599019031917455103786fj.doc', 1, 1, 1, 0, 134, 24, 0, NULL, NULL, 'uploads/contents/0019031917351802569nr.doc', 0, '2019-03-19 17:35:18', '2019-03-20 11:23:06');
INSERT INTO `tbl_huijiao_contents` VALUES (601, 'bb0201030502005', '松', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917354303466nr', 0, '2019-03-19 17:35:43', '2019-03-19 17:35:43');
INSERT INTO `tbl_huijiao_contents` VALUES (603, 'bb0201030502006', '柏', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917360809216nr', 0, '2019-03-19 17:36:08', '2019-03-19 17:36:08');
INSERT INTO `tbl_huijiao_contents` VALUES (604, 'rj0304041705001', '机械能及其转化', 'uploads/contents/604019031917461204088fj.doc', 1, 1, 1, 0, 135, 24, 0, NULL, NULL, 'uploads/contents/0019031917361003643nr.doc', 0, '2019-03-19 17:36:10', '2019-03-20 11:23:15');
INSERT INTO `tbl_huijiao_contents` VALUES (606, 'bb0201030502007', '棉', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917363601751nr', 0, '2019-03-19 17:36:36', '2019-03-19 17:36:36');
INSERT INTO `tbl_huijiao_contents` VALUES (607, 'rj0304041805001', '杠杆', 'uploads/contents/607019031917462603447fj.doc', 1, 1, 1, 0, 136, 24, 0, NULL, NULL, 'uploads/contents/0019031917364702016nr.doc', 0, '2019-03-19 17:36:47', '2019-03-20 11:23:20');
INSERT INTO `tbl_huijiao_contents` VALUES (609, 'bb0201030502008', '杉', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/609019032117130705659nr', 0, '2019-03-19 17:36:57', '2019-03-21 17:13:07');
INSERT INTO `tbl_huijiao_contents` VALUES (610, 'rj0304041905001', '滑轮', 'uploads/contents/610019031917463903020fj.doc', 1, 1, 1, 0, 137, 24, 0, NULL, NULL, 'uploads/contents/0019031917371801475nr.doc', 0, '2019-03-19 17:37:18', '2019-03-20 11:23:26');
INSERT INTO `tbl_huijiao_contents` VALUES (612, 'bb0201030502009', '化', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917372702891nr', 0, '2019-03-19 17:37:27', '2019-03-19 17:37:27');
INSERT INTO `tbl_huijiao_contents` VALUES (614, 'rj0304042005001', '机械效率', 'uploads/contents/614019032011200401582fj.doc', 1, 1, 1, 0, 138, 24, 0, NULL, NULL, 'uploads/contents/0019031917375104120nr.doc', 0, '2019-03-19 17:37:51', '2019-03-20 11:20:08');
INSERT INTO `tbl_huijiao_contents` VALUES (615, 'bb0201030502010', '桂', '', 1, 1, 1, 0, 89, 12, 1, NULL, NULL, 'uploads/contents/0019031917380802790nr', 0, '2019-03-19 17:38:08', '2019-03-19 17:38:08');
INSERT INTO `tbl_huijiao_contents` VALUES (618, 'bb0201030602001', '歌', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917385403867nr', 0, '2019-03-19 17:38:54', '2019-03-19 17:38:54');
INSERT INTO `tbl_huijiao_contents` VALUES (619, 'bb0201030602002', '丛', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917394503823nr', 0, '2019-03-19 17:39:45', '2019-03-19 17:39:45');
INSERT INTO `tbl_huijiao_contents` VALUES (620, 'bb0201030602003', '深', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917401102068nr', 0, '2019-03-19 17:40:12', '2019-03-19 17:40:12');
INSERT INTO `tbl_huijiao_contents` VALUES (621, 'bb0201030602004', '处', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917405708041nr', 0, '2019-03-19 17:40:57', '2019-03-19 17:40:57');
INSERT INTO `tbl_huijiao_contents` VALUES (622, 'bb0201030602005', '六', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917412407616nr', 0, '2019-03-19 17:41:24', '2019-03-19 17:41:24');
INSERT INTO `tbl_huijiao_contents` VALUES (623, 'bb0201030602006', '熊', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917414303322nr', 0, '2019-03-19 17:41:43', '2019-03-19 17:41:43');
INSERT INTO `tbl_huijiao_contents` VALUES (624, 'bb0201030602007', '猫', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917420407808nr', 0, '2019-03-19 17:42:04', '2019-03-19 17:42:04');
INSERT INTO `tbl_huijiao_contents` VALUES (625, 'bb0201030602008', '九', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917423205145nr', 0, '2019-03-19 17:42:32', '2019-03-19 17:42:32');
INSERT INTO `tbl_huijiao_contents` VALUES (626, 'bb0201030602009', '朋', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/626019032117132706376nr', 0, '2019-03-19 17:42:53', '2019-03-21 17:13:27');
INSERT INTO `tbl_huijiao_contents` VALUES (627, 'bb0201030602010', '友', '', 1, 1, 1, 0, 92, 12, 1, NULL, NULL, 'uploads/contents/0019031917431301020nr', 0, '2019-03-19 17:43:13', '2019-03-19 17:43:13');
INSERT INTO `tbl_huijiao_contents` VALUES (628, 'bb0201031503001', '重难点词语', '', 1, 1, 1, 0, 101, 22, 1, NULL, NULL, 'uploads/contents/628019031920312705166nr', 0, '2019-03-19 17:47:01', '2019-03-19 20:31:27');
INSERT INTO `tbl_huijiao_contents` VALUES (629, 'bb0201031503002', '近反义词', '', 1, 1, 1, 0, 101, 22, 1, NULL, NULL, 'uploads/contents/629019031920314405204nr', 0, '2019-03-19 17:47:30', '2019-03-19 20:31:44');
INSERT INTO `tbl_huijiao_contents` VALUES (630, 'bb0201031503003', '词语搭配', '', 1, 1, 1, 0, 101, 22, 1, NULL, NULL, 'uploads/contents/630019031920315908389nr', 0, '2019-03-19 17:48:02', '2019-03-19 20:31:59');
INSERT INTO `tbl_huijiao_contents` VALUES (631, 'bb0201031603001', '重难点词语', '', 1, 1, 1, 0, 102, 22, 1, NULL, NULL, 'uploads/contents/631019031920321706526nr', 0, '2019-03-19 17:48:52', '2019-03-19 20:32:17');
INSERT INTO `tbl_huijiao_contents` VALUES (632, 'bb0201030702001', '季', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917491605720nr', 0, '2019-03-19 17:49:16', '2019-03-19 17:49:16');
INSERT INTO `tbl_huijiao_contents` VALUES (633, 'bb0201031603002', '近反义词', '', 1, 1, 1, 0, 102, 22, 1, NULL, NULL, 'uploads/contents/633019031920322907027nr', 0, '2019-03-19 17:49:20', '2019-03-19 20:32:29');
INSERT INTO `tbl_huijiao_contents` VALUES (634, 'bb0201030702002', '吹', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917494304059nr', 0, '2019-03-19 17:49:43', '2019-03-19 17:49:43');
INSERT INTO `tbl_huijiao_contents` VALUES (635, 'bb0201031603003', '词语搭配', '', 1, 1, 1, 0, 102, 22, 1, NULL, NULL, 'uploads/contents/635019031920324405186nr', 0, '2019-03-19 17:49:47', '2019-03-19 20:32:44');
INSERT INTO `tbl_huijiao_contents` VALUES (636, 'bb0201030702003', '肥', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917500802782nr', 0, '2019-03-19 17:50:08', '2019-03-19 17:50:08');
INSERT INTO `tbl_huijiao_contents` VALUES (637, 'bb0201031703001', '重难点词语', '', 1, 1, 1, 0, 103, 22, 1, NULL, NULL, 'uploads/contents/637019031920325605723nr', 0, '2019-03-19 17:50:37', '2019-03-19 20:32:56');
INSERT INTO `tbl_huijiao_contents` VALUES (638, 'bb0201030702004', '农', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917504106025nr', 0, '2019-03-19 17:50:41', '2019-03-19 17:50:41');
INSERT INTO `tbl_huijiao_contents` VALUES (639, 'bb0201031703002', '近反义词', '', 1, 1, 1, 0, 103, 22, 1, NULL, NULL, 'uploads/contents/639019031920335204743nr', 0, '2019-03-19 17:51:05', '2019-03-19 20:33:52');
INSERT INTO `tbl_huijiao_contents` VALUES (640, 'bb0201030702005', '忙', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917511509928nr', 0, '2019-03-19 17:51:15', '2019-03-19 17:51:15');
INSERT INTO `tbl_huijiao_contents` VALUES (641, 'bb0201031703003', '词语搭配', '', 1, 1, 1, 0, 103, 22, 1, NULL, NULL, 'uploads/contents/641019031920343102141nr', 0, '2019-03-19 17:51:32', '2019-03-19 20:34:32');
INSERT INTO `tbl_huijiao_contents` VALUES (642, 'bb0201031803001', '重难点词语', '', 1, 1, 1, 0, 104, 22, 1, NULL, NULL, 'uploads/contents/642019031920344506512nr', 0, '2019-03-19 17:52:11', '2019-03-19 20:34:45');
INSERT INTO `tbl_huijiao_contents` VALUES (643, 'bb0201031803002', '近反义词', '', 1, 1, 1, 0, 104, 22, 1, NULL, NULL, 'uploads/contents/643019031920345909155nr', 0, '2019-03-19 17:52:36', '2019-03-19 20:34:59');
INSERT INTO `tbl_huijiao_contents` VALUES (644, 'bb0201030702006', '归', '', 1, 1, 1, 0, 93, 12, 0, NULL, NULL, 'uploads/contents/0019031917524707046nr', 0, '2019-03-19 17:52:47', '2019-03-19 17:53:30');
INSERT INTO `tbl_huijiao_contents` VALUES (645, 'bb0201031803003', '词语搭配', '', 1, 1, 1, 0, 104, 22, 1, NULL, NULL, 'uploads/contents/645019031920351208348nr', 0, '2019-03-19 17:53:04', '2019-03-19 20:35:12');
INSERT INTO `tbl_huijiao_contents` VALUES (646, 'bb0201030702007', '戴', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/646019032117134809327nr', 0, '2019-03-19 17:53:07', '2019-03-21 17:13:48');
INSERT INTO `tbl_huijiao_contents` VALUES (647, 'bb0201031903001', '重难点词语', '', 1, 1, 1, 0, 105, 22, 1, NULL, NULL, 'uploads/contents/647019031920352806892nr', 0, '2019-03-19 17:53:50', '2019-03-19 20:35:28');
INSERT INTO `tbl_huijiao_contents` VALUES (648, 'bb0201030702008', '辛', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917540102659nr', 0, '2019-03-19 17:54:01', '2019-03-19 17:54:01');
INSERT INTO `tbl_huijiao_contents` VALUES (650, 'bb0201030702009', '苦', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917544201505nr', 0, '2019-03-19 17:54:42', '2019-03-19 17:54:42');
INSERT INTO `tbl_huijiao_contents` VALUES (651, 'bb0201030702010', '年', '', 1, 1, 1, 0, 93, 12, 1, NULL, NULL, 'uploads/contents/0019031917550507470nr', 0, '2019-03-19 17:55:05', '2019-03-19 17:55:05');
INSERT INTO `tbl_huijiao_contents` VALUES (652, 'bb0201030802001', '称', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031917553908498nr', 0, '2019-03-19 17:55:39', '2019-03-19 17:55:39');
INSERT INTO `tbl_huijiao_contents` VALUES (653, 'bb0201030802002', '柱', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031917565106531nr', 0, '2019-03-19 17:56:51', '2019-03-19 17:56:51');
INSERT INTO `tbl_huijiao_contents` VALUES (654, 'bb0201030802003', '底', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031917581507894nr', 0, '2019-03-19 17:58:15', '2019-03-19 17:58:15');
INSERT INTO `tbl_huijiao_contents` VALUES (655, 'bb0201030802004', '杆', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031917584905799nr', 0, '2019-03-19 17:58:49', '2019-03-19 17:58:49');
INSERT INTO `tbl_huijiao_contents` VALUES (656, 'bb0201030802005', '秤', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031917591307454nr', 0, '2019-03-19 17:59:13', '2019-03-19 17:59:13');
INSERT INTO `tbl_huijiao_contents` VALUES (657, 'bb0201030802006', '做', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031917592905892nr', 0, '2019-03-19 17:59:29', '2019-03-19 17:59:29');
INSERT INTO `tbl_huijiao_contents` VALUES (658, 'bb0201030802007', '岁', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/658019032117151706170nr', 0, '2019-03-19 17:59:48', '2019-03-21 17:15:17');
INSERT INTO `tbl_huijiao_contents` VALUES (659, 'rj0304040307001', '重力', 'uploads/contents/659019031918215809903fj.doc', 1, 1, 1, 0, 121, 25, 0, NULL, NULL, 'uploads/contents/0019031918000806613nr.doc', 0, '2019-03-19 18:00:08', '2019-03-20 11:30:57');
INSERT INTO `tbl_huijiao_contents` VALUES (660, 'bb0201030802008', '站', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031918001002241nr', 0, '2019-03-19 18:00:10', '2019-03-19 18:00:10');
INSERT INTO `tbl_huijiao_contents` VALUES (661, 'bb0201030802009', '船', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031918003103531nr', 0, '2019-03-19 18:00:31', '2019-03-19 18:00:31');
INSERT INTO `tbl_huijiao_contents` VALUES (662, 'bb0201030802010', '然', '', 1, 1, 1, 0, 94, 12, 1, NULL, NULL, 'uploads/contents/0019031918005008054nr', 0, '2019-03-19 18:00:50', '2019-03-19 18:00:50');
INSERT INTO `tbl_huijiao_contents` VALUES (663, 'bb0201030902001', '画', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918013902612nr', 0, '2019-03-19 18:01:39', '2019-03-19 18:01:39');
INSERT INTO `tbl_huijiao_contents` VALUES (664, 'bb0201030902002', '幅', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918021303471nr', 0, '2019-03-19 18:02:13', '2019-03-19 18:02:13');
INSERT INTO `tbl_huijiao_contents` VALUES (665, 'bb0201030902003', '评', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918023102903nr', 0, '2019-03-19 18:02:31', '2019-03-19 18:02:31');
INSERT INTO `tbl_huijiao_contents` VALUES (666, 'bb0201030902004', '奖', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918025801919nr', 0, '2019-03-19 18:02:58', '2019-03-19 18:02:58');
INSERT INTO `tbl_huijiao_contents` VALUES (667, 'bb0201030902005', '候', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918032209156nr', 0, '2019-03-19 18:03:22', '2019-03-19 18:03:22');
INSERT INTO `tbl_huijiao_contents` VALUES (668, 'bb0201030902006', '报', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918033804630nr', 0, '2019-03-19 18:03:38', '2019-03-19 18:03:38');
INSERT INTO `tbl_huijiao_contents` VALUES (669, 'bb0201030902007', '另', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/669019032117155305448nr', 0, '2019-03-19 18:04:00', '2019-03-21 17:15:53');
INSERT INTO `tbl_huijiao_contents` VALUES (670, 'bb0201030902008', '及', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918042106779nr', 0, '2019-03-19 18:04:21', '2019-03-19 18:04:21');
INSERT INTO `tbl_huijiao_contents` VALUES (671, 'bb0201030902009', '拿', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918043602343nr', 0, '2019-03-19 18:04:36', '2019-03-19 18:04:36');
INSERT INTO `tbl_huijiao_contents` VALUES (672, 'bb0201030902010', '并', '', 1, 1, 1, 0, 95, 12, 1, NULL, NULL, 'uploads/contents/0019031918045307664nr', 0, '2019-03-19 18:04:53', '2019-03-19 18:04:53');
INSERT INTO `tbl_huijiao_contents` VALUES (673, 'bb0201031002001', '封', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918052002687nr', 0, '2019-03-19 18:05:20', '2019-03-19 18:05:20');
INSERT INTO `tbl_huijiao_contents` VALUES (674, 'bb0201031002002', '信', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918054307831nr', 0, '2019-03-19 18:05:43', '2019-03-19 18:05:43');
INSERT INTO `tbl_huijiao_contents` VALUES (675, 'bb0201031002003', '今', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918060104661nr', 0, '2019-03-19 18:06:01', '2019-03-19 18:06:01');
INSERT INTO `tbl_huijiao_contents` VALUES (676, 'bb0201031002004', '写', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918062403592nr', 0, '2019-03-19 18:06:24', '2019-03-19 18:06:24');
INSERT INTO `tbl_huijiao_contents` VALUES (677, 'bb0201031002005', '支', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918064705962nr', 0, '2019-03-19 18:06:47', '2019-03-19 18:06:47');
INSERT INTO `tbl_huijiao_contents` VALUES (679, 'rj0304040307003', '重力', 'uploads/contents/679019031918222508455fj.doc', 1, 1, 1, 0, 121, 25, 0, NULL, NULL, 'uploads/contents/0019031918065909848nr.doc', 0, '2019-03-19 18:06:59', '2019-03-20 11:31:08');
INSERT INTO `tbl_huijiao_contents` VALUES (680, 'bb0201031002006', '圆', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918070502193nr', 0, '2019-03-19 18:07:05', '2019-03-19 18:07:05');
INSERT INTO `tbl_huijiao_contents` VALUES (681, 'bb0201031002007', '珠', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/681019032117165005505nr', 0, '2019-03-19 18:07:22', '2019-03-21 17:16:50');
INSERT INTO `tbl_huijiao_contents` VALUES (682, 'rj0304040307005', ' 重力', 'uploads/contents/682019031918223903490fj.doc', 1, 1, 1, 0, 121, 25, 0, NULL, NULL, 'uploads/contents/0019031918075004511nr.doc', 0, '2019-03-19 18:07:50', '2019-03-20 11:31:15');
INSERT INTO `tbl_huijiao_contents` VALUES (683, 'bb0201030203001', '重难点词语', '', 1, 1, 1, 0, 85, 22, 1, NULL, NULL, 'uploads/contents/683019031920201904315nr', 0, '2019-03-19 18:07:52', '2019-03-19 20:20:19');
INSERT INTO `tbl_huijiao_contents` VALUES (684, 'bb0201031002008', '笔', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918075707540nr', 0, '2019-03-19 18:07:58', '2019-03-19 18:07:58');
INSERT INTO `tbl_huijiao_contents` VALUES (685, 'bb0201031002009', '灯', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918082005297nr', 0, '2019-03-19 18:08:20', '2019-03-19 18:08:20');
INSERT INTO `tbl_huijiao_contents` VALUES (686, 'bb0201030203002', '近反义词', '', 1, 1, 1, 0, 85, 22, 1, NULL, NULL, 'uploads/contents/686019031920203407396nr', 0, '2019-03-19 18:08:24', '2019-03-19 20:20:35');
INSERT INTO `tbl_huijiao_contents` VALUES (687, 'bb0201031002010', '电', '', 1, 1, 1, 0, 97, 12, 1, NULL, NULL, 'uploads/contents/0019031918083907361nr', 0, '2019-03-19 18:08:39', '2019-03-19 18:08:39');
INSERT INTO `tbl_huijiao_contents` VALUES (688, 'bb0201030203003', '词语搭配', '', 1, 1, 1, 0, 85, 22, 1, NULL, NULL, 'uploads/contents/688019031920210805504nr', 0, '2019-03-19 18:08:51', '2019-03-19 20:21:08');
INSERT INTO `tbl_huijiao_contents` VALUES (689, 'bb0201031102001', '哄', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918091407675nr', 0, '2019-03-19 18:09:14', '2019-03-19 18:09:14');
INSERT INTO `tbl_huijiao_contents` VALUES (691, 'bb0201031102002', '先', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918093608115nr', 0, '2019-03-19 18:09:36', '2019-03-19 18:09:36');
INSERT INTO `tbl_huijiao_contents` VALUES (692, 'bb0201031102003', '闭', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918100706513nr', 0, '2019-03-19 18:10:07', '2019-03-19 18:10:07');
INSERT INTO `tbl_huijiao_contents` VALUES (694, 'bb0201031102004', '脸', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918103003299nr', 0, '2019-03-19 18:10:30', '2019-03-19 18:10:30');
INSERT INTO `tbl_huijiao_contents` VALUES (695, 'bb0201031102005', '事', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918104904971nr', 0, '2019-03-19 18:10:49', '2019-03-19 18:10:49');
INSERT INTO `tbl_huijiao_contents` VALUES (697, 'bb0201031102006', '沉', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/697019032117185301089nr', 0, '2019-03-19 18:11:09', '2019-03-21 17:18:53');
INSERT INTO `tbl_huijiao_contents` VALUES (698, 'bb0201031102007', '发', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918113305767nr', 0, '2019-03-19 18:11:33', '2019-03-19 18:11:33');
INSERT INTO `tbl_huijiao_contents` VALUES (699, 'bb0201031102008', '窗', '', 1, 1, 1, 0, 96, 12, 1, NULL, NULL, 'uploads/contents/0019031918115208559nr', 0, '2019-03-19 18:11:52', '2019-03-19 18:11:52');
INSERT INTO `tbl_huijiao_contents` VALUES (700, 'bb0201031903002', '近反义词', '', 1, 1, 1, 0, 105, 22, 1, NULL, NULL, 'uploads/contents/700019031920354302846nr', 0, '2019-03-19 18:12:05', '2019-03-19 20:35:43');
INSERT INTO `tbl_huijiao_contents` VALUES (701, 'bb0201031903003', '词语搭配', '', 1, 1, 1, 0, 105, 22, 1, NULL, NULL, 'uploads/contents/701019031920355905048nr', 0, '2019-03-19 18:12:29', '2019-03-19 20:35:59');
INSERT INTO `tbl_huijiao_contents` VALUES (702, 'rj0304041007001', '流体压强与流速的关系', 'uploads/contents/702019031918250302105fj.doc', 1, 1, 1, 0, 128, 25, 0, NULL, NULL, 'uploads/contents/0019031918123909750nr.doc', 0, '2019-03-19 18:12:39', '2019-03-20 11:31:44');
INSERT INTO `tbl_huijiao_contents` VALUES (703, 'rj0304041007003', '流体压强与流速的关系', 'uploads/contents/703019031918254802356fj.doc', 1, 1, 1, 0, 128, 25, 0, NULL, NULL, 'uploads/contents/0019031918132202457nr.doc', 0, '2019-03-19 18:13:22', '2019-03-20 11:31:50');
INSERT INTO `tbl_huijiao_contents` VALUES (704, 'bb0201032003001', '重难点词语', '', 1, 1, 1, 0, 106, 22, 1, NULL, NULL, 'uploads/contents/704019031920361904635nr', 0, '2019-03-19 18:13:29', '2019-03-19 20:36:19');
INSERT INTO `tbl_huijiao_contents` VALUES (705, 'bb0201031202001', '楼', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918133506330nr', 0, '2019-03-19 18:13:35', '2019-03-19 18:13:35');
INSERT INTO `tbl_huijiao_contents` VALUES (706, 'rj0304041007005', '流体压强与流速的关系', 'uploads/contents/706019031918260205348fj.docx', 1, 1, 1, 0, 128, 25, 0, NULL, NULL, 'uploads/contents/0019031918135901430nr.docx', 0, '2019-03-19 18:13:59', '2019-03-20 11:31:56');
INSERT INTO `tbl_huijiao_contents` VALUES (707, 'bb0201032003002', '近反义词', '', 1, 1, 1, 0, 106, 22, 1, NULL, NULL, 'uploads/contents/707019031920363104431nr', 0, '2019-03-19 18:14:04', '2019-03-19 20:36:31');
INSERT INTO `tbl_huijiao_contents` VALUES (708, 'bb0201032003003', '词语搭配', '', 1, 1, 1, 0, 106, 22, 1, NULL, NULL, 'uploads/contents/708019031920364207569nr', 0, '2019-03-19 18:14:31', '2019-03-19 20:36:42');
INSERT INTO `tbl_huijiao_contents` VALUES (709, 'bb0201031202002', '依', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918143502060nr', 0, '2019-03-19 18:14:35', '2019-03-19 18:14:35');
INSERT INTO `tbl_huijiao_contents` VALUES (710, 'rj0304041307001', ' 物体的浮沉条件及应用', 'uploads/contents/710019031918263101756fj.doc', 1, 1, 1, 0, 131, 25, 0, NULL, NULL, 'uploads/contents/0019031918143904805nr.doc', 0, '2019-03-19 18:14:39', '2019-03-20 11:32:03');
INSERT INTO `tbl_huijiao_contents` VALUES (711, 'bb0201031202003', '尽', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918145308243nr', 0, '2019-03-19 18:14:53', '2019-03-19 18:14:53');
INSERT INTO `tbl_huijiao_contents` VALUES (712, 'bb0201032103001', '重难点词语', '', 1, 1, 1, 0, 107, 22, 1, NULL, NULL, 'uploads/contents/712019031920365507175nr', 0, '2019-03-19 18:15:18', '2019-03-19 20:36:55');
INSERT INTO `tbl_huijiao_contents` VALUES (713, 'bb0201031202004', '黄', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918151907180nr', 0, '2019-03-19 18:15:19', '2019-03-19 18:15:19');
INSERT INTO `tbl_huijiao_contents` VALUES (714, 'rj0304041307003', '物体的浮沉条件及应用', 'uploads/contents/714019031918264407821fj.doc', 1, 1, 1, 0, 131, 25, 0, NULL, NULL, 'uploads/contents/0019031918153009229nr.doc', 0, '2019-03-19 18:15:30', '2019-03-20 11:32:12');
INSERT INTO `tbl_huijiao_contents` VALUES (715, 'bb0201031202005', '层', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918154106951nr', 0, '2019-03-19 18:15:41', '2019-03-19 18:15:41');
INSERT INTO `tbl_huijiao_contents` VALUES (716, 'bb0201032103002', '近反义词', '', 1, 1, 1, 0, 107, 22, 1, NULL, NULL, 'uploads/contents/716019031920370702700nr', 0, '2019-03-19 18:15:59', '2019-03-19 20:37:07');
INSERT INTO `tbl_huijiao_contents` VALUES (717, 'rj0304041307005', '物体的浮沉条件及应用', 'uploads/contents/717019031918265405925fj.doc', 1, 1, 1, 0, 131, 25, 0, NULL, NULL, 'uploads/contents/0019031918160201446nr.doc', 0, '2019-03-19 18:16:02', '2019-03-20 11:32:19');
INSERT INTO `tbl_huijiao_contents` VALUES (718, 'bb0201031202006', '照', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918160806981nr', 0, '2019-03-19 18:16:08', '2019-03-19 18:16:08');
INSERT INTO `tbl_huijiao_contents` VALUES (719, 'bb0201032103003', '词语搭配', '', 1, 1, 1, 0, 107, 22, 1, NULL, NULL, 'uploads/contents/719019031920372109499nr', 0, '2019-03-19 18:16:24', '2019-03-19 20:37:21');
INSERT INTO `tbl_huijiao_contents` VALUES (720, 'bb0201031202007', '炉', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/720019032117191602485nr', 0, '2019-03-19 18:16:30', '2019-03-21 17:19:16');
INSERT INTO `tbl_huijiao_contents` VALUES (721, 'rj0304041707001', '机械能及其转化', 'uploads/contents/721019031918272601932fj.doc', 1, 1, 1, 0, 135, 25, 0, NULL, NULL, 'uploads/contents/0019031918164401266nr.doc', 0, '2019-03-19 18:16:44', '2019-03-20 11:32:25');
INSERT INTO `tbl_huijiao_contents` VALUES (722, 'bb0201031202008', '烟', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918164908621nr', 0, '2019-03-19 18:16:49', '2019-03-19 18:16:49');
INSERT INTO `tbl_huijiao_contents` VALUES (723, 'bb0201032203002', '近反义词', '', 1, 1, 1, 0, 108, 22, 1, NULL, NULL, 'uploads/contents/723019031920373904012nr', 0, '2019-03-19 18:17:10', '2019-03-19 20:37:39');
INSERT INTO `tbl_huijiao_contents` VALUES (724, 'rj0304041707003', '机械能及其转化', 'uploads/contents/724019031918274707489fj.doc', 1, 1, 1, 0, 135, 25, 0, NULL, NULL, 'uploads/contents/0019031918172304110nr.doc', 0, '2019-03-19 18:17:23', '2019-03-20 11:32:31');
INSERT INTO `tbl_huijiao_contents` VALUES (725, 'bb0201032303001', '重难点词语', '', 1, 1, 1, 0, 109, 22, 1, NULL, NULL, 'uploads/contents/725019031920380309916nr', 0, '2019-03-19 18:17:54', '2019-03-19 20:38:03');
INSERT INTO `tbl_huijiao_contents` VALUES (726, 'bb0201031202009', '挂', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918175508367nr', 0, '2019-03-19 18:17:55', '2019-03-19 18:17:55');
INSERT INTO `tbl_huijiao_contents` VALUES (727, 'bb0201031202010', '川', '', 1, 1, 1, 0, 98, 12, 1, NULL, NULL, 'uploads/contents/0019031918181303947nr', 0, '2019-03-19 18:18:13', '2019-03-19 18:18:13');
INSERT INTO `tbl_huijiao_contents` VALUES (728, 'bb0201032303002', '近反义词', '', 1, 1, 1, 0, 109, 22, 1, NULL, NULL, 'uploads/contents/728019031920381303310nr', 0, '2019-03-19 18:18:20', '2019-03-19 20:38:13');
INSERT INTO `tbl_huijiao_contents` VALUES (729, 'rj0304041707005', ' 机械能及其转化', 'uploads/contents/729019031918280202676fj.doc', 1, 1, 1, 0, 135, 25, 0, NULL, NULL, 'uploads/contents/0019031918182504918nr.doc', 0, '2019-03-19 18:18:25', '2019-03-20 11:32:36');
INSERT INTO `tbl_huijiao_contents` VALUES (730, 'bb0201031302001', '南', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918183906652nr', 0, '2019-03-19 18:18:39', '2019-03-19 18:18:39');
INSERT INTO `tbl_huijiao_contents` VALUES (731, 'bb0201031302002', '部', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918190304128nr', 0, '2019-03-19 18:19:03', '2019-03-19 18:19:03');
INSERT INTO `tbl_huijiao_contents` VALUES (732, 'bb0201032303003', '词语搭配', '', 1, 1, 1, 0, 109, 22, 1, NULL, NULL, 'uploads/contents/732019031920383301563nr', 0, '2019-03-19 18:19:13', '2019-03-19 20:38:33');
INSERT INTO `tbl_huijiao_contents` VALUES (733, 'rj0304042007001', '机械效率', 'uploads/contents/733019031918285803012fj.doc', 1, 1, 1, 0, 138, 25, 0, NULL, NULL, 'uploads/contents/0019031918192001994nr.doc', 0, '2019-03-19 18:19:20', '2019-03-20 11:32:41');
INSERT INTO `tbl_huijiao_contents` VALUES (734, 'bb0201031302003', '些', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918192004467nr', 0, '2019-03-19 18:19:20', '2019-03-19 18:19:20');
INSERT INTO `tbl_huijiao_contents` VALUES (735, 'bb0201031302004', '巨', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918194601310nr', 0, '2019-03-19 18:19:46', '2019-03-19 18:19:46');
INSERT INTO `tbl_huijiao_contents` VALUES (737, 'bb0201031302005', '位', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918200701509nr', 0, '2019-03-19 18:20:07', '2019-03-19 18:20:07');
INSERT INTO `tbl_huijiao_contents` VALUES (738, 'bb0201031302006', '每', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918202605011nr', 0, '2019-03-19 18:20:26', '2019-03-19 18:20:26');
INSERT INTO `tbl_huijiao_contents` VALUES (739, 'rj0304042007003', '机械效率', 'uploads/contents/739019031918290903151fj.doc', 1, 1, 1, 0, 138, 25, 0, NULL, NULL, 'uploads/contents/0019031918203203833nr.doc', 0, '2019-03-19 18:20:32', '2019-03-20 11:32:47');
INSERT INTO `tbl_huijiao_contents` VALUES (740, 'bb0201032403001', '重难点词语', '', 1, 1, 1, 0, 110, 22, 1, NULL, NULL, 'uploads/contents/740019031920392804106nr', 0, '2019-03-19 18:20:41', '2019-03-19 20:39:28');
INSERT INTO `tbl_huijiao_contents` VALUES (741, 'bb0201031302007', '升', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/741019032117193407664nr', 0, '2019-03-19 18:20:45', '2019-03-21 17:19:34');
INSERT INTO `tbl_huijiao_contents` VALUES (742, 'rj0304042007005', '机械效率', 'uploads/contents/742019031918292008471fj.docx', 1, 1, 1, 0, 138, 25, 0, NULL, NULL, 'uploads/contents/0019031918210306715nr.docx', 0, '2019-03-19 18:21:03', '2019-03-20 11:32:52');
INSERT INTO `tbl_huijiao_contents` VALUES (743, 'bb0201031302008', '闪', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918210603946nr', 0, '2019-03-19 18:21:06', '2019-03-19 18:21:06');
INSERT INTO `tbl_huijiao_contents` VALUES (744, 'bb0201032403002', '近反义词', '', 1, 1, 1, 0, 110, 22, 1, NULL, NULL, 'uploads/contents/744019031920394206933nr', 0, '2019-03-19 18:21:21', '2019-03-19 20:39:42');
INSERT INTO `tbl_huijiao_contents` VALUES (745, 'bb0201031302009', '狗', '', 1, 1, 1, 0, 99, 12, 1, NULL, NULL, 'uploads/contents/0019031918212305349nr', 0, '2019-03-19 18:21:23', '2019-03-19 18:21:23');
INSERT INTO `tbl_huijiao_contents` VALUES (746, 'bb0201032403003', '词语搭配', '', 1, 1, 1, 0, 110, 22, 1, NULL, NULL, 'uploads/contents/746019031920395407142nr', 0, '2019-03-19 18:21:59', '2019-03-19 20:39:54');
INSERT INTO `tbl_huijiao_contents` VALUES (747, 'bb0201031402001', '名', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918222205236nr', 0, '2019-03-19 18:22:22', '2019-03-19 18:22:22');
INSERT INTO `tbl_huijiao_contents` VALUES (748, 'bb0201031402002', '胜', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918224805848nr', 0, '2019-03-19 18:22:48', '2019-03-19 18:22:48');
INSERT INTO `tbl_huijiao_contents` VALUES (749, 'bb0201032503001', '重难点词语', '', 1, 1, 1, 0, 112, 22, 1, NULL, NULL, 'uploads/contents/749019031920400701254nr', 0, '2019-03-19 18:22:52', '2019-03-19 20:40:07');
INSERT INTO `tbl_huijiao_contents` VALUES (750, 'bb0201031402003', '迹', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918230804724nr', 0, '2019-03-19 18:23:08', '2019-03-19 18:23:08');
INSERT INTO `tbl_huijiao_contents` VALUES (751, 'bb0201032503002', '近反义词', '', 1, 1, 1, 0, 112, 22, 1, NULL, NULL, 'uploads/contents/751019031920402207325nr', 0, '2019-03-19 18:23:25', '2019-03-19 20:40:22');
INSERT INTO `tbl_huijiao_contents` VALUES (752, 'bb0201031402004', '央', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918234105871nr', 0, '2019-03-19 18:23:41', '2019-03-19 18:23:41');
INSERT INTO `tbl_huijiao_contents` VALUES (753, 'bb0201031402005', '丽', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918240503524nr', 0, '2019-03-19 18:24:05', '2019-03-19 18:24:05');
INSERT INTO `tbl_huijiao_contents` VALUES (754, 'bb0201032503003', '词语搭配', '', 1, 1, 1, 0, 112, 22, 1, NULL, NULL, 'uploads/contents/754019031920403308178nr', 0, '2019-03-19 18:24:11', '2019-03-19 20:40:33');
INSERT INTO `tbl_huijiao_contents` VALUES (755, 'bb0201031402006', '华', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918242404245nr', 0, '2019-03-19 18:24:24', '2019-03-19 18:24:24');
INSERT INTO `tbl_huijiao_contents` VALUES (756, 'bb0201031402007', '展', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/756019032117195202013nr', 0, '2019-03-19 18:24:46', '2019-03-21 17:19:52');
INSERT INTO `tbl_huijiao_contents` VALUES (757, 'bb0201032603001', '重难点词语', '', 1, 1, 1, 0, 113, 22, 1, NULL, NULL, 'uploads/contents/757019031920404903619nr', 0, '2019-03-19 18:24:59', '2019-03-19 20:40:49');
INSERT INTO `tbl_huijiao_contents` VALUES (758, 'bb0201031402008', '现', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918251202510nr', 0, '2019-03-19 18:25:12', '2019-03-19 18:25:12');
INSERT INTO `tbl_huijiao_contents` VALUES (759, 'bb0201032603002', '近反义词', '', 1, 1, 1, 0, 113, 22, 1, NULL, NULL, 'uploads/contents/759019031920411004646nr', 0, '2019-03-19 18:25:21', '2019-03-19 20:41:10');
INSERT INTO `tbl_huijiao_contents` VALUES (760, 'bb0201032603003', '词语搭配', '', 1, 1, 1, 0, 113, 22, 1, NULL, NULL, 'uploads/contents/760019031920412201480nr', 0, '2019-03-19 18:25:52', '2019-03-19 20:41:22');
INSERT INTO `tbl_huijiao_contents` VALUES (761, 'bb0201031402009', '披', '', 1, 1, 1, 0, 100, 12, 1, NULL, NULL, 'uploads/contents/0019031918261203436nr', 0, '2019-03-19 18:26:12', '2019-03-19 18:26:12');
INSERT INTO `tbl_huijiao_contents` VALUES (762, 'bb0201031502001', '份', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918264004441nr', 0, '2019-03-19 18:26:40', '2019-03-19 18:26:40');
INSERT INTO `tbl_huijiao_contents` VALUES (763, 'bb0201032703001', '重难点词语', '', 1, 1, 1, 0, 115, 22, 1, NULL, NULL, 'uploads/contents/763019031920413507874nr', 0, '2019-03-19 18:26:41', '2019-03-19 20:41:35');
INSERT INTO `tbl_huijiao_contents` VALUES (764, 'bb0201032703002', '近反义词', '', 1, 1, 1, 0, 115, 22, 1, NULL, NULL, 'uploads/contents/764019031920414601239nr', 0, '2019-03-19 18:27:16', '2019-03-19 20:41:46');
INSERT INTO `tbl_huijiao_contents` VALUES (765, 'bb0201031502002', '坡', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918272001294nr', 0, '2019-03-19 18:27:20', '2019-03-19 18:27:20');
INSERT INTO `tbl_huijiao_contents` VALUES (766, 'bb0201032703003', '词语搭配', '', 1, 1, 1, 0, 115, 22, 1, NULL, NULL, 'uploads/contents/766019031920420107321nr', 0, '2019-03-19 18:27:41', '2019-03-19 20:42:01');
INSERT INTO `tbl_huijiao_contents` VALUES (767, 'bb0201031502003', '枝', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918274202280nr', 0, '2019-03-19 18:27:42', '2019-03-19 18:27:42');
INSERT INTO `tbl_huijiao_contents` VALUES (768, 'bb0201031502004', '起', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918280501371nr', 0, '2019-03-19 18:28:05', '2019-03-19 18:28:05');
INSERT INTO `tbl_huijiao_contents` VALUES (769, 'bb0201032803001', '重难点词语', '', 1, 1, 1, 0, 116, 22, 1, NULL, NULL, 'uploads/contents/769019031920421302891nr', 0, '2019-03-19 18:28:24', '2019-03-19 20:42:13');
INSERT INTO `tbl_huijiao_contents` VALUES (770, 'bb0201031502005', '客', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918282704614nr', 0, '2019-03-19 18:28:27', '2019-03-19 18:28:27');
INSERT INTO `tbl_huijiao_contents` VALUES (771, 'bb0201031502006', '老', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918284506879nr', 0, '2019-03-19 18:28:45', '2019-03-19 18:28:45');
INSERT INTO `tbl_huijiao_contents` VALUES (772, 'bb0201032803002', '近反义词', '', 1, 1, 1, 0, 116, 22, 1, NULL, NULL, 'uploads/contents/772019031920422309061nr', 0, '2019-03-19 18:28:50', '2019-03-19 20:42:23');
INSERT INTO `tbl_huijiao_contents` VALUES (773, 'bb0201031502007', '收', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/773019032117211104744nr', 0, '2019-03-19 18:29:06', '2019-03-21 17:21:11');
INSERT INTO `tbl_huijiao_contents` VALUES (774, 'bb0201032803003', '词语搭配', '', 1, 1, 1, 0, 116, 22, 1, NULL, NULL, 'uploads/contents/774019031920423204848nr', 0, '2019-03-19 18:29:23', '2019-03-19 20:42:32');
INSERT INTO `tbl_huijiao_contents` VALUES (775, 'bb0201031502008', '城', '', 1, 1, 1, 0, 101, 12, 0, NULL, NULL, 'uploads/contents/0019031918292901708nr', 0, '2019-03-19 18:29:29', '2019-03-19 18:30:29');
INSERT INTO `tbl_huijiao_contents` VALUES (776, 'bb0201031502009', '市', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918294907014nr', 0, '2019-03-19 18:29:49', '2019-03-19 18:29:49');
INSERT INTO `tbl_huijiao_contents` VALUES (777, 'bb0201031502010', '利', '', 1, 1, 1, 0, 101, 12, 1, NULL, NULL, 'uploads/contents/0019031918301002645nr', 0, '2019-03-19 18:30:10', '2019-03-19 18:30:10');
INSERT INTO `tbl_huijiao_contents` VALUES (778, 'bb0201031602001', '井', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918310501763nr', 0, '2019-03-19 18:31:05', '2019-03-19 18:31:05');
INSERT INTO `tbl_huijiao_contents` VALUES (779, 'bb0201031602002', '观', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918313009508nr', 0, '2019-03-19 18:31:30', '2019-03-19 18:31:30');
INSERT INTO `tbl_huijiao_contents` VALUES (780, 'bb0201031602003', '沿', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918315008159nr', 0, '2019-03-19 18:31:50', '2019-03-19 18:31:50');
INSERT INTO `tbl_huijiao_contents` VALUES (781, 'bb0201031602004', '答', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918323307939nr', 0, '2019-03-19 18:32:33', '2019-03-19 18:32:33');
INSERT INTO `tbl_huijiao_contents` VALUES (782, 'bb0201031602005', '渴', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918325603599nr', 0, '2019-03-19 18:32:56', '2019-03-19 18:32:56');
INSERT INTO `tbl_huijiao_contents` VALUES (783, 'bb0201031602006', '喝', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918334204326nr', 0, '2019-03-19 18:33:42', '2019-03-19 18:33:42');
INSERT INTO `tbl_huijiao_contents` VALUES (784, 'bb0201031602007', '话', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/784019032117213102734nr', 0, '2019-03-19 18:34:01', '2019-03-21 17:21:31');
INSERT INTO `tbl_huijiao_contents` VALUES (785, 'bb0201031602008', '际', '', 1, 1, 1, 0, 102, 12, 1, NULL, NULL, 'uploads/contents/0019031918342008453nr', 0, '2019-03-19 18:34:20', '2019-03-19 18:34:20');
INSERT INTO `tbl_huijiao_contents` VALUES (786, 'bb0201031702001', '面', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918344902398nr', 0, '2019-03-19 18:34:49', '2019-03-19 18:34:49');
INSERT INTO `tbl_huijiao_contents` VALUES (787, 'bb0201031702002', '阵', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918350803117nr', 0, '2019-03-19 18:35:08', '2019-03-19 18:35:08');
INSERT INTO `tbl_huijiao_contents` VALUES (788, 'bb0201031702003', '朗', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918352501909nr', 0, '2019-03-19 18:35:25', '2019-03-19 18:35:25');
INSERT INTO `tbl_huijiao_contents` VALUES (789, 'bb0201031702004', '枯', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918355203872nr', 0, '2019-03-19 18:35:52', '2019-03-19 18:35:52');
INSERT INTO `tbl_huijiao_contents` VALUES (790, 'bb0201031702005', '却', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918361703546nr', 0, '2019-03-19 18:36:18', '2019-03-19 18:36:18');
INSERT INTO `tbl_huijiao_contents` VALUES (791, 'bb0201031702006', '将', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918363706259nr', 0, '2019-03-19 18:36:37', '2019-03-19 18:36:37');
INSERT INTO `tbl_huijiao_contents` VALUES (792, 'bb0201031702007', '纷', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/792019032117230701435nr', 0, '2019-03-19 18:36:57', '2019-03-21 17:23:07');
INSERT INTO `tbl_huijiao_contents` VALUES (793, 'bb0201031702008', '夜', '', 1, 1, 1, 0, 103, 12, 1, NULL, NULL, 'uploads/contents/0019031918371909350nr', 0, '2019-03-19 18:37:19', '2019-03-19 18:37:19');
INSERT INTO `tbl_huijiao_contents` VALUES (794, 'bb0201031802001', '棵', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918374703550nr', 0, '2019-03-19 18:37:47', '2019-03-19 18:37:47');
INSERT INTO `tbl_huijiao_contents` VALUES (795, 'bb0201031802002', '谢', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918381103245nr', 0, '2019-03-19 18:38:11', '2019-03-19 18:38:11');
INSERT INTO `tbl_huijiao_contents` VALUES (796, 'bb0201031802003', '想', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918382803555nr', 0, '2019-03-19 18:38:28', '2019-03-19 18:38:28');
INSERT INTO `tbl_huijiao_contents` VALUES (797, 'bb0201031802004', '盯', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918390706071nr', 0, '2019-03-19 18:39:07', '2019-03-19 18:39:07');
INSERT INTO `tbl_huijiao_contents` VALUES (798, 'bb0201031802005', '言', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918393406043nr', 0, '2019-03-19 18:39:34', '2019-03-19 18:39:34');
INSERT INTO `tbl_huijiao_contents` VALUES (799, 'bb0201031802006', '邻', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918395706475nr', 0, '2019-03-19 18:39:57', '2019-03-19 18:39:57');
INSERT INTO `tbl_huijiao_contents` VALUES (800, 'bb0201031802007', '治', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/800019032117304809197nr', 0, '2019-03-19 18:40:16', '2019-03-21 17:30:48');
INSERT INTO `tbl_huijiao_contents` VALUES (801, 'bb0201031802008', '怪', '', 1, 1, 1, 0, 104, 12, 1, NULL, NULL, 'uploads/contents/0019031918404103891nr', 0, '2019-03-19 18:40:41', '2019-03-19 18:40:41');
INSERT INTO `tbl_huijiao_contents` VALUES (802, 'bb0201031902001', '洪', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918414002359nr', 0, '2019-03-19 18:41:40', '2019-03-19 18:41:40');
INSERT INTO `tbl_huijiao_contents` VALUES (803, 'bb0201031902002', '灾', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918420505500nr', 0, '2019-03-19 18:42:05', '2019-03-19 18:42:05');
INSERT INTO `tbl_huijiao_contents` VALUES (804, 'bb0201031902003', '难', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918422501487nr', 0, '2019-03-19 18:42:25', '2019-03-19 18:42:25');
INSERT INTO `tbl_huijiao_contents` VALUES (805, 'bb0201031902004', '道', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918455104492nr', 0, '2019-03-19 18:45:51', '2019-03-19 18:45:51');
INSERT INTO `tbl_huijiao_contents` VALUES (806, 'bb0201031902005', '认', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918463207090nr', 0, '2019-03-19 18:46:32', '2019-03-19 18:46:32');
INSERT INTO `tbl_huijiao_contents` VALUES (807, 'bb0201031902006', '被', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918465105385nr', 0, '2019-03-19 18:46:51', '2019-03-19 18:46:51');
INSERT INTO `tbl_huijiao_contents` VALUES (808, 'bb0201031902007', '业', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/808019032117310406225nr', 0, '2019-03-19 18:47:21', '2019-03-21 17:31:04');
INSERT INTO `tbl_huijiao_contents` VALUES (809, 'bb0201031902008', '产', '', 1, 1, 1, 0, 105, 12, 1, NULL, NULL, 'uploads/contents/0019031918474501381nr', 0, '2019-03-19 18:47:45', '2019-03-19 18:47:45');
INSERT INTO `tbl_huijiao_contents` VALUES (810, 'bb0201032002001', '扁', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918480907050nr', 0, '2019-03-19 18:48:09', '2019-03-19 18:48:09');
INSERT INTO `tbl_huijiao_contents` VALUES (811, 'bb0201032002002', '担', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918484005828nr', 0, '2019-03-19 18:48:40', '2019-03-19 18:48:40');
INSERT INTO `tbl_huijiao_contents` VALUES (812, 'bb0201032002003', '志', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918490402832nr', 0, '2019-03-19 18:49:04', '2019-03-19 18:49:04');
INSERT INTO `tbl_huijiao_contents` VALUES (813, 'bb0201032002004', '伍', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918493305407nr', 0, '2019-03-19 18:49:33', '2019-03-19 18:49:33');
INSERT INTO `tbl_huijiao_contents` VALUES (814, 'bb0201032002005', '师', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918495709152nr', 0, '2019-03-19 18:49:58', '2019-03-19 18:49:58');
INSERT INTO `tbl_huijiao_contents` VALUES (815, 'bb0201032002006', '军', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918502009378nr', 0, '2019-03-19 18:50:20', '2019-03-19 18:50:20');
INSERT INTO `tbl_huijiao_contents` VALUES (816, 'bb0201032002007', '战', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/816019032117312209062nr', 0, '2019-03-19 18:50:54', '2019-03-21 17:31:22');
INSERT INTO `tbl_huijiao_contents` VALUES (817, 'bb0201032002008', '士', '', 1, 1, 1, 0, 106, 12, 1, NULL, NULL, 'uploads/contents/0019031918511509973nr', 0, '2019-03-19 18:51:15', '2019-03-19 18:51:15');
INSERT INTO `tbl_huijiao_contents` VALUES (818, 'bb0201032102001', '忘', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031918514206623nr', 0, '2019-03-19 18:51:42', '2019-03-19 18:51:42');
INSERT INTO `tbl_huijiao_contents` VALUES (819, 'bb0201032102002', '泼', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031918520309812nr', 0, '2019-03-19 18:52:03', '2019-03-19 18:52:03');
INSERT INTO `tbl_huijiao_contents` VALUES (820, 'bb0201032102003', '度', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031918523902216nr', 0, '2019-03-19 18:52:39', '2019-03-19 18:52:39');
INSERT INTO `tbl_huijiao_contents` VALUES (821, 'bb0201032102004', '龙', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031919103504274nr', 0, '2019-03-19 19:10:35', '2019-03-19 19:10:35');
INSERT INTO `tbl_huijiao_contents` VALUES (822, 'bb0201032102005', '炮', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031919110904847nr', 0, '2019-03-19 19:11:09', '2019-03-19 19:11:09');
INSERT INTO `tbl_huijiao_contents` VALUES (823, 'bb0201032102006', '穿', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031919113601460nr', 0, '2019-03-19 19:11:36', '2019-03-19 19:11:36');
INSERT INTO `tbl_huijiao_contents` VALUES (824, 'bb0201032102007', '向', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/824019032117313905201nr', 0, '2019-03-19 19:11:56', '2019-03-21 17:31:39');
INSERT INTO `tbl_huijiao_contents` VALUES (825, 'bb0201032102008', '令', '', 1, 1, 1, 0, 107, 12, 1, NULL, NULL, 'uploads/contents/0019031919122004642nr', 0, '2019-03-19 19:12:20', '2019-03-19 19:12:20');
INSERT INTO `tbl_huijiao_contents` VALUES (826, 'bb0201032202001', '危', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/0019031919141402753nr', 0, '2019-03-19 19:14:14', '2019-03-19 19:14:14');
INSERT INTO `tbl_huijiao_contents` VALUES (827, 'bb0201032202002', '敢', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/0019031919143704004nr', 0, '2019-03-19 19:14:37', '2019-03-19 19:14:37');
INSERT INTO `tbl_huijiao_contents` VALUES (828, 'bb0201032202003', '惊', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/828019031919151904846nr', 0, '2019-03-19 19:14:48', '2019-03-19 19:15:19');
INSERT INTO `tbl_huijiao_contents` VALUES (829, 'bb0201032202004', '阴', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/0019031919155608829nr', 0, '2019-03-19 19:15:56', '2019-03-19 19:15:56');
INSERT INTO `tbl_huijiao_contents` VALUES (830, 'bb0201032202005', '似', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/0019031919164307060nr', 0, '2019-03-19 19:16:43', '2019-03-19 19:16:43');
INSERT INTO `tbl_huijiao_contents` VALUES (831, 'bb0201032202006', '野', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/0019031919170508815nr', 0, '2019-03-19 19:17:05', '2019-03-19 19:17:05');
INSERT INTO `tbl_huijiao_contents` VALUES (832, 'bb0201032202007', '苍', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/832019032117315708467nr', 0, '2019-03-19 19:17:25', '2019-03-21 17:31:57');
INSERT INTO `tbl_huijiao_contents` VALUES (833, 'bb0201032202008', '茫', '', 1, 1, 1, 0, 108, 12, 1, NULL, NULL, 'uploads/contents/0019031919174709715nr', 0, '2019-03-19 19:17:47', '2019-03-19 19:17:47');
INSERT INTO `tbl_huijiao_contents` VALUES (834, 'bb0201032302001', '于', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919183509750nr', 0, '2019-03-19 19:18:35', '2019-03-19 19:18:35');
INSERT INTO `tbl_huijiao_contents` VALUES (835, 'bb0201032302002', '论', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919190108553nr', 0, '2019-03-19 19:19:01', '2019-03-19 19:19:01');
INSERT INTO `tbl_huijiao_contents` VALUES (836, 'bb0201032302003', '岸', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919194502995nr', 0, '2019-03-19 19:19:45', '2019-03-19 19:19:45');
INSERT INTO `tbl_huijiao_contents` VALUES (837, 'bb0201032302004', '屋', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919201108279nr', 0, '2019-03-19 19:20:11', '2019-03-19 19:20:11');
INSERT INTO `tbl_huijiao_contents` VALUES (838, 'bb0201032302005', '切', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919203301500nr', 0, '2019-03-19 19:20:33', '2019-03-19 19:20:33');
INSERT INTO `tbl_huijiao_contents` VALUES (839, 'bb0201032302006', '久', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919205205340nr', 0, '2019-03-19 19:20:52', '2019-03-19 19:20:52');
INSERT INTO `tbl_huijiao_contents` VALUES (840, 'rj0304040103001', '力', '', 1, 0, 0, 0, 119, 16, 0, NULL, NULL, 'uploads/contents/0019031919211102898nr.doc', 0, '2019-03-19 19:21:11', '2019-03-20 11:09:10');
INSERT INTO `tbl_huijiao_contents` VALUES (841, 'bb0201032302007', '散', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/841019032117321301808nr', 0, '2019-03-19 19:21:12', '2019-03-21 17:32:13');
INSERT INTO `tbl_huijiao_contents` VALUES (842, 'bb0201032302008', '步', '', 1, 1, 1, 0, 109, 12, 1, NULL, NULL, 'uploads/contents/0019031919213707608nr', 0, '2019-03-19 19:21:37', '2019-03-19 19:21:37');
INSERT INTO `tbl_huijiao_contents` VALUES (843, 'rj0304040203001', '弹力', '', 1, 0, 0, 0, 120, 16, 0, NULL, NULL, 'uploads/contents/0019031919214704654nr.doc', 0, '2019-03-19 19:21:47', '2019-03-20 11:09:13');
INSERT INTO `tbl_huijiao_contents` VALUES (844, 'bb0201032402001', '唱', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919221501974nr', 0, '2019-03-19 19:22:15', '2019-03-19 19:22:15');
INSERT INTO `tbl_huijiao_contents` VALUES (845, 'rj0304040303001', '重力', '', 1, 0, 0, 0, 121, 16, 0, NULL, NULL, 'uploads/contents/0019031919221607288nr.doc', 0, '2019-03-19 19:22:16', '2019-03-20 11:09:16');
INSERT INTO `tbl_huijiao_contents` VALUES (846, 'bb0201032402002', '赶', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919224203400nr', 0, '2019-03-19 19:22:42', '2019-03-19 19:22:42');
INSERT INTO `tbl_huijiao_contents` VALUES (847, 'rj0304040403001', '牛顿第一定律', '', 0, 1, 0, 0, 122, 16, 4, NULL, NULL, 'uploads/contents/0019031919225801979nr.doc', 0, '2019-03-19 19:22:58', '2019-03-19 19:22:58');
INSERT INTO `tbl_huijiao_contents` VALUES (848, 'bb0201032402003', '旺', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919230709182nr', 0, '2019-03-19 19:23:07', '2019-03-19 19:23:07');
INSERT INTO `tbl_huijiao_contents` VALUES (849, 'rj0304040503001', '二力平衡', '', 1, 0, 0, 0, 123, 16, 0, NULL, NULL, 'uploads/contents/0019031919232203165nr.doc', 0, '2019-03-19 19:23:22', '2019-03-20 11:09:22');
INSERT INTO `tbl_huijiao_contents` VALUES (850, 'bb0201032402004', '旁', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919233202051nr', 0, '2019-03-19 19:23:32', '2019-03-19 19:23:32');
INSERT INTO `tbl_huijiao_contents` VALUES (851, 'rj0304040603001', '摩擦力', '', 0, 1, 0, 0, 124, 16, 4, NULL, NULL, 'uploads/contents/0019031919235004284nr.doc', 0, '2019-03-19 19:23:50', '2019-03-19 19:23:50');
INSERT INTO `tbl_huijiao_contents` VALUES (852, 'bb0201032402005', '浑', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919235502807nr', 0, '2019-03-19 19:23:55', '2019-03-19 19:23:55');
INSERT INTO `tbl_huijiao_contents` VALUES (853, 'rj0304040703001', '压强', '', 1, 0, 0, 0, 125, 16, 0, NULL, NULL, 'uploads/contents/0019031919241003886nr.doc', 0, '2019-03-19 19:24:10', '2019-03-20 11:09:47');
INSERT INTO `tbl_huijiao_contents` VALUES (854, 'bb0201032402006', '谁', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919241609339nr', 0, '2019-03-19 19:24:16', '2019-03-19 19:24:16');
INSERT INTO `tbl_huijiao_contents` VALUES (855, 'bb0201032402007', '轻', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/855019032117323101034nr', 0, '2019-03-19 19:24:34', '2019-03-21 17:32:31');
INSERT INTO `tbl_huijiao_contents` VALUES (856, 'rj0304040803001', '液体的压强', '', 1, 0, 0, 0, 126, 16, 0, NULL, NULL, 'uploads/contents/0019031919244302774nr.doc', 0, '2019-03-19 19:24:43', '2019-03-20 11:09:53');
INSERT INTO `tbl_huijiao_contents` VALUES (857, 'bb0201032402008', '汽', '', 1, 1, 1, 0, 110, 12, 1, NULL, NULL, 'uploads/contents/0019031919245307884nr', 0, '2019-03-19 19:24:53', '2019-03-19 19:24:53');
INSERT INTO `tbl_huijiao_contents` VALUES (858, 'rj0304040903001', '大气压强', '', 1, 0, 0, 0, 127, 16, 0, NULL, NULL, 'uploads/contents/0019031919251307182nr.doc', 0, '2019-03-19 19:25:13', '2019-03-20 11:10:00');
INSERT INTO `tbl_huijiao_contents` VALUES (859, 'bb0201032502001', '食', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919252002877nr', 0, '2019-03-19 19:25:20', '2019-03-19 19:25:20');
INSERT INTO `tbl_huijiao_contents` VALUES (860, 'bb0201032502002', '物', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919254304112nr', 0, '2019-03-19 19:25:43', '2019-03-19 19:25:43');
INSERT INTO `tbl_huijiao_contents` VALUES (861, 'rj0304041003001', '流体压强与流速的关系', '', 1, 0, 0, 0, 128, 16, 0, NULL, NULL, 'uploads/contents/0019031919254708701nr.doc', 0, '2019-03-19 19:25:47', '2019-03-20 11:10:05');
INSERT INTO `tbl_huijiao_contents` VALUES (862, 'bb0201032502003', '爷', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919260804140nr', 0, '2019-03-19 19:26:08', '2019-03-19 19:26:08');
INSERT INTO `tbl_huijiao_contents` VALUES (863, 'rj0304041103001', '浮力', '', 1, 0, 0, 0, 129, 16, 0, NULL, NULL, 'uploads/contents/0019031919261707873nr.doc', 0, '2019-03-19 19:26:17', '2019-03-20 11:10:45');
INSERT INTO `tbl_huijiao_contents` VALUES (864, 'bb0201032502004', '就', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919263608387nr', 0, '2019-03-19 19:26:36', '2019-03-19 19:26:36');
INSERT INTO `tbl_huijiao_contents` VALUES (865, 'rj0304041203001', '阿基米德原理', '', 1, 0, 0, 0, 130, 16, 0, NULL, NULL, 'uploads/contents/0019031919264506558nr.doc', 0, '2019-03-19 19:26:45', '2019-03-20 11:10:50');
INSERT INTO `tbl_huijiao_contents` VALUES (866, 'bb0201032502005', '爪', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919270207513nr', 0, '2019-03-19 19:27:02', '2019-03-19 19:27:02');
INSERT INTO `tbl_huijiao_contents` VALUES (867, 'rj0304041303001', '物体的浮沉条件及应用', '', 1, 0, 0, 0, 131, 16, 0, NULL, NULL, 'uploads/contents/0019031919270708682nr.doc', 0, '2019-03-19 19:27:07', '2019-03-20 11:10:53');
INSERT INTO `tbl_huijiao_contents` VALUES (868, 'rj0304041403001', '功', '', 1, 0, 0, 0, 132, 16, 0, NULL, NULL, 'uploads/contents/0019031919280507039nr.doc', 0, '2019-03-19 19:28:05', '2019-03-20 11:10:56');
INSERT INTO `tbl_huijiao_contents` VALUES (869, 'bb0201032502006', '神', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919285207911nr', 0, '2019-03-19 19:28:52', '2019-03-19 19:28:52');
INSERT INTO `tbl_huijiao_contents` VALUES (870, 'rj0304041503001', '功率', '', 1, 0, 0, 0, 133, 16, 0, NULL, NULL, 'uploads/contents/0019031919285405947nr.doc', 0, '2019-03-19 19:28:54', '2019-03-20 11:11:02');
INSERT INTO `tbl_huijiao_contents` VALUES (871, 'bb0201032502007', '活', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/871019032117324804178nr', 0, '2019-03-19 19:29:11', '2019-03-21 17:32:48');
INSERT INTO `tbl_huijiao_contents` VALUES (872, 'rj0304041603001', '动能和势能', '', 1, 0, 0, 0, 134, 16, 0, NULL, NULL, 'uploads/contents/0019031919293304386nr.doc', 0, '2019-03-19 19:29:33', '2019-03-20 11:11:08');
INSERT INTO `tbl_huijiao_contents` VALUES (873, 'bb0201032502008', '猪', '', 1, 1, 1, 0, 112, 12, 1, NULL, NULL, 'uploads/contents/0019031919293603260nr', 0, '2019-03-19 19:29:36', '2019-03-19 19:29:36');
INSERT INTO `tbl_huijiao_contents` VALUES (874, 'bb0201032602001', '奶', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919300909890nr', 0, '2019-03-19 19:30:09', '2019-03-19 19:30:09');
INSERT INTO `tbl_huijiao_contents` VALUES (875, 'rj0304041703001', '机械能及其转化', '', 1, 0, 0, 0, 135, 16, 0, NULL, NULL, 'uploads/contents/0019031919302706640nr.doc', 0, '2019-03-19 19:30:27', '2019-03-20 11:11:13');
INSERT INTO `tbl_huijiao_contents` VALUES (876, 'bb0201032602002', '始', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919303309347nr', 0, '2019-03-19 19:30:33', '2019-03-19 19:30:33');
INSERT INTO `tbl_huijiao_contents` VALUES (877, 'bb0201032602003', '吵', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919305303442nr', 0, '2019-03-19 19:30:53', '2019-03-19 19:30:53');
INSERT INTO `tbl_huijiao_contents` VALUES (878, 'rj0304041803001', '杠杆', '', 1, 0, 0, 0, 136, 16, 0, NULL, NULL, 'uploads/contents/0019031919310501101nr.doc', 0, '2019-03-19 19:31:05', '2019-03-20 11:11:17');
INSERT INTO `tbl_huijiao_contents` VALUES (879, 'bb0201032602004', '仔', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919312406190nr', 0, '2019-03-19 19:31:24', '2019-03-19 19:31:24');
INSERT INTO `tbl_huijiao_contents` VALUES (880, 'rj0304041903001', '滑轮', '', 1, 0, 0, 0, 137, 16, 0, NULL, NULL, 'uploads/contents/0019031919313703539nr.doc', 0, '2019-03-19 19:31:37', '2019-03-20 11:11:22');
INSERT INTO `tbl_huijiao_contents` VALUES (881, 'bb0201032602005', '急', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919314802925nr', 0, '2019-03-19 19:31:48', '2019-03-19 19:31:48');
INSERT INTO `tbl_huijiao_contents` VALUES (882, 'rj0304042003001', '机械效率', '', 1, 0, 0, 0, 138, 16, 0, NULL, NULL, 'uploads/contents/0019031919320304906nr.doc', 0, '2019-03-19 19:32:03', '2019-03-20 11:11:27');
INSERT INTO `tbl_huijiao_contents` VALUES (883, 'bb0201032602006', '咬', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919320806862nr', 0, '2019-03-19 19:32:09', '2019-03-19 19:32:09');
INSERT INTO `tbl_huijiao_contents` VALUES (884, 'bb0201032602007', '第', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/884019032117330705109nr', 0, '2019-03-19 19:34:12', '2019-03-21 17:33:07');
INSERT INTO `tbl_huijiao_contents` VALUES (885, 'bb0201032602008', '公', '', 1, 1, 1, 0, 113, 12, 1, NULL, NULL, 'uploads/contents/0019031919343403273nr', 0, '2019-03-19 19:34:34', '2019-03-19 19:34:34');
INSERT INTO `tbl_huijiao_contents` VALUES (886, 'bb0201032702001', '纸', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919350707458nr', 0, '2019-03-19 19:35:07', '2019-03-19 19:35:07');
INSERT INTO `tbl_huijiao_contents` VALUES (887, 'bb0201032702002', '折', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919352908708nr', 0, '2019-03-19 19:35:29', '2019-03-19 19:35:29');
INSERT INTO `tbl_huijiao_contents` VALUES (888, 'bb0201032702003', '张', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919362509264nr', 0, '2019-03-19 19:36:25', '2019-03-19 19:36:25');
INSERT INTO `tbl_huijiao_contents` VALUES (889, 'bb0201032702004', '祝', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919381401458nr', 0, '2019-03-19 19:38:14', '2019-03-19 19:38:14');
INSERT INTO `tbl_huijiao_contents` VALUES (890, 'bb0201032702005', '扎', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919384103661nr', 0, '2019-03-19 19:38:41', '2019-03-19 19:38:41');
INSERT INTO `tbl_huijiao_contents` VALUES (891, 'bb0201032702006', '抓', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919392203825nr', 0, '2019-03-19 19:39:22', '2019-03-19 19:39:22');
INSERT INTO `tbl_huijiao_contents` VALUES (892, 'bb0201032702007', '但', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/892019032117332409073nr', 0, '2019-03-19 19:39:54', '2019-03-21 17:33:24');
INSERT INTO `tbl_huijiao_contents` VALUES (893, 'bb0201032702008', '哭', '', 1, 1, 1, 0, 115, 12, 1, NULL, NULL, 'uploads/contents/0019031919402706339nr', 0, '2019-03-19 19:40:27', '2019-03-19 19:40:27');
INSERT INTO `tbl_huijiao_contents` VALUES (894, 'bb0201032802001', '车', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/0019031919410605478nr', 0, '2019-03-19 19:41:06', '2019-03-19 19:41:06');
INSERT INTO `tbl_huijiao_contents` VALUES (895, 'bb0201032802002', '得', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/0019031919412902684nr', 0, '2019-03-19 19:41:29', '2019-03-19 19:41:29');
INSERT INTO `tbl_huijiao_contents` VALUES (896, 'bb0201032802003', '秧', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/0019031919415305822nr', 0, '2019-03-19 19:41:53', '2019-03-19 19:41:53');
INSERT INTO `tbl_huijiao_contents` VALUES (897, 'bb0201032802004', '苗', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/0019031919422401757nr', 0, '2019-03-19 19:42:24', '2019-03-19 19:42:24');
INSERT INTO `tbl_huijiao_contents` VALUES (898, 'bb0201032802005', '汗', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/0019031919424808571nr', 0, '2019-03-19 19:42:48', '2019-03-19 19:42:48');
INSERT INTO `tbl_huijiao_contents` VALUES (899, 'bb0201032802006', '场', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/0019031919430709998nr', 0, '2019-03-19 19:43:07', '2019-03-19 19:43:07');
INSERT INTO `tbl_huijiao_contents` VALUES (900, 'bb0201032802007', '伤', '', 1, 1, 1, 0, 116, 12, 1, NULL, NULL, 'uploads/contents/900019032117334103980nr', 0, '2019-03-19 19:43:32', '2019-03-21 17:33:41');
INSERT INTO `tbl_huijiao_contents` VALUES (901, 'bb0201032802008', '路', '', 1, 1, 1, 0, 116, 12, 0, NULL, NULL, 'uploads/contents/0019031919435409816nr', 0, '2019-03-19 19:43:54', '2019-03-21 17:39:50');
INSERT INTO `tbl_huijiao_contents` VALUES (903, 'rj0304040405001', '牛顿第一定律', 'uploads/contents/0019031920182902193fj.doc', 1, 1, 1, 0, 181, 24, 0, NULL, NULL, 'uploads/contents/0019031920182902193nr.doc', 0, '2019-03-19 20:18:29', '2019-03-20 11:20:35');
INSERT INTO `tbl_huijiao_contents` VALUES (904, 'rj0304040402001', '牛顿第一定律', '', 1, 0, 0, 0, 181, 19, 0, NULL, NULL, 'uploads/contents/0019031920213507224nr.pptx', 0, '2019-03-19 20:21:35', '2019-03-20 11:13:22');
INSERT INTO `tbl_huijiao_contents` VALUES (905, 'rj0304040602001', '摩擦力', '', 1, 0, 0, 0, 207, 19, 0, NULL, NULL, 'uploads/contents/0019031920310001581nr.ppt', 0, '2019-03-19 20:31:00', '2019-03-20 11:13:39');
INSERT INTO `tbl_huijiao_contents` VALUES (908, 'rj0304040607001', '摩擦力', 'uploads/contents/908019031920373201206fj.docx', 1, 1, 1, 0, 207, 25, 0, NULL, NULL, 'uploads/contents/0019031920343507754nr.docx', 0, '2019-03-19 20:34:35', '2019-03-20 11:31:23');
INSERT INTO `tbl_huijiao_contents` VALUES (909, 'rj0304040607003', '摩擦力', 'uploads/contents/909019031920374605698fj.doc', 1, 1, 1, 0, 207, 25, 0, NULL, NULL, 'uploads/contents/0019031920354405117nr.doc', 0, '2019-03-19 20:35:44', '2019-03-20 11:31:31');
INSERT INTO `tbl_huijiao_contents` VALUES (910, 'rj0304040607005', '摩擦力', 'uploads/contents/910019031920380405428fj.doc', 1, 1, 1, 0, 207, 25, 0, NULL, NULL, 'uploads/contents/0019031920362509006nr.doc', 0, '2019-03-19 20:36:25', '2019-03-20 11:31:37');
INSERT INTO `tbl_huijiao_contents` VALUES (911, 'bsd0302020101001', '同底数幂的乘法', '', 1, 1, 1, 0, 65, 20, 2, NULL, NULL, 'uploads/contents/0019032009220102159nr.mp4', 0, '2019-03-20 09:22:01', '2019-03-20 09:22:01');
INSERT INTO `tbl_huijiao_contents` VALUES (912, 'bsd0302020201001', '幂的乘方与积的乘方', '', 1, 1, 1, 0, 66, 20, 2, NULL, NULL, 'uploads/contents/0019032009301302876nr.mp4', 0, '2019-03-20 09:30:14', '2019-03-20 09:30:14');
INSERT INTO `tbl_huijiao_contents` VALUES (913, 'bsd0302020201002', '幂的乘方与积的乘方', '', 1, 1, 1, 0, 66, 20, 2, NULL, NULL, 'uploads/contents/0019032009371007904nr.mp4', 0, '2019-03-20 09:37:10', '2019-03-20 09:37:10');
INSERT INTO `tbl_huijiao_contents` VALUES (914, 'bsd0302020301001', '同底数幂的除法', '', 1, 1, 1, 0, 67, 20, 2, NULL, NULL, 'uploads/contents/0019032009425405860nr.mp4', 0, '2019-03-20 09:42:54', '2019-03-20 09:42:54');
INSERT INTO `tbl_huijiao_contents` VALUES (915, 'bsd0302020401001', '整式的乘法', '', 1, 1, 1, 0, 68, 20, 2, NULL, NULL, 'uploads/contents/0019032009484502746nr.mp4', 0, '2019-03-20 09:48:45', '2019-03-20 09:48:45');
INSERT INTO `tbl_huijiao_contents` VALUES (916, 'bsd0302020401002', '整式的乘法', '', 1, 1, 1, 0, 68, 20, 2, NULL, NULL, 'uploads/contents/0019032009534104880nr.mp4', 0, '2019-03-20 09:53:42', '2019-03-20 09:53:42');
INSERT INTO `tbl_huijiao_contents` VALUES (917, 'bsd0302020401003', '整式的乘法', '', 1, 1, 1, 0, 68, 20, 2, NULL, NULL, 'uploads/contents/0019032010090701041nr.mp4', 0, '2019-03-20 10:09:07', '2019-03-20 10:09:07');
INSERT INTO `tbl_huijiao_contents` VALUES (918, 'bsd0302020501001', '平方差公式', '', 1, 1, 1, 0, 69, 20, 2, NULL, NULL, 'uploads/contents/0019032010191801355nr.mp4', 0, '2019-03-20 10:19:19', '2019-03-20 10:19:19');
INSERT INTO `tbl_huijiao_contents` VALUES (919, 'bsd0302020601001', '完全平方公式', '', 1, 1, 1, 0, 70, 20, 2, NULL, NULL, 'uploads/contents/0019032010444303769nr.mp4', 0, '2019-03-20 10:44:43', '2019-03-20 10:44:43');
INSERT INTO `tbl_huijiao_contents` VALUES (920, 'bsd0302020701001', '整式的除法', '', 1, 1, 1, 0, 71, 20, 2, NULL, NULL, 'uploads/contents/0019032010530904631nr.mp4', 0, '2019-03-20 10:53:10', '2019-03-20 10:53:10');
INSERT INTO `tbl_huijiao_contents` VALUES (921, 'bsd0302020801001', '两条直线的位置关系', '', 1, 1, 1, 0, 72, 20, 2, NULL, NULL, 'uploads/contents/0019032011515504083nr.mp4', 0, '2019-03-20 11:51:55', '2019-03-20 11:51:55');
INSERT INTO `tbl_huijiao_contents` VALUES (922, 'bsd0302020901001', '探索直线平行的条件', '', 1, 1, 1, 0, 73, 20, 2, NULL, NULL, 'uploads/contents/0019032012003507356nr.mp4', 0, '2019-03-20 12:00:35', '2019-03-20 12:00:35');
INSERT INTO `tbl_huijiao_contents` VALUES (923, 'bsd0302021001001', '平行线的性质', '', 1, 1, 1, 0, 74, 20, 2, NULL, NULL, 'uploads/contents/0019032012495603499nr.mp4', 0, '2019-03-20 12:49:56', '2019-03-20 12:49:56');
INSERT INTO `tbl_huijiao_contents` VALUES (924, 'bsd0302021201001', '认识三角形', '', 1, 1, 1, 0, 76, 20, 2, NULL, NULL, 'uploads/contents/0019032012571502093nr.mp4', 0, '2019-03-20 12:57:15', '2019-03-20 12:57:15');
INSERT INTO `tbl_huijiao_contents` VALUES (925, 'bsd0302021301001', '图形的全等', '', 1, 1, 1, 0, 77, 20, 2, NULL, NULL, 'uploads/contents/0019032013021301089nr.mp4', 0, '2019-03-20 13:02:13', '2019-03-20 13:02:13');
INSERT INTO `tbl_huijiao_contents` VALUES (926, 'bsd0302021401001', '探索三角形全等的条件', '', 1, 1, 1, 0, 78, 20, 2, NULL, NULL, 'uploads/contents/926019032013093509983nr.mp4', 0, '2019-03-20 13:04:42', '2019-03-20 13:09:35');
INSERT INTO `tbl_huijiao_contents` VALUES (927, 'bsd0302021601001', '利用三角形全等测距离', '', 1, 1, 1, 0, 80, 20, 2, NULL, NULL, 'uploads/contents/0019032013231603706nr.mp4', 0, '2019-03-20 13:23:16', '2019-03-20 13:23:16');
INSERT INTO `tbl_huijiao_contents` VALUES (928, 'bsd0302022001001', '轴对称现象', '', 1, 1, 1, 0, 84, 20, 2, NULL, NULL, 'uploads/contents/0019032013311007700nr.mp4', 0, '2019-03-20 13:31:10', '2019-03-20 13:31:10');
INSERT INTO `tbl_huijiao_contents` VALUES (929, 'bsd0302022101001', '探索轴对称的性质', '', 1, 1, 1, 0, 87, 20, 2, NULL, NULL, 'uploads/contents/0019032013500906727nr.mp4', 0, '2019-03-20 13:50:09', '2019-03-20 13:50:09');
INSERT INTO `tbl_huijiao_contents` VALUES (930, 'bsd0302022201001', '简单的轴对称图形', '', 1, 1, 1, 0, 90, 20, 2, NULL, NULL, 'uploads/contents/0019032013564106921nr.mp4', 0, '2019-03-20 13:56:41', '2019-03-20 13:56:41');
INSERT INTO `tbl_huijiao_contents` VALUES (931, 'bsd0302022301001', '利用轴对称进行设计', '', 1, 1, 1, 0, 91, 20, 2, NULL, NULL, 'uploads/contents/0019032014033502221nr.mp4', 0, '2019-03-20 14:03:36', '2019-03-20 14:03:36');
INSERT INTO `tbl_huijiao_contents` VALUES (932, 'bsd0302022401001', '感受可能性', '', 1, 1, 1, 0, 111, 20, 0, NULL, NULL, 'uploads/contents/0019032014084208152nr.mp4', 0, '2019-03-20 14:08:42', '2019-03-20 14:11:23');
INSERT INTO `tbl_huijiao_contents` VALUES (933, 'bsd0302022501001', '频率的稳定性', '', 1, 1, 1, 0, 114, 20, 2, NULL, NULL, 'uploads/contents/0019032014190705704nr.mp4', 0, '2019-03-20 14:19:07', '2019-03-20 14:19:07');
INSERT INTO `tbl_huijiao_contents` VALUES (934, 'bsd0302022601001', '等可能事件的概率', '', 1, 1, 1, 0, 117, 20, 2, NULL, NULL, 'uploads/contents/0019032014255505449nr.mp4', 0, '2019-03-20 14:25:55', '2019-03-20 14:25:55');
INSERT INTO `tbl_huijiao_contents` VALUES (935, 'bsd0302020801002', '两条直线的位置关系', '', 1, 1, 1, 0, 72, 20, 2, NULL, NULL, 'uploads/contents/0019032014325207427nr.mp4', 0, '2019-03-20 14:32:52', '2019-03-20 14:32:52');
INSERT INTO `tbl_huijiao_contents` VALUES (936, 'rj0304040101002', '力（力的相互作用 力的三要素）', 'uploads/contents/102019031910272809321fj.doc', 1, 1, 1, 0, 119, 20, 0, NULL, NULL, 'uploads/contents/936019032015421107082nr.mp4', 0, '2019-03-20 15:35:00', '2019-03-20 19:37:56');
INSERT INTO `tbl_huijiao_contents` VALUES (937, 'rj0304040101001', '力（力的基本概念）', '', 1, 1, 1, 0, 119, 20, 0, NULL, NULL, 'uploads/contents/0019032015350702095nr.mp4', 0, '2019-03-20 15:35:07', '2019-03-20 19:37:46');
INSERT INTO `tbl_huijiao_contents` VALUES (938, 'rj0304040101003', '力（二力的合成）', '', 1, 1, 1, 0, 119, 20, 0, NULL, NULL, 'uploads/contents/938019032019425007823nr.mp4', 0, '2019-03-20 15:37:15', '2019-03-20 19:52:46');
INSERT INTO `tbl_huijiao_contents` VALUES (939, 'rj0304040201001', '弹力', '', 1, 1, 1, 0, 120, 20, 0, NULL, NULL, 'uploads/contents/939019032016302303680nr.mp4', 0, '2019-03-20 15:38:30', '2019-03-20 19:39:00');
INSERT INTO `tbl_huijiao_contents` VALUES (940, 'rj0304040301001', '重力', '', 1, 1, 1, 0, 121, 20, 0, NULL, NULL, 'uploads/contents/940019032017113809976nr.mp4', 0, '2019-03-20 15:38:59', '2019-03-20 19:39:10');
INSERT INTO `tbl_huijiao_contents` VALUES (941, 'rj0304040401001', '牛顿第一定律', '', 1, 1, 1, 0, 181, 20, 0, NULL, NULL, 'uploads/contents/941019032017205901022nr.mp4', 0, '2019-03-20 15:39:52', '2019-03-20 19:39:17');
INSERT INTO `tbl_huijiao_contents` VALUES (942, 'rj0304040401002', '牛顿第一定律（惯性及应用）', '', 1, 1, 1, 0, 181, 20, 0, NULL, NULL, 'uploads/contents/942019032017283506289nr.mp4', 0, '2019-03-20 15:40:22', '2019-03-20 19:39:23');
INSERT INTO `tbl_huijiao_contents` VALUES (943, 'rj0304040501001', '二力平衡', '', 1, 1, 1, 0, 123, 20, 0, NULL, NULL, 'uploads/contents/943019032017292907472nr.mp4', 0, '2019-03-20 15:40:55', '2019-03-20 19:39:30');
INSERT INTO `tbl_huijiao_contents` VALUES (944, 'rj0304040601001', '摩擦力 ', '', 1, 1, 1, 0, 207, 20, 0, NULL, NULL, 'uploads/contents/944019032017363305744nr.mp4', 0, '2019-03-20 15:41:28', '2019-03-20 19:39:38');
INSERT INTO `tbl_huijiao_contents` VALUES (945, 'rj0304040701001', '压强的大小及其计算', '', 1, 1, 1, 0, 125, 20, 0, NULL, NULL, 'uploads/contents/945019032017411004944nr.mp4', 0, '2019-03-20 15:42:18', '2019-03-20 19:39:44');
INSERT INTO `tbl_huijiao_contents` VALUES (946, 'rj0304040801001', '液体内部的压强特点', '', 1, 1, 1, 0, 126, 20, 0, NULL, NULL, 'uploads/contents/946019032017464401741nr.mp4', 0, '2019-03-20 15:52:15', '2019-03-20 19:39:53');
INSERT INTO `tbl_huijiao_contents` VALUES (947, 'rj0304040901001', '大气压强', '', 0, 1, 1, 0, 127, 11, 0, NULL, NULL, NULL, 0, '2019-03-20 15:52:40', '2019-03-20 15:52:40');
INSERT INTO `tbl_huijiao_contents` VALUES (948, 'rj0304040901002', '大气压强（大气压强与生活）', '', 1, 1, 1, 0, 127, 20, 0, NULL, NULL, 'uploads/contents/948019032017471208857nr.mp4', 0, '2019-03-20 15:53:15', '2019-03-20 19:40:01');
INSERT INTO `tbl_huijiao_contents` VALUES (949, 'rj0304041001001', '流体压强与流速的关系', '', 1, 1, 1, 0, 128, 20, 2, NULL, NULL, 'uploads/contents/949019032019442406214nr.mp4', 0, '2019-03-20 15:56:38', '2019-03-20 19:44:24');
INSERT INTO `tbl_huijiao_contents` VALUES (950, 'rj0304041101001', '浮力（浮力及其产生的原因）', '', 1, 1, 1, 0, 129, 20, 0, NULL, NULL, 'uploads/contents/950019032019492008887nr.mp4', 0, '2019-03-20 15:57:16', '2019-03-20 19:52:56');
INSERT INTO `tbl_huijiao_contents` VALUES (951, 'rj0304041101002', '浮力（浮力的大小与哪些因素有关）', '', 1, 1, 1, 0, 129, 20, 0, NULL, NULL, 'uploads/contents/951019032018551208971nr.mp4', 0, '2019-03-20 15:58:04', '2019-03-20 19:45:11');
INSERT INTO `tbl_huijiao_contents` VALUES (952, 'rj0304041201001', '阿基米德原理', '', 1, 1, 1, 0, 130, 20, 0, NULL, NULL, 'uploads/contents/952019032018584201179nr.mp4', 0, '2019-03-20 16:23:41', '2019-03-20 19:45:35');
INSERT INTO `tbl_huijiao_contents` VALUES (953, 'rj0304041301001', '物体的浮沉条件及其应用', '', 1, 1, 1, 0, 131, 20, 0, NULL, NULL, 'uploads/contents/953019032019040101471nr.mp4', 0, '2019-03-20 16:24:16', '2019-03-20 19:45:45');
INSERT INTO `tbl_huijiao_contents` VALUES (954, 'rj0304041401001', '功（做功的两个必要因素）', '', 1, 1, 1, 0, 132, 20, 0, NULL, NULL, 'uploads/contents/954019032019501708901nr.mp4', 0, '2019-03-20 16:24:47', '2019-03-20 19:53:07');
INSERT INTO `tbl_huijiao_contents` VALUES (955, 'rj0304041501001', '功率', '', 1, 1, 1, 0, 133, 20, 0, NULL, NULL, 'uploads/contents/955019032019501403368nr.mp4', 0, '2019-03-20 16:25:25', '2019-03-20 19:53:13');
INSERT INTO `tbl_huijiao_contents` VALUES (956, 'rj0304041601001', '动能和势能（动能）', '', 1, 1, 1, 0, 134, 20, 0, NULL, NULL, 'uploads/contents/956019032019513803940nr.mp4', 0, '2019-03-20 16:26:01', '2019-03-20 19:53:18');
INSERT INTO `tbl_huijiao_contents` VALUES (957, 'rj0304041601002', '动能和势能（重力势能和弹性势能）', '', 1, 1, 1, 0, 134, 20, 0, NULL, NULL, 'uploads/contents/957019032019134202358nr.mp4', 0, '2019-03-20 16:26:38', '2019-03-20 19:48:10');
INSERT INTO `tbl_huijiao_contents` VALUES (958, 'rj0304041701001', '动能和势能的相互转化', '', 1, 1, 1, 0, 135, 20, 0, NULL, NULL, 'uploads/contents/958019032019144703577nr.mp4', 0, '2019-03-20 16:27:25', '2019-03-20 19:48:19');
INSERT INTO `tbl_huijiao_contents` VALUES (959, 'rj0304041801001', '杠杆 （杠杆力臂的概念和画法）', '', 1, 1, 1, 0, 136, 20, 0, NULL, NULL, 'uploads/contents/959019032019221307015nr.mp4', 0, '2019-03-20 16:27:46', '2019-03-20 19:48:26');
INSERT INTO `tbl_huijiao_contents` VALUES (960, 'rj0304041801002', '杠杆（杠杆的分类）', '', 1, 1, 1, 0, 136, 20, 0, NULL, NULL, 'uploads/contents/960019032019215905436nr.mp4', 0, '2019-03-20 16:28:23', '2019-03-20 19:48:32');
INSERT INTO `tbl_huijiao_contents` VALUES (961, 'rj0304041801003', '杠杆（杠杆的平衡条件）', '', 1, 1, 1, 0, 136, 20, 0, NULL, NULL, 'uploads/contents/961019032019544409213nr.mp4', 0, '2019-03-20 16:28:50', '2019-03-20 19:55:58');
INSERT INTO `tbl_huijiao_contents` VALUES (962, 'rj0304041901001', '滑轮（定滑轮及其工作特点）', '', 1, 1, 1, 0, 137, 20, 0, NULL, NULL, 'uploads/contents/962019032019553203424nr.mp4', 0, '2019-03-20 16:29:13', '2019-03-20 19:56:04');
INSERT INTO `tbl_huijiao_contents` VALUES (963, 'rj0304041901002', '滑轮（动滑轮及其工作特点）', '', 1, 1, 1, 0, 137, 20, 0, NULL, NULL, 'uploads/contents/963019032019583105176nr.mp4', 0, '2019-03-20 16:29:46', '2019-03-20 20:04:15');
INSERT INTO `tbl_huijiao_contents` VALUES (964, 'rj0304041901003', '滑轮（滑轮组及其工作特点）', '', 1, 1, 1, 0, 137, 20, 0, NULL, NULL, 'uploads/contents/964019032020005001519nr.mp4', 0, '2019-03-20 16:30:32', '2019-03-20 20:04:21');
INSERT INTO `tbl_huijiao_contents` VALUES (965, 'rj0304042001001', '机械效率', '', 1, 1, 1, 0, 138, 20, 0, NULL, NULL, 'uploads/contents/965019032020025805705nr.mp4', 0, '2019-03-20 16:31:06', '2019-03-20 20:04:26');
INSERT INTO `tbl_huijiao_contents` VALUES (967, 'qd0202020404001', '模拟时钟', '', 1, 1, 1, 0, 41, 23, 1, NULL, NULL, 'uploads/contents/967019032109455203383nr', 0, '2019-03-21 09:41:06', '2019-03-21 09:45:52');
INSERT INTO `tbl_huijiao_contents` VALUES (968, 'qd0202021004001', '平面几何图形', '', 1, 1, 1, 0, 49, 23, 1, NULL, NULL, 'uploads/contents/0019032109475504896nr', 0, '2019-03-21 09:47:55', '2019-03-21 09:47:55');
INSERT INTO `tbl_huijiao_contents` VALUES (969, 'qd0202010101001', '1-5的认识', '', 0, 0, 1, 0, 139, 18, 2, NULL, NULL, 'uploads/contents/0019032111434908766nr.mp4', 0, '2019-03-21 11:43:49', '2019-03-21 11:43:49');
INSERT INTO `tbl_huijiao_contents` VALUES (970, 'qd0202010201001', '0的认识', '', 0, 0, 1, 0, 140, 18, 2, NULL, NULL, 'uploads/contents/0019032113100205418nr.mp4', 0, '2019-03-21 13:10:02', '2019-03-21 13:10:02');
INSERT INTO `tbl_huijiao_contents` VALUES (971, 'qd0202010401001', '10以内数的大小比较', '', 0, 0, 1, 0, 142, 18, 2, NULL, NULL, 'uploads/contents/0019032113200209358nr.mp4', 0, '2019-03-21 13:20:03', '2019-03-21 13:20:03');
INSERT INTO `tbl_huijiao_contents` VALUES (972, 'qd0202010601001', '分类', '', 0, 0, 1, 0, 143, 18, 2, NULL, NULL, 'uploads/contents/0019032114094805044nr.mp4', 0, '2019-03-21 14:09:48', '2019-03-21 14:09:48');
INSERT INTO `tbl_huijiao_contents` VALUES (973, 'qd0202010701001', '比较', '', 0, 0, 1, 0, 144, 18, 0, NULL, NULL, 'uploads/contents/0019032114463208256nr.mp4', 0, '2019-03-21 14:46:32', '2019-03-21 15:12:10');
INSERT INTO `tbl_huijiao_contents` VALUES (974, 'qd0202010801001', '5以内的加法', '', 0, 0, 1, 0, 145, 18, 2, NULL, NULL, 'uploads/contents/0019032115161904173nr.mp4', 0, '2019-03-21 15:16:19', '2019-03-21 15:16:19');
INSERT INTO `tbl_huijiao_contents` VALUES (975, 'rj0304030103001', '长度和时间的测量', '', 0, 1, 1, 0, 211, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:40:11', '2019-03-21 15:40:11');
INSERT INTO `tbl_huijiao_contents` VALUES (976, 'rj0304030203001', '运动的描述', '', 0, 1, 1, 0, 212, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:40:45', '2019-03-21 15:40:45');
INSERT INTO `tbl_huijiao_contents` VALUES (977, 'rj0304030303001', '运动的快慢', '', 0, 1, 1, 0, 213, 11, 0, NULL, NULL, NULL, 0, '2019-03-21 15:41:06', '2019-03-21 15:41:06');
INSERT INTO `tbl_huijiao_contents` VALUES (978, 'rj0304030403001', '测量平均速度 ', '', 0, 1, 1, 0, 214, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:41:33', '2019-03-21 15:41:33');
INSERT INTO `tbl_huijiao_contents` VALUES (979, 'rj0304030503001', '声音的产生与传播', '', 0, 1, 1, 0, 215, 11, 0, NULL, NULL, NULL, 0, '2019-03-21 15:41:50', '2019-03-21 15:41:50');
INSERT INTO `tbl_huijiao_contents` VALUES (980, 'rj0304030603001', '声音的特性', '', 0, 1, 1, 0, 216, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:42:11', '2019-03-21 15:42:11');
INSERT INTO `tbl_huijiao_contents` VALUES (981, 'rj0304030703001', '声的利用', '', 0, 1, 1, 0, 217, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:42:34', '2019-03-21 15:42:34');
INSERT INTO `tbl_huijiao_contents` VALUES (982, 'rj0304030803001', '噪声的危害和控制', '', 0, 1, 1, 0, 221, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:42:56', '2019-03-21 15:42:56');
INSERT INTO `tbl_huijiao_contents` VALUES (983, 'rj0304030903001', '温度', '', 0, 1, 1, 0, 222, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:43:14', '2019-03-21 15:43:14');
INSERT INTO `tbl_huijiao_contents` VALUES (984, 'rj0304031003001', '熔化和凝固 ', '', 0, 1, 1, 0, 224, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:43:36', '2019-03-21 15:43:36');
INSERT INTO `tbl_huijiao_contents` VALUES (985, 'rj0304031103001', '汽化和液化', '', 0, 1, 1, 0, 267, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:44:04', '2019-03-21 15:44:04');
INSERT INTO `tbl_huijiao_contents` VALUES (986, 'rj0304031203001', '升华和凝华 ', '', 0, 1, 1, 0, 227, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:44:30', '2019-03-21 15:44:30');
INSERT INTO `tbl_huijiao_contents` VALUES (987, 'rj0304031303001', '光的直线传播', '', 0, 1, 1, 0, 229, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:44:59', '2019-03-21 15:44:59');
INSERT INTO `tbl_huijiao_contents` VALUES (988, 'rj0304031403001', '光的反射', '', 0, 1, 1, 0, 230, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:45:19', '2019-03-21 15:45:19');
INSERT INTO `tbl_huijiao_contents` VALUES (989, 'rj0304031503001', '平面镜成像', '', 0, 1, 1, 0, 231, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:45:37', '2019-03-21 15:45:37');
INSERT INTO `tbl_huijiao_contents` VALUES (990, 'rj0304031603001', ' 光的折射', '', 0, 1, 1, 0, 233, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:46:02', '2019-03-21 15:46:02');
INSERT INTO `tbl_huijiao_contents` VALUES (991, 'rj0304031703001', '光的色散', '', 0, 1, 1, 0, 268, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:46:24', '2019-03-21 15:46:24');
INSERT INTO `tbl_huijiao_contents` VALUES (992, 'rj0304031803001', '透镜', '', 0, 1, 1, 0, 236, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:46:43', '2019-03-21 15:46:43');
INSERT INTO `tbl_huijiao_contents` VALUES (993, 'rj0304031903001', '生活中的透镜', '', 0, 1, 1, 0, 238, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:47:01', '2019-03-21 15:47:01');
INSERT INTO `tbl_huijiao_contents` VALUES (994, 'rj0304032003001', '凸透镜成像的规律', '', 0, 1, 1, 0, 240, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:47:20', '2019-03-21 15:47:20');
INSERT INTO `tbl_huijiao_contents` VALUES (995, 'rj0304032103001', '眼睛和眼镜', '', 0, 1, 1, 0, 241, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:47:42', '2019-03-21 15:47:42');
INSERT INTO `tbl_huijiao_contents` VALUES (996, 'rj0304032203001', '显微镜和望远镜 ', '', 0, 1, 1, 0, 244, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:48:04', '2019-03-21 15:48:04');
INSERT INTO `tbl_huijiao_contents` VALUES (997, 'rj0304032303001', '质量', '', 0, 1, 1, 0, 245, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:48:27', '2019-03-21 15:48:27');
INSERT INTO `tbl_huijiao_contents` VALUES (998, 'rj0304032403001', '密度', '', 0, 1, 1, 0, 247, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:48:55', '2019-03-21 15:48:55');
INSERT INTO `tbl_huijiao_contents` VALUES (999, 'rj0304032503001', '测量物质的密度', '', 0, 1, 1, 0, 250, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:49:19', '2019-03-21 15:49:19');
INSERT INTO `tbl_huijiao_contents` VALUES (1000, 'rj0304032603001', '密度与社会生活', '', 0, 1, 1, 0, 266, 16, 0, NULL, NULL, NULL, 0, '2019-03-21 15:49:38', '2019-03-21 15:49:38');
INSERT INTO `tbl_huijiao_contents` VALUES (1001, 'qd0202010901001', '5以内的减法', '', 0, 0, 1, 0, 146, 18, 2, NULL, NULL, 'uploads/contents/0019032115523903748nr.mp4', 0, '2019-03-21 15:52:39', '2019-03-21 15:52:39');
INSERT INTO `tbl_huijiao_contents` VALUES (1002, 'qd0202011301001', '10的组成和加减法', '', 0, 0, 1, 0, 150, 18, 2, NULL, NULL, 'uploads/contents/0019032116012405726nr.mp4', 0, '2019-03-21 16:01:24', '2019-03-21 16:01:24');
INSERT INTO `tbl_huijiao_contents` VALUES (1003, 'qd0202011401001', '连加连减', '', 0, 0, 1, 0, 151, 18, 2, NULL, NULL, 'uploads/contents/0019032116102102875nr.mp4', 0, '2019-03-21 16:10:21', '2019-03-21 16:10:21');
INSERT INTO `tbl_huijiao_contents` VALUES (1004, 'qd0202011501001', '加减混合', '', 0, 0, 1, 0, 152, 18, 2, NULL, NULL, 'uploads/contents/0019032116123303552nr.mp4', 0, '2019-03-21 16:12:33', '2019-03-21 16:12:33');
INSERT INTO `tbl_huijiao_contents` VALUES (1005, 'qd0202011601001', '认识位置', '', 0, 0, 1, 0, 153, 18, 2, NULL, NULL, 'uploads/contents/0019032116145705771nr.mp4', 0, '2019-03-21 16:14:57', '2019-03-21 16:14:57');
INSERT INTO `tbl_huijiao_contents` VALUES (1006, 'rj0304030102001', '长度和时间的测量', '', 0, 1, 1, 0, 211, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:17:08', '2019-03-21 16:17:08');
INSERT INTO `tbl_huijiao_contents` VALUES (1007, 'rj0304030202001', '运动的描述', '', 0, 1, 1, 0, 212, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:17:36', '2019-03-21 16:17:36');
INSERT INTO `tbl_huijiao_contents` VALUES (1008, 'rj0304030302001', '运动的快慢', '', 0, 1, 1, 0, 213, 11, 0, NULL, NULL, NULL, 0, '2019-03-21 16:17:57', '2019-03-21 16:17:57');
INSERT INTO `tbl_huijiao_contents` VALUES (1009, 'rj0304030402001', '测量平均速度 ', '', 0, 1, 1, 0, 214, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:18:20', '2019-03-21 16:18:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1010, 'rj0304030502001', '声音的产生与传播 ', '', 0, 1, 1, 0, 215, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:18:41', '2019-03-21 16:18:41');
INSERT INTO `tbl_huijiao_contents` VALUES (1011, 'rj0304030602001', '声音的特性', '', 0, 1, 1, 0, 216, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:19:02', '2019-03-21 16:19:02');
INSERT INTO `tbl_huijiao_contents` VALUES (1012, 'rj0304030702001', '声的利用', '', 0, 1, 1, 0, 217, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:19:22', '2019-03-21 16:19:22');
INSERT INTO `tbl_huijiao_contents` VALUES (1013, 'rj0304030802001', '噪声的危害和控制', '', 0, 1, 1, 0, 221, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:19:55', '2019-03-21 16:19:55');
INSERT INTO `tbl_huijiao_contents` VALUES (1014, 'rj0304030902001', '温度', '', 0, 1, 1, 0, 222, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:20:11', '2019-03-21 16:20:11');
INSERT INTO `tbl_huijiao_contents` VALUES (1015, 'qd0202011801001', '认识11-20', '', 0, 0, 1, 0, 154, 18, 2, NULL, NULL, 'uploads/contents/0019032116201705167nr.mp4', 0, '2019-03-21 16:20:17', '2019-03-21 16:20:17');
INSERT INTO `tbl_huijiao_contents` VALUES (1016, 'rj0304031002001', '熔化和凝固', '', 0, 1, 1, 0, 224, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:20:40', '2019-03-21 16:20:40');
INSERT INTO `tbl_huijiao_contents` VALUES (1017, 'rj0304031102001', '汽化和液化', '', 0, 1, 1, 0, 267, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:21:00', '2019-03-21 16:21:00');
INSERT INTO `tbl_huijiao_contents` VALUES (1018, 'rj0304031202001', '升华和凝华 ', '', 0, 1, 1, 0, 227, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:21:26', '2019-03-21 16:21:26');
INSERT INTO `tbl_huijiao_contents` VALUES (1019, 'rj0304031302001', '光的直线传播', '', 0, 1, 1, 0, 229, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:21:43', '2019-03-21 16:21:43');
INSERT INTO `tbl_huijiao_contents` VALUES (1020, 'rj0304031402001', '光的反射', '', 0, 1, 1, 0, 230, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:22:08', '2019-03-21 16:22:08');
INSERT INTO `tbl_huijiao_contents` VALUES (1021, 'rj0304031502001', '平面镜成像', '', 0, 1, 1, 0, 231, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:22:34', '2019-03-21 16:22:34');
INSERT INTO `tbl_huijiao_contents` VALUES (1022, 'rj0304031602001', '光的折射', '', 0, 1, 1, 0, 233, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:23:04', '2019-03-21 16:23:04');
INSERT INTO `tbl_huijiao_contents` VALUES (1023, 'rj0304031702001', '光的色散 ', '', 0, 1, 1, 0, 268, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:23:25', '2019-03-21 16:23:25');
INSERT INTO `tbl_huijiao_contents` VALUES (1024, 'rj0304031802001', '透镜', '', 0, 1, 1, 0, 236, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:23:45', '2019-03-21 16:23:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1025, 'rj0304031902001', '生活中的透镜 ', '', 0, 1, 1, 0, 238, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:24:08', '2019-03-21 16:24:08');
INSERT INTO `tbl_huijiao_contents` VALUES (1026, 'rj0304032002001', '凸透镜成像的规律 ', '', 0, 1, 1, 0, 240, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:24:38', '2019-03-21 16:24:38');
INSERT INTO `tbl_huijiao_contents` VALUES (1027, 'rj0304032102001', '眼睛和眼镜', '', 0, 1, 1, 0, 241, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:25:14', '2019-03-21 16:25:14');
INSERT INTO `tbl_huijiao_contents` VALUES (1028, 'rj0304032202001', '显微镜和望远镜', '', 0, 1, 1, 0, 244, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:25:38', '2019-03-21 16:25:38');
INSERT INTO `tbl_huijiao_contents` VALUES (1029, 'rj0304032302001', '质量 ', '', 0, 1, 1, 0, 245, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:26:01', '2019-03-21 16:26:01');
INSERT INTO `tbl_huijiao_contents` VALUES (1030, 'rj0304032402001', '密度', '', 0, 1, 1, 0, 247, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:26:23', '2019-03-21 16:26:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1031, 'rj0304032502001', '测量物质的密度', '', 0, 1, 1, 0, 266, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:26:56', '2019-03-21 16:26:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1032, 'rj0304032602001', '密度与社会生活', '', 0, 1, 1, 0, 266, 19, 0, NULL, NULL, NULL, 0, '2019-03-21 16:27:19', '2019-03-21 16:27:19');
INSERT INTO `tbl_huijiao_contents` VALUES (1033, 'qd0202011901001', '20以内的不进位加法和不退位减法', '', 0, 0, 1, 0, 155, 18, 2, NULL, NULL, 'uploads/contents/0019032116275202159nr.mp4', 0, '2019-03-21 16:27:52', '2019-03-21 16:27:52');
INSERT INTO `tbl_huijiao_contents` VALUES (1034, 'rj0304030105001', '长度和时间的测量', '', 0, 1, 1, 0, 211, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:28:20', '2019-03-21 16:28:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1035, 'rj0304030205001', '运动的描述', '', 0, 1, 1, 0, 212, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:28:37', '2019-03-21 19:08:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1036, 'rj0304030305001', '运动的快慢', '', 0, 1, 1, 0, 213, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:29:31', '2019-03-21 16:29:31');
INSERT INTO `tbl_huijiao_contents` VALUES (1037, 'rj0304030405001', '测量平均速度', '', 0, 1, 1, 0, 214, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:29:59', '2019-03-21 16:29:59');
INSERT INTO `tbl_huijiao_contents` VALUES (1038, 'rj0304030505001', '声音的产生与传播', '', 0, 1, 1, 0, 215, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:30:26', '2019-03-21 16:30:26');
INSERT INTO `tbl_huijiao_contents` VALUES (1039, 'rj0304030605001', '声音的特性', '', 0, 1, 1, 0, 216, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:30:56', '2019-03-21 16:30:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1040, 'rj0304030705001', '声的利用', '', 0, 1, 1, 0, 217, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:31:18', '2019-03-21 16:31:18');
INSERT INTO `tbl_huijiao_contents` VALUES (1041, 'rj0304030805001', '噪声的危害和控制', '', 0, 1, 1, 0, 221, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:31:45', '2019-03-21 16:31:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1042, 'rj0304030905001', '温度', '', 0, 1, 1, 0, 222, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:32:15', '2019-03-21 16:32:15');
INSERT INTO `tbl_huijiao_contents` VALUES (1043, 'rj0304031005001', '熔化和凝固 ', '', 0, 1, 1, 0, 224, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:32:36', '2019-03-21 16:32:36');
INSERT INTO `tbl_huijiao_contents` VALUES (1044, 'rj0304031105001', '汽化和液化', '', 0, 1, 1, 0, 267, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:33:15', '2019-03-21 16:33:15');
INSERT INTO `tbl_huijiao_contents` VALUES (1045, 'rj0304031205001', '升华和凝华', '', 0, 1, 1, 0, 227, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:33:44', '2019-03-21 16:33:44');
INSERT INTO `tbl_huijiao_contents` VALUES (1046, 'rj0304031305001', '光的直线传播 ', '', 0, 1, 1, 0, 229, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:34:19', '2019-03-21 16:34:19');
INSERT INTO `tbl_huijiao_contents` VALUES (1047, 'rj0304031405001', '光的反射', '', 0, 1, 1, 0, 230, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:34:40', '2019-03-21 16:34:40');
INSERT INTO `tbl_huijiao_contents` VALUES (1048, 'rj0304031505001', '平面镜成像 ', '', 0, 1, 1, 0, 231, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:35:09', '2019-03-21 16:35:09');
INSERT INTO `tbl_huijiao_contents` VALUES (1049, 'rj0304031605001', '光的折射', '', 0, 1, 1, 0, 233, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:35:42', '2019-03-21 16:35:42');
INSERT INTO `tbl_huijiao_contents` VALUES (1050, 'rj0304031705001', '光的色散', '', 0, 1, 1, 0, 268, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:36:05', '2019-03-21 16:36:05');
INSERT INTO `tbl_huijiao_contents` VALUES (1051, 'rj0304031805001', '透镜 ', '', 0, 1, 1, 0, 236, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:36:39', '2019-03-21 16:36:39');
INSERT INTO `tbl_huijiao_contents` VALUES (1052, 'rj0304031905001', '生活中的透镜', '', 0, 1, 1, 0, 238, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:37:12', '2019-03-21 16:37:12');
INSERT INTO `tbl_huijiao_contents` VALUES (1053, 'rj0304032005001', '凸透镜成像的规律', '', 0, 1, 1, 0, 240, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:37:31', '2019-03-21 16:37:31');
INSERT INTO `tbl_huijiao_contents` VALUES (1054, 'rj0304032105001', '眼睛和眼镜', '', 0, 1, 1, 0, 241, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:38:06', '2019-03-21 16:38:06');
INSERT INTO `tbl_huijiao_contents` VALUES (1055, 'rj0304032205001', '显微镜和望远镜', '', 0, 1, 1, 0, 244, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:38:30', '2019-03-21 16:38:30');
INSERT INTO `tbl_huijiao_contents` VALUES (1056, 'rj0304032305001', '质量', '', 0, 1, 1, 0, 245, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:38:56', '2019-03-21 16:38:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1057, 'rj0304032405001', '密度 ', '', 0, 1, 1, 0, 247, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:39:21', '2019-03-21 16:39:21');
INSERT INTO `tbl_huijiao_contents` VALUES (1058, 'rj0304032505001', '测量物质的密度', '', 0, 1, 1, 0, 250, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:39:58', '2019-03-21 16:39:58');
INSERT INTO `tbl_huijiao_contents` VALUES (1059, 'rj0304032605001', '密度与社会生活', '', 0, 1, 1, 0, 266, 24, 0, NULL, NULL, NULL, 0, '2019-03-21 16:40:23', '2019-03-21 16:40:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1060, 'rj0304030101001', '长度和时间的测量', '', 0, 1, 1, 0, 211, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:46:36', '2019-03-21 16:46:36');
INSERT INTO `tbl_huijiao_contents` VALUES (1061, 'rj0304030201001', '运动的描述', '', 0, 1, 1, 0, 212, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:46:55', '2019-03-21 16:46:55');
INSERT INTO `tbl_huijiao_contents` VALUES (1062, 'rj0304030301001', '运动的快慢', '', 0, 1, 1, 0, 213, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:47:20', '2019-03-21 16:47:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1063, 'rj0304030401001', '测量平均速度', '', 0, 1, 1, 0, 214, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:47:37', '2019-03-21 16:47:37');
INSERT INTO `tbl_huijiao_contents` VALUES (1064, 'rj0304030501001', '声音的产生与传播', '', 0, 1, 1, 0, 215, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:47:58', '2019-03-21 16:47:58');
INSERT INTO `tbl_huijiao_contents` VALUES (1065, 'rj0304030601001', '声音的特性', '', 0, 1, 1, 0, 216, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:48:18', '2019-03-21 16:48:18');
INSERT INTO `tbl_huijiao_contents` VALUES (1066, 'rj0304030701001', '声的利用', '', 0, 1, 1, 0, 217, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:48:37', '2019-03-21 16:48:37');
INSERT INTO `tbl_huijiao_contents` VALUES (1067, 'rj0304030801001', '噪声的危害和控制', '', 0, 1, 1, 0, 221, 11, 0, NULL, NULL, NULL, 0, '2019-03-21 16:48:56', '2019-03-21 16:48:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1068, 'rj0304030901001', '温度 ', '', 0, 1, 1, 0, 222, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:49:22', '2019-03-21 16:49:22');
INSERT INTO `tbl_huijiao_contents` VALUES (1069, 'rj0304031001001', '熔化和凝固', '', 0, 1, 1, 0, 224, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:49:50', '2019-03-21 16:49:50');
INSERT INTO `tbl_huijiao_contents` VALUES (1070, 'rj0304031101001', '汽化和液化', '', 0, 1, 1, 0, 267, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:50:14', '2019-03-21 16:50:14');
INSERT INTO `tbl_huijiao_contents` VALUES (1071, 'rj0304031201001', '升华和凝华 ', '', 0, 1, 1, 0, 227, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:50:37', '2019-03-21 16:50:37');
INSERT INTO `tbl_huijiao_contents` VALUES (1072, 'rj0304031301001', '光的直线传播', '', 0, 1, 1, 0, 229, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:51:01', '2019-03-21 16:51:01');
INSERT INTO `tbl_huijiao_contents` VALUES (1073, 'rj0304031401001', '光的反射', '', 0, 1, 1, 0, 230, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:51:20', '2019-03-21 16:51:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1074, 'rj0304031501001', '平面镜成像', '', 0, 1, 1, 0, 231, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:51:39', '2019-03-21 16:51:39');
INSERT INTO `tbl_huijiao_contents` VALUES (1075, 'rj0304031601001', '光的折射', '', 0, 1, 1, 0, 233, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:52:01', '2019-03-21 16:52:01');
INSERT INTO `tbl_huijiao_contents` VALUES (1076, 'rj0304031701001', '光的色散', '', 0, 1, 1, 0, 268, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:52:25', '2019-03-21 16:52:25');
INSERT INTO `tbl_huijiao_contents` VALUES (1077, 'rj0304031801001', '透镜', '', 0, 1, 1, 0, 236, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:52:45', '2019-03-21 16:52:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1078, 'rj0304031901001', '生活中的透镜', '', 0, 1, 1, 0, 238, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:53:10', '2019-03-21 16:53:10');
INSERT INTO `tbl_huijiao_contents` VALUES (1079, 'rj0304032001001', '凸透镜成像的规律 ', '', 0, 1, 1, 0, 240, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:53:35', '2019-03-21 16:53:35');
INSERT INTO `tbl_huijiao_contents` VALUES (1080, 'rj0304032101001', '眼睛和眼镜', '', 0, 1, 1, 0, 241, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:54:01', '2019-03-21 16:54:01');
INSERT INTO `tbl_huijiao_contents` VALUES (1081, 'rj0304032201001', '显微镜和望远镜', '', 0, 1, 1, 0, 244, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:54:22', '2019-03-21 16:54:22');
INSERT INTO `tbl_huijiao_contents` VALUES (1082, 'rj0304032301001', '质量', '', 0, 1, 1, 0, 245, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:54:42', '2019-03-21 16:54:42');
INSERT INTO `tbl_huijiao_contents` VALUES (1083, 'rj0304032401001', '密度', '', 0, 1, 1, 0, 247, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:55:26', '2019-03-21 16:55:26');
INSERT INTO `tbl_huijiao_contents` VALUES (1084, 'rj0304032501001', '测量物质的密度', '', 0, 1, 1, 0, 250, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:55:50', '2019-03-21 16:55:50');
INSERT INTO `tbl_huijiao_contents` VALUES (1085, 'rj0304032601001', '密度与社会生活', '', 0, 1, 1, 0, 266, 20, 0, NULL, NULL, NULL, 0, '2019-03-21 16:56:09', '2019-03-21 16:56:09');
INSERT INTO `tbl_huijiao_contents` VALUES (1086, 'qd0202011201001', '8、9的加减法', '', 0, 0, 1, 0, 149, 18, 0, NULL, NULL, 'uploads/contents/0019032116583508283nr.mp4', 0, '2019-03-21 16:58:35', '2019-03-21 16:59:30');
INSERT INTO `tbl_huijiao_contents` VALUES (1087, 'qd0202012101001', '认识图形', '', 0, 0, 1, 0, 156, 18, 2, NULL, NULL, 'uploads/contents/0019032117021704101nr.mp4', 0, '2019-03-21 17:02:17', '2019-03-21 17:02:17');
INSERT INTO `tbl_huijiao_contents` VALUES (1088, 'qd0202012301001', '9加几', '', 0, 0, 1, 0, 157, 18, 2, NULL, NULL, 'uploads/contents/0019032117062302264nr.mp4', 0, '2019-03-21 17:06:23', '2019-03-21 17:06:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1089, 'rj0304032707001', '单元套卷（一）', '', 0, 1, 1, 0, 289, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 18:40:19', '2019-03-21 18:55:40');
INSERT INTO `tbl_huijiao_contents` VALUES (1090, 'rj0304032707003', '单元套卷（二）', '', 0, 1, 1, 0, 289, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 18:41:29', '2019-03-21 18:56:14');
INSERT INTO `tbl_huijiao_contents` VALUES (1092, 'rj0304032707005', '单元套卷（三）', '', 0, 1, 1, 0, 289, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 18:42:59', '2019-03-21 18:56:34');
INSERT INTO `tbl_huijiao_contents` VALUES (1093, 'rj0304032807001', '单元套卷（一）', '', 0, 1, 1, 0, 290, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 18:58:59', '2019-03-21 18:58:59');
INSERT INTO `tbl_huijiao_contents` VALUES (1094, 'rj0304032807003', '单元套卷（二）', '', 0, 1, 1, 0, 290, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:00:39', '2019-03-21 19:00:39');
INSERT INTO `tbl_huijiao_contents` VALUES (1095, 'rj0304032807005', '单元套卷（三）', '', 0, 1, 1, 0, 290, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:01:13', '2019-03-21 19:01:13');
INSERT INTO `tbl_huijiao_contents` VALUES (1096, 'rj0304032907001', '单元套卷（一）', '', 0, 1, 1, 0, 291, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:01:55', '2019-03-21 19:01:55');
INSERT INTO `tbl_huijiao_contents` VALUES (1097, 'rj0304032907003', '单元套卷（二）', '', 0, 1, 1, 0, 291, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:02:38', '2019-03-21 19:02:38');
INSERT INTO `tbl_huijiao_contents` VALUES (1098, 'rj0304032907005', '单元套卷（三）', '', 0, 1, 1, 0, 291, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:03:03', '2019-03-21 19:03:03');
INSERT INTO `tbl_huijiao_contents` VALUES (1099, 'rj0304033007001', '单元套卷（一）', '', 0, 1, 1, 0, 292, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:03:50', '2019-03-21 19:03:50');
INSERT INTO `tbl_huijiao_contents` VALUES (1100, 'rj0304033007003', '单元套卷（二）', '', 0, 1, 1, 0, 292, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:04:13', '2019-03-21 19:04:13');
INSERT INTO `tbl_huijiao_contents` VALUES (1101, 'rj0304033007005', '单元套卷（三）', '', 0, 1, 1, 0, 292, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:04:56', '2019-03-21 19:04:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1102, 'rj0304033107001', '单元套卷（一）', '', 0, 1, 1, 0, 293, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:05:51', '2019-03-21 19:05:51');
INSERT INTO `tbl_huijiao_contents` VALUES (1103, 'rj0304033107003', '单元套卷（二）', '', 0, 1, 1, 0, 293, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:06:23', '2019-03-21 19:06:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1104, 'rj0304033107005', '单元套卷（三）', '', 0, 1, 1, 0, 293, 25, 0, NULL, NULL, NULL, 0, '2019-03-21 19:06:56', '2019-03-21 19:06:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1105, 'qd0202030201001', '乘法的初步认识', '', 0, 1, 1, 0, 0, 18, 2, NULL, NULL, 'uploads/contents/0019032210404507802nr.mp4', 0, '2019-03-22 10:40:46', '2019-03-22 10:40:46');
INSERT INTO `tbl_huijiao_contents` VALUES (1106, 'qd0202030201001', '乘法的初步认识', '', 1, 1, 1, 0, 162, 18, 2, NULL, NULL, 'uploads/contents/0019032210532008702nr.mp4', 0, '2019-03-22 10:53:20', '2019-03-22 10:53:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1108, 'qd0202030401001', '5的乘法口诀', '', 1, 1, 1, 0, 164, 18, 2, NULL, NULL, 'uploads/contents/1108019032211580808527nr.mp4', 0, '2019-03-22 11:24:31', '2019-03-22 11:58:08');
INSERT INTO `tbl_huijiao_contents` VALUES (1109, 'qd0202030701001', '乘法加和乘法减', '', 1, 1, 1, 0, 167, 18, 2, NULL, NULL, 'uploads/contents/0019032211533005276nr.mp4', 0, '2019-03-22 11:53:30', '2019-03-22 11:53:30');
INSERT INTO `tbl_huijiao_contents` VALUES (1110, 'qd0202030801001', '角的初步认识', '', 1, 1, 1, 0, 168, 18, 2, NULL, NULL, 'uploads/contents/0019032212025304732nr.mp4', 0, '2019-03-22 12:02:53', '2019-03-22 12:02:53');
INSERT INTO `tbl_huijiao_contents` VALUES (1111, 'qd0202031101001', '6的乘法口诀', '', 1, 1, 1, 0, 170, 18, 2, NULL, NULL, 'uploads/contents/0019032212064101807nr.mp4', 0, '2019-03-22 12:06:41', '2019-03-22 12:06:41');
INSERT INTO `tbl_huijiao_contents` VALUES (1112, 'qd0202031301001', '8的乘法口诀', '', 1, 1, 1, 0, 172, 18, 2, NULL, NULL, 'uploads/contents/0019032212101207911nr.mp4', 0, '2019-03-22 12:10:12', '2019-03-22 12:10:12');
INSERT INTO `tbl_huijiao_contents` VALUES (1113, 'qd0202031201001', '7的乘法口诀', '', 1, 1, 1, 0, 171, 18, 2, NULL, NULL, 'uploads/contents/0019032212124506744nr.mp4', 0, '2019-03-22 12:12:45', '2019-03-22 12:12:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1114, 'qd0202031401001', '求一个数的几倍是多少', '', 1, 1, 1, 0, 173, 18, 2, NULL, NULL, 'uploads/contents/0019032212150005922nr.mp4', 0, '2019-03-22 12:15:01', '2019-03-22 12:15:01');
INSERT INTO `tbl_huijiao_contents` VALUES (1115, 'qd0202031501001', '9的乘法口诀', '', 1, 1, 1, 0, 174, 18, 2, NULL, NULL, 'uploads/contents/0019032212204501406nr.mp4', 0, '2019-03-22 12:20:45', '2019-03-22 12:20:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1116, 'qd0202031701001', '平均分', '', 1, 1, 1, 0, 175, 18, 2, NULL, NULL, 'uploads/contents/0019032212222308592nr.mp4', 0, '2019-03-22 12:22:23', '2019-03-22 12:22:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1117, 'qd0202031901001', '除法的初步认识', '', 1, 1, 1, 0, 177, 18, 2, NULL, NULL, 'uploads/contents/0019032212284009399nr.mp4', 0, '2019-03-22 12:28:40', '2019-03-22 12:28:40');
INSERT INTO `tbl_huijiao_contents` VALUES (1118, 'qd0202032101001', '认识东西南北', '', 1, 1, 1, 0, 179, 18, 2, NULL, NULL, 'uploads/contents/0019032212404608364nr.mp4', 0, '2019-03-22 12:40:46', '2019-03-22 12:40:46');
INSERT INTO `tbl_huijiao_contents` VALUES (1119, 'qd0202032401001', '口诀求商', '', 1, 1, 1, 0, 182, 18, 2, NULL, NULL, 'uploads/contents/0019032212484703505nr.mp4', 0, '2019-03-22 12:48:47', '2019-03-22 12:48:47');
INSERT INTO `tbl_huijiao_contents` VALUES (1120, 'qd0202032001001', '0的除法', '', 1, 1, 1, 0, 178, 18, 2, NULL, NULL, 'uploads/contents/1120019032212551208920nr.mp4', 0, '2019-03-22 12:49:23', '2019-03-22 12:55:13');
INSERT INTO `tbl_huijiao_contents` VALUES (1121, 'qd0202032501001', '一个数是另一个数的几倍', '', 1, 1, 1, 0, 183, 18, 2, NULL, NULL, 'uploads/contents/0019032212524509158nr.mp4', 0, '2019-03-22 12:52:45', '2019-03-22 12:52:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1122, 'qd0202032601001', '连乘连除乘除混合', '', 1, 1, 1, 0, 184, 18, 2, NULL, NULL, 'uploads/contents/0019032212552807815nr.mp4', 0, '2019-03-22 12:55:28', '2019-03-22 12:55:28');
INSERT INTO `tbl_huijiao_contents` VALUES (1123, 'qd0202050101001', '克、千克的认识', '', 0, 0, 1, 0, 220, 18, 0, NULL, NULL, 'uploads/contents/0019032213384507602nr.mp4', 0, '2019-03-22 13:38:45', '2019-03-22 13:39:26');
INSERT INTO `tbl_huijiao_contents` VALUES (1124, 'qd0202040101001', '有余数除法的认识', '', 1, 1, 1, 0, 185, 18, 2, NULL, NULL, 'uploads/contents/0019032213425104651nr.mp4', 0, '2019-03-22 13:42:51', '2019-03-22 13:42:51');
INSERT INTO `tbl_huijiao_contents` VALUES (1125, 'qd0202050401001', '两位数乘一位数（不进位）', '', 0, 0, 1, 0, 228, 18, 2, NULL, NULL, 'uploads/contents/0019032213453205410nr.mp4', 0, '2019-03-22 13:45:32', '2019-03-22 13:45:32');
INSERT INTO `tbl_huijiao_contents` VALUES (1126, 'qd0202050501001', '两位数乘一位数（进位）', '', 0, 0, 1, 0, 232, 18, 2, NULL, NULL, 'uploads/contents/0019032213520902735nr.mp4', 0, '2019-03-22 13:52:10', '2019-03-22 13:52:10');
INSERT INTO `tbl_huijiao_contents` VALUES (1127, 'qd0202040401001', '千以内数的认识', '', 1, 1, 1, 0, 187, 18, 2, NULL, NULL, 'uploads/contents/0019032213540604829nr.mp4', 0, '2019-03-22 13:54:06', '2019-03-22 13:54:06');
INSERT INTO `tbl_huijiao_contents` VALUES (1128, 'qd0202040201001', '有余数除法的笔算', '', 1, 1, 1, 0, 186, 18, 2, NULL, NULL, 'uploads/contents/0019032213574403516nr.mp4', 0, '2019-03-22 13:57:44', '2019-03-22 13:57:44');
INSERT INTO `tbl_huijiao_contents` VALUES (1129, 'qd0202050601001', '用乘加、乘减两步计算解决问题', '', 0, 0, 1, 0, 234, 18, 2, NULL, NULL, 'uploads/contents/0019032214070304419nr.mp4', 0, '2019-03-22 14:07:03', '2019-03-22 14:07:03');
INSERT INTO `tbl_huijiao_contents` VALUES (1130, 'qd0202040701001', '整十、整百、整千的加减法', '', 1, 1, 1, 0, 190, 18, 2, NULL, NULL, 'uploads/contents/0019032214111105839nr.mp4', 0, '2019-03-22 14:11:11', '2019-03-22 14:11:11');
INSERT INTO `tbl_huijiao_contents` VALUES (1131, 'qd0202040501001', '万以内数的认识', '', 1, 1, 1, 0, 188, 18, 2, NULL, NULL, 'uploads/contents/0019032214130604110nr.mp4', 0, '2019-03-22 14:13:06', '2019-03-22 14:13:06');
INSERT INTO `tbl_huijiao_contents` VALUES (1132, 'qd0202050901001', '三位数乘一位数（不进位）', '', 0, 0, 1, 0, 237, 18, 2, NULL, NULL, 'uploads/contents/0019032214181506357nr.mp4', 0, '2019-03-22 14:18:15', '2019-03-22 14:18:15');
INSERT INTO `tbl_huijiao_contents` VALUES (1133, 'qd0202040901001', '毫米、分米的认识和换算', '', 1, 1, 1, 0, 192, 18, 2, NULL, NULL, 'uploads/contents/0019032214282405063nr.mp4', 0, '2019-03-22 14:28:24', '2019-03-22 14:28:24');
INSERT INTO `tbl_huijiao_contents` VALUES (1134, 'qd0202041001001', '千米的认识', '', 1, 1, 1, 0, 193, 18, 2, NULL, NULL, 'uploads/contents/0019032214392604257nr.mp4', 0, '2019-03-22 14:39:26', '2019-03-22 14:39:26');
INSERT INTO `tbl_huijiao_contents` VALUES (1135, 'qd0202051001001', '三位数（末尾或中间有0）乘一位数', '', 0, 0, 1, 0, 242, 18, 0, NULL, NULL, 'uploads/contents/0019032214501002078nr.mp4', 0, '2019-03-22 14:50:10', '2019-03-22 15:17:59');
INSERT INTO `tbl_huijiao_contents` VALUES (1136, 'qd0202041201001', '两位数加减两位数', '', 1, 1, 1, 0, 194, 18, 2, NULL, NULL, 'uploads/contents/0019032214520307732nr.mp4', 0, '2019-03-22 14:52:03', '2019-03-22 14:52:03');
INSERT INTO `tbl_huijiao_contents` VALUES (1137, 'qd0202051201001', '平移与旋转', '', 0, 0, 1, 0, 246, 18, 2, NULL, NULL, 'uploads/contents/0019032214542803381nr.mp4', 0, '2019-03-22 14:54:28', '2019-03-22 14:54:28');
INSERT INTO `tbl_huijiao_contents` VALUES (1138, 'qd0202041501001', '三位数加减的验算', '', 1, 1, 1, 0, 197, 18, 2, NULL, NULL, 'uploads/contents/0019032214573405352nr.mp4', 0, '2019-03-22 14:57:34', '2019-03-22 14:57:34');
INSERT INTO `tbl_huijiao_contents` VALUES (1139, 'qd0202040801001', '大约和估计数', '', 1, 1, 1, 0, 191, 18, 2, NULL, NULL, 'uploads/contents/0019032215004504985nr.mp4', 0, '2019-03-22 15:00:45', '2019-03-22 15:00:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1140, 'qd0202051401001', '整十数、几百几十数除以一位数的口算', '', 0, 0, 1, 0, 249, 18, 2, NULL, NULL, 'uploads/contents/0019032215115507788nr.mp4', 0, '2019-03-22 15:11:56', '2019-03-22 15:11:56');
INSERT INTO `tbl_huijiao_contents` VALUES (1141, 'qd0202042301001', '长方形和正方形的特征', '', 1, 1, 1, 0, 204, 18, 2, NULL, NULL, 'uploads/contents/0019032215190609722nr.mp4', 0, '2019-03-22 15:19:06', '2019-03-22 15:19:06');
INSERT INTO `tbl_huijiao_contents` VALUES (1142, 'qd0202052001001', '加括号的混合运算', '', 0, 0, 1, 0, 256, 18, 2, NULL, NULL, 'uploads/contents/0019032215225501930nr.mp4', 0, '2019-03-22 15:22:55', '2019-03-22 15:22:55');
INSERT INTO `tbl_huijiao_contents` VALUES (1143, 'qd0202041701001', '不同角度观察物体', '', 1, 1, 1, 0, 199, 18, 2, NULL, NULL, 'uploads/contents/0019032215270006605nr.mp4', 0, '2019-03-22 15:27:00', '2019-03-22 15:27:00');
INSERT INTO `tbl_huijiao_contents` VALUES (1144, 'qd0202042401001', '图形的拼组', '', 1, 1, 1, 0, 205, 18, 2, NULL, NULL, 'uploads/contents/0019032215290706601nr.mp4', 0, '2019-03-22 15:29:08', '2019-03-22 15:29:08');
INSERT INTO `tbl_huijiao_contents` VALUES (1145, 'qd0202052101001', '时分的认识', '', 0, 0, 1, 0, 257, 18, 2, NULL, NULL, 'uploads/contents/0019032215301301092nr.mp4', 0, '2019-03-22 15:30:13', '2019-03-22 15:30:13');
INSERT INTO `tbl_huijiao_contents` VALUES (1146, 'qd0202052201001', '时分的计算', '', 0, 0, 1, 0, 258, 18, 0, NULL, NULL, 'uploads/contents/0019032215424809413nr.mp4', 0, '2019-03-22 15:42:49', '2019-03-22 15:43:18');
INSERT INTO `tbl_huijiao_contents` VALUES (1147, 'qd0202052301001', '秒的认识', '', 0, 0, 1, 0, 259, 18, 2, NULL, NULL, 'uploads/contents/0019032215530104131nr.mp4', 0, '2019-03-22 15:53:02', '2019-03-22 15:53:02');
INSERT INTO `tbl_huijiao_contents` VALUES (1148, 'qd0202052501001', '图形周长的认识', '', 0, 0, 1, 0, 261, 18, 2, NULL, NULL, 'uploads/contents/0019032216032701895nr.mp4', 0, '2019-03-22 16:03:27', '2019-03-22 16:03:27');
INSERT INTO `tbl_huijiao_contents` VALUES (1149, 'qd0202040404001', '计数器', '', 1, 1, 1, 0, 42, 23, 1, NULL, NULL, 'uploads/contents/1149019032219065705191nr', 0, '2019-03-22 19:04:03', '2019-03-22 19:06:57');
INSERT INTO `tbl_huijiao_contents` VALUES (1150, 'qd0202022404001', '常用工具', '', 1, 1, 1, 0, 62, 23, 1, NULL, NULL, 'uploads/contents/0019032219105701051nr', 0, '2019-03-22 19:10:57', '2019-03-22 19:10:57');
INSERT INTO `tbl_huijiao_contents` VALUES (1151, 'qd0202081104001', '三角形的内角和', '', 1, 1, 1, 0, 49, 23, 1, NULL, NULL, 'uploads/contents/0019032219173604688nr', 0, '2019-03-22 19:17:36', '2019-03-22 19:17:36');
INSERT INTO `tbl_huijiao_contents` VALUES (1152, 'qd0202111504001', '圆半径测量', '', 1, 1, 1, 0, 49, 23, 1, NULL, NULL, 'uploads/contents/0019032219533406905nr', 0, '2019-03-22 19:53:34', '2019-03-22 19:53:34');
INSERT INTO `tbl_huijiao_contents` VALUES (1153, 'qd0202051204001', '图形运动（平移）', '', 0, 1, 1, 0, 49, 18, 1, NULL, NULL, 'uploads/contents/0019032219544809660nr', 0, '2019-03-22 19:54:48', '2019-03-22 19:54:48');
INSERT INTO `tbl_huijiao_contents` VALUES (1154, 'qd0202090404001', '中心对称作图', '', 1, 1, 1, 0, 49, 23, 1, NULL, NULL, 'uploads/contents/0019032219561907825nr', 0, '2019-03-22 19:56:19', '2019-03-22 19:56:19');
INSERT INTO `tbl_huijiao_contents` VALUES (1155, 'qd0202090504001', '旋转对称', '', 1, 1, 1, 0, 49, 23, 1, NULL, NULL, 'uploads/contents/0019032219571405150nr', 0, '2019-03-22 19:57:14', '2019-03-22 19:57:14');
INSERT INTO `tbl_huijiao_contents` VALUES (1156, 'qd0202102104001', '正方体展开图', '', 1, 1, 1, 0, 49, 23, 1, NULL, NULL, 'uploads/contents/0019032219593506855nr', 0, '2019-03-22 19:59:36', '2019-03-22 19:59:36');
INSERT INTO `tbl_huijiao_contents` VALUES (1158, 'qd0202092204001', '约数与倍数', '', 1, 1, 1, 0, 42, 23, 1, NULL, NULL, 'uploads/contents/0019032220034608283nr', 0, '2019-03-22 20:03:46', '2019-03-22 20:03:46');
INSERT INTO `tbl_huijiao_contents` VALUES (1159, 'qd0202092504001', '质数与合数', '', 1, 1, 1, 0, 42, 23, 1, NULL, NULL, 'uploads/contents/0019032220044805954nr', 0, '2019-03-22 20:04:48', '2019-03-22 20:04:48');
INSERT INTO `tbl_huijiao_contents` VALUES (1160, 'qd0202110704001', '分数计算', '', 1, 1, 1, 0, 61, 23, 1, NULL, NULL, 'uploads/contents/0019032220092301219nr', 0, '2019-03-22 20:09:23', '2019-03-22 20:09:23');
INSERT INTO `tbl_huijiao_contents` VALUES (1161, 'qd0202050304001', '天平', '', 1, 1, 1, 0, 43, 23, 1, NULL, NULL, 'uploads/contents/0019032220112004791nr', 0, '2019-03-22 20:11:20', '2019-03-22 20:11:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1162, 'qd0202110604002', '投骰子', '', 1, 1, 1, 0, 64, 23, 1, NULL, NULL, 'uploads/contents/0019032220154103658nr', 0, '2019-03-22 20:15:41', '2019-03-22 20:15:41');
INSERT INTO `tbl_huijiao_contents` VALUES (1163, 'qd0202072404001', '植树模型', '', 1, 1, 1, 0, 64, 23, 1, NULL, NULL, 'uploads/contents/0019032220205306854nr', 0, '2019-03-22 20:20:53', '2019-03-22 20:20:53');
INSERT INTO `tbl_huijiao_contents` VALUES (1164, 'test', 'test', '', 0, 1, 1, 0, 46, 11, 2, NULL, NULL, 'uploads/contents/0019042411204204059nr.mp4', 0, '2019-04-24 11:20:42', '2019-04-24 11:20:42');
INSERT INTO `tbl_huijiao_contents` VALUES (1165, 'xinde', 'xinde', '', 1, 1, 1, 0, 46, 15, 1, NULL, NULL, 'uploads/contents/1165019051323002102538nr', 0, '2019-04-24 11:39:44', '2019-05-13 23:00:21');
INSERT INTO `tbl_huijiao_contents` VALUES (1166, '1111111111', 'yuwen11', '', 0, 1, 1, 0, 46, 11, 2, NULL, NULL, 'uploads/contents/0019050520173507370nr.mp4', 0, '2019-05-05 20:17:35', '2019-05-05 20:17:35');
INSERT INTO `tbl_huijiao_contents` VALUES (1181, NULL, 'bncq1_dydqh_16sp', '', 1, 1, 1, 370, 1, 2, 2, 'assets/images/huijiao/tab2/icon2.png', NULL, 'uploads/contents/qd0037000001019050900280403251nr.mp4', 0, '2019-05-09 00:28:04', '2019-05-09 00:28:04');
INSERT INTO `tbl_huijiao_contents` VALUES (1182, NULL, 'conn', '', 1, 1, 1, 370, 1, 3, 3, 'uploads/contents/qd0037000001019050900281506638nr.png', NULL, 'uploads/contents/qd0037000001019050900281506638nr.png', 0, '2019-05-09 00:28:15', '2019-05-09 00:28:15');
INSERT INTO `tbl_huijiao_contents` VALUES (1183, NULL, 'right', '', 1, 1, 1, 370, 1, 2, 2, 'assets/images/huijiao/tab2/icon2_1.png', NULL, 'uploads/contents/qd0037000001019050900282004319nr.mp3', 0, '2019-05-09 00:28:20', '2019-05-09 00:28:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1184, '123123', '123123', '', 1, 1, 1, 0, 46, 14, 1, NULL, NULL, 'uploads/contents/1184019050917004506526nr', 0, '2019-05-09 16:58:34', '2019-05-09 17:00:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1185, NULL, 'anniu001', '', 1, 1, 1, 385, 1, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500001019070219551108056nr.png', 0, '2019-07-02 19:55:12', '2019-07-02 19:55:12');
INSERT INTO `tbl_huijiao_contents` VALUES (1186, NULL, 'level_up', '', 1, 1, 1, 385, 1, 2, 2, 'assets/images/huijiao/tab2/icon2_1.png', NULL, 'uploads/contents/qd0038500001019070219553403791nr.mp3', 0, '2019-07-02 19:55:34', '2019-07-02 19:55:34');
INSERT INTO `tbl_huijiao_contents` VALUES (1187, NULL, 'ns_zjcyj_sp1', '', 1, 1, 1, 385, 1, 2, 2, 'assets/images/huijiao/tab2/icon2.png', NULL, 'uploads/contents/qd0038500001019070219561006127nr.mp4', 0, '2019-07-02 19:56:10', '2019-07-02 19:56:10');
INSERT INTO `tbl_huijiao_contents` VALUES (1188, NULL, 'User Dashboard To Do (1)', '', 1, 1, 1, 385, 1, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500001019072009554504796nr.png', 0, '2019-07-20 09:55:45', '2019-07-20 09:55:45');
INSERT INTO `tbl_huijiao_contents` VALUES (1189, NULL, '008', '', 1, 1, 1, 385, 3, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500003019072216091701744nr.jpg', 0, '2019-07-22 16:09:17', '2019-07-22 16:09:17');
INSERT INTO `tbl_huijiao_contents` VALUES (1190, NULL, '008', '', 1, 1, 1, 385, 1, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500001019072216103102118nr.jpg', 0, '2019-07-22 16:10:31', '2019-07-22 16:10:31');
INSERT INTO `tbl_huijiao_contents` VALUES (1191, NULL, 'images', '', 1, 1, 1, 385, 1, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500001019072216105406705nr.jpg', 0, '2019-07-22 16:10:54', '2019-07-22 16:10:54');
INSERT INTO `tbl_huijiao_contents` VALUES (1192, NULL, '008', '', 1, 1, 1, 385, 1, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500001019072216112007269nr.jpg', 0, '2019-07-22 16:11:20', '2019-07-22 16:11:20');
INSERT INTO `tbl_huijiao_contents` VALUES (1193, '654654654', '654654654', '', 0, 1, 1, 0, 85, 11, 0, 'uploads/content_icons/0019072721505405176fm.png', 'uploads/content_icons/0019072721505405176fm_m.png', NULL, 0, '2019-07-27 21:50:54', '2019-07-27 21:50:54');
INSERT INTO `tbl_huijiao_contents` VALUES (1194, NULL, 'guibtn-sheet0', '', 1, 1, 1, 385, 1, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500001019073116231603953nr.png', 0, '2019-07-31 16:23:16', '2019-07-31 16:23:16');
INSERT INTO `tbl_huijiao_contents` VALUES (1195, NULL, 'xiaoniao1', '', 1, 1, 1, 385, 0, 3, 3, 'assets/images/huijiao/tab2/icon3.png', NULL, 'uploads/contents/qd0038500000019081916073007535nr.png', 0, '2019-08-19 16:07:30', '2019-08-19 16:07:30');
INSERT INTO `tbl_huijiao_contents` VALUES (1196, '345345345', 'werwer', '', 1, 0, 0, 0, 85, 11, 0, 'uploads/content_icons/0019082018243202113fm.png', 'uploads/content_icons/0019082018243202113fm_m.png', 'uploads/content_packages/1196019082018335207738nr.png', 0, '2019-08-20 18:24:32', '2019-08-30 17:18:01');

-- ----------------------------
-- Table structure for tbl_huijiao_course_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_course_type`;
CREATE TABLE `tbl_huijiao_course_type`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `coursetype_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `user_id` int(10) NULL DEFAULT 0,
  `term_id` int(10) NULL DEFAULT NULL,
  `icon_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `icon_path_m` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 295 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_course_type
-- ----------------------------
INSERT INTO `tbl_huijiao_course_type` VALUES (38, 'qd02020201', '十几减9的退位减法', 1, 0, 8, 'uploads/contents/qd02020201019031817552508489kc.png', 'uploads/contents/qd02020201019031817552508489kcm.png', '2019-03-18 13:35:42', '2019-03-18 17:55:25');
INSERT INTO `tbl_huijiao_course_type` VALUES (39, 'qd02020202', '十几减8、7的退位减法', 1, 0, 8, 'uploads/contents/qd02020202019031817555209540kc.png', 'uploads/contents/qd02020202019031817555209540kcm.png', '2019-03-18 13:38:16', '2019-03-18 17:55:52');
INSERT INTO `tbl_huijiao_course_type` VALUES (40, 'qd02020203', '十几减6、5、4、3、2', 1, 0, 8, 'uploads/contents/qd02020203019031817560806891kc.png', 'uploads/contents/qd02020203019031817560806891kcm.png', '2019-03-18 13:40:12', '2019-03-18 17:56:08');
INSERT INTO `tbl_huijiao_course_type` VALUES (41, 'qd02020204', '认识钟表', 1, 0, 8, 'uploads/contents/qd02020204019031817562502436kc.png', 'uploads/contents/qd02020204019031817562502436kcm.png', '2019-03-18 13:40:52', '2019-03-18 17:56:25');
INSERT INTO `tbl_huijiao_course_type` VALUES (42, 'qd02020205', '100以内数的认识', 1, 0, 8, 'uploads/contents/qd02020205019031817563509335kc.png', 'uploads/contents/qd02020205019031817563509335kcm.png', '2019-03-18 13:41:08', '2019-03-18 17:56:35');
INSERT INTO `tbl_huijiao_course_type` VALUES (43, 'qd02020206', '100以内数的大小比较', 1, 0, 8, 'uploads/contents/qd02020206019031817571106463kc.png', 'uploads/contents/qd02020206019031817571106463kcm.png', '2019-03-18 13:41:26', '2019-03-18 17:57:11');
INSERT INTO `tbl_huijiao_course_type` VALUES (44, 'qd02020207', '整十数的加减法', 1, 0, 8, 'uploads/contents/qd02020207019031817573203181kc.png', 'uploads/contents/qd02020207019031817573203181kcm.png', '2019-03-18 13:46:16', '2019-03-18 17:57:32');
INSERT INTO `tbl_huijiao_course_type` VALUES (46, 'bb02010301', '小蝌蚪找妈妈', 0, 0, 3, 'uploads/contents/bb0201030101001019031813473307655kc.png', 'uploads/contents/bb0201030101001019031813473307655kcm.png', '2019-03-18 13:47:33', '2019-03-18 13:48:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (49, 'qd02020210', '认识图形', 1, 0, 8, 'uploads/contents/qd02020210019031817575204313kc.png', 'uploads/contents/qd02020210019031817575204313kcm.png', '2019-03-18 13:50:32', '2019-03-18 17:57:52');
INSERT INTO `tbl_huijiao_course_type` VALUES (50, 'qd02020208', '整十数加减一位数', 1, 0, 8, 'uploads/contents/qd02020208019031817582306676kc.png', 'uploads/contents/qd02020208019031817582306676kcm.png', '2019-03-18 13:51:20', '2019-03-18 17:58:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (51, 'qd02020212', '两位数加一位数和整十数', 1, 0, 8, 'uploads/contents/qd02020212019031817584306256kc.png', 'uploads/contents/qd02020212019031817584306256kcm.png', '2019-03-18 13:52:12', '2019-03-18 17:58:43');
INSERT INTO `tbl_huijiao_course_type` VALUES (52, 'qd02020213', '两位数加一位数进位加', 1, 0, 8, 'uploads/contents/qd02020213019031817590805379kc.png', 'uploads/contents/qd02020213019031817590805379kcm.png', '2019-03-18 13:52:39', '2019-03-18 17:59:08');
INSERT INTO `tbl_huijiao_course_type` VALUES (53, 'qd02020214', '一个数比另一个数多几或少几', 1, 0, 8, 'uploads/contents/qd02020214019031817592707418kc.png', 'uploads/contents/qd02020214019031817592707418kcm.png', '2019-03-18 13:53:25', '2019-03-18 17:59:27');
INSERT INTO `tbl_huijiao_course_type` VALUES (54, 'qd02020215', '两位数减一位数（退位）', 1, 0, 8, 'uploads/contents/qd02020215019031817594207057kc.png', 'uploads/contents/qd02020215019031817594207057kcm.png', '2019-03-18 13:54:14', '2019-03-18 17:59:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (55, 'qd02020216', '认识人民币和人民币的换算', 1, 0, 8, 'uploads/contents/qd02020216019031818001201498kc.png', 'uploads/contents/qd02020216019031818001201498kcm.png', '2019-03-18 13:54:50', '2019-03-18 18:00:12');
INSERT INTO `tbl_huijiao_course_type` VALUES (56, 'qd02020217', '人民币之间的加减法', 1, 0, 8, 'uploads/contents/qd02020217019031818003206064kc.png', 'uploads/contents/qd02020217019031818003206064kcm.png', '2019-03-18 13:55:16', '2019-03-18 18:00:32');
INSERT INTO `tbl_huijiao_course_type` VALUES (57, 'qd02020218', '两位数加两位数（不进位）', 1, 0, 8, 'uploads/contents/qd02020218019031818005208219kc.png', 'uploads/contents/qd02020218019031818005208219kcm.png', '2019-03-18 13:55:40', '2019-03-18 18:00:52');
INSERT INTO `tbl_huijiao_course_type` VALUES (58, 'qd02020219', '两位数减两位数（不退位）', 1, 0, 8, 'uploads/contents/qd0202020719019031818011203787kc.png', 'uploads/contents/qd0202020719019031818011203787kcm.png', '2019-03-18 13:55:58', '2019-03-18 18:01:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (59, 'qd02020220', '两位数加两位数（进位）', 1, 0, 8, 'uploads/contents/qd02020220019031818014107344kc.png', 'uploads/contents/qd02020220019031818014107344kcm.png', '2019-03-18 13:56:22', '2019-03-18 18:01:41');
INSERT INTO `tbl_huijiao_course_type` VALUES (60, 'qd02020221', '两位数减两位数（退位）', 1, 0, 8, 'uploads/contents/qd02020221019031818024801704kc.png', 'uploads/contents/qd02020221019031818024801704kcm.png', '2019-03-18 13:56:56', '2019-03-18 18:02:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (61, 'qd02020222', '100以内连加、连减、加减混合运算', 1, 0, 8, 'uploads/contents/qd02020222019031818030603353kc.png', 'uploads/contents/qd02020222019031818030603353kcm.png', '2019-03-18 13:57:53', '2019-03-18 18:03:06');
INSERT INTO `tbl_huijiao_course_type` VALUES (62, 'qd02020224', '认识长度单位“厘米”', 1, 0, 8, 'uploads/contents/qd02020224019031818032105364kc.png', 'uploads/contents/qd02020224019031818032105364kcm.png', '2019-03-18 13:58:22', '2019-03-18 18:03:21');
INSERT INTO `tbl_huijiao_course_type` VALUES (63, 'qd02020225', '认识长度单位“米”', 1, 0, 8, 'uploads/contents/qd02020225019031818033701303kc.png', 'uploads/contents/qd02020225019031818033701303kcm.png', '2019-03-18 13:58:40', '2019-03-18 18:03:37');
INSERT INTO `tbl_huijiao_course_type` VALUES (64, 'qd02020227', '简单的数据收集和整理', 1, 0, 8, 'uploads/contents/qd02020227019031818035101501kc.png', 'uploads/contents/qd02020227019031818035101501kcm.png', '2019-03-18 13:59:10', '2019-03-18 18:03:51');
INSERT INTO `tbl_huijiao_course_type` VALUES (65, 'bsd03020201', '同底数幂的乘法', 0, 0, 20, 'uploads/contents/bsd02030201019031911530205941kc.png', 'uploads/contents/bsd02030201019031911530205941kcm.png', '2019-03-18 15:25:38', '2019-03-21 16:47:40');
INSERT INTO `tbl_huijiao_course_type` VALUES (66, 'bsd03020202', '幂的乘方与积的乘方', 0, 0, 20, 'uploads/contents/bsd02030202019031913325107210kc.png', 'uploads/contents/bsd02030202019031913325107210kcm.png', '2019-03-18 15:26:32', '2019-03-21 16:48:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (67, 'bsd03020203', '同底数幂的除法', 0, 0, 20, 'uploads/contents/bsd02030203019031913332302961kc.png', 'uploads/contents/bsd02030203019031913332302961kcm.png', '2019-03-18 15:27:08', '2019-03-21 16:49:04');
INSERT INTO `tbl_huijiao_course_type` VALUES (68, 'bsd03020204', '整式的乘法', 0, 0, 20, 'uploads/contents/bsd02030204019031913335607714kc.png', 'uploads/contents/bsd02030204019031913335607714kcm.png', '2019-03-18 15:27:36', '2019-03-21 16:49:17');
INSERT INTO `tbl_huijiao_course_type` VALUES (69, 'bsd03020205', '平方差公式', 0, 0, 20, 'uploads/contents/bsd02030205019031913343003939kc.png', 'uploads/contents/bsd02030205019031913343003939kcm.png', '2019-03-18 15:46:46', '2019-03-21 16:49:31');
INSERT INTO `tbl_huijiao_course_type` VALUES (70, 'bsd03020206', '完全平方公式', 0, 0, 20, 'uploads/contents/bsd02030206019031913345602907kc.png', 'uploads/contents/bsd02030206019031913345602907kcm.png', '2019-03-18 15:47:35', '2019-03-21 16:49:44');
INSERT INTO `tbl_huijiao_course_type` VALUES (71, 'bsd03020207', '整式的除法', 0, 0, 20, 'uploads/contents/bsd02030207019031913353106367kc.png', 'uploads/contents/bsd02030207019031913353106367kcm.png', '2019-03-18 15:48:39', '2019-03-21 16:50:08');
INSERT INTO `tbl_huijiao_course_type` VALUES (72, 'bsd03020208', '两条直线的位置关系', 0, 0, 20, 'uploads/contents/bsd02030208019031913362406642kc.png', 'uploads/contents/bsd02030208019031913362406642kcm.png', '2019-03-18 15:49:11', '2019-03-21 16:50:27');
INSERT INTO `tbl_huijiao_course_type` VALUES (73, 'bsd03020209', '探索直线平行的条件', 0, 0, 20, 'uploads/contents/bsd02030209019031913365207957kc.png', 'uploads/contents/bsd02030209019031913365207957kcm.png', '2019-03-18 15:49:56', '2019-03-21 16:50:46');
INSERT INTO `tbl_huijiao_course_type` VALUES (74, 'bsd03020210', '平行线的性质', 0, 0, 20, 'uploads/contents/bsd02030210019031913371908435kc.png', 'uploads/contents/bsd02030210019031913371908435kcm.png', '2019-03-18 15:50:43', '2019-03-21 16:51:01');
INSERT INTO `tbl_huijiao_course_type` VALUES (75, 'bsd03020211', '用尺规作角', 0, 0, 20, 'uploads/contents/bsd02030211019031913375608303kc.png', 'uploads/contents/bsd02030211019031913375608303kcm.png', '2019-03-18 15:51:23', '2019-03-21 16:51:21');
INSERT INTO `tbl_huijiao_course_type` VALUES (76, 'bsd03020212', '认识三角形', 0, 0, 20, 'uploads/contents/bsd02030212019031913382801202kc.png', 'uploads/contents/bsd02030212019031913382801202kcm.png', '2019-03-18 15:52:02', '2019-03-21 16:51:35');
INSERT INTO `tbl_huijiao_course_type` VALUES (77, 'bsd03020213', '图形的全等', 0, 0, 20, 'uploads/contents/bsd02030213019031913390205206kc.png', 'uploads/contents/bsd02030213019031913390205206kcm.png', '2019-03-18 15:52:54', '2019-03-21 16:51:49');
INSERT INTO `tbl_huijiao_course_type` VALUES (78, 'bsd03020214', '探索三角形全等的条件', 0, 0, 20, 'uploads/contents/bsd02030214019031913544308357kc.png', 'uploads/contents/bsd02030214019031913544308357kcm.png', '2019-03-19 13:54:43', '2019-03-21 16:52:02');
INSERT INTO `tbl_huijiao_course_type` VALUES (79, 'bsd03020215', '用尺规作三角形', 0, 0, 20, 'uploads/contents/bsd02030215019031913554407313kc.png', 'uploads/contents/bsd02030215019031913554407313kcm.png', '2019-03-19 13:55:44', '2019-03-21 16:52:14');
INSERT INTO `tbl_huijiao_course_type` VALUES (80, 'bsd03020216', '利用三角形全等测距离', 0, 0, 20, 'uploads/contents/bsd02030216019031913572108242kc.png', 'uploads/contents/bsd02030216019031913572108242kcm.png', '2019-03-19 13:57:21', '2019-03-21 16:52:30');
INSERT INTO `tbl_huijiao_course_type` VALUES (81, 'bsd03020217', '用表格表示的变量间关系', 0, 0, 20, 'uploads/contents/bsd02030217019031913581004595kc.png', 'uploads/contents/bsd02030217019031913581004595kcm.png', '2019-03-19 13:58:10', '2019-03-21 16:52:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (82, 'bsd03020218', '用关系式表示的变量间关系', 0, 0, 20, 'uploads/contents/bsd02030218019031913594808157kc.png', 'uploads/contents/bsd02030218019031913594808157kcm.png', '2019-03-19 13:59:48', '2019-03-21 16:52:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (83, 'bsd03020219', '用图象表示的变量间关系', 0, 0, 20, 'uploads/contents/bsd02030219019031914004403447kc.png', 'uploads/contents/bsd02030219019031914004403447kcm.png', '2019-03-19 14:00:44', '2019-03-21 16:53:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (84, 'bsd03020220', '轴对称现象', 0, 0, 20, 'uploads/contents/bsd02030220019031914014109108kc.png', 'uploads/contents/bsd02030220019031914014109108kcm.png', '2019-03-19 14:01:41', '2019-03-21 16:53:19');
INSERT INTO `tbl_huijiao_course_type` VALUES (85, 'bb02010302', '我是什么', 1, 0, 3, 'uploads/contents/bb02010302019031914015401302kc.png', 'uploads/contents/bb02010302019031914015401302kcm.png', '2019-03-19 14:01:54', '2019-03-19 14:01:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (86, 'bb02010303', '植物妈妈有办法', 1, 0, 3, 'uploads/contents/bb02010303019031914022901979kc.png', 'uploads/contents/bb02010303019031914022901979kcm.png', '2019-03-19 14:02:29', '2019-03-19 14:02:29');
INSERT INTO `tbl_huijiao_course_type` VALUES (87, 'bsd03020221', '探索轴对称的性质', 1, 0, 20, 'uploads/contents/bsd02030221019031914023002577kc.png', 'uploads/contents/bsd02030221019031914023002577kcm.png', '2019-03-19 14:02:30', '2019-03-21 16:53:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (88, 'bb02010304', '场景歌', 1, 0, 3, 'uploads/contents/bb02010304019031914025809617kc.png', 'uploads/contents/bb02010304019031914025809617kcm.png', '2019-03-19 14:02:58', '2019-03-19 14:02:58');
INSERT INTO `tbl_huijiao_course_type` VALUES (89, 'bb02010305', '树之歌', 1, 0, 3, 'uploads/contents/bb02010305019031914032406711kc.png', 'uploads/contents/bb02010305019031914032406711kcm.png', '2019-03-19 14:03:24', '2019-03-19 14:03:24');
INSERT INTO `tbl_huijiao_course_type` VALUES (90, 'bsd03020222', '简单的轴对称图形', 1, 0, 20, 'uploads/contents/bsd02030222019031914032808097kc.png', 'uploads/contents/bsd02030222019031914032808097kcm.png', '2019-03-19 14:03:28', '2019-03-21 16:54:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (91, 'bsd03020223', '利用轴对称进行设计', 1, 0, 20, 'uploads/contents/bsd02030223019031914043105365kc.png', 'uploads/contents/bsd02030223019031914043105365kcm.png', '2019-03-19 14:04:31', '2019-03-21 16:54:31');
INSERT INTO `tbl_huijiao_course_type` VALUES (92, 'bb02010306', '拍手歌', 1, 0, 3, 'uploads/contents/bb02010306019031914044306924kc.png', 'uploads/contents/bb02010306019031914044306924kcm.png', '2019-03-19 14:04:43', '2019-03-19 14:04:43');
INSERT INTO `tbl_huijiao_course_type` VALUES (93, 'bb02010307', '田家四季歌', 1, 0, 3, 'uploads/contents/bb02010307019031914045007122kc.png', 'uploads/contents/bb02010307019031914045007122kcm.png', '2019-03-19 14:04:50', '2019-03-19 14:04:50');
INSERT INTO `tbl_huijiao_course_type` VALUES (94, 'bb02010308', '曹冲称象', 1, 0, 3, 'uploads/contents/bb02010308019031914053202446kc.png', 'uploads/contents/bb02010308019031914053202446kcm.png', '2019-03-19 14:05:32', '2019-03-19 14:05:32');
INSERT INTO `tbl_huijiao_course_type` VALUES (95, 'bb02010309', '玲玲的画', 1, 0, 3, 'uploads/contents/bb02010309019031914055301113kc.png', 'uploads/contents/bb02010309019031914055301113kcm.png', '2019-03-19 14:05:53', '2019-03-19 14:05:53');
INSERT INTO `tbl_huijiao_course_type` VALUES (96, 'bb02010311', '妈妈睡了', 1, 0, 3, 'uploads/contents/bb02010311019031914063702047kc.png', 'uploads/contents/bb02010311019031914063702047kcm.png', '2019-03-19 14:06:37', '2019-03-19 14:06:37');
INSERT INTO `tbl_huijiao_course_type` VALUES (97, 'bb02010310', '一封信', 1, 0, 3, 'uploads/contents/bb02010310019031914064001549kc.png', 'uploads/contents/bb02010310019031914064001549kcm.png', '2019-03-19 14:06:40', '2019-03-19 14:06:40');
INSERT INTO `tbl_huijiao_course_type` VALUES (98, 'bb02010312', '古诗二首-登鹳雀楼，望庐山瀑布', 1, 0, 3, 'uploads/contents/bb02010312019031920500902428kc.png', 'uploads/contents/bb02010312019031920500902428kcm.png', '2019-03-19 14:07:19', '2019-03-19 20:50:09');
INSERT INTO `tbl_huijiao_course_type` VALUES (99, 'bb02010313', '黄山奇石', 1, 0, 3, 'uploads/contents/bb02010313019031914075702917kc.png', 'uploads/contents/bb02010313019031914075702917kcm.png', '2019-03-19 14:07:57', '2019-03-19 14:07:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (100, 'bb02010314', '日月潭', 1, 0, 3, 'uploads/contents/bb02010314019031914082805167kc.png', 'uploads/contents/bb02010314019031914082805167kcm.png', '2019-03-19 14:08:28', '2019-03-19 14:08:28');
INSERT INTO `tbl_huijiao_course_type` VALUES (101, 'bb02010315', '葡萄沟', 1, 0, 3, 'uploads/contents/bb02010315019031914085008361kc.png', 'uploads/contents/bb02010315019031914085008361kcm.png', '2019-03-19 14:08:50', '2019-03-19 14:08:50');
INSERT INTO `tbl_huijiao_course_type` VALUES (102, 'bb02010316', '坐井观天', 1, 0, 3, 'uploads/contents/bb02010316019031914091508190kc.png', 'uploads/contents/bb02010316019031914091508190kcm.png', '2019-03-19 14:09:15', '2019-03-19 14:09:15');
INSERT INTO `tbl_huijiao_course_type` VALUES (103, 'bb02010317', '寒号鸟', 1, 0, 3, 'uploads/contents/bb02010317019031914093304262kc.png', 'uploads/contents/bb02010317019031914093304262kcm.png', '2019-03-19 14:09:33', '2019-03-19 14:09:33');
INSERT INTO `tbl_huijiao_course_type` VALUES (104, 'bb02010318', '我要的是葫芦', 1, 0, 3, 'uploads/contents/bb02010318019031914095302202kc.png', 'uploads/contents/bb02010318019031914095302202kcm.png', '2019-03-19 14:09:53', '2019-03-19 14:09:53');
INSERT INTO `tbl_huijiao_course_type` VALUES (105, 'bb02010319', '大禹治水', 1, 0, 3, 'uploads/contents/bb02010319019031914101406687kc.png', 'uploads/contents/bb02010319019031914101406687kcm.png', '2019-03-19 14:10:14', '2019-03-19 14:10:14');
INSERT INTO `tbl_huijiao_course_type` VALUES (106, 'bb02010320', '朱德的扁担', 1, 0, 3, 'uploads/contents/bb02010320019031914103401045kc.png', 'uploads/contents/bb02010320019031914103401045kcm.png', '2019-03-19 14:10:34', '2019-03-19 14:10:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (107, 'bb02010321', '难忘的泼水节', 1, 0, 3, 'uploads/contents/bb02010321019031914110302406kc.png', 'uploads/contents/bb02010321019031914110302406kcm.png', '2019-03-19 14:11:03', '2019-03-19 14:11:03');
INSERT INTO `tbl_huijiao_course_type` VALUES (108, 'bb02010322', '古诗二首-夜宿山寺，敕勒歌', 1, 0, 3, 'uploads/contents/bb02010322019031920514501737kc.png', 'uploads/contents/bb02010322019031920514501737kcm.png', '2019-03-19 14:11:24', '2019-03-19 20:51:45');
INSERT INTO `tbl_huijiao_course_type` VALUES (109, 'bb02010323', '雾在哪里', 1, 0, 3, 'uploads/contents/bb02010323019031914114807731kc.png', 'uploads/contents/bb02010323019031914114807731kcm.png', '2019-03-19 14:11:48', '2019-03-19 14:11:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (110, 'bb02010324', '雪孩子', 1, 0, 3, 'uploads/contents/bb02010324019031914120808491kc.png', 'uploads/contents/bb02010324019031914120808491kcm.png', '2019-03-19 14:12:08', '2019-03-19 14:12:08');
INSERT INTO `tbl_huijiao_course_type` VALUES (111, 'bsd03020224', '感受可能性', 1, 0, 20, 'uploads/contents/bsd02030224019031914121901638kc.png', 'uploads/contents/bsd02030224019031914121901638kcm.png', '2019-03-19 14:12:19', '2019-03-21 16:54:44');
INSERT INTO `tbl_huijiao_course_type` VALUES (112, 'bb02010325', '狐假虎威', 1, 0, 3, 'uploads/contents/bb02010325019031914122805513kc.png', 'uploads/contents/bb02010325019031914122805513kcm.png', '2019-03-19 14:12:28', '2019-03-19 14:12:28');
INSERT INTO `tbl_huijiao_course_type` VALUES (113, 'bb02010326', '狐狸分奶酪', 1, 0, 3, 'uploads/contents/bb02010326019031914124903167kc.png', 'uploads/contents/bb02010326019031914124903167kcm.png', '2019-03-19 14:12:49', '2019-03-19 14:12:49');
INSERT INTO `tbl_huijiao_course_type` VALUES (114, 'bsd03020225', '频率的稳定性', 1, 0, 20, 'uploads/contents/bsd02030225019031914130905162kc.png', 'uploads/contents/bsd02030225019031914130905162kcm.png', '2019-03-19 14:13:09', '2019-03-21 16:54:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (115, 'bb02010327', '纸船和风筝', 1, 0, 3, 'uploads/contents/bb02010327019031914131606401kc.png', 'uploads/contents/bb02010327019031914131606401kcm.png', '2019-03-19 14:13:16', '2019-03-19 14:13:16');
INSERT INTO `tbl_huijiao_course_type` VALUES (116, 'bb02010328', '风娃娃', 1, 0, 3, 'uploads/contents/bb02010328019031914133806263kc.png', 'uploads/contents/bb02010328019031914133806263kcm.png', '2019-03-19 14:13:38', '2019-03-19 14:13:38');
INSERT INTO `tbl_huijiao_course_type` VALUES (117, 'bsd03020226', '等可能事件的概率', 1, 0, 20, 'uploads/contents/bsd02030226019031914140205505kc.png', 'uploads/contents/bsd02030226019031914140205505kcm.png', '2019-03-19 14:14:02', '2019-03-21 16:55:10');
INSERT INTO `tbl_huijiao_course_type` VALUES (119, 'rj03040401', '力', 1, 0, 26, 'uploads/contents/rj03040401019031915203109166kc.png', 'uploads/contents/rj03040401019031915203109166kcm.png', '2019-03-19 15:20:31', '2019-03-19 15:20:31');
INSERT INTO `tbl_huijiao_course_type` VALUES (120, 'rj03040402', '弹力', 1, 0, 26, 'uploads/contents/rj03040402019031916054203605kc.png', 'uploads/contents/rj03040402019031916054203605kcm.png', '2019-03-19 16:05:42', '2019-03-19 16:05:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (121, 'rj03040403', '重力', 1, 0, 26, 'uploads/contents/rj03040403019031916115006048kc.png', 'uploads/contents/rj03040403019031916125409836kcm.png', '2019-03-19 16:10:52', '2019-03-19 16:12:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (123, 'rj03040405', '二力平衡', 1, 0, 26, 'uploads/contents/rj03040405019031916150703833kc.png', 'uploads/contents/rj03040405019031916295409379kcm.png', '2019-03-19 16:15:07', '2019-03-19 16:29:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (125, 'rj03040407', '压强', 1, 0, 26, 'uploads/contents/rj03040407019031916165601227kc.png', 'uploads/contents/rj03040407019031916310602859kcm.png', '2019-03-19 16:16:56', '2019-03-19 16:31:06');
INSERT INTO `tbl_huijiao_course_type` VALUES (126, 'rj03040408', '液体的压强 ', 1, 0, 26, 'uploads/contents/rj03040408019031916173701134kc.png', 'uploads/contents/rj03040408019031916305307942kcm.png', '2019-03-19 16:17:37', '2019-03-19 16:30:53');
INSERT INTO `tbl_huijiao_course_type` VALUES (127, 'rj03040409', '大气压强', 1, 0, 26, 'uploads/contents/rj03040409019031916183607745kc.png', 'uploads/contents/rj03040409019031916312509664kcm.png', '2019-03-19 16:18:36', '2019-03-19 16:31:25');
INSERT INTO `tbl_huijiao_course_type` VALUES (128, 'rj03040410', '流体压强与流速的关系', 1, 0, 26, 'uploads/contents/rj03040410019031916190703313kc.png', 'uploads/contents/rj03040410019031916313402747kcm.png', '2019-03-19 16:19:07', '2019-03-19 16:31:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (129, 'rj03040411', '浮力', 1, 0, 26, 'uploads/contents/rj03040411019031916194903917kc.png', 'uploads/contents/rj03040411019031916315007554kcm.png', '2019-03-19 16:19:49', '2019-03-19 16:31:50');
INSERT INTO `tbl_huijiao_course_type` VALUES (130, 'rj03040412', '阿基米德原理', 1, 0, 26, 'uploads/contents/rj03040412019031916202606989kc.png', 'uploads/contents/rj03040412019031916315703595kcm.png', '2019-03-19 16:20:26', '2019-03-19 16:31:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (131, 'rj03040413', '物体的浮沉条件及应用', 1, 0, 26, 'uploads/contents/rj03040413019031916205508469kc.png', 'uploads/contents/rj03040413019031916320409193kcm.png', '2019-03-19 16:20:55', '2019-03-19 16:32:04');
INSERT INTO `tbl_huijiao_course_type` VALUES (132, 'rj03040414', '功', 1, 0, 26, 'uploads/contents/rj03040414019031916213201450kc.png', 'uploads/contents/rj03040414019031916321308674kcm.png', '2019-03-19 16:21:32', '2019-03-19 16:52:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (133, 'rj03040415', '功率', 1, 0, 26, 'uploads/contents/rj03040415019031916220002835kc.png', 'uploads/contents/rj03040415019031916322203008kcm.png', '2019-03-19 16:22:00', '2019-03-19 16:32:22');
INSERT INTO `tbl_huijiao_course_type` VALUES (134, 'rj03040416', '动能和势能', 1, 0, 26, 'uploads/contents/rj03040416019031916222507834kc.png', 'uploads/contents/rj03040416019031916323606945kcm.png', '2019-03-19 16:22:25', '2019-03-19 16:32:40');
INSERT INTO `tbl_huijiao_course_type` VALUES (135, 'rj03040417', '机械能及其转化', 1, 0, 26, 'uploads/contents/rj03040417019031916230704890kc.png', 'uploads/contents/rj03040417019031916324801655kcm.png', '2019-03-19 16:23:07', '2019-03-19 16:32:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (136, 'rj03040418', '杠杆', 1, 0, 26, 'uploads/contents/rj03040418019031916233204070kc.png', 'uploads/contents/rj03040418019031916330107510kcm.png', '2019-03-19 16:23:32', '2019-03-19 16:33:01');
INSERT INTO `tbl_huijiao_course_type` VALUES (137, 'rj03040419', '滑轮', 1, 0, 26, 'uploads/contents/rj03040419019031916240009165kc.png', 'uploads/contents/rj03040419019031916330707077kcm.png', '2019-03-19 16:24:00', '2019-03-19 16:33:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (138, 'rj03040420', '机械效率', 1, 0, 26, 'uploads/contents/rj03040420019031916242606006kc.png', 'uploads/contents/rj03040420019031916331405384kcm.png', '2019-03-19 16:24:26', '2019-03-19 20:06:38');
INSERT INTO `tbl_huijiao_course_type` VALUES (139, 'qd02020101', '1-5的认识', 1, 0, 7, '', '', '2019-03-19 19:47:42', '2019-03-19 19:52:56');
INSERT INTO `tbl_huijiao_course_type` VALUES (140, 'qd02020102', '0的认识', 1, 0, 7, '', '', '2019-03-19 19:49:14', '2019-03-19 19:49:14');
INSERT INTO `tbl_huijiao_course_type` VALUES (141, 'qd02020103', '6-10的认识', 1, 0, 7, '', '', '2019-03-19 19:49:44', '2019-03-19 19:49:44');
INSERT INTO `tbl_huijiao_course_type` VALUES (142, 'qd02020104', '10以内数的大小比较', 1, 0, 7, '', '', '2019-03-19 19:50:27', '2019-03-19 19:50:27');
INSERT INTO `tbl_huijiao_course_type` VALUES (143, 'qd02020106', '分类', 1, 0, 7, '', '', '2019-03-19 19:51:13', '2019-03-19 19:51:13');
INSERT INTO `tbl_huijiao_course_type` VALUES (144, 'qd02020107', '比较', 1, 0, 7, '', '', '2019-03-19 19:51:55', '2019-03-19 19:51:55');
INSERT INTO `tbl_huijiao_course_type` VALUES (145, 'qd02020108', '5以内的加法', 1, 0, 7, '', '', '2019-03-19 19:52:21', '2019-03-19 19:52:21');
INSERT INTO `tbl_huijiao_course_type` VALUES (146, 'qd02020109', '5以内的减法', 1, 0, 7, '', '', '2019-03-19 19:52:52', '2019-03-19 19:52:52');
INSERT INTO `tbl_huijiao_course_type` VALUES (147, 'qd02020110', '6、7的加法', 1, 0, 7, '', '', '2019-03-19 19:53:33', '2019-03-19 19:53:33');
INSERT INTO `tbl_huijiao_course_type` VALUES (148, 'qd02020111', '6、7的减法', 1, 0, 7, '', '', '2019-03-19 19:54:00', '2019-03-19 19:54:00');
INSERT INTO `tbl_huijiao_course_type` VALUES (149, 'qd02020112', '8、9的加减法', 1, 0, 7, '', '', '2019-03-19 19:54:27', '2019-03-19 19:54:27');
INSERT INTO `tbl_huijiao_course_type` VALUES (150, 'qd02020113', '10的组成和加减法', 1, 0, 7, '', '', '2019-03-19 19:54:55', '2019-03-19 19:54:55');
INSERT INTO `tbl_huijiao_course_type` VALUES (151, 'qd02020114', '连加连减', 1, 0, 7, '', '', '2019-03-19 19:55:57', '2019-03-19 19:55:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (152, 'qd02020115', '加减混合', 1, 0, 7, '', '', '2019-03-19 19:56:23', '2019-03-19 19:56:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (153, 'qd02020116', '认识位置', 1, 0, 7, '', '', '2019-03-19 19:56:49', '2019-03-19 19:56:49');
INSERT INTO `tbl_huijiao_course_type` VALUES (154, 'qd02020118', '认识11-20', 1, 0, 7, '', '', '2019-03-19 19:57:22', '2019-03-19 19:57:22');
INSERT INTO `tbl_huijiao_course_type` VALUES (155, 'qd02020119', '20以内的不进位加法和不退位减法', 1, 0, 7, '', '', '2019-03-19 19:58:36', '2019-03-19 19:58:36');
INSERT INTO `tbl_huijiao_course_type` VALUES (156, 'qd02020121', '认识图形', 1, 0, 7, '', '', '2019-03-19 19:59:54', '2019-03-19 19:59:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (157, 'qd02020123', '9加几', 1, 0, 7, '', '', '2019-03-19 20:02:07', '2019-03-19 20:02:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (159, 'qd02020124', '8加几', 1, 0, 7, '', '', '2019-03-19 20:02:36', '2019-03-19 20:02:36');
INSERT INTO `tbl_huijiao_course_type` VALUES (160, 'qd02020125', '7和6加几', 1, 0, 7, '', '', '2019-03-19 20:03:01', '2019-03-19 20:03:01');
INSERT INTO `tbl_huijiao_course_type` VALUES (161, 'qd02020301', '求几个相同加数的和', 1, 0, 9, '', '', '2019-03-19 20:03:53', '2019-03-19 20:03:53');
INSERT INTO `tbl_huijiao_course_type` VALUES (162, 'qd02020302', '乘法的初步认识', 1, 0, 9, '', '', '2019-03-19 20:04:20', '2019-03-19 20:04:20');
INSERT INTO `tbl_huijiao_course_type` VALUES (163, 'qd02020303', '1和0的乘法', 1, 0, 9, '', '', '2019-03-19 20:04:48', '2019-03-19 20:04:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (164, 'qd02020304', '5的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:05:18', '2019-03-19 20:05:18');
INSERT INTO `tbl_huijiao_course_type` VALUES (165, 'qd02020305', '2的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:05:49', '2019-03-19 20:05:49');
INSERT INTO `tbl_huijiao_course_type` VALUES (166, 'qd02020306', '3、4的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:06:17', '2019-03-19 20:06:17');
INSERT INTO `tbl_huijiao_course_type` VALUES (167, 'qd02020307', '乘法加和乘法减', 1, 0, 9, '', '', '2019-03-19 20:06:39', '2019-03-19 20:06:39');
INSERT INTO `tbl_huijiao_course_type` VALUES (168, 'qd02020308', '角的初步认识', 1, 0, 9, '', '', '2019-03-19 20:07:02', '2019-03-19 20:07:02');
INSERT INTO `tbl_huijiao_course_type` VALUES (169, 'qd02020309', '认识锐角和钝角', 1, 0, 9, '', '', '2019-03-19 20:07:34', '2019-03-19 20:07:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (170, 'qd02020311', '6的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:08:04', '2019-03-19 20:08:04');
INSERT INTO `tbl_huijiao_course_type` VALUES (171, 'qd02020312', '7的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:08:30', '2019-03-19 20:08:30');
INSERT INTO `tbl_huijiao_course_type` VALUES (172, 'qd02020313', '8的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:08:58', '2019-03-19 20:08:58');
INSERT INTO `tbl_huijiao_course_type` VALUES (173, 'qd02020314', '求一个数的几倍是多少', 1, 0, 9, '', '', '2019-03-19 20:09:21', '2019-03-19 20:09:21');
INSERT INTO `tbl_huijiao_course_type` VALUES (174, 'qd02020315', '9的乘法口诀', 1, 0, 9, '', '', '2019-03-19 20:09:50', '2019-03-19 20:09:50');
INSERT INTO `tbl_huijiao_course_type` VALUES (175, 'qd02020317', '平均分', 1, 0, 9, '', '', '2019-03-19 20:10:18', '2019-03-19 20:10:18');
INSERT INTO `tbl_huijiao_course_type` VALUES (176, 'qd02020318', '按份数和按个数平均分', 1, 0, 9, '', '', '2019-03-19 20:10:44', '2019-03-19 20:10:44');
INSERT INTO `tbl_huijiao_course_type` VALUES (177, 'qd02020319', '除法的初步认识', 1, 0, 9, '', '', '2019-03-19 20:11:10', '2019-03-19 20:11:10');
INSERT INTO `tbl_huijiao_course_type` VALUES (178, 'qd02020320', '0的除法', 1, 0, 9, '', '', '2019-03-19 20:11:35', '2019-03-19 20:11:35');
INSERT INTO `tbl_huijiao_course_type` VALUES (179, 'qd02020321', '认识东西南北', 1, 0, 9, '', '', '2019-03-19 20:11:59', '2019-03-19 20:11:59');
INSERT INTO `tbl_huijiao_course_type` VALUES (180, 'qd02020323', '除法的竖式计算', 1, 0, 9, '', '', '2019-03-19 20:12:42', '2019-03-19 20:12:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (181, 'rj03040404 ', '牛顿第一定律', 1, 0, 26, 'uploads/contents/r019031920124708950kc.png', 'uploads/contents/r019031920131801901kcm.png', '2019-03-19 20:12:47', '2019-03-19 20:14:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (182, 'qd02020324', '口诀求商', 1, 0, 9, '', '', '2019-03-19 20:13:12', '2019-03-19 20:13:12');
INSERT INTO `tbl_huijiao_course_type` VALUES (183, 'qd02020325', '一个数是另一个数的几倍', 1, 0, 9, '', '', '2019-03-19 20:13:38', '2019-03-19 20:13:38');
INSERT INTO `tbl_huijiao_course_type` VALUES (184, 'qd02020326', '连乘连除乘除混合', 1, 0, 9, '', '', '2019-03-19 20:14:06', '2019-03-19 20:14:06');
INSERT INTO `tbl_huijiao_course_type` VALUES (185, 'qd02020401', '有余数除法的认识', 1, 0, 10, '', '', '2019-03-19 20:17:29', '2019-03-19 20:17:29');
INSERT INTO `tbl_huijiao_course_type` VALUES (186, 'qd02020402', '有余数除法的笔算', 1, 0, 10, '', '', '2019-03-19 20:17:57', '2019-03-19 20:17:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (187, 'qd02020404', '千以内数的认识', 1, 0, 10, '', '', '2019-03-19 20:19:17', '2019-03-19 20:19:17');
INSERT INTO `tbl_huijiao_course_type` VALUES (188, 'qd02020405', '万以内数的认识', 1, 0, 10, '', '', '2019-03-19 20:19:42', '2019-03-19 20:19:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (189, 'qd02020406', '近似数', 1, 0, 10, '', '', '2019-03-19 20:20:07', '2019-03-19 20:20:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (190, 'qd02020407', '整十、整百、整千的加减法', 1, 0, 10, '', '', '2019-03-19 20:20:31', '2019-03-19 20:20:31');
INSERT INTO `tbl_huijiao_course_type` VALUES (191, 'qd02020408', '大约和估计数', 1, 0, 10, '', '', '2019-03-19 20:20:55', '2019-03-19 20:20:55');
INSERT INTO `tbl_huijiao_course_type` VALUES (192, 'qd02020409', '毫米、分米的认识和换算', 1, 0, 10, '', '', '2019-03-19 20:21:16', '2019-03-19 20:21:16');
INSERT INTO `tbl_huijiao_course_type` VALUES (193, 'qd02020410', '千米的认识', 1, 0, 10, '', '', '2019-03-19 20:21:40', '2019-03-19 20:21:40');
INSERT INTO `tbl_huijiao_course_type` VALUES (194, 'qd02020412', '两位数加减两位数', 1, 0, 10, '', '', '2019-03-19 20:22:05', '2019-03-19 20:22:05');
INSERT INTO `tbl_huijiao_course_type` VALUES (195, 'qd02020413', '三位数加减三位数（不进位不退位）', 1, 0, 10, '', '', '2019-03-19 20:22:34', '2019-03-19 20:22:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (196, 'qd02020414', '三位数加减三位数（一次进位退位）', 1, 0, 10, '', '', '2019-03-19 20:22:58', '2019-03-19 20:22:58');
INSERT INTO `tbl_huijiao_course_type` VALUES (197, 'qd02020415', '三位数加减的验算', 1, 0, 10, '', '', '2019-03-19 20:23:33', '2019-03-19 20:23:33');
INSERT INTO `tbl_huijiao_course_type` VALUES (198, 'qd02020416', '三位数加减法的应用', 1, 0, 10, '', '', '2019-03-19 20:23:58', '2019-03-19 20:23:58');
INSERT INTO `tbl_huijiao_course_type` VALUES (199, 'qd02020417', '不同角度观察物体', 1, 0, 10, '', '', '2019-03-19 20:24:21', '2019-03-19 20:24:21');
INSERT INTO `tbl_huijiao_course_type` VALUES (200, 'qd02020418', '三位数加减三位数（进位，退位）', 1, 0, 10, '', '', '2019-03-19 20:24:48', '2019-03-19 20:24:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (201, 'qd02020419', '中间或末尾有0的三位数减三位数', 1, 0, 10, '', '', '2019-03-19 20:25:10', '2019-03-19 20:25:10');
INSERT INTO `tbl_huijiao_course_type` VALUES (202, 'qd02020420', '三位数加减三位数的实际应用', 1, 0, 10, '', '', '2019-03-19 20:25:35', '2019-03-19 20:25:35');
INSERT INTO `tbl_huijiao_course_type` VALUES (203, 'qd02020421', '三位数加减混合运算', 1, 0, 10, '', '', '2019-03-19 20:26:33', '2019-03-19 20:26:33');
INSERT INTO `tbl_huijiao_course_type` VALUES (204, 'qd02020423', '长方形和正方形的特征', 1, 0, 10, '', '', '2019-03-19 20:26:55', '2019-03-19 20:26:55');
INSERT INTO `tbl_huijiao_course_type` VALUES (205, 'qd02020424', '图形的拼组', 1, 0, 10, '', '', '2019-03-19 20:27:32', '2019-03-19 20:27:32');
INSERT INTO `tbl_huijiao_course_type` VALUES (206, 'qd02020425', '分步解决两步计算的乘加/乘减问题', 1, 0, 10, '', '', '2019-03-19 20:27:58', '2019-03-19 20:27:58');
INSERT INTO `tbl_huijiao_course_type` VALUES (207, 'rj03040406 ', '摩擦力', 1, 0, 26, 'uploads/contents/r019031920280002946kc.png', 'uploads/contents/r019031920280002946kcm.png', '2019-03-19 20:28:00', '2019-03-19 20:28:41');
INSERT INTO `tbl_huijiao_course_type` VALUES (208, 'qd02020426', '分步解决两步计算的乘除问题', 1, 0, 10, '', '', '2019-03-19 20:28:22', '2019-03-19 20:28:22');
INSERT INTO `tbl_huijiao_course_type` VALUES (209, 'qd02020427', '数据的收集', 1, 0, 10, '', '', '2019-03-19 20:28:50', '2019-03-19 20:28:50');
INSERT INTO `tbl_huijiao_course_type` VALUES (210, 'qd02020428', '数据的整理与分析', 1, 0, 10, '', '', '2019-03-19 20:29:25', '2019-03-19 20:29:25');
INSERT INTO `tbl_huijiao_course_type` VALUES (211, 'rj03040301', '长度和时间的测量', 1, 0, 35, '', '', '2019-03-21 13:33:52', '2019-03-21 13:33:52');
INSERT INTO `tbl_huijiao_course_type` VALUES (212, 'rj03040302', '运动的描述 ', 0, 0, 35, '', '', '2019-03-21 13:35:31', '2019-05-09 10:52:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (213, 'rj03040303 ', '运动的快慢', 1, 0, 35, '', '', '2019-03-21 13:36:34', '2019-03-21 13:36:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (214, 'rj03040304 ', '测量平均速度', 1, 0, 35, '', '', '2019-03-21 13:37:55', '2019-03-21 13:37:55');
INSERT INTO `tbl_huijiao_course_type` VALUES (215, 'rj03040305 ', '声音的产生与传播', 1, 0, 35, '', '', '2019-03-21 13:38:12', '2019-03-21 13:38:12');
INSERT INTO `tbl_huijiao_course_type` VALUES (216, 'rj03040306 ', '声音的特性', 1, 0, 35, '', '', '2019-03-21 13:38:33', '2019-03-21 13:38:33');
INSERT INTO `tbl_huijiao_course_type` VALUES (217, 'rj03040307 ', '声的利用', 1, 0, 35, '', '', '2019-03-21 13:38:48', '2019-03-21 13:38:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (218, 'rj03040308 ', '噪声的危害和控制', 0, 0, 1, '', '', '2019-03-21 13:39:03', '2019-03-21 13:39:03');
INSERT INTO `tbl_huijiao_course_type` VALUES (219, 'rj03040309 ', '温度', 0, 0, 1, '', '', '2019-03-21 13:39:12', '2019-03-21 13:39:12');
INSERT INTO `tbl_huijiao_course_type` VALUES (220, 'qd02020501', '克、千克的认识', 1, 0, 11, '', '', '2019-03-21 13:39:45', '2019-03-21 13:39:45');
INSERT INTO `tbl_huijiao_course_type` VALUES (221, 'rj03040308 ', '噪声的危害和控制', 1, 0, 35, '', '', '2019-03-21 13:39:53', '2019-03-21 13:39:53');
INSERT INTO `tbl_huijiao_course_type` VALUES (222, 'rj03040309 ', '温度', 1, 0, 35, '', '', '2019-03-21 13:40:13', '2019-03-21 13:40:13');
INSERT INTO `tbl_huijiao_course_type` VALUES (223, 'qd02020502', '质量单位换算和“吨”的认识', 1, 0, 11, '', '', '2019-03-21 13:40:23', '2019-03-21 13:40:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (224, 'rj03040310', '熔化和凝固', 1, 0, 35, '', '', '2019-03-21 13:40:37', '2019-03-21 13:40:37');
INSERT INTO `tbl_huijiao_course_type` VALUES (225, 'rj03040311 ', '汽化和液化', 0, 0, 1, '', '', '2019-03-21 13:40:49', '2019-03-21 13:40:49');
INSERT INTO `tbl_huijiao_course_type` VALUES (226, 'qd02020503', '质量单位的应用', 1, 0, 11, '', '', '2019-03-21 13:40:57', '2019-03-21 13:40:57');
INSERT INTO `tbl_huijiao_course_type` VALUES (227, 'rj03040312 ', '升华和凝华', 1, 0, 35, '', '', '2019-03-21 13:41:47', '2019-03-21 13:41:47');
INSERT INTO `tbl_huijiao_course_type` VALUES (228, 'qd02020504', '两位数乘一位数（不进位）	', 1, 0, 11, '', '', '2019-03-21 13:41:59', '2019-03-21 13:41:59');
INSERT INTO `tbl_huijiao_course_type` VALUES (229, 'rj03040313 ', '光的直线传播', 1, 0, 35, '', '', '2019-03-21 13:42:02', '2019-03-21 13:42:02');
INSERT INTO `tbl_huijiao_course_type` VALUES (230, 'rj03040314 ', '光的反射', 1, 0, 35, '', '', '2019-03-21 13:42:18', '2019-03-21 13:42:18');
INSERT INTO `tbl_huijiao_course_type` VALUES (231, 'rj03040315 ', '平面镜成像', 1, 0, 35, '', '', '2019-03-21 13:42:38', '2019-03-21 13:42:38');
INSERT INTO `tbl_huijiao_course_type` VALUES (232, 'qd02020505', '两位数乘一位数（进位）', 1, 0, 11, '', '', '2019-03-21 13:42:38', '2019-03-21 13:42:38');
INSERT INTO `tbl_huijiao_course_type` VALUES (233, 'rj03040316 ', '光的折射', 1, 0, 35, '', '', '2019-03-21 13:42:59', '2019-03-21 13:42:59');
INSERT INTO `tbl_huijiao_course_type` VALUES (234, 'qd02020506', '用乘加、乘减两步计算解决问题 ', 1, 0, 11, '', '', '2019-03-21 13:43:05', '2019-03-21 13:43:05');
INSERT INTO `tbl_huijiao_course_type` VALUES (235, 'rj03040317  ', '光的色散 ', 0, 0, 1, '', '', '2019-03-21 13:43:10', '2019-03-21 13:43:10');
INSERT INTO `tbl_huijiao_course_type` VALUES (236, 'rj03040318  ', '透镜', 1, 0, 35, '', '', '2019-03-21 13:43:27', '2019-03-21 13:43:27');
INSERT INTO `tbl_huijiao_course_type` VALUES (237, 'qd02020508', '三位数乘一位数（不进位）', 1, 0, 11, '', '', '2019-03-21 13:43:33', '2019-03-21 13:43:33');
INSERT INTO `tbl_huijiao_course_type` VALUES (238, 'rj03040319', '生活中的透镜', 0, 0, 35, '', '', '2019-03-21 13:43:44', '2019-05-09 10:54:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (240, 'rj03040320', '凸透镜成像的规律 ', 1, 0, 35, '', '', '2019-03-21 13:44:00', '2019-03-21 13:44:00');
INSERT INTO `tbl_huijiao_course_type` VALUES (241, 'rj03040321 ', '眼睛和眼镜', 1, 0, 35, '', '', '2019-03-21 13:44:19', '2019-03-21 13:44:19');
INSERT INTO `tbl_huijiao_course_type` VALUES (242, 'qd02020510', '三位数（末尾或中间有0）乘一位数', 1, 0, 11, '', '', '2019-03-21 13:44:19', '2019-03-21 13:44:19');
INSERT INTO `tbl_huijiao_course_type` VALUES (243, 'qd02020511', '辨认方向', 1, 0, 11, '', '', '2019-03-21 13:44:42', '2019-03-21 13:44:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (244, 'rj03040322 ', '显微镜和望远镜', 1, 0, 35, '', '', '2019-03-21 13:44:44', '2019-03-21 13:44:44');
INSERT INTO `tbl_huijiao_course_type` VALUES (245, 'rj03040323 ', '质量 ', 1, 0, 35, '', '', '2019-03-21 13:45:02', '2019-03-21 13:45:02');
INSERT INTO `tbl_huijiao_course_type` VALUES (246, 'qd02020512', '平移与旋转', 1, 0, 11, '', '', '2019-03-21 13:45:07', '2019-03-21 13:45:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (247, 'rj03040324 ', '密度', 1, 0, 35, '', '', '2019-03-21 13:45:17', '2019-03-21 13:45:17');
INSERT INTO `tbl_huijiao_course_type` VALUES (248, 'rj03040325 ', '测量物质的密度', 0, 0, 1, '', '', '2019-03-21 13:45:30', '2019-03-21 13:45:30');
INSERT INTO `tbl_huijiao_course_type` VALUES (249, 'qd02020514', '整十数、几百几十数除以一位数的口算', 1, 0, 11, '', '', '2019-03-21 13:45:47', '2019-03-21 13:45:47');
INSERT INTO `tbl_huijiao_course_type` VALUES (250, 'rj03040325 ', '测量物质的密度', 1, 0, 35, '', '', '2019-03-21 13:46:04', '2019-03-21 13:46:04');
INSERT INTO `tbl_huijiao_course_type` VALUES (251, 'rj03040326 ', '密度与社会生活', 0, 0, 1, '', '', '2019-03-21 13:46:16', '2019-03-21 13:46:16');
INSERT INTO `tbl_huijiao_course_type` VALUES (252, 'qd02020515', '两位数除以一位数的笔算', 1, 0, 11, '', '', '2019-03-21 13:46:18', '2019-03-21 13:46:18');
INSERT INTO `tbl_huijiao_course_type` VALUES (253, 'qd02020516', '三位数除以一位数的笔算', 1, 0, 11, '', '', '2019-03-21 13:47:16', '2019-03-21 13:47:16');
INSERT INTO `tbl_huijiao_course_type` VALUES (254, 'qd02020518', '乘加乘减混合运算', 1, 0, 11, '', '', '2019-03-21 13:47:41', '2019-03-21 13:47:41');
INSERT INTO `tbl_huijiao_course_type` VALUES (255, 'qd02020519', '除加除减混合运算', 1, 0, 11, '', '', '2019-03-21 13:48:09', '2019-03-21 13:48:09');
INSERT INTO `tbl_huijiao_course_type` VALUES (256, 'qd02020520', '加括号的混合运算', 1, 0, 11, '', '', '2019-03-21 13:48:41', '2019-03-21 13:48:41');
INSERT INTO `tbl_huijiao_course_type` VALUES (257, 'qd02020521', '时分的认识', 1, 0, 11, '', '', '2019-03-21 13:49:15', '2019-03-21 13:49:15');
INSERT INTO `tbl_huijiao_course_type` VALUES (258, 'qd02020522', '时分的计算', 1, 0, 11, '', '', '2019-03-21 13:49:47', '2019-03-21 13:49:47');
INSERT INTO `tbl_huijiao_course_type` VALUES (259, 'qd02020523', '秒的认识', 1, 0, 11, '', '', '2019-03-21 13:52:29', '2019-03-21 13:52:29');
INSERT INTO `tbl_huijiao_course_type` VALUES (260, 'qd02020524', '变废为宝', 1, 0, 11, '', '', '2019-03-21 13:55:36', '2019-03-21 13:55:36');
INSERT INTO `tbl_huijiao_course_type` VALUES (261, 'qd02020525', '图形周长的认识', 1, 0, 11, '', '', '2019-03-21 13:56:09', '2019-03-21 13:56:09');
INSERT INTO `tbl_huijiao_course_type` VALUES (262, 'qd02020526', '长方形和正方形的周长', 1, 0, 11, '', '', '2019-03-21 13:56:37', '2019-03-21 13:56:37');
INSERT INTO `tbl_huijiao_course_type` VALUES (263, 'qd02020527', '分数的初步认识', 1, 0, 11, '', '', '2019-03-21 13:57:04', '2019-03-21 13:57:04');
INSERT INTO `tbl_huijiao_course_type` VALUES (264, 'qd02020528', '分数的大小比较', 1, 0, 11, '', '', '2019-03-21 13:57:30', '2019-03-21 13:57:30');
INSERT INTO `tbl_huijiao_course_type` VALUES (265, 'qd02020529', '同分母分数加减法', 1, 0, 11, '', '', '2019-03-21 13:57:54', '2019-03-21 13:57:54');
INSERT INTO `tbl_huijiao_course_type` VALUES (266, 'rj03040326 ', '密度与社会生活', 1, 0, 35, '', '', '2019-03-21 14:19:50', '2019-03-21 14:19:50');
INSERT INTO `tbl_huijiao_course_type` VALUES (267, 'rj03040311', '汽化和液化', 1, 0, 35, '', '', '2019-03-21 14:24:26', '2019-03-21 14:24:26');
INSERT INTO `tbl_huijiao_course_type` VALUES (268, 'rj03040317  ', '光的色散', 1, 0, 35, '', '', '2019-03-21 14:28:39', '2019-03-21 14:28:39');
INSERT INTO `tbl_huijiao_course_type` VALUES (269, 'bsd03020401', '等腰三角形', 1, 0, 22, '', '', '2019-03-21 16:56:10', '2019-03-21 16:56:10');
INSERT INTO `tbl_huijiao_course_type` VALUES (270, 'bsd03020402', '直角三角形', 0, 0, 1, '', '', '2019-03-21 16:57:09', '2019-03-21 16:57:09');
INSERT INTO `tbl_huijiao_course_type` VALUES (271, 'bsd03020402', '直角三角形', 1, 0, 22, '', '', '2019-03-21 16:58:18', '2019-03-21 16:58:18');
INSERT INTO `tbl_huijiao_course_type` VALUES (272, 'qd02020601', '两、三位数除以一位数商是两位数', 1, 0, 12, '', '', '2019-03-21 17:50:42', '2019-03-21 17:50:42');
INSERT INTO `tbl_huijiao_course_type` VALUES (273, 'qd02020602', '两、三位数除以一位数借位除法', 1, 0, 12, '', '', '2019-03-21 17:51:10', '2019-03-21 17:51:10');
INSERT INTO `tbl_huijiao_course_type` VALUES (274, 'qd02020603', '商的中间或末尾为0的除法', 1, 0, 12, '', '', '2019-03-21 17:51:36', '2019-03-21 17:51:36');
INSERT INTO `tbl_huijiao_course_type` VALUES (275, 'qd02020604', '对称的图形', 1, 0, 12, '', '', '2019-03-21 17:52:19', '2019-03-21 17:52:19');
INSERT INTO `tbl_huijiao_course_type` VALUES (276, 'qd02020605', '两位数乘整十数', 1, 0, 12, '', '', '2019-03-21 17:52:45', '2019-03-21 17:52:45');
INSERT INTO `tbl_huijiao_course_type` VALUES (277, 'qd02020606', '两位数乘两位数（不进位）', 1, 0, 12, '', '', '2019-03-21 17:53:23', '2019-03-21 17:53:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (278, 'qd02020607', '两位数乘两位数（进位）', 1, 0, 12, '', '', '2019-03-21 17:53:45', '2019-03-21 17:53:45');
INSERT INTO `tbl_huijiao_course_type` VALUES (279, 'qd02020609', '用连乘、连除解决问题', 1, 0, 12, '', '', '2019-03-21 17:54:08', '2019-03-21 17:54:08');
INSERT INTO `tbl_huijiao_course_type` VALUES (280, 'qd02020610', '用乘除两步计算解决问题', 1, 0, 12, '', '', '2019-03-21 17:54:30', '2019-03-21 17:54:30');
INSERT INTO `tbl_huijiao_course_type` VALUES (281, 'qd02020611', '面积的意义', 1, 0, 12, '', '', '2019-03-21 17:54:56', '2019-03-21 17:54:56');
INSERT INTO `tbl_huijiao_course_type` VALUES (282, 'qd02020612', '长方形和正方形面积的计算', 1, 0, 12, '', '', '2019-03-21 17:55:20', '2019-03-21 17:55:20');
INSERT INTO `tbl_huijiao_course_type` VALUES (283, 'qd02020613', '长方形和正方形面积和周长', 1, 0, 12, '', '', '2019-03-21 17:55:43', '2019-03-21 17:55:43');
INSERT INTO `tbl_huijiao_course_type` VALUES (284, 'qd02020615', '24时计时法', 1, 0, 12, '', '', '2019-03-21 17:56:07', '2019-03-21 17:56:07');
INSERT INTO `tbl_huijiao_course_type` VALUES (285, 'qd02020616', '日月年之间的换算', 1, 0, 12, '', '', '2019-03-21 17:56:34', '2019-03-21 17:56:34');
INSERT INTO `tbl_huijiao_course_type` VALUES (286, 'qd02020617', '小数的初步认识', 1, 0, 12, '', '', '2019-03-21 17:57:00', '2019-03-21 17:57:00');
INSERT INTO `tbl_huijiao_course_type` VALUES (287, 'qd02020618', '小数的简单计算', 1, 0, 12, '', '', '2019-03-21 17:57:23', '2019-03-21 17:57:23');
INSERT INTO `tbl_huijiao_course_type` VALUES (288, 'qd02020620', '数据的收集与整理', 1, 0, 12, '', '', '2019-03-21 17:57:47', '2019-03-21 17:57:47');
INSERT INTO `tbl_huijiao_course_type` VALUES (289, 'rj03040327', '第一章 机械运动', 1, 0, 35, '', '', '2019-03-21 18:34:30', '2019-03-21 18:34:30');
INSERT INTO `tbl_huijiao_course_type` VALUES (290, 'rj03040328', '第二章 声现象', 1, 0, 35, '', '', '2019-03-21 18:48:48', '2019-03-21 18:48:48');
INSERT INTO `tbl_huijiao_course_type` VALUES (291, 'rj03040329', '第三章 物态变化', 1, 0, 35, '', '', '2019-03-21 18:49:13', '2019-03-21 18:49:13');
INSERT INTO `tbl_huijiao_course_type` VALUES (292, 'rj03040330', '第四章 光现象', 1, 0, 35, '', '', '2019-03-21 18:49:39', '2019-03-21 18:49:39');
INSERT INTO `tbl_huijiao_course_type` VALUES (293, 'rj03040331', '第五章 透镜及其应用', 1, 0, 35, '', '', '2019-03-21 18:50:14', '2019-03-21 18:50:14');
INSERT INTO `tbl_huijiao_course_type` VALUES (294, '123123', '123123', 0, 0, 3, '', '', '2019-07-27 11:43:29', '2019-07-27 11:43:29');

-- ----------------------------
-- Table structure for tbl_huijiao_lessons
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_lessons`;
CREATE TABLE `tbl_huijiao_lessons`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lesson_no` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `term_id` int(10) NULL DEFAULT NULL,
  `course_type_id` int(10) NULL DEFAULT NULL,
  `user_id` int(10) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `sort_order` int(10) NULL DEFAULT NULL,
  `image_icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `lesson_info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 183 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_lessons
-- ----------------------------
INSERT INTO `tbl_huijiao_lessons` VALUES (52, NULL, '4', 33, 37, 0, 0, NULL, 'uploads/contents/qd0019031811311903461_icon.png', '[\"88\"]', '2019-03-18 11:31:19', '2019-03-18 11:31:19');
INSERT INTO `tbl_huijiao_lessons` VALUES (53, NULL, '222', 33, 37, 369, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '[\"88\"]', '2019-03-18 13:15:31', '2019-03-18 13:15:31');
INSERT INTO `tbl_huijiao_lessons` VALUES (54, NULL, '22', 2, 38, 369, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '[\"125\",\"91\"]', '2019-03-19 13:11:21', '2019-03-19 18:17:00');
INSERT INTO `tbl_huijiao_lessons` VALUES (56, NULL, '的', 3, 46, 369, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '[\"216\",\"90\",\"217\",\"220\"]', '2019-03-19 18:15:34', '2019-03-19 18:15:34');
INSERT INTO `tbl_huijiao_lessons` VALUES (57, NULL, '问问', 3, 86, 0, 0, NULL, 'uploads/contents/qd0019032016102209168_icon.jpg', '[\"236\",\"335\",\"558\",\"518\",\"555\",\"559\",\"562\",\"564\"]', '2019-03-20 16:10:22', '2019-03-20 16:10:22');
INSERT INTO `tbl_huijiao_lessons` VALUES (58, NULL, '同底数幂的乘法', 20, 65, 0, 1, NULL, 'uploads/contents/qd0019032016415608347_icon.png', '[\"148\",\"911\"]', '2019-03-20 16:41:56', '2019-03-20 16:41:56');
INSERT INTO `tbl_huijiao_lessons` VALUES (59, NULL, '幂的乘方与积的乘方', 20, 66, 0, 1, NULL, 'uploads/contents/qd0019032016441002806_icon.png', '[\"152\",\"912\",\"913\"]', '2019-03-20 16:44:10', '2019-03-20 16:44:10');
INSERT INTO `tbl_huijiao_lessons` VALUES (60, NULL, '同底数幂的除法', 20, 67, 0, 1, NULL, 'uploads/contents/qd0019032016453509565_icon.png', '[\"153\",\"914\"]', '2019-03-20 16:45:35', '2019-03-20 16:45:35');
INSERT INTO `tbl_huijiao_lessons` VALUES (61, NULL, '整式的乘法', 1, 68, 0, 1, NULL, 'uploads/contents/qd0019032016464506517_icon.png', '[\"156\",\"915\",\"916\",\"917\"]', '2019-03-20 16:46:45', '2019-03-20 16:46:45');
INSERT INTO `tbl_huijiao_lessons` VALUES (62, NULL, '平方差公式', 1, 69, 0, 1, NULL, 'uploads/contents/qd0019032016481709947_icon.png', '[\"162\",\"918\"]', '2019-03-20 16:48:17', '2019-03-20 16:48:17');
INSERT INTO `tbl_huijiao_lessons` VALUES (63, NULL, '完全平方公式', 1, 70, 0, 1, NULL, 'uploads/contents/qd0019032016500402410_icon.png', '[\"163\",\"919\"]', '2019-03-20 16:50:04', '2019-03-20 16:50:04');
INSERT INTO `tbl_huijiao_lessons` VALUES (64, NULL, '整式的除法', 1, 71, 0, 1, NULL, 'uploads/contents/qd0019032016525504726_icon.png', '[\"164\",\"920\"]', '2019-03-20 16:52:55', '2019-03-20 16:52:55');
INSERT INTO `tbl_huijiao_lessons` VALUES (65, NULL, '两条直线的位置关系', 1, 72, 0, 1, NULL, 'uploads/contents/qd0019032016541702641_icon.png', '[\"165\",\"921\",\"935\"]', '2019-03-20 16:54:17', '2019-03-20 16:54:17');
INSERT INTO `tbl_huijiao_lessons` VALUES (68, NULL, '探索直线平行的条件', 1, 73, 0, 1, NULL, 'uploads/contents/qd0019032017024308606_icon.png', '[\"166\",\"922\"]', '2019-03-20 17:02:43', '2019-03-20 17:02:43');
INSERT INTO `tbl_huijiao_lessons` VALUES (70, NULL, '平行线的性质', 20, 74, 0, 1, NULL, 'uploads/contents/qd0019032017035904835_icon.png', '[\"167\",\"923\"]', '2019-03-20 17:03:59', '2019-03-20 17:03:59');
INSERT INTO `tbl_huijiao_lessons` VALUES (72, NULL, '用尺规作角', 20, 75, 0, 1, NULL, 'uploads/contents/qd0019032017044809339_icon.png', '[\"168\"]', '2019-03-20 17:04:48', '2019-03-20 17:04:48');
INSERT INTO `tbl_huijiao_lessons` VALUES (75, NULL, '认识三角形', 20, 76, 0, 1, NULL, 'uploads/contents/qd0019032017053507002_icon.png', '[\"169\",\"924\"]', '2019-03-20 17:05:35', '2019-03-21 11:25:08');
INSERT INTO `tbl_huijiao_lessons` VALUES (76, NULL, '图形的全等', 20, 77, 0, 1, NULL, 'uploads/contents/qd0019032017061009511_icon.png', '[\"170\",\"925\"]', '2019-03-20 17:06:10', '2019-03-21 11:24:47');
INSERT INTO `tbl_huijiao_lessons` VALUES (77, NULL, '探索三角形全等的条件', 20, 78, 0, 1, NULL, 'uploads/contents/qd0019032017065904152_icon.png', '[\"237\",\"926\"]', '2019-03-20 17:06:59', '2019-03-21 11:24:25');
INSERT INTO `tbl_huijiao_lessons` VALUES (78, NULL, '用尺规作三角形', 20, 79, 0, 1, NULL, 'uploads/contents/qd0019032017075008531_icon.png', '[\"243\"]', '2019-03-20 17:07:50', '2019-03-21 11:23:58');
INSERT INTO `tbl_huijiao_lessons` VALUES (80, NULL, '利用三角形全等测距离', 20, 80, 0, 1, NULL, 'uploads/contents/qd0019032017101003591_icon.png', '[\"275\",\"927\"]', '2019-03-20 17:10:10', '2019-03-21 11:23:34');
INSERT INTO `tbl_huijiao_lessons` VALUES (81, NULL, '用表格表示的变量间关系', 20, 81, 0, 1, NULL, 'uploads/contents/qd81019032017150901156_icon.png', '[\"280\"]', '2019-03-20 17:13:40', '2019-03-21 11:22:50');
INSERT INTO `tbl_huijiao_lessons` VALUES (83, NULL, '用关系式表示的变量间关系', 20, 82, 0, 1, NULL, 'uploads/contents/qd0019032017154002881_icon.png', '[\"284\"]', '2019-03-20 17:15:40', '2019-03-21 11:22:20');
INSERT INTO `tbl_huijiao_lessons` VALUES (84, NULL, '用图象表示的变量间关系', 20, 83, 0, 1, NULL, 'uploads/contents/qd0019032017161802735_icon.png', '[\"289\"]', '2019-03-20 17:16:18', '2019-03-21 11:21:19');
INSERT INTO `tbl_huijiao_lessons` VALUES (85, NULL, '轴对称现象', 20, 84, 0, 1, NULL, 'uploads/contents/qd0019032017164605064_icon.png', '[\"293\",\"928\"]', '2019-03-20 17:16:46', '2019-03-20 17:16:46');
INSERT INTO `tbl_huijiao_lessons` VALUES (86, NULL, '探索轴对称的性质', 20, 87, 0, 1, NULL, 'uploads/contents/qd0019032017171904109_icon.png', '[\"296\",\"929\"]', '2019-03-20 17:17:19', '2019-03-20 17:17:19');
INSERT INTO `tbl_huijiao_lessons` VALUES (87, NULL, '弹力', 26, 120, 0, 1, NULL, 'uploads/contents/qd0019032017182205469_icon.png', '[\"499\",\"939\"]', '2019-03-20 17:18:22', '2019-03-20 20:06:43');
INSERT INTO `tbl_huijiao_lessons` VALUES (88, NULL, '简单的轴对称图形', 20, 90, 0, 1, NULL, 'uploads/contents/qd0019032017185304874_icon.png', '[\"302\",\"930\"]', '2019-03-20 17:18:53', '2019-03-20 17:18:53');
INSERT INTO `tbl_huijiao_lessons` VALUES (89, NULL, '利用轴对称进行设计', 20, 91, 0, 1, NULL, 'uploads/contents/qd0019032017192907304_icon.png', '[\"325\",\"931\"]', '2019-03-20 17:19:29', '2019-03-20 17:19:29');
INSERT INTO `tbl_huijiao_lessons` VALUES (90, NULL, '感受可能性', 20, 111, 0, 1, NULL, 'uploads/contents/qd0019032017200303872_icon.png', '[\"331\",\"932\"]', '2019-03-20 17:20:03', '2019-03-20 17:20:03');
INSERT INTO `tbl_huijiao_lessons` VALUES (91, NULL, '重力', 26, 121, 0, 1, NULL, 'uploads/contents/qd0019032017201201240_icon.png', '[\"501\",\"940\"]', '2019-03-20 17:20:12', '2019-03-20 20:23:13');
INSERT INTO `tbl_huijiao_lessons` VALUES (92, NULL, '频率的稳定性', 20, 114, 0, 1, NULL, 'uploads/contents/qd0019032017203001170_icon.png', '[\"332\",\"933\"]', '2019-03-20 17:20:30', '2019-03-20 17:20:30');
INSERT INTO `tbl_huijiao_lessons` VALUES (93, NULL, '牛顿第一定律', 26, 181, 0, 1, NULL, 'uploads/contents/qd0019032017205503819_icon.png', '[\"904\",\"941\"]', '2019-03-20 17:20:55', '2019-03-20 20:22:59');
INSERT INTO `tbl_huijiao_lessons` VALUES (94, NULL, '等可能事件的概率', 20, 117, 0, 1, NULL, 'uploads/contents/qd0019032017205907429_icon.png', '[\"333\",\"934\"]', '2019-03-20 17:20:59', '2019-03-20 17:20:59');
INSERT INTO `tbl_huijiao_lessons` VALUES (95, NULL, '二力平衡', 26, 123, 0, 1, NULL, 'uploads/contents/qd0019032017212102569_icon.png', '[\"505\",\"943\"]', '2019-03-20 17:21:21', '2019-03-20 20:22:45');
INSERT INTO `tbl_huijiao_lessons` VALUES (96, NULL, '摩擦力', 26, 207, 0, 1, NULL, 'uploads/contents/qd0019032017220003214_icon.png', '[\"905\",\"944\"]', '2019-03-20 17:22:00', '2019-03-20 20:22:29');
INSERT INTO `tbl_huijiao_lessons` VALUES (97, NULL, '压强', 26, 125, 0, 1, NULL, 'uploads/contents/qd0019032017231802367_icon.png', '[\"511\",\"945\"]', '2019-03-20 17:23:18', '2019-03-20 20:22:12');
INSERT INTO `tbl_huijiao_lessons` VALUES (98, NULL, '液体的压强', 26, 126, 0, 1, NULL, 'uploads/contents/qd0019032017240207088_icon.png', '[\"513\",\"946\"]', '2019-03-20 17:24:02', '2019-03-20 20:21:54');
INSERT INTO `tbl_huijiao_lessons` VALUES (99, NULL, '大气压强（大气压强与生活）', 26, 127, 0, 1, NULL, 'uploads/contents/qd0019032017244506347_icon.png', '[\"515\",\"858\"]', '2019-03-20 17:24:45', '2019-03-20 20:18:51');
INSERT INTO `tbl_huijiao_lessons` VALUES (100, NULL, '流体压强与流速的关系', 26, 128, 0, 1, NULL, 'uploads/contents/qd0019032017365103300_icon.png', '[\"516\",\"949\"]', '2019-03-20 17:36:51', '2019-03-20 20:20:12');
INSERT INTO `tbl_huijiao_lessons` VALUES (101, NULL, '浮力（浮力及其产生的原因）', 26, 129, 0, 1, NULL, 'uploads/contents/qd0019032017405605652_icon.png', '[\"517\",\"950\"]', '2019-03-20 17:40:56', '2019-03-20 20:19:41');
INSERT INTO `tbl_huijiao_lessons` VALUES (102, NULL, '浮力（浮力的大小与哪些因素有关）', 26, 129, 0, 1, NULL, 'uploads/contents/qd0019032017440002948_icon.png', '[\"517\",\"951\"]', '2019-03-20 17:44:00', '2019-03-20 20:21:04');
INSERT INTO `tbl_huijiao_lessons` VALUES (103, NULL, '阿基米德原理', 26, 130, 0, 1, NULL, 'uploads/contents/qd0019032017444207961_icon.png', '[\"519\",\"952\"]', '2019-03-20 17:44:42', '2019-03-20 20:12:20');
INSERT INTO `tbl_huijiao_lessons` VALUES (104, NULL, '物体的浮沉条件及其应用', 26, 131, 0, 1, NULL, 'uploads/contents/qd0019032017455801270_icon.png', '[\"520\",\"953\"]', '2019-03-20 17:45:58', '2019-03-20 20:12:09');
INSERT INTO `tbl_huijiao_lessons` VALUES (105, NULL, '功（做功的两个必要因素）', 26, 132, 0, 1, NULL, 'uploads/contents/qd0019032017471102199_icon.png', '[\"525\",\"954\"]', '2019-03-20 17:47:11', '2019-03-20 20:12:04');
INSERT INTO `tbl_huijiao_lessons` VALUES (106, NULL, '功率', 26, 133, 0, 1, NULL, 'uploads/contents/qd0019032017495209664_icon.png', '[\"527\",\"955\"]', '2019-03-20 17:49:52', '2019-03-20 20:11:58');
INSERT INTO `tbl_huijiao_lessons` VALUES (107, NULL, '动能和势能（动能）', 26, 134, 0, 1, NULL, 'uploads/contents/qd0019032017505605712_icon.png', '[\"529\",\"956\"]', '2019-03-20 17:50:56', '2019-03-20 20:11:22');
INSERT INTO `tbl_huijiao_lessons` VALUES (108, NULL, '动能和势能（重力势能和弹性势能）', 26, 134, 0, 1, NULL, 'uploads/contents/qd108019032017523204404_icon.png', '[\"529\",\"957\"]', '2019-03-20 17:51:38', '2019-03-20 20:10:47');
INSERT INTO `tbl_huijiao_lessons` VALUES (109, NULL, '动能和势能的相互转化', 26, 135, 0, 1, NULL, 'uploads/contents/qd0019032017521904151_icon.png', '[\"531\",\"958\"]', '2019-03-20 17:52:19', '2019-03-20 20:11:00');
INSERT INTO `tbl_huijiao_lessons` VALUES (110, NULL, '十几减9的退位减法', 8, 38, 0, 1, NULL, 'uploads/contents/qd0019032018182702311_icon.png', '[\"125\"]', '2019-03-20 18:18:27', '2019-03-20 18:18:27');
INSERT INTO `tbl_huijiao_lessons` VALUES (111, NULL, '大气压强（大气压强与生活）', 26, 127, 0, 1, NULL, 'uploads/contents/qd0019032018242908680_icon.png', '[\"515\",\"948\"]', '2019-03-20 18:24:29', '2019-03-20 20:10:23');
INSERT INTO `tbl_huijiao_lessons` VALUES (112, NULL, '浮力（浮力的大小与哪些因素有关）', 26, 129, 0, 1, NULL, 'uploads/contents/qd0019032018342502752_icon.png', '[\"517\",\"951\"]', '2019-03-20 18:34:25', '2019-03-20 20:10:00');
INSERT INTO `tbl_huijiao_lessons` VALUES (113, NULL, '十几减8、7的退位减法', 8, 39, 0, 1, NULL, 'uploads/contents/qd0019032018395905071_icon.png', '[\"133\"]', '2019-03-20 18:39:59', '2019-03-20 18:39:59');
INSERT INTO `tbl_huijiao_lessons` VALUES (114, NULL, '十几减6、5、4、3、2', 8, 40, 0, 1, NULL, 'uploads/contents/qd0019032018461809086_icon.png', '[\"136\"]', '2019-03-20 18:46:18', '2019-03-20 18:46:18');
INSERT INTO `tbl_huijiao_lessons` VALUES (115, NULL, '认识钟表', 8, 41, 0, 1, NULL, 'uploads/contents/qd0019032018472503380_icon.png', '[\"138\",\"127\",\"967\"]', '2019-03-20 18:47:25', '2019-03-21 10:05:06');
INSERT INTO `tbl_huijiao_lessons` VALUES (116, NULL, '100以内数的认识', 8, 42, 0, 1, NULL, 'uploads/contents/qd0019032018505409765_icon.png', '[\"139\",\"173\"]', '2019-03-20 18:50:54', '2019-03-20 18:50:54');
INSERT INTO `tbl_huijiao_lessons` VALUES (117, NULL, '100以内数的大小比较', 8, 43, 0, 1, NULL, 'uploads/contents/qd0019032018512806759_icon.png', '[\"140\",\"193\"]', '2019-03-20 18:51:28', '2019-03-20 18:51:28');
INSERT INTO `tbl_huijiao_lessons` VALUES (118, NULL, '整十数的加减法', 8, 44, 0, 1, NULL, 'uploads/contents/qd0019032018520202058_icon.png', '[\"142\"]', '2019-03-20 18:52:02', '2019-03-20 18:52:02');
INSERT INTO `tbl_huijiao_lessons` VALUES (119, NULL, '认识图形', 8, 49, 0, 1, NULL, 'uploads/contents/qd0019032018524406311_icon.png', '[\"144\",\"198\",\"968\"]', '2019-03-20 18:52:44', '2019-03-21 09:49:27');
INSERT INTO `tbl_huijiao_lessons` VALUES (120, NULL, '整十数加减一位数', 8, 50, 0, 1, NULL, 'uploads/contents/qd0019032018535405711_icon.png', '[\"143\"]', '2019-03-20 18:53:54', '2019-03-20 18:53:54');
INSERT INTO `tbl_huijiao_lessons` VALUES (121, NULL, '两位数加一位数和整十数', 8, 51, 0, 1, NULL, 'uploads/contents/qd0019032018543304175_icon.png', '[\"149\"]', '2019-03-20 18:54:33', '2019-03-20 18:54:33');
INSERT INTO `tbl_huijiao_lessons` VALUES (122, NULL, '两位数加一位数进位加', 8, 52, 0, 1, NULL, 'uploads/contents/qd0019032018551507365_icon.png', '[\"160\"]', '2019-03-20 18:55:15', '2019-03-20 18:55:15');
INSERT INTO `tbl_huijiao_lessons` VALUES (123, NULL, '一个数比另一个数多几或少几', 8, 53, 0, 1, NULL, 'uploads/contents/qd0019032018560605054_icon.png', '[\"161\",\"200\"]', '2019-03-20 18:56:06', '2019-03-20 18:56:06');
INSERT INTO `tbl_huijiao_lessons` VALUES (124, NULL, '两位数减两位数（退位）', 8, 54, 0, 1, NULL, 'uploads/contents/qd0019032018565103184_icon.png', '[\"171\"]', '2019-03-20 18:56:51', '2019-03-20 18:56:51');
INSERT INTO `tbl_huijiao_lessons` VALUES (125, NULL, '认识人民币和人民币的换算', 8, 55, 0, 1, NULL, 'uploads/contents/qd0019032018572806308_icon.png', '[\"183\",\"210\"]', '2019-03-20 18:57:28', '2019-03-20 18:57:28');
INSERT INTO `tbl_huijiao_lessons` VALUES (126, NULL, '人民币之间的加减法', 8, 56, 0, 0, NULL, 'uploads/contents/qd0019032018580903591_icon.png', '[\"186\",\"211\"]', '2019-03-20 18:58:09', '2019-03-22 22:53:52');
INSERT INTO `tbl_huijiao_lessons` VALUES (127, NULL, '两位数加两位数（不进位）', 8, 57, 0, 1, NULL, 'uploads/contents/qd0019032018590102406_icon.png', '[\"197\",\"212\"]', '2019-03-20 18:59:01', '2019-03-20 18:59:01');
INSERT INTO `tbl_huijiao_lessons` VALUES (128, NULL, '两位数减两位数（不退位）', 8, 58, 0, 1, NULL, 'uploads/contents/qd0019032019070306020_icon.png', '[\"195\",\"214\"]', '2019-03-20 19:07:03', '2019-03-20 19:07:03');
INSERT INTO `tbl_huijiao_lessons` VALUES (129, NULL, '两位数加两位数（进位）', 8, 59, 0, 1, NULL, 'uploads/contents/qd0019032019090003634_icon.png', '[\"201\",\"215\"]', '2019-03-20 19:09:00', '2019-03-20 19:09:00');
INSERT INTO `tbl_huijiao_lessons` VALUES (130, NULL, '杠杆 （杠杆力臂的概念和画法）', 26, 136, 0, 1, NULL, 'uploads/contents/qd0019032019140107188_icon.png', '[\"536\",\"959\"]', '2019-03-20 19:14:01', '2019-03-20 20:09:34');
INSERT INTO `tbl_huijiao_lessons` VALUES (131, NULL, '杠杆（杠杆的分类）', 26, 136, 0, 1, NULL, 'uploads/contents/qd0019032019160806030_icon.png', '[\"536\",\"960\"]', '2019-03-20 19:16:08', '2019-03-20 20:09:10');
INSERT INTO `tbl_huijiao_lessons` VALUES (132, NULL, '杠杆（杠杆的平衡条件）', 26, 136, 0, 1, NULL, 'uploads/contents/qd0019032019163703106_icon.png', '[\"536\",\"961\"]', '2019-03-20 19:16:37', '2019-03-20 20:08:42');
INSERT INTO `tbl_huijiao_lessons` VALUES (133, NULL, '两位数减两位数（退位）', 8, 60, 0, 1, NULL, 'uploads/contents/qd0019032019185806219_icon.png', '[\"199\",\"264\"]', '2019-03-20 19:18:58', '2019-03-20 19:18:58');
INSERT INTO `tbl_huijiao_lessons` VALUES (134, NULL, '滑轮（定滑轮及其工作特点）', 26, 137, 0, 1, NULL, 'uploads/contents/qd0019032019190709375_icon.png', '[\"539\",\"962\"]', '2019-03-20 19:19:07', '2019-03-20 20:08:31');
INSERT INTO `tbl_huijiao_lessons` VALUES (135, NULL, '滑轮（动其工作特点）', 26, 137, 0, 1, NULL, 'uploads/contents/qd0019032019195608016_icon.png', '[\"539\",\"963\"]', '2019-03-20 19:19:56', '2019-03-20 20:08:26');
INSERT INTO `tbl_huijiao_lessons` VALUES (136, NULL, '滑轮（滑轮组及其工作特点）', 26, 137, 0, 1, NULL, 'uploads/contents/qd0019032019202402160_icon.png', '[\"539\",\"964\"]', '2019-03-20 19:20:24', '2019-03-20 20:08:15');
INSERT INTO `tbl_huijiao_lessons` VALUES (137, NULL, '机械效率', 26, 138, 0, 1, NULL, 'uploads/contents/qd0019032019210909897_icon.png', '[\"544\",\"965\"]', '2019-03-20 19:21:09', '2019-03-20 20:08:00');
INSERT INTO `tbl_huijiao_lessons` VALUES (138, NULL, '100以内连加、连减、加减混合运算', 8, 61, 0, 1, NULL, 'uploads/contents/qd0019032019230807227_icon.png', '[\"190\",\"298\"]', '2019-03-20 19:23:08', '2019-03-20 19:23:08');
INSERT INTO `tbl_huijiao_lessons` VALUES (139, NULL, '认识长度单位“厘米”', 8, 62, 0, 1, NULL, 'uploads/contents/qd0019032019235006563_icon.png', '[\"202\",\"203\"]', '2019-03-20 19:23:50', '2019-03-20 19:23:50');
INSERT INTO `tbl_huijiao_lessons` VALUES (140, NULL, '认识长度单位“米”', 8, 63, 0, 1, NULL, 'uploads/contents/qd0019032019243808558_icon.png', '[\"204\",\"209\"]', '2019-03-20 19:24:38', '2019-03-20 19:24:38');
INSERT INTO `tbl_huijiao_lessons` VALUES (141, NULL, '简单的数据收集和整理', 8, 64, 0, 1, NULL, 'uploads/contents/qd0019032019252407320_icon.png', '[\"205\",\"207\"]', '2019-03-20 19:25:24', '2019-03-20 19:25:24');
INSERT INTO `tbl_huijiao_lessons` VALUES (142, NULL, '力（力的基本概念）', 26, 119, 0, 1, NULL, 'uploads/contents/qd0019032019324301287_icon.png', '[\"408\",\"937\"]', '2019-03-20 19:32:43', '2019-03-20 20:06:50');
INSERT INTO `tbl_huijiao_lessons` VALUES (143, NULL, '力（二力的合成）', 26, 119, 0, 1, NULL, 'uploads/contents/qd0019032019333103711_icon.png', '[\"408\",\"938\"]', '2019-03-20 19:33:31', '2019-03-20 20:07:41');
INSERT INTO `tbl_huijiao_lessons` VALUES (144, NULL, '力（力的相互作用 力的三要素）', 26, 119, 0, 1, NULL, 'uploads/contents/qd0019032019340609427_icon.png', '[\"408\",\"936\"]', '2019-03-20 19:34:06', '2019-03-20 20:07:05');
INSERT INTO `tbl_huijiao_lessons` VALUES (145, NULL, '小蝌蚪找妈妈', 3, 46, 0, 1, NULL, 'uploads/contents/qd0019032109141102277_icon.png', '[\"232\",\"90\",\"226\",\"227\",\"228\",\"216\",\"217\",\"218\",\"219\",\"220\",\"221\",\"222\",\"223\",\"224\",\"225\",\"234\",\"229\",\"230\"]', '2019-03-21 09:14:11', '2019-03-21 17:50:34');
INSERT INTO `tbl_huijiao_lessons` VALUES (146, NULL, '我是什么', 3, 85, 0, 1, NULL, 'uploads/contents/qd0019032109151502247_icon.png', '[\"303\",\"235\",\"683\",\"686\",\"688\",\"521\",\"522\",\"526\",\"528\",\"530\",\"533\",\"535\",\"537\",\"540\",\"542\",\"459\",\"364\",\"366\"]', '2019-03-21 09:15:15', '2019-03-21 17:51:24');
INSERT INTO `tbl_huijiao_lessons` VALUES (147, NULL, '植物妈妈有办法', 3, 86, 0, 1, NULL, 'uploads/contents/qd0019032109155707100_icon.png', '[\"304\",\"236\",\"518\",\"523\",\"524\",\"545\",\"547\",\"548\",\"549\",\"551\",\"555\",\"558\",\"559\",\"562\",\"564\",\"465\",\"368\",\"369\"]', '2019-03-21 09:15:57', '2019-03-21 09:18:50');
INSERT INTO `tbl_huijiao_lessons` VALUES (148, NULL, '场景歌', 3, 88, 0, 0, NULL, 'uploads/contents/qd0019032109193607454_icon.png', '[\"305\",\"238\",\"568\",\"571\",\"572\",\"574\",\"576\",\"578\",\"580\",\"583\",\"586\",\"588\",\"466\",\"371\",\"373\"]', '2019-03-21 09:19:36', '2019-03-21 17:52:55');
INSERT INTO `tbl_huijiao_lessons` VALUES (149, NULL, '树之歌', 3, 89, 0, 1, NULL, 'uploads/contents/qd0019032109200706507_icon.png', '[\"306\",\"239\",\"591\",\"594\",\"596\",\"598\",\"601\",\"603\",\"606\",\"609\",\"612\",\"615\",\"467\",\"374\",\"444\"]', '2019-03-21 09:20:07', '2019-03-21 09:20:07');
INSERT INTO `tbl_huijiao_lessons` VALUES (150, NULL, '拍手歌', 3, 92, 0, 1, NULL, 'uploads/contents/qd0019032109203604251_icon.png', '[\"307\",\"240\",\"618\",\"619\",\"620\",\"621\",\"622\",\"623\",\"624\",\"625\",\"626\",\"627\",\"469\",\"442\",\"378\"]', '2019-03-21 09:20:36', '2019-03-21 09:20:36');
INSERT INTO `tbl_huijiao_lessons` VALUES (151, NULL, '田家四季歌', 3, 93, 0, 1, NULL, 'uploads/contents/qd0019032109210508753_icon.png', '[\"308\",\"241\",\"632\",\"634\",\"636\",\"638\",\"640\",\"644\",\"646\",\"648\",\"650\",\"651\",\"470\",\"380\",\"443\"]', '2019-03-21 09:21:05', '2019-03-21 09:21:05');
INSERT INTO `tbl_huijiao_lessons` VALUES (152, NULL, '曹冲称象', 3, 94, 0, 1, NULL, 'uploads/contents/qd0019032109215708970_icon.png', '[\"309\",\"242\",\"532\",\"534\",\"538\",\"652\",\"653\",\"654\",\"655\",\"656\",\"657\",\"658\",\"660\",\"661\",\"662\",\"472\",\"383\",\"384\"]', '2019-03-21 09:21:57', '2019-03-21 09:21:57');
INSERT INTO `tbl_huijiao_lessons` VALUES (153, NULL, '玲玲的画', 3, 95, 0, 1, NULL, 'uploads/contents/qd0019032109223302488_icon.png', '[\"310\",\"252\",\"541\",\"543\",\"546\",\"663\",\"664\",\"665\",\"666\",\"667\",\"668\",\"669\",\"670\",\"671\",\"672\",\"474\",\"386\",\"388\"]', '2019-03-21 09:22:33', '2019-03-21 09:22:33');
INSERT INTO `tbl_huijiao_lessons` VALUES (154, NULL, '一封信', 3, 97, 0, 1, NULL, 'uploads/contents/qd0019032109230504793_icon.png', '[\"311\",\"244\",\"550\",\"552\",\"554\",\"673\",\"674\",\"675\",\"676\",\"677\",\"680\",\"681\",\"684\",\"685\",\"687\",\"475\",\"390\",\"391\"]', '2019-03-21 09:23:05', '2019-03-21 09:23:05');
INSERT INTO `tbl_huijiao_lessons` VALUES (155, NULL, '妈妈睡了', 3, 96, 0, 1, NULL, 'uploads/contents/qd0019032109234006190_icon.png', '[\"312\",\"245\",\"556\",\"560\",\"563\",\"689\",\"691\",\"692\",\"694\",\"695\",\"697\",\"698\",\"699\",\"476\",\"392\",\"393\"]', '2019-03-21 09:23:40', '2019-03-21 09:23:40');
INSERT INTO `tbl_huijiao_lessons` VALUES (156, NULL, '古诗二首-夜宿山寺，敕勒歌', 3, 98, 0, 1, NULL, 'uploads/contents/qd0019032109242403443_icon.png', '[\"313\",\"246\",\"247\",\"577\",\"705\",\"709\",\"711\",\"713\",\"715\",\"718\",\"720\",\"722\",\"726\",\"727\",\"477\",\"394\",\"395\"]', '2019-03-21 09:24:24', '2019-03-21 09:24:24');
INSERT INTO `tbl_huijiao_lessons` VALUES (157, NULL, '黄山奇石', 3, 99, 0, 1, NULL, 'uploads/contents/qd0019032109251406178_icon.png', '[\"314\",\"248\",\"582\",\"584\",\"587\",\"730\",\"731\",\"734\",\"735\",\"737\",\"738\",\"741\",\"743\",\"745\",\"478\",\"396\",\"397\"]', '2019-03-21 09:25:14', '2019-03-21 09:25:14');
INSERT INTO `tbl_huijiao_lessons` VALUES (158, NULL, '日月潭', 3, 100, 0, 1, NULL, 'uploads/contents/qd0019032109254808447_icon.png', '[\"315\",\"249\",\"590\",\"592\",\"595\",\"747\",\"748\",\"750\",\"752\",\"753\",\"755\",\"756\",\"758\",\"761\",\"479\",\"399\",\"400\"]', '2019-03-21 09:25:48', '2019-03-21 09:25:48');
INSERT INTO `tbl_huijiao_lessons` VALUES (159, NULL, '葡萄沟', 3, 101, 0, 1, NULL, 'uploads/contents/qd0019032109262603014_icon.png', '[\"316\",\"250\",\"628\",\"629\",\"630\",\"762\",\"765\",\"767\",\"768\",\"770\",\"771\",\"773\",\"775\",\"776\",\"777\",\"480\",\"402\",\"403\"]', '2019-03-21 09:26:26', '2019-03-21 09:26:26');
INSERT INTO `tbl_huijiao_lessons` VALUES (160, NULL, '坐井观天', 3, 102, 0, 1, NULL, 'uploads/contents/qd0019032109270307179_icon.png', '[\"317\",\"251\",\"631\",\"633\",\"635\",\"778\",\"779\",\"780\",\"781\",\"782\",\"783\",\"784\",\"785\",\"481\",\"405\",\"407\"]', '2019-03-21 09:27:03', '2019-03-21 09:27:03');
INSERT INTO `tbl_huijiao_lessons` VALUES (161, NULL, '寒号鸟', 3, 103, 0, 1, NULL, 'uploads/contents/qd0019032109274007696_icon.png', '[\"318\",\"253\",\"637\",\"639\",\"641\",\"786\",\"787\",\"788\",\"789\",\"790\",\"791\",\"792\",\"793\",\"482\",\"410\",\"441\"]', '2019-03-21 09:27:40', '2019-03-21 09:27:40');
INSERT INTO `tbl_huijiao_lessons` VALUES (162, NULL, '我要的是葫芦', 3, 104, 0, 1, NULL, 'uploads/contents/qd0019032109281707377_icon.png', '[\"319\",\"256\",\"642\",\"643\",\"645\",\"794\",\"795\",\"796\",\"797\",\"798\",\"799\",\"800\",\"801\",\"483\",\"413\",\"414\"]', '2019-03-21 09:28:17', '2019-03-21 09:28:17');
INSERT INTO `tbl_huijiao_lessons` VALUES (163, NULL, '大禹治水', 3, 105, 0, 1, NULL, 'uploads/contents/qd0019032109292306806_icon.png', '[\"320\",\"254\",\"647\",\"700\",\"701\",\"802\",\"803\",\"804\",\"805\",\"806\",\"807\",\"808\",\"809\",\"485\",\"415\",\"417\"]', '2019-03-21 09:29:23', '2019-03-21 09:29:23');
INSERT INTO `tbl_huijiao_lessons` VALUES (164, NULL, '朱德的扁担', 3, 106, 0, 1, NULL, 'uploads/contents/qd0019032109300807829_icon.png', '[\"321\",\"255\",\"704\",\"707\",\"708\",\"810\",\"811\",\"812\",\"813\",\"814\",\"815\",\"816\",\"817\",\"486\",\"418\",\"419\"]', '2019-03-21 09:30:08', '2019-03-21 09:30:08');
INSERT INTO `tbl_huijiao_lessons` VALUES (165, NULL, '难忘的泼水节', 3, 107, 0, 1, NULL, 'uploads/contents/qd0019032109303909584_icon.png', '[\"322\",\"257\",\"712\",\"716\",\"719\",\"818\",\"819\",\"820\",\"821\",\"822\",\"823\",\"824\",\"825\",\"487\",\"421\",\"422\"]', '2019-03-21 09:30:39', '2019-03-21 09:30:39');
INSERT INTO `tbl_huijiao_lessons` VALUES (166, NULL, '古诗二首-夜宿山寺，敕勒歌', 3, 108, 0, 1, NULL, 'uploads/contents/qd0019032109312101268_icon.png', '[\"323\",\"258\",\"259\",\"723\",\"826\",\"827\",\"828\",\"829\",\"830\",\"831\",\"832\",\"833\",\"488\",\"424\",\"425\"]', '2019-03-21 09:31:21', '2019-03-21 09:31:21');
INSERT INTO `tbl_huijiao_lessons` VALUES (167, NULL, '雾在哪里', 3, 109, 0, 1, NULL, 'uploads/contents/qd0019032109315802468_icon.png', '[\"324\",\"263\",\"725\",\"728\",\"732\",\"834\",\"835\",\"836\",\"837\",\"838\",\"839\",\"841\",\"842\",\"490\",\"427\",\"428\"]', '2019-03-21 09:31:58', '2019-03-21 09:31:58');
INSERT INTO `tbl_huijiao_lessons` VALUES (168, NULL, '雪孩子', 3, 110, 0, 1, NULL, 'uploads/contents/qd0019032109325002869_icon.png', '[\"326\",\"260\",\"740\",\"744\",\"746\",\"844\",\"846\",\"848\",\"850\",\"852\",\"854\",\"855\",\"857\",\"492\",\"430\",\"431\"]', '2019-03-21 09:32:50', '2019-03-21 09:32:50');
INSERT INTO `tbl_huijiao_lessons` VALUES (169, NULL, '狐假虎威', 3, 112, 0, 1, NULL, 'uploads/contents/qd0019032109332408598_icon.png', '[\"327\",\"261\",\"749\",\"751\",\"754\",\"859\",\"860\",\"862\",\"864\",\"866\",\"869\",\"871\",\"873\",\"493\",\"433\",\"434\"]', '2019-03-21 09:33:24', '2019-03-21 09:33:24');
INSERT INTO `tbl_huijiao_lessons` VALUES (170, NULL, '狐狸分奶酪', 3, 113, 0, 1, NULL, 'uploads/contents/qd0019032109340203026_icon.png', '[\"328\",\"262\",\"757\",\"759\",\"760\",\"874\",\"876\",\"877\",\"879\",\"881\",\"883\",\"884\",\"885\",\"494\",\"435\",\"436\"]', '2019-03-21 09:34:02', '2019-03-21 09:34:02');
INSERT INTO `tbl_huijiao_lessons` VALUES (171, NULL, '纸船和风筝', 3, 115, 0, 1, NULL, 'uploads/contents/qd0019032109343206683_icon.png', '[\"329\",\"267\",\"763\",\"764\",\"766\",\"886\",\"887\",\"888\",\"889\",\"890\",\"891\",\"892\",\"893\",\"495\",\"437\",\"438\"]', '2019-03-21 09:34:32', '2019-03-21 17:38:56');
INSERT INTO `tbl_huijiao_lessons` VALUES (172, NULL, '风娃娃', 3, 116, 0, 1, NULL, 'uploads/contents/qd0019032109350209365_icon.png', '[\"330\",\"265\",\"769\",\"772\",\"774\",\"894\",\"895\",\"896\",\"897\",\"898\",\"899\",\"901\",\"900\",\"496\",\"439\",\"440\"]', '2019-03-21 09:35:02', '2019-03-21 17:40:21');
INSERT INTO `tbl_huijiao_lessons` VALUES (174, NULL, '345345', 1, 1, 370, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '[\"1181\",\"1182\",\"1183\"]', '2019-05-09 00:28:27', '2019-05-09 00:28:27');
INSERT INTO `tbl_huijiao_lessons` VALUES (175, NULL, 'werwer', 3, 38, 385, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '[\"125\",\"91\",\"103\"]', '2019-05-22 15:43:16', '2019-05-22 15:43:16');
INSERT INTO `tbl_huijiao_lessons` VALUES (176, NULL, 'test', 1, 173, 385, 1, NULL, 'uploads/contents/qd0019072009565403082_icon.png', '[\"1114\",\"1188\"]', '2019-07-20 09:56:54', '2019-07-20 09:56:54');
INSERT INTO `tbl_huijiao_lessons` VALUES (177, NULL, 'fg ', 1, 1, 385, 1, NULL, 'uploads/contents/qd0019072216103703587_icon.jpg', '[\"1190\"]', '2019-07-22 16:10:37', '2019-07-22 16:10:37');
INSERT INTO `tbl_huijiao_lessons` VALUES (178, NULL, 'gtdf ', 1, 1, 385, 1, NULL, 'uploads/contents/qd0019072216110602730_icon.jpg', '[\"1191\"]', '2019-07-22 16:11:06', '2019-07-22 16:11:06');
INSERT INTO `tbl_huijiao_lessons` VALUES (179, NULL, 'tgd', 1, 1, 385, 1, NULL, 'uploads/contents/qd0019072216113004669_icon.jpg', '[\"1192\"]', '2019-07-22 16:11:30', '2019-07-22 16:11:30');
INSERT INTO `tbl_huijiao_lessons` VALUES (180, NULL, '756756756', 1, 1, 385, 1, NULL, 'uploads/contents/qd0019073116242109660_icon.png', '[\"1194\",\"235\"]', '2019-07-31 16:24:21', '2019-07-31 16:24:21');
INSERT INTO `tbl_huijiao_lessons` VALUES (181, NULL, '123123123', 0, 87, 385, 1, NULL, 'uploads/contents/qd0019081916074104033_icon.png', '[\"376\",\"1195\"]', '2019-08-19 16:07:41', '2019-08-19 16:07:41');
INSERT INTO `tbl_huijiao_lessons` VALUES (182, NULL, '567567', 1, 85, 385, 1, NULL, 'uploads/lessons/qd182019082921525804063_icon.png', '[\"235\",\"1196\",\"268\"]', '2019-08-29 20:31:05', '2019-08-29 21:52:58');

-- ----------------------------
-- Table structure for tbl_huijiao_recommend
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_recommend`;
CREATE TABLE `tbl_huijiao_recommend`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(1) NULL DEFAULT 0 COMMENT '0-course, 1-lesson',
  `recommend_no` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int(10) NULL DEFAULT NULL,
  `content_id` int(10) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `sort_order` int(10) NULL DEFAULT NULL,
  `image_icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_recommend
-- ----------------------------
INSERT INTO `tbl_huijiao_recommend` VALUES (52, 0, '1', '4', NULL, 90, 1, NULL, 'uploads/contents/qd0019031811311903461_icon.png', '2019-03-18 11:31:19', '2019-03-18 11:31:19');
INSERT INTO `tbl_huijiao_recommend` VALUES (53, 0, '2', '222', 0, 198, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '2019-03-18 13:15:31', '2019-07-02 22:21:29');
INSERT INTO `tbl_huijiao_recommend` VALUES (54, 0, 'zy7', '22', 0, 125, 1, NULL, 'uploads/contents/qd54019080120383709033_rcm.png', '2019-03-19 13:11:21', '2019-08-01 20:38:37');
INSERT INTO `tbl_huijiao_recommend` VALUES (56, 0, '4', '的', NULL, 98, 1, NULL, 'assets/images/huijiao/tab2/icon0.png', '2019-03-19 18:15:34', '2019-03-19 18:15:34');
INSERT INTO `tbl_huijiao_recommend` VALUES (57, 1, '1', '2', NULL, 70, 1, NULL, '', '2019-07-01 22:49:46', '2019-07-01 22:49:48');
INSERT INTO `tbl_huijiao_recommend` VALUES (58, 1, '2', '3', 0, 58, 0, NULL, 'uploads/contents/qd58019080120390004420_rcm.png', '2019-07-01 22:49:50', '2019-08-01 20:39:00');
INSERT INTO `tbl_huijiao_recommend` VALUES (59, 1, '3', '4', 0, 144, 0, NULL, '', '2019-07-01 22:49:54', '2019-07-02 22:27:11');
INSERT INTO `tbl_huijiao_recommend` VALUES (60, 1, '4', '5', NULL, 76, 1, NULL, '', '2019-07-01 22:50:01', '2019-07-01 22:50:03');

-- ----------------------------
-- Table structure for tbl_huijiao_subject
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_subject`;
CREATE TABLE `tbl_huijiao_subject`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` int(2) NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image_icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `status` tinyint(2) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_subject
-- ----------------------------
INSERT INTO `tbl_huijiao_subject` VALUES (1, 'bb0201', 0, '小学语文', 'tubiaoyuwen', 1, '2019-02-15 09:50:29', '2019-03-18 13:39:20', NULL);
INSERT INTO `tbl_huijiao_subject` VALUES (2, 'qd0202', 0, '小学数学', 'tubiaoshuxue', 1, '2019-02-15 09:50:29', '2019-03-18 14:33:02', NULL);
INSERT INTO `tbl_huijiao_subject` VALUES (3, 'qd0203', 2, '初中数学', 'tubiaoshuxue', 1, '2019-02-15 09:50:29', '2019-03-18 15:18:06', NULL);
INSERT INTO `tbl_huijiao_subject` VALUES (4, 'rj0304', 2, '初中物理', 'tubiaoyuwen', 1, '2019-02-15 09:50:29', '2019-03-20 09:55:52', NULL);

-- ----------------------------
-- Table structure for tbl_huijiao_terms
-- ----------------------------
DROP TABLE IF EXISTS `tbl_huijiao_terms`;
CREATE TABLE `tbl_huijiao_terms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `subject_id` int(10) NULL DEFAULT NULL,
  `image_icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_huijiao_terms
-- ----------------------------
INSERT INTO `tbl_huijiao_terms` VALUES (1, 'bb020101', '一年级上', 1, 1, '', '2019-02-15 09:50:45', '2019-03-18 13:42:34');
INSERT INTO `tbl_huijiao_terms` VALUES (2, 'bb020102', '一年级下', 1, 1, '', '2019-02-15 09:50:45', '2019-03-18 13:42:41');
INSERT INTO `tbl_huijiao_terms` VALUES (3, 'bb020103', '二年级上', 1, 1, '', '2019-02-15 09:50:45', '2019-03-18 13:42:48');
INSERT INTO `tbl_huijiao_terms` VALUES (4, 'bb020104', '二年级下', 1, 1, '', '2019-02-15 09:50:45', '2019-03-18 13:43:24');
INSERT INTO `tbl_huijiao_terms` VALUES (5, 'bb020105', '三年级上', 1, 1, '', '2019-02-15 09:50:45', '2019-03-18 13:43:32');
INSERT INTO `tbl_huijiao_terms` VALUES (6, 'bb020106', '三年级下', 1, 1, '', '2019-02-15 09:50:45', '2019-03-18 13:43:40');
INSERT INTO `tbl_huijiao_terms` VALUES (7, 'qd020201', '一年级上', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (8, 'qd020202', '一年级下', 1, 2, '', '2019-02-15 09:50:45', '2019-03-18 14:33:47');
INSERT INTO `tbl_huijiao_terms` VALUES (9, 'qd020203', '二年级上', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (10, 'qd020204', '二年级下', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (11, 'qd020205', '三年级上', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (12, 'qd020206', '三年级下', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (13, 'qd020207', '四年级上', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (14, 'qd020208', '四年级下', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (15, 'qd020209', '五年级上', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (16, 'qd020210', '五年级下', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (17, 'qd020211', '六年级上', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (18, 'qd020212', '六年级下', 1, 2, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (19, 'qd020301', '七年级上', 1, 3, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (20, 'qd020302', '七年级下', 1, 3, '', '2019-02-15 09:50:45', '2019-03-19 11:51:45');
INSERT INTO `tbl_huijiao_terms` VALUES (21, 'qd020303', '八年级上', 1, 3, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (22, 'qd020304', '八年级下', 1, 3, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (23, 'qd020305', '九年级上', 1, 3, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (24, 'qd020306', '九年级下', 1, 3, '', '2019-02-15 09:50:45', '2019-02-15 09:50:48');
INSERT INTO `tbl_huijiao_terms` VALUES (26, 'rj030404', '八年级下', 1, 4, '', '2019-02-15 09:50:45', '2019-03-21 13:21:39');
INSERT INTO `tbl_huijiao_terms` VALUES (29, '01', '七年级上', 1, 6, '', '2019-02-28 10:35:23', '2019-02-28 10:35:23');
INSERT INTO `tbl_huijiao_terms` VALUES (30, 'bb020107', '四年级上', 1, 1, '', '2019-02-28 15:32:20', '2019-03-18 13:44:26');
INSERT INTO `tbl_huijiao_terms` VALUES (31, 'awer', '新的册次', 1, 7, '', '2019-02-28 23:03:15', '2019-02-28 23:03:15');
INSERT INTO `tbl_huijiao_terms` VALUES (32, 'bb020108', '四年级下', 1, 1, '', '2019-03-12 11:16:34', '2019-03-18 13:44:37');
INSERT INTO `tbl_huijiao_terms` VALUES (35, 'rj030403', '八年级上', 1, 4, '', '2019-03-21 13:20:26', '2019-03-21 13:20:26');

-- ----------------------------
-- Table structure for tbl_questions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_questions`;
CREATE TABLE `tbl_questions`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_id` int(10) NULL DEFAULT 0,
  `status` int(1) NULL DEFAULT NULL,
  `question_type` int(1) NULL DEFAULT 0 COMMENT '0-multiselect,1-yesno,2-fillblank,3-connection',
  `difficult_type` int(1) NULL DEFAULT 0 COMMENT '0-easy,1-medium,3-difficult',
  `course_type_id` int(10) NULL DEFAULT NULL,
  `question_type_id` int(10) NOT NULL,
  `question_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `question_answer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `question_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `read_count` int(20) NULL DEFAULT 0,
  `right_count` int(20) NULL DEFAULT 0,
  `wrong_count` int(20) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 529 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_questions
-- ----------------------------
INSERT INTO `tbl_questions` VALUES (516, 'asdf', NULL, 0, 1, 0, 0, 38, 0, '这是提示文案。答案是AC，&nbsp;<span>&nbsp;</span><div><span><span>&nbsp;</span><br></span></div>', '[{\"id\":0,\"content\":\"这是答案A\",\"is_checked\":true},{\"id\":1,\"content\":\"这是答案B<span>&nbsp;</span>\",\"is_checked\":false},{\"id\":2,\"content\":\"答案C\",\"is_checked\":true},{\"id\":3,\"content\":\"这是答案D\",\"is_checked\":false}]', 'qwerfqwef', 0, 0, 0, '2019-04-04 17:31:45', '2019-04-26 09:25:55');
INSERT INTO `tbl_questions` VALUES (517, 'werwe', NULL, 0, 1, 1, 0, 38, 0, '玩儿翁二答案是：否', '[{\"id\":0,\"content\":\"\",\"is_checked\":true},{\"id\":1,\"content\":\"\",\"is_checked\":false}]', '', 0, 0, 0, '2019-04-04 21:33:04', '2019-04-26 09:26:01');
INSERT INTO `tbl_questions` VALUES (518, '5675234', NULL, 0, 0, 2, 0, 38, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd001019050110194204S3ce.png\">&nbsp;</span>这是<span><sub>提示</sub>&nbsp;</span>文档<span>&nbsp;<input class=\"blank-item\" data-id=\"1\" contenteditable=\"false\">&nbsp;答案是<span><sup>A</sup>&nbsp;</span>或<span><sub>B</sub>&nbsp;</span>&nbsp; ，&nbsp;<span>&nbsp;<input class=\"blank-item\" data-id=\"2\" contenteditable=\"false\">&nbsp;答<span><sup>案</sup>&nbsp;</span>是C，&nbsp;<span>&nbsp;<input class=\"blank-item\" data-id=\"3\" contenteditable=\"false\">&nbsp;答<span><sub>案是</sub>&nbsp;</span>D<span>&nbsp;<audio controls=\"\" playsinline=\"\" webkit-playsinline=\"\"><source src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd001019050109011907zUy6.mp3\" type=\"audio/mp3\"></audio>&nbsp;</span></span></span></span>', '[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}]', 'qwerqwerqwer', 0, 0, 0, '2019-04-05 10:39:40', '2019-05-01 10:19:44');
INSERT INTO `tbl_questions` VALUES (519, '56756756756', NULL, 0, 1, 0, 0, 38, 0, 'sdfs<span><sup>dfs</sup>&nbsp;</span>dftyut<span><sub>yu</sub>&nbsp;</span>tyu', '[{\"id\":0,\"content\":\"sdf\",\"is_checked\":false},{\"id\":1,\"content\":\"fgh\",\"is_checked\":true},{\"id\":2,\"content\":\"hjk\",\"is_checked\":false}]', '', 0, 0, 0, '2019-04-18 01:46:56', '2019-05-01 10:21:18');
INSERT INTO `tbl_questions` VALUES (521, '567ytrytr', NULL, 0, 1, 1, 0, 38, 0, 'ytryrtyrty', '[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}]', '', 0, 0, 0, '2019-04-18 01:48:16', '2019-05-01 10:21:35');
INSERT INTO `tbl_questions` VALUES (522, '41', NULL, 0, 0, 0, 1, 38, 0, '<p class=\"MsoNormal\"><span lang=\"ZH-CN\" style=\"font-family:DengXian;mso-ascii-font-family:\nAlgerian;mso-fareast-theme-font:minor-fareast;mso-hansi-font-family:Algerian\">阿斯顿发斯蒂芬</span><span style=\"font-family:Algerian\">asdfasdfasdf<o:p></o:p></span></p><div><div><span>&nbsp;<audio controls=\"\" playsinline=\"\" webkit-playsinline=\"\"><source src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd00101904241146370KxAeN.mp3\" type=\"audio/mp3\"></audio>&nbsp;</span></div></div>', '[{\"id\":0,\"content\":\"更换\",\"is_checked\":false},{\"id\":1,\"content\":\"有\",\"is_checked\":true},{\"id\":2,\"content\":\"儿童\",\"is_checked\":false}]', '', 0, 0, 0, '2019-04-24 11:48:06', '2019-05-10 17:19:13');
INSERT INTO `tbl_questions` VALUES (523, 'bsd0302020104001', NULL, 0, 0, 0, 0, 65, 0, '<p class=\"MsoNormal\"><span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd00101905131705160vBcRz.png\">&nbsp;</span><br><span style=\"mso-spacerun:\'yes\';font-family:宋体;font-size:12.0000pt;\"><font face=\"Times New Roman\"></font></span></p>', '[{\"id\":0,\"content\":\"<p class=\\\"MsoNormal\\\"><span style=\\\"mso-spacerun:\'yes\';font-family:宋体;font-size:12.0000pt;\\\">1<font face=\\\"宋体\\\">个</font></span></p>\",\"is_checked\":false},{\"id\":1,\"content\":\"2个\",\"is_checked\":false},{\"id\":2,\"content\":\"3个\",\"is_checked\":true},{\"id\":3,\"content\":\"4个\",\"is_checked\":false}]', '', 0, 0, 0, '2019-05-13 17:06:30', '2019-05-13 17:06:30');
INSERT INTO `tbl_questions` VALUES (524, 'bsd0302020104002', NULL, 0, 0, 0, 0, 65, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd00101905131710300U4acz.png\">&nbsp;</span>', '[{\"id\":0,\"content\":\"1\",\"is_checked\":false},{\"id\":1,\"content\":\"2\",\"is_checked\":false},{\"id\":2,\"content\":\"-2\",\"is_checked\":false},{\"id\":3,\"content\":\"0\",\"is_checked\":true}]', '', 0, 0, 0, '2019-05-13 17:10:48', '2019-05-13 17:10:48');
INSERT INTO `tbl_questions` VALUES (525, 'bsd0302020104003', NULL, 0, 0, 1, 0, 65, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd002019051317130706HuL5.png\">&nbsp;</span>', '[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}]', '', 0, 0, 0, '2019-05-13 17:13:12', '2019-05-13 17:13:12');
INSERT INTO `tbl_questions` VALUES (526, 'bsd0302020104004', NULL, 0, 0, 1, 0, 65, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd00101905131714490HD8cd.png\">&nbsp;</span>', '[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}]', '', 0, 0, 0, '2019-05-13 17:14:54', '2019-05-13 17:14:54');
INSERT INTO `tbl_questions` VALUES (527, 'bsd0302020104005', NULL, 0, 0, 1, 1, 65, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd00101905131717190QETmq.png\">&nbsp;</span>', '[{\"id\":0,\"content\":\"\",\"is_checked\":true},{\"id\":1,\"content\":\"\",\"is_checked\":false}]', '', 0, 0, 0, '2019-05-13 17:17:30', '2019-05-13 17:17:30');
INSERT INTO `tbl_questions` VALUES (528, 'bsd0302020104006', NULL, 0, 0, 2, 0, 65, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd00301905131733370JBAJZ.png\">&nbsp;</span><span>&nbsp;<input class=\"blank-item\" data-id=\"1\" contenteditable=\"false\">&nbsp;</span><span>&nbsp;&nbsp;</span><br>', '[{\"id\":0,\"content\":\"<span>&nbsp;<img src=\\\"http://qdzyxm.hulalaedu.com/uploads/questions/qd004019051317335407V38q.png\\\">&nbsp;</span>\",\"is_checked\":true}]', '', 0, 0, 0, '2019-05-13 17:34:05', '2019-05-13 17:34:05');

-- ----------------------------
-- Table structure for tbl_teacher_work
-- ----------------------------
DROP TABLE IF EXISTS `tbl_teacher_work`;
CREATE TABLE `tbl_teacher_work`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) NULL DEFAULT NULL,
  `course_type_id` int(20) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL COMMENT '0-disabled, 1-allowed',
  `class_id` int(4) NULL DEFAULT NULL,
  `title` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_id` int(10) NULL DEFAULT NULL,
  `end_time` datetime(0) NULL DEFAULT NULL,
  `work_status` int(2) NULL DEFAULT NULL,
  `problem_info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `spent_time` bigint(10) NULL DEFAULT 0,
  `period_time` int(10) NULL DEFAULT NULL,
  `answer_info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `answer_type` int(2) NULL DEFAULT NULL COMMENT '0-not answered, 1- already answered',
  `first_mark` int(2) NULL DEFAULT 6,
  `student_mark` int(2) NULL DEFAULT 0,
  `worked_time` datetime(0) NULL DEFAULT NULL,
  `read_status` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 753 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_teacher_work
-- ----------------------------
INSERT INTO `tbl_teacher_work` VALUES (54, 370, 125, 0, 21, 'asdf', NULL, '2018-08-15 22:30:00', 0, '[518,517,516]', 0, 20, NULL, 0, 6, 0, NULL, 2);
INSERT INTO `tbl_teacher_work` VALUES (68, 370, 38, 0, 21, 'ceshi2018', NULL, '2018-08-25 15:30:00', 1, '[517,518,516]', 0, 5, NULL, 0, 6, 0, NULL, 2);
INSERT INTO `tbl_teacher_work` VALUES (725, 370, NULL, 1, 21, 'asdf', 371, '2018-08-15 22:30:00', 0, '[518,517,516]', 0, 20, '[{\"id\":\"518\",\"type\":2,\"ques\":\"这是<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>提示</sub> </span>文档<span style=\\\"padding: 0px; margin: 0px;\\\"> <input class=\\\"blank-item\\\" data-id=\\\"1\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\"> 答案是<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>A</sup> </span>或<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>B</sub> </span>  ， <span style=\\\"padding: 0px; margin: 0px;\\\"> <input class=\\\"blank-item\\\" data-id=\\\"2\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\"> 答<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>案</sup> </span>是C， <span style=\\\"padding: 0px; margin: 0px;\\\"> <input class=\\\"blank-item\\\" data-id=\\\"3\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\"> 答<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>案是</sub> </span>D</span></span></span>\",\"ans\":[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":\"A\"},{\"student_checked\":\"C\"},{\"student_checked\":\"D\"}],\"is_right\":true},{\"id\":\"517\",\"type\":0,\"ques\":\"玩儿翁二答案是：否\",\"ans\":[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":false},{\"student_checked\":true}],\"is_right\":true},{\"id\":\"516\",\"type\":0,\"ques\":\"这是提示文案。答案是AC， <span> <video controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\" width=\\\"320\\\" height=\\\"180\\\" style=\\\"width:320px;height:180px;\\\"><source src=\\\"http://localhost/huijiao/uploads/questions/qd00101904051209100CtcgM.mp4\\\" type=\\\"video/mp4\\\"></video> </span><div><span><span> <audio controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\"><source src=\\\"http://localhost/huijiao/uploads/questions/qd00201904051209320vcfoj.mp3\\\" type=\\\"audio/mp3\\\"></audio> </span><span> </span><br></span></div>\",\"ans\":[{\"id\":0,\"content\":\"这是答案A\",\"is_checked\":true},{\"id\":1,\"content\":\"这是答案B<span> <img src=\\\"http://localhost/huijiao/uploads/questions/qd00401904051209560Nb895.png\\\"> </span>\",\"is_checked\":false},{\"id\":2,\"content\":\"答案C\",\"is_checked\":true},{\"id\":3,\"content\":\"这是答案D\",\"is_checked\":false}],\"ans_student\":[{\"student_checked\":true},{\"student_checked\":false},{\"student_checked\":true},{\"student_checked\":false}],\"is_right\":true}]', 0, 3, 5, NULL, 1);
INSERT INTO `tbl_teacher_work` VALUES (726, 370, 125, 1, 21, '阿斯顿发生的发放', NULL, '2019-04-17 00:30:00', 0, '[\"518\",\"516\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (727, 370, 125, 1, 25, '阿斯顿发生的发放', NULL, '2019-04-17 00:30:00', 0, '[\"518\",\"516\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (728, 370, 125, 1, 21, '爱上对方为', NULL, '2019-04-18 05:30:00', 0, '[\"518\",\"516\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (729, 370, 125, 1, 21, 'ergwerwerqwer', NULL, '2019-04-24 05:20:00', 0, '[\"518\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (730, 370, 125, 1, 25, 'ergwerwerqwer', NULL, '2019-04-24 05:20:00', 0, '[\"518\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (731, 370, NULL, 2, 21, 'asdf', 376, '2018-08-15 22:30:00', 0, '[518,517,516]', 0, 20, '[{\"id\":\"518\",\"type\":2,\"ques\":\"这是<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>提示</sub> </span>文档<span style=\\\"padding: 0px; margin: 0px;\\\"> <input class=\\\"blank-item\\\" data-id=\\\"1\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\"> 答案是<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>A</sup> </span>或<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>B</sub> </span>  ， <span style=\\\"padding: 0px; margin: 0px;\\\"> <input class=\\\"blank-item\\\" data-id=\\\"2\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\"> 答<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>案</sup> </span>是C， <span style=\\\"padding: 0px; margin: 0px;\\\"> <input class=\\\"blank-item\\\" data-id=\\\"3\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\"> 答<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>案是</sub> </span>D</span></span></span>\",\"ans\":[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":\"A\"},{\"student_checked\":\"C\"},{\"student_checked\":\"D\"}],\"is_right\":true},{\"id\":\"517\",\"type\":0,\"ques\":\"玩儿翁二答案是：否\",\"ans\":[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":false},{\"student_checked\":true}],\"is_right\":true},{\"id\":\"516\",\"type\":0,\"ques\":\"这是提示文案。答案是AC，&nbsp;<span>&nbsp;<video controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\" width=\\\"320\\\" height=\\\"180\\\" style=\\\"width:320px;height:180px;\\\"><source src=\\\"http://localhost/huijiao/uploads/questions/qd00101904051209100CtcgM.mp4\\\" type=\\\"video/mp4\\\"></video>&nbsp;</span><div><span><span>&nbsp;<audio controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\"><source src=\\\"http://localhost/huijiao/uploads/questions/qd00201904051209320vcfoj.mp3\\\" type=\\\"audio/mp3\\\"></audio>&nbsp;</span><span>&nbsp;</span><br></span></div>\",\"ans\":[{\"id\":0,\"content\":\"这是答案A\",\"is_checked\":true},{\"id\":1,\"content\":\"这是答案B<span> <img src=\\\"http://localhost/huijiao/uploads/questions/qd00401904051209560Nb895.png\\\"> </span>\",\"is_checked\":false},{\"id\":2,\"content\":\"答案C\",\"is_checked\":true},{\"id\":3,\"content\":\"这是答案D\",\"is_checked\":false}],\"ans_student\":[{\"student_checked\":false},{\"student_checked\":false},{\"student_checked\":true},{\"student_checked\":false}],\"is_right\":false}]', 0, 2, 3, NULL, 1);
INSERT INTO `tbl_teacher_work` VALUES (732, 370, NULL, 0, 21, 'asdf', 377, '2018-08-15 22:30:00', 0, '[518,517,516]', 0, 20, NULL, 0, 6, 0, NULL, 1);
INSERT INTO `tbl_teacher_work` VALUES (744, 370, 125, 0, 21, '认为如果我二哥', NULL, '2019-04-22 17:05:00', 0, '[\"518\",\"516\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (745, 370, NULL, 0, 21, '认为如果我二哥', 371, '2019-04-22 17:05:00', 0, '[\"518\",\"516\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (746, 370, NULL, 2, 21, '认为如果我二哥', 376, '2019-04-22 17:05:00', 0, '[\"518\",\"516\"]', 0, 0, '[{\"id\":\"518\",\"type\":2,\"ques\":\"<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<img src=\\\"http://qdzyxm.hulalaedu.com/uploads/questions/qd001019050110194204S3ce.png\\\">&nbsp;</span>这是<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>提示</sub>&nbsp;</span>文档<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"1\\\" contenteditable=\\\"false\\\" style=\\\"width: 30px; text-align: center; margin: 0px;\\\">&nbsp;答案是<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>A</sup>&nbsp;</span>或<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>B</sub>&nbsp;</span>&nbsp; ，&nbsp;<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"2\\\" contenteditable=\\\"false\\\" style=\\\"width: 30px; text-align: center; margin: 0px;\\\">&nbsp;答<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>案</sup>&nbsp;</span>是C，&nbsp;<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"3\\\" contenteditable=\\\"false\\\" style=\\\"width: 30px; text-align: center; margin: 0px;\\\">&nbsp;答<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>案是</sub>&nbsp;</span>D<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<audio controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\"><source src=\\\"http://qdzyxm.hulalaedu.com/uploads/questions/qd001019050109011907zUy6.mp3\\\" type=\\\"audio/mp3\\\"></audio>&nbsp;</span></span></span></span>\",\"ans\":[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":\"\"},{\"student_checked\":\"\"},{\"student_checked\":\"\"}],\"is_right\":false},{\"id\":\"516\",\"type\":0,\"ques\":\"这是提示文案。答案是AC，&nbsp;<span>&nbsp;</span><div><span><span>&nbsp;</span><br></span></div>\",\"ans\":[{\"id\":0,\"content\":\"这是答案A\",\"is_checked\":true},{\"id\":1,\"content\":\"这是答案B<span> </span>\",\"is_checked\":false},{\"id\":2,\"content\":\"答案C\",\"is_checked\":true},{\"id\":3,\"content\":\"这是答案D\",\"is_checked\":false}],\"ans_student\":[{\"student_checked\":true},{\"student_checked\":true},{\"student_checked\":false},{\"student_checked\":false}],\"is_right\":false}]', 0, 0, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (747, 370, NULL, 0, 21, '认为如果我二哥', 377, '2019-04-22 17:05:00', 0, '[\"518\",\"516\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (748, 370, 125, 0, 25, '认为如果我二哥', NULL, '2019-04-22 17:05:00', 0, '[\"518\",\"516\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (749, 369, 125, 0, 32, '各方违反', NULL, '2019-04-23 17:05:00', 0, '[\"518\",\"516\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (750, 369, NULL, 0, 32, '各方违反', 371, '2019-04-23 17:05:00', 0, '[\"518\",\"516\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (751, 369, NULL, 0, 32, '各方违反', 376, '2019-04-23 17:05:00', 0, '[\"518\",\"516\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);
INSERT INTO `tbl_teacher_work` VALUES (752, 369, NULL, 0, 32, '各方违反', 377, '2019-04-23 17:05:00', 0, '[\"518\",\"516\",\"517\"]', 0, 0, NULL, 0, 6, 0, NULL, 0);

-- ----------------------------
-- Table structure for tbl_usage
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usage`;
CREATE TABLE `tbl_usage`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `content_id` int(10) NULL DEFAULT NULL,
  `lesson_id` int(10) NULL DEFAULT NULL COMMENT '1-teacher,2-student',
  `usage_type` int(1) NULL DEFAULT NULL COMMENT '0-content usage,1-lesson usage',
  `status` int(1) NULL DEFAULT NULL,
  `is_favorite` int(1) NULL DEFAULT 0 COMMENT '0-no,1-favor',
  `is_like` int(1) NULL DEFAULT 0,
  `read_count` int(10) NULL DEFAULT 0,
  `share_count` int(10) NULL DEFAULT 0,
  `download_count` int(10) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 633 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_usage
-- ----------------------------
INSERT INTO `tbl_usage` VALUES (536, 371, 99, NULL, NULL, NULL, 0, 1, 0, 0, 0, '2019-04-10 22:12:04', '2019-04-10 22:12:04');
INSERT INTO `tbl_usage` VALUES (537, 371, 98, NULL, NULL, NULL, 0, 1, 0, 0, 0, '2019-04-10 22:12:06', '2019-04-10 22:12:06');
INSERT INTO `tbl_usage` VALUES (538, 371, 90, NULL, NULL, NULL, 1, 1, 435, 0, 0, '2019-04-10 22:12:16', '2019-04-13 15:23:35');
INSERT INTO `tbl_usage` VALUES (539, 371, 266, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-04-11 08:18:04', '2019-04-11 08:18:26');
INSERT INTO `tbl_usage` VALUES (540, 371, 175, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-12 01:56:09', '2019-04-12 01:56:09');
INSERT INTO `tbl_usage` VALUES (541, 371, 237, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-12 01:58:31', '2019-04-12 01:58:31');
INSERT INTO `tbl_usage` VALUES (542, 371, 911, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-04-12 01:59:58', '2019-04-12 02:00:21');
INSERT INTO `tbl_usage` VALUES (543, 371, 206, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-12 02:00:34', '2019-04-12 02:00:34');
INSERT INTO `tbl_usage` VALUES (544, 371, 967, NULL, NULL, NULL, 0, 0, 50, 0, 0, '2019-04-12 02:02:16', '2019-04-12 02:14:55');
INSERT INTO `tbl_usage` VALUES (545, 371, 146, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-12 02:07:23', '2019-04-12 02:07:23');
INSERT INTO `tbl_usage` VALUES (546, 371, 1161, NULL, NULL, NULL, 0, 0, 15, 0, 0, '2019-04-12 02:12:02', '2019-04-12 02:16:57');
INSERT INTO `tbl_usage` VALUES (547, 371, 110, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-12 02:13:53', '2019-04-12 02:13:53');
INSERT INTO `tbl_usage` VALUES (548, 371, NULL, 110, NULL, NULL, 1, 1, 5, 0, 0, '2019-04-13 15:23:57', '2019-04-13 15:24:02');
INSERT INTO `tbl_usage` VALUES (549, 370, 90, NULL, NULL, NULL, 0, 1, 15, 0, 0, '2019-04-14 07:33:02', '2019-05-21 19:44:07');
INSERT INTO `tbl_usage` VALUES (550, 370, 241, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-16 09:41:59', '2019-04-16 09:41:59');
INSERT INTO `tbl_usage` VALUES (551, 380, 90, NULL, NULL, NULL, 1, 1, 5, 0, 0, '2019-04-17 20:12:42', '2019-04-17 20:12:49');
INSERT INTO `tbl_usage` VALUES (552, 380, 235, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-17 20:13:09', '2019-04-17 20:13:09');
INSERT INTO `tbl_usage` VALUES (553, 380, NULL, 110, NULL, NULL, 1, 1, 5, 0, 0, '2019-04-17 20:13:25', '2019-04-17 20:13:31');
INSERT INTO `tbl_usage` VALUES (554, 376, 90, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-04-18 08:14:45', '2019-04-26 11:18:34');
INSERT INTO `tbl_usage` VALUES (555, 376, 98, NULL, NULL, NULL, 0, 1, 10, 0, 0, '2019-04-18 09:27:58', '2019-04-18 10:17:56');
INSERT INTO `tbl_usage` VALUES (556, 376, 238, NULL, NULL, NULL, 0, 1, 5, 0, 0, '2019-04-18 09:32:59', '2019-04-18 09:33:12');
INSERT INTO `tbl_usage` VALUES (557, 376, 270, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-18 09:33:37', '2019-04-18 09:33:37');
INSERT INTO `tbl_usage` VALUES (558, 376, 99, NULL, NULL, NULL, 0, 1, 25, 0, 0, '2019-04-18 09:50:43', '2019-04-30 15:05:33');
INSERT INTO `tbl_usage` VALUES (559, 376, 99, NULL, NULL, NULL, 0, 0, 0, 0, 0, '2019-04-18 09:50:46', '2019-04-18 09:50:46');
INSERT INTO `tbl_usage` VALUES (560, 376, 99, NULL, NULL, NULL, 0, 1, 0, 0, 0, '2019-04-18 09:50:47', '2019-04-18 09:50:47');
INSERT INTO `tbl_usage` VALUES (561, 376, 268, NULL, NULL, NULL, 0, 0, 15, 0, 0, '2019-04-18 10:18:14', '2019-04-19 19:42:53');
INSERT INTO `tbl_usage` VALUES (562, 376, 334, NULL, NULL, NULL, 0, 0, 15, 0, 0, '2019-04-18 10:18:22', '2019-04-25 16:56:07');
INSERT INTO `tbl_usage` VALUES (563, 383, 1165, NULL, NULL, NULL, 0, 0, 15, 0, 0, '2019-04-24 11:43:27', '2019-04-24 11:48:48');
INSERT INTO `tbl_usage` VALUES (564, 383, 232, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-24 17:30:56', '2019-04-24 17:30:56');
INSERT INTO `tbl_usage` VALUES (565, 370, 99, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-25 16:08:25', '2019-04-25 16:08:25');
INSERT INTO `tbl_usage` VALUES (566, 370, 266, NULL, NULL, NULL, 0, 1, 0, 0, 0, '2019-04-26 08:58:17', '2019-04-26 08:58:17');
INSERT INTO `tbl_usage` VALUES (567, 370, 232, NULL, NULL, NULL, 0, 1, 5, 0, 0, '2019-04-26 08:58:18', '2019-04-27 13:44:32');
INSERT INTO `tbl_usage` VALUES (568, 370, 1165, NULL, NULL, NULL, 0, 1, 95, 0, 0, '2019-04-26 08:58:19', '2019-05-13 23:04:36');
INSERT INTO `tbl_usage` VALUES (569, 376, 1165, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-04-26 09:07:16', '2019-04-26 11:18:28');
INSERT INTO `tbl_usage` VALUES (570, 376, 226, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-26 09:07:22', '2019-04-26 09:14:30');
INSERT INTO `tbl_usage` VALUES (571, 370, 303, NULL, NULL, NULL, 0, 0, 15, 0, 0, '2019-04-27 13:44:19', '2019-04-27 13:44:59');
INSERT INTO `tbl_usage` VALUES (572, 370, 235, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-04-27 15:54:48', '2019-05-11 20:36:59');
INSERT INTO `tbl_usage` VALUES (573, 370, 229, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-27 15:55:13', '2019-04-27 15:55:13');
INSERT INTO `tbl_usage` VALUES (574, 370, 364, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-27 15:55:20', '2019-04-27 15:55:20');
INSERT INTO `tbl_usage` VALUES (575, 0, 1165, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-04-27 15:58:46', '2019-04-27 15:58:46');
INSERT INTO `tbl_usage` VALUES (576, 370, 242, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-05-08 17:02:21', '2019-05-08 17:02:21');
INSERT INTO `tbl_usage` VALUES (577, 370, 1171, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-05-08 23:16:27', '2019-05-08 23:16:27');
INSERT INTO `tbl_usage` VALUES (578, 370, 1174, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-05-08 23:43:44', '2019-05-08 23:43:44');
INSERT INTO `tbl_usage` VALUES (579, 370, 1180, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-05-09 00:06:04', '2019-05-09 00:06:04');
INSERT INTO `tbl_usage` VALUES (580, 0, NULL, 54, NULL, NULL, 0, 0, 10, 0, 0, '2019-05-09 00:57:36', '2019-05-09 00:57:43');
INSERT INTO `tbl_usage` VALUES (581, 0, NULL, 56, NULL, NULL, 0, 0, 10, 0, 0, '2019-05-09 00:57:47', '2019-05-09 00:57:51');
INSERT INTO `tbl_usage` VALUES (582, 0, 1184, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-05-09 17:00:00', '2019-05-09 17:00:52');
INSERT INTO `tbl_usage` VALUES (583, 370, 1184, NULL, NULL, NULL, 0, 0, 15, 0, 1, '2019-05-09 17:03:16', '2019-05-09 17:08:01');
INSERT INTO `tbl_usage` VALUES (584, 385, 364, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-05-21 20:09:02', '2019-05-21 20:09:02');
INSERT INTO `tbl_usage` VALUES (585, 385, 1166, NULL, NULL, NULL, 1, 1, 22, 0, 0, '2019-05-22 18:57:51', '2019-07-24 23:09:52');
INSERT INTO `tbl_usage` VALUES (586, 385, 90, NULL, NULL, NULL, 0, 1, 30, 0, 0, '2019-05-22 18:57:59', '2019-07-27 11:39:59');
INSERT INTO `tbl_usage` VALUES (587, 385, 235, NULL, NULL, NULL, 1, 1, 272, 0, 0, '2019-05-22 19:57:05', '2019-08-30 18:34:28');
INSERT INTO `tbl_usage` VALUES (588, 385, NULL, 175, NULL, NULL, 0, 0, 62, 0, 0, '2019-05-22 20:31:44', '2019-07-23 15:43:40');
INSERT INTO `tbl_usage` VALUES (589, 385, 236, NULL, NULL, NULL, 0, 1, 25, 0, 0, '2019-06-05 17:55:00', '2019-08-30 17:16:29');
INSERT INTO `tbl_usage` VALUES (590, 0, NULL, 175, NULL, NULL, 0, 0, 20, 0, 0, '2019-06-22 11:14:40', '2019-06-22 11:16:14');
INSERT INTO `tbl_usage` VALUES (591, 0, NULL, 174, NULL, NULL, 0, 0, 30, 0, 0, '2019-06-22 11:15:24', '2019-07-02 19:51:56');
INSERT INTO `tbl_usage` VALUES (592, 0, 236, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-06-22 11:17:36', '2019-06-22 11:17:46');
INSERT INTO `tbl_usage` VALUES (593, 385, 53, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-09 08:12:14', '2019-07-09 08:12:14');
INSERT INTO `tbl_usage` VALUES (594, 385, 198, NULL, NULL, NULL, 0, 0, 22, 0, 0, '2019-07-09 08:13:49', '2019-08-22 20:09:05');
INSERT INTO `tbl_usage` VALUES (595, 385, NULL, 146, NULL, NULL, 1, 0, 65, 0, 0, '2019-07-09 08:16:57', '2019-08-17 17:33:15');
INSERT INTO `tbl_usage` VALUES (596, 385, NULL, 72, NULL, NULL, 0, 0, 55, 0, 0, '2019-07-09 08:21:21', '2019-08-01 16:45:15');
INSERT INTO `tbl_usage` VALUES (597, 385, NULL, 70, NULL, NULL, 1, 1, 29, 0, 0, '2019-07-09 08:22:59', '2019-07-26 08:34:06');
INSERT INTO `tbl_usage` VALUES (598, 385, NULL, 145, NULL, NULL, 1, 1, 16, 0, 0, '2019-07-09 08:43:09', '2019-07-24 23:09:13');
INSERT INTO `tbl_usage` VALUES (599, 385, 994, NULL, NULL, NULL, 0, 1, 0, 0, 0, '2019-07-09 08:56:23', '2019-07-09 08:56:23');
INSERT INTO `tbl_usage` VALUES (600, 385, 241, NULL, NULL, NULL, 1, 1, 10, 0, 0, '2019-07-16 01:04:13', '2019-08-01 00:01:54');
INSERT INTO `tbl_usage` VALUES (601, 385, 242, NULL, NULL, NULL, 1, 1, 5, 0, 0, '2019-07-16 01:04:14', '2019-07-24 23:10:32');
INSERT INTO `tbl_usage` VALUES (602, 385, 252, NULL, NULL, NULL, 0, 1, 5, 0, 0, '2019-07-16 01:04:16', '2019-07-27 11:41:50');
INSERT INTO `tbl_usage` VALUES (603, 385, NULL, 147, NULL, NULL, 0, 1, 10, 0, 0, '2019-07-16 01:04:33', '2019-08-01 19:56:06');
INSERT INTO `tbl_usage` VALUES (604, 385, NULL, 144, NULL, NULL, 0, 0, 36, 0, 0, '2019-07-16 01:20:29', '2019-07-26 08:43:20');
INSERT INTO `tbl_usage` VALUES (605, 385, 263, NULL, NULL, NULL, 0, 1, 0, 0, 0, '2019-07-16 01:38:12', '2019-07-16 01:38:12');
INSERT INTO `tbl_usage` VALUES (606, 385, 125, NULL, NULL, NULL, 0, 0, 24, 0, 0, '2019-07-18 11:03:13', '2019-08-27 22:54:14');
INSERT INTO `tbl_usage` VALUES (607, 385, NULL, 176, NULL, NULL, 0, 0, 21, 0, 0, '2019-07-22 16:13:06', '2019-08-20 09:40:36');
INSERT INTO `tbl_usage` VALUES (608, 385, NULL, 156, NULL, NULL, 0, 1, 0, 0, 0, '2019-07-22 16:15:32', '2019-07-22 16:15:32');
INSERT INTO `tbl_usage` VALUES (609, 385, NULL, 179, NULL, NULL, 0, 0, 7, 0, 0, '2019-07-22 16:17:36', '2019-08-01 20:01:14');
INSERT INTO `tbl_usage` VALUES (610, 385, NULL, 177, NULL, NULL, 0, 0, 1, 0, 0, '2019-07-22 16:17:49', '2019-07-22 16:17:49');
INSERT INTO `tbl_usage` VALUES (611, 385, 1190, NULL, NULL, NULL, 0, 0, 1, 0, 0, '2019-07-22 16:18:05', '2019-07-22 16:18:05');
INSERT INTO `tbl_usage` VALUES (612, 385, NULL, 113, NULL, NULL, 0, 0, 1, 0, 0, '2019-07-23 15:43:24', '2019-07-23 15:43:24');
INSERT INTO `tbl_usage` VALUES (613, 385, 303, NULL, NULL, NULL, 0, 0, 1, 0, 0, '2019-07-23 21:09:17', '2019-07-23 21:09:17');
INSERT INTO `tbl_usage` VALUES (614, 385, NULL, 149, NULL, NULL, 0, 0, 10, 0, 0, '2019-07-24 23:09:26', '2019-08-01 19:56:12');
INSERT INTO `tbl_usage` VALUES (615, 385, NULL, 150, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-24 23:09:30', '2019-07-27 10:46:59');
INSERT INTO `tbl_usage` VALUES (616, 385, NULL, 151, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-24 23:09:34', '2019-07-26 18:37:01');
INSERT INTO `tbl_usage` VALUES (617, 385, NULL, 152, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-24 23:09:38', '2019-07-26 18:37:06');
INSERT INTO `tbl_usage` VALUES (618, 385, NULL, 153, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-24 23:09:43', '2019-07-26 18:37:09');
INSERT INTO `tbl_usage` VALUES (619, 385, 238, NULL, NULL, NULL, 0, 0, 25, 0, 0, '2019-07-24 23:10:12', '2019-08-29 21:47:21');
INSERT INTO `tbl_usage` VALUES (620, 385, 239, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-07-24 23:10:16', '2019-08-29 21:47:26');
INSERT INTO `tbl_usage` VALUES (621, 385, 240, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-24 23:10:22', '2019-07-26 18:19:00');
INSERT INTO `tbl_usage` VALUES (622, 385, NULL, 76, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-26 08:34:14', '2019-07-26 08:34:14');
INSERT INTO `tbl_usage` VALUES (623, 385, 244, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-26 18:33:50', '2019-07-26 18:36:45');
INSERT INTO `tbl_usage` VALUES (624, 385, 249, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-07-27 10:14:36', '2019-07-27 11:39:48');
INSERT INTO `tbl_usage` VALUES (625, 385, 245, NULL, NULL, NULL, 1, 0, 10, 0, 0, '2019-07-27 10:14:50', '2019-08-30 17:16:37');
INSERT INTO `tbl_usage` VALUES (626, 385, 1193, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-07-27 23:13:56', '2019-07-27 23:23:36');
INSERT INTO `tbl_usage` VALUES (627, 385, NULL, 180, NULL, NULL, 0, 0, 10, 0, 0, '2019-07-31 16:24:25', '2019-08-01 20:00:56');
INSERT INTO `tbl_usage` VALUES (628, 385, 1191, NULL, NULL, NULL, 0, 0, 5, 0, 0, '2019-08-08 01:07:08', '2019-08-08 01:07:08');
INSERT INTO `tbl_usage` VALUES (629, 385, 1196, NULL, NULL, NULL, 0, 0, 40, 0, 0, '2019-08-20 18:24:51', '2019-08-30 17:15:59');
INSERT INTO `tbl_usage` VALUES (630, 0, 125, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-08-27 22:54:23', '2019-08-28 20:17:11');
INSERT INTO `tbl_usage` VALUES (631, 0, 198, NULL, NULL, NULL, 0, 0, 10, 0, 0, '2019-08-27 22:54:36', '2019-08-28 09:11:35');
INSERT INTO `tbl_usage` VALUES (632, 385, 268, NULL, NULL, NULL, 0, 0, 20, 0, 0, '2019-08-30 16:58:01', '2019-08-30 17:02:03');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_account` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_avatar` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_type` int(1) NULL DEFAULT 1 COMMENT '0-guest, 1-teacher,2-student',
  `user_school` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_class` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `term_id` int(10) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0 COMMENT '0-disabled,1-active',
  `user_nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_media_info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `information` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `register_count` int(6) UNSIGNED NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `register_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 387 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (369, 'zypttaijiaoshi', '1553260663260', 'zypttaijiaoshi', NULL, 0, '演示部门', NULL, NULL, 8, 1, '平台教师', '{\"uid\":10003,\"nick_name\":\"\\u5e73\\u53f0\\u6559\\u5e08\",\"organId\":\"3443d23a89ad4670b286abb1d8e22a61\",\"user_type\":0,\"status\":\"1\",\"avatar\":\"http:\\/\\/www.qdedu.net\\/e5static\\/avatar\\/default.png\",\"organName\":\"\\u6f14\\u793a\\u90e8\\u95e8\"}', '{\"abc\":{\"id\":\"textarea11\",\"content\":\"asdfaf\"}}', '23.83.246.233', 231, '2019-03-12 18:54:52', '2019-03-22 21:17:59', '2019-03-22 11:18:54');
INSERT INTO `tbl_user` VALUES (374, 'huangjianyong', '1553246933773', 'huangjianyong', NULL, 1, '青岛市教育装备与信息技术中心', NULL, NULL, 3, 1, '黄建勇', '{\"uid\":9811,\"nick_name\":\"\\u9ec4\\u5efa\\u52c7\",\"organId\":\"efe97bae279f49a6b27dca3dc76a7567\",\"user_type\":8,\"status\":\"1\",\"avatar\":\"http:\\/\\/www.qdedu.net\\/e5static\\/avatar\\/default.png\",\"organName\":\"\\u9752\\u5c9b\\u5e02\\u6559\\u80b2\\u88c5\\u5907\\u4e0e\\u4fe1\\u606f\\u6280\\u672f\\u4e2d\\u5fc3\"}', NULL, '183.194.49.78', 20, '2019-03-20 16:19:36', '2019-03-22 17:29:05', '2019-03-21 11:25:03');
INSERT INTO `tbl_user` VALUES (385, '8295050', '1553063041122', '8295050', NULL, 1, '青岛市教育装备与信息技术中心技术', '1-1', NULL, 3, 1, '平台教师', '', NULL, '106.15.191.19', 103, '2019-05-21 19:57:39', '2019-08-31 08:58:55', '2019-08-30 18:23:10');
INSERT INTO `tbl_user` VALUES (386, '230103200209101916', '1553211880188', '230103200209101916', NULL, 1, NULL, '1-1', NULL, 0, 1, '230103200209101916', '', NULL, '60.23.104.138', 2, '2019-08-18 21:01:20', '2019-08-18 21:23:24', '2019-08-18 21:23:27');

-- ----------------------------
-- Table structure for tbl_wrong_set
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wrong_set`;
CREATE TABLE `tbl_wrong_set`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_id` int(10) NULL DEFAULT NULL,
  `question_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_id` int(10) NULL DEFAULT 0,
  `student_answer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `student_mark` int(1) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `question_type` int(1) NULL DEFAULT 0 COMMENT '0-multiselect,1-yesno,2-fillblank,3-connection',
  `difficult_type` int(1) NULL DEFAULT 0 COMMENT '0-easy,1-medium,3-difficult',
  `course_type_id` int(10) NULL DEFAULT NULL,
  `question_type_id` int(10) NOT NULL,
  `question_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `question_answer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `question_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `read_count` int(20) NULL DEFAULT 0,
  `right_count` int(20) NULL DEFAULT 0,
  `wrong_count` int(20) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 531 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_wrong_set
-- ----------------------------
INSERT INTO `tbl_wrong_set` VALUES (525, 517, 'werwe', NULL, 371, '{\"id\":\"525\",\"type\":0,\"ques\":\"\\u73a9\\u513f\\u7fc1\\u4e8c\\u7b54\\u6848\\u662f\\uff1a\\u5426\",\"ans\":[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":false},{\"student_checked\":true}],\"is_right\":true}', 0, 1, 1, 0, 38, 0, '玩儿翁二答案是：否', '[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}]', 'dfasdfasdf', 0, 0, 0, '2019-04-10 03:11:18', '2019-04-10 08:18:34');
INSERT INTO `tbl_wrong_set` VALUES (526, 516, 'asdf', NULL, 371, '{\"id\":\"526\",\"type\":0,\"ques\":\"\\u8fd9\\u662f\\u63d0\\u793a\\u6587\\u6848\\u3002\\u7b54\\u6848\\u662fAC\\uff0c&nbsp;<span>&nbsp;<video controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\" width=\\\"320\\\" height=\\\"180\\\" style=\\\"width:320px;height:180px;\\\"><source src=\\\"http:\\/\\/localhost\\/huijiao\\/uploads\\/questions\\/qd00101904051209100CtcgM.mp4\\\" type=\\\"video\\/mp4\\\"><\\/video>&nbsp;<\\/span><div><span><span>&nbsp;<audio controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\"><source src=\\\"http:\\/\\/localhost\\/huijiao\\/uploads\\/questions\\/qd00201904051209320vcfoj.mp3\\\" type=\\\"audio\\/mp3\\\"><\\/audio>&nbsp;<\\/span><span>&nbsp;<\\/span><br><\\/span><\\/div>\",\"ans\":[{\"id\":0,\"content\":\"\\u8fd9\\u662f\\u7b54\\u6848A\",\"is_checked\":true},{\"id\":1,\"content\":\"\\u8fd9\\u662f\\u7b54\\u6848B<span>\\u00a0<img src=\\\"http:\\/\\/localhost\\/huijiao\\/uploads\\/questions\\/qd00401904051209560Nb895.png\\\">\\u00a0<\\/span>\",\"is_checked\":false},{\"id\":2,\"content\":\"\\u7b54\\u6848C\",\"is_checked\":true},{\"id\":3,\"content\":\"\\u8fd9\\u662f\\u7b54\\u6848D\",\"is_checked\":false}],\"ans_student\":[{\"student_checked\":true},{\"student_checked\":false},{\"student_checked\":true},{\"student_checked\":false}],\"is_right\":true}', 0, 1, 0, 0, 86, 0, '这是提示文案。答案是AC，&nbsp;<span>&nbsp;<video controls=\"\" playsinline=\"\" webkit-playsinline=\"\" width=\"320\" height=\"180\" style=\"width:320px;height:180px;\"><source src=\"http://localhost/huijiao/uploads/questions/qd00101904051209100CtcgM.mp4\" type=\"video/mp4\"></video>&nbsp;</span><div><span><span>&nbsp;<audio controls=\"\" playsinline=\"\" webkit-playsinline=\"\"><source src=\"http://localhost/huijiao/uploads/questions/qd00201904051209320vcfoj.mp3\" type=\"audio/mp3\"></audio>&nbsp;</span><span>&nbsp;</span><br></span></div>', '[{\"id\":0,\"content\":\"这是答案A\",\"is_checked\":true},{\"id\":1,\"content\":\"这是答案B<span>&nbsp;<img src=\\\"http://localhost/huijiao/uploads/questions/qd00401904051209560Nb895.png\\\">&nbsp;</span>\",\"is_checked\":false},{\"id\":2,\"content\":\"答案C\",\"is_checked\":true},{\"id\":3,\"content\":\"这是答案D\",\"is_checked\":false}]', 'qwerfqwef', 0, 0, 0, '2019-04-10 03:11:22', '2019-04-10 03:13:02');
INSERT INTO `tbl_wrong_set` VALUES (527, 518, '5675234', NULL, 371, '{\"id\":\"527\",\"type\":2,\"ques\":\"\\u8fd9\\u662f<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>\\u63d0\\u793a<\\/sub>&nbsp;<\\/span>\\u6587\\u6863<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"1\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\">&nbsp;\\u7b54\\u6848\\u662f<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>A<\\/sup>&nbsp;<\\/span>\\u6216<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>B<\\/sub>&nbsp;<\\/span>&nbsp; \\uff0c&nbsp;<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"2\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\">&nbsp;\\u7b54<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>\\u6848<\\/sup>&nbsp;<\\/span>\\u662fC\\uff0c&nbsp;<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"3\\\" contenteditable=\\\"false\\\" style=\\\"width: 39px; text-align: center; margin: 0px; color: rgb(0, 185, 26); border: 2px solid rgb(0, 185, 26);\\\">&nbsp;\\u7b54<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>\\u6848\\u662f<\\/sub>&nbsp;<\\/span>D<\\/span><\\/span><\\/span>\",\"ans\":[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":\"B\"},{\"student_checked\":\"C\"},{\"student_checked\":\"D\"}],\"is_right\":true}', 0, 1, 2, 0, 46, 0, '这是<span><sub>提示</sub>&nbsp;</span>文档<span>&nbsp;<input class=\"blank-item\" data-id=\"1\" contenteditable=\"false\">&nbsp;答案是<span><sup>A</sup>&nbsp;</span>或<span><sub>B</sub>&nbsp;</span>&nbsp; ，&nbsp;<span>&nbsp;<input class=\"blank-item\" data-id=\"2\" contenteditable=\"false\">&nbsp;答<span><sup>案</sup>&nbsp;</span>是C，&nbsp;<span>&nbsp;<input class=\"blank-item\" data-id=\"3\" contenteditable=\"false\">&nbsp;答<span><sub>案是</sub>&nbsp;</span>D</span></span></span>', '[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}]', 'qwerqwerqwer', 0, 0, 0, '2019-04-10 07:25:38', '2019-04-10 07:44:45');
INSERT INTO `tbl_wrong_set` VALUES (528, 517, 'werwe', NULL, 376, '{\"id\":\"528\",\"type\":0,\"ques\":\"\\u73a9\\u513f\\u7fc1\\u4e8c\\u7b54\\u6848\\u662f\\uff1a\\u5426\",\"ans\":[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":false},{\"student_checked\":true}],\"is_right\":true}', 0, 1, 1, 0, 39, 0, '玩儿翁二答案是：否', '[{\"id\":0,\"content\":\"\",\"is_checked\":false},{\"id\":1,\"content\":\"\",\"is_checked\":true}]', 'dfasdfasdf', 0, 0, 0, '2019-04-17 10:51:54', '2019-04-17 10:52:04');
INSERT INTO `tbl_wrong_set` VALUES (529, 516, 'asdf', NULL, 376, '{\"id\":\"516\",\"type\":0,\"ques\":\"\\u8fd9\\u662f\\u63d0\\u793a\\u6587\\u6848\\u3002\\u7b54\\u6848\\u662fAC\\uff0c&nbsp;<span>&nbsp;<\\/span><div><span><span>&nbsp;<\\/span><br><\\/span><\\/div>\",\"ans\":[{\"id\":0,\"content\":\"\\u8fd9\\u662f\\u7b54\\u6848A\",\"is_checked\":true},{\"id\":1,\"content\":\"\\u8fd9\\u662f\\u7b54\\u6848B<span>\\u00a0<\\/span>\",\"is_checked\":false},{\"id\":2,\"content\":\"\\u7b54\\u6848C\",\"is_checked\":true},{\"id\":3,\"content\":\"\\u8fd9\\u662f\\u7b54\\u6848D\",\"is_checked\":false}],\"ans_student\":[{\"student_checked\":true},{\"student_checked\":true},{\"student_checked\":false},{\"student_checked\":false}],\"is_right\":false}', 0, 1, 0, 0, 38, 0, '这是提示文案。答案是AC，&nbsp;<span>&nbsp;</span><div><span><span>&nbsp;</span><br></span></div>', '[{\"id\":0,\"content\":\"这是答案A\",\"is_checked\":true},{\"id\":1,\"content\":\"这是答案B<span>&nbsp;</span>\",\"is_checked\":false},{\"id\":2,\"content\":\"答案C\",\"is_checked\":true},{\"id\":3,\"content\":\"这是答案D\",\"is_checked\":false}]', 'qwerfqwef', 0, 0, 0, '2019-04-17 10:52:04', '2019-05-09 04:05:30');
INSERT INTO `tbl_wrong_set` VALUES (530, 518, '5675234', NULL, 376, '{\"id\":\"518\",\"type\":2,\"ques\":\"<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<img src=\\\"http:\\/\\/qdzyxm.hulalaedu.com\\/uploads\\/questions\\/qd001019050110194204S3ce.png\\\">&nbsp;<\\/span>\\u8fd9\\u662f<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>\\u63d0\\u793a<\\/sub>&nbsp;<\\/span>\\u6587\\u6863<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"1\\\" contenteditable=\\\"false\\\" style=\\\"width: 30px; text-align: center; margin: 0px;\\\">&nbsp;\\u7b54\\u6848\\u662f<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>A<\\/sup>&nbsp;<\\/span>\\u6216<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>B<\\/sub>&nbsp;<\\/span>&nbsp; \\uff0c&nbsp;<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"2\\\" contenteditable=\\\"false\\\" style=\\\"width: 30px; text-align: center; margin: 0px;\\\">&nbsp;\\u7b54<span style=\\\"padding: 0px; margin: 0px;\\\"><sup>\\u6848<\\/sup>&nbsp;<\\/span>\\u662fC\\uff0c&nbsp;<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<input class=\\\"blank-item\\\" data-id=\\\"3\\\" contenteditable=\\\"false\\\" style=\\\"width: 30px; text-align: center; margin: 0px;\\\">&nbsp;\\u7b54<span style=\\\"padding: 0px; margin: 0px;\\\"><sub>\\u6848\\u662f<\\/sub>&nbsp;<\\/span>D<span style=\\\"padding: 0px; margin: 0px;\\\">&nbsp;<audio controls=\\\"\\\" playsinline=\\\"\\\" webkit-playsinline=\\\"\\\"><source src=\\\"http:\\/\\/qdzyxm.hulalaedu.com\\/uploads\\/questions\\/qd001019050109011907zUy6.mp3\\\" type=\\\"audio\\/mp3\\\"><\\/audio>&nbsp;<\\/span><\\/span><\\/span><\\/span>\",\"ans\":[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}],\"ans_student\":[{\"student_checked\":\"\"},{\"student_checked\":\"\"},{\"student_checked\":\"\"}],\"is_right\":false}', 0, 1, 2, 0, 26, 0, '<span>&nbsp;<img src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd001019050110194204S3ce.png\">&nbsp;</span>这是<span><sub>提示</sub>&nbsp;</span>文档<span>&nbsp;<input class=\"blank-item\" data-id=\"1\" contenteditable=\"false\">&nbsp;答案是<span><sup>A</sup>&nbsp;</span>或<span><sub>B</sub>&nbsp;</span>&nbsp; ，&nbsp;<span>&nbsp;<input class=\"blank-item\" data-id=\"2\" contenteditable=\"false\">&nbsp;答<span><sup>案</sup>&nbsp;</span>是C，&nbsp;<span>&nbsp;<input class=\"blank-item\" data-id=\"3\" contenteditable=\"false\">&nbsp;答<span><sub>案是</sub>&nbsp;</span>D<span>&nbsp;<audio controls=\"\" playsinline=\"\" webkit-playsinline=\"\"><source src=\"http://qdzyxm.hulalaedu.com/uploads/questions/qd001019050109011907zUy6.mp3\" type=\"audio/mp3\"></audio>&nbsp;</span></span></span></span>', '[{\"id\":0,\"content\":\"A|B\",\"is_checked\":true},{\"id\":1,\"content\":\"C\",\"is_checked\":true},{\"id\":2,\"content\":\"D\",\"is_checked\":true}]', 'qwerqwerqwer', 0, 0, 0, '2019-04-17 16:36:42', '2019-05-09 04:05:30');

SET FOREIGN_KEY_CHECKS = 1;
