-- MySQL dump 10.13  Distrib 8.0.41, for macos15 (arm64)
--
<<<<<<< HEAD
<<<<<<< HEAD:utils/sql/ddl/dump2/dosesanestesicas_dosagem.sql
-- Host: 127.0.0.1    Database: vethypnos
=======
-- Host: localhost    Database: vethypnos
>>>>>>> fa4ebf0 (Base sprint 4):utils/sql/ddl/base_sprint_4/vethypnos_dosagem.sql
=======
<<<<<<< HEAD:utils/sql/ddl/base_sprint_4/vethypnos_dosagem.sql
-- Host: localhost    Database: vethypnos
=======
-- Host: 127.0.0.1    Database: vethypnos
>>>>>>> 89a1afc (Contato nao testado):utils/sql/ddl/dump2/dosesanestesicas_dosagem.sql
>>>>>>> db62bd3 (Contato nao testado)
-- ------------------------------------------------------
-- Server version	9.2.0

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
-- Table structure for table `dosagem`
--

DROP TABLE IF EXISTS `dosagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosagem` (
  `prescricao_id` int NOT NULL,
  `medicamento_id` int NOT NULL,
  `dose_min` decimal(5,2) DEFAULT NULL,
  `dose_max` decimal(5,2) DEFAULT NULL,
  `volume_min` decimal(5,2) DEFAULT NULL,
  `volume_max` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`prescricao_id`,`medicamento_id`),
  KEY `fkDosagemMedicamento` (`medicamento_id`),
  CONSTRAINT `fkDosagemMedicamento` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamento` (`id`),
  CONSTRAINT `fkDosagemPrescricao` FOREIGN KEY (`prescricao_id`) REFERENCES `prescricoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosagem`
--

LOCK TABLES `dosagem` WRITE;
/*!40000 ALTER TABLE `dosagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `dosagem` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-27 12:23:08
