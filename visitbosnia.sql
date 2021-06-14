-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 09:55 AM
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
  `averagerating` double DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`oid`, `name`, `street`, `phone`, `opening_hours`, `closing_hours`, `pricing`, `webpage`, `email`, `start_day`, `close_day`, `isVegan`, `description`, `isGlutenFree`, `isPetFriendly`, `city`, `isHalal`, `image`, `averagerating`, `active`) VALUES
(41, 'Chipas', 'Kolodvorska 1', '062/459-199', '07:00:00', '17:00:00', 1, 'www.chipas.com', 'chipas@gmail.com', 'monday', 'sunday', 1, 'A nice and cheap place to eat', 0, 1, 24, 0, 'chipas.jpg', 2, b'1'),
(45, 'Metropolis SCCCCCC', 'MarÅ¡ala Tita 21', '033 203-315', '07:00:00', '23:00:00', 2, 'www.metropolis.com', 'metropolis@gmail.com', 'monday', 'sunday', 1, 'Nice place to eat.', 1, 1, 27, 1, 'metropolis.png', NULL, b'0'),
(46, '4 sobe gospoÄ‘e Safije', 'ÄŒekaluÅ¡a 61', '062/459-199', '07:00:00', '23:00:00', 3, 'www.4sgs.com', '4sgs@gmail.com', 'monday', 'sunday', 0, 'Lorem Ipsum is simply dummy.', 1, 1, 27, 1, 'safija.png', NULL, b'1'),
(57, 'TrebeviÄ‡ka Å¾iÄara', 'Hrvatin bb', '062/459-199', '19:00:00', '09:00:00', 1, 'www.zicara.ba', 'zicara@gmail.com', 'monday', 'saturday', 0, 'fhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghdukfhsfgiugdhgukdhkguhdukghdukghduk', 0, 0, 27, 0, 'zicara.jpg', NULL, b'1'),
(58, 'Rafting na Miljacki', 'Konjicka bb', '062/459-199', '19:00:00', '10:00:00', 2, 'www.raftingnaneretvi.com', 'rafting@gmail.com', 'monday', 'sunday', 0, 'hferiuuhfreuifhreuifherhfiupiupiupuierhphphpiueiufhehphpiehpiuiueiupuieiuerhfuiepfpierhpfieueprhperihepfiuheruifpehperhpiffihhererhfhrfpuiehifieupfepihfp', 0, 0, 27, 0, 'rafting.jpg', NULL, b'1'),
(59, 'Sunnyland', 'Antuna Hangija 23', '062/459-199', '07:00:00', '18:00:00', 2, 'www.sunnyland.com', 'sunnyland@gmail.com', 'monday', 'sunday', 0, 'Sunnyland is a beautiful............................................jklgyskjaehakveshklvjeskjflkeshbhkeshjfkjeshkjfbhesbfkesbkjghsjlfkjesjheslhgjeahjkhakjfjkgdsghsdjskghkshgsrghsrsoggokpsdjgpsjpsro', 0, 0, 27, 0, 'sunnyland.jpg', NULL, b'1'),
(60, 'VijeÄ‡nica', 'Obala Kulina Bana', '063/353-755', '08:00:00', '17:00:00', 2, 'www.vijecnica.ba', 'vjsa@gmail.com', 'monday', 'friday', 0, 'Vijecnica, a heart of Sarajevo, rebuilt. Ahdgjabjwkjgjsjkjgjseklgkleklghaeglahgjagoaghoihgoihhaojaogjihoaghoihoesitgjeuigjioujpogjiohesigejojiofhjshfuihaeoifuiotesrjopjarpjzspihrsprijrgijs', 0, 0, 27, 0, 'vijecnica.jpg', NULL, b'1'),
(61, 'Zemaljski muzej', 'Zmaja od Bosne', '061/425-414', '09:00:00', '16:00:00', 1, 'www.zemuzej.com', 'zmuzej@gmail.com', 'monday', 'saturday', 0, 'Zemaljski muzej as one of the oldest museums in Bosnia and Herzegovina. jhgdosjlgjajkjfeeskhrkjfklsrngjneskjjfasfesrhfnhehajfekheskjfeskhghehfbbjsegvfjesghtkjgbjgeshjgesh', 0, 0, 27, 0, 'zemuzej.jpg', NULL, b'1'),
(62, 'Sebilj', 'Bascarsija', '065/942-412', '00:00:00', '00:00:00', 1, 'www.sebilj.ba', 'sebilj@hotmail.com', 'monday', 'sunday', 0, 'Sebilj, sight placed in the heart of Bascarsija.hgeighkjleshngioeshoifhesjkhghksheghkhdjkrgkshkgsrjkhkghskjhjsfkeagjkfhajkgegfhahkjfkjajgakgjahkghaghjakgahgka', 0, 0, 27, 0, 'seb.jpg', NULL, b'1'),
(63, 'Sarajevo tunel', 'ÄŒekaluÅ¡a 61', '062/847-433', '08:00:00', '16:00:00', 1, 'www.tunel.com', 'tunel@gmail.com', 'monday', 'friday', 0, 'Tunnel..ijsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjrsdodjgugrjgjr', 0, 0, 27, 0, 'tunel.jpg', NULL, b'1'),
(64, 'Gazi-Husrev Begova dÅ¾amija', 'Hrvatin bb', '061/466-435', '00:00:00', '00:00:00', 1, 'www.ghbdzamija.ba', 'ghb@gmail.com', 'monday', 'sunday', 0, 'ejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjdejtlrjgorjd', 0, 0, 27, 0, 'begdz.jpg', NULL, b'1'),
(65, 'Hotel Hills', 'ÄŒekaluÅ¡a 61', '062/345-456', '00:00:00', '00:00:00', 3, 'www.hotelhills.com', 'hotelhills@gmail.com', 'monday', 'sunday', 0, 'lrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessiljlrjdijjessilj', 0, 0, 27, 0, 'hotelhills.jpg', 5, b'1'),
(66, 'Hotel Europe', 'Kolodvorska 1', '063/345-457', '00:00:00', '00:00:00', 3, 'www.hoteleurope.com', 'hoteleurope@gmail.com', 'monday', 'sunday', 0, 'kdfigdgiljdxrlgjljdlgjsodgdj', 0, 0, 27, 0, 'hoteleurope.jpg', NULL, b'1'),
(67, 'Hotel Marriot', 'Kolodvorska 1', '063/345-452', '00:00:00', '00:00:00', 3, 'www.marriot.com', 'marriot@gmail.com', 'monday', 'sunday', 0, 'dkjshfehstogiruodiuzesotpogesjojdupusgpjseopjgp', 0, 0, 27, 0, 'marriot.jpg', NULL, b'1'),
(68, 'Swissotel', 'Hrvatin bb', '063/353-752', '00:00:00', '00:00:00', 3, 'www.swissotel.com', 'swissotel@gmail.com', 'monday', 'sunday', 0, 'ldsjgltsjsjdkfkjesbkjfefhkwehtkrhieiowr', 0, 0, 27, 0, 'swissotel.jpg', NULL, b'1'),
(69, 'Hotel Hollywood', 'Kolodvorska 1', '063/353-753', '00:00:00', '00:00:00', 2, 'www.hollywood.com', 'hollywood@gmail.com', 'monday', 'sunday', 0, 'rkgmkleruuhdgrdgkherkihgio', 0, 0, 27, 0, 'hollywood.jpg', NULL, b'1'),
(70, 'Holiday Inn', 'Kolodvorska 1', '063/345-452', '00:00:00', '00:00:00', 3, 'www.holidayinn.com', 'holidayinn@gmail.com', 'monday', 'sunday', 0, 'fkdlerjoej4zojerzlreklter', 0, 0, 27, 0, 'holidayinn.jpg', NULL, b'1'),
(71, 'Regina', 'Kolodvorska 1', '063/345-444', '07:00:00', '23:00:00', 2, 'www.regina.ba', 'regina@gmail.com', 'monday', 'sunday', 0, 'lkdgjlrjtlgjesljgdjgjsdgijidjgdpsoegptse', 0, 1, 27, 0, 'regina.jpg', NULL, b'1'),
(72, 'Superfood', 'Kolodvorska 1', '062/459-122', '08:00:00', '23:00:00', 3, 'www.superfood.ba', 'superfood@gmail.com', 'monday', 'sunday', 0, 'kjjhkhkgukhukhkhhhiuuzglojl', 0, 1, 27, 1, 'superfood.jpg', 4, b'1'),
(73, 'Rafting na Å½eljeznici', 'Kolodvorska 1', '063/345-422', '08:00:00', '17:00:00', 2, 'www.raftingnauni.com', 'raftingnauni@gmail.com', 'monday', 'sunday', 0, 'lksjgdlijdlitgjtlkjdglsjdigljerlkojsdgldjgl', 0, 0, 27, 0, 'raftinguna.jpg', NULL, b'1'),
(74, 'Quad BjelaÅ¡nica', 'Bjela bb', '063/345-122', '06:00:00', '16:00:00', 3, 'www.quadbj.com', 'quadbjel@gmail.com', 'friday', 'sunday', 0, 'lksjgdlijdlitgjtlkjdglsjdigljerlkojsdgldjglkgjdsljgejgiejskjglkewkkgjewlhflewhsklhwekljhjewhwfkjewjelgsjkdghjesgfjefegkfgaekfhaegkgae', 0, 0, 27, 0, 'quad.jpg', NULL, b'1'),
(75, 'Fortica Zipline', 'Fortica bb', '061/315-312', '08:00:00', '20:00:00', 3, 'www.fortica.ba', 'fortica@gmail.com', 'thursday', 'sunday', 0, 'iughieoifpoejshhkfhiehsofpoejahgbkjlrjhejlhfiopsegbslfiehjfplijeshjlifhesjfkjeilguflewjfhhgrjsghkfewghiofhesoige', 0, 0, 27, 0, 'fortica.jpg', NULL, b'1'),
(76, 'Intermezzo IlidÅ¾a', 'Mala Aleja bb', '061/158-738', '08:00:00', '23:00:00', 1, 'www.intermezzoJe.com', 'intermezzoforver@hotmail.com', 'monday', 'sunday', 0, 'Intermezzo Ilidza, with you since 1999.........rjisehfeuisgjsehifuherawuihgfghegfuegifgaeigfiuafgiawjk', 0, 0, 27, 0, 'int.jfif', NULL, b'1'),
(77, 'Fabrika', 'Ferhadija bb', '061/213-414', '08:00:00', '00:00:00', 2, 'www.fabrikasa.com', 'fabrikasa@hotmail.com', 'monday', 'sunday', 0, 'Fabrika, placed in one of main streets...hgaihfjpawkjhfjaehaiohesjiohjiajgenjsekjbesjfkjjkjfkhkejjfjkesjghsekjgesjkjgoesjijgspjespjko', 0, 0, 27, 0, 'fabrika.jpg', NULL, b'1'),
(78, 'Taverna', 'Kolodvorska 10', '062/418-656', '10:00:00', '23:00:00', 2, 'www.taverna.com', 'tavsa@gmail.com', 'monday', 'saturday', 0, 'fhesfiufhesuhfishzeirhiueszriuehsuirgaueiriuzaeuruuieaoriueaitoheaopihtpoitehtpiaehpirhaeiptijaeouiruioeautioeuaiotuoaehothaeiehioraehtipaehiothaeghtoihaeutheauohtuoaehitoghitaeutioaetihotgo', 0, 0, 27, 0, 'tav.jfif', NULL, b'1');

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
(42, 5, 41),
(46, 5, 45),
(48, 5, 46),
(60, 3, 57),
(62, 3, 58),
(63, 3, 59),
(64, 4, 59),
(65, 5, 59),
(66, 6, 59),
(67, 4, 60),
(68, 4, 61),
(69, 4, 62),
(70, 4, 63),
(71, 4, 64),
(72, 2, 65),
(75, 2, 66),
(76, 2, 67),
(77, 2, 68),
(78, 2, 69),
(79, 2, 70),
(81, 5, 71),
(83, 5, 72),
(84, 3, 73),
(85, 3, 74),
(86, 3, 75),
(87, 7, 76),
(88, 8, 77),
(89, 9, 78);

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
(32, 'Azra', 'Kurtic', 'azrakurtic@gmail.com', '062561849', '2021-05-31', 'Adriana-Lima.jpg', 'female', 'azrak', b'1', '2450a8e9a4eeebbd95e18852119ea635f71c1c1f', 27, b'1', '2021-06-11'),
(33, 'Adna', 'Salkovic', 'adnas@gmail.com', '062561849', '2021-06-01', '', 'female', 'adnas', b'1', 'da52bd1f555a79073d28149a774ecc39f35f7d55', 27, b'0', '2021-06-11'),
(34, 'Faris', 'Begic', 'fabegic@gmail.com', '062/459-199', '2021-06-01', '', 'male', 'begicfa', b'1', '356a192b7913b04c54574d18c28d46e6395428ab', 24, b'0', '2021-06-13'),
(35, 'Chipas', 'Begic', 'azrak@gmail.com', '062/459-199', '2021-06-09', '', 'male', 'mujohamz', b'1', '6eb140bafa7b836fe8c2399211be75ad61bea5c5', 24, b'0', '2021-06-13');

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
(37, 32, 41, '2021-06-14');

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
  `rating` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userratings`
--

INSERT INTO `userratings` (`uid`, `user`, `object`, `rating`) VALUES
(51, 32, 65, 5),
(52, 32, 72, 4),
(53, 32, 41, 2);

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
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `objecttype`
--
ALTER TABLE `objecttype`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `userfavorites`
--
ALTER TABLE `userfavorites`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `userratings`
--
ALTER TABLE `userratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
