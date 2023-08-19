-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 02:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_list`
--

CREATE TABLE `action_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_list`
--

INSERT INTO `action_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Solitary Confinement', 1, 0, '2022-05-31 11:56:31', '2022-05-31 11:56:31'),
(2, 'Infirmary Confinement', 1, 0, '2022-05-31 11:58:03', '2022-05-31 11:58:03'),
(3, 'Transported for Trial', 1, 0, '2022-05-31 11:59:14', '2022-05-31 11:59:14'),
(4, 'test - updated', 1, 1, '2022-05-31 11:59:34', '2022-05-31 11:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `cell_list`
--

CREATE TABLE `cell_list` (
  `id` int(30) NOT NULL,
  `prison_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cell_list`
--

INSERT INTO `cell_list` (`id`, `prison_id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'Block 1 Cell 1001', 1, 0, '2022-05-31 09:16:32', '2022-05-31 09:16:32'),
(2, 1, 'Block 1 Cell 1002', 1, 0, '2022-05-31 09:17:07', '2022-05-31 09:17:07'),
(3, 1, 'Block 1 Cell 1003', 1, 0, '2022-05-31 09:17:18', '2022-05-31 09:17:18'),
(4, 1, 'Block 1 Cell 1004', 1, 0, '2022-05-31 09:17:25', '2022-05-31 09:17:25'),
(5, 1, 'Block 2 Cell 1001', 1, 0, '2022-05-31 09:17:34', '2022-05-31 09:17:34'),
(6, 1, 'Block 2 Cell 1002', 1, 0, '2022-05-31 09:17:43', '2022-05-31 09:17:43'),
(7, 1, 'Block 2 Cell 1003', 1, 0, '2022-05-31 09:17:52', '2022-05-31 09:17:52'),
(8, 1, 'Block 2 Cell 1004', 1, 0, '2022-05-31 09:17:58', '2022-05-31 09:17:58'),
(9, 1, 'Block 3 Cell 1001', 1, 0, '2022-05-31 09:18:07', '2022-05-31 09:18:07'),
(10, 1, 'Block 3 Cell 1002', 1, 0, '2022-05-31 09:18:16', '2022-05-31 09:18:16'),
(11, 1, 'Block 3 Cell 1003', 1, 0, '2022-05-31 09:18:26', '2022-05-31 09:18:26'),
(12, 2, 'Block 1 Cell 1001', 1, 0, '2022-05-31 09:18:36', '2022-05-31 09:18:36'),
(13, 2, 'Block 1 Cell 1002', 1, 0, '2022-05-31 09:18:41', '2022-05-31 09:18:41'),
(14, 2, 'Block 1 Cell 1003', 1, 0, '2022-05-31 09:18:49', '2022-05-31 09:18:49'),
(15, 2, 'Block 1 Cell 1004', 1, 0, '2022-05-31 09:18:55', '2022-05-31 09:18:55'),
(16, 2, 'test - updated', 0, 1, '2022-05-31 09:19:06', '2022-05-31 09:19:29'),
(19, 1, 'Block A cell 2', 1, 0, '2023-03-15 17:13:43', '2023-03-15 17:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `crime_list`
--

CREATE TABLE `crime_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crime_list`
--

INSERT INTO `crime_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Robbery', 1, 0, '2022-05-31 09:25:05', '2022-08-05 17:23:00'),
(2, 'Homicide', 1, 0, '2022-05-31 09:25:13', '2022-05-31 09:25:13'),
(3, 'Murder', 1, 0, '2022-05-31 09:25:20', '2022-05-31 09:25:20'),
(4, 'Attempted Murder', 1, 0, '2022-05-31 09:25:34', '2022-05-31 09:25:34'),
(5, 'Child Abuse', 1, 0, '2022-05-31 09:26:14', '2022-05-31 09:26:14'),
(6, 'Fraud', 1, 0, '2022-05-31 09:26:33', '2022-05-31 09:26:33'),
(7, 'Rape', 1, 0, '2022-05-31 09:26:57', '2022-05-31 09:26:57'),
(8, 'Sexual Assualt', 1, 0, '2022-05-31 09:27:06', '2023-04-05 22:37:39'),
(9, 'Terrorism', 1, 0, '2022-05-31 09:27:26', '2022-05-31 09:27:26'),
(10, 'Stalking and Harassment', 1, 0, '2022-05-31 09:27:43', '2022-05-31 09:28:15'),
(13, 'Defilement', 1, 0, '2023-03-16 01:06:41', '2023-03-16 01:06:41'),
(14, 'Man Slaughter', 1, 0, '2023-03-17 13:57:58', '2023-03-17 13:57:58'),
(15, 'HumanTrafficking ', 1, 0, '2023-04-05 22:40:22', '2023-04-05 22:40:22'),
(16, 'Domestic Violence', 1, 0, '2023-04-05 22:40:41', '2023-04-05 22:40:41'),
(17, 'Corruption', 1, 0, '2023-04-05 22:40:55', '2023-04-05 22:40:55'),
(18, 'Cyber Crime', 1, 0, '2023-04-05 22:41:34', '2023-04-05 22:41:34'),
(19, 'Bribery ', 1, 0, '2023-04-05 22:42:02', '2023-04-05 22:42:02'),
(20, 'Arson', 1, 0, '2023-04-05 22:42:41', '2023-04-05 22:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `drug_store`
--

CREATE TABLE `drug_store` (
  `id` int(11) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drug_store`
--

INSERT INTO `drug_store` (`id`, `drug`, `quantity`, `status`) VALUES
(1, 'Amoxicillin', '20', 1),
(2, 'Lexapro', '7', 1),
(3, 'Farxiga', '49', 1),
(4, 'Paracetamol', '11', 1),
(5, 'Tenovovir', '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_store`
--

CREATE TABLE `food_store` (
  `id` int(11) NOT NULL,
  `food` varchar(255) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_store`
--

INSERT INTO `food_store` (`id`, `food`, `quantity`, `status`) VALUES
(1, 'Rice ', '42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inmate_crimes`
--

CREATE TABLE `inmate_crimes` (
  `cid` int(11) NOT NULL,
  `inmate_id` int(30) NOT NULL,
  `crime_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inmate_crimes`
--

INSERT INTO `inmate_crimes` (`cid`, `inmate_id`, `crime_id`) VALUES
(25, 1, 6),
(26, 1, 1),
(27, 4, 5),
(28, 4, 6),
(30, 6, 5),
(31, 5, 1),
(32, 7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `inmate_list`
--

CREATE TABLE `inmate_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `sex` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `marital_status` varchar(250) NOT NULL,
  `eye_color` text NOT NULL,
  `complexion` text NOT NULL,
  `cell_id` int(11) NOT NULL,
  `sentence` text NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date DEFAULT NULL,
  `emergency_name` text DEFAULT NULL,
  `emergency_contact` text DEFAULT NULL,
  `emergency_relation` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `visiting_privilege` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inmate_list`
--

INSERT INTO `inmate_list` (`id`, `code`, `firstname`, `middlename`, `lastname`, `sex`, `dob`, `address`, `marital_status`, `eye_color`, `complexion`, `cell_id`, `sentence`, `date_from`, `date_to`, `emergency_name`, `emergency_contact`, `emergency_relation`, `image_path`, `status`, `visiting_privilege`, `date_created`, `date_updated`, `delete_flag`) VALUES
(1, '6231415', 'John', 'Kk', 'Agye', 'Male', '1990-06-23', 'Sample Address only', 'Married', 'Brown', 'Fair', 1, '2 Year', '2022-05-31', '2024-05-31', 'Agye Felix', '0245521245', 'Brother', 'uploads/avatars/pmslogo.png', 1, 1, '2022-05-31 11:06:45', '2023-03-15 17:48:30', 1),
(4, '784555', 'Theohpilus', '', 'Agyrmang', 'Male', '2022-08-02', 'box 75, Navrongo', 'Single', 'brown', 'fair', 1, '5 years', '2022-08-02', '2022-09-01', 'Agyrmang Kofi', '0245512145', 'Father', 'uploads/avatars/pmslogo.png', 1, 1, '2022-08-02 18:09:33', '2023-03-15 17:48:21', 1),
(5, '112233', 'Edward', '', 'Opare - Yeboah', 'Male', '2001-06-20', 'P.O.Box 29, Agona Swedru', 'Married', 'white', 'fair', 1, '4', '2023-03-16', '2027-03-16', 'Edward Opare - Yeboah', '0547744992', 'wcfa', 'uploads/avatars/2022_01_17_05_34_IMG_0131.JPG', 1, 1, '2023-03-15 17:43:41', '2023-03-15 19:40:57', 0),
(6, '234115', 'Emmanuel', '', 'Adjei', 'Male', '1997-09-02', 'P.O.Box 32, Tanoso', 'Single', 'blue', 'Dark', 1, '8', '2023-03-20', '2031-06-26', 'Mash', '0203072584', 'Son', 'uploads/avatars/2022_08_30_06_20_IMG_7600.PNG', 1, 1, '2023-03-15 17:53:21', '2023-03-16 23:22:23', 1),
(7, '0110', 'Deborah', '', 'Sarpong', 'Female', '2000-06-11', 'Cr/1/22', 'Widower', 'brown', 'Dark', 13, '25 years', '2023-06-20', '2048-06-20', 'Adwoa Badu', 'N/A', 'Mother', 'uploads/avatars/cute_baby_cheeks-1920x1200.jpg', 1, 1, '2023-06-08 20:49:02', '2023-06-08 20:49:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prison_list`
--

CREATE TABLE `prison_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prison_list`
--

INSERT INTO `prison_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Men', 1, 0, '2022-05-31 09:03:13', '2022-08-05 16:59:43'),
(2, 'Women', 1, 0, '2022-05-31 09:03:23', '2022-08-02 09:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `rank_code` varchar(100) NOT NULL,
  `title_code` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `rank`, `rank_code`, `title_code`, `status`) VALUES
(1, 'ASP', '', '1', 1),
(2, 'DSP', '', '1', 1),
(3, 'Suprintendent', '', '1', 1),
(4, 'Chief Suprintendent', '', '1', 1),
(5, 'Ass Director of Prison', '', '1', 1),
(6, 'Deputy Director of Prisons', '', '1', 1),
(7, 'Director of Prisons', '', '1', 1),
(8, 'Deputy Director General of Prisons', '', '1', 1),
(9, 'Director General of Prisons', '', '1', 1),
(10, 'Second Class Officer', '', '2', 1),
(11, 'Lance Corpral', '', '2', 1),
(12, 'Corpral', '', '2', 1),
(13, 'Sargent', '', '2', 1),
(14, 'Ass Chief Officer', '', '2', 1),
(15, 'Chief Officer', '', '2', 1),
(16, 'Senior Chief Officer ', '', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank_title`
--

CREATE TABLE `rank_title` (
  `id` int(11) NOT NULL,
  `rank_title` varchar(100) NOT NULL,
  `titleCode` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rank_title`
--

INSERT INTO `rank_title` (`id`, `rank_title`, `titleCode`, `status`) VALUES
(1, 'Senior Officers', '', 1),
(2, 'Junior Officers', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `record_list`
--

CREATE TABLE `record_list` (
  `id` int(30) NOT NULL,
  `inmate_id` int(30) NOT NULL,
  `action_id` int(30) NOT NULL,
  `remarks` text NOT NULL,
  `date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_list`
--

INSERT INTO `record_list` (`id`, `inmate_id`, `action_id`, `remarks`, `date`, `date_created`, `date_updated`) VALUES
(1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget ante et lacus mollis euismod ut pellentesque nisl. Mauris at elit at dui tempor hendrerit.', '2022-08-03', '2022-05-31 13:19:24', '2022-08-03 11:09:56'),
(2, 1, 2, 'Fusce porta pharetra massa, id congue dolor suscipit vel. Praesent id interdum risus. Mauris scelerisque urna massa, eget fringilla mi condimentum vel.', '2022-05-31', '2022-05-31 13:26:22', '2022-05-31 13:26:22'),
(5, 4, 1, 'Good', '2022-08-04', '2022-08-03 17:57:52', '2022-08-03 17:57:52'),
(6, 6, 3, 'A good and a foolish thief ', '2023-03-21', '2023-03-16 23:21:51', '2023-03-16 23:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `request_drug`
--

CREATE TABLE `request_drug` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `drug` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `requestdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_drug`
--

INSERT INTO `request_drug` (`id`, `user`, `drug`, `quantity`, `purpose`, `requestdate`, `status`) VALUES
(2, 6, 'Lexapro', 3, 'For inamte 666524', '2022-09-29 12:00:50', 1),
(3, 9, 'Farxiga', 1, 'For inamte 6552555', '2022-09-29 11:59:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_food`
--

CREATE TABLE `request_food` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `food` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `requestdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_food`
--

INSERT INTO `request_food` (`id`, `user`, `food`, `quantity`, `purpose`, `requestdate`, `status`) VALUES
(1, 6, 'Rice - Abene', 3, 'Food the festival', '2022-09-28 19:37:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Prison Management System'),
(6, 'short_name', 'PRISONS MANAGEMENT'),
(11, 'logo', 'uploads/logo.png?v=1659190062'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1659190063'),
(17, 'phone', '456-987-1231'),
(18, 'mobile', '09123456987 / 094563212222 '),
(19, 'email', 'info@musicschool.com'),
(20, 'address', 'Here St, Down There City, Anywhere Here, 2306 -updated'),
(21, 'fafa', '2022-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `rank` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `drug_permit` varchar(100) NOT NULL,
  `food_permit` varchar(100) NOT NULL,
  `request_drug_permit` int(11) NOT NULL,
  `request_food_permit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `rank`, `date_added`, `date_updated`, `status`, `drug_permit`, `food_permit`, `request_drug_permit`, `request_food_permit`) VALUES
(1, 'Edward', '', 'Opare_Yeboah', 'Thiago', '4a358c71b29a942dbf12e87458a89ee2', 'uploads/user/2022_02_04_20_55_IMG_0834.JPG', NULL, 1, '', '2021-01-20 14:02:37', '2023-04-30 11:41:26', 1, '', '', 0, 0),
(11, 'Cindy', '', 'Asuamah Yeboah', 'acemay16', '58b8595cb0c4eb2398226a973f7898bb', 'uploads/user/dragon_age_ea-1920x1080.jpg', NULL, 2, '15', '2023-06-08 20:36:47', '2023-06-08 20:44:36', 1, '1', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visit_list`
--

CREATE TABLE `visit_list` (
  `id` int(30) NOT NULL,
  `inmate_id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `relation` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visit_list`
--

INSERT INTO `visit_list` (`id`, `inmate_id`, `fullname`, `contact`, `relation`, `date_created`, `date_updated`) VALUES
(7, 5, 'Mash', '045335566', 'step daughters', '2023-03-15 17:45:04', '2023-03-15 17:45:04'),
(8, 6, 'Thomas', '0592934675', 'Friend', '2023-03-15 17:54:00', '2023-03-15 17:54:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_list`
--
ALTER TABLE `action_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cell_list`
--
ALTER TABLE `cell_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prison_id` (`prison_id`);

--
-- Indexes for table `crime_list`
--
ALTER TABLE `crime_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_store`
--
ALTER TABLE `drug_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_store`
--
ALTER TABLE `food_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmate_crimes`
--
ALTER TABLE `inmate_crimes`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `inmate_id` (`inmate_id`),
  ADD KEY `crime_id` (`crime_id`);

--
-- Indexes for table `inmate_list`
--
ALTER TABLE `inmate_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cell_id` (`cell_id`);

--
-- Indexes for table `prison_list`
--
ALTER TABLE `prison_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank_title`
--
ALTER TABLE `rank_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record_list`
--
ALTER TABLE `record_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inmate_id` (`inmate_id`),
  ADD KEY `action_id` (`action_id`);

--
-- Indexes for table `request_drug`
--
ALTER TABLE `request_drug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_food`
--
ALTER TABLE `request_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visit_list`
--
ALTER TABLE `visit_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inmate_id` (`inmate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_list`
--
ALTER TABLE `action_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cell_list`
--
ALTER TABLE `cell_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `crime_list`
--
ALTER TABLE `crime_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `drug_store`
--
ALTER TABLE `drug_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_store`
--
ALTER TABLE `food_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inmate_crimes`
--
ALTER TABLE `inmate_crimes`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `inmate_list`
--
ALTER TABLE `inmate_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prison_list`
--
ALTER TABLE `prison_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rank_title`
--
ALTER TABLE `rank_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `record_list`
--
ALTER TABLE `record_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request_drug`
--
ALTER TABLE `request_drug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_food`
--
ALTER TABLE `request_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visit_list`
--
ALTER TABLE `visit_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cell_list`
--
ALTER TABLE `cell_list`
  ADD CONSTRAINT `prison_id_fk_cl` FOREIGN KEY (`prison_id`) REFERENCES `cell_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inmate_crimes`
--
ALTER TABLE `inmate_crimes`
  ADD CONSTRAINT `crime_id_fk_ic` FOREIGN KEY (`crime_id`) REFERENCES `crime_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `inmate_id_fk_ic` FOREIGN KEY (`inmate_id`) REFERENCES `inmate_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inmate_list`
--
ALTER TABLE `inmate_list`
  ADD CONSTRAINT `cell_id_fk_il` FOREIGN KEY (`cell_id`) REFERENCES `cell_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `record_list`
--
ALTER TABLE `record_list`
  ADD CONSTRAINT `action_id_fk_rl` FOREIGN KEY (`action_id`) REFERENCES `action_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `inmate_id_fk_rl` FOREIGN KEY (`inmate_id`) REFERENCES `inmate_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `visit_list`
--
ALTER TABLE `visit_list`
  ADD CONSTRAINT `inmate_id_fk_vl` FOREIGN KEY (`inmate_id`) REFERENCES `inmate_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
