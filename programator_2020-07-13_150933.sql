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
  `details` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(80) NOT NULL,
  `valeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `has_voted` tinyint(1) NOT NULL,
  `formation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`categorie_id`,`domaine_id`),
  KEY `fk_utilisateur_categorie_idx` (`categorie_id`),
  KEY `fk_utilisateur_domaine1_idx` (`domaine_id`),
  CONSTRAINT `fk_utilisateur_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateur_domaine1` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

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
    `suggered`,
    `details`
  )
VALUES
  (
    1,
    'Genie logiciel 2',
    '60',
    13,
    1,
    0,
    'Apprendre a creer des programmes selon les regles de genie logiciel'
  );
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (2, 'Ethique', '15', 2, 7, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (3, 'MRS', '30', 2, 7, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (4, 'SystÃ¨mes embarquÃ©es', '30', 2, 11, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (5, 'JEE', '60', 2, 1, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (6, 'Ergonomie', '30', 2, 3, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (7, 'Droit civil', '15', 2, 7, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (8, 'Dev Web avancÃ©', '45', 2, 1, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (9, 'Programmation reseau', '30', 2, 2, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (10, 'Prolog', '30', 2, 10, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (11, 'Gestion des projets', '45', 2, 5, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (12, 'Entrepreuneriat', '60', 2, 5, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (13, 'Oracle', '45', 2, 8, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (
    14,
    'Genie Logiciel',
    '45',
    2,
    1,
    0,
    'mon super detail'
  );
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (
    15,
    'Java',
    '60',
    1,
    1,
    0,
    'Creer des applications desktop'
  );
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (16, 'UML', '60', 1, 9, 0, 'Modeliser un systÃ¨me');
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (17, 'Merise', '60', 1, 9, 0, 'modeliser un systÃ¨me');
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (
    18,
    'C#',
    '60',
    1,
    1,
    0,
    'CrÃ©er des applications pour desktop windows'
  );
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (
    19,
    'PHP',
    '60',
    1,
    1,
    0,
    'Concevoir des sites web dynamiques'
  );
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (20, 'RO', '30', 1, 6, 0, 'Recherche operationnelle');
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (
    21,
    'XML',
    '45',
    1,
    1,
    0,
    'Organiser son texte sous forme de balises'
  );
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (22, 'SIG', '30', 1, 1, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (23, 'Android', '45', 1, 1, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (24, 'EOE', '30', 1, 7, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (25, 'TAD', '30', 1, 1, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (26, 'POO', '60', 1, 1, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (27, 'SQL Server', '45', 1, 8, 0, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (29, 'Django', '30', 2, 1, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (58, 'CakePhp', '30', 2, 1, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (59, 'Algebre', '45', 13, 6, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (60, 'Optique', '30', 13, 4, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (61, 'Mysql', '30', 14, 8, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (63, 'JQuery', '', 13, 1, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (64, 'Langage C', '60', 14, 1, 1, NULL);
INSERT INTO
  `cours` (
    `id`,
    `intitule`,
    `volhoraire`,
    `promotions_id`,
    `categorie_id`,
    `suggered`,
    `details`
  )
VALUES
  (65, 'Introduction aux reseaux', '45', 14, 2, 1, NULL);

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
# DATA DUMP FOR TABLE: settings
# ------------------------------------------------------------

INSERT INTO
  `settings` (`id`, `designation`, `valeur`)
VALUES
  (1, 'moyenne', 50);
INSERT INTO
  `settings` (`id`, `designation`, `valeur`)
VALUES
  (2, 'pondered', 50);

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
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    1,
    'Paluku Kahumba fidele',
    'fideleplk@gmail.com',
    '1880852',
    'fideleplk@gmail.com',
    1,
    1,
    1,
    'Genie Logiciel'
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    2,
    'Officia est qui quis',
    'byquf@mailinator.com',
    'Pa$$w0rd!',
    'byquf@mailinator.com',
    1,
    2,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    3,
    'Sint excepteur ut po',
    'xamucuqipa@mailinator.net',
    'Pa$$w0rd!',
    'xamucuqipa@mailinator.net',
    1,
    1,
    0,
    'Dessin artistique mama miya'
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    208,
    'ASSUMANI THETHE Martine',
    '15at006@esisalama.org',
    '434155',
    '15at006@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    209,
    'BAGAYAMUKWE MAPENDO HÃ©lÃ¨ne',
    '15bm008@esisalama.org',
    '568719',
    '15bm008@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    210,
    'BANSENGA MUKOMBODI Niclette',
    '15bm009@esisalama.org',
    '653022',
    '15bm009@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    211,
    'BELOTI ISAMBO Divine',
    '15bi023@esisalama.org',
    '443983',
    '15bi023@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    212,
    'BEYA TSHITENGE Sephora',
    '15bt025@esisalama.org',
    '548778',
    '15bt025@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    213,
    'CHAMA MUMBA Nathalie',
    '14cm035@esisalama.org',
    '381968',
    '14cm035@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    214,
    'FATIMA FURAHA EspÃ©rance',
    '15ff054@esisalama.org',
    '760644',
    '15ff054@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    215,
    'IGEGA NACHIK Yvette',
    '14in048@esisalama.org',
    '995327',
    '14in048@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    216,
    'ILUNGA KABALE Rigaud',
    '15ik059@esisalama.org',
    '191880',
    '15ik059@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    217,
    'ITALA KE-YAV Carole',
    '14ik058@esisalama.org',
    '306009',
    '14ik058@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    218,
    'IZUMBI KOLOTA Nehemie',
    '13iz047@esisalama.org',
    '694865',
    '13iz047@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    219,
    'KABANGE NUMBI Jaelle',
    '15kn083@esisalama.org',
    '360380',
    '15kn083@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    220,
    'KAIND A DIUR Sarah',
    '15ka105@esisalama.org',
    '627073',
    '15ka105@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    221,
    'KASWING NYOTA La Joie',
    '14kn124@esisalama.org',
    '374960',
    '14kn124@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    222,
    'KATATO KAMWANYA Jenny',
    '15kk149@esisalama.org',
    '197708',
    '15kk149@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    223,
    'KAYEMBE TSHIBANGU Esther',
    '14kt133@esisalama.org',
    '547549',
    '14kt133@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    224,
    'KISIMBA LUBABA Nathanael',
    '14kl154@esisalama.org',
    '660476',
    '14kl154@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    225,
    'KONA KASANGA CocrÃ©',
    '14kk162@esisalama.org',
    '642553',
    '14kk162@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    226,
    'KYONGO NGOIE Marie-France',
    '15kn191@esisalama.org',
    '373939',
    '15kn191@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    227,
    'LONGWA MASENGO Samantha',
    '13lo159@esisalama.org',
    '713029',
    '13lo159@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    228,
    'MANYONGA LUBAMBU Merveille',
    '15ml214@esisalama.org',
    '231787',
    '15ml214@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    229,
    'MBUYU DYESE Jemima',
    '15md244@esisalama.org',
    '844151',
    '15md244@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    230,
    'MBWETI KAMANA Majoie',
    '15mk246@esisalama.org',
    '823703',
    '15mk246@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    231,
    'META TSHIMWANGA Naomie ',
    '14mt232@esisalama.org',
    '425696',
    '14mt232@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    232,
    'MUKEINA MULUMBATI Jemima',
    '15mm274@esisalama.org',
    '373540',
    '15mm274@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    233,
    'MULAJA BINENE Tony',
    '15mb280@esisalama.org',
    '451108',
    '15mb280@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    234,
    'MUSAMBAYI KABEYA Van',
    '15mk299@esisalama.org',
    '806680',
    '15mk299@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    235,
    'MUSEJ A KATSHUNG Jacquie',
    '14ma279@esisalama.org',
    '487863',
    '14ma279@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    236,
    'MUSONDA MWILA Carole',
    '15mm304@esisalama.org',
    '464283',
    '15mm304@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    237,
    'MUYAMBO TSHIBANGU Ruth',
    '15mt316@esisalama.org',
    '424587',
    '15mt316@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    238,
    'MWANDWE KISHA Jonathan',
    '15mk324@esisalama.org',
    '890698',
    '15mk324@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    239,
    'NADJAMBA FATUMA Fanny',
    '15nf338@esisalama.org',
    '004143',
    '15nf338@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    240,
    'NGALULA KANKOLONGO Aisha',
    '15nk346@esisalama.org',
    '173981',
    '15nk346@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    241,
    'NKULU ILUNGA Gaelly',
    '15ni367@esisalama.org',
    '376556',
    '15ni367@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    242,
    'NSAMBA MUKUNDI Masael',
    '14nm366@esisalama.org',
    '124560',
    '14nm366@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    243,
    'NSUNGU POLENGE Abigael',
    '15np376@esisalama.org',
    '217250',
    '15np376@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    244,
    'NYAMBI KALUNGA Aurelie',
    '15nk388@esisalama.org',
    '378626',
    '15nk388@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    245,
    'NZWAU MONGA Steven',
    '15nm396@esisalama.org',
    '337236',
    '15nm396@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    246,
    'OTHINIEL NDAYA Rozalie',
    '15on399@esisalama.org',
    '263231',
    '15on399@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    247,
    'PUNGWE MUZALA Marie',
    '15pm401@esisalama.org',
    '726414',
    '15pm401@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    248,
    'SALUMU KAKASI Nelly',
    '14sk388@esisalama.org',
    '203435',
    '14sk388@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    249,
    'SANGA KALAMBO Bulda',
    '14sk392@esisalama.org',
    '329849',
    '14sk392@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    250,
    'TAMBWE SHEDA Carine',
    '15ts418@esisalama.org',
    '337654',
    '15ts418@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    251,
    'TANGA NDUWA Alain',
    '15tn420@esisalama.org',
    '644965',
    '15tn420@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    252,
    'TSHIBWAYA BIATA Ruth',
    '15tb425@esisalama.org',
    '141056',
    '15tb425@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    253,
    'TSHIKA ILUNGA Delice',
    '13ts354@esisalama.org',
    '331144',
    '13ts354@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    254,
    'TSHISHINDU MUKUMBI Jonathan',
    '15tm433@esisalama.org',
    '396212',
    '15tm433@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    255,
    'TSHITENGA KADY Nathan',
    '15tk435@esisalama.org',
    '185298',
    '15tk435@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    256,
    'BADIBANGA MAKABU Emmanuel',
    '15bm007@esisalama.org',
    '920277',
    '15bm007@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    257,
    'BANZA MALOBA Carlos',
    '15bm012@esisalama.org',
    '882456',
    '15bm012@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    258,
    'BUSHIRI ABRANTES Kevin',
    '15ba037@esisalama.org',
    '466471',
    '15ba037@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    259,
    'CALEB KATUMBE Eden',
    '15ck040@esisalama.org',
    '437708',
    '15ck040@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    260,
    'CHONI ILUNGA Yannick',
    '15ci042@esisalama.org',
    '388052',
    '15ci042@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    261,
    'DONEL MAYALA Donel',
    '15dm049@esisalama.org',
    '975451',
    '15dm049@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    262,
    'ILUNGA BANZE Ghad',
    '15ib057@esisalama.org',
    '684222',
    '15ib057@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    263,
    'ILUNGA KABENGELE Scola',
    '15ik060@esisalama.org',
    '102636',
    '15ik060@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    264,
    'KADIONGO ILUNGA Epa',
    '15ki099@esisalama.org',
    '289722',
    '15ki099@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    265,
    'KAFWALUBI MWANSHA Gloire',
    '15km100@esisalama.org',
    '456683',
    '15km100@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    266,
    'KAKUMBI MUNANGHI Ruddy',
    '12ka057@esisalama.org',
    '524573',
    '12ka057@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    267,
    'KALEMA FEZA Chancelle',
    '15kf110@esisalama.org',
    '027545',
    '15kf110@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    268,
    'KALUNGA KIHUYA Orthense',
    '15kk124@esisalama.org',
    '314569',
    '15kk124@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    269,
    'KASELA KITAPA Grace',
    '15kk14es@esisalama.org',
    '375729',
    '15kk14es@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    270,
    'KASUMBWE NGANDU Eliel',
    '14kn123@esisalama.org',
    '679863',
    '14kn123@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    271,
    'LUMBWE KOMANGA Jordan',
    '15lk201@esisalama.org',
    '107306',
    '15lk201@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    272,
    'MAHANGA MUNONGO OrphÃ©e',
    '15mm207@esisalama.org',
    '929401',
    '15mm207@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    273,
    'MAJILA TSHIPICHIK Marius',
    '15mt209@esisalama.org',
    '047258',
    '15mt209@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    274,
    'MANDE NGOY FranÃ§ois',
    '15mn454@esisalama.org',
    '801892',
    '15mn454@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    275,
    'MBAYA MOLOLA HonorÃ©',
    '15mm232@esisalama.org',
    '092046',
    '15mm232@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    276,
    'MBUNGU TEKAZAYA Eliel',
    '15mt239@esisalama.org',
    '955664',
    '15mt239@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    277,
    'MBUYI MWEPU Simon',
    '15mm241@esisalama.org',
    '256017',
    '15mm241@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    278,
    'MUGISHO TEMBEZE Xavier',
    '15mt265@esisalama.org',
    '674790',
    '15mt265@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    279,
    'MUKADI JOSUE JosuÃ©',
    '15mj271@esisalama.org',
    '761092',
    '15mj271@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    280,
    'MULONGO NKULU Atthie',
    '15mn286@esisalama.org',
    '207602',
    '15mn286@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    281,
    'MUNGUAKONKWA KASINDE Melissa',
    '15mk294@esisalama.org',
    '069451',
    '15mk294@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    282,
    'MUTANDA MPOYI GaÃ«l',
    '15mm306@esisalama.org',
    '732002',
    '15mm306@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    283,
    'MUTONDO KILUNDU RenÃ©',
    '15mk312@esisalama.org',
    '561962',
    '15mk312@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    284,
    'MWAMBA MUKENDI Christian',
    '15mm322@esisalama.org',
    '271470',
    '15mm322@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    285,
    'MWAMBATSHI KALUBI Jimmy',
    '14mk313@esisalama.org',
    '735798',
    '14mk313@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    286,
    'NGALU MWADI Maureen',
    '15nm31es@esisalama.org',
    '553192',
    '15nm31es@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    287,
    'NGALULA KOLELA Abel',
    '15nk347@esisalama.org',
    '879026',
    '15nk347@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    288,
    'NGONGA KAPEMA Clerc',
    '15nk356@esisalama.org',
    '588051',
    '15nk356@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    289,
    'NGUNZ MWANA Freedom',
    '14nm360@esisalama.org',
    '319451',
    '14nm360@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    290,
    'NSIMIRE CIRIMWAMI Aline',
    '15nc375@esisalama.org',
    '031561',
    '15nc375@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    291,
    'NUMBI KAMINYE Gloire',
    '15nk386@esisalama.org',
    '715183',
    '15nk386@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    292,
    'NUMBI MUTOMBO Fatou',
    '14nm379@esisalama.org',
    '859605',
    '14nm379@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    293,
    'TAMBWE NYUMBAIZA Gad',
    '15tn417@esisalama.org',
    '354051',
    '15tn417@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    294,
    'TSHIBANGU NFWAMBA Christian',
    '14tn418@esisalama.org',
    '217484',
    '14tn418@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    295,
    'TSHIOKUFILA MAKASHIENY Shekinah',
    '15tm432@esisalama.org',
    '757409',
    '15tm432@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    296,
    'TSHITEMB KAWEL Junior',
    '14tk428@esisalama.org',
    '079422',
    '14tk428@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    297,
    'UMBA KISIMBA Mathieu',
    '15uk445@esisalama.org',
    '818502',
    '15uk445@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    298,
    'UMBA MUYOMBI Andrick',
    '14um434@esisalama.org',
    '365466',
    '14um434@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    299,
    'WABUBINDJA TUBONGYE Roland',
    '15wt447@esisalama.org',
    '699030',
    '15wt447@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    300,
    'YVES NDERUYE Malulu',
    '15yn453@esisalama.org',
    '655104',
    '15yn453@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    301,
    'ASANI KALUME Junior',
    '15ak005@esisalama.org',
    '179467',
    '15ak005@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    302,
    'BANZA MWAMBA Pathy',
    '16bm013@esisalama.org',
    '218101',
    '16bm013@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    303,
    'BILONDA MPATA Jean-Paul',
    '15bm029@esisalama.org',
    '888049',
    '15bm029@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    304,
    'FATUMA KAYUMBA Francisca',
    '14fk045@esisalama.org',
    '011307',
    '14fk045@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    305,
    'HENOCK LUSINGA Mathias',
    '16hl045@esisalama.org',
    '647228',
    '16hl045@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    306,
    'KABAMBA KASEBA Mike',
    '16kk068@esisalama.org',
    '261289',
    '16kk068@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    307,
    'KABULO MWANABUTE Dan',
    '16km081@esisalama.org',
    '872539',
    '16km081@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    308,
    'KABULO WA KUBUNDA Gloire',
    '15kw091@esisalama.org',
    '432472',
    '15kw091@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    309,
    'KALONJI TSHIMANGA Willy',
    '15kt120@esisalama.org',
    '354928',
    '15kt120@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    310,
    'KALONJI TSHIMANGA Samuel',
    '15kt119@esisalama.org',
    '146483',
    '15kt119@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    311,
    'KALUNGA MAUWA Miriam',
    '16km116@esisalama.org',
    '413762',
    '16km116@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    312,
    'KAPINGA KALOMBO Raissa',
    '16kk132@esisalama.org',
    '364770',
    '16kk132@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    313,
    'KAPUTO MUSALILA Elie',
    '16km135@esisalama.org',
    '112913',
    '16km135@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    314,
    'KASONGO KIBANDA Landrine',
    '16kk143@esisalama.org',
    '911081',
    '16kk143@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    315,
    'KASONGO KILIMA Aimerance',
    '16kk144@esisalama.org',
    '680871',
    '16kk144@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    316,
    'KASONGO NDAY Prisca',
    '16kn146@esisalama.org',
    '109729',
    '16kn146@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    317,
    'KASONGO WA ILUNGA Nadia',
    '15kw148@esisalama.org',
    '841795',
    '15kw148@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    318,
    'KATOBA BUKINGA Cynthia',
    '16kb152@esisalama.org',
    '151953',
    '16kb152@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    319,
    'KATOTO BWILE Dorcas',
    '15kb153@esisalama.org',
    '191001',
    '15kb153@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    320,
    'KAUJ YAV Rachel',
    '15ky157@esisalama.org',
    '296783',
    '15ky157@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    321,
    'KAZANG IRUNG Ruth',
    '16ki168@esisalama.org',
    '087947',
    '16ki168@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    322,
    'KAZEMBE KIDINDA JÃ©sus',
    '16kk169@esisalama.org',
    '716763',
    '16kk169@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    323,
    'KETA BAMBI Naomie',
    '16kb171@esisalama.org',
    '611536',
    '16kb171@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    324,
    'KIKONTWE DIKUKU VÃ©ronique',
    '15kd169@esisalama.org',
    '263318',
    '15kd169@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    325,
    'KITWA MAPANDA Jonathan',
    '17kmj163@esisalama.org',
    '942328',
    '17kmj163@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    326,
    'KUMWIMBA KIFIKWA Elda',
    '17kke166@esisalama.org',
    '278632',
    '17kke166@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    327,
    'KYABU NGOY KABAMBA Gautier',
    '13ky154@esisalama.org',
    '546438',
    '13ky154@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    328,
    'LUZOLO FUKIAWU Paul',
    '14lf188@esisalama.org',
    '473083',
    '14lf188@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    329,
    'MAHAMB KAYAKEZ EspÃ©ranÃ§a',
    '16mk215@esisalama.org',
    '833937',
    '16mk215@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    330,
    'MAMBA MUKONKOLE Lauraine',
    '16mm221@esisalama.org',
    '094626',
    '16mm221@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    331,
    'MBAYO KASONGO  Raphael',
    '15mk234@esisalama.org',
    '145015',
    '15mk234@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    332,
    'MBOMBO KALONJI Esther',
    '16mk244@esisalama.org',
    '285786',
    '16mk244@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    333,
    'MBUYU KIBUMBE Deborah',
    '16mk249@esisalama.org',
    '323256',
    '16mk249@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    334,
    'MBWEBWA LUKUSA Alex',
    '16ml250@esisalama.org',
    '713274',
    '16ml250@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    335,
    'MPUDI WA MPUDI TrÃ©sor',
    '15mw261@esisalama.org',
    '475342',
    '15mw261@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    336,
    'MUKEKWA DIMINA JoÃ«l',
    '16md275@esisalama.org',
    '604110',
    '16md275@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    337,
    'MUNUNGA KAWIKA DieudonnÃ©',
    '16mk292@esisalama.org',
    '509364',
    '16mk292@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    338,
    'MWANGALA NDUWA Fabrice',
    '16mn310@esisalama.org',
    '941407',
    '16mn310@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    339,
    'MWANSA CHANSA Jessica',
    '16mc311@esisalama.org',
    '576898',
    '16mc311@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    340,
    'MWANZA KAPINDO Merveille',
    '17mkm270@esisalama.org',
    '790165',
    '17mkm270@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    341,
    'MWENZE NGOZO Bonheur',
    '14mn325@esisalama.org',
    '007650',
    '14mn325@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    342,
    'MWIDYA NGOIE GrÃ¢ce',
    '15mn336@esisalama.org',
    '637143',
    '15mn336@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    343,
    'MWIKA KALEWO Gloria',
    '16mk324@esisalama.org',
    '052687',
    '16mk324@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    344,
    'NDAY WA BANZA Ginette',
    '16nw332@esisalama.org',
    '165837',
    '16nw332@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    345,
    'NGOIE NGANDU MOISE',
    '16nn349@esisalama.org',
    '755289',
    '16nn349@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    346,
    'NGOSA  MWAPE  Vanhel',
    '17nmv303@esisalama.org',
    '886475',
    '17nmv303@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    347,
    'NGUMBA MULONGOY AdÃ¨le',
    '16nm359@esisalama.org',
    '802919',
    '16nm359@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    348,
    'NKULU LUMBWE Deborah',
    '15nl369@esisalama.org',
    '546680',
    '15nl369@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    349,
    'NSEYA WA KABAMBA AUDREY',
    '14nw368@esisalama.org',
    '448999',
    '14nw368@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    350,
    'NZEBA NGOIE Ketsia',
    '16nn384@esisalama.org',
    '893206',
    '16nn384@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    351,
    'PHILY KIBWANA Phily',
    '16pk390@esisalama.org',
    '281671',
    '16pk390@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    352,
    'SOMBODI TSHIBWABWA Rachel',
    '17str349@esisalama.org',
    '715432',
    '17str349@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    353,
    'TAMITONDE RAMAZA Kevine',
    '15tr419@esisalama.org',
    '429382',
    '15tr419@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    354,
    'TSHIBANDA MULAJI Justelle',
    '16tm419@esisalama.org',
    '725890',
    '16tm419@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    355,
    'TSHIBWABWA PATRICE Patrice',
    '16tp425@esisalama.org',
    '355364',
    '16tp425@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    356,
    'WANDJA BAUDOUIN Michel',
    '16wb455@esisalama.org',
    '588879',
    '16wb455@esisalama.org',
    1,
    5,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    357,
    'ABEKYAMWALE ELUNDA Joel',
    '16ae001@esisalama.org',
    '004252',
    '16ae001@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    358,
    'AMPIRE BIGOMOKERO Eric',
    '16ab005@esisalama.org',
    '894791',
    '16ab005@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    359,
    'ASA NDEVU Asahel',
    '15an004@esisalama.org',
    '010744',
    '15an004@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    360,
    'BANZA MWIKO Patheo',
    '16bm014@esisalama.org',
    '400071',
    '16bm014@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    361,
    'BILEU KAPEPULA Shekina',
    '16bk019@esisalama.org',
    '371081',
    '16bk019@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    362,
    'BWANA WA BWANA Eliezer',
    '16bw031@esisalama.org',
    '040183',
    '16bw031@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    363,
    'DISASI KISULA Antoine',
    '16dk038@esisalama.org',
    '971160',
    '16dk038@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    364,
    'DITEND YAV Grevisse',
    '16dy039@esisalama.org',
    '358701',
    '16dy039@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    365,
    'HERI KAMONDO Venance',
    '15hk056@esisalama.org',
    '508830',
    '15hk056@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    366,
    'ILUNGA KAJA Jonathan',
    '15ik061@esisalama.org',
    '437817',
    '15ik061@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    367,
    'KABULO KONGOLO Synthiche',
    '16kk080@esisalama.org',
    '262878',
    '16kk080@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    368,
    'KABULU MBOLELA Jean-luc',
    '16km083@esisalama.org',
    '411364',
    '16km083@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    369,
    'KALOMBO KABEYA Dan',
    '16kk106@esisalama.org',
    '401817',
    '16kk106@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    370,
    'KALONGA MWAMBA Jonathan',
    '16km110@esisalama.org',
    '807722',
    '16km110@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    371,
    'KALONJI KATUMBANYI Josaphat',
    '16kk112@esisalama.org',
    '254699',
    '16kk112@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    372,
    'KALUBI NGHONGWE Albert',
    '15kn121@esisalama.org',
    '778322',
    '15kn121@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    373,
    'KAMBA  MULANDA  Jesse',
    '17kmj92@esisalama.org',
    '239059',
    '17kmj92@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    374,
    'KAMWANG KABAKU Allegra',
    '17kka466@esisalama.org',
    '276016',
    '17kka466@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    375,
    'KANKOLA TSHIBALA Elvis',
    '16kt125@esisalama.org',
    '381746',
    '16kt125@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    376,
    'KAPIAMBA KAYOMBO Celestin',
    '16kk131@esisalama.org',
    '360864',
    '16kk131@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    377,
    'KATOMB MUKAZ YOURI',
    '16km153@esisalama.org',
    '459690',
    '16km153@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    378,
    'KISIMBA MUTIKAMBA Ray',
    '16km184@esisalama.org',
    '367747',
    '16km184@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    379,
    'KITOKO  LONGO Yvon',
    '13ki142@esisalama.org',
    '282850',
    '13ki142@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    380,
    'KIYUMBI KAYUMBA Christian',
    '16kk189@esisalama.org',
    '087700',
    '16kk189@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    381,
    'KYUNGU LUPUNDU Dan',
    '16kl196@esisalama.org',
    '706893',
    '16kl196@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    382,
    'LAURA  NDJIJI  Kasy',
    '17lnk172@esisalama.org',
    '274963',
    '17lnk172@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    383,
    'LWAMBA SULUBIKA Gaetan',
    '16ls213@esisalama.org',
    '777408',
    '16ls213@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    384,
    'MADI ZUMANGA Patrick',
    '16mz214@esisalama.org',
    '687220',
    '16mz214@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    385,
    'MAJENDE WA NGOY Japhet',
    '15mw208@esisalama.org',
    '599159',
    '15mw208@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    386,
    'MANANG KAFUTSHI Elsa',
    '16mk222@esisalama.org',
    '031605',
    '16mk222@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    387,
    'MAYEZE YA BEYA Showee',
    '16my236@esisalama.org',
    '984099',
    '16my236@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    388,
    'MUJINGA TSHIBANGU Prisca',
    '16mt268@esisalama.org',
    '454263',
    '16mt268@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    389,
    'MUJINGA KAZADI Perside',
    '16mk267@esisalama.org',
    '157711',
    '16mk267@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    390,
    'MUKAZ YAV Alpha',
    '16my274@esisalama.org',
    '369148',
    '16my274@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    391,
    'MUKENGE MUDIBWA Randy',
    '16mm278@esisalama.org',
    '744771',
    '16mm278@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    392,
    'MUPASA KALUNGA Jean-Luc',
    '16mk293@esisalama.org',
    '856920',
    '16mk293@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    393,
    'MWAMBA ILUNGA Gloire',
    '16mi304@esisalama.org',
    '692944',
    '16mi304@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    394,
    'MWAMBA KONGOLO Pascal',
    '16mk305@esisalama.org',
    '256570',
    '16mk305@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    395,
    'MWANZA KABESA Ulysse',
    '16mk312@esisalama.org',
    '726242',
    '16mk312@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    396,
    'MWIKA MUKANYA Gisele',
    '16mm325@esisalama.org',
    '918120',
    '16mm325@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    397,
    'PALUKU KAHUMBA FidÃ¨le',
    '16pk389@esisalama.org',
    '716193',
    '16pk389@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    398,
    'SAFARI BAHATI Benjamin',
    '16sb394@esisalama.org',
    '752069',
    '16sb394@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    399,
    'TUMAINI MUNGUMWA Corneille',
    '16tm445@esisalama.org',
    '063640',
    '16tm445@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    400,
    'YENGA NTETI JosuÃ©',
    '15yn450@esisalama.org',
    '516188',
    '15yn450@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    401,
    'YOMBO BOSEMWA Jonathan',
    '15yb451@esisalama.org',
    '519902',
    '15yb451@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    402,
    'ZAINA KAZADI Josianne',
    '16zk461@esisalama.org',
    '514444',
    '16zk461@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    403,
    'ZONGWE BENONI Benjamin',
    '16zb463@esisalama.org',
    '794491',
    '16zb463@esisalama.org',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    404,
    'Bruno',
    'fideleplk@gmail.com',
    '188085296',
    'fideleplk@gmail.com',
    1,
    1,
    0,
    'Installation des antennes vsat'
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    405,
    'Bruno',
    'fideleplk@gmail.com',
    '188085296',
    'fideleplk@gmail.com',
    1,
    1,
    0,
    NULL
  );
INSERT INTO
  `utilisateurs` (
    `id`,
    `nom_complet`,
    `login`,
    `password`,
    `email`,
    `categorie_id`,
    `domaine_id`,
    `has_voted`,
    `formation`
  )
VALUES
  (
    406,
    'Bruno',
    'fideleplk@gmail.com',
    '188085296',
    'fideleplk@gmail.com',
    1,
    3,
    0,
    'Installation des antennes vsat'
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
  (40, 1, 29, 13, 5, 1);
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
  (41, 1, 58, 13, 5, 1);
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
  (42, 1, 63, 13, 5, 1);
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
  (43, 1, 59, 13, 5, 1);
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
  (44, 1, 7, 13, 1, 1);
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
  (45, 1, 24, 13, 5, 1);
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
  (46, 1, 61, 13, 5, 1);
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
  (47, 1, 64, 14, 5, 1);
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
  (48, 1, 65, 14, 5, 1);
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
  (49, 1, 60, 14, 5, 1);
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
  (50, 1, 20, 14, 5, 1);
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
  (51, 1, 3, 14, 5, 1);
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
  (52, 1, 14, 1, 5, 1);
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
  (53, 1, 15, 1, 5, 1);
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
  (54, 1, 18, 1, 5, 1);
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
  (55, 1, 19, 1, 5, 1);
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
  (56, 1, 21, 1, 5, 1);
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
  (57, 1, 22, 1, 5, 1);
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
  (58, 1, 23, 1, 5, 1);
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
  (59, 1, 25, 1, 5, 1);
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
  (60, 1, 26, 1, 5, 1);
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
  (61, 1, 27, 1, 5, 1);
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
  (62, 1, 16, 1, 5, 1);
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
  (63, 1, 17, 1, 5, 1);
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
  (64, 1, 1, 2, 5, 1);
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
  (65, 1, 5, 2, 3, 1);
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
  (66, 1, 8, 2, 1, 1);
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
  (67, 1, 9, 2, 2, 1);
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
  (68, 1, 6, 2, 4, 1);
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
  (69, 1, 11, 2, 5, 1);
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
  (70, 1, 12, 2, 5, 1);
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
  (71, 1, 2, 2, 3, 1);
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
  (72, 1, 13, 2, 5, 1);
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
  (73, 1, 10, 2, 5, 1);
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
  (74, 1, 4, 2, 1, 1);
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
  (75, 406, 21, 13, 5, 1);
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
  (76, 406, 22, 13, 5, 1);
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
  (77, 406, 25, 13, 5, 1);
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
  (78, 406, 63, 13, 5, 1);
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
  (79, 406, 64, 13, 5, 1);
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
  (80, 406, 60, 13, 5, 1);
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
  (81, 406, 12, 13, 5, 1);
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
  (82, 406, 59, 13, 5, 1);
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
  (83, 406, 3, 13, 5, 1);
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
  (84, 406, 7, 13, 5, 1);
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
  (85, 406, 24, 13, 5, 1);
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
  (86, 406, 19, 14, 5, 1);
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
  (87, 406, 29, 14, 5, 1);
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
  (88, 406, 58, 14, 5, 1);
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
  (89, 406, 65, 14, 5, 1);
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
  (90, 406, 6, 14, 5, 1);
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
  (91, 406, 11, 14, 5, 1);
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
  (92, 406, 20, 14, 5, 1);
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
  (93, 406, 61, 14, 5, 1);
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
  (94, 406, 14, 5, 5, 1);
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
  (95, 406, 15, 5, 5, 1);
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
  (96, 406, 18, 5, 5, 1);
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
  (97, 406, 23, 5, 5, 1);
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
  (98, 406, 26, 5, 5, 1);
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
  (99, 406, 27, 5, 5, 1);
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
  (100, 406, 16, 5, 5, 1);
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
  (101, 406, 17, 5, 5, 1);
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
  (102, 406, 1, 7, 5, 1);
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
  (103, 406, 5, 7, 5, 1);
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
  (104, 406, 8, 7, 5, 1);
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
  (105, 406, 9, 7, 5, 1);
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
  (106, 406, 2, 7, 5, 1);
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
  (107, 406, 13, 7, 5, 1);
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
  (108, 406, 10, 7, 5, 1);
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
  (109, 406, 4, 7, 5, 1);
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
  (110, 3, 25, 13, 5, 1);
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
  (111, 3, 29, 13, 5, 1);
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
  (112, 3, 58, 13, 5, 1);
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
  (113, 3, 63, 13, 5, 1);
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
  (114, 3, 60, 13, 5, 1);
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
  (115, 3, 59, 13, 5, 1);
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
  (116, 3, 7, 13, 5, 1);
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
  (117, 3, 24, 13, 5, 1);
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
  (118, 3, 22, 14, 5, 1);
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
  (119, 3, 64, 14, 5, 1);
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
  (120, 3, 65, 14, 5, 1);
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
  (121, 3, 6, 14, 5, 1);
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
  (122, 3, 12, 14, 5, 1);
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
  (123, 3, 20, 14, 5, 1);
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
  (124, 3, 3, 14, 5, 1);
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
  (125, 3, 61, 14, 5, 1);
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
  (126, 3, 10, 14, 5, 1);
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
  (127, 3, 14, 1, 5, 1);
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
  (128, 3, 15, 1, 5, 1);
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
  (129, 3, 18, 1, 5, 1);
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
  (130, 3, 19, 1, 5, 1);
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
  (131, 3, 21, 1, 5, 1);
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
  (132, 3, 23, 1, 5, 1);
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
  (133, 3, 26, 1, 5, 1);
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
  (134, 3, 11, 1, 5, 1);
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
  (135, 3, 27, 1, 5, 1);
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
  (136, 3, 16, 1, 5, 1);
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
  (137, 3, 17, 1, 5, 1);
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
  (138, 3, 1, 2, 5, 1);
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
  (139, 3, 5, 2, 5, 1);
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
  (140, 3, 8, 2, 5, 1);
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
  (141, 3, 9, 2, 5, 1);
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
  (142, 3, 2, 2, 5, 1);
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
  (143, 3, 13, 2, 5, 1);
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
  (144, 3, 4, 2, 5, 1);

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
