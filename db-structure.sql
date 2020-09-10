-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 10:18 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `prf`
--
CREATE DATABASE IF NOT EXISTS `prf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `prf`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `a_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `a_name`, `is_deleted`, `added_on`, `updated_on`) VALUES
(1, 'tim', 0, '2020-09-10 11:00:29', NULL),
(2, 'tim buchalka', 0, '2020-09-10 11:02:01', NULL),
(3, 'limor', 0, '2020-09-10 11:13:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `a_id` int(11) NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `b_name`, `a_id`, `is_deleted`, `added_on`, `updated_on`) VALUES
(1, 'Python Programming', 1, 0, '2020-09-10 11:00:29', '2020-09-10 13:12:12'),
(2, 'learn python online', 2, 0, '2020-09-10 11:02:01', '2020-09-10 20:15:29'),
(3, 'Mentorship', 3, 1, '2020-09-10 11:13:24', '2020-09-10 13:14:21'),
(4, 'mentor', 1, 0, '2020-09-10 17:59:16', NULL),
(5, 'Learning python', 1, 0, '2020-09-10 18:11:47', '2020-09-10 21:08:16'),
(6, 'mentoring', 3, 0, '2020-09-10 18:34:00', NULL),
(7, 'mentorship program', 3, 0, '2020-09-10 19:07:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `a_name` (`a_name`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_id` (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
