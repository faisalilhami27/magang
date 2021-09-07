-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2018 pada 11.35
-- Versi server: 5.7.19
-- Versi PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(30, 1, 2),
(31, 1, 10),
(32, 1, 11),
(33, 1, 12),
(42, 1, 15),
(43, 1, 14),
(50, 2, 14),
(51, 2, 15),
(66, 2, 25),
(68, 2, 21),
(74, 1, 3),
(75, 1, 4),
(76, 1, 5),
(77, 1, 6),
(79, 1, 8),
(80, 1, 21),
(81, 1, 23),
(82, 1, 24),
(84, 2, 8),
(86, 2, 7),
(88, 2, 23),
(90, 1, 7),
(92, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keperluan`
--

CREATE TABLE `tbl_keperluan` (
  `id_keperluan` int(11) NOT NULL,
  `nama_keperluan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_keperluan`
--

INSERT INTO `tbl_keperluan` (`id_keperluan`, `nama_keperluan`) VALUES
(1, 'Penelitian '),
(2, 'Wawancara dan Data'),
(3, 'Penyebaran Kuesioner'),
(4, 'Kerja Praktik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konfigurasi`
--

CREATE TABLE `tbl_konfigurasi` (
  `id` int(11) NOT NULL,
  `nama_kadis` varchar(50) NOT NULL,
  `nip_kadis` varchar(50) NOT NULL,
  `pangkat_kadis` varchar(50) NOT NULL,
  `nama_instansi` varchar(80) NOT NULL,
  `alamat_instansi` text NOT NULL,
  `logo_instansi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_konfigurasi`
--

INSERT INTO `tbl_konfigurasi` (`id`, `nama_kadis`, `nip_kadis`, `pangkat_kadis`, `nama_instansi`, `alamat_instansi`, `logo_instansi`) VALUES
(1, 'H. ISKANDAR ZULKARNAIN ,ST,MM ', '19690614 199703 1 006', 'Pembina Utama Muda ', 'DINAS PENATAAN RUANG KOTA BANDUNG', 'Jl. Cianjur No 34 Telp. (022) 7217451 Fax. (022) 7278801 Bandung', 'dtr.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `id_anggota` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `nama_anggota` varchar(40) NOT NULL,
  `jurusan` varchar(40) NOT NULL,
  `kampus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`id_anggota`, `id_surat`, `npm`, `nama_anggota`, `jurusan`, `kampus`) VALUES
(2, 2, '153040044', 'Muhamad Faisal I A', 'Teknik Informatika', 'Universitas Pasundan'),
(3, 3, '153040001', 'Muhammad Al Fatih', 'Militer Perang Islam', 'Universitas Al Azhar'),
(4, 3, '153040002', 'Shalahudin Al Ayubi', 'Militer Perang Islam', 'Universitas Al Azhar'),
(5, 3, '153040003', 'Ali Bin Abi Tahlib', 'Militer Perang Islam', 'Universitas Al Azhar'),
(6, 3, '153040004', 'Usman Bin Affan', 'Militer Perang Islam', 'Universitas Al Azhar'),
(7, 3, '153040005', 'Khalid Bin Walid', 'Militer Perang Islam', 'Universitas Al Azhar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'Dashboard', 'welcome', 'fa fa-dashboard', 0, 'y'),
(2, 'Level Pengguna', 'userlevel', 'fa fa-users', 0, 'y'),
(3, 'Kelola Pengguna', 'user', 'fa fa-user', 0, 'y'),
(4, 'Kelola Menu', 'kelolamenu', 'fa fa-server', 0, 'y'),
(5, 'Keperluan', 'keperluan', 'fa  fa-archive', 0, 'y'),
(6, 'Permohonan Mahasiswa', 'permohonan', 'fa fa-laptop', 0, 'y'),
(7, 'Daftar  Semua Mahasiswa', 'anggota', 'fa fa-user-o', 0, 'y'),
(8, 'Surat Selesai KP', 'surat', 'fa fa-envelope', 0, 'y'),
(21, 'Lockscreen', 'lockscreen', 'fa fa-user', 0, 'n'),
(23, 'Konfigurasi Website', 'konfigurasi', 'fa fa-gear', 0, 'y'),
(24, 'Panduan Pengguna', 'panduan', 'fa fa-hand-paper-o', 0, 'y'),
(25, 'Profile', 'profile', 'fa fa-dashboard', 0, 'n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_permohonan`
--

CREATE TABLE `tbl_permohonan` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `keperluan` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `rincian_keperluan` text,
  `gambar` text,
  `tanggal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `no_hp` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_permohonan`
--

INSERT INTO `tbl_permohonan` (`id`, `id_anggota`, `email`, `keperluan`, `status`, `rincian_keperluan`, `gambar`, `tanggal`, `tanggal_akhir`, `no_hp`) VALUES
(2, 2, 'zalz.barca73@gmail.com', 4, 3, 'testing', '10721.jpg', '2018-10-22', '2018-10-31', '085723948294'),
(3, 3, 'zalz.barca73@gmail.com', 4, 3, 'testing', 'arsitektur_android_12.png', '2018-10-24', '2018-10-26', '08634938389');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_status`
--

INSERT INTO `tbl_status` (`id_status`, `nama_status`) VALUES
(1, 'diterima'),
(2, 'menunggu konfirmasi'),
(3, 'ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_selesai_kp`
--

CREATE TABLE `tbl_surat_selesai_kp` (
  `id_surat` int(11) NOT NULL,
  `no_surat` varchar(30) DEFAULT NULL,
  `nama_pendaftar` varchar(50) NOT NULL,
  `sifat` varchar(6) NOT NULL,
  `lampiran` int(11) NOT NULL,
  `kepada` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_surat_kampus` date NOT NULL,
  `tgl_surat_kesbangpol` date NOT NULL,
  `no_kesbangpol` varchar(30) NOT NULL,
  `no_surat_kampus` varchar(100) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_surat_selesai_kp`
--

INSERT INTO `tbl_surat_selesai_kp` (`id_surat`, `no_surat`, `nama_pendaftar`, `sifat`, `lampiran`, `kepada`, `kota`, `alamat`, `tgl_surat`, `tgl_surat_kampus`, `tgl_surat_kesbangpol`, `no_kesbangpol`, `no_surat_kampus`, `tgl_mulai`, `tgl_selesai`) VALUES
(2, '800 / 0001 -Distaru', '2', 'Biasa', 0, 'Program Studi Teknik Informatika Universitas Pasundan Jalan Setiabudhi No. 193 Bandung', 'Bandung', 'Jalan Setiabudhi No. 193 Bandung', '2018-10-23', '2018-10-01', '2018-10-26', '093 / 039 / Bakesbangpol', '0213 / TU / IF / 2018', '2018-10-22', '2018-10-31'),
(3, '800 / 0002 -Distaru', '3', 'Biasa', 0, 'Program Studi Militer Perang Islam Universitas Al Azhar Jalan Salemba Raya No. 94 Jakarta Selatan', 'Jakarta', 'Jalan Salemba Raya No. 94 Jakarta Selatan', '2018-10-23', '2018-10-24', '2018-10-26', '043 / 039 / Bakesbangpol', '0413 / TU / IF / 2018', '2018-10-24', '2018-10-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(7, 'Muhamad Faisal I A', 'faisal.ilhami1997@gmail.com', '$2y$10$e10C8A.yct0tLISy.E002upk5SOLeXT7oO9KCC9H6JM/TEUpCMjFW', 'DSC_0012_1.png', 1, 'y'),
(8, 'Kepegawaian', 'distarubdg@gmail.com', '$2y$10$htk/7tIoQ7JEY8Pl/QUsOufgTBuqIMq4YhQJKsFTPQ6Uvgf5wZTGa', 'bar.jpg', 2, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Kepegawaian');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_hak_akses` (`id_user_level`);

--
-- Indeks untuk tabel `tbl_keperluan`
--
ALTER TABLE `tbl_keperluan`
  ADD PRIMARY KEY (`id_keperluan`);

--
-- Indeks untuk tabel `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_permohonan`
--
ALTER TABLE `tbl_permohonan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `tbl_surat_selesai_kp`
--
ALTER TABLE `tbl_surat_selesai_kp`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `tbl_keperluan`
--
ALTER TABLE `tbl_keperluan`
  MODIFY `id_keperluan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_permohonan`
--
ALTER TABLE `tbl_permohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_selesai_kp`
--
ALTER TABLE `tbl_surat_selesai_kp`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD CONSTRAINT `tbl_hak_akses` FOREIGN KEY (`id_user_level`) REFERENCES `tbl_user_level` (`id_user_level`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
