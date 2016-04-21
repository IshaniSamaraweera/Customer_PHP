-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2015 at 08:35 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `samarasinghemotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_ID` int(10) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `NIC` varchar(10) NOT NULL,
  `address_line1` varchar(20) NOT NULL,
  `address_line2` varchar(20) NOT NULL,
  `address_line3` varchar(20) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fax` varchar(15) NOT NULL,
  PRIMARY KEY (`customer_ID`),
  KEY `customer_ID` (`customer_ID`),
  KEY `customer_ID_2` (`customer_ID`),
  KEY `customer_ID_3` (`customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `first_name`, `last_name`, `NIC`, `address_line1`, `address_line2`, `address_line3`, `contact_no`, `email`, `fax`) VALUES
(0, 'Ishani', 'Samaraweera', '927812509V', 'Duwewatta', 'Uluvitike', 'Galle', '0771231232', 'ishanisamaraweera@gmail.com', '0714054287'),
(1, 'Isuru', 'Buddika', '927812009V', '', '', 'Udugama', '0716576060', 'isuru@gmail.com', '0716576060'),
(2, 'Shehani', 'Apsara', '897782456V', '', '', 'Horana', '0344564562', 'shehaniap@gmail.com', '0771212120'),
(3, 'Dilrukshi', 'Perera', '855625456V', '', '', 'Nugegoda', '0915485125', 'dilu@gmail.com', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
