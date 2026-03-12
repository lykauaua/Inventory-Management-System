-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 04:07 AM
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
-- Database: `ims system`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_storage`
--

CREATE TABLE `all_storage` (
  `equip_name` varchar(300) NOT NULL DEFAULT '',
  `img` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(300) NOT NULL DEFAULT '',
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(300) NOT NULL DEFAULT '',
  `ID` int(11) NOT NULL DEFAULT 0,
  `serial_num` int(11) DEFAULT NULL,
  `brand_model` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_storage`
--

INSERT INTO `all_storage` (`equip_name`, `img`, `quantity`, `created_at`, `created_by`, `updated_at`, `status`, `ID`, `serial_num`, `brand_model`) VALUES
('Dropper', 'equipment - 1712320325.jpg', 23, '2024-04-05 14:32:05', '52', '2024-04-05 14:32:05', 'Good Condition', 30, 12345, 'brandX-143'),
('Test Tube', 'equipment - 1712321621.jpg', 12, '2024-04-05 14:53:41', '53', '2024-04-05 14:53:41', 'Good Condition', 31, 123, 'brandY-123'),
('Test Tube Holder', 'equipment - 1712321663.jpg', 10, '2024-04-05 14:54:23', '53', '2024-04-05 14:54:23', 'Need Replacement', 32, 3456, 'brandZ-123'),
('Hot Plate', 'equipment - 1712321754.jpeg', 5, '2024-04-05 14:55:54', '53', '2024-04-05 14:55:54', 'Good Condition', 33, 4567, 'brandA-123'),
('Beaker', 'equipment - 1712322394.jpg', 34, '2024-04-05 14:56:29', '53', '2024-04-05 14:56:29', 'Need Replacement', 34, 5678, 'brandZ-1233'),
('Hammer', 'tools - 1712361568.jpg', 23, '2024-04-06 01:56:54', '53', '2024-04-06 01:56:54', 'Usable', 3, 12345, 'brandA-7889'),
('Screwdriver', 'tools - 1712387409.jpg', 23, '2024-04-06 09:10:09', '53', '2024-04-06 09:10:09', 'Not Usable', 16, 2345, 'brandZ-1233');

-- --------------------------------------------------------

--
-- Table structure for table `consumables`
--

CREATE TABLE `consumables` (
  `equip_name` varchar(300) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(300) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(300) NOT NULL,
  `ID` int(11) NOT NULL,
  `serial_num` int(11) DEFAULT NULL,
  `brand_model` varchar(255) DEFAULT NULL,
  `maintenance` date DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `acquisition_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumables`
--

INSERT INTO `consumables` (`equip_name`, `img`, `quantity`, `created_at`, `created_by`, `updated_at`, `status`, `ID`, `serial_num`, `brand_model`, `maintenance`, `location`, `remarks`, `acquisition_date`) VALUES
('Litmus Paper', 'consume -1722837611.jpg', 789, '2024-08-05 07:58:21', '790', '2024-08-05 08:00:11', 'Available', 18, 123456, 'brandY-7889', '2024-08-31', 'Chem Lab', 'for long remarks', '2024-08-31'),
('Filter Paper', 'consume -1722837670.jpg', 670, '2024-08-05 08:01:10', '790', '2024-08-05 08:01:10', 'Unavailable', 19, 1234567, 'brandY-7889', '2024-08-31', 'Chem Lab', 'No Remarks', '2024-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equip_name` varchar(300) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(300) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(300) NOT NULL,
  `ID` int(11) NOT NULL,
  `serial_num` int(11) DEFAULT NULL,
  `brand_model` varchar(255) DEFAULT NULL,
  `maintenance` date DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `acquisition_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equip_name`, `img`, `quantity`, `created_at`, `created_by`, `updated_at`, `status`, `ID`, `serial_num`, `brand_model`, `maintenance`, `location`, `remarks`, `acquisition_date`) VALUES
('Microscope', 'equip -1722837169.jpg', 43, '2024-08-05 07:52:49', '790', '2024-08-05 07:52:49', 'Serviceable', 62, 987, 'brandY-7889', '2024-08-31', 'Chem Lab', 'No Remarks', '2024-08-31'),
('Hot Plate', 'equip -1722837280.jpeg', 56, '2024-08-05 07:54:40', '790', '2024-08-05 07:54:40', 'Not Serviceable', 63, 12345325, 'brandA-7889', '2024-08-31', 'Chem Lab', 'for long remarks', '2024-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `equip_name` varchar(300) NOT NULL,
  `img` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(300) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(300) NOT NULL,
  `ID` int(11) NOT NULL,
  `serial_num` int(11) NOT NULL,
  `brand_model` varchar(255) NOT NULL,
  `maintenance` date DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `acquisition_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`equip_name`, `img`, `quantity`, `created_at`, `created_by`, `updated_at`, `status`, `ID`, `serial_num`, `brand_model`, `maintenance`, `location`, `remarks`, `acquisition_date`) VALUES
('Hammer', 'tools -1722836511.jpg', 64, '2024-08-05 07:41:51', '790', '2024-08-05 07:41:51', 'Needs Relief', 71, 11, 'brandA-7889', '2024-08-31', 'CE Lab', 'for long remarks', '2024-08-05'),
('Screwdriver', 'tools -1737354678.jpg', 65, '2024-08-05 07:49:48', '790', '2025-01-20 07:31:18', 'Good Condition', 72, 1234567, 'brandA-7889', '2024-08-31', 'CE Lab', 'DAMAGED HANDLE', '2024-08-31'),
('SAMPLE', 'tools -1737354734.png', 23, '2025-01-20 07:32:14', '53', '2025-01-20 07:32:14', 'Needs Relief', 74, 123456, 'brandA-7889', '2025-01-25', 'CE Lab', 'No Remarks', '2025-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `password`, `email`, `created_at`, `updated_at`) VALUES
(16, 'newEditedUser', '$2y$10$KaWZUsaBBzgNr0OarNg2OeKyKGOGQ3mM4Gy0K7/Y.X0Wu24QJ4cd2', 'newEditedUser@yahoo.com', '2024-03-25 22:03:38', '2024-03-29 03:40:24'),
(35, 'bombshell', '$2y$10$Bp6cwomv88xQJKehq5wn8etQCEFGIg.kw9N2FC1g15D9zBsAX8y.S', 'bombshell@gmail.com', '2024-04-01 10:14:47', '2024-04-01 10:14:47'),
(42, 'Jose Rizal', '$2y$10$hK0RenMz4muEwgi3l6/SrekFCBVxuC4/lE2bn50KsoI6h.UR6D4xK', 'jose@yahoo.com', '2024-04-02 04:32:40', '2024-04-02 04:32:40'),
(43, 'Taylor Sheesh', '$2y$10$B1RCI3kpPJVET5uZCs32.u1xGo.KxYbBCEovh4dROjKENH10A3RUa', 'taylor@cdm.edu.ph', '2024-04-02 04:33:11', '2024-04-02 04:33:11'),
(50, 'newUser', '$2y$10$mYoKqrPy4Luqzz.aj.GoKeo0Y/61xotf60cjA.lfvlxkHjoFw7k.C', 'newUser@cdm.edu.ph', '2024-04-04 17:32:16', '2024-04-04 17:32:16'),
(53, 'Lyka', '$2y$10$1B.Dbkvp9VvNQx0lNCEOCOqXT1LcPzI0UqGtBGJmFYBthGRD718kC', 'lyka@cdm.edu.ph', '2024-04-05 14:30:11', '2024-04-05 14:30:11'),
(790, 'Group2', '$2y$10$PPlDF5vok5X95YEKzyTAQusZTtuUPIsWGTg7RKOkXA1XlokwVszT.', 'group2@yahoo.com', '2024-05-09 01:07:35', '2024-05-09 01:07:35'),
(793, 'Student Assistant 1', '$2y$10$AELZKV893f3yH4eAwXqysudt56AO3alXp1Fw.fBqrCxvCEKELEQd.', 'sa1@cdm.edu.ph', '2024-08-08 13:31:32', '2025-01-20 07:24:30'),
(794, 'ADD', '$2y$10$qoGTZLKbCFZ655hBB0vhbeLfmsJ4QcHgR/kQHiPN6C/4QdBwKAOXG', 'ADD@GMAIL.COM', '2025-01-20 07:25:09', '2025-01-20 07:33:44'),
(795, 'SAMPLE', '$2y$10$/PaKc/DzQk7lJXriOgTp8uMpRG//i3nSZYVOoSCJBiND6Lm/ZG/Pa', 'SAMPLE@GMAIL.COM', '2025-01-20 07:33:59', '2025-01-20 07:33:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consumables`
--
ALTER TABLE `consumables`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumables`
--
ALTER TABLE `consumables`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=796;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
