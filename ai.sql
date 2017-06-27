-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 05:33 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ai`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `name`, `value`, `date_added`) VALUES
(3, 'audi-r8.jpg', 'audi-r8.jpg', '0000-00-00 00:00:00'),
(4, 'ford-escape.jpg', 'ford-escape.jpg', '0000-00-00 00:00:00'),
(5, 'lexus-LFA.jpg', 'lexus-LFA.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `image_tag`
--

CREATE TABLE IF NOT EXISTS `image_tag` (
  `image_tag_id` int(16) NOT NULL AUTO_INCREMENT,
  `image_id` int(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`image_tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `image_tag`
--

INSERT INTO `image_tag` (`image_tag_id`, `image_id`, `name`, `value`) VALUES
(7, 3, 'country', 'German'),
(8, 3, 'type', 'Coupe'),
(9, 3, 'color', 'Red'),
(10, 4, 'country', 'American'),
(11, 4, 'type', 'SUV'),
(12, 4, 'color', 'White'),
(13, 5, 'country', 'Japanese'),
(14, 5, 'type', 'Sedan'),
(15, 5, 'color', 'Yellow');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
