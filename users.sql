-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 09:19 PM
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
-- Database: `shopage`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(9, 'Kamal Azzouzi', 'kamal@gmail.com', '5cc5d8d4c7115f1c96c2983ec0d0f8a0f9dab596', '2024-05-05 17:06:58'),
(10, 'User2', 'user2@gmail.com', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', '2024-05-05 19:27:34'),
(13, 'john_doe', 'john.doe@example.com', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', '2024-05-22 16:15:46'),
(16, 'jane_smith', 'jane.smith@gmail.com', '9119d6a820c5bd916857b03a71318176ad57bfb7', '2024-05-22 16:18:57'),
(18, 'mike_jackson', 'mike_jackson@gmail.com', '9f24eb5fea9dd0e4c4d431de86d07be869613d22', '2024-05-22 16:19:53'),
(19, 'Kamal2003', 'kamal2003@gmail.com', '5cc5d8d4c7115f1c96c2983ec0d0f8a0f9dab596', '2024-06-25 15:34:28'),
(20, 'Mosab', 'mosab@gmail.com', 'ff715585a9b97d14c929d218e3c7fb85dcd06219', '2024-06-26 08:49:59'),
(21, 'Kamal_Azzouzi', 'kamal1234@gmail.com', '5cc5d8d4c7115f1c96c2983ec0d0f8a0f9dab596', '2024-06-26 10:29:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
