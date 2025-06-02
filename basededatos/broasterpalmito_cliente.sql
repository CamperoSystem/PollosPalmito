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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text,
  `ubicacion_gps` text,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Campero antoni','7676763','calle 2','-17.4448899, -66.3381587'),(2,'Campero antoni','7676763','calle 2','-17.4449295, -66.3380918'),(3,'Campero antoni','7676763','calle 2','-17.4449384, -66.3380979'),(4,'antoni','32434','carretera confital km 23','-17.44532999805132, -66.33729290024898'),(5,'Campero antoni','7676763','calle 2','-17.4448901, -66.3380661'),(6,'Campero antoni','7676763','calle 2','-17.4448757, -66.3380431'),(7,'antoni','32434','carretera confital km 23','-17.444278439617175, -66.339249150911'),(8,'Campero antoni','7676763','calle 2','-17.4448661, -66.3380901'),(9,'antoni','32434','carretera confital km 23','-17.4439448217139, -66.33977597514004'),(10,'antoni','32434','carretera confital km 23','-17.444823984807655, -66.33814220474946'),(11,'antoni','32434','carretera confital km 23','-17.44417491936391, -66.33942978236443'),(12,'antoni','32434','carretera confital km 23','-17.44429688947321, -66.33939991849242'),(13,'Gary campero','79705986','Carretera confital km 12',''),(14,'antoni','32434','carretera confital km 23','-17.44499241346481, -66.33775987538253'),(15,'antoni','32434','carretera confital km 23','-17.4475075, -66.338215'),(16,'Gary campero','79705986','Carretera confital km 12',''),(17,'antoni','32434','carretera confital km 23','-17.44429688947321, -66.33939991849242'),(18,'antoni','32434','carretera confital km 23',''),(19,'antoni','32434','carretera confital km 23','-17.445573749999998, -66.33832175'),(20,'antoni','32434','carretera confital km 23','-17.44517328429923, -66.3379072393554'),(21,'Campero antoni','7676763','calle 2','-17.4446854, -66.3380782'),(22,'Campero antoni','7676763','calle 2','-17.4448058, -66.3382123'),(23,'Campero antoni','7676763','calle 2','-17.4448058, -66.3382123'),(24,'antoni','32434','carretera confital km 23','-17.444638102894736, -66.33808828768206'),(25,'Gary campero','79705986','Carretera confital km 12',''),(26,'gary campero','7676763','calle 2','-17.4448969, -66.3381181'),(27,'gary campero','7676763','calle 2','-17.4448801, -66.3381283'),(28,'Gary campero','79705986','Carretera confital km 12',''),(29,'Gary campero','79705986','Carretera confital km 12',''),(30,'Campero antoni','79705983','Calle rozas',''),(31,'antoni','32434','carretera confital km 23',''),(32,'gary campero','7676763','calle 2',''),(33,'gary campero','7676763','calle 2',''),(34,'gary campero','7676763','calle 2',''),(35,'gary campero','7676763','calle 2','-17.4448944, -66.3381274'),(36,'gary campero','7676763','calle 2','-17.4448944, -66.3381274'),(37,'gary campero','7676763','calle 2',''),(38,'antoni','32434','carretera confital km 23','-17.376367516461688, -66.18360026270888'),(39,'antoni','32434','carretera confital km 23','-17.44470533498883, -66.33965825996007'),(40,'gary','32434','carretera confital km 23','-17.444377489372748, -66.3392322195509'),(41,'gary','32434','carretera confital km 23','-17.376282782189, -66.1839398810433'),(42,'gary campero','7676763','calle 2','-17.3763013, -66.1840229'),(43,'coco','72763822','kara kara','-17.376207, -66.1840461');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
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
