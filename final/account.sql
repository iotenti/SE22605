-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 05:08 PM
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `heard` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `phone`, `heard`, `contact`, `comments`) VALUES
(1, 'ian@mail.com', '508-951-2622', 'Friend', 'Text', 'hello'),
(2, 'ian@gmail.com', '508-951-4944', 'Search Engine', 'phone', 'HELLO WORLD'),
(3, 'feff@gmail.com', '5555555555', 'Friend', 'text', 'HELLO WORLD'),
(4, 'feff@gmail.com', '5555555555', 'Friend', 'text', 'HELLO WORLD'),
(5, 'fas', 'fds', 'Friend', 'text', 'fd'),
(6, 'sdfg', 'gfd', 'Friend', 'email', 'fdsfsd'),
(7, 'werg', 'gre', 'Friend', 'email', 'gre'),
(8, 'ian@email.org', '5345345345', 'Friend', 'email', ''),
(9, 'ian@esnail.org', '5345345345', 'Friend', 'text', ''),
(10, 'asedgfok@asd.com', '5345345345', 'Friend', 'email', ''),
(11, 'fd@is.ce', '2341', 'Search Engine', 'email', ''),
(12, 'sdfg@gasdfg.org', '3248273487', 'Friend', 'email', ''),
(13, 'sdfg@gasdfg.or', '134566', 'Friend', 'email', 'gsdfgsdfg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
