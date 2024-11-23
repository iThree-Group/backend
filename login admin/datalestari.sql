-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2024 at 07:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datalestari`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admintp1@gmail.com', 'TP1Admin'),
(2, 'admin@lestari.com', 'Lestari123');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `status` enum('Menunggu Verifikasi','Selesai') DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `nama`, `keterangan`, `status`, `tanggal`) VALUES
(1, 'Rani Aplilia', 'Mengantar 4 Kg Sampah Plastik', 'Menunggu Verifikasi', '2024-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas2`
--

CREATE TABLE `aktivitas2` (
  `id` int NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengantar`
--

CREATE TABLE `pengantar` (
  `id` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id` int NOT NULL,
  `berat_kg` float NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id`, `berat_kg`, `tanggal`) VALUES
(1, 2000, '2024-11-23 12:15:43'),
(2, 547, '2024-11-23 12:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `sampah1`
--

CREATE TABLE `sampah1` (
  `id` int NOT NULL,
  `jenis_sampah` varchar(50) DEFAULT NULL,
  `berat_kg` float DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sampah1`
--

INSERT INTO `sampah1` (`id`, `jenis_sampah`, `berat_kg`, `tanggal`) VALUES
(1, 'Plastik', 4, '2024-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status_aktif` tinyint(1) DEFAULT '0',
  `poin` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `status_aktif`, `poin`) VALUES
(1, 'Ahmad Sudrajat', 1, 10),
(2, 'Cut Nyak Gem', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users12`
--

CREATE TABLE `users12` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users12`
--

INSERT INTO `users12` (`id`, `name`, `email`, `password`, `address`, `phone`, `reset_token`, `reset_expires`, `created_at`) VALUES
(1, 'Tes User', 'tesuser@gmail.com', '$2y$10$VD2xMCakLGx/aLwtnVUqL.OR6uI1Rrf5jsAxmMOqk/NNnTJicAxn6', 'Jl. Rajawali No54', '083122892583', NULL, NULL, '2024-11-19 05:12:44'),
(2, 'User Test ', 'usertest@gmail.com', '$2y$10$nKNxjy9VDJ/i9l1uyNFaYOk2EzaOLaUgg5UkzuFm/y8MjFsNmlJuq', 'Jl. Raya Barat No.22', '083125865994', NULL, NULL, '2024-11-19 05:43:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aktivitas2`
--
ALTER TABLE `aktivitas2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengantar`
--
ALTER TABLE `pengantar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampah1`
--
ALTER TABLE `sampah1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users12`
--
ALTER TABLE `users12`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aktivitas2`
--
ALTER TABLE `aktivitas2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengantar`
--
ALTER TABLE `pengantar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sampah1`
--
ALTER TABLE `sampah1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users12`
--
ALTER TABLE `users12`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
