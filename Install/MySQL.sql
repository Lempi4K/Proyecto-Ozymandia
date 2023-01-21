-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: USER_DATA
-- ------------------------------------------------------
-- Server version	8.0.31

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

--
-- Current Database: `USER_DATA`
--

/*!40000 DROP DATABASE IF EXISTS `USER_DATA`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `USER_DATA` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `USER_DATA`;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `USER_ID` int unsigned DEFAULT NULL,
  `N_CTRL` varchar(14) NOT NULL,
  `MAT` varchar(6) DEFAULT NULL,
  `CURP` varchar(18) DEFAULT NULL,
  `NOMBRES` varchar(30) DEFAULT NULL,
  `APELLIDOS` varchar(30) DEFAULT NULL,
  `F_NACIMIENTO` date DEFAULT NULL,
  `GRADO` varchar(1) DEFAULT NULL,
  `GRUPO` varchar(1) DEFAULT NULL,
  `CARRERA` varchar(40) DEFAULT NULL,
  `A_INICIO` varchar(4) DEFAULT NULL,
  `A_GRAD` varchar(4) DEFAULT NULL,
  `GEN_LABEL` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`N_CTRL`),
  KEY `USER_ID_FK` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` (`USER_ID`, `N_CTRL`, `MAT`, `CURP`, `NOMBRES`, `APELLIDOS`, `F_NACIMIENTO`, `GRADO`, `GRUPO`, `CARRERA`, `A_INICIO`, `A_GRAD`, `GEN_LABEL`) VALUES (1,'1283088','203307','MOPL050323HCHRNN0A','Leonardo','Moreno Pinto','2005-03-23','5','G','Programacion','2020','2023','2020_2023_G'),(3,'2342338','203308','XXXXXXXXXXXXXXXXXX','Ashby Aldir','Olvera Medrano','1980-01-01','5','G','Programacion','2020','2023','2020_2023_G'),(4,'12313','203309','XXXXXXXXXXXXXXXXXX','Omar','Reyes Villalobos','1980-01-01','5','A','Programacion','2020','2023','2020_2023_A'),(13,'234335','201611','MOPL050323HCHRNNA0','Leonardo','Moreno Pinto','2005-03-23','5','G','Programacion','2020','2023','2020_2023_G');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`Admin`@`%`*/ /*!50003 TRIGGER `ALUMNOS_BINS_TRG` BEFORE INSERT ON `alumnos` FOR EACH ROW BEGIN
insert into USUARIOS(PERM, ESTADO, TIPO) value (0, 1, 1);
insert into CREDENCIALES (USER_ID, USER, PASS) value (
    (select MAX(USUARIOS.USER_ID) from USUARIOS),
    CONCAT("alu.", NEW.MAT),
    CONCAT(
    		SUBSTRING("abcdefghijklmnopqrstuvwxyzz", (rand()*26+1), 1),
			SUBSTRING("ABCDEFGHIJKLMNOPQRSTUVWXYZZ", (rand()*26+1), 1),
			SUBSTRING("abcdefghijklmnopqrstuvwxyzz", (rand()*26+1), 1),

SUBSTRING("@#*%!//", (rand()*6+1), 1),
ROUND((rand()*9000+1000), 0)	));

insert into PERM_LABELS(USER_ID, JSON) value (
    (select MAX(USUARIOS.USER_ID) from USUARIOS),
    '{"A": [], "G": [], "I": []}'
);

set NEW.USER_ID = (select MAX(USER_ID) from USUARIOS);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `credenciales`
--

DROP TABLE IF EXISTS `credenciales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credenciales` (
  `USER_ID` int unsigned NOT NULL,
  `USER` varchar(20) DEFAULT NULL,
  `PASS` varchar(20) DEFAULT NULL,
  `TOKEN` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  KEY `USER_ID_FK` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credenciales`
--

LOCK TABLES `credenciales` WRITE;
/*!40000 ALTER TABLE `credenciales` DISABLE KEYS */;
INSERT INTO `credenciales` (`USER_ID`, `USER`, `PASS`, `TOKEN`) VALUES (2,'Mirel.Corpu','gYw%1777','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjIsImlhdCI6MTY3MzkyMDA5OCwiZXhwIjoxNjc0NTI0ODk4LCJpc3MiOiJzZXJ2ZXIiLCJwcm0iOjEsImRrbSI6M30.dhHjlM742NqprIulBiRGLm9HlsawS1RO17xu95KJzAU'),(5,'Noser.Mench','zWg%7298',NULL),(6,'Danie.Moral','iWk*7574',NULL),(3,'alu.203308','aRh#7517','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjMsImlhdCI6MTY3NDI3MTc4MywiZXhwIjoxNjc0ODc2NTgzLCJpc3MiOiJzZXJ2ZXIiLCJwcm0iOjUsImRrbSI6M30.aM9aiv8yWVBIjMLsMep0_pmCFo2r5-pGXZEeWsXOhF8'),(4,'alu.203309','gRm*5517',NULL),(7,'Rosa.Gómez','mVp%1702',NULL),(8,'Javie.Medra','yZf/2185',NULL),(9,'Janet.Herna','zXq*3434',NULL),(10,'Aarón.Barró','cMc/7648',NULL),(11,'Franc.Garcí','xKg/3815',NULL),(12,'Contr.Escol','nCt%3904',NULL),(13,'alu.201611','cGx/3808','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjEzLCJpYXQiOjE2NzQyNDI4MDksImV4cCI6MTY3NDg0NzYwOSwiaXNzIjoic2VydmVyIiwicHJtIjo2LCJka20iOjF9.idn0rcq1AfAwpPG4FkJB3CPJ7ghd4gqV7r0xt_JsmhY'),(1,'alu.203307','lPn!6728','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjEsImlhdCI6MTY3Mzk5MTA5NywiZXhwIjoxNjc0NTk1ODk3LCJpc3MiOiJzZXJ2ZXIiLCJwcm0iOjEsImRrbSI6MX0.RpA5SD3kQnpBf9NL0CQKYFM-hOdjVzfOVHbvfFMDwxM'),(14,'asdgh.asdas.2676','asasd',NULL),(15,'asdgh.asdas','asasd',NULL);
/*!40000 ALTER TABLE `credenciales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docentes`
--

DROP TABLE IF EXISTS `docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docentes` (
  `USER_ID` int unsigned DEFAULT NULL,
  `DOCE_ID` int unsigned NOT NULL AUTO_INCREMENT,
  `CURP` varchar(18) DEFAULT NULL,
  `NOMBRES` varchar(30) DEFAULT NULL,
  `APELLIDOS` varchar(30) DEFAULT NULL,
  `F_NACIMIENTO` date DEFAULT NULL,
  PRIMARY KEY (`DOCE_ID`),
  KEY `USER_ID_FK` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docentes`
--

LOCK TABLES `docentes` WRITE;
/*!40000 ALTER TABLE `docentes` DISABLE KEYS */;
INSERT INTO `docentes` (`USER_ID`, `DOCE_ID`, `CURP`, `NOMBRES`, `APELLIDOS`, `F_NACIMIENTO`) VALUES (2,1,'XXXXXXXXXXXXXXXXXX','Mireles','Corpus','1980-01-01'),(5,2,'XXXXXXXXXXXXXXXXXX','Noser','Menchaca','1980-01-01'),(6,3,'XXXXXXXXXXXXXXXXXX','Daniel','Morales','1980-01-01'),(7,4,'XXXXXXXXXXXXXXXXXX','Rosa','Gómez','1980-01-01'),(8,5,'XXXXXXXXXXXXXXXXXX','Javier','Medrano','1980-01-01'),(9,6,'XXXXXXXXXXXXXXXXXX','Janeth','Hernandez','1980-01-01'),(10,7,'XXXXXXXXXXXXXXXXXX','Aarón','Barrón','1980-01-01'),(11,8,'XXXXXXXXXXXXXXXXXX','Francisco Javier','García Valles','1980-01-01'),(12,9,'XXXXXXXXXXXXXXXXXX','Control','Escolar','1980-01-01'),(14,10,'asda','asdghjg','asdasd','0000-00-00'),(15,11,'asd','asdghjg','asdasd','0000-00-00');
/*!40000 ALTER TABLE `docentes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`Admin`@`%`*/ /*!50003 TRIGGER `DOCENTES_BINS_TRG` BEFORE INSERT ON `docentes` FOR EACH ROW BEGIN
insert into USUARIOS(PERM, ESTADO, TIPO) value (4, 1, 2);
insert into CREDENCIALES (USER_ID, USER, PASS) value (
    (select MAX(USUARIOS.USER_ID) from USUARIOS),
    CONCAT(SUBSTRING(NEW.NOMBRES, 1, 5), ".", SUBSTRING(NEW.APELLIDOS, 1, 5)),
    CONCAT(
    		SUBSTRING("abcdefghijklmnopqrstuvwxyzz", (rand()*26+1), 1),
			SUBSTRING("ABCDEFGHIJKLMNOPQRSTUVWXYZZ", (rand()*26+1), 1),
			SUBSTRING("abcdefghijklmnopqrstuvwxyzz", (rand()*26+1), 1),

SUBSTRING("@#*!%//", (rand()*6+1), 1),
ROUND((rand()*9000+1000), 0)	));

insert into PERM_LABELS(USER_ID, JSON) value (
    (select MAX(USUARIOS.USER_ID) from USUARIOS),
    '{"A": [], "G": [], "I": []}'
);

set NEW.USER_ID = (select MAX(USER_ID) from USUARIOS);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etiquetas` (
  `LABEL_ID` int unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL,
  PRIMARY KEY (`LABEL_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` (`LABEL_ID`, `NOMBRE`) VALUES (1,'Administrativo'),(2,'General'),(3,'Invitado');
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perm_labels`
--

DROP TABLE IF EXISTS `perm_labels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perm_labels` (
  `USER_ID` int unsigned NOT NULL,
  `LABEL_ID` int unsigned NOT NULL,
  `SUBLABEL_ID` int unsigned NOT NULL,
  `JSON` json DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perm_labels`
--

LOCK TABLES `perm_labels` WRITE;
/*!40000 ALTER TABLE `perm_labels` DISABLE KEYS */;
INSERT INTO `perm_labels` (`USER_ID`, `LABEL_ID`, `SUBLABEL_ID`, `JSON`) VALUES (1,0,0,'{\"A\": [], \"G\": [1, 2, 3, 4, 5, 6, 7], \"I\": []}'),(2,0,0,'{\"A\": [], \"G\": [1, 3, 4, 6, 7], \"I\": []}'),(3,0,0,'{\"A\": [], \"G\": [1, 2], \"I\": []}'),(4,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(5,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(6,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(7,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(8,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(9,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(10,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(11,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(12,0,0,'{\"A\": [], \"G\": [], \"I\": []}'),(13,0,0,'{\"A\": [], \"G\": [1, 2], \"I\": []}'),(14,0,0,'{\"A\": [], \"G\": [2, 3], \"I\": []}'),(15,0,0,'{\"A\": [], \"G\": [2, 3, 4], \"I\": []}');
/*!40000 ALTER TABLE `perm_labels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `PERM_ID` int NOT NULL,
  `NOMBRE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PERMISOS` text,
  `COLOR` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`PERM_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` (`PERM_ID`, `NOMBRE`, `PERMISOS`, `COLOR`) VALUES (0,'Alumno','Ozy.Profile.see;Ozy.Aplications.see;','#009c00'),(1,'Administrador','Ozy.*;','#9e0000'),(2,'Director','Ozy.AdminTools.users.*','#a15600'),(3,'Moderador','Ozy.Labels.General;Ozy.Labels.Invit','#9b9800'),(4,'Profesor','Ozy.Articles.pubArticleWithoutAprovation;Ozy.AdminTools.see;Ozy.AdminTools.approveArticles.see','#940040'),(5,'Jefe de Grupo','Ozy.Labels.Group;','#000788'),(6,'Creador','Ozy.Profile.see;Ozy.Aplications.see;Ozy.Canvas.see;','#21a190'),(-1,'Invitado','Ozy.Login.see','#00769a');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subetiquetas`
--

DROP TABLE IF EXISTS `subetiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subetiquetas` (
  `SUBLABEL_ID` int unsigned NOT NULL,
  `LABEL_ID` int unsigned NOT NULL,
  `NOMBRE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subetiquetas`
--

LOCK TABLES `subetiquetas` WRITE;
/*!40000 ALTER TABLE `subetiquetas` DISABLE KEYS */;
INSERT INTO `subetiquetas` (`SUBLABEL_ID`, `LABEL_ID`, `NOMBRE`) VALUES (1,1,'Todos'),(2,1,'Alumnos'),(3,1,'Profesores'),(4,1,'Jefe de Grupo'),(1,2,'Periodico'),(2,2,'PRONAFOLE'),(0,1,'*'),(0,2,'*'),(0,3,'*'),(3,2,'Física'),(4,2,'Matemáticas'),(5,2,'Rondalla'),(6,2,'Programación'),(7,2,'Creación Literaria');
/*!40000 ALTER TABLE `subetiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_labels`
--

DROP TABLE IF EXISTS `user_labels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_labels` (
  `USER_ID` int unsigned NOT NULL,
  `LABEL_ID` int unsigned NOT NULL,
  `SUBLABEL_ID` int unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_labels`
--

LOCK TABLES `user_labels` WRITE;
/*!40000 ALTER TABLE `user_labels` DISABLE KEYS */;
INSERT INTO `user_labels` (`USER_ID`, `LABEL_ID`, `SUBLABEL_ID`) VALUES (1,2,0),(1,2,2),(1,2,0),(1,2,0),(1,2,0),(1,2,0),(1,2,0),(1,2,0),(1,2,0),(1,2,0);
/*!40000 ALTER TABLE `user_labels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `USER_ID` int unsigned NOT NULL AUTO_INCREMENT,
  `PERM` int unsigned NOT NULL,
  `ESTADO` tinyint(1) DEFAULT NULL,
  `TIPO` int NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`USER_ID`, `PERM`, `ESTADO`, `TIPO`) VALUES (1,1,1,1),(2,1,1,2),(3,5,1,1),(4,0,1,1),(5,4,1,2),(6,4,1,2),(7,4,1,2),(8,4,1,2),(9,4,1,2),(10,4,1,2),(11,2,1,2),(12,3,1,2),(13,6,1,1),(14,4,1,2),(15,3,0,2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`Admin`@`%`*/ /*!50003 TRIGGER `USUARIOS_BDEL_TRG` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
	if OLD.PERM = 0 or OLD.PERM = 5 then
    	delete from ALUMNOS as AL where AL.USER_ID = OLD.USER_ID;
    elseif OLD.PERM > 0 and OLD.PERM < 5 then
    	delete from DOCENTES as DCT where DCT.USER_ID = OLD.USER_ID;
    end if;
    delete from CREDENCIALES as CDR where CDR.USER_ID = OLD.USER_ID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-20 21:44:57
