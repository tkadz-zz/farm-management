-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2025 at 09:46 PM
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
-- Database: `farm-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `added` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userID`, `name`, `surname`, `email`, `phone`, `address`, `added`, `updated`) VALUES
(1, 1, 'Tanaka', 'Kadzunge', 'tkadzzz@farm.com', '27782345678', '456 Ranch Street, Bulawayo', '2025-08-14 16:08:20', '2025-08-14 16:08:20'),
(2, 2, 'Sarah', 'Johnson', 'sjohnson@farm.com', '27781234567', '123 Farm Road, Harare', '2025-08-14 16:08:20', '2025-08-15 10:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `livestockID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `batchName` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseDate` date NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `costPerUnit` decimal(10,2) DEFAULT NULL,
  `totalCost` decimal(12,2) DEFAULT NULL,
  `addedBy` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `expected_at` varchar(225) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','completed','archived') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `livestockID`, `companyID`, `batchName`, `quantity`, `purchaseDate`, `source`, `costPerUnit`, `totalCost`, `addedBy`, `notes`, `expected_at`, `created_at`, `updated_at`, `status`) VALUES
(11, 15, 1, 'Broiler B3', 50, '2025-08-15', 'Ivenes', 1.25, 62.50, 1, '3rd Batch', '', '2025-08-15 10:04:41', '2025-08-15 10:04:41', 'active'),
(12, 34, 1, 'layers 1', 20, '2025-08-15', 'ivenes', 2.00, 40.00, 1, 'first layer batch', '', '2025-08-15 18:13:02', '2025-08-15 18:13:02', 'active'),
(15, 15, 1, 'test', 5, '2025-08-15', 'ivee', 4.00, 20.00, 1, 'notesss', '2025-08-31', '2025-08-16 19:00:50', '2025-08-16 19:00:50', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `batch_growth_logs`
--

CREATE TABLE `batch_growth_logs` (
  `id` int(11) NOT NULL,
  `batchID` int(11) NOT NULL,
  `date` date NOT NULL,
  `averageWeight` decimal(5,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `addedBy` int(11) NOT NULL,
  `dateAdded` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_growth_logs`
--

INSERT INTO `batch_growth_logs` (`id`, `batchID`, `date`, `averageWeight`, `notes`, `addedBy`, `dateAdded`, `lastUpdated`) VALUES
(21, 15, '2025-08-01', 0.20, 'first record', 1, '2025-08-16 19:27:43', '2025-08-16 19:27:43'),
(22, 15, '2025-08-05', 0.50, 'second record', 1, '2025-08-16 19:28:10', '2025-08-16 19:28:10'),
(23, 15, '2025-08-10', 0.80, '3rd record', 1, '2025-08-16 19:28:31', '2025-08-16 19:28:31'),
(24, 15, '2025-08-07', 0.60, 'had forgoten to add this', 1, '2025-08-16 19:29:06', '2025-08-16 19:29:06'),
(25, 15, '2025-08-12', 2.00, 'growin rapidly now', 1, '2025-08-16 19:31:55', '2025-08-16 19:31:55'),
(26, 12, '2025-08-02', 0.40, 'first in', 1, '2025-08-16 19:33:57', '2025-08-16 19:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `batch_health_records`
--

CREATE TABLE `batch_health_records` (
  `id` int(11) NOT NULL,
  `batchID` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `costs` decimal(10,2) DEFAULT NULL,
  `addedBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_health_records`
--

INSERT INTO `batch_health_records` (`id`, `batchID`, `date`, `type`, `notes`, `costs`, `addedBy`, `created_at`, `lastUpdated`) VALUES
(11, 11, '2025-08-14', 'BCG VAC', 'First vac record', 10.00, 1, '2025-08-16 18:46:43', '2025-08-16 18:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `batch_losses`
--

CREATE TABLE `batch_losses` (
  `id` int(11) NOT NULL,
  `batchID` int(11) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `unitPrice` decimal(10,2) DEFAULT NULL,
  `estimatedLoss` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `addedBy` int(11) NOT NULL,
  `dateAdded` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_losses`
--

INSERT INTO `batch_losses` (`id`, `batchID`, `date`, `quantity`, `reason`, `unitPrice`, `estimatedLoss`, `notes`, `addedBy`, `dateAdded`, `lastUpdated`) VALUES
(10, 11, '2025-08-15', 1, 'neumonia', 5.00, 15.00, 'power outage cut off heaters', 1, '2025-08-15 21:22:30', '2025-08-15 21:27:20'),
(11, 11, '2025-08-15', 2, 'Test loss ', 5.00, 10.00, 'test loss entry', 1, '2025-08-15 21:42:03', '2025-08-15 21:42:03'),
(12, 15, '2025-08-16', 1, 'phneumonia', 5.00, 5.00, 'died of cold', 1, '2025-08-16 19:02:42', '2025-08-16 19:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `batch_sales`
--

CREATE TABLE `batch_sales` (
  `id` int(11) NOT NULL,
  `batchID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` decimal(10,2) DEFAULT NULL,
  `totalPrice` decimal(12,2) DEFAULT NULL,
  `date` date NOT NULL,
  `buyerName` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `addedBy` int(11) NOT NULL,
  `dateAdded` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_sales`
--

INSERT INTO `batch_sales` (`id`, `batchID`, `quantity`, `unitPrice`, `totalPrice`, `date`, `buyerName`, `notes`, `addedBy`, `dateAdded`, `lastUpdated`) VALUES
(14, 11, 2, 5.00, 10.00, '2025-08-15', 'Taku', 'first batch sale', 1, '2025-08-15 21:04:54', '2025-08-15 21:04:54'),
(15, 11, 1, 5.00, 5.00, '2025-08-15', 'taku', 'added 1 more', 1, '2025-08-15 21:06:35', '2025-08-15 21:06:35'),
(16, 15, 4, 5.00, 20.00, '2025-08-16', 'ivecccc', 'sold 4 total @ $5', 1, '2025-08-16 19:02:08', '2025-08-16 19:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `phone`, `added`, `updated`) VALUES
(1, 'Green Pastures Farm', '123 Farm Road', '+263 777 000 111', '2025-08-14 15:55:44', '2025-08-14 15:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE `livestock` (
  `id` int(11) NOT NULL,
  `companyID` varchar(25) NOT NULL,
  `livestockName` varchar(25) NOT NULL,
  `category` varchar(25) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `addedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livestock`
--

INSERT INTO `livestock` (`id`, `companyID`, `livestockName`, `category`, `added`, `updated`, `addedBy`) VALUES
(15, '1', 'Broilers', 'meat', '2025-08-14 16:31:20', '2025-08-15 10:15:36', 1),
(34, '1', 'layers', 'eggs', '2025-08-15 18:06:01', '2025-08-15 18:06:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `loginID` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date-added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `companyID`, `loginID`, `password`, `role`, `status`, `updated`, `date-added`) VALUES
(1, 1, 'tkadz', '$2y$10$z6nVn2tA7Q4EUAjkL7U5PuwdoQFWbHy82zK/QfjGDMm09YIGqugdS', 'admin', 1, '2025-08-14 16:12:10', '2025-08-14 15:59:46'),
(2, 1, 'sarah', '$2y$10$z6nVn2tA7Q4EUAjkL7U5PuwdoQFWbHy82zK/QfjGDMm09YIGqugdS', 'staff', 1, '2025-08-15 10:16:33', '2025-08-14 15:59:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livestockID` (`livestockID`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `batch_growth_logs`
--
ALTER TABLE `batch_growth_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batchID` (`batchID`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `batch_health_records`
--
ALTER TABLE `batch_health_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batchID` (`batchID`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `batch_losses`
--
ALTER TABLE `batch_losses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batchID` (`batchID`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `batch_sales`
--
ALTER TABLE `batch_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batchID` (`batchID`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addedBy` (`addedBy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `batch_growth_logs`
--
ALTER TABLE `batch_growth_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `batch_health_records`
--
ALTER TABLE `batch_health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `batch_losses`
--
ALTER TABLE `batch_losses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `batch_sales`
--
ALTER TABLE `batch_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch_growth_logs`
--
ALTER TABLE `batch_growth_logs`
  ADD CONSTRAINT `batch_growth_logs_ibfk_1` FOREIGN KEY (`batchID`) REFERENCES `batch` (`id`),
  ADD CONSTRAINT `batch_growth_logs_ibfk_2` FOREIGN KEY (`addedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `batch_health_records`
--
ALTER TABLE `batch_health_records`
  ADD CONSTRAINT `batch_health_records_ibfk_1` FOREIGN KEY (`batchID`) REFERENCES `batch` (`id`),
  ADD CONSTRAINT `batch_health_records_ibfk_2` FOREIGN KEY (`addedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `batch_losses`
--
ALTER TABLE `batch_losses`
  ADD CONSTRAINT `batch_losses_ibfk_1` FOREIGN KEY (`batchID`) REFERENCES `batch` (`id`),
  ADD CONSTRAINT `batch_losses_ibfk_2` FOREIGN KEY (`addedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `batch_sales`
--
ALTER TABLE `batch_sales`
  ADD CONSTRAINT `batch_sales_ibfk_1` FOREIGN KEY (`batchID`) REFERENCES `batch` (`id`),
  ADD CONSTRAINT `batch_sales_ibfk_2` FOREIGN KEY (`addedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `livestock`
--
ALTER TABLE `livestock`
  ADD CONSTRAINT `livestock_ibfk_1` FOREIGN KEY (`addedBy`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
