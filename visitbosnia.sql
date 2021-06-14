-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 04:23 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ClearAllUserData` ()  BEGIN
    DELETE FROM userratings where 1;
    DELETE FROM userfavorites where 1;
    DELETE FROM user where 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_ratings` (`p_oid` INT)  BEGIN
    UPDATE object SET averagerating = (SELECT AVG(rating) FROM userratings WHERE oid = p_oid) WHERE oid = p_oid;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetObjectName` (`p_id` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 BEGIN
    declare ret varchar(255);
    select name into ret FROM object where oid = p_id;
    return ret;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetUserName` (`p_id` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 BEGIN
    declare ret varchar(255);
    select concat(name, ' ', surname) into ret FROM user where uid = p_id;
    return ret;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_users`
-- (See below for the actual view)
--
CREATE TABLE `active_users` (
`uid` int(11)
,`name` varchar(100)
,`surname` varchar(100)
,`username` varchar(30)
,`email` varchar(255)
,`startdate` date
);

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
(24, 'Visoko', 1),
(27, 'Sarajevo', 1),
(28, 'Zenica', 1),
(29, 'Mostar', 1),
(30, 'Tuzla', 1),
(31, 'Travnik', 1),
(32, 'Jajce', 1);

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
-- Stand-in structure for view `fav_objects`
-- (See below for the actual view)
--
CREATE TABLE `fav_objects` (
`objectid` int(11)
,`object` varchar(255)
,`favnum` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `most_active_users`
-- (See below for the actual view)
--
CREATE TABLE `most_active_users` (
`user` int(11)
,`GetUserName(user)` varchar(255)
,`favno` bigint(21)
);

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
  `image` varchar(255) NOT NULL,
  `averagerating` decimal(10,0) DEFAULT 0,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`oid`, `name`, `street`, `phone`, `opening_hours`, `closing_hours`, `pricing`, `webpage`, `email`, `start_day`, `close_day`, `isVegan`, `description`, `isGlutenFree`, `isPetFriendly`, `city`, `isHalal`, `image`, `averagerating`, `active`) VALUES
(41, 'Chipas', 'Kolodvorska 1', '062/459-199', '07:00:00', '12:00:00', 1, 'www.chipas.com', 'chipas@gmail.com', 'monday', 'sunday', 1, '123', 0, 1, 24, 0, 'chipas.jpg', '3', b'0'),
(43, 'Flying', 'Kolodvorska 3', '062/459-199', '07:00:00', '23:00:00', 1, 'www.flying.com', 'flying@gmail.com', 'monday', 'sunday', 0, '123', 0, 0, 24, 0, '2.jpg', NULL, b'0'),
(45, 'Metropolis SCC', 'MarÅ¡ala Tita 21', '033 203-315', '07:00:00', '23:00:00', 2, 'www.metropolis.com', 'metropolis@gmail.com', 'monday', 'sunday', 1, 'Nice place to eat.', 1, 1, 27, 1, 'metropolis.png', '0', b'1');

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
(42, 1, 41),
(44, 3, 43),
(46, 1, 45);

-- --------------------------------------------------------

--
-- Stand-in structure for view `top_10_places`
-- (See below for the actual view)
--
CREATE TABLE `top_10_places` (
`oid` int(11)
,`name` varchar(255)
,`street` varchar(255)
,`start_day` varchar(20)
,`close_day` varchar(20)
,`opening_hours` time
,`closing_hours` time
,`phone` varchar(20)
,`webpage` varchar(255)
,`image` varchar(255)
,`active` bit(1)
);

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
  `admin` bit(1) NOT NULL DEFAULT b'0',
  `startdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `surname`, `email`, `phone`, `dob`, `image`, `gender`, `username`, `active`, `password`, `city`, `admin`, `startdate`) VALUES
(26, 'Azra', 'Kurtic', 'azrak@gmail.com', '062/459-199', '2021-06-01', 'fsd.png', 'male', 'azrak', b'1', 'azra123', 24, b'1', '2021-06-08'),
(28, 'Adna', 'Salkovic', 'adnasalk@gmail.com', '062/459-199', '2021-06-02', '', 'female', 'adnasalk', b'1', 'adna123', 24, b'0', '2021-06-10'),
(29, 'Mujo', 'Hamzic', 'mujo@gmail.com', '062/459-199', '2021-06-03', '', 'male', 'mujohamz', b'1', 'mujo123', 24, b'0', '2021-06-10');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `date_check` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
    DECLARE msg varchar(255);
    IF NEW.dob > CURDATE()  THEN
        SET msg = 'INVALID DATE, Date from future';
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_start_date_trg` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
    set NEW.startdate = SYSDATE();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `userfavorites`
--

CREATE TABLE `userfavorites` (
  `fid` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `object` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userfavorites`
--

INSERT INTO `userfavorites` (`fid`, `user`, `object`, `date`) VALUES
(26, 26, 41, '2021-06-08');

--
-- Triggers `userfavorites`
--
DELIMITER $$
CREATE TRIGGER `user_fav_date_trg` BEFORE INSERT ON `userfavorites` FOR EACH ROW BEGIN
    set NEW.date = SYSDATE();
END
$$
DELIMITER ;

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
-- Dumping data for table `userratings`
--

INSERT INTO `userratings` (`uid`, `user`, `object`, `rating`) VALUES
(43, 26, 41, 5);

--
-- Triggers `userratings`
--
DELIMITER $$
CREATE TRIGGER `user_rating_ins_trg` AFTER INSERT ON `userratings` FOR EACH ROW BEGIN
    UPDATE object SET averagerating = (SELECT AVG(rating) FROM userratings WHERE oid = object);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_rating_upd_trg` AFTER UPDATE ON `userratings` FOR EACH ROW BEGIN
    UPDATE object SET averagerating = (SELECT AVG(rating) FROM userratings WHERE oid = object);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `active_users`
--
DROP TABLE IF EXISTS `active_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_users`  AS SELECT `user`.`uid` AS `uid`, `user`.`name` AS `name`, `user`.`surname` AS `surname`, `user`.`username` AS `username`, `user`.`email` AS `email`, `user`.`startdate` AS `startdate` FROM `user` WHERE `user`.`active` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `fav_objects`
--
DROP TABLE IF EXISTS `fav_objects`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fav_objects`  AS SELECT `uf`.`object` AS `objectid`, `o`.`name` AS `object`, count(`uf`.`object`) AS `favnum` FROM ((`object` `o` join `user` `u`) join `userfavorites` `uf`) WHERE `o`.`oid` = `uf`.`object` AND `u`.`uid` = `uf`.`user` AND (NULL is null OR cast(`u`.`startdate` as date) >= NULL) AND (NULL is null OR cast(`u`.`startdate` as date) <= NULL) AND `o`.`active` = 1 GROUP BY `uf`.`object` ;

-- --------------------------------------------------------

--
-- Structure for view `most_active_users`
--
DROP TABLE IF EXISTS `most_active_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `most_active_users`  AS SELECT `userratings`.`user` AS `user`, `GetUserName`(`userratings`.`user`) AS `GetUserName(user)`, count(0) AS `favno` FROM (`userratings` join `user`) WHERE `user`.`uid` = `userratings`.`user` AND `user`.`active` = 1 GROUP BY `GetUserName`(`userratings`.`user`) ORDER BY 2 DESC ;

-- --------------------------------------------------------

--
-- Structure for view `top_10_places`
--
DROP TABLE IF EXISTS `top_10_places`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top_10_places`  AS SELECT `o`.`oid` AS `oid`, `o`.`name` AS `name`, `o`.`street` AS `street`, `o`.`start_day` AS `start_day`, `o`.`close_day` AS `close_day`, `o`.`opening_hours` AS `opening_hours`, `o`.`closing_hours` AS `closing_hours`, `o`.`phone` AS `phone`, `o`.`webpage` AS `webpage`, `o`.`image` AS `image`, `o`.`active` AS `active` FROM (`object` `o` join `city` `c`) WHERE `o`.`city` = `c`.`cid` AND `o`.`active` = 1 ORDER BY `o`.`averagerating` DESC LIMIT 0, 6 ;

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
  ADD KEY `City` (`city`),
  ADD KEY `obj_name_ind` (`name`),
  ADD KEY `obj_pricing_ind` (`pricing`);

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
  ADD KEY `user_city_cid_fk` (`city`),
  ADD KEY `user_name_ind` (`name`),
  ADD KEY `user_surname_ind` (`surname`);

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
  ADD UNIQUE KEY `unq_rating` (`user`,`object`),
  ADD KEY `UserRatings_object_oid_fk` (`object`),
  ADD KEY `UserRatings_user_uid_fk` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `objecttype`
--
ALTER TABLE `objecttype`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `userfavorites`
--
ALTER TABLE `userfavorites`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `userratings`
--
ALTER TABLE `userratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_country_cid_fk` FOREIGN KEY (`Country`) REFERENCES `country` (`cid`);

--
-- Constraints for table `object`
--
ALTER TABLE `object`
  ADD CONSTRAINT `City` FOREIGN KEY (`city`) REFERENCES `city` (`cid`);

--
-- Constraints for table `objecttype`
--
ALTER TABLE `objecttype`
  ADD CONSTRAINT `Object` FOREIGN KEY (`object`) REFERENCES `object` (`oid`),
  ADD CONSTRAINT `Type` FOREIGN KEY (`type`) REFERENCES `type` (`tid`);

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `Supertype` FOREIGN KEY (`supertype`) REFERENCES `type` (`tid`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_city_cid_fk` FOREIGN KEY (`city`) REFERENCES `city` (`cid`);

--
-- Constraints for table `userfavorites`
--
ALTER TABLE `userfavorites`
  ADD CONSTRAINT `UserFavorites_object_oid_fk` FOREIGN KEY (`object`) REFERENCES `object` (`oid`),
  ADD CONSTRAINT `UserFavorites_user_uid_fk` FOREIGN KEY (`user`) REFERENCES `user` (`uid`);

--
-- Constraints for table `userratings`
--
ALTER TABLE `userratings`
  ADD CONSTRAINT `UserRatings_object_oid_fk` FOREIGN KEY (`object`) REFERENCES `object` (`oid`),
  ADD CONSTRAINT `UserRatings_user_uid_fk` FOREIGN KEY (`user`) REFERENCES `user` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
