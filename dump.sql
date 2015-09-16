-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 16, 2015 at 05:54 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wallflydb`
--
CREATE DATABASE IF NOT EXISTS `wallflydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `wallflydb`;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE `agent` (
  `super_user_id` bigint(20) NOT NULL,
  `real_estate_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `super_user_id` bigint(20) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `send_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_report`
--

DROP TABLE IF EXISTS `inspection_report`;
CREATE TABLE `inspection_report` (
  `agent_id` bigint(20) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE `owner` (
  `super_user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`super_user_id`) VALUES
(8);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `tenant_id` bigint(20) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE `property` (
  `id` bigint(20) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_schedule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rent_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `real_estate_id` bigint(20) DEFAULT NULL,
  `agent_id` bigint(20) DEFAULT NULL,
  `owner_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `address`, `payment_schedule`, `rent_amount`, `photo`, `real_estate_id`, `agent_id`, `owner_id`) VALUES
(3, '1/116 Sir Fred Schonell Dr, St Lucia QLD 4067', 'FORTNIGHTLY', '600', 'http://dummyimage.com/250x200/000/fff.jpg', NULL, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `real_estate`
--

DROP TABLE IF EXISTS `real_estate`;
CREATE TABLE `real_estate` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `real_estate`
--

INSERT INTO `real_estate` (`id`, `name`, `password`, `address`, `email`, `phone`, `photo`) VALUES
(2, 'Ray White', 'password', 'address', 'ray@white.com', '12345123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_request`
--

DROP TABLE IF EXISTS `repair_request`;
CREATE TABLE `repair_request` (
  `tenant_id` bigint(20) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `severity_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `super_user`
--

DROP TABLE IF EXISTS `super_user`;
CREATE TABLE `super_user` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `super_user`
--

INSERT INTO `super_user` (`id`, `email`, `password`, `firstname`, `lastname`, `phone`, `photo`) VALUES
(8, 'rayp1100@gmail.com', 'sha256:1000:rKOKm2cuCqUW1TAQQknobMhAtUrEserj:oankiLUke4qxYuwXrBx61VfFuUc09UTY', 'Raibima', 'Putra', '0411254684', 'img/dummy_profile_picture.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

DROP TABLE IF EXISTS `tenant`;
CREATE TABLE `tenant` (
  `super_user_id` bigint(20) NOT NULL,
  `property_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`super_user_id`),
  ADD UNIQUE KEY `real_estate_id` (`real_estate_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`super_user_id`,`property_id`),
  ADD KEY `chat_property_id` (`property_id`);

--
-- Indexes for table `inspection_report`
--
ALTER TABLE `inspection_report`
  ADD PRIMARY KEY (`agent_id`,`property_id`,`date`,`client_name`),
  ADD KEY `report_property_id` (`property_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`super_user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`tenant_id`,`property_id`,`timestamp`),
  ADD KEY `payment_property_id` (`property_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `real_estate_id` (`real_estate_id`),
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `real_estate`
--
ALTER TABLE `real_estate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `repair_request`
--
ALTER TABLE `repair_request`
  ADD PRIMARY KEY (`tenant_id`,`property_id`,`timestamp`),
  ADD KEY `repair_property_id` (`property_id`);

--
-- Indexes for table `super_user`
--
ALTER TABLE `super_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`super_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `real_estate`
--
ALTER TABLE `real_estate`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `super_user`
--
ALTER TABLE `super_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_real_estate_id` FOREIGN KEY (`real_estate_id`) REFERENCES `real_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agent_super_user_id` FOREIGN KEY (`super_user_id`) REFERENCES `super_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_super_user_id` FOREIGN KEY (`super_user_id`) REFERENCES `super_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inspection_report`
--
ALTER TABLE `inspection_report`
  ADD CONSTRAINT `report_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`super_user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_super_user_id` FOREIGN KEY (`super_user_id`) REFERENCES `super_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`),
  ADD CONSTRAINT `payment_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`super_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`super_user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `property_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`super_user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `property_real_estate_id` FOREIGN KEY (`real_estate_id`) REFERENCES `real_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair_request`
--
ALTER TABLE `repair_request`
  ADD CONSTRAINT `repair_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`),
  ADD CONSTRAINT `repair_tenant_id` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`super_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_super_user_id` FOREIGN KEY (`super_user_id`) REFERENCES `super_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
