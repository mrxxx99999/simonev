-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 02:48 AM
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
-- Database: `simonev`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `kro` varchar(100) DEFAULT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `detail_kegiatan` text DEFAULT NULL,
  `penyerapan` decimal(10,2) DEFAULT NULL,
  `progres` varchar(50) DEFAULT NULL,
  `pci` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `kro`, `nama_kegiatan`, `detail_kegiatan`, `penyerapan`, `progres`, `pci`) VALUES
(4, 'bbb', 'bbb', 'bbbb', 4564564.00, '3', 'Distribusi'),
(5, 'dfgf', 'gdfg', 'tgfdgd', 65757.00, '31', 'Nerwilis'),
(6, 'KRO 1', 'bbb', 'ytyfghfgh', 2222222.00, '24', 'IPDS'),
(7, 'KRO 1', 'PUBLIKASI/LAPORAN ANALISIS DAN PENGEMBANGAN STATISTIK', 'dthfdghjfgjfgjfg', 2000000.00, '20', 'IPDS'),
(8, '2896 Pengembangan dan Analisis Statistik', 'PUBLIKASI/LAPORAN ANALISIS DAN PENGEMBANGAN STATISTIK', 'sdgsdgtsdgsdg', 10000.00, '81', 'Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(500) DEFAULT NULL,
  `sub_bagian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `sub_bagian`) VALUES
(1, 'Marthin Juan', 'admin', '$2y$10$yi5ugVr3r0ecBBUAcKPG8urRnzYVrrtRPhe2ySFVoLCn94NpaNwUa', 'Kepala Kantor', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
