-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 09:55 AM
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
  `admin_id` varchar(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `setPass` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `position` varchar(20) NOT NULL,
  `sal` varchar(10) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `firstname`, `lastname`, `address`, `dob`, `gender`, `email`, `password`, `setPass`, `phone`, `position`, `sal`, `photo`) VALUES
(25, 'A082', 'Shrikant', 'Pandhekar', 'cidco', '2021-06-01', 'Male', 'shrikantp9762@gmail.com', 'asd', 'SET', '9762157194', 'staff', '12000', ''),
(26, 'A326', 'Shree', 'Pandhekar', 'Aurangabad', '2021-06-02', 'Male', 'pandhekar.shrikant@gmail.com', 'asd', 'SET', '9762157197', 'p_worker', '21123213', ''),
(27, 'A961', 'Shri', 'Pandhekar', 'Pune', '2021-06-03', 'Male', 'shrikantp9423@gmail.com', 'yg4VeR5E', 'NOT', '9762157194', 'c_worker', '150000', ''),
(28, 'A321', 'Shrikant', 'Pandhekar', 'cidco', '2021-06-24', 'Male', 'shrikantp9762@gmail.com', 'CVOSREQE', 'NOT', '9762157194', 'p_worker', '150000', 'chat.png');

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
(44, 'P521', '2021-04-20', '21:01:00'),
(45, 'S730', '2021-04-21', '07:00:00'),
(46, 'S730', '2021-04-21', '18:00:00'),
(47, 'S932', '2021-04-21', '07:04:00'),
(48, 'S932', '2021-04-21', '18:30:00'),
(49, 'S350', '2021-04-21', '08:30:00'),
(50, 'S350', '2021-04-21', '18:30:00'),
(51, 'S730', '2021-04-24', '10:11:00'),
(52, 'S730', '2021-04-24', '22:11:00');

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
  `Shift` varchar(10) NOT NULL,
  `isLate` int(10) NOT NULL,
  `leaves` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cs_worker`
--

INSERT INTO `cs_worker` (`id`, `cs_id`, `firstname`, `lastname`, `address`, `dob`, `gender`, `email`, `phone`, `position`, `sal`, `photo`, `Shift`, `isLate`, `leaves`) VALUES
(1, 'C521', 'Shrikant', 'pandhekar', 'cidco', '2021-03-03', 'Male', 'pandhekar.shrikant@gmail.com', '7028357194', 'Empoly', '120000', 'favicon-png-16x16-6-Transparent-Images.png', 'c_worker2', 0, 0),
(3, 'C107', 'gayatri', 'dalvi', 'aurangabad', '2021-04-09', 'Female', 'gayatridalvi@gmail.com', '7420963319', 'manager', '15000', '396f6477621c96e387e813ada0edeb39.jpg', 'c_worker2', 0, 6),
(4, 'C783', 'Preshita', 'Jaiswal', 'aurangabad', '2021-04-03', 'Female', 'preshitajais@gmail.com', '66011000', 'Empoly', '3000', 'ajanta2.jpg.jpg', 'c_worker1', 0, 0),
(9, 'C654', 'Shrikant', 'Pandhekar', 'cidco', '2021-04-25', 'Male', 'no@gmail.com', '9370268256', 'Empolyee', '15000', 'netflix.png', 'c_worker1', 0, 0);

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
(99, 'C107', '2021-04-20', '19:00:00'),
(100, 'S730', '2021-04-21', '07:00:00'),
(101, 'S730', '2021-04-21', '18:30:00'),
(102, 'S932', '2021-04-21', '07:04:00'),
(103, 'S932', '2021-04-21', '18:30:00'),
(104, 'S350', '2021-04-21', '08:30:00'),
(105, 'S350', '2021-04-21', '18:30:00'),
(106, 'S730', '2021-04-22', '07:14:13'),
(107, 'S730', '2021-04-22', '14:14:13'),
(108, 'C107', '2021-04-26', '19:00:00'),
(109, 'C107', '2021-04-26', '07:00:00'),
(110, 'C783', '2021-04-26', '08:00:54'),
(111, 'C783', '2021-04-26', '18:30:00'),
(112, 'C521', '2021-04-26', '07:04:13'),
(113, 'C521', '2021-04-26', '18:30:00'),
(114, 'C654', '2021-06-02', '19:00:00'),
(115, 'C654', '2021-06-02', '07:00:00'),
(116, 'S730', '2021-05-31', '07:00:00'),
(117, 'S730', '2021-05-31', '17:10:00'),
(118, 'P028', '2021-06-02', '07:00:00'),
(119, 'P028', '2021-06-02', '18:30:00'),
(120, 'P340', '2021-06-02', '07:00:00'),
(121, 'P340', '2021-06-02', '17:15:00'),
(122, 'S730', '2021-06-24', '07:00:00'),
(123, 'S730', '2021-06-24', '18:15:00'),
(124, 'S350', '2021-06-24', '07:15:00'),
(125, 'S350', '2021-06-24', '18:15:00'),
(126, 'S730', '2021-03-16', '07:00:00'),
(127, 'S932', '2021-03-16', '07:00:32'),
(128, 'S730', '2021-03-16', '13:05:00'),
(129, 'S932', '2021-03-16', '14:00:32'),
(130, 'S730', '2021-03-16', '14:15:00'),
(131, 'S932', '2021-03-16', '14:00:32'),
(132, 'S730', '2021-03-16', '17:12:43'),
(133, 'S932', '2021-03-16', '17:20:23'),
(134, 'S730', '2021-03-17', '07:03:00'),
(135, 'S730', '2021-03-17', '14:20:32'),
(136, 'S730', '2021-03-17', '15:15:00'),
(137, 'S730', '2021-03-17', '17:20:23'),
(138, 'S730', '2021-03-21', '08:00:54'),
(139, 'S932', '2021-03-21', '05:10:54'),
(140, 'S730', '2021-03-21', '18:00:54'),
(141, 'S932', '2021-03-21', '17:15:00'),
(142, 'S932', '2021-03-23', '09:00:54'),
(143, 'S932', '2021-03-23', '18:15:00'),
(144, 'P028', '2021-03-26', '07:04:00'),
(145, 'P028', '2021-03-26', '13:00:45'),
(146, 'P028', '2021-03-26', '14:15:00'),
(147, 'P028', '2021-03-26', '15:12:34'),
(148, 'P340', '2021-03-27', '06:15:00'),
(149, 'P028', '2021-03-27', '07:15:32'),
(150, 'P340', '2021-03-27', '13:15:00'),
(151, 'P028', '2021-03-27', '13:04:45'),
(152, 'P340', '2021-03-27', '14:10:00'),
(153, 'P028', '2021-03-27', '14:00:32'),
(154, 'P340', '2021-03-27', '17:12:43'),
(155, 'P028', '2021-03-27', '17:20:23'),
(156, 'C521', '2021-04-20', '07:00:00'),
(157, 'C521', '2021-04-20', '12:00:00'),
(158, 'C521', '2021-04-20', '13:00:00'),
(159, 'C521', '2021-04-20', '19:00:00'),
(160, 'C107', '2021-04-20', '08:00:00'),
(161, 'C107', '2021-04-20', '13:00:00'),
(162, 'C107', '2021-04-20', '14:00:00'),
(163, 'C107', '2021-04-20', '19:00:00'),
(164, 'S730', '2021-04-21', '07:00:00'),
(165, 'S730', '2021-04-21', '18:30:00'),
(166, 'S932', '2021-04-21', '07:04:00'),
(167, 'S932', '2021-04-21', '18:30:00'),
(168, 'S350', '2021-04-21', '08:30:00'),
(169, 'S350', '2021-04-21', '18:30:00'),
(170, 'S730', '2021-04-22', '07:14:13'),
(171, 'S730', '2021-04-22', '14:14:13'),
(172, 'C107', '2021-04-26', '19:00:00'),
(173, 'C107', '2021-04-26', '07:00:00'),
(174, 'C783', '2021-04-26', '08:00:54'),
(175, 'C783', '2021-04-26', '18:30:00'),
(176, 'C521', '2021-04-26', '07:04:13'),
(177, 'C521', '2021-04-26', '18:30:00'),
(178, 'C654', '2021-06-02', '19:00:00'),
(179, 'C654', '2021-06-02', '07:00:00'),
(180, 'S730', '2021-05-31', '07:00:00'),
(181, 'S730', '2021-05-31', '17:10:00'),
(182, 'P028', '2021-06-02', '07:00:00'),
(183, 'P028', '2021-06-02', '18:30:00'),
(184, 'P340', '2021-06-02', '07:00:00'),
(185, 'P340', '2021-06-02', '17:15:00'),
(186, 'S730', '2021-06-24', '07:00:00'),
(187, 'S730', '2021-06-24', '18:15:00'),
(188, 'S350', '2021-06-24', '07:15:00'),
(189, 'S350', '2021-06-24', '18:15:00'),
(190, 'S350', '2021-06-28', '07:00:00'),
(191, 'S350', '2021-06-28', '15:00:00'),
(192, 'S730', '2021-06-28', '08:00:00'),
(193, 'S730', '2021-06-28', '13:00:00'),
(194, 'P028', '2021-06-28', '07:00:00'),
(195, 'P028', '2021-06-28', '15:00:00'),
(196, 'P340', '2021-06-28', '08:00:00'),
(197, 'P340', '2021-06-28', '14:00:00'),
(198, 'C521', '2021-06-28', '07:00:00'),
(199, 'C521', '2021-06-28', '13:00:00'),
(200, 'C107', '2021-06-28', '08:00:00'),
(201, 'C107', '2021-06-28', '10:00:00');

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
(1, 'staff', '07:00:00', '19:00:00', 4),
(2, 'p_worker', '07:00:00', '19:00:00', 10),
(3, 'c_worker1', '07:00:00', '19:00:00', 5),
(4, 'c_worker2', '19:00:00', '07:00:00', 5);

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
(6, 'S730', 'whole', '2021-02-28', '0000-00-00', '00:00:00', '00:00:00', 'xyz', 'Approved', '2021-06-28 08:59:19'),
(7, 'S730', 'whole', '2021-03-01', '0000-00-00', '00:00:00', '00:00:00', 'ghsdg', 'pending', '2021-03-01 06:04:45'),
(8, 'S730', 'whole', '2021-03-10', '0000-00-00', '00:00:00', '00:00:00', 'hgjgj', 'pending', '2021-03-16 10:06:01'),
(9, 'S730', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'xcxc', 'pending', '2021-04-19 18:41:28'),
(10, 'S730', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'asd', 'pending', '2021-04-19 18:42:04'),
(11, 'S932', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'wer', 'pending', '2021-04-19 18:42:58'),
(12, 'S932', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'wer', 'pending', '2021-04-19 18:43:33'),
(13, 'P028', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'asderftgyujik', 'pending', '2021-04-19 19:52:10'),
(14, 'S730', 'whole', '2021-04-20', '0000-00-00', '00:00:00', '00:00:00', 'sds', 'pending', '2021-04-21 11:03:40'),
(15, 'S730', 'whole', '2021-04-23', '0000-00-00', '00:00:00', '00:00:00', 'asd', 'pending', '2021-04-21 11:19:08'),
(16, 'S730', 'whole', '2021-04-22', '0000-00-00', '00:00:00', '00:00:00', 'im sick', 'pending', '2021-04-21 13:05:39'),
(17, 'S932', 'whole', '2021-04-23', '0000-00-00', '00:00:00', '00:00:00', 'dfdsf', 'pending', '2021-04-21 13:10:25'),
(18, 'S730', 'whole', '2021-04-23', '0000-00-00', '00:00:00', '00:00:00', 'dfsf', 'pending', '2021-04-21 13:10:38'),
(19, 'S730', 'whole', '2021-04-23', '0000-00-00', '00:00:00', '00:00:00', 'im sick', 'pending', '2021-04-21 14:13:01');

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
(10, 'S730', 'Shrikant', 'pandhekar', 'cidco', '2021-02-01', 'Male', 'pandhekar.shrikant@gmail.com', '7028357194', 'Empolyee', '120000', 'vector.png', 1, 2),
(11, 'S932', 'asd', 'pandhekar', 'sadasd', '2021-02-06', 'Male', 'pandhekar.shrikant@gmail.com', '1231232132', 'Empolyee', '21123213', 'mgm-u-logo.png', 0, 6),
(15, 'S350', 'Shri', 'Pandhekar', 'cidco', '2021-03-01', 'Male', 'pandhekar.shrikant@gmail.com', '9370268256', 'Empolyee', '150000', '', 2, 2),
(25, 'S304', 'Shrikant', 'asdsdsa', 'cidco', '2021-04-24', 'Male', 'pandhekar.shrikant@gmail.com', '9370268256', 'Empolyee', '120000', '1.JPG', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `cs_worker`
--
ALTER TABLE `cs_worker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dummy_data`
--
ALTER TABLE `dummy_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `emp_shifttime`
--
ALTER TABLE `emp_shifttime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `p_worker`
--
ALTER TABLE `p_worker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
