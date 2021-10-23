-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 11:28 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrmodule`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'shrikant', 'asd'),
(2, 'padmin', 'asd'),
(3, 'cadmin', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `eid` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `eid`, `date`, `time`) VALUES
(27, 'S350', '2021-03-28', '08:18:00'),
(28, 'S730', '2021-03-28', '08:20:00'),
(29, 'S932', '2021-03-28', '07:00:00'),
(30, 'S427', '2021-03-28', '07:04:00'),
(31, 'S350', '2021-03-28', '18:15:00'),
(32, 'S730', '2021-03-28', '18:15:00'),
(33, 'S932', '2021-03-28', '18:15:00'),
(34, 'S427', '2021-03-28', '18:15:00'),
(35, 'S730', '2021-04-18', '06:28:00'),
(36, 'S730', '2021-04-18', '18:00:00'),
(37, 'S730', '2021-04-19', '06:00:00'),
(38, 'S730', '2021-04-19', '18:00:00'),
(39, 'S730', '2021-04-26', '06:00:00'),
(40, 'S730', '2021-04-26', '18:00:00'),
(41, 'P521', '2021-04-19', '07:01:00'),
(42, 'P521', '2021-04-19', '19:01:00'),
(43, 'P521', '2021-04-20', '07:01:00'),
(44, 'P521', '2021-04-20', '21:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `chart_data`
--

CREATE TABLE `chart_data` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(10) NOT NULL,
  `ontime` int(255) NOT NULL,
  `late` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_data`
--

INSERT INTO `chart_data` (`id`, `date`, `day`, `ontime`, `late`) VALUES
(1, '2021-03-23', 'mon', 5, 5),
(2, '2021-03-16', 'tue', 1, 1),
(3, '2021-03-17', 'wed', 0, 1),
(4, '2021-03-23', 'thu', 4, 6),
(5, '2021-03-26', 'fri', 6, 4),
(6, '2021-03-27', 'sat', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cs_worker`
--

CREATE TABLE `cs_worker` (
  `id` int(10) NOT NULL,
  `cs_id` varchar(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `position` varchar(15) NOT NULL,
  `sal` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `Shift` int(10) NOT NULL,
  `isLate` int(10) NOT NULL,
  `leaves` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cs_worker`
--

INSERT INTO `cs_worker` (`id`, `cs_id`, `firstname`, `lastname`, `address`, `dob`, `gender`, `email`, `phone`, `position`, `sal`, `photo`, `Shift`, `isLate`, `leaves`) VALUES
(1, 'C521', 'Shrikant', 'pandhekar', 'cidco', '2021-03-03', 'Male', 'pandhekar.shrikant@gmail.com', '9370268256', 'Empoly', '120000', 'vector.png', 2, 0, 0),
(3, 'C107', 'gayatri', 'dalvi', 'aurangabad', '2021-04-09', 'Female', 'gayatridalvi@gmail.com', '66011000', 'manager', '15000', 'vector.png', 3, 0, 6),
(4, 'C783', 'Preshita', 'Jaiswal', 'aurangabad', '2021-04-03', 'Female', 'preshitajais@gmail.com', '66011000', 'Empoly', '3000', 'ajanta2.jpg.jpg', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dummy_data`
--

CREATE TABLE `dummy_data` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dummy_data`
--

INSERT INTO `dummy_data` (`id`, `emp_id`, `date`, `time`) VALUES
(61, 'S730', '2021-03-16', '07:00:00'),
(62, 'S932', '2021-03-16', '07:00:32'),
(63, 'S730', '2021-03-16', '13:05:00'),
(64, 'S932', '2021-03-16', '14:00:32'),
(65, 'S730', '2021-03-16', '14:15:00'),
(66, 'S932', '2021-03-16', '14:00:32'),
(67, 'S730', '2021-03-16', '17:12:43'),
(68, 'S932', '2021-03-16', '17:20:23'),
(69, 'S730', '2021-03-17', '07:03:00'),
(70, 'S730', '2021-03-17', '14:20:32'),
(71, 'S730', '2021-03-17', '15:15:00'),
(72, 'S730', '2021-03-17', '17:20:23'),
(73, 'S730', '2021-03-21', '08:00:54'),
(74, 'S932', '2021-03-21', '05:10:54'),
(75, 'S730', '2021-03-21', '18:00:54'),
(76, 'S932', '2021-03-21', '17:15:00'),
(78, 'S932', '2021-03-23', '09:00:54'),
(79, 'S932', '2021-03-23', '18:15:00'),
(80, 'P028', '2021-03-26', '07:04:00'),
(81, 'P028', '2021-03-26', '13:00:45'),
(82, 'P028', '2021-03-26', '14:15:00'),
(83, 'P028', '2021-03-26', '15:12:34'),
(84, 'P340', '2021-03-27', '06:15:00'),
(85, 'P028', '2021-03-27', '07:15:32'),
(86, 'P340', '2021-03-27', '13:15:00'),
(87, 'P028', '2021-03-27', '13:04:45'),
(88, 'P340', '2021-03-27', '14:10:00'),
(89, 'P028', '2021-03-27', '14:00:32'),
(90, 'P340', '2021-03-27', '17:12:43'),
(91, 'P028', '2021-03-27', '17:20:23'),
(92, 'C521', '2021-04-20', '07:00:00'),
(93, 'C521', '2021-04-20', '12:00:00'),
(94, 'C521', '2021-04-20', '13:00:00'),
(95, 'C521', '2021-04-20', '19:00:00'),
(96, 'C107', '2021-04-20', '08:00:00'),
(97, 'C107', '2021-04-20', '13:00:00'),
(98, 'C107', '2021-04-20', '14:00:00'),
(99, 'C107', '2021-04-20', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `emp_shifttime`
--

CREATE TABLE `emp_shifttime` (
  `id` int(11) NOT NULL,
  `emp_type` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `buffer_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_shifttime`
--

INSERT INTO `emp_shifttime` (`id`, `emp_type`, `start_time`, `end_time`, `buffer_time`) VALUES
(1, 'staff', '07:00:00', '19:00:00', 5),
(2, 'p_worker', '07:00:00', '19:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `srno` int(11) NOT NULL,
  `Staff_ID` varchar(100) NOT NULL,
  `Leave_Type` varchar(100) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Reason` varchar(100) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Date/Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`srno`, `Staff_ID`, `Leave_Type`, `StartDate`, `EndDate`, `StartTime`, `EndTime`, `Reason`, `Status`, `Date/Time`) VALUES
(6, 'S730', 'whole', '2021-02-28', '0000-00-00', '00:00:00', '00:00:00', 'xyz', 'pending', '2021-02-28 06:47:02'),
(7, 'S730', 'whole', '2021-03-01', '0000-00-00', '00:00:00', '00:00:00', 'ghsdg', 'pending', '2021-03-01 06:04:45'),
(8, 'S730', 'whole', '2021-03-10', '0000-00-00', '00:00:00', '00:00:00', 'hgjgj', 'pending', '2021-03-16 10:06:01'),
(9, 'S730', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'xcxc', 'pending', '2021-04-19 18:41:28'),
(10, 'S730', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'asd', 'pending', '2021-04-19 18:42:04'),
(11, 'S932', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'wer', 'pending', '2021-04-19 18:42:58'),
(12, 'S932', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'wer', 'pending', '2021-04-19 18:43:33'),
(13, 'P028', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'asderftgyujik', 'pending', '2021-04-19 19:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `p_worker`
--

CREATE TABLE `p_worker` (
  `id` int(10) NOT NULL,
  `pw_id` varchar(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `position` varchar(15) NOT NULL,
  `sal` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `isLate` int(10) NOT NULL,
  `leaves` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_worker`
--

INSERT INTO `p_worker` (`id`, `pw_id`, `firstname`, `lastname`, `address`, `dob`, `gender`, `email`, `phone`, `position`, `sal`, `photo`, `isLate`, `leaves`) VALUES
(1, 'P028', 'Shrikant', 'pandhekar', 'cidco', '2021-03-03', 'Male', 'pandhekar.shrikant@gmail.com', '9370268256', 'Empolyee', '120000', 'vector.png', 1, 0),
(2, 'P340', 'Shri', 'asdsdsa', 'sadasd', '2021-03-02', 'Male', 'shrikantp9762@gmail.com', '9370268256', 'Empolyee', '21123213', 'vector.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `staff_id` varchar(10) DEFAULT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `position` varchar(15) NOT NULL,
  `sal` varchar(10) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `isLate` int(11) NOT NULL DEFAULT 0,
  `leaves` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `firstname`, `lastname`, `address`, `dob`, `gender`, `email`, `phone`, `position`, `sal`, `photo`, `isLate`, `leaves`) VALUES
(10, 'S730', 'Shrikant', 'pandhekar', 'cidco', '2021-02-01', 'Male', 'pandhekar.shrikant@gmail.com', '7028357194', 'Empolyee', '120000', 'vector.png', 1, 1),
(11, 'S932', 'asd', 'pandhekar', 'sadasd', '2021-02-06', 'Male', 'pandhekar.shrikant@gmail.com', '1231232132', 'Empolyee', '21123213', 'mgm-u-logo.png', 3, 6),
(15, 'S350', 'Shri', 'Pandhekar', 'cidco', '2021-03-01', 'Male', 'pandhekar.shrikant@gmail.com', '9370268256', 'Empolyee', '12000', 'theavengers.jpg', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_data`
--
ALTER TABLE `chart_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cs_worker`
--
ALTER TABLE `cs_worker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dummy_data`
--
ALTER TABLE `dummy_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_shifttime`
--
ALTER TABLE `emp_shifttime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `p_worker`
--
ALTER TABLE `p_worker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cs_worker`
--
ALTER TABLE `cs_worker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emp_shifttime`
--
ALTER TABLE `emp_shifttime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `p_worker`
--
ALTER TABLE `p_worker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
