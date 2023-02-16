-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Jul 2022 pada 05.07
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axo_mo_produksi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_akun`
--

CREATE TABLE `tm_akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text,
  `is_active` enum('0','1') DEFAULT '1',
  `user_dir` text,
  `tgl_create` datetime DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_akun`
--

INSERT INTO `tm_akun` (`id_akun`, `nama`, `role`, `email`, `password`, `is_active`, `user_dir`, `tgl_create`, `tgl_update`) VALUES
(1, 'Super Admin', 1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '1', 'dir_78852fa8789de7e', NULL, '2022-06-27 15:12:01'),
(3, 'Admin Produksi', 2, 'produksi@admin.com', '21232f297a57a5a743894a0e4a801fc3', '1', 'dir_326e77575ec3573', '2022-06-07 09:28:23', NULL),
(4, 'Admin PO', 3, 'po@admin.com', '21232f297a57a5a743894a0e4a801fc3', '1', 'dir_319e77575ec3573', '2022-06-10 08:55:26', '2022-06-10 08:56:03'),
(5, 'Manager', 4, 'manager@admin.com', '21232f297a57a5a743894a0e4a801fc3', '1', NULL, '2022-06-14 07:41:48', NULL),
(8, 'Putra', 4, 'setyap77@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1', 'dir_99391b3b0325353', '2022-07-20 11:52:14', '2022-07-20 04:57:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_barang`
--

CREATE TABLE `tm_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_barang`
--

INSERT INTO `tm_barang` (`id`, `nama`, `create_date`) VALUES
(1, 'Open Rack Cabinet', '2022-06-17 06:21:41'),
(2, 'Lavatory Cabinet', '2022-06-17 06:21:41'),
(3, 'Full High Cabinet', '2022-06-20 11:34:00'),
(4, 'Sofa Enay-enay', '2022-06-30 14:59:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_customer`
--

CREATE TABLE `tm_customer` (
  `id` int(11) NOT NULL,
  `kd_cust` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_customer`
--

INSERT INTO `tm_customer` (`id`, `kd_cust`, `nama`, `create_date`) VALUES
(1, 'CUST2022001', 'Imam', '2022-06-16 09:12:52'),
(2, 'CUST2022002', 'Rifky', '2022-06-16 09:12:52'),
(3, 'CUST2022003', 'Faisal', '2022-06-17 14:36:49'),
(4, 'CUST2022004', 'Sintia', '2022-06-17 14:39:20'),
(5, 'CUST2022005', 'Putra', '2022-06-27 11:12:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_jenis_barang`
--

CREATE TABLE `tm_jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis_barang` varchar(225) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_jenis_barang`
--

INSERT INTO `tm_jenis_barang` (`id`, `jenis_barang`, `create_date`) VALUES
(1, 'Living Room', '2022-06-17 06:28:22'),
(2, 'Study Room', '2022-06-17 06:28:22'),
(3, 'Bathroom', '2022-06-17 06:28:22'),
(4, 'Bed Room', '2022-06-17 16:18:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_role`
--

CREATE TABLE `tm_role` (
  `id_role` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_create` datetime DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_role`
--

INSERT INTO `tm_role` (`id_role`, `nama`, `tgl_create`, `tgl_update`) VALUES
(1, 'Super Admin', NULL, NULL),
(2, 'Admin Produksi', NULL, NULL),
(3, 'Admin PO', NULL, NULL),
(4, 'Manager', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_settings`
--

CREATE TABLE `tm_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  `desc` text,
  `tgl_create` datetime DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_settings`
--

INSERT INTO `tm_settings` (`id`, `name`, `value`, `desc`, `tgl_create`, `tgl_update`) VALUES
(1, 'about_school_title', 'Selamat Datang di PPDB MTS Al-Qur\'aniyah Ulujami', NULL, NULL, '2022-06-09 08:43:26'),
(2, 'about_school_desc', 'Madrasah Tsanawiyah Al Quraniyah Ulujami memiliki staf pengajar guru yang kompeten pada bidang pelajarannya sehingga berkualitas dan menjadi salah satu yang terbaik di Kota Jakarta Selatan.\r\n<br>\r\nMerupakan sekolah yang melayani pengajaran jenjang pendidikan Sekolah Menengah Pertama (SMP) di Kota Jakarta Selatan. Adapun pelajaran yang diberikan meliputi semua mata pelajaran wajib sesuai kurikulum nasional dengan tambahan nilai-nilai agama Islam.', NULL, NULL, '2022-06-09 08:43:26'),
(3, 'contact_address', 'Jl. H. Ridi Jl. Swadarma Raya No.49, RT.15/RW.3, Ulujami, Kec. Pesanggrahan, Kota Jakarta Selatan', NULL, NULL, '2022-06-15 04:22:23'),
(4, 'contact_phone', '(021) 5868268', NULL, NULL, '2022-06-15 04:22:23'),
(5, 'contact_email', 'mtsalquraniyah@gmail.com', NULL, NULL, '2022-06-15 04:22:23'),
(6, 'school_name', 'Madrasah Tsanawiyah Al-Qur\'aniyah Ulujami', NULL, NULL, '2022-06-09 09:12:19'),
(7, 'school_desc', 'Merupakan sekolah yang melayani pengajaran jenjang pendidikan Sekolah Menengah Pertama (SMP) di Kota Jakarta Selatan. Adapun pelajaran yang diberikan meliputi semua mata pelajaran wajib sesuai kurikulum nasional dengan tambahan nilai-nilai agama Islam. Madrasah Tsanawiyah Al Quraniyah Ulujami memiliki staf pengajar guru yang kompeten pada bidang pelajarannya sehingga berkualitas dan menjadi salah satu yang terbaik di Kota Jakarta Selatan.', NULL, NULL, '2022-06-09 09:12:19'),
(8, 'berkas_status_review', 'Berkas sedang di verifikasi', NULL, NULL, '2022-06-11 14:28:22'),
(9, 'berkas_status_approved', 'Berkas sudah di verifikasi', NULL, NULL, '2022-06-11 14:28:22'),
(10, 'school_logo', 'logo.png', NULL, NULL, '2022-06-09 09:12:19'),
(11, 'about_school_image', 'guru.jpg', NULL, NULL, '2022-06-09 08:35:43'),
(12, 'berkas_status_rejected', 'Berkas tidak lolos diseleksi', NULL, NULL, '2022-06-11 14:28:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_slider`
--

CREATE TABLE `tm_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `image` text,
  `is_active` enum('0','1') DEFAULT '1',
  `tgl_create` datetime DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_slider`
--

INSERT INTO `tm_slider` (`id`, `title`, `subtitle`, `desc`, `image`, `is_active`, `tgl_create`, `tgl_update`) VALUES
(1, 'Pendaftaran Online', 'Madrasah Tsanawiyah Al-Qur\'aniyah Ulujami', 'Merupakan sekolah yang melayani pengajaran jenjang pendidikan Sekolah Menengah Pertama (SMP) di Kota Jakarta Selatan. Adapun pelajaran yang diberikan meliputi semua mata pelajaran wajib sesuai kurikulum nasional dengan tambahan nilai-nilai agama Islam.', 'siswa-1.jpg', '1', '2022-06-08 12:43:14', '2022-06-08 08:05:48'),
(2, 'Pendaftaran Online', 'Madrasah Tsanawiyah Al-Qur\'aniyah Ulujami', 'Madrasah Tsanawiyah Al Quraniyah Ulujami memiliki staf pengajar guru yang kompeten pada bidang pelajarannya sehingga berkualitas dan menjadi salah satu yang terbaik di Kota Jakarta Selatan.', 'siswa-2.jpg', '1', NULL, '2022-06-09 05:30:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_status_produksi`
--

CREATE TABLE `tm_status_produksi` (
  `id` int(11) NOT NULL,
  `jenis_pekerjaan` varchar(225) NOT NULL,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_status_produksi`
--

INSERT INTO `tm_status_produksi` (`id`, `jenis_pekerjaan`, `bobot`) VALUES
(1, 'New Project', 0),
(2, 'Pengukuran', 20),
(3, 'Cutting', 40),
(4, 'Perakitan', 60),
(5, 'Finishing', 80),
(6, 'Selesai', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_project`
--

CREATE TABLE `tr_project` (
  `id` int(11) NOT NULL,
  `kd_proj` varchar(25) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `type_work` int(11) NOT NULL COMMENT '1 = workshop, 2 = other',
  `date_project` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `tgl_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_project`
--

INSERT INTO `tr_project` (`id`, `kd_proj`, `id_cust`, `type_work`, `date_project`, `created_by`, `tgl_update`, `tgl_create`) VALUES
(1, 'PROJ-2022001', 2, 1, '2022-08-06', 1, NULL, '2022-07-13 11:43:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_project_dtl`
--

CREATE TABLE `tr_project_dtl` (
  `id_proj_dtl` int(11) NOT NULL,
  `id_proj` int(11) NOT NULL COMMENT 'reff id tr_project',
  `id_jenis_barang` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `ukuran` text NOT NULL,
  `warna` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `stat_produksi` int(11) DEFAULT NULL COMMENT 'Join tm_status_produksi',
  `file_poto` text,
  `pengecekan` int(11) DEFAULT NULL COMMENT '0 = Belum Dicek,\r\n1 = Ok, 2= Perbaikan',
  `tgl_update` datetime DEFAULT NULL,
  `tgl_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_project_dtl`
--

INSERT INTO `tr_project_dtl` (`id_proj_dtl`, `id_proj`, `id_jenis_barang`, `id_brg`, `ukuran`, `warna`, `keterangan`, `stat_produksi`, `file_poto`, `pengecekan`, `tgl_update`, `tgl_create`) VALUES
(1, 1, 1, 1, '1000', 'hitam', 'ket1', 6, 'poto_1657857059.4255.png', 0, '2022-07-15 15:48:11', '2022-07-13 11:43:51'),
(2, 1, 2, 2, '200', 'merah', 'ket2\nket3', 1, '-', NULL, NULL, '2022-07-13 11:43:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tm_akun`
--
ALTER TABLE `tm_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `tm_barang`
--
ALTER TABLE `tm_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tm_customer`
--
ALTER TABLE `tm_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tm_jenis_barang`
--
ALTER TABLE `tm_jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tm_role`
--
ALTER TABLE `tm_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tm_settings`
--
ALTER TABLE `tm_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `tm_slider`
--
ALTER TABLE `tm_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tm_status_produksi`
--
ALTER TABLE `tm_status_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tr_project`
--
ALTER TABLE `tr_project`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `tr_project_dtl`
--
ALTER TABLE `tr_project_dtl`
  ADD PRIMARY KEY (`id_proj_dtl`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tm_akun`
--
ALTER TABLE `tm_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tm_barang`
--
ALTER TABLE `tm_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tm_customer`
--
ALTER TABLE `tm_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tm_jenis_barang`
--
ALTER TABLE `tm_jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tm_role`
--
ALTER TABLE `tm_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tm_settings`
--
ALTER TABLE `tm_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tm_slider`
--
ALTER TABLE `tm_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tm_status_produksi`
--
ALTER TABLE `tm_status_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tr_project`
--
ALTER TABLE `tr_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tr_project_dtl`
--
ALTER TABLE `tr_project_dtl`
  MODIFY `id_proj_dtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
