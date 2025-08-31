-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : dim. 31 août 2025 à 20:53
-- Version du serveur : 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parkoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `parkings`
--

CREATE TABLE `parkings` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `price_per_hour` decimal(5,2) NOT NULL,
  `is_covered` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `parkings`
--

INSERT INTO `parkings` (`id`, `owner_id`, `address`, `city`, `postal_code`, `price_per_hour`, `is_covered`, `description`, `is_available`, `created_at`) VALUES
(1, 2, '12 rue du Lac', 'Lyon', '69001', 2.50, 1, 'Place couverte près du métro.', 1, '2025-08-31 20:12:41'),
(2, 4, '12 rue des Acacias', 'Toulouse', '31000', 1.80, 0, 'Bonjour , je vous propose 4 places de parking sécurisées ( portail et vidéo) à 5 min de l\'aéroport. Le trajet pour vous conduire à l\'aéroport et revenir vous chercher se fera avec mon véhicule personnel, de jour comme de nuit.', 1, '2025-08-31 20:12:41'),
(3, 2, '55 boulevard Saint-Michel', 'Paris', '75005', 3.50, 1, 'Garage sécurisé proche du Jardin du Luxembourg.', 1, '2025-08-31 20:12:41'),
(4, 4, '24 rue de la Plage', 'Nice', '06000', 2.00, 0, 'Stationnement à 5 min à pied de la mer.', 0, '2025-08-31 20:12:41');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `parking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `total_price` decimal(7,2) NOT NULL,
  `status` enum('en_attente','confirmée','annulée','terminée') DEFAULT 'en_attente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('propriétaire','conducteur') NOT NULL DEFAULT 'conducteur',
  `rating` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `rating`, `created_at`) VALUES
(1, 'alice', 'alice@example.com', 'password1', 'conducteur', 4.5, '2025-08-31 20:04:18'),
(2, 'bob', 'bob@example.com', 'password2', 'propriétaire', 4.8, '2025-08-31 20:04:18'),
(3, 'john', 'john@example.com', 'password3', 'conducteur', NULL, '2025-08-31 20:04:18'),
(4, 'david', 'david@example.com', 'password4', 'propriétaire', 4.2, '2025-08-31 20:04:18');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `parkings`
--
ALTER TABLE `parkings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parking_id` (`parking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `parkings`
--
ALTER TABLE `parkings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `parkings`
--
ALTER TABLE `parkings`
  ADD CONSTRAINT `parkings_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`parking_id`) REFERENCES `parkings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
