-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Feb 2017 pada 06.24
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsimpeg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `id_agama` smallint(6) NOT NULL,
  `nama_agama` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_pegawai`
--

CREATE TABLE `tbl_detail_pegawai` (
  `id_pegawai` smallint(6) DEFAULT NULL,
  `id_jabatan` smallint(6) DEFAULT NULL,
  `id_pangkat` smallint(6) DEFAULT NULL,
  `id_jenjang_pendidikan` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` smallint(6) NOT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan_pegawai`
--

CREATE TABLE `tbl_jabatan_pegawai` (
  `id_jabatan_pegawai` smallint(6) NOT NULL,
  `id_pegawai` smallint(6) NOT NULL,
  `id_jabatan` smallint(6) NOT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `no_sk` varchar(25) DEFAULT NULL,
  `sk` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenjang_pendidikan`
--

CREATE TABLE `tbl_jenjang_pendidikan` (
  `id_jenjang_pendidikan` smallint(6) NOT NULL,
  `nama_pendidikan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pangkat`
--

CREATE TABLE `tbl_pangkat` (
  `id_pangkat` smallint(6) NOT NULL,
  `nama_pangkat` varchar(50) DEFAULT NULL,
  `golongan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` smallint(6) NOT NULL,
  `id_user` smallint(6) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_status_pegawai` smallint(11) NOT NULL,
  `id_satker` smallint(11) NOT NULL,
  `id_agama` smallint(11) NOT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  `jenkel` enum('Pria','Wanita') DEFAULT NULL,
  `status_nikah` enum('Nikah','Belum Nikah') DEFAULT NULL,
  `gol_darah` enum('A','B','O','AB') DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `foto` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pendidikan_pegawai`
--

CREATE TABLE `tbl_pendidikan_pegawai` (
  `id_pendidikan` smallint(6) NOT NULL,
  `id_pegawai` smallint(6) DEFAULT NULL,
  `id_jenjang_pendidikan` smallint(6) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `tahun_lulus` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pensiunan_pegawai`
--

CREATE TABLE `tbl_pensiunan_pegawai` (
  `id_pensiunan_pegawai` smallint(6) NOT NULL,
  `id_pegawai` smallint(6) NOT NULL,
  `usia_pensiun` smallint(6) DEFAULT NULL,
  `tgl_pensiun` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan_kerja`
--

CREATE TABLE `tbl_satuan_kerja` (
  `id_satker` smallint(6) NOT NULL,
  `nama_satker` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status_pegawai`
--

CREATE TABLE `tbl_status_pegawai` (
  `id_status_pegawai` smallint(6) NOT NULL,
  `nama_status_pegawai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` smallint(6) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `tbl_detail_pegawai`
--
ALTER TABLE `tbl_detail_pegawai`
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_jenjang_pendidikan` (`id_jenjang_pendidikan`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tbl_jabatan_pegawai`
--
ALTER TABLE `tbl_jabatan_pegawai`
  ADD PRIMARY KEY (`id_jabatan_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_jenjang_pendidikan`
--
ALTER TABLE `tbl_jenjang_pendidikan`
  ADD PRIMARY KEY (`id_jenjang_pendidikan`);

--
-- Indexes for table `tbl_pangkat`
--
ALTER TABLE `tbl_pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_status_pegawai` (`id_status_pegawai`,`id_satker`,`id_agama`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_satker` (`id_satker`);

--
-- Indexes for table `tbl_pendidikan_pegawai`
--
ALTER TABLE `tbl_pendidikan_pegawai`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD UNIQUE KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_pensiunan_pegawai`
--
ALTER TABLE `tbl_pensiunan_pegawai`
  ADD PRIMARY KEY (`id_pensiunan_pegawai`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_satuan_kerja`
--
ALTER TABLE `tbl_satuan_kerja`
  ADD PRIMARY KEY (`id_satker`),
  ADD KEY `id_satker` (`id_satker`);

--
-- Indexes for table `tbl_status_pegawai`
--
ALTER TABLE `tbl_status_pegawai`
  ADD PRIMARY KEY (`id_status_pegawai`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  MODIFY `id_agama` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_jabatan_pegawai`
--
ALTER TABLE `tbl_jabatan_pegawai`
  MODIFY `id_jabatan_pegawai` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_jenjang_pendidikan`
--
ALTER TABLE `tbl_jenjang_pendidikan`
  MODIFY `id_jenjang_pendidikan` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pangkat`
--
ALTER TABLE `tbl_pangkat`
  MODIFY `id_pangkat` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pendidikan_pegawai`
--
ALTER TABLE `tbl_pendidikan_pegawai`
  MODIFY `id_pendidikan` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pensiunan_pegawai`
--
ALTER TABLE `tbl_pensiunan_pegawai`
  MODIFY `id_pensiunan_pegawai` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_satuan_kerja`
--
ALTER TABLE `tbl_satuan_kerja`
  MODIFY `id_satker` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_status_pegawai`
--
ALTER TABLE `tbl_status_pegawai`
  MODIFY `id_status_pegawai` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD CONSTRAINT `tbl_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pendidikan_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
