-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: localhost    Database: daiohms
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
INSERT INTO `admin_login` VALUES (1,'Chakku','Lokesh','chakkulokesh@gmail.com','12345678','090987654','China, Road India, mumbai'),(2,'admin','admin','admin@yahoo.com','admin','09097373773','Ikeja');
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
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_tbl`
--

LOCK TABLES `admin_tbl` WRITE;
/*!40000 ALTER TABLE `admin_tbl` DISABLE KEYS */;
INSERT INTO `admin_tbl` VALUES (111,'j','jdd','Female','ndidicorryn20@gmail.com','mmmmmmmm','mmmmmmmm','09098872722','ikr','Active','','July-25-2021 12:32:06'),(110,'jd','j','Male','bekebenjamin@yahoo.com','mmmmmmm','mmmmmmm','09098872722','ww','Active','','July-25-2021 12:27:30'),(1,'Chakku','Lokesh','Male','admin@yahoo.com','admin','admin','090987654','China, Road India, mumbai','Active',NULL,NULL),(109,'Stome','Ben','Male','ndidicorryn20@gmail.com','12345678','12345678','09098872722','wwwe','Active','','July-25-2021 12:25:55'),(108,'jd','j','Male','bekebenjamin@yahoo.com','mmmmmm','mmmmmm','09098872722','wwwe','Active','','July-25-2021 10:50:01'),(107,'jd','j','Male','bekebenjamin@yahoo.com','mmmmmmmm','mmmmmmmm','09090908899','wwwek','Active','','July-25-2021 10:42:44');
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
  `approvedby` int(11) DEFAULT NULL,
  `patientemail` varchar(100) DEFAULT NULL,
  `checkedIn` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_tbl`
--

LOCK TABLES `appointment_tbl` WRITE;
/*!40000 ALTER TABLE `appointment_tbl` DISABLE KEYS */;
INSERT INTO `appointment_tbl` VALUES (86,'In-Person',54,15,'2021-08-13','09:25:00',15,'Testing',2,'Approved',NULL,'patient1@gmail.com',NULL),(90,NULL,54,18,'2021-08-16','22:49',18,'test',NULL,'Pending',NULL,'patient1@gmail.com',NULL),(91,'ONLINE',53,18,'2021-08-16','10:52',18,'test\r\n',NULL,'Pending',NULL,NULL,NULL),(92,'ONLINE',53,15,'2021-08-16','01:52',15,'blood\r\n',NULL,'Pending',NULL,NULL,NULL),(89,'Online',55,18,'2021-08-15','15:42:00',18,'checkup',1,'Approved',1,'patient2@gmail.com',NULL),(83,'Online',53,16,'2021-08-13','20:43',17,'Leg Amputation',1,'Approved',1,'ndidicorryn20@gmail.com',NULL),(85,'In-Person',53,17,'2021-08-13','21:34',17,'Emergency Emergency never see me coming through!!!',1,'Pending',1,'ndidicorryn20@gmail.com',NULL);
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_type_tbl`
--

LOCK TABLES `appointment_type_tbl` WRITE;
/*!40000 ALTER TABLE `appointment_type_tbl` DISABLE KEYS */;
INSERT INTO `appointment_type_tbl` VALUES (3,'Online','Active'),(1,'In-Person','Active');
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
  `billingid` int(11) NOT NULL,
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
INSERT INTO `billing_records` VALUES (3,24,2,'Room Cost',3000.00,'2018-9-8','Active'),(2,24,1,'Consultancy Fee',400000.00,'2029-9-9','Active'),(1,24,1,'Treatment Cost',4000.00,'2012-09-9','Active');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_tbl`
--

LOCK TABLES `billing_tbl` WRITE;
/*!40000 ALTER TABLE `billing_tbl` DISABLE KEYS */;
INSERT INTO `billing_tbl` VALUES (20,1,1,'2021-07-22','10:32:48',0.00,0.00,'','',''),(21,1,53,'2021-07-22','10:37:52',0.00,0.00,'','',''),(22,2,54,'2021-07-23','13:44:18',0.00,0.00,'','',''),(23,46,61,'2021-07-25','11:41:34',0.00,0.00,'','',''),(24,46,63,'2021-07-25','14:54:17',0.00,0.00,'','',''),(25,47,68,'2021-07-26','13:46:53',0.00,0.00,'','',''),(26,46,66,'2021-08-08','10:09:44',0.00,0.00,'','',''),(27,53,80,'2021-08-09','16:36:25',0.00,0.00,'','',''),(28,54,86,'2021-08-15','12:11:21',0.00,0.00,'','','');
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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_tbl`
--

LOCK TABLES `department_tbl` WRITE;
/*!40000 ALTER TABLE `department_tbl` DISABLE KEYS */;
INSERT INTO `department_tbl` VALUES (15,'Laboratory and Blood bank','Laboratory Testing Area','Active'),(17,'Emergency','EEm','Active'),(18,'Physician','All types of diseases','Active'),(19,'Neurologist','Related neurons','Active'),(20,'Pediatrics','Pediatrics doctor','Active'),(21,'Blood Pressure Check','Blood Pressure','Active'),(16,'Surgery','All surgery','Active');
/*!40000 ALTER TABLE `department_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_appointment_tbl`
--

DROP TABLE IF EXISTS `doctor_appointment_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_appointment_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` int(11) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `appointmentdate` varchar(100) DEFAULT NULL,
  `appointmenttime` time DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `appointmenttype` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `roomid` int(11) DEFAULT NULL,
  `patientemail` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_appointment_tbl`
--

LOCK TABLES `doctor_appointment_tbl` WRITE;
/*!40000 ALTER TABLE `doctor_appointment_tbl` DISABLE KEYS */;
INSERT INTO `doctor_appointment_tbl` VALUES (28,54,15,'2021-08-13','09:25:00',15,'Test doctor 2','In-Person','Approved',2,'patient1@gmail.com'),(27,54,17,'2021-08-19','02:05:00',17,'Testing','Online','Approved',2,'patient1@gmail.com'),(26,53,17,'2021-08-13','21:34:00',17,'Emergency Emergency never see me coming through!!!','In-Person','Pending',NULL,NULL),(25,53,17,'2021-08-13','21:34:00',17,'Emergency Emergency never see me coming through!!!','In-Person','Approved',3,'ndidicorryn20@gmail.com'),(29,55,18,'2021-08-15','15:42:00',18,'checkup','Online','Approved',1,'patient2@gmail.com');
/*!40000 ALTER TABLE `doctor_appointment_tbl` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_tbl`
--

LOCK TABLES `doctor_tbl` WRITE;
/*!40000 ALTER TABLE `doctor_tbl` DISABLE KEYS */;
INSERT INTO `doctor_tbl` VALUES (18,'Doc4','DoctorFour','UNILAG','BSC','3',30000.00,18,'Male','ikorodu','Lagos','09090908899','doctor@yahool.com','doctor','Active'),(15,'Doc2','Dr','BSC','bb','8',30000.00,15,'Male','London','Middlesex','09098836011','doc2@gmail.com','12345678','Active'),(17,'Doc3','Dcr','BSC','WE','6',70000.00,17,'Female','ikorodu','Lag','11111111111','doc3@gmail.com','12345678','Active'),(16,'Doc1','Doctor','BSC PHD','bbed','7',25000.00,16,'Male','Chiina','Delhi','09093930209','doc1@gmail.com','12345678','Active');
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_timing_tbl`
--

LOCK TABLES `doctor_timing_tbl` WRITE;
/*!40000 ALTER TABLE `doctor_timing_tbl` DISABLE KEYS */;
INSERT INTO `doctor_timing_tbl` VALUES (11,1,'12:00','14:00','Active'),(10,1,'10:00','17:00','Active');
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine_tbl`
--

LOCK TABLES `medicine_tbl` WRITE;
/*!40000 ALTER TABLE `medicine_tbl` DISABLE KEYS */;
INSERT INTO `medicine_tbl` VALUES (8,'Ampliclus',200.00,'mmmmm','Active'),(7,'Binto Tonic',700.00,'Blood tonic ','Active');
/*!40000 ALTER TABLE `medicine_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nurse_tbl`
--

DROP TABLE IF EXISTS `nurse_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurse_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nurseFirstname` varchar(50) DEFAULT NULL,
  `nurseLastname` varchar(45) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `emailAddress` varchar(45) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nurse_tbl`
--

LOCK TABLES `nurse_tbl` WRITE;
/*!40000 ALTER TABLE `nurse_tbl` DISABLE KEYS */;
INSERT INTO `nurse_tbl` VALUES (1,'Jane','Smith','Middlesex Uni','MBBS,MD,IDCCM','7',15,'Female','Ikorodo','Lagos','+2109098836011','nurse@yahoo.com','nurse','Active'),(6,'Nurse6','NurseSix','UNI','Mbbs','8',15,'Female','lagos','ONDO','0909090909033','nurse6@gmail.com','12345678','Active'),(3,'Nurse3','NurseThree','UNI','Mbbs','8',17,'Female','lagos','ONDO','0909090909033','nurse3@gmail.com','12345678','Active'),(2,'Nurse2','NurseTwo','UNI','Mbbs','8',21,'Female','lagos','ONDO','0909090909033','nurse1@gmail.com','12345678','Active');
/*!40000 ALTER TABLE `nurse_tbl` ENABLE KEYS */;
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
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_tbl`
--

LOCK TABLES `patient_tbl` WRITE;
/*!40000 ALTER TABLE `patient_tbl` DISABLE KEYS */;
INSERT INTO `patient_tbl` VALUES (53,'Ndidi','Pat','Female','1997-02-04','O+','Ikorodo','Lagos','09098836011','patient@yahoo.com','patient','patient','Active','2021-08-09','17:02:07',NULL),(54,'Patient1','Pat','Male','1999-02-02','o+','ikorodu','Lagos','09098872722','patient1@gmail.com','12345678','12345678','Active','2021-08-12','00:00:35',NULL),(55,'Patient2','PatientTWO','Male','2021-08-13','A+','Ikorodo','Lagos','111111111111','patient2@gmail.com','12345678','12345678','Active','2021-08-14','01:27:09',NULL),(56,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription`
--

LOCK TABLES `prescription` WRITE;
/*!40000 ALTER TABLE `prescription` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription_records`
--

LOCK TABLES `prescription_records` WRITE;
/*!40000 ALTER TABLE `prescription_records` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'General','90','200',4000.00,'Active'),(2,'Private','10','230',30000.00,'Active'),(3,'VIP','2','VI-768',4000000.00,'Active');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type`
--

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment`
--

LOCK TABLES `treatment` WRITE;
/*!40000 ALTER TABLE `treatment` DISABLE KEYS */;
INSERT INTO `treatment` VALUES (1,'Malaria',50000.00,'None','Active'),(2,'No Treatment Adminstered',0.00,'No treatment adminsitered','Active');
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
  `treatment_date` varchar(100) NOT NULL,
  `treatment_time` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment_records`
--

LOCK TABLES `treatment_records` WRITE;
/*!40000 ALTER TABLE `treatment_records` DISABLE KEYS */;
INSERT INTO `treatment_records` VALUES (12,1,1,1,1,'lllllllllll','2021-07-22','11:32','Active'),(15,1,53,1,1,'llllllllll','2021-07-21','11:43','Active'),(16,1,53,1,1,'kkkkkkkkkkkkkkk','2021-07-22','11:52','Active'),(17,1,53,1,1,'kkkkkkkkkkkkkkkkoolol','2021-07-22','11:55','Active'),(18,1,53,1,1,'jjjjjj','2021-07-23','01:39','Active'),(19,1,53,1,1,'kik','2021-07-23','18:11','Active'),(20,1,63,46,9,'Take malaria medicine','2021-07-25','18:54','Active'),(21,2,66,46,1,'No Treatment','2021-08-08','00:09','Active'),(22,1,86,54,18,'teset','2021-08-15','13:11','Active'),(23,1,86,54,18,'test','2021-08-15','14:12','Active');
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatmenttype_tbl`
--

LOCK TABLES `treatmenttype_tbl` WRITE;
/*!40000 ALTER TABLE `treatmenttype_tbl` DISABLE KEYS */;
INSERT INTO `treatmenttype_tbl` VALUES (7,'Treatment for Malaria',2500.00,'Treatment for malaria and typhoid','Active'),(8,'Treatment for Dengue',2500.00,'denguee','Active');
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

-- Dump completed on 2022-02-15 20:58:48
