-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2021 a las 03:34:42
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iexe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `nombre_proyecto` varchar(100) NOT NULL,
  `tecnologia_usada` varchar(200) NOT NULL,
  `asignatura_desarrollo` varchar(200) NOT NULL,
  `fechaini_fechafin` varchar(100) NOT NULL,
  `listado_habilidades` varchar(200) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre_proyecto`, `tecnologia_usada`, `asignatura_desarrollo`, `fechaini_fechafin`, `listado_habilidades`, `id_alumno`, `fecha`) VALUES
(1, 'cansino', 'javascript, html, python', 'medicina', '3', 'investigación\r\nexperiencia', 1, '2021-03-03 22:14:36'),
(2, 'sputnik v', 'javascript, html, postgresql', 'medicina 2', '03/04/2021 - 04/06/2021', 'experiencia\r\ninvestigación', 1, '2021-03-03 22:19:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` text NOT NULL,
  `nivel` int(2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `nivel`, `fecha`) VALUES
(1, 'jorge gilberto bolaños peralta', 'jrgbp@hotmail.com', '18824a99403924cbcfd7b24ed5cef5889b4abbdfd4eb525cda1c949c3a29e3f0', 2, '2021-03-02 03:00:42'),
(2, 'gilberto bolaños', 'jorgegbp@gmail.com', '18824a99403924cbcfd7b24ed5cef5889b4abbdfd4eb525cda1c949c3a29e3f0', 1, '2021-03-02 05:33:16'),
(3, 'alejandro', 'ale@correo.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2, '2021-03-03 23:49:17'),
(4, 'juan carlos', 'juan@correo.com', '18824a99403924cbcfd7b24ed5cef5889b4abbdfd4eb525cda1c949c3a29e3f0', 2, '2021-03-03 23:59:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
