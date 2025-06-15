-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cheapoflyllc
-- ------------------------------------------------------
-- Server version	5.5.52-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `booking_statuses`
--

DROP TABLE IF EXISTS `booking_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_statuses`
--

/*!40000 ALTER TABLE `booking_statuses` DISABLE KEYS */;
INSERT INTO `booking_statuses` VALUES (1,'Under Process',1,NULL,NULL),(2,'Complete',1,NULL,NULL);
/*!40000 ALTER TABLE `booking_statuses` ENABLE KEYS */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

--
-- Table structure for table `call_logs`
--

DROP TABLE IF EXISTS `call_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `assign` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pnr` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chkflight` tinyint(1) NOT NULL DEFAULT '0',
  `chkhotel` tinyint(1) NOT NULL DEFAULT '0',
  `chkcruise` tinyint(1) NOT NULL DEFAULT '0',
  `chkcar` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_converted` tinyint(1) NOT NULL DEFAULT '0',
  `followup_date` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_logs`
--

/*!40000 ALTER TABLE `call_logs` DISABLE KEYS */;
INSERT INTO `call_logs` VALUES (1,0,NULL,'',1,1,1,1,'+1 (919) 719-3769','Violet Guthrie',NULL,'Agency','Eaque tenetur rem id','Customer Service',1,NULL,'Quia esse quia deser','2025-04-24 14:09:00','2025-04-24 14:09:00'),(2,0,NULL,'',1,1,1,1,'+1 (887) 708-2612','Rylee Alford',NULL,'Agency','Omnis animi iste qu','Customer Service',0,NULL,'In ratione hic molli','2025-04-24 14:13:23','2025-04-24 14:13:23'),(3,0,NULL,'',1,1,0,0,'+1 (821) 981-6548','Ulla Norton',NULL,'Agency','Voluptates vitae tem','Customer Service',0,NULL,'Praesentium voluptat','2025-04-24 14:15:39','2025-04-24 14:15:39'),(4,0,NULL,'',0,1,1,0,'+1 (386) 542-3003','Ora Collier',NULL,'Agency','Labore illo natus te','Customer Service',0,NULL,'Deserunt dolorem mol','2025-04-24 14:19:10','2025-04-24 14:19:10'),(5,0,NULL,'',0,0,1,1,'+1 (693) 752-9674','Michael Dickerson',NULL,'Agency','In voluptatem Repre','Customer Service',1,NULL,'Quaerat eius esse c','2025-04-24 14:21:52','2025-04-24 14:21:52'),(6,0,NULL,'',0,1,0,1,'+1 (513) 482-5433','Keefe Carr',NULL,'Agency','Aut culpa impedit','Customer Service',0,NULL,'Nulla delectus mini','2025-04-24 14:22:14','2025-04-24 14:22:14'),(7,1,NULL,'',1,0,1,0,'+1 (975) 359-8249','Chloe May',NULL,'Agency','Rerum eum sit earum','Customer Service',1,NULL,'Vitae hic dolore sit','2025-04-24 14:40:17','2025-04-24 14:40:17'),(8,1,NULL,'',1,1,1,1,'+1 (644) 317-9572','Wilma Moody',NULL,'Agency','In nulla cillum labo','Customer Service',0,NULL,'Iusto dolor quis quo','2025-04-24 14:53:21','2025-04-24 14:53:21'),(9,1,NULL,'',1,1,0,1,'+1 (836) 912-5479','Wanda Patel',NULL,'Agency','Adipisicing totam cu','Customer Service',0,NULL,'Saepe qui et et anim','2025-04-24 15:19:25','2025-04-24 15:19:25'),(10,1,NULL,'',1,1,1,1,'+1 (678) 364-9033','Christopher Douglas',NULL,'Company Id','Laborum culpa sit e','Sale',1,NULL,'At adipisicing non d','2025-04-24 17:20:58','2025-04-24 17:20:58'),(11,1,NULL,'',1,1,1,1,'+1 (124) 809-1766','Fritz Malone',NULL,'Airline Mix','Optio nihil qui tot','Changes (date/time/name changes)',0,NULL,'Sit quam sit error','2025-04-24 17:22:15','2025-04-24 17:22:15'),(12,1,NULL,'SPA1000000012',0,0,1,1,'+1 (349) 541-9043','Christine Finch',NULL,'Spanish','Sunt magna veniam p','Spam-Blank',0,NULL,'Porro nesciunt enim','2025-04-25 00:03:39','2025-04-25 00:03:39'),(13,1,NULL,'COM1000000013',0,1,1,1,'+1 (652) 933-1468','Kareem Galloway',NULL,'Company Id','Magna corporis sunt','Sale',0,NULL,'Non voluptate ex vel','2025-04-25 00:09:25','2025-04-25 00:09:25'),(14,1,NULL,'BUF1000000014',1,0,1,0,'18943588146','Mark Elliott',NULL,'Buffer Mix','Sed corrupti at bea','Changes (date/time/name changes)',0,NULL,'Voluptas voluptates','2025-04-25 01:07:10','2025-04-25 01:07:10'),(15,1,NULL,'AIR1000000015',1,1,1,0,'895624120','testdsdsds',NULL,'Airline Mix','sasadsdsds','Follow Up',1,NULL,'sdsds','2025-05-04 19:21:10','2025-05-04 19:21:10'),(16,1,'3','BUF1000000016',0,1,0,0,'11','111','Tamekah Craig','Buffer Mix','test','FollowUp',0,NULL,'YEST','2025-05-05 07:35:47','2025-05-05 08:38:42'),(17,1,'1','INT1000000017',1,1,0,0,'1188681997','Alexander Pacheco',NULL,'International','Et in fugit ab aut','FollowUp',1,'2025-05-18 00:01:00','Dolor consectetur vo TETS','2025-05-17 14:27:34','2025-05-17 14:27:34'),(18,1,'1','',0,1,0,0,'1108418376','Odysseus Dawson',NULL,'International','Hic aperiam aut faci','FollowUp',0,'2025-05-22 01:05:00','Quia pariatur Possi TEst','2025-05-17 14:32:02','2025-05-17 14:32:02');
/*!40000 ALTER TABLE `call_logs` ENABLE KEYS */;

--
-- Table structure for table `call_types`
--

DROP TABLE IF EXISTS `call_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_types`
--

/*!40000 ALTER TABLE `call_types` DISABLE KEYS */;
INSERT INTO `call_types` VALUES (1,'Customer Service (Baggage, Wheelchair etc..)','Customer Service',1,NULL,NULL),(2,'Wrong number (other than the airlines calls)','Wrong number',1,NULL,NULL),(3,'Fare Enquiry','Fare Enquiry',1,NULL,NULL),(4,'Changes','Changes (date/time/name changes)',1,NULL,NULL),(5,'Cancellation','Cancellation',1,NULL,NULL),(6,'Spam-Manual','Spam-Manual',1,NULL,NULL),(7,'Spam-Blank','Spam-Blank',1,NULL,NULL),(8,'Sale','Sale',1,NULL,NULL),(9,'Spanish','Spanish',1,NULL,NULL),(10,'Existing','Existing',1,NULL,NULL),(11,'FollowUp','FollowUp',1,NULL,NULL);
/*!40000 ALTER TABLE `call_types` ENABLE KEYS */;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (2,'Airline Mix',0,NULL,'2025-04-27 18:02:06'),(3,'Buffer Mix',1,NULL,NULL),(4,'Cruise',1,NULL,NULL),(5,'International',1,NULL,NULL),(6,'LCC',1,NULL,NULL),(7,'Major Mix',1,NULL,NULL),(8,'Spanish',1,NULL,NULL),(11,'Addison Bradley',0,'2025-04-27 18:04:03','2025-04-27 18:04:03');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'flydreamz','flydreamz',NULL,NULL),(2,'cruiseroyals','cruiseroyals',NULL,NULL),(3,'fareticketsllc','fareticketsllc',NULL,NULL),(4,'fareticketsus','fareticketsus',NULL,NULL);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Boarding Pass','Thank you for contacting Reservation Desk!','fdsgdfsgfdgdfgdf',NULL,'2025-04-27 17:32:02'),(2,'eTicket','Thank you for contacting Reservation Desk!','bgfg gsdgdfgfd',NULL,'2025-04-27 17:31:12'),(3,'Exchanges','Thank you for contacting Reservation Desk!	','',NULL,NULL),(4,'Cancellation','Thank you for contacting Reservation Desk!	','',NULL,NULL),(5,'Confirmation','Thank you for contacting Reservation Desk!	','',NULL,NULL),(8,'Kylan Dejesus','Deserunt qui enim qu','Laborum Maiores vol','2025-04-27 17:18:26','2025-04-27 17:18:26'),(9,'Anastasia Gutierrez','Esse quia labore vit','Est exercitation dol','2025-04-27 17:18:51','2025-04-27 17:18:51'),(10,'Alexandra Soto','Sed quia animi expe','Hic exercitation occ','2025-04-27 17:19:17','2025-04-27 17:19:17'),(11,'Garrett Hoover','Laborum perferendis','Necessitatibus in ei','2025-04-27 17:20:19','2025-04-27 17:20:19');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(30) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `calllog_id` varchar(20) NOT NULL,
  `comment` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'CallLog','Viewed','14','You have seen the call log',1,'2025-05-05 19:07:24','0000-00-00 00:00:00'),(2,'CallLog','Viewed','14','You have seen the call log',1,'2025-05-04 19:07:46','2025-05-04 19:07:46'),(3,'CallLog','created','15','Call Log created successfully',1,'2025-05-04 19:21:10','2025-05-04 19:21:10'),(4,'CallLog','created','16','Call Log created successfully',1,'2025-05-05 07:35:47','2025-05-05 07:35:47'),(5,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:00','2025-05-05 08:35:00'),(6,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:06','2025-05-05 08:35:06'),(7,'CallLog','Updated','16','Field \'team\' updated from \'\' to \'flydreamz\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(8,'CallLog','Updated','16','Field \'call_converted\' updated from \'1\' to \'0\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(9,'CallLog','Updated','16','Field \'followup_date\' updated from \'2025-05-05 09:35:00\' to \'\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(10,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(11,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:17','2025-05-05 08:37:17'),(12,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:32','2025-05-05 08:37:32'),(13,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:37','2025-05-05 08:37:37'),(14,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:39','2025-05-05 08:37:39'),(15,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:38:36','2025-05-05 08:38:36'),(16,'CallLog','Updated','16','Field \'team\' updated from \'flydreamz\' to \'Tamekah Craig\'',1,'2025-05-05 08:38:42','2025-05-05 08:38:42'),(17,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:38:42','2025-05-05 08:38:42'),(18,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:39:56','2025-05-05 08:39:56'),(19,'CallLog','created','17','Call Log created successfully',1,'2025-05-17 14:27:34','2025-05-17 14:27:34'),(20,'CallLog','created','18','Call Log created successfully',1,'2025-05-17 14:32:02','2025-05-17 14:32:02'),(21,'CallLog','Viewed','17','You have seen the call log',1,'2025-05-17 14:32:24','2025-05-17 14:32:24');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_09_205250_create_statuses_table',2),(5,'2025_04_09_205251_create_suppliers_table',2),(6,'2025_04_09_205252_create_qualities_table',2),(7,'2025_04_09_205253_create_teams_table',2),(8,'2025_04_09_205254_create_campaigns_table',2),(9,'2025_04_09_205255_create_call_types_table',2),(10,'2025_04_09_205256_create_quality_feedbacks_table',2),(11,'2025_04_09_205257_create_booking_statuses_table',2),(12,'2025_04_09_205257_create_query_types_table',2),(13,'2025_04_09_205258_create_payment_statuses_table',2),(14,'2025_04_09_210530_add_value_to_query_types_table',3),(15,'2025_04_09_212632_create_companies_table',4),(16,'2025_04_09_221722_create_call_logs_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

--
-- Table structure for table `payment_statuses`
--

DROP TABLE IF EXISTS `payment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_statuses`
--

/*!40000 ALTER TABLE `payment_statuses` DISABLE KEYS */;
INSERT INTO `payment_statuses` VALUES (1,'Pending',1,NULL,NULL);
/*!40000 ALTER TABLE `payment_statuses` ENABLE KEYS */;

--
-- Table structure for table `qualities`
--

DROP TABLE IF EXISTS `qualities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualities`
--

/*!40000 ALTER TABLE `qualities` DISABLE KEYS */;
/*!40000 ALTER TABLE `qualities` ENABLE KEYS */;

--
-- Table structure for table `quality_feedbacks`
--

DROP TABLE IF EXISTS `quality_feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quality_feedbacks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quality_feedbacks`
--

/*!40000 ALTER TABLE `quality_feedbacks` DISABLE KEYS */;
INSERT INTO `quality_feedbacks` VALUES (1,'Probing & Understanding',1,NULL,NULL),(2,'Dead air/Hold procedure',1,NULL,NULL),(3,'Soft Skills',1,NULL,NULL),(4,'Active Listening/Interruption',1,NULL,NULL),(5,'Call Handling',1,NULL,NULL),(6,'Selling Skills',1,NULL,NULL),(7,'Cross Selling',1,NULL,NULL),(8,'Documentation',1,NULL,NULL),(9,'Disposition',1,NULL,NULL),(10,'Call Closing',1,NULL,NULL),(11,'Fatal - Misrepresentation',1,NULL,NULL),(12,'Fatal - Rude/Sarcastic behaviour',1,NULL,NULL),(13,'Fatal - Unethical sale',1,NULL,NULL),(14,'Paraphrasing',1,NULL,NULL);
/*!40000 ALTER TABLE `quality_feedbacks` ENABLE KEYS */;

--
-- Table structure for table `query_types`
--

DROP TABLE IF EXISTS `query_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `query_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `query_types`
--

/*!40000 ALTER TABLE `query_types` DISABLE KEYS */;
INSERT INTO `query_types` VALUES (1,'New Booking','N',1,NULL,NULL),(2,'New Booking (Credit)','NC',1,NULL,NULL),(3,'Air Miles','M',1,NULL,NULL),(4,'Cancel (Credit)','CC',1,NULL,NULL),(5,'Cancel (Refund)','CR',1,NULL,NULL),(6,'Change','CH',1,NULL,NULL),(7,'Upgrade','U',1,NULL,NULL),(8,'Name Correction','NMC',1,NULL,NULL),(9,'Seat Assignment','S',1,NULL,NULL),(10,'Baggage Addition','B',1,NULL,NULL);
/*!40000 ALTER TABLE `query_types` ENABLE KEYS */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1OIB4pECavEcGFvYlgu4YqQDkb4Z8S7BxcTOv7x4',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRldqVXZZdEhYWkRYNW1PcFhjOTZONHRoMThCeFd1Y3VCSHJDUGVpaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nLWluZm9ybWF0aW9uIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1747525743),('jUYUDTloFSA63hSCE9PSwZH7U965jm0F4tMI3iEo',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRUpFbVd3SDlsaDN0UXhJdDR0bjZzV1gzU1Z4TGdZdjZ6Snk0U1BVRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NhbGwtbG9ncy9jcmVhdGUiO319',1748276228),('nkUKBaahFZ5nK2EHkcpqaRHVNDKrRcwotIGUcQxb',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidUNyMXVmelRXd0hCTnExUHFiMzVjZWNaV08yekNWeTg4YVhZVTMwSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nLWluZm9ybWF0aW9uIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1749680160),('DHy99zDwiCJ0GroZbDKJkcBCAtWx8qGOAKUsEyJJ',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidE9WemRlS3NhaGxMeVc5aWRwc0lBcE5TdFVISm83T3BCdFVndVV4WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nLWluZm9ybWF0aW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1749973922);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'flydreamz',1,NULL,'2025-04-27 17:44:02'),(2,'fareticketsllc',1,NULL,NULL),(3,'fareticketsus',1,NULL,NULL),(5,'vxbvcxbcvbvcb',0,'2025-04-27 17:41:32','2025-04-27 17:41:32'),(6,'Tamekah Craig',1,'2025-04-27 17:49:24','2025-04-27 17:49:39'),(7,'Calll Type',0,'2025-04-27 18:54:40','2025-04-27 18:54:40'),(8,'dsdsdsds',0,'2025-04-27 18:55:43','2025-04-27 18:55:43');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;

--
-- Table structure for table `travel_billing_details`
--

DROP TABLE IF EXISTS `travel_billing_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_billing_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `cc_number` varchar(50) DEFAULT NULL,
  `cc_holder_name` varchar(255) DEFAULT NULL,
  `exp_month` varchar(2) DEFAULT NULL,
  `exp_year` varchar(4) DEFAULT NULL,
  `cvv` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'USD',
  `amount` decimal(10,2) DEFAULT '0.00',
  `is_active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_billing_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_billing_details`
--

/*!40000 ALTER TABLE `travel_billing_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_billing_details` ENABLE KEYS */;

--
-- Table structure for table `travel_booking_remarks`
--

DROP TABLE IF EXISTS `travel_booking_remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_booking_remarks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `particulars` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_booking_remarks_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_booking_remarks`
--

/*!40000 ALTER TABLE `travel_booking_remarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_booking_remarks` ENABLE KEYS */;

--
-- Table structure for table `travel_booking_types`
--

DROP TABLE IF EXISTS `travel_booking_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_booking_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `type` enum('Flight','Hotel','Cruise','Car') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_booking_types_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_booking_types`
--

/*!40000 ALTER TABLE `travel_booking_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_booking_types` ENABLE KEYS */;

--
-- Table structure for table `travel_bookings`
--

DROP TABLE IF EXISTS `travel_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pnr` varchar(50) NOT NULL,
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
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnr` (`pnr`),
  KEY `idx_pnr` (`pnr`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_bookings`
--

/*!40000 ALTER TABLE `travel_bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_bookings` ENABLE KEYS */;

--
-- Table structure for table `travel_passengers`
--

DROP TABLE IF EXISTS `travel_passengers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_passengers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `passenger_type` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `seat_number` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `credit_note_amount` decimal(10,2) DEFAULT '0.00',
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `e_ticket_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_booking_id` (`booking_id`),
  CONSTRAINT `travel_passengers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_passengers`
--

/*!40000 ALTER TABLE `travel_passengers` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_passengers` ENABLE KEYS */;

--
-- Table structure for table `travel_pricing_details`
--

DROP TABLE IF EXISTS `travel_pricing_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_pricing_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `hotel_cost` decimal(10,2) DEFAULT '0.00',
  `cruise_cost` decimal(10,2) DEFAULT '0.00',
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `advisor_mco` decimal(10,2) DEFAULT '0.00',
  `conversion_charge` decimal(10,2) DEFAULT '0.00',
  `airline_commission` decimal(10,2) DEFAULT '0.00',
  `final_amount` decimal(10,2) DEFAULT '0.00',
  `merchant` varchar(255) DEFAULT NULL,
  `net_mco` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_pricing_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_pricing_details`
--

/*!40000 ALTER TABLE `travel_pricing_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_pricing_details` ENABLE KEYS */;

--
-- Table structure for table `travel_quality_feedback`
--

DROP TABLE IF EXISTS `travel_quality_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_quality_feedback` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `qa` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `feedback` text,
  `parameters` varchar(255) DEFAULT NULL,
  `status` enum('Pass','Fail','Pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_quality_feedback_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_quality_feedback`
--

/*!40000 ALTER TABLE `travel_quality_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_quality_feedback` ENABLE KEYS */;

--
-- Table structure for table `travel_screenshots`
--

DROP TABLE IF EXISTS `travel_screenshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_screenshots` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `type` enum('Flight','Hotel','Car') DEFAULT NULL,
  `notes` text,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_screenshots_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_screenshots`
--

/*!40000 ALTER TABLE `travel_screenshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_screenshots` ENABLE KEYS */;

--
-- Table structure for table `travel_sector_details`
--

DROP TABLE IF EXISTS `travel_sector_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_sector_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `sector_type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_sector_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_sector_details`
--

/*!40000 ALTER TABLE `travel_sector_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_sector_details` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departments` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@example.com',NULL,'$2y$12$XoVEIFSeOdrD.E7SW.JtveKCRx9oXU1rCdqVkrX.NoXG1GLvldk62','LjmK85ZkLvZUKTR0rbkNcVfPrmlRhV4yWGNRQSo002V7aTHZ07C3vABXZWSS',1,'admin','2025-04-24 13:05:20','2025-04-24 13:05:20','0',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Dumping routines for database 'cheapoflyllc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-15 20:45:21
