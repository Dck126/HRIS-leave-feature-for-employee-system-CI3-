-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2024 at 12:07 PM
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
-- Database: `hris_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Departments`
--

CREATE TABLE `Departments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Departments`
--

INSERT INTO `Departments` (`id`, `name`) VALUES
(1, 'IT'),
(2, 'HRD'),
(3, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `Employees`
--

CREATE TABLE `Employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Employees`
--

INSERT INTO `Employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `hire_date`, `job_title`, `department_id`) VALUES
(7, 'Jhon', 'Doe', 'john@gmail.com', '123321', '2024-07-18', 'Marketing', 3),
(8, 'Foo', 'Foo', 'foo@gmail.com', '12321', '2024-07-18', 'HRD', 2),
(9, 'Naruoto', 'Uzumaki', 'naruto@gmail.com', '12345678', '2024-06-11', 'HRD', 2),
(12, 'Pratama', 'pratama', 'pratama@gmail.com', '12345678', '2024-07-01', 'Web Developer', 1),
(13, 'Hello', 'World', 'hello@gmail.com', '123456', '2024-07-02', 'HRD', 2);

-- --------------------------------------------------------

--
-- Table structure for table `LeaveQuotas`
--

CREATE TABLE `LeaveQuotas` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `total_days` int(11) NOT NULL,
  `used_days` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LeaveQuotas`
--

INSERT INTO `LeaveQuotas` (`id`, `employee_id`, `year`, `total_days`, `used_days`) VALUES
(33, 8, '2024', 0, 10),
(34, 12, '2024', 10, 0),
(35, 9, '2024', 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Leaves`
--

CREATE TABLE `Leaves` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Departments`
--
ALTER TABLE `Departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `LeaveQuotas`
--
ALTER TABLE `LeaveQuotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `Leaves`
--
ALTER TABLE `Leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Departments`
--
ALTER TABLE `Departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Employees`
--
ALTER TABLE `Employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `LeaveQuotas`
--
ALTER TABLE `LeaveQuotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Leaves`
--
ALTER TABLE `Leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Employees`
--
ALTER TABLE `Employees`
  ADD CONSTRAINT `Employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `Departments` (`id`);

--
-- Constraints for table `LeaveQuotas`
--
ALTER TABLE `LeaveQuotas`
  ADD CONSTRAINT `LeaveQuotas_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employees` (`id`);

--
-- Constraints for table `Leaves`
--
ALTER TABLE `Leaves`
  ADD CONSTRAINT `Leaves_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
