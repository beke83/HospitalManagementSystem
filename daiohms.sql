CREATE DATABASE  IF NOT EXISTS `daiohms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `daiohms`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: daiohms
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `emailAddress` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_login`
--

LOCK TABLES `admin_login` WRITE;
/*!40000 ALTER TABLE `admin_login` DISABLE KEYS */;
INSERT INTO `admin_login` VALUES (1,'ben','beke','bekebenjamin@yahoo.com','123456','09098836011','ikorodu'),(2,'James','James','james@yahoo.com','yyyy','00000000000','lag');
/*!40000 ALTER TABLE `admin_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_tbl`
--

DROP TABLE IF EXISTS `admin_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `emailAddress` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `confirmPassword` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `addedBy` varchar(100) DEFAULT NULL,
  `timeAdded` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_tbl`
--

LOCK TABLES `admin_tbl` WRITE;
/*!40000 ALTER TABLE `admin_tbl` DISABLE KEYS */;
INSERT INTO `admin_tbl` VALUES (38,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','09098836011','Ikorodu','Active','','April-03-2021 14:12:41'),(30,'Coolest','Coolest j','Female','bekebenjamin@yahoo.com','111111','111111','000000000','Festac','Active','','March-22-2021 21:45:06'),(31,'Coolest','Coolest j','Female','bekebenjamin@yahoo.com','111111','111111','000000000','Festac','Active','','March-22-2021 21:50:26'),(32,'Coolest','olu','Male','bekebenjamin@yahoo.com','111111','111111','11111111111111','Ikoyi','Active','','March-22-2021 21:57:32'),(33,'Coolest','olumix','Male','bekebenjamin@yahoo.com','111111','111111','11111111111111','Ikoyi vi','Active','','March-22-2021 22:01:46'),(34,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','099','ikr','Active','','April-03-2021 13:50:55'),(35,'Coolest1','Coolest j11','Male','benbeke9@gmail.com','111111','111111','111','Ikorodo','Active','','April-03-2021 13:55:21'),(36,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','09098836011','Ikorodu','Active','','April-03-2021 14:07:29'),(37,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','09098836011','Ikorodu','Active','','April-03-2021 14:11:22'),(27,'bent','olu','Male','coolest@gmail.com','12345678','123456','090900876','Ikorodo','Active','','September-19-2020 09:08:59'),(28,'Ajalla','Ohms','Male','benbeke9@gmail.comn','yahoo@','yahoo@','09098836011','Ikorodo','InActive','','March-22-2021 21:42:52'),(29,'Coolest','Coolest j','Male','benbeke9@gmail.com','111111','111111','111111111111','ikorodu','Active','','March-22-2021 21:44:05'),(26,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','09090087669','Ikorodu','Active','','September-19-2020 09:06:13'),(48,'Coolest','Coolest j','Male','benbeke9@gmail.com','111111','111111','0909887342','Ikorodo','Active','','May-24-2021 13:07:58'),(45,'Coolest','Coolest j','Male','ben@yahoo.com','111111','111111','111','aaa','Active','','May-24-2021 12:54:03'),(46,'Coolest','Coolest j','Male','ben@yahoo.com','111111','111111','111','aaa','Active','','May-24-2021 12:55:11'),(47,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','ffffff','ffffff','111','Ikorodo','Active','','May-24-2021 13:01:33'),(43,'Ajalla','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','111111111111','Ikorodo','Active','','April-03-2021 14:39:53'),(49,'Coolest','Coolest j','Male','coolest@gmail.com','111111','111111','1111','Ikorodo','Active','','May-24-2021 13:24:25'),(50,'Coolest','Coolest j','Male','benebeke9@gmail.com','111111','111111','111111111111','Ikorodo','Active','','May-24-2021 13:52:19'),(51,'Coolest','olu','Female','bekebenjamin@yahoo.com','111111','111111','11','w','Active','','May-24-2021 15:56:53'),(52,'Ajalla','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','11111','111111','Active','','May-24-2021 15:58:18'),(53,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','111111','111111','1','111111111111','Active','','May-24-2021 16:01:28'),(54,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','q','q','11','Ikorodo','Active','','May-24-2021 16:03:57'),(55,'Benjamin','Bolaji-Beke','Male','bekebenjamin@yahoo.com','123456','123456','08023584097','Ontario, Canada','Active','','May-25-2021 11:47:49'),(56,'Benjamin','Bolaji-Beke','Male','bekebenjamin@yahoo.com','111111','111111','09098836011','Ontario, Canada','Active','','May-25-2021 11:49:55'),(57,'Coolest','olu','Male','coolest@gmail.com','4444','4444','+189809028393','Ikorodu','Active','','May-25-2021 12:21:56'),(58,'Coolest','olu','Male','coolest@gmail.com','4444','4444','+189809028393','Ikorodu','Active','','May-25-2021 12:22:51'),(59,'Coolest','olu','Female','coolest@gmail.com','q','q','1','q','Active','','May-25-2021 12:25:52'),(60,'ben','bb','Male','bbb','111111','111111','1111','222','InActive','','June-18-2021 17:31:02'),(61,'ben','bb','Male','bbb','111111','111111','1111','222','InActive','','June-18-2021 17:31:22'),(62,'ben','bb','Male','bbb','111111','111111','1111','222','InActive','','June-18-2021 17:31:28'),(71,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','mmmmmm','mmmmmm','09090087669','Ikorodo','Active','','June-23-2021 14:05:37'),(76,'Coolest','Coolest j','Male','bekebenjamin@yahoo.com','nnnnnn','nnnnnn','+189809028393','Ikorodu','Active','','June-23-2021 14:20:02'),(77,'Coolest','olu','Male','bekebenjamin@yahoo.com','qqqqqq','qqqqqq','+2109098836011','Ikorodu','Active','','June-23-2021 14:22:45');
/*!40000 ALTER TABLE `admin_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointment_tbl`
--

DROP TABLE IF EXISTS `appointment_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointmenttype` varchar(45) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `appointmentdate` date DEFAULT NULL,
  `appointmenttime` varchar(45) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `app_reason` varchar(200) DEFAULT NULL,
  `roomid` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_tbl`
--

LOCK TABLES `appointment_tbl` WRITE;
/*!40000 ALTER TABLE `appointment_tbl` DISABLE KEYS */;
INSERT INTO `appointment_tbl` VALUES (21,NULL,8,4,'2020-10-01','12:32',6,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',16,'Approved'),(27,NULL,8,8,'2020-09-28','15:40',2,'wwwwwwwwwwwwww',15,'Approved'),(26,'In-Person',8,2,'2020-09-26','11:22',2,'kkkkkkkkkkkkkkkkkkkkkkkkkk',16,'Approved'),(25,NULL,10,1,'2020-09-26','15:49',3,'Test 5 of appointment',16,'Approved'),(28,NULL,10,4,'2020-09-30','13:41',4,'mmmmmmmmmmmmmmmmmmmmmmmm',20,'Approved'),(29,'Online',10,6,'2020-10-10','13:42',2,'when we see you go know',16,'Approved'),(34,'Online',10,4,'2020-11-19','15:41',2,'Need a full ENT body check up. Having problem in urination',15,'Approved'),(35,NULL,10,2,'2020-11-20','04:48',2,'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww',17,'Approved'),(36,NULL,10,2,'2020-11-20','08:00',2,'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn',16,'Approved'),(37,NULL,8,1,'2020-12-10','09:14',6,'Teting to see which appintment type',16,'Approved'),(38,'Online',12,5,'2020-12-18','20:38',2,'Need a full body internal check',16,'Approved'),(39,'Online',10,3,'2021-01-01','21:41',2,'mmm test test test test tet test test tetst test test tetst tetst',17,'Approved'),(40,'Online',9,2,'2021-03-26','05:31',2,'bbbbbbbbbbbbbbb',16,'Approved'),(41,'Online',10,4,'2021-03-26','11:50',2,'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj',16,'Approved'),(42,NULL,21,3,'2021-04-24','15:36',2,'edddddddddddddddddddddeddedededed AIDS',18,'Approved'),(43,'In-Person',37,2,'2021-06-20','20:16',2,'dddddddddddddddddddddddddddddddddd',15,'Approved'),(44,'In-Person',12,2,'2021-06-19','19:35',2,'mmm',17,'Approved'),(45,'In-Person',12,3,'2021-06-20','21:51',2,'mmmmmmmmmmmmm',15,'Approved'),(46,'In-Person',15,5,'2021-06-17','14:27',2,'testing testing',15,'Approved'),(47,'Online',8,2,'2021-06-24','12:39',2,'nnnnnnnnnn',16,'Approved'),(48,'Online',12,3,'2021-06-11','14:48',2,'EEEEEEEEEEEEEEEEEEEEE',16,'Approved'),(49,'Online',11,5,'2021-06-24','15:37',2,'testing mail appointmtnt',16,'Approved'),(50,'Online',9,4,'2021-06-24','14:55',2,'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmnono',16,'Approved'),(51,'Online',27,2,'2021-06-26','21:27',2,'Testing for no errors',15,'Approved'),(52,'Online',33,2,'2021-06-27','13:43',2,'Testing Testing Testing',15,'Approved');
/*!40000 ALTER TABLE `appointment_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointment_type_tbl`
--

DROP TABLE IF EXISTS `appointment_type_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment_type_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointmentTypeName` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_type_tbl`
--

LOCK TABLES `appointment_type_tbl` WRITE;
/*!40000 ALTER TABLE `appointment_type_tbl` DISABLE KEYS */;
INSERT INTO `appointment_type_tbl` VALUES (1,'Online','Active'),(2,'In-Person','Active');
/*!40000 ALTER TABLE `appointment_type_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_records`
--

DROP TABLE IF EXISTS `billing_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_records` (
  `id` int(11) NOT NULL,
  `billingid` int(10) NOT NULL,
  `bill_type_id` int(10) NOT NULL,
  `bill_type` varchar(250) NOT NULL,
  `bill_amount` float(10,2) NOT NULL,
  `bill_date` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_records`
--

LOCK TABLES `billing_records` WRITE;
/*!40000 ALTER TABLE `billing_records` DISABLE KEYS */;
INSERT INTO `billing_records` VALUES (1,1,1,'Room Rent',690.00,'2016-03-23','Active'),(5,17,1,'Room Rent',900.00,'2016-03-23','Active'),(3,13,2,'Consultancy Charge ',900.00,'2021-06-26','Active'),(4,13,1,'Room Renr',700.00,'2016-03-23','Active');
/*!40000 ALTER TABLE `billing_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_tbl`
--

DROP TABLE IF EXISTS `billing_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_tbl` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `billingdate` varchar(45) NOT NULL,
  `billingtime` varchar(45) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `taxamount` float(10,2) NOT NULL,
  `discountreason` text NOT NULL,
  `discharge_time` varchar(45) NOT NULL,
  `discharge_date` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_tbl`
--

LOCK TABLES `billing_tbl` WRITE;
/*!40000 ALTER TABLE `billing_tbl` DISABLE KEYS */;
INSERT INTO `billing_tbl` VALUES (1,10,25,'2016-03-23','10:12:38',0.00,0.00,'','00:00:00','0000-00-00'),(2,11,25,'2016-03-23','10:12:38',0.00,0.00,'','00:00:00','0000-00-00'),(3,10,35,'2020-11-24','04:50:37',0.00,0.00,'','',''),(4,10,39,'2020-12-11','07:59:12',0.00,0.00,'','',''),(5,8,37,'2020-12-16','06:48:04',0.00,0.00,'','',''),(6,12,44,'2021-06-18','17:36:21',0.00,0.00,'','',''),(7,37,43,'2021-06-18','17:39:37',0.00,0.00,'','',''),(8,9,40,'2021-06-19','14:00:42',0.00,0.00,'','',''),(9,10,41,'2021-06-19','16:04:53',0.00,0.00,'','',''),(10,8,47,'2021-06-23','11:39:23',0.00,0.00,'','',''),(11,15,46,'2021-06-23','11:40:19',0.00,0.00,'','',''),(12,12,45,'2021-06-23','11:47:58',0.00,0.00,'','',''),(13,12,48,'2021-06-23','11:52:30',2000.00,0.00,'','',''),(14,11,49,'2021-06-23','12:37:45',0.00,0.00,'','',''),(15,9,50,'2021-06-23','12:56:13',0.00,0.00,'','',''),(16,27,51,'2021-06-25','19:41:04',0.00,0.00,'','',''),(17,33,52,'2021-06-26','11:45:36',0.00,0.00,'','','');
/*!40000 ALTER TABLE `billing_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_tbl`
--

DROP TABLE IF EXISTS `department_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_tbl`
--

LOCK TABLES `department_tbl` WRITE;
/*!40000 ALTER TABLE `department_tbl` DISABLE KEYS */;
INSERT INTO `department_tbl` VALUES (1,'Physician','All types of disesases, mostly basics  like fever,cough not COVID-19','Active'),(2,'Children Doctor ','All type of children diseases','Active'),(3,'General Medicne1','General doctor','Active'),(4,'ENT Specialist','Ear, Nose and Tongue Doctor','Active'),(5,'Neurologist','Related neurons, bones','Active'),(6,'Surgery','Includes plastic surgery, brain and neurology surgery','Active'),(8,'Pharmacy','Providing patients with medicines prescribed by specialist physicians.','Active'),(9,'Laboratory and Blood bank','Includes detailed lab investigations and blood bank are developing considerably as per international standards  ','Active'),(11,'Physician','fffffffffffffffffffffff','Active'),(12,'Neurologist d','ddddddddddddddddddd','Active'),(13,'Surgery F','ffffffffffffffffffff','Active'),(14,'Physiotherapy','Physiotherapy','Active');
/*!40000 ALTER TABLE `department_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_tbl`
--

DROP TABLE IF EXISTS `doctor_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorFirstname` varchar(100) DEFAULT NULL,
  `doctorLastname` varchar(100) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `consultancyFee` float(10,2) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `emailAddress` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_tbl`
--

LOCK TABLES `doctor_tbl` WRITE;
/*!40000 ALTER TABLE `doctor_tbl` DISABLE KEYS */;
INSERT INTO `doctor_tbl` VALUES (2,'Lokesh','Chakku','University of New Dehli','MBBS,MD,IDCCM','7',260.00,2,'Female','Ikorodo','Lagos','+2109098836011','coolest@gmail.com','111111','Active'),(3,'Ben','Ben','Uni','MSC','9',30000.00,6,'Male','ikorodu','Lag','090909090','coolest1@gmail.com','111111','Active'),(4,'Ben','Ben','Uni','MSC','9',30000.00,6,'Male','ikorodu','Lag','090909090','coolest2@gmail.com','000000','Active'),(5,'Ben','Ben','Uni','MSC','9',30000.00,6,'Male','ikorodu','Lag','090909090','coolest3@gmail.com','000000','Active'),(6,'Kumar Chopra','Chakku','University of New Dehli','MBBS,MD,IDCCM','7',2600000.00,6,'Female','Ikorodo','Lagos','+2109098836011','coolest4@gmail.com','111111','Active'),(7,'Ak','Las','Middlesex Uni','B.S.C, PHD','3',50000.00,4,'Male','London','Middlesex','4509093022','aklas@gmail.com','12345678','Active');
/*!40000 ALTER TABLE `doctor_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_timing_tbl`
--

DROP TABLE IF EXISTS `doctor_timing_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_timing_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorid` int(11) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_timing_tbl`
--

LOCK TABLES `doctor_timing_tbl` WRITE;
/*!40000 ALTER TABLE `doctor_timing_tbl` DISABLE KEYS */;
INSERT INTO `doctor_timing_tbl` VALUES (5,2,'13:00','17:00','Active'),(4,2,'06:40','18:40','Active'),(7,2,'20:56','09:57','Active'),(6,2,'07:40','22:40','Active'),(8,2,'08:46','20:46','Active'),(9,7,'10:00','18:00','Active');
/*!40000 ALTER TABLE `doctor_timing_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicine_tbl`
--

DROP TABLE IF EXISTS `medicine_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicine_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicineName` varchar(100) DEFAULT NULL,
  `medicineCost` decimal(10,2) DEFAULT NULL,
  `description` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine_tbl`
--

LOCK TABLES `medicine_tbl` WRITE;
/*!40000 ALTER TABLE `medicine_tbl` DISABLE KEYS */;
INSERT INTO `medicine_tbl` VALUES (1,'Ampilicin plus',2550.00,'Amplicin Amplicine AmplicineAmplicine Amplicine Amplicine','Active'),(2,'Dicloss ABC',2500.00,'test diclos adbc','Active'),(3,'Fluid xtz',200000.00,'for ear treatment','Active'),(4,'Bonababe Colpol',2000.00,'Baby Teeth pain reliever','Active'),(6,'Maxiquine',20000.00,'Antibiotic','Active');
/*!40000 ALTER TABLE `medicine_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_tbl`
--

DROP TABLE IF EXISTS `patient_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `bloodGroup` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `emailAddress` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `confirmPassword` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `dateAdmitted` varchar(100) DEFAULT NULL,
  `timeAdmitted` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_tbl`
--

LOCK TABLES `patient_tbl` WRITE;
/*!40000 ALTER TABLE `patient_tbl` DISABLE KEYS */;
INSERT INTO `patient_tbl` VALUES (10,'Coolest','Ohms','Male','2002-07-25','A+','22B,Ikordou Road','Lagos','+2109098836011','coolest@yahoo.com','12345678','123456','Active','September-24-2020 14:45:31',NULL),(8,'James S','James','Female','12-11-2000','O+','Ikorodu','Lagos','09098836011','bekebenjamin@yahoo.com','yahoo@','123456','Active','January-01-1970 01:00:21',NULL),(9,'bent2','olu','Female','12-11-2000','O+','Ikorodu','Lagos','09098836011','bekebenjamin1@yahoo.com','123456','123456','Active','September-20-2020 21:38:05',NULL),(11,'Coolest','Coolest j','Female','2020-10-23','A+','Ikorodo','Lagos','09098836011','bekebenjamin2@yahoo.com','0','123456','Active','2020-10-02','12:50:28'),(12,'Stone','Smith','Male','1991-07-16','O+','Boulevard','Osborne','+189809028393','stonesmith23@outlook.com','123456','123456','Active','2020-12-11','08:37:45'),(13,'Coolest','Coolest j','Male','2021-03-18','A+','Federal Palace Drive Ikoyi','Obalende','00000000000000','bekebenjamin@yahoo.com','111111','111111','Active','2021-03-22','22:05:34'),(14,'Coolest','Coolest j','Male','2021-03-21','A+','Ikorodu','Lagos','111111111111','bekebenjamin@yahoo.com','111111','111111','Active','2021-03-22','23:57:16'),(15,'Coolest','Coolest j','Male','2021-03-22','A+','Ikorodu','Lagos','+189809028393','bekebenjamin@yahoo.com','111111','111111','Active','2021-03-23','10:58:09'),(16,'Coolest','Coolest j','Male','2021-03-22','A+','Ikorodu','Lagos','+189809028393','bekebenjamin@yahoo.com','111111','111111','Active','2021-03-23','10:58:22'),(17,'Coolest','Coolest j','Male','2021-03-22','A+','Ikorodu','Lagos','+189809028393','bekebenjamin@yahoo.com','111111','111111','Active','2021-03-24','17:28:16'),(18,'Coolest','Coolest j','Female','2021-03-25','A+','Ikorodu','Lagos','09098836011','coolest@gmail.com','111111','111111','Active','2021-03-24','17:41:12'),(19,'Coolest','Coolest j','Female','2021-03-25','A+','Ikorodu','Lagos','09098836011','coolest@gmail.com','111111','111111','Active','2021-03-24','17:44:55'),(20,'Ajalla','Coolest j','Male','1999-11-26','AB+','Ikorodu','Lagos','+2109098836011','coolest1@yahoo.com','111111','111111','Active','2021-03-25','20:17:54'),(21,'bent','Coolest j','Male','2021-03-18','AB+','Ikorodu','Lagos','+189809028393','ben@yahoo.com','111111','111111','Active','2021-03-25','20:20:40'),(22,'Coolest','Coolest j','Male','2021-03-25','A+','Ikorodu','Lagos','+189809028393','coolest1@yahoo.com','111111','111111','Active','2021-03-25','20:30:48'),(23,'Coolest','Coolest j','Male','2021-03-25','A+','Ikorodu','Lagos','+189809028393','bekebenjamin@yahoo.com','111111','111111','Active','2021-03-25','20:35:49'),(24,'Ajalla','Coolest j','Male','2021-03-26','A+','Ikorodu','Lagos','111111111111','bekebenjamin@yahoo.commm','111111','111111','Active','2021-03-25','20:41:59'),(25,'Coolest','Coolest j','Male','2021-04-08','AB+','Ikorodu','Lagos','090','bkkk','111111','111111','Active','2021-04-03','13:43:25'),(27,'Coolest','olu','Male','2021-04-24','A+','Ikorodo','Lagos','+2109098836011','coolest@gmail.com','11111111','11111111','Active','2021-04-23','14:25:01'),(28,'Coolest','olu','Male','2021-04-24','A+','Ikorodo','Lagos','+2109098836011','coolest@gmail.com','111111','111111','Active','2021-04-23','14:25:55'),(29,'Coolest','olu','Male','2021-04-29','w','Ikorodo','Lagos','1','benebeke9@gmail.com','111111','111111','Active','2021-05-24','13:27:58'),(30,'Coolest','olu','Female','2021-06-19','A+','Ikorodo','Lagos','09098836011','ben@yahoo.com','111111','111111','Active','2021-06-12','16:19:26'),(31,'Coolest','olu','Female','2021-06-19','A+','Ikorodo','Lagos','09098836011','ben@yahoo.com','111111','111111','Active','2021-06-12','16:27:57'),(32,'Coolest','Coolest j','Male','2021-06-18','A+','Ikorodu','Lagos','09098836011','coolest@gmail.com','111111','111111','Active','2021-06-12','16:32:53'),(33,'Bun','Lee','Male','2009-08-07','O+','China Tow, XUANGIN Road','GunDox','764654623','bunlee@gmail.com','123456','123456','Active','2021-06-18','07:39:01'),(34,'Ajalla','Coolest j','Male','2021-06-19','A+','Ikorodo','Lagos','111111111111','ben@yahoo.com','000000','000000','Active','2021-06-18','17:42:44'),(35,'Ajalla','Coolest j','Male','2021-06-19','A+','Ikorodo','Lagos','111111111111','ben@yahoo.com','000000','000000','Active','2021-06-18','17:45:19'),(39,'Coolest','olu','Male','2021-06-17','AB+','Ikorodo','Lagos','111111111111','ben@yahddoo.commm','111111','111111','Active','2021-06-23','15:45:18'),(37,'Ajallao','olu','Male','2021-06-08','A+','Ikorodo','Lagos','+2109098836011','bekebenjamin@yahoo.comm','llllll','llllll','Active','2021-06-18','17:50:53');
/*!40000 ALTER TABLE `patient_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `paiddate` date NOT NULL,
  `paidtime` time NOT NULL,
  `paidamount` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `cardholder` varchar(50) NOT NULL,
  `cardnumber` int(25) NOT NULL,
  `cvvno` int(5) NOT NULL,
  `expdate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,10,25,'2016-03-25','01:00:00',2000.00,'','',0,0,'0000-00-00'),(2,11,26,'2016-03-25','01:00:00',2000.00,'','',0,0,'0000-00-00'),(3,12,27,'2016-03-25','01:00:00',100.00,'','',0,0,'0000-00-00');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescription` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_records_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `delivery_type` varchar(10) NOT NULL COMMENT 'Delivered through appointment or online order',
  `delivery_id` int(10) NOT NULL COMMENT 'appointmentid or orderid',
  `prescriptiondate` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription`
--

LOCK TABLES `prescription` WRITE;
/*!40000 ALTER TABLE `prescription` DISABLE KEYS */;
INSERT INTO `prescription` VALUES (1,1,3,10,'',0,'2015-08-14','Active',25),(2,2,36,10,'',0,'2016-01-08','Active',0),(3,3,4,10,'',0,'2015-11-14','Active',15),(4,3,38,10,'',0,'2016-02-27','Active',0),(5,0,40,8,'',0,'2015-12-12','Active',0),(6,14,36,9,'',0,'2016-03-11','Active',0),(7,44,36,8,'',0,'2016-03-11','Active',0),(8,14,35,10,'',0,'2016-03-19','Active',0),(9,14,35,9,'',0,'2016-03-19','Active',0);
/*!40000 ALTER TABLE `prescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescription_records`
--

DROP TABLE IF EXISTS `prescription_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescription_records` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `prescription_id` int(10) NOT NULL,
  `medicine_name` varchar(25) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `unit` int(10) NOT NULL,
  `dosage` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription_records`
--

LOCK TABLES `prescription_records` WRITE;
/*!40000 ALTER TABLE `prescription_records` DISABLE KEYS */;
INSERT INTO `prescription_records` VALUES (1,15,'Arthopan',30.00,10,'1-0-1','Active'),(2,16,'Ecospirin',11.00,10,'1-1-1','Active'),(3,17,'Dolo-60',15.00,5,'0-0-1','Active'),(4,18,'Fenon-650',500.00,20,'0-1-1','Active'),(5,19,'Rantac',10.00,10,'0-1-0','Active'),(6,20,'Colpol',25.00,6,'1-1-1',''),(7,20,'Cinox',85.00,5,'1-1-1','');
/*!40000 ALTER TABLE `prescription_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `roomtype` varchar(25) NOT NULL,
  `roomno` varchar(45) NOT NULL,
  `noofbeds` varchar(45) NOT NULL,
  `room_tariff` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (15,'GENERAL WARD','1','20',500.00,'Active'),(16,'SPECIAL WARD','2','10',100.00,'Active'),(17,'GENERAL WARD','2','10',500.00,'Active'),(18,'GENERAL WARD','121','13',150.00,'Active'),(21,'Private Ward 2','23','4',3000.00,'Active');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(100) NOT NULL,
  `servicecharge` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type`
--

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` VALUES (1,'X-ray',250.00,'To take fractured photo copy','Active'),(2,'Scanning',450.00,'To scan body from injury','Active'),(3,'MRI',300.00,'Regarding body scan','Active'),(4,'Blood Testing',150.00,'To detect the type of disease','Active'),(5,'Diagnosis',210.00,'To analyse the diagnosis','Active');
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatment`
--

DROP TABLE IF EXISTS `treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `treatmenttype` varchar(25) NOT NULL,
  `treatment_cost` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment`
--

LOCK TABLES `treatment` WRITE;
/*!40000 ALTER TABLE `treatment` DISABLE KEYS */;
INSERT INTO `treatment` VALUES (1,'Treatment for Malaria',450.00,' Providing medicine and tonic with injection  ','Active'),(2,'Treatment for Dengue',20000.00,' Providing massage and home made tips','Active'),(3,'tryrtytyt',554.00,' ertrrcyt','Active'),(4,'rytyt',55.00,' eex','Active'),(5,'jkgjghj',5653.00,' hfhfjhg','Active'),(6,'rhgjh',54.00,' hgjgj ','Active'),(7,'Dengue',4000.00,'Dengue treatment','Active');
/*!40000 ALTER TABLE `treatment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatment_records`
--

DROP TABLE IF EXISTS `treatment_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment_records` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `treatmentid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `treatment_description` text NOT NULL,
  `uploads` varchar(100) NOT NULL,
  `treatment_date` varchar(100) NOT NULL,
  `treatment_time` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment_records`
--

LOCK TABLES `treatment_records` WRITE;
/*!40000 ALTER TABLE `treatment_records` DISABLE KEYS */;
INSERT INTO `treatment_records` VALUES (1,1,22,10,2,'High Fever','nill','2016-03-02','00:00:16','Active'),(2,2,21,10,4,'High Fever vomit','nill','2016-03-02','00:00:16','Active'),(3,3,25,11,4,'High Fever vomit','nill','2016-03-02','00:00:16','Active'),(4,3,27,8,35,'mmmmmmmmmmmmm','17290','2020-11-03','06:47','Active'),(5,2,35,10,2,'Teting the rona vacines','23531Admin Id and Pass.txt','2020-11-24','05:50','Active'),(6,1,37,8,2,'Testing the vaccine for malaria parasite virus ','15579','2020-12-16','09:50','Active'),(7,2,39,10,2,'ssssssssssssssss','21368','2020-12-15','07:50','Active'),(8,1,39,10,2,'ddddddddddddddddddddd','19025','2020-12-16','09:52','Active'),(9,1,51,27,27,'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj','13813','2021-06-25','22:21','Active'),(10,2,47,8,2,'Testing treatment','3247','2021-06-24','23:30','Active'),(11,2,47,8,2,'Testing treatment','8826','2021-06-24','23:30','Active'),(12,4,26,8,2,'mmmmmmmmmmm','20362','2021-06-25','08:42','Active'),(13,2,47,8,2,'test','6651','2021-06-26','07:45','Active'),(14,2,47,8,2,'ttttttttttttttt','14872','2021-06-26','07:53','Active'),(15,2,47,8,2,'testing for no error 2','15473','2021-06-25','08:10','Active'),(16,2,47,8,2,'testing for no error 2','2603','2021-06-25','08:10','Active'),(22,2,41,10,2,'bb','24516','2021-06-25','21:05','Active'),(23,2,41,10,2,'bb','11949','2021-06-25','21:05','Active'),(24,2,41,10,2,'bb','7687','2021-06-25','21:05','Active'),(25,3,41,10,2,'mmm','6964','2021-06-26','09:09','Active'),(26,2,41,10,2,'mmmmmmmmmm','17890','2021-06-26','09:12','Active'),(27,2,41,10,2,'mmmmmmmmmm','7517','2021-06-26','09:12','Active'),(28,2,41,10,2,'mmmmmmmmmm','19827','2021-06-26','09:12','Active'),(29,2,41,10,2,'m','13360','2021-06-26','09:22','Active'),(30,2,41,10,2,'m','1746','2021-06-26','09:22','Active'),(31,2,41,10,2,'m','2217','2021-06-26','09:22','Active'),(32,2,41,10,2,'m','5027','2021-06-26','09:22','Active'),(33,3,48,12,2,'m','19488','2021-06-26','12:55','Active'),(34,2,48,12,2,'iiiiii','23001','2021-06-26','14:16','Active'),(35,3,48,12,2,'opopopoporrr','24730','2021-06-26','13:26','Active'),(36,2,48,12,2,'mmmmmmmm','15819','2021-06-26','13:28','Active'),(37,2,52,33,2,'kkkkkk','3998','2021-06-26','13:48','Active'),(38,3,52,33,2,'ll','31359','2021-06-26','15:21','Active'),(39,1,52,33,2,'ioio','22952','2021-06-26','15:23','Active'),(40,4,52,33,2,'mm','3265','2021-06-26','14:26','Active'),(41,1,47,8,2,'Treatment','32260','2021-07-05','01:37','Active'),(42,2,47,8,2,'jjjjjjjjjjjjjjj','11246','2021-07-08','16:51','Active');
/*!40000 ALTER TABLE `treatment_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatmenttype_tbl`
--

DROP TABLE IF EXISTS `treatmenttype_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatmenttype_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treatmentType` varchar(100) DEFAULT NULL,
  `treatmentCost` decimal(10,2) DEFAULT NULL,
  `note` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatmenttype_tbl`
--

LOCK TABLES `treatmenttype_tbl` WRITE;
/*!40000 ALTER TABLE `treatmenttype_tbl` DISABLE KEYS */;
INSERT INTO `treatmenttype_tbl` VALUES (2,'Treatment for Dengue',20000.00,'Treatment for DengueTreatment for DengueTreatment for DengueTreatment for DengueTreatment for Dengue','Active'),(5,'Treatment for Malaria',2500.00,'Take two malaria pills morning and night for 3 days','Active'),(6,'Treatment For Blood Pressure',24000.00,'Take Blood Pressure Pills','Active');
/*!40000 ALTER TABLE `treatmenttype_tbl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-09  5:35:25
