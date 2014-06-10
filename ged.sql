-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 21 Avril 2014 à 22:12
-- Version du serveur: 5.6.12
-- Version de PHP: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ged`
--
CREATE DATABASE IF NOT EXISTS `ged` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ged`;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
CREATE TABLE IF NOT EXISTS `fichiers` (
  `nom` varchar(255) NOT NULL,
  `chemin` text NOT NULL,
  `type_mime` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `taille` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `date_modification` date NOT NULL,
  `version` int(11) NOT NULL,
  `date_expiration` date NOT NULL,
  `verrouille` int(1) NOT NULL,
  `mots_clef` text NOT NULL,
  `workflow` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `nro_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe` varchar(30) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`nro_groupe`),
  UNIQUE KEY `nro_groupe` (`nro_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`nro_groupe`, `nom_groupe`, `description`) VALUES
(1, 'ADMINISTRATEURS', 'Administrateurs du site'),
(2, 'UTILISATEURS', 'blabla'),
(3, 'goog', 'goo'),
(4, 'Caro', 'test'),
(5, 'GERMOJDRD', 'fegeg');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_users`
--

DROP TABLE IF EXISTS `groupe_users`;
CREATE TABLE IF NOT EXISTS `groupe_users` (
  `nro_groupe` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  PRIMARY KEY (`nro_groupe`,`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe_users`
--

INSERT INTO `groupe_users` (`nro_groupe`, `login`) VALUES
(1, 'seb');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `login` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`login`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`login`, `password`, `actif`) VALUES
('azer', 'azer', 1),
('seb', 'aa', 1),
('seb1', 'seb', 0);

-- --------------------------------------------------------

--
-- Structure de la table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE IF NOT EXISTS `workflow` (
  `nro_etat` int(11) NOT NULL,
  `description_etat` varchar(50) NOT NULL,
  PRIMARY KEY (`nro_etat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `workflow`
--

INSERT INTO `workflow` (`nro_etat`, `description_etat`) VALUES
(100, 'Etat 1'),
(200, 'Etat 2'),
(300, 'Etat 3'),
(400, 'Etat 4'),
(500, 'Etat 5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
