-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.40 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table online_store.brand: ~3 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
	(1, 'Nike'),
	(2, 'Moose'),
	(3, 'Adidas'),
	(4, 'CP');

-- Dumping data for table online_store.category: ~4 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
	(1, 'Tshirts'),
	(2, 'Jeens'),
	(3, 'Denims'),
	(4, 'Skirt'),
	(5, 'Skinny');

-- Dumping data for table online_store.color: ~4 rows (approximately)
INSERT INTO `color` (`color_id`, `color_name`) VALUES
	(1, 'Black'),
	(2, 'White'),
	(3, 'Blue'),
	(4, 'Red'),
	(5, 'Pink');

-- Dumping data for table online_store.product: ~10 rows (approximately)
INSERT INTO `product` (`product_id`, `product_name`, `description`, `img`, `color_id`, `cat_id`, `size_id`, `brand_id`, `status_id`) VALUES
	(1, 'Black shirt', 'Black shirt', '/Online-Store/assets/images/product/69446951ab0a4images.jpg', 1, 1, 3, 2, 1),
	(2, 'Black shirt', 'Black shirt', 'assets/images/product/6944698b26f1bimages.jpg', 1, 1, 3, 2, 2),
	(3, 'Black shirt', 'Black shirt', 'assets/images/product/694469fe5b6fcimages.jpg', 1, 1, 3, 2, 1),
	(4, 'Black shirt', 'Black shirt', 'assets/images/product/69446a38c0502images.jpg', 1, 1, 3, 2, 1),
	(5, 'Black shirt', 'Black shirt', 'assets/images/product/69446ab0f0e8fimages.jpg', 1, 1, 3, 2, 1),
	(6, 'Black shirt', 'Black Shirt', '../../assets/images/product/69446c0024d01images.jpg', 1, 1, 3, 2, 1),
	(7, 'Black shirt', 'CK Black Shirt', '../../assets/images/product/69446d0b0bde9images (1).jpg', 1, 2, 3, 4, 2),
	(8, 'new shirt', 'new desc', '../../assets/images/product/694dd286400a0images.jpg', 2, 2, 3, 1, 1),
	(9, 'new shirt', 'new shirt', '../../assets/images/product/6952d6296972467d6e4f0bfdec047143d3dd8-nike-mens-short-sleeve-logo-swoosh.jpg', 2, 1, 5, 1, 2),
	(10, 'Moose Denim XL RED', 'new denim', '../../assets/images/product/6952d732dccd4images (2).jpg', 4, 3, 5, 2, 1);

-- Dumping data for table online_store.size: ~6 rows (approximately)
INSERT INTO `size` (`size_id`, `size_name`) VALUES
	(1, 'XS'),
	(2, 'S'),
	(3, 'M'),
	(4, 'L'),
	(5, 'XL'),
	(6, 'XXL'),
	(7, 'XXXL');

-- Dumping data for table online_store.status: ~2 rows (approximately)
INSERT INTO `status` (`id`, `status`) VALUES
	(1, 'active'),
	(2, 'inactive');

-- Dumping data for table online_store.stock: ~2 rows (approximately)
INSERT INTO `stock` (`stock_id`, `price`, `qty`, `status_id`, `product_id`) VALUES
	(1, 250.5, '150', 1, 7),
	(2, 275.25, '152', 1, 1);

-- Dumping data for table online_store.users: ~13 rows (approximately)
INSERT INTO `users` (`id`, `fname`, `lname`, `mobile`, `email`, `password`, `user_type_id`, `v_code`, `status_id`) VALUES
	(1, 'fname', 'lname', '0777777771', 'email@gmail.com', '00001', 2, NULL, 1),
	(2, 'fname0', 'lname0', '0777777777', 'r5rx5600ma@gmail.com', '00003', 1, NULL, 1),
	(3, 'fname1', 'lname1', '0781234567', 'email1@gmail.com', '00001', 2, NULL, 1),
	(4, 'fname2', 'lname2', '0781111111', 'email2@gmail.com', '00003', 2, NULL, 1),
	(5, 'fname3', 'lname3', '0780000000', 'email3@gmail.com', '00004', 2, NULL, 1),
	(6, 'fname4', 'lname4', '0711111111', 'email4@gmail.com', '00004', 2, NULL, 2),
	(7, 'fname5', 'lname5', '0781111111', 'email5@gmail.com', '00005', 2, NULL, 1),
	(8, 'fname6', 'lname6', '0781111111', 'email6@gmail.com', '00006', 2, NULL, 2),
	(9, 'fname7', 'lname7', '0718965412', 'email7@gmail.com', '00007', 2, NULL, 1),
	(10, 'fname8', 'lname8', '0781546321', 'email8@gmail.com', '00008', 2, NULL, 2),
	(11, 'fname9', 'lname9', '0789654123', 'email9@gmail.com', '00009', 2, NULL, 1),
	(12, 'fname10', 'lname10', '0781595159', 'email10@gmail.com', '000010', 2, NULL, 2),
	(13, 'fname11', 'lname11', '0786541238', 'email11@gmail.com', '000011', 2, NULL, 1);

-- Dumping data for table online_store.user_type: ~2 rows (approximately)
INSERT INTO `user_type` (`id`, `name`) VALUES
	(1, 'Admin'),
	(2, 'User');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
