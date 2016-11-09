-- MySQL dump 10.16  Distrib 10.1.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cajero
-- ------------------------------------------------------
-- Server version	10.1.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `apps`
--
DROP DATABASE IF EXISTS `cajero`;

CREATE DATABASE IF NOT EXISTS `cajero`;


DROP TABLE IF EXISTS `apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_token` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apps_api_token_unique` (`api_token`),
  UNIQUE KEY `apps_client_id_unique` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apps`
--

LOCK TABLES `apps` WRITE;
/*!40000 ALTER TABLE `apps` DISABLE KEYS */;
INSERT INTO `apps` VALUES (1,'Zieme Group','04d08299-bd80-3f87-9386-63aa0b181cf2',5312336858833205,'http://ziemann.info/officia-maiores-id-possimus-corporis-quos-architecto','2016-11-09 21:31:40','2016-11-09 21:31:40'),(2,'Williamson-Davis','94f05870-e06e-3d0f-9d96-ccdeef7dc9d8',4532762911689192,'http://www.hermann.com/voluptas-voluptatem-incidunt-aspernatur-vel-eaque-excepturi.html','2016-11-09 21:31:40','2016-11-09 21:31:40');
/*!40000 ALTER TABLE `apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double unsigned NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `voucher_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `voucher_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `origin_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IdPlayer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IdUser_reviewed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deposits_client_id_foreign` (`client_id`),
  CONSTRAINT `deposits_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `apps` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
INSERT INTO `deposits` VALUES (1,'Dr. Emerald Lubowitz DDS','cryan@example.org','Koss-Gaylord',70,'bank','http://placehold.it/350x150','4539206320312','Weber Ltd','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(2,'Randal Moen','leopold.wisozk@example.org','Swift, Effertz and Boehm',53,'bank','http://placehold.it/350x150','5513148812814818','Bruen-Hartmann','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(3,'Kennedi Huel','lesly.stamm@example.org','Langosh Ltd',99,'bank','http://placehold.it/350x150','5196889841668329','Doyle-Dare','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(4,'Dr. Johanna McKenzie','dawn13@example.org','Cole-Schaden',70,'bank','http://placehold.it/350x150','4929866898964','Dicki Group','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(5,'Margarette Leffler','gparker@example.com','Halvorson-Kuvalis',57,'bank','http://placehold.it/350x150','5100577787824007','Grant, Kirlin and Roberts','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(6,'Ms. Serena Pacocha Sr.','diana.kassulke@example.org','Connelly Group',96,'bank','http://placehold.it/350x150','4532395325176','Bergstrom, Purdy and Orn','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(7,'Mrs. Shaniya Nienow DVM','lhammes@example.net','Batz Ltd',73,'bank','http://placehold.it/350x150','5284337564523183','Russel, Spencer and Conroy','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(8,'Kacey Hyatt','mariane.gerhold@example.com','D\'Amore, Davis and Raynor',57,'bank','http://placehold.it/350x150','4556789766026','Tillman and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(9,'Theo Jacobson','albert46@example.org','Schmitt PLC',76,'bank','http://placehold.it/350x150','4539516650499','Stehr, Murazik and Bailey','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(10,'Andreanne Lemke','schroeder.freida@example.net','O\'Hara, Mills and Corwin',94,'bank','http://placehold.it/350x150','341807623430051','Carter PLC','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(11,'Miss Jana Haley V','hansen.victoria@example.net','Kreiger Ltd',75,'bank','http://placehold.it/350x150','4929642764580949','Breitenberg and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(12,'Mr. Timmy Bechtelar','toney34@example.com','Kutch Inc',63,'bank','http://placehold.it/350x150','4024007137298','Schuppe, Harvey and Feeney','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(13,'Moriah Hyatt','keven.monahan@example.net','Koelpin LLC',86,'bank','http://placehold.it/350x150','374043940685140','Kohler and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(14,'Nigel Pagac','effie20@example.net','Koss LLC',79,'bank','http://placehold.it/350x150','4485167880032076','Emard, Stracke and Turcotte','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(15,'Mr. Ottis Considine','alana79@example.net','Rowe, Gusikowski and Cronin',89,'bank','http://placehold.it/350x150','375844803001682','Barton, Sporer and Wunsch','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(16,'Prof. Jenifer Kiehn','christophe40@example.org','Walter LLC',90,'bank','http://placehold.it/350x150','5309932961520682','West, Nienow and Carroll','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(17,'Tiffany Dare','haag.anthony@example.org','McKenzie-Armstrong',57,'bank','http://placehold.it/350x150','5208440597028940','O\'Hara, Reynolds and Crona','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(18,'Dana Frami','douglas.madaline@example.org','Lueilwitz LLC',91,'bank','http://placehold.it/350x150','4532841359738','Wyman Ltd','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(19,'Dr. Donnie Wolf MD','pward@example.com','Ebert, White and Dickens',75,'bank','http://placehold.it/350x150','5503248901899449','Goodwin, O\'Connell and Kihn','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(20,'Prof. Reyes Kulas','christiansen.maurice@example.org','Veum Inc',50,'bank','http://placehold.it/350x150','6011031196408693','Schimmel LLC','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:41','2016-11-09 21:31:41'),(21,'Demetrius Nader','cody76@example.com','Nicolas-Lebsack',83,'bank','http://placehold.it/350x150','4759139928623','Spinka, Schimmel and Kiehn','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(22,'Damaris Goyette III','lakin.alejandra@example.net','Beier, Barton and Schulist',51,'bank','http://placehold.it/350x150','5260264360315556','Cartwright and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(23,'Christophe Stoltenberg Jr.','mabbott@example.net','Cassin, Botsford and Stoltenberg',88,'bank','http://placehold.it/350x150','4929814245602655','Moen PLC','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(24,'Louie Dickens','micheal82@example.net','Boehm-Considine',71,'bank','http://placehold.it/350x150','4916908461810','Frami, Cartwright and Lowe','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(25,'Dr. Brionna Schuster III','dudley.purdy@example.org','Leffler, Predovic and Von',63,'bank','http://placehold.it/350x150','4716296898890','Borer and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(26,'Mr. Armando Schinner Sr.','vosinski@example.com','Schamberger-Beer',98,'bank','http://placehold.it/350x150','5177576192149701','Rohan and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(27,'Marjolaine McCullough','whodkiewicz@example.org','Prohaska-Jaskolski',53,'bank','http://placehold.it/350x150','4929355605904','Frami, Hilll and Hayes','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(28,'Iva Hilpert','chaya.schulist@example.net','Emard-Pacocha',88,'bank','http://placehold.it/350x150','5375478918196886','Bogan, Kohler and Casper','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(29,'Mafalda Hettinger','ifarrell@example.com','Wilderman Inc',52,'bank','http://placehold.it/350x150','4556716045148','Wiegand-Yundt','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(30,'Connie Emard MD','stehr.avis@example.org','Beatty-Zieme',51,'bank','http://placehold.it/350x150','4556836840295','Walsh, Wintheiser and Mayer','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(31,'Margarete Kuphal','webster84@example.org','Balistreri Ltd',97,'bank','http://placehold.it/350x150','5199004796762997','Hane-Senger','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(32,'Dannie Mante','ettie07@example.org','Jakubowski Group',89,'bank','http://placehold.it/350x150','5543499854443345','Treutel-Leffler','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(33,'Miss Karen Buckridge','blair.doyle@example.net','Borer, Nicolas and Bosco',89,'bank','http://placehold.it/350x150','5361219100024353','Bahringer, Rogahn and Kertzmann','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(34,'Mrs. Maribel Bode','ullrich.lonnie@example.com','Ledner Group',76,'bank','http://placehold.it/350x150','4485120857577','Weissnat-Reinger','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(35,'Gregorio Jast DDS','athena51@example.com','Kertzmann LLC',64,'bank','http://placehold.it/350x150','6011090544532133','Bayer, Hirthe and Effertz','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(36,'Selena Fay','uleuschke@example.com','Torphy-Sporer',79,'bank','http://placehold.it/350x150','4024007137305743','Anderson-Wintheiser','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(37,'Reina Jakubowski','hadley50@example.com','Murray-Boyer',62,'bank','http://placehold.it/350x150','5250658739135037','Hagenes-Windler','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(38,'Lavada Stracke','metz.brandi@example.org','Padberg Inc',64,'bank','http://placehold.it/350x150','5326118926721156','Bode, Keeling and Kassulke','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(39,'Cheyanne Green','mills.angel@example.net','Wehner, Watsica and Durgan',80,'bank','http://placehold.it/350x150','5222789881034671','Tillman-Marquardt','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(40,'Matt Ernser','margarett23@example.net','Rutherford, Tillman and Lind',54,'bank','http://placehold.it/350x150','4716786094531838','Carroll, Conn and Waters','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(41,'Prof. Kitty Prohaska DVM','koss.leif@example.org','Gleason LLC',71,'bank','http://placehold.it/350x150','4024007147891','Rohan Inc','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(42,'Prof. Watson Heidenreich','harvey43@example.net','Rippin-Rowe',76,'bank','http://placehold.it/350x150','4532012793231725','Gottlieb Ltd','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:42','2016-11-09 21:31:42'),(43,'Mario Farrell','xgerhold@example.org','Bechtelar Group',80,'bank','http://placehold.it/350x150','4532919938298','Ankunding-Quitzon','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(44,'Cali Bailey','larissa60@example.com','Romaguera-VonRueden',72,'bank','http://placehold.it/350x150','4916890929279','Weissnat-Anderson','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(45,'Cornelius Gerhold','kenya37@example.com','Rogahn-Nitzsche',79,'bank','http://placehold.it/350x150','4916638277429231','Brakus, Cremin and Murphy','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(46,'Celestino Ortiz','meda41@example.net','Nicolas, Klocko and Harris',75,'bank','http://placehold.it/350x150','5392661828502611','Schowalter-Quigley','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(47,'Mr. Chester Sanford','zbalistreri@example.net','Schuster, Johnson and Farrell',86,'bank','http://placehold.it/350x150','4916390353400','Muller-Paucek','waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(48,'Kolby Grady','ward.cathy@example.org','Tremblay-O\'Reilly',54,'bank','http://placehold.it/350x150','5520161836653238','Aufderhar, Haag and Hirthe','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(49,'Ms. Delfina Heathcote','paula58@example.org','Price LLC',94,'bank','http://placehold.it/350x150','5519970360647678','Fahey, Renner and Toy','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(50,'Mrs. Arlene Mosciski Jr.','fblick@example.com','Sipes Inc',79,'bank','http://placehold.it/350x150','4929918392760990','Ullrich and Sons','waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43');
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_01_20_084450_create_roles_table',1),('2015_01_20_084525_create_role_user_table',1),('2015_01_24_080208_create_permissions_table',1),('2015_01_24_080433_create_permission_role_table',1),('2015_12_04_003040_add_special_role_column',1),('2016_11_01_191433_create_apps_table',1),('2016_11_02_190322_create_deposits_table',1),('2016_11_07_171949_create_withdrawals_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(2,2,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(3,3,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(4,4,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(5,5,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(6,6,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(7,7,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(8,8,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(9,9,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(10,10,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(11,11,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(12,12,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(13,13,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(14,14,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(15,15,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(16,16,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(17,17,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(18,18,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(19,19,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(20,20,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(21,21,1,'2016-11-09 21:31:39','2016-11-09 21:31:39'),(22,22,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(23,23,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(24,24,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(25,25,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(26,26,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(27,27,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(28,28,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(29,3,2,'2016-11-09 21:33:07','2016-11-09 21:33:07'),(30,12,2,'2016-11-09 21:33:07','2016-11-09 21:33:07'),(31,13,2,'2016-11-09 21:33:07','2016-11-09 21:33:07'),(32,14,2,'2016-11-09 21:33:07','2016-11-09 21:33:07'),(33,15,2,'2016-11-09 21:33:07','2016-11-09 21:33:07'),(34,16,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(35,21,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(36,22,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(37,23,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(38,24,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(39,25,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(40,26,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(41,27,2,'2016-11-09 21:33:08','2016-11-09 21:33:08'),(42,28,2,'2016-11-09 21:33:08','2016-11-09 21:33:08');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Add permission','permission.add','Add permission','2016-11-09 21:31:36','2016-11-09 21:31:36'),(2,'edit permission','permission.edit','edit permission','2016-11-09 21:31:36','2016-11-09 21:31:36'),(3,'list permission','permission.list','list permission','2016-11-09 21:31:36','2016-11-09 21:31:36'),(4,'delete permission','permission.delete','delete permission','2016-11-09 21:31:37','2016-11-09 21:31:37'),(5,'assign permission','permission.assign','assign permission','2016-11-09 21:31:37','2016-11-09 21:31:37'),(6,'revoke permission','permission.revoke','revoke permission','2016-11-09 21:31:37','2016-11-09 21:31:37'),(7,'Add roles','role.add','Add roles','2016-11-09 21:31:37','2016-11-09 21:31:37'),(8,'edit roles','role.edit','edit roles','2016-11-09 21:31:37','2016-11-09 21:31:37'),(9,'delete roles','role.delete','delete roles','2016-11-09 21:31:37','2016-11-09 21:31:37'),(10,'assign roles','role.assign','assign roles','2016-11-09 21:31:37','2016-11-09 21:31:37'),(11,'revoke roles','role.revoke','revoke roles','2016-11-09 21:31:37','2016-11-09 21:31:37'),(12,'list roles','role.list','list roles','2016-11-09 21:31:37','2016-11-09 21:31:37'),(13,'Add users','user.add','Add users','2016-11-09 21:31:37','2016-11-09 21:31:37'),(14,'edit users','user.edit','edit users','2016-11-09 21:31:37','2016-11-09 21:31:37'),(15,'delete users','user.delete','delete users','2016-11-09 21:31:37','2016-11-09 21:31:37'),(16,'list users','user.list','list users','2016-11-09 21:31:37','2016-11-09 21:31:37'),(17,'add apps','app.add','add apps','2016-11-09 21:31:37','2016-11-09 21:31:37'),(18,'edit apps','app.edit','edit apps','2016-11-09 21:31:37','2016-11-09 21:31:37'),(19,'delete apps','app.delete','delete apps','2016-11-09 21:31:37','2016-11-09 21:31:37'),(20,'list apps','app.list','list apps','2016-11-09 21:31:37','2016-11-09 21:31:37'),(21,'add deposits','deposits.add','add deposits','2016-11-09 21:31:38','2016-11-09 21:31:38'),(22,'edit deposits','deposits.edit','edit deposits','2016-11-09 21:31:38','2016-11-09 21:31:38'),(23,'list of deposits','deposits.list','list of deposits','2016-11-09 21:31:38','2016-11-09 21:31:38'),(24,'delete deposits','deposits.delete','delete deposits','2016-11-09 21:31:38','2016-11-09 21:31:38'),(25,'add withdrawals','withdrawals.add','add withdrawals','2016-11-09 21:31:38','2016-11-09 21:31:38'),(26,'edit withdrawals','withdrawals.edit','edit withdrawals','2016-11-09 21:31:38','2016-11-09 21:31:38'),(27,'list of withdrawals','withdrawals.list','list of withdrawals','2016-11-09 21:31:38','2016-11-09 21:31:38'),(28,'delete withdrawals','withdrawals.delete','delete withdrawals','2016-11-09 21:31:38','2016-11-09 21:31:38');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2016-11-09 21:31:40','2016-11-09 21:31:40'),(2,2,2,'2016-11-09 21:31:40','2016-11-09 21:31:40');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super administrator','admin.super','Super administrator, developers','2016-11-09 21:31:38','2016-11-09 21:31:38','all-access'),(2,'administrator','admin.default','administrator of the site','2016-11-09 21:31:38','2016-11-09 21:31:38',''),(3,'default','default.default','administrator of the site','2016-11-09 21:31:38','2016-11-09 21:31:38','');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com','$2y$10$0.mztUCMYJD6tPdISe87oucm1p.REvkOLQ/bFjCqagq1L5LuLO7n2','z2EJ85lKkFqUvKDVkXWW8J2n3PSvrOfZI1ic1uyou3Wdiphw12LVMaTtLCsr','2016-11-09 21:31:38','2016-11-09 21:33:16'),(2,'Administrator','vipadmin@admin.com','$2y$10$CmviicCaLlDqPJMUogE6iOfeCxLYVhiCFeWyHBSzsOuIxXsRcvoB6','VRLXjdyisVWhffdyd2orgixZfTGbTCAb1rZZaIaa39es33GfbJve5IV0nZcb','2016-11-09 21:31:39','2016-11-09 21:32:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdrawals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destination_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IdPlayer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IdUser_reviewed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdrawals_client_id_foreign` (`client_id`),
  CONSTRAINT `withdrawals_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `apps` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdrawals`
--

LOCK TABLES `withdrawals` WRITE;
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
INSERT INTO `withdrawals` VALUES (1,'Kiana Hessel Sr.','branson.casper@example.com','Hyatt LLC','70656058658',88,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(2,'Dr. Ahmad Robel','mekhi.mccullough@example.net','Hand, Schiller and Jones','59830508428',60,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(3,'Pauline Bogan','blanca73@example.net','Bins Inc','3851536718',64,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(4,'Palma Beier','ibauch@example.org','Bauch, Green and Bailey','581569',93,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(5,'Esta Conroy Sr.','lkoch@example.net','Koelpin, Bergnaum and Vandervort','38088336260',63,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(6,'Justina Dibbert','yschaden@example.org','Hane LLC','7463109227',95,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(7,'Augustus Cormier','celestino61@example.org','Emard-Barton','1566552092',100,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(8,'Kobe Funk','joannie51@example.com','Kiehn-Mertz','751371332909',97,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(9,'Prof. Garth Lesch II','blake.ortiz@example.org','O\'Conner-Pfeffer','9584460700741',91,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(10,'Kacie Roob Jr.','dare.irma@example.com','Schuster-Armstrong','02367008732',64,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(11,'Alvera Schiller V','zcollins@example.org','Kovacek-Lakin','008964',75,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(12,'Prof. Ricardo Sauer','alena.yundt@example.net','Prosacco, Balistreri and Reinger','520496714220',54,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:43','2016-11-09 21:31:43'),(13,'Frederique Dare Jr.','josefina.schroeder@example.org','Quigley, Little and Runolfsson','95728366453',94,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(14,'Loyal Von','rozella91@example.com','Green Group','86731978971',87,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(15,'Harmon Schmitt','pfannerstill.ebony@example.com','Hettinger and Sons','418577670',97,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(16,'Dr. Marcus Lehner PhD','margarete24@example.com','Lubowitz, Feest and Hoeger','2454051990579',92,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(17,'Royce Stoltenberg','xprosacco@example.net','Schulist, McCullough and Blick','8979505204',50,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(18,'Prof. Samson Bednar DVM','vfadel@example.org','Hauck-Jerde','8717425859593',68,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(19,'Roscoe Kirlin','misty.effertz@example.com','Pollich, Cruickshank and Runte','9040313829338',51,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(20,'Hermina Spencer','lavinia.tillman@example.org','Stroman and Sons','484201858587',100,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(21,'Ericka Cummerata I','lubowitz.braulio@example.org','Mueller, Satterfield and Heidenreich','6745928871',91,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(22,'Anais Terry','athena.aufderhar@example.net','Lemke PLC','4218495510',68,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(23,'Jaime Lemke','gunnar72@example.com','Donnelly-Berge','1251178297',61,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(24,'Kaia Schulist','kathryne.boyle@example.net','Satterfield, Lebsack and Borer','2899290522',93,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(25,'Bria Grimes','hmoen@example.org','Johnson LLC','02017979918',69,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(26,'Winston Orn','rmante@example.net','Runte, Lind and Barton','547513416',80,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(27,'Maeve Hagenes V','wiley.mueller@example.net','Farrell-Little','8259847057538',87,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(28,'Mrs. Jade Kertzmann IV','janice.crona@example.org','Dooley Inc','06249157',97,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(29,'Britney Wuckert Sr.','carol79@example.com','Kohler Group','66690961301',63,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:44','2016-11-09 21:31:44'),(30,'Osbaldo Hirthe','keshaun02@example.org','Morissette-Haag','473982801701',63,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(31,'Jane Emard','thiel.caterina@example.net','Shanahan-Collins','18121839',96,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(32,'Monte Cartwright','kennedi.altenwerth@example.com','Schroeder, Botsford and Cassin','6750583653',73,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(33,'Werner Eichmann','tpagac@example.org','Frami and Sons','1823346276',97,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(34,'Dr. Eldon Sipes','bergstrom.francisco@example.com','Welch, Bins and Bosco','94191250593',95,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(35,'Joyce Parker','germaine.smitham@example.com','Nikolaus, Wiegand and Sporer','0421403295017',92,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(36,'Prof. Evans Schmidt','maryse18@example.com','Osinski, Beatty and Farrell','5539456208',69,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(37,'Clemmie Schinner','leanne.hoeger@example.net','Cassin-Cummings','731987841903',79,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(38,'Dr. Joyce Rau DVM','caroline.jacobs@example.org','Smitham, Bayer and Stehr','5582730718',51,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(39,'Ladarius Hammes','gregg37@example.com','Jacobson, Boehm and Corwin','4678609145424',54,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(40,'Mrs. Janiya Ernser','scotty.larkin@example.org','Cremin-Breitenberg','05945817',53,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(41,'Beau Tromp','vivianne.barton@example.org','O\'Reilly Ltd','84520488',83,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(42,'Estefania Dooley IV','vgibson@example.com','Ferry, Stamm and Gerhold','813233317',58,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(43,'Lori Bruen','izulauf@example.com','Hane, Bins and Dickinson','7327834',62,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(44,'Miller Johnson Jr.','kira35@example.com','Runolfsson, Schuster and Murazik','53157401264042',79,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(45,'Candace Durgan','oberbrunner.chad@example.org','Cartwright-Kohler','9256111055922',54,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(46,'Raphael Kreiger','mkihn@example.net','Nienow, McGlynn and Adams','07411982',88,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(47,'Dennis Weissnat','koss.eleanora@example.net','Hudson LLC','647598037102',74,'waiting','17299',NULL,NULL,4532762911689192,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(48,'Griffin Kshlerin','oarmstrong@example.org','Deckow, Kutch and Muller','296704639079',58,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:45','2016-11-09 21:31:45'),(49,'Helena Mann','houston.beier@example.com','O\'Reilly PLC','043560068273',100,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:46','2016-11-09 21:31:46'),(50,'Amber Corwin','daryl12@example.com','Rempel Group','212655298190',62,'waiting','17299',NULL,NULL,5312336858833205,'2016-11-09 21:31:46','2016-11-09 21:31:46');
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-09 13:35:40
