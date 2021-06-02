-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table pdfcreator.artikal
CREATE TABLE IF NOT EXISTS `artikal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idArtikla` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cijena` float NOT NULL DEFAULT '0',
  `opis` varchar(250) COLLATE utf8_unicode_ci DEFAULT '0',
  `firmaId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_artikal_firma` (`firmaId`),
  KEY `FK_artikal_user` (`userId`),
  CONSTRAINT `FK_artikal_firma` FOREIGN KEY (`firmaId`) REFERENCES `firma` (`id`),
  CONSTRAINT `FK_artikal_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.artikal: ~2 rows (approximately)
/*!40000 ALTER TABLE `artikal` DISABLE KEYS */;
/*!40000 ALTER TABLE `artikal` ENABLE KEYS */;

-- Dumping structure for table pdfcreator.artiklifakture
CREATE TABLE IF NOT EXISTS `artiklifakture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cijena` float NOT NULL DEFAULT '0',
  `kolicina` float NOT NULL DEFAULT '0',
  `rabat` int(11) NOT NULL,
  `bezPdv` float NOT NULL DEFAULT '0',
  `pdv` float NOT NULL DEFAULT '0',
  `ukupno` float NOT NULL DEFAULT '0',
  `fakturaId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__faktura` (`fakturaId`),
  CONSTRAINT `FK__faktura` FOREIGN KEY (`fakturaId`) REFERENCES `faktura` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.artiklifakture: ~5 rows (approximately)
/*!40000 ALTER TABLE `artiklifakture` DISABLE KEYS */;
/*!40000 ALTER TABLE `artiklifakture` ENABLE KEYS */;

-- Dumping structure for table pdfcreator.faktura
CREATE TABLE IF NOT EXISTS `faktura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firmaId` int(11) NOT NULL DEFAULT '0',
  `broj` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mjesto` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `tip` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `kupacId` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `datum` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `nacin` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `rok` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `fakturista` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `fiskalni` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_faktura_user` (`userId`),
  CONSTRAINT `FK_faktura_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.faktura: ~2 rows (approximately)
/*!40000 ALTER TABLE `faktura` DISABLE KEYS */;
/*!40000 ALTER TABLE `faktura` ENABLE KEYS */;

-- Dumping structure for table pdfcreator.firma
CREATE TABLE IF NOT EXISTS `firma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `jib` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `logo` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pdv` set('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pib` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vlasnik` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mjesto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `racun` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `banka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_firma_user` (`userId`),
  CONSTRAINT `FK_firma_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.firma: ~3 rows (approximately)
/*!40000 ALTER TABLE `firma` DISABLE KEYS */;
/*!40000 ALTER TABLE `firma` ENABLE KEYS */;

-- Dumping structure for table pdfcreator.fiskalniracun
CREATE TABLE IF NOT EXISTS `fiskalniracun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `broj` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `datum` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `slika` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `firmaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_fiskalniRacun_user` (`userId`),
  KEY `FK_fiskalniracun_firma` (`firmaId`),
  CONSTRAINT `FK_fiskalniRacun_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_fiskalniracun_firma` FOREIGN KEY (`firmaId`) REFERENCES `firma` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.fiskalniracun: ~7 rows (approximately)
/*!40000 ALTER TABLE `fiskalniracun` DISABLE KEYS */;
/*!40000 ALTER TABLE `fiskalniracun` ENABLE KEYS */;

-- Dumping structure for table pdfcreator.klijent
CREATE TABLE IF NOT EXISTS `klijent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `jib` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `logo` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pdv` set('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pib` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `vlasnik` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `adresa` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mjesto` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `telefon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `racun` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `banka` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__user` (`userId`),
  CONSTRAINT `FK__user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.klijent: ~1 rows (approximately)
/*!40000 ALTER TABLE `klijent` DISABLE KEYS */;
/*!40000 ALTER TABLE `klijent` ENABLE KEYS */;

-- Dumping structure for table pdfcreator.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pdfcreator.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
	(1, 'stefan miletic', 'ml@gm.com', '$2y$10$TW5o/5tCc6ceKDfbzgjr8ed14kXXR.kpsw/A7bkhyS.BnN9jBxaEO');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
