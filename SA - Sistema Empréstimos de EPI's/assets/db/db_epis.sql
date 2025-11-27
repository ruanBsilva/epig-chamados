CREATE DATABASE  IF NOT EXISTS `db_epis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_epis`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: db_epis
-- ------------------------------------------------------
-- Server version	8.0.43

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
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colaboradores` (
  `idColaborador` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `nascimento` date NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idColaborador`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` VALUES (2,'João da Silva','000.000.000-00','joao_silva@empresa.com','49 9 12457845','1984-04-05','Soldador','2025-11-27 23:07:33'),(3,'Pereira Assunção','111.111.111-11','pereira@empresa.com','49 9 47414831','1452-05-04','Pedreiro','2025-11-27 23:08:25');
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emprestimos`
--

DROP TABLE IF EXISTS `emprestimos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emprestimos` (
  `id_emprestimo` int NOT NULL AUTO_INCREMENT,
  `colaborador` int NOT NULL,
  `equipamento` int NOT NULL,
  `qtd` int NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_prev_emprestimo` date NOT NULL,
  `obs` longtext,
  `data_devolucao` date DEFAULT NULL,
  PRIMARY KEY (`id_emprestimo`),
  KEY `fk_emprestimos_colaboradores_idx` (`colaborador`),
  KEY `fk_emprestimos_equipamentos_idx` (`equipamento`),
  CONSTRAINT `fk_emprestimos_colaboradores` FOREIGN KEY (`colaborador`) REFERENCES `colaboradores` (`idColaborador`),
  CONSTRAINT `fk_emprestimos_equipamentos` FOREIGN KEY (`equipamento`) REFERENCES `equipamentos` (`id_equipamento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimos`
--

LOCK TABLES `emprestimos` WRITE;
/*!40000 ALTER TABLE `emprestimos` DISABLE KEYS */;
INSERT INTO `emprestimos` VALUES (1,2,8,2,'2025-11-10','2025-11-28','Informações adicionais sobre o estado do equipamento ou condições...','2025-11-27'),(2,2,8,1,'2025-11-10','2025-11-12','teste',NULL),(3,2,8,1,'2025-11-19','2025-12-02','teste2',NULL);
/*!40000 ALTER TABLE `emprestimos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamentos`
--

DROP TABLE IF EXISTS `equipamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipamentos` (
  `id_equipamento` int NOT NULL AUTO_INCREMENT,
  `nome_equip` varchar(255) NOT NULL,
  `desc_equip` varchar(255) NOT NULL,
  `estoque` int NOT NULL,
  `img_equip` varchar(255) NOT NULL,
  `codBarra` varchar(255) NOT NULL,
  PRIMARY KEY (`id_equipamento`),
  UNIQUE KEY `id_equipamento_UNIQUE` (`id_equipamento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamentos`
--

LOCK TABLES `equipamentos` WRITE;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
INSERT INTO `equipamentos` VALUES (7,'Capacete PLT','polietileno de alta densidade',15,'6928da5606cff.png','codbarra_6928da56d8771.png'),(8,'Óculos Vonder','Proteção dos olhos do usuário contra impactos de partículas volantes',21,'6928daa942443.png','codbarra_6928daaa19f0d.png'),(9,'Luva Tricotada','Emborrachada Segurança Antiderrapante Reforçada',0,'6928dad93471f.png','codbarra_6928dada0801d.png');
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` char(1) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT (curdate()),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `idusuarios_UNIQUE` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (11,'admin','admin@epig.com','123','Administrador','a','2025-11-27'),(12,'teste1','teste1@epig.com','112233','Teste Um','o','2025-11-27'),(13,'teste2','teste2@epig.com','123321','Teste Dois','v','2025-11-27'),(14,'teste3','teste3@epig.com','123456','Teste Três','a','2025-11-27');
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

-- Dump completed on 2025-11-27 20:29:42
