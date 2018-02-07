-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2018 at 06:59 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fuzzy`
--
CREATE DATABASE IF NOT EXISTS `fuzzy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fuzzy`;

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE IF NOT EXISTS `bobot` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `fuzzy` varchar(100) NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `id_kriteria`, `fuzzy`, `nilai`) VALUES
(1, 1, 'Tidak Ada Keahlian', 0.25),
(2, 1, 'Kurang Ahli', 0.5),
(3, 1, 'Ada Keahlian', 0.75),
(4, 1, 'Banyak Keahlian', 1),
(5, 2, 'Tidak Memadai', 0.25),
(6, 2, 'Kurang Memadai', 0.5),
(7, 2, 'Memadai', 0.75),
(8, 2, 'Sangat Memadai', 1),
(9, 3, 'Tidak Disarankan', 0.25),
(10, 3, 'Kurang Disarankan', 0.5),
(11, 3, 'Masih Dapat Disarankan', 0.75),
(12, 3, 'Dapat Disarankan', 1),
(19, 6, 'Tidak Sehat', 0.25),
(20, 6, 'Kurang Sehat', 0.5),
(21, 6, 'Sehat', 0.75),
(22, 6, 'Sangat Sehat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE IF NOT EXISTS `hak_akses` (
  `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hak_akses` varchar(100) NOT NULL,
  PRIMARY KEY (`id_hak_akses`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `nama_hak_akses`) VALUES
(1, 'Admin'),
(2, 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penilaian`
--

CREATE TABLE IF NOT EXISTS `hasil_penilaian` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelamar` int(11) NOT NULL,
  `hasil` float NOT NULL,
  `id_keputusan` int(11) NOT NULL,
  PRIMARY KEY (`id_hasil`),
  KEY `id_pelamar` (`id_pelamar`),
  KEY `id_keputusan` (`id_keputusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `hasil_penilaian`
--

INSERT INTO `hasil_penilaian` (`id_hasil`, `id_pelamar`, `hasil`, `id_keputusan`) VALUES
(4, 5, 0.75, 2),
(5, 6, 0.75, 2),
(6, 7, 0.8125, 3),
(7, 8, 0.9, 3),
(8, 9, 0.6625, 2),
(9, 10, 0.9, 3),
(10, 11, 0.7875, 3),
(11, 12, 0.875, 3),
(12, 13, 0.75, 2),
(13, 14, 0.8375, 3),
(14, 15, 0.6, 1),
(15, 16, 0.7125, 2),
(16, 19, 0.8125, 3),
(17, 20, 0.6, 1),
(18, 21, 0.5625, 1),
(19, 23, 0.75, 2),
(20, 24, 0.8375, 3);

-- --------------------------------------------------------

--
-- Table structure for table `keputusan`
--

CREATE TABLE IF NOT EXISTS `keputusan` (
  `id_keputusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  PRIMARY KEY (`id_keputusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `keputusan`
--

INSERT INTO `keputusan` (`id_keputusan`, `nama`, `min`, `max`) VALUES
(1, 'Tidak Layak', 0, 0.6),
(2, 'Layak', 0.61, 0.75),
(3, 'Sangat Layak', 0.76, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `benefit` text NOT NULL,
  `bobot` float NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama`, `benefit`, `bobot`) VALUES
(1, 'Administrasi', 'benefit', 0.15),
(2, 'Wawancara', 'benefit', 0.25),
(3, 'Psikotes', 'benefit', 0.35),
(6, 'Medical Check Up', 'benefit', 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE IF NOT EXISTS `pelamar` (
  `id_pelamar` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jk` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pelamar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`id_pelamar`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `email`, `jk`) VALUES
(5, 'Lusiana Gustin', 'PALEMBANG', 'Palembang', '1992-04-01', '12345', 'lusiana@gmail.com', 'Perempuan'),
(6, 'Warnu Reksa Sanubari', 'palembang', 'Palembang', '1995-11-01', '12345', 'warnu@gmail.com', 'Laki-laki'),
(7, 'RM Ayman Nasir', 'palembang', 'Palembang', '1990-11-01', '12345', 'ayman@gmail.com', 'Laki-laki'),
(8, 'Tri Juni Pandawa', 'palembang', 'Palembang', '1993-11-01', '12345', 'trujuni.andawa@gmail.com', 'Laki-laki'),
(9, 'Ahmad Isnadi', 'palembang', 'yogyakarta', '1990-11-01', '12345', 'ahmadisnadi@gmail.com', 'Laki-laki'),
(10, 'Harbi Wiryanata', 'palembang', 'Palembang', '1991-11-01', '12345', 'harbi@gmail.com', 'Laki-laki'),
(11, 'M Nugraha Prima Anka', 'palembang', 'Palembang', '2018-11-01', '12345', 'nugraha@gmail.com', 'Laki-laki'),
(12, 'Prana', 'palembang', 'Palembang', '1991-11-01', '123', 'prana@gmail.com', 'Laki-laki'),
(13, 'Cornelia Agistha', 'palembang', 'Palembang', '1992-11-01', '12345', 'cornelia@gmail.com', 'Perempuan'),
(14, 'Galinur Pajar Patriasima', 'palembang', 'palembang', '1990-11-01', '12345', 'galinur@gmail.com', 'Laki-laki'),
(15, 'M Afrizal', 'palembang', 'Palembang', '1990-11-01', '12345', 'afrizal@gmail.com', 'Laki-laki'),
(16, 'Andri Darmawan', 'palembang', 'Palembang', '1998-11-01', '12345', 'andri@gmail.com', 'Laki-laki'),
(19, 'Andrias Saputra', 'palembang', 'palembang', '2018-11-01', '12345', 'andrias@gmail.com', 'Laki-laki'),
(20, 'Yayang Kurniawan', 'palembang', 'Palembang', '1993-11-01', '12345', 'yayang@gmail.com', 'Laki-laki'),
(21, 'Eko Susilo', 'palembang', 'Palembang', '1991-11-01', '12345', 'yayang@gmail.com', 'Laki-laki'),
(23, 'Febriana Dwi Lestari', 'palembang', 'Palembang', '1991-11-01', '12345', 'febriana@gmail.com', 'Perempuan'),
(24, 'Taufiq Wahyudi', 'palembang', 'Palembang', '1992-11-01', '12345', 'taufiq@gmail.com', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_bobot` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  PRIMARY KEY (`id_penilaian`),
  KEY `id_bobot` (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_pelamar` (`id_pelamar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_bobot`, `id_kriteria`, `id_pelamar`) VALUES
(13, 3, 1, 5),
(14, 7, 2, 5),
(15, 11, 3, 5),
(16, 21, 6, 5),
(17, 3, 1, 6),
(18, 7, 2, 6),
(19, 11, 3, 6),
(20, 21, 6, 6),
(21, 3, 1, 7),
(22, 7, 2, 7),
(23, 11, 3, 7),
(24, 22, 6, 7),
(25, 3, 1, 8),
(26, 8, 2, 8),
(27, 12, 3, 8),
(28, 21, 6, 8),
(29, 3, 1, 9),
(30, 7, 2, 9),
(31, 10, 3, 9),
(32, 21, 6, 9),
(33, 3, 1, 10),
(34, 8, 2, 10),
(35, 12, 3, 10),
(36, 21, 6, 10),
(37, 4, 1, 11),
(38, 7, 2, 11),
(39, 11, 3, 11),
(40, 21, 6, 11),
(41, 4, 1, 12),
(42, 7, 2, 12),
(43, 12, 3, 12),
(44, 21, 6, 12),
(45, 3, 1, 13),
(46, 7, 2, 13),
(47, 11, 3, 13),
(48, 21, 6, 13),
(49, 3, 1, 14),
(50, 7, 2, 14),
(51, 12, 3, 14),
(52, 21, 6, 14),
(53, 3, 1, 15),
(54, 6, 2, 15),
(55, 10, 3, 15),
(56, 21, 6, 15),
(57, 2, 1, 16),
(58, 7, 2, 16),
(59, 11, 3, 16),
(60, 21, 6, 16),
(61, 3, 1, 19),
(62, 7, 2, 19),
(63, 11, 3, 19),
(64, 22, 6, 19),
(65, 3, 1, 20),
(66, 6, 2, 20),
(67, 10, 3, 20),
(68, 21, 6, 20),
(69, 2, 1, 21),
(70, 6, 2, 21),
(71, 10, 3, 21),
(72, 21, 6, 21),
(73, 3, 1, 23),
(74, 7, 2, 23),
(75, 11, 3, 23),
(76, 21, 6, 23),
(77, 3, 1, 24),
(78, 7, 2, 24),
(79, 12, 3, 24),
(80, 21, 6, 24);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_hak_akses` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_hak_akses`) VALUES
(1, 'ina', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, 'supervisor', '827ccb0eea8a706c4c34a16891f84e7b', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot`
--
ALTER TABLE `bobot`
  ADD CONSTRAINT `bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_penilaian`
--
ALTER TABLE `hasil_penilaian`
  ADD CONSTRAINT `hasil_penilaian_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_penilaian_ibfk_2` FOREIGN KEY (`id_keputusan`) REFERENCES `keputusan` (`id_keputusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_bobot`) REFERENCES `bobot` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `hak_akses` (`id_hak_akses`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
