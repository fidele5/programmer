/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: categorie_cours
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorie_cours`;
CREATE TABLE `categorie_cours` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: cotes_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cotes_users`;
CREATE TABLE `cotes_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cours` int(11) NOT NULL,
  `moyenne` float NOT NULL,
  `examen` float NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk` (`id_cours`),
  KEY `id_etudiant` (`id_etudiant`),
  CONSTRAINT `cotes_users_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `fk` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: cours
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cours`;
CREATE TABLE `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(45) DEFAULT NULL,
  `volhoraire` varchar(45) DEFAULT NULL,
  `promotions_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `suggered` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`promotions_id`),
  KEY `fk_cours_promotions1_idx` (`promotions_id`),
  CONSTRAINT `fk_cours_promotions1` FOREIGN KEY (`promotions_id`) REFERENCES `promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: domaines
# ------------------------------------------------------------

DROP TABLE IF EXISTS `domaines`;
CREATE TABLE `domaines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: promotions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) DEFAULT NULL,
  `domaines_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`domaines_id`),
  KEY `fk_promotions_domaines1_idx` (`domaines_id`),
  CONSTRAINT `fk_promotions_domaines1` FOREIGN KEY (`domaines_id`) REFERENCES `domaines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: utilisateurs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_complet` varchar(255) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `domaine_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`categorie_id`,`domaine_id`),
  KEY `fk_utilisateur_categorie_idx` (`categorie_id`),
  KEY `fk_utilisateur_domaine1_idx` (`domaine_id`),
  CONSTRAINT `fk_utilisateur_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateur_domaine1` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: votes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  `ponderation` int(11) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`utilisateur_id`,`cours_id`,`promotion_id`),
  KEY `fk_votes_utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_votes_cours1_idx` (`cours_id`),
  KEY `fk_votes_promotions1_idx` (`promotion_id`),
  CONSTRAINT `fk_votes_cours1` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_votes_promotions1` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_votes_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: admins
# ------------------------------------------------------------

INSERT INTO
  `admins` (`id`, `login`, `mdp`)
VALUES
  (3, 'admin', '12345');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: categorie_cours
# ------------------------------------------------------------

INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (1, 'Programmation');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (2, 'Architecture Reseaux');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (3, 'Design');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (4, 'Telecommunication');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (5, 'Management');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (6, 'Mathematiques');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (7, 'Communication');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (8, 'Base des donnees');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (9, 'Modelisation');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (10, 'Machine Learning');
INSERT INTO
  `categorie_cours` (`id`, `nom`)
VALUES
  (11, 'Domotique');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: categories
# ------------------------------------------------------------

INSERT INTO
  `categories` (`id`, `nom`)
VALUES
  (1, 'Etudiant');
INSERT INTO
  `categories` (`id`, `nom`)
VALUES
  (2, 'Professeur');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: cotes_users
# ------------------------------------------------------------

INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (1, 9, 10, 5, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (2, 8, 8, 10, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (3, 1, 1, 3, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (4, 2, 8, 5, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (5, 4, 7, 9, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (6, 7, 10, 10, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (9, 5, 7, 5, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (10, 6, 5, 3, 1);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (11, 9, 4, 3, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (12, 8, 7, 5, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (13, 1, 8, 10, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (14, 2, 9, 8, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (15, 3, 4, 0, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (16, 4, 6, 5, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (17, 7, 7, 3, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (18, 5, 9, 4, 2);
INSERT INTO
  `cotes_users` (`id`, `id_cours`, `moyenne`, `examen`, `id_etudiant`)
VALUES
  (29, 6, 5, 9, 2);

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: cours
# ------------------------------------------------------------

INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (1, 'Genie logiciel', '60', 2, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (2, 'Ethique', '15', 2, 7, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (3, 'MRS', '30', 2, 7, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (4, 'SystÃ¨mes embarquÃ©es', '30', 2, 11, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (5, 'JEE', '60', 2, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (6, 'Ergonomie', '30', 2, 3, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (7, 'Droit civil', '15', 2, 7, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (8, 'Dev Web avancÃ©', '45', 2, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (9, 'Programmation reseau', '30', 2, 2, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (10, 'Prolog', '30', 2, 10, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (11, 'Gestion des projets', '45', 2, 5, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (12, 'Entrepreuneriat', '60', 2, 5, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (13, 'Oracle', '45', 2, 8, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (14, 'Genie Logiciel', '45', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (15, 'Java', '60', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (16, 'UML', '60', 1, 9, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (17, 'Merise', '60', 1, 9, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (18, 'C#', '60', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (19, 'PHP', '60', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (20, 'RO', '30', 1, 6, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (21, 'XML', '45', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (22, 'SIG', '30', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (23, 'Android', '45', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (24, 'EOE', '30', 1, 7, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (25, 'TAD', '30', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (26, 'POO', '60', 1, 1, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (27, 'SQL Server', '45', 1, 8, 0);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (29, 'Django', '30', 2, 1, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (58, 'CakePhp', '30', 2, 1, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (59, 'Algebre', '45', 13, 6, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (60, 'Optique', '30', 13, 4, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (61, 'Mysql', '30', 14, 8, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (63, 'JQuery', '', 13, 1, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (64, 'Langage C', '60', 14, 1, 1);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`
  )
VALUES
  (65, 'Introduction aux reseaux', '45', 14, 2, 1);

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: domaines
# ------------------------------------------------------------

INSERT INTO
  `domaines` (`id`, `nom`)
VALUES
  (1, 'Genie Logiciel');
INSERT INTO
  `domaines` (`id`, `nom`)
VALUES
  (2, 'Design');
INSERT INTO
  `domaines` (`id`, `nom`)
VALUES
  (3, 'Telecom');
INSERT INTO
  `domaines` (`id`, `nom`)
VALUES
  (4, 'Reseaux');
INSERT INTO
  `domaines` (`id`, `nom`)
VALUES
  (5, 'Management');
INSERT INTO
  `domaines` (`id`, `nom`)
VALUES
  (6, 'Generale');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: promotions
# ------------------------------------------------------------

INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (1, 'G2', 1);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (2, 'G3', 1);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (3, 'G2', 2);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (5, 'G2', 3);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (6, 'G3', 2);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (7, 'G3', 3);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (8, 'G2', 4);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (10, 'G3', 4);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (11, 'G2', 5);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (12, 'G3', 5);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (13, 'prepa', 6);
INSERT INTO
  `promotions` (`id`, `designation`, `domaines_id`)
VALUES
  (14, 'G1', 6);

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: utilisateurs
# ------------------------------------------------------------

INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`
  )
VALUES
  (
    1,
    'Paluku Kahumba fidele',
    'fidele21',
    '1880852',
    'fideleplk@gmail.com',
    1,
    1
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`
  )
VALUES
  (
    2,
    'Officia est qui quis',
    'byquf@mailinator.com',
    'Pa$$w0rd!',
    'byquf@mailinator.com',
    1,
    2
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`
  )
VALUES
  (
    3,
    'Sint excepteur ut po',
    'xamucuqipa@mailinator.net',
    'Pa$$w0rd!',
    'xamucuqipa@mailinator.net',
    2,
    3
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`
  )
VALUES
  (
    8,
    'Velit consequatur r',
    'visi@mailinator.net',
    'Pa$$w0rd!',
    'visi@mailinator.net',
    1,
    5
  );

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: votes
# ------------------------------------------------------------

INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (4, 3, 21, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (5, 1, 29, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (6, 1, 58, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (7, 1, 63, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (8, 1, 59, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (9, 1, 7, 13, 1, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (10, 1, 24, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (11, 1, 61, 13, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (12, 1, 64, 14, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (13, 1, 65, 14, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (14, 1, 60, 14, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (15, 1, 20, 14, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (16, 1, 3, 14, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (17, 1, 14, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (18, 1, 15, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (19, 1, 18, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (20, 1, 19, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (21, 1, 21, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (22, 1, 22, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (23, 1, 23, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (24, 1, 25, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (25, 1, 26, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (26, 1, 27, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (27, 1, 16, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (28, 1, 17, 1, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (29, 1, 1, 2, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (30, 1, 5, 2, 3, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (31, 1, 8, 2, 1, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (32, 1, 9, 2, 2, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (33, 1, 6, 2, 4, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (34, 1, 11, 2, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (35, 1, 12, 2, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (36, 1, 2, 2, 3, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (37, 1, 13, 2, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (38, 1, 10, 2, 5, 1);
INSERT INTO
  `votes` (
    `id`,
    `utilisateur_id`,
    `cours_id`,
    `promotion_id`,
    `ponderation`,
    `selected`
  )
VALUES
  (39, 1, 4, 2, 1, 1);

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
