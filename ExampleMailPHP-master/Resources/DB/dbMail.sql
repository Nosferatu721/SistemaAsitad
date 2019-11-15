-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-02-2017 a las 00:43:52
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

--
-- Base de datos: `dbMail`
--
create database dbMail;
use dbMail;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--
CREATE TABLE `person` (
  `idperson` int(11) NOT NULL,
  `nameperson` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `emailperson` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`idperson`);

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `idperson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
