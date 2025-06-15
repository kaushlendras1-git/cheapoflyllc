-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 05:29 PM
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
-- Database: `cheapoflyllc`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_statuses`
--

CREATE TABLE `booking_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_statuses`
--

INSERT INTO `booking_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Under Process', 1, NULL, NULL),
(2, 'Complete', 1, NULL, NULL);

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
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `pnr` varchar(20) NOT NULL,
  `chkflight` tinyint(1) NOT NULL DEFAULT 0,
  `chkhotel` tinyint(1) NOT NULL DEFAULT 0,
  `chkcruise` tinyint(1) NOT NULL DEFAULT 0,
  `chkcar` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `team` varchar(255) DEFAULT NULL,
  `campaign` varchar(50) NOT NULL,
  `reservation_source` varchar(255) NOT NULL,
  `call_type` varchar(255) NOT NULL,
  `call_converted` tinyint(1) NOT NULL DEFAULT 0,
  `followup_date` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`id`, `user`, `pnr`, `chkflight`, `chkhotel`, `chkcruise`, `chkcar`, `phone`, `name`, `team`, `campaign`, `reservation_source`, `call_type`, `call_converted`, `followup_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 0, '', 1, 1, 1, 1, '+1 (919) 719-3769', 'Violet Guthrie', NULL, 'Agency', 'Eaque tenetur rem id', 'Customer Service', 1, NULL, 'Quia esse quia deser', '2025-04-24 14:09:00', '2025-04-24 14:09:00'),
(2, 0, '', 1, 1, 1, 1, '+1 (887) 708-2612', 'Rylee Alford', NULL, 'Agency', 'Omnis animi iste qu', 'Customer Service', 0, NULL, 'In ratione hic molli', '2025-04-24 14:13:23', '2025-04-24 14:13:23'),
(3, 0, '', 1, 1, 0, 0, '+1 (821) 981-6548', 'Ulla Norton', NULL, 'Agency', 'Voluptates vitae tem', 'Customer Service', 0, NULL, 'Praesentium voluptat', '2025-04-24 14:15:39', '2025-04-24 14:15:39'),
(4, 0, '', 0, 1, 1, 0, '+1 (386) 542-3003', 'Ora Collier', NULL, 'Agency', 'Labore illo natus te', 'Customer Service', 0, NULL, 'Deserunt dolorem mol', '2025-04-24 14:19:10', '2025-04-24 14:19:10'),
(5, 0, '', 0, 0, 1, 1, '+1 (693) 752-9674', 'Michael Dickerson', NULL, 'Agency', 'In voluptatem Repre', 'Customer Service', 1, NULL, 'Quaerat eius esse c', '2025-04-24 14:21:52', '2025-04-24 14:21:52'),
(6, 0, '', 0, 1, 0, 1, '+1 (513) 482-5433', 'Keefe Carr', NULL, 'Agency', 'Aut culpa impedit', 'Customer Service', 0, NULL, 'Nulla delectus mini', '2025-04-24 14:22:14', '2025-04-24 14:22:14'),
(7, 1, '', 1, 0, 1, 0, '+1 (975) 359-8249', 'Chloe May', NULL, 'Agency', 'Rerum eum sit earum', 'Customer Service', 1, NULL, 'Vitae hic dolore sit', '2025-04-24 14:40:17', '2025-04-24 14:40:17'),
(8, 1, '', 1, 1, 1, 1, '+1 (644) 317-9572', 'Wilma Moody', NULL, 'Agency', 'In nulla cillum labo', 'Customer Service', 0, NULL, 'Iusto dolor quis quo', '2025-04-24 14:53:21', '2025-04-24 14:53:21'),
(9, 1, '', 1, 1, 0, 1, '+1 (836) 912-5479', 'Wanda Patel', NULL, 'Agency', 'Adipisicing totam cu', 'Customer Service', 0, NULL, 'Saepe qui et et anim', '2025-04-24 15:19:25', '2025-04-24 15:19:25'),
(10, 1, '', 1, 1, 1, 1, '+1 (678) 364-9033', 'Christopher Douglas', NULL, 'Company Id', 'Laborum culpa sit e', 'Sale', 1, NULL, 'At adipisicing non d', '2025-04-24 17:20:58', '2025-04-24 17:20:58'),
(11, 1, '', 1, 1, 1, 1, '+1 (124) 809-1766', 'Fritz Malone', NULL, 'Airline Mix', 'Optio nihil qui tot', 'Changes (date/time/name changes)', 0, NULL, 'Sit quam sit error', '2025-04-24 17:22:15', '2025-04-24 17:22:15'),
(12, 1, 'SPA1000000012', 0, 0, 1, 1, '+1 (349) 541-9043', 'Christine Finch', NULL, 'Spanish', 'Sunt magna veniam p', 'Spam-Blank', 0, NULL, 'Porro nesciunt enim', '2025-04-25 00:03:39', '2025-04-25 00:03:39'),
(13, 1, 'COM1000000013', 0, 1, 1, 1, '+1 (652) 933-1468', 'Kareem Galloway', NULL, 'Company Id', 'Magna corporis sunt', 'Sale', 0, NULL, 'Non voluptate ex vel', '2025-04-25 00:09:25', '2025-04-25 00:09:25'),
(14, 1, 'BUF1000000014', 1, 0, 1, 0, '18943588146', 'Mark Elliott', NULL, 'Buffer Mix', 'Sed corrupti at bea', 'Changes (date/time/name changes)', 0, NULL, 'Voluptas voluptates', '2025-04-25 01:07:10', '2025-04-25 01:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `call_types`
--

CREATE TABLE `call_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_types`
--

INSERT INTO `call_types` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Customer Service (Baggage, Wheelchair etc..)', 'Customer Service', 1, NULL, NULL),
(2, 'Wrong number (other than the airlines calls)', 'Wrong number', 1, NULL, NULL),
(3, 'Fare Enquiry', 'Fare Enquiry', 1, NULL, NULL),
(4, 'Changes', 'Changes (date/time/name changes)', 1, NULL, NULL),
(5, 'Cancellation', 'Cancellation', 1, NULL, NULL),
(6, 'Spam-Manual', 'Spam-Manual', 1, NULL, NULL),
(7, 'Spam-Blank', 'Spam-Blank', 1, NULL, NULL),
(8, 'Sale', 'Sale', 1, NULL, NULL),
(9, 'Spanish', 'Spanish', 1, NULL, NULL),
(10, 'Existing', 'Existing', 1, NULL, NULL),
(11, 'FollowUp', 'Follow Up', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Airline Mix', 0, NULL, '2025-04-27 18:02:06'),
(3, 'Buffer Mix', 1, NULL, NULL),
(4, 'Cruise', 1, NULL, NULL),
(5, 'International', 1, NULL, NULL),
(6, 'LCC', 1, NULL, NULL),
(7, 'Major Mix', 1, NULL, NULL),
(8, 'Spanish', 1, NULL, NULL),
(11, 'Addison Bradley', 0, '2025-04-27 18:04:03', '2025-04-27 18:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'flydreamz', 'flydreamz', NULL, NULL),
(2, 'cruiseroyals', 'cruiseroyals', NULL, NULL),
(3, 'fareticketsllc', 'fareticketsllc', NULL, NULL),
(4, 'fareticketsus', 'fareticketsus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Boarding Pass', 'Thank you for contacting Reservation Desk!', 'fdsgdfsgfdgdfgdf', NULL, '2025-04-27 17:32:02'),
(2, 'eTicket', 'Thank you for contacting Reservation Desk!', 'bgfg gsdgdfgfd', NULL, '2025-04-27 17:31:12'),
(3, 'Exchanges', 'Thank you for contacting Reservation Desk!	', '', NULL, NULL),
(4, 'Cancellation', 'Thank you for contacting Reservation Desk!	', '', NULL, NULL),
(5, 'Confirmation', 'Thank you for contacting Reservation Desk!	', '', NULL, NULL),
(8, 'Kylan Dejesus', 'Deserunt qui enim qu', 'Laborum Maiores vol', '2025-04-27 17:18:26', '2025-04-27 17:18:26'),
(9, 'Anastasia Gutierrez', 'Esse quia labore vit', 'Est exercitation dol', '2025-04-27 17:18:51', '2025-04-27 17:18:51'),
(10, 'Alexandra Soto', 'Sed quia animi expe', 'Hic exercitation occ', '2025-04-27 17:19:17', '2025-04-27 17:19:17'),
(11, 'Garrett Hoover', 'Laborum perferendis', 'Necessitatibus in ei', '2025-04-27 17:20:19', '2025-04-27 17:20:19');

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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `log_type` varchar(30) NOT NULL,
  `opration` varchar(20) NOT NULL,
  `comment` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, '2025_04_09_205250_create_statuses_table', 2),
(5, '2025_04_09_205251_create_suppliers_table', 2),
(6, '2025_04_09_205252_create_qualities_table', 2),
(7, '2025_04_09_205253_create_teams_table', 2),
(8, '2025_04_09_205254_create_campaigns_table', 2),
(9, '2025_04_09_205255_create_call_types_table', 2),
(10, '2025_04_09_205256_create_quality_feedbacks_table', 2),
(11, '2025_04_09_205257_create_booking_statuses_table', 2),
(12, '2025_04_09_205257_create_query_types_table', 2),
(13, '2025_04_09_205258_create_payment_statuses_table', 2),
(14, '2025_04_09_210530_add_value_to_query_types_table', 3),
(15, '2025_04_09_212632_create_companies_table', 4),
(16, '2025_04_09_221722_create_call_logs_table', 5);

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
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE `qualities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quality_feedbacks`
--

CREATE TABLE `quality_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quality_feedbacks`
--

INSERT INTO `quality_feedbacks` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Probing & Understanding', 1, NULL, NULL),
(2, 'Dead air/Hold procedure', 1, NULL, NULL),
(3, 'Soft Skills', 1, NULL, NULL),
(4, 'Active Listening/Interruption', 1, NULL, NULL),
(5, 'Call Handling', 1, NULL, NULL),
(6, 'Selling Skills', 1, NULL, NULL),
(7, 'Cross Selling', 1, NULL, NULL),
(8, 'Documentation', 1, NULL, NULL),
(9, 'Disposition', 1, NULL, NULL),
(10, 'Call Closing', 1, NULL, NULL),
(11, 'Fatal - Misrepresentation', 1, NULL, NULL),
(12, 'Fatal - Rude/Sarcastic behaviour', 1, NULL, NULL),
(13, 'Fatal - Unethical sale', 1, NULL, NULL),
(14, 'Paraphrasing', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `query_types`
--

CREATE TABLE `query_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `query_types`
--

INSERT INTO `query_types` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Booking', 'N', 1, NULL, NULL),
(2, 'New Booking (Credit)', 'NC', 1, NULL, NULL),
(3, 'Air Miles', 'M', 1, NULL, NULL),
(4, 'Cancel (Credit)', 'CC', 1, NULL, NULL),
(5, 'Cancel (Refund)', 'CR', 1, NULL, NULL),
(6, 'Change', 'CH', 1, NULL, NULL),
(7, 'Upgrade', 'U', 1, NULL, NULL),
(8, 'Name Correction', 'NMC', 1, NULL, NULL),
(9, 'Seat Assignment', 'S', 1, NULL, NULL),
(10, 'Baggage Addition', 'B', 1, NULL, NULL);

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
('Bckl5P0aHle6jQK24Tf56gEUmPXA66ahnJehE0OO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSVY3bDRad2Rrc3hFV25pYk1TQzgwVVBwWE9MV3hoZUZ1bkNDcWpxYiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1745805080);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'flydreamz', 1, NULL, '2025-04-27 17:44:02'),
(2, 'fareticketsllc', 1, NULL, NULL),
(3, 'fareticketsus', 1, NULL, NULL),
(5, 'vxbvcxbcvbvcb', 0, '2025-04-27 17:41:32', '2025-04-27 17:41:32'),
(6, 'Tamekah Craig', 1, '2025-04-27 17:49:24', '2025-04-27 17:49:39'),
(7, 'Calll Type', 0, '2025-04-27 18:54:40', '2025-04-27 18:54:40'),
(8, 'dsdsdsds', 0, '2025-04-27 18:55:43', '2025-04-27 18:55:43');

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
  `status` tinyint(4) NOT NULL,
  `role` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `role`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$XoVEIFSeOdrD.E7SW.JtveKCRx9oXU1rCdqVkrX.NoXG1GLvldk62', 'LjmK85ZkLvZUKTR0rbkNcVfPrmlRhV4yWGNRQSo002V7aTHZ07C3vABXZWSS', 1, 'admin', '2025-04-24 13:05:20', '2025-04-24 13:05:20', '0'),
(3, 'Theodore Santana', 'fibewul@mailinator.com', NULL, '$2y$12$CZpk0JpfGwlB02sRL3bklupsoNrWQiDIr7O0lIRK6pDvIFuWHOY/6', NULL, 1, 'author', '2025-04-26 09:11:20', '2025-04-26 09:11:20', '8524101256');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_types`
--
ALTER TABLE `call_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
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
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quality_feedbacks`
--
ALTER TABLE `quality_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query_types`
--
ALTER TABLE `query_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `call_types`
--
ALTER TABLE `call_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quality_feedbacks`
--
ALTER TABLE `quality_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `query_types`
--
ALTER TABLE `query_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
