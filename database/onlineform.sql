-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 04:18 PM
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
-- Database: `onlineform`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary`
--

CREATE TABLE `beneficiary` (
  `beneficiary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bene_fname` varchar(255) NOT NULL,
  `bene_mname` varchar(255) NOT NULL,
  `bene_lname` varchar(255) NOT NULL,
  `bene_suffix` varchar(255) DEFAULT NULL,
  `bene_dob` date DEFAULT NULL,
  `bene_relationship` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiary`
--

INSERT INTO `beneficiary` (`beneficiary_id`, `user_id`, `bene_fname`, `bene_mname`, `bene_lname`, `bene_suffix`, `bene_dob`, `bene_relationship`) VALUES
(1, 11, 'Goku', 'krorko', 'Kakarot', '', '2005-01-09', 'Sibling');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_mname` varchar(255) NOT NULL,
  `fsuffix` varchar(255) DEFAULT NULL,
  `fdob` date NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) NOT NULL,
  `msuffix` varchar(255) DEFAULT NULL,
  `mdob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`, `user_id`, `father_fname`, `father_lname`, `father_mname`, `fsuffix`, `fdob`, `mother_fname`, `mother_lname`, `mother_mname`, `msuffix`, `mdob`) VALUES
(5, 10, 'Piccolo', 'Season', 'krorkro', '', '2005-01-09', 'Dende', 'Season', 'krorkro', '', '0005-01-09'),
(6, 11, 'Piccolo', 'Season', 'krorkro', '', '2005-01-09', 'Dende', 'Season', 'krorkro', '', '0005-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `sex` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `date_of_birth`, `sex`, `civil_status`, `nationality`, `place_of_birth`, `home_address`, `phone_number`, `email_address`) VALUES
(1, 'Arl', 'Pedregosa', 'Sison', '', '2005-01-09', 'male', 'single', 'Filipino', 'Cebu City', 'Cebu City', '09912191641', 'arljoshua9@gmail.com'),
(2, 'James', 'Robert', 'Cabizares', '', '2026-01-29', 'male', 'single', 'Filipino', 'Liking Kawayan', '', '09912191641', 'jamescabz@gmail.com'),
(3, 'James', 'Robert', 'Cabizares', '', '2026-01-29', 'male', 'single', 'Filipino', 'Liking Kawayan', '', '09912191641', 'jamescabz@gmail.com'),
(4, 'James', 'Pedregosa', 'Sison', '', '2026-01-31', 'female', 'separated', 'Norwegian', 'Kanal', '', '09912191641', 'jamescabz@gmail.com'),
(10, 'Joswa', 'krorkro', 'Season', 'Jr', '2005-01-09', 'male', 'single', 'Namekian', 'Planet Namek', 'Planet Namek', '09912191641', 'arljoshua9@gmail.com'),
(11, 'Joswa', 'krorkro', 'Season', 'Jr', '2005-01-09', 'male', 'single', 'Namekian', 'Planet Namek', 'Planet Namek', '09912191641', 'arljoshua9@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beneficiary`
--
ALTER TABLE `beneficiary`
  MODIFY `beneficiary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD CONSTRAINT `beneficiary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
