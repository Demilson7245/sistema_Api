-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 15:18:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api-pacientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `estado` enum('confirmada','cancelada') DEFAULT 'confirmada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `apellido`, `especialidad`, `telefono`, `correo`, `username`, `password`) VALUES
(1, 'Dr. Miguel', 'Santos', 'Cardiología', '1231231234', 'miguel.santos@example.com', 'miguel.santos', '$2y$10$rlWFDBRiRG9YiqFv.OeDBOovJOkPcbb81vurBrptLZhnNutbVD0.G'),
(2, 'Dra. Laura', 'Fernández', 'Pediatría', '2342342345', 'laura.fernandez@example.com', 'laura.fernandez', '$2y$10$mVUJbXHrPsUxCHLViw8aCuq0FjtL.ufCi5b2LBupce6M3/TVojdWi'),
(3, 'Dr. Juan', 'Gómez', 'Dermatología', '3453453456', 'juan.gomez@example.com', 'juan.gomez', '$2y$10$c6Szn4y9pbg5S7/OdLF8fOvaTjiABINEnHhEk1j697MGnq7NVi8eG'),
(4, 'Dra. Ana', 'Rivas', 'Neurología', '4564564567', 'ana.rivas@example.com', 'ana.rivas', '$2y$10$0i7SSXFkICEKuc6o5JaJwO2MqH5sMpPFl9XjC3a65c.UPUoKVsSGy'),
(5, 'Dr. Carlos', 'Castillo', 'Oftalmología', '5675675678', 'carlos.castillo@example.com', 'carlos.castillo', '$2y$10$02WFR1mMZlnAGoIIO3b6xuYIKsRzVL6O5tYkrgzKaIlkbJxI5lO3u'),
(6, 'Dra. Sofía', 'Cruz', 'Ginecología', '6786786789', 'sofia.cruz@example.com', 'sofia.cruz', '$2y$10$r8e89zfQPLdE9H86sHQtq.qZ9AA5jiZqiFNgHEs3uRdjneTZuzRoG'),
(7, 'Dr. Fernando', 'Salas', 'Oncología', '7897897890', 'fernando.salas@example.com', 'fernando.salas', '$2y$10$eEIvOOxqi96Lk9N5M3Uu1.Kkz9NNxlwCahK6KumcVGW2ZECzc8qoC'),
(8, 'Dra. Lucía', 'Mendoza', 'Psicología', '8908908901', 'lucia.mendoza@example.com', 'lucia.mendoza', '$2y$10$DUhjrMNO0D8GKzNqTJRg1uyG9I51iy7x83tXK6116iqrq.IhUKUdq'),
(9, 'Dr. Pedro', 'Pérez', 'Ortopedia', '9019019012', 'pedro.perez@example.com', 'pedro.perez', '$2y$10$lVZuY0S7EFsj.sSYU29OBunyOFyCwOVMfkpYj82Dk2vz9E1TVUXcG'),
(10, 'Dra. Dora', 'Hernndez', 'Endocrinologda', '0120120123', 'valentina.hernandez@example.com', 'valentina.hernandez', '$2y$10$bbINqV1YSnwe1U.hAu3K5OM2m.6oN2og643zWvbCJWLEMCfs0R7mm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `direccion`, `telefono`, `correo`) VALUES
(1, 'Juan', 'Pérez', '1985-02-15', 'Calle Falsa 123', '1234567890', 'juan.perez@example.com'),
(2, 'María', 'González', '1990-03-10', 'Avenida Siempre Viva 742', '0987654321', 'maria.gonzalez@example.com'),
(3, 'Luis', 'Martínez', '1988-07-20', 'Calle Real 456', '5551234567', 'luis.martinez@example.com'),
(4, 'Ana', 'Lopez', '1995-12-30', 'Calle de la Luna 101', '6669876543', 'ana.lopez@example.com'),
(5, 'Carlos', 'Hernández', '1982-11-25', 'Avenida del Sol 987', '7776543210', 'carlos.hernandez@example.com'),
(6, 'Lucía', 'Ramírez', '1993-09-05', 'Calle del Río 135', '8885432109', 'lucia.ramirez@example.com'),
(7, 'Fernando', 'Torres', '1980-05-18', 'Calle de la Paz 456', '9994321098', 'fernando.torres@example.com'),
(8, 'Sofía', 'Díaz', '1991-04-14', 'Avenida Libertad 321', '3216549870', 'sofia.diaz@example.com'),
(9, 'Pedro', 'Morales', '1987-08-22', 'Calle del Bosque 654', '2345678901', 'pedro.morales@example.com'),
(10, 'Valentina', 'Suárez', '1994-01-30', 'Calle de las Flores 789', '3456789012', 'valentina.suarez@example.com'),
(12, 'Demilson', 'Calivar', '1970-08-03', 'Campo Grande', '71194675', 'faustoz@example.com'),
(14, 'Cesar', 'Calivar', '1970-08-03', 'Campo Grande', '71194675', 'faustoz@example.com'),
(15, 'pedro', 'Calivar', '1970-08-03', 'Campo Grande', '71194675', 'faustoz@example.com'),
(16, 'Santos', 'Calivar', '1970-08-03', 'Campo Grande', '71194675', 'faustoz@example.com'),
(17, 'Juan', 'Pérez', '1990-05-15', 'Calle 123', '123456789', 'juan.perez@example.com'),
(18, 'Ju', 'Pérez', '1990-05-15', 'Calle 123', '123456789', 'juan.perez@example.com'),
(19, 'Demilson', 'zi', '1990-05-15', ' 123', '123456789', 'juan.perez@example.com'),
(20, 'si', 'zi', '1990-05-15', ' 123', '123456789', 'juan.perez@example.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `medico_id` (`medico_id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
