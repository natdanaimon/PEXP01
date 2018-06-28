-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2018 at 04:02 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




--
-- Database: `pexp01`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_config`
--

CREATE TABLE `tb_config` (
  `s_logo` varchar(250) NOT NULL,
  `s_address` text NOT NULL,
  `s_sign` varchar(250) NOT NULL,
  `s_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_config`
--

INSERT INTO `tb_config` (`s_logo`, `s_address`, `s_sign`, `s_name`) VALUES
('default.jpg', '3/113 หมู่บ้านกลางเมือง URBANION\r\nซอย ศรีนครินทร์ 46/1 แขวงหนองบอน เขตประเวศ กทม 10250', 'default.png', 'รชยา รุ่งพัชรภากุล');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `s_level` varchar(10) NOT NULL,
  `s_level_desc_th` varchar(100) NOT NULL,
  `s_level_desc_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`s_level`, `s_level_desc_th`, `s_level_desc_en`) VALUES
('S', 'เจ้าหน้าที่ระดับหัวหน้า', 'Super Admin'),
('N', 'เจ้าหน้าที่', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `id` int(11) NOT NULL,
  `s_username` varchar(50) NOT NULL,
  `s_password` varchar(50) NOT NULL,
  `s_firstname` varchar(100) NOT NULL,
  `s_lastname` varchar(100) NOT NULL,
  `s_phone` varchar(100) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_line` varchar(100) NOT NULL,
  `s_profile` varchar(100) NOT NULL,
  `s_level` varchar(100) NOT NULL,
  `s_status` varchar(100) NOT NULL,
  `s_create_by` varchar(50) NOT NULL,
  `s_update_by` varchar(50) NOT NULL,
  `d_create` datetime NOT NULL,
  `d_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`id`, `s_username`, `s_password`, `s_firstname`, `s_lastname`, `s_phone`, `s_email`, `s_line`, `s_profile`, `s_level`, `s_status`, `s_create_by`, `s_update_by`, `d_create`, `d_update`) VALUES
(1, 'admin', '1111', 'Johnfsf', 'Smith', '0987654321', 'admin@gmail.com', '', 'admin.png', 'S', 'A', '', '1', '0000-00-00 00:00:00', '2018-05-29 14:49:59'),
(2, 'staff01', '1111', 'staff', '01', '000-000-0000', 'a@gmail.com', '', 'default.png', 'N', 'A', '1', '1', '2018-05-29 13:29:10', '2018-05-29 13:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `s_type` varchar(50) NOT NULL,
  `s_key` varchar(50) NOT NULL,
  `s_value_en` varchar(100) NOT NULL,
  `s_value_th` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`s_type`, `s_key`, `s_value_en`, `s_value_th`) VALUES
('AC', 'A', 'Active', 'ใช้งาน'),
('AC', 'C', 'Cancel', 'ยกเลิก');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_staff` (`s_username`,`s_status`,`s_level`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`s_type`,`s_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_staff`
--
ALTER TABLE `tb_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


