-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2025 at 05:12 AM
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
-- Database: `juju-dhau`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `product_id`, `userid`, `option_id`, `quantity`, `price`) VALUES
(90, 1, 1, 1, 1, 300),
(91, 1, 1, 3, 1, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Cash on Delivery',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `userid`, `total_amount`, `address`, `payment_method`, `order_date`, `status`, `quantity`) VALUES
(1, 1, 3660.00, 'bhaktapur', 'Cash on Delivery', '2025-01-10 08:03:08', 'Pending', NULL),
(2, 1, 300.00, 'bhak', 'Cash on Delivery', '2025-01-10 08:13:22', 'Pending', NULL),
(3, 1, 300.00, 'dsd', 'Cash on Delivery', '2025-01-10 08:17:00', 'Pending', NULL),
(4, 1, 300.00, 'hhh', 'Cash on Delivery', '2025-01-10 08:21:04', 'Pending', NULL),
(5, 1, 300.00, 'h', 'Cash on Delivery', '2025-01-10 08:21:52', 'Pending', NULL),
(6, 1, 300.00, 'ss', 'Cash on Delivery', '2025-01-10 08:30:10', 'Pending', NULL),
(7, 1, 1500.00, 'hh', 'Cash on Delivery', '2025-01-10 08:33:32', 'Pending', NULL),
(8, 1, 1500.00, 'ss', 'Cash on Delivery', '2025-01-10 08:33:49', 'Pending', NULL),
(9, 1, 1500.00, 'ss', 'Cash on Delivery', '2025-01-10 08:36:44', 'Pending', NULL),
(10, 1, 1500.00, 's', 'Cash on Delivery', '2025-01-10 08:36:54', 'Pending', NULL),
(11, 1, 1500.00, 's', 'Cash on Delivery', '2025-01-10 08:38:03', 'Pending', NULL),
(12, 1, 1500.00, 'ss', 'Cash on Delivery', '2025-01-10 08:38:10', 'Pending', NULL),
(13, 1, 1500.00, 'ss', 'Cash on Delivery', '2025-01-10 08:40:04', 'Pending', NULL),
(14, 1, 10800.00, 'ss', 'Cash on Delivery', '2025-01-10 08:44:37', 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `option_id`, `price`, `quantity`) VALUES
(11, 1, 3, 1, 60.00, 1),
(12, 1, 1, 2, 3600.00, 4),
(13, 2, 1, 1, 300.00, 1),
(14, 3, 1, 1, 300.00, 1),
(15, 4, 1, 1, 300.00, 1),
(16, 5, 1, 1, 300.00, 1),
(17, 13, 1, 1, 300.00, 1),
(18, 13, 1, 3, 1200.00, 1),
(19, 14, 1, 3, 3600.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `list_title` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_options` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `list_title`, `title`, `base_price`, `description`, `image_path`, `date_added`, `product_options`) VALUES
(1, 'Matka-Dhau', 'Matka-Dhau', 300.00, 'A traditional clay pot yogurt with a rich and creamy texture.', 'matka-dhau.png', '2024-10-27 02:51:57', '1,2,3'),
(2, 'Kalla-Dhau', 'Kalla-Dhau', 250.00, 'A delicious and thick yogurt made from cow\'s milk.', 'kalla-dhau.png', '2024-10-27 02:51:57', '1,2,3'),
(3, 'Cup-Dhau', 'Cup-Dhau', 60.00, 'A convenient cup of yogurt, perfect for on-the-go consumption.', 'cup.png', '2024-10-27 02:51:57', '1'),
(4, 'Plastic-Dhau', 'Plastic-Dhau', 200.00, 'A modern packaging option for your favorite yogurt.', 'plastic.png', '2024-10-27 02:51:57', '1,2,3'),
(5, 'Special Combo', 'Combo Kalla-Dhau + Cup-Dhau', 300.00, 'Enjoy the best of both worlds with this combo pack.', 'combo.png', '2024-10-27 02:51:57', '1,2,3');

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`option_id`, `option_name`) VALUES
(1, '1'),
(2, '3'),
(3, '4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `number`, `address`) VALUES
(1, 'Luffy', 'qwe@gmail.com', '123456', 2147483647, 'sfbaf dfbg dfbe dfb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `option_id` (`option_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `fk_cart_option` FOREIGN KEY (`option_id`) REFERENCES `product_options` (`option_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_details_option` FOREIGN KEY (`option_id`) REFERENCES `product_options` (`option_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_details_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_details_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
