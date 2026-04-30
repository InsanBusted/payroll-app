-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: payroll
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Ciracas',NULL,'2026-04-28 13:25:00','2026-04-29 15:48:02'),(2,'Citeureup',NULL,'2026-04-28 13:25:00','2026-04-29 15:48:17'),(3,'Metland 1',NULL,'2026-04-28 13:25:00','2026-04-29 15:48:27'),(4,'Cilangkap',NULL,'2026-04-28 13:25:00','2026-04-29 15:48:37'),(5,'Kota Wisata',NULL,'2026-04-29 15:48:47','2026-04-29 15:48:47'),(6,'Metland 2',NULL,'2026-04-29 15:48:56','2026-04-29 15:48:56'),(7,'Pitara',NULL,'2026-04-29 15:49:10','2026-04-29 15:49:10'),(8,'Gas Alam',NULL,'2026-04-29 15:49:21','2026-04-29 15:49:21'),(9,'Sawangan',NULL,'2026-04-29 15:49:33','2026-04-29 15:49:33'),(10,'Cibinong',NULL,'2026-04-29 15:49:46','2026-04-29 16:13:30');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `employee_kinerjas`
--

DROP TABLE IF EXISTS `employee_kinerjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_kinerjas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint unsigned NOT NULL,
  `periode` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Format: YYYY-MM',
  `total_hadir` int NOT NULL DEFAULT '0',
  `tunjangan_groom` int NOT NULL DEFAULT '0',
  `srp` int NOT NULL DEFAULT '0',
  `grosir` int NOT NULL DEFAULT '0',
  `aksesoris` int NOT NULL DEFAULT '0',
  `bonus` int NOT NULL DEFAULT '0' COMMENT 'Bonus tambahan (Nominal)',
  `bpjstk` int NOT NULL DEFAULT '0',
  `absensi` int NOT NULL DEFAULT '0',
  `pph21` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_kinerjas_employee_id_periode_unique` (`employee_id`,`periode`),
  CONSTRAINT `employee_kinerjas_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_kinerjas`
--

LOCK TABLES `employee_kinerjas` WRITE;
/*!40000 ALTER TABLE `employee_kinerjas` DISABLE KEYS */;
INSERT INTO `employee_kinerjas` VALUES (249,3,'2026-04',27,18,15,3,25,0,0,1,0,'2026-04-29 18:05:59','2026-04-29 18:05:59'),(250,4,'2026-04',27,20,16,7,28,500000,0,2,0,'2026-04-29 18:05:59','2026-04-29 18:05:59'),(251,5,'2026-04',26,20,4,2,1,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(252,6,'2026-04',26,24,9,4,14,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(253,7,'2026-04',26,15,12,8,17,500000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(254,8,'2026-04',21,20,13,6,8,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(255,9,'2026-04',26,18,16,5,34,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(256,10,'2026-04',27,24,8,7,27,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(257,11,'2026-04',26,23,1,18,19,500000,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(258,12,'2026-04',26,22,17,3,11,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(259,13,'2026-04',26,16,18,11,24,500000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(260,14,'2026-04',29,18,4,2,1,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(261,15,'2026-04',27,20,16,3,8,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(262,16,'2026-04',23,20,30,21,39,1000000,0,4,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(263,17,'2026-04',29,22,38,17,79,1000000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(264,18,'2026-04',20,21,12,7,20,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(265,19,'2026-04',25,18,18,11,24,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(266,20,'2026-04',27,22,15,3,25,0,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(267,21,'2026-04',26,19,7,8,24,500000,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(268,22,'2026-04',27,22,22,8,19,500000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(269,23,'2026-04',26,23,13,7,32,500000,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(270,24,'2026-04',27,24,16,7,28,500000,0,3,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(271,25,'2026-04',26,20,6,2,3,0,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(272,26,'2026-04',26,22,21,13,51,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(273,27,'2026-04',29,21,6,3,8,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(274,28,'2026-04',30,17,12,7,20,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(275,29,'2026-04',25,22,38,17,79,1000000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(276,30,'2026-04',28,18,18,11,24,500000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(277,31,'2026-04',28,19,10,10,15,500000,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(278,32,'2026-04',24,22,2,2,1,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(279,33,'2026-04',27,18,11,10,13,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(280,34,'2026-04',25,16,7,8,24,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(281,35,'2026-04',23,17,3,6,6,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(282,36,'2026-04',22,18,18,11,24,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(283,37,'2026-04',22,19,22,8,19,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(284,38,'2026-04',25,15,16,7,28,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(285,39,'2026-04',26,14,1,18,19,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(286,40,'2026-04',27,21,13,7,32,500000,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(287,41,'2026-04',25,21,7,8,24,500000,0,3,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(288,42,'2026-04',27,24,21,13,51,500000,0,3,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(289,43,'2026-04',26,22,22,8,19,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(290,44,'2026-04',25,21,12,8,17,500000,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(291,45,'2026-04',30,19,18,11,24,500000,0,3,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(292,46,'2026-04',25,20,16,5,34,500000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(293,47,'2026-04',26,19,9,4,14,0,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(294,48,'2026-04',28,19,11,10,13,500000,0,2,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(295,49,'2026-04',27,20,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(296,50,'2026-04',27,25,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(297,51,'2026-04',27,22,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(298,52,'2026-04',27,20,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(299,53,'2026-04',26,22,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(300,54,'2026-04',28,18,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(301,55,'2026-04',28,17,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(302,56,'2026-04',28,23,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(303,57,'2026-04',26,26,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(304,58,'2026-04',25,25,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(305,59,'2026-04',27,27,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(306,60,'2026-04',27,0,0,0,0,0,0,1,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(307,61,'2026-04',27,0,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(308,62,'2026-04',25,0,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00'),(309,63,'2026-04',27,0,0,0,0,0,0,0,0,'2026-04-29 18:06:00','2026-04-29 18:06:00');
/*!40000 ALTER TABLE `employee_kinerjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_id` bigint unsigned DEFAULT NULL,
  `area_id` bigint unsigned DEFAULT NULL,
  `ptkp_status_id` bigint unsigned DEFAULT NULL,
  `no_rek_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path file tanda tangan digital untuk keperluan export PDF/slip',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_nik_unique` (`nik`),
  KEY `employees_user_id_foreign` (`user_id`),
  KEY `employees_jabatan_id_foreign` (`jabatan_id`),
  KEY `employees_area_id_foreign` (`area_id`),
  KEY `employees_ptkp_status_id_foreign` (`ptkp_status_id`),
  CONSTRAINT `employees_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_ptkp_status_id_foreign` FOREIGN KEY (`ptkp_status_id`) REFERENCES `ptkp_statuses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,3,'EMP001','Finance Staff',2,1,NULL,'1234567890','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-28 13:25:01'),(2,4,'EMP002','Budi Santoso',3,3,NULL,'0987654321','Mandiri','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-28 13:25:01'),(3,5,'MMT/JNT-014/01/0724','AGUS INSANI',1,1,1,'1020013746034','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:05:59'),(4,6,'MMT/JNT-013/01/0724','AHMAD IMAM SYAFEI',1,1,1,'1020013746026','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:05:59'),(5,7,'MMT/SA-609/21/0325','AHMAD RAMZI',1,1,1,'5726193947','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:05:59'),(6,8,'MMT/SA-698/17/0925','CHINTHYA RETMITA LARAS',1,2,6,'1663626896','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(7,9,'MMT/SA-682/14/0825','EPA KURNIA',1,2,1,'5727057931','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(8,10,'MMT/JNE-026/09/1225','GALIH HARDIANTO RAMADANI',1,2,1,'1020013837379','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(9,11,'MMT/SA-406/18/0124','M. BUKHORI A',1,2,1,'5725779612','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(10,12,'MMT/SA-632/22/0525','M. RIZKI NURFAHMI',1,2,1,'4062242969','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(11,13,'MMT/SA-327/05/1023','MOHAMAD ZAELANI',1,3,1,'8410697531','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(12,14,'MMT/SA-715/11/1025','MONALISA',1,3,7,'5720533083','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(13,15,'MMT/SA-501/23/0624','MUHAMAD FAISAL',1,4,1,'5726130210','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(14,16,'MMT/JNE-024/12/1025','MUHAMAD SOLEH',1,4,1,'1020013744500','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(15,17,'MMT/JNT-004/01/0924','MUHAMMAD BAYU ADAM',1,4,1,'1020013744583','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(16,18,'MMT/SA-640/09/0625','MUHAMMAD FIKRAM ALFARIZA',1,5,1,'1663615835','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(17,19,'MMT/SA-584/28/1224','MUHAMMAD HABIBI THAMRIN',1,5,1,'4062181331','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(18,20,'MMT/ARC-007/07/1020','REYNALDI AHMAD DARMAWAN',1,5,7,'7651057195','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(19,21,'MMT/SA-700/21/0925','REYSHA AIDIL PRATAMA',1,5,1,'5677126677','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(20,22,'MMT/SA-196/07/0123','RISKI KURNIAWAN',1,5,1,'5721257852','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(21,23,'MMT/FL-029/10/1121','RYAWAN RUSWAN',1,6,8,'7275250333','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(22,24,'MMT/JNT-019/13/0325','SAIPUL IMRON',1,6,1,'1020013744575','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(23,25,'MMT/SA-706/06/1025','SASYA NURSHAKILA',1,6,1,'5726334699','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(24,26,'MMT/SH-014/16/1120','SEVRI NANDA',1,6,8,'7151441746','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(25,27,'MMT/SA-132/04/0922','VERONICA OCTADYANINGTYAS',1,6,6,'4061623269','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(26,28,'MMT/SA-624/09/0525','WILDAN ALIV MONDRIAN',1,7,1,'4061938723','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(27,29,'MMT/JNT-001/01/0623','ALI REZA ADAMY',1,7,8,'1020013744534','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(28,30,'MMT/SA-716/11/1025','KANDAR',1,7,1,'1020013744567','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(29,31,'MMT/SA-588/19/1025','ASRI HANDAYANI',1,7,3,'6282491423','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(30,32,'MMT/SA-728/02/1125','M. HARITSYAH',1,7,3,'1020013744526','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(31,33,'MMT/SA-433/02/1125','MUHAMAD KODRI',1,8,3,'4061928884','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(32,34,'MMT/SA-731/11/1125','ELSA FITRI',1,8,1,'7475455274','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(33,35,'MMT/SA-732/17/1125','NIA YUNIA',1,8,1,'6282636677','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(34,36,'MMT/SA-734/18/1125','MARTINUS RISWANTO GULTOM',1,8,1,'8411085031','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(35,37,'MMT/SA-736/24/1125','RINI NURLAELA',1,9,1,'5865611592','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(36,38,'0','REVIADAM MAULANA ZEIN',1,9,1,'2040448813','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(37,39,'MMT/SA-711/09/1025','NAZWA LUTFIAH GUNTUR',1,4,1,'5726331070','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(38,40,'1','ARI GUNAWAN',1,4,1,'0','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(39,41,'MMT/SA-739/29/1125','TIARA APRIANTI',1,4,1,'1671377562','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(40,42,'MMT/SA-710/09/1025','FAHRI IRSADUL IBAD',1,3,1,'5726330952','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(41,43,'MMT/SA-726/01/1225','ANDRA KURNIAWAN',1,3,1,'1652710551','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(42,44,'MMT/SA-237/02/0423','MALVIN VALERIAN',2,3,1,'4061777631','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(43,45,'MMT/FL-026/27/0721','ALSYA RISMADANI',2,1,3,'6281452743','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(44,46,'MMT/SA-582/20/1224','ANDIKA',2,10,6,'5465548433','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(45,47,'MMT/SA-616/08/0425','ANDRIAN TARUMA SELEJ',2,10,1,'8770775125','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(46,48,'MMT/SA-592/16/0125','IKMAL AKBAR',2,4,3,'3521381009','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(47,49,'MMT/DS-348/01/0223','HERLAN',2,3,7,'6830931510','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:01','2026-04-29 18:06:00'),(48,50,'MMT/SA-613/07/0425','KHEIZA KURNIAWAN',2,3,1,'7370751786','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(49,51,'MMT/SA-740/29/1125','HARJIYANTO',3,4,3,'5721817459','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(50,52,'MMT/SA-741/08/1225','ANGGA KUSUMA',3,4,1,'5029649140','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(51,53,'MMT/SA-742/08/1225','FADHIL ANHAR',3,4,1,'1020013842866','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(52,54,'MMT/SA-679/13/0825','DEASY NURAENI',4,4,1,'5727049075','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(53,55,'MMT/JNT-027/10/1225','EGI PRAYOGA',4,4,1,'1020013837361','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(54,56,'MMT/JNT-025/02/1125','ANGGI ADE IRAWAN',6,4,1,'1020013744542','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(55,57,'MMT/SA-708/09/1025','ARYA RAMADHANI',6,4,1,'5726330944','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(56,58,'MMT/JNT-011/01/0624','BASKORO BINA NUSWANTORO',6,4,6,'1020013762320','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(57,59,'MMT/SA-735/21/1125','ROSYADAH NURAZIZAH',7,4,1,'7475455266','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(58,60,'MMT/SA-738/24/1125','CHINDY IKA HARTATI',7,4,1,'1663454866','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(59,61,'MMT/SA-737/24/1125','RISQI FEBRIANI',7,4,1,'5466061014','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(60,62,'MMT/SA-640/01/1023','ALI AKBAR',8,4,1,'0','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(61,63,'MMT/SA-662/02/1123','SELA ANINDITA',9,4,6,'0','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(62,64,'MMT/SA-/553/02/0923','LINGGA RAMADHAN',10,4,3,'0','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00'),(63,65,'MMT/SA-/404/01/0822','ZAHRA SABRINA',5,4,1,'0','BCA','signatures/R9LFcSRYCodrT4Ezkw8wlgcHdqvCnLmxBHdAJhWp.jpg','2026-04-28 13:25:02','2026-04-29 18:06:00');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `jabatans`
--

DROP TABLE IF EXISTS `jabatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jabatans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jabatans_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatans`
--

LOCK TABLES `jabatans` WRITE;
/*!40000 ALTER TABLE `jabatans` DISABLE KEYS */;
INSERT INTO `jabatans` VALUES (1,'Sales','Sales','2026-04-28 13:25:00','2026-04-29 15:42:55'),(2,'Kepala Toko',NULL,'2026-04-28 13:25:00','2026-04-29 15:43:09'),(3,'Teknisi',NULL,'2026-04-28 13:25:00','2026-04-29 15:43:22'),(4,'Gudang',NULL,'2026-04-28 13:25:00','2026-04-29 15:43:33'),(5,'HRD','Pengelola sumber daya manusia','2026-04-28 13:25:00','2026-04-28 13:25:00'),(6,'Driver',NULL,'2026-04-29 15:43:44','2026-04-29 15:43:44'),(7,'Office',NULL,'2026-04-29 15:43:50','2026-04-29 15:43:50'),(8,'Manager Area',NULL,'2026-04-29 15:44:11','2026-04-29 15:44:11'),(9,'Kepala Back Office',NULL,'2026-04-29 15:44:24','2026-04-29 15:44:24'),(10,'Kepala Teknisi',NULL,'2026-04-29 15:44:29','2026-04-29 15:44:29');
/*!40000 ALTER TABLE `jabatans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_28_202107_create_setting_gajis_table',1),(5,'2026_04_29_000001_create_roles_table',1),(6,'2026_04_29_000002_add_role_id_to_users_table',1),(7,'2026_04_29_000003_create_jabatans_table',1),(8,'2026_04_29_000004_create_areas_table',1),(9,'2026_04_29_000005_create_employees_table',1),(10,'2026_04_29_000006_add_signature_to_employees_table',1),(11,'2026_04_29_000007_create_employee_kinerjas_table',1),(12,'2026_04_29_235748_create_ptkp_categories_table',2),(13,'2026_04_29_235835_create_ptkp_statuses_table',2),(14,'2026_04_30_000033_create_ter_rates_table',2),(15,'2026_04_30_000928_add_ptkp_status_id_to_employees_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ptkp_categories`
--

DROP TABLE IF EXISTS `ptkp_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ptkp_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ptkp_categories_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptkp_categories`
--

LOCK TABLES `ptkp_categories` WRITE;
/*!40000 ALTER TABLE `ptkp_categories` DISABLE KEYS */;
INSERT INTO `ptkp_categories` VALUES (1,'A','TK/0, TK/1, K/0',NULL,NULL),(2,'B','TK/2, TK/3, K/1, K/2',NULL,NULL),(3,'C','K/3',NULL,NULL);
/*!40000 ALTER TABLE `ptkp_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptkp_statuses`
--

DROP TABLE IF EXISTS `ptkp_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ptkp_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ptkp_statuses_status_unique` (`status`),
  KEY `ptkp_statuses_category_id_foreign` (`category_id`),
  CONSTRAINT `ptkp_statuses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ptkp_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptkp_statuses`
--

LOCK TABLES `ptkp_statuses` WRITE;
/*!40000 ALTER TABLE `ptkp_statuses` DISABLE KEYS */;
INSERT INTO `ptkp_statuses` VALUES (1,'TK/0',1,NULL,NULL),(2,'TK/1',1,NULL,NULL),(3,'K/0',1,NULL,NULL),(4,'TK/2',2,NULL,NULL),(5,'TK/3',2,NULL,NULL),(6,'K/1',2,NULL,NULL),(7,'K/2',2,NULL,NULL),(8,'K/3',3,NULL,NULL);
/*!40000 ALTER TABLE `ptkp_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','Super Admin','Full system access including user management','2026-04-28 13:25:00','2026-04-28 13:25:00'),(2,'admin','Administrator','Full access to all modules','2026-04-28 13:25:00','2026-04-28 13:25:00'),(3,'finance','Finance','Manages payroll and salary reports','2026-04-28 13:25:00','2026-04-28 13:25:00'),(4,'staff','Staff','Can view own salary slips','2026-04-28 13:25:00','2026-04-29 17:29:18');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('OxwVAf2cVWBzCfR1Aq2oEyzHjS57E2gmGZtDxFI3',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI3eW9IUm91ZjAySWpkOUZmRjYwODdnVGF1UGNGQWpPRENYcjYzclBpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zZXR0aW5nLWdhamkiLCJyb3V0ZSI6InNldHRpbmdfZ2FqaS5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==',1777513640),('vajpQmtfCOEh7a7C3UYOdkW8WrFVWgz5URFHdfyw',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJoZDl4aWt1Z1FyT0p1aEpIcU9JWm14Rk5KQ3RPVWxCYklkQXBMMXNaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9wcm9maWxlIiwicm91dGUiOiJwcm9maWxlLmVkaXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NX0=',1777513652);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_gajis`
--

DROP TABLE IF EXISTS `setting_gajis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting_gajis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rate_gaji_pokok` int NOT NULL DEFAULT '30000' COMMENT 'Rate per hari hadir',
  `rate_tunjangan_groom` int NOT NULL DEFAULT '10000' COMMENT 'Rate per point tunjangan groom',
  `rate_srp` int NOT NULL DEFAULT '30000' COMMENT 'Rate per point SRP',
  `rate_grosir` int NOT NULL DEFAULT '10000' COMMENT 'Rate per point Grosir',
  `rate_aksesoris` int NOT NULL DEFAULT '5000' COMMENT 'Rate per point Aksesoris',
  `potongan_bpjstk` int NOT NULL DEFAULT '50000' COMMENT 'Potongan tetap BPJSTK',
  `potongan_absensi` int NOT NULL DEFAULT '10000' COMMENT 'Potongan per hari absen/telat',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_gajis`
--

LOCK TABLES `setting_gajis` WRITE;
/*!40000 ALTER TABLE `setting_gajis` DISABLE KEYS */;
INSERT INTO `setting_gajis` VALUES (2,30000,10000,30000,10000,5000,50000,10000,'2026-04-29 16:37:37','2026-04-29 18:47:20');
/*!40000 ALTER TABLE `setting_gajis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ter_rates`
--

DROP TABLE IF EXISTS `ter_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ter_rates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `min_salary` bigint NOT NULL,
  `max_salary` bigint DEFAULT NULL,
  `rate` decimal(8,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ter_rates_category_id_foreign` (`category_id`),
  CONSTRAINT `ter_rates_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ptkp_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ter_rates`
--

LOCK TABLES `ter_rates` WRITE;
/*!40000 ALTER TABLE `ter_rates` DISABLE KEYS */;
INSERT INTO `ter_rates` VALUES (1,1,0,5400000,0.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(2,1,5400001,5650000,0.2500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(3,1,5650001,5950000,0.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(4,1,5950001,6300000,0.7500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(5,1,6300001,6750000,1.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(6,1,6750001,7500000,1.2500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(7,1,7500001,8550000,1.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(8,1,8550001,9650000,1.7500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(9,1,9650001,10050000,2.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(10,1,10050001,10350000,2.2500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(11,1,10350001,10700000,2.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(12,1,10700001,11050000,3.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(13,1,11050001,11600000,3.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(14,1,11600001,12500000,4.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(15,1,12500001,13750000,5.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(16,1,13750001,15100000,6.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(17,1,15100001,16950000,7.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(18,1,16950001,19750000,8.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(19,1,19750001,24150000,9.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(20,1,24150001,26450000,10.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(21,1,26450001,28000000,11.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(22,1,28000001,30050000,12.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(23,1,30050001,32400000,13.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(24,1,32400001,35400000,14.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(25,1,35400001,39100000,15.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(26,1,39100001,43850000,16.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(27,1,43850001,47800000,17.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(28,1,47800001,51400000,18.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(29,1,51400001,56300000,19.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(30,1,56300001,62200000,20.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(31,1,62200001,68600000,21.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(32,1,68600001,77500000,22.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(33,1,77500001,89000000,23.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(34,1,89000001,103000000,24.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(35,1,103000001,125000000,25.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(36,1,125000001,157000000,26.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(37,1,157000001,206000000,27.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(38,1,206000001,337000000,28.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(39,1,337000001,454000000,29.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(40,1,454000001,550000000,30.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(41,1,550000001,695000000,31.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(42,1,695000001,910000000,32.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(43,1,910000001,1400000000,33.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(44,1,1400000001,NULL,34.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(45,2,0,6200000,0.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(46,2,6200001,6500000,0.2500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(47,2,6500001,6850000,0.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(48,2,6850001,7300000,0.7500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(49,2,7300001,9200000,1.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(50,2,9200001,10750000,1.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(51,2,10750001,11250000,2.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(52,2,11250001,11600000,2.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(53,2,11600001,12600000,3.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(54,2,12600001,13600000,4.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(55,2,13600001,14950000,5.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(56,2,14950001,16400000,6.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(57,2,16400001,18450000,7.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(58,2,18450001,21850000,8.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(59,2,21850001,26000000,9.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(60,2,26000001,27700000,10.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(61,2,27700001,29350000,11.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(62,2,29350001,31450000,12.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(63,2,31450001,33950000,13.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(64,2,33950001,37100000,14.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(65,2,37100001,41100000,15.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(66,2,41100001,45800000,16.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(67,2,45800001,49500000,17.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(68,2,49500001,53800000,18.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(69,2,53800001,58500000,19.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(70,2,58500001,64000000,20.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(71,2,64000001,71000000,21.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(72,2,71000001,80000000,22.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(73,2,80000001,93000000,23.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(74,2,93000001,109000000,24.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(75,2,109000001,129000000,25.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(76,2,129000001,163000000,26.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(77,2,163000001,211000000,27.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(78,2,211000001,374000000,28.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(79,2,374000001,459000000,29.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(80,2,459000001,555000000,30.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(81,2,555000001,704000000,31.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(82,2,704000001,957000000,32.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(83,2,957000001,1405000000,33.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(84,2,1405000001,NULL,34.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(85,3,0,6600000,0.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(86,3,6600001,6950000,0.2500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(87,3,6950001,7350000,0.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(88,3,7350001,7800000,0.7500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(89,3,7800001,8850000,1.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(90,3,8850001,9800000,1.2500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(91,3,9800001,10950000,1.5000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(92,3,10950001,11200000,1.7500,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(93,3,11200001,12050000,2.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(94,3,12050001,12950000,3.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(95,3,12950001,14150000,4.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(96,3,14150001,15550000,5.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(97,3,15550001,17050000,6.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(98,3,17050001,19500000,7.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(99,3,19500001,22700000,8.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(100,3,22700001,26600000,9.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(101,3,26600001,28100000,10.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(102,3,28100001,30100000,11.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(103,3,30100001,32600000,12.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(104,3,32600001,35400000,13.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(105,3,35400001,38900000,14.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(106,3,38900001,43000000,15.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(107,3,43000001,47400000,16.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(108,3,47400001,51200000,17.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(109,3,51200001,55800000,18.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(110,3,55800001,60400000,19.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(111,3,60400001,66700000,20.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(112,3,66700001,74500000,21.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(113,3,74500001,83200000,22.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(114,3,83200001,95600000,23.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(115,3,95600001,110000000,24.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(116,3,110000001,134000000,25.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(117,3,134000001,169000000,26.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(118,3,169000001,221000000,27.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(119,3,221000001,390000000,28.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(120,3,390000001,463000000,29.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(121,3,463000001,561000000,30.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(122,3,561000001,709000000,31.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(123,3,709000001,965000000,32.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(124,3,965000001,1419000000,33.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33'),(125,3,1419000001,NULL,34.0000,'2026-04-29 17:05:33','2026-04-29 17:05:33');
/*!40000 ALTER TABLE `ter_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','superadmin@gmail.com',1,NULL,'$2y$12$iWo3DAxHkBxNS94xcjbOvu.5kOS6nhNFwWFN6LlUsgfDk/7IxYdLy',NULL,'2026-04-28 13:25:00','2026-04-28 13:25:00'),(2,'Admin','admin@gmail.com',2,NULL,'$2y$12$x2qAJRdOfnyQOHrElNGCYOYdPj8S.9FPP5Ok/.4zSMxUu8nMlr9TG',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(3,'Finance Staff','finance@gmail.com',3,NULL,'$2y$12$QrGMhJS55J/bEALAmhnzue4RK53XRsGXq078UvEAM7pBzJwlfW9YC',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(4,'Budi Santoso','user@gmail.com',4,NULL,'$2y$12$.p6DRrMeX2UOH1xOh4AXvuqofWeP9PALyF5ht5NCvw8vl1Lda9g32',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(5,'Agus Insani','agus.insani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O','cL8pJnHrfB0fdZbVGjqJDkz5NQDjD3f5O1qXGp7jBubdBcLlh3NRe9rUR0L3','2026-04-28 13:25:01','2026-04-28 13:25:01'),(6,'Ahmad Imam Syafei','ahmad.imam.syafei@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(7,'Ahmad Ramzi','ahmad.ramzi@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(8,'Chinthya Retmita Laras','chinthya.retmita.laras@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(9,'Epa Kurnia','epa.kurnia@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(10,'Galih Hardianto Ramadani','galih.hardianto.ramadani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(11,'M. Bukhori A','m.bukhori.a@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(12,'M. Rizki Nurfahmi','m.rizki.nurfahmi@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(13,'Mohamad Zaelani','mohamad.zaelani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(14,'Monalisa','monalisa@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(15,'Muhamad Faisal','muhamad.faisal@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(16,'Muhamad Soleh','muhamad.soleh@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(17,'Muhammad Bayu Adam','muhammad.bayu.adam@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(18,'Muhammad Fikram Alfariza','muhammad.fikram.alfariza@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(19,'Muhammad Habibi Thamrin','muhammad.habibi.thamrin@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(20,'Reynaldi Ahmad Darmawan','reynaldi.ahmad.darmawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(21,'Reysha Aidil Pratama','reysha.aidil.pratama@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(22,'Riski Kurniawan','riski.kurniawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(23,'Ryawan Ruswan','ryawan.ruswan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(24,'Saipul Imron','saipul.imron@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(25,'Sasya Nurshakila','sasya.nurshakila@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(26,'Sevri Nanda','sevri.nanda@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(27,'Veronica Octadyaningtyas','veronica.octadyaningtyas@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(28,'Wildan Aliv Mondrian','wildan.aliv.mondrian@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(29,'Ali Reza Adamy','ali.reza.adamy@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(30,'Kandar','kandar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(31,'Asri Handayani','asri.handayani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(32,'M. Haritsyah','m.haritsyah@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(33,'Muhamad Kodri','muhamad.kodri@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(34,'Elsa Fitri','elsa.fitri@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(35,'Nia Yunia','nia.yunia@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(36,'Martinus Riswanto Gultom','martinus.riswanto.gultom@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(37,'Rini Nurlaela','rini.nurlaela@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(38,'Reviadam Maulana Zein','reviadam.maulana.zein@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(39,'Nazwa Lutfiah Guntur','nazwa.lutfiah.guntur@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(40,'Ari Gunawan','ari.gunawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(41,'Tiara Aprianti','tiara.aprianti@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(42,'Fahri Irsadul Ibad','fahri.irsadul.ibad@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(43,'Andra Kurniawan','andra.kurniawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(44,'Malvin Valerian','malvin.valerian@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(45,'Alsya Rismadani','alsya.rismadani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(46,'Andika','andika@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(47,'Andrian Taruma Selej','andrian.taruma.selej@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(48,'Ikmal Akbar','ikmal.akbar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(49,'Herlan','herlan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(50,'Kheiza Kurniawan','kheiza.kurniawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(51,'Harjiyanto','harjiyanto@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(52,'Angga Kusuma','angga.kusuma@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(53,'Fadhil Anhar','fadhil.anhar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(54,'Deasy Nuraeni','deasy.nuraeni@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(55,'Egi Prayoga','egi.prayoga@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(56,'Anggi Ade Irawan','anggi.ade.irawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(57,'Arya Ramadhani','arya.ramadhani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(58,'Baskoro Bina Nuswantoro','baskoro.bina.nuswantoro@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(59,'Rosyadah Nurazizah','rosyadah.nurazizah@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(60,'Chindy Ika Hartati','chindy.ika.hartati@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(61,'Risqi Febriani','risqi.febriani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(62,'Ali Akbar','ali.akbar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(63,'Sela Anindita','sela.anindita@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(64,'Lingga Ramadhan','lingga.ramadhan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(65,'Zahra Sabrina','zahra.sabrina@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'payroll'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-30 13:48:19
