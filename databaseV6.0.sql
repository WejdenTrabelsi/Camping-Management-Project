-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 03:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camping_management`
--
CREATE DATABASE IF NOT EXISTS `camping_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `camping_management`;

-- --------------------------------------------------------

--
-- Table structure for table `client_messages`
--

CREATE TABLE `client_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `state` enum('new','seen') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_messages`
--

INSERT INTO `client_messages` (`id`, `name`, `email`, `message`, `state`) VALUES
(7, 'rtgwdsg', 'yahyazarred12@gmail.com', 'tyetdhgsgrsgsr', 'seen');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `discount_value` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `min_age` int(11) DEFAULT 18,
  `max_age` int(11) DEFAULT 100,
  `discount_duration` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location_id` int(11) DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_value`, `gender`, `min_age`, `max_age`, `discount_duration`, `created_at`, `location_id`, `expiry_date`) VALUES
(20, '30', 'any', 18, 100, 1, '2025-04-12 20:00:15', 19, '2025-04-13 00:00:00'),
(21, '50', 'any', 18, 100, 4, '2025-04-12 20:00:25', 22, '2025-04-16 00:00:00'),
(22, '60', 'any', 18, 100, 2, '2025-04-12 20:00:40', 24, '2025-04-14 00:00:00'),
(23, '50', 'female', 36, 100, 1, '2025-04-12 21:37:50', 21, '2025-04-13 00:00:00'),
(24, '30', 'female', 56, 100, 3, '2025-04-12 21:38:03', 23, '2025-04-15 00:00:00'),
(26, '40', 'female', 37, 100, 8, '2025-04-13 01:12:58', 27, '2025-04-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `extra_options`
--

CREATE TABLE `extra_options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extra_options`
--

INSERT INTO `extra_options` (`id`, `name`, `description`, `price`) VALUES
(1, 'kfklfdlklllll', 'hiiiiiii', 11.00),
(3, 'dsfvdf', 'xcfvsqv', 226.00),
(4, 'dsf', 'xccwx', 21111.00);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('tent','caravan','chalet','rv') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  `electricity` tinyint(1) NOT NULL DEFAULT 0,
  `water` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `type`, `price`, `capacity`, `electricity`, `water`, `description`, `image_path`, `created_at`, `updated_at`, `created_by`) VALUES
(19, '32jg6jkghkj', 'tent', 0.04, 16, 0, 1, 'hjhjkhjk;', '../uploads/1744296227_camping 2.webp', '2025-04-10 14:43:47', '2025-04-13 00:08:41', 12),
(21, 'erfrsfzz', 'tent', 0.16, 3, 0, 1, 'cdssds', '../uploads/1744323289_camping4.jfif', '2025-04-10 22:14:49', '2025-04-10 22:14:49', 12),
(22, 'rdfvcvvv', 'tent', 0.23, 11, 1, 1, 'sdcdqscqd', '../uploads/1744323319_camping3.jpg', '2025-04-10 22:15:19', '2025-04-10 22:39:03', 12),
(23, 'dcqfq', 'tent', 32.00, 3223, 1, 0, 'edzddqc', '../uploads/1744323342_camping.jpg', '2025-04-10 22:15:42', '2025-04-10 22:15:42', 12),
(24, 'klkk', 'tent', 523.00, 6313, 1, 1, 'jkjk,', '../uploads/1744486118_camping 2.webp', '2025-04-12 19:28:38', '2025-04-13 00:13:42', 12),
(26, 'yahya\'s location', 'chalet', 0.10, 3, 1, 0, 'dssdsdsd', '../uploads/1744502466_profile_67e6d6329e9021.30378203.jpg', '2025-04-13 00:01:06', '2025-04-13 00:01:06', 22),
(27, 'kljkll', 'tent', 233.00, 8, 0, 0, 'klkllm', '../uploads/1744506760_admin-background2.jpg', '2025-04-13 01:12:40', '2025-04-13 01:12:40', 12);

-- --------------------------------------------------------

--
-- Table structure for table `location_options`
--

CREATE TABLE `location_options` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_options`
--

INSERT INTO `location_options` (`id`, `location_id`, `option_name`, `option_price`) VALUES
(2, 26, 'dsfvdf', 0.00),
(3, 26, 'dsf', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `created_at`, `is_read`) VALUES
(5, 'We are happy to inform you that the location fsfqseffsf has a 50% discount under the conditions that you are a male and between the ages of 63 and 74. This discount expires on .', '2025-03-31 03:15:32', 1),
(8, 'We are happy to inform you that the location dgdffgdgfd has a 50% discount under the conditions that you are a female and between the ages of 43 and 59. This discount expires on .', '2025-03-31 06:55:38', 1),
(9, 'We are happy to inform you that the location dream land has a 30% discount under the conditions that you are a male and between the ages of 49 and 100. This discount expires on .', '2025-04-06 20:12:18', 1),
(10, 'We are happy to inform you that the location dsfffffffff55 has a 40% discount under the conditions that you are a female and between the ages of 42 and 100. This discount expires on 2025-04-26.', '2025-04-06 21:10:52', 1),
(11, 'We are happy to inform you that the location 32jg6jkghkj has a 30% discount under the conditions that you are a male and between the ages of 40 and 100. This discount expires on 2025-04-14.', '2025-04-10 14:51:56', 1),
(12, 'We are happy to inform you that the location 32jg6jkghkj has a 10% discount under the conditions that you are a male and between the ages of 40 and 100. This discount expires on 2025-04-14.', '2025-04-10 14:53:29', 1),
(13, 'We are happy to inform you that the location erfrsfzz has a 40% discount under the conditions that you are a male and between the ages of 50 and 65. This discount expires on 2025-04-13.', '2025-04-12 18:19:51', 1),
(14, 'We are happy to inform you that the location erfrsfzz has a 40% discount under the conditions that you are a male and between the ages of 50 and 65. This discount expires on 2025-04-13.', '2025-04-12 18:20:58', 1),
(15, 'We are happy to inform you that the location rdfvcvvv has a 60% discount under the conditions that you are a female and between the ages of 36 and 100. This discount expires on 2025-04-16.', '2025-04-12 18:21:48', 1),
(16, 'We are happy to inform you that the location dcqfq has a 10% discount under the conditions that you are between the ages of 43 and 100. This discount expires on 2025-04-23.', '2025-04-12 18:24:21', 1),
(17, 'We are happy to inform you that the location klkk has a 50% discount under the conditions that you are a male and between the ages of 38 and 100. This discount expires on 2025-04-23.', '2025-04-12 19:28:57', 1),
(18, 'We are happy to inform you that the location erfzs has a 20% discount under the conditions that you are a female and between the ages of 39 and 100. This discount expires on 2025-04-25.', '2025-04-12 19:35:59', 1),
(19, 'We are happy to inform you that the location 32jg6jkghkj has a 30% discount under the conditions that you are between the ages of 18 and 100. This discount expires on 2025-04-13.', '2025-04-12 20:00:15', 0),
(20, 'We are happy to inform you that the location rdfvcvvv has a 50% discount under the conditions that you are between the ages of 18 and 100. This discount expires on 2025-04-16.', '2025-04-12 20:00:25', 0),
(21, 'We are happy to inform you that the location klkk has a 60% discount under the conditions that you are between the ages of 18 and 100. This discount expires on 2025-04-14.', '2025-04-12 20:00:40', 0),
(22, 'We are happy to inform you that the location erfrsfzz has a 50% discount under the conditions that you are a female and between the ages of 36 and 100. This discount expires on 2025-04-13.', '2025-04-12 21:37:50', 0),
(23, 'We are happy to inform you that the location dcqfq has a 30% discount under the conditions that you are a female and between the ages of 56 and 100. This discount expires on 2025-04-15.', '2025-04-12 21:38:03', 0),
(24, 'We are happy to inform you that the location erfzs has a 20% discount under the conditions that you are a male and between the ages of 46 and 100. This discount expires on 2025-04-15.', '2025-04-12 21:38:15', 0),
(25, 'We are happy to inform you that the location kljkll has a 40% discount under the conditions that you are a female and between the ages of 37 and 100. This discount expires on 2025-04-21.', '2025-04-13 01:12:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('client','admin') NOT NULL DEFAULT 'client',
  `status` enum('pending','active','deactivated') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `gender` enum('male','female') NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`, `status`, `created_at`, `is_active`, `gender`, `age`) VALUES
(12, 'yahyazarred12@gmail.com', 'yahyazarred', '$2y$10$JJRxZqjR5son3Wu7qivSC.u5Rq5WEzZ8GlXqqM3ZXDb3aZf2IuGtW', 'admin', 'active', '2025-03-28 20:41:58', 0, 'male', 0),
(16, 'miniyahyazarred1234@gmail.com', 'caitlin marie', '$2y$10$x9ky0RmhOGXwFPnTx9yuJ.jPMzZYKxcrXKpgqx0IJgEvXIhahIUxq', 'client', 'active', '2025-03-30 22:56:19', 0, 'female', 69),
(17, 'yahyazarred12345@gmail.com', 'yahyaaa', '$2y$10$5vCrjeib4gCFYwH9xo4Ok.T8MS485RFCWlJxi5fw9UnqjQtinEX2W', 'client', 'pending', '2025-04-06 04:22:32', 0, 'male', 30),
(19, 'yahyazarred12344544@gmail.com', 'yahyaaaaa', '$2y$10$S8ewTor776Fn19QYpdIXuOOODWV3lrfq0ULWYmqpq.PQs5GImJrs.', 'client', 'pending', '2025-04-06 20:57:12', 0, 'female', 40),
(21, 'miniyahyazarred12345@gmail.com', 'silentjohn56666666', '$2y$10$pDIwHIOL1mKuJQfXfeLIaeXnhIh9NiWHGGiKsMim03i5aoHSDSMX2', 'client', 'active', '2025-04-10 15:35:14', 0, 'male', 25),
(22, 'yahyazarred1234@gmail.com', 'yahya', '$2y$10$s6yOCs0E.smCvVsiFu5nf.YbCnKgQsVMWuH2HuJU48E54QIu3jj7G', 'admin', 'active', '2025-04-12 19:37:22', 0, 'male', 21),
(23, 'yahyazarred1234434@gmail.com', 'ggggggg', '$2y$10$Vj3b0U6n7g.A6XkpXingNON5rY.7YDzGr3k7ZNpTbd7itOmhEPywK', 'client', 'pending', '2025-04-12 19:40:14', 0, 'male', 18),
(25, 'yahyazarred12341111@gmail.com', 'testadmin2', '$2y$10$QrORk/UUSDh8omCPAnvi3.bqamAlrWrjdoLTBmbBw9pCSuH4MqCMu', 'admin', 'pending', '2025-04-12 19:46:57', 0, 'male', 48),
(26, 'yahyazarred123499999@gmail.com', 'testclient', '$2y$10$J.9ppVyNec1.aN6kUuCtUONoLLpGYT/RlUEBJi99wwhJfv1n3UMUe', 'client', 'pending', '2025-04-12 19:47:52', 0, 'female', 72),
(27, 'yahyazarred123@gmail.com', 'silentjohn66', '$2y$10$SQqzwDyLZx8Pyx5PRiTlcO6pvU.HXrWjGAnfsxYMzL.9titafg0tO', 'client', 'active', '2025-04-12 21:46:28', 0, 'male', 32);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `user_id`, `notification_id`, `is_read`, `is_deleted`) VALUES
(1, 22, 16, 1, 1),
(3, 22, 15, 1, 1),
(9, 22, 14, 1, 1),
(171, 22, 13, 0, 1),
(172, 22, 12, 0, 1),
(173, 22, 9, 1, 0),
(174, 22, 5, 0, 1),
(175, 22, 17, 0, 1),
(176, 22, 8, 0, 1),
(177, 22, 10, 1, 0),
(178, 27, 18, 0, 1),
(179, 27, 17, 1, 1),
(180, 27, 5, 0, 1),
(181, 27, 8, 0, 1),
(182, 27, 9, 0, 1),
(183, 27, 10, 0, 1),
(184, 27, 11, 0, 1),
(185, 27, 12, 0, 1),
(186, 27, 13, 0, 1),
(187, 27, 14, 0, 1),
(188, 27, 15, 0, 1),
(189, 27, 16, 0, 1),
(191, 27, 21, 0, 1),
(192, 27, 20, 0, 1),
(193, 27, 19, 1, 1),
(195, 27, 24, 0, 1),
(196, 27, 23, 0, 1),
(197, 27, 22, 0, 1),
(199, 22, 24, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_messages`
--
ALTER TABLE `client_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_location_discount` (`location_id`,`discount_duration`);

--
-- Indexes for table `extra_options`
--
ALTER TABLE `extra_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `location_options`
--
ALTER TABLE `location_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_notification` (`user_id`,`notification_id`),
  ADD KEY `fk_notification` (`notification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_messages`
--
ALTER TABLE `client_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `extra_options`
--
ALTER TABLE `extra_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `location_options`
--
ALTER TABLE `location_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `fk_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `location_options`
--
ALTER TABLE `location_options`
  ADD CONSTRAINT `location_options_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `fk_notification` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"camping_management\",\"table\":\"user_notifications\"},{\"db\":\"camping_management\",\"table\":\"discounts\"},{\"db\":\"camping_management\",\"table\":\"client_messages\"},{\"db\":\"camping_management\",\"table\":\"locations\"},{\"db\":\"camping_management\",\"table\":\"notifications\"},{\"db\":\"camping_management\",\"table\":\"users\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'camping_management', 'users', '[]', '2025-03-30 20:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-04-13 01:28:24', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
