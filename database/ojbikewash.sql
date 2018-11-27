-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2005 at 08:17 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ojbikewash`
--
CREATE DATABASE IF NOT EXISTS `ojbikewash` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ojbikewash`;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_cuci`
--

CREATE TABLE IF NOT EXISTS `daftar_cuci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `masuk` datetime NOT NULL,
  `lamaAntri` time DEFAULT NULL,
  `lamaCuci` time DEFAULT NULL,
  `estimasiSelesai` time DEFAULT NULL,
  `selesai` datetime DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `tnkb` varchar(10) NOT NULL,
  `tipe_kendaraan` varchar(20) NOT NULL,
  `hadiah` varchar(20) NOT NULL,
  `jenis_hadiah` varchar(20) NOT NULL,
  `diskon` int(20) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `kasir` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `daftar_cuci`
--

INSERT INTO `daftar_cuci` (`id`, `id_pelanggan`, `masuk`, `lamaAntri`, `lamaCuci`, `estimasiSelesai`, `selesai`, `status`, `tnkb`, `tipe_kendaraan`, `hadiah`, `jenis_hadiah`, `diskon`, `bayar`, `kembalian`, `kasir`) VALUES
(9, 0, '2016-08-13 15:50:16', NULL, NULL, '16:05:16', '2016-08-13 16:50:24', 'OK', 'N 2345 SD', 'Supra', '', '', 4500, 10000, 8500, NULL),
(11, 0, '2005-12-05 06:34:11', NULL, NULL, '06:49:11', NULL, 'Proses', '00000', '0000', '', '', NULL, NULL, NULL, 'mas alfan'),
(12, 0, '2005-12-05 06:35:16', NULL, NULL, '06:50:16', NULL, 'Proses', '00000', '0000', '', '', NULL, NULL, NULL, 'mas adhi'),
(13, 0, '2005-12-05 06:35:23', '00:13:48', '00:28:48', '06:50:23', NULL, 'Proses', '00000', '0000', '', '', NULL, NULL, NULL, 'mas adhi'),
(14, 0, '2005-12-05 06:37:43', '00:12:33', '00:27:33', '06:52:43', NULL, 'Proses', '00000', '0000', '', '', NULL, NULL, NULL, 'mas adhi');

-- --------------------------------------------------------

--
-- Table structure for table `datakasir`
--

CREATE TABLE IF NOT EXISTS `datakasir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastlogout` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `datakasir`
--

INSERT INTO `datakasir` (`id`, `nama`, `password`, `lastlogin`, `lastlogout`) VALUES
(11, 'Mas Adhi', '123456', '2005-12-05 06:35:11', '2005-12-05 06:52:30'),
(13, 'Mas Alfan', '123456', '2005-12-05 06:34:02', '2005-12-05 06:35:03'),
(14, 'Mas Yoshua', '123456', NULL, NULL),
(15, 'Mas Bedjo', '123456', NULL, NULL),
(16, 'Mas Pijhie', '123456', NULL, NULL),
(17, 'Mas Wildan', '123456', NULL, NULL),
(18, 'Mas Yudha', '123456', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(11) NOT NULL,
  `alamat` varchar(11) NOT NULL,
  `no_telp` bigint(12) NOT NULL,
  `jumlah_kunjungan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_telp`, `jumlah_kunjungan`) VALUES
(0, 'Tanpa Nama', '-', 0, 0),
(2, 'Alfan', 'Malang', 8233221233, 15),
(3, 'Adhi', 'Malang', 8123456, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
