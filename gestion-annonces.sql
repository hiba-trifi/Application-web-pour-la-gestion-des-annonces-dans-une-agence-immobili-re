-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 12:15 PM
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
-- Database: `gestion-annonces`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonce`
--

CREATE TABLE `annonce` (
  `Id_ac` int(11) NOT NULL,
  `Titre` varchar(50) DEFAULT NULL,
  `Prix` double DEFAULT NULL,
  `Date_pub` date DEFAULT NULL,
  `Date_mod` date DEFAULT NULL,
  `Adresse` varchar(500) DEFAULT NULL,
  `Superficie` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `Id_cl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annonce`
--

INSERT INTO `annonce` (`Id_ac`, `Titre`, `Prix`, `Date_pub`, `Date_mod`, `Adresse`, `Superficie`, `ville`, `categorie`, `type`, `Id_cl`) VALUES
(20, '        bel Appartment  meublée', 10000000, '0000-00-00', '2023-02-25', 'Al awama Rue riha N 45°', 100, 'Marrakech', '      Location', 'Villa', 1),
(22, '       bel Appartment  meublée', 4525, '0000-00-00', '2023-02-27', 'Al awama Rue riha N 45°', 34234, 'Tanger', '     Location', 'Villa', 6),
(23, '  bel Appartment  meublée', 12500000, '2023-02-27', NULL, 'Al awama Rue riha N 45°', 85, 'Marrakech', 'Vente', 'Maison', 6);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Id_cl` int(11) NOT NULL,
  `Nom_cl` varchar(50) DEFAULT NULL,
  `Prenom_cl` varchar(50) DEFAULT NULL,
  `Email_cl` varchar(100) DEFAULT NULL,
  `Mot_passe` text DEFAULT NULL,
  `Num_Tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Id_cl`, `Nom_cl`, `Prenom_cl`, `Email_cl`, `Mot_passe`, `Num_Tel`) VALUES
(1, 'Dupont', 'Marie', 'marie.dupont@example.com', '$2y$10$Law.WW.mLIbPs04SCgoRsO6qPPpcz1lCF2u6WniJlM75tW1WbnQ/u', '5553111111'),
(6, 'hiba', 'trifi', 'trifi.hiba.solicode@gmail.com', '$2y$10$AM6gHRNk3inowFMoYcf37OgCkMAuCO4ELsRv12NWhQIAT3a.Tteaq', '0674439035'),
(7, 'zora', 'rora', 'zora.rora@exemple.com', '$2y$10$ZIhUv1f35LdRuWaDdlZMZ.5FYg/agoBRhzwPWl/AQ3hOUbpRf8SY.', '0674439035');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `Id_img` int(11) NOT NULL,
  `Titre_img` varchar(500) DEFAULT NULL,
  `img_Principale` bit(1) DEFAULT NULL,
  `Id_ac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`Id_img`, `Titre_img`, `img_Principale`, `Id_ac`) VALUES
(43, '1677162682-4.jpg', b'1', 20),
(46, '1677162682-11.jpg', b'1', 20),
(49, '1677162682-4.jpg', b'0', 20),
(62, '1677241443-4.jpg', b'1', 22),
(63, '1677241443-5.jpg', b'0', 22),
(65, '1677241443-12.jpg', b'0', 22),
(66, '1677241443-bkg.png', b'0', 22),
(67, '1677241443-bkgg.jpg', b'0', 22),
(75, '1677496049-1.jpg', b'1', 23),
(77, '1677496049-5.jpg', b'0', 23),
(79, '1677496049-9.jpg', b'0', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`Id_ac`),
  ADD KEY `Id_cl` (`Id_cl`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id_cl`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`Id_img`),
  ADD KEY `Id_ac` (`Id_ac`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `Id_ac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `Id_cl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `Id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`Id_cl`) REFERENCES `client` (`Id_cl`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`Id_ac`) REFERENCES `annonce` (`Id_ac`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
