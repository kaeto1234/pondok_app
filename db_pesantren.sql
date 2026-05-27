/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: db_pesantren
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `absensi_guru`
--

DROP TABLE IF EXISTS `absensi_guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi_guru` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_mengajar_id` bigint(20) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `pertemuan_ke` int(11) NOT NULL,
  `status` enum('hadir','sakit','izin','alpha') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `absensi_guru_jadwal_mengajar_id_tanggal_unique` (`jadwal_mengajar_id`,`tanggal`),
  CONSTRAINT `absensi_guru_jadwal_mengajar_id_foreign` FOREIGN KEY (`jadwal_mengajar_id`) REFERENCES `jadwal_mengajar` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi_guru`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `absensi_guru` WRITE;
/*!40000 ALTER TABLE `absensi_guru` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi_guru` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `absensi_santri`
--

DROP TABLE IF EXISTS `absensi_santri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi_santri` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `absensi_guru_id` bigint(20) unsigned NOT NULL,
  `santri_tingkat_id` bigint(20) unsigned NOT NULL,
  `status` enum('hadir','sakit','izin','alpha') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `absensi_santri_absensi_guru_id_foreign` (`absensi_guru_id`),
  KEY `absensi_santri_santri_tingkat_id_foreign` (`santri_tingkat_id`),
  CONSTRAINT `absensi_santri_absensi_guru_id_foreign` FOREIGN KEY (`absensi_guru_id`) REFERENCES `absensi_guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_santri_santri_tingkat_id_foreign` FOREIGN KEY (`santri_tingkat_id`) REFERENCES `santri_tingkat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi_santri`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `absensi_santri` WRITE;
/*!40000 ALTER TABLE `absensi_santri` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi_santri` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `berkas_tahun_ajaran`
--

DROP TABLE IF EXISTS `berkas_tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `berkas_tahun_ajaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran_id` bigint(20) unsigned NOT NULL,
  `jenis_berkas_id` bigint(20) unsigned NOT NULL,
  `is_wajib` tinyint(1) NOT NULL DEFAULT 1,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berkas_tahun_ajaran_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `berkas_tahun_ajaran_jenis_berkas_id_foreign` (`jenis_berkas_id`),
  CONSTRAINT `berkas_tahun_ajaran_jenis_berkas_id_foreign` FOREIGN KEY (`jenis_berkas_id`) REFERENCES `jenis_berkas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `berkas_tahun_ajaran_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berkas_tahun_ajaran`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `berkas_tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `berkas_tahun_ajaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `berkas_tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `file_berkas_pendaftaran`
--

DROP TABLE IF EXISTS `file_berkas_pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `file_berkas_pendaftaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pendaftaran_id` bigint(20) unsigned NOT NULL,
  `berkas_tahun_ajaran_id` bigint(20) unsigned NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_berkas_pendaftaran_pendaftaran_id_foreign` (`pendaftaran_id`),
  KEY `file_berkas_pendaftaran_berkas_tahun_ajaran_id_foreign` (`berkas_tahun_ajaran_id`),
  CONSTRAINT `file_berkas_pendaftaran_berkas_tahun_ajaran_id_foreign` FOREIGN KEY (`berkas_tahun_ajaran_id`) REFERENCES `berkas_tahun_ajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `file_berkas_pendaftaran_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_berkas_pendaftaran`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `file_berkas_pendaftaran` WRITE;
/*!40000 ALTER TABLE `file_berkas_pendaftaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_berkas_pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `guru`
--

DROP TABLE IF EXISTS `guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `guru` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `keahlian` text DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guru_nip_unique` (`nip`),
  KEY `guru_user_id_foreign` (`user_id`),
  CONSTRAINT `guru_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guru`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `guru` WRITE;
/*!40000 ALTER TABLE `guru` DISABLE KEYS */;
INSERT INTO `guru` VALUES
(1,2,'198501012010011001','Ustadz Ahmad Fauzan','081224706892','fauzan@pondok.com','Fiqih, Ushul Fiqih','2024-04-06',1,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(2,3,'198703152012011002','Ustadz Muhammad Ridwan','081255598556','ridwan@pondok.com','Nahwu, Shorof, Balaghoh','2024-04-06',1,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(3,4,'199001202015011003','Ustadz Zainul Arifin','081290948726','zainul@pondok.com','Tafsir, Hadits','2024-06-01',1,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(4,5,'199205102016012001','Ustadzah Siti Maryam','081263902197','maryam@pondok.com','Aqidah, Akhlaq, Tajwid','2024-06-01',1,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(5,6,'199308182017011004','Ustadz Abdul Hakim','081259934605','hakim@pondok.com','Faroidh, Tarikh Islam','2025-01-01',1,'2026-05-25 12:39:46','2026-05-25 12:39:46');
/*!40000 ALTER TABLE `guru` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jadwal_mengajar`
--

DROP TABLE IF EXISTS `jadwal_mengajar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_mengajar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran_id` bigint(20) unsigned NOT NULL,
  `kurikulum_id` bigint(20) unsigned NOT NULL,
  `guru_id` bigint(20) unsigned NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruangan` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_mengajar_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `jadwal_mengajar_kurikulum_id_foreign` (`kurikulum_id`),
  KEY `jadwal_mengajar_guru_id_foreign` (`guru_id`),
  CONSTRAINT `jadwal_mengajar_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwal_mengajar_kurikulum_id_foreign` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwal_mengajar_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_mengajar`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jadwal_mengajar` WRITE;
/*!40000 ALTER TABLE `jadwal_mengajar` DISABLE KEYS */;
INSERT INTO `jadwal_mengajar` VALUES
(1,1,2,1,'Senin','07:00:00','08:30:00','Kelas A',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,1,3,1,'Selasa','08:30:00','10:00:00','Kelas B',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,1,4,1,'Rabu','13:00:00','14:30:00','Kelas C',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,1,1,1,'Kamis','14:30:00','16:00:00','Kelas D',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,1,5,1,'Sabtu','16:00:00','17:30:00','Kelas E',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,1,7,1,'Senin','07:00:00','08:30:00','Kelas F',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,1,8,1,'Selasa','08:30:00','10:00:00','Kelas G',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,1,9,1,'Rabu','13:00:00','14:30:00','Kelas H',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(9,1,10,1,'Kamis','14:30:00','16:00:00','Kelas I',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(10,1,11,1,'Sabtu','16:00:00','17:30:00','Kelas A',1,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `jadwal_mengajar` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jenis_berkas`
--

DROP TABLE IF EXISTS `jenis_berkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_berkas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tipe_file` varchar(50) NOT NULL DEFAULT 'pdf,jpg,png',
  `ukuran_maksimal` int(11) NOT NULL DEFAULT 2048,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_berkas`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jenis_berkas` WRITE;
/*!40000 ALTER TABLE `jenis_berkas` DISABLE KEYS */;
/*!40000 ALTER TABLE `jenis_berkas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jenis_ujian`
--

DROP TABLE IF EXISTS `jenis_ujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_ujian` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_ujian`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jenis_ujian` WRITE;
/*!40000 ALTER TABLE `jenis_ujian` DISABLE KEYS */;
INSERT INTO `jenis_ujian` VALUES
(1,'Ujian Harian',20,'Ulangan harian','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,'Ujian Tengah',30,'Ujian Tengah Semester','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,'Ujian Akhir',50,'Ujian Akhir Semester','2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `jenis_ujian` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `kitab`
--

DROP TABLE IF EXISTS `kitab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kitab` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kitab` varchar(100) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kitab`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `kitab` WRITE;
/*!40000 ALTER TABLE `kitab` DISABLE KEYS */;
INSERT INTO `kitab` VALUES
(1,'Mabadi Fiqih Juz 1','Umar Abdul Jabbar',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,'Mabadi Fiqih Juz 2','Umar Abdul Jabbar',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,'Mabadi Fiqih Juz 3','Umar Abdul Jabbar',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,'Fathul Qorib','Ibnu Qosim Al-Ghazi',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,'Fathul Mu\'in','Zainuddin Al-Malibari',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,'Jurumiyah','Imam Ash-Shanhaji',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,'Imrithi','Syarafuddin Al-Imrithi',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,'Alfiyah Ibnu Malik','Ibnu Malik',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(9,'Amtsilah Tasrifiyah','Muhammad Ma\'shum',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(10,'Aqidatul Awam','Sayyid Ahmad Al-Marzuqi',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(11,'Jawahirul Kalamiyah','Thahir Al-Jazairi',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(12,'Arba\'in Nawawi','Imam Nawawi',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(13,'Bulughul Maram','Ibnu Hajar Al-Asqalani',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(14,'Tafsir Jalalain','Jalaluddin Al-Mahalli',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(15,'Ta\'lim Muta\'allim','Az-Zarnuji',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(16,'Washoya','Muhammad Syakir',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(17,'Safinatun Naja','Salim bin Sumair',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(18,'Riyadhus Shalihin','Imam Nawawi',NULL,NULL,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `kitab` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `kitab_mapel`
--

DROP TABLE IF EXISTS `kitab_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kitab_mapel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kitab_id` bigint(20) unsigned NOT NULL,
  `mata_pelajaran_id` bigint(20) unsigned NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kitab_mapel_kitab_id_mata_pelajaran_id_unique` (`kitab_id`,`mata_pelajaran_id`),
  KEY `kitab_mapel_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  CONSTRAINT `kitab_mapel_kitab_id_foreign` FOREIGN KEY (`kitab_id`) REFERENCES `kitab` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kitab_mapel_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kitab_mapel`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `kitab_mapel` WRITE;
/*!40000 ALTER TABLE `kitab_mapel` DISABLE KEYS */;
/*!40000 ALTER TABLE `kitab_mapel` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `kurikulum`
--

DROP TABLE IF EXISTS `kurikulum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kurikulum` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran_id` bigint(20) unsigned NOT NULL,
  `tingkat_diniyah_id` bigint(20) unsigned NOT NULL,
  `mata_pelajaran_id` bigint(20) unsigned NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_kurikulum` (`tahun_ajaran_id`,`tingkat_diniyah_id`,`mata_pelajaran_id`),
  KEY `kurikulum_tingkat_diniyah_id_foreign` (`tingkat_diniyah_id`),
  KEY `kurikulum_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  CONSTRAINT `kurikulum_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kurikulum_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kurikulum_tingkat_diniyah_id_foreign` FOREIGN KEY (`tingkat_diniyah_id`) REFERENCES `tingkat_diniyah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurikulum`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `kurikulum` WRITE;
/*!40000 ALTER TABLE `kurikulum` DISABLE KEYS */;
INSERT INTO `kurikulum` VALUES
(1,1,1,9,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,1,1,1,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,1,1,6,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,1,1,7,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,1,1,11,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,1,2,9,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,1,2,1,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,1,2,2,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(9,1,2,3,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(10,1,2,6,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(11,1,2,7,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(12,1,3,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(13,1,3,2,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(14,1,3,3,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(15,1,3,5,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(16,1,3,6,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(17,1,3,8,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(18,1,4,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(19,1,4,2,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(20,1,4,3,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(21,1,4,5,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(22,1,4,4,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(23,1,4,10,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(24,1,4,12,7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(25,1,5,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(26,1,5,2,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(27,1,5,5,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(28,1,5,4,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(29,1,5,10,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(30,1,5,12,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(31,1,5,8,7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(32,1,6,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(33,1,6,2,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(34,1,6,5,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(35,1,6,4,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(36,1,6,10,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(37,1,6,13,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(38,1,6,15,7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(39,1,7,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(40,1,7,2,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(41,1,7,5,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(42,1,7,4,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(43,1,7,13,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(44,1,7,15,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(45,1,7,14,7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(46,1,8,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(47,1,8,5,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(48,1,8,4,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(49,1,8,13,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(50,1,8,15,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(51,1,8,14,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(52,1,8,8,7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(53,1,9,1,1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(54,1,9,5,2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(55,1,9,4,3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(56,1,9,15,4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(57,1,9,14,5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(58,1,9,13,6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(59,1,9,12,7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `kurikulum` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `mata_pelajaran`
--

DROP TABLE IF EXISTS `mata_pelajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mata_pelajaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_pelajaran`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `mata_pelajaran` WRITE;
/*!40000 ALTER TABLE `mata_pelajaran` DISABLE KEYS */;
INSERT INTO `mata_pelajaran` VALUES
(1,'Fiqih','Ilmu hukum-hukum syariat Islam',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,'Nahwu','Ilmu tata bahasa Arab',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,'Shorof','Ilmu perubahan bentuk kata Arab',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,'Tafsir','Ilmu penafsiran Al-Quran',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,'Hadits','Ilmu hadits Nabi SAW',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,'Aqidah','Ilmu pokok-pokok keimanan',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,'Akhlaq','Ilmu budi pekerti dan etika Islam',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,'Tarikh Islam','Sejarah peradaban Islam',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(9,'Tajwid','Ilmu membaca Al-Quran dengan benar',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(10,'Bahasa Arab','Pelajaran bahasa Arab',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(11,'Imla','Latihan menulis Arab',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(12,'Muthalaah','Ilmu membaca teks Arab',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(13,'Balaghoh','Ilmu keindahan bahasa Arab',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(14,'Faroidh','Ilmu waris Islam',1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(15,'Ushul Fiqih','Ilmu dasar-dasar fiqih',1,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `mata_pelajaran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `materi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `path_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) DEFAULT NULL,
  `mapel_id` bigint(20) unsigned DEFAULT NULL,
  `tingkat_id` bigint(20) unsigned DEFAULT NULL,
  `diupload_oleh` bigint(20) unsigned NOT NULL,
  `diunduh` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materi_mapel_id_foreign` (`mapel_id`),
  KEY `materi_tingkat_id_foreign` (`tingkat_id`),
  KEY `materi_diupload_oleh_foreign` (`diupload_oleh`),
  CONSTRAINT `materi_diupload_oleh_foreign` FOREIGN KEY (`diupload_oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `materi_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE SET NULL,
  CONSTRAINT `materi_tingkat_id_foreign` FOREIGN KEY (`tingkat_id`) REFERENCES `tingkat_diniyah` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materi`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `materi` WRITE;
/*!40000 ALTER TABLE `materi` DISABLE KEYS */;
/*!40000 ALTER TABLE `materi` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `menu_links`
--

DROP TABLE IF EXISTS `menu_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_links_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_links_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_links`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `menu_links` WRITE;
/*!40000 ALTER TABLE `menu_links` DISABLE KEYS */;
INSERT INTO `menu_links` VALUES
(1,2,'/page/sejarah','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,3,'/page/visi-misi','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,4,'/page/struktur','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,5,'/page/sambutan','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,7,'/kategori/program-unggulan','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,8,'/kategori/mata-pelajaran','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,9,'/kategori/fasilitas','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,10,'/kategori/berita','2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `menu_links` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `menu_posts`
--

DROP TABLE IF EXISTS `menu_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_posts_menu_id_foreign` (`menu_id`),
  KEY `menu_posts_post_id_foreign` (`post_id`),
  CONSTRAINT `menu_posts_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_posts`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `menu_posts` WRITE;
/*!40000 ALTER TABLE `menu_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_posts` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES
(1,'Profil',NULL,1,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(2,'Sejarah',1,1,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(3,'Visi & Misi',1,2,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(4,'Struktur Organisasi',1,3,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(5,'Sambutan Pimpinan',1,4,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(6,'Akademik',NULL,2,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(7,'Program Unggulan',6,1,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(8,'Mata Pelajaran',6,2,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(9,'Fasilitas',NULL,3,1,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(10,'Berita',NULL,4,1,'2026-05-25 12:39:50','2026-05-26 00:14:51');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(404,'0001_01_01_000001_create_cache_table',1),
(405,'0001_01_01_000002_create_jobs_table',1),
(406,'2026_04_12_190328_create_roles_table',1),
(407,'2026_04_12_190513_create_users_table',1),
(408,'2026_04_12_202336_create_post_categories_table',1),
(409,'2026_04_12_202342_create_posts_table',1),
(410,'2026_04_12_202347_create_post_galleries_table',1),
(411,'2026_04_12_202353_create_menus_table',1),
(412,'2026_04_12_202358_create_menu_posts_table',1),
(413,'2026_04_12_202406_create_menu_links_table',1),
(414,'2026_05_14_062011_create_yayasan_info_table',1),
(415,'2026_05_14_062020_create_jenis_berkas_table',1),
(416,'2026_05_14_062058_create_tahun_ajaran_table',1),
(417,'2026_05_14_062120_create_tingkat_diniyah_table',1),
(418,'2026_05_14_062128_create_mata_pelajaran_table',1),
(419,'2026_05_14_062135_create_kitab_table',1),
(420,'2026_05_14_062141_create_jenis_ujian_table',1),
(421,'2026_05_14_062155_create_kitab_mapel_table',1),
(422,'2026_05_14_062202_create_kurikulum_table',1),
(423,'2026_05_14_062208_create_guru_table',1),
(424,'2026_05_14_062215_create_berkas_tahun_ajaran_table',1),
(425,'2026_05_14_062300_create_pendaftaran_table',1),
(426,'2026_05_14_062307_create_file_berkas_pendaftaran_table',1),
(427,'2026_05_14_062313_create_santri_table',1),
(428,'2026_05_14_062320_create_orang_tua_table',1),
(429,'2026_05_14_062326_create_jadwal_mengajar_table',1),
(430,'2026_05_14_062333_create_santri_tingkat_table',1),
(431,'2026_05_14_062344_create_absensi_guru_table',1),
(432,'2026_05_14_062349_create_absensi_santri_table',1),
(433,'2026_05_14_062355_create_nilai_table',1),
(434,'2026_05_14_062359_create_materi_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `nilai`
--

DROP TABLE IF EXISTS `nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `nilai` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `santri_tingkat_id` bigint(20) unsigned NOT NULL,
  `kurikulum_id` bigint(20) unsigned NOT NULL,
  `jenis_ujian_id` bigint(20) unsigned NOT NULL,
  `guru_id` bigint(20) unsigned NOT NULL,
  `nilai` decimal(5,2) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_santri_tingkat_id_foreign` (`santri_tingkat_id`),
  KEY `nilai_kurikulum_id_foreign` (`kurikulum_id`),
  KEY `nilai_jenis_ujian_id_foreign` (`jenis_ujian_id`),
  KEY `nilai_guru_id_foreign` (`guru_id`),
  CONSTRAINT `nilai_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_jenis_ujian_id_foreign` FOREIGN KEY (`jenis_ujian_id`) REFERENCES `jenis_ujian` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_kurikulum_id_foreign` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_santri_tingkat_id_foreign` FOREIGN KEY (`santri_tingkat_id`) REFERENCES `santri_tingkat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `nilai` WRITE;
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `orang_tua`
--

DROP TABLE IF EXISTS `orang_tua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orang_tua` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `santri_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `telepon_ayah` varchar(20) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `telepon_ibu` varchar(20) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `hubungan_wali` varchar(50) DEFAULT NULL,
  `telepon_wali` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orang_tua_santri_id_foreign` (`santri_id`),
  KEY `orang_tua_user_id_foreign` (`user_id`),
  CONSTRAINT `orang_tua_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orang_tua_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orang_tua`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `orang_tua` WRITE;
/*!40000 ALTER TABLE `orang_tua` DISABLE KEYS */;
INSERT INTO `orang_tua` VALUES
(1,1,7,'Mubarok Hasan',NULL,NULL,'081200000001','Siti Aminah',NULL,NULL,'085700000001',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:46','2026-05-25 12:39:46'),
(2,2,8,'Rahman Efendi',NULL,NULL,'081200000002','Dewi Rahayu',NULL,NULL,'085700000002',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:46','2026-05-25 12:39:46'),
(3,3,9,'Azzam Malik',NULL,NULL,'081200000003','Fatimah Zahra',NULL,NULL,'085700000003',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:46','2026-05-25 12:39:46'),
(4,4,10,'Faruq Anshori',NULL,NULL,'081200000004','Nurul Hidayah',NULL,NULL,'085700000004',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(5,5,11,'Rosyadi Hamid',NULL,NULL,'081200000005','Halimah Tusyadiah',NULL,NULL,'085700000005',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(6,6,12,'Nugroho Santoso',NULL,NULL,'081200000006','Umi Kulsum',NULL,NULL,'085700000006',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(7,7,13,'Qordhawi Ibrahim',NULL,NULL,'081200000007','Rohmah Wati',NULL,NULL,'085700000007',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(8,8,14,'Khalil Mustafa',NULL,NULL,'081200000008','Zulfa Hanifah',NULL,NULL,'085700000008',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(9,9,15,'Maulana Yusuf',NULL,NULL,'081200000009','Badriyah',NULL,NULL,'085700000009',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(10,10,16,'Hadrami Salim',NULL,NULL,'081200000010','Masyitoh',NULL,NULL,'085700000010',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(11,11,17,'Zahra Ahmad',NULL,NULL,'081200000011','Khadijah Binti Khuwailid',NULL,NULL,'085700000011',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(12,12,18,'Rahmah Basri',NULL,NULL,'081200000012','Qomariyah',NULL,NULL,'085700000012',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(13,13,19,'Ahmad Firdaus',NULL,NULL,'081200000013','Muthmainnah',NULL,NULL,'085700000013',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(14,14,20,'Imran Hakim',NULL,NULL,'081200000014','Asiyah',NULL,NULL,'085700000014',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(15,15,21,'Kubra Mahfud',NULL,NULL,'081200000015','Zaenab',NULL,NULL,'085700000015',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(16,16,22,'Umar Fadhil',NULL,NULL,'081200000016','Shofiyyah',NULL,NULL,'085700000016',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(17,17,23,'Hasanah Wahid',NULL,NULL,'081200000017','Mardhiyah',NULL,NULL,'085700000017',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(18,18,24,'Umar Khatab',NULL,NULL,'081200000018','Hindun',NULL,NULL,'085700000018',NULL,NULL,NULL,'Kab. Banyuwangi, Jawa Timur','2026-05-25 12:39:49','2026-05-25 12:39:49');
/*!40000 ALTER TABLE `orang_tua` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendaftaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_pendaftaran` varchar(50) NOT NULL,
  `tahun_ajaran_id` bigint(20) unsigned NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `telepon_orang_tua` varchar(20) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_daftar` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','diverifikasi','ditolak') NOT NULL DEFAULT 'pending',
  `catatan` text DEFAULT NULL,
  `diverifikasi_oleh` bigint(20) unsigned DEFAULT NULL,
  `diverifikasi_pada` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pendaftaran_no_pendaftaran_unique` (`no_pendaftaran`),
  KEY `pendaftaran_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `pendaftaran_diverifikasi_oleh_foreign` (`diverifikasi_oleh`),
  CONSTRAINT `pendaftaran_diverifikasi_oleh_foreign` FOREIGN KEY (`diverifikasi_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pendaftaran_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES
(1,'Profil','profil','Profil pondok pesantren','info-circle','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(2,'Sambutan Pimpinan','sambutan-pimpinan','Sambutan pimpinan pondok','microphone-alt','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(3,'Akademik','akademik','Program akademik pondok','graduation-cap','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(4,'Fasilitas','fasilitas','Fasilitas pondok pesantren','building','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(5,'Berita','berita','Berita terbaru pondok','newspaper','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(6,'Program Unggulan','program-unggulan','Program unggulan pondok','star','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(7,'Mata Pelajaran','mata-pelajaran','Mata pelajaran pondok','book','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(8,'Hero Section','hero-section','Komponen hero section','home','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(9,'Statistik','statistik','Statistik pondok','chart-line','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(10,'CTA PPDB','cta-ppdb','Call to Action PPDB','megaphone','2026-05-25 12:39:49','2026-05-25 12:39:49');
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `post_galleries`
--

DROP TABLE IF EXISTS `post_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_galleries_post_id_foreign` (`post_id`),
  CONSTRAINT `post_galleries_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_galleries`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `post_galleries` WRITE;
/*!40000 ALTER TABLE `post_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_galleries` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` longtext DEFAULT NULL,
  `post_type` enum('post','page') NOT NULL DEFAULT 'post',
  `post_category_id` bigint(20) unsigned DEFAULT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `slug` varchar(200) NOT NULL,
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_post_category_id_foreign` (`post_category_id`),
  KEY `posts_author_id_foreign` (`author_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(1,'Hero Title','Pondok Pesantren <br> Roudlotut Tullab','post',8,1,'2026-05-26 07:14:51','hero-title',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(2,'Hero Subtitle','Mencetak Generasi yang Beriman, Berilmu, dan Berakhlak Mulia','post',8,1,'2026-05-26 07:14:51','hero-subtitle',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(3,'Hero Button Kiri','Pelajari Lebih Lanjut|/sejarah|bg-white text-primary','post',8,1,'2026-05-26 07:14:51','hero-btn-kiri',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(4,'Hero Button Kanan','Pendaftaran Santri Baru|/ppdb|bg-primaryLight text-white','post',8,1,'2026-05-26 07:14:51','hero-btn-kanan',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(5,'Hero Icon Kiri','fas fa-mosque','post',8,1,'2026-05-26 07:14:51','hero-icon-kiri',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(6,'Hero Icon Kanan','fas fa-quran','post',8,1,'2026-05-26 07:14:51','hero-icon-kanan',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(7,'Santri Aktif','500+','post',9,1,'2026-05-26 07:14:51','statistik-1',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(8,'Asatidz','50+','post',9,1,'2026-05-26 07:14:51','statistik-2',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(9,'Program Unggulan','15+','post',9,1,'2026-05-26 07:14:51','statistik-3',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(10,'Tahun Berdiri','25+','post',9,1,'2026-05-26 07:14:51','statistik-4',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(11,'CTA Title','Daftarkan Putra-Putri Anda Sekarang!','post',10,1,'2026-05-26 07:14:51','cta-title',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(12,'CTA Description','Bergabunglah bersama kami untuk mencetak generasi yang beriman, berilmu, dan berakhlak mulia.','post',10,1,'2026-05-26 07:14:51','cta-desc',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(13,'CTA Button','Pendaftaran Santri Baru|/ppdb|bg-white text-primary','post',10,1,'2026-05-26 07:14:51','cta-button',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(14,'Sejarah Berdirinya Pondok Pesantren Roudlotut Tullab','Sejarah Berdirinya Pondok Pesantren Roudlotut Tullab Padang Singojuruh Banyuwangi\nPondok Pesantren Roudlotut Tullab Padang Singojuruh Banyuwangi didirikan oleh Agus Miftah Farid pada tanggal 6 April 2024. Berdirinya pondok ini dilatarbelakangi oleh cita-cita luhur untuk membangun lembaga pendidikan Islam yang berfokus pada pembinaan ilmu agama, akhlak mulia, serta mencetak generasi santri yang berpegang teguh pada nilai-nilai keislaman.\nPada masa awal berdirinya, kegiatan pondok dimulai secara sederhana melalui pengajian kitab kuning sebagai inti pendidikan pesantren. Dari kegiatan ngaji kitab inilah Pondok Pesantren Roudlotut Tullab mulai berkembang sebagai tempat menimba ilmu agama dan pembinaan karakter santri.\nDi bawah asuhan Agus Miftah Farid, pondok terus berkembang baik dalam sistem pendidikan maupun sarana penunjang. Tidak hanya menyelenggarakan pendidikan kepesantrenan melalui madrasah diniyah, pondok juga mengembangkan pendidikan formal sebagai bentuk ikhtiar memadukan ilmu agama dan ilmu umum.\nSeiring perjalanan waktu, Pondok Pesantren Roudlotut Tullab berupaya menjadi lembaga pendidikan yang menjaga tradisi pesantren salaf melalui kajian kitab, sekaligus menjawab kebutuhan zaman melalui pengembangan lembaga pendidikan yang lebih luas. Dengan semangat keilmuan, pengabdian, dan pembinaan akhlakul karimah, pondok ini diharapkan terus melahirkan santri yang berilmu, beradab, dan bermanfaat bagi umat.','page',1,1,'2026-05-26 07:14:51','sejarah',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(15,'Visi & Misi Pondok Pesantren Roudlotut Tullab','VISI :\nPondok Pesantren Roudlotut Tullab adalah lembaga\npendidikan dan pengajaran islam yang sejak\nberdirinya tetap mempertahankan konsep salafiyah\ndengan menganut Thoriqoh Ta’lim wa Ta’allum,\nsenantiasa menjadikan santri yang berakhlaqul karimah,\nserta menjadi pengembangan keislaman \ndan dakwah multikultural.\nMISI :\n1.Mengembangkan pesantren secara keilmuan dan\n kelembagaan.\n2.Melakukan pencerahan kepada masyarakat melalui kegiatan Ta’allum, Tarbiyah, dan Ta’dib.\n3.Meningkatkan kompetensi lulusan Pondok Pesantren melalui pembekalan moral, skil, dan penguatan di bidang ilmiyah dan amaliyah.','page',1,1,'2026-05-26 07:14:51','visi-misi',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(16,'Struktur Organisasi','','page',1,1,'2026-05-26 07:14:51','struktur',0,'/public/assets/struktur.png','2026-05-25 12:39:49','2026-05-26 00:14:51'),
(17,'Sambutan Pimpinan','Assalamu’alaikum Warahmatullahi Wabarakatuh\nAlhamdulillahi Rabbil ‘Alamin, segala puji hanya milik Allah SWT yang telah melimpahkan rahmat, taufik, dan hidayah-Nya kepada kita semua. Shalawat serta salam semoga senantiasa tercurah kepada junjungan kita Nabi Muhammad SAW, beserta keluarga, sahabat, dan seluruh pengikutnya hingga akhir zaman.\nDengan penuh rasa syukur, kami menyambut kehadiran Pondok Pesantren Roudlotut Tullab sebagai lembaga pendidikan Islam yang berkomitmen membina generasi berilmu, berakhlakul karimah, dan berpegang teguh pada ajaran Ahlussunnah wal Jama’ah.\nPondok Pesantren Roudlotut Tullab didirikan sebagai wadah menuntut ilmu, memperdalam kajian kitab-kitab salaf, membentuk karakter santri yang mandiri, disiplin, serta berjiwa ukhuwah Islamiyah. Kami berharap pesantren ini menjadi taman ilmu dan keberkahan, sebagaimana makna “Roudlotut Tullab” sebagai taman bagi para penuntut ilmu.\nDi pesantren ini, pendidikan tidak hanya berfokus pada penguasaan ilmu agama melalui madrasah diniyah dan pengajian kitab, namun juga mendukung pendidikan formal serta pembinaan keterampilan sebagai bekal santri dalam menghadapi kehidupan bermasyarakat.\nKami menyadari bahwa membangun dan mengembangkan pesantren membutuhkan dukungan dari banyak pihak. Oleh karena itu, kami mengajak seluruh wali santri, masyarakat, dan para muhibbin untuk bersama-sama mendukung perjuangan pendidikan ini, demi terwujudnya generasi yang alim, shalih, dan bermanfaat bagi agama, bangsa, dan umat.\nSemoga Pondok Pesantren Roudlotut Tullab senantiasa diberi keberkahan oleh Allah SWT, menjadi pusat lahirnya kader-kader ulama dan penerus perjuangan Islam.\n\nWassalamu’alaikum Warahmatullahi Wabarakatuh\n23 April 2026\nPengasuh Pondok Pesantren Roudlotut Tullab. Agus Miftah Farid','page',2,1,'2026-05-26 07:14:51','sambutan',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(18,'Tahfidz Al-Qur\'an','<h3>Tentang Program</h3><p>Program hafalan 30 juz dengan target 3-5 tahun...</p><h3>Metode</h3><ul><li>Talqin</li><li>Setoran per pekan</li><li>Muroja\'ah rutin</li></ul><h3>Prestasi</h3><ul><li>Juara 1 MTQ Kabupaten 2025</li></ul><h3>Jadwal</h3><ul><li>Pagi: 04.30 - 06.00</li><li>Malam: 19.00 - 20.30</li></ul>','post',6,1,'2026-05-26 07:14:51','tahfidz',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(19,'Bahasa Arab','<h3>Tentang Program</h3><p>Program intensif bahasa Arab...</p><h3>Metode</h3><ul><li>Immersion</li><li>Percakapan sehari-hari</li><li>Muhadhoroh pekanan</li></ul><h3>Prestasi</h3><ul><li>Juara 1 Pidato Bahasa Arab Provinsi 2025</li></ul><h3>Jadwal</h3><ul><li>Senin-Kamis: 15.00 - 17.00</li></ul>','post',6,1,'2026-05-26 07:14:51','bahasa-arab',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(20,'Kajian Kitab Kuning','<h3>Tentang Program</h3><p>Pembelajaran kitab salaf...</p><h3>Kitab</h3><ul><li>Jurumiyah</li><li>Fathul Qorib</li><li>Tafsir Jalalain</li></ul><h3>Jadwal</h3><ul><li>Malam: 20.00 - 22.00</li></ul>','post',6,1,'2026-05-26 07:14:51','kajian-kitab',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(21,'Diniyah Ula','<h3>Mata Pelajaran Diniyah Ula</h3><ul><li><strong>Tauhid</strong> - Aqidatul Awam</li><li><strong>Fiqih</strong> - Safinatun Najah</li><li><strong>Nahwu</strong> - Jurumiyah</li><li><strong>Al-Qur\'an</strong> - Tahsin & Tahfidz</li></ul><p>Tingkat dasar (setara SD/MI).</p>','post',7,1,'2026-05-26 07:14:51','diniyah-ula',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(22,'Diniyah Wustha','<h3>Mata Pelajaran Diniyah Wustha</h3><ul><li><strong>Tafsir</strong> - Tafsir Jalalain</li><li><strong>Hadits</strong> - Bulughul Maram</li><li><strong>Fiqih</strong> - Fathul Qorib</li><li><strong>Nahwu</strong> - Imrithi</li><li><strong>Shorof</strong> - Amtsilatut Tashrifiyah</li></ul><p>Tingkat menengah (setara SMP/MTs).</p>','post',7,1,'2026-05-26 07:14:51','diniyah-wustha',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(23,'Fasilitas Pondok Pesantren','','page',4,1,'2026-05-26 07:14:51','fasilitas',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(24,'Masjid','Masjid utama pondok dengan kapasitas 1000 jamaah.','post',4,1,'2026-05-26 07:14:51','masjid',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(25,'Asrama','Asrama santri putra dan putri dengan fasilitas lengkap.','post',4,1,'2026-05-26 07:14:51','asrama',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(26,'Perpustakaan','Koleksi 5000+ buku agama, umum, dan kitab kuning.','post',4,1,'2026-05-26 07:14:51','perpustakaan',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(27,'Laboratorium','Lab komputer dan bahasa.','post',4,1,'2026-05-26 07:14:51','laboratorium',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(28,'Kantin','Kantin dan dapur umum.','post',4,1,'2026-05-26 07:14:51','kantin',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(29,'Klinik Kesehatan','Klinik 24 jam.','post',4,1,'2026-05-26 07:14:51','klinik',0,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:51'),
(30,'Lapangan Olahraga','Lapangan futsal, basket, voli.','post',4,1,'2026-05-26 07:14:51','lapangan',0,NULL,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(31,'Ruang Kelas','Ruang kelas nyaman.','post',4,1,'2026-05-26 07:14:51','ruang-kelas',0,NULL,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(32,'Aula','Aula serbaguna.','post',4,1,'2026-05-26 07:14:51','aula',0,NULL,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(33,'Berita Pondok Pesantren','','page',5,1,'2026-05-26 07:14:51','berita',0,NULL,'2026-05-25 12:39:50','2026-05-26 00:14:51'),
(34,'Santri Raih Juara 1 Olimpiade Sains','Santri berhasil meraih juara 1 Olimpiade Sains.','post',5,1,'2026-04-15 00:00:00','santri-raih-juara-1',0,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(35,'Pesantren Kilat Ramadhan','Kegiatan pesantren kilat Ramadhan.','post',5,1,'2026-04-10 00:00:00','pesantren-kilat',0,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(36,'Kerjasama dengan Universitas Al-Azhar','Kerjasama dengan Universitas Al-Azhar.','post',5,1,'2026-04-05 00:00:00','kerjasama-al-azhar',0,NULL,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'admin','Administrator sistem','2026-05-25 12:39:45','2026-05-25 12:39:45'),
(2,'guru','Guru / Pengajar','2026-05-25 12:39:45','2026-05-25 12:39:45'),
(3,'wali','Wali / Orang tua santri','2026-05-25 12:39:45','2026-05-25 12:39:45');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `santri`
--

DROP TABLE IF EXISTS `santri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `santri` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nis` varchar(50) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `pendaftaran_id` bigint(20) unsigned DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','lulus','keluar') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `santri_nis_unique` (`nis`),
  KEY `santri_user_id_foreign` (`user_id`),
  KEY `santri_pendaftaran_id_foreign` (`pendaftaran_id`),
  CONSTRAINT `santri_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE SET NULL,
  CONSTRAINT `santri_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `santri`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `santri` WRITE;
/*!40000 ALTER TABLE `santri` DISABLE KEYS */;
INSERT INTO `santri` VALUES
(1,'20240001',NULL,NULL,'Ahmad Zaki Mubarok','Banyuwangi','2010-03-15','L','Kab. Banyuwangi, Jawa Timur','081300000001',NULL,'aktif','2026-05-25 12:39:46','2026-05-25 12:39:46'),
(2,'20240002',NULL,NULL,'Muhammad Fathur Rahman','Jember','2011-07-22','L','Kab. Banyuwangi, Jawa Timur','081300000002',NULL,'aktif','2026-05-25 12:39:46','2026-05-25 12:39:46'),
(3,'20240003',NULL,NULL,'Abdullah Azzam','Situbondo','2010-11-08','L','Kab. Banyuwangi, Jawa Timur','081300000003',NULL,'aktif','2026-05-25 12:39:46','2026-05-25 12:39:46'),
(4,'20240004',NULL,NULL,'Umar Faruq Al-Anshari','Banyuwangi','2011-02-14','L','Kab. Banyuwangi, Jawa Timur','081300000004',NULL,'aktif','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(5,'20240005',NULL,NULL,'Ali Imron Rosyadi','Bondowoso','2012-05-30','L','Kab. Banyuwangi, Jawa Timur','081300000005',NULL,'aktif','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(6,'20240006',NULL,NULL,'Hasan Basri Nugroho','Banyuwangi','2010-09-18','L','Kab. Banyuwangi, Jawa Timur','081300000006',NULL,'aktif','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(7,'20240007',NULL,NULL,'Yusuf Qordhawi Putra','Malang','2011-12-25','L','Kab. Banyuwangi, Jawa Timur','081300000007',NULL,'aktif','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(8,'20240008',NULL,NULL,'Ibrahim Al-Khalil','Surabaya','2012-04-10','L','Kab. Banyuwangi, Jawa Timur','081300000008',NULL,'aktif','2026-05-25 12:39:47','2026-05-25 12:39:47'),
(9,'20240009',NULL,NULL,'Idris Maulana','Banyuwangi','2013-01-07','L','Kab. Banyuwangi, Jawa Timur','081300000009',NULL,'aktif','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(10,'20240010',NULL,NULL,'Ismail Hadrami','Banyuwangi','2013-08-20','L','Kab. Banyuwangi, Jawa Timur','081300000010',NULL,'aktif','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(11,'20240011',NULL,NULL,'Fatimah Az-Zahra','Banyuwangi','2010-06-12','P','Kab. Banyuwangi, Jawa Timur','081300000011',NULL,'aktif','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(12,'20240012',NULL,NULL,'Aisyah Nur Rahmah','Jember','2011-04-03','P','Kab. Banyuwangi, Jawa Timur','081300000012',NULL,'aktif','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(13,'20240013',NULL,NULL,'Zainab Binti Ahmad','Banyuwangi','2010-10-28','P','Kab. Banyuwangi, Jawa Timur','081300000013',NULL,'aktif','2026-05-25 12:39:48','2026-05-25 12:39:48'),
(14,'20240014',NULL,NULL,'Maryam Binti Imran','Situbondo','2012-02-19','P','Kab. Banyuwangi, Jawa Timur','081300000014',NULL,'aktif','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(15,'20240015',NULL,NULL,'Khadijah Al-Kubra','Banyuwangi','2011-08-05','P','Kab. Banyuwangi, Jawa Timur','081300000015',NULL,'aktif','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(16,'20240016',NULL,NULL,'Ruqayyah Binti Umar','Bondowoso','2012-11-14','P','Kab. Banyuwangi, Jawa Timur','081300000016',NULL,'aktif','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(17,'20240017',NULL,NULL,'Ummu Kultsum Hasanah','Banyuwangi','2013-03-22','P','Kab. Banyuwangi, Jawa Timur','081300000017',NULL,'aktif','2026-05-25 12:39:49','2026-05-25 12:39:49'),
(18,'20240018',NULL,NULL,'Hafshah Binti Umar','Banyuwangi','2013-06-11','P','Kab. Banyuwangi, Jawa Timur','081300000018',NULL,'aktif','2026-05-25 12:39:49','2026-05-25 12:39:49');
/*!40000 ALTER TABLE `santri` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `santri_tingkat`
--

DROP TABLE IF EXISTS `santri_tingkat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `santri_tingkat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `santri_id` bigint(20) unsigned NOT NULL,
  `tahun_ajaran_id` bigint(20) unsigned NOT NULL,
  `tingkat_id` bigint(20) unsigned NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('aktif','lulus','keluar','pindah') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `santri_tingkat_santri_id_foreign` (`santri_id`),
  KEY `santri_tingkat_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `santri_tingkat_tingkat_id_foreign` (`tingkat_id`),
  CONSTRAINT `santri_tingkat_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE,
  CONSTRAINT `santri_tingkat_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `santri_tingkat_tingkat_id_foreign` FOREIGN KEY (`tingkat_id`) REFERENCES `tingkat_diniyah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `santri_tingkat`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `santri_tingkat` WRITE;
/*!40000 ALTER TABLE `santri_tingkat` DISABLE KEYS */;
INSERT INTO `santri_tingkat` VALUES
(1,1,1,1,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,2,1,2,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,3,1,3,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,4,1,4,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,5,1,5,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,6,1,6,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,7,1,7,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,8,1,8,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(9,9,1,9,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(10,10,1,1,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(11,11,1,2,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(12,12,1,3,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(13,13,1,4,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(14,14,1,5,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(15,15,1,6,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(16,16,1,7,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(17,17,1,8,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50'),
(18,18,1,9,'2025-07-01',NULL,'aktif','2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `santri_tingkat` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('Panp5dQdXvOo6zlnZqwSJNvy1eVN6f1ulNKjAIZB',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJPRDNQUTdJQU9QRkhOTmFzdmZkaWRiM3dGYUM2YWtjNnVwT0k5Z1gzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1779778481),
('vio3whftRtw8NqL2ujE6FDlVjTw0MZDblkikL3AP',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ2cnBuak91SDVneWp3QkZPN0ZxOVpmckpYVUpFM3gyZFo2cmdudVZXIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3BhZ2VcL3Blc2FudHJlbi1raWxhdCIsInJvdXRlIjoicGFnZS5zaG93In0sInVzZXJfaWQiOjEsInVzZXJfbmFtZSI6IkFkbWluIFBvbmRvayIsInVzZXJfZW1haWwiOiJhZG1pbkBwb25kb2suY29tIiwidXNlcl9yb2xlIjoiYWRtaW4iLCJ1c2VyX3JvbGVfaWQiOjF9',1779779392);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tahun_ajaran`
--

DROP TABLE IF EXISTS `tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahun_ajaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_tahun` varchar(20) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun_ajaran`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tahun_ajaran` VALUES
(1,'2025/2026','2025-07-01','2026-06-30',1,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tingkat_diniyah`
--

DROP TABLE IF EXISTS `tingkat_diniyah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tingkat_diniyah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_tingkat` varchar(50) NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tingkat_diniyah`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tingkat_diniyah` WRITE;
/*!40000 ALTER TABLE `tingkat_diniyah` DISABLE KEYS */;
INSERT INTO `tingkat_diniyah` VALUES
(1,'Ula 1',1,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(2,'Ula 2',2,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(3,'Ula 3',3,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(4,'Wustho 1',4,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(5,'Wustho 2',5,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(6,'Wustho 3',6,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(7,'Ulya 1',7,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(8,'Ulya 2',8,1,'2026-05-25 12:39:50','2026-05-25 12:39:50'),
(9,'Ulya 3',9,1,'2026-05-25 12:39:50','2026-05-25 12:39:50');
/*!40000 ALTER TABLE `tingkat_diniyah` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'admin','admin@pondok.com','$2y$12$58sDAWzA3Uso70rQfr32P.Z27JYHVAEdUMTQOvDTgs4CnXhunAMM.','Admin Pondok',1,1,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(2,'ustadz.fauzan','fauzan@pondok.com','$2y$12$s.iXOIf/DkhRRwNFLq.s9.wkHQc/j48aLyEfcXBpcX7UYkHdGqiMm','Ustadz Ahmad Fauzan',1,2,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(3,'ustadz.ridwan','ridwan@pondok.com','$2y$12$yS5Io6KTQS4T./rnb2zMZ.tiMrv6KWfWjD6XW/ce9RaGgT0Oved0K','Ustadz Muhammad Ridwan',1,2,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(4,'ustadz.zainul','zainul@pondok.com','$2y$12$kYevVUL30wgDY.mFNP3JXurumByXw8hncoE8N72ttjhzyCKIoRkfq','Ustadz Zainul Arifin',1,2,'2026-05-25 12:39:45','2026-05-25 12:39:45'),
(5,'ustadzah.maryam','maryam@pondok.com','$2y$12$VcNJJ1dgfR/t4h02nJ0KO.kxEg5kW3golSAfcawMBNQ9AkhskOjJK','Ustadzah Siti Maryam',1,2,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(6,'ustadz.hakim','hakim@pondok.com','$2y$12$OrZtHKCohZVXv6x6zlPO8eVyzUXjyrvhJ0W8jXIeS.RFRnptWEkjy','Ustadz Abdul Hakim',1,2,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(7,'ahmad.zaki.mubarok','ahmad.zaki.mubarok@wali.pondok.com','$2y$12$nHFMew3IHcvd5N5O2MvAre19SMr4m5Wpm1VJ8Wxy/T.LNeKgwsVgy','Wali Ahmad Zaki Mubarok',1,3,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(8,'muhammad.fathur.rahman','muhammad.fathur.rahman@wali.pondok.com','$2y$12$OszBWtZVKhHedjk4rnIUBebDUfhIMdbojXDawu3/W9g8XFJD8q5h6','Wali Muhammad Fathur Rahman',1,3,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(9,'abdullah.azzam','abdullah.azzam@wali.pondok.com','$2y$12$iOUlOciMzU6RqE1ZRNZBg..T9kiQaZzrYASnQ0D60cIFi3rrpl42W','Wali Abdullah Azzam',1,3,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(10,'umar.faruq.al.anshari','umar.faruq.al.anshari@wali.pondok.com','$2y$12$nwfsVIXzCDYXKAlmIoZch.tjFStV1XYJRfybQpATQ1QT2JbADznsS','Wali Umar Faruq Al-Anshari',1,3,'2026-05-25 12:39:46','2026-05-25 12:39:46'),
(11,'ali.imron.rosyadi','ali.imron.rosyadi@wali.pondok.com','$2y$12$RXft35imeE58xY4PSlgiKORiDmq3eglMoYziB3F/qGQUP7mnMnSRC','Wali Ali Imron Rosyadi',1,3,'2026-05-25 12:39:47','2026-05-25 12:39:47'),
(12,'hasan.basri.nugroho','hasan.basri.nugroho@wali.pondok.com','$2y$12$cH0ZJshX97ZaV8Ehy1b62eKFBeQGBV.FmRDV7ycMzvcNfEs.U8hFK','Wali Hasan Basri Nugroho',1,3,'2026-05-25 12:39:47','2026-05-25 12:39:47'),
(13,'yusuf.qordhawi.putra','yusuf.qordhawi.putra@wali.pondok.com','$2y$12$R3vxxtI4vNY5TzjiSKmL8OBhWLvrniQbeHrbJbfN/6HPZJsF/GNY2','Wali Yusuf Qordhawi Putra',1,3,'2026-05-25 12:39:47','2026-05-25 12:39:47'),
(14,'ibrahim.al.khalil','ibrahim.al.khalil@wali.pondok.com','$2y$12$8Dbx4Xcp69LGOZWgOR0iYuBQnpvRwDwaRMUH5IPwMHNbCbS62GPsy','Wali Ibrahim Al-Khalil',1,3,'2026-05-25 12:39:47','2026-05-25 12:39:47'),
(15,'idris.maulana','idris.maulana@wali.pondok.com','$2y$12$RfvT9DobinkJAi/lS8oXQuvHO9vCgk8AiF2KrJ/A04o4pF/EOkB7u','Wali Idris Maulana',1,3,'2026-05-25 12:39:48','2026-05-25 12:39:48'),
(16,'ismail.hadrami','ismail.hadrami@wali.pondok.com','$2y$12$B9aanRCMwnzJtyVc4SMKWe/cjquaar2g6qIDcUPwVEtEZfwI69szi','Wali Ismail Hadrami',1,3,'2026-05-25 12:39:48','2026-05-25 12:39:48'),
(17,'fatimah.az.zahra','fatimah.az.zahra@wali.pondok.com','$2y$12$d5dvxjXMhsF9IZnh.6y0c.gxrOf67cgKgYJDS5fZghuZxdU.Iam3q','Wali Fatimah Az-Zahra',1,3,'2026-05-25 12:39:48','2026-05-25 12:39:48'),
(18,'aisyah.nur.rahmah','aisyah.nur.rahmah@wali.pondok.com','$2y$12$WgcwZlEaTlZAbb.Bn/Ey/exWNVKRF9ordzD.JsT4jZu3fzVb008gC','Wali Aisyah Nur Rahmah',1,3,'2026-05-25 12:39:48','2026-05-25 12:39:48'),
(19,'zainab.binti.ahmad','zainab.binti.ahmad@wali.pondok.com','$2y$12$1g86llHvo1IhTHVp74rRKu378m1tszK3CtdXMWVmAhc/4x/U7nO0G','Wali Zainab Binti Ahmad',1,3,'2026-05-25 12:39:48','2026-05-25 12:39:48'),
(20,'maryam.binti.imran','maryam.binti.imran@wali.pondok.com','$2y$12$zWvk5QS7Eugr2t617eX.Suh1QRl3wIh4WTYLgmRKe/R6pUsiHwUmK','Wali Maryam Binti Imran',1,3,'2026-05-25 12:39:48','2026-05-25 12:39:48'),
(21,'khadijah.al.kubra','khadijah.al.kubra@wali.pondok.com','$2y$12$6DAXm3t5BtfcBhBzoDZOgucfPzybXw2IJY.PmYa.eT1ujk/ufkHna','Wali Khadijah Al-Kubra',1,3,'2026-05-25 12:39:49','2026-05-25 12:39:49'),
(22,'ruqayyah.binti.umar','ruqayyah.binti.umar@wali.pondok.com','$2y$12$vKsfTgTLqqXLWmRaK8YhZOg5v6ZqMlPlSpHsRu8CxACWRT1qbLhMm','Wali Ruqayyah Binti Umar',1,3,'2026-05-25 12:39:49','2026-05-25 12:39:49'),
(23,'ummu.kultsum.hasanah','ummu.kultsum.hasanah@wali.pondok.com','$2y$12$giqKVEmmL8.PYx110Pbfqu5dCxhdt3.5/7rwrJTjDn9lTKt0ljaxK','Wali Ummu Kultsum Hasanah',1,3,'2026-05-25 12:39:49','2026-05-25 12:39:49'),
(24,'hafshah.binti.umar','hafshah.binti.umar@wali.pondok.com','$2y$12$I48KH2yYZKiQhcbWX2CU4.qGwaJSP4e31ZNLiXnLIvRAiXYxMuxJm','Wali Hafshah Binti Umar',1,3,'2026-05-25 12:39:49','2026-05-25 12:39:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `yayasan_info`
--

DROP TABLE IF EXISTS `yayasan_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `yayasan_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_yayasan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `google_maps` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yayasan_info`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `yayasan_info` WRITE;
/*!40000 ALTER TABLE `yayasan_info` DISABLE KEYS */;
INSERT INTO `yayasan_info` VALUES
(1,'Pondok Pesantren Roudlotut Tullab','Jl. KH. Abdullah Hasbullah No.8, Krajan, Padang, Kec. Singojuruh, Kabupaten Banyuwangi, Jawa Timur 68464','082241808808','roudlotuttullab01@gmail.com','6282241808808','https://www.facebook.com/share/1BEb9zPTTM/','https://www.instagram.com/ponpes_roudlotuttullab?igsh=MXV5OW1mZGlrOGloNQ==',NULL,'https://youtube.com/@roudlotuttullab_channel?si=ZKJrflxOZssaesc_','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8121876.116135303!2d104.213674529126!3d-6.295261848425474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd151817a2c66a1%3A0xcc758f98582d1e93!2sYayasan%20Pondok%20Pesantren%20Tahfidz%20Raudlotuttulab!5e0!3m2!1sid!2sid!4v1779699405428!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>',NULL,NULL,'2026-05-25 12:39:49','2026-05-26 00:14:50');
/*!40000 ALTER TABLE `yayasan_info` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-05-26 14:15:07
