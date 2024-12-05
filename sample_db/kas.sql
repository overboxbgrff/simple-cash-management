-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 02:48 AM
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
-- Database: `kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kk`
--

CREATE TABLE `jenis_kk` (
  `id_kk` int(64) NOT NULL,
  `kode_kk` varchar(64) NOT NULL,
  `desk_kk` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kk`
--

INSERT INTO `jenis_kk` (`id_kk`, `kode_kk`, `desk_kk`) VALUES
(1, 'B.A', 'Beban Administrasi'),
(2, 'B.K', 'Beban Konsumsi'),
(12, 'B.G', 'Beban Gaji'),
(13, 'B.L', 'Beban Listrik'),
(14, 'B.OL', 'Beban Operasi Lainnya'),
(15, 'B.PD-DD', 'Beban Perjalanan Dinas Dalam Daerah'),
(16, 'B.PD-LD', 'Beban Perjalanan Dinas Luar Daerah'),
(17, 'B.PK', 'Beban Perlengkapan Kantor'),
(18, 'B.T', 'Beban Telepon');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_km`
--

CREATE TABLE `jenis_km` (
  `id_km` int(64) NOT NULL,
  `kode_km` varchar(64) NOT NULL,
  `desk_km` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_km`
--

INSERT INTO `jenis_km` (`id_km`, `kode_km`, `desk_km`) VALUES
(1, '1-S.A', 'Saldo Awal'),
(3, 'B.U', 'Bantuan Umum'),
(5, 'K.101', 'Kas'),
(6, 'M', 'Modal'),
(7, 'M.100', 'Modal Awal'),
(8, 'S.D', 'Sisa Dana');

-- --------------------------------------------------------

--
-- Table structure for table `kas_keluar`
--

CREATE TABLE `kas_keluar` (
  `id_kkk` varchar(128) NOT NULL,
  `tanggal_kk` date NOT NULL,
  `kode_kk` varchar(64) NOT NULL,
  `uraian_kk` varchar(1024) NOT NULL,
  `jumlah_kk` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas_keluar`
--

INSERT INTO `kas_keluar` (`id_kkk`, `tanggal_kk`, `kode_kk`, `uraian_kk`, `jumlah_kk`) VALUES
('KK-20241203-130154', '2024-12-03', 'B.A', 'Beban Admin', 15000000);

-- --------------------------------------------------------

--
-- Table structure for table `kas_masuk`
--

CREATE TABLE `kas_masuk` (
  `id_kkm` varchar(128) NOT NULL,
  `tanggal_km` date NOT NULL,
  `kode_km` varchar(64) NOT NULL,
  `uraian_km` varchar(1024) NOT NULL,
  `jumlah_km` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas_masuk`
--

INSERT INTO `kas_masuk` (`id_kkm`, `tanggal_km`, `kode_km`, `uraian_km`, `jumlah_km`) VALUES
('KM-20241203-121913', '2024-12-03', '1-S.A', 'Saldo Awal Bulan', 200000000),
('KM-20241203-122244', '2024-10-03', 'S.A', 'Saldo Awal Bulan Oktober', 250000000),
('KM-20241203-122318', '2024-12-04', 'B.U', 'Bantuan Pemda', 150000000);

-- --------------------------------------------------------

--
-- Table structure for table `lapor`
--

CREATE TABLE `lapor` (
  `id_lapor` varchar(128) NOT NULL,
  `tanggal_lapor` date NOT NULL,
  `kode_lapor` varchar(64) NOT NULL,
  `uraian_lapor` varchar(1024) NOT NULL,
  `pemasukan` int(255) NOT NULL,
  `pengeluaran` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(64) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `uname` varchar(256) NOT NULL,
  `passwd` varchar(256) NOT NULL,
  `priv` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `uname`, `passwd`, `priv`) VALUES
(1, 'Danang Priyombodo', 'danang', 'YmFuYmFrYXJzYXVzdGlyYW0=', 'Administrator'),
(2, 'K1 Project Capstone', 'guest', 'cGNrZWwx', 'User'),
(3, 'Admin', 'admin', 'YWRtaW5wY3NhdHU=', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_kk`
--
ALTER TABLE `jenis_kk`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indexes for table `jenis_km`
--
ALTER TABLE `jenis_km`
  ADD PRIMARY KEY (`id_km`);

--
-- Indexes for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  ADD PRIMARY KEY (`id_kkk`);

--
-- Indexes for table `kas_masuk`
--
ALTER TABLE `kas_masuk`
  ADD PRIMARY KEY (`id_kkm`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_kk`
--
ALTER TABLE `jenis_kk`
  MODIFY `id_kk` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jenis_km`
--
ALTER TABLE `jenis_km`
  MODIFY `id_km` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
