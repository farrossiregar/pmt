ALTER TABLE `purchase_request` ADD `token_code` VARCHAR(255) NULL AFTER `company_id`, ADD `token_expired` DATE NULL AFTER `token_code`;


-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2019 at 05:32 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `empore_pmt2`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_code` varchar(150) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `project_manager_id` int(11) DEFAULT NULL,
  `project_type` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


ALTER TABLE `request_for_qoutation`  ADD `term_day` INT NULL  AFTER `created_by`;
ALTER TABLE `purchase_order_warehouse` ADD `company_id` INT NULL AFTER `sales_tax`;
ALTER TABLE `vendor_of_material` ADD `user_id` INT NULL AFTER `created_by`;

-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2019 at 12:38 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `empore_pmt2`
--

-- --------------------------------------------------------

--
-- Table structure for table `request_for_qoutation_term_condition`
--

CREATE TABLE `request_for_qoutation_term_condition` (
  `id` int(11) NOT NULL,
  `term` text,
  `cond` text,
  `request_for_qoutation_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_for_qoutation_term_condition`
--
ALTER TABLE `request_for_qoutation_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_for_qoutation_term_condition`
--
ALTER TABLE `request_for_qoutation_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2019 at 11:25 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `empore_pmt2`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_material`
--

CREATE TABLE `purchase_order_material` (
  `id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_order_material`
--
ALTER TABLE `purchase_order_material`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_order_material`
--
ALTER TABLE `purchase_order_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `request_for_qoutation` ADD `company_id` INT NULL AFTER `updated_at`;
