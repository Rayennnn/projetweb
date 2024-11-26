-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 nov. 2024 à 18:09
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
-- Base de données : `webprojet`
--

-- --------------------------------------------------------

--
-- Structure de la table `bourses d'étude`
--

CREATE TABLE `bourses d'étude` (
  `id_bourse` int(11) NOT NULL,
  `nom_bourse` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `organisme` varchar(100) NOT NULL,
  `date_limite` date NOT NULL,
  `age_limite` int(11) NOT NULL,
  `niveau_etude` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `lien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clubs et associations`
--

CREATE TABLE `clubs et associations` (
  `id_club` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `nom_club` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_creation` date NOT NULL,
  `categorie` enum('Culture','Sport','Technologie','Art','Social','Scientifique','Environnement') NOT NULL,
  `lieu` varchar(256) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `lien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_formation` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `nom_formation` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `organisme` varchar(256) NOT NULL,
  `prix` int(11) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `lien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE `programmes` (
  `id_prog` int(11) NOT NULL,
  `nom_prog` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `organisme` varchar(100) NOT NULL,
  `date_limite` date NOT NULL,
  `age_limite` int(11) NOT NULL,
  `niveau_etude` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `lien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `id_auteur` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `titre`, `id_auteur`, `date`, `type`) VALUES
(1, 'Do you believe studying in Tunisia would open up a world of unique educational adventures?', 'rima', '21-11-2024', 'education'),
(3, 'Would you be excited to dive into academic clubs like STEM, Literature, or History?', 'rima', '21-11-2024', 'clubs'),
(4, 'Would you join formative clubs  to express yourself and expert leadership ?', 'rima', 'Would you join formative clubs  to express yourself and expert leadership ?', 'club'),
(110, 'Do you believe studying in Tunisia would open up a world of unique educational adventures?', 'rima', '20/11/2024', 'education'),
(120, 'Would you be excited to dive into academic clubs like STEM, Literature, or History?', '52', '20/11/2024', 'education'),
(130, 'Would you join formative clubs  to express yourself and expert leadership ?', 'rima', '20/11/2024', 'club'),
(140, 'Do you think sports clubs could help you stay active and energized?', 'rima', '20/11/2024', 'club'),
(150, 'Would you like to develop your leadership skills through programs like student council?', 'rima', '20/11/2024', 'formations'),
(160, 'Do you think attending skill development workshops (e.g., time management, career planning) would help you shine?', 'rima', '20/11/2024', 'formations'),
(170, 'Do you feel you have enough support from your institution to participate in an exchange program?', 'rima', '20/11/2024', 'exchange programs'),
(180, 'Would you be interested in exploring global cultures through international exchange programs?', 'rima', '20/11/2024', 'exchange programs');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `id_question` int(11) NOT NULL,
  `choix_rp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse_suggestion`
--

CREATE TABLE `reponse_suggestion` (
  `id_rep_sugges` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `reponse` text NOT NULL,
  `date_reponse` date NOT NULL DEFAULT current_timestamp(),
  `id_suggestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suggestions`
--

CREATE TABLE `suggestions` (
  `id_suggestion` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `contenu` text NOT NULL,
  `date_soumission` date NOT NULL DEFAULT current_timestamp(),
  `statut` enum('en attente','traitée','rejetée') NOT NULL,
  `type_feedback` enum('reclamation','suggestion') NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `témoignages`
--

CREATE TABLE `témoignages` (
  `id_tem` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `type` enum('conseil','experience') NOT NULL,
  `categorie` varchar(265) NOT NULL,
  `description` text NOT NULL,
  `nom_auteur` varchar(100) NOT NULL,
  `tags` varchar(256) NOT NULL,
  `statut` enum('publié','brouillon') NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `nom` varchar(256) NOT NULL,
  `prénom` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `role` enum('admin','etudiant') NOT NULL,
  `mdp` int(11) NOT NULL,
  `status_compte` enum('actif','en attente','desactivé') NOT NULL,
  `photo` varchar(256) NOT NULL,
  `fac` varchar(255) NOT NULL,
  `domaine` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bourses d'étude`
--
ALTER TABLE `bourses d'étude`
  ADD PRIMARY KEY (`id_bourse`);

--
-- Index pour la table `clubs et associations`
--
ALTER TABLE `clubs et associations`
  ADD PRIMARY KEY (`id_club`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id_prog`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse_suggestion`
--
ALTER TABLE `reponse_suggestion`
  ADD PRIMARY KEY (`id_rep_sugges`),
  ADD KEY `Foreign Key` (`id_suggestion`);

--
-- Index pour la table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id_suggestion`),
  ADD KEY `Foreign Key` (`id_utilisateur`);

--
-- Index pour la table `témoignages`
--
ALTER TABLE `témoignages`
  ADD PRIMARY KEY (`id_tem`),
  ADD KEY `Foreign Key` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id_suggestion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT';

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponse_suggestion`
--
ALTER TABLE `reponse_suggestion`
  ADD CONSTRAINT `fk_id_suggestion` FOREIGN KEY (`id_suggestion`) REFERENCES `suggestions` (`id_suggestion`);

--
-- Contraintes pour la table `suggestions`
--
ALTER TABLE `suggestions`
  ADD CONSTRAINT `fk_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `témoignages`
--
ALTER TABLE `témoignages`
  ADD CONSTRAINT `fk_id_utilisateur2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
