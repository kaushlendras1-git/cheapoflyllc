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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'CallLog','Viewed','14','You have seen the call log',1,'2025-05-05 19:07:24','0000-00-00 00:00:00'),(2,'CallLog','Viewed','14','You have seen the call log',1,'2025-05-04 19:07:46','2025-05-04 19:07:46'),(3,'CallLog','created','15','Call Log created successfully',1,'2025-05-04 19:21:10','2025-05-04 19:21:10'),(4,'CallLog','created','16','Call Log created successfully',1,'2025-05-05 07:35:47','2025-05-05 07:35:47'),(5,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:00','2025-05-05 08:35:00'),(6,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:06','2025-05-05 08:35:06'),(7,'CallLog','Updated','16','Field \'team\' updated from \'\' to \'flydreamz\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(8,'CallLog','Updated','16','Field \'call_converted\' updated from \'1\' to \'0\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(9,'CallLog','Updated','16','Field \'followup_date\' updated from \'2025-05-05 09:35:00\' to \'\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(10,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(11,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:17','2025-05-05 08:37:17'),(12,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:32','2025-05-05 08:37:32'),(13,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:37','2025-05-05 08:37:37'),(14,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:39','2025-05-05 08:37:39'),(15,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:38:36','2025-05-05 08:38:36'),(16,'CallLog','Updated','16','Field \'team\' updated from \'flydreamz\' to \'Tamekah Craig\'',1,'2025-05-05 08:38:42','2025-05-05 08:38:42'),(17,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:38:42','2025-05-05 08:38:42'),(18,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:39:56','2025-05-05 08:39:56'),(19,'CallLog','created','17','Call Log created successfully',1,'2025-05-17 14:27:34','2025-05-17 14:27:34'),(20,'CallLog','created','18','Call Log created successfully',1,'2025-05-17 14:32:02','2025-05-17 14:32:02'),(21,'CallLog','Viewed','17','You have seen the call log',1,'2025-05-17 14:32:24','2025-05-17 14:32:24'),(22,'CallLog','Viewed','17','You have seen the call log',1,'2025-06-16 17:52:35','2025-06-16 17:52:35'),(23,'CallLog','Viewed','18','You have seen the call log',1,'2025-06-18 15:56:36','2025-06-18 15:56:36');
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
INSERT INTO `sessions` VALUES ('QWRwOdfPihdKKBhSJuo8lRjvGUjEucik5egFpf71',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0VNdGdrMVB2ODhlS2x6RHpkTks5aXNZMGdHUjRYdGpoN2Zrd0lmQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1750359472),('56LOhpQUow21vcuFvfgnAK1lEMhSgJXPhEbaSVdX',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQXJsN3Y0R3ZsTFAweTJxa3BrNWF3OUlwSDBYTGJNckVwdjNUWG5YViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZGQtYm9va2luZyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1750367533);
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
  `amount` decimal(10,2) DEFAULT '0.00',
  `is_active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_billing_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_billing_details`
--

/*!40000 ALTER TABLE `travel_billing_details` DISABLE KEYS */;
INSERT INTO `travel_billing_details` VALUES (1,5,'Aut non asperiores q','eyJpdiI6ImNQT1hWRm9uaXhKSnJwQlYyUU1KaFE9PSIsInZhbHVlIjoiRVkvM215N3ZZWlFaaC9iOFNrdFdoQT09IiwibWFjIjoiNWQwZmMwMzY0NzIwMmY4ZjU3ZmZhYjAyYzJkMmMwZWJkMGU2YTlkMjA0NGYwNWZjMjEwYjVkOWNmMzZjYmRmZiIsInRhZyI6IiJ9','Flynn Dorsey','11','1979','eyJpdiI6IkZ5Tk9teU01NDM1U3prdWE1Wmt0dEE9PSIsInZhbHVlIjoiS0ltR1VSb3hKMTNCaFFDOWtxb1FJZz09IiwibWFjIjoiMjI2N2I5M2M2ZmE4YmU0MjljM2YyNGZkN2Y0NWY4MzQyYzhlNDNjYjhmNjM1YjA5ZDQwZTNmZTZiNDUyMTY4NSIsInRhZyI6IiJ9','Dolorem voluptatem p','tiduxi@mailinator.com','9876789878','Et pariatur Facere','Et aut saepe nulla e','Ipsam consectetur qu','31701','INR',7.00,0,'2025-06-16 14:34:46','2025-06-16 20:04:46',NULL),(2,6,'VISA','eyJpdiI6IlV5NWlWWldjYTVtUlB2VVlkSGtrYVE9PSIsInZhbHVlIjoiREQreE1oTFVkWkUrMW1UZkZUUDhtRkJnV0dJclE0dmtxcEIwMkd5cE9nVT0iLCJtYWMiOiI5OGYzNGQzYzlmMmNkMjI4NjQxMWJkMDUyYjFhMzYwYTNhYWVhOTMyNDMyY2Y3MTAwNmE4MzM5ZTY0ZGRlNWQxIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IkwxVnBnc0M3aFVYaXczMER2L2s2S2c9PSIsInZhbHVlIjoiVFNQNUtIVG5WaWh3UDlLWkIrbGxEUT09IiwibWFjIjoiYmEyODEzYWRiOTRjM2MwMTFiMWJiMWQyYmY0MjQxODQ0Y2E4NGE5ZDM0ZGQzNzFmYWQ5ZDBmMThhMzg4YTdlYiIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 16:19:13','2025-06-16 21:49:13',NULL),(3,7,'VISA','eyJpdiI6Ik93bFJNMGM5ZDFYV2VEYTBEWmdDZ3c9PSIsInZhbHVlIjoieEFVZnJrbEVmcDIzejBHUUhhNTVlRER0SlJMNWZ5Q0owcTJ2L1RYeXlqMD0iLCJtYWMiOiI3ZWQwMGFmOTA1NGIxZmJmODUyMGQ5MDVhZTAyNDVhZTZkY2I0MmRhZjJlNDMwMTNhMmU1YmNmYjUxZmUxNmFiIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6InYwcHNzTE1wRnhaNDBvSyt4NXc4cnc9PSIsInZhbHVlIjoiRi9kNnF3UnlCMXpJcUgvcXg5ZXl0UT09IiwibWFjIjoiNWI0ZDRkMTgwMzhlYTY2YTc4YWFjODUxNzNkNWVkNDMxN2YxYjFmZDg4MzViZWJjYjYzNjkyZmE4YWQ2OGIxZSIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 16:23:00','2025-06-16 21:53:00',NULL),(4,8,'VISA','eyJpdiI6IlBNYUZoc1BvNUxKYU1QclRXVkV3aXc9PSIsInZhbHVlIjoiQ3NMK2JjN1NoODM2dHJBL045RnBXdTZYOWQwQjArdDRkV2I0YlFjWTFRbz0iLCJtYWMiOiJhYmNkZWFjMDJiNDgwMTc5MWM0MzJmM2NiZjgyMmU3OWNlNWZmYTIxMDFlOTU5YmVhMzYxNDM3ZDRkZTgzZTQ1IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IkxNay95Qm84ZlZBZ0MyKzYvWmVGYWc9PSIsInZhbHVlIjoiaEwyUHZzNGQzZGsxQldwNXhEeTFBdz09IiwibWFjIjoiY2EyMTM1NzM1ZDYxYmNhOTM2NDhjYmZkZjllNWI1MjU5ZjdhZTQwNjMzN2ViY2QzNGMzYTg2NmU5MDIwODhhYyIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 16:34:11','2025-06-16 22:04:11',NULL),(5,9,'VISA','eyJpdiI6InpoS3BrcklJRUtaMy8rUnZFTVFWMWc9PSIsInZhbHVlIjoia2lJTUU0OTExREViWlRIbTZjSTNGcDBtRmpUMnRwNHN2c0lMNjN4TGNJVT0iLCJtYWMiOiIzODRlYjk2YWM5MTQ0OWU2NzYzMDVkOTMzZjQ5NDlkYTc3MWZkYmRjNWU3OTM2Y2I1ZjM4ODNlNDllNjIyMDY2IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IkhUNHJIRTZZcENvZWdKNlExZ213c0E9PSIsInZhbHVlIjoiaDR1a1BTWDM3dzlYbENwOGhzaXo2dz09IiwibWFjIjoiYmVjMTRkOTgzZWQzZDQ1MjZjNTlmOTQxYjAxYzE1Yjc3ZWM3ZjAwMTMwYTNmMDcyNTQ2ZGM2YjUzYjQ3MDYwOSIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 16:37:38','2025-06-16 22:07:38',NULL),(6,11,'VISA','eyJpdiI6IkpWZHZWZVpiU21YUFNPUkRVZ0UxMEE9PSIsInZhbHVlIjoibGVpWFlZWWtrMFJzWi9SVzJmYlkxQ1JZQ3c5R2ROTzJuTEVvTkprRnJiQT0iLCJtYWMiOiJjZWQ3ZGUwMzQ0N2I1ZGFhYjkxNmZmZDA3ZTQ1YmViZjgzYThiMmJhZGMzYjcyYTJjNzY3MWNmNjdkMDRlOTliIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IjZyQjRPSlNwY09KcFJ2ZTN3eUdOWXc9PSIsInZhbHVlIjoiQmQzZEZNSERJekFyd2dGbjVOendydz09IiwibWFjIjoiYjI2MTk4YjhmODFkNDk0ZTY5M2UxNDE0YzRiMTM2OTUwOWY5OGYwNmJiMWFkMmQwM2I4YTNlMzdiZmY1NThiOCIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 16:38:45','2025-06-16 22:08:45',NULL),(7,12,'VISA','eyJpdiI6IlZHVktrZ2RyVEZJR25qZ0huOFM2L3c9PSIsInZhbHVlIjoidTllcjE4VmMrSVFWRjJZOGZUMlRoby96V0hBd25mSmdCV2piQ2k0UmdpZz0iLCJtYWMiOiIxOTIzNzJiZWM5N2QyYmQ0YjMyNmNkZDQyMDBmOThkNWM2NzNjYzNkODM1YjU3NTUzY2FhOWM2ZDVmODFmMzY5IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6Im1uRGxzdG9QemhMamVwZ1FvblpXOXc9PSIsInZhbHVlIjoiNisvYnBYMmxFUW93NzVDN04yTFljdz09IiwibWFjIjoiOWI2OGQzNzU5ODcxODUwNTNmNzUyNmYwNzhjOGIwOTVhZDBmMDA3Y2Q3YzM1YThkZjI5ODc1ZDY5MWI4ZDI2MyIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 16:42:16','2025-06-16 22:43:36','2025-06-16 22:43:36'),(8,12,'VISA','eyJpdiI6IkRnYUxzTVFNeE9nUWlwZjlIcDE0U2c9PSIsInZhbHVlIjoic2tjcEdZU0dlNEphRDcyWCtyZHZYbzVHVjRLYmFCQ0Jrb1E2S2w4ZVRKZz0iLCJtYWMiOiIzMzdiN2IyMTVmNzI1OGZhYmRiNWIyYjY5Y2M0NzQyYjAxYjlkNjJlNzQyOTIzZjk0N2Q3ZDNiNzJmODkwZjE1IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6ImphN2pMd3RKR1AvMUtlZ2VtWUxhRHc9PSIsInZhbHVlIjoiSFVxUHNKOEVCc3U0aGhVYVVod2dTUT09IiwibWFjIjoiYTYyOGUyMTM1OWE5OGIyOWYxNjZkYWQ5NDRiNGUyMzgyMTQ1MDllNTE5NDZkODQ4MzVmMTFlMTBmMTkxZTJiZiIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:13:36','2025-06-16 22:44:20','2025-06-16 22:44:20'),(9,12,'VISA','eyJpdiI6IlhSejlHSmJwaEtWUXYycWVETHBjOGc9PSIsInZhbHVlIjoiN3lOalZsN01IanJMMXN2eisyczdOcndJdzV0aVpzYUJPYVZlVXgvZFdLcz0iLCJtYWMiOiJhZGJhYTM4Y2JmZmE0MDA1ZTM3Mzk4ZGM3OWM3OWUyODNlNDViOWU0MDQ4ZDc0MWU5NDAyYzRhNWMyNDU3YWNlIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6ImpmOWtQZ29rNGtOeUZXYmFIT3lDa1E9PSIsInZhbHVlIjoiTTR5ckJ4MnpGUGh4RG8rSTJlcTBLdz09IiwibWFjIjoiMjdmODM1NmNkYThiODBiYTU4MGI3NDQwMjA4NWNiMWIwMGQzY2ZmYzM5OTU0OTJiNzhhZGE0NDNiMzA1OGU3MCIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:14:20','2025-06-16 22:44:35','2025-06-16 22:44:35'),(10,12,'VISA','eyJpdiI6Im9zTEgvaXR4T3JDTEVoMDJCT3ViSkE9PSIsInZhbHVlIjoiSWFKMno3ZVhiZy9saUIrYjZxTElTSnFzWGZadkE2TGRzeWoza2NDcDNlUT0iLCJtYWMiOiI3NWE2NWNhNTZiZjc4MzZlM2Y0NjM2MjNmZDdhMGRlZjU3ZGEzOTg1OTk4NWVkOTEyYmZhMjJmNmEzZGFiNTU3IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IlF2M0xtUDdycTIyb05tT0x2VlhDVEE9PSIsInZhbHVlIjoiTHVvanh3RWlJYUVzNzhtZTN1UTBNUT09IiwibWFjIjoiMGM4MjdkZmUwOTRjMWFmMTBmMGFjZDA1MTc3YzJiOTkxNGRiMDU1YzQ0YTU0NjBmZWNkYjk4ZjRhYjQ2NzVlYSIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:14:35','2025-06-16 22:45:18','2025-06-16 22:45:18'),(11,12,'VISA','eyJpdiI6ImdRM0ZoTGR3bEZZSFVkY0RSenlIT0E9PSIsInZhbHVlIjoiVWhzUEFSK2h1dENLcm1xNUkvcEtqMGZzR01JR3E0Qkh0SUFNZHE3aENiOD0iLCJtYWMiOiIzZjE1MmJmMjhhOGFjYjY1M2ZhZjFlMTBlNWFhMGZhZWE1NjViMWJiZGZjMjljYWZlNGFlYjUzNzEzNmQxMjAwIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6InRhcHhnbDFQVUw3eXEvdXhGUzZOMkE9PSIsInZhbHVlIjoid1NNRkc4MDVoWWJsMkxPZmdiODhCUT09IiwibWFjIjoiYjBiMGQ4NTAyNGUxYTVkZTlkMWRmMWU5ZmRhNGY4YzAxNzYyYWU5NmQ4NDU5YWUzNTkwZTliODgwZWM5M2IwNSIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:15:18','2025-06-16 22:53:56','2025-06-16 22:53:56'),(12,12,'VISA','eyJpdiI6IkljQ21hL2RFQXJMQWd3M3o5MEM0Wmc9PSIsInZhbHVlIjoiNFlmNndmSmIreVkydnU1MHZKQlJZQVZNczh0YUs4Vnl6ZEh3RVNQN3Fubz0iLCJtYWMiOiIwZDIxMDhmODI0MWQ4ZjI3OTJhODViNzhiNTAxNTAyNzg5MWVlYTY0ZmJlZTdjZjM2OTBhZjU4M2FhZjAwNjQ5IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IjJaVktEMzVFNmR4elRvNHBpT3l0ZGc9PSIsInZhbHVlIjoiN2Q3dlpuT2F6WFI2U0IxaUZnb1JrZz09IiwibWFjIjoiMWJkNWQ4YTg4ZGRiZDg3ZmUyNTI1MGVjNzA1NGY4ZGExZDVlMDBkYWY3MjFhMmU4M2JhMTk3ZWU5NGY1MzhiYyIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:23:56','2025-06-16 22:54:55','2025-06-16 22:54:55'),(13,12,'VISA','eyJpdiI6IldXV0s2TEtZbFJWYVVUSEk2Zk5zRWc9PSIsInZhbHVlIjoiRUNTYmN2VlN1TmxIM0lhNkVXc1E1R2pDWEZNd216TDUvWkxWWXNxcUJvZz0iLCJtYWMiOiJmNDM2MDI3ZWVhNjg3Mjg0NmQwMDQyZWRjZDg5MTZjZTQyYTg4N2ZmZjU0YTJlNzFkNjMyZGMzNTY4ZGRjZjViIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IjMwdEZpWnYycGZHZ21ucktRK1B1amc9PSIsInZhbHVlIjoiSDI5N2ZidUlkeDZ3UFpZWldiTFVmZz09IiwibWFjIjoiNjY0N2QzMzBmM2IzZDU3OTNhNThmYTYzYTczNjk4NjE0ZmRhYzk5MDgyMjM3MThhYWMwNjZjOTRiZWUxM2Y0YiIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:24:55','2025-06-16 22:55:58','2025-06-16 22:55:58'),(14,12,'VISA','eyJpdiI6IjdxcWtGOXlpRzFwczZ2YlRRRGZYVEE9PSIsInZhbHVlIjoiYlVNdkFxKzZta2k4andZM2xONjU2eExRdzkxbmRvNnFOK3pQQi9yUGJsTT0iLCJtYWMiOiI2MzFjY2UwMThjY2I2NTQwZTA0YTQ3YjAzMWUxODhlMWM1NDBkMWQwMTVjYjJkYmZjNzBjYWFiODA2ZThiNDMyIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IlEvbmlNTmRJdjM2Mjd6VjlCL0o4RUE9PSIsInZhbHVlIjoicjhxMVhXY1U5b1l5VUN1SXNSMXBadz09IiwibWFjIjoiMTNmMjgzMTJkMDk4YzNiOTZhZWM1ZWFlMTQxOTlmNDg0MWQxOTE0NjI0YzBmNGRhZjUwNmQwMzc5OWQyZmEyMiIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:25:58','2025-06-16 22:58:05','2025-06-16 22:58:05'),(15,12,'VISA','eyJpdiI6ImZKL3ZmTStoMHFaR205czNvS01mTFE9PSIsInZhbHVlIjoiaVJMendRTGgrc09qS2ErOGpZQVZUV3pBSm5pblRGQXYrYlRIMzdWZWFvdz0iLCJtYWMiOiI1ZDY0NGRhODc0YjI0NDU5NGFkMDc0YzY3NTM1YmFhZWM1NTQyZWIwOTg2MGFmY2QzZDRhMWM4NmQxMTRlOTg4IiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6ImIwRVE3TzVEdzUyZjh1RVg2Vzc3SFE9PSIsInZhbHVlIjoiNHNUanZVNHV3ZGorNmh0bzBZdFdMdz09IiwibWFjIjoiNGY4Zjc0MzgzYTBiY2JiODVkMjRjYjBlZGZmOTg3NmIyZWFlM2I4NjExYzMwYTVhMzQ1ZTU1MjhhMDAzODNjMCIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:28:05','2025-06-16 22:58:28','2025-06-16 22:58:28'),(16,12,'VISA','eyJpdiI6IjlNcHFRTnNoZ085TlZwMk9oOUtOTXc9PSIsInZhbHVlIjoieGpwZFJVZDZBWWR4NmhkSFhBTHF0aDFxZWFqQVdlTElxRGRwWUlhWmo4ST0iLCJtYWMiOiI3NTU0MTMwZmFkNGNjOWMzNTIzYzJkMmU2MDE2MzFhMjY4N2VjY2Q0MTZkZTYxNWVhOGI2ODFmNTRjZjI4ZTMwIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6Ik5DTThQK1hzcW9sa25EVXhZM3hvL2c9PSIsInZhbHVlIjoibEc0QWhOT0JlY2ZGaSs0Smk1VFVNZz09IiwibWFjIjoiYWVlNDY5OTdjODFhYTM5ZmMwNTc4NjM1MjdmOGU2Nzg2YTkyMjVmZDJmOGU1ZThlMTg4ZGVhN2QwZjc5NTdhMiIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-16 17:28:28','2025-06-16 23:18:33','2025-06-16 23:18:33'),(17,12,'Corporis aut dolor a','eyJpdiI6IlNIMy9BRmpkQTg4Um1yakk4Qk5uYlE9PSIsInZhbHVlIjoiNTdzUEFxM1V3NVZaL3h0WjF5aTRCdz09IiwibWFjIjoiZmMzY2QzNjM1MWUyN2RjODU2YzY1ZTA1OGI5ZDNkYWU0N2I1MDBiNTliZDE4NjUyNjVlNjVhYjRiYzMxMzhiNCIsInRhZyI6IiJ9','Kylie Middleton','11','1981','eyJpdiI6IkxNUnFZbnRGZjkzNVlOMjhNdFZ4ZWc9PSIsInZhbHVlIjoiNDBIazJWL1Vtd212M0kya3ZRU3dHakNCUElHNHJSUDdtLytLMUxGSU5ZWT0iLCJtYWMiOiIxZGU3YTVhNDgyM2Y3Mzc4YzZkOWY0Njg1YzNkZDAwMTVhNDg5NjA4YjM2OGYxNTc2YTYyYmEyMjhjY2ViNjU2IiwidGFnIjoiIn0=','Eum culpa lorem ut e','tyzevetisy@mailinator.com','Enim dolore veritati','Perferendis quas omn','Quam nihil ut dolore','Ad quidem occaecat q','12537','Fugiat obcaecati ali',87.00,0,'2025-06-16 17:48:33','2025-06-16 23:19:29','2025-06-16 23:19:29'),(18,12,'Card Type','eyJpdiI6IitpT3ErMFBqSzV2Vmx4U2dZa0N6U3c9PSIsInZhbHVlIjoiRU8zY0JkOE9SNlFEUFJyalJ0Z1ZTWEVhTkJDSVk1SGpZclYyRDlWcVBRQT0iLCJtYWMiOiI1MmQ2MDgxNDBhZjY2OTI1ODg0YzhlNzAzZTEyMjIzYmZiYTA0YzFiNjA5MmRmYzM5MmRmYWUzMDEwNTUyYWNjIiwidGFnIjoiIn0=','CC Holder Name','89','8888','eyJpdiI6IkhyMi90V0RLS3NnLzA5aU5XbSt2Z1E9PSIsInZhbHVlIjoiRnZDc3ZwdmpleEZTS0RSZS85dFZQQT09IiwibWFjIjoiNmQ1ZWM3MjIxNTE4YTFhNGMxODlkYjE2ZTc3Y2I5ZDhhZWUzY2U2YWVjNjdhOGVkNGI2ZjU0ZWZlZWE2NmJjMyIsInRhZyI6IiJ9','8888','teet@gmail.com','4567890989','delhi','delhi','delhi','110092','USD',0.00,0,'2025-06-16 17:48:33','2025-06-16 23:19:29','2025-06-16 23:19:29'),(19,12,'Corporis aut dolor a','eyJpdiI6InFkL20vQ3cyRnJDQjljZ280WU9rSUE9PSIsInZhbHVlIjoiYnByOVRBRGRVK3E0QjFFS1l2eTludz09IiwibWFjIjoiZGExNGE3NjkzMWE1ZGY4ZTY5MWVmZTdmZDU2NzE5NGEwZmE1YjlmYTgxOWVkY2Q1ZjMxMmE1NmEzODQ4Njg1MyIsInRhZyI6IiJ9','Kylie Middleton','11','1981','eyJpdiI6Ii9vQkVoRHhheTBBTS9JSDMwdWhsY0E9PSIsInZhbHVlIjoiK014bUNrNlgvNjhaZ2o5cTFXRVNhQmlOS3lLdGl4UXFvSHRQWEdKVG8xdz0iLCJtYWMiOiI3NTVlNGI1MWMyNDIyZmUyODc0YmRmZjBlZGZiZTY4OGUzNjM3OTZhM2M5NzFjOTU1NGFlMTYxYTRkMjJhYTRkIiwidGFnIjoiIn0=','Eum culpa lorem ut e','tyzevetisy@mailinator.com','Enim dolore veritati','Perferendis quas omn','Quam nihil ut dolore','Ad quidem occaecat q','12537','Fugiat obcaecati ali',87.00,0,'2025-06-16 17:49:29','2025-06-16 23:20:12','2025-06-16 23:20:12'),(20,12,'Card Type','eyJpdiI6InkxeEl2ejJyNXlVRXNEcnlueTVkbVE9PSIsInZhbHVlIjoidzFsaHlWNVdOMHd5d2JGU3RVanBUdnFCb3FFYlg3SkI4VmxjTjNNQmRjQT0iLCJtYWMiOiIwYzM5NjJhZmNkYTdmOTU5YzFlM2Y3ZjZhN2RmODE5MTg5ZjZlNzZlYmRiM2MxN2U1NjU3NDFmNjQzNmJiYThkIiwidGFnIjoiIn0=','CC Holder Name','89','8888','eyJpdiI6IjFJTFhIK0lUOG1nRkFDT3NKSlRoSnc9PSIsInZhbHVlIjoieExONFc2VWcrZzhIUHhQSTdrc0V5dz09IiwibWFjIjoiNjE4MDdmZWU4ZmY4ZGZlNGU5NGZiYzQ1ZmExYjNkZTZmZjY5NzJjMTk5MWNjYTQ1MGI3MTBjZDVlYmZjYzFlMSIsInRhZyI6IiJ9','8888','teet@gmail.com','4567890989','delhi','delhi','delhi','110092','USD',0.00,0,'2025-06-16 17:49:29','2025-06-16 23:20:12','2025-06-16 23:20:12'),(21,12,'Card Type','eyJpdiI6ImpQNVFCazhLbHcrTHcrZ2liMU9RZmc9PSIsInZhbHVlIjoiVjZuVHFNTWI0cnNWa1ZaNlJwTlBPWWdYK0IxSXFrLzhTYXFuV0lwWldWWT0iLCJtYWMiOiI4ODJhMzM5YjgzODQ1ODVmYzJjMTlmYzllZmQ2ZWEwNDg3NTljZDYyNzhhNjkxOTcwYjc2MTM4NzNjNzUxZjA4IiwidGFnIjoiIn0=','CC Holder Name','MM','YYYY','eyJpdiI6IlNRSTFkM3JqYlQ4Vmtud0tLQXlLR3c9PSIsInZhbHVlIjoicmpMdnFJQldxeVdReC9DTWozMHczdz09IiwibWFjIjoiMDBlN2NiYTIyYzQ1ODA3YTI4YmVjYjRmOGUzOGY1NzMxYjczYjI4NGQyMzkwODRhNDkxNDgyMDUxODRmM2I0NCIsInRhZyI6IiJ9','Address','tst@gmail.com','Contact No','City','Country','State','ZIP Code','Currency',0.00,0,'2025-06-16 17:49:29','2025-06-16 23:20:12','2025-06-16 23:20:12'),(22,12,'Corporis aut dolor a','eyJpdiI6IldMenpnbW5ZUG12a1ZkakRGQ1JEVGc9PSIsInZhbHVlIjoiRVFEaWthMmVsOUQ1Nm1iMnVqSC9oZz09IiwibWFjIjoiNDU2NDBlZDAzNzVmMjQwNmJkNWE2NjBkMWUxZDk1YTdkZjhjMTUxMGUzOTRiZWYyYTZmMjhlNjA5MWIzYzM1ZiIsInRhZyI6IiJ9','Kylie Middleton','11','1981','eyJpdiI6IkFwQVVFbFhJYW9QVFJ0UzVISno2dVE9PSIsInZhbHVlIjoiWTdvR3F6bTZNVmZBZW96WTR4ekM0K2Y1dDBySTljZ0JJQkRwdGFrVmRKYz0iLCJtYWMiOiI0OGU0NzhlNDMyNjk4MjliNjcwNDNhZjMzY2M1NGM4ZWU5OGM4MTQ0NTQyZDViMjQ2ODUzYThlMDBmYTI2NjQ3IiwidGFnIjoiIn0=','Eum culpa lorem ut e','tyzevetisy@mailinator.com','Enim dolore veritati','Perferendis quas omn','Quam nihil ut dolore','Ad quidem occaecat q','12537','Fugiat obcaecati ali',87.00,0,'2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(23,12,'Card Type','eyJpdiI6IlpJUUtaU2F3THkrOTE5ZnZ3TGp1V3c9PSIsInZhbHVlIjoic2NLTzhMOXVTd0JOMmRFaXpFSW9qZjAvYkNPYUxZSlhFaUJxaUZhTUhSMD0iLCJtYWMiOiI0MzcyZWZmZWM2NWFjODZmZGEwMzVjMzliYWRkYzBjZjg1NmIxYTNjOGIzYTA0MDY5NDI2NzU3NjZjMmM1MDgwIiwidGFnIjoiIn0=','CC Holder Name','89','8888','eyJpdiI6IlR0NTJZdVFmYzdrOXVRQWxRdnMvamc9PSIsInZhbHVlIjoiOGI1TTdMNHk0UVVRMFQ2RnVDTm1vdz09IiwibWFjIjoiZGM3NjhlMTJhNjgzMDkzYTZlNzY1MjhjOTlhOWE5OGViMDNjZDk1OGI0NTQ0NDEwMTlmZDE4ZmE0Mzk4ZDkyMCIsInRhZyI6IiJ9','8888','teet@gmail.com','4567890989','delhi','delhi','delhi','110092','USD',0.00,0,'2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(24,12,'Card Type','eyJpdiI6IjNQMEpTL2JNeGRacTEwV2srWDQ5UlE9PSIsInZhbHVlIjoiNTBWR282L0J1cSthNWpDMmpoVmlWcXM4dS9na2ZoWEloMlQ2bU1Pb2RDOD0iLCJtYWMiOiIyZTYwMzhiMzA2Y2JlM2JlZjJmN2E1ZTFiNjk4MjVhZTdlMTM5MDRlMWNlNDEzNDRkMGExYTU3NTBkYTY1MmRmIiwidGFnIjoiIn0=','CC Holder Name','MM','YYYY','eyJpdiI6IjNNMllMYkMvNzNINWpuVEt4aUM0d3c9PSIsInZhbHVlIjoiU25hOXV0TGFTclhEdXMxQnZ2aTV1QT09IiwibWFjIjoiOWYwMjQ0NTJiYjRmYWQ5YTBjNTZjZTBmMmM1ZGZiYjg5MmRhMTE1ZGZjNGE5YWEwYjY0Y2E5ZTg1OWEwZWEyMCIsInRhZyI6IiJ9','Address','tst@gmail.com','Contact No','City','Country','State','ZIP Code','Currency',0.00,0,'2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(25,12,'Corporis aut dolor a','eyJpdiI6InFmWko1NzRBSnE0OEV2K0FBNFJDT0E9PSIsInZhbHVlIjoiam5VdTNySnBVZ3BhNVVlUmJmMEpSZz09IiwibWFjIjoiMWVmMTZlZjdjNzk3MWE3ZjA2NjE0YWJiYmFlNmE2M2FmYjE3YTBhMWUyNDE5MWNjOWVjYTA1NmM3YmIxMTQyOCIsInRhZyI6IiJ9','Kylie Middleton','11','1981','eyJpdiI6IkRMWm1UUWZDYnR5Y09RNTdQQ2ZtVUE9PSIsInZhbHVlIjoiRmNvN0RQNHJpbzJ0NGpsMHU4RlBVZHhUQ0kzVjdjbmRDNnB0clBLTDM3QT0iLCJtYWMiOiJlMWVmODQ2MWNkNmNmNWIzNzViMTgyODVjMzMzYmMwMTU0ZmY1YTVlYmYyMDg4MjNlNDhiMWM5ZmE5ODhiNzFiIiwidGFnIjoiIn0=','Eum culpa lorem ut e','tyzevetisy@mailinator.com','Enim dolore veritati','Perferendis quas omn','Quam nihil ut dolore','Ad quidem occaecat q','12537','Fugiat obcaecati ali',87.00,0,'2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(26,12,'Card Type','eyJpdiI6InVIQ3dqK0NMaXZralpjSU1YUWpVNlE9PSIsInZhbHVlIjoiQzBXcU1xK1A0Zm5lT20zRkMzVTFoTmwwY0EvbktDd0c5UkhuSVVMSjlqVT0iLCJtYWMiOiI2YjAyZDFjYTg5MWY0YTNjYmJjNTNiYTA0ZmJkZTNkNTdkZDM1YmU4ZjkyNjc0NjQ4N2IwZjhiNmY4MDk2NDVhIiwidGFnIjoiIn0=','CC Holder Name','89','8888','eyJpdiI6ImI2YWJOTjB2bTdzTEQ1UGlsMXZpUHc9PSIsInZhbHVlIjoiWnRpaVJVV0h3VVRzSFlRbXhHOVNuZz09IiwibWFjIjoiNDI2YzU2ZjUzOTkxNjk4NzcxYmY3YmM3YjI1ZDg0NTgyOWU4MTM2MGE2ODlhOTJlZmI1Nzk3NmFiN2VhMTcxZiIsInRhZyI6IiJ9','8888','teet@gmail.com','4567890989','delhi','delhi','delhi','110092','USD',0.00,0,'2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(27,12,'Card Type','eyJpdiI6Imk2aHlYNjRXbWNMclp4UnlEVk1pL2c9PSIsInZhbHVlIjoiSXZPUVVLdmwrNEVtbFNmVzl4YmFZOEM5Mkt2OFFMK1MzakFiWGt4MVFBUT0iLCJtYWMiOiI3OWMyMzlkOTE3MWM5YWYxM2QzMmY0ZmE4NDFlZmQ5MGE0NzIyMGRiZDkyMTQ5MmQzMTI0ZjA3OTkwNzI3YzFhIiwidGFnIjoiIn0=','CC Holder Name','MM','YYYY','eyJpdiI6InVwRmx4L1RrSkNNdHJXZ1hrRi91NUE9PSIsInZhbHVlIjoiUFNoNUI2YWdiYVFzZnhzK0VFeXBmdz09IiwibWFjIjoiMGM0MTE3MTQxNTM4YWJiYjY1ZGRkYjlhMDJhNGFiOWFkMWJhOTA2ZjYzZDVjYTA4MGQwY2NhNzhlNmI1ZTliZCIsInRhZyI6IiJ9','Address','tst@gmail.com','Contact No','City','Country','State','ZIP Code','Currency',0.00,0,'2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(28,13,'VISA','eyJpdiI6Imx5UW1DM3Q4bjdaZ2M1cVRIakF5MHc9PSIsInZhbHVlIjoiZkp6MGx6MHp5cWJwRlVjTmlad2FFMmdMSWx2aXFzckN2NTZZOEFOUG5JTT0iLCJtYWMiOiIwZWFlZDZkNDRiMzgzMWVjZDVmYjMyN2I5NGU2ZWU2YzlkOWU0MzIxODI0ODlhNWI3NjNjMjZjN2E2MDJjZjQwIiwidGFnIjoiIn0=','test','01','2024','eyJpdiI6IlB2NjVtUW10bmlCN2VOUi9HODdvQmc9PSIsInZhbHVlIjoicTM3VnVFVTZCa0wrVUVrTFFIbEZxUT09IiwibWFjIjoiZDU1N2EyY2UxYmJhODNkNjI3Zjk5N2VkZWMyMmU0ZjAzZjQ1MWJhOWZkY2ZlYjM5NDIyY2IwNTNmNjJmOWZjYyIsInRhZyI6IiJ9','laxmi Nagrr','test@gmail.com','8510810544','delhi','Afghanistan','Badakhshan','110092','USD',0.00,0,'2025-06-18 13:04:07','2025-06-18 18:34:07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_booking_types`
--

/*!40000 ALTER TABLE `travel_booking_types` DISABLE KEYS */;
INSERT INTO `travel_booking_types` VALUES (9,5,'Flight','2025-06-16 14:34:46','2025-06-16 20:04:46'),(10,5,'Car','2025-06-16 14:34:46','2025-06-16 20:04:46'),(11,6,'Hotel','2025-06-16 16:19:13','2025-06-16 21:49:13'),(12,6,'Cruise','2025-06-16 16:19:13','2025-06-16 21:49:13'),(13,7,'Car','2025-06-16 16:23:00','2025-06-16 21:53:00'),(14,8,'Flight','2025-06-16 16:34:10','2025-06-16 22:04:10'),(15,8,'Car','2025-06-16 16:34:10','2025-06-16 22:04:10'),(16,9,'Hotel','2025-06-16 16:37:38','2025-06-16 22:07:38'),(17,9,'Car','2025-06-16 16:37:38','2025-06-16 22:07:38'),(18,11,'Hotel','2025-06-16 16:38:45','2025-06-16 22:08:45'),(19,11,'Cruise','2025-06-16 16:38:45','2025-06-16 22:08:45'),(20,11,'Car','2025-06-16 16:38:45','2025-06-16 22:08:45'),(71,12,'Hotel','2025-06-16 17:51:05','2025-06-16 23:21:05'),(72,12,'Cruise','2025-06-16 17:51:05','2025-06-16 23:21:05'),(73,13,'Flight','2025-06-18 13:04:07','2025-06-18 18:34:07');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_bookings`
--

/*!40000 ALTER TABLE `travel_bookings` DISABLE KEYS */;
INSERT INTO `travel_bookings` VALUES (5,'TEst','Magnam mollit qui re','Perferendis voluptat','Idona Russo','+1 (208) 752-7589','wece@mailinator.com','Ullamco qui eos atqu',NULL,'Lorem minima possimu','Maiores cupiditate i','Id praesentium elit','Dolore consequuntur','Amet quidem hic ill',NULL,'2025-06-16 14:34:46','2025-06-16 20:04:46',NULL),(6,'Cupidatat dolorem ex','Accusantium aute pra','Labore aut est ut a','Charles Carey','+1 (542) 969-1527','calo@mailinator.com','Ut ad excepteur debi',NULL,'Dolor distinctio Co','Sed ipsum nihil ven','Aliquip enim sunt si','Magni sint laboriosa','Ea dolor temporibus',NULL,'2025-06-16 16:19:13','2025-06-16 21:49:13',NULL),(7,'Ab qui eu cupiditate','Et debitis officia t','Sit nostrum aut rer','Wendy Sanders','+1 (527) 293-6025','museteje@mailinator.com','Illum soluta dolor',NULL,'Non quisquam velit','Quia aliquip accusam','Placeat veniam vol','Veritatis cumque und','Exercitationem hic e',NULL,'2025-06-16 16:23:00','2025-06-16 21:53:00',NULL),(8,'Pariatur Et ea hic','Ut eiusmod dolor dol','Dolorum sequi dolore','Denise Riddle','+1 (401) 811-8149','baqoso@mailinator.com','Id autem ipsum ea es',NULL,'Nulla eos dolorem fu','Quos dolor minima de','Asperiores cumque pe','Eu beatae minus et a','Veniam obcaecati pe',NULL,'2025-06-16 16:34:10','2025-06-16 22:04:10',NULL),(9,'Et ut eaque atque la','Unde ipsum voluptate','Aliqua Veniam maio','Hakeem Salazar','+1 (818) 408-6105','xipicypefu@mailinator.com','Voluptate voluptatib',NULL,'Consectetur quis qui','Harum quo dicta moll','Quis aliquam ex Nam','Alias dolorum et tem','Nihil aliquip commod',NULL,'2025-06-16 16:37:38','2025-06-16 22:07:38',NULL),(11,'Fugiat exercitation','Sequi nemo odio quia','Quia odio tempor exe','Blaze Mcguire','+1 (247) 387-5026','gotij@mailinator.com','Qui aut id voluptas',NULL,'Aperiam cupiditate e','Ad cum asperiores no','Proident qui deleni','Aliqua Quisquam ape','Provident in aut ni',NULL,'2025-06-16 16:38:45','2025-06-16 22:08:45',NULL),(12,'Quo quae id aute ut','Omnis illo aliquam p','Corrupti doloribus','Len Duran','+1 (567) 605-1984','buzyrobuj@mailinator.com','Proident doloremque',NULL,'Velit libero veniam','Fugit dolorum aut e','Amet quis et fugiat','Aut voluptate nostru','Ut nesciunt deserun',NULL,'2025-06-16 16:42:16','2025-06-16 23:20:12',NULL),(13,'Proident laborum vo','Dolorum fugiat ut c','Enim incididunt ab e','Armand Richardson','+1 (237) 652-5937','cegekoqade@mailinator.com','Sit est vel laudant',NULL,'Quo proident vitae','Libero eius cumque l','Aut eaque adipisci f','Autem hic omnis quia','Aut voluptas aliqua',NULL,'2025-06-18 13:04:07','2025-06-18 18:34:07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_passengers`
--

/*!40000 ALTER TABLE `travel_passengers` DISABLE KEYS */;
INSERT INTO `travel_passengers` VALUES (5,5,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 14:34:46','2025-06-16 20:04:46',NULL),(6,6,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 16:19:13','2025-06-16 21:49:13',NULL),(7,7,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 16:23:00','2025-06-16 21:53:00',NULL),(8,8,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 16:34:11','2025-06-16 22:04:11',NULL),(9,9,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 16:37:38','2025-06-16 22:07:38',NULL),(10,11,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 16:38:45','2025-06-16 22:08:45',NULL),(11,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 16:42:16','2025-06-16 22:43:36','2025-06-16 22:43:36'),(12,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:13:36','2025-06-16 22:44:20','2025-06-16 22:44:20'),(13,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:14:20','2025-06-16 22:44:35','2025-06-16 22:44:35'),(14,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:14:35','2025-06-16 22:45:18','2025-06-16 22:45:18'),(15,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:15:18','2025-06-16 22:53:56','2025-06-16 22:53:56'),(16,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:23:56','2025-06-16 22:54:55','2025-06-16 22:54:55'),(17,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:24:55','2025-06-16 22:55:58','2025-06-16 22:55:58'),(18,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:25:58','2025-06-16 22:58:05','2025-06-16 22:58:05'),(19,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:28:05','2025-06-16 22:58:28','2025-06-16 22:58:28'),(20,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:28:28','2025-06-16 23:18:33','2025-06-16 23:18:33'),(24,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:48:33','2025-06-16 23:19:29','2025-06-16 23:19:29'),(25,12,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-16 17:49:29','2025-06-16 23:20:12','2025-06-16 23:20:12'),(26,12,'Molestias tenetur om','Commodi et aut corru','2010-02-28','394','Enim consectetur sit',0.00,'August','Thor Valencia','Reynolds','63','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(27,12,'Quis libero ut illum','Quis quaerat animi','1975-07-28','650','Qui repudiandae corp',0.00,'Justine','Naida Bush','Joyner','547','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(28,12,'Iste cupidatat vero','Eu iusto eum commodo','1983-05-19','930','Excepteur eveniet c',0.00,'Anjolie','Samson Mckee','Cannon','120','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(29,12,'Velit et aut quos do','Nesciunt repudianda','1989-01-24','291','Porro elit dicta ar',0.00,'Karen','Blaze Hewitt','Baird','42','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(30,12,'Harum aut qui duis u','Vel aliquip facere s','2017-07-21','763','Doloremque irure ess',0.00,'Chiquita','Winifred Ellis','Ayala','481','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(31,12,'Molestiae saepe magn','Recusandae Dolorem','1978-02-11','855','Cumque accusamus pla',0.00,'Chase','Doris Armstrong','Buchanan','381','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(32,12,'Optio doloribus vel','Odit voluptatem ali','1978-06-16','958','Et praesentium nihil',0.00,'Elmo','Bradley Singleton','Giles','121','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(33,12,'Velit quis quos qui','Assumenda aut volupt','2006-06-25','413','Officiis Nam nulla b',0.00,'Hadassah','Yuli Wallace','Wallace','748','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(34,12,'Voluptatibus in moll','Ad porro reprehender','1984-04-28','960','Sunt temporibus quo',0.00,'Delilah','Buckminster Morgan','Graham','376','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(35,12,'Libero totam quo atq','Error sint magni ull','1974-06-09','675','Iusto non sunt asper',0.00,'Zoe','Wanda Branch','Whitley','829','2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(36,12,'Molestias tenetur om','Commodi et aut corru','2010-02-28','394','Enim consectetur sit',0.00,'August','Thor Valencia','Reynolds','63','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(37,12,'Quis libero ut illum','Quis quaerat animi','1975-07-28','650','Qui repudiandae corp',0.00,'Justine','Naida Bush','Joyner','547','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(38,12,'Iste cupidatat vero','Eu iusto eum commodo','1983-05-19','930','Excepteur eveniet c',0.00,'Anjolie','Samson Mckee','Cannon','120','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(39,12,'Velit et aut quos do','Nesciunt repudianda','1989-01-24','291','Porro elit dicta ar',0.00,'Karen','Blaze Hewitt','Baird','42','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(40,12,'Harum aut qui duis u','Vel aliquip facere s','2017-07-21','763','Doloremque irure ess',0.00,'Chiquita','Winifred Ellis','Ayala','481','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(41,12,'Molestiae saepe magn','Recusandae Dolorem','1978-02-11','855','Cumque accusamus pla',0.00,'Chase','Doris Armstrong','Buchanan','381','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(42,12,'Optio doloribus vel','Odit voluptatem ali','1978-06-16','958','Et praesentium nihil',0.00,'Elmo','Bradley Singleton','Giles','121','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(43,12,'Velit quis quos qui','Assumenda aut volupt','2006-06-25','413','Officiis Nam nulla b',0.00,'Hadassah','Yuli Wallace','Wallace','748','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(44,12,'Voluptatibus in moll9','Ad porro reprehender','1984-04-28','960','Sunt temporibus quo',0.00,'Delilah','Buckminster Morgan','Graham','376','2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(45,13,'Adult','Male','2025-04-10',NULL,'Ms',0.00,'mnnfksdfs fsdjfds',NULL,'cshcjxhds',NULL,'2025-06-18 13:04:07','2025-06-18 18:34:07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_pricing_details`
--

/*!40000 ALTER TABLE `travel_pricing_details` DISABLE KEYS */;
INSERT INTO `travel_pricing_details` VALUES (1,5,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-16 14:34:46','2025-06-16 20:04:46',NULL),(2,6,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-16 16:19:13','2025-06-16 21:49:13',NULL),(3,7,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-16 16:23:00','2025-06-16 21:53:00',NULL),(4,8,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-16 16:34:11','2025-06-16 22:04:11',NULL),(5,9,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-16 16:37:38','2025-06-16 22:07:38',NULL),(6,11,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-16 16:38:45','2025-06-16 22:08:45',NULL),(7,12,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.20,'2025-06-16 16:42:16','2025-06-16 22:43:36',NULL),(8,13,0.00,0.00,0.00,12.00,12.00,0.00,12.00,'Cheapofly',0.00,'2025-06-18 13:04:07','2025-06-18 18:34:07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_quality_feedback`
--

/*!40000 ALTER TABLE `travel_quality_feedback` DISABLE KEYS */;
INSERT INTO `travel_quality_feedback` VALUES (1,12,'78',NULL,'TES',NULL,NULL,'2025-06-16 22:19:51','2025-06-16 22:43:36','2025-06-16 22:43:36'),(2,12,'Test QA','2025-06-16 22:43:36','TES',NULL,NULL,'2025-06-16 17:13:36','2025-06-16 22:44:20','2025-06-16 22:44:20'),(3,12,'Test QA','2025-06-16 22:44:20','TES',NULL,NULL,'2025-06-16 17:14:20','2025-06-16 22:44:35','2025-06-16 22:44:35'),(4,12,'Test QA','2025-06-16 22:44:35','TES',NULL,NULL,'2025-06-16 17:14:35','2025-06-16 22:45:18','2025-06-16 22:45:18'),(5,12,'Test QA','2025-06-16 22:45:18','TES',NULL,NULL,'2025-06-16 17:15:18','2025-06-16 22:53:56','2025-06-16 22:53:56'),(6,12,'Test QA','2025-06-16 22:53:56','TES',NULL,NULL,'2025-06-16 17:23:56','2025-06-16 22:54:55','2025-06-16 22:54:55'),(7,12,'Test QA','2025-06-16 22:54:55','TES',NULL,NULL,'2025-06-16 17:24:55','2025-06-16 22:55:58','2025-06-16 22:55:58'),(8,12,'Test QA','2025-06-16 22:55:58','TES',NULL,NULL,'2025-06-16 17:25:58','2025-06-16 22:58:05','2025-06-16 22:58:05'),(9,12,'Test QA','2025-06-16 22:58:05','TES',NULL,NULL,'2025-06-16 17:28:05','2025-06-16 22:58:28','2025-06-16 22:58:28'),(10,12,'Test QA','2025-06-16 22:58:28','TES',NULL,NULL,'2025-06-16 17:28:28','2025-06-16 23:18:33','2025-06-16 23:18:33'),(11,12,'Test QA','2025-06-16 23:18:33','TES',NULL,NULL,'2025-06-16 17:48:33','2025-06-16 23:19:29','2025-06-16 23:19:29'),(12,12,'Test QA','2025-06-16 23:19:29','TES',NULL,NULL,'2025-06-16 17:49:29','2025-06-16 23:20:12','2025-06-16 23:20:12'),(13,12,'Test QA','2025-06-16 23:20:12','TES',NULL,NULL,'2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(14,12,'Test QA','2025-06-16 23:21:05','TES',NULL,NULL,'2025-06-16 17:51:05','2025-06-16 23:21:05',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_screenshots`
--

/*!40000 ALTER TABLE `travel_screenshots` DISABLE KEYS */;
INSERT INTO `travel_screenshots` VALUES (1,5,'Flight',NULL,NULL,'2025-06-16 14:34:46','2025-06-16 20:04:46',NULL),(2,6,'Flight',NULL,NULL,'2025-06-16 16:19:13','2025-06-16 21:49:13',NULL),(3,7,'Flight',NULL,NULL,'2025-06-16 16:23:00','2025-06-16 21:53:00',NULL),(4,8,'Flight',NULL,NULL,'2025-06-16 16:34:11','2025-06-16 22:04:11',NULL),(5,9,'Flight',NULL,NULL,'2025-06-16 16:37:38','2025-06-16 22:07:38',NULL),(6,11,'Flight',NULL,NULL,'2025-06-16 16:38:45','2025-06-16 22:08:45',NULL),(7,12,'Flight',NULL,NULL,'2025-06-16 16:42:16','2025-06-16 22:43:36','2025-06-16 22:43:36'),(8,12,'Flight',NULL,NULL,'2025-06-16 17:13:36','2025-06-16 22:44:20','2025-06-16 22:44:20'),(9,12,'Flight',NULL,NULL,'2025-06-16 17:14:20','2025-06-16 22:44:35','2025-06-16 22:44:35'),(10,12,'Flight',NULL,NULL,'2025-06-16 17:14:35','2025-06-16 22:45:18','2025-06-16 22:45:18'),(11,12,'Flight',NULL,NULL,'2025-06-16 17:15:18','2025-06-16 22:53:56','2025-06-16 22:53:56'),(12,12,'Flight',NULL,NULL,'2025-06-16 17:23:56','2025-06-16 22:54:55','2025-06-16 22:54:55'),(13,12,'Flight',NULL,NULL,'2025-06-16 17:24:55','2025-06-16 22:55:58','2025-06-16 22:55:58'),(14,12,'Flight',NULL,NULL,'2025-06-16 17:25:58','2025-06-16 22:58:05','2025-06-16 22:58:05'),(15,12,'Flight',NULL,NULL,'2025-06-16 17:28:05','2025-06-16 22:58:28','2025-06-16 22:58:28'),(16,12,'Flight',NULL,NULL,'2025-06-16 17:28:28','2025-06-16 23:18:33','2025-06-16 23:18:33'),(17,12,'Flight',NULL,NULL,'2025-06-16 17:48:33','2025-06-16 23:19:29','2025-06-16 23:19:29'),(18,12,'Flight',NULL,NULL,'2025-06-16 17:49:29','2025-06-16 23:20:12','2025-06-16 23:20:12'),(19,12,'Flight',NULL,NULL,'2025-06-16 17:50:12','2025-06-16 23:21:05','2025-06-16 23:21:05'),(20,12,'Flight',NULL,NULL,'2025-06-16 17:51:05','2025-06-16 23:21:05',NULL),(21,13,'Flight',NULL,NULL,'2025-06-18 13:04:07','2025-06-18 18:34:07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_sector_details`
--

/*!40000 ALTER TABLE `travel_sector_details` DISABLE KEYS */;
INSERT INTO `travel_sector_details` VALUES (5,5,'Aut qui earum sint','2025-06-16 14:34:46','2025-06-16 20:04:46',NULL),(6,6,'Ratione nemo volupta','2025-06-16 16:19:13','2025-06-16 21:49:13',NULL),(7,7,'Enim et non vel et d','2025-06-16 16:23:00','2025-06-16 21:53:00',NULL),(8,8,'Accusantium est reru','2025-06-16 16:34:10','2025-06-16 22:04:10',NULL),(9,9,'Consectetur commodo','2025-06-16 16:37:38','2025-06-16 22:07:38',NULL),(10,11,'Accusamus culpa veni','2025-06-16 16:38:45','2025-06-16 22:08:45',NULL),(11,12,'Flight','2025-06-16 16:42:16','2025-06-16 22:43:36',NULL),(12,13,'Eiusmod velit vitae','2025-06-18 13:04:07','2025-06-18 18:34:07',NULL);
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

-- Dump completed on 2025-06-20  3:40:30
