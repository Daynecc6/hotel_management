CREATE DATABASE  IF NOT EXISTS `hotel_management` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hotel_management`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hotel_management
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `WageID` int DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  KEY `WageID` (`WageID`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`WageID`) REFERENCES `wages` (`WageID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Letha Bolt','housekeeper',3),(2,'Vanita Kelleher','housekeeper',3),(3,'Marcos Abraham','housekeeper',3),(4,'Miyoko Mckinney','maintenance',3),(5,'Adolph Francisco','maintenance',2),(6,'Oma Lawler','housekeeper',3),(7,'Felix Alba','housekeeper',1),(8,'Eusebia Noland','manager',1),(9,'Denisha Mcginnis','housekeeper',3),(10,'Stanford Sullivan','maintenance',2),(11,'Nathan Salisbury','housekeeper',1),(12,'Burton Bunnell','housekeeper',2),(13,'Adah Jameson','housekeeper',2),(14,'Adam Geer','manager',2),(15,'Freeman Selby','maintenance',1),(16,'Laura Barger','maintenance',1),(17,'Ariel Hermann','housekeeper',1),(18,'Adam Maddox','maintenance',1),(19,'Winnifred Brantley','maintenance',2),(20,'Gayle Baugh','maintenance',3),(21,'Delcie Abney','manager',2),(22,'Kasey Furr','housekeeper',2),(23,'Gertie Abel','housekeeper',2),(24,'Myles Angel','housekeeper',2),(25,'Jerome Gipson','maintenance',2),(26,'Lilla Perez','housekeeper',1),(27,'Josephine Norwood','maintenance',2),(28,'Elli Robertson','housekeeper',3),(29,'Curtis Hutson','manager',2),(30,'Melia Gates','manager',3),(31,'Marc Pickering','maintenance',2),(32,'Alida Jobe','maintenance',2),(33,'Cordelia Key','maintenance',3),(34,'Reba Gregg','housekeeper',3),(35,'Jarod Bourgeois','manager',1),(36,'Oliva Coble','manager',3),(37,'Corey Musgrove','manager',1),(38,'Bud Grubbs','housekeeper',1),(39,'Newton Graves','maintenance',3),(40,'Tamica Goins','maintenance',3),(41,'Bertram Herzog','housekeeper',3),(42,'Malcolm Coward','manager',1),(43,'Carley Valdez','maintenance',2),(44,'Lizzie Krueger','housekeeper',2),(45,'Celestine Hong','housekeeper',3),(46,'Shonda Leake','maintenance',2),(47,'Hubert Waldrop','maintenance',2),(48,'Alphonso Meeks','housekeeper',2),(49,'Aimee Stamm','housekeeper',3),(50,'Sonia Ackerman','housekeeper',1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeeshifts`
--

DROP TABLE IF EXISTS `employeeshifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employeeshifts` (
  `ShiftID` int NOT NULL AUTO_INCREMENT,
  `EmployeeID` int DEFAULT NULL,
  `WorkDate` date DEFAULT NULL,
  `ShiftType` enum('morning','afternoon','night') DEFAULT NULL,
  `HoursWorked` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`ShiftID`),
  KEY `EmployeeID` (`EmployeeID`),
  CONSTRAINT `employeeshifts_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeeshifts`
--

LOCK TABLES `employeeshifts` WRITE;
/*!40000 ALTER TABLE `employeeshifts` DISABLE KEYS */;
INSERT INTO `employeeshifts` VALUES (1,32,'2023-11-10','afternoon',8.00),(2,23,'2023-10-27','afternoon',8.00),(3,41,'2023-10-28','morning',4.00),(4,21,'2023-10-27','night',10.00),(5,32,'2023-11-10','morning',4.00),(6,49,'2023-10-26','morning',8.00),(7,18,'2023-11-01','night',8.00),(8,40,'2023-11-09','afternoon',8.00),(9,3,'2023-11-04','morning',8.00),(10,22,'2023-11-06','morning',4.00),(11,28,'2023-10-28','afternoon',8.00),(12,1,'2023-11-01','morning',4.00),(13,44,'2023-11-11','morning',4.00),(14,6,'2023-11-10','afternoon',8.00),(15,31,'2023-11-10','morning',8.00),(16,47,'2023-10-28','morning',8.00),(17,50,'2023-11-10','afternoon',8.00),(18,42,'2023-11-03','morning',8.00),(19,48,'2023-10-27','afternoon',8.00),(20,11,'2023-11-05','morning',4.00),(21,34,'2023-10-25','morning',4.00),(22,24,'2023-11-08','morning',8.00),(23,6,'2023-11-01','morning',8.00),(24,8,'2023-11-11','afternoon',8.00),(25,16,'2023-11-11','night',8.00),(26,18,'2023-11-03','night',8.00),(27,11,'2023-11-04','afternoon',8.00),(28,22,'2023-11-06','night',10.00),(29,40,'2023-11-02','morning',4.00),(30,38,'2023-10-31','afternoon',8.00),(31,33,'2023-11-07','night',10.00),(32,24,'2023-10-26','night',10.00),(33,8,'2023-11-07','morning',4.00),(34,2,'2023-10-27','morning',4.00),(35,49,'2023-11-03','morning',8.00),(36,45,'2023-10-25','night',8.00),(37,4,'2023-10-26','afternoon',8.00),(38,12,'2023-10-28','afternoon',8.00),(39,49,'2023-10-27','afternoon',8.00),(40,16,'2023-11-02','morning',4.00),(41,12,'2023-10-25','morning',4.00),(42,30,'2023-10-31','morning',8.00),(43,24,'2023-11-05','morning',8.00),(44,11,'2023-11-08','afternoon',8.00),(45,37,'2023-11-04','night',10.00),(46,22,'2023-10-26','afternoon',8.00),(47,45,'2023-11-05','morning',4.00),(48,6,'2023-10-25','afternoon',8.00),(49,46,'2023-11-03','morning',8.00),(50,39,'2023-11-01','afternoon',8.00);
/*!40000 ALTER TABLE `employeeshifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `FeedbackID` int NOT NULL AUTO_INCREMENT,
  `Comments` text,
  `Rating` int DEFAULT NULL,
  `ServiceID` int DEFAULT NULL,
  `GuestID` int DEFAULT NULL,
  PRIMARY KEY (`FeedbackID`),
  KEY `ServiceID` (`ServiceID`),
  KEY `GuestID` (`GuestID`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`),
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`GuestID`),
  CONSTRAINT `feedback_chk_1` CHECK (((`Rating` >= 1) and (`Rating` <= 5)))
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'Poor',2,4,3),(2,'Poor',2,5,23),(3,'Poor',2,1,18),(4,'Good',4,3,42),(5,'Good',4,4,20),(6,'Good',4,4,46),(7,'Poor',2,3,30),(8,'Poor',2,4,18),(9,'Poor',2,2,19),(10,'Ok',3,5,47),(11,'Good',4,3,39),(12,'Awful',1,4,3),(13,'Great',5,1,27),(14,'Ok',3,2,11),(15,'Good',4,4,10),(16,'Great',5,3,19),(17,'Awful',1,1,2),(18,'Good',4,3,34),(19,'Good',4,3,29),(20,'Good',4,3,24),(21,'Poor',2,3,14),(22,'Great',5,2,10),(23,'Ok',3,1,33),(24,'Ok',3,2,12),(25,'Great',5,3,15),(26,'Ok',3,1,34),(27,'Great',5,1,32),(28,'Poor',2,2,20),(29,'Awful',1,2,34),(30,'Great',5,2,36),(31,'Good',4,5,5),(32,'Ok',3,5,16),(33,'Awful',1,3,8),(34,'Good',4,5,44),(35,'Awful',1,4,10),(36,'Great',5,1,22),(37,'Great',5,4,1),(38,'Great',5,4,41),(39,'Ok',3,3,13),(40,'Great',5,1,41),(41,'Ok',3,3,5),(42,'Awful',1,2,30),(43,'Awful',1,3,3),(44,'Good',4,5,44),(45,'Ok',3,5,4),(46,'Great',5,3,25),(47,'Ok',3,4,34),(48,'Poor',2,1,36),(49,'Great',5,2,43),(50,'Good',4,2,24);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guests` (
  `GuestID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `TypeTraveler` enum('business','leisure') NOT NULL,
  `LoyaltyMember` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`GuestID`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guests`
--

LOCK TABLES `guests` WRITE;
/*!40000 ALTER TABLE `guests` DISABLE KEYS */;
INSERT INTO `guests` VALUES (1,'Scot Acker','Adam.Acker24@example.com','(564) 517-5025','leisure',1),(2,'Albert Mclean','byiswceo_myqdc@example.com','(684) 186-0087','business',1),(3,'Adelaida Bergman','LealU19@nowhere.com','(260) 313-6443','business',1),(4,'Abram Patten','kkhx3854@example.com','(868) 864-8718','leisure',0),(5,'Edgar Adler','owpk8399@example.com','(451) 929-8321','leisure',1),(6,'Edward Jarvis','Jennings@example.com','(133) 683-0582','leisure',0),(7,'Wesley Ramirez','Gee@nowhere.com','(765) 713-9006','business',1),(8,'Gregg Fulmer','PhilRichey8@example.com','(447) 838-0332','leisure',0),(9,'Karly Aguirre','Babin@example.com','(730) 273-6683','leisure',0),(10,'Rueben Sell','MargaritoAnthony@example.com','(812) 252-0427','business',1),(11,'Porsha Minton','GladisReeves33@example.com','(977) 813-8110','leisure',0),(12,'Almeta Bowling','Cordero@example.com','(826) 366-1014','leisure',1),(13,'Leonora Houser','PeggieScott@example.com','(914) 159-1651','business',1),(14,'Dudley Rowan','Costa@example.com','(961) 069-2786','business',1),(15,'Vance Blaine','Adair77@example.com','(768) 048-0640','leisure',1),(16,'Clemmie Grove','DominickGrier@nowhere.com','(790) 495-8216','business',1),(17,'Lester Cohn','Rau71@nowhere.com','(552) 037-7186','leisure',0),(18,'Andrew Crutchfield','Rosario_Dejesus7@example.com','(247) 811-3933','business',1),(19,'Percy Valdes','Armstrong5@example.com','(594) 490-9628','leisure',0),(20,'Duncan Sisco','GiannaJenkins@example.com','(438) 866-0472','business',1),(21,'Christian Gill','Crooks@nowhere.com','(227) 049-9918','leisure',1),(22,'Avery Weeks','Adan_Stafford@nowhere.com','(768) 693-9345','business',1),(23,'Travis Abney','Alston679@example.com','(487) 479-9336','leisure',0),(24,'Judson Oh','Matney@example.com','(857) 863-6779','leisure',0),(25,'Abe Tibbs','StephaniJ_Grossman@example.com','(104) 855-4937','business',1),(26,'Allan Canales','JoaquinWilbanks@example.com','(273) 600-9445','leisure',0),(27,'Kristle Dickens','Mary.N_Kunkel572@example.com','(553) 638-6830','business',1),(28,'Aide Manley','LeilaBrubaker@example.com','(442) 344-5339','leisure',0),(29,'Vita Morrissey','Anastacia.OPruitt48@example.com','(535) 013-0514','leisure',0),(30,'Alease Perales','Frankie_Grossman@nowhere.com','(875) 375-2382','business',1),(31,'Agueda Camp','Muriel_QMilliken5@example.com','(610) 362-5075','business',1),(32,'Jamie Aguiar','enqvjfmk.cofgkn@nowhere.com','(243) 459-7372','leisure',0),(33,'Augustus Abreu','Villalobos7@example.com','(845) 678-6842','business',1),(34,'Romeo Anderson','GertudePlace@nowhere.com','(384) 573-9515','business',1),(35,'Abdul Rainey','MinervaSeay@nowhere.com','(135) 721-2385','leisure',1),(36,'Joye Ryder','FelixD.Shoemaker@example.com','(533) 039-4249','leisure',0),(37,'Rory Burchfield','AmadoMedina589@example.com','(649) 790-3129','business',1),(38,'Adaline Shah','Luigi.Duvall448@example.com','(861) 866-2316','leisure',0),(39,'Alexandria Mendenhall','Blank783@example.com','(403) 014-5022','business',1),(40,'Adolfo Rangel','Flowers139@nowhere.com','(153) 734-4222','leisure',0),(41,'Kyung Andrew','Clapp@example.com','(821) 308-8608','leisure',1),(42,'Melvin Sommers','LucioDolan@example.com','(864) 550-3567','business',1),(43,'Jamika Mendez','Caleb.Lincoln2@example.com','(360) 865-3659','leisure',0),(44,'Seth Ojeda','Kareem.Ratliff@example.com','(598) 443-5163','leisure',0),(45,'Mistie Musgrove','ahukz6794@example.com','(995) 647-4714','leisure',0),(46,'Gabriela Harmon','DrewTravis253@example.com','(447) 684-3013','business',1),(47,'Alexis Goulet','BernardoBarkley1@example.com','(866) 682-6586','business',1),(48,'Neal Bergman','AnalisaThomas1@nowhere.com','(229) 446-3852','leisure',0),(49,'Fermina Fields','Violeta_Tribble832@example.com','(405) 834-7270','leisure',0),(50,'Rolande Price','Spann93@example.com','(348) 653-5855','leisure',0);
/*!40000 ALTER TABLE `guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loyaltyprogram`
--

DROP TABLE IF EXISTS `loyaltyprogram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loyaltyprogram` (
  `LoyaltyID` int NOT NULL AUTO_INCREMENT,
  `GuestID` int DEFAULT NULL,
  `Points` int DEFAULT '0',
  `RewardsRedeemed` text,
  PRIMARY KEY (`LoyaltyID`),
  KEY `GuestID` (`GuestID`),
  CONSTRAINT `loyaltyprogram_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`GuestID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loyaltyprogram`
--

LOCK TABLES `loyaltyprogram` WRITE;
/*!40000 ALTER TABLE `loyaltyprogram` DISABLE KEYS */;
INSERT INTO `loyaltyprogram` VALUES (1,22,2170,'B'),(2,1,1664,'A'),(3,27,1870,'B'),(4,22,2171,'B'),(5,39,1364,'B'),(6,30,1871,'B'),(7,46,2172,'A'),(8,38,79,'A'),(9,17,1665,'B'),(10,46,2963,'A'),(11,48,1872,'B'),(12,16,2665,'A'),(13,3,2964,'B'),(14,10,2173,'A'),(15,43,1365,'A'),(16,47,1873,'B'),(17,23,955,'A'),(18,8,655,'B'),(19,32,2174,'B'),(20,45,956,'B'),(21,1,656,'A'),(22,36,957,'A'),(23,8,2666,'A'),(24,12,1874,'A'),(25,24,2175,'A'),(26,27,1666,'A'),(27,34,2965,'A'),(28,15,1875,'A'),(29,12,2176,'A'),(30,21,1876,'B'),(31,2,2667,'A'),(32,44,380,'A'),(33,17,2177,'B'),(34,9,1366,'A'),(35,7,2966,'B'),(36,34,1667,'A'),(37,44,2668,'A'),(38,40,80,'A'),(39,6,2967,'A'),(40,34,2669,'A'),(41,25,1367,'A'),(42,14,1668,'A'),(43,9,2968,'A'),(44,50,381,'B'),(45,3,1877,'A'),(46,35,1368,'A'),(47,47,657,'A'),(48,47,2178,'A'),(49,8,2670,'B'),(50,25,1878,'A');
/*!40000 ALTER TABLE `loyaltyprogram` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `ReservationID` int NOT NULL AUTO_INCREMENT,
  `GuestID` int DEFAULT NULL,
  `RoomID` int DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `RoomNumber` int DEFAULT NULL,
  PRIMARY KEY (`ReservationID`),
  KEY `GuestID` (`GuestID`),
  KEY `RoomID` (`RoomID`),
  KEY `RoomNumber` (`RoomNumber`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`GuestID`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`RoomNumber`) REFERENCES `roomnumbers` (`RoomNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,46,1,'2023-10-26','2023-11-04',3),(2,44,1,'2023-10-25','2023-11-01',7),(3,26,1,'2023-11-04','2023-11-09',21),(4,33,2,'2023-10-27','2023-10-30',9),(5,28,3,'2023-11-07','2023-11-15',8),(6,5,3,'2023-11-05','2023-11-13',13),(7,23,1,'2023-11-08','2023-11-15',14),(8,35,1,'2023-11-08','2023-11-09',25),(9,46,1,'2023-11-01','2023-11-02',2),(10,32,3,'2023-10-28','2023-11-03',1),(11,39,1,'2023-10-30','2023-11-01',1),(12,13,3,'2023-10-28','2023-10-30',23),(13,8,3,'2023-10-30','2023-11-03',16),(14,28,3,'2023-11-02','2023-11-08',9),(15,7,2,'2023-10-28','2023-11-04',2),(16,23,3,'2023-11-06','2023-11-15',7),(17,47,2,'2023-11-09','2023-11-14',29),(18,26,2,'2023-10-30','2023-11-02',16),(19,32,3,'2023-10-29','2023-10-30',5),(20,38,3,'2023-11-09','2023-11-12',27),(21,49,1,'2023-11-07','2023-11-14',1),(22,28,2,'2023-11-05','2023-11-13',7),(23,37,2,'2023-11-11','2023-11-18',22),(24,13,1,'2023-11-05','2023-11-13',21),(25,32,3,'2023-11-08','2023-11-17',25),(26,25,1,'2023-10-26','2023-11-04',10),(27,49,3,'2023-11-11','2023-11-13',9),(28,6,3,'2023-11-02','2023-11-05',11),(29,4,2,'2023-11-10','2023-11-16',2),(30,6,3,'2023-11-05','2023-11-14',27),(31,20,3,'2023-10-27','2023-11-03',12),(32,1,1,'2023-11-03','2023-11-04',29),(33,44,3,'2023-10-31','2023-11-02',18),(34,12,3,'2023-10-28','2023-11-03',11),(35,4,3,'2023-10-31','2023-11-08',15),(36,37,3,'2023-11-09','2023-11-10',22),(37,45,2,'2023-11-06','2023-11-09',4),(38,4,2,'2023-11-11','2023-11-13',17),(39,31,1,'2023-11-06','2023-11-14',4),(40,20,3,'2023-11-03','2023-11-07',3),(41,44,3,'2023-11-02','2023-11-06',14),(42,1,2,'2023-10-30','2023-11-06',4),(43,27,3,'2023-10-28','2023-11-06',15),(44,40,3,'2023-10-31','2023-11-01',30),(45,37,3,'2023-11-07','2023-11-13',20),(46,31,3,'2023-11-04','2023-11-10',30),(47,25,2,'2023-10-30','2023-11-05',28),(48,14,3,'2023-10-26','2023-11-01',17),(49,36,3,'2023-11-06','2023-11-08',29),(50,12,1,'2023-10-27','2023-10-31',24);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roomnumbers`
--

DROP TABLE IF EXISTS `roomnumbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roomnumbers` (
  `RoomNumber` int NOT NULL,
  `RoomID` int DEFAULT NULL,
  PRIMARY KEY (`RoomNumber`),
  KEY `RoomID` (`RoomID`),
  CONSTRAINT `roomnumbers_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roomnumbers`
--

LOCK TABLES `roomnumbers` WRITE;
/*!40000 ALTER TABLE `roomnumbers` DISABLE KEYS */;
INSERT INTO `roomnumbers` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,3),(22,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(30,3);
/*!40000 ALTER TABLE `roomnumbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `RoomID` int NOT NULL AUTO_INCREMENT,
  `Type` enum('suite','standard','deluxe') NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `OccupancyRate` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`RoomID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'standard',100.00,35.14),(2,'deluxe',200.00,37.72),(3,'suite',300.00,18.59);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `ServiceID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Description` text,
  PRIMARY KEY (`ServiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Pool',NULL),(2,'Breakfast',NULL),(3,'Spa',NULL),(4,'Spa',NULL),(5,'Wifi',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wages`
--

DROP TABLE IF EXISTS `wages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wages` (
  `WageID` int NOT NULL AUTO_INCREMENT,
  `Position` varchar(255) NOT NULL,
  `HourlyRate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`WageID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wages`
--

LOCK TABLES `wages` WRITE;
/*!40000 ALTER TABLE `wages` DISABLE KEYS */;
INSERT INTO `wages` VALUES (1,'Housekeeper',15.00),(2,'Maintenance',25.00),(3,'Manager',35.00);
/*!40000 ALTER TABLE `wages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-11 17:47:06
