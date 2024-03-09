-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 08:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Profile` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`id`, `Username`, `Password`, `Profile`) VALUES
(1, 'REDA', 'password123', 'contact.png');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_br` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Brand_Name` varchar(255) NOT NULL,
  `Brand_Logo` varchar(255) NOT NULL,
  `Brand_Turnover` varchar(255) NOT NULL,
  `Business_area` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_br`, `Login`, `Brand_Name`, `Brand_Logo`, `Brand_Turnover`, `Business_area`, `Password`) VALUES
(4, 'maram', 'MA', 'accueil.jpeg', '3500$', 'markiting', '$2y$10$6W6AcO9dkpN8Q254zB1Mwe2obv9WsKN/HNBl4dw1exH5BkzOxgDN2'),
(5, 'ayat', 'DS', 'propos.png', '563$', 'Technologie', '$2y$10$wxFoLcDxmVY3UM3OQZiYxO7/OKSWXsx4E4A1MmH2GFeRAnxglAkkq');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'achraf hakim', 'achrafhakim@gmail.com', 'demande d\'information', 'je veux plus de details sur la localisation');

-- --------------------------------------------------------

--
-- Table structure for table `demande_suppression_br`
--

CREATE TABLE `demande_suppression_br` (
  `id` int(11) NOT NULL,
  `id_br` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demande_suppression_inf`
--

CREATE TABLE `demande_suppression_inf` (
  `id` int(10) NOT NULL,
  `id_inf` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demande_suppression_inf`
--

INSERT INTO `demande_suppression_inf` (`id`, `id_inf`) VALUES
(4, 5),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `influencer`
--

CREATE TABLE `influencer` (
  `id_inf` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Media` varchar(255) NOT NULL,
  `Profile_pic` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `influencer`
--

INSERT INTO `influencer` (`id_inf`, `Name`, `Username`, `Age`, `Media`, `Profile_pic`, `Password`) VALUES
(5, 'maria', 'maria', 23, 'mariagh@gmail.com', 'inflogin.jpg', '$2y$10$DJlvdjjd.cjIsULpi.y5KOR.fmAG6KOMPxZ3MOTj2qwL6GQ89qb8W'),
(6, 'sofia', 'sofia', 25, 'sofiadr', 'brand.jpg', '$2y$10$iiH8eZ.anow3gO93HMFlCOmtBHpo0xFtjvyEwqcJJ7gsC6gciLZUu');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `autour` varchar(255) NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `autour`, `destinataire`, `message`) VALUES
(22, 'ayat', 'maria', 'hello maria\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `partenariat`
--

CREATE TABLE `partenariat` (
  `id` int(11) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Influencer` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `Signature_inf` varchar(255) NOT NULL,
  `Signature_Brand` varchar(255) NOT NULL,
  `Brand_Login` varchar(255) NOT NULL,
  `Influencer_Login` varchar(255) NOT NULL,
  `Terme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partenariat`
--

INSERT INTO `partenariat` (`id`, `Brand`, `Influencer`, `amount`, `duration`, `Signature_inf`, `Signature_Brand`, `Brand_Login`, `Influencer_Login`, `Terme`) VALUES
(4, 'DS', 'maria', ' 250$', 4, 'S2png.png', 'S1.png', 'Ayat', 'maria', 'no condition');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_br`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demande_suppression_br`
--
ALTER TABLE `demande_suppression_br`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demande_suppression_inf`
--
ALTER TABLE `demande_suppression_inf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`id_inf`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partenariat`
--
ALTER TABLE `partenariat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_br` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `demande_suppression_br`
--
ALTER TABLE `demande_suppression_br`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `demande_suppression_inf`
--
ALTER TABLE `demande_suppression_inf`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id_inf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `partenariat`
--
ALTER TABLE `partenariat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
