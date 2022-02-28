CREATE DATABASE IF NOT EXISTS `skripsi`;
USE `skripsi`;

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `tb_log_perekaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_fileupload` mediumtext NOT NULL,
  `ocr_image` mediumtext NOT NULL,
  `ocr_text` mediumtext NOT NULL,
  `waktu_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
);
