-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for iuran
CREATE DATABASE IF NOT EXISTS `iuran` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `iuran`;

-- Dumping structure for table iuran.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` int(11) DEFAULT NULL,
  `pembayaran_ke` varchar(100) DEFAULT NULL,
  `tgl_pembayaran` varchar(50) DEFAULT NULL,
  `jumlah_pembayaran` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table iuran.pembayaran: ~2 rows (approximately)
DELETE FROM `pembayaran`;
INSERT INTO `pembayaran` (`id`, `nama_sekolah`, `pembayaran_ke`, `tgl_pembayaran`, `jumlah_pembayaran`, `user`) VALUES
	(1, 1, 'Januari, Februari, Maret', '2025-07-30', 150000, 1),
	(2, 2, 'April, Mei', '2025-07-30', 100000, 1);

-- Dumping structure for table iuran.sekolah
CREATE TABLE IF NOT EXISTS `sekolah` (
  `id_sekolah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table iuran.sekolah: ~2 rows (approximately)
DELETE FROM `sekolah`;
INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `alamat`) VALUES
	(1, 'SDN Binuang 1', 'Binuang'),
	(2, 'SDN Binuang 2', 'Binuang'),
	(3, 'SDN Binuang 3', 'Binuang');

-- Dumping structure for table iuran.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table iuran.users: ~0 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `nama`) VALUES
	(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Siti Patimah, S.Pd');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
