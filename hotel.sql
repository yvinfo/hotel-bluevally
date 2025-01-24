-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 08:34 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `no` int(10) NOT NULL,
  `rno` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pno` bigint(10) NOT NULL,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `peop` varchar(20) NOT NULL,
  `price` bigint(50) NOT NULL,
  `pstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`no`, `rno`, `name`, `pno`, `cin`, `cout`, `peop`, `price`, `pstatus`) VALUES
(45, 101, 'pal', 8980017225, '2025-01-14', '2025-01-16', '2', 8000, ''),
(54, 102, 'yash', 9313481915, '2025-01-19', '2025-01-20', '4', 1500, 'cancelled'),
(55, 101, 'yash', 9313481915, '2025-01-28', '2025-01-31', '2', 12000, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `date` date NOT NULL,
  `rev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`no`, `name`, `phone`, `date`, `rev`) VALUES
(41, 'pal', 6359985443, '2024-06-29', 'pizaa');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `no` int(11) NOT NULL,
  `amount` bigint(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `adddetails` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`no`, `amount`, `method`, `adddetails`, `status`) VALUES
(51, 8000, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(53, 1000, 'debit_card', 'Card Number: 1220343456567887, Expiry Date: 11/12, CVV: 000', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 1500, 'upi', 'UPI ID: yashvekariya23@okicici', 'completed'),
(54, 750, 'refund', 'Refund issued to bank', 'completed'),
(55, 12000, 'debit_card', 'Card Number: 1212343456567878, Expiry Date: 11/12, CVV: 000', 'completed'),
(55, 6000, 'refund', 'Refund issued to bank', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pno` bigint(10) NOT NULL,
  `psw` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `uname`, `email`, `pno`, `psw`) VALUES
(13, 'yash', 'yashvekariya23@gmail.com', 9313481915, '123'),
(15, 'pal', 'pal23@gmail.com', 1233212349, '123');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `rno` int(10) NOT NULL,
  `nbed` bigint(5) NOT NULL,
  `fac` varchar(100) NOT NULL,
  `price` bigint(50) NOT NULL,
  `rimg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`rno`, `nbed`, `fac`, `price`, `rimg`) VALUES
(101, 1, 'Ac-Room,Room Service,Free Wifi,Free Parking,Free Gym,Laudary', 4000, 'Room1.jpeg'),
(102, 3, 'Ac-Room,Room Service,Free Wifi,Free Parking,Free Gym,Laudary', 1000, 'background.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`rno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
