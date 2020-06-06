-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 05 juin 2020 à 21:47
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.4

-- Create a new database called 'DatabaseName'
-- Connect to the 'master' database to run this snippet



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `programator`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Etudiant'),
(2, 'Professeur');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_cours`
--

CREATE TABLE `categorie_cours` (
  `id` int(6) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie_cours`
--

INSERT INTO `categorie_cours` (`id`, `nom`) VALUES
(1, 'Programmation'),
(2, 'Architecture Reseaux'),
(3, 'Design'),
(4, 'Telecommunication'),
(5, 'Management'),
(6, 'Mathematiques'),
(7, 'Communication'),
(8, 'Base des donnees'),
(9, 'Modelisation'),
(10, 'Machine Learning'),
(11, 'Domotique');

-- --------------------------------------------------------

--
-- Structure de la table `cotes_users`
--

CREATE TABLE `cotes_users` (
  `id` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `moyenne` float NOT NULL,
  `examen` float NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cotes_users`
--

INSERT INTO `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`) VALUES
(1, 9, 10, 5, 1),
(2, 8, 8, 10, 1),
(3, 1, 1, 3, 1),
(4, 2, 8, 5, 1),
(5, 4, 7, 9, 1),
(6, 7, 10, 10, 1),
(9, 5, 7, 5, 1),
(10, 6, 5, 3, 1),
(11, 9, 4, 3, 2),
(12, 8, 7, 5, 2),
(13, 1, 8, 10, 2),
(14, 2, 9, 8, 2),
(15, 3, 4, 0, 2),
(16, 4, 6, 5, 2),
(17, 7, 7, 3, 2),
(18, 5, 9, 4, 2),
(29, 6, 5, 9, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `intitule` varchar(45) DEFAULT NULL,
  `volhoraire` varchar(45) DEFAULT NULL,
  `promotions_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `intitule`, `volhoraire`, `promotions_id`, `categorie_id`) VALUES
(1, 'Genie logiciel', '60', 2, 1),
(2, 'Ethique', '15', 2, 7),
(3, 'MRS', '30', 2, 7),
(4, 'SystÃ¨mes embarquÃ©es', '30', 2, 11),
(5, 'JEE', '60', 2, 1),
(6, 'Ergonomie', '30', 2, 3),
(7, 'Droit civil', '15', 2, 7),
(8, 'Dev Web avancÃ©', '45', 2, 1),
(9, 'Programmation reseau', '30', 2, 2),
(10, 'Prolog', '30', 2, 10),
(11, 'Gestion des projets', '45', 2, 5),
(12, 'Entrepreuneriat', '60', 2, 5),
(13, 'Oracle', '45', 2, 8),
(14, 'Genie Logiciel', '45', 1, 1),
(15, 'Java', '60', 1, 1),
(16, 'UML', '60', 1, 9),
(17, 'Merise', '60', 1, 9),
(18, 'C#', '60', 1, 1),
(19, 'PHP', '60', 1, 1),
(20, 'RO', '30', 1, 6),
(21, 'XML', '45', 1, 1),
(22, 'SIG', '30', 1, 1),
(23, 'Android', '45', 1, 1),
(24, 'EOE', '30', 1, 7),
(25, 'TAD', '30', 1, 1),
(26, 'POO', '60', 1, 1),
(27, 'SQL Server', '45', 1, 8),
(28, 'MRS', '30', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `nom`) VALUES
(1, 'Genie Logiciel'),
(2, 'Design'),
(3, 'Telecom'),
(4, 'Reseaux'),
(5, 'Management'),
(6, 'Generale');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `domaines_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `promotions`
--

INSERT INTO `promotions` (`id`, `designation`, `domaines_id`) VALUES
(1, 'G2', 1),
(2, 'G3', 1),
(3, 'G2', 2),
(5, 'G2', 3),
(6, 'G3', 2),
(7, 'G3', 3),
(8, 'G2', 4),
(10, 'G3', 4),
(11, 'G2', 5),
(12, 'G3', 5),
(13, 'prepa', 6),
(14, 'G1', 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom_complet` varchar(255) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `domaine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_complet`, `login`, `password`, `email`, `categorie_id`, `domaine_id`) VALUES
(1, 'Paluku Kahumba fidele', 'fidele21', '1880852', 'fideleplk@gmail.com', 1, 1),
(2, 'Officia est qui quis', 'byquf@mailinator.com', 'Pa$$w0rd!', 'byquf@mailinator.com', 1, 2),
(3, 'Sint excepteur ut po', 'xamucuqipa@mailinator.net', 'Pa$$w0rd!', 'xamucuqipa@mailinator.net', 2, 3),
(8, 'Velit consequatur r', 'visi@mailinator.net', 'Pa$$w0rd!', 'visi@mailinator.net', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  `ponderation` int(11) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `utilisateur_id`, `cours_id`, `promotion_id`, `ponderation`, `selected`) VALUES
(113, 1, 5, 14, 3, 1),
(114, 1, 15, 14, 5, 1),
(115, 1, 19, 14, 5, 1),
(116, 1, 22, 14, 5, 1),
(117, 1, 13, 14, 5, 1),
(118, 1, 10, 14, 5, 1),
(119, 1, 4, 14, 1, 1),
(120, 1, 14, 1, 5, 1),
(121, 1, 18, 1, 5, 1),
(122, 1, 21, 1, 5, 1),
(123, 1, 23, 1, 5, 1),
(124, 1, 25, 1, 5, 1),
(125, 1, 26, 1, 5, 1),
(126, 1, 20, 1, 5, 1),
(127, 1, 24, 1, 5, 1),
(128, 1, 28, 1, 5, 1),
(129, 1, 27, 1, 5, 1),
(130, 1, 16, 1, 5, 1),
(131, 1, 17, 1, 5, 1),
(132, 1, 1, 2, 5, 1),
(133, 1, 8, 2, 1, 1),
(134, 1, 2, 2, 3, 1),
(135, 1, 3, 2, 5, 1),
(136, 1, 7, 2, 1, 1),
(137, 1, 6, 2, 4, 0),
(138, 1, 9, 2, 2, 0),
(139, 1, 11, 2, 5, 0),
(140, 1, 12, 2, 5, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_cours`
--
ALTER TABLE `categorie_cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cotes_users`
--
ALTER TABLE `cotes_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`id_cours`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`,`promotions_id`),
  ADD KEY `fk_cours_promotions1_idx` (`promotions_id`);

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`,`domaines_id`),
  ADD KEY `fk_promotions_domaines1_idx` (`domaines_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`,`categorie_id`,`domaine_id`),
  ADD KEY `fk_utilisateur_categorie_idx` (`categorie_id`),
  ADD KEY `fk_utilisateur_domaine1_idx` (`domaine_id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`,`utilisateur_id`,`cours_id`,`promotion_id`),
  ADD KEY `fk_votes_utilisateurs1_idx` (`utilisateur_id`),
  ADD KEY `fk_votes_cours1_idx` (`cours_id`),
  ADD KEY `fk_votes_promotions1_idx` (`promotion_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie_cours`
--
ALTER TABLE `categorie_cours`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `cotes_users`
--
ALTER TABLE `cotes_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cotes_users`
--
ALTER TABLE `cotes_users`
  ADD CONSTRAINT `cotes_users_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_cours_promotions1` FOREIGN KEY (`promotions_id`) REFERENCES `promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `fk_promotions_domaines1` FOREIGN KEY (`domaines_id`) REFERENCES `domaines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `fk_utilisateur_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateur_domaine1` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_votes_cours1` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_votes_promotions1` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_votes_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
