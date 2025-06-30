-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 06:41 AM
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
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `tanggal_masuk`, `nama`, `harga`, `jumlah`) VALUES
(5, '2025-06-03 22:23:00', 'Meow Kitten 500g (Bunga)', 22000, 20),
(6, '2025-06-03 22:24:00', 'Excel Chicken & Tuna (Segitiga) 500g', 12500, 12),
(7, '2025-06-03 22:24:00', 'Meow Persian Adult 500g (Bintang)', 22000, 12),
(8, '2025-06-03 22:24:00', 'Meow Persian Kitten (Kotak)', 23000, 29),
(9, '2025-06-03 22:25:00', 'Meow Salmon 500g', 18000, 16),
(10, '2025-06-03 22:25:00', 'Meow Tuna 500g', 18000, 17),
(11, '2025-06-03 22:25:00', 'Tuna Kibbles Ikan', 18000, 12),
(12, '2025-06-03 22:26:00', 'Kitten Hair & Skin Tuna', 20000, 24),
(13, '2025-06-03 22:26:00', 'Kitten Hair & Skin Salmon', 20000, 15),
(14, '2025-06-03 22:26:00', 'Meow Proplain Chicken', 55000, 25),
(15, '2025-06-03 22:27:00', 'Pasir Injae Bentoine 5L', 20000, 26),
(16, '2025-06-03 22:27:00', 'Cat Choize Kitten Salmon with Milk', 24000, 19),
(17, '2025-06-03 22:27:00', 'Cat Choize Adult Salmon', 17000, 36),
(18, '2025-06-03 22:28:00', 'Cat Choize Adult Tuna', 17000, 12),
(19, '2025-06-03 22:28:00', 'Cat Choize Kitten Tuna with Milk', 24000, 23),
(20, '2025-06-03 22:28:00', 'Excel Chicken & Tuna (Pink)', 12500, 43),
(21, '2025-06-03 22:28:00', 'Excel Salmon (Kuning)', 12500, 14),
(22, '2025-06-03 22:29:00', 'Excel Tuna (Pink Fanta)', 11000, 25);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama`) VALUES
(1, 'Admin'),
(2, 'Pemilik'),
(3, 'Pelayan Toko 1'),
(4, 'Pelayan Toko 2');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `total` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `kembali` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_waktu`, `nomor`, `total`, `nama`, `bayar`, `kembali`) VALUES
(1, '2025-06-03 17:31:43', '705402', 90000, 'Angel', 100000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_barang`, `harga`, `qty`, `total`) VALUES
(1, 1, 11, 18000, 3, 54000),
(2, 1, 5, 18000, 2, 36000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role_id`) VALUES
(1, 'Angel', 'angel', '12345', 0),
(2, 'angel', 'angel', '12345', 1),
(4, 'Udin', 'udin', '12345', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
