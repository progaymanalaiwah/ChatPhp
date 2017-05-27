-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2017 at 10:09 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatRoom`
--

CREATE TABLE `chatRoom` (
  `roomID` int(11) NOT NULL,
  `nameRoom` varchar(255) DEFAULT NULL,
  `_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `chatRoom`
--

INSERT INTO `chatRoom` (`roomID`, `nameRoom`, `_date`) VALUES
(1, 'ayman', '20170521030749');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msgID` int(11) NOT NULL,
  `msg` longtext,
  `_date` varchar(20) DEFAULT NULL,
  `roomID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgID`, `msg`, `_date`, `roomID`, `userID`) VALUES
(1, 'sa', '20170521030626', 1, 1),
(2, 'sac', '20170521030626', 1, 1),
(3, 'hi', '20170521030655', 1, 2),
(4, 'hello', '20170521030702', 1, 1),
(5, 'mu name id ayman', '20170521030715', 1, 2),
(6, 'sodkas', '20170521030739', 1, 2),
(7, 'dasvsd', '20170521030740', 1, 2),
(8, 'sdvkosdp', '20170521030741', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `_date` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL,
  `roomID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `_date`, `color`, `roomID`) VALUES
(1, 'al', '20170521030625', '#F0D879', 1),
(2, 'nor', '20170521030652', '#FAD6A6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatRoom`
--
ALTER TABLE `chatRoom`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msgID`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `roomID` (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatRoom`
--
ALTER TABLE `chatRoom`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `chatRoom` (`roomID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `chatRoom` (`roomID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
