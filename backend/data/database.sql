CREATE DATABASE IF NOT EXISTS `treasure_hunt`;

USE `treasure_hunt`;

CREATE TABLE IF NOT EXISTS `th_user` (
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `registered_at` datetime NOT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `user_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `th_game` (
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `finished_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `th_played_games` (
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `game_uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `started_at` datetime NOT NULL,
  `finished_at` datetime DEFAULT NULL,
  `score` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `th_played_games` ADD FOREIGN KEY (user_uuid) REFERENCES `th_user` (`uuid`);
ALTER TABLE `th_played_games` ADD FOREIGN KEY (game_uuid) REFERENCES `th_game` (`uuid`);
