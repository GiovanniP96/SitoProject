-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2025 at 06:39 AM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mjcodersnet_pdf`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'NULL for top-level comments',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `parent_id`, `created_at`) VALUES
(1, 1, 'First top-level comment', NULL, '2025-04-04 11:02:22'),
(2, 1, 'Second top-level comment', NULL, '2025-04-04 11:02:22'),
(62, 4, 'test', NULL, '2025-04-07 12:01:46'),
(63, 4, 'ok', 62, '2025-04-07 12:01:57'),
(64, 4, 'ok', 1, '2025-04-07 12:03:30'),
(65, 4, 'hi', 2, '2025-04-07 12:04:29'),
(66, 4, 'helo', NULL, '2025-04-07 14:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `image`) VALUES
(1, 'admin', 'admin@example.com', '22334455', '2025-04-04 11:02:22', ''),
(2, 'Ahmad', 'a@gmail.com', '123456', '2025-04-05 01:24:13', ''),
(3, 'Ali', 'ali@gmail.com', '1122', '2025-04-05 10:27:40', ''),
(4, 'Jaun', 'ja@gmail.com', '1122', '2025-04-06 10:33:31', 'uploads/67f2587b40a96.png'),
(5, 'Moeed', 'moeed@gmail.com', '12345', '2025-04-06 12:38:44', 'uploads/67f275d43a981.jpeg'),
(6, 'giovanni', 'giovanni.pipitone96@gmail.com', 'GiovanniP96$', '2025-04-08 07:08:41', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
