-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2016 at 03:21 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chemfair16`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `email_recovery` varchar(128) NOT NULL,
  `security_question` varchar(128) NOT NULL,
  `security_answer` varchar(128) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `verification_code` varchar(64) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `time_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `fullname`, `phone_number`, `email_recovery`, `security_question`, `security_answer`, `is_admin`, `verification_code`, `is_verified`, `time_created`) VALUES
(1, 'admin@example.com', 'password_cfui2016', '', '', '', '', '', 1, '', 0, '0000-00-00 00:00:00'),
(4, 'test@gmail.com', '$2y$10$od8czXJN.qqznZGquEuKEuqDAPLAQWEOgLHunsSbMwvnmspXX.viK', 'Lee Sin', '08176425732', 'recov@gmail.com', 'Howdy', 'No shit', 0, '', 0, '2016-07-07 18:27:22'),
(8, 'furibaito@gmail.com', '$2y$10$FrL66DDSKp0.QL209sS/quwizbkrpYz8wPUXOxWv05N0GOK2H18n.', 'Lee Sin', '08176425732', 'recov@gmail.com', 'Howdy', 'No shit', 0, NULL, 1, '2016-07-08 11:54:29'),
(10, 'furibaito@live.com', '$2y$10$XOpP4pXyLWC67lRYEm6cV.FtnUAz.a54loaR0ae5G6bREimMwvD3C', 'Lee Sin', '08176425732', 'recov@gmail.com', 'Howdy', 'No shit', 0, NULL, 1, '2016-07-08 12:15:35'),
(11, 'jonathan.hosea@me.com', '$2y$10$NmFN1Jm1AU8v1puSitf6euViFRXncItxNwi3BV01g/XvvCPuBM1Gm', 'Jonathan Hosea', '87884514310', 'zonecaptain@gmail.com', '', '', 0, NULL, 1, '2016-07-30 12:21:54'),
(12, 'zonecaptain@gmail.com', '$2y$10$Zil16c3dv73sisgCEClDEepwD4uUtr2noK.AlIvbJKWhab3Y2TD7O', 'Jonathan Hosea', '087875763570', 'jonathan.hosea@me.com', 'LALALA', 'LALALALA', 1, NULL, 1, '2016-07-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cc_participants`
--

CREATE TABLE `cc_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `fullname_member1` varchar(128) NOT NULL,
  `fullname_member2` varchar(128) NOT NULL,
  `identity_member1_link` varchar(255) DEFAULT NULL,
  `identity_member2_link` varchar(255) DEFAULT NULL,
  `institution_name` varchar(128) NOT NULL,
  `province_id` int(11) UNSIGNED NOT NULL,
  `teacher_name` varchar(128) NOT NULL,
  `teacher_phone_number` varchar(16) NOT NULL,
  `lodging_days` int(11) DEFAULT NULL,
  `teacher_needs_lodging` tinyint(1) DEFAULT NULL,
  `need_transport` tinyint(1) NOT NULL,
  `payment_proof_link` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `time_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc_participants`
--

INSERT INTO `cc_participants` (`id`, `account_id`, `fullname_member1`, `fullname_member2`, `identity_member1_link`, `identity_member2_link`, `institution_name`, `province_id`, `teacher_name`, `teacher_phone_number`, `lodging_days`, `teacher_needs_lodging`, `need_transport`, `payment_proof_link`, `is_paid`, `time_registered`) VALUES
(1, 1, 'Jonathan', 'Hosea', 'asdlkna', 'awdawdasd', 'wdawdasdawd', 3, 'awdawdasd', '12312312123', 123123, 12, 1, 'uploads/cc/1/bukti_trf.JPG', 1, '2016-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `cfk_participants`
--

CREATE TABLE `cfk_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `type` enum('public','student') NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `institution_name` varchar(128) NOT NULL,
  `photo_link` varchar(255) NOT NULL,
  `payment_proof_link` varchar(255) NOT NULL,
  `time_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_participants`
--

CREATE TABLE `cip_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `type` enum('highschool','university') NOT NULL,
  `fullname_member1` varchar(128) NOT NULL,
  `fullname_member2` varchar(128) NOT NULL,
  `fullname_member3` varchar(128) NOT NULL,
  `identity_member1_link` varchar(255) DEFAULT NULL,
  `identity_member2_link` varchar(255) DEFAULT NULL,
  `identity_member3_link` varchar(255) DEFAULT NULL,
  `id_number_member1` varchar(255) NOT NULL,
  `id_number_member2` varchar(255) NOT NULL,
  `id_number_member3` varchar(255) NOT NULL,
  `passphoto_link1` varchar(255) NOT NULL,
  `passphoto_link2` varchar(255) NOT NULL,
  `passphoto_link3` varchar(255) NOT NULL,
  `institution_name` varchar(128) NOT NULL,
  `province_id` int(11) UNSIGNED NOT NULL,
  `lodging_days` int(11) DEFAULT NULL,
  `need_transport` tinyint(1) NOT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `teacher_email` varchar(255) DEFAULT NULL,
  `teacher_phone` varchar(255) DEFAULT NULL,
  `abstract_link` varchar(255) DEFAULT NULL,
  `abstract_passed` tinyint(1) NOT NULL DEFAULT '0',
  `payment_proof_link` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `time_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cip_participants`
--

INSERT INTO `cip_participants` (`id`, `account_id`, `type`, `fullname_member1`, `fullname_member2`, `fullname_member3`, `identity_member1_link`, `identity_member2_link`, `identity_member3_link`, `id_number_member1`, `id_number_member2`, `id_number_member3`, `passphoto_link1`, `passphoto_link2`, `passphoto_link3`, `institution_name`, `province_id`, `lodging_days`, `need_transport`, `teacher_name`, `teacher_email`, `teacher_phone`, `abstract_link`, `abstract_passed`, `payment_proof_link`, `is_paid`, `time_registered`) VALUES
(11, 11, 'highschool', 'Jonathan Hosea', 'Jonathan Hosea', 'Jonathan Hosea', 'uploads/cip/11/identity_member1_link.jpg', 'uploads/cip/11/identity_member2_link.jpg', 'uploads/cip/11/identity_member3_link.jpg', 'Jonathan Hosea', 'Jonathan Hosea', 'Jonathan Hosea', 'uploads/cip/11/passphoto_link1.jpg', 'uploads/cip/11/passphoto_link2.jpg', 'uploads/cip/11/passphoto_link3.jpg', 'zonecaptain@gmail.com', 1, 10, 1, '', '', '8161963880', NULL, 0, 'uploads/cip/11/bukti_trf.JPG', 1, '2016-08-17 07:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `cmp_participants`
--

CREATE TABLE `cmp_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `anggota` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `id_number` varchar(2555) NOT NULL,
  `identity_link` varchar(255) DEFAULT NULL,
  `institution_name` varchar(128) NOT NULL,
  `province_id` int(10) UNSIGNED NOT NULL,
  `youtube_video_link` varchar(255) DEFAULT NULL,
  `payment_proof_link` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `time_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmp_participants`
--

INSERT INTO `cmp_participants` (`id`, `account_id`, `fullname`, `anggota`, `address`, `phone`, `email`, `gender`, `id_number`, `identity_link`, `institution_name`, `province_id`, `youtube_video_link`, `payment_proof_link`, `is_paid`, `time_registered`) VALUES
(2, 11, 'Jonathan Hosea', 'Hosea#Tjandra#Ali', 'TPI D 11', '8161963880', 'zonecaptain@gmail.com', 'Male', 'asndonaslndaksndasd', 'uploads/cmp/11/identity_link.jpg', 'SMAK5', 15, NULL, NULL, 0, '2016-08-26 17:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `cms_news`
--

CREATE TABLE `cms_news` (
  `id` int(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_news`
--

INSERT INTO `cms_news` (`id`, `title`, `content`, `created`) VALUES
(1, 'Halooo ini news ke 1', '<p>Halooo ini news ke 1</p>', '2016-07-31'),
(2, 'Halooo ini news ke 2', '<p>askjdalksbdlkjbaskdbjkasbd</p>', '2016-07-31'),
(3, 'Halooo ini news ke 3', '<p>Halss</p>', '2016-07-31'),
(18, 'tes', '<p>ajsdnakjsdasd</p>', '2016-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `value2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`, `value2`) VALUES
(1, 'slidejs', 'slide', '');

-- --------------------------------------------------------

--
-- Table structure for table `cp_participants`
--

CREATE TABLE `cp_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `identity_link` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) NOT NULL,
  `institution_name` varchar(128) NOT NULL,
  `province_id` int(10) UNSIGNED NOT NULL,
  `instagram_photo_link` varchar(255) DEFAULT NULL,
  `photo_description` varchar(255) DEFAULT NULL,
  `payment_proof_link` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `time_registered` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cp_participants`
--

INSERT INTO `cp_participants` (`id`, `account_id`, `fullname`, `identity_link`, `id_number`, `institution_name`, `province_id`, `instagram_photo_link`, `photo_description`, `payment_proof_link`, `is_paid`, `time_registered`, `address`, `phone`, `email`) VALUES
(14, 11, 'Jonathan Hosea', 'uploads/cp/11/identity_link.jpg', 'Jonathan Hosea', 'SMAK 5', 6, 'uploads/cp/karya/11/hasil_karya.jpg', 'uploads/cp/karya/11/description.pdf', 'uploads/cp/11/bukti_trf.jpg', 1, '2016-08-24 17:31:50', 'Taman Pegangsaan Indah Blok D no 11, kelapa gading', '87884514310', 'jonathan.hosea@me.com');

-- --------------------------------------------------------

--
-- Table structure for table `misc_provinces`
--

CREATE TABLE `misc_provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc_provinces`
--

INSERT INTO `misc_provinces` (`id`, `name`) VALUES
(1, 'aceh'),
(2, 'bali'),
(3, 'banten'),
(4, 'bengkulu'),
(5, 'gorontalo'),
(6, 'jakarta'),
(7, 'jambi'),
(8, 'jawa_barat'),
(9, 'jawa_tengah'),
(10, 'jawa_timur'),
(11, 'kalimantan_barat'),
(12, 'kalimantan_selatan'),
(13, 'kalimantan_tengah'),
(14, 'kalimantan_timur'),
(15, 'kalimantan_utara'),
(16, 'kepulauan_bangka_belitung'),
(17, 'kepulauan_riau'),
(18, 'lampung'),
(19, 'maluku'),
(20, 'maluku_utara'),
(21, 'nusa_tenggara_barat'),
(22, 'nusa_tenggara_timur'),
(23, 'papua'),
(24, 'papua_barat'),
(25, 'riau'),
(26, 'sulawesi_barat'),
(27, 'sulawesi_selatan'),
(28, 'sulawesi_tengah'),
(29, 'sulawesi_timur'),
(30, 'sulawesi_utara'),
(31, 'sumatera_barat'),
(32, 'sumatera_selatan'),
(33, 'sumatera_utara'),
(34, 'yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `misc_regions`
--

CREATE TABLE `misc_regions` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc_regions`
--

INSERT INTO `misc_regions` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `misc_region_provinces`
--

CREATE TABLE `misc_region_provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `regionset_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc_region_provinces`
--

INSERT INTO `misc_region_provinces` (`id`, `regionset_id`, `region_id`) VALUES
(1, 1, 31),
(2, 1, 32),
(3, 1, 33),
(4, 1, 1),
(5, 1, 4),
(6, 1, 7),
(7, 1, 16),
(8, 1, 17),
(9, 1, 18),
(10, 1, 25),
(11, 2, 3),
(12, 2, 6),
(13, 2, 8),
(14, 3, 9),
(15, 3, 10),
(16, 3, 34),
(17, 3, 2),
(18, 4, 11),
(19, 4, 12),
(20, 4, 13),
(21, 4, 14),
(22, 4, 17),
(23, 4, 26),
(24, 4, 27),
(25, 4, 28),
(26, 4, 29),
(27, 4, 30),
(28, 4, 5),
(29, 5, 23),
(30, 5, 24),
(31, 5, 19),
(32, 5, 20),
(33, 5, 21),
(34, 5, 22);

-- --------------------------------------------------------

--
-- Table structure for table `seminar_participants`
--

CREATE TABLE `seminar_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `type` enum('public','student') NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `institution_name` varchar(128) NOT NULL,
  `passphoto_link` varchar(255) DEFAULT NULL,
  `payment_proof_link` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `time_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `cc_participants`
--
ALTER TABLE `cc_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `cfk_participants`
--
ALTER TABLE `cfk_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `cip_participants`
--
ALTER TABLE `cip_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `cmp_participants`
--
ALTER TABLE `cmp_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `cms_news`
--
ALTER TABLE `cms_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_participants`
--
ALTER TABLE `cp_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `misc_provinces`
--
ALTER TABLE `misc_provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `misc_regions`
--
ALTER TABLE `misc_regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `misc_region_provinces`
--
ALTER TABLE `misc_region_provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regionset_id` (`regionset_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cc_participants`
--
ALTER TABLE `cc_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cfk_participants`
--
ALTER TABLE `cfk_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_participants`
--
ALTER TABLE `cip_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cmp_participants`
--
ALTER TABLE `cmp_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cms_news`
--
ALTER TABLE `cms_news`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cp_participants`
--
ALTER TABLE `cp_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `misc_provinces`
--
ALTER TABLE `misc_provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `misc_regions`
--
ALTER TABLE `misc_regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `misc_region_provinces`
--
ALTER TABLE `misc_region_provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cc_participants`
--
ALTER TABLE `cc_participants`
  ADD CONSTRAINT `cc_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cc_team_province` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

--
-- Constraints for table `cfk_participants`
--
ALTER TABLE `cfk_participants`
  ADD CONSTRAINT `cfk_participants_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `cip_participants`
--
ALTER TABLE `cip_participants`
  ADD CONSTRAINT `cip_participants_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cip_participants_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

--
-- Constraints for table `cmp_participants`
--
ALTER TABLE `cmp_participants`
  ADD CONSTRAINT `cmp_participants_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cmp_participants_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

--
-- Constraints for table `cp_participants`
--
ALTER TABLE `cp_participants`
  ADD CONSTRAINT `cac_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cp_participants_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

--
-- Constraints for table `misc_region_provinces`
--
ALTER TABLE `misc_region_provinces`
  ADD CONSTRAINT `misc_region_provinces_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `misc_provinces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `misc_region_provinces_ibfk_3` FOREIGN KEY (`regionset_id`) REFERENCES `misc_regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  ADD CONSTRAINT `seminar_participants_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
