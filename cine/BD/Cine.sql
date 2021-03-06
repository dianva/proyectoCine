-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2019 a las 17:43:21
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine`
--
DROP DATABASE IF EXISTS `cine`;
CREATE DATABASE IF NOT EXISTS `cine` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cine`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `numButaca` int(3) NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `numSala` int(11) NOT NULL,
  `dni_cliente` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`numButaca`, `dia`, `hora`, `numSala`, `dni_cliente`) VALUES
(0, '2019-02-10', '16:00:00', 1, '123456789A'),
(1, '2019-02-10', '16:00:00', 1, '123456789A'),
(2, '2019-02-10', '16:00:00', 1, '123456789A'),
(3, '2019-02-10', '16:00:00', 1, '123456789A'),
(4, '2019-02-10', '16:00:00', 1, '123456789A'),
(5, '2019-02-10', '16:00:00', 1, '123456789A'),
(6, '2019-02-10', '16:00:00', 1, '123456789A'),
(7, '2019-02-10', '16:00:00', 1, '123456789A'),
(8, '2019-02-10', '16:00:00', 1, '123456789A'),
(9, '2019-02-10', '16:00:00', 1, '123456789A'),
(14, '2019-02-10', '16:00:00', 1, '123456789A'),
(15, '2019-02-10', '16:00:00', 1, '123456789A'),
(16, '2019-02-10', '16:00:00', 1, '123456789A'),
(17, '2019-02-10', '16:00:00', 1, '123456789A'),
(18, '2019-02-10', '16:00:00', 1, '123456789A'),
(19, '2019-02-10', '16:00:00', 1, '123456789A'),
(20, '2019-02-10', '16:00:00', 1, '123456789A'),
(30, '2019-02-10', '16:00:00', 1, '123456789A'),
(31, '2019-02-10', '16:00:00', 1, '123456789A'),
(36, '2019-02-10', '16:00:00', 1, '123456789A'),
(40, '2019-02-10', '16:00:00', 1, '123456789A'),
(41, '2019-02-10', '16:00:00', 1, '123456789A'),
(42, '2019-02-10', '16:00:00', 1, '123456789A'),
(46, '2019-02-10', '16:00:00', 1, '123456789A'),
(56, '2019-02-10', '16:00:00', 1, '123456789A'),
(84, '2019-02-10', '16:00:00', 1, '123456789A'),
(85, '2019-02-10', '16:00:00', 1, '123456789A'),
(74, '2019-02-10', '16:00:00', 1, '123985789P'),
(75, '2019-02-10', '16:00:00', 1, '123985789P'),
(10, '2019-02-10', '16:00:00', 1, '854646789X'),
(11, '2019-02-10', '16:00:00', 1, '854646789X'),
(12, '2019-02-10', '16:00:00', 1, '854646789X'),
(13, '2019-02-10', '16:00:00', 1, '854646789X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `idPeli` int(4) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(3) NOT NULL,
  `imagen` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `sinopsis` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`idPeli`, `titulo`, `duracion`, `imagen`, `sinopsis`) VALUES
(1, 'Jurassic Park', 130, 'Carteles/jurasic.jpg', 'Un parque temático de dinosauros se desmadra y se empiezan a comer a la gente'),
(2, 'El coloso el llamas', 90, 'Carteles/coloso.jpg', 'Un tipo muy grande se quema vivo'),
(3, '2001 una odisea en el espacio', 140, 'Carteles/2001.jpg', 'los simios están tan tranquilos en su hoyo en el suelo hasta que aparece un monolito y los vuelve inteligentes , luego pasa no se que con un robot homicida en el espacio , al final hay un viaje lisérgico'),
(4, 'Salvar al soldado Ryan', 120, 'Carteles/salvar.jpg', 'Un grupo de soldados vagan por la francia ocupada buscando a un soldado en concreto para darle el billete a casa , se quejan todos mucho, hay muchos disparos, el principio es muy loco y el final te lo esperas bastante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `numSala` int(11) NOT NULL,
  `aforo` int(3) NOT NULL,
  `id_peli` int(4) NOT NULL,
  `tipo` enum('normal','vip','atmos','3d') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`numSala`, `aforo`, `id_peli`, `tipo`) VALUES
(1, 100, 1, 'normal'),
(2, 50, 2, 'normal'),
(3, 60, 3, 'normal'),
(4, 90, 4, 'vip');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nif` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `saldo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nif`, `nombre`, `email`, `password`, `saldo`) VALUES
('123412312B', 'Juan', 'Juan@gmail.es', '112233', 90),
('123456789A', 'Pepe', 'pepe@gmail.es', '112233', 125),
('123985789P', 'Anna', 'anna@gmail.es', '112233', 190),
('765356789R', 'Antonio', 'Antonio@gmail.es', '112233', 10),
('854646789X', 'Marta', 'marta@gmail.es', '112233', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`numButaca`,`dia`,`hora`,`numSala`),
  ADD KEY `dni_cliente` (`dni_cliente`),
  ADD KEY `numSala` (`numSala`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`idPeli`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`numSala`),
  ADD KEY `id_peli` (`id_peli`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nif`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`numSala`) REFERENCES `sala` (`numSala`),
  ADD CONSTRAINT `entrada_ibfk_3` FOREIGN KEY (`dni_cliente`) REFERENCES `usuario` (`nif`);

--
-- Filtros para la tabla `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`id_peli`) REFERENCES `pelicula` (`idPeli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
