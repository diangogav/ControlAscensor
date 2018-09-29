-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2018 a las 15:09:45
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sertecin_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `rif_cliente` varchar(12) NOT NULL,
  `nombr_clien` varchar(50) NOT NULL,
  `id_direc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_login`
--

CREATE TABLE `log_login` (
  `id_login` int(11) NOT NULL,
  `ci_usuar` int(11) NOT NULL,
  `estatus` varchar(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_repor` int(11) NOT NULL,
  `ci_usuar` int(11) NOT NULL,
  `acciones` varchar(100) NOT NULL,
  `rif_clien` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado`
--

CREATE TABLE `t_estado` (
  `id_estad` int(11) NOT NULL,
  `descr_estad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_municipio`
--

CREATE TABLE `t_municipio` (
  `id_munic` int(11) NOT NULL,
  `id_estad` int(11) NOT NULL,
  `descr_munic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_parroquia`
--

CREATE TABLE `t_parroquia` (
  `id_parro` int(11) NOT NULL,
  `id_munic` int(11) NOT NULL,
  `descr_munic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ci_usuar` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `prime_nombr` varchar(30) NOT NULL,
  `segun_nombr` varchar(30) NOT NULL,
  `prime_apell` varchar(30) NOT NULL,
  `segun_apell` varchar(30) NOT NULL,
  `nivel_acces` varchar(10) NOT NULL,
  `estad_usuar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ci_usuar`, `password`, `prime_nombr`, `segun_nombr`, `prime_apell`, `segun_apell`, `nivel_acces`, `estad_usuar`) VALUES
(25510059, 'LeoJimenez', 'Willerd', 'Alexander', 'Sanchez', 'Rojas', 'root', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`rif_cliente`),
  ADD UNIQUE KEY `indice` (`id_direc`);

--
-- Indices de la tabla `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `indice` (`ci_usuar`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_repor`),
  ADD UNIQUE KEY `indice` (`rif_clien`),
  ADD UNIQUE KEY `indice_ci` (`ci_usuar`);

--
-- Indices de la tabla `t_estado`
--
ALTER TABLE `t_estado`
  ADD PRIMARY KEY (`id_estad`);

--
-- Indices de la tabla `t_municipio`
--
ALTER TABLE `t_municipio`
  ADD PRIMARY KEY (`id_munic`),
  ADD UNIQUE KEY `indice` (`id_estad`);

--
-- Indices de la tabla `t_parroquia`
--
ALTER TABLE `t_parroquia`
  ADD PRIMARY KEY (`id_parro`),
  ADD UNIQUE KEY `indice` (`id_munic`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ci_usuar`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_repor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_estado`
--
ALTER TABLE `t_estado`
  MODIFY `id_estad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_municipio`
--
ALTER TABLE `t_municipio`
  MODIFY `id_munic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_parroquia`
--
ALTER TABLE `t_parroquia`
  MODIFY `id_parro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ci_usuar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25510060;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `log_login`
--
ALTER TABLE `log_login`
  ADD CONSTRAINT `log_login_ibfk_1` FOREIGN KEY (`ci_usuar`) REFERENCES `usuarios` (`ci_usuar`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`ci_usuar`) REFERENCES `usuarios` (`ci_usuar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`rif_clien`) REFERENCES `cliente` (`rif_cliente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_estado`
--
ALTER TABLE `t_estado`
  ADD CONSTRAINT `t_estado_ibfk_1` FOREIGN KEY (`id_estad`) REFERENCES `cliente` (`id_direc`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_municipio`
--
ALTER TABLE `t_municipio`
  ADD CONSTRAINT `t_municipio_ibfk_1` FOREIGN KEY (`id_estad`) REFERENCES `t_estado` (`id_estad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_parroquia`
--
ALTER TABLE `t_parroquia`
  ADD CONSTRAINT `t_parroquia_ibfk_1` FOREIGN KEY (`id_munic`) REFERENCES `t_municipio` (`id_munic`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
