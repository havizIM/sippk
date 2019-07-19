-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2019 pada 17.12
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
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` bigint(20) NOT NULL,
  `chat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chat_desc` text NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `status_chat` enum('unread','read','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data untuk tabel `client`
--

INSERT INTO `client` (`id_client`, `nama_perusahaan`, `penanggung_jawab`, `alamat_perusahaan`, `kode_pos`, `telepon`, `fax`, `npwp`, `mou`, `logo_perusahaan`, `website`, `nama_pic`, `email_pic`, `telepon_pic`, `email_perusahaan`, `username`, `password`, `expired_date`, `status`, `token`, `tgl_registrasi`) VALUES
('CL-00001', 'PT. CodeManiac', 'Haviz Indra Maulana', 'Jakarta Pusat', '112100', '1273921793122', '1236281468122', '1279127409184312', 'CL-00001.pdf', 'CL-00001.jpg', 'https://codemaniac.co.id', 'Yugi Setiawan', 'yugi@gmail.com', '081246126418', 'viz.ndinq@gmail.com', 'PCMA', 'xl2nw', '2020-01-02', 'Aktif', 'e69b76f88179856c6e84', '2019-04-23 16:30:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruction`
--

CREATE TABLE `instruction` (
  `no_si` varchar(20) NOT NULL,
  `id_schedule` varchar(10) NOT NULL,
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

--
-- Dumping data untuk tabel `instruction`
--

INSERT INTO `instruction` (`no_si`, `id_schedule`, `owner_barge`, `owner_barge_address`, `consignee`, `consignee_address`, `commodity`, `qty`, `port_loading`, `port_discharge`, `doc_required`, `tug_boat`, `barge_name`, `signature`, `create_at`) VALUES
('SI-0719-PCMA-001', 'S--1759672', 'Yaaayayayaaaaa', 'ascascas', 'asdascas', 'asdasdasdsa', 'adgsfbak', 1624812, 'adgbidangvlda', 'badbvkldank', 'andkfngadknf\r\nadgbiadnbgdafda\r\nadgidahogadn', 'hdainvkadnvk', 'dkanvldanvadva', '', '2019-07-03 20:42:55'),
('SI-0719-PCMA-002', 'S-14409129', 'PT Maju Mundur Indonesi', 'Jl. Coba coba', 'PT. Penerima Indonesia', 'Jl. Penerima ajah', 'Coal Mateng', 999, 'SDJ Jetty', 'Tanjung Priuk', '- SKCK\r\n- KTP\r\n- NPWP', 'A2012912', 'Coba Ahhh', '', '2019-07-07 04:25:13'),
('SI-0719-PCMA-003', 'S-18047005', '123', '123', '123123', '123', '123', 123, 'SDJ Jetty', '123', '123', '123', '123', 'SI-0719-PCMA-003.png', '2019-07-19 11:34:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `user` varchar(11) NOT NULL,
  `id_ref` varchar(15) NOT NULL,
  `refrensi` varchar(30) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `user`, `id_ref`, `refrensi`, `keterangan`, `kategori`, `tgl_log`) VALUES
(1, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-14 14:13:16'),
(2, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-14 19:28:12'),
(3, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 05:52:59'),
(4, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 05:56:13'),
(5, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 07:03:46'),
(6, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 07:04:53'),
(7, 'USR00000001', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Change Password', '2019-04-15 07:36:23'),
(8, 'USR00000001', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Change Password', '2019-04-15 07:37:18'),
(9, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 09:50:37'),
(10, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 09:52:48'),
(11, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 10:00:04'),
(12, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 10:12:12'),
(13, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 16:51:01'),
(14, 'USR00000001', 'USR00000002', 'User', 'Menambah data user baru', 'Add', '2019-04-15 17:14:57'),
(15, 'USR00000001', 'USR00000003', 'User', 'Menambah data user baru', 'Add', '2019-04-15 17:17:04'),
(16, 'USR00000001', 'USR00000004', 'User', 'Menambah data user baru', 'Add', '2019-04-15 17:18:17'),
(17, 'USR00000001', 'USR00000002', 'User', 'Menghapus data user baru', 'Delete', '2019-04-15 17:22:05'),
(18, 'USR00000001', 'USR00000004', 'User', 'Mengedit data user', 'Edit', '2019-04-15 17:22:46'),
(19, 'USR00000001', 'USR00000004', 'User', 'Mengedit data user', 'Edit', '2019-04-15 17:52:45'),
(20, 'USR00000001', 'USR00000004', 'User', 'Mengedit data user', 'Edit', '2019-04-15 17:53:07'),
(21, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:01:40'),
(22, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:01:55'),
(23, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:03:33'),
(24, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:03:39'),
(25, 'USR00000001', 'USR00000004', 'User', 'Mengedit data user', 'Edit', '2019-04-15 18:06:34'),
(26, 'USR00000001', 'USR00000003', 'User', 'Mengedit data user', 'Edit', '2019-04-15 18:07:16'),
(27, 'USR00000001', 'USR00000005', 'User', 'Menambah data user baru', 'Add', '2019-04-15 18:07:36'),
(28, 'USR00000001', 'USR00000006', 'User', 'Menambah data user baru', 'Add', '2019-04-15 18:08:07'),
(29, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:10:44'),
(30, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:11:48'),
(31, 'USR00000001', 'USR00000006', 'User', 'Mengedit data user', 'Edit', '2019-04-15 18:14:07'),
(32, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:33:18'),
(33, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:50:11'),
(34, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:52:49'),
(35, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:56:57'),
(36, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 19:06:48'),
(37, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-15 21:23:44'),
(38, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 21:33:56'),
(39, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-16 12:57:10'),
(40, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-16 14:15:15'),
(41, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-17 14:56:21'),
(42, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-17 14:56:55'),
(43, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-17 14:57:02'),
(44, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-17 14:57:31'),
(45, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-17 20:59:27'),
(46, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-21 08:26:50'),
(47, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-22 09:19:40'),
(48, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-23 09:38:43'),
(49, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-23 09:39:18'),
(50, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-23 09:39:33'),
(51, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 13:21:19'),
(52, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 13:35:42'),
(53, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 13:36:24'),
(54, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 13:40:54'),
(55, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 13:41:34'),
(56, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 15:38:15'),
(57, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 15:39:26'),
(58, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 15:42:54'),
(59, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 15:43:09'),
(60, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 15:43:40'),
(61, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 15:49:40'),
(62, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 15:50:53'),
(63, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 15:59:32'),
(64, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 16:03:12'),
(65, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 16:03:28'),
(66, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 16:06:00'),
(67, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 16:12:49'),
(68, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 16:13:28'),
(69, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 16:18:08'),
(70, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 16:18:27'),
(71, 'USR00000003', 'CL-00001', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-23 16:27:36'),
(72, 'USR00000003', 'CL-00001', 'Client', 'Menambah data client baru', 'Add', '2019-04-23 16:30:29'),
(73, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-24 07:07:05'),
(74, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-24 07:10:49'),
(75, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-24 07:56:30'),
(76, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-24 07:57:14'),
(77, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-24 07:57:35'),
(78, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-24 08:08:35'),
(79, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-24 08:11:32'),
(80, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-24 08:13:35'),
(81, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-27 06:46:45'),
(82, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-27 06:47:12'),
(83, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-27 06:47:20'),
(84, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-27 07:15:50'),
(85, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-27 07:16:12'),
(86, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-27 07:16:27'),
(87, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-27 07:16:40'),
(88, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-27 07:16:47'),
(89, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-28 08:19:00'),
(90, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-28 08:19:26'),
(91, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-28 08:19:34'),
(92, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-28 22:51:41'),
(93, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-28 22:52:10'),
(94, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-28 22:52:17'),
(95, 'USR00000003', 'CL-00002', 'Client', 'Menambah data client baru', 'Add', '2019-04-29 02:02:45'),
(96, 'USR00000003', 'CL-00003', 'Client', 'Menambah data client baru', 'Add', '2019-04-29 03:58:58'),
(97, 'USR00000003', 'CL-00003', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-29 04:07:25'),
(98, 'USR00000003', 'CL-00002', 'Client', 'Menghapus data client baru', 'Delete', '2019-04-29 04:09:55'),
(99, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 04:18:03'),
(100, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 04:18:23'),
(101, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 04:19:18'),
(102, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 04:19:32'),
(103, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 04:20:36'),
(104, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 04:20:54'),
(105, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 04:22:34'),
(106, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 04:23:06'),
(107, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 04:25:01'),
(108, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 04:25:13'),
(109, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 04:40:29'),
(110, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-29 04:52:07'),
(111, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 04:52:21'),
(112, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-29 04:52:27'),
(113, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 04:52:39'),
(114, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-29 04:52:46'),
(115, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 05:02:54'),
(116, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 05:05:52'),
(117, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 05:12:34'),
(118, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-29 05:32:23'),
(119, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-29 05:33:06'),
(120, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 05:35:30'),
(121, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 05:38:23'),
(122, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-04-29 05:38:55'),
(123, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-04-29 12:25:21'),
(124, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 12:25:36'),
(125, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-29 12:25:42'),
(126, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 12:25:51'),
(127, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-29 12:25:59'),
(128, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-29 12:26:19'),
(129, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-04-29 12:26:30'),
(130, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 12:36:33'),
(131, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-04-29 12:36:49'),
(132, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-04-29 12:54:54'),
(133, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-05-01 02:58:58'),
(134, 'USR00000001', '-', 'Auth', 'User logout', 'Logout', '2019-05-01 03:00:55'),
(135, 'USR00000001', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Change Password', '2019-05-01 03:02:13'),
(136, 'USR00000001', 'USR00000007', 'User', 'Menambah data user baru', 'Add', '2019-05-01 03:03:36'),
(137, 'USR00000001', 'USR00000007', 'User', 'Mengedit data user', 'Edit', '2019-05-01 03:04:53'),
(138, 'USR00000001', 'USR00000007', 'User', 'Menghapus data user baru', 'Delete', '2019-05-01 03:05:32'),
(139, 'USR00000003', 'CL-00002', 'Client', 'Menambah data client baru', 'Add', '2019-05-01 03:08:03'),
(140, 'USR00000003', 'CL-00001', 'Client', 'Mengedit data client', 'Edit', '2019-05-01 03:09:05'),
(141, 'USR00000003', 'CL-00002', 'Client', 'Menghapus data client baru', 'Delete', '2019-05-01 03:09:31'),
(142, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-05-01 03:16:26'),
(143, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-05-01 03:16:55'),
(144, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-02 06:17:38'),
(145, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-07-02 06:19:02'),
(146, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-07-02 06:19:20'),
(147, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-07-02 06:19:59'),
(148, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-07-02 06:20:44'),
(149, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-02 08:56:47'),
(150, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-02 12:17:31'),
(151, 'USR00000003', 'CL-00001', 'Client', 'Menonaktifkan Client', 'Nonaktif', '2019-07-02 12:18:14'),
(152, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-07-02 13:08:27'),
(153, 'USR00000003', 'S-PCMA-186', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 18:33:58'),
(154, 'USR00000003', 'S-PCMA-192', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 18:39:03'),
(155, 'USR00000003', 'S-PCMA-235', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 18:55:00'),
(156, 'USR00000003', 'S-PCMA-131', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 18:55:35'),
(157, 'USR00000003', 'S-PCMA-172', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 18:55:59'),
(158, 'USR00000003', 'S-PCMA-186', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 19:05:42'),
(159, 'USR00000003', 'S-PCMA-235', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-02 19:05:47'),
(160, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-03 12:44:43'),
(161, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-03 21:11:37'),
(162, 'USR00000003', 'S-PCMA-660', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-03 21:13:22'),
(163, 'USR00000003', 'S-PCMA-660', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-03 21:13:30'),
(164, 'USR00000003', 'S--1759672', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-03 21:13:49'),
(165, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-03 21:27:21'),
(166, 'USR00000003', 'S-PCMA-660', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-03 21:29:28'),
(167, 'USR00000003', 'S--1188835', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-03 21:29:31'),
(168, 'USR00000003', 'S--1759672', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-03 21:29:35'),
(169, 'USR00000003', 'SRY-0000001', 'Survey', 'Menambah data Survey baru', 'Add', '2019-07-04 06:27:14'),
(170, 'USR00000003', 'SRY-0000002', 'Survey', 'Menambah data Survey baru', 'Add', '2019-07-04 06:39:42'),
(171, 'USR00000003', 'SRY-0000001', 'Survey', 'Mengedit data Survey baru', 'Add', '2019-07-04 06:40:26'),
(172, 'USR00000003', 'SRY-0000001', 'Survey', 'Mengedit data Survey baru', 'Add', '2019-07-04 06:40:36'),
(173, 'USR00000003', 'SRY-0000001', 'Survey', 'Mengedit data Survey baru', 'Add', '2019-07-04 06:40:45'),
(174, 'USR00000003', 'SRY-0000001', 'Survey', 'Mengedit data Survey baru', 'Add', '2019-07-04 06:40:58'),
(175, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-05 18:28:21'),
(176, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-07 03:29:53'),
(177, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-07 03:53:59'),
(178, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-07 04:11:39'),
(179, 'USR00000003', 'S-14409129', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-07 04:12:23'),
(180, 'USR00000003', 'S-13591105', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-07 04:12:26'),
(181, 'USR00000003', 'S-PCMA-132', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-07 04:15:49'),
(182, 'USR00000003', 'S--5150012', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-07 04:16:32'),
(183, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-07 04:27:41'),
(184, 'USR00000005', '-', 'Auth', 'User login', 'Login', '2019-07-07 04:27:59'),
(185, 'USR00000005', 'SRY-0000002', 'Survey', 'Menambah data Survey baru', 'Add', '2019-07-07 04:29:28'),
(186, 'USR00000005', '-', 'Auth', 'User logout', 'Logout', '2019-07-07 04:35:34'),
(187, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-07 05:56:53'),
(188, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-07 12:30:19'),
(189, 'USR00000005', '-', 'Auth', 'User login', 'Login', '2019-07-07 12:30:32'),
(190, 'USR00000005', '-', 'Auth', 'User logout', 'Logout', '2019-07-07 12:43:00'),
(191, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-09 13:05:18'),
(192, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-14 04:20:27'),
(193, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-17 14:07:58'),
(194, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-18 12:59:54'),
(195, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-18 13:00:17'),
(196, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-18 13:00:23'),
(197, 'USR00000003', 'S--5980824', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:07:01'),
(198, 'USR00000003', 'S-PCMA-183', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:49:56'),
(199, 'USR00000003', 'S-PCMA-183', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:50:18'),
(200, 'USR00000003', 'S--5185945', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:50:32'),
(201, 'USR00000003', 'S--6665281', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:50:36'),
(202, 'USR00000003', 'S-PCMA-807', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:50:45'),
(203, 'USR00000003', 'S--1909041', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:51:53'),
(204, 'USR00000003', 'S--2080720', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:51:55'),
(205, 'USR00000003', 'S-PCMA-807', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:52:38'),
(206, 'USR00000003', 'S-PCMA-183', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 13:57:33'),
(207, 'USR00000003', 'S--5150012', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 14:04:58'),
(208, 'USR00000003', 'S-13591105', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 14:05:03'),
(209, 'USR00000003', 'S-14409129', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 14:05:05'),
(210, 'USR00000003', 'S-14409129', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 14:43:28'),
(211, 'USR00000003', 'S--5185945', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 14:59:52'),
(212, 'USR00000003', '-', 'Auth', 'User logout', 'Logout', '2019-07-18 15:16:30'),
(213, 'USR00000006', '-', 'Auth', 'User login', 'Login', '2019-07-18 15:32:58'),
(214, 'USR00000003', '-', 'Auth', 'User login', 'Login', '2019-07-18 19:47:58'),
(215, 'USR00000003', 'S-18047005', 'Schedule', 'Mengedit data schedule baru', 'Edit', '2019-07-18 19:48:52'),
(216, 'USR00000006', '-', 'Auth', 'User logout', 'Logout', '2019-07-19 12:17:22'),
(217, 'USR00000001', '-', 'Auth', 'User login', 'Login', '2019-07-19 12:17:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` varchar(10) NOT NULL,
  `id_client` varchar(8) NOT NULL,
  `plan_date` date NOT NULL,
  `plan_tonage` int(11) NOT NULL,
  `confirmed_date` date NOT NULL,
  `status` enum('Proccess','Confirmed','Complete','Cancel by Client','Cancel by Admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_client`, `plan_date`, `plan_tonage`, `confirmed_date`, `status`, `created_at`) VALUES
('S--1188835', 'CL-00001', '2019-07-31', 10, '2019-07-19', 'Complete', '2019-07-02 19:11:01'),
('S--1759672', 'CL-00001', '2019-07-31', 10, '2019-07-31', 'Complete', '2019-07-02 19:10:50'),
('S--1909041', 'CL-00001', '2019-07-12', 10, '0000-00-00', 'Cancel by Admin', '2019-07-02 19:10:50'),
('S--2080720', 'CL-00001', '2019-07-12', 10, '0000-00-00', 'Cancel by Admin', '2019-07-02 19:11:01'),
('S--5150012', 'CL-00001', '2019-07-30', 10, '2019-07-30', 'Complete', '2019-07-02 19:11:01'),
('S--5185945', 'CL-00001', '2019-07-27', 10, '2019-07-27', 'Cancel by Client', '2019-07-02 19:11:01'),
('S--5980824', 'CL-00001', '2019-07-30', 10, '0000-00-00', 'Cancel by Admin', '2019-07-02 19:10:50'),
('S--6665281', 'CL-00001', '2019-07-27', 10, '2019-07-14', 'Cancel by Client', '2019-07-02 19:10:50'),
('S-13591105', 'CL-00001', '2019-07-14', 2000, '2019-07-14', 'Complete', '2019-07-07 04:10:45'),
('S-14409129', 'CL-00001', '2019-07-13', 1000, '2019-07-13', 'Complete', '2019-07-07 04:10:45'),
('S-18047005', 'CL-00001', '2019-07-19', 1000, '2019-07-19', 'Confirmed', '2019-07-18 19:47:01'),
('S-PCMA-183', 'CL-00001', '2019-07-27', 10, '2019-07-27', 'Cancel by Client', '2019-07-02 19:12:08'),
('S-PCMA-235', 'CL-00001', '2019-11-13', 123133, '2019-11-13', 'Complete', '2019-07-01 19:51:05'),
('S-PCMA-660', 'CL-00001', '2019-07-31', 10, '2019-07-31', 'Complete', '2019-07-02 19:12:08'),
('S-PCMA-807', 'CL-00001', '2019-07-12', 10, '2019-07-14', 'Cancel by Admin', '2019-07-02 19:12:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey`
--

CREATE TABLE `survey` (
  `id_survey` varchar(11) NOT NULL,
  `no_si` varchar(20) NOT NULL,
  `total_loaded` int(11) NOT NULL,
  `document` text NOT NULL,
  `actual_date` date NOT NULL,
  `actual_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `survey`
--

INSERT INTO `survey` (`id_survey`, `no_si`, `total_loaded`, `document`, `actual_date`, `actual_time`, `created_at`) VALUES
('SRY-0000001', 'SI-0719-PCMA-001', 136571, 'SRY-0000001.pdf', '2019-10-11', '21:00:00', '2019-07-04 06:27:14'),
('SRY-0000002', 'SI-0719-PCMA-002', 2000, 'SRY-0000002.pdf', '2019-07-10', '20:30:00', '2019-07-07 04:29:28');

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
('USR00000001', 'Helpdesk', 'helpdesk', 'helpdesk', 'Helpdesk', '2019-04-13 18:22:52', '', 'user.jpg', 'Aktif', '875a8f2f42c570f'),
('USR00000003', 'Haviz Indra Maulana', 'havizIM', 'ajyp7', 'Admin', '2019-04-15 17:17:04', '', 'user.jpg', 'Aktif', 'c0e49cd9fa90328'),
('USR00000004', 'Dian Ratna Sari', 'dianrs', '6zeb9', 'Accounting', '2019-04-15 17:18:17', '', 'user.jpg', 'Aktif', 'e2baa50d717f2e8'),
('USR00000005', 'Tezar Tri Handika', 'tezarth', 'nh106', 'Agent', '2019-04-15 18:07:36', '', 'user.jpg', 'Aktif', 'b34716876d1413c'),
('USR00000006', 'Devan Dirganatara Putra', 'devandp', 'ulbya', 'Manager', '2019-04-15 18:08:07', '', 'user.jpg', 'Aktif', 'cbb527c93eb9b52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `instruction`
--
ALTER TABLE `instruction`
  ADD CONSTRAINT `instruction_ibfk_1` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`no_si`) REFERENCES `instruction` (`no_si`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
