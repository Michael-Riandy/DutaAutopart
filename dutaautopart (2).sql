-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2025 at 07:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dutaautopart`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Emgi', 'emgi', '2025-07-03 05:45:49', '2025-07-03 05:45:49'),
(2, 'CKPM', 'ckpm', '2025-07-03 05:46:02', '2025-07-03 05:46:13'),
(3, 'Asli', 'asli', '2025-07-03 05:46:35', '2025-07-03 05:46:35'),
(4, 'Indospring', 'indospring', '2025-07-03 05:47:15', '2025-07-03 05:47:15'),
(5, 'NHF', 'nhf', '2025-07-07 02:48:48', '2025-07-07 02:48:48'),
(6, 'DMAC', 'dmac', '2025-07-07 05:49:56', '2025-07-07 05:49:56'),
(7, 'Asahimas', 'asahimas', '2025-07-07 05:54:33', '2025-07-07 05:54:33'),
(8, 'Mulia', 'mulia', '2025-07-07 05:54:41', '2025-07-07 05:54:41'),
(9, 'AGP', 'agp', '2025-07-07 06:08:32', '2025-07-07 06:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bumper Depan', 'bumper-depan', '2025-07-03 05:47:30', '2025-07-03 05:47:30'),
(2, 'Kaca Depan', 'kaca-depan', '2025-07-03 05:47:43', '2025-07-03 05:47:43'),
(3, 'Headlamp', 'headlamp', '2025-07-03 05:48:14', '2025-07-03 05:48:27'),
(4, 'Stoplamp', 'stoplamp', '2025-07-03 05:48:59', '2025-07-03 05:48:59'),
(5, 'Spion', 'spion', '2025-07-03 05:49:36', '2025-07-03 05:49:36'),
(6, 'Sensor ABS', 'sensor-abs', '2025-07-03 05:50:08', '2025-07-03 05:50:08'),
(7, 'Grill Radiator', 'grill-radiator', '2025-07-07 02:57:23', '2025-07-07 02:57:23'),
(8, 'Reflektor Bagasi', 'reflektor-bagasi', '2025-07-07 02:58:14', '2025-07-07 02:58:14'),
(9, 'Kaca Pintu Depan', 'kaca-pintu-depan', '2025-07-07 02:59:11', '2025-07-07 02:59:11'),
(10, 'Kap Mesin', 'kap-mesin', '2025-07-07 02:59:46', '2025-07-07 02:59:46'),
(11, 'Fender', 'fender', '2025-07-07 03:00:32', '2025-07-07 03:00:32'),
(12, 'Kaki Spion', 'kaki-spion', '2025-07-07 03:01:30', '2025-07-07 03:01:30'),
(13, 'Cover Spion', 'cover-spion', '2025-07-07 03:02:14', '2025-07-07 03:02:14'),
(14, 'Ball Joint', 'ball-joint', '2025-07-07 03:02:54', '2025-07-07 03:02:54'),
(15, 'Filter Udara', 'filter-udara', '2025-07-07 03:03:29', '2025-07-07 03:03:29'),
(16, 'Filter Oli', 'filter-oli', '2025-07-07 03:03:56', '2025-07-07 03:03:56'),
(17, 'Dinamo Kipas', 'dinamo-kipas', '2025-07-07 03:05:13', '2025-07-07 03:05:13'),
(18, 'Bushing Sayap', 'bushing-sayap', '2025-07-07 03:05:42', '2025-07-07 03:05:42'),
(19, 'Kampas Rem Belakang', 'kampas-rem-belakang', '2025-07-07 03:06:07', '2025-07-07 03:06:07'),
(20, 'Paken Tutup Klep', 'paken-tutup-klep', '2025-07-07 03:06:36', '2025-07-07 03:06:36'),
(21, 'Switch Power Window', 'switch-power-window', '2025-07-07 03:07:10', '2025-07-07 03:07:10'),
(22, 'Piston Kaliper', 'piston-kaliper', '2025-07-07 03:08:10', '2025-07-07 03:08:10'),
(23, 'Tabung Rem', 'tabung-rem', '2025-07-07 03:08:48', '2025-07-07 03:08:48'),
(24, 'Liner Fender', 'liner-fender', '2025-07-07 03:09:30', '2025-07-07 03:09:30'),
(25, 'Karet D', 'karet-d', '2025-07-07 03:10:12', '2025-07-07 03:10:12'),
(26, 'Tangki Air Wiper', 'tangki-air-wiper', '2025-07-07 03:10:48', '2025-07-07 03:10:48'),
(27, 'Piring Cakram', 'piring-cakram', '2025-07-07 03:11:23', '2025-07-07 03:11:23'),
(28, 'Cover Foglamp', 'cover-foglamp', '2025-07-07 06:35:08', '2025-07-07 06:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecommerces`
--

CREATE TABLE `ecommerces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2025_05_03_123937_create_statuses_table', 1),
(229, '2014_10_12_000000_create_users_table', 2),
(230, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(231, '2014_10_12_100000_create_password_resets_table', 2),
(232, '2019_08_19_000000_create_failed_jobs_table', 2),
(233, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(234, '2025_03_15_031947_add_role_to_users_table', 2),
(235, '2025_03_15_043850_add_role_to_users_table', 2),
(236, '2025_04_16_172211_create_dashboards_table', 2),
(237, '2025_04_17_055307_create_ecommerces_table', 2),
(238, '2025_04_22_071157_create_admins_table', 2),
(239, '2025_04_23_033233_create_accounts_table', 2),
(240, '2025_04_27_141704_create_suppliers_table', 2),
(241, '2025_04_27_141715_create_categories_table', 2),
(242, '2025_04_27_141731_create_brands_table', 2),
(243, '2025_05_03_124006_create_user_addresses_table', 2),
(244, '2025_05_03_141648_create_products_table', 2),
(245, '2025_05_03_141813_create_product_prices_table', 2),
(246, '2025_05_03_141826_create_carts_table', 2),
(247, '2025_05_03_141827_create_orders_table', 2),
(248, '2025_05_03_141828_create_deliveries_table', 2),
(249, '2025_05_03_141828_create_order_details_table', 2),
(250, '2025_05_10_144539_create_transactions_table', 2),
(251, '2025_05_12_100951_create_slides_table', 2),
(252, '2025_05_12_151600_create_month_names_table', 2),
(253, '2025_05_12_163826_create_contacts_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `month_names`
--

CREATE TABLE `month_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `subtotal` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `status` enum('ordered','delivered','canceled') NOT NULL DEFAULT 'ordered',
  `delivered_date` date DEFAULT NULL,
  `canceled_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `total`, `name`, `phone`, `address`, `city`, `status`, `delivered_date`, `canceled_date`, `created_at`, `updated_at`) VALUES
(1, 2, '750,000.00', '750,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-03', '2025-07-03 06:58:37', '2025-07-03 07:09:40'),
(2, 2, '1,500,000.00', '1,500,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-03', '2025-07-03 07:39:25', '2025-07-03 08:36:38'),
(3, 2, '1,905,000.00', '1,905,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-03 07:43:19', '2025-07-07 02:24:48'),
(4, 2, '1,585,000.00', '1,585,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-06 00:45:48', '2025-07-07 02:26:00'),
(5, 2, '635,000.00', '635,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-06 00:47:01', '2025-07-07 02:28:13'),
(6, 2, '635,000.00', '635,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-06 00:55:15', '2025-07-07 02:21:03'),
(7, 2, '8,890,000.00', '8,890,000.00', 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-06 00:58:23', '2025-07-07 02:31:00'),
(8, 3, '975,000.00', '975,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 07:04:22', '2025-07-07 07:04:22'),
(9, 3, '975,000.00', '975,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-07 07:08:12', '2025-07-07 07:17:33'),
(10, 3, '975,000.00', '975,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 07:08:37', '2025-07-07 07:08:37'),
(11, 3, '450,000.00', '450,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'delivered', '2025-07-07', NULL, '2025-07-07 07:10:51', '2025-07-07 08:36:40'),
(12, 3, '90,000.00', '90,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'canceled', NULL, '2025-07-07', '2025-07-07 07:13:09', '2025-07-07 07:26:33'),
(13, 3, '635,000.00', '635,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 07:17:07', '2025-07-07 07:17:07'),
(14, 3, '1,500,000.00', '1,500,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 07:27:39', '2025-07-07 07:27:39'),
(15, 3, '2,285,000.00', '2,285,000.00', 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 07:29:20', '2025-07-07 07:29:20'),
(16, 4, '1,100,000.00', '1,100,000.00', 'Testing', '0812345678900', 'Jl Adisucipto', 'Pontianak', 'delivered', '2025-07-07', NULL, '2025-07-07 08:48:21', '2025-07-07 08:52:11'),
(17, 4, '325,000.00', '325,000.00', 'Testing', '0812345678900', 'Jl Adisucipto', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 08:50:43', '2025-07-07 08:50:43'),
(18, 4, '3,320,000.00', '3,320,000.00', 'Testing', '0812345678900', 'Jl Adisucipto', 'Pontianak', 'ordered', NULL, NULL, '2025-07-07 09:26:58', '2025-07-07 09:26:58'),
(19, 4, '450,000.00', '450,000.00', 'Testing', '0812345678900', 'Jl Adisucipto', 'Pontianak', 'delivered', '2025-07-07', NULL, '2025-07-07 09:28:10', '2025-07-07 09:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 750000, 1, '2025-07-03 06:58:37', '2025-07-03 06:58:37'),
(2, 2, 2, 750000, 2, '2025-07-03 07:39:25', '2025-07-03 07:39:25'),
(3, 3, 5, 635000, 3, '2025-07-03 07:43:19', '2025-07-03 07:43:19'),
(4, 4, 5, 635000, 1, '2025-07-06 00:45:48', '2025-07-06 00:45:48'),
(5, 4, 4, 950000, 1, '2025-07-06 00:45:48', '2025-07-06 00:45:48'),
(6, 5, 5, 635000, 1, '2025-07-06 00:47:02', '2025-07-06 00:47:02'),
(7, 6, 5, 635000, 1, '2025-07-06 00:55:15', '2025-07-06 00:55:15'),
(8, 7, 5, 635000, 14, '2025-07-06 00:58:23', '2025-07-06 00:58:23'),
(9, 8, 36, 475000, 1, '2025-07-07 07:04:22', '2025-07-07 07:04:22'),
(10, 8, 37, 500000, 1, '2025-07-07 07:04:22', '2025-07-07 07:04:22'),
(11, 9, 36, 475000, 1, '2025-07-07 07:08:12', '2025-07-07 07:08:12'),
(12, 9, 37, 500000, 1, '2025-07-07 07:08:12', '2025-07-07 07:08:12'),
(13, 10, 36, 475000, 1, '2025-07-07 07:08:37', '2025-07-07 07:08:37'),
(14, 10, 37, 500000, 1, '2025-07-07 07:08:37', '2025-07-07 07:08:37'),
(15, 11, 38, 450000, 1, '2025-07-07 07:10:51', '2025-07-07 07:10:51'),
(16, 12, 28, 90000, 1, '2025-07-07 07:13:09', '2025-07-07 07:13:09'),
(17, 13, 5, 635000, 1, '2025-07-07 07:17:07', '2025-07-07 07:17:07'),
(18, 14, 37, 500000, 3, '2025-07-07 07:27:39', '2025-07-07 07:27:39'),
(19, 15, 32, 485000, 1, '2025-07-07 07:29:20', '2025-07-07 07:29:20'),
(20, 15, 38, 450000, 4, '2025-07-07 07:29:20', '2025-07-07 07:29:20'),
(21, 16, 11, 550000, 2, '2025-07-07 08:48:21', '2025-07-07 08:48:21'),
(22, 17, 39, 325000, 1, '2025-07-07 08:50:43', '2025-07-07 08:50:43'),
(23, 18, 34, 830000, 4, '2025-07-07 09:26:58', '2025-07-07 09:26:58'),
(24, 19, 38, 450000, 1, '2025-07-07 09:28:10', '2025-07-07 09:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` double DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `quantity`, `image`, `category_id`, `brand_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'Bumper Depan All New Avanza 2012', 'bumper-depan-all-new-avanza-2012', '-', 400000, 20, '1751901634.jpg', 1, 1, 1, '2025-07-03 05:53:24', '2025-07-07 08:20:34'),
(2, 'Bumper Depan Innova 2013 Barong', 'bumper-depan-innova-2013-barong', '-', 750000, 23, '1751547316.jpg', 1, 1, 1, '2025-07-03 05:55:16', '2025-07-03 08:36:38'),
(4, 'Bumper Depan Triton 2019 Type G', 'bumper-depan-triton-2019-type-g', '-', 950000, 20, '1751547543.jpg', 1, 1, 1, '2025-07-03 05:59:03', '2025-07-07 02:26:00'),
(5, 'Spion Assy Calya Manual Model Electric LH', 'spion-assy-calya-manual-model-electric-lh', '-', 635000, 47, '1751547609.jpg', 5, 2, 1, '2025-07-03 06:00:09', '2025-07-07 07:17:07'),
(6, 'Bumper Depan Hilux 2008 Single Cabin', 'bumper-depan-hilux-2008-single-cabin', 'Bumper depan Hilux 2008 SC dirancang khusus untuk model single cabin, memberikan perlindungan maksimal pada bagian depan kendaraan. Terbuat dari material kokoh, tahan benturan, dan cocok untuk penggunaan harian maupun medan berat. Desain presisi memastikan pemasangan mudah dan tampilan tetap gagah.', 850000, 50, '1751881346.jpg', 1, 1, 1, '2025-07-07 02:42:26', '2025-07-07 02:42:26'),
(7, 'Bumper Depan Reborn Venturer Facelift', 'bumper-depan-reborn-venturer-facelift', 'Bumper depan Reborn Venturer memiliki desain elegan dan sporty, dilengkapi dengan lekukan aerodinamis yang khas. Terbuat dari bahan berkualitas tinggi, bumper ini memberikan perlindungan optimal serta memperkuat tampilan premium mobil. Cocok sebagai pengganti atau peningkatan estetika kendaraan.', 1200000, 50, '1751881511.jpg', 1, 1, 1, '2025-07-07 02:45:11', '2025-07-07 02:45:11'),
(8, 'Bumper Depan Kijang Tahun 2000', 'bumper-depan-kijang-tahun-2000', 'Bumper depan Kijang 2000 didesain sederhana namun fungsional, sesuai dengan karakter kendaraan keluarga yang tangguh dan praktis. Terbuat dari bahan plastik berkualitas dengan struktur kokoh, bumper ini memberikan perlindungan terhadap benturan ringan di bagian depan. Desainnya pas dengan kontur bodi Kijang generasi tersebut, mudah dipasang, dan tersedia dalam varian polos maupun dengan dudukan lampu kabut. Bumper ini cocok untuk penggantian unit lama yang rusak atau untuk menjaga tampilan mobil tetap rapi dan original.', 800000, 50, '1751881826.jpg', 1, 5, 3, '2025-07-07 02:50:26', '2025-07-07 02:50:26'),
(9, 'Bumper Depan Kijang Tahun 2002', 'bumper-depan-kijang-tahun-2002', 'Bumper depan Kijang 2002 memiliki desain yang lebih modern dibanding versi sebelumnya, dengan lekukan halus yang mengikuti bentuk bodi kendaraan. Terbuat dari bahan plastik ABS berkualitas, bumper ini dirancang untuk memberikan perlindungan optimal terhadap benturan ringan di bagian depan mobil. Cocok untuk varian Kijang LGX, SX, atau LX, bumper ini dapat dilengkapi dengan dudukan lampu kabut dan grille bawah. Pemasangannya mudah dan presisi mengikuti dudukan asli pabrik, menjadikannya pilihan ideal untuk pengganti bumper lama atau memperbarui tampilan mobil agar tetap rapi dan fungsional.', 850000, 50, '1751881923.jpg', 1, 5, 3, '2025-07-07 02:52:03', '2025-07-07 02:52:03'),
(10, 'Bumper Depan Grand New Avanza 2015', 'bumper-depan-grand-new-avanza-2015', 'Bumper depan Avanza 2015 dirancang dengan tampilan modern dan aerodinamis, sesuai dengan desain facelift generasi kedua. Terbuat dari bahan plastik ABS yang kuat dan ringan, bumper ini memberikan perlindungan terhadap benturan ringan serta menambah kesan stylish pada kendaraan. Dilengkapi dengan slot untuk fog lamp dan grille bawah, bumper ini cocok untuk tipe G maupun E. Pemasangan mudah karena mengikuti standar dudukan OEM, ideal sebagai pengganti bumper lama atau untuk memperbaiki tampilan depan mobil agar kembali seperti baru.', 500000, 50, '1751882055.jpg', 1, 1, 1, '2025-07-07 02:54:15', '2025-07-07 02:54:15'),
(11, 'Bumper Depan Calya 2016', 'bumper-depan-calya-2016', 'Bumper depan Calya 2016 memiliki desain kompak dan dinamis yang sesuai dengan karakter city car modern. Dibuat dari material plastik ABS berkualitas tinggi, bumper ini ringan namun tahan terhadap benturan ringan. Dilengkapi dengan dudukan untuk fog lamp dan grille bawah, cocok untuk semua varian Calya. Desainnya mengikuti lekuk bodi asli sehingga pemasangan presisi dan tidak memerlukan modifikasi tambahan. Cocok sebagai pengganti bumper rusak atau untuk memperbarui tampilan kendaraan agar tetap rapi dan elegan.', 550000, 48, '1751882185.jpg', 1, 1, 1, '2025-07-07 02:56:25', '2025-07-07 08:48:21'),
(12, 'Grill Radiator Innova DX 2013 Chrome', 'grill-radiator-innova-dx-2013-chrome', 'Grill radiator Innova 2013 memiliki desain elegan dengan sentuhan krom atau hitam doff (tergantung varian), yang memberikan kesan gagah pada tampilan depan mobil. Komponen ini berfungsi sebagai pelindung radiator dari kerikil atau debu, sekaligus sebagai elemen estetika. Terbuat dari bahan plastik ABS berkualitas yang tahan cuaca dan benturan ringan, grill ini kompatibel untuk tipe G, V, maupun Luxury. Pemasangannya presisi dan dapat langsung dipasang tanpa perlu modifikasi tambahan. Cocok untuk pengganti unit rusak atau upgrade tampilan mobil agar tetap stylish dan fungsional.', 750000, 50, '1751892041.jpg', 7, 5, 3, '2025-07-07 05:40:41', '2025-07-07 05:40:41'),
(13, 'Headlamp Avanza Non VVTi 2004 RH', 'headlamp-avanza-non-vvti-2004-rh', 'Headlamp Avanza non VVT-i 2004 merek DMAC merupakan lampu utama pengganti aftermarket dengan kualitas setara OEM. Dirancang khusus untuk Avanza generasi pertama (tahun 2003–2006), lampu ini memiliki reflektor halogen standar dengan pencahayaan yang terang dan fokus. Terbuat dari bahan mika bening tahan panas serta housing plastik kuat yang tahan terhadap cuaca ekstrem. Headlamp DMAC ini mendukung sistem soket bawaan, sehingga pemasangan mudah tanpa perlu modifikasi. Cocok digunakan sebagai pengganti headlamp bawaan yang rusak, buram, atau retak.', 400000, 20, '1751892685.jpg', 3, 6, 2, '2025-07-07 05:51:25', '2025-07-07 05:51:25'),
(14, 'FDR Avanza All New 2011-2014 RH', 'fdr-avanza-all-new-2011-2014-rh', 'Kaca pintu depan kanan All New Avanza tahun 2012 merek Asahimas adalah kaca pengganti berkualitas OEM yang dirancang khusus untuk Toyota Avanza generasi kedua (All New Avanza 2011–2015). Produk ini diproduksi oleh Asahimas, salah satu produsen kaca otomotif terpercaya di Indonesia.', 185000, 10, '1751892849.jpg', 9, 3, 11, '2025-07-07 05:54:09', '2025-07-07 05:54:09'),
(15, 'Stoplamp Hilux Kun25 2012 LH', 'stoplamp-hilux-kun25-2012-lh', 'Stoplamp Hilux 2012 adalah lampu belakang yang berfungsi sebagai penanda pengereman, lampu belakang, dan lampu sein pada Toyota Hilux tahun 2012, baik varian single cabin maupun double cabin. Lampu ini memiliki desain khas Hilux generasi ke-7 dengan kombinasi reflektor merah dan bening, serta posisi lampu yang terintegrasi dalam satu unit.', 350000, 24, '1751893055.jpg', 4, 2, 1, '2025-07-07 05:57:35', '2025-07-07 05:57:35'),
(16, 'Reflektor Bagasi Agya 2013 LH', 'reflektor-bagasi-agya-2013-lh', 'Reflektor bagasi Agya 2013 adalah komponen tambahan pada bagian belakang bumper atau pintu bagasi Toyota Agya generasi pertama (tahun 2013–2017). Reflektor ini tidak menyala, tetapi berfungsi memantulkan cahaya dari kendaraan lain, terutama saat malam hari, sehingga meningkatkan visibilitas dan keselamatan.', 80000, 6, '1751893186.jpg', 8, 6, 2, '2025-07-07 05:59:46', '2025-07-07 05:59:46'),
(17, 'Spion Triton Old 2005-2014 RH', 'spion-triton-old-2005-2014-rh', 'Spion Mitsubishi Triton 2005–2014 adalah kaca spion samping (side mirror) yang dirancang khusus untuk model Triton generasi pertama hingga awal generasi kedua. Spion ini berfungsi sebagai alat bantu visibilitas ke belakang samping kendaraan, penting untuk manuver dan keselamatan saat berkendara.', 625000, 10, '1751893324.jpg', 5, 2, 1, '2025-07-07 06:02:04', '2025-07-07 06:02:04'),
(18, 'FH Isuzu D-MAX 2 2003', 'fh-isuzu-d-max-2-2003', 'Kaca depan Isuzu D-Max II tahun 2003 merek Asahimas merupakan kaca windshield pengganti berkualitas tinggi yang dirancang khusus untuk generasi awal D-Max (Double Cabin) yang dipasarkan di Indonesia pada tahun 2003–2006. Kaca ini dibuat oleh Asahimas, produsen kaca otomotif ternama dengan standar OEM.', 1700000, 5, '1751893443.jpg', 2, 7, 11, '2025-07-07 06:04:03', '2025-07-07 06:04:03'),
(19, 'Kap Mesin Innova 2011-2014', 'kap-mesin-innova-2011-2014', 'Kap mesin Innova 2011 merek AGP adalah panel penutup ruang mesin yang dirancang khusus untuk Toyota Innova generasi pertama (produksi 2008–2011 facelift). Produk ini merupakan aftermarket replacement dengan kualitas setara OEM, cocok sebagai pengganti kap mesin bawaan yang penyok, berkarat, atau rusak.', 1100000, 3, '1751893559.jpg', 10, 5, 6, '2025-07-07 06:05:59', '2025-07-07 06:05:59'),
(20, 'Fender Innova 2011 LH', 'fender-innova-2011-lh', 'Fender Innova 2011 merek AGP adalah panel bodi samping depan yang dipasang di atas roda depan kiri atau kanan Toyota Innova generasi pertama (2008–2011 facelift). Komponen ini berfungsi melindungi roda, ruang mesin, dan komponen suspensi dari cipratan air, debu, serta batu kerikil, sekaligus menjadi bagian estetika eksterior kendaraan.', 525000, 5, '1751893703.jpg', 11, 5, 6, '2025-07-07 06:08:23', '2025-07-07 06:08:23'),
(21, 'Fender Innova 2011 RH', 'fender-innova-2011-rh', 'Fender Innova 2011 merek AGP adalah panel bodi samping depan yang dipasang di atas roda depan kiri atau kanan Toyota Innova generasi pertama (2008–2011 facelift). Komponen ini berfungsi melindungi roda, ruang mesin, dan komponen suspensi dari cipratan air, debu, serta batu kerikil, sekaligus menjadi bagian estetika eksterior kendaraan.', 525000, 5, '1751893759.jpg', 11, 9, 6, '2025-07-07 06:09:19', '2025-07-07 06:09:19'),
(22, 'Sensor Abs Belakang Revo LH 89546-0K240', 'sensor-abs-belakang-revo-lh-89546-0k240', 'Sensor ABS untuk Toyota Hilux Revo berfungsi untuk mendeteksi kecepatan putaran roda dan mengirimkan data ke modul ABS, agar sistem pengereman tetap optimal dan mencegah roda terkunci saat pengereman mendadak.', 275000, 10, '1751894061.jpg', 6, 3, 6, '2025-07-07 06:14:21', '2025-07-07 06:14:21'),
(23, 'Fender Avanza 2015 LH', 'fender-avanza-2015-lh', 'Fender Avanza 2015 adalah panel bodi samping depan yang terletak di atas roda depan kanan atau kiri, berfungsi untuk melindungi komponen suspensi serta menambah estetika kendaraan. Model ini digunakan pada Toyota Grand New Avanza generasi kedua facelift (tahun produksi 2015–2018).', 450000, 5, '1751894345.jpg', 11, 9, 6, '2025-07-07 06:19:05', '2025-07-07 06:19:05'),
(24, 'Grill Radiator Rocco 2021', 'grill-radiator-rocco-2021', 'Grill radiator Toyota Hilux Rocco 2021 adalah komponen depan yang menjadi ciri khas varian tertinggi dari Hilux Revo facelift generasi ke-8 (tahun 2020–2022). Grill ini memiliki desain lebih agresif dan sporty dibanding varian standar, cocok untuk pengguna yang ingin tampilan off-road atau premium look.', 1500000, 3, '1751894496.jpg', 7, 2, 1, '2025-07-07 06:21:36', '2025-07-07 06:21:36'),
(25, 'FH Hilux Revo / Fortuner 2016', 'fh-hilux-revo-fortuner-2016', 'Kaca depan Hilux Revo merek Asahimas adalah windshield replacement berkualitas tinggi yang dirancang khusus untuk Toyota Hilux Revo (tahun produksi 2015 hingga sekarang, termasuk varian G, E, dan Rocco). Produk ini diproduksi oleh Asahimas Flat Glass, produsen kaca otomotif terkemuka di Indonesia yang memasok kaca OEM untuk banyak pabrikan mobil.', 925000, 10, '1751894583.jpg', 2, 7, 11, '2025-07-07 06:23:03', '2025-07-07 06:23:03'),
(26, 'FH Mitsubishi Xpander 2018', 'fh-mitsubishi-xpander-2018', 'Kaca depan Mitsubishi Xpander adalah komponen kaca utama bagian depan (windshield) yang dirancang untuk memberikan visibilitas maksimal sekaligus perlindungan terhadap angin, air, dan benturan ringan. Komponen ini tersedia dalam versi OEM maupun aftermarket', 1300000, 5, '1751894696.jpg', 2, 8, 10, '2025-07-07 06:24:56', '2025-07-07 06:24:56'),
(27, 'Kaki Spion Innova 2005-2014 LH', 'kaki-spion-innova-2005-2014-lh', 'Kaki spion Innova adalah dudukan atau penyangga yang menghubungkan kaca spion dengan bodi pintu kendaraan. Komponen ini umumnya terbuat dari bahan plastik ABS yang kuat atau logam berlapis, tergantung tipe dan tahun produksi mobil. Fungsinya tidak hanya menopang spion agar tetap kokoh, tetapi juga meredam getaran saat berkendara sehingga visibilitas tetap jelas. Pada beberapa tipe, kaki spion juga dilengkapi mekanisme elektrik seperti motor lipat (retractable) atau pengatur kaca otomatis. Untuk Toyota Innova, kaki spion tersedia dalam berbagai model sesuai generasi, seperti Innova 2004–2015 dan Innova Reborn 2016 ke atas.', 90000, 20, '1751894916.jpg', 12, 2, 1, '2025-07-07 06:28:36', '2025-07-07 06:28:36'),
(28, 'Kaki Spion Hilux 2005-2014 LH', 'kaki-spion-hilux-2005-2014-lh', 'Kaki spion Hilux Old adalah komponen penyangga spion samping yang digunakan pada Toyota Hilux generasi lama, seperti Hilux Tiger, Hilux LN (tahun 1990-an hingga awal 2000-an). Komponen ini berfungsi untuk menopang spion dan menghubungkannya dengan bodi pintu kendaraan, biasanya dipasang menggunakan baut dari bagian dalam pintu.', 90000, 20, '1751894980.jpg', 12, 2, 1, '2025-07-07 06:29:40', '2025-07-07 07:26:33'),
(29, 'Kaki Spion Avanza 2019 LH', 'kaki-spion-avanza-2019-lh', 'Kaki spion Avanza 2019 adalah komponen dudukan atau penyangga spion samping yang menghubungkan kaca spion dengan bodi pintu depan. Pada Toyota Avanza 2019 (Grand New Avanza facelift), kaki spion menyatu dengan housing spion dan biasanya memiliki sistem elektrik tergantung pada tipe mobil (E, G, atau Veloz).', 90000, 20, '1751895044.jpg', 12, 2, 1, '2025-07-07 06:30:44', '2025-07-07 06:30:44'),
(31, 'Kaki Spion Innova 2005-2014 RH', 'kaki-spion-innova-2005-2014-rh', 'Kaki spion Innova adalah dudukan atau penyangga yang menghubungkan kaca spion dengan bodi pintu kendaraan. Komponen ini umumnya terbuat dari bahan plastik ABS yang kuat atau logam berlapis, tergantung tipe dan tahun produksi mobil. Fungsinya tidak hanya menopang spion agar tetap kokoh, tetapi juga meredam getaran saat berkendara sehingga visibilitas tetap jelas. Pada beberapa tipe, kaki spion juga dilengkapi mekanisme elektrik seperti motor lipat (retractable) atau pengatur kaca otomatis. Untuk Toyota Innova, kaki spion tersedia dalam berbagai model sesuai generasi, seperti Innova 2004–2015 dan Innova Reborn 2016 ke atas.', 90000, 20, '1751895150.jpg', 12, 2, 1, '2025-07-07 06:32:30', '2025-07-07 06:32:30'),
(32, 'Stoplamp APV Arena RH', 'stoplamp-apv-arena-rh', 'Stoplamp Suzuki APV Arena adalah lampu belakang utama yang berfungsi sebagai penanda pengereman, lampu malam, sein, dan lampu mundur pada mobil Suzuki APV Arena (tahun produksi 2007 hingga sekarang). Komponen ini dirancang untuk memberikan visibilitas maksimal kepada pengendara di belakang, sehingga meningkatkan keselamatan berkendara, terutama saat malam atau cuaca buruk.', 485000, 1, '1751895207.jpg', 4, 6, 2, '2025-07-07 06:33:27', '2025-07-07 07:29:20'),
(33, 'Cover Foglamp Innova DX 2013', 'cover-foglamp-innova-dx-2013', 'Cover foglamp Innova 2013 adalah penutup atau frame plastik yang mengelilingi lampu kabut (foglamp) pada bagian bumper depan Toyota Innova generasi pertama facelift (2012–2015). Komponen ini berfungsi sebagai pelindung sekaligus pemanis estetika bumper, serta membantu mengarahkan cahaya lampu kabut agar tidak menyilaukan.', 80000, 20, '1751895400.jpg', 28, 2, 1, '2025-07-07 06:36:40', '2025-07-07 06:36:40'),
(34, 'Stoplamp Triton 2019 LED Kotak RH', 'stoplamp-triton-2019-led-kotak-rh', 'Stoplamp Triton 2019 LED kotak adalah lampu belakang dengan desain modern berbentuk kotak yang digunakan pada Mitsubishi Triton generasi kelima facelift (tahun 2019 ke atas). Varian ini umumnya tersedia pada Triton Exceed, Ultimate, atau varian yang sudah menggunakan lampu full LED sebagai standar.', 830000, 36, '1751895485.jpg', 4, 1, 1, '2025-07-07 06:38:05', '2025-07-07 09:26:58'),
(35, 'Grill Radiator Innova Old 2005 Gading', 'grill-radiator-innova-old-2005-gading', 'Grill radiator Innova 2005 warna gading merupakan komponen eksterior depan yang berfungsi sebagai pelindung radiator sekaligus penambah estetika pada Toyota Innova generasi pertama (2004–2008). Warna gading—yang menyerupai krem terang atau putih tulang—biasanya digunakan untuk menyesuaikan dengan warna bodi mobil tertentu, terutama untuk varian Innova dengan cat serupa atau untuk modifikasi.', 500000, 5, '1751895592.jpg', 7, 9, 6, '2025-07-07 06:39:52', '2025-07-07 06:39:52'),
(36, 'Stoplamp Avanza 2019 RH', 'stoplamp-avanza-2019-rh', 'Stoplamp Avanza 2019 merupakan lampu belakang untuk Toyota Grand New Avanza facelift yang dirilis tahun 2019. Komponen ini memiliki desain vertikal dengan nuansa modern, mengikuti perubahan pada desain eksterior facelift generasi kedua.', 475000, 8, '1751895686.jpg', 4, 6, 2, '2025-07-07 06:41:26', '2025-07-07 07:17:33'),
(37, 'Grill Radiator Hilux 2005', 'grill-radiator-hilux-2005', 'Grill radiator Hilux 2005 adalah komponen depan yang terletak di antara kedua lampu utama dan berfungsi melindungi radiator sekaligus menambah tampilan estetika Toyota Hilux generasi awal Vigo / Kun26 yang diproduksi mulai tahun 2004–2008.', 500000, 0, '1751895818.jpg', 7, 5, 6, '2025-07-07 06:43:38', '2025-07-07 07:27:39'),
(38, 'Stoplamp Hilux Revo 2015 RH', 'stoplamp-hilux-revo-2015-rh', 'Stoplamp Hilux Revo adalah lampu belakang yang digunakan pada Toyota Hilux generasi ke-8, dikenal sebagai Hilux Revo, yang diluncurkan mulai tahun 2015 hingga sekarang. Komponen ini berfungsi sebagai lampu rem, lampu kota, lampu sein, dan lampu mundur, serta menjadi elemen penting untuk visibilitas dan keselamatan saat berkendara.', 450000, 26, '1751895886.jpg', 4, 2, 1, '2025-07-07 06:44:46', '2025-07-07 09:28:10'),
(39, 'Sensor Abs Depan Revo RH 89542-0K050', 'sensor-abs-depan-revo-rh-89542-0k050', 'Sensor ABS depan Toyota Hilux Revo adalah komponen penting dalam sistem Anti-lock Braking System (ABS) yang berfungsi mendeteksi kecepatan rotasi roda depan. Sensor ini mengirimkan data ke ECU ABS untuk mencegah penguncian roda saat pengereman mendadak, sehingga menjaga stabilitas dan kontrol kendaraan.', 325000, 9, '1751896052.jpg', 6, 3, 6, '2025-07-07 06:47:32', '2025-07-07 08:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `tagline` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `tagline`, `title`, `subtitle`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Design', 'Duta Autopart', 'Menyediakan Produk Berkualitas', 'http://localhost:8000/shop', '1751547686.jpg', 1, '2025-07-03 06:01:26', '2025-07-03 06:01:26'),
(2, 'New Product', 'Reflektor', 'Reflektor Bagasi Agya', '#', '1751547842.jpg', 1, '2025-07-03 06:04:02', '2025-07-03 06:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone_number`, `address`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'PT Cipta Kreasi Prima Muda', '-', '-', 'pt-cipta-kreasi-prima-muda', '2025-07-03 05:50:29', '2025-07-03 05:50:29'),
(2, 'PT Duta Mandiri Anugerah Cemerlang', '--', '-', 'pt-duta-mandiri-anugerah-cemerlang', '2025-07-03 05:50:45', '2025-07-03 05:50:45'),
(3, 'PT NHF Auto Supplies Indonesia', '---', '-', 'pt-nhf-auto-supplies-indonesia', '2025-07-03 05:51:07', '2025-07-03 05:51:07'),
(4, 'CV. Duta Usaha Mandiri', '----', '-', 'cv-duta-usaha-mandiri', '2025-07-03 05:51:44', '2025-07-03 05:51:44'),
(5, 'General Motor', '-----', '-', 'general-motor', '2025-07-03 05:52:00', '2025-07-03 05:52:00'),
(6, 'HJ Jakarta', '08128246488', 'Jakarta', 'hj-jakarta', '2025-07-07 03:14:53', '2025-07-07 03:14:53'),
(7, 'Ichiban', '------', 'Jakarta', 'ichiban', '2025-07-07 03:16:07', '2025-07-07 03:16:07'),
(8, 'PT Duta Umindo Aditya', '081350472320', 'Jl. Adisucipto KM 4,2', 'pt-duta-umindo-aditya', '2025-07-07 03:19:49', '2025-07-07 03:19:49'),
(9, 'Sky Borneo Motor', '089523235612', 'Jl Adisucipto', 'sky-borneo-motor', '2025-07-07 03:21:47', '2025-07-07 03:21:47'),
(10, 'PT Mulia Industrindo, Tbk', '--------', '-', 'pt-mulia-industrindo-tbk', '2025-07-07 03:23:25', '2025-07-07 03:23:25'),
(11, 'PT Asahimas Flat Glass Tbk', '---------', '-', 'pt-asahimas-flat-glass-tbk', '2025-07-07 03:23:59', '2025-07-07 03:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `mode` enum('cod','transfer','invoice') NOT NULL,
  `status` enum('pending','settlement','declined') NOT NULL DEFAULT 'pending',
  `snap_token` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `mode`, `status`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'transfer', 'pending', '8a6347dd-fcda-4183-b96c-db1f2c8d5e51', '2025-07-03 06:58:37', '2025-07-03 06:58:38'),
(2, 2, 2, 'transfer', 'pending', 'd68bb8d3-ae5a-4a66-ba1a-3388af6e4953', '2025-07-03 07:39:25', '2025-07-03 07:39:27'),
(3, 2, 3, 'transfer', 'pending', '5b842b9b-ecf6-4ccc-adbf-f2cad85601e1', '2025-07-03 07:43:19', '2025-07-03 07:43:19'),
(4, 2, 4, 'transfer', 'settlement', 'fe40e404-5fc6-422d-a35b-44714b00cf01', '2025-07-06 00:45:48', '2025-07-06 00:46:29'),
(5, 2, 5, 'transfer', 'settlement', '3864718e-9e37-4000-aad0-327a3016ac03', '2025-07-06 00:47:02', '2025-07-06 00:51:11'),
(6, 2, 6, 'transfer', 'settlement', '5f8d4a38-c390-49eb-a996-f09fe40f4f75', '2025-07-06 00:55:15', '2025-07-06 00:56:35'),
(7, 2, 7, 'transfer', 'pending', '923c7ff7-b9b6-4ddb-9162-8a06489089b5', '2025-07-06 00:58:23', '2025-07-06 00:58:24'),
(8, 3, 8, 'cod', 'pending', '', '2025-07-07 07:04:22', '2025-07-07 07:04:22'),
(9, 3, 9, 'cod', 'pending', '', '2025-07-07 07:08:12', '2025-07-07 07:08:12'),
(10, 3, 10, 'cod', 'pending', '587ba705-82b5-4b66-bf88-85951f8f11fc', '2025-07-07 07:08:37', '2025-07-07 07:08:39'),
(11, 3, 11, 'cod', 'pending', '', '2025-07-07 07:10:51', '2025-07-07 07:10:51'),
(12, 3, 12, 'cod', 'pending', '', '2025-07-07 07:13:09', '2025-07-07 07:13:09'),
(13, 3, 13, 'transfer', 'pending', 'ff82b065-ae4c-45f4-bb4a-25382f651276', '2025-07-07 07:17:07', '2025-07-07 07:17:10'),
(14, 3, 14, 'transfer', 'settlement', 'b3e62f99-8889-41cc-8b74-302d291e8c98', '2025-07-07 07:27:39', '2025-07-07 07:28:09'),
(15, 3, 15, 'transfer', 'settlement', '9ba3344f-a92e-4f29-aa0a-9c20546c6c64', '2025-07-07 07:29:20', '2025-07-07 07:30:01'),
(16, 4, 16, 'transfer', 'settlement', '663cb2ab-e077-4fd4-865e-bf6984eca1fd', '2025-07-07 08:48:21', '2025-07-07 08:49:49'),
(17, 4, 17, 'cod', 'pending', '', '2025-07-07 08:50:43', '2025-07-07 08:50:43'),
(18, 4, 18, 'transfer', 'settlement', '5b772854-cf39-4f13-897c-2181f502dea4', '2025-07-07 09:26:58', '2025-07-07 09:27:31'),
(19, 4, 19, 'transfer', 'settlement', '0af25b69-bcab-4b6f-9a63-5b885f313e34', '2025-07-07 09:28:10', '2025-07-07 09:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'dutaautopart@gmail.com', '081122223333', 'admin', '$2y$12$JZt4XAWUXDeBApDZdFuSt.OYGLb3kZ1ysyYeeoCNTVAGnZFbi.P0.', '2025-07-03 05:44:37', '2025-07-03 05:44:37'),
(2, 'Rejeki Motor', 'rejekimotor@gmail.com', '081234567890', 'user', '$2y$12$UhMK7pcJ8OJ3acKhVWL2pOCkdU46sRnXja4Kki2C9lGQ1miGD87Ce', '2025-07-03 06:44:21', '2025-07-03 06:44:21'),
(3, 'Michael Riandy', 'michaelriandy23@gmail.com', '089690431088', 'user', '$2y$12$w9MfQ8ODMiUGal1Rbp1G9OtyblKHiEK0UnyeSjPc0Sh56onllrWSG', '2025-07-07 07:03:11', '2025-07-07 07:03:11'),
(4, 'Testing', 'testing@gmail.com', '0812345678900', 'user', '$2y$12$CWBQDe4WQAPGXJll3ueT6ePDT.e19KngrTD5IQfxTLutciJenx1Ne', '2025-07-07 08:45:39', '2025-07-07 08:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `name`, `phone`, `address`, `city`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rejeki Motor', '081234567890', 'Jl Antasari', 'Pontianak', '2025-07-03 06:58:37', '2025-07-03 06:58:37'),
(2, 3, 'Michael Riandy', '089690431088', 'Jl Dewi Sartika no 188', 'Pontianak', '2025-07-07 07:04:22', '2025-07-07 07:04:22'),
(3, 4, 'Testing', '0812345678900', 'Jl Adisucipto', 'Pontianak', '2025-07-07 08:48:21', '2025-07-07 08:48:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerces`
--
ALTER TABLE `ecommerces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month_names`
--
ALTER TABLE `month_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_slug_unique` (`slug`),
  ADD UNIQUE KEY `suppliers_phone_number_unique` (`phone_number`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecommerces`
--
ALTER TABLE `ecommerces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `month_names`
--
ALTER TABLE `month_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
