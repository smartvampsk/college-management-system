-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2018 at 05:07 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `groupproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'raman', 'r@gmail.com', '7cc6f4af720546660b86566c48c0f84b7ec13340');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE IF NOT EXISTS `admission` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `spercentage` varchar(255) NOT NULL,
  `highschool` varchar(255) NOT NULL,
  `hpercentage` varchar(255) NOT NULL,
  `bachelor` varchar(255) NOT NULL,
  `bpercentage` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `firstname`, `lastname`, `email`, `contactnumber`, `gender`, `schoolname`, `spercentage`, `highschool`, `hpercentage`, `bachelor`, `bpercentage`, `course`) VALUES
(5, 'rupak', 'shrestha', 'rupak@gmail.com', '123456789', 'male', 'Nami', '22', 'dami', '44', 'harvard', '98', 'software'),
(6, 'ganesh', 'khadka', 'ganesh@gmail.com', '54321025', 'male', 'Nami', '22', 'dami', '44', 'harvard', '98', 'software'),
(9, 'Chiranjibi', 'lawati', 'lawati@yahoo.com', '', 'Male', '', '', '', '', '', '', 'BSc (HONS) Computing'),
(10, 'Christopher', 'Edwards', 'chirs@gmail.com', '912736817983', 'Male', 'aeuewuhd', '89', 'feagkwe', '76', 'gauyuf', '78', 'BSc (HONS) Computing');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE IF NOT EXISTS `archives` (
`archive_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`archive_id`, `firstname`, `surname`, `email`, `contactNumber`, `gender`) VALUES
(1, 'Gagan', 'Raut', 'gaganraut@gmail.com', '985511531651', 'Male'),
(2, 'Raman', 'Shrestha', 'ramansresta@gmail.com', '9814922438', 'Male'),
(3, 'Binita', 'Nepal', 'binita@gmail.com', '9845632865', 'Female'),
(4, 'asfjla', 'jfklsjakl', 'jfklasjklf', 'jfjsakl', 'Male'),
(5, 'tyfghj', 'tdfghj', 'sdfhj', 'sdggh', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `archive_courses`
--

CREATE TABLE IF NOT EXISTS `archive_courses` (
`c_id` int(8) NOT NULL,
  `c_title` varchar(255) NOT NULL,
  `c_weight` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archive_courses`
--

INSERT INTO `archive_courses` (`c_id`, `c_title`, `c_weight`, `level`) VALUES
(8, 'Dissertation', '40', 'Level 5'),
(9, 'CSIT', '300', '4');

-- --------------------------------------------------------

--
-- Table structure for table `archive_modules`
--

CREATE TABLE IF NOT EXISTS `archive_modules` (
`m_code` int(8) NOT NULL,
  `m_title` varchar(255) NOT NULL,
  `c_weight` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `course_id` int(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archive_modules`
--

INSERT INTO `archive_modules` (`m_code`, `m_title`, `c_weight`, `level`, `course_id`) VALUES
(1, ' CSY2038 ', ' 20 ', '4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
`aid` int(11) NOT NULL,
  `atitle` varchar(255) NOT NULL,
  `atutor` varchar(255) NOT NULL,
  `atype` varchar(255) NOT NULL,
  `alevel` varchar(255) NOT NULL,
  `aterm` varchar(255) NOT NULL,
  `amodule` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `archiveID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`aid`, `atitle`, `atutor`, `atype`, `alevel`, `aterm`, `amodule`, `sdate`, `edate`, `archiveID`) VALUES
(11, 'Theory of Relativity', 'Daniel Barnes', 'Regular', 'Level 5', 'Term 2', 42, '2018-04-19', '2018-05-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`attendance_id` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `student_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `currentDate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `status`, `student_id`, `module_id`, `currentDate`) VALUES
(1, 'P', 11, 42, '2018-04-20'),
(2, 'A', 12, 42, '2018-04-20'),
(3, 'A', 15, 42, '2018-04-20'),
(4, 'P', 14, 42, '2018-04-20'),
(5, 'P', 16, 42, '2018-04-20'),
(6, 'P', 18, 42, '2018-04-20'),
(7, 'P', 19, 42, '2018-04-20'),
(8, 'P', 11, 45, '2018-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
`course_id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `credit_weight` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `credit_weight`, `level`) VALUES
(8, 'BSc (HONS) Computing', '20', '5'),
(12, 'BBA', '20', '6'),
(15, 'BSc (HONS) Environmental Science', '40', '4'),
(17, 'BSc CSIT', '300', '5');

-- --------------------------------------------------------

--
-- Table structure for table `diarymanagement`
--

CREATE TABLE IF NOT EXISTS `diarymanagement` (
`id` int(11) NOT NULL,
  `adate` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `dateofwork` date NOT NULL,
  `dtext` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diarymanagement`
--

INSERT INTO `diarymanagement` (`id`, `adate`, `title`, `dateofwork`, `dtext`) VALUES
(7, '2018-04-12', 'fdas', '2018-04-05', 'fasd'),
(8, '2018-04-20', 'remind me to do my assignment', '2018-01-01', 'complete GP project');

-- --------------------------------------------------------

--
-- Table structure for table `etimetables`
--

CREATE TABLE IF NOT EXISTS `etimetables` (
`etid` int(11) NOT NULL,
  `eday` varchar(255) NOT NULL,
  `edate` date NOT NULL,
  `emodule` varchar(255) NOT NULL,
  `estime` varchar(255) NOT NULL,
  `eetime` varchar(255) NOT NULL,
  `archiveID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etimetables`
--

INSERT INTO `etimetables` (`etid`, `eday`, `edate`, `emodule`, `estime`, `eetime`, `archiveID`) VALUES
(1, 'Sunday', '2018-04-19', 'CSY2038', '5:40', '2:40', 0),
(3, 'Monday', '2018-01-04', 'C2005', '1:00', '3:00', 0),
(4, 'Wednesday', '2018-04-21', 'C2002', '12:30', '2:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
`gid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `asid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gid`, `sid`, `asid`, `mid`, `grade`, `marks`) VALUES
(2, 11, 11, 42, 'A', 80),
(3, 12, 11, 42, 'A+', 90),
(4, 15, 11, 42, 'B', 55),
(5, 20, 11, 42, 'C-', 40);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`module_code` int(11) NOT NULL,
  `module_title` varchar(255) NOT NULL,
  `credit_weight` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `week` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_code`, `module_title`, `credit_weight`, `level`, `description`, `week`, `course_id`) VALUES
(36, 'C1001', '20', '4', 'Computing Mathematics', 'Week1', 8),
(37, 'C1002', '20', '4', 'Systems Architecture', 'Week1', 8),
(38, 'C1003', '20', '4', 'Problem Solving', 'Week1', 8),
(39, 'C1004', '20', '4', 'Software Modelling 1', 'Week1', 8),
(40, 'C1005', '20', '4', 'Software Implementation 1', 'Week1', 8),
(41, 'C1006', '20', '4', 'Distributed Systems', 'Week1', 8),
(42, 'C2001', '20', '5', 'Software Modelling 2', 'Week1', 8),
(43, 'C2002', '20', '5', 'Software Implementation 2', 'Week1', 8),
(44, 'C2003', '20', '5', 'Knowledge Processing', 'Week1', 8),
(45, 'C2004', '20', '5', 'Formal Specification of System Software', 'Week1', 8),
(46, 'C2005', '20', '5', 'Database Technology', 'Week1', 8),
(47, 'C2006', '20', '5', 'Group Project and Group Management', 'Week1', 8),
(48, 'C3001', '2', '6', 'Software Modelling 3', 'Week1', 8),
(49, 'C3002', '20', '6', 'Software Implementation 3', 'Week1', 8),
(50, 'C3003', '20', '6', 'Applications of Artificial Intelligence', 'Week1', 8),
(51, 'C3004', '20', '6', 'Formal Specification of System Software 2', 'Week1', 8),
(52, 'C3005', '40', '6', 'Dessertation', 'Week1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pat`
--

CREATE TABLE IF NOT EXISTS `pat` (
`pat_id` int(11) NOT NULL,
  `tutor` varchar(255) NOT NULL,
  `student` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat`
--

INSERT INTO `pat` (`pat_id`, `tutor`, `student`) VALUES
(3, '24', '14'),
(4, '24', '12'),
(5, '20', '11'),
(6, '22', '11'),
(7, '22', '12');

-- --------------------------------------------------------

--
-- Table structure for table `regisstudent`
--

CREATE TABLE IF NOT EXISTS `regisstudent` (
`rs_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regisstudent`
--

INSERT INTO `regisstudent` (`rs_id`, `std_id`, `username`, `password`) VALUES
(2, 12, 'ramanshrestha', '$2y$10$FnOEJoSK8fY.Fh2u1aaxhuXZ65iTEyDndpLK4p//OaGW0YD4WvUie'),
(3, 11, 'rohitrajbanshi', '$2y$10$OQQn7uX9z65GjN.cPAB7qe8D6BC7MHUO7tYGT2wo6V9ICqscxDoye'),
(4, 17, 'asad', '$2y$10$qKU4yMayrNmX.Uqm9uNwqOFRCIp8Pd50/pgSZJExzvf8GHC73TUV.'),
(5, 17, 'asad', '$2y$10$7CToBfC0ALq5wLCI3b1hQepL6f60huMc16z4pyLX/yBh/yuYPqFru');

-- --------------------------------------------------------

--
-- Table structure for table `registutors`
--

CREATE TABLE IF NOT EXISTS `registutors` (
`rt_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registutors`
--

INSERT INTO `registutors` (`rt_id`, `tutor_id`, `username`, `password`) VALUES
(3, 21, 'simon', 'simon'),
(4, 22, 'david', '$2y$10$zgEpjSGF8kbFwCbnx7WaO.nNcyTWVjif0fhgnBJUlrWfHkbl78UAC');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
`s_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `subject` int(11) NOT NULL,
  `assignedID` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`s_id`, `fname`, `sname`, `dob`, `position`, `email`, `contact`, `address`, `subject`, `assignedID`, `status`) VALUES
(21, 'Simon', 'White', '1994-06-01', 'CL/ML/PL', 'simon@gmail.com', '091726378422', 'northampton', 45, '99100102', 'Live'),
(22, 'David', 'Adams', '1987-02-01', 'ML/PL', 'david@gmail.com', '078298712383', 'Jorpati', 42, '99100101', 'Live'),
(23, 'Daniel', 'Barnes', '1978-09-04', 'ML/PL', 'daniel@gmail.com', '981628391728', 'northampton', 40, '99100190', 'Live'),
(24, 'Andrew', 'Fletcher', '1992-10-04', 'ML/PL', 'andrew@gmail.com', '91628379898', 'northampton', 44, '99100279', 'Live'),
(25, 'Ryan', 'Hickman', '1995-03-02', 'ML/PL', 'ryan@gmail.com', '91273192838', 'northampton', 50, '99100279', 'Live'),
(26, 'Paul', 'Jones', '1994-03-03', 'ML/PL', 'paul@gmail.com', '9812356182163', 'Ktm', 52, '99100279', 'Live');

-- --------------------------------------------------------

--
-- Table structure for table `staff_archieve`
--

CREATE TABLE IF NOT EXISTS `staff_archieve` (
`s_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_archieve`
--

INSERT INTO `staff_archieve` (`s_id`, `fname`, `sname`, `dob`, `position`, `email`, `contact`, `address`) VALUES
(3, 'budo', 'budaasdshdg', '2018-03-28', 'asdas', 'asdas', 'sadffas', 'sasffas'),
(4, 'dsf', 'dsfdf', '2018-03-22', 'dfd', 'dfda', 'dfad', 'dafadf'),
(5, 'sdfs', 'sdfsd', '2018-03-22', 'sdfgsd', 'dsgsd', 'sdgsd', 'sdgsdewreqr'),
(6, 'sdf', 'dfsghshsgjsg', '2018-03-23', 'fdshsfdh', 'fdhsdfh', 'dsfhdfsh', 'fsdhdfshfd'),
(7, 'auywek', 'uyake', '2019-01-01', 'auyeweyiu', 'aewkj2@gmail.com', 'yaiwue', 'uyaekujwe');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`student_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `assID` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `firstname`, `surname`, `email`, `contactNumber`, `gender`, `archive`, `course_id`, `status`, `assID`, `address`) VALUES
(11, 'Rohit', 'Rajbanshi', 'rohitrazzzbanshi@gmail.com', '9814036090', 'Male', 1, 8, '5', '61283721', 'jorpati'),
(12, 'Raman', 'Shrestha', 'ramansresta@gmail.com', '9814922438', 'Male', 1, 8, '4', '', ''),
(13, 'Chiranjibi', 'Lawati', 'chiranjibi.lawati.1@gmail.com', '9807933880', 'Male', 1, 12, '6', '', ''),
(14, 'Sandesh', 'Thapa Magar', 'sandesh.t.magar@gmail.com', '9845865702', 'Male', 0, 8, '5', '', ''),
(15, 'Christopher', 'Edward', 'chris@gmail.com', '981239012831', 'Male', 1, 8, '5', '20130106', 'Northampton'),
(16, 'Garaham', 'Vinitchaikul', 'garaham@gmail.com', '9813712983', 'Male', 1, 8, '5', '20130107', 'Jorpati'),
(17, 'Asad', 'Cox', 'cox@yahoo.com', '918763289188', 'Male', 1, 8, '5', '20130113', 'northampton'),
(18, 'Andrew', 'Carpenter', 'andrew@gmail.com', '912823712093', 'Male', 1, 8, '5', '20130116', 'ktm'),
(19, 'Alexender', 'Begum', 'begum@gmail.com', '20130117728', 'Male', 1, 8, '5', '20130117', 'Ratopul'),
(20, 'Andrew', 'Brown', 'brown@gmail.com', '9126381928', 'Male', 1, 8, '4', '20130124', 'kalopul');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_assignment`
--

CREATE TABLE IF NOT EXISTS `submitted_assignment` (
`submit_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submitted_assignment`
--

INSERT INTO `submitted_assignment` (`submit_id`, `assignment_id`, `module_id`, `student_id`) VALUES
(1, 7, 6, 11),
(2, 7, 6, 11),
(3, 11, 42, 11);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE IF NOT EXISTS `timetables` (
`tid` int(11) NOT NULL,
  `tday` varchar(225) NOT NULL,
  `tdate` date NOT NULL,
  `ftutor` varchar(225) NOT NULL,
  `fmodule` varchar(225) NOT NULL,
  `fstime` varchar(225) NOT NULL,
  `fetime` varchar(225) NOT NULL,
  `stutor` varchar(225) NOT NULL,
  `smodule` varchar(225) NOT NULL,
  `sstime` varchar(225) NOT NULL,
  `setime` varchar(225) NOT NULL,
  `ttutor` varchar(225) NOT NULL,
  `tmodule` varchar(225) NOT NULL,
  `tstime` varchar(225) NOT NULL,
  `tetime` varchar(225) NOT NULL,
  `fotutor` varchar(225) NOT NULL,
  `fomodule` varchar(225) NOT NULL,
  `fostime` varchar(225) NOT NULL,
  `foetime` varchar(225) NOT NULL,
  `archiveID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`tid`, `tday`, `tdate`, `ftutor`, `fmodule`, `fstime`, `fetime`, `stutor`, `smodule`, `sstime`, `setime`, `ttutor`, `tmodule`, `tstime`, `tetime`, `fotutor`, `fomodule`, `fostime`, `foetime`, `archiveID`) VALUES
(1, 'Sunday', '0000-00-00', 'santosh khanal', 'CSY3028', 'fadsfdsa', 'fasdf', 'santosh khanal', 'CSY3028', 'fasd', 'fas', 'santosh khanal', 'CSY3028', 'fas', 'fasd', 'santosh khanal', 'CSY3028', '', '', 1),
(2, 'Monday', '2018-04-12', 'santosh khanal', 'CSY2038', '', '', 'Raman Shrestha', 'CSY2038', '', '', 'santosh khanal', 'CSY3028', '', '', 'Raman Shrestha', 'CSY2038', '', '', 0),
(3, 'Tuesday', '2018-04-20', 'David Adams', 'C2001', '8:30', '9:30', 'Daniel Barnes', 'C2002', '10:30', '11:30', 'Andrew Fletcher', 'C2003', '12:00', '1:00', 'Ryan Hickman', 'C2004', '1:30', '2:30', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
 ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `archive_courses`
--
ALTER TABLE `archive_courses`
 ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `archive_modules`
--
ALTER TABLE `archive_modules`
 ADD PRIMARY KEY (`m_code`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
 ADD PRIMARY KEY (`aid`), ADD KEY `amodule` (`amodule`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`attendance_id`), ADD KEY `student_id` (`student_id`), ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `diarymanagement`
--
ALTER TABLE `diarymanagement`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etimetables`
--
ALTER TABLE `etimetables`
 ADD PRIMARY KEY (`etid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
 ADD PRIMARY KEY (`gid`), ADD KEY `sid` (`sid`), ADD KEY `asid` (`asid`), ADD KEY `mid` (`mid`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`module_code`), ADD KEY `course_id` (`course_id`), ADD KEY `module_code` (`module_code`);

--
-- Indexes for table `pat`
--
ALTER TABLE `pat`
 ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `regisstudent`
--
ALTER TABLE `regisstudent`
 ADD PRIMARY KEY (`rs_id`), ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `registutors`
--
ALTER TABLE `registutors`
 ADD PRIMARY KEY (`rt_id`), ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`s_id`), ADD KEY `subject` (`subject`);

--
-- Indexes for table `staff_archieve`
--
ALTER TABLE `staff_archieve`
 ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`student_id`), ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `submitted_assignment`
--
ALTER TABLE `submitted_assignment`
 ADD PRIMARY KEY (`submit_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
 ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `archive_courses`
--
ALTER TABLE `archive_courses`
MODIFY `c_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `archive_modules`
--
ALTER TABLE `archive_modules`
MODIFY `m_code` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `diarymanagement`
--
ALTER TABLE `diarymanagement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `etimetables`
--
ALTER TABLE `etimetables`
MODIFY `etid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `module_code` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `pat`
--
ALTER TABLE `pat`
MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `regisstudent`
--
ALTER TABLE `regisstudent`
MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registutors`
--
ALTER TABLE `registutors`
MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `staff_archieve`
--
ALTER TABLE `staff_archieve`
MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `submitted_assignment`
--
ALTER TABLE `submitted_assignment`
MODIFY `submit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`amodule`) REFERENCES `modules` (`module_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_code`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`asid`) REFERENCES `assignment` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `modules` (`module_code`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regisstudent`
--
ALTER TABLE `regisstudent`
ADD CONSTRAINT `regisstudent_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registutors`
--
ALTER TABLE `registutors`
ADD CONSTRAINT `registutors_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `staff` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `modules` (`module_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
