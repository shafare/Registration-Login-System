-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Sep 2021 pada 14.50
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `list_alumni`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `iaicj`
--

CREATE TABLE `iaicj` (
  `nomor` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `lahir` date NOT NULL,
  `angkatan` varchar(2) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `iaicj`
--

INSERT INTO `iaicj` (`nomor`, `nama`, `lahir`, `angkatan`, `pekerjaan`, `prodi`, `alamat`) VALUES
(1, 'Shafatyra Reditha Shalsadilla', '2002-06-08', '11', 'Mahasiswa - Universitas Brawijaya', 'Teknik Informatika', 'Kota Jambi'),
(2, 'Indah Qurrata', '2002-08-04', '11', 'Mahasiswa - Universitas Jambi', 'Pend. Bahasa Inggris', 'Kota Jambi'),
(3, 'Deanova Insiratu', '2002-07-28', '11', 'Mahasiswa - Universitas Sriwijaya', 'Farmasi', 'Kota Jambi'),
(4, 'Ikmil Khairiyah', '2001-07-27', '10', 'Mahasiswa - Kazan Medical University', 'General Medicine', 'Kazan, Rusia');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `iaicj`
--
ALTER TABLE `iaicj`
  ADD PRIMARY KEY (`nomor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `iaicj`
--
ALTER TABLE `iaicj`
  MODIFY `nomor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
