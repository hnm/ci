-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.10-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Struktur von Tabelle mdl_template.ci_anchor
CREATE TABLE IF NOT EXISTS `ci_anchor` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `path_part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Struktur von Tabelle mdl_template.ci_article
CREATE TABLE IF NOT EXISTS `ci_article` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `description_html` text DEFAULT NULL,
  `file_image` varchar(255) NOT NULL,
  `pic_pos` enum('left','right') NOT NULL DEFAULT 'left',
  `open_lytebox` tinyint(4) DEFAULT NULL,
  `expl_page_link_id` int(11) DEFAULT NULL,
  `alt_tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expl_page_link_id` (`expl_page_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_attachment
CREATE TABLE IF NOT EXISTS `ci_attachment` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_cke
CREATE TABLE IF NOT EXISTS `ci_cke` (
  `id` int(10) unsigned NOT NULL,
  `content_html` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_html_snippet
CREATE TABLE IF NOT EXISTS `ci_html_snippet` (
  `id` int(10) unsigned NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_image
CREATE TABLE IF NOT EXISTS `ci_image` (
  `id` int(11) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `expl_page_link_id` int(11) DEFAULT NULL,
  `file_image` varchar(255) DEFAULT NULL,
  `alt_tag` varchar(255) DEFAULT NULL,
  `format` varchar(255) DEFAULT NULL,
  `alignment` varchar(255) DEFAULT NULL,
  `open_lytebox` varchar(255) DEFAULT NULL,
  `nested_ci_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expl_page_link_id` (`expl_page_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_three_columns
CREATE TABLE IF NOT EXISTS `ci_three_columns` (
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_three_columns_content_items
CREATE TABLE IF NOT EXISTS `ci_three_columns_content_items` (
  `ci_three_columns_id` int(10) unsigned NOT NULL,
  `content_item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ci_three_columns_id`,`content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_two_columns
CREATE TABLE IF NOT EXISTS `ci_two_columns` (
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_two_columns_content_items
CREATE TABLE IF NOT EXISTS `ci_two_columns_content_items` (
  `ci_two_columns_id` int(10) unsigned NOT NULL,
  `content_item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ci_two_columns_id`,`content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ci_youtube` (
  `id` int(10) unsigned NOT NULL,
  `youtube_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `nested_ci_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `ci_google_maps` (
	`id` INT(11) NOT NULL,
	`lat` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`lng` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`title` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`description` TEXT NULL COLLATE 'utf8_unicode_ci',
	`zoom` INT(11) NULL DEFAULT NULL,
	`show_info_window` TINYINT(3) NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;

CREATE TABLE `ci_accordion` (
	`id` INT(11) NOT NULL,
	`title` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


CREATE TABLE `ci_accordion_content_items` (
	`ci_accordion_id` INT(10) UNSIGNED NOT NULL,
	`content_item_id` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`ci_accordion_id`, `content_item_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

