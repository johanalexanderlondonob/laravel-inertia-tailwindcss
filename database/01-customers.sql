-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 09:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arketops`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_third` int(11) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'S',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_third`, `alias`, `active`, `created_at`, `updated_at`) VALUES
(34, 'minipet', 'S', '2021-02-26 17:50:18', '2021-06-17 15:39:05'),
(35, 'castillitos', 'S', '2021-02-26 17:50:18', '2021-06-17 15:39:15'),
(36, 'pablo', 'N', '2021-02-26 17:50:18', '2021-06-17 15:39:35'),
(37, 'interlink', 'S', '2021-02-26 17:50:18', '2021-06-17 15:39:52'),
(38, 'masfinca', 'N', '2021-02-26 17:50:18', '2021-06-17 15:40:14'),
(39, 'hummalab', 'S', '2021-02-26 17:50:18', '2021-06-17 15:40:31'),
(41, 'cb4', 'S', '2021-02-26 17:50:18', '2021-06-17 15:40:52'),
(42, 'atw', 'S', '2021-02-26 17:50:18', '2021-06-17 15:41:04'),
(44, 'maceus', 'S', '2021-02-26 17:50:18', '2021-06-17 15:41:34'),
(45, '111', 'S', '2021-02-26 17:50:18', '2021-06-17 15:41:45'),
(46, 'yoma', 'S', '2021-02-26 17:50:18', '2021-06-17 15:41:59'),
(47, 'aroma', 'S', '2021-02-26 17:50:18', '2021-06-17 15:42:16'),
(48, 'buho', 'S', '2021-02-26 17:50:18', '2021-06-17 15:42:29'),
(49, 'slim', 'S', '2021-02-26 17:50:18', '2021-06-17 15:42:45'),
(50, 'mbc', 'S', '2021-02-26 17:50:18', '2021-06-17 15:42:58'),
(51, 'starchem', 'S', '2021-02-26 17:50:18', '2021-06-17 15:43:10'),
(52, 'limonar', 'S', '2021-02-26 17:50:18', '2021-06-17 15:44:37'),
(53, 'minimercados', 'S', '2021-02-26 17:50:18', '2021-06-17 15:44:28'),
(54, 'altico', 'S', '2021-02-26 17:50:18', '2021-06-17 15:44:17'),
(55, 'ororosa', 'S', '2021-02-26 17:50:18', '2021-06-17 15:44:52'),
(56, 'listo-el-pollo', 'S', '2021-02-26 17:50:18', '2021-06-17 15:45:09'),
(57, 'pafares', 'S', '2021-02-26 17:50:18', '2021-06-17 15:45:26'),
(58, 'soluciones-locativas', 'S', '2021-02-26 17:50:18', '2021-06-17 15:45:58'),
(59, 'corfeandina', 'N', '2021-02-26 17:50:18', '2021-06-17 15:47:25'),
(60, 'fundacer', 'S', '2021-02-26 17:50:18', '2021-06-17 15:47:36'),
(61, 'nomada', 'S', '2021-02-26 17:50:18', '2021-06-17 15:48:25'),
(62, 'forward', 'S', '2021-02-26 17:50:18', '2021-06-17 15:48:40'),
(63, 'masfinca-produccion', 'N', '2021-02-26 17:50:18', '2021-06-17 15:49:04'),
(64, 'sjr-lab', 'S', '2021-02-26 17:50:18', '2021-06-17 15:49:29'),
(65, 'girly', 'S', '2021-02-26 17:50:18', '2021-06-17 15:49:44'),
(66, 'censor', 'S', '2021-02-26 17:50:18', '2021-06-17 15:49:55'),
(67, 'mabiland', 'S', '2021-02-26 17:50:18', '2021-06-17 15:50:04'),
(68, 'proyecto-azul', 'S', '2021-02-26 17:50:18', '2021-06-17 15:50:20'),
(69, 'mvm', 'S', '2021-02-26 17:50:18', '2021-06-17 15:50:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD UNIQUE KEY `id_third` (`id_third`),
  ADD UNIQUE KEY `third_alias` (`alias`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_thirds` FOREIGN KEY (`id_third`) REFERENCES `thirds` (`id_third`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
