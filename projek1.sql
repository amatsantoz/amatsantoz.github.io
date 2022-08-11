-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Okt 2019 pada 09.47
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approve`
--

CREATE TABLE `approve` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `agt_klrg` varchar(300) NOT NULL,
  `tgl_30` date NOT NULL,
  `tgl_validity` date NOT NULL,
  `approv` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `approve`
--

INSERT INTO `approve` (`id`, `nama`, `jabatan`, `unit`, `agt_klrg`, `tgl_30`, `tgl_validity`, `approv`) VALUES
(3321, 'Jeni', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28', 'Approved'),
(22321, 'Dimas', 'Kepala', 'FOO', 'Ajeng', '2019-09-06', '2019-09-06', 'Approved'),
(33685, 'gdds', 'Kepala', 'FOO', 'Ajeng', '2019-07-19', '2019-07-27', NULL),
(43246, 'Junifer', 'Kepala', 'FOO', 'Ajeng', '2019-09-06', '2019-09-06', 'Approved'),
(98823, 'Taruh', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28', 'Approved'),
(321442, 'rredd', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `crew`
--

CREATE TABLE `crew` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `agt_klrg` varchar(500) NOT NULL,
  `tgl_30` date NOT NULL,
  `tgl_validity` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `crew`
--

INSERT INTO `crew` (`id`, `nama`, `jabatan`, `unit`, `agt_klrg`, `tgl_30`, `tgl_validity`) VALUES
(3321, 'Jeni', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28'),
(22321, 'Dimas', 'Kepala', 'FOO', 'Ajeng', '2019-09-06', '2019-09-06'),
(33685, 'gdds', 'Kepala', 'FOO', 'Ajeng', '2019-07-19', '2019-07-27'),
(43246, 'Junifer', 'Kepala', 'FOO', 'Ajeng', '2019-09-06', '2019-09-06'),
(98823, 'Taruh', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28'),
(321442, 'rredd', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keberangkatan`
--

CREATE TABLE `keberangkatan` (
  `id` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `agt_klrg` varchar(300) NOT NULL,
  `tgl_30` date NOT NULL,
  `tgl_validity` date NOT NULL,
  `approv` varchar(15) NOT NULL,
  `tgl_ambil` date NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `tgl_brngkt` date NOT NULL,
  `tgl_plng` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keberangkatan`
--

INSERT INTO `keberangkatan` (`id`, `nama`, `jabatan`, `unit`, `agt_klrg`, `tgl_30`, `tgl_validity`, `approv`, `tgl_ambil`, `tujuan`, `tgl_brngkt`, `tgl_plng`) VALUES
('22321', 'Dimas', 'Kepala', 'FOO', 'Ajeng', '2019-09-06', '2019-09-06', 'Approved', '0000-00-00', '', '0000-00-00', '0000-00-00'),
('3321', 'Jeni', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28', 'Approved', '2019-10-08', 'Bekasiiis', '2019-10-16', '2019-10-25'),
('43246', 'Junifer', 'Kepala', 'FOO', 'Ajeng', '2019-09-06', '2019-09-06', 'Approved', '2019-10-08', 'Bekasi', '2019-10-09', '2019-10-29'),
('98823', 'Taruh', 'Wakil', 'Kokpit', 'Dodit', '2019-09-06', '2019-09-28', 'Approved', '0000-00-00', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Full Akses'),
(2, 'jktid', '6438dc4a2e9dd1adbcccc12f083889dd', 'Approval'),
(3, 'agi', '370790335a0538fc3fc5a7b522b050de', 'Keberangkatan'),
(20, 'erds', '827ccb0eea8a706c4c34a16891f84e7b', 'Approval'),
(21, 'kourw', '827ccb0eea8a706c4c34a16891f84e7b', 'Approval');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approve`
--
ALTER TABLE `approve`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keberangkatan`
--
ALTER TABLE `keberangkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
