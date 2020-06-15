-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2020 at 05:23 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.27-6+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `films`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(32) NOT NULL,
  `film_id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `comment` text NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '1 = enable, 0 = disable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `film_id`, `user_id`, `comment`, `status`, `created_at`) VALUES
(1, 2, 1, 'fighter is a very good movie', 1, '2020-06-13 18:38:59'),
(2, 1, 2, 'patriot is a very good movie with patritism', 1, '2020-06-13 18:38:59'),
(3, 2, 2, 'very good', 1, '2020-06-13 18:39:46'),
(4, 3, 1, 'nice movie', 1, '2020-06-13 18:39:46'),
(5, 2, 1, 'hello', 1, '2020-06-14 13:09:10'),
(6, 3, 1, 'i saw this as a conceptual movie', 1, '2020-06-14 13:11:42'),
(10, 3, 1, 'yes, this ia a good movie', 1, '2020-06-14 13:18:45'),
(11, 1, 1, 'i saw it many years ago, i amused the love of a patriot', 1, '2020-06-14 13:20:10'),
(12, 5, 1, 'Working good', 1, '2020-06-14 17:39:03'),
(13, 4, 1, 'hello', 1, '2020-06-15 18:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(64) NOT NULL,
  `user_id` int(32) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `release` varchar(64) NOT NULL,
  `rating` int(4) NOT NULL,
  `ticket` varchar(64) NOT NULL,
  `price` int(16) NOT NULL,
  `country` varchar(64) NOT NULL,
  `photo` varchar(64) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '1 = enable, 0 = disable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `user_id`, `name`, `description`, `release`, `rating`, `ticket`, `price`, `country`, `photo`, `status`, `created_at`) VALUES
(1, 1, 'patriot', 'this is a story of the people who lover their country', '1625', 5, 'available', 200, 'US', '', 1, '2020-06-12 20:51:23'),
(2, 2, 'Fighter', 'it is a fight action cinema', '2020', 4, 'available', 100, 'UK', '', 1, '2020-06-13 18:36:08'),
(3, 1, 'Postmaster', 'it is a cinema about the life of a postmaster', '2012', 4, 'available', 200, 'Bangladesh', '', 1, '2020-06-13 18:36:08'),
(4, 1, 'sdgfd', 'fdhgf', 'dfgh', 5, 'yes', 200, 'UK', '1592129528sdgfd.png', 1, '2020-06-14 16:17:50'),
(5, 1, 'sdgfd', 'fdhgf', 'dfgh', 5, 'cxgfh', 200, 'dfghdf', '1592130112sdgfd.png', 1, '2020-06-14 16:21:52'),
(6, 1, 'Ghost Hunting', 'it is a horror movie', 'yes', 5, 'available', 200, 'US', '1592160070Ghost Hunting.png', 1, '2020-06-15 00:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `film_genre`
--

CREATE TABLE `film_genre` (
  `id` int(32) NOT NULL,
  `film_id` int(32) NOT NULL,
  `genre` int(11) NOT NULL,
  `createrAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film_genre`
--

INSERT INTO `film_genre` (`id`, `film_id`, `genre`, `createrAt`) VALUES
(3, 1, 1, '2020-06-12 20:54:28'),
(4, 1, 2, '2020-06-12 20:54:28'),
(5, 1, 7, '2020-06-12 20:55:17'),
(6, 1, 9, '2020-06-12 20:55:17'),
(7, 2, 4, '2020-06-13 18:37:12'),
(8, 2, 8, '2020-06-13 18:37:12'),
(9, 3, 3, '2020-06-13 18:37:40'),
(10, 3, 5, '2020-06-13 18:37:40'),
(11, 5, 3, '2020-06-15 00:38:37'),
(12, 6, 2, '2020-06-15 00:41:10'),
(13, 6, 8, '2020-06-15 00:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `genre_list`
--

CREATE TABLE `genre_list` (
  `id` int(8) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre_list`
--

INSERT INTO `genre_list` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Comedy'),
(4, 'Crime'),
(5, 'Drama'),
(6, 'Fantasy'),
(7, 'Historical'),
(8, 'Horror'),
(9, 'Romantic');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('motaharz95@gmail.com', '$2y$10$Te133ZYpFXoTRy8KqxEwdukP38JvzuUkng9SZG.b8zsovLMvwr/6O', '2020-06-11 09:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zaman', 'motaharz95@gmail.com', NULL, '$2y$10$b4rWe8w6nqOCMpleN2FDZO/2bL2rk4W7Ru6eyb3n21USeVltzhaPq', 'cG7g6l5SIHa6npvXc3GqHd7ZDcaGK62rt5qz0Tnr4gHobsah73gV2UdlVPF1', '2020-06-11 05:39:50', '2020-06-11 05:39:50'),
(2, 'Chowdhury', 'chowdhury@hotmail.com', NULL, '$2y$10$b4rWe8w6nqOCMpleN2FDZO/2bL2rk4W7Ru6eyb3n21USeVltzhaPq', NULL, NULL, NULL),
(3, 'Ari Conroy MD', 'hellen17@example.org', '2020-06-15 10:09:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vpnVEDBIl9', '2020-06-15 10:09:24', '2020-06-15 10:09:24'),
(4, 'Ara Aufderhar', 'orie.harris@example.net', '2020-06-15 10:09:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Q4LQDpyQhg', '2020-06-15 10:09:24', '2020-06-15 10:09:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film_genre`
--
ALTER TABLE `film_genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_list`
--
ALTER TABLE `genre_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `film_genre`
--
ALTER TABLE `film_genre`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `genre_list`
--
ALTER TABLE `genre_list`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
