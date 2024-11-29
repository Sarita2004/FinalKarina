-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 15:56:02
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_asistencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `id_alumno`, `fecha`, `id_materia`, `id_profesor`) VALUES
(1, 15, '2024-10-25', 1, 13),
(2, 15, '2024-10-25', 1, 13),
(5, 18, '2024-11-26', 1, 13),
(6, 18, '2024-11-26', 2, 13),
(7, 18, '2024-11-26', 1, 13),
(8, 18, '2024-11-25', 2, 13),
(9, 19, '2024-11-24', 2, 13),
(10, 19, '2024-11-25', 1, 13),
(11, 8, '2024-11-25', 1, 13),
(12, 18, '2024-11-25', 1, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`) VALUES
(1, 'Matematica'),
(2, 'Ingles'),
(3, 'Desarrollo de sistemas web'),
(9, 'Bases de datos'),
(10, 'Redes y Comunicaciones'),
(11, 'Desarrollo de Sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `nota_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('alumno','profesor') NOT NULL,
  `DNI` int(11) NOT NULL,
  `area` int(5) NOT NULL,
  `telefono` int(14) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `numero` int(5) NOT NULL,
  `estado_civil` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `id_usuario_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `rol`, `DNI`, `area`, `telefono`, `codigo_postal`, `calle`, `numero`, `estado_civil`, `genero`, `id_usuario_materia`) VALUES
(8, 'Sara', 'Meliti', 'sarameliti3@gmail.com', '$2y$10$ZQlLfRTIuL2owOilBonre.I9olMu3muh05j5ZWtnIlLpPzqhFMKci', 'alumno', 45414317, 0, 2147483647, 2919, '0', 0, '0', 'Femenino', 0),
(10, 'Nicolas', 'Rotili', 'nicolasmeliti@gmail.com', '$2y$10$fBFv3xKlaHoBV.NhhTnDGuz60fYA0quaAwVaorYx/McAyy6h/wyh2', 'profesor', 0, 0, 0, 0, '', 0, '', '', 0),
(13, 'Nico', 'Rotili OK', 'rotilinicolas@gmail.com', '$2y$10$f64qoP7Gszd9mpGNgnQNL.augzVhl5dkn7ijcUZA.t6qwj.2VG3sC', 'profesor', 57578347, 3364, 12344, 2919, 'Florencia', 902, 'Soltero', 'Femenino', 0),
(14, 'kari', 'gigli', 'karinagigli@gmail.com', '$2y$10$DugwlOWuh7iOoN7Vs1Po1uL3RwR0RcpYaU7yagU6EkuXdJ5.1vkb2', 'profesor', 0, 0, 0, 0, '', 0, '', '', 0),
(15, 'vital', 'longo', 'vitallongo@gmail.com', '$2y$10$efxKE5gFUM6/mlghTfqy/eXNtilgJXrh.Cbdl6sXpTD8hINFBx5qW', 'alumno', 0, 0, 919191, 0, '', 0, '', '', 0),
(18, 'Dario', 'Flores', 'darioflores@gmail.com', '$2y$10$ft97ma5wgeWlRwn4zdCmyOjcKgZWToTW.FsEaXadvwk7hWIuD11uG', 'alumno', 0, 0, 0, 0, '', 0, '', '', 0),
(19, 'Nazareno', 'Serra', 'nazaserra@gmail.com', '$2y$10$q4jTzrYvZQO0PTRkZ5pQyOYC6UrXSQCvxJW/QqRoftOTDGZJ9bodi', 'alumno', 0, 0, 0, 0, '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_materia`
--

CREATE TABLE `usuario_materia` (
  `id_usuario` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_usuario_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_materia`
--

INSERT INTO `usuario_materia` (`id_usuario`, `id_materia`, `id_usuario_materia`) VALUES
(15, 1, 0),
(15, 2, 0),
(15, 3, 0),
(13, 1, 0),
(13, 2, 0),
(13, 3, 0),
(14, 1, 0),
(14, 1, 0),
(19, 9, 0),
(19, 10, 0),
(19, 11, 0),
(8, 1, 0),
(8, 2, 0),
(8, 3, 0),
(18, 1, 0),
(18, 2, 0),
(18, 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencias_ibfk_1` (`id_alumno`),
  ADD KEY `asistencias_ibfk_3` (`id_profesor`),
  ADD KEY `asistencias_ibfk_4` (`id_materia`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuario_materia`
--
ALTER TABLE `usuario_materia`
  ADD KEY `usuario_materia_ibfk_1` (`id_usuario`),
  ADD KEY `usuario_materia_ibfk_2` (`id_materia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencias_ibfk_3` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencias_ibfk_4` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_materia`
--
ALTER TABLE `usuario_materia`
  ADD CONSTRAINT `usuario_materia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
