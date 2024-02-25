-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 06:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms_c451_lk`
--

-- --------------------------------------------------------

--
-- Table structure for table `activeorders`
--

CREATE TABLE `activeorders` (
  `orderID` int(8) NOT NULL,
  `item` varchar(25) NOT NULL,
  `placedTime` datetime NOT NULL,
  `cookNotes` varchar(250) NOT NULL,
  `tableID` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `activeorders`
--
DELIMITER $$
CREATE TRIGGER `complete_order` BEFORE DELETE ON `activeorders` FOR EACH ROW BEGIN
	INSERT INTO pastOrders
    	SET
        	orderID = OLD.orderID,
            item = OLD.item,            
            cookNotes = OLD.cookNotes,
            tableID = OLD.tableID,
            changeMadeBy = USER(),
            completeTime = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blockedusers`
--

CREATE TABLE `blockedusers` (
  `accountID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `changeMadeBy` varchar(20) NOT NULL,
  `blockedSince` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredientID` int(5) NOT NULL,
  `ingredientName` varchar(25) NOT NULL,
  `itemAssociation` varchar(255) DEFAULT NULL,
  `inventoryQty` int(4) DEFAULT NULL,
  `UOM` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pastorders`
--

CREATE TABLE `pastorders` (
  `orderID` int(8) NOT NULL,
  `item` varchar(50) NOT NULL,
  `cookNotes` varchar(250) NOT NULL,
  `tableID` varchar(3) NOT NULL,
  `changeMadeBy` varchar(50) NOT NULL,
  `completeTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissiontypes`
--

CREATE TABLE `permissiontypes` (
  `permissionID` int(2) NOT NULL,
  `typeName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbls`
--

CREATE TABLE `tbls` (
  `tblID` int(2) NOT NULL,
  `tbleCapacity` int(2) NOT NULL,
  `tbleOccupied` tinyint(1) NOT NULL,
  `tblLocation` varchar(20) DEFAULT NULL,
  `tblName` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `fldName` int(50) NOT NULL,
  `fldEmail` int(150) NOT NULL,
  `fldPhone` varchar(15) NOT NULL,
  `fldMessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `accountID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `tipShare` int(11) NOT NULL,
  `uPhone` varchar(12) NOT NULL,
  `uEmail` varchar(50) DEFAULT NULL,
  `permissionID` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `check_blocked_users` BEFORE DELETE ON `user` FOR EACH ROW BEGIN
	INSERT INTO blockedUsers
    	SET
        	accountID = OLD.accountID,
            username = OLD.username,
            FName = OLD.FName,
            LName = OLD.LName,
            changeMadeBy = USER(),
            blockedSince = NOW();
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activeorders`
--
ALTER TABLE `activeorders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredientID`);

--
-- Indexes for table `pastorders`
--
ALTER TABLE `pastorders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `permissiontypes`
--
ALTER TABLE `permissiontypes`
  ADD PRIMARY KEY (`permissionID`),
  ADD KEY `permissionID` (`permissionID`);

--
-- Indexes for table `tbls`
--
ALTER TABLE `tbls`
  ADD PRIMARY KEY (`tblID`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `permissionID` (`permissionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activeorders`
--
ALTER TABLE `activeorders`
  MODIFY `orderID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredientID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbls`
--
ALTER TABLE `tbls`
  MODIFY `tblID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`permissionID`) REFERENCES `permissiontypes` (`permissionID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
