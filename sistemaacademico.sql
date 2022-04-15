-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bgxyy6sqdpkwpegiuhsh-mysql.services.clever-cloud.com:3306
-- Generation Time: Apr 15, 2022 at 02:17 AM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bgxyy6sqdpkwpegiuhsh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int NOT NULL,
  `UA_ID` int DEFAULT NULL,
  `NOMBRE_AD` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_AD` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_AD` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_AD` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DIRECCION_AD` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CORREO_AD` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CONTRA_AD` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FOTO_AD` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO` int NOT NULL,
  `PRIVILEGIO` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TIPO` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `UA_ID`, `NOMBRE_AD`, `APELLIDOP_AD`, `APELLIDOM_AD`, `TELEFONO_AD`, `DIRECCION_AD`, `CORREO_AD`, `CONTRA_AD`, `FOTO_AD`, `ESTADO`, `PRIVILEGIO`, `TIPO`) VALUES
(1, 1, 'Robert', 'Sarmiento', 'Sarmiento', NULL, NULL, 'robert@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', NULL, 1, '1', 'Administrador'),
(2, 3, 'Miguel', 'Dolores', 'Dolores', '71000001', 'Cbba-Cercado', 'miguel@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', NULL, 1, '1', 'Administrador'),
(3, 2, 'Miguel', 'Dolores', 'Dolores', '71000006', 'Cbba-Cercado', 'miguel2@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', NULL, 1, '3', 'Administrador'),
(4, 1, 'David', 'Navarro', 'Navarro', '78888881', 'Cbba', 'david@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', NULL, 1, '1', 'Administrador'),
(5, 1, 'Antonio', 'López', 'López', '70000002', 'Cbba', 'antonio@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', NULL, 1, '1', 'Director'),
(12, 3, 'Juan', 'Gomez', 'Gomez', '70000002', '', 'juan@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', NULL, 1, '1', 'Director');

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE `alumno` (
  `ALUMNO_ID` int NOT NULL,
  `UA_ID` int NOT NULL,
  `RUDE_A` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CI_A` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_A` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_A` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_A` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHANAC_A` date NOT NULL,
  `SEXO_A` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `LUGARNAC_A` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CORREO_A` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CONTRA_A` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_A` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION_A` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO_A` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`ALUMNO_ID`, `UA_ID`, `RUDE_A`, `CI_A`, `NOMBRE_A`, `APELLIDOP_A`, `APELLIDOM_A`, `FECHANAC_A`, `SEXO_A`, `LUGARNAC_A`, `CORREO_A`, `CONTRA_A`, `TELEFONO_A`, `DIRECCION_A`, `ESTADO_A`) VALUES
(1, 3, '2005011720', '70000001', 'Carlos', 'Diaz', 'Diaz', '2005-01-17', 'Masculino', 'Cochabamba', 'carlos@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '71000001', 'Av. Dorvigni y Av. Segunda', 0),
(2, 1, '2021110220', '70000002', 'Pilar', 'Sáez', 'Sáez', '2021-11-02', 'Femenino', 'Cochabamba', 'pilar@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '70000002', NULL, 1),
(3, 1, '2007061220', '700002', 'Laura', 'Molina', 'López', '2007-06-13', 'Femenino', 'Cochabamba', 'laura@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '7100003', 'Cbba', 1),
(4, 1, '2008051320', '7000004', 'Rosario', 'Castillo', 'Picazo', '2008-05-13', 'Femenino', 'Cochabamba', 'rosario@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '7000004', NULL, 1),
(5, 1, '2006061520', '7000021', 'María', 'García', 'García', '2006-06-16', 'Femenino', 'Cochabamba', 'maria@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '7000021', NULL, 1),
(6, 2, '2008020220', '12345', 'Damaris', 'Loquez', 'Lopez', '2008-02-02', 'Femenino', 'Cbba', NULL, 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '7000022', NULL, 1),
(7, 3, '2022156052', '70012333', 'Hana', 'Cruz', 'Cruz', '2008-12-23', 'Femenino', 'Cbba', 'hana@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', '781130014', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `anio_academico`
--

CREATE TABLE `anio_academico` (
  `COD_ANIO` int NOT NULL,
  `NOMBRE_ANIO` char(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CREADO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `anio_academico`
--

INSERT INTO `anio_academico` (`COD_ANIO`, `NOMBRE_ANIO`, `CREADO`) VALUES
(1, '2022', '2022-01-01'),
(2, '2021', '2021-11-21'),
(3, '2020', '2021-11-21'),
(4, '2019', '2021-11-21'),
(5, '2018', '2022-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `COD_AREA` int NOT NULL,
  `NOMBRE_AREA` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CAMPO_AREA` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `INFO` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CREADO_AREA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`COD_AREA`, `NOMBRE_AREA`, `CAMPO_AREA`, `INFO`, `CREADO_AREA`) VALUES
(1, 'Matemática', 'Ciencia, Tecnología y Producción', 'Área de matemáticas de la unidad educativa', '2021-11-23'),
(2, 'Artes Plásticas y Visuales', 'Comunidad y Sociedad', 'No hay', '2021-11-23'),
(3, 'Comunicación y Lenguajes Castellana y Originaria', 'Comunidad y Sociedad', NULL, '2021-11-21'),
(4, 'Ciencias Naturales: Química', 'Vida Tierra Territorio', NULL, '2021-11-21'),
(5, 'Ciencias Naturales: Física', 'Vida Tierra Territorio', NULL, '2021-11-21'),
(6, 'Lengua Extranjera', 'Comunidad y Sociedad', 'Área de conocimiento', '2021-11-21'),
(7, 'Educación Física y Deportes', 'Comunidad y Sociedad', NULL, '2021-11-21'),
(8, 'Educación Musical', 'Comunidad y Sociedad', NULL, '2021-11-21'),
(9, 'Valores, Espiritualidad y Religiones', 'Cosmos y Pensamiento', NULL, '2022-02-01'),
(10, 'Técnica Tecnología General', 'Ciencia, Tecnología y Producción', NULL, '2021-11-21'),
(11, 'Ciencias Sociales', 'Comunidad y Sociedad', NULL, '2022-02-01'),
(12, 'Ciencias Naturales Biología - Geografía', 'Vida Tierra Territorio', NULL, '2022-02-01'),
(13, 'Cosmovisiones, Filosofía y Psicología', 'Cosmos y Pensamiento', NULL, '2022-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `calificacion`
--

CREATE TABLE `calificacion` (
  `ALUMNO_ID` int NOT NULL,
  `COD_PER` int NOT NULL,
  `PROFESOR_ID` int NOT NULL,
  `COD_CUR` int NOT NULL,
  `COD_ANIO` int NOT NULL,
  `VAL_ID` int NOT NULL,
  `NOTA` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `calificacion`
--

INSERT INTO `calificacion` (`ALUMNO_ID`, `COD_PER`, `PROFESOR_ID`, `COD_CUR`, `COD_ANIO`, `VAL_ID`, `NOTA`) VALUES
(2, 1, 1, 1, 1, 1, '100'),
(2, 1, 1, 1, 1, 2, '100'),
(2, 1, 1, 1, 1, 3, '100'),
(2, 1, 1, 1, 1, 4, '100'),
(2, 1, 1, 1, 1, 5, '100'),
(2, 1, 1, 1, 1, 6, '100'),
(2, 1, 1, 1, 1, 7, '10'),
(2, 1, 1, 1, 1, 8, '10'),
(2, 1, 1, 1, 1, 9, '5'),
(2, 1, 1, 1, 1, 10, '5'),
(2, 1, 1, 1, 1, 11, '100'),
(2, 2, 1, 1, 1, 1, '70'),
(2, 2, 1, 1, 1, 2, '10'),
(2, 2, 1, 1, 1, 3, '10'),
(2, 2, 1, 1, 1, 4, '10'),
(2, 2, 1, 1, 1, 5, '10'),
(2, 2, 1, 1, 1, 6, '10'),
(2, 2, 1, 1, 1, 7, '10'),
(2, 2, 1, 1, 1, 8, '1'),
(2, 2, 1, 1, 1, 9, '1'),
(2, 2, 1, 1, 1, 10, '1'),
(2, 2, 1, 1, 1, 11, '27'),
(2, 2, 1, 2, 1, 1, '100'),
(2, 2, 1, 2, 1, 2, '100'),
(2, 2, 1, 2, 1, 3, '100'),
(2, 2, 1, 2, 1, 4, '100'),
(2, 2, 1, 2, 1, 5, '100'),
(2, 2, 1, 2, 1, 6, '100'),
(2, 2, 1, 2, 1, 7, '10'),
(2, 2, 1, 2, 1, 8, '5'),
(2, 2, 1, 2, 1, 9, '5'),
(2, 2, 1, 2, 1, 10, '5'),
(2, 2, 1, 2, 1, 11, '95'),
(2, 3, 2, 1, 1, 1, '100'),
(2, 3, 2, 1, 1, 2, '100'),
(2, 3, 2, 1, 1, 3, '100'),
(2, 3, 2, 1, 1, 4, '100'),
(2, 3, 2, 1, 1, 5, '100'),
(2, 3, 2, 1, 1, 6, '100'),
(2, 3, 2, 1, 1, 7, '5'),
(2, 3, 2, 1, 1, 8, '5'),
(2, 3, 2, 1, 1, 9, '5'),
(2, 3, 2, 1, 1, 10, '5'),
(2, 3, 2, 1, 1, 11, '90'),
(3, 2, 1, 2, 1, 1, '100'),
(3, 2, 1, 2, 1, 2, '100'),
(3, 2, 1, 2, 1, 3, '0'),
(3, 2, 1, 2, 1, 4, '0'),
(3, 2, 1, 2, 1, 5, '0'),
(3, 2, 1, 2, 1, 6, '0'),
(3, 2, 1, 2, 1, 7, '0'),
(3, 2, 1, 2, 1, 8, '0'),
(3, 2, 1, 2, 1, 9, '0'),
(3, 2, 1, 2, 1, 10, '0'),
(3, 2, 1, 2, 1, 11, '23'),
(4, 1, 1, 1, 1, 1, '78'),
(4, 1, 1, 1, 1, 2, '80'),
(4, 1, 1, 1, 1, 3, '78'),
(4, 1, 1, 1, 1, 4, '80'),
(4, 1, 1, 1, 1, 5, '87'),
(4, 1, 1, 1, 1, 6, '68'),
(4, 1, 1, 1, 1, 7, '8'),
(4, 1, 1, 1, 1, 8, '7'),
(4, 1, 1, 1, 1, 9, '5'),
(4, 1, 1, 1, 1, 10, '2'),
(4, 1, 1, 1, 1, 11, '77'),
(4, 2, 1, 1, 1, 1, '100'),
(4, 2, 1, 1, 1, 2, '100'),
(4, 2, 1, 1, 1, 3, '100'),
(4, 2, 1, 1, 1, 4, '100'),
(4, 2, 1, 1, 1, 5, '100'),
(4, 2, 1, 1, 1, 6, '100'),
(4, 2, 1, 1, 1, 7, '5'),
(4, 2, 1, 1, 1, 8, '5'),
(4, 2, 1, 1, 1, 9, '5'),
(4, 2, 1, 1, 1, 10, '5'),
(4, 2, 1, 1, 1, 11, '90'),
(4, 3, 2, 1, 1, 1, '0'),
(4, 3, 2, 1, 1, 2, '0'),
(4, 3, 2, 1, 1, 3, '0'),
(4, 3, 2, 1, 1, 4, '0'),
(4, 3, 2, 1, 1, 5, '0'),
(4, 3, 2, 1, 1, 6, '0'),
(4, 3, 2, 1, 1, 7, '0'),
(4, 3, 2, 1, 1, 8, '0'),
(4, 3, 2, 1, 1, 9, '0'),
(4, 3, 2, 1, 1, 10, '0'),
(4, 3, 2, 1, 1, 11, '0'),
(5, 1, 1, 1, 1, 1, '83'),
(5, 1, 1, 1, 1, 2, '100'),
(5, 1, 1, 1, 1, 3, '0'),
(5, 1, 1, 1, 1, 4, '0'),
(5, 1, 1, 1, 1, 5, '0'),
(5, 1, 1, 1, 1, 6, '0'),
(5, 1, 1, 1, 1, 7, '8'),
(5, 1, 1, 1, 1, 8, '8'),
(5, 1, 1, 1, 1, 9, '5'),
(5, 1, 1, 1, 1, 10, '5'),
(5, 1, 1, 1, 1, 11, '47'),
(5, 2, 1, 1, 1, 1, '100'),
(5, 2, 1, 1, 1, 2, '100'),
(5, 2, 1, 1, 1, 3, '50'),
(5, 2, 1, 1, 1, 4, '100'),
(5, 2, 1, 1, 1, 5, '50'),
(5, 2, 1, 1, 1, 6, '54'),
(5, 2, 1, 1, 1, 7, '5'),
(5, 2, 1, 1, 1, 8, '5'),
(5, 2, 1, 1, 1, 9, '1'),
(5, 2, 1, 1, 1, 10, '2'),
(5, 2, 1, 1, 1, 11, '66'),
(5, 2, 1, 2, 1, 1, '0'),
(5, 2, 1, 2, 1, 2, '0'),
(5, 2, 1, 2, 1, 3, '0'),
(5, 2, 1, 2, 1, 4, '0'),
(5, 2, 1, 2, 1, 5, '0'),
(5, 2, 1, 2, 1, 6, '0'),
(5, 2, 1, 2, 1, 7, '0'),
(5, 2, 1, 2, 1, 8, '0'),
(5, 2, 1, 2, 1, 9, '0'),
(5, 2, 1, 2, 1, 10, '0'),
(5, 2, 1, 2, 1, 11, '0'),
(5, 3, 2, 1, 1, 1, '0'),
(5, 3, 2, 1, 1, 2, '0'),
(5, 3, 2, 1, 1, 3, '0'),
(5, 3, 2, 1, 1, 4, '0'),
(5, 3, 2, 1, 1, 5, '0'),
(5, 3, 2, 1, 1, 6, '0'),
(5, 3, 2, 1, 1, 7, '0'),
(5, 3, 2, 1, 1, 8, '0'),
(5, 3, 2, 1, 1, 9, '0'),
(5, 3, 2, 1, 1, 10, '0'),
(5, 3, 2, 1, 1, 11, '0');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `COD_CUR` int NOT NULL,
  `TURNO_CUR` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `GRADO_CUR` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `SECCION_CUR` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CAPACIDAD_CUR` char(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CREADO_CUR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`COD_CUR`, `TURNO_CUR`, `GRADO_CUR`, `SECCION_CUR`, `CAPACIDAD_CUR`, `CREADO_CUR`) VALUES
(1, 'Mañana', 'Primero', 'A', '40', '2022-01-19'),
(2, 'Mañana', 'Primero', 'B', '40', '2022-01-19'),
(3, 'Mañana', 'Primero', 'C', '40', '2022-01-19'),
(4, 'Mañana', 'Segundo', 'A', '40', '2022-01-19'),
(5, 'Mañana', 'Segundo', 'B', '40', '2022-01-19'),
(6, 'Mañana', 'Segundo', 'C', '40', '2022-02-01'),
(7, 'Tarde', 'Primero', 'A', '35', '2022-02-03'),
(8, 'Tarde', 'Primero', 'B', '40', '2022-02-03'),
(9, 'Mañana', 'Tercero', 'A', '40', '2022-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `cur_alum`
--

CREATE TABLE `cur_alum` (
  `COD_CUR` int NOT NULL,
  `ALUMNO_ID` int NOT NULL,
  `FECHA_INI_CA` date NOT NULL,
  `FECHA_FIN_CA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cur_alum`
--

INSERT INTO `cur_alum` (`COD_CUR`, `ALUMNO_ID`, `FECHA_INI_CA`, `FECHA_FIN_CA`) VALUES
(1, 1, '2022-01-01', '2022-12-31'),
(1, 2, '2022-01-01', '2022-12-31'),
(2, 2, '2022-01-01', '2022-12-31'),
(3, 2, '2022-01-01', '2022-12-31'),
(4, 2, '2022-01-01', '2022-12-31'),
(2, 3, '2022-01-01', '2022-12-31'),
(1, 4, '2022-01-01', '2022-11-28'),
(1, 5, '2021-01-01', '2021-12-31'),
(1, 5, '2022-01-01', '2022-12-31'),
(2, 5, '2022-01-01', '2022-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `cur_prof`
--

CREATE TABLE `cur_prof` (
  `COD_CUR` int NOT NULL,
  `PROFESOR_ID` int NOT NULL,
  `RESPONSABLE_CP` int DEFAULT NULL,
  `FECHA_INI_CP` date NOT NULL,
  `FECHA_FIN_CP` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cur_prof`
--

INSERT INTO `cur_prof` (`COD_CUR`, `PROFESOR_ID`, `RESPONSABLE_CP`, `FECHA_INI_CP`, `FECHA_FIN_CP`) VALUES
(1, 1, 1, '2022-02-05', '2022-02-28'),
(1, 2, 0, '2022-02-05', '2022-02-28'),
(1, 3, 0, '2021-02-02', '2021-02-28'),
(2, 1, 0, '2022-02-06', '2022-02-28'),
(2, 2, 1, '2022-02-09', '2022-02-28'),
(2, 3, 0, '2020-02-10', '2020-02-28'),
(2, 3, 0, '2022-02-10', '2022-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `familiar`
--

CREATE TABLE `familiar` (
  `FAMILAR_ID` int NOT NULL,
  `CI_FA` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_FA` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_FA` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_FA` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHANAC_FA` date NOT NULL,
  `SEXO_FA` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_FA` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CONTRA_FA` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CORREO_FA` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ROL_FA` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO_FA` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `familiar`
--

INSERT INTO `familiar` (`FAMILAR_ID`, `CI_FA`, `NOMBRE_FA`, `APELLIDOP_FA`, `APELLIDOM_FA`, `FECHANAC_FA`, `SEXO_FA`, `TELEFONO_FA`, `CONTRA_FA`, `CORREO_FA`, `ROL_FA`, `ESTADO_FA`) VALUES
(1, '7000644', 'Pablo', 'Molina', 'Alfaro', '1980-11-03', 'Masculino', '70001124', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 'pablo@gmail.com', 'Padre', 1),
(2, '7000142', 'Cristina', 'López', 'Saez', '1982-06-11', 'Femenino', '7000142', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 'cristina@gmail.com', 'Madre', 1),
(3, '44000440', 'Ramon', 'Alfaro', 'Alfaro', '2022-01-18', 'Masculino', '70000447', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 'ramon@gmail.com', 'Padre', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fa_alumno`
--

CREATE TABLE `fa_alumno` (
  `FAMILAR_ID` int NOT NULL,
  `ALUMNO_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `fa_alumno`
--

INSERT INTO `fa_alumno` (`FAMILAR_ID`, `ALUMNO_ID`) VALUES
(2, 3),
(3, 3),
(2, 4),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `periodo`
--

CREATE TABLE `periodo` (
  `COD_PER` int NOT NULL,
  `NOMBRE_PER` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CREADO_PER` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `periodo`
--

INSERT INTO `periodo` (`COD_PER`, `NOMBRE_PER`, `CREADO_PER`) VALUES
(1, 'Primer Trimestre', '2021-11-21'),
(2, 'Segundo Trimestre', '2021-11-21'),
(3, 'Tercer Trimestre', '2021-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE `profesor` (
  `PROFESOR_ID` int NOT NULL,
  `COD_AREA` int NOT NULL,
  `UA_ID` int NOT NULL,
  `CI_P` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_P` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_P` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_P` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHANAC_P` date NOT NULL,
  `SEXO_P` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_INGRESO_P` date NOT NULL,
  `FOTO_P` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CORREO_P` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CONTRA_P` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO_P` int NOT NULL,
  `TELEFONO_P` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION_P` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`PROFESOR_ID`, `COD_AREA`, `UA_ID`, `CI_P`, `NOMBRE_P`, `APELLIDOP_P`, `APELLIDOM_P`, `FECHANAC_P`, `SEXO_P`, `FECHA_INGRESO_P`, `FOTO_P`, `CORREO_P`, `CONTRA_P`, `ESTADO_P`, `TELEFONO_P`, `DIRECCION_P`) VALUES
(1, 5, 1, '7000001', 'Isabel', 'Fernandez', 'Lopez', '1990-09-19', 'Femenino', '2018-07-20', NULL, 'isabel@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '78600010', 'Cochabamba.Av. Blanco Galindo. km 7.5'),
(2, 2, 1, '7000002', 'Roger', 'Fernandez', 'Salmon', '1989-09-19', 'Masculino', '2017-07-20', NULL, 'roger@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '78600010', 'Cochabamba,Víctor Ustariz'),
(3, 6, 1, '8000001', 'Joaquin', 'Castillo', 'Castillo', '1991-06-18', 'Masculino', '2016-01-06', NULL, 'joaquin@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '8000001', NULL),
(4, 10, 3, '7066113', 'Silvia', 'Marg', 'Marg', '1994-02-12', 'Femenino', '2022-02-09', NULL, 'silvia@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '70666122', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unidad_academico`
--

CREATE TABLE `unidad_academico` (
  `UA_ID` int NOT NULL,
  `COD_UA` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_UA` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION_UA` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DESCRIPCION_UA` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DISTRITO_UA` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `LOCALIDAD_UA` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DPTO_UA` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DEPENDENCIA_UA` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO_UA` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `unidad_academico`
--

INSERT INTO `unidad_academico` (`UA_ID`, `COD_UA`, `NOMBRE_UA`, `DIRECCION_UA`, `DESCRIPCION_UA`, `DISTRITO_UA`, `LOCALIDAD_UA`, `DPTO_UA`, `DEPENDENCIA_UA`, `ESTADO_UA`) VALUES
(1, 'UE0001', '6 de Agosto', 'Av. Panamericana', NULL, 'Quillacollo', 'Quillacollo - Ciudad Quillacollo', 'Cochabamba', 'Fiscal', 1),
(2, 'EU0002', 'Heroinas', 'Ayacucho', NULL, NULL, NULL, 'Cochabamba', 'Fiscal', 1),
(3, 'UE0003', 'San Martín de Porres', 'Quillacollo, 1ro de mayo', NULL, NULL, NULL, 'Cochabamba', 'Fiscal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `valoracion`
--

CREATE TABLE `valoracion` (
  `VAL_ID` int NOT NULL,
  `CRITERIO_VAL` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `USUARIO_VAL` char(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `valoracion`
--

INSERT INTO `valoracion` (`VAL_ID`, `CRITERIO_VAL`, `USUARIO_VAL`) VALUES
(1, '1er Parcial', 'Docente'),
(2, '2do Parcial', 'Docente'),
(3, '3er Parcial', 'Docente'),
(4, 'Actividad 1', 'Docente'),
(5, 'Actividad 2', 'Docente'),
(6, 'Actividad 3', 'Docente'),
(7, 'Ser', 'Docente'),
(8, 'Decir', 'Docente'),
(9, 'Ser', 'Alumno'),
(10, 'Decir', 'Alumno'),
(11, 'Promedio', 'Alumno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD KEY `FK_UA_ADMIN` (`UA_ID`);

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ALUMNO_ID`),
  ADD KEY `FK_UA_ALUM` (`UA_ID`);

--
-- Indexes for table `anio_academico`
--
ALTER TABLE `anio_academico`
  ADD PRIMARY KEY (`COD_ANIO`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`COD_AREA`);

--
-- Indexes for table `calificacion`
--
ALTER TABLE `calificacion`
  ADD UNIQUE KEY `ALUMNO_ID` (`ALUMNO_ID`,`COD_PER`,`PROFESOR_ID`,`COD_CUR`,`COD_ANIO`,`VAL_ID`),
  ADD KEY `FK_ALUM_CAL` (`ALUMNO_ID`),
  ADD KEY `FK_ANIOACA_CAL` (`COD_ANIO`),
  ADD KEY `FK_CUR_CAL` (`COD_CUR`),
  ADD KEY `FK_PER_CAL` (`COD_PER`),
  ADD KEY `FK_PROF_CAL` (`PROFESOR_ID`),
  ADD KEY `FK_VAL_CAL` (`VAL_ID`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`COD_CUR`);

--
-- Indexes for table `cur_alum`
--
ALTER TABLE `cur_alum`
  ADD PRIMARY KEY (`COD_CUR`,`ALUMNO_ID`,`FECHA_INI_CA`,`FECHA_FIN_CA`) USING BTREE,
  ADD KEY `FK_CUR_ALUM2` (`ALUMNO_ID`);

--
-- Indexes for table `cur_prof`
--
ALTER TABLE `cur_prof`
  ADD PRIMARY KEY (`COD_CUR`,`PROFESOR_ID`,`FECHA_INI_CP`,`FECHA_FIN_CP`) USING BTREE,
  ADD KEY `FK_CUR_PROF2` (`PROFESOR_ID`);

--
-- Indexes for table `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`FAMILAR_ID`);

--
-- Indexes for table `fa_alumno`
--
ALTER TABLE `fa_alumno`
  ADD PRIMARY KEY (`FAMILAR_ID`,`ALUMNO_ID`),
  ADD KEY `FK_FA_ALUMNO2` (`ALUMNO_ID`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`COD_PER`);

--
-- Indexes for table `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`PROFESOR_ID`),
  ADD KEY `FK_PROF_AREA` (`COD_AREA`),
  ADD KEY `FK_UA_PROF` (`UA_ID`);

--
-- Indexes for table `unidad_academico`
--
ALTER TABLE `unidad_academico`
  ADD PRIMARY KEY (`UA_ID`);

--
-- Indexes for table `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`VAL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ALUMNO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `anio_academico`
--
ALTER TABLE `anio_academico`
  MODIFY `COD_ANIO` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `COD_AREA` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `COD_CUR` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `familiar`
--
ALTER TABLE `familiar`
  MODIFY `FAMILAR_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `COD_PER` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profesor`
--
ALTER TABLE `profesor`
  MODIFY `PROFESOR_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unidad_academico`
--
ALTER TABLE `unidad_academico`
  MODIFY `UA_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `VAL_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_UA_ADMIN` FOREIGN KEY (`UA_ID`) REFERENCES `unidad_academico` (`UA_ID`);

--
-- Constraints for table `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_UA_ALUM` FOREIGN KEY (`UA_ID`) REFERENCES `unidad_academico` (`UA_ID`);

--
-- Constraints for table `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `FK_ALUM_CAL` FOREIGN KEY (`ALUMNO_ID`) REFERENCES `alumno` (`ALUMNO_ID`),
  ADD CONSTRAINT `FK_ANIOACA_CAL` FOREIGN KEY (`COD_ANIO`) REFERENCES `anio_academico` (`COD_ANIO`),
  ADD CONSTRAINT `FK_CUR_CAL` FOREIGN KEY (`COD_CUR`) REFERENCES `curso` (`COD_CUR`),
  ADD CONSTRAINT `FK_PER_CAL` FOREIGN KEY (`COD_PER`) REFERENCES `periodo` (`COD_PER`),
  ADD CONSTRAINT `FK_PROF_CAL` FOREIGN KEY (`PROFESOR_ID`) REFERENCES `profesor` (`PROFESOR_ID`),
  ADD CONSTRAINT `FK_VAL_CAL` FOREIGN KEY (`VAL_ID`) REFERENCES `valoracion` (`VAL_ID`);

--
-- Constraints for table `cur_alum`
--
ALTER TABLE `cur_alum`
  ADD CONSTRAINT `FK_CUR_ALUM` FOREIGN KEY (`COD_CUR`) REFERENCES `curso` (`COD_CUR`),
  ADD CONSTRAINT `FK_CUR_ALUM2` FOREIGN KEY (`ALUMNO_ID`) REFERENCES `alumno` (`ALUMNO_ID`);

--
-- Constraints for table `cur_prof`
--
ALTER TABLE `cur_prof`
  ADD CONSTRAINT `FK_CUR_PROF` FOREIGN KEY (`COD_CUR`) REFERENCES `curso` (`COD_CUR`),
  ADD CONSTRAINT `FK_CUR_PROF2` FOREIGN KEY (`PROFESOR_ID`) REFERENCES `profesor` (`PROFESOR_ID`);

--
-- Constraints for table `fa_alumno`
--
ALTER TABLE `fa_alumno`
  ADD CONSTRAINT `FK_FA_ALUMNO` FOREIGN KEY (`FAMILAR_ID`) REFERENCES `familiar` (`FAMILAR_ID`),
  ADD CONSTRAINT `FK_FA_ALUMNO2` FOREIGN KEY (`ALUMNO_ID`) REFERENCES `alumno` (`ALUMNO_ID`);

--
-- Constraints for table `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `FK_PROF_AREA` FOREIGN KEY (`COD_AREA`) REFERENCES `area` (`COD_AREA`),
  ADD CONSTRAINT `FK_UA_PROF` FOREIGN KEY (`UA_ID`) REFERENCES `unidad_academico` (`UA_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
