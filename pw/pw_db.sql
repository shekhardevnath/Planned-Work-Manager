-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 30, 2011 at 10:06 AM
-- Server version: 5.0.15
-- PHP Version: 5.0.5
-- 
-- Database: `nm_tx`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `pw_notice_tbl`
-- 

CREATE TABLE `pw_notice_tbl` (
  `notice_id` bigint(20) NOT NULL auto_increment,
  `notice_execution_date` date NOT NULL,
  `notice_sms` text NOT NULL,
  `notice_smsto` varchar(512) NOT NULL,
  PRIMARY KEY  (`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `pw_notice_tbl`
-- 

INSERT INTO `pw_notice_tbl` VALUES (1, '2011-11-30', 'Notice:\r\nST:39:00\r\nET:343:223\r\nTest', '');
INSERT INTO `pw_notice_tbl` VALUES (2, '2011-11-30', 'Notice:\r\nST:39:00\r\nET:343:223\r\nTest', '');
INSERT INTO `pw_notice_tbl` VALUES (3, '2011-11-30', 'dlkfjs\r\nsdfkjsdj;fs\r\nadfjkadsf\r\nadsfjadsfd', '');
INSERT INTO `pw_notice_tbl` VALUES (4, '2011-11-30', '', '');
INSERT INTO `pw_notice_tbl` VALUES (5, '2011-11-30', 'sdfsdsdf\r\nsadf\r\nsdfds\r\nfsdf\r\nsdaf\r\nsadf\r\nsadf\r\ndsfsaf\r\nff', '');
INSERT INTO `pw_notice_tbl` VALUES (6, '2011-11-30', 'dfdsfsdf', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `pw_tbl`
-- 

CREATE TABLE `pw_tbl` (
  `pw_id` bigint(20) NOT NULL auto_increment,
  `pw_execution_date` date NOT NULL,
  `outage_flag` varchar(16) NOT NULL,
  `pw_name` varchar(512) NOT NULL,
  `pw_impact` varchar(1024) NOT NULL,
  `pw_st` datetime NOT NULL,
  `pw_et` datetime NOT NULL,
  `pw_sms` text NOT NULL,
  `pw_smsto` varchar(512) NOT NULL,
  `group_name` varchar(32) NOT NULL,
  PRIMARY KEY  (`pw_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `pw_tbl`
-- 

INSERT INTO `pw_tbl` VALUES (1, '2011-11-30', 'No', 'Revert back Validity Period change in SMSC and others.', 'SMSC will be down for maximum 10 minutes. All kinds of SMS including ERS will be down for maximum 10 minutes tested.', '2011-11-09 02:05:00', '2011-11-09 06:20:00', 'PW#1\r\nRevert back Validity Period change in SMSC and others.\r\nImpact: SMSC will be down for maximum 10 minutes. All kinds of SMS including ERS will be down for maximum 10 minutes tested.\r\nST: 02:05\r\nET: 06:20', 'CMD CORE MANAGEMENT & REGIONAL HEADS;BB_IT;CD-MT;A. F. M. Mostashim Billah||01711080693;BRTS O&M;TOMC;ETOMC', 'Service');
INSERT INTO `pw_tbl` VALUES (2, '2011-11-30', 'Yes', 'Reroute', 'each pcm will get down for approximately 10 minutes.', '2011-11-09 13:14:00', '2011-11-09 17:18:00', 'PW#2\r\nReroute\r\nImpact: each pcm will get down for approximately 10 minutes.\r\nST: 13:14\r\nET: 17:18', 'A. B. M. Naimul Huq||01711505082;A. B. M. Arifur Rahman||01711506719;A. B. M. Shamsul Alam||01711081445', 'Transport');
INSERT INTO `pw_tbl` VALUES (3, '2011-11-30', 'No', 'Test & Test', 'Test', '2011-11-29 03:05:00', '2011-11-29 04:50:00', 'PW#3\r\nTest & Test\r\nImpact: Test\r\nST: 03:05\r\nET: 04:50', 'TOMC;Combined(SOC_TRMC_NQP_ETOMC)', 'Radio');
INSERT INTO `pw_tbl` VALUES (4, '2011-11-30', 'Yes', 'ODU change and link parameter change.', 'Mentioned sites will be down for 20 mins during execution time.', '2011-11-29 13:00:00', '2011-11-29 17:00:00', 'PW#4\r\nODU change and link parameter change.\r\nImpact: Mentioned sites will be down for 20 mins during execution time.\r\n(Contd...)\r\n\r\nPW#4(Contd..)\r\nThere will be other impact as well tested.\r\nImpact: Mentioned sites will be down for 20 mins during execution time.\r\nST: 13:00\r\nET: 17:00', 'TOMC;ETOMC;Combined(SOC_TRMC_NQP_ETOMC)', 'Transport');
INSERT INTO `pw_tbl` VALUES (5, '2011-11-30', '', 'AIR NEI patch Installation sdffsdf', 'Following provisioning requests will be queued up during the maintenance window and will be served afterward.EDGE,MCA,Call Block,PRBT,FnF,Subscriber Profile Change,SIM Activation,SIM reconnection,SIM Disconnection,All sort of Postpaid Provisioning.', '2011-12-01 01:36:00', '2011-12-01 03:45:00', 'PW#5\r\nAIR NEI patch Installation sdffsdf\r\nImpact: Following provisioning requests will be queued up during the maintenance window and will be served afterward.EDGE,MCA,Call Block,PRBT,FnF,Subscriber Profile Change,SIM Activation,SIM reconnection,SIM Disconnection,All sort of Postpaid Provisioning.\r\nST: 01:36\r\nET: 03:45', 'A. B. M. Momenur Rahman||01711507289;A. F. M. Mohebbullah||01711506901;A. B. M. Shamsul Alam||01711081445;A. F. M. Rubayat-Ul- Jannat||01711082439', '');
