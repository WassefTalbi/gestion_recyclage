-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 05:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khedma`
--

-- --------------------------------------------------------

--
-- Table structure for table `sous-metier`
--

CREATE TABLE `sous-metier` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `m-id` int(11) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sous-metier`
--

INSERT INTO `sous-metier` (`id`, `libelle`, `domaine`, `m-id`, `archive`) VALUES
(92, 'Entretien de voitures', 'Mécanique voiture', 55, 0),
(93, 'Entretien de la maison', 'Ménage', 55, 0),
(94, 'Réparation d\'appareils électroniques et informatique', 'Electronique', 56, 0),
(95, 'Entretien de moto', 'Mécanique moto', 55, 0),
(96, 'Entretien de vélo', 'Mécanique de vélo', 55, 0),
(97, 'Réparation d\'accessoires antiques', 'Vintage', 56, 0),
(98, 'Travaux ménagers', 'Ménage', 57, 0),
(99, 'Baby sitting', 'Prise en soin', 57, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sous-metier`
--
ALTER TABLE `sous-metier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m-id` (`m-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sous-metier`
--
ALTER TABLE `sous-metier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sous-metier`
--
ALTER TABLE `sous-metier`
  ADD CONSTRAINT `m-id` FOREIGN KEY (`m-id`) REFERENCES `metier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
