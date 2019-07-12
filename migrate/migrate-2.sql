-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 07:10 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `empore_pmt_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `request_for_qoutation_material_nego`
--

CREATE TABLE `request_for_qoutation_material_nego` (
  `id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `persen` int(11) DEFAULT NULL,
  `price_nego` int(11) DEFAULT NULL,
  `persen_nego` int(11) DEFAULT NULL,
  `request_for_qoutation_material_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_for_qoutation_material_nego`
--

INSERT INTO `request_for_qoutation_material_nego` (`id`, `price`, `persen`, `price_nego`, `persen_nego`, `request_for_qoutation_material_id`, `material_id`, `created_at`) VALUES
(1, 1000000, NULL, 0, 10, 1, NULL, NULL),
(2, 1000000, NULL, 0, 10, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_for_qoutation_material_nego`
--
ALTER TABLE `request_for_qoutation_material_nego`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_for_qoutation_material_nego`
--
ALTER TABLE `request_for_qoutation_material_nego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
