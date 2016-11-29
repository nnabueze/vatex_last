-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2016 at 08:08 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vatex`
--
CREATE DATABASE IF NOT EXISTS `vatex` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vatex`;

-- --------------------------------------------------------

--
-- Table structure for table `bankcode`
--

CREATE TABLE IF NOT EXISTS `bankcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankcode` int(11) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `bankcode`
--

INSERT INTO `bankcode` (`id`, `bankcode`, `bankname`) VALUES
(1, 44, 'ACCESS BANK PLC'),
(2, 14, 'AFRIBANK NIGERIA PLC'),
(3, 82, 'KEYSTONE BANK'),
(4, 63, 'DIAMOND BANK PLC'),
(5, 50, 'ECOBANK NIGERIA PLC'),
(6, 232, 'EQUITORIAL TRUST BANK LIMITED'),
(7, 70, 'FIDELITY BANK PLC'),
(8, 11, 'FIRST BANK OF NIGERIA PLC'),
(9, 214, 'FIRST CITY MONUMENT BANK PLC'),
(10, 214, 'FIRST INLAND BANK PLC'),
(11, 58, 'GUARANTY TRUST BANK PLC'),
(12, 221, 'STANBIC IBTC BANK PLC'),
(13, 23, 'CITI BANK'),
(14, 50, 'OCEANIC BANK INTERNATIONAL PLC'),
(15, 76, 'SKYE BANK PLC'),
(16, 84, 'SPRING BANK PLC'),
(17, 68, 'STANDARD CHARTERED BANK PLC'),
(18, 232, 'STERLING BANK PLC'),
(19, 32, 'UNION BANK OF NIGERIA PLC'),
(20, 33, 'UNITED BANK FOR AFRICA PLC'),
(21, 215, 'UNITY BANK PLC'),
(22, 35, 'WEMA BANK PLC'),
(23, 57, 'ZENITH INTERNATIONAL BANK PLC'),
(24, 1, 'CENTRAL BANK OF NIGERIA'),
(25, 301, 'JAIZ BANK PLC'),
(26, 30, 'HERITAGE BANK');

-- --------------------------------------------------------

--
-- Table structure for table `biller`
--

CREATE TABLE IF NOT EXISTS `biller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `biller_username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alternative_mobile` varchar(100) NOT NULL,
  `biller_acronymn` varchar(255) NOT NULL,
  `service_bank_ebills` tinyint(1) NOT NULL DEFAULT '0',
  `service_cashpoint` tinyint(1) NOT NULL,
  `service_centralpay_ecommerce` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=not approved, 1- approved, 2= declined',
  `date_added` datetime NOT NULL,
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `merchantId_NIBSS` varchar(20) NOT NULL,
  `billerDescription` varchar(255) NOT NULL,
  `billerAddress` varchar(255) NOT NULL,
  `creatorId` varchar(255) NOT NULL,
  `approverId` varchar(255) NOT NULL,
  `approvedDate` datetime NOT NULL,
  `comment` text NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `biller`
--

INSERT INTO `biller` (`id`, `biller_username`, `name`, `email_address`, `company_name`, `mobile`, `password`, `alternative_mobile`, `biller_acronymn`, `service_bank_ebills`, `service_cashpoint`, `service_centralpay_ecommerce`, `status`, `date_added`, `last_login`, `merchantId_NIBSS`, `billerDescription`, `billerAddress`, `creatorId`, `approverId`, `approvedDate`, `comment`, `company_logo`, `user_img`) VALUES
(1, 'test', 'Ravi Prakash', 'tenfoldweb@gmail.com', 'erter', '645645754', '10470c3b4b1fed12c3baac014be15fac67c6e815', '34564364654', 'ewrw', 1, 1, 1, 1, '0000-00-00 00:00:00', '2016-06-27 03:13:11', 'safdasrf', 'dfgdfhdfhf', 'rewrtewter', '1', '1', '2016-05-02 19:45:47', 'Biiler Approved', '', ''),
(2, 'pal', 'Pallavi', 'pallavi.24oct@gmail.com', 'fsdfds', '5345436', 'adcd7048512e64b48da55b027577886ee5a36350', '3214234345', '4353543', 1, 1, 1, 1, '2016-04-21 15:13:25', '2016-04-21 14:13:25', 'dfrew', 'gtdgdf', 'gdfg', '1', '1', '2016-04-29 07:47:54', '', '', ''),
(3, 'olufela', 'Olufela', 'olufelasoyemi@gmail.com', 'FCT Water Board', '6477674095', '55c3b5386c486feb662a0785f340938f518d547f', '08023504154', 'fctwb', 1, 0, 1, 1, '2016-04-22 06:49:55', '2016-04-22 05:49:55', 'NIBSS000000022', 'Water Board Corporation', '134 Brisdale Drive', '1', '5', '2016-05-02 19:51:59', 'ok', '', ''),
(4, 'admintest', 'testing test', 'test@test.com', 'test', '12325454545656', '10470c3b4b1fed12c3baac014be15fac67c6e815', '2323423467676', 'rerwsee', 1, 1, 1, 2, '0000-00-00 00:00:00', '2016-04-25 00:27:26', 'wdffd1334', 'ghfffggf  hghghjgh', 'vftfcgh ghg hjgvhg', '1', '1', '2016-04-25 02:55:17', 'declined', '', ''),
(5, 'testingbiller', 'Test test', 'testingbiller@test.com', 'ewterte', '312312432432', '10470c3b4b1fed12c3baac014be15fac67c6e815', '3243253464', 'drew', 1, 1, 1, 1, '2016-04-25 01:30:16', '2016-04-25 00:30:16', 'erteterertt', 'erter etewt et e', 'afewk gfdfg ge rg', '1', '1', '2016-05-02 19:50:49', 'Approved test', '', ''),
(6, 'klugnheimer', 'Ayo Adeluka', 'fellinco@hotmail.com', 'Klug and Heimer', '8023504154', '10470c3b4b1fed12c3baac014be15fac67c6e815', '8023504154', 'kheimer', 1, 1, 1, 1, '2016-05-25 04:59:30', '2016-05-25 03:59:30', 'NIBSS000000025', 'nothing to add here', 'IT Department, Keystone Bank Ltd\n1 Keystone Bank Crescent, Adeyemo Alakija, VI', '2', '2', '2016-05-25 05:00:16', 'Approved', '', ''),
(7, 'ercas', 'Fela', 'ercas@klugandheimer.com', 'ERCAS Integrated Solutions Ltd', '08023504154', '10470c3b4b1fed12c3baac014be15fac67c6e815', '8023504154', 'ercas', 0, 0, 1, 0, '2016-05-29 13:00:58', '2016-05-29 19:00:58', 'NIBSS000000026', 'nothing', 'IT Department, Keystone Bank Ltd\n1 Keystone Bank Crescent, Adeyemo Alakija, VI', '2', '', '0000-00-00 00:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `biller_subuser`
--

CREATE TABLE IF NOT EXISTS `biller_subuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `biller_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-yes, 0-no',
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `biller_subuser`
--

INSERT INTO `biller_subuser` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `gender`, `mobile`, `added_date`, `biller_id`, `status`, `last_login`) VALUES
(1, 'Biller', 'Subuser', 'biller', 'biller@test.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '123456789', '2016-05-14 19:29:51', 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `cd_title` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `cd_interpret` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `cd_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cd_release_date` datetime NOT NULL,
  `cd_no_of_copies` int(11) NOT NULL DEFAULT '0',
  `cd_type` char(5) COLLATE latin1_general_ci NOT NULL,
  `cd_owner` varchar(35) COLLATE latin1_general_ci NOT NULL,
  `cd_content_type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`cd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cds`
--

INSERT INTO `cds` (`cd_title`, `cd_interpret`, `cd_id`, `cd_release_date`, `cd_no_of_copies`, `cd_type`, `cd_owner`, `cd_content_type`) VALUES
('Singham', 'Rohit Setty', 1, '2013-01-09 08:43:14', 5, 'Video', 'Rohit Setty', 'Movie'),
('Singham Returns', 'Rohit Setty', 2, '2015-09-07 07:43:21', 7, 'Video', 'Rohit Setty', 'Movie'),
('Golmal', 'Rohit Setty', 3, '2015-08-18 07:43:26', 4, 'Video', 'Rohit Setty', 'Movie'),
('Golmal Returns', 'Rohit Setty', 4, '2015-06-30 07:43:29', 6, 'Video', 'Rohit Setty', 'Movie'),
('Golmal Returns 2', 'Rohit Setty', 5, '2014-07-15 07:43:35', 10, 'Video', 'Rohit Setty', 'Movie'),
('Welcome', 'Rohit Setty', 6, '2014-05-14 07:43:41', 12, 'Video', 'Rohit Setty', 'Movie'),
('Toofan', 'RGV', 7, '2013-10-30 07:44:45', 8, 'Video', 'RGV', 'Movie'),
('Alag Alag', 'Kishore Kumar', 8, '2012-01-17 07:45:39', 25, 'Audio', 'Kishore Kumar', 'Songs'),
('Sholay', 'Amitabh Bacchan', 9, '1990-02-14 08:10:47', 6, 'Video', 'Amitabh', 'Movie'),
('Khiladi', 'Akshay Kumar', 10, '2010-06-15 08:11:36', 7, 'Video', 'Akshay', 'Movie'),
('Taal Songs', 'A R Reheman', 11, '2014-06-10 08:12:47', 8, 'Audio', 'A R Reheman', 'Songs');

-- --------------------------------------------------------

--
-- Table structure for table `order_refund`
--

CREATE TABLE IF NOT EXISTS `order_refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `ec_id` int(11) NOT NULL,
  `salesdate` date NOT NULL,
  `refunddate` datetime DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `refundtype` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for direct, 2 for api',
  `refundstatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 for pending, 1 for done',
  `bankcode` int(11) NOT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `order_refund`
--

INSERT INTO `order_refund` (`id`, `order_id`, `ec_id`, `salesdate`, `refunddate`, `amount`, `refundtype`, `refundstatus`, `bankcode`, `adddate`) VALUES
(1, 19, 19, '2012-06-06', '2016-09-07 11:24:05', 540.00, 1, 1, 44, '2016-09-07 09:24:05'),
(2, 41, 41, '2012-06-06', '2016-09-07 11:25:33', 16700.00, 1, 1, 44, '2016-09-07 09:25:33'),
(3, 21, 21, '2012-06-06', '2016-09-07 13:06:11', 650.00, 1, 1, 44, '2016-09-07 11:06:11'),
(4, 31, 31, '2012-06-06', '2016-09-07 13:06:56', 980.00, 1, 1, 44, '2016-09-07 11:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `payment_sweep_queue`
--

CREATE TABLE IF NOT EXISTS `payment_sweep_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ec_id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `vat_amount` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  `bankcode` int(11) NOT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `payment_sweep_queue`
--

INSERT INTO `payment_sweep_queue` (`id`, `ec_id`, `orderid`, `vat_amount`, `sales_date`, `bankcode`, `adddate`) VALUES
(21, 15, 1, 100, '2012-06-06', 44, '2016-09-04 09:18:54'),
(22, 15, 2, 150, '2012-06-06', 44, '2016-09-04 09:18:54'),
(23, 15, 3, 160, '2012-06-06', 44, '2016-09-04 09:18:54'),
(24, 15, 5, 200, '2012-06-06', 44, '2016-09-04 09:18:54'),
(25, 15, 6, 130, '2012-06-06', 44, '2016-09-04 09:18:54'),
(26, 15, 7, 550, '2012-06-06', 44, '2016-09-04 09:18:54'),
(27, 15, 10, 1000, '2012-06-06', 44, '2016-09-04 09:18:54'),
(28, 15, 12, 1002, '2012-06-06', 44, '2016-09-04 09:18:54'),
(29, 15, 13, 1030, '2012-06-06', 44, '2016-09-04 09:18:54'),
(30, 15, 14, 1020, '2012-06-06', 44, '2016-09-04 09:18:54'),
(31, 15, 15, 3000, '2012-06-06', 44, '2016-09-04 09:18:54'),
(32, 15, 16, 1560, '2012-06-06', 44, '2016-09-04 09:18:54'),
(33, 15, 17, 1980, '2012-06-06', 44, '2016-09-04 09:18:54'),
(34, 15, 18, 2800, '2012-06-06', 44, '2016-09-04 09:18:54'),
(39, 15, 51, 10088, '2012-06-06', 44, '2016-09-04 09:18:54'),
(40, 15, 61, 10650, '2012-06-06', 44, '2016-09-04 09:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_vat_details`
--

CREATE TABLE IF NOT EXISTS `payment_vat_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nibsid` int(11) NOT NULL,
  `ec_id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `vat_amount` int(11) NOT NULL,
  `sales_date` int(11) NOT NULL,
  `bankcode` int(11) NOT NULL,
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `payment_vat_details`
--

INSERT INTO `payment_vat_details` (`id`, `nibsid`, `ec_id`, `orderid`, `vat_amount`, `sales_date`, `bankcode`, `adddate`) VALUES
(1, 0, 15, 1, 100, 2012, 44, '2016-09-08 08:33:03'),
(2, 0, 15, 2, 150, 2012, 44, '2016-09-08 08:33:03'),
(3, 0, 15, 3, 160, 2012, 44, '2016-09-08 08:33:03'),
(4, 0, 15, 5, 200, 2012, 44, '2016-09-08 08:33:03'),
(5, 0, 15, 6, 130, 2012, 44, '2016-09-08 08:33:03'),
(6, 0, 15, 7, 550, 2012, 44, '2016-09-08 08:33:03'),
(7, 0, 15, 10, 1000, 2012, 44, '2016-09-08 08:33:03'),
(8, 0, 15, 12, 1002, 2012, 44, '2016-09-08 08:33:03'),
(9, 0, 15, 13, 1030, 2012, 44, '2016-09-08 08:33:03'),
(10, 0, 15, 14, 1020, 2012, 44, '2016-09-08 08:33:03'),
(11, 0, 15, 15, 3000, 2012, 44, '2016-09-08 08:33:03'),
(12, 0, 15, 16, 1560, 2012, 44, '2016-09-08 08:33:03'),
(13, 0, 15, 17, 1980, 2012, 44, '2016-09-08 08:33:03'),
(14, 0, 15, 18, 2800, 2012, 44, '2016-09-08 08:33:03'),
(15, 0, 15, 51, 10088, 2012, 44, '2016-09-08 08:33:03'),
(16, 0, 15, 61, 10650, 2012, 44, '2016-09-08 08:33:03'),
(17, 2, 15, 1, 100, 2012, 44, '2016-09-08 08:34:06'),
(18, 2, 15, 2, 150, 2012, 44, '2016-09-08 08:34:06'),
(19, 2, 15, 3, 160, 2012, 44, '2016-09-08 08:34:06'),
(20, 2, 15, 5, 200, 2012, 44, '2016-09-08 08:34:06'),
(21, 2, 15, 6, 130, 2012, 44, '2016-09-08 08:34:06'),
(22, 2, 15, 7, 550, 2012, 44, '2016-09-08 08:34:06'),
(23, 2, 15, 10, 1000, 2012, 44, '2016-09-08 08:34:06'),
(24, 2, 15, 12, 1002, 2012, 44, '2016-09-08 08:34:06'),
(25, 2, 15, 13, 1030, 2012, 44, '2016-09-08 08:34:06'),
(26, 2, 15, 14, 1020, 2012, 44, '2016-09-08 08:34:06'),
(27, 2, 15, 15, 3000, 2012, 44, '2016-09-08 08:34:06'),
(28, 2, 15, 16, 1560, 2012, 44, '2016-09-08 08:34:06'),
(29, 2, 15, 17, 1980, 2012, 44, '2016-09-08 08:34:06'),
(30, 2, 15, 18, 2800, 2012, 44, '2016-09-08 08:34:06'),
(31, 2, 15, 51, 10088, 2012, 44, '2016-09-08 08:34:06'),
(32, 2, 15, 61, 10650, 2012, 44, '2016-09-08 08:34:06'),
(33, 3, 13, 1, 100, 2012, 44, '2016-09-08 08:43:05'),
(34, 3, 13, 2, 100, 2012, 44, '2016-09-08 08:43:05'),
(35, 3, 13, 3, 100, 2012, 44, '2016-09-08 08:43:05'),
(36, 3, 13, 5, 100, 2012, 44, '2016-09-08 08:43:05'),
(37, 3, 13, 6, 100, 2012, 44, '2016-09-08 08:43:05'),
(38, 3, 13, 7, 100, 2012, 44, '2016-09-08 08:43:05'),
(39, 3, 13, 10, 100, 2012, 44, '2016-09-08 08:43:05'),
(40, 3, 13, 12, 100, 2012, 44, '2016-09-08 08:43:05'),
(41, 3, 13, 13, 100, 2012, 44, '2016-09-08 08:43:05'),
(42, 3, 13, 14, 100, 2012, 44, '2016-09-08 08:43:05'),
(43, 3, 13, 15, 100, 2012, 44, '2016-09-08 08:43:05'),
(44, 3, 13, 16, 100, 2012, 44, '2016-09-08 08:43:05'),
(45, 3, 13, 17, 100, 2012, 44, '2016-09-08 08:43:05'),
(46, 3, 13, 18, 100, 2012, 44, '2016-09-08 08:43:05'),
(47, 3, 13, 19, 100, 2012, 44, '2016-09-08 08:43:05'),
(48, 3, 13, 21, 100, 2012, 44, '2016-09-08 08:43:05'),
(49, 3, 13, 31, 100, 2012, 44, '2016-09-08 08:43:05'),
(50, 3, 13, 41, 100, 2012, 44, '2016-09-08 08:43:05'),
(51, 3, 13, 51, 100, 2012, 44, '2016-09-08 08:43:05'),
(52, 3, 13, 61, 100, 2012, 44, '2016-09-08 08:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `resolving_date` datetime NOT NULL,
  `issue_title` text NOT NULL,
  `issue_detail` text NOT NULL,
  `resolved_by` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `biller_id`, `creation_date`, `resolving_date`, `issue_title`, `issue_detail`, `resolved_by`, `status`) VALUES
(1, 1, 'pallavi', 'gupta', 'pallavi.24oct@gmail.com', '123456789', 1, '2016-05-27 11:16:01', '0000-00-00 00:00:00', 'Site problem', 'sddsdas', 0, 'Pending'),
(2, 1, 'Ravi', 'Prakash', 'tenfoldweb@gmail.com', '8799665543', 3, '2016-05-27 11:23:08', '0000-00-00 00:00:00', 'issue', 'dsfede ertertert										', 0, 'Pending'),
(3, 1, 'Aadhavi', 'Aady', 'aady@gmail.com', '1234567890', 1, '2016-05-27 13:06:44', '0000-00-00 00:00:00', 'Website', 'sads dsfs fsfds gdsg dfgdf gdfgdf gd										', 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-yes, 0-no',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `profile_img` varchar(255) NOT NULL,
  `companyname` varchar(255) DEFAULT NULL,
  `clientbusiness` varchar(255) DEFAULT NULL,
  `pbcontact` varchar(255) DEFAULT NULL,
  `amanager` varchar(255) DEFAULT NULL,
  `amemail` varchar(255) DEFAULT NULL,
  `creatorId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `gender`, `mobile`, `added_date`, `user_group_id`, `status`, `last_login`, `profile_img`, `companyname`, `clientbusiness`, `pbcontact`, `amanager`, `amemail`, `creatorId`) VALUES
(1, 'Pallavi', 'Prakash', 'pallavi', 'tenfoldweb1@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'F', '8060433966', '2016-08-26 07:15:43', 1, 1, '2016-06-30 07:08:42', '57bfec9f9545cIMG_20160617_111313_HDR.jpg', NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Ravi', 'Prakash', 'ravi', 'tenfoldweb@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'M', '9013141512', '2016-09-11 07:07:45', 1, 1, '2016-09-11 01:37:45', '57b94d7640aaeIMG_20160616_163046_HDR.jpg', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Pallavi', 'Gupta', 'pallo', 'pallavi.24oct@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '1234567', '2016-04-18 18:57:34', 2, 1, '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, 0),
(5, 'OLUFELA', 'SOYEMI', 'wale', 'fela_soyemi@yahoo.co.uk', '55c3b5386c486feb662a0785f340938f518d547f', '', '6477674095', '2016-07-21 03:43:55', 3, 1, '2016-07-21 03:43:55', '', NULL, NULL, NULL, NULL, NULL, 0),
(6, 'Ravi', 'Prakash', 'prakash', 'er.prakash.ravi@gmail.com', 'bee441e0a82276a13aa1d35e42c363e7cae1f389', '', '8799665543', '2016-06-27 08:19:22', 2, 1, '2016-06-27 08:19:22', '', NULL, NULL, NULL, NULL, NULL, 0),
(11, 'Ayodele', 'Adeluka', 'ayheimer', 'ayo@ercasng.com', '55c3b5386c486feb662a0785f340938f518d547f', '', '8183992232', '2016-06-27 03:23:34', 2, 1, '2016-06-27 03:23:34', '', NULL, NULL, NULL, NULL, NULL, 0),
(12, 'tenfoldweb', 'ravi@egeniustech.com', '10470c3b4b1fed12', 'Ravi', '22234234234', '', '0', '2016-08-23 12:08:17', 0, 1, '0000-00-00 00:00:00', '', '0', '0', '0', '0', '0', 2),
(13, 'Ravi', 'Prakash', 'raviraj', 'ravi@raviraj.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '9013141512', '2016-08-26 08:42:21', 3, 1, '2016-08-26 05:10:43', '', 'client compay name', 'line of client business', 'tenfoldweb@gmail.com', 'Mr. Gabbar', 'account manager email', 2),
(15, 'Test', 'company', 'testcompany', 'test@test.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '9898989898', '2016-09-04 03:59:14', 3, 1, '0000-00-00 00:00:00', '', 'Test Company', 'line of client business', 'test manager', 'Text Account manager', 'test@acmanager.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_group`, `status`) VALUES
(1, 'Super Admin', 1),
(2, 'Admin', 1),
(3, 'Client', 1),
(4, 'Approver', 1),
(5, 'General', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions_setting`
--

CREATE TABLE IF NOT EXISTS `user_group_permissions_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `user_permissions` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `user_group_permissions_setting`
--

INSERT INTO `user_group_permissions_setting` (`id`, `user_group_id`, `user_permissions`, `date_added`) VALUES
(70, 4, 'profile_management', '2016-06-25 13:01:45'),
(71, 4, 'reports', '2016-06-25 13:01:45'),
(72, 5, 'profile_management', '2016-06-25 13:02:05'),
(73, 5, 'reports', '2016-06-25 13:02:05'),
(78, 2, 'biller/listing', '2016-06-27 03:25:04'),
(79, 2, 'biller/add_biller', '2016-06-27 03:25:04'),
(80, 2, 'biller/edit_biller', '2016-06-27 03:25:04'),
(81, 2, 'biller', '2016-06-27 03:25:04'),
(82, 2, 'biller/pending_biller', '2016-06-27 03:25:04'),
(83, 2, 'biller/approved_biller', '2016-06-27 03:25:04'),
(84, 2, 'biller/declined_biller', '2016-06-27 03:25:04'),
(85, 2, 'biller_administration', '2016-06-27 03:25:04'),
(86, 2, 'tickets', '2016-06-27 03:25:04'),
(87, 2, 'reports', '2016-06-27 03:25:04'),
(88, 2, 'users', '2016-06-27 03:25:04'),
(89, 2, 'profile_management', '2016-06-27 03:25:04'),
(90, 2, 'general_setting', '2016-06-27 03:25:04'),
(91, 3, 'biller/listing', '2016-07-19 14:09:06'),
(92, 3, 'biller/add_biller', '2016-07-19 14:09:06'),
(93, 3, 'biller/pending_biller', '2016-07-19 14:09:06'),
(94, 3, 'biller/declined_biller', '2016-07-19 14:09:06'),
(95, 3, 'tickets', '2016-07-19 14:09:06'),
(96, 3, 'reports', '2016-07-19 14:09:06'),
(97, 3, 'profile_management', '2016-07-19 14:09:06'),
(98, 1, 'biller/listing', '2016-07-19 14:15:41'),
(99, 1, 'biller/add_biller', '2016-07-19 14:15:41'),
(100, 1, 'biller/edit_biller', '2016-07-19 14:15:41'),
(101, 1, 'biller', '2016-07-19 14:15:41'),
(102, 1, 'biller/pending_biller', '2016-07-19 14:15:41'),
(103, 1, 'biller/approved_biller', '2016-07-19 14:15:41'),
(104, 1, 'biller/declined_biller', '2016-07-19 14:15:41'),
(105, 1, 'biller_administration', '2016-07-19 14:15:41'),
(106, 1, 'tickets', '2016-07-19 14:15:41'),
(107, 1, 'ercas_message', '2016-07-19 14:15:41'),
(108, 1, 'reports', '2016-07-19 14:15:41'),
(109, 1, 'usergroup_privileges', '2016-07-19 14:15:41'),
(110, 1, 'registration', '2016-07-19 14:15:41'),
(111, 1, 'users', '2016-07-19 14:15:41'),
(112, 1, 'profile_management', '2016-07-19 14:15:41'),
(113, 1, 'general_setting', '2016-07-19 14:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `token_id` varchar(255) NOT NULL,
  `vat_execution_period` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1 for daily, 2 for weekly, 3 for monthly',
  `vat_execution_mode` int(1) NOT NULL DEFAULT '1' COMMENT '1 for auto, 2 for manual',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `api_key`, `token_id`, `vat_execution_period`, `vat_execution_mode`) VALUES
(1, 13, 'ser45dsfgbnmbdddfggd', 'wedfswef456iiou0987ddmnhbgfds', 3, 1),
(2, 15, '7f726f3c3199a14f68c0df96ecd0d06b', '7bdd3b8862b37c0875f7ac261bac9cc8ace10dce', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vat_nibss_transaction`
--

CREATE TABLE IF NOT EXISTS `vat_nibss_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ec_id` int(11) NOT NULL,
  `no_of_transaction` int(11) NOT NULL,
  `amount` double(14,2) NOT NULL,
  `bankcode` int(11) NOT NULL,
  `sweep_date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 for completed, 2 for pending, 3 for failed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vat_nibss_transaction`
--

INSERT INTO `vat_nibss_transaction` (`id`, `ec_id`, `no_of_transaction`, `amount`, `bankcode`, `sweep_date`, `status`) VALUES
(1, 15, 16, 35420.00, 44, '2016-09-08', 2),
(2, 15, 16, 35420.00, 44, '2016-09-08', 2),
(3, 13, 20, 2000.00, 44, '2016-09-08', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
