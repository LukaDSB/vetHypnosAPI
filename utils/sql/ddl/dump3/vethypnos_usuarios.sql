-- MySQL dump 10.13  Distrib 8.0.41, for macos15 (arm64)
--
-- Host: localhost    Database: vethypnos
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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco_id` int DEFAULT NULL,
  `contato_id` int DEFAULT NULL,
  `usuarioscol` varchar(45) DEFAULT NULL,
  `crmv` int DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `clinica` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`),
  KEY `usuario_endereco_fk_idx` (`endereco_id`),
  KEY `usuario_contato_fk_idx` (`contato_id`),
  CONSTRAINT `usuario_contato_fk` FOREIGN KEY (`contato_id`) REFERENCES `contato` (`id`),
  CONSTRAINT `usuario_endereco_fk` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Teste','Medico','teste@teste.com','123',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Novo Usuário','Anestesista','novo@exemplo.com','123456',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Novo Usuário2',NULL,'novo2@exemplo.com','654321',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Novo Usuário2',NULL,'novo3@exemplo.com','654321',NULL,NULL,NULL,NULL,NULL,NULL),(6,'teste',NULL,'novo4@exemplo.com','654321',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Novo Usuário2','teste','novo5@exemplo.com','654321',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Lucas','teste','teste','654321',NULL,NULL,NULL,NULL,NULL,NULL),(11,'Lucas4','sla','lucas4@exemplo.com','654321',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Bilijin','moonwalk','woo@gmail.com','annieareuok?',NULL,NULL,NULL,NULL,NULL,NULL),(14,'Lucas','sla','lucas5@exemplo.com','654321',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Donatas','QuebrarCodigos','donacode@gmail.com','cataflan123',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-27 10:20:29
