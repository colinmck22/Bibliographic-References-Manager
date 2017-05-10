-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2017 at 06:25 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `refs`
--

CREATE TABLE `refs` (
  `id` int(11) NOT NULL,
  `author` text NOT NULL,
  `year` int(11) NOT NULL,
  `title` text NOT NULL,
  `publisher` text NOT NULL,
  `place` text NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refs`
--

INSERT INTO `refs` (`id`, `author`, `year`, `title`, `publisher`, `place`, `tags`) VALUES
(1, 'A.I. Optify Data Science Team', 2017, 'Top 40 Software Engineering Books', 'http://www.aioptify.com', 'http://www.aioptify.com/top-software-books.php', 'Software Engineering Books'),
(2, 'Snooks & Co', 2017, 'Harvard Referencing for Visual Material', 'http://rmit.libguides.com', 'http://rmit.libguides.com/harvardvisual', 'Harvard Referencing'),
(3, 'w3schools', 2016, 'HTML Styles - CSS', 'https://www.w3schools.com', 'https://www.w3schools.com/html/html_css.asp', 'HTML - CSS Styles'),
(4, 'codecademy', 2016, 'PHP course', 'https://www.codecademy.com', 'https://www.codecademy.com/learn/php', 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'matt', 'smith', 3),
(2, 'joe', 'bloggs', 2),
(3, 'admin', 'admin', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refs`
--
ALTER TABLE `refs`
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
-- AUTO_INCREMENT for table `refs`
--
ALTER TABLE `refs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
