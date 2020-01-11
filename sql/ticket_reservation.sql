-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2018 at 06:38 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_info`
--

CREATE TABLE `tbl_admin_info` (
  `admin_id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_url` varchar(40) NOT NULL,
  `activation_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin_info`
--

INSERT INTO `tbl_admin_info` (`admin_id`, `name`, `email`, `phone_number`, `address`, `password`, `img_url`, `activation_status`) VALUES
(28, 'SAAD', 'abd@gmail.com', '01904654712', 'Uttara Dhaka 1230', '202cb962ac59075b964b07152d234b70', 'agent_img/saad.jpg', 1),
(30, 'Abdullah', 'abd1@gmail.com', '15103029', 'Uttara', '202cb962ac59075b964b07152d234b70', 'agent_img/1a28626aa6.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agent_info`
--

CREATE TABLE `tbl_agent_info` (
  `agent_id` int(11) NOT NULL,
  `counter_id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(33) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_url` varchar(40) NOT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_agent_info`
--

INSERT INTO `tbl_agent_info` (`agent_id`, `counter_id`, `name`, `email`, `phone_number`, `address`, `password`, `img_url`, `active_status`) VALUES
(1, 2, 'Saad', 'raselhasandurjoy@gmail.com', '01960015012', 'uttara Dhaka', '202cb962ac59075b964b07152d234b70', 'agent_img/saad.jpg', 1),
(36, 2, 'Md. Abdullah', 'abd@gmail.com', '01738868597', 'Uttara', '1cc39ffd758234422e1f75beadfc5fb2', 'agent_img/a60cd11db5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booked_seats`
--

CREATE TABLE `tbl_booked_seats` (
  `id` int(11) NOT NULL,
  `pnr_no` int(40) NOT NULL,
  `trip_id` int(40) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `seat_no` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `seat_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booked_seats`
--

INSERT INTO `tbl_booked_seats` (`id`, `pnr_no`, `trip_id`, `passenger_id`, `seat_no`, `date`, `seat_status`) VALUES
(98, 24565, 6, 4, 'A1', '2018-04-10', 0),
(99, 24565, 6, 4, 'A2', '2018-04-10', 0),
(100, 14729, 6, 4, 'B2', '2018-04-10', 0),
(103, 28046, 6, 4, 'D3', '2018-04-10', 1),
(105, 27611, 5, 4, 'A2', '2018-04-10', 1),
(106, 27611, 5, 4, 'A1', '2018-04-10', 1),
(107, 15227, 5, 4, 'C4', '2018-04-06', 1),
(108, 15227, 5, 4, 'C3', '2018-04-06', 1),
(109, 8016, 5, 6, 'A1', '2018-04-07', 1),
(110, 8016, 5, 6, 'A2', '2018-04-07', 1),
(111, 8016, 5, 6, 'B1', '2018-04-07', 1),
(112, 8016, 5, 6, 'B2', '2018-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_info`
--

CREATE TABLE `tbl_booking_info` (
  `booking_id` int(40) NOT NULL,
  `pnr_no` int(40) NOT NULL,
  `trip_id` int(40) NOT NULL,
  `counter_id` int(40) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `reference_no` varchar(60) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `journey_date` date NOT NULL,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `booking_status` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking_info`
--

INSERT INTO `tbl_booking_info` (`booking_id`, `pnr_no`, `trip_id`, `counter_id`, `passenger_id`, `reference_no`, `total_amount`, `journey_date`, `booking_date`, `booking_status`) VALUES
(12, 24565, 6, 2, 4, '1231sfsw', 1120, '2018-04-10', '2018-04-05 19:48:22', 2),
(13, 14729, 6, 2, 4, 'fchdfw643', 560, '2018-04-10', '2018-04-05 17:58:52', 0),
(16, 28046, 6, 2, 4, 'dfst353', 560, '2018-04-10', '2018-04-05 20:05:53', 1),
(18, 27611, 5, 2, 4, 'swfre d', 3000, '2018-04-10', '2018-04-05 20:33:32', 1),
(19, 15227, 5, 2, 4, 'vdfe34', 3000, '2018-04-06', '2018-04-07 02:40:37', 1),
(20, 8016, 5, 2, 6, '4777', 6000, '2018-04-07', '2018-04-07 16:29:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bus_info`
--

CREATE TABLE `tbl_bus_info` (
  `bus_id` int(11) NOT NULL,
  `bus_no` varchar(11) NOT NULL,
  `bus_type` char(20) NOT NULL,
  `img_bus` varchar(40) NOT NULL,
  `no_of_seats` int(11) NOT NULL DEFAULT '40'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bus_info`
--

INSERT INTO `tbl_bus_info` (`bus_id`, `bus_no`, `bus_type`, `img_bus`, `no_of_seats`) VALUES
(1, 'Shohag-01', 'A/C Sleeper', 'img/74626c9da5.jpg', 40),
(2, 'Shohag-02', 'Non A/C', 'img/9846.jpg', 40),
(3, 'ENA-01', 'A/C Sleeper', 'img/32537.jpg', 40),
(4, 'ENA-02', 'Non A/C', 'img/27614.jpg', 40);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancel_request`
--

CREATE TABLE `tbl_cancel_request` (
  `request_id` int(11) NOT NULL,
  `pnr_no` int(40) NOT NULL,
  `counter_id` int(40) NOT NULL,
  `bkash_no` varchar(15) NOT NULL,
  `cancel_status` int(15) NOT NULL DEFAULT '0',
  `cancel_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cancel_request`
--

INSERT INTO `tbl_cancel_request` (`request_id`, `pnr_no`, `counter_id`, `bkash_no`, `cancel_status`, `cancel_date`) VALUES
(7, 28046, 2, '01738868597', 0, '2018-04-06 21:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `city_id` int(40) NOT NULL,
  `city_name` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`city_id`, `city_name`) VALUES
(1, 'Dhaka'),
(4, 'Sylhet'),
(5, 'Gazipur'),
(6, 'Barguna'),
(7, 'BARISAL'),
(8, 'Bhola'),
(9, 'Jhalokati'),
(10, 'Patuakhali'),
(11, 'Pirojpur'),
(12, 'Bandarban'),
(13, 'Brahmanbaria'),
(14, 'Chandpur'),
(15, 'Chittagong'),
(16, 'Comilla'),
(17, 'Cox\'s Bazar'),
(18, 'Feni'),
(19, 'Khagrachhari'),
(20, 'Lakshmipur'),
(21, 'Noakhali'),
(22, 'Rangamati'),
(24, 'Faridpur'),
(25, 'Gopalganj'),
(27, 'Kishoreganj'),
(28, 'Madaripur'),
(29, 'Manikganj'),
(30, 'Munshiganj'),
(31, 'Narayanganj'),
(32, 'Narsingdi'),
(33, 'Rajbari'),
(34, 'Shariatpur'),
(35, 'Tangail'),
(36, 'Bagerhat'),
(37, 'Chuadanga'),
(38, 'Jessore'),
(39, 'Jhenaidah'),
(40, 'Khulna'),
(41, 'Kushtia'),
(42, 'Magura'),
(43, 'Meherpur'),
(44, 'Narail'),
(45, 'Satkhira'),
(46, 'Jamalpur'),
(47, 'Mymensingh'),
(48, 'Netrakona'),
(49, 'Sherpur'),
(50, 'Bogra'),
(51, 'Joypurhat'),
(52, 'Naogaon'),
(53, 'Natore'),
(54, 'Chapainawabganj'),
(55, 'Pabna'),
(56, 'Rajshahi'),
(57, 'Sirajgonj'),
(58, 'Dinajpur'),
(59, 'Gaibandha'),
(60, 'Kurigram'),
(61, 'Lalmonirhat'),
(62, 'Nilphamari'),
(63, 'Panchagarh'),
(64, 'Rangpur'),
(65, 'Thakurgaon'),
(66, 'Habiganj'),
(67, 'Moulvibazar'),
(68, 'Sunamganj');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complain`
--

CREATE TABLE `tbl_complain` (
  `com_id` int(40) NOT NULL,
  `com_nam` char(40) NOT NULL,
  `com_email` varchar(60) NOT NULL,
  `subject` char(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_complain`
--

INSERT INTO `tbl_complain` (`com_id`, `com_nam`, `com_email`, `subject`, `description`) VALUES
(1, 'akram chowdhuri', 'akram@gmail.com', 'Booking Issues', 'In Ena transport I did not get booking after payment'),
(2, 'mahmud mahadi', 'mahadi@gmail.com', 'Booking Issues', 'did not get booking after payment');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter_info`
--

CREATE TABLE `tbl_counter_info` (
  `counter_id` int(40) NOT NULL,
  `city_name` char(40) NOT NULL,
  `counter_name` char(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `location_counter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_counter_info`
--

INSERT INTO `tbl_counter_info` (`counter_id`, `city_name`, `counter_name`, `contact_no`, `location_counter`) VALUES
(1, 'Dhaka', 'Mohakhali Bus Stand', '01754598965 ', 'Mohakhali, Dhaka'),
(2, 'Dhaka', 'Abdullahpur', '01754598965', 'Abdullahpur, Uttara, Dhaka'),
(3, 'Dhaka', 'Kuril Bus Point', '01754598965 ', 'Kuril Bishw Road, Dhaka'),
(4, 'Dhaka', 'Middle Badda Bus Poin', '01745485478', 'Middle Badda, Dhaka'),
(5, 'Dhaka', 'Kuril Bus Point', '01645874557', 'Kuril Bishw Road, Dhaka'),
(7, 'Dhaka', 'Sohagh, Abdullahpur', '03489498412', 'Uttara, Sector 11, Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_passenger_info`
--

CREATE TABLE `tbl_passenger_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_passenger_info`
--

INSERT INTO `tbl_passenger_info` (`id`, `name`, `address`, `email`, `mobile`, `password`) VALUES
(1, 'Abdullah', 'Uttara', 'abdullah001rti@gmail.com', '01738868597', '25199d992c5541ac329277c20205ba18'),
(5, 'MD. Abdullah', 'Bamnartek, Uttara, Dhaka-1230', 'abd1@gmail.com', '01738868597', '41a60377ba920919939d83326ebee5a1'),
(4, 'Abdullah', 'Uttara', 'abd@gmail.com', '01738868597', '41a60377ba920919939d83326ebee5a1'),
(6, 'SAAD', 'Uttara Dhaka', 'raselhasandurjoy@gmail.com', '01904654712', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reserved_seat`
--

CREATE TABLE `tbl_reserved_seat` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `booked_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `seat_no` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reserved_seat`
--

INSERT INTO `tbl_reserved_seat` (`id`, `trip_id`, `user_id`, `session_id`, `bus_id`, `booked_time`, `date`, `seat_no`) VALUES
(1359, 5, 5, 'dttc5l1m9d3j9ac4gih21nab82', 1, '2018-04-06 21:54:49', '2018-04-11', 'I2'),
(1379, 5, 4, 't41p4rul5da01a6ve4ab2dh760', 1, '2018-04-06 22:04:25', '2018-04-11', 'G2'),
(1369, 5, 5, 'dttc5l1m9d3j9ac4gih21nab82', 1, '2018-04-06 21:59:57', '2018-04-11', 'H2'),
(1373, 5, 4, 't41p4rul5da01a6ve4ab2dh760', 1, '2018-04-06 22:00:14', '2018-04-11', 'A2'),
(1380, 5, 5, 'dttc5l1m9d3j9ac4gih21nab82', 1, '2018-04-06 22:04:28', '2018-04-11', 'F2'),
(1381, 5, 5, 'dttc5l1m9d3j9ac4gih21nab82', 1, '2018-04-06 22:04:29', '2018-04-11', 'E2'),
(1382, 5, 6, '32j84gg8e16n214qstmi7v8uqu', 1, '2018-04-07 22:19:42', '2018-04-07', 'A1'),
(1383, 5, 6, '32j84gg8e16n214qstmi7v8uqu', 1, '2018-04-07 22:19:43', '2018-04-07', 'A2'),
(1384, 5, 6, '32j84gg8e16n214qstmi7v8uqu', 1, '2018-04-07 22:19:43', '2018-04-07', 'B1'),
(1385, 5, 6, '32j84gg8e16n214qstmi7v8uqu', 1, '2018-04-07 22:19:44', '2018-04-07', 'B2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip_info`
--

CREATE TABLE `tbl_trip_info` (
  `trip_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `from_city` char(40) NOT NULL,
  `to_city` char(40) NOT NULL,
  `fare` varchar(40) NOT NULL,
  `departure_time` varchar(12) NOT NULL,
  `arrival_time` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_trip_info`
--

INSERT INTO `tbl_trip_info` (`trip_id`, `bus_id`, `from_city`, `to_city`, `fare`, `departure_time`, `arrival_time`) VALUES
(2, 2, 'Dhaka', 'Chittagong', '650', '14:46', '04:51'),
(3, 3, 'Dhaka', 'Chittagong', '1400', '17:46', '05:46'),
(4, 4, 'Dhaka', 'Chittagong', '530', '16:56', '06:54'),
(5, 1, 'Dhaka', 'Chittagong', '1500', '07:30', '18:00'),
(6, 2, 'Dhaka', 'Chittagong', '560', '08:30', '19:30'),
(7, 3, 'Dhaka', 'Chittagong', '1600', '09:30', '20:06'),
(8, 4, 'Dhaka', 'Chittagong', '500', '10:40', '21:30'),
(12, 2, 'Bogra', 'Feni', '450', '03:02', '23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_agent_info`
--
ALTER TABLE `tbl_agent_info`
  ADD PRIMARY KEY (`agent_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_booked_seats`
--
ALTER TABLE `tbl_booked_seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking_info`
--
ALTER TABLE `tbl_booking_info`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_bus_info`
--
ALTER TABLE `tbl_bus_info`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `tbl_cancel_request`
--
ALTER TABLE `tbl_cancel_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_complain`
--
ALTER TABLE `tbl_complain`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tbl_counter_info`
--
ALTER TABLE `tbl_counter_info`
  ADD PRIMARY KEY (`counter_id`);

--
-- Indexes for table `tbl_passenger_info`
--
ALTER TABLE `tbl_passenger_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reserved_seat`
--
ALTER TABLE `tbl_reserved_seat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_trip_info`
--
ALTER TABLE `tbl_trip_info`
  ADD PRIMARY KEY (`trip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_agent_info`
--
ALTER TABLE `tbl_agent_info`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_booked_seats`
--
ALTER TABLE `tbl_booked_seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tbl_booking_info`
--
ALTER TABLE `tbl_booking_info`
  MODIFY `booking_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_bus_info`
--
ALTER TABLE `tbl_bus_info`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cancel_request`
--
ALTER TABLE `tbl_cancel_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `city_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_complain`
--
ALTER TABLE `tbl_complain`
  MODIFY `com_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_counter_info`
--
ALTER TABLE `tbl_counter_info`
  MODIFY `counter_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_passenger_info`
--
ALTER TABLE `tbl_passenger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_reserved_seat`
--
ALTER TABLE `tbl_reserved_seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1386;

--
-- AUTO_INCREMENT for table `tbl_trip_info`
--
ALTER TABLE `tbl_trip_info`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
