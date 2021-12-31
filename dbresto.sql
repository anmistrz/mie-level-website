-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2021 at 06:07 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbresto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_adm` varchar(12) NOT NULL,
  `nama_adm` varchar(100) DEFAULT NULL,
  `telp_adm` int(20) DEFAULT NULL,
  `alamat_adm` varchar(100) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gambar_adm` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `nama_adm`, `telp_adm`, `alamat_adm`, `username`, `password`, `gambar_adm`) VALUES
('ADM-001', 'Anas Ardiansyah', 208320, 'Maospati', 'anas', '123', '3x4 .jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `no_bayar` varchar(20) CHARACTER SET latin1 NOT NULL,
  `no_transaksi` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_cst` varchar(20) CHARACTER SET latin1 NOT NULL,
  `total_byr` int(50) NOT NULL,
  `jenis_byr` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tgl_byr` date NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bayar_berhasil`
--

CREATE TABLE `bayar_berhasil` (
  `no_bayar` varchar(20) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `id_cst` varchar(20) NOT NULL,
  `total_byr` int(50) NOT NULL,
  `jenis_byr` varchar(20) NOT NULL,
  `tgl_byr` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar_berhasil`
--

INSERT INTO `bayar_berhasil` (`no_bayar`, `no_transaksi`, `id_cst`, `total_byr`, `jenis_byr`, `tgl_byr`, `status`) VALUES
('OR-001', 'TRA-001', 'CST-001', 59000, 'Ovo', '2021-12-30', 'SUDAH DICEK'),
('OR-002', 'TRA-002', 'CST-001', 34000, 'Cash', '2021-12-30', 'SUDAH DICEK'),
('OR-003', 'TRA-005', 'CST-001', 24000, 'Gopay', '2021-12-30', 'SUDAH DICEK'),
('OR-004', 'TRA-006', 'CST-002', 70000, 'Kartu ATM', '2021-12-30', 'SUDAH DICEK');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_cst` varchar(20) NOT NULL,
  `nama_cst` varchar(50) DEFAULT NULL,
  `alamat_cst` varchar(30) DEFAULT NULL,
  `nohp_cst` varchar(30) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto_cst` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cst`, `nama_cst`, `alamat_cst`, `nohp_cst`, `username`, `password`, `foto_cst`) VALUES
('CST-001', 'Bayu Tito', 'Magetan', '08523578970', 'bayu', '789', 'yaya.png'),
('CST-002', 'Tok Aba', 'Magetan', '085347645', 'tokaba', '345', 'tokaba.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nama_menu` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `jenis_menu` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `detail` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `foto_menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `jenis_menu`, `harga`, `detail`, `foto_menu`) VALUES
('DIM01', 'Siomay', 'Dimsum', 5000, 'Dimsum kukus isi ayam dicampur sedikit udang dibungkus dengan kulit siomay yang MANTULLLLLLL :)', 'SIOMAY.jpg'),
('MIN01', 'Es Genderuwo', 'Minuman', 8000, 'Segelas es buah-buahan ditambah dengan cincau versi premium dengan rasa manis dan ditambah dengan susu yang membuat mulutmu smoooothhh.....\r\n', 'ES GENDERUWO.jpg'),
('MIN02', 'Es Tuyul', 'Minuman', 9000, 'Segelas minuman membuat kamu cool setelah berpanas-panasan yang dilengkapi dengan buah-buahan dan dicampur dengan cincau yang bikin kamu cooool abizzzz...\r\n', 'TUYUL.jpg'),
('MIN03', 'Es Pocong', 'Minuman', 7000, 'Es penyemangat dengan rasa tropical segar yang membuat harimu lebih bersemangat dan lebih fresssshhhhh....', 'POCONG.jpg'),
('MKN01', 'Mie Iblis', 'Makanan', 10000, 'Untuk yang suka manis harus cobain mie yang satu ini. Mie dengan rasa manis atau pedas manis buat kamu yang ingin mencoba sensasi pedas manis yang uhhhh ahhhhh....\r\n', 'MIE IBLIS.jpg'),
('MKN02', 'Mie Setan', 'Makanan', 12000, 'Semangkuk mie dengan rasa pedas asin yang bakal membuat mulut kamu meledak !!!. Tentunya dengan topping ayam cincang dan krupuk pangsit yang gurih dan Kreeessshhh... ', 'MIE SETAN.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_customer`
--

CREATE TABLE `order_customer` (
  `no_order` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_cst` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_menu` varchar(20) CHARACTER SET latin1 NOT NULL,
  `level` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(30) NOT NULL,
  `tgl_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_customer_fix`
--

CREATE TABLE `order_customer_fix` (
  `id` int(20) NOT NULL,
  `no_order` varchar(20) NOT NULL,
  `id_cst` varchar(20) NOT NULL,
  `id_menu` varchar(20) NOT NULL,
  `level` varchar(20) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(30) NOT NULL,
  `tgl_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_customer_fix`
--

INSERT INTO `order_customer_fix` (`id`, `no_order`, `id_cst`, `id_menu`, `level`, `jumlah`, `total`, `tgl_order`) VALUES
(84, 'OR-001', 'CST-001', 'MKN02', 'level 4', 3, 36000, '2021-12-30'),
(85, 'OR-002', 'CST-001', 'DIM01', '', 1, 5000, '2021-12-30'),
(86, 'OR-003', 'CST-001', 'MIN02', '', 2, 18000, '2021-12-30'),
(87, 'OR-004', 'CST-001', 'MKN01', 'level 4', 2, 20000, '2021-12-30'),
(88, 'OR-005', 'CST-001', 'MIN03', '', 2, 14000, '2021-12-30'),
(89, 'OR-006', 'CST-001', 'MKN02', 'level 2', 2, 24000, '2021-12-30'),
(90, 'OR-007', 'CST-001', 'MIN01', '', 2, 16000, '2021-12-30'),
(93, 'OR-008', 'CST-001', 'MKN02', 'level 2', 1, 12000, '2021-12-30'),
(94, 'OR-009', 'CST-001', 'MIN03', '', 1, 7000, '2021-12-30'),
(95, 'OR-010', 'CST-001', 'DIM01', '', 1, 5000, '2021-12-30'),
(96, 'OR-011', 'CST-002', 'MKN02', 'level 3', 3, 36000, '2021-12-30'),
(97, 'OR-012', 'CST-002', 'MIN01', '', 3, 24000, '2021-12-30'),
(98, 'OR-013', 'CST-002', 'DIM01', '', 2, 10000, '2021-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(10) CHARACTER SET latin1 NOT NULL,
  `no_order` varchar(10) CHARACTER SET latin1 NOT NULL,
  `total_byr` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `no_order`, `total_byr`) VALUES
('TRA-001', 'OR-001', 59000),
('TRA-001', 'OR-002', 59000),
('TRA-001', 'OR-003', 59000),
('TRA-002', 'OR-004', 34000),
('TRA-002', 'OR-005', 34000),
('TRA-003', 'OR-006', 40000),
('TRA-003', 'OR-007', 40000),
('TRA-004', 'OR-008', 36000),
('TRA-004', 'OR-009', 36000),
('TRA-005', 'OR-008', 24000),
('TRA-005', 'OR-009', 24000),
('TRA-005', 'OR-010', 24000),
('TRA-006', 'OR-011', 70000),
('TRA-006', 'OR-012', 70000),
('TRA-006', 'OR-013', 70000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`),
  ADD KEY `no_duplicate` (`username`,`password`) USING BTREE;

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`no_bayar`);

--
-- Indexes for table `bayar_berhasil`
--
ALTER TABLE `bayar_berhasil`
  ADD PRIMARY KEY (`no_bayar`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cst`),
  ADD KEY `no_duplicate` (`username`,`password`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`no_order`),
  ADD KEY `id_cst` (`id_cst`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `order_customer_fix`
--
ALTER TABLE `order_customer_fix`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cst` (`id_cst`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `no_order` (`no_order`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`,`no_order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_customer_fix`
--
ALTER TABLE `order_customer_fix`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
