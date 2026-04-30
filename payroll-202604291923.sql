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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Jakarta Pusat','Kantor pusat','2026-04-28 13:25:00','2026-04-28 13:25:00'),(2,'Jakarta Selatan','Cabang selatan','2026-04-28 13:25:00','2026-04-28 13:25:00'),(3,'Bandung','Cabang Bandung','2026-04-28 13:25:00','2026-04-28 13:25:00'),(4,'Surabaya','Cabang Surabaya','2026-04-28 13:25:00','2026-04-28 13:25:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_kinerjas`
--

LOCK TABLES `employee_kinerjas` WRITE;
/*!40000 ALTER TABLE `employee_kinerjas` DISABLE KEYS */;
INSERT INTO `employee_kinerjas` VALUES (1,3,'2026-04',27,18,15,3,25,0,50000,1,0,'2026-04-28 13:30:44','2026-04-28 13:30:44'),(2,4,'2026-04',27,18,16,7,28,500000,50000,2,0,'2026-04-28 13:40:23','2026-04-28 13:40:23'),(3,5,'2026-04',26,20,4,2,1,0,0,0,0,'2026-04-28 13:46:20','2026-04-28 13:48:39'),(4,29,'2026-04',25,22,38,17,79,1000000,0,0,0,'2026-04-29 03:56:23','2026-04-29 03:56:23');
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
  CONSTRAINT `employees_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,3,'EMP001','Finance Staff',2,1,'1234567890','BCA',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(2,4,'EMP002','Budi Santoso',3,3,'0987654321','Mandiri',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(3,5,'MMT/JNT-014/01/0724','AGUS INSANI',NULL,NULL,'1020013746034',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(4,6,'MMT/JNT-013/01/0724','AHMAD IMAM SYAFEI',NULL,NULL,'1020013746026',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(5,7,'MMT/SA-609/21/0325','AHMAD RAMZI',NULL,NULL,'5726193947',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(6,8,'MMT/SA-698/17/0925','CHINTHYA RETMITA LARAS',NULL,NULL,'1663626896',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(7,9,'MMT/SA-682/14/0825','EPA KURNIA',NULL,NULL,'5727057931',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(8,10,'MMT/JNE-026/09/1225','GALIH HARDIANTO RAMADANI',NULL,NULL,'1020013837379',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(9,11,'MMT/SA-406/18/0124','M. BUKHORI A',NULL,NULL,'5725779612',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(10,12,'MMT/SA-632/22/0525','M. RIZKI NURFAHMI',NULL,NULL,'4062242969',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(11,13,'MMT/SA-327/05/1023','MOHAMAD ZAELANI',NULL,NULL,'8410697531',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(12,14,'MMT/SA-715/11/1025','MONALISA',NULL,NULL,'5720533083',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(13,15,'MMT/SA-501/23/0624','MUHAMAD FAISAL',NULL,NULL,'5726130210',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(14,16,'MMT/JNE-024/12/1025','MUHAMAD SOLEH',NULL,NULL,'1020013744500',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(15,17,'MMT/JNT-004/01/0924','MUHAMMAD BAYU ADAM',NULL,NULL,'1020013744583',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(16,18,'MMT/SA-640/09/0625','MUHAMMAD FIKRAM ALFARIZA',NULL,NULL,'1663615835',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(17,19,'MMT/SA-584/28/1224','MUHAMMAD HABIBI THAMRIN',NULL,NULL,'4062181331',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(18,20,'MMT/ARC-007/07/1020','REYNALDI AHMAD DARMAWAN',NULL,NULL,'7651057195',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(19,21,'MMT/SA-700/21/0925','REYSHA AIDIL PRATAMA',NULL,NULL,'5677126677',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(20,22,'MMT/SA-196/07/0123','RISKI KURNIAWAN',NULL,NULL,'5721257852',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(21,23,'MMT/FL-029/10/1121','RYAWAN RUSWAN',NULL,NULL,'7275250333',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(22,24,'MMT/JNT-019/13/0325','SAIPUL IMRON',NULL,NULL,'1020013744575',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(23,25,'MMT/SA-706/06/1025','SASYA NURSHAKILA',NULL,NULL,'5726334699',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(24,26,'MMT/SH-014/16/1120','SEVRI NANDA',NULL,NULL,'7151441746',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(25,27,'MMT/SA-132/04/0922','VERONICA OCTADYANINGTYAS',NULL,NULL,'4061623269',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(26,28,'MMT/SA-624/09/0525','WILDAN ALIV MONDRIAN',NULL,NULL,'4061938723',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(27,29,'MMT/JNT-001/01/0623','ALI REZA ADAMY',NULL,NULL,'1020013744534',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(28,30,'MMT/SA-716/11/1025','KANDAR',NULL,NULL,'1020013744567',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(29,31,'MMT/SA-588/19/1025','ASRI HANDAYANI',NULL,NULL,'6282491423',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(30,32,'MMT/SA-728/02/1125','M. HARITSYAH',NULL,NULL,'1020013744526',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(31,33,'MMT/SA-433/02/1125','MUHAMAD KODRI',NULL,NULL,'4061928884',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(32,34,'MMT/SA-731/11/1125','ELSA FITRI',NULL,NULL,'7475455274',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(33,35,'MMT/SA-732/17/1125','NIA YUNIA',NULL,NULL,'6282636677',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(34,36,'MMT/SA-734/18/1125','MARTINUS RISWANTO GULTOM',NULL,NULL,'8411085031',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(35,37,'MMT/SA-736/24/1125','RINI NURLAELA',NULL,NULL,'5865611592',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(36,38,'0','REVIADAM MAULANA ZEIN',NULL,NULL,'2040448813',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(37,39,'MMT/SA-711/09/1025','NAZWA LUTFIAH GUNTUR',NULL,NULL,'5726331070',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(38,40,'1','ARI GUNAWAN',NULL,NULL,'0',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(39,41,'MMT/SA-739/29/1125','TIARA APRIANTI',NULL,NULL,'1671377562',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(40,42,'MMT/SA-710/09/1025','FAHRI IRSADUL IBAD',NULL,NULL,'5726330952',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(41,43,'MMT/SA-726/01/1225','ANDRA KURNIAWAN',NULL,NULL,'1652710551',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(42,44,'MMT/SA-237/02/0423','MALVIN VALERIAN',NULL,NULL,'4061777631',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(43,45,'MMT/FL-026/27/0721','ALSYA RISMADANI',NULL,NULL,'6281452743',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(44,46,'MMT/SA-582/20/1224','ANDIKA',NULL,NULL,'5465548433',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(45,47,'MMT/SA-616/08/0425','ANDRIAN TARUMA SELEJ',NULL,NULL,'8770775125',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(46,48,'MMT/SA-592/16/0125','IKMAL AKBAR',NULL,NULL,'3521381009',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(47,49,'MMT/DS-348/01/0223','HERLAN',NULL,NULL,'6830931510',NULL,NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(48,50,'MMT/SA-613/07/0425','KHEIZA KURNIAWAN',NULL,NULL,'7370751786',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(49,51,'MMT/SA-740/29/1125','HARJIYANTO',NULL,NULL,'5721817459',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(50,52,'MMT/SA-741/08/1225','ANGGA KUSUMA',NULL,NULL,'5029649140',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(51,53,'MMT/SA-742/08/1225','FADHIL ANHAR',NULL,NULL,'1020013842866',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(52,54,'MMT/SA-679/13/0825','DEASY NURAENI',NULL,NULL,'5727049075',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(53,55,'MMT/JNT-027/10/1225','EGI PRAYOGA',NULL,NULL,'1020013837361',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(54,56,'MMT/JNT-025/02/1125','ANGGI ADE IRAWAN',NULL,NULL,'1020013744542',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(55,57,'MMT/SA-708/09/1025','ARYA RAMADHANI',NULL,NULL,'5726330944',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(56,58,'MMT/JNT-011/01/0624','BASKORO BINA NUSWANTORO',NULL,NULL,'1020013762320',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(57,59,'MMT/SA-735/21/1125','ROSYADAH NURAZIZAH',NULL,NULL,'7475455266',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(58,60,'MMT/SA-738/24/1125','CHINDY IKA HARTATI',NULL,NULL,'1663454866',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(59,61,'MMT/SA-737/24/1125','RISQI FEBRIANI',NULL,NULL,'5466061014',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(60,62,'MMT/SA-640/01/1023','ALI AKBAR',NULL,NULL,'0',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(61,63,'MMT/SA-662/02/1123','SELA ANINDITA',NULL,NULL,'0',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(62,64,'MMT/SA-/553/02/0923','LINGGA RAMADHAN',NULL,NULL,'0',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(63,65,'MMT/SA-/404/01/0822','ZAHRA SABRINA',NULL,NULL,'0',NULL,NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatans`
--

LOCK TABLES `jabatans` WRITE;
/*!40000 ALTER TABLE `jabatans` DISABLE KEYS */;
INSERT INTO `jabatans` VALUES (1,'Manager','Pimpinan departemen','2026-04-28 13:25:00','2026-04-28 13:25:00'),(2,'Staff Keuangan','Pengelola keuangan dan penggajian','2026-04-28 13:25:00','2026-04-28 13:25:00'),(3,'Staff Operasional','Pelaksana kegiatan operasional','2026-04-28 13:25:00','2026-04-28 13:25:00'),(4,'Supervisor','Pengawas lapangan','2026-04-28 13:25:00','2026-04-28 13:25:00'),(5,'HRD','Pengelola sumber daya manusia','2026-04-28 13:25:00','2026-04-28 13:25:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_28_202107_create_setting_gajis_table',1),(5,'2026_04_29_000001_create_roles_table',1),(6,'2026_04_29_000002_add_role_id_to_users_table',1),(7,'2026_04_29_000003_create_jabatans_table',1),(8,'2026_04_29_000004_create_areas_table',1),(9,'2026_04_29_000005_create_employees_table',1),(10,'2026_04_29_000006_add_signature_to_employees_table',1),(11,'2026_04_29_000007_create_employee_kinerjas_table',1);
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
INSERT INTO `roles` VALUES (1,'superadmin','Super Admin','Full system access including user management','2026-04-28 13:25:00','2026-04-28 13:25:00'),(2,'admin','Administrator','Full access to all modules','2026-04-28 13:25:00','2026-04-28 13:25:00'),(3,'finance','Finance','Manages payroll and salary reports','2026-04-28 13:25:00','2026-04-28 13:25:00'),(4,'employee','Employee','Can view own salary slips','2026-04-28 13:25:00','2026-04-28 13:25:00');
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
INSERT INTO `sessions` VALUES ('1nMe6u8BTHRx8AGyvwymwlFsmpDO2dClGzY1TLD3',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJKQnJOYVYzeWZmb2I1ZUQ5WDJHaWdaSTFySTBCUVhDOGV3bE9ySzVPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9raW5lcmphcyIsInJvdXRlIjoia2luZXJqYXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NX0=',1777460183),('Bue40tPPrtKD3kymj3UBGkPjb1YeQhHeb0MvLW4n',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ3WHJHU2syVnE4UXFkM3FmYU16M3h6MG5JVzUwaGpxYTBBa2FhS25NIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9raW5lcmphcyIsInJvdXRlIjoia2luZXJqYXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1777409320),('NHie4qOCVA62nZBGZwRPckuaZIKgVwgphsLI5H4Z',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJzMjBJSDFjVDJTdWRnYjRZcHF6QkowR3o5ZWZCQm15SEI4SWZLV3BhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9lbXBsb3llZXMiLCJyb3V0ZSI6ImVtcGxveWVlcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==',1777459913);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_gajis`
--

LOCK TABLES `setting_gajis` WRITE;
/*!40000 ALTER TABLE `setting_gajis` DISABLE KEYS */;
INSERT INTO `setting_gajis` VALUES (1,30000,10000,30000,10000,5000,50000,10000,'2026-04-28 13:25:02','2026-04-28 13:25:02');
/*!40000 ALTER TABLE `setting_gajis` ENABLE KEYS */;
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
INSERT INTO `users` VALUES (1,'Super Admin','superadmin@gmail.com',1,NULL,'$2y$12$iWo3DAxHkBxNS94xcjbOvu.5kOS6nhNFwWFN6LlUsgfDk/7IxYdLy',NULL,'2026-04-28 13:25:00','2026-04-28 13:25:00'),(2,'Admin','admin@gmail.com',2,NULL,'$2y$12$x2qAJRdOfnyQOHrElNGCYOYdPj8S.9FPP5Ok/.4zSMxUu8nMlr9TG',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(3,'Finance Staff','finance@gmail.com',3,NULL,'$2y$12$QrGMhJS55J/bEALAmhnzue4RK53XRsGXq078UvEAM7pBzJwlfW9YC',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(4,'Budi Santoso','user@gmail.com',4,NULL,'$2y$12$.p6DRrMeX2UOH1xOh4AXvuqofWeP9PALyF5ht5NCvw8vl1Lda9g32',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(5,'Agus Insani','agus.insani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(6,'Ahmad Imam Syafei','ahmad.imam.syafei@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(7,'Ahmad Ramzi','ahmad.ramzi@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(8,'Chinthya Retmita Laras','chinthya.retmita.laras@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(9,'Epa Kurnia','epa.kurnia@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(10,'Galih Hardianto Ramadani','galih.hardianto.ramadani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(11,'M. Bukhori A','m.bukhori.a@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(12,'M. Rizki Nurfahmi','m.rizki.nurfahmi@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(13,'Mohamad Zaelani','mohamad.zaelani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(14,'Monalisa','monalisa@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(15,'Muhamad Faisal','muhamad.faisal@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(16,'Muhamad Soleh','muhamad.soleh@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(17,'Muhammad Bayu Adam','muhammad.bayu.adam@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(18,'Muhammad Fikram Alfariza','muhammad.fikram.alfariza@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(19,'Muhammad Habibi Thamrin','muhammad.habibi.thamrin@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(20,'Reynaldi Ahmad Darmawan','reynaldi.ahmad.darmawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(21,'Reysha Aidil Pratama','reysha.aidil.pratama@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(22,'Riski Kurniawan','riski.kurniawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(23,'Ryawan Ruswan','ryawan.ruswan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(24,'Saipul Imron','saipul.imron@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(25,'Sasya Nurshakila','sasya.nurshakila@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(26,'Sevri Nanda','sevri.nanda@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(27,'Veronica Octadyaningtyas','veronica.octadyaningtyas@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(28,'Wildan Aliv Mondrian','wildan.aliv.mondrian@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(29,'Ali Reza Adamy','ali.reza.adamy@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(30,'Kandar','kandar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(31,'Asri Handayani','asri.handayani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(32,'M. Haritsyah','m.haritsyah@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(33,'Muhamad Kodri','muhamad.kodri@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(34,'Elsa Fitri','elsa.fitri@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(35,'Nia Yunia','nia.yunia@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(36,'Martinus Riswanto Gultom','martinus.riswanto.gultom@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(37,'Rini Nurlaela','rini.nurlaela@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(38,'Reviadam Maulana Zein','reviadam.maulana.zein@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(39,'Nazwa Lutfiah Guntur','nazwa.lutfiah.guntur@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(40,'Ari Gunawan','ari.gunawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(41,'Tiara Aprianti','tiara.aprianti@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(42,'Fahri Irsadul Ibad','fahri.irsadul.ibad@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(43,'Andra Kurniawan','andra.kurniawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(44,'Malvin Valerian','malvin.valerian@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(45,'Alsya Rismadani','alsya.rismadani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(46,'Andika','andika@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(47,'Andrian Taruma Selej','andrian.taruma.selej@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(48,'Ikmal Akbar','ikmal.akbar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(49,'Herlan','herlan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:01','2026-04-28 13:25:01'),(50,'Kheiza Kurniawan','kheiza.kurniawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(51,'Harjiyanto','harjiyanto@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(52,'Angga Kusuma','angga.kusuma@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(53,'Fadhil Anhar','fadhil.anhar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(54,'Deasy Nuraeni','deasy.nuraeni@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(55,'Egi Prayoga','egi.prayoga@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(56,'Anggi Ade Irawan','anggi.ade.irawan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(57,'Arya Ramadhani','arya.ramadhani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(58,'Baskoro Bina Nuswantoro','baskoro.bina.nuswantoro@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(59,'Rosyadah Nurazizah','rosyadah.nurazizah@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(60,'Chindy Ika Hartati','chindy.ika.hartati@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(61,'Risqi Febriani','risqi.febriani@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(62,'Ali Akbar','ali.akbar@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(63,'Sela Anindita','sela.anindita@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(64,'Lingga Ramadhan','lingga.ramadhan@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02'),(65,'Zahra Sabrina','zahra.sabrina@payroll.com',4,NULL,'$2y$12$7yD4H/AyW6Sy01pqipygYeH0/7AvqwuGTx1AD5Wil/pDtkr19vK8O',NULL,'2026-04-28 13:25:02','2026-04-28 13:25:02');
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

-- Dump completed on 2026-04-29 19:23:07
