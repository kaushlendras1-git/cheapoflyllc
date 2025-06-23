-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2025 at 03:51 AM
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
  `chkflight` tinyint(1) NOT NULL DEFAULT 0,
  `chkhotel` tinyint(1) NOT NULL DEFAULT 0,
  `chkcruise` tinyint(1) NOT NULL DEFAULT 0,
  `chkcar` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `team` varchar(255) NOT NULL,
  `campaign` varchar(255) NOT NULL,
  `reservation_source` varchar(255) NOT NULL,
  `call_type` varchar(255) NOT NULL,
  `call_converted` tinyint(1) NOT NULL DEFAULT 0,
  `followup_date` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `call_types`
--

CREATE TABLE `call_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` char(2) NOT NULL,
  `calling_code` varchar(10) NOT NULL,
  `currency_code` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `country_code`, `calling_code`, `currency_code`) VALUES
(1, 'Afghanistan', 'AF', '+93', 'AFN'),
(2, 'Albania', 'AL', '+355', 'ALL'),
(3, 'Algeria', 'DZ', '+213', 'DZD'),
(4, 'Andorra', 'AD', '+376', 'EUR'),
(5, 'Angola', 'AO', '+244', 'AOA'),
(6, 'Argentina', 'AR', '+54', 'ARS'),
(7, 'Armenia', 'AM', '+374', 'AMD'),
(8, 'Australia', 'AU', '+61', 'AUD'),
(9, 'Austria', 'AT', '+43', 'EUR'),
(10, 'Azerbaijan', 'AZ', '+994', 'AZN'),
(11, 'Bahamas', 'BS', '+1-242', 'BSD'),
(12, 'Bahrain', 'BH', '+973', 'BHD'),
(13, 'Bangladesh', 'BD', '+880', 'BDT'),
(14, 'Barbados', 'BB', '+1-246', 'BBD'),
(15, 'Belarus', 'BY', '+375', 'BYN'),
(16, 'Belgium', 'BE', '+32', 'EUR'),
(17, 'Belize', 'BZ', '+501', 'BZD'),
(18, 'Benin', 'BJ', '+229', 'XOF'),
(19, 'Bhutan', 'BT', '+975', 'BTN'),
(20, 'Bolivia', 'BO', '+591', 'BOB'),
(21, 'Bosnia and Herzegovina', 'BA', '+387', 'BAM'),
(22, 'Botswana', 'BW', '+267', 'BWP'),
(23, 'Brazil', 'BR', '+55', 'BRL'),
(24, 'Brunei', 'BN', '+673', 'BND'),
(25, 'Bulgaria', 'BG', '+359', 'BGN'),
(26, 'Burkina Faso', 'BF', '+226', 'XOF'),
(27, 'Burundi', 'BI', '+257', 'BIF'),
(28, 'Cambodia', 'KH', '+855', 'KHR'),
(29, 'Cameroon', 'CM', '+237', 'XAF'),
(30, 'Canada', 'CA', '+1', 'CAD'),
(31, 'Chile', 'CL', '+56', 'CLP'),
(32, 'China', 'CN', '+86', 'CNY'),
(33, 'Colombia', 'CO', '+57', 'COP'),
(34, 'Costa Rica', 'CR', '+506', 'CRC'),
(35, 'Croatia', 'HR', '+385', 'HRK'),
(36, 'Cuba', 'CU', '+53', 'CUP'),
(37, 'Cyprus', 'CY', '+357', 'EUR'),
(38, 'Czech Republic', 'CZ', '+420', 'CZK'),
(39, 'Denmark', 'DK', '+45', 'DKK'),
(40, 'Djibouti', 'DJ', '+253', 'DJF'),
(41, 'Dominica', 'DM', '+1-767', 'XCD'),
(42, 'Dominican Republic', 'DO', '+1-809, +1', 'DOP'),
(43, 'Ecuador', 'EC', '+593', 'USD'),
(44, 'Egypt', 'EG', '+20', 'EGP'),
(45, 'El Salvador', 'SV', '+503', 'USD'),
(46, 'Estonia', 'EE', '+372', 'EUR'),
(47, 'Eswatini', 'SZ', '+268', 'SZL'),
(48, 'Ethiopia', 'ET', '+251', 'ETB'),
(49, 'Fiji', 'FJ', '+679', 'FJD'),
(50, 'Finland', 'FI', '+358', 'EUR'),
(51, 'France', 'FR', '+33', 'EUR'),
(52, 'Gabon', 'GA', '+241', 'XAF'),
(53, 'Gambia', 'GM', '+220', 'GMD'),
(54, 'Georgia', 'GE', '+995', 'GEL'),
(55, 'Germany', 'DE', '+49', 'EUR'),
(56, 'Ghana', 'GH', '+233', 'GHS'),
(57, 'Greece', 'GR', '+30', 'EUR'),
(58, 'Grenada', 'GD', '+1-473', 'XCD'),
(59, 'Guatemala', 'GT', '+502', 'GTQ'),
(60, 'Guinea', 'GN', '+224', 'GNF'),
(61, 'Guinea-Bissau', 'GW', '+245', 'XOF'),
(62, 'Guyana', 'GY', '+592', 'GYD'),
(63, 'Haiti', 'HT', '+509', 'HTG'),
(64, 'Honduras', 'HN', '+504', 'HNL'),
(65, 'Hungary', 'HU', '+36', 'HUF'),
(66, 'Iceland', 'IS', '+354', 'ISK'),
(67, 'India', 'IN', '+91', 'INR'),
(68, 'Indonesia', 'ID', '+62', 'IDR'),
(69, 'Iran', 'IR', '+98', 'IRR'),
(70, 'Iraq', 'IQ', '+964', 'IQD'),
(71, 'Ireland', 'IE', '+353', 'EUR'),
(72, 'Israel', 'IL', '+972', 'ILS'),
(73, 'Italy', 'IT', '+39', 'EUR'),
(74, 'Jamaica', 'JM', '+1-876', 'JMD'),
(75, 'Japan', 'JP', '+81', 'JPY'),
(76, 'Jordan', 'JO', '+962', 'JOD'),
(77, 'Kazakhstan', 'KZ', '+7', 'KZT'),
(78, 'Kenya', 'KE', '+254', 'KES'),
(79, 'Kiribati', 'KI', '+686', 'AUD'),
(80, 'Korea (North)', 'KP', '+850', 'KPW'),
(81, 'Korea (South)', 'KR', '+82', 'KRW'),
(82, 'Kuwait', 'KW', '+965', 'KWD'),
(83, 'Kyrgyzstan', 'KG', '+996', 'KGS'),
(84, 'Laos', 'LA', '+856', 'LAK'),
(85, 'Latvia', 'LV', '+371', 'EUR'),
(86, 'Lebanon', 'LB', '+961', 'LBP'),
(87, 'Lesotho', 'LS', '+266', 'LSL'),
(88, 'Liberia', 'LR', '+231', 'LRD'),
(89, 'Libya', 'LY', '+218', 'LYD'),
(90, 'Liechtenstein', 'LI', '+423', 'CHF'),
(91, 'Lithuania', 'LT', '+370', 'EUR'),
(92, 'Luxembourg', 'LU', '+352', 'EUR'),
(93, 'Madagascar', 'MG', '+261', 'MGA'),
(94, 'Malawi', 'MW', '+265', 'MWK'),
(95, 'Malaysia', 'MY', '+60', 'MYR'),
(96, 'Maldives', 'MV', '+960', 'MVR'),
(97, 'Mali', 'ML', '+223', 'XOF'),
(98, 'Malta', 'MT', '+356', 'EUR');

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
  `operation` varchar(20) NOT NULL,
  `calllog_id` varchar(20) NOT NULL,
  `comment` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_type`, `operation`, `calllog_id`, `comment`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'CallLog', 'Viewed', '14', 'You have seen the call log', 1, '2025-05-05 19:07:24', '0000-00-00 00:00:00'),
(2, 'CallLog', 'Viewed', '14', 'You have seen the call log', 1, '2025-05-04 19:07:46', '2025-05-04 19:07:46'),
(3, 'CallLog', 'created', '15', 'Call Log created successfully', 1, '2025-05-04 19:21:10', '2025-05-04 19:21:10'),
(4, 'CallLog', 'created', '16', 'Call Log created successfully', 1, '2025-05-05 07:35:47', '2025-05-05 07:35:47'),
(5, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:35:00', '2025-05-05 08:35:00'),
(6, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:35:06', '2025-05-05 08:35:06'),
(7, 'CallLog', 'Updated', '16', 'Field \'team\' updated from \'\' to \'flydreamz\'', 1, '2025-05-05 08:35:15', '2025-05-05 08:35:15'),
(8, 'CallLog', 'Updated', '16', 'Field \'call_converted\' updated from \'1\' to \'0\'', 1, '2025-05-05 08:35:15', '2025-05-05 08:35:15'),
(9, 'CallLog', 'Updated', '16', 'Field \'followup_date\' updated from \'2025-05-05 09:35:00\' to \'\'', 1, '2025-05-05 08:35:15', '2025-05-05 08:35:15'),
(10, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:35:15', '2025-05-05 08:35:15'),
(11, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:37:17', '2025-05-05 08:37:17'),
(12, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:37:32', '2025-05-05 08:37:32'),
(13, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:37:37', '2025-05-05 08:37:37'),
(14, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:37:39', '2025-05-05 08:37:39'),
(15, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:38:36', '2025-05-05 08:38:36'),
(16, 'CallLog', 'Updated', '16', 'Field \'team\' updated from \'flydreamz\' to \'Tamekah Craig\'', 1, '2025-05-05 08:38:42', '2025-05-05 08:38:42'),
(17, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:38:42', '2025-05-05 08:38:42'),
(18, 'CallLog', 'Viewed', '16', 'You have seen the call log', 1, '2025-05-05 08:39:56', '2025-05-05 08:39:56'),
(19, 'CallLog', 'created', '17', 'Call Log created successfully', 1, '2025-05-17 14:27:34', '2025-05-17 14:27:34'),
(20, 'CallLog', 'created', '18', 'Call Log created successfully', 1, '2025-05-17 14:32:02', '2025-05-17 14:32:02'),
(21, 'CallLog', 'Viewed', '17', 'You have seen the call log', 1, '2025-05-17 14:32:24', '2025-05-17 14:32:24'),
(22, 'CallLog', 'Viewed', '17', 'You have seen the call log', 1, '2025-06-16 17:52:35', '2025-06-16 17:52:35'),
(23, 'CallLog', 'Viewed', '18', 'You have seen the call log', 1, '2025-06-18 15:56:36', '2025-06-18 15:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(23, '0001_01_01_000000_create_users_table', 1),
(24, '0001_01_01_000001_create_cache_table', 1),
(25, '0001_01_01_000002_create_jobs_table', 1),
(26, '2025_04_09_205250_create_statuses_table', 1),
(27, '2025_04_09_205251_create_suppliers_table', 1),
(28, '2025_04_09_205252_create_qualities_table', 1),
(29, '2025_04_09_205253_create_teams_table', 1),
(30, '2025_04_09_205254_create_campaigns_table', 1),
(31, '2025_04_09_205255_create_call_types_table', 1),
(32, '2025_04_09_205256_create_quality_feedbacks_table', 1),
(33, '2025_04_09_205257_create_booking_statuses_table', 1),
(34, '2025_04_09_205257_create_query_types_table', 1),
(35, '2025_04_09_205258_create_payment_statuses_table', 1),
(36, '2025_04_09_210530_add_value_to_query_types_table', 1),
(37, '2025_04_09_212632_create_companies_table', 1),
(38, '2025_04_09_221722_create_call_logs_table', 1),
(39, '2025_04_26_121136_create_members_table', 1),
(40, '2025_06_21_203407_create_travel_flight_details_table', 1),
(41, '2025_06_21_203415_create_travel_car_details_table', 1),
(42, '2025_06_21_203419_create_travel_cruise_details_table', 1),
(43, '2025_06_21_203424_create_travel_hotel_details_table', 1),
(44, '2025_06_21_203432_create_travel_train_details_table', 1);

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
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_billing_details`
--

CREATE TABLE `travel_billing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `cc_number` varchar(255) DEFAULT NULL,
  `cc_holder_name` varchar(255) DEFAULT NULL,
  `exp_month` varchar(2) DEFAULT NULL,
  `exp_year` varchar(4) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `currency` varchar(255) DEFAULT 'USD',
  `amount` decimal(10,2) DEFAULT 0.00,
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travel_billing_details`
--

INSERT INTO `travel_billing_details` (`id`, `booking_id`, `card_type`, `cc_number`, `cc_holder_name`, `exp_month`, `exp_year`, `cvv`, `address`, `email`, `contact_no`, `city`, `country`, `state`, `zip_code`, `currency`, `amount`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, 27, 'VISA', 'eyJpdiI6ImVUOFpLSCt3S090YWY3dmNmblFJR1E9PSIsInZhbHVlIjoiWjJaUHk4SktrVHlHZUNVdGR5UWtNUT09IiwibWFjIjoiODdiOTcxNDlkNjQ1M2VjZmVhZWFkNjFjODgxZTY4ZWVhNjMxYTMzZTRhZTdkNzdmNDk4MGU2ZjBmYWU3YjJiYyIsInRhZyI6IiJ9', '2', '01', '2025', 'eyJpdiI6Im5IM3l3dUUrRXE4T3JhTnNidWNkYXc9PSIsInZhbHVlIjoiMGpiK0tuZEFnSnBoS2RRTFNhUFhLZz09IiwibWFjIjoiNDNjNTFjNjkxNjM5Y2ExOWE5ODJjY2NiZTUwMGY0ZTc2ZGY5Mjc4YTlhNDRhYWYxZjIzMGQyNTY4N2QyNGI3YiIsInRhZyI6IiJ9', '3', '3@teet.com', '12', '12', 'Afghanistan', NULL, '21', 'USD', 2300.00, 0, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(55, 27, NULL, 'eyJpdiI6Ii9oMjMwdVUxOURueS9ZbnBzOWFDbmc9PSIsInZhbHVlIjoieER0VkN2dmlWREpRQ3o0Vmc2TmdIUT09IiwibWFjIjoiZTNiYzk2YjFlN2FiNGM2ZTAyODFkZjI2YTNlMTI0ZDljMDhjZmQyNDMyOTQyMWNmNzc3M2M2OThjYmU4N2IzNSIsInRhZyI6IiJ9', '23', '01', '2025', 'eyJpdiI6Im9uRldKektmRHpOQkRtWWFuYnBBOWc9PSIsInZhbHVlIjoiZHpLbGdOa0NxTXMreGVPRnI1QzhHQT09IiwibWFjIjoiZTlhZDJiMmIxMjExZGY0NDkxYjg0OGVkMjQ3NjEwMDQxNzcwZDU2ZjhmMTBlZTY2YzhjZDIwOTA1NWQxZDE1ZSIsInRhZyI6IiJ9', '3232', '32@gmail.com', '56', '56', '56', '56', '56', 'CAD', 0.00, 0, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(56, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(57, 27, 'VISA', 'eyJpdiI6ImIwSi80UHp5bDdUdlpuT3RyK29xTWc9PSIsInZhbHVlIjoiSGZDcGRqREJ6M1EwaWIrSFdHZGo2UT09IiwibWFjIjoiMjgzMWQwNzRkOWQwZDc4MzhlYjI0YjdmNDY3OTYyMjk1YWYzOTI2MjRlODY0Mzc4MDYxYzYxODAyOTlmZDZlNSIsInRhZyI6IiJ9', '2', '01', '2025', 'eyJpdiI6IkgrcjJ2M25MSlIwYUNOazM0TlNoTWc9PSIsInZhbHVlIjoiVWEvTDRMVkVXQkNkVkVwTFJYWDhVdz09IiwibWFjIjoiZjQ0ODI0M2IxMjlkODE1NDI5ZjcxNzVmZjY1YWU4NWM3ZjBkOTQ1MTM3YTI4N2YzZjYwOTlkNDY4Y2ZmYmI4NyIsInRhZyI6IiJ9', '3', '3@teet.com', '12', '12', 'Afghanistan', NULL, '21', 'USD', 2300.00, 0, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(58, 27, NULL, 'eyJpdiI6IllyUXc0U2k0VGNmSXJxcFdkQ2s2Ymc9PSIsInZhbHVlIjoiM1hQcVZla1N3MnUrZmJRNWVNZUc1UT09IiwibWFjIjoiMTgxM2M0ZDc1ZmJiYmVhMDAyYWFhMmJkYjJhMzJkNmNiYzMzNmU5YTc3ODdmNmI2YjY2YzhmMzExOTViM2VlNiIsInRhZyI6IiJ9', '23', '01', '2025', 'eyJpdiI6InBaNjdlR0NUcEtpb1pyT2tSRnMxeVE9PSIsInZhbHVlIjoiajc5OHdZTW1oVlZmaW1nckFnS0F5UT09IiwibWFjIjoiMWJmNTMwYTQzMGMxM2RiNDA3NjBmNjQ4YmJlMDQwNjAyYWNiMTVmYmQ2ZjEzNzFmZjZhZWJkMjllNjYxZTA0NSIsInRhZyI6IiJ9', '3232', '32@gmail.com', '56', '56', '56', '56', '56', 'CAD', 0.00, 0, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(59, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(60, 28, 'VISA', NULL, NULL, '01', '2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 0.00, 0, '2025-06-22 03:13:42', '2025-06-21 23:13:42', NULL),
(61, 28, 'VISA', NULL, NULL, '01', '2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 0.00, 0, '2025-06-22 03:13:42', '2025-06-21 23:13:42', NULL),
(62, 29, 'VISA', NULL, NULL, '01', '2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 0.00, 0, '2025-06-22 03:15:10', '2025-06-21 23:15:10', NULL),
(63, 29, 'VISA', NULL, NULL, '01', '2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 0.00, 0, '2025-06-22 03:15:10', '2025-06-21 23:15:10', NULL),
(64, 30, 'VISA', 'eyJpdiI6IllFcWltSzRPYXNzcVRGbFh1MGRmR3c9PSIsInZhbHVlIjoiTzBvL2ptOXRvZERZcE5ZV2EwMmpYUT09IiwibWFjIjoiNjdiZDM3NjA1NzI2MzY2ZWY1ZWNlOWJmOTQxMjQ3NTkzMzUyODEyMzI5YTY4Y2JjZTQzMTVjZmM2YWU1MTE1ZCIsInRhZyI6IiJ9', 'Blaine Michael', '12', '2030', 'eyJpdiI6IkJlQUxVK3AyNE1rdm5yem5kZ2FBd3c9PSIsInZhbHVlIjoiZ3p2Um1nTWdWems1V0JmTmdsSXpXbTZ5Wi9yeDI5TUJBd3VQQlVZTWFacz0iLCJtYWMiOiI0NmZhOTJiMjNhYzU0MDIwNmNjNmEyNGY3ODM4MzgzODhjMmE1YzVmZWMzNzVlNTI5ZmExZGJiMGJlZjU4MGE0IiwidGFnIjoiIn0=', 'Voluptatum quia ut m', 'byquhag@mailinator.com', 'Tempora quis dolor c', 'Ut asperiores ullamc', 'Sri Lanka', NULL, '36448', 'USD', 39.00, 0, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(65, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(66, 30, 'VISA', 'eyJpdiI6Im5ueVJxVVRBYnFOZE9yNmtWWE1xU2c9PSIsInZhbHVlIjoia0t5NEFMaDRKMzA3WmRlVEltdC9EZz09IiwibWFjIjoiNjE0OWE5NTRkM2Y4ZTFjMjQxMjIwNTA2YmE3ZjM4Y2M2Y2Y3YWMyMjhjNGFkYmYyMzYxMDFjNDE2Y2Q3NmEyNSIsInRhZyI6IiJ9', 'Blaine Michael', '12', '2030', 'eyJpdiI6IklTUC84Z1VNYzcxVWdEQ1hBQVN1ckE9PSIsInZhbHVlIjoibGxSRG5GMFY0dXpaeTdVekpzbjJiUER4cUkwNmlSZmMyNE9YbjJuMGdPYz0iLCJtYWMiOiJkYWUxYmZmOTFkODk3NjUzZWVkMjdhNWJkNzE0N2RkY2RiZjhmNzlhOTIzOTRhYzA4MzEzMzVlMGRhNzkwNDE0IiwidGFnIjoiIn0=', 'Voluptatum quia ut m', 'byquhag@mailinator.com', 'Tempora quis dolor c', 'Ut asperiores ullamc', 'Sri Lanka', NULL, '36448', 'USD', 39.00, 0, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(67, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(68, 31, 'AMEX', 'eyJpdiI6ImlDSWJXMGp5dzgwcWZFZTI5RG0vOUE9PSIsInZhbHVlIjoiMDlUalpWdjBNeXpFTmtEb2lTZE9Zdz09IiwibWFjIjoiN2MyNDA2MjA3MjNjYmQwNGFiYTM5ZTg3MzU2ZmM3YWM1NTVlYThmZTEzMjM0ODZhNGZiZTA4M2Y5NGYwNGU2OCIsInRhZyI6IiJ9', 'Gisela Small', '09', '2034', 'eyJpdiI6IlBERG4xNVBkWm9KMEVLWEVkY3J2VGc9PSIsInZhbHVlIjoiSzJ4TVh2K09uZlFVUEk4bzdWNVBHMlo2RllCTlpQK1hvWkIxQlJzeEV6UT0iLCJtYWMiOiIyZTdkNDk4YWZkNTk5MzA1ODJiZWNkMzI0ODE3YjUxZDE2MjExZTU5NTU3YWVmNzIxZDJlNTk1YzUxOTVmNzFkIiwidGFnIjoiIn0=', 'At voluptas pariatur', 'punanoboxe@mailinator.com', 'Quis esse rerum minu', 'Sit eos dolore volu', 'Croatia', NULL, '94735', 'USD', 41.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(69, 31, NULL, 'eyJpdiI6IlFYTElyazQ0cjdCOUk0b1F3cnpjc1E9PSIsInZhbHVlIjoiVUNGMHdFOE9WOU5ZUElZWFJFMXlMQT09IiwibWFjIjoiNjk1YmYwNTJlNWZjZDM4ZjVjNDlkMTVhZWYxNjg1M2M3OWVhOGMwOWE3N2Y5ZTc3Zjk1M2JiNDdiYWZmYzMxNCIsInRhZyI6IiJ9', 'Wallace Long', NULL, NULL, 'eyJpdiI6IlhlQTBoVW9YQUNWczZPU05neTJtSFE9PSIsInZhbHVlIjoiRkVIckU3bHhheCtLYzh1dW5IRmRmais1elVHQm5sZkZpWkRmV2xXdmpvOD0iLCJtYWMiOiJlMDk0YmE3MDc2MzBlNDdkMTZkNGY2NWU4ZGVlMDNlZjI4NTFlMDE4OGE0ZjE0OTc4MDkzN2Q0MjA2MTFjMDc2IiwidGFnIjoiIn0=', 'Accusantium ullamco', 'syxopanac@mailinator.com', 'Blanditiis laborum n', 'Nulla eos quos conse', 'Cupidatat laboris mo', 'Cillum reiciendis oc', '21192', NULL, 67.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(70, 31, NULL, 'eyJpdiI6IndNRTF6N0VoV3RUSTNqekV2ZlFZZFE9PSIsInZhbHVlIjoiUk4zS2hvTkdZOEhrUGhBNmlzL2VzZz09IiwibWFjIjoiNzZiOTUzZGZhNDdhZGExZWQ3ZjAzYjczNWZhM2MwMjVjMTNhNDQ5YjdmZmU5MjdmZmEzM2Y0YzEzY2JiNWNlYiIsInRhZyI6IiJ9', 'Florence Benton', NULL, NULL, 'eyJpdiI6ImtxbDN6Vmh0LzRpTEdicW0zdjJYZ1E9PSIsInZhbHVlIjoiVjd6T0R3anRLOHJpNFI2RFU2SFFZS0N2WmJRSEpteDhYNjZZSGFTc2p4Zz0iLCJtYWMiOiI4MmY3N2Y5MTc0ODgxZTg1NWNmNmIxMWY1MWEzNTAyZDQ3Zjg0YjA1YjA3Y2UzMjBmMDliMTA3Y2ZmN2I1NmZmIiwidGFnIjoiIn0=', 'Sit tempore autem q', 'hojid@mailinator.com', 'Excepturi irure eos', 'Irure commodi soluta', 'Tempor consequuntur', 'Asperiores libero es', '40457', NULL, 58.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(71, 31, NULL, 'eyJpdiI6InpWSmhta0NMcjlMR1NSZlUvMDQ2dGc9PSIsInZhbHVlIjoiVVJrMmtsbTg2L1pDdUcyQmNrYit1dz09IiwibWFjIjoiMDNiZjA2MzA4MTBhYjFmMjk4YmIyOTlkYmY2OThkNGE3ZDFhZDYzMzllNzNkODBiMGFkMjVmZjRkMGRlZWI1NiIsInRhZyI6IiJ9', 'Len Talley', NULL, NULL, 'eyJpdiI6ImhROFhXREFpTitXZkdMTHdUa0Z5N1E9PSIsInZhbHVlIjoiTXZRWmRRbEZLMXczQVJ2aFlTTTJITWZHMGFDK2ZKbEl4Z1hJS3c1eFczUT0iLCJtYWMiOiI0ZTU3MmQ0YzUzMjBiZTkzNGZlZWI1NzAxNzE4MzUxY2NjMzcyMmVjNDU1YTMxZmE4MzdlMWJhNGUzMWI1YjBlIiwidGFnIjoiIn0=', 'Ea fugiat tempor sun', 'zeju@mailinator.com', 'Vitae culpa eum aut', 'Nisi ipsum quam fug', 'Aut lorem ducimus a', 'Modi reprehenderit', '27201', NULL, 35.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(72, 31, NULL, 'eyJpdiI6Ild3T3ZGbXZrb3BSNkVJaENzOFNOK0E9PSIsInZhbHVlIjoiSm90VU9ScTNyUFljZkxUMG1IeU9kUT09IiwibWFjIjoiOGU5MDdkMmFlYjU3YjQ0NWRlNDcyY2Y1ZjFiMTk3NTZjMzFhYzgxOGEyMDgzZDA0N2UxOGQ2OGRiYmRjYmI4ZCIsInRhZyI6IiJ9', 'Kai Higgins', NULL, NULL, 'eyJpdiI6IlNPVXMzK2p1azZwQTVCVFNFWHkwNXc9PSIsInZhbHVlIjoiSnJTOVBoMnJ3dHpyZU1NT3NhdDljQUJ1MHJTQ1hDbzlJUVJLNy9UK0NBZz0iLCJtYWMiOiI5ZWNiZTJkZmZjNzFkMDdmYzljOGZmNTI1ZmZmZWZmYTVhMDU4YjA4MzI2ZDQ0Y2Y0MGRjNDJiN2UxNjMzMWNjIiwidGFnIjoiIn0=', 'Culpa quos exercitat', 'bupatijy@mailinator.com', 'Quibusdam numquam am', 'Sit temporibus moll', 'Ut delectus et proi', 'Explicabo Nisi volu', '15450', NULL, 88.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(73, 31, NULL, 'eyJpdiI6IkVRZzhWM0dWd3JWYWlJNDJCVmhzSnc9PSIsInZhbHVlIjoiUFIrN1lJdHQ3amQzak5MamkxWUJWQT09IiwibWFjIjoiYThhNjU1MDIwYTQwYTRlYmVlOTcwMmY4NzA2Mjc0NzAxZjg2MmE1NWE1YWE4MTVlN2Y0ZjNlZTkyYjY4Nzg0NiIsInRhZyI6IiJ9', 'Wyoming Mcpherson', NULL, NULL, 'eyJpdiI6IlVrTzdVYldBQjR3VmQyS0NndFpZdEE9PSIsInZhbHVlIjoibFVTNnJZODFhM1B3ZVVDOCtubTZrQVpkNnA3eDU5V3VIYzIxNStzMExSQT0iLCJtYWMiOiIyZTg1ZTg5Zjk2MzlhODdjNDk0ODFiYjY0ZWY4MmI4Zjk1NDU1NmJlZmFjZDZiNmIwMGMxN2I2NDc3Y2QzMGJhIiwidGFnIjoiIn0=', 'Perspiciatis autem', 'jitiwon@mailinator.com', 'Atque iusto et eveni', 'At quaerat necessita', 'Quia aut quia debiti', 'Vitae consequatur A', '28710', NULL, 29.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(74, 31, NULL, 'eyJpdiI6IjNVU3d5UVlZVGRZZVVUNGRpdTkwdHc9PSIsInZhbHVlIjoiNk42L1M2NEhySTd3ZVFvOXQyK0NhZz09IiwibWFjIjoiYzM4YTFiYTg1MDM1N2RkY2RlOGYwZWU5N2QzMTA3Y2EyMmU3NGY5NTk2ZWIwNzcxNTM4ZGIzMDlkZTAxZDI2ZCIsInRhZyI6IiJ9', 'Donovan Estrada', NULL, NULL, 'eyJpdiI6IlE1ZFREOFJNTzJZSWFqY0ZDQ3lJblE9PSIsInZhbHVlIjoic1BpZ3NtMkFaVmliMFR3NXdWc0ozRE5BZmtaejlMVnp2RThUcXdiVEYxST0iLCJtYWMiOiI1YzE4OTcwOWM0MDczOGVhOGVhMDhlNTY0M2NjMzYxNDVkMWVkZDZmZTQzYTYxNDljZWM1ZTNmMTJhNzM3ZDRlIiwidGFnIjoiIn0=', 'Possimus possimus', 'fypuzuno@mailinator.com', 'Ut expedita nulla ni', 'Beatae aliquam et ma', 'At est labore magna', 'Blanditiis aut ut am', '18251', NULL, 48.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(75, 31, NULL, 'eyJpdiI6IkM2RmdkaTEybm51ZjdWSm1ScnFqdnc9PSIsInZhbHVlIjoiVFpyNE5LeTE2MTd4Vll6T2dMOFpZQT09IiwibWFjIjoiM2UyMjUyNDczODFmODM0NTBkMzVlMDQ3YmU2ZWQ1YzM5MTcyMTAwNmM0NWEwOTIwMWM3M2ExZWU3MmJkMWU5MSIsInRhZyI6IiJ9', 'Victoria Malone', NULL, NULL, 'eyJpdiI6ImlidHdkZFZlVlhGd3hHQ3FKc29sSlE9PSIsInZhbHVlIjoidUJpSFFLdW42ZHBhd2tvQkJQQ3hhNGQzZnF4RnhseDFlMEZRck5QdG9adz0iLCJtYWMiOiJkNjM4ZDY2YzM0OTljNWMxZWFkODNmMzNmYTU5NDQzZTQxNmE0YzI0MjZhYWU2YTcwOWYyMDM2YTM3YzliMWJhIiwidGFnIjoiIn0=', 'Enim autem dolore ne', 'dacum@mailinator.com', 'Sint ipsum qui magn', 'Consequat Inventore', 'Laborum Quisquam do', 'In quis excepteur ni', '22681', NULL, 38.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(76, 31, NULL, 'eyJpdiI6InI0VHViN1QxVkNWdmdsOW5yWFVldWc9PSIsInZhbHVlIjoiKzFOaGtxU0pmUS9HNFc2M29CU3c2dz09IiwibWFjIjoiNjQ2YmRjNTY4ZWUzNmUxMzA4MjE1NzliOTc2NTg3ZjIyNGNjYjkyMTIzNzFkZDllZDRlYjg0MTc1ZDdhNTNkMyIsInRhZyI6IiJ9', 'Tallulah Atkinson', NULL, NULL, 'eyJpdiI6Ild3Q0JMRVlrQ1hVVi91UjRjSUUvS2c9PSIsInZhbHVlIjoiVG4ra1U4dDZhcUZ0OGY3aUxMbkFMckh1OHloc2x3VHRjMkhrMjFySDM0Yz0iLCJtYWMiOiI2MGQ2NWJmZDlmNmE3YjQ0ZTRjYjNmODA5NDI2NGQ3ZWE1NjgwNzQ1MzUyYjU2MDEzZGQ5MzQ0NTBiMWNlMDlkIiwidGFnIjoiIn0=', 'Officiis error incid', 'xisaciji@mailinator.com', 'Ex aspernatur et vol', 'Iusto provident und', 'Tempor sunt deserunt', 'Accusantium eveniet', '93625', NULL, 80.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(77, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(78, 31, 'AMEX', 'eyJpdiI6IkdDRGtVM3NQd2ZQOFV1amxTMVVVT2c9PSIsInZhbHVlIjoiUDFiQXhBZHM0c3NvVWtDL3BQLzhGZz09IiwibWFjIjoiNDQ2YTQzMDczMGNjMjAxODBjMTcxMTlmNGI5YTFlOTJiZWM5Zjc1ODE1ZTIzMTJlMTcwNzc2Nzg3MmM4NzQyNyIsInRhZyI6IiJ9', 'Gisela Small', '09', '2034', 'eyJpdiI6IlpuYStvazdNK1pzZVpaTUlQNlRQcEE9PSIsInZhbHVlIjoicnhWWU5hYndDMGtkMlVMZUZsQXlpT1VWYzhkRHowVW5jaUZmeng2eFJKVT0iLCJtYWMiOiIyNDgyOGIxMTExZWJhNmQ5OWZkNDY5MTBmZjlmYWFmZjA2ODY4NGQ3MGNhNjgzYTAzM2ZiMzA1YjgyNTc0Nzk5IiwidGFnIjoiIn0=', 'At voluptas pariatur', 'punanoboxe@mailinator.com', 'Quis esse rerum minu', 'Sit eos dolore volu', 'Croatia', NULL, '94735', 'USD', 41.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(79, 31, NULL, 'eyJpdiI6IktlV0hRMTdqSmQ4WGVLQ1ovYmg4MUE9PSIsInZhbHVlIjoiSi9KSVNReFlmS3BQVXNxYkVkTlZHdz09IiwibWFjIjoiNzg3ZGViY2U0NmRiNTVhZjFlNjg3MDExZTE2NGNiOTg5YzA1MjI1OTY3ZjljOWFmZjU4MTAwOTQxODk3Yjk3NyIsInRhZyI6IiJ9', 'Wallace Long', NULL, NULL, 'eyJpdiI6IlFsYkdqN29aSk5oeWJ5bUdCQ3pwV1E9PSIsInZhbHVlIjoieU5iZWxLb0xaMlRmdFdzQXM4Qk1UOVRzMFhLSXgzdWJUWG1Gb3R4eEw5Zz0iLCJtYWMiOiJkYTEyZWNjZWY4YWIxNjM4OTJjOTk2NWI1OWQzMzVmMjQ1YzYxNTY0ODI1ODRjNGQ4NDZjNTE0NzY0ZmU2NjAwIiwidGFnIjoiIn0=', 'Accusantium ullamco', 'syxopanac@mailinator.com', 'Blanditiis laborum n', 'Nulla eos quos conse', 'Cupidatat laboris mo', 'Cillum reiciendis oc', '21192', NULL, 67.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(80, 31, NULL, 'eyJpdiI6Imd0QldOempZMDJHVlU5Mkg4ZHFNYXc9PSIsInZhbHVlIjoic2NzNi9IMTgyRlN1NDlvWDg3ZHdGdz09IiwibWFjIjoiNTM0MzQyODVlZmRhMjE4YWNhMWMzNzdkNjM0Y2JhYWUzYTg5ZmFmYTdlZmI5MmYwYjc5YzIzYWU0ZDU3M2IyNSIsInRhZyI6IiJ9', 'Florence Benton', NULL, NULL, 'eyJpdiI6ImRKL0gxTjBNTjJyR2RnaVp1a3lxTVE9PSIsInZhbHVlIjoiY3JqSnFJMUdoclA3czVGejlIQUI2NjF6YzFXU3lmM0V2TXdEV2tHVWVWdz0iLCJtYWMiOiJmNTIyYmUzYjM0OWE2NWE2MTBlNmZlMzVmYmU4NDMwOGZkZThiNzZmYTlhM2RhMWE5Y2YxZDgzZGVlMDFkZTdjIiwidGFnIjoiIn0=', 'Sit tempore autem q', 'hojid@mailinator.com', 'Excepturi irure eos', 'Irure commodi soluta', 'Tempor consequuntur', 'Asperiores libero es', '40457', NULL, 58.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(81, 31, NULL, 'eyJpdiI6InFKZmUydDVaOWNlYXVubEZqRGF6SkE9PSIsInZhbHVlIjoiZGFkbG1GTWFGMm5xQXdtRzNReG4wQT09IiwibWFjIjoiM2U2ODIzOTFhYTMyMTBhODU2N2UxZjRkZDYxYzBiNDA1OGRkYzU1NjkxOTE1ZTc2ODBiNjVkNTBlOGRmZThiYyIsInRhZyI6IiJ9', 'Len Talley', NULL, NULL, 'eyJpdiI6ImdIbjJaTExCUWlFb056RkNwUE13cEE9PSIsInZhbHVlIjoiWWppalhYRmhod1NpbXlETXREckE4aHozaG5JWmVqdDdQSTh6THdETUZHST0iLCJtYWMiOiIxMTYzMDQ3ODc4ZjE0MGM2YWE1ZmZkNWFiYWEzZmY3NGE3OTg0ZjEwMjkyZmMyMjQ5ZWE5ZTRmYmE0NGYxMTRlIiwidGFnIjoiIn0=', 'Ea fugiat tempor sun', 'zeju@mailinator.com', 'Vitae culpa eum aut', 'Nisi ipsum quam fug', 'Aut lorem ducimus a', 'Modi reprehenderit', '27201', NULL, 35.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(82, 31, NULL, 'eyJpdiI6IktxbHgrMjRROE9zcngxblAwMXliSnc9PSIsInZhbHVlIjoiQ1RjWUpRL3hUWkkxa3FOUy9jQm9jQT09IiwibWFjIjoiNzZlNGI1NzYzNTkxMTAwOGMyYmRhZmY4ODhiNzMzMmZlMTY4YWZlNWVjMDQxNDU2YzM5MzVmZGZiOTI3MmIyNiIsInRhZyI6IiJ9', 'Kai Higgins', NULL, NULL, 'eyJpdiI6InJ2b29OWXYzQnc1NFJsdkU1QWNSTVE9PSIsInZhbHVlIjoibFViS2hCQWdnVXgzdXlsMW5SSm1XR2szNWV0SmRPTlVrNVRZQVcrUG45TT0iLCJtYWMiOiI1NjRjM2ViNmFlNDEyODQyYTdmMzM3MzViMDlkMWI0ODU4NGJkOGVjZGQ1NTUyZTQ1NTI3MTZiMGRhMjM5YWM0IiwidGFnIjoiIn0=', 'Culpa quos exercitat', 'bupatijy@mailinator.com', 'Quibusdam numquam am', 'Sit temporibus moll', 'Ut delectus et proi', 'Explicabo Nisi volu', '15450', NULL, 88.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(83, 31, NULL, 'eyJpdiI6InI5ZkVTM2RvUFVSYzR4T0p3cGdqSVE9PSIsInZhbHVlIjoiSzZpeExRUzFmOFFIVHR5V2pIV0hsQT09IiwibWFjIjoiZWM1ZDQ2MTNhNmVlNDllNmE3OWJhZDE1YjRjZWRiNDJmMTNlOWVjNWNkMmNiYTk4M2MwYjc5NGI5MWRmNDk2YSIsInRhZyI6IiJ9', 'Wyoming Mcpherson', NULL, NULL, 'eyJpdiI6InlqSUtwdkljKytEaGhxdEZ3ODhmV2c9PSIsInZhbHVlIjoiZ2hwUUxTb2YrZDd0dmJHeTg3OE10djJQdnNUbEhwdGw3a3BvZlV5SU1Wdz0iLCJtYWMiOiI2OWQ1MWFlNzQyNDNhMTM0MzIxNGNkYjEzY2YyNTdlYzA1ZWQzMjY1ZDVhODQ2YmIwMjczZjZjOWQzMzRmNzBjIiwidGFnIjoiIn0=', 'Perspiciatis autem', 'jitiwon@mailinator.com', 'Atque iusto et eveni', 'At quaerat necessita', 'Quia aut quia debiti', 'Vitae consequatur A', '28710', NULL, 29.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(84, 31, NULL, 'eyJpdiI6InpSd3VWcXRPZ2VMcUxtZnJKNU5HL0E9PSIsInZhbHVlIjoiK0g2dUJJTzFkRmVuaGVEL3NoRUxkdz09IiwibWFjIjoiYzM0NDY5YTA4ZmFkZTIzN2FlOTQ1NDA1YjY5ZjlkYzg3ODgxNTZhMDQ5ZDZmODE0NWVkZjhlNmViNTE4ZGExZSIsInRhZyI6IiJ9', 'Donovan Estrada', NULL, NULL, 'eyJpdiI6InJjNnNUd29lT2prY1ZWNG9qSG53UEE9PSIsInZhbHVlIjoiYlI1OXphWnMwWFpVdTNBYmZwUmtuT1ZYMzh2a0h1S3JkQTdJRkh5c0t1cz0iLCJtYWMiOiI3ZDllMGU0MzBjY2ZkMzI3ZGI1MmFiZTUzMGVkYTNlMmE4NTg5YjZhNGFmMzhjMTViZGJkNzE2NTNkNjRiNWMxIiwidGFnIjoiIn0=', 'Possimus possimus', 'fypuzuno@mailinator.com', 'Ut expedita nulla ni', 'Beatae aliquam et ma', 'At est labore magna', 'Blanditiis aut ut am', '18251', NULL, 48.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(85, 31, NULL, 'eyJpdiI6IjM0NlFCb3FFWDdCSi8xTnpNcmYwSFE9PSIsInZhbHVlIjoiUnJsZzhMQkhlbHpmTVZFRFdNdTNJQT09IiwibWFjIjoiNjNlM2U0YTIyZTEwYjZmNzg5N2ViMWM1YzRlMjRhOWUwZmE3NWY0ZTAzZWFiN2NmYWFkZDkyZjFhNmVhMmFhMSIsInRhZyI6IiJ9', 'Victoria Malone', NULL, NULL, 'eyJpdiI6IjE2OWwwQ2dIbXVHMUhkTjNReEt3UXc9PSIsInZhbHVlIjoiNkdIWHF5UVpWMkFvUTFoQzdoc2pWTmNxbEZYeWZXQjk4QUVqWm51ZEpVUT0iLCJtYWMiOiI4YTA0YjAwMTkyNDdkZWNkMTMwNzc2MDdiNTdmYmMyMzE4ZDhlYThmNmMxYmNkMGRhY2FjNGFmMTY4ZDJjMGI0IiwidGFnIjoiIn0=', 'Enim autem dolore ne', 'dacum@mailinator.com', 'Sint ipsum qui magn', 'Consequat Inventore', 'Laborum Quisquam do', 'In quis excepteur ni', '22681', NULL, 38.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(86, 31, NULL, 'eyJpdiI6Ii9GemEwVGtlMU9aVXg4NVJDbUs3QlE9PSIsInZhbHVlIjoiVWVheW80aHlGaUVaNHRqUXVFTDhXQT09IiwibWFjIjoiMzUyMGUwZjllODM2YzRjODFiMjM3ZGM0NDY1NTAwMGI5N2Y0NWFjNDU2MjRjMTE1YjliYjFjMTcxZGUxN2EzMCIsInRhZyI6IiJ9', 'Tallulah Atkinson', NULL, NULL, 'eyJpdiI6Ik10YUFWSWp5ZDhRVUFFaHp2QW1mOVE9PSIsInZhbHVlIjoiT1kwRlpWOTg1bkNSR2l1TDJRcm9EUkVwTFczbzF1Tk5kdVlXcDQ5c0w1cz0iLCJtYWMiOiJmODlkN2M0NDIwNmNjNDMyNjI2MTk3N2I1MDk0NmRlMGZjZWNmMzgyYWNkZGJiYWM2MzEzYWMwMDE1ZTViNjFiIiwidGFnIjoiIn0=', 'Officiis error incid', 'xisaciji@mailinator.com', 'Ex aspernatur et vol', 'Iusto provident und', 'Tempor sunt deserunt', 'Accusantium eveniet', '93625', NULL, 80.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(87, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travel_bookings`
--

CREATE TABLE `travel_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pnr` varchar(50) NOT NULL,
  `campaign` varchar(20) DEFAULT NULL,
  `hotel_ref` varchar(50) DEFAULT NULL,
  `cruise_ref` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `query_type` varchar(100) DEFAULT NULL,
  `company_organisation` varchar(255) DEFAULT NULL,
  `booking_status` varchar(50) DEFAULT 'under process',
  `payment_status` varchar(50) DEFAULT 'pending',
  `reservation_source` varchar(255) DEFAULT NULL,
  `descriptor` varchar(255) DEFAULT NULL,
  `amadeus_sabre_pnr` varchar(50) DEFAULT NULL,
  `airlinepnr` varchar(20) DEFAULT NULL,
  `pnrtype` varchar(5) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travel_bookings`
--

INSERT INTO `travel_bookings` (`id`, `pnr`, `campaign`, `hotel_ref`, `cruise_ref`, `name`, `phone`, `email`, `query_type`, `company_organisation`, `booking_status`, `payment_status`, `reservation_source`, `descriptor`, `amadeus_sabre_pnr`, `airlinepnr`, `pnrtype`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'AIR210636820001', NULL, 'Eveniet mollit faci', 'Hic quisquam aliquid', 'Elvis Vincent', '+1 (988) 214-7933', 'sijululaga@mailinator.com', 'UMNR', NULL, 'under process', 'pending', 'Sit ut sit eos es', 'Qui quia illo offici', NULL, NULL, NULL, NULL, '2025-06-22 02:06:50', '2025-06-21 22:06:50', NULL),
(28, 'AIR210636820002', NULL, NULL, NULL, 'Wendy Burke', '+1 (907) 512-3675', 'xavokiw@mailinator.com', 'CC', NULL, 'under process', 'pending', 'Harum quis soluta au', 'Est eos omnis proi', 'Culpa reprehenderit', NULL, NULL, NULL, '2025-06-22 03:13:42', '2025-06-21 23:13:42', NULL),
(29, 'AIR210636820003', NULL, 'Totam totam Nam ad p', 'Quisquam accusantium', 'Yoko Tucker', '+1 (972) 396-2464', 'coxividyny@mailinator.com', 'B', NULL, 'under process', 'pending', 'Accusamus atque nece', 'Sed distinctio Accu', 'Asperiores sit quisq', NULL, NULL, NULL, '2025-06-22 03:15:10', '2025-06-21 23:15:10', NULL),
(30, 'BUF220617460001', NULL, 'In id rem unde nobis', NULL, 'Deanna Gibson', '+1 (568) 234-5156', 'zefaqyrogu@mailinator.com', 'S', NULL, 'under process', 'pending', 'Ut ex in quis accusa', 'Odit blanditiis nesc', 'amadeus_sabre_pnr', 'airlinepnr', 'GK', NULL, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(31, 'LCC220653850002', NULL, 'Laudantium numquam', 'Ut vero dolorem ipsu', 'Simone Bradshaw', '+1 (602) 527-6368', 'dafycasume@mailinator.com', 'U', NULL, 'under process', 'pending', 'Qui debitis enim dol', 'Non pariatur Odio e', 'Voluptates vel est s', NULL, NULL, NULL, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travel_booking_remarks`
--

CREATE TABLE `travel_booking_remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `particulars` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travel_booking_remarks`
--

INSERT INTO `travel_booking_remarks` (`id`, `booking_id`, `agent`, `date_time`, `particulars`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 27, 'Testagent', '2025-06-21 22:06:51', 'Consequuntur est id fdsfmkdskfds Booking Remarks', '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(9, 28, 'Testagent', '2025-06-21 23:13:42', 'Eligendi animi proi', '2025-06-22 03:13:42', '2025-06-21 23:13:42', NULL),
(10, 29, 'Testagent', '2025-06-21 23:15:10', 'Proident dolor quae', '2025-06-22 03:15:10', '2025-06-21 23:15:10', NULL),
(11, 30, 'Testagent', '2025-06-22 00:30:11', 'Aut adipisci tempor', '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(12, 31, 'Testagent', '2025-06-22 01:31:23', 'Consequat Qui quisq  TYESTSTTS', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travel_booking_types`
--

CREATE TABLE `travel_booking_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Flight','Hotel','Cruise','Car','Train') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travel_booking_types`
--

INSERT INTO `travel_booking_types` (`id`, `booking_id`, `type`, `created_at`, `updated_at`) VALUES
(104, 27, 'Flight', '2025-06-22 02:06:50', '2025-06-21 22:06:50'),
(105, 27, 'Hotel', '2025-06-22 02:06:50', '2025-06-21 22:06:50'),
(106, 27, 'Cruise', '2025-06-22 02:06:50', '2025-06-21 22:06:50'),
(107, 27, 'Car', '2025-06-22 02:06:50', '2025-06-21 22:06:50'),
(108, 27, 'Train', '2025-06-22 02:06:50', '2025-06-21 22:06:50'),
(109, 28, 'Flight', '2025-06-22 03:13:42', '2025-06-21 23:13:42'),
(110, 28, 'Car', '2025-06-22 03:13:42', '2025-06-21 23:13:42'),
(111, 29, 'Flight', '2025-06-22 03:15:10', '2025-06-21 23:15:10'),
(112, 29, 'Hotel', '2025-06-22 03:15:10', '2025-06-21 23:15:10'),
(113, 30, 'Car', '2025-06-22 03:15:10', '2025-06-21 23:15:10'),
(114, 30, 'Train', '2025-06-22 03:15:10', '2025-06-21 23:15:10'),
(115, 30, 'Hotel', '2025-06-22 04:30:11', '2025-06-22 00:30:11'),
(116, 30, 'Train', '2025-06-22 04:30:11', '2025-06-22 00:30:11'),
(117, 31, 'Flight', '2025-06-22 05:31:23', '2025-06-22 01:31:23'),
(118, 31, 'Hotel', '2025-06-22 05:31:23', '2025-06-22 01:31:23'),
(119, 31, 'Cruise', '2025-06-22 05:31:23', '2025-06-22 01:31:23'),
(120, 31, 'Car', '2025-06-22 05:31:23', '2025-06-22 01:31:23'),
(121, 31, 'Train', '2025-06-22 05:31:23', '2025-06-22 01:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `travel_car_details`
--

CREATE TABLE `travel_car_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_rental_provider` varchar(255) DEFAULT NULL,
  `car_type` varchar(255) DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `dropoff_location` varchar(255) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `dropoff_date` date DEFAULT NULL,
  `dropoff_time` time DEFAULT NULL,
  `confirmation_number` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `rental_provider_address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_car_details`
--

INSERT INTO `travel_car_details` (`id`, `booking_id`, `car_rental_provider`, `car_type`, `pickup_location`, `dropoff_location`, `pickup_date`, `pickup_time`, `dropoff_date`, `dropoff_time`, `confirmation_number`, `remarks`, `rental_provider_address`, `created_at`, `updated_at`) VALUES
(18, 27, '1', '1', '1', '1', '2025-06-21', '18:09:00', '2025-06-21', '18:09:00', '1', '1', '1', '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(19, 27, '2', '2', '2', '2', '2025-06-21', '18:08:00', '2025-06-21', '18:08:00', '2', '2', '2', '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(20, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(21, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:13:42', '2025-06-22 03:13:42'),
(22, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:15:10', '2025-06-22 03:15:10'),
(23, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 04:30:11', '2025-06-22 04:30:11'),
(24, 31, 'Voluptas labore sit', 'Commodo veniam dolo', 'Sed dolor quae tempo', 'Alias aliquip evenie', '1994-10-05', '14:50:00', '1986-05-06', '09:51:00', 'Alias aliquip evenie', 'Porro dolorem animi', 'Qui facere quod sit', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(25, 31, 'Eaque eu aliquip est', 'Quidem harum rerum l', 'Quasi in eum id eli', 'Et reprehenderit und', '1972-03-31', '20:20:00', '1993-12-02', '03:39:00', 'Et reprehenderit und', 'Corporis sed fuga I', 'Maiores eos elit nu', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(26, 31, 'Assumenda ut omnis u', 'Tempora rem quis dol', 'Est voluptatem magni', 'Vero labore sunt sae', '2001-07-07', '03:26:00', '2021-04-05', '05:47:00', 'Vero labore sunt sae', 'Iure esse unde et ea', 'Minima aute sed aliq', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(27, 31, 'Tenetur accusamus ma', 'Et deleniti nisi non', 'Et et exercitation c', 'Est dolor ea vel vol', '2009-08-02', '17:32:00', '2015-12-30', '16:13:00', 'Est dolor ea vel vol', 'Libero vitae quia te', 'Ut aperiam hic ea qu', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(28, 31, 'Beatae esse nisi tem', 'Dicta nihil tempor q', 'Omnis et quisquam id', 'Quia et libero sed d', '2004-07-27', '15:41:00', '2017-07-20', '15:58:00', 'Quia et libero sed d', 'Qui qui officiis lau', 'Amet porro non ut s', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(29, 31, 'Dolores obcaecati id', 'Modi officia ea labo', 'Voluptatem laudantiu', 'Debitis sequi mollit', '2017-05-27', '02:05:00', '1987-12-27', '08:52:00', 'Debitis sequi mollit', 'Consectetur tempore', 'Repudiandae expedita', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(30, 31, 'Aute assumenda eum a', 'Deserunt aut alias n', 'Architecto iusto ver', 'Fugit sed esse fug', '2021-08-26', '13:03:00', '2020-04-09', '23:15:00', 'Fugit sed esse fug', 'Non ex tempore et d', 'Magnam impedit inci', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(31, 31, 'Magnam sequi do id e', 'Hic consectetur exer', 'Omnis fuga Beatae v', 'Beatae non et repudi', '1994-11-01', '21:32:00', '2009-01-24', '11:56:00', 'Beatae non et repudi', 'Elit dolorum ipsum', 'Reprehenderit laboru', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(32, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 05:31:23', '2025-06-22 05:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `travel_cruise_details`
--

CREATE TABLE `travel_cruise_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cruise_line` varchar(255) DEFAULT NULL,
  `ship_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stateroom` varchar(255) DEFAULT NULL,
  `departure_port` varchar(255) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `departure_hrs` tinyint(3) UNSIGNED DEFAULT NULL,
  `departure_mm` tinyint(3) UNSIGNED DEFAULT NULL,
  `arrival_port` varchar(255) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `arrival_hrs` tinyint(3) UNSIGNED DEFAULT NULL,
  `arrival_mm` tinyint(3) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_cruise_details`
--

INSERT INTO `travel_cruise_details` (`id`, `booking_id`, `cruise_line`, `ship_name`, `category`, `stateroom`, `departure_port`, `departure_date`, `departure_hrs`, `departure_mm`, `arrival_port`, `arrival_date`, `arrival_hrs`, `arrival_mm`, `remarks`, `created_at`, `updated_at`) VALUES
(13, 27, '1', '1', '1', '1', '1', '2025-06-21', 1, 1, '1', '2025-06-21', 12, 13, '1', '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(14, 27, '2', '2', '22', '2', '2', '2025-06-21', 2, 2, '2', '2025-06-21', 12, 12, '2', '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(15, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(16, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:13:42', '2025-06-22 03:13:42'),
(17, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:15:10', '2025-06-22 03:15:10'),
(18, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 04:30:11', '2025-06-22 04:30:11'),
(19, 31, 'Sunt tenetur quae se', 'Stacey Horn', 'Ipsam veritatis veli', 'Quisquam rerum magni', 'Vitae quae sed disti', '1982-06-18', 5, 40, 'Consequatur ab nesc', '2003-04-17', 8, 46, 'Iure do quis suscipi', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(20, 31, 'Assumenda atque moll', 'Christopher Cooke', 'Quo exercitationem e', 'Fuga Vel fugiat di', 'Incididunt accusamus', '1991-04-12', 0, 29, 'Quod nostrud saepe s', '1992-09-21', 20, 28, 'Est voluptatum aliqu', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(21, 31, 'Quidem sit laborios', 'Mia Chaney', 'Nostrum quis incidun', 'Ad eaque consectetur', 'Eligendi iusto excep', '1974-09-15', 7, 58, 'Voluptates commodi q', '2020-05-13', 4, 40, 'Facilis molestias in', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(22, 31, 'Mollit nisi animi d', 'Maile Berry', 'Qui quas debitis id', 'Fugiat qui repudiand', 'Deserunt odit quia l', '2005-08-15', 21, 31, 'Sequi laborum Nulla', '2025-04-10', 19, 24, 'Do veniam enim et s', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(23, 31, 'Nesciunt ut consequ', 'Buffy Underwood', 'Esse modi incidunt', 'Dolor voluptatem Et', 'Quasi sed provident', '1981-01-26', 10, 33, 'Illum qui neque nob', '2003-06-27', 7, 25, 'Animi voluptate dol', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(24, 31, 'Est libero voluptate', 'Candace Hanson', 'Quis dolore sit sit', 'Vel qui assumenda ve', 'Nihil labore commodi', '1972-07-23', 8, 1, 'Aliquip officia eius', '2012-05-25', 19, 15, 'Quis ullam sequi ass', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(25, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 05:31:23', '2025-06-22 05:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `travel_flight_details`
--

CREATE TABLE `travel_flight_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `airlines_code` varchar(255) DEFAULT NULL,
  `flight_no` varchar(255) DEFAULT NULL,
  `cabin` varchar(255) DEFAULT NULL,
  `class_of_service` varchar(255) DEFAULT NULL,
  `departure_airport` varchar(255) DEFAULT NULL,
  `departure_hrs` tinyint(3) UNSIGNED DEFAULT NULL,
  `departure_mm` tinyint(3) UNSIGNED DEFAULT NULL,
  `arrival_airport` varchar(255) DEFAULT NULL,
  `arrival_hrs` tinyint(3) UNSIGNED DEFAULT NULL,
  `arrival_mm` tinyint(3) UNSIGNED DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `transit` varchar(255) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_flight_details`
--

INSERT INTO `travel_flight_details` (`id`, `booking_id`, `direction`, `date`, `airlines_code`, `flight_no`, `cabin`, `class_of_service`, `departure_airport`, `departure_hrs`, `departure_mm`, `arrival_airport`, `arrival_hrs`, `arrival_mm`, `duration`, `transit`, `arrival_date`, `created_at`, `updated_at`) VALUES
(5, 27, '1', '2025-06-21', '1', '1', '1', '1', '1', 1, 1, '1', 1, 11, '1', '1', '2025-06-21', '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(6, 27, '2', '2025-06-21', '2', '2', '2', '2', '2', 2, 2, '2', 2, 2, '2', '2', '2025-06-21', '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(7, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 02:06:50', '2025-06-22 02:06:50'),
(8, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:13:42', '2025-06-22 03:13:42'),
(9, 29, 'Anim ab in Nam aut d', '2015-11-13', 'Iure illum tenetur', 'Irure labore nesciun', 'Nam reprehenderit in', 'Iure illo saepe quia', 'Sed labore dolor pra', 12, 45, 'Odio ratione a repel', 16, 37, 'Dolorem proident re', 'Illum eveniet aliq', '2015-06-25', '2025-06-22 03:15:10', '2025-06-22 03:15:10'),
(10, 29, 'Soluta expedita poss', '2009-04-03', 'Consequatur Consequ', 'Recusandae Corrupti', 'Suscipit Nam quia co', 'Placeat facilis exp', 'Esse excepteur accu', 12, 48, 'Doloremque praesenti', 2, 8, 'Et corrupti odio po', 'Sed ut quia Nam sed', '1994-03-22', '2025-06-22 03:15:10', '2025-06-22 03:15:10'),
(11, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:15:10', '2025-06-22 03:15:10'),
(12, 30, 'direction', '0000-00-00', 'IAC', 'cabin', 'cabin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 04:30:11', '2025-06-22 04:30:11'),
(13, 31, 'Enim et dolorum eius', '1978-01-31', 'Et qui blanditiis ni', 'Odio sequi quia quia', 'Rem consequatur sint', 'Omnis perferendis ad', 'Sequi minus amet si', 9, 15, 'Sit non a quod sunt', 16, 59, 'Voluptatem Quia nis', 'Incidunt voluptate', '2014-08-06', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(14, 31, 'Consectetur sequi e', '2022-08-08', 'Dignissimos iusto no', 'Autem sapiente et cu', 'Laboriosam id illum', 'Sequi odio eos elit', 'Ex quos commodi aut', 13, 5, 'Est repellendus Ne', 3, 32, 'Dolor dignissimos fu', 'Quam nostrum fuga A', '1979-04-30', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(15, 31, 'Exercitationem autem', '2018-02-19', 'Eligendi assumenda l', 'Corrupti in porro r', 'Ut earum et earum an', 'Aut eum dolor volupt', 'Et molestiae eligend', 15, 17, 'Qui adipisicing null', 17, 45, 'Soluta dolorem nihil', 'Magni rem consequatu', '1974-09-07', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(16, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 05:31:23', '2025-06-22 05:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `travel_hotel_details`
--

CREATE TABLE `travel_hotel_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `room_category` varchar(255) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `no_of_rooms` int(10) UNSIGNED DEFAULT NULL,
  `confirmation_number` varchar(255) DEFAULT NULL,
  `hotel_address` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_hotel_details`
--

INSERT INTO `travel_hotel_details` (`id`, `booking_id`, `hotel_name`, `room_category`, `checkin_date`, `checkout_date`, `no_of_rooms`, `confirmation_number`, `hotel_address`, `remarks`, `created_at`, `updated_at`) VALUES
(10, 27, '1', '1', '2025-06-21', '2025-06-21', 1, '1', '11', '1', '2025-06-22 02:06:51', '2025-06-22 02:06:51'),
(11, 27, '2', '2', '2025-06-21', '2025-06-21', 2, '2', '2', '2', '2025-06-22 02:06:51', '2025-06-22 02:06:51'),
(12, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 02:06:51', '2025-06-22 02:06:51'),
(13, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:13:42', '2025-06-22 03:13:42'),
(14, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 03:15:10', '2025-06-22 03:15:10'),
(15, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 04:30:11', '2025-06-22 04:30:11'),
(16, 31, 'Jada Koch', 'Voluptate quo non is', '2006-05-02', '1974-02-13', 84, 'Voluptate quo non is', 'Beatae quibusdam mol', 'Voluptate qui omnis', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(17, 31, 'Logan Harper', 'Et consequatur Dolo', '2014-03-12', '2020-01-28', 95, 'Et consequatur Dolo', 'Ut veritatis sint d', 'Vel ex reiciendis du', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(18, 31, 'Ulysses Green', 'Accusamus nemo occae', '1972-07-26', '1989-09-30', 40, 'Accusamus nemo occae', 'Ullam omnis veniam', 'Eligendi omnis non v', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(19, 31, 'Belle Roth', 'Ex in amet quia Nam', '1988-05-17', '2014-06-18', 15, 'Ex in amet quia Nam', 'Illum et quas commo', 'Dolorum nesciunt la', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(20, 31, 'Dai Joyner', 'Tenetur recusandae', '2005-07-03', '1996-12-30', 55, 'Tenetur recusandae', 'Sapiente sit ullamco', 'Consequatur veniam', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(21, 31, 'Blake Romero', 'Reiciendis maiores s', '1996-05-08', '2009-10-05', 13, 'Reiciendis maiores s', 'Cumque voluptate mag', 'Tempora fugiat et re', '2025-06-22 05:31:23', '2025-06-22 05:31:23'),
(22, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 05:31:23', '2025-06-22 05:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `travel_passengers`
--

CREATE TABLE `travel_passengers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `passenger_type` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `seat_number` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `credit_note_amount` decimal(10,2) DEFAULT 0.00,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `e_ticket_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travel_passengers`
--

INSERT INTO `travel_passengers` (`id`, `booking_id`, `passenger_type`, `gender`, `dob`, `seat_number`, `title`, `credit_note_amount`, `first_name`, `middle_name`, `last_name`, `e_ticket_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(60, 27, 'Adult', 'Male', '2025-06-21', '2', 'Ms', 0.00, '121', '212', '121', '1', '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(61, 27, 'Adult', 'Male', '2025-06-21', '3', '2', 0.00, '2', '2', '2', 'ee', '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(62, 27, 'Seat Infant', 'Male', '2025-06-21', '3', '3', 0.00, '3', '3', '3', '3', '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(63, 27, 'Adult', 'Male', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(64, 28, NULL, 'Male', NULL, NULL, 'Ms', 0.00, NULL, NULL, NULL, NULL, '2025-06-22 03:13:42', '2025-06-21 23:13:42', NULL),
(65, 29, NULL, 'Male', NULL, NULL, 'Ms', 0.00, NULL, NULL, NULL, NULL, '2025-06-22 03:15:10', '2025-06-21 23:15:10', NULL),
(66, 30, NULL, 'Male', NULL, NULL, 'Ms', 0.00, NULL, NULL, NULL, NULL, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(67, 31, 'Lap Infant', 'Male', '1987-08-09', '501', 'Ms', 0.00, 'Maxwell', 'Conan York', 'Roy', '847', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(68, 31, 'Adult', 'Male', '1991-08-27', '216', 'Dolore voluptas temp', 0.00, 'Maggy', 'Brady Kramer', 'Tanner', '956', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(69, 31, 'Lap Infant', 'Female', '1989-03-15', '573', 'Irure laudantium qu', 0.00, 'Xaviera', 'Kylan Alvarado', 'Porter', '956', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(70, 31, 'Adult', 'Female', '2009-04-25', '418', 'Nihil ut tempora in', 0.00, 'Yvonne', 'Yardley Tran', 'Cotton', '913', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(71, 31, 'Adult', 'Male', '1974-03-14', '797', 'Veniam et magnam do', 0.00, 'Connor', 'Martin Barr', 'Thompson', '882', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(72, 31, 'Child', 'Male', '2014-11-27', '746', 'Voluptates dolore ex', 0.00, 'Wynne', 'Lewis Bender', 'Haley', '599', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(73, 31, 'Infant', 'Female', '2009-08-09', '504', 'Amet quis dolore al', 0.00, 'Igor', 'Alec Jarvis', 'Sargent', '260', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(74, 31, 'Infant', 'Female', '2017-10-04', '87', 'Et sint autem dolor', 0.00, 'Vanna', 'Noelle Downs', 'Gould', '783', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(75, 31, 'Infant', 'Female', '1998-09-20', '812', 'Eligendi quo explica', 0.00, 'Blossom', 'Ima Vaughan', 'Ferguson', '387', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(76, 31, 'Lap Infant', 'Male', '1988-10-05', '370', 'Veniam harum blandi', 0.00, 'Byron', 'Vera Pugh', 'Mitchell', '558', '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL),
(77, 31, 'Lap Infant', 'Male', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travel_pricing_details`
--

CREATE TABLE `travel_pricing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_cost` decimal(10,2) DEFAULT 0.00,
  `cruise_cost` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `advisor_mco` decimal(10,2) DEFAULT 0.00,
  `conversion_charge` decimal(10,2) DEFAULT 0.00,
  `airline_commission` decimal(10,2) DEFAULT 0.00,
  `final_amount` decimal(10,2) DEFAULT 0.00,
  `merchant` varchar(255) DEFAULT NULL,
  `net_mco` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travel_pricing_details`
--

INSERT INTO `travel_pricing_details` (`id`, `booking_id`, `hotel_cost`, `cruise_cost`, `total_amount`, `advisor_mco`, `conversion_charge`, `airline_commission`, `final_amount`, `merchant`, `net_mco`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 27, 21212.00, 12121.00, 212.00, 212.00, 0.00, 1212.00, 12121212.00, '15', 21212.00, '2025-06-22 02:06:51', '2025-06-21 22:06:51', NULL),
(19, 28, 0.00, 0.00, 24.00, 89.00, 0.00, 4.00, 47.00, '15', 9.00, '2025-06-22 03:13:42', '2025-06-21 23:13:42', NULL),
(20, 29, 32.00, 60.00, 42.00, 64.00, 0.00, 3.00, 90.00, '15', 67.00, '2025-06-22 03:15:10', '2025-06-21 23:15:10', NULL),
(21, 30, 32.00, 0.00, 71.00, 53.00, 0.00, 0.00, 42.00, NULL, 58.00, '2025-06-22 04:30:11', '2025-06-22 00:30:11', NULL),
(22, 31, 42.00, 38.00, 75.00, 96.00, 0.00, 28.00, 8.00, '15', 39.00, '2025-06-22 05:31:23', '2025-06-22 01:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travel_quality_feedback`
--

CREATE TABLE `travel_quality_feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `qa` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `parameters` varchar(255) DEFAULT NULL,
  `status` enum('Pass','Fail','Pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_screenshots`
--

CREATE TABLE `travel_screenshots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Flight','Hotel','Car') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_sector_details`
--

CREATE TABLE `travel_sector_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `sector_type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_train_details`
--

CREATE TABLE `travel_train_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_code` (`country_code`);

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
-- Indexes for table `members`
--
ALTER TABLE `members`
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
-- Indexes for table `travel_billing_details`
--
ALTER TABLE `travel_billing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_bookings`
--
ALTER TABLE `travel_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pnr` (`pnr`),
  ADD KEY `idx_pnr` (`pnr`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `travel_booking_remarks`
--
ALTER TABLE `travel_booking_remarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_booking_types`
--
ALTER TABLE `travel_booking_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_car_details`
--
ALTER TABLE `travel_car_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_car_details_booking_id_index` (`booking_id`);

--
-- Indexes for table `travel_cruise_details`
--
ALTER TABLE `travel_cruise_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_cruise_details_booking_id_index` (`booking_id`);

--
-- Indexes for table `travel_flight_details`
--
ALTER TABLE `travel_flight_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_flight_details_booking_id_index` (`booking_id`);

--
-- Indexes for table `travel_hotel_details`
--
ALTER TABLE `travel_hotel_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_hotel_details_booking_id_index` (`booking_id`);

--
-- Indexes for table `travel_passengers`
--
ALTER TABLE `travel_passengers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_booking_id` (`booking_id`);

--
-- Indexes for table `travel_pricing_details`
--
ALTER TABLE `travel_pricing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_quality_feedback`
--
ALTER TABLE `travel_quality_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_screenshots`
--
ALTER TABLE `travel_screenshots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_sector_details`
--
ALTER TABLE `travel_sector_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travel_train_details`
--
ALTER TABLE `travel_train_details`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_types`
--
ALTER TABLE `call_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quality_feedbacks`
--
ALTER TABLE `quality_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `query_types`
--
ALTER TABLE `query_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel_billing_details`
--
ALTER TABLE `travel_billing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `travel_bookings`
--
ALTER TABLE `travel_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `travel_booking_remarks`
--
ALTER TABLE `travel_booking_remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `travel_booking_types`
--
ALTER TABLE `travel_booking_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `travel_car_details`
--
ALTER TABLE `travel_car_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `travel_cruise_details`
--
ALTER TABLE `travel_cruise_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `travel_flight_details`
--
ALTER TABLE `travel_flight_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `travel_hotel_details`
--
ALTER TABLE `travel_hotel_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `travel_passengers`
--
ALTER TABLE `travel_passengers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `travel_pricing_details`
--
ALTER TABLE `travel_pricing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `travel_quality_feedback`
--
ALTER TABLE `travel_quality_feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `travel_screenshots`
--
ALTER TABLE `travel_screenshots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `travel_sector_details`
--
ALTER TABLE `travel_sector_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `travel_train_details`
--
ALTER TABLE `travel_train_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `travel_billing_details`
--
ALTER TABLE `travel_billing_details`
  ADD CONSTRAINT `travel_billing_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_booking_remarks`
--
ALTER TABLE `travel_booking_remarks`
  ADD CONSTRAINT `travel_booking_remarks_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_booking_types`
--
ALTER TABLE `travel_booking_types`
  ADD CONSTRAINT `travel_booking_types_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_car_details`
--
ALTER TABLE `travel_car_details`
  ADD CONSTRAINT `travel_car_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_cruise_details`
--
ALTER TABLE `travel_cruise_details`
  ADD CONSTRAINT `travel_cruise_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_flight_details`
--
ALTER TABLE `travel_flight_details`
  ADD CONSTRAINT `travel_flight_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_hotel_details`
--
ALTER TABLE `travel_hotel_details`
  ADD CONSTRAINT `travel_hotel_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_passengers`
--
ALTER TABLE `travel_passengers`
  ADD CONSTRAINT `travel_passengers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_pricing_details`
--
ALTER TABLE `travel_pricing_details`
  ADD CONSTRAINT `travel_pricing_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_quality_feedback`
--
ALTER TABLE `travel_quality_feedback`
  ADD CONSTRAINT `travel_quality_feedback_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_screenshots`
--
ALTER TABLE `travel_screenshots`
  ADD CONSTRAINT `travel_screenshots_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_sector_details`
--
ALTER TABLE `travel_sector_details`
  ADD CONSTRAINT `travel_sector_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
