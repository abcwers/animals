-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 07:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gyvuneliu_prieglauda`
--
-- duomenų bazės sukūrimas

CREATE DATABASE IF NOT EXISTS `gyvuneliu_prieglauda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci;
USE `gyvuneliu_prieglauda`;

-- duomenu bazės vartotojo sukūrimas

CREATE USER IF NOT EXISTS prieglaudos_admin IDENTIFIED BY 'slaptazodis2022';
GRANT SELECT, INSERT, UPDATE, DELETE ON gyvuneliu_prieglauda.* TO prieglaudos_admin;

-- --------------------------------------------------------



--
-- Table structure for table `gyvunai`
--

CREATE TABLE `gyvunai` (
  `gyvuno_id` int(40) NOT NULL,
  `vartotojo_id` int(40) NOT NULL,
  `kategorijos_id` int(40) NOT NULL,
  `vardas` varchar(50) NOT NULL,
  `amzius` date NOT NULL,
  `dokumentacija` varchar(10) NOT NULL,
  `aprasymas` varchar(800) NOT NULL,
  `foto_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gyvunai`
--

INSERT INTO `gyvunai` (`gyvuno_id`, `vartotojo_id`, `kategorijos_id`, `vardas`, `amzius`, `dokumentacija`, `aprasymas`, `foto_url`) VALUES
(1, 1, 1, 'Rainė', date '2021-08-03', 'yra', 'Labai myli vaikus. Miela ir švelni. Žaisminga bei tvarkinga.', 'kate_raine.jpg'),
(2, 9, 1, 'Žydrė', date '2012-11-15', 'nėra', 'Atvyko į prieglaudą iš mažo kaimelio. Ji vyresnio amžiaus. Neišpasakyto meilumo ir švelnumo. Tokia mielutė susirangys šalia ir saugos tave. Labai tvarkinga. Ramaus būdo. Grakšti, smulki katytė. Reikia namų, kur galėtų gyventi be kitų kačių.', 'pilka_kate_zydre.webp'),
(3, 3, 2, 'Vizgis', date '2020-12-13', 'yra', 'Labai energingas, žaismingas. Su vaikais puikiai sutaria, tik ne tuo metu, kai ėda. Pateko į prieglaudą su žaizda ant kaklo. Šiuo metu žaizda dar tik gyja, bet kitą mėnesį jau bus pasiruošęs keliauti į naujus namus!', 'linksmas_suo_vizgis.jpg'),
(4, 11, 5, 'Snapė', date '2022-01-01', 'yra', 'Jauna, žavi, pasyvi papūgėlė. Mėgsta skraidyti ir namie, ir lauke. Sugrįžta pašaukus vardu.', 'pilka_papuga_snape.webp'),
(5, 15, 4, 'Ačkis', date '2021-04-27', 'yra', 'Baikštus, ramaus būdo. Buvo rastas šaltą žiemos rytą po automobiliu. Ieško namų, kuriuose turėtų savo atskirą kampelį.', 'pilkas_zuikis_ackis.jpeg'),
(6, 4, 2, 'Brisius', date '2016-10-16', 'nėra', 'Gyvenęs prie būdos. Šeimininkui patekus į ligoninę, žmonės ėmė ieškoti jam prieglobsčio. Nebaikštus, prieraišus.', 'suo_sargas_brisius.jpg'),
(7, 8, 4, 'Amfora', date '2021-07-19', 'yra', 'Judri, nebaiksti. Leidžiasi imama ant rankų. Labai mėgsta sukti ratą naktimis, tad reikalinga atskira patalpa, kad nežadintų Jūsų.', 'degu_amfora.jpg'),
(8, 12, 3, 'Nimfėja', date '2020-01-10', 'yra', 'Labai retas, ilgaamžis, įspūdingo kiauto rašto. Valgo mažai, daug priežiūros nereikalaauja. Nemėgsta tamsos.', 'vezlys_nimfeja.jpg'),
(9, 2, 2, 'Gurgis', date '2017-11-24', 'yra', 'Žaismingas, vikrus. Puikiai sutaria ir su vaikais, ir su kitais gyvūnėliais. Mėgsta ilgus pasivaikščiojimus lauke. Vykdo kelias komandas.', 'suo_gurgis.jpg'),
(10, 10, 2, 'Norgas', date '2021-08-03', 'nėra', 'Naminis, ypatingai meilus šunytis. Vykdo kelias komandas. Būtų puikus šeimos draugas gausioje šeimoje, nes reikalauja daug paglostukų. ', 'suo_norgas.jpg'),
(11, 5, 2, 'Prima', date '2020-10-09', 'yra', 'Labai myli vaikus. Miela ir švelni. Žaisminga bei tvarkinga.', 'suo_prima.jpg'),
(12, 14, 1, 'Dora', date '2021-05-19', 'yra', 'Neišpasakyto grožio, gilaus žvilgsnio savininkė. Nesutaria su vaikais. Buvo lūžusi galinė koja, bet jau sugijo, tad yra pasiruošusi keliauti į naujus namus!', 'kate_dora.jpg'),
(13, 6, 1, 'Gilutis', date '2015-09-18', 'yra', 'Žavus savo paprastumu. Tvarkingas, nesileidžia imamas ant rankų. Labiausiai džiaugtųsi, jeigu rastu namus, kuriuose galėtų laisvai vaikščioti lauke.', 'katinas_gilutis.jpg'),
(14, 13, 1, 'Čaras', date '2019-03-03', 'nėra', 'Šis pukuotukas pripildys Jūsų namus savo šiluma bei meiumu. yra atsargus, labai draugiškai elgiasi su vaikais. Buvo daryta ausies operacija.', 'katinas_caras.jpg'),
(15, 7, 1, 'Kumanė', date '2021-08-03', 'yra', 'Veislinė, tvarkinga, nebaikšti. Nemėgsta vaikų. Kailis reikalauja ypatingos priežiūros. ', 'kate_kumane.jpg'),
(16, 13, 3, 'Diana', date '2019-04-25', 'nėra', '', 'Diana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategorijos`
--

CREATE TABLE `kategorijos` (
  `kategorijos_id` int(40) NOT NULL,
  `kategorija` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorijos`
--

INSERT INTO `kategorijos` (`kategorijos_id`, `kategorija`) VALUES
(1, 'Katės'),
(2, 'Šunys'),
(3, 'Ropliai'),
(4, 'Graužikai'),
(5, 'Paukščiai'),
(6, 'Kiti_gyvunai');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai`
--

CREATE TABLE `vartotojai` (
  `vartotojo_id` int(40) NOT NULL,
  `vardas` varchar(50) NOT NULL,
  `el_pastas` varchar(50) NOT NULL,
  `slaptazodis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(13, 'administratorius', 'admin@BestAnimals.lt', 'BestAnimals'),
(14, 'biggonton', 'putlonter4@gmail.com', 'KbkNKer3s4'),
(15, 'nickolet', 'shelteron22@sa.co', 'ndjrGlsm5KWn7');

--
-- Indexes for dumped tables
--

--

--
-- Indexes for table `gyvunai`
--
ALTER TABLE `gyvunai`
  ADD PRIMARY KEY (`gyvuno_id`);

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

--

--
-- AUTO_INCREMENT for table `gyvunai`
--
ALTER TABLE `gyvunai`
  MODIFY `gyvuno_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorijos`
--
ALTER TABLE `kategorijos`
  MODIFY `kategorijos_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `vartotojo_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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