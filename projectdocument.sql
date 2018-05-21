-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 05:47 PM
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
-- Table structure for table `documentapprover`
--

CREATE TABLE `documentapprover` (
  `id` int(11) NOT NULL,
  `documentReportId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `status` enum('approved','revised','rejected') DEFAULT NULL,
  `description` text NOT NULL,
  `approvalTimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
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
(29, 43, 'Semua perjalanan dinas', '15000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentreports`
--

CREATE TABLE `documentreports` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `restValue` decimal(10,0) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `activityTimestamp` date DEFAULT NULL,
  `createdTimestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('submitted','verified','need next approval','revised','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documentreports`
--

INSERT INTO `documentreports` (`id`, `userId`, `type`, `value`, `restValue`, `description`, `activityTimestamp`, `createdTimestamp`, `status`) VALUES
(43, 12, 'Perjalanan Dinas (Ambon)', '15000000', '0', 'Perjalanan Dinas ke Kota Ambon', '2018-05-02', '2018-05-20 22:35:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documentstatus`
--

CREATE TABLE `documentstatus` (
  `id` int(11) NOT NULL,
  `documentReportId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` enum('submitted','verified','need next approval','revised','approved','rejected') DEFAULT NULL,
  `description` text NOT NULL,
  `approvalTimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 1),
(10, 2, 2),
(11, 2, 4),
(12, 2, 6),
(14, 4, 2),
(15, 4, 3),
(16, 4, 8),
(17, 4, 9),
(18, 4, 11),
(19, 4, 17),
(20, 4, 19),
(21, 4, 22),
(22, 4, 24),
(23, 4, 16),
(24, 4, 21);

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
  `codeName` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `modul`, `codeName`, `description`) VALUES
(1, 'All Operation', 'core', 'all_operation', 'It will allow user to do all operation in this apps'),
(2, 'Navigation module: Dashboard', 'Navigation', 'module_navigation_dashboard', 'Show the navigation for Dashboard'),
(3, 'Navigation module: Report', 'Navigation', 'module_navigation_report', 'Show the navigation for Report'),
(4, 'Navigation module: Report Verification', 'Navigation', 'module_navigation_reportverification', 'Show the navigation for Report Verification'),
(5, 'Navigation module: Report Approval', 'Navigation', 'module_navigation_reportapproval', 'Show the navigation for Report Approval'),
(6, 'Navigation module: Management', 'Navigation', 'module_navigation_usermanagement', 'Show the navigation for User Management'),
(7, 'Can view all report', 'Report', 'view_all_report', 'It will allow user to view all report'),
(8, 'Can view related report', 'Report', 'view_related_report', 'It will allow user  to view report which they created'),
(9, 'Can add report', 'Report', 'add_report', 'It will allow user to add report'),
(10, 'Can change all report', 'Report', 'change_all_report', 'It will allow user to change all report'),
(11, 'Can change related report', 'Report', 'change_related_report', 'It will allow user to change report which they created'),
(12, 'Can mark report as verified', 'Report', 'verified_report', 'It will allow user to mark report as verified'),
(13, 'Can mark report as revised', 'Report', 'revised_report', 'It will allow user to mark report as revised'),
(14, 'Can mark report as approved', 'Report', 'approved_report', 'It will allow user to mark report as approved'),
(15, 'Can view all report item', 'Report Item', 'view_all_reportitem', 'It will allow user to view all report item'),
(16, 'Can view related report item', 'Report Item', 'view_related_reportitem', 'It will allow user to view all report item which they created'),
(17, 'Can add report item', 'Report Item', 'add_reportitem', 'It will allow user to add report item'),
(18, 'Can change all report item', 'Report Item', 'change_all_reportitem', 'It will allow user to change all report item'),
(19, 'Can change related report item', 'Report Item', 'change_related_reportitem', 'It will allow user to change related report item'),
(20, 'Can view all report approver', 'Report Approver', 'view_all_reportapprover', 'It will allow user to view all report approver'),
(21, 'Can view related report approver', 'Report Approver', 'view_related_reportapprover', 'It will allow user to view all report approver which they created'),
(22, 'Can add report approver', 'Report Approver', 'add_reportapprover', 'It will allow user to add report approver'),
(23, 'Can change all report approver', 'Report Approver', 'change_all_reportapprover', 'It will allow user to change all report approver'),
(24, 'Can change related report approver', 'Report Approver', 'change_related_reportapprover', 'It will allow user to change related report approver'),
(25, 'Can view all user', 'User Management', 'view_all_user', 'It will allow user to view all user'),
(26, 'Can add user', 'User Management', 'add_user', 'It will allow user to add user'),
(27, 'Can change all user', 'User Management', 'change_all_user', 'It will allow user to change all user');

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

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `userId`, `name`, `address`, `mobilePhone`, `department`, `divisi`) VALUES
(5, 12, 'Firmansyah Rizqy Ramadhan', 'Jln. Cempaka Putih Barat, Jakarta Pusat, 10520', '0812345678901', 'Department', 'Divisi'),
(6, 13, 'Staff Kabag 1', 'Jln. Jakarta Pusat. no. 501', '0812349512398', 'Kabag A', 'Kabag A'),
(7, 14, 'Staff Kabag 2', 'Jln Jalan Jakarta Pusat', '08123498123513', 'Kabag B', 'Kabag B');

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
  `createdTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLoggedinTimestamp` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `forceChangePassword` tinyint(1) NOT NULL DEFAULT '1',
  `isSuperAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `groupId`, `username`, `email`, `password`, `createdTimestamp`, `lastLoggedinTimestamp`, `status`, `forceChangePassword`, `isSuperAdmin`) VALUES
(2, 1, 'sysadmin', 'sysadmin@mail.com', '48a365b4ce1e322a55ae9017f3daf0c0', '2018-04-08 14:54:37', '0000-00-00 00:00:00', 1, 0, 1),
(12, 4, 'firmansyahuser', 'firmansyah+user@mail.com', '9df1701321b3528266cb1f5d3fb59404', '2018-05-20 22:32:49', '0000-00-00 00:00:00', 1, 1, 0),
(13, 3, 'staffkabag1', 'staffkabag+1@mail.com', '9df1701321b3528266cb1f5d3fb59404', '2018-05-20 22:37:17', '0000-00-00 00:00:00', 1, 1, 0),
(14, 3, 'staffkabag2', 'staffkabag+2@mail.com', '9df1701321b3528266cb1f5d3fb59404', '2018-05-20 22:38:00', '0000-00-00 00:00:00', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documentapprover`
--
ALTER TABLE `documentapprover`
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
-- Indexes for table `documentstatus`
--
ALTER TABLE `documentstatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indexUserId` (`userId`),
  ADD KEY `indexDocumentReportId` (`documentReportId`) USING BTREE;

--
-- Indexes for table `grouppermissions`
--
ALTER TABLE `grouppermissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indexGroupId` (`groupId`) USING BTREE,
  ADD KEY `indexPermissions` (`permissionId`) USING BTREE;

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
  ADD KEY `indexGroupId` (`groupId`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documentapprover`
--
ALTER TABLE `documentapprover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `documentreportitems`
--
ALTER TABLE `documentreportitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `documentreports`
--
ALTER TABLE `documentreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `documentstatus`
--
ALTER TABLE `documentstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `grouppermissions`
--
ALTER TABLE `grouppermissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documentapprover`
--
ALTER TABLE `documentapprover`
  ADD CONSTRAINT `documentapprover_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documentapprover_ibfk_2` FOREIGN KEY (`documentReportId`) REFERENCES `documentreports` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `documentstatus`
--
ALTER TABLE `documentstatus`
  ADD CONSTRAINT `documentstatus_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documentstatus_ibfk_3` FOREIGN KEY (`documentReportId`) REFERENCES `documentreports` (`id`) ON DELETE CASCADE;

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
