-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.21-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица blog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `urlphoto` text COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы blog.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `username`, `email`, `first_name`, `last_name`, `birthday`, `urlphoto`, `password_hash`, `secret_key`, `created_at`, `updated_at`, `flags`) VALUES
	(2, 'kasvit77', 'kasvit77@yandex.ru', '', '', '0000-00-00', '', '$2y$10$iMPSB1Xp76geMxa81qPJAOcUk8nykJM2OkXBx1QqCjzrSEQR0EVQi', '463e4eca7e819aa8ca9', 1493648266, 1493653411, 0),
	(290, 'yarikkasggg', 'yarik5yy5@mail.ru', 'Yarikshh', '', '2017-12-17', '', '', '563e4eca7e819aa8ca9', 2017, 0, 0),
	(293, 'rttetertt', 'yarirtettry5@mail.ru', '', '', '2017-12-17', '', '', '543e4eca7e819aa8ca3', 2017, 0, 0),
	(296, 'Kasianov', 'reerer@eer.ru', 'dsfsdsffs', '', '2017-12-17', '', '', '', 2017, 0, 0),
	(298, 'vitalik', 'yandex@fgg.ru', 'Виталик', '', '2017-12-17', '', '$2y$10$Jg73uGEDpVSnvYogbPUI1um65JFAkMR82pj5NT.1FM0pvlE10tpdS', '463e4eca7e419aa8ca9', 2017, 0, 0),
	(301, 'viktor', 'kvpvlad77@gmail.ru', 'Виталик', '', '0000-00-00', '', '$2y$10$RgHV1UDCXJ/XkDRsF20R2.4O7nK6fh8RUQZAxgJWVF/yF86//WrwG', NULL, 2017, 0, 0),
	(303, 'Вася', 'yarik3333@mail.ru', 'Василий', '', '23/12/1977', '', '$2y$10$ivf3/acM0KggfjHIf1qG8usNGVxauI26WhgFxl8n/DcWILekuEPia', NULL, 2017, 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
