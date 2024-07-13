-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2023 a las 01:25:24
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cuadre_diario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `telefono`) VALUES
(7, 'Oscar', 'leoncybercafe@hotmail.com', '$2y$10$WoYwCKWgc6bciod1B7sqXuOMtUSVjrlgVNkQyKRXRosQL9JnERvbC', '3132599548'),
(8, 'sebastian', 'oskarleon10@hotmail.com', '$2y$10$XsbKG1m8SAeek36JV95P/OCK5vb/IKRuOvq06VwXJhiZJT5h81y1S', '3115762983'),
(12, 'LEYDI VALDERRAMA', 'LEYDIVALDERRAMA@HOTMAIL.COM', '$2y$10$MJGfoctNZ93Zm9Wod/KrSOaAmmMQ8cgnU5og4ZJF7BSifcztZiG2u', '3115762983'),
(51, 'juan nuÃ±ez', 'juan2018@gmail.com', '$2y$10$5XK2HjKJENWn.y3uDhZ8sOdXhH75EB8Zs6ST5ihoUOlWciiamT26u', '3132595487'),
(54, 'juan', 'juan@gmail.com', '$2y$10$xite2Xwt.csnZ04JOaV0aenlUxQJ7FTCj9MTdWQVX2JdmoVueWHiO', '3132599548');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_base`
--

CREATE TABLE `valor_base` (
  `id` int(11) NOT NULL,
  `monto_base` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `valor_base`
--

INSERT INTO `valor_base` (`id`, `monto_base`) VALUES
(50, 3950598.00),
(52, -31399402.00),
(53, -21399402.00),
(54, -32614402.00),
(55, -17614402.00),
(56, -36698020.00),
(57, -36698020.00),
(58, -36698020.00),
(59, -36698020.00),
(60, -36698020.00),
(61, 13301980.00),
(62, -36698020.00),
(63, 13301980.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valor_base`
--
ALTER TABLE `valor_base`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `valor_base`
--
ALTER TABLE `valor_base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
