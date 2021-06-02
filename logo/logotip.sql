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

-- Dumping structure for table logotip.calculator
CREATE TABLE IF NOT EXISTS `calculator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calculatorName` varchar(150) NOT NULL DEFAULT '0',
  `estimateText` text NOT NULL,
  `heading` varchar(250) NOT NULL,
  `calculatorText` text NOT NULL,
  `button` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `backgroundColor` varchar(50) NOT NULL DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `optionStatus` set('0','1') NOT NULL DEFAULT '0',
  `archived` set('0','1') NOT NULL DEFAULT '0',
  `defaultCalculators` set('0','1') NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table logotip.calculator: ~6 rows (approximately)
/*!40000 ALTER TABLE `calculator` DISABLE KEYS */;
INSERT INTO `calculator` (`id`, `calculatorName`, `estimateText`, `heading`, `calculatorText`, `button`, `logo`, `currency`, `backgroundColor`, `color`, `date`, `optionStatus`, `archived`, `defaultCalculators`, `user_id`) VALUES
	(1, 'default_calculator', '', 'How MUCH DOES A LOGO COST', 'Have you ever wondered how much it would cost to make a logo? This handy logo &amp; branding cost calculator is just for you.', 'Get started', '', 'BAM', 'f4f6f9', '212529', '2020-12-27 22:03:34', '0', '0', '1', 1);
/*!40000 ALTER TABLE `calculator` ENABLE KEYS */;

-- Dumping structure for table logotip.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `optionName` varchar(150) NOT NULL DEFAULT '0',
  `optionPrice` varchar(150) NOT NULL DEFAULT '0',
  `optionImage` varchar(250) NOT NULL DEFAULT '0',
  `optionStatus` set('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `step_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `step` (`step_id`),
  CONSTRAINT `step` FOREIGN KEY (`step_id`) REFERENCES `step` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Dumping data for table logotip.options: ~25 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `optionName`, `optionPrice`, `optionImage`, `optionStatus`, `date`, `step_id`) VALUES
	(1, 'Symbol or icon', '50', 'default.png', '1', '2020-12-17 14:35:27', 1),
	(2, 'Wordmark', '30', 'default.png', '1', '2020-12-17 14:35:33', 1),
	(3, 'Both', '70', 'default.png', '1', '2020-12-17 14:35:37', 1),
	(4, 'Flat-Simplified', '50', 'default.png', '1', '2020-12-17 14:35:40', 2),
	(5, '3D', '90', 'default.png', '1', '2020-12-17 14:35:47', 2),
	(6, 'Costum letterforms', '60', 'default.png', '1', '2020-12-17 14:35:49', 2),
	(7, 'Yes', '20', 'default.png', '1', '2020-12-17 14:35:50', 3),
	(8, 'No', '80', 'default.png', '1', '2020-12-17 14:35:51', 3),
	(9, 'Yes', '60', 'default.png', '1', '2020-12-17 14:35:53', 4),
	(10, 'No', '0', 'default.png', '1', '2020-12-17 14:35:54', 4),
	(11, 'Business card', '50', 'default.png', '1', '2020-12-17 14:35:55', 5),
	(12, 'Stickers', '50', 'default.png', '1', '2020-12-17 14:35:57', 5),
	(13, 'Both', '100', 'default.png', '0', '2020-12-17 14:35:58', 5),
	(14, 'No', '0', 'default.png', '1', '2020-12-17 14:35:59', 5);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Dumping structure for table logotip.step
CREATE TABLE IF NOT EXISTS `step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stepName` varchar(150) NOT NULL DEFAULT '0',
  `stepStatus` set('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `calculator_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `calculator` (`calculator_id`),
  CONSTRAINT `calculator` FOREIGN KEY (`calculator_id`) REFERENCES `calculator` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table logotip.step: ~9 rows (approximately)
/*!40000 ALTER TABLE `step` DISABLE KEYS */;
INSERT INTO `step` (`id`, `stepName`, `stepStatus`, `date`, `calculator_id`) VALUES
	(1, 'What type of logo are you looking for?', '1', '2020-12-14 15:11:13', 1),
	(2, 'What styles are you looking for?', '1', '2020-12-14 15:11:13', 1),
	(3, 'Do you have a color scheme for your company?', '1', '2020-12-14 15:11:13', 1),
	(4, 'Do you need a brand icon?', '1', '2020-12-14 15:11:13', 1),
	(5, 'Would you like additional assets created with your logo?', '1', '2020-12-14 15:11:13', 1);
/*!40000 ALTER TABLE `step` ENABLE KEYS */;

-- Dumping structure for table logotip.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(150) NOT NULL DEFAULT '0',
  `userEmail` varchar(150) NOT NULL DEFAULT '0',
  `userPassword` varchar(150) NOT NULL DEFAULT '0',
  `userStatus` set('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table logotip.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `fullName`, `userEmail`, `userPassword`, `userStatus`, `date`) VALUES
	(1, 'Mladen', 'mldnmldn@gmail.com', '$2y$10$0tOQHnMSruR83zPjSjhZXeqkPvuosSDe6xMK7ANP.wTmcopYox2gG', '0', '2020-12-27 18:57:44');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
