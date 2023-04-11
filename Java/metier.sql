-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 05:36 PM
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
-- Table structure for table `metier`
--

CREATE TABLE `metier` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metier`
--

INSERT INTO `metier` (`id`, `nom`, `type`, `description`, `image`, `archive`) VALUES
(51, 'Couturère', 'Textile', '', 'C:\\\\Users\\\\Safe\\\\Documents\\\\NetBeansProjects\\\\khedma\\\\src\\\\Images\\\\couturière.jpg', 0),
(52, 'Déménagement et transport', 'Transport', 'Votre déménageur professionnel se charge du déroulement de votre déménagement et de transport et déménagement meuble international', 'C:\\\\Users\\\\Safe\\\\Documents\\\\NetBeansProjects\\\\khedma\\\\src\\\\Images\\\\dem.jpg', 0),
(55, 'Entretien', 'Entretien', 'Activité d\'entretien', 'C:\\\\Users\\\\Safe\\\\Documents\\\\NetBeansProjects\\\\khedma\\\\src\\\\Images\\\\femme-de-menage.jpg', 0),
(56, 'Réparation', 'Réparation', 'Activités de réparation', 'C:\\\\Users\\\\Safe\\\\Documents\\\\NetBeansProjects\\\\khedma\\\\src\\\\Images\\\\reparation-electroportatif-000675968-product_zoom.jpg', 0),
(57, 'Services à la personne', 'Services', 'Activités exercées à domicile', 'C:\\\\Users\\\\Safe\\\\Documents\\\\NetBeansProjects\\\\khedma\\\\src\\\\Images\\\\Services-a-la-personne-SAP_0.jpg', 0),
(58, 'aazdza', 'dqsdq', 'sqdqsdqsd', 'C:\\\\Users\\\\Safe\\\\Pictures\\\\images.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `metier`
--
ALTER TABLE `metier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `metier`
--
ALTER TABLE `metier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
