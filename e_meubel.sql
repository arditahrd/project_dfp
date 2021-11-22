-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 09:08 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_meubel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'ardita', 'arditaadmin', 'Ardita Hardi'),
(2, 'fita', 'fitaadmin', 'Miftakhul Fitri'),
(3, 'daffa', 'daffadmin', 'Daffa Raka'),
(4, 'rini', 'riniadmin', 'Rini'),
(5, 'aura', 'aura admin', 'Aura');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(10) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Batam', 7000),
(2, 'Jakarta', 31000),
(3, 'Karimun', 18000),
(4, 'Bandung', 29000),
(5, 'Medan', 35000),
(6, 'Tanjung Pinang', 13000),
(7, 'Pontianak', 30000),
(8, 'Pekanbaru', 25000),
(9, 'Bali', 45000),
(10, 'Padang', 38000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(1, 'arditahardi15@gmail.com', 'arditapelanggan', 'Ardita Hardi', '0895365964406'),
(2, 'clara@gmail.com', 'clara', 'Clara Natasya', '08123456789'),
(3, 'julia@gmail.com', 'julia', 'Julia Ramadhani', '082327473232'),
(4, 'filanda@yahoo.com', 'filandaadmin', 'Filanda', '0123456789'),
(5, 'nyobadulu@gmail.com', 'nyobadulu', 'nyoba dulu', 'nyobadulu');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`) VALUES
(10, 1, 1, '2019-05-12', 3142000, 'Batam', 7000, 'Perum Nadim Raya 3 Blok C No.7'),
(11, 3, 4, '2019-05-12', 5069000, 'Bandung', 29000, 'Jalan Bogasari Blok F5 No.8'),
(12, 2, 6, '2019-05-12', 1213000, 'Tanjung Pinang', 13000, 'Perum Kelapa Muda Nomor 90'),
(13, 4, 8, '2019-05-13', 2125000, 'Pekanbaru', 25000, 'Jalan Mawar Blok H No.11'),
(14, 4, 0, '2019-05-13', 1899000, '', 0, ''),
(15, 1, 0, '2021-11-09', 1236000, '', 0, 'Tangerang'),
(16, 5, 0, '2021-11-09', 2100000, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`) VALUES
(11, 10, 2, 1),
(12, 10, 8, 1),
(13, 11, 1, 1),
(14, 11, 7, 2),
(15, 12, 6, 1),
(16, 13, 3, 1),
(17, 14, 8, 1),
(18, 15, 2, 1),
(19, 16, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`) VALUES
(9, 'Kursi Goyang', 790000, 'produk1.jpg'),
(10, 'Set Meja Makan 4 Kursi', 2250000, 'produk2.jpg'),
(11, 'Lemari Penyimpanan', 1150000, 'produk4.jpg'),
(13, 'Kabinet Penyimpanan', 750000, 'produk5.png'),
(14, 'Kursi', 390000, 'produk6.jpg'),
(15, 'Kursi Motif', 420000, 'produk7.jpg'),
(16, 'Lemari Pakaian', 1500000, 'produk8.jpg'),
(17, 'Tempat Tidur Single', 3600000, 'produk9.jpg'),
(18, 'Nakas Bundar', 230000, 'produk10.jpg'),
(19, 'Nakas 3 Laci', 360000, 'produk11.jpg'),
(21, 'Set Meja Makan 4 Stool', 1500000, 'produk13.jpg'),
(22, 'Meja Rias', 2900000, 'produk12.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
