-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2022 at 01:19 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_turnos`
--
CREATE DATABASE IF NOT EXISTS `gestion_turnos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestion_turnos`;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `fecha_fin_reserva` datetime NOT NULL,
  `duracion_turnos` int(2) NOT NULL,
  `matricula_doctor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `dia`, `hora_inicio`, `hora_fin`, `fecha_fin_reserva`, `duracion_turnos`, `matricula_doctor`) VALUES
(6, 'lunes', '07:00:00', '12:00:00', '2022-02-02 23:59:00', 20, 497243947),
(7, 'martes', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 497243947),
(8, 'miercoles', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 497243947),
(9, 'jueves', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 497243947),
(10, 'viernes', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 497243947),
(11, 'lunes', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 661320835),
(12, 'martes', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 661320835),
(13, 'miercoles', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 661320835),
(14, 'jueves', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 661320835),
(15, 'viernes', '07:00:00', '12:00:00', '2022-02-28 00:00:00', 30, 661320835),
(16, 'lunes', '14:00:00', '21:00:00', '2022-02-28 00:00:00', 30, 497243947),
(17, 'martes', '14:00:00', '21:00:00', '2022-02-28 00:00:00', 30, 497243947),
(18, 'miercoles', '14:00:00', '21:00:00', '2022-02-28 00:00:00', 30, 497243947),
(19, 'jueves', '14:00:00', '21:00:00', '2022-02-28 00:00:00', 30, 497243947),
(20, 'viernes', '14:00:00', '21:00:00', '2022-02-28 00:00:00', 30, 497243947),
(21, 'martes', '07:00:00', '12:00:00', '2022-03-31 23:00:00', 30, 865892450),
(24, 'lunes', '07:00:00', '12:00:00', '2022-03-31 23:00:00', 40, 898030585);

-- --------------------------------------------------------

--
-- Table structure for table `clinica`
--

DROP TABLE IF EXISTS `clinica`;
CREATE TABLE IF NOT EXISTS `clinica` (
  `id_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `direccion_sede` varchar(100) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_clinica`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinica`
--

INSERT INTO `clinica` (`id_clinica`, `nombre`, `direccion_sede`, `email`, `localidad`, `telefono`) VALUES
(1, 'Clinica Villa Mercedes', 'Direccion 746', 'clinicavillamercedes@gmail.com', 'Villa Mercedes', '2657-235443');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id_doctor` int(11) NOT NULL AUTO_INCREMENT,
  `id_clinica` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `matricula` int(11) NOT NULL,
  `especializacion` varchar(100) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id_doctor`),
  KEY `id_clinica` (`id_clinica`),
  KEY `id_doctor` (`id_doctor`),
  KEY `matricula` (`matricula`)
) ENGINE=MyISAM AUTO_INCREMENT=1340 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id_doctor`, `id_clinica`, `nombre`, `matricula`, `especializacion`, `localidad`) VALUES
(1261, 1, 'Dr. Cupaiouolo Carlos', 825772690, 'Traumatología', 'Villa Mercedes'),
(1262, 1, 'Dr. Gauna Anibal', 898030585, 'Nutricionista', 'villa mercedes'),
(1263, 1, 'Dr Zeppa Federico', 526955539, 'Nutricionista', 'villa mercedes'),
(1264, 1, 'Dra Leal Julieta', 501538412, 'Nutricionista', 'villa mercedes'),
(1265, 1, 'DR BRAIDA ARIEL', 484220308, 'Traumatología', 'villa mercedes'),
(1266, 1, 'Dra Spadavecchia Gilda', 452810225, 'Traumatología', 'villa mercedes'),
(1267, 1, 'Dr Gonzalez Palacios', 432490347, 'Traumatología', 'villa mercedes'),
(1268, 1, 'Dr. Peralta Ezequiel', 904590052, 'Traumatologia Infantil', 'villa mercedes'),
(1269, 1, 'Dra Alberti Marisol', 299513744, 'Traumatologia Infantil', 'villa mercedes'),
(1270, 1, 'Dr Luzzi Reynaldo', 495227558, 'Traumatologia Infantil', 'villa mercedes'),
(1271, 1, 'Dr Desbats Hugo', 927279333, 'Dermatologia', 'villa mercedes'),
(1272, 1, 'Dr Dib Martin', 170495320, 'Dermatologia', 'villa mercedes'),
(1273, 1, 'Dra Estecho Maria', 497243947, 'Dermatologia', 'villa mercedes'),
(1274, 1, 'Dra Baez Lorena', 286430660, 'Dermatologia', 'villa mercedes'),
(1275, 1, 'Dr Dolcemelo Lucas', 349480137, 'Dermatologia', 'villa mercedes'),
(1276, 1, 'Dra Besopianeto Brenda', 759665615, 'Dermatologia', 'villa mercedes'),
(1277, 1, 'Dr Bressan Marcelo', 223649453, 'Neumonologia', 'villa mercedes'),
(1278, 1, 'Dra. Sponton Belen', 560289669, 'Neumonologia', 'villa mercedes'),
(1279, 1, 'Dr Loccisano Matias', 347965408, 'Neumonologia', 'villa mercedes'),
(1280, 1, 'Dra Vadela Soledad', 864041030, 'Neumonologia', 'villa mercedes'),
(1281, 1, 'Dra Gizzarelli M. ', 732707332, 'Neumonologia', 'villa mercedes'),
(1282, 1, 'Dra. Pires', 144352529, 'Ginecologia y Obstetricia', 'villa mercedes'),
(1283, 1, 'Dr Diaz Lucero Andres', 274168945, 'Ginecologia y Obstetricia', 'villa mercedes'),
(1284, 1, 'Dr Bani', 504783439, 'Ginecologia y Obstetricia', 'villa mercedes'),
(1285, 1, 'Dr. Carras P', 515931540, 'Ginecologia y Obstetricia', 'villa mercedes'),
(1286, 1, 'Dra. Gralatto', 335807292, 'Ginecologia y Obstetricia', 'villa mercedes'),
(1287, 1, 'Dr. Cartier Jorge', 351375888, 'Neurologia', 'villa mercedes'),
(1288, 1, 'Dr Bogado Raul', 619006855, 'Neurologia', 'villa mercedes'),
(1289, 1, 'Dr. Damia', 661320835, 'Ortodoncia', 'villa mercedes'),
(1290, 1, 'Dra. Di Marco Veronica', 897031332, 'Ortodoncia', 'villa mercedes'),
(1291, 1, 'Dra. Guitian Brenda', 643335818, 'Ortodoncia', 'villa mercedes'),
(1292, 1, 'Dr Gregoris Fabricio', 364653853, 'Ortodoncia', 'villa mercedes'),
(1293, 1, 'Dr. Rossi Pablo', 589713456, 'Neurologia Infantil', 'villa mercedes'),
(1294, 1, 'Dra Ramos Sara', 640810221, 'Neurologia Infantil', 'villa mercedes'),
(1295, 1, 'Dr Marques sanches P', 970489203, 'Neurologia Infantil', 'villa mercedes'),
(1296, 1, 'Dr. Gutierrez Lucas', 554978547, 'Neurologia Infantil', 'villa mercedes'),
(1297, 1, 'Dr. Bottos Martin', 359064733, 'Neurologia Infantil', 'villa mercedes'),
(1298, 1, 'Dr. Arrieta Nicolas', 225548780, 'Otorrinolaringologia', 'villa mercedes'),
(1299, 1, 'Dr Arena Alberto', 697215598, 'Otorrinolaringologia', 'villa mercedes'),
(1300, 1, 'Dra Potenza Carolina', 191089380, 'Otorrinolaringologia', 'villa mercedes'),
(1301, 1, 'Dr. Guevara Ramiro', 901184039, 'Otorrinolaringologia', 'villa mercedes'),
(1302, 1, 'Dra Salomon Anahi', 455953517, 'Otorrinolaringologia', 'villa mercedes'),
(1303, 1, 'Dra. Verardo Karina', 193898243, 'Urologia', 'villa mercedes'),
(1304, 1, 'Dr. Lezcano Santiago', 175193336, 'Urologia', 'villa mercedes'),
(1305, 1, 'Dr. Nader Luis', 793366985, 'Urologia', 'villa mercedes'),
(1306, 1, 'Dr. Florit Santiago', 617834943, 'Urologia', 'villa mercedes'),
(1307, 1, 'Dra Aguado Carina', 656598151, 'Gastroenterologia', 'villa mercedes'),
(1308, 1, 'Dr Rey Alejandro', 154775715, 'Gastroenterologia', 'villa mercedes'),
(1309, 1, 'Dr. Vazquez Eduardo', 258386947, 'Gastroenterologia', 'villa mercedes'),
(1310, 1, 'Dr. Alberdi Manuel', 545647078, 'Gastroenterologia', 'villa mercedes'),
(1311, 1, 'Dr. Berman Gaston', 779189957, 'Infectologia', 'villa mercedes'),
(1312, 1, 'Dra. Euvrard Andrea', 576031548, 'Infectologia', 'villa mercedes'),
(1313, 1, 'Dra Bossio Cecilia', 243312719, 'Infectologia', 'villa mercedes'),
(1314, 1, 'Dra. Potente Soledad', 743111194, 'Infectologia', 'villa mercedes'),
(1315, 1, 'Dra. Rota M. Jose', 473744176, 'Infectologia', 'villa mercedes'),
(1316, 1, 'Dr. Wessoloski Sergio', 817237700, 'Infectologia', 'villa mercedes'),
(1317, 1, 'Dr. Torrano Carlos', 764364978, 'Pediatria', 'villa mercedes'),
(1318, 1, 'Dr. Tuculet Juan', 571788143, 'Pediatria', 'villa mercedes'),
(1319, 1, 'Dr. Diaz Lucero Pablo', 175371504, 'Pediatria', 'villa mercedes'),
(1320, 1, 'Dra. Benitez Alicia', 663698904, 'Pediatria', 'villa mercedes'),
(1321, 1, 'Dra. Bogado María Paz', 346746189, 'Pediatria', 'villa mercedes'),
(1322, 1, 'Dr. Paiva Dacio', 612784317, 'Pediatria', 'villa mercedes'),
(1323, 1, 'Dra Micheletti Danisa', 920714968, 'Cardiologia', 'villa mercedes'),
(1324, 1, 'Dr. Viglione G', 695437811, 'Cardiologia', 'villa mercedes'),
(1325, 1, 'Dr. Gava Nestor', 746597330, 'Cardiologia', 'villa mercedes'),
(1326, 1, 'Dr. Romano Pedro', 885223259, 'Cardiologia', 'villa mercedes'),
(1327, 1, 'Dr. Ricci Luis', 307555684, 'Diabetologia', 'villa mercedes'),
(1328, 1, 'Dr. Corominas Guillermo', 257966570, 'Diabetologia', 'villa mercedes'),
(1329, 1, 'Dr. Canedo Pero', 612812816, 'Diabetologia', 'villa mercedes'),
(1330, 1, 'Dr. Diaz Lucero Federico', 850730734, 'Diabetologia', 'villa mercedes'),
(1331, 1, 'Dra. Mangiaterra Romina', 875079005, 'Oncologia', 'villa mercedes'),
(1332, 1, 'Dr. Domljanovic Ivo', 157451349, 'Oncologia', 'villa mercedes'),
(1333, 1, 'Dr. Carlos Ivo', 865892450, 'Cirugia General', 'villa mercedes'),
(1334, 1, 'Dr. Alejando Ivo', 884407253, 'Cirugia Mamaria', 'villa mercedes'),
(1335, 1, 'Dr. Alfredo Cesar', 969471275, 'Cirugia Cardiovascular', 'villa mercedes'),
(1336, 1, 'Dr. Negrete', 681273631, 'Urologia y cirugia inf.', 'villa mercedes'),
(1337, 1, 'Dr. Fernando', 237541608, 'Neurocirugia', 'villa mercedes'),
(1338, 1, 'Dr. Julio Cesar', 520316601, 'Cirugia cabeza y cuello', 'villa mercedes');

-- --------------------------------------------------------

--
-- Table structure for table `historia_clinica`
--

DROP TABLE IF EXISTS `historia_clinica`;
CREATE TABLE IF NOT EXISTS `historia_clinica` (
  `id_historia_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `especializacion` varchar(100) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `matricula_doctor` int(11) NOT NULL,
  PRIMARY KEY (`id_historia_clinica`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `historia_clinica`
--

INSERT INTO `historia_clinica` (`id_historia_clinica`, `especializacion`, `id_paciente`, `fecha`, `matricula_doctor`) VALUES
(1, 'Ortodoncia', 37930187, '2022-01-01', 661320835),
(2, 'Dermatologia', 37930187, '2022-01-08', 927279333),
(4, 'Dermatologia', 37930187, '2022-03-02', 497243947),
(5, 'Cirugia General', 37930187, '2022-03-02', 865892450),
(6, 'Dermatologia', 34234543, '2022-03-02', 497243947);

-- --------------------------------------------------------

--
-- Table structure for table `obra_social`
--

DROP TABLE IF EXISTS `obra_social`;
CREATE TABLE IF NOT EXISTS `obra_social` (
  `id_obra_social` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id_obra_social`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obra_social`
--

INSERT INTO `obra_social` (`id_obra_social`, `nombre`) VALUES
(1, 'DOSEP'),
(2, 'OSDE'),
(3, 'ACA SALUD'),
(4, 'APA - OSPA'),
(5, 'APPI'),
(6, 'APSOT TECHINT'),
(7, 'CAMIONEROS'),
(8, 'CLINICA DEL VALLE - COMAHUE'),
(9, 'ELEVAR'),
(10, 'FATFA'),
(11, 'FEDECAMARAS'),
(12, 'FEDERADA SALUD'),
(13, 'GALENO'),
(14, 'GILSA S.A.'),
(15, 'IOSFA'),
(16, 'ISSN'),
(17, 'JERARQUICOS SALUD'),
(18, 'MEDICUS todos los planes'),
(19, 'MUTUAL DEL CLERO'),
(20, 'MEDIFE'),
(21, 'MUTUAL MOTOCICLISTAS (A.A.M.M.)'),
(22, 'OMINT'),
(23, 'OSAM'),
(24, 'OSFA'),
(25, 'OSPATCA'),
(26, 'OSPEP'),
(27, 'OSPERYRHA'),
(28, 'OSPIDA'),
(29, 'OSPIQYP'),
(30, 'OSSEG'),
(31, 'OPDEA'),
(32, 'OSDOP'),
(33, 'OSDEPYM'),
(34, 'OSFATLYF'),
(35, 'OSPEDYC - UTEDYC'),
(36, 'OSPEPRI'),
(37, 'OSPESGA'),
(38, 'OSPIL'),
(39, 'OSPPRA'),
(40, 'OSPM'),
(41, 'OSALARA'),
(42, 'OSAPM'),
(43, 'OSDIPP'),
(44, 'OSMATA'),
(45, 'OSPEGAP - CONINTEM'),
(46, 'OSPIM'),
(47, 'OSPTA'),
(48, 'OSUOMRA'),
(49, 'PODER JUDICIAL'),
(50, 'POLICIA FEDERAL'),
(51, 'PREVENCION SALUD'),
(52, 'ROTEN STEIN'),
(53, 'SANCOR SALUD'),
(54, 'SER SALUD'),
(55, 'SOSUNC'),
(56, 'SCIS'),
(57, 'SERVESALUD'),
(58, 'SWISS MEDICAL GROUP'),
(59, 'SALUD TOTAL'),
(60, 'SERV. PENITENCIARIO FEDERAL'),
(61, 'UNION PERSONAL - (UPCN)'),
(62, 'VISITAR ANDAR');

-- --------------------------------------------------------

--
-- Table structure for table `procedimiento`
--

DROP TABLE IF EXISTS `procedimiento`;
CREATE TABLE IF NOT EXISTS `procedimiento` (
  `id_procedimiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `indicaciones` varchar(200) DEFAULT NULL,
  `matricula_doctor` int(11) NOT NULL,
  PRIMARY KEY (`id_procedimiento`),
  KEY `id_doctor` (`matricula_doctor`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procedimiento`
--

INSERT INTO `procedimiento` (`id_procedimiento`, `nombre`, `indicaciones`, `matricula_doctor`) VALUES
(32, 'Cirugia General', 'Seguir las siguientes indicaciones para el procedimiento:', 865892450),
(33, 'Cirugia Mamaria', 'Seguir las siguientes indicaciones para el procedimiento:', 884407253),
(34, 'Cirugia Cardiovascular', 'Seguir las siguientes indicaciones para el procedimiento:', 969471275),
(35, 'Urologia y cirugia inf.', 'Seguir las siguientes indicaciones para el procedimiento:', 681273631),
(36, 'Neurocirugia', 'Seguir las siguientes indicaciones para el procedimiento:', 237541608),
(37, 'Cirugia cabeza y cuello', 'Seguir las siguientes indicaciones para el procedimiento:', 520316601);

-- --------------------------------------------------------

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `dni_paciente` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha_turno` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `tipo_turno` varchar(80) NOT NULL,
  `matricula_doctor` int(11) NOT NULL,
  PRIMARY KEY (`id_turno`),
  KEY `dni_paciente` (`dni_paciente`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turno`
--

INSERT INTO `turno` (`id_turno`, `dni_paciente`, `hora`, `fecha_turno`, `fecha_registro`, `estado`, `tipo_turno`, `matricula_doctor`) VALUES
(20, 37930187, '09:00:00', '2022-02-07', '2022-02-07', 'Cancelado', 'consulta', 497243947),
(19, 37930187, '10:30:00', '2022-02-07', '2022-02-01', 'Cancelado', 'consulta', 497243947),
(18, 37930187, '09:30:00', '2022-02-07', '2022-02-01', 'Cancelado', 'consulta', 497243947),
(17, 37930187, '08:30:00', '2022-02-07', '2022-02-01', 'Cancelado', 'consulta', 497243947),
(16, 37930187, '08:00:00', '2022-02-07', '2022-02-01', 'Atendido', 'consulta', 497243947),
(15, 37930187, '07:30:00', '2022-02-07', '2022-02-01', 'Atendido', 'consulta', 497243947),
(14, 37930187, '07:00:00', '2022-02-07', '2022-02-01', 'Ausente', 'consulta', 497243947),
(21, 37930187, '11:30:00', '2022-02-07', '2022-02-07', 'Atendido', 'consulta', 497243947),
(22, 37930187, '07:00:00', '2022-02-21', '2022-02-16', 'Atendido', 'consulta', 497243947),
(23, 37930187, '07:00:00', '2022-02-22', '2022-02-16', 'Atendido', 'procedimiento', 865892450),
(24, 37930187, '07:30:00', '2022-02-22', '2022-02-16', 'Atendido', 'procedimiento', 865892450),
(80, 37930187, '08:00:00', '2022-02-25', '2022-02-25', 'Atendido', 'consulta', 497243947),
(79, 37930187, '07:30:00', '2022-02-25', '2022-02-25', 'Atendido', 'consulta', 497243947),
(77, 37930187, '20:30:00', '2022-02-25', '2022-02-24', 'Atendido', 'consulta', 497243947),
(81, 37930187, '07:00:00', '2022-03-08', '2022-03-02', 'Pendiente', 'procedimiento', 865892450),
(78, 34234543, '07:00:00', '2022-02-25', '2022-02-25', 'Atendido', 'consulta', 497243947),
(75, 37930187, '08:00:00', '2022-02-22', '2022-02-21', 'Atendido', 'procedimiento', 865892450),
(82, 37930573, '07:30:00', '2022-03-08', '2022-03-02', 'Pendiente', 'procedimiento', 865892450),
(83, 37930187, '08:00:00', '2022-03-08', '2022-03-02', 'Pendiente', 'procedimiento', 865892450),
(86, 37930187, '08:20:00', '2022-03-07', '2022-03-03', 'Pendiente', 'consulta', 898030585);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `direccion_usuario` varchar(100) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `cancelaciones` int(11) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `grupo_sanguineo` varchar(20) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `rol` enum('paciente','administrador','administracion') NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `obra_social` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`dni`),
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `dni`, `nombre`, `apellido`, `password`, `direccion_usuario`, `celular`, `cancelaciones`, `email`, `grupo_sanguineo`, `sexo`, `rol`, `fecha_nacimiento`, `obra_social`) VALUES
(8, 34556654, 'Nicolas Ezequiel', 'Perez', '$2y$10$/le4sczJ6IpU6iVRVmxueODmrRPuxe25k0pt9VcBtPzULCy5BDZGm', 'Colon 743', '2657436545', NULL, 'administrador@gmail.com', NULL, 'Masculino', 'administrador', '1994-12-14', NULL),
(29, 34658787, 'Maria Celeste', 'Perez', '$2y$10$SdnZ2ns3ObS7abHWFpz1y.iAKz76y.DWxZXTYEBWEcY/OljHYe.sm', 'Estado De Israel 543', '2657436545', NULL, 'administracion@gmail.com', NULL, 'Femenino', 'administracion', '1994-12-14', NULL),
(28, 37930187, 'Fernando Daniel', 'Gonzalez', '$2y$10$MVXtnY3JfUwY84b5ay1py.B.yXpz.SAFPc7u6moEK1O0IhyZrA1Z2', 'Ramón Valdez 734', '2657564534', 10, 'kaiserkey2@gmail.com', NULL, 'Masculino', 'paciente', '1994-12-14', 'DOSEP'),
(30, 37930573, 'Guillermo Antonio', 'Argañaras', '$2y$10$i2bSCLckLrUHy5r6WQfOBu3UGWmQzI5xgwBARglXio2f2wdYU8CzG', 'Colon 333', '2657346587', NULL, 'guillermo01@gmail.com', NULL, 'Masculino', 'paciente', '1994-03-22', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
