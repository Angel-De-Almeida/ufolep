-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 17 mai 2021 à 14:55
-- Version du serveur :  10.3.27-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `btssio17_ufolep`
--
CREATE DATABASE IF NOT EXISTS `btssio17_ufolep` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `btssio17_ufolep`;

-- --------------------------------------------------------

--
-- Structure de la table `arbitre`
--

CREATE TABLE `arbitre` (
  `idArbitre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `arbitre`
--

INSERT INTO `arbitre` (`idArbitre`) VALUES
(1),
(12),
(15),
(18),
(19),
(31),
(34),
(35),
(62),
(70),
(76),
(77),
(80);

-- --------------------------------------------------------

--
-- Structure de la table `championnat`
--

CREATE TABLE `championnat` (
  `idChampionnat` int(11) NOT NULL,
  `nomChampionnat` varchar(64) NOT NULL,
  `typeChampionnat` enum('Départemental','Régional','National') NOT NULL COMMENT 'Ex : départemental, régional, etc.',
  `idDivision` int(11) NOT NULL,
  `nomPoule` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `championnat`
--

INSERT INTO `championnat` (`idChampionnat`, `nomChampionnat`, `typeChampionnat`, `idDivision`, `nomPoule`) VALUES
(1, 'Championnat 2020', 'Départemental', 1, NULL),
(2, 'Championnat 2020', 'Départemental', 2, 'A'),
(3, 'Championnat 2020', 'Départemental', 2, 'B');

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `idClub` int(11) NOT NULL,
  `nomClub` varchar(64) NOT NULL,
  `sponsor` varchar(64) NOT NULL,
  `nomSalle` varchar(128) NOT NULL,
  `adresseSalle` varchar(128) NOT NULL,
  `idVille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`idClub`, `nomClub`, `sponsor`, `nomSalle`, `adresseSalle`, `idVille`) VALUES
(1, 'Breuil-Magné', 'Carrefour', 'Salle des sports', 'Complexe sportif du Grand Logis(après le terrain de football) Rue du stade', 1),
(2, 'Tulle ', 'Intermarché', '', '', 2),
(3, 'Rochefort', 'Auchan', '', '', 5),
(4, 'Marans / Courcon', '', 'Gymnase intercommunal', 'Avenue du Général De Gaulle', 7),
(5, 'Benon', '', 'Salle des fêtes Parc du château', 'Rue du château Musset', 8),
(7, 'Bords', '', 'Salle des halles', 'Place Saint-Vivien', 9),
(8, 'Burie', '', 'Club de tennis de table de Bue', 'Route du bois Barre', 10),
(9, 'Loisirs Solinois', '', 'Maison des Associations', 'Rue de l Aunis', 11),
(10, 'Smash LR', '', 'Salle France Vatré', 'Rue du vélodrome', 12),
(11, 'St Hippolyte', '', 'Salle des fêtes', 'Place Eugène Laugraud', 13);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idCompte` int(11) NOT NULL,
  `identifiant` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'Hash (BCrypt)',
  `typeCompte` enum('ARBITRE','GÉRANT') NOT NULL COMMENT 'Définit le type du compte.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `identifiant`, `password`, `typeCompte`) VALUES
(1, 'castillo', '$2y$10$qDxndfNCRftCI1jPVuFBwewbNEPfUE/lJ3qJ7hEW75Cwk10BTu2Ae', 'ARBITRE'),
(12, 'tessiert', '$2y$10$wjJFnjalY3CeZThSo0Lt2u/m2U3kKs.LOQCGskh.aHlt/CpT.rfO6', 'ARBITRE'),
(15, 'bonneauc', '$2y$10$Mt883eZL3uL.5dwEzAt2Vu6JbtngzXzfVzBko10wuthYBb1FD11IO', 'ARBITRE'),
(18, 'favreaud', '$2y$10$lppgoIjXEg6Xm.qZyqrTc.Bw86N16Qzj8Rh7nwHROT8tB9WHewppm', 'ARBITRE'),
(19, 'guillota', '$2y$10$bwW6SqCr6aNj7UsCAlXEoOJwuA1.7o0Af3WXQEZRwR7zXukxn5CTW', 'ARBITRE'),
(31, 'bourreaud', '$2y$10$bhwJwNFZsgWJWzs.mMt6X.3vSThda8q3N1oxgceKqx3RyXiMz4iJa', 'ARBITRE'),
(34, 'grassetn', '$2y$10$wZSy17gn7ZIjd73WNbnGsuoF/wcKGTEpeE266F0xE/QSR4vRkB9Ra', 'ARBITRE'),
(35, 'grattons', '$2y$10$fwJdELoKwceV.dj6FYVcLepAzzjcYEj6gDrKdCmhRSL.bbsmbUV.a', 'ARBITRE'),
(62, 'jolyj', '$2y$10$bhTgZ520VZ/uO8Qg4aSkQuw72EuidKSNe16AAoeLXiUYXMSWvigSW', 'ARBITRE'),
(70, 'gautierb', '$2y$10$GZSJfBV8i6RRbaCSsQEjxOZ6gtgBG0akgGHQooyuRqrVz1l2zj8re', 'ARBITRE'),
(76, 'giretm', '$2y$10$HoSDDhZ7EjWfrtKPC8pK1uK5SWhpoAtnM1M5DdDZlniT2tVJJfklW', 'ARBITRE'),
(77, 'giretp', '$2y$10$i/wpXBt902rcAvgL8FUemOZxIArfRA.SkXaIGcUaq8.XxAi4Hb03q', 'ARBITRE'),
(80, 'retailleaur', '$2y$10$msYb.2cSEn/I8LCu6zg.uuRsAzgHfIDD0kRac8b08UAHdnAbA1qsO', 'ARBITRE'),
(81, 'test', '$2y$10$MpDcWez7/EX1dAQg2PEq5.YwU58ln81sJNTfOxEASMQ..tMKTO2wq', 'GÉRANT');

-- --------------------------------------------------------

--
-- Structure de la table `detailmatch`
--

CREATE TABLE `detailmatch` (
  `idMatch` int(11) NOT NULL,
  `pointsA` int(11) NOT NULL,
  `pointsB` int(11) NOT NULL,
  `idJR` int(11) NOT NULL,
  `idJV` int(11) NOT NULL,
  `idRencontre` int(11) NOT NULL,
  `M1` int(11) DEFAULT NULL,
  `M2` int(11) DEFAULT NULL,
  `M3` int(11) DEFAULT NULL,
  `M4` int(11) DEFAULT NULL,
  `M5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detailmatch`
--

INSERT INTO `detailmatch` (`idMatch`, `pointsA`, `pointsB`, `idJR`, `idJV`, `idRencontre`, `M1`, `M2`, `M3`, `M4`, `M5`) VALUES
(12, 1, 0, 8, 43, 32, 5, -5, 12, -5, 4),
(13, 0, 1, 84, 46, 32, 7, 8, 8, 0, 0),
(14, 0, 1, 1, 45, 32, 7, 2, 2, 0, 0),
(15, 0, 1, 84, 43, 32, -3, -3, -2, 0, 0),
(16, 1, 0, 8, 45, 32, 8, 8, 8, 0, 0),
(17, 0, 1, 1, 46, 32, 8, 8, 7, 0, 0),
(18, 1, 0, 84, 45, 32, -9, -1, -3, 0, 0),
(19, 0, 1, 1, 43, 32, -1, -3, 8, 8, 8),
(20, 1, 0, 8, 46, 32, 8, 4, 2, 0, 0),
(37, 0, 0, 16, 10, 15, 3, 4, 8, 0, 0),
(38, 0, 0, 19, 9, 15, -2, -2, -2, 0, 0),
(39, 0, 0, 18, 12, 15, -5, 8, 4, -12, 2),
(40, 0, 0, 16, 9, 15, -4, 4, -3, 3, -5),
(41, 0, 0, 19, 12, 15, 1, 12, 15, 0, 0),
(42, 0, 0, 18, 10, 15, 8, 8, 8, 0, 0),
(43, 0, 0, 16, 12, 15, 7, 5, 1, 0, 0),
(44, 0, 0, 19, 10, 15, 2, 3, 6, 0, 0),
(45, 0, 0, 18, 9, 15, 7, 7, 9, 0, 0),
(46, 1, 0, 33, 67, 8, 1, 1, 1, 0, 0),
(47, 1, 0, 39, 66, 8, 1, 1, 1, 0, 0),
(48, 1, 0, 34, 70, 8, 1, 1, 1, 0, 0),
(49, 1, 0, 33, 66, 8, -1, -1, 1, 2, 3),
(50, 0, 1, 39, 70, 8, -1, -1, -1, 0, 0),
(51, 0, 1, 34, 67, 8, -1, -1, -1, 0, 0),
(52, 0, 1, 33, 70, 8, -1, -1, -1, 0, 0),
(53, 1, 0, 39, 67, 8, -1, -1, 1, 2, 2),
(54, 1, 0, 34, 66, 8, -1, -1, 8, 1, 1),
(55, 0, 0, 35, 34, 1, 4, 10, -5, 6, 0),
(56, 0, 0, 37, 40, 1, 4, 2, -8, 9, 0),
(57, 0, 0, 41, 29, 1, 4, -10, 8, 13, 0),
(58, 0, 0, 35, 40, 1, 5, 5, 5, 0, 0),
(59, 0, 0, 37, 29, 1, 5, 5, 5, 0, 0),
(60, 0, 0, 41, 34, 1, 5, 5, 5, 0, 0),
(61, 0, 0, 35, 29, 1, 5, 5, 5, 0, 0),
(62, 0, 0, 37, 34, 1, 5, 5, 5, 0, 0),
(63, 0, 0, 41, 40, 1, 5, 5, 5, 0, 0),
(64, 0, 0, 8, 64, 6, NULL, NULL, NULL, NULL, NULL),
(65, 0, 0, 10, 71, 6, NULL, NULL, NULL, NULL, NULL),
(66, 0, 0, 12, 70, 6, NULL, NULL, NULL, NULL, NULL),
(67, 0, 0, 8, 71, 6, NULL, NULL, NULL, NULL, NULL),
(68, 0, 0, 10, 70, 6, NULL, NULL, NULL, NULL, NULL),
(69, 0, 0, 12, 64, 6, NULL, NULL, NULL, NULL, NULL),
(70, 0, 0, 8, 70, 6, NULL, NULL, NULL, NULL, NULL),
(71, 0, 0, 10, 64, 6, NULL, NULL, NULL, NULL, NULL),
(72, 0, 0, 12, 71, 6, NULL, NULL, NULL, NULL, NULL),
(82, 0, 0, 37, 24, 10, NULL, NULL, NULL, NULL, NULL),
(83, 0, 0, 41, 25, 10, NULL, NULL, NULL, NULL, NULL),
(84, 0, 0, 35, 15, 10, NULL, NULL, NULL, NULL, NULL),
(85, 0, 0, 37, 25, 10, NULL, NULL, NULL, NULL, NULL),
(86, 0, 0, 41, 15, 10, NULL, NULL, NULL, NULL, NULL),
(87, 0, 0, 35, 24, 10, NULL, NULL, NULL, NULL, NULL),
(88, 0, 0, 37, 15, 10, NULL, NULL, NULL, NULL, NULL),
(89, 0, 0, 41, 24, 10, NULL, NULL, NULL, NULL, NULL),
(90, 0, 0, 35, 25, 10, NULL, NULL, NULL, NULL, NULL),
(91, 0, 0, 74, 30, 17, 5, 5, 5, 0, 0),
(92, 0, 0, 80, 39, 17, 5, 5, 5, 0, 0),
(93, 0, 0, 77, 33, 17, 5, 5, 5, 0, 0),
(94, 0, 0, 74, 39, 17, 5, 5, 5, 0, 0),
(95, 0, 0, 80, 33, 17, 5, 5, 5, 0, 0),
(96, 0, 0, 77, 30, 17, 5, 5, 5, 0, 0),
(97, 0, 0, 74, 33, 17, 5, 5, 5, 0, 0),
(98, 0, 0, 80, 30, 17, 5, 5, 5, 0, 0),
(99, 0, 0, 77, 39, 17, 5, 5, 5, 0, 0),
(100, 0, 0, 57, 54, 16, NULL, NULL, NULL, NULL, NULL),
(101, 0, 0, 56, 53, 16, NULL, NULL, NULL, NULL, NULL),
(102, 0, 0, 55, 50, 16, NULL, NULL, NULL, NULL, NULL),
(103, 0, 0, 57, 53, 16, NULL, NULL, NULL, NULL, NULL),
(104, 0, 0, 56, 50, 16, NULL, NULL, NULL, NULL, NULL),
(105, 0, 0, 55, 54, 16, NULL, NULL, NULL, NULL, NULL),
(106, 0, 0, 57, 50, 16, NULL, NULL, NULL, NULL, NULL),
(107, 0, 0, 56, 54, 16, NULL, NULL, NULL, NULL, NULL),
(108, 0, 0, 55, 53, 16, NULL, NULL, NULL, NULL, NULL),
(109, 0, 1, 75, 56, 19, 1, 1, -2, -1, -3),
(110, 1, 0, 80, 55, 19, 8, 8, 8, 0, 0),
(111, 1, 0, 77, 57, 19, 5, 6, 9, 0, 0),
(112, 1, 0, 75, 55, 19, 8, 7, 4, 0, 0),
(113, 0, 1, 80, 57, 19, -8, -8, -9, 0, 0),
(114, 0, 1, 77, 56, 19, -6, -4, 5, -1, 0),
(115, 0, 1, 75, 57, 19, -1, 1, -1, 1, -1),
(116, 0, 1, 80, 56, 19, -1, -1, -1, 0, 0),
(117, 0, 1, 77, 55, 19, -1, -1, -1, 0, 0),
(118, 0, 0, 40, 56, 23, 3, 3, -6, -4, -6),
(119, 0, 0, 33, 55, 23, 3, 5, 6, 0, 0),
(120, 0, 0, 28, 57, 23, -9, -12, -6, 0, 0),
(121, 0, 0, 40, 55, 23, 1, 1, 1, 0, 0),
(122, 0, 0, 33, 57, 23, 5, 8, 4, 0, 0),
(123, 0, 0, 28, 56, 23, 3, 2, 1, 0, 0),
(124, 0, 0, 40, 57, 23, -2, -2, -2, 0, 0),
(125, 0, 0, 33, 56, 23, 1, 4, -2, -1, -2),
(126, 0, 0, 28, 55, 23, -1, -2, -1, 0, 0),
(127, 0, 0, 76, 44, 31, NULL, NULL, NULL, NULL, NULL),
(128, 0, 0, 77, 49, 31, NULL, NULL, NULL, NULL, NULL),
(129, 0, 0, 78, 46, 31, NULL, NULL, NULL, NULL, NULL),
(130, 0, 0, 76, 49, 31, NULL, NULL, NULL, NULL, NULL),
(131, 0, 0, 77, 46, 31, NULL, NULL, NULL, NULL, NULL),
(132, 0, 0, 78, 44, 31, NULL, NULL, NULL, NULL, NULL),
(133, 0, 0, 76, 46, 31, NULL, NULL, NULL, NULL, NULL),
(134, 0, 0, 77, 44, 31, NULL, NULL, NULL, NULL, NULL),
(135, 0, 0, 78, 49, 31, NULL, NULL, NULL, NULL, NULL),
(154, 1, 0, 63, 8, 2, 5, 10, 3, 0, 0),
(155, 1, 0, 62, 10, 2, 2, -5, 5, 16, 0),
(156, 1, 0, 61, 12, 2, 8, 9, -2, -13, 2),
(157, 1, 0, 63, 10, 2, 8, 8, 8, 0, 0),
(158, 1, 0, 62, 12, 2, 2, 2, 2, 0, 0),
(159, 1, 0, 61, 8, 2, 7, 7, 7, 0, 0),
(160, 1, 0, 63, 12, 2, 4, 4, 4, 0, 0),
(161, 1, 0, 62, 8, 2, 2, 5, 8, 0, 0),
(162, 1, 0, 61, 10, 2, 2, 5, 8, 0, 0),
(163, 0, 0, 57, 76, 39, 5, 5, 5, 0, 0),
(164, 0, 0, 56, 78, 39, 5, 5, 5, 0, 0),
(165, 0, 0, 49, 78, 39, 5, 5, 5, 0, 0),
(166, 0, 0, 57, 78, 39, -1, -2, -2, 0, 0),
(167, 0, 0, 56, 78, 39, 6, -2, -2, -2, 0),
(168, 0, 0, 49, 76, 39, -2, -2, -7, 0, 0),
(169, 0, 0, 57, 78, 39, 16, 12, 5, 0, 0),
(170, 0, 0, 56, 76, 39, 4, 4, -2, -2, -2),
(171, 0, 0, 49, 78, 39, -9, -8, -5, 0, 0),
(172, 0, 0, 70, 18, 3, -3, 7, 4, 6, 0),
(173, 0, 0, 66, 15, 3, 4, 16, -4, -3, -5),
(174, 0, 0, 67, 14, 3, -3, 2, 6, 4, 0),
(175, 0, 0, 70, 15, 3, 5, 2, 6, 0, 0),
(176, 0, 0, 66, 14, 3, 4, 7, 2, 0, 0),
(177, 0, 0, 67, 18, 3, -4, -3, 5, -6, 0),
(178, 0, 0, 70, 14, 3, 4, 4, 5, 0, 0),
(179, 0, 0, 66, 18, 3, -3, -8, -5, 0, 0),
(180, 0, 0, 67, 15, 3, -8, -3, -5, 0, 0),
(199, 0, 0, 67, 5, 35, NULL, NULL, NULL, NULL, NULL),
(200, 0, 0, 69, 7, 35, NULL, NULL, NULL, NULL, NULL),
(201, 0, 0, 68, 1, 35, NULL, NULL, NULL, NULL, NULL),
(202, 0, 0, 67, 7, 35, NULL, NULL, NULL, NULL, NULL),
(203, 0, 0, 69, 1, 35, NULL, NULL, NULL, NULL, NULL),
(204, 0, 0, 68, 5, 35, NULL, NULL, NULL, NULL, NULL),
(205, 0, 0, 67, 1, 35, NULL, NULL, NULL, NULL, NULL),
(206, 0, 0, 69, 5, 35, NULL, NULL, NULL, NULL, NULL),
(207, 0, 0, 68, 7, 35, NULL, NULL, NULL, NULL, NULL),
(208, 0, 0, 76, 43, 41, NULL, NULL, NULL, NULL, NULL),
(209, 0, 0, 77, 44, 41, NULL, NULL, NULL, NULL, NULL),
(210, 0, 0, 73, 45, 41, NULL, NULL, NULL, NULL, NULL),
(211, 0, 0, 76, 44, 41, NULL, NULL, NULL, NULL, NULL),
(212, 0, 0, 77, 45, 41, NULL, NULL, NULL, NULL, NULL),
(213, 0, 0, 73, 43, 41, NULL, NULL, NULL, NULL, NULL),
(214, 0, 0, 76, 45, 41, NULL, NULL, NULL, NULL, NULL),
(215, 0, 0, 77, 43, 41, NULL, NULL, NULL, NULL, NULL),
(216, 0, 0, 73, 44, 41, NULL, NULL, NULL, NULL, NULL),
(217, 0, 0, 8, 34, 11, 7, -5, 8, 5, 0),
(218, 0, 0, 10, 31, 11, -4, -6, -8, 0, 0),
(219, 0, 0, 9, 37, 11, 4, 5, -4, 5, 0),
(220, 0, 0, 8, 31, 11, -4, 8, -16, 13, 5),
(221, 0, 0, 10, 37, 11, 7, 8, 5, 0, 0),
(222, 0, 0, 9, 34, 11, 1, 8, 9, 0, 0),
(223, 0, 0, 8, 37, 11, -7, -7, -2, 0, 0),
(224, 0, 0, 10, 34, 11, 7, 5, 2, 0, 0),
(225, 0, 0, 9, 31, 11, 2, 3, 4, 0, 0),
(244, 0, 0, 49, 5, 58, NULL, NULL, NULL, NULL, NULL),
(245, 0, 0, 45, 12, 58, NULL, NULL, NULL, NULL, NULL),
(246, 0, 0, 43, 9, 58, NULL, NULL, NULL, NULL, NULL),
(247, 0, 0, 49, 12, 58, NULL, NULL, NULL, NULL, NULL),
(248, 0, 0, 45, 9, 58, NULL, NULL, NULL, NULL, NULL),
(249, 0, 0, 43, 5, 58, NULL, NULL, NULL, NULL, NULL),
(250, 0, 0, 49, 9, 58, NULL, NULL, NULL, NULL, NULL),
(251, 0, 0, 45, 5, 58, NULL, NULL, NULL, NULL, NULL),
(252, 0, 0, 43, 12, 58, NULL, NULL, NULL, NULL, NULL),
(262, 0, 0, 73, 1, 37, NULL, NULL, NULL, NULL, NULL),
(263, 0, 0, 76, 7, 37, NULL, NULL, NULL, NULL, NULL),
(264, 0, 0, 78, 8, 37, NULL, NULL, NULL, NULL, NULL),
(265, 0, 0, 73, 7, 37, NULL, NULL, NULL, NULL, NULL),
(266, 0, 0, 76, 8, 37, NULL, NULL, NULL, NULL, NULL),
(267, 0, 0, 78, 1, 37, NULL, NULL, NULL, NULL, NULL),
(268, 0, 0, 73, 8, 37, NULL, NULL, NULL, NULL, NULL),
(269, 0, 0, 76, 1, 37, NULL, NULL, NULL, NULL, NULL),
(270, 0, 0, 78, 7, 37, NULL, NULL, NULL, NULL, NULL),
(280, 0, 0, 70, 46, 40, NULL, NULL, NULL, NULL, NULL),
(281, 0, 0, 58, 47, 40, NULL, NULL, NULL, NULL, NULL),
(282, 0, 0, 71, 48, 40, NULL, NULL, NULL, NULL, NULL),
(283, 0, 0, 70, 47, 40, NULL, NULL, NULL, NULL, NULL),
(284, 0, 0, 58, 48, 40, NULL, NULL, NULL, NULL, NULL),
(285, 0, 0, 71, 46, 40, NULL, NULL, NULL, NULL, NULL),
(286, 0, 0, 70, 48, 40, NULL, NULL, NULL, NULL, NULL),
(287, 0, 0, 58, 46, 40, NULL, NULL, NULL, NULL, NULL),
(288, 0, 0, 71, 47, 40, NULL, NULL, NULL, NULL, NULL),
(289, 0, 0, 70, 46, 40, NULL, NULL, NULL, NULL, NULL),
(290, 0, 0, 58, 47, 40, NULL, NULL, NULL, NULL, NULL),
(291, 0, 0, 71, 48, 40, NULL, NULL, NULL, NULL, NULL),
(292, 0, 0, 70, 47, 40, NULL, NULL, NULL, NULL, NULL),
(293, 0, 0, 58, 48, 40, NULL, NULL, NULL, NULL, NULL),
(294, 0, 0, 71, 46, 40, NULL, NULL, NULL, NULL, NULL),
(295, 0, 0, 70, 48, 40, NULL, NULL, NULL, NULL, NULL),
(296, 0, 0, 58, 46, 40, NULL, NULL, NULL, NULL, NULL),
(297, 0, 0, 71, 47, 40, NULL, NULL, NULL, NULL, NULL),
(325, 1, 0, 4, 18, 46, 7, 5, 4, 0, 0),
(326, 1, 0, 5, 17, 46, 4, 5, 6, 0, 0),
(327, 1, 0, 10, 7, 46, 10, 15, 2, 0, 0),
(328, 1, 0, 4, 17, 46, 2, 2, 5, 0, 0),
(329, 1, 0, 5, 7, 46, 3, 3, 3, 0, 0),
(330, 0, 1, 10, 18, 46, -3, -3, -3, 0, 0),
(331, 0, 1, 4, 7, 46, -2, -2, -3, 0, 0),
(332, 0, 1, 5, 18, 46, -3, -3, -2, 0, 0),
(333, 0, 1, 10, 17, 46, 3, -4, 3, -2, -2),
(334, 0, 0, 85, 77, 18, NULL, NULL, NULL, NULL, NULL),
(335, 0, 0, 87, 78, 18, NULL, NULL, NULL, NULL, NULL),
(336, 0, 0, 88, 80, 18, NULL, NULL, NULL, NULL, NULL),
(337, 0, 0, 85, 78, 18, NULL, NULL, NULL, NULL, NULL),
(338, 0, 0, 87, 80, 18, NULL, NULL, NULL, NULL, NULL),
(339, 0, 0, 88, 77, 18, NULL, NULL, NULL, NULL, NULL),
(340, 0, 0, 85, 80, 18, NULL, NULL, NULL, NULL, NULL),
(341, 0, 0, 87, 77, 18, NULL, NULL, NULL, NULL, NULL),
(342, 0, 0, 88, 78, 18, NULL, NULL, NULL, NULL, NULL),
(343, 0, 0, 44, 85, 20, NULL, NULL, NULL, NULL, NULL),
(344, 0, 0, 53, 86, 20, NULL, NULL, NULL, NULL, NULL),
(345, 0, 0, 46, 87, 20, NULL, NULL, NULL, NULL, NULL),
(346, 0, 0, 44, 86, 20, NULL, NULL, NULL, NULL, NULL),
(347, 0, 0, 53, 87, 20, NULL, NULL, NULL, NULL, NULL),
(348, 0, 0, 46, 85, 20, NULL, NULL, NULL, NULL, NULL),
(349, 0, 0, 44, 87, 20, NULL, NULL, NULL, NULL, NULL),
(350, 0, 0, 53, 85, 20, NULL, NULL, NULL, NULL, NULL),
(351, 0, 0, 46, 86, 20, NULL, NULL, NULL, NULL, NULL),
(352, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(353, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(354, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(355, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(356, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(357, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(358, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(359, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(360, 0, 0, 88, 88, 3, NULL, NULL, NULL, NULL, NULL),
(361, 0, 0, 47, 66, 63, NULL, NULL, NULL, NULL, NULL),
(362, 0, 0, 53, 67, 63, NULL, NULL, NULL, NULL, NULL),
(363, 0, 0, 45, 65, 63, NULL, NULL, NULL, NULL, NULL),
(364, 0, 0, 47, 67, 63, NULL, NULL, NULL, NULL, NULL),
(365, 0, 0, 53, 65, 63, NULL, NULL, NULL, NULL, NULL),
(366, 0, 0, 45, 66, 63, NULL, NULL, NULL, NULL, NULL),
(367, 0, 0, 47, 65, 63, NULL, NULL, NULL, NULL, NULL),
(368, 0, 0, 53, 66, 63, NULL, NULL, NULL, NULL, NULL),
(369, 0, 0, 45, 67, 63, NULL, NULL, NULL, NULL, NULL),
(370, 0, 0, 31, 60, 14, NULL, NULL, NULL, NULL, NULL),
(371, 0, 0, 37, 61, 14, NULL, NULL, NULL, NULL, NULL),
(372, 0, 0, 30, 58, 14, NULL, NULL, NULL, NULL, NULL),
(373, 0, 0, 31, 61, 14, NULL, NULL, NULL, NULL, NULL),
(374, 0, 0, 37, 58, 14, NULL, NULL, NULL, NULL, NULL),
(375, 0, 0, 30, 60, 14, NULL, NULL, NULL, NULL, NULL),
(376, 0, 0, 31, 58, 14, NULL, NULL, NULL, NULL, NULL),
(377, 0, 0, 37, 60, 14, NULL, NULL, NULL, NULL, NULL),
(378, 0, 0, 30, 61, 14, NULL, NULL, NULL, NULL, NULL),
(379, 0, 0, 1, 34, 7, NULL, NULL, NULL, NULL, NULL),
(380, 0, 0, 9, 31, 7, NULL, NULL, NULL, NULL, NULL),
(381, 0, 0, 11, 37, 7, NULL, NULL, NULL, NULL, NULL),
(382, 0, 0, 1, 31, 7, NULL, NULL, NULL, NULL, NULL),
(383, 0, 0, 9, 37, 7, NULL, NULL, NULL, NULL, NULL),
(384, 0, 0, 11, 34, 7, NULL, NULL, NULL, NULL, NULL),
(385, 0, 0, 1, 37, 7, NULL, NULL, NULL, NULL, NULL),
(386, 0, 0, 9, 34, 7, NULL, NULL, NULL, NULL, NULL),
(387, 0, 0, 11, 31, 7, NULL, NULL, NULL, NULL, NULL),
(388, 1, 0, 85, 33, 26, 2, 2, 2, 0, 0),
(389, 0, 1, 86, 31, 26, -4, -3, -3, 0, 0),
(390, 1, 0, 87, 35, 26, 4, 3, -2, 9, 0),
(391, 0, 1, 85, 31, 26, 1, -1, -2, -2, 0),
(392, 1, 0, 86, 35, 26, 2, 15, 12, 0, 0),
(393, 0, 1, 87, 33, 26, -1, -1, 1, -3, 0),
(394, 1, 0, 85, 35, 26, 2, 2, 8, 0, 0),
(395, 1, 0, 86, 33, 26, 7, 5, 8, 0, 0),
(396, 0, 1, 87, 31, 26, -3, -3, -4, 0, 0),
(397, 0, 0, 37, 35, 1, NULL, NULL, NULL, NULL, NULL),
(398, 0, 0, 39, 32, 1, NULL, NULL, NULL, NULL, NULL),
(399, 0, 0, 41, 29, 1, NULL, NULL, NULL, NULL, NULL),
(400, 0, 0, 37, 32, 1, NULL, NULL, NULL, NULL, NULL),
(401, 0, 0, 39, 29, 1, NULL, NULL, NULL, NULL, NULL),
(402, 0, 0, 41, 35, 1, NULL, NULL, NULL, NULL, NULL),
(403, 0, 0, 37, 29, 1, NULL, NULL, NULL, NULL, NULL),
(404, 0, 0, 39, 35, 1, NULL, NULL, NULL, NULL, NULL),
(405, 0, 0, 41, 32, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `division`
--

CREATE TABLE `division` (
  `idDivision` int(11) NOT NULL,
  `nomDivision` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `division`
--

INSERT INTO `division` (`idDivision`, `nomDivision`) VALUES
(1, 'Division 1'),
(2, 'Division 2');

-- --------------------------------------------------------

--
-- Structure de la table `engagement`
--

CREATE TABLE `engagement` (
  `idEquipe` int(11) NOT NULL,
  `idChampionnat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `engagement`
--

INSERT INTO `engagement` (`idEquipe`, `idChampionnat`) VALUES
(1, 1),
(4, 1),
(5, 1),
(6, 3),
(8, 1),
(9, 1),
(10, 2),
(11, 1),
(12, 3),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 3),
(19, 3),
(20, 3);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idEquipe` int(11) NOT NULL,
  `nomEquipe` varchar(32) NOT NULL,
  `idClub` int(11) NOT NULL,
  `idDivision` int(11) NOT NULL,
  `nbPoints` int(11) NOT NULL COMMENT 'points du classement',
  `idChampionnat` int(11) NOT NULL,
  `nomPoule` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `nomEquipe`, `idClub`, `idDivision`, `nbPoints`, `idChampionnat`, `nomPoule`) VALUES
(1, 'Breuil-Magné 1', 1, 1, 20, 1, NULL),
(4, 'Marans 1', 4, 1, 33, 1, NULL),
(5, 'Benon 1', 5, 1, 42, 1, NULL),
(6, 'Bords 1', 7, 1, 1, 3, 'B'),
(8, 'Loisirs Solinois 1', 9, 1, 16, 1, NULL),
(9, 'Smash LR 1', 10, 1, 5, 1, NULL),
(10, 'St Hippolyte 1', 11, 1, 12, 2, 'A'),
(11, 'Benon 2', 5, 1, 18, 1, NULL),
(12, 'Bords 3', 7, 2, 5, 3, 'B'),
(13, 'Bords 4', 7, 2, 12, 2, 'A'),
(14, 'Benon 3', 5, 2, 12, 2, 'A'),
(15, 'St Hippolyte 3', 11, 2, 1, 2, 'A'),
(16, 'CTT Burie 1', 8, 2, 3, 2, 'A'),
(17, 'Bords 2', 7, 2, 25, 2, 'A'),
(18, 'St Hippolyte 2', 11, 2, 7, 3, 'B'),
(19, 'Breuil-Magné 2', 1, 2, 7, 3, 'B'),
(20, 'Loisirs solinois 2', 9, 2, 0, 3, 'B');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `idJoueur` int(11) NOT NULL,
  `licenceJoueur` varchar(32) NOT NULL,
  `idClub` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL COMMENT 'Défini par le choix du joueur lors de son inscription au club.',
  `idEquipe` int(11) NOT NULL,
  `nbPoints` int(11) NOT NULL COMMENT 'valeur du joueur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`idJoueur`, `licenceJoueur`, `idClub`, `visible`, `idEquipe`, `nbPoints`) VALUES
(1, '66747377', 1, 1, 1, 510),
(4, 'a', 1, 1, 1, 555),
(5, 'a', 1, 1, 1, 570),
(6, 'a', 1, 1, 1, 855),
(7, 'a', 1, 1, 1, 530),
(8, '66751977', 1, 1, 1, 585),
(9, 'a', 1, 1, 1, 825),
(10, 'a', 1, 1, 1, 960),
(11, 'a', 1, 1, 1, 575),
(12, 'a', 1, 1, 1, 675),
(13, 'a', 4, 1, 4, 800),
(14, 'a', 4, 1, 4, 670),
(15, 'a', 4, 1, 4, 845),
(16, 'a', 4, 1, 4, 1450),
(17, 'a', 4, 1, 4, 550),
(18, 'a', 4, 1, 4, 950),
(19, 'a', 4, 1, 4, 650),
(20, 'a', 4, 1, 4, 650),
(21, 'a', 4, 1, 4, 900),
(22, 'a', 4, 1, 4, 900),
(23, 'a', 4, 1, 4, 545),
(24, 'a', 4, 1, 4, 805),
(25, 'a', 4, 1, 4, 620),
(26, 'a', 4, 1, 4, 700),
(27, 'a', 5, 1, 5, 755),
(28, 'a', 5, 1, 5, 615),
(29, 'a', 5, 1, 5, 670),
(30, '66748341', 5, 1, 5, 700),
(31, 'a', 5, 1, 5, 745),
(32, 'a', 5, 1, 5, 650),
(33, '66742998', 5, 1, 5, 725),
(34, 'a', 5, 1, 5, 800),
(35, 'a', 5, 1, 5, 890),
(36, 'a', 5, 1, 5, 565),
(37, 'a', 5, 1, 5, 755),
(38, 'a', 5, 1, 5, 645),
(39, '65722331', 5, 1, 5, 760),
(40, 'a', 5, 1, 5, 710),
(41, 'a', 5, 1, 5, 840),
(42, 'a', 7, 1, 6, 775),
(43, '66731428', 7, 1, 6, 750),
(44, 'a', 7, 1, 6, 755),
(45, 'En cours', 7, 1, 6, 655),
(46, '40245753', 7, 1, 6, 780),
(47, 'a', 7, 1, 6, 600),
(48, 'a', 7, 1, 6, 650),
(49, 'a', 7, 1, 6, 685),
(50, 'a', 7, 1, 6, 585),
(51, 'a', 7, 1, 6, 700),
(52, 'a', 7, 1, 6, 535),
(53, 'a', 7, 1, 6, 685),
(54, 'a', 7, 1, 6, 675),
(55, 'a', 7, 1, 6, 565),
(56, 'a', 7, 1, 6, 655),
(57, 'a', 7, 1, 6, 945),
(58, 'a', 10, 1, 9, 500),
(59, 'a', 10, 1, 9, 635),
(60, 'a', 10, 1, 9, 565),
(61, 'a', 10, 1, 9, 510),
(62, 'a', 10, 1, 9, 740),
(63, 'a', 10, 1, 9, 830),
(64, 'a', 10, 1, 8, 620),
(65, 'a', 9, 1, 8, 530),
(66, 'a', 9, 1, 8, 775),
(67, 'a', 9, 1, 8, 705),
(68, 'a', 9, 1, 8, 750),
(69, 'a', 9, 1, 8, 675),
(70, 'a', 9, 1, 8, 1350),
(71, 'a', 9, 1, 8, 520),
(72, 'a', 11, 1, 10, 535),
(73, 'a', 11, 1, 10, 500),
(74, 'a', 11, 1, 10, 500),
(75, 'a', 11, 1, 10, 560),
(76, 'a', 11, 1, 10, 600),
(77, 'a', 11, 1, 10, 725),
(78, 'a', 11, 1, 10, 710),
(79, 'a', 11, 1, 10, 580),
(80, 'a', 11, 1, 10, 620),
(84, 'En cours', 1, 1, 19, 500),
(85, 'A', 8, 1, 16, 945),
(86, 'A', 8, 1, 16, 685),
(87, 'A', 8, 1, 16, 635),
(88, 'A', 8, 1, 16, 1250);

-- --------------------------------------------------------

--
-- Structure de la table `journee`
--

CREATE TABLE `journee` (
  `idJournee` int(11) NOT NULL,
  `numJournee` int(11) NOT NULL,
  `datePrev` date NOT NULL COMMENT 'Date prévisionnelle',
  `idChampionnat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `journee`
--

INSERT INTO `journee` (`idJournee`, `numJournee`, `datePrev`, `idChampionnat`) VALUES
(1, 1, '2019-10-18', 1),
(2, 2, '2019-11-08', 1),
(3, 3, '2019-11-29', 1),
(4, 4, '2019-12-06', 1),
(5, 5, '2020-01-10', 1),
(6, 6, '2020-01-24', 1),
(7, 7, '2020-02-07', 1),
(8, 8, '2020-02-21', 1),
(9, 9, '2020-03-13', 1),
(10, 10, '2020-04-03', 1),
(11, 1, '2019-10-18', 2),
(12, 2, '2019-11-08', 2),
(13, 3, '2019-11-29', 2),
(14, 4, '2019-12-06', 2),
(15, 5, '2020-01-10', 2),
(16, 6, '2020-01-24', 2),
(17, 7, '2020-02-07', 2),
(18, 8, '2020-02-21', 2),
(19, 9, '2020-03-13', 2),
(20, 10, '2020-04-03', 2),
(21, 1, '2019-10-18', 3),
(22, 2, '2019-11-08', 3),
(23, 3, '2019-11-29', 3),
(24, 4, '2019-12-06', 3),
(25, 5, '2020-01-10', 3),
(26, 6, '2020-01-24', 3),
(27, 7, '2020-02-07', 3),
(28, 8, '2020-02-21', 3),
(29, 9, '2020-03-13', 3),
(30, 10, '2020-04-03', 3);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `idJoueur` int(11) NOT NULL,
  `idChampionnat` int(11) NOT NULL,
  `classement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`idJoueur`, `idChampionnat`, `classement`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `idPersonne` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `age` int(11) NOT NULL,
  `sexe` enum('M','F') NOT NULL,
  `mail` varchar(64) NOT NULL,
  `adresse` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `nom`, `prenom`, `age`, `sexe`, `mail`, `adresse`) VALUES
(1, 'CASTILLO', 'Jean-Christophe', 52, 'M', 'jcc@jcc.com', 'Breuil-Magné'),
(2, 'CASTILLO', 'Raphaël', 19, 'M', 'castillosphotos@gmail.com', 'Breuil-Magné'),
(3, 'FICHET', 'Claude', 55, 'F', 'cf@cf.com', 'Rochefort'),
(4, 'BONNEC', 'Mayeul', 0, 'M', '', ''),
(5, 'BREDIER', 'Olivier', 0, 'M', '', ''),
(6, 'FOUCHE', 'Virginie', 0, 'F', '', ''),
(7, 'GUILLOTEAU', 'Pierre', 0, 'M', '', ''),
(8, 'HOREL', 'Tristan', 0, 'M', '', ''),
(9, 'LE MOINE', 'Patrick', 0, 'M', '', ''),
(10, 'MARTINET', 'Yaël', 0, 'M', '', ''),
(11, 'MEYRAND', 'Yannik', 0, 'M', '', ''),
(12, 'TESSIER', 'Thierry', 0, 'M', '', ''),
(13, 'BALLANGER', 'Jérèmy', 0, 'M', '', ''),
(14, 'BATIOT', 'Thierry', 0, 'M', '', ''),
(15, 'BONNEAU', 'Catherine', 0, 'F', '', ''),
(16, 'DULAIS', 'Bruno', 0, 'M', '', ''),
(17, 'FALLONE', 'Christine', 0, 'M', '', ''),
(18, 'FAVREAU', 'Didier', 0, 'M', '', ''),
(19, 'GUILLOT', 'Alain', 0, 'M', '', ''),
(20, 'LE COZ', 'Catherine', 0, 'F', '', ''),
(21, 'MORAVEC', 'Mickaël', 0, 'M', '', ''),
(22, 'MORAVEC', 'Richard', 0, 'M', '', ''),
(23, 'PONCE', 'Philippe', 0, 'M', '', ''),
(24, 'RIPOCHE', 'Guy', 0, 'M', '', ''),
(25, 'SAIVRES', 'Eliot', 0, 'M', '', ''),
(26, 'VIVION', 'Dimitri', 0, 'M', '', ''),
(27, 'AMICHOT', 'Raphael', 0, 'M', '', ''),
(28, 'BAUDRY', 'Jérémy', 0, 'M', '', ''),
(29, 'BIELLER', 'Adrien', 0, 'M', '', ''),
(30, 'BOUDEY', 'Pierre', 0, 'M', '', ''),
(31, 'BOURREAU', 'Daniel', 0, 'M', '', ''),
(32, 'CHOLET', 'Annick', 0, 'M', '', ''),
(33, 'GAVENC', 'Dimitri', 0, 'M', '', ''),
(34, 'GRASSET', 'Nadège', 0, 'F', '', ''),
(35, 'GRATTON', 'Stéphane', 0, 'M', '', ''),
(36, 'JOLY', 'Marc', 0, 'M', '', ''),
(37, 'LAUNAY', 'Mathis', 0, 'M', '', ''),
(38, 'LAUNAY', 'Nicolas', 0, 'M', '', ''),
(39, 'MOYNET', 'Stéphane', 0, 'M', '', ''),
(40, 'POISBEAU', 'Yvan', 0, 'M', '', ''),
(41, 'RIBREAU', 'Tanguy', 0, 'M', '', ''),
(42, 'AUDEBERT', 'Sébastien', 0, 'M', '', ''),
(43, 'ARRIVE', 'Jean-Charle', 0, 'M', '', ''),
(44, 'CHABERTY', 'Patrick', 0, 'M', '', ''),
(45, 'CHASLE', 'Jacky', 0, 'M', '', ''),
(46, 'DEVANNE', 'Olivier', 0, 'M', '', ''),
(47, 'DUBUC', 'Bernard', 0, 'M', '', ''),
(48, 'GREGOIRE', 'Frédéric', 0, 'M', '', ''),
(49, 'GUILLEMIN', 'Jean', 0, 'M', '', ''),
(50, 'LOUYOT', 'Laurence', 0, 'F', '', ''),
(51, 'MORCELET', 'Benoit', 0, 'M', '', ''),
(52, 'MORCELET', 'Mathis', 0, 'M', '', ''),
(53, 'POTIRON', 'Mickael', 0, 'M', '', ''),
(54, 'RENIER', 'Jean-Pierre', 0, 'M', '', ''),
(55, 'SIMON', 'Patrick', 0, 'M', '', ''),
(56, 'TOUCHARD', 'Cécile', 0, 'F', '', ''),
(57, 'TOUCHARD', 'François', 0, 'M', '', ''),
(58, 'COMON', 'Thierry', 0, 'M', '', ''),
(59, 'DELFAU', 'Jérôme', 0, 'M', '', ''),
(60, 'DUPEUX', 'Florian', 0, 'M', '', ''),
(61, 'GIREME', 'André', 0, 'M', '', ''),
(62, 'JOLY', 'Jean-Marie', 0, 'M', '', ''),
(63, 'LHOSTE', 'Jamy', 0, 'M', '', ''),
(64, 'BAROCHE', 'Yannick', 0, 'M', '', ''),
(65, 'BAROCHE', 'Dorian', 0, 'M', '', ''),
(66, 'BAROCHE', 'Samuel', 0, 'M', '', ''),
(67, 'BRACHET', 'Sébastien', 0, 'M', '', ''),
(68, 'BRENGARD', 'Nicole', 0, 'F', '', ''),
(69, 'ETIE', 'Mathieu', 0, 'M', '', ''),
(70, 'GAUTIER', 'Benjamin', 0, 'M', '', ''),
(71, 'GAUTIER', 'Elise', 0, 'F', '', ''),
(72, 'BOYER', 'Alexandre', 0, 'M', '', ''),
(73, 'BOYER', 'Nicolas', 0, 'M', '', ''),
(74, 'BRILLAUD', 'Justine', 0, 'F', '', ''),
(75, 'BRILLAUD', 'Sévérine', 0, 'F', '', ''),
(76, 'GIRET', 'Maryse', 0, 'F', '', ''),
(77, 'GIRET', 'Pierrick', 0, 'M', '', ''),
(78, 'GIRET', 'Tanguy', 0, 'M', '', ''),
(79, 'JOLY', 'Daniel', 0, 'M', '', ''),
(80, 'RETAILLEAU', 'Robert', 0, 'M', '', ''),
(81, 'TEST', 'TEST', 42, 'M', 'Aucune', 'Aucune'),
(84, 'OLIVIER', 'Vincent', 0, 'M', '', ''),
(85, 'ANGIBAUD', 'Eric', 0, 'M', '', ''),
(86, 'BUREAU', 'Christophe', 0, '', '', ''),
(87, 'HOUANT', 'Fredéric', 0, 'M', '', ''),
(88, 'OHL', 'Sébastien', 0, 'M', '', ''),
(89, 'VINET', 'Kevin', 0, 'M', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `poule`
--

CREATE TABLE `poule` (
  `idPoule` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `idChampionnat` int(11) NOT NULL,
  `nomPoule` enum('A','B','C','D','E','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `poule`
--

INSERT INTO `poule` (`idPoule`, `idEquipe`, `idChampionnat`, `nomPoule`) VALUES
(1, 18, 3, 'B'),
(2, 12, 3, 'B'),
(3, 19, 3, 'B'),
(4, 6, 3, 'B'),
(5, 20, 3, 'B'),
(6, 5, 2, 'A'),
(7, 11, 2, 'A'),
(8, 9, 2, 'A'),
(9, 1, 2, 'A'),
(10, 8, 2, 'A'),
(11, 4, 2, 'A');

-- --------------------------------------------------------

--
-- Structure de la table `remplacement`
--

CREATE TABLE `remplacement` (
  `idJoueur` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `idRencontre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

CREATE TABLE `rencontre` (
  `idRencontre` int(11) NOT NULL,
  `heure` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `lieu` varchar(128) DEFAULT NULL,
  `scoreFinalA` int(11) DEFAULT NULL,
  `scoreFinalB` int(11) DEFAULT NULL,
  `ptsDbA` int(11) NOT NULL,
  `ptsDbB` int(11) NOT NULL,
  `idJournee` int(11) NOT NULL,
  `idArbitre` int(11) DEFAULT NULL,
  `idEquipeA` int(11) NOT NULL,
  `idEquipeB` int(11) NOT NULL,
  `WO` enum('J','A','B','') NOT NULL DEFAULT 'J' COMMENT 'J signifie Joué',
  `D1` int(11) DEFAULT NULL,
  `D2` int(11) DEFAULT NULL,
  `D3` int(11) DEFAULT NULL,
  `D4` int(11) DEFAULT NULL,
  `D5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rencontre`
--

INSERT INTO `rencontre` (`idRencontre`, `heure`, `date`, `lieu`, `scoreFinalA`, `scoreFinalB`, `ptsDbA`, `ptsDbB`, `idJournee`, `idArbitre`, `idEquipeA`, `idEquipeB`, `WO`, `D1`, `D2`, `D3`, `D4`, `D5`) VALUES
(1, '21:00:00', '2019-10-18', 'Benon', 10, 0, 1, 0, 1, 31, 5, 11, 'J', 7, 5, 4, 0, 0),
(2, '21:00:00', '2019-10-18', 'La Rochelle', 10, 0, 1, 0, 1, 62, 9, 1, 'J', 7, 7, 4, 0, 0),
(3, '21:00:00', '2019-10-18', 'Sainte-Soulle', 0, 0, 0, 1, 1, 88, 8, 4, 'J', 2, -12, 13, -8, 5),
(4, '20:30:00', '2019-11-08', 'Benon', 7, 3, 0, 0, 2, 35, 5, 9, 'J', NULL, NULL, NULL, NULL, NULL),
(5, '20:30:00', '2019-11-08', 'Marans', 4, 6, 0, 0, 2, 15, 4, 11, 'J', NULL, NULL, NULL, NULL, NULL),
(6, '20:30:00', '2019-11-10', 'Breuil-Magné', 5, 5, 0, 0, 2, 12, 1, 8, 'J', NULL, NULL, NULL, NULL, NULL),
(7, '20:30:00', '2019-11-29', 'Breuil-Magné', 4, 6, 0, 0, 3, 1, 1, 5, 'J', NULL, NULL, NULL, NULL, NULL),
(8, '19:30:00', '2019-11-22', 'Benon', 7, 3, 1, 0, 3, 34, 11, 8, 'J', 5, 7, 8, 0, 0),
(9, '21:00:00', '2019-11-26', 'La Rochelle', 5, 5, 0, 0, 3, 62, 9, 4, 'J', NULL, NULL, NULL, NULL, NULL),
(10, '21:00:00', '2019-12-06', 'Benon', 6, 4, 1, 0, 4, 35, 5, 4, 'J', 5, 7, 8, 0, 0),
(11, '20:30:00', '2019-11-29', 'Breuil-Magné', 4, 6, 0, 1, 4, 12, 1, 11, 'J', 8, 4, -5, -8, -8),
(12, '21:00:00', '2019-12-13', 'Sainte-Soulle', 9, 1, 0, 0, 4, 70, 8, 9, 'J', NULL, NULL, NULL, NULL, NULL),
(13, '20:30:00', '2020-01-17', 'Sainte-Soulle', 10, 0, 0, 0, 5, 70, 8, 5, 'J', NULL, NULL, NULL, NULL, NULL),
(14, '21:00:00', '2020-01-07', 'Benon', 2, 8, 0, 0, 5, 27, 11, 9, 'J', NULL, NULL, NULL, NULL, NULL),
(15, '21:00:00', '2020-01-06', 'Marans', 7, 3, 1, 0, 5, 15, 4, 1, 'J', 5, 7, 8, 0, 0),
(16, '20:30:00', '2019-10-18', 'Bords', 3, 7, 0, 0, 11, 1, 17, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(17, '21:00:00', '2019-10-25', 'Saint-Hippolyte', 2, 8, 1, 0, 11, 80, 10, 14, 'J', 5, 5, 5, 0, 0),
(18, NULL, NULL, NULL, NULL, NULL, 0, 0, 11, 77, 16, 15, 'J', NULL, NULL, NULL, NULL, NULL),
(19, '21:00:00', '2019-11-08', 'saint hippolyte', 3, 7, 0, 1, 12, 80, 10, 17, 'J', -2, -2, 9, -1, 0),
(20, NULL, NULL, NULL, NULL, NULL, 0, 0, 12, NULL, 13, 16, 'J', NULL, NULL, NULL, NULL, NULL),
(21, '20:30:00', '2019-11-08', 'Benon', 0, 0, 0, 0, 12, 1, 14, 15, 'J', NULL, NULL, NULL, NULL, NULL),
(22, NULL, NULL, NULL, NULL, NULL, 0, 0, 13, NULL, 16, 10, 'J', NULL, NULL, NULL, NULL, NULL),
(23, '19:00:00', '2019-11-29', 'Benon', 6, 4, 1, 0, 13, 31, 14, 17, 'J', 5, 7, 8, 0, 0),
(24, '20:30:00', '2019-11-15', 'Saint Hippolyte', 0, 0, 0, 0, 13, 1, 15, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(25, NULL, NULL, NULL, NULL, NULL, 0, 0, 14, NULL, 10, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(26, '10:00:00', '2020-03-12', 'Burie', 6, 4, 1, 0, 14, 85, 16, 14, 'J', 2, -3, 4, -1, 3),
(27, '20:30:00', '2019-12-20', 'Bords', 10, 0, 0, 0, 14, 1, 17, 15, 'B', NULL, NULL, NULL, NULL, NULL),
(28, NULL, NULL, NULL, NULL, NULL, 0, 0, 15, NULL, 14, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL, 0, 0, 15, NULL, 17, 16, 'J', NULL, NULL, NULL, NULL, NULL),
(30, '20:30:00', '2020-01-10', 'Saint Hippolyte', 0, 0, 0, 0, 15, 1, 15, 10, 'A', NULL, NULL, NULL, NULL, NULL),
(31, '21:00:00', '2019-10-25', 'Saont Hippolyte', 1, 9, 1, 0, 21, 76, 18, 12, 'J', 5, 7, 8, 0, 0),
(32, '20:30:00', '2019-10-18', 'Breuil Magné', 4, 6, 1, 0, 21, 1, 19, 6, 'J', 4, 4, 6, 0, 0),
(33, '20:30:00', '2019-11-14', 'Bords', 4, 6, 0, 0, 22, 1, 12, 19, 'J', NULL, NULL, NULL, NULL, NULL),
(34, NULL, NULL, NULL, NULL, NULL, 0, 0, 22, NULL, 20, 18, 'J', NULL, NULL, NULL, NULL, NULL),
(35, NULL, NULL, NULL, NULL, NULL, 0, 0, 23, NULL, 19, 20, 'J', NULL, NULL, NULL, NULL, NULL),
(36, NULL, NULL, NULL, NULL, NULL, 0, 0, 23, NULL, 12, 6, 'J', NULL, NULL, NULL, NULL, NULL),
(37, '20:45:00', '2020-02-15', 'saint hippolyte', NULL, NULL, 0, 0, 24, NULL, 18, 19, 'J', NULL, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, NULL, NULL, 0, 0, 24, NULL, 6, 20, 'J', NULL, NULL, NULL, NULL, NULL),
(39, '19:00:00', '2019-12-27', 'Bords', 0, 0, 0, 1, 25, 1, 6, 18, 'J', 9, -8, -3, 5, -8),
(40, '21:30:00', '2020-02-15', 'Sainte Soulle', NULL, NULL, 0, 0, 25, NULL, 20, 12, 'J', NULL, NULL, NULL, NULL, NULL),
(41, NULL, NULL, NULL, NULL, NULL, 0, 0, 26, NULL, 18, 12, 'J', NULL, NULL, NULL, NULL, NULL),
(42, NULL, NULL, NULL, NULL, NULL, 0, 0, 26, NULL, 19, 6, 'J', NULL, NULL, NULL, NULL, NULL),
(43, NULL, NULL, NULL, NULL, NULL, 0, 0, 16, NULL, 17, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, NULL, NULL, 0, 0, 16, NULL, 10, 14, 'J', NULL, NULL, NULL, NULL, NULL),
(45, NULL, NULL, NULL, NULL, NULL, 0, 0, 16, NULL, 16, 15, 'J', NULL, NULL, NULL, NULL, NULL),
(46, '21:00:00', '2020-01-17', 'saint hippolyte', 5, 5, 0, 0, 17, 12, 10, 17, 'J', 2, 2, -3, -2, -2),
(47, NULL, NULL, NULL, NULL, NULL, 0, 0, 17, NULL, 13, 16, 'J', NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, NULL, NULL, 0, 0, 17, NULL, 14, 15, 'J', NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, NULL, NULL, 0, 0, 18, NULL, 16, 10, 'J', NULL, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, NULL, NULL, 0, 0, 18, NULL, 14, 17, 'J', NULL, NULL, NULL, NULL, NULL),
(51, NULL, NULL, NULL, NULL, NULL, 0, 0, 18, NULL, 15, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, NULL, NULL, 0, 0, 19, NULL, 10, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(53, NULL, NULL, NULL, NULL, NULL, 0, 0, 19, NULL, 16, 14, 'J', NULL, NULL, NULL, NULL, NULL),
(54, NULL, NULL, NULL, NULL, NULL, 0, 0, 19, NULL, 17, 15, 'J', NULL, NULL, NULL, NULL, NULL),
(55, NULL, NULL, NULL, NULL, NULL, 0, 0, 20, NULL, 14, 13, 'J', NULL, NULL, NULL, NULL, NULL),
(56, NULL, NULL, NULL, NULL, NULL, 0, 0, 20, NULL, 17, 16, 'J', NULL, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, NULL, NULL, 0, 0, 20, NULL, 15, 10, 'J', NULL, NULL, NULL, NULL, NULL),
(58, '20:30:00', '2020-02-17', 'Bords', NULL, NULL, 0, 0, 27, NULL, 12, 19, 'J', NULL, NULL, NULL, NULL, NULL),
(59, '19:00:00', '2020-02-26', 'Sainte Soulle', NULL, NULL, 0, 0, 27, NULL, 20, 18, 'J', NULL, NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, NULL, NULL, 0, 0, 28, NULL, 19, 20, 'J', NULL, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, 0, 0, 28, NULL, 12, 6, 'J', NULL, NULL, NULL, NULL, NULL),
(62, NULL, NULL, NULL, NULL, NULL, 0, 0, 29, NULL, 18, 19, 'J', NULL, NULL, NULL, NULL, NULL),
(63, '18:30:00', '2019-12-20', 'ppppp', NULL, NULL, 0, 0, 29, 44, 6, 20, 'J', NULL, NULL, NULL, NULL, NULL),
(64, NULL, NULL, NULL, NULL, NULL, 0, 0, 30, NULL, 6, 18, 'J', NULL, NULL, NULL, NULL, NULL),
(65, NULL, NULL, NULL, NULL, NULL, 0, 0, 30, NULL, 20, 12, 'J', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `idVille` int(11) NOT NULL,
  `nomVille` varchar(64) NOT NULL,
  `codePostal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`idVille`, `nomVille`, `codePostal`) VALUES
(1, 'Breuil-Magné', 17870),
(2, 'Tulle', 19000),
(5, 'Rochefort', 17300),
(7, 'Marans', 17230),
(8, 'Benon', 17170),
(9, 'Bords', 17430),
(10, 'Burie', 17770),
(11, 'Solinois', 17220),
(12, 'La Rochelle', 17000),
(13, 'Saint-Hyppolyte', 17430);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arbitre`
--
ALTER TABLE `arbitre`
  ADD PRIMARY KEY (`idArbitre`);

--
-- Index pour la table `championnat`
--
ALTER TABLE `championnat`
  ADD PRIMARY KEY (`idChampionnat`),
  ADD KEY `idDivision` (`idDivision`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`idClub`),
  ADD KEY `idVille` (`idVille`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idCompte`);

--
-- Index pour la table `detailmatch`
--
ALTER TABLE `detailmatch`
  ADD PRIMARY KEY (`idMatch`),
  ADD KEY `idJoueurA` (`idJR`),
  ADD KEY `idJoueurB` (`idJV`),
  ADD KEY `idRencontre` (`idRencontre`);

--
-- Index pour la table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`idDivision`);

--
-- Index pour la table `engagement`
--
ALTER TABLE `engagement`
  ADD PRIMARY KEY (`idEquipe`,`idChampionnat`),
  ADD KEY `idChampionnat` (`idChampionnat`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`idEquipe`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`idJoueur`),
  ADD KEY `idEquipe` (`idEquipe`);

--
-- Index pour la table `journee`
--
ALTER TABLE `journee`
  ADD PRIMARY KEY (`idJournee`),
  ADD KEY `idChampionnat` (`idChampionnat`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`idJoueur`,`idChampionnat`),
  ADD KEY `idChampionnat` (`idChampionnat`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`idPersonne`);

--
-- Index pour la table `poule`
--
ALTER TABLE `poule`
  ADD PRIMARY KEY (`idPoule`),
  ADD KEY `idChampionnat` (`idChampionnat`),
  ADD KEY `idEquipe` (`idEquipe`);

--
-- Index pour la table `remplacement`
--
ALTER TABLE `remplacement`
  ADD PRIMARY KEY (`idJoueur`,`idEquipe`,`idRencontre`),
  ADD KEY `idRencontre` (`idRencontre`),
  ADD KEY `idEquipe` (`idEquipe`);

--
-- Index pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD PRIMARY KEY (`idRencontre`),
  ADD KEY `idJournee` (`idJournee`),
  ADD KEY `idEquipeA` (`idEquipeA`),
  ADD KEY `idEquipeB` (`idEquipeB`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`idVille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arbitre`
--
ALTER TABLE `arbitre`
  MODIFY `idArbitre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `championnat`
--
ALTER TABLE `championnat`
  MODIFY `idChampionnat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `idClub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `detailmatch`
--
ALTER TABLE `detailmatch`
  MODIFY `idMatch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT pour la table `division`
--
ALTER TABLE `division`
  MODIFY `idDivision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idEquipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `idJoueur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `journee`
--
ALTER TABLE `journee`
  MODIFY `idJournee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `idPersonne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `poule`
--
ALTER TABLE `poule`
  MODIFY `idPoule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `idRencontre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `idVille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `arbitre`
--
ALTER TABLE `arbitre`
  ADD CONSTRAINT `arbitre_ibfk_1` FOREIGN KEY (`idArbitre`) REFERENCES `compte` (`idCompte`);

--
-- Contraintes pour la table `championnat`
--
ALTER TABLE `championnat`
  ADD CONSTRAINT `championnat_ibfk_1` FOREIGN KEY (`idDivision`) REFERENCES `division` (`idDivision`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`idCompte`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `detailmatch`
--
ALTER TABLE `detailmatch`
  ADD CONSTRAINT `detailmatch_ibfk_1` FOREIGN KEY (`idRencontre`) REFERENCES `rencontre` (`idRencontre`),
  ADD CONSTRAINT `detailmatch_ibfk_2` FOREIGN KEY (`idJR`) REFERENCES `joueur` (`idJoueur`),
  ADD CONSTRAINT `detailmatch_ibfk_3` FOREIGN KEY (`idJV`) REFERENCES `joueur` (`idJoueur`);

--
-- Contraintes pour la table `engagement`
--
ALTER TABLE `engagement`
  ADD CONSTRAINT `engagement_ibfk_1` FOREIGN KEY (`idChampionnat`) REFERENCES `championnat` (`idChampionnat`),
  ADD CONSTRAINT `engagement_ibfk_2` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`idClub`) REFERENCES `club` (`idClub`),
  ADD CONSTRAINT `equipe_ibfk_2` FOREIGN KEY (`idDivision`) REFERENCES `division` (`idDivision`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `joueur_ibfk_1` FOREIGN KEY (`idJoueur`) REFERENCES `personne` (`idPersonne`),
  ADD CONSTRAINT `joueur_ibfk_2` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`);

--
-- Contraintes pour la table `journee`
--
ALTER TABLE `journee`
  ADD CONSTRAINT `journee_ibfk_1` FOREIGN KEY (`idChampionnat`) REFERENCES `championnat` (`idChampionnat`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`idChampionnat`) REFERENCES `championnat` (`idChampionnat`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`idJoueur`) REFERENCES `joueur` (`idJoueur`);

--
-- Contraintes pour la table `poule`
--
ALTER TABLE `poule`
  ADD CONSTRAINT `poule_ibfk_1` FOREIGN KEY (`idChampionnat`) REFERENCES `championnat` (`idChampionnat`),
  ADD CONSTRAINT `poule_ibfk_2` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`);

--
-- Contraintes pour la table `remplacement`
--
ALTER TABLE `remplacement`
  ADD CONSTRAINT `remplacement_ibfk_2` FOREIGN KEY (`idJoueur`) REFERENCES `joueur` (`idJoueur`),
  ADD CONSTRAINT `remplacement_ibfk_3` FOREIGN KEY (`idRencontre`) REFERENCES `rencontre` (`idRencontre`),
  ADD CONSTRAINT `remplacement_ibfk_4` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`);

--
-- Contraintes pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `rencontre_ibfk_1` FOREIGN KEY (`idArbitre`) REFERENCES `arbitre` (`idArbitre`),
  ADD CONSTRAINT `rencontre_ibfk_2` FOREIGN KEY (`idJournee`) REFERENCES `journee` (`idJournee`),
  ADD CONSTRAINT `rencontre_ibfk_3` FOREIGN KEY (`idEquipeA`) REFERENCES `equipe` (`idEquipe`),
  ADD CONSTRAINT `rencontre_ibfk_4` FOREIGN KEY (`idEquipeB`) REFERENCES `equipe` (`idEquipe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
