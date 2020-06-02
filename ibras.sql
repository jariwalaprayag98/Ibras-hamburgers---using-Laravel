-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2020 at 09:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibras`
--

-- --------------------------------------------------------

--
-- Table structure for table `hamburger`
--

CREATE TABLE `hamburger` (
  `ham_image` varchar(100) NOT NULL,
  `ham_name` varchar(20) NOT NULL,
  `ingredients` varchar(200) NOT NULL,
  `calories` float NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hamburger`
--

INSERT INTO `hamburger` (`ham_image`, `ham_name`, `ingredients`, `calories`, `price`) VALUES
('proyecto3correct/burguer3.png', 'Carne', 'Bread, Ham, Lettuce, Chicken, Pickle, Tomato, Sauce.', 350, 11.9),
('proyecto3correct/burguer1.png', 'Mixta', 'Bread, Ham, Lettuce, Tomato, Sauce.', 150, 11.9),
('proyecto3correct/burguer2.png', 'Polla', 'Bread, Ham, Cheese, Tomato', 250, 11.9);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `user_name` varchar(50) NOT NULL,
  `delivery_address` varchar(100) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `Qty` int(10) NOT NULL,
  `image` varchar(50) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`user_name`, `delivery_address`, `item_name`, `amount`, `Qty`, `image`, `remarks`) VALUES
('abc', '154 summit ave.', 'Polla', 11.9, 3, 'proyecto3correct/burguer2.png', 'Extra Cheese');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `c_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `comments` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`c_name`, `email`, `subject`, `comments`) VALUES
('sejal', 'sejal@gmail.com', 'Hamburgers', 'Very good hamburgers. '),
('Rutu', 'rutu@yahoo.com', 'Hamburgers', 'Nice place and good hamburgers.'),
('Prayag Jariwala', 'jariwalaprayag98@gmail.com', 'Burgers', 'One of the best places to have burgers..');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `email`, `password`, `role`, `address`) VALUES
('abc', 'abc@gmail.com', 'abcxyz', 'normal', '154 summit ave.'),
('prayag', 'prayagjariwala@gmail.com', 'prayag123', 'normal', '409 Summit Ave'),
('sejal', 'sejal@gmail.com', 'sejal123', 'admin', '413 Summit Ave'),
('stw', 'stw@gmail.com', 'stw123dds', 'normal', '1008 Greek Row'),
('xyz', 'xyz@gmail.com', 'xyz123', 'normal', '1006 Greek Row');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hamburger`
--
ALTER TABLE `hamburger`
  ADD PRIMARY KEY (`ham_name`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
