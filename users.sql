-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 02:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidders`
--

CREATE TABLE `bidders` (
  `USERNAME` varchar(10) NOT NULL,
  `ITEM` varchar(30) NOT NULL,
  `BID_AMOUNT` int(11) NOT NULL,
  `OWNERS` varchar(10) NOT NULL,
  `CURR_TIME` time NOT NULL,
  `CURR_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidders`
--

INSERT INTO `bidders` (`USERNAME`, `ITEM`, `BID_AMOUNT`, `OWNERS`, `CURR_TIME`, `CURR_DATE`) VALUES
('Tanya', 'The thinker', 355000, 'Rahul', '05:45:46', '2020-10-21'),
('Tanya', 'Antique door bell', 8500, 'Tanya', '01:29:08', '2020-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `USERNAME` varchar(10) NOT NULL,
  `CLOSING_DATE` date NOT NULL,
  `BID_AMOUNT` int(11) NOT NULL,
  `ITEM` varchar(30) NOT NULL,
  `DESCRIPTIONS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`USERNAME`, `CLOSING_DATE`, `BID_AMOUNT`, `ITEM`, `DESCRIPTIONS`) VALUES
('Obama', '2020-10-10', 30000, 'Roosevelt pen', 'Retro 1951\'s Tornado Vintage Metalsmith Roosevelt rollerball pen is detailed in a handsome herringbone body.'),
('Rahul', '2020-10-24', 345000, 'The thinker', 'The Thinker (French: Le Penseur) is a bronze sculpture by Auguste Rodin, usually placed on a stone pedestal. '),
('Tanya', '2020-12-31', 5600, 'Antique door bell', 'A dash of Victorian vibes always come handy for revamping garden & balcony décor, case in point our Antique Metal Door Bell. The vintage look of the piece makes it an apt choice for placing it at your home entrance or adding a quirky touch to office spaces.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD_HASH` char(40) NOT NULL,
  `PHONE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERNAME`, `PASSWORD_HASH`, `PHONE`) VALUES
('John', '5f4dcc3b5aa765d61d8327deb882cf99', '9384753829'),
('Obama', '7c994c3fb728874ff5bb1b9a731f3966', '9872635188'),
('Rahul', '5f4dcc3b5aa765d61d8327deb882cf99', '9981723645'),
('Rambo', '5f4dcc3b5aa765d61d8327deb882cf99', '8877665544'),
('Tanya', '3196a99388341abe228a4dd6a2433ef3', '8861312433');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
