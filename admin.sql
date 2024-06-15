-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 10:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `adding_product`
--

CREATE TABLE `adding_product` (
  `Id` int(255) NOT NULL,
  `Product_Name` varchar(25) NOT NULL,
  `Catagory` varchar(25) NOT NULL,
  `Quantity` int(25) NOT NULL,
  `Price` int(25) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adding_product`
--

INSERT INTO `adding_product` (`Id`, `Product_Name`, `Catagory`, `Quantity`, `Price`, `image_path`) VALUES
(2, 'Rangila', 'Spicy', 50, 300, 'image/Patta.png'),
(7, 'Candy stick', 'Sweet', 60, 150, 'image/Candy.png'),
(12, 'Piro mango', 'Spicy', 40, 200, 'image/Spicy mango.png'),
(13, 'khattu', 'Salty', 45, 30, 'image/Khattu.png'),
(14, 'Tangy Mango', 'Tangy', 60, 120, 'image/Tangy mango.jpeg'),
(15, 'Imili', 'Tangy', 300, 120, 'image/Imili Spicy.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `Id` int(30) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Id` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Price` int(20) NOT NULL,
  `Quantity` int(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Id`, `Name`, `Price`, `Quantity`, `user_id`) VALUES
(54, 'Rangila', 300, 50, 1),
(55, 'Piro mango', 200, 40, 1),
(56, 'khattu', 30, 45, 1),
(57, 'Tangy Mango', 120, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `Id` int(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`Id`, `Name`, `Description`) VALUES
(1, 'Salty', 'This tangy and savory treat is known for its unique flavor profile that combines the natural sweetne'),
(2, 'Salty', 'This tangy and savory treat is known for its unique flavor profile that combines the natural sweetne'),
(3, 'Salty', 'This tangy and savory treat is known for its unique flavor profile that combines the natural sweetne'),
(4, 'Tangy', '**Tangy Titaura** is a beloved Nepali snack made from the pulp of fruits like lapsi (Nepali hog plum'),
(5, 'Spicy', '**Spicy Titaura** is a popular Nepali snack crafted from the pulp of fruits such as lapsi (Nepali ho'),
(6, 'Salty', 'This tangy and savory treat is known for its unique flavor profile that combines the natural sweetne'),
(7, 'Sweet', 'Enjoy the sweetness of the local plump ');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `User_id` int(255) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`User_id`, `Username`, `Password`) VALUES
(1, 'Sanchita Joshi', 'pass'),
(2, 'Rita joshi', 'hii');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Username` int(11) NOT NULL,
  `Products` int(11) NOT NULL,
  `Total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Id` int(255) NOT NULL,
  `Name` int(20) NOT NULL,
  `Mobile_Number` int(10) NOT NULL,
  `Email` varchar(10) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Confirm_password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Id`, `Name`, `Mobile_Number`, `Email`, `Password`, `Confirm_password`) VALUES
(1, 0, 2147483647, 'Sanchitajo', 'pass', 'pass'),
(2, 0, 2147483647, 'Sanchitajo', 'pass', 'pass'),
(3, 0, 2147483647, 'rita@gamil', 'hii', 'hii');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Review` text NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Id`, `user_id`, `Review`, `Rating`) VALUES
(1, 0, '', 5),
(2, 0, 'i am very happy the titaura is so delicious', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adding_product`
--
ALTER TABLE `adding_product`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adding_product`
--
ALTER TABLE `adding_product`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `Id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `Id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `User_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `login` (`User_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
