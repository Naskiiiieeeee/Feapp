-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 10:39 AM
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
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `endusers`
--

INSERT INTO `endusers` (`eu_id`, `photo`, `fullname`, `email`, `password`, `department`, `about`, `date_created`, `status`, `role`, `code`) VALUES
(10, 'uploads/faculty/68628dd2b2b3f_1000003489.jpg', 'JMCA-solutions', 'humblebeast1218@gmail.com', '$2y$10$kgNWgn9TFwjDODGMuPGBSuI/dvihScCtglrEpYWiwBgfG5wUifzGG', 'Institute of Computing Studies', '', '2025-06-30', 1, 'Faculty', '68628dd2b2b38'),
(11, 'uploads/admin/68628e38985ef_05fb88bd-e3a7-482a-8ed4-f3f480e1f706.jpg', 'Rolando Santiago', 'j.macapagal.cdm@gmail.com', '$2y$10$Lyc4.00xywZFkgQ6T/0fqOwTbG8yK7YugFrsTJtx6B8x2mF2U7XLu', 'ICTO', '', '2025-06-30', 1, 'Admin', '68628e38985ea'),
(12, 'uploads/faculty/6862ae7455896_ChatGPT Image Apr 1, 2025, 11_38_59 AM.png', 'Michael Mades', 'michael.mades@pnm.edu.ph', '$2y$10$pK8cOnYQ.gyEU87Pc18z6uV8JLhrrv1o0ot48QKdRP9ERYtyPjo5q', 'Institute of Computing Studies', '', '2025-06-30', 2, 'Faculty', '6862ae7455891'),
(13, 'uploads/faculty/6862aecbb58a7_ChatGPT Image Mar 31, 2025, 09_54_05 AM.png', 'Aldrich Macapagal', 'aldrich.macapagal@pnm.edu.ph', '$2y$10$sPszSVQK6NaJi5K8HwKr2u/Wi2laQXi3WFDdr2O87A9QmDCLcM7ci', 'Institute of Teacher Education', '', '2025-06-30', 1, 'Faculty', '6862aecbb58a4'),
(14, 'uploads/faculty/6862af1cc7a45_ChatGPT Image Apr 1, 2025, 08_36_33 AM.png', 'Marianne Macapagal', 'marianne.macapagal@pnm.edu.ph', '$2y$10$nT7r/0nQFSn5sPkzi.A6OuM5YaHfD8/DJ6hhsq/mSL6RRqJ001r4O', 'Institute of Business Education', '', '2025-06-30', 1, 'Faculty', '6862af1cc7a41');

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
  `ai_recommendation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_evaluations`
--

INSERT INTO `faculty_evaluations` (`id`, `student_email`, `faculty_token`, `academic_avg`, `core_values_avg`, `overall_score`, `feedback_strengths`, `feedback_improvements`, `feedback_comments`, `submitted_at`, `ai_recommendation`) VALUES
(26, 'jonas.macapagal@pnm.edu.ph', '68628dd2b2b38', 4.81, 4.63, 5.00, 'He\'s good at computer programming.', 'He needs some patience. hahaha', 'Nothing, stay chill, sir.', '2025-07-08 19:13:09', 'Outcome-Based Education Seminar'),
(27, 'jonas.macapagal@pnm.edu.ph', '6862aecbb58a4', 4.56, 4.63, 5.00, 'He\'s so cute. ', 'Nothing', 'Smile ka lang palagi, mas nakakapogi yan.', '2025-07-08 19:15:15', 'Blended Learning Design'),
(28, 'jonas.macapagal@pnm.edu.ph', '6862af1cc7a41', 5.00, 5.00, 5.00, 'Wala naman po, magaling din si maam magturo.', 'Nothings', 'Ang baet nio po maam.', '2025-07-08 19:16:46', 'Flipped Classroom Implementation'),
(29, 'castillo@pnm.edu.ph', '68628dd2b2b38', 5.00, 5.00, 5.00, 'Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling', 'Wala, magaling talaga si sir.', 'Ituro mo na next sem yung AI sir.', '2025-07-08 19:20:49', 'Flipped Classroom Implementation'),
(30, 'castillo@pnm.edu.ph', '6862aecbb58a4', 5.00, 5.00, 5.00, 'Palo din magprogram to si sir. sobrang husay din mana sa daddy nya', 'Siguro iwasan lang ni sir tingnan yung mga kaklase kong babae, kinikilig e', 'wala naman, ', '2025-07-08 19:22:32', 'Flipped Classroom Implementation'),
(31, 'castillo@pnm.edu.ph', '6862af1cc7a41', 3.75, 3.50, 4.00, 'Okay din si maam, magaling sa business logic', 'sana bawasan ni maam yung pageenglish, nadugo na ilong ko.', 'wala naman', '2025-07-08 19:24:10', 'Instructional Leadership Training'),
(32, 'student1@pnm.edu.ph', '68628dd2b2b38', 4.88, 4.44, 5.00, 'Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya', 'wala, sana mas mahaba pa yung time ni sir samin, bitin e', 'wala naman, AI naaaaa.', '2025-07-08 19:27:11', 'Creating Inclusive Learning Environments'),
(33, 'student1@pnm.edu.ph', '6862aecbb58a4', 4.69, 4.50, 5.00, 'Back end ang strength ni sir, wala akong tanong para doon, magaling din talaga.', 'yung Frontend development mo sir. hahahahahahaha.', 'wala naman', '2025-07-08 19:28:36', 'Outcome-Based Education Seminar'),
(34, 'student1@pnm.edu.ph', '6862af1cc7a41', 4.44, 4.56, 5.00, 'May magandang vission si maam para sa mga students nya', 'wala naman maam, baet nio po', 'nothing', '2025-07-08 19:29:49', 'Time Management for Educators'),
(35, 'student6@pnm.edu.ph', '68628dd2b2b38', 4.69, 4.63, 5.00, 'Idol ko si sir. walang duda. apakahusay,', 'sirrrr, request ka ng dagdagan yung time mo samin', 'wala naman. bitin lang yung oras', '2025-07-08 19:33:38', 'Outcome-Based Education Seminar'),
(36, 'student6@pnm.edu.ph', '6862aecbb58a4', 4.50, 4.13, 4.00, 'Magaling si sir, pagdating sa development ng mobile application gustong gusto ko yun.', 'Practice ka pa sir magfrontend development hahahaha', 'wala naman, magaling din kase talaga si sir', '2025-07-08 19:35:19', 'Blended Learning Design');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_evaluation_summary`
--

INSERT INTO `faculty_evaluation_summary` (`id`, `faculty_id`, `faculty_name`, `faculty_email`, `faculty_department`, `academic_rating`, `core_values_rating`, `overall_evaluation`, `overall_rating`, `ai_recommendations`, `feedback_strengths`, `feedback_improvements`, `feedback_comments`, `created_at`) VALUES
(5, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.83, 4.92, 5.00, 4.92, 'Outcome-Based Education Seminar, Research Writing and Publication, Advanced Curriculum Design', 'He\'s My Idol, Keep it up sir. | Lupit mo sirrrrr. Kung pwede lang maging student mo ulit. hehehe | Abay napakagaling naman ng bossing namin na yan | Sir jonas was really great in computer programming', 'Nothing | Wala na. All goods si sir. | wala, masyado syang magaling para sa mga gawaing ito | Nothing, He\'s already good', 'Keep on solo leveling sir | Continue mo lang sir yung mga ginagawa mong ginagawa mong diskarte sa pagtuturo. napakabisa po. | kay lupit mo bossing ng mundo okay na yan. | Also, He\'s so cute', '2025-01-02 09:39:02'),
(8, '6862af1cc7a41', 'Marianne Macapagal', 'marianne.macapagal@pnm.edu.ph', 'Institute of Business Education', 3.00, 3.00, 3.50, 3.17, 'Improving Communication Skills, Research Writing and Publication', 'TEst | Omyyyy husay', 'TEst | Waley just stay chill', 'TEst | Keep it up mamski', '2025-07-08 10:07:02'),
(9, '6862aecbb58a4', 'Aldrich Macapagal', 'aldrich.macapagal@pnm.edu.ph', 'Institute of Teacher Education', 4.22, 4.31, 4.50, 4.34, 'Time Management for Educators, Instructional Leadership Training', 'Sir Aldrich knows a lot in computer programming, especially in web development | Napakagaling din ni sir sa programming, manang mana sa ama nya.', 'I guess nothing. He knows already what he needs to do. | wala na', 'Smile lang palagi nakakaganda ng lalo ng araw. | super cute mo bossing', '2025-07-08 10:27:21'),
(10, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 4.12, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2024-07-08 11:41:21'),
(11, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 3.84, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2024-01-08 11:43:22'),
(12, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 4.56, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2023-07-08 11:46:34'),
(13, '68628dd2b2b38', 'JMCA-solutions', 'humblebeast1218@gmail.com', 'Institute of Computing Studies', 4.85, 4.68, 5.00, 4.84, 'Outcome-Based Education Seminar, Creating Inclusive Learning Environments, Flipped Classroom Implementation', 'Idol ko si sir. walang duda. apakahusay, | Idol to si sir, alam na alam nya kung ano yung mga tinuturo nya, kahit saang programming language nakakasagot sya at kaya nyang idiscuss lahat ng nakaalign sa tinuturo nya | Halimaw to sa programming si sir. Wala akong masasabing iba kundi yun lang. Magaling | He\'s good at computer programming.', 'sirrrr, request ka ng dagdagan yung time mo samin | wala, sana mas mahaba pa yung time ni sir samin, bitin e | Wala, magaling talaga si sir. | He needs some patience. hahaha', 'wala naman. bitin lang yung oras | wala naman, AI naaaaa. | Ituro mo na next sem yung AI sir. | Nothing, stay chill, sir.', '2025-07-08 11:47:57');

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
  `status` int(2) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`si_id`, `student_email`, `student_no`, `student_name`, `student_section`, `student_year`, `status`, `role`) VALUES
(1, 'jonas.macapagal@pnm.edu.ph', '17-00234', 'Clyde Aldrich', '4A', '4th Year', 1, 'Student'),
(3, 'aaron@pnm.edu.ph', '21-0001', 'Aaron G', '4G', '4th Year', 1, 'Student'),
(5, 'castillo@pnm.edu.ph', '21-0002', 'Louie', '4C', '4th Year', 1, 'Student'),
(11, 'student1@pnm.edu.ph', '21-0003', 'Charles', '3B', '3rd Year', 1, 'Student'),
(12, 'student2@pnm.edu.ph', '21-0004', 'Heart', '4A', '4th Year', 0, 'Student'),
(13, 'student3@pnm.edu.ph', '21-0005', 'Joey', '3A', '3rd Year', 0, 'Student'),
(14, 'student4@pnm.edu.ph', '21-0006', 'Vios', '4A', '4th Year', 0, 'Student'),
(16, 'student6@pnm.edu.ph', '21-0008', 'Ceejay', '3D', '3rd Year', 1, 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `endusers`
--
ALTER TABLE `endusers`
  ADD PRIMARY KEY (`eu_id`);

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
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`si_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `endusers`
--
ALTER TABLE `endusers`
  MODIFY `eu_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faculty_evaluations`
--
ALTER TABLE `faculty_evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `faculty_evaluation_summary`
--
ALTER TABLE `faculty_evaluation_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `si_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
