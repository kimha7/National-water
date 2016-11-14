-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 08:46 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `water`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `prop` varchar(23) NOT NULL,
  `cust` varchar(23) NOT NULL,
  `name` varchar(23) NOT NULL,
  `date_sign` date NOT NULL,
  `phone` int(23) NOT NULL,
  `balance_sign` int(45) NOT NULL,
  `amount` int(45) NOT NULL,
  `actual_balance` int(50) NOT NULL,
  `completion_date` date NOT NULL,
  `deadline` date NOT NULL,
  `remarks` varchar(23) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`cust`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`prop`, `cust`, `name`, `date_sign`, `phone`, `balance_sign`, `amount`, `actual_balance`, `completion_date`, `deadline`, `remarks`, `month`, `year`) VALUES
('12/33/99', '21-5477', 'shakes', '2015-06-14', 702252395, 525000, 24, 483125, '0000-00-00', '2015-07-24', 'None', 'June', '2015'),
('15-789', '23-112', 'Mpagi', '2015-05-14', 702232596, 100000, 5, -57000, '2015-10-14', '2015-08-02', 'None', 'June', '2015'),
('4353-77', '2324-777', 'zamh', '2015-06-24', 70555555, 4, 6, 0, '2015-12-22', '2015-07-24', 'Complete', 'June', '2015'),
('43', '134-456', 'Shafik', '2015-05-12', 703702193, 200000, 5, 197600, '2015-10-12', '2015-08-13', 'None', 'May', '2015'),
('8998', '673773', 'saidi', '2015-06-24', 706636363, 300000, 12, 275000, '2016-06-24', '2015-07-24', 'None', 'June', '2015'),
('3363/737', '788900', 'bash', '2015-06-24', 2147483647, 250000, 5, 200000, '2015-11-24', '2015-07-24', 'None', 'June', '2015'),
('53636', '353535', 'solo', '2015-06-24', 7036363, 500000, 5, 0, '2015-11-24', '2015-07-24', 'Complete', 'June', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentId` int(50) NOT NULL AUTO_INCREMENT,
  `prop` varchar(23) NOT NULL,
  `cust` varchar(23) NOT NULL,
  `Cname` varchar(34) NOT NULL,
  `date_pay` date NOT NULL,
  `amount` varchar(34) NOT NULL,
  `oldBal` int(45) NOT NULL,
  `day` int(40) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(10) NOT NULL,
  PRIMARY KEY (`PaymentId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentId`, `prop`, `cust`, `Cname`, `date_pay`, `amount`, `oldBal`, `day`, `month`, `year`) VALUES
(29, '4353-77', '2324-777', 'zamh', '2015-06-24', '2000', -2000, 24, 'June', '2015'),
(28, '4353-77', '2324-777', 'zamh', '2015-06-24', '2000', 0, 24, 'June', '2015'),
(27, '4353-77', '2324-777', 'zamh', '2015-06-24', '975000', 975000, 24, 'June', '2015'),
(26, '4353-77', '2324-777', 'zamh', '2015-06-24', '5000', 980000, 24, 'June', '2015'),
(25, '4353-77', '2324-777', 'zamh', '2015-06-24', '5000', 985000, 24, 'June', '2015'),
(21, '4353-77', '2324-777', 'zamh', '2015-06-23', '5000', 1000000, 23, 'June', '2015'),
(22, '4353-77', '2324-777', 'zamh', '2015-06-23', '1000', 995000, 23, 'June', '2015'),
(23, '4353-77', '2324-777', 'zamh', '2015-06-23', '2000', 994000, 23, 'June', '2015'),
(24, '4353-77', '2324-777', 'zamh', '2015-05-12', '7000', 992000, 12, 'May', '2015'),
(30, '3363/737', '788900', 'bash', '2015-06-24', '50000', 300000, 24, 'June', '2015'),
(31, '3363/737', '788900', 'bash', '2015-06-24', '50000', 250000, 24, 'June', '2015'),
(32, '12/33/99', '21-5477', 'shakes', '2015-06-24', '21875', 505000, 24, 'June', '2015'),
(33, '8998', '673773', 'saidi', '2015-06-24', '25000', 300000, 24, 'June', '2015'),
(34, '53636', '353535', 'solo', '2015-06-24', '100000', 500000, 24, 'June', '2015'),
(35, '53636', '353535', 'solo', '2015-06-24', '100000', 400000, 24, 'June', '2015'),
(36, '53636', '353535', 'solo', '2015-06-24', '100000', 300000, 24, 'June', '2015'),
(37, '53636', '353535', 'solo', '2015-06-24', '100000', 200000, 24, 'June', '2015'),
(38, '53636', '353535', 'solo', '2015-06-24', '100000', 100000, 24, 'June', '2015'),
(39, '15-789', '23-112', 'Mpagi', '2015-07-03', '60000', 63000, 3, 'July', '2015'),
(40, '15-789', '23-112', 'Mpagi', '2015-07-03', '60000', 3000, 3, 'July', '2015'),
(41, '43', '134-456', 'Shafik', '2015-07-14', '1200', 200000, 14, 'July', '2015'),
(42, '43', '134-456', 'Shafik', '2015-07-14', '1200', 198800, 14, 'July', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userNo` int(50) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(23) NOT NULL,
  `Lname` varchar(23) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `telNo` int(23) NOT NULL,
  `userEmail` varchar(70) NOT NULL,
  `post` varchar(11) NOT NULL,
  `regDate` date NOT NULL,
  PRIMARY KEY (`userNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userNo`, `Fname`, `Lname`, `username`, `password`, `gender`, `telNo`, `userEmail`, `post`, `regDate`) VALUES
(4, 'Admin', 'Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Male', 777077, 'me@water.com', 'Admin', '2015-06-27'),
(5, 'mpagi', 'saidi', 'sayd5711', 'a05f3b4d914659fcd7ccf2f22d75114c7d30b039', 'Male', 702252395, 'saydmpagi@yahoo.com', 'User', '2015-07-01'),
(6, 'kiberu', 'sharif', 'shakes', '985cf6a8dbba3ecd5f98c9e2bdea72a707fc5e0b', 'Male', 90909090, 'kiberusharif@gmail.com', 'User', '2015-07-09');
