-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2019 at 10:26 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

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
-- Table structure for table `chat`
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
-- Table structure for table `client`
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
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nama_perusahaan`, `penanggung_jawab`, `alamat_perusahaan`, `kode_pos`, `telepon`, `fax`, `npwp`, `mou`, `logo_perusahaan`, `website`, `nama_pic`, `email_pic`, `telepon_pic`, `email_perusahaan`, `username`, `password`, `expired_date`, `status`, `token`, `tgl_registrasi`) VALUES
('CL-00001', 'PT. CodeManiac', 'Haviz Indra Maulana', 'Jakarta Pusat', '112100', '1273921793122', '1236281468122', '1279127409184312', 'CL-00001.pdf', 'CL-00001.jpg', 'https://codemaniac.co.id', 'Yugi Setiawan', 'yugi@gmail.com', '081246126418', 'viz.ndinq@gmail.com', 'PCM', 'xl2nw', '2020-01-02', 'Aktif', 'e69b76f88179856c6e84', '2019-04-23 16:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `instruction`
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
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_si` enum('Proses','Confirmed','Cancel','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
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
-- Dumping data for table `log`
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
(80, 'USR00000003', 'CL-00001', 'Client', 'Aktivasi Client', 'Aktivasi', '2019-04-24 08:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` varchar(10) NOT NULL,
  `id_client` varchar(8) NOT NULL,
  `barging` int(3) NOT NULL,
  `plan_date` date NOT NULL,
  `plan_tonage` int(11) NOT NULL,
  `confirmed_date` date NOT NULL,
  `status` enum('Proccess','Confirmed','Complete','Cancel') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('Helpdesk','Admin','Agent','Manager','Accounting') NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` text NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`, `tgl_registrasi`, `foto`, `status`, `token`) VALUES
('USR00000001', 'Helpdesk', 'helpdesk', 'helpdesk', 'Helpdesk', '2019-04-13 18:22:52', 'user.jpg', 'Aktif', '875a8f2f42c570f'),
('USR00000003', 'Haviz Indra Maulana', 'havizIM', 'ajyp7', 'Admin', '2019-04-15 17:17:04', 'user.jpg', 'Aktif', 'c0e49cd9fa90328'),
('USR00000004', 'Dian Ratna Sari', 'dianrs', '6zeb9', 'Accounting', '2019-04-15 17:18:17', 'user.jpg', 'Aktif', 'e2baa50d717f2e8'),
('USR00000005', 'Tezar Tri Handika', 'tezarth', 'nh106', 'Agent', '2019-04-15 18:07:36', 'user.jpg', 'Aktif', 'b34716876d1413c'),
('USR00000006', 'Devan Dirganatara Putra', 'devandp', 'ulbya', 'Manager', '2019-04-15 18:08:07', 'user.jpg', 'Aktif', 'cbb527c93eb9b52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `email_perusahaan` (`email_perusahaan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `instruction`
--
ALTER TABLE `instruction`
  ADD PRIMARY KEY (`no_si`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD UNIQUE KEY `id_client` (`id_client`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`),
  ADD KEY `no_si` (`no_si`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instruction`
--
ALTER TABLE `instruction`
  ADD CONSTRAINT `instruction_ibfk_1` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`) ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON UPDATE CASCADE;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`no_si`) REFERENCES `instruction` (`no_si`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
