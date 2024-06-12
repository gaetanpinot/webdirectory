SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `personne`;
CREATE TABLE `personne`(
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`nom` varchar(128) NOT NULL,
	`prenom` varchar(128) NOT NULL,
	`num_bureau` varchar(10),
	`mail` varchar(128),
	`url_img` varchar(1024)
);

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE `fonction`(
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`libelle` varchar(128) NOT NULL
);

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service`(
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`libelle` varchar(128) NOT NULL,
	`etage` int,
	`description` text
);

DROP TABLE IF EXISTS `personne_service`;
CREATE TABLE `personne_service`(
	`id_personne` int ,
	`id_service` int ,
	PRIMARY KEY (`id_personne`, `id_service`),
	FOREIGN KEY (`id_personne`) REFERENCES `personne`(`id`),
	FOREIGN KEY (`id_service`) REFERENCES `service`(`id`)
);

DROP TABLE IF EXISTS `telephone_personne`;
CREATE TABLE `telephone_personne`(
	`id_personne` int PRIMARY KEY,
	`num` varchar(128) ,
	FOREIGN KEY (`id_personne`) REFERENCES `personne`(`id`)
);

DROP TABLE IF EXISTS `fonction_personne`;
CREATE TABLE `fonction_personne`(
	`id_personne` int ,
	`id_fonction` int ,
	PRIMARY KEY (`id_personne`, `id_fonction`),
	FOREIGN KEY (`id_personne`) REFERENCES `personne`(`id`),
	FOREIGN KEY (`id_fonction`) REFERENCES `fonction`(`id`)
);

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`(
	`id` varchar(128) PRIMARY KEY,
	`username` varchar(128) UNIQUE,
	`password` longtext,
	`is_super_admin` boolean
);

