-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2022 at 12:07 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimbapp-beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int NOT NULL,
  `sender` varchar(30) NOT NULL,
  `receiver` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `send_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender`, `receiver`, `text`, `send_at`) VALUES
(116, 'D1A115015', '197508142006041001', 'wee', '2022-11-09 13:55:31'),
(117, 'D1A115011', '197508142006041001', 'p', '2022-11-09 14:11:51'),
(118, 'D1A115011', '197508142006041001', 'y', '2022-11-09 14:12:07'),
(119, 'asd', 'asdasd', 'assfdssfa', '2022-11-09 14:52:07'),
(120, '197508142006041001', 'D1A115011', 'iya bro', '2022-11-09 15:33:06'),
(121, '197508142006041001', 'D1A115015', 'iyah', '2022-11-12 20:09:18'),
(122, '197508142006041001', 'D1A115011', 'ADA APA', '2022-11-12 20:10:09'),
(123, '197508142006041001', 'D1A115015', 'p', '2022-11-12 21:12:32'),
(124, '197508142006041001', 'D1A115015', 'tes', '2022-11-12 21:12:49'),
(125, 'D1A115015', '197508142006041001', 'p', '2022-11-12 21:17:43'),
(126, 'D1A115015', '197508142006041001', 'w', '2022-11-12 21:19:22'),
(127, 'D1A115015', '197508142006041001', 's', '2022-11-12 21:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nip`, `nama`) VALUES
(1, '197508142006041001', 'Abdul Gafaruddin, SP. M.Si'),
(2, '197501092014091003', 'Agustono Slameta, S.P., M.P');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_pa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id`, `nim`, `nama`, `id_pa`) VALUES
(1, 'D1A115011', 'AMUDDIN WOTA', '197508142006041001'),
(4, 'D1A115015', 'AL JUFRIN', '197508142006041001'),
(5, 'D1A118093', 'WIDA PRATIWI P', '197508142006041001'),
(6, 'D1A115032', 'ASRIANTI PUSPITA', '197501092014091003'),
(7, 'D1A118098', 'WA ODE YUSNI', '197501092014091003'),
(13, 'D1A115151', 'ZUL HIDAYAH P', '197501092014091003');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` enum('mhs','dosen','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_esperanto_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `name`, `level`) VALUES
(1, 'ok', 'ok', '', 'admin'),
(2, 'admin', 'admin', 'Nur Iccang', 'admin'),
(3, 'D1A115015', 'mhs', 'AL JUFRIN', 'mhs'),
(4, '197508142006041001', 'dosen', 'Abdul Gafaruddin, SP. M.Si', 'dosen'),
(5, 'D1A118093', 'dosen', 'WIDA PRATIWI P', 'dosen'),
(8, 'D1A115032', 'mhs', 'ASRIANTI PUSPITA', 'mhs'),
(9, 'D1A115151', 'mhs', 'ZUL HIDAYAH P', 'mhs'),
(12, 'D1A115011', 'mhs', 'AMUDDIN WOTA', 'mhs'),
(13, 'D1A115015', 'mhs', 'AL JUFRIN', 'mhs'),
(14, 'D1A118098', 'mhs', 'WA ODE YUSNI', 'mhs'),
(15, '197501092014091003', 'dosen', 'Agustono Slameta, S.P., M.P', 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
