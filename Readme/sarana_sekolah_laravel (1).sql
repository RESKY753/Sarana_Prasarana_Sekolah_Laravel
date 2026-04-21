-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20251026.88b7dfd0f0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2026 at 11:31 PM
-- Server version: 8.4.3
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarana_sekolah_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Reskycuy', '$2y$12$PbNobzY5SUPDQbNCtau47uhoyoC5A8WwtsSQ5SSQonGEZF0pXCqgi'),
(4, 'Hilman NM', '$2y$12$oFESnVYNZocqBdOupffRVehGGebHTQZcKl.9cIu8dvYqq12FTReGu'),
(5, 'Razaqa', '$2y$12$5DdJ5eMc2fqJagNked.M6uaCvp1fKpt3fvqr7wmtxlUaTFb8hIpu6'),
(6, 'malvien', '$2y$12$KNqTsxdxzf.VHvgJOEhvXORuF0v1EFubudi/74llPPVEuV0wZQqDe'),
(7, 'Rezka', '$2y$12$wqhMWQ5JmsHMoH9qdKtqjeV4Q0jnHcXVcjEX3srqqJCwannYr5Puq');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `tanggal_lapor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_aspirasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_aspirasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `id_kategori`, `id_siswa`, `tanggal_lapor`, `lokasi`, `ket_aspirasi`, `judul_aspirasi`, `created_at`, `updated_at`) VALUES
(13, 5, 4, '2026-02-20 18:58:05', 'XI RPL 2', 'Papan Tulis ambruk tidak bisa belajar', 'Papan Tulis Rusak Ambruk', '2026-02-20 18:58:05', '2026-02-20 18:58:05'),
(32, 1, 5, '2026-03-13 23:48:30', 'X RPL 2', 'kaki meja rusak', 'Meja Rusak', '2026-03-13 23:48:30', '2026-03-13 23:48:30'),
(33, 4, 9, '2026-03-13 23:54:48', 'XI RPL 2', 'AC Kelas tidak dingin', 'Ac Kelas tidak dingin', '2026-03-13 23:54:48', '2026-03-13 23:54:48'),
(34, 3, 9, '2026-03-13 23:55:37', 'Lapangan', 'Lapangan berlubang', 'Lapangan berlubang', '2026-03-13 23:55:37', '2026-03-13 23:55:37'),
(37, 4, 9, '2026-03-31 18:17:46', 'xi rpl 2', 'lampu tidak bisa di nyalakan', 'lampu tidak nyala', '2026-03-31 18:17:46', '2026-03-31 18:17:46'),
(38, 2, 11, '2026-03-31 18:31:56', 'xi rpl 2', 'bolong karena kucing jatoh', 'atap atas kelas bolong', '2026-03-31 18:31:56', '2026-03-31 18:31:56'),
(39, 6, 9, '2026-03-31 19:09:38', 'XI RPL 4', 'lampu tidak menyala', 'lampu rusak', '2026-03-31 19:09:38', '2026-03-31 19:09:38'),
(40, 1, 9, '2026-03-31 20:46:58', 'p', 'p', 'p', '2026-03-31 20:46:58', '2026-03-31 20:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `ket_kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Kursi Atau Meja', NULL, NULL),
(2, 'Bangunan', NULL, NULL),
(3, 'Area Terbuka', NULL, NULL),
(4, 'Fasilitas Umum', NULL, NULL),
(5, 'Peralatan', NULL, NULL),
(6, 'Lainnya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_26_112630_admin', 1),
(5, '2026_01_27_233426_create_siswas_table', 1),
(6, '2026_01_27_233890_create_kategoris_table', 1),
(7, '2026_01_27_233902_create_aspirasis_table', 1),
(8, '2026_01_27_233920_create_progres_aspirasis_table', 1),
(9, '2026_02_07_113026_add_kolom_ket_progres', 2),
(10, '2026_02_07_120937_make_umpan_balik_nullable_on_progres_aspirasi_table', 3),
(11, '2026_02_07_125331_tambah_kolom_siswa', 4),
(12, '2026_02_08_110644_rubah_pajang_pass', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progres_aspirasi`
--

CREATE TABLE `progres_aspirasi` (
  `id_progres` bigint UNSIGNED NOT NULL,
  `id_aspirasi` bigint UNSIGNED NOT NULL,
  `tanggal_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_admin` bigint UNSIGNED NOT NULL,
  `umpan_balik` text COLLATE utf8mb4_unicode_ci,
  `status` enum('menunggu','diproses','selesai','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_progres` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progres_aspirasi`
--

INSERT INTO `progres_aspirasi` (`id_progres`, `id_aspirasi`, `tanggal_update`, `id_admin`, `umpan_balik`, `status`, `ket_progres`) VALUES
(49, 13, '2026-03-08 00:00:00', 4, NULL, 'diproses', 'proses'),
(53, 13, '2026-03-09 00:00:00', 4, '.', 'selesai', '.'),
(70, 32, '2026-03-14 06:48:58', 4, NULL, 'menunggu', 'Tunggu akan segera di perbaiki'),
(71, 32, '2026-03-14 06:49:33', 4, NULL, 'diproses', 'Petugas akan ke lokasi'),
(73, 34, '2026-03-14 06:58:06', 1, NULL, 'diproses', 'Sedang di perbaiki'),
(74, 33, '2026-03-14 06:58:34', 1, NULL, 'menunggu', 'Tunggu'),
(76, 37, '2026-04-01 01:18:48', 4, NULL, 'diproses', 'sedang perbaikan'),
(77, 33, '2026-04-01 01:27:38', 4, 'semoga nyaman kembali', 'selesai', 'sudah selesai'),
(78, 38, '2026-04-01 01:33:25', 4, NULL, 'diproses', 'baik di tungggu staff datang untuk memperbaiki yaa'),
(79, 39, '2026-04-01 02:11:14', 4, NULL, 'diproses', 'sedang perbaiki'),
(80, 39, '2026-04-01 03:03:25', 4, 'selesai', 'selesai', 'selesai'),
(81, 40, '2026-04-01 03:51:13', 4, NULL, 'menunggu', 'menunggu'),
(82, 40, '2026-04-01 03:53:21', 4, 'selesai', 'selesai', 'selesai'),
(83, 37, '2026-04-01 03:53:50', 4, 'selesai', 'selesai', 'selesai'),
(84, 34, '2026-04-09 01:39:37', 7, NULL, 'diproses', 'tes redirect');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h2sIppzRRnPJJ6aFvB8osXpOIqTat2MaRZmmPF3B', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieEtyTGJQMWNtSmhORGdSb3MyeGg4Zzg1RFpRanA4WVdaRXBhSGEzNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbi9EYXRhU2lzd2EiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1775699067),
('WIDNAXgEX3NS1HmJMnLIOWdSbzx5ShEfhITzKYdc', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNlpwWnZTdW56R20zekRuT0w3T0ZkazhiV2FwT3FxZ1hYYjM2dWJTdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbi9EYXNoYm9hcmRBZG1pbi9GaWx0ZXI/YnVsYW49JmthdGVnb3JpPSZzaXN3YT1pdHMmdGFuZ2dhbD0iO3M6NToicm91dGUiO047fXM6NTI6ImxvZ2luX3Npc3dhXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTcxMTExMTIwO3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1775016551);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nis` int NOT NULL,
  `kelas` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Nama` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `kelas`, `password`, `created_at`, `updated_at`, `Nama`) VALUES
(4, 971111114, 'XI RPL 1', '$2y$12$lBGV/Sgn91H..kh2AzEIi.5AzEGl4dWnM2l66kCWS578LDCfIJA2a', NULL, '2026-02-08 04:07:59', 'Rizkia'),
(5, 971111115, 'XI RPL 2', '$2y$12$Ea.88cBPPOYf4qhBkjqzu.bQlKQxcXbjbmeMKVqaeiJIg4OwDkHC.', NULL, '2026-02-08 04:07:59', 'Rezka P A'),
(7, 971111117, 'XI RPL 4', '$2y$12$dwUS.fnexZpaWj.cbU0nS.q/xLZvC1APK9nCZyNHvoD9a0ErUnpqO', NULL, NULL, 'Lutfi'),
(8, 971111121, 'XI RPL 1', '$2y$12$YUR0DdOxciX1vRcL.5sCR./WCQmauzvWWuwmOfv4.tnep/GexZLg2', NULL, NULL, 'Rizki Prasetya'),
(9, 971111120, 'XI RPL 2', '$2y$12$0VTs8KjAcUkPBoRBoRNcduFdLb71fEjC9zV72jG0RHIgHM9EBJebG', NULL, NULL, 'Its•Maul'),
(11, 971111123, 'XI RPL 4', '$2y$12$HFXM0Rqde04dY7eKqyOqHuGstiejng0Rb9w.rU8Qdq/AfTEEDsHHG', NULL, NULL, 'Rizki');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `aspirasi_id_kategori_foreign` (`id_kategori`),
  ADD KEY `aspirasi_id_siswa_foreign` (`id_siswa`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

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
-- Indexes for table `progres_aspirasi`
--
ALTER TABLE `progres_aspirasi`
  ADD PRIMARY KEY (`id_progres`),
  ADD KEY `progres_aspirasi_id_aspirasi_foreign` (`id_aspirasi`),
  ADD KEY `progres_aspirasi_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `progres_aspirasi`
--
ALTER TABLE `progres_aspirasi`
  MODIFY `id_progres` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `aspirasi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `progres_aspirasi`
--
ALTER TABLE `progres_aspirasi`
  ADD CONSTRAINT `progres_aspirasi_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE,
  ADD CONSTRAINT `progres_aspirasi_id_aspirasi_foreign` FOREIGN KEY (`id_aspirasi`) REFERENCES `aspirasi` (`id_aspirasi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
