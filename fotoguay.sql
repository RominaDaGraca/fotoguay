-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2023 a las 18:22:07
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fotoguay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `file_name`, `uploaded_on`, `id_usuario`) VALUES
(1, 'masood-aslami-AsbqA0h_H9g-unsplash.jpg', '2023-03-01 16:41:33', 16),
(2, 'playa.jpg', '2023-03-01 16:42:58', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'Romina', 'romina@mail.com', '12345'),
(2, 'Leonar', 'leonar@gmail.com', '12345'),
(3, 'Santi', 'santi@gmail.com', '12345'),
(4, 'Carlos', 'carlos@gmail.com', '12345'),
(5, 'tomas', 'tomas@gmail.com', '12345'),
(6, 'Cris', 'cris@gmail.com', '1234567'),
(7, 'sofi', 'sofi@gmail.com', '12345'),
(8, '', '', ''),
(9, 'Pedro', 'pedro@gmail.com', '123456'),
(11, 'Lorena', 'lorena@gmail.com', '12345'),
(12, 'admin', 'kjkdsfn@jkdkjb', '1234'),
(13, 'alicia', 'alicia@gmail.com', '1234'),
(14, 'dkfjn', 'manolo@gmail.com', '1234'),
(15, 'andrea', 'andrea@gmail.com', '1234'),
(16, 'romina', 'romidagraca@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id_usuario` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id_usuario`, `id_imagen`) VALUES
(16, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
