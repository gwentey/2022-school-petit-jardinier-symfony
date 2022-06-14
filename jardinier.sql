-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 30 mars 2022 à 07:09
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jardinier`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Charlotte'),
(2, 'Nugats\r\n'),
(3, 'Boguzs');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `utilisateur_id`, `date`) VALUES
(1, NULL, '2022-03-29'),
(2, NULL, '2022-03-29'),
(3, 1, '2022-03-29'),
(4, 1, '2022-03-29'),
(5, NULL, '2022-03-29'),
(8, 1, '2022-03-29'),
(9, 1, '2022-03-30'),
(10, NULL, '2022-03-30'),
(11, NULL, '2022-03-30'),
(12, 1, '2022-03-30'),
(13, 1, '2022-03-30'),
(14, NULL, '2022-03-30'),
(15, 10, '2022-03-30'),
(16, 10, '2022-03-30');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220329201925', '2022-03-29 20:19:28', 279);

-- --------------------------------------------------------

--
-- Structure de la table `haie`
--

CREATE TABLE `haie` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `haie`
--

INSERT INTO `haie` (`id`, `categorie_id`, `nom`, `prix`) VALUES
(1, 2, 'HaieChaaa', '50.88'),
(3, 1, 'Charloote', '3.00'),
(4, 1, 'dsds', '33.00'),
(5, 1, 'DSQD', '33.00'),
(6, 3, 'Haie88DD', '8.88');

-- --------------------------------------------------------

--
-- Structure de la table `tailler`
--

CREATE TABLE `tailler` (
  `id` int(11) NOT NULL,
  `haie_id` int(11) DEFAULT NULL,
  `devis_id` int(11) DEFAULT NULL,
  `hauteur` bigint(20) DEFAULT NULL,
  `longueur` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tailler`
--

INSERT INTO `tailler` (`id`, `haie_id`, `devis_id`, `hauteur`, `longueur`) VALUES
(3, 1, 3, 4, 5),
(4, 1, 4, 88, 88),
(15, 1, 8, 33, 432),
(17, 1, 3, 33, 33),
(18, 3, 9, 44, 33),
(21, 3, 12, 45, 33),
(22, 3, 13, 44, 33),
(27, 3, 15, 34, 22),
(28, 3, 16, 44, 33);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `roles`, `password`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `type_client`) VALUES
(1, 'admin', '[]', '$2y$13$OZ1ar86ZZcQaSZIfV.RamuxGNVXSJwOd38.pWkxhflkXT9p6YV3HS', 'dsqdqs', 'dsqdqs', 'dsqdqsdqs', '33333', 'dsqdqs', 'particulier'),
(5, 'HOW', '[]', '$2y$13$q61oeWc8A135iScosKo3KO/wwtq5U4aIoFh8Qe1dsSve/ba54xTlq', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'dsqdsq', '[]', '$2y$13$vwhykCPEB6ozsmFtI5ktUeG.VzqWjYjeVSC0xAVgSF67IopSjLxfi', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'hello', '[]', '$2y$13$fttjRgc.mi/NpW.FJf9iQ.SkJ6i3sdDYD8mHpjXiWugQCV5v4jnUG', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'kikd', '[]', '$2y$13$qSfq.qd1mkm3o0cVuKxLleHlDAuMOmzJIlhUCMDXPVKQ8CBcJYz.m', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'dsqdSS', '[]', '$2y$13$TRBn/N/V8Fvn0XEBkdP3YevDlNfr1jc2MbckfBKOi/xvrn2eSBkvm', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'madame', '[]', '$2y$13$.8OxBQzQHEGEWLWoO4e1S.rdz6r.SV8FYgLl4d5URTChhsKAxwvvS', 'dsds', 'Bdddfds', 'dqsdqsdqs', '23454', 'dsqd', 'particulier');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8B27C52BFB88E14F` (`utilisateur_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `haie`
--
ALTER TABLE `haie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F24E4DEBCF5E72D` (`categorie_id`);

--
-- Index pour la table `tailler`
--
ALTER TABLE `tailler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_447D1788E7470F2C` (`haie_id`),
  ADD KEY `IDX_447D178841DEFADA` (`devis_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `haie`
--
ALTER TABLE `haie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tailler`
--
ALTER TABLE `tailler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `FK_8B27C52BFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `haie`
--
ALTER TABLE `haie`
  ADD CONSTRAINT `FK_1F24E4DEBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `tailler`
--
ALTER TABLE `tailler`
  ADD CONSTRAINT `FK_447D178841DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`),
  ADD CONSTRAINT `FK_447D1788E7470F2C` FOREIGN KEY (`haie_id`) REFERENCES `haie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
