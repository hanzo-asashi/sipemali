/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MariaDB
 Source Server Version : 100603
 Source Host           : localhost:3306
 Source Schema         : pajak_online

 Target Server Type    : MariaDB
 Target Server Version : 100603
 File Encoding         : 65001

 Date: 19/10/2021 19:01:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis_bahanbaku_mineral
-- ----------------------------
DROP TABLE IF EXISTS `jenis_bahanbaku_mineral`;
CREATE TABLE `jenis_bahanbaku_mineral`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` decimal(11, 2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_bahanbaku_mineral
-- ----------------------------
INSERT INTO `jenis_bahanbaku_mineral` VALUES (1, 'Perlit', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (2, 'Phospat', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (3, 'Talk', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (4, 'Tanah Serap (Filler Earth)', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (5, 'Tanah Diatome', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (6, 'Tawas (Alum)', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (7, 'Tras', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (8, 'Yarosit', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (9, 'Zeolit', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (10, 'Basal', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (11, 'Trakkit', 'm3', 0.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (12, 'Tanah Urug', 'm3', 20000.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (13, 'Tanah Urug Pilihan', 'm3', 20000.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (14, 'Tanah Liat / Batu Bata', 'm3', 700.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (15, 'Pasir Pasang', 'm3', 43333.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (16, 'Tasirtu', 'm3', 43333.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (17, 'Sirtu', 'm3', 20000.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (18, 'Batu Kerikil / Agregat Kasar', 'm3', 43333.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (19, 'Batu Kali', 'm3', 83333.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (20, 'Batu Gunung', 'm3', 116667.00);
INSERT INTO `jenis_bahanbaku_mineral` VALUES (21, 'Suplit / Batu Pecah', 'm3', 266667.00);

SET FOREIGN_KEY_CHECKS = 1;
