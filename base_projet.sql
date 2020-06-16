-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 juin 2020 à 23:57
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--
CREATE DATABASE IF NOT EXISTS `projet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projet`;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mot_passe` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id_admin`, `nom`, `prenom`, `mot_passe`) VALUES
(1, 'crenn', 'antoine', '$2y$10$n/xCiQA7b60nywT3.7Kr2OtgugyN7h6wQR5w/lOBkcZKPGKVvl3Ze'),
(2, 'dournet', 'clement', '$2y$10$HfKWfNqBmz6JEEgedH42c.5WxOgotrfMo/Zpm3Yqnej346EHeNJ7a'),
(3, 'texier', 'marc', '$2y$10$jRsfLPotMnI11Sjyy.Q0eO.us.R9X216R8T4TsKSUGOWDyYZC/YUG');

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id_annonce` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `prix` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `id_client`, `nom`, `description`, `prix`, `ville`, `date`, `status`, `categorie`) VALUES
(3, 4, 'canape imitation cuir', 'canapé d\'angle imitation cuir noir', 200, 'Bordeaux', '2020-06-16 20:22:33', 'active', 'ameublement'),
(4, 4, 'surface pro 3', 'vend Microsoft surface pro 3 excellent état', 400, 'Bordeaux', '2020-06-16 15:37:32', 'active', 'ordinateur'),
(5, 6, 'armoire en bois', 'armoire en bois ancien. bon état', 350, 'Libourne', '2020-06-16 20:33:55', 'active', 'ameublement'),
(6, 5, 'macbook air', 'macbook air gris. très bon état', 500, 'Bordeaux', '2020-06-16 16:21:56', 'inactive', 'ordinateur');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse_mail` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mot_passe` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `nom`, `prenom`, `adresse_mail`, `telephone`, `mot_passe`) VALUES
(4, 'PIQUART', 'Patrick', 'patrick.piquart@ynov.com', '0556900010', '$2y$10$8UV0PU3.3au5bbPFsbGxl.QzI8UJTDkYoZ.n6YDx6QAonRzwagzQm'),
(5, 'DREYFUS', 'John', 'john.dreyfus@ynov.com', '0556900010', '$2y$10$ZfMWCxQGBw.fyjhAPgFspeOeJeXRdOk8l0YChFFRjJvhJJOs0hNc2'),
(6, 'NAY', 'Yannick', 'yannick.nay@ynov.com', '0556900010', '$2y$10$aZ4Yk0k4x5mu0bjWAPKImORL2ykQkrWb8Q1blPMmAeQL0Eh58kKyO');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id_messagerie` int(11) NOT NULL,
  `id_proprietaire` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id_messagerie`, `id_proprietaire`, `id_acheteur`, `id_annonce`) VALUES
(1, 4, 6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_messagerie` int(11) NOT NULL,
  `texte` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_client`, `id_messagerie`, `texte`) VALUES
(1, 6, 1, 'Bonjour, je suis intéressé par votre annonce, est elle toujours disponible ?'),
(2, 4, 1, 'Oui Monsieur elle est disponible.'),
(3, 6, 1, 'D\'accord parfait je peux vous la prendre demain ?'),
(4, 4, 1, 'Oui');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `annonce_client` (`id_client`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id_messagerie`),
  ADD KEY `messagerie_acheteur` (`id_acheteur`),
  ADD KEY `messagerie_proprietaire` (`id_proprietaire`),
  ADD KEY `messagerie_annonce` (`id_annonce`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `message_client` (`id_client`),
  ADD KEY `message_messagerie` (`id_messagerie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id_messagerie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonce_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `messagerie_acheteur` FOREIGN KEY (`id_acheteur`) REFERENCES `clients` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messagerie_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id_annonce`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messagerie_proprietaire` FOREIGN KEY (`id_proprietaire`) REFERENCES `clients` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_messagerie` FOREIGN KEY (`id_messagerie`) REFERENCES `messagerie` (`id_messagerie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
