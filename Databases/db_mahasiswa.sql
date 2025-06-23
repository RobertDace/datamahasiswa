-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2025 pada 17.43
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akademik_jurusan`
--

CREATE TABLE `akademik_jurusan` (
  `id_jurusan` int(2) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akademik_jurusan`
--

INSERT INTO `akademik_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Teknik Informatika'),
(2, 'Sistem Informasi'),
(3, 'Teknik Elektro'),
(4, 'Manajemen'),
(5, 'Akuntansi'),
(6, 'Ilmu Komputer'),
(7, 'Pendidikan'),
(8, 'Bahasa Inggris'),
(9, 'Ilmu Hukum'),
(10, 'Teknik Mesin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akademik_mahasiswa`
--

CREATE TABLE `akademik_mahasiswa` (
  `nim` varchar(9) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `agama` varchar(1) DEFAULT NULL,
  `kelamin` varchar(1) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_prodi` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akademik_mahasiswa`
--

INSERT INTO `akademik_mahasiswa` (`nim`, `nama`, `tgl_lahir`, `alamat`, `agama`, `kelamin`, `no_hp`, `email`, `id_prodi`) VALUES
('220000002', 'Budi Santoso', '2003-02-02', 'Jl. Melati 2', 'I', 'L', '081234567891', 'budi@mail.com', 2),
('220000003', 'Citra Dewi', '2003-03-03', 'Jl. Kenanga 3', 'I', 'P', '081234567892', 'citra@mail.com', 3),
('220000004', 'Dewi Lestari', '2003-04-04', 'Jl. Anggrek 4', 'I', 'P', '081234567893', 'dewi@mail.com', 4),
('220000005', 'Eko Prasetyo', '2003-05-05', 'Jl. Dahlia 5', 'I', 'L', '081234567894', 'eko@mail.com', 5),
('220000006', 'Fajar Nugroho', '2003-06-06', 'Jl. Flamboyan 6', 'I', 'L', '081234567895', 'fajar@mail.com', 6),
('220000007', 'Gita Sari', '2003-07-07', 'Jl. Bougenville 7', 'I', 'P', '081234567896', 'gita@mail.com', 7),
('220000008', 'Hadi Saputra', '2003-08-08', 'Jl. Kamboja 8', 'I', 'L', '081234567897', 'hadi@mail.com', 8),
('220000009', 'Intan Permata', '2003-09-09', 'Jl. Teratai 9', 'I', 'P', '081234567898', 'intan@mail.com', 9),
('220000010', 'Joko Susilo', '2003-10-10', 'Jl. Soka 10', 'I', 'L', '081234567899', 'joko@mail.com', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akademik_prodi`
--

CREATE TABLE `akademik_prodi` (
  `id_prodi` int(2) NOT NULL,
  `nama_prodi` varchar(40) NOT NULL,
  `id_jurusan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akademik_prodi`
--

INSERT INTO `akademik_prodi` (`id_prodi`, `nama_prodi`, `id_jurusan`) VALUES
(1, 'Informatika D3', 1),
(2, 'Sistem Informasi S1', 2),
(3, 'Elektro S1', 3),
(4, 'Manajemen Bisnis D3', 4),
(5, 'Akuntansi D3', 5),
(6, 'Komputerisasi Akuntansi D3', 5),
(7, 'Pendidikan Komputer', 7),
(8, 'Bahasa Inggris D3', 8),
(9, 'Ilmu Hukum S1', 9),
(10, 'Teknik Mesin S1', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` varchar(30) NOT NULL,
  `passw` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `passw`, `nama`) VALUES
('Robertt', '$2y$10$lb7Er79hOHB9R7fpN586Z.ukJ9XUJ7XPmPH2idUBbAOkB/SMqjmB.', 'Alfian Robit Nadifi Masyhudi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akademik_jurusan`
--
ALTER TABLE `akademik_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `akademik_mahasiswa`
--
ALTER TABLE `akademik_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indeks untuk tabel `akademik_prodi`
--
ALTER TABLE `akademik_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akademik_mahasiswa`
--
ALTER TABLE `akademik_mahasiswa`
  ADD CONSTRAINT `akademik_mahasiswa_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `akademik_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `akademik_prodi`
--
ALTER TABLE `akademik_prodi`
  ADD CONSTRAINT `akademik_prodi_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `akademik_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
