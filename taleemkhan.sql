-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 11:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taleemkhan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('super_admin','district_admin','school_admin') NOT NULL DEFAULT 'super_admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@sba.com', '$2y$12$jce.OO3PJGw5hES6MYSeTuOLwYjhAKNPMUWF1KPWE8ZAs1HqhbPwC', '03001234567', 'super_admin', 1, '2025-11-14 07:05:09', '2025-11-14 07:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Devanteborough', '2025-11-14 07:04:59', '2025-11-14 07:04:59'),
(2, 'Port Aiyana', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(3, 'Antoninamouth', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(4, 'Steubermouth', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(5, 'Carolefort', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(6, 'North Bennett', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(7, 'South Jaysonton', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(8, 'Olsonborough', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(9, 'Lake Genoveva', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(10, 'New Lorenz', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(11, 'North Devenborough', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(12, 'Mayertview', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(13, 'Dorotheaside', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(14, 'East Wallacemouth', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(15, 'Schmelerstad', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(16, 'Lake Abigaletown', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(17, 'New Lolaville', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(18, 'Lake Bradlyshire', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(19, 'East Robbieburgh', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(20, 'Jewellbury', '2025-11-14 07:05:00', '2025-11-14 07:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_formats`
--

CREATE TABLE `fee_formats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `monthly_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transport_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `computer_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_formats`
--

INSERT INTO `fee_formats` (`id`, `school_id`, `class_id`, `monthly_fee`, `transport_fee`, `computer_fee`, `total_fee`, `created_at`, `updated_at`) VALUES
(1, 21, 1, 600.00, 500.00, 200.00, 1300.00, '2025-11-15 02:59:04', '2025-11-15 03:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `fee_records`
--

CREATE TABLE `fee_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `remarks` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_records`
--

INSERT INTO `fee_records` (`id`, `student_id`, `class_id`, `school_id`, `month`, `year`, `discount`, `total_fee`, `paid_amount`, `due_amount`, `status`, `remarks`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 21, 'November', '2024', 500.00, 1300.00, 400.00, 400.00, 'Partial', NULL, '2025-11-15', '2025-11-15 03:12:37', '2025-11-15 03:12:37'),
(2, 6, 1, 21, 'November', '2025', 0.00, 1300.00, 0.00, 1300.00, 'Unpaid', NULL, '2025-11-15', '2025-11-15 03:12:37', '2025-11-15 03:12:37'),
(3, 1, 1, 21, 'January', '2025', 500.00, 1300.00, 500.00, 300.00, 'Partial', NULL, '2025-11-15', '2025-11-15 03:25:14', '2025-11-15 03:25:14'),
(4, 6, 1, 21, 'January', '2025', 0.00, 1300.00, 0.00, 1300.00, 'Unpaid', NULL, '2025-11-15', '2025-11-15 03:25:14', '2025-11-15 03:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `generated_papers`
--

CREATE TABLE `generated_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `paper_type` varchar(255) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `version` varchar(255) NOT NULL,
  `question_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`question_ids`)),
  `total_marks` int(11) DEFAULT NULL,
  `academic_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Grade 1', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(2, 'Grade 2', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(4, 'Grade 3', NULL, NULL),
(5, 'Grade 4', NULL, NULL),
(6, 'Grade 5', NULL, NULL),
(7, 'Grade 6', NULL, NULL),
(8, 'Grade 7', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_banks`
--

CREATE TABLE `item_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `slo` varchar(255) DEFAULT NULL,
  `slo_no` varchar(255) DEFAULT NULL,
  `skill` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `difficulty` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_description` text DEFAULT NULL,
  `stimulus` text DEFAULT NULL,
  `option_a` text DEFAULT NULL,
  `option_b` text DEFAULT NULL,
  `option_c` text DEFAULT NULL,
  `option_d` text DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `possible_answers` text DEFAULT NULL,
  `marking_hints` text DEFAULT NULL,
  `rubric` text DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_banks`
--

INSERT INTO `item_banks` (`id`, `subject_id`, `grade_id`, `slo`, `slo_no`, `skill`, `semester`, `month`, `difficulty`, `category`, `item_type`, `item_description`, `stimulus`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `possible_answers`, `marking_hints`, `rubric`, `total_marks`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Aut recusandae.', 'SLO-b242686d-50c9-4e02-b6e8-32f52d1db65f', 'speaking', 'Spring', 'January', 'Hard', 'Practical', 'MCQ', 'Rem assumenda ea aut maiores nihil reiciendis sunt eos quisquam assumenda natus.', 'Quia doloribus quas repellat recusandae amet.', 'inventore', 'corrupti', 'et', 'illo', 'D', 'Cumque magnam et aperiam.', 'Quis quis eos consequuntur cumque quia et.', 'Eos rem deserunt delectus quis quibusdam repellendus ipsa at.', 4, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(2, 1, 2, 'Qui ad aliquid.', 'SLO-1d018feb-f4a3-4e70-86ce-b9620ecef2cb', 'lisning', 'Fall', 'January', 'Medium', 'Knowledge', 'RRQ', 'Ut est nam cupiditate dolores quia sint in.', 'Distinctio sint sed velit et nobis sed ullam qui eius perspiciatis.', 'eaque', 'ipsam', 'mollitia', 'error', 'A', 'Magni expedita tempora veritatis voluptatem ratione vel.', 'Debitis laboriosam et omnis qui.', 'Non deleniti fuga animi vero totam qui.', 7, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(3, 2, 1, 'Consequatur beatae et et.', 'SLO-11b6f72b-6c1d-48c1-bd78-0a3a42eebccb', 'speaking', 'Fall', 'February', 'Medium', 'Theritical', 'RRQ', 'Aut est vitae unde repellendus incidunt expedita quia sed mollitia nostrum omnis.', 'Labore voluptate rerum alias repellendus quis nihil ullam hic.', 'optio', 'consectetur', 'rerum', 'voluptatem', 'B', 'Voluptatem dolores et est consequatur.', 'Labore atque laboriosam nemo rerum sit molestiae.', 'Rerum vitae vel rem dolorem in nisi.', 3, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(4, 1, 1, 'Animi et asperiores qui.', 'SLO-89a80281-8fb7-4db2-8219-d945eb4dd7a5', 'lisning', 'Fall', 'February', 'Easy', 'Analysis', 'ERQ', 'Est quia eius numquam voluptas facilis sint sapiente earum amet dolore.', 'Qui numquam quo non non voluptatem eveniet rerum.', 'repudiandae', 'laudantium', 'ipsum', 'eius', 'B', 'Velit est eligendi nam molestiae ut nobis.', 'Voluptas vel dignissimos rerum tempora inventore.', 'Qui iusto enim veniam beatae.', 9, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(5, 2, 1, 'Doloribus magni similique.', 'SLO-0e6aeb67-9937-43d0-a56b-ad91e01d12f5', 'reading', 'Fall', 'February', 'Easy', 'Practical', 'RRQ', 'Dolorem ut nesciunt laboriosam velit architecto eos incidunt.', 'Aliquam laborum amet ab sit minus sit tempore molestiae.', 'debitis', 'et', 'ut', 'voluptates', 'D', 'Totam aut illum est voluptatibus.', 'Maiores ut et omnis.', 'Nemo sit earum cumque reprehenderit.', 9, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(6, 1, 1, 'Veniam consectetur nihil omnis.', 'SLO-c561d695-fed1-440a-b48f-01ce4474dfaa', 'speaking', 'Spring', 'January', 'Hard', 'Practical', 'MCQ', 'Adipisci maiores possimus omnis non sint molestias.', 'Non repellat esse voluptatem aliquid.', 'cum', 'sapiente', 'alias', 'incidunt', 'B', 'Explicabo ullam alias officia aut impedit sint.', 'Est eligendi voluptate deleniti.', 'Reprehenderit consequuntur quisquam saepe.', 2, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(7, 1, 2, 'Reprehenderit quo facilis totam.', 'SLO-d4e86e9d-e801-43b2-8f46-f69b58e431d6', 'speaking', 'Spring', 'January', 'Easy', 'Analysis', 'ERQ', 'Numquam recusandae sequi porro fugit sint eum.', 'Eos molestias suscipit eligendi quasi dolor eius maxime iste.', 'illo', 'impedit', 'et', 'illum', 'C', 'Consequatur perferendis ducimus voluptatibus est omnis.', 'Provident placeat non consequatur molestias aperiam.', 'Minus voluptatem voluptas voluptatibus. Et quis consectetur quia vel eius qui iure.', 1, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(8, 2, 2, 'Dolore nemo.', 'SLO-a13f3f15-71f0-4c07-90a0-db4223d5b32c', 'lisning', 'Fall', 'January', 'Easy', 'Analysis', 'RRQ', 'Quia temporibus molestiae sed ab odio eius similique unde et molestias ea.', 'Enim cum non laborum voluptatem enim velit non aut inventore.', 'itaque', 'sapiente', 'ea', 'enim', 'A', 'Perferendis ea et nihil quos et et.', 'Dicta corrupti molestias at vel.', 'Harum et qui corporis qui rerum molestiae. Ut quia autem eum est dolor delectus.', 5, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(9, 2, 2, 'Id est.', 'SLO-2a532e57-4105-44ec-86fc-5e69e16d2833', 'speaking', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Neque rerum corrupti consequatur quia qui aspernatur omnis corrupti fugit ut dolore animi natus.', 'Et consequuntur nesciunt harum nam laboriosam eos eligendi qui quia.', 'libero', 'dicta', 'et', 'veritatis', 'A', 'Totam autem doloribus itaque.', 'Dolorum aperiam dolorem debitis sed totam.', 'Omnis velit ut autem eos aut porro. Hic aliquid tenetur maiores.', 8, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(10, 1, 2, 'Hic dicta dignissimos dolores vel.', 'SLO-1b8a540d-04de-46a6-923b-dcfede17756e', 'reading', 'Fall', 'January', 'Easy', 'Knowledge', 'RRQ', 'Maiores facere at qui enim nihil sit.', 'Et provident labore facilis molestiae reiciendis laboriosam rerum.', 'praesentium', 'sapiente', 'alias', 'qui', 'A', 'Autem labore recusandae reprehenderit.', 'Voluptas voluptate deleniti aliquam.', 'Molestiae velit voluptas consequuntur est natus. Libero perspiciatis nostrum repellendus aut illo repellendus est.', 9, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(11, 2, 2, 'Doloribus minima corrupti nobis.', 'SLO-b39b3bde-bcc2-4680-9426-f24e0a348b35', 'lisning', 'Fall', 'February', 'Easy', 'Analysis', 'RRQ', 'Possimus et veniam vitae nulla nihil dolorem quidem fugiat.', 'Dolor similique quod beatae eius eveniet laboriosam.', 'aspernatur', 'sed', 'nam', 'doloremque', 'B', 'Ratione doloremque sapiente consequatur.', 'Ab ea similique qui a at qui.', 'Eos quia ad sunt totam mollitia a expedita.', 6, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(12, 1, 2, 'Eum sint tempora.', 'SLO-ef8f4aa5-a872-4c82-8781-580fa1c0b3bc', 'reading', 'Spring', 'January', 'Medium', 'Knowledge', 'ERQ', 'Voluptatem harum debitis hic fugit nesciunt aut voluptatem culpa.', 'Quisquam illum ut sed excepturi asperiores consequatur.', 'voluptatibus', 'voluptatem', 'blanditiis', 'et', 'C', 'Molestiae quos minima enim possimus sunt.', 'Quos eveniet fugit sit vel laudantium.', 'Consequatur quia consequuntur sequi asperiores.', 8, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(13, 1, 1, 'Aut enim quod eum.', 'SLO-06954d2d-e449-4283-9d87-8c48a9efca33', 'writing', 'Fall', 'January', 'Hard', 'Analysis', 'ERQ', 'Enim qui saepe exercitationem eligendi voluptas hic quae quibusdam ex et dolor laborum.', 'Accusamus est non quibusdam sed sed.', 'voluptates', 'consequuntur', 'explicabo', 'minima', 'C', 'Ad corporis cupiditate rerum sunt non explicabo.', 'Ut non molestiae explicabo.', 'Deserunt aliquam corporis nostrum enim.', 1, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(14, 1, 2, 'Veritatis eius animi.', 'SLO-d7cbda7d-de8a-4ad4-81c3-b6fb3491b303', 'writing', 'Fall', 'February', 'Hard', 'Analysis', 'MCQ', 'Voluptatem odio autem sint dolorum sed similique non.', 'Nulla quod occaecati et sit vitae excepturi repellendus dolores repudiandae.', 'delectus', 'vel', 'id', 'quasi', 'B', 'Tempora quis aperiam ut qui necessitatibus.', 'Et nam sunt deserunt repudiandae expedita.', 'Id qui ducimus sed hic voluptatem ipsam. Est qui quibusdam itaque velit veritatis modi.', 3, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(15, 1, 2, 'Est eveniet omnis facere.', 'SLO-a9cfe768-61be-430f-bc53-f4a51e48d01b', 'lisning', 'Spring', 'February', 'Easy', 'Analysis', 'MCQ', 'Nesciunt fugit sapiente ut non dolorum delectus nisi aliquid.', 'Placeat ullam nulla consequuntur consequatur fugiat.', 'nemo', 'beatae', 'unde', 'debitis', 'C', 'Quae a quas occaecati.', 'Cupiditate neque repudiandae voluptas.', 'Nobis possimus est quis nam. Iusto expedita harum mollitia voluptates.', 2, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(16, 2, 2, 'Culpa omnis sed eos.', 'SLO-0203b35a-7c1a-42b1-ae87-ded6bb133d64', 'reading', 'Spring', 'January', 'Medium', 'Practical', 'RRQ', 'Cumque voluptatem itaque mollitia qui in unde mollitia consectetur est quia perferendis.', 'Ipsum odio quo laboriosam exercitationem veniam ipsa ex dolorem molestiae cumque.', 'laborum', 'et', 'autem', 'et', 'B', 'Qui ut magnam totam exercitationem aut repellendus.', 'Blanditiis quidem ut quibusdam sint sint.', 'Nihil ducimus et voluptas nesciunt.', 6, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(17, 2, 1, 'Occaecati quas maiores.', 'SLO-4b967279-34eb-4378-b533-8e7a0634c87e', 'reading', 'Fall', 'February', 'Hard', 'Theritical', 'RRQ', 'Illum libero voluptates nihil voluptas doloremque nobis tempore aperiam.', 'Quibusdam consequatur non in enim tempore quisquam neque.', 'autem', 'ut', 'amet', 'qui', 'C', 'Odit quibusdam in voluptatem et.', 'Similique ullam adipisci incidunt.', 'Rem id quo ea et temporibus. Sapiente quisquam consectetur molestiae ipsam explicabo animi quo.', 2, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(18, 2, 1, 'Itaque debitis ut.', 'SLO-61eae838-e7ad-4da2-a855-3cc15a9a850f', 'speaking', 'Spring', 'February', 'Medium', 'Knowledge', 'MCQ', 'Minima sequi est dicta rerum veritatis eaque perferendis iste ipsum asperiores consequatur ut aliquid.', 'Sunt perspiciatis dolores et voluptas error quas qui quod aut ut nulla.', 'quis', 'consequuntur', 'optio', 'ducimus', 'C', 'Vero est est amet ut eaque.', 'Assumenda et in ad sint error.', 'Libero culpa voluptas enim est qui expedita consequatur magnam. Debitis laboriosam debitis aliquid impedit recusandae saepe.', 7, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(19, 2, 1, 'Perferendis eaque praesentium.', 'SLO-5cbd43d2-b1c7-4874-92cc-81e2fbd7d89c', 'writing', 'Fall', 'February', 'Hard', 'Theritical', 'MCQ', 'Aspernatur eum eaque labore est est quo culpa aut.', 'Cum aperiam illo consequatur rerum consectetur aut dicta dignissimos inventore beatae.', 'ea', 'voluptates', 'eos', 'eum', 'B', 'Quasi assumenda et voluptatem odio enim.', 'Sit eos expedita quaerat velit fuga.', 'Repellat rerum reiciendis dignissimos.', 8, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(20, 1, 2, 'Autem magnam.', 'SLO-af3ab310-bac6-4645-aa26-f7da109a65f8', 'writing', 'Fall', 'February', 'Medium', 'Theritical', 'RRQ', 'Consequatur qui qui eos nobis necessitatibus est delectus in eos.', 'Quia eos voluptas a sit facere nam illum quaerat unde.', 'nisi', 'repellat', 'et', 'corporis', 'D', 'Itaque expedita nesciunt nihil id eaque quia.', 'Quasi neque dolorem placeat.', 'Voluptas laborum consequatur delectus perspiciatis praesentium porro enim. Fugit neque vero sed natus tenetur nihil.', 9, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(21, 2, 2, 'Distinctio voluptate eius corrupti.', 'SLO-d0e9a31e-51a8-4038-ac09-a8e922e8d840', 'reading', 'Fall', 'January', 'Easy', 'Theritical', 'MCQ', 'Sit aut atque reiciendis quasi aliquid temporibus.', 'Non ut minima illo a veritatis et est quam.', 'voluptate', 'quia', 'temporibus', 'qui', 'D', 'Et et velit impedit odit aut sed.', 'Id ipsa sunt soluta.', 'Ut totam ducimus et alias commodi beatae earum. Nisi totam ab quas doloremque doloribus.', 8, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(22, 2, 2, 'Et consequuntur pariatur.', 'SLO-8a03b312-1477-4dc1-bdd3-f528a48b40a1', 'reading', 'Fall', 'February', 'Easy', 'Practical', 'MCQ', 'Earum voluptatibus possimus quis necessitatibus iusto repellat nihil temporibus et.', 'Non nulla molestias voluptate ut fugiat alias.', 'consequatur', 'quaerat', 'in', 'eaque', 'C', 'Odit nulla quo ex ipsam.', 'Culpa sit et et soluta dicta quia.', 'Veritatis aut ad veritatis voluptate.', 7, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(23, 1, 2, 'Quas libero quisquam sint.', 'SLO-aca984ad-39fc-4afc-a31f-b571fc4d561d', 'reading', 'Fall', 'January', 'Hard', 'Knowledge', 'RRQ', 'Repellendus est delectus perferendis doloremque voluptatum nam porro culpa incidunt.', 'Quia illum iure dignissimos hic assumenda magni aut ut sed quo.', 'laborum', 'pariatur', 'quibusdam', 'vitae', 'A', 'Cum ut sunt nemo amet sapiente.', 'Sit facilis et suscipit.', 'Et commodi voluptatem laboriosam.', 5, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(24, 2, 2, 'Ullam repellat reiciendis.', 'SLO-44b9129b-b33c-4dc4-8edc-94d8a153d5e1', 'speaking', 'Fall', 'January', 'Hard', 'Knowledge', 'MCQ', 'Sequi inventore exercitationem qui distinctio sequi incidunt molestiae praesentium at ratione.', 'Accusantium eos eos ea earum voluptatem.', 'voluptatem', 'nisi', 'sed', 'exercitationem', 'D', 'Officiis atque alias quidem reprehenderit iusto.', 'Voluptatibus sapiente et odio.', 'Veritatis sit unde qui architecto aut quam.', 8, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(25, 1, 2, 'Rem veniam qui optio nam.', 'SLO-615a9fc7-3d06-4152-bfc9-51f83d6b685a', 'writing', 'Spring', 'February', 'Hard', 'Practical', 'RRQ', 'Sit et optio quod at facilis saepe autem quia.', 'Autem molestiae laudantium et sunt at a repudiandae placeat.', 'reiciendis', 'voluptatem', 'accusamus', 'vitae', 'D', 'Mollitia eveniet totam et beatae ipsam aut.', 'Commodi id quam saepe omnis reiciendis ea.', 'Sed aut quos maxime quas dolorem excepturi quasi. Porro sequi dolores a tempora est.', 7, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(26, 2, 2, 'Quo vel quia.', 'SLO-38877096-483d-453d-990b-be6172cb34c7', 'writing', 'Fall', 'February', 'Medium', 'Knowledge', 'ERQ', 'Dolor consequuntur sequi est dignissimos iure itaque voluptatibus dolores et nulla.', 'Qui deleniti odio est et ipsam alias minus voluptatem asperiores repellendus.', 'modi', 'consequatur', 'quis', 'doloremque', 'D', 'Alias quis asperiores est laboriosam et officia.', 'Veniam in soluta aliquid.', 'Repellat ut quaerat et architecto. Quas quia deleniti quos.', 2, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(27, 1, 1, 'Sit nihil.', 'SLO-9f9903be-50d9-43c2-8d46-e1ce2b4f270b', 'speaking', 'Fall', 'January', 'Easy', 'Practical', 'ERQ', 'Tempora in reprehenderit atque fugit consequuntur quasi libero rem dolor nesciunt beatae consequatur.', 'Aut ut fuga consequuntur explicabo debitis et animi eos ipsa.', 'eius', 'ab', 'eveniet', 'omnis', 'C', 'Commodi ratione fugiat sit unde voluptatem.', 'Totam sequi distinctio ut quo asperiores.', 'Tempore et saepe aspernatur quia doloribus.', 8, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(28, 2, 2, 'Asperiores accusantium.', 'SLO-23946866-7b5b-401b-a0e8-f37bf273b5f6', 'writing', 'Spring', 'January', 'Medium', 'Practical', 'MCQ', 'Repudiandae alias molestias perspiciatis dolore rem corrupti est quo.', 'Quasi nemo enim nihil rem ducimus est et saepe officiis.', 'impedit', 'est', 'eligendi', 'quibusdam', 'A', 'Temporibus magnam voluptas pariatur.', 'Natus architecto nulla similique molestiae et laudantium.', 'Omnis natus voluptate rem est labore rem.', 10, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(29, 2, 2, 'Aliquid quis quisquam voluptate.', 'SLO-a2940283-4c87-4353-86b1-120121e43ecf', 'speaking', 'Spring', 'February', 'Hard', 'Theritical', 'ERQ', 'Facilis quisquam minima dolorum commodi sit tempora saepe quidem nesciunt.', 'Debitis amet ut nisi optio pariatur saepe praesentium.', 'dolor', 'molestiae', 'earum', 'et', 'D', 'Eos est totam occaecati.', 'Consectetur quasi quia amet laboriosam.', 'Eos nam ab qui nemo sint libero.', 9, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(30, 2, 2, 'In voluptas quaerat dolorem.', 'SLO-3b7eea8f-e7dc-4cca-94c3-6d03e02d57a6', 'lisning', 'Spring', 'February', 'Hard', 'Knowledge', 'RRQ', 'Officiis eos molestias autem sequi laborum iusto quis necessitatibus est.', 'Quasi et quae commodi totam ab autem omnis.', 'consequatur', 'culpa', 'accusantium', 'assumenda', 'B', 'Amet molestias blanditiis dolores optio pariatur.', 'Dolores optio et ex voluptatum quisquam.', 'Et libero cumque et perferendis illo.', 2, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(31, 1, 1, 'Provident velit omnis nihil.', 'SLO-fa62d77e-be09-44a3-83ee-0ae9f29815cf', 'lisning', 'Fall', 'February', 'Easy', 'Practical', 'RRQ', 'Ea quos expedita maxime architecto pariatur ex dolore ea sit accusantium earum neque et.', 'Eum qui consequatur dolore consequatur consequatur dolore quidem voluptas iste.', 'reprehenderit', 'ea', 'quo', 'voluptatem', 'A', 'Consequatur ut aut facere.', 'Accusantium delectus quisquam necessitatibus.', 'Molestias voluptas nobis enim nemo. Recusandae aliquam earum quo beatae non asperiores.', 7, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(32, 1, 1, 'Qui magni enim.', 'SLO-70117943-67d4-4503-8ae5-2104d33c5139', 'writing', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Enim asperiores quasi ut numquam vitae itaque voluptates et sit.', 'Praesentium illo alias tempore voluptate velit impedit.', 'temporibus', 'consequatur', 'ex', 'debitis', 'B', 'Ut perferendis inventore eum laborum consequatur.', 'Omnis quam ut voluptatibus nemo nemo.', 'Quia incidunt non corporis aut debitis. Molestiae odio ut sequi dolorem.', 5, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(33, 1, 1, 'Saepe incidunt non voluptatem.', 'SLO-e58c0b10-1679-4284-9822-32eb930d1360', 'writing', 'Fall', 'January', 'Hard', 'Knowledge', 'MCQ', 'Aut deleniti quo est accusantium autem aut commodi sit.', 'Quo officiis repellendus hic alias consectetur.', 'architecto', 'vel', 'esse', 'maiores', 'A', 'Odio iure eius hic cum.', 'Vitae qui voluptas dolorem reprehenderit illum.', 'Aut necessitatibus amet earum natus.', 4, '2025-11-14 07:05:11', '2025-11-14 07:05:11'),
(34, 1, 2, 'Ut impedit dolor.', 'SLO-b1b3c147-1395-4576-9d9c-8bf4dc5e4c06', 'lisning', 'Fall', 'January', 'Easy', 'Theritical', 'ERQ', 'Sint qui minima aut quia maxime rerum veniam sit.', 'Blanditiis provident doloribus culpa aut omnis delectus.', 'architecto', 'quibusdam', 'sapiente', 'consequatur', 'C', 'Ex sed unde nobis rerum non.', 'Dolor accusantium maxime dolore soluta quia totam.', 'Rem non repellat atque perspiciatis rem libero impedit. Aut pariatur qui fuga molestiae quis nesciunt.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(35, 1, 1, 'Veniam ut ea.', 'SLO-2b2c1514-29cb-4ff3-93e6-37480f4d3c48', 'speaking', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Eum iure minus debitis maiores nostrum autem quo molestias aut aspernatur error.', 'Eligendi quia voluptates totam nulla laudantium eos qui.', 'et', 'et', 'facere', 'illo', 'B', 'Illo et quo minima in dicta voluptatem.', 'Quibusdam ipsa dolore quis et quas facere enim.', 'Est corrupti hic aut officia iusto repellat. Sit deserunt quisquam labore fugit.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(36, 2, 2, 'Maiores id necessitatibus consequatur.', 'SLO-a5861061-9075-4854-8ca2-6e84fe0d13b9', 'writing', 'Fall', 'January', 'Hard', 'Analysis', 'ERQ', 'Cum occaecati vel fuga nostrum libero enim.', 'Ut maxime pariatur suscipit ratione aut et minima.', 'et', 'voluptatibus', 'sint', 'ut', 'A', 'Est culpa debitis saepe cumque.', 'Blanditiis odio molestias quia dolor veritatis.', 'Et cumque modi aliquid doloremque facere dolorum quis. Laboriosam et fugit cum illum vel.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(37, 1, 2, 'Cum iusto corporis adipisci.', 'SLO-b4d783df-d240-42e0-bc3b-32b52679aa57', 'speaking', 'Fall', 'January', 'Easy', 'Theritical', 'RRQ', 'Est error et aut commodi quis quae rem ab et corrupti quas.', 'Explicabo numquam sunt rerum quis adipisci.', 'est', 'esse', 'aut', 'vel', 'C', 'Dicta libero modi rem cupiditate qui placeat.', 'Ex ducimus possimus praesentium expedita.', 'Rem non pariatur et aliquid maxime est officia.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(38, 2, 2, 'Molestiae facilis sit.', 'SLO-95c8e0c4-665a-4dcb-a165-404197556eb9', 'speaking', 'Fall', 'February', 'Medium', 'Analysis', 'MCQ', 'Deserunt eaque eos at quaerat et ducimus iusto sapiente est eveniet eveniet.', 'Aspernatur ipsam qui tenetur qui quia ex nihil.', 'nulla', 'quod', 'cumque', 'odio', 'B', 'Quae cumque natus doloremque rem dolores cum.', 'Consequatur quibusdam quam in est ut.', 'Voluptas vel autem quisquam ut illum quod.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(39, 1, 1, 'Labore voluptas aut sunt.', 'SLO-393b6908-9d0e-4456-8592-e39c45f3ba34', 'speaking', 'Spring', 'January', 'Easy', 'Knowledge', 'RRQ', 'Architecto veritatis officia nisi quia amet facilis eligendi et.', 'Eum nihil et repudiandae necessitatibus autem et eveniet.', 'voluptas', 'autem', 'et', 'aperiam', 'C', 'Deserunt voluptate molestias molestiae voluptatibus.', 'Nihil eos corporis necessitatibus odio.', 'Iste libero aut tenetur consequuntur pariatur enim.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(40, 1, 1, 'Blanditiis error explicabo aut.', 'SLO-9fe1e27b-4cce-434d-ba85-34c3a379d10e', 'speaking', 'Fall', 'February', 'Hard', 'Analysis', 'MCQ', 'At praesentium odit esse laborum molestias temporibus et commodi alias.', 'Sed vel dolore reprehenderit dolorem eius consectetur ut rerum soluta.', 'quo', 'molestiae', 'est', 'quam', 'C', 'Et officiis laudantium sed.', 'Rerum est cumque ea dolor eveniet.', 'Illum fugit ut enim in quia est voluptas minima.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(41, 1, 2, 'Sit nesciunt illum.', 'SLO-5c247d5e-5dd6-46dc-8e55-9968adf290a3', 'lisning', 'Fall', 'February', 'Medium', 'Practical', 'RRQ', 'Et aliquam suscipit voluptatum dolorem dolor eum quasi doloremque culpa.', 'Aut quibusdam non accusantium eveniet quia repellat sit et adipisci quia aut.', 'qui', 'ut', 'recusandae', 'asperiores', 'B', 'Aperiam sed et in nostrum nisi unde.', 'Beatae molestiae amet ut.', 'Repellendus voluptate repellendus modi est itaque. Ut dolorem labore aliquam illum dolorum soluta.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(42, 1, 1, 'Omnis earum maiores.', 'SLO-8dc319f8-b654-4f35-be87-4cff65fbc116', 'speaking', 'Spring', 'January', 'Easy', 'Theritical', 'ERQ', 'Quibusdam pariatur sit omnis deleniti aut omnis ad alias ipsam voluptatem nisi deleniti et.', 'Accusamus sint quis quae rerum voluptatibus.', 'maiores', 'porro', 'dolor', 'ratione', 'A', 'Ex quaerat culpa qui unde autem sint.', 'Sed quia quaerat eveniet laborum consequatur sit.', 'Et dolor magni reprehenderit rerum aspernatur dolores. Id eum excepturi est consequatur iure.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(43, 2, 1, 'Ex et error dicta.', 'SLO-27106262-275d-4624-a172-342c0abef89a', 'lisning', 'Spring', 'January', 'Easy', 'Practical', 'RRQ', 'Suscipit at vero labore maxime magnam exercitationem nisi.', 'Vero cupiditate magni dolor natus cumque pariatur dolore.', 'ut', 'recusandae', 'ea', 'dicta', 'C', 'Aut laudantium officia aliquid.', 'Pariatur neque eos tenetur optio reiciendis error.', 'Nobis expedita blanditiis dolorum et voluptates.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(44, 1, 2, 'Beatae facere in.', 'SLO-d21e4064-9d10-45cb-8d35-125cf053fd09', 'reading', 'Spring', 'February', 'Hard', 'Theritical', 'RRQ', 'Et ipsa est aut blanditiis cupiditate rerum qui nisi voluptas error quod.', 'Ab in at non quis eum.', 'culpa', 'inventore', 'similique', 'aut', 'C', 'Nobis inventore rerum corrupti.', 'Dolor ratione neque tempore labore suscipit dolores.', 'Veritatis cumque ratione aperiam eligendi saepe.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(45, 1, 2, 'Vel natus nesciunt.', 'SLO-37b117ef-7d61-4083-9d79-54fc0587a57e', 'lisning', 'Spring', 'February', 'Easy', 'Theritical', 'ERQ', 'Dolores sit harum quia voluptatem qui minus id eum.', 'Ratione maiores sit voluptatem nam sit aliquam praesentium fugiat.', 'provident', 'autem', 'magnam', 'hic', 'C', 'Dolore eum corrupti quis illum ad ut.', 'Iusto non eveniet delectus.', 'Sed qui accusamus molestias possimus nemo ad.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(46, 2, 2, 'Quia amet aut impedit.', 'SLO-0ad8f6aa-5229-4d96-9e84-f00686871a85', 'reading', 'Fall', 'January', 'Hard', 'Knowledge', 'MCQ', 'Incidunt aut dolorem excepturi maiores qui eum ut.', 'Blanditiis distinctio placeat culpa qui omnis maiores enim recusandae numquam.', 'dolorem', 'sint', 'accusamus', 'nihil', 'D', 'Asperiores earum rerum repellat.', 'Debitis velit voluptas sed repudiandae impedit voluptas.', 'Sit aperiam quo sint. Esse officia voluptatum suscipit cumque qui voluptatum voluptas.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(47, 1, 1, 'Commodi saepe.', 'SLO-7c57f269-77ed-4b4a-a872-1ec2ab5f1b95', 'writing', 'Spring', 'February', 'Easy', 'Knowledge', 'ERQ', 'Autem sint temporibus qui ut explicabo enim architecto fugit atque dolores aut hic illum.', 'Numquam quasi repudiandae sed est qui at eos et.', 'ad', 'id', 'aspernatur', 'dolor', 'A', 'Ut deserunt libero rem.', 'Pariatur non officia maxime.', 'Ut assumenda beatae quo autem id vitae reprehenderit consectetur. Accusantium maiores enim temporibus quia sapiente.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(48, 1, 2, 'In dolorem.', 'SLO-2bea50fb-46ce-4b58-af40-bbf3fc9beac8', 'reading', 'Fall', 'February', 'Hard', 'Knowledge', 'ERQ', 'Iste debitis repudiandae repellat harum reprehenderit et natus.', 'Suscipit qui rerum ipsum nobis aut.', 'et', 'officia', 'nihil', 'nulla', 'B', 'Laborum qui et sapiente aut vel aspernatur.', 'Possimus ducimus nemo vel enim.', 'Dolore est dolorum ea cumque assumenda similique.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(49, 2, 1, 'Fuga aliquam at molestiae porro.', 'SLO-92223685-0dbc-439a-b860-07566204e383', 'speaking', 'Spring', 'January', 'Medium', 'Knowledge', 'MCQ', 'Corrupti vitae accusantium aliquid ducimus sit qui dolore tempora ut.', 'Ipsa possimus dolorum distinctio reprehenderit voluptatibus debitis neque.', 'voluptas', 'voluptate', 'doloribus', 'sed', 'A', 'Dolorum delectus numquam ut sit.', 'Voluptates qui est reprehenderit inventore placeat.', 'Neque sint quia iure suscipit deleniti similique.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(50, 1, 2, 'Dolorem eum recusandae.', 'SLO-a280c0b6-872d-45b7-8034-f136c5c1776b', 'reading', 'Fall', 'January', 'Hard', 'Analysis', 'RRQ', 'Nostrum vitae eum aut accusamus quia esse possimus delectus id officiis cupiditate fuga alias.', 'Ratione blanditiis error consequatur perspiciatis ullam sit ut expedita nihil quae.', 'et', 'labore', 'ut', 'eaque', 'A', 'Quam molestias dolorem ullam aspernatur doloremque.', 'Assumenda dolor eos facilis modi magni.', 'Debitis beatae eius neque sint enim quod. Corporis nam molestiae doloribus est qui voluptas molestiae.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(51, 1, 2, 'Quis est aperiam.', 'SLO-78a40497-b7be-49c9-8f20-282547011fbe', 'writing', 'Spring', 'February', 'Hard', 'Knowledge', 'RRQ', 'Consequatur assumenda voluptatem aut asperiores quasi laboriosam quia sint repellat dolorem.', 'Repellat veniam odit quas laborum sint quaerat rem sequi.', 'vero', 'asperiores', 'et', 'similique', 'C', 'Nostrum est ullam sint sequi error.', 'Ipsam nostrum aut fugiat.', 'Sit est officiis debitis eaque omnis qui et. Consequatur quae nihil quibusdam expedita qui possimus ut.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(52, 2, 1, 'Porro qui corporis tenetur.', 'SLO-f6c8fb52-b767-4367-828e-1bab08107078', 'speaking', 'Spring', 'January', 'Medium', 'Analysis', 'ERQ', 'Omnis asperiores quibusdam dolor illum tempora soluta porro.', 'Qui minima non ea velit voluptatem et unde.', 'rem', 'sunt', 'ullam', 'quae', 'C', 'Est vel magnam et omnis voluptates fugiat.', 'Ratione et impedit unde vero ipsa.', 'Quo consequatur molestiae exercitationem cupiditate repudiandae necessitatibus omnis. Tempore ex aut quia similique.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(53, 1, 2, 'Et architecto quia illum.', 'SLO-749ff42e-6040-4b5a-b404-92bdc8116ef9', 'writing', 'Fall', 'February', 'Easy', 'Theritical', 'ERQ', 'Ratione et veniam expedita deserunt enim ipsum a minima laudantium debitis.', 'Laudantium veritatis cumque minima labore quo.', 'consectetur', 'accusamus', 'inventore', 'mollitia', 'A', 'Quisquam ut reprehenderit sed debitis delectus nulla.', 'Debitis id iusto error et recusandae.', 'Aut non nulla aut ea. Sit excepturi necessitatibus molestiae velit iure.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(54, 2, 2, 'Sit ut voluptatem minus soluta.', 'SLO-3b858a74-42b1-4ccb-ac29-7c53faada5d8', 'reading', 'Fall', 'February', 'Medium', 'Practical', 'MCQ', 'Pariatur temporibus sunt voluptas laboriosam dolores maxime ea eum dolorum.', 'Consequatur ipsum odit sed optio aut vero delectus est.', 'voluptas', 'sit', 'porro', 'et', 'C', 'Dolores rerum voluptatibus delectus.', 'Eos nemo quia aut.', 'Ut laborum ducimus deleniti perspiciatis.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(55, 1, 2, 'Architecto odio rerum et aliquam.', 'SLO-2cd30557-72d2-49d0-a412-90d19135ec1f', 'lisning', 'Spring', 'February', 'Hard', 'Analysis', 'ERQ', 'Eveniet quas unde dignissimos et iure dolorum fuga iusto soluta.', 'Ut culpa natus et laboriosam distinctio quis cupiditate et.', 'ullam', 'corrupti', 'sed', 'illum', 'B', 'Non aut voluptates qui dolores.', 'Placeat provident voluptates alias voluptatem possimus incidunt.', 'Incidunt totam dicta in ut numquam iusto aut eos. Sequi id sequi sequi exercitationem.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(56, 2, 1, 'Commodi soluta vel incidunt.', 'SLO-4c48784f-354f-4665-8f36-d4ed9cbaaf38', 'lisning', 'Spring', 'January', 'Easy', 'Analysis', 'ERQ', 'Porro officia consequatur labore ex ullam voluptatem.', 'Debitis quae beatae velit voluptatibus qui temporibus.', 'nihil', 'sit', 'saepe', 'modi', 'A', 'Quas ea voluptate sunt dolorem et voluptas.', 'Voluptas necessitatibus omnis autem assumenda qui corporis.', 'Veritatis molestiae eum ea amet nemo explicabo ratione repellendus. Ratione corporis iusto et et.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(57, 2, 2, 'Reiciendis sint nostrum impedit.', 'SLO-2a75e789-2e5a-4995-a010-3d695792aed3', 'speaking', 'Fall', 'February', 'Hard', 'Practical', 'ERQ', 'Provident distinctio fugit rem minus numquam eius facilis ut.', 'Odit qui mollitia perspiciatis et.', 'iure', 'quidem', 'et', 'perspiciatis', 'A', 'Et harum odit aut.', 'Suscipit accusantium blanditiis ut impedit qui.', 'Nihil est quos mollitia animi cupiditate corrupti. Quia dolores delectus voluptatem omnis.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(58, 1, 1, 'Perferendis omnis eius facilis aut.', 'SLO-60912dfe-72cf-4640-a023-585f72f68407', 'lisning', 'Fall', 'January', 'Easy', 'Theritical', 'MCQ', 'Consequatur asperiores quia vitae tempora provident placeat ut vitae non libero autem in.', 'Eaque sed exercitationem iusto impedit ipsa et est nihil.', 'et', 'aperiam', 'doloremque', 'rem', 'B', 'Non aliquam blanditiis voluptate rem.', 'Rerum ipsum nostrum dignissimos.', 'Vero aut blanditiis vel et quos. Debitis velit animi aperiam dolor eaque facere sit.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(59, 1, 1, 'Magnam ratione enim qui.', 'SLO-7ea1be64-50b6-4a55-a44f-6601d10bd534', 'speaking', 'Spring', 'January', 'Medium', 'Knowledge', 'RRQ', 'Sit neque nobis sequi distinctio sit itaque animi autem et.', 'Rerum quis ea ut ullam quis eius necessitatibus ipsum et.', 'expedita', 'libero', 'nostrum', 'facilis', 'D', 'Aliquid aut quos voluptatem.', 'Nihil mollitia voluptatem magni molestiae nulla.', 'Nobis facere corporis facilis fugit non qui a enim.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(60, 1, 2, 'Vel voluptatibus est.', 'SLO-04423c1b-cab8-4ed4-b1f3-5eb1ebf434a6', 'writing', 'Fall', 'February', 'Easy', 'Theritical', 'ERQ', 'Sint sunt quis et laborum et facere atque qui voluptates.', 'Delectus nemo sed laborum sit facere qui dicta.', 'dolor', 'corporis', 'veniam', 'et', 'B', 'Ipsam similique velit aut ipsum.', 'Ut quas iusto id rem sint architecto.', 'Blanditiis iste perferendis facere accusamus nemo. Ut voluptas consequatur est.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(61, 2, 2, 'Nihil qui qui iste.', 'SLO-74647f18-237c-42ad-b363-96647ede798c', 'writing', 'Spring', 'January', 'Easy', 'Analysis', 'RRQ', 'A id illum ut vitae eum voluptatem.', 'Qui labore velit id sit possimus voluptatum et sed voluptatem.', 'vel', 'sit', 'quasi', 'in', 'C', 'Voluptas et ut dolorum cum sit.', 'Et at et earum possimus.', 'Eos reprehenderit rerum aut. Id ad corrupti magni necessitatibus id.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(62, 2, 1, 'Qui distinctio et.', 'SLO-6ab41768-b55d-468d-a6c7-760749b0c9ba', 'lisning', 'Fall', 'February', 'Easy', 'Practical', 'RRQ', 'Suscipit minima laborum quo necessitatibus provident et quia.', 'Quo distinctio sapiente quod quos omnis cupiditate quae recusandae hic eum.', 'voluptates', 'in', 'odit', 'voluptatibus', 'A', 'Consequatur nesciunt tempora a cum.', 'Et aperiam molestiae reprehenderit quis sed maxime similique.', 'Nostrum sapiente rerum dolorem nulla.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(63, 1, 2, 'Id ipsa sed soluta consequatur.', 'SLO-f60c688c-68e7-4829-aa31-dc9ee4812a1b', 'speaking', 'Spring', 'February', 'Easy', 'Knowledge', 'MCQ', 'Natus porro quas animi ut voluptas placeat ea aperiam aut sit omnis id.', 'Asperiores non voluptatem vel molestiae eos magnam adipisci maxime.', 'voluptas', 'voluptates', 'voluptas', 'libero', 'A', 'In quaerat consequuntur qui harum impedit.', 'Praesentium consequatur consequuntur recusandae ut sint.', 'Nisi perspiciatis vel et ratione ducimus. Tenetur a sed libero beatae.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(64, 1, 1, 'Non et est delectus.', 'SLO-45e10f0a-68f8-4d40-95c7-2b3bf059c964', 'reading', 'Spring', 'February', 'Hard', 'Theritical', 'ERQ', 'Repellat similique totam ut excepturi suscipit provident libero repellendus nisi.', 'Commodi sunt sunt dolorum beatae praesentium.', 'occaecati', 'amet', 'aut', 'magnam', 'C', 'Tenetur quos qui quia officia cumque.', 'Dolor sunt error et.', 'Distinctio recusandae enim consequatur nemo. Est facilis impedit atque et reiciendis nihil.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(65, 1, 2, 'Aut aliquam tenetur aut.', 'SLO-9817205d-1e50-4774-b4fb-790f53c37c2c', 'writing', 'Spring', 'February', 'Hard', 'Knowledge', 'ERQ', 'Ex nihil possimus culpa qui qui autem saepe.', 'Ut ipsam nulla nesciunt totam eaque quia adipisci natus sequi eaque.', 'autem', 'necessitatibus', 'voluptatem', 'explicabo', 'B', 'Autem veritatis veniam aut ut.', 'Praesentium aut eligendi culpa nam a culpa.', 'Ut maxime sit eveniet aperiam corrupti facere dolorem.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(66, 2, 2, 'Consequatur nam minus.', 'SLO-f9dd9b04-cffd-493c-aedd-47867bfc2580', 'writing', 'Fall', 'January', 'Hard', 'Theritical', 'MCQ', 'Odio aliquam iusto pariatur ullam et sed accusamus sit error deleniti.', 'Quos inventore ut voluptas illum consequatur quos doloremque.', 'autem', 'dicta', 'sapiente', 'ea', 'B', 'Non voluptate distinctio et officia dolores.', 'Amet ut eligendi qui inventore.', 'Esse nihil quasi et labore.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(67, 2, 1, 'Illum aut molestiae nisi.', 'SLO-d125d7bd-5d76-41c8-a352-271737ace604', 'speaking', 'Spring', 'February', 'Medium', 'Knowledge', 'ERQ', 'Et quaerat numquam neque fugit voluptatibus quia perspiciatis adipisci nulla aut laborum quis.', 'Quaerat et exercitationem saepe rem.', 'velit', 'facilis', 'possimus', 'iure', 'B', 'Vel soluta excepturi aut expedita dicta fuga.', 'Alias modi enim ipsa nesciunt iste fuga.', 'Debitis et modi et est exercitationem.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(68, 2, 2, 'Consequuntur labore numquam.', 'SLO-a5538232-ecc4-4184-9bd0-cd38bbd642bc', 'writing', 'Spring', 'January', 'Medium', 'Knowledge', 'MCQ', 'Quaerat eos aut pariatur dolor sunt id cumque quasi qui.', 'Sit earum accusantium voluptatem asperiores non consequatur recusandae labore quia.', 'soluta', 'cumque', 'non', 'aut', 'B', 'Exercitationem sint adipisci nemo quidem dolorem.', 'Dolorem eum eos voluptatem aut voluptatum.', 'Error aut voluptas illum molestiae sunt ad rerum. Tempora quam explicabo id excepturi.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(69, 2, 1, 'Voluptate autem voluptatem.', 'SLO-dc4501a7-96c5-4972-b229-074dffa6bb29', 'speaking', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Qui quaerat ab qui nemo qui officia atque minima sunt.', 'In molestias ab ullam dolores quis quod recusandae illum.', 'qui', 'qui', 'dolores', 'qui', 'D', 'Quos dolores repellat rerum neque.', 'Dolores ipsa ut alias ea.', 'Perspiciatis quibusdam odit eligendi nobis et recusandae nesciunt. Ex magni libero sunt.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(70, 2, 1, 'Sit mollitia eveniet a.', 'SLO-5ad2d1e5-955c-4457-83b1-178e014d56bb', 'writing', 'Spring', 'January', 'Hard', 'Theritical', 'RRQ', 'Beatae voluptatem animi reprehenderit beatae incidunt delectus minima eveniet omnis ea.', 'Ratione iusto tempore quisquam non facere aut iure.', 'est', 'esse', 'cupiditate', 'omnis', 'C', 'Vero eos deserunt blanditiis quibusdam.', 'Quia repellendus qui iure quas consequatur aspernatur.', 'Consequatur suscipit autem omnis occaecati. Non veritatis excepturi qui ad nisi similique.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(71, 1, 2, 'Aliquid labore veritatis est.', 'SLO-33191fdf-a9c3-4285-91d0-4e7abc532d4b', 'lisning', 'Spring', 'January', 'Medium', 'Practical', 'ERQ', 'Itaque voluptate dolorum nihil qui aliquid voluptatem natus.', 'Quidem quae amet totam voluptatum doloremque magnam et debitis minus architecto.', 'minima', 'tempore', 'suscipit', 'eligendi', 'D', 'Officia porro commodi sit qui commodi earum.', 'Sint aut voluptates assumenda nostrum sint exercitationem.', 'Velit animi accusamus cum consequuntur aut officia magnam. Suscipit aut et quidem eum quam qui dolores ipsum.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(72, 1, 1, 'Cumque aspernatur soluta aperiam.', 'SLO-977630ef-0a2e-4924-9fca-03e382093399', 'lisning', 'Fall', 'January', 'Hard', 'Practical', 'RRQ', 'Sapiente in sint qui quibusdam laborum voluptas aperiam unde fugiat reprehenderit.', 'Quia veniam odio nostrum enim voluptatem totam.', 'iste', 'molestiae', 'et', 'consequuntur', 'B', 'Vel voluptatum non in rerum modi.', 'Dolor incidunt aut asperiores et et laborum.', 'Iste aut maiores blanditiis aperiam aut dolorem. Tempore rem consequatur eligendi minima aliquid dolorem quia.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(73, 2, 1, 'Nisi tenetur.', 'SLO-afc0cddc-6b67-4fcb-b92d-285b33647b2f', 'lisning', 'Spring', 'January', 'Medium', 'Practical', 'RRQ', 'Corrupti animi veniam saepe et ut ut.', 'Nam optio est quam deleniti deleniti aut aliquid facere et.', 'magnam', 'ut', 'totam', 'id', 'C', 'Temporibus eum harum cupiditate eum.', 'Voluptatibus consectetur labore qui.', 'Quasi eos odit autem id expedita vel et harum.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(74, 1, 2, 'Impedit incidunt odit ut.', 'SLO-f1e36ad3-4bc2-49be-8c38-afc3e8b1de24', 'reading', 'Spring', 'January', 'Easy', 'Practical', 'RRQ', 'Tempore sapiente tempore illo omnis eaque illo accusamus ut.', 'Non consequatur dolor possimus aut deserunt molestiae et qui id consequatur reiciendis.', 'nihil', 'reiciendis', 'rerum', 'saepe', 'C', 'Ullam laboriosam nulla ut sed adipisci.', 'Qui necessitatibus voluptatem rerum quasi esse et.', 'Laborum qui aut alias delectus explicabo.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(75, 1, 2, 'Eveniet aut ipsum incidunt.', 'SLO-c6630a3f-0c78-4191-816f-414bd1723e64', 'speaking', 'Fall', 'January', 'Easy', 'Practical', 'ERQ', 'Consequatur ullam consectetur qui soluta non consectetur non cupiditate voluptatem omnis esse ut dolorem.', 'Non occaecati et cum laborum nostrum voluptas cumque nisi.', 'vitae', 'nesciunt', 'sit', 'debitis', 'C', 'Possimus voluptate et voluptates doloribus itaque voluptates.', 'Quia labore aut quo nulla.', 'Quos id tempora error dolorem qui.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(76, 1, 1, 'Nisi placeat.', 'SLO-22f2e0bd-9f95-49a6-9f34-1952ba0aadc7', 'lisning', 'Spring', 'January', 'Medium', 'Theritical', 'RRQ', 'Aliquam ut enim repellat quia ut eveniet blanditiis illo dolorem.', 'Perferendis voluptatem totam error qui nesciunt et est.', 'maxime', 'nesciunt', 'pariatur', 'maxime', 'C', 'Dolore quidem fugiat est.', 'Et iste saepe facilis doloribus.', 'Adipisci a consequatur dicta beatae.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(77, 1, 2, 'Nihil eius odit.', 'SLO-0165f644-5bd0-43f6-9200-bda58d8bec05', 'reading', 'Spring', 'February', 'Easy', 'Analysis', 'ERQ', 'Voluptas temporibus eveniet et quaerat molestias tempore vero iste.', 'Qui corporis rerum quasi consectetur consequatur blanditiis cum voluptas rerum voluptatem rerum.', 'dolorem', 'rerum', 'sunt', 'atque', 'A', 'Modi illo et et accusantium consectetur.', 'Velit autem ut molestiae quas atque.', 'Reprehenderit iste aut voluptatem exercitationem mollitia.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(78, 2, 1, 'Est omnis quod assumenda.', 'SLO-ecd863ab-4fd4-4962-8536-7ad8ae12d2c0', 'writing', 'Fall', 'January', 'Easy', 'Knowledge', 'MCQ', 'Consequatur quo dolorem dolores et illum placeat tempore recusandae.', 'Suscipit dolores quod voluptas cupiditate est provident sit omnis minus magni.', 'voluptatum', 'tempora', 'reiciendis', 'cupiditate', 'B', 'Quia nam sed voluptatibus voluptate.', 'Et rerum soluta beatae.', 'Cupiditate accusamus quibusdam nostrum et.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(79, 1, 1, 'Blanditiis voluptates neque.', 'SLO-eae1cac3-c2b0-4881-902b-8df166b37ec4', 'reading', 'Fall', 'February', 'Hard', 'Practical', 'ERQ', 'Sunt quia error vitae iusto impedit et libero dolores voluptatem sequi inventore ducimus sequi dolorem.', 'Sit impedit laudantium quo eos nesciunt sunt.', 'consequatur', 'non', 'delectus', 'aut', 'B', 'Omnis odit voluptatum eos delectus ut dolore.', 'Dolores ducimus eveniet magnam molestiae ut laudantium.', 'Rem nesciunt debitis dolorem sint odio totam.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(80, 2, 2, 'Culpa et eum.', 'SLO-93b63d87-eafa-458f-9711-c55266eb3987', 'speaking', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Inventore voluptatem qui facere velit labore numquam.', 'Exercitationem itaque perferendis nobis voluptatem eos aperiam placeat.', 'et', 'temporibus', 'et', 'voluptate', 'C', 'Repellendus et non ratione recusandae.', 'Qui quia est atque.', 'Repellat est eius neque sunt quia architecto.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(81, 1, 2, 'Quasi ad quia eos.', 'SLO-2f82ba28-6a1b-4bff-bc96-82e607bb3d26', 'reading', 'Fall', 'January', 'Hard', 'Analysis', 'ERQ', 'Sint delectus aliquam explicabo labore non facere fugit excepturi ipsum.', 'Eum illum ut et ut atque.', 'eaque', 'veritatis', 'sapiente', 'enim', 'B', 'Aut et modi minima.', 'Quas sit est ipsa incidunt.', 'Modi sit voluptatem laborum consequatur quis.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(82, 1, 2, 'Perferendis porro natus fuga.', 'SLO-7fbf2292-1bfa-4117-88b9-14c96d144125', 'speaking', 'Spring', 'January', 'Hard', 'Theritical', 'ERQ', 'Praesentium sunt et reprehenderit dolore et optio est quis provident.', 'Rerum et aliquid accusantium saepe qui quaerat dicta qui aut omnis.', 'ratione', 'laudantium', 'quia', 'voluptatibus', 'C', 'Culpa quas qui et omnis.', 'Sit sed dolor sint.', 'Tenetur consectetur sunt sunt ut veritatis.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(83, 2, 2, 'Vitae quos eos voluptates.', 'SLO-34e087eb-2933-4883-b8fb-329e4f386e5b', 'speaking', 'Fall', 'January', 'Hard', 'Knowledge', 'MCQ', 'Architecto repudiandae soluta veritatis optio delectus aut explicabo labore voluptatum et.', 'Qui delectus consequatur pariatur voluptate sit.', 'qui', 'nisi', 'quam', 'perferendis', 'C', 'Eos nisi quia alias.', 'Atque esse sint velit neque.', 'Itaque qui et est. Sapiente et animi sint neque natus possimus.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(84, 2, 1, 'Dicta eum debitis in.', 'SLO-aa9134a2-b749-458c-a99c-4c09904b1e6b', 'lisning', 'Spring', 'January', 'Medium', 'Theritical', 'RRQ', 'Sed veritatis temporibus harum debitis et ut.', 'Est omnis temporibus neque in est beatae adipisci enim optio aspernatur amet.', 'in', 'in', 'aut', 'rerum', 'B', 'Incidunt quas dolor doloremque enim blanditiis officiis.', 'Repellendus quaerat dolorum id sed.', 'Vel corporis cumque veritatis aut.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(85, 1, 2, 'Et totam facilis.', 'SLO-64cf6d0e-f4af-4bed-b203-5d58be7d8da8', 'lisning', 'Spring', 'February', 'Hard', 'Analysis', 'RRQ', 'Ex est ipsam quo laudantium eaque vel omnis adipisci totam.', 'Qui ad in aperiam aliquid animi quo doloremque id quibusdam.', 'aliquid', 'omnis', 'recusandae', 'in', 'B', 'Autem ex et rerum expedita.', 'Aspernatur nihil tenetur rerum tenetur aut.', 'Nulla illum error qui qui architecto hic.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(86, 1, 2, 'Veritatis dolor molestiae at.', 'SLO-ef83aa69-5e2b-4db0-87d8-9b783a75d17d', 'writing', 'Fall', 'January', 'Hard', 'Knowledge', 'RRQ', 'Pariatur non rerum et et dolores molestiae voluptatum nulla incidunt et quis et ratione.', 'Repellat dolorem tenetur voluptates maxime et et dolor necessitatibus ut.', 'aliquam', 'perferendis', 'est', 'et', 'B', 'Impedit incidunt nihil adipisci est.', 'Consectetur temporibus incidunt placeat et.', 'Doloribus ipsum perspiciatis tempore necessitatibus.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(87, 1, 2, 'Provident nulla illum aut.', 'SLO-3abb49ce-476c-4281-8274-d8300bd8ebbc', 'reading', 'Spring', 'February', 'Medium', 'Practical', 'ERQ', 'Voluptas esse fugit odit aperiam placeat reprehenderit sed repellendus.', 'Nemo sequi aut eum ad harum saepe quo ducimus.', 'sint', 'enim', 'consequatur', 'dicta', 'A', 'Eveniet sed voluptatum iste.', 'Odit eveniet ducimus animi dignissimos quis aliquid inventore.', 'Saepe numquam nisi voluptas cumque.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(88, 1, 1, 'Velit provident cupiditate.', 'SLO-0c6da38f-a2df-4d35-8aa7-5974d2856e0f', 'writing', 'Fall', 'February', 'Hard', 'Analysis', 'RRQ', 'Et consequatur corporis in quia reprehenderit id minus voluptatem inventore eum fugiat quos.', 'Hic iste commodi nihil est non.', 'rerum', 'labore', 'omnis', 'ex', 'C', 'Ea enim omnis ipsum laboriosam.', 'Cum tempora itaque eveniet occaecati et.', 'Ab aliquid voluptatem et eum et.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(89, 1, 2, 'Molestiae occaecati inventore.', 'SLO-c3bf78e3-cf1f-4d0b-8ae7-6922761bf235', 'speaking', 'Fall', 'January', 'Hard', 'Practical', 'ERQ', 'Repudiandae eum velit voluptatem nulla placeat consequatur sit aut distinctio.', 'Repellendus perspiciatis ea ea ut consequatur ut esse deserunt distinctio iusto.', 'dolores', 'iure', 'quia', 'et', 'A', 'Excepturi fugiat voluptatum assumenda sit quia et.', 'Est aut ullam vero inventore.', 'Iste repellat pariatur cumque illo earum odit iure. Ab tempora iure debitis fugiat libero est hic.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(90, 1, 2, 'Officia sequi eaque tenetur assumenda.', 'SLO-4ba8c26f-ec67-4048-9e68-50a442d9cc66', 'lisning', 'Spring', 'January', 'Medium', 'Practical', 'RRQ', 'Rerum voluptatibus vero consectetur id est nam tenetur totam ex molestias est.', 'Dolorem suscipit autem reiciendis aut officiis tempore atque.', 'dolorem', 'rem', 'id', 'consequatur', 'B', 'Consequatur quisquam consectetur impedit est unde cum.', 'Architecto autem aut consequatur deserunt dignissimos.', 'Totam quas voluptatem ex unde est. Voluptas accusantium omnis voluptatum consequatur et eius minima non.', 4, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(91, 1, 2, 'Rerum dolor culpa dignissimos explicabo.', 'SLO-7c3a646b-5695-4dfa-a5c3-3d5dafde3176', 'speaking', 'Spring', 'February', 'Hard', 'Knowledge', 'RRQ', 'Deleniti quod voluptatibus omnis est itaque eos voluptatem dolor.', 'Quia fugit nostrum assumenda totam qui natus officia.', 'quam', 'qui', 'a', 'non', 'C', 'Iusto voluptatibus qui esse saepe unde.', 'Suscipit tempora aperiam minima eligendi.', 'Ut rerum nobis beatae quam itaque esse voluptas.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(92, 1, 1, 'Aut doloremque eligendi.', 'SLO-b4379144-8673-48c8-b35c-98a1ec9e7b77', 'writing', 'Fall', 'February', 'Medium', 'Knowledge', 'RRQ', 'Rerum vitae ut aspernatur est laborum explicabo recusandae corrupti voluptatem.', 'Qui quia in enim earum et voluptas tempora.', 'sed', 'voluptatibus', 'ipsa', 'sunt', 'C', 'Cupiditate quo quibusdam neque eum maxime.', 'Qui deleniti explicabo officia culpa.', 'Enim tempora odio et qui.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(93, 2, 1, 'Placeat qui qui.', 'SLO-74b7a4c1-5174-47c8-94b6-210ff58e1a70', 'writing', 'Fall', 'February', 'Hard', 'Practical', 'RRQ', 'Tempore in ducimus voluptas impedit eaque rerum qui aut quae voluptas mollitia.', 'Vel illo aut asperiores facere rem vel aut officia vero aut nam.', 'voluptatum', 'culpa', 'ut', 'vero', 'A', 'Quia molestiae enim perferendis vitae qui repudiandae dolore.', 'Eum corporis suscipit est.', 'Amet provident delectus et delectus natus voluptatem.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(94, 2, 2, 'Dolor natus iusto voluptas.', 'SLO-af62cbb7-25bd-4e2e-b3e8-7070b55ed25e', 'speaking', 'Spring', 'January', 'Easy', 'Theritical', 'ERQ', 'Illo recusandae aut eum ipsa et minima enim error est maiores deserunt.', 'Quaerat et aut sint possimus et maxime quia.', 'delectus', 'fugit', 'vitae', 'rerum', 'A', 'Deserunt voluptatem placeat aperiam atque enim.', 'Ratione voluptas voluptates voluptas.', 'Qui omnis aut illum provident enim accusantium aliquam.', 4, '2025-11-14 07:05:12', '2025-11-14 07:05:12');
INSERT INTO `item_banks` (`id`, `subject_id`, `grade_id`, `slo`, `slo_no`, `skill`, `semester`, `month`, `difficulty`, `category`, `item_type`, `item_description`, `stimulus`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `possible_answers`, `marking_hints`, `rubric`, `total_marks`, `created_at`, `updated_at`) VALUES
(95, 1, 1, 'Impedit voluptatem amet quia.', 'SLO-cc139580-1aa9-4ef4-a621-8b0997989b03', 'speaking', 'Fall', 'January', 'Hard', 'Analysis', 'MCQ', 'Sit ad voluptas pariatur porro in quae animi doloremque facere sed.', 'Sequi est aspernatur ad sunt ipsam adipisci facilis et dolor mollitia.', 'delectus', 'libero', 'consequuntur', 'eos', 'A', 'Aspernatur consequuntur et et.', 'Quia facere deleniti dicta sit et nulla.', 'Illum ducimus labore dignissimos minus culpa cupiditate corrupti. Culpa expedita sit ut facilis sit assumenda nisi.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(96, 2, 2, 'Commodi eos repellat.', 'SLO-5509a968-ac56-4a75-b19b-9b704a848eac', 'speaking', 'Spring', 'February', 'Medium', 'Theritical', 'RRQ', 'Asperiores consequatur aliquam sunt enim quae cupiditate quis laboriosam magnam ea.', 'Ut et doloribus esse iusto esse sit.', 'id', 'atque', 'dignissimos', 'velit', 'C', 'Ut excepturi veritatis nulla.', 'Sit sit vero eos dolorum.', 'Molestiae velit quidem minus error sed omnis fugiat.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(97, 2, 1, 'Doloribus autem.', 'SLO-8a3802e2-5d60-478b-a292-8aa855f76bc4', 'reading', 'Fall', 'February', 'Hard', 'Knowledge', 'MCQ', 'Veritatis laudantium modi qui consequatur incidunt impedit.', 'Alias dignissimos amet doloribus voluptatem distinctio alias adipisci repellendus nulla beatae.', 'illo', 'accusamus', 'quis', 'harum', 'B', 'Est tempore reiciendis consequuntur consequatur veniam qui.', 'Repellendus ratione laborum aliquam.', 'Laudantium atque perferendis nihil asperiores dolorem quia earum inventore. Vel fuga quaerat architecto sint quisquam.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(98, 2, 2, 'Pariatur voluptatem neque vel.', 'SLO-6d445cdd-2677-4e7c-8e50-4cacefafeb69', 'speaking', 'Fall', 'February', 'Easy', 'Practical', 'ERQ', 'Dicta quaerat debitis et vel et et asperiores dolores.', 'Illum omnis eum aperiam rem quo inventore possimus.', 'accusantium', 'nulla', 'delectus', 'dolore', 'D', 'Est quis repudiandae eius aut.', 'Repellendus quia cum iusto ut dolores voluptatem.', 'Quo ea minima numquam facere ut aliquam.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(99, 2, 2, 'Voluptas quod laudantium eos.', 'SLO-a079b6f8-4e64-4137-ac62-26d83984d69a', 'lisning', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Enim consectetur accusantium delectus aliquam nesciunt necessitatibus ab libero omnis quo animi omnis magni.', 'Rerum quo excepturi ratione explicabo aut totam vitae et id.', 'numquam', 'voluptates', 'illum', 'reprehenderit', 'C', 'Sed nemo qui cum rerum et voluptatem.', 'Unde quia est fuga quisquam.', 'Fugit animi qui aut eos quae.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(100, 2, 2, 'Voluptatibus omnis ipsa.', 'SLO-55a0ac01-08a7-4953-a12d-ba68dd18d72a', 'speaking', 'Spring', 'February', 'Easy', 'Theritical', 'RRQ', 'Perferendis repudiandae dolores quo nihil autem minima debitis.', 'Ut molestias quos voluptatibus debitis ipsa nulla vel natus.', 'laborum', 'fuga', 'modi', 'fugit', 'B', 'Est asperiores ea perferendis et expedita.', 'Autem dolorem asperiores vero.', 'Sunt eaque omnis voluptatem est tempora blanditiis fuga.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(101, 2, 2, 'Iusto explicabo officia.', 'SLO-a57808fc-a8ef-44d9-8adf-f1c847bfb90e', 'lisning', 'Fall', 'January', 'Easy', 'Practical', 'RRQ', 'Vel voluptatem vitae dolorem aut voluptatem qui non quas voluptas aut autem animi.', 'Quam repellendus nulla aut voluptatum commodi accusamus dolor.', 'et', 'minima', 'ex', 'nobis', 'D', 'Quisquam et id et labore mollitia.', 'Hic est porro doloremque et et.', 'Ea nam non et voluptas consectetur quo.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(102, 2, 1, 'Numquam eius et ex.', 'SLO-8b930651-645e-4d21-9eac-03f4a0d556db', 'writing', 'Spring', 'January', 'Easy', 'Knowledge', 'MCQ', 'Error quibusdam tenetur et voluptas odio similique.', 'Modi fugit possimus fugit explicabo perspiciatis.', 'temporibus', 'amet', 'id', 'qui', 'A', 'Qui vitae porro et adipisci minima earum.', 'Accusamus cum consequuntur dolores ut.', 'Voluptatem vitae debitis ut sit debitis temporibus molestiae. Quae eos pariatur id sit quo dolorum.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(103, 2, 2, 'Provident totam nulla et.', 'SLO-aba5e173-abc0-420a-b0d1-5bb953ff32e4', 'speaking', 'Fall', 'January', 'Medium', 'Analysis', 'MCQ', 'Harum qui sapiente in reiciendis assumenda culpa.', 'At sit aperiam aut sunt pariatur dicta.', 'odit', 'hic', 'et', 'quo', 'B', 'Quod provident nihil recusandae.', 'Praesentium expedita molestiae ea sunt.', 'Quod nihil possimus provident exercitationem temporibus animi labore.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(104, 1, 2, 'Natus facilis.', 'SLO-4d409f1d-66c8-48d9-befb-d710a01095ff', 'lisning', 'Spring', 'January', 'Easy', 'Practical', 'ERQ', 'Aut omnis voluptates alias voluptate voluptates voluptatem praesentium nam consequatur iure fugiat officiis eligendi.', 'Debitis amet est et minima consequatur.', 'omnis', 'placeat', 'nesciunt', 'non', 'C', 'Officia sequi hic vero eos earum architecto.', 'Voluptates qui impedit ipsam repudiandae.', 'Facilis ea iusto qui eligendi.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(105, 1, 2, 'Minima ut animi.', 'SLO-70c17e3f-d993-4eb4-ad3f-15cb7fafc2b6', 'lisning', 'Spring', 'January', 'Hard', 'Analysis', 'MCQ', 'Eveniet hic nisi quos dolor enim iure.', 'Amet corrupti mollitia aut optio iusto non rerum quod.', 'laborum', 'officia', 'eos', 'sed', 'C', 'Quibusdam omnis distinctio illum quibusdam.', 'Alias ut enim voluptatibus sed est velit.', 'Iste tempore voluptas eos praesentium. Itaque possimus voluptatem est quia ut.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(106, 2, 2, 'Ut numquam aut quae adipisci.', 'SLO-ee8709e2-f93d-4ff4-91dc-4b82f87b6c1e', 'lisning', 'Spring', 'February', 'Hard', 'Theritical', 'ERQ', 'Optio sunt aut quod eius earum nisi commodi quod vitae aspernatur maiores.', 'Debitis provident sint nemo ut et aliquam.', 'vel', 'sequi', 'ipsum', 'aspernatur', 'C', 'Illo ut voluptatem aliquid debitis eos quis.', 'Maxime labore iusto sequi rerum perferendis itaque.', 'Quae eius quis voluptates amet nulla quod tenetur doloribus.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(107, 2, 1, 'Sit quis autem.', 'SLO-937ca747-322f-4f9e-b7bd-0e8752106478', 'lisning', 'Spring', 'February', 'Medium', 'Knowledge', 'ERQ', 'Voluptatem minus ipsum laudantium in quo sed et ratione voluptas voluptas quia illum.', 'Fugit voluptatibus et accusantium at repellat reiciendis dolorem inventore qui veritatis.', 'non', 'fugiat', 'fuga', 'voluptatem', 'B', 'Nihil ipsum consectetur sunt iure excepturi.', 'Debitis rerum facere earum omnis et.', 'Omnis laudantium sapiente vel iusto repudiandae. Dicta corrupti officia debitis cumque dolorem.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(108, 1, 2, 'Quisquam eligendi et.', 'SLO-88bde185-5505-43fe-b7ac-d8c38cef6058', 'reading', 'Fall', 'February', 'Easy', 'Theritical', 'RRQ', 'Sunt qui consequuntur rerum quos amet alias quisquam et consequatur nisi aut corporis quisquam nobis.', 'Et atque odio qui amet doloremque debitis enim iusto.', 'assumenda', 'cum', 'labore', 'aut', 'C', 'At quis perferendis corrupti blanditiis.', 'Vel vero veniam molestiae ad inventore repellendus.', 'Unde illo natus dolores ad occaecati.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(109, 1, 2, 'Aspernatur ut ad vitae odit.', 'SLO-f57817e6-d6d3-40da-8827-d7d4dc6c19f7', 'lisning', 'Spring', 'February', 'Hard', 'Analysis', 'ERQ', 'Tempora excepturi pariatur autem sint soluta et iusto vitae.', 'Atque tenetur reiciendis id odio voluptas numquam minima doloribus.', 'aut', 'tenetur', 'earum', 'voluptatem', 'C', 'Odit veritatis porro quisquam quibusdam velit.', 'Est vitae molestias nisi qui repellendus.', 'Fuga voluptatem placeat qui facilis quasi. Asperiores eum in repudiandae possimus minima minus et.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(110, 1, 2, 'Placeat ea eveniet.', 'SLO-58c84a26-c53b-4f54-b9f8-9efac9f5c018', 'lisning', 'Fall', 'February', 'Hard', 'Theritical', 'MCQ', 'Magni possimus non eos et tempora unde numquam sequi rerum accusantium ea unde id ad.', 'Dolorem aut aut unde ducimus eligendi voluptatem ipsum.', 'cumque', 'nam', 'ut', 'et', 'A', 'In nisi placeat a neque quaerat.', 'Rerum molestiae quibusdam repellendus delectus deserunt aut.', 'Perferendis nostrum eum laborum iusto ut sed. Enim quam non quia.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(111, 1, 2, 'Eligendi ipsam iste.', 'SLO-99294a9e-a97c-49aa-99c0-ac2aa5b1b6a8', 'writing', 'Spring', 'February', 'Easy', 'Knowledge', 'ERQ', 'Aut voluptatibus nemo at aut consequuntur voluptatem asperiores molestiae sint enim omnis nam incidunt.', 'Quis expedita accusantium dolores similique rerum.', 'qui', 'dolores', 'porro', 'officiis', 'B', 'Enim asperiores minima quo voluptas minima impedit.', 'Esse et aliquam molestiae magnam dolores quidem.', 'Nam velit id sint est omnis quidem ab. Quam ex et explicabo ducimus ipsa cumque optio.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(112, 2, 1, 'Exercitationem nemo in omnis.', 'SLO-28dbae0d-28ed-42df-a685-f6913c84fc29', 'speaking', 'Fall', 'January', 'Medium', 'Knowledge', 'MCQ', 'Mollitia autem architecto rem consequatur minus aspernatur consequuntur quo sunt.', 'A corporis est consequatur tenetur a ducimus ratione error consequuntur.', 'architecto', 'mollitia', 'ipsa', 'excepturi', 'A', 'Dolorum molestiae possimus voluptas.', 'Impedit illum est adipisci quo accusantium.', 'Excepturi et voluptatibus ab velit esse labore consequatur.', 4, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(113, 2, 2, 'Sapiente nobis.', 'SLO-747af5ee-46e8-4b3b-93b2-aea0592f3150', 'writing', 'Fall', 'January', 'Hard', 'Practical', 'RRQ', 'Voluptas et soluta facilis laudantium fuga suscipit quidem maxime aliquid sed nulla.', 'Voluptas qui facilis itaque incidunt similique est voluptatibus corporis.', 'aut', 'dolor', 'temporibus', 'sint', 'D', 'Autem voluptatem est totam sit quia quibusdam.', 'Sunt cupiditate ut blanditiis est.', 'Inventore necessitatibus odio qui pariatur.', 4, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(114, 2, 2, 'Dicta et eius.', 'SLO-864b4eb6-1d8f-42ba-a9d4-a723f631c813', 'speaking', 'Spring', 'February', 'Hard', 'Theritical', 'RRQ', 'Inventore in molestiae velit dolorum qui doloremque.', 'Dolorem et quam porro sit enim.', 'praesentium', 'non', 'est', 'molestias', 'B', 'Harum maiores provident quo consequatur nam.', 'Dolorum aut blanditiis voluptate voluptatum dolor rerum.', 'Eum itaque quis temporibus deleniti neque. Sed eaque ut maiores animi totam in iste.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(115, 2, 1, 'Commodi quibusdam vitae ab.', 'SLO-bc4bd256-edc0-4a40-9cc8-2cd7978b3f23', 'speaking', 'Fall', 'February', 'Hard', 'Practical', 'MCQ', 'Consequatur ullam aliquam omnis accusantium suscipit aut et labore impedit quo quia quaerat.', 'Dolor non qui sint sit minima quis corrupti.', 'enim', 'est', 'itaque', 'quos', 'B', 'Possimus eaque et et tempora nobis placeat.', 'Qui enim voluptatem est eos sit voluptas.', 'Nemo aliquid aut officiis dolorem et. Ab cumque consequuntur optio asperiores quo.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(116, 2, 2, 'Consequatur sunt accusamus adipisci praesentium.', 'SLO-98852aac-fbd8-4f7b-be72-35e9d3d47cdf', 'writing', 'Spring', 'February', 'Easy', 'Analysis', 'RRQ', 'Vero perferendis est ut quibusdam explicabo qui maxime eaque voluptas architecto.', 'Aut voluptatem praesentium commodi quo nulla ea dignissimos voluptates beatae.', 'maiores', 'nemo', 'illum', 'commodi', 'C', 'Facere maiores ratione eaque.', 'Vel quia praesentium ipsa.', 'Quo nobis et laudantium iure.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(117, 1, 2, 'Dignissimos sed quia.', 'SLO-02cc09f3-74de-4848-a0d8-4eadf7e8e162', 'writing', 'Fall', 'February', 'Medium', 'Analysis', 'RRQ', 'Quibusdam inventore et voluptatem rerum aliquid est commodi qui.', 'Nemo sed est dicta ducimus cupiditate voluptatem omnis officiis.', 'iure', 'ipsa', 'enim', 'excepturi', 'A', 'Molestias aliquam fuga rerum sunt atque facere veritatis.', 'Atque consequuntur exercitationem harum.', 'Eos iusto voluptates natus quia.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(118, 2, 1, 'Est sapiente quam.', 'SLO-bb8985a9-a3b0-4e75-9ac3-a47de3969eca', 'speaking', 'Spring', 'February', 'Easy', 'Theritical', 'MCQ', 'Ullam quo dicta omnis at ducimus impedit ut.', 'Non voluptate perferendis esse sit vel sunt id officiis voluptas.', 'ipsam', 'accusantium', 'sed', 'molestias', 'A', 'Soluta maxime voluptatem similique maxime dolores.', 'Omnis eius nobis dolorem ratione consequatur ratione.', 'Veritatis est non eveniet ipsam itaque vero. Ullam quis dolore et totam ea quia autem.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(119, 1, 1, 'Nobis fugiat voluptatum praesentium.', 'SLO-fc042946-8b43-4067-a17c-2288747c47bf', 'lisning', 'Fall', 'February', 'Hard', 'Analysis', 'RRQ', 'Saepe sunt nihil quod eum placeat dolore et porro eveniet repellendus accusantium vitae.', 'Consequatur repellat occaecati fugiat optio velit.', 'voluptatem', 'architecto', 'quia', 'dolores', 'D', 'Et id velit ut et.', 'Eaque doloribus accusantium rerum quasi.', 'Sint quia molestiae dolorem pariatur porro.', 7, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(120, 1, 2, 'Dolor nisi.', 'SLO-da9dcee6-25fa-4ba9-a814-9d200c918e45', 'speaking', 'Fall', 'January', 'Medium', 'Theritical', 'MCQ', 'Qui velit ducimus possimus labore qui provident a velit.', 'Repudiandae et quibusdam minus quas qui qui est sed dolor aperiam.', 'quas', 'culpa', 'sunt', 'doloremque', 'A', 'Eligendi iste sed doloremque exercitationem magnam voluptates.', 'Id provident dolores quo nam perspiciatis.', 'Rerum aut quaerat rerum.', 10, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(121, 1, 2, 'Ad explicabo a sit.', 'SLO-bb66f3f0-6fd3-4c9e-bf37-a700e9768d6a', 'speaking', 'Spring', 'January', 'Medium', 'Analysis', 'ERQ', 'Laboriosam deserunt dignissimos asperiores et adipisci laudantium est quo.', 'Distinctio id sequi omnis praesentium distinctio quia aperiam.', 'velit', 'reiciendis', 'neque', 'animi', 'C', 'Voluptatem suscipit ut aut.', 'Consequuntur quis eligendi qui qui rerum.', 'Fugiat et reiciendis distinctio amet dignissimos.', 6, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(122, 1, 2, 'Cumque quaerat et in.', 'SLO-e44580d2-12fc-4da5-a58c-9e89bb0c5133', 'speaking', 'Spring', 'January', 'Easy', 'Knowledge', 'ERQ', 'Ullam optio aut voluptates enim delectus odio dolores aliquam voluptatibus omnis veritatis fuga aliquid.', 'Iure beatae similique recusandae est quo magni omnis qui iste est.', 'exercitationem', 'dicta', 'doloribus', 'aut', 'A', 'Laborum molestiae unde modi.', 'Perspiciatis maiores aperiam aut quidem dignissimos.', 'Quia sunt sequi qui sequi fugiat.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(123, 1, 2, 'Aut illum facere odit.', 'SLO-8e3c9563-b97a-40fb-a3c2-46fe4dac80f6', 'reading', 'Spring', 'February', 'Hard', 'Knowledge', 'RRQ', 'Aut reprehenderit dolorem aliquid maiores nam deleniti dolorem aut rerum quae.', 'Similique omnis nam laborum voluptates quisquam.', 'mollitia', 'fugiat', 'fugiat', 'et', 'C', 'Repellendus rerum atque perferendis commodi quam.', 'Beatae molestiae explicabo assumenda.', 'Minima voluptatem unde voluptatem suscipit quis voluptatem mollitia. Tenetur perspiciatis amet reprehenderit quia exercitationem explicabo reprehenderit.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(124, 2, 1, 'Quo laborum dicta ad.', 'SLO-1ec13d8d-3ff7-49b4-b525-3a55a6f9e08d', 'speaking', 'Spring', 'February', 'Medium', 'Practical', 'RRQ', 'Atque ducimus corrupti pariatur similique aut animi.', 'Rerum vero ut quaerat modi alias qui non quas.', 'ipsum', 'dolor', 'eius', 'et', 'B', 'Veniam aut accusamus dolorem.', 'Quae doloribus eos molestiae sit qui qui.', 'Nobis eum nulla rerum ducimus expedita eligendi. Saepe quis in quo suscipit aliquid odit voluptatem.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(125, 1, 2, 'Voluptas dolor doloremque molestiae.', 'SLO-58ea7880-4bf7-4137-9d2f-f024bdb66b31', 'reading', 'Fall', 'January', 'Easy', 'Analysis', 'ERQ', 'Nulla nisi molestiae dolorem dolores deleniti rerum qui explicabo et natus libero magni.', 'Eum sequi optio facilis tenetur aut aperiam est vel nobis.', 'quidem', 'enim', 'nihil', 'tempora', 'C', 'Necessitatibus et deleniti adipisci dolore.', 'Asperiores nisi ut ipsam totam quos hic.', 'Quas nisi corrupti nam eligendi sed porro.', 3, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(126, 1, 1, 'Consectetur molestias hic est.', 'SLO-571cb66b-5bb8-46ee-a2d5-4ac94bbac93e', 'writing', 'Fall', 'February', 'Easy', 'Analysis', 'ERQ', 'Voluptas necessitatibus soluta et recusandae provident est dolores.', 'Quas et eos dolores facilis ratione corporis.', 'laudantium', 'ab', 'perspiciatis', 'neque', 'D', 'Autem sed facilis corrupti minima autem ipsa.', 'Et et impedit dicta sint.', 'Aut ab ex asperiores laudantium sapiente.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(127, 1, 2, 'Possimus aut corrupti ea.', 'SLO-9e111136-cc9a-4e5b-b972-9546b9501248', 'lisning', 'Fall', 'February', 'Medium', 'Analysis', 'RRQ', 'Quia mollitia et alias amet iste et neque.', 'Est et qui voluptatem optio esse atque velit quas aut.', 'possimus', 'illum', 'voluptatem', 'pariatur', 'A', 'In quidem nihil dolorem excepturi.', 'Non vitae sequi doloribus.', 'Possimus est nam illo natus distinctio repellat sint.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(128, 2, 1, 'Et est autem.', 'SLO-3d6bf9d0-d512-41e3-ae13-a9d810550328', 'speaking', 'Fall', 'January', 'Easy', 'Practical', 'MCQ', 'Consequuntur sunt voluptate voluptatem fugiat ut minus et veritatis officia nulla.', 'Unde in autem recusandae aut nobis alias omnis in quas.', 'mollitia', 'voluptatem', 'ut', 'ut', 'A', 'Ut consequuntur error soluta porro at commodi.', 'Nihil ducimus ducimus et.', 'Cum earum dolor ipsa nostrum facere dolor. Recusandae delectus ut ipsam qui sunt temporibus ipsa.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(129, 1, 1, 'Non atque id ratione.', 'SLO-9fe73c3e-4330-47a1-aa62-31a4f94d2a44', 'speaking', 'Spring', 'January', 'Easy', 'Theritical', 'RRQ', 'Veniam aut odio quia doloremque qui ut iure aspernatur est eius asperiores.', 'Ut consequatur nostrum est et eveniet impedit sunt.', 'ex', 'voluptas', 'omnis', 'libero', 'A', 'Repudiandae est autem minima.', 'Sequi facilis dolorem esse reprehenderit dignissimos rerum.', 'Nostrum veritatis quae consequuntur aliquid dolorem similique.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(130, 2, 2, 'Ullam et quia.', 'SLO-bbd8e501-b681-4065-8710-86e381fb3cf1', 'writing', 'Fall', 'February', 'Medium', 'Knowledge', 'RRQ', 'Temporibus vel ullam assumenda et repellendus aliquid.', 'Quo harum nihil dolore cupiditate rem qui.', 'quo', 'hic', 'accusantium', 'inventore', 'D', 'Ratione eaque necessitatibus et maiores impedit quod.', 'Ipsum voluptas ducimus maiores mollitia eveniet architecto.', 'Unde eligendi dignissimos a non aut nihil et omnis. Qui et eveniet eius illum consequatur.', 9, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(131, 2, 1, 'Architecto voluptas et architecto.', 'SLO-24848120-bf23-4160-9c69-64ebd05b48b9', 'lisning', 'Fall', 'January', 'Medium', 'Theritical', 'ERQ', 'Quibusdam qui repellendus doloremque minima nostrum sint velit inventore sapiente voluptatibus sit.', 'Quam ipsum et omnis tempore non quaerat.', 'est', 'rem', 'mollitia', 'dolor', 'A', 'Deleniti quaerat nihil qui culpa qui atque.', 'Delectus quos facilis ut qui voluptas facilis.', 'Autem animi dolorem enim dolores. Eum quia aut sunt est.', 1, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(132, 2, 1, 'Delectus rem et ullam.', 'SLO-7855ef57-3047-4a4a-ac9f-edc7cbd4fc21', 'lisning', 'Spring', 'January', 'Hard', 'Knowledge', 'MCQ', 'Libero sed mollitia magni cumque consequatur ex cupiditate non quidem et sint autem earum.', 'Non molestiae expedita illo natus nemo cupiditate quisquam.', 'ea', 'delectus', 'minima', 'quis', 'B', 'Placeat optio eius dolores deleniti sunt.', 'Id quasi illum explicabo nesciunt vero.', 'Fugit a quis et eveniet optio. Non iusto reprehenderit et reiciendis suscipit consequatur mollitia.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(133, 2, 2, 'Eos iusto aut quia qui.', 'SLO-024b3f4d-be54-4e47-a14a-a769f6b7a86c', 'lisning', 'Spring', 'February', 'Hard', 'Analysis', 'ERQ', 'A quisquam alias eos rerum aut sit porro cumque id voluptatem qui qui qui.', 'Quia placeat in rerum eveniet ipsam fugit molestiae occaecati natus.', 'temporibus', 'modi', 'rerum', 'sunt', 'B', 'Consequatur molestias suscipit tenetur.', 'Ut qui sequi placeat.', 'Aliquam nisi deleniti corrupti minima praesentium sunt porro. Labore officiis nesciunt error dolores.', 5, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(134, 1, 1, 'Temporibus sint enim omnis.', 'SLO-ae9ce7f4-37fd-49f9-94d2-faa5e1939a42', 'lisning', 'Spring', 'January', 'Hard', 'Theritical', 'RRQ', 'Officiis maxime facilis fuga est possimus voluptate itaque.', 'Adipisci neque debitis ullam minus error.', 'asperiores', 'et', 'quia', 'quaerat', 'A', 'Non facere non vitae quasi modi.', 'Occaecati ipsam occaecati voluptate et dolor at.', 'Vitae assumenda vitae qui porro qui aut expedita.', 8, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(135, 1, 2, 'Et et ut.', 'SLO-31577623-6284-49c3-8614-54ecba4e3a61', 'writing', 'Spring', 'February', 'Easy', 'Analysis', 'MCQ', 'Accusantium quae architecto velit iusto sed labore odit et qui.', 'Labore veniam odit quia officia ad.', 'omnis', 'itaque', 'fuga', 'eius', 'D', 'Iusto dolor enim quidem dolor distinctio.', 'Aperiam est dolores dolores vitae dicta.', 'Commodi nihil aut ut perspiciatis in iste rerum.', 2, '2025-11-14 07:05:12', '2025-11-14 07:05:12'),
(136, 2, 2, 'Eum nihil pariatur ut.', 'SLO-3debc9a0-1091-4973-953e-1ba163e06725', 'speaking', 'Fall', 'January', 'Easy', 'Theritical', 'MCQ', 'Beatae magni maiores voluptas voluptatum impedit nostrum est eveniet est ut dolor sequi magnam.', 'Animi rem laboriosam doloremque natus voluptas quia modi voluptatem architecto ad.', 'nemo', 'at', 'placeat', 'esse', 'A', 'Aut doloribus corporis non ipsam aut.', 'Eius corporis voluptatem aut.', 'Sunt nam eaque quis quo.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(137, 2, 1, 'Qui repudiandae rerum consectetur perferendis.', 'SLO-ed38dd1f-d04e-4f03-8c64-ae5f19720197', 'speaking', 'Fall', 'February', 'Medium', 'Practical', 'MCQ', 'Molestiae dolorem et omnis reprehenderit sed enim quis.', 'Quibusdam error quis laudantium et autem maiores ea.', 'possimus', 'ut', 'et', 'vel', 'C', 'Officiis possimus nam ea unde eum reprehenderit.', 'Aspernatur temporibus dolores accusamus.', 'Veritatis perferendis qui optio pariatur vel placeat. Quaerat nihil similique ullam quas.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(138, 1, 1, 'Laboriosam laborum ea.', 'SLO-94829b51-f207-4273-b852-aa4685aecc13', 'lisning', 'Spring', 'February', 'Easy', 'Theritical', 'ERQ', 'Vel possimus provident aut molestias laboriosam labore molestiae illum veniam adipisci ut tempore.', 'Non ullam non quasi error vel dolor.', 'autem', 'quas', 'quaerat', 'nemo', 'A', 'Repudiandae eum quas ea.', 'Architecto omnis quidem molestiae sit quia architecto.', 'Incidunt accusantium est rerum libero. Architecto doloremque non rerum quasi.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(139, 2, 1, 'Vero natus vitae suscipit.', 'SLO-ce2bf890-cd73-4ccc-b614-2957a03b3178', 'speaking', 'Fall', 'January', 'Medium', 'Practical', 'ERQ', 'Incidunt quo nisi qui tenetur et qui velit est magni.', 'Ipsum perferendis corrupti eius illum possimus quia suscipit voluptatem adipisci.', 'eum', 'possimus', 'iusto', 'incidunt', 'A', 'Reprehenderit enim corrupti sed dolorem eligendi voluptates.', 'Veritatis dolorem omnis ipsum.', 'Corporis est distinctio possimus quibusdam dolor aut omnis.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(140, 1, 2, 'Quisquam cumque sit deserunt.', 'SLO-1f876f13-0cf8-4585-a6a3-ada97fe3aa8d', 'writing', 'Fall', 'January', 'Hard', 'Practical', 'RRQ', 'Quis maiores non magnam molestiae id porro ut cum.', 'Aut quas voluptas enim nulla iure accusantium in omnis.', 'non', 'voluptates', 'perferendis', 'qui', 'D', 'Soluta vel beatae perspiciatis rerum nihil.', 'Autem quam veniam quibusdam illum.', 'Quo eveniet quam qui sed. Eum praesentium necessitatibus corrupti reprehenderit velit eos alias.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(141, 1, 2, 'Ipsa libero eos a.', 'SLO-b15f8187-a833-4ce5-968d-65dea59dbd76', 'speaking', 'Spring', 'February', 'Easy', 'Analysis', 'MCQ', 'Harum vel qui et qui cupiditate velit magni voluptas dolores.', 'At commodi totam qui hic repellat nesciunt magnam commodi saepe sed.', 'aut', 'qui', 'cupiditate', 'consequatur', 'B', 'Nostrum iure autem praesentium.', 'Omnis non nostrum perspiciatis.', 'Consequatur atque et ut deleniti cum.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(142, 1, 2, 'Amet dolorum et.', 'SLO-957a9862-f55b-4839-9a03-e15a543f8e8d', 'lisning', 'Fall', 'January', 'Easy', 'Analysis', 'ERQ', 'Nisi itaque voluptates est suscipit distinctio facere deleniti nulla sed iusto est ipsum.', 'Aut sunt ab aut quo enim ipsa.', 'et', 'libero', 'sint', 'autem', 'A', 'Dolor qui nulla quia suscipit illum totam.', 'Aut placeat eius hic.', 'Distinctio aperiam et labore consequatur nam magni enim.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(143, 2, 2, 'Fugiat est doloribus.', 'SLO-fc5918c3-b515-40f5-a147-12507dd45a16', 'writing', 'Spring', 'January', 'Hard', 'Analysis', 'ERQ', 'Harum eveniet voluptate facilis tenetur iste atque.', 'Nisi ut eaque porro recusandae quibusdam placeat laborum rerum totam neque.', 'sint', 'enim', 'aut', 'ut', 'A', 'Sed adipisci dolores ratione sint quas.', 'Debitis deleniti architecto saepe.', 'Sequi numquam laboriosam quos culpa.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(144, 1, 1, 'Atque suscipit quas iure.', 'SLO-95ca9a5f-0bda-4249-95ad-b67295c8bf23', 'speaking', 'Spring', 'February', 'Hard', 'Practical', 'RRQ', 'Optio ex quia quos laudantium quia corporis id suscipit facere modi fugit ratione autem.', 'Harum quis iusto explicabo vitae tempora aut aut.', 'voluptatibus', 'omnis', 'aut', 'odit', 'D', 'Quo est voluptatum temporibus.', 'A qui ea soluta nobis ut aspernatur porro.', 'Excepturi quod est debitis.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(145, 1, 1, 'Magni voluptas omnis aut deleniti.', 'SLO-6e9966f6-1c79-42f7-8864-98faf15caadc', 'speaking', 'Fall', 'February', 'Hard', 'Practical', 'MCQ', 'Quas placeat veniam consequuntur magni reiciendis voluptas.', 'Iste error quis ab suscipit consequatur quisquam sed.', 'error', 'corporis', 'voluptatibus', 'quasi', 'C', 'Voluptatem doloribus consequatur laudantium est non possimus.', 'Autem nemo et quos.', 'Tempora a beatae omnis qui aperiam.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(146, 1, 1, 'Eum beatae consequatur a.', 'SLO-821b5b86-fdae-429d-8f4a-26d2e874b811', 'lisning', 'Spring', 'February', 'Medium', 'Knowledge', 'RRQ', 'Quis rem nulla autem vel tenetur magnam mollitia id corrupti reiciendis.', 'Molestias similique iusto asperiores est fugiat molestiae.', 'dolorum', 'autem', 'sit', 'perferendis', 'C', 'Tempore ex blanditiis quia eum deleniti eligendi ipsam.', 'Quisquam accusamus fugiat deleniti.', 'Atque dolores ea debitis est ut quam. Eaque non quis reprehenderit facilis labore.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(147, 2, 2, 'Et vel omnis quaerat.', 'SLO-f184f420-f58c-483f-9252-cefe1f71ea76', 'writing', 'Fall', 'January', 'Easy', 'Practical', 'ERQ', 'Voluptates porro sit impedit ex temporibus cumque ut aliquam ipsa.', 'Nesciunt ad impedit iusto dolorem repudiandae ipsam tenetur voluptate quisquam.', 'in', 'ea', 'qui', 'inventore', 'A', 'Nostrum minima qui nesciunt.', 'Ipsum ullam non placeat est rerum quaerat.', 'Voluptatem esse laudantium facilis sapiente nihil itaque illo. Dolor eos modi qui earum ex aut.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(148, 2, 1, 'Necessitatibus consequatur aspernatur.', 'SLO-5c96ce94-6cfa-4a47-a9d3-15fa7aca9403', 'speaking', 'Fall', 'January', 'Hard', 'Knowledge', 'RRQ', 'Dolore beatae occaecati ea sunt dolor quam.', 'Veritatis incidunt voluptatem dolorum voluptas omnis et reiciendis ut eum.', 'occaecati', 'facilis', 'voluptatum', 'rerum', 'D', 'Occaecati beatae tempora quis temporibus occaecati.', 'Voluptatem dolore voluptates omnis.', 'Nesciunt error quia earum magni. Veritatis laboriosam similique consequatur omnis.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(149, 1, 2, 'Autem officiis quae.', 'SLO-253e6a57-a10d-4210-bd58-3ce11fe851d4', 'writing', 'Fall', 'February', 'Easy', 'Knowledge', 'MCQ', 'Illum enim doloribus repudiandae occaecati aut et quidem.', 'Et eum rerum consequuntur deserunt autem et esse.', 'quibusdam', 'et', 'aut', 'soluta', 'D', 'Dolor cupiditate tempora omnis sed saepe rerum.', 'Quia unde similique esse.', 'Enim fuga et quis quod fuga dolorem ratione. Iusto sed qui quod sed.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(150, 2, 1, 'Et et qui eligendi labore.', 'SLO-aa3ea123-a16b-453a-9923-953b8712b688', 'writing', 'Fall', 'January', 'Medium', 'Knowledge', 'ERQ', 'Vero iste dolore asperiores sint sint quisquam ipsum eveniet temporibus dolorum qui et consequatur.', 'Officiis ut unde voluptatem eius unde nisi aut atque.', 'voluptates', 'autem', 'ut', 'dignissimos', 'D', 'Perspiciatis explicabo ut qui libero facilis.', 'Et et velit omnis fugiat magni.', 'Voluptas et repudiandae aliquam ipsa est illo vero nisi.', 4, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(151, 2, 2, 'Harum totam dolores.', 'SLO-a384165b-9bfa-4148-bc34-51f5e8c53aec', 'reading', 'Spring', 'January', 'Easy', 'Analysis', 'RRQ', 'Amet provident aut architecto et expedita officiis est in.', 'Reprehenderit eum praesentium vel et ut sed eos perspiciatis ab qui.', 'beatae', 'aut', 'illo', 'quis', 'B', 'Aut vel sunt accusantium ipsa.', 'Optio voluptates necessitatibus saepe debitis velit.', 'Voluptates in voluptas quam nihil impedit quod repellat. Optio placeat corrupti aut ab voluptas eveniet aspernatur.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(152, 2, 2, 'Similique id sapiente.', 'SLO-8a01405f-551f-4a1f-8817-0c1847067b9c', 'reading', 'Spring', 'February', 'Easy', 'Practical', 'ERQ', 'Labore et ab alias quia in consequatur dignissimos beatae excepturi et quod molestias.', 'Qui aut est et officiis doloremque.', 'aut', 'quo', 'sed', 'aspernatur', 'A', 'Officiis inventore est quae.', 'Autem dolor vel ullam.', 'Cum deleniti temporibus sed consectetur quam et eveniet. Impedit quibusdam accusamus et eos saepe.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(153, 2, 1, 'Sit voluptatem minus natus.', 'SLO-dc043276-b045-4732-9152-687b0f3e6b30', 'writing', 'Fall', 'January', 'Medium', 'Theritical', 'RRQ', 'Illum voluptatem distinctio et laboriosam repellat harum quas cupiditate fugiat atque ut quo tenetur.', 'Quia aliquid velit in sint est autem commodi natus sint.', 'sapiente', 'qui', 'perspiciatis', 'corporis', 'C', 'Dolore omnis vel vel rerum placeat.', 'Quam consequuntur sunt qui.', 'Voluptatem ut in deserunt et similique.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(154, 2, 2, 'Magni saepe est.', 'SLO-b68e3c6a-443b-44cc-8ceb-a966b3677ee6', 'reading', 'Spring', 'February', 'Medium', 'Knowledge', 'RRQ', 'Aut ut et deleniti suscipit est non at rerum sapiente.', 'Et suscipit quam quasi libero qui quibusdam ipsum.', 'mollitia', 'corporis', 'unde', 'eos', 'B', 'Dolor aut qui dolores unde velit.', 'Velit quo atque et.', 'Error voluptatibus eos fugit deleniti earum rerum et. Enim aut atque cum quo.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(155, 1, 2, 'Dolore necessitatibus ducimus soluta.', 'SLO-0c7a87bf-577f-4183-9fd1-3e49112d51db', 'speaking', 'Fall', 'January', 'Medium', 'Practical', 'ERQ', 'Impedit aut atque dolorem et est aliquam nemo hic cumque ratione et dicta nesciunt.', 'Consequatur itaque earum harum eveniet inventore harum architecto facilis.', 'qui', 'veritatis', 'officia', 'officia', 'C', 'Quis incidunt cum repudiandae fugiat in nulla.', 'Cumque reprehenderit eligendi nostrum placeat perferendis iusto.', 'Assumenda nulla est maiores optio rerum id deserunt. Eveniet et harum sed exercitationem enim dolore ex.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(156, 1, 2, 'Veritatis aut omnis laborum.', 'SLO-09c84505-00d2-4db6-851b-4a495b954e9b', 'lisning', 'Spring', 'January', 'Medium', 'Knowledge', 'RRQ', 'Quasi quia est et expedita sint voluptatibus eius excepturi saepe.', 'Est voluptas dolorem ab sapiente ex et et.', 'qui', 'et', 'consequatur', 'et', 'B', 'Qui voluptate quia quia.', 'Culpa eius quisquam tempore.', 'Veniam est soluta perspiciatis modi deleniti iste odit.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(157, 2, 1, 'Tempora fuga enim sit.', 'SLO-587a1607-cef7-46be-b1c5-bf6a3db91b60', 'lisning', 'Spring', 'February', 'Hard', 'Practical', 'ERQ', 'Ratione quia debitis voluptatem recusandae in sint aut quidem similique.', 'Ducimus aut itaque quis architecto quae ipsa.', 'assumenda', 'laboriosam', 'autem', 'et', 'C', 'Corporis in sapiente aspernatur tempore.', 'Hic amet necessitatibus repudiandae ad nesciunt.', 'Velit repellat dignissimos cumque rerum id. Officia odio harum velit est assumenda.', 6, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(158, 2, 2, 'Culpa provident sed.', 'SLO-3119ab2a-22c2-42d8-aad7-61da5479a71b', 'lisning', 'Fall', 'January', 'Easy', 'Practical', 'ERQ', 'Est vero quos doloribus enim aut et temporibus vitae quam.', 'Eum numquam dolore quo dolorem eum.', 'cumque', 'fuga', 'et', 'eum', 'D', 'Ut dolores quasi ipsam dolorem quo.', 'Laboriosam autem dolor ipsa odit.', 'Eum et asperiores numquam consequuntur dolorem et quidem.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(159, 1, 1, 'Atque architecto est.', 'SLO-9d688d4d-f9e2-4753-b053-3b9fb5ce80e0', 'writing', 'Fall', 'February', 'Easy', 'Theritical', 'MCQ', 'Saepe qui rerum unde cumque ut ex molestiae omnis neque accusamus quasi.', 'Corrupti omnis animi quia dolorum quo rerum saepe quis minus enim.', 'autem', 'dolorum', 'nesciunt', 'eius', 'C', 'Voluptas est voluptas reiciendis.', 'Tenetur praesentium et omnis autem aut.', 'Eum ab qui dolorum laboriosam sed.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(160, 1, 2, 'Explicabo vero blanditiis sed.', 'SLO-4034f641-ffb0-4b42-b59d-62a39f53e31b', 'reading', 'Fall', 'February', 'Easy', 'Theritical', 'MCQ', 'Voluptate iusto repellat nam eos unde et quia iure.', 'Eum sit dolor nihil qui repellendus.', 'qui', 'dolor', 'nemo', 'sit', 'A', 'Libero harum qui rerum et.', 'Culpa esse dolores nam minima et quos.', 'Omnis eum reprehenderit corrupti omnis fuga ex. Unde delectus nobis eligendi totam illum inventore ut natus.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(161, 2, 2, 'Nemo ut ut error.', 'SLO-fe9d9160-8739-4d3a-bd2d-4963e40c64bb', 'lisning', 'Spring', 'February', 'Hard', 'Knowledge', 'RRQ', 'Et est vel voluptas numquam voluptatum itaque eos sed eaque architecto eius.', 'Excepturi cupiditate omnis quia quia sapiente distinctio.', 'ex', 'cupiditate', 'odio', 'molestias', 'C', 'Dolorum veritatis officia eius.', 'Qui quibusdam sed cum omnis.', 'Vitae et labore aut est accusantium.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(162, 1, 1, 'Laborum ab provident cumque.', 'SLO-415ae209-02cb-498e-8a38-70766bccad76', 'lisning', 'Fall', 'February', 'Medium', 'Knowledge', 'MCQ', 'Tenetur corrupti qui dignissimos id et enim temporibus minus assumenda ea quo voluptatibus molestiae.', 'Doloribus corrupti ullam quae omnis totam voluptas vel rem.', 'temporibus', 'similique', 'tempore', 'modi', 'C', 'Consectetur tenetur tenetur explicabo eveniet dolorum corporis.', 'Id unde aut explicabo.', 'Porro vero magnam iure. Sed repellendus perspiciatis voluptas quisquam laudantium.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(163, 1, 1, 'Voluptate et optio.', 'SLO-e6301298-c526-44d3-9fe8-89a8271f248c', 'speaking', 'Fall', 'January', 'Medium', 'Analysis', 'MCQ', 'Praesentium perferendis facere velit rerum molestias quos quos delectus beatae sed.', 'Modi sint dolor consequatur quibusdam fuga repellendus ut excepturi.', 'similique', 'velit', 'sint', 'consequuntur', 'A', 'Velit inventore vel et.', 'Veniam ullam magnam esse alias.', 'Qui corrupti commodi quod est ad quasi. Voluptate sint labore occaecati saepe repudiandae eos culpa.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(164, 2, 1, 'Aut et ratione.', 'SLO-24a0a36e-1310-43b5-b198-cdd21a525fd5', 'writing', 'Fall', 'January', 'Hard', 'Theritical', 'MCQ', 'Dolorem aut ut eveniet omnis consequuntur hic dolores.', 'Et ut eos nemo quia quis quia.', 'quae', 'sunt', 'asperiores', 'illum', 'B', 'Sed veniam maxime sunt sed ut.', 'Eius recusandae tempora consequatur.', 'Explicabo veniam et ipsa atque. Consequatur consequatur sequi quis ea qui nesciunt.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(165, 2, 1, 'Earum repellendus aut.', 'SLO-9a896c09-ce59-4e77-a563-cd43e92647b2', 'lisning', 'Spring', 'February', 'Easy', 'Theritical', 'MCQ', 'Ut eum et soluta nihil id voluptas rem exercitationem eum libero.', 'Dolor sint aliquam est est quasi sit mollitia dolorem blanditiis blanditiis.', 'cumque', 'omnis', 'nemo', 'aperiam', 'B', 'Quidem sit maiores est.', 'Distinctio eos incidunt fugit soluta aut.', 'Quas aliquam voluptate ea dolorem ratione illo. Vel autem eius explicabo atque.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(166, 2, 2, 'Blanditiis voluptas quasi quaerat adipisci.', 'SLO-e77a4faf-12df-4ba9-9c33-8c7966f30090', 'speaking', 'Fall', 'January', 'Hard', 'Practical', 'RRQ', 'Aliquam qui veritatis maiores voluptas sit aspernatur ut et praesentium.', 'Quos voluptatem consequatur tempora in voluptas qui.', 'distinctio', 'error', 'aliquam', 'non', 'A', 'Sunt ullam culpa quasi ut.', 'Commodi est temporibus aut.', 'Quidem sapiente quia delectus quam quod odit eum eaque.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(167, 2, 2, 'Est dolor enim rerum.', 'SLO-534e8599-de0c-490e-b358-8e1186dcf880', 'speaking', 'Spring', 'January', 'Medium', 'Practical', 'RRQ', 'Voluptas est in ut est quidem eveniet aut est odit occaecati suscipit et quibusdam.', 'Veritatis ut voluptatem incidunt fuga.', 'libero', 'veniam', 'pariatur', 'minima', 'C', 'Dolore est aut voluptatem voluptate aut.', 'Ut ea quis deleniti consectetur.', 'Rerum quod quae culpa molestiae praesentium aperiam quam. Dolore non tempore vero nihil occaecati dolores molestiae.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(168, 1, 1, 'Ipsam ipsum voluptatem laudantium.', 'SLO-9a0e01a4-bd78-4ca2-9383-7f1e30cfaece', 'writing', 'Fall', 'February', 'Easy', 'Analysis', 'RRQ', 'Voluptate qui omnis porro fugiat perspiciatis sed quia nihil qui impedit neque.', 'Totam dolorem cupiditate iste et quod consectetur rerum.', 'qui', 'sunt', 'labore', 'blanditiis', 'A', 'Quisquam ea beatae voluptatum ipsa unde.', 'Eum aut numquam ipsa eum.', 'Occaecati omnis laborum consequatur dolorum eum.', 6, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(169, 1, 1, 'Laborum velit inventore temporibus.', 'SLO-7f5f7e68-c4b3-4550-9867-4bc54d54a95d', 'speaking', 'Spring', 'January', 'Easy', 'Analysis', 'MCQ', 'Pariatur qui facilis rerum velit est atque iusto ducimus.', 'Adipisci commodi quasi tempora quis modi quas maiores.', 'cum', 'doloribus', 'mollitia', 'nam', 'D', 'Et architecto est deserunt vero atque fuga.', 'Dolore in sed consequatur dolor.', 'Reprehenderit et rerum autem voluptatibus assumenda minima reprehenderit.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(170, 2, 1, 'Reprehenderit asperiores ipsam.', 'SLO-d1dda45b-4eda-4aed-b1b2-5257661d6c30', 'writing', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Aut corporis cum unde voluptatem culpa a et id.', 'Quos quam dolorem modi omnis aut.', 'reprehenderit', 'nisi', 'nihil', 'aut', 'C', 'Natus dolor perferendis optio ut iste.', 'Quasi voluptatem consequuntur fugit et odio.', 'Deserunt molestias nobis sed dolores tempore ut voluptatibus. Nihil aliquid dolores quidem voluptates eos.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(171, 1, 1, 'Perferendis optio minima libero.', 'SLO-cb04dd5c-0ac9-4e8c-9f84-beddae8331c6', 'writing', 'Spring', 'February', 'Medium', 'Theritical', 'RRQ', 'Rerum quod sequi aut eum soluta sit possimus molestiae repellat expedita.', 'Magnam vel incidunt rerum quisquam necessitatibus numquam.', 'quos', 'deserunt', 'sit', 'omnis', 'C', 'Enim commodi enim a suscipit et.', 'Ea quod nulla rem.', 'Voluptatem libero eos dolor nisi. Fugit eum optio velit et et sint.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(172, 1, 1, 'Culpa expedita dolorem.', 'SLO-9c411173-7e2f-4657-a3f6-65b8817e8cd9', 'writing', 'Spring', 'February', 'Hard', 'Knowledge', 'ERQ', 'Rem ducimus explicabo modi odio odit sit aperiam dolorum assumenda aut voluptatem eligendi.', 'Aspernatur et voluptas provident officiis fuga.', 'voluptas', 'rem', 'in', 'dolorem', 'D', 'Modi aut sed nemo quas.', 'Omnis dolores repudiandae quisquam magni.', 'Ut qui voluptate alias. Maiores ut qui odit et consequatur.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(173, 2, 2, 'Nobis dicta aut cumque.', 'SLO-3270bf00-8aed-4488-b38e-8a36eb01212c', 'writing', 'Fall', 'January', 'Hard', 'Analysis', 'ERQ', 'Nemo tempore esse tempora vero eum a fugit.', 'Illo aperiam in sed ipsam quibusdam dolores.', 'hic', 'et', 'impedit', 'eos', 'B', 'Reiciendis cumque dolor exercitationem assumenda qui.', 'Hic consequatur neque dolore laudantium.', 'Et ducimus labore non et perspiciatis.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(174, 2, 1, 'Qui dolore quae voluptatem.', 'SLO-31bdb616-e379-4357-bbc1-c72b66a4c069', 'reading', 'Fall', 'January', 'Hard', 'Practical', 'ERQ', 'Dolorem et veniam ipsum quam consequuntur quaerat iste ex vitae.', 'Nihil sit voluptatem qui voluptas fugiat dolores omnis maxime accusamus.', 'dolor', 'provident', 'architecto', 'voluptatem', 'C', 'Aut autem necessitatibus in ut eos.', 'Enim omnis ipsum suscipit similique.', 'Eveniet animi saepe sed eaque nesciunt maiores.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(175, 1, 1, 'Saepe adipisci sint in.', 'SLO-1036ffe4-d0e8-4894-9bed-1f82da208e73', 'speaking', 'Fall', 'February', 'Hard', 'Knowledge', 'ERQ', 'Vel expedita cumque porro hic quia fuga in qui.', 'Eaque perspiciatis quia et pariatur cupiditate odit sed et.', 'et', 'dolores', 'explicabo', 'quis', 'A', 'Amet dicta omnis autem qui delectus aspernatur.', 'Quia dicta ut tempore provident suscipit eius.', 'Aperiam quibusdam ut temporibus eos ad incidunt sed est.', 4, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(176, 2, 2, 'Temporibus et ad totam.', 'SLO-52275c6c-22ca-42a9-9741-a8b70dd08a79', 'writing', 'Spring', 'February', 'Easy', 'Practical', 'RRQ', 'Illum omnis debitis natus voluptas voluptatem dolorem sequi velit saepe.', 'Magnam est blanditiis similique expedita voluptatibus voluptatum.', 'aut', 'sed', 'aut', 'alias', 'B', 'Voluptatum nihil corrupti quis in.', 'Reprehenderit similique ad ad.', 'Laborum modi modi autem enim quibusdam odio fuga quisquam.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(177, 1, 2, 'Consequatur enim omnis.', 'SLO-eace368e-39f3-49da-9044-d1f222216435', 'writing', 'Fall', 'January', 'Medium', 'Knowledge', 'MCQ', 'Ut itaque ea suscipit laboriosam voluptatum non magnam in dolore eum eos voluptas.', 'Explicabo ducimus facere voluptatum sint omnis provident aliquid ducimus corporis.', 'aliquid', 'eum', 'in', 'ad', 'B', 'Impedit quibusdam iusto quis et dolorem.', 'Quisquam quia eveniet consectetur aliquam nihil fugit.', 'Suscipit nulla delectus neque maxime in est architecto. Non dolorum dicta deserunt aut quae quia ipsum.', 6, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(178, 2, 1, 'Aut in dicta enim.', 'SLO-39b92d59-23e4-49d6-bd80-67517b2ef2ce', 'speaking', 'Spring', 'February', 'Medium', 'Analysis', 'ERQ', 'In porro culpa enim voluptas esse tempore sint non.', 'Reiciendis corporis cupiditate occaecati autem praesentium sequi expedita qui eos quae.', 'rerum', 'aut', 'ratione', 'amet', 'B', 'Voluptatem consequatur quas dolores sed voluptatem.', 'Quod at minima deleniti laudantium perspiciatis.', 'Quas eos laudantium nisi ut.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(179, 2, 2, 'Provident eveniet voluptatem.', 'SLO-03f59a46-146c-41e2-8430-632efbbd626c', 'writing', 'Fall', 'January', 'Medium', 'Practical', 'MCQ', 'Dolorem placeat iure eos maiores consequatur rerum mollitia.', 'Perspiciatis in maiores qui et sunt aliquid officia aut laudantium corrupti.', 'possimus', 'minima', 'omnis', 'atque', 'B', 'Rerum assumenda et esse numquam odit voluptas.', 'Voluptas deserunt sequi dolor cupiditate temporibus.', 'Exercitationem inventore qui delectus beatae dolores. Eligendi facilis ea necessitatibus beatae modi ad nostrum natus.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(180, 1, 2, 'Hic molestias sed qui soluta.', 'SLO-ee46541e-3a0a-42fb-87b8-073ea8ff6135', 'speaking', 'Spring', 'February', 'Hard', 'Theritical', 'MCQ', 'Numquam soluta voluptatem consequatur qui omnis explicabo provident sit dolorum totam et facilis.', 'Voluptate accusantium consequatur quo fugit autem tenetur veniam dolorem deserunt.', 'maxime', 'vel', 'alias', 'rerum', 'D', 'Laboriosam sapiente qui non exercitationem ullam.', 'Dolore et rerum id.', 'Laudantium quidem facilis qui eos. Tempora dicta recusandae ea modi sed quis quo.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(181, 2, 1, 'Ut omnis dolor repellendus.', 'SLO-198122b9-2b57-4f5f-aaeb-c0eda368c929', 'speaking', 'Spring', 'January', 'Hard', 'Knowledge', 'MCQ', 'Eius reiciendis incidunt ut ab deserunt blanditiis voluptatem quam omnis.', 'Necessitatibus modi veritatis reprehenderit dolores consequatur aut mollitia nulla.', 'deserunt', 'repellendus', 'minus', 'nesciunt', 'D', 'Nesciunt aspernatur sit in in sit.', 'Maxime molestiae commodi velit odio laudantium corporis.', 'Occaecati et sint ratione. Voluptatem consequuntur dolore vitae consequatur eius consectetur aut.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(182, 2, 1, 'Recusandae aut aut illum.', 'SLO-bfd5a88b-6cfd-43d1-ab3f-e904115047eb', 'speaking', 'Spring', 'February', 'Easy', 'Knowledge', 'ERQ', 'Nemo recusandae voluptas voluptas ullam aut est.', 'Deserunt minima hic qui vel eos eligendi.', 'non', 'illo', 'asperiores', 'inventore', 'C', 'Sit non architecto voluptas.', 'Eum fugiat sequi nobis et.', 'Architecto nihil ut molestiae.', 4, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(183, 2, 1, 'Aut explicabo dolore ex.', 'SLO-9ea8d6d3-6a03-499f-8469-288a7bdb9900', 'writing', 'Fall', 'January', 'Medium', 'Practical', 'MCQ', 'Amet nam molestias quos reiciendis voluptates voluptatem iste natus possimus dolorum ipsum atque.', 'Ipsum consequatur rerum consequatur aspernatur et culpa necessitatibus.', 'voluptatem', 'tempore', 'repellendus', 'officia', 'D', 'Provident repellendus officiis qui sed.', 'Aliquam dolorem fugiat excepturi dicta voluptatem possimus.', 'Sed qui unde sunt laboriosam eos.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(184, 1, 2, 'Fugiat et at.', 'SLO-2fb7a8d0-6bc7-43c5-9770-37f9ca113576', 'writing', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Eos unde et vero cupiditate blanditiis inventore dignissimos iusto voluptatum hic modi est quia.', 'Consequatur autem impedit est nulla inventore ut id quia aliquid.', 'quia', 'ipsam', 'qui', 'facilis', 'A', 'Et dignissimos et tempore.', 'Vitae odit iusto saepe.', 'Aut nisi voluptas eius tempora est velit natus.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(185, 1, 1, 'Modi voluptates nobis.', 'SLO-a9567a4c-5f80-4ea6-af08-94ade0fd39f8', 'speaking', 'Spring', 'February', 'Hard', 'Analysis', 'MCQ', 'Omnis nihil accusantium aliquid delectus incidunt vero sint et reprehenderit ut vero earum.', 'Hic cupiditate quia vitae et beatae cumque.', 'odit', 'non', 'recusandae', 'dolores', 'B', 'Vel repellendus voluptatibus fugit.', 'Veniam nesciunt sint iusto ad.', 'Sint ut eveniet ex aut veniam officiis et.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(186, 2, 2, 'Esse deleniti.', 'SLO-2a0fec44-9d51-4075-8db1-232036f85b3f', 'speaking', 'Fall', 'January', 'Easy', 'Practical', 'MCQ', 'Impedit adipisci neque est perspiciatis cumque perspiciatis repudiandae est soluta amet quod totam.', 'Nihil commodi commodi iste tenetur omnis quia beatae fuga cum.', 'voluptatem', 'tempora', 'a', 'iusto', 'B', 'Velit eligendi accusantium voluptatem.', 'Ad ipsa aut aut est consequatur assumenda.', 'Reiciendis eveniet molestiae iste vel culpa. Itaque nemo suscipit quod voluptatem.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(187, 2, 1, 'Aut mollitia et.', 'SLO-bbea3eb6-73d8-497c-8553-b553cc76a42b', 'writing', 'Fall', 'January', 'Hard', 'Knowledge', 'MCQ', 'Dicta amet tenetur eum earum et ipsum.', 'Aut fugiat natus magni quia quia est suscipit dolorum.', 'facere', 'et', 'odit', 'dolor', 'A', 'Cupiditate sit omnis enim magnam quas rerum.', 'Nostrum quaerat dignissimos et omnis repellendus.', 'Et pariatur distinctio adipisci consectetur asperiores illo. Cumque magni id aut est sint distinctio odit.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13');
INSERT INTO `item_banks` (`id`, `subject_id`, `grade_id`, `slo`, `slo_no`, `skill`, `semester`, `month`, `difficulty`, `category`, `item_type`, `item_description`, `stimulus`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `possible_answers`, `marking_hints`, `rubric`, `total_marks`, `created_at`, `updated_at`) VALUES
(188, 2, 1, 'Quo distinctio pariatur suscipit.', 'SLO-dce936fb-4681-4447-bb70-d7a69748f5ea', 'lisning', 'Fall', 'January', 'Easy', 'Practical', 'ERQ', 'Tempora incidunt consequuntur pariatur saepe rem ut quia ex eos assumenda eos.', 'Dolorem laborum consequatur dolorem eaque vel sapiente.', 'id', 'est', 'molestiae', 'iure', 'D', 'Ducimus fuga qui amet molestiae eum.', 'Enim eum exercitationem voluptas laborum harum.', 'Quos natus voluptatem nostrum eum minima qui officia. Eaque vel qui debitis itaque delectus.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(189, 2, 2, 'Est quia aut.', 'SLO-64f360e3-17d2-4674-be61-2be3a97c68de', 'speaking', 'Fall', 'February', 'Medium', 'Theritical', 'MCQ', 'Excepturi accusamus quo aut nostrum sequi consequatur occaecati.', 'Sit cumque ut temporibus sit ut nisi corporis qui repudiandae.', 'dolor', 'cumque', 'explicabo', 'ratione', 'B', 'Dolores cum ducimus enim maxime quisquam.', 'Sed saepe non nostrum ut enim accusantium.', 'Quod accusamus non omnis et earum qui ipsum.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(190, 1, 1, 'Odio aliquid tempora debitis.', 'SLO-20ddbac7-5221-403b-8415-2241967e74b9', 'reading', 'Spring', 'February', 'Medium', 'Theritical', 'MCQ', 'Tempore qui ea deserunt deleniti placeat et assumenda vel eius veniam.', 'Dolor et omnis sit sed ipsum similique architecto odio.', 'officiis', 'perspiciatis', 'omnis', 'qui', 'A', 'Expedita sunt ipsam quos.', 'Perspiciatis unde voluptatem mollitia quo.', 'Iure pariatur quasi rerum placeat vitae. Culpa qui qui dolore quod exercitationem molestiae distinctio.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(191, 1, 1, 'Dolor quia placeat.', 'SLO-cce4d3e6-1ffd-4d5b-a0ce-a286e7919d5e', 'writing', 'Fall', 'January', 'Hard', 'Practical', 'ERQ', 'Voluptatem et harum eius quam recusandae quisquam sapiente id non quae temporibus.', 'Ad officiis dolores sint voluptas qui facere alias rerum.', 'inventore', 'consequuntur', 'animi', 'eaque', 'B', 'Est fugiat distinctio impedit maxime repellat repellendus.', 'Nihil rerum et neque eum rerum aliquam.', 'Reprehenderit impedit sit quo cumque. Praesentium debitis modi et sint quaerat.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(192, 2, 2, 'Consequatur veniam itaque.', 'SLO-842db063-9c82-4eff-a131-01d518969442', 'lisning', 'Fall', 'January', 'Hard', 'Analysis', 'ERQ', 'Molestiae a eos doloremque iste exercitationem voluptate qui quia eos doloribus.', 'Facere quo sapiente a et minus.', 'ea', 'voluptas', 'nulla', 'tenetur', 'A', 'Iste magnam facere ullam.', 'Et qui quod a doloribus ea nulla.', 'Beatae qui commodi quia ea molestiae ratione quisquam.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(193, 1, 1, 'Iure aut saepe.', 'SLO-87280265-af36-4901-82dc-43a7afcdf9d7', 'writing', 'Fall', 'February', 'Medium', 'Analysis', 'RRQ', 'Et distinctio adipisci commodi voluptatem saepe voluptate repellendus id.', 'Quo ab nulla quia modi quia accusamus sunt doloribus est.', 'ipsum', 'eum', 'enim', 'quia', 'A', 'Tempore optio rerum non vel in accusamus.', 'Ut distinctio et illo voluptates.', 'Placeat assumenda ipsa iste. Laboriosam alias quasi excepturi consequatur exercitationem laborum.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(194, 1, 1, 'Blanditiis veniam illum.', 'SLO-5f914ba9-cf33-413f-ade0-7b1c6f926b0f', 'speaking', 'Fall', 'January', 'Hard', 'Analysis', 'RRQ', 'Laborum sunt est quae et inventore distinctio officiis eveniet maxime sunt et.', 'Ut quos ipsa eius harum aut labore.', 'fugiat', 'enim', 'excepturi', 'vero', 'B', 'Repellendus aut fugiat debitis.', 'Sit et sit minima sint adipisci quod.', 'Sunt illum qui inventore quod. Quo quam nisi vel voluptatem.', 3, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(195, 2, 1, 'Accusantium dolores deleniti deserunt.', 'SLO-0555b343-fad7-4296-ac96-ae6a27a59691', 'lisning', 'Spring', 'February', 'Easy', 'Theritical', 'MCQ', 'Repellat ut est numquam excepturi aut et autem.', 'Ut vel laudantium aliquam quam minus nisi ut numquam ratione.', 'velit', 'suscipit', 'molestias', 'velit', 'A', 'Qui maxime optio vel dolor est sequi.', 'Dolorum pariatur voluptatem deserunt soluta unde.', 'Reprehenderit vel aspernatur perspiciatis et. Est iure asperiores quo explicabo.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(196, 1, 2, 'Nostrum ut nam aliquam et.', 'SLO-e8b67335-4804-4834-aff9-ce3372b6176a', 'reading', 'Fall', 'January', 'Hard', 'Analysis', 'ERQ', 'Atque qui enim veniam autem reprehenderit harum qui perspiciatis blanditiis.', 'Sed qui asperiores qui sint non consequatur fugiat eligendi.', 'earum', 'recusandae', 'molestiae', 'optio', 'D', 'Ex ipsum incidunt veritatis nihil illum.', 'Eum molestias voluptatem quos repudiandae quo.', 'Ut dolorum aut provident id. Aut labore maxime dignissimos aut voluptatibus quam eos molestias.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(197, 2, 1, 'Eum corporis laborum maxime.', 'SLO-86ec08ec-3484-49f4-92ae-02b5f6627a66', 'writing', 'Fall', 'January', 'Medium', 'Theritical', 'MCQ', 'Doloribus a aut dolores sapiente perferendis quidem reiciendis dolor est beatae rerum consequuntur autem.', 'Similique totam totam dolor voluptatem dicta.', 'quia', 'commodi', 'quibusdam', 'voluptate', 'D', 'Saepe quasi qui quam nesciunt sint praesentium.', 'Inventore perferendis enim voluptas quisquam eveniet corporis.', 'Quasi placeat quo ullam nulla repellendus omnis.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(198, 1, 1, 'Rem error ratione.', 'SLO-20abf0e6-a8ec-4272-838d-db9138e0f396', 'reading', 'Fall', 'February', 'Hard', 'Analysis', 'RRQ', 'Provident quos totam odio quis fuga velit dolores eum.', 'Esse magnam error minus aliquam numquam in sit inventore reiciendis vero.', 'quidem', 'non', 'rerum', 'est', 'C', 'Quasi explicabo ea nemo unde autem autem.', 'Iure nemo eius quo neque non ad.', 'Tempore nulla ut voluptas. Non sunt et est excepturi.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(199, 2, 1, 'Omnis aliquam autem.', 'SLO-9f8e0452-ef9d-4de9-9e6f-74cf6c2d188b', 'reading', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Pariatur accusantium et vitae provident qui velit eveniet.', 'Impedit aut et et ut qui earum.', 'sint', 'magnam', 'natus', 'et', 'A', 'Amet quaerat placeat ex optio qui.', 'Eos asperiores eveniet magni distinctio.', 'Enim omnis consequuntur nihil voluptatem iste officia qui.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(200, 1, 1, 'Rerum repellendus atque.', 'SLO-22901a7f-73d5-49e0-a7e3-9e5c6b613e0c', 'reading', 'Fall', 'January', 'Easy', 'Knowledge', 'MCQ', 'Hic dignissimos commodi vel voluptas dicta natus omnis officia accusamus nobis deserunt.', 'Aut quia natus quo est quis ut.', 'suscipit', 'inventore', 'delectus', 'voluptas', 'B', 'Ut perferendis praesentium et qui quisquam.', 'Placeat iste ipsum deserunt repudiandae ad.', 'Consequatur veritatis laborum ut aperiam ut occaecati corrupti. Ut accusantium quasi enim quia rerum.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(201, 1, 1, 'Quis velit non.', 'SLO-8e504d2f-1082-49ec-bba4-c7077b6c8242', 'speaking', 'Fall', 'February', 'Medium', 'Analysis', 'RRQ', 'Sed facere cumque ratione fugit id id voluptatibus.', 'Unde doloremque nam necessitatibus perferendis voluptas doloribus at.', 'incidunt', 'consequuntur', 'ducimus', 'cumque', 'B', 'Et sit beatae impedit.', 'Consequatur blanditiis nobis eaque sed quia.', 'Veritatis omnis libero distinctio impedit assumenda accusamus sed.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(202, 1, 2, 'Facilis ut aut aut ratione.', 'SLO-0fdbe5b0-e7da-4cd8-ae44-7d88c1dea705', 'writing', 'Fall', 'February', 'Medium', 'Knowledge', 'MCQ', 'Ipsam quos praesentium doloremque ut vitae rerum repudiandae eius velit nam et vero id.', 'Rerum maxime voluptatem similique sequi id.', 'corrupti', 'corrupti', 'recusandae', 'aut', 'C', 'Cumque natus est mollitia fugiat voluptatem inventore.', 'Qui sit excepturi qui inventore tempore.', 'Suscipit neque tenetur non nisi deleniti vitae nisi.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(203, 1, 1, 'Consequatur sunt sint.', 'SLO-53bf76a1-63a9-4dbe-b6c8-538872340552', 'speaking', 'Fall', 'February', 'Easy', 'Knowledge', 'RRQ', 'Quos repellendus reiciendis corporis quo iure adipisci sit est blanditiis quia est.', 'Ipsum assumenda sunt molestiae quasi assumenda velit minus nulla.', 'consequatur', 'voluptatum', 'reiciendis', 'ea', 'A', 'Velit ex reiciendis quisquam culpa.', 'Dolor nam voluptas consectetur.', 'Voluptatem ut quia quia accusantium quis voluptatem. Aspernatur ea amet consectetur qui.', 6, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(204, 2, 1, 'Qui quo et officia.', 'SLO-6e75eb80-117a-4439-ac29-337d90cc0db6', 'lisning', 'Spring', 'January', 'Hard', 'Practical', 'MCQ', 'Velit asperiores nam ipsum minima nulla excepturi ab porro.', 'Rerum est et corporis quia non autem eius sint.', 'consequatur', 'non', 'nostrum', 'consectetur', 'D', 'Autem dolores autem nisi alias ut.', 'Officia sapiente commodi non cupiditate quia.', 'Veniam earum non quaerat.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(205, 2, 1, 'Doloremque fugiat voluptatem qui optio.', 'SLO-fa6565fa-acab-46f0-a9ea-d845190c0845', 'speaking', 'Fall', 'January', 'Medium', 'Knowledge', 'MCQ', 'Sed qui sunt quidem animi ut et rerum id expedita nesciunt consequatur sit ratione.', 'Odit voluptates quam quod eligendi id ex officia vel accusamus.', 'harum', 'tenetur', 'alias', 'quia', 'D', 'Aperiam fugiat occaecati autem et in.', 'Est itaque possimus delectus.', 'Assumenda inventore quis natus modi.', 4, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(206, 1, 1, 'Ut sunt et qui sed.', 'SLO-49e6a93a-4f37-4dd6-a23a-589cd495d0b0', 'writing', 'Fall', 'January', 'Easy', 'Analysis', 'RRQ', 'Corrupti beatae debitis unde ut qui culpa illum quia mollitia aut aliquid dolores ut.', 'Porro dicta in totam dolores explicabo.', 'voluptatum', 'ullam', 'itaque', 'aliquid', 'B', 'Fugit aspernatur at temporibus voluptatem omnis nulla.', 'Quam recusandae laudantium velit.', 'Repellendus cum qui magni cum velit.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(207, 1, 2, 'Sed est neque quia.', 'SLO-2839eef0-bc5a-4058-93d7-d67e9513a3ad', 'reading', 'Fall', 'January', 'Hard', 'Analysis', 'MCQ', 'Qui quo ad aliquid voluptatem ratione quia.', 'Voluptas totam illum mollitia magni atque non neque architecto.', 'sit', 'qui', 'necessitatibus', 'placeat', 'D', 'Voluptatem blanditiis repellendus nulla.', 'Nesciunt necessitatibus harum dolorem maiores voluptas quia.', 'Numquam nam quae velit et magnam sint cumque.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(208, 2, 1, 'Aliquam aliquam est aperiam.', 'SLO-6a9e44b2-c68f-4e18-8752-dfdd3a72c921', 'speaking', 'Spring', 'January', 'Easy', 'Analysis', 'RRQ', 'Et illum omnis omnis dolorem consectetur non.', 'Dolores laboriosam sit sed iste id eum.', 'eius', 'ut', 'voluptatem', 'amet', 'A', 'Veniam aliquam et velit.', 'Sunt modi eum molestiae rem nihil.', 'Earum est cum nemo aut quis architecto alias sit.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(209, 2, 2, 'Quos atque libero hic nesciunt.', 'SLO-63ab2dc4-af1e-447d-b788-0c7bdabf1066', 'reading', 'Fall', 'January', 'Easy', 'Theritical', 'RRQ', 'Iure sed eveniet similique recusandae dignissimos et voluptatem qui quidem.', 'Et est velit id vitae nisi et dolorum.', 'id', 'voluptas', 'expedita', 'cum', 'C', 'Quaerat impedit velit sit sunt aliquam ducimus.', 'Ea porro inventore ut ipsum dolore eligendi.', 'Ut aliquid dolorum rerum. Nulla sint eos eum dolor quo nostrum magnam.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(210, 2, 1, 'Numquam autem vitae.', 'SLO-015910cc-b294-4730-9629-dcb18d992411', 'speaking', 'Fall', 'January', 'Easy', 'Analysis', 'ERQ', 'Officia placeat velit iusto at architecto dolorem et vel nemo facilis ut fugiat vitae.', 'Quia facilis deserunt est porro reprehenderit similique veritatis eaque.', 'id', 'quis', 'omnis', 'sint', 'B', 'Voluptatem optio eos quo natus libero doloremque.', 'Ea quaerat ipsa nobis earum debitis.', 'Error omnis ut officiis in aut voluptas. Ut et unde voluptatum et expedita autem qui.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(211, 1, 2, 'Quis minus molestias.', 'SLO-ce48c7eb-853f-48cc-9e19-5d53b852f302', 'writing', 'Fall', 'January', 'Hard', 'Knowledge', 'MCQ', 'Reprehenderit ad omnis tenetur eligendi soluta sit aut et.', 'Commodi odio dolorem aut sequi omnis ullam.', 'voluptatem', 'ex', 'nulla', 'possimus', 'B', 'Illo eligendi nihil et.', 'Amet doloremque nulla fugit qui.', 'Saepe excepturi cum vel aut laboriosam.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(212, 1, 1, 'Perspiciatis dolor perspiciatis.', 'SLO-358ef67d-ec53-466c-abea-99bcaccd2e2b', 'writing', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Nihil placeat qui in temporibus explicabo ad doloremque eum est.', 'Sit similique quae omnis reiciendis et ut voluptatem nobis dolorum.', 'dolor', 'accusantium', 'et', 'dignissimos', 'C', 'Non corporis sequi corporis nulla sunt hic omnis.', 'Quia alias quia rem dicta corporis.', 'Delectus non perferendis voluptas dolorem porro id et qui. Suscipit sint asperiores quis voluptates.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(213, 1, 2, 'Et qui id.', 'SLO-c1cc4418-c047-4bc3-950c-a948b3f8be97', 'writing', 'Spring', 'January', 'Medium', 'Analysis', 'MCQ', 'Assumenda esse maxime sint quaerat dolore ipsa fuga rerum occaecati modi doloremque enim reprehenderit.', 'Qui corporis laboriosam id at recusandae voluptatem.', 'aut', 'explicabo', 'quia', 'dolor', 'D', 'Assumenda hic optio qui possimus.', 'Vero nihil recusandae quis omnis sunt.', 'Enim nobis nesciunt quam distinctio quod recusandae pariatur. Est aut aspernatur reprehenderit dolorem dignissimos quidem.', 4, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(214, 2, 2, 'Qui dolorum repellat qui.', 'SLO-ff0ac6bb-2972-4f01-833f-4cbdb1642e9a', 'lisning', 'Spring', 'January', 'Medium', 'Practical', 'ERQ', 'Est voluptas quam omnis numquam quidem quia modi nemo tenetur molestias exercitationem voluptas iure.', 'Animi doloribus ratione consequatur repellat nostrum unde ea et aspernatur ut.', 'occaecati', 'vel', 'a', 'et', 'A', 'Natus sit ad occaecati porro ad.', 'Quis eligendi ipsa nihil omnis sit.', 'Sed eos sit unde.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(215, 2, 1, 'Cum facilis rerum.', 'SLO-4f8ca510-7f75-4123-a81e-b004389d57e2', 'reading', 'Spring', 'February', 'Easy', 'Theritical', 'ERQ', 'Officia qui et fuga possimus assumenda facere illum dolorum dolore veniam dolorum asperiores.', 'Autem sed atque explicabo architecto et qui voluptas laudantium laboriosam.', 'et', 'rerum', 'rerum', 'qui', 'A', 'Autem qui qui unde.', 'Explicabo iusto ut voluptas similique sint fugit.', 'Suscipit aut est nihil. Molestias et libero ab error et atque.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(216, 1, 2, 'Laborum ipsum delectus.', 'SLO-146390d2-684d-4350-b41a-36ea6a59c5be', 'reading', 'Fall', 'January', 'Easy', 'Knowledge', 'RRQ', 'Similique maxime beatae est facere labore ea quod sit neque.', 'Deserunt assumenda ex distinctio deserunt voluptatem esse minima voluptatum dolores officia.', 'enim', 'aut', 'consequatur', 'explicabo', 'D', 'Eos dolor ea est incidunt labore.', 'Ut est corrupti porro voluptatibus assumenda.', 'Sapiente voluptatem modi omnis adipisci animi aliquam exercitationem.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(217, 2, 2, 'Similique ex vero.', 'SLO-b13c577a-ba37-4018-834c-f6280fc2975b', 'reading', 'Fall', 'January', 'Hard', 'Theritical', 'ERQ', 'Quia et corrupti ducimus error temporibus in voluptatem eum.', 'Nisi magni quia veniam qui eaque.', 'voluptas', 'sunt', 'provident', 'atque', 'B', 'Et assumenda aut quo qui.', 'Eligendi quos voluptatibus eius error voluptas.', 'Eaque temporibus perferendis iure aut eaque. Quas iste aut est officia natus non ex.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(218, 2, 2, 'Eaque exercitationem aspernatur.', 'SLO-e3f35277-f373-492e-8433-dfafb55309f5', 'reading', 'Fall', 'January', 'Easy', 'Analysis', 'MCQ', 'Ipsa deleniti quod possimus eaque sed rerum veniam sint possimus eos sed.', 'Expedita quod sunt voluptas fuga et dolore minima quaerat minima.', 'qui', 'pariatur', 'voluptas', 'iusto', 'B', 'Qui aut dolores eos.', 'Consequatur ut ab commodi cumque aut asperiores.', 'Explicabo qui mollitia dolorum explicabo saepe qui. Sed aut pariatur incidunt sapiente.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(219, 2, 1, 'Ullam minus dicta.', 'SLO-2eaa81c2-2b25-4864-b2eb-e865fd6cfe03', 'lisning', 'Spring', 'January', 'Medium', 'Theritical', 'MCQ', 'Possimus vero molestiae molestiae aut pariatur expedita.', 'Ducimus ut qui ut voluptatibus aut aut quam.', 'ex', 'explicabo', 'et', 'natus', 'B', 'Similique dolores odio mollitia tempora.', 'Aut reprehenderit et autem nemo ducimus id.', 'Modi ullam qui autem odit illum minima ipsum. Reprehenderit voluptas voluptas molestiae voluptatibus veritatis quod.', 2, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(220, 1, 2, 'Doloribus aut nemo.', 'SLO-eb8770c8-3b15-4086-bb79-48d9dd92735d', 'reading', 'Spring', 'January', 'Easy', 'Knowledge', 'RRQ', 'Quaerat velit quo aut voluptatem earum nemo voluptate optio doloremque ut dolor consectetur distinctio suscipit.', 'Quam odit voluptas deleniti et eos minima eius sit.', 'est', 'reprehenderit', 'error', 'eos', 'D', 'Dolorum voluptatum iusto nihil.', 'Aliquid qui sed numquam ipsum.', 'Et in debitis quibusdam et. Voluptas inventore ullam soluta reprehenderit.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(221, 2, 2, 'Nihil est quis.', 'SLO-61b45afc-0dc3-434c-9b15-4a9c4e6e00e1', 'speaking', 'Spring', 'January', 'Hard', 'Analysis', 'RRQ', 'Corporis illo non eum sit fugiat sed id perferendis.', 'Et maiores vel dolore enim inventore vel expedita non alias maiores.', 'dolore', 'aut', 'officiis', 'quo', 'A', 'Ut accusantium dolor corrupti unde.', 'Commodi voluptatem expedita velit dolores ducimus eum.', 'Incidunt repudiandae voluptas ea dolor rerum sint est. Tempora itaque mollitia iusto sed.', 4, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(222, 2, 2, 'Voluptas molestiae in esse.', 'SLO-9029aacb-8092-44a3-b1ae-519c7ef15392', 'writing', 'Fall', 'February', 'Hard', 'Theritical', 'ERQ', 'Aut velit laboriosam rerum voluptate sint facilis commodi aperiam aut rerum doloribus atque at.', 'Non facere praesentium et velit voluptas culpa aut et non.', 'asperiores', 'molestias', 'consequatur', 'dolorem', 'D', 'Qui dolores et voluptas.', 'Non non voluptatem mollitia voluptatem aperiam.', 'Enim natus est reiciendis illo laboriosam aut.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(223, 2, 1, 'Sapiente dolorum veniam dolorem.', 'SLO-56d23408-1002-4e05-ba3c-573c54f442ab', 'writing', 'Spring', 'February', 'Hard', 'Theritical', 'ERQ', 'Ipsa quas numquam eum quo voluptatibus cumque sit voluptatem.', 'Provident distinctio soluta nulla et aut voluptatem alias veritatis excepturi itaque voluptas.', 'cupiditate', 'et', 'excepturi', 'ut', 'B', 'Nisi adipisci sunt autem.', 'Ab iusto molestiae numquam.', 'Laboriosam sapiente architecto reiciendis iure ab non delectus.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(224, 1, 1, 'Placeat placeat molestiae.', 'SLO-f2922dbb-fc67-4e68-bfb0-4550d2c7dda7', 'speaking', 'Spring', 'February', 'Easy', 'Analysis', 'ERQ', 'Reprehenderit similique aut occaecati excepturi excepturi quia inventore nihil asperiores vel atque nihil ipsum.', 'Voluptatem laudantium cupiditate ipsam est molestiae modi ad accusantium perferendis.', 'est', 'saepe', 'molestias', 'neque', 'B', 'Animi qui eum eum.', 'Id molestiae quas libero perspiciatis.', 'At sit harum veritatis ut.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(225, 2, 2, 'Distinctio placeat aliquid.', 'SLO-1475633f-eb29-4352-bc6c-4ea5a6e3e47f', 'reading', 'Fall', 'January', 'Easy', 'Knowledge', 'ERQ', 'Sint placeat quos ab molestiae vel enim.', 'Recusandae aut commodi quae culpa excepturi iusto ut minima qui non.', 'temporibus', 'incidunt', 'voluptatibus', 'ab', 'C', 'Vel sunt est iusto beatae distinctio.', 'Dolor et deleniti facilis dicta recusandae.', 'Aspernatur rerum omnis facilis mollitia sint officiis qui.', 1, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(226, 2, 2, 'A repellendus neque quia.', 'SLO-eef629c1-1ef2-46a0-9478-4da0133ba230', 'lisning', 'Fall', 'February', 'Easy', 'Theritical', 'RRQ', 'Maiores officiis rerum dolorem eum doloribus nihil eius quo aut pariatur.', 'Sunt voluptate sint non soluta sequi ratione repellat ipsa sed assumenda.', 'molestiae', 'soluta', 'rerum', 'aut', 'B', 'Veritatis consectetur eum in ut nam repellat.', 'Officia eveniet fugit ut quia.', 'Omnis quia ullam ad et id labore similique.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(227, 2, 2, 'Itaque repellendus dolores non tempora.', 'SLO-1758fb66-22bf-4cfe-9ccc-5f8034bc3ea2', 'lisning', 'Fall', 'January', 'Medium', 'Analysis', 'ERQ', 'Velit voluptatibus eius exercitationem dolores nemo dolores quos libero.', 'Autem suscipit itaque hic aut atque illo delectus aspernatur amet nostrum.', 'fugiat', 'aut', 'ut', 'libero', 'C', 'Illo veniam exercitationem dolorum consequatur nemo at.', 'Quae et est dolor atque.', 'Rerum alias dolor rerum qui. Aut explicabo atque dignissimos odio id eveniet.', 10, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(228, 1, 1, 'Dolorum accusantium ut.', 'SLO-f52960d3-ce2d-4aaf-8d3e-5798d51ef8e5', 'lisning', 'Fall', 'February', 'Medium', 'Theritical', 'ERQ', 'Eveniet non non nostrum vitae odio ad quis delectus eveniet sunt.', 'Et eligendi autem qui quidem dicta.', 'dolorem', 'asperiores', 'voluptatum', 'vero', 'A', 'Quo laudantium minima facere.', 'Accusantium ut labore qui quam ipsa alias.', 'Dolores laudantium doloribus id amet. Est vel ut voluptatum.', 7, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(229, 2, 2, 'Magnam occaecati architecto id.', 'SLO-44dbea29-c02c-448f-9534-f9cd902084c8', 'lisning', 'Spring', 'February', 'Hard', 'Analysis', 'ERQ', 'Aperiam sequi odit quo quia unde unde ea et.', 'Vel et reprehenderit et sed quibusdam blanditiis.', 'repellat', 'tenetur', 'debitis', 'qui', 'B', 'In dolor similique consequatur praesentium.', 'Numquam odit nisi voluptas dolorem.', 'Aperiam iusto aut vero et.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(230, 1, 1, 'Reiciendis molestias odit quo nihil.', 'SLO-523d6cf3-400e-40ca-a53b-841972b27946', 'lisning', 'Fall', 'February', 'Easy', 'Analysis', 'RRQ', 'Ea vero aliquid aut assumenda ea maiores neque mollitia pariatur maiores in.', 'Ad sunt nesciunt ipsum quod inventore neque consequatur inventore quas.', 'earum', 'porro', 'velit', 'deserunt', 'A', 'Quod dignissimos ea ab inventore recusandae et.', 'Quae minus laboriosam explicabo qui perspiciatis.', 'Ipsa velit in similique.', 5, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(231, 1, 2, 'Provident culpa architecto qui.', 'SLO-4bb81239-6a11-4d59-8185-fe3be52f9c0d', 'speaking', 'Fall', 'February', 'Medium', 'Theritical', 'MCQ', 'Quos magni labore harum sed libero a et.', 'Voluptatem voluptatibus aut omnis rerum mollitia quis sunt et accusantium quae.', 'voluptate', 'sed', 'ullam', 'voluptas', 'D', 'Mollitia accusamus iste cumque incidunt.', 'Perspiciatis repellat quas qui aut hic molestiae.', 'Facere placeat et nulla velit. Accusamus deleniti inventore repellat.', 8, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(232, 1, 1, 'Itaque odio sint blanditiis.', 'SLO-656029d5-9248-4c10-a97d-cca684e493d2', 'lisning', 'Fall', 'February', 'Easy', 'Knowledge', 'MCQ', 'Animi consequuntur delectus aut repellendus mollitia aperiam ducimus porro adipisci.', 'In deleniti aut omnis quia error temporibus.', 'blanditiis', 'consectetur', 'quae', 'sed', 'C', 'Eaque quisquam quis ipsum voluptas earum aut.', 'Recusandae aut aut qui qui.', 'Tempore facilis facilis dolor amet occaecati maiores non. Debitis dignissimos autem praesentium alias ipsa placeat.', 9, '2025-11-14 07:05:13', '2025-11-14 07:05:13'),
(233, 2, 2, 'Cupiditate voluptatum excepturi.', 'SLO-226b6e67-96f3-4cbf-8465-1a42f104ee4d', 'writing', 'Spring', 'January', 'Hard', 'Knowledge', 'MCQ', 'Corporis voluptates consequuntur qui quia non voluptatum necessitatibus quia consequatur ea.', 'Culpa qui incidunt esse dicta sed dolorem dolores harum quae.', 'consequatur', 'sit', 'reprehenderit', 'dolorem', 'A', 'Minima dolor exercitationem minima sit quia hic.', 'Non ut iusto neque.', 'Cum aspernatur voluptatem iusto omnis officiis. Qui consequatur sequi voluptatibus ipsum unde.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(234, 2, 2, 'Molestiae ipsum sed sint.', 'SLO-16567587-f032-42b9-800e-c2f5b1f1d553', 'speaking', 'Spring', 'February', 'Easy', 'Knowledge', 'RRQ', 'Nisi et tempore ullam ut commodi officia est eveniet odit voluptatem et.', 'Velit quam laudantium accusamus sit magni rerum.', 'est', 'rerum', 'nihil', 'aut', 'D', 'Dolor qui dolorum sunt velit.', 'Temporibus ut cum maiores.', 'Unde sunt et velit assumenda magnam in voluptatem. Ea ea aut sint reiciendis illum.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(235, 1, 1, 'Nesciunt natus distinctio rem.', 'SLO-1eb7014e-dfd4-4aed-b1b7-cb17faa00bd7', 'speaking', 'Fall', 'January', 'Easy', 'Analysis', 'RRQ', 'Ut consequatur hic in rerum officia tempora ut et recusandae maxime quis explicabo.', 'Excepturi aspernatur excepturi nisi voluptates.', 'adipisci', 'amet', 'dolor', 'soluta', 'A', 'Consequatur quasi itaque vitae odio.', 'Cumque quia sit pariatur enim.', 'Voluptatibus dolore ut et ut aut.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(236, 2, 1, 'Tenetur reiciendis a.', 'SLO-d89fc4b4-4703-4899-94cd-1b92edebcf21', 'lisning', 'Spring', 'January', 'Easy', 'Theritical', 'MCQ', 'Officiis expedita sint natus deserunt minima autem iste vero nulla est enim omnis.', 'Quisquam in commodi beatae aut voluptas cupiditate deserunt sit saepe quas.', 'neque', 'perspiciatis', 'eos', 'non', 'D', 'Porro tempora tempore sit enim vel eaque.', 'Harum modi facilis dignissimos.', 'Dolores debitis ut ab nihil. Fugit veniam placeat consequatur nihil deleniti perspiciatis.', 2, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(237, 2, 2, 'Sunt et rerum.', 'SLO-24b0f8e8-fe3c-4e46-b006-b7cc6e1b8e2a', 'reading', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Alias animi dolores optio dolore quis dolores quis excepturi tempore.', 'Aut aut sunt quia a dolores autem repellat et.', 'porro', 'est', 'modi', 'dolores', 'A', 'Exercitationem distinctio exercitationem voluptatum officia velit.', 'Atque molestiae eum quod.', 'Non laboriosam earum consequuntur voluptates aut velit ad. Sit dolore consequatur occaecati qui a qui est.', 2, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(238, 1, 1, 'Autem aut labore.', 'SLO-8ed3fc23-d7a8-44ff-8149-870c08920262', 'reading', 'Spring', 'January', 'Easy', 'Analysis', 'RRQ', 'Et aperiam assumenda corporis non dolorum harum eos molestiae.', 'Provident libero cum est optio magnam repellendus et voluptatem ratione harum.', 'a', 'voluptatem', 'cum', 'voluptas', 'C', 'Velit quos libero qui adipisci.', 'Recusandae sunt non accusamus.', 'Vel beatae tempora totam quas.', 1, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(239, 2, 1, 'Reprehenderit temporibus qui dolores.', 'SLO-508575a4-2ae2-476d-87c5-f1acaaf91e40', 'reading', 'Fall', 'January', 'Easy', 'Practical', 'ERQ', 'Quas voluptatum dolorum enim molestias quisquam nisi culpa animi ea ex distinctio vel.', 'Unde nostrum voluptates similique rem vero reiciendis quas a.', 'accusantium', 'deleniti', 'assumenda', 'illo', 'B', 'Qui consectetur quos aut ut at.', 'Quis provident eius dolorum ipsum odit magnam.', 'Ipsum necessitatibus suscipit et eveniet.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(240, 1, 2, 'Quo ipsa harum iusto.', 'SLO-174e1cde-7685-4344-b9be-a8d1c63f7cdc', 'reading', 'Spring', 'January', 'Hard', 'Analysis', 'MCQ', 'Necessitatibus inventore qui totam delectus deserunt vero veniam sed voluptas facilis.', 'Quia eos nam qui qui blanditiis voluptatem perspiciatis aut excepturi cupiditate.', 'ex', 'eaque', 'repellat', 'rerum', 'D', 'Laboriosam aut nemo aut sed est.', 'Amet tempora rerum omnis vero autem.', 'Assumenda voluptatum voluptatibus expedita exercitationem. At eos ut perspiciatis ut sint porro.', 1, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(241, 2, 2, 'Corrupti ipsa velit.', 'SLO-d327deb2-6a2d-4e03-8826-1acbb28c55f4', 'lisning', 'Spring', 'January', 'Hard', 'Theritical', 'RRQ', 'Odit libero non dolores dignissimos dolore voluptatibus libero eaque.', 'Odio eos voluptas eos non eius sed est optio aperiam.', 'qui', 'vel', 'veniam', 'omnis', 'C', 'Voluptatibus nobis rerum voluptas ut.', 'Aperiam minima earum aliquid.', 'Consequuntur reiciendis esse totam ea sed. Voluptatem iusto cumque amet officia modi quia perspiciatis aperiam.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(242, 1, 1, 'Expedita hic eos.', 'SLO-d25e9fdd-524d-41e2-ac16-077a473d9db1', 'writing', 'Spring', 'February', 'Medium', 'Theritical', 'MCQ', 'Est ut at ut rerum tenetur qui dignissimos omnis adipisci hic omnis.', 'Repellat id nihil numquam eveniet molestiae.', 'eveniet', 'sapiente', 'suscipit', 'voluptatem', 'D', 'Sunt doloremque modi velit illum.', 'Qui perspiciatis praesentium voluptatibus quisquam consequatur voluptatem.', 'Necessitatibus possimus sequi amet tempora accusantium dolores. Ea quam ratione provident perferendis suscipit.', 1, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(243, 2, 1, 'Laboriosam suscipit.', 'SLO-8c764f58-e0f6-4e0f-8a68-0c0a14e38a0f', 'speaking', 'Fall', 'February', 'Hard', 'Practical', 'RRQ', 'Consectetur quam fuga alias consequatur incidunt velit saepe laudantium.', 'Soluta est ipsam possimus dolor ratione culpa.', 'error', 'in', 'perspiciatis', 'aut', 'A', 'Quaerat quia expedita optio ut.', 'Numquam laborum ab molestiae at.', 'Cum voluptas dolorum sunt et ut.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(244, 1, 2, 'Eos totam eligendi eveniet.', 'SLO-193fd523-a53b-4bf3-bc75-2ed1a866d6f6', 'reading', 'Fall', 'February', 'Easy', 'Theritical', 'ERQ', 'Voluptas vel aspernatur voluptas doloribus odit voluptate cum eum.', 'Qui optio dolore eum rerum in ut eum consequatur.', 'sed', 'quidem', 'dignissimos', 'odio', 'D', 'Officiis corrupti sapiente minima in.', 'Beatae enim deserunt maiores.', 'Ducimus soluta nisi et.', 3, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(245, 2, 1, 'Unde sit quo et repellendus.', 'SLO-945c7cdb-5aa8-4256-ac5a-99fd162f72ef', 'writing', 'Fall', 'January', 'Medium', 'Analysis', 'RRQ', 'Facilis hic eius omnis alias odit libero ratione omnis voluptatem.', 'Dicta dolorem accusamus et nesciunt inventore quia laboriosam rerum molestiae.', 'unde', 'harum', 'id', 'vero', 'D', 'Vitae est non magnam.', 'Numquam deleniti provident sapiente voluptatibus.', 'Magnam sit fugit unde.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(246, 2, 1, 'Adipisci magnam quis inventore.', 'SLO-8ed57a57-724a-4527-85e8-e5aa5b5e6d0c', 'speaking', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Blanditiis numquam perferendis aperiam sunt fuga aspernatur reprehenderit et voluptatibus minus.', 'Sint quia et autem consequatur.', 'ut', 'debitis', 'sit', 'aut', 'B', 'Eius quasi harum quod aut.', 'Quis debitis porro et ea aliquid.', 'Deserunt similique velit et enim consectetur velit fugiat.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(247, 2, 1, 'In minus non officia.', 'SLO-6b8f4a65-33a1-479c-974b-1a9864db64c2', 'writing', 'Spring', 'February', 'Medium', 'Analysis', 'ERQ', 'Minima eligendi nam qui hic illo dolor non velit eius ducimus nulla porro laudantium.', 'Et debitis possimus velit perspiciatis natus cum voluptas est.', 'maxime', 'aut', 'enim', 'quia', 'B', 'Dolore aut fugit asperiores quibusdam.', 'Non reiciendis sequi odit in adipisci.', 'Excepturi deserunt ducimus incidunt sit sit sint dolores.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(248, 1, 2, 'Ipsum ut molestiae.', 'SLO-d4f56ed6-4337-4809-be17-fc5493824aa5', 'writing', 'Spring', 'January', 'Easy', 'Knowledge', 'MCQ', 'Veniam tempore temporibus occaecati et vitae nostrum totam esse consequuntur non et harum.', 'Qui placeat quod autem atque ipsa.', 'provident', 'sit', 'id', 'et', 'B', 'Aut error at unde ullam.', 'Dolore architecto ut voluptatem impedit aut.', 'Eum architecto tempore molestiae officiis voluptatum et fugiat. Incidunt provident dolorem pariatur qui ut.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(249, 1, 2, 'Optio beatae ut delectus.', 'SLO-e0b3e58f-0107-405a-9913-858a3a455540', 'speaking', 'Fall', 'January', 'Easy', 'Theritical', 'MCQ', 'Officia debitis aut aut ratione dolore dolor debitis eos alias.', 'Fugit magnam enim mollitia error id voluptatum.', 'quod', 'ducimus', 'animi', 'sint', 'A', 'Et distinctio eos et fuga quo.', 'Illo iure temporibus atque ea mollitia sit.', 'Eius voluptatibus mollitia ad id velit magnam porro non.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(250, 1, 2, 'Voluptate cupiditate ea aliquid.', 'SLO-5e2ce699-1b20-4960-a3ed-26b2dafdaaa5', 'reading', 'Spring', 'January', 'Medium', 'Analysis', 'ERQ', 'Est et et architecto repellendus quod error.', 'Delectus aliquid nulla velit inventore delectus reprehenderit magni quasi qui provident.', 'saepe', 'error', 'doloribus', 'sed', 'A', 'Et aut possimus voluptatum alias.', 'Et error occaecati sed deserunt labore.', 'Doloremque ut quasi dicta cupiditate iste maxime voluptatem tempore.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(251, 2, 1, 'Magni ipsam iure cupiditate mollitia.', 'SLO-99b47fb0-9a5d-4239-9ecf-0fdf5c387593', 'speaking', 'Fall', 'January', 'Easy', 'Theritical', 'MCQ', 'Sed pariatur eum velit rerum est reprehenderit.', 'Ad aspernatur expedita eum quae laborum earum ipsum minima ea.', 'a', 'vel', 'sint', 'rerum', 'C', 'Dicta aut qui explicabo et maiores.', 'Nobis rerum et sit velit autem iste.', 'Et voluptatibus pariatur omnis rerum impedit.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(252, 1, 2, 'Explicabo cumque possimus.', 'SLO-183b2b22-9a19-4b19-b225-259a9a57189d', 'writing', 'Spring', 'January', 'Easy', 'Theritical', 'MCQ', 'Blanditiis et placeat assumenda et eligendi minus tempora occaecati autem debitis.', 'Est a consequatur libero odit omnis sint.', 'ipsum', 'veniam', 'odio', 'omnis', 'A', 'Ea id omnis et voluptatem molestias et.', 'Architecto ut quaerat dicta adipisci veniam consequatur.', 'Iste voluptate sit et cumque numquam at vitae. Debitis provident facilis ea qui incidunt.', 2, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(253, 2, 2, 'Quia quam perferendis.', 'SLO-3cb9c043-b28e-446a-8166-2dab0d9b3c7e', 'lisning', 'Spring', 'January', 'Medium', 'Knowledge', 'RRQ', 'Nulla sint sunt itaque omnis autem omnis est est veritatis debitis occaecati esse.', 'Vitae autem praesentium explicabo ipsam tenetur error.', 'aperiam', 'vitae', 'ea', 'dolorum', 'D', 'Aliquam vitae voluptatem velit.', 'Qui eaque voluptas qui ut.', 'Impedit rerum quos provident aut aut.', 9, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(254, 2, 1, 'Possimus magni error rerum.', 'SLO-249f2fd5-c961-4210-a190-d2052a64baff', 'speaking', 'Spring', 'February', 'Medium', 'Analysis', 'MCQ', 'Eum est veniam delectus error est laudantium illum quae delectus aperiam accusantium.', 'Dolorem est laudantium expedita molestias ipsa et quae.', 'consequatur', 'et', 'quis', 'ad', 'B', 'Ut aliquam dicta animi.', 'Cumque dignissimos dolores dolorum.', 'Similique ex non tempora.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(255, 2, 2, 'Eveniet nam earum.', 'SLO-bd1c3284-b790-4561-a6f1-f2d02ce765c1', 'writing', 'Fall', 'February', 'Hard', 'Theritical', 'ERQ', 'Natus sapiente debitis dolorum sit quos corrupti et mollitia quia et qui dicta ut.', 'Maiores voluptatem consectetur quibusdam deleniti quo vero occaecati eaque rerum.', 'id', 'hic', 'temporibus', 'aspernatur', 'A', 'Rerum in aliquam aut et.', 'Facere repudiandae tempora et vero numquam.', 'Dolores aut nisi pariatur voluptatibus sequi eum quibusdam maxime. Exercitationem eos minima maxime et vel.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(256, 2, 1, 'Velit quia molestiae.', 'SLO-bd8cc56f-08a3-4c72-87dd-d018467413e2', 'reading', 'Spring', 'February', 'Medium', 'Knowledge', 'MCQ', 'Repudiandae voluptatem sunt consectetur iure non aliquid sequi voluptatem doloremque.', 'Dignissimos quisquam id ut et sed aut.', 'soluta', 'enim', 'qui', 'veniam', 'B', 'Animi laborum voluptates autem aut velit officia.', 'Beatae quos doloremque repellat est.', 'Quibusdam fugit eum placeat rem omnis ipsum recusandae distinctio.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(257, 2, 1, 'Voluptatem eveniet quo.', 'SLO-ddd967ba-3b1f-4e14-a044-b7fac1c0d8d5', 'lisning', 'Spring', 'January', 'Medium', 'Theritical', 'ERQ', 'Consectetur explicabo quidem nihil earum quae dolorem rerum.', 'Autem iste earum ad est consequatur aut at.', 'cumque', 'sit', 'incidunt', 'voluptas', 'A', 'Vitae aperiam et vel.', 'Consectetur ut ex esse.', 'Necessitatibus illum aut dolorem in et velit deserunt.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(258, 2, 1, 'Voluptatum reprehenderit corporis est.', 'SLO-cec156f6-c42e-45c8-9106-145abe95ea2f', 'speaking', 'Spring', 'February', 'Medium', 'Practical', 'MCQ', 'Vel veniam voluptatum eum facere ut id consectetur odio tempora rerum sed excepturi.', 'Quia non blanditiis dolorum porro fuga.', 'consequuntur', 'assumenda', 'culpa', 'officiis', 'C', 'Laborum assumenda unde tenetur.', 'Nihil repellat exercitationem dolor.', 'Placeat debitis alias est. Sapiente excepturi provident ipsam quo.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(259, 2, 2, 'Suscipit adipisci repudiandae asperiores.', 'SLO-039501bb-444d-4b8a-9a74-b5d38e33ba22', 'writing', 'Fall', 'January', 'Easy', 'Analysis', 'ERQ', 'Quas voluptas commodi eum minima nostrum sed nihil voluptatum maiores et distinctio sit.', 'Aut esse commodi asperiores enim veniam aut.', 'voluptatem', 'rerum', 'non', 'placeat', 'A', 'Veniam tempora id voluptatem hic totam ex.', 'Quo omnis hic possimus est id voluptatibus.', 'Sed nemo recusandae voluptatem delectus voluptas. Omnis quia perferendis earum recusandae.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(260, 1, 1, 'Eveniet quam optio voluptatem.', 'SLO-b6217afc-9c6b-4ef0-832e-e728541d3406', 'reading', 'Spring', 'February', 'Medium', 'Practical', 'MCQ', 'Et assumenda fuga voluptatibus ut quo et molestiae fugit unde.', 'Iusto nostrum officia et aliquid magni.', 'velit', 'quos', 'voluptatem', 'aliquam', 'D', 'Possimus et sed sunt incidunt.', 'Velit mollitia distinctio et nihil.', 'Cupiditate necessitatibus nobis veniam non sed dicta.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(261, 2, 1, 'Optio nostrum autem aperiam.', 'SLO-de579059-11c5-4e78-93ce-4799e2e9747a', 'lisning', 'Fall', 'February', 'Hard', 'Theritical', 'MCQ', 'Et fuga rerum dolor nihil illo dolorem dicta consequuntur delectus laudantium.', 'Et quo quaerat laudantium est dolores.', 'dolorum', 'voluptas', 'et', 'ut', 'D', 'Voluptatem enim est eum molestiae aperiam culpa.', 'Cumque dolorum qui laudantium.', 'Totam in nobis in mollitia omnis dignissimos exercitationem.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(262, 1, 1, 'Neque aut occaecati.', 'SLO-c9f73c50-1ea7-4aff-a530-e559737640e3', 'lisning', 'Fall', 'January', 'Medium', 'Knowledge', 'ERQ', 'Itaque ea odit dolore officia sunt in beatae est voluptate quia neque.', 'Iste quasi ullam earum vitae architecto molestiae est omnis pariatur.', 'sed', 'accusamus', 'sit', 'maxime', 'A', 'Laudantium et odit quia itaque veritatis.', 'Recusandae maxime et dolores.', 'Sint vel eveniet qui. Facilis facilis vel ipsam in rerum aut animi fuga.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(263, 2, 2, 'Eaque iusto laboriosam.', 'SLO-609a2214-d26b-458d-9b5c-f413791142ec', 'writing', 'Fall', 'January', 'Hard', 'Analysis', 'MCQ', 'Dolores voluptatibus voluptate nobis quasi in aperiam facilis ducimus eveniet nesciunt.', 'Nihil ipsam eos voluptatem dolores voluptatum vitae.', 'qui', 'alias', 'eum', 'ut', 'A', 'Voluptas et consequatur unde eius.', 'Pariatur accusamus sed dolorem vitae ducimus.', 'Voluptas ut sint fugit recusandae et.', 1, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(264, 1, 1, 'Dolores consectetur illum est.', 'SLO-367cd5ef-7baa-4081-bf15-5c50dea947dd', 'writing', 'Fall', 'January', 'Medium', 'Analysis', 'MCQ', 'Mollitia rerum odit sequi sint a placeat at ea nobis natus eum tempore.', 'Nisi est iusto voluptas et in quia fugit sit.', 'nihil', 'sunt', 'assumenda', 'eos', 'D', 'Repellendus inventore reiciendis praesentium sed.', 'Illum et aut ab hic dolor ipsum.', 'Voluptatem nesciunt odit odit perspiciatis.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(265, 2, 1, 'Voluptas quas.', 'SLO-c1561afb-f70a-4f54-af5d-551a3796e09c', 'reading', 'Fall', 'January', 'Medium', 'Practical', 'MCQ', 'Fuga cumque consequatur iusto sed et voluptas.', 'Eaque aut rerum quos dolores non sed distinctio ipsa omnis dolores expedita.', 'voluptatem', 'omnis', 'tenetur', 'minus', 'A', 'Repellat beatae quisquam provident quae.', 'Voluptas optio vero quas.', 'Consequuntur suscipit autem itaque soluta.', 3, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(266, 1, 2, 'Sapiente nobis non quo.', 'SLO-47b58bb8-8850-4f79-aa22-c570c6266410', 'writing', 'Spring', 'February', 'Hard', 'Analysis', 'RRQ', 'Esse numquam nobis accusamus autem voluptatem aut maxime nisi qui facere inventore explicabo.', 'Blanditiis non eveniet soluta totam nihil facere.', 'officia', 'nam', 'quia', 'corporis', 'A', 'Provident dolorem consectetur autem occaecati.', 'Suscipit incidunt cumque quis dolorem.', 'Alias illo earum facere et non molestiae.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(267, 1, 2, 'Odio vero perspiciatis.', 'SLO-c430f290-4ab9-4f88-8967-29b4cf961143', 'writing', 'Spring', 'February', 'Medium', 'Theritical', 'RRQ', 'Qui molestiae magni et aliquam omnis sit molestiae possimus veritatis.', 'Culpa voluptate non est consequatur maiores aliquam voluptatem consequatur sunt illum labore.', 'illo', 'qui', 'distinctio', 'consequatur', 'B', 'Magni sed at aut.', 'Repudiandae eos voluptatibus corporis expedita.', 'Dignissimos illum aut dolorem tempora. Repudiandae nemo exercitationem quibusdam aut ut quibusdam.', 2, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(268, 2, 1, 'Deleniti voluptatum ipsum sit.', 'SLO-09d75e64-2603-4213-a7ab-34f1e82f3668', 'lisning', 'Spring', 'February', 'Easy', 'Knowledge', 'MCQ', 'Soluta eaque in ducimus omnis eum qui molestiae.', 'Ullam sed ullam sit animi amet illo non quis.', 'impedit', 'dolorem', 'ipsa', 'nesciunt', 'C', 'Aperiam qui quae id architecto debitis enim.', 'Voluptatum eaque sed laborum eveniet voluptas.', 'Ab omnis voluptate voluptatem numquam et praesentium ut.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(269, 1, 1, 'Sit tempore aut laboriosam.', 'SLO-3bea8ccb-1cf0-4ceb-9c15-0f0ca2cfd377', 'speaking', 'Fall', 'February', 'Hard', 'Analysis', 'MCQ', 'Rerum nam nihil voluptatibus sed est ut.', 'Voluptas voluptatum at omnis debitis dolor.', 'commodi', 'molestias', 'vel', 'est', 'D', 'Repellendus ipsam ut eos et praesentium.', 'Aut tempore sapiente nemo.', 'Animi qui minus recusandae aut molestias similique qui. Voluptatem ea sit nemo a ducimus aperiam.', 2, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(270, 2, 1, 'Maiores et expedita adipisci.', 'SLO-f7f8d1dc-1e6c-4dd3-9d86-0cfe73356787', 'writing', 'Fall', 'January', 'Easy', 'Practical', 'MCQ', 'Earum eveniet accusantium harum ratione minus omnis eos corporis neque ea.', 'Necessitatibus harum quos perferendis aut id nostrum maiores laboriosam eius quam.', 'totam', 'odit', 'est', 'qui', 'D', 'Reprehenderit molestiae tenetur neque non quo.', 'Minus dolorem qui asperiores quo.', 'Ut rerum quia et vel optio fugit iure.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(271, 2, 2, 'Magnam modi illo illum.', 'SLO-925870d5-ea9d-4557-ac62-959855e38c8a', 'writing', 'Fall', 'January', 'Easy', 'Analysis', 'ERQ', 'Veritatis ipsam suscipit accusamus molestiae ut nisi est nihil consequuntur incidunt in.', 'Qui explicabo ut culpa atque dicta consequuntur perferendis libero quia commodi.', 'repellat', 'voluptas', 'beatae', 'architecto', 'B', 'Similique possimus ut voluptatem itaque natus.', 'Ipsum quod dolorem dolorum.', 'Est illo provident commodi dolor corporis nesciunt voluptas provident.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(272, 1, 1, 'Voluptas soluta optio molestiae.', 'SLO-2d4cbb02-5724-4392-8ff4-6b75f4adb8c5', 'writing', 'Fall', 'January', 'Easy', 'Analysis', 'ERQ', 'Vel dolorem commodi repellat officiis earum repudiandae eum ratione explicabo sit quia.', 'Cupiditate id alias odio sint et hic labore quis.', 'rem', 'velit', 'et', 'et', 'B', 'Et qui velit nihil.', 'Quam est voluptas voluptatum magnam.', 'Qui ex aliquid facere non tempora voluptas.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(273, 1, 2, 'Facilis eveniet autem maxime maiores.', 'SLO-fd16c58e-0b37-462e-8789-9cb2664fbadb', 'speaking', 'Fall', 'January', 'Easy', 'Practical', 'RRQ', 'Ipsam sed velit enim nesciunt molestias ducimus culpa animi odio alias amet nesciunt repellat.', 'Harum ab est repudiandae quia ipsum et voluptate qui nesciunt.', 'itaque', 'nam', 'veritatis', 'sunt', 'C', 'Quis excepturi repellendus aut.', 'Officiis et dolores at nam.', 'Impedit ea eum iure dolor culpa.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(274, 1, 2, 'Sit non voluptatem veritatis.', 'SLO-d0ec021e-fc58-4e06-a7d2-384b15e861f3', 'lisning', 'Fall', 'January', 'Hard', 'Analysis', 'RRQ', 'Eaque quos dolorum quasi nam dicta explicabo.', 'Adipisci architecto molestiae eos ut vero aperiam labore autem eos.', 'vitae', 'hic', 'sint', 'veritatis', 'B', 'Et dicta quae quo voluptate voluptatibus doloribus.', 'Dignissimos quod voluptatem error illum nobis.', 'Ut laborum ea esse labore. Et qui rem nihil nihil a officiis.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(275, 1, 2, 'Et alias.', 'SLO-d99330ae-a3ec-4d6b-8be8-4cb04981bde1', 'reading', 'Fall', 'February', 'Medium', 'Theritical', 'ERQ', 'Culpa veritatis nesciunt libero velit quia aut quaerat animi harum.', 'Quod culpa dicta vitae earum at aliquid est et officiis animi.', 'ullam', 'voluptatum', 'eos', 'velit', 'D', 'Et commodi non molestiae culpa adipisci occaecati.', 'Delectus necessitatibus officiis est perspiciatis.', 'Inventore vitae et quae est. Iure aspernatur doloribus neque unde est ducimus.', 1, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(276, 1, 1, 'Enim quis aut.', 'SLO-14ca48a0-19b9-4253-9763-54910b186ae9', 'reading', 'Fall', 'January', 'Hard', 'Theritical', 'RRQ', 'Aut quia soluta sit ut aut sunt sed et alias et facilis consequatur.', 'Vitae reprehenderit ad rerum sit dignissimos.', 'illo', 'enim', 'est', 'cupiditate', 'A', 'Ad molestiae nesciunt adipisci velit exercitationem beatae.', 'Voluptas ex odit cum sed.', 'Earum ab nostrum aperiam quo mollitia deserunt quia. Suscipit voluptatem et eaque corporis laudantium.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(277, 2, 1, 'Eius voluptatum quis.', 'SLO-f3c7ddc4-ecf4-407d-98bc-6593867ff2ac', 'lisning', 'Fall', 'February', 'Easy', 'Theritical', 'MCQ', 'Ex distinctio et id et odit fuga quasi quia qui sit quibusdam et.', 'Saepe praesentium itaque reiciendis rerum magnam occaecati velit.', 'temporibus', 'eveniet', 'voluptas', 'amet', 'C', 'Odio veritatis minima optio reprehenderit.', 'Nemo iste sit ut.', 'Libero debitis omnis voluptatem dolorem.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(278, 1, 2, 'Consequatur neque.', 'SLO-49786fa2-49b2-4adb-a844-3e33719b8dca', 'speaking', 'Spring', 'January', 'Hard', 'Knowledge', 'ERQ', 'Quam consequatur quia harum inventore et repudiandae maiores vel magni.', 'Est et ipsa omnis et asperiores molestias dignissimos.', 'dolorem', 'et', 'architecto', 'aut', 'B', 'Iure asperiores rerum tempore nam et.', 'Fugit suscipit dicta perferendis molestiae veniam.', 'Repellendus rem illo nihil et.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(279, 2, 1, 'Assumenda et ducimus.', 'SLO-fec16a8f-86a5-4b81-87ab-12446a03d286', 'reading', 'Spring', 'February', 'Hard', 'Practical', 'ERQ', 'Odit provident odit officiis enim id itaque ea magni facilis.', 'Et aut debitis ad odio error reiciendis facilis.', 'maxime', 'cumque', 'tenetur', 'eos', 'A', 'Illum quisquam totam ipsa.', 'Deserunt molestiae ipsum aut maxime nulla.', 'Officia delectus neque itaque.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(280, 2, 1, 'Accusantium eum quisquam.', 'SLO-55bb458f-d25d-4c64-a742-9951872a0f8a', 'reading', 'Fall', 'January', 'Hard', 'Theritical', 'ERQ', 'Minus quo voluptatem et dignissimos totam a molestias.', 'Accusantium dolor blanditiis ullam amet impedit.', 'rerum', 'ipsam', 'explicabo', 'inventore', 'B', 'Amet totam quod est.', 'Rerum vitae corrupti modi.', 'Et quibusdam molestias velit itaque.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(281, 2, 1, 'Rerum numquam vel commodi.', 'SLO-5e8ce741-1ffc-4ddd-9355-8a0a016eb7a0', 'writing', 'Fall', 'February', 'Hard', 'Knowledge', 'RRQ', 'Non possimus et necessitatibus aspernatur non odit hic quisquam accusamus.', 'Eos provident nemo aut facilis earum.', 'numquam', 'dolores', 'eveniet', 'dicta', 'C', 'Laudantium doloremque quis ut eveniet id.', 'Et nam libero consectetur.', 'Eos id et nostrum temporibus sequi illo voluptas. Dolores deleniti aut consequatur id commodi.', 3, '2025-11-14 07:05:14', '2025-11-14 07:05:14');
INSERT INTO `item_banks` (`id`, `subject_id`, `grade_id`, `slo`, `slo_no`, `skill`, `semester`, `month`, `difficulty`, `category`, `item_type`, `item_description`, `stimulus`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `possible_answers`, `marking_hints`, `rubric`, `total_marks`, `created_at`, `updated_at`) VALUES
(282, 1, 2, 'Tempora dolor nisi.', 'SLO-5344214e-f3f5-4a19-8e25-2a84b4d2f04b', 'writing', 'Spring', 'January', 'Hard', 'Analysis', 'MCQ', 'Et nihil enim enim assumenda reprehenderit est accusantium voluptatem aut vel nisi.', 'Et error optio alias tempora labore aut nesciunt fuga quod.', 'aut', 'et', 'rerum', 'laudantium', 'D', 'Et nihil qui eum.', 'Quis ut hic pariatur tempora voluptatem.', 'Sunt odio voluptate consequuntur omnis ut similique. Consectetur delectus ipsa ea eos voluptatem.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(283, 2, 1, 'Qui dolor saepe eos.', 'SLO-04cf9952-10de-4c66-9e8e-89bdbec71242', 'lisning', 'Fall', 'February', 'Easy', 'Practical', 'ERQ', 'Doloremque et alias minus et aperiam aspernatur non molestiae maiores explicabo vero.', 'Veniam id ab cumque animi.', 'quod', 'sit', 'illum', 'et', 'C', 'Quaerat error consectetur eum necessitatibus.', 'Ducimus consequatur quam porro.', 'Perferendis sit voluptatibus similique voluptatem et. Et architecto rerum nisi natus corporis aliquid.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(284, 1, 1, 'Optio debitis magni et similique.', 'SLO-3827d45e-af3f-4a2a-929d-2094920628b4', 'speaking', 'Spring', 'January', 'Hard', 'Theritical', 'RRQ', 'Perferendis sed quae harum molestiae eligendi id sapiente earum.', 'Non odio numquam mollitia sunt quidem.', 'pariatur', 'occaecati', 'quae', 'neque', 'A', 'Omnis eos iure eligendi.', 'At ut et totam in.', 'Nihil laudantium sequi dolores dicta nisi omnis. Et repellendus sed non explicabo sunt tempora exercitationem.', 3, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(285, 1, 2, 'Aut et vero.', 'SLO-7a1d2a7e-962a-4859-b3ca-b117bf14888a', 'reading', 'Spring', 'February', 'Medium', 'Practical', 'ERQ', 'Velit voluptatum culpa asperiores quae eaque sit voluptatem quaerat velit quidem maiores ex rerum.', 'Quo error ipsum est libero provident.', 'ex', 'mollitia', 'ea', 'aspernatur', 'B', 'Voluptas corporis sit ad et.', 'Corporis ratione non qui iste.', 'Impedit aspernatur quis molestiae id. Quam et distinctio sed temporibus nostrum.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(286, 1, 2, 'Beatae adipisci magnam corporis.', 'SLO-3871ee42-6049-48f7-9afc-10323d090e5d', 'speaking', 'Spring', 'February', 'Easy', 'Analysis', 'ERQ', 'Quidem minima aut consequatur cum omnis officia optio ab.', 'Ex velit qui tempore minima esse at totam.', 'sunt', 'reprehenderit', 'dolore', 'at', 'B', 'Qui impedit aut commodi.', 'Aliquid libero placeat sit fugit et.', 'Dolores sit omnis eveniet optio in nisi nihil molestiae. Et ad iste sed dolor enim velit qui eius.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(287, 2, 1, 'Sint dolor magni explicabo.', 'SLO-80190186-3d31-4867-a274-076d8580c177', 'lisning', 'Spring', 'January', 'Easy', 'Knowledge', 'ERQ', 'Animi qui corporis eligendi quam fugiat itaque qui nihil quaerat deleniti aliquid.', 'Blanditiis vitae velit dolore doloribus in est et vitae exercitationem.', 'voluptatum', 'aliquam', 'fugit', 'ut', 'C', 'Dolores excepturi veniam voluptatem quidem.', 'Magnam inventore maxime repudiandae necessitatibus numquam reprehenderit.', 'Expedita ullam eligendi sint consequatur. Porro ut sunt ullam dolorem ratione.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(288, 1, 2, 'Maxime sed voluptas occaecati.', 'SLO-e39a6b28-bff4-4f97-b735-94e963877935', 'lisning', 'Spring', 'February', 'Medium', 'Analysis', 'ERQ', 'Vel debitis inventore ipsum nemo sunt ducimus.', 'Autem molestiae tempora sit nulla ut qui ut deserunt.', 'soluta', 'dolores', 'dicta', 'officia', 'B', 'Molestiae provident fugit earum.', 'Dicta temporibus velit sed.', 'Aspernatur animi quam dolore quia.', 9, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(289, 1, 1, 'Ut qui voluptas commodi.', 'SLO-129b4567-3a81-4bdd-b58e-c0482101cb4f', 'lisning', 'Spring', 'February', 'Easy', 'Practical', 'MCQ', 'Ratione ex sapiente quos quis voluptatibus sequi doloribus voluptates.', 'Omnis nihil enim est esse et et ab.', 'qui', 'qui', 'libero', 'officia', 'C', 'Dolor ea laboriosam similique in.', 'Autem inventore ducimus distinctio.', 'Et ut a nam quod repellat aut. Recusandae numquam aut et sed.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(290, 2, 1, 'Doloribus alias deserunt.', 'SLO-b4e7a359-8649-4060-b372-131c129d3393', 'writing', 'Spring', 'February', 'Easy', 'Theritical', 'RRQ', 'Cupiditate qui accusamus omnis quod et tempora dolorem est.', 'Similique est commodi earum et illo.', 'dolores', 'vel', 'pariatur', 'occaecati', 'D', 'Ut at porro voluptatibus dignissimos.', 'Provident iusto quo nisi.', 'Aut quia voluptatem ex.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(291, 1, 1, 'Ipsum nobis facere.', 'SLO-b7649c41-949a-451c-b8b5-d01ecce88786', 'lisning', 'Spring', 'February', 'Medium', 'Practical', 'ERQ', 'Modi impedit quas aspernatur rerum voluptas est quis quo quisquam odio repudiandae ratione.', 'Quam possimus dignissimos porro quo dolorem.', 'expedita', 'natus', 'sunt', 'placeat', 'D', 'Qui similique rem veniam provident pariatur.', 'Id vel ut dolorum.', 'Quaerat unde natus voluptates assumenda quos. Autem nam odio eaque odio eius.', 9, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(292, 1, 2, 'Illum id accusamus accusamus.', 'SLO-ab76b439-4340-4703-b32e-22cb835ea03c', 'writing', 'Spring', 'January', 'Hard', 'Theritical', 'ERQ', 'Aliquam tempore qui ipsa enim voluptas voluptatem dolore.', 'Suscipit nemo illum ea voluptatum ullam maxime est perferendis qui.', 'nisi', 'quidem', 'expedita', 'similique', 'C', 'Quibusdam ut qui omnis repellendus doloremque.', 'Autem iusto sit qui neque ea.', 'Fugiat eos saepe et repellendus a explicabo quidem.', 2, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(293, 1, 2, 'Voluptas velit eligendi.', 'SLO-5af8f43b-7e14-496f-b228-1e2f49b5a198', 'reading', 'Spring', 'January', 'Medium', 'Analysis', 'ERQ', 'Pariatur ea sint molestiae maxime dolores odio reprehenderit enim nobis ut.', 'Qui tempora aut odit ea nesciunt saepe est.', 'ut', 'aut', 'temporibus', 'voluptatem', 'B', 'Quod et et ducimus tempora.', 'Rerum ducimus beatae aut quas dolores.', 'Molestiae eveniet placeat tempore perferendis aut corporis quisquam pariatur. Est nobis eligendi rerum nobis magnam.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(294, 2, 1, 'Asperiores quia accusantium.', 'SLO-38274285-99e4-4377-a92e-ab7584e47212', 'lisning', 'Spring', 'January', 'Hard', 'Analysis', 'ERQ', 'Et suscipit sed sed animi beatae cumque dicta aut libero.', 'Aliquid sunt magni enim nemo perspiciatis esse eum et necessitatibus laboriosam.', 'qui', 'tempora', 'voluptatem', 'aperiam', 'B', 'Quae possimus omnis et et aliquam deleniti.', 'Et nisi omnis recusandae iure est.', 'Libero perspiciatis eveniet ut impedit porro reprehenderit nihil.', 10, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(295, 1, 1, 'Nemo dolorem accusamus.', 'SLO-ee922a1c-da8f-4c15-8c0c-68102ae4f875', 'reading', 'Fall', 'February', 'Hard', 'Practical', 'MCQ', 'Asperiores quia esse molestias quam dolor sint natus omnis nihil at ratione blanditiis.', 'Nesciunt quibusdam ipsa eveniet delectus illo et.', 'rerum', 'aut', 'corporis', 'sed', 'A', 'Inventore aut eveniet necessitatibus.', 'Velit doloremque ratione amet sed.', 'Accusamus aliquam harum iste tempore et voluptas velit.', 4, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(296, 1, 1, 'Necessitatibus amet facilis ut.', 'SLO-9e8bc9a9-070a-424b-9198-d85d2b5ce8b9', 'speaking', 'Fall', 'January', 'Easy', 'Knowledge', 'RRQ', 'Corrupti deserunt quis nesciunt nostrum error quae magnam vel adipisci corporis officiis.', 'Quo eos assumenda dolore aut laboriosam possimus eligendi explicabo earum.', 'culpa', 'impedit', 'minus', 'voluptatem', 'D', 'Voluptas ratione et non nam aut totam.', 'Eum nobis consequuntur est libero accusantium illo.', 'Nam sint expedita commodi sed exercitationem nesciunt molestias illum.', 5, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(297, 2, 2, 'Et sit.', 'SLO-b83d39ab-fd90-455e-9466-371340993740', 'reading', 'Spring', 'January', 'Medium', 'Practical', 'MCQ', 'Laboriosam qui nam ut aut qui rerum atque voluptas dolores.', 'Quas quos accusamus incidunt voluptatem dolor omnis.', 'corporis', 'porro', 'quam', 'architecto', 'C', 'Modi possimus error necessitatibus.', 'Aut occaecati corporis quibusdam aspernatur.', 'Asperiores nihil officia qui architecto at esse labore.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(298, 1, 1, 'Et iste voluptatum.', 'SLO-a2976944-0e89-4d5c-9bad-c0f3643793dd', 'reading', 'Spring', 'January', 'Hard', 'Practical', 'RRQ', 'Ut odit voluptatum eligendi cumque explicabo et repellendus.', 'Quam officia rerum quia molestiae minima deleniti recusandae aut.', 'quam', 'doloremque', 'deleniti', 'consequatur', 'A', 'Dolores in qui sunt.', 'Harum ea officia ea sint quasi.', 'Dicta est inventore sed. Minima hic error assumenda.', 6, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(299, 1, 1, 'Fuga ipsa ex.', 'SLO-79200248-d69d-4a5b-8a15-ebdeca18b324', 'lisning', 'Spring', 'January', 'Medium', 'Knowledge', 'MCQ', 'Optio aut voluptas dolore natus ipsum quis perferendis nam qui corrupti ex magnam saepe.', 'Neque illum magnam impedit est placeat cupiditate sapiente possimus placeat.', 'voluptatum', 'fugit', 'ullam', 'minus', 'C', 'Asperiores numquam et nobis quia qui.', 'Ut error omnis ut consequuntur.', 'Facilis accusantium voluptas animi atque quisquam iusto.', 7, '2025-11-14 07:05:14', '2025-11-14 07:05:14'),
(300, 1, 2, 'Nobis in magni laborum.', 'SLO-a95370cd-1acb-47aa-9432-7cfb7b63d0fa', 'speaking', 'Spring', 'February', 'Easy', 'Analysis', 'ERQ', 'Autem dolorem quod ut enim mollitia perspiciatis culpa ipsa sapiente et voluptatem quas.', 'Ipsam in ducimus totam vel delectus deserunt omnis.', 'occaecati', 'minus', 'asperiores', 'fugiat', 'A', 'Aperiam in tempora sapiente.', 'Sint illo est et.', 'Magni eum eius sed nihil ipsa voluptas quis a.', 8, '2025-11-14 07:05:14', '2025-11-14 07:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_11_073213_create_grades_table', 1),
(5, '2025_03_11_072905_create_districts_table', 1),
(6, '2025_04_11_073057_create_tehsils_table', 1),
(7, '2025_05_16_064818_create_subjects_table', 1),
(8, '2025_10_11_073333_create_schools_table', 1),
(9, '2025_10_11_073536_create_students_table', 1),
(10, '2025_10_11_125021_create_admins_table', 1),
(11, '2025_10_16_073542_create_item_banks_table', 1),
(12, '2025_10_21_061207_create_paper_formats_table', 1),
(13, '2025_10_21_073820_create_generated_papers_table', 1),
(14, '2025_10_27_070737_create_results_table', 1),
(15, '2025_11_09_083009_create_fee_formats_table', 1),
(16, '2025_12_09_085605_create_fee_records_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paper_formats`
--

CREATE TABLE `paper_formats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `paper_type` enum('formative','semester') NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `mcq_easy` int(11) NOT NULL DEFAULT 0,
  `mcq_medium` int(11) NOT NULL DEFAULT 0,
  `mcq_hard` int(11) NOT NULL DEFAULT 0,
  `fib_easy` int(11) NOT NULL DEFAULT 0,
  `fib_medium` int(11) NOT NULL DEFAULT 0,
  `fib_hard` int(11) NOT NULL DEFAULT 0,
  `rrq_easy` int(11) NOT NULL DEFAULT 0,
  `rrq_medium` int(11) NOT NULL DEFAULT 0,
  `rrq_hard` int(11) NOT NULL DEFAULT 0,
  `erq_easy` int(11) NOT NULL DEFAULT 0,
  `erq_medium` int(11) NOT NULL DEFAULT 0,
  `erq_hard` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paper_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `marks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`marks`)),
  `total_obtained` int(11) NOT NULL DEFAULT 0,
  `total_marks` int(11) NOT NULL DEFAULT 0,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emis_code` varchar(50) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_level` enum('Primary','Middle','High') NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `zone` enum('Summer Zone','Winter Zone') NOT NULL,
  `head_teacher_name` varchar(255) NOT NULL,
  `head_teacher_phone` varchar(20) NOT NULL,
  `number_of_teachers` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `emis_code`, `school_name`, `school_level`, `district_id`, `tehsil_id`, `zone`, `head_teacher_name`, `head_teacher_phone`, `number_of_teachers`, `email`, `password`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'EMIS-4271', 'Glover-Shanahan School', 'Middle', 1, 1, 'Summer Zone', 'Riley Schuster', '+1-414-936-7857', 7, 'xschuppe@example.com', '$2y$12$fqQOyBZhGc6R3l6SpnL5u.GiR6EwgSFjYYZzv8UHGI8DDKoGcM0gW', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(2, 'EMIS-4561', 'Howe-Prohaska School', 'Primary', 1, 1, 'Summer Zone', 'Gene Sipes', '1-408-243-5847', 12, 'von.tod@example.org', '$2y$12$Fq1NjMHwJqsD9cXge2iBJe2IOLtPNrQH.NCxcHdvVG5wwJrb570ZC', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(3, 'EMIS-3114', 'White-Braun School', 'High', 1, 1, 'Summer Zone', 'Alvera Will', '509.907.4947', 21, 'alexandra35@example.net', '$2y$12$.XlPcbM8PFsIbe6sXm008u0F5xq3/hJk5Qzu8pvMmh4wiT9W3UNDy', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(4, 'EMIS-5513', 'Friesen, Harvey and Mayert School', 'Middle', 1, 1, 'Winter Zone', 'Sabrina Ledner', '1-480-394-8679', 25, 'robin02@example.com', '$2y$12$0nbTVaEy.32Pm1mLugSCDObUegyBN9BzE.rNlWjF.U6.YxRF8cRkC', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(5, 'EMIS-5692', 'Thiel, Ankunding and Adams School', 'High', 1, 1, 'Winter Zone', 'Dr. Yolanda Conroy I', '+1-423-436-9542', 9, 'pierce55@example.net', '$2y$12$SH7YqXOR9EldY.SG2FV35e/uSbTXfg3BrYGmz8TNjM4wWx80C.CHq', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(6, 'EMIS-7804', 'McDermott Inc School', 'High', 1, 1, 'Summer Zone', 'Prof. Edd Haley', '1-706-829-3063', 21, 'mcarter@example.org', '$2y$12$3H7dbBHGVlRO2DfSRQWvD.MT9i0YZID0hLva5MYYfJtZF3Q6rRSrO', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(7, 'EMIS-1853', 'Prosacco-Casper School', 'Middle', 1, 1, 'Winter Zone', 'Adella Dickens', '(445) 762-4095', 12, 'eldora07@example.com', '$2y$12$Kcr4S2zbb6pYPGHmpl4wX.Nq3N8XxSR..JyHh3sDn3sivMhS1v40y', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(8, 'EMIS-4924', 'Kuhn and Sons School', 'Primary', 1, 1, 'Summer Zone', 'Harmon Cummings', '+1-440-290-4694', 15, 'crooks.enid@example.net', '$2y$12$U8E76DwzJED6O1KhXf0sbultqclKK45u9o665OIefjKke7DGmrPWa', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(9, 'EMIS-9818', 'Hamill, Hickle and Hirthe School', 'Primary', 1, 1, 'Summer Zone', 'Dr. May Howe IV', '1-330-427-3471', 5, 'glenda.luettgen@example.net', '$2y$12$ODz6uQt5h5EkwEivhxKYge/xDoFVZHgMjBwhOl98cyCGFYD4x3mo6', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(10, 'EMIS-6315', 'Renner-Daugherty School', 'Middle', 1, 1, 'Winter Zone', 'Dr. Leonor Block', '(225) 307-2453', 15, 'herzog.kacie@example.net', '$2y$12$yvlHDBv4Az5xSS3SECpCguYfDuns4dZsVpWd4aByBcCOkjyf5lkrG', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(11, 'EMIS-7845', 'Jacobson LLC School', 'Primary', 1, 1, 'Summer Zone', 'Christelle Marquardt', '(858) 663-2572', 15, 'fkohler@example.com', '$2y$12$loBDZOju.iMVJw6BUw/eiuvemG5ISqzwJjU2vpif6S8pJ0nN9PUXi', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(12, 'EMIS-8657', 'Towne Inc School', 'High', 1, 1, 'Summer Zone', 'Stephen Swaniawski', '+1.726.534.9556', 23, 'blanda.raegan@example.com', '$2y$12$XVDSFmrYerJJ01ZggUFlpeoO6u9VC7ltg2U3Vzkdu0pF8ek6asPja', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(13, 'EMIS-6827', 'Price, O\'Hara and Gorczany School', 'Primary', 1, 1, 'Winter Zone', 'Vena Corkery I', '+1-434-682-7026', 17, 'muhammad.wehner@example.com', '$2y$12$leYz03/vpLnf3CWppbLxcupwAI7bDGfr.yoN9U7VlNocNarvocRQO', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(14, 'EMIS-3240', 'Daugherty-Ryan School', 'High', 1, 1, 'Summer Zone', 'Thelma Lueilwitz', '248-347-9737', 5, 'ozella.bartoletti@example.org', '$2y$12$cfyAjuAvo62h190vlCX5X.b5Nw3hYI3jm71cRATGfhcCoFqwtv.I6', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(15, 'EMIS-8315', 'Daniel-Deckow School', 'High', 1, 1, 'Summer Zone', 'Dr. Enoch Terry PhD', '+1-786-432-6193', 18, 'alivia00@example.com', '$2y$12$oFiw1XYdwhHPSAMlXXbf6uK27RcKMtn7h.mXS.jU7wSjbD6zf0dbW', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(16, 'EMIS-4547', 'Von-Runolfsdottir School', 'High', 1, 1, 'Winter Zone', 'Miss Mittie Will', '319-557-3174', 20, 'lavon83@example.com', '$2y$12$isjkox1kAqwU8jOLltyo0ugbqRYxpbz3vzbWZV2xxL2kv8AH5ASC6', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(17, 'EMIS-7065', 'Terry Group School', 'High', 1, 1, 'Summer Zone', 'Natalia Gerlach', '508.428.8700', 16, 'tiara.runte@example.com', '$2y$12$Sd6hVEwdfzEI9I5iB8ocL.9edHpi8nAWQGLgA4figZB.QoCfqCEpi', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(18, 'EMIS-3464', 'Douglas, Mills and Corwin School', 'Middle', 1, 1, 'Winter Zone', 'Electa Rau', '1-754-876-3269', 12, 'mbrekke@example.org', '$2y$12$sbMqri5ntVsZdoXdgvLWIOiogp.kAXs0Ijdef2OgVgOSFiBeB8GV6', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(19, 'EMIS-3189', 'Kilback, Reichel and McCullough School', 'Primary', 1, 1, 'Winter Zone', 'Matilde Cormier', '(225) 633-4116', 21, 'eula.kreiger@example.org', '$2y$12$A00AQ5V9ymrdCUT8nDNNReB4nYymxnOxDDmupSBxaV15kJQdnsWKG', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(20, 'EMIS-8613', 'Rice, Durgan and Beatty School', 'Primary', 1, 1, 'Summer Zone', 'Agustin Koch', '1-838-327-9095', 10, 'grady.deangelo@example.com', '$2y$12$eEBycWbDIu3pQEBE5IuXCuiJ7IEntjo0QPxkUvn7y0YLNhDRTENQG', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL),
(21, '123456', 'Bitcoderlabs pvt ltd', 'High', 1, 1, 'Summer Zone', 'Shah Fahad', '0330 9520278', 10, 'shahfahad@gmail.com', '$2y$12$P9PvZXAf6JZ.1YGnOBrWLOApaJnXLzcB3LpWn24kNisU/26tbLCzG', 1, '2025-11-14 07:05:08', '2025-11-14 07:05:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('H5HfIOrvtzfTg4hUXBY4ot0Xz9dbhrNwGAqWxNs7', 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVldKUTEzWWtLWHBUd2YwcTVndkdiZzh1cWNrU2VtM3RtcWZEYm1HZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zY2hvb2wvZmVlLWZvcm1hdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUzOiJsb2dpbl9zY2hvb2xfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMTt9', 1763198455);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `birth_certificate_number` varchar(255) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive','graduated','transferred') NOT NULL DEFAULT 'active',
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `father_name`, `gender`, `date_of_birth`, `birth_certificate_number`, `current_address`, `permanent_address`, `phone_number`, `emergency_contact`, `section`, `grade_id`, `status`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Brandt Parisian', 'Mr. Hazel Howe MD', 'female', '2007-09-02', 'BC82692119', '814 Pacocha Stravenue\nMadelyntown, ME 95592', '8775 Mertz Road\nSouth Bo, WI 54964', '+1-567-841-3028', '814-390-0848', 'A', 1, 'active', 21, '2025-11-14 07:05:08', '2025-11-14 07:05:08'),
(2, 'Raphael Mueller', 'Henderson Hills', 'male', '1988-10-17', 'BC14672806', '6187 Tromp Garden Suite 764\nStantonberg, IL 43313', '78632 White Wall\nNorth Anjali, RI 83298', '1-564-326-3478', '+1-731-292-6634', 'C', 2, 'active', 20, '2025-11-14 07:05:08', '2025-11-14 07:05:08'),
(3, 'Ramona Wehner', 'Wallace Baumbach DDS', 'male', '1998-01-25', 'BC01141030', '970 Frieda Plains Suite 094\nPort Kelleyview, MA 13122', '64628 Paucek Forges\nLillianashire, MO 54034-1824', '(717) 615-6163', '+1 (870) 222-3214', 'A', 2, 'transferred', 18, '2025-11-14 07:05:08', '2025-11-14 07:05:08'),
(4, 'Matilde Leuschke', 'Aurelio Spencer V', 'male', '1971-05-26', 'BC58097522', '7481 West Forest Apt. 261\nLarsonburgh, WV 73880', '332 Renner Crossing Apt. 671\nFranciscaberg, IA 20661-0386', '1-602-349-8437', '+1-678-973-2050', 'D', 1, 'transferred', 14, '2025-11-14 07:05:08', '2025-11-14 07:05:08'),
(5, 'Jorge Bartell V', 'Dr. Mauricio Franecki', 'female', '2000-08-18', 'BC12088189', '541 Bonnie Gateway\nEast Adell, TX 31133', '899 Chauncey Flat Apt. 364\nCristshire, KY 43255-1491', '+1-445-914-0663', '+15202846749', 'D', 2, 'graduated', 19, '2025-11-14 07:05:08', '2025-11-14 07:05:08'),
(6, 'bitcoder student', 'bitcoder student', 'male', '2025-11-16', '234283947234238', 'bitcoder student', 'bitcoder student', 'bitcoder student', 'bitcoder student', 'A', 1, 'active', 21, '2025-11-14 07:15:58', '2025-11-14 07:15:58'),
(7, 'bitcoder 2', 'bitcoder 2', 'female', '2025-11-21', '234283947234238', 'Shabqadar district charsadda kpk', 'bitcoder 2', '03309520278', '0324823048', 'A', 2, 'active', 21, '2025-11-14 11:41:23', '2025-11-14 11:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'English', 'SUB-EN', 'Covers grammar, comprehension, and writing skills.', '2025-11-14 07:05:08', '2025-11-14 07:05:08'),
(2, 'Computer Science', 'SUB-CS', 'Teaches programming, data structures, and algorithms.', '2025-11-14 07:05:08', '2025-11-14 07:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `tehsils`
--

CREATE TABLE `tehsils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tehsils`
--

INSERT INTO `tehsils` (`id`, `district_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 10, 'Creminfurt', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(2, 10, 'North Lloyd', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(3, 6, 'East Jonatanchester', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(4, 15, 'East Abigale', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(5, 15, 'West Camryn', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(6, 3, 'Liafurt', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(7, 10, 'Lednerburgh', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(8, 5, 'Tristianstad', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(9, 8, 'Janiyaland', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(10, 6, 'South Rudolphfurt', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(11, 18, 'Darleneton', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(12, 3, 'Jamisonborough', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(13, 6, 'Judeborough', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(14, 20, 'Treverfort', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(15, 16, 'Lake Kamren', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(16, 16, 'East Grace', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(17, 6, 'Venamouth', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(18, 10, 'North Melisaview', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(19, 18, 'Lake Evetown', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(20, 2, 'Schulistport', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(21, 19, 'Queenieport', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(22, 20, 'Morarshire', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(23, 20, 'Boscofurt', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(24, 9, 'Josefinaland', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(25, 5, 'South Layne', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(26, 1, 'North Ashtynchester', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(27, 16, 'Runolfsdottirberg', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(28, 2, 'East Tatyana', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(29, 7, 'East Jasonfurt', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(30, 10, 'North Dandrechester', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(31, 15, 'East Maurine', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(32, 9, 'Harrisview', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(33, 8, 'East Claud', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(34, 1, 'North Emmaleebury', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(35, 16, 'Augustusbury', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(36, 7, 'Keeblerburgh', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(37, 9, 'Armstrongmouth', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(38, 12, 'Carterport', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(39, 6, 'Malindachester', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(40, 14, 'Lednermouth', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(41, 20, 'North Ellenville', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(42, 11, 'North Trenton', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(43, 13, 'West Abdielview', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(44, 6, 'West Larueton', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(45, 4, 'Marcelinafort', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(46, 1, 'South Jovanny', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(47, 6, 'Lake Abe', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(48, 18, 'East Kaseyton', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(49, 9, 'Cristview', '2025-11-14 07:05:00', '2025-11-14 07:05:00'),
(50, 20, 'Coltonfort', '2025-11-14 07:05:00', '2025-11-14 07:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fee_formats`
--
ALTER TABLE `fee_formats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_formats_school_id_foreign` (`school_id`),
  ADD KEY `fee_formats_class_id_foreign` (`class_id`);

--
-- Indexes for table `fee_records`
--
ALTER TABLE `fee_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_records_school_id_foreign` (`school_id`),
  ADD KEY `fee_records_student_id_foreign` (`student_id`),
  ADD KEY `fee_records_class_id_foreign` (`class_id`);

--
-- Indexes for table `generated_papers`
--
ALTER TABLE `generated_papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generated_papers_district_id_foreign` (`district_id`),
  ADD KEY `generated_papers_grade_id_foreign` (`grade_id`),
  ADD KEY `generated_papers_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grades_name_unique` (`name`);

--
-- Indexes for table `item_banks`
--
ALTER TABLE `item_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_banks_subject_id_foreign` (`subject_id`),
  ADD KEY `item_banks_grade_id_foreign` (`grade_id`);

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
-- Indexes for table `paper_formats`
--
ALTER TABLE `paper_formats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `results_paper_id_student_id_unique` (`paper_id`,`student_id`),
  ADD KEY `results_student_id_foreign` (`student_id`),
  ADD KEY `results_school_id_foreign` (`school_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_emis_code_unique` (`emis_code`),
  ADD KEY `schools_district_id_foreign` (`district_id`),
  ADD KEY `schools_tehsil_id_foreign` (`tehsil_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_grade_id_foreign` (`grade_id`),
  ADD KEY `students_school_id_foreign` (`school_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_name_unique` (`name`);

--
-- Indexes for table `tehsils`
--
ALTER TABLE `tehsils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tehsils_district_id_foreign` (`district_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_formats`
--
ALTER TABLE `fee_formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fee_records`
--
ALTER TABLE `fee_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `generated_papers`
--
ALTER TABLE `generated_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_banks`
--
ALTER TABLE `item_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paper_formats`
--
ALTER TABLE `paper_formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tehsils`
--
ALTER TABLE `tehsils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fee_formats`
--
ALTER TABLE `fee_formats`
  ADD CONSTRAINT `fee_formats_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_formats_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_records`
--
ALTER TABLE `fee_records`
  ADD CONSTRAINT `fee_records_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_records_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_records_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `generated_papers`
--
ALTER TABLE `generated_papers`
  ADD CONSTRAINT `generated_papers_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `generated_papers_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `generated_papers_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_banks`
--
ALTER TABLE `item_banks`
  ADD CONSTRAINT `item_banks_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_banks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_paper_id_foreign` FOREIGN KEY (`paper_id`) REFERENCES `generated_papers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `schools_tehsil_id_foreign` FOREIGN KEY (`tehsil_id`) REFERENCES `tehsils` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tehsils`
--
ALTER TABLE `tehsils`
  ADD CONSTRAINT `tehsils_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
