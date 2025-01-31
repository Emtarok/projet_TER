-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 jan. 2025 à 16:57
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ter`
--

-- --------------------------------------------------------

--
-- Structure de la table `faits`
--

CREATE TABLE `faits` (
  `idfaits` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_partage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partage`
--

CREATE TABLE `partage` (
  `idpartage` int(11) NOT NULL,
  `titre` int(50) NOT NULL,
  `contenu` int(50) NOT NULL,
  `datepartage` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postit`
--

CREATE TABLE `postit` (
  `idpost` int(11) NOT NULL,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idutilisateur` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `pseudo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faits`
--
ALTER TABLE `faits`
  ADD PRIMARY KEY (`idfaits`),
  ADD KEY `fk_faits_utilisateur` (`id_utilisateur`),
  ADD KEY `fk_faits_post` (`id_post`),
  ADD KEY `fk_faits_partage` (`id_partage`);

--
-- Index pour la table `partage`
--
ALTER TABLE `partage`
  ADD PRIMARY KEY (`idpartage`);

--
-- Index pour la table `postit`
--
ALTER TABLE `postit`
  ADD PRIMARY KEY (`idpost`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idutilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faits`
--
ALTER TABLE `faits`
  MODIFY `idfaits` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `idpartage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `postit`
--
ALTER TABLE `postit`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idutilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faits`
--
ALTER TABLE `faits`
  ADD CONSTRAINT `fk_faits_partage` FOREIGN KEY (`id_partage`) REFERENCES `partage` (`idpartage`),
  ADD CONSTRAINT `fk_faits_post` FOREIGN KEY (`id_post`) REFERENCES `postit` (`idpost`),
  ADD CONSTRAINT `fk_faits_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`idutilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
