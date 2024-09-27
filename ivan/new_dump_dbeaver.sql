/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.5.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: myfirstdb
-- ------------------------------------------------------
-- Server version	11.5.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `Bron`
--

DROP TABLE IF EXISTS `Bron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bron` (
  `Name_Bron` varchar(100) DEFAULT NULL,
  `Email_Bron` varchar(100) DEFAULT NULL,
  `Phone_Bron` varchar(100) DEFAULT NULL,
  `Name_Car` varchar(100) DEFAULT NULL,
  `Price_Car` int(200) DEFAULT NULL,
  KEY `Bron_Car_FK` (`Name_Bron`,`Price_Car`),
  KEY `Bron_Car_FK_1` (`Name_Car`,`Price_Car`),
  KEY `Bron_User_FK` (`Name_Bron`,`Email_Bron`,`Phone_Bron`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bron`
--

LOCK TABLES `Bron` WRITE;
/*!40000 ALTER TABLE `Bron` DISABLE KEYS */;
INSERT INTO `Bron` VALUES
('Slava','dadamatov111@mail.ru','1232312312312','Мерседес',200000),
('ivan','ivan.fa.001@mail.ru','89805307554','Keltin',45000),
('ivan','ivan.fa.001@mail.ru','89805307554','Москвич',30000),
('user1','sir@gmail.com','12389128391893','Seberal',40000),
('ivan','ivan.fa.001@mail.ru','89805307554','dats',45000),
('ivan','ivan.fa.001@mail.ru','89805307554','Москвич',30000),
('ivan','ivan.fa.001@mail.ru','89805307554','Москвич',30000);
/*!40000 ALTER TABLE `Bron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Car`
--

DROP TABLE IF EXISTS `Car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Price` int(100) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Marks` varchar(100) NOT NULL,
  `File` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Car_Bron_FK` (`Price`,`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Car`
--

LOCK TABLES `Car` WRITE;
/*!40000 ALTER TABLE `Car` DISABLE KEYS */;
INSERT INTO `Car` VALUES
(1,'Мерседес','Москва',200000,'img/carusel/car1.jpg','Mersedes','pages/cars/Mersedes_1.php'),
(2,'Лада Гранта','Киев',20000,'img/carusel/car2.jpg','Lada','pages/cars/Lada_2.php'),
(3,'Москвич','Петропавловкс',30000,'img/carusel/car3.jpg','Lada','pages/cars/Lada_3.php'),
(4,'Rinto','Красноярск',123000,'img/carusel/car4.jpg','Rin','pages/cars/Rin.php'),
(5,'Seberal','Красноярск',40000,'img/carusel/car5.jpg','Seber','pages/cars/Seber.php'),
(6,'Keltin','Берлин',45000,'img/carusel/car6.jpg','Kelt','pages/cars/Kelt.php'),
(7,'Cruiser','Севастополь',50000,'img/carusel/car7.jpg','Lada','pages/cars/Lada.php'),
(8,'Балид','Москва',300000,'img/carusel/car8.jpg','Australia','pages/cars/Australia.php'),
(9,'Solaris','Крым',43000,'img/carusel/car9.jpg','Solar','pages/cars/Solar9.php'),
(10,'Гоночная','Санкт-Петербург',100000,'img/carusel/car10.jpg','Gonki','pages/cars/Gonki10.php'),
(11,'dats','Красноярск',45000,'img/carusel/car10.jpg','Datsu','pages/cars/Datsu2.php'),
(12,'Toyot','Вологда',75000,'img/carusel/car11.jpg','Toyota','pages/cars/Toyota2.php');
/*!40000 ALTER TABLE `Car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Full_Car`
--

DROP TABLE IF EXISTS `Full_Car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Full_Car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name_Car` varchar(100) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `Litr` int(2) DEFAULT NULL,
  `Max_Speed` int(3) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Price` int(100) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Full_Car`
--

LOCK TABLES `Full_Car` WRITE;
/*!40000 ALTER TABLE `Full_Car` DISABLE KEYS */;
INSERT INTO `Full_Car` VALUES
(1,'Мерседес',2005,50,100,'Чёрный',200000,'img/carusel/car1.jpg'),
(2,'Лада Гранта',2003,30,90,'Серый',20000,'img/carusel/car2.jpg'),
(3,'Москвич',2000,30,90,'Красный',30000,'img/carusel/car3.jpg'),
(4,'Rinto',2010,50,100,'Красный',123000,'img/carusel/car4.jpg'),
(5,'Seberal',2015,40,95,'Белый',40000,'img/carusel/car5.jpg'),
(6,'Keltin',1998,35,60,'Серый',45000,'img/carusel/car6.jpg'),
(7,'Cruiser',2015,40,80,'Белый',50000,'img/carusel/car7.jpg'),
(8,'Балид',2020,30,200,'Красный',300000,'img/carusel/car8.jpg'),
(9,'Solaris',2012,45,80,'Красный',43000,'img/carusel/car9.jpg'),
(10,'Гоночная',2013,50,100,'Чёрный',100000,'img/carusel/car10.jpg'),
(11,'dats',2015,30,200,'Красный',45000,'img/carusel/car10.jpg'),
(12,'Toyot',2020,45,90,'Серый',75000,'img/carusel/car11.jpg');
/*!40000 ALTER TABLE `Full_Car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES
(1,'admin','dadamatov222@mail.ru','39420134252','admin'),
(2,'ivan','ivan.fa.001@mail.ru','89805307554','moredock1'),
(3,'Slava','dadamatov111@mail.ru','1232312312312','123321'),
(4,'Sara','ar@gmail.com','111222333','123'),
(5,'user1','sir@gmail.com','12389128391893','123321'),
(7,'user2','user2@mail.ru','+79517418563','user2');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'myfirstdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2024-09-25 19:07:40
