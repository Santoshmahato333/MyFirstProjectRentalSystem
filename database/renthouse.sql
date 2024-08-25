-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 01:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_property`
--

CREATE TABLE `add_property` (
  `property_id` int(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `vdc_municipality` varchar(50) NOT NULL,
  `ward_no` int(10) NOT NULL,
  `tole` varchar(100) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `estimated_price` bigint(10) NOT NULL,
  `total_rooms` int(10) NOT NULL,
  `bedroom` int(10) NOT NULL,
  `living_room` int(10) NOT NULL,
  `kitchen` int(10) NOT NULL,
  `bathroom` int(10) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `owner_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_property`
--

INSERT INTO `add_property` (`property_id`, `country`, `province`, `zone`, `district`, `city`, `vdc_municipality`, `ward_no`, `tole`, `contact_no`, `property_type`, `estimated_price`, `total_rooms`, `bedroom`, `living_room`, `kitchen`, `bathroom`, `description`, `latitude`, `longitude`, `owner_id`) VALUES
(123, 'Nepal', 'Province No. 1', 'Bagmati', 'Taplejung', 'Kirtipur', 'VDC', 3, 'palifal', 9860462146, 'Full House Rent', 0, 2, 3, 3, 3, 3, 'it is beautiful house', '27.679130', '85.327872', 2),
(124, 'Nepal', 'Province No. 1', 'Bagmati', 'Taplejung', 'Pokhara', 'VDC', 14, 'Lakeside', 9803480519, 'Full House Rent', 0, 15, 5, 2, 2, 7, ' This is a beautiful property located near Lakeside, Pokhara.', '27.679130', '85.327872', 2),
(134, 'Nepal', 'Bagmati Pradesh', 'Bagmati', 'Kathmandu', 'tinkune', 'Municipality', 32, 'subidhanagar', 9812121567, 'Full House Rent', 50000, 2, 1, 1, 1, 1, ' it is   a beautiful house with balconi', '27.716890', '85.324597', 4),
(135, 'Nepal', 'Bagmati Pradesh', 'Bagmati', 'Kathmandu', 'kathmandu', 'Municipality', 5, 'sundhara', 9812121566, 'Full House Rent', 75000, 2, 1, 1, 1, 1, 'it is   a beautiful house with balconi', '27.711898', '85.337702', 5),
(136, 'Nepal', 'Bagmati Pradesh', 'Bagmati', 'Kathmandu', 'kalimati', 'Municipality', 5, 'soltimor', 9812121566, 'Full House Rent', 65000, 2, 1, 1, 1, 1, 'it is   a beautiful house with balconi', '27.711898', '85.337702', 4),
(139, 'Nepal', 'Bagmati Pradesh', 'Bagmati', 'Kathmandu', 'kathmandu', 'Municipality', 2, 'patan', 9849148576, 'Full House Rent', 100000, 5, 2, 1, 1, 1, 'this is the beautiful property', '27.717245', '85.323961', 7),
(140, 'Nepal', 'Karnali Pradesh', 'Dhawalagiri', 'Rauthat', 'Quos minim corrupti', 'Municipality', 0, 'Labore sit autem in', 0, 'Flat Rent', 21, 26, 45, 54, 19, 9, 'Incidunt qui eos u', '27.679130', '85.344256', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(2, 'santoshmahato2481832@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(11) NOT NULL,
  `tid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `id_type` varchar(100) NOT NULL,
  `id_photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `full_name`, `email`, `password`, `phone_no`, `address`, `id_type`, `id_photo`) VALUES
(1, 'Santosh Mahato', 'santoshmahato2481832@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9812121566, 'Janakpur', 'Citizenship', 'owner-photo/santosh.png'),
(2, 'Pratik khanal', 'khanalprateek101@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 982345234, 'maitidevi', 'Citizenship', 'owner-photo/back citizenship.jpeg'),
(3, 'santosh', 'santosh123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 7735879230, 'lalitpur', 'Citizenship', 'owner-photo/Screenshot 2023-06-22 130903.png'),
(4, 'ankit karki', 'ankit123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9812191966, 'Bhaktapur', 'Citizenship', 'owner-photo/Screenshot 2024-05-11 125850.png'),
(5, 'Manish singh', 'manish123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9812121718, 'sundhara', 'Citizenship', 'owner-photo/Picture1.jpg'),
(7, 'Roshan Tandukar', 'roshan.tan005@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9849148576, 'Patan Campus', 'Citizenship', 'owner-photo/photo.avif');

-- --------------------------------------------------------

--
-- Table structure for table `property_photo`
--

CREATE TABLE `property_photo` (
  `property_photo_id` int(12) NOT NULL,
  `p_photo` varchar(500) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_photo`
--

INSERT INTO `property_photo` (`property_photo_id`, `p_photo`, `property_id`) VALUES
(176, 'product-photo/b.jpg', 124),
(193, 'product-photo/3d-house-model-with-modern-architecture.jpg', 134),
(194, 'product-photo/pexels-photo-106399.jpeg', 135),
(195, 'product-photo/download.jpeg', 136),
(198, 'product-photo/d872ec434885c6226aed345d8bb854cb.jpg', 139),
(199, 'product-photo/download (1).jpeg', 140);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `rating` int(5) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `comment`, `rating`, `property_id`) VALUES
(5, 'This property is very nice.', 5, 123),
(6, 'I love this property.', 4, 124),
(7, 'good', 0, 124),
(8, '', 3, 134),
(9, '', 3, 134),
(10, '', 3, 134),
(11, '', 3, 134),
(12, '', 5, 134);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `id_type` varchar(100) NOT NULL,
  `id_photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `full_name`, `email`, `password`, `phone_no`, `address`, `id_type`, `id_photo`) VALUES
(18, 'Santosh Kumar Mahato', 'santoshmahato2481832@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9812121566, 'Tinkune', 'Citizenship', 'tenant-photo/Screenshot 2024-01-24 085124.png'),
(19, 'Pratik Khanal', 'khanalprateek101@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 984782345, 'Sindhuli', 'Citizenship', 'tenant-photo/class 12 admit card.jpeg'),
(20, 'Prashon Gautam', 'prashon@gautam.com', '827ccb0eea8a706c4c34a16891f84e7b', 9834874346, 'Jhapa', 'Citizenship', 'tenant-photo/Front citizenship.jpeg'),
(21, 'santosh', 'lpg9n@bxxa.com', '827ccb0eea8a706c4c34a16891f84e7b', 9453803485, 'a8Wb2ic8j2', 'Citizenship', 'tenant-photo/Screenshot 2024-07-05 070957.png'),
(22, 'santosh', 'b0cy9@s5gn.com', '827ccb0eea8a706c4c34a16891f84e7b', 2741915837, '4zRrHRM8At', 'Citizenship', 'tenant-photo/Screenshot (11).png'),
(23, 'Ankit karki', 'ankit123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9812121568, 'jankpur', 'Citizenship', 'tenant-photo/download.jpg'),
(24, 'Nitesh Singh', 'nitesh123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 9812121666, 'mahendranagar', 'Citizenship', 'tenant-photo/not_found.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_property`
--
ALTER TABLE `add_property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `booking_ibfk_1` (`tid`),
  ADD KEY `booking_ibfk_2` (`pid`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `property_photo`
--
ALTER TABLE `property_photo`
  ADD PRIMARY KEY (`property_photo_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_property`
--
ALTER TABLE `add_property`
  MODIFY `property_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `property_photo`
--
ALTER TABLE `property_photo`
  MODIFY `property_photo_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_property`
--
ALTER TABLE `add_property`
  ADD CONSTRAINT `add_property_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tenant` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `add_property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_photo`
--
ALTER TABLE `property_photo`
  ADD CONSTRAINT `property_photo_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `add_property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `add_property` (`property_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
