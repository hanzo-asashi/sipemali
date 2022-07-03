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

 Date: 25/10/2021 20:28:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `settings_key_index`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'nama_aplikasi', 'PAJAK ONLINE');
INSERT INTO `settings` VALUES (2, 'kode_provinsi', '74');
INSERT INTO `settings` VALUES (3, 'kode_kabupaten', '74.08');
INSERT INTO `settings` VALUES (4, 'copyright', '2021');
INSERT INTO `settings` VALUES (5, 'tahun_sppt', '2021');
INSERT INTO `settings` VALUES (6, 'masa_pajak_bulan', '10');
INSERT INTO `settings` VALUES (7, 'periode_penarikan_pajak', 'tahun');
INSERT INTO `settings` VALUES (8, 'tema_sidebar', 'dark');
INSERT INTO `settings` VALUES (9, 'logo_aplikasi', '20211019152110.png');
INSERT INTO `settings` VALUES (10, 'format_no_transaksi', 'PJO');
INSERT INTO `settings` VALUES (11, 'nama_kantor', 'BAPENDA');
INSERT INTO `settings` VALUES (12, 'footer', 'Pemerintah Kabupaten Kolaka Utara');
INSERT INTO `settings` VALUES (13, 'pemisah', '-');

SET FOREIGN_KEY_CHECKS = 1;
