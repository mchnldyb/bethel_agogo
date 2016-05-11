-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2016 at 11:44 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE IF NOT EXISTS `folder` (
  `foldernumber` int(4) NOT NULL AUTO_INCREMENT,
  `foldername` char(40) NOT NULL,
  PRIMARY KEY (`foldernumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`foldernumber`, `foldername`) VALUES
(1, 'Django Folder'),
(2, 'Will Smith'),
(3, 'dwdw Mar'),
(4, 'dwdw Mar'),
(5, 'Sur KK'),
(6, 'Zacaria Daniel'),
(7, 'Agbenu Kuuku');

-- --------------------------------------------------------

--
-- Table structure for table `healthfacility`
--

CREATE TABLE IF NOT EXISTS `healthfacility` (
  `facilitynumber` int(4) NOT NULL AUTO_INCREMENT,
  `facilityname` char(40) NOT NULL,
  PRIMARY KEY (`facilitynumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `healthfacility`
--

INSERT INTO `healthfacility` (`facilitynumber`, `facilityname`) VALUES
(1, 'Some Health Facility'),
(2, 'Another Health Facility');

-- --------------------------------------------------------

--
-- Table structure for table `healthinsurance`
--

CREATE TABLE IF NOT EXISTS `healthinsurance` (
  `insurancenumber` varchar(13) NOT NULL,
  `schemename` char(40) NOT NULL,
  PRIMARY KEY (`insurancenumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthinsurance`
--

INSERT INTO `healthinsurance` (`insurancenumber`, `schemename`) VALUES
('GRMH832382300', 'Greater Accra Mutual Health Scheme'),
('VHRM00098321', 'Volta Regional Mutual Scheme'),
('Vrma554', 'Ho Mutual');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patientID` int(4) NOT NULL AUTO_INCREMENT,
  `surname` char(30) NOT NULL,
  `firstname` char(30) NOT NULL,
  `middlename` char(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `maritalstatus` char(10) NOT NULL,
  `sex` char(6) DEFAULT NULL,
  `occupation` char(30) DEFAULT NULL,
  `religion` char(20) DEFAULT NULL,
  `postaladdress` varchar(50) DEFAULT NULL,
  `homeaddress` varchar(40) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `nearestrelative` char(35) DEFAULT NULL,
  `nearestrelativecontact` char(10) DEFAULT NULL,
  `district` char(40) DEFAULT NULL,
  `subdistrict` char(40) DEFAULT NULL,
  `healthfacility` int(4) DEFAULT NULL,
  `folder` int(4) DEFAULT NULL,
  `healthinsurance` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`patientID`),
  KEY `healthfacility` (`healthfacility`),
  KEY `folder` (`folder`),
  KEY `healthinsurance` (`healthinsurance`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `surname`, `firstname`, `middlename`, `dob`, `maritalstatus`, `sex`, `occupation`, `religion`, `postaladdress`, `homeaddress`, `email`, `nearestrelative`, `nearestrelativecontact`, `district`, `subdistrict`, `healthfacility`, `folder`, `healthinsurance`) VALUES
(1, 'Django', 'Man', NULL, '1989-03-14', 'Single', 'Male', 'Hunter', 'Christian', 'Box 233, Mainlands', 'Hse Number 332, Mainlands', 'django@him.com', 'Samuel Jackson', '2265784415', 'Mainlands', 'Lands', 1, 1, 'GRMH832382300'),
(2, 'Will', 'Smith', NULL, '1987-02-01', 'Married', 'Male', 'Actor', 'Christian', 'Box 333, Usa', '122 Street Usa', 'will@dreamworks.com', 'Jayden Smith', '4588796', 'Atlanta', 'Georgia', 2, 2, 'VHRM00098321'),
(7, 'Sur', 'KK', 'LI', '1978-02-02', 'Single', 'Male', 'Mason', 'Christian', 'HJDW', 'djewd', 'hsd@dks.com', 'kuuku', '0205005456', 'jdw', 'jdw sub', 2, 0, 'Vrma554'),
(8, 'Zacaria', 'Daniel', 'Delali', '1989-01-05', 'Single', 'Male', 'Banker', 'Christian', 'Box 11', 'Hse Nm 01', 'dan@icb.com', 'Mary', '0205484783', 'Accra', 'Accra East', 2, 6, NULL),
(10, 'Agbenu', 'Kuuku', 'Kwaku', '1995-03-06', 'Single', 'Male', 'programmer', 'Christian', 'Box 33', 'Trassaco Est 01', 'hero@it.org', 'Fii', '0208233281', 'Accra', 'North', 2, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `paymentid` varchar(6) NOT NULL,
  `dispensaryfee` double DEFAULT NULL,
  `folderfee` double DEFAULT NULL,
  `othercharges` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `patientid` int(4) NOT NULL,
  PRIMARY KEY (`paymentid`),
  KEY `patientid` (`patientid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `dispensaryfee`, `folderfee`, `othercharges`, `total`, `patientid`) VALUES
('0001', 2, 10, 10.5, 22.5, 0),
('0002', 2, 10, 20, 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` char(40) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `password`, `name`) VALUES
('admin', 'admin', 'Administrator'),
('henry', 'henry', 'Henry Saforo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
