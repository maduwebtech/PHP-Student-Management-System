-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 07:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comsatsmzd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_role`) VALUES
(1, 'Admin', 'admin@maduwebtech.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_duration` varchar(100) NOT NULL,
  `course_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_duration`, `course_fee`) VALUES
(1, 'Web Development', '3 Months', 2500),
(2, 'Graphic Design', '3 Months', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `fee_tbl`
--

CREATE TABLE `fee_tbl` (
  `id` int(11) NOT NULL,
  `std_id` varchar(100) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `submit_fee` varchar(100) NOT NULL,
  `fee_date` date DEFAULT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_tbl`
--

INSERT INTO `fee_tbl` (`id`, `std_id`, `std_name`, `submit_fee`, `fee_date`, `remarks`) VALUES
(1, '1', 'Muddsar Qayyum', '2000', '2023-05-28', 'Monthly+Admission'),
(2, '1', 'Muddsar Qayyum', '2000', '2023-05-28', 'Monthly'),
(3, '1', 'Muddsar Qayyum', '2000', '2023-05-28', 'Monthly'),
(4, '2', 'madu', '5000', '2023-05-28', 'Monthly');

-- --------------------------------------------------------

--
-- Table structure for table `students_tbl`
--

CREATE TABLE `students_tbl` (
  `comsats_id` int(11) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `id_card` text NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `phone_I` varchar(100) NOT NULL,
  `phone_II` varchar(100) NOT NULL,
  `std_photo` varchar(255) NOT NULL,
  `p_address` text NOT NULL,
  `t_address` text NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date DEFAULT NULL,
  `total_fee` varchar(100) NOT NULL,
  `add_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_tbl`
--

INSERT INTO `students_tbl` (`comsats_id`, `std_name`, `father_name`, `id_card`, `qualification`, `course_id`, `phone_I`, `phone_II`, `std_photo`, `p_address`, `t_address`, `start_date`, `end_date`, `total_fee`, `add_info`) VALUES
(1, 'Muddsar Qayyum', 'Abdul Qayyum Khan', '8230123456789', 'BSCS', 1, '03485603534', '03485603534', 'profile403428052023.png', 'Lower Chatter Muzaffarabad', 'Lower Chatter', '2023-05-28', '2023-05-31', '10000', 'New Admission'),
(2, 'madu', 'Abdul Qayyum Khan', '911762162612615', 'BSCS', 2, '101982718271', '123123123123', '5552728052023.png', 'Lower Chatter Muzaffarabad', 'abbaspur', '2023-05-28', '0000-00-00', '20000', 'New Student');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_tbl`
--

CREATE TABLE `teachers_tbl` (
  `comsats_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `id_card` varchar(20) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `course` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `joining_date` date NOT NULL,
  `add_info` text NOT NULL,
  `leave_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers_tbl`
--

INSERT INTO `teachers_tbl` (`comsats_id`, `fullname`, `father_name`, `id_card`, `qualification`, `phone`, `address`, `course`, `photo`, `joining_date`, `add_info`, `leave_date`) VALUES
(1, 'Umar Anwar', 'Anwar Khan', '8230123456789', 'FSC', '03122524524', 'Post Office Abbaspur District Poonch AJK', 2, '', '2023-05-01', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `fee_tbl`
--
ALTER TABLE `fee_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD PRIMARY KEY (`comsats_id`);

--
-- Indexes for table `teachers_tbl`
--
ALTER TABLE `teachers_tbl`
  ADD PRIMARY KEY (`comsats_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_tbl`
--
ALTER TABLE `fee_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_tbl`
--
ALTER TABLE `students_tbl`
  MODIFY `comsats_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers_tbl`
--
ALTER TABLE `teachers_tbl`
  MODIFY `comsats_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
