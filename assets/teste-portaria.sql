-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: portariabandeirante
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.31-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chaves`
--

DROP TABLE IF EXISTS `chaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chaves` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COD` varchar(10) NOT NULL,
  `LOCAL` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chaves`
--

LOCK TABLES `chaves` WRITE;
/*!40000 ALTER TABLE `chaves` DISABLE KEYS */;
INSERT INTO `chaves` VALUES (2,'FAT','FATURAMENTO'),(3,'CPD','CENTRO PROCESSAMENTO DE DADOS(TI)'),(13,'PCP','SALA DO DJAIR');
/*!40000 ALTER TABLE `chaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) DEFAULT NULL,
  `nomePorteiro` varchar(100) NOT NULL,
  `dataAcao` date DEFAULT NULL,
  `horaAcao` time DEFAULT NULL,
  `idRegistro` int(11) DEFAULT NULL,
  `refTable` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (7,'DELETOU','MARCOS SOUSA','2018-10-19','11:29:08',12,NULL),(8,'ADICIONOU','MARCOS SOUSA','2018-10-19','11:29:21',13,'chaves'),(9,'ADICIONOU','MARCOS SOUSA','2018-10-19','11:30:18',5,'registros2'),(10,'ADICIONOU','FULANO','2018-10-19','11:39:09',6,'registros2'),(11,'ADICIONOU','FULANO','2018-10-19','11:49:31',7,'registros2'),(12,'ADICIONOU','FULANO','2018-10-19','12:05:05',8,'registros2'),(13,'ATUALIZOU','FULANO','2018-10-19','13:23:33',8,'registros2');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porteiros`
--

DROP TABLE IF EXISTS `porteiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `porteiros` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(100) NOT NULL,
  `PERIODO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porteiros`
--

LOCK TABLES `porteiros` WRITE;
/*!40000 ALTER TABLE `porteiros` DISABLE KEYS */;
INSERT INTO `porteiros` VALUES (1,'MARCOS SOUSA','DIURNO'),(2,'FULANO','NOTURNO'),(3,'BELTRANO','NOTURNO');
/*!40000 ALTER TABLE `porteiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO` char(1) NOT NULL COMMENT '0 PARA CHAVES\n1 PARA RECEBIMENTO\n2 PARA SERVICOS\n',
  `PORTEIROS_ER_ID` int(11) NOT NULL,
  `DATA_ER` date DEFAULT NULL,
  `HORA_ER` time DEFAULT NULL,
  `COLAB_RET` varchar(50) DEFAULT NULL,
  `DATA_SR` date DEFAULT NULL,
  `HORA_SR` time DEFAULT NULL,
  `PORTEIROS_SR_ID` int(11) DEFAULT NULL,
  `COLAB_DEV` varchar(50) DEFAULT NULL,
  `VEICULOS_ID` int(11) DEFAULT NULL,
  `CHAVES_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PORTEIRO_ER_FK` (`PORTEIROS_ER_ID`),
  KEY `PORTEIRO_SR_FK` (`PORTEIROS_SR_ID`),
  KEY `VEICULO_FK` (`VEICULOS_ID`),
  KEY `CHAVE_FK` (`CHAVES_ID`),
  CONSTRAINT `registros_ibfk_1` FOREIGN KEY (`PORTEIROS_ER_ID`) REFERENCES `porteiros` (`ID`),
  CONSTRAINT `registros_ibfk_2` FOREIGN KEY (`PORTEIROS_SR_ID`) REFERENCES `porteiros` (`ID`),
  CONSTRAINT `registros_ibfk_3` FOREIGN KEY (`VEICULOS_ID`) REFERENCES `veiculos` (`ID`),
  CONSTRAINT `registros_ibfk_4` FOREIGN KEY (`CHAVES_ID`) REFERENCES `chaves` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` VALUES (1,'2',1,'2018-07-24','19:18:24',NULL,NULL,NULL,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros2`
--

DROP TABLE IF EXISTS `registros2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros2` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO` char(1) NOT NULL COMMENT '0 - CHAVES / 1 - RECEBIMENTO / 2 - SERVICO',
  `DATA_ER` date DEFAULT NULL,
  `HORA_ER` time DEFAULT NULL,
  `COLAB_RET` varchar(50) DEFAULT NULL,
  `TIPO_V` varchar(50) DEFAULT NULL,
  `PLACA` varchar(8) DEFAULT NULL,
  `MOTORISTA` varchar(100) DEFAULT NULL,
  `EMPRESA` varchar(100) DEFAULT NULL,
  `DATA_SR` date DEFAULT NULL,
  `HORA_SR` time DEFAULT NULL,
  `COLAB_DEV` varchar(50) DEFAULT NULL,
  `VEICULOS_ID` int(11) DEFAULT NULL,
  `CHAVES_ID` int(11) DEFAULT NULL,
  `FLAG` char(1) DEFAULT '1' COMMENT '1 - ABERTO / 2 - FECHADO',
  PRIMARY KEY (`ID`),
  KEY `VEICULOS_ID` (`VEICULOS_ID`),
  KEY `CHAVES_ID` (`CHAVES_ID`),
  CONSTRAINT `registros2_ibfk_2` FOREIGN KEY (`VEICULOS_ID`) REFERENCES `veiculos` (`ID`),
  CONSTRAINT `registros2_ibfk_3` FOREIGN KEY (`CHAVES_ID`) REFERENCES `chaves` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros2`
--

LOCK TABLES `registros2` WRITE;
/*!40000 ALTER TABLE `registros2` DISABLE KEYS */;
INSERT INTO `registros2` VALUES (6,'3','2018-10-19','11:39:00','MARCOS ANTONIO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,'1'),(7,'1','2018-10-19','11:49:00',NULL,'CARRO','FAD-7715','PEDRO','ESTILO',NULL,NULL,NULL,NULL,NULL,'1'),(8,'2','2018-10-19','12:04:00',NULL,NULL,NULL,NULL,NULL,'2018-10-19','13:23:00',NULL,1,NULL,'2');
/*!40000 ALTER TABLE `registros2` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER ACIONA_FLAG
BEFORE UPDATE 
on REGISTROS2 
FOR EACH ROW
BEGIN
SET NEW.FLAG = '2';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` char(12) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `turno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('16621678819','FULANO','NOTURNO'),('44313271856','MARCOS SOUSA','DIURNO');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO_V` varchar(50) NOT NULL,
  `PLACA` varchar(8) NOT NULL,
  `MOTORISTA` varchar(100) NOT NULL,
  `EMPRESA` varchar(100) NOT NULL DEFAULT 'BANDEIRANTE',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` VALUES (1,'CARRO','HJN-4686','MARCOS','BANDEIRANTE');
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'portariabandeirante'
--

--
-- Dumping routines for database 'portariabandeirante'
--
/*!50003 DROP PROCEDURE IF EXISTS `logPlataforma` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `logPlataforma`(IN id_registro int, IN nome_porteiro VARCHAR(100), IN tipo VARCHAR(1),IN ref_table VARCHAR(50))
BEGIN
IF tipo = "A" THEN		
	INSERT INTO LOG SET tipo = 'ATUALIZOU',nomePorteiro = nome_porteiro, dataAcao = date(now()),horaAcao = time(now()),idRegistro = id_registro, refTable = ref_table;
ELSEIF tipo = "C" THEN

	INSERT INTO LOG SET tipo = 'ADICIONOU',nomePorteiro = nome_porteiro, dataAcao = date(now()),horaAcao = time(now()),idRegistro = id_registro, refTable = ref_table;
ELSEIF tipo = "D" THEN
	INSERT INTO LOG SET tipo = 'DELETOU',nomePorteiro = nome_porteiro, dataAcao = date(now()),horaAcao = time(now()),idRegistro = id_registro, refTable = ref_table;
END IF;
END ;;
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

-- Dump completed on 2018-10-19 13:26:42
