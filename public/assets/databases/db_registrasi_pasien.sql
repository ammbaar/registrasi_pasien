-- Adminer 4.8.1 MySQL 10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `db_registrasi_pasien` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `db_registrasi_pasien`;

CREATE TABLE `data_kelurahan` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nama_kelurahan` varchar(100) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `data_kelurahan` (`id`, `nama_kelurahan`, `nama_kecamatan`, `nama_kota`) VALUES
(1,	'Cibeber',	'Cimahi Selatan',	'Cimahi'),
(2,	'Cihapit',	'Bandung Wetan',	'Bandung');

CREATE TABLE `data_pasien` (
  `id` bigint(20) NOT NULL,
  `nama_pasien` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `rt_rw` varchar(7) NOT NULL,
  `id_kelurahan` int(8) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `data_pasien` (`id`, `nama_pasien`, `alamat`, `no_telp`, `rt_rw`, `id_kelurahan`, `tgl_lahir`, `jenis_kelamin`) VALUES
(2307000001,	'Ayu',	'Jl. Bebas',	'081234567890',	'7/8',	1,	'2000-07-06',	'Perempuan'),
(2307000002,	'Asep',	'Jl. Raya',	'089239187312',	'6/7',	2,	'2003-07-17',	'Laki-Laki');

CREATE TABLE `user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1,	'admin',	'8cb2237d0679ca88db6464eac60da96345513964',	'Admin'),
(2,	'operator',	'348162101fc6f7e624681b7400b085eeac6df7bd',	'Operator');

-- 2023-07-19 13:05:56
