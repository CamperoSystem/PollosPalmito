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
-- Temporary view structure for view `productos_mas_vendidos`
--

DROP TABLE IF EXISTS `productos_mas_vendidos`;
/*!50001 DROP VIEW IF EXISTS `productos_mas_vendidos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `productos_mas_vendidos` AS SELECT 
 1 AS `nombre`,
 1 AS `total_vendidos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `ingresos_diarios`
--

DROP TABLE IF EXISTS `ingresos_diarios`;
/*!50001 DROP VIEW IF EXISTS `ingresos_diarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ingresos_diarios` AS SELECT 
 1 AS `dia`,
 1 AS `total_ingresos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `reporte_venta`
--

DROP TABLE IF EXISTS `reporte_venta`;
/*!50001 DROP VIEW IF EXISTS `reporte_venta`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `reporte_venta` AS SELECT 
 1 AS `id_pedido`,
 1 AS `fecha`,
 1 AS `tipo_pedido`,
 1 AS `tipo_entrega`,
 1 AS `metodo_pago`,
 1 AS `total`,
 1 AS `nit_cliente`,
 1 AS `razon_social`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `productos_mas_vendidos`
--

/*!50001 DROP VIEW IF EXISTS `productos_mas_vendidos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `productos_mas_vendidos` AS select `p`.`nombre` AS `nombre`,sum(`d`.`cantidad`) AS `total_vendidos` from (`producto` `p` join `detalle_pedido` `d` on((`p`.`id_producto` = `d`.`id_producto`))) group by `p`.`id_producto` order by `total_vendidos` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ingresos_diarios`
--

/*!50001 DROP VIEW IF EXISTS `ingresos_diarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ingresos_diarios` AS select cast(`pedido`.`fecha` as date) AS `dia`,sum(`pedido`.`total`) AS `total_ingresos` from `pedido` where (`pedido`.`estado` = 'entregado') group by cast(`pedido`.`fecha` as date) order by `dia` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `reporte_venta`
--

/*!50001 DROP VIEW IF EXISTS `reporte_venta`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `reporte_venta` AS select `p`.`id_pedido` AS `id_pedido`,`p`.`fecha` AS `fecha`,`p`.`tipo_pedido` AS `tipo_pedido`,`p`.`tipo_entrega` AS `tipo_entrega`,`p`.`metodo_pago` AS `metodo_pago`,`p`.`total` AS `total`,`f`.`nit_cliente` AS `nit_cliente`,`f`.`razon_social` AS `razon_social` from (`pedido` `p` left join `factura` `f` on((`p`.`id_pedido` = `f`.`id_pedido`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-01 23:27:23
