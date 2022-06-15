-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db_mysql
-- Generation Time: Jun 14, 2022 at 11:31 AM
-- Server version: 8.0.28
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_score`
--
CREATE DATABASE IF NOT EXISTS `game_score` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `game_score`;

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

DROP TABLE IF EXISTS `Team`;
CREATE TABLE `Team` (
  `IdTeam` int NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`IdTeam`, `Name`, `Date`) VALUES
(1, 'Brazil', '2022-06-11 14:58:00'),
(2, 'England', '2022-06-11 14:58:00'),
(3, 'France', '2022-06-12 16:17:56'),
(4, 'Uruguay', '2022-06-12 16:17:56'),
(5, 'Ukraine', '2022-06-12 16:18:10'),
(6, 'Russia', '2022-06-12 16:18:10'),
(7, 'Spain', '2022-06-12 16:18:34'),
(8, 'Portugal', '2022-06-12 16:18:34'),
(9, 'Japan', '2022-06-12 16:18:48'),
(10, 'Korea', '2022-06-12 16:18:48'),
(11, 'Australia', '2022-06-12 16:18:58'),
(12, 'Vietnam', '2022-06-12 16:18:58'),
(13, 'Cameroun', '2022-06-12 16:19:33'),
(14, 'Ivory coast', '2022-06-12 16:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `Game`
--

DROP TABLE IF EXISTS `Game`;
CREATE TABLE `Game` (
  `IdGame` int NOT NULL,
  `IdTeam1` int NOT NULL,
  `IdTeam2` int NOT NULL,
  `Score` varchar(10) DEFAULT '0;0',
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Game`
--

INSERT INTO `Game` (`IdGame`, `IdTeam1`, `IdTeam2`, `Score`, `Date`) VALUES
(1, 2, 6, '0;0', '2022-06-14 01:35:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Game`
--
ALTER TABLE `Game`
  ADD PRIMARY KEY (`IdGame`),
  ADD KEY `IdTeam_idx` (`IdTeam1`),
  ADD KEY `IdTeam2_idx` (`IdTeam2`);

--
-- Indexes for table `Team`
--
ALTER TABLE `Team`
  ADD PRIMARY KEY (`IdTeam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Game`
--
ALTER TABLE `Game`
  MODIFY `IdGame` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `Team`
--
ALTER TABLE `Team`
  MODIFY `IdTeam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Game`
--
ALTER TABLE `Game`
  ADD CONSTRAINT `IdTeam1` FOREIGN KEY (`IdTeam1`) REFERENCES `Team` (`IdTeam`),
  ADD CONSTRAINT `IdTeam2` FOREIGN KEY (`IdTeam2`) REFERENCES `Team` (`IdTeam`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
