-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2025 at 07:20 AM
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
-- Database: `skyrestaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `scategory`
--

CREATE TABLE `scategory` (
  `id` int(11) NOT NULL,
  `state` int(11) DEFAULT 1,
  `categoryId` int(11) NOT NULL,
  `categoryName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scategory`
--

INSERT INTO `scategory` (`id`, `state`, `categoryId`, `categoryName`) VALUES
(1, 1, 1, 'Specials'),
(2, 1, 2, 'Chinese'),
(3, 1, 3, 'Thai'),
(4, 1, 4, 'BBQ'),
(5, 1, 5, 'Drinks'),
(6, 1, 6, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `sitem`
--

CREATE TABLE `sitem` (
  `id` int(11) NOT NULL,
  `state` int(11) DEFAULT 1,
  `category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitem`
--

INSERT INTO `sitem` (`id`, `state`, `category`, `name`, `price`) VALUES
(1, 1, 2, 'Fried Rice', 4500),
(2, 1, 3, 'Thai spicy Prawn', 6000),
(3, 1, 4, 'Chicken Sautee', 5000),
(4, 1, 5, 'Tiger Beer', 1500),
(5, 1, 6, 'Ice Cream', 1200),
(6, 1, 7, 'Dried Nuts', 1000),
(7, 1, 2, 'Meat Ball sauce', 4000),
(8, 1, 2, 'Assorted Fried Vegetables', 4500),
(9, 1, 2, 'Tofu Curry', 4500),
(10, 1, 2, 'Chicken Feet salad', 5000),
(11, 1, 2, 'Fried Vermiceli', 4000),
(12, 1, 2, 'Fried Noodles', 4000),
(13, 1, 2, 'Mala Fish', 6000),
(14, 1, 2, 'Golden Prawn with Sauce', 7000),
(15, 1, 2, 'Prawn Paprika', 7000),
(16, 1, 2, 'Steamed Mutton', 7500),
(17, 1, 2, 'Kong Baung', 4000),
(18, 1, 3, 'Cripsy Mutton', 6000),
(19, 1, 3, 'Fish Paste & Vegetables', 4000),
(20, 1, 3, 'Grilled Pork Neck', 5000),
(21, 1, 3, 'Fried Chicken with Oyster Sauce', 5000),
(22, 1, 3, 'Fried Fish Cake Salad', 5500),
(23, 1, 3, 'Prawn Asparagus', 6000),
(24, 1, 4, 'Mutton Sautee', 5000),
(25, 1, 4, 'Chicken Sautee', 4000),
(26, 1, 4, 'Pork Sautee', 2500),
(27, 1, 4, 'Beef Tongue', 6000),
(28, 1, 4, 'Eel', 4000),
(29, 1, 4, 'Potato', 2500),
(30, 1, 4, 'Corn', 2500),
(31, 1, 5, 'Johny Walker', 2500),
(32, 1, 5, 'Jack Daniels', 2500),
(33, 1, 5, 'Glenfiddich', 3000),
(34, 1, 5, 'Strawberry Juice', 1500),
(35, 1, 5, 'Orange Juice', 1500),
(36, 1, 5, 'Apple Juice', 1500),
(37, 1, 6, 'Pudding', 1500),
(38, 1, 6, 'Sliced Fruits', 1500),
(39, 1, 1, 'BBQ set omakase', 6000),
(40, 1, 1, 'Special Fried Rice', 4500),
(41, 1, 1, 'Beer and Karaage', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `smanagement`
--

CREATE TABLE `smanagement` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
  `orderNo` varchar(50) NOT NULL,
  `tableNo` int(11) NOT NULL,
  `dateA` datetime NOT NULL DEFAULT current_timestamp(),
  `dateB` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smanagement`
--

INSERT INTO `smanagement` (`id`, `state`, `orderNo`, `tableNo`, `dateA`, `dateB`) VALUES
(1, 2, '20251227151955-9436', 1, '2025-12-27 15:19:55', '2025-12-27 15:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `sorder`
--

CREATE TABLE `sorder` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `orderNo` varchar(20) NOT NULL,
  `itemNo` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sorder`
--

INSERT INTO `sorder` (`id`, `state`, `orderNo`, `itemNo`, `amount`) VALUES
(1, 0, '20251227151955-9436', 39, 2),
(2, 0, '20251227151955-9436', 40, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scategory`
--
ALTER TABLE `scategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitem`
--
ALTER TABLE `sitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smanagement`
--
ALTER TABLE `smanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sorder`
--
ALTER TABLE `sorder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scategory`
--
ALTER TABLE `scategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sitem`
--
ALTER TABLE `sitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `smanagement`
--
ALTER TABLE `smanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sorder`
--
ALTER TABLE `sorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
