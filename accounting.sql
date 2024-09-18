-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2024 at 05:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_detail`
--

CREATE TABLE `bank_detail` (
  `id` int(11) NOT NULL,
  `inward` int(11) DEFAULT NULL,
  `bank` varchar(250) DEFAULT NULL,
  `ifsc` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_detail`
--

INSERT INTO `bank_detail` (`id`, `inward`, `bank`, `ifsc`, `account_number`, `createDate`) VALUES
(1, 5, 'sdsda', 'dasd', 'dssad', '2024-09-10 10:54:29'),
(2, 5, 'dsasd', 'dasd', 'dsad', '2024-09-10 10:54:29'),
(8, 2, 'axcz', 'cxc', '324', '2024-09-10 13:26:48'),
(9, 2, 'adasd', 'dsad', '3244', '2024-09-10 13:27:37'),
(10, 6, 'HDFC', 'HDFC1012', '456439966494', '2024-09-11 08:36:35'),
(11, 7, 'HDFC', 'HDFC7852', '46513212133', '2024-09-11 11:46:39'),
(12, 7, 'HDFC', 'HDFC7852', '46513212133', '2024-09-11 11:46:39'),
(13, 9, 'SBI', 'SBIN524', '9656582', '2024-09-11 13:16:55'),
(14, 10, 'SBI', 'SBIN524', '9656582', '2024-09-13 04:53:14'),
(15, 11, 'HDFC', 'HDFC7852', '9656582', '2024-09-18 10:52:30'),
(16, 12, 'SBI', 'SBIIN1012', '9656582', '2024-09-18 14:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `show_password` text DEFAULT NULL,
  `permission_add` enum('Yes','No') DEFAULT 'No',
  `permission_edit` enum('Yes','No') DEFAULT 'No',
  `permission_delete` enum('Yes','No') DEFAULT 'No',
  `telephone` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `First_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `two_fa_img` text DEFAULT NULL,
  `two_fa_flag` enum('0','1') NOT NULL DEFAULT '0',
  `two_fa_key` varchar(255) DEFAULT NULL,
  `two_fa_verify` enum('0','1') NOT NULL DEFAULT '0',
  `role` enum('superadmin','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `address`, `email`, `Username`, `Password`, `show_password`, `permission_add`, `permission_edit`, `permission_delete`, `telephone`, `code`, `image`, `dob`, `status`, `First_Name`, `Last_Name`, `two_fa_img`, `two_fa_flag`, `two_fa_key`, `two_fa_verify`, `role`) VALUES
(13, NULL, NULL, 'admin@gmail.com', 'admin', 'bc6d575e887fc12a02c2aac70355e98d', NULL, 'Yes', 'Yes', 'Yes', NULL, NULL, NULL, NULL, 'Active', NULL, NULL, NULL, '0', NULL, '0', 'superadmin'),
(14, NULL, NULL, 'admin4@gmail.com', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'Yes', 'Yes', 'Yes', '33213', '312323', NULL, NULL, 'Active', NULL, NULL, NULL, '0', NULL, '0', 'admin'),
(23, NULL, NULL, 'rho@GMAIL.COM', 'rh', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'Yes', 'Yes', 'Yes', '987456321', 'OFFCICE3', NULL, NULL, 'Active', NULL, NULL, NULL, '0', NULL, '0', 'admin'),
(24, NULL, NULL, 'fdsf@efedf.ii', 'fdfsf', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'Yes', 'No', 'No', '645456446', 'ccsdfdc', NULL, NULL, 'Active', NULL, NULL, NULL, '0', NULL, '0', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `inward`
--

CREATE TABLE `inward` (
  `id` int(11) NOT NULL,
  `pan` varchar(20) DEFAULT NULL,
  `adhar` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `fileno` varchar(250) DEFAULT NULL,
  `return_type` varchar(50) DEFAULT NULL,
  `permission_add` enum('Yes','No') DEFAULT 'No',
  `permission_edit` enum('Yes','No') DEFAULT 'No',
  `permission_delete` enum('Yes','No') DEFAULT 'No',
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inward`
--

INSERT INTO `inward` (`id`, `pan`, `adhar`, `mobile`, `email`, `username`, `address`, `fileno`, `return_type`, `permission_add`, `permission_edit`, `permission_delete`, `createdDate`) VALUES
(11, 'FBMPR63481', '2313321', '7600217676', 'ox@gmaol.com', 'ox', '', 'A125', 'REGULAR IT', 'No', 'No', 'No', '2024-09-18 16:22:30'),
(12, 'BZVPR9033D', '2313321', '7600217676', 'admin4@gmail.com', 'oX2', 'test', 'A128', 'TDS', 'No', 'No', 'No', '2024-09-18 19:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `user` int(11) NOT NULL,
  `inward` int(11) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `description`, `user`, `inward`, `createdDate`) VALUES
(2, '<p>sdsdqq23</p>\r\n', 13, 11, '2024-09-18 14:29:58'),
(4, '<p>Ca1</p>\r\n', 13, 11, '2024-09-18 14:07:33'),
(5, '<p>sdsd</p>\r\n', 13, 12, '2024-09-18 14:08:34'),
(6, '<p>Adhar: 52445 <strong>IT</strong></p>\r\n', 13, 11, '2024-09-18 14:10:45'),
(7, '<p>note1</p>\r\n', 13, 12, '2024-09-18 14:11:47'),
(8, '<p>OX 3</p>\r\n', 13, 11, '2024-09-18 14:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `returnType`
--

CREATE TABLE `returnType` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returnType`
--

INSERT INTO `returnType` (`id`, `type`) VALUES
(1, 'REGULAR IT'),
(2, 'SALARY'),
(3, 'TDS'),
(4, 'TCS'),
(5, 'GST'),
(6, 'IMP'),
(7, 'OTHER');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `S_ID` int(11) NOT NULL,
  `App_Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`S_ID`, `App_Name`) VALUES
(1, 'accounting');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 1,
  `Type` int(11) NOT NULL DEFAULT 0,
  `Mobile` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Username`, `Password`, `First_Name`, `Last_Name`, `Email`, `Active`, `Type`, `Mobile`) VALUES
(1, 'admin', 'admin@7610', 'oded', 'Dyani', 'shambuaaamourya@gmail.com', 1, 1, 9967746674);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_detail`
--
ALTER TABLE `bank_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inward` (`inward`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inward`
--
ALTER TABLE `inward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returnType`
--
ALTER TABLE `returnType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`S_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_detail`
--
ALTER TABLE `bank_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `inward`
--
ALTER TABLE `inward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `returnType`
--
ALTER TABLE `returnType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
