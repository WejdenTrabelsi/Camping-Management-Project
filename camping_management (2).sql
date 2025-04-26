-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 10:37 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

CREATE TABLE `additional_services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_dates`
--

CREATE TABLE `blocked_dates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blocked_dates`
--

INSERT INTO `blocked_dates` (`id`, `date`, `location_id`) VALUES
(19, '2025-04-29', 19),
(20, '2025-04-26', 19),
(21, '2025-04-27', 19),
(22, '2025-04-09', 19),
(23, '2025-04-26', 19);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies`
--

CREATE TABLE `cancellation_policies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `days_before` int(11) DEFAULT NULL,
  `refund_percentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 'kljkll', 'tent', 233.00, 8, 0, 0, 'klkllm', '../uploads/1744506760_admin-background2.jpg', '2025-04-13 01:12:40', '2025-04-13 01:12:40', 12),
(28, 'dsdzeze', 'tent', 212.00, 5332, 1, 1, 'dsdsd', '../uploads/1744571922_signup-background.jpg', '2025-04-13 19:18:42', '2025-04-13 19:18:42', 12);

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `adults` int(11) NOT NULL DEFAULT 1,
  `kids` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `location_id`, `start_date`, `end_date`, `total_price`, `payment_method`, `status`, `created_at`, `adults`, `kids`) VALUES
(1, 29, 28, '2025-04-09', '2025-04-17', 14.00, '', 'confirmed', '2025-04-22 19:16:20', 1, 0),
(2, 29, 19, '2025-04-24', '2025-04-25', 0.04, '', 'confirmed', '2025-04-22 20:00:02', 1, 0),
(3, 29, 23, '2025-04-25', '2025-05-06', 352.00, '', 'confirmed', '2025-04-22 20:00:57', 1, 0),
(4, 29, 19, '2025-04-24', '2025-05-02', 0.32, '', 'cancelled', '2025-04-22 20:06:50', 1, 0),
(5, 32, 19, '2025-04-23', '2025-04-29', 0.24, '', 'confirmed', '2025-04-22 20:14:05', 1, 0),
(6, 28, 21, '2025-04-24', '2025-04-26', 3.20, '', 'confirmed', '2025-04-22 20:20:46', 5, 5),
(7, 29, 23, '2025-04-23', '2025-04-26', 96.00, '', 'confirmed', '2025-04-22 20:21:41', 1, 0),
(8, 29, 19, '2025-04-26', '2025-04-30', 0.16, '', 'confirmed', '2025-04-25 15:19:58', 1, 0),
(9, 32, 27, '2025-04-26', '2025-04-28', 466.00, '', 'cancelled', '2025-04-25 15:39:23', 1, 0),
(10, 32, 24, '2025-04-26', '2025-04-30', 2092.00, '', 'confirmed', '2025-04-25 15:49:59', 1, 0),
(11, 32, 19, '2025-04-26', '2025-04-28', 0.08, '', 'pending', '2025-04-25 15:52:23', 1, 0),
(12, 32, 19, '2025-04-26', '2025-04-28', 0.08, '', 'pending', '2025-04-25 15:56:47', 1, 0),
(13, 32, 19, '2025-04-26', '2025-04-28', 0.08, '', 'pending', '2025-04-25 16:03:52', 1, 0),
(14, 29, 21, '2025-04-26', '2025-04-28', 0.32, '', 'confirmed', '2025-04-25 16:13:12', 1, 0),
(15, 43, 26, '2025-04-26', '2025-04-29', 0.30, '', 'confirmed', '2025-04-25 18:25:35', 5, 12),
(16, 43, 22, '2025-04-25', '2025-04-30', 3.45, '', 'confirmed', '2025-04-25 19:28:36', 3, 0),
(17, 43, 23, '2025-04-27', '2025-05-23', 832.00, '', 'cancelled', '2025-04-25 19:36:05', 8, 3),
(18, 43, 22, '2025-04-25', '2025-04-26', 0.46, '', 'pending', '2025-04-25 19:42:27', 2, 0),
(19, 43, 24, '2025-04-25', '2025-04-30', 10460.00, '', 'pending', '2025-04-25 19:43:11', 4, 0),
(20, 43, 19, '2025-04-27', '2025-04-28', 0.28, '', 'confirmed', '2025-04-26 10:23:48', 1, 6),
(21, 43, 24, '2025-04-26', '2025-04-27', 1569.00, 'credit_card', 'pending', '2025-04-26 14:00:30', 1, 2),
(22, 43, 19, '2025-04-26', '2025-04-27', 0.20, 'paypal', 'cancelled', '2025-04-26 14:04:07', 3, 2),
(23, 43, 19, '2025-06-12', '2025-06-26', 3.92, 'bank_transfer', 'pending', '2025-04-26 16:36:06', 4, 3),
(24, 43, 19, '2025-04-30', '2025-05-01', 0.28, 'credit_card', 'pending', '2025-04-26 19:25:31', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_services`
--

CREATE TABLE `reservation_services` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `age` int(11) NOT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`, `status`, `created_at`, `is_active`, `gender`, `age`, `city`) VALUES
(12, 'yahyazarred12@gmail.com', 'yahyazarred', '$2y$10$JJRxZqjR5son3Wu7qivSC.u5Rq5WEzZ8GlXqqM3ZXDb3aZf2IuGtW', 'admin', 'active', '2025-03-28 20:41:58', 0, 'male', 0, NULL),
(16, 'miniyahyazarred1234@gmail.com', 'caitlin marie', '$2y$10$x9ky0RmhOGXwFPnTx9yuJ.jPMzZYKxcrXKpgqx0IJgEvXIhahIUxq', 'client', 'active', '2025-03-30 22:56:19', 0, 'female', 69, NULL),
(17, 'yahyazarred12345@gmail.com', 'yahyaaa', '$2y$10$5vCrjeib4gCFYwH9xo4Ok.T8MS485RFCWlJxi5fw9UnqjQtinEX2W', 'client', 'pending', '2025-04-06 04:22:32', 0, 'male', 30, NULL),
(19, 'yahyazarred12344544@gmail.com', 'yahyaaaaa', '$2y$10$S8ewTor776Fn19QYpdIXuOOODWV3lrfq0ULWYmqpq.PQs5GImJrs.', 'client', 'pending', '2025-04-06 20:57:12', 0, 'female', 40, NULL),
(21, 'miniyahyazarred12345@gmail.com', 'silentjohn56666666', '$2y$10$pDIwHIOL1mKuJQfXfeLIaeXnhIh9NiWHGGiKsMim03i5aoHSDSMX2', 'client', 'active', '2025-04-10 15:35:14', 0, 'male', 25, NULL),
(22, 'yahyazarred1234@gmail.com', 'yahya', '$2y$10$s6yOCs0E.smCvVsiFu5nf.YbCnKgQsVMWuH2HuJU48E54QIu3jj7G', 'admin', 'active', '2025-04-12 19:37:22', 0, 'male', 21, NULL),
(23, 'yahyazarred1234434@gmail.com', 'ggggggg', '$2y$10$Vj3b0U6n7g.A6XkpXingNON5rY.7YDzGr3k7ZNpTbd7itOmhEPywK', 'client', 'pending', '2025-04-12 19:40:14', 0, 'male', 18, NULL),
(25, 'yahyazarred12341111@gmail.com', 'testadmin2', '$2y$10$QrORk/UUSDh8omCPAnvi3.bqamAlrWrjdoLTBmbBw9pCSuH4MqCMu', 'admin', 'pending', '2025-04-12 19:46:57', 0, 'male', 48, NULL),
(26, 'yahyazarred123499999@gmail.com', 'testclient', '$2y$10$J.9ppVyNec1.aN6kUuCtUONoLLpGYT/RlUEBJi99wwhJfv1n3UMUe', 'client', 'pending', '2025-04-12 19:47:52', 0, 'female', 72, NULL),
(27, 'yahyazarred123@gmail.com', 'silentjohn66', '$2y$10$SQqzwDyLZx8Pyx5PRiTlcO6pvU.HXrWjGAnfsxYMzL.9titafg0tO', 'client', 'active', '2025-04-12 21:46:28', 0, 'male', 32, NULL),
(28, 'yahyazarred1234888@gmail.com', 'taylor swift', '$2y$10$B8YDED5ArZGfkGAqHTsa1ej2zqBqhDYRPgQm8WArxru.Bio.Z69Ny', 'admin', 'pending', '2025-04-13 23:56:03', 0, 'female', 34, 'TN52'),
(40, 'yahyazarred12341266@gmail.com', 'sabrina carpenter', '123456789', 'client', 'pending', '2025-04-25 19:11:54', 0, 'female', 28, 'Sidi Bou Zid'),
(41, 'yahyazarred122356534@gmail.com', 'justin bieber', '123456789', 'client', 'active', '2025-04-25 19:22:02', 0, 'male', 35, 'Gabès'),
(42, 'yahyazarred123444474@gmail.com', 'beyonce', '123456789', 'admin', 'active', '2025-04-25 19:34:38', 0, 'female', 38, 'Kassérine'),
(43, 'yahyazarred1234444412@gmail.com', 'chappel', '$2y$10$Fpe.X7BG.IHHymVQ2L7Vj.kG6CLVziSCLCV6mo68tu9GNA0z5d2K2', 'client', 'active', '2025-04-25 20:23:29', 0, 'female', 25, NULL),
(44, 'yahyazarred1333@gmail.com', 'billie', '123456789', 'admin', 'pending', '2025-04-25 20:49:29', 0, 'female', 23, 'Bizerte'),
(45, 'yahyazarred12448899@gmail.com', 'katy perry', '123456789', 'admin', 'pending', '2025-04-26 12:58:14', 0, 'female', 24, 'Kebili');

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
(199, 22, 24, 0, 1),
(200, 27, 25, 0, 1),
(201, 43, 25, 0, 1),
(202, 43, 24, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_services`
--
ALTER TABLE `additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `cancellation_policies`
--
ALTER TABLE `cancellation_policies`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `service_id` (`service_id`);

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
-- AUTO_INCREMENT for table `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cancellation_policies`
--
ALTER TABLE `cancellation_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `location_options`
--
ALTER TABLE `location_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reservation_services`
--
ALTER TABLE `reservation_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  ADD CONSTRAINT `blocked_dates_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
