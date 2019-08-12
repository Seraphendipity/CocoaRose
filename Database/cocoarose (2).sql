-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2019 at 12:21 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocoarose`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `subtitle` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  `scheme` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `colors` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `content` varchar(20000) COLLATE utf8_bin DEFAULT NULL,
  `dateTaken` datetime DEFAULT NULL,
  `datePosted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `filenameOpt` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `filenameHd` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `alt` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `cite` varchar(2048) COLLATE utf8_bin DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `dateTaken` date DEFAULT NULL,
  `datePosted` date DEFAULT NULL,
  `bActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `filenameOpt`, `filenameHd`, `width`, `height`, `alt`, `title`, `cite`, `author`, `dateTaken`, `datePosted`, `bActive`) VALUES
(20, 'jpg', NULL, NULL, NULL, NULL, 'Fox loli with head in hands, smiling.', 'Senko-sanx', 'Unknown', 'Japan', '0000-00-00', '0000-00-00', 1),
(22, 'jpg', NULL, NULL, NULL, NULL, 'Anime girl with red scarf looking up at viewer.', 'Karen-chan', '', 'Japanw', '0000-00-00', '0000-00-00', 1),
(23, 'jpg', NULL, NULL, NULL, NULL, 'A large anime knight with shield and sword.', 'Lord Touch Me 893', 'https://overlordmaruyama.fandom.com/wiki/Overlord_(Anime)', 'Overlord5', '0000-00-00', '0000-00-00', 1),
(25, 'png', NULL, NULL, NULL, NULL, 'Country girl with spider appendages', 'Corti 7454', '', 'Japan', '0000-00-00', '0000-00-00', 1),
(26, 'jpg', NULL, NULL, NULL, NULL, '', '', '', '', '0000-00-00', '0000-00-00', 1),
(27, 'jpg', NULL, NULL, NULL, NULL, '', 'How to edit data', '', '', '0000-00-00', '0000-00-00', 1),
(29, 'JPG', NULL, NULL, NULL, NULL, '', '', '', '', '0000-00-00', '0000-00-00', 1),
(31, 'JPG', NULL, NULL, NULL, NULL, 'Close-Up of white, fluffy dandelions', 'Dandelions20', 'Original Content', 'Elijah', '0000-00-00', '0000-00-00', 1),
(32, 'JPG', NULL, NULL, NULL, NULL, 'A pink rose', 'Flowers', '', '', '0000-00-00', '0000-00-00', 1),
(33, 'JPG', NULL, NULL, NULL, NULL, 'Pink Flowers', 'Flower', '', '', '0000-00-00', '0000-00-00', 0),
(34, 'JPG', NULL, NULL, NULL, NULL, 'Pink Flower', 'Flower ', '', '', '0000-00-00', '0000-00-00', 1),
(35, '', NULL, NULL, NULL, NULL, 'Two full-plate knights charge together into battle', 'Two Knightsffdfhhdf', 'https://www.bigbadtoystore.com/Product/VariationDetails/93049', 'Big Bad Toys', '0000-00-00', '0000-00-00', 0),
(36, '', NULL, NULL, NULL, NULL, 'Two heavily-armoured knights charge into battle', 'Dos Knights', 'https://www.bigbadtoystore.com/Product/VariationDetails/93049', 'Big Bad Toys', '0000-00-00', '0000-00-00', 0),
(37, '', NULL, NULL, NULL, NULL, '', '', '', '', '0000-00-00', '0000-00-00', 0),
(38, 'jpg', NULL, NULL, NULL, NULL, '', '', '', '', '0000-00-00', '0000-00-00', 1),
(39, '', NULL, NULL, NULL, NULL, '', '', '', '', '2019-08-15', '2019-08-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `token` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `userImgId` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `phone` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `messageIds` varchar(128) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
