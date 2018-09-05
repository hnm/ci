ALTER TABLE `ci_google_maps`
	ADD COLUMN `zoom` INT(11) NULL DEFAULT NULL AFTER `description`;
	
ALTER TABLE `ci_google_maps`
	ADD COLUMN `show_info_window` TINYINT(3) NOT NULL AFTER `zoom`;
	
