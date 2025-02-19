-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2025 at 04:21 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `ausername` varchar(255) NOT NULL,
  `apassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `ausername`, `apassword`) VALUES
(1, 'Luffy', 'mugiwara');

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
(48, 2, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'ram', 'ram@gmail.com', 'hi my name is ram ', '2025-02-19 03:02:48'),
(2, 'ram', 'ram@gmail.com', 'hi my name is ram ', '2025-02-19 03:17:09'),
(3, 'ram', 'ram@gmail.com', 'hi my name is ram ', '2025-02-19 03:17:12'),
(4, 'ram', 'ram@gmail.com', 'hi my name is ram ', '2025-02-19 03:18:23'),
(5, 'shyam', 'shyam@gmail.com', 'i have been search this product.', '2025-02-19 03:19:55');

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
(21, 1, 12000.00, 'bb', 'Cash on Delivery', '2025-01-16 03:04:39', 'Pending', 10),
(22, 1, 12000.00, 'bkt', 'Cash on Delivery', '2025-01-17 03:03:41', 'Pending', 10),
(23, 1, 3000.00, 'address', 'Cash on Delivery', '2025-02-16 08:30:45', 'Pending', 10),
(24, 1, 250.00, 'ss', 'Cash on Delivery', '2025-02-16 15:16:00', 'Pending', 1),
(25, 1, 12000.00, 'bkt', 'Cash on Delivery', '2025-02-17 15:04:37', 'Pending', 10);

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
(15, 21, 1, 3, 12000.00, 10),
(16, 22, 1, 3, 6000.00, 5),
(17, 22, 5, 3, 6000.00, 5),
(18, 23, 1, 1, 3000.00, 10),
(19, 24, 2, 1, 250.00, 1),
(20, 25, 1, 3, 12000.00, 10);

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
  `number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `number`, `address`) VALUES
(1, 'Luffy', 'qwe@gmail.com', '123456', '2147483647', 'sfbaf dfbg dfbe dfb'),
(2, 'srisg', 'srisg@gmail.com', '123456789', '9876543210', 'Nepal bhaktapur chamasigh'),
(3, 'ram', 'ram@gmail.com', '9861040603', '9861040603', 'nepal bhaktapur champ'),
(4, 'ram ', 'ram@gmail.com', '123456', '9812312312', 'basd asda asda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `option_id` (`option_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
