-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 11:37 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Mohammad Amjad Alazzam', 'Azzam@az.com', '123123'),
(3, 'Amr Azzam', 'Azzam@azz.com', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(15, 'la liga', 'la.jpg'),
(16, 'premier league', 'po.jpg'),
(18, 'Serie A', 'sa.jpg'),
(19, 'Bundis League', 'ba.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `address`) VALUES
(1, 'Mohammad Amjad Mohammad Alazzam', 'alazzamhmode@gmail.com', '1', 'Amman');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `sub_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `product_id`, `order_id`, `quantity`, `sub_total`) VALUES
(16, 15, 29, 4, 760),
(17, 14, 30, 1, 120),
(18, 12, 31, 2, 154),
(19, 10, 31, 5, 100),
(20, 15, 31, 1, 190);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_pro` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name_pro` varchar(255) NOT NULL,
  `image_pro` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_pro`, `cat_id`, `name_pro`, `image_pro`, `price`, `description`, `quantity`) VALUES
(3, 15, 'Barcelona Hone', 'barcelona.jpg', 150, 'FC Barcelona  ', 10),
(6, 15, 'Real Madrid 3RD', 'real.jpg', 125, 'Real Madrid ', 10),
(7, 15, 'Barcelona Home Jersey 2019/2020', 'barhome.jpg', 125, 'The First Barcelona ', 10),
(8, 15, '2016/2017 Real Madrid Home Champions League', '1000__rmhss1617_cln_a.jpg', 124, ' Champions League', 10),
(9, 15, '2016/2017 Real Madrid Home Shorts', 'adidas-AI5202-Z-e1476027975109.jpg', 50, ' Real Madrid Home Shorts', 10),
(10, 15, '2016/2017 Real Madrid Scarf', 'thumb.jpg', 20, ' Scarf', 10),
(11, 15, 'Atletico Madrid Home 2019/2020', 'atletco.jpg', 126, 'Atletico Madrid Home', 10),
(12, 16, 'Arsenal Home 2019/2020 Jersey', 'asasa.jpg', 77, 'The official Arsenal Adult 19/20 Short Sleeved Home Shirt has been created by adidas for our fans with a looser fit than that worn by the players on the pitch. The shirt displays our iconic home colours of red and white with form-fitting sleeves and takin', 10),
(13, 16, '2017/2018 Liverpool Home ', 'LFC-HM-17-18-1.jpg', 95, 'The perfect blend of heritage and quality, the 2017/18 Menâ€™s Replica Short Sleeve Home Shirt has a regular fit and has been designed for maximum style and comfort. Taking inspiration from some of the most iconic kits in LFC history, this kit features:  ', 10),
(14, 16, 'Manchester City Home 2017/2018', '1000__mancityhss1718_a.jpg', 120, 'This is the official Manchester City home shirt from Nike. In this football shirt, Manchester City plays the Premier League, FA Cup and Champions League matches at the Etihad Stadium during 2017-2018. Manchester City shirt is light blue this year and cont', 10),
(15, 18, 'AC Milan Home 2019-2020', 'AC-Milan-Home-Shirt-2019-2020-560x560.jpg', 190, 'AC Milan Home', 10),
(16, 18, 'AC Milan Away 2019-2020', 'AC-Milan-Away-2019-2020-560x560.jpg', 60, 'AC Milan Away ', 10),
(17, 19, 'Bayern Munich Home 2019/2020', 'Bayern-Munich-Home-Shirt-2019-2020-600x600.jpg', 144, 'Bayern Munich Home', 10),
(18, 19, 'BVB Away 2019/2020', 'borussia-dortmund-19-20-away-shirt-front-600x600.jpg', 15, 'BVB Away ', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `date` varchar(255) NOT NULL,
  `deliver_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `customer_id`, `total`, `date`, `deliver_date`) VALUES
(29, 1, 760, '20-05-17 11:05:02', '20-05-24'),
(30, 1, 120, '20-05-18 12:05:07', '20-05-25'),
(31, 1, 444, '20-05-18 01:05:57', '20-05-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_to_order_id` (`order_id`),
  ADD KEY `fk_order_items_item_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_pro`),
  ADD KEY `product_ibfk_1` (`cat_id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_ibfk_1` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_order_items_item_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_pro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_to_order_id` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
