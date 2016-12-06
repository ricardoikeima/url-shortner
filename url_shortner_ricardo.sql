-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 02, 2016 at 01:41 PM
-- Server version: 5.5.41-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `url_shortner_ricardo`
--

-- --------------------------------------------------------

--
-- Table structure for table `urlshortner`
--

CREATE TABLE IF NOT EXISTS `urlshortner` (
  `key` varchar(6) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urlshortner`
--

INSERT INTO `urlshortner` (`key`, `url`) VALUES
('1hiqe1', 'http://www.canadiantire.ca'),
('5ew20k', 'http://www.ebay.ca'),
('ar9x1e', 'http://www.amazon.ca'),
('eka97x', 'http://www.walmart.ca'),
('ilut10', 'http://www.thebay.com'),
('n7g949', 'http://www.newegg.ca'),
('r10spp', 'http://www.bestbuy.ca'),
('v2jpsh', 'http://www.sears.ca');

-- --------------------------------------------------------

--
-- Table structure for table `visitcounter`
--

CREATE TABLE IF NOT EXISTS `visitcounter` (
`visitId` tinyint(4) NOT NULL,
  `key` varchar(6) NOT NULL REFERENCES `urlshortner`(`key`),
  `date` date NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `visitcounter`
--

INSERT INTO `visitcounter` (`visitId`, `key`, `date`, `country`, `city`) VALUES
(1, 'v2jpsh', '2016-01-02', 'United States', 'Chicago'),
(2, 'eka97x', '2016-01-02', 'United States', 'New York'),
(3, 'r10spp', '2016-01-05', 'United States', 'Chicago'),
(4, 'eka97x', '2016-01-06', 'Australia', 'Sidney'),
(5, 'ilut10', '2016-01-10', 'Canada', 'Mississauga'),
(6, '1hiqe1', '2016-01-16', 'United States', 'New York'),
(7, 'n7g949', '2016-01-17', 'United States', 'Chicago'),
(8, 'v2jpsh', '2016-01-22', 'United States', 'Los Angeles'),
(9, '5ew20k', '2016-01-25', 'United States', 'New York'),
(10, '1hiqe1', '2016-01-28', 'Canada', 'Calgary'),
(11, 'eka97x', '2016-01-29', 'Australia', 'Perth'),
(12, 'n7g949', '2016-02-03', 'United Kingdom', 'London'),
(13, 'eka97x', '2016-02-05', 'United States', 'Chicago'),
(14, '1hiqe1', '2016-02-13', 'United States', 'Chicago'),
(15, 'ar9x1e', '2016-02-18', 'United Kingdom', 'Birmingham'),
(16, 'v2jpsh', '2016-02-19', 'Canada', 'Ottawa'),
(17, 'r10spp', '2016-02-25', 'Australia', 'Melbourne'),
(18, 'eka97x', '2016-02-26', 'Australia', 'Sidney'),
(19, '1hiqe1', '2016-02-27', 'Australia', 'Melbourne'),
(20, 'ar9x1e', '2016-03-01', 'United Kingdom', 'Birmingham'),
(21, '5ew20k', '2016-03-02', 'Canada', 'Oakville'),
(22, 'eka97x', '2016-03-03', 'United Kingdom', 'Birmingham'),
(23, '1hiqe1', '2016-03-07', 'United States', 'Washington'),
(24, 'v2jpsh', '2016-03-09', 'United States', 'New York'),
(25, 'eka97x', '2016-03-13', 'United States', 'Los Angeles'),
(26, 'n7g949', '2016-03-15', 'Australia', 'Sidney'),
(27, 'ar9x1e', '2016-03-17', 'United Kingdom', 'Birmingham'),
(28, 'eka97x', '2016-03-20', 'Australia', 'Perth'),
(29, 'eka97x', '2016-03-23', 'United Kingdom', 'Birmingham'),
(30, 'eka97x', '2016-03-29', 'Canada', 'Ottawa'),
(31, 'n7g949', '2016-04-07', 'United States', 'Los Angeles'),
(32, 'r10spp', '2016-04-08', 'United States', 'Los Angeles'),
(33, 'eka97x', '2016-04-10', 'Canada', 'Ottawa'),
(34, 'ar9x1e', '2016-04-15', 'Canada', 'Montreal'),
(35, 'eka97x', '2016-04-17', 'Australia', 'Melbourne'),
(36, 'ar9x1e', '2016-04-20', 'Canada', 'Oakville'),
(37, 'n7g949', '2016-04-24', 'Canada', 'Mississauga'),
(38, 'ilut10', '2016-04-26', 'United States', 'New York'),
(39, 'ilut10', '2016-04-26', 'Australia', 'Sidney'),
(40, 'eka97x', '2016-05-03', 'United Kingdom', 'Birmingham'),
(41, 'eka97x', '2016-05-03', 'United States', 'Detroit'),
(42, 'ilut10', '2016-05-04', 'United States', 'Miami'),
(43, 'v2jpsh', '2016-05-08', 'United States', 'Detroit'),
(44, 'ilut10', '2016-05-08', 'United States', 'Detroit'),
(45, 'ilut10', '2016-05-09', 'Canada', 'Quebec'),
(46, 'ilut10', '2016-05-11', 'United States', 'Los Angeles'),
(47, 'ar9x1e', '2016-05-12', 'Australia', 'Perth'),
(48, 'eka97x', '2016-05-17', 'Canada', 'Montreal'),
(49, 'r10spp', '2016-05-20', 'Canada', 'Toronto'),
(50, 'ar9x1e', '2016-05-30', 'Canada', 'Toronto'),
(51, 'eka97x', '2016-05-30', 'Canada', 'Calgary'),
(52, 'eka97x', '2016-05-30', 'United States', 'Detroit'),
(53, 'n7g949', '2016-06-08', 'United Kingdom', 'London'),
(54, 'ar9x1e', '2016-06-15', 'Canada', 'Montreal'),
(55, '1hiqe1', '2016-06-15', 'United Kingdom', 'London'),
(56, 'ilut10', '2016-06-19', 'Canada', 'Calgary'),
(57, 'ilut10', '2016-06-26', 'United Kingdom', 'London'),
(58, 'v2jpsh', '2016-06-27', 'United States', 'Las Vegas'),
(59, 'eka97x', '2016-06-29', 'United States', 'New York'),
(60, '5ew20k', '2016-07-01', 'Canada', 'Toronto'),
(61, 'v2jpsh', '2016-07-04', 'United States', 'New York'),
(62, 'n7g949', '2016-07-07', 'Australia', 'Perth'),
(63, 'eka97x', '2016-07-09', 'Canada', 'Toronto'),
(64, '1hiqe1', '2016-07-10', 'United States', 'New York'),
(65, 'eka97x', '2016-07-11', 'Canada', 'Calgary'),
(66, 'eka97x', '2016-07-12', 'United States', 'Los Angeles'),
(67, '5ew20k', '2016-07-13', 'Canada', 'Vancouver'),
(68, 'n7g949', '2016-07-13', 'United States', 'Boston'),
(69, '1hiqe1', '2016-07-20', 'Canada', 'Vancouver'),
(70, 'n7g949', '2016-07-28', 'Canada', 'Ottawa'),
(71, '5ew20k', '2016-07-29', 'Canada', 'Quebec'),
(72, 'eka97x', '2016-07-31', 'Canada', 'Vancouver'),
(73, 'ilut10', '2016-08-09', 'Australia', 'Melbourne'),
(74, 'eka97x', '2016-08-22', 'Australia', 'Melbourne'),
(75, '5ew20k', '2016-08-27', 'United Kingdom', 'Birmingham'),
(76, '1hiqe1', '2016-08-31', 'Canada', 'Toronto'),
(77, 'ar9x1e', '2016-09-02', 'Canada', 'Vancouver'),
(78, 'ilut10', '2016-09-02', 'United States', 'Detroit'),
(79, '5ew20k', '2016-09-04', 'United States', 'New York'),
(80, 'n7g949', '2016-09-12', 'United States', 'New York'),
(81, 'n7g949', '2016-09-30', 'United States', 'Boston'),
(82, 'eka97x', '2016-10-01', 'United States', 'Las Vegas'),
(83, 'eka97x', '2016-10-04', 'Australia', 'Sidney'),
(84, 'r10spp', '2016-10-08', 'Australia', 'Sidney'),
(85, 'v2jpsh', '2016-10-15', 'Australia', 'Melbourne'),
(86, 'ilut10', '2016-10-18', 'Australia', 'Sidney'),
(87, 'v2jpsh', '2016-10-19', 'Canada', 'Ottawa'),
(88, 'eka97x', '2016-10-20', 'United States', 'Washington'),
(89, 'n7g949', '2016-10-27', 'United Kingdom', 'London'),
(90, 'n7g949', '2016-10-28', 'Canada', 'Calgary'),
(91, '1hiqe1', '2016-10-29', 'Canada', 'Calgary'),
(92, 'ar9x1e', '2016-11-01', 'Canada', 'Oakville'),
(93, 'eka97x', '2016-11-07', 'Canada', 'Quebec'),
(94, 'eka97x', '2016-11-10', 'Australia', 'Sidney'),
(95, '1hiqe1', '2016-11-15', 'Canada', 'Toronto'),
(96, 'n7g949', '2016-11-19', 'Canada', 'Quebec'),
(97, 'ilut10', '2016-11-24', 'Canada', 'Calgary'),
(98, 'v2jpsh', '2016-11-29', 'United States', 'Boston'),
(99, 'r10spp', '2016-11-29', 'United Kingdom', 'London'),
(100, 'r10spp', '2016-11-30', 'Canada', 'Toronto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urlshortner`
--
ALTER TABLE `urlshortner`
 ADD PRIMARY KEY (`key`);

--
-- Indexes for table `visitcounter`
--
ALTER TABLE `visitcounter`
 ADD PRIMARY KEY (`visitId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visitcounter`
--
ALTER TABLE `visitcounter`
MODIFY `visitId` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
