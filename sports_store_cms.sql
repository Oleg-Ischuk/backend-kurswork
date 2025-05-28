-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 28 2025 р., 14:26
-- Версія сервера: 9.1.0
-- Версія PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `sports_store_cms`
--
CREATE DATABASE IF NOT EXISTS `sports_store_cms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `sports_store_cms`;

-- --------------------------------------------------------

--
-- Структура таблиці `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(2, 'Adidas'),
(7, 'Asics'),
(14, 'Brooks'),
(16, 'Champion'),
(9, 'Columbia'),
(18, 'Everlast'),
(15, 'Fila'),
(19, 'Kappa'),
(8, 'Mizuno'),
(6, 'New Balance'),
(1, 'Nike'),
(12, 'Patagonia'),
(3, 'Puma'),
(5, 'Reebok'),
(11, 'Salomon'),
(13, 'Skechers'),
(17, 'Speedo'),
(10, 'The North Face'),
(20, 'Umbro'),
(4, 'Under Armour');

-- --------------------------------------------------------

--
-- Структура таблиці `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Футбол', '2025-05-26 12:06:24'),
(2, 'Баскетбол', '2025-05-26 12:09:37'),
(3, 'Теніс', '2025-05-26 12:09:37'),
(4, 'Волейбол', '2025-05-26 12:09:37'),
(5, 'Плавання', '2025-05-26 12:09:37'),
(6, 'Легка атлетика', '2025-05-26 12:09:37'),
(7, 'Бокс', '2025-05-26 12:09:37'),
(8, 'Фітнес', '2025-05-26 12:09:37'),
(9, 'Велоспорт', '2025-05-26 12:09:37'),
(10, 'Хокей', '2025-05-26 12:09:37'),
(13, 'Настільний теніс', '2025-05-26 12:09:37'),
(16, 'Американський футбол', '2025-05-26 12:09:37'),
(17, 'Єдиноборства', '2025-05-26 12:09:37'),
(21, 'Взуття', '2025-05-28 08:10:07'),
(22, 'Одяг', '2025-05-28 08:11:49');

-- --------------------------------------------------------

--
-- Структура таблиці `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `discount` decimal(5,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `brand_id`, `discount`, `created_at`) VALUES
(3, 'Nike Mercurial Vapor', 'Легендарні бутси для швидкісного футболу з інноваційним верхом Vaporposite+. Текстурована поверхня забезпечує ідеальний контроль м&#039;яча на будь-якій швидкості. Революційна підошва Air Zoom Air забезпечує вибуховий старт та стрімкі прискорення. Анатомічна посадка повторює форму стопи для максимального комфорту. Спеціальні шипи для натурального газону забезпечують ідеальне зчеплення в будь-яких умовах.', 5000.00, 30, 1, 1, 30.00, '2025-05-26 14:19:04'),
(5, 'Кросівки Nike Air Max 270 чоловічі', 'Сучасні кросівки з інноваційною системою амортизації Air Max. Ідеальні для бігу та повсякденного носіння. М&#039;яка підошва забезпечує максимальний комфорт протягом усього дня.', 4500.00, 25, 21, 1, 15.00, '2025-05-28 08:11:07'),
(6, 'Футболка Nike Dri-FIT спортивна чоловіча', 'Спортивна футболка з технологією Dri-FIT, яка відводить волого та зберігає тіло сухим під час тренувань. Виготовлена з якісного поліестеру.', 1200.00, 50, 22, 1, 0.00, '2025-05-28 08:13:06'),
(7, 'Кросівки Adidas Ultraboost 22 для бігу', 'Революційні бігові кросівки з технологією Boost для максимального повернення енергії. Прекрасно підходять для марафонського бігу та щоденних тренувань.', 5200.00, 18, 21, 2, 12.00, '2025-05-28 08:14:49'),
(8, 'Футбольний м`яч Adidas UEFA Euro 2024 Official', 'Офіційний м&amp;amp;#039;яч чемпіонату Європи з інноваційною панельною структурою. Відмінні аеродинамічні властивості, ідеальна сферичність та довговічність.', 2200.00, 25, 1, 2, 10.00, '2025-05-28 08:16:23'),
(9, 'Футбольний м&#039;яч Nike Premier League Flight', 'Офіційний м`яч Англійської Прем`єр-ліги з технологією AerowSculpt для стабільного польоту. Яскравий дизайн та професійна якість.', 1950.00, 35, 1, 1, 23.00, '2025-05-28 08:36:29'),
(10, 'Шапочка для плавання Nike Pro Silicone Cap', 'Професійна силіконова шапочка для плавання від Nike. Ергономічний дизайн забезпечує ідеальну посадку та мінімальний опір води. Міцний силікон витримує регулярні тренування та хлоровану воду. Підходить як для басейну, так і для відкритої води. Легко одягається та знімається завдяки еластичному матеріалу.', 699.00, 15, 5, 1, 13.00, '2025-05-28 08:39:33');

-- --------------------------------------------------------

--
-- Структура таблиці `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `is_main` tinyint(1) DEFAULT '0',
  `image_url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `is_main`, `image_url`, `created_at`) VALUES
(2, 3, 1, 'uploads/products/68347858bfff0.jpg', '2025-05-26 14:19:04'),
(4, 5, 1, 'uploads/products/6836c51b9d866.jpg', '2025-05-28 08:11:07'),
(5, 6, 1, 'uploads/products/6836c5920718d.jpg', '2025-05-28 08:13:06'),
(6, 7, 1, 'uploads/products/6836c5f9466f4.jpg', '2025-05-28 08:14:49'),
(7, 8, 1, 'uploads/products/6836c657e5306.jpg', '2025-05-28 08:16:23'),
(8, 9, 1, 'uploads/products/6836cb0dc729c.jpg', '2025-05-28 08:36:29'),
(9, 10, 1, 'uploads/products/6836cbc558d4b.jpg', '2025-05-28 08:39:33');

-- --------------------------------------------------------

--
-- Структура таблиці `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ;

--
-- Дамп даних таблиці `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(3, 2, 3, 5, 'Чудові бутси Nike', '2025-05-28 08:45:32');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Олег', 'Іщук', 'olegischuk594@gmail.com', '$2y$10$SjW4/rcd7DbbARgMSm39qOIPXENrRFaXyCe5.v884E8MWaDBURvMi', 'admin', '2025-05-26 11:22:23'),
(3, 'Олександр', 'Іщук', 'sasha2005@gmail.com', '$2y$10$98ApvStlnG9g9Cyjk1xHXOFePYFp0aTmbmjjy.l5NjCnqrxd4XMum', 'user', '2025-05-26 12:55:30');

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
