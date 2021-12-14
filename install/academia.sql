-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-12-2021 a las 00:31:42
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Admin`
--

CREATE TABLE `Admin` (
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Admin`
--

INSERT INTO `Admin` (`dni`) VALUES
('00000000A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Application`
--

CREATE TABLE `Application` (
  `id` int(11) NOT NULL,
  `courseName` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `isAccepted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Application`
--

INSERT INTO `Application` (`id`, `courseName`, `username`, `date`, `isAccepted`) VALUES
(27, 'Curso Prueba', 'user1', '2021-12-13 02:53:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Course`
--

CREATE TABLE `Course` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `description` varchar(256) NOT NULL,
  `teacher` char(9) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `applicationDeadline` datetime NOT NULL,
  `length` int(11) NOT NULL,
  `cost` double NOT NULL,
  `maxStudents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Course`
--

INSERT INTO `Course` (`id`, `name`, `description`, `teacher`, `startDate`, `endDate`, `applicationDeadline`, `length`, `cost`, `maxStudents`) VALUES
(9, 'Curso Prueba', 'ccccc', '49114702L', '2021-12-15 05:55:00', '2021-12-04 05:55:00', '2021-12-16 05:55:00', 14, 5, 1),
(10, 'Asdads', 'ada', '11494937C', '2021-12-17 00:13:00', '2021-12-26 00:13:00', '2021-12-22 00:13:00', 23, 32, 3),
(11, 'Adsdd', 'aadaa', '11494937C', '2021-12-10 00:13:00', '2021-12-18 00:13:00', '2021-12-28 00:13:00', 12, 32, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DirectMessage`
--

CREATE TABLE `DirectMessage` (
  `id` int(11) NOT NULL,
  `sender` varchar(15) DEFAULT NULL,
  `receiver` varchar(15) DEFAULT NULL,
  `content` text NOT NULL,
  `sendingDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `DirectMessage`
--

INSERT INTO `DirectMessage` (`id`, `sender`, `receiver`, `content`, `sendingDateTime`) VALUES
(5, 'admin', NULL, 'hola mundo', '2021-12-11 05:19:31'),
(6, 'admin', NULL, 'hello world', '2021-12-11 05:23:07'),
(7, 'admin', NULL, 'asd', '2021-12-11 05:24:38'),
(8, NULL, 'admin', 'Hola Mundo', '2021-12-12 03:28:38'),
(9, 'ralesdi', 'admin', 'hasd', '2021-12-12 20:25:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Student`
--

CREATE TABLE `Student` (
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Teacher`
--

CREATE TABLE `Teacher` (
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Teacher`
--

INSERT INTO `Teacher` (`dni`) VALUES
('11494937C'),
('49114702L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `dni` char(9) NOT NULL,
  `username` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(160) NOT NULL,
  `image` varchar(160) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`id`, `dni`, `username`, `name`, `surname`, `email`, `password`, `image`, `isActive`) VALUES
(1, '00000000A', 'admin', '', '', 'alessandrorinaldifma@gmail.es', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 1),
(6, '11494937C', 'user1', 'NameUno', 'SurnameUn', 'user1@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/e6751b51f0d3e7805bf3f5162935b995c48ab6c1.png', 1),
(9, '49114702L', 'ralesdi', 'Alessandro', 'Rinaldi', 'alessandrorinaldifma@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/0c5e7b4fc9b7561acfa2697788b9d4636cf09e80.jpg', 1),
(13, '00000000T', 'aringom702', 'Asadsad', 'Sadad', 'alessandrorinaldifma@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/e6751b51f0d3e7805bf3f5162935b995c48ab6c1.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `Application`
--
ALTER TABLE `Application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_name` (`courseName`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `Course_ibfk_1` (`teacher`);

--
-- Indices de la tabla `DirectMessage`
--
ALTER TABLE `DirectMessage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DirectMessage_ibfk_1` (`sender`),
  ADD KEY `DirectMessage_ibfk_2` (`receiver`);

--
-- Indices de la tabla `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `Teacher`
--
ALTER TABLE `Teacher`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Application`
--
ALTER TABLE `Application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `Course`
--
ALTER TABLE `Course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `DirectMessage`
--
ALTER TABLE `DirectMessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `User` (`dni`);

--
-- Filtros para la tabla `Application`
--
ALTER TABLE `Application`
  ADD CONSTRAINT `Application_ibfk_1` FOREIGN KEY (`courseName`) REFERENCES `Course` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Application_ibfk_2` FOREIGN KEY (`username`) REFERENCES `User` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `Teacher` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `DirectMessage`
--
ALTER TABLE `DirectMessage`
  ADD CONSTRAINT `DirectMessage_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `User` (`username`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `DirectMessage_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `User` (`username`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `dni_fk` FOREIGN KEY (`dni`) REFERENCES `User` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Teacher`
--
ALTER TABLE `Teacher`
  ADD CONSTRAINT `Teacher_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `User` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
