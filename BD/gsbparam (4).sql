-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 07 avr. 2026 à 09:08
-- Version du serveur : 11.5.2-MariaDB
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsbparam`
--

-- --------------------------------------------------------

--
-- Structure de la table `associer`
--

DROP TABLE IF EXISTS `associer`;
CREATE TABLE IF NOT EXISTS `associer` (
  `idProd` char(3) NOT NULL,
  `idProd_produit` char(3) NOT NULL,
  PRIMARY KEY (`idProd`,`idProd_produit`),
  UNIQUE KEY `idProd_UNQ` (`idProd`),
  UNIQUE KEY `idProd_produit_UNQ` (`idProd_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` char(3) NOT NULL,
  `libelleCat` varchar(50) NOT NULL,
  PRIMARY KEY (`idCat`),
  UNIQUE KEY `idCat_UNQ` (`idCat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCat`, `libelleCat`) VALUES
('CH', 'Cheveux'),
('CO', 'Corps'),
('CR', 'Creme'),
('FO', 'Forme'),
('FR', 'France'),
('PS', 'Protection Solaire');

-- --------------------------------------------------------

--
-- Structure de la table `ecrire_avis`
--

DROP TABLE IF EXISTS `ecrire_avis`;
CREATE TABLE IF NOT EXISTS `ecrire_avis` (
  `idUser` int(11) NOT NULL,
  `idProd` char(3) NOT NULL,
  `note` smallint(6) NOT NULL,
  `date_avis` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`idUser`,`idProd`),
  UNIQUE KEY `idProd_UNQ` (`idProd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `enavant`
--

DROP TABLE IF EXISTS `enavant`;
CREATE TABLE IF NOT EXISTS `enavant` (
  `idMEA` int(11) NOT NULL AUTO_INCREMENT,
  `libelleMEA` varchar(50) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`idMEA`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `enavant`
--

INSERT INTO `enavant` (`idMEA`, `libelleMEA`, `dateDebut`, `dateFin`) VALUES
(1, 'Saint-Valentin', '2026-02-14', '2026-02-14');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `idEtat` int(11) NOT NULL AUTO_INCREMENT,
  `libelleEtat` varchar(50) NOT NULL,
  PRIMARY KEY (`idEtat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`idEtat`, `libelleEtat`) VALUES
(1, 'Dans le panier'),
(2, 'Validé'),
(3, 'Envoyé'),
(4, 'Reçu');

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

DROP TABLE IF EXISTS `habilitation`;
CREATE TABLE IF NOT EXISTS `habilitation` (
  `idHab` int(11) NOT NULL AUTO_INCREMENT,
  `libelleHab` varchar(11) NOT NULL,
  PRIMARY KEY (`idHab`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `habilitation`
--

INSERT INTO `habilitation` (`idHab`, `libelleHab`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

DROP TABLE IF EXISTS `lignecommande`;
CREATE TABLE IF NOT EXISTS `lignecommande` (
  `idLignCde` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `idCom` int(11) NOT NULL,
  `idProd` char(3) NOT NULL,
  PRIMARY KEY (`idLignCde`),
  KEY `ligneCommande_idCom_FK` (`idCom`),
  KEY `ligneCommande_idProd_FK` (`idProd`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `lignecommande`
--

INSERT INTO `lignecommande` (`idLignCde`, `quantite`, `idCom`, `idProd`) VALUES
(15, 1, 1101461660, 'f03'),
(16, 1, 1101461660, 'p01'),
(17, 1, 1101461665, 'f05'),
(18, 1, 1101461665, 'p06'),
(19, 1, 1101461666, 'c01'),
(20, 1, 1101461667, 'c03'),
(21, 1, 1101461669, 'c02'),
(22, 1, 1101461669, 'c04'),
(23, 1, 1101461669, 'c05'),
(24, 1, 1101461669, 'f04'),
(25, 1, 1101461669, 'f05'),
(26, 1, 1101461670, 'c03'),
(27, 1, 1101461671, 'c03'),
(28, 1, 1101461671, 'p02');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(50) NOT NULL,
  `motPasse` varchar(500) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idLog`),
  KEY `login_idUser_FK` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`idLog`, `Pseudo`, `motPasse`, `idUser`) VALUES
(1, 'Vinlag', 'VinLag!', 1),
(2, 'Josgar', 'Josgar!', 2),
(3, 'LeBoss', 'TheBest$147#', 3),
(4, 'LeChefProjet', 'NearlyTheBest$280@', 4);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `idMarque` int(11) NOT NULL AUTO_INCREMENT,
  `libelleMarque` varchar(20) NOT NULL,
  PRIMARY KEY (`idMarque`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`idMarque`, `libelleMarque`) VALUES
(1, 'Laino'),
(2, 'Klorane'),
(3, 'Weleda'),
(4, 'Phytopulp'),
(5, 'Nuxe'),
(6, 'Romon'),
(7, 'La Roche Posay'),
(8, 'Futuro'),
(9, 'Microlife'),
(10, 'Melapi'),
(11, 'Avène'),
(12, 'Mustela'),
(13, 'Isdin'),
(14, 'Uriage'),
(15, 'Bioderma');

-- --------------------------------------------------------

--
-- Structure de la table `paniercommande`
--

DROP TABLE IF EXISTS `paniercommande`;
CREATE TABLE IF NOT EXISTS `paniercommande` (
  `idCom` int(11) NOT NULL AUTO_INCREMENT,
  `dateCom` date DEFAULT NULL,
  `montantCom` decimal(8,2) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idEtat` int(11) NOT NULL,
  PRIMARY KEY (`idCom`),
  UNIQUE KEY `idCom_UNQ` (`idCom`),
  KEY `panierCommande_idUser_FK` (`idUser`),
  KEY `panierCommande_idEtat_FK` (`idEtat`)
) ENGINE=InnoDB AUTO_INCREMENT=1101461672 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `paniercommande`
--

INSERT INTO `paniercommande` (`idCom`, `dateCom`, `montantCom`, `idUser`, `idEtat`) VALUES
(1101461660, '2024-09-01', 33.00, 5, 4),
(1101461665, '2024-09-01', 68.65, 6, 4),
(1101461666, '2025-10-10', 4.00, 5, 4),
(1101461667, '2025-10-10', 4.00, 6, 3),
(1101461669, '2025-10-16', 110.40, 5, 3),
(1101461670, '2025-12-18', 4.00, 6, 2),
(1101461671, '2025-12-18', 21.50, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pousser`
--

DROP TABLE IF EXISTS `pousser`;
CREATE TABLE IF NOT EXISTS `pousser` (
  `idMEA` int(11) NOT NULL,
  `idProd` char(3) NOT NULL,
  KEY `FK_produit_pousser` (`idProd`),
  KEY `FK_enavant_pousser` (`idMEA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `pousser`
--

INSERT INTO `pousser` (`idMEA`, `idProd`) VALUES
(1, 'c01');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `idProd` char(3) NOT NULL,
  `nomProd` char(50) NOT NULL,
  `prixProd` decimal(10,2) DEFAULT NULL,
  `contenanceProd` int(11) NOT NULL,
  `uniteProd` varchar(3) NOT NULL,
  `stockProd` int(11) NOT NULL,
  `dateAjoutProd` date NOT NULL,
  `imageProd` varchar(255) DEFAULT NULL,
  `descriptionProd` varchar(150) DEFAULT NULL,
  `idCat` char(3) DEFAULT NULL,
  `idMarque` int(11) NOT NULL,
  PRIMARY KEY (`idProd`),
  UNIQUE KEY `idProd_UNQ` (`idProd`),
  KEY `produit_idMarque_FK` (`idMarque`),
  KEY `produit_idCat_FK` (`idCat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProd`, `nomProd`, `prixProd`, `contenanceProd`, `uniteProd`, `stockProd`, `dateAjoutProd`, `imageProd`, `descriptionProd`, `idCat`, `idMarque`) VALUES
('c01', 'Laino Shampooing Douche Thé Vert BIO', 4.00, 200, 'ml', 100, '2026-03-30', 'assets/images/laino-shampooing-douche-au-the-vert-bio-200ml.png', 'Shampooing bio', 'CH', 1),
('c02', 'Klorane fibres de lin baume après shampooing', 10.80, 150, 'ml', 100, '2026-03-30', 'assets/images/klorane-fibres-de-lin-baume-apres-shampooing-150-ml.jpg', 'Baume volume', 'CH', 2),
('c03', 'Weleda Kids 2in1 Shower Shampoo Orange', 4.00, 150, 'ml', 100, '2026-03-30', 'assets/images/weleda-kids-2in1-shower-shampoo-orange-fruitee-150-ml.jpg', 'Shampooing enfant', 'CH', 3),
('c04', 'Weleda Kids 2in1 Shower Shampoo Vanille', 4.00, 150, 'ml', 100, '2026-03-30', 'assets/images/weleda-kids-2in1-shower-shampoo-vanille-douce-150-ml.jpg', 'Shampooing enfant', 'CH', 3),
('c05', 'Klorane Shampooing sec ortie', 6.10, 150, 'ml', 100, '2026-03-30', 'assets/images/klorane-shampooing-sec-a-l-extrait-d-ortie-spray-150ml.png', 'Shampooing sec', 'CH', 2),
('c06', 'Phytopulp mousse volume intense', 18.00, 200, 'ml', 100, '2026-03-30', 'assets/images/phytopulp-mousse-volume-intense-200ml.jpg', 'Mousse volume', 'CH', 4),
('c07', 'Bio Beaute Nuxe Shampooing nutritif', 8.00, 200, 'ml', 100, '2026-03-30', 'assets/images/bio-beaute-by-nuxe-shampooing-nutritif-200ml.png', 'Shampooing nutritif', 'CH', 5),
('f01', 'Nuxe Men Contour des Yeux', 12.05, 15, 'ml', 100, '2026-03-30', 'assets/images/nuxe-men-contour-des-yeux-multi-fonctions-15ml.png', 'Contour yeux', 'FO', 5),
('f02', 'Tisane Romon Sommeil Bio', 5.50, 20, 'u', 100, '2026-03-30', 'assets/images/tisane-romon-nature-sommirel-bio-sachet-20.jpg', 'Tisane sommeil', 'FO', 6),
('f03', 'La Roche Posay Cicaplast', 11.00, 40, 'ml', 100, '2026-03-30', 'assets/images/la-roche-posay-cicaplast-creme-pansement-40ml.jpg', 'Crème réparatrice', 'FO', 7),
('f04', 'Futuro stabilisateur cheville', 26.50, 1, 'u', 100, '2026-03-30', 'assets/images/futuro-sport-stabilisateur-pour-cheville-deluxe-attelle-cheville.png', 'Attelle cheville', 'FO', 8),
('f05', 'Microlife pèse-personne électronique', 63.00, 1, 'u', 100, '2026-03-30', 'assets/images/microlife-pese-personne-electronique-weegschaal-ws80.jpg', 'Pèse personne', 'FO', 9),
('f06', 'Melapi miel thym 500g', 6.50, 500, 'g', 100, '2026-03-30', 'assets/images/melapi-miel-thym-liquide-500g.jpg', 'Miel thym', 'FO', 10),
('f07', 'Meliflor pollen 200g', 8.60, 200, 'g', 100, '2026-03-30', 'assets/images/melapi-pollen-250g.jpg', 'Pollen naturel', 'FO', 10),
('p01', 'Avène solaire spray SPF50+', 22.00, 200, 'ml', 100, '2026-03-30', 'assets/images/avene-solaire-spray-tres-haute-protection-spf50200ml.png', 'Spray solaire', 'PS', 11),
('p02', 'Mustela solaire lait SPF50+', 17.50, 100, 'ml', 100, '2026-03-30', 'assets/images/mustela-solaire-lait-tres-haute-protection-spf50-100ml.jpg', 'Lait solaire', 'PS', 12),
('p03', 'Isdin Eryfotona fluid', 29.00, 50, 'ml', 100, '2026-03-30', 'assets/images/isdin-eryfotona-aak-fluid-100-50ml.jpg', 'Protection solaire', 'PS', 13),
('p04', 'La Roche Posay Anthelios brume SPF50+', 8.75, 75, 'ml', 100, '2026-03-30', 'assets/images/la-roche-posay-anthelios-50-brume-visage-toucher-sec-75ml.png', 'Brume solaire', 'PS', 7),
('p05', 'Nuxe Sun huile capillaire', 15.00, 100, 'ml', 100, '2026-03-30', 'assets/images/nuxe-sun-huile-lactee-capillaire-protectrice-100ml.png', 'Huile cheveux', 'PS', 5),
('p06', 'Uriage stick lèvres SPF30', 5.65, 4, 'g', 100, '2026-03-30', 'assets/images/uriage-bariesun-stick-levres-spf30-4g.jpg', 'Stick lèvres', 'PS', 14),
('p07', 'Bioderma Cicabio SPF50+', 13.70, 30, 'ml', 100, '2026-03-30', 'assets/images/bioderma-cicabio-creme-spf50-30ml.png', 'Crème réparatrice', 'PS', 15);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nomUser` varchar(20) NOT NULL,
  `prenomUser` varchar(20) NOT NULL,
  `adresseMailUser` varchar(50) NOT NULL,
  `adresseRueUser` varchar(50) NOT NULL,
  `villeUser` varchar(10) NOT NULL,
  `cpUser` char(11) NOT NULL,
  `idHab` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `utilisateur_idHab_FK` (`idHab`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `nomUser`, `prenomUser`, `adresseMailUser`, `adresseRueUser`, `villeUser`, `cpUser`, `idHab`) VALUES
(1, 'LaGaffe', 'Vincent', 'Vincent.LaG@mail.com', '12 rue des lilas', 'Lyon', '69000', 1),
(2, 'Garcia', 'José', 'Jose_Garcia@mail.com', '125Bis faubourt des moineaux', 'Fleury', '45400', 1),
(3, 'Boss', 'Hugo', 'HugoBoss@mail.com', '45 rue des chardons', 'Saint-Malo', '35400', 1),
(4, 'Chef', 'Bogo', 'BogoCHef45@mail.com', '72 impasse dees coquelicot', 'Nîmes', '30000', 1),
(5, 'Dupont', 'Jacques', 'dupont@wanadoo.fr', '12 rue haute', 'Paris', '75001', 2),
(6, 'Durant', 'Yves', 'durant@free.fr', '23 rue des ombres', 'Paris', '75012', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `associer`
--
ALTER TABLE `associer`
  ADD CONSTRAINT `ASSOCIER_idProd_FK` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`),
  ADD CONSTRAINT `ASSOCIER_idProd_produit_FK` FOREIGN KEY (`idProd_produit`) REFERENCES `produit` (`idProd`);

--
-- Contraintes pour la table `ecrire_avis`
--
ALTER TABLE `ecrire_avis`
  ADD CONSTRAINT `ecrire_avis_idProd_FK` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`),
  ADD CONSTRAINT `ecrire_avis_idUser_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD CONSTRAINT `ligneCommande_idCom_FK` FOREIGN KEY (`idCom`) REFERENCES `paniercommande` (`idCom`),
  ADD CONSTRAINT `ligneCommande_idProd_FK` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_idUser_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `paniercommande`
--
ALTER TABLE `paniercommande`
  ADD CONSTRAINT `panierCommande_idEtat_FK` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`idEtat`),
  ADD CONSTRAINT `panierCommande_idUser_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `pousser`
--
ALTER TABLE `pousser`
  ADD CONSTRAINT `FK_enavant_pousser` FOREIGN KEY (`idMEA`) REFERENCES `enavant` (`idMEA`),
  ADD CONSTRAINT `FK_produit_pousser` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_idCat_FK` FOREIGN KEY (`idCat`) REFERENCES `categorie` (`idCat`),
  ADD CONSTRAINT `produit_idMarque_FK` FOREIGN KEY (`idMarque`) REFERENCES `marque` (`idMarque`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_idHab_FK` FOREIGN KEY (`idHab`) REFERENCES `habilitation` (`idHab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
