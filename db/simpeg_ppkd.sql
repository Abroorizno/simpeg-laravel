-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2025 at 03:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpeg_ppkd`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `majors_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(13) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `majors_id`, `user_id`, `title`, `gender`, `address`, `phone`, `photo`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'S. SI', 1, 'Bekasi, Indonesia', '81234567890', 'photo_instructor/7zu8ph7MiEoEacCSJRGJ8NgSxZ7vPMVJ82KDoLP8.webp', 1, '2025-04-20 21:45:56', '2025-04-21 04:18:28'),
(3, 2, 5, 'S. T', 1, 'Jakarta, Indonesia', '81234567891', 'photo_instructor/KcGfCtJuGqe3314hr5xBYYK7IjElrkdNPIe4t9uX.webp', 1, '2025-04-21 19:24:59', '2025-04-21 19:24:59'),
(6, 4, 9, 'S. Bk', 1, 'Jakarta, Indonesia', '081111111111', 'photo_instructor/HYt6gtfAP3MQK1zhedZAuJo1gZKoxnwqGLke1y3o.webp', 1, '2025-04-21 23:35:59', '2025-04-21 23:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `learning_moduls`
--

CREATE TABLE `learning_moduls` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_moduls`
--

INSERT INTO `learning_moduls` (`id`, `instructor_id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 1, 'Soal Pra Ujikom SIMPEG', 'TUGAS MEMBUAT PROGRAM SIMPEG', 1, '2025-04-21 04:37:53', '2025-04-22 00:13:37'),
(6, 3, 'TEST MOBILE', 'TEST MOBILE', 1, '2025-04-22 00:14:34', '2025-04-22 00:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `learning_modul_details`
--

CREATE TABLE `learning_modul_details` (
  `id` int(11) NOT NULL,
  `learning_modul_id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `reference_link` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_modul_details`
--

INSERT INTO `learning_modul_details` (`id`, `learning_modul_id`, `file_name`, `file`, `reference_link`, `created_at`, `updated_at`) VALUES
(1, 3, 'Soal Pra Ujikom', 'moduls/EjUkSaHsUXgXw0pDPMiR08vrJBgmJ4wmz2UppVi6.pdf', 'https://www.youtube.com/watch?v=yMZv6eOhKvw', '2025-04-21 05:33:31', '2025-04-21 19:02:19'),
(4, 6, 'TEST', 'moduls/3afdyo9CIyWLU2vaSre4pom8p1RKFX8rWYkkSYmM.pdf', NULL, '2025-04-22 00:14:55', '2025-04-22 00:14:55'),
(5, 3, 'TEST', 'moduls/0nO9dDXxmBcWme0yFijLYemArPsP5VaQkd4LJhlL.pdf', NULL, '2025-04-22 01:04:30', '2025-04-22 01:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Web Programming', 1, '2025-04-20 21:02:24', '2025-04-20 21:02:24'),
(2, 'Mobile Programming', 1, '2025-04-20 21:02:33', '2025-04-20 21:02:33'),
(3, 'MakeUp Artist', 1, '2025-04-21 21:29:52', '2025-04-21 21:29:59'),
(4, 'Bahasa Korea', 1, '2025-04-21 21:30:12', '2025-04-21 21:30:12'),
(5, 'tes', 1, '2025-04-22 00:58:46', '2025-04-22 00:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `majors_detail`
--

CREATE TABLE `majors_detail` (
  `id` int(11) NOT NULL,
  `majors_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors_detail`
--

INSERT INTO `majors_detail` (`id`, `majors_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 1, 7, '2025-04-21 21:23:31', '2025-04-21 21:28:53'),
(4, 2, 7, '2025-04-21 21:28:09', '2025-04-21 21:28:09'),
(5, 4, 8, '2025-04-21 21:30:39', '2025-04-21 21:30:39'),
(6, 3, 8, '2025-04-21 21:30:48', '2025-04-21 21:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PIC', 1, '2025-04-20 20:10:24', '2025-04-20 20:23:43'),
(2, 'Instructor', 1, '2025-04-20 20:11:52', '2025-04-20 20:11:52'),
(3, 'Admin', 1, '2025-04-20 20:12:13', '2025-04-20 20:12:13'),
(4, 'User Admin', 1, '2025-04-20 20:12:56', '2025-04-20 20:12:56'),
(5, 'Student', 1, '2025-04-20 20:13:10', '2025-04-20 20:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `majors_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `majors_id`, `user_id`, `gender`, `date_of_birth`, `place_of_birth`, `photo`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '2002-07-16', 'Jakarta', 'photo_students/s0No5Isav12w6QFjuNlfPJdnOXUA3dTeJ50byN4J.jpg', 0, '2025-04-21 00:55:31', '2025-04-22 00:34:07'),
(2, 2, 11, 1, '2001-04-22', 'Jakarta', 'photo_students/WMMp20WWsukw7bhVtJxJU8j1eotD68rQyU3vTFTD.webp', 0, '2025-04-22 00:18:50', '2025-04-22 00:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Abroor Rizky', 'admin@gmail.com', '$2y$12$U5BTysg6nRMMftssp5fMZuZy6ebmhoBLdQM2RtUJzURNyktanmc0S', 1, '2025-04-20 19:47:45', '2025-04-21 03:29:56'),
(3, 'Reza Ibrahim', 'test@contoh.com', '$2y$12$rkq2hJI/QseGJg4A0qhMcO7l5dB7M9GpVAbW/nrH3x4gisj3DjHcO', 1, '2025-04-20 20:49:34', '2025-04-21 03:41:48'),
(4, 'Reiji', 'reiji@example.com', '$2y$12$cMUMTrdJ0atqc/X/554SS.OS/7Xivg7q/QqiCYtu98rcwvmRl7Z/u', 1, '2025-04-21 00:32:08', '2025-04-21 00:32:08'),
(5, 'Sandi', 'sandi@example.com', '$2y$12$597X8G5KXCgY3g7pn/MP4ul6Hoqbz.bHmpAJ/DZkZShJOvxQr.hIe', 1, '2025-04-21 00:47:49', '2025-04-21 00:47:49'),
(6, 'Raka', 'raka@example.com', '$2y$12$Kkf3nf3FU47wl9Ho7aCADebWoHLLYYD1N0JPWXP6xZ.d.umK5DgBS', 1, '2025-04-21 19:14:57', '2025-04-21 19:14:57'),
(7, 'Dio', 'dio@example.com', '$2y$12$pWEYAXuFkm9N9TMvq0k8PuqwvU79tQBhP6AxSlNOhS9Rp0zRXfa6a', 1, '2025-04-21 19:31:17', '2025-04-21 19:31:17'),
(8, 'Ria', 'ria@gmail.com', '$2y$12$bDKL3so32.LwQZa0KGDYses2klkzWuMWMVs2X7FArkqYWLKSVZcf.', 1, '2025-04-21 21:29:27', '2025-04-21 21:29:27'),
(9, 'Rizky', 'rizky@example.com', '$2y$12$A1Fm/gM4RsFHQMWQmvAlE.5E1UZeWBAvGJJPdeTG3Wwx9NrJeWDii', 1, '2025-04-21 21:39:14', '2025-04-21 21:39:14'),
(11, 'Bagas', 'bagas@example.com', '$2y$12$JUHoNdfzrUiFjgh.LCzqeuKGcrydp8.TCf3s7NQW1H2UelMSoUGTm', 1, '2025-04-22 00:17:08', '2025-04-22 00:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2025-04-20 23:54:27', '2025-04-20 23:54:27'),
(3, 2, 4, '2025-04-20 23:56:52', '2025-04-21 00:04:44'),
(4, 4, 5, '2025-04-21 00:32:17', '2025-04-21 00:32:17'),
(5, 5, 2, '2025-04-21 00:48:15', '2025-04-21 07:10:55'),
(6, 6, 3, '2025-04-21 19:15:06', '2025-04-21 19:15:06'),
(7, 7, 1, '2025-04-21 19:32:19', '2025-04-21 19:32:19'),
(8, 8, 1, '2025-04-21 21:30:29', '2025-04-21 21:30:29'),
(9, 9, 2, '2025-04-21 21:39:42', '2025-04-21 21:39:42'),
(10, 11, 5, '2025-04-22 00:17:18', '2025-04-22 00:17:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `majors_id` (`majors_id`);

--
-- Indexes for table `learning_moduls`
--
ALTER TABLE `learning_moduls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructur_id` (`instructor_id`);

--
-- Indexes for table `learning_modul_details`
--
ALTER TABLE `learning_modul_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learning_modul_id` (`learning_modul_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors_detail`
--
ALTER TABLE `majors_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`user_id`),
  ADD KEY `majors_id` (`majors_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `majors_id` (`majors_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `learning_moduls`
--
ALTER TABLE `learning_moduls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `learning_modul_details`
--
ALTER TABLE `learning_modul_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `majors_detail`
--
ALTER TABLE `majors_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `instructors_ibfk_2` FOREIGN KEY (`majors_id`) REFERENCES `majors` (`id`);

--
-- Constraints for table `learning_moduls`
--
ALTER TABLE `learning_moduls`
  ADD CONSTRAINT `learning_moduls_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`);

--
-- Constraints for table `learning_modul_details`
--
ALTER TABLE `learning_modul_details`
  ADD CONSTRAINT `learning_modul_details_ibfk_1` FOREIGN KEY (`learning_modul_id`) REFERENCES `learning_moduls` (`id`);

--
-- Constraints for table `majors_detail`
--
ALTER TABLE `majors_detail`
  ADD CONSTRAINT `majors_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `majors_detail_ibfk_2` FOREIGN KEY (`majors_id`) REFERENCES `majors` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`majors_id`) REFERENCES `majors` (`id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
