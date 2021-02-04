-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 09:48 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ampjam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_responses`
--

CREATE TABLE `form_responses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_responses`
--

INSERT INTO `form_responses` (`id`, `name`, `email`, `question`, `timestamp`) VALUES
(1, 'Preston Curtis', 'pcurtis@email.com', 'How many weeks in a year?', '2020-04-19 18:05:09'),
(2, 'Ginger Baker', 'gbaker@email.com', 'How do you make gluten free pancakes?', '2020-04-19 18:05:53'),
(3, 'Candice Craig', 'candicec@email.com', 'What\'s the best place to go rock climbing?', '2020-04-19 18:07:22'),
(4, 'Damon Casey', 'dcasey@email.com', 'How do you open a bank account?', '2020-04-19 18:09:06'),
(5, 'Vanessa Roberts', 'vroberts@email.com', 'How should I decide what laptop to buy?', '2020-04-19 18:11:45'),
(6, 'Ernest Lee', 'elee@email.com', 'How many people are in the world?', '2020-04-19 18:31:42'),
(7, 'Janis Hughes', 'jhughes@email.com', 'How do you write a resume?', '2020-04-19 18:32:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_responses`
--
ALTER TABLE `form_responses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_responses`
--
ALTER TABLE `form_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
