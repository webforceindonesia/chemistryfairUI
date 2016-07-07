SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `chemfair16` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chemfair16`;

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cac_phases` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cac_photo` (
  `id` int(10) NOT NULL,
  `photo_link` varchar(255) NOT NULL,
  `cac_team_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cac_teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `phase_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cac_video` (
  `id` int(10) UNSIGNED NOT NULL,
  `youtube_video_link` varchar(255) NOT NULL,
  `cac_team_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cc_phases` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cc_regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cc_teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phase_id` int(2) UNSIGNED NOT NULL,
  `region_id` int(2) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cip_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `cip_team_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cip_phases` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cip_teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `is_university` tinyint(1) NOT NULL,
  `phase_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

ALTER TABLE `cac_phases`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cac_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cac_team_id` (`cac_team_id`);

ALTER TABLE `cac_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phase_id` (`phase_id`),
  ADD KEY `account_id` (`account_id`);

ALTER TABLE `cac_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cac_team_id` (`cac_team_id`);

ALTER TABLE `cc_phases`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cc_regions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cc_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `phase_id` (`phase_id`),
  ADD KEY `account_id` (`account_id`);

ALTER TABLE `cip_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`cip_team_id`);

ALTER TABLE `cip_phases`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cip_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `phase_id` (`phase_id`);


ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cac_phases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cac_teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cac_video`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cc_phases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cc_regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cc_teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cip_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cip_phases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `cip_teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `cac_photo`
  ADD CONSTRAINT `cac_photo_team` FOREIGN KEY (`cac_team_id`) REFERENCES `cac_teams` (`id`);

ALTER TABLE `cac_teams`
  ADD CONSTRAINT `cac_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cac_team_phase` FOREIGN KEY (`phase_id`) REFERENCES `cac_phases` (`id`);

ALTER TABLE `cac_video`
  ADD CONSTRAINT `cac_video_team` FOREIGN KEY (`cac_team_id`) REFERENCES `cac_teams` (`id`);

ALTER TABLE `cc_teams`
  ADD CONSTRAINT `cc_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cc_team_phase` FOREIGN KEY (`phase_id`) REFERENCES `cc_phases` (`id`),
  ADD CONSTRAINT `cc_team_region` FOREIGN KEY (`region_id`) REFERENCES `cc_regions` (`id`);

ALTER TABLE `cip_members`
  ADD CONSTRAINT `cip_member_team` FOREIGN KEY (`cip_team_id`) REFERENCES `cip_teams` (`id`);

ALTER TABLE `cip_teams`
  ADD CONSTRAINT `cip_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cip_team_phase` FOREIGN KEY (`phase_id`) REFERENCES `cip_phases` (`id`);