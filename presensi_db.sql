-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Apr 2023 pada 03.31
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(191) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_category`
--

CREATE TABLE `forum_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_19_075112_create_table_presensi', 1),
(6, '2023_01_16_999999_add_active_status_to_users', 1),
(7, '2023_01_16_999999_add_avatar_to_users', 1),
(8, '2023_01_16_999999_add_dark_mode_to_users', 1),
(9, '2023_01_16_999999_add_messenger_color_to_users', 1),
(10, '2023_01_16_999999_create_favorites_table', 1),
(11, '2023_01_16_999999_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 3, 'auth_token', '4d4932e67df0300c6184a65b2671fabcddc758ad1144d155a992048a265830d2', '[\"*\"]', '2023-01-26 07:05:45', '2023-01-26 00:01:48', '2023-01-26 07:05:45'),
(3, 'App\\Models\\User', 10, 'auth_token', '21ce6225b54441dc0d75b2cbf423f635ee0d3f71101c6156893eaa7c8f7f002d', '[\"*\"]', '2023-01-26 07:07:35', '2023-01-26 00:05:00', '2023-01-26 07:07:35'),
(4, 'App\\Models\\User', 10, 'auth_token', '3538605cf3bbc3a1c06f365442c4a379cde21f0f02f2da7d7e7817014a93864f', '[\"*\"]', '2023-01-26 00:07:31', '2023-01-26 00:07:01', '2023-01-26 00:07:31'),
(7, 'App\\Models\\User', 20, 'auth_token', '7b2a8fdc73e73744498f69ee633bebe3df89ce5194b6ec09bb5c8b6546d4a6a1', '[\"*\"]', '2023-01-27 03:24:42', '2023-01-26 20:23:23', '2023-01-27 03:24:42'),
(11, 'App\\Models\\User', 3, 'auth_token', '014c2951607e2681e66863810dfa2a2886560b5f6c90538d39adc399666e08f2', '[\"*\"]', NULL, '2023-01-29 17:18:39', '2023-01-29 17:18:39'),
(12, 'App\\Models\\User', 9027, 'auth_token', '12236bbef4821e60449fc653a720415e54f84940985c0399b4403cc1a797f53b', '[\"*\"]', '2023-01-30 02:30:21', '2023-01-29 17:19:01', '2023-01-30 02:30:21'),
(13, 'App\\Models\\User', 10178, 'auth_token', '9fd6e0d2bd9b0abd1bc422efef01c40235d958d163bef321531af882c3c04a26', '[\"*\"]', '2023-02-06 05:43:16', '2023-02-05 20:18:50', '2023-02-06 05:43:16'),
(19, 'App\\Models\\User', 6702, 'auth_token', '165e8edfb589ee2b87c1066977a9be72d1391dc669c0c12c0f5a1b787db2d026', '[\"*\"]', '2023-02-06 06:50:34', '2023-02-05 23:30:09', '2023-02-06 06:50:34'),
(20, 'App\\Models\\User', 6702, 'auth_token', '0aecb6aa9d5e8b9443d068821a8609cf9040dcee8de1ecfefeea686174c69c9a', '[\"*\"]', NULL, '2023-02-05 23:50:13', '2023-02-05 23:50:13'),
(21, 'App\\Models\\User', 6706, 'auth_token', '012101ce04c48819f496ea2d8fd81f1205847083416716652d250a748d7fa5e5', '[\"*\"]', '2023-02-06 06:53:22', '2023-02-05 23:51:22', '2023-02-06 06:53:22'),
(23, 'App\\Models\\User', 10181, 'auth_token', '7209fe13266033e79d2f08cb00596c37fac7bab7e62cf756493f758b1b97b04d', '[\"*\"]', '2023-02-07 04:50:59', '2023-02-06 21:46:02', '2023-02-07 04:50:59'),
(24, 'App\\Models\\User', 10192, 'auth_token', '895dbe222302f8a5c1fa0d0c25f6f02232f85495db5fc55b0deea3022b365f44', '[\"*\"]', NULL, '2023-02-07 18:14:46', '2023-02-07 18:14:46'),
(25, 'App\\Models\\User', 10192, 'auth_token', 'a8fc8118287ff75a0adb8977ef6902c9f80b9f485040f688c353a0904a58040e', '[\"*\"]', NULL, '2023-02-07 19:24:30', '2023-02-07 19:24:30'),
(26, 'App\\Models\\User', 10190, 'auth_token', '4b90ca63b21b64cd3dd17291eccca8c61e7f994ffd9497e3faf3ccb34db91a60', '[\"*\"]', '2023-02-13 03:43:34', '2023-02-12 20:42:18', '2023-02-13 03:43:34'),
(27, 'App\\Models\\User', 10200, 'auth_token', '602c18a211569f716f3ab5586181bf8c36d19e872d5a170ceb34520634b9bd60', '[\"*\"]', '2023-02-13 06:26:52', '2023-02-12 20:44:18', '2023-02-13 06:26:52'),
(28, 'App\\Models\\User', 10201, 'auth_token', '859d1e5d6955dd77550a627d79fb1af1e986fd6f89a0e0cf0278698b7091c8cd', '[\"*\"]', '2023-02-13 04:12:18', '2023-02-12 21:12:05', '2023-02-13 04:12:18'),
(29, 'App\\Models\\User', 10219, 'auth_token', '4caedfdc0a9b5fbb92039b98e6f36896a9ca160eb5fe7e4fee35363fab5aef31', '[\"*\"]', NULL, '2023-02-13 22:45:19', '2023-02-13 22:45:19'),
(30, 'App\\Models\\User', 10219, 'auth_token', 'cff6db456aa102bf13ca000d93db01297622727e9dabd6cf99cd33cc1d0fb726', '[\"*\"]', '2023-02-19 20:24:47', '2023-02-13 22:45:44', '2023-02-19 20:24:47'),
(31, 'App\\Models\\User', 10219, 'api', '66c7406d4df7d4e5f631075e58d0b0096c76d149433ebd1e08bde0c31adc3dd3', '[\"*\"]', NULL, '2023-02-14 06:27:08', '2023-02-14 06:27:08'),
(32, 'App\\Models\\User', 10219, 'api', 'e5705c5962e26079c7bc4f7f0ae2d52bf1939928bd481455722424d9495ac21e', '[\"*\"]', NULL, '2023-02-14 06:27:10', '2023-02-14 06:27:10'),
(33, 'App\\Models\\User', 10219, 'api', 'bf001f071f4cbc666df224f302a92c27a2683ecec35d38345c5dfd3c07c97020', '[\"*\"]', NULL, '2023-02-14 06:27:11', '2023-02-14 06:27:11'),
(34, 'App\\Models\\User', 10213, 'auth_token', '3898976f7e66524ad644bd77f2e539155671940b5755c0db2099498f4595aec9', '[\"*\"]', '2023-02-16 01:50:10', '2023-02-13 23:40:55', '2023-02-16 01:50:10'),
(35, 'App\\Models\\User', 10197, 'auth_token', '370ff9656c50815c50d316251e1b760cbc30974f93791b3934917e9a92a636cf', '[\"*\"]', '2023-02-16 01:50:37', '2023-02-15 18:29:26', '2023-02-16 01:50:37'),
(36, 'App\\Models\\User', 10197, 'auth_token', 'a7f9ccb6df323c05fc9dbda29b389d1479af95071c03d8b558859a3832b9249e', '[\"*\"]', '2023-02-20 07:30:09', '2023-02-19 23:54:41', '2023-02-20 07:30:09'),
(37, 'App\\Models\\User', 10197, 'auth_token', '786fdf63904b1ad0bbde08c3fbda832dcfec6ff0503171b3d53f41369a9517aa', '[\"*\"]', '2023-02-20 06:59:10', '2023-02-19 23:58:59', '2023-02-20 06:59:10'),
(38, 'App\\Models\\User', 10197, 'auth_token', '44711bdc66385a8318b88172141bdda15e256d535d87eb6f230f09abd5955262', '[\"*\"]', '2023-03-07 08:34:10', '2023-02-21 17:37:16', '2023-03-07 08:34:10'),
(39, 'App\\Models\\User', 10197, 'auth_token', '1d14addd365b03b4e07d18dcb2027f2c56861fec1410e2d7016ddb680379d586', '[\"*\"]', NULL, '2023-02-22 19:24:56', '2023-02-22 19:24:56'),
(40, 'App\\Models\\User', 10197, 'auth_token', '1298975c85d6dcad01ebc7bca7a8a0ded21fd7f32caab4dfc571a9e4c54058f7', '[\"*\"]', '2023-03-07 08:34:20', '2023-02-27 19:11:46', '2023-03-07 08:34:20'),
(41, 'App\\Models\\User', 10197, 'auth_token', '4b3adc33f0ba11dc730492bec4da86367caa994099dc34bb477d3d07d1149f0e', '[\"*\"]', NULL, '2023-03-06 18:15:09', '2023-03-06 18:15:09'),
(42, 'App\\Models\\User', 10197, 'auth_token', '0e8dc525e251494f36032c26fb999701725404b50bc006ffb5a711511256e5a5', '[\"*\"]', NULL, '2023-03-06 19:17:07', '2023-03-06 19:17:07'),
(43, 'App\\Models\\User', 10197, 'auth_token', '2c15cb20a5d651d976323bda283341ee0920522c4ef095c2da8ba3cbbfc4a408', '[\"*\"]', NULL, '2023-03-06 19:39:25', '2023-03-06 19:39:25'),
(44, 'App\\Models\\User', 10197, 'auth_token', 'f4ec55be5567f6152bdc1904a28692285d2f9411998344f36de2e90d19b92fa7', '[\"*\"]', NULL, '2023-03-06 19:40:17', '2023-03-06 19:40:17'),
(45, 'App\\Models\\User', 10197, 'auth_token', 'a013d47c340bb99d7c022f427921b9d59b704d4fa9aa767f8bf8d12da3ad544b', '[\"*\"]', NULL, '2023-03-06 19:41:22', '2023-03-06 19:41:22'),
(46, 'App\\Models\\User', 10197, 'auth_token', '35063d355fe402f488d70f12dfbe072f1acb4aeab2374e8a189d7f3f10a52d8f', '[\"*\"]', NULL, '2023-03-06 19:42:03', '2023-03-06 19:42:03'),
(47, 'App\\Models\\User', 10197, 'auth_token', 'c62a126a8f3610948ff1b752c53e0c9e4a34492d34110bca5cb72a863f46d735', '[\"*\"]', NULL, '2023-03-06 19:43:13', '2023-03-06 19:43:13'),
(48, 'App\\Models\\User', 10197, 'auth_token', 'a5ae6f362f33d6da29822b9e21419c99038b4d72215a7c15a195c1338905a7f0', '[\"*\"]', NULL, '2023-03-07 01:31:56', '2023-03-07 01:31:56'),
(49, 'App\\Models\\User', 10197, 'auth_token', '08c69415c127609d5d4e60c725c2610eeb22e67ba9b8403ee7c8fe279732b1a8', '[\"*\"]', NULL, '2023-03-08 23:44:03', '2023-03-08 23:44:03'),
(50, 'App\\Models\\User', 10197, 'auth_token', 'df4f86a5190b6df75492d40e7442abd5cadc39e7bf752b34923a774c56cf9036', '[\"*\"]', '2023-03-09 08:18:40', '2023-03-08 23:44:13', '2023-03-09 08:18:40'),
(51, 'App\\Models\\User', 10197, 'auth_token', 'ead5e778a673df905d743937e283231f4ea25694b029d1f21a461056c0724a86', '[\"*\"]', NULL, '2023-03-08 23:45:10', '2023-03-08 23:45:10'),
(52, 'App\\Models\\User', 10224, 'auth_token', 'b0765480ac52f4178a531704f77042a8651c78545d9e05ce6ff84e7d1c5728a6', '[\"*\"]', '2023-03-10 01:45:08', '2023-03-09 17:39:44', '2023-03-10 01:45:08'),
(53, 'App\\Models\\User', 10195, 'auth_token', '1f5541427efec1f80f58a1064373a340cb9353d0ca39d16a4e8ab00a5b0ed288', '[\"*\"]', '2023-03-10 03:19:38', '2023-03-09 17:45:47', '2023-03-10 03:19:38'),
(54, 'App\\Models\\User', 10223, 'auth_token', 'e0c56d1b12e9711269931150b582e3e058c1170df0a24efe7c511fcd0fa154c3', '[\"*\"]', '2023-03-10 03:29:24', '2023-03-09 19:20:27', '2023-03-10 03:29:24'),
(55, 'App\\Models\\User', 10195, 'auth_token', '501e3777fdd34dec8664341c162437bb660449bf88382f683946fb732043a58b', '[\"*\"]', '2023-03-15 08:08:53', '2023-03-14 19:29:27', '2023-03-15 08:08:53'),
(56, 'App\\Models\\User', 10251, 'auth_token', '72cb9d8b1fc7835f21b571113b4761f5e47b764b9af7d6519cb40d3658d7d43c', '[\"*\"]', '2023-03-16 03:42:11', '2023-03-15 19:29:18', '2023-03-16 03:42:11'),
(57, 'App\\Models\\User', 10251, 'auth_token', '537de655e126fa245facaecdbe66840b0ac0a93205ef63e8f1ee09b385cf549a', '[\"*\"]', NULL, '2023-04-02 18:30:17', '2023-04-02 18:30:17'),
(58, 'App\\Models\\User', 10195, 'auth_token', 'be05142b03379363ae75c481815470b121a309080de243afd1fc90073dbdf27e', '[\"*\"]', NULL, '2023-04-12 21:48:43', '2023-04-12 21:48:43'),
(59, 'App\\Models\\User', 10195, 'auth_token', '9458058fc47af1d25e3d7865f4e8544cafa74e3d446241089ea499b2ef922152', '[\"*\"]', NULL, '2023-04-12 21:48:52', '2023-04-12 21:48:52'),
(60, 'App\\Models\\User', 10195, 'auth_token', 'd9f6e91f1abae6cfd40dd681c6f474dcac168735d0f7cbe660e2f9656b1a0dcc', '[\"*\"]', '2023-04-14 01:41:59', '2023-04-12 21:50:26', '2023-04-14 01:41:59'),
(61, 'App\\Models\\User', 10195, 'auth_token', '77bb758971016a17b0fab8e9c1d04ce62df9f9dcb35a64273ca54f215dac5d5d', '[\"*\"]', '2023-04-17 05:51:51', '2023-04-16 21:48:00', '2023-04-17 05:51:51'),
(62, 'App\\Models\\User', 10257, 'auth_token', '03084bc0e5fa3db95ccd801a428be26f96eef0cd2370415362b0168497f9f217', '[\"*\"]', '2023-04-17 06:52:46', '2023-04-16 21:58:32', '2023-04-17 06:52:46'),
(63, 'App\\Models\\User', 10197, 'auth_token', 'b43a7a952130b2f61986d09d0bdfa2110c7a63c8839626d7fc796f93cbfd0449', '[\"*\"]', '2023-04-17 09:43:44', '2023-04-17 01:38:04', '2023-04-17 09:43:44'),
(64, 'App\\Models\\User', 10233, 'auth_token', 'dd5e4d8dc8a0591d354ac32443635a4fd3f8700d1d6fab59c43b611eb2440eb7', '[\"*\"]', '2023-04-17 10:13:09', '2023-04-17 02:08:50', '2023-04-17 10:13:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensis`
--

CREATE TABLE `presensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` decimal(12,5) NOT NULL,
  `longitude` decimal(12,5) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time NOT NULL,
  `pulang` time NOT NULL,
  `ph_id` int(20) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `presensis`
--

INSERT INTO `presensis` (`id`, `user_id`, `latitude`, `longitude`, `tanggal`, `masuk`, `pulang`, `ph_id`, `ps_id`, `created_at`, `updated_at`) VALUES
(59, 10197, '-314.32570', '332.87990', '2023-02-22', '11:38:52', '00:00:00', 1, 1, '2023-02-22 04:38:52', '2023-02-22 04:38:52'),
(60, 10197, '-314.32570', '332.87990', '2023-02-22', '11:40:50', '00:00:00', 2, 1, '2023-02-22 04:40:50', '2023-02-22 04:40:50'),
(61, 10197, '-314.32570', '332.87990', '2023-02-22', '11:59:16', '00:00:00', 2, 1, '2023-02-22 04:59:16', '2023-02-22 04:59:16'),
(62, 10197, '-314.32570', '332.87990', '2023-02-22', '14:27:04', '00:00:00', 2, 1, '2023-02-22 07:27:04', '2023-02-22 07:27:04'),
(63, 10197, '-314.32570', '332.87990', '2023-03-07', '09:17:19', '00:00:00', 2, 1, '2023-03-07 02:17:19', '2023-03-07 02:17:19'),
(64, 10197, '-314.32570', '332.87990', '2023-03-07', '09:41:34', '00:00:00', 2, 1, '2023-03-07 02:41:34', '2023-03-07 02:41:34'),
(65, 10197, '-314.32570', '332.87990', '2023-03-07', '09:43:32', '00:00:00', 2, 1, '2023-03-07 02:43:32', '2023-03-07 02:43:32'),
(66, 10197, '-314.32570', '332.87990', '2023-03-07', '15:32:04', '00:00:00', 2, 1, '2023-03-07 08:32:04', '2023-03-07 08:32:04'),
(67, 10197, '-314.32570', '332.87990', '2023-03-07', '15:32:34', '00:00:00', 2, 1, '2023-03-07 08:32:34', '2023-03-07 08:32:34'),
(68, 10197, '-314.32570', '332.87990', '2023-03-07', '15:33:11', '00:00:00', 2, 1, '2023-03-07 08:33:11', '2023-03-07 08:33:11'),
(69, 10197, '-314.32570', '332.87990', '2023-03-07', '15:33:28', '00:00:00', 2, 1, '2023-03-07 08:33:28', '2023-03-07 08:33:28'),
(70, 10197, '-314.32570', '332.87990', '2023-03-07', '15:34:10', '00:00:00', 2, 1, '2023-03-07 08:34:10', '2023-03-07 08:34:10'),
(71, 10197, '-314.32570', '332.87990', '2023-03-09', '14:44:40', '00:00:00', 2, 1, '2023-03-09 07:44:40', '2023-03-09 07:44:40'),
(72, 10197, '-314.32570', '332.87990', '2023-03-09', '14:50:32', '00:00:00', 1, 1, '2023-03-09 07:50:32', '2023-03-09 07:50:32'),
(73, 10197, '-314.32570', '332.87990', '2023-03-09', '14:50:36', '00:00:00', 1, 1, '2023-03-09 07:50:36', '2023-03-09 07:50:36'),
(74, 10197, '-314.32570', '332.87990', '2023-03-09', '14:50:41', '00:00:00', 1, 1, '2023-03-09 07:50:41', '2023-03-09 07:50:41'),
(75, 10197, '-314.32570', '332.87990', '2023-03-09', '14:51:02', '00:00:00', 1, 1, '2023-03-09 07:51:02', '2023-03-09 07:51:02'),
(76, 10197, '-314.32570', '332.87990', '2023-03-09', '15:18:40', '00:00:00', 1, 1, '2023-03-09 08:18:40', '2023-03-09 08:18:40'),
(77, 10224, '-314.32570', '332.87990', '2023-03-10', '08:40:17', '00:00:00', 1, 1, '2023-03-10 01:40:17', '2023-03-10 01:40:17'),
(78, 10224, '-314.32570', '332.87990', '2023-03-10', '08:40:45', '00:00:00', 2, 1, '2023-03-10 01:40:45', '2023-03-10 01:40:45'),
(79, 10224, '-314.32570', '332.87990', '2023-03-10', '08:40:59', '00:00:00', 2, 1, '2023-03-10 01:40:59', '2023-03-10 01:40:59'),
(80, 10224, '-314.32570', '332.87990', '2023-03-10', '08:41:24', '00:00:00', 2, 3, '2023-03-10 01:41:24', '2023-03-10 01:41:24'),
(81, 10195, '-314.32570', '332.87990', '2023-03-10', '10:19:38', '00:00:00', 2, 1, '2023-03-10 01:46:19', '2023-03-10 03:19:38'),
(82, 10195, '-314.32570', '332.87990', '2023-03-10', '10:19:38', '00:00:00', 2, 1, '2023-03-10 01:50:00', '2023-03-10 03:19:38'),
(83, 10195, '-314.32570', '332.87990', '2023-03-10', '10:19:38', '00:00:00', 2, 1, '2023-03-10 01:50:04', '2023-03-10 03:19:38'),
(84, 10195, '-314.32570', '332.87990', '2023-03-10', '10:19:38', '00:00:00', 2, 1, '2023-03-10 01:50:12', '2023-03-10 03:19:38'),
(85, 10223, '-314.32570', '332.87990', '2023-03-10', '10:28:44', '00:00:00', 1, 1, '2023-03-10 03:21:18', '2023-03-10 03:28:44'),
(86, 10195, '-314.32220', '332.87240', '2023-03-15', '15:08:53', '00:00:00', 1, 1, '2023-03-15 03:31:20', '2023-03-15 08:08:53'),
(87, 10251, '-314.32220', '332.87240', '2023-03-16', '10:30:21', '00:00:00', 2, 1, '2023-03-16 03:29:45', '2023-03-16 03:30:21'),
(88, 10251, '-314.32220', '332.87240', '2023-03-16', '10:41:27', '00:00:00', 1, 1, '2023-03-16 03:41:27', '2023-03-16 03:41:27'),
(89, 10251, '-314.32220', '332.87240', '2023-03-16', '10:42:11', '00:00:00', 2, 1, '2023-03-16 03:42:11', '2023-03-16 03:42:11'),
(90, 10195, '-314.32220', '332.87240', '2023-04-13', '12:50:45', '00:00:00', 2, 1, '2023-04-13 05:50:45', '2023-04-13 05:50:45'),
(91, 10195, '-314.32220', '332.87240', '2023-04-13', '12:50:52', '00:00:00', 1, 1, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(92, 10195, '-314.32220', '332.87240', '2023-04-13', '12:52:44', '00:00:00', 1, 1, '2023-04-13 05:52:44', '2023-04-13 05:52:44'),
(93, 10195, '-314.32220', '332.87240', '2023-04-13', '12:54:20', '00:00:00', 1, 1, '2023-04-13 05:54:20', '2023-04-13 05:54:20'),
(94, 10195, '-314.32220', '332.87240', '2023-04-13', '12:54:34', '00:00:00', 2, 1, '2023-04-13 05:54:34', '2023-04-13 05:54:34'),
(95, 10195, '-314.32220', '332.87240', '2023-04-13', '12:55:05', '00:00:00', 2, 2, '2023-04-13 05:55:05', '2023-04-13 05:55:05'),
(96, 10195, '-314.32220', '332.87240', '2023-04-13', '12:59:04', '00:00:00', 1, 2, '2023-04-13 05:59:04', '2023-04-13 05:59:04'),
(97, 10195, '-314.32220', '332.87240', '2023-04-13', '13:15:02', '00:00:00', 1, 1, '2023-04-13 06:15:02', '2023-04-13 06:15:02'),
(98, 10195, '-314.32220', '332.87240', '2023-04-13', '13:15:18', '00:00:00', 1, 1, '2023-04-13 06:15:18', '2023-04-13 06:15:18'),
(99, 10195, '-314.32220', '332.87240', '2023-04-13', '13:15:33', '00:00:00', 2, 1, '2023-04-13 06:15:33', '2023-04-13 06:15:33'),
(100, 10195, '-314.32220', '332.87240', '2023-04-14', '08:41:55', '00:00:00', 2, 1, '2023-04-14 01:41:55', '2023-04-14 01:41:55'),
(101, 10195, '-314.32220', '332.87240', '2023-04-14', '08:41:59', '00:00:00', 2, 1, '2023-04-14 01:41:59', '2023-04-14 01:41:59'),
(102, 10195, '-314.32220', '332.87240', '2023-04-17', '12:48:30', '00:00:00', 2, 1, '2023-04-17 05:48:30', '2023-04-17 05:48:30'),
(106, 10197, '-314.32220', '332.87240', '2023-04-17', '16:38:23', '00:00:00', 1, 1, '2023-04-17 09:38:23', '2023-04-17 09:38:23'),
(107, 10197, '-314.32223', '332.87240', '2023-04-17', '16:42:53', '00:00:00', 1, 1, '2023-04-17 09:42:53', '2023-04-17 09:42:53'),
(108, 10197, '-314.32223', '332.87240', '2023-04-17', '16:43:44', '00:00:00', 1, 1, '2023-04-17 09:43:44', '2023-04-17 09:43:44'),
(110, 10233, '-314.32223', '332.87240', '2023-04-17', '17:11:42', '00:00:00', 1, 1, '2023-04-17 10:11:42', '2023-04-17 10:11:42'),
(111, 10233, '-314.32223', '332.87240', '2023-04-17', '17:13:09', '00:00:00', 1, 1, '2023-04-17 10:13:09', '2023-04-17 10:13:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensis_detail`
--

CREATE TABLE `presensis_detail` (
  `pd_id` int(11) NOT NULL,
  `ps_id` bigint(25) NOT NULL,
  `ph_id` bigint(25) NOT NULL,
  `presensi_id` bigint(25) NOT NULL,
  `checkin_id` bigint(25) NOT NULL,
  `loc_id` bigint(25) NOT NULL,
  `pd_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pd_file` varchar(250) NOT NULL,
  `pd_desc` varchar(250) NOT NULL,
  `holiday_desc` varchar(250) NOT NULL,
  `pd_lat` float(10,6) NOT NULL,
  `pd_lng` float(10,6) NOT NULL,
  `pd_is_late` bigint(25) NOT NULL,
  `pd_late_length` varchar(250) NOT NULL,
  `pd_potongan_tpp` decimal(5,0) NOT NULL,
  `pd_is_holiday` varchar(250) NOT NULL,
  `created_by` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensis_holiday`
--

CREATE TABLE `presensis_holiday` (
  `presen_id` int(11) NOT NULL,
  `pegawai_id` bigint(20) NOT NULL,
  `presen_date` datetime NOT NULL,
  `presen_duration` varchar(200) NOT NULL,
  `is_pengajuan` int(11) NOT NULL,
  `pengajuan_as_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensis_hour`
--

CREATE TABLE `presensis_hour` (
  `id` int(11) NOT NULL,
  `ph_name` varchar(200) NOT NULL,
  `ph_desc` varchar(200) NOT NULL,
  `ph_time_start` time NOT NULL,
  `ph_time_end` time NOT NULL,
  `ah_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `presensis_hour`
--

INSERT INTO `presensis_hour` (`id`, `ph_name`, `ph_desc`, `ph_time_start`, `ph_time_end`, `ah_status`, `created_at`, `updated_at`) VALUES
(1, 'Presensi Masuk', 'Presensi Masuk Kerja', '07:30:16', '08:01:16', 1, '2023-02-14 01:17:16', '2023-02-14 01:17:16'),
(2, 'Presensi Pulang', 'Presensi Pulang Kerja', '16:30:01', '17:00:05', 1, '2023-02-14 01:17:16', '2023-02-14 01:17:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensis_status`
--

CREATE TABLE `presensis_status` (
  `as_id` int(11) NOT NULL,
  `as_name` varchar(190) NOT NULL,
  `as_alias` varchar(10) NOT NULL,
  `as_percent` double NOT NULL,
  `as_color` varchar(11) NOT NULL,
  `as_color2` varchar(200) NOT NULL,
  `as_color3` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `presensis_status`
--

INSERT INTO `presensis_status` (`as_id`, `as_name`, `as_alias`, `as_percent`, `as_color`, `as_color2`, `as_color3`, `created_at`, `updated_at`) VALUES
(1, 'hadir', 'H', 0, '#417AF7', '#4B4B49', '#FFE100', '2023-01-27 14:45:01', '2023-01-27 14:45:01'),
(2, 'tidak hadir', 'A', 5, '#417AF7', '#417AF7', '#4B4B49', '2023-01-27 14:45:01', '2023-01-27 14:45:01'),
(3, 'izin', 'I', 2, '#417AF7 ', '#4B4B49', '#FFE100', '2023-01-27 14:48:41', '2023-01-27 14:48:41'),
(4, 'sakit', 'S', 2, '#417AF7 ', '#4B4B49', '#FFE100', '2023-01-27 14:48:41', '2023-01-27 14:48:41'),
(5, 'cuti', 'C', 2, '#417AF7 ', '#4B4B49', '#FFE100', '2023-01-27 14:51:08', '2023-01-27 14:51:08'),
(6, 'tugas', 'TL', 0, '#417AF7 ', '#4B4B49', '#FFE100', '2023-01-27 14:51:08', '2023-01-27 14:51:08'),
(7, 'izin terlambat', 'IPC', 0, '#417AF7', '#4B4B49', '#FFE100', '2023-01-27 15:01:18', '0000-00-00 00:00:00'),
(8, 'izin pulang cepat', 'IPC', 0, '#417AF7', '#4B4B49', '#FFE100', '2023-01-27 14:59:27', '2023-01-27 14:59:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2023-02-14 07:52:29', '2023-01-29 01:45:59'),
(2, 'admin', '2023-01-29 01:46:55', '2023-01-29 01:45:18'),
(3, 'guru', '2023-01-29 01:46:52', '2023-01-29 01:45:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `radius` int(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `schools`
--

INSERT INTO `schools` (`id`, `name`, `latitude`, `longitude`, `radius`, `created_at`, `updated_at`) VALUES
(31, 'SMKN 1 PARINGIN', -2.356780, 115.460732, 50, '2023-01-27 06:43:58', '2023-01-27 06:43:58'),
(34, 'SMKN BATU MANDI', -2.358350, 115.458733, 50, '2023-03-16 02:02:05', '2023-03-15 19:02:05'),
(36, 'SMAN 2  BATU PIRING', -2.355510, 115.462334, 50, '2023-01-28 16:12:38', '2023-01-28 16:12:38'),
(121, 'SMA 2 JUAI', -2.358350, 115.458733, 50, '2023-03-16 00:41:44', '2023-03-15 17:41:44'),
(122, 'SMAN 1 TEBING TINGGI', -2.349520, 115.544823, 50, '2023-02-13 01:37:49', '2023-02-13 01:37:49'),
(123, 'SMAN 4 LAMPIHONG', -2.336910, 115.380798, 50, '2023-02-13 01:38:11', '2023-02-13 01:38:11'),
(126, 'SMA 1 BATUMANDI', -2.358890, 115.468338, 50, '2023-03-17 19:19:55', '2023-03-17 19:19:55'),
(128, 'SMA HASBUNALLAH PARINGIN', -2.354750, 115.468727, 70, '2023-04-17 18:01:28', '2023-04-17 18:01:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(25) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `radius` int(25) NOT NULL,
  `role_id` int(5) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(191) NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(191) NOT NULL DEFAULT '#2180f3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nip`, `name`, `email`, `school_id`, `latitude`, `longitude`, `radius`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(10195, '4567789898', 'Bkpp', 'admin@test.com', 121, 0, 0, 0, 1, NULL, '$2y$10$lOdn9qCStYNEZgQXJIfbiez.8CQcM4hUxJwMf9GB/VnPurl7re44S', NULL, '2023-02-12 17:32:53', '2023-02-12 17:32:53', 0, 'avatar.png', 0, '#2180f3'),
(10197, '32677842837247', 'sudirman', 'sudirman@mail.com', 36, 0, 0, 0, 3, NULL, '$2y$10$n2NJ1iDcGX0cA5l7173pGetfBqa9OctbvsEAPxBB.Pw.My8ErqAde', NULL, '2023-02-12 17:33:54', '2023-02-12 17:33:54', 0, 'avatar.png', 0, '#2180f3'),
(10203, '643782928', 'guru admin', 'guruadmin@mail.com', 121, 0, 0, 0, 2, NULL, '$2y$10$wvUKJaaiQUp828919fUff.h7kP4z8DozrCbJLhCaWMp36Y2Tyar3W', NULL, '2023-02-13 00:00:05', '2023-03-28 18:43:24', 0, 'avatar.png', 0, '#2180f3'),
(10223, '62773926723423984', 'namaku', 'namauqwdsxa@mail.com', 36, 0, 0, 0, 1, NULL, '1234', NULL, '2023-02-22 19:42:53', '2023-03-15 19:23:54', 0, 'avatar.png', 0, '#2180f3'),
(10224, '728938293', 'tutu', 'tutu@mail.com', 121, 0, 0, 0, 2, NULL, '$2y$10$AM5/Q94.NfMQC6H8o0dtTelUpE4smkfz2wNWSSi9bRr2q4pfEXfCi', NULL, '2023-02-22 19:43:24', '2023-02-22 19:43:24', 0, 'avatar.png', 0, '#2180f3'),
(10233, '63092398123977', 'nama baru', 'ahmad@mail.com', 34, 0, 0, 0, 2, NULL, '$2y$10$sQdtl/s6q2yzu8.b6W4aveMn0ATUoibB5nmOfafiajGoGH9FzIaf2', NULL, '2023-03-15 18:22:14', '2023-03-15 18:22:14', 0, 'avatar.png', 0, '#2180f3'),
(10242, '63019291309130', 'SMKN BATU MANDI', 'lukanneww@mail.com', 36, 0, 0, 0, 2, NULL, '$2y$10$A/2VcEUrfDxzQplvvFwxLOzUKcfNp0YmXp9luddnFU0nPrFcN8buq', NULL, '2023-03-15 19:10:44', '2023-03-15 19:10:44', 0, 'avatar.png', 0, '#2180f3'),
(10251, '6273889120302913', 'mencobai', 'mecnobai12@mama.com', 31, 0, 0, 0, 3, NULL, '$2y$10$fyFJFLtSlKBH2ybkQLL0iOo64kNKPEw/S1aTizRy2XYlE3G8RDMFa', NULL, '2023-03-15 19:28:11', '2023-03-15 19:28:11', 0, 'avatar.png', 0, '#2180f3'),
(10252, '623487932034', 'juansyah', 'juansyah@mail.com', 121, 0, 0, 0, 2, NULL, '$2y$10$zRMEnP0z62pkGGozFCl2ve/LAMY7FagN5bZzA943x.Wo6FBvXdD2y', NULL, '2023-03-19 17:29:31', '2023-03-19 17:29:31', 0, 'avatar.png', 0, '#2180f3'),
(10253, '63034981498884', 'Rolan', 'rolan@mail.com', 123, 0, 0, 0, 3, NULL, '$2y$10$CzmSxcsLsJMy8DUN199yj.yewX...M94dj7pwCFYHgkoX9mHOO4OS', NULL, '2023-03-19 17:30:13', '2023-03-19 17:30:13', 0, 'avatar.png', 0, '#2180f3'),
(10254, '66554567898888', 'testing', 'huh@mail.com', 36, 0, 0, 0, 3, NULL, '$2y$10$nVGbU1m7Lk/Qyvu7oS43P.r2B0fdB0.OsK4mMYGOaOuFnfZaNbgP6', NULL, '2023-03-19 20:52:07', '2023-03-19 20:52:07', 0, 'avatar.png', 0, '#2180f3'),
(10255, '6302838388392199', 'Juliannor', 'juliannor@mail.com', 122, 0, 0, 0, 2, NULL, '$2y$10$kzUkRzu4QQSaT50y6C8LDepPAoFkmPCxfdTuUFLAfssAEY4WLlpDi', NULL, '2023-03-28 18:44:13', '2023-03-28 18:48:18', 0, 'avatar.png', 0, '#2180f3'),
(10256, '62738382378', 'Rolland', 'rolland@mail.com', 31, 0, 0, 0, 3, NULL, '$2y$10$OVMJ.X5THdue//NanA7lX.cjnknIXOQaaHNc8c4MkSEr0u2oU2shC', NULL, '2023-03-28 18:49:03', '2023-03-28 18:49:43', 0, 'avatar.png', 0, '#2180f3'),
(10257, '63019281982910', 'userbaru', 'userbaru@gmail.com', 31, 0, 0, 0, 3, NULL, '$2y$10$Aa0CaTqyddmlK1po6adV4.EzvUh5rnh.BrXbd0emCrqnQwg1nuiKO', NULL, '2023-04-16 21:57:34', '2023-04-16 21:57:34', 0, 'avatar.png', 0, '#2180f3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `forum_category`
--
ALTER TABLE `forum_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `presensis`
--
ALTER TABLE `presensis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `presensis_detail`
--
ALTER TABLE `presensis_detail`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indeks untuk tabel `presensis_holiday`
--
ALTER TABLE `presensis_holiday`
  ADD PRIMARY KEY (`presen_id`);

--
-- Indeks untuk tabel `presensis_hour`
--
ALTER TABLE `presensis_hour`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `forum_category`
--
ALTER TABLE `forum_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `presensis`
--
ALTER TABLE `presensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `presensis_detail`
--
ALTER TABLE `presensis_detail`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `presensis_holiday`
--
ALTER TABLE `presensis_holiday`
  MODIFY `presen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `presensis_hour`
--
ALTER TABLE `presensis_hour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10258;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
