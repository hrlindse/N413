-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 09:20 PM
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
-- Database: `n413`
--

-- --------------------------------------------------------

--
-- Table structure for table `dayplanner_events`
--

CREATE TABLE `dayplanner_events` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startDateTime` timestamp NULL DEFAULT NULL,
  `endDateTime` timestamp NULL DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `priority` int(1) NOT NULL,
  `projectID` int(11) DEFAULT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dayplanner_events`
--

INSERT INTO `dayplanner_events` (`id`, `userID`, `title`, `startDateTime`, `endDateTime`, `description`, `priority`, `projectID`, `tags`) VALUES
(1, 1, 'Exam 2', '2021-01-05 14:00:00', '2021-01-05 16:05:00', 'Test Event', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `dayplanner_projects`
--

CREATE TABLE `dayplanner_projects` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startDate` timestamp NULL DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `priority` int(1) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dayplanner_projects`
--

INSERT INTO `dayplanner_projects` (`id`, `userID`, `title`, `startDate`, `endDate`, `description`, `priority`, `tags`) VALUES
(1, 1, 'Test Project', '2021-03-04 05:00:00', '2021-03-31 04:00:00', 'This is the first project', 0, 'test, project, misc'),
(2, 1, 'Test Project 2', NULL, NULL, 'Test description', 1, 'tags');

-- --------------------------------------------------------

--
-- Table structure for table `dayplanner_tasks`
--

CREATE TABLE `dayplanner_tasks` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL,
  `priority` int(1) NOT NULL,
  `projectID` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dayplanner_tasks`
--

INSERT INTO `dayplanner_tasks` (`id`, `userID`, `title`, `date`, `completed`, `description`, `priority`, `projectID`, `tags`) VALUES
(1, 1, 'Test Task 2', '2021-04-21 04:00:00', 0, 'Test task description', 1, 1, 'tags'),
(2, 1, 'Test', '2021-04-22 04:00:00', 0, 'Test', 1, 2, 'Tag');

-- --------------------------------------------------------

--
-- Table structure for table `dayplanner_users`
--

CREATE TABLE `dayplanner_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dayplanner_users`
--

INSERT INTO `dayplanner_users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'hrlindse', 'hrlindse@iu.edu', '$2y$10$nHf7rKwE6hN1WmTN880hcuZw/DLTsY2kh/LOM0TqDG7FagyzpG2t2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dayplanner_events`
--
ALTER TABLE `dayplanner_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `projectID` (`projectID`);

--
-- Indexes for table `dayplanner_projects`
--
ALTER TABLE `dayplanner_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `dayplanner_tasks`
--
ALTER TABLE `dayplanner_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `projectID` (`projectID`);

--
-- Indexes for table `dayplanner_users`
--
ALTER TABLE `dayplanner_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dayplanner_events`
--
ALTER TABLE `dayplanner_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dayplanner_projects`
--
ALTER TABLE `dayplanner_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dayplanner_tasks`
--
ALTER TABLE `dayplanner_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dayplanner_users`
--
ALTER TABLE `dayplanner_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dayplanner_events`
--
ALTER TABLE `dayplanner_events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `dayplanner_users` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`projectID`) REFERENCES `dayplanner_projects` (`id`);

--
-- Constraints for table `dayplanner_projects`
--
ALTER TABLE `dayplanner_projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `dayplanner_users` (`id`);

--
-- Constraints for table `dayplanner_tasks`
--
ALTER TABLE `dayplanner_tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `dayplanner_users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`projectID`) REFERENCES `dayplanner_projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
