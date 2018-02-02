-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment` (
  `attachment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  `time_stamp` int(10) NOT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
INSERT INTO `attachment` VALUES (1,'files/9d3b82b167ce9bcf4fba5e02e46c9d04.mp4',1,'video-1515776402','mp4',1516941217),(2,'files/66f13b80f6e4af5079f09305dfde833f.mp4',2,'video-1512379527','mp4',1516953593),(3,'files/6b7e7d64a04324016aa4b0ec691a71db.png',2,'virus_messenger','png',1516953837);
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `currency_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'VNĐ'),(2,'Dollar');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Pending'),(2,'Approved'),(3,'Removed'),(4,'Banned');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic` (
  `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `currency` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `description` longtext NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `time_stamp` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'Bán cặp Tiger Yellow siêu vàng',1,900000,'Cá đã có một bầy con . Cá bố chăm con rất tốt','1953/3/2 Phạm Thế Hiển, P6 Q8 TPHCM','0933640651',2,2,1516941217),(2,'Bán cặp Super Red Thái',1,500000,'Cá đã có 1 bầy con.','1953/3/2 Phạm Thế Hiển, P6 Q8 TPHCM','0933640651',1,2,1516953318);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic_category`
--

DROP TABLE IF EXISTS `topic_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `used` int(10) DEFAULT '0',
  `time_stamp` int(10) DEFAULT NULL,
  `is_root` int(10) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic_category`
--

LOCK TABLES `topic_category` WRITE;
/*!40000 ALTER TABLE `topic_category` DISABLE KEYS */;
INSERT INTO `topic_category` VALUES (1,'Tất cả',66,1513678325,1),(2,'Cá cảnh',53,1513678325,0),(3,'Chó & Mèo',5,1513678325,0),(4,'Thỏ, Hamster và Nhím',3,1513678325,0),(5,'Bò sát',2,1513678325,0),(6,'Các loại thú nuôi khác',3,1513678325,0);
/*!40000 ALTER TABLE `topic_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic_category_data`
--

DROP TABLE IF EXISTS `topic_category_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic_category_data` (
  `data_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `topic_id` int(10) NOT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic_category_data`
--

LOCK TABLES `topic_category_data` WRITE;
/*!40000 ALTER TABLE `topic_category_data` DISABLE KEYS */;
INSERT INTO `topic_category_data` VALUES (1,2,1),(2,2,2);
/*!40000 ALTER TABLE `topic_category_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'superadmin','$2y$10$IML/IFJ3RYWvMxegMa3j8uzJrEDMSFtjtVTYshdBKQSO2tnA5CAsS',1,'Vũ Lê Hoàng Sơn','1953/3/2 Phạm Thế Hiển P6 Q8 TPHCM','0933640651','avatars/87dbe61eb23f12ad794b1ee2b7b93716.jpg','covers/bac66afa1ba13f11e2baf631561d013c.png'),(2,'tramnguyen','$2y$10$5LXem0HOuABcBBxZHYE4KOGdGnZycJwTD/qeYFduZsAoSHxc4CV.W',2,'Nguyễn Ngọc Trâm','1953/3/2 Phạm Thế Hiển P6 Q8 TPHCM','01697987539','avatars/840284b8e5810762a636c131ff946ac2.jpg','covers/90d8cf8416f4b9cdcef3f22ed04bf0f8.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,'Super Admin'),(2,'Admin'),(3,'Member');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-30 17:56:50
