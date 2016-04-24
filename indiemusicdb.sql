-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 05:46 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indiemusicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_name`, `password`, `real_name`, `country`, `birth_date`, `email`) VALUES
(12, 'admin', '111', 'administrator', 'unknown', 'unknown', 'admin@music.com'),
(33, 'joe', '12', 'john', 'Canada', '09/09/2000', 'joe@gg.com'),
(34, 'ren-chon', '111', 'Renge', 'Japan', '10/05/2111', 'renchon@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`acc_id`, `acc_name`, `password`, `real_name`, `country`, `birth_date`, `email`) VALUES
(12, 'admin', '111', 'administrator', 'unknown', 'unknown', 'admin@music.com');

-- --------------------------------------------------------

--
-- Table structure for table `createplaylist`
--

CREATE TABLE `createplaylist` (
  `song_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `createplaylist`
--

INSERT INTO `createplaylist` (`song_id`, `playlist_id`) VALUES
(39, 1),
(39, 5),
(40, 1),
(40, 5),
(41, 3),
(41, 5);

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `song_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mood`
--

CREATE TABLE `mood` (
  `song_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

CREATE TABLE `own` (
  `playlist_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `playlist_name` varchar(255) NOT NULL,
  `playlist_descrip` varchar(255) DEFAULT NULL,
  `sort_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `acc_id`, `playlist_name`, `playlist_descrip`, `sort_by`) VALUES
(1, 34, 'asdasd', 'asdasd', 'asdasd'),
(3, 34, 'test 2', '222', '3433'),
(5, 12, 'gggf', 'dfgdg', 'dfgdfgdgf'),
(6, 12, '', '', ''),
(7, 12, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `song_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rate_out_of_five`
--

CREATE TABLE `rate_out_of_five` (
  `acc_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `1star` int(11) NOT NULL,
  `2star` int(11) NOT NULL,
  `3star` int(11) NOT NULL,
  `4star` int(11) NOT NULL,
  `5star` int(11) NOT NULL,
  `totalRating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate_out_of_five`
--

INSERT INTO `rate_out_of_five` (`acc_id`, `song_id`, `1star`, `2star`, `3star`, `4star`, `5star`, `totalRating`) VALUES
(12, 40, 0, 0, 1, 0, 10, 11),
(33, 44, 0, 0, 0, 0, 0, 0),
(33, 45, 0, 0, 0, 0, 0, 0),
(34, 39, 0, 0, 1, 2, 6, 9),
(34, 41, 0, 0, 0, 0, 0, 0),
(34, 42, 0, 0, 0, 0, 0, 0),
(34, 43, 0, 0, 0, 0, 0, 0),
(34, 46, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `song_name` varchar(255) NOT NULL,
  `song_descrip` varchar(255) DEFAULT NULL,
  `file_format` varchar(255) NOT NULL,
  `genre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `song_name`, `song_descrip`, `file_format`, `genre`) VALUES
(39, 'chocho', '123', 'STE-007.wav', 'background music'),
(40, 'Ocean waves', 'water at the ocean', 'STE-002.wav', 'background music'),
(41, 'first recorder', 'best recorder player ever', 'STE-008.wav', 'random'),
(42, 'chocho', 'my first song with a recorder', 'STE-008.wav', 'random'),
(43, 'something', 'best recorder player ever', 'STE-004.wav', 'background music'),
(44, '123', '123', 'STE-008.wav', '123'),
(45, 'recorder song', 'song about love', 'STE-000.wav', 'random'),
(46, 'Ocean waves', 'water at the ocean', 'STE-010.wav', 'background music');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `song_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`song_id`, `acc_id`) VALUES
(40, 12),
(44, 33),
(45, 33),
(39, 34),
(41, 34),
(42, 34),
(43, 34),
(46, 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `acc_descrip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `createplaylist`
--
ALTER TABLE `createplaylist`
  ADD PRIMARY KEY (`song_id`,`playlist_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `mood`
--
ALTER TABLE `mood`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `own`
--
ALTER TABLE `own`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`song_id`,`acc_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `rate_out_of_five`
--
ALTER TABLE `rate_out_of_five`
  ADD PRIMARY KEY (`acc_id`,`song_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `createplaylist`
--
ALTER TABLE `createplaylist`
  ADD CONSTRAINT `createplaylist_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`),
  ADD CONSTRAINT `createplaylist_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Constraints for table `download`
--
ALTER TABLE `download`
  ADD CONSTRAINT `download_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`),
  ADD CONSTRAINT `download_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `mood`
--
ALTER TABLE `mood`
  ADD CONSTRAINT `mood_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`);

--
-- Constraints for table `own`
--
ALTER TABLE `own`
  ADD CONSTRAINT `own_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`),
  ADD CONSTRAINT `own_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`),
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `rate_out_of_five`
--
ALTER TABLE `rate_out_of_five`
  ADD CONSTRAINT `rate_out_of_five_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`),
  ADD CONSTRAINT `rate_out_of_five_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`);

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`),
  ADD CONSTRAINT `upload_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
