-- MySQL dump 10.13  Distrib 9.6.0, for macos26.4 (arm64)
--
-- Host: localhost    Database: fondo_rotativo_esnace
-- ------------------------------------------------------
-- Server version	9.6.0

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '87ced60c-2397-11f1-9a5e-d21e1e3edd99:1-3395';

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `cierres_mensuales`
--

DROP TABLE IF EXISTS `cierres_mensuales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cierres_mensuales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `periodo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'SEPTIEMBRE 2026',
  `periodo_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ESNACE-COOPNA-FR-2026-09',
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ESNACE-COOPNA-FR-2026-09',
  `fecha_cierre` date NOT NULL,
  `saldo_inicial_banco` decimal(10,2) NOT NULL DEFAULT '10000.00',
  `total_debitos_banco` decimal(10,2) NOT NULL COMMENT 'Total comisiones 9563.42',
  `saldo_final_banco` decimal(10,2) NOT NULL COMMENT '431.55 BanEcuador',
  `comision_bancaria` decimal(10,2) NOT NULL DEFAULT '4.37' COMMENT '4.37 + IVA 0.66 = 5.03',
  `valor_a_reponer` decimal(10,2) NOT NULL COMMENT '9568.45 con IVA / 9563.42 sin',
  `num_transacciones` int NOT NULL DEFAULT '7' COMMENT '7 transacciones BanEcuador',
  `detalle_transacciones` json DEFAULT NULL COMMENT 'Detalle 7 transacciones BanEcuador con BUSAN desglose',
  `cuenta_bancaria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3-00167809-0 FR-ESTACION NAVAL CENTRO - BANECUADOR',
  `usuario_id` bigint unsigned DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cierres_mensuales_periodo_codigo_unique` (`periodo_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cierres_mensuales`
--

LOCK TABLES `cierres_mensuales` WRITE;
/*!40000 ALTER TABLE `cierres_mensuales` DISABLE KEYS */;
INSERT INTO `cierres_mensuales` VALUES (1,'SEPTIEMBRE 2026 - CONCILIADO BANECUADOR EXACTO - 7 TRANSACCIONES','ESNACE-COOPNA-FR-2026-09','ESNACE-COOPNA-FR-2026-09','2026-10-06',10000.00,9563.42,431.55,4.37,9568.45,7,'[{\"iva\": 0.66, \"desc\": \"COMISION EMISION TARJETA 367724757\", \"fecha\": \"07/09/2026\", \"saldo\": 9994.97, \"debito\": 4.37}, {\"desc\": \"ALICANTE 2193.09\", \"fecha\": \"21/09/2026\", \"saldo\": 7801.88, \"debito\": 2193.09}, {\"desc\": \"LIQUIDADA 318.55\", \"fecha\": \"24/09/2026\", \"saldo\": 7483.33, \"debito\": 318.55}, {\"desc\": \"BUSAN PASAJE 5438.70\", \"fecha\": \"25/09/2026\", \"saldo\": 2044.63, \"debito\": 5438.7}, {\"desc\": \"BUSAN TASAS 350\", \"fecha\": \"28/09/2026\", \"saldo\": 1694.63, \"debito\": 350}, {\"desc\": \"LIMA 777.78\", \"fecha\": \"29/09/2026\", \"saldo\": 916.85, \"debito\": 777.78}, {\"desc\": \"LIQUIDADA 485.30\", \"fecha\": \"30/09/2026\", \"saldo\": 431.55, \"debito\": 485.3}]','3-00167809-0 - 7 trans $9567.79 + IVA $0.66',1,'Cierre conciliado exacto BanEcuador - 7 trans - BUSAN $5438.70+$350 - $9563.42 comisiones + $5.03 tarjeta = $9568.45 - Saldo $431.55','2026-10-07 21:04:52','2026-10-07 21:04:52');
/*!40000 ALTER TABLE `cierres_mensuales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comisiones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destino` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('NACIONAL','INTERNACIONAL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_retorno` date NOT NULL,
  `estado` enum('CREADA','CON_PASAJEROS','COTIZADA','CUADRO_BORRADOR','CUADRO_PENDIENTE','PASAJE_COMPRADO','CUADRO_APROBADO','LIQUIDADA','ANULADA') COLLATE utf8mb4_unicode_ci DEFAULT 'CREADA',
  `estado_documental` enum('CREADA','COTIZADA','CUADRO_PENDIENTE','CUADRO_PENDIENTE_APROBACION','CUADRO_APROBADO','CUADRO_RECHAZADO','PASAJE_COMPRADO','LIQUIDADA','RECHAZADA') COLLATE utf8mb4_unicode_ci DEFAULT 'CREADA',
  `total_valor_pasajes` decimal(10,2) NOT NULL DEFAULT '0.00',
  `informe_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informe_fecha` date DEFAULT NULL,
  `fecha_liquidacion` timestamp NULL DEFAULT NULL,
  `puede_comprar` tinyint(1) NOT NULL DEFAULT '0',
  `custodio_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comisiones_codigo_unique` (`codigo`),
  KEY `comisiones_custodio_id_foreign` (`custodio_id`),
  CONSTRAINT `comisiones_custodio_id_foreign` FOREIGN KEY (`custodio_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES (1,'COM-20260921140224','ESPAÑA - ALICANTE','Fase LIVEX del Ejercicio Internacional CARTAGO-26','INTERNACIONAL','2026-09-26','2026-10-03','LIQUIDADA','LIQUIDADA',2193.09,'informes_comision/CRiVvtl30cwmZYJy9UyWpVtkfWP5vJreIZIr8aTb.pdf','2026-10-09','2026-10-09 19:17:43',0,1,'2026-09-21 19:02:24','2026-10-09 19:18:16'),(2,'COM-20260923182516','GUAYAQUIL-QUITO-GUAYAQUIL','Entrega y traslado de documentación de carácter institucional con destino al Comando Conjunto de las Fuerzas Armadas (CCFFAA) en la ciudad de Quito.','NACIONAL','2026-09-25','2026-09-25','LIQUIDADA','LIQUIDADA',318.55,'informes_comision/Yz6cfZ9VmbvwanC3rn75HOdlFYKSz6eszf8W0UTg.pdf','2026-09-09','2026-10-09 16:39:14',0,1,'2026-09-23 23:25:16','2026-10-09 16:39:14'),(3,'COM-20260925151104','GUAYAQUIL-BUSAN-GUAYAQUIL','PARTICIPACIÓN EN EL CURSO IASWEPT 2026 EN COREA DEL SUR','INTERNACIONAL','2026-10-03','2026-12-01','CREADA','PASAJE_COMPRADO',5788.70,NULL,NULL,NULL,0,1,'2026-09-25 20:11:04','2026-10-12 20:44:47'),(4,'COM-20260929175110','GUAYAQUIL-LIMA-GUAYAQUIL','PARTICIPACIÓN EN I CONFERENCIA NAVAL INTERAMERICANA DE CIBERDEFENSA','INTERNACIONAL','2026-11-03','2026-11-07','CREADA','PASAJE_COMPRADO',777.78,NULL,NULL,NULL,0,1,'2026-09-29 22:51:10','2026-09-30 19:46:23'),(5,'COM-20260930144832','GUAYAQUIL-QUITO-GUAYAQUIL','EXPOSICIÓN PLAN DE DEFENSA INTERNA','NACIONAL','2026-10-01','2026-10-01','LIQUIDADA','LIQUIDADA',485.30,'informes_comision/opa7ClpuMMKNPD1GEKsTaFUDallNdMeeErHZ0kEG.pdf','2026-10-09','2026-10-09 20:29:08',0,1,'2026-09-30 19:48:32','2026-10-09 20:29:08'),(7,'COM-20261008190741','GUAYAQUIL-QUITO-GUAYAQUIL','VIAJE AUTORIZADO POR ESNACE','NACIONAL','2026-10-12','2026-10-13','CUADRO_BORRADOR','PASAJE_COMPRADO',494.50,NULL,NULL,NULL,0,1,'2026-10-09 00:08:12','2026-10-14 20:32:14');
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_fondo`
--

DROP TABLE IF EXISTS `control_fondo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `control_fondo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `monto_asignado` decimal(10,2) NOT NULL DEFAULT '10000.00',
  `monto_ejecutado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saldo_disponible` decimal(10,2) NOT NULL DEFAULT '10000.00',
  `porcentaje_ejecutado` decimal(5,2) NOT NULL DEFAULT '0.00',
  `alerta_60_enviada` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_ultima_reposicion` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_fondo`
--

LOCK TABLES `control_fondo` WRITE;
/*!40000 ALTER TABLE `control_fondo` DISABLE KEYS */;
INSERT INTO `control_fondo` VALUES (1,10000.00,9563.42,436.58,95.63,0,'2026-09-21','2026-06-25 00:56:02','2026-09-30 23:00:42');
/*!40000 ALTER TABLE `control_fondo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_fondo_global`
--

DROP TABLE IF EXISTS `control_fondo_global`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `control_fondo_global` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `monto_total_banco` decimal(10,2) NOT NULL DEFAULT '10000.00',
  `monto_asignado_total` decimal(10,2) NOT NULL DEFAULT '28075.15',
  `saldo_global` decimal(10,2) NOT NULL DEFAULT '10000.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_fondo_global`
--

LOCK TABLES `control_fondo_global` WRITE;
/*!40000 ALTER TABLE `control_fondo_global` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_fondo_global` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizaciones`
--

DROP TABLE IF EXISTS `cotizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cotizaciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comision_id` bigint unsigned NOT NULL,
  `nro_proforma` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruc_proveedor` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_proveedor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_proveedor` enum('AEROLINEA','AGENCIA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle_pasajes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `fecha_cotizacion` date NOT NULL,
  `archivo_proforma` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrado_por` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cotizaciones_comision_id_foreign` (`comision_id`),
  KEY `cotizaciones_registrado_por_foreign` (`registrado_por`),
  CONSTRAINT `cotizaciones_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cotizaciones_registrado_por_foreign` FOREIGN KEY (`registrado_por`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones`
--

LOCK TABLES `cotizaciones` WRITE;
/*!40000 ALTER TABLE `cotizaciones` DISABLE KEYS */;
INSERT INTO `cotizaciones` VALUES (2,1,'PROFORMA-COMSUB-002-2026','1791949072001','Air Europa Lineas Aereas Sociedad Anonima Sociedad Unipersonal','AEROLINEA','GUAYAQUIL - ALICANTE\r\nALICANTE - GUAYAQUIL',2304.83,'2026-09-21','cotizaciones/1/Y16sOjqeKnZdQ02QlUeHiqfUwJkKw9oOyKvdYNqG.pdf',1,'2026-09-21 21:41:40','2026-09-21 21:41:40'),(4,1,'PROFORMA-COMSUB-003-2026','1791807154001','AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR','AEROLINEA','GUAYAQUIL - ALICANTE\r\nALICANTE - GUAYAQUIL',2892.64,'2026-09-26','cotizaciones/1/ZBh5QJpgIp8QSrRy45X0dkze6aKqJUd5ZAWHBd3t.png',1,'2026-09-21 22:08:02','2026-09-21 22:08:02'),(5,1,'PROFORMA-COMSUB-001-2026','1790727203001','AVIANCA ECUADOR S.A.','AEROLINEA','GUAYAQUIL - ALICANTE\r\nALICANTE - GUAYAQUIL',2193.09,'2026-09-26','cotizaciones/1/jQJXOOTKo9UkWPEMTsf4CgXQFxjTg7nWV0pcqqnp.pdf',1,'2026-09-21 22:23:22','2026-09-21 22:23:22'),(13,2,'PROFORMA-COOPNA-001-2026','1791807154001','LATAM Airlines Ecuador S.A.','AEROLINEA','GUAYAQUIL - QUITO\r\nQUITO - GUAYAQUIL',318.55,'2026-09-24','cotizaciones/2/YmahPGRXDLQYttRTPIBr1CjZDoroW6fT8IbbYgVk.png',1,'2026-09-24 19:14:10','2026-09-24 19:14:10'),(14,2,'PROFORMA-COOPNA-001-2026','1790727203001','Aerolínea Avianca Ecuador S.A.','AEROLINEA','GUAYAQUIL - QUITO\r\nQUITO - GUAYAQUIL',359.95,'2026-09-24','cotizaciones/2/mP1odKd7NId7FAU7z067f2kn9PhvC4wZ2zVJNdE4.pdf',1,'2026-09-24 19:17:20','2026-09-24 19:17:20'),(17,3,'PROFORMA-CODESC-003-2026','PLAT. VIRTUAL','RESERVATIONS DEAL','AEROLINEA','GUAYAQUIL ECU - BUSAN KOR\r\nBUSAN KOR - GUAYAQUIL ECU',6853.28,'2026-09-25','cotizaciones/3/FvTxL1vDh7W9ucOv38RWegfGAUnDHULqEwi6D0bT.pdf',1,'2026-09-25 20:32:04','2026-09-25 20:32:04'),(18,3,'PROFORMA-CODESC-002-2026','PLAT. VIRTUAL','PRICE LINE','AEROLINEA','GUAYAQUIL ECU - BUSAN KOR /\r\nBUSAN KOR - GUAYAQUIL ECU',7044.74,'2026-09-25','cotizaciones/3/bJ1AoOK8gzN2qHeJ4a3Y4sq9ki4EwvStbCtnvFlV.pdf',1,'2026-09-25 23:47:31','2026-09-25 23:47:31'),(19,3,'PROFORMA-CODESC-001-2026','PLAT. VIRTUAL','KIWI.COM','AEROLINEA','GUAYAQUIL ECU - BUSAN KOR /\r\nBUSAN KOR - GUAYAQUIL ECU',5438.70,'2026-09-25','cotizaciones/3/5IhXQI6pKVsX9ZskT1NLgPRbndD6DrIbM9I4iUPq.pdf',1,'2026-09-26 00:17:13','2026-09-26 00:17:13'),(20,4,'PROFORMA-COOPNA-001-2026','1790727203001','AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR','AEROLINEA','GUAYAQUIL - LIMA / LIMA - GUAYAQUIL',777.78,'2026-09-29','cotizaciones/4/eWg1TeIm5Ndhy2a3rWiOxqdce8EGAFofXdOWKWab.pdf',1,'2026-09-29 22:53:11','2026-09-29 22:53:11'),(21,4,'PROFORMA-COOPNA-002-2026','1790727203001','AVIANCA ECUADOR S.A.','AEROLINEA','GUAYAQUIL - LIMA / LIMA - GUAYAQUIL',907.94,'2026-09-29','cotizaciones/4/Ia6eimaYzcWS0oan1mYriaBj7y3KfDZq7hJeaPLK.pdf',1,'2026-09-29 22:54:10','2026-09-29 22:54:10'),(22,4,'PROFORMA-COOPNA-003-2026','0991273514001','Compañía Panameña de Aviación S.A.','AEROLINEA','GUAYAQUIL - LIMA / LIMA - GUAYAQUIL',852.38,'2026-09-29','cotizaciones/4/3X7RGwpzt6yWUCKAguR8YyYhwMgopYUqt2FCpcME.pdf',1,'2026-09-29 23:06:04','2026-09-29 23:06:04'),(25,5,'PROFORMA-COOPNA-001-2026','1790727203001','AVIANCA ECUADOR S.A.','AEROLINEA','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',538.10,'2026-09-30','cotizaciones/5/WqFtCbAw18AcDkjkKhnpAGLtM1tBFk9GS2TfqtdN.png',1,'2026-09-30 20:07:48','2026-09-30 20:07:48'),(26,5,'PROFORMA-COOPNA-002-2026','1791807154001','AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR','AEROLINEA','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',485.30,'2026-09-30','cotizaciones/5/9BPPrbU2jlClQvX666RpmTqFbQbmocrFB8FypjFY.png',1,'2026-09-30 22:50:42','2026-09-30 22:50:42'),(27,7,'PROFORMA-ESNACE-001-2026','1791807154001','AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR','AEROLINEA','Pasaje aéreo para 1 PAX - GUAYAQUIL-QUITO-GUAYAQUIL',261.05,'2026-10-08','cotizaciones/tvTH0vnyFuLAscSzIGkKh6vSjwx7aEAtzhOukUEt.png',1,'2026-10-09 00:30:45','2026-10-09 00:30:45'),(28,7,'PROFORMA-ESNACE-002-2026','1790727203001','AVIANCA ECUADOR S.A.','AEROLINEA','Pasaje aéreo para 1 PAX - GUAYAQUIL-QUITO-GUAYAQUIL',270.25,'2026-10-08','cotizaciones/lrsEETkvfaoDB0KORVLJj5VmqLTg3wExmT2TfYRf.pdf',1,'2026-10-09 00:34:00','2026-10-09 00:34:00'),(29,7,'PROFORMA-ESNACE-003-2026','00000000000','AVIANCA ECUADOR S.A. / AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR','AEROLINEA','Pasaje aéreo para 1 PAX - GUAYAQUIL-QUITO-GUAYAQUIL',247.25,'2026-10-08','cotizaciones/9prcfdzaf2wlqkqOaGfSHWaAUCYwVFEIqiNrNNoj.pdf',1,'2026-10-09 01:22:46','2026-10-09 01:22:46');
/*!40000 ALTER TABLE `cotizaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuadros_comparativos`
--

DROP TABLE IF EXISTS `cuadros_comparativos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuadros_comparativos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comision_id` bigint unsigned NOT NULL,
  `estado` enum('BORRADOR','PENDIENTE_APROBACION','APROBADO','RECHAZADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BORRADOR',
  `archivo_aprobado_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cotizacion_ganadora_id` bigint unsigned DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `jefe_logistica_id` bigint unsigned DEFAULT NULL,
  `revisado_por` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `sumilla` text COLLATE utf8mb4_unicode_ci,
  `ruta_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_verificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo_aprobado_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aprobado_por` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_aprobacion` timestamp NULL DEFAULT NULL,
  `comentario_aprobacion` text COLLATE utf8mb4_unicode_ci,
  `usuario_aprobacion_id` bigint unsigned DEFAULT NULL,
  `hash_documento` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo_rechazo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `generado_por` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cuadros_comparativos_comision_id_unique` (`comision_id`),
  UNIQUE KEY `cuadros_comparativos_codigo_verificacion_unique` (`codigo_verificacion`),
  KEY `cuadros_comparativos_cotizacion_ganadora_id_foreign` (`cotizacion_ganadora_id`),
  KEY `cuadros_comparativos_jefe_logistica_id_foreign` (`jefe_logistica_id`),
  KEY `cuadros_comparativos_generado_por_foreign` (`generado_por`),
  CONSTRAINT `cuadros_comparativos_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cuadros_comparativos_cotizacion_ganadora_id_foreign` FOREIGN KEY (`cotizacion_ganadora_id`) REFERENCES `cotizaciones` (`id`),
  CONSTRAINT `cuadros_comparativos_generado_por_foreign` FOREIGN KEY (`generado_por`) REFERENCES `users` (`id`),
  CONSTRAINT `cuadros_comparativos_jefe_logistica_id_foreign` FOREIGN KEY (`jefe_logistica_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuadros_comparativos`
--

LOCK TABLES `cuadros_comparativos` WRITE;
/*!40000 ALTER TABLE `cuadros_comparativos` DISABLE KEYS */;
INSERT INTO `cuadros_comparativos` VALUES (2,1,'APROBADO',NULL,5,NULL,NULL,NULL,NULL,'Generado automáticamente. Menor valor: $2,193.09 - AVIANCA ECUADOR S.A.','cuadros/COM-20260921140224_cuadro_comparativo.pdf','ARE-20260921-ESJQCK',NULL,NULL,NULL,NULL,NULL,'bac333f0bd7dfb08e6d1e8092fbd84e591a18e192ac12d866f72b270553ccf45',NULL,'2026-09-21 22:23:28','2026-09-22 17:02:07',1),(12,2,'APROBADO',NULL,13,NULL,NULL,NULL,NULL,'Generado automaticamente. Menor valor: $318.55 - LATAM Airlines Ecuador S.A. (NACIONAL: AVIANCA/LATAM - 2 proformas)','cuadros/COM-20260923182516_cuadro_comparativo.pdf','ARE-20260924-YMLMRI',NULL,NULL,NULL,NULL,NULL,'9deb6417519dbb2d195b50f601e53878f1575e044f8a9e8ea2b0c74cee2aff9d',NULL,'2026-09-24 19:37:47','2026-09-24 19:41:13',1),(14,3,'APROBADO',NULL,19,NULL,NULL,NULL,NULL,'Generado automaticamente. Menor valor: $5,438.70 - KIWI.COM (INTERNACIONAL - 3 proformas)','cuadros/COM-20260925151104_cuadro_comparativo.pdf','ARE-20260925-GCSN1N',NULL,NULL,NULL,NULL,NULL,'871b8618180b955823fec54cbe3685df2245f19d0e59e2e1e4e0f22d6720d95c',NULL,'2026-09-26 00:18:11','2026-09-28 14:10:19',1),(15,4,'APROBADO',NULL,20,NULL,NULL,NULL,NULL,'Generado automaticamente. Menor valor: $777.78 - AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR (INTERNACIONAL - 3 proformas)','cuadros/COM-20260929175110_cuadro_comparativo.pdf','ARE-20260929-8HOIUP',NULL,NULL,NULL,NULL,NULL,'83e4c42c994fd205b7c39a842654a91fcd7826a322471f3a36338cb9c3c9104b',NULL,'2026-09-29 23:06:08','2026-09-30 19:44:52',1),(17,5,'APROBADO',NULL,26,NULL,NULL,NULL,NULL,'Generado automaticamente. Menor valor: $485.30 - AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR (NACIONAL: AVIANCA/LATAM - 2 proformas)','cuadros/COM-20260930144832_cuadro_comparativo.pdf','ARE-20260930-X5J477',NULL,NULL,NULL,NULL,NULL,'d3b2383c92402c241d778d7c642b407466ac0c54e3561b55a6b386444c5896de',NULL,'2026-09-30 22:50:45','2026-09-30 22:59:56',1),(18,7,'APROBADO','cuadros_aprobados/ZWmkOSHVRjfPhM2erSv7L4yK6DZvn9NbOynoMQAE.pdf',27,'Ganadora: AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR $261.05',NULL,NULL,NULL,NULL,NULL,'ARE-20261008-780D2B',NULL,'etusa@armada.mil.ec','2026-10-14 20:14:39','Aprobado por menor valor: AVIANCA ECUADOR S.A. / AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR $247.25 - Firma electrónica válida',NULL,'706b1183aea911f484d7dcd974e54c818dbd3ec2bffd7de8968b1aee8240606a',NULL,'2026-10-09 00:34:13','2026-10-14 20:14:39',1);
/*!40000 ALTER TABLE `cuadros_comparativos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comision_id` bigint unsigned NOT NULL,
  `pasajero_id` bigint unsigned DEFAULT NULL,
  `categoria` enum('INICIO','CIERRE','OTRO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_subida` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentos_comision_id_foreign` (`comision_id`),
  KEY `documentos_pasajero_id_foreign` (`pasajero_id`),
  CONSTRAINT `documentos_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documentos_pasajero_id_foreign` FOREIGN KEY (`pasajero_id`) REFERENCES `pasajeros` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
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
-- Table structure for table `fondos_repartos`
--

DROP TABLE IF EXISTS `fondos_repartos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fondos_repartos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reparto` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estructura` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_pasaje` enum('INTERIOR','EXTERIOR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `clasificacion_contable` enum('INTERIOR','EXTERIOR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EXTERIOR',
  `monto_asignado` decimal(10,2) NOT NULL,
  `monto_ejecutado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saldo_actual` decimal(10,2) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_reparto_estructura` (`reparto`,`estructura`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fondos_repartos`
--

LOCK TABLES `fondos_repartos` WRITE;
/*!40000 ALTER TABLE `fondos_repartos` DISABLE KEYS */;
INSERT INTO `fondos_repartos` VALUES (1,'ESNACE','FONDO_ROTATIVO','EXTERIOR','EXTERIOR',10000.00,9563.42,436.58,'Fondo Rotativo ESNACE','2026-10-05 20:17:29','2026-10-05 20:17:29');
/*!40000 ALTER TABLE `fondos_repartos` ENABLE KEYS */;
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
-- Table structure for table `liquidacion_comision`
--

DROP TABLE IF EXISTS `liquidacion_comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `liquidacion_comision` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `liquidacion_id` bigint unsigned NOT NULL,
  `comision_id` bigint unsigned NOT NULL,
  `valor` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `liquidacion_comision_liquidacion_id_foreign` (`liquidacion_id`),
  KEY `liquidacion_comision_comision_id_foreign` (`comision_id`),
  CONSTRAINT `liquidacion_comision_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `liquidacion_comision_liquidacion_id_foreign` FOREIGN KEY (`liquidacion_id`) REFERENCES `liquidaciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liquidacion_comision`
--

LOCK TABLES `liquidacion_comision` WRITE;
/*!40000 ALTER TABLE `liquidacion_comision` DISABLE KEYS */;
INSERT INTO `liquidacion_comision` VALUES (1,2,2,318.55,'2026-10-05 21:30:32','2026-10-05 21:30:32'),(2,3,5,485.30,'2026-10-05 21:52:45','2026-10-05 21:52:45');
/*!40000 ALTER TABLE `liquidacion_comision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liquidaciones`
--

DROP TABLE IF EXISTS `liquidaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `liquidaciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_asignado` decimal(10,2) NOT NULL DEFAULT '10000.00',
  `monto_ejecutado_liquidacion` decimal(10,2) NOT NULL,
  `saldo_disponible_al_corte` decimal(10,2) NOT NULL,
  `porcentaje_ejecutado` decimal(5,2) NOT NULL,
  `cantidad_comisiones` int NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'PENDIENTE',
  `fecha_liquidacion` date NOT NULL,
  `fecha_reposicion` date DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `administrador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TNFG-IG-IF TUSA VITAR EDUARDO',
  `aprobador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TNNV-AB LOPEZ LUIS DAVID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `liquidaciones_codigo_unique` (`codigo`),
  KEY `liquidaciones_user_id_foreign` (`user_id`),
  CONSTRAINT `liquidaciones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liquidaciones`
--

LOCK TABLES `liquidaciones` WRITE;
/*!40000 ALTER TABLE `liquidaciones` DISABLE KEYS */;
INSERT INTO `liquidaciones` VALUES (2,'LIQ-ESNACE-20261005-163032',10000.00,318.55,436.58,95.63,1,'PENDIENTE','2026-10-05',NULL,NULL,'NO SE REPORTO NOVEDADES EN EL VUELO POR PARTE DEL COMISIONADO\nObservaciones por pasajero:\n- Com 2 Pas CPCB-SU CAPELO ZAMBRANO JOSE STALIN: COMISIÓN SE EJECUTÓ SIN NOVEDADES ESPECIALES\n','TNFG-IG-IF TUSA VITAR EDUARDO','TNNV-AB LOPEZ LUIS DAVID','2026-10-05 21:30:32','2026-10-05 21:30:32'),(3,'LIQ-ESNACE-20261005-165245',10000.00,485.30,436.58,95.63,1,'PENDIENTE','2026-10-05',NULL,NULL,'NO SE REPORTÓ NOVEDADES ESPECIALES DEL VUELO','TNFG-IG-IF TUSA VITAR EDUARDO','TNNV-AB LOPEZ LUIS DAVID','2026-10-05 21:52:45','2026-10-05 21:52:45');
/*!40000 ALTER TABLE `liquidaciones` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_24_193658_create_fondo_rotativo_tables',1),(5,'2026_06_25_000507_create_permission_tables',1),(7,'2026_06_24_205621_create_pasajeros_table',1),(9,'2026_06_25_092903_add_observaciones_to_cuadros_comparativos_table',2),(10,'2026_06_25_115154_add_verification_to_cuadros_comparativos_table',3),(11,'2026_06_25_115425_add_verification_to_cuadros_comparativos_table',3),(12,'2026_06_25_130210_add_ruta_pdf_and_generado_por_to_cuadros_comparativos_table',4),(13,'2026_06_25_133524_add_motivo_to_comisiones_table',5),(14,'2026_07_04_133051_add_motivo_to_comisiones_table',6),(15,'2026_07_31_172122_create_pasajes_table',7),(16,'2026_08_12_151723_add_pasajero_id_to_pasajes_table',8),(17,'2026_09_22_000001_create_fondos_repartos_table',9),(18,'2026_09_22_000002_create_movimientos_fondos_table',9),(19,'2026_09_28_100000_create_liquidaciones_tables',10),(20,'2026_09_28_add_cargo_kiwi_busan',10),(21,'2026_09_28_add_cargo_kiwi_busan_1',10),(22,'2025_10_06_150000_add_banecuador_fields_to_pasajes',11),(23,'2025_10_06_160000_create_cierres_mensuales_table',12),(24,'2026_10_06_000001_create_cierres_mensuales_table',13),(25,'2026_10_07_000000_create_cierres_mensuales_table',14),(26,'2026_10_09_000000_add_informe_liquidacion_to_comisiones',15),(27,'2026_10_09_104121_add_informe_liquidacion_to_comisiones',15),(28,'2026_10_09_100000_add_informe_path_to_pasajes',16),(29,'2026_10_09_110000_factura_compartida',17),(30,'2026_10_09_150000_add_aprobacion_to_cuadros',18),(31,'2026_10_14_151241_add_archivo_aprobado_to_cuadros',19);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos_fondos`
--

DROP TABLE IF EXISTS `movimientos_fondos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimientos_fondos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fondo_reparto_id` bigint unsigned NOT NULL,
  `comision_id` bigint unsigned DEFAULT NULL,
  `pasajero_id` bigint unsigned DEFAULT NULL,
  `codigo_comision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_pasaje` decimal(10,2) NOT NULL,
  `tipo_movimiento` enum('COMPRA','DESCUENTO','CARGO_ADICIONAL_KIWI','TASAS_IMPUESTOS','REEMBOLSO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COMPRA',
  `motivo_ajuste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plataforma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_original` decimal(10,2) DEFAULT NULL,
  `numero_factura_kiwi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_anterior` decimal(10,2) NOT NULL,
  `saldo_nuevo` decimal(10,2) NOT NULL,
  `es_sobregiro` tinyint(1) NOT NULL DEFAULT '0',
  `valor_sobregiro` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movimientos_fondos_fondo_reparto_id_foreign` (`fondo_reparto_id`),
  KEY `movimientos_fondos_comision_id_foreign` (`comision_id`),
  KEY `movimientos_fondos_pasajero_id_foreign` (`pasajero_id`),
  KEY `movimientos_fondos_user_id_foreign` (`user_id`),
  CONSTRAINT `movimientos_fondos_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `movimientos_fondos_fondo_reparto_id_foreign` FOREIGN KEY (`fondo_reparto_id`) REFERENCES `fondos_repartos` (`id`),
  CONSTRAINT `movimientos_fondos_pasajero_id_foreign` FOREIGN KEY (`pasajero_id`) REFERENCES `pasajeros` (`id`) ON DELETE SET NULL,
  CONSTRAINT `movimientos_fondos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_fondos`
--

LOCK TABLES `movimientos_fondos` WRITE;
/*!40000 ALTER TABLE `movimientos_fondos` DISABLE KEYS */;
INSERT INTO `movimientos_fondos` VALUES (1,1,3,NULL,'COM-20260925151104',350.00,'CARGO_ADICIONAL_KIWI','Cobro adicional Kiwi tasas BUSAN GUAYAQUIL-BUSAN-GUAYAQUIL $350','KIWI',5438.70,NULL,786.58,436.58,0,0.00,1,'2026-10-05 20:17:29','2026-10-05 20:17:29');
/*!40000 ALTER TABLE `movimientos_fondos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificaciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tipo` enum('CUADRO_PENDIENTE','CUADRO_APROBADO','CUADRO_RECHAZADO','ALERTA_60') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `leida` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notificaciones_user_id_foreign` (`user_id`),
  CONSTRAINT `notificaciones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasajeros`
--

DROP TABLE IF EXISTS `pasajeros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pasajeros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comision_id` bigint unsigned NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reparto` enum('COOPNA','CODESC','CUINMA','COAVNA','COMSUB','COMACO','COGUAR','COMCUB','COMSUP','DIGEIM','ESNACE','ESNAFA','JEM','DIBIEN','DIRNEA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasajeros_comision_id_foreign` (`comision_id`),
  CONSTRAINT `pasajeros_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasajeros`
--

LOCK TABLES `pasajeros` WRITE;
/*!40000 ALTER TABLE `pasajeros` DISABLE KEYS */;
INSERT INTO `pasajeros` VALUES (1,1,'CPCB-SS Rafael Coba Loor','1715756886','JEFE DEL DEPARTAMENTO DE SISTEMA DE ARMAS','COMSUB','2026-09-21 19:28:33','2026-09-21 19:28:33'),(2,2,'CPCB-SU CAPELO ZAMBRANO JOSE STALIN','1716794068','JEFE DIVISIÓN DE OPERACIONES MARÍTIMAS','COOPNA','2026-09-24 15:32:15','2026-09-24 15:32:15'),(3,3,'TNNV-SU DAQUILEMA SORIA JORGE LUIS','0924157456','JEFE DE OPERACIONES DE LAMCUE','CODESC','2026-09-25 20:12:57','2026-09-25 20:12:57'),(4,3,'TNNV-SU RICAURTE YEPEZ FRANCISCO XAVIER','0924291263','JEFE DEL DEPARTAMENTO DE OPERACIONES','CODESC','2026-09-25 20:14:42','2026-09-25 20:14:42'),(5,4,'CPNV-EMT TAPIA CHICHANDE ALEX PAUL','1709426850','JEFE DEL DEPARTAMENTO DE CIBERDEFENSA','COOPNA','2026-09-29 22:51:51','2026-09-29 22:51:51'),(9,5,'CPNV-EMC ORDOÑEZ PAREDES CARLOS ALFREDO','0913436432','JEFE DEL DEPARTAMENTO DE PLANIFICACIÓN DE COOPNA','COOPNA','2026-09-30 20:49:44','2026-09-30 20:49:44'),(10,5,'CPFG-EM BARRIONUEVO VACA OSCAR ALFREDO','1711398246','COMANDANTE DE SUBMARINO','COMSUB','2026-09-30 20:50:33','2026-09-30 20:50:33'),(11,7,'CPCB-AB VEGA CRESPO RUTH LAURA','0920729977','COORDINADOR TÉCNICO DE ABASTECIMIENTOS Y FINANZAS','ESNACE','2026-10-09 00:16:41','2026-10-09 00:16:41');
/*!40000 ALTER TABLE `pasajeros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasajes`
--

DROP TABLE IF EXISTS `pasajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pasajes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comision_id` bigint unsigned NOT NULL,
  `pasajero_id` bigint unsigned DEFAULT NULL,
  `cotizacion_id` bigint unsigned DEFAULT NULL,
  `aerolinea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `numero_factura` text COLLATE utf8mb4_unicode_ci,
  `fecha_factura` date NOT NULL,
  `factura_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factura_grupo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ID grupo factura compartida',
  `es_factura_principal` tinyint(1) NOT NULL DEFAULT '1',
  `tipo_comprobante` enum('FACTURA_SRI','COMPROBANTE_EXTERIOR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FACTURA_SRI',
  `tipo_pago` enum('TARJETA_DEBITO_BANECUADOR','TRANSFERENCIA','EFECTIVO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TARJETA_DEBITO_BANECUADOR',
  `numero_voucher` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Voucher tarjeta BanEcuador',
  `correo_notificacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Correo institucional notificacion BanEcuador',
  `proveedor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KIWI.COM',
  `pase_abordo_ida` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pase_abordo_retorno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informe_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Informe individual por pasajero',
  `informe_fecha` date DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COMPRADO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasajes_pasajero_id_foreign` (`pasajero_id`),
  CONSTRAINT `pasajes_pasajero_id_foreign` FOREIGN KEY (`pasajero_id`) REFERENCES `pasajeros` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasajes`
--

LOCK TABLES `pasajes` WRITE;
/*!40000 ALTER TABLE `pasajes` DISABLE KEYS */;
INSERT INTO `pasajes` VALUES (1,1,1,5,'AVIANCA / IBERIA','GYE-ALC',2193.09,'ETICKET = FACTURA (AVIANCA/Iberia) - ETKT 202 2491970481 / ETKT 20249197048101 / ETKT 20249197048102 / ETKT 20249197048103 - IDA GYE-BOG AV8380 / BOG-MAD AV46 / MAD-ALC IB1009 - RETORNO ALC-MAD IB1012 / MAD-BOG AV0011 / BOG-GYE AV8391','2026-09-22','facturas/vOWG050No1Rb9vEmXEwAg2FwcfCYtHybWSMhLzms.pdf','1',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM','pases_abordo/mT93Xsqc9RrYUiPfzbu52EQaJ8BNKXGjmc34zkxV.pdf','pases_abordo/uO7xlu6tBqMsVKdqvWhtKGrhzJIQgGHPayIFJbG6.pdf','informes_comision/2YlQw2WbY7sHEqOUlHNNohUkINjuarV1L7IDHcJC.pdf',NULL,'COMPRADO','2026-09-23 15:25:58','2026-10-12 20:19:41'),(2,2,2,13,'LATAM AIRLINES','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',318.55,'LA4623246ESHU','2026-09-24','facturas/RwaSu7sqcFz9tWRBT6x2FdleAjXX5mgomyEWLDOm.pdf','2',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM','pases_abordo/PqEEcjPrLamciaoVbWcvZFsqrVJqQweXABoIlvxx.jpg','pases_abordo/TeQHA0jExmmmN0WjoLIVl1z5J4Ybt490YKJybW1D.jpg',NULL,NULL,'COMPRADO','2026-09-24 20:56:50','2026-10-09 16:39:07'),(3,3,3,19,'KIWI.COM - RESERVA 847921151','GYE-BUSAN-GYE 2 PAX DAQUILEMA/RICAURTE - Reserva 847921151',5438.70,'847921151 - RESERVA KIWI - GYE-BUSAN-GYE 2 PAX - $5438.70 - Pagado con N/D 443105148 del 28/09/2026 segun Edo Cta BanEcuador 3-00167809-0','2026-09-28','facturas/TQ9QFfCyVUXjvJGBqfXo75lCNnh8jC4dx6lZiMZY.pdf','FACT-3-BUSAN-COM-20260925151104',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM',NULL,NULL,NULL,NULL,'COMPRADO','2026-09-28 14:13:19','2026-10-12 21:26:59'),(4,4,5,20,'LATAM AIRLINES','GUAYAQUIL - LIMA - GUAYAQUIL',777.78,'LA4627885VSRF','2026-09-29','facturas/MBd9LsvtCakVeXYP9wHWszIHZqYEElRru5zBFdXB.pdf','4',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM',NULL,NULL,NULL,NULL,'COMPRADO','2026-09-30 19:46:23','2026-09-30 19:46:23'),(5,5,9,26,'LATAM AIRLINES','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',485.30,'LA4620127NUAG','2026-09-30','facturas/GDoqqS4Nglf6AhzTszYEpwCeenG8rqwHL4eokdPi.pdf','5',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM','pases_abordo/J0RxftN8dlhWpzGgsOtuLaaaDYZYy0DHs4ys2sxw.pdf','pases_abordo/Mda8IKngy9aBkJFafKl42zd1V5f4LX2oLUYWnQ9l.jpg','informes_comision/U5KwhD6gTzhNrZISmmgFLqmhY16ZYfwqT2cMqwuc.pdf',NULL,'COMPRADO','2026-09-30 23:00:42','2026-10-09 18:48:17'),(6,5,10,26,'LATAM AIRLINES','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',0.00,'LA4620127NUAG','2026-09-30','','5',0,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM','pases_abordo/l7WcShW2vyKmKjITIuTHbE6jjRPUuKh1iYx0ueNR.jpg','pases_abordo/xbGA2ZB8jx75a0UvcEd78nXiDRmi766EpaE940Sr.jpg','informes_comision/eRJOtuxNp3yum6PP7rIqDPfR1ZnEuAXotVNxooga.pdf',NULL,'COMPRADO','2026-10-09 16:58:10','2026-10-09 18:49:11'),(10,7,11,NULL,'LATAM / AVIANCA','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',247.25,'LA4629421SQYD','2026-10-09','facturas/SxnNP8h0fpf7FHhAjNXeXSTQbLwZ727B2DE1DygA.pdf','10',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'AVIANCA / LATAM',NULL,NULL,NULL,NULL,'COMPRADO','2026-10-09 18:58:30','2026-10-09 18:58:30'),(11,3,4,NULL,'PLATAFORMA VIRTUAL KIWI','GUAYAQUIL - BUSAN - GUAYAQUIL',0.00,'847921151','2026-09-30','facturas/TQ9QFfCyVUXjvJGBqfXo75lCNnh8jC4dx6lZiMZY.pdf','FACT-3-BUSAN-COM-20260925151104',0,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM',NULL,NULL,NULL,NULL,'COMPRADO','2026-10-09 19:39:23','2026-10-09 19:59:41'),(12,3,3,19,'KIWI.COM - TASAS - RESERVA 847921151','GYE-BUSAN-GYE - TASAS PLATAFORMA KIWI - Reserva 847921151',350.00,'847921151 - RESERVA KIWI - TASAS PLATAFORMA KIWI BUSAN $350 - Pagado con N/D 4492684260 del 28/09/2026 segun Edo Cta BanEcuador - Total reserva $5438.70 + $350 = $5788.70','2026-09-28','facturas/TQ9QFfCyVUXjvJGBqfXo75lCNnh8jC4dx6lZiMZY.pdf','FACT-3-BUSAN-COM-20260925151104',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'KIWI.COM',NULL,NULL,NULL,NULL,'COMPRADO','2026-10-12 20:44:47','2026-10-12 21:26:59'),(13,7,11,NULL,'LATAM AIRLINES','GUAYAQUIL - QUITO / QUITO - GUAYAQUIL',247.25,'LA4629421SQYD','2026-10-08','facturas/PwgefuD3nUxrWTkzE9zfo4shqcuM2fA5HBPE5Iqm.pdf','13',1,'FACTURA_SRI','TARJETA_DEBITO_BANECUADOR',NULL,NULL,'LATAM AIRLINES',NULL,NULL,NULL,NULL,'COMPRADO','2026-10-14 20:32:14','2026-10-14 20:32:14');
/*!40000 ALTER TABLE `pasajes` ENABLE KEYS */;
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
INSERT INTO `password_reset_tokens` VALUES ('etusa@armada.mil.ec','$2y$12$hodNSuSLYemS.oP0YCR/pOx5z4nDg1oUEjVdZc6wqV0n0LlxpMvR2','2026-07-31 19:31:04');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'crear_comision','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(2,'editar_comision','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(3,'eliminar_comision','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(4,'ver_comisiones','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(5,'gestionar_pasajeros','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(6,'subir_cotizaciones','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(7,'generar_cuadro','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(8,'aprobar_cuadro','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(9,'rechazar_cuadro','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(10,'comprar_pasajes','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(11,'subir_documentos','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(12,'liquidar_comision','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(13,'ver_reportes','web','2026-06-25 01:02:01','2026-06-25 01:02:01');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(4,1),(5,1),(6,1),(7,1),(10,1),(11,1),(4,2),(8,2),(9,2),(12,2),(13,2),(4,3),(13,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
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
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'CUSTODIO','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(2,'JEFE_LOGISTICA','web','2026-06-25 01:02:01','2026-06-25 01:02:01'),(3,'CONSULTA','web','2026-06-25 01:02:01','2026-06-25 01:02:01');
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
INSERT INTO `sessions` VALUES ('gYS9266hWUfhyGC3Pr0VVIzW4wF2Uz80irH4ilZI',1,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMUEwVU9tMm80RUVvWUN6T1VlaE1HTTl0OXJ3V3JHRUNnbEFOcUNhZiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY2llcnJlcy1tZW5zdWFsZXMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1792156993);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('CUSTODIO','JEFE_LOGISTICA','CONSULTA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CONSULTA',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'TNNV-AB','LUIS DAVID','LOPEZ','etusa@armada.mil.ec','JEFE_LOGISTICA',NULL,'$2y$12$ijvAUD605anEcV5JKCUcHebhhGVQjuYX/w2ITQkVmaJQ5xHN.cq3e',1,'wAtps56lMN2wlwEslSHkIinsmjQ94xLEoZXwhexSP8An22hhi99tVF9w5k81','2026-06-25 00:57:59','2026-06-25 00:57:59'),(2,'CPFG-EMS','MARCHAN','APELLIDO','logistica.coopna@armada.mil.ec','JEFE_LOGISTICA',NULL,'$2y$12$HYzIga/bdGrWRFEHfD9XKunSQm3DalT3ZhExpsCThH3dWp5GboxV2',1,'xj8AXT76auewYoSBvw3d5XhUofG9uIIlxqqj1kfWRSAA5L61pDwu2sbwUDNd','2026-06-25 00:57:59','2026-07-31 20:32:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-16  8:25:25
