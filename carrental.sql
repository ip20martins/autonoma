-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 09:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `username`, `password`, `email`) VALUES
(2, 'test2', '$2y$10$SozetYskm5SGuVYiT9GxZ.6cHJmxzX6EMuDvTqOIeY/gygIawmtDy', 'test2@gmail.com'),
(3, 'aaa', 'aaaa', 'aaa@gmail.com'),
(4, 'testss', '$2y$10$gWgNftoZMtw43bvzwAviFulmRDKUwqSL.KfFbJM6bAstclsgf7/g.', 't@gmail.com'),
(5, 'norbertuhs', '$2y$10$vi6/iu0HgRHBYh.TCkXxKOGwaEgCI5o0F.EPIT7waXXhmkc8nALw2', 'asdasd@gmail.com'),
(6, 'sadaw142412', '$2y$10$29h3UJP1taW0Ijx3ZaD36uNkWGogo6AZDQPEXK2TWekrMFKnGdYVC', '2@gmail.com'),
(7, 'aaaa', '$2y$10$furbWA1v794nYr3eLiLwXucylMZayxxxIQC.RmjC76JVQi1VHkzlu', 'aaaa@g.com'),
(8, 'armands', '$2y$10$3EZ.xrSUkBPio/Z4Dcw2JOY8kQLCCa85XYivw3BoQdf/CgIcjODiK', 'armands@armands.com'),
(9, 'test5', '$2y$10$tYOdxh217S0jg4Sb.fag2uRXhjZzSQn.WvUDK2q48EPP3jYfXHQBW', 'test5@gmail.com'),
(10, 'test1', '$2y$10$qyb4Rt4uwXFGKgfZjqGUpeLi1zAQcjVfGC9dhOqEniB81x.aquF4a', 'test2@as.ocm'),
(11, 'test111', '$2y$10$OY8i.qHj8WhCsbXkpBWAWOiVblGbY0pG0wsprAjkwR9yl1lyf5VtK', 'test2@as.ocm'),
(12, 'TesT', '$2y$10$6954SCUKBYk1CxlVCDkbWO8x4B6bqtuzb5p/n.R1FfLAMtq7/LtSC', 'test0@123.com'),
(13, 'viensdivi', '$2y$10$g/u9pMORt.wZDVfOiJShoerQGnv1Lk8DO8GQ9OD1oQODBuJMl1LAi', 'viensdivi@12.aaa'),
(14, 'viensdivi1', '$2y$10$MtPKOxqB34gskfoxSrGZr.6a1VLf0a0.nQbmMU7HOqhljmS6kVdHS', 'viensdivi@12.aaa'),
(15, 'tests', '$2y$10$lV16EwiyDEeprVMBHHyqQOMvr1WBQLqFoAq2BgBwUR.sz4pdLywlm', 'tests@tests.lv'),
(16, 'tests112', '$2y$10$YcBYGdKv.R3bCyD3n/GtQ.HwDcudXUE8NQsxrb1ZXzSdw68Wh25kO', 'tests@tests.lv'),
(17, 'aaaaa', '$2y$10$47TVUha9h8zayeO0p3PWgefxqS4RxIMQojcsYYHnLbgiZkD8tFHHO', 'a@a.a'),
(18, 'test11', '$2y$10$1QOxjKQr4FG0FATAGnpYt.he/iRQgg1O0ekXvRvY4TPM/D1eubaQ2', 'test1@test.test'),
(19, 'test50', '$2y$10$ci9oDgZJqb5meVFisuFQJurFunjDuB7sIzaMqVuVXlsdv0oOpKZJa', 'test50@test50.test50');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(255) DEFAULT NULL,
  `transmission` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `mileage` decimal(50,0) DEFAULT NULL,
  `availability_status` tinyint(1) DEFAULT NULL,
  `rental_rate` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `transmission`, `year`, `color`, `mileage`, `availability_status`, `rental_rate`, `description`) VALUES
(1, 'bmw 5 series', 'automāts', 2000, 'melna', 10000, 1, 200.00, 'masina'),
(2, 'mercedes e300', 'automats', 2000, 'balts', 22222, 1, 150.00, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `rental_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_rented_cars`
--

CREATE TABLE `user_rented_cars` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `rent_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rented_cars`
--

INSERT INTO `user_rented_cars` (`rental_id`, `user_id`, `car_id`, `rent_date`) VALUES
(1, 2, 1, '2023-12-15'),
(2, 2, 2, '2023-12-14'),
(5, 9, 1, '2023-12-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `user_rented_cars`
--
ALTER TABLE `user_rented_cars`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_rented_cars`
--
ALTER TABLE `user_rented_cars`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `user_rented_cars`
--
ALTER TABLE `user_rented_cars`
  ADD CONSTRAINT `user_rented_cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`),
  ADD CONSTRAINT `user_rented_cars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
