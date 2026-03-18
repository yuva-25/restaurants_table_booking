-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 07:41 PM
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
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `res_name` varchar(30) NOT NULL,
  `res_address` varchar(50) NOT NULL,
  `res_mobile` varchar(12) NOT NULL,
  `res_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `res_name`, `res_address`, `res_mobile`, `res_email`) VALUES
(1, 'Family Restaurant', 'Velayutham Road, Sivakasi - 626130', '9876543456', 'restaurant@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tablebooking`
--

CREATE TABLE `tablebooking` (
  `id` int(11) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `cus_address` varchar(50) NOT NULL,
  `no_adult` varchar(40) NOT NULL,
  `no_child` varchar(40) NOT NULL,
  `toatl_ppl` varchar(15) NOT NULL,
  `book_date` varchar(10) NOT NULL,
  `book_no` mediumtext NOT NULL,
  `cus_status` varchar(30) NOT NULL,
  `cus_remarks` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablebooking`
--

INSERT INTO `tablebooking` (`id`, `cus_name`, `mobile_number`, `cus_address`, `no_adult`, `no_child`, `toatl_ppl`, `book_date`, `book_no`, `cus_status`, `cus_remarks`) VALUES
(1, 'Kavin', '8765342432', 'Sivakasi', '2', '0', '2', '2025-02-18', 'BN/1', 'approved', 'table booked A1'),
(2, 'Muthu', '7646465354', 'VNR', '2', '2', '4', '2025-02-20', 'BN/2', 'rejected', 'rejected no table'),
(3, 'Vinothini', '9875634243', 'Sattur', '2', '3', '5', '2025-02-22', 'BN/3', '', ''),
(4, 'Anburaj', '9876543456', 'SIVAKASI', '2', '3', '5', '2025-02-23', 'BN/4', 'approved', 'table booked A2'),
(5, 'Maheswari', '9876543234', 'SRIVI', '3', '0', '3', '2025-02-25', 'BN/5', '', ''),
(6, 'Virat', '9876543245', 'RAJAPALAM', '2', '0', '2', '2025-02-09', 'BN/6', 'rejected', 'rejected no table');

-- --------------------------------------------------------

--
-- Table structure for table `tablename`
--

CREATE TABLE `tablename` (
  `table_id` int(11) NOT NULL,
  `table_num` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablename`
--

INSERT INTO `tablename` (`table_id`, `table_num`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'B1'),
(5, 'B2'),
(6, 'B3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablebooking`
--
ALTER TABLE `tablebooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablename`
--
ALTER TABLE `tablename`
  ADD PRIMARY KEY (`table_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tablebooking`
--
ALTER TABLE `tablebooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tablename`
--
ALTER TABLE `tablename`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
