-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 08:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcciis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'mmd', 'mmd');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `e_id` int(255) NOT NULL,
  `employee_surname` varchar(255) NOT NULL,
  `employee_fname` varchar(255) NOT NULL,
  `employee_mi` char(10) NOT NULL,
  `employee_ext` char(10) NOT NULL,
  `employee_address` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_department` varchar(255) NOT NULL,
  `employee_position` varchar(255) NOT NULL,
  `employee_emergency_name` varchar(255) NOT NULL,
  `employee_relation` varchar(255) NOT NULL,
  `employee_contact` varchar(255) NOT NULL,
  `employee_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `employee_surname`, `employee_fname`, `employee_mi`, `employee_ext`, `employee_address`, `employee_id`, `employee_department`, `employee_position`, `employee_emergency_name`, `employee_relation`, `employee_contact`, `employee_date`) VALUES
(36, 'DASFAFDFADS', 'Adfsdasf', 'A.', '', 'Adfsadfs, Afd, Afdad', '21231213', 'Asfd', 'Adfs', 'Fdafada', 'Ashduh', '67656565645', '2025-06-26'),
(37, 'ASD', 'Dfasads', 'A.', '', 'Asdasd, K, ', '6567353674', 'Aghsdjga', 'Tdtrdtrdtrd', 'Asd', 'Guardian', '09752849371', '2025-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(255) NOT NULL,
  `student_surname` varchar(255) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_mi` char(10) NOT NULL,
  `student_ext` char(10) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `student_year` varchar(255) NOT NULL,
  `student_course` varchar(255) NOT NULL,
  `student_emergency_name` varchar(255) NOT NULL,
  `student_relation` varchar(255) NOT NULL,
  `student_contact` varchar(255) NOT NULL,
  `student_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `student_surname`, `student_fname`, `student_mi`, `student_ext`, `student_address`, `student_id`, `student_year`, `student_course`, `student_emergency_name`, `student_relation`, `student_contact`, `student_date`) VALUES
(14, 'DIGMAN', 'Afs', 'C.', 'FCFCFG', 'Cfgcfgcgf, Cfgcfg, Cfgcfg', 'cgfc', '2nd Year', 'Bachelor of Secondary Education: Major in Filipino', 'JiiFgcgfcgc', 'Gfcgfcgf', '67567576576', '2025-06-26'),
(16, 'DIGMAN', 'Asdghashg', 'H.', '', 'Hgahsdg, Hghgahsdhug, Uhgughadhug', '22-0000276', '4th Year', 'Bachelor of Secondary Education: Major in Science', 'John', 'Guar', '28393789732', '2025-06-26'),
(17, 'DIGMAN', 'Christian', 'D.', '', 'Asd, Sta Ana, Ads', '22-0000276', '4th Year', 'Associate in Computer Technology', 'Ashdg', 'Guardian', '09777123472', '2025-06-26'),
(18, 'ASD', 'Gcg', 'G.', '', 'Fasd, Tftyfyt, Ftyfty', 'ytftyftyfty', '4th Year', 'Bachelor of Secondary Education: Major in English', 'Ashdg', 'Jij', '28393789732', '2025-06-26'),
(19, 'ZBCHVVHGVHGZVCHGVHGVZ', 'Hgvgh', 'G.', 'C', 'Cffgfg, Cfgcfgc, Cgfcc', 'gcg', '3rd Year', 'Bachelor of Secondary Education: Major in English', 'Asddsa', 'Tdtdtdt', '21672357623', '2025-06-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
