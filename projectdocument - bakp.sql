-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 11:51 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdocument`
--

-- --------------------------------------------------------

--
-- Table structure for table `documenstatus`
--

CREATE TABLE `documenstatus` (
  `id` int(11) NOT NULL,
  `documentReportId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `status` enum('approved','rejected') NOT NULL,
  `description` text NOT NULL,
  `approvalTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `documentreportitems`
--

CREATE TABLE `documentreportitems` (
  `id` int(11) NOT NULL,
  `documentReportId` int(11) NOT NULL,
  `description` text NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documentreportitems`
--

INSERT INTO `documentreportitems` (`id`, `documentReportId`, `description`, `value`, `file`) VALUES
(1, 3, 'tes 1', '12312321', ''),
(4, 3, 'sadfdsf', '123213', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentreports`
--

CREATE TABLE `documentreports` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `restValue` decimal(10,0) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `activityTimestamp` datetime DEFAULT NULL,
  `createdTimestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `documentStatus` enum('pending','revised','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documentreports`
--

INSERT INTO `documentreports` (`id`, `userId`, `type`, `value`, `restValue`, `description`, `activityTimestamp`, `createdTimestamp`, `documentStatus`) VALUES
(3, 2, 'tes', '124124214', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(5, 2, 'tesa', '12421', '0', 'asdfsadfsaf', '2018-04-01 00:00:00', '2018-04-18 20:46:37', ''),
(6, 2, 'asf', '1612', '0', 'sdfsa', '2018-04-01 00:00:00', '2018-04-18 20:51:35', 'pending'),
(8, 2, 'asdfdsf', '151235215', '0', 'dsafdsafsf', '2018-04-02 00:00:00', '2018-04-18 20:57:12', ''),
(9, 2, 'asdfdsf', '151235215', '0', 'dsafdsafsf', '2018-04-02 00:00:00', '2018-04-18 20:57:27', 'pending'),
(10, 2, 'tes', '124124214', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(11, 2, 'tes', '124124214', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(12, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(13, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(14, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(15, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(16, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(17, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(18, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(19, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(20, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(21, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(22, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(23, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(24, 2, 'tes post', '20000000', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(25, 2, 'tes post', '0', '0', 'desc', '2018-04-01 00:00:00', '2018-04-11 21:20:11', 'pending'),
(27, 2, 'tesasdf', '11515214', '0', 'Descr', '2018-04-03 00:00:00', '2018-04-29 01:47:35', 'pending'),
(28, 2, 'tes from form', '1000050020', '0', 'asdfdsafdsafdsaf', '2018-04-04 00:00:00', '2018-04-29 01:47:55', 'pending'),
(29, 2, 'twerer', '25426', '0', '', '2018-04-03 00:00:00', '2018-04-29 01:49:53', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `grouppermissions`
--

CREATE TABLE `grouppermissions` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `permissionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grouppermissions`
--

INSERT INTO `grouppermissions` (`id`, `groupId`, `permissionId`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`) VALUES
(1, 'superadmin', '1'),
(2, 'staff_bendahara', '1'),
(3, 'staff_kabag', '1'),
(4, 'staff_user', '1');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `modul` varchar(100) NOT NULL,
  `codeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `modul`, `codeName`) VALUES
(1, 'All Operation', 'core', 'all_operation');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `mobilePhone` varchar(15) NOT NULL,
  `department` varchar(20) NOT NULL,
  `divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `lastLoggedinTimestamp` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `groupId`, `username`, `email`, `password`, `createdTimestamp`, `lastLoggedinTimestamp`, `status`) VALUES
(2, 1, 'sysadmin', 'sysadmin@mail.com', '48a365b4ce1e322a55ae9017f3daf0c0', '2018-04-08 14:54:37', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documenstatus`
--
ALTER TABLE `documenstatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indexUserId` (`userId`),
  ADD KEY `indexDocumentReportId` (`documentReportId`) USING BTREE;

--
-- Indexes for table `documentreportitems`
--
ALTER TABLE `documentreportitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indexDocumentReportId` (`documentReportId`) USING BTREE;

--
-- Indexes for table `documentreports`
--
ALTER TABLE `documentreports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indexUserId` (`userId`) USING BTREE;

--
-- Indexes for table `grouppermissions`
--
ALTER TABLE `grouppermissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indexGroupId` (`groupId`),
  ADD UNIQUE KEY `indexPermissions` (`permissionId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indexId` (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indexId` (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indexUserId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indexGroupId` (`groupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documenstatus`
--
ALTER TABLE `documenstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documentreportitems`
--
ALTER TABLE `documentreportitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documentreports`
--
ALTER TABLE `documentreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `grouppermissions`
--
ALTER TABLE `grouppermissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documenstatus`
--
ALTER TABLE `documenstatus`
  ADD CONSTRAINT `documenstatus_ibfk_1` FOREIGN KEY (`documentReportId`) REFERENCES `documentreports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documenstatus_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documentreportitems`
--
ALTER TABLE `documentreportitems`
  ADD CONSTRAINT `documentreportitems_ibfk_1` FOREIGN KEY (`documentReportId`) REFERENCES `documentreports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documentreports`
--
ALTER TABLE `documentreports`
  ADD CONSTRAINT `documentreports_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grouppermissions`
--
ALTER TABLE `grouppermissions`
  ADD CONSTRAINT `grouppermissions_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grouppermissions_ibfk_2` FOREIGN KEY (`permissionId`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
