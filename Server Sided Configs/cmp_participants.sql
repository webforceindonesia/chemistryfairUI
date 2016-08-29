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
(3, 11, 'Jonathan Hosea', 'HOSEA#EVANs#Donny#Valen', 'Taman Pegangsaan Indah Blok D no 11, kelapa gading', '08161963880', 'jonathan.hosea@me.com', 'Male', 'asdkjhbasydgas', 'uploads/cmp/11/identity_link.jpg', 'SMAK 5', 17, 'http://google.com', 'uploads/cmp/11/bukti_trf.jpg', 1, '2016-08-29 03:14:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmp_participants`
--
ALTER TABLE `cmp_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `province_id` (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cmp_participants`
--
ALTER TABLE `cmp_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cmp_participants`
--
ALTER TABLE `cmp_participants`
  ADD CONSTRAINT `cmp_participants_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cmp_participants_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `misc_provinces` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
