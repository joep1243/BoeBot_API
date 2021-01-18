-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 jan 2021 om 22:37
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boebot`
--
CREATE DATABASE IF NOT EXISTS `boebot` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `boebot`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bot_account`
--

CREATE TABLE `bot_account` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `API_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bot_account`
--

INSERT INTO `bot_account` (`ID`, `username`, `password`, `API_code`) VALUES
(1, 'bot1', 'bot1', 'bot1/0f315dd99813e24e62bf0a850c834452');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bot_route`
--

CREATE TABLE `bot_route` (
  `ID` int(11) NOT NULL,
  `BOT_ID` int(11) NOT NULL,
  `MAX_X` int(2) NOT NULL,
  `MAX_Y` int(2) NOT NULL,
  `start` text NOT NULL,
  `end` text NOT NULL,
  `blockade` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bot_route`
--

INSERT INTO `bot_route` (`ID`, `BOT_ID`, `MAX_X`, `MAX_Y`, `start`, `end`, `blockade`) VALUES
(1, 1, 15, 15, '0.0', '6.8', '[\"1,6\",\"2,2\",\"5,6\",\"2,6\",\"8,8\"]');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `temp_command`
--

CREATE TABLE `temp_command` (
  `ID` int(11) NOT NULL,
  `BOT_ID` int(11) NOT NULL,
  `command` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `temp_command`
--

INSERT INTO `temp_command` (`ID`, `BOT_ID`, `command`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `temp_log`
--

CREATE TABLE `temp_log` (
  `ID` int(11) NOT NULL,
  `BOT_ID` int(11) NOT NULL,
  `log` longtext NOT NULL,
  `diagnostics` longtext NOT NULL,
  `location` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `temp_log`
--

INSERT INTO `temp_log` (`ID`, `BOT_ID`, `log`, `diagnostics`, `location`, `updated_at`) VALUES
(1, 1, '{\"1\":\"begin\",\"2\":\"draai\",\"3\":\"hallo\"}', '{\"led\":\"false\",\"motor\":\"true\",\"sensor\":\"true\"}', '1.0', '2021-01-15 09:57:10');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_account`
--

CREATE TABLE `user_account` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user_account`
--

INSERT INTO `user_account` (`ID`, `username`, `password`) VALUES
(1, 'test', 'test'),
(2, 'joep', 'joepie');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bot_account`
--
ALTER TABLE `bot_account`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `bot_route`
--
ALTER TABLE `bot_route`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `temp_command`
--
ALTER TABLE `temp_command`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `temp_log`
--
ALTER TABLE `temp_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bot_account`
--
ALTER TABLE `bot_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `bot_route`
--
ALTER TABLE `bot_route`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `temp_command`
--
ALTER TABLE `temp_command`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `temp_log`
--
ALTER TABLE `temp_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `user_account`
--
ALTER TABLE `user_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
