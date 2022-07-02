-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 05:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `kodegrup` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `matpel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`kodegrup`, `nama`, `matpel`) VALUES
(1, 'Perkalian', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `kodejawab` int(10) NOT NULL,
  `kodeuser` int(10) NOT NULL,
  `kodeujian` int(10) NOT NULL,
  `kodesoal` int(10) NOT NULL,
  `jawab` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`kodejawab`, `kodeuser`, `kodeujian`, `kodesoal`, `jawab`) VALUES
(1, 27, 2, 3, 'benar'),
(2, 27, 2, 2, 'c'),
(3, 27, 2, 1, 'b'),
(4, 27, 2, 4, 'salah');

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `kodematpel` int(10) NOT NULL,
  `matpel` varchar(50) NOT NULL,
  `tahunajaran` varchar(10) NOT NULL,
  `aktif` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`kodematpel`, `matpel`, `tahunajaran`, `aktif`) VALUES
(1, 'Matematika', '2021', 'T'),
(2, 'Matematika', '2022', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `idnilai` int(10) NOT NULL,
  `kodeuser` int(10) NOT NULL,
  `kodeujian` int(10) NOT NULL,
  `nilai` int(5) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`idnilai`, `kodeuser`, `kodeujian`, `nilai`, `tanggal`) VALUES
(1, 27, 2, 100, '2022-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `iduser` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `status` enum('admin','siswa') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jeniskelamin` enum('L','P') NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggallahir` date NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`iduser`, `username`, `password`, `status`, `nama`, `jeniskelamin`, `tempat`, `tanggallahir`, `foto`) VALUES
(27, 'siswa', 'f7a1719db863b9dd7c55972e3a7dfd56', 'siswa', 'Siswa', 'L', 'lawang', '2022-07-02', 'siswa.jpg'),
(28, 'admin', 'dec6b4457004536b256ad8bfea98fda4', 'admin', 'Admin', 'P', 'lawang', '2022-07-02', 'admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `setujian`
--

CREATE TABLE `setujian` (
  `kodeujian` int(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Grupsoal` int(10) NOT NULL,
  `Token` varchar(20) NOT NULL,
  `Waktu` int(10) NOT NULL,
  `Banyaksoal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setujian`
--

INSERT INTO `setujian` (`kodeujian`, `Nama`, `Grupsoal`, `Token`, `Waktu`, `Banyaksoal`) VALUES
(2, 'Perkalian 1', 1, 'perkalianmatematika', 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `kodesoal` int(10) NOT NULL,
  `kodegrup` int(10) NOT NULL,
  `jenissoal` enum('pilgan','bensal') NOT NULL,
  `soal` longtext NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `pembahasan` varchar(500) NOT NULL,
  `piliha` varchar(100) NOT NULL,
  `pilihb` varchar(100) NOT NULL,
  `pilihc` varchar(100) NOT NULL,
  `pilihd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`kodesoal`, `kodegrup`, `jenissoal`, `soal`, `jawaban`, `pembahasan`, `piliha`, `pilihb`, `pilihc`, `pilihd`) VALUES
(1, 1, 'pilgan', '<p>1 x 2 = ...</p>\r\n', 'b', '<p>1 x 2 = 1 + 1 = 2 (B)</p>\r\n', '<p>1</p>\r\n', '<p>2</p>\r\n', '<p>3</p>\r\n', '<p>4</p>\r\n'),
(2, 1, 'pilgan', '<p>3 x 4 = ...</p>\r\n', 'c', '<p>3 x 4 = 3 + 3 + 3 + 3 = 12 (C)</p>\r\n', '<p>7</p>\r\n', '<p>10</p>\r\n', '<p>12</p>\r\n', '<p>15</p>\r\n'),
(3, 1, 'bensal', '<p>5 x 6 = 30</p>\r\n', 'benar', '<p>5 x 6 = 5 + 5 + 5 + 5 + 5 + 5 = 30 (Benar)</p>\r\n', '', '', '', ''),
(4, 1, 'bensal', '<p>7 x 8 = 15</p>\r\n', 'salah', '<p>7 x 8 = 7 + 7 + 7 + 7 + 7 + 7 + 7 + 7 = 56 (Salah)</p>\r\n', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`kodegrup`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`kodejawab`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`kodematpel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`iduser`,`username`);

--
-- Indexes for table `setujian`
--
ALTER TABLE `setujian`
  ADD PRIMARY KEY (`kodeujian`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`kodesoal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `kodegrup` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `kodejawab` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `kodematpel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `idnilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `iduser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `setujian`
--
ALTER TABLE `setujian`
  MODIFY `kodeujian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `kodesoal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
