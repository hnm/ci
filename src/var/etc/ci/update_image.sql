ALTER TABLE `ci_image`
	CHANGE COLUMN `alt_description` `alt_tag` VARCHAR(255) NULL DEFAULT NULL AFTER `caption`;
	
	ALTER TABLE `ci_image`
	ADD COLUMN `format` VARCHAR(255) NULL DEFAULT NULL AFTER `alt_tag`;
	
ALTER TABLE `ci_image`
	DROP COLUMN `caption`;

	
	ALTER TABLE `ci_image`
	CHANGE COLUMN `title` `caption` VARCHAR(255) NULL DEFAULT NULL AFTER `id`;
	
	
	
	ALTER TABLE `ci_image`
	ADD COLUMN `expl_page_link_id` INT NULL AFTER `nested_ci_type`;
	
	
	
	ALTER TABLE `ci_image`
	DROP COLUMN `page_id`,
	DROP COLUMN `link`,
	DROP COLUMN `show_link`,
	ADD INDEX `expl_page_link_id` (`expl_page_link_id`);
	
	
	ALTER TABLE `ci_image`
	ALTER `nested_ci_type` DROP DEFAULT;
ALTER TABLE `ci_image`
	CHANGE COLUMN `nested_ci_type` `nested_ci_type` VARCHAR(255) NULL AFTER `open_lytebox`;
	