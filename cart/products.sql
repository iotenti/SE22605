-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2017 at 03:06 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpclassfall2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `product` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product`, `price`, `image`) VALUES
(7, 12, 'Benson Chimera', 3099.00, 'chimera_black02.jpg'),
(8, 12, 'Milkman 50W Sideman', 1949.00, '50W_Choc_grande.png'),
(9, 12, 'Supro 1650RT Royal Reverb', 1499.00, 'Royal-Reverb-MKII-Front-Web-1024x790.jpg'),
(10, 12, 'Tone King IMPERIAL MK II', 2595.00, 'ToneKing_Imperial-MarkII_black_front_2000x2000.jpg'),
(11, 11, 'Nord Piano 3 88-Key Piano', 2999.00, 'nord.png'),
(12, 11, 'Kawai 88-Key Digital Piano ', 1149.00, 'shopping.jpg'),
(13, 11, 'Yamaha Clavinova CLP-675 - Rosewood', 4699.00, 'shopping (1).jpg'),
(14, 11, 'Korg SV-1 88-Key Stage Vintage Piano Black', 1599.99, 'fe.jpg'),
(15, 13, 'Ernie Ball Music Man Cutlass Trem Rosewood Fingerboard Electric Guitar Vintage Sunburst', 1569.00, 'shopping (2).jpg'),
(16, 13, 'Island Forty-Four', 2700.00, 'P140812001_photo-01.jpg'),
(17, 13, 'Novo Serus J', 3214.00, 'DSCF5192-570x570.jpg'),
(18, 13, 'Ronin Mirari', 4900.00, '16397398592_08524f1a7d_b.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
