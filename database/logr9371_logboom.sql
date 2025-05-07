-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Bulan Mei 2025 pada 19.56
-- Versi server: 11.4.5-MariaDB-cll-lve
-- Versi PHP: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logr9371_logboom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id` varchar(6) NOT NULL,
  `n_pelapor` varchar(30) NOT NULL,
  `t_pelapor` varchar(30) NOT NULL,
  `b_pelapor` varchar(30) NOT NULL,
  `n_kegiatan` varchar(30) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `j_kegiatan` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `foto` blob NOT NULL,
  `status` text NOT NULL,
  `ket_petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelaporan`
--

INSERT INTO `pelaporan` (`id`, `n_pelapor`, `t_pelapor`, `b_pelapor`, `n_kegiatan`, `lokasi`, `kecamatan`, `tgl_kegiatan`, `j_kegiatan`, `ket`, `foto`, `status`, `ket_petugas`) VALUES
('NP0001', 'mudita', 'Alugoro 1.1', 'tibum', 'Penghalauan', 'Gubeng Airlangga', 'Kecamatan Gubeng', '2025-04-28', 'Waktu Tiba 10.36 Waktu Penanganan: 10.40', 'berhasil', 0x666f746f2f36383065643165383630353537576861747341707020496d61676520323032352d30342d32382061742030362e33322e35355f34353161356637352e6a7067, 'Sedang diajukan', '-'),
('NP0002', 'Hery Poedjianto', 'Alugoro 1.1', 'tibum', 'Asuhan Rembulan', 'Gubeng Airlangga', 'Kecamatan Asem Rowo', '2025-05-04', 'Waktu Tiba 10.36 Waktu Penanganan: 10.40', 'awaawa', 0x666f746f2f3638313737626536383161656553637265656e73686f7420323032352d30352d3034203230323630352e706e67, 'Sedang diajukan', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporaniko`
--

CREATE TABLE `pelaporaniko` (
  `id` int(6) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `t_lapor` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ket_petugas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelaporaniko`
--

INSERT INTO `pelaporaniko` (`id`, `tgl_kegiatan`, `lokasi`, `t_lapor`, `ket`, `foto`, `status`, `ket_petugas`) VALUES
(1, '2025-04-27', 'Gubeng Airlangga', 'Jolodoro Rute 1', 'nihil', 'foto/680e28b86b15920240228_95040AMByGPSMapCamera.jpg', 'Sedang diajukan', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` varchar(16) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `img`, `status`) VALUES
('1', 'admin', '$2y$10$RB/mIcCrb5tiWPki00G9CeCDm3DPONAks81c8eBFFOiuQhS.qpWXu', 'Admin', '1018438775_863451460_Foto Formal.png', 1),
('89264893', 'fatimah', '$2y$10$Vgnh5.k4bII1v6X2OvOmhOLUvitRAjZavh9XwhKOvPqc.xOMVE3q2', 'fatimah dwi', '1984902214_465591977_WhatsApp Image 2023-01-28 at 18.29.07.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelaporaniko`
--
ALTER TABLE `pelaporaniko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pelaporaniko`
--
ALTER TABLE `pelaporaniko`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
