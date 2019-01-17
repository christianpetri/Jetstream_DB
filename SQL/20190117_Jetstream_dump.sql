-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql.jetstream.christianpetri.ch
-- Erstellungszeit: 17. Jan 2019 um 07:07
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
CREATE DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` PROCEDURE `spAddServiceauftrag` (IN `serviceauftragKundenname` VARCHAR(255), IN `serviceauftragEmail` VARCHAR(255), IN `serviceauftragTelefon` VARCHAR(255), IN `statusId` INT UNSIGNED, IN `dienstleistungId` INT UNSIGNED, IN `prioritaetId` INT UNSIGNED)  MODIFIES SQL DATA
INSERT INTO `serviceauftrag` 
                (
                    `serviceauftrag_kundenname` ,
                    `serviceauftrag_email`,
                    `serviceauftrag_telefon`,
                    `status_id`,    
                    `dienstleistung_id`,
                    `prioritaet_id`
                        
                )
                VALUES                      
                 (
                    serviceauftragKundenname,
                    serviceauftragEmail  ,
                    serviceauftragTelefon,
                    statusId,
                    dienstleistungId,
                    prioritaetId
                )$$

CREATE DEFINER=`jetstream`@`66.33.192.0/255.255.224.0` PROCEDURE `spUpdateServiceauftrag` (IN `serviceauftragKundenname` VARCHAR(255), IN `serviceauftragEmail` VARCHAR(255), IN `serviceauftragTelefon` VARCHAR(255), IN `statusId` INT, IN `serviceauftragId` INT)  MODIFIES SQL DATA
UPDATE `serviceauftrag`
                SET
                    `serviceauftrag_kundenname`  = serviceauftragKundenname,
                    `serviceauftrag_email`       = serviceauftragEmail,
                    `serviceauftrag_telefon`     = serviceauftragTelefon,
                    `status_id`                  = statusId
                WHERE 
                    `serviceauftrag_id`           = serviceauftragId$$

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
(3, 'Max Wälti', 'max@jam.com', '058 633 25 99', 4, 8, 6, '2018-12-28 16:17:31'),
(4, 'Peter', 'peter@example.com', '056 298 54 12', 4, 12, 6, '2018-12-28 16:29:55'),
(5, 'Walter', 'walter@bluewin.ch', '012 298 46 89', 3, 10, 6, '2018-12-28 16:30:49'),
(6, 'Kira', 'kira@smile.com', '+1 56 898 22 22', 4, 10, 4, '2018-12-28 16:31:15'),
(7, 'Johann', 'johann@example.com', '057 968 11 65', 4, 7, 5, '2018-12-28 16:31:43'),
(8, 'Walter', 'Walter@example.com', '023432342344', 3, 10, 5, '2018-12-28 17:22:09'),
(12, 'Tony', 'tony@stark.com', '079 795 14 12', 3, 11, 4, '2018-12-28 17:43:40'),
(13, 'Karl', 'karl@cruiseship.com', '+44 85 666 98 52', 4, 8, 5, '2018-12-28 18:16:08'),
(18, 'Garbiel', 'gab@web.de', '+48 698 55 41', 4, 8, 4, '2018-12-29 13:07:54'),
(19, 'u', 'u@u.com', '2341234', 3, 12, 5, '2018-12-29 13:23:48'),
(20, 'aa', 'a@a.com', '444', 3, 11, 6, '2018-12-29 13:24:22'),
(21, 'Stefan', 'stefan@example.com', '0041 45 322 77 99', 3, 8, 5, '2018-12-29 16:51:15'),
(31, 'sdf', 'frs@uuj', '', 3, 12, 5, '2019-01-17 14:38:51');

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
  MODIFY `serviceauftrag_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
