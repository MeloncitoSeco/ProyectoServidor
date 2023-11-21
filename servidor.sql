-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 11:04:32
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
-- Base de datos: `servidor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `imgId` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `pubId` int(11) NOT NULL,
  `sesion` varchar(255) DEFAULT NULL,
  `num` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`imgId`, `fecha`, `pubId`, `sesion`, `num`) VALUES
(3, '2003-12-11', 1, NULL, NULL),
(4, '2003-12-11', 1, NULL, NULL),
(5, '2003-12-11', 2, NULL, NULL),
(6, '2003-12-11', 2, NULL, NULL),
(7, '2023-11-11', 1, 'santi', 0),
(8, '2023-11-11', 1, 'santi', 2),
(9, '2023-10-10', 2, 'jose', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `pubId` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `trenId` int(10) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `posicion` varchar(45) NOT NULL,
  `comAuto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`pubId`, `email`, `trenId`, `titulo`, `posicion`, `comAuto`) VALUES
(1, 'santiago@gmail.com', 1, 'Primer Civia', 'Quieto', 'Andalucía'),
(2, 'santiago@gmail.com', 1, 'Segundo Civia', 'Quieto', 'Asturias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotren`
--

CREATE TABLE `tipotren` (
  `tipoTren` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Volcado de datos para la tabla `tipotren`
--

INSERT INTO `tipotren` (`tipoTren`, `nombre`) VALUES
(1, 'Ave'),
(2, 'Alvia'),
(3, 'Avant'),
(4, 'IRYO'),
(5, 'OUIGO'),
(6, 'LD'),
(7, 'MD'),
(8, 'Cercanias/Rodalies'),
(9, 'AM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tren`
--

CREATE TABLE `tren` (
  `trenId` int(10) NOT NULL,
  `modelo` varchar(24) NOT NULL,
  `tipoTren` int(10) NOT NULL,
  `fechaFabricacion` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tren`
--

INSERT INTO `tren` (`trenId`, `modelo`, `tipoTren`, `fechaFabricacion`) VALUES
(1, 'Civia', 6, 2003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(255) NOT NULL,
  `contra` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`email`, `contra`) VALUES
('santiago@gmail.com', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `img-pub_idx` (`pubId`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`pubId`),
  ADD KEY `pub-usu_idx` (`email`),
  ADD KEY `pub-tren_idx` (`trenId`);

--
-- Indices de la tabla `tipotren`
--
ALTER TABLE `tipotren`
  ADD PRIMARY KEY (`tipoTren`);

--
-- Indices de la tabla `tren`
--
ALTER TABLE `tren`
  ADD PRIMARY KEY (`trenId`),
  ADD KEY `tren-tipo_idx` (`tipoTren`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `img-pub` FOREIGN KEY (`pubId`) REFERENCES `publicacion` (`pubId`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `pub-tren` FOREIGN KEY (`trenId`) REFERENCES `tren` (`trenId`),
  ADD CONSTRAINT `pub-usu` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);

--
-- Filtros para la tabla `tren`
--
ALTER TABLE `tren`
  ADD CONSTRAINT `tren-tipo` FOREIGN KEY (`tipoTren`) REFERENCES `tipotren` (`tipoTren`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
