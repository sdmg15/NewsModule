-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Mai 2016 à 19:30
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `poo`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `newsId` int(10) unsigned DEFAULT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `contenu` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_amer` (`newsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `newsId`, `auteur`, `contenu`, `dateAjout`, `dateModif`) VALUES
(1, 2, 'le tioriste ', 'Je suis un tioriste laisse moi tes affaires de POO \r\nque tu ne nous donne même pas la signification la \r\n#sorcier ', '2016-05-19 18:28:30', '2016-05-19 18:28:30');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(90) NOT NULL,
  `auteur` varchar(90) DEFAULT NULL,
  `contenu` text,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL,
  `nombreCommentaire` smallint(6) DEFAULT '0',
  `vues` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `auteur`, `contenu`, `dateAjout`, `dateModif`, `nombreCommentaire`, `vues`) VALUES
(2, 'Hello world !', '@smdg15', 'Salut le monde ! \r\nJe viens aujourd''hui vous présenté les merveilles de la POO! \r\nNon je vous assure les dev sont à la fois foénant et fort !\r\nVive la poo !\r\n#love !', '2016-05-19 18:27:15', '2016-05-19 18:27:15', 0, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_amer` FOREIGN KEY (`newsId`) REFERENCES `news` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
