-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 10:13 AM
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
-- Database: `taskforge`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('To-Do','In-Progress','Done') DEFAULT 'To-Do',
  `status_id` int(11) DEFAULT 1,
  `assigned_to` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `position` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `due_date`, `status`, `status_id`, `assigned_to`, `created_at`, `updated_at`, `position`) VALUES
(2, 'nacbsjsdavfsfavf', 'sdvadaaaaaaaaaaah', '0045-03-04', 'In-Progress', 1, NULL, '2025-03-28 01:46:59', '2025-04-12 08:54:56', 0),
(6, 'vdse234', 'f42dw', '0001-03-02', 'Done', 1, NULL, '2025-03-28 04:54:04', '2025-04-12 10:26:04', 0),
(7, 'bvjkda z zdc', 'wvwew', '0022-03-21', 'To-Do', 1, NULL, '2025-03-28 05:33:21', '2025-03-28 05:33:21', 0),
(8, 'jod', 'ghdasr241', '0023-02-24', 'To-Do', 1, NULL, '2025-03-28 06:02:36', '2025-03-28 06:02:36', 0),
(9, 'Morning task ', 'Have to done lost codding part', '2025-05-24', 'In-Progress', 1, NULL, '2025-04-12 10:24:13', '2025-04-12 10:26:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_statuses`
--

CREATE TABLE `task_statuses` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_statuses`
--

INSERT INTO `task_statuses` (`id`, `status_name`, `description`) VALUES
(1, 'To-Do', 'Task is pending and not yet started'),
(2, 'In-Progress', 'Task is currently being worked on'),
(3, 'Done', 'Task is completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Krishan', 'Krishan123@gmail.com', '$2y$10$Wvp7bgQxyMeG3gdRMpuUI.RJaw3O0Lc6qbiliVpZ3u8MxfUT4Uune', 1, '2025-03-28 01:43:51', '2025-04-12 09:21:35'),
(2, 'Krish', 'Krish123@gmail.com', '$2y$10$jGNhKdUiiNz3QDRSd0ih2OKUo1LuWznw8HYMzYqUfrEsOmFp/JIKq', 2, '2025-03-28 01:46:20', '2025-04-12 09:22:56'),
(3, 'loocha', 'loocha123@gmail.com', '$2y$10$uH6xe9uMheVHSR/bouH9s.zPp9nktiyMJ8uEF5qZL1NzKAJTjg8QC', 3, '2025-03-28 01:54:46', '2025-03-28 01:54:46'),
(4, 'Happy', 'happy123@gmail.com', '$2y$10$1j5xqrXieziUy3LNzB0FAuutR7I4t08v17KeIOFAmCl8Hj2xSu4Um', 2, '2025-03-28 03:37:35', '2025-03-28 03:37:35'),
(5, 'Molly', 'Molly123@gmail.com', '$2y$10$B1QvTNdT7/2/6OeCerv1auwN6QWDwhogq6xuPI7LQ4u4bYmb40.We', 2, '2025-03-28 06:01:46', '2025-03-28 06:01:46'),
(6, 'Kohli', 'kohli123@gmail.com', '$2y$10$FVJzBRoLc.PkdmOYRyRXFeq4AWLtWaa9N9kcUHn6KY5ijn1v7179G', 3, '2025-04-12 08:52:39', '2025-04-12 08:52:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assigned_user` (`assigned_to`),
  ADD KEY `fk_status` (`status_id`);

--
-- Indexes for table `task_statuses`
--
ALTER TABLE `task_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_name` (`status_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task_statuses`
--
ALTER TABLE `task_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_assigned_user` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
