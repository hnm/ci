ALTER TABLE `ci_youtube`
	ADD COLUMN `nested_ci_type` VARCHAR(255) NULL DEFAULT NULL AFTER `youtube_id`;
