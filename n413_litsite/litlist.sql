-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 06, 2020 at 05:48 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `litlist`
--

CREATE TABLE `litlist` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `litlist`
--

INSERT INTO `litlist` (`id`, `item`, `description`, `image`) VALUES
(1, 'Gibson Les Paul', '<p>The Gibson Les Paul is a solid body electric guitar that was first sold by the Gibson Guitar Corporation in 1952.  The Les Paul was designed by Gibson president Ted McCarty, factory manager John Huis and their team with input from and endorsement by guitarist Les Paul. Its typical design features a solid mahogany body with a carved maple top and a single cutaway, a mahogany set-in neck with a rosewood fretboard, two pickups with independent volume and tone controls, and a stoptail bridge, although variants exist.</p>\r\n\r\n<p>The Les Paul was originally offered with a gold finish and two P-90 pickups. In 1957, humbucking pickups were added, along with sunburst finishes in 1958. The sunburst 1958–1960 Les Paul – today one of the best-known electric guitar types in the world – was considered a failure, with low production and sales. For 1961, the Les Paul was redesigned into what is now known as the Gibson SG. The original single-cutaway, carved top bodystyle was re-introduced in 1968. The Les Paul has been produced in many versions and editions since. Along with Fender\'s Telecaster and Stratocaster, it was one of the first mass-produced electric solid-body guitars. Due to their versatility, Les Paul electric guitars have been used in a wide range of music genres, including rock, country, pop, soul, rhythm and blues, blues, jazz, reggae, punk, and heavy metal.</p>', 'images/lespaul.png'),
(2, 'Fender Telecaster', '<p>The Fender Telecaster, colloquially known as the \"Tele\", is the world\'s first commercially successful solid-body electric guitar. Its simple yet effective design and revolutionary sound broke ground and set trends in electric guitar manufacturing and popular music. Introduced for national distribution as the Broadcaster in the autumn of 1950, it was the first guitar of its kind manufactured on a substantial scale and has been in continuous production in one form or another since its first incarnation.</p>\r\n\r\n<p>Just like the Fender Stratocaster, the Telecaster is also a versatile guitar, usable for most styles of music and has been used in many genres, including country, reggae, rock, pop, folk, soul, blues, jazz, punk, metal, alternative, indie, and R&B.</p>', 'images/telecaster.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `litlist`
--
ALTER TABLE `litlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `litlist`
--
ALTER TABLE `litlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
