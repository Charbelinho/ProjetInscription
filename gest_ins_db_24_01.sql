-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 12 juin 2019 à 16:37
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gest_ins_db_24_01`
--

-- --------------------------------------------------------

--
-- Structure de la table `anneeacademique`
--

DROP TABLE IF EXISTS `anneeacademique`;
CREATE TABLE IF NOT EXISTS `anneeacademique` (
  `CodeAnnee` varchar(9) NOT NULL,
  PRIMARY KEY (`CodeAnnee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `anneeacademique`
--

INSERT INTO `anneeacademique` (`CodeAnnee`) VALUES
('2018-2019'),
('2018-2020');

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `CodeCaisse` varchar(6) NOT NULL,
  `LibCaisse` varchar(25) NOT NULL,
  PRIMARY KEY (`CodeCaisse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `caisse`
--

INSERT INTO `caisse` (`CodeCaisse`, `LibCaisse`) VALUES
('231', 'KONE');

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

DROP TABLE IF EXISTS `cycle`;
CREATE TABLE IF NOT EXISTS `cycle` (
  `CodeCycle` varchar(6) NOT NULL,
  `LibCycle` varchar(26) NOT NULL,
  `NbAnnee` varchar(2) NOT NULL,
  PRIMARY KEY (`CodeCycle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cycle`
--

INSERT INTO `cycle` (`CodeCycle`, `LibCycle`, `NbAnnee`) VALUES
('C1', 'LICENCE', '3'),
('C2', 'MASTER', '2');

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `NumDoss` int(6) NOT NULL AUTO_INCREMENT,
  `DateEnregisDoss` varchar(10) NOT NULL,
  `ContenuDoss` varchar(255) NOT NULL,
  `Infocorrespond` varchar(100) NOT NULL,
  PRIMARY KEY (`NumDoss`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dossier`
--

INSERT INTO `dossier` (`NumDoss`, `DateEnregisDoss`, `ContenuDoss`, `Infocorrespond`) VALUES
(23, '02-12-2019', 'rom192157.rar', 'v bvgb '),
(24, '02-12-2019', 'rom192157.rar', 'v bvgb ');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `MatEtud` varchar(10) NOT NULL,
  `NomEtud` varchar(15) NOT NULL,
  `PrenomEtud` varchar(40) NOT NULL,
  `IdPermanent` varchar(20) NOT NULL,
  `MotDePassEtud` varchar(100) NOT NULL,
  `SexeEtud` varchar(1) NOT NULL,
  `DateNaissEtud` varchar(12) NOT NULL,
  `LieuNaissEtud` varchar(25) NOT NULL,
  `StatutEtud` varchar(10) NOT NULL,
  `ContactEtud` varchar(12) NOT NULL,
  `EmailEtud` varchar(30) NOT NULL,
  `ResidenceEtud` varchar(25) NOT NULL,
  `PhotoEtud` varchar(255) NOT NULL,
  PRIMARY KEY (`MatEtud`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `MotDePassEtud`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud`) VALUES
('007', 'goue i', 'ange', 'gou193051', '12345678', 'H', '2019-06-16', 'cocody', 'OR', '+22589786606', 'ange222@gmail.com', 'cocody', 'user.png'),
('008', 'romeo', 'Ange', 'rom192157', '12345678', 'H', '1998-08-07', 'cocody', 'OR', '+22589786606', 'romeoange25@gmail.com', 'riviera-golf', 'user.png'),
('1111', 'goueba', 'angeq', 'gou196884', '', 'F', '2019-07-04', 'cocodi', 'OR', '+22589786605', 'ange22@gmail.com', 'coc6dy', 'user.png'),
('Ab2121', 'Kouame Kassi', 'Jonas', 'Kou191181', '12345678', 'H', '1995-11-01', 'Macory', 'NO', '+22589786606', 'romeoange25@gmail.com', 'riviera-golf', 'user.png');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `CodeFil` varchar(6) NOT NULL,
  `LibFil` varchar(30) NOT NULL,
  PRIMARY KEY (`CodeFil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`CodeFil`, `LibFil`) VALUES
('AC', 'AUDIT COMPTABLE'),
('AD', 'ASSISTANAT DE DIRECTION'),
('CDM', 'COMMUNICATION ET DEVELOPPEMENT'),
('CF', 'COMPTABILITE  ET FINANCE'),
('GE', 'GESTION DES ENTREPRISES'),
('MA', 'MARKETING'),
('RGL', 'RESEAU GENIE LOGICIEL');

-- --------------------------------------------------------

--
-- Structure de la table `fournir`
--

DROP TABLE IF EXISTS `fournir`;
CREATE TABLE IF NOT EXISTS `fournir` (
  `NumDoss` int(6) NOT NULL AUTO_INCREMENT,
  `MatEtud` varchar(6) NOT NULL,
  PRIMARY KEY (`NumDoss`,`MatEtud`),
  KEY `MatEtud` (`MatEtud`),
  KEY `NumDoss` (`NumDoss`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournir`
--

INSERT INTO `fournir` (`NumDoss`, `MatEtud`) VALUES
(23, '008');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `NumInscrip` varchar(6) NOT NULL,
  `DateInscrip` date NOT NULL,
  `ValidationInscrip` varchar(1) NOT NULL,
  `CodeNiv` varchar(6) NOT NULL,
  `CodeAnnee` varchar(9) NOT NULL,
  `CodeFil` varchar(6) NOT NULL,
  PRIMARY KEY (`NumInscrip`),
  KEY `CodeNiv` (`CodeNiv`,`CodeAnnee`,`CodeFil`),
  KEY `CodeNiv_2` (`CodeNiv`,`CodeAnnee`,`CodeFil`),
  KEY `CodeAnnee` (`CodeAnnee`),
  KEY `CodeFil` (`CodeFil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`NumInscrip`, `DateInscrip`, `ValidationInscrip`, `CodeNiv`, `CodeAnnee`, `CodeFil`) VALUES
('1308', '2019-06-11', '', 'LPRGL1', '2018-2019', 'RGL'),
('2260', '2019-06-12', '', 'LPRGL2', '2018-2019', 'RGL'),
('5564', '2019-06-10', '', 'LPRGL1', '2018-2019', 'RGL'),
('9773', '2019-06-07', '', 'LPCDM1', '2018-2019', 'CDM');

-- --------------------------------------------------------

--
-- Structure de la table `lier`
--

DROP TABLE IF EXISTS `lier`;
CREATE TABLE IF NOT EXISTS `lier` (
  `CodeFil` varchar(6) NOT NULL,
  `Codecyle` varchar(6) NOT NULL,
  PRIMARY KEY (`CodeFil`,`Codecyle`),
  KEY `Codecyle` (`Codecyle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lier`
--

INSERT INTO `lier` (`CodeFil`, `Codecyle`) VALUES
('AC', 'C1'),
('AD', 'C1'),
('CDM', 'C1'),
('CF', 'C1'),
('GE', 'C1'),
('MA', 'C1'),
('RGL', 'C1'),
('AC', 'C2'),
('AD', 'C2'),
('CDM', 'C2'),
('CF', 'C2'),
('GE', 'C2'),
('MA', 'C2'),
('RGL', 'C2');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `CodeNiv` varchar(6) NOT NULL,
  `LibNiv` varchar(100) NOT NULL,
  `CodeFil` varchar(5) NOT NULL,
  PRIMARY KEY (`CodeNiv`),
  KEY `CodeFil` (`CodeFil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`CodeNiv`, `LibNiv`, `CodeFil`) VALUES
('LPAC1', 'LICENCE PRO_AUDIT COMPTABLE 1', 'AC'),
('LPAC2', 'LICENCE PRO_AUDIT COMPTABLE 2', 'AC'),
('LPAC3', 'LICENCE PRO_AUDIT COMPTABLE 3', 'AC'),
('LPAD1', 'LICENCE PRO_ASSISTANAT DE DIRECTION 1', 'AD'),
('LPAD2', 'LICENCE PRO_ASSISTANAT DE DIRECTION 2', 'AD'),
('LPAD3', 'LICENCE PRO_ASSISTANAT DE DIRECTION 3', 'AD'),
('LPCDM1', 'LICENCE PRO_COMMUNICATION ET DEVELOPPEMENT 1', 'CDM'),
('LPCDM2', 'LICENCE PRO_COMMUNICATION ET DEVELOPPEMENT 2', 'CDM'),
('LPCDM3', 'LICENCE PRO_COMMUNICATION ET DEVELOPPEMENT 3', 'CDM'),
('LPCF1', 'LICENCE PRO_COMPTABILITE  ET FINANCE 1', 'CF'),
('LPCF2', 'LICENCE PRO_COMPTABILITE  ET FINANCE 2', 'CF'),
('LPCF3', 'LICENCE PRO_COMPTABILITE  ET FINANCE 3', 'CF'),
('LPGE1', 'LICENCE PRO_GESTION DES ENTREPRISES 1', 'GE'),
('LPGE2', 'LICENCE PRO_GESTION DES ENTREPRISES 2', 'GE'),
('LPGE3', 'LICENCE PRO_GESTION DES ENTREPRISES 3', 'GE'),
('LPMA1', 'LICENCE PRO_MARKETING 1', 'MA'),
('LPMA2', 'LICENCE PRO_MARKETING 2', 'MA'),
('LPMA3', 'LICENCE PRO_MARKETING 3', 'MA'),
('LPRGL1', 'LICENCE PRO_RESEAU GENIE LOGICIEL 1', 'RGL'),
('LPRGL2', 'LICENCE PRO_RESEAU GENIE LOGICIEL 2', 'RGL'),
('LPRGL3', 'LICENCE PRO_RESEAU GENIE LOGICIEL 3', 'RGL');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `NumPai` varchar(20) NOT NULL,
  `LibPai` varchar(25) NOT NULL,
  `DatePai` date NOT NULL,
  `MonatantPai` varchar(7) NOT NULL,
  `ModePai` varchar(15) NOT NULL,
  `MatEtud` varchar(10) NOT NULL,
  `NumInscrip` varchar(6) NOT NULL,
  `CodeCaisse` varchar(6) NOT NULL,
  PRIMARY KEY (`NumPai`),
  KEY `MatEtud` (`MatEtud`),
  KEY `NumInscrip` (`NumInscrip`),
  KEY `CodeCaisse` (`CodeCaisse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`NumPai`, `LibPai`, `DatePai`, `MonatantPai`, `ModePai`, `MatEtud`, `NumInscrip`, `CodeCaisse`) VALUES
('0002', 'INSCRIPTION', '2019-06-07', '270000', 'orange', '1111', '9773', '231'),
('000245789', 'INSCRIPTION', '2019-06-10', '270000', 'orange', '007', '5564', '231'),
('A12345', 'INSCRIPTION', '2019-06-11', '270000', 'orange', '008', '1308', '231'),
('C12457', 'INSCRIPTION', '2019-06-12', '270000', 'moov', 'Ab2121', '2260', '231');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fournir`
--
ALTER TABLE `fournir`
  ADD CONSTRAINT `fournir_ibfk_3` FOREIGN KEY (`MatEtud`) REFERENCES `etudiant` (`MatEtud`),
  ADD CONSTRAINT `fournir_ibfk_4` FOREIGN KEY (`NumDoss`) REFERENCES `dossier` (`NumDoss`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`CodeNiv`) REFERENCES `niveau` (`CodeNiv`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`CodeFil`) REFERENCES `filiere` (`CodeFil`),
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`CodeAnnee`) REFERENCES `anneeacademique` (`CodeAnnee`);

--
-- Contraintes pour la table `lier`
--
ALTER TABLE `lier`
  ADD CONSTRAINT `lier_ibfk_1` FOREIGN KEY (`CodeFil`) REFERENCES `filiere` (`CodeFil`),
  ADD CONSTRAINT `lier_ibfk_2` FOREIGN KEY (`Codecyle`) REFERENCES `cycle` (`CodeCycle`);

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`CodeFil`) REFERENCES `filiere` (`CodeFil`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`MatEtud`) REFERENCES `etudiant` (`MatEtud`),
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`NumInscrip`) REFERENCES `inscription` (`NumInscrip`),
  ADD CONSTRAINT `paiement_ibfk_3` FOREIGN KEY (`CodeCaisse`) REFERENCES `caisse` (`CodeCaisse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
