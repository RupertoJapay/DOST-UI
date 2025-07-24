-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 02:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_users`
--

CREATE TABLE `hr_users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr_users`
--

INSERT INTO `hr_users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Don Kyle', 'kyle@gmail.com', '$2y$10$mC7isplNYD8uJ/aUITLize68EEjp3wTnJ.LuS5IfL0w29V.TiltTC'),
(2, 'jireh', 'valunarie2102@gmail.com', '$2y$10$SrhJLAUF/xTIZbUXt.Y9TuHR/xJPFeyAGm93hy6mb3xR3tZrPx0ve'),
(3, 'Rup', 'japay.rupertoiii@gmail.com', '$2y$10$y1ZDf78X.rgDx2rWfd20ZuzypgONXH73Kv4GRIcQqRrUv1oRd0Ueq'),
(4, 'Ruel Wenceslao II', 'rcwenceslao2114@gmail.com', '$2y$10$ZMYalMyM1juFFBNGOfakWemV.9yEHloj.q1HB8hYRMp0yd/WIRr3G'),
(5, '', '', '$2y$10$x5oj9bDxB/R36hd2dKSsweDRYl8oEydQN6sCAXBtyn.wEJMPtCj.C'),
(6, 'John Doe', 'doe@gmail.com', '$2y$10$Zytr8lHZ8SF1nQ5dsMQYFeszVnkt/4tgvv0sPfNw.dak/etLwHQWS'),
(7, 'Human Resource', 'hr@region10.dost.gov.ph', '$2y$10$uzZrcsPej9/LohP4tjc9kO5rutf3sTTJKQBKPVMaGkLYbTyt/mrg2');

-- --------------------------------------------------------

--
-- Table structure for table `impact_assessments`
--

CREATE TABLE `impact_assessments` (
  `id` int(11) NOT NULL,
  `training_entry_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `impact_assessments`
--

INSERT INTO `impact_assessments` (`id`, `training_entry_id`, `rating`, `feedback`, `submitted_at`) VALUES
(18, 50, 1, 'nice', '2025-07-07 01:19:33'),
(20, 60, 5, 'qweettiy andsudh', '2025-07-07 06:36:21'),
(21, 61, 5, 'nice', '2025-07-11 07:38:14'),
(22, 66, 3, 'samok', '2025-07-11 07:44:10'),
(23, 65, 1, 'PIKYIW', '2025-07-15 01:13:54'),
(24, 70, 5, 'qwerty', '2025-07-15 05:20:07'),
(25, 84, 1, 'dcsdc', '2025-07-15 05:57:10'),
(26, 84, 1, 'dcsdc', '2025-07-15 06:04:38'),
(27, 84, 1, 'dcsdc', '2025-07-15 06:04:44'),
(28, 65, 1, 'sdsc', '2025-07-15 06:05:03'),
(29, 65, 1, 'sdsc', '2025-07-15 06:05:27'),
(30, 65, 1, 'sdsc', '2025-07-15 06:08:38'),
(31, 65, 1, 'sdsc', '2025-07-15 06:12:09'),
(32, 65, 1, 'sdsc', '2025-07-15 06:13:27'),
(33, 65, 1, 'sdsc', '2025-07-15 06:13:53'),
(34, 65, 1, 'sdsc', '2025-07-15 06:14:19'),
(35, 65, 1, 'sdsc', '2025-07-15 06:19:07'),
(36, 65, 1, 'sdsc', '2025-07-15 06:19:20'),
(37, 65, 1, 'sdsc', '2025-07-15 06:19:31'),
(38, 65, 1, 'sdsc', '2025-07-15 06:22:28'),
(39, 65, 1, 'sdsc', '2025-07-15 06:23:10'),
(40, 65, 1, 'sdsc', '2025-07-15 06:23:22'),
(41, 65, 1, 'sdsc', '2025-07-15 06:23:41'),
(42, 65, 1, 'sdsc', '2025-07-15 06:23:48'),
(43, 65, 1, 'sdsc', '2025-07-15 06:25:24'),
(44, 65, 3, 'bhckkjhsdsi', '2025-07-15 07:25:11'),
(45, 65, 2, '233rdfds', '2025-07-15 08:47:11'),
(46, 65, 2, 'fefeferrf', '2025-07-15 08:48:35'),
(47, 65, 2, 'fefeferrf', '2025-07-15 08:49:21'),
(48, 65, 2, 'fefeferrf', '2025-07-15 08:49:32'),
(49, 65, 2, 'fefeferrf', '2025-07-15 08:49:45'),
(50, 65, 1, '3', '2025-07-15 08:51:42'),
(51, 65, 1, '1', '2025-07-15 09:10:10'),
(52, 88, 5, 'Tell me, you fool. If I continue to regress, will I get to ever meet you again?', '2025-07-15 13:35:49'),
(53, 88, 1, '1', '2025-07-16 00:42:22'),
(54, 89, 4, 'qwerty', '2025-07-16 01:20:44'),
(55, 92, 5, 'Very useful', '2025-07-16 01:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `supporting_docs`
--

CREATE TABLE `supporting_docs` (
  `id` int(11) NOT NULL,
  `training_entry_id` int(11) NOT NULL,
  `certificates` varchar(255) NOT NULL,
  `certificate_path` varchar(255) NOT NULL,
  `entry_plan` varchar(255) NOT NULL,
  `plan_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supporting_docs`
--

INSERT INTO `supporting_docs` (`id`, `training_entry_id`, `certificates`, `certificate_path`, `entry_plan`, `plan_path`, `uploaded_at`) VALUES
(31, 50, 'cutMe_systemDesign (editable).png', 'uploads/certificates/Girlie Grace Cuarteros.jpeg', 'cutME_UI_model.png', 'uploads/686b1e86bb715_cutME_UI_model.png', '2025-07-07 01:10:30'),
(40, 59, 'BRN3C2AF49C80C7_20160115_084321_071406.pdf', 'uploads/686b6726502af_BRN3C2AF49C80C7_20160115_084321_071406.pdf', '2025 SHL PROPOSED TRAINING PLAN.pdf', 'uploads/686b6726502bf_2025 SHL PROPOSED TRAINING PLAN.pdf', '2025-07-07 06:20:22'),
(41, 60, 'ap09_frq_world_history.pdf', 'uploads/686b6a705d6c4_ap09_frq_world_history.pdf', 'comment_world_history_17773 2002.pdf', 'uploads/686b6a705d6d7_comment_world_history_17773 2002.pdf', '2025-07-07 06:34:24'),
(42, 61, 'cutME_UI_model.png', 'uploads/686b6af849c65_cutME_UI_model.png', 'cutME_UI_model.png', 'uploads/686b6af849c7a_cutME_UI_model.png', '2025-07-07 06:36:40'),
(43, 62, 'OK-DEPARTMENT_OF_SCIENCE_AND_TECHNOLOGY_JAPAY-III (1).docx', 'uploads/686b731deb142_OK-DEPARTMENT_OF_SCIENCE_AND_TECHNOLOGY_JAPAY-III (1).docx', 'AP Macroeconomics 2016 Free-Response Questions.pdf', 'uploads/686b731deb155_AP Macroeconomics 2016 Free-Response Questions.pdf', '2025-07-07 07:11:25'),
(44, 63, 'OK-DEPARTMENT_OF_SCIENCE_AND_TECHNOLOGY_JAPAY-III (1).docx', 'uploads/686b7323da25e_OK-DEPARTMENT_OF_SCIENCE_AND_TECHNOLOGY_JAPAY-III (1).docx', 'AP Macroeconomics 2016 Free-Response Questions.pdf', 'uploads/686b7323da275_AP Macroeconomics 2016 Free-Response Questions.pdf', '2025-07-07 07:11:31'),
(45, 64, 'OK-DEPARTMENT_OF_SCIENCE_AND_TECHNOLOGY_JAPAY-III (1).docx', 'uploads/686b7333aae90_OK-DEPARTMENT_OF_SCIENCE_AND_TECHNOLOGY_JAPAY-III (1).docx', 'AP Macroeconomics 2016 Free-Response Questions.pdf', 'uploads/686b7333aaea8_AP Macroeconomics 2016 Free-Response Questions.pdf', '2025-07-07 07:11:47'),
(46, 65, 'Screenshot (12).png', 'uploads/686b741e99905_Screenshot (12).png', 'Screenshot (26).png', 'uploads/686b741e99916_Screenshot (26).png', '2025-07-07 07:15:42'),
(47, 66, 'Screenshot (12).png', 'uploads/686b742df0a05_Screenshot (12).png', 'Screenshot (26).png', 'uploads/686b742df0a15_Screenshot (26).png', '2025-07-07 07:15:58'),
(49, 68, 'Girlie Grace Cuarteros.jpeg', 'uploads/6874c54a556c7_Girlie Grace Cuarteros.jpeg', 'u.png', 'uploads/6874c54a556d7_u.png', '2025-07-14 08:52:26'),
(50, 69, 'AP Macroeconomics 2019 Free-Response Questions_ Set 2.pdf', 'uploads/6875b5eac6d33_AP Macroeconomics 2019 Free-Response Questions_ Set 2.pdf', 'AP World History 2017 Free-Response Questions.pdf', 'uploads/6875b5eac6d43_AP World History 2017 Free-Response Questions.pdf', '2025-07-15 01:59:06'),
(51, 70, 'ap03_comment_micro_27917.pdf', 'uploads/6875bc1f7f0e1_ap03_comment_micro_27917.pdf', 'ap07_microeconomics_operational_q1.pdf', 'uploads/6875bc1f7f0f5_ap07_microeconomics_operational_q1.pdf', '2025-07-15 02:25:35'),
(52, 71, 'AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', 'uploads/6875be093600b_AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', '2002 AP Macroeconomics Free-Response Questions Form B.pdf', 'uploads/6875be0936018_2002 AP Macroeconomics Free-Response Questions Form B.pdf', '2025-07-15 02:33:45'),
(53, 72, 'AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', 'uploads/6875be1298150_AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', '2002 AP Macroeconomics Free-Response Questions Form B.pdf', 'uploads/6875be129815e_2002 AP Macroeconomics Free-Response Questions Form B.pdf', '2025-07-15 02:33:54'),
(54, 73, 'AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', 'uploads/6875be156beaf_AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', '2002 AP Macroeconomics Free-Response Questions Form B.pdf', 'uploads/6875be156bebe_2002 AP Macroeconomics Free-Response Questions Form B.pdf', '2025-07-15 02:33:57'),
(55, 74, 'AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', 'uploads/6875be20044d9_AP Macroeconomics 2021 Free-Response Questions_ Set 2.pdf', '2002 AP Macroeconomics Free-Response Questions Form B.pdf', 'uploads/6875be20044fa_2002 AP Macroeconomics Free-Response Questions Form B.pdf', '2025-07-15 02:34:08'),
(56, 75, '1999 AP Macroeconomics Questions.pdf', 'uploads/6875c11c5ab13_1999 AP Macroeconomics Questions.pdf', 'AP World History 2019 Free-Response Questions.pdf', 'uploads/6875c11c5ab25_AP World History 2019 Free-Response Questions.pdf', '2025-07-15 02:46:52'),
(57, 76, 'AP World History_ Modern 2021 Free-Response Questions.pdf', 'uploads/6875cd41c9083_AP World History_ Modern 2021 Free-Response Questions.pdf', 'AP Macroeconomics Free-Response Questions.pdf', 'uploads/6875cd41c908e_AP Macroeconomics Free-Response Questions.pdf', '2025-07-15 03:38:41'),
(58, 77, 'AP World History_ Modern 2021 Free-Response Questions.pdf', 'uploads/6875d009f0fa3_AP World History_ Modern 2021 Free-Response Questions.pdf', 'AP Macroeconomics Free-Response Questions.pdf', 'uploads/6875d009f0fad_AP Macroeconomics Free-Response Questions.pdf', '2025-07-15 03:50:33'),
(59, 78, 'AP World History_ Modern 2021 Free-Response Questions.pdf', 'uploads/6875d08d37e33_AP World History_ Modern 2021 Free-Response Questions.pdf', 'AP Macroeconomics Free-Response Questions.pdf', 'uploads/6875d08d37e41_AP Macroeconomics Free-Response Questions.pdf', '2025-07-15 03:52:45'),
(60, 79, 'AP United States History 2022 Free-Response Questions.pdf', 'uploads/6875d0c97c210_AP United States History 2022 Free-Response Questions.pdf', 'AP Macroeconomics 2018 Free-Response Questions.pdf', 'uploads/6875d0c97c21d_AP Macroeconomics 2018 Free-Response Questions.pdf', '2025-07-15 03:53:45'),
(61, 80, 'AP United States History 2022 Free-Response Questions.pdf', 'uploads/6875d1c8708d4_AP United States History 2022 Free-Response Questions.pdf', 'AP Macroeconomics 2018 Free-Response Questions.pdf', 'uploads/6875d1c8708e0_AP Macroeconomics 2018 Free-Response Questions.pdf', '2025-07-15 03:58:00'),
(62, 81, '2001 AP Macroeconomics Commentary.pdf', 'uploads/6875d32817b6c_2001 AP Macroeconomics Commentary.pdf', 'AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', 'uploads/6875d32817b80_AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', '2025-07-15 04:03:52'),
(63, 82, '2001 AP Macroeconomics Commentary.pdf', 'uploads/6875d3a5c7204_2001 AP Macroeconomics Commentary.pdf', 'AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', 'uploads/6875d3a5c720d_AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', '2025-07-15 04:05:57'),
(64, 83, '2001 AP Macroeconomics Commentary.pdf', 'uploads/6875d3c16bd22_2001 AP Macroeconomics Commentary.pdf', 'AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', 'uploads/6875d3c16bd2f_AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', '2025-07-15 04:06:25'),
(65, 84, '2001 AP Macroeconomics Commentary.pdf', 'uploads/6875d3d7e3d45_2001 AP Macroeconomics Commentary.pdf', 'AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', 'uploads/6875d3d7e3d52_AP Human Geography 2019 Free-Response Questions_ Set 1.pdf', '2025-07-15 04:06:47'),
(66, 85, 'CD2506-3170 CARLOS EMILIO F. GAMBOA - MEDICA WONDER PLANTS _20250710_0001.pdf', 'uploads/6875e92427a8a_CD2506-3170 CARLOS EMILIO F. GAMBOA - MEDICA WONDER PLANTS _20250710_0001.pdf', 'Techno-QA.docx-1.pdf', 'uploads/6875e92427a9b_Techno-QA.docx-1.pdf', '2025-07-15 05:37:40'),
(67, 86, 'CD2506-3170 CARLOS EMILIO F. GAMBOA - MEDICA WONDER PLANTS _20250710_0001.pdf', 'uploads/6875ea6895e67_CD2506-3170 CARLOS EMILIO F. GAMBOA - MEDICA WONDER PLANTS _20250710_0001.pdf', 'Techno-QA.docx-1.pdf', 'uploads/6875ea6895e7d_Techno-QA.docx-1.pdf', '2025-07-15 05:43:04'),
(68, 87, 'Screenshot (16).png', 'uploads/6876486c1e044_Screenshot (16).png', 'Screenshot (18).png', 'uploads/6876486c1e052_Screenshot (18).png', '2025-07-15 12:24:12'),
(69, 88, 'download (2).jpg', 'uploads/68765889dfcc4_download (2).jpg', '69d3a55878572ae6f154647bb5cb9c66.jpg', 'uploads/68765889dfcd7_69d3a55878572ae6f154647bb5cb9c66.jpg', '2025-07-15 13:32:57'),
(70, 89, 'ap03_frq_econ_micro_b_23134.pdf', 'uploads/6876fc885da5a_ap03_frq_econ_micro_b_23134.pdf', 'ap07_microecon_formb_q2.pdf', 'uploads/6876fc885da78_ap07_microecon_formb_q2.pdf', '2025-07-16 01:12:40'),
(71, 90, 'AP World History 2019 Free-Response Questions.pdf', 'uploads/6876fce24677f_AP World History 2019 Free-Response Questions.pdf', 'AP World History 2019 Free-Response Questions.pdf', 'uploads/6876fce246799_AP World History 2019 Free-Response Questions.pdf', '2025-07-16 01:14:10'),
(72, 91, 'AP World History 2019 Free-Response Questions.pdf', 'uploads/6876fd44a6994_AP World History 2019 Free-Response Questions.pdf', 'AP World History 2019 Free-Response Questions.pdf', 'uploads/6876fd44a69ae_AP World History 2019 Free-Response Questions.pdf', '2025-07-16 01:15:48'),
(73, 92, '14072025130734.pdf', 'uploads/6876feb711e08_14072025130734.pdf', 'Invitation letter_Engr. Mondero.pdf', 'uploads/6876feb711e21_Invitation letter_Engr. Mondero.pdf', '2025-07-16 01:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `training_entries`
--

CREATE TABLE `training_entries` (
  `id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_email` varchar(255) NOT NULL,
  `staff_type` enum('COS','Permanent') NOT NULL,
  `title` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `hours` int(11) NOT NULL,
  `learning_and_development` varchar(100) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Completed') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `reminder_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_entries`
--

INSERT INTO `training_entries` (`id`, `staff_name`, `staff_email`, `staff_type`, `title`, `role`, `start_date`, `end_date`, `hours`, `learning_and_development`, `institution`, `unique_code`, `status`, `created_at`, `reminder_sent`) VALUES
(50, 'King', 'cuarteros.johnkyle12@gmail.com', 'COS', 'Web development', 'Hacker', '2025-06-13', '0225-07-25', 240, 'OJT', 'USTP', '53BDE98F', 'Completed', '2025-07-07 09:10:30', 1),
(59, 'Ruel Wenceslao', 'wenceslaoruelii@gmail.com', 'COS', 'Test Title', 'Participant', '2025-07-03', '2025-07-04', 14, 'Technical', 'ITDI', 'C7598F4D', 'Pending', '2025-07-07 14:20:22', 1),
(60, 'jireh xaris s. dumindin', 'azunadum20@gmail.com', 'Permanent', 'Software Development', 'participant', '2025-07-07', '2025-07-31', 40, 'Technical', 'Do', 'A706B429', 'Completed', '2025-07-07 14:34:24', 1),
(61, 'John Doe', 'cuarteros.johnkyle12@gmail.com', 'Permanent', 'Database analysis', 'Facilitator', '2025-06-13', '2025-07-25', 240, 'Technical', 'USTP', 'BEF69D80', 'Completed', '2025-07-07 14:36:40', 1),
(62, 'Im Pak Yew', 'Impq@gmail.com', 'COS', 'web dev', 'Participant', '2025-01-07', '2025-06-18', 200, 'Technical', 'you', '14C37D64', 'Pending', '2025-07-07 15:11:25', 1),
(63, 'Im Pak Yew', 'Impq@gmail.com', 'COS', 'web dev', 'Participant', '2025-01-07', '2025-06-18', 200, 'Technical', 'you', '5313B95B', 'Pending', '2025-07-07 15:11:31', 1),
(64, 'Im Pak Yew', 'Impq@gmail.com', 'COS', 'web dev', 'Participant', '2025-01-07', '2025-06-18', 200, 'Technical', 'you', 'FC44E3B4', 'Pending', '2025-07-07 15:11:47', 1),
(65, 'Ruperto Japay', 'japay.rupertoiii@gmail.com', 'COS', 'Web development', 'Participant', '2025-06-16', '2025-07-05', 200, 'Technical', 'USTP yieeee', 'B741DE99', 'Completed', '2025-07-07 15:15:42', 1),
(66, 'Ruperto Japay', 'japay.rupertoiii@gmail.com', 'COS', 'Web development', 'Participant', '2025-06-16', '2025-07-05', 200, 'Technical', 'USTP yieeee', 'BCC5A8E0', 'Completed', '2025-07-07 15:15:57', 1),
(68, 'kylinngs', 'cuarteros.johnkyle12@gmail.com', 'Permanent', 'OJT', 'Facilitator', '2025-07-14', '2025-07-01', 240, 'Technical', 'USAS', 'AB6234CB', 'Pending', '2025-07-14 16:52:26', 1),
(69, 'Japhet Japay', 'rjapay29319@liceo.edu.ph', 'COS', 'How', 'Participant', '2025-07-09', '2025-07-12', 15, 'Managerial', 'Me', 'C9A861A9', 'Pending', '2025-07-15 09:59:06', 1),
(70, 'jireh xaris s. dumindin', 'azunadum20@gmail.com', 'Permanent', 'App Development', 'participant', '2025-07-15', '2025-07-23', 20, 'Technical', 'DOST - X', 'EC50EEC9', 'Completed', '2025-07-15 10:25:35', 1),
(71, 'Japhet Japay', 'japay.rupertoiii@gmail.com', 'Permanent', 'title', 'Speaker', '2025-07-05', '2025-07-06', 16, 'Managerial', 'DOST X', '5F1666D6', 'Pending', '2025-07-15 10:33:45', 1),
(72, 'Japhet Japay', 'japay.rupertoiii@gmail.com', 'Permanent', 'title', 'Speaker', '2025-07-05', '2025-07-06', 16, 'Managerial', 'DOST X', '39B5A3B3', 'Pending', '2025-07-15 10:33:54', 1),
(73, 'Japhet Japay', 'japay.rupertoiii@gmail.com', 'Permanent', 'title', 'Speaker', '2025-07-05', '2025-07-06', 16, 'Managerial', 'DOST X', 'DBADBA86', 'Pending', '2025-07-15 10:33:57', 1),
(74, 'Japhet Japay', 'japay.rupertoiii@gmail.com', 'Permanent', 'title', 'Speaker', '2025-07-05', '2025-07-06', 16, 'Managerial', 'DOST X', '5096C8FC', 'Pending', '2025-07-15 10:34:08', 1),
(75, 'jbj', 'japay.rupertoiii@gmail.com', 'COS', 'mnkbknn', 'Speaker', '2025-07-12', '2025-07-13', 8, 'Managerial', 'hjbbb', 'D0D4B2CC', 'Pending', '2025-07-15 10:46:52', 1),
(76, 'Ruperto Japay', 'rjapay29319@liceo.edu.ph', 'COS', 'wsxdxdx', 'Participant', '2025-07-04', '2025-07-11', 20, 'App Dev', 'You', 'CC7E2CD4', 'Pending', '2025-07-15 11:38:41', 1),
(77, 'Ruperto Japay', 'rjapay29319@liceo.edu.ph', 'COS', 'wsxdxdx', 'Participant', '2025-07-04', '2025-07-11', 20, 'App Dev', 'You', '41F3F2B4', 'Pending', '2025-07-15 11:50:33', 1),
(78, 'Ruperto Japay', 'rjapay29319@liceo.edu.ph', 'COS', 'wsxdxdx', 'Participant', '2025-07-04', '2025-07-11', 20, 'App Dev', 'You', '179854F7', 'Pending', '2025-07-15 11:52:45', 1),
(79, 'hvhjhj', 'japay.rupertoiii@gmail.com', 'Permanent', 'nbmnb', 'mnmnbvbn', '2025-07-04', '2025-07-26', 78, 'App Dev', 'hbhbjh', '7E5D389B', 'Pending', '2025-07-15 11:53:45', 1),
(80, 'hvhjhj', 'japay.rupertoiii@gmail.com', 'Permanent', 'nbmnb', 'mnmnbvbn', '2025-07-04', '2025-07-26', 78, 'App Dev', 'hbhbjh', 'EF9E32F9', 'Pending', '2025-07-15 11:58:00', 1),
(81, 'dcvdcd', 'japay.rupertoiii@gmail.com', 'COS', 'dvfdefv', 'fvfdvfd', '2025-07-04', '2025-07-24', 50, 'Managerial', 'scss', '6F8E7C18', 'Pending', '2025-07-15 12:03:52', 1),
(82, 'dcvdcd', 'japay.rupertoiii@gmail.com', 'COS', 'dvfdefv', 'fvfdvfd', '2025-07-04', '2025-07-24', 50, 'Managerial', 'scss', 'F7CED184', 'Pending', '2025-07-15 12:05:57', 1),
(83, 'dcvdcd', 'japay.rupertoiii@gmail.com', 'COS', 'dvfdefv', 'fvfdvfd', '2025-07-04', '2025-07-24', 50, 'Managerial', 'scss', 'B6F2BB67', 'Pending', '2025-07-15 12:06:25', 1),
(84, 'dcvdcd', 'japay.rupertoiii@gmail.com', 'COS', 'dvfdefv', 'fvfdvfd', '2025-07-04', '2025-07-24', 50, 'Managerial', 'scss', '2108F920', 'Completed', '2025-07-15 12:06:47', 1),
(85, 'Ruel Wenceslao', 'wenceslaoruelii@gmail.com', 'COS', 'Test Training', 'Participant', '2025-07-15', '2025-07-16', 8, 'Technical', 'DOST-ITDI', '89E34664', 'Pending', '2025-07-15 13:37:40', 1),
(86, 'Ruel Wenceslao', 'wenceslaoruelii@gmail.com', 'COS', 'Test Training', 'Participant', '2025-07-08', '2025-07-11', 28, 'Technical', 'DOST-ITDI', '268A1AC8', 'Pending', '2025-07-15 13:43:04', 1),
(87, 'Mu Qin', 'rjapay29319@liceo.edu.ph', 'COS', 'The Tale of Herding God', 'Participant', '2025-07-01', '2025-07-05', 20, 'Supervisory', 'DOST X', '0CBE170C', 'Pending', '2025-07-15 20:24:12', 1),
(88, 'Kim Dokja', 'japay.rupertoiii@gmail.com', 'Permanent', 'Omniscient Reader\'s Viewpoint', 'Reader', '2049-05-10', '2025-07-15', 4951, 'Regressing', 'The Oldest Dream', 'F3577E09', 'Completed', '2025-07-15 21:32:57', 1),
(89, 'Xaris S. Dumindin', 'azunadum20@gmail.com', 'COS', 'Software Development and Design', 'Participant', '2025-07-16', '2025-07-31', 25, 'Technical', 'DOST - X', '8480E619', 'Completed', '2025-07-16 09:12:40', 1),
(90, 'Ruperto Japay', 'japay.rupertoiii@gmail.com', 'COS', 'OJT', 'Participant', '2025-06-16', '2025-07-28', 240, 'Technical', 'USTP', 'F98AC96F', 'Pending', '2025-07-16 09:14:10', 1),
(91, 'Ruperto Japay', 'japay.rupertoiii@gmail.com', 'COS', 'OJT', 'Participant', '2025-06-16', '2025-07-28', 240, 'Technical', 'USTP', '2CC7755A', 'Pending', '2025-07-16 09:15:48', 1),
(92, 'Linreb G. Mondero', 'lgmondero@region10.dost.gov.ph', 'Permanent', 'Leave Administration Course Effectiveness (LACE) Training', 'Participant', '2025-08-07', '2025-09-07', 16, 'Administrative', 'DOST-Central Office, HRDP', '52EFBB1B', 'Completed', '2025-07-16 09:21:59', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_users`
--
ALTER TABLE `hr_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `impact_assessments`
--
ALTER TABLE `impact_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_entry_id` (`training_entry_id`);

--
-- Indexes for table `supporting_docs`
--
ALTER TABLE `supporting_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_entry_id` (`training_entry_id`);

--
-- Indexes for table `training_entries`
--
ALTER TABLE `training_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_code` (`unique_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr_users`
--
ALTER TABLE `hr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `impact_assessments`
--
ALTER TABLE `impact_assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `supporting_docs`
--
ALTER TABLE `supporting_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `training_entries`
--
ALTER TABLE `training_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `impact_assessments`
--
ALTER TABLE `impact_assessments`
  ADD CONSTRAINT `impact_assessments_ibfk_1` FOREIGN KEY (`training_entry_id`) REFERENCES `training_entries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supporting_docs`
--
ALTER TABLE `supporting_docs`
  ADD CONSTRAINT `supporting_docs_ibfk_1` FOREIGN KEY (`training_entry_id`) REFERENCES `training_entries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
