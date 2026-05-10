-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2026 at 08:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irt_3pl_entrance_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
  `id` bigint UNSIGNED NOT NULL,
  `participant_id` bigint UNSIGNED NOT NULL,
  `theta` decimal(10,5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint UNSIGNED NOT NULL,
  `participant_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `question_statement_id` bigint UNSIGNED DEFAULT NULL,
  `option_id` bigint UNSIGNED DEFAULT NULL,
  `answer_text` longtext COLLATE utf8mb4_unicode_ci,
  `is_true` tinyint(1) DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('irt-3pl-entrance-exam-cache-boost:mcp:database-schema:mysql:programs', 'a:3:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:8:\"programs\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"slug\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:11:\"description\";a:1:{s:4:\"type\";s:4:\"text\";}s:9:\"is_active\";a:1:{s:4:\"type\";s:7:\"tinyint\";}s:18:\"portfolio_required\";a:1:{s:4:\"type\";s:7:\"tinyint\";}s:21:\"portfolio_description\";a:1:{s:4:\"type\";s:4:\"text\";}s:16:\"portfolio_weight\";a:1:{s:4:\"type\";s:7:\"decimal\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:8:\"capacity\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:20:\"programs_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}s:6:\"global\";a:4:{s:5:\"views\";a:0:{}s:17:\"stored_procedures\";a:0:{}s:9:\"functions\";a:0:{}s:9:\"sequences\";a:0:{}}}', 1778395784),
('irt-3pl-entrance-exam-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:10:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.48.1\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"v0.3.10\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.10\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.2\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:LIVEWIRE\";s:14:\"\0*\0packageName\";s:17:\"livewire/livewire\";s:10:\"\0*\0version\";s:5:\"4.2.1\";s:6:\"\0*\0dev\";b:0;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.5.2\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.5.2\";s:6:\"\0*\0dev\";b:1;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.27.0\";s:6:\"\0*\0dev\";b:1;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.52.0\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.3\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"4.3.1\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"12.5.4\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:6:\"12.5.4\";s:6:\"\0*\0dev\";b:1;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:ECHO\";s:14:\"\0*\0packageName\";s:12:\"laravel-echo\";s:10:\"\0*\0version\";s:5:\"2.3.0\";s:6:\"\0*\0dev\";b:1;}i:9;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"4.1.18\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1778385578;}', 1778471978);

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
-- Table structure for table `examples`
--

CREATE TABLE `examples` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `subtest_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `year` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `subtest_id`, `title`, `slug`, `description`, `start_time`, `end_time`, `duration`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 'Literasi Bahasa Indonesia 2026', 'literasi-bahasa-indonesia-2026', 'Mengukur kemampuan peserta dalam memahami, menganalisis, dan mengevaluasi berbagai jenis teks berbahasa Indonesia, termasuk kemampuan tata bahasa, kosakata, serta penalaran verbal.', '2026-06-01 08:00:00', '2026-06-01 10:00:00', 30, 2026, '2026-05-10 03:42:51', '2026-05-10 03:42:51'),
(2, 2, 'Literasi Bahasa Inggris 2026', 'literasi-bahasa-inggris-2026', 'Mengukur kemampuan peserta dalam memahami teks berbahasa Inggris, penguasaan grammar dan vocabulary, serta kemampuan menarik informasi dan kesimpulan dari bacaan.', '2026-06-01 08:00:00', '2026-06-01 10:00:00', 30, 2026, '2026-05-10 04:25:17', '2026-05-10 04:25:17'),
(3, 3, 'Penalaran Matematika 2026', 'penalaran-matematika-2026', 'Mengukur kemampuan peserta dalam memahami konsep matematika, menyelesaikan persoalan numerik, berpikir logis, serta menerapkan strategi penyelesaian masalah secara sistematis.', '2026-06-01 08:00:00', '2026-06-01 10:00:00', 30, 2026, '2026-05-10 04:25:57', '2026-05-10 04:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint UNSIGNED NOT NULL,
  `participant_id` bigint UNSIGNED NOT NULL,
  `total_correct` int NOT NULL DEFAULT '0',
  `score_classical` decimal(8,2) NOT NULL DEFAULT '0.00',
  `score_irt` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `score_classical_weighted` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `score_irt_weighted` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `final_score` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `scoring_breakdown` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `item_parameters`
--

CREATE TABLE `item_parameters` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `question_statement_id` bigint UNSIGNED DEFAULT NULL,
  `a` decimal(8,4) NOT NULL,
  `b` decimal(8,4) NOT NULL,
  `c` decimal(8,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2026_03_01_080247_create_notifications_table', 1),
(5, '2026_04_12_082339_create_examples_table', 1),
(6, '2026_05_06_104455_create_subtests_table', 1),
(7, '2026_05_06_104655_create_exams_table', 1),
(8, '2026_05_06_104851_create_questions_table', 1),
(9, '2026_05_06_105202_create_options_table', 1),
(10, '2026_05_06_105302_create_participants_table', 1),
(11, '2026_05_06_105348_create_answers_table', 1),
(12, '2026_05_06_105437_create_item_parameters_table', 1),
(13, '2026_05_06_105630_create_abilities_table', 1),
(14, '2026_05_06_105717_create_exam_results_table', 1),
(15, '2026_05_06_105800_create_programs_table', 1),
(16, '2026_05_06_105810_create_program_subtest_weights_table', 1),
(17, '2026_05_06_105820_create_program_participant_table', 1),
(18, '2026_05_07_152449_update_questions_for_question_types', 1),
(19, '2026_05_07_152450_update_answers_for_question_types', 1),
(20, '2026_05_07_152451_create_question_statements_table', 1),
(21, '2026_05_07_152452_update_item_parameters_for_statement_items', 1),
(22, '2026_05_08_110000_add_portfolio_fields_to_programs_table', 1),
(23, '2026_05_09_100000_add_portfolio_columns_to_program_participant_table', 1),
(24, '2026_05_10_134727_add_capacity_to_programs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` json DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `option_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>memaksa</p>', 0, '2026-05-10 04:21:24', '2026-05-10 04:21:24'),
(2, 1, '<p>melarang</p>', 0, '2026-05-10 04:21:35', '2026-05-10 04:21:35'),
(3, 1, '<p>mengajak</p>', 1, '2026-05-10 04:21:43', '2026-05-10 04:21:43'),
(4, 1, '<p>menghukum</p>', 0, '2026-05-10 04:21:49', '2026-05-10 04:21:49'),
(5, 1, '<p>mengawasi</p>', 0, '2026-05-10 04:21:56', '2026-05-10 04:21:56'),
(6, 2, '<p>Internet membuat siswa malas membaca buku cetak</p>', 0, '2026-05-10 07:05:01', '2026-05-10 07:05:01'),
(7, 2, '<p>Koleksi digital mempermudah akses sumber belajar</p>', 1, '2026-05-10 07:05:17', '2026-05-10 07:05:17'),
(8, 2, '<p>Perpustakaan sekolah wajib menggunakan internet</p>', 0, '2026-05-10 07:05:26', '2026-05-10 07:05:46'),
(9, 2, '<p>Buku cetak sudah tidak diperlukan lagi</p>', 0, '2026-05-10 07:05:57', '2026-05-10 07:05:57'),
(10, 2, '<p>Semua siswa menyukai perpustakaan digital</p>', 0, '2026-05-10 07:06:07', '2026-05-10 07:06:07'),
(11, 3, '<p>tetap</p>', 0, '2026-05-10 07:06:32', '2026-05-10 07:06:32'),
(12, 3, '<p>meskipun</p>', 1, '2026-05-10 07:06:40', '2026-05-10 07:06:40'),
(13, 3, '<p>sangat</p>', 0, '2026-05-10 07:06:48', '2026-05-10 07:06:48'),
(14, 3, '<p>ke</p>', 0, '2026-05-10 07:06:54', '2026-05-10 07:06:54'),
(15, 3, '<p>dan</p>', 0, '2026-05-10 07:07:00', '2026-05-10 07:07:00'),
(16, 4, '<p>Para siswa-siswa sedang mengikuti lomba.</p>', 0, '2026-05-10 07:07:20', '2026-05-10 07:07:20'),
(17, 4, '<p>Ibu membeli cabe, bawang dan tomat.</p>', 0, '2026-05-10 07:07:27', '2026-05-10 07:07:27'),
(18, 4, '<p>Ayah bekerja di Kota Bandung.</p>', 1, '2026-05-10 07:07:35', '2026-05-10 07:07:35'),
(19, 4, '<p>Kami pergi kepasar setiap minggu.</p>', 0, '2026-05-10 07:07:42', '2026-05-10 07:07:42'),
(20, 4, '<p>Adik sedang mempelajari Matematika dan bahasa indonesia.</p>', 0, '2026-05-10 07:07:50', '2026-05-10 07:07:50'),
(21, 6, '<p>maju</p>', 0, '2026-05-10 07:08:29', '2026-05-10 07:08:29'),
(22, 6, '<p>mutakhir</p>', 0, '2026-05-10 07:08:35', '2026-05-10 07:08:35'),
(23, 6, '<p>tradisional</p>', 1, '2026-05-10 07:08:41', '2026-05-10 07:08:41'),
(24, 6, '<p>praktis</p>', 0, '2026-05-10 07:08:47', '2026-05-10 07:08:47'),
(25, 6, '<p>terkenal</p>', 0, '2026-05-10 07:08:54', '2026-05-10 07:08:54'),
(26, 7, '<p>Para siswa-siswa berkumpul di aula.</p>', 0, '2026-05-10 07:13:11', '2026-05-10 07:13:11'),
(27, 7, '<p>Kami belajar dengan sungguh-sungguh.</p>', 1, '2026-05-10 07:13:19', '2026-05-10 07:13:19'),
(28, 7, '<p>Dia naik ke atas panggung.</p>', 0, '2026-05-10 07:13:26', '2026-05-10 07:13:26'),
(29, 7, '<p>Ayah membeli buku dan pensil.</p>', 1, '2026-05-10 07:13:33', '2026-05-10 07:13:33'),
(30, 7, '<p>Mereka saling tolong-menolong bersama.</p>', 0, '2026-05-10 07:13:42', '2026-05-10 07:13:42'),
(31, 8, '<p>Semua warga mengalami banjir</p>', 0, '2026-05-10 07:13:59', '2026-05-10 07:13:59'),
(32, 8, '<p>Kekeringan disebabkan oleh hujan deras</p>', 0, '2026-05-10 07:14:06', '2026-05-10 07:14:06'),
(33, 8, '<p>Cuaca panas menyebabkan kesulitan air bersih</p>', 1, '2026-05-10 07:14:13', '2026-05-10 07:14:13'),
(34, 8, '<p>Air bersih mudah diperoleh warga</p>', 0, '2026-05-10 07:14:20', '2026-05-10 07:14:20'),
(35, 8, '<p>Warga tidak peduli terhadap cuaca</p>', 0, '2026-05-10 07:14:26', '2026-05-10 07:14:26'),
(36, 10, '<p>resiko</p>', 0, '2026-05-10 07:14:43', '2026-05-10 07:14:43'),
(37, 10, '<p>aktifitas</p>', 0, '2026-05-10 07:14:50', '2026-05-10 07:14:50'),
(38, 10, '<p>apotik</p>', 0, '2026-05-10 07:14:56', '2026-05-10 07:14:56'),
(39, 10, '<p>kualitas</p>', 1, '2026-05-10 07:15:04', '2026-05-10 07:15:04'),
(40, 10, '<p>ijin</p>', 0, '2026-05-10 07:15:16', '2026-05-10 07:15:16'),
(41, 11, '<p>Program dilakukan di sekolah</p>', 1, '2026-05-10 07:15:52', '2026-05-10 07:15:52'),
(42, 11, '<p>Semua siswa membawa dua tanaman</p>', 0, '2026-05-10 07:15:58', '2026-05-10 07:15:58'),
(43, 11, '<p>Tujuan program adalah penghijauan</p>', 1, '2026-05-10 07:16:06', '2026-05-10 07:16:06'),
(44, 11, '<p>Tanaman ditanam di halaman sekolah</p>', 1, '2026-05-10 07:16:15', '2026-05-10 07:16:15'),
(45, 11, '<p>Program dilakukan di pasar</p>', 0, '2026-05-10 07:16:24', '2026-05-10 07:16:24'),
(46, 12, '<p>Hari ini cuaca sangat panas.</p>', 0, '2026-05-10 07:16:38', '2026-05-10 07:16:38'),
(47, 12, '<p>Buku itu terletak di meja guru.</p>', 0, '2026-05-10 07:16:45', '2026-05-10 07:16:45'),
(48, 12, '<p>Marilah kita menjaga kebersihan lingkungan sekolah.</p>', 1, '2026-05-10 07:16:53', '2026-05-10 07:16:53'),
(49, 12, '<p>Adik sedang bermain bola di lapangan.</p>', 0, '2026-05-10 07:16:59', '2026-05-10 07:16:59'),
(50, 12, '<p>Ayah pergi ke kantor pukul tujuh pagi.</p>', 0, '2026-05-10 07:17:09', '2026-05-10 07:17:09'),
(51, 14, '<p>sombong</p>', 1, '2026-05-10 07:17:32', '2026-05-10 07:17:32'),
(52, 14, '<p>bijaksana</p>', 0, '2026-05-10 07:17:39', '2026-05-10 07:17:39'),
(53, 14, '<p>rendah&nbsp;hati</p>', 0, '2026-05-10 07:17:50', '2026-05-10 07:17:50'),
(54, 14, '<p>pemalu</p>', 0, '2026-05-10 07:17:56', '2026-05-10 07:17:56'),
(55, 14, '<p>ramah</p>', 0, '2026-05-10 07:18:03', '2026-05-10 07:18:03'),
(56, 15, '<p>Dina</p>', 0, '2026-05-10 07:24:10', '2026-05-10 07:24:10'),
(57, 15, '<p>membaca</p>', 0, '2026-05-10 07:24:15', '2026-05-10 07:24:15'),
(58, 15, '<p>novel</p>', 0, '2026-05-10 07:24:22', '2026-05-10 07:24:22'),
(59, 15, '<p>di perpustakaan</p>', 1, '2026-05-10 07:24:31', '2026-05-10 07:24:31'),
(60, 15, '<p>pada sore hari</p>', 1, '2026-05-10 07:24:40', '2026-05-10 07:24:40'),
(61, 16, '<p>Kendaraan fosil lebih hemat biaya</p>', 0, '2026-05-10 07:25:10', '2026-05-10 07:25:10'),
(62, 16, '<p>Kendaraan listrik mulai banyak digunakan karena memiliki berbagai kelebihan</p>', 1, '2026-05-10 07:25:19', '2026-05-10 07:25:19'),
(63, 16, '<p>Semua masyarakat telah menggunakan kendaraan listrik</p>', 0, '2026-05-10 07:25:27', '2026-05-10 07:25:27'),
(64, 16, '<p>Kota besar melarang kendaraan umum</p>', 0, '2026-05-10 07:25:34', '2026-05-10 07:25:34'),
(65, 16, '<p>Energi fosil tidak lagi tersedia</p>', 0, '2026-05-10 07:25:42', '2026-05-10 07:25:42'),
(66, 17, '<p>Atlet itu memiliki fisik yang kuat.</p>', 1, '2026-05-10 07:26:23', '2026-05-10 07:26:23'),
(67, 17, '<p>Pemerintah sedang melakukan aktifitas sosial.</p>', 0, '2026-05-10 07:26:32', '2026-05-10 07:26:32'),
(68, 17, '<p>Ibu membeli obat di apotek.</p>', 1, '2026-05-10 07:26:41', '2026-05-10 07:26:41'),
(69, 17, '<p>Mereka meminta ijin kepada guru.</p>', 0, '2026-05-10 07:26:50', '2026-05-10 07:26:50'),
(70, 17, '<p>Resiko kecelakaan dapat diminimalkan.</p>', 0, '2026-05-10 07:27:02', '2026-05-10 07:27:02'),
(71, 19, '<p>Air mendidih pada suhu 100 derajat Celsius.</p>', 0, '2026-05-10 07:27:18', '2026-05-10 07:27:18'),
(72, 19, '<p>Indonesia memiliki dua musim.</p>', 0, '2026-05-10 07:27:26', '2026-05-10 07:27:26'),
(73, 19, '<p>Menurut saya, film itu sangat membosankan.</p>', 1, '2026-05-10 07:27:37', '2026-05-10 07:27:37'),
(74, 19, '<p>Matahari terbit dari arah timur.</p>', 0, '2026-05-10 07:27:44', '2026-05-10 07:27:44'),
(75, 19, '<p>Bumi mengelilingi matahari.</p>', 0, '2026-05-10 07:27:52', '2026-05-10 07:27:52'),
(76, 20, '<p>pakaian</p>', 0, '2026-05-10 07:28:16', '2026-05-10 07:28:16'),
(77, 20, '<p>pertunjukan</p>', 1, '2026-05-10 07:28:22', '2026-05-10 07:28:22'),
(78, 20, '<p>wajah</p>', 0, '2026-05-10 07:28:29', '2026-05-10 07:28:29'),
(79, 20, '<p>kebiasaan</p>', 0, '2026-05-10 07:28:39', '2026-05-10 07:28:39'),
(80, 20, '<p>sikap</p>', 0, '2026-05-10 07:28:48', '2026-05-10 07:28:48'),
(81, 21, '<p>A</p>', 0, '2026-05-10 07:31:35', '2026-05-10 07:31:35'),
(82, 21, '<p>B</p>', 1, '2026-05-10 07:31:42', '2026-05-10 07:31:42'),
(83, 21, '<p>C</p>', 0, '2026-05-10 07:31:47', '2026-05-10 07:31:47'),
(84, 21, '<p>D</p>', 0, '2026-05-10 07:31:52', '2026-05-10 07:31:52'),
(85, 21, '<p>E</p>', 1, '2026-05-10 07:31:57', '2026-05-10 07:31:57'),
(86, 23, '<p>Internet tidak boleh digunakan siswa</p>', 0, '2026-05-10 07:32:23', '2026-05-10 07:32:23'),
(87, 23, '<p>Semua informasi di internet benar</p>', 0, '2026-05-10 07:32:31', '2026-05-10 07:32:31'),
(88, 23, '<p>Siswa perlu bijak dalam menggunakan internet</p>', 1, '2026-05-10 07:32:39', '2026-05-10 07:32:39'),
(89, 23, '<p>Materi pelajaran hanya tersedia di internet</p>', 0, '2026-05-10 07:32:47', '2026-05-10 07:32:47'),
(90, 23, '<p>Internet membuat siswa malas belajar</p>', 0, '2026-05-10 07:32:59', '2026-05-10 07:32:59'),
(91, 24, '<p>Internet membuat siswa malas belajar</p>', 1, '2026-05-10 07:33:18', '2026-05-10 07:33:18'),
(92, 24, '<p>Mereka sedang menyapu halaman.</p>', 1, '2026-05-10 07:33:25', '2026-05-10 07:33:25'),
(93, 24, '<p>Ibu memasar di pagi hari.</p>', 0, '2026-05-10 07:33:38', '2026-05-10 07:33:38'),
(94, 24, '<p>Kakak menuliskan surat untuk nenek.</p>', 1, '2026-05-10 07:33:48', '2026-05-10 07:33:48'),
(95, 24, '<p>Ayah memperbaikki sepeda.</p>', 0, '2026-05-10 07:33:57', '2026-05-10 07:33:57'),
(96, 25, '<p>ceroboh</p>', 0, '2026-05-10 07:34:10', '2026-05-10 07:34:10'),
(97, 25, '<p>teliti</p>', 1, '2026-05-10 07:34:17', '2026-05-10 07:34:17'),
(98, 25, '<p>lambat</p>', 0, '2026-05-10 07:34:24', '2026-05-10 07:34:24'),
(99, 25, '<p>malas</p>', 0, '2026-05-10 07:34:31', '2026-05-10 07:34:31'),
(100, 25, '<p>bingung</p>', 0, '2026-05-10 07:34:37', '2026-05-10 07:34:37'),
(101, 27, '<p>Pantai itu adalah pantai terindah di Indonesia.</p>', 0, '2026-05-10 07:35:06', '2026-05-10 07:35:06'),
(102, 27, '<p>Menurut saya, makanan itu terlalu asin.</p>', 0, '2026-05-10 07:35:13', '2026-05-10 07:35:13'),
(103, 27, '<p>Buku digital lebih menarik daripada buku cetak.</p>', 0, '2026-05-10 07:35:27', '2026-05-10 07:35:27'),
(104, 27, '<p>Indonesia merdeka pada tanggal 17 Agustus 1945.</p>', 1, '2026-05-10 07:35:37', '2026-05-10 07:35:37'),
(105, 27, '<p>Film tersebut sangat membosankan untuk ditonton.</p>', 0, '2026-05-10 07:35:45', '2026-05-10 07:35:45'),
(106, 28, '<p>Pertandingan tetap berlangsung</p>', 0, '2026-05-10 07:36:34', '2026-05-10 07:36:34'),
(107, 28, '<p>Hujan deras menjadi penyebab penundaan</p>', 1, '2026-05-10 07:36:41', '2026-05-10 07:36:41'),
(108, 28, '<p>Pertandingan ditunda sampai besok pagi</p>', 1, '2026-05-10 07:36:51', '2026-05-10 07:36:51'),
(109, 28, '<p>Pertandingan dilaksanakan di malam hari</p>', 0, '2026-05-10 07:36:57', '2026-05-10 07:36:57'),
(110, 28, '<p>Penonton membatalkan pertandingan</p>', 0, '2026-05-10 07:37:04', '2026-05-10 07:37:04'),
(111, 29, '<p>suka membantu</p>', 1, '2026-05-10 07:37:27', '2026-05-10 07:37:27'),
(112, 29, '<p>mudah menyerah</p>', 0, '2026-05-10 07:37:32', '2026-05-10 07:37:32'),
(113, 29, '<p>keras kepala</p>', 0, '2026-05-10 07:37:41', '2026-05-10 07:37:41'),
(114, 29, '<p>sombong</p>', 0, '2026-05-10 07:37:47', '2026-05-10 07:37:47'),
(115, 29, '<p>rajin belajar</p>', 0, '2026-05-10 07:37:53', '2026-05-10 07:37:53'),
(116, 31, '<p>Bus</p>', 0, '2026-05-10 07:46:24', '2026-05-10 07:46:24'),
(117, 31, '<p>Car</p>', 0, '2026-05-10 07:46:29', '2026-05-10 07:46:29'),
(118, 31, '<p>Train</p>', 0, '2026-05-10 07:46:36', '2026-05-10 07:46:36'),
(119, 31, '<p>Bike</p>', 1, '2026-05-10 07:46:43', '2026-05-10 07:46:43'),
(120, 31, '<p>Motorcycle</p>', 0, '2026-05-10 07:46:48', '2026-05-10 07:46:48'),
(121, 32, '<p>Students dislike libraries</p>', 0, '2026-05-10 07:47:05', '2026-05-10 07:47:05'),
(122, 32, '<p>The library is a place for reading and studying</p>', 1, '2026-05-10 07:47:10', '2026-05-10 07:47:40'),
(123, 32, '<p>Libraries are always crowded</p>', 0, '2026-05-10 07:47:17', '2026-05-10 07:47:17'),
(124, 32, '<p>Books are expensive</p>', 0, '2026-05-10 07:47:26', '2026-05-10 07:47:26'),
(125, 32, '<p>Students cannot study in libraries</p>', 0, '2026-05-10 07:47:34', '2026-05-10 07:47:34'),
(126, 33, '<p>She plays badminton every weekend.</p>', 1, '2026-05-10 07:48:03', '2026-05-10 07:48:03'),
(127, 33, '<p>They are watching television now.</p>', 0, '2026-05-10 07:48:09', '2026-05-10 07:48:09'),
(128, 33, '<p>I drink milk every morning.</p>', 1, '2026-05-10 07:48:16', '2026-05-10 07:48:16'),
(129, 33, '<p>We visited Bali last year.</p>', 0, '2026-05-10 07:48:22', '2026-05-10 07:48:22'),
(130, 33, '<p>He is reading a novel.</p>', 0, '2026-05-10 07:48:28', '2026-05-10 07:48:28'),
(131, 35, '<p>Sad</p>', 0, '2026-05-10 07:49:01', '2026-05-10 07:49:01'),
(132, 35, '<p>Angry</p>', 0, '2026-05-10 07:49:06', '2026-05-10 07:49:06'),
(133, 35, '<p>Glad</p>', 1, '2026-05-10 07:49:13', '2026-05-10 07:49:13'),
(134, 35, '<p>Tired</p>', 0, '2026-05-10 07:49:20', '2026-05-10 07:49:20'),
(135, 35, '<p>Weak</p>', 0, '2026-05-10 07:49:27', '2026-05-10 07:49:27'),
(136, 36, '<p>The teacher</p>', 0, '2026-05-10 07:49:44', '2026-05-10 07:49:44'),
(137, 36, '<p>The janitor</p>', 0, '2026-05-10 07:49:50', '2026-05-10 07:49:50'),
(138, 36, '<p>The students</p>', 1, '2026-05-10 07:49:57', '2026-05-10 07:49:57'),
(139, 36, '<p>The principal</p>', 0, '2026-05-10 07:50:03', '2026-05-10 07:50:03'),
(140, 36, '<p>The parents</p>', 0, '2026-05-10 07:50:09', '2026-05-10 07:50:09'),
(141, 37, '<p>Table</p>', 1, '2026-05-10 07:50:22', '2026-05-10 07:50:22'),
(142, 37, '<p>Beautiful</p>', 0, '2026-05-10 07:50:29', '2026-05-10 07:50:29'),
(143, 37, '<p>School</p>', 1, '2026-05-10 07:50:37', '2026-05-10 07:50:37'),
(144, 37, '<p>Quickly</p>', 0, '2026-05-10 07:50:43', '2026-05-10 07:50:43'),
(145, 37, '<p>Teacher</p>', 1, '2026-05-10 07:50:49', '2026-05-10 07:50:49'),
(146, 38, '<p>She go to school every day.</p>', 0, '2026-05-10 07:51:10', '2026-05-10 07:51:10'),
(147, 38, '<p>She goes to school every day.</p>', 1, '2026-05-10 07:51:17', '2026-05-10 07:51:17'),
(148, 38, '<p>She going to school every day.</p>', 0, '2026-05-10 07:51:23', '2026-05-10 07:51:23'),
(149, 38, '<p>She gone to school every day.</p>', 0, '2026-05-10 07:51:29', '2026-05-10 07:51:29'),
(150, 38, '<p>She is go to school every day.</p>', 0, '2026-05-10 07:51:36', '2026-05-10 07:51:36'),
(151, 40, '<p>Powerful</p>', 0, '2026-05-10 07:51:56', '2026-05-10 07:51:56'),
(152, 40, '<p>Weak</p>', 1, '2026-05-10 07:52:03', '2026-05-10 07:52:03'),
(153, 40, '<p>Healthy</p>', 0, '2026-05-10 07:52:08', '2026-05-10 07:52:08'),
(154, 40, '<p>Active</p>', 0, '2026-05-10 07:52:14', '2026-05-10 07:52:14'),
(155, 40, '<p>Tall</p>', 0, '2026-05-10 07:52:21', '2026-05-10 07:52:21'),
(156, 41, '<p>Anna enjoys art activities.</p>', 1, '2026-05-10 07:52:40', '2026-05-10 07:52:40'),
(157, 41, '<p>Anna dislikes competitions.</p>', 0, '2026-05-10 07:52:47', '2026-05-10 07:52:47'),
(158, 41, '<p>Anna joins art competitions.</p>', 1, '2026-05-10 07:52:53', '2026-05-10 07:52:53'),
(159, 41, '<p>Anna likes sports more than art.</p>', 0, '2026-05-10 07:53:00', '2026-05-10 07:53:00'),
(160, 41, '<p>Anna likes drawing.</p>', 1, '2026-05-10 07:53:06', '2026-05-10 07:53:06'),
(161, 42, '<p>Cheap</p>', 0, '2026-05-10 07:53:36', '2026-05-10 07:53:36'),
(162, 42, '<p>Costly</p>', 1, '2026-05-10 07:53:43', '2026-05-10 07:53:43'),
(163, 42, '<p>Small</p>', 0, '2026-05-10 07:53:49', '2026-05-10 07:53:49'),
(164, 42, '<p>Old</p>', 0, '2026-05-10 07:53:53', '2026-05-10 07:53:53'),
(165, 42, '<p>Dirty</p>', 0, '2026-05-10 07:53:58', '2026-05-10 07:53:58'),
(166, 44, '<p>bake</p>', 0, '2026-05-10 07:54:17', '2026-05-10 07:54:17'),
(167, 44, '<p>bakes</p>', 1, '2026-05-10 07:54:23', '2026-05-10 07:54:23'),
(168, 44, '<p>baking</p>', 0, '2026-05-10 07:54:28', '2026-05-10 07:54:28'),
(169, 44, '<p>baked</p>', 0, '2026-05-10 07:54:33', '2026-05-10 07:54:33'),
(170, 44, '<p>is bake</p>', 0, '2026-05-10 07:54:41', '2026-05-10 07:54:41'),
(171, 45, '<p>The tall boy is my brother.</p>', 1, '2026-05-10 07:55:04', '2026-05-10 07:55:04'),
(172, 45, '<p>She sings beautifully.</p>', 0, '2026-05-10 07:55:10', '2026-05-10 07:55:10'),
(173, 45, '<p>I have a red bag.</p>', 1, '2026-05-10 07:55:22', '2026-05-10 07:55:22'),
(174, 45, '<p>They run quickly.</p>', 0, '2026-05-10 07:55:28', '2026-05-10 07:55:28'),
(175, 45, '<p>The classroom is clean.</p>', 1, '2026-05-10 07:55:34', '2026-05-10 07:55:44'),
(176, 46, '<p>He wants to be a teacher</p>', 0, '2026-05-10 08:05:13', '2026-05-10 08:05:13'),
(177, 46, '<p>He wants to become a doctor</p>', 1, '2026-05-10 08:05:20', '2026-05-10 08:05:20'),
(178, 46, '<p>He dislikes school</p>', 0, '2026-05-10 08:05:27', '2026-05-10 08:05:27'),
(179, 46, '<p>He wants to play games</p>', 0, '2026-05-10 08:05:33', '2026-05-10 08:05:33'),
(180, 46, '<p>He wants to travel abroad</p>', 0, '2026-05-10 08:05:40', '2026-05-10 08:05:40'),
(181, 47, '<p>They visited the museum yesterday.</p>', 1, '2026-05-10 08:05:59', '2026-05-10 08:05:59'),
(182, 47, '<p>She writes a letter every week.</p>', 0, '2026-05-10 08:06:06', '2026-05-10 08:06:06'),
(183, 47, '<p>We played football last Sunday.</p>', 1, '2026-05-10 08:06:14', '2026-05-10 08:06:14'),
(184, 47, '<p>He is watching television now.</p>', 0, '2026-05-10 08:06:20', '2026-05-10 08:06:20'),
(185, 47, '<p>I studied English last night.</p>', 1, '2026-05-10 08:06:28', '2026-05-10 08:06:28'),
(186, 49, '<p>plays</p>', 0, '2026-05-10 08:06:47', '2026-05-10 08:06:47'),
(187, 49, '<p>playing</p>', 0, '2026-05-10 08:06:53', '2026-05-10 08:06:53'),
(188, 49, '<p>play</p>', 1, '2026-05-10 08:06:59', '2026-05-10 08:07:04'),
(189, 49, '<p>played</p>', 0, '2026-05-10 08:07:09', '2026-05-10 08:07:09'),
(190, 49, '<p>is play</p>', 0, '2026-05-10 08:07:15', '2026-05-10 08:07:15'),
(191, 50, '<p>Finish</p>', 0, '2026-05-10 08:08:22', '2026-05-10 08:08:22'),
(192, 50, '<p>Start</p>', 1, '2026-05-10 08:08:24', '2026-05-10 08:09:07'),
(193, 50, '<p>Stop</p>', 0, '2026-05-10 08:08:56', '2026-05-10 08:09:14'),
(194, 50, '<p>End</p>', 0, '2026-05-10 08:09:20', '2026-05-10 08:09:20'),
(195, 50, '<p>Close</p>', 0, '2026-05-10 08:09:25', '2026-05-10 08:09:25'),
(196, 51, '<p>Run</p>', 1, '2026-05-10 08:09:41', '2026-05-10 08:09:41'),
(197, 51, '<p>Beautiful</p>', 0, '2026-05-10 08:09:47', '2026-05-10 08:09:47'),
(198, 51, '<p>Write</p>', 1, '2026-05-10 08:09:54', '2026-05-10 08:09:54'),
(199, 51, '<p>Quickly</p>', 0, '2026-05-10 08:09:59', '2026-05-10 08:09:59'),
(200, 51, '<p>Eat</p>', 1, '2026-05-10 08:10:06', '2026-05-10 08:10:06'),
(201, 53, '<p>Coffee</p>', 0, '2026-05-10 08:10:29', '2026-05-10 08:10:29'),
(202, 53, '<p>Milk</p>', 0, '2026-05-10 08:10:36', '2026-05-10 08:10:41'),
(203, 53, '<p>Juice</p>', 0, '2026-05-10 08:10:46', '2026-05-10 08:10:46'),
(204, 53, '<p>Tea</p>', 1, '2026-05-10 08:10:51', '2026-05-10 08:10:51'),
(205, 53, '<p>Water</p>', 0, '2026-05-10 08:10:57', '2026-05-10 08:10:57'),
(206, 54, '<p>He goes to school by bus.</p>', 1, '2026-05-10 08:11:18', '2026-05-10 08:11:18'),
(207, 54, '<p>They plays football every day.</p>', 0, '2026-05-10 08:11:24', '2026-05-10 08:11:24'),
(208, 54, '<p>I am very tired today.</p>', 0, '2026-05-10 08:11:31', '2026-05-10 08:11:31'),
(209, 54, '<p>She do her homework every night.</p>', 0, '2026-05-10 08:11:37', '2026-05-10 08:11:37'),
(210, 54, '<p>We are happy to see you.</p>', 1, '2026-05-10 08:11:43', '2026-05-10 08:11:43'),
(211, 55, '<p>Hard</p>', 0, '2026-05-10 08:11:56', '2026-05-10 08:11:56'),
(212, 55, '<p>Easy</p>', 1, '2026-05-10 08:12:02', '2026-05-10 08:12:02'),
(213, 55, '<p>Complicated</p>', 0, '2026-05-10 08:12:08', '2026-05-10 08:12:08'),
(214, 55, '<p>Heavy</p>', 0, '2026-05-10 08:12:13', '2026-05-10 08:12:13'),
(215, 55, '<p>Expensive</p>', 0, '2026-05-10 08:12:17', '2026-05-10 08:12:17'),
(216, 57, '<p>She can sings very well.</p>', 0, '2026-05-10 08:12:41', '2026-05-10 08:12:41'),
(217, 57, '<p>She can sing very well.</p>', 1, '2026-05-10 08:12:47', '2026-05-10 08:12:47'),
(218, 57, '<p>She can singing very well.</p>', 0, '2026-05-10 08:12:53', '2026-05-10 08:12:53'),
(219, 57, '<p>She cans sing very well.</p>', 0, '2026-05-10 08:12:59', '2026-05-10 08:12:59'),
(220, 57, '<p>She can to sing very well.</p>', 0, '2026-05-10 08:13:05', '2026-05-10 08:13:05'),
(221, 58, '<p>The activity was held on Saturday.</p>', 1, '2026-05-10 08:13:34', '2026-05-10 08:13:34'),
(222, 58, '<p>Only teachers joined the activity.</p>', 0, '2026-05-10 08:13:40', '2026-05-10 08:13:40'),
(223, 58, '<p>Students participated in the activity.</p>', 1, '2026-05-10 08:13:47', '2026-05-10 08:13:47'),
(224, 58, '<p>The school yard was cleaned.</p>', 1, '2026-05-10 08:13:53', '2026-05-10 08:13:53'),
(225, 58, '<p>The activity was about sports competition.</p>', 0, '2026-05-10 08:14:01', '2026-05-10 08:14:01'),
(226, 59, '<p>tall</p>', 0, '2026-05-10 08:14:15', '2026-05-10 08:14:15'),
(227, 59, '<p>taller</p>', 1, '2026-05-10 08:14:20', '2026-05-10 08:14:20'),
(228, 59, '<p>tallest</p>', 0, '2026-05-10 08:14:27', '2026-05-10 08:14:27'),
(229, 59, '<p>more tall</p>', 0, '2026-05-10 08:14:33', '2026-05-10 08:14:33'),
(230, 59, '<p>very tall</p>', 0, '2026-05-10 08:14:39', '2026-05-10 08:14:39'),
(231, 61, '<p>59</p>', 1, '2026-05-10 08:24:44', '2026-05-10 08:24:44'),
(232, 61, '<p>74</p>', 0, '2026-05-10 08:24:52', '2026-05-10 08:24:52'),
(233, 61, '<p>84</p>', 0, '2026-05-10 08:24:59', '2026-05-10 08:24:59'),
(234, 61, '<p>42</p>', 0, '2026-05-10 08:25:05', '2026-05-10 08:25:05'),
(235, 61, '<p>50</p>', 0, '2026-05-10 08:25:11', '2026-05-10 08:25:11'),
(236, 63, '<p>12</p>', 1, '2026-05-10 08:25:31', '2026-05-10 08:25:31'),
(237, 63, '<p>14</p>', 0, '2026-05-10 08:25:37', '2026-05-10 08:25:37'),
(238, 63, '<p>18</p>', 1, '2026-05-10 08:25:44', '2026-05-10 08:25:44'),
(239, 63, '<p>21</p>', 1, '2026-05-10 08:25:50', '2026-05-10 08:25:50'),
(240, 63, '<p>25</p>', 0, '2026-05-10 08:25:56', '2026-05-10 08:25:56'),
(241, 65, '<p>12</p>', 0, '2026-05-10 08:26:18', '2026-05-10 08:26:18'),
(242, 65, '<p>15</p>', 0, '2026-05-10 08:26:24', '2026-05-10 08:26:24'),
(243, 65, '<p>17</p>', 1, '2026-05-10 08:26:31', '2026-05-10 08:26:31'),
(244, 65, '<p>20</p>', 0, '2026-05-10 08:26:36', '2026-05-10 08:26:36'),
(245, 65, '<p>25</p>', 0, '2026-05-10 08:26:41', '2026-05-10 08:26:41'),
(246, 67, '<p>2</p>', 1, '2026-05-10 08:27:04', '2026-05-10 08:27:04'),
(247, 67, '<p>4</p>', 0, '2026-05-10 08:27:11', '2026-05-10 08:27:11'),
(248, 67, '<p>5</p>', 1, '2026-05-10 08:27:19', '2026-05-10 08:27:19'),
(249, 67, '<p>9</p>', 0, '2026-05-10 08:27:25', '2026-05-10 08:27:25'),
(250, 67, '<p>11</p>', 1, '2026-05-10 08:27:32', '2026-05-10 08:27:32'),
(251, 68, '<p>Rp150.000</p>', 0, '2026-05-10 08:27:51', '2026-05-10 08:27:51'),
(252, 68, '<p>Rp160.000</p>', 1, '2026-05-10 08:28:01', '2026-05-10 08:28:01'),
(253, 68, '<p>Rp170.000</p>', 0, '2026-05-10 08:28:07', '2026-05-10 08:28:07'),
(254, 68, '<p>Rp180.000</p>', 0, '2026-05-10 08:28:13', '2026-05-10 08:28:13'),
(255, 68, '<p>Rp190.000</p>', 0, '2026-05-10 08:28:20', '2026-05-10 08:28:20'),
(256, 71, '<p>12</p>', 0, '2026-05-10 08:35:10', '2026-05-10 08:35:10'),
(257, 71, '<p>14</p>', 0, '2026-05-10 08:35:15', '2026-05-10 08:35:15'),
(258, 71, '<p>15</p>', 1, '2026-05-10 08:35:21', '2026-05-10 08:35:21'),
(259, 71, '<p>18</p>', 0, '2026-05-10 08:35:27', '2026-05-10 08:35:27'),
(260, 71, '<p>20</p>', 0, '2026-05-10 08:35:33', '2026-05-10 08:35:33'),
(261, 73, '<p>1/4</p>', 1, '2026-05-10 08:36:02', '2026-05-10 08:36:02'),
(262, 73, '<p>2/3</p>', 0, '2026-05-10 08:36:09', '2026-05-10 08:36:09'),
(263, 73, '<p>3/8</p>', 1, '2026-05-10 08:36:20', '2026-05-10 08:36:20'),
(264, 73, '<p>5/6</p>', 0, '2026-05-10 08:37:05', '2026-05-10 08:37:05'),
(265, 73, '<p>2/5</p>', 1, '2026-05-10 08:37:12', '2026-05-10 08:37:12'),
(266, 75, '<p>10</p>', 0, '2026-05-10 08:37:28', '2026-05-10 08:37:28'),
(267, 75, '<p>12</p>', 0, '2026-05-10 08:37:34', '2026-05-10 08:37:34'),
(268, 75, '<p>13</p>', 1, '2026-05-10 08:37:40', '2026-05-10 08:37:40'),
(269, 75, '<p>15</p>', 0, '2026-05-10 08:37:46', '2026-05-10 08:37:46'),
(270, 75, '<p>20</p>', 0, '2026-05-10 08:37:52', '2026-05-10 08:37:52'),
(271, 77, '<p>3</p>', 1, '2026-05-10 08:38:17', '2026-05-10 08:38:17'),
(272, 77, '<p>5</p>', 0, '2026-05-10 08:38:23', '2026-05-10 08:38:23'),
(273, 77, '<p>6</p>', 1, '2026-05-10 08:38:29', '2026-05-10 08:38:29'),
(274, 77, '<p>8</p>', 1, '2026-05-10 08:38:35', '2026-05-10 08:38:35'),
(275, 77, '<p>10</p>', 0, '2026-05-10 08:38:41', '2026-05-10 08:38:41'),
(276, 78, '<p>20</p>', 0, '2026-05-10 08:39:00', '2026-05-10 08:39:00'),
(277, 78, '<p>24</p>', 0, '2026-05-10 08:39:05', '2026-05-10 08:39:05'),
(278, 78, '<p>28</p>', 0, '2026-05-10 08:39:10', '2026-05-10 08:39:10'),
(279, 78, '<p>30</p>', 1, '2026-05-10 08:39:15', '2026-05-10 08:39:15'),
(280, 78, '<p>32</p>', 0, '2026-05-10 08:39:21', '2026-05-10 08:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `portfolio_required` tinyint(1) NOT NULL DEFAULT '0',
  `portfolio_description` text COLLATE utf8mb4_unicode_ci,
  `portfolio_weight` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `capacity` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Daya tampung peserta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `slug`, `description`, `is_active`, `portfolio_required`, `portfolio_description`, `portfolio_weight`, `created_at`, `updated_at`, `capacity`) VALUES
(1, 'Rekayasa Perangkat Lunak', 'rekayasa-perangkat-lunak', 'Program studi yang mempelajari perancangan, pengembangan, pengujian, dan pemeliharaan perangkat lunak untuk berbagai kebutuhan industri dan teknologi digital. Peserta didik akan dibekali kemampuan pemrograman, pengembangan aplikasi, basis data, serta pemecahan masalah berbasis teknologi informasi.', 1, 0, NULL, '0.00', '2026-05-10 03:40:59', '2026-05-10 07:03:49', 90),
(2, 'Teknik Jaringan Komputer dan Telekomunikasi', 'teknik-jaringan-komputer-dan-telekomunikasi', 'Program studi yang mempelajari instalasi, konfigurasi, pengelolaan, dan keamanan jaringan komputer serta sistem telekomunikasi. Peserta didik akan memahami infrastruktur jaringan, perangkat keras jaringan, server, serta teknologi komunikasi data modern.', 1, 0, NULL, '0.00', '2026-05-10 03:51:30', '2026-05-10 06:52:04', 90),
(3, 'Animasi', 'animasi', 'Program studi yang berfokus pada pembuatan karya animasi digital 2D maupun 3D, mulai dari konsep visual, desain karakter, storyboard, hingga proses produksi dan editing animasi menggunakan perangkat lunak kreatif.', 1, 1, 'Peserta diminta mengumpulkan karya berupa ilustrasi karakter, storyboard, komik singkat, animasi 2D/3D sederhana, motion graphic, atau video animasi pendek hasil karya sendiri.', '50.00', '2026-05-10 03:55:14', '2026-05-10 06:52:25', 32),
(4, 'Desain Komunikasi Visual', 'desain-komunikasi-visual', 'Program studi yang mempelajari penyampaian pesan dan informasi melalui media visual kreatif, seperti desain grafis, ilustrasi, branding, fotografi, tipografi, dan media digital interaktif.', 1, 1, 'Peserta diminta mengumpulkan karya desain seperti poster, logo, branding, ilustrasi digital, fotografi, desain media sosial, UI/UX sederhana, atau karya visual lain yang menunjukkan kemampuan komunikasi visual dan kreativitas desain.', '50.00', '2026-05-10 03:56:19', '2026-05-10 07:04:16', 32);

-- --------------------------------------------------------

--
-- Table structure for table `program_participant`
--

CREATE TABLE `program_participant` (
  `id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `choice_order` tinyint NOT NULL DEFAULT '1',
  `portfolio_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio_uploaded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_participant`
--

INSERT INTO `program_participant` (`id`, `program_id`, `user_id`, `choice_order`, `portfolio_path`, `portfolio_uploaded_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, NULL, NULL, '2026-05-10 04:32:54', '2026-05-10 04:32:54'),
(2, 4, 3, 2, 'portfolios/alfriza-akhmad-rahadi-roshinante678-at-gmailcom-portfolio-second-20260510113254.pdf', '2026-05-10 04:32:54', '2026-05-10 04:32:54', '2026-05-10 04:32:54'),
(3, 1, 6, 1, NULL, NULL, '2026-05-10 04:37:57', '2026-05-10 04:37:57'),
(4, 2, 6, 2, NULL, NULL, '2026-05-10 04:37:57', '2026-05-10 04:37:57'),
(5, 1, 7, 1, NULL, NULL, '2026-05-10 04:39:43', '2026-05-10 04:39:43'),
(6, 3, 7, 2, 'portfolios/muhamad-fauzan-pratama-fauzanpratama28x-at-gmailcom-portfolio-second-20260510113943.pdf', '2026-05-10 04:39:43', '2026-05-10 04:39:43', '2026-05-10 04:39:43'),
(7, 1, 8, 1, NULL, NULL, '2026-05-10 04:41:22', '2026-05-10 04:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `program_subtest_weights`
--

CREATE TABLE `program_subtest_weights` (
  `id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `subtest_id` bigint UNSIGNED NOT NULL,
  `weight` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_subtest_weights`
--

INSERT INTO `program_subtest_weights` (`id`, `program_id`, `subtest_id`, `weight`, `created_at`, `updated_at`) VALUES
(16, 2, 1, '20.00', NULL, NULL),
(17, 2, 2, '30.00', NULL, NULL),
(18, 2, 3, '50.00', NULL, NULL),
(19, 3, 1, '18.00', NULL, NULL),
(20, 3, 2, '22.00', NULL, NULL),
(21, 3, 3, '10.00', NULL, NULL),
(25, 1, 1, '20.00', NULL, NULL),
(26, 1, 2, '30.00', NULL, NULL),
(27, 1, 3, '50.00', NULL, NULL),
(28, 4, 1, '18.00', NULL, NULL),
(29, 4, 2, '22.00', NULL, NULL),
(30, 4, 3, '10.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `question_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single_choice',
  `question_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_essay` tinyint(1) NOT NULL DEFAULT '0',
  `answer_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question_type`, `question_text`, `is_essay`, `answer_key`, `created_at`, `updated_at`) VALUES
(1, 1, 'single_choice', '<p>Bacalah kalimat berikut!</p><blockquote>Pemerintah daerah mengimbau masyarakat untuk mengurangi penggunaan plastik sekali pakai demi menjaga kelestarian lingkungan.</blockquote><p>Makna kata <em>mengimbau</em> pada kalimat tersebut adalah …</p>', 0, NULL, '2026-05-10 04:20:09', '2026-05-10 04:20:51'),
(2, 1, 'single_choice', '<p>Bacalah paragraf berikut!</p><blockquote>Perpustakaan sekolah kini tidak hanya menyediakan buku cetak, tetapi juga koleksi digital yang dapat diakses siswa melalui internet. Kehadiran fasilitas tersebut membantu siswa memperoleh sumber belajar dengan lebih mudah.</blockquote><p>Ide pokok paragraf tersebut adalah …</p>', 0, NULL, '2026-05-10 04:21:02', '2026-05-10 04:21:02'),
(3, 1, 'single_choice', '<p>Perhatikan kalimat berikut!</p><blockquote>Rina tetap berangkat ke sekolah meskipun hujan turun sangat deras.</blockquote><p>Kata hubung yang menyatakan hubungan pertentangan terdapat pada …</p>', 0, NULL, '2026-05-10 04:22:33', '2026-05-10 04:23:04'),
(4, 1, 'single_choice', '<p>Kalimat yang menggunakan ejaan sesuai PUEBI adalah …</p>', 0, NULL, '2026-05-10 04:23:22', '2026-05-10 04:23:22'),
(5, 1, 'true_false_table', '<p>Bacalah teks berikut!</p><blockquote>Indonesia memiliki beragam budaya daerah yang menjadi kekayaan nasional. Keberagaman tersebut harus dijaga agar tidak hilang akibat perkembangan zaman.</blockquote><p>Tentukan benar atau salah setiap pernyataan berikut!</p>', 0, NULL, '2026-05-10 04:24:24', '2026-05-10 04:24:24'),
(6, 1, 'single_choice', '<p>Antonim kata <em>modern</em> adalah …</p>', 0, NULL, '2026-05-10 07:08:18', '2026-05-10 07:08:18'),
(7, 1, 'multiple_choice', '<p>Kalimat yang termasuk kalimat efektif adalah …</p>', 0, NULL, '2026-05-10 07:09:22', '2026-05-10 07:09:22'),
(8, 1, 'single_choice', '<p>Bacalah teks berikut!</p><blockquote>Cuaca panas yang berkepanjangan menyebabkan beberapa wilayah mengalami kekeringan. Warga pun mulai kesulitan memperoleh air bersih.</blockquote><p>Simpulan teks tersebut adalah …</p>', 0, NULL, '2026-05-10 07:09:35', '2026-05-10 07:09:35'),
(9, 1, 'true_false_table', '<p>Perhatikan kaidah berikut!</p>', 0, NULL, '2026-05-10 07:10:17', '2026-05-10 07:10:17'),
(10, 1, 'single_choice', '<p>Kata baku terdapat pada pilihan …</p>', 0, NULL, '2026-05-10 07:10:29', '2026-05-10 07:10:29'),
(11, 1, 'multiple_choice', '<p>Perhatikan paragraf berikut!</p><blockquote>Sekolah mengadakan program penghijauan lingkungan. Setiap siswa diminta membawa satu tanaman untuk ditanam di halaman sekolah.</blockquote><p>Informasi yang sesuai dengan paragraf tersebut adalah …</p>', 0, NULL, '2026-05-10 07:10:41', '2026-05-10 07:10:41'),
(12, 1, 'single_choice', '<p>Kalimat persuasif yang tepat adalah …</p>', 0, NULL, '2026-05-10 07:10:50', '2026-05-10 07:10:50'),
(13, 1, 'true_false_table', '<p>Bacalah teks berikut!</p><blockquote>Membaca buku secara rutin dapat menambah wawasan dan meningkatkan kemampuan berpikir kritis seseorang.</blockquote>', 0, NULL, '2026-05-10 07:12:16', '2026-05-10 07:12:16'),
(14, 1, 'single_choice', '<p>Makna ungkapan <em>besar kepala</em> adalah …</p>', 0, NULL, '2026-05-10 07:12:31', '2026-05-10 07:12:31'),
(15, 1, 'multiple_choice', '<p>Perhatikan kalimat berikut!</p><blockquote>Dina membaca novel di perpustakaan pada sore hari.</blockquote><p>Keterangan pada kalimat tersebut ditunjukkan oleh …</p>', 0, NULL, '2026-05-10 07:12:44', '2026-05-10 07:12:44'),
(16, 1, 'single_choice', '<p>Bacalah paragraf berikut!</p><blockquote>Penggunaan kendaraan listrik mulai meningkat di berbagai kota besar. Selain lebih ramah lingkungan, kendaraan listrik juga dianggap lebih hemat energi dibandingkan kendaraan berbahan bakar fosil.</blockquote><p>Gagasan utama paragraf tersebut adalah …</p>', 0, NULL, '2026-05-10 07:18:33', '2026-05-10 07:18:33'),
(17, 1, 'multiple_choice', '<p>Kalimat yang menggunakan kata baku adalah …</p>', 0, NULL, '2026-05-10 07:18:42', '2026-05-10 07:18:42'),
(18, 1, 'true_false_table', '<p>Bacalah teks berikut!</p><blockquote>Teknologi digital memudahkan masyarakat dalam memperoleh informasi dengan cepat melalui internet dan media sosial.</blockquote>', 0, NULL, '2026-05-10 07:19:27', '2026-05-10 07:19:27'),
(19, 1, 'single_choice', '<p>Kalimat yang mengandung opini adalah …</p>', 0, NULL, '2026-05-10 07:19:38', '2026-05-10 07:19:38'),
(20, 1, 'single_choice', '<p>Perhatikan kalimat berikut!</p><blockquote>Para peserta lomba sedang mempersiapkan penampilan terbaik mereka.</blockquote><p>Makna kata <em>penampilan</em> pada kalimat tersebut adalah …</p>', 0, NULL, '2026-05-10 07:19:49', '2026-05-10 07:19:49'),
(21, 1, 'multiple_choice', '<p>Perhatikan ciri-ciri teks berikut!</p><p><br></p><p>A. Mengandung fakta</p><p>B. Bersifat mengajak</p><p>C. Menggunakan data pendukung</p><p>D. Mengandung opini pribadi</p><p>E. Bertujuan memengaruhi pembaca</p><p><br></p><p>Ciri-ciri teks persuasi ditunjukkan oleh …</p>', 0, NULL, '2026-05-10 07:20:02', '2026-05-10 07:31:21'),
(22, 1, 'true_false_table', '<p>Perhatikan pernyataan berikut!</p>', 0, NULL, '2026-05-10 07:20:43', '2026-05-10 07:20:43'),
(23, 1, 'single_choice', '<p>Bacalah paragraf berikut!</p><blockquote>Banyak siswa memanfaatkan internet untuk mencari materi pelajaran tambahan. Namun, penggunaan internet juga harus disertai kemampuan memilih informasi yang benar dan terpercaya.</blockquote><p>Pesan yang terkandung dalam paragraf tersebut adalah …</p>', 0, NULL, '2026-05-10 07:20:53', '2026-05-10 07:20:53'),
(24, 1, 'multiple_choice', '<p>Kalimat yang menggunakan imbuhan dengan tepat adalah …</p>', 0, NULL, '2026-05-10 07:21:02', '2026-05-10 07:21:02'),
(25, 1, 'single_choice', '<p>Sinonim kata <em>cermat</em> adalah …</p>', 0, NULL, '2026-05-10 07:21:12', '2026-05-10 07:21:12'),
(26, 1, 'true_false_table', '<p>Bacalah teks berikut!</p><blockquote>Olahraga secara teratur dapat menjaga kesehatan tubuh dan meningkatkan daya tahan fisik.</blockquote>', 0, NULL, '2026-05-10 07:21:54', '2026-05-10 07:21:54'),
(27, 1, 'single_choice', '<p>Kalimat berikut yang termasuk kalimat fakta adalah …</p>', 0, NULL, '2026-05-10 07:22:02', '2026-05-10 07:22:02'),
(28, 1, 'multiple_choice', '<p>Perhatikan kalimat berikut!</p><blockquote>Karena hujan deras, pertandingan sepak bola ditunda hingga besok pagi.</blockquote><p>Informasi yang sesuai dengan kalimat tersebut adalah …</p>', 0, NULL, '2026-05-10 07:22:17', '2026-05-10 07:22:17'),
(29, 1, 'single_choice', '<p>Makna peribahasa <em>ringan tangan</em> adalah …</p>', 0, NULL, '2026-05-10 07:22:25', '2026-05-10 07:22:25'),
(30, 1, 'true_false_table', '<p>Bacalah teks berikut!</p><blockquote>Menanam pohon di lingkungan sekitar dapat membantu mengurangi polusi udara dan membuat lingkungan menjadi lebih sejuk.</blockquote>', 0, NULL, '2026-05-10 07:23:13', '2026-05-10 07:23:13'),
(31, 2, 'single_choice', '<p>Read the sentence below!</p><blockquote>Tina goes to school by bicycle every morning.</blockquote><p>What is the meaning of the word <em>bicycle</em>?</p>', 0, NULL, '2026-05-10 07:41:22', '2026-05-10 07:41:22'),
(32, 2, 'single_choice', '<p>Read the text below!</p><blockquote>The library is a quiet place where students can read books and study together.</blockquote><p>What is the main idea of the text?</p>', 0, NULL, '2026-05-10 07:41:30', '2026-05-10 07:41:30'),
(33, 2, 'multiple_choice', '<p>Which sentences are written in the simple present tense?</p>', 0, NULL, '2026-05-10 07:41:41', '2026-05-10 07:41:41'),
(34, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>Elephants are large animals that live in forests and grasslands. They use their trunks to eat, drink, and carry objects.</blockquote>', 0, NULL, '2026-05-10 07:42:33', '2026-05-10 07:42:33'),
(35, 2, 'single_choice', '<p>Choose the correct synonym of <em>happy</em>.</p>', 0, NULL, '2026-05-10 07:42:56', '2026-05-10 07:42:56'),
(36, 2, 'single_choice', '<p>Read the sentence below!</p><blockquote>The students cleaned the classroom after the lesson.</blockquote><p>Who cleaned the classroom?</p>', 0, NULL, '2026-05-10 07:43:04', '2026-05-10 07:43:04'),
(37, 2, 'multiple_choice', '<p>Which of the following are nouns?</p>', 0, NULL, '2026-05-10 07:43:14', '2026-05-10 07:43:14'),
(38, 2, 'single_choice', '<p>Choose the correct sentence.</p>', 0, NULL, '2026-05-10 07:43:21', '2026-05-10 07:43:21'),
(39, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>Water is important for all living things. Humans, animals, and plants need water to survive.</blockquote>', 0, NULL, '2026-05-10 07:43:56', '2026-05-10 07:43:56'),
(40, 2, 'single_choice', '<p>What is the antonym of <em>strong</em>?</p>', 0, NULL, '2026-05-10 07:44:05', '2026-05-10 07:44:05'),
(41, 2, 'multiple_choice', '<p>Read the text below!</p><blockquote>Anna likes drawing and painting. She often joins art competitions at school.</blockquote><p>Which statements are correct?</p>', 0, NULL, '2026-05-10 07:44:16', '2026-05-10 07:44:16'),
(42, 2, 'single_choice', '<p>Choose the correct meaning of the word <em>expensive</em>.</p>', 0, NULL, '2026-05-10 07:44:24', '2026-05-10 07:44:24'),
(43, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>The sun rises in the east and sets in the west.</blockquote>', 0, NULL, '2026-05-10 07:44:59', '2026-05-10 07:44:59'),
(44, 2, 'single_choice', '<p>Complete the sentence!</p><blockquote>My mother _____ delicious cakes every weekend.</blockquote>', 0, NULL, '2026-05-10 07:45:11', '2026-05-10 07:45:11'),
(45, 2, 'multiple_choice', '<p>Which sentences contain adjectives?</p>', 0, NULL, '2026-05-10 07:45:37', '2026-05-10 07:45:37'),
(46, 2, 'single_choice', '<p>Read the text below!</p><blockquote>David studies hard every day because he wants to become a doctor in the future.</blockquote><p>Why does David study hard?</p>', 0, NULL, '2026-05-10 07:56:23', '2026-05-10 07:56:23'),
(47, 2, 'multiple_choice', '<p>Which sentences are in the past tense?</p>', 0, NULL, '2026-05-10 07:56:33', '2026-05-10 07:56:33'),
(48, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>Cats are popular pets because they are independent and easy to care for.</blockquote>', 0, NULL, '2026-05-10 07:57:14', '2026-05-10 07:57:14'),
(49, 2, 'single_choice', '<p>Choose the correct word to complete the sentence!</p><blockquote>We _____ basketball every Friday afternoon.</blockquote>', 0, NULL, '2026-05-10 07:58:00', '2026-05-10 07:58:00'),
(50, 2, 'single_choice', '<p>What is the synonym of <em>begin</em>?</p>', 0, NULL, '2026-05-10 07:58:08', '2026-05-10 07:58:08'),
(51, 2, 'multiple_choice', '<p>Which of the following are verbs?</p>', 0, NULL, '2026-05-10 07:58:17', '2026-05-10 07:58:17'),
(52, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>Recycling helps reduce waste and protects the environment from pollution.</blockquote>', 0, NULL, '2026-05-10 07:59:09', '2026-05-10 07:59:09'),
(53, 2, 'single_choice', '<p>Read the sentence below!</p><blockquote>Sarah usually drinks tea in the morning.</blockquote><p>What does Sarah usually drink?</p>', 0, NULL, '2026-05-10 07:59:21', '2026-05-10 07:59:21'),
(54, 2, 'multiple_choice', '<p>Which sentences are grammatically correct?</p>', 0, NULL, '2026-05-10 07:59:32', '2026-05-10 07:59:32'),
(55, 2, 'single_choice', '<p>What is the antonym of <em>difficult</em>?</p>', 0, NULL, '2026-05-10 07:59:40', '2026-05-10 07:59:40'),
(56, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>Trees produce oxygen and provide shade for humans and animals.</blockquote>', 0, NULL, '2026-05-10 08:00:18', '2026-05-10 08:00:18'),
(57, 2, 'single_choice', '<p>Choose the correct sentence.</p>', 0, NULL, '2026-05-10 08:00:27', '2026-05-10 08:00:27'),
(58, 2, 'multiple_choice', '<p>Read the text below!</p><blockquote>The school held a clean-up activity on Saturday. Students and teachers worked together to clean the classrooms and school yard.</blockquote><p>Which statements are correct?</p>', 0, NULL, '2026-05-10 08:00:38', '2026-05-10 08:00:38'),
(59, 2, 'single_choice', '<p>Complete the sentence!</p><blockquote>My brother is _____ than me.</blockquote>', 0, NULL, '2026-05-10 08:00:51', '2026-05-10 08:00:51'),
(60, 2, 'true_false_table', '<p>Read the text below!</p><blockquote>Reading books regularly can improve vocabulary and increase knowledge.</blockquote>', 0, NULL, '2026-05-10 08:01:37', '2026-05-10 08:01:37'),
(61, 3, 'single_choice', '<p>Hasil dari <strong>25+17×2</strong> adalah …</p>', 0, NULL, '2026-05-10 08:18:12', '2026-05-10 08:18:12'),
(62, 3, 'short_answer', '<p>Sebuah persegi memiliki sisi 12 cm. Berapakah luas persegi tersebut?</p>', 0, '144', '2026-05-10 08:18:27', '2026-05-10 08:18:27'),
(63, 3, 'multiple_choice', '<p>Bilangan yang merupakan kelipatan 3 adalah …</p>', 0, NULL, '2026-05-10 08:18:40', '2026-05-10 08:18:40'),
(64, 3, 'true_false_table', '<p>Perhatikan pernyataan berikut!</p>', 0, NULL, '2026-05-10 08:19:33', '2026-05-10 08:19:33'),
(65, 3, 'single_choice', '<p>Nilai dari <strong>3x+5</strong> jika<strong> x=4</strong> adalah …</p>', 0, NULL, '2026-05-10 08:20:14', '2026-05-10 08:20:14'),
(66, 3, 'short_answer', '<p>Sebuah segitiga memiliki alas 10 cm dan tinggi 8 cm. Hitung luas segitiga tersebut!</p>', 0, '40', '2026-05-10 08:20:49', '2026-05-10 08:20:49'),
(67, 3, 'multiple_choice', '<p>Manakah bilangan prima berikut?</p>', 0, NULL, '2026-05-10 08:22:07', '2026-05-10 08:22:07'),
(68, 3, 'single_choice', '<p>Sebuah toko memberikan diskon 20% untuk barang seharga Rp200.000. Harga setelah diskon adalah …</p>', 0, NULL, '2026-05-10 08:22:16', '2026-05-10 08:22:16'),
(69, 3, 'true_false_table', '<p>Tentukan benar atau salah setiap pernyataan berikut!</p>', 0, NULL, '2026-05-10 08:23:57', '2026-05-10 08:23:57'),
(70, 3, 'short_answer', '<p>Sebuah mobil menempuh jarak 180 km dalam waktu 3 jam. Berapakah kecepatan rata-ratanya dalam km/jam?</p>', 0, '60', '2026-05-10 08:24:17', '2026-05-10 08:24:17'),
(71, 3, 'single_choice', '<p>Hasil dari <strong>72÷8+6</strong> adalah …</p>', 0, NULL, '2026-05-10 08:29:20', '2026-05-10 08:29:20'),
(72, 3, 'short_answer', '<p>Sebuah balok memiliki panjang 10 cm, lebar 5 cm, dan tinggi 4 cm. Hitung volume balok tersebut!</p>', 0, '200', '2026-05-10 08:29:38', '2026-05-10 08:29:38'),
(73, 3, 'multiple_choice', '<p>Manakah pecahan yang nilainya lebih kecil dari 1/2​ ?</p>', 0, NULL, '2026-05-10 08:30:10', '2026-05-10 08:30:10'),
(74, 3, 'true_false_table', '<p>Perhatikan pernyataan berikut!</p>', 0, NULL, '2026-05-10 08:32:07', '2026-05-10 08:32:07'),
(75, 3, 'single_choice', '<p>Nilai dari <strong>4x−7</strong> jika <strong>x=5</strong> adalah …</p>', 0, NULL, '2026-05-10 08:32:44', '2026-05-10 08:32:44'),
(76, 3, 'short_answer', '<p>Harga sebuah buku Rp45.000. Jika mendapat diskon Rp5.000, berapa harga yang harus dibayar?</p>', 0, '40000', '2026-05-10 08:33:08', '2026-05-10 08:33:08'),
(77, 3, 'multiple_choice', '<p>Bilangan yang termasuk faktor dari 24 adalah …</p>', 0, NULL, '2026-05-10 08:33:22', '2026-05-10 08:33:22'),
(78, 3, 'single_choice', '<p>Sebuah kelas terdiri dari 18 siswa laki-laki dan 12 siswa perempuan. Jumlah seluruh siswa adalah …</p>', 0, NULL, '2026-05-10 08:33:31', '2026-05-10 08:33:31'),
(79, 3, 'true_false_table', '<p>Tentukan benar atau salah setiap pernyataan berikut!</p>', 0, NULL, '2026-05-10 08:34:15', '2026-05-10 08:34:15'),
(80, 3, 'short_answer', '<p>Sebuah tabungan awal Rp250.000 ditambah Rp50.000 setiap minggu. Berapa jumlah tabungan setelah 4 minggu?</p>', 0, '450000', '2026-05-10 08:34:39', '2026-05-10 08:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `question_statements`
--

CREATE TABLE `question_statements` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `statement_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_value` tinyint(1) NOT NULL DEFAULT '0',
  `order` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_statements`
--

INSERT INTO `question_statements` (`id`, `question_id`, `statement_text`, `correct_value`, `order`, `created_at`, `updated_at`) VALUES
(1, 5, 'Keberagaman budaya merupakan kekayaan nasional.', 1, 1, '2026-05-10 04:24:24', '2026-05-10 04:24:24'),
(2, 5, 'Budaya daerah tidak perlu dilestarikan.', 0, 2, '2026-05-10 04:24:24', '2026-05-10 04:24:24'),
(3, 5, 'Perkembangan zaman dapat memengaruhi budaya daerah.', 1, 3, '2026-05-10 04:24:24', '2026-05-10 04:24:24'),
(4, 5, 'Indonesia hanya memiliki satu budaya daerah.', 0, 4, '2026-05-10 04:24:24', '2026-05-10 04:24:24'),
(5, 9, 'Huruf kapital digunakan pada awal nama orang.', 1, 1, '2026-05-10 07:10:17', '2026-05-10 07:10:17'),
(6, 9, 'Tanda titik digunakan pada akhir kalimat berita.', 1, 2, '2026-05-10 07:10:17', '2026-05-10 07:10:17'),
(7, 9, 'Kata depan “di” selalu digabung dengan kata setelahnya.', 0, 3, '2026-05-10 07:10:18', '2026-05-10 07:10:18'),
(8, 9, 'Judul buku ditulis menggunakan huruf kapital seluruhnya.', 0, 4, '2026-05-10 07:10:18', '2026-05-10 07:10:18'),
(9, 13, 'Membaca buku dapat menambah wawasan.', 1, 1, '2026-05-10 07:12:16', '2026-05-10 07:12:16'),
(10, 13, 'Membaca buku menurunkan kemampuan berpikir kritis.', 0, 2, '2026-05-10 07:12:16', '2026-05-10 07:12:16'),
(11, 13, 'Kegiatan membaca memiliki manfaat positif.', 1, 3, '2026-05-10 07:12:16', '2026-05-10 07:12:16'),
(12, 13, 'Teks membahas olahraga rutin.', 0, 4, '2026-05-10 07:12:16', '2026-05-10 07:12:16'),
(13, 18, 'Teknologi digital mempermudah akses informasi.', 1, 1, '2026-05-10 07:19:27', '2026-05-10 07:19:27'),
(14, 18, 'Media sosial termasuk teknologi digital.', 1, 2, '2026-05-10 07:19:27', '2026-05-10 07:19:27'),
(15, 18, 'Informasi kini lebih sulit diperoleh.', 0, 3, '2026-05-10 07:19:27', '2026-05-10 07:19:27'),
(16, 18, 'Internet tidak memiliki hubungan dengan penyebaran informasi.', 0, 4, '2026-05-10 07:19:27', '2026-05-10 07:19:27'),
(17, 22, 'Kalimat efektif harus hemat kata.', 1, 1, '2026-05-10 07:20:43', '2026-05-10 07:20:43'),
(18, 22, 'Penggunaan kata yang berlebihan dapat membuat kalimat tidak efektif.', 1, 2, '2026-05-10 07:20:43', '2026-05-10 07:20:43'),
(19, 22, 'Semua kalimat panjang pasti efektif.', 0, 3, '2026-05-10 07:20:43', '2026-05-10 07:20:43'),
(20, 22, 'Kalimat efektif memudahkan pembaca memahami informasi.', 1, 4, '2026-05-10 07:20:43', '2026-05-10 07:20:43'),
(21, 26, 'Olahraga bermanfaat bagi kesehatan tubuh.', 1, 1, '2026-05-10 07:21:54', '2026-05-10 07:21:54'),
(22, 26, 'Teks membahas pola makan sehat.', 0, 2, '2026-05-10 07:21:54', '2026-05-10 07:21:54'),
(23, 26, 'Daya tahan fisik dapat meningkat dengan olahraga.', 1, 3, '2026-05-10 07:21:54', '2026-05-10 07:21:54'),
(24, 26, 'Olahraga teratur memberikan dampak positif.', 1, 4, '2026-05-10 07:21:54', '2026-05-10 07:21:54'),
(25, 30, 'Menanam pohon dapat mengurangi polusi udara.', 1, 1, '2026-05-10 07:23:13', '2026-05-10 07:23:13'),
(26, 30, 'Lingkungan menjadi lebih panas karena pohon.', 0, 2, '2026-05-10 07:23:13', '2026-05-10 07:23:13'),
(27, 30, 'Teks membahas manfaat menanam pohon.', 1, 3, '2026-05-10 07:23:13', '2026-05-10 07:23:13'),
(28, 30, 'Pohon tidak memiliki manfaat bagi lingkungan.', 0, 4, '2026-05-10 07:23:13', '2026-05-10 07:23:13'),
(29, 34, 'Elephants are small animals.', 0, 1, '2026-05-10 07:42:33', '2026-05-10 07:42:33'),
(30, 34, 'Elephants use their trunks for many activities.', 1, 2, '2026-05-10 07:42:33', '2026-05-10 07:42:33'),
(31, 34, 'Elephants live only in deserts.', 0, 3, '2026-05-10 07:42:33', '2026-05-10 07:42:33'),
(32, 34, 'The text talks about elephants.', 1, 4, '2026-05-10 07:42:33', '2026-05-10 07:42:33'),
(33, 39, 'Plants need water to survive.', 1, 1, '2026-05-10 07:43:56', '2026-05-10 07:43:56'),
(34, 39, 'Only humans need water.', 0, 2, '2026-05-10 07:43:56', '2026-05-10 07:43:56'),
(35, 39, 'Animals also need water.', 1, 3, '2026-05-10 07:43:56', '2026-05-10 07:43:56'),
(36, 39, 'The text discusses food production.', 0, 4, '2026-05-10 07:43:56', '2026-05-10 07:43:56'),
(37, 43, 'The sun rises in the east.', 1, 1, '2026-05-10 07:44:59', '2026-05-10 07:44:59'),
(38, 43, 'The sun sets in the west.', 1, 2, '2026-05-10 07:44:59', '2026-05-10 07:44:59'),
(39, 43, 'The sun rises at night.', 0, 3, '2026-05-10 07:44:59', '2026-05-10 07:44:59'),
(40, 43, 'The text explains about the sun.', 1, 4, '2026-05-10 07:44:59', '2026-05-10 07:44:59'),
(41, 48, 'Cats are difficult to care for.', 0, 1, '2026-05-10 07:57:14', '2026-05-10 07:57:14'),
(42, 48, 'Cats are popular pets.', 1, 2, '2026-05-10 07:57:14', '2026-05-10 07:57:14'),
(43, 48, 'Cats are independent animals.', 1, 3, '2026-05-10 07:57:14', '2026-05-10 07:57:14'),
(44, 48, 'The text discusses wild animals in forests.', 0, 4, '2026-05-10 07:57:14', '2026-05-10 07:57:14'),
(45, 52, 'Recycling can reduce waste.', 1, 1, '2026-05-10 07:59:09', '2026-05-10 07:59:09'),
(46, 52, 'Recycling harms the environment.', 0, 2, '2026-05-10 07:59:09', '2026-05-10 07:59:09'),
(47, 52, 'Pollution can be reduced through recycling.', 1, 3, '2026-05-10 07:59:09', '2026-05-10 07:59:09'),
(48, 52, 'The text talks about transportation.', 0, 4, '2026-05-10 07:59:09', '2026-05-10 07:59:09'),
(49, 56, 'Trees produce oxygen.', 1, 1, '2026-05-10 08:00:18', '2026-05-10 08:00:18'),
(50, 56, 'Trees provide shade.', 1, 2, '2026-05-10 08:00:18', '2026-05-10 08:00:18'),
(51, 56, 'Trees are harmful to humans.', 0, 3, '2026-05-10 08:00:18', '2026-05-10 08:00:18'),
(52, 56, 'The text explains the benefits of trees.', 1, 4, '2026-05-10 08:00:18', '2026-05-10 08:00:18'),
(53, 60, 'Reading books can improve vocabulary.', 1, 1, '2026-05-10 08:01:37', '2026-05-10 08:01:37'),
(54, 60, 'Reading books decreases knowledge.', 0, 2, '2026-05-10 08:01:37', '2026-05-10 08:01:37'),
(55, 60, 'The text discusses the benefits of reading.', 1, 3, '2026-05-10 08:01:37', '2026-05-10 08:01:37'),
(56, 60, 'Reading books has no positive effect.', 0, 4, '2026-05-10 08:01:37', '2026-05-10 08:01:37'),
(57, 64, '7×8=56', 1, 1, '2026-05-10 08:19:33', '2026-05-10 08:19:33'),
(58, 64, '45÷5=8', 0, 2, '2026-05-10 08:19:33', '2026-05-10 08:19:33'),
(59, 64, '9+6=15', 1, 3, '2026-05-10 08:19:33', '2026-05-10 08:19:33'),
(60, 64, '10^2=20', 0, 4, '2026-05-10 08:19:33', '2026-05-10 08:19:33'),
(61, 69, 'Bilangan genap habis dibagi 2.', 1, 1, '2026-05-10 08:23:57', '2026-05-10 08:23:57'),
(62, 69, '15 adalah bilangan prima.', 0, 2, '2026-05-10 08:23:57', '2026-05-10 08:23:57'),
(63, 69, '6^2=36', 1, 3, '2026-05-10 08:23:57', '2026-05-10 08:23:57'),
(64, 69, 'Pecahan 1/2 lebih besar dari 3/4', 0, 4, '2026-05-10 08:23:57', '2026-05-10 08:23:57'),
(65, 74, '5^2=25', 1, 1, '2026-05-10 08:32:08', '2026-05-10 08:32:08'),
(66, 74, '9×7=72', 0, 2, '2026-05-10 08:32:08', '2026-05-10 08:32:08'),
(67, 74, '100÷4=25', 1, 3, '2026-05-10 08:32:08', '2026-05-10 08:32:08'),
(68, 74, '13−8=6', 0, 4, '2026-05-10 08:32:08', '2026-05-10 08:32:08'),
(69, 79, 'Segitiga memiliki 3 sisi.', 1, 1, '2026-05-10 08:34:15', '2026-05-10 08:34:15'),
(70, 79, 'Persegi memiliki 5 sudut.', 0, 2, '2026-05-10 08:34:15', '2026-05-10 08:34:15'),
(71, 79, 'Lingkaran tidak memiliki titik sudut.', 1, 3, '2026-05-10 08:34:15', '2026-05-10 08:34:15'),
(72, 79, 'Kubus memiliki 12 rusuk.', 1, 4, '2026-05-10 08:34:15', '2026-05-10 08:34:15');

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
('W9RO53Dv3XXQxwH4O8kXyGkMWiM5F6hjKuzrLjNT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkRBNVJyMjBHQ2N3ZjJ3ZFdnMHFzTEhabGJ5VXkwWUcyZ1dxMVpqVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1778402828);

-- --------------------------------------------------------

--
-- Table structure for table `subtests`
--

CREATE TABLE `subtests` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subtests`
--

INSERT INTO `subtests` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Literasi Bahasa Indonesia', 'literasi-bahasa-indonesia', 'Mengukur kemampuan peserta dalam memahami, menganalisis, dan mengevaluasi berbagai jenis teks berbahasa Indonesia, termasuk kemampuan tata bahasa, kosakata, serta penalaran verbal.', '2026-05-10 03:39:54', '2026-05-10 03:39:54'),
(2, 'Literasi Bahasa Inggris', 'literasi-bahasa-inggris', 'Mengukur kemampuan peserta dalam memahami teks berbahasa Inggris, penguasaan grammar dan vocabulary, serta kemampuan menarik informasi dan kesimpulan dari bacaan.', '2026-05-10 03:40:13', '2026-05-10 03:40:13'),
(3, 'Penalaran Matematika', 'penalaran-matematika', 'Mengukur kemampuan peserta dalam memahami konsep matematika, menyelesaikan persoalan numerik, berpikir logis, serta menerapkan strategi penyelesaian masalah secara sistematis.', '2026-05-10 03:40:27', '2026-05-10 03:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', '$2y$12$UoPc4C4QQH5qmykHA06T.ubr.Mf79JcvC1QQmkUfnjsKW3ErS9WXu', NULL, 'admin', 1, 'ncsdzk638QrDoWCO117v6xIZRsujiLpFXQKtOUMAyqWUJ4JGy0T0TOC2DDYW', '2026-05-10 03:38:50', '2026-05-10 03:38:50'),
(3, 'Alfriza Akhmad Rahadi', 'roshinante678@gmail.com', '$2y$12$n/pnBoHXfA8jh0Lz01/o1OcwAZxbqd88enqOko3NwxGnUDfdbmU9W', 'user_photos/alfriza-akhmad-rahadi-roshinante678-at-gmailcom-20260510113254.jpg', 'user', 1, NULL, '2026-05-10 04:32:54', '2026-05-10 08:02:02'),
(6, 'Muhamad Azka Maulidina', 'gnjrbibd@gmail.com', '$2y$12$TRwGvGdBaGEZLUVeg3af7u/tzpBekMTgOyljDIhM.Ait/s9PP7.sy', 'user_photos/muhamad-azka-maulidina-gnjrbibd-at-gmailcom-20260510113756.jpg', 'user', 1, NULL, '2026-05-10 04:37:57', '2026-05-10 08:02:17'),
(7, 'Muhamad Fauzan Pratama', 'fauzanpratama28x@gmail.com', '$2y$12$Zs74ijv/1HjE8VYYn89jwe4CavlPgo5/viMey.YjvN/y7j23WCjlG', 'user_photos/muhamad-fauzan-pratama-fauzanpratama28x-at-gmailcom-20260510113942.jpg', 'user', 1, NULL, '2026-05-10 04:39:43', '2026-05-10 08:02:30'),
(8, 'Fattih Fawwaz Sutisna', 'fattfaww@gmail.com', '$2y$12$pY2DW6W7GJGFcxZW3Gq2QO2Ws8DaUXAHQ7r8BKXjuq0NYzYbb.TU6', 'user_photos/fattih-fawwaz-sutisna-fattfaww-at-gmailcom-20260510114122.jpg', 'user', 1, NULL, '2026-05-10 04:41:22', '2026-05-10 08:02:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abilities_participant_id_foreign` (`participant_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_participant_id_foreign` (`participant_id`),
  ADD KEY `answers_question_id_foreign` (`question_id`),
  ADD KEY `answers_option_id_foreign` (`option_id`);

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
-- Indexes for table `examples`
--
ALTER TABLE `examples`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `examples_slug_unique` (`slug`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_slug_unique` (`slug`),
  ADD KEY `exams_subtest_id_foreign` (`subtest_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_results_participant_id_foreign` (`participant_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item_parameters`
--
ALTER TABLE `item_parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_parameters_question_id_foreign` (`question_id`),
  ADD KEY `item_parameters_question_statement_id_foreign` (`question_statement_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_user_id_foreign` (`user_id`),
  ADD KEY `participants_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_slug_unique` (`slug`);

--
-- Indexes for table `program_participant`
--
ALTER TABLE `program_participant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_participant_user_id_choice_order_unique` (`user_id`,`choice_order`),
  ADD UNIQUE KEY `program_participant_user_id_program_id_unique` (`user_id`,`program_id`),
  ADD KEY `program_participant_program_id_foreign` (`program_id`);

--
-- Indexes for table `program_subtest_weights`
--
ALTER TABLE `program_subtest_weights`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_subtest_weights_program_id_subtest_id_unique` (`program_id`,`subtest_id`),
  ADD KEY `program_subtest_weights_subtest_id_foreign` (`subtest_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `question_statements`
--
ALTER TABLE `question_statements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_statements_question_id_foreign` (`question_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subtests`
--
ALTER TABLE `subtests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subtests_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examples`
--
ALTER TABLE `examples`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_parameters`
--
ALTER TABLE `item_parameters`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_participant`
--
ALTER TABLE `program_participant`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `program_subtest_weights`
--
ALTER TABLE `program_subtest_weights`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `question_statements`
--
ALTER TABLE `question_statements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `subtests`
--
ALTER TABLE `subtests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abilities`
--
ALTER TABLE `abilities`
  ADD CONSTRAINT `abilities_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_subtest_id_foreign` FOREIGN KEY (`subtest_id`) REFERENCES `subtests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_parameters`
--
ALTER TABLE `item_parameters`
  ADD CONSTRAINT `item_parameters_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_parameters_question_statement_id_foreign` FOREIGN KEY (`question_statement_id`) REFERENCES `question_statements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_participant`
--
ALTER TABLE `program_participant`
  ADD CONSTRAINT `program_participant_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `program_participant_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_subtest_weights`
--
ALTER TABLE `program_subtest_weights`
  ADD CONSTRAINT `program_subtest_weights_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `program_subtest_weights_subtest_id_foreign` FOREIGN KEY (`subtest_id`) REFERENCES `subtests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_statements`
--
ALTER TABLE `question_statements`
  ADD CONSTRAINT `question_statements_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
