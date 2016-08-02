/*
Navicat MySQL Data Transfer

Source Server         : 192.168.33.11
Source Server Version : 50547
Source Host           : 192.168.33.11:3306
Source Database       : db_mp

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-07-29 19:08:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for client
-- ----------------------------
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `status_client` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `client_to_user` (`user_id`),
  CONSTRAINT `client_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of client
-- ----------------------------
INSERT INTO `client` VALUES ('1', 'PT. Metrodata Indonesia', '', 'Jalan Sudirman kav 43, Jakarta', '08534234566', '6', '', '2016-05-05 09:22:14', '2016-05-05 20:22:15');
INSERT INTO `client` VALUES ('2', 'PT Electronic Arts', '', 'Jalan Kemanggisan Utara 15, Jakarta Barat', '021995213214', '7', '', '2016-05-16 09:13:09', '2016-05-16 20:13:10');

-- ----------------------------
-- Table structure for master_job
-- ----------------------------
DROP TABLE IF EXISTS `master_job`;
CREATE TABLE `master_job` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mp_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_job
-- ----------------------------
INSERT INTO `master_job` VALUES ('1', 'Pekerjaan Persiapan', '-', '2016-05-12 13:43:43', '2016-05-13 00:42:49');
INSERT INTO `master_job` VALUES ('2', 'Pekerjaan Tanah dan Pondasi', '-', '2016-05-13 00:32:28', '2016-05-13 00:32:28');
INSERT INTO `master_job` VALUES ('3', 'Pekerjaan Dinding', '-', '2016-05-13 00:32:46', '2016-05-13 00:32:46');
INSERT INTO `master_job` VALUES ('4', 'Pekerjaan Plafon', '-', '2016-05-13 00:33:03', '2016-05-13 00:33:03');
INSERT INTO `master_job` VALUES ('5', 'Pekerjaan Cat', '-', '2016-05-13 00:33:19', '2016-05-13 00:33:19');
INSERT INTO `master_job` VALUES ('6', 'Pekerjaan Lantai', '-', '2016-05-13 00:33:37', '2016-05-13 00:33:37');
INSERT INTO `master_job` VALUES ('7', 'Pekerjaan Atap', '-', '2016-05-13 00:39:03', '2016-05-13 00:39:03');
INSERT INTO `master_job` VALUES ('8', 'Instalasi Pumbing dan Sanitary', '-', '2016-05-13 00:39:33', '2016-05-13 00:39:33');
INSERT INTO `master_job` VALUES ('9', 'Instalasi Listrik', '-', '2016-05-13 00:39:48', '2016-05-13 00:39:48');
INSERT INTO `master_job` VALUES ('10', 'Pekerjaan Pintu dan Jendela', '-', '2016-05-13 00:40:01', '2016-05-13 00:40:01');
INSERT INTO `master_job` VALUES ('11', 'Pekerjaan Carport', '-', '2016-05-13 00:40:15', '2016-05-13 00:40:15');
INSERT INTO `master_job` VALUES ('12', 'Lain-lain', '-', '2016-05-13 00:40:25', '2016-05-13 00:40:25');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_project` varchar(25) NOT NULL,
  `p_name` varchar(150) NOT NULL,
  `p_address` varchar(150) NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `estimate_end_date` date NOT NULL,
  `end_date` date NOT NULL,
  `pm_id` int(11) unsigned NOT NULL,
  `status_project` varchar(1) NOT NULL,
  `last_update_by` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pm_to_user` (`pm_id`),
  KEY `lastupdateby_to_user` (`last_update_by`),
  KEY `client_to_client` (`client_id`),
  CONSTRAINT `client_to_client` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lastupdateby_to_user` FOREIGN KEY (`last_update_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pm_to_user` FOREIGN KEY (`pm_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('2', 'AKU-PRJ/2016/05-00001', 'Pembuatan Hotel Cempaka 33', 'Jalan bambu kuning raya no 15. Jakarta Selatan', '6', '2016-05-30', '2016-12-30', '0000-11-30', '4', '0', '4', '2016-07-29 05:48:20', '2016-05-12 23:17:50');
INSERT INTO `project` VALUES ('3', 'AKU-PRJ/2016/05-00002', 'Pembangunan Hotel 5 Lantai', 'Jalan Meruya Selatan 15. Jakarta Barat', '7', '2016-05-09', '2016-09-03', '0000-00-00', '4', '0', '3', '2016-05-16 20:17:57', '2016-05-16 20:17:57');
INSERT INTO `project` VALUES ('4', 'AKU-PRJ/2016/07-00001', 'Pembangunan kos-kosan', 'jalan mataram 13, jakarta barat', '7', '0000-00-00', '0000-00-00', '0000-00-00', '8', '0', '3', '2016-07-29 05:43:40', '2016-07-29 16:27:33');

-- ----------------------------
-- Table structure for rab
-- ----------------------------
DROP TABLE IF EXISTS `rab`;
CREATE TABLE `rab` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_rab` varchar(25) DEFAULT NULL,
  `project_id` int(11) unsigned NOT NULL,
  `estimate_total_budget` double NOT NULL,
  `total_budget` double NOT NULL,
  `file_attach` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `rab_to_project` (`project_id`),
  CONSTRAINT `rab_to_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rab
-- ----------------------------
INSERT INTO `rab` VALUES ('13', 'AKU-RAB/2016/07-00001', '2', '3406000', '0', '1babbc90cb7e36ccbedc55765b98d7b9.xlsx', '2016-07-26 22:46:19', '2016-07-26 22:46:19');

-- ----------------------------
-- Table structure for rab_detail
-- ----------------------------
DROP TABLE IF EXISTS `rab_detail`;
CREATE TABLE `rab_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rab_id` int(11) unsigned NOT NULL,
  `master_job` varchar(100) NOT NULL,
  `sub_job_name` varchar(150) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `volume` double NOT NULL,
  `unit_price` double NOT NULL,
  `bobot` double NOT NULL,
  `start_date` date NOT NULL,
  `estimate_end_date` date NOT NULL,
  `end_date` date NOT NULL,
  `late_reason` text NOT NULL,
  `status_sub` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_progress` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rabd_to_mj` (`master_job`),
  KEY `detail_to_rab` (`rab_id`),
  CONSTRAINT `detail_to_rab` FOREIGN KEY (`rab_id`) REFERENCES `rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rab_detail
-- ----------------------------
INSERT INTO `rab_detail` VALUES ('9', '13', 'persiapan', 'item 1', 'm3', '50', '120', '0.18', '0000-00-00', '0000-00-00', '0000-00-00', '', '1', '2016-07-29 07:52:11', '2016-07-29 18:52:11', '100');
INSERT INTO `rab_detail` VALUES ('10', '13', 'persiapan', 'item 2', 'm3', '120', '15000', '52.85', '0000-00-00', '0000-00-00', '0000-00-00', '', '1', '2016-07-29 07:52:11', '2016-07-29 18:52:11', '100');
INSERT INTO `rab_detail` VALUES ('11', '13', 'Tanah dan Bangunan', 'item 1', 'pcs', '1200', '500', '17.62', '0000-00-00', '0000-00-00', '0000-00-00', '', '0', '2016-07-29 07:52:11', '2016-07-29 18:52:11', '100');
INSERT INTO `rab_detail` VALUES ('12', '13', 'Tanah dan Bangunan', 'item 2', 'pacs', '500', '2000', '29.36', '0000-00-00', '0000-00-00', '0000-00-00', '', '0', '2016-07-29 07:52:11', '2016-07-29 18:52:11', '90');

-- ----------------------------
-- Table structure for rab_progress
-- ----------------------------
DROP TABLE IF EXISTS `rab_progress`;
CREATE TABLE `rab_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `week_of` varchar(4) NOT NULL,
  `progress` double NOT NULL,
  `rab_detail_id` int(11) unsigned NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rab_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `progress_to_rabd` (`rab_detail_id`),
  KEY `progress_to_rab` (`rab_id`) USING BTREE,
  CONSTRAINT `progress_to_rab` FOREIGN KEY (`rab_id`) REFERENCES `rab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `progress_to_rabd` FOREIGN KEY (`rab_detail_id`) REFERENCES `rab_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rab_progress
-- ----------------------------
INSERT INTO `rab_progress` VALUES ('1', '1', '10', '9', '2016-07-04 00:00:00', '2016-07-11 00:00:00', '2016-07-26 22:47:09', '2016-07-26 22:47:09', '13');
INSERT INTO `rab_progress` VALUES ('2', '1', '50', '10', '2016-07-04 00:00:00', '2016-07-11 00:00:00', '2016-07-26 22:47:09', '2016-07-26 22:47:09', '13');
INSERT INTO `rab_progress` VALUES ('3', '1', '30', '11', '2016-07-04 00:00:00', '2016-07-11 00:00:00', '2016-07-26 22:47:09', '2016-07-26 22:47:09', '13');
INSERT INTO `rab_progress` VALUES ('4', '1', '60', '12', '2016-07-04 00:00:00', '2016-07-11 00:00:00', '2016-07-26 22:47:09', '2016-07-26 22:47:09', '13');
INSERT INTO `rab_progress` VALUES ('9', '2', '30', '9', '2016-07-18 00:00:00', '2016-07-25 00:00:00', '2016-07-26 22:58:20', '2016-07-26 22:58:20', '13');
INSERT INTO `rab_progress` VALUES ('10', '2', '20', '10', '2016-07-18 00:00:00', '2016-07-25 00:00:00', '2016-07-26 22:58:20', '2016-07-26 22:58:20', '13');
INSERT INTO `rab_progress` VALUES ('11', '2', '10', '11', '2016-07-18 00:00:00', '2016-07-25 00:00:00', '2016-07-26 22:58:20', '2016-07-26 22:58:20', '13');
INSERT INTO `rab_progress` VALUES ('12', '2', '5', '12', '2016-07-18 00:00:00', '2016-07-25 00:00:00', '2016-07-26 12:17:30', '2016-07-26 23:17:30', '13');
INSERT INTO `rab_progress` VALUES ('13', '3', '60', '9', '2016-07-25 00:00:00', '2016-08-01 00:00:00', '2016-07-26 23:30:11', '2016-07-26 23:30:11', '13');
INSERT INTO `rab_progress` VALUES ('14', '3', '30', '10', '2016-07-25 00:00:00', '2016-08-01 00:00:00', '2016-07-26 23:30:11', '2016-07-26 23:30:11', '13');
INSERT INTO `rab_progress` VALUES ('15', '3', '20', '11', '2016-07-25 00:00:00', '2016-08-01 00:00:00', '2016-07-26 23:30:11', '2016-07-26 23:30:11', '13');
INSERT INTO `rab_progress` VALUES ('16', '3', '15', '12', '2016-07-25 00:00:00', '2016-08-01 00:00:00', '2016-07-26 23:30:11', '2016-07-26 23:30:11', '13');
INSERT INTO `rab_progress` VALUES ('17', '4', '0', '9', '2016-08-01 00:00:00', '2016-08-08 00:00:00', '2016-07-26 23:37:31', '2016-07-26 23:37:31', '13');
INSERT INTO `rab_progress` VALUES ('18', '4', '0', '10', '2016-08-01 00:00:00', '2016-08-08 00:00:00', '2016-07-26 23:37:31', '2016-07-26 23:37:31', '13');
INSERT INTO `rab_progress` VALUES ('19', '4', '40', '11', '2016-08-01 00:00:00', '2016-08-08 00:00:00', '2016-07-26 23:37:31', '2016-07-26 23:37:31', '13');
INSERT INTO `rab_progress` VALUES ('20', '4', '10', '12', '2016-08-01 00:00:00', '2016-08-08 00:00:00', '2016-07-26 23:37:31', '2016-07-26 23:37:31', '13');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','pm','admin','client') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status_user` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Hasan Basri', 'hasanbasri2307@gmail.com', '$2y$10$KuGdag6aglc8JEzM6/m4ne0/J63t9ScKR.hOM9yzg2f638mznrLLq', 'administrator', 'e44oraHSncMrcYhKMAYRZcMVCrgEIRE9ueJRi43V8I7e1R00S1NkE1s2A2u1', null, '2016-04-03 13:15:02', '2016-07-29 16:44:47');
INSERT INTO `users` VALUES ('3', 'Riky', 'riky@gmail.com', '$2y$10$0Fb7cKqSJlgo/IFv8VgHbOHWFi3bGb8AG/MBsRsG.mWTCA48AGbpS', 'admin', 'DeN2Y02JnaVttaBYeVeZrzXzcB4ArKE6sAgI42TKH1UXlO36yP8BW06gm3qT', '1', '2016-05-05 20:03:34', '2016-07-29 19:07:55');
INSERT INTO `users` VALUES ('4', 'Rahmat', 'rahmat@gmail.com', '$2y$10$tD2NqEHGQ4qZLvLGp6uGguI6hKx2/JQh4CDYhVvbVs97Rv99EwDye', 'pm', 'rPk3r9KjRMzxvCYpO1cnWJeTtZ0gDsepAJtQ8iqU9XX4Na4RxEA3EVQ3XBti', '1', '2016-05-05 20:04:24', '2016-07-29 18:58:09');
INSERT INTO `users` VALUES ('6', 'Roki', 'roki@gmail.com', '$2y$10$2g61lxMNQ1zC3Pj.DUR7jOlWOAUxBnkta1eRbzOtUHfQ.GBugmV4G', 'client', 'jqIlUMerVeX8owK9agadMJVFLX6iYsAYlezlUPsMmDTrGYfRmV6wIxR3Iz65', '1', '2016-05-05 20:21:45', '2016-07-29 18:47:44');
INSERT INTO `users` VALUES ('7', 'Desy', 'desy@gmail.com', '$2y$10$/OKk8XkZx2nyL6DQ449ReeNY4V8IcLvZJ9zdHuxSTAHgTtk2vkwvq', 'client', null, '1', '2016-05-16 20:11:10', '2016-05-16 20:11:10');
INSERT INTO `users` VALUES ('8', 'coker', 'coker@gmail.com', '$2y$10$K2skrRNCAkTzmVY.autugeecwWyz5k4idLaTE6u3T3v6TLJBF9sUK', 'pm', 'WhWVrXlzthcSIs5dsn5V1lasoQfGr3slXzqmru40W0EmH5Zt8VCHx8uJSkkU', '1', '2016-07-29 16:42:55', '2016-07-29 16:46:56');
