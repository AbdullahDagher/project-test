-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2020 at 11:00 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messagesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromUser` varchar(255) NOT NULL,
  `toUser` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `readingStatus` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fromUser`, `toUser`, `content`, `readingStatus`, `date`) VALUES
(1, 'tAR+IJl7L9V/', 'tAR+IJl7L9U=', 'uABgaJhof4oijaOmHKE=', 0, '2020-04-19 04:39:46'),
(2, 'tAR+IJl7L9U=', 'tAR+IJl7L9V/', 'tgRqLJop', 0, '2020-04-19 07:22:46'),
(3, 'tAR+IJl7L9U=', 'tAR+IJl7L9V/', '8BZ4LJpoapA1jebjVvMGHad95Gw=', 0, '2020-04-19 07:22:46'),
(4, 'tAR+IJl7L9V/', 'tAR+IJl7L9U=', '8A1xIJRhcIovl/z5', 0, '2020-04-19 04:39:16'),
(5, 'pABqPIl6fZA=', 'tAR+IJl7L9V/', '8AFqLpdoa4gjk/L6Tu0V', 0, '2020-04-19 04:57:51'),
(6, 'pABqPIl6fZA=', 'tAR+IJl7L9V/', '8AN4O5hjfogsjP/1', 0, '2020-04-19 04:57:57'),
(7, 'pABqPIl6fZA=', 'tAR+IJl7L9V/', '8ANxO5hicoohnuelELU=', 0, '2020-04-19 04:58:07'),
(8, 'tAR+IJl7L9V/', 'tAR+IJl7L9U=', '8A18MdxteYUvmuamE6ESHbpitnp2XXDbKHKdEQ==', 0, '2020-04-19 05:48:57'),
(9, 'tAR+IJl7L9U=', 'tAR+IJl7L9U=', '8A18MdxteYUvmuamE7lUCadg+z5zW3/WPzedHnLi', 0, '2020-04-19 05:49:54'),
(10, 'tAR+IJl7L9U=', 'tAR+IJl7L9V/', '8A18MdxteYUvmuamE7lUCadg+z5zW3/WPzedHg==', 0, '2020-04-19 07:22:46'),
(11, 'tAR+IJl7L9V/', 'tAR+IJl7L9U=', '8EU=', 0, '2020-04-19 07:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `text`) VALUES
(1, 'What is your favourite food?'),
(2, 'What is your homeland name?'),
(3, 'What is your uncle name?'),
(4, 'What is your bet name?');

-- --------------------------------------------------------

--
-- Table structure for table `questionanswer`
--

CREATE TABLE `questionanswer` (
  `username` varchar(255) NOT NULL,
  `questionID` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionanswer`
--

INSERT INTO `questionanswer` (`username`, `questionID`, `answer`) VALUES
('tAR+IJl7L9V/', 1, 'tQJ+'),
('tAR+IJl7L9U=', 2, 'uAp0LZBodoY='),
('pABqPIl6fZA=', 2, 'uAp0LZBodoY='),
('pABqPIl6fZB1', 3, 'uABg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `securityQID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `securityQID`) VALUES
('pABqPIl6fZA=', '$2y$10$G3yzvHcue3hAFLOjdWkDuusjUks7z487HT04mOdHv2yxQJeledLGG', 0),
('pABqPIl6fZB1', '$2y$10$8jsSpW1OGlRIIQdGeJ6VpOQpvLeqCN/Z5mMT1MOi5MMzGnV7i0BTK', 0),
('tAR+IJl7L9U=', '$2y$10$BcNZWuNdd3w.QtyC2pwz9uWt3/.0LnWQJiUEXOku7a7Zqrq4i4yva', 0),
('tAR+IJl7L9V/', '$2y$10$i3KDz0g5o2iyu0dO4AR.m.LUP898.bdXNCf6snb4J.bc17yn3k/am', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
