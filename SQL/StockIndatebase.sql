-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 18 mai 2024 à 12:04
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `StockIndatebase`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(255) DEFAULT NULL,
  `prenom_client` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `num_tel` varchar(20) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `email`, `num_tel`, `mot_de_passe`, `adresse`) VALUES
(1, 'hadjam', 'jugurta', 'jugurta@gmail', '055555555', '827ccb0eea8a706c4c34a16891f84e7b', 'DEM');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date`, `montant`, `id_produit`, `id_client`) VALUES
(4, '2024-05-01', 123.00, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `num_tel` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `nom`, `num_tel`, `adresse`) VALUES
(1, 'fournisseur', '0791770731', 'DEM');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id_livraison` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id_livraison`, `date`, `id_client`, `id_commande`) VALUES
(19, '2024-05-17', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(255) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `prix_unit` decimal(10,2) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `prix_achat` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `libelle`, `prix_unit`, `quantite`, `id_fournisseur`, `prix_achat`) VALUES
(1, 'DYALNA 24p', 'Laitie', 220.00, 105, 1, 200.00),
(2, 'Cerealo miel', 'laitie', 35.00, 20, 1, 30.00),
(3, 'Café Aroma', 'Café', 380.00, 50, 1, 300.00),
(4, 'SELECTO', 'Boisson', 140.00, 400, 1, 120.00),
(5, 'capellini', 'Pàtes', 170.00, 30, 1, 160.00),
(6, 'Walima', 'Lingots', 340.00, 2, 1, 300.00),
(7, 'Walima', 'Lentilles', 340.00, 5, 1, 300.00),
(8, 'Lait soummam', 'laitie', 250.00, 400, 1, 225.00),
(9, 'Gaufrette Bimo', 'Gàteaux', 130.00, 150, 1, 120.00),
(10, 'Gazeuse mirinda', 'Boisson', 140.00, 30, 1, 120.00),
(11, 'Amor Benamor', 'Pàtes', 180.00, 40, 1, 150.00),
(12, 'Safina escargot', 'Pàtes', 75.00, 450, 1, 50.00),
(14, 'Izem', 'Boisson', 80.00, 200, 1, 60.00);

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE `proprietaire` (
  `id_proprietaire` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `proprietaire`
--

INSERT INTO `proprietaire` (`id_proprietaire`, `nom`, `prenom`, `password`, `username`) VALUES
(1, 'Nomadmin', 'Prenomadmin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `systeme`
--

CREATE TABLE `systeme` (
  `id_sys` int(11) NOT NULL,
  `nom_sys` varchar(255) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `date_inst` date DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_proprietaire` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_fournisseur`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id_livraison`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_fournisseur` (`id_fournisseur`);

--
-- Index pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD PRIMARY KEY (`id_proprietaire`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `systeme`
--
ALTER TABLE `systeme`
  ADD PRIMARY KEY (`id_sys`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_proprietaire` (`id_proprietaire`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_fournisseur` (`id_fournisseur`),
  ADD KEY `id_stock` (`id_stock`),
  ADD KEY `id_commande` (`id_commande`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  MODIFY `id_proprietaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `systeme`
--
ALTER TABLE `systeme`
  MODIFY `id_sys` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `livraison_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `livraison_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `systeme`
--
ALTER TABLE `systeme`
  ADD CONSTRAINT `systeme_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `systeme_ibfk_2` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaire` (`id_proprietaire`),
  ADD CONSTRAINT `systeme_ibfk_3` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `systeme_ibfk_4` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`),
  ADD CONSTRAINT `systeme_ibfk_5` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`),
  ADD CONSTRAINT `systeme_ibfk_6` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
