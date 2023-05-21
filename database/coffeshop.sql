-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2023 at 05:49 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `total_price`, `address`, `_status`) VALUES
(4, 1, 1234, NULL, 1),
(5, 1, 12, NULL, 1),
(6, 1, 1234, NULL, 1),
(7, 1, 1234, NULL, 1),
(8, 3, 1234, NULL, 0),
(9, 1, 4936, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Black Coffee'),
(2, 'Mocha Latee'),
(3, 'Espresso'),
(4, 'Latte'),
(5, 'Capuchino'),
(6, 'Americano');

-- --------------------------------------------------------

--
-- Table structure for table `detail_cart`
--

CREATE TABLE `detail_cart` (
  `id` int NOT NULL,
  `id_cart` int DEFAULT NULL,
  `id_product` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_cart`
--

INSERT INTO `detail_cart` (`id`, `id_cart`, `id_product`, `quantity`, `price`) VALUES
(6, 4, 4, 1, NULL),
(7, 5, 1, 1, NULL),
(8, 6, 4, 1, NULL),
(12, 7, 4, 1, NULL),
(13, 8, 3, 1, NULL),
(14, 9, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `id_cate` int DEFAULT NULL,
  `image` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `id_cate`, `image`) VALUES
(1, 'Capuchino ice', 12, 'This is the best of coffee', 5, '2.jpg'),
(2, 'Capuchino', 1234, 'Coffee best', 1, '1.jpg'),
(3, 'Capuchino', 1234, 'Coffee best', 1, '1.jpg'),
(4, 'Capuchino', 1234, 'Coffee best', 1, '1.jpg'),
(5, 'Capuchino', 1234, 'Coffee best', 1, '1.jpg'),
(6, 'Capuchino', 1234, 'Coffee best', 1, '1.jpg'),
(7, 'Capuchino', 1234, 'Coffee best', 2, '1.jpg'),
(8, 'Capuchino', 1234, 'Coffee best', 2, '1.jpg'),
(9, 'Capuchino', 1234, 'Coffee best', 2, '1.jpg'),
(10, 'Capuchino', 1234, 'Coffee best', 2, '1.jpg'),
(11, 'Capuchino', 1234, 'Coffee best', 2, '1.jpg'),
(12, 'Capuchino', 1234, 'Coffee best', 2, '1.jpg'),
(13, 'Capuchino', 1234, 'Coffee best', 3, '1.jpg'),
(14, 'Capuchino', 1234, 'Coffee best', 3, '1.jpg'),
(15, 'Capuchino', 1234, 'Coffee best', 3, '1.jpg'),
(16, 'Capuchino', 1234, 'Coffee best', 3, '1.jpg'),
(17, 'Capuchino', 1234, 'Coffee best', 3, '1.jpg'),
(18, 'Capuchino', 1234, 'Coffee best', 3, '1.jpg'),
(19, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(20, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(21, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(22, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(23, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(24, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(25, 'Capuchino', 1234, 'Coffee best', 4, '1.jpg'),
(26, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(27, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(28, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(29, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(30, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(31, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(32, 'Capuchino', 1234, 'Coffee best', 5, '1.jpg'),
(33, 'Capuchino', 1234, 'Coffee best', 6, '1.jpg'),
(34, 'Capuchino', 1234, 'Coffee best', 6, '1.jpg'),
(35, 'Capuchino', 1234, 'Coffee best', 6, '1.jpg'),
(36, 'Capuchino', 1234, 'Coffee best', 6, '1.jpg'),
(37, 'Capuchino', 1234, 'Coffee best', 6, '1.jpg'),
(38, 'Capuchino', 1234, 'Coffee best', 6, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `_user`
--

CREATE TABLE `_user` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `_password` text COLLATE utf8mb4_general_ci,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phonenumber` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_user`
--

INSERT INTO `_user` (`id`, `username`, `_password`, `full_name`, `phonenumber`, `role`, `email`) VALUES
(1, 'nguynvanky', '$2y$10$rHY23Ls7RE1K8tlRlIaX0OdwohuWhEdJvdy6FMspZhhGHv8sYL3Ai', 'Nguyễn Văn Kỳ', '1234567', 'user', 'nguynvanky@gmail.com'),
(3, 'admin', '$2y$10$UzfG2wNVb2YoiJldSgAN8.DqXG6PD3aXYxRk7J7JpjogpbUPlWo2.', 'admin', '1234567', 'admin', 'nguynvanky.work@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_cart`
--
ALTER TABLE `detail_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cart` (`id_cart`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cate` (`id_cate`);

--
-- Indexes for table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_cart`
--
ALTER TABLE `detail_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `_user`
--
ALTER TABLE `_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `_user` (`id`);

--
-- Constraints for table `detail_cart`
--
ALTER TABLE `detail_cart`
  ADD CONSTRAINT `detail_cart_ibfk_2` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `detail_cart_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_cate`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
