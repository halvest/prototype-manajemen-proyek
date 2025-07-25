-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 07:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `relfconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `status` enum('active','completed','closed','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `lembaga_id`, `title`, `description`, `category`, `image_url`, `status`, `created_at`, `updated_at`) VALUES
(7, 10, 'Donasi Untuk Bencana Alam', 'membutukan donasi untuk pakaian bekas layak pakai', 'Pakaian', '442b7b4b86f2bb6d1cbd6f74090f9eee.jpeg', 'active', '2025-07-10 02:41:31', '2025-07-10 02:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `donatur_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL COMMENT 'Berdasarkan atribut DonationItem',
  `quantity` int(11) NOT NULL DEFAULT 1 COMMENT 'Berdasarkan atribut DonationItem',
  `item_condition` varchar(100) DEFAULT NULL COMMENT 'Berdasarkan atribut DonationItem',
  `item_image_url` varchar(255) DEFAULT NULL COMMENT 'URL atau nama file gambar barang donasi',
  `current_status` varchar(50) NOT NULL DEFAULT 'Pending' COMMENT 'Status pengiriman terkini',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `campaign_id`, `donatur_id`, `item_name`, `quantity`, `item_condition`, `item_image_url`, `current_status`, `created_at`, `updated_at`) VALUES
(6, 7, 12, 'Pakaian Bekas', 1, 'Bekas', '300d835e62ffdcd0a7f396e402f04e3c.jpeg', 'Received', '2025-07-10 02:45:22', '2025-07-10 02:46:40'),
(7, 7, 12, 'Donasi', 1, 'Layak Pakai', 'cfefe8c7787d02a5d0e3d0c4474ad6b9.jpg', 'Received', '2025-07-25 16:57:28', '2025-07-25 17:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'MY-SECRET-API-KEY', 1, 0, 0, NULL, 1672531200);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_history`
--

CREATE TABLE `tracking_history` (
  `tracking_id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'e.g., "Donasi dikonfirmasi", "Barang dikirim", "Barang diterima"',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','lembaga','donatur') NOT NULL,
  `verification_status` enum('pending','verified','rejected') DEFAULT NULL COMMENT 'Khusus untuk role lembaga',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `verification_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Relf', 'admin@relfconnect.com', '0192023a7bbd73250516f069df18b500', 'admin', NULL, '2025-06-17 15:08:29', '2025-06-18 12:01:32'),
(2, 'Yayasan Berkah', 'yayasan@berkah.org', '$2y$10$yourhashedpassword', 'lembaga', 'verified', '2025-06-17 15:08:29', '2025-06-17 15:08:29'),
(3, 'Budi Donatur', 'budi@gmail.com', '$2y$10$yourhashedpassword', 'donatur', NULL, '2025-06-17 15:08:29', '2025-06-17 15:08:29'),
(4, 'Haspro', 'haspro@gmail.com', '740d89836c07ca7552d4a9d3f17f3404', 'lembaga', 'verified', '2025-06-17 16:31:27', '2025-06-18 12:48:03'),
(7, 'admin2', 'admin@gmail.com', '259137c00b7944a104baa46950d82a22', 'admin', NULL, '2025-06-17 17:53:33', '2025-06-17 18:00:47'),
(8, 'admin1234', 'admin1234@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 'admin', NULL, '2025-06-18 09:22:36', '2025-06-18 09:22:36'),
(9, 'user', 'user@gmail.com', 'user123', 'donatur', NULL, '2025-06-18 09:25:35', '2025-06-18 09:25:35'),
(10, 'Yayasan Yatim Piatu', 'yatimpiatu@gmail.com', '16ced9ec0636ee316c0399c5447a8cd5', 'lembaga', 'verified', '2025-06-18 12:49:22', '2025-06-18 12:52:02'),
(11, 'Lembaga Amal', 'lembaga@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 'lembaga', 'verified', '2025-06-25 08:38:23', '2025-06-25 08:38:35'),
(12, 'Hasyim Adani', 'hasyimdani01@gmail.com', '740d89836c07ca7552d4a9d3f17f3404', 'donatur', NULL, '2025-06-29 14:14:07', '2025-06-29 14:14:07'),
(13, 'Sam Smith', 'samsmith@gmail.com', 'e407c5d8319030445d408faf593e432b', 'donatur', NULL, '2025-07-01 14:15:18', '2025-07-01 14:15:18'),
(14, 'Pelita Ikhlas', 'pelitaikhlas@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 'lembaga', 'verified', '2025-07-01 14:21:53', '2025-07-01 14:28:33'),
(15, 'Matcha-TEA', 'matchateanetwork@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'lembaga', 'verified', '2025-07-08 10:54:44', '2025-07-08 10:55:32'),
(16, 'adhminingsih', 'adhmin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'donatur', NULL, '2025-07-08 10:59:38', '2025-07-08 10:59:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`),
  ADD KEY `lembaga_id` (`lembaga_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `donatur_id` (`donatur_id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tracking_history`
--
ALTER TABLE `tracking_history`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `donation_id` (`donation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracking_history`
--
ALTER TABLE `tracking_history`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_ibfk_1` FOREIGN KEY (`lembaga_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`donatur_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tracking_history`
--
ALTER TABLE `tracking_history`
  ADD CONSTRAINT `tracking_history_ibfk_1` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`donation_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
