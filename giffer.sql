/*
SQL para la generación de la base de datos de giffer
René Daniel Galicia Vázquez

Source Database       : giffer

Target Server Type    : MYSQL
File Encoding         : 65001
*/
CREATE DATABASE IF NOT EXISTS giffer;
USE giffer;

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `imagen`
-- ----------------------------
DROP TABLE IF EXISTS `imagen`;
CREATE TABLE `imagen` (
  `imagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `img_ruta` varchar(255) NOT NULL,
  `img_creado` datetime NOT NULL,
  `img_estatus` char(1) NOT NULL,
  `img_nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`imagen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `imagen`
-- ----------------------------
BEGIN;
INSERT INTO `imagen` VALUES ('1', '1', 'img/gifs/1/10.gif', '2016-10-27 20:42:03', 'A', 'Super Gif 1'), ('2', '1', 'img/gifs/1/108.gif', '2016-10-27 20:42:03', 'A', 'Super Gif 2'), ('3', '1', 'img/gifs/1/11.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 3'), ('4', '1', 'img/gifs/1/114.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 4'), ('5', '1', 'img/gifs/1/116.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 5'), ('6', '1', 'img/gifs/1/117.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 6'), ('7', '1', 'img/gifs/1/120.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 7'), ('8', '1', 'img/gifs/1/125.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 8'), ('9', '1', 'img/gifs/1/126.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 9'), ('10', '1', 'img/gifs/1/128.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 10'), ('11', '1', 'img/gifs/1/131.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 11'), ('12', '1', 'img/gifs/1/133.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 12'), ('13', '1', 'img/gifs/1/134.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 13'), ('14', '1', 'img/gifs/1/135.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 14'), ('15', '1', 'img/gifs/1/150.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 15'), ('16', '1', 'img/gifs/1/154.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 16'), ('17', '1', 'img/gifs/1/155.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 17'), ('18', '1', 'img/gifs/1/157.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 18'), ('19', '1', 'img/gifs/1/160.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 19'), ('20', '1', 'img/gifs/1/164.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 20'), ('21', '1', 'img/gifs/1/165.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 21'), ('22', '1', 'img/gifs/1/168.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 22'), ('23', '1', 'img/gifs/1/171.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 23'), ('24', '1', 'img/gifs/1/172.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 24'), ('25', '1', 'img/gifs/1/175.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 25'), ('26', '1', 'img/gifs/1/2.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 26'), ('27', '1', 'img/gifs/1/22.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 27'), ('28', '1', 'img/gifs/1/23.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 28'), ('29', '1', 'img/gifs/1/3.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 29'), ('30', '1', 'img/gifs/1/32.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 30'), ('31', '1', 'img/gifs/1/33.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 31'), ('32', '1', 'img/gifs/1/35.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 32'), ('33', '1', 'img/gifs/1/37.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 33'), ('34', '1', 'img/gifs/1/4.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 34'), ('35', '1', 'img/gifs/1/46.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 35'), ('36', '1', 'img/gifs/1/49.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 36'), ('37', '1', 'img/gifs/1/5.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 37'), ('38', '1', 'img/gifs/1/54.gif', '2016-10-27 20:42:09', 'R', 'Super Gif 38'), ('39', '1', 'img/gifs/1/6.gif', '2016-10-27 20:42:09', 'P', 'Super Gif 39'), ('40', '1', 'img/gifs/1/60.gif', '2016-10-27 20:42:09', 'P', 'Super Gif 40'), ('41', '1', 'img/gifs/1/7.gif', '2016-10-27 20:42:09', 'P', 'Super Gif 41'), ('42', '1', 'img/gifs/1/79.gif', '2016-10-27 20:42:10', 'A', 'Super Gif 42'), ('43', '1', 'img/gifs/1/84.gif', '2016-10-27 20:42:10', 'P', 'Super Gif 43'), ('44', '1', 'img/gifs/1/85.gif', '2016-10-27 20:42:10', 'A', 'Super Gif 44'), ('45', '1', 'img/gifs/1/87.gif', '2016-10-27 20:42:10', 'A', 'Super Gif 45'), ('46', '1', 'img/gifs/1/9.gif', '2016-10-27 20:42:10', 'P', 'Super Gif 46'), ('47', '1', 'img/gifs/1/90.gif', '2016-10-27 20:42:11', 'A', 'Super Gif 47'), ('48', '1', 'img/gifs/1/91.gif', '2016-10-27 20:42:11', 'A', 'Super Gif 48'), ('50', '1', 'img/gifs/2/giphy(12).gif', '2016-10-30 16:59:25', 'A', 'Mi imagen');
COMMIT;

-- ----------------------------
--  Table structure for `img_usu_like`
-- ----------------------------
DROP TABLE IF EXISTS `img_usu_like`;
CREATE TABLE `img_usu_like` (
  `img_usu_like_id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`img_usu_like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_primer_apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_segundo_apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_cuenta` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_contrasenia` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `usu_tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `usu_creado` date NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `usuario`
-- ----------------------------
BEGIN;
INSERT INTO `usuario` VALUES ('1', 'Admin', 'Admin', 'Admin', 'admin@gmail.com', 'affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686', 'A', '2016-10-26');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
