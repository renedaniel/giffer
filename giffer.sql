/*
SQL para la generación de la base de datos de giffer
René Daniel Galicia Vázquez

Source Database       : giffer

Target Server Type    : MYSQL
File Encoding         : 65001
*/
CREATE DATABASE IF NOT EXISTS giffer;
USE giffer;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for imagen
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of imagen
-- ----------------------------
INSERT INTO `imagen` VALUES ('1', '1', 'img/gifs/1/10.gif', '2016-10-27 20:42:03', 'A', 'Super Gif 1');
INSERT INTO `imagen` VALUES ('2', '1', 'img/gifs/1/108.gif', '2016-10-27 20:42:03', 'A', 'Super Gif 2');
INSERT INTO `imagen` VALUES ('3', '1', 'img/gifs/1/11.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 3');
INSERT INTO `imagen` VALUES ('4', '1', 'img/gifs/1/114.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 4');
INSERT INTO `imagen` VALUES ('5', '1', 'img/gifs/1/116.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 5');
INSERT INTO `imagen` VALUES ('6', '1', 'img/gifs/1/117.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 6');
INSERT INTO `imagen` VALUES ('7', '1', 'img/gifs/1/120.gif', '2016-10-27 20:42:04', 'A', 'Super Gif 7');
INSERT INTO `imagen` VALUES ('8', '1', 'img/gifs/1/125.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 8');
INSERT INTO `imagen` VALUES ('9', '1', 'img/gifs/1/126.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 9');
INSERT INTO `imagen` VALUES ('10', '1', 'img/gifs/1/128.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 10');
INSERT INTO `imagen` VALUES ('11', '1', 'img/gifs/1/131.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 11');
INSERT INTO `imagen` VALUES ('12', '1', 'img/gifs/1/133.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 12');
INSERT INTO `imagen` VALUES ('13', '1', 'img/gifs/1/134.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 13');
INSERT INTO `imagen` VALUES ('14', '1', 'img/gifs/1/135.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 14');
INSERT INTO `imagen` VALUES ('15', '1', 'img/gifs/1/150.gif', '2016-10-27 20:42:05', 'A', 'Super Gif 15');
INSERT INTO `imagen` VALUES ('16', '1', 'img/gifs/1/154.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 16');
INSERT INTO `imagen` VALUES ('17', '1', 'img/gifs/1/155.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 17');
INSERT INTO `imagen` VALUES ('18', '1', 'img/gifs/1/157.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 18');
INSERT INTO `imagen` VALUES ('19', '1', 'img/gifs/1/160.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 19');
INSERT INTO `imagen` VALUES ('20', '1', 'img/gifs/1/164.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 20');
INSERT INTO `imagen` VALUES ('21', '1', 'img/gifs/1/165.gif', '2016-10-27 20:42:06', 'A', 'Super Gif 21');
INSERT INTO `imagen` VALUES ('22', '1', 'img/gifs/1/168.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 22');
INSERT INTO `imagen` VALUES ('23', '1', 'img/gifs/1/171.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 23');
INSERT INTO `imagen` VALUES ('24', '1', 'img/gifs/1/172.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 24');
INSERT INTO `imagen` VALUES ('25', '1', 'img/gifs/1/175.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 25');
INSERT INTO `imagen` VALUES ('26', '1', 'img/gifs/1/2.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 26');
INSERT INTO `imagen` VALUES ('27', '1', 'img/gifs/1/22.gif', '2016-10-27 20:42:07', 'A', 'Super Gif 27');
INSERT INTO `imagen` VALUES ('28', '1', 'img/gifs/1/23.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 28');
INSERT INTO `imagen` VALUES ('29', '1', 'img/gifs/1/3.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 29');
INSERT INTO `imagen` VALUES ('30', '1', 'img/gifs/1/32.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 30');
INSERT INTO `imagen` VALUES ('31', '1', 'img/gifs/1/33.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 31');
INSERT INTO `imagen` VALUES ('32', '1', 'img/gifs/1/35.gif', '2016-10-27 20:42:08', 'A', 'Super Gif 32');
INSERT INTO `imagen` VALUES ('33', '1', 'img/gifs/1/37.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 33');
INSERT INTO `imagen` VALUES ('34', '1', 'img/gifs/1/4.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 34');
INSERT INTO `imagen` VALUES ('35', '1', 'img/gifs/1/46.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 35');
INSERT INTO `imagen` VALUES ('36', '1', 'img/gifs/1/49.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 36');
INSERT INTO `imagen` VALUES ('37', '1', 'img/gifs/1/5.gif', '2016-10-27 20:42:09', 'A', 'Super Gif 37');
INSERT INTO `imagen` VALUES ('38', '1', 'img/gifs/1/54.gif', '2016-10-27 20:42:09', 'R', 'Super Gif 38');
INSERT INTO `imagen` VALUES ('39', '1', 'img/gifs/1/6.gif', '2016-10-27 20:42:09', 'P', 'Super Gif 39');
INSERT INTO `imagen` VALUES ('40', '1', 'img/gifs/1/60.gif', '2016-10-27 20:42:09', 'P', 'Super Gif 40');
INSERT INTO `imagen` VALUES ('41', '1', 'img/gifs/1/7.gif', '2016-10-27 20:42:09', 'P', 'Super Gif 41');
INSERT INTO `imagen` VALUES ('42', '1', 'img/gifs/1/79.gif', '2016-10-27 20:42:10', 'R', 'Super Gif 42');
INSERT INTO `imagen` VALUES ('43', '1', 'img/gifs/1/84.gif', '2016-10-27 20:42:10', 'P', 'Super Gif 43');
INSERT INTO `imagen` VALUES ('44', '1', 'img/gifs/1/85.gif', '2016-10-27 20:42:10', 'A', 'Super Gif 44');
INSERT INTO `imagen` VALUES ('45', '1', 'img/gifs/1/87.gif', '2016-10-27 20:42:10', 'A', 'Super Gif 45');
INSERT INTO `imagen` VALUES ('46', '1', 'img/gifs/1/9.gif', '2016-10-27 20:42:10', 'P', 'Super Gif 46');
INSERT INTO `imagen` VALUES ('47', '1', 'img/gifs/1/90.gif', '2016-10-27 20:42:11', 'A', 'Super Gif 47');
INSERT INTO `imagen` VALUES ('48', '1', 'img/gifs/1/91.gif', '2016-10-27 20:42:11', 'A', 'Super Gif 48');

-- ----------------------------
-- Table structure for usuario
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'Admin', 'Admin', 'Admin', 'admin@gmail.com', 'affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686', 'A', '2016-10-26');