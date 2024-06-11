-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table carrental.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
                                          `user_id` int NOT NULL AUTO_INCREMENT,
                                          `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table carrental.cars
CREATE TABLE IF NOT EXISTS `cars` (
                                      `car_id` int NOT NULL AUTO_INCREMENT,
                                      `user_id` int DEFAULT NULL,
                                      `car_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `transmission` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `year` int DEFAULT NULL,
    `availability_status` tinyint(1) DEFAULT NULL,
    `rental_rate` decimal(10,2) DEFAULT NULL,
    `description` text COLLATE utf8mb4_general_ci,
    `image_1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_3` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_6` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_7` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_7` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_8` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    PRIMARY KEY (`car_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table carrental.user_rented_cars
CREATE TABLE IF NOT EXISTS `user_rented_cars` (
    `rental_id` int NOT NULL AUTO_INCREMENT,
                                                  `user_id` int DEFAULT NULL,
                                                  `car_id` int DEFAULT NULL,
                                                  `rent_date` date DEFAULT NULL,
                                                  PRIMARY KEY (`rental_id`),
    KEY `user_id` (`user_id`),
    KEY `car_id` (`car_id`),
    CONSTRAINT `user_rented_cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`),
    CONSTRAINT `user_rented_cars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
carrental