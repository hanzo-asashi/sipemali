/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MariaDB
 Source Server Version : 100511
 Source Host           : localhost:3306
 Source Schema         : pajak_online

 Target Server Type    : MariaDB
 Target Server Version : 100511
 File Encoding         : 65001

 Date: 19/10/2021 14:41:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis_reklame
-- ----------------------------
DROP TABLE IF EXISTS `jenis_reklame`;
CREATE TABLE `jenis_reklame`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_jenis_op` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_pembayaran` int(11) NOT NULL,
  `nilai_strategis` decimal(15, 2) NOT NULL,
  `nilai_jual_objek_pajak` decimal(15, 2) NOT NULL,
  `tipe_satuan` int(11) NOT NULL,
  `jenis_tarif` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_reklame
-- ----------------------------
INSERT INTO `jenis_reklame` VALUES (1, 'Reklame Billboard Rokok', 3, 200000.00, 500000.00, 1, 1);
INSERT INTO `jenis_reklame` VALUES (2, 'Reklame Billboard', 3, 200000.00, 500000.00, 1, 2);
INSERT INTO `jenis_reklame` VALUES (3, 'Reklame Spanduk / Umbul2 / Baliho Non Rokok', 2, 20000.00, 100000.00, 3, 2);
INSERT INTO `jenis_reklame` VALUES (4, 'Reklame Spanduk / Umbul2 / Baliho Rokok', 2, 20000.00, 100000.00, 3, 1);
INSERT INTO `jenis_reklame` VALUES (5, 'Reklame Tempel (Rokok)', 2, 1500.00, 5500.00, 4, 1);
INSERT INTO `jenis_reklame` VALUES (6, 'Reklame Tempel (Non Rokok)', 2, 1500.00, 5500.00, 4, 2);
INSERT INTO `jenis_reklame` VALUES (7, 'Reklame Selebaran (Rokok)', 2, 500.00, 1000.00, 4, 1);
INSERT INTO `jenis_reklame` VALUES (8, 'Reklame Selebaran (Non Rokok)', 2, 500.00, 1000.00, 4, 2);
INSERT INTO `jenis_reklame` VALUES (9, 'Reklame Berjalan (Rokok)', 1, 150000.00, 200000.00, 2, 1);
INSERT INTO `jenis_reklame` VALUES (10, 'Reklame Berjalan (Non Rokok)', 1, 150000.00, 200000.00, 2, 2);
INSERT INTO `jenis_reklame` VALUES (11, 'Reklame Udara (Rokok)', 1, 15000.00, 200000.00, 5, 1);
INSERT INTO `jenis_reklame` VALUES (12, 'Reklame Udara (Non Rokok)', 1, 15000.00, 200000.00, 5, 2);
INSERT INTO `jenis_reklame` VALUES (13, 'Reklame Dengan Kendaraan (Rokok)', 1, 20000.00, 200000.00, 5, 1);
INSERT INTO `jenis_reklame` VALUES (14, 'Reklame dengan kendaraan (Non Rokok)', 1, 20000.00, 200000.00, 5, 2);
INSERT INTO `jenis_reklame` VALUES (15, 'Reklame Peragaan (Rokok)', 1, 75000.00, 1500000.00, 2, 1);
INSERT INTO `jenis_reklame` VALUES (16, 'Reklame Peragaan (Non Rokok)', 1, 75000.00, 150000.00, 2, 2);
INSERT INTO `jenis_reklame` VALUES (17, 'Reklame Papan dan lainnya (Rokok)', 3, 150000.00, 450000.00, 1, 1);
INSERT INTO `jenis_reklame` VALUES (18, 'Reklame Papan dan lainnya (Non Rokok)', 3, 150000.00, 450000.00, 1, 2);
INSERT INTO `jenis_reklame` VALUES (19, 'Reklame Bersinar (Rokok)', 1, 200000.00, 500000.00, 2, 1);
INSERT INTO `jenis_reklame` VALUES (20, 'Reklame Bersinar (Non Rokok)', 1, 200000.00, 500000.00, 2, 2);
INSERT INTO `jenis_reklame` VALUES (21, 'Reklame Film / Slide dengan suara (Rokok)', 1, 5000.00, 150000.00, 2, 1);
INSERT INTO `jenis_reklame` VALUES (22, 'Reklame Film / Slide dengan suara (Non Rokok)', 1, 5000.00, 150000.00, 2, 2);

SET FOREIGN_KEY_CHECKS = 1;
