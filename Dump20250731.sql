-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: cheapoflyllc
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('Y','N','P','H') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_user_id_foreign` (`user_id`),
  CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,1,'2025-07-11','P','2025-07-11 18:21:09','2025-07-11 18:21:09'),(2,1,'2025-07-12','P','2025-07-11 18:42:15','2025-07-11 18:42:15'),(3,1,'2025-07-18','P','2025-07-18 18:28:27','2025-07-18 18:28:27'),(4,1,'2025-07-19','P','2025-07-19 14:12:19','2025-07-19 14:12:19'),(5,2,'2025-07-19','P','2025-07-19 16:33:49','2025-07-19 16:33:49'),(6,1,'2025-07-20','P','2025-07-20 13:22:23','2025-07-20 13:22:23'),(7,1,'2025-07-21','P','2025-07-21 13:45:27','2025-07-21 13:45:27'),(8,1,'2025-07-22','P','2025-07-21 20:21:04','2025-07-21 20:21:04'),(9,1,'2025-07-23','P','2025-07-22 19:37:22','2025-07-22 19:37:22'),(10,1,'2025-07-26','P','2025-07-26 13:26:43','2025-07-26 13:26:43'),(11,1,'2025-07-27','P','2025-07-27 13:27:50','2025-07-27 13:27:50'),(12,1,'2025-07-28','P','2025-07-27 19:38:52','2025-07-27 19:38:52'),(13,1,'2025-07-29','P','2025-07-29 13:19:23','2025-07-29 13:19:23'),(14,1,'2025-07-30','P','2025-07-30 14:09:58','2025-07-30 14:09:58'),(15,1,'2025-07-31','P','2025-07-30 21:09:14','2025-07-30 21:09:14');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_histories`
--

DROP TABLE IF EXISTS `auth_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_histories`
--

LOCK TABLES `auth_histories` WRITE;
/*!40000 ALTER TABLE `auth_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_details`
--

DROP TABLE IF EXISTS `billing_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_details`
--

LOCK TABLES `billing_details` WRITE;
/*!40000 ALTER TABLE `billing_details` DISABLE KEYS */;
INSERT INTO `billing_details` VALUES (1,'sdfd@gmail.com','8510810544','test','etst','test','110096','india','75','2025-07-29 13:20:32','2025-07-29 13:20:32'),(3,'dsgf@gmail.com','8956258740','dfsgdfsgdfg','fgdfgdfgdf','fdgdfgdf','895623','gdfgfdsgdfgdf','75','2025-07-29 16:00:02','2025-07-29 16:00:02');
/*!40000 ALTER TABLE `billing_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_statuses`
--

DROP TABLE IF EXISTS `booking_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_statuses`
--

LOCK TABLES `booking_statuses` WRITE;
/*!40000 ALTER TABLE `booking_statuses` DISABLE KEYS */;
INSERT INTO `booking_statuses` VALUES (1,'AUTH PENDING',1,NULL,'2025-07-23 20:32:01'),(2,'AUTH EMAIL SENT - CARD 1',1,NULL,'2025-07-23 20:56:44'),(3,'AUTH MSG SENT - CARD 2',1,NULL,'2025-07-23 20:56:54'),(4,'AUTH WA SENT - ALL',1,NULL,'2025-07-23 20:57:03'),(6,'SURVEY EMAIL SENT',1,'2025-07-23 20:32:47','2025-07-23 20:32:47'),(7,'SURVEY MSG SENT',1,'2025-07-23 20:32:54','2025-07-23 20:32:54'),(8,'SURVEY WA SENT',1,'2025-07-23 20:33:01','2025-07-23 20:33:01'),(9,'WRONG EMAIL',1,'2025-07-23 20:33:10','2025-07-23 20:33:10'),(10,'AUTH RECEIVED - CARD 1 OR CARD 2 OR BOTH',1,'2025-07-23 20:33:18','2025-07-23 20:33:18'),(11,'CHANGES PENDING',1,'2025-07-23 20:33:27','2025-07-23 20:33:27'),(12,'CHANGES DENIED',1,'2025-07-23 20:33:33','2025-07-23 20:33:33'),(13,'CHANGES DONE',1,'2025-07-23 20:33:39','2025-07-23 20:33:39'),(14,'SENT FOR CHARGE',1,'2025-07-23 20:33:44','2025-07-23 20:33:44'),(15,'CHARGED & INVOICED',1,'2025-07-23 20:33:51','2025-07-23 20:33:51'),(16,'PAID IN FULL',1,'2025-07-30 17:44:55','2025-07-30 17:44:55'),(17,'Voided',1,'2025-07-30 19:55:14','2025-07-30 19:55:14'),(18,'Cancelled',1,'2025-07-30 19:55:26','2025-07-30 19:55:26');
/*!40000 ALTER TABLE `booking_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_logs`
--

DROP TABLE IF EXISTS `call_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `chkflight` tinyint(1) NOT NULL DEFAULT '0',
  `chkhotel` tinyint(1) NOT NULL DEFAULT '0',
  `chkcruise` tinyint(1) NOT NULL DEFAULT '0',
  `chkcar` tinyint(1) NOT NULL DEFAULT '0',
  `chktrain` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `team` int NOT NULL DEFAULT '0',
  `campaign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_converted` tinyint(1) NOT NULL DEFAULT '0',
  `followup_date` timestamp NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `assign` int DEFAULT NULL,
  `pnr` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_logs`
--

LOCK TABLES `call_logs` WRITE;
/*!40000 ALTER TABLE `call_logs` DISABLE KEYS */;
INSERT INTO `call_logs` VALUES (1,3,1,1,1,0,0,'1497658981','Adrienne Bowers',0,'International','Minus consectetur do','1',1,NULL,'Perspiciatis numqua',NULL,'INT1000000001','2025-06-27 17:49:39','2025-06-27 17:49:39'),(2,3,0,0,1,1,0,'1914543638','Marny Miller',0,'Pure AA','Eaque quo et rerum i','1',1,NULL,'Sunt deserunt enim',1,'PUR1000000002','2025-06-27 17:50:23','2025-06-27 17:50:23'),(3,3,1,0,1,0,0,'1607768549','Yolanda Fleming',0,'LCC','Fugit qui deserunt','1',0,NULL,'Voluptatem adipisic',2,'','2025-06-27 17:50:37','2025-06-27 17:50:37'),(4,3,1,1,1,1,0,'1119584913','Chandler Owens',0,'Buffer Mix','Velit mollit qui at','1',0,NULL,'Eos perferendis comm',2,'','2025-06-27 18:13:51','2025-06-27 18:13:51'),(5,2,0,0,0,1,0,'1632474692','Herman Bernard',1,'Buffer Mix','Earum officia nisi s','1',0,NULL,'Inventore voluptatum',NULL,'','2025-06-27 18:20:45','2025-06-27 18:20:45'),(6,3,1,0,0,0,0,'121','1212',0,'Agency','sdfl;sd','2',0,NULL,'saddadsasdas',NULL,'','2025-06-27 19:07:18','2025-06-27 19:07:18'),(7,NULL,1,0,0,0,0,'12','1222',0,'Agency','sdsdsds','1',1,NULL,'dss ddasdssa',NULL,'AGE1000000007','2025-06-28 16:32:47','2025-06-28 16:32:47'),(8,2,0,0,1,0,0,'1498792921','Steven Roman',0,'Premium Amtrak Bing Calls','Adipisci sint est a','2',1,NULL,'Dolor non enim culpa',NULL,'PRE1000000008','2025-06-28 17:02:24','2025-06-28 17:02:24'),(9,2,0,0,1,0,0,'1498792921','Steven Roman',0,'Premium Amtrak Bing Calls','Adipisci sint est a','2',1,NULL,'Dolor non enim culpa',NULL,'PRE1000000009','2025-06-28 17:02:40','2025-06-28 17:02:40'),(10,2,0,0,1,0,0,'1498792921','Steven Roman',0,'Premium Amtrak Bing Calls','Adipisci sint est a','2',1,NULL,'Dolor non enim culpa',NULL,'PRE1000000010','2025-06-28 17:03:19','2025-06-28 17:03:19'),(11,2,1,1,0,0,0,'1211411900','Kim Ramsey',0,'Cruise','Aut laboriosam adip','2',1,NULL,'Voluptatum dolorum r',NULL,'CRU1000000011','2025-06-28 17:04:06','2025-06-28 17:04:06'),(12,2,1,1,0,0,0,'1211411900','Kim Ramsey',0,'Cruise','Aut laboriosam adip','2',1,NULL,'Voluptatum dolorum r',NULL,'CRU1000000012','2025-06-28 17:04:21','2025-06-28 17:04:21'),(13,2,1,0,0,0,0,'1862847204','Tanisha Jensen',0,'Buffer Mix','Ex aliqua Aut conse','1',1,NULL,'Nisi fuga Sed atque',NULL,'BUF1000000013','2025-06-28 17:05:54','2025-06-28 17:05:54'),(14,2,1,0,0,0,0,'1862847204','Tanisha Jensen',0,'Buffer Mix','Ex aliqua Aut conse','1',1,NULL,'Nisi fuga Sed atque',NULL,'BUF1000000014','2025-06-28 17:06:51','2025-06-28 17:06:51'),(15,2,1,0,0,0,0,'1869997627','Britanni Pickett',0,'LCC','Qui molestiae eum ad','2',1,NULL,'Consequuntur dolor s',NULL,'LCC1000000015','2025-06-28 17:07:10','2025-06-28 17:07:10'),(16,2,1,0,0,0,0,'1869997627','Britanni Pickett',0,'LCC','Qui molestiae eum ad','2',1,NULL,'Consequuntur dolor s',NULL,'LCC1000000016','2025-06-28 17:08:32','2025-06-28 17:08:32'),(17,2,1,1,1,1,0,'1469303122','Octavius Larson',0,'International','Dolore vel nihil ex','2',1,NULL,'Qui unde fugiat aute',NULL,'INT1000000017','2025-06-28 17:08:45','2025-06-28 17:08:45'),(18,2,1,0,0,0,0,'1295869238','Dana Hyde',0,'Major Mix','Facere repudiandae m','1',1,NULL,'Non inventore eligen',NULL,'','2025-06-28 17:29:25','2025-06-28 17:29:25'),(19,2,1,0,0,0,0,'1295869238','Dana Hyde',0,'Major Mix','Facere repudiandae m','1',1,NULL,'Non inventore eligen',NULL,'MAJ280627820016','2025-06-28 17:29:42','2025-06-28 17:29:42'),(20,1,1,0,1,1,0,'1355435855','Mara Holcomb',0,'Spanish','Minima in in aliquip','2',1,NULL,'Reprehenderit non ve',NULL,'SPA100755640001','2025-07-09 20:02:44','2025-07-09 20:02:44'),(21,1,1,0,0,0,0,'1315505610','Noelle Barry',0,'Airline Mix','Ad proident facere','2',0,NULL,'Perferendis dolorem  gbfdgdfsg',NULL,'','2025-07-11 16:04:24','2025-07-11 16:04:24'),(22,1,0,0,0,1,0,'121000000','Victor',0,'Airline Mix','Victor','2',1,NULL,'Victor',NULL,'AIR110781630001','2025-07-11 16:12:43','2025-07-11 16:12:43'),(23,1,0,0,0,1,0,'1457633957','Herman Sloan',0,'Major Mix','Repellendus Volupta','2',0,NULL,'Eos consequat Optio',NULL,'','2025-07-19 14:14:05','2025-07-19 14:14:05'),(24,1,1,0,0,0,0,'1723205902','Hyatt Dillon',0,'Campaign8','Nesciunt autem dist','3',1,NULL,'Sit non ut enim err',NULL,'CAM190773010001','2025-07-19 15:58:21','2025-07-19 15:58:21');
/*!40000 ALTER TABLE `call_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_types`
--

DROP TABLE IF EXISTS `call_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_types`
--

LOCK TABLES `call_types` WRITE;
/*!40000 ALTER TABLE `call_types` DISABLE KEYS */;
INSERT INTO `call_types` VALUES (1,'Call Type',1,NULL,NULL),(2,'Jesse Bright',1,'2025-06-27 18:37:46','2025-06-27 18:37:46'),(3,'Call Type3',1,'2025-07-19 14:14:59','2025-07-19 14:14:59');
/*!40000 ALTER TABLE `call_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campaigns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (1,'Agency',1,NULL,NULL),(2,'Airline Mix',1,NULL,NULL),(3,'Buffer Mix',1,NULL,NULL),(4,'Cruise',1,NULL,NULL),(5,'International',1,NULL,NULL),(6,'LCC',1,NULL,NULL),(7,'Major Mix',1,NULL,NULL),(8,'Premium Amtrak Bing Calls',1,NULL,NULL),(9,'Pure AA',1,NULL,NULL),(10,'Spanish',1,NULL,NULL),(11,'Campaign8',1,'2025-07-19 14:14:46','2025-07-19 14:14:46');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `change_logs`
--

DROP TABLE IF EXISTS `change_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `change_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int DEFAULT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `model_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `field` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `old_value` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `new_value` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `changed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `change_logs`
--

LOCK TABLES `change_logs` WRITE;
/*!40000 ALTER TABLE `change_logs` DISABLE KEYS */;
INSERT INTO `change_logs` VALUES (1,31,31,'TravelBooking',1,'campaign','Pure AA','Premium Amtrak Bing Calls','2025-06-24 00:09:07'),(2,31,31,'TravelBooking',1,'cruise_ref','Id aliqua Rerum vol','Quasi facere magnam','2025-06-24 00:09:07'),(3,31,31,'TravelBooking',1,'car_ref','Beatae exercitatione','Incididunt animi su','2025-06-24 00:09:07'),(4,31,31,'TravelBooking',1,'train_ref','Consequatur A paria','Vitae et sit fuga','2025-06-24 00:09:07'),(5,31,31,'TravelBooking',1,'name','Yael Howell','Brielle Wilkinson','2025-06-24 00:09:07'),(6,31,31,'TravelBooking',1,'phone','+1 (518) 335-2961','+1 (854) 901-5072','2025-06-24 00:09:07'),(7,31,31,'TravelBooking',1,'email','canafe@mailinator.com','xefyluvyl@mailinator.com','2025-06-24 00:09:07'),(8,31,31,'TravelBooking',1,'query_type','UMNR','M','2025-06-24 00:09:07'),(9,31,31,'TravelBooking',1,'reservation_source','Officia dolor ab rep','Asperiores neque eiu','2025-06-24 00:09:07'),(10,31,31,'TravelBooking',1,'descriptor','Est duis sit veniam','Voluptatem mollit si','2025-06-24 00:09:07'),(11,31,31,'TravelBookingType',133,'type','null','Car','2025-06-24 00:09:07'),(12,31,31,'TravelBookingType',129,'deleted','exists','null','2025-06-24 00:09:07'),(13,31,31,'TravelBookingType',132,'deleted','exists','null','2025-06-24 00:09:07'),(14,31,31,'TravelBookingType',134,'type','null','Flight','2025-06-24 00:09:41'),(15,31,31,'TravelBooking',1,'campaign','Premium Amtrak Bing Calls','LCC','2025-06-24 00:13:26'),(16,31,31,'TravelBooking',1,'hotel_ref','Nihil dignissimos qu','Voluptatem in occae','2025-06-24 00:13:26'),(17,31,31,'TravelBooking',1,'cruise_ref','Quasi facere magnam','Nostrum molestias of','2025-06-24 00:13:26'),(18,31,31,'TravelBooking',1,'train_ref','Vitae et sit fuga','Qui a mollitia dolor','2025-06-24 00:13:26'),(19,31,31,'TravelBooking',1,'name','Brielle Wilkinson','Raphael Kane','2025-06-24 00:13:26'),(20,31,31,'TravelBooking',1,'phone','+1 (854) 901-5072','+1 (849) 204-4738','2025-06-24 00:13:26'),(21,31,31,'TravelBooking',1,'email','xefyluvyl@mailinator.com','kika@mailinator.com','2025-06-24 00:13:26'),(22,31,31,'TravelBooking',1,'query_type','M','B','2025-06-24 00:13:26'),(23,31,31,'TravelBooking',1,'selected_company','3','1','2025-06-24 00:13:26'),(24,31,31,'TravelBooking',1,'reservation_source','Asperiores neque eiu','Est voluptatum iusto','2025-06-24 00:13:26'),(25,31,31,'TravelBooking',1,'descriptor','Voluptatem mollit si','Laudantium asperior','2025-06-24 00:13:26'),(26,31,31,'TravelBookingType',130,'deleted','exists','null','2025-06-24 00:13:26'),(27,31,31,'TravelBookingType',131,'deleted','exists','null','2025-06-24 00:13:26'),(28,31,31,'TravelBookingType',133,'deleted','exists','null','2025-06-24 00:13:26'),(29,31,31,'TravelFlightDetail',20,'deleted','exists','null','2025-06-24 00:14:18'),(30,31,31,'TravelBooking',1,'campaign','LCC','Buffer Mix','2025-06-24 00:19:58'),(31,31,31,'TravelBooking',1,'hotel_ref','Voluptatem in occae','Modi ipsam dolore vo','2025-06-24 00:19:58'),(32,31,31,'TravelBooking',1,'car_ref','Incididunt animi su','Ratione ipsa error','2025-06-24 00:19:58'),(33,31,31,'TravelBooking',1,'train_ref','Qui a mollitia dolor','Ut commodo labore ad','2025-06-24 00:19:58'),(34,31,31,'TravelBooking',1,'airlinepnr','Enim facere sed even','Aut vero asperiores','2025-06-24 00:19:58'),(35,31,31,'TravelBooking',1,'amadeus_sabre_pnr','Excepteur dolorem il','Est omnis et et cum','2025-06-24 00:19:58'),(36,31,31,'TravelBooking',1,'pnrtype','GK','HK','2025-06-24 00:19:58'),(37,31,31,'TravelBooking',1,'name','Raphael Kane','Camden Cummings','2025-06-24 00:19:58'),(38,31,31,'TravelBooking',1,'phone','+1 (849) 204-4738','+1 (137) 987-2558','2025-06-24 00:19:58'),(39,31,31,'TravelBooking',1,'email','kika@mailinator.com','tykucyv@mailinator.com','2025-06-24 00:19:58'),(40,31,31,'TravelBooking',1,'query_type','B','N','2025-06-24 00:19:58'),(41,31,31,'TravelBooking',1,'selected_company','1','3','2025-06-24 00:19:58'),(42,31,31,'TravelBooking',1,'reservation_source','Est voluptatum iusto','Totam fuga Nulla od','2025-06-24 00:19:58'),(43,31,31,'TravelBooking',1,'descriptor','Laudantium asperior','Dolore non maxime eu','2025-06-24 00:19:58'),(44,31,31,'TravelFlightDetail',21,'deleted','exists','null','2025-06-24 00:21:04'),(45,27,27,'TravelBooking',2,'campaign','null','Premium Amtrak Bing Calls','2025-06-27 23:55:39'),(46,27,27,'TravelBooking',2,'pnrtype','null','HK','2025-06-27 23:55:39'),(47,27,27,'TravelBooking',2,'selected_company','null','1','2025-06-27 23:55:39'),(48,73,73,'TravelBooking',1,'query_type','null','N','2025-07-10 02:34:48'),(49,73,73,'TravelBooking',1,'selected_company','null','1','2025-07-10 02:34:48'),(50,73,73,'TravelBooking',1,'booking_status','under process','pending','2025-07-10 02:34:48'),(51,73,73,'TravelBookingType',192,'deleted','exists','null','2025-07-18 23:14:46'),(52,73,73,'TravelBookingType',193,'deleted','exists','null','2025-07-18 23:14:46'),(53,73,73,'TravelBookingType',194,'deleted','exists','null','2025-07-18 23:14:46'),(54,73,73,'TravelBookingType',196,'type','null','Flight','2025-07-18 23:36:32'),(55,73,73,'TravelBookingType',197,'type','null','Hotel','2025-07-18 23:36:32'),(56,73,73,'TravelBookingType',198,'type','null','Cruise','2025-07-18 23:36:32'),(57,73,73,'TravelBookingType',199,'type','null','Car','2025-07-18 23:36:32'),(58,73,73,'TravelBookingType',197,'deleted','exists','null','2025-07-18 23:39:03'),(59,73,73,'TravelBookingType',198,'deleted','exists','null','2025-07-18 23:39:03'),(60,73,73,'TravelBookingType',199,'deleted','exists','null','2025-07-18 23:39:03'),(61,73,73,'TravelBookingType',200,'type','null','Cruise','2025-07-18 23:45:20'),(62,73,73,'TravelBookingType',201,'type','null','Train','2025-07-18 23:45:20'),(63,73,73,'TravelBookingType',196,'deleted','exists','null','2025-07-18 23:45:20'),(64,75,75,'TravelBookingType',203,'type','null','Hotel','2025-07-20 19:15:28'),(65,75,75,'TravelBookingType',204,'type','null','Cruise','2025-07-20 19:15:28'),(66,75,75,'TravelBookingType',205,'type','null','Car','2025-07-20 19:15:28'),(67,75,75,'TravelBookingType',202,'deleted','exists','null','2025-07-20 19:15:28'),(68,75,75,'TravelBookingType',206,'type','null','Flight','2025-07-20 19:16:09'),(69,75,75,'TravelBookingType',203,'deleted','exists','null','2025-07-20 19:16:09'),(70,75,75,'TravelBookingType',204,'deleted','exists','null','2025-07-20 19:16:09'),(71,75,75,'TravelBookingType',205,'deleted','exists','null','2025-07-20 19:16:09'),(72,75,75,'TravelBookingType',206,'deleted','exists','null','2025-07-20 19:17:53'),(73,68,68,'TravelBookingType',184,'deleted','exists','null','2025-07-27 20:48:04'),(74,68,68,'TravelBookingType',183,'deleted','exists','null','2025-07-27 20:51:43'),(75,68,68,'TravelBookingType',185,'deleted','exists','null','2025-07-27 20:51:43'),(76,68,68,'TravelBookingType',207,'type','null','Train','2025-07-27 21:02:22'),(77,68,68,'TravelBookingType',208,'type','null','Cruise','2025-07-27 21:33:32'),(78,68,68,'TravelBookingType',182,'deleted','exists','null','2025-07-27 21:33:32'),(79,68,68,'TravelBookingType',209,'type','null','Flight','2025-07-27 22:01:18'),(80,68,68,'TravelBookingType',207,'deleted','exists','null','2025-07-27 22:02:09'),(81,68,68,'TravelBookingType',208,'deleted','exists','null','2025-07-27 22:02:09'),(82,64,64,'TravelBookingType',210,'type','null','Car','2025-07-28 02:19:01'),(83,64,64,'TravelBookingType',180,'deleted','exists','null','2025-07-28 02:19:01');
/*!40000 ALTER TABLE `change_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country_code` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `calling_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `currency_code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_code` (`country_code`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan','AF','+93','AFN'),(2,'Albania','AL','+355','ALL'),(3,'Algeria','DZ','+213','DZD'),(4,'Andorra','AD','+376','EUR'),(5,'Angola','AO','+244','AOA'),(6,'Argentina','AR','+54','ARS'),(7,'Armenia','AM','+374','AMD'),(8,'Australia','AU','+61','AUD'),(9,'Austria','AT','+43','EUR'),(10,'Azerbaijan','AZ','+994','AZN'),(11,'Bahamas','BS','+1-242','BSD'),(12,'Bahrain','BH','+973','BHD'),(13,'Bangladesh','BD','+880','BDT'),(14,'Barbados','BB','+1-246','BBD'),(15,'Belarus','BY','+375','BYN'),(16,'Belgium','BE','+32','EUR'),(17,'Belize','BZ','+501','BZD'),(18,'Benin','BJ','+229','XOF'),(19,'Bhutan','BT','+975','BTN'),(20,'Bolivia','BO','+591','BOB'),(21,'Bosnia and Herzegovina','BA','+387','BAM'),(22,'Botswana','BW','+267','BWP'),(23,'Brazil','BR','+55','BRL'),(24,'Brunei','BN','+673','BND'),(25,'Bulgaria','BG','+359','BGN'),(26,'Burkina Faso','BF','+226','XOF'),(27,'Burundi','BI','+257','BIF'),(28,'Cambodia','KH','+855','KHR'),(29,'Cameroon','CM','+237','XAF'),(30,'Canada','CA','+1','CAD'),(31,'Chile','CL','+56','CLP'),(32,'China','CN','+86','CNY'),(33,'Colombia','CO','+57','COP'),(34,'Costa Rica','CR','+506','CRC'),(35,'Croatia','HR','+385','HRK'),(36,'Cuba','CU','+53','CUP'),(37,'Cyprus','CY','+357','EUR'),(38,'Czech Republic','CZ','+420','CZK'),(39,'Denmark','DK','+45','DKK'),(40,'Djibouti','DJ','+253','DJF'),(41,'Dominica','DM','+1-767','XCD'),(42,'Dominican Republic','DO','+1-809, +1','DOP'),(43,'Ecuador','EC','+593','USD'),(44,'Egypt','EG','+20','EGP'),(45,'El Salvador','SV','+503','USD'),(46,'Estonia','EE','+372','EUR'),(47,'Eswatini','SZ','+268','SZL'),(48,'Ethiopia','ET','+251','ETB'),(49,'Fiji','FJ','+679','FJD'),(50,'Finland','FI','+358','EUR'),(51,'France','FR','+33','EUR'),(52,'Gabon','GA','+241','XAF'),(53,'Gambia','GM','+220','GMD'),(54,'Georgia','GE','+995','GEL'),(55,'Germany','DE','+49','EUR'),(56,'Ghana','GH','+233','GHS'),(57,'Greece','GR','+30','EUR'),(58,'Grenada','GD','+1-473','XCD'),(59,'Guatemala','GT','+502','GTQ'),(60,'Guinea','GN','+224','GNF'),(61,'Guinea-Bissau','GW','+245','XOF'),(62,'Guyana','GY','+592','GYD'),(63,'Haiti','HT','+509','HTG'),(64,'Honduras','HN','+504','HNL'),(65,'Hungary','HU','+36','HUF'),(66,'Iceland','IS','+354','ISK'),(67,'India','IN','+91','INR'),(68,'Indonesia','ID','+62','IDR'),(69,'Iran','IR','+98','IRR'),(70,'Iraq','IQ','+964','IQD'),(71,'Ireland','IE','+353','EUR'),(72,'Israel','IL','+972','ILS'),(73,'Italy','IT','+39','EUR'),(74,'Jamaica','JM','+1-876','JMD'),(75,'Japan','JP','+81','JPY'),(76,'Jordan','JO','+962','JOD'),(77,'Kazakhstan','KZ','+7','KZT'),(78,'Kenya','KE','+254','KES'),(79,'Kiribati','KI','+686','AUD'),(80,'Korea (North)','KP','+850','KPW'),(81,'Korea (South)','KR','+82','KRW'),(82,'Kuwait','KW','+965','KWD'),(83,'Kyrgyzstan','KG','+996','KGS'),(84,'Laos','LA','+856','LAK'),(85,'Latvia','LV','+371','EUR'),(86,'Lebanon','LB','+961','LBP'),(87,'Lesotho','LS','+266','LSL'),(88,'Liberia','LR','+231','LRD'),(89,'Libya','LY','+218','LYD'),(90,'Liechtenstein','LI','+423','CHF'),(91,'Lithuania','LT','+370','EUR'),(92,'Luxembourg','LU','+352','EUR'),(93,'Madagascar','MG','+261','MGA'),(94,'Malawi','MW','+265','MWK'),(95,'Malaysia','MY','+60','MYR'),(96,'Maldives','MV','+960','MVR'),(97,'Mali','ML','+223','XOF'),(98,'Malta','MT','+356','EUR');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Boarding Pass','Thank you for contacting Reservation Desk!','fdsgdfsgfdgdfgdf',NULL,'2025-04-27 17:32:02'),(2,'eTicket','Thank you for contacting Reservation Desk!','bgfg gsdgdfgfd',NULL,'2025-04-27 17:31:12'),(3,'Exchanges','Thank you for contacting Reservation Desk!	','',NULL,NULL),(4,'Cancellation','Thank you for contacting Reservation Desk!	','',NULL,NULL),(5,'Confirmation','Thank you for contacting Reservation Desk!	','',NULL,NULL),(8,'Kylan Dejesus','Deserunt qui enim qu','Laborum Maiores vol','2025-04-27 17:18:26','2025-04-27 17:18:26'),(9,'Anastasia Gutierrez','Esse quia labore vit','Est exercitation dol','2025-04-27 17:18:51','2025-04-27 17:18:51'),(10,'Alexandra Soto','Sed quia animi expe','Hic exercitation occ','2025-04-27 17:19:17','2025-04-27 17:19:17'),(11,'Garrett Hoover','Laborum perferendis','Necessitatibus in ei','2025-04-27 17:20:19','2025-04-27 17:20:19');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `log_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `operation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `calllog_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'CallLog','Viewed','14','You have seen the call log',1,'2025-05-05 19:07:24','0000-00-00 00:00:00'),(2,'CallLog','Viewed','14','You have seen the call log',1,'2025-05-04 19:07:46','2025-05-04 19:07:46'),(3,'CallLog','created','15','Call Log created successfully',1,'2025-05-04 19:21:10','2025-05-04 19:21:10'),(4,'CallLog','created','16','Call Log created successfully',1,'2025-05-05 07:35:47','2025-05-05 07:35:47'),(5,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:00','2025-05-05 08:35:00'),(6,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:06','2025-05-05 08:35:06'),(7,'CallLog','Updated','16','Field \'team\' updated from \'\' to \'flydreamz\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(8,'CallLog','Updated','16','Field \'call_converted\' updated from \'1\' to \'0\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(9,'CallLog','Updated','16','Field \'followup_date\' updated from \'2025-05-05 09:35:00\' to \'\'',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(10,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:35:15','2025-05-05 08:35:15'),(11,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:17','2025-05-05 08:37:17'),(12,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:32','2025-05-05 08:37:32'),(13,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:37','2025-05-05 08:37:37'),(14,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:37:39','2025-05-05 08:37:39'),(15,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:38:36','2025-05-05 08:38:36'),(16,'CallLog','Updated','16','Field \'team\' updated from \'flydreamz\' to \'Tamekah Craig\'',1,'2025-05-05 08:38:42','2025-05-05 08:38:42'),(17,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:38:42','2025-05-05 08:38:42'),(18,'CallLog','Viewed','16','You have seen the call log',1,'2025-05-05 08:39:56','2025-05-05 08:39:56'),(19,'CallLog','created','17','Call Log created successfully',1,'2025-05-17 14:27:34','2025-05-17 14:27:34'),(20,'CallLog','created','18','Call Log created successfully',1,'2025-05-17 14:32:02','2025-05-17 14:32:02'),(21,'CallLog','Viewed','17','You have seen the call log',1,'2025-05-17 14:32:24','2025-05-17 14:32:24'),(22,'CallLog','Viewed','17','You have seen the call log',1,'2025-06-16 17:52:35','2025-06-16 17:52:35'),(23,'CallLog','Viewed','18','You have seen the call log',1,'2025-06-18 15:56:36','2025-06-18 15:56:36'),(24,'CallLog','created','1','Call Log created successfully',3,'2025-06-27 17:49:39','2025-06-27 17:49:39'),(25,'CallLog','created','2','Call Log created successfully',3,'2025-06-27 17:50:23','2025-06-27 17:50:23'),(26,'CallLog','created','3','Call Log created successfully',3,'2025-06-27 17:50:37','2025-06-27 17:50:37'),(27,'CallLog','created','4','Call Log created successfully',3,'2025-06-27 18:13:51','2025-06-27 18:13:51'),(28,'CallLog','created','5','Call Log created successfully',2,'2025-06-27 18:20:45','2025-06-27 18:20:45'),(29,'CallLog','Viewed','5','You have seen the call log',2,'2025-06-27 18:26:17','2025-06-27 18:26:17'),(30,'CallLog','Viewed','5','You have seen the call log',2,'2025-06-27 18:26:28','2025-06-27 18:26:28'),(31,'CallLog','Viewed','5','You have seen the call log',2,'2025-06-27 18:27:01','2025-06-27 18:27:01'),(32,'CallLog','Viewed','5','You have seen the call log',2,'2025-06-27 18:27:21','2025-06-27 18:27:21'),(33,'CallLog','Viewed','5','You have seen the call log',2,'2025-06-27 18:28:03','2025-06-27 18:28:03'),(34,'CallLog','created','6','Call Log created successfully',3,'2025-06-27 19:07:18','2025-06-27 19:07:18'),(35,'CallLog','Viewed','6','You have seen the call log',3,'2025-06-27 19:51:25','2025-06-27 19:51:25'),(36,'CallLog','created','7','Call Log created successfully',1,'2025-06-28 16:32:47','2025-06-28 16:32:47'),(37,'CallLog','created','21','Call Log created successfully',1,'2025-07-11 16:04:24','2025-07-11 16:04:24'),(38,'CallLog','Viewed','17','You have seen the call log',1,'2025-07-11 20:58:00','2025-07-11 20:58:00'),(39,'CallLog','Viewed','17','You have seen the call log',1,'2025-07-11 20:58:13','2025-07-11 20:58:13'),(40,'CallLog','Viewed','17','You have seen the call log',1,'2025-07-11 20:58:30','2025-07-11 20:58:30'),(41,'CallLog','created','23','Call Log created successfully',1,'2025-07-19 14:14:05','2025-07-19 14:14:05'),(42,'CallLog','Viewed','24','You have seen the call log',1,'2025-07-19 16:30:10','2025-07-19 16:30:10'),(43,'CallLog','Viewed','24','You have seen the call log',1,'2025-07-19 16:30:14','2025-07-19 16:30:14'),(44,'CallLog','Viewed','24','You have seen the call log',1,'2025-07-19 16:30:24','2025-07-19 16:30:24'),(45,'CallLog','Viewed','24','You have seen the call log',1,'2025-07-22 18:35:42','2025-07-22 18:35:42');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (23,'0001_01_01_000000_create_users_table',1),(24,'0001_01_01_000001_create_cache_table',1),(25,'0001_01_01_000002_create_jobs_table',1),(26,'2025_04_09_205250_create_statuses_table',1),(27,'2025_04_09_205251_create_suppliers_table',1),(28,'2025_04_09_205252_create_qualities_table',1),(29,'2025_04_09_205253_create_teams_table',1),(30,'2025_04_09_205254_create_campaigns_table',1),(31,'2025_04_09_205255_create_call_types_table',1),(32,'2025_04_09_205256_create_quality_feedbacks_table',1),(33,'2025_04_09_205257_create_booking_statuses_table',1),(34,'2025_04_09_205257_create_query_types_table',1),(35,'2025_04_09_205258_create_payment_statuses_table',1),(36,'2025_04_09_210530_add_value_to_query_types_table',1),(37,'2025_04_09_212632_create_companies_table',1),(38,'2025_04_09_221722_create_call_logs_table',1),(39,'2025_04_26_121136_create_members_table',1),(40,'2025_06_21_203407_create_travel_flight_details_table',1),(41,'2025_06_21_203415_create_travel_car_details_table',1),(42,'2025_06_21_203419_create_travel_cruise_details_table',1),(43,'2025_06_21_203424_create_travel_hotel_details_table',1),(44,'2025_06_21_203432_create_travel_train_details_table',1),(45,'2025_06_29_212218_create_signatures_table',2),(46,'2025_07_06_131128_add_details_to_travel_cruise_details_table',2),(47,'2025_07_06_133453_add_details_to_travel_pricing_details_table',2),(48,'2025_07_07_001615_create_auth_histories_table',2),(49,'2025_07_07_011847_create_attendances_table',2),(50,'2025_07_07_022203_create_short_breaks_table',2),(51,'2025_07_07_233424_create_shifts_table',2),(52,'2025_07_07_233803_create_user_shift_assignments_table',2),(53,'2025_07_07_233947_add_shift_id_to_travel_bookings_table',2),(54,'2025_07_08_003939_add_team_id_to_travel_bookings_table',2),(55,'2025_07_08_004414_create_user_team_assignments_table',2),(56,'2025_07_09_203328_add_statuses_to_travel_bookings_table',2),(57,'2025_07_11_202056_add_profile_pucture_to_users_table',2),(58,'2025_07_12_085242_add_details_to_travel_flight_details_table',3),(59,'2025_07_12_090123_add_details_to_travel_car_details_table',3),(60,'2025_07_12_101337_add_details_to_travel_cruise_details_table',3),(61,'2025_07_12_101506_add_details_to_travel_hotel_details_table',3),(62,'2025_07_13_144308_add_details_to_travel_train_details_table',3),(63,'2025_07_18_203542_remove_booking_status_columns_from_travel_bookings_table',3),(64,'2025_07_18_215221_recreate_travel_pricing_details_table',4),(65,'2025_07_18_220229_drop_travel_pricing_details_table',4),(66,'2025_07_20_095143_add_details_travel_bookings_table',5),(67,'2025_07_20_103604_add_details_travel_pricing_details_table',6),(68,'2025_07_20_110843_add_details_to_travel_pricing_details_table',7),(69,'2025_07_27_190905_create_billing_details_table',8),(70,'2025_07_27_115413_create_billing_details_table',9),(71,'2025_07_29_173844_add_details_to_travel_bookings_table',9),(72,'2025_07_29_175948_add_details_travel_billing_details_table',9),(73,'2025_07_29_183117_add_details_to_travel_bookings_table',9),(74,'2025_07_29_202023_add_user_id_to_travel_quality_feedback_table',10),(75,'2025_07_30_031406_update_travel_quality_feedback_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_statuses`
--

DROP TABLE IF EXISTS `payment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_statuses`
--

LOCK TABLES `payment_statuses` WRITE;
/*!40000 ALTER TABLE `payment_statuses` DISABLE KEYS */;
INSERT INTO `payment_statuses` VALUES (1,'PENDING',1,NULL,'2025-07-23 20:34:08'),(2,'CARD APPROVAL',1,NULL,'2025-07-23 20:34:15'),(3,'INVALID CARD',1,NULL,'2025-07-23 20:34:28'),(4,'INSUFFICIENT FUNDS',1,NULL,'2025-07-23 20:34:35'),(5,'WRONG EXPIRY',1,NULL,'2025-07-23 20:34:43'),(6,'ADDRESS MISMATCH',1,NULL,'2025-07-23 20:34:52');
/*!40000 ALTER TABLE `payment_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qualities`
--

DROP TABLE IF EXISTS `qualities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualities`
--

LOCK TABLES `qualities` WRITE;
/*!40000 ALTER TABLE `qualities` DISABLE KEYS */;
/*!40000 ALTER TABLE `qualities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quality_feedbacks`
--

DROP TABLE IF EXISTS `quality_feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quality_feedbacks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quality_feedbacks`
--

LOCK TABLES `quality_feedbacks` WRITE;
/*!40000 ALTER TABLE `quality_feedbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `quality_feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `query_types`
--

DROP TABLE IF EXISTS `query_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `query_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `query_types`
--

LOCK TABLES `query_types` WRITE;
/*!40000 ALTER TABLE `query_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `query_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shifts`
--

DROP TABLE IF EXISTS `shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shifts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shifts`
--

LOCK TABLES `shifts` WRITE;
/*!40000 ALTER TABLE `shifts` DISABLE KEYS */;
INSERT INTO `shifts` VALUES (1,'Morning','00:00:08','00:00:16',NULL,NULL),(2,'Evning','00:00:04','00:00:12',NULL,NULL),(3,'Night','00:00:12','00:00:04',NULL,NULL);
/*!40000 ALTER TABLE `shifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `short_breaks`
--

DROP TABLE IF EXISTS `short_breaks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `short_breaks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `break_date` date NOT NULL,
  `status` enum('Started','Ended') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Started',
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `total_time` int DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `short_breaks_user_id_foreign` (`user_id`),
  CONSTRAINT `short_breaks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `short_breaks`
--

LOCK TABLES `short_breaks` WRITE;
/*!40000 ALTER TABLE `short_breaks` DISABLE KEYS */;
/*!40000 ALTER TABLE `short_breaks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signatures`
--

DROP TABLE IF EXISTS `signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `signatures` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `signature_type` enum('draw','type') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `signature_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signatures`
--

LOCK TABLES `signatures` WRITE;
/*!40000 ALTER TABLE `signatures` DISABLE KEYS */;
INSERT INTO `signatures` VALUES (12,'type','<span style=\"font-family: Dancing Script; font-size: 24px;\">kaushlendra Singh</span>','122.185.26.58','2025-06-29 20:50:46','2025-06-29 20:50:46'),(13,'draw','data:image/png;base64,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','122.185.26.58','2025-06-29 20:51:06','2025-06-29 20:51:06'),(14,'type','<span style=\"font-family: Sacramento; font-size: 24px;\">http://127.0.0.1:8000/signature</span>','122.185.26.58','2025-06-29 20:52:04','2025-06-29 20:52:04');
/*!40000 ALTER TABLE `signatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Zee',1,NULL,NULL),(5,'Hector',1,NULL,NULL),(6,'Rojer',1,NULL,NULL),(7,'Victor',1,NULL,NULL),(8,'Team3',1,'2025-07-19 14:14:34','2025-07-19 14:14:34');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_billing_details`
--

DROP TABLE IF EXISTS `travel_billing_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_billing_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_billing_details`
--

LOCK TABLES `travel_billing_details` WRITE;
/*!40000 ALTER TABLE `travel_billing_details` DISABLE KEYS */;
INSERT INTO `travel_billing_details` VALUES (54,27,'VISA','eyJpdiI6ImVUOFpLSCt3S090YWY3dmNmblFJR1E9PSIsInZhbHVlIjoiWjJaUHk4SktrVHlHZUNVdGR5UWtNUT09IiwibWFjIjoiODdiOTcxNDlkNjQ1M2VjZmVhZWFkNjFjODgxZTY4ZWVhNjMxYTMzZTRhZTdkNzdmNDk4MGU2ZjBmYWU3YjJiYyIsInRhZyI6IiJ9','2','01','2025','eyJpdiI6Im5IM3l3dUUrRXE4T3JhTnNidWNkYXc9PSIsInZhbHVlIjoiMGpiK0tuZEFnSnBoS2RRTFNhUFhLZz09IiwibWFjIjoiNDNjNTFjNjkxNjM5Y2ExOWE5ODJjY2NiZTUwMGY0ZTc2ZGY5Mjc4YTlhNDRhYWYxZjIzMGQyNTY4N2QyNGI3YiIsInRhZyI6IiJ9','3','3@teet.com','12','12','Afghanistan',NULL,'21','USD',2300.00,0,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(55,27,NULL,'eyJpdiI6Ii9oMjMwdVUxOURueS9ZbnBzOWFDbmc9PSIsInZhbHVlIjoieER0VkN2dmlWREpRQ3o0Vmc2TmdIUT09IiwibWFjIjoiZTNiYzk2YjFlN2FiNGM2ZTAyODFkZjI2YTNlMTI0ZDljMDhjZmQyNDMyOTQyMWNmNzc3M2M2OThjYmU4N2IzNSIsInRhZyI6IiJ9','23','01','2025','eyJpdiI6Im9uRldKektmRHpOQkRtWWFuYnBBOWc9PSIsInZhbHVlIjoiZHpLbGdOa0NxTXMreGVPRnI1QzhHQT09IiwibWFjIjoiZTlhZDJiMmIxMjExZGY0NDkxYjg0OGVkMjQ3NjEwMDQxNzcwZDU2ZjhmMTBlZTY2YzhjZDIwOTA1NWQxZDE1ZSIsInRhZyI6IiJ9','3232','32@gmail.com','56','56','56','56','56','CAD',0.00,0,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(56,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(57,27,'VISA','eyJpdiI6ImIwSi80UHp5bDdUdlpuT3RyK29xTWc9PSIsInZhbHVlIjoiSGZDcGRqREJ6M1EwaWIrSFdHZGo2UT09IiwibWFjIjoiMjgzMWQwNzRkOWQwZDc4MzhlYjI0YjdmNDY3OTYyMjk1YWYzOTI2MjRlODY0Mzc4MDYxYzYxODAyOTlmZDZlNSIsInRhZyI6IiJ9','2','01','2025','eyJpdiI6IkgrcjJ2M25MSlIwYUNOazM0TlNoTWc9PSIsInZhbHVlIjoiVWEvTDRMVkVXQkNkVkVwTFJYWDhVdz09IiwibWFjIjoiZjQ0ODI0M2IxMjlkODE1NDI5ZjcxNzVmZjY1YWU4NWM3ZjBkOTQ1MTM3YTI4N2YzZjYwOTlkNDY4Y2ZmYmI4NyIsInRhZyI6IiJ9','3','3@teet.com','12','12','Afghanistan',NULL,'21','USD',2300.00,0,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(58,27,NULL,'eyJpdiI6IllyUXc0U2k0VGNmSXJxcFdkQ2s2Ymc9PSIsInZhbHVlIjoiM1hQcVZla1N3MnUrZmJRNWVNZUc1UT09IiwibWFjIjoiMTgxM2M0ZDc1ZmJiYmVhMDAyYWFhMmJkYjJhMzJkNmNiYzMzNmU5YTc3ODdmNmI2YjY2YzhmMzExOTViM2VlNiIsInRhZyI6IiJ9','23','01','2025','eyJpdiI6InBaNjdlR0NUcEtpb1pyT2tSRnMxeVE9PSIsInZhbHVlIjoiajc5OHdZTW1oVlZmaW1nckFnS0F5UT09IiwibWFjIjoiMWJmNTMwYTQzMGMxM2RiNDA3NjBmNjQ4YmJlMDQwNjAyYWNiMTVmYmQ2ZjEzNzFmZjZhZWJkMjllNjYxZTA0NSIsInRhZyI6IiJ9','3232','32@gmail.com','56','56','56','56','56','CAD',0.00,0,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(59,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(60,28,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-22 03:13:42','2025-06-21 23:13:42',NULL),(61,28,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-22 03:13:42','2025-06-21 23:13:42',NULL),(62,29,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-22 03:15:10','2025-06-21 23:15:10',NULL),(63,29,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-22 03:15:10','2025-06-21 23:15:10',NULL),(64,30,'VISA','eyJpdiI6IllFcWltSzRPYXNzcVRGbFh1MGRmR3c9PSIsInZhbHVlIjoiTzBvL2ptOXRvZERZcE5ZV2EwMmpYUT09IiwibWFjIjoiNjdiZDM3NjA1NzI2MzY2ZWY1ZWNlOWJmOTQxMjQ3NTkzMzUyODEyMzI5YTY4Y2JjZTQzMTVjZmM2YWU1MTE1ZCIsInRhZyI6IiJ9','Blaine Michael','12','2030','eyJpdiI6IkJlQUxVK3AyNE1rdm5yem5kZ2FBd3c9PSIsInZhbHVlIjoiZ3p2Um1nTWdWems1V0JmTmdsSXpXbTZ5Wi9yeDI5TUJBd3VQQlVZTWFacz0iLCJtYWMiOiI0NmZhOTJiMjNhYzU0MDIwNmNjNmEyNGY3ODM4MzgzODhjMmE1YzVmZWMzNzVlNTI5ZmExZGJiMGJlZjU4MGE0IiwidGFnIjoiIn0=','Voluptatum quia ut m','byquhag@mailinator.com','Tempora quis dolor c','Ut asperiores ullamc','Sri Lanka',NULL,'36448','USD',39.00,0,'2025-06-22 04:30:11','2025-06-22 00:30:11',NULL),(65,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-22 04:30:11','2025-06-22 00:30:11',NULL),(66,30,'VISA','eyJpdiI6Im5ueVJxVVRBYnFOZE9yNmtWWE1xU2c9PSIsInZhbHVlIjoia0t5NEFMaDRKMzA3WmRlVEltdC9EZz09IiwibWFjIjoiNjE0OWE5NTRkM2Y4ZTFjMjQxMjIwNTA2YmE3ZjM4Y2M2Y2Y3YWMyMjhjNGFkYmYyMzYxMDFjNDE2Y2Q3NmEyNSIsInRhZyI6IiJ9','Blaine Michael','12','2030','eyJpdiI6IklTUC84Z1VNYzcxVWdEQ1hBQVN1ckE9PSIsInZhbHVlIjoibGxSRG5GMFY0dXpaeTdVekpzbjJiUER4cUkwNmlSZmMyNE9YbjJuMGdPYz0iLCJtYWMiOiJkYWUxYmZmOTFkODk3NjUzZWVkMjdhNWJkNzE0N2RkY2RiZjhmNzlhOTIzOTRhYzA4MzEzMzVlMGRhNzkwNDE0IiwidGFnIjoiIn0=','Voluptatum quia ut m','byquhag@mailinator.com','Tempora quis dolor c','Ut asperiores ullamc','Sri Lanka',NULL,'36448','USD',39.00,0,'2025-06-22 04:30:11','2025-06-22 00:30:11',NULL),(67,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-22 04:30:11','2025-06-22 00:30:11',NULL),(68,31,'AMEX','eyJpdiI6ImlDSWJXMGp5dzgwcWZFZTI5RG0vOUE9PSIsInZhbHVlIjoiMDlUalpWdjBNeXpFTmtEb2lTZE9Zdz09IiwibWFjIjoiN2MyNDA2MjA3MjNjYmQwNGFiYTM5ZTg3MzU2ZmM3YWM1NTVlYThmZTEzMjM0ODZhNGZiZTA4M2Y5NGYwNGU2OCIsInRhZyI6IiJ9','Gisela Small','09','2034','eyJpdiI6IlBERG4xNVBkWm9KMEVLWEVkY3J2VGc9PSIsInZhbHVlIjoiSzJ4TVh2K09uZlFVUEk4bzdWNVBHMlo2RllCTlpQK1hvWkIxQlJzeEV6UT0iLCJtYWMiOiIyZTdkNDk4YWZkNTk5MzA1ODJiZWNkMzI0ODE3YjUxZDE2MjExZTU5NTU3YWVmNzIxZDJlNTk1YzUxOTVmNzFkIiwidGFnIjoiIn0=','At voluptas pariatur','punanoboxe@mailinator.com','Quis esse rerum minu','Sit eos dolore volu','Croatia',NULL,'94735','USD',41.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(69,31,NULL,'eyJpdiI6IlFYTElyazQ0cjdCOUk0b1F3cnpjc1E9PSIsInZhbHVlIjoiVUNGMHdFOE9WOU5ZUElZWFJFMXlMQT09IiwibWFjIjoiNjk1YmYwNTJlNWZjZDM4ZjVjNDlkMTVhZWYxNjg1M2M3OWVhOGMwOWE3N2Y5ZTc3Zjk1M2JiNDdiYWZmYzMxNCIsInRhZyI6IiJ9','Wallace Long',NULL,NULL,'eyJpdiI6IlhlQTBoVW9YQUNWczZPU05neTJtSFE9PSIsInZhbHVlIjoiRkVIckU3bHhheCtLYzh1dW5IRmRmais1elVHQm5sZkZpWkRmV2xXdmpvOD0iLCJtYWMiOiJlMDk0YmE3MDc2MzBlNDdkMTZkNGY2NWU4ZGVlMDNlZjI4NTFlMDE4OGE0ZjE0OTc4MDkzN2Q0MjA2MTFjMDc2IiwidGFnIjoiIn0=','Accusantium ullamco','syxopanac@mailinator.com','Blanditiis laborum n','Nulla eos quos conse','Cupidatat laboris mo','Cillum reiciendis oc','21192',NULL,67.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(70,31,NULL,'eyJpdiI6IndNRTF6N0VoV3RUSTNqekV2ZlFZZFE9PSIsInZhbHVlIjoiUk4zS2hvTkdZOEhrUGhBNmlzL2VzZz09IiwibWFjIjoiNzZiOTUzZGZhNDdhZGExZWQ3ZjAzYjczNWZhM2MwMjVjMTNhNDQ5YjdmZmU5MjdmZmEzM2Y0YzEzY2JiNWNlYiIsInRhZyI6IiJ9','Florence Benton',NULL,NULL,'eyJpdiI6ImtxbDN6Vmh0LzRpTEdicW0zdjJYZ1E9PSIsInZhbHVlIjoiVjd6T0R3anRLOHJpNFI2RFU2SFFZS0N2WmJRSEpteDhYNjZZSGFTc2p4Zz0iLCJtYWMiOiI4MmY3N2Y5MTc0ODgxZTg1NWNmNmIxMWY1MWEzNTAyZDQ3Zjg0YjA1YjA3Y2UzMjBmMDliMTA3Y2ZmN2I1NmZmIiwidGFnIjoiIn0=','Sit tempore autem q','hojid@mailinator.com','Excepturi irure eos','Irure commodi soluta','Tempor consequuntur','Asperiores libero es','40457',NULL,58.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(71,31,NULL,'eyJpdiI6InpWSmhta0NMcjlMR1NSZlUvMDQ2dGc9PSIsInZhbHVlIjoiVVJrMmtsbTg2L1pDdUcyQmNrYit1dz09IiwibWFjIjoiMDNiZjA2MzA4MTBhYjFmMjk4YmIyOTlkYmY2OThkNGE3ZDFhZDYzMzllNzNkODBiMGFkMjVmZjRkMGRlZWI1NiIsInRhZyI6IiJ9','Len Talley',NULL,NULL,'eyJpdiI6ImhROFhXREFpTitXZkdMTHdUa0Z5N1E9PSIsInZhbHVlIjoiTXZRWmRRbEZLMXczQVJ2aFlTTTJITWZHMGFDK2ZKbEl4Z1hJS3c1eFczUT0iLCJtYWMiOiI0ZTU3MmQ0YzUzMjBiZTkzNGZlZWI1NzAxNzE4MzUxY2NjMzcyMmVjNDU1YTMxZmE4MzdlMWJhNGUzMWI1YjBlIiwidGFnIjoiIn0=','Ea fugiat tempor sun','zeju@mailinator.com','Vitae culpa eum aut','Nisi ipsum quam fug','Aut lorem ducimus a','Modi reprehenderit','27201',NULL,35.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(72,31,NULL,'eyJpdiI6Ild3T3ZGbXZrb3BSNkVJaENzOFNOK0E9PSIsInZhbHVlIjoiSm90VU9ScTNyUFljZkxUMG1IeU9kUT09IiwibWFjIjoiOGU5MDdkMmFlYjU3YjQ0NWRlNDcyY2Y1ZjFiMTk3NTZjMzFhYzgxOGEyMDgzZDA0N2UxOGQ2OGRiYmRjYmI4ZCIsInRhZyI6IiJ9','Kai Higgins',NULL,NULL,'eyJpdiI6IlNPVXMzK2p1azZwQTVCVFNFWHkwNXc9PSIsInZhbHVlIjoiSnJTOVBoMnJ3dHpyZU1NT3NhdDljQUJ1MHJTQ1hDbzlJUVJLNy9UK0NBZz0iLCJtYWMiOiI5ZWNiZTJkZmZjNzFkMDdmYzljOGZmNTI1ZmZmZWZmYTVhMDU4YjA4MzI2ZDQ0Y2Y0MGRjNDJiN2UxNjMzMWNjIiwidGFnIjoiIn0=','Culpa quos exercitat','bupatijy@mailinator.com','Quibusdam numquam am','Sit temporibus moll','Ut delectus et proi','Explicabo Nisi volu','15450',NULL,88.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(73,31,NULL,'eyJpdiI6IkVRZzhWM0dWd3JWYWlJNDJCVmhzSnc9PSIsInZhbHVlIjoiUFIrN1lJdHQ3amQzak5MamkxWUJWQT09IiwibWFjIjoiYThhNjU1MDIwYTQwYTRlYmVlOTcwMmY4NzA2Mjc0NzAxZjg2MmE1NWE1YWE4MTVlN2Y0ZjNlZTkyYjY4Nzg0NiIsInRhZyI6IiJ9','Wyoming Mcpherson',NULL,NULL,'eyJpdiI6IlVrTzdVYldBQjR3VmQyS0NndFpZdEE9PSIsInZhbHVlIjoibFVTNnJZODFhM1B3ZVVDOCtubTZrQVpkNnA3eDU5V3VIYzIxNStzMExSQT0iLCJtYWMiOiIyZTg1ZTg5Zjk2MzlhODdjNDk0ODFiYjY0ZWY4MmI4Zjk1NDU1NmJlZmFjZDZiNmIwMGMxN2I2NDc3Y2QzMGJhIiwidGFnIjoiIn0=','Perspiciatis autem','jitiwon@mailinator.com','Atque iusto et eveni','At quaerat necessita','Quia aut quia debiti','Vitae consequatur A','28710',NULL,29.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(74,31,NULL,'eyJpdiI6IjNVU3d5UVlZVGRZZVVUNGRpdTkwdHc9PSIsInZhbHVlIjoiNk42L1M2NEhySTd3ZVFvOXQyK0NhZz09IiwibWFjIjoiYzM4YTFiYTg1MDM1N2RkY2RlOGYwZWU5N2QzMTA3Y2EyMmU3NGY5NTk2ZWIwNzcxNTM4ZGIzMDlkZTAxZDI2ZCIsInRhZyI6IiJ9','Donovan Estrada',NULL,NULL,'eyJpdiI6IlE1ZFREOFJNTzJZSWFqY0ZDQ3lJblE9PSIsInZhbHVlIjoic1BpZ3NtMkFaVmliMFR3NXdWc0ozRE5BZmtaejlMVnp2RThUcXdiVEYxST0iLCJtYWMiOiI1YzE4OTcwOWM0MDczOGVhOGVhMDhlNTY0M2NjMzYxNDVkMWVkZDZmZTQzYTYxNDljZWM1ZTNmMTJhNzM3ZDRlIiwidGFnIjoiIn0=','Possimus possimus','fypuzuno@mailinator.com','Ut expedita nulla ni','Beatae aliquam et ma','At est labore magna','Blanditiis aut ut am','18251',NULL,48.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(75,31,NULL,'eyJpdiI6IkM2RmdkaTEybm51ZjdWSm1ScnFqdnc9PSIsInZhbHVlIjoiVFpyNE5LeTE2MTd4Vll6T2dMOFpZQT09IiwibWFjIjoiM2UyMjUyNDczODFmODM0NTBkMzVlMDQ3YmU2ZWQ1YzM5MTcyMTAwNmM0NWEwOTIwMWM3M2ExZWU3MmJkMWU5MSIsInRhZyI6IiJ9','Victoria Malone',NULL,NULL,'eyJpdiI6ImlidHdkZFZlVlhGd3hHQ3FKc29sSlE9PSIsInZhbHVlIjoidUJpSFFLdW42ZHBhd2tvQkJQQ3hhNGQzZnF4RnhseDFlMEZRck5QdG9adz0iLCJtYWMiOiJkNjM4ZDY2YzM0OTljNWMxZWFkODNmMzNmYTU5NDQzZTQxNmE0YzI0MjZhYWU2YTcwOWYyMDM2YTM3YzliMWJhIiwidGFnIjoiIn0=','Enim autem dolore ne','dacum@mailinator.com','Sint ipsum qui magn','Consequat Inventore','Laborum Quisquam do','In quis excepteur ni','22681',NULL,38.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(76,31,NULL,'eyJpdiI6InI0VHViN1QxVkNWdmdsOW5yWFVldWc9PSIsInZhbHVlIjoiKzFOaGtxU0pmUS9HNFc2M29CU3c2dz09IiwibWFjIjoiNjQ2YmRjNTY4ZWUzNmUxMzA4MjE1NzliOTc2NTg3ZjIyNGNjYjkyMTIzNzFkZDllZDRlYjg0MTc1ZDdhNTNkMyIsInRhZyI6IiJ9','Tallulah Atkinson',NULL,NULL,'eyJpdiI6Ild3Q0JMRVlrQ1hVVi91UjRjSUUvS2c9PSIsInZhbHVlIjoiVG4ra1U4dDZhcUZ0OGY3aUxMbkFMckh1OHloc2x3VHRjMkhrMjFySDM0Yz0iLCJtYWMiOiI2MGQ2NWJmZDlmNmE3YjQ0ZTRjYjNmODA5NDI2NGQ3ZWE1NjgwNzQ1MzUyYjU2MDEzZGQ5MzQ0NTBiMWNlMDlkIiwidGFnIjoiIn0=','Officiis error incid','xisaciji@mailinator.com','Ex aspernatur et vol','Iusto provident und','Tempor sunt deserunt','Accusantium eveniet','93625',NULL,80.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(77,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(78,31,'AMEX','eyJpdiI6IkdDRGtVM3NQd2ZQOFV1amxTMVVVT2c9PSIsInZhbHVlIjoiUDFiQXhBZHM0c3NvVWtDL3BQLzhGZz09IiwibWFjIjoiNDQ2YTQzMDczMGNjMjAxODBjMTcxMTlmNGI5YTFlOTJiZWM5Zjc1ODE1ZTIzMTJlMTcwNzc2Nzg3MmM4NzQyNyIsInRhZyI6IiJ9','Gisela Small','09','2034','eyJpdiI6IlpuYStvazdNK1pzZVpaTUlQNlRQcEE9PSIsInZhbHVlIjoicnhWWU5hYndDMGtkMlVMZUZsQXlpT1VWYzhkRHowVW5jaUZmeng2eFJKVT0iLCJtYWMiOiIyNDgyOGIxMTExZWJhNmQ5OWZkNDY5MTBmZjlmYWFmZjA2ODY4NGQ3MGNhNjgzYTAzM2ZiMzA1YjgyNTc0Nzk5IiwidGFnIjoiIn0=','At voluptas pariatur','punanoboxe@mailinator.com','Quis esse rerum minu','Sit eos dolore volu','Croatia',NULL,'94735','USD',41.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(79,31,NULL,'eyJpdiI6IktlV0hRMTdqSmQ4WGVLQ1ovYmg4MUE9PSIsInZhbHVlIjoiSi9KSVNReFlmS3BQVXNxYkVkTlZHdz09IiwibWFjIjoiNzg3ZGViY2U0NmRiNTVhZjFlNjg3MDExZTE2NGNiOTg5YzA1MjI1OTY3ZjljOWFmZjU4MTAwOTQxODk3Yjk3NyIsInRhZyI6IiJ9','Wallace Long',NULL,NULL,'eyJpdiI6IlFsYkdqN29aSk5oeWJ5bUdCQ3pwV1E9PSIsInZhbHVlIjoieU5iZWxLb0xaMlRmdFdzQXM4Qk1UOVRzMFhLSXgzdWJUWG1Gb3R4eEw5Zz0iLCJtYWMiOiJkYTEyZWNjZWY4YWIxNjM4OTJjOTk2NWI1OWQzMzVmMjQ1YzYxNTY0ODI1ODRjNGQ4NDZjNTE0NzY0ZmU2NjAwIiwidGFnIjoiIn0=','Accusantium ullamco','syxopanac@mailinator.com','Blanditiis laborum n','Nulla eos quos conse','Cupidatat laboris mo','Cillum reiciendis oc','21192',NULL,67.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(80,31,NULL,'eyJpdiI6Imd0QldOempZMDJHVlU5Mkg4ZHFNYXc9PSIsInZhbHVlIjoic2NzNi9IMTgyRlN1NDlvWDg3ZHdGdz09IiwibWFjIjoiNTM0MzQyODVlZmRhMjE4YWNhMWMzNzdkNjM0Y2JhYWUzYTg5ZmFmYTdlZmI5MmYwYjc5YzIzYWU0ZDU3M2IyNSIsInRhZyI6IiJ9','Florence Benton',NULL,NULL,'eyJpdiI6ImRKL0gxTjBNTjJyR2RnaVp1a3lxTVE9PSIsInZhbHVlIjoiY3JqSnFJMUdoclA3czVGejlIQUI2NjF6YzFXU3lmM0V2TXdEV2tHVWVWdz0iLCJtYWMiOiJmNTIyYmUzYjM0OWE2NWE2MTBlNmZlMzVmYmU4NDMwOGZkZThiNzZmYTlhM2RhMWE5Y2YxZDgzZGVlMDFkZTdjIiwidGFnIjoiIn0=','Sit tempore autem q','hojid@mailinator.com','Excepturi irure eos','Irure commodi soluta','Tempor consequuntur','Asperiores libero es','40457',NULL,58.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(81,31,NULL,'eyJpdiI6InFKZmUydDVaOWNlYXVubEZqRGF6SkE9PSIsInZhbHVlIjoiZGFkbG1GTWFGMm5xQXdtRzNReG4wQT09IiwibWFjIjoiM2U2ODIzOTFhYTMyMTBhODU2N2UxZjRkZDYxYzBiNDA1OGRkYzU1NjkxOTE1ZTc2ODBiNjVkNTBlOGRmZThiYyIsInRhZyI6IiJ9','Len Talley',NULL,NULL,'eyJpdiI6ImdIbjJaTExCUWlFb056RkNwUE13cEE9PSIsInZhbHVlIjoiWWppalhYRmhod1NpbXlETXREckE4aHozaG5JWmVqdDdQSTh6THdETUZHST0iLCJtYWMiOiIxMTYzMDQ3ODc4ZjE0MGM2YWE1ZmZkNWFiYWEzZmY3NGE3OTg0ZjEwMjkyZmMyMjQ5ZWE5ZTRmYmE0NGYxMTRlIiwidGFnIjoiIn0=','Ea fugiat tempor sun','zeju@mailinator.com','Vitae culpa eum aut','Nisi ipsum quam fug','Aut lorem ducimus a','Modi reprehenderit','27201',NULL,35.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(82,31,NULL,'eyJpdiI6IktxbHgrMjRROE9zcngxblAwMXliSnc9PSIsInZhbHVlIjoiQ1RjWUpRL3hUWkkxa3FOUy9jQm9jQT09IiwibWFjIjoiNzZlNGI1NzYzNTkxMTAwOGMyYmRhZmY4ODhiNzMzMmZlMTY4YWZlNWVjMDQxNDU2YzM5MzVmZGZiOTI3MmIyNiIsInRhZyI6IiJ9','Kai Higgins',NULL,NULL,'eyJpdiI6InJ2b29OWXYzQnc1NFJsdkU1QWNSTVE9PSIsInZhbHVlIjoibFViS2hCQWdnVXgzdXlsMW5SSm1XR2szNWV0SmRPTlVrNVRZQVcrUG45TT0iLCJtYWMiOiI1NjRjM2ViNmFlNDEyODQyYTdmMzM3MzViMDlkMWI0ODU4NGJkOGVjZGQ1NTUyZTQ1NTI3MTZiMGRhMjM5YWM0IiwidGFnIjoiIn0=','Culpa quos exercitat','bupatijy@mailinator.com','Quibusdam numquam am','Sit temporibus moll','Ut delectus et proi','Explicabo Nisi volu','15450',NULL,88.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(83,31,NULL,'eyJpdiI6InI5ZkVTM2RvUFVSYzR4T0p3cGdqSVE9PSIsInZhbHVlIjoiSzZpeExRUzFmOFFIVHR5V2pIV0hsQT09IiwibWFjIjoiZWM1ZDQ2MTNhNmVlNDllNmE3OWJhZDE1YjRjZWRiNDJmMTNlOWVjNWNkMmNiYTk4M2MwYjc5NGI5MWRmNDk2YSIsInRhZyI6IiJ9','Wyoming Mcpherson',NULL,NULL,'eyJpdiI6InlqSUtwdkljKytEaGhxdEZ3ODhmV2c9PSIsInZhbHVlIjoiZ2hwUUxTb2YrZDd0dmJHeTg3OE10djJQdnNUbEhwdGw3a3BvZlV5SU1Wdz0iLCJtYWMiOiI2OWQ1MWFlNzQyNDNhMTM0MzIxNGNkYjEzY2YyNTdlYzA1ZWQzMjY1ZDVhODQ2YmIwMjczZjZjOWQzMzRmNzBjIiwidGFnIjoiIn0=','Perspiciatis autem','jitiwon@mailinator.com','Atque iusto et eveni','At quaerat necessita','Quia aut quia debiti','Vitae consequatur A','28710',NULL,29.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(84,31,NULL,'eyJpdiI6InpSd3VWcXRPZ2VMcUxtZnJKNU5HL0E9PSIsInZhbHVlIjoiK0g2dUJJTzFkRmVuaGVEL3NoRUxkdz09IiwibWFjIjoiYzM0NDY5YTA4ZmFkZTIzN2FlOTQ1NDA1YjY5ZjlkYzg3ODgxNTZhMDQ5ZDZmODE0NWVkZjhlNmViNTE4ZGExZSIsInRhZyI6IiJ9','Donovan Estrada',NULL,NULL,'eyJpdiI6InJjNnNUd29lT2prY1ZWNG9qSG53UEE9PSIsInZhbHVlIjoiYlI1OXphWnMwWFpVdTNBYmZwUmtuT1ZYMzh2a0h1S3JkQTdJRkh5c0t1cz0iLCJtYWMiOiI3ZDllMGU0MzBjY2ZkMzI3ZGI1MmFiZTUzMGVkYTNlMmE4NTg5YjZhNGFmMzhjMTViZGJkNzE2NTNkNjRiNWMxIiwidGFnIjoiIn0=','Possimus possimus','fypuzuno@mailinator.com','Ut expedita nulla ni','Beatae aliquam et ma','At est labore magna','Blanditiis aut ut am','18251',NULL,48.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(85,31,NULL,'eyJpdiI6IjM0NlFCb3FFWDdCSi8xTnpNcmYwSFE9PSIsInZhbHVlIjoiUnJsZzhMQkhlbHpmTVZFRFdNdTNJQT09IiwibWFjIjoiNjNlM2U0YTIyZTEwYjZmNzg5N2ViMWM1YzRlMjRhOWUwZmE3NWY0ZTAzZWFiN2NmYWFkZDkyZjFhNmVhMmFhMSIsInRhZyI6IiJ9','Victoria Malone',NULL,NULL,'eyJpdiI6IjE2OWwwQ2dIbXVHMUhkTjNReEt3UXc9PSIsInZhbHVlIjoiNkdIWHF5UVpWMkFvUTFoQzdoc2pWTmNxbEZYeWZXQjk4QUVqWm51ZEpVUT0iLCJtYWMiOiI4YTA0YjAwMTkyNDdkZWNkMTMwNzc2MDdiNTdmYmMyMzE4ZDhlYThmNmMxYmNkMGRhY2FjNGFmMTY4ZDJjMGI0IiwidGFnIjoiIn0=','Enim autem dolore ne','dacum@mailinator.com','Sint ipsum qui magn','Consequat Inventore','Laborum Quisquam do','In quis excepteur ni','22681',NULL,38.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(86,31,NULL,'eyJpdiI6Ii9GemEwVGtlMU9aVXg4NVJDbUs3QlE9PSIsInZhbHVlIjoiVWVheW80aHlGaUVaNHRqUXVFTDhXQT09IiwibWFjIjoiMzUyMGUwZjllODM2YzRjODFiMjM3ZGM0NDY1NTAwMGI5N2Y0NWFjNDU2MjRjMTE1YjliYjFjMTcxZGUxN2EzMCIsInRhZyI6IiJ9','Tallulah Atkinson',NULL,NULL,'eyJpdiI6Ik10YUFWSWp5ZDhRVUFFaHp2QW1mOVE9PSIsInZhbHVlIjoiT1kwRlpWOTg1bkNSR2l1TDJRcm9EUkVwTFczbzF1Tk5kdVlXcDQ5c0w1cz0iLCJtYWMiOiJmODlkN2M0NDIwNmNjNDMyNjI2MTk3N2I1MDk0NmRlMGZjZWNmMzgyYWNkZGJiYWM2MzEzYWMwMDE1ZTViNjFiIiwidGFnIjoiIn0=','Officiis error incid','xisaciji@mailinator.com','Ex aspernatur et vol','Iusto provident und','Tempor sunt deserunt','Accusantium eveniet','93625',NULL,80.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(87,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(88,32,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-23 00:12:41','2025-06-22 20:12:41',NULL),(89,32,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-23 00:12:41','2025-06-22 20:12:41',NULL),(90,33,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-23 16:37:07','2025-06-23 22:07:07',NULL),(91,33,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-23 16:37:07','2025-06-23 22:07:07',NULL),(92,34,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-27 18:22:15','2025-06-27 23:52:15',NULL),(93,34,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-27 18:22:15','2025-06-27 23:52:15',NULL),(94,35,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 13:53:36','2025-06-28 19:23:36',NULL),(95,35,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 13:53:36','2025-06-28 19:23:36',NULL),(96,36,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 13:56:53','2025-06-28 19:26:53',NULL),(97,36,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 13:56:53','2025-06-28 19:26:53',NULL),(98,37,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 14:44:35','2025-06-28 20:14:35',NULL),(99,37,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 14:44:35','2025-06-28 20:14:35',NULL),(100,38,'Mastercard','eyJpdiI6IjQxVWJRMFVOWkNOMGtzeUZGanZLbmc9PSIsInZhbHVlIjoiczhjMmRVWmxRWjZMMThqRThsbUVUdz09IiwibWFjIjoiMzkyNTNkNGQ4ZWM0MGY1ZjczNjAxMzI4ZjdiYWFmZDgwYTIyNzM2NTQ2NTEzZjcxMjRkOTMxYTZiOGNiOTVmOCIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6IkxNbjBPZ3poWXp2c3VFZmNkY3cxYXc9PSIsInZhbHVlIjoicklVM0xzMVp6TTJOSEtaT1hvbnRRZGh3T1htclc5cUNsa2Y1d01RUlNSMD0iLCJtYWMiOiI0ZDhmNGU1YjA4ZDlkMjViZWRjMmE4MzlkNDQ5NGI0MjFlYmFkOTc2NjUzN2Q5ZGUwYzJlNjczOWVhODQ4NGZjIiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:44:44','2025-06-28 20:14:44',NULL),(101,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:44:44','2025-06-28 20:14:44',NULL),(102,38,'Mastercard','eyJpdiI6IncwcGlnMERPQmlUU2ZBOEdBK29tU2c9PSIsInZhbHVlIjoiUzdvYUl0RnlERzNVaGdrN0RDQ2RKUT09IiwibWFjIjoiNWMzNDk3NTg0MzEzNzE1YjFjMWYwZDBlZmQ1MDdkZTUxMmQ2NjJiMzAxNzBiNzA5NDFhZTM3NDQ2NjQyNTc1MCIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6IlRRMldVaGVaSEd4MXY5V2l5bDArWHc9PSIsInZhbHVlIjoiWmQ1aC9hTkExZU1aUEVoOUJXaGhrQmQ1aHpsdVUwa2dxcUU5dEc5TmZKRT0iLCJtYWMiOiI3YzdjYTBlZThiZDJmZTc3Y2E4NDBhYWI3MzM5ODVlZmNmNDc2ZmYyN2MxMTBmNDFjNjhiZWVkOWUxZWQ2OWI0IiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:44:44','2025-06-28 20:14:44',NULL),(103,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:44:44','2025-06-28 20:14:44',NULL),(104,40,'Mastercard','eyJpdiI6Ik0rdmRGckgwSGJPU0hTK1djZFdlSHc9PSIsInZhbHVlIjoiUDVNazB0RXdNbHpTNGR5dzA3YXJvUT09IiwibWFjIjoiYWMxNDdiNmM2MzIxOTQ3NDBjMGQ5YmNmZmE5YmE3YTJkMDc4ZjZiNGM0YjBkNjQ2NjRhZmM5YTMyNjBhM2I0MCIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6InI5em9ZNE81dkFPOEZVaFhKRU5SakE9PSIsInZhbHVlIjoid0ZKd3Rlc1hSSktTMVNwNmhrZHdERkYwV1FJVjlRRXhUblZjUVR3RC9uRT0iLCJtYWMiOiIzYzRiMDE0NWI5NGFhYThmODhiN2NmMzUyYTBhN2Y1ZjJjNjZjMDc1MmMwMzZlN2Q0MDRhYTU2MzJkNWFjNjlhIiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(105,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(106,40,'Mastercard','eyJpdiI6IlRLUWY4UGhvcUV6OW0wOE5XTUFIUXc9PSIsInZhbHVlIjoiWHdKQUlmNTl2R0kwWmE0ZnlMNXhLUT09IiwibWFjIjoiZjkwY2U3MmIyY2Q3YWVmMGVkNGJlMzg3ZGY5M2Y2OGI0ZmNkNDRhYWVmNzliZThkNGI3MzgwYzM3NjUzZDU2MyIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6Ikp0T3pCc051SlRqU2NJcDVpY01zdXc9PSIsInZhbHVlIjoic3FVVS9oY2Q1TUN4RlJEQWZiR1RKTWV3Z3A5b3k3Rm45S0N3UzBUNWZ2OD0iLCJtYWMiOiIxODRjNzc3MzJhMzdiNGQ5NGIxZjBkZGRlNWUxODVkMjUwMTUzNzU0ODBkMDRkNzViOTdiZTE1MDI3YjY3NDgyIiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(107,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(108,45,'Mastercard','eyJpdiI6InM5amdBUWt4WGVGVFBRR3VvUUxFalE9PSIsInZhbHVlIjoiZGdrQ0N2aElCQ1VRODVOek9FUzZUUT09IiwibWFjIjoiMzRhMjY5MzJjYzM2ZWYyYzQ2NTkyMDIyYzIyNGUxZWEwYThjYzM1OGU2NGFkZjk3NWE1ZDVjNjA4YWM0NGQ4YyIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6IkhyU1dKajNQbU5qaElRRjJhV01uRHc9PSIsInZhbHVlIjoianR2TXhkZFBkRXp6Z2d5Ny9DQ1hMRXljL0Z3V2d3cDE2UDRXaDMvMUhxOD0iLCJtYWMiOiJiZTcxMzNlNjI1OTkyNWJiMDhlM2FjZjIwNDZmMzgwZWE3YThlNGQ0MzIwODQ2ZTg0ODg3M2U5MWI4Mzc5YWIyIiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(109,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(110,45,'Mastercard','eyJpdiI6IjE3Q2xva25BOStKL2xodEdKSzJxcEE9PSIsInZhbHVlIjoiMVNWMk9PaG0wVzZhMDB1MEhvbG0rdz09IiwibWFjIjoiODFkNDkwN2Y3OTM4ZmJhZmZhMjZiNWE4NWU5NGVkMTc5ZDk1ZThmNGFmYTgwZWNmNjQ1Y2YzNTAzNmUxOTJkZSIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6IjlzamNhNndBaTJoeXhJSktTdlJ1RkE9PSIsInZhbHVlIjoiMHJTWjRaZ2ttWEh6RUFLRzJ0dWhYY2lrTXcrR2JvTDlMeHE0VTh5Mm9RST0iLCJtYWMiOiIyODJkYWUwMWEzNzFmODU3YmIzMjBlYzJhMzczMmRjYTM2MjVmOWE3N2Y0NDRkMWVjMWU5Zjk0NTMxYmUyMzUwIiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(111,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(116,48,'Mastercard','eyJpdiI6Im5LRzVRN2Fzd3p3a2ZmWFZaVUc2VkE9PSIsInZhbHVlIjoiTUZNYnNNYllyVzlnenhxMnpYUmVodz09IiwibWFjIjoiZDhiMzgwMzBkNDg3YjY4NzMzMDBjYTBkMzQ4N2ViOTI0Y2E2MWRlZTQ1NWNkM2FiY2E2YTAyMGUxMzg5Y2FmYyIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6IlRuREF4TGFoQTFoNitZbU42UHp4MGc9PSIsInZhbHVlIjoiYWpmdElSSmhFVS9pRnhqZGhyK0xiNDI4UlpmcVM4RmJ4MEUxdVk2SjVHMD0iLCJtYWMiOiIyOWYxZjQxMGM4YzQ2ZDBmZDY1MTRjMjYyNGM5MjAwMDlkNjY2ZGUwYTQ3MTM2MDA5ZmZlM2I3NTNjYWFmZjVkIiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(117,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(118,48,'Mastercard','eyJpdiI6ImFTMklqOUxBaXFmQ1lsNWs0c3VNdVE9PSIsInZhbHVlIjoiZW9QUVVEUW1sbTJYeTBlK21Mb3h2dz09IiwibWFjIjoiYTgxMTI5ZTQyMWQ0YWNlYTI0OGVjYTljNWUxYzI1YzJkNTRjODc1ZDI5OGUyYzEzYTllYWNlNjk2N2ZjM2Q4OSIsInRhZyI6IiJ9','Ignatius Brown','04','2027','eyJpdiI6InZacGNKRGxFM1FMR0hySXZ4M0pTdkE9PSIsInZhbHVlIjoiNmVvWURldkZzYlpGaDFBSlpIdUNMa3h1SmdTYS85TitIU0ZTV1F6dGJUZz0iLCJtYWMiOiJmZDJiODg0YjVjY2U5N2RiZDZmZDVlZTczMTc3NDU1Njc3MDBmMDRiOWZjNzk1YWFlZGExODIyMTllNTNlZjU3IiwidGFnIjoiIn0=','Quia culpa porro ali','nisihuh@mailinator.com','Autem quo in nulla a','Non possimus nesciu','Andorra',NULL,'77962','USD',19.00,0,'2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(119,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(120,51,'AMEX','eyJpdiI6IjBmWTdtaHg4UlVScGhGaTY4VktWcnc9PSIsInZhbHVlIjoiL1RBTWF4aFpKdmRWSm9QKzJXeGRudz09IiwibWFjIjoiYzZhNDI0N2YyNmU5NjQ5NjAwZDExNTFjZTNkMzkzMTdlZGUwOTFlZDlhMTEwYzYzOWI4Yzg4OTYxNzI2MjU1ZiIsInRhZyI6IiJ9','Macon Norris','09','2034','eyJpdiI6Ik5VYWFkWFlSNUFKRHZ6amYrdkd4TEE9PSIsInZhbHVlIjoiU01GUks2TS8wNXB3eUlKT0hrZGM0M1pteVZMUEYvSUhxOVdKVFJVeC8wST0iLCJtYWMiOiI5OGRiYzE5OWEzYTUxNTNlMGNmODAzMzdhY2QyZmQ2YWIzY2UzYjQxYjRlZjVjMjFjZWM1ODVlMDY3ZThkM2M4IiwidGFnIjoiIn0=','Aliquid consequatur','jifytyte@mailinator.com','Cupidatat sunt magna','Esse accusantium cu','Bolivia, Plurinational State of',NULL,'56849','USD',59.00,0,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(121,51,NULL,'eyJpdiI6Ikt4dG5MYWwzLzJab2hOQ09rUUozS0E9PSIsInZhbHVlIjoiaU9PU09qeHJQT1RlWE1haHhqM0g3UT09IiwibWFjIjoiMzY0YTk3MjhlODRkZjcxOTM2OTNjNDk0MmRjNTQ2YThlZjRlNzgxYzY3NWRlZmI3ZGRkOWM5MTU3ZGIyMTMxZCIsInRhZyI6IiJ9','Jocelyn Pennington',NULL,NULL,'eyJpdiI6Ik5uRnJVZUkrOGNsNnpwZCt3ZmZYcnc9PSIsInZhbHVlIjoia0VDSnh4b3pBOUx1dlAzdXRrVTAvV0Q4T1Q2U1UvYnpDZ0Y3Z2U0a3BIQT0iLCJtYWMiOiJlMDJlYzVlYmZmOWE1MTVjMjFiMWY2MmY2YTcwNTk2MmQwNjhjM2EwMmFhYjYzZTI2ZDM1MzM5MTMzZjBiOThmIiwidGFnIjoiIn0=','Vitae quos tenetur e','xyferufyza@mailinator.com','Et non quaerat possi','Ut reprehenderit qu','Consequatur Dolore','Natus ad suscipit do','41662',NULL,68.00,0,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(122,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(123,51,'AMEX','eyJpdiI6Im9FQ29vK01DTk5zSllCMXozd2dUTEE9PSIsInZhbHVlIjoiNXpyZXRaOWN0TmJacXJ1RG9wQUU3UT09IiwibWFjIjoiN2VlODdlMDAxZDNkMzQ5MmViOTI1NTJjMmJlNjYyZDU1MjYzMmM0ZjBhYmQzMzgwNjc3NWEzMDExNGM1Zjg0YiIsInRhZyI6IiJ9','Macon Norris','09','2034','eyJpdiI6InBvSFR5M0Zuc1hybTVXOU5TQVlzOUE9PSIsInZhbHVlIjoiN25vckkzQ1ppTHFLYkhGdlFVankvL1cxdllMWXU2STBTMklvSjJINC94MD0iLCJtYWMiOiIwN2I3ZjYxMjcxZWM3MDU1MzQzNmY4ZDcwMjlkMTcwMGM1YTdkNGEzYTUzNjhmNDhkYzEyYmJmMjhlOGU1NWZlIiwidGFnIjoiIn0=','Aliquid consequatur','jifytyte@mailinator.com','Cupidatat sunt magna','Esse accusantium cu','Bolivia, Plurinational State of',NULL,'56849','USD',59.00,0,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(124,51,NULL,'eyJpdiI6Im5UVFhaYlZZNlNUck5SMFRxNVBQTWc9PSIsInZhbHVlIjoiVytFYkVlYmtKVlJJRmViQjlWYzNQdz09IiwibWFjIjoiMTdhZGRhOGIyNTY0ZTllOTFjNWZiZmIyZjMyOTNjODkyOTlkNzU3OGM5YWEzNGVkODI5YmIwNTFmMGExNDY5NCIsInRhZyI6IiJ9','Jocelyn Pennington',NULL,NULL,'eyJpdiI6Ii8yakkveU5DWEVKRmZWSVpLeUs4Nnc9PSIsInZhbHVlIjoicW1pY1RqamJxbW8vdndOTm5xNC8wZDZ0OVVTSnhsVy9BeU42Z3pKQnorVT0iLCJtYWMiOiIxODhhZTk2YjE0ZjU2YmM3OGEwYjE4NmE5NjU4YjU1ODEzY2VlYTNkNTlhZTA2ZmVlZDg4Y2EyYjk4Mjg2NjkxIiwidGFnIjoiIn0=','Vitae quos tenetur e','xyferufyza@mailinator.com','Et non quaerat possi','Ut reprehenderit qu','Consequatur Dolore','Natus ad suscipit do','41662',NULL,68.00,0,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(125,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(126,53,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 15:00:33','2025-06-28 20:30:33',NULL),(127,53,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-28 15:00:33','2025-06-28 20:30:33',NULL),(128,54,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,'Azerbaijan',NULL,NULL,'USD',0.00,0,'2025-06-28 15:19:27','2025-06-28 20:49:27',NULL),(129,54,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,'Azerbaijan',NULL,NULL,'USD',0.00,0,'2025-06-28 15:19:27','2025-06-28 20:49:27',NULL),(130,61,'AMEX','eyJpdiI6Ii9IbFdvZTYvMHNnZTlON0RxV1dBRXc9PSIsInZhbHVlIjoicldwNEp2eWQ4NnhEVThXeFdCYWR2Zz09IiwibWFjIjoiMDRhYjc0MDRlMTFkN2JkYmI5Y2EzOTEyMDQwZGRhZDQ0YTRkZGI4YjlkYTg2MmYzZmE3NzUyODFlNzQ2NTFhNyIsInRhZyI6IiJ9','Barrett Spence','01','2026','eyJpdiI6IlhBK0VSMGpRZUJ4eE0weGJ2UEVSYVE9PSIsInZhbHVlIjoiTjJkT0FxYnROZDNIRGtQNUU2SlFLU2xicWwxdVJqRi9rb0ZDNEdnQkc4ST0iLCJtYWMiOiJkYjRmNzgzYzk3NGI3YjgxOTUyMDJhYTY5ZGE2YjUzODY4ODVhOWZhMzE4ODIxZGM2NmM1MWJkYzRlMjFiYzg5IiwidGFnIjoiIn0=','At minim enim quasi','qysoru@mailinator.com','Qui molestiae cumque','Dolor enim quia in p','Fiji',NULL,'64951','USD',55.00,0,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(131,61,'Mastercard','eyJpdiI6Ikc5SVA4aDROK1R3NWtod1lYRVYvVUE9PSIsInZhbHVlIjoiSFJoL0N6c0Y4TDlVeHQzSDFQL3laUT09IiwibWFjIjoiMGQ3ZTZhZDAxNjkyZDc1MGQzOTFmNWQ3ZTAwODJhZmNmM2M5YThjNDAwNTUyMmM2ZmMzZDcwNzM5YmY5MmYxZiIsInRhZyI6IiJ9','Clio Cortez',NULL,NULL,'eyJpdiI6ImVZOHoyVkFRdmx3dll1YUhZSTVkd2c9PSIsInZhbHVlIjoibm1IclRmOHpuVkFVa3RlVUIvZlFhQTV3ZnNEayt0ZEJleGFoK2JPeXBuaz0iLCJtYWMiOiJkYmJlMDNiOWQ5YWQ5Zjc4NjE5YmEzNjhjOGFlODNkOTBkMDliOWEyZWIzMzQ5MGRjYjQyNDU3YmNhZTVhODQ2IiwidGFnIjoiIn0=','Veritatis libero odi','tysazori@mailinator.com','Ex placeat accusamu','Accusantium sit dese','Eveniet anim vel vo','Aut sit earum magna','74252',NULL,77.00,0,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(132,61,'DISCOVER','eyJpdiI6IitOQ1N3MWdTRTFVK2RLbmVub09uTlE9PSIsInZhbHVlIjoiUzEzZy92TUlCanVQWXI1RHpaUTRYUT09IiwibWFjIjoiNDg1OGQwMDQxMDgyNTEyMjllMjkzNmRhNDQxM2EzMjNhZDA2MzNhYjNmYzBiNGMxOTI0NDQ4OTVlYjdmZTllYSIsInRhZyI6IiJ9','Clio Cortez','09','2031','eyJpdiI6InZ2bFFRdkJUMzZOWDZwZGQ2NEg5L1E9PSIsInZhbHVlIjoiaDNSYTNiRkJBTGJsaHZnU2NucUFwZz09IiwibWFjIjoiOWIyN2YyMTlhZDdiZTBiZTAwYTZkODUwNzk1NzE4MzI0YTM5ZGFlNTk3N2IzMTk0MzA4YmU0MDRlNGRiNjlhNSIsInRhZyI6IiJ9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MXN',56.00,0,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(133,61,'AMEX','eyJpdiI6IjkwZC8wQ0xXSkxtUG4wMXFrR2ZXTFE9PSIsInZhbHVlIjoiVkREWEdBOG1raTJmbDNFdEpsU0todz09IiwibWFjIjoiYWNiNDc3Nzg1NGZlYzFjZmIzZTc1OGQyMDhlZjlhM2Q4ZDVhYjQzODg0NzhkOTcwZWVlNjZiYjM2ODU0NmZmNiIsInRhZyI6IiJ9','Barrett Spence','01','2026','eyJpdiI6IlNwSUx6NDlMYUVqMWRmMjhTSTA2K0E9PSIsInZhbHVlIjoiYTZ5d3BoOC9HYXlqcDEwNnUreWJYWWpSNS80OFVWaWcwOVl0czNzK3ZqTT0iLCJtYWMiOiI3ZGE2ZmJhNWM2MmY0N2U4NzFlOTJlZWQyM2NmNjU4OTlmMzdhNmMxMTM5Y2I4MGE4M2M0NWQxMzI4ZGJjNDRjIiwidGFnIjoiIn0=','At minim enim quasi','qysoru@mailinator.com','Qui molestiae cumque','Dolor enim quia in p','Fiji',NULL,'64951','USD',55.00,0,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(134,61,'Mastercard','eyJpdiI6ImRtRjd1Ulh3NmFQUHQ3OGFUYXl5NUE9PSIsInZhbHVlIjoiQTZGOEtydE5qTHFrWWw5SW16d1lSQT09IiwibWFjIjoiZjA1ZjhkYzE4NTIyYmI3MjhkMTcwNGYzNWZjOWRhYmRhMTZiOWMyNjBmM2Y5ODM4Y2Y3NmYxZTQ0Njg4MGY3ZiIsInRhZyI6IiJ9','Clio Cortez',NULL,NULL,'eyJpdiI6IngvcFJ0T01sZXRqKzhsN1ZZZTZ4SVE9PSIsInZhbHVlIjoiRlpMbGVKcElydjU3eEY0ZHMxS1BzNUcxcjNuOUREVlpFcTVpcWo5NUU1MD0iLCJtYWMiOiJhOWE2ZWQ5ZDEyZjkzNTA0Yzg3MDhmYWNmYTY4NTBjN2RhMDc0NWRjZjVhZjAxMzY1ZjZiNjkzMGJlMjhmMGJmIiwidGFnIjoiIn0=','Veritatis libero odi','tysazori@mailinator.com','Ex placeat accusamu','Accusantium sit dese','Eveniet anim vel vo','Aut sit earum magna','74252',NULL,77.00,0,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(135,61,'DISCOVER','eyJpdiI6IjUwVkdjMzMwc09pMTBMQ0txT0V2YVE9PSIsInZhbHVlIjoiZEliclJmaTFkS2FGVjg0Mm5FbDVrdz09IiwibWFjIjoiMWZiOGM0ODA4NDc2ZDY3MjE0MjFiYTVjODJiOWM3MzQ4NzViZWYxNDg2MGMzMjYzZDljZjM5ZjQ1OWM1ZTM0ZiIsInRhZyI6IiJ9','Clio Cortez','09','2031','eyJpdiI6IktGNTNVaW9McUxwWE14dFQwR01VNVE9PSIsInZhbHVlIjoiaGl4NUZwREEzeFJBYjJ2V0s5V1VHUT09IiwibWFjIjoiNzQ5MGY1MDc4NzU4MmNjMTI4MTNmNjQzMzExNTIxYjA2NGZkMzAyMDA4NDExZDcwNjBmMGRmOGI4NGUxZDZjOCIsInRhZyI6IiJ9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MXN',56.00,0,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(136,70,'VISA',NULL,NULL,'01','2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'USD',0.00,0,'2025-06-29 13:48:24','2025-06-29 19:18:24',NULL),(137,75,'VISA','eyJpdiI6Ik5YNHBnZU8xSzExZTZpSG5SbkFaT1E9PSIsInZhbHVlIjoiRCt6Qmo5RlJGL0lqTnRxdjRCL3RYb3lHbDRwZ1ZlRXgxVGw5WWt3T3JyYz0iLCJtYWMiOiJkMzFmZWI2MGFmZWYyZjg3Mjg5NzVhZGUxMDkyZmI3ZDRmOTJjYmY5ZTMyNmYzMTJhMmYwZGY3NGQ5ODBjOWZkIiwidGFnIjoiIn0=','sasasa','09','2033','eyJpdiI6IjcwbXNjMjdtMDBBMWRQOTVMcVFBQkE9PSIsInZhbHVlIjoiOVVqSVIydVF6Z0hkb0xJOE95T3N6Zz09IiwibWFjIjoiMmU4ZmQ5YWVhZWU1ZTZiNTUyYTQ5M2E2ZjRiMDI3NTgxZWRlMTEzMDE5YjM3ZGZkODFmYWFmZjY1Y2UxZjdhOSIsInRhZyI6IiJ9','address',NULL,NULL,NULL,NULL,NULL,'110092','AUD',1.00,1,'2025-06-29 13:48:24','2025-07-30 23:57:11',NULL),(138,72,'AMEX','eyJpdiI6ImJvaExtalZVbXdVc2k0Z0hkMGdZZ0E9PSIsInZhbHVlIjoiL0Fod3l4aGUrVGtac0dTNSszc0JDdz09IiwibWFjIjoiMDBiYWExYTVhZjQ0MWVmYzY2MWM2MmZkMTllMjdhMzJkZmE3NzdjOWJhMWY4ZDU1MDAzZTA2NGU3NTE1MGUxNCIsInRhZyI6IiJ9','Maggie Vang','05','2034','eyJpdiI6InZwY0RJc3lmZndibG9VYnVJWFgzbkE9PSIsInZhbHVlIjoiOWxkQmRXcmU1K0R0aU91Uk1VSXo5TjFacHRhdUFrMXJoTi90L0trWklBaz0iLCJtYWMiOiIwNTRjOTk2NGNlZDJhNGI3OGE3YTBhMjY2NTVmMGU0Mjg1OGFiMWE0M2E1YWEzOTk4ZDVlMjljYzliZTg4NmI2IiwidGFnIjoiIn0=','Quia voluptatem ull','ryrib@mailinator.com','Mollit accusamus rep','Est vel nostrum in c','Brunei Darussalam',NULL,'50841','USD',39.00,0,'2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(139,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(140,72,'AMEX','eyJpdiI6IlBDMG1oeHgzTjBUM3lHSHVabzBLTHc9PSIsInZhbHVlIjoiSzFXUmdHUlNBc25UVTdKZjdjUEJ4UT09IiwibWFjIjoiZDI3YzZkZWI1OWZiY2M0ODY3NjY0OGU0YjBjZmQ3NDIzYjFhMzJkNDA0NDBmZWI4MGRkNzM0Y2FkNmUxOGU4MiIsInRhZyI6IiJ9','Maggie Vang','05','2034','eyJpdiI6InlBb3pFc3liRDZldFB2bUp6VlIvU2c9PSIsInZhbHVlIjoiQ28vWkF0bDhQS1ZMUHRNZVRjWmhwODVMQWV5YzhzVlNqcTJyQi9nMEJqST0iLCJtYWMiOiI2ZDkwYjBkYTMxYzVjYjZkMmY5NzEzZDRiMDFiZWE2NjNmMGU5MjkzZDMyODEzYWM4NjE5N2I3MWEwNjVjMjVkIiwidGFnIjoiIn0=','Quia voluptatem ull','ryrib@mailinator.com','Mollit accusamus rep','Est vel nostrum in c','Brunei Darussalam',NULL,'50841','USD',39.00,0,'2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(141,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,0,'2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(142,73,'VISA','eyJpdiI6IkN5SHJLM0J3NWFueVVGelp6UWtLMVE9PSIsInZhbHVlIjoicVNibTlmNVQyRmkzN0Uxb05RM3RXbFJZMXh2OW95dm9DV0xMQmszeGQ2Yz0iLCJtYWMiOiJmM2EwOWI4ZGU3M2ZkMmI1MDEwODEyNmMyYmQ3MjE5MWE2OTFhMjMwNTgzZGM5NTFjMWM3YzMyMDY0YmQzYWFmIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IjVBNkNIaXAyY1YzQXA5dC9udFJndnc9PSIsInZhbHVlIjoiT2dQcW1GMENtVVpibWtMSU5mNzJzZz09IiwibWFjIjoiNGE2ZTk3MTkyNGFjMzg4NzIxMTA3NDMwM2EwNjhkNzc5ZGY4YzZlMWZlOWZkZjBlNGUxYjFmMmQ0OWU5MzM1NyIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:44:46','2025-07-18 23:17:33','2025-07-18 23:17:33'),(143,73,'VISA','eyJpdiI6Im9OelhVbGtzenNPS0NwNGpWYUhwenc9PSIsInZhbHVlIjoiYlpuWWlSY1NpMFJYS0ZCRkxsWnRKbDQ4bW83Z1hxazJwUmpiNWkzQjZKdz0iLCJtYWMiOiJkNjUyY2Q5MGRhMDcxMzkzNjZlZGM2MzBjNDVjNjJiZTUyNjBlMWVkOTU5MjM2MjBhNDY2Y2I5OGY0MDQwYzcxIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IklLRUZLSElEYUthMDVEN1JETnhpY3c9PSIsInZhbHVlIjoiQWdmc0lzYlhCUnFuRU9sV2VoN0NNdz09IiwibWFjIjoiYjk1NzljMDMzNTgzNTEyNjZkMTYxZjIyMjIwZTA1MzUxOGYyNWYzMGZhMzZjNTJhNzQ3YmFjNzc1NDI0MTJlOSIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:47:33','2025-07-18 23:17:42','2025-07-18 23:17:42'),(144,73,'VISA','eyJpdiI6ImJyc2U2VGcrd3Z6VGVrSUk3V05Fanc9PSIsInZhbHVlIjoiRzNQN3JnbVZqRUFYdkdySk9qUzMrZ2duQy9VVUpuS0xtNUtaWmlqdVJXVT0iLCJtYWMiOiI1M2ZkMmIzNTgzZGRjMDUwNGRjM2U5NjVkNWEzZDhlYjgxMDgzODYwNDNkYWI1YjNkMDhlMWE3NzQ1MWFiZDFjIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IjF4RmV5QVFZeXZ0am11ZkY2TUdUc1E9PSIsInZhbHVlIjoiQUFQcE9Jd0kzbDROQjhQK20xQnhWdz09IiwibWFjIjoiM2QxNGFmYTY4YWVjZjg3NDY1ZWMxYzllNDIzMGQ2MTFkZDIwOWI5MjFjY2YwOWM5MGI5ZTI1ZjY1ZDM2ZWI0YyIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:47:42','2025-07-18 23:19:12','2025-07-18 23:19:12'),(145,73,'VISA','eyJpdiI6Im1STlNMWk9lSi9QdEh3VTdIeFBvK2c9PSIsInZhbHVlIjoiMk54UzNmMjVpTG1ieU5iejJpLzFzdWxnMTNHMjZtYUdvOHhiZ1VWMU1CMD0iLCJtYWMiOiI2ODM4MTNjOTQ4OGRkNTExNzVhYTM2YmJkYjIzY2I1MWFkZTc4MjQ5NDY4MmU1Mjk0OWVjMGZlZWRhMDBiNjY5IiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IlZlT1pYMTE3WnFMRFpZb1dNdjI3bkE9PSIsInZhbHVlIjoia0JYRGZtNm1yeGxueXVYcm15VGpZQT09IiwibWFjIjoiNTU5YWI0YmUxOTQ0NTA0MGE1MWVjOWI0NDdiYWQzNGY5YzYyZTE1ZmY2ODNjZTY2ZmMzYzkxZWQwNDNmNWJhZSIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:49:12','2025-07-18 23:19:32','2025-07-18 23:19:32'),(146,73,'VISA','eyJpdiI6Ikppcm5aSERVbVppeHg5eWkza3djZnc9PSIsInZhbHVlIjoicndsc2hmVGs3MjZvbjRvNmV4ZHU4NlVHOHNUL3dxWWY5Vy8yTXdsb2FMOD0iLCJtYWMiOiJiN2U3YjMwYjI3YjA2ZDg5NWYyMjc2ZGYyOWI3MWMxNzQxN2RmNTU4ZGJiZDk1OGE0NTRkOGIxYmE5YWQ0ZWQ1IiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IjZXSWkyVFNib1JMNWFtdzhyaUtSNGc9PSIsInZhbHVlIjoidlBGRGpCbUhWWjdCZDc0TUN3cFRMQT09IiwibWFjIjoiZTBjZjg1YzYwOTM5YjNjYmI4NmZmYjRiYzVlMjM5NDc3ZTlmMWE2OWFjZDQyMTM5ODU1NjAwMGFhYTFmYzhhNSIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:49:32','2025-07-18 23:21:00','2025-07-18 23:21:00'),(147,73,'VISA','eyJpdiI6IkxpRjFyREx3UkVST1p4VytNS1hjd2c9PSIsInZhbHVlIjoibVE4a09ZQ1RiZXFydmJhb0NDbW9jSGNyMlozK2QzblBQSDk0VXVKMHZVZz0iLCJtYWMiOiI0MjViMGVjZjIwN2JmZjhmYjI5YzE1NDA1ODNlNDhlYzk3YzZkYTIyZjk3ZTc4MjUyNzVjMDNmNDRmN2Y4ZDY3IiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IitEN1YwbTV1UVJ0bVJoU08zWXM4SXc9PSIsInZhbHVlIjoiclhCdHRjekd4MlhuS01rSnd0alJUUT09IiwibWFjIjoiYzE1OGI1NGZjNTM4YmU0NTY5ZGNjOTE0YTk2OTE2MjljOTJiZDIxMmM3NDI2NDY2ZDdkNGQ4Y2M5NzhhNTY4NyIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:51:00','2025-07-18 23:25:04','2025-07-18 23:25:04'),(148,73,'VISA','eyJpdiI6Ik9tZ282d3Z0c1hLRVpyTjdQaHdvSnc9PSIsInZhbHVlIjoicTFrcWFBbkhyMTVPTjJvYWxoRTVvZWx5L2RvUHMvbVJGSkdyZ2prcVROTT0iLCJtYWMiOiIxYmYwNmFhM2QzN2JlZjIxYzA5YzYxNzFjMzBhYjQ1ZTIxODU3NzFhNzRmMzFhZGZmMzY5YzZjZWM2MzBlZmYwIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6Ijl2NjBRNWphbzdLWlkvMDhBd2V1U3c9PSIsInZhbHVlIjoiWGNkdkFwT2xld2VKSXlXaEd0UFlDZz09IiwibWFjIjoiNGEzNTdkMzI1ODU2ZjdjZTgxZGU0ZTVjMjM5YjQ3ZWNiZjFmNWZhNmEwMWVhMTg2Yzg1MjQ0YmZiYjk0NzEwNiIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:55:04','2025-07-18 23:28:02','2025-07-18 23:28:02'),(149,73,'VISA','eyJpdiI6InR4UFovNG5uTkc5dXlES0F1VkVobnc9PSIsInZhbHVlIjoiUkQwSzhEWlZuU0hmRVRaeG9kVUNKcmp2c0J6clNJNWwxbm54TE1nNmFCUT0iLCJtYWMiOiI2MTM2NzVkMzkwMTMxZWVmOWYwYzJjYTgzNDRjMDZhMzE5ZWZkMDhmMzdkMzI1Mzg1NTI3YzRmMDUzZDkyY2VhIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IkhMMjlZb2pZd0xHb1ZJNkx5Ymh5dkE9PSIsInZhbHVlIjoiazhHZmxkZEtYbUs2WHUzeWlQYWRsdz09IiwibWFjIjoiMTdjYWYwMDY4OTJkMTMyNDIyZTI2YjU1Nzc4OTk1Y2YyMDNkNjVjZWY4OTJjZTY2NDEyOTVmYjUxZjA5YWFkOSIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 17:58:02','2025-07-18 23:30:50','2025-07-18 23:30:50'),(150,73,'VISA','eyJpdiI6Ik41YkNEUkg1VHdObWlQcC9RVExzREE9PSIsInZhbHVlIjoiSEtCRXRoL1BFSjZCSkUzV0pCSGxoM2wvVklJV05FWHVHcHRnaWtoNzZrVT0iLCJtYWMiOiI2MjQyNGI3MjhmM2VmNDFlOTk4ODUwY2IxYjEzOTM4ZmQ0ZmM4ZWFhZmExZmNjZDIzYzQ0OWU2NDdlZjNjM2Y5IiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IkZPcWk4UG84UURvcFNPTmlzNCtTT0E9PSIsInZhbHVlIjoiam1ZS0xET3hoTTJWSStJQTdHcG5kZz09IiwibWFjIjoiMWZkZjZlMTAwMDUwMmFhYzFjZWMxNDIyYTZlNDdkNTk2ZDdkOGUwMDIyMDIzODJkNzIzYjY2YzYwMGMyOWVmYyIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:00:50','2025-07-18 23:36:32','2025-07-18 23:36:32'),(151,73,'VISA','eyJpdiI6IkJzK3RGWWR1enFTeGdUODMxbm41QXc9PSIsInZhbHVlIjoia1VyTjVzWW5mTTlmVVNMaXR2R1J6bUhaN3Y3d3M2amN2cm9adFkrR3Zlbz0iLCJtYWMiOiJhOWQxYzQ1MTlhOWQ1NTk5ODFlNWIwNjE5MTlhY2NmN2Y1OGIzNTEwZWZiZDUyOTE0ZWVkYjNjZDU0ZDMyZjBlIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IkxJR3JSMldVUmVXQmdsdTJyKy9ROHc9PSIsInZhbHVlIjoidE5vbytnbk9JWXdkQlFEMW5QRHNPQT09IiwibWFjIjoiODhhNDA3YTY4ZmNiYzRjYWRkYWQ1Mjk2ZWYxNDRjYmE3MjExNzA5MzlmMDg0YWE3M2E4ODFlMzdhZjQxYjljMCIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:06:32','2025-07-18 23:37:12','2025-07-18 23:37:12'),(152,73,'VISA','eyJpdiI6IjcwdWJJNzFCTWZlaFBZWkZGaEdLb0E9PSIsInZhbHVlIjoiMWhrMWVwclJKeE9yMzVnNGszRWRBdnJnYTBwZ2ZRU0ltcXhVSzVqdTNydz0iLCJtYWMiOiI3NTU1MzFiNDg3YzhkOTA5ZDMwY2ExYTIwZGFhOTRiYTViYzA1YjFhMjAwMWUzNzIyMjZiZDVmOTM3ZjQ1NDlkIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6ImZQTGFGRHN5Z0JTYjBlWnRqa1ZQaXc9PSIsInZhbHVlIjoiUEt5bks0SU1BQ2dyVW9ZRHFHREpTQT09IiwibWFjIjoiZGIxOTJlNTI3YTVjNWFjY2ZlMTljMGZhM2JhMGQ2MzQ0YzE5NDUwMDQxMWY3YmExYjA0MzllMjdmMDIyOWFmZCIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:07:12','2025-07-18 23:38:33','2025-07-18 23:38:33'),(153,73,'VISA','eyJpdiI6InltU3RtNjM4THFOaDN2WGtCVUhzTUE9PSIsInZhbHVlIjoiS0kvSTE3UENqTlhQR2l0SGNvd0p5bE9icW5YbjhTamJOL0NJUW9aMnlMcz0iLCJtYWMiOiJiY2U3NWFhNWQzYTM4Nzc4YjVmM2M0NzgzOWJjMTk4YmU0OGM4MzFhZTE5MDFkOGU5ZDY2MGJmN2IyNWQ3YTE0IiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6IjB4cmx0NGNKNHU2ajF3WnZJK0VwdVE9PSIsInZhbHVlIjoiU0hyYzgxNDExZTloellUSzF4Z1IrQT09IiwibWFjIjoiZmQwMTBiNzU5NDc5YWU3N2JjMzkyMThlM2E0YTU4MjQ1NTA0YWE0Zjg0MmVhYWM5OTJhYjI2OGQ2ODU5OGZmOCIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:08:33','2025-07-18 23:39:03','2025-07-18 23:39:03'),(154,73,'VISA','eyJpdiI6ImFYL1huL1RxeGQrTkR6WUNndmNnbmc9PSIsInZhbHVlIjoiZU9TWHRUQ3NGT2t2NlZCUjlrNzNWQ2h1QXNma1B3NUszU0N4aEdtSnpYOD0iLCJtYWMiOiJhYTc4MDQ4NzdkMzM3MDE4NmI1ZTU3Y2RhNzg2YjcyODRmYTllNjVjODZlZWRhMGM4NWZlY2U4MGIwZTYwZTE5IiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6ImVZMkdYT25sV1FjYWxFUzk0ZVo4eXc9PSIsInZhbHVlIjoiM2E4K1V1d3llVnZsdGk2WXpnaVVzQT09IiwibWFjIjoiMDlkNzQyMGU0ZTg4NjIwYmZhZDYxZjlmM2JhZWE4YzBkYmZmMTBkODNlZWYxOGRiMmMxYjJlMDAyYTExOTdmMSIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:09:03','2025-07-18 23:40:52','2025-07-18 23:40:52'),(155,73,'VISA','eyJpdiI6IkExVHNFbm9PZ0VaWEFpSnVyR1l6dHc9PSIsInZhbHVlIjoiOVRYS2puNk4xUlZlRzM3TmVRTlJsTit5dFMwblF3Yk5nN2llNHBYSm5Wbz0iLCJtYWMiOiI4OGNkNWI3ZGFhYjZkZWEzNjI0MzA3MmU2YzRiNjFkYjE2Yzk2NDhkZWJiOWJlZDU0YWU4MmU2ODA5YTczYjViIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6ImJXOUhTaHRLYVNWdWE1ck1qRXArYlE9PSIsInZhbHVlIjoiMGJWNFpaTHp3YnpQN3k1Q2l6ejY3QT09IiwibWFjIjoiOTBjMzRiODMzZTMxYzBlMjY4ODRkNzYzZTdhMWEzNGJiN2NkMTQ0Y2NlOGNlYmFiNWNiYjg0NTBkYjJjZjA3YyIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:10:52','2025-07-18 23:45:20','2025-07-18 23:45:20'),(156,73,'VISA','eyJpdiI6IjZ1bzhST24yS3RYWFZ2Y2NXWTlzeFE9PSIsInZhbHVlIjoiWFkxZHkrRklBOCtmWThJKy82OVZIV04wbUwzS3NmQnZMWDI3blRBR0hNWT0iLCJtYWMiOiIyOGQ1MjhmZTVhZDMxNDBkODBhYzE1MTY5OTU2MjIwODFjNzFhMjg2ZWExN2ZmZmFhNjY0YjNjNTEwZGYzZDBmIiwidGFnIjoiIn0=','Ivory Ware','12','2028','eyJpdiI6InJjY3lFLzZLRVB5WG5QMjlDV3ljWHc9PSIsInZhbHVlIjoiOGkwSUkyKyt4NVRDVUh0UFBVN2huQT09IiwibWFjIjoiM2EyYzM4YjEyYmQxNWQ2ZTQwNGQzMTRhZjNkOWUzZTdkZDdjZWFmOTE2OTRmYjRlMDlkMzNmMzAzZTE0MjQ3NCIsInRhZyI6IiJ9','Eius blanditiis nemo','punyjy@mailinator.com','Alias ad consequatur','Consequatur autem ni','india','delhi','66052','INR',72.00,1,'2025-07-18 18:15:20','2025-07-18 23:45:20',NULL),(157,75,'VISA','eyJpdiI6IlFJWjAzUzhhUGRIYUlqRFg0OWx5RVE9PSIsInZhbHVlIjoiS2RBbWNmY2hjWTdGV0dWOHRnWjlHNG5IV2NyM2RrbnZVNE1GVjdkWlJJND0iLCJtYWMiOiIxMDhkYjU5NTVjNjFhZGQyZTViNjgxOWQyOWQxZmE4MDg5MDI4NjQ4MzIxZjE4NzFhZGQyYWUzOWI0NTFkZmI3IiwidGFnIjoiIn0=','sasasa','09','2033','eyJpdiI6ImZTNzQvYnd0YlNGRkluL0luTHI1Vmc9PSIsInZhbHVlIjoiVTJGcDBjUGNxbkI2R0N5RDFSZnVQdz09IiwibWFjIjoiZjVjYzQ4ZGI4MGM0Y2JmMDJmOGVlMzUzMjE3YTQyZDQ0NzY4MzE0NjA2MDAzYTA0YTU1YmZiNzNmZGU2NTJkMiIsInRhZyI6IiJ9','dsds','dsds@gmail.com','8945612304','de','India','India','110092','AUD',12.00,1,'2025-07-20 13:45:28','2025-07-29 18:50:48','2025-07-29 18:50:48'),(158,68,'Mastercard','eyJpdiI6IjQ5WXptbm9hWHJ3YjZPVExvUmxybUE9PSIsInZhbHVlIjoiY1pMOXlwL21HYVdSem5HeVhvR1J2MWhPVElYZFh6dlIyRkNUYkFVMFJBbz0iLCJtYWMiOiI3Njc5MTc2Y2U2YTViMTk5YTkxNTU3NGQ2NWM4YTQ2NTgzZmE2NTdkNDcyNTE5ZWZhZmNhZDllZTBmM2M4ZmMwIiwidGFnIjoiIn0=','George Warren','02','2032','eyJpdiI6InlhS1l4SDBsczFXSXpiMmRHS3MxU1E9PSIsInZhbHVlIjoiaGlEZU83WWV1WnJ4bHdHL2kzWks3UT09IiwibWFjIjoiNGQ5ZWJmOWUwYWVjZDViOWMxNzI0Y2YyM2NkODc0NDQ3OWI0NjUzNzc0YTIyYWEzZjg3ZmFkNTBmNWY3ZjRjOCIsInRhZyI6IiJ9',NULL,NULL,NULL,NULL,NULL,'India','19212','USD',0.00,1,'2025-07-27 15:18:04','2025-07-27 23:57:18',NULL),(159,64,'AMEX','eyJpdiI6Ii9MajdNTnZXa1VDYWNNdTJTMVowM2c9PSIsInZhbHVlIjoib2U0aG5ra3poSVJrZWNWUlBmbEVYbUVNYWtxdURuLzJudmN6ZURvTFdsRT0iLCJtYWMiOiI2MjFiYjBiZWE1YjlmOTI2ZTdjOTc3MjgwNTMyNDhlOGViOGY1NzA2Y2Q0NmI2YjFjMTAzMThlYmExZWM0YmE5IiwidGFnIjoiIn0=','Whoopi Kidd','02','2028','eyJpdiI6Im15alVkQisyOGFpL0ZBSVZUMEhZVEE9PSIsInZhbHVlIjoiTGV2OHBkdWgraWk2eXJVMzZwN2E2dz09IiwibWFjIjoiMTc2YWY4MDViMTdhMmI1ZTlhOTAzYzNiNjU4NWYxOTRhNWM0ZjViNDk2NjY5ZmNhZDBlYTIyN2FiNTVmNWE4NCIsInRhZyI6IiJ9',NULL,NULL,NULL,NULL,NULL,'India',NULL,'CAD',12.00,1,'2025-07-27 20:49:01','2025-07-28 02:19:01',NULL);
/*!40000 ALTER TABLE `travel_billing_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_booking_remarks`
--

DROP TABLE IF EXISTS `travel_booking_remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_booking_remarks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `particulars` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_booking_remarks_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_booking_remarks`
--

LOCK TABLES `travel_booking_remarks` WRITE;
/*!40000 ALTER TABLE `travel_booking_remarks` DISABLE KEYS */;
INSERT INTO `travel_booking_remarks` VALUES (8,27,'Testagent','2025-06-21 22:06:51','Consequuntur est id fdsfmkdskfds Booking Remarks','2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(9,28,'Testagent','2025-06-21 23:13:42','Eligendi animi proi','2025-06-22 03:13:42','2025-06-21 23:13:42',NULL),(10,29,'Testagent','2025-06-21 23:15:10','Proident dolor quae','2025-06-22 03:15:10','2025-06-21 23:15:10',NULL),(11,30,'Testagent','2025-06-22 00:30:11','Aut adipisci tempor','2025-06-22 04:30:11','2025-06-22 00:30:11',NULL),(12,31,'Testagent','2025-06-22 01:31:23','Consequat Qui quisq  TYESTSTTS','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(13,32,'Testagent','2025-06-22 20:12:41','Quas sed et incididu','2025-06-23 00:12:41','2025-06-22 20:12:41',NULL),(14,33,'Testagent','2025-06-23 22:07:07','Excepturi debitis as','2025-06-23 16:37:07','2025-06-23 22:07:07',NULL),(15,34,'Testagent','2025-06-27 23:52:15','Sed facere deserunt','2025-06-27 18:22:15','2025-06-27 23:52:15',NULL),(16,35,'Testagent','2025-06-28 19:23:36','Et inventore minim v','2025-06-28 13:53:36','2025-06-28 19:23:36',NULL),(17,36,'Testagent','2025-06-28 19:26:53','Sed saepe minim ipsa','2025-06-28 13:56:53','2025-06-28 19:26:53',NULL),(18,40,'Testagent','2025-06-28 20:16:09','Cum non nostrud ipsu','2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(19,45,'Testagent','2025-06-28 20:20:15','Cum non nostrud ipsu','2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(21,48,'Testagent','2025-06-28 20:21:38','Cum non nostrud ipsu','2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(22,51,'Testagent','2025-06-28 20:25:43','hjhgjgh','2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(23,72,'Testagent','2025-06-29 19:19:32','Similique modi quo a','2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(24,68,NULL,NULL,'asasasa','2025-07-27 14:41:20','2025-07-27 20:11:20',NULL),(25,68,NULL,NULL,'test','2025-07-27 14:41:31','2025-07-27 20:11:31',NULL),(26,75,NULL,NULL,'dsdsads','2025-07-29 13:21:18','2025-07-29 18:51:18',NULL),(27,75,NULL,NULL,'gsgf gfsg','2025-07-29 13:34:09','2025-07-29 19:04:09',NULL),(28,75,'1',NULL,'asas','2025-07-29 15:12:17','2025-07-29 20:42:17',NULL),(29,75,'1',NULL,'dfsdsd','2025-07-29 15:18:06','2025-07-29 20:48:06',NULL),(30,75,'1',NULL,'hgh hhfdhfdhfghgf','2025-07-29 16:00:46','2025-07-29 21:30:46',NULL),(31,75,'1',NULL,'ertertretre','2025-07-30 16:08:48','2025-07-30 21:38:48',NULL),(32,75,'1',NULL,'gfcbgfg fghgdfsgf','2025-07-30 21:15:54','2025-07-31 02:45:54',NULL);
/*!40000 ALTER TABLE `travel_booking_remarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_booking_types`
--

DROP TABLE IF EXISTS `travel_booking_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_booking_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `type` enum('Flight','Hotel','Cruise','Car','Train') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `travel_booking_types_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_booking_types`
--

LOCK TABLES `travel_booking_types` WRITE;
/*!40000 ALTER TABLE `travel_booking_types` DISABLE KEYS */;
INSERT INTO `travel_booking_types` VALUES (104,27,'Flight','2025-06-22 02:06:50','2025-06-21 22:06:50'),(105,28,'Hotel','2025-06-22 02:06:50','2025-06-21 22:06:50'),(106,28,'Cruise','2025-06-22 02:06:50','2025-06-21 22:06:50'),(107,28,'Car','2025-06-22 02:06:50','2025-06-21 22:06:50'),(108,28,'Train','2025-06-22 02:06:50','2025-06-21 22:06:50'),(109,28,'Flight','2025-06-22 03:13:42','2025-06-21 23:13:42'),(110,28,'Car','2025-06-22 03:13:42','2025-06-21 23:13:42'),(111,29,'Flight','2025-06-22 03:15:10','2025-06-21 23:15:10'),(112,29,'Hotel','2025-06-22 03:15:10','2025-06-21 23:15:10'),(113,30,'Car','2025-06-22 03:15:10','2025-06-21 23:15:10'),(114,30,'Train','2025-06-22 03:15:10','2025-06-21 23:15:10'),(115,30,'Hotel','2025-06-22 04:30:11','2025-06-22 00:30:11'),(116,30,'Train','2025-06-22 04:30:11','2025-06-22 00:30:11'),(122,32,'Flight','2025-06-23 00:12:41','2025-06-22 20:12:41'),(123,32,'Hotel','2025-06-23 00:12:41','2025-06-22 20:12:41'),(125,33,'Flight','2025-06-23 16:37:06','2025-06-23 22:07:06'),(126,33,'Hotel','2025-06-23 16:37:06','2025-06-23 22:07:06'),(127,33,'Cruise','2025-06-23 16:37:06','2025-06-23 22:07:06'),(128,33,'Car','2025-06-23 16:37:06','2025-06-23 22:07:06'),(134,31,'Flight','2025-06-23 18:39:41','2025-06-24 00:09:41'),(135,34,'Flight','2025-06-27 18:22:15','2025-06-27 23:52:15'),(136,34,'Cruise','2025-06-27 18:22:15','2025-06-27 23:52:15'),(137,34,'Car','2025-06-27 18:22:15','2025-06-27 23:52:15'),(138,35,'Hotel','2025-06-28 13:53:36','2025-06-28 19:23:36'),(139,35,'Car','2025-06-28 13:53:36','2025-06-28 19:23:36'),(140,35,'Train','2025-06-28 13:53:36','2025-06-28 19:23:36'),(141,36,'Flight','2025-06-28 13:56:53','2025-06-28 19:26:53'),(142,37,'Flight','2025-06-28 14:44:34','2025-06-28 20:14:34'),(143,37,'Hotel','2025-06-28 14:44:35','2025-06-28 20:14:35'),(144,38,'Flight','2025-06-28 14:44:44','2025-06-28 20:14:44'),(145,38,'Hotel','2025-06-28 14:44:44','2025-06-28 20:14:44'),(146,38,'Cruise','2025-06-28 14:44:44','2025-06-28 20:14:44'),(147,38,'Train','2025-06-28 14:44:44','2025-06-28 20:14:44'),(148,40,'Flight','2025-06-28 14:46:09','2025-06-28 20:16:09'),(149,40,'Hotel','2025-06-28 14:46:09','2025-06-28 20:16:09'),(150,40,'Cruise','2025-06-28 14:46:09','2025-06-28 20:16:09'),(151,40,'Car','2025-06-28 14:46:09','2025-06-28 20:16:09'),(152,40,'Train','2025-06-28 14:46:09','2025-06-28 20:16:09'),(153,45,'Flight','2025-06-28 14:50:15','2025-06-28 20:20:15'),(154,45,'Hotel','2025-06-28 14:50:15','2025-06-28 20:20:15'),(155,45,'Cruise','2025-06-28 14:50:15','2025-06-28 20:20:15'),(156,45,'Car','2025-06-28 14:50:15','2025-06-28 20:20:15'),(157,45,'Train','2025-06-28 14:50:15','2025-06-28 20:20:15'),(163,48,'Flight','2025-06-28 14:51:38','2025-06-28 20:21:38'),(164,48,'Hotel','2025-06-28 14:51:38','2025-06-28 20:21:38'),(165,48,'Cruise','2025-06-28 14:51:38','2025-06-28 20:21:38'),(166,48,'Car','2025-06-28 14:51:38','2025-06-28 20:21:38'),(167,48,'Train','2025-06-28 14:51:38','2025-06-28 20:21:38'),(168,51,'Flight','2025-06-28 14:55:43','2025-06-28 20:25:43'),(169,51,'Hotel','2025-06-28 14:55:43','2025-06-28 20:25:43'),(170,51,'Cruise','2025-06-28 14:55:43','2025-06-28 20:25:43'),(171,51,'Car','2025-06-28 14:55:43','2025-06-28 20:25:43'),(172,51,'Train','2025-06-28 14:55:43','2025-06-28 20:25:43'),(173,53,'Flight','2025-06-28 15:00:33','2025-06-28 20:30:33'),(174,53,'Hotel','2025-06-28 15:00:33','2025-06-28 20:30:33'),(175,53,'Train','2025-06-28 15:00:33','2025-06-28 20:30:33'),(176,54,'Flight','2025-06-28 15:19:27','2025-06-28 20:49:27'),(177,61,'Flight','2025-06-28 15:41:54','2025-06-28 21:11:54'),(178,61,'Hotel','2025-06-28 15:41:54','2025-06-28 21:11:54'),(179,61,'Car','2025-06-28 15:41:54','2025-06-28 21:11:54'),(181,66,'Flight','2025-06-28 17:07:10','2025-06-28 22:37:10'),(186,75,'Flight','2025-06-28 17:29:42','2025-06-28 22:59:42'),(187,70,'Hotel','2025-06-29 13:48:24','2025-06-29 19:18:24'),(188,70,'Cruise','2025-06-29 13:48:24','2025-06-29 19:18:24'),(189,70,'Car','2025-06-29 13:48:24','2025-06-29 19:18:24'),(190,72,'Cruise','2025-06-29 13:49:32','2025-06-29 19:19:32'),(191,72,'Car','2025-06-29 13:49:32','2025-06-29 19:19:32'),(200,73,'Cruise','2025-07-18 18:15:20','2025-07-18 23:45:20'),(201,73,'Train','2025-07-18 18:15:20','2025-07-18 23:45:20'),(209,68,'Flight','2025-07-27 16:31:18','2025-07-27 22:01:18'),(210,64,'Car','2025-07-27 20:49:01','2025-07-28 02:19:01');
/*!40000 ALTER TABLE `travel_booking_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_bookings`
--

DROP TABLE IF EXISTS `travel_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `booking_status_id` bigint unsigned DEFAULT NULL,
  `payment_status_id` bigint unsigned DEFAULT NULL,
  `shift_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  `pnr` varchar(50) NOT NULL,
  `campaign` varchar(30) DEFAULT NULL,
  `hotel_ref` varchar(50) DEFAULT NULL,
  `cruise_ref` varchar(50) DEFAULT NULL,
  `car_ref` varchar(50) DEFAULT NULL,
  `train_ref` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `query_type` varchar(100) DEFAULT NULL,
  `company_organisation` varchar(255) DEFAULT NULL,
  `reservation_source` varchar(255) DEFAULT NULL,
  `descriptor` varchar(255) DEFAULT NULL,
  `amadeus_sabre_pnr` varchar(50) DEFAULT NULL,
  `airlinepnr` varchar(50) DEFAULT NULL,
  `pnrtype` varchar(5) DEFAULT NULL,
  `selected_company` varchar(50) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `cruisebookingimage` text,
  `flightbookingimage` text,
  `hotelbookingimage` text,
  `call_queue` varchar(255) DEFAULT NULL,
  `shared_booking` varchar(255) DEFAULT NULL,
  `screenshot` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnr` (`pnr`),
  KEY `idx_pnr` (`pnr`),
  KEY `idx_email` (`email`),
  KEY `travel_bookings_shift_id_foreign` (`shift_id`),
  KEY `travel_bookings_team_id_foreign` (`team_id`),
  KEY `travel_bookings_booking_status_id_foreign` (`booking_status_id`),
  KEY `travel_bookings_payment_status_id_foreign` (`payment_status_id`),
  CONSTRAINT `travel_bookings_booking_status_id_foreign` FOREIGN KEY (`booking_status_id`) REFERENCES `booking_statuses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `travel_bookings_payment_status_id_foreign` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_statuses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `travel_bookings_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `travel_bookings_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_bookings`
--

LOCK TABLES `travel_bookings` WRITE;
/*!40000 ALTER TABLE `travel_bookings` DISABLE KEYS */;
INSERT INTO `travel_bookings` VALUES (27,1,1,NULL,NULL,NULL,'AIR210636820001','Premium Amtrak Bing Calls','Eveniet mollit faci','Hic quisquam aliquid',NULL,NULL,'Elvis Vincent','+1 (988) 214-7933','sijululaga@mailinator.com','UMNR',NULL,'Sit ut sit eos es','Qui quia illo offici','amadeus_sabre_pnr','airlinepnr','HK','1',NULL,'2025-06-22 02:06:50','2025-06-27 23:55:39',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,1,1,1,NULL,NULL,'AIR210636820002',NULL,NULL,NULL,NULL,NULL,'Wendy Burke','+1 (907) 512-3675','xavokiw@mailinator.com','CC',NULL,'Harum quis soluta au','Est eos omnis proi','Culpa reprehenderit',NULL,NULL,NULL,NULL,'2025-06-22 03:13:42','2025-06-21 23:13:42',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,1,1,NULL,NULL,NULL,'AIR210636820003',NULL,'Totam totam Nam ad p','Quisquam accusantium',NULL,NULL,'Yoko Tucker','+1 (972) 396-2464','coxividyny@mailinator.com','B',NULL,'Accusamus atque nece','Sed distinctio Accu','Asperiores sit quisq',NULL,NULL,NULL,NULL,'2025-06-22 03:15:10','2025-06-21 23:15:10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,1,1,NULL,NULL,NULL,'BUF220617460001',NULL,'In id rem unde nobis',NULL,NULL,NULL,'Deanna Gibson','+1 (568) 234-5156','zefaqyrogu@mailinator.com','S',NULL,'Ut ex in quis accusa','Odit blanditiis nesc','amadeus_sabre_pnr','airlinepnr','GK',NULL,NULL,'2025-06-22 04:30:11','2025-06-22 00:30:11',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,1,1,NULL,NULL,NULL,'LCC220653850002','Buffer Mix','Modi ipsam dolore vo','Nostrum molestias of','Ratione ipsa error','Ut commodo labore ad','Camden Cummings','+1 (137) 987-2558','tykucyv@mailinator.com','N',NULL,'Totam fuga Nulla od','Dolore non maxime eu','Est omnis et et cum','Aut vero asperiores','HK','3',NULL,'2025-06-22 05:31:23','2025-06-24 00:19:58',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,1,1,NULL,NULL,NULL,'AIR220627460003',NULL,'Cumque beatae in eli','Consequat Corporis',NULL,NULL,'Abel Frederick','+1 (674) 947-1403','gygeko@mailinator.com','NMC',NULL,'Ipsum ut doloremque','In in molestiae quia','Saepe ex distinctio',NULL,NULL,NULL,NULL,'2025-06-23 00:12:41','2025-06-22 20:12:41',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,1,1,NULL,NULL,NULL,'PRE230696140002','Premium Amtrak Bing Calls','Qui ut optio incidi','Exercitationem in do',NULL,NULL,'Jordan Woods','+1 (341) 976-4964','pyzuqogypi@mailinator.com','N',NULL,'Dolore provident mo','Culpa magni fugiat',NULL,NULL,NULL,'3',NULL,'2025-06-23 16:37:06','2025-06-23 22:07:06',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,1,1,NULL,NULL,NULL,'BUF270659200001','Buffer Mix',NULL,'Eiusmod id iusto des',NULL,NULL,'Maris Mcbride','+1 (408) 663-1991','keqaby@mailinator.com','CC',NULL,'Placeat et et nihil','Nesciunt voluptate','Et consequat Eos al',NULL,NULL,'3',NULL,'2025-06-27 18:22:15','2025-06-27 23:52:15',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,1,1,NULL,NULL,NULL,'SPA280695210001','Spanish','Et dolorum ut enim p',NULL,NULL,NULL,'Todd Howell','+1 (137) 825-1303','lofysaf@mailinator.com','M',NULL,'At veniam omnis qui','Dolor rem dignissimo',NULL,NULL,NULL,'6',NULL,'2025-06-28 13:53:36','2025-06-28 19:23:36',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,1,1,NULL,NULL,NULL,'INT280699780002','International','Proident officia do','Ipsam ipsam voluptat',NULL,NULL,'Allegra Lynch','+1 (373) 121-2315','cizupy@mailinator.com','NMC',NULL,'Assumenda quo corrup','Minima voluptatem no','Proident aut qui an',NULL,NULL,'5',NULL,'2025-06-28 13:56:53','2025-06-28 19:26:53',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,1,2,NULL,NULL,NULL,'PUR280628320003','Pure AA','Cumque ut irure quae',NULL,NULL,NULL,'Nicholas Acosta','+1 (716) 784-8993','robozihuj@mailinator.com','AE',NULL,'Sit veniam earum ex','Quo laborum incididu','Et atque nulla ipsam',NULL,NULL,'1',NULL,'2025-06-28 14:44:34','2025-06-28 20:14:34',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,1,1,NULL,NULL,NULL,'AIR280628320003','Airline Mix','Consectetur consequ','Harum corporis disti',NULL,NULL,'Leandra Herrera','+1 (965) 247-7766','mifari@mailinator.com','CBP',NULL,'Totam ut enim earum','Quia laboris minima','Eligendi provident',NULL,NULL,'6',NULL,'2025-06-28 14:44:44','2025-06-28 20:14:44',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,1,2,NULL,NULL,NULL,'MAJ280628320003M','Major Mix','Officia anim reicien','Officiis modi soluta',NULL,NULL,'Breanna Lester','+1 (718) 379-1686','xasawo@mailinator.com','S',NULL,'Autem asperiores nat','Sint sequi ad et vol','Vel tempora voluptat',NULL,NULL,'1',NULL,'2025-06-28 14:46:09','2025-06-28 20:16:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,1,3,NULL,NULL,NULL,'MAAJ280628320003','Major Mix','Officia anim reicien','Officiis modi soluta',NULL,NULL,'Breanna Lester','+1 (718) 379-1686','xasawo@mailinator.com','S',NULL,'Autem asperiores nat','Sint sequi ad et vol','Vel tempora voluptat',NULL,NULL,'1',NULL,'2025-06-28 14:50:15','2025-06-28 20:20:15',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,1,4,NULL,NULL,NULL,'MAJ280628320003','Major Mix','Officia anim reicien','Officiis modi soluta',NULL,NULL,'Breanna Lester','+1 (718) 379-1686','xasawo@mailinator.com','S',NULL,'Autem asperiores nat','Sint sequi ad et vol','Vel tempora voluptat',NULL,NULL,'1',NULL,'2025-06-28 14:51:38','2025-06-28 20:21:38',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,1,1,NULL,NULL,NULL,'CRU280634550008','Cruise','Nulla inventore mini','Non esse unde in pr',NULL,NULL,'Kylan Bradford','+1 (644) 613-5292','hicydib@mailinator.com','NC',NULL,'Officia est ex vel','Dignissimos obcaecat','Cumque ipsa ab magn',NULL,NULL,'1',NULL,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,1,2,NULL,NULL,NULL,'AIR280637930009','Airline Mix','Quos veniam ab labo',NULL,NULL,NULL,'Marsden Farrell','+1 (999) 213-1603','tapo@mailinator.com','M',NULL,'Totam quia beatae co','Tempora consequuntur','Sit anim corporis re',NULL,NULL,'3',NULL,'2025-06-28 15:00:33','2025-06-28 20:30:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,1,3,NULL,NULL,NULL,'280647660010',NULL,NULL,NULL,NULL,NULL,'hfghfg','8510810544','testt@gmail.com','N',NULL,'dadadas',NULL,NULL,NULL,NULL,'1',NULL,'2025-06-28 15:19:27','2025-06-28 20:49:27',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,1,4,NULL,NULL,NULL,'PRE280659780011','Premium Amtrak Bing Calls','Aliquip eveniet off','Eu facilis exercitat',NULL,NULL,'Alice Church','+1 (132) 226-6274','wirylozis@mailinator.com','NC',NULL,'Illum laboris corpo','Id in officia non se','Dolorem rem sunt ips',NULL,NULL,'5',NULL,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,1,1,NULL,NULL,NULL,'CRU','Cruise',NULL,NULL,NULL,NULL,'Kim Ramsey','121 141 1900',NULL,NULL,NULL,'Aut laboriosam adip',NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 17:04:06','2025-06-28 22:34:06',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(64,1,4,5,NULL,NULL,'BUF','Cruise','Sunt sint ea sunt v','Omnis laboris dolore','Nihil recusandae Do','Quod qui eiusmod ips','Cameran Patel','+1 (677) 558-1047',NULL,'Date or Time Changes Requests',NULL,'Aut voluptas magnam','Sint eveniet in inc','Voluptate recusandae','Fugiat aut laborum','HK','3',NULL,'2025-06-28 17:05:54','2025-07-28 02:19:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(66,1,3,NULL,NULL,NULL,'LCC','LCC',NULL,NULL,NULL,NULL,'Britanni Pickett','186 999 7627',NULL,NULL,NULL,'Qui molestiae eum ad',NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 17:07:10','2025-06-28 22:37:10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(68,1,1,1,NULL,NULL,'INT',NULL,'Ullamco ipsa consec','Sed perferendis omni','Id id veniam commo','Voluptates dolor rec','Madison Allison','+1 (499) 551-6828',NULL,'Package Reservation',NULL,'Neque quo et volupta','Esse nostrum et eum','Dolore aspernatur no','Ut quae veritatis ve','GK','1',NULL,'2025-06-28 17:08:45','2025-07-27 23:57:18',NULL,NULL,'[\"storage\\/flight_booking_image\\/H1lC7jAPPCN8I2ksiiZUEV8tvTAHS28V9dixcZ9a.html\"]',NULL,NULL,NULL,NULL),(69,1,1,NULL,NULL,NULL,'MAJ280627820016','Major Mix',NULL,NULL,NULL,NULL,'Dana Hyde','129 586 9238',NULL,NULL,NULL,'Facere repudiandae m',NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 17:29:42','2025-06-28 22:59:42',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(70,1,2,NULL,NULL,NULL,'MAJ290694900001','Major Mix','Rerum veritatis nobi','Sed laudantium sequ',NULL,NULL,'Cara Kaufman','+1 (369) 235-6919','nipiri@mailinator.com','AI',NULL,'Omnis sit eum dolor','Ad laboriosam ut si',NULL,NULL,NULL,'5',NULL,'2025-06-29 13:48:24','2025-06-29 19:18:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(72,1,3,NULL,NULL,NULL,'PUR290694900001','Pure AA','Sunt non velit aute','Quia voluptatibus ex',NULL,NULL,'Yasir Wise','+1 (659) 672-5204','guveg@mailinator.com','CH',NULL,'Ea qui quia proident','Assumenda ea omnis c','Suscipit consequatur',NULL,NULL,'1',NULL,'2025-06-29 13:49:32','2025-06-29 19:19:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(73,1,2,1,NULL,NULL,'SPA100755640001','Cruise','Ad deserunt quisquam','Sint quos tempor ul','Eveniet rem assumen','Cum est corporis ex','Hayley Roberson','+1 (297) 852-9862','rosoxuvad@mailinator.com','S',NULL,'Et qui rem in cupidi','In earum iure animi','Mollitia est culpa','Iusto id quae velit','GK','3',NULL,'2025-07-09 20:02:44','2025-07-18 23:45:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(75,NULL,1,1,NULL,NULL,'CAM190773010001',NULL,'Maxime voluptatibus','Quia quisquam asperi','Accusamus accusamus','Cupiditate deleniti','Neve Horton','+1 (982) 793-2122','jujufig@mailinator.com','Package Reservation',NULL,'Laborum magni amet','Illo nulla sit aut','Pariatur Dignissimo','Repudiandae nihil eu','GK','5',NULL,'2025-07-19 15:58:21','2025-07-30 23:57:11',NULL,NULL,'[\"storage\\/flight_booking_image\\/X59C2WGrwxldgkMhYLznKvZtJTEA9X4WDbpNuUNX.png\",\"storage\\/flight_booking_image\\/XIXMCMkpbxKi15U3V5avfA4DfFGFXaP7HoQ7Kjaq.html\",\"storage\\/flight_booking_image\\/FW6ImfF7cGfIN5Prq7lVjnST66atrOP4zRnLIR4V.html\",\"storage\\/flight_booking_image\\/up8020Ow4e8Fw9eBpX1DAUqT6hMO48TQQFV5s3CD.html\",\"storage\\/flight_booking_image\\/4HknAA6bdoh6c2P3Ued16cjCNmGnZ8ruqiDJUIhk.html\",\"storage\\/flight_booking_image\\/2t1Apln7jUBmlpE1Po1WUez9QEOI7lFK4LqRMJNC.html\"]',NULL,'Agency','Cruise','[\"storage\\/screenshots\\/O7Fyusz873PsVNki3xQs89ymPsJoJoGOvgL86xWR.html\"]');
/*!40000 ALTER TABLE `travel_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_car_details`
--

DROP TABLE IF EXISTS `travel_car_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_car_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `car_rental_provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dropoff_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `dropoff_date` date DEFAULT NULL,
  `dropoff_time` time DEFAULT NULL,
  `confirmation_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rental_provider_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `travel_car_details_booking_id_index` (`booking_id`),
  CONSTRAINT `travel_car_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_car_details`
--

LOCK TABLES `travel_car_details` WRITE;
/*!40000 ALTER TABLE `travel_car_details` DISABLE KEYS */;
INSERT INTO `travel_car_details` VALUES (18,27,'1','1','1','1','2025-06-21','18:09:00','2025-06-21','18:09:00','1','1','1','2025-06-22 02:06:50','2025-06-22 02:06:50',NULL),(19,27,'2','2','2','2','2025-06-21','18:08:00','2025-06-21','18:08:00','2','2','2','2025-06-22 02:06:50','2025-06-22 02:06:50',NULL),(21,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 03:13:42','2025-06-22 03:13:42',NULL),(22,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 03:15:10','2025-06-22 03:15:10',NULL),(23,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 04:30:11','2025-06-22 04:30:11',NULL),(24,27,'Voluptas labore sit','Commodo veniam dolo','Sed dolor quae tempo','Alias aliquip evenie','1994-10-05','14:50:00','1986-05-06','09:51:00','Alias aliquip evenie','Porro dolorem animi','Qui facere quod sit','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(25,27,'Eaque eu aliquip est','Quidem harum rerum l','Quasi in eum id eli','Et reprehenderit und','1972-03-31','20:20:00','1993-12-02','03:39:00','Et reprehenderit und','Corporis sed fuga I','Maiores eos elit nu','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(26,31,'Assumenda ut omnis u','Tempora rem quis dol','Est voluptatem magni','Vero labore sunt sae','2001-07-07','03:26:00','2021-04-05','05:47:00','Vero labore sunt sae','Iure esse unde et ea','Minima aute sed aliq','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(27,31,'Tenetur accusamus ma','Et deleniti nisi non','Et et exercitation c','Est dolor ea vel vol','2009-08-02','17:32:00','2015-12-30','16:13:00','Est dolor ea vel vol','Libero vitae quia te','Ut aperiam hic ea qu','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(28,31,'Beatae esse nisi tem','Dicta nihil tempor q','Omnis et quisquam id','Quia et libero sed d','2004-07-27','15:41:00','2017-07-20','15:58:00','Quia et libero sed d','Qui qui officiis lau','Amet porro non ut s','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(29,31,'Dolores obcaecati id','Modi officia ea labo','Voluptatem laudantiu','Debitis sequi mollit','2017-05-27','02:05:00','1987-12-27','08:52:00','Debitis sequi mollit','Consectetur tempore','Repudiandae expedita','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(30,31,'Aute assumenda eum a','Deserunt aut alias n','Architecto iusto ver','Fugit sed esse fug','2021-08-26','13:03:00','2020-04-09','23:15:00','Fugit sed esse fug','Non ex tempore et d','Magnam impedit inci','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(31,31,'Magnam sequi do id e','Hic consectetur exer','Omnis fuga Beatae v','Beatae non et repudi','1994-11-01','21:32:00','2009-01-24','11:56:00','Beatae non et repudi','Elit dolorum ipsum','Reprehenderit laboru','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(32,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(33,32,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-23 00:12:41','2025-06-23 00:12:41',NULL),(34,33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-23 16:37:06','2025-06-23 16:37:06',NULL),(35,34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-27 18:22:15','2025-06-27 18:22:15',NULL),(36,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:53:36','2025-06-28 13:53:36',NULL),(37,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:56:53','2025-06-28 13:56:53',NULL),(38,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:35','2025-06-28 14:44:35',NULL),(39,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:44','2025-06-28 14:44:44',NULL),(40,40,'Qui natus odit optio','Quos quam est et si','Quod dolorem id libe','Est non consequat V','2010-09-26','23:58:00','1981-02-25','17:55:00','Est non consequat V','Est maxime aut nisi','Ullam animi est eo','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL),(41,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:46:09','2025-06-28 14:46:09',NULL),(42,45,'Qui natus odit optio','Quos quam est et si','Quod dolorem id libe','Est non consequat V','2010-09-26','23:58:00','1981-02-25','17:55:00','Est non consequat V','Est maxime aut nisi','Ullam animi est eo','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL),(43,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:50:15','2025-06-28 14:50:15',NULL),(46,48,'Qui natus odit optio','Quos quam est et si','Quod dolorem id libe','Est non consequat V','2010-09-26','23:58:00','1981-02-25','17:55:00','Est non consequat V','Est maxime aut nisi','Ullam animi est eo','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL),(47,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:51:38','2025-06-28 14:51:38',NULL),(48,51,'Odio sunt adipisci','Sed ad blanditiis de','Dolor animi quia qu','Veniam quia saepe q','2021-09-09','08:35:00','2018-02-13','16:11:00','Veniam quia saepe q','Sed consequatur anim','Nesciunt similique','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL),(49,51,'Et ex culpa cillum','Ut et incididunt tem','Illum nulla rem qui','Omnis repudiandae es','1975-01-06','22:21:00','1996-01-05','16:42:00','Omnis repudiandae es','Molestiae veniam se','Nesciunt ipsum aut','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL),(50,51,'Consequuntur eaque v','Nulla doloribus aut','Occaecat sed debitis','Voluptate aperiam vo','1987-04-20','13:36:00','1993-12-21','03:02:00','Voluptate aperiam vo','Minim voluptate dist','Sit dolor iure nostr','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL),(51,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:55:43','2025-06-28 14:55:43',NULL),(52,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:00:33','2025-06-28 15:00:33',NULL),(53,54,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:19:27','2025-06-28 15:19:27',NULL),(54,61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:41:54','2025-06-28 15:41:54',NULL),(55,70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:48:24','2025-06-29 13:48:24',NULL),(56,72,'Ut voluptate tempori','Commodo libero volup','Possimus quia ratio','Soluta rerum exercit','1990-02-22','20:14:00','2002-11-30','23:37:00','Soluta rerum exercit','Nemo quam quis provi','Ducimus tenetur ex','2025-06-29 13:49:32','2025-06-29 13:49:32',NULL),(57,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:49:32','2025-06-29 13:49:32',NULL),(59,73,'Aliquam culpa qui q','Mollit aut pariatur','Repudiandae minus au','Quos nisi nihil nost','1988-04-08','19:57:00','2012-11-03','19:20:00','Quos nisi nihil nost','Ipsa ea veritatis v','Sit repellendus Ci','2025-07-18 18:15:20','2025-07-18 18:15:20',NULL),(60,73,'Error est non id et','Ipsum laboriosam co','Maxime illum ea in','Id et lorem dolore','2006-08-11','09:07:00','2007-05-09','03:06:00','Id et lorem dolore','In explicabo Sapien','Fugiat neque fuga','2025-07-18 18:15:20','2025-07-18 18:15:20',NULL),(61,73,'Distinctio Eligendi','Odio aperiam omnis a','Excepteur fugiat ni','Qui quia ex voluptat','2003-01-08','01:49:00','1995-11-14','11:54:00','Qui quia ex voluptat','Quo voluptatem reici','Anim neque do dolore','2025-07-18 18:15:20','2025-07-18 18:15:20',NULL),(132,68,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-27 18:27:18','2025-07-27 18:27:18',NULL),(133,64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-27 20:49:01','2025-07-27 20:49:01',NULL),(158,75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-30 18:27:11','2025-07-30 18:27:11',NULL);
/*!40000 ALTER TABLE `travel_car_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_cruise_details`
--

DROP TABLE IF EXISTS `travel_cruise_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_cruise_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `cruise_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stateroom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `departure_hrs` tinyint unsigned DEFAULT NULL,
  `departure_mm` tinyint unsigned DEFAULT NULL,
  `arrival_port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `arrival_hrs` tinyint unsigned DEFAULT NULL,
  `arrival_mm` tinyint unsigned DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `travel_cruise_details_booking_id_index` (`booking_id`),
  CONSTRAINT `travel_cruise_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_cruise_details`
--

LOCK TABLES `travel_cruise_details` WRITE;
/*!40000 ALTER TABLE `travel_cruise_details` DISABLE KEYS */;
INSERT INTO `travel_cruise_details` VALUES (13,27,'1','1','1','1','1','2025-06-21',1,1,'1','2025-06-21',12,13,'1','2025-06-22 02:06:50','2025-06-22 02:06:50',NULL,NULL),(14,27,'2','2','22','2','2','2025-06-21',2,2,'2','2025-06-21',12,12,'2','2025-06-22 02:06:50','2025-06-22 02:06:50',NULL,NULL),(15,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 02:06:50','2025-06-22 02:06:50',NULL,NULL),(16,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 03:13:42','2025-06-22 03:13:42',NULL,NULL),(17,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 03:15:10','2025-06-22 03:15:10',NULL,NULL),(18,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 04:30:11','2025-06-22 04:30:11',NULL,NULL),(19,31,'Sunt tenetur quae se','Stacey Horn','Ipsam veritatis veli','Quisquam rerum magni','Vitae quae sed disti','1982-06-18',5,40,'Consequatur ab nesc','2003-04-17',8,46,'Iure do quis suscipi','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(20,31,'Assumenda atque moll','Christopher Cooke','Quo exercitationem e','Fuga Vel fugiat di','Incididunt accusamus','1991-04-12',0,29,'Quod nostrud saepe s','1992-09-21',20,28,'Est voluptatum aliqu','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(21,31,'Quidem sit laborios','Mia Chaney','Nostrum quis incidun','Ad eaque consectetur','Eligendi iusto excep','1974-09-15',7,58,'Voluptates commodi q','2020-05-13',4,40,'Facilis molestias in','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(22,31,'Mollit nisi animi d','Maile Berry','Qui quas debitis id','Fugiat qui repudiand','Deserunt odit quia l','2005-08-15',21,31,'Sequi laborum Nulla','2025-04-10',19,24,'Do veniam enim et s','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(23,31,'Nesciunt ut consequ','Buffy Underwood','Esse modi incidunt','Dolor voluptatem Et','Quasi sed provident','1981-01-26',10,33,'Illum qui neque nob','2003-06-27',7,25,'Animi voluptate dol','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(24,31,'Est libero voluptate','Candace Hanson','Quis dolore sit sit','Vel qui assumenda ve','Nihil labore commodi','1972-07-23',8,1,'Aliquip officia eius','2012-05-25',19,15,'Quis ullam sequi ass','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(25,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 05:31:23','2025-06-22 05:31:23',NULL,NULL),(26,32,'Vitae architecto mag','Walker Poole','Magnam magna fuga N','Qui possimus ut ut','Minus dolorem nulla','2013-01-27',6,6,'Voluptatem proident','2013-10-12',22,9,'Aperiam consequatur','2025-06-23 00:12:41','2025-06-23 00:12:41',NULL,NULL),(27,32,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-23 00:12:41','2025-06-23 00:12:41',NULL,NULL),(28,33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-23 16:37:07','2025-06-23 16:37:07',NULL,NULL),(29,34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-27 18:22:15','2025-06-27 18:22:15',NULL,NULL),(30,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:53:36','2025-06-28 13:53:36',NULL,NULL),(31,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:56:53','2025-06-28 13:56:53',NULL,NULL),(32,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:35','2025-06-28 14:44:35',NULL,NULL),(33,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:44','2025-06-28 14:44:44',NULL,NULL),(34,40,'Fugit elit officia','Zephania Edwards','Id culpa quam mole','Dignissimos ut non m','Unde aut aute ut est','2011-07-10',9,15,'Consectetur et volu','1993-08-14',15,13,'Cupiditate consequat','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(35,40,'Culpa voluptas et d','Meghan Wong','Occaecat autem nulla','Sint facere sunt vit','Officia eiusmod labo','2017-08-16',12,39,'Nam aute in autem si','2003-09-20',15,1,'Distinctio Fuga Te','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(36,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(37,45,'Fugit elit officia','Zephania Edwards','Id culpa quam mole','Dignissimos ut non m','Unde aut aute ut est','2011-07-10',9,15,'Consectetur et volu','1993-08-14',15,13,'Cupiditate consequat','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(38,45,'Culpa voluptas et d','Meghan Wong','Occaecat autem nulla','Sint facere sunt vit','Officia eiusmod labo','2017-08-16',12,39,'Nam aute in autem si','2003-09-20',15,1,'Distinctio Fuga Te','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(39,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(43,48,'Fugit elit officia','Zephania Edwards','Id culpa quam mole','Dignissimos ut non m','Unde aut aute ut est','2011-07-10',9,15,'Consectetur et volu','1993-08-14',15,13,'Cupiditate consequat','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(44,48,'Culpa voluptas et d','Meghan Wong','Occaecat autem nulla','Sint facere sunt vit','Officia eiusmod labo','2017-08-16',12,39,'Nam aute in autem si','2003-09-20',15,1,'Distinctio Fuga Te','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(45,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(46,51,'Assumenda alias veri','Oren Jennings','Voluptatem tenetur','Eu provident culpa','Eius duis nemo earum','1986-08-23',14,47,'Dolorem aut explicab','1982-10-08',20,54,'Molestias voluptas s','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(47,51,'Qui veniam libero q','Armando Sandoval','Reiciendis fuga Adi','Deleniti enim consec','Tempora labore enim','2022-06-11',0,26,'Pariatur Quia cupid','1987-10-11',9,5,'Commodo officia mini','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(48,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(49,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:00:33','2025-06-28 15:00:33',NULL,NULL),(50,54,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:19:27','2025-06-28 15:19:27',NULL,NULL),(51,61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:41:54','2025-06-28 15:41:54',NULL,NULL),(52,70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:48:24','2025-06-29 13:48:24',NULL,NULL),(53,72,'Est sint ipsum al','Aladdin Roberts','Amet cillum et volu','Et rerum consequatur','Proident qui enim o','2006-11-17',0,9,'Et autem incidunt m','1976-08-27',12,15,'Placeat architecto','2025-06-29 13:49:32','2025-06-29 13:49:32',NULL,NULL),(54,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:49:32','2025-06-29 13:49:32',NULL,NULL);
/*!40000 ALTER TABLE `travel_cruise_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_flight_details`
--

DROP TABLE IF EXISTS `travel_flight_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_flight_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `direction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `airline_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flight_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_of_service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_airport` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_hours` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_minutes` tinyint unsigned DEFAULT NULL,
  `arrival_airport` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_hours` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_minutes` tinyint unsigned DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `travel_flight_details_booking_id_index` (`booking_id`),
  CONSTRAINT `travel_flight_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_flight_details`
--

LOCK TABLES `travel_flight_details` WRITE;
/*!40000 ALTER TABLE `travel_flight_details` DISABLE KEYS */;
INSERT INTO `travel_flight_details` VALUES (20,31,'1Aut qui voluptate qu','1987-08-30','Non in veniam offic','39','Quidem est quia minu','Sed quidem quasi bla','Molestiae cum cum di','23',50,'Provident numquam r','2',58,'Aliqua Neque tempor','Voluptatem animi qu','2011-10-26','2025-06-23 18:43:26','2025-06-23 18:44:18','2025-06-24 00:14:18',NULL),(21,31,'Ab doloremque aut ea','2025-06-24','Voluptate optio neq','970','Voluptatem Et moles','Laudantium laborios','Omnis ad rerum tenet','23',53,'Aliquip anim consequ','14',59,'Ex nemo minus eos f','Fuga Laborum aut a','1999-02-26','2025-06-23 18:49:58','2025-06-23 18:51:04','2025-06-24 00:21:04',NULL),(22,34,'Minus odit voluptas','2001-01-17','Deserunt consequatur','242','Nisi fugiat volupta','Sit dolores reprehe','Quibusdam dolore sed','4',42,'Sit cupiditate vel','3',23,'Inventore id ut pari','Beatae reiciendis es','1982-07-14','2025-06-27 18:22:15','2025-06-27 18:22:15',NULL,NULL),(23,34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-27 18:22:15','2025-06-27 18:22:15',NULL,NULL),(24,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:53:36','2025-06-28 13:53:36',NULL,NULL),(25,36,'Optio possimus qui','2003-07-14','Id sit fuga Do exce','862','Eiusmod sunt dolor i','Non sint quam duis v','Ut hic quo culpa do','13',13,'Sit architecto odit','13',16,'Molestias cupidatat','Officiis eveniet et','1970-12-25','2025-06-28 13:56:53','2025-06-28 13:56:53',NULL,NULL),(26,36,'Eum sint dolor natu','2013-06-06','Magni omnis cupidita','586','Proident iusto a ve','Consequatur amet es','Sint distinctio Acc','23',44,'Vitae exercitation i','17',1,'Sit nesciunt quia','Odio in dicta nesciu','1974-07-26','2025-06-28 13:56:53','2025-06-28 13:56:53',NULL,NULL),(27,36,'Mollitia iste hic qu','1990-12-06','Voluptatem accusanti','910','Duis minima fugiat a','Quaerat sed dolores','Molestias voluptatem','13',48,'Et a doloribus volup','17',25,'Elit debitis tempor','Fugit omnis qui cor','1972-09-13','2025-06-28 13:56:53','2025-06-28 13:56:53',NULL,NULL),(28,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:56:53','2025-06-28 13:56:53',NULL,NULL),(29,37,'Cupidatat asperiores','1989-12-18','Eos ut illum labore','296','Cumque qui et in id','Aspernatur voluptate','Ut occaecat voluptat','12',25,'Minim voluptas do ve','2',46,'Animi nesciunt rer','Doloremque iste irur','2020-01-12','2025-06-28 14:44:35','2025-06-28 14:44:35',NULL,NULL),(30,37,'Similique provident','2011-04-28','Sunt aut expedita om','650','Sunt omnis sit ut es','Eum molestiae explic','Adipisci tenetur ess','18',28,'Nulla ea necessitati','20',15,'Accusamus voluptatem','Voluptatem Explicab','1976-10-05','2025-06-28 14:44:35','2025-06-28 14:44:35',NULL,NULL),(31,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:35','2025-06-28 14:44:35',NULL,NULL),(32,38,'Cupidatat asperiores','1989-12-18','Eos ut illum labore','296','Cumque qui et in id','Aspernatur voluptate','Ut occaecat voluptat','12',25,'Minim voluptas do ve','2',46,'Animi nesciunt rer','Doloremque iste irur','2020-01-12','2025-06-28 14:44:44','2025-06-28 14:44:44',NULL,NULL),(33,38,'Similique provident','2011-04-28','Sunt aut expedita om','650','Sunt omnis sit ut es','Eum molestiae explic','Adipisci tenetur ess','18',28,'Nulla ea necessitati','20',15,'Accusamus voluptatem','Voluptatem Explicab','1976-10-05','2025-06-28 14:44:44','2025-06-28 14:44:44',NULL,NULL),(34,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:44','2025-06-28 14:44:44',NULL,NULL),(35,40,'Vel aut sed non volu','1973-06-19','Porro consectetur e','817','Dignissimos fugit n','Qui cum perspiciatis','Non dolor velit vol','1',49,'Et dicta enim aliqua','20',9,'Saepe dolor perferen','Voluptatibus aut a f','2023-06-06','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(36,40,'Facere dolor in dolo','1992-12-06','Facilis sit volupta','357','Sint dolore praesent','Vero impedit veniam','Eveniet molestiae l','22',59,'Nam velit dolor ut','8',41,'Quia non quia maiore','Labore et impedit u','2003-05-08','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(37,40,'Odio harum mollitia','1999-08-11','Voluptatem magni qui','985','Incididunt magnam vo','Non magna esse ut a','Repudiandae voluptat','19',20,'Do voluptates quis m','3',13,'Doloribus voluptatib','Id aperiam distincti','2014-10-13','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(38,40,'Sed anim est iure v','2012-03-09','Laborum Veritatis e','685','Sed ullam atque id','Commodo ut omnis ver','Asperiores non minim','0',13,'Dolor autem aliquid','1',55,'Illum omnis elit d','Occaecat magna solut','2013-01-03','2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(39,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:46:09','2025-06-28 14:46:09',NULL,NULL),(40,45,'Vel aut sed non volu','1973-06-19','Porro consectetur e','817','Dignissimos fugit n','Qui cum perspiciatis','Non dolor velit vol','1',49,'Et dicta enim aliqua','20',9,'Saepe dolor perferen','Voluptatibus aut a f','2023-06-06','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(41,45,'Facere dolor in dolo','1992-12-06','Facilis sit volupta','357','Sint dolore praesent','Vero impedit veniam','Eveniet molestiae l','22',59,'Nam velit dolor ut','8',41,'Quia non quia maiore','Labore et impedit u','2003-05-08','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(42,45,'Odio harum mollitia','1999-08-11','Voluptatem magni qui','985','Incididunt magnam vo','Non magna esse ut a','Repudiandae voluptat','19',20,'Do voluptates quis m','3',13,'Doloribus voluptatib','Id aperiam distincti','2014-10-13','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(43,45,'Sed anim est iure v','2012-03-09','Laborum Veritatis e','685','Sed ullam atque id','Commodo ut omnis ver','Asperiores non minim','0',13,'Dolor autem aliquid','1',55,'Illum omnis elit d','Occaecat magna solut','2013-01-03','2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(44,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:50:15','2025-06-28 14:50:15',NULL,NULL),(50,48,'Vel aut sed non volu','1973-06-19','Porro consectetur e','817','Dignissimos fugit n','Qui cum perspiciatis','Non dolor velit vol','1',49,'Et dicta enim aliqua','20',9,'Saepe dolor perferen','Voluptatibus aut a f','2023-06-06','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(51,48,'Facere dolor in dolo','1992-12-06','Facilis sit volupta','357','Sint dolore praesent','Vero impedit veniam','Eveniet molestiae l','22',59,'Nam velit dolor ut','8',41,'Quia non quia maiore','Labore et impedit u','2003-05-08','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(52,48,'Odio harum mollitia','1999-08-11','Voluptatem magni qui','985','Incididunt magnam vo','Non magna esse ut a','Repudiandae voluptat','19',20,'Do voluptates quis m','3',13,'Doloribus voluptatib','Id aperiam distincti','2014-10-13','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(53,48,'Sed anim est iure v','2012-03-09','Laborum Veritatis e','685','Sed ullam atque id','Commodo ut omnis ver','Asperiores non minim','0',13,'Dolor autem aliquid','1',55,'Illum omnis elit d','Occaecat magna solut','2013-01-03','2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(54,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:51:38','2025-06-28 14:51:38',NULL,NULL),(55,51,'Minus dolor minima p','2018-08-04','Sunt praesentium si','749','Ipsum ad quod quia l','Sit qui doloribus ex','Eaque sint pariatur','6',22,'Molestias sit labori','1',1,'Eos proident neque','Consequat Vero ad q','1986-07-06','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(56,51,'Commodi enim eveniet','1971-08-06','Totam quibusdam dolo','388','Deleniti rerum molli','Blanditiis nostrum a','Voluptates deserunt','8',41,'Doloremque quos mole','0',3,'Quia nostrud esse in','Consequuntur dolorem','2024-10-25','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(57,51,'Enim voluptas duis a','1971-03-07','Aliquam debitis qui','87','Aperiam dolor amet','Eaque nihil aliqua','Libero voluptas et a','0',39,'Autem consequatur bl','16',41,'Fugiat mollitia qui','Voluptate facere seq','2013-10-21','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(58,51,'Neque est molestias','1997-12-23','Amet amet nesciunt','337','Excepteur nihil expl','Corporis laboris lab','Consequat Ipsam con','1',48,'Quis sed nihil tempo','0',1,'Corporis sit perfere','Eum harum nisi elit','2008-12-07','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(59,51,'Aut doloribus placea','2007-07-26','Ratione nostrum faci','401','Dolor consequat Rer','Harum debitis accusa','Fugiat dolor volupt','4',0,'Aliquip provident v','7',44,'Repudiandae voluptas','Necessitatibus moles','2021-03-01','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(60,51,'Et laudantium quas','1980-05-12','Atque et sit et dol','487','Sint qui qui porro m','Ullam modi ipsum quo','Ad molestiae veritat','20',16,'Unde eveniet consec','23',34,'Beatae minim officia','Voluptate dolorem iu','1976-05-16','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(61,51,'Corporis corrupti f','1979-04-21','Dolorum quidem quide','532','Ex labore rerum esse','Nulla harum est cum','Similique ut eum vit','4',12,'Et eum mollitia anim','5',44,'Sint consectetur s','Voluptate doloremque','2009-05-29','2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(62,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:55:43','2025-06-28 14:55:43',NULL,NULL),(63,53,'Ipsum ab vel et qui','2009-04-17','Repudiandae perferen','825','Nesciunt labore ut','In rerum inventore l','Veritatis veritatis','13',40,'Itaque placeat arch','21',38,'Optio dolores at vo','Minima Nam maxime ad','2024-08-28','2025-06-28 15:00:33','2025-06-28 15:00:33',NULL,NULL),(64,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:00:33','2025-06-28 15:00:33',NULL,NULL),(65,54,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:19:27','2025-06-28 15:19:27',NULL,NULL),(66,61,'Laudantium nisi ull','2020-07-06','Facere laboriosam s','192','Quo ea nostrud tempo','Id ut do molestiae b','Sunt ipsum omnis rei','1',16,'Exercitationem cum i','13',54,'Necessitatibus in am','Sint dicta et velit','1974-04-20','2025-06-28 15:41:54','2025-06-28 15:41:54',NULL,NULL),(67,61,'Occaecat ullamco in','1999-01-19','Natus ut quo in volu','795','Ipsum ut deserunt p','Cumque officiis dolo','Mollitia quae dolore','18',32,'Nisi velit ex ea vol','2',32,'Et et quas labore ea','Occaecat doloribus v','1981-02-10','2025-06-28 15:41:54','2025-06-28 15:41:54',NULL,NULL),(68,61,'Non molestiae elit','1974-02-14','Recusandae Facilis','226','Nulla ullamco quas u','Voluptas soluta iust','Dolor consectetur ir','8',37,'Commodi officiis vol','12',42,'Officia ut culpa re','Nemo cumque officia','1987-03-22','2025-06-28 15:41:54','2025-06-28 15:41:54',NULL,NULL),(69,61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:41:54','2025-06-28 15:41:54',NULL,NULL),(70,70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:48:24','2025-06-29 13:48:24',NULL,NULL),(71,72,'Impedit impedit qu','2021-10-08','Quos porro cillum co','634','Et dolor error facil','Quis dicta blanditii','Totam sed ipsa moll','3',45,'Et rem animi accusa','12',48,'Modi illum sint ten','Tempore necessitati','1971-06-02','2025-06-29 13:49:32','2025-06-29 13:49:32',NULL,NULL),(72,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:49:32','2025-06-29 13:49:32',NULL,NULL),(73,75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-20 13:45:28','2025-07-30 18:27:11',NULL,NULL),(74,68,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-27 18:23:19','2025-07-27 18:23:19',NULL,NULL),(75,64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-27 20:49:01','2025-07-27 20:49:01',NULL,NULL);
/*!40000 ALTER TABLE `travel_flight_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_hotel_details`
--

DROP TABLE IF EXISTS `travel_hotel_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_hotel_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `hotel_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `no_of_rooms` int unsigned DEFAULT NULL,
  `confirmation_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `travel_hotel_details_booking_id_index` (`booking_id`),
  CONSTRAINT `travel_hotel_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_hotel_details`
--

LOCK TABLES `travel_hotel_details` WRITE;
/*!40000 ALTER TABLE `travel_hotel_details` DISABLE KEYS */;
INSERT INTO `travel_hotel_details` VALUES (10,27,'1','1','2025-06-21','2025-06-21',1,'1','11','1','2025-06-22 02:06:51','2025-06-22 02:06:51',NULL),(11,27,'2','2','2025-06-21','2025-06-21',2,'2','2','2','2025-06-22 02:06:51','2025-06-22 02:06:51',NULL),(13,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 03:13:42','2025-06-22 03:13:42',NULL),(14,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 03:15:10','2025-06-22 03:15:10',NULL),(15,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 04:30:11','2025-06-22 04:30:11',NULL),(16,31,'Jada Koch','Voluptate quo non is','2006-05-02','1974-02-13',84,'Voluptate quo non is','Beatae quibusdam mol','Voluptate qui omnis','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(17,31,'Logan Harper','Et consequatur Dolo','2014-03-12','2020-01-28',95,'Et consequatur Dolo','Ut veritatis sint d','Vel ex reiciendis du','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(18,31,'Ulysses Green','Accusamus nemo occae','1972-07-26','1989-09-30',40,'Accusamus nemo occae','Ullam omnis veniam','Eligendi omnis non v','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(19,31,'Belle Roth','Ex in amet quia Nam','1988-05-17','2014-06-18',15,'Ex in amet quia Nam','Illum et quas commo','Dolorum nesciunt la','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(20,31,'Dai Joyner','Tenetur recusandae','2005-07-03','1996-12-30',55,'Tenetur recusandae','Sapiente sit ullamco','Consequatur veniam','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(21,31,'Blake Romero','Reiciendis maiores s','1996-05-08','2009-10-05',13,'Reiciendis maiores s','Cumque voluptate mag','Tempora fugiat et re','2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(22,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-22 05:31:23','2025-06-22 05:31:23',NULL),(23,32,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-23 00:12:41','2025-06-23 00:12:41',NULL),(24,33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-23 16:37:07','2025-06-23 16:37:07',NULL),(25,34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-27 18:22:15','2025-06-27 18:22:15',NULL),(26,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:53:36','2025-06-28 13:53:36',NULL),(27,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 13:56:53','2025-06-28 13:56:53',NULL),(28,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:35','2025-06-28 14:44:35',NULL),(29,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:44:44','2025-06-28 14:44:44',NULL),(30,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:46:09','2025-06-28 14:46:09',NULL),(31,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:50:15','2025-06-28 14:50:15',NULL),(33,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:51:38','2025-06-28 14:51:38',NULL),(34,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 14:55:43','2025-06-28 14:55:43',NULL),(35,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:00:33','2025-06-28 15:00:33',NULL),(36,54,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:19:27','2025-06-28 15:19:27',NULL),(37,61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-28 15:41:54','2025-06-28 15:41:54',NULL),(38,70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:48:24','2025-06-29 13:48:24',NULL),(39,72,'Olympia Cruz','Voluptas aut fugiat','2019-03-17','2001-05-07',46,'Voluptas aut fugiat','Dolor aut rerum labo','Dolores dignissimos','2025-06-29 13:49:32','2025-06-29 13:49:32',NULL),(40,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-29 13:49:32','2025-06-29 13:49:32',NULL);
/*!40000 ALTER TABLE `travel_hotel_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_passengers`
--

DROP TABLE IF EXISTS `travel_passengers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_passengers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_passengers`
--

LOCK TABLES `travel_passengers` WRITE;
/*!40000 ALTER TABLE `travel_passengers` DISABLE KEYS */;
INSERT INTO `travel_passengers` VALUES (60,27,'Adult','Male','2025-06-21','2','Ms',0.00,'121','212','121','1','2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(61,27,'Adult','Male','2025-06-21','3','Miss',0.00,'2','2','2','ee','2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(62,27,'Seat Infant','Male','2025-06-21','3','Miss',0.00,'3','3','3','3','2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(63,27,'Adult','Male','2025-06-21','8','Mr',0.00,NULL,NULL,NULL,NULL,'2025-06-22 02:06:51','2025-06-21 22:06:51',NULL),(64,28,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-22 03:13:42','2025-06-21 23:13:42',NULL),(65,29,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-22 03:15:10','2025-06-21 23:15:10',NULL),(66,30,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-22 04:30:11','2025-06-22 00:30:11',NULL),(67,31,'Lap Infant','Male','1987-08-09','501','Ms',0.00,'Maxwell','Conan York','Roy','847','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(68,31,'Adult','Male','1991-08-27','216','Dolore voluptas temp',0.00,'Maggy','Brady Kramer','Tanner','956','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(69,31,'Lap Infant','Female','1989-03-15','573','Irure laudantium qu',0.00,'Xaviera','Kylan Alvarado','Porter','956','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(70,31,'Adult','Female','2009-04-25','418','Nihil ut tempora in',0.00,'Yvonne','Yardley Tran','Cotton','913','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(71,31,'Adult','Male','1974-03-14','797','Veniam et magnam do',0.00,'Connor','Martin Barr','Thompson','882','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(72,31,'Child','Male','2014-11-27','746','Voluptates dolore ex',0.00,'Wynne','Lewis Bender','Haley','599','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(73,31,'Infant','Female','2009-08-09','504','Amet quis dolore al',0.00,'Igor','Alec Jarvis','Sargent','260','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(74,31,'Infant','Female','2017-10-04','87','Et sint autem dolor',0.00,'Vanna','Noelle Downs','Gould','783','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(75,31,'Infant','Female','1998-09-20','812','Eligendi quo explica',0.00,'Blossom','Ima Vaughan','Ferguson','387','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(76,31,'Lap Infant','Male','1988-10-05','370','Veniam harum blandi',0.00,'Byron','Vera Pugh','Mitchell','558','2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(77,31,'Lap Infant','Male',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-22 05:31:23','2025-06-22 01:31:23',NULL),(78,32,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-23 00:12:41','2025-06-22 20:12:41',NULL),(79,33,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-23 16:37:07','2025-06-23 22:07:07',NULL),(80,34,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-27 18:22:15','2025-06-27 23:52:15',NULL),(81,35,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 13:53:36','2025-06-28 19:23:36',NULL),(82,36,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 13:56:53','2025-06-28 19:26:53',NULL),(83,37,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 14:44:35','2025-06-28 20:14:35',NULL),(84,38,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 14:44:44','2025-06-28 20:14:44',NULL),(85,40,'Seat Infant','Female','2013-06-16','884','Master',0.00,'Zephr','Armando Ramos','Hughes','971','2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(86,40,'Lap Infant','Female',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-28 14:46:09','2025-06-28 20:16:09',NULL),(87,45,'Seat Infant','Female','2013-06-16','884','Master',0.00,'Zephr','Armando Ramos','Hughes','971','2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(88,45,'Lap Infant','Female',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-28 14:50:15','2025-06-28 20:20:15',NULL),(91,48,'Seat Infant','Female','2013-06-16','884','Master',0.00,'Zephr','Armando Ramos','Hughes','971','2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(92,48,'Lap Infant','Female',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-28 14:51:38','2025-06-28 20:21:38',NULL),(93,51,'Child','Female','2007-10-14','349','Mr',0.00,'Melissa','Deanna Marshall','Love','635','2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(94,51,'Infant','Female','1970-09-10','175','Est illum laboris',0.00,'Yoshio','Xandra Jenkins','Cote','824','2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(95,51,'Adult','Female','2015-04-15','247','Consequatur do excep',0.00,'Elijah','Ocean Leblanc','Daniels','58','2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(96,51,'Lap Infant','Male',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-28 14:55:43','2025-06-28 20:25:43',NULL),(97,53,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 15:00:33','2025-06-28 20:30:33',NULL),(98,54,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 15:19:27','2025-06-28 20:49:27',NULL),(99,61,NULL,'Male',NULL,NULL,'Ms',0.00,NULL,NULL,NULL,NULL,'2025-06-28 15:41:54','2025-06-28 21:11:54',NULL),(100,70,'Seat Infant','Male','1992-07-15','293','Master',0.00,'Fay','Tamekah Gallagher','Gill','86','2025-06-29 13:48:24','2025-06-29 19:18:24',NULL),(101,70,'Infant','Female',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-29 13:48:24','2025-06-29 19:18:24',NULL),(102,72,'Seat Infant','Male','1992-07-15','293','Master',0.00,'Fay','Tamekah Gallagher','Gill','86','2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(103,72,'Infant','Female',NULL,NULL,NULL,0.00,NULL,NULL,NULL,NULL,'2025-06-29 13:49:32','2025-06-29 19:19:32',NULL),(104,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:44:46','2025-07-18 23:17:33','2025-07-18 23:17:33'),(105,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:44:46','2025-07-18 23:17:33','2025-07-18 23:17:33'),(106,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:44:46','2025-07-18 23:17:33','2025-07-18 23:17:33'),(107,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:44:46','2025-07-18 23:17:33','2025-07-18 23:17:33'),(108,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:47:33','2025-07-18 23:17:42','2025-07-18 23:17:42'),(109,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:47:33','2025-07-18 23:17:42','2025-07-18 23:17:42'),(110,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:47:33','2025-07-18 23:17:42','2025-07-18 23:17:42'),(111,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:47:33','2025-07-18 23:17:42','2025-07-18 23:17:42'),(112,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:47:42','2025-07-18 23:19:12','2025-07-18 23:19:12'),(113,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:47:42','2025-07-18 23:19:12','2025-07-18 23:19:12'),(114,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:47:42','2025-07-18 23:19:12','2025-07-18 23:19:12'),(115,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:47:42','2025-07-18 23:19:12','2025-07-18 23:19:12'),(116,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:49:12','2025-07-18 23:19:32','2025-07-18 23:19:32'),(117,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:49:12','2025-07-18 23:19:32','2025-07-18 23:19:32'),(118,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:49:12','2025-07-18 23:19:32','2025-07-18 23:19:32'),(119,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:49:12','2025-07-18 23:19:32','2025-07-18 23:19:32'),(120,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:49:32','2025-07-18 23:21:00','2025-07-18 23:21:00'),(121,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:49:32','2025-07-18 23:21:00','2025-07-18 23:21:00'),(122,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:49:32','2025-07-18 23:21:00','2025-07-18 23:21:00'),(123,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:49:32','2025-07-18 23:21:00','2025-07-18 23:21:00'),(124,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:51:00','2025-07-18 23:25:04','2025-07-18 23:25:04'),(125,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:51:00','2025-07-18 23:25:04','2025-07-18 23:25:04'),(126,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:51:00','2025-07-18 23:25:04','2025-07-18 23:25:04'),(127,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:51:00','2025-07-18 23:25:04','2025-07-18 23:25:04'),(128,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:55:04','2025-07-18 23:28:02','2025-07-18 23:28:02'),(129,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:55:04','2025-07-18 23:28:02','2025-07-18 23:28:02'),(130,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:55:04','2025-07-18 23:28:02','2025-07-18 23:28:02'),(131,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:55:04','2025-07-18 23:28:02','2025-07-18 23:28:02'),(132,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 17:58:02','2025-07-18 23:30:50','2025-07-18 23:30:50'),(133,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 17:58:02','2025-07-18 23:30:50','2025-07-18 23:30:50'),(134,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 17:58:02','2025-07-18 23:30:50','2025-07-18 23:30:50'),(135,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 17:58:02','2025-07-18 23:30:50','2025-07-18 23:30:50'),(136,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:00:50','2025-07-18 23:36:32','2025-07-18 23:36:32'),(137,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:00:50','2025-07-18 23:36:32','2025-07-18 23:36:32'),(138,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:00:50','2025-07-18 23:36:32','2025-07-18 23:36:32'),(139,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:00:50','2025-07-18 23:36:32','2025-07-18 23:36:32'),(140,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:06:32','2025-07-18 23:37:12','2025-07-18 23:37:12'),(141,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:06:32','2025-07-18 23:37:12','2025-07-18 23:37:12'),(142,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:06:32','2025-07-18 23:37:12','2025-07-18 23:37:12'),(143,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:06:32','2025-07-18 23:37:12','2025-07-18 23:37:12'),(144,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:07:12','2025-07-18 23:38:33','2025-07-18 23:38:33'),(145,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:07:12','2025-07-18 23:38:33','2025-07-18 23:38:33'),(146,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:07:12','2025-07-18 23:38:33','2025-07-18 23:38:33'),(147,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:07:12','2025-07-18 23:38:33','2025-07-18 23:38:33'),(148,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:08:33','2025-07-18 23:39:03','2025-07-18 23:39:03'),(149,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:08:33','2025-07-18 23:39:03','2025-07-18 23:39:03'),(150,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:08:33','2025-07-18 23:39:03','2025-07-18 23:39:03'),(151,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:08:33','2025-07-18 23:39:03','2025-07-18 23:39:03'),(152,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:09:03','2025-07-18 23:40:52','2025-07-18 23:40:52'),(153,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:09:03','2025-07-18 23:40:52','2025-07-18 23:40:52'),(154,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:09:03','2025-07-18 23:40:52','2025-07-18 23:40:52'),(155,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:09:03','2025-07-18 23:40:52','2025-07-18 23:40:52'),(156,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:10:52','2025-07-18 23:45:20','2025-07-18 23:45:20'),(157,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:10:52','2025-07-18 23:45:20','2025-07-18 23:45:20'),(158,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:10:52','2025-07-18 23:45:20','2025-07-18 23:45:20'),(159,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:10:52','2025-07-18 23:45:20','2025-07-18 23:45:20'),(160,73,'Infant','Female','2008-07-18',NULL,'Ms',0.00,'Beatrice','Ashton Parker','Reynolds',NULL,'2025-07-18 18:15:20','2025-07-18 23:45:20',NULL),(161,73,'Adult','Female','1985-02-13',NULL,'Ms',0.00,'Cody','Akeem Mckay','Slater',NULL,'2025-07-18 18:15:20','2025-07-18 23:45:20',NULL),(162,73,'Adult','Male','2013-01-03',NULL,'Mr',0.00,'Robin','Miriam Fox','Carey',NULL,'2025-07-18 18:15:20','2025-07-18 23:45:20',NULL),(163,73,'Child','Male','1976-09-26',NULL,'Mrs',0.00,'Serena','Alika Velasquez','Roberts',NULL,'2025-07-18 18:15:20','2025-07-18 23:45:20',NULL),(164,75,'Adult','Male','2025-07-28','d','Mr',0.00,'fggfdgd','dfdfdfd','dfdfd',NULL,'2025-07-20 13:45:28','2025-07-29 21:28:07',NULL),(165,68,'Adult','Female','1973-03-05',NULL,'Ms',0.00,'Chanda','Alexis Sampson','Irwin',NULL,'2025-07-27 15:18:04','2025-07-27 20:48:04',NULL),(166,64,'Infant','Female','2017-08-08',NULL,'Miss',0.00,'Mia','Britanney Warner','Byrd',NULL,'2025-07-27 20:49:01','2025-07-28 02:19:01',NULL);
/*!40000 ALTER TABLE `travel_passengers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_pricing_details`
--

DROP TABLE IF EXISTS `travel_pricing_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_pricing_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `passenger_type` varchar(255) DEFAULT NULL,
  `num_passengers` int DEFAULT NULL,
  `gross_price` decimal(10,2) DEFAULT NULL,
  `net_price` decimal(10,2) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_travel_pricing_details_booking_id` (`booking_id`),
  CONSTRAINT `fk_travel_pricing_details_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_pricing_details`
--

LOCK TABLES `travel_pricing_details` WRITE;
/*!40000 ALTER TABLE `travel_pricing_details` DISABLE KEYS */;
INSERT INTO `travel_pricing_details` VALUES (21,73,'adult',1,1.00,1.00,'merchant_fee',NULL,'2025-07-18 18:15:20','2025-07-18 18:15:20'),(22,73,'child',12,122.00,12.00,'merchant_fee',NULL,'2025-07-18 18:15:20','2025-07-18 18:15:20'),(93,68,'adult',1,1.00,1.00,'ticket_cost',NULL,'2025-07-27 18:27:18','2025-07-27 18:27:18'),(94,64,'infant_on_seat',62,361.00,753.00,'merchant_fee',NULL,'2025-07-27 20:49:01','2025-07-27 20:49:01'),(95,64,'child',56,663.00,475.00,'ticket_cost',NULL,'2025-07-27 20:49:01','2025-07-27 20:49:01'),(128,75,'adult',1,800.00,1.00,'ticket_cost',NULL,'2025-07-30 18:27:11','2025-07-30 18:27:11'),(129,75,'adult',45,455.00,45.00,'ticket_cost',NULL,'2025-07-30 18:27:11','2025-07-30 18:27:11');
/*!40000 ALTER TABLE `travel_pricing_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_quality_feedback`
--

DROP TABLE IF EXISTS `travel_quality_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_quality_feedback` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `booking_id` bigint unsigned NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `note` text,
  `marks` varchar(255) DEFAULT NULL,
  `quality` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  KEY `travel_quality_feedback_user_id_foreign` (`user_id`),
  CONSTRAINT `travel_quality_feedback_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `travel_bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `travel_quality_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_quality_feedback`
--

LOCK TABLES `travel_quality_feedback` WRITE;
/*!40000 ALTER TABLE `travel_quality_feedback` DISABLE KEYS */;
INSERT INTO `travel_quality_feedback` VALUES (1,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:48:55','2025-07-30 21:48:55','Call Opening','AAA','5','non_fatal'),(2,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Call Closing','BBB','5','non_fatal'),(3,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Probing','CCC','5','non_fatal'),(4,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Parapharsing','DDD','5','non_fatal'),(5,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Dead air/Hold','EEE','5','non_fatal'),(6,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Currency','FFF','5','non_fatal'),(7,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Cold/Blind Transfer','GGG','5','non_fatal'),(8,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'E-Tickets','HHH','5','non_fatal'),(9,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Active Listening','JJJ','10','non_fatal'),(10,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Rebuttals/Objection Handling','kkk','10','non_fatal'),(11,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Call Handling','lll','10','non_fatal'),(12,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Selling Skills','MMM','10','non_fatal'),(13,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Cross Selling (HCIL)','NNN','10','non_fatal'),(14,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Itinerary Recapping/Call Summary','OOO','10','non_fatal'),(15,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Hold Procedure','PPP','0','fatal'),(16,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Misrepresentation','QQQ','0','fatal'),(17,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Rude/Sarcastic behaviour','RRR','0','fatal'),(18,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Screenshot of services provided','SSS','0','fatal'),(19,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Merchant Name','TTT','0','fatal'),(20,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Split Charges','UUU','0','fatal'),(21,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Suspicious Customer','VVV','0','fatal'),(22,1,75,NULL,'2025-07-30 16:15:44','2025-07-30 21:45:44',NULL,'Force Sell','ZZZ','0','fatal');
/*!40000 ALTER TABLE `travel_quality_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_screenshots`
--

DROP TABLE IF EXISTS `travel_screenshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_screenshots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
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

LOCK TABLES `travel_screenshots` WRITE;
/*!40000 ALTER TABLE `travel_screenshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_screenshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_sector_details`
--

DROP TABLE IF EXISTS `travel_sector_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_sector_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
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

LOCK TABLES `travel_sector_details` WRITE;
/*!40000 ALTER TABLE `travel_sector_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_sector_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_train_details`
--

DROP TABLE IF EXISTS `travel_train_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_train_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `direction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `train_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_station` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_hours` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_minutes` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_station` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_hours` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_minutes` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_train_details`
--

LOCK TABLES `travel_train_details` WRITE;
/*!40000 ALTER TABLE `travel_train_details` DISABLE KEYS */;
INSERT INTO `travel_train_details` VALUES (1,75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-07-20 13:45:28','2025-07-20 13:45:28',NULL);
/*!40000 ALTER TABLE `travel_train_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_shift_assignments`
--

DROP TABLE IF EXISTS `user_shift_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_shift_assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `shift_id` bigint unsigned NOT NULL,
  `effective_from` date NOT NULL,
  `effective_to` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_shift_assignments_user_id_foreign` (`user_id`),
  KEY `user_shift_assignments_shift_id_foreign` (`shift_id`),
  CONSTRAINT `user_shift_assignments_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_shift_assignments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_shift_assignments`
--

LOCK TABLES `user_shift_assignments` WRITE;
/*!40000 ALTER TABLE `user_shift_assignments` DISABLE KEYS */;
INSERT INTO `user_shift_assignments` VALUES (1,3,2,'2025-07-11',NULL,'2025-07-11 15:27:42','2025-07-11 15:27:42'),(2,2,1,'2025-07-11','2025-07-11','2025-07-11 15:39:46','2025-07-11 15:42:26'),(3,2,2,'2025-07-11',NULL,'2025-07-11 15:42:26','2025-07-11 15:42:26'),(4,4,1,'2025-07-11',NULL,'2025-07-11 15:52:29','2025-07-11 15:52:29'),(5,1,2,'2025-07-20',NULL,'2025-07-20 16:18:21','2025-07-20 16:18:21');
/*!40000 ALTER TABLE `user_shift_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_team_assignments`
--

DROP TABLE IF EXISTS `user_team_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_team_assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `team_id` bigint unsigned NOT NULL,
  `effective_from` date NOT NULL,
  `effective_to` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_team_assignments_user_id_foreign` (`user_id`),
  KEY `user_team_assignments_team_id_foreign` (`team_id`),
  CONSTRAINT `user_team_assignments_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_team_assignments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_team_assignments`
--

LOCK TABLES `user_team_assignments` WRITE;
/*!40000 ALTER TABLE `user_team_assignments` DISABLE KEYS */;
INSERT INTO `user_team_assignments` VALUES (1,2,1,'2025-07-11','2025-07-11','2025-07-11 15:21:40','2025-07-11 15:24:19'),(2,2,1,'2025-07-11','2025-07-11','2025-07-11 15:24:19','2025-07-11 15:34:00'),(3,3,1,'2025-07-11','2025-07-11','2025-07-11 15:27:03','2025-07-11 15:28:07'),(4,3,1,'2025-07-11','2025-07-11','2025-07-11 15:28:07','2025-07-11 15:41:28'),(5,2,1,'2025-07-11',NULL,'2025-07-11 15:34:00','2025-07-11 15:34:00'),(6,3,5,'2025-07-11','2025-07-11','2025-07-11 15:41:28','2025-07-11 15:51:13'),(7,4,6,'2025-07-11',NULL,'2025-07-11 15:41:34','2025-07-11 15:41:34'),(8,3,1,'2025-07-11',NULL,'2025-07-11 15:51:13','2025-07-11 15:51:13'),(9,1,1,'2025-07-20',NULL,'2025-07-20 16:16:09','2025-07-20 16:16:09');
/*!40000 ALTER TABLE `user_team_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `departments` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Admin','admin@example.com','dasdsad',NULL,'$2y$12$XoVEIFSeOdrD.E7SW.JtveKCRx9oXU1rCdqVkrX.NoXG1GLvldk62',NULL,'xEH2jarG81aoQvodS3GTig5kakf7hryoKhHuWiMITyEiDfOhNz1LWi5IoWzT',1,'2025-04-24 17:05:20','2025-04-24 17:05:20','0',NULL),(2,'Agent','user1','user1@gmail.com',NULL,NULL,'$2y$12$QjGoMnbGoiFSxJvnro3g.OnOL/k7AnvpreW12HdLsaWPaDhgoFx4.','profile_pictures/xZfZg7LtSuWyBBSccc32aaecvAXRkkQQo9TMK3QL.png',NULL,1,'2025-06-27 14:35:16','2025-07-11 15:56:21','8956235896','Changes'),(3,'agent','user2@gmail.com','user2@gmail.com',NULL,NULL,'$2y$12$cRM6WB3FTguiPg.kcAW24ukInljxEMJxCkc5syuoUHj/Tal.Th3iK',NULL,NULL,1,'2025-06-27 14:35:36','2025-06-27 14:35:36','7894561230','Quality'),(4,'Manager','Victor Lee ETST','cahef@mailinator.com',NULL,NULL,'$2y$12$SoLnAS1CgLC0wfEGs47DnOzF0N3v6TiwZGa332k0K7RcHZVVmAOCe',NULL,NULL,1,'2025-07-11 13:49:19','2025-07-11 14:46:09','+1 (389) 103-9027','CCV');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-31  8:18:52
