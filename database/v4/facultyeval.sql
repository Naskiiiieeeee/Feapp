-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 06:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facultyeval`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `seminar_title` varchar(255) DEFAULT NULL,
  `seminar_name` varchar(255) DEFAULT NULL,
  `certificate_path` varchar(255) DEFAULT NULL,
  `faculty_email` varchar(255) DEFAULT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `certificate_id` varchar(255) DEFAULT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `seminar_title`, `seminar_name`, `certificate_path`, `faculty_email`, `faculty_name`, `certificate_id`, `uploaded_at`) VALUES
(4, 'Machine Learning', 'Outcome-Based Education Seminar', 'uploads/certificates/1752585069_MACAPAGAL, JONAS M..pdf', 'humblebeast1218@gmail.com', 'JMCA-solutions', '11', '2025-07-15 21:11:09'),
(5, 'Deep Learning Certification', 'Creating Inclusive Learning Environments', 'uploads/certificates/1752585069_coe.pdf', 'humblebeast1218@gmail.com', 'JMCA-solutions', '11', '2025-07-15 21:11:09'),
(6, 'Supervised Machine Learning', 'Flipped Classroom Implementation', 'uploads/certificates/1752585069_Computer Programmer II Job Description_6.pdf', 'humblebeast1218@gmail.com', 'JMCA-solutions', '11', '2025-07-15 21:11:09'),
(7, 'Arduino Certification', 'Outcome-Based Education Seminar', 'uploads/certificates/1752587043_MACAPAGAL__JONAS_M..pdf', 'humblebeast1218@gmail.com', 'JMCA-solutions', '12', '2025-07-15 21:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `description`, `department`, `created_date`, `status`) VALUES
(3, 'BSCRIM', 'BS Criminology', 'Criminal Justice Department', '2025-07-18 20:58:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `description`, `created_at`, `status`) VALUES
(1, 'CJD', 'Criminal Justice Department', '2025-07-18 18:54:44', 1),
(2, 'AMD', 'Accountancy and Management Department', '2025-07-18 18:55:55', 1),
(4, 'TED', 'Teacher Education Department', '2025-07-18 19:50:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `endusers`
--

CREATE TABLE `endusers` (
  `eu_id` int(255) NOT NULL,
  `photo` text NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 0,
  `role` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `is_protected` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `endusers`
--

INSERT INTO `endusers` (`eu_id`, `photo`, `fullname`, `email`, `password`, `department`, `about`, `date_created`, `status`, `role`, `code`, `is_protected`) VALUES
(10, 'uploads/faculty/68628dd2b2b3f_1000003489.jpg', 'JMCA-solutions', 'humblebeast1218@gmail.com', '$2y$10$HdTmyRbGughFB7mH.QF3suXu8p6YV2/OFAOBrZxya8LS.YpE.KGU6', 'Institute of Computing Studies', '', '2025-06-30', 1, 'Faculty', '68628dd2b2b38', 0),
(11, 'uploads/admin/68628e38985ef_05fb88bd-e3a7-482a-8ed4-f3f480e1f706.jpg', 'Rolando Santiago', 'j.macapagal.cdm@gmail.com', '$2y$10$2tzVXFLFhYKPt1//SKHjz.qD6Q4.BOwFFozqI5nkVXmt3rZjumQfi', 'ICTO', '', '2025-06-30', 1, 'Admin', '68628e38985ea', 1),
(12, 'uploads/faculty/6862ae7455896_ChatGPT Image Apr 1, 2025, 11_38_59 AM.png', 'Michael Mades', 'michael.mades@pnm.edu.ph', '$2y$10$pK8cOnYQ.gyEU87Pc18z6uV8JLhrrv1o0ot48QKdRP9ERYtyPjo5q', 'Institute of Computing Studies', '', '2025-06-30', 1, 'Faculty', '6862ae7455891', 0),
(13, 'uploads/faculty/6862aecbb58a7_ChatGPT Image Mar 31, 2025, 09_54_05 AM.png', 'Aldrich Macapagal', 'aldrich.macapagal@pnm.edu.ph', '$2y$10$sPszSVQK6NaJi5K8HwKr2u/Wi2laQXi3WFDdr2O87A9QmDCLcM7ci', 'Institute of Teacher Education', '', '2025-06-30', 1, 'Faculty', '6862aecbb58a4', 0),
(14, 'uploads/faculty/6862af1cc7a45_ChatGPT Image Apr 1, 2025, 08_36_33 AM.png', 'Marianne Macapagal', 'marianne.macapagal@pnm.edu.ph', '$2y$10$nT7r/0nQFSn5sPkzi.A6OuM5YaHfD8/DJ6hhsq/mSL6RRqJ001r4O', 'Institute of Business Education', '', '2025-06-30', 1, 'Faculty', '6862af1cc7a41', 0),
(17, 'uploads/faculty/687d06f8b714b_81990874_2452936368358262_4011517102484619264_n.jpg', 'Mr JM', 'keneyekissyou@gmail.com', '$2y$10$nDhdNBF/nYDLopKHw0DqM.qBe4WtMP6iVIEqnM6f2tVE0uFGb.uSm', 'Criminal Justice Department', '', '2025-07-20', 1, 'Faculty', '687d06f8b7147', 0),
(18, 'uploads/faculty/687d073e18d41_aad42b9e-6e15-478a-8789-c7cbb4ac508c.jpg', 'Mr Aldrich', 'mr.aldrich@pnm.edu.ph', '$2y$10$0J2JvZNis8YsPiSTNwJ5oeuZRbhAEkR13ONua0iek8fsHeRa8mI4q', 'Criminal Justice Department', '', '2025-07-20', 1, 'Faculty', '687d073e18d3b', 0),
(21, 'uploads/faculty/688439d4b0e9b_yzcr6bw.png', 'asdf', 'asdfasdf@asdf', '$2y$10$2BASm5P0TZsivK74Ac76keFLCTH3zY57sr5p.uEhYs4aIweKRqSOq', 'Accountancy and Management Department', '', '2025-07-26', 0, 'Faculty', '688439d4b0e96', 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluationsched`
--

CREATE TABLE `evaluationsched` (
  `ev_id` int(255) NOT NULL,
  `ev_code` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `uploadBy` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluationsched`
--

INSERT INTO `evaluationsched` (`ev_id`, `ev_code`, `department`, `startDate`, `endDate`, `uploadBy`, `status`) VALUES
(3, '9c99f93074e9', 'Criminal Justice Department', '2025-07-26', '2025-08-02', 'j.macapagal.cdm@gmail.com', 2),
(4, 'df079ce8ee5a', 'Accountancy and Management Department', '2025-07-26', '2025-08-02', 'j.macapagal.cdm@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_evaluations`
--

CREATE TABLE `faculty_evaluations` (
  `id` int(11) NOT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `faculty_token` varchar(255) DEFAULT NULL,
  `academic_avg` decimal(4,2) DEFAULT NULL,
  `core_values_avg` decimal(4,2) DEFAULT NULL,
  `overall_score` decimal(4,2) DEFAULT NULL,
  `feedback_strengths` text DEFAULT NULL,
  `feedback_improvements` text DEFAULT NULL,
  `feedback_comments` text DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp(),
  `ai_recommendation` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_evaluations`
--

INSERT INTO `faculty_evaluations` (`id`, `student_email`, `faculty_token`, `academic_avg`, `core_values_avg`, `overall_score`, `feedback_strengths`, `feedback_improvements`, `feedback_comments`, `submitted_at`, `ai_recommendation`, `status`) VALUES
(26, 'jonas.macapagal@pnm.edu.ph', '68628dd2b2b38', 4.81, 4.63, 5.00, 'He\'s good at computer programming.', 'He needs some patience. hahaha', 'Nothing, stay chill, sir.', '2025-07-08 19:13:09', 'Outcome-Based Education Seminar', 1),
(27, 'jonas.macapagal@pnm.edu.ph', '6862aecbb58a4', 4.56, 4.63, 5.00, 'He\'s so cute. ', 'Nothing', 'Smile ka lang palagi, mas nakakapogi yan.', '2025-07-08 19:15:15', 'Blended Learning Design', 1),
(28, 'jonas.macapagal@pnm.edu.ph', '6862af1cc7a41', 5.00, 5.00, 5.00, 'Wala naman po, magaling din si maam magturo.', 'Nothings', 'Ang baet nio po maam.', '2025-07-08 19:16:46', 'Flipped Classroom Implementation', 1),
(29, 'castillo@pnm.edu.ph', '68628dd2b2b38', 5.00, 5.00, 5.00, 'Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling', 'Wala, magaling talaga si sir.', 'Ituro mo na next sem yung AI sir.', '2025-07-08 19:20:49', 'Flipped Classroom Implementation', 1),
(30, 'castillo@pnm.edu.ph', '6862aecbb58a4', 5.00, 5.00, 5.00, 'Palo din magprogram to si sir. sobrang husay din mana sa daddy nya', 'Siguro iwasan lang ni sir tingnan yung mga kaklase kong babae, kinikilig e', 'wala naman, ', '2025-07-08 19:22:32', 'Flipped Classroom Implementation', 1),
(31, 'castillo@pnm.edu.ph', '6862af1cc7a41', 3.75, 3.50, 4.00, 'Okay din si maam, magaling sa business logic', 'sana bawasan ni maam yung pageenglish, nadugo na ilong ko.', 'wala naman', '2025-07-08 19:24:10', 'Instructional Leadership Training', 1),
(32, 'student1@pnm.edu.ph', '68628dd2b2b38', 4.88, 4.44, 5.00, 'Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya', 'wala, sana mas mahaba pa yung time ni sir samin, bitin e', 'wala naman, AI naaaaa.', '2025-07-08 19:27:11', 'Creating Inclusive Learning Environments', 1),
(33, 'student1@pnm.edu.ph', '6862aecbb58a4', 4.69, 4.50, 5.00, 'Back end ang strength ni sir, wala akong tanong para doon, magaling din talaga.', 'yung Frontend development mo sir. hahahahahahaha.', 'wala naman', '2025-07-08 19:28:36', 'Outcome-Based Education Seminar', 1),
(34, 'student1@pnm.edu.ph', '6862af1cc7a41', 4.44, 4.56, 5.00, 'May magandang vission si maam para sa mga students nya', 'wala naman maam, baet nio po', 'nothing', '2025-07-08 19:29:49', 'Time Management for Educators', 1),
(35, 'student6@pnm.edu.ph', '68628dd2b2b38', 4.69, 4.63, 5.00, 'Idol ko si sir. walang duda. apakahusay,', 'sirrrr, request ka ng dagdagan yung time mo samin', 'wala naman. bitin lang yung oras', '2025-07-08 19:33:38', 'Outcome-Based Education Seminar', 1),
(36, 'student6@pnm.edu.ph', '6862aecbb58a4', 4.50, 4.13, 4.00, 'Magaling si sir, pagdating sa development ng mobile application gustong gusto ko yun.', 'Practice ka pa sir magfrontend development hahahaha', 'wala naman, magaling din kase talaga si sir', '2025-07-08 19:35:19', 'Blended Learning Design', 1),
(37, 'student12@pnm.edu.ph', '68628dd2b2b38', 4.50, 4.31, 5.00, 'He\'s good in AI', 'Nothing', 'Nothing', '2025-07-23 12:04:48', 'Blended Learning Design', 1),
(38, 'student12@pnm.edu.ph', '6862ae7455891', 4.63, 4.63, 5.00, 'aray koooo', 'aray koooo', 'aray koooo', '2025-07-26 22:44:16', 'Outcome-Based Education Seminar', 1),
(39, 'student12@pnm.edu.ph', '6862aecbb58a4', 4.25, 4.50, 5.00, '', '', '', '2025-07-26 23:14:39', 'Time Management for Educators', 1),
(40, 'student12@pnm.edu.ph', '6862af1cc7a41', 4.63, 4.50, 5.00, 'Please dont ask me what am i thinkin', 'its about you ', 'what am gonna say to youuu\r\n', '2025-07-26 23:16:45', 'Creating Inclusive Learning Environments', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_evaluation_summary`
--

CREATE TABLE `faculty_evaluation_summary` (
  `id` int(11) NOT NULL,
  `faculty_id` varchar(100) DEFAULT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `faculty_email` varchar(255) DEFAULT NULL,
  `faculty_department` varchar(255) DEFAULT NULL,
  `academic_rating` decimal(3,2) DEFAULT NULL,
  `core_values_rating` decimal(3,2) DEFAULT NULL,
  `overall_evaluation` decimal(3,2) DEFAULT NULL,
  `overall_rating` decimal(3,2) DEFAULT NULL,
  `ai_recommendations` text DEFAULT NULL,
  `feedback_strengths` text DEFAULT NULL,
  `feedback_improvements` text DEFAULT NULL,
  `feedback_comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_evaluation_summary`
--

INSERT INTO `faculty_evaluation_summary` (`id`, `faculty_id`, `faculty_name`, `faculty_email`, `faculty_department`, `academic_rating`, `core_values_rating`, `overall_evaluation`, `overall_rating`, `ai_recommendations`, `feedback_strengths`, `feedback_improvements`, `feedback_comments`, `created_at`, `status`) VALUES
(5, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.83, 4.92, 5.00, 4.92, 'Outcome-Based Education Seminar, Research Writing and Publication, Advanced Curriculum Design', 'He\'s My Idol, Keep it up sir. | Lupit mo sirrrrr. Kung pwede lang maging student mo ulit. hehehe | Abay napakagaling naman ng bossing namin na yan | Sir jonas was really great in computer programming', 'Nothing | Wala na. All goods si sir. | wala, masyado syang magaling para sa mga gawaing ito | Nothing, He\'s already good', 'Keep on solo leveling sir | Continue mo lang sir yung mga ginagawa mong ginagawa mong diskarte sa pagtuturo. napakabisa po. | kay lupit mo bossing ng mundo okay na yan. | Also, He\'s so cute', '2025-01-02 09:39:02', 0),
(10, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 4.12, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2024-07-08 11:41:21', 0),
(11, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 3.84, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2024-01-08 11:43:22', 1),
(12, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 4.56, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2023-07-08 11:46:34', 1),
(15, '6862af1cc7a41', 'Marianne Macapagal', 'marianne.macapagal@pnm.edu.ph', 'Institute of Business Education', 4.46, 4.39, 4.75, 4.53, 'Creating Inclusive Learning Environments, Time Management for Educators, Instructional Leadership Training, Flipped Classroom Implementation', 'Please dont ask me what am i thinkin | May magandang vission si maam para sa mga students nya | Okay din si maam, magaling sa business logic | Wala naman po, magaling din si maam magturo.', 'its about you | wala naman maam, baet nio po | sana bawasan ni maam yung pageenglish, nadugo na ilong ko. | Nothings', 'what am gonna say to youuu | nothing | wala naman | Ang baet nio po maam.', '2025-07-26 15:57:25', 0),
(16, '6862aecbb58a4', 'Aldrich Macapagal', 'aldrich.macapagal@pnm.edu.ph', 'Institute of Teacher Education', 4.60, 4.55, 4.80, 4.65, 'Time Management for Educators, Blended Learning Design, Outcome-Based Education Seminar, Flipped Classroom Implementation', 'Magaling si sir, pagdating sa development ng mobile application gustong gusto ko yun. | Back end ang strength ni sir, wala akong tanong para doon, magaling din talaga. | Palo din magprogram to si sir. sobrang husay din mana sa daddy nya | He\'s so cute.', 'Practice ka pa sir magfrontend development hahahaha | yung Frontend development mo sir. hahahahahahaha. | Siguro iwasan lang ni sir tingnan yung mga kaklase kong babae, kinikilig e | Nothing', 'wala naman, magaling din kase talaga si sir | wala naman | wala naman, | Smile ka lang palagi, mas nakakapogi yan.', '2025-07-26 15:57:55', 0),
(17, '6862ae7455891', 'Michael Mades', 'michael.mades@pnm.edu.ph', 'Institute of Computing Studies', 4.63, 4.63, 5.00, 4.75, 'Outcome-Based Education Seminar', 'aray koooo', 'aray koooo', 'aray koooo', '2025-07-26 15:58:14', 0),
(18, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.78, 4.60, 5.00, 4.79, 'Blended Learning Design, Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'He\'s good in AI | Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'Nothing | sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'Nothing | wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2025-07-26 15:58:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(50) NOT NULL,
  `code` varchar(50) DEFAULT '0',
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resetpassword`
--

INSERT INTO `resetpassword` (`id`, `code`, `username`) VALUES
(18, '16877e594d8a6b', 'j.macapagal.cdm@gmail.com'),
(22, '16881c7f5f12a7', 'fishcakejmm18@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `si_id` int(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_section` varchar(255) NOT NULL,
  `student_year` varchar(255) NOT NULL,
  `student_course` varchar(255) NOT NULL,
  `student_dep` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL,
  `evaluationAccess` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`si_id`, `student_email`, `student_no`, `student_name`, `student_section`, `student_year`, `student_course`, `student_dep`, `status`, `role`, `evaluationAccess`) VALUES
(1, 'jonas.macapagal@pnm.edu.ph', '17-00234', 'Clyde Aldrich', '4A', '4th Year', '', '', 1, 'Student', 0),
(3, 'aaron@pnm.edu.ph', '21-0001', 'Aaron G', '4G', '4th Year', '', '', 1, 'Student', 0),
(5, 'castillo@pnm.edu.ph', '21-0002', 'Louie', '4C', '4th Year', '', '', 1, 'Student', 0),
(11, 'student1@pnm.edu.ph', '21-0003', 'Charles', '3B', '3rd Year', '', '', 1, 'Student', 0),
(12, 'student2@pnm.edu.ph', '21-0004', 'Heart', '4A', '4th Year', '', '', 1, 'Student', 0),
(13, 'student3@pnm.edu.ph', '21-0005', 'Joey', '3A', '3rd Year', '', '', 1, 'Student', 0),
(14, 'student4@pnm.edu.ph', '21-0006', 'Vios', '4A', '4th Year', '', '', 1, 'Student', 0),
(16, 'student6@pnm.edu.ph', '21-0008', 'Ceejay', '3D', '3rd Year', '', '', 1, 'Student', 0),
(17, 'fishcakejmm18@gmail.com', '17-00235', 'Jonas Macapagal', '4a', '4th Year', '', '', 1, 'Student', 0),
(19, 'student7@pnm.edu.ph', '21-0009', 'Vinzy', '3B', '3rd Year', 'BSHM', 'Hospitality and Institutional Management', 1, 'Student', 0),
(20, 'student8@pnm.edu.ph', '21-0010', 'Jemuel', '4A', '4th Year', 'BSCS', 'Computer Studies Department', 1, 'Student', 0),
(21, 'student9@pnm.edu.ph', '21-0011', 'Ryan', '3A', '3rd Year', 'BSBA', 'Accountancy and Management Department', 1, 'Student', 1),
(22, 'student10@pnm.edu.ph', '21-0012', 'Anne', '4A', '4th Year', 'BSHM', 'Hospitality and Institutional Management', 1, 'Student', 0),
(23, 'student11@pnm.edu.ph', '21-0013', 'Cherilyn', '4A', '4th Year', 'BSRTECH', 'Allied Science Department', 2, 'Student', 0),
(24, 'student12@pnm.edu.ph', '21-0014', 'JohnPaul', '3D', '3rd Year', 'BSA', 'Accountancy and Management Department', 1, 'Student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `endusers`
--
ALTER TABLE `endusers`
  ADD PRIMARY KEY (`eu_id`);

--
-- Indexes for table `evaluationsched`
--
ALTER TABLE `evaluationsched`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `faculty_evaluations`
--
ALTER TABLE `faculty_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_evaluation_summary`
--
ALTER TABLE `faculty_evaluation_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`si_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `endusers`
--
ALTER TABLE `endusers`
  MODIFY `eu_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `evaluationsched`
--
ALTER TABLE `evaluationsched`
  MODIFY `ev_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty_evaluations`
--
ALTER TABLE `faculty_evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `faculty_evaluation_summary`
--
ALTER TABLE `faculty_evaluation_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `si_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
