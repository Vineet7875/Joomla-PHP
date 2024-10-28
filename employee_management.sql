-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 03:54 AM
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
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `authenticatedusers`
--

CREATE TABLE `authenticatedusers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authenticatedusers`
--

INSERT INTO `authenticatedusers` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(33, 'sachin', 'sachin7875@gmail.com', '$2y$10$GodAI6SYI1Dy2BWyroqGxuutHr8sumGj5qdwDeHkUsi6siSOdaKeW', '2024-10-26 22:45:25', '2024-10-26 22:45:25'),
(40, 'Vineet Rajanikant Jadhav', 'sachi7875@gmail.com', '$2y$10$WUNE4RJwin0IrVI44tJ2IOqaC52kd6M7D2ISRnIFMW1OIwb9DO5B6', '2024-10-27 16:37:14', '2024-10-27 16:37:14'),
(46, 'aniket', 'aniket@gmail.com', '$2y$10$ZILhBrAgNqQnAZepzsfl3uhW.lxn3zdZ4W9HjTdHtcDTmkOjft6Oi', '2024-10-27 18:39:37', '2024-10-27 18:39:37'),
(47, 'nilesh', 'nilesh@gmail.com', '$2y$10$spz9Ec9PgJNERgvG5M2o1Oq1LPCDLIkyJ5AOzrqofZQF1RXApx8tq', '2024-10-27 21:53:20', '2024-10-27 21:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `department`, `designation`, `created_at`, `updated_at`) VALUES
(29, 'mayuri jadhav', 'shet7875@gmail.com', '$2y$10$BFCM7L83GokUhqYad0IpZeauPa7UgdNFMAt1CK9apYdd0e5flocm6', 'entc', 'tester', '2024-10-27 20:15:43', '2024-10-27 20:15:43'),
(31, 'nilesh', 'nilesh@gmail.com', '$2y$10$XPrEYXTiHBU74QThnNPjE.o4AuR7jC1f6l4EDgKW8GlwDiroQ/p7q', 'sd', 'sd', '2024-10-27 21:55:04', '2024-10-27 21:55:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authenticatedusers`
--
ALTER TABLE `authenticatedusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authenticatedusers`
--
ALTER TABLE `authenticatedusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
