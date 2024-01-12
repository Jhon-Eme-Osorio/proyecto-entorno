-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 10-01-2024 a las 00:45:45
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Id_administrador` int(11) NOT NULL,
  `Usuario` varchar(15) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Id_administrador`, `Usuario`, `Contraseña`) VALUES
(1, 'Admin', '$2y$10$uQG9Dw2LDwrMlB.2X2Q7Ee04r587qlFvnc917JkRktJmvXlaao4jW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `Id_autor` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`Id_autor`, `Nombre`, `Apellido`, `Fecha_nacimiento`) VALUES
(1, 'William', 'Shakespeare', '1564-03-26'),
(2, 'Jane ', 'Austen', '1775-12-16'),
(3, 'Gabriel', 'García Márquez ', '1927-03-06'),
(4, 'Joanne', 'Rowling', '1965-07-31'),
(5, 'Isabel', 'Allende', '1942-08-02'),
(6, 'Agatha', 'Christie', '1890-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Id_categoria` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`Id_categoria`, `Nombre`, `Descripcion`) VALUES
(1, 'Todos', 'Muestra todas las categorias'),
(2, 'Realismo mágico', 'movimiento pictórico y literario'),
(3, 'Tragedia', 'La tragedia es una forma literaria, teatral o dramática del lenguaje solemne'),
(4, 'Novela romántica', 'aborda temas como el amor, la muerte, la sensación de incomprensión o el rechazo al mundo'),
(5, 'Fantasia', 'cualquier relato en que participan fenómenos sobrenaturales y extraordinarios, como la magia o la intervención de criaturas inexistentes'),
(6, 'Misterio', 'es un género de literatura generalmente centrado en la investigación de un crimen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_cliente` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Direccion` varchar(30) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_cliente`, `Nombre`, `Apellido`, `Direccion`, `Telefono`, `Correo`) VALUES
(1, 'jhon', 'osorio', 'calle 123', '12345689', 'jhon@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `Id_editorial` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`Id_editorial`, `Nombre`, `Telefono`) VALUES
(1, 'Collins Crime Club', '123456789'),
(2, 'Bloomsbury', '456789123'),
(3, 'Shinchosha', '756874236'),
(4, 'Sudamericana', '879852469'),
(5, 'Varios', '879635489');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `Id_libro` int(11) NOT NULL,
  `Id_categoria` int(11) NOT NULL,
  `Id_editorial` int(11) NOT NULL,
  `Id_autor` int(11) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Año_publicacion` date NOT NULL,
  `Disponibilidad` varchar(2) NOT NULL,
  `Ejemplares` int(11) NOT NULL,
  `Ejemplar_prestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`Id_libro`, `Id_categoria`, `Id_editorial`, `Id_autor`, `Titulo`, `Año_publicacion`, `Disponibilidad`, `Ejemplares`, `Ejemplar_prestado`) VALUES
(1, 3, 5, 1, 'Romeo y Julieta', '1597-08-08', 'Si', 4, 0),
(2, 3, 5, 1, 'Hamlet', '1601-01-01', 'Si', 4, 0),
(3, 3, 5, 1, 'Macbeth', '1623-01-01', 'Si', 4, 0),
(4, 4, 5, 2, 'Orgullo y prejuicio', '1813-01-01', 'Si', 2, 0),
(5, 4, 5, 2, 'Sentido y sensibilidad', '1811-01-01', 'Si', 2, 0),
(6, 4, 5, 2, 'Emma', '1815-01-01', 'Si', 1, 0),
(7, 2, 4, 3, 'Cien años de soledad', '1967-01-01', 'Si', 1, 0),
(8, 2, 4, 3, 'El otoño del patriarca', '1975-01-01', 'Si', 2, 0),
(9, 2, 4, 3, 'Crónica muerte anunciada', '1981-01-01', 'Si', 1, 0),
(10, 5, 2, 4, 'Harry Potter y la piedra filosofal', '1997-01-01', 'No', 0, 2),
(11, 5, 2, 4, 'la cámara secreta', '1998-01-01', 'Si', 2, 0),
(12, 5, 2, 4, 'las Reliquias de la Muerte', '2007-01-01', 'Si', 2, 1),
(13, 6, 1, 6, 'Asesinato en el Orient Express', '1934-01-01', 'Si', 1, 0),
(14, 6, 1, 6, 'Diez negritos', '1939-01-01', 'Si', 2, 0),
(15, 6, 1, 6, 'Asesinato en Mesopotamia', '1936-01-01', 'Si', 3, 0),
(16, 2, 5, 5, 'La casa de los espíritus', '1982-01-01', 'Si', 1, 0),
(17, 2, 5, 5, 'Eva Luna', '1987-01-01', 'Si', 3, 0),
(18, 4, 5, 5, 'Paula', '1994-01-01', 'Si', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `Id_prestamo` int(11) NOT NULL,
  `Fecha_prestamo` date NOT NULL,
  `Fecha_devolucion` date NOT NULL,
  `Id_libro` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`Id_prestamo`, `Fecha_prestamo`, `Fecha_devolucion`, `Id_libro`, `Id_cliente`, `Estado`) VALUES
(1, '2024-01-09', '2024-01-10', 12, 1, 1),
(2, '2024-01-09', '2024-01-10', 10, 1, 1),
(3, '2024-01-10', '2024-01-10', 10, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Id_administrador`);

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`Id_autor`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`Id_editorial`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`Id_libro`),
  ADD KEY `Id_categoria` (`Id_categoria`),
  ADD KEY `Id_editorial` (`Id_editorial`),
  ADD KEY `Id_autor` (`Id_autor`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`Id_prestamo`),
  ADD KEY `Id_libro` (`Id_libro`),
  ADD KEY `Id_usuario` (`Id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `Id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `Id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `Id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `Id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `Id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`Id_categoria`) REFERENCES `categoria` (`Id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`Id_editorial`) REFERENCES `editorial` (`Id_editorial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`Id_autor`) REFERENCES `autor` (`Id_autor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`Id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`Id_libro`) REFERENCES `libro` (`Id_libro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
