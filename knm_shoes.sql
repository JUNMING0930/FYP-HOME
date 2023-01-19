-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 07:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knm_shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `Card_Number` varchar(16) NOT NULL,
  `Card_Name` varchar(200) NOT NULL,
  `Expiry_Month` int(2) NOT NULL,
  `Expiry_Year` int(2) NOT NULL,
  `Card_CVV` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`Card_Number`, `Card_Name`, `Expiry_Month`, `Expiry_Year`, `Card_CVV`) VALUES
('4848887511232233', 'Lim Jun Ming', 5, 25, 365);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(5) NOT NULL,
  `qty` int(10) NOT NULL,
  `size` int(5) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `qty`, `size`, `total_price`) VALUES
(15, 1, 6, 39, '180.00'),
(18, 2, 5, 39, '260.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `amount_paid` float(10,2) NOT NULL,
  `Status` int(1) NOT NULL,
  `payment_method` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fname`, `lname`, `email`, `phone`, `address`, `amount_paid`, `Status`, `payment_method`, `created_at`) VALUES
(1, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', ' 23,Jalan Pantai Emas 7,Taman Pantai Emas, 75200 Melaka', 1090.00, 3, 'Credit/Debit', '2023-01-19 04:13:01'),
(2, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', ' ', 260.00, 0, 'COD', '2023-01-19 04:52:00'),
(3, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 1540.00, 1, 'Credit/Debit', '2023-01-19 08:04:33'),
(4, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 1540.00, 0, 'Credit/Debit', '2023-01-19 08:04:37'),
(5, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 530.00, 0, 'Credit/Debit', '2023-01-19 08:21:50'),
(6, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 270.00, 0, 'Credit/Debit', '2023-01-19 08:26:57'),
(7, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 270.00, 0, 'Credit/Debit', '2023-01-19 08:28:18'),
(8, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 270.00, 0, 'Credit/Debit', '2023-01-19 08:28:50'),
(9, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 270.00, 0, 'Credit/Debit', '2023-01-19 08:30:56'),
(10, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 270.00, 0, 'Credit/Debit', '2023-01-19 08:31:28'),
(11, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 260.00, 0, 'Credit/Debit', '2023-01-19 08:32:03'),
(12, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 190.00, 0, 'COD', '2023-01-19 08:33:18'),
(13, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 270.00, 0, 'COD', '2023-01-19 08:46:20'),
(14, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 910.00, 2, 'Credit/Debit', '2023-01-19 16:37:40'),
(15, 3, 'Lim', 'Ming', 'limjunming0458@gmail.com', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka', 1630.00, 0, 'COD', '2023-01-19 17:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `ID` int(5) NOT NULL,
  `Product_ID` int(5) NOT NULL,
  `Order_ID` int(5) NOT NULL,
  `Order_Size` int(5) NOT NULL,
  `Order_Quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`ID`, `Product_ID`, `Order_ID`, `Order_Size`, `Order_Quantity`) VALUES
(1, 1, 1, 44, 6),
(2, 3, 2, 39, 1),
(3, 3, 3, 39, 3),
(4, 2, 3, 39, 3),
(5, 2, 5, 39, 1),
(6, 2, 5, 40, 1),
(7, 2, 6, 39, 1),
(8, 2, 7, 39, 1),
(9, 2, 8, 40, 1),
(10, 2, 9, 40, 1),
(11, 3, 11, 39, 1),
(12, 1, 12, 41, 1),
(13, 2, 13, 40, 1),
(14, 1, 14, 39, 5),
(15, 1, 15, 40, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(3) NOT NULL,
  `User_Email` varchar(100) NOT NULL,
  `User_Password` varchar(100) NOT NULL,
  `User_First_Name` varchar(100) NOT NULL,
  `User_Last_Name` varchar(100) NOT NULL,
  `User_Status` int(1) DEFAULT NULL,
  `User_Token` varchar(300) NOT NULL,
  `User_Phone` varchar(100) DEFAULT NULL,
  `User_Address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `User_Email`, `User_Password`, `User_First_Name`, `User_Last_Name`, `User_Status`, `User_Token`, `User_Phone`, `User_Address`) VALUES
(1, '2608marcuswan@gmail.com', 'Lim_020930', 'Lim', 'Tan', 1, '', NULL, NULL),
(2, 'limjunming8777@gmail.com', 'Lim_0930', 'Edmund', 'Tan', 1, '', NULL, NULL),
(3, 'limjunming0458@gmail.com', 'Lim_020930', 'Lim', 'Ming', 1, 'ab567148e764573dde1ffa9906f1896e', '0122310458', '23,Jalan Pantai Emas 7, Taman Pantai Emas, 75200 Melaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
