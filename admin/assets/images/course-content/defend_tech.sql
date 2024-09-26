-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 01:40 AM
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
-- Database: `defend_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `b_id` bigint(20) NOT NULL,
  `bc_id` bigint(20) NOT NULL,
  `blog_title` varchar(50) NOT NULL,
  `blog_author` varchar(100) NOT NULL,
  `blog_content` longtext NOT NULL,
  `b_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `bc_id` bigint(20) NOT NULL,
  `bc_name` varchar(50) NOT NULL,
  `bc_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` bigint(20) NOT NULL,
  `cc_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `course_title` varchar(250) NOT NULL,
  `course_author` varchar(100) NOT NULL,
  `course_subtext` text NOT NULL,
  `course_badge` varchar(20) NOT NULL,
  `course_level` varchar(20) NOT NULL,
  `course_cost` float(10,2) NOT NULL,
  `course_image` longblob NOT NULL,
  `course_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `cc_id`, `user_id`, `course_title`, `course_author`, `course_subtext`, `course_badge`, `course_level`, `course_cost`, `course_image`, `course_status`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 'Introduction to Cybersecurity', 'Dr. Emily Richards', 'Learn the fundamental concepts of cybersecurity, including common threats and protective measures.', 'Free', 'Beginner', 0.00, 0x73656375726974797468726561746973746f636b303030303231383338333635616c6578736b6f706a652e6a7067, 1, '2024-07-23 21:47:50', '2024-07-23 21:47:50'),
(2, 1, 9, 'Cybersecurity for Beginners', 'Mr. John Harrison', 'A beginner-friendly course focusing on essential cybersecurity practices for daily online activities.', 'Bestseller', 'Beginner', 49.99, '', 1, '2024-07-23 21:47:50', '2024-07-23 21:47:50'),
(3, 2, 10, 'Recognizing Phishing Attacks', 'Ms. Sophia Carter', 'Understand the nature of phishing attacks and learn to identify and avoid them', 'Free', 'Beginner', 0.00, '', 1, '2024-09-11 21:08:31', '2024-09-11 21:08:31'),
(4, 2, 11, 'Malware and Ransomware Protection', 'Dr. David Nguyen', 'Phishing techniques, real-life examples, prevention strategies', 'Highest rated', 'Intermediate', 59.99, '', 1, '2024-09-11 21:08:31', '2024-09-11 21:08:31'),
(6, 3, 12, 'Building Strong Passwords', '', 'Focuses on the fundamentals of password strength and management, suitable for new learners.', 'Bestseller', 'Beginner', 0.00, '', 0, '2024-09-25 18:27:54', '2024-09-25 18:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `cc_id` bigint(20) NOT NULL,
  `cc_name` varchar(50) NOT NULL,
  `cc_allias` varchar(20) NOT NULL,
  `cc_image` longblob NOT NULL,
  `cc_status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`cc_id`, `cc_name`, `cc_allias`, `cc_image`, `cc_status`, `created_at`, `updated_at`) VALUES
(1, 'Cybersecurity Awareness', 'Basics', 0x6261736963732e6a7067, 1, '2024-07-23 14:25:29', '2024-07-23 14:25:29'),
(2, 'Identifying Cyber Threats', 'Threats', 0x73656375726974797468726561746973746f636b303030303231383338333635616c6578736b6f706a652e6a7067, 1, '2024-07-23 14:25:29', '2024-07-23 14:25:29'),
(3, 'Proactive Cybersecurity Habits', 'Habits', '', 1, '2024-07-23 14:25:29', '2024-07-23 14:25:29'),
(4, 'Interactive Learning Tools', 'Learning', '', 1, '2024-07-23 14:25:29', '2024-07-23 14:25:29'),
(5, 'Cybersecurity Challenges', 'Challenges', '', 1, '2024-07-23 14:27:11', '2024-07-23 14:27:11'),
(6, 'User Perceptions and Insights', 'Insights', '', 1, '2024-07-23 14:27:11', '2024-07-23 14:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `cct_id` bigint(20) NOT NULL,
  `content_title` varchar(50) NOT NULL,
  `content_duration` varchar(10) NOT NULL,
  `content_type` tinyint(4) NOT NULL,
  `content_link` longtext NOT NULL,
  `cct_status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_detail`
--

CREATE TABLE `course_detail` (
  `cd_id` bigint(20) NOT NULL,
  `cd_learning` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cd_learning`)),
  `cd_requirements` text DEFAULT NULL,
  `cd_description` longtext NOT NULL,
  `cd_duration` varchar(10) NOT NULL,
  `cd_lectures` int(3) NOT NULL,
  `cd_resources` int(3) NOT NULL,
  `cd_users` int(10) NOT NULL,
  `cd_certificate` tinyint(1) NOT NULL,
  `cd_status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_review`
--

CREATE TABLE `course_review` (
  `cr_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `review` longtext NOT NULL,
  `rating` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_review`
--

INSERT INTO `course_review` (`cr_id`, `course_id`, `user_id`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Good lectures', 4, 1, '2024-07-24 22:53:53', '2024-07-24 22:53:53'),
(2, 2, 2, 'loved to learn about different solutions to protect from cyber threats', 5, 1, '2024-07-24 22:53:53', '2024-07-24 22:53:53'),
(3, 3, 1, 'Good technical knowledge', 3, 1, '2024-07-24 22:53:53', '2024-07-24 22:53:53'),
(4, 4, 2, 'teacher\'s interaction was quite good', 4, 1, '2024-07-24 22:53:53', '2024-07-24 22:53:53'),
(5, 6, 5, 'overall good content', 5, 1, '2024-07-24 22:53:53', '2024-07-24 22:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(14) NOT NULL,
  `comments` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `t_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `comments` longtext NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(14) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `contact_no`, `designation`, `gender`, `status`, `created_at`, `updated_at`, `password`) VALUES
(2, 'isha', 'patel', 'isha@patel.com', '1234567890', 'student', 'female', 1, '2024-06-26 14:53:04', '2024-06-26 14:53:04', 'e687a949c6e627b821191fa5d3bf277241faa415'),
(3, 'Admin', 'Panel', 'admin@gmail.com', '2132456753', 'admin', 'female', 1, '2024-09-19 15:20:33', '2024-09-19 15:20:33', 'db91c1c261d2a9f1ba7c1c68f5c147c9420f11f7'),
(8, 'Dr. Emily', 'Richards', 'emily@gmail.com', '4321546438', 'tutor', 'female', 0, '2024-09-25 10:38:50', '2024-09-25 10:38:50', '3140a19b46850b6a9f8b74fa5f545bf7a29874ff'),
(9, 'Mr. John', 'Harrison', 'john@gmail.com', '3210034452', 'tutor', 'male', 0, '2024-09-25 10:39:55', '2024-09-25 10:39:55', '3140a19b46850b6a9f8b74fa5f545bf7a29874ff'),
(10, 'Ms. Sophia', 'Carter', 'sophia@gmail.com', '4321123300', 'tutor', 'female', 0, '2024-09-25 10:43:03', '2024-09-25 10:43:03', '3140a19b46850b6a9f8b74fa5f545bf7a29874ff'),
(11, 'Dr. David', 'Nguyen', 'david@gmail.com', '8002311032', 'tutor', 'male', 0, '2024-09-25 10:43:58', '2024-09-25 10:43:58', '3140a19b46850b6a9f8b74fa5f545bf7a29874ff'),
(12, 'Mr. Adam', 'Scott', 'adam@gmail.com', '9803445120', 'tutor', 'male', 0, '2024-09-25 18:06:09', '2024-09-25 18:06:09', '3140a19b46850b6a9f8b74fa5f545bf7a29874ff'),
(13, 'Ms. Rebecca', 'Jones', 'rebecca@gmail.com', '3212346590', 'tutor', 'female', 0, '2024-09-25 18:09:27', '2024-09-25 18:09:27', '3140a19b46850b6a9f8b74fa5f545bf7a29874ff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`bc_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`cct_id`);

--
-- Indexes for table `course_detail`
--
ALTER TABLE `course_detail`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `course_review`
--
ALTER TABLE `course_review`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `b_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `bc_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `cc_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `cct_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_detail`
--
ALTER TABLE `course_detail`
  MODIFY `cd_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_review`
--
ALTER TABLE `course_review`
  MODIFY `cr_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquiry_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `t_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
