-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 07:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skelbimai`
--
CREATE DATABASE IF NOT EXISTS `skelbimai` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci;
USE `skelbimai`;

-- --------------------------------------------------------

--
-- Table structure for table `gyvunai`
--

CREATE TABLE `gyvunai` (
  `gyvuno_id` int(40) NOT NULL,
  `vartotojo_id` int(40) NOT NULL DEFAULT 13,
  `kategorijos_id` int(40) NOT NULL DEFAULT 4,
  `vardas` varchar(50) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `amzius` date NOT NULL DEFAULT '2022-01-01',
  `dokumentacija` varchar(10) COLLATE utf8mb4_lithuanian_ci NOT NULL DEFAULT 'nėra',
  `aprasymas` varchar(800) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `foto_url` varchar(100) COLLATE utf8mb4_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `gyvunai`
--

INSERT INTO `gyvunai` (`gyvuno_id`, `vartotojo_id`, `kategorijos_id`, `vardas`, `amzius`, `dokumentacija`, `aprasymas`, `foto_url`) VALUES
(1, 1, 1, 'Micius', '2020-04-01', '2', 'Labai myli vaikus', ''),
(2, 9, 2, 'Rikas', '2020-10-14', '1', 'Galėtų būti puikus vyresnio amžiaus žmogaus draugas!', ''),
(3, 13, 1, 'Rainė', '2022-01-01', 'nėra', '', 'kate raine.jpg'),
(4, 13, 2, 'Vizgis', '2021-01-02', 'yra', '', 'linksmas suo vizgis.jpg'),
(5, 13, 1, 'Žydrė', '2020-05-19', 'nėra', '', 'pilka kate zydre.webp'),
(6, 13, 2, 'Brisius', '2018-05-16', 'nėra', '', 'suo sargas brisius.jpg'),
(7, 13, 4, 'Snapė', '2021-09-22', 'nėra', '', 'pilka papuga snape.webp');

-- --------------------------------------------------------

--
-- Table structure for table `kategorijos`
--

CREATE TABLE `kategorijos` (
  `kategorijos_id` int(40) NOT NULL,
  `kategorija` varchar(40) COLLATE utf8mb4_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `kategorijos`
--

INSERT INTO `kategorijos` (`kategorijos_id`, `kategorija`) VALUES
(1, 'Katės'),
(2, 'Šunys'),
(3, 'Ropliai'),
(4, 'Kiti_gyvunai');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai`
--

CREATE TABLE `vartotojai` (
  `vartotojo_id` int(40) NOT NULL,
  `vardas` varchar(50) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `el_pastas` varchar(50) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `slaptazodis` varchar(30) COLLATE utf8mb4_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `vartotojai`
--

INSERT INTO `vartotojai` (`vartotojo_id`, `vardas`, `el_pastas`, `slaptazodis`) VALUES
(1, 'lrable20', 'slillow0@goo.ne.jp', 'YQPtlcVnS'),
(2, 'kedworthie7', 'enoseworthy7@zimbio.com', 'xdUKXZIrxQN'),
(3, 'mwogan0', 'chuban0@google.cn', 'tHXayIZFZLc'),
(4, 'kdmitr1', 'rwondraschek1@g.co', 'NhMOZigF'),
(5, 'gblague2', 'bcastel2@dyndns.org', '9re98ea'),
(6, 'dwillishire3', 'creiling3@apple.com', 'PEoYBE5HgS'),
(7, 'csailer4', 'mjasik4@patch.com', 'n1Cyh8KcXVWG'),
(8, 'lmowsdale5', 'hbellingham5@dmoz.org', '7CYrX9UEmsoK'),
(9, 'kkippen6', 'phynd6@webeden.co.uk', 'xU34W0bf'),
(10, 'kedworthie7', 'enoseworthy7@zimbio.com', 'xdUKXZIrxQN'),
(11, 'vgoodered8', 'smiroy8@bbb.org', 'VDAR11PSO5'),
(12, 'meagan9', 'ebromehead9@stanford.edu', 'dGSw9GuXjf'),
(13, 'administratorius', 'admin@BestAnimals.lt', 'BestAnimals');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gyvunai`
--
ALTER TABLE `gyvunai`
  ADD PRIMARY KEY (`gyvuno_id`),
  ADD KEY `gyvunai_ibfk_1` (`kategorijos_id`),
  ADD KEY `gyvunai_ibfk_3` (`vartotojo_id`);

--
-- Indexes for table `kategorijos`
--
ALTER TABLE `kategorijos`
  ADD PRIMARY KEY (`kategorijos_id`);

--
-- Indexes for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD PRIMARY KEY (`vartotojo_id`),
  ADD KEY `vartotojo_id` (`vartotojo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gyvunai`
--
ALTER TABLE `gyvunai`
  MODIFY `gyvuno_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategorijos`
--
ALTER TABLE `kategorijos`
  MODIFY `kategorijos_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `vartotojo_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gyvunai`
--
ALTER TABLE `gyvunai`
  ADD CONSTRAINT `gyvunai_ibfk_1` FOREIGN KEY (`kategorijos_id`) REFERENCES `kategorijos` (`kategorijos_id`),
  ADD CONSTRAINT `gyvunai_ibfk_3` FOREIGN KEY (`vartotojo_id`) REFERENCES `vartotojai` (`vartotojo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
