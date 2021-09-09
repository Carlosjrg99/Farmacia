-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2020 at 03:18 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmacia`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmaco`
--

CREATE TABLE `farmaco` (
  `cod_far` int(5) NOT NULL,
  `nom_far` varchar(15) NOT NULL,
  `lab_far` varchar(30) NOT NULL,
  `sto_far` int(7) NOT NULL,
  `pre_far` int(7) NOT NULL,
  `obs_far` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farmaco`
--

INSERT INTO `farmaco` (`cod_far`, `nom_far`, `lab_far`, `sto_far`, `pre_far`, `obs_far`) VALUES
(1, 'Aspirina', 'Bayer', 117, 535, 'Observacion1'),
(2, 'Tapsin', 'Chile', 45, 1290, 'Observacion2'),
(3, 'Medicina', 'Bayer', 5, 9000000, 'Observo'),
(4, 'Medicinita', 'Ferre', 0, 90000001, 'Muy interesante'),
(5, 'Prueba', 'Chile', 30, 3500, 'Hola como estas'),
(6, 'Medicinota', 'Ferre', 2, 900900000, 'Hola   '),
(7, 'Carlos', 'Bayer', 300, 3000, 'Observando'),
(8, 'Carlosron', 'Chile', 1, 9000000, 'Otra prueba otra prueba'),
(9, 'Ultimo', 'Ferre', 50000, 300, 'Estoy haciendo una observacion,prueba de signos.');

-- --------------------------------------------------------

--
-- Table structure for table `laboratorio`
--

CREATE TABLE `laboratorio` (
  `cod_lab` int(5) NOT NULL,
  `lab_nombre` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laboratorio`
--

INSERT INTO `laboratorio` (`cod_lab`, `lab_nombre`) VALUES
(1, 'Bayer'),
(2, 'Chile'),
(3, 'Ferre'),
(4, 'Pharma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farmaco`
--
ALTER TABLE `farmaco`
  ADD PRIMARY KEY (`cod_far`);

--
-- Indexes for table `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`cod_lab`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmaco`
--
ALTER TABLE `farmaco`
  MODIFY `cod_far` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `cod_lab` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;