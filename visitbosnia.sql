-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 10:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visitbosnia`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Country` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cid`, `name`, `Country`) VALUES
(8, 'Sarajevo', 1),
(9, 'Mostar', 1),
(10, 'Zenica', 1),
(11, 'Travnik', 1),
(12, 'Tuzla', 1),
(13, 'Banja Luka', 1),
(14, 'Bihac', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `cid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`cid`, `name`) VALUES
(1, 'Bosnia and Herzegovina');

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `oid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `opening_hours` time NOT NULL,
  `closing_hours` time NOT NULL,
  `pricing` int(11) DEFAULT 0,
  `webpage` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `start_day` varchar(20) DEFAULT 'Monday',
  `close_day` varchar(20) DEFAULT 'Sunday',
  `isVegan` tinyint(1) DEFAULT 0,
  `description` longtext DEFAULT NULL,
  `isGlutenFree` tinyint(1) DEFAULT 0,
  `isPetFriendly` tinyint(1) DEFAULT 0,
  `city` int(11) NOT NULL,
  `isHalal` tinyint(1) DEFAULT 0,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`oid`, `name`, `street`, `phone`, `opening_hours`, `closing_hours`, `pricing`, `webpage`, `email`, `start_day`, `close_day`, `isVegan`, `description`, `isGlutenFree`, `isPetFriendly`, `city`, `isHalal`, `image`) VALUES
(25, 'Klopa', 'Trg Fra Grge Marti?a 4', '033 223-633', '09:00:00', '23:00:00', 3, 'www.klopa.ba', 'klopa@gmail.com', 'monday', 'sunday', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 0, 1, 8, 0, 'klopa.png'),
(26, 'Avlija', 'Avde Sumbula 2', '033/459-243', '09:00:00', '23:00:00', 2, 'www.avlija.ba', 'avlija@gmail.com', 'monday', 'wednesday', 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 0, 1, 8, 0, 'avlija.png'),
(27, '4 sobe gospo?e Safije', ' ?ekaluša 61', '033/459-243', '07:00:00', '23:00:00', 2, 'www.safija.ba', 'safija@gmail.com', 'monday', 'thursday', 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 0, 1, 8, 0, 'safija.png'),
(29, 'Hotel Hollywood', 'Dr. Mustafe Pintola 23', '033 773-100', '00:00:00', '23:59:00', 2, 'www.hotelhollywood.com', 'holywood@gmail.com', 'monday', 'sunday', 0, '123', 0, 0, 8, 0, 'hollywoog.png'),
(30, 'Metropolis', 'Maršala Tita 21', '033 203-315', '07:00:00', '22:00:00', 2, 'www.metropolis.com', 'metropolis@gmail.com', 'monday', 'sunday', 1, 'A place to drink a coffee.', 0, 1, 8, 0, 'metropolis.png'),
(31, 'Chipas', 'Muhameda 16', '062/666-777', '06:00:00', '23:00:00', 1, 'www.chipas.com', 'chipas@gmail.com', 'monday', 'sunday', 0, '123', 0, 0, 9, 0, 'chipas.jpg'),
(32, 'Papermoon', 'Antuna Simica 23', '062/425-123', '09:00:00', '23:00:00', 2, 'www.papermoon.com', 'pm@gmail.com', 'monday', 'sunday', 0, '1234', 1, 0, 8, 1, 'papermoon.png'),
(33, 'Espresso Lab', 'Trg Fra Grge Marti?a 4', '062/425-123', '07:00:00', '21:00:00', 2, 'www.espressol.com', 'espressol@gmail.com', 'monday', 'sunday', 0, 'Nice place to drink coffee.', 0, 0, 8, 0, 'espresso.png');

-- --------------------------------------------------------

--
-- Table structure for table `objecttype`
--

CREATE TABLE `objecttype` (
  `oid` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `object` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objecttype`
--

INSERT INTO `objecttype` (`oid`, `type`, `object`) VALUES
(27, 5, 25),
(28, 1, 26),
(29, 1, 27),
(31, 2, 29),
(32, 1, 30),
(33, 1, 31),
(34, 1, 32),
(35, 6, 33);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `tid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `supertype` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`tid`, `name`, `supertype`, `picture`) VALUES
(1, 'Catering', NULL, 'images/catering'),
(2, 'Accommodation', NULL, 'images/accommodation'),
(3, 'Adventure', NULL, 'images/adventure'),
(4, 'Sights', NULL, 'images/sights'),
(5, 'Restaurants', 1, NULL),
(6, 'Coffee bars', 1, NULL),
(7, 'Desert Shops', 1, NULL),
(8, 'Pubs', 1, NULL),
(9, 'Winery', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `password` varchar(50) NOT NULL,
  `city` int(11) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `surname`, `email`, `phone`, `dob`, `image`, `gender`, `username`, `active`, `password`, `city`, `isadmin`) VALUES
(5, 'Faris', 'Begic', 'fabegic@gmail.com', '062/459-199', '2021-05-05', '', 'male', 'begicfa', b'1', 'faris1', 8, 1),
(6, 'Azra', 'Kurtic', 'azrak@gmail.com', '062/425-123', '2021-05-11', 'azra.png', 'female', 'azrak', b'1', 'azra123', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userfavorites`
--

CREATE TABLE `userfavorites` (
  `fid` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `object` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userfavorites`
--

INSERT INTO `userfavorites` (`fid`, `user`, `object`) VALUES
(6, 5, 26),
(7, 6, 27),
(8, 5, 29),
(9, 5, 30),
(10, 5, 27),
(11, 6, 25),
(12, 5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `userratings`
--

CREATE TABLE `userratings` (
  `uid` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `object` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `city_country_cid_fk` (`Country`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `City` (`city`);

--
-- Indexes for table `objecttype`
--
ALTER TABLE `objecttype`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `Object` (`object`),
  ADD KEY `Type` (`type`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `Supertype` (`supertype`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `user_city_cid_fk` (`city`);

--
-- Indexes for table `userfavorites`
--
ALTER TABLE `userfavorites`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `UserFavorites_object_oid_fk` (`object`),
  ADD KEY `UserFavorites_user_uid_fk` (`user`);

--
-- Indexes for table `userratings`
--
ALTER TABLE `userratings`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `UserRatings_object_oid_fk` (`object`),
  ADD KEY `UserRatings_user_uid_fk` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `objecttype`
--
ALTER TABLE `objecttype`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userfavorites`
--
ALTER TABLE `userfavorites`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userratings`
--
ALTER TABLE `userratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_country_cid_fk` FOREIGN KEY (`Country`) REFERENCES `country` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `object`
--
ALTER TABLE `object`
  ADD CONSTRAINT `City` FOREIGN KEY (`city`) REFERENCES `city` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objecttype`
--
ALTER TABLE `objecttype`
  ADD CONSTRAINT `Object` FOREIGN KEY (`object`) REFERENCES `object` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Type` FOREIGN KEY (`type`) REFERENCES `type` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `Supertype` FOREIGN KEY (`supertype`) REFERENCES `type` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_city_cid_fk` FOREIGN KEY (`city`) REFERENCES `city` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userfavorites`
--
ALTER TABLE `userfavorites`
  ADD CONSTRAINT `UserFavorites_object_oid_fk` FOREIGN KEY (`object`) REFERENCES `object` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserFavorites_user_uid_fk` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userratings`
--
ALTER TABLE `userratings`
  ADD CONSTRAINT `UserRatings_object_oid_fk` FOREIGN KEY (`object`) REFERENCES `object` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserRatings_user_uid_fk` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
