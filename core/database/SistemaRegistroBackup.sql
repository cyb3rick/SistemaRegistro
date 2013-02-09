-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: SistemaRegistro
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.3

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
-- Table structure for table `Courses`
--

DROP TABLE IF EXISTS `Courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Courses` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `description` mediumtext,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Courses`
--

LOCK TABLES `Courses` WRITE;
/*!40000 ALTER TABLE `Courses` DISABLE KEYS */;
INSERT INTO `Courses` VALUES (1,'Fundamentos Bíblicos',1,''),(2,'Vida en el Espíritu',1,''),(3,'Evangelismo',1,''),(4,'Misiones',1,''),(5,'Mi Experiencia con Dios',2,''),(6,'La Familia Sujeta al Espíritu',2,''),(7,'Sanidad Integral',2,''),(8,'Mayordomía',2,''),(9,'Liderazgo Aprobado por Dios',2,'');
/*!40000 ALTER TABLE `Courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Days`
--

DROP TABLE IF EXISTS `Days`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Days` (
  `did` int(11) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`did`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Days`
--

LOCK TABLES `Days` WRITE;
/*!40000 ALTER TABLE `Days` DISABLE KEYS */;
INSERT INTO `Days` VALUES (2,'Jueves'),(1,'Miércoles');
/*!40000 ALTER TABLE `Days` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HasTaken`
--

DROP TABLE IF EXISTS `HasTaken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HasTaken` (
  `sid` int(11) unsigned NOT NULL,
  `sec_id` int(11) unsigned NOT NULL,
  `passed` tinyint(1) NOT NULL,
  PRIMARY KEY (`sid`,`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HasTaken`
--

LOCK TABLES `HasTaken` WRITE;
/*!40000 ALTER TABLE `HasTaken` DISABLE KEYS */;
INSERT INTO `HasTaken` VALUES (1,14,0),(1,18,0),(2,14,0);
/*!40000 ALTER TABLE `HasTaken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rooms`
--

DROP TABLE IF EXISTS `Rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rooms` (
  `rid` int(11) unsigned NOT NULL,
  `notes` text,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rooms`
--

LOCK TABLES `Rooms` WRITE;
/*!40000 ALTER TABLE `Rooms` DISABLE KEYS */;
INSERT INTO `Rooms` VALUES (23,''),(24,NULL);
/*!40000 ALTER TABLE `Rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sections`
--

DROP TABLE IF EXISTS `Sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sections` (
  `sec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) unsigned NOT NULL,
  `tid` int(11) unsigned NOT NULL,
  `rid` int(11) unsigned NOT NULL,
  `did` int(11) unsigned NOT NULL,
  `sem_code` varchar(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY (`sec_id`),
  UNIQUE KEY `rid` (`rid`,`did`,`sem_code`,`year`),
  UNIQUE KEY `tid` (`tid`,`did`,`sem_code`,`year`),
  KEY `cid` (`cid`),
  KEY `did` (`did`),
  KEY `sem_code` (`sem_code`),
  KEY `year` (`year`),
  CONSTRAINT `Sections_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Courses` (`cid`),
  CONSTRAINT `Sections_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `Teachers` (`tid`),
  CONSTRAINT `Sections_ibfk_3` FOREIGN KEY (`rid`) REFERENCES `Rooms` (`rid`),
  CONSTRAINT `Sections_ibfk_4` FOREIGN KEY (`did`) REFERENCES `Days` (`did`),
  CONSTRAINT `Sections_ibfk_5` FOREIGN KEY (`sem_code`) REFERENCES `Semesters` (`code`),
  CONSTRAINT `Sections_ibfk_6` FOREIGN KEY (`year`) REFERENCES `Semesters` (`year`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sections`
--

LOCK TABLES `Sections` WRITE;
/*!40000 ALTER TABLE `Sections` DISABLE KEYS */;
INSERT INTO `Sections` VALUES (14,1,1,24,2,'1','2013'),(15,2,2,23,2,'1','2013'),(16,3,2,24,1,'1','2013'),(18,1,1,23,2,'1','2012');
/*!40000 ALTER TABLE `Sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Semesters`
--

DROP TABLE IF EXISTS `Semesters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Semesters` (
  `year` varchar(4) NOT NULL,
  `code` varchar(4) NOT NULL,
  PRIMARY KEY (`year`,`code`),
  KEY `code` (`code`),
  CONSTRAINT `Semesters_ibfk_1` FOREIGN KEY (`code`) REFERENCES `SemestersCodeDescription` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Semesters`
--

LOCK TABLES `Semesters` WRITE;
/*!40000 ALTER TABLE `Semesters` DISABLE KEYS */;
INSERT INTO `Semesters` VALUES ('2010','1'),('2011','1'),('2012','1'),('2013','1'),('2010','2'),('2011','2'),('2012','2');
/*!40000 ALTER TABLE `Semesters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SemestersCodeDescription`
--

DROP TABLE IF EXISTS `SemestersCodeDescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SemestersCodeDescription` (
  `code` varchar(4) NOT NULL,
  `start_month` varchar(32) NOT NULL,
  `end_month` varchar(32) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SemestersCodeDescription`
--

LOCK TABLES `SemestersCodeDescription` WRITE;
/*!40000 ALTER TABLE `SemestersCodeDescription` DISABLE KEYS */;
INSERT INTO `SemestersCodeDescription` VALUES ('1','Agosto','Diciembre'),('2','Enero','Mayo');
/*!40000 ALTER TABLE `SemestersCodeDescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Students`
--

DROP TABLE IF EXISTS `Students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Students` (
  `sid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `email` text,
  `registered_since` varchar(255) DEFAULT NULL,
  `converted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Students`
--

LOCK TABLES `Students` WRITE;
/*!40000 ALTER TABLE `Students` DISABLE KEYS */;
INSERT INTO `Students` VALUES (1,'Erick','Caraballo','','787-410-3650','','cyb3rick@gmail.com',NULL,NULL),(2,'Kathie','Elías','','787-554-6842','','kathie.elias@gmail.com',NULL,NULL);
/*!40000 ALTER TABLE `Students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Teachers`
--

DROP TABLE IF EXISTS `Teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Teachers` (
  `tid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `photo_url` text,
  `email` text,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Teachers`
--

LOCK TABLES `Teachers` WRITE;
/*!40000 ALTER TABLE `Teachers` DISABLE KEYS */;
INSERT INTO `Teachers` VALUES (1,'Xavier','Crespo','','787-123-1243','',NULL,'xavier.crespo@gmail.com'),(2,'Zamaslie','Crespo','','787-233-3441','',NULL,'zamaslie.crespo@gmail.com');
/*!40000 ALTER TABLE `Teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `username` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  `first_name` char(32) NOT NULL,
  `last_name` char(32) NOT NULL,
  `email` char(250) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES ('cyb3rick','12d5d22ffcb120037ae684c2c8c908df','Erick','Caraballo','cyb3rick@gmail.com'),('Vivian','202cb962ac59075b964b07152d234b70','Vivian','Alberdestor','ibglenview@hotmail.com');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-09  1:53:08
