-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2026 at 01:24 AM
-- Server version: 8.4.3
-- PHP Version: 8.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `ip`, `meta`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mengubah data user: Administrator', '127.0.0.1', NULL, '2026-04-16 03:42:19', '2026-04-16 03:42:19'),
(2, 1, 'Mengubah data user: Petugas Penyetujuan', '127.0.0.1', NULL, '2026-04-16 03:50:32', '2026-04-16 03:50:32'),
(3, 1, 'Membuat alat baru: assets', '127.0.0.1', NULL, '2026-04-16 04:10:29', '2026-04-16 04:10:29'),
(4, 1, 'Mengubah status peminjaman ID 1 menjadi approved', '127.0.0.1', NULL, '2026-04-16 04:12:49', '2026-04-16 04:12:49'),
(5, 1, 'Mengubah data user: Petugas Penyetujuan', '127.0.0.1', NULL, '2026-04-16 04:14:59', '2026-04-16 04:14:59'),
(6, 2, 'Mencatat pengembalian alat dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-16 04:15:17', '2026-04-16 04:15:17'),
(7, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-16 04:21:40', '2026-04-16 04:21:40'),
(8, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 18.000', '127.0.0.1', NULL, '2026-04-16 05:05:50', '2026-04-16 05:05:50'),
(9, 2, 'Menandai denda peminjaman 2 milik Anggota Peminjam sebagai lunas', '127.0.0.1', NULL, '2026-04-16 05:05:59', '2026-04-16 05:05:59'),
(10, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-16 05:12:48', '2026-04-16 05:12:48'),
(11, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 5.000', '127.0.0.1', NULL, '2026-04-16 05:13:14', '2026-04-16 05:13:14'),
(12, 2, 'Menandai denda peminjaman 3 milik Anggota Peminjam sebagai lunas', '127.0.0.1', NULL, '2026-04-16 05:13:23', '2026-04-16 05:13:23'),
(13, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-16 05:17:00', '2026-04-16 05:17:00'),
(14, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-16 05:20:41', '2026-04-16 05:20:41'),
(15, 1, 'Mengubah data alat: assets', '127.0.0.1', NULL, '2026-04-16 05:22:19', '2026-04-16 05:22:19'),
(16, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-16 19:06:42', '2026-04-16 19:06:42'),
(17, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-16 19:10:33', '2026-04-16 19:10:33'),
(18, 2, 'Menyetujui peminjaman dari ujang kedu', '127.0.0.1', NULL, '2026-04-19 10:49:26', '2026-04-19 10:49:26'),
(19, 2, 'Mencatat pengembalian alat dari ujang kedu dengan total denda Rp 7.000', '127.0.0.1', NULL, '2026-04-19 10:49:48', '2026-04-19 10:49:48'),
(20, 2, 'Memverifikasi pembayaran transfer denda peminjaman 6 milik ujang kedu', '127.0.0.1', NULL, '2026-04-19 10:50:54', '2026-04-19 10:50:54'),
(21, 1, 'Mengubah data alat: assets', '127.0.0.1', NULL, '2026-04-19 10:54:02', '2026-04-19 10:54:02'),
(22, 2, 'Menyetujui peminjaman dari ujang kedu', '127.0.0.1', NULL, '2026-04-19 10:55:25', '2026-04-19 10:55:25'),
(23, 2, 'Mencatat pengembalian alat dari ujang kedu dengan total denda Rp 5.000', '127.0.0.1', NULL, '2026-04-19 10:55:42', '2026-04-19 10:55:42'),
(24, 2, 'Menandai denda peminjaman 7 milik ujang kedu sebagai lunas', '127.0.0.1', NULL, '2026-04-19 10:57:05', '2026-04-19 10:57:05'),
(25, 2, 'Menyetujui peminjaman dari ujang kedu', '127.0.0.1', NULL, '2026-04-19 10:57:33', '2026-04-19 10:57:33'),
(26, 2, 'Mencatat pengembalian alat dari ujang kedu dengan total denda Rp 40.000', '127.0.0.1', NULL, '2026-04-19 10:57:52', '2026-04-19 10:57:52'),
(27, 2, 'Menandai denda peminjaman 8 milik ujang kedu sebagai lunas', '127.0.0.1', NULL, '2026-04-19 10:58:39', '2026-04-19 10:58:39'),
(28, 2, 'Menyetujui peminjaman dari ujang kedu', '127.0.0.1', NULL, '2026-04-19 10:58:48', '2026-04-19 10:58:48'),
(29, 2, 'Mencatat pengembalian alat dari ujang kedu dengan total denda Rp 45.000', '127.0.0.1', NULL, '2026-04-19 10:59:07', '2026-04-19 10:59:07'),
(30, 2, 'Menyetujui peminjaman dari ujang kedu', '127.0.0.1', NULL, '2026-04-19 11:03:50', '2026-04-19 11:03:50'),
(31, 2, 'Mencatat pengembalian alat dari ujang kedu dengan total denda Rp 77.000', '127.0.0.1', NULL, '2026-04-19 11:04:18', '2026-04-19 11:04:18'),
(32, 2, 'Memverifikasi pembayaran transfer denda peminjaman 10 milik ujang kedu', '127.0.0.1', NULL, '2026-04-19 11:04:58', '2026-04-19 11:04:58'),
(33, 1, 'Mengubah data user: Administrator', '127.0.0.1', NULL, '2026-04-19 20:16:16', '2026-04-19 20:16:16'),
(34, 1, 'Menghapus alat: assets', '127.0.0.1', NULL, '2026-04-20 00:24:55', '2026-04-20 00:24:55'),
(35, 1, 'Membuat alat baru: bola volly', '127.0.0.1', NULL, '2026-04-20 00:27:10', '2026-04-20 00:27:10'),
(36, 1, 'Membuat alat baru: Bola Futsal', '127.0.0.1', NULL, '2026-04-20 00:28:18', '2026-04-20 00:28:18'),
(37, 1, 'Membuat alat baru: Bola Futsal', '127.0.0.1', NULL, '2026-04-20 00:29:01', '2026-04-20 00:29:01'),
(38, 1, 'Membuat alat baru: Raket', '127.0.0.1', NULL, '2026-04-20 00:30:15', '2026-04-20 00:30:15'),
(39, 1, 'Membuat alat baru: Raket', '127.0.0.1', NULL, '2026-04-20 00:31:01', '2026-04-20 00:31:01'),
(40, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 00:33:42', '2026-04-20 00:33:42'),
(41, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-20 00:36:45', '2026-04-20 00:36:45'),
(42, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 00:42:35', '2026-04-20 00:42:35'),
(43, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 5.000', '127.0.0.1', NULL, '2026-04-20 00:43:29', '2026-04-20 00:43:29'),
(44, 1, 'Mengubah data user: Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 00:49:44', '2026-04-20 00:49:44'),
(45, 1, 'Mengubah data user: Revindra', '127.0.0.1', NULL, '2026-04-20 00:52:09', '2026-04-20 00:52:09'),
(46, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 00:58:17', '2026-04-20 00:58:17'),
(47, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 100.000', '127.0.0.1', NULL, '2026-04-20 00:58:44', '2026-04-20 00:58:44'),
(48, 2, 'Memverifikasi pembayaran transfer denda peminjaman 13 milik Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 00:59:58', '2026-04-20 00:59:58'),
(49, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 01:02:12', '2026-04-20 01:02:12'),
(50, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 99.000', '127.0.0.1', NULL, '2026-04-20 01:03:41', '2026-04-20 01:03:41'),
(51, 2, 'Memverifikasi pembayaran transfer denda peminjaman 14 milik Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 01:04:58', '2026-04-20 01:04:58'),
(52, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 01:06:06', '2026-04-20 01:06:06'),
(53, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 500.000', '127.0.0.1', NULL, '2026-04-20 01:06:33', '2026-04-20 01:06:33'),
(54, 2, 'Menolak verifikasi pembayaran transfer denda peminjaman 15 milik Anggota Peminjam', '127.0.0.1', NULL, '2026-04-20 01:07:37', '2026-04-20 01:07:37'),
(55, 2, 'Menyetujui peminjaman dari Rama', '127.0.0.1', NULL, '2026-04-20 01:13:35', '2026-04-20 01:13:35'),
(56, 2, 'Mencatat pengembalian alat dari Rama dengan total denda Rp 100.000', '127.0.0.1', NULL, '2026-04-20 01:14:07', '2026-04-20 01:14:07'),
(57, 2, 'Memverifikasi pembayaran transfer denda peminjaman 16 milik Rama', '127.0.0.1', NULL, '2026-04-20 01:15:30', '2026-04-20 01:15:30'),
(58, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-21 18:00:13', '2026-04-21 18:00:13'),
(59, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 999.000', '127.0.0.1', NULL, '2026-04-21 18:00:32', '2026-04-21 18:00:32'),
(60, 2, 'Memverifikasi pembayaran transfer denda peminjaman 17 milik Anggota Peminjam', '127.0.0.1', NULL, '2026-04-21 18:01:30', '2026-04-21 18:01:30'),
(61, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-21 20:44:19', '2026-04-21 20:44:19'),
(62, 2, 'Menandai denda peminjaman 15 milik Anggota Peminjam sebagai lunas', '127.0.0.1', NULL, '2026-04-21 20:44:40', '2026-04-21 20:44:40'),
(63, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-21 20:46:33', '2026-04-21 20:46:33'),
(64, 1, 'Membuat buku baru: harryyyyyy', '127.0.0.1', NULL, '2026-04-22 06:50:47', '2026-04-22 06:50:47'),
(65, 1, 'Menghapus buku: bola volly', '127.0.0.1', NULL, '2026-04-22 17:05:59', '2026-04-22 17:05:59'),
(66, 1, 'Mengubah kategori: Masakan', '127.0.0.1', NULL, '2026-04-22 17:06:57', '2026-04-22 17:06:57'),
(67, 1, 'Mengubah kategori: Coding', '127.0.0.1', NULL, '2026-04-22 17:07:27', '2026-04-22 17:07:27'),
(68, 1, 'Mengubah kategori: Olahraga', '127.0.0.1', NULL, '2026-04-22 17:07:54', '2026-04-22 17:07:54'),
(69, 1, 'Menghapus buku: Bola Futsal', '127.0.0.1', NULL, '2026-04-22 17:08:06', '2026-04-22 17:08:06'),
(70, 1, 'Menghapus buku: Bola Futsal', '127.0.0.1', NULL, '2026-04-22 17:08:19', '2026-04-22 17:08:19'),
(71, 1, 'Menghapus buku: Raket', '127.0.0.1', NULL, '2026-04-22 17:08:26', '2026-04-22 17:08:26'),
(72, 1, 'Menghapus buku: Raket', '127.0.0.1', NULL, '2026-04-22 17:08:37', '2026-04-22 17:08:37'),
(73, 1, 'Mengubah data user: Administrator', '127.0.0.1', NULL, '2026-04-22 17:25:52', '2026-04-22 17:25:52'),
(74, 2, 'Menyetujui peminjaman dari Anggota Peminjam', '127.0.0.1', NULL, '2026-04-22 18:03:30', '2026-04-22 18:03:30'),
(75, 2, 'Mencatat pengembalian alat dari Anggota Peminjam dengan total denda Rp 100.000', '127.0.0.1', NULL, '2026-04-22 18:04:25', '2026-04-22 18:04:25'),
(76, 2, 'Menandai denda peminjaman 19 milik Anggota Peminjam sebagai lunas', '127.0.0.1', NULL, '2026-04-22 18:04:52', '2026-04-22 18:04:52'),
(77, 1, 'Menghapus user: test', '127.0.0.1', NULL, '2026-04-22 18:07:37', '2026-04-22 18:07:37'),
(78, 1, 'Membuat user baru: Rantuy', '127.0.0.1', NULL, '2026-04-22 18:08:37', '2026-04-22 18:08:37'),
(79, 2, 'Menyetujui peminjaman dari Rantuy', '127.0.0.1', NULL, '2026-04-22 18:10:26', '2026-04-22 18:10:26'),
(80, 2, 'Mencatat pengembalian alat dari Rantuy dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-22 18:11:06', '2026-04-22 18:11:06'),
(81, 1, 'Mengubah data user: Petugas Penyetujuan', '127.0.0.1', NULL, '2026-04-22 18:18:23', '2026-04-22 18:18:23'),
(82, 1, 'Mengubah data buku: Harry Potter and the Philosopher\'s Stone', '127.0.0.1', NULL, '2026-04-22 18:26:37', '2026-04-22 18:26:37'),
(83, 2, 'Menyetujui peminjaman dari Rantuy', '127.0.0.1', NULL, '2026-04-22 18:27:19', '2026-04-22 18:27:19'),
(84, 2, 'Mencatat pengembalian alat dari Rantuy dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-22 18:27:36', '2026-04-22 18:27:36'),
(85, 1, 'Mengubah data buku: harryyyyyy', '127.0.0.1', NULL, '2026-04-22 18:28:14', '2026-04-22 18:28:14'),
(86, 2, 'Menyetujui peminjaman dari Rantuy', '127.0.0.1', NULL, '2026-04-22 18:39:22', '2026-04-22 18:39:22'),
(87, 2, 'Mencatat pengembalian alat dari Rantuy dengan total denda Rp 50.000', '127.0.0.1', NULL, '2026-04-22 18:40:07', '2026-04-22 18:40:07'),
(88, 1, 'Menghapus user: Rama', '127.0.0.1', NULL, '2026-04-22 18:41:05', '2026-04-22 18:41:05'),
(89, 1, 'Menghapus user: ujang kedu', '127.0.0.1', NULL, '2026-04-22 18:41:10', '2026-04-22 18:41:10'),
(90, 2, 'Menandai denda peminjaman 22 milik Rantuy sebagai lunas', '127.0.0.1', NULL, '2026-04-22 18:41:48', '2026-04-22 18:41:48'),
(91, 1, 'Mengubah data user: Petugas Penyetujuan 01', '127.0.0.1', NULL, '2026-04-22 18:52:23', '2026-04-22 18:52:23'),
(92, 1, 'Membuat user baru: Petugas Penyetujuan 02', '127.0.0.1', NULL, '2026-04-22 18:54:04', '2026-04-22 18:54:04'),
(93, 1, 'Menghapus user: Anggota Peminjam', '127.0.0.1', NULL, '2026-04-22 20:06:50', '2026-04-22 20:06:50'),
(94, 1, 'Menghapus user: Anggota Peminjam', '127.0.0.1', NULL, '2026-04-22 20:06:55', '2026-04-22 20:06:55'),
(95, 1, 'Menghapus user: Revindra', '127.0.0.1', NULL, '2026-04-22 20:07:05', '2026-04-22 20:07:05'),
(96, 1, 'Menghapus user: Rahadiun', '127.0.0.1', NULL, '2026-04-22 20:07:20', '2026-04-22 20:07:20'),
(97, 1, 'Mengubah data buku: Harry Potter and the Philosopher\'s Stone', '127.0.0.1', NULL, '2026-04-22 20:12:53', '2026-04-22 20:12:53'),
(98, 1, 'Mengubah data buku: Harry Potter and the Philosopher\'s Stone', '127.0.0.1', NULL, '2026-04-22 20:13:13', '2026-04-22 20:13:13'),
(99, 1, 'Menghapus buku: harryyyyyy', '127.0.0.1', NULL, '2026-04-22 20:16:39', '2026-04-22 20:16:39'),
(100, 1, 'Mengubah data buku: Sapiens: A Brief History of Humankind', '127.0.0.1', NULL, '2026-04-22 20:17:14', '2026-04-22 20:17:14'),
(101, 1, 'Mengubah data buku: Matematika SMA Kelas X', '127.0.0.1', NULL, '2026-04-22 20:17:48', '2026-04-22 20:17:48'),
(102, 1, 'Mengubah data buku: Sapiens: A Brief History of Humankind', '127.0.0.1', NULL, '2026-04-22 20:18:08', '2026-04-22 20:18:08'),
(103, 1, 'Mengubah data buku: Clean Code: A Handbook of Agile Software Craftsmanship', '127.0.0.1', NULL, '2026-04-22 20:18:25', '2026-04-22 20:18:25'),
(104, 1, 'Mengubah data buku: A Brief History of Time', '127.0.0.1', NULL, '2026-04-22 20:18:45', '2026-04-22 20:18:45'),
(105, 1, 'Mengubah data buku: The Elements of Style', '127.0.0.1', NULL, '2026-04-22 20:19:11', '2026-04-22 20:19:11'),
(106, 1, 'Mengubah data buku: Atomic Habits', '127.0.0.1', NULL, '2026-04-22 20:19:29', '2026-04-22 20:19:29'),
(107, 1, 'Mengubah data buku: English Grammar in Use', '127.0.0.1', NULL, '2026-04-22 20:19:46', '2026-04-22 20:19:46'),
(108, 1, 'Membuat buku baru: Laut Bercerita', '127.0.0.1', NULL, '2026-04-22 20:23:49', '2026-04-22 20:23:49'),
(109, 2, 'Menyetujui peminjaman dari Rantuy', '127.0.0.1', NULL, '2026-04-22 23:59:03', '2026-04-22 23:59:03'),
(110, 2, 'Mencatat pengembalian alat dari Rantuy dengan total denda Rp 199.000', '127.0.0.1', NULL, '2026-04-22 23:59:23', '2026-04-22 23:59:23'),
(111, 2, 'Menandai denda peminjaman 23 milik Rantuy sebagai lunas dan konfirmasi pembayaran', '127.0.0.1', NULL, '2026-04-23 00:30:22', '2026-04-23 00:30:22'),
(112, 2, 'Menyetujui peminjaman dari Revan', '127.0.0.1', NULL, '2026-04-23 00:39:15', '2026-04-23 00:39:15'),
(113, 2, 'Mencatat pengembalian alat dari Revan dengan total denda Rp 0', '127.0.0.1', NULL, '2026-04-23 00:40:43', '2026-04-23 00:40:43'),
(114, 2, 'Menyetujui peminjaman dari Revan', '127.0.0.1', NULL, '2026-04-23 00:41:46', '2026-04-23 00:41:46'),
(115, 2, 'Mencatat pengembalian alat dari Revan dengan total denda Rp 99.000', '127.0.0.1', NULL, '2026-04-23 00:42:22', '2026-04-23 00:42:22'),
(116, 2, 'Menandai denda peminjaman 25 milik Revan sebagai lunas dan konfirmasi pembayaran', '127.0.0.1', NULL, '2026-04-23 00:44:14', '2026-04-23 00:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_published` year NOT NULL,
  `isbn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_total` int NOT NULL DEFAULT '0',
  `qty_available` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `name`, `author`, `year_published`, `isbn`, `qty_total`, `qty_available`, `description`, `image`, `created_at`, `updated_at`) VALUES
(7, 4, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', '1997', '978-0-7475-3269-9', 5, 5, 'Petualangan magis seorang anak penyihir di Hogwarts School of Witchcraft and Wizardry.', 'book-images/harry-potter-and-the-philosophers-stone.jpg', '2026-04-22 06:22:13', '2026-04-23 00:42:22'),
(8, 6, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '2011', '978-0-06-231609-7', 3, 3, 'Sejarah manusia dari zaman batu hingga era modern.', 'book-images/sapiens-a-brief-history-of-humankind.jpg', '2026-04-22 06:22:13', '2026-04-22 20:18:08'),
(9, 6, 'Matematika SMA Kelas X', 'Tim Penyusun', '2020', '978-602-244-123-4', 10, 10, 'Buku matematika untuk siswa SMA kelas X sesuai kurikulum nasional.', 'book-images/matematika-sma-kelas-x.jpg', '2026-04-22 06:22:13', '2026-04-22 20:17:48'),
(10, 2, 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Robert C. Martin', '2008', '978-0-13-235088-4', 2, 2, 'Panduan menulis kode yang bersih dan maintainable dalam pengembangan software.', 'book-images/clean-code-a-handbook-of-agile-software-craftsmanship.jpg', '2026-04-22 06:22:13', '2026-04-22 20:18:25'),
(11, 5, 'A Brief History of Time', 'Stephen Hawking', '1988', '978-0-553-38016-9', 4, 4, 'Penjelasan tentang kosmologi dan teori relativitas untuk umum.', 'book-images/a-brief-history-of-time.jpg', '2026-04-22 06:22:13', '2026-04-22 20:18:45'),
(12, 6, 'The Elements of Style', 'William Strunk Jr. and E.B. White', '1959', '978-0-205-30902-3', 3, 3, 'Panduan klasik untuk menulis bahasa Inggris yang efektif.', 'book-images/the-elements-of-style.jpg', '2026-04-22 06:22:13', '2026-04-22 20:19:11'),
(13, 7, 'Atomic Habits', 'James Clear', '2018', '978-0-7352-1129-2', 6, 6, 'Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk.', 'book-images/atomic-habits.jpg', '2026-04-22 06:22:13', '2026-04-22 20:19:29'),
(14, 8, 'English Grammar in Use', 'Raymond Murphy', '1994', '978-0-521-18906-4', 8, 8, 'Buku referensi tata bahasa Inggris untuk semua level.', 'book-images/english-grammar-in-use.jpg', '2026-04-22 06:22:13', '2026-04-22 20:19:46'),
(16, 5, 'Laut Bercerita', 'Leila S. Chudori', '2017', '9786024246952', 40, 40, 'perjuangan, penyiksaan, dan penghilangan paksa aktivis mahasiswa pada masa Orde Baru tahun 1998.', 'book-images/laut-bercerita.jpg', '2026-04-22 20:23:49', '2026-04-22 20:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `actual_return_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected','returned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `return_condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `late_days` int UNSIGNED NOT NULL DEFAULT '0',
  `daily_late_fee` bigint UNSIGNED NOT NULL DEFAULT '5000',
  `late_fine` bigint UNSIGNED NOT NULL DEFAULT '0',
  `damage_fine` bigint UNSIGNED NOT NULL DEFAULT '0',
  `total_fine` bigint UNSIGNED NOT NULL DEFAULT '0',
  `fine_status` enum('belum_lunas','lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lunas',
  `fine_paid_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `payment_requested_at` timestamp NULL DEFAULT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_amount` bigint UNSIGNED DEFAULT NULL,
  `payment_proof_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_submitted_at` timestamp NULL DEFAULT NULL,
  `payment_verification_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_verified_by` bigint UNSIGNED DEFAULT NULL,
  `payment_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `book_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `qty`, `start_date`, `end_date`, `actual_return_date`, `status`, `note`, `approved_by`, `returned_at`, `return_condition`, `return_note`, `late_days`, `daily_late_fee`, `late_fine`, `damage_fine`, `total_fine`, `fine_status`, `fine_paid_at`, `payment_method`, `payment_status`, `payment_requested_at`, `payment_proof`, `payment_amount`, `payment_proof_path`, `payment_submitted_at`, `payment_verification_status`, `payment_verified_by`, `payment_verified_at`, `created_at`, `updated_at`, `book_id`) VALUES
(20, 10, 1, '2026-04-23', '2026-04-24', '2026-04-23', 'returned', NULL, 2, '2026-04-22 18:11:06', 'baik', NULL, 0, 5000, 0, 0, 0, 'lunas', '2026-04-22 18:11:06', NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 18:10:14', '2026-04-22 18:11:06', 14),
(21, 10, 1, '2026-04-23', '2026-04-24', '2026-04-23', 'returned', NULL, 2, '2026-04-22 18:27:36', 'baik', NULL, 0, 5000, 0, 0, 0, 'lunas', '2026-04-22 18:27:36', NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 18:27:11', '2026-04-22 18:27:36', 7),
(22, 10, 1, '2026-04-23', '2026-04-24', '2026-04-23', 'returned', NULL, 2, '2026-04-22 18:40:07', 'rusak_berat', NULL, 0, 5000, 0, 50000, 50000, 'lunas', '2026-04-22 18:41:48', NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 18:39:14', '2026-04-22 18:41:48', 7),
(23, 10, 1, '2026-04-23', '2026-04-24', '2026-04-23', 'returned', NULL, 2, '2026-04-22 23:59:23', 'rusak_berat', NULL, 0, 5000, 0, 199000, 199000, 'lunas', '2026-04-23 00:30:22', 'transfer', 'confirmed', '2026-04-23 00:29:02', 'payment_proofs/mmNfAHIw4xqb3O1Yd76Q88LHzNKTMlxm7PoJLsdm.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 23:58:57', '2026-04-23 00:30:22', 7),
(24, 13, 1, '2026-04-23', '2026-04-24', '2026-04-23', 'returned', 'dipinjam', 2, '2026-04-23 00:40:43', 'baik', NULL, 0, 5000, 0, 0, 0, 'lunas', '2026-04-23 00:40:43', NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-23 00:38:33', '2026-04-23 00:40:43', 7),
(25, 13, 1, '2026-04-23', '2026-04-24', '2026-04-23', 'returned', NULL, 2, '2026-04-23 00:42:22', 'rusak_berat', 'cover hilang', 0, 5000, 0, 99000, 99000, 'lunas', '2026-04-23 00:44:14', 'transfer', 'confirmed', '2026-04-23 00:43:39', 'payment_proofs/bmUcy2RFjIMQ0zJ1HUGkkSiDM8ztqJibXusyrfnK.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-23 00:41:37', '2026-04-23 00:44:14', 7);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Masakan', NULL, '2026-04-16 03:34:34', '2026-04-22 17:06:57'),
(2, 'Coding', NULL, '2026-04-16 03:34:34', '2026-04-22 17:07:27'),
(3, 'Olahraga', NULL, '2026-04-16 03:34:34', '2026-04-22 17:07:54'),
(4, 'Fiksi', 'Novel, cerita pendek, dan karya imajinatif', '2026-04-22 06:22:12', '2026-04-22 06:22:12'),
(5, 'Non-Fiksi', 'Biografi, sejarah, dan karya faktual', '2026-04-22 06:22:12', '2026-04-22 06:22:12'),
(6, 'Pendidikan', 'Buku pelajaran dan referensi akademik', '2026-04-22 06:22:12', '2026-04-22 06:22:12'),
(7, 'Teknologi', 'Programming, IT, dan teknologi modern', '2026-04-22 06:22:12', '2026-04-22 06:22:12'),
(8, 'Sains', 'Fisika, kimia, biologi, dan ilmu pengetahuan', '2026-04-22 06:22:12', '2026-04-22 06:22:12'),
(9, 'Seni', 'Musik, lukis, fotografi, dan kreativitas', '2026-04-22 06:22:12', '2026-04-22 06:22:12'),
(10, 'Motivasi', 'Inspirasi, sukses, dan pengembangan diri', '2026-04-22 06:22:13', '2026-04-22 06:22:13'),
(11, 'Bahasa', 'Bahasa Inggris, Indonesia, dan linguistik', '2026-04-22 06:22:13', '2026-04-22 06:22:13'),
(12, 'Lapangan Olahraga', NULL, '2026-04-22 17:48:14', '2026-04-22 17:48:14'),
(13, 'Peralatan Gym', NULL, '2026-04-22 17:48:14', '2026-04-22 17:48:14'),
(14, 'Peralatan Olahraga', NULL, '2026-04-22 17:48:14', '2026-04-22 17:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_15_000000_add_profile_photo_and_address_to_users_table', 1),
(5, '2026_02_06_000001_create_roles_table', 1),
(6, '2026_02_06_000002_create_role_user_table', 1),
(7, '2026_02_06_000003_create_categories_table', 1),
(8, '2026_02_06_000004_create_equipments_table', 1),
(9, '2026_02_06_000005_create_borrowings_table', 1),
(10, '2026_02_06_000006_create_activity_logs_table', 1),
(11, '2026_04_16_000007_add_fines_to_borrowings_table', 2),
(12, '2026_04_20_000008_add_payment_fields_to_borrowings_table', 3),
(13, '2026_04_20_000009_add_image_to_equipments_table', 3),
(14, '2026_04_22_000001_rename_equipments_to_books', 4),
(16, '2026_04_22_131128_rename_equipments_to_books', 5),
(17, '2026_04_23_005637_add_book_id_to_borrowings_table', 6),
(18, '2026_04_23_010230_drop_equipment_id_from_borrowings_if_exists', 7),
(19, '2026_04_23_012030_add_image_to_books_table', 8),
(20, '2026_04_23_123456_add_payment_proof_to_borrowings_table', 9),
(21, '2026_04_23_123457_add_payment_status_to_borrowings_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2026-04-16 03:31:22', '2026-04-16 03:31:22'),
(2, 'petugas', 'Petugas', '2026-04-16 03:31:22', '2026-04-16 03:31:22'),
(3, 'peminjam', 'Peminjam', '2026-04-16 03:31:22', '2026-04-16 03:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(9, 3, 10, NULL, NULL),
(10, 2, 11, NULL, NULL),
(12, 3, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dDL0ssm8Q36z0iMmVvjnOufCt39fgGVeSiKKPtp0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienBUVU9tN3NJQ0VGbkxPSXUyNFVXeVpFQTdlTWZUa1BWWFV5TUdGTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1776993710),
('f0XbiWRlIQaGXpZVJMXzA6xjux3L4z8M8IfZMwPD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUg5UWhRZWNualNPV29NemRwWTIxUGl6Y2F1YVQ5YlQ2U0EzMVZjdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1776930955),
('jlyMEIZmX4hS3I6FZKe7hvS9FWEXXOXYCsuMrkrt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVlF3NU42OFRWRXVlVUVmVG1MbnE3Y0VXdE1idHhpemtKUVFkN3hKSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1776930340),
('VZl7dnGjIntExi5lshWpfJKOcT9QKCjaxIQAveGP', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHFHa01LT3NvQlZoMG9nRmR1QnMwWk9qZ1FzWWdreWg4RkVFa2E1dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1776930295);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `profile_photo`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', NULL, '$2y$12$/7YjGFaywK/mpaFgz1oRYelqgotzlCvYoOC/.lR2t1VX26FzRRNi2', '081234567890', 'profile-photos/tEb3cOzXMK0fHqPSgM3GUMQForxObdjcUzZfMdfl.jpg', 'Skanic OI OI', 'vkbQYZZe0vVeQiI8aOJocvQWYmjevRNaU7akWgHxd1U3t1ry8PQiM9G8nhYy', '2026-04-16 03:31:23', '2026-04-22 17:25:52'),
(2, 'Petugas Penyetujuan 01', 'petugas@example.com', NULL, '$2y$12$u/3pI6EjimUkekyjHBlGYuT5..a4zXuzVpq/20WXmJ5KHt.21LAJW', '081234567891', 'profile-photos/MKkyFro2RWlB6ajD8Dte7Otrlgrg2aJWFJVcudW9.png', NULL, NULL, '2026-04-16 03:31:24', '2026-04-22 18:52:23'),
(10, 'Rantuy', 'ran@example.com', NULL, '$2y$12$Fv/sIZuSjEqvlBDcPlc3o.sJCYUnrO4W.0LRyMTPyjlWtcs7bOxLW', '089531311057', 'profile-photos/91QB1h9kJPewXBPEUyNSEN5Tr0BegvF1dHTFBZyj.jpg', 'depan parkiran', NULL, '2026-04-22 18:08:37', '2026-04-22 18:08:37'),
(11, 'Petugas Penyetujuan 02', 'petugas2@example.com', NULL, '$2y$12$1G2COX1vbEE7teaPlU78eevsJqG8qv8uIrOC5MRAcIqZj7qm1yPgO', '081122334455', 'profile-photos/2Op1xLJRTwbsYzQxgIjHwl9mTAbxfkYH3FpaDGzG.jpg', 'Skanic love', NULL, '2026-04-22 18:54:04', '2026-04-22 18:54:04'),
(13, 'Revan', 'revandra@example.com', NULL, '$2y$12$OIW96WULnliEwz8VAA4QvupuqaWrRXH.Ft7rjx9XME3oswvxjw2Bm', NULL, NULL, NULL, NULL, '2026-04-23 00:35:13', '2026-04-23 00:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipments_category_id_foreign` (`category_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowings_user_id_foreign` (`user_id`),
  ADD KEY `borrowings_approved_by_foreign` (`approved_by`),
  ADD KEY `borrowings_payment_verified_by_foreign` (`payment_verified_by`),
  ADD KEY `borrowings_book_id_foreign` (`book_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `equipments_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `borrowings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowings_payment_verified_by_foreign` FOREIGN KEY (`payment_verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `borrowings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
