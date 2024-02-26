-- base de données : `db_quaiantique`

-- Structure de la table `admin`

CREATE TABLE `admin` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL, 
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(60) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Structure de la table `user`

CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `genre` VARCHAR(10) NOT NULL,
  `prenom` VARCHAR(30) NOT NULL,
  `nom` VARCHAR(30) NOT NULL,
  `email` VARCHAR(180) NOT NULL UNIQUE,
  `password` VARCHAR(60) NULL,
  `def_nbpers` INT(11) NULL,
  `allergies` VARCHAR(255) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Structure de la table `reservations`

CREATE TABLE `reservations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(30) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `nbpers` INT(11) NOT NULL,
  `jour` DATE NOT NULL,
  `heure_dej` VARCHAR(5) DEFAULT NULL,
  `heure_diner` VARCHAR(5) DEFAULT NULL,
  `allergies` VARCHAR(255) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `user_reservations` (
   `id_user` INT,
   `id_resa` INT,
   PRIMARY KEY (`id_user`, `id_resa`),
   FOREIGN KEY (`id_user`) REFERENCES `user`(id),
   FOREIGN KEY (`id_resa`) REFERENCES `reservations`(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Structures des rôles

CREATE TABLE `roles` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL UNIQUE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE admin_role (
    `admin_id` INT,
    `role_id` INT,
    PRIMARY KEY (`admin_id`, `role_id`),
    FOREIGN KEY (`admin_id`) REFERENCES `admin`(id),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE user_role (
    `user_id` INT,
    `role_id` INT,
    PRIMARY KEY (`user_id`, `role_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(id),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Tables pour adminFunc

-- Table nombre de couverts

CREATE TABLE `couverts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jour` DATE NOT NULL,
  `dej_din` VARCHAR(10) NOT NULL,
  `couverts_restant` INT NOT NULL,
  `couverts_total` INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table horaires

CREATE TABLE `horaires` (
  `dej_ouverture` INT NOT NULL,
  `dej_fermeture` INT NOT NULL,
  `din_ouverture` INT NOT NULL,
  `din_fermeture` INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Photos

CREATE TABLE `photos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `plat` VARCHAR(75) NOT NULL,
  `chemin` VARCHAR(250) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- INSERT et autres instructions

INSERT INTO `roles` (`nom`) VALUES ('user_role');
INSERT INTO `roles` (`nom`) VALUES ('admin_role');
INSERT INTO `admin` (`username`, `email`, `password`) VALUES ('Admin', 'admin@mail.com', MD5('administeur'));
INSERT INTO `admin_role` (`admin_id`, `role_id`) VALUES (LAST_INSERT_ID(), 2);

INSERT INTO `couverts` (`couverts_total`) VALUES ('20');

INSERT INTO `photos` (`plat`, `chemin`) VALUES ('Tartiflette au Reblochon', '/public/Images/tartiflette_carré.jpg');
INSERT INTO `photos` (`plat`, `chemin`) VALUES ('Soupe parmentier', '/public/Images/soupe_parmentier_carré.jpg');
INSERT INTO `photos` (`plat`, `chemin`) VALUES ('Risotto crémeux aux légumes du marché', '/public/Images/risotto_carré.jpg'); 
INSERT INTO `photos` (`plat`, `chemin`) VALUES ('Fondu savoyarde', '/public/Images/fondue_6.jpg');
INSERT INTO `photos` (`plat`, `chemin`) VALUES ('Raclette traditionnelle', '/public/Images/raclette_carré.jpg');
INSERT INTO `photos` (`plat`, `chemin`) VALUES ('Croustillant au Reblochon du Val d’Arly', '/public/Images/croustillant_au_reblochon.jpg');