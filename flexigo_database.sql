-- FlexiGo database recovery script
-- Reconstructed from the SQL statements in signin.php, login.php,
-- profile.php, editprofile.php, and movies.php.

CREATE DATABASE IF NOT EXISTS `flexigo`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `flexigo`;

CREATE TABLE IF NOT EXISTS `signin_det` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(100) NOT NULL,
  `lname` VARCHAR(100) NOT NULL,
  `gender` VARCHAR(30) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phonenumber` VARCHAR(30) NOT NULL,
  `dob` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_signin_det_email` (`email`),
  KEY `idx_signin_det_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Local demonstration account. The application currently compares plaintext
-- passwords, so this value intentionally matches that existing implementation.
INSERT INTO `signin_det`
  (`fname`,`lname`,`gender`,`email`,`password`,`phonenumber`,`dob`)
VALUES
  ('Demo','User','Other','demo@flexigo.local','FlexiGoDemo123','9000000000','1995-01-15')
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`);
