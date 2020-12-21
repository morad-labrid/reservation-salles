-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 21 déc. 2020 à 10:27
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(95, 'SAMIR', 'kjhluhoiu', '2020-12-15 19:00:00', '2020-12-15 20:00:00', 1),
(96, 'SAMIR', 'kjhluhoiu', '2020-12-15 20:00:00', '2020-12-15 21:00:00', 1),
(97, 'SAMIR', 'kjhluhoiu', '2020-12-15 21:00:00', '2020-12-15 22:00:00', 1),
(98, 'BENRABEH', 'hlhu', '2020-12-16 19:00:00', '2020-12-16 20:00:00', 1),
(99, 'BENRABEH', 'hlhu', '2020-12-16 20:00:00', '2020-12-16 21:00:00', 1),
(100, 'BENRABEH', 'hlhu', '2020-12-16 21:00:00', '2020-12-16 22:00:00', 1),
(101, 'BENRABEH', 'hlhu', '2020-12-16 22:00:00', '2020-12-16 23:00:00', 1),
(102, 'MARIAGE', 'dzczdc', '2020-12-25 15:00:00', '2020-12-25 16:00:00', 3),
(103, 'aniversaire', 'uhliun liub l hlbn', '2021-03-10 20:00:00', '2021-03-10 21:00:00', 3),
(104, 'aniversaire', 'uhliun liub l hlbn', '2021-03-10 21:00:00', '2021-03-10 22:00:00', 3),
(105, 'aniversaire', 'uhliun liub l hlbn', '2021-03-10 22:00:00', '2021-03-10 23:00:00', 3),
(106, 'MARIAGE', 'qcqs', '2020-12-25 20:00:00', '2020-12-25 21:00:00', 3),
(107, 'MARIAGE', 'qcqs', '2020-12-25 21:00:00', '2020-12-25 22:00:00', 3),
(108, 'MARIAGE', 'qcqs', '2020-12-25 22:00:00', '2020-12-25 23:00:00', 3),
(109, 'FAMILLE', 'oqjsmfqef', '2020-12-18 17:00:00', '2020-12-18 18:00:00', 3),
(110, 'FAMILLE', 'oqjsmfqef', '2020-12-18 18:00:00', '2020-12-18 19:00:00', 3),
(111, 'FAMILLE', 'oqjsmfqef', '2020-12-18 19:00:00', '2020-12-18 20:00:00', 3),
(112, 'FAMILLE', 'oqjsmfqef', '2020-12-18 20:00:00', '2020-12-18 21:00:00', 3),
(113, 'FAMILLE', 'oqjsmfqef', '2020-12-18 21:00:00', '2020-12-18 22:00:00', 3),
(114, 'FAMILLE', 'oqjsmfqef', '2020-12-18 22:00:00', '2020-12-18 23:00:00', 3),
(115, 'SOIREE ENTRE FILLES', 'bonjour, je souhaite reserver votre salle pour 3h pour une soirée entre fille', '2020-12-22 16:00:00', '2020-12-22 17:00:00', 3),
(116, 'SOIREE ENTRE FILLES', 'bonjour, je souhaite reserver votre salle pour 3h pour une soirée entre fille', '2020-12-22 17:00:00', '2020-12-22 18:00:00', 3),
(117, 'SOIREE ENTRE FILLES', 'bonjour, je souhaite reserver votre salle pour 3h pour une soirée entre fille', '2020-12-22 18:00:00', '2020-12-22 19:00:00', 3),
(118, 'aniversaire', 'mon anniversaire arrive bientot je veux une salle pour 35 personnes', '2021-01-05 18:00:00', '2021-01-05 19:00:00', 3),
(119, 'aniversaire', 'mon anniversaire arrive bientot je veux une salle pour 35 personnes', '2021-01-05 19:00:00', '2021-01-05 20:00:00', 3),
(120, 'MARIAGE', 'mon mariage avec alex une salle pour 150 personnes minimum', '2020-12-31 19:00:00', '2020-12-31 20:00:00', 3),
(121, 'MARIAGE', 'mon mariage avec alex une salle pour 150 personnes minimum', '2020-12-31 20:00:00', '2020-12-31 21:00:00', 3),
(122, 'MARIAGE', 'mon mariage avec alex une salle pour 150 personnes minimum', '2020-12-31 21:00:00', '2020-12-31 22:00:00', 3),
(123, 'MARIAGE', 'mon mariage avec alex une salle pour 150 personnes minimum', '2020-12-31 22:00:00', '2020-12-31 23:00:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$Mzp9aLaSIAyTG6Rmb62a/.M.g/iaR/Z6SYbof0o89HfO1mAyqo.TG'),
(2, 'Morad', '$2y$10$VYHwBsbrmURdCZa.d9Sx9enAL1ZyVi2mRfEp.4klZMEoT8DnauPA.'),
(3, 'iklam', '$2y$10$9wo1fqVX4.2KA2Mvzxj6uuv87Twzxx0uSV/zAJBC.ZLfNBHj9v/RG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
