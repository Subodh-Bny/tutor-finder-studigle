-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 05:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutor_finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Subodh Adhikari', 'subodh', '7a0781fa161ce363c8d44b3033893632'),
(2, 'Mahesh Bhandari', 'mahesh', '7a0781fa161ce363c8d44b3033893632'),
(4, 'Subodh', 'subodh@gmail.com', '7a0781fa161ce363c8d44b3033893632');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `sent_at`, `is_read`) VALUES
(320, 48, 47, 'Hi👋', '2024-04-01 16:57:08', 0),
(321, 47, 48, 'Hi👋', '2024-04-01 16:57:20', 0),
(322, 47, 48, 'hello', '2024-04-01 16:57:26', 0),
(323, 48, 47, 'how are you?', '2024-04-01 16:57:37', 0),
(324, 47, 48, 'Hi👋', '2024-04-02 03:44:55', 0),
(325, 47, 48, 'Hi👋', '2024-04-02 04:03:39', 0),
(326, 46, 49, 'Hi👋', '2024-04-02 04:03:52', 0),
(327, 47, 48, 'Hi👋', '2024-04-02 04:06:17', 0),
(328, 47, 48, 'Hi👋', '2024-04-02 04:06:17', 0),
(329, 47, 46, 'Hi👋', '2024-04-02 04:08:41', 0),
(330, 47, 48, 'hyy', '2024-04-02 04:12:42', 0),
(331, 46, 47, 'Hi👋', '2024-04-02 04:18:27', 0),
(332, 46, 49, 'Hi👋', '2024-04-02 04:18:32', 0),
(333, 46, 49, 'Hi👋', '2024-04-02 08:48:59', 0),
(334, 46, 49, 'Hi👋', '2024-04-02 08:52:46', 0),
(335, 47, 48, 'Hi👋', '2024-04-06 05:45:29', 0),
(336, 47, 48, 'hello sir', '2024-04-06 05:45:42', 0),
(337, 47, 48, 'no reply', '2024-04-06 05:45:54', 0),
(338, 47, 48, 'why sirr😭😭', '2024-04-06 05:46:09', 0),
(339, 46, 47, 'Hi👋', '2024-04-11 03:36:12', 0),
(340, 46, 47, 'sdfsd', '2024-04-11 03:36:16', 0),
(341, 51, 43, 'Hi👋', '2024-05-21 02:57:29', 0),
(342, 43, 51, 'hajur', '2024-05-21 02:57:37', 0),
(343, 51, 43, 'k xa', '2024-05-21 03:01:03', 0),
(344, 43, 51, 'thikai xa', '2024-05-21 03:01:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `tutor_id`, `student_id`, `rating`, `review`, `created_at`) VALUES
(71, 9, 19, 4.00, 'nice', '2024-04-02 04:20:36'),
(72, 11, 18, 4.00, 'he is good teacher', '2024-05-21 02:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `request_date` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `student_id`, `tutor_id`, `request_date`, `status`) VALUES
(189, 49, 48, '2024-04-01 22:56:03', 'accepted'),
(216, 47, 46, '2024-04-06 11:46:18', 'accepted'),
(217, 47, 48, '2024-04-11 09:19:23', 'sent'),
(218, 43, 51, '2024-05-21 08:40:52', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `grade_level` varchar(50) DEFAULT NULL,
  `subjects_needed` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `grade_level`, `subjects_needed`) VALUES
(18, 43, '', NULL),
(19, 47, NULL, NULL),
(20, 49, NULL, NULL),
(21, 50, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `tutor_id`, `subject`) VALUES
(12, 9, 'Web Technology'),
(13, 9, 'Web Technology'),
(14, 10, 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `user_id`, `bio`, `availability`, `hourly_rate`) VALUES
(9, 46, '', '', 0.00),
(10, 48, '', '', 0.00),
(11, 51, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `useractivity`
--

CREATE TABLE `useractivity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_type` enum('Login','Registration','Profile Update','Password Change','Email Change','Other') NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `activity_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useractivity`
--

INSERT INTO `useractivity` (`activity_id`, `user_id`, `activity_type`, `activity_date`, `activity_details`) VALUES
(6, NULL, 'Registration', '2024-02-24 11:33:16', 'Sumit Adhikari registered to the system as a student'),
(7, NULL, 'Registration', '2024-02-24 11:34:32', 'Bikash Parajuli registered to the system as a tutor'),
(8, NULL, 'Registration', '2024-02-24 13:59:21', 'Susan Thapa registered to the system as a student'),
(9, NULL, 'Registration', '2024-02-24 14:38:05', 'Surya Adhikari registered to the system as a tutor'),
(10, NULL, 'Profile Update', '2024-02-25 14:50:32', 'Sumit Adhikari updated his profile'),
(11, NULL, 'Registration', '2024-02-26 13:08:14', 'Shishir Dhakal registered to the system as a student'),
(12, NULL, 'Registration', '2024-02-27 14:17:23', 'Bikash Parajuli registered to the system as a tutor'),
(13, NULL, 'Registration', '2024-02-28 14:01:56', 'Kiran Ghimire registered to the system as a tutor'),
(16, NULL, 'Profile Update', '2024-03-02 16:07:26', 'Bikash Parajuli updated his profile'),
(17, NULL, 'Profile Update', '2024-03-02 16:08:21', 'Bikash Parajuli updated his profile'),
(18, NULL, 'Registration', '2024-03-02 16:14:02', 'Sabin Adhikari registered to the system as a student'),
(19, NULL, 'Profile Update', '2024-03-02 16:16:19', 'Sabin Adhikari updated his profile'),
(20, NULL, 'Registration', '2024-03-05 02:48:28', 'Shishir Wangdu registered to the system as a student'),
(21, NULL, 'Registration', '2024-03-05 14:18:46', 'Bijay Babu Regmi registered to the system as a tutor'),
(22, NULL, 'Profile Update', '2024-03-05 14:19:43', 'Bijay Babu Regmi updated his profile'),
(23, NULL, 'Registration', '2024-03-05 14:28:35', 'Ram Narayan Bramha registered to the system as a tutor'),
(24, NULL, 'Profile Update', '2024-03-05 14:30:12', 'Ram Narayan Bramha updated his profile'),
(27, NULL, 'Registration', '2024-03-14 10:11:06', 'subodh registered to the system as a student'),
(28, NULL, 'Registration', '2024-03-14 10:24:10', 'subodh registered to the system as a student'),
(29, NULL, 'Registration', '2024-03-14 10:26:10', 'subodh registered to the system as a student'),
(31, NULL, 'Registration', '2024-03-14 10:46:08', 'sabui registered to the system as a student'),
(32, NULL, 'Registration', '2024-03-14 11:05:50', 'Sumit Adhikari registered to the system as a student'),
(33, NULL, 'Registration', '2024-03-14 11:09:22', 'subodh registered to the system as a student'),
(34, NULL, 'Registration', '2024-03-14 11:11:23', 'subodh registered to the system as a student'),
(35, NULL, 'Registration', '2024-03-14 11:21:36', 'Subodh Adhikari registered to the system as a student'),
(36, NULL, 'Registration', '2024-03-14 11:49:26', 'student registered to the system as a student'),
(37, 43, 'Registration', '2024-03-14 16:11:06', 'student registered to the system as a student'),
(38, NULL, 'Registration', '2024-03-14 16:11:52', 'tutor registered to the system as a tutor'),
(39, NULL, 'Registration', '2024-03-15 02:04:19', 'Bikash Parajuli registered to the system as a tutor'),
(40, NULL, 'Profile Update', '2024-04-01 12:48:09', 'John Doe updated his profile'),
(41, NULL, 'Profile Update', '2024-04-01 12:50:58', 'John Doe updated his profile'),
(42, NULL, 'Profile Update', '2024-04-01 12:52:21', 'John Doe updated his profile'),
(43, NULL, 'Profile Update', '2024-04-01 13:15:00', 'John Doe updated his profile'),
(44, 46, 'Registration', '2024-04-01 14:26:46', 'Bikash Parajuli registered to the system as a tutor'),
(45, 47, 'Registration', '2024-04-01 14:27:27', 'Sumit Adhikari registered to the system as a student'),
(46, 46, 'Profile Update', '2024-04-01 15:06:09', 'Bikash Parajuli updated his profile'),
(47, 46, 'Profile Update', '2024-04-01 15:11:53', 'Bikash Parajuli updated his profile'),
(48, 48, 'Registration', '2024-04-01 15:12:30', 'Kiran Ghimire registered to the system as a tutor'),
(49, 48, 'Profile Update', '2024-04-01 16:12:14', 'Kiran Ghimire updated his profile'),
(50, 49, 'Registration', '2024-04-01 17:10:39', 'sabin registered to the system as a student'),
(51, 50, 'Registration', '2024-05-21 02:43:54', 'Shyam Bahadur Rana registered to the system as a student'),
(52, 51, 'Registration', '2024-05-21 02:45:15', 'Hari Bahadur Rana registered to the system as a tutor'),
(53, 43, 'Profile Update', '2024-05-21 03:08:15', 'student updated his profile');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`) VALUES
(43, 'Subodh', 9800000001, 'student@gmail.com', 'nepal123C@', 'student'),
(46, 'Bikash Parajuli', 9800000000, 'bikash@gmail.com', '7a0781fa161ce363c8d44b3033893632', 'tutor'),
(47, 'Sumit Adhikari', 9811111111, 'sumit@gmail.com', '7a0781fa161ce363c8d44b3033893632', 'student'),
(48, 'Kiran Ghimire', 9999999999, 'kiran@gmail.com', '7a0781fa161ce363c8d44b3033893632', 'tutor'),
(49, 'sabin', 9999999999, 'sabin@gmail.com', '7a0781fa161ce363c8d44b3033893632', 'student'),
(50, 'Shyam Bahadur Rana', 9800000000, 'shyam@gmail.com', '7a0781fa161ce363c8d44b3033893632', 'student'),
(51, 'Hari Bahadur Rana', 9800000000, 'hari@gmail.com', '7a0781fa161ce363c8d44b3033893632', 'tutor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `tutor_id` (`tutor_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutor_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `useractivity`
--
ALTER TABLE `useractivity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `useractivity`
--
ALTER TABLE `useractivity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`user_id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`);

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `useractivity`
--
ALTER TABLE `useractivity`
  ADD CONSTRAINT `useractivity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
