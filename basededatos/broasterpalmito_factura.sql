-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: broasterpalmito
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factura` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `nit_cliente` varchar(20) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_pedido` (`id_pedido`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (1,10,'2025-05-19 22:30:11','456','pollos',37.00),(2,12,'2025-05-19 22:37:21','87456847','pollo.srl',39.00),(3,13,'2025-05-19 22:38:57','87456847','pollo.srl',139.00),(4,15,'2025-05-19 22:44:26','87456847','pollo.srl',37.00),(5,16,'2025-05-19 23:12:59','87456847','pollo.srl',190.00),(6,17,'2025-05-19 23:21:15','87456847','pollo.srl',15.00),(7,17,'2025-05-19 23:27:57','456','pollo.srl',15.00),(8,17,'2025-05-19 23:30:34','87456847','pollo.srl',15.00),(9,17,'2025-05-19 23:35:38','87456847','pollo.srl',15.00),(10,18,'2025-05-19 23:36:28','87456847','pollo.srl',90.00),(11,19,'2025-05-20 15:29:59','87456847','pollo.srl',38.00),(12,20,'2025-05-20 15:32:13','87456847','pollo.srl',15.00),(13,22,'2025-05-21 10:32:55','87456847','pollo.srl',33.00),(14,23,'2025-05-21 16:54:15','87456847','pollo.srl',90.00),(15,26,'2025-05-21 19:58:24','87456847','pollo.srl',144.00),(16,27,'2025-05-22 01:33:52','3232424','pollos.srl',57.00),(17,27,'2025-05-22 01:37:52','4656','pollos.srl',57.00),(18,27,'2025-05-22 01:38:55','4656','pollos.srl',57.00),(19,28,'2025-05-22 01:39:28','345546','pollos.srl',57.00),(20,29,'2025-05-22 01:42:08','345546','pollos.srl',114.00),(21,32,'2025-05-23 08:02:45','0','Campero antoni',95.00),(22,33,'2025-05-23 08:28:38','0','Campero antoni',26.00),(23,34,'2025-05-23 08:39:26','0','Campero antoni',108.00),(24,35,'2025-05-23 08:47:48','0','antoni',46.00),(25,36,'2025-05-23 08:50:13','0','Campero antoni',46.00),(26,37,'2025-05-23 08:52:29','0','Campero antoni',24.00),(27,38,'2025-05-27 05:11:36','0','antoni',140.00),(28,39,'2025-05-27 05:35:25','0','Campero antoni',168.00),(29,40,'2025-05-27 00:33:35','8888','antoni',126.00),(30,41,'2025-05-27 07:14:00','343545','antoni',108.00),(31,42,'2025-05-27 07:14:56','343545','antoni',86.00),(32,43,'2025-05-27 10:17:39','673562353','campero anotni',43.00),(33,44,'2025-05-27 19:54:47','343545','antoni',51.00),(34,45,'2025-05-27 20:19:44','343545','antoni',150.00),(35,46,'2025-05-27 20:22:08','64200941','Gary campero',219.00),(36,47,'2025-05-27 20:24:44','343545','antoni',39.00),(37,48,'2025-05-27 20:28:11','343545','antoni',186.00),(38,49,'2025-05-27 20:28:58','64200941','Gary campero',102.00),(39,50,'2025-05-27 20:40:16','343545','antoni',123.00),(40,51,'2025-05-27 20:40:42','343545','antoni',33.00),(41,52,'2025-05-27 20:43:11','343545','antoni',112.00),(42,53,'2025-05-27 20:45:18','343545','antoni',19.00),(43,54,'2025-05-27 20:47:12','8364736','Campero antoni',114.00),(44,55,'2025-05-27 20:49:31','8364736','Campero antoni',84.00),(45,56,'2025-05-27 20:50:05','8364736','Campero antoni',21.00),(46,57,'2025-05-27 20:57:31','343545','antoni',42.00),(47,58,'2025-05-27 20:58:56','64200941','Gary campero',39.00),(48,59,'2025-05-27 21:03:05','8364736','gary campero',186.00),(49,60,'2025-05-27 21:05:31','8364736','gary campero',23.00),(50,60,'2025-05-27 15:05:34','8364736','',23.00),(51,61,'2025-05-27 21:08:45','64200941','Gary campero',42.00),(52,62,'2025-05-27 21:09:11','64200941','Gary campero',24.00),(53,63,'2025-05-27 21:10:44','726w28w','Campero antoni',195.00),(54,64,'2025-05-27 21:11:28','343545','antoni',42.00),(55,65,'2025-05-27 21:11:49','8364736','gary campero',42.00),(56,65,'2025-05-27 15:11:52','8364736','',42.00),(57,66,'2025-05-27 21:14:39','8364736','gary campero',19.00),(58,66,'2025-05-27 15:14:41','8364736','gary campero',19.00),(59,67,'2025-05-27 21:15:14','8364736','gary campero',19.00),(60,68,'2025-05-27 21:15:46','8364736','gary campero',21.00),(61,69,'2025-05-27 21:16:16','8364736','gary campero',33.00),(62,69,'2025-05-27 15:16:18','8364736','gary campero',33.00),(63,70,'2025-05-27 22:42:23','676765','campero.serl',63.00),(64,71,'2025-05-28 10:42:24','672637832','POLLOS.SRL',80.00),(65,72,'2025-05-28 16:52:37','8364736','gary campero',51.00),(66,72,'2025-05-28 10:52:41','8364736','gary campero',51.00),(67,73,'2025-05-29 00:17:46','343545','antoni',144.00),(68,76,'2025-05-29 01:48:36','343545','antoni',132.00),(69,77,'2025-05-29 04:22:41','343545','gary',42.00),(70,78,'2025-05-29 14:40:01','343545','gary',126.00),(71,79,'2025-05-29 14:42:03','2433434','gary campero',77.00),(72,79,'2025-05-29 08:42:06','2433434','gary campero',77.00),(73,80,'2025-05-29 09:05:28','2323232','pollos.srl',80.00),(74,81,'2025-05-29 15:07:37','8364736','coco',88.00),(75,81,'2025-05-29 09:07:48','8364736','coco',88.00);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-01 23:27:23
