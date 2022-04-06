-- Exportiere Struktur von Tabelle mdl_template.ci_anchor
CREATE TABLE IF NOT EXISTS `ci_anchor` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `path_part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Struktur von Tabelle mdl_template.ci_article
CREATE TABLE IF NOT EXISTS `ci_article` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description_html` text DEFAULT NULL,
  `file_image` varchar(255) NOT NULL,
  `pic_pos` enum('left','right') NOT NULL DEFAULT 'left',
  `open_lytebox` tinyint(4) DEFAULT NULL,
  `expl_page_link_id` int(11) DEFAULT NULL,
  `alt_tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expl_page_link_id` (`expl_page_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
  PRIMARY KEY (`id`),
  KEY `expl_page_link_id` (`expl_page_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_ci.ci_three_columns
CREATE TABLE IF NOT EXISTS `ci_three_columns` (
  `id` int(11) NOT NULL,
  `alignment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_template.ci_three_columns_content_items
CREATE TABLE IF NOT EXISTS `ci_three_columns_content_items` (
  `ci_three_columns_id` int(10) unsigned NOT NULL,
  `nested_content_item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ci_three_columns_id`,`nested_content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle mdl_ci.ci_two_columns
CREATE TABLE IF NOT EXISTS `ci_two_columns` (
  `id` int(11) NOT NULL,
  `alignment` varchar(255) DEFAULT NULL,
  `splitting` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `ci_nested_content_item` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `ci_simple_map` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `ci_two_columns_content_items` (
  `ci_two_columns_id` int(10) unsigned NOT NULL,
  `nested_content_item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ci_two_columns_id`,`nested_content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `ci_youtube` (
  `id` int(10) unsigned NOT NULL,
  `youtube_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nested_ci_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS  `ci_google_maps` (
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

CREATE TABLE IF NOT EXISTS  `ci_accordion` (
	`id` INT(11) NOT NULL,
	`title` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;


CREATE TABLE IF NOT EXISTS `ci_accordion_content_items` (
	`ci_accordion_id` INT(10) UNSIGNED NOT NULL,
	`content_item_id` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`ci_accordion_id`, `content_item_id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;

CREATE TABLE IF NOT EXISTS `ci_cta` ( 
	`id` INT NOT NULL, 
	`title` VARCHAR(255) NULL DEFAULT NULL, 
	`intro` VARCHAR(255) NULL DEFAULT NULL, 
	`phone` VARCHAR(255) NULL DEFAULT NULL, 
	`email` VARCHAR(255) NULL DEFAULT NULL, 
	`link_id` INT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;