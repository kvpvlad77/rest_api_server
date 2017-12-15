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
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `urlphoto` text COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы blog.users: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `username`, `email`, `birthday`, `urlphoto`, `password_hash`, `auth_key`, `created_at`, `updated_at`, `flags`) VALUES
	(1, 'galier', 'galier@mail.ru', '0000-00-00', '', '$2y$10$0lzvwqHGpd1ZK0sld9QqDOTMkDBBGTk7vq3rm8qiszhv3vNoa5vvS', 'Gw5nCCnbFxMuXo6aY_kfO85zjBuUYUHi', 1493021443, 1493021443, 0),
	(2, 'kasvit77', 'kasvit77@yandex.ru', '0000-00-00', '', '$2y$10$iMPSB1Xp76geMxa81qPJAOcUk8nykJM2OkXBx1QqCjzrSEQR0EVQi', '463e4eca7e819aa8ca9', 1493648266, 1493653411, 0),
	(24, 'vitun', 'test@mm.ru', '0000-00-00', '', '', '', 0, 0, 0),
	(26, 'vitun', 'test1@mm.ru', '0000-00-00', '', '', '', 0, 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
