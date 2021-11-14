-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2021 a las 00:54:16
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publics`
--

CREATE TABLE `publics` (
  `publicId` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `descript` text NOT NULL,
  `status` int(11) NOT NULL,
  `created` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publics`
--

INSERT INTO `publics` (`publicId`, `title`, `descript`, `status`, `created`, `idUser`) VALUES
(1, 'Una', 'prueba', 1, '2021-11-13', 8),
(10, 'Prueba 2', 'asdfg', 1, '2021-11-14', 8),
(11, 'Prueba 3', 'asdfg', 1, '2021-11-13', 8),
(12, 'Prueba 3', 'Cantando', 1, '2021-11-13', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `app` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userId`, `name`, `app`, `email`, `pass`, `rol`) VALUES
(8, 'Alexander', 'Cruz', 'alexande@gmail.com', '1234', 'alto'),
(22, 'Fernando', 'Jimenez', 'fer@hotmail.com', 'admin', 'medio alto'),
(23, 'Zelda', 'Rodriguez', 'zelda@hotmail.com', 'admin', 'alto medio');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publics`
--
ALTER TABLE `publics`
  ADD PRIMARY KEY (`publicId`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `publics`
--
ALTER TABLE `publics`
  MODIFY `publicId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `publics`
--
ALTER TABLE `publics`
  ADD CONSTRAINT `publics_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
