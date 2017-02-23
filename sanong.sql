-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2017 at 06:10 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanong`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(3) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_address` varchar(100) NOT NULL,
  `order_tel` varchar(10) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(3) NOT NULL,
  `order_detail_quantity` int(4) NOT NULL,
  `order_detail_price` int(4) NOT NULL,
  `product_id` int(3) NOT NULL,
  `order_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productst`
--

CREATE TABLE `productst` (
  `productst_id` int(3) NOT NULL,
  `name_pst` varchar(100) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `price_pst` int(3) NOT NULL,
  `name_code_pst` varchar(100) NOT NULL,
  `quantity` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productst`
--

INSERT INTO `productst` (`productst_id`, `name_pst`, `detail`, `price_pst`, `name_code_pst`, `quantity`) VALUES
(1, 'menu_03.png', 'ผัดถั่วพริกแกง,ไข่ลูกเขย', 35, 'ข้าวกล่องเซต1', NULL),
(2, 'menu_05.png', 'ไข่เจียว, ผัดปลาดุกทอดกรอบ', 35, 'ข้าวกล่องเซต2', NULL),
(3, 'menu_07.png', 'แกงไตปลา, ไข่ลูกเขย', 35, 'ข้าวกล่องเซต3', NULL),
(4, 'menu_09.png', 'ผัดบวบกุ้งใส่ไข่, ลาบหมู', 35, 'ข้าวกล่องเซต4', NULL),
(5, 'menu_15.png', 'ต้มข่าไก่, ไข่เจียว', 35, 'ข้าวกล่องเซต5', NULL),
(6, 'menu_16.png', 'แกงพะแนงหมู, ผัดเกียมฉ่ายใส่ไข่', 35, 'ข้าวกล่องเซต6', NULL),
(7, 'menu_17.png', 'แกงไตปลา, ผัดปลาดุกทอดกรอบ', 35, 'ข้าวกล่องเซต7', NULL),
(8, 'menu_18.png', 'แกงพะแนงหมู, ไข่ลูกเขย', 35, 'ข้าวกล่องเซต8', NULL),
(9, 'menu_03.png', 'ผัดถั่วพริกแกง,ไข่ลูกเขย', 35, 'ข้าวกล่องเซต9', NULL),
(10, 'menu_05.png', 'ไข่เจียว, ผัดปลาดุกทอดกรอบ', 35, 'ข้าวกล่องเซต10', NULL),
(11, 'menu_07.png', 'แกงไตปลา, ไข่ลูกเขย', 35, 'ข้าวกล่องเซต11', NULL),
(12, 'menu_09.png', 'ผัดบวบกุ้งใส่ไข่, ลาบหมู', 35, 'ข้าวกล่องเซต12', NULL),
(13, 'menu_15.png', 'ต้มข่าไก่, ไข่เจียว', 35, 'ข้าวกล่องเซต13', NULL),
(14, 'menu_16.png', 'แกงพะแนงหมู, ผัดเกียมฉ่ายใส่ไข่', 35, 'ข้าวกล่องเซต14', NULL),
(15, 'menu_17.png', 'แกงไตปลา, ผัดปลาดุกทอดกรอบ', 35, 'ข้าวกล่องเซต15', NULL),
(16, 'menu_18.png', 'แกงพะแนงหมู, ไข่ลูกเขย', 35, 'ข้าวกล่องเซต16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productst`
--
ALTER TABLE `productst`
  ADD PRIMARY KEY (`productst_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productst`
--
ALTER TABLE `productst`
  MODIFY `productst_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
