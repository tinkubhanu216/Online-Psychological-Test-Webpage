-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2019 at 04:30 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminid`, `password`, `usertype`) VALUES
('R1234', 'admin', 'admin'),
('RST1234', 'admin', 'counsellor');

-- --------------------------------------------------------

--
-- Table structure for table `DASS21category`
--

CREATE TABLE `DASS21category` (
  `testid` varchar(255) NOT NULL,
  `C1` varchar(255) NOT NULL,
  `C2` varchar(255) NOT NULL,
  `C3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DASS21category`
--

INSERT INTO `DASS21category` (`testid`, `C1`, `C2`, `C3`) VALUES
('DASS21', 'depression', 'anxiety', 'stress');

-- --------------------------------------------------------

--
-- Table structure for table `DASS21cutoff`
--

CREATE TABLE `DASS21cutoff` (
  `testid` varchar(255) NOT NULL,
  `scale` varchar(255) NOT NULL,
  `depressionmin` int(11) NOT NULL,
  `depressionmax` int(11) NOT NULL,
  `anxietymin` int(11) NOT NULL,
  `anxietymax` int(11) NOT NULL,
  `stressmin` int(11) NOT NULL,
  `stressmax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DASS21cutoff`
--

INSERT INTO `DASS21cutoff` (`testid`, `scale`, `depressionmin`, `depressionmax`, `anxietymin`, `anxietymax`, `stressmin`, `stressmax`) VALUES
('DASS21', 'extremely severe', 28, 100, 20, 100, 34, 100),
('DASS21', 'mild', 10, 13, 8, 9, 15, 18),
('DASS21', 'moderate', 14, 20, 10, 14, 19, 25),
('DASS21', 'normal', 0, 9, 0, 7, 0, 14),
('DASS21', 'severe', 21, 27, 15, 19, 26, 33);

-- --------------------------------------------------------

--
-- Table structure for table `DASS21options`
--

CREATE TABLE `DASS21options` (
  `testid` varchar(255) NOT NULL,
  `OP1` varchar(255) NOT NULL,
  `OPVAL1` int(11) NOT NULL,
  `OP2` varchar(255) NOT NULL,
  `OPVAL2` int(11) NOT NULL,
  `OP3` varchar(255) NOT NULL,
  `OPVAL3` int(11) NOT NULL,
  `OP4` varchar(255) NOT NULL,
  `OPVAL4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DASS21options`
--

INSERT INTO `DASS21options` (`testid`, `OP1`, `OPVAL1`, `OP2`, `OPVAL2`, `OP3`, `OPVAL3`, `OP4`, `OPVAL4`) VALUES
('DASS21', 'Did not apply to me at all', 0, 'Applied to me to some degree, or some of the time', 1, 'Applied to me to a considerable degree or a good part of time', 2, 'Applied to me very much or most of the time', 3);

-- --------------------------------------------------------

--
-- Table structure for table `DASS21questions`
--

CREATE TABLE `DASS21questions` (
  `testid` varchar(255) NOT NULL,
  `questioncat` varchar(255) NOT NULL,
  `questionno` int(11) NOT NULL,
  `questionname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DASS21questions`
--

INSERT INTO `DASS21questions` (`testid`, `questioncat`, `questionno`, `questionname`) VALUES
('DASS21', 'stress', 1, 'I found it hard to wind down'),
('DASS21', 'anxiety', 2, 'I was aware of dryness of my mouth'),
('DASS21', 'depression', 3, 'I couldnâ€™t seem to experience any positive feeling at all'),
('DASS21', 'anxiety', 4, 'I experienced breathing difficulty (e.g. excessively rapid breathing, breathlessness in the absence of physical exertion)'),
('DASS21', 'depression', 5, 'I found it difficult to work up the initiative to do things'),
('DASS21', 'stress', 6, 'I tended to over-react to situations'),
('DASS21', 'anxiety', 7, 'I experienced trembling (e.g. in the hands)'),
('DASS21', 'stress', 8, 'I felt that I was using a lot of nervous energy'),
('DASS21', 'anxiety', 9, 'I was worried about situations in which I might panic and make a fool of myself'),
('DASS21', 'depression', 10, 'I felt that I had nothing to look forward to'),
('DASS21', 'stress', 11, 'I found myself getting agitated'),
('DASS21', 'stress', 12, 'I found it difficult to relax'),
('DASS21', 'depression', 13, 'I felt down-hearted and blue'),
('DASS21', 'stress', 14, 'I was intolerant of anything that kept me from getting on with what I was doing'),
('DASS21', 'anxiety', 15, 'I felt I was close to panic'),
('DASS21', 'depression', 16, 'I was unable to become enthusiastic about anything'),
('DASS21', 'depression', 17, 'I felt I wasnâ€™t worth much as a person'),
('DASS21', 'stress', 18, 'I felt that I was rather touchy'),
('DASS21', 'anxiety', 19, 'I was aware of the action of my heart in the absence of physical exertion (e.g. sense of heart rate increase, heart missing a beat)'),
('DASS21', 'anxiety', 20, 'I felt scared without any good reason'),
('DASS21', 'depression', 21, 'I felt that life was meaningless');

-- --------------------------------------------------------

--
-- Table structure for table `DASS21results`
--

CREATE TABLE `DASS21results` (
  `testid` varchar(255) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `QA1` int(11) NOT NULL,
  `QA2` int(11) NOT NULL,
  `QA3` int(11) NOT NULL,
  `QA4` int(11) NOT NULL,
  `QA5` int(11) NOT NULL,
  `QA6` int(11) NOT NULL,
  `QA7` int(11) NOT NULL,
  `QA8` int(11) NOT NULL,
  `QA9` int(11) NOT NULL,
  `QA10` int(11) NOT NULL,
  `QA11` int(11) NOT NULL,
  `QA12` int(11) NOT NULL,
  `QA13` int(11) NOT NULL,
  `QA14` int(11) NOT NULL,
  `QA15` int(11) NOT NULL,
  `QA16` int(11) NOT NULL,
  `QA17` int(11) NOT NULL,
  `QA18` int(11) NOT NULL,
  `QA19` int(11) NOT NULL,
  `QA20` int(11) NOT NULL,
  `QA21` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DASS21results`
--

INSERT INTO `DASS21results` (`testid`, `studentid`, `QA1`, `QA2`, `QA3`, `QA4`, `QA5`, `QA6`, `QA7`, `QA8`, `QA9`, `QA10`, `QA11`, `QA12`, `QA13`, `QA14`, `QA15`, `QA16`, `QA17`, `QA18`, `QA19`, `QA20`, `QA21`) VALUES
('DASS21', 'B141234', 3, 3, 3, 3, 3, 3, 0, 1, 0, 1, 2, 0, 1, 1, 0, 1, 0, 2, 0, 1, 0),
('DASS21', 'B141432', 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3),
('DASS21', 'B141492', 0, 2, 0, 1, 3, 1, 0, 3, 1, 0, 1, 3, 1, 0, 2, 1, 2, 1, 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` varchar(255) NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `studentname`, `year`, `department`, `class`, `password`) VALUES
('B141492', 'bhanu prasad thandra', 'E-3', 'CSE', 'AB1-102', 'bhanu');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `testid` varchar(255) NOT NULL,
  `testtitle` varchar(255) NOT NULL,
  `noofquestions` int(11) NOT NULL,
  `noofoptions` int(11) NOT NULL,
  `noofcategories` int(11) NOT NULL,
  `scale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`testid`, `testtitle`, `noofquestions`, `noofoptions`, `noofcategories`, `scale`) VALUES
('DASS21', 'DASS', 21, 4, 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `DASS21category`
--
ALTER TABLE `DASS21category`
  ADD PRIMARY KEY (`testid`);

--
-- Indexes for table `DASS21cutoff`
--
ALTER TABLE `DASS21cutoff`
  ADD PRIMARY KEY (`scale`);

--
-- Indexes for table `DASS21options`
--
ALTER TABLE `DASS21options`
  ADD PRIMARY KEY (`testid`);

--
-- Indexes for table `DASS21questions`
--
ALTER TABLE `DASS21questions`
  ADD PRIMARY KEY (`testid`,`questionno`);

--
-- Indexes for table `DASS21results`
--
ALTER TABLE `DASS21results`
  ADD PRIMARY KEY (`testid`,`studentid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`testid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
