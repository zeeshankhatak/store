-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2022 at 05:00 PM
-- Server version: 5.7.36
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area_name`, `title_Author`, `country_id`) VALUES
(2, 'Abu Dhabi', NULL, 1),
(5, 'Washington DC', NULL, 3),
(8, 'New York', NULL, 3),
(9, 'Dubai', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_English` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`ID`, `title_English`, `title_Author`) VALUES
(1, 'English', 'Xyz'),
(3, 'sasasasasasasa', 'xzxzxzsasasa'),
(4, 'ASASAS', 'ASASAS');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `author`) VALUES
(2, 'Drama', 'Admin'),
(3, 'Fiction', 'Moderator'),
(4, 'Action', 'Jon Doe');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_English` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  `country_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compulsary_choice`
--

DROP TABLE IF EXISTS `compulsary_choice`;
CREATE TABLE IF NOT EXISTS `compulsary_choice` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_English` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  `country_Flag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `title_Author`, `country_Flag`) VALUES
(1, 'United Arab Emirates', NULL, NULL),
(3, 'United States of America', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inner_in_sub_category`
--

DROP TABLE IF EXISTS `inner_in_sub_category`;
CREATE TABLE IF NOT EXISTS `inner_in_sub_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_English` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_ID` int(11) DEFAULT NULL,
  `compulsory_Choice_ID` int(11) DEFAULT NULL,
  `multi_Choice_ID` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) DEFAULT NULL,
  `store_ID` int(11) NOT NULL,
  `suggested_Items` int(11) DEFAULT NULL,
  `title_English` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  `desc_English` varchar(255) DEFAULT NULL,
  `desc_Author` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `new_Price` double DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `stock` int(100) NOT NULL,
  `status` int(11) NOT NULL,
  `arrival_Range` varchar(255) DEFAULT NULL,
  `hero_Image` varchar(255) DEFAULT NULL,
  `share_in_Development` int(11) DEFAULT NULL,
  `in_Stock` int(11) DEFAULT NULL,
  `hot_Price` double DEFAULT NULL,
  PRIMARY KEY (`item_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choice`
--

DROP TABLE IF EXISTS `multiple_choice`;
CREATE TABLE IF NOT EXISTS `multiple_choice` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_English` varchar(255) DEFAULT NULL,
  `title_Author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpy_txt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rightclick` tinyint(1) NOT NULL DEFAULT '1',
  `inspect` tinyint(1) NOT NULL DEFAULT '1',
  `meta_data_desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_data_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_ana` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_pixel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_login_enable` tinyint(1) DEFAULT NULL,
  `google_login_enable` tinyint(1) DEFAULT NULL,
  `gitlab_login_enable` tinyint(1) DEFAULT NULL,
  `stripe_enable` tinyint(1) DEFAULT NULL,
  `instamojo_enable` tinyint(1) DEFAULT NULL,
  `paypal_enable` tinyint(1) DEFAULT NULL,
  `paytm_enable` tinyint(1) DEFAULT NULL,
  `braintree_enable` tinyint(1) DEFAULT NULL,
  `razorpay_enable` tinyint(1) DEFAULT NULL,
  `paystack_enable` tinyint(1) DEFAULT NULL,
  `w_email_enable` tinyint(1) DEFAULT NULL,
  `verify_enable` tinyint(1) NOT NULL DEFAULT '0',
  `wel_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_address` text COLLATE utf8mb4_unicode_ci,
  `default_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_enable` tinyint(1) DEFAULT NULL,
  `debug_enable` tinyint(1) NOT NULL DEFAULT '1',
  `cat_enable` int(11) NOT NULL DEFAULT '0',
  `feature_amount` int(11) DEFAULT NULL,
  `preloader_enable` tinyint(1) DEFAULT '1',
  `zoom_enable` int(11) DEFAULT '0',
  `amazon_enable` tinyint(1) DEFAULT '0',
  `captcha_enable` tinyint(1) DEFAULT '0',
  `bbl_enable` tinyint(1) NOT NULL DEFAULT '0',
  `map_lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `project_title`, `logo`, `favicon`, `cpy_txt`, `logo_type`, `rightclick`, `inspect`, `meta_data_desc`, `meta_data_keyword`, `google_ana`, `fb_pixel`, `fb_login_enable`, `google_login_enable`, `gitlab_login_enable`, `stripe_enable`, `instamojo_enable`, `paypal_enable`, `paytm_enable`, `braintree_enable`, `razorpay_enable`, `paystack_enable`, `w_email_enable`, `verify_enable`, `wel_email`, `default_address`, `default_phone`, `instructor_enable`, `debug_enable`, `cat_enable`, `feature_amount`, `preloader_enable`, `zoom_enable`, `amazon_enable`, `captcha_enable`, `bbl_enable`, `map_lat`, `map_long`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test.jpg', 'test.jpg', 'test', 'test', 1, 1, 'test', 'test', 'test', 'test', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'test', 'test', 'test', 1, 1, 0, 1, 1, 0, 0, 0, 0, 'test', 'test', '2021-11-19 15:41:53', '2021-11-19 15:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `store_Sub_Category` int(11) NOT NULL,
  `store_Area` int(11) NOT NULL,
  `follow_System` int(11) NOT NULL,
  `title_English` varchar(255) NOT NULL,
  `title_Author` varchar(255) NOT NULL,
  `store_Location_Title_English` varchar(255) NOT NULL,
  `store_Location_Title_Author` varchar(255) NOT NULL,
  `phone_Number` varchar(255) NOT NULL,
  `store_Map_Location` varchar(255) NOT NULL,
  `store_Image` varchar(255) NOT NULL,
  `store_Cover_Image` varchar(255) NOT NULL,
  `google_Maps_links` varchar(255) NOT NULL,
  `store_Delivery_Area` varchar(255) NOT NULL,
  `Delivery_Time_Range` varchar(255) NOT NULL,
  `store_Slogan_English` varchar(255) NOT NULL,
  `store_Slogan_Author` varchar(255) NOT NULL,
  `subscription_Plan` varchar(255) NOT NULL,
  `active_Or_No` varchar(255) NOT NULL,
  `allowed_To_Add_Hot_Price` int(11) NOT NULL,
  `items_Number` int(11) NOT NULL,
  `payment_Gateway` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `attribute_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `title`, `author`, `image`, `attribute_ID`) VALUES
(8, '4', 'Gun Fight', 'John Wick', '1647429161.jpg', NULL),
(9, '2', 'Love', 'William Shakespere', '1647429205.jpg', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
