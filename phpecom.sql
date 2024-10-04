-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 04:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`) VALUES
(7, 'Ford', 'f', 'BROOM', 0, 1, '1727685375.jpg', 'BROOM', 'BROOM', 'BROOM', '2024-09-30 08:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` mediumtext NOT NULL,
  `pincode` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(2, 'kapsupholstery8459165920867', 1, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 48600, 'Paid by Paypal', '8LK88440T74785613', 2, NULL, '2024-06-09 09:26:30'),
(3, 'kapsupholstery6040165920867', 1, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 7200, 'COD', '', 2, NULL, '2024-06-09 09:26:51'),
(4, 'kapsupholstery6141165920867', 1, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 9000, 'Paid by Paypal', '59T631887K9631908', 2, NULL, '2024-06-10 00:51:18'),
(5, 'kapsupholstery4937165920867', 1, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 9000, 'Paid by Paypal', '2H8062465U3316827', 2, NULL, '2024-06-10 01:04:02'),
(6, 'kapsupholstery9490165920867', 1, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 9000, 'Paid by Paypal', '7LG19257AD1886451', 2, NULL, '2024-06-10 01:06:46'),
(7, 'kapsupholstery1130165920867', 2, 'Michael', 'maykeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 18000, 'COD', '', 3, NULL, '2024-06-10 04:01:00'),
(8, 'kapsupholstery9525165920867', 2, 'Michael Coloma Umali', 'maykeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 18000, 'Paid by Paypal', '6KR15190DU299262F', 2, NULL, '2024-06-10 04:05:19'),
(9, 'kapsupholstery4365165920867', 1, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 9000, 'Paid by Paypal', '0TR09970CT393694N', 0, NULL, '2024-06-18 15:30:17'),
(10, 'kapsupholstery4807165920867', 2, 'Michael Coloma Umali', 'maykeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 18000, 'COD', '', 0, NULL, '2024-08-22 08:22:26'),
(11, 'kapsupholstery2505165920867', 2, 'Michael Coloma Umali', 'maykeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 62500, 'COD', '', 2, NULL, '2024-08-22 08:28:29'),
(12, 'kapsupholstery4430165920867', 2, 'Michael Coloma Umali', 'maykeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 100000, 'COD', '', 0, NULL, '2024-09-30 08:37:50'),
(13, 'kapsupholstery7500165920867', 2, 'Michael Coloma Umali', 'michaeumali234@gmail.com', '09165920867', '#52 Sunshine Subdivision', 2100, 60000, 'COD', '', 0, NULL, '2024-10-04 07:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `color_id`, `qty`, `price`, `created_at`) VALUES
(1, 2, 1, 2, 3, 7200, '2024-06-09 09:26:30'),
(2, 2, 2, 4, 3, 9000, '2024-06-09 09:26:30'),
(3, 3, 1, 1, 1, 7200, '2024-06-09 09:26:51'),
(4, 4, 2, 3, 1, 9000, '2024-06-10 00:51:18'),
(5, 5, 1, 1, 1, 9000, '2024-06-10 01:04:02'),
(6, 6, 1, 1, 1, 9000, '2024-06-10 01:06:46'),
(7, 7, 1, 1, 2, 9000, '2024-06-10 04:01:00'),
(8, 8, 1, 2, 2, 9000, '2024-06-10 04:05:19'),
(9, 9, 2, 3, 1, 9000, '2024-06-18 15:30:17'),
(10, 10, 1, 2, 2, 9000, '2024-08-22 08:22:26'),
(11, 11, 4, 6, 5, 12500, '2024-08-22 08:28:29'),
(12, 12, 8, 8, 5, 20000, '2024-09-30 08:37:50'),
(13, 13, 8, 8, 3, 20000, '2024-10-04 07:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `original_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `status`, `trending`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES
(8, 7, 'Ford Raptor', 'f-r', 'BROOM', 'BROOM', 25000, 20000, '1727685420.jpg', 17, 0, 0, 20, 'BROOM', ' BROOM', 'BROOM', '2024-09-30 08:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `seat_color`
--

CREATE TABLE `seat_color` (
  `id` int(11) NOT NULL,
  `color` varchar(30) NOT NULL,
  `img_src` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat_color`
--

INSERT INTO `seat_color` (`id`, `color`, `img_src`, `product_id`) VALUES
(2, 'Black', '1718728270.jpg', 1),
(3, 'Gray', '1717924468.jpg', 2),
(4, 'Brown', '1717924527.jpg', 2),
(5, 'Red', '1718728397.png', 3),
(7, 'Red', '1727685188.png', 6),
(8, 'Red', '1727685440.png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `verify_token` varchar(191) NOT NULL,
  `verify_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=notverified,1=verified',
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `phone`, `email`, `password`, `verify_token`, `verify_status`, `role_as`, `created_at`) VALUES
(3, 'Michael', '#52 Sunshine Subdivision', 2147483647, 'mcumali@bpsu.edu.ph', 'save2323', 'd725d33a6fd469a9594ed684737de24e', 1, 2, '2024-06-10 04:08:56'),
(4, 'Michael Coloma Umali', '#52 Sunshine Subdivision', 2147483647, 'michaeumali234@gmail.com', 'save2323', '1ddddf69c8139773f3c2bab27a0ecd1c', 1, 1, '2024-06-18 16:05:15'),
(5, 'Michael', '#52 Sunshine Subdivision', 2147483647, 'maykeumali234@gmail.com', 'save2323', 'a7befcf874a5d5e8b760e8a6256d78b0', 1, 0, '2024-10-04 08:10:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seat_color`
--
ALTER TABLE `seat_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seat_color`
--
ALTER TABLE `seat_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
