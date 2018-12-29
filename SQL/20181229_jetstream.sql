-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql.jetstream.christianpetri.ch
-- Erstellungszeit: 29. Dez 2018 um 04:58
-- Server-Version: 5.6.34-log
-- PHP-Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `jetstream`
--

DELIMITER $$
--
-- Prozeduren
--
CREATE DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` PROCEDURE `ptest` (IN `test` INT(100), OUT `param1` INT)  NO SQL
SELECT COUNT(*) INTO param1 FROM test$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dienstleistung`
--

CREATE TABLE `dienstleistung` (
  `dienstleistung_id` int(11) UNSIGNED NOT NULL,
  `dienstleistung_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `dienstleistung`
--

INSERT INTO `dienstleistung` (`dienstleistung_id`, `dienstleistung_name`) VALUES
(10, 'Bindung montieren und einstellen'),
(11, 'Fell zuschneiden'),
(8, 'Grosser Service'),
(12, 'Heisswachen'),
(7, 'Kleiner Service'),
(9, 'Rennski-Service');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `prioritaet`
--

CREATE TABLE `prioritaet` (
  `prioritaet_id` int(11) UNSIGNED NOT NULL,
  `prioritaet_name` varchar(45) NOT NULL,
  `prioritaet_zusaetzliche_tage` varchar(45) NOT NULL,
  `prioritaet_tage_bis_zur_fertigstellung` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `prioritaet`
--

INSERT INTO `prioritaet` (`prioritaet_id`, `prioritaet_name`, `prioritaet_zusaetzliche_tage`, `prioritaet_tage_bis_zur_fertigstellung`) VALUES
(4, 'Tief', '5', '12'),
(5, 'Standard', '0', '7'),
(6, 'Express', '-3', '4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `serviceauftrag`
--

CREATE TABLE `serviceauftrag` (
  `serviceauftrag_id` int(11) UNSIGNED NOT NULL,
  `serviceauftrag_kundenname` varchar(45) NOT NULL,
  `serviceauftrag_email` varchar(45) DEFAULT NULL,
  `serviceauftrag_telefon` varchar(45) DEFAULT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `dienstleistung_id` int(11) UNSIGNED NOT NULL,
  `prioritaet_id` int(11) UNSIGNED NOT NULL,
  `serviceauftrag_erfassungsdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `serviceauftrag`
--

INSERT INTO `serviceauftrag` (`serviceauftrag_id`, `serviceauftrag_kundenname`, `serviceauftrag_email`, `serviceauftrag_telefon`, `status_id`, `dienstleistung_id`, `prioritaet_id`, `serviceauftrag_erfassungsdatum`) VALUES
(1, 'Christian Petri', 'hallo@example.com', '079 787 25 02', 4, 8, 6, '2018-12-22 15:48:25'),
(3, 'Christian Petri', 'm@j.com', '00329999', 4, 8, 6, '2018-12-28 16:17:31'),
(4, 'Peter', 'peter@example.com', '90124', 4, 12, 6, '2018-12-28 16:29:55'),
(5, 'Walter', 'r@f.com', '234', 3, 10, 6, '2018-12-28 16:30:49'),
(6, 'adsf', 'asdf#asdf@c.com', '123', 4, 10, 4, '2018-12-28 16:31:15'),
(7, 'j', '', '9034', 4, 7, 5, '2018-12-28 16:31:43'),
(8, 'Walter', 'Walter@example.com', '023432342344', 3, 10, 5, '2018-12-28 17:22:09'),
(12, 'Walter Violet', 'a@a.com', '079 795 14 12', 3, 11, 4, '2018-12-28 17:43:40'),
(13, 'k', 'n@n.com', '', 3, 8, 5, '2018-12-28 18:16:08');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE `status` (
  `status_id` int(11) UNSIGNED NOT NULL,
  `status_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(4, 'ABGESCHLOSSEN'),
(3, 'PENDENT');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `test`
--

CREATE TABLE `test` (
  `test_id` int(10) UNSIGNED NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `test_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `test`
--

INSERT INTO `test` (`test_id`, `test_name`, `test_timestamp`, `test_number`) VALUES
(1, 'Welt', '2018-12-27 11:17:31', 123),
(2, 'Hallo', '2018-12-27 11:17:38', 18),
(3, 'Hallo', '2018-12-27 11:22:42', 18),
(4, 'Welt', '2018-12-27 11:23:19', 4),
(5, 'Hallo', '2018-12-27 11:26:14', 18),
(6, 'Welt', '2018-12-27 11:31:56', 6),
(7, 'Hallo', '2018-12-27 11:35:50', 18),
(8, 'Hallo', '2018-12-27 11:37:13', 18),
(9, 'Hallo', '2018-12-27 11:43:03', 18),
(10, 'Hallo', '2018-12-27 11:44:07', 18),
(11, 'Hallo', '2018-12-27 11:44:57', 18),
(12, 'Hallo', '2018-12-27 11:45:13', 18);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_dienstleistung`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_dienstleistung` (
`dienstleistung_id` int(11) unsigned
,`dienstleistung_name` varchar(45)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_prioritaet`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_prioritaet` (
`prioritaet_id` int(11) unsigned
,`prioritaet_name` varchar(45)
,`prioritaet_zusaetzliche_tage` varchar(45)
,`prioritaet_tage_bis_zur_fertigstellung` varchar(45)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_serviceauftrag`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_serviceauftrag` (
`serviceauftrag_id` int(11) unsigned
,`serviceauftrag_kundenname` varchar(45)
,`serviceauftrag_telefon` varchar(45)
,`serviceauftrag_email` varchar(45)
,`status_name` varchar(45)
,`prioritaet_name` varchar(45)
,`dienstleistung_name` varchar(45)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_status`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_status` (
`status_id` int(11) unsigned
,`status_name` varchar(45)
);

-- --------------------------------------------------------

--
-- Struktur des Views `v_dienstleistung`
--
DROP TABLE IF EXISTS `v_dienstleistung`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` SQL SECURITY DEFINER VIEW `v_dienstleistung`  AS  select `dienstleistung`.`dienstleistung_id` AS `dienstleistung_id`,`dienstleistung`.`dienstleistung_name` AS `dienstleistung_name` from `dienstleistung` ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_prioritaet`
--
DROP TABLE IF EXISTS `v_prioritaet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` SQL SECURITY DEFINER VIEW `v_prioritaet`  AS  select `prioritaet`.`prioritaet_id` AS `prioritaet_id`,`prioritaet`.`prioritaet_name` AS `prioritaet_name`,`prioritaet`.`prioritaet_zusaetzliche_tage` AS `prioritaet_zusaetzliche_tage`,`prioritaet`.`prioritaet_tage_bis_zur_fertigstellung` AS `prioritaet_tage_bis_zur_fertigstellung` from `prioritaet` ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_serviceauftrag`
--
DROP TABLE IF EXISTS `v_serviceauftrag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` SQL SECURITY DEFINER VIEW `v_serviceauftrag`  AS  select `serviceauftrag`.`serviceauftrag_id` AS `serviceauftrag_id`,`serviceauftrag`.`serviceauftrag_kundenname` AS `serviceauftrag_kundenname`,`serviceauftrag`.`serviceauftrag_telefon` AS `serviceauftrag_telefon`,`serviceauftrag`.`serviceauftrag_email` AS `serviceauftrag_email`,`status`.`status_name` AS `status_name`,`prioritaet`.`prioritaet_name` AS `prioritaet_name`,`dienstleistung`.`dienstleistung_name` AS `dienstleistung_name` from (((`serviceauftrag` left join `status` on((`serviceauftrag`.`status_id` = `status`.`status_id`))) left join `prioritaet` on((`serviceauftrag`.`prioritaet_id` = `prioritaet`.`prioritaet_id`))) left join `dienstleistung` on((`serviceauftrag`.`dienstleistung_id` = `dienstleistung`.`dienstleistung_id`))) order by (`serviceauftrag`.`serviceauftrag_erfassungsdatum` + interval `prioritaet`.`prioritaet_tage_bis_zur_fertigstellung` day) ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_status`
--
DROP TABLE IF EXISTS `v_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` SQL SECURITY DEFINER VIEW `v_status`  AS  select `status`.`status_id` AS `status_id`,`status`.`status_name` AS `status_name` from `status` ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `dienstleistung`
--
ALTER TABLE `dienstleistung`
  ADD PRIMARY KEY (`dienstleistung_id`),
  ADD UNIQUE KEY `dienstleistung_name_UNIQUE` (`dienstleistung_name`);

--
-- Indizes für die Tabelle `prioritaet`
--
ALTER TABLE `prioritaet`
  ADD PRIMARY KEY (`prioritaet_id`),
  ADD UNIQUE KEY `prioritaet_name_UNIQUE` (`prioritaet_name`);

--
-- Indizes für die Tabelle `serviceauftrag`
--
ALTER TABLE `serviceauftrag`
  ADD PRIMARY KEY (`serviceauftrag_id`,`status_id`,`dienstleistung_id`,`prioritaet_id`),
  ADD KEY `fk_serviceauftrag_status_idx` (`status_id`),
  ADD KEY `fk_serviceauftrag_dienstleistung1_idx` (`dienstleistung_id`),
  ADD KEY `fk_serviceauftrag_prioritaet1_idx` (`prioritaet_id`);

--
-- Indizes für die Tabelle `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status_name_UNIQUE` (`status_name`);

--
-- Indizes für die Tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `dienstleistung`
--
ALTER TABLE `dienstleistung`
  MODIFY `dienstleistung_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `prioritaet`
--
ALTER TABLE `prioritaet`
  MODIFY `prioritaet_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `serviceauftrag`
--
ALTER TABLE `serviceauftrag`
  MODIFY `serviceauftrag_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `serviceauftrag`
--
ALTER TABLE `serviceauftrag`
  ADD CONSTRAINT `fk_serviceauftrag_dienstleistung1` FOREIGN KEY (`dienstleistung_id`) REFERENCES `dienstleistung` (`dienstleistung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_serviceauftrag_prioritaet1` FOREIGN KEY (`prioritaet_id`) REFERENCES `prioritaet` (`prioritaet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_serviceauftrag_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
