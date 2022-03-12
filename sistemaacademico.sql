-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2022 a las 05:45:43
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaacademico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `UA_ID` int(11) DEFAULT NULL,
  `NOMBRE_AD` char(30) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_AD` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_AD` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_AD` char(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DIRECCION_AD` char(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CORREO_AD` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `CONTRA_AD` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `FOTO_AD` char(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO` int(11) NOT NULL,
  `PRIVILEGIO` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `TIPO` char(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admin`
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
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ALUMNO_ID` int(11) NOT NULL,
  `UA_ID` int(11) NOT NULL,
  `RUDE_A` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `CI_A` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_A` char(30) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_A` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_A` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHANAC_A` date NOT NULL,
  `SEXO_A` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `LUGARNAC_A` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `CORREO_A` char(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CONTRA_A` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_A` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION_A` char(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO_A` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
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
-- Estructura de tabla para la tabla `anio_academico`
--

CREATE TABLE `anio_academico` (
  `COD_ANIO` int(11) NOT NULL,
  `NOMBRE_ANIO` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `CREADO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anio_academico`
--

INSERT INTO `anio_academico` (`COD_ANIO`, `NOMBRE_ANIO`, `CREADO`) VALUES
(1, '2022', '2022-01-01'),
(2, '2021', '2021-11-21'),
(3, '2020', '2021-11-21'),
(4, '2019', '2021-11-21'),
(5, '2018', '2022-02-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `COD_AREA` int(11) NOT NULL,
  `NOMBRE_AREA` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `CAMPO_AREA` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `INFO` char(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CREADO_AREA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `area`
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
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `COD_CALI` int(11) NOT NULL,
  `ALUMNO_ID` int(11) NOT NULL,
  `COD_PER` int(11) NOT NULL,
  `PROFESOR_ID` int(11) NOT NULL,
  `COD_CUR` int(11) NOT NULL,
  `COD_ANIO` int(11) NOT NULL,
  `VAL_ID` int(11) NOT NULL,
  `NOTA` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`COD_CALI`, `ALUMNO_ID`, `COD_PER`, `PROFESOR_ID`, `COD_CUR`, `COD_ANIO`, `VAL_ID`, `NOTA`) VALUES
(1, 2, 1, 1, 1, 1, 1, '100'),
(2, 2, 1, 1, 1, 1, 2, '100'),
(3, 2, 1, 1, 1, 1, 3, '100'),
(4, 2, 1, 1, 1, 1, 4, '100'),
(5, 2, 1, 1, 1, 1, 5, '100'),
(6, 2, 1, 1, 1, 1, 6, '100'),
(7, 2, 1, 1, 1, 1, 7, '10'),
(8, 2, 1, 1, 1, 1, 8, '10'),
(9, 2, 1, 1, 1, 1, 9, '5'),
(10, 2, 1, 1, 1, 1, 10, '5'),
(11, 2, 1, 1, 1, 1, 11, '100'),
(12, 4, 1, 1, 1, 1, 1, '78'),
(13, 4, 1, 1, 1, 1, 2, '8'),
(14, 4, 1, 1, 1, 1, 3, '78'),
(15, 4, 1, 1, 1, 1, 4, '80'),
(16, 4, 1, 1, 1, 1, 5, '87'),
(17, 4, 1, 1, 1, 1, 6, '68'),
(18, 4, 1, 1, 1, 1, 7, '8'),
(19, 4, 1, 1, 1, 1, 8, '7'),
(20, 4, 1, 1, 1, 1, 9, '5'),
(21, 4, 1, 1, 1, 1, 10, '2'),
(22, 4, 1, 1, 1, 1, 11, '69'),
(23, 5, 1, 1, 1, 1, 1, '83'),
(24, 5, 1, 1, 1, 1, 2, '100'),
(25, 5, 1, 1, 1, 1, 3, '0'),
(26, 5, 1, 1, 1, 1, 4, '0'),
(27, 5, 1, 1, 1, 1, 5, '0'),
(28, 5, 1, 1, 1, 1, 6, '0'),
(29, 5, 1, 1, 1, 1, 7, '8'),
(30, 5, 1, 1, 1, 1, 8, '8'),
(31, 5, 1, 1, 1, 1, 9, '5'),
(32, 5, 1, 1, 1, 1, 10, '5'),
(33, 5, 1, 1, 1, 1, 11, '47'),
(34, 2, 2, 1, 1, 1, 1, '70'),
(35, 2, 2, 1, 1, 1, 2, '10'),
(36, 2, 2, 1, 1, 1, 3, '10'),
(37, 2, 2, 1, 1, 1, 4, '10'),
(38, 2, 2, 1, 1, 1, 5, '10'),
(39, 2, 2, 1, 1, 1, 6, '10'),
(40, 2, 2, 1, 1, 1, 7, '10'),
(41, 2, 2, 1, 1, 1, 8, '1'),
(42, 2, 2, 1, 1, 1, 9, '1'),
(43, 2, 2, 1, 1, 1, 10, '1'),
(44, 2, 2, 1, 1, 1, 11, '27'),
(45, 4, 2, 1, 1, 1, 1, '100'),
(46, 4, 2, 1, 1, 1, 2, '100'),
(47, 4, 2, 1, 1, 1, 3, '100'),
(48, 4, 2, 1, 1, 1, 4, '100'),
(49, 4, 2, 1, 1, 1, 5, '100'),
(50, 4, 2, 1, 1, 1, 6, '100'),
(51, 4, 2, 1, 1, 1, 7, '5'),
(52, 4, 2, 1, 1, 1, 8, '5'),
(53, 4, 2, 1, 1, 1, 9, '5'),
(54, 4, 2, 1, 1, 1, 10, '5'),
(55, 4, 2, 1, 1, 1, 11, '90'),
(56, 5, 2, 1, 1, 1, 1, '100'),
(57, 5, 2, 1, 1, 1, 2, '100'),
(58, 5, 2, 1, 1, 1, 3, '50'),
(59, 5, 2, 1, 1, 1, 4, '100'),
(60, 5, 2, 1, 1, 1, 5, '50'),
(61, 5, 2, 1, 1, 1, 6, '54'),
(62, 5, 2, 1, 1, 1, 7, '5'),
(63, 5, 2, 1, 1, 1, 8, '5'),
(64, 5, 2, 1, 1, 1, 9, '1'),
(65, 5, 2, 1, 1, 1, 10, '2'),
(66, 5, 2, 1, 1, 1, 11, '66'),
(67, 2, 2, 1, 2, 1, 1, '100'),
(68, 2, 2, 1, 2, 1, 2, '100'),
(69, 2, 2, 1, 2, 1, 3, '100'),
(70, 2, 2, 1, 2, 1, 4, '100'),
(71, 2, 2, 1, 2, 1, 5, '100'),
(72, 2, 2, 1, 2, 1, 6, '100'),
(73, 2, 2, 1, 2, 1, 7, '10'),
(74, 2, 2, 1, 2, 1, 8, '5'),
(75, 2, 2, 1, 2, 1, 9, '5'),
(76, 2, 2, 1, 2, 1, 10, '5'),
(77, 2, 2, 1, 2, 1, 11, '95'),
(78, 3, 2, 1, 2, 1, 1, '0'),
(79, 3, 2, 1, 2, 1, 2, '0'),
(80, 3, 2, 1, 2, 1, 3, '0'),
(81, 3, 2, 1, 2, 1, 4, '0'),
(82, 3, 2, 1, 2, 1, 5, '0'),
(83, 3, 2, 1, 2, 1, 6, '0'),
(84, 3, 2, 1, 2, 1, 7, '0'),
(85, 3, 2, 1, 2, 1, 8, '0'),
(86, 3, 2, 1, 2, 1, 9, '0'),
(87, 3, 2, 1, 2, 1, 10, '0'),
(88, 3, 2, 1, 2, 1, 11, '0'),
(89, 5, 2, 1, 2, 1, 1, '0'),
(90, 5, 2, 1, 2, 1, 2, '0'),
(91, 5, 2, 1, 2, 1, 3, '0'),
(92, 5, 2, 1, 2, 1, 4, '0'),
(93, 5, 2, 1, 2, 1, 5, '0'),
(94, 5, 2, 1, 2, 1, 6, '0'),
(95, 5, 2, 1, 2, 1, 7, '0'),
(96, 5, 2, 1, 2, 1, 8, '0'),
(97, 5, 2, 1, 2, 1, 9, '0'),
(98, 5, 2, 1, 2, 1, 10, '0'),
(99, 5, 2, 1, 2, 1, 11, '0'),
(100, 2, 3, 2, 1, 1, 1, '100'),
(101, 2, 3, 2, 1, 1, 2, '100'),
(102, 2, 3, 2, 1, 1, 3, '100'),
(103, 2, 3, 2, 1, 1, 4, '100'),
(104, 2, 3, 2, 1, 1, 5, '100'),
(105, 2, 3, 2, 1, 1, 6, '100'),
(106, 2, 3, 2, 1, 1, 7, '5'),
(107, 2, 3, 2, 1, 1, 8, '5'),
(108, 2, 3, 2, 1, 1, 9, '5'),
(109, 2, 3, 2, 1, 1, 10, '5'),
(110, 2, 3, 2, 1, 1, 11, '90'),
(111, 4, 3, 2, 1, 1, 1, '0'),
(112, 4, 3, 2, 1, 1, 2, '0'),
(113, 4, 3, 2, 1, 1, 3, '0'),
(114, 4, 3, 2, 1, 1, 4, '0'),
(115, 4, 3, 2, 1, 1, 5, '0'),
(116, 4, 3, 2, 1, 1, 6, '0'),
(117, 4, 3, 2, 1, 1, 7, '0'),
(118, 4, 3, 2, 1, 1, 8, '0'),
(119, 4, 3, 2, 1, 1, 9, '0'),
(120, 4, 3, 2, 1, 1, 10, '0'),
(121, 4, 3, 2, 1, 1, 11, '0'),
(122, 5, 3, 2, 1, 1, 1, '0'),
(123, 5, 3, 2, 1, 1, 2, '0'),
(124, 5, 3, 2, 1, 1, 3, '0'),
(125, 5, 3, 2, 1, 1, 4, '0'),
(126, 5, 3, 2, 1, 1, 5, '0'),
(127, 5, 3, 2, 1, 1, 6, '0'),
(128, 5, 3, 2, 1, 1, 7, '0'),
(129, 5, 3, 2, 1, 1, 8, '0'),
(130, 5, 3, 2, 1, 1, 9, '0'),
(131, 5, 3, 2, 1, 1, 10, '0'),
(132, 5, 3, 2, 1, 1, 11, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `COD_CUR` int(11) NOT NULL,
  `TURNO_CUR` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `GRADO_CUR` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `SECCION_CUR` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `CAPACIDAD_CUR` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `CREADO_CUR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curso`
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
-- Estructura de tabla para la tabla `cur_alum`
--

CREATE TABLE `cur_alum` (
  `COD_CUR` int(11) NOT NULL,
  `ALUMNO_ID` int(11) NOT NULL,
  `FECHA_INI_CA` date NOT NULL,
  `FECHA_FIN_CA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cur_alum`
--

INSERT INTO `cur_alum` (`COD_CUR`, `ALUMNO_ID`, `FECHA_INI_CA`, `FECHA_FIN_CA`) VALUES
(1, 1, '2022-01-01', '2022-12-31'),
(1, 2, '2022-01-01', '2022-12-31'),
(1, 4, '2022-01-01', '2022-11-28'),
(1, 5, '2021-01-01', '2021-12-31'),
(1, 5, '2022-01-01', '2022-12-31'),
(2, 2, '2022-01-01', '2022-12-31'),
(2, 3, '2022-01-01', '2022-12-31'),
(2, 5, '2022-01-01', '2022-12-31'),
(3, 2, '2022-01-01', '2022-12-31'),
(4, 2, '2022-01-01', '2022-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cur_prof`
--

CREATE TABLE `cur_prof` (
  `COD_CUR` int(11) NOT NULL,
  `PROFESOR_ID` int(11) NOT NULL,
  `RESPONSABLE_CP` int(11) DEFAULT NULL,
  `FECHA_INI_CP` date NOT NULL,
  `FECHA_FIN_CP` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cur_prof`
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
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `FAMILAR_ID` int(11) NOT NULL,
  `CI_FA` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_FA` char(30) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_FA` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_FA` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHANAC_FA` date NOT NULL,
  `SEXO_FA` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_FA` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `CONTRA_FA` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `CORREO_FA` char(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ROL_FA` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO_FA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `familiar`
--

INSERT INTO `familiar` (`FAMILAR_ID`, `CI_FA`, `NOMBRE_FA`, `APELLIDOP_FA`, `APELLIDOM_FA`, `FECHANAC_FA`, `SEXO_FA`, `TELEFONO_FA`, `CONTRA_FA`, `CORREO_FA`, `ROL_FA`, `ESTADO_FA`) VALUES
(1, '7000644', 'Pablo', 'Molina', 'Alfaro', '1980-11-03', 'Masculino', '70001124', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 'pablo@gmail.com', 'Padre', 1),
(2, '7000142', 'Cristina', 'López', 'Saez', '1982-06-11', 'Femenino', '7000142', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 'cristina@gmail.com', 'Madre', 1),
(3, '44000440', 'Ramon', 'Alfaro', 'Alfaro', '2022-01-18', 'Masculino', '70000447', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 'ramon@gmail.com', 'Padre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fa_alumno`
--

CREATE TABLE `fa_alumno` (
  `FAMILAR_ID` int(11) NOT NULL,
  `ALUMNO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fa_alumno`
--

INSERT INTO `fa_alumno` (`FAMILAR_ID`, `ALUMNO_ID`) VALUES
(2, 3),
(2, 4),
(3, 3),
(3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `COD_PER` int(11) NOT NULL,
  `NOMBRE_PER` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `CREADO_PER` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`COD_PER`, `NOMBRE_PER`, `CREADO_PER`) VALUES
(1, 'Primer Trimestre', '2021-11-21'),
(2, 'Segundo Trimestre', '2021-11-21'),
(3, 'Tercer Trimestre', '2021-11-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `PROFESOR_ID` int(11) NOT NULL,
  `COD_AREA` int(11) NOT NULL,
  `UA_ID` int(11) NOT NULL,
  `CI_P` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_P` char(30) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOP_P` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_P` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `FECHANAC_P` date NOT NULL,
  `SEXO_P` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_INGRESO_P` date NOT NULL,
  `FOTO_P` char(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CORREO_P` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `CONTRA_P` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO_P` int(11) NOT NULL,
  `TELEFONO_P` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION_P` char(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`PROFESOR_ID`, `COD_AREA`, `UA_ID`, `CI_P`, `NOMBRE_P`, `APELLIDOP_P`, `APELLIDOM_P`, `FECHANAC_P`, `SEXO_P`, `FECHA_INGRESO_P`, `FOTO_P`, `CORREO_P`, `CONTRA_P`, `ESTADO_P`, `TELEFONO_P`, `DIRECCION_P`) VALUES
(1, 5, 1, '7000001', 'Isabel', 'Fernandez', 'Lopez', '1990-09-19', 'Femenino', '2018-07-20', NULL, 'isabel@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '78600010', 'Cochabamba.Av. Blanco Galindo. km 7.5'),
(2, 2, 1, '7000002', 'Roger', 'Fernandez', 'Salmon', '1989-09-19', 'Masculino', '2017-07-20', NULL, 'roger@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '78600010', 'Cochabamba,Víctor Ustariz'),
(3, 6, 1, '8000001', 'Joaquin', 'Castillo', 'Castillo', '1991-06-18', 'Masculino', '2016-01-06', NULL, 'joaquin@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '8000001', NULL),
(4, 10, 3, '7066113', 'Silvia', 'Marg', 'Marg', '1994-02-12', 'Femenino', '2022-02-09', NULL, 'silvia@gmail.com', 'M1J1YndGd3Zjc1Jyb3BlUjNyS0ZZUT09', 1, '70666122', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_academico`
--

CREATE TABLE `unidad_academico` (
  `UA_ID` int(11) NOT NULL,
  `COD_UA` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_UA` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION_UA` char(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DESCRIPCION_UA` char(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DISTRITO_UA` char(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `LOCALIDAD_UA` char(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DPTO_UA` char(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DEPENDENCIA_UA` char(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO_UA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `unidad_academico`
--

INSERT INTO `unidad_academico` (`UA_ID`, `COD_UA`, `NOMBRE_UA`, `DIRECCION_UA`, `DESCRIPCION_UA`, `DISTRITO_UA`, `LOCALIDAD_UA`, `DPTO_UA`, `DEPENDENCIA_UA`, `ESTADO_UA`) VALUES
(1, 'UE0001', '6 de Agosto', 'Av. Panamericana', NULL, 'Quillacollo', 'Quillacollo - Ciudad Quillacollo', 'Cochabamba', 'Fiscal', 1),
(2, 'EU0002', 'Heroinas', 'Ayacucho', NULL, NULL, NULL, 'Cochabamba', 'Fiscal', 1),
(3, 'UE0003', 'San Martín de Porres', 'Quillacollo, 1ro de mayo', NULL, NULL, NULL, 'Cochabamba', 'Fiscal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `VAL_ID` int(11) NOT NULL,
  `CRITERIO_VAL` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `USUARIO_VAL` char(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `valoracion`
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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD KEY `FK_UA_ADMIN` (`UA_ID`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ALUMNO_ID`),
  ADD KEY `FK_UA_ALUM` (`UA_ID`);

--
-- Indices de la tabla `anio_academico`
--
ALTER TABLE `anio_academico`
  ADD PRIMARY KEY (`COD_ANIO`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`COD_AREA`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`COD_CALI`),
  ADD KEY `FK_ALUM_CAL` (`ALUMNO_ID`),
  ADD KEY `FK_ANIOACA_CAL` (`COD_ANIO`),
  ADD KEY `FK_CUR_CAL` (`COD_CUR`),
  ADD KEY `FK_PER_CAL` (`COD_PER`),
  ADD KEY `FK_PROF_CAL` (`PROFESOR_ID`),
  ADD KEY `FK_VAL_CAL` (`VAL_ID`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`COD_CUR`);

--
-- Indices de la tabla `cur_alum`
--
ALTER TABLE `cur_alum`
  ADD PRIMARY KEY (`COD_CUR`,`ALUMNO_ID`,`FECHA_INI_CA`,`FECHA_FIN_CA`) USING BTREE,
  ADD KEY `FK_CUR_ALUM2` (`ALUMNO_ID`);

--
-- Indices de la tabla `cur_prof`
--
ALTER TABLE `cur_prof`
  ADD PRIMARY KEY (`COD_CUR`,`PROFESOR_ID`,`FECHA_INI_CP`,`FECHA_FIN_CP`) USING BTREE,
  ADD KEY `FK_CUR_PROF2` (`PROFESOR_ID`);

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`FAMILAR_ID`);

--
-- Indices de la tabla `fa_alumno`
--
ALTER TABLE `fa_alumno`
  ADD PRIMARY KEY (`FAMILAR_ID`,`ALUMNO_ID`),
  ADD KEY `FK_FA_ALUMNO2` (`ALUMNO_ID`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`COD_PER`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`PROFESOR_ID`),
  ADD KEY `FK_PROF_AREA` (`COD_AREA`),
  ADD KEY `FK_UA_PROF` (`UA_ID`);

--
-- Indices de la tabla `unidad_academico`
--
ALTER TABLE `unidad_academico`
  ADD PRIMARY KEY (`UA_ID`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`VAL_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ALUMNO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `anio_academico`
--
ALTER TABLE `anio_academico`
  MODIFY `COD_ANIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `COD_AREA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `COD_CALI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `COD_CUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `familiar`
--
ALTER TABLE `familiar`
  MODIFY `FAMILAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `COD_PER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `PROFESOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidad_academico`
--
ALTER TABLE `unidad_academico`
  MODIFY `UA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `VAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_UA_ADMIN` FOREIGN KEY (`UA_ID`) REFERENCES `unidad_academico` (`UA_ID`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_UA_ALUM` FOREIGN KEY (`UA_ID`) REFERENCES `unidad_academico` (`UA_ID`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `FK_ALUM_CAL` FOREIGN KEY (`ALUMNO_ID`) REFERENCES `alumno` (`ALUMNO_ID`),
  ADD CONSTRAINT `FK_ANIOACA_CAL` FOREIGN KEY (`COD_ANIO`) REFERENCES `anio_academico` (`COD_ANIO`),
  ADD CONSTRAINT `FK_CUR_CAL` FOREIGN KEY (`COD_CUR`) REFERENCES `curso` (`COD_CUR`),
  ADD CONSTRAINT `FK_PER_CAL` FOREIGN KEY (`COD_PER`) REFERENCES `periodo` (`COD_PER`),
  ADD CONSTRAINT `FK_PROF_CAL` FOREIGN KEY (`PROFESOR_ID`) REFERENCES `profesor` (`PROFESOR_ID`),
  ADD CONSTRAINT `FK_VAL_CAL` FOREIGN KEY (`VAL_ID`) REFERENCES `valoracion` (`VAL_ID`);

--
-- Filtros para la tabla `cur_alum`
--
ALTER TABLE `cur_alum`
  ADD CONSTRAINT `FK_CUR_ALUM` FOREIGN KEY (`COD_CUR`) REFERENCES `curso` (`COD_CUR`),
  ADD CONSTRAINT `FK_CUR_ALUM2` FOREIGN KEY (`ALUMNO_ID`) REFERENCES `alumno` (`ALUMNO_ID`);

--
-- Filtros para la tabla `cur_prof`
--
ALTER TABLE `cur_prof`
  ADD CONSTRAINT `FK_CUR_PROF` FOREIGN KEY (`COD_CUR`) REFERENCES `curso` (`COD_CUR`),
  ADD CONSTRAINT `FK_CUR_PROF2` FOREIGN KEY (`PROFESOR_ID`) REFERENCES `profesor` (`PROFESOR_ID`);

--
-- Filtros para la tabla `fa_alumno`
--
ALTER TABLE `fa_alumno`
  ADD CONSTRAINT `FK_FA_ALUMNO` FOREIGN KEY (`FAMILAR_ID`) REFERENCES `familiar` (`FAMILAR_ID`),
  ADD CONSTRAINT `FK_FA_ALUMNO2` FOREIGN KEY (`ALUMNO_ID`) REFERENCES `alumno` (`ALUMNO_ID`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `FK_PROF_AREA` FOREIGN KEY (`COD_AREA`) REFERENCES `area` (`COD_AREA`),
  ADD CONSTRAINT `FK_UA_PROF` FOREIGN KEY (`UA_ID`) REFERENCES `unidad_academico` (`UA_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;