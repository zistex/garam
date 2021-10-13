-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 13, 2021 at 05:17 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gisgaram`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aset`
--

DROP TABLE IF EXISTS `tbl_aset`;
CREATE TABLE IF NOT EXISTS `tbl_aset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` int NOT NULL,
  `idpeta` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_aset`
--

INSERT INTO `tbl_aset` (`id`, `kategori`, `idpeta`, `nama`, `gambar`, `alamat`) VALUES
(1, 1, 1, 'ladang 1', 'ladang1.jpeg', 'jln. abc');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
