-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2016 at 04:32 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
-- Table structure for table `cc_participants`
--

CREATE TABLE `cc_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `fullname_member1` varchar(128) NOT NULL,
  `fullname_member2` varchar(128) NOT NULL,
  `identity_member1_link` varchar(255) DEFAULT NULL,
  `identity_member2_link` varchar(255) DEFAULT NULL,
  `pas_photo_user1` varchar(255) DEFAULT NULL,
  `pas_photo_user2` varchar(255) DEFAULT NULL,
  `institution_name` varchar(128) NOT NULL,
  `province_id` int(11) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `teacher_name` varchar(128) NOT NULL,
  `teacher_phone_number` varchar(16) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `lodging_days` int(11) DEFAULT NULL,
  `teacher_needs_lodging` tinyint(1) DEFAULT NULL,
  `need_transport` tinyint(1) NOT NULL,
  `payment_proof_link` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `abstract_passed` int(11) NOT NULL DEFAULT '0',
  `time_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc_participants`
--

INSERT INTO `cc_participants` (`id`, `account_id`, `fullname_member1`, `fullname_member2`, `identity_member1_link`, `identity_member2_link`, `pas_photo_user1`, `pas_photo_user2`, `institution_name`, `province_id`, `address`, `phone`, `email`, `teacher_name`, `teacher_phone_number`, `teacher_email`, `lodging_days`, `teacher_needs_lodging`, `need_transport`, `payment_proof_link`, `is_paid`, `abstract_passed`, `time_registered`) VALUES
(4, 11, 'asdasdas', 'dasdasdasdasd', 'uploads/cc/11/identity_link_ketua.jpg', 'uploads/cc/11/identity_link_anggota.jpg', 'uploads/cc/11/passphoto_link1.jpg', 'uploads/cc/11/passphoto_link2.jpg', 'asdasda', 1, 'asdasdasd', 'asdasdasd', 'asdasdasdasd', 'asdasdas', 'dasdasdasdasd', 'asdasdasdasdasd', 0, 0, 0, 'uploads/cc/11/bukti_trf.jpg', 1, 0, '2016-08-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cc_participants`
--
ALTER TABLE `cc_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cc_participants`
--
ALTER TABLE `cc_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cc_participants`
--
ALTER TABLE `cc_participants`
  ADD CONSTRAINT `cc_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cc_team_province` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
