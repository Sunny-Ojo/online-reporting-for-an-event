-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2020 at 06:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtce`
--

-- --------------------------------------------------------

--
-- Table structure for table `day1`
--

DROP TABLE IF EXISTS `day1`;
CREATE TABLE IF NOT EXISTS `day1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(100) NOT NULL,
  `timeClose` varchar(100) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportForTheDay` longtext NOT NULL,
  `Challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` mediumtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL DEFAULT 'filled',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day2`
--

DROP TABLE IF EXISTS `day2`;
CREATE TABLE IF NOT EXISTS `day2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(100) NOT NULL,
  `timeClose` varchar(100) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportForTheDay` longtext NOT NULL,
  `challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` mediumtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day3`
--

DROP TABLE IF EXISTS `day3`;
CREATE TABLE IF NOT EXISTS `day3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(100) NOT NULL,
  `timeClose` varchar(100) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportForTheDay` longtext NOT NULL,
  `challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` longtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day4`
--

DROP TABLE IF EXISTS `day4`;
CREATE TABLE IF NOT EXISTS `day4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(100) NOT NULL,
  `timeClose` varchar(100) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportForTheDay` longtext NOT NULL,
  `challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` mediumtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day5`
--

DROP TABLE IF EXISTS `day5`;
CREATE TABLE IF NOT EXISTS `day5` (
  `id` int(11) NOT NULL,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(255) NOT NULL,
  `timeClose` varchar(255) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportFortheDay` longtext NOT NULL,
  `challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` mediumtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day6`
--

DROP TABLE IF EXISTS `day6`;
CREATE TABLE IF NOT EXISTS `day6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(100) NOT NULL,
  `timeClose` varchar(100) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportForTheDay` longtext NOT NULL,
  `challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` mediumtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day7`
--

DROP TABLE IF EXISTS `day7`;
CREATE TABLE IF NOT EXISTS `day7` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinatorsName` varchar(100) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `timeOpen` varchar(100) NOT NULL,
  `timeClose` varchar(100) NOT NULL,
  `numberOfTeens` bigint(255) NOT NULL,
  `numberOfTeachers` bigint(255) NOT NULL,
  `reportForTheDay` longtext NOT NULL,
  `challenges` longtext NOT NULL,
  `possibleSolutions` longtext NOT NULL,
  `relevantInformation` mediumtext NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filled` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Technical\r\n'),
(2, 'ICT(IT)'),
(3, 'Accomodation'),
(4, 'Welfare'),
(5, 'Special	'),
(6, 'Press'),
(7, 'General_Welfare	'),
(8, 'Publicity'),
(9, 'Medical'),
(10, 'Security'),
(11, 'Program'),
(12, 'Protocol'),
(13, 'Ushering'),
(14, 'Sanitation'),
(15, 'Choir'),
(16, 'Skill_and_acquisition'),
(17, 'Store'),
(18, 'Drama'),
(19, 'Decoration'),
(20, 'Registraion'),
(21, 'Safety'),
(22, 'Transportation'),
(23, 'Sports'),
(24, 'Counseling'),
(25, 'Prayer'),
(26, 'Electrical'),
(27, 'Facility'),
(28, 'NTA'),
(29, 'HMC'),
(31, 'Educational_resources(Bible study)'),
(32, 'Maintenance_and_development');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `department` varchar(255) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
