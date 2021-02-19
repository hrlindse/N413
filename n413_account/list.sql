-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2021 at 03:25 AM
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
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `item`, `description`, `image`) VALUES
(1, 'Bagel', 'Ring-shaped, usually with a dense, chewy interior; usually topped with sesame or poppy seeds baked into the surface.', 'bagel.jpg'),
(2, 'Baguette', 'Thin elongated loaf, made of water, flour, yeast, and salt, instantly recognizable by slits cut in top surface before baking to allow gas expansion.', 'baguette.jpg'),
(3, 'Biscuit', 'This refers to the North American quick bread, generally light and fluffy, similar to a scone. Elsewhere the term biscuit means a small baked product that would be called either a cookie or a cracker in the United States and most of English-speaking Canada.', 'biscuit.jpg'),
(4, 'Cornbread', 'Made from cornmeal, can be baked or fried, has a golden appearance, usually has a moist interior.', 'cornbread.jpg'),
(5, 'English muffin', 'Small, round, thin, usually dusted with cornmeal and served split horizontally, toasted, buttered, eaten as a snack alone or part of meal, usually breakfast or, in the UK and Ireland, early-evening tea. In the UK, usually just called a muffin.', 'muffin.jpg'),
(6, 'Melonpan', 'Made of enriched dough covered in thin layer of crispy cookie dough.', 'melonpan.jpg'),
(7, 'Naan', 'A leavened and oven-baked flatbread, typical and popular in South, Central, and West Asia. Noted for its cooking in a tandoor.', 'naan.jpg'),
(8, 'Pita', 'Round with inner pocket, as it cooks, steam puffs up dough, as it cools and flattens a pocket is left in the middle.', 'pita.jpg'),
(9, 'Pumpernickel', 'Very heavy, dense, slightly sweet dark pure rye traditionally made with coarsely ground flour; now often made with mixed flour and whole grain berries.', 'pumpernickel.jpg'),
(10, 'Rye bread', 'Made of various fractions of rye grain flour, color light to dark via flour used and if colors added, usually denser and higher fiber than many common breads, darker color, stronger flavor.', 'rye.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
