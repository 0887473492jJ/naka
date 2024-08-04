-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 04:38 PM
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
-- Database: `nakaliving`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(5) NOT NULL,
  `u_fullname` varchar(40) NOT NULL,
  `u_username` varchar(40) NOT NULL,
  `u_password` varchar(40) NOT NULL,
  `u_address` text NOT NULL,
  `u_level` text NOT NULL,
  `u_phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_fullname`, `u_username`, `u_password`, `u_address`, `u_level`, `u_phone`) VALUES
(1, 'ไมโล', 'milo', '8b3d85510ab2637dc828093fcbcb2da5', '87', 'user', '0987654321'),
(20, 'พารวย', 'admin', '98bd168be6206bd55c9c3fb205d8f284', '652', 'administrator', '0823210432'),
(21, 'มูมู่', 'manager', '0795151defba7a4b5dfa89170de46277', '114', 'manager', '0822572782'),
(22, 'อุ๋งอุ๋ง', 'manager2', '80af6a2bdbbb6532769d72a8bc09cd4e', '114', 'manager', '345216875');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
