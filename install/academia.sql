-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2021 a las 08:09:19
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

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
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`dni`) VALUES
('00000000A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `courseName` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `isAccepted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `course`
--

CREATE TABLE `course` (
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
-- Volcado de datos para la tabla `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `teacher`, `startDate`, `endDate`, `applicationDeadline`, `length`, `cost`, `maxStudents`) VALUES
(12, 'Curso De Java', 'Curso para principiantes', '14391287A', '2021-12-13 08:02:00', '2021-12-31 08:02:00', '2021-12-15 08:02:00', 12, 99, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directmessage`
--

CREATE TABLE `directmessage` (
  `id` int(11) NOT NULL,
  `sender` varchar(15) DEFAULT NULL,
  `receiver` varchar(15) DEFAULT NULL,
  `content` text NOT NULL,
  `sendingDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `directmessage`
--

INSERT INTO `directmessage` (`id`, `sender`, `receiver`, `content`, `sendingDateTime`) VALUES
(10, 'admin', 'ralesdi', 'Hola mundo!', '2021-12-14 08:03:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

CREATE TABLE `teacher` (
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `teacher`
--

INSERT INTO `teacher` (`dni`) VALUES
('14391287A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
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
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `dni`, `username`, `name`, `surname`, `email`, `password`, `image`, `isActive`) VALUES
(14, '00000000A', 'admin', 'admin', 'admin', 'admin@sitio.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 1),
(15, '11657106Q', 'alfonso88', 'Alfonso', 'Romero', 'alfonsoromero@hotmail.es', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/14b9e8d1cef911ff714c0ad4b51a133ee9237e0c.png', 1),
(16, '58438568F', 'pedro99', 'Pedro', 'Picapiedra', 'pedropicapiedra@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/0e39f4769fe8f186de70cc49a9ae13d55f770e3e.png', 1),
(17, '93241999E', 'kitykat', 'Carolina', 'Bescansa', 'carol@correo.es', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/702407c4580432314998dfa08f59bd663c4c98e8.jpg', 1),
(18, '14391287A', 'ralesdi', 'Alessandro', 'Rinaldi', 'micorreo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/2f37ad7c005046a5f2b83421b3c59e0166d747a6.png', 1),
(19, '30854625X', 'esperanzaco', 'Esperanza', 'Celeste', 'espe@correo.es', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/6975b8793d0b1e3437f49ee67ecd35643b5bcf1e.png', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_name` (`courseName`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `Course_ibfk_1` (`teacher`);

--
-- Indices de la tabla `directmessage`
--
ALTER TABLE `directmessage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DirectMessage_ibfk_1` (`sender`),
  ADD KEY `DirectMessage_ibfk_2` (`receiver`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `directmessage`
--
ALTER TABLE `directmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `user` (`dni`);

--
-- Filtros para la tabla `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `Application_ibfk_1` FOREIGN KEY (`courseName`) REFERENCES `course` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Application_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `teacher` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `directmessage`
--
ALTER TABLE `directmessage`
  ADD CONSTRAINT `DirectMessage_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `user` (`username`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `DirectMessage_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `user` (`username`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `dni_fk` FOREIGN KEY (`dni`) REFERENCES `user` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `Teacher_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `user` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
