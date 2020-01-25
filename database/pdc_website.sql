-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 04:23 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdc_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_phone` varchar(15) NOT NULL,
  `admin_email` varchar(20) NOT NULL,
  `admin_password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_phone`, `admin_email`, `admin_password`) VALUES
(101, 'Md Kamran Ahmad', '01717929270', 'j.kamran14@gmail.com', '12345'),
(102, 'Abdullah Al Mamun', '01717929277', 'mamun@gmail.com', '1234'),
(103, 'Khaled Ahmed', '01755886952', 'khaled@gmail.com', '12345'),
(104, 'Tahmid Ahmed', '01788563242', 'tahmid@gmail.com', '1234'),
(105, 'Fouad Hasan Nobin', '01758255447', 'nobin@gmail.com', '12345'),
(106, 'Hahdi Hasan Fagun', '01712639584', 'fagunmahdi@gmail.com', 'fagun1234'),
(107, 'Abdul Aziz', '01788548754', 'azizipe@gmail.com', 'azizipe'),
(108, 'Rahath Mahmud', '01856954520', 'mahmud@gmail.com', 'madmud55');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` int(10) NOT NULL,
  `father_name` varchar(20) NOT NULL,
  `mother_name` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `nationality` varchar(15) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` varchar(35) NOT NULL,
  `city` varchar(10) NOT NULL,
  `phase` varchar(25) NOT NULL,
  `connection_type` varchar(20) NOT NULL,
  `tariff_category` varchar(20) NOT NULL,
  `demand_meter` varchar(20) NOT NULL,
  `relegion` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ap_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `father_name`, `mother_name`, `mobile`, `nationality`, `nid`, `gender`, `email`, `address`, `city`, `phase`, `connection_type`, `tariff_category`, `demand_meter`, `relegion`, `date_of_birth`, `status`, `ap_type`) VALUES
(32, 'Ahmed Ali', 'Jamila Khatun', '01717896545', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2007-02-12', 2, 'residential'),
(33, 'Jamal Ahmed', 'Jamila Begum', ' 01717896586', 'Bangadeshi', '12536458', 'Male', 'kamal@gmail.com', 'Companigonj', 'Sylhet', 'Single', 'Temporary', '1526', '2545', 'Islam', '2005-12-25', 2, 'residential'),
(34, 'Ahmed Ali', 'Jomila Akter', '01717896523', 'Bangadeshi', '12536454', 'Male', 'hadi@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1527', '2511', 'Islam', '1998-02-25', 2, 'residential'),
(35, 'Jamal Ahmed', 'Jamila Begum', ' 01717896586', 'Bangadeshi', '12536458', 'Male', 'fiza@gmail.com', 'Companigonj', 'Sylhet', 'Three', 'Temporary', '15262', '2565', 'Islam', '2013-12-22', 2, 'commercial'),
(36, 'Jamal Ahmed', 'Jamila Begum', '01717896586', 'Bangadeshi', '125364888', 'Male', 'hadi@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1527', '2511', 'Islam', '2008-02-05', 2, 'residential'),
(37, 'Ahmed Ali', 'Jamila Khatun', '01717896545', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Kamal Bazar', 'Sylhet', 'Single', 'Permanent', '1526', '2511', 'Islam', '2000-02-22', 1, 'residential'),
(39, 'Ahmed Ali', 'Jamila Khatun', '01717896523', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1527', '2545', 'Islam', '2001-12-02', 1, 'residential'),
(40, 'Ahmed Ali', 'Jamila Begum', '01717896545', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2000-02-12', 1, 'residential'),
(41, 'Ahmed Ali', 'Jamila Begum', '01717896545', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2000-02-12', 1, 'residential'),
(42, 'Ahmed Ali', 'Jamila Begum', '01717896545', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2000-02-12', 1, 'residential'),
(44, 'Ahmed Ali', 'Jamila Begum', '01717896545', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2000-02-12', 1, 'residential'),
(46, 'Ahmed Ali', 'Jomila Akter', '01717896545', 'Bangadeshi', '12536458', 'Male', 'ngoalscorer@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2511', 'Islam', '2000-02-02', 1, 'residential'),
(47, 'Ahmed Ali', 'Jamila Khatun', '01717896545', 'Bangadeshi', '12536458', 'Male', 'ngoalscorer@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2020-02-02', 1, 'residential'),
(51, 'Jamal Ahmed', 'Jamila Begum', ' 01717896586', 'Bangadeshi', '12536458', 'Male', 'jamal@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2220-12-25', 2, 'residential'),
(52, 'Jamal Ahmed', 'Jamila Begum', '  01717896545', 'Bangadeshi', '12536458', 'Male', 'abdullah@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '8202-12-05', 2, 'residential'),
(55, 'Nobin Ahmed', 'Jamila Begum', '01717896545', 'Bangadeshi', '12536458', 'Male', 'abdullah.neub@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '5252-12-05', 2, 'residential'),
(56, 'Jamal Ahmed', 'Jamila Begum', '01717896586', 'Bangadeshi', '12536458', 'Male', 'abdullah.neub@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '1526', '2545', 'Islam', '2000-12-22', 1, 'residential'),
(57, 'Jamal Ahmed', 'Jamila Khatun', ' 01717896545', 'Bangadeshi', '12536458', 'Male', 'abdullah.neub@gmail.com', 'Lamabazar,Sylhet', 'Sylhet', 'Single', 'Permanent', '15262', '2545', 'Islam', '2000-12-05', 2, 'commercial'),
(58, 'Nobin Ahmed', 'Jomila Akter', '01717896545', 'Bangadeshi', '12536454', 'Male', 'ngoalscorer@gmail.com', 'Kamal Bazar', 'Sylhet', 'Three', 'Permanent', '1527', '2511', 'Islam', '2000-12-05', 1, 'commercial');

-- --------------------------------------------------------

--
-- Table structure for table `bill_info`
--

CREATE TABLE `bill_info` (
  `bill_no` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `customer_no` int(11) NOT NULL,
  `bill_month` varchar(15) NOT NULL,
  `bill_issue_date` date NOT NULL,
  `bill_last_pay_date` date NOT NULL,
  `bill_due_pay_date` date NOT NULL,
  `present_unit` int(11) NOT NULL,
  `previous_unit` int(11) NOT NULL,
  `bill_status` int(11) NOT NULL DEFAULT 1,
  `total_amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_info`
--

INSERT INTO `bill_info` (`bill_no`, `admin_id`, `customer_no`, `bill_month`, `bill_issue_date`, `bill_last_pay_date`, `bill_due_pay_date`, `present_unit`, `previous_unit`, `bill_status`, `total_amount`) VALUES
(34, 103, 5763002, 'January', '2020-01-18', '2020-02-02', '2020-02-07', 500, 355, 3, 549),
(35, 103, 3868278, ' January', '2020-01-18', '2020-02-02', '2020-02-07', 1240, 925, 1, 1518),
(37, 103, 5763002, '  February', '2020-01-18', '2020-02-03', '2020-02-08', 558, 500, 3, 207),
(38, 103, 5763002, '    March', '2020-01-18', '2020-02-03', '2020-02-08', 620, 550, 3, 255),
(39, 103, 5763002, '  April', '2020-01-18', '2020-02-03', '2020-02-08', 825, 610, 1, 868),
(40, 101, 7477157, 'January', '2020-01-19', '2020-02-03', '2020-02-08', 500, 152, 3, 1732),
(42, 101, 7477157, 'February', '2020-01-20', '2020-02-04', '2020-02-09', 752, 500, 3, 1108),
(43, 101, 7477157, '  March', '2020-01-20', '2020-02-04', '2020-02-09', 950, 750, 3, 835),
(44, 101, 7477157, 'April', '2020-01-20', '2020-02-04', '2020-02-09', 1522, 940, 1, 3253),
(48, 101, 1934792, 'January', '2020-01-21', '2020-02-05', '2020-02-10', 250, 10, 3, 1030),
(49, 101, 1934792, ' February', '2020-01-21', '2020-02-05', '2020-02-10', 466, 240, 3, 939),
(50, 101, 1934792, 'March', '2020-01-21', '2020-02-05', '2020-02-10', 755, 466, 2, 1349),
(51, 101, 4864744, ' January', '2020-01-21', '2020-02-05', '2020-02-10', 500, 10, 3, 2655),
(52, 101, 4864744, 'February', '2020-01-21', '2020-02-05', '2020-02-10', 825, 490, 3, 1648),
(53, 101, 4864744, 'March', '2020-01-21', '2020-02-05', '2020-02-10', 1152, 825, 3, 1596),
(54, 101, 1934792, 'April', '2020-01-21', '2020-02-05', '2020-02-10', 1500, 755, 1, 4313),
(55, 101, 4864744, 'April', '2020-01-21', '2020-02-05', '2020-02-10', 1566, 1025, 2, 2987),
(56, 101, 3715072, 'January', '2020-01-22', '2020-02-06', '2020-02-11', 150, 5, 1, 549),
(57, 101, 6533652, 'January', '2020-01-22', '2020-02-06', '2020-02-11', 253, 25, 1, 952),
(58, 101, 4864744, 'May', '2020-01-22', '2020-02-06', '2020-02-11', 1825, 1566, 1, 1154),
(59, 101, 4864744, 'Jun', '2020-01-22', '2020-02-06', '2020-02-11', 1825, 1566, 1, 1154),
(60, 101, 7141160, ' January', '2020-01-22', '2020-02-06', '2020-02-11', 100, 3, 1, 363),
(61, 101, 7477157, ' May', '2020-01-22', '2020-02-06', '2020-02-11', 1655, 1522, 1, 487);

-- --------------------------------------------------------

--
-- Table structure for table `commercial`
--

CREATE TABLE `commercial` (
  `application_id` int(10) NOT NULL,
  `organizatio_name` varchar(20) NOT NULL,
  `proprietor_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commercial`
--

INSERT INTO `commercial` (`application_id`, `organizatio_name`, `proprietor_name`) VALUES
(35, ' Fiza', ' Ali Bokor'),
(57, ' Modubon', ' Ali Akbor'),
(58, 'Ahmed IT', 'Jamal');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complain_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `complain_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `complain_type` varchar(10) NOT NULL,
  `complain` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_id`, `name`, `email`, `phone`, `complain_date`, `complain_type`, `complain`, `status`) VALUES
(2, 'Nobin', 'nobin@gmail.com', '0175215499', '2020-01-18 23:04:24', 'Billing', 'This round will be rated for the participants with rating lower than 2100. It will be held on extended ICPC rules. The penalty for each incorrect submission until the submission with a full solution is 10 minutes. After the end of the contest you will hav', 1),
(3, 'Hasan Mahmud', 'hasan@gmail.com', '0178569784', '2020-01-22 01:39:50', 'Billing', 'The Network troubleshooter can help diagnose and fix common connection problems. Using this troubleshooter, then running some networking commands afterwards if needed, can help get you connected.', 101),
(4, 'Md Kamran Ahmad', 'j.kamran14@gmail.com', '0171792927', '2020-01-18 23:47:23', 'Bill Unit', 'In 2019, with the support of XTX Markets, 6 rounds of the new Codeforces Global Rounds were held. Each round was common for both divisions and had 7–9 problems. The duration of the rounds was 2-3 hours, depending on the number and complexity of the proble', 103),
(6, 'Hasn Mahmud', 'jamil@gmail.com', '0171792926', '2020-01-18 23:46:34', 'Bill Unit', 'Since the problems are based on the ICPC Manila regionals, we request all the coaches onsite to refrain from making the problem set public. We also request the coaches and everyone else who has seen the problems (or part of it) to refrain from joining thi', 101),
(9, 'Basirul Islam', 'basirul@gmail.com', '0175215441', '2020-01-19 17:01:11', 'Connection', 'You can update your billing information or add a payment method in Settings on your iPhone, iPad, or iPod touch, or in iTunes on your Mac or PC. ', 101),
(10, 'Ahmed Al Hadi', 'hadi@gmail.com', '0178563252', '2020-01-20 11:53:18', 'Meter Prob', 'The record of devesh here is to be deleted. here first we create connection with the database,then database is selected using mysql_select_db(), then delete query is passed to the mysql_query and the table row is deleted.', 1),
(30, 'Ahmed Al Hadi', 'abdullah.neub@gmail.', '0178563252', '2020-01-21 22:00:57', 'Meter Prob', 'Now you know how to get last insert id value using an inbuilt method. But you need to call it immediately after the insert query because it works according to the last query.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `name`, `email`, `phone`, `message`, `date`) VALUES
(3, 'Hasn Mahmud', 'aziz@gmail.com', '0171792926', 'hello', '2020-01-20 11:43:06'),
(5, 'Kamal Ahmed', 'kamal@gmail.com', '01785632521', 'Hi', '2020-01-20 15:12:31'),
(6, 'Jamal Ahmed', 'jamal@gmail.com', '01785632526', 'Hi,Admin', '2020-01-20 15:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_no` int(11) NOT NULL,
  `customer_meter_no` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `pin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_no`, `customer_meter_no`, `application_id`, `pin`) VALUES
(1934792, 100009, 55, 68831),
(3715072, 100005, 51, 83889),
(3868278, 100002, 33, 84057),
(4864744, 200002, 57, 86221),
(5763002, 100001, 34, 76697),
(6533652, 100008, 52, 99787),
(7141160, 100003, 32, 24687),
(7477157, 200001, 35, 85722),
(8750905, 100004, 36, 84392);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `notice_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notice_type` varchar(30) NOT NULL,
  `notice_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `admin_id`, `notice_date`, `notice_type`, `notice_file`) VALUES
(4, 101, '2019-12-13 20:16:52', 'notice', 'conceptualdatamodeling.pdf'),
(5, 101, '2019-12-13 20:33:15', 'annual_reports', 'erddatabasemodeling.pdf'),
(12, 101, '2020-01-20 10:38:06', 'notice', 'urgent_notice_17.pdf'),
(13, 101, '2020-01-20 10:38:21', 'notice', 'general_notice.pdf'),
(14, 101, '2020-01-20 10:39:06', 'annual_reports', 'Revised APP 2017-18 - Passed in 241st Board Signed-min.compressed.pdf'),
(18, 101, '2020-01-20 10:41:11', 'executive_summary', 'SE_Duty_Roster,June-2019.pdf'),
(19, 101, '2020-01-20 10:41:27', 'executive_summary', 'tender_25042019_382.pdf'),
(20, 101, '2020-01-20 10:42:47', 'executive_summary', 'tender.pdf'),
(21, 101, '2020-01-20 10:43:05', 'annual_procurement_plan', 'electrical_wiring_inspector.pdf'),
(22, 101, '2020-01-20 10:43:32', 'annual_procurement_plan', 'SE_Duty_Roster,June-2019.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(20) NOT NULL,
  `customer_no` int(20) NOT NULL,
  `bill_no` int(20) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bk_n` int(11) NOT NULL,
  `bk_trx_id` varchar(30) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_no`, `bill_no`, `payment_date`, `bk_n`, `bk_trx_id`, `payment_status`) VALUES
(5, 5763002, 34, '2020-01-19 23:22:52', 1717856955, 'hj475hR', 2),
(6, 5763002, 37, '2020-01-20 00:22:35', 1717856958, 'G7uunfTTy7', 2),
(7, 5763002, 38, '2020-01-21 23:48:34', 1717856955, 'G7Ht7nfTy7', 2),
(8, 7477157, 40, '2020-01-20 10:13:21', 1758632541, 'TRH78YhnM', 2),
(9, 7477157, 42, '2020-01-20 15:08:08', 1758632541, 'TRY78YhHK', 2),
(10, 7477157, 43, '2020-01-22 00:14:01', 1717856955, 'TRH78YhnM', 2),
(11, 1934792, 48, '2020-01-22 00:23:32', 1717856955, 'TRY568YhHK', 2),
(12, 1934792, 49, '2020-01-22 01:39:08', 1717856958, 'G7Ht7TTTy7', 2),
(13, 4864744, 51, '2020-01-22 00:35:06', 1717856958, 'TRH78YKI66', 2),
(14, 4864744, 52, '2020-01-22 01:36:20', 1717856955, 'G7Ht7nfYYYR', 2),
(15, 4864744, 53, '2020-01-22 09:03:24', 1717856958, 'TRY78YhHH', 2),
(16, 1934792, 50, '2020-01-22 01:38:53', 1717856955, 'TRY78YhFF', 1),
(17, 4864744, 55, '2020-01-22 09:02:13', 1717856958, 'TRY78YhPP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `residential`
--

CREATE TABLE `residential` (
  `application_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residential`
--

INSERT INTO `residential` (`application_id`, `name`) VALUES
(32, 'Jamal Ahmed'),
(33, ' Kamal Ahmed'),
(34, 'Ahmed Al Hadi'),
(36, 'Kamal Ahmed'),
(37, 'Jamal Ahmed'),
(39, 'Kamal Ahmed'),
(40, 'Kamal Ahmed'),
(41, 'Kamal Ahmed'),
(42, 'Kamal Ahmed'),
(44, 'Kamal Ahmed'),
(46, 'Ahmed Al Hadi'),
(47, 'Jamal Ahmed'),
(51, 'Jamal Khan'),
(52, '  Abdullah Al Mamun'),
(55, 'Ahmed Ali'),
(56, 'Kamal Ahmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `bill_info`
--
ALTER TABLE `bill_info`
  ADD PRIMARY KEY (`bill_no`) USING BTREE,
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `customer_no` (`customer_no`);

--
-- Indexes for table `commercial`
--
ALTER TABLE `commercial`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complain_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_no`),
  ADD UNIQUE KEY `customer_no` (`customer_no`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_no` (`customer_no`),
  ADD KEY `bill_no` (`bill_no`);

--
-- Indexes for table `residential`
--
ALTER TABLE `residential`
  ADD PRIMARY KEY (`application_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `bill_info`
--
ALTER TABLE `bill_info`
  MODIFY `bill_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_info`
--
ALTER TABLE `bill_info`
  ADD CONSTRAINT `bill_info_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `bill_info_ibfk_2` FOREIGN KEY (`customer_no`) REFERENCES `customer` (`customer_no`);

--
-- Constraints for table `commercial`
--
ALTER TABLE `commercial`
  ADD CONSTRAINT `commercial_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`);

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_no`) REFERENCES `customer` (`customer_no`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`bill_no`) REFERENCES `bill_info` (`bill_no`);

--
-- Constraints for table `residential`
--
ALTER TABLE `residential`
  ADD CONSTRAINT `residential_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
