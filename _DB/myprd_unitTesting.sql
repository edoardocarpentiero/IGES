CREATE DATABASE  IF NOT EXISTS `myprd_testing` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `myprd_testing`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: my_prd
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Foto` varchar(100) DEFAULT NULL,
  `Matricola` varchar(20) NOT NULL,
  PRIMARY KEY (`Username`),
  UNIQUE KEY `Matricola` (`Matricola`),
  KEY `Matricola_2` (`Matricola`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` VALUES ('Presidente','password','http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg','201515165'),('DeSantis','password','http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg','201515101'),('DePrisco','password','http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg','201515166'),('RZizza','password','http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg','201515172'),('latorre','torre12','http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg','201515176'),('Negro','password','http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg','201515167');
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Associa`
--

DROP TABLE IF EXISTS `Associa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Associa` (
  `Matricola_Insegnamento` varchar(11) DEFAULT NULL,
  `Classe` int(1) NOT NULL,
  `ID_ProgDid` int(11) DEFAULT NULL,
  `Matricola_Professore` varchar(11) DEFAULT NULL,
  `Ore_Teoria` int(11) DEFAULT '0',
  `Ore_Lab` int(11) DEFAULT '0',
  `status` varchar(30) NOT NULL,
  KEY `Matricola_Insegnamento` (`Matricola_Insegnamento`),
  KEY `ID_ProgDid` (`ID_ProgDid`),
  KEY `Matricola_Professore` (`Matricola_Professore`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Associa`
--

LOCK TABLES `Associa` WRITE;
/*!40000 ALTER TABLE `Associa` DISABLE KEYS */;
INSERT INTO `Associa` VALUES ('9',1,7,'201515172',40,0,'PROPOSTO'),('9',1,7,'201515200',32,0,'IN ATTESA'),('9',2,7,'201515200',48,0,'IN ATTESA'),('9',2,7,'201515200',32,0,'IN ATTESA'),('30',1,7,'201515166',48,0,'RIFIUTATO'),('30',2,7,'201515166',48,0,'PROPOSTO'),('8',1,7,'201515165',72,0,'IN ATTESA'),('8',2,7,'201515172',40,0,'ASSEGNATO'),('31',1,7,'201515167',48,0,'IN ATTESA'),('31',2,7,'201515166',48,0,'IN ATTESA'),('37',1,8,'201515177',40,20,'IN ATTESA'),('37',1,8,'201515170',16,10,'IN ATTESA'),('37',2,8,'201515166',32,10,'ASSEGNATO'),('37',2,8,'201515166',16,10,'ASSEGNATO');
/*!40000 ALTER TABLE `Associa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Composto`
--

DROP TABLE IF EXISTS `Composto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Composto` (
  `ID_Suddivisione` int(11) DEFAULT NULL,
  `SSD` varchar(20) DEFAULT NULL,
  KEY `ID_Suddivisione` (`ID_Suddivisione`),
  KEY `SSD` (`SSD`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Composto`
--

LOCK TABLES `Composto` WRITE;
/*!40000 ALTER TABLE `Composto` DISABLE KEYS */;
INSERT INTO `Composto` VALUES (0,'FIS/01'),(0,'FIS/02'),(0,'MAT/01'),(0,'MAT/02'),(1,'INF/01'),(2,'INF/01'),(3,'FIS/01'),(3,'MAT/01'),(3,'INF/01'),(0,'FIS/03'),(0,'MAT/03'),(0,'MAT/04'),(0,'MAT/05'),(0,'MAT/06'),(0,'MAT/07'),(0,'MAT/08'),(0,'MAT/09'),(3,'SECS-P/08'),(1,'ING-INF/05'),(2,'ING-INF/05'),(3,'FIS/03'),(3,'ING-INF/03'),(3,'ING-INF/04'),(3,'ING-INF/05'),(3,'ING-INF/06'),(3,'IUS/01'),(3,'IUS/20'),(3,'MAT/02'),(3,'MAT/03'),(3,'MAT/04'),(3,'MAT/05'),(3,'MAT/06'),(3,'MAT/07'),(3,'MAT/08'),(3,'MAT/09'),(3,'SECS-S/01'),(8,'Altre conoscenze'),(9,'INF/01'),(9,'ING-INF/05'),(10,'BIO/09'),(10,'BIO/11'),(10,'BIO/18'),(10,'INF/01'),(10,'ING-INF/03'),(10,'ING-INF/04'),(10,'ING-INF/05'),(10,'ING-INF/06'),(10,'IUS/20'),(10,'IUS/01'),(10,'M-FIL/02'),(10,'MAT/01'),(10,'MAT/02'),(10,'MAT/03'),(10,'MAT/04'),(10,'MAT/05'),(10,'MAT/06'),(10,'MAT/07'),(10,'MAT/08'),(10,'MAT/09'),(10,'MED/03'),(10,'SECS-P/08'),(10,'SECS-P/07'),(10,'SECS-S/01'),(12,'Altre conoscenze'),(11,'a'),(6,'a'),(5,'a'),(4,'a'),(13,'a'),(14,'FIS/01'),(14,'FIS/02'),(14,'MAT/01'),(14,'MAT/02'),(14,'MED/03'),(14,'MAT/04'),(14,'MAT/05'),(14,'MAT/06'),(14,'MAT/08'),(14,'ma'),(14,'MAT/09'),(15,'INF/01'),(15,'ING-INF/05'),(16,'INF/01'),(16,'ING-INF/05'),(17,'INF/01'),(17,'ING-INF/05'),(17,'MAT/06'),(17,'MAT/08'),(17,'MAT/09'),(18,'a'),(19,'a'),(20,'a'),(21,'a');
/*!40000 ALTER TABLE `Composto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Docente`
--

DROP TABLE IF EXISTS `Docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Docente` (
  `Studio` varchar(30) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Ruolo` varchar(40) NOT NULL,
  `Info_Ricevimenti` varchar(30) NOT NULL,
  `SSD` varchar(10) NOT NULL,
  `Stato` tinyint(1) NOT NULL,
  `Matricola` int(11) NOT NULL AUTO_INCREMENT,
  `Telefono` varchar(15) NOT NULL,
  PRIMARY KEY (`Matricola`)
) ENGINE=MyISAM AUTO_INCREMENT=201515201 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Docente`
--

LOCK TABLES `Docente` WRITE;
/*!40000 ALTER TABLE `Docente` DISABLE KEYS */;
INSERT INTO `Docente` VALUES ('50','Paola','pcavaliere@unisa.it','Cavaliere','Docente Associato PA','Mercoledi 12-15','MAT/05',1,201515183,'089755442'),('Stecca 7, studio 8','Alfredo','a.des@live.it','De Sanctis','Docente Associato PA','Lunedi 15-17','INF/01',1,201515101,'3265252620'),('45','Sara ','s.monsurro@unisa.it','MonsurrÃ²','Ricercatore a tempo indeterminato RU','giovedÃ¬ 10','MAT/05',1,201515182,'089451232'),('46','Riccardo','ricdis@unisa.it','Distasi','Docente Associato PA','Martedi 15:00 - 16:00','INF/01',1,201515177,'3332221145'),('stecca 7, studio 9','Annalisa','debonis@dia.unisa.it','De Bonis','Docente Associato PA','Lun 10-12','INF/02',1,201515169,'0899697177'),('23','Giovanni','g.vincenzi@unisa.it','Vincenzi','Docente Associato PA','martedÃ¬ 13-14','MAT/02',1,201515178,'089465511'),('89','Costantino','c.delizia@unisa.it','Delizia ','Docente Associato PA','lunedÃ¬ 12-13','MAT/02',1,201515179,'089333833'),('16 ','Enrico','efischetti@unisa.it','Fischetti','Docente Associato PA','Lunedi 12-14','INF/01',1,201515180,'089355667'),('edificio F, stanza 13','Salvatore','slatorre@unisa.it','La Torre','Docente Associato PA','Gio 12-15','INF/01',1,201515176,'0899697266'),('66','Patrizia','p.delizia@unisa.it','Di Girolamo','Ricercatore a tempo indeterminato RU','venerdÃ¬ 15-16','MAT/05',1,201515181,'089256578'),('Inv 12B, Primo Piano, stanza 8','Filomena','fferrucci@unisa.it','Ferrucci','Docente Ordinario PO','Lun 16-17 Mer 11-13','INF/01',1,201515165,'0891233374'),('stecca 7, studio 58, 4 piano','Roberto','robdep@unisa.it','De Prisco','Docente Associato PA','Mer 14-16 Gio 12-13','INF/01',1,201515166,' 0899697222'),('stecca 7','Alberto','alberto@unisa.it','Negro','Docente Ordinario PO','Lun 14-16','INF/01',1,201515167,'0899697277'),('stecca 9, stanza 60','Giuseppe','ggrella@unisa.it','Grella','Docente Ordinario PO','Lun 15-17','FIS/01',1,201515168,'0899693522'),('stecca 7, stanza 78','Filomena','fdesantis@unisa.it','De Santis','Docente Associato PA','Lun !0-12','INF/01',1,201515170,'0899697246'),('edificio F, stanza 34','Genoeffa','tortora@unisa.it','Tortora','Docente Ordinario PO','Lun 14-16','INF/01',0,201515171,'0899633333'),('stecca 7, stanza 21','Rosalba','rzizza@unisa.it','Zizza','Ricercatore a tempo indeterminato RU','Mar 15-17 Gio 12-13','MAT/03',0,201515172,'0899697366'),('Edificio F, studio 10','Carmine','gravino@unisa.it','Gravino','Docente Associato PA','Mar 13-15','INF/02',1,201515173,'08996973503'),('stecca 7, stanza 1','Vittorio','vitsca@unisa.it','Scarano','Docente Associato PA','Mar 15-16 Gio 11-12','INF/01',1,201515174,'0899697333'),('stecca 7, stanza 4','Ugo','uvaccaro@unisa.it','Vaccaro','Docente Associato PA','Mar 12-14 Gio 10-12','MAT/01',0,201515175,'0899697344'),('34','Loredana','lorcaso@unisa.it','Caso','Docente Associato PA','Martedi 15-16','0',1,201515184,'089968236'),('11','Clelia ','c.defelice@unisa.it','De felice ','Docente Ordinario PO','lunedi 17-18','INF/01',1,201515185,'089456123'),('38','Adele','arescigno@unisa.it','Rescigno','Docente Associato PA','Venerdi 14-18','INF/01',1,201515186,'089546231'),('51','Tucci','mtucci@unisa.it','Maurizio','Docente Associato PA','Venerdi 12-13','INF/01',1,201515187,'089747576'),('44','Giuseppe ','g.polese@unisa.it','Polese','Docente Associato PA','venerdÃ¬ 16-17','INF/01',1,201515188,'089465312'),('79','Vincenzo','vdeufemia@unisa.it','Deufemia','Ricercatore a tempo indeterminato RU','Mercoledi 13-15','INF/01',1,201515189,'089633521'),('76','Monica Maria Lucia','msebillo@unisa.it','Sebillo','Ricercatore a tempo indeterminato RU','Martedi 17-18','0',1,201515190,'089212524'),('1','Andrea Francesco','aabate@unisa.it','Abate','Docente Associato PA','Lunedi 12-15','INF/01',1,201515191,'089565245'),('90','Bruno','b.carpentieri@unisa.it','Carpentieri','Docente Associato PA','lunedÃ¬ 16-17','INF/01',1,201515192,'089465123'),('2','Antonio','adicrescenzo@unisa.it','Di Crescenzo','Docente Associato PA','Mercoledi 18-19','MAT/06',1,201515193,'089369363'),('56','Francesco ','f.palmieri@unisa.it','Palmieri','Docente Associato PA','lunedi 16-17','INF/01',1,201515194,'089465236'),('13','Raffaele','r.cerulli@unisa.it','Cerulli','Docente Associato PA','lunedi 10-11','MAT/09',1,201515195,'089467512'),('14','Francesco','f.carrab@unisa.it','Carrabs','Ricercatore a tempo indeterminato RU','matedi 16-17','MAT/09',1,201515196,'089461213'),('15','Rita','rfrancese@unisa.it','Francese','Docente Associato PA','Mercoledi 12-15','0',1,201515197,'089363534'),('3','Sara','sara.cinesca@gmail.com','Cinesca','Docente Ordinario PO','lol','INF/01',1,201515198,'3486987585'),('-','Docente','-','Fittizio','-','-','-',1,201515200,'-');
/*!40000 ALTER TABLE `Docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Formato`
--

DROP TABLE IF EXISTS `Formato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Formato` (
  `Matricola_Insegnamento` int(11) NOT NULL DEFAULT '0',
  `ID_Regolamento` int(11) NOT NULL DEFAULT '0',
  `Obbligatorio_Opzionale` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Matricola_Insegnamento`,`ID_Regolamento`),
  KEY `ID_Regolamento` (`ID_Regolamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Formato`
--

LOCK TABLES `Formato` WRITE;
/*!40000 ALTER TABLE `Formato` DISABLE KEYS */;
INSERT INTO `Formato` VALUES (1,138,0),(4,138,0),(3,138,0),(5,138,0),(6,138,0),(7,138,0),(10,138,0),(8,139,0),(9,139,0),(11,139,0),(12,139,0),(30,139,0),(31,139,0),(37,139,0),(33,139,0),(15,139,1),(13,140,0),(39,140,0),(38,140,0),(34,140,0),(14,140,1);
/*!40000 ALTER TABLE `Formato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Insegnamento`
--

DROP TABLE IF EXISTS `Insegnamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Insegnamento` (
  `Matricola_Insegnamento` int(11) NOT NULL AUTO_INCREMENT,
  `Denominazione` varchar(50) NOT NULL,
  `Tipologia_Attivita` varchar(40) NOT NULL,
  `Tipologia_Lezione` varchar(40) NOT NULL,
  `Corso` varchar(30) NOT NULL,
  `Modulo` int(11) NOT NULL,
  `SSD` varchar(10) NOT NULL,
  `CFU_Laboratorio` int(11) NOT NULL,
  `CFU_Frontali` int(11) NOT NULL,
  `Tot_Ore` int(11) NOT NULL,
  PRIMARY KEY (`Matricola_Insegnamento`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Insegnamento`
--

LOCK TABLES `Insegnamento` WRITE;
/*!40000 ALTER TABLE `Insegnamento` DISABLE KEYS */;
INSERT INTO `Insegnamento` VALUES (1,'ARCHITETTURA DEGLI ELABORATORI','Caratterizzante Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,10,80),(4,'ANALISI MATEMATICA','Base Mat','Frontale/Esercitazione + Laboratorio','Laurea',0,'MAT/05',2,7,76),(3,'MATEMATICA DISCRETA','Base Mat','Frontale/Esercitazione','Laurea',0,'MAT/02',0,9,72),(5,'PROGRAMMAZIONE I','Base Inf','Frontale/Esercitazione + Laboratorio','Laurea',1,'INF/01',2,4,52),(6,'PROGRAMMAZIONE I','Base Inf','Frontale/Esercitazione + Laboratorio','Laurea',2,'INF/01',2,4,52),(7,'METODI MATEMATICI PER LINFORMATICA','Base Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,6,48),(8,'INTRODUZIONE AGLI ALGORITMI E ALLE STRUTTURE DATI','Base Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,9,72),(9,'BASI DI DATI','Caratterizzante Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,9,72),(10,'SISTEMI OPERATIVI','Caratterizzante Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,10,80),(11,'RICERCA OPERATIVA','Affine','Frontale/Esercitazione','Laurea',0,'MAT/09',0,6,48),(12,'RETI DEI CALCOLATORI','Affine','Frontale/Esercitazione','Laurea',0,'INF/01',0,6,48),(13,'PROGRAMMAZIONE DISTRIBUITA','Caratterizzante Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,9,72),(14,'FISICA','Affine','Frontale/Esercitazione','Laurea',0,'INF/01',0,6,48),(15,'SICUREZZA','Affine','Frontale/Esercitazione','Laurea',0,'FIS/01',0,6,48),(16,'INTELLIGENZA COMPUTAZIONALE','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(17,'GESTIONE AVANZATA DEI DATI','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(18,'ALGORITMI AVANZATI I','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(19,'SISTEMI OPERATIVI AVANZATI','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(20,'ROBOTICA','Affine','Frontale/Esercitazione','Laurea Magistrale',0,'ING-INF/04',0,6,48),(21,'RETI SOCIALI','Affine','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,6,48),(22,'METODI DI OTTIMIZZAZIONE','Affine','Frontale/Esercitazione','Laurea Magistrale',0,'MAT/09',0,9,72),(23,'RETI WIRELESS','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(24,'AUTOMI LINGUAGGI E COMPLESSITÃ ','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(25,'WEB SEMANTICO','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,6,48),(26,'COMPILATORI','Affine','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,6,48),(27,'CYBERSECURITY','Caratterizzante Inf','Frontale/Esercitazione','Laurea Magistrale',0,'INF/01',0,9,72),(39,'ANALISI NUMERICA ','Affine','Frontale/Esercitazione + Laboratorio','Laurea',0,'MAT/08',2,4,52),(38,'INGEGNERIA DEL SOFTWARE','Caratterizzante Inf','Frontale/Esercitazione + Laboratorio','Laurea',0,'INF/01',3,6,78),(30,'CALCOLO DELLE PROBABILITÃ  E STATISTICA MATEMATICA','Affine','Frontale/Esercitazione','Laurea',0,'MAT/06',0,6,48),(31,'PROGETTAZIONE DI ALGORITMI ','Caratterizzante Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,6,48),(37,'PROGRAMMAZIONE II','Caratterizzante Inf','Frontale/Esercitazione + Laboratorio','Laurea',0,'INF/01',3,7,86),(33,'PROGRAMMAZIONE WEB ','Base Inf','Frontale/Esercitazione + Laboratorio','Laurea',0,'INF/01',3,6,78),(34,'ELEMENTI DI TEORIA DELLA COMPUTAZIONE ','Caratterizzante Inf','Frontale/Esercitazione','Laurea',0,'INF/01',0,9,72);
/*!40000 ALTER TABLE `Insegnamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ordinamento`
--

DROP TABLE IF EXISTS `Ordinamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ordinamento` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Anno_accademico` varchar(15) NOT NULL,
  `Corso` varchar(20) NOT NULL,
  `Attivita_formativa` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ordinamento`
--

LOCK TABLES `Ordinamento` WRITE;
/*!40000 ALTER TABLE `Ordinamento` DISABLE KEYS */;
INSERT INTO `Ordinamento` VALUES (0,'2015-2016','Laurea','di base'),(8,'2015-2016','Magistrale','Caratterizzanti'),(1,'2015-2016','Laurea','Caratterizzanti'),(2,'2015-2016','Laurea','Affini e integrative'),(3,'2015-2016','Laurea','A scelta dello studente'),(4,'2015-2016','Laurea','Lingua Inglese'),(5,'2015-2016','Laurea','Tirocinio'),(6,'2015-2016','Laurea','Prova finale'),(7,'2015-2016','Laurea','Ulteriori attivit&agrave formativa(art. 10, comma 5, lettera'),(9,'2015-2016','Magistrale','Affini'),(10,'2015-2016','Magistrale','A scelta dello studente'),(11,'2015-2016','Magistrale','Ulteriori attivit&agrave formative (art. 10, comm 5, lettera'),(12,'2015-2016','Magistrale','Prova finale'),(13,'2007-2008','Laurea','di base'),(14,'2007-2008','Laurea','Caratterizzanti'),(15,'2007-2008','Laurea','Affini e integrative'),(16,'2007-2008','Laurea','A scelta dello studente'),(17,'2007-2008','Laurea','Lingua Inglese'),(18,'2007-2008','Laurea','Tirocinio'),(19,'2007-2008','Laurea','Prova finale');
/*!40000 ALTER TABLE `Ordinamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Possiede`
--

DROP TABLE IF EXISTS `Possiede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Possiede` (
  `ID_Ordinamento` int(11) DEFAULT NULL,
  `ID_Suddivisione` int(11) DEFAULT NULL,
  KEY `ID_Ordinamento` (`ID_Ordinamento`),
  KEY `ID_Suddivisione` (`ID_Suddivisione`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Possiede`
--

LOCK TABLES `Possiede` WRITE;
/*!40000 ALTER TABLE `Possiede` DISABLE KEYS */;
INSERT INTO `Possiede` VALUES (0,0),(0,1),(1,2),(2,3),(4,5),(3,4),(5,6),(6,7),(7,8),(8,9),(9,10),(10,11),(11,12),(12,13),(13,14),(13,15),(14,16),(15,17),(16,18),(17,19),(18,20),(19,21);
/*!40000 ALTER TABLE `Possiede` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Programmazione_Didattica`
--

DROP TABLE IF EXISTS `Programmazione_Didattica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Programmazione_Didattica` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Anno_corso` int(11) DEFAULT NULL,
  `Corso` varchar(20) DEFAULT NULL,
  `Semestre` int(11) DEFAULT NULL,
  `Tot_OreLab` int(11) DEFAULT NULL,
  `Tot_OreTeoria` int(11) DEFAULT NULL,
  `Anno_Accademico` varchar(15) DEFAULT NULL,
  `Versione` int(11) DEFAULT NULL,
  `Stato` varchar(20) NOT NULL,
  `ID_Regolamento` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Programmazione_Didattica`
--

LOCK TABLES `Programmazione_Didattica` WRITE;
/*!40000 ALTER TABLE `Programmazione_Didattica` DISABLE KEYS */;
INSERT INTO `Programmazione_Didattica` VALUES (8,2,'Laurea',2,0,0,'2020-2021',1,'Da Approvare',139),(7,2,'Laurea',1,0,0,'2020-2021',1,'Da Approvare',139);
/*!40000 ALTER TABLE `Programmazione_Didattica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Regolamento`
--

DROP TABLE IF EXISTS `Regolamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Regolamento` (
  `Corso` varchar(10) DEFAULT NULL,
  `Anno_accademico` varchar(11) DEFAULT NULL,
  `Nome_Curriculum` varchar(50) DEFAULT NULL,
  `CFUOpzionali` int(11) DEFAULT NULL,
  `Anno_Corso` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stato` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Regolamento`
--

LOCK TABLES `Regolamento` WRITE;
/*!40000 ALTER TABLE `Regolamento` DISABLE KEYS */;
INSERT INTO `Regolamento` VALUES ('Laurea','2020-2021','PROVA IGES',0,1,138,'Pubblicato'),('Laurea','2020-2021','PROVA IGES',6,2,139,'Pubblicato'),('Laurea','2020-2021','PROVA IGES',6,3,140,'Pubblicato');
/*!40000 ALTER TABLE `Regolamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Settore`
--

DROP TABLE IF EXISTS `Settore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Settore` (
  `SSD` varchar(20) NOT NULL,
  `Descrizione` varchar(70) NOT NULL,
  PRIMARY KEY (`SSD`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Settore`
--

LOCK TABLES `Settore` WRITE;
/*!40000 ALTER TABLE `Settore` DISABLE KEYS */;
INSERT INTO `Settore` VALUES ('FIS/01','Fisica sperimentale'),('FIS/02','Fisica teorica, modelli e metodi matematici'),('FIS/03','Fisica della materia'),('MAT/01','Logica matematica'),('MAT/02','Algebra'),('MAT/03','Geometria'),('MAT/04','Matematiche complementari'),('MAT/05','Analisi numerica'),('MAT/06','Probabilit&agrave e statistica matematica'),('MAT/07','Fisica matematica'),('MAT/08','Analisi numerica'),('MAT/09','Ricerca operativa'),('INF/01','Informatica'),('ING-INF/05','Sistemi delle elaborazione delle informazioni'),('ING-INF/03','Telecomunicazioni'),('ING-INF/04','Automatica'),('ING-INF/06','Bioingegneria elettronica e informatica'),('IUS/01','Diritto privato'),('IUS/20','Filosofia del diritto'),('SECS-P/08','Economia e gestione delle imprese'),('SECS-S/01','Statistica'),('Altre conoscenze','Altre conoscenze utili per per l\'inserimento nel mondo del lavoro'),('BIO/09','Fisiologia'),('BIO/11','Biologia molecolare'),('BIO/18','Genetica'),('M-FIL/02','Logica e filosofia della scienza'),('MED/03','Genetica medica'),('SECS-P/07','Economia aziendale');
/*!40000 ALTER TABLE `Settore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Suddivisione`
--

DROP TABLE IF EXISTS `Suddivisione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Suddivisione` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ambiti_disciplinari` varchar(60) NOT NULL,
  `CFU_min` varchar(10) NOT NULL,
  `CFU_max` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Suddivisione`
--

LOCK TABLES `Suddivisione` WRITE;
/*!40000 ALTER TABLE `Suddivisione` DISABLE KEYS */;
INSERT INTO `Suddivisione` VALUES (0,'Matematico-Fisico','18','30'),(1,'Informatica','21','36'),(2,'Informatica','72','85'),(3,'','24','36'),(4,'','12',''),(5,'','3',''),(6,'','5','6'),(7,'','3',''),(8,'','0','3'),(9,'Discipline Informatiche','48','63'),(10,'Attivita formative affini o integrative','24','36'),(11,'','12',''),(12,'','1',''),(13,'','20',''),(14,'Matematico-Fisico','30',''),(15,'Informatica','21',''),(16,'Informatica','75',''),(17,'','30',''),(18,'','12',''),(19,'','3',''),(20,'','6',''),(21,'','3','');
/*!40000 ALTER TABLE `Suddivisione` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-11 16:55:02
