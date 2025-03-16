-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 16 mars 2025 à 10:57
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
-- Base de données : `utilisateurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `people`
--
-- Erreur de lecture de structure pour la table utilisateurs.people : #1932 - Table &#039;utilisateurs.people&#039; doesn&#039;t exist in engine
-- Erreur de lecture des données pour la table utilisateurs.people : #1064 - Erreur de syntaxe près de &#039;FROM `utilisateurs`.`people`&#039; à la ligne 1

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Mot_de_passe` varchar(50) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `Prenom`, `Nom`, `Login`, `Mot_de_passe`, `photo`) VALUES
(1, 'Mareme', 'Tine', 'tigresse', '$2y$10$VhVeO7juRCY65UKnKqa6ZeLyCVwlVgm7WqAQvGtkQT7', 'photo/WhatsApp Image 2025-03-15 à 23.53.12_5d6e6ddb.jpg'),
(3, 'AWA', 'Sow', 'sokhnaaa', '$2y$10$10pPzOLNF4p8mgk4B8Ix1us.t7jtkNKUejpNXVEJbdK', 'photo/WhatsApp Image 2025-03-16 à 00.08.04_97f222cf.jpg'),
(4, 'Rihanna', 'Fenty', 'rihannaaa', '61046ab33cc75c024edf102cf2de96889c20b321', 'photo/rihanna.jpeg'),
(5, 'Ndeye Maty', 'GAYE', 'matyyy', '$2y$10$wQ8afcBeQkKaX6dgrJUVe.z6VLiWqGnRjnF914Ts09V', 'photo/PHOTO-2025-03-14-23-23-14.jpg'),
(6, 'fatou', 'Ndiaye', 'fatouuup', '$2y$10$T7soaZznSqTQpW.zICWrSekjrHFV/wnx27XGMJAz.Gm', 'photo/fatou.jpeg'),
(10, 'Ousmane', 'Fall', 'Ouzin', '$2y$10$8ODqadqNsBPsDW.z1vcb3uU1RcElWSf31StmH0LEAqQ', 'photoOusmane.jpg'),
(11, 'Ibrahima', 'Diop', 'Ibouuu', '$2y$10$Xsw7UW50TJ9kZuaNQnhFaOTDA0YV2ZzcszXT8njeqPK', 'photoliss.jpg'),
(12, 'Beyonce', 'Carter', 'beyonceee', '$2y$10$aRXSeWQh4QV8TKEKGq9ZL.DNYiNVcf8sIsyPYhP9QEN', 'photoeyonce.jpeg'),
(13, 'Ramatoulaye', 'Faye', 'Ramsess', '$2y$10$82/EEbeItrbKJwCXiz6rOOweWUctYeK3CJt9RjhyIy7', 'photosis.jpg'),
(14, 'Ndiolé', 'Diouf', 'lasstar', '$2y$10$ycXw6tGYgSpRHbfI8q6gJOdP3XXbTT/PJLw6s.D2TCH', 'photo/Ndiolé.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
