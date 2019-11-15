-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-10-2019 a las 00:56:03
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asitad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abuelito`
--

DROP TABLE IF EXISTS `abuelito`;
CREATE TABLE IF NOT EXISTS `abuelito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `fechaNAcimiento` date DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `necesidades` text,
  `examenMedico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `examenMedico` (`examenMedico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreActividad` varchar(45) DEFAULT NULL,
  `horaActividad` varchar(30) DEFAULT NULL,
  `abuelito_idAbuelito` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `tipoActividad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `abuelito_idAbuelito` (`abuelito_idAbuelito`),
  KEY `usuario_idUsuario` (`usuario_idUsuario`),
  KEY `tipoActividad` (`tipoActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apadrinamiento`
--

DROP TABLE IF EXISTS `apadrinamiento`;
CREATE TABLE IF NOT EXISTS `apadrinamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicial` date DEFAULT NULL,
  `abuelito_idAbuelito` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `solicitudApadrinamiento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `abuelito_idAbuelito` (`abuelito_idAbuelito`),
  KEY `usuario_idUsuario` (`usuario_idUsuario`),
  KEY `solicitudApadrinamiento` (`solicitudApadrinamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

DROP TABLE IF EXISTS `archivo`;
CREATE TABLE IF NOT EXISTS `archivo` (
  `idArchivo` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(3000) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idArchivo`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado`
--

DROP TABLE IF EXISTS `certificado`;
CREATE TABLE IF NOT EXISTS `certificado` (
  `idCertificado` int(11) NOT NULL AUTO_INCREMENT,
  `tipoCertificado` varchar(45) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `horaCertificado` varchar(30) DEFAULT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idCertificado`),
  KEY `usuario_idUsuario` (`usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donacion`
--

DROP TABLE IF EXISTS `donacion`;
CREATE TABLE IF NOT EXISTS `donacion` (
  `idDonacion` int(11) NOT NULL AUTO_INCREMENT,
  `valorDonacion` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipoDonacion` varchar(1000) DEFAULT NULL,
  `abuelito_idAbuelito` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `descripcionDonacion` varchar(500) NOT NULL,
  PRIMARY KEY (`idDonacion`),
  KEY `usuario_idUsuario` (`usuario_idUsuario`),
  KEY `abuelito_idAbuelito` (`abuelito_idAbuelito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

DROP TABLE IF EXISTS `enfermedad`;
CREATE TABLE IF NOT EXISTS `enfermedad` (
  `idEnfermedad` int(11) NOT NULL AUTO_INCREMENT,
  `tipoEnfermedad` varchar(45) DEFAULT NULL,
  `descripcionEnfermedad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idEnfermedad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `idEventos` int(11) NOT NULL AUTO_INCREMENT,
  `tipoEvento` int(11) DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `descripcionEventos` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idEventos`),
  KEY `tipoEvento` (`tipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenesmedicos`
--

DROP TABLE IF EXISTS `examenesmedicos`;
CREATE TABLE IF NOT EXISTS `examenesmedicos` (
  `idExamenesMedicos` int(11) NOT NULL AUTO_INCREMENT,
  `fechaExamenesMedicos` date DEFAULT NULL,
  `medicamentos_idMedicamentos` int(11) NOT NULL,
  `enfermedad_idEnfermedad` int(11) NOT NULL,
  PRIMARY KEY (`idExamenesMedicos`),
  KEY `medicamentos_idMedicamentos` (`medicamentos_idMedicamentos`),
  KEY `enfermedad_idEnfermedad` (`enfermedad_idEnfermedad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `idMedicamentos` int(11) NOT NULL AUTO_INCREMENT,
  `fechaVencimiento` date DEFAULT NULL,
  `laboratorio` varchar(40) DEFAULT NULL,
  `tipoMedicamento` int(11) DEFAULT NULL,
  `nombreMedicamento` varchar(45) DEFAULT NULL,
  `descripcionMedicamento` varchar(500) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `unidades` int(9) NOT NULL,
  PRIMARY KEY (`idMedicamentos`),
  KEY `tipoMedicamento` (`tipoMedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`idMedicamentos`, `fechaVencimiento`, `laboratorio`, `tipoMedicamento`, `nombreMedicamento`, `descripcionMedicamento`, `estado`, `unidades`) VALUES
(2, '2019-10-31', 'Lab1', 1, 'papitas', 'Descripcion1', 'Bien(?)', 20),
(3, '2025-12-31', 'Lab25', 2, 'Yucas', 'asdadjj', 'Bien(?)', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE IF NOT EXISTS `mensaje` (
  `idMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(200) NOT NULL,
  `contenido` varchar(200) NOT NULL,
  `correoDestinatario` varchar(40) NOT NULL,
  `designatario` int(11) NOT NULL,
  `remitenteUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idMensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoRol` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_tipoRol` (`tipoRol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `tipoRol`) VALUES
(1, 'administrador'),
(3, 'medico'),
(2, 'padrino'),
(4, 'practicante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudapadrinamiento`
--

DROP TABLE IF EXISTS `solicitudapadrinamiento`;
CREATE TABLE IF NOT EXISTS `solicitudapadrinamiento` (
  `idSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `IdAbuelito` int(11) NOT NULL,
  `estadoId` varchar(20) DEFAULT '1',
  `razon` text NOT NULL,
  PRIMARY KEY (`idSolicitud`),
  KEY `idUsuario` (`idUsuario`),
  KEY `IdAbuelito` (`IdAbuelito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoactividad`
--

DROP TABLE IF EXISTS `tipoactividad`;
CREATE TABLE IF NOT EXISTS `tipoactividad` (
  `idTipoActividad` int(11) NOT NULL AUTO_INCREMENT,
  `tipoActividad` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipoActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevento`
--

DROP TABLE IF EXISTS `tipoevento`;
CREATE TABLE IF NOT EXISTS `tipoevento` (
  `idTipoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `tipoEvento` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomedicamento`
--

DROP TABLE IF EXISTS `tipomedicamento`;
CREATE TABLE IF NOT EXISTS `tipomedicamento` (
  `idTipoMedicamento` int(11) NOT NULL AUTO_INCREMENT,
  `tipoMedicamento` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipoMedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipomedicamento`
--

INSERT INTO `tipomedicamento` (`idTipoMedicamento`, `tipoMedicamento`) VALUES
(1, 'Tipo1'),
(2, 'Tipo2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `rol` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `PASSWORD`, `rol`, `imagen`) VALUES
(1, 'Elkin', 'Torres', 'elkintorres721@gmail.com', '12345', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

DROP TABLE IF EXISTS `visitas`;
CREATE TABLE IF NOT EXISTS `visitas` (
  `idVisitas` int(11) NOT NULL AUTO_INCREMENT,
  `fechaVisita` date DEFAULT NULL,
  `horaVisita` varchar(30) DEFAULT NULL,
  `apadrinamiento_idApadrinamiento` int(11) NOT NULL,
  `abuelito_idAbuelito` int(11) NOT NULL,
  `estadoVisita` varchar(40) NOT NULL,
  PRIMARY KEY (`idVisitas`),
  KEY `apadrinamiento_idApadrinamiento` (`apadrinamiento_idApadrinamiento`),
  KEY `abuelito_idAbuelito` (`abuelito_idAbuelito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abuelito`
--
ALTER TABLE `abuelito`
  ADD CONSTRAINT `abuelito_ibfk_1` FOREIGN KEY (`examenMedico`) REFERENCES `examenesmedicos` (`idExamenesMedicos`);

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`tipoActividad`) REFERENCES `tipoactividad` (`idTipoActividad`),
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`abuelito_idAbuelito`) REFERENCES `abuelito` (`id`);

--
-- Filtros para la tabla `apadrinamiento`
--
ALTER TABLE `apadrinamiento`
  ADD CONSTRAINT `apadrinamiento_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `apadrinamiento_ibfk_2` FOREIGN KEY (`abuelito_idAbuelito`) REFERENCES `abuelito` (`id`),
  ADD CONSTRAINT `apadrinamiento_ibfk_3` FOREIGN KEY (`solicitudApadrinamiento`) REFERENCES `solicitudapadrinamiento` (`idSolicitud`);

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `certificado_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD CONSTRAINT `donacion_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `donacion_ibfk_2` FOREIGN KEY (`abuelito_idAbuelito`) REFERENCES `abuelito` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`tipoEvento`) REFERENCES `tipoevento` (`idTipoEvento`);

--
-- Filtros para la tabla `examenesmedicos`
--
ALTER TABLE `examenesmedicos`
  ADD CONSTRAINT `examenesmedicos_ibfk_1` FOREIGN KEY (`medicamentos_idMedicamentos`) REFERENCES `medicamentos` (`idMedicamentos`),
  ADD CONSTRAINT `examenesmedicos_ibfk_2` FOREIGN KEY (`enfermedad_idEnfermedad`) REFERENCES `enfermedad` (`idEnfermedad`);

--
-- Filtros para la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamentos_ibfk_1` FOREIGN KEY (`tipoMedicamento`) REFERENCES `tipomedicamento` (`idTipoMedicamento`);

--
-- Filtros para la tabla `solicitudapadrinamiento`
--
ALTER TABLE `solicitudapadrinamiento`
  ADD CONSTRAINT `solicitudapadrinamiento_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `solicitudapadrinamiento_ibfk_2` FOREIGN KEY (`IdAbuelito`) REFERENCES `abuelito` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`apadrinamiento_idApadrinamiento`) REFERENCES `apadrinamiento` (`id`),
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`abuelito_idAbuelito`) REFERENCES `abuelito` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
