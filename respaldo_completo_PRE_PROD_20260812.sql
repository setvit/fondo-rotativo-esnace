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

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '87ced60c-2397-11f1-9a5e-d21e1e3edd99:1-1533';

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
INSERT INTO `cache` VALUES ('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:13:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"crear_comision\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"editar_comision\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"eliminar_comision\";s:1:\"c\";s:3:\"web\";}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:14:\"ver_comisiones\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:19:\"gestionar_pasajeros\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:18:\"subir_cotizaciones\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"generar_cuadro\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"aprobar_cuadro\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"rechazar_cuadro\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"comprar_pasajes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"subir_documentos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"liquidar_comision\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"ver_reportes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:8:\"CUSTODIO\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"JEFE_LOGISTICA\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"CONSULTA\";s:1:\"c\";s:3:\"web\";}}}',1790101745);
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
  `estado` enum('CREADA','CON_PASAJEROS','COTIZANDO','CUADRO_BORRADOR','EN_LOGISTICA','RECHAZADA','APROBADA','LISTA_COMPRA','COMPRADA','EN_EJECUCION','EN_CIERRE','DOCUMENTADA','LIQUIDADA','CERRADA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CREADA',
  `estado_documental` enum('CREADA','COTIZADA','CUADRO_PENDIENTE','CUADRO_APROBADO','PASAJE_COMPRADO','LIQUIDADA','RECHAZADA') COLLATE utf8mb4_unicode_ci DEFAULT 'CREADA',
  `total_valor_pasajes` decimal(10,2) NOT NULL DEFAULT '0.00',
  `puede_comprar` tinyint(1) NOT NULL DEFAULT '0',
  `custodio_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comisiones_codigo_unique` (`codigo`),
  KEY `comisiones_custodio_id_foreign` (`custodio_id`),
  CONSTRAINT `comisiones_custodio_id_foreign` FOREIGN KEY (`custodio_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES (1,'COM-20260624205443','MIAMI','','INTERNACIONAL','2026-06-29','2026-07-05','CREADA','PASAJE_COMPRADO',5430.20,0,1,'2026-06-25 01:54:43','2026-08-12 20:10:35'),(2,'COM-20260704133306','SEGU-SEST-SEGU','EJERCICIO GALAPEX','NACIONAL','2026-07-21','2026-07-31','CREADA','PASAJE_COMPRADO',1234.50,0,1,'2026-07-04 18:33:06','2026-08-12 20:03:49'),(3,'COM-20260812152623','GALAPAGOS','EJERCICIO GALAPEX','NACIONAL','2026-08-17','2026-08-21','CREADA','PASAJE_COMPRADO',1240.30,0,1,'2026-08-12 20:26:23','2026-08-12 20:34:58');
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
INSERT INTO `control_fondo` VALUES (1,10000.00,7905.00,2095.00,79.05,0,NULL,'2026-06-25 00:56:02','2026-08-12 20:34:58');
/*!40000 ALTER TABLE `control_fondo` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones`
--

LOCK TABLES `cotizaciones` WRITE;
/*!40000 ALTER TABLE `cotizaciones` DISABLE KEYS */;
INSERT INTO `cotizaciones` VALUES (4,1,'001-002-000292928373','1003869730001','LATAM AIRLINES','AEROLINEA','VUELOS AL EXTERIOR',1500.00,'2026-06-23','cotizaciones/1/WlCET94FMreFe3k7kcReJqkGT3qaMNjcscQ3WFkE.pdf',1,'2026-06-25 16:38:46','2026-06-25 16:38:46'),(5,1,'001-002-000292928365','1003869730001','AVIANCA AIRLINES','AEROLINEA','PASAJES A MIAMI',1499.00,'2026-06-24','cotizaciones/1/GWdkg6ovPgLMO7GiYXoFL7y4AdbF3xSEsoI1YPSe.pdf',1,'2026-06-25 16:39:20','2026-06-25 16:39:20'),(13,1,'001-002-000292928373','1003869730001','INTIPUNGO AGENCIA DE VIAJES','AGENCIA','ASAS',1212.00,'2026-06-25','cotizaciones/1/3STxLZmFDqNVFWQVFJj3SeNyKMgZBgt7kzh4c9ER.pdf',1,'2026-06-25 18:31:33','2026-06-25 18:31:33'),(18,2,'001-002-000292928365','1003869730001','STALIN AIRLINES','AGENCIA','PASAJES A MIAMI',1230.50,'2026-08-03','cotizaciones/2/OAKzCQFVfU3BMUwR2JuSyXMl7bXJUP9PRXY3dYlU.pdf',1,'2026-07-31 20:24:43','2026-07-31 20:24:43'),(19,2,'001-002-000292928365','1003869730001','RONALD AIRLINES','AGENCIA','PASAJES A MIAMI CARISISIMOS',1220.30,'2026-07-19','cotizaciones/2/wq9lUWBEQ8waQrlBQmcio3GNmycnar0Zous4j9sG.pdf',1,'2026-07-31 20:28:33','2026-07-31 20:28:33'),(21,2,'2918312038210381209','1003648596001','COOPNA AIRLINES','AGENCIA','PASAJES A MIAMI',850.30,'2026-07-31','cotizaciones/2/JvpQ91tDvnA0UQM7vZiPeRHF9DbTbdq9fvPRcSgB.pdf',1,'2026-07-31 20:41:45','2026-07-31 20:41:45'),(22,3,'001-002-000292928373','1003869730001','INTIPUNGO AGENCIA DE VIAJES','AEROLINEA','TEST TEST',1234.20,'2026-08-12','cotizaciones/3/fMGPg4E7IT0TCUSQeUFak7yuczx7gZfRcw0VkZeJ.pdf',1,'2026-08-12 20:27:49','2026-08-12 20:27:49'),(23,3,'001-002-000292928373','1003869730001','AVIANCA AIRLINES','AGENCIA','TEST TEST',2345.50,'2026-08-20','cotizaciones/3/2A2oNJvawxwl6o70I89ILdfjlLvuZSHeiz1NAJQT.pdf',1,'2026-08-12 20:28:18','2026-08-12 20:28:18'),(24,3,'001-002-000292928345','1003869730001','INTIPUNGO AGENCIA DE VIAJES','AGENCIA','TEST TEST',2345.30,'2026-08-12','cotizaciones/3/ljNoUyy6fbjscQBwqCG0jEzkou9yvJogH1JrAMqB.pdf',1,'2026-08-12 20:28:46','2026-08-12 20:28:46');
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
  `cotizacion_ganadora_id` bigint unsigned DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `jefe_logistica_id` bigint unsigned DEFAULT NULL,
  `revisado_por` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `sumilla` text COLLATE utf8mb4_unicode_ci,
  `ruta_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_verificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `cuadros_comparativos` VALUES (11,1,'APROBADO',13,NULL,NULL,NULL,NULL,'Generado automáticamente. Menor valor: $1,212.00 - INTIPUNGO AGENCIA DE VIAJES','cuadros/COM-20260624205443_cuadro_comparativo.pdf','ARE-20260625-BFXWBL','d75d91a9e9a57f0b2312eff542d10721d6a9c75cef789574ad80b3e1d17b2d23',NULL,'2026-06-25 18:31:36','2026-07-31 20:37:42',1),(17,2,'APROBADO',21,NULL,NULL,NULL,NULL,'Generado automáticamente. Menor valor: $850.30 - COOPNA AIRLINES','cuadros/COM-20260704133306_cuadro_comparativo.pdf','ARE-20260731-RGNEZD','52bde38a629cc6c71f4435c17f589bffe16a1c9854b179fd0c24e9eea40bb235',NULL,'2026-07-31 20:41:48','2026-07-31 20:42:27',1),(18,3,'APROBADO',22,NULL,NULL,NULL,NULL,'Generado automáticamente. Menor valor: $1,234.20 - INTIPUNGO AGENCIA DE VIAJES','cuadros/COM-20260812152623_cuadro_comparativo.pdf','ARE-20260812-C1NAW7','c5bada1402597ce128389032c1cd2a829eec28ef547c2bc9a65c7bbea611cb8d',NULL,'2026-08-12 20:29:21','2026-08-12 20:34:08',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_24_193658_create_fondo_rotativo_tables',1),(5,'2026_06_25_000507_create_permission_tables',1),(7,'2026_06_24_205621_create_pasajeros_table',1),(9,'2026_06_25_092903_add_observaciones_to_cuadros_comparativos_table',2),(10,'2026_06_25_115154_add_verification_to_cuadros_comparativos_table',3),(11,'2026_06_25_115425_add_verification_to_cuadros_comparativos_table',3),(12,'2026_06_25_130210_add_ruta_pdf_and_generado_por_to_cuadros_comparativos_table',4),(13,'2026_06_25_133524_add_motivo_to_comisiones_table',5),(14,'2026_07_04_133051_add_motivo_to_comisiones_table',6),(15,'2026_07_31_172122_create_pasajes_table',7),(16,'2026_08_12_151723_add_pasajero_id_to_pasajes_table',8);
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
  `reparto` enum('COOPNA','CODESC','CUINMA','COAVNA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasajeros_comision_id_foreign` (`comision_id`),
  CONSTRAINT `pasajeros_comision_id_foreign` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasajeros`
--

LOCK TABLES `pasajeros` WRITE;
/*!40000 ALTER TABLE `pasajeros` DISABLE KEYS */;
INSERT INTO `pasajeros` VALUES (1,1,'EDUARDO STALIN TUSA VITAR','1003869730','JEFE DE LA DIVISIÓN DE CIBERDEFENSA','COOPNA','2026-06-25 12:34:40','2026-06-25 12:34:40'),(2,1,'TAPIA CHICHANDE ALEX PAUL','0704774967','JEFE DEPARTAMENTO DE CIBERDEFENSA','COOPNA','2026-06-25 12:41:48','2026-06-25 12:41:48'),(3,2,'EDUARDO STALIN TUSA VITAR','1003869730','JEFE DE DIVISIÓN DE INFRAESTRUCTURA','COOPNA','2026-07-04 18:34:02','2026-07-04 18:34:02'),(4,2,'TAPIA CHICHANDE ALEX PAUL','0704774967','JEFE DEPARTAMENTO DE CIBERDEFENSA','COOPNA','2026-07-31 20:29:12','2026-07-31 20:29:12'),(5,3,'EDUARDO STALIN TUSA VITAR','1003869730','JEFE DE LA DIVISIÓN DE CIBERDEFENSA','COOPNA','2026-08-12 20:26:39','2026-08-12 20:26:39'),(6,3,'TAPIA CHICHANDE ALEX PAUL','0704774967','JEFE DE LA DIVISIÓN DE CIBERDEFENSA','CODESC','2026-08-12 20:26:50','2026-08-12 20:26:50');
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
  `numero_factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_factura` date NOT NULL,
  `factura_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COMPRADO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasajes_pasajero_id_foreign` (`pasajero_id`),
  CONSTRAINT `pasajes_pasajero_id_foreign` FOREIGN KEY (`pasajero_id`) REFERENCES `pasajeros` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasajes`
--

LOCK TABLES `pasajes` WRITE;
/*!40000 ALTER TABLE `pasajes` DISABLE KEYS */;
INSERT INTO `pasajes` VALUES (4,1,NULL,13,'LATAM AIRLINES','GUAYAQUIL - MIAMI',5430.20,'001-003-09874993872','2026-08-12','facturas/AHhCzdo1kHCTZSALbiLcjJSsHcMEErAyTVkOHBFZ.pdf','COMPRADO','2026-08-12 20:10:35','2026-08-12 20:10:35'),(5,3,5,22,'LATAM AIRLINES','GUAYAQUIL - MIAMI',1240.30,'001-003-09874993872','2026-08-12','facturas/80Y5lTCiCH8FQvG05CxERtM6mh2WE5EsqJtYk4Oz.pdf','COMPRADO','2026-08-12 20:34:58','2026-08-12 20:34:58');
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
INSERT INTO `sessions` VALUES ('2T105je3FMFSCO7voV3lClm9bZoClsdG2gDaoZYo',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR2JYb1pnM04yNjJ5aUZxUW9UY3ZqV1lFZ0N0Z1YyYVRhQ3Z6bGpaTCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY29taXNpb25lcy8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1786626242),('42TGGJvz7HnmIHy7qCu6AsIsJT0GFsAIZJUwXrAk',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmtkanJ6SFF3MW5McTR5d0Eza2dWWExlRFg1b0hXWXZSa0lyWkR5SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jb21pc2lvbmVzLzMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1786566898),('dmoVFUZ8AWWBu0nLbtvrTtT2GXN7aYG72ZDWsY9k',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS0VzT2JkWEpiWk5KVTRiYnh6YmlZbVk2b29QZkFxYUJCRnQwOVlFUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jb21pc2lvbmVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1790015442),('HvV3ewKjQSYXc55XCDKrKNHAknHqdUcrcTOVUTlj',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoia1l2ZG9ROWt1UFFrVEZuZjdBYmt0M1dKNHMyVVpmY1V2endub2lLTiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY29taXNpb25lcy8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1786732958);
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
INSERT INTO `users` VALUES (1,'TNFG-IG','EDUARDO STALIN','TUSA VITAR','etusa@armada.mil.ec','CUSTODIO',NULL,'$2y$12$ijvAUD605anEcV5JKCUcHebhhGVQjuYX/w2ITQkVmaJQ5xHN.cq3e',1,'yMsuSWmHvxAb4eLXyXEwADKU737L4eSykuiIW1ms4FGi7F1gxfIMIOkmSQrn','2026-06-25 00:57:59','2026-06-25 00:57:59'),(2,'CPFG-EMS','MARCHAN','APELLIDO','logistica.coopna@armada.mil.ec','JEFE_LOGISTICA',NULL,'$2y$12$HYzIga/bdGrWRFEHfD9XKunSQm3DalT3ZhExpsCThH3dWp5GboxV2',1,'c85HJwhjOeGtHRnQDjk6XaMFt7KNu4f7xuGuMKZtiOZlPesBxpzPjWmz1BuD','2026-06-25 00:57:59','2026-07-31 20:32:12');
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

-- Dump completed on 2026-09-21 13:53:47
