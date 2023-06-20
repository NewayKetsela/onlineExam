-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 07:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oes`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac`
--

CREATE TABLE `ac` (
  `AC_ID` int(11) NOT NULL,
  `F_NAME` varchar(50) NOT NULL,
  `M_NAME` varchar(50) NOT NULL,
  `L_NAME` varchar(50) NOT NULL,
  `GENDER` enum('female','male') DEFAULT NULL,
  `STATUS` enum('in active','active') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ac`
--

INSERT INTO `ac` (`AC_ID`, `F_NAME`, `M_NAME`, `L_NAME`, `GENDER`, `STATUS`) VALUES
(2563, 'Abel', 'Melis', 'kebede', 'male', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `U_ID` int(11) NOT NULL,
  `ROLE` enum('Student','Teacher','AC','Exam_Committee','Admin') DEFAULT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`U_ID`, `ROLE`, `USERNAME`, `PASSWORD`) VALUES
(1121, 'Student', 'Haile1121', '$2y$10$YCKurqysdOIpYedo2HYIYOuFxY6WphHw.OY1tkArAPB6whCXKwo66'),
(1122, 'Student', 'Haile1122', '$2y$10$LBIrPccs7qr/jjaKS/kJ2.0GARNUhojPuZo.tJgjNWCQXgjpR2P8e'),
(1212, 'Student', 'Betelhem1212', '$2y$10$ROnno/65x8pIH/..i1Qr3OR99Aw/tL3DhtRP5oMYRdH7dZR/dPb2y'),
(1234, 'Admin', 'Neway1234', '$2y$10$81mZhvsQWioeyKj2ZcUNjOIgkNB/IXsVE8CY5LX6Jk227D5uQ706C'),
(2023, 'Teacher', 'Beza2023', '$2y$10$kjrE.t96/6mOfkN57ys1H.297rTRK1FSEBtOP40vhzCePLvEL4N7m'),
(2323, 'Student', 'Kaleab2323', '$2y$10$vMBBxDgB8z6QrUXJgvVmWOdPznfYjb8r8T8Ol7MOH8rNi5zY6qVdK'),
(2345, 'Admin', 'Tesfaye2345', '$2y$10$o2GNxy7UbFt/nFxq1HGGteDFjVhfSX0ZTOt642grSjyaHgkUs1eXi'),
(2563, 'AC', 'Abel2563', '$2y$10$vYufkRlO5DsTvZTCvKldC.tBEF/NaalVBdQaefiB.DQvEjsHxkVkC'),
(3434, 'Student', 'Emanda3434', '$2y$10$Ny3BijPXbqa/9QwU7gQWveaGRdgX5gEm.7LaEq2KCP9tARZLu6aMS'),
(4455, 'Student', 'Pawulos4455', '$2y$10$mrSmuhTI3GyjMVKMyn.1Vuuyq4y3gehxqcVpABtzrYOjAIKAt7V8y'),
(5061, 'Exam_Committee', 'Taye5061', '$2y$10$6CUm/cPSx9zEjzmMib1daOOowme4HNzIXNPsVRO4m35hE3WHULEAG'),
(6565, 'Teacher', 'Abrham6565', '$2y$10$GFIFlZ8LDkn44vxwkpY.BeqX056GNDyGEGaKZY7CsuOuk9leKLYcK'),
(7000, 'Student', 'Betelhem7000', '$2y$10$qs5Ia16kxdiXxzoCNSpOt.budq7lujKgP4pOZebl1oRXu0KN4SY5q'),
(7071, 'Teacher', 'Haymanot7071', '$2y$10$Vmu1WWGiJDpUO/S9X9uex.DeV9qDSO72YgvQAolm6lsN/LHSYmiMq'),
(7080, 'Exam_Committee', 'Yonas7080', '$2y$10$wGyzRd6f.WYVZNuHSPcnxeCc.A5KTCdzo6PwjNN3qXIRQaZGkWZva'),
(9090, 'Student', 'Ketsela9090', '$2y$10$FQNzTuyz56De2mxUiwutNuTNlh1XQCQuULj/jrIpwpOxcea83WH92');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `F_NAME` varchar(50) NOT NULL,
  `M_NAME` varchar(50) NOT NULL,
  `L_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `F_NAME`, `M_NAME`, `L_NAME`) VALUES
(1234, 'Neway', 'ketsela', 'Tekola'),
(2345, 'Tesfaye', 'Tesema', 'Ayele');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSE_ID` varchar(50) NOT NULL,
  `COURSE_NAME` varchar(50) NOT NULL,
  `DEPARTMENT_NAME` varchar(50) NOT NULL,
  `YEAR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `DEPARTMENT_NAME`, `YEAR`) VALUES
('Coc2021', 'Software Engineering ', 'Information Teachnology', 3),
('ScS01', 'Compiler Design', 'computer science', 4),
('SeC03', 'Computer security', 'computer science ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `exam_bank`
--

CREATE TABLE `exam_bank` (
  `EXAM_ID` int(11) NOT NULL,
  `TEACHER_ID` int(11) DEFAULT NULL,
  `COURSE_ID` varchar(50) DEFAULT NULL,
  `COURSE_NAME` varchar(255) DEFAULT NULL,
  `EXAM_TYPE` enum('Mid Exam','Final Exam') DEFAULT NULL,
  `EXAM_TIME` time DEFAULT NULL,
  `REQUEST_EVALUATION` enum('asked','accepted','rejected') DEFAULT NULL,
  `COMMENT` varchar(255) DEFAULT NULL,
  `STATUS` enum('not taken','taken') DEFAULT 'not taken',
  `TIME_SET` enum('not set','set') DEFAULT 'not set'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_bank`
--

INSERT INTO `exam_bank` (`EXAM_ID`, `TEACHER_ID`, `COURSE_ID`, `COURSE_NAME`, `EXAM_TYPE`, `EXAM_TIME`, `REQUEST_EVALUATION`, `COMMENT`, `STATUS`, `TIME_SET`) VALUES
(9, 6565, 'ScS01', 'Compiler Design', 'Final Exam', '02:00:00', 'accepted', 'excelent', 'not taken', 'set'),
(11, 2023, 'SeC03', 'Computer security', 'Mid Exam', '01:30:00', 'asked', '', 'not taken', 'not set');

-- --------------------------------------------------------

--
-- Table structure for table `exam_committee`
--

CREATE TABLE `exam_committee` (
  `COMMITTEE_ID` int(11) NOT NULL,
  `F_NAME` varchar(50) DEFAULT NULL,
  `M_NAME` varchar(50) DEFAULT NULL,
  `L_NAME` varchar(50) DEFAULT NULL,
  `ASSIGN_COURSE_ID` varchar(50) DEFAULT NULL,
  `STATUS` enum('in active','active') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_committee`
--

INSERT INTO `exam_committee` (`COMMITTEE_ID`, `F_NAME`, `M_NAME`, `L_NAME`, `ASSIGN_COURSE_ID`, `STATUS`) VALUES
(5061, 'Taye', 'Berihanu', 'Lema', 'ScS01', 'active'),
(7080, 'Yonas', 'Kaleab', 'Nati', 'SeC03', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `SCHEDULE_ID` int(11) NOT NULL,
  `COURSE_ID` varchar(50) DEFAULT NULL,
  `EXAM_DATE` date DEFAULT NULL,
  `START_TIME` time DEFAULT NULL,
  `END_TIME` varchar(20) DEFAULT NULL,
  `DEPARTMENT_NAME` varchar(50) DEFAULT NULL,
  `YEAR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`SCHEDULE_ID`, `COURSE_ID`, `EXAM_DATE`, `START_TIME`, `END_TIME`, `DEPARTMENT_NAME`, `YEAR`) VALUES
(1, 'ScS01', '2023-06-21', '10:00:00', '12:00:00', 'computer science', 4),
(12, 'SeC03', '2023-06-19', '03:00:00', '4:30:00', 'computer science ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `QUESTION_ID` int(11) NOT NULL,
  `QUESTION_TYPE` varchar(255) DEFAULT NULL,
  `QUESTION` varchar(255) DEFAULT NULL,
  `CHOICE1` varchar(255) DEFAULT NULL,
  `CHOICE2` varchar(255) DEFAULT NULL,
  `CHOICE3` varchar(255) DEFAULT NULL,
  `CHOICE4` varchar(255) DEFAULT NULL,
  `QUESTION_POINT` float NOT NULL,
  `ANSWER` varchar(255) DEFAULT NULL,
  `TEACHER_ID` int(11) DEFAULT NULL,
  `STATUS` enum('old','new') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`QUESTION_ID`, `QUESTION_TYPE`, `QUESTION`, `CHOICE1`, `CHOICE2`, `CHOICE3`, `CHOICE4`, `QUESTION_POINT`, `ANSWER`, `TEACHER_ID`, `STATUS`) VALUES
(38, 'multipleChoice', 'which one of the following is a server-side scripting language embedded in HTML in its simplest form.', 'HTML', 'CSS', 'PHP', 'Java', 1, 'C', 2023, 'new'),
(39, 'fillInTheBlank', '_______is the standard markup language for creating Web pages and it describes the structure of a Web page.', NULL, NULL, NULL, NULL, 1.5, 'HTML', 2023, 'new'),
(40, 'Essay', 'What are the goal of a Distributed System?', NULL, NULL, NULL, NULL, 2, NULL, 2023, 'new'),
(43, 'Essay', 'What is Machine learning?', NULL, NULL, NULL, NULL, 2.5, NULL, 6565, 'new'),
(45, 'multipleChoice', 'What is the capital of France?\r', 'London\r', 'Paris\r', 'Rome\r', 'Madrid\r', 1.5, 'B', 2023, 'new'),
(46, 'multipleChoice', 'What is the largest planet in our solar system?\r', 'Mercury\r', 'Venus\r', 'Earth\r', 'Jupiter\r', 1.5, 'D', 2023, 'new'),
(5556, 'multipleChoice', 'which one of the following is a server-side scripting language embedded in HTML in its simplest form.\r', 'php\r', 'html\r', 'css\r', 'all\r', 2, 'A', 2023, 'new'),
(5558, 'trueORFalse', 'PHP and Java are incredibly popular front end languages used to build web pages.\r', 'true', 'false', NULL, NULL, 1, 'false', 2023, 'new'),
(5559, 'trueORFalse', 'Java is more secure as compared to PHP. PHP is less secure and seeks the help of other integrations and frameworks for security purposes\r\n', 'true', 'false', NULL, NULL, 1, 'false', 2023, 'new'),
(5567, 'fillInTheBlank', '_______ is used in complex projects for enterprise level, while PHP is used in projects with less complexity and is ideal for start-ups.\r', NULL, NULL, NULL, NULL, 2, 'java\r', 2023, 'new'),
(5568, 'fillInTheBlank', '________ is a subfield of artificial intelligence, which is broadly defined as the capability of a machine to imitate intelligent human behavior\r', NULL, NULL, NULL, NULL, 1.5, 'Machine learning\r', 2023, 'new'),
(5569, 'fillInTheBlank', 'Image recognition is a well-known and widespread example of _____ in the real world.\r', NULL, NULL, NULL, NULL, 2.5, 'Machine learning\r', 2023, 'new'),
(5571, 'Essay', 'What is Machine learning?\r', NULL, NULL, NULL, NULL, 3, NULL, 2023, 'new'),
(5572, 'Essay', 'What is AI?\r', NULL, NULL, NULL, NULL, 5, NULL, 2023, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `STUDENT_ID` int(11) NOT NULL,
  `F_NAME` varchar(50) DEFAULT NULL,
  `M_NAME` varchar(50) DEFAULT NULL,
  `L_NAME` varchar(50) DEFAULT NULL,
  `GENDER` enum('Male','Female') DEFAULT NULL,
  `YEAR` int(11) DEFAULT NULL,
  `DEPARTMENT_NAME` varchar(50) DEFAULT NULL,
  `STATUS` enum('in active','active') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`STUDENT_ID`, `F_NAME`, `M_NAME`, `L_NAME`, `GENDER`, `YEAR`, `DEPARTMENT_NAME`, `STATUS`) VALUES
(1122, 'Haile', 'Melis', 'Debebe', 'Male', 4, 'Computer science', 'active'),
(1212, 'Betelhem', 'Abebe', 'Debebe', 'Female', 4, 'Computer science', 'active'),
(2323, 'Kaleab', 'Zeleke', 'Ayele', 'Male', 4, 'Computer science', 'active'),
(3434, 'Emanda', 'Taye', 'Yohanis', 'Female', 4, 'computer science', 'in active'),
(4455, 'Pawulos', 'Bezie', 'Zeleke', 'Male', 4, 'Computer science', 'active'),
(7000, 'Betelhem', 'ayele', 'Dani', 'Female', 4, 'Information System', 'active'),
(9090, 'Ketsela', 'Neway', 'Tekola', 'Male', 3, 'Information System', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TEACHER_ID` int(11) NOT NULL,
  `F_NAME` varchar(50) DEFAULT NULL,
  `M_NAME` varchar(50) DEFAULT NULL,
  `L_NAME` varchar(50) DEFAULT NULL,
  `GENDER` enum('Male','Female') DEFAULT NULL,
  `COURSE_ID` varchar(50) DEFAULT NULL,
  `STATUS` enum('in active','active') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TEACHER_ID`, `F_NAME`, `M_NAME`, `L_NAME`, `GENDER`, `COURSE_ID`, `STATUS`) VALUES
(2023, 'Beza', 'Zeleke', 'Zerihun', 'Female', 'SeC03', 'active'),
(6565, 'Abrham', 'Kebede', 'Zelalem', 'Male', 'ScS01', 'active'),
(7071, 'Haymanot', 'Neway', 'Tesfaye', 'Male', 'Coc2021', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac`
--
ALTER TABLE `ac`
  ADD PRIMARY KEY (`AC_ID`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`U_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_ID`);

--
-- Indexes for table `exam_bank`
--
ALTER TABLE `exam_bank`
  ADD PRIMARY KEY (`EXAM_ID`),
  ADD KEY `TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`);

--
-- Indexes for table `exam_committee`
--
ALTER TABLE `exam_committee`
  ADD PRIMARY KEY (`COMMITTEE_ID`),
  ADD KEY `COURSE_ID` (`ASSIGN_COURSE_ID`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`SCHEDULE_ID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`QUESTION_ID`),
  ADD KEY `TEACHER_ID` (`TEACHER_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`STUDENT_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TEACHER_ID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_bank`
--
ALTER TABLE `exam_bank`
  MODIFY `EXAM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `SCHEDULE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5573;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_bank`
--
ALTER TABLE `exam_bank`
  ADD CONSTRAINT `exam_bank_ibfk_1` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`),
  ADD CONSTRAINT `exam_bank_ibfk_2` FOREIGN KEY (`COURSE_ID`) REFERENCES `course` (`COURSE_ID`);

--
-- Constraints for table `exam_committee`
--
ALTER TABLE `exam_committee`
  ADD CONSTRAINT `exam_committee_ibfk_1` FOREIGN KEY (`ASSIGN_COURSE_ID`) REFERENCES `course` (`COURSE_ID`);

--
-- Constraints for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `exam_schedule_ibfk_1` FOREIGN KEY (`COURSE_ID`) REFERENCES `course` (`COURSE_ID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`COURSE_ID`) REFERENCES `course` (`COURSE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
