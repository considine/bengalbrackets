-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2016 at 04:00 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Picks`
--

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `fightID` int(4) NOT NULL,
  `netID` varchar(15) NOT NULL,
  `winner1` varchar(30) NOT NULL,
  `winner2` varchar(30) NOT NULL,
  `winner3` varchar(30) NOT NULL,
  `winner4` varchar(30) NOT NULL,
  `winner5` varchar(30) NOT NULL,
  `winner6` varchar(30) NOT NULL,
  `winner7` varchar(30) NOT NULL,
  `winner8` varchar(30) NOT NULL,
  `winner9` varchar(30) NOT NULL,
  `winner10` varchar(30) NOT NULL,
  `winner11` varchar(30) NOT NULL,
  `winner12` varchar(30) NOT NULL,
  `winner13` varchar(30) NOT NULL,
  `winner14` varchar(30) NOT NULL,
  `winner15` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`fightID`, `netID`, `winner1`, `winner2`, `winner3`, `winner4`, `winner5`, `winner6`, `winner7`, `winner8`, `winner9`, `winner10`, `winner11`, `winner12`, `winner13`, `winner14`, `winner15`) VALUES
(4, 'netID', 'Eoghan Flanagan', 'Rudy Bernard', 'Matt Boomer', 'Alex Cervantez', 'Kevin Frost', 'Nathan O''Halloran, SJ', 'Zack Flint', 'Dean Swan', ' Rudy Bernard', ' Matt Boomer', ' Nathan O''Halloran, SJ', ' Zack Flint', ' Matt Boomer', ' Nathan O''Halloran, SJ', ' Matt Boomer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`fightID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `fightID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;