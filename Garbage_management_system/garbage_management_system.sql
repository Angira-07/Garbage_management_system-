-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 04, 2025 at 11:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garbage_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timeStamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `timeStamp`) VALUES
(4, 'admin', '$2y$10$KW5iN8CtdOuu32RhPFmyn.ysH.FLOqT/GLPKSHLnPFgjRCZFJ7Qhm', '2025-04-12 21:01:36.196020'),
(5, 'admin2', '$2y$10$zjyTu02bhiMvto0hd5LOw.j.S.O5PLUBNVW9l0MWtPgTzpKej2WPe', '2025-04-12 21:02:33.261767');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `citi_id` int(11) UNSIGNED DEFAULT NULL,
  `bin_id` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `wasteType` varchar(50) NOT NULL,
  `freeDustbin` varchar(20) DEFAULT NULL,
  `interestRecycling` varchar(20) NOT NULL,
  `termsCondition` varchar(20) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`id`, `name`, `dob`, `gender`, `phone`, `email`, `password`, `Address`, `location`, `wasteType`, `freeDustbin`, `interestRecycling`, `termsCondition`, `timeStamp`, `reset_token`, `reset_token_expire`) VALUES
(32, 'Angira Bag', '2006-01-09', 'female', '123', 'angira@gmai.com', '$2y$10$fXyzIgsHsbepRPIPrrOO5uCY4lFH8C3d3.AB6wvs83w2Sq.mNKDVG', 'Aradhana, Dakshin Canel Par, Panagarh - 713148, West Bengal', '', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-27 15:57:56', NULL, NULL),
(33, 'uguyg', '0576-06-05', 'male', '57657', 'vghv@gmai.com', '$2y$10$rshTfa6UCbWfluNO7mRGl.VMBCq55J8SjnYtCIOYYktEN/jQqZlKG', 'gfc, ctfct, c - 3543, 35d', 'ctfc', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-27 08:22:22', NULL, NULL),
(34, 'tyfy', '0006-06-05', 'male', '45', 'ghgv@gmai.com', '$2y$10$DoEZIgpuF6j3uEpjck4v3u1LmVMWCq8OQXPuboHSGkafjH1TQFecu', 'dtd, dtrdt, d - 564, gf', 'cgfc', 'general', 'Yes', 'Yes', 'Agree', '2025-04-27 08:25:50', NULL, NULL),
(35, 'tytfy', '6576-07-05', 'male', '657', '67657@gmai.com', '$2y$10$hkoBW9H6bVPxNP4zQ7hzW.z2FcbXq2DrNqbv86.T8VX/3RjPTeKO6', 'tryr7, rtfyt, ytfytf - 1, uygu', 'gfu', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-27 08:41:22', NULL, NULL),
(36, 'urufuyf', '0065-07-05', 'male', '45454', '4546@gmail.com', '$2y$10$ceSOjWzisipLLALCRPTNPe.OdLWqg22BYlHNZ.Q8s49JBIggf29JW', 'tytytf, tfytf, tyfytf - 4654, 554654', '465465', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-29 08:24:13', NULL, NULL),
(37, 'tyughv', '0000-00-00', 'other', '4654', 'fgcg@gmai.com', '$2y$10$2XwShSUaKX3NtzEkuLH9GOOPv1XcXFFCxzs5HfipjmaN1efXNE1Zy', 'ghhgv, hgkbn, rytfy - 456465, cghchg', '', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-29 08:30:58', NULL, NULL),
(38, 'rdtrdtrdt', '5435-03-04', 'male', '45465454', 'ftrctfy@gmail.com', '$2y$10$tSrcuCUwUiTKtCFbJj3RwOjHXy2dUOZNmOwXijjW04Z3W34ts2RRW', 'rdtrdt, ewsresr, etretret - 1654654, dgdt', 'hfchgv', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-29 14:55:30', NULL, NULL),
(39, 'tftfytf', '7786-05-06', 'male', '54654654', 'dtfcfc@gmail.com', '$2y$10$7th5F9SN4GKkH9X/tBcLx.xxsY40RzdsKfHAL2xBxcOcrapNpVWii', 'tyfyfytfu, ewere, ewrewr - 434354, erssr', '', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-29 15:02:50', NULL, NULL),
(40, 'Angira Bag', '2006-01-09', 'female', '8172006524', 'surabhibag06@gmail.com', '$2y$10$WrMg8eHzzGFXrQgnzVdfIuxww965bRMs/y.i.OEn/ogQjNJ6kqH26', 'Aradhana, Dakshin Canel Par, Panagarh - 713148, West Bengal', '', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-30 07:12:10', 'afb9b4b89d3d7ea16eb973bc81dcd599', '2025-04-30'),
(41, 'again try', '0053-03-04', 'female', '12321', 'helloji000@gmail.com', '$2y$10$UFZ0ZkPGyl1hxGVsSi4KqeTj6GzXPzDjXin97zFLj4X4F4lfu4jdG', '6576576, 76576, 5765 - 7657, 6576', '576', 'organic', 'Yes', 'Yes', 'Agree', '2025-04-29 20:43:16', NULL, NULL),
(42, 'Arav Sinha', '2007-12-20', 'male', '1234567890', 'arav@gmail.com', '$2y$10$ToJOw2MkGeiNFSNZ4qMvoetxa6qGHJcVZulQezX.PzCTfYYM.QpCK', '123, Shanti Niwas, G.T. Road, Near HLG Hospital, Asansol - 713301, West Bengal', '', 'organic', 'Yes', 'Yes', 'Agree', '2025-05-03 11:56:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) UNSIGNED NOT NULL,
  `citi_id` int(11) UNSIGNED DEFAULT NULL,
  `driver_id` int(11) UNSIGNED DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `complain_date` datetime NOT NULL DEFAULT current_timestamp(),
  `assigned_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `admin_status` enum('Pending','Approved','Rejected','Resolved') NOT NULL DEFAULT 'Pending',
  `pickup_status` enum('Not Started','On the Way','Completed','') NOT NULL DEFAULT 'Not Started'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `citi_id`, `driver_id`, `type`, `description`, `location`, `complain_date`, `assigned_date`, `completion_date`, `admin_status`, `pickup_status`) VALUES
(6, 32, NULL, 'Missed Pickup', '6576576', 'wee', '2025-04-28 23:59:10', NULL, NULL, 'Rejected', 'Not Started'),
(7, 32, 2, 'Missed Pickup', '475rytfhgvg', '54545', '2025-04-29 00:03:02', NULL, NULL, 'Approved', 'Completed'),
(8, 32, NULL, 'Missed Pickup', 'hjhgvjhvjhvh', 'gugvuhvhjhj', '2025-04-29 04:12:51', NULL, NULL, 'Rejected', 'Not Started'),
(9, 32, 2, 'Overflowing Dustbin', 'yfyufyufuyu', 'guygygy', '2025-04-29 04:19:34', NULL, NULL, 'Approved', 'Completed'),
(10, 32, 2, 'Overflowing Dustbin', ' hbhbibu', 'yufygiu', '2025-04-29 04:20:45', NULL, NULL, 'Approved', 'Not Started'),
(11, 32, NULL, 'Missed Pickup', 'edyttf', 'etuf', '2025-04-29 04:21:27', NULL, NULL, 'Rejected', 'Not Started'),
(12, 32, 4, 'Missed Pickup', 'utfvu', 'dydy', '2025-04-29 04:23:33', NULL, NULL, 'Pending', 'On the Way'),
(13, 32, 4, 'Missed Pickup', 'hjhbjh', 'ytfuy', '2025-04-29 04:26:30', NULL, NULL, 'Approved', 'Not Started'),
(14, 32, 2, 'Overflowing Dustbin', 'utvu', 'tvugv', '2025-04-29 04:30:29', NULL, NULL, 'Approved', 'Not Started');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `licenseType` varchar(20) NOT NULL,
  `licenseNumber` varchar(20) NOT NULL,
  `vehicleType` varchar(20) NOT NULL,
  `vehicleNumber` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isVerified` tinyint(1) DEFAULT 0,
  `timeStamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `isBlocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `dob`, `gender`, `phone`, `email`, `address`, `licenseType`, `licenseNumber`, `vehicleType`, `vehicleNumber`, `username`, `password`, `isVerified`, `timeStamp`, `isBlocked`) VALUES
(2, 'Angira', '3232-12-23', 'female', '0123457890', 'angira0@gmail.com', 'a, b, c - 54, d', '3414', '4124', 'car', '3412', 'driver', '$2y$10$z1/imqjqCrh1vlGLN5wC6.49hY5C.yaMbZQ9ecsrAmh6Dqzol3LMa', 1, '2025-04-30 08:17:40.234801', 0),
(3, 'Surabhi', '0076-04-04', 'female', '987654321', 'surabhi07@gmail.com', 'g, b, c - 54, d', '7679', '658', 'car', '476', 'driver2', '$2y$10$IlsGDkAnuIE.BSYEHjWv3eyqv.MP8DRclI53OpYt7ew6PRoj625VC', 1, '2025-04-25 07:46:00.305955', 1),
(4, 'Aarohi', '6909-08-06', 'female', '02345678901', 'aarohi@gmail.com', 'a, q, r - 5, s', '24', '241', 'car', '243', 'driver3', '$2y$10$m2.BGVOc3YP6Kdd7FvWq2uZycwGsUeBm46WAloC5HwpPvo74nzCDm', 1, '2025-04-26 11:57:16.805830', 0),
(5, 'Arav', '4343-03-31', 'male', '1234', 'arav@gmai.com', 'Asia, India, Earth - 7867689876, Universe', '3414', '4124', 'bike', '546', 'driver4', '$2y$10$PV02OaH70JJjofFYPis15ObthaIV/xPOYNNwjXEJiAQN/LCG3Qbzq', 1, '2025-04-29 11:21:14.196581', 0),
(6, 'Arav', '0000-00-00', 'male', '12345', 'arav5@gmai.com', 'Asia, India, Earth - 7867689876, Universe', '3414', '4124', 'bike', '546', 'driver5', '$2y$10$JgGywoQC/muVg5TUJjobOeif0FSuhuDcdsVUkqr5vaHHTRzOwFGhW', 0, '2025-04-22 15:28:43.083857', 0),
(9, 'rddtydy', '7675-04-06', 'female', '43545', 'rdtgdtfd@gmail.com', 'rdtrd, dstrdtrd, esers - 546546, ttrsddtd', '464654', '43543', 'bike', 'tetret', 'driver9', '$2y$10$zVBi6aphwh762yLQYFxtx.XuZ14HJGwLnt4NeW8KJti.VNCPfeRgi', 0, '2025-04-29 15:07:33.834391', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dustbin`
--

CREATE TABLE `dustbin` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `size` varchar(10) NOT NULL,
  `type` varchar(30) NOT NULL,
  `stock` varchar(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `features` varchar(20) NOT NULL,
  `createTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `updateTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dustbin`
--

INSERT INTO `dustbin` (`id`, `name`, `image`, `size`, `type`, `stock`, `price`, `features`, `createTime`, `updateTime`, `latitude`, `longitude`) VALUES
(9, 'Yellow Plastic Dustbin', '51o+hhqB6SL._SL1500_.jpg', '20L', 'Medical Waste', '30', '300', 'Lockable Lid', '2025-05-03 11:40:13.446997', '2025-05-03 12:07:27.294587', '23.447241069528438', '87.4489974966855'),
(10, 'Blue Plastic Dustbin', '61u7vnWCUWL._SL1500_.jpg', '30L', 'E-waste', '40', '400', 'Lockable Lid', '2025-05-03 11:41:12.716294', '2025-05-03 11:41:12.716294', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `citi_id` int(11) UNSIGNED DEFAULT NULL,
  `bin_id` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(20) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'Cash On Delivery',
  `payment_status` varchar(20) DEFAULT 'Pending',
  `delivery_address` varchar(100) DEFAULT NULL,
  `checkout_time` datetime DEFAULT current_timestamp(),
  `update_time` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `order_status` varchar(20) DEFAULT 'Processing',
  `price` decimal(10,2) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `citi_id`, `bin_id`, `quantity`, `total_amount`, `payment_method`, `payment_status`, `delivery_address`, `checkout_time`, `update_time`, `order_status`, `price`, `latitude`, `longitude`) VALUES
(14, 40, 10, 1, 400.00, 'Cash On Delivery', 'Pending', 'Aradhana, Dakshin Canel Par, Panagarh - 713148, West Bengal', '2025-05-03 17:21:06', '2025-05-03 19:11:06.000000', 'Delivered', NULL, '23.41720527261352', '87.51892087049782'),
(15, 42, 9, 1, 300.00, 'Cash On Delivery', 'Pending', '123, Shanti Niwas, G.T. Road, Near HLG Hospital, Asansol - 713301, West Bengal', '2025-05-03 17:27:42', '2025-05-03 19:24:43.000000', 'Delivered', NULL, '23.712229320972135', '86.97509754449132'),
(16, 42, 10, 1, 400.00, 'Cash On Delivery', 'Pending', '123, Shanti Niwas, G.T. Road, Near HLG Hospital, Asansol - 713301, West Bengal', '2025-05-03 17:27:42', '2025-05-03 17:27:42.502396', 'Processing', NULL, NULL, NULL),
(17, 40, 9, 1, 300.00, 'Cash On Delivery', 'Pending', 'Aradhana, Dakshin Canel Par, Panagarh - 713148, West Bengal', '2025-05-04 13:30:52', '2025-05-04 13:31:43.000000', 'Delivered', NULL, '23.260167389540232', '87.85583490505816'),
(18, 40, 10, 1, 400.00, 'Cash On Delivery', 'Pending', 'Aradhana, Dakshin Canel Par, Panagarh - 713148, West Bengal', '2025-05-04 13:30:52', '2025-05-04 13:30:52.470626', 'Processing', NULL, NULL, NULL);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `set_update_time` BEFORE UPDATE ON `orders` FOR EACH ROW BEGIN
    SET NEW.update_time = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_citi_id` (`citi_id`),
  ADD KEY `fk_cart_bin_id` (`bin_id`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`id`,`phone`,`email`),
  ADD UNIQUE KEY `email` (`email`,`phone`),
  ADD UNIQUE KEY `phone` (`phone`,`email`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_driver_id` (`driver_id`),
  ADD KEY `fk_citi_id` (`citi_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `dustbin`
--
ALTER TABLE `dustbin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_bin_id` (`bin_id`),
  ADD KEY `fk_orders_citi_id` (`citi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `citizen`
--
ALTER TABLE `citizen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dustbin`
--
ALTER TABLE `dustbin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_bin_id` FOREIGN KEY (`bin_id`) REFERENCES `dustbin` (`id`),
  ADD CONSTRAINT `fk_cart_citi_id` FOREIGN KEY (`citi_id`) REFERENCES `citizen` (`id`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `fk_citi_id` FOREIGN KEY (`citi_id`) REFERENCES `citizen` (`id`),
  ADD CONSTRAINT `fk_driver_id` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_bin_id` FOREIGN KEY (`bin_id`) REFERENCES `dustbin` (`id`),
  ADD CONSTRAINT `fk_orders_citi_id` FOREIGN KEY (`citi_id`) REFERENCES `citizen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
