/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100432
 Source Host           : localhost:3306
 Source Schema         : kp

 Target Server Type    : MySQL
 Target Server Version : 100432
 File Encoding         : 65001

 Date: 22/04/2024 06:26:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `divisi` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE,
  INDEX `divisi`(`divisi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0);
INSERT INTO `admin` VALUES (1, 'admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 1);
INSERT INTO `admin` VALUES (2, 'admin2', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8', 2);
INSERT INTO `admin` VALUES (3, 'admin3', '4fc2b5673a201ad9b1fc03dcb346e1baad44351daa0503d5534b4dfdcc4332e0', 3);
INSERT INTO `admin` VALUES (4, 'admin4', '110198831a426807bccd9dbdf54b6dcb5298bc5d31ac49069e0ba3d210d970ae', 4);

-- ----------------------------
-- Table structure for divisi
-- ----------------------------
DROP TABLE IF EXISTS `divisi`;
CREATE TABLE `divisi`  (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_divisi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divisi
-- ----------------------------
INSERT INTO `divisi` VALUES (0, 'Super Admin');
INSERT INTO `divisi` VALUES (1, 'Pelayanan Pendaftaran Penduduk');
INSERT INTO `divisi` VALUES (2, 'Pelayanan Pencatatan Sipil');
INSERT INTO `divisi` VALUES (3, 'Pengelolaan Informasi Administrasi Kependudukan');
INSERT INTO `divisi` VALUES (4, 'Pemanfaatan Data Dan Inovasi Pelayanan');

-- ----------------------------
-- Table structure for laporan
-- ----------------------------
DROP TABLE IF EXISTS `laporan`;
CREATE TABLE `laporan`  (
  `id` int(11) NOT NULL,
  `nama` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telpon` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `alamat` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tujuan` int(11) NOT NULL,
  `isi` varchar(2048) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gambar_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `tanggal` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tujuan`(`tujuan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan
-- ----------------------------
INSERT INTO `laporan` VALUES (100, 'Wahid Ari', 'wahiid.ari@gmail.com', '087850866665', 'Mlajah', 1, 'Apakah Aplikasi Pengaduan Masyarakat Dispendukcapil Bangkalan ini?', '', '2018-03-25 21:45:42', 'Ditanggapi');
INSERT INTO `laporan` VALUES (101, 'Surya Ray', 'ray@gmail.com', '087123123444', 'Bangkalan', 2, 'Apakah nomor pengaduan itu dan apa yang harus saya lakukan terhadap nomor pengaduan ini? ', '', '2018-03-25 22:50:12', 'Menunggu');
INSERT INTO `laporan` VALUES (102, 'Sahrul qomar', 'galihya95@gmail.com', '123456789012', 'asdasd', 3, 'dasdas', 'image_laporan/Screenshot 2024-01-25 203712.png', '2024-04-21 15:00:34', 'Menunggu');

-- ----------------------------
-- Table structure for tanggapan
-- ----------------------------
DROP TABLE IF EXISTS `tanggapan`;
CREATE TABLE `tanggapan`  (
  `id_tanggapan` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `admin` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `isi_tanggapan` varchar(2048) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tanggal_tanggapan` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0)
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tanggapan
-- ----------------------------
INSERT INTO `tanggapan` VALUES (1, 100, 'admin', 'Aplikasi Pengaduan Masyarakat Dispendukcapil Bangkalan adalah aplikasi pengelolaan dan tindak lanjut pengaduan serta pelaporan hasil pengelolaan pengaduan yang disediakan oleh Dispendukcapil Bangkalan sebagai salah satu sarana bagi setiap pejabat/pegawai Dispendukcapil Bangkalan sebagai pihak internal maupun masyarakat luas pengguna layanan Dispendukcapil Bangkalan sebagai pihak eksternal untuk melaporkan dugaan adanya pelanggaran dan/atau ketidakpuasan terhadap pelayanan yang dilakukan/diberikan oleh pejabat/pegawai Dispendukcapil Bangkalan.', '2018-03-25 21:44:57');

SET FOREIGN_KEY_CHECKS = 1;
