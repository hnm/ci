ALTER TABLE `ci_youtube`
	ADD COLUMN `nested_ci_type` VARCHAR(255) NULL DEFAULT NULL AFTER `youtube_id`;
	
ALTER TABLE `ci_youtube`
	CHANGE COLUMN `youtube_id` `youtube_id` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci' AFTER `id`;
	