-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-03-2016 a las 16:46:24
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siga`
--
CREATE DATABASE IF NOT EXISTS `siga` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `siga`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificados`
--

DROP TABLE IF EXISTS `certificados`;
CREATE TABLE IF NOT EXISTS `certificados` (
  `id` int(180) NOT NULL,
  `curso` int(11) NOT NULL DEFAULT '0',
  `cedula` varchar(12) COLLATE latin1_spanish_ci DEFAULT NULL,
  `F_inicio` date DEFAULT NULL,
  `F_culmi` date DEFAULT NULL,
  `duracion` int(5) DEFAULT NULL,
  `num_registro` int(10) NOT NULL,
  `folio` int(10) NOT NULL,
  `libro` int(10) NOT NULL,
  `periodo` varchar(7) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `certificados`:
--   `curso`
--       `cursos` -> `id`
--   `F_culmi`
--       `cursos` -> `F_culmi`
--   `F_inicio`
--       `cursos` -> `F_inicio`
--   `duracion`
--       `cursos` -> `duracion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL,
  `nom_curso` varchar(180) COLLATE latin1_spanish_ci NOT NULL,
  `F_inicio` date DEFAULT NULL,
  `F_culmi` date DEFAULT NULL,
  `periodo` varchar(7) COLLATE latin1_spanish_ci NOT NULL,
  `duracion` int(5) DEFAULT NULL,
  `ubicacion` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nucleo` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `facilitador` varchar(12) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `cursos`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

DROP TABLE IF EXISTS `docentes`;
CREATE TABLE IF NOT EXISTS `docentes` (
  `cedula` varchar(11) NOT NULL,
  `nombre` varchar(180) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `tlf` varchar(12) NOT NULL,
  `especialidad` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `docentes`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `cedula` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(180) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(180) COLLATE latin1_spanish_ci NOT NULL,
  `especialidad` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `telf1` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `tlf2` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `curso` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `estudiantes`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE IF NOT EXISTS `inscripcion` (
  `cedula` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `curso` int(11) NOT NULL,
  `periodo` varchar(7) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `inscripcion`:
--   `cedula`
--       `estudiantes` -> `cedula`
--   `curso`
--       `cursos` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `cedula` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `curso` varchar(180) COLLATE latin1_spanish_ci NOT NULL,
  `periodo` varchar(7) COLLATE latin1_spanish_ci NOT NULL,
  `nota1` int(2) DEFAULT NULL,
  `nota2` int(2) DEFAULT NULL,
  `nota3` int(2) DEFAULT NULL,
  `nota4` int(2) DEFAULT NULL,
  `nota5` int(2) DEFAULT NULL,
  `nota6` int(2) DEFAULT NULL,
  `nota7` int(2) DEFAULT NULL,
  `promedio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `notas`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `banco` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `bouche` int(50) DEFAULT NULL,
  `monto` int(50) DEFAULT NULL,
  `cedula` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_cuota` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_dep` date DEFAULT NULL,
  `curso` int(11) NOT NULL,
  `periodo` varchar(7) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `pagos`:
--   `cedula`
--       `estudiantes` -> `cedula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

DROP TABLE IF EXISTS `periodos`;
CREATE TABLE IF NOT EXISTS `periodos` (
  `periodo` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `periodos`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cedula` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `username` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo_usu` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `pregunta1` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `resp1` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `pregunta2` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `resp2` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_extreme` varchar(180) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`curso`),
  ADD KEY `periodo` (`periodo`),
  ADD KEY `F_inicio` (`F_inicio`),
  ADD KEY `F_culmi` (`F_culmi`),
  ADD KEY `duracion` (`duracion`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `duracion` (`duracion`),
  ADD KEY `F_inicio` (`F_inicio`),
  ADD KEY `F_culmi` (`F_culmi`),
  ADD KEY `periodo` (`periodo`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `curso` (`curso`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `curso` (`curso`),
  ADD KEY `periodo` (`periodo`),
  ADD KEY `periodo_2` (`periodo`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD KEY `curso` (`curso`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD KEY `pagos_ibfk_1` (`cedula`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`periodo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_2` FOREIGN KEY (`F_culmi`) REFERENCES `cursos` (`F_culmi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_3` FOREIGN KEY (`F_inicio`) REFERENCES `cursos` (`F_inicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_4` FOREIGN KEY (`duracion`) REFERENCES `cursos` (`duracion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `estudiantes` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `estudiantes` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
