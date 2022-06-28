-- Mysql Backup of mdl_ci
-- Date 2022-04-25T15:13:33+00:00
-- Backup by 

DROP TABLE IF EXISTS `accordion_content_items`;
CREATE TABLE `accordion_content_items` ( 
	`accordion_id` INT NOT NULL, 
	`content_item_id` INT NOT NULL, 
	PRIMARY KEY (`accordion_id`, `content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;


DROP TABLE IF EXISTS `accordion`;
CREATE TABLE `accordion` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`title` VARCHAR(255) NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;

-- Mysql Backup of mdl_ci
-- Date 2022-04-25T15:13:58+00:00
-- Backup by 

DROP TABLE IF EXISTS `ci_accordion`;
CREATE TABLE `ci_accordion` ( 
	`id` INT NOT NULL, 
	`title` VARCHAR(255) NULL DEFAULT NULL, 
	`accordions_id` INT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;
ALTER TABLE `ci_accordion` ADD INDEX `ci_accordion_index_1` (`accordions_id`);