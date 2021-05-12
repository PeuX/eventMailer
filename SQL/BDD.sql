-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           10.5.9-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour eventmailer
CREATE DATABASE IF NOT EXISTS `eventmailer` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `eventmailer`;

-- Listage de la structure de la table eventmailer. date_pending
CREATE TABLE IF NOT EXISTS `date_pending` (
  `id` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL,
  `jour` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_event_jour` (`event_id`,`jour`) USING BTREE,
  CONSTRAINT `FK__event_datepending` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table eventmailer. event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL,
  `id_unique` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL DEFAULT '',
  `commentaire` text DEFAULT '',
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `destinataire` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table eventmailer. mail_du_jour
CREATE TABLE IF NOT EXISTS `mail_du_jour` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `jour` date NOT NULL,
  `texte` text DEFAULT '',
  `photo` varchar(5000) DEFAULT NULL COMMENT 'path de la photo rennomé en uniqueID',
  `fait` bit(1) NOT NULL DEFAULT b'0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__event_maildujour` (`event_id`) USING BTREE,
  CONSTRAINT `FK__event_maildujour` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
