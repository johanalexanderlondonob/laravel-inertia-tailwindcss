-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 02:53 PM
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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id_city`, `name`, `id_department`) VALUES
(1, 'MEDELLÍN', 1),
(2, 'BELLO', 1),
(3, 'CALDAS', 1),
(4, 'RIONEGRO', 1),
(5, 'AMAGÁ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `considerations`
--

CREATE TABLE `considerations` (
  `id_consideration` int(11) NOT NULL,
  `id_worksheet_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `consideration` varchar(1024) NOT NULL,
  `path_image1` varchar(1024) DEFAULT NULL,
  `path_image2` varchar(1024) DEFAULT NULL,
  `path_image3` varchar(1024) DEFAULT NULL,
  `path_image4` varchar(1024) DEFAULT NULL,
  `path_image5` varchar(1024) DEFAULT NULL,
  `path_image6` varchar(1024) DEFAULT NULL,
  `path_image7` varchar(1024) DEFAULT NULL,
  `path_image8` varchar(1024) DEFAULT NULL,
  `path_image9` varchar(1024) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_third` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'S',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_third`, `active`, `created_at`, `updated_at`) VALUES
(34, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(35, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(36, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(37, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(38, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(39, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(41, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(42, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(44, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(45, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(46, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(47, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(48, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(49, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(50, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(51, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(52, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(53, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(54, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(55, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(56, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(57, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(58, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(59, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(60, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(61, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(62, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(63, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(64, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(65, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(66, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(67, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(68, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18'),
(69, 'S', '2021-02-26 17:50:18', '2021-02-26 17:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id_department` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id_department`, `name`, `country`) VALUES
(1, 'ANTIOQUIA', 'COLOMBIA');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `identification_types`
--

CREATE TABLE `identification_types` (
  `id_identification_type` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code_rips` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identification_types`
--

INSERT INTO `identification_types` (`id_identification_type`, `name`, `code_rips`) VALUES
(1, 'NIT', 'NIT'),
(2, 'CÉDULA DE CIUDADANÍA', 'CC'),
(3, 'TARJETA PROFESIONAL', 'TP'),
(4, 'CÉDULA DE EXTRANJERÍA', 'CE'),
(5, 'NÚMERO ÚNICO DE IDENTIFICACIÓN', 'NU'),
(6, 'TARJETA DE IDENTIDAD', 'TI');

-- --------------------------------------------------------


--
-- Dumping data for table `migrations`

--
-- Table structure for table `nature_types`
--

CREATE TABLE `nature_types` (
  `id_nature_type` int(11) NOT NULL,
  `code` varchar(1) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nature_types`
--

INSERT INTO `nature_types` (`id_nature_type`, `code`, `name`) VALUES
(1, 'J', 'PERSONA JURÍDICA'),
(2, 'N', 'PERSONA NATURAL');

--
-- Table structure for table `processes`
--

CREATE TABLE `processes` (
  `id_process` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `sequence` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'S',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `processes`
--

INSERT INTO `processes` (`id_process`, `name`, `description`, `sequence`, `active`, `created_at`, `updated_at`) VALUES
(6, 'DIGITACIÓN', NULL, 1, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(7, 'AUDITORÍA', NULL, 2, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(8, 'INVENTARIOS', NULL, 3, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(9, 'FINANCIERA', NULL, 4, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(10, 'REVISORÍA FISCAL', NULL, 5, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `processes_leaders`
--

CREATE TABLE `processes_leaders` (
  `id_process` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'S',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id_status` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subprocesses`
--

CREATE TABLE `subprocesses` (
  `id_subprocess` int(11) NOT NULL,
  `id_process` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `execution_order` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'S',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subprocesses`
--

INSERT INTO `subprocesses` (`id_subprocess`, `id_process`, `name`, `description`, `execution_order`, `active`, `created_at`, `updated_at`) VALUES
(1, 7, 'CONCILIAR BANCOS', NULL, 1, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(2, 7, 'REVISAR COMPRAS', NULL, 2, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(3, 7, 'REVISAR GASTOS', NULL, 3, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(4, 6, 'DIGITAR EGRESOS', NULL, 1, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(5, 6, 'DIGITAR COMPRAS', NULL, 2, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(6, 8, 'CONTAR MUÑEQUITOS', NULL, 1, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(7, 9, 'RECALCULAR INVENTARIO', NULL, 1, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00'),
(8, 9, 'CERRAR MES', NULL, 2, 'S', '2021-02-18 15:59:00', '2021-02-18 15:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `thirds`
--

CREATE TABLE `thirds` (
  `id_third` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_nature_type` int(11) NOT NULL,
  `id_identification_type` int(11) NOT NULL,
  `id_regime_type` int(11) NOT NULL,
  `nit` varchar(15) NOT NULL,
  `third_name` varchar(100) NOT NULL,
  `name1` varchar(30) DEFAULT NULL,
  `name2` varchar(30) DEFAULT NULL,
  `lastname1` varchar(30) DEFAULT NULL,
  `lastname2` varchar(30) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thirds`
--

INSERT INTO `thirds` (`id_third`, `id_city`, `id_nature_type`, `id_identification_type`, `id_regime_type`, `nit`, `third_name`, `name1`, `name2`, `lastname1`, `lastname2`, `address`, `phone1`, `phone2`, `email`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 2, 3, '1026154301', 'JOHAN ALEXANDER LONDOÑO BEDOYA', 'JOHAN', 'ALEXANDER', 'LONDOÑO', 'BEDOYA', 'CALLE 140B SUR #51-185 AP 301', '3195893669', NULL, 'johannlondonob@gmail.com', '2021-02-18 18:12:22', '2021-02-23 13:46:26'),
(25, 3, 2, 2, 3, '43687173', 'PATRICIA MARÍA BEDOYA ARENAS', 'PATRICIA', 'MARÍA', 'BEDOYA', 'ARENAS', 'CR 56 117 SUR APTO 124', '3006306585', NULL, 'patri.mariab9795@gmail.com', '2021-02-23 22:25:11', '2021-02-23 22:25:11'),
(33, 5, 2, 2, 3, '1026153139', 'ANDRÉS FELIPE RENDÓN ZAPATA', 'ANDRÉS', 'FELIPE', 'RENDÓN', 'ZAPATA', 'CR 56 117 SUR APTO 124', '3197183660', NULL, 'anfe0595@gmail.com', '2021-02-24 22:39:05', '2021-02-24 22:39:05'),
(34, 1, 1, 2, 1, '900367317', 'PLASTICOS MINIPET S.A.S', '', '', '', '', 'CR 46 50 47 IN 202', '4485047', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(35, 1, 1, 2, 1, '900622041', 'INDUSTRIAS CASTILLO ALZATE S.A.S', '', '', '', '', 'CR 50 CL 48 56 IN 402', '4485747', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(36, 1, 2, 1, 3, '71527027', 'PABLO ANDRES PELAEZ ARISTIZABAL', 'PABLO', 'ANDRES', 'PELAEZ', 'ARISTIZABAL', 'CL 7 81 40 AP 1003', '5794588', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(37, 1, 1, 2, 1, '900215484', 'INTERLINK DE COLOMBIA S.A.S.', '', '', '', '', 'CR 43 A 18 SUR 135 OF 913', '3141366', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(38, 1, 1, 2, 1, '811008560', 'MASFINCA S.A.S.', '', '', '', '', 'cl 85 48 01 BL 30 LC 2', '4448191', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(39, 1, 1, 2, 1, '811028717', 'HUMMALAB S.A.S', '', '', '', '', 'cl 7 SUR 51 A 100', '4445246', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(40, 1, 1, 2, 1, '800092727', 'REDU INVERSIONES S.A.S', '', '', '', '', 'cr 52 38 33', '2324994', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(41, 1, 1, 2, 1, '900727910', 'COLOMBIA BELGIUM 4 TRADE S.A.S', '', '', '', '', 'tv 39 76 16', '4138453', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(42, 1, 1, 2, 1, '900476827', 'ATW INTERNACIONAL S.A.S', '', '', '', '', 'cr 83 A 37 C 21', '4138774', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(44, 1, 1, 2, 1, '901036148', 'MAESTROS DEL CUERO S.A.S.', '', '', '', '', 'cl 5 SUR 22 290 IN 1325', '3536927', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(45, 1, 1, 2, 1, '900632137', 'TRES UNOS S.A.S.', '', '', '', '', 'cr 43 A 18 SUR 135 OF 913', '3141366', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(46, 1, 1, 2, 1, '901156099', 'YOMA INVERSIONES Y DISTRIBUCIONES SAS', '', '', '', '', 'cl 48 99 A 74', '2530760', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(47, 1, 1, 2, 1, '901158101', 'GRUPO AROMA CLEAN S.A.S.', '', '', '', '', 'cl 24 65 F 20', '3188272260', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(48, 1, 2, 1, 3, '8358161', 'DAVID CUARTAS VELEZ', 'DAVID', '', 'CUARTAS', 'VELEZ', 'CR 27 D 27 SUR 164', '2089198', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(49, 1, 1, 2, 1, '901246829', 'SLIM ACTIVE GROUP S.A.S', '', '', '', '', 'cr 28-29-190 INT 163', '3113655306', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(50, 1, 1, 2, 1, '900852976', 'INVERSIONES MEDELLIN BURGER COMPANY S.A.S.', '', '', '', '', 'cr 4 # 70-12', '4111277', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(51, 1, 1, 2, 1, '900812546', 'STARCHEM S.A.S', '', '', '', '', 'PAR INDUSTRIAL ELITE KM 1 200 BG 3', '6022382', '', 'giuliano.castellani@star-na.com', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(52, 1, 1, 2, 1, '901118257', 'COCOROLLO EL LIMONAR S.A.S', '', '', '', '', 'vda PORTACHUELO AUT NORTE km 20', '3104472065', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(53, 1, 1, 2, 1, '901115486', 'MINIMERCADOS COCOROLLO S.A.S', '', '', '', '', 'CR 48 100 B SUR 151 VTE CALDAS', '6046183', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(54, 1, 1, 2, 1, '900993023', 'COCOROLLO EL ALTICO S.A.S', '', '', '', '', 'cr 48 100 B SUR 151', '6046183', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(55, 1, 1, 2, 1, '900931879', 'INSUMOS OROROSA S.A.S', '', '', '', '', 'CR 56 B 49-45LC 113', '3105359673', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(56, 1, 1, 2, 1, '901053485', 'LISTO EL POLLO COLOMBIA S.A.S', '', '', '', '', 'CR 58 #9-34', '3176439715', '', 'daniela.sierra@listoelpollo.com.co', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(57, 1, 1, 2, 1, '901099206', 'PAFARES S.A.S', '', '', '', '', 'CR 41 24 131 IN 411', '3207278144', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(58, 1, 1, 2, 1, '901377275', 'SOLUCIONES LOCATIVAS E INFORMATICAS S.A.S', '', '', '', '', 'CARRERA 37 A # 29 72 TORRE 2 APTO 101', '3046335371', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(59, 1, 1, 2, 1, '900242161', 'CORPORACION ANDINA PARA EL FOMENTO DE LA EDUCACION Y EL DESARROLLO SOSTENIBLE', '', '', '', '', 'CLL 56 CR 41 155', '6045218', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(60, 1, 1, 2, 1, '900261139', 'FUNDACION ANDINA PARA EL DESARROLLO DE LA EDUCACION, LA CULTURA Y EL SER', '', '', '', '', 'CLL 56 CR 41', '6045218', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(61, 1, 1, 2, 1, '901416045', 'NOMADA STORE S.A.S', '', '', '', '', 'CR 10 # 19 SUR -99', '3148120045', '', 'nomada.balance@gmail.com', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(62, 1, 1, 2, 1, '901074485', 'FORWARD MUSIC S.A.S.', '', '', '', '', '', '3187612693', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(63, 1, 1, 2, 1, '811016603', 'MAS FINCA PRODUCCION S.A.S', '', '', '', '', 'CLE 42 C 81 22', '4800450', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(64, 1, 1, 2, 1, '901266995', 'SJR LAB S.A.S', '', '', '', '', 'CR 93 B 38-211', '3504513060', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(65, 1, 2, 1, 3, '1039467736', 'LUISA MARIA PALACIO JARAMILLO', 'LUISA', 'MARIA', 'PALACIO', 'JARAMILLO', 'CL 73 SUR 45 A 35', '3174968676', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(66, 1, 1, 2, 1, '901280379', 'CENSOR COLOMBIA S.A.S', '', '', '', '', 'CR 93 B 38 211 IN 508', '3104256007', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(67, 1, 1, 2, 1, '901307901', 'MABILAND S.A.S', '', '', '', '', 'CR 73 22 67', '3105055147', '', '', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(68, 1, 1, 2, 1, '901306929', 'PROYECTO AZUL S.A.S', '', '', '', '', 'CR 32 9 SUR 83', '3216449997', '', 'titi@latabla.co', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(69, 1, 1, 2, 1, '900842239', 'MVM INDUSTRIES S.A.S.', '', '', '', '', 'cl 29 D 55 131 IN 201', '3148890364', '', 'contabilidad@mvmindustries.com.co', '2021-02-26 17:45:43', '2021-02-26 17:45:43'),
(70, 1, 1, 2, 1, '901383501', 'INDUSTRIAS DIANA ALZATE S.A.S', '', '', '', '', 'TV 49 C 59 55 P 3', '3174312120', '', 'admin@castillitos.com', '2021-02-26 17:45:43', '2021-02-26 17:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `third_regime_types`
--

CREATE TABLE `third_regime_types` (
  `id_regime_type` int(11) NOT NULL,
  `code_regime_type` varchar(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `third_regime_types`
--

INSERT INTO `third_regime_types` (`id_regime_type`, `code_regime_type`, `name`) VALUES
(1, 'C', 'RESPONSABLE DE IVA'),
(2, 'F', 'RÉGIMEN SIMPLE'),
(3, 'N', 'PERSONA NATURAL'),
(4, 'R', 'NO RESPONSABLE DE IVA');

-- -------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `worksheets`
--

CREATE TABLE `worksheets` (
  `id_worksheet` int(11) NOT NULL,
  `period` varchar(4) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `opened` varchar(1) NOT NULL DEFAULT 'S',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worksheets`
--

INSERT INTO `worksheets` (`id_worksheet`, `period`, `id_customer`, `opened`, `created_at`, `updated_at`) VALUES
(66, '2101', 34, 'S', '2021-03-03 20:13:33', '2021-03-03 20:13:33'),
(67, '2102', 34, 'S', '2021-03-03 23:25:49', '2021-03-03 23:25:49'),
(68, '2103', 34, 'S', '2021-03-03 23:26:27', '2021-03-03 23:26:27'),
(69, '2104', 34, 'S', '2021-03-05 00:16:30', '2021-03-05 00:16:30'),
(70, '2101', 35, 'S', '2021-03-08 19:59:37', '2021-03-08 19:59:37'),
(71, '2103', 35, 'S', '2021-03-08 20:01:10', '2021-03-08 20:01:10'),
(72, '2104', 35, 'S', '2021-03-08 20:08:02', '2021-03-08 20:08:02'),
(73, '2101', 38, 'S', '2021-03-09 04:13:57', '2021-03-09 04:13:57'),
(74, '2101', 37, 'S', '2021-03-09 17:11:25', '2021-03-09 17:11:25'),
(75, '2101', 59, 'S', '2021-03-10 18:03:49', '2021-03-10 18:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `worksheets_details`
--

CREATE TABLE `worksheets_details` (
  `id_worksheet_detail` int(11) NOT NULL,
  `id_worksheet` int(11) NOT NULL,
  `id_subprocess` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worksheets_details`
--

INSERT INTO `worksheets_details` (`id_worksheet_detail`, `id_worksheet`, `id_subprocess`, `id_user`, `id_status`, `created_at`, `updated_at`) VALUES
(1, 66, 4, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(2, 66, 5, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(3, 66, 5, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(4, 66, 1, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(5, 66, 2, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(6, 66, 3, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(7, 66, 3, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(8, 66, 6, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(9, 66, 6, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(10, 66, 7, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(11, 66, 8, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07'),
(12, 66, 8, NULL, NULL, '2021-03-12 12:53:07', '2021-03-12 12:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `worksheets_processes`
--

CREATE TABLE `worksheets_processes` (
  `id_worksheet_process` int(11) NOT NULL,
  `id_process` int(11) NOT NULL,
  `ideal_completion_date` datetime NOT NULL,
  `id_worksheet` int(11) NOT NULL,
  `creator_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worksheets_processes`
--

INSERT INTO `worksheets_processes` (`id_worksheet_process`, `id_process`, `ideal_completion_date`, `id_worksheet`, `creator_user`, `created_at`, `updated_at`) VALUES
(4, 6, '2021-03-19 00:00:00', 66, 2, '2021-03-12 14:40:45', '2021-03-12 14:40:45'),
(5, 7, '2021-03-26 00:00:00', 66, 2, '2021-03-12 14:40:45', '2021-03-12 14:40:45'),
(6, 8, '2021-04-02 00:00:00', 66, 2, '2021-03-12 14:40:45', '2021-03-12 14:40:45'),
(7, 9, '2021-04-09 00:00:00', 66, 2, '2021-03-12 14:40:45', '2021-03-12 14:40:45'),
(12, 6, '2021-03-19 00:00:00', 66, 2, '2021-03-12 16:03:41', '2021-03-12 16:03:41'),
(13, 7, '2021-03-26 00:00:00', 66, 2, '2021-03-12 16:03:41', '2021-03-12 16:03:41'),
(14, 8, '2021-04-02 00:00:00', 66, 2, '2021-03-12 16:03:41', '2021-03-12 16:03:41'),
(15, 9, '2021-04-09 00:00:00', 66, 2, '2021-03-12 16:03:41', '2021-03-12 16:03:41'),
(16, 6, '2021-03-19 00:00:00', 66, 2, '2021-03-12 17:53:07', '2021-03-12 17:53:07'),
(17, 7, '2021-03-26 00:00:00', 66, 2, '2021-03-12 17:53:07', '2021-03-12 17:53:07'),
(18, 8, '2021-04-02 00:00:00', 66, 2, '2021-03-12 17:53:07', '2021-03-12 17:53:07'),
(19, 9, '2021-04-09 00:00:00', 66, 2, '2021-03-12 17:53:07', '2021-03-12 17:53:07');

--
-- Triggers `worksheets_processes`
--
DELIMITER $$
CREATE TRIGGER `trigger_generate_worksheet_detail` AFTER INSERT ON `worksheets_processes` FOR EACH ROW BEGIN
    DECLARE id_subprocess INT;
    DECLARE err BOOLEAN DEFAULT FALSE;
    DECLARE cursor_subprocesses_by_process CURSOR FOR SELECT s.id_subprocess
                                                      FROM subprocesses s
                                                      WHERE s.id_process = new.id_process
                                                        AND s.active = 'S';

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET err = TRUE;
    OPEN cursor_subprocesses_by_process;
    cursor_subprocesses_by_process_loop:
    LOOP
        FETCH cursor_subprocesses_by_process INTO id_subprocess;
        INSERT INTO worksheets_details(id_worksheet, id_subprocess) VALUES (new.id_worksheet, id_subprocess);
        IF err = TRUE THEN
            LEAVE cursor_subprocesses_by_process_loop;
        END IF;
    END LOOP;
    CLOSE cursor_subprocesses_by_process;
END
$$
DELIMITER ;
--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id_city`),
  ADD KEY `cities_departments` (`id_department`);

--
-- Indexes for table `considerations`
--
ALTER TABLE `considerations`
  ADD PRIMARY KEY (`id_consideration`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD UNIQUE KEY `id_third` (`id_third`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `identification_types`
--
ALTER TABLE `identification_types`
  ADD PRIMARY KEY (`id_identification_type`),
  ADD UNIQUE KEY `code_rips` (`code_rips`);

--
-- Indexes for table `nature_types`
--
ALTER TABLE `nature_types`
  ADD PRIMARY KEY (`id_nature_type`),
  ADD UNIQUE KEY `code` (`code`);
ALTER TABLE `nature_types` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`id_process`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `processes_leaders`
--
ALTER TABLE `processes_leaders`
  ADD KEY `processes_leaders_processes` (`id_process`),
  ADD KEY `processes_leaders_users` (`id_user`);

--

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subprocesses`
--
ALTER TABLE `subprocesses`
  ADD PRIMARY KEY (`id_subprocess`),
  ADD KEY `subprocesses_processes` (`id_process`);
ALTER TABLE `subprocesses` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `thirds`
--
ALTER TABLE `thirds`
  ADD PRIMARY KEY (`id_third`),
  ADD UNIQUE KEY `nit` (`nit`),
  ADD KEY `thirds_cities` (`id_city`),
  ADD KEY `thirds_nature_types` (`id_nature_type`),
  ADD KEY `thirds_identification_types` (`id_identification_type`),
  ADD KEY `thirds_regime_types` (`id_regime_type`);

--
-- Indexes for table `third_regime_types`
--
ALTER TABLE `third_regime_types`
  ADD PRIMARY KEY (`id_regime_type`),
  ADD UNIQUE KEY `code_regime_type` (`code_regime_type`);

--
-- Indexes for table `worksheets`
--
ALTER TABLE `worksheets`
  ADD PRIMARY KEY (`id_worksheet`),
  ADD KEY `id_customer` (`id_customer`);
ALTER TABLE `worksheets` ADD FULLTEXT KEY `period` (`period`);

--
-- Indexes for table `worksheets_details`
--
ALTER TABLE `worksheets_details`
  ADD PRIMARY KEY (`id_worksheet_detail`),
  ADD KEY `worsheets_details_worksheets` (`id_worksheet`),
  ADD KEY `worksheets_details_subprocesses` (`id_subprocess`),
  ADD KEY `worksheets_details_users` (`id_user`),
  ADD KEY `worksheets_details_statuses` (`id_status`);

--
-- Indexes for table `worksheets_processes`
--
ALTER TABLE `worksheets_processes`
  ADD PRIMARY KEY (`id_worksheet_process`),
  ADD KEY `worksheets_processes_processes` (`id_process`),
  ADD KEY `worksheets_processes_worksheets` (`id_worksheet`),
  ADD KEY `worksheets_processes_users` (`creator_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `considerations`
--
ALTER TABLE `considerations`
  MODIFY `id_consideration` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


--
-- AUTO_INCREMENT for table `identification_types`
--
ALTER TABLE `identification_types`
  MODIFY `id_identification_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nature_types`
--
ALTER TABLE `nature_types`
  MODIFY `id_nature_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `processes`
--
ALTER TABLE `processes`
  MODIFY `id_process` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subprocesses`
--
ALTER TABLE `subprocesses`
  MODIFY `id_subprocess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `thirds`
--
ALTER TABLE `thirds`
  MODIFY `id_third` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `third_regime_types`
--
ALTER TABLE `third_regime_types`
  MODIFY `id_regime_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `worksheets`
--
ALTER TABLE `worksheets`
  MODIFY `id_worksheet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `worksheets_details`
--
ALTER TABLE `worksheets_details`
  MODIFY `id_worksheet_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `worksheets_processes`
--
ALTER TABLE `worksheets_processes`
  MODIFY `id_worksheet_process` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_departments` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id_department`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_thirds` FOREIGN KEY (`id_third`) REFERENCES `thirds` (`id_third`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `processes_leaders`
--
ALTER TABLE `processes_leaders`
  ADD CONSTRAINT `processes_leaders_processes` FOREIGN KEY (`id_process`) REFERENCES `processes` (`id_process`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `processes_leaders_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subprocesses`
--
ALTER TABLE `subprocesses`
  ADD CONSTRAINT `subprocesses_processes` FOREIGN KEY (`id_process`) REFERENCES `processes` (`id_process`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thirds`
--
ALTER TABLE `thirds`
  ADD CONSTRAINT `thirds_cities` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thirds_identification_types` FOREIGN KEY (`id_identification_type`) REFERENCES `identification_types` (`id_identification_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thirds_nature_types` FOREIGN KEY (`id_nature_type`) REFERENCES `nature_types` (`id_nature_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thirds_regime_types` FOREIGN KEY (`id_regime_type`) REFERENCES `third_regime_types` (`id_regime_type`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --
-- -- Constraints for table `users`
-- --
-- ALTER TABLE `users`
--   ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `thirds` (`id_third`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worksheets`
--
ALTER TABLE `worksheets`
  ADD CONSTRAINT `worksheets_customers` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_third`) ON UPDATE CASCADE;

--
-- Constraints for table `worksheets_details`
--
ALTER TABLE `worksheets_details`
  ADD CONSTRAINT `worksheets_details_statuses` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worksheets_details_subprocesses` FOREIGN KEY (`id_subprocess`) REFERENCES `subprocesses` (`id_subprocess`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worksheets_details_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worsheets_details_worksheets` FOREIGN KEY (`id_worksheet`) REFERENCES `worksheets` (`id_worksheet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worksheets_processes`
--
ALTER TABLE `worksheets_processes`
  ADD CONSTRAINT `worksheets_processes_processes` FOREIGN KEY (`id_process`) REFERENCES `processes` (`id_process`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worksheets_processes_users` FOREIGN KEY (`creator_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worksheets_processes_worksheets` FOREIGN KEY (`id_worksheet`) REFERENCES `worksheets` (`id_worksheet`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
