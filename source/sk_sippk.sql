-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2019 pada 18.43
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_sippk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `client`
--

CREATE TABLE `client` (
  `id_client` varchar(8) NOT NULL,
  `nama_perusahaan` varchar(30) NOT NULL,
  `penanggung_jawab` varchar(30) NOT NULL,
  `alamat_perusahaan` varchar(100) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `npwp` varchar(25) NOT NULL,
  `mou` text NOT NULL,
  `logo_perusahaan` text NOT NULL,
  `website` varchar(100) NOT NULL,
  `nama_pic` varchar(30) NOT NULL,
  `email_pic` varchar(30) NOT NULL,
  `telepon_pic` varchar(15) NOT NULL,
  `email_perusahaan` varchar(30) NOT NULL,
  `username` varchar(5) NOT NULL,
  `password` varchar(15) NOT NULL,
  `expired_date` date NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `token` varchar(20) NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruction`
--

CREATE TABLE `instruction` (
  `no_si` varchar(20) NOT NULL,
  `id_schedule` varchar(15) NOT NULL,
  `owner_barge` varchar(50) NOT NULL,
  `owner_barge_address` varchar(200) NOT NULL,
  `consignee` varchar(50) NOT NULL,
  `consignee_address` varchar(200) NOT NULL,
  `commodity` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `port_loading` varchar(50) NOT NULL,
  `port_discharge` varchar(50) NOT NULL,
  `doc_required` varchar(200) NOT NULL,
  `tug_boat` varchar(30) NOT NULL,
  `barge_name` varchar(50) NOT NULL,
  `signature` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(10) NOT NULL,
  `user` varchar(11) NOT NULL,
  `id_ref` varchar(15) NOT NULL,
  `refrensi` varchar(30) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` varchar(15) NOT NULL,
  `id_client` varchar(8) NOT NULL,
  `plan_date` date NOT NULL,
  `plan_tonage` int(11) NOT NULL,
  `confirmed_date` date NOT NULL,
  `status` enum('Proccess','Confirmed','Complete','Cancel by Client','Cancel by Admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey`
--

CREATE TABLE `survey` (
  `id_survey` varchar(15) NOT NULL,
  `no_si` varchar(20) NOT NULL,
  `total_loaded` int(11) NOT NULL,
  `document` text NOT NULL,
  `actual_date` date NOT NULL,
  `actual_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('Helpdesk','Admin','Agent','Manager','Accounting') NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(15) NOT NULL,
  `foto` text NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`, `tgl_registrasi`, `phone`, `foto`, `status`, `token`) VALUES
('ADMSLR001', 'Helpdesk', 'helpdesk', 'helpdesk', 'Helpdesk', '2019-04-13 18:22:52', '628987748441', 'user.jpg', 'Aktif', '875a8f2f42c570f');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `email_perusahaan` (`email_perusahaan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `instruction`
--
ALTER TABLE `instruction`
  ADD PRIMARY KEY (`no_si`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `user` (`user`);

--
-- Indeks untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_client` (`id_client`);

--
-- Indeks untuk tabel `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`),
  ADD KEY `no_si` (`no_si`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `instruction`
--
ALTER TABLE `instruction`
  ADD CONSTRAINT `instruction_ibfk_1` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`);

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Ketidakleluasaan untuk tabel `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`no_si`) REFERENCES `instruction` (`no_si`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
