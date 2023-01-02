-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2023 at 04:07 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profile_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_cer`
--

DROP TABLE IF EXISTS `add_cer`;
CREATE TABLE IF NOT EXISTS `add_cer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `cdetails` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_cer`
--

INSERT INTO `add_cer` (`id`, `user_id`, `cname`, `cdetails`) VALUES
(1, 1, 'CCC', 'MS Word, PowerPoint,Excel');

-- --------------------------------------------------------

--
-- Table structure for table `edu_info`
--

DROP TABLE IF EXISTS `edu_info`;
CREATE TABLE IF NOT EXISTS `edu_info` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT NULL,
  `qualification` varchar(100) NOT NULL,
  `board` varchar(100) NOT NULL,
  `per` varchar(11) NOT NULL,
  `passyear` int(5) DEFAULT NULL,
  `rtype` varchar(10) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edu_info`
--

INSERT INTO `edu_info` (`id`, `user_id`, `qualification`, `board`, `per`, `passyear`, `rtype`, `city`) VALUES
(1, 1, 'BCA', 'Veer Narmad South GujaratUniversity ', '6.2', 2018, 'CGPA', NULL),
(2, 1, 'MCA', 'Veer Narmad South GujaratUniversity ', '5.2', 2021, 'CGPA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exe_info`
--

DROP TABLE IF EXISTS `exe_info`;
CREATE TABLE IF NOT EXISTS `exe_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `position` varchar(30) NOT NULL,
  `state` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `jdate` varchar(30) NOT NULL,
  `edate` varchar(40) DEFAULT NULL,
  `work` varchar(200) NOT NULL,
  `current` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exe_info`
--

INSERT INTO `exe_info` (`id`, `user_id`, `company_name`, `position`, `state`, `city`, `jdate`, `edate`, `work`, `current`) VALUES
(1, 1, 'Maruty Education Centre', 'Computer Teacher', 'Gujarat', 'Netrang', 'Dec 2020', 'June 2021', '<br>', 0),
(3, 1, 'Netsol It Solutions', 'PHP Trainee', 'Gujarat', 'Surat', 'Dec 2019', 'June 2020', 'Laravel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `rate` int(10) NOT NULL DEFAULT '20',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `user_id`, `lname`, `rate`) VALUES
(1, '1', 'English', 52);

-- --------------------------------------------------------

--
-- Table structure for table `per_info`
--

DROP TABLE IF EXISTS `per_info`;
CREATE TABLE IF NOT EXISTS `per_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `postalcode` varchar(10) DEFAULT NULL,
  `mono` bigint(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(30) NOT NULL,
  `lug` varchar(30) NOT NULL,
  `hobbies` varchar(40) NOT NULL,
  `profession` varchar(20) NOT NULL DEFAULT 'Student',
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_info`
--

INSERT INTO `per_info` (`id`, `user_id`, `fname`, `lname`, `address`, `city`, `postalcode`, `mono`, `email`, `gender`, `dob`, `lug`, `hobbies`, `profession`, `image`) VALUES
(1, '1', 'Anjana', 'Vasava', 'At. Javahar Bazar Netrang', 'Netrang', '393130', 9978077564, 'vasavaanjana003@gmail.com', 'Female', '15-11-1997', 'English,Hindi,Gujarati', 'Drawing,Travalling', 'Php Developer', 'testimonial-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `skill` varchar(30) DEFAULT NULL,
  `rate` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `skill`, `rate`) VALUES
(1, 1, 'HTML', 3);

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

DROP TABLE IF EXISTS `summary`;
CREATE TABLE IF NOT EXISTS `summary` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `summary` varchar(900) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `deleted_at` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `hash_id`, `name`, `password`, `email`, `created_at`, `modify_at`, `deleted_at`) VALUES
(1, 'c30193f7883e3b0d6db8afbd5ea32cb5', 'anjana', 'e10adc3949ba59abbe56e057f20f883e', 'vasavaanjana003@gmail.com', '2023-01-02 02:43:33pm', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
