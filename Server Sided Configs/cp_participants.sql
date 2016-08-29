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
(15, 11, 'Jonathan', 'uploads/cp/11/identity_link.jpg', 'aslkjjdhniuajsgdiuasghbdjhgbasjhdgas', 'SMAK 5', 6, NULL, NULL, 'uploads/cp/11/bukti_trf.jpg', 1, '2016-08-29 02:54:03', 'Taman Pegangsaan Indah Blok D no 11, kelapa gading', '87884514310', 'jonathan.hosea@me.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_participants`
--
ALTER TABLE `cp_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cp_participants`
--
ALTER TABLE `cp_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cp_participants`
--
ALTER TABLE `cp_participants`
  ADD CONSTRAINT `cac_team_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cp_participants_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
