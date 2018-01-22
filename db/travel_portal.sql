-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2018 at 11:49 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `f_managers`
--

CREATE TABLE `f_managers` (
  `t_id` int(11) NOT NULL,
  `status_id` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_managers`
--

INSERT INTO `f_managers` (`t_id`, `status_id`) VALUES
(10, 3),
(11, 5),
(16, 3),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `f_responses`
--

CREATE TABLE `f_responses` (
  `t_id` int(11) NOT NULL,
  `status_id` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_responses`
--

INSERT INTO `f_responses` (`t_id`, `status_id`) VALUES
(11, 5),
(10, 3),
(16, 3),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `mode_id` int(5) NOT NULL,
  `mode_name` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`mode_id`, `mode_name`) VALUES
(1, 'Air'),
(2, 'Road'),
(3, 'Water'),
(4, 'Subway'),
(5, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `more_info`
--

CREATE TABLE `more_info` (
  `t_id` int(11) NOT NULL,
  `info` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `more_info`
--

INSERT INTO `more_info` (`t_id`, `info`) VALUES
(10, 'I wanna go'),
(11, 'I really need this...');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(5) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'employee'),
(2, 'manager'),
(3, 'f_manager');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `email` varchar(60) NOT NULL,
  `name` varchar(80) NOT NULL,
  `role_id` int(5) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`email`, `name`, `role_id`, `password`) VALUES
('omid@yahoo.com', 'omid ahmadi', 2, 'b3a8e0e1f9ab1bfe3a36f231f676f78bb30a519d2b21e6c530c0eee8ebb4a5d0'),
('ibrahim@yahoo.com', 'Ibrahim Aini', 2, 'b3a8e0e1f9ab1bfe3a36f231f676f78bb30a519d2b21e6c530c0eee8ebb4a5d0'),
('ahmad@yahoo.com', 'Ahmad', 3, 'b3a8e0e1f9ab1bfe3a36f231f676f78bb30a519d2b21e6c530c0eee8ebb4a5d0'),
('mahmood@yahoo.com', 'Mahmood', 1, 'b3a8e0e1f9ab1bfe3a36f231f676f78bb30a519d2b21e6c530c0eee8ebb4a5d0');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(5) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Draft'),
(2, 'Submitted'),
(3, 'Approved'),
(4, 'Rejected'),
(5, 'Request for more Information'),
(6, 'Submitted to finance');

-- --------------------------------------------------------

--
-- Table structure for table `travel_plans`
--

CREATE TABLE `travel_plans` (
  `t_id` int(11) NOT NULL,
  `who` varchar(60) NOT NULL,
  `purpose` varchar(300) NOT NULL,
  `s_date` date NOT NULL,
  `e_date` date NOT NULL,
  `mode_id` int(5) NOT NULL,
  `ticket_cost` int(10) NOT NULL,
  `here_cab` int(10) NOT NULL,
  `there_cab` int(10) NOT NULL,
  `hotel_cost` int(10) NOT NULL,
  `local_conveyance` varchar(255) NOT NULL,
  `status_id` int(5) NOT NULL,
  `manager` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_plans`
--

INSERT INTO `travel_plans` (`t_id`, `who`, `purpose`, `s_date`, `e_date`, `mode_id`, `ticket_cost`, `here_cab`, `there_cab`, `hotel_cost`, `local_conveyance`, `status_id`, `manager`) VALUES
(19, 'mahmood@yahoo.com', 'to travel', '2018-01-18', '2018-01-24', 3, 20, 120, 111, 111, 'Langkawi', 1, ''),
(18, 'mahmood@yahoo.com', 'vacation', '2018-01-17', '2018-01-24', 1, 700, 100, 50, 200, 'LA', 3, 'ibrahim@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `t_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `desc_` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`t_id`, `path`, `desc_`) VALUES
(10, 'receipts/puppy.jpg', 'I bought a puppy!!!'),
(16, 'receipts/pexels-photo-115655.jpeg', 'computer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `f_managers`
--
ALTER TABLE `f_managers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `f_responses`
--
ALTER TABLE `f_responses`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`mode_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `travel_plans`
--
ALTER TABLE `travel_plans`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `mode_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `travel_plans`
--
ALTER TABLE `travel_plans`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
