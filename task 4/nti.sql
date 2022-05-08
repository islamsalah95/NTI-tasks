-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 11:52 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street` varchar(50) NOT NULL,
  `building` varchar(50) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `falt` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_region` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` smallint(6) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` smallint(11) NOT NULL,
  `national_d` smallint(14) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1>active',
  `email_verified_at` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `id_offer` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1>active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_en`, `name_ar`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'appel', 'ابل', 1, NULL, '2022-03-26 16:20:56', '2022-03-26 16:20:56'),
(2, 'samsung', 'سامسونج', 1, NULL, '2022-03-26 16:20:56', '2022-03-26 16:20:56'),
(3, 'lenovo', 'لينوفو', 1, NULL, '2022-03-26 16:21:19', '2022-03-26 17:10:26'),
(4, 'dell', 'ديل', 1, NULL, '2022-03-26 17:11:11', '2022-03-26 17:11:11'),
(5, 'oppo', 'اوبو', 1, NULL, '2022-03-26 17:11:11', '2022-03-26 17:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1>active',
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_ar`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'electronics', 'الكترونيات', 1, NULL, '2022-03-26 16:32:22', '2022-03-26 16:32:22'),
(2, 'fashon', 'فاشون', 1, NULL, '2022-03-26 16:32:22', '2022-03-26 16:32:22'),
(3, 'kitchen', 'مطبخ', 1, NULL, '2022-03-26 16:32:22', '2022-03-26 16:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(250) NOT NULL,
  `name_ar` int(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1>delivered\r\n0>default not delivered',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` smallint(5) NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `discount` decimal(10,0) NOT NULL,
  `discountType` decimal(10,0) NOT NULL,
  `minimum_order_value` smallint(6) NOT NULL,
  `maximum_discount_value` smallint(6) NOT NULL,
  `usage_per_user` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `title_ar` varchar(50) NOT NULL,
  `desc_en` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `count` bigint(20) NOT NULL,
  `discount` smallint(6) NOT NULL,
  `discountType` decimal(10,0) NOT NULL,
  `offered_itiems` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1>active',
  `total_price` decimal(10,0) NOT NULL,
  `shipping_price` decimal(10,0) NOT NULL,
  `deliverd_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `total_price`, `shipping_price`, `deliverd_at`, `created_at`, `updated_at`) VALUES
(0, 1, '10000', '10000', '2022-03-27 21:36:28', '2022-03-27 21:36:28', '2022-03-27 21:36:28'),
(2, 1, '20000', '20000', '2022-03-27 21:37:44', '2022-03-27 21:37:44', '2022-03-27 21:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `desc_en` longtext NOT NULL,
  `desc_ar` longtext NOT NULL,
  `code` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1> default active',
  `id_subcategorie` bigint(20) UNSIGNED NOT NULL,
  `id_brand` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_en`, `name_ar`, `quantity`, `price`, `desc_en`, `desc_ar`, `code`, `image`, `status`, `id_subcategorie`, `id_brand`, `created_at`, `updated_at`) VALUES
(5, 'laptop', 'لبتوب', 1, '250', 'loran ', 'لبتوبلبتوب', '12345', 'laptop.jpg', 1, 1, 4, '2022-03-26 17:08:43', '2022-03-26 17:08:43'),
(6, 'a50', 'موبيل', 1, '4000', 'mobile', 'موبيلموبيلموبيل', '321244', 'a50.jpg', 1, 2, 2, '2022-03-26 17:08:43', '2022-03-26 17:08:43'),
(7, 'tv', 'تلفزيون', 1, '10000', 'tvtvtv', 'تلفزيونتلفزيون', '321241', 'tv55.jpg', 1, 3, 3, '2022-03-26 17:08:43', '2022-03-26 17:08:43'),
(8, 'mackbook', 'لب', 1, '15000', 'mackbookmackbook', 'لب', '5254', 'mac.jpg', 1, 1, 1, '2022-03-26 17:08:43', '2022-03-26 17:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `products_offers`
--

CREATE TABLE `products_offers` (
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `id_offer` bigint(20) UNSIGNED NOT NULL,
  `price_after_discount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id_brand` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id_brand`, `id_order`, `price`, `quantity`) VALUES
(1, 0, '25000', 3),
(4, 2, '50000', 9);

-- --------------------------------------------------------

--
-- Table structure for table `product_spac`
--

CREATE TABLE `product_spac` (
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `id_specs` bigint(20) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(250) NOT NULL,
  `name_ar` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'o not deliver default',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_citie` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rate` int(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `Update_dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rate`, `comment`, `Update_dt`, `created_at`, `id_user`, `id_product`) VALUES
(5, 'vnn', '2022-03-28 01:18:36', '2022-03-28 01:18:36', 41, 5),
(7, 'gfgfgfgf', '2022-03-28 01:18:53', '2022-03-28 01:18:53', 41, 7),
(10, 'fgfgfgfggfgg', '2022-03-28 01:19:21', '2022-03-28 01:19:21', 41, 8);

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_ar` varchar(10) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_categories` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name_en`, `name_ar`, `status`, `image`, `created_at`, `updated_at`, `id_categories`) VALUES
(1, 'laptops', 'لاب توبات', 1, NULL, '2022-03-26 16:38:01', '2022-03-26 17:24:33', 1),
(2, 'mobils', 'موبيلات', 1, NULL, '2022-03-26 16:38:01', '2022-03-26 17:24:37', 1),
(3, 'tvs', 'تلفزيواتن', 1, NULL, '2022-03-26 16:38:01', '2022-03-26 17:24:40', 1),
(4, 'dishes', 'اطباق', 1, NULL, '2022-03-26 16:41:09', '2022-03-26 16:41:09', 3),
(5, 'teshirts', 'تى شيرت', 1, NULL, '2022-03-26 16:41:09', '2022-03-26 17:24:46', 2);

-- --------------------------------------------------------
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_userid_fk` (`id_user`),
  ADD KEY `region_regionid_fk` (`id_region`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_prod_fk` (`id_product`),
  ADD KEY `offer_produc_fk` (`id_offer`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `users_user_id_fk` (`user_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`id_product`,`id_user`),
  ADD KEY `users_id_user_fk` (`id_user`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `products_sub_fk` (`id_subcategorie`),
  ADD KEY `regiogionid_fk` (`id_brand`);

--
-- Indexes for table `products_offers`
--
ALTER TABLE `products_offers`
  ADD PRIMARY KEY (`id_product`,`id_offer`),
  ADD KEY `offers_products_offer_fk` (`id_offer`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id_brand`,`id_order`),
  ADD KEY `offeoduc_fk` (`id_order`);

--
-- Indexes for table `product_spac`
--
ALTER TABLE `product_spac`
  ADD PRIMARY KEY (`id_product`,`id_specs`),
  ADD KEY `spaces_id_spaces_fk` (`id_specs`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_citieid_fk` (`id_citie`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `users_iduser_fk` (`id_user`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_sub_fk` (`id_categories`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `region_regionid_fk` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_userid_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `ad_prod_fk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `offer_produc_fk` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id`);

--
-- Constraints for table `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `products_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `products_id_product_fk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `users_id_user_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_sub_fk` FOREIGN KEY (`id_subcategorie`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `regiogionid_fk` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`);

--
-- Constraints for table `products_offers`
--
ALTER TABLE `products_offers`
  ADD CONSTRAINT `offers_products_offer_fk` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `product_products_offer_fk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `offeoduc_fk` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `productproduct_fk` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`);

--
-- Constraints for table `product_spac`
--
ALTER TABLE `product_spac`
  ADD CONSTRAINT `products__id_product_fk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `spaces_id_spaces_fk` FOREIGN KEY (`id_specs`) REFERENCES `specs` (`id`);

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `cities_citieid_fk` FOREIGN KEY (`id_citie`) REFERENCES `cities` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `product_productid_fk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `users_iduser_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `cat_sub_fk` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
