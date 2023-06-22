-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 02:16 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shivinvest1`
--

-- --------------------------------------------------------

--
-- Table structure for table `invest`
--

CREATE TABLE `invest` (
  `id` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `regdate` date NOT NULL,
  `invest` double NOT NULL,
  `asign` double NOT NULL,
  `pday` double NOT NULL,
  `pmonth` double NOT NULL,
  `pmode` varchar(10) NOT NULL,
  `img` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invest`
--

INSERT INTO `invest` (`id`, `cid`, `regdate`, `invest`, `asign`, `pday`, `pmonth`, `pmode`, `img`) VALUES
(1, 1, '2022-12-16', 49900, 2, 33.27, 998, 'Cash', ''),
(2, 2, '2022-12-16', 40000, 3, 40, 1200, 'Cash', ''),
(3, 4, '2022-12-16', 4000, 4, 5.33, 160, 'Cash', ''),
(4, 4, '2022-12-17', 5000, 2, 3.33, 100, 'Cash', ''),
(5, 2, '2022-12-21', 5000, 2, 3.33, 100, 'Cash', ''),
(6, 2, '2022-12-21', 50000, 2, 33.33, 1000, 'Bank Check', ''),
(7, 2, '2022-12-21', 10000, 1, 3.33, 100, 'Cash', ''),
(8, 2, '2022-12-21', 10000, 2, 6.67, 200, 'Cash', ''),
(9, 2, '2022-12-21', 10000, 10, 33.33, 1000, 'Cash', ''),
(10, 2, '2022-12-21', 10000, 2, 6.67, 200, 'Cash', ''),
(11, 2, '2022-12-21', 10000, 1, 3.33, 100, 'Cash', ''),
(12, 2, '2022-12-21', 10000, 2, 6.67, 200, 'Cash', ''),
(13, 2, '2022-12-21', 20000, 10, 66.67, 2000, 'Cash', ''),
(14, 3, '2022-12-21', 10000, 1, 3.33, 100, 'Cash', ''),
(15, 2, '2022-12-21', 10000, 2, 6.67, 200, 'Cash', ''),
(16, 2, '2022-12-21', 10000, 10, 33.33, 1000, 'Bank Check', ''),
(17, 2, '2022-12-21', 50000, 1, 16.67, 500, 'Cash', ''),
(18, 0, '2022-12-28', 100000, 2, 66.67, 2000, 'Cash', '../img/IMG20220527162903.jpg'),
(19, 0, '2022-12-28', 100000, 2, 66.67, 2000, 'Cash', '../img/IMG20221009112213.jpg'),
(20, 0, '2022-12-28', 20000, 10, 66.67, 2000, 'Cash', '../img/IMG20221009112213.jpg'),
(21, 0, '0000-00-00', 0, 0, 0, 0, '', '../img/IMG20221009112213.jpg'),
(22, 0, '2022-12-28', 0, 0, 0, 0, '', '../img/IMG20221009112213.jpg'),
(23, 2, '2022-12-28', 0, 0, 0, 0, '', '../img/IMG20221009112213.jpg'),
(24, 4, '2022-12-28', 0, 0, 0, 0, '', '../img/IMG20221009112213.jpg'),
(25, 1, '2022-12-29', 50000, 10, 166.67, 5000, 'Bank Check', '../img/IMG20210725094436.jpg'),
(26, 1, '2022-12-28', 200000, 2, 133.33, 4000, 'Cash', '../img/IMG20220801091913.jpg'),
(27, 4, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20210725094436.jpg'),
(28, 2, '2022-12-28', 500000, 2, 333.33, 10000, 'Cash', '../img/IMG20210725094436.jpg'),
(29, 0, '0000-00-00', 0, 0, 0, 0, '', ''),
(30, 4, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', ''),
(31, 4, '2022-12-28', 50000, 20, 333.33, 10000, 'Cash', ''),
(32, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(33, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(34, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(35, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(36, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(37, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(38, 2, '2022-12-28', 10000, 2, 6.67, 200, 'Cash', '../img/IMG20220801091913.jpg'),
(39, 4, '2022-12-28', 20000, 1, 6.67, 200, 'Cash', '../img/IMG20221009112213.jpg'),
(40, 2, '2022-12-28', 10000, 1, 3.33, 100, 'Cash', '../img/IMG20221009112213.jpg'),
(41, 2, '2022-12-28', 10000, 1, 3.33, 100, 'Cash', '../img/IMG20221009112213.jpg'),
(42, 2, '2022-12-29', 5000, 1, 1.67, 50, 'Cash', '../img/IMG20221009112213.jpg'),
(43, 1, '2022-12-28', 100000, 2, 66.67, 2000, 'Cash', '../img/IMG20221009112213.jpg'),
(44, 1, '2022-12-28', 50000, 2, 33.33, 1000, 'Cash', ''),
(45, 1, '2022-12-28', 9000, 23, 69, 2070, 'Cash', ''),
(46, 2, '2022-12-16', 40000, 3, 40, 1200, 'Cash', ''),
(47, 1, '2022-12-29', 50000, 2, 33.33, 1000, 'Cash', '../img/IMG20220527162903.jpg'),
(48, 2, '2022-12-30', 500000, 2, 333.33, 10000, 'Cash', '../img/IMG20220527162903.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `logid` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`logid`, `cid`, `username`, `password`, `user`) VALUES
(1, 0, 'admin', 'repass', 'admin'),
(2, 1, 'SHIVAM1', 'SHIVAM93601', 'Member'),
(3, 2, 'SHIVAM2', 'SHIVAM74584', 'Member'),
(4, 3, 'SHIVAM3', 'SHIVAM43441', 'Member'),
(5, 4, 'SHIVAM4', 'SHIVAM61192', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `log_info`
--

CREATE TABLE `log_info` (
  `logg_id` bigint(50) NOT NULL,
  `cid` bigint(50) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_info`
--

INSERT INTO `log_info` (`logg_id`, `cid`, `login`, `logout`) VALUES
(1, 0, '2022-12-16 18:06:50', '2022-12-16 18:07:05'),
(2, 0, '2022-12-16 18:07:23', '2022-12-16 19:15:21'),
(3, 0, '2022-12-16 19:15:28', '2022-12-16 19:21:08'),
(4, 0, '2022-12-16 19:21:33', '0000-00-00 00:00:00'),
(5, 0, '2022-12-16 23:01:34', '0000-00-00 00:00:00'),
(6, 0, '2022-12-16 23:05:32', '2022-12-16 23:08:51'),
(7, 0, '2022-12-16 23:09:07', '0000-00-00 00:00:00'),
(8, 0, '2022-12-20 08:28:37', '0000-00-00 00:00:00'),
(9, 0, '2022-12-21 13:07:58', '2022-12-21 17:14:31'),
(10, 0, '2022-12-21 17:14:59', '2022-12-21 17:15:15'),
(11, 0, '2022-12-21 17:15:25', '2022-12-21 17:16:06'),
(12, 0, '2022-12-21 17:16:22', '2022-12-21 17:17:20'),
(13, 0, '2022-12-21 17:17:29', '2022-12-21 17:17:34'),
(14, 0, '2022-12-21 23:01:46', '0000-00-00 00:00:00'),
(15, 0, '2022-12-24 17:19:35', '0000-00-00 00:00:00'),
(16, 0, '2022-12-27 18:21:44', '0000-00-00 00:00:00'),
(17, 0, '2022-12-28 00:49:31', '0000-00-00 00:00:00'),
(18, 0, '2022-12-28 11:50:21', '0000-00-00 00:00:00'),
(19, 0, '2022-12-28 23:44:39', '0000-00-00 00:00:00'),
(20, 0, '2022-12-29 10:42:17', '0000-00-00 00:00:00'),
(21, 0, '2022-12-30 00:18:01', '0000-00-00 00:00:00'),
(22, 0, '2022-12-30 00:38:11', '0000-00-00 00:00:00'),
(23, 0, '2022-12-30 00:38:46', '0000-00-00 00:00:00'),
(24, 0, '2022-12-30 00:39:22', '0000-00-00 00:00:00'),
(25, 0, '2022-12-30 18:38:48', '0000-00-00 00:00:00'),
(26, 0, '2022-12-30 18:38:59', '0000-00-00 00:00:00'),
(27, 0, '2022-12-30 18:40:07', '0000-00-00 00:00:00'),
(28, 0, '2022-12-30 18:40:52', '0000-00-00 00:00:00'),
(29, 0, '2022-12-30 18:42:09', '0000-00-00 00:00:00'),
(30, 0, '2022-12-30 18:44:48', '2022-12-30 18:45:05'),
(31, 0, '2022-12-30 18:45:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_permission`
--

CREATE TABLE `log_permission` (
  `log_per_id` bigint(50) NOT NULL,
  `set_time` datetime(6) NOT NULL,
  `end_time` datetime(6) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_permission`
--

INSERT INTO `log_permission` (`log_per_id`, `set_time`, `end_time`, `user`) VALUES
(1, '2022-12-16 11:08:00.000000', '2022-12-17 11:08:00.000000', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `referal`
--

CREATE TABLE `referal` (
  `refid` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `refcid` int(50) NOT NULL,
  `refasign` double NOT NULL,
  `refpday` double NOT NULL,
  `refpmonth` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referal`
--

INSERT INTO `referal` (`refid`, `id`, `refcid`, `refasign`, `refpday`, `refpmonth`) VALUES
(1, 1, 0, 0, 0, 0),
(2, 2, 3, 2, 27, 800),
(3, 3, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0),
(5, 5, 0, 0, 0, 0),
(6, 6, 0, 0, 0, 0),
(7, 7, 0, 0, 0, 0),
(8, 8, 0, 0, 0, 0),
(9, 9, 0, 0, 0, 0),
(10, 10, 0, 0, 0, 0),
(11, 11, 0, 0, 0, 0),
(12, 12, 0, 0, 0, 0),
(13, 13, 0, 0, 0, 0),
(14, 14, 0, 0, 0, 0),
(15, 15, 0, 0, 0, 0),
(16, 16, 0, 0, 0, 0),
(17, 17, 0, 0, 0, 0),
(18, 19, 4, 1, 33, 1000),
(19, 20, 0, 0, 0, 0),
(20, 39, 1, 1, 7, 200),
(21, 39, 3, 2, 13, 400),
(22, 40, 0, 0, 0, 0),
(23, 41, 4, 1, 3, 100),
(24, 42, 0, 0, 0, 0),
(25, 42, 0, 0, 0, 0),
(26, 42, 0, 0, 0, 0),
(27, 43, 0, 0, 0, 0),
(28, 44, 1, 1, 17, 500),
(29, 45, 4, 1, 3, 100),
(30, 46, 0, 0, 0, 0),
(31, 47, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `cid` int(50) NOT NULL,
  `regdate` date NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pan` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `blood` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `account` varchar(30) CHARACTER SET latin1 NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `nominee` varchar(20) NOT NULL,
  `relation` varchar(30) NOT NULL,
  `full` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`cid`, `regdate`, `fname`, `mname`, `lname`, `mobile`, `email`, `pan`, `address`, `blood`, `gender`, `bank`, `account`, `ifsc`, `branch`, `nominee`, `relation`, `full`) VALUES
(1, '2022-12-16', 'Akash', 'baleshi', 'jogani', '9742020863', 'admin@admin.com', 'ADVFD8956A', 'Main Road Sambra', 'A-', 'Female', 'State Bank Of India', '511220003542154', 'SBI84152f', 'sambra', 'Krushna chougule', 'father', 'Akash baleshi jogani'),
(2, '2022-12-16', 'madan', 'babu', 'yaddi', '9742020863', 'akashjogani93@gmail.com', 'VVGFB7856S', 'sambra', 'A-', 'Male', 'State Bank Of India', '511220003542154', 'SBI84152f', 'sambra', 'Krushna chougule', 'father', 'madan babu yaddi'),
(3, '2022-12-16', 'mahesh', 'k', 'chougule', '9742020863', 'akashjogani93@gmail.com', 'BGDFD8563S', 'Main Road Sambra', 'B-', 'Male', 'State Bank Of India', '511220003542154', 'SBI84152f', 'sambra', 'shanta jogani', 'mother', 'mahesh k chougule'),
(4, '2022-12-16', 'vinayak', 'A', 'Dharmoji', '9742020863', 'akashjogani93@gmail.com', 'BHGNJ2536H', 'Main Road Sambra', 'B+', 'Male', 'State Bank Of India', '511220003542154', 'SBI84152f', 'sambra', 'Krushna chougule', 'mother', 'vinayak A Dharmoji');

-- --------------------------------------------------------

--
-- Table structure for table `widraw`
--

CREATE TABLE `widraw` (
  `wid` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `inv_id` int(50) NOT NULL,
  `wdate` date NOT NULL,
  `wamt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `widraw`
--

INSERT INTO `widraw` (`wid`, `cid`, `inv_id`, `wdate`, `wamt`) VALUES
(1, 1, 1, '2022-12-16', 100),
(2, 1, 45, '2022-12-28', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `log_info`
--
ALTER TABLE `log_info`
  ADD PRIMARY KEY (`logg_id`);

--
-- Indexes for table `log_permission`
--
ALTER TABLE `log_permission`
  ADD PRIMARY KEY (`log_per_id`);

--
-- Indexes for table `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`refid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `widraw`
--
ALTER TABLE `widraw`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invest`
--
ALTER TABLE `invest`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_info`
--
ALTER TABLE `log_info`
  MODIFY `logg_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `log_permission`
--
ALTER TABLE `log_permission`
  MODIFY `log_per_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `referal`
--
ALTER TABLE `referal`
  MODIFY `refid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `cid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `widraw`
--
ALTER TABLE `widraw`
  MODIFY `wid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
