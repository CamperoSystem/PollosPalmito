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
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `tipo_pedido` enum('en_linea','en_local') NOT NULL,
  `tipo_entrega` varchar(50) DEFAULT NULL,
  `metodo_pago` enum('qr','efectivo','tarjeta') DEFAULT NULL,
  `estado` enum('pendiente','en_preparacion','listo','entregado','cancelado') DEFAULT 'pendiente',
  `total` decimal(10,2) DEFAULT NULL,
  `facturado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_pedido`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (5,NULL,1,'2025-05-19 13:47:43','en_local','recoger','efectivo','entregado',37.00,0),(6,NULL,1,'2025-05-19 13:51:40','en_local','recoger','efectivo','entregado',89.00,0),(7,NULL,1,'2025-05-19 13:55:00','en_local','recoger','efectivo','entregado',7.00,0),(8,NULL,1,'2025-05-19 21:43:55','en_local',NULL,'efectivo','entregado',168.00,0),(9,NULL,1,'2025-05-19 21:44:32','en_local',NULL,'tarjeta','entregado',168.00,0),(10,NULL,1,'2025-05-19 22:03:46','en_local',NULL,'tarjeta','entregado',37.00,0),(11,NULL,1,'2025-05-19 22:35:27','en_local',NULL,'tarjeta','entregado',39.00,0),(12,NULL,1,'2025-05-19 22:37:15','en_local',NULL,'tarjeta','entregado',39.00,0),(13,NULL,1,'2025-05-19 22:38:50','en_local',NULL,'tarjeta','entregado',139.00,0),(14,NULL,1,'2025-05-19 22:43:03','en_local',NULL,'efectivo','entregado',37.00,0),(15,NULL,1,'2025-05-19 22:44:20','en_local',NULL,'efectivo','entregado',37.00,0),(16,NULL,1,'2025-05-19 23:12:52','en_local',NULL,'efectivo','entregado',190.00,0),(17,NULL,1,'2025-05-19 23:21:08','en_local',NULL,'efectivo','entregado',15.00,0),(18,NULL,1,'2025-05-19 23:36:22','en_local',NULL,'efectivo','entregado',90.00,0),(19,NULL,1,'2025-05-20 15:29:50','en_local',NULL,'tarjeta','entregado',38.00,0),(20,NULL,1,'2025-05-20 15:32:08','en_local',NULL,'efectivo','entregado',15.00,0),(21,NULL,1,'2025-05-20 15:37:13','en_local',NULL,'tarjeta','entregado',38.00,0),(22,NULL,1,'2025-05-21 10:32:50','en_local',NULL,'efectivo','entregado',33.00,0),(23,NULL,1,'2025-05-21 16:54:10','en_local',NULL,'tarjeta','entregado',90.00,0),(24,NULL,1,'2025-05-21 18:51:11','en_local',NULL,'tarjeta','entregado',69.00,0),(25,NULL,1,'2025-05-21 19:38:15','en_local',NULL,'qr','entregado',171.00,0),(26,NULL,2,'2025-05-21 19:58:19','en_local',NULL,'qr','entregado',144.00,0),(27,NULL,2,'2025-05-22 01:27:15','en_local',NULL,'efectivo','entregado',57.00,0),(28,NULL,2,'2025-05-22 01:39:15','en_local',NULL,'efectivo','entregado',57.00,0),(29,NULL,2,'2025-05-22 01:41:15','en_local',NULL,'efectivo','entregado',114.00,0),(30,NULL,2,'2025-05-22 01:43:51','en_local',NULL,'efectivo','entregado',2.00,0),(31,NULL,2,'2025-05-22 01:44:03','en_local',NULL,'efectivo','entregado',2.00,0),(32,1,1,'2025-05-23 08:02:45','en_linea','domicilio','qr','entregado',95.00,0),(33,2,1,'2025-05-23 08:28:38','en_linea','domicilio','qr','entregado',26.00,0),(34,3,1,'2025-05-23 08:39:26','en_linea','domicilio','qr','entregado',108.00,0),(35,4,1,'2025-05-23 08:47:48','en_linea','domicilio','qr','entregado',46.00,0),(36,5,1,'2025-05-23 08:50:13','en_linea','domicilio','qr','entregado',46.00,0),(37,6,1,'2025-05-23 08:52:29','en_linea','domicilio','qr','entregado',24.00,0),(38,7,1,'2025-05-27 05:11:36','en_linea','domicilio','qr','entregado',140.00,0),(39,8,1,'2025-05-27 05:35:25','en_linea','domicilio','qr','entregado',168.00,0),(40,NULL,2,'2025-05-27 00:33:17','en_local',NULL,'qr','entregado',126.00,0),(41,9,1,'2025-05-27 07:14:00','en_linea','domicilio','qr','entregado',108.00,0),(42,10,1,'2025-05-27 07:14:56','en_linea','domicilio','qr','entregado',86.00,0),(43,NULL,2,'2025-05-27 10:17:20','en_local',NULL,'qr','entregado',43.00,0),(44,11,1,'2025-05-27 19:54:47','en_linea','domicilio','qr','entregado',51.00,0),(45,12,1,'2025-05-27 20:19:44','en_linea','domicilio','qr','entregado',150.00,0),(46,13,1,'2025-05-27 20:22:08','en_linea','domicilio','qr','entregado',219.00,0),(47,14,1,'2025-05-27 20:24:44','en_linea','domicilio','qr','entregado',39.00,0),(48,15,1,'2025-05-27 20:28:11','en_linea','domicilio','qr','entregado',186.00,0),(49,16,1,'2025-05-27 20:28:58','en_linea','domicilio','qr','entregado',102.00,0),(50,17,1,'2025-05-27 20:40:16','en_linea','domicilio','qr','entregado',123.00,0),(51,18,1,'2025-05-27 20:40:42','en_linea','domicilio','qr','entregado',33.00,0),(52,19,1,'2025-05-27 20:43:11','en_linea','domicilio','qr','entregado',112.00,0),(53,20,1,'2025-05-27 20:45:18','en_linea','domicilio','qr','entregado',19.00,0),(54,21,1,'2025-05-27 20:47:12','en_linea','domicilio','qr','entregado',114.00,0),(55,22,1,'2025-05-27 20:49:31','en_linea','domicilio','qr','entregado',84.00,0),(56,23,1,'2025-05-27 20:50:05','en_linea','domicilio','qr','entregado',21.00,0),(57,24,1,'2025-05-27 20:57:31','en_linea','domicilio','qr','entregado',42.00,0),(58,25,1,'2025-05-27 20:58:56','en_linea','domicilio','qr','entregado',39.00,0),(59,26,1,'2025-05-27 21:03:05','en_linea','domicilio','qr','entregado',186.00,0),(60,27,1,'2025-05-27 21:05:31','en_linea','domicilio','qr','entregado',23.00,0),(61,28,1,'2025-05-27 21:08:45','en_linea','domicilio','qr','entregado',42.00,0),(62,29,1,'2025-05-27 21:09:11','en_linea','domicilio','qr','entregado',24.00,0),(63,30,1,'2025-05-27 21:10:44','en_linea','domicilio','qr','entregado',195.00,0),(64,31,1,'2025-05-27 21:11:28','en_linea','domicilio','qr','entregado',42.00,0),(65,32,1,'2025-05-27 21:11:49','en_linea','domicilio','qr','entregado',42.00,0),(66,33,1,'2025-05-27 21:14:39','en_linea','domicilio','qr','entregado',19.00,0),(67,34,1,'2025-05-27 21:15:14','en_linea','domicilio','qr','entregado',19.00,0),(68,35,1,'2025-05-27 21:15:46','en_linea','domicilio','qr','entregado',21.00,0),(69,36,1,'2025-05-27 21:16:16','en_linea','domicilio','qr','entregado',33.00,0),(70,NULL,2,'2025-05-27 22:42:10','en_local',NULL,'efectivo','entregado',63.00,0),(71,NULL,2,'2025-05-28 10:42:09','en_local',NULL,'qr','entregado',80.00,0),(72,37,1,'2025-05-28 16:52:37','en_linea','domicilio','qr','entregado',51.00,0),(73,38,1,'2025-05-29 00:17:46','en_linea','domicilio','qr','entregado',144.00,0),(74,NULL,2,'2025-05-28 19:46:39','en_local',NULL,'qr','entregado',180.00,0),(75,NULL,2,'2025-05-28 19:47:02','en_local',NULL,'qr','pendiente',8.00,0),(76,39,1,'2025-05-29 01:48:36','en_linea','domicilio','qr','entregado',132.00,0),(77,40,1,'2025-05-29 04:22:41','en_linea','domicilio','qr','entregado',42.00,0),(78,41,1,'2025-05-29 14:40:01','en_linea','domicilio','qr','entregado',126.00,0),(79,42,1,'2025-05-29 14:42:03','en_linea','domicilio','qr','entregado',77.00,0),(80,NULL,2,'2025-05-29 09:05:10','en_local',NULL,'qr','entregado',80.00,0),(81,43,1,'2025-05-29 15:07:37','en_linea','domicilio','qr','pendiente',88.00,0),(82,NULL,2,'2025-05-29 09:11:58','en_local',NULL,'efectivo','pendiente',171.00,0);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-01 23:27:22
