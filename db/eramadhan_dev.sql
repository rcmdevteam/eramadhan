-- Adminer 4.8.1 MySQL 8.1.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lots`;
CREATE TABLE `lots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hari` int NOT NULL,
  `sasaran` decimal(18,2) NOT NULL,
  `jumlah_lot` decimal(18,2) NOT NULL,
  `masjid_id` bigint unsigned NOT NULL,
  `ramadhan_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quota` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lots_masjid_id_foreign` (`masjid_id`),
  KEY `lots_ramadhan_id_foreign` (`ramadhan_id`),
  CONSTRAINT `lots_masjid_id_foreign` FOREIGN KEY (`masjid_id`) REFERENCES `masjids` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lots_ramadhan_id_foreign` FOREIGN KEY (`ramadhan_id`) REFERENCES `ramadhan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lots` (`id`, `hari`, `sasaran`, `jumlah_lot`, `masjid_id`, `ramadhan_id`, `created_at`, `updated_at`, `description`, `quota`) VALUES
(180,	1,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(181,	2,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(182,	3,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(183,	4,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(184,	5,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(185,	6,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(186,	7,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(187,	8,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(188,	9,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(189,	10,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(190,	11,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(191,	12,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(192,	13,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(193,	14,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(194,	15,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(195,	16,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(196,	17,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(197,	18,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(198,	19,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(199,	20,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(200,	21,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(201,	22,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(202,	23,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(203,	24,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(204,	25,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(205,	26,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(206,	27,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(207,	28,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(208,	29,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10),
(209,	30,	1000.00,	100.00,	15,	38,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53',	'Iftar/Moreh/Bubur Lambuk',	10);

DROP TABLE IF EXISTS `masjid_users`;
CREATE TABLE `masjid_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `masjid_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `masjid_user_user_id_foreign` (`user_id`),
  KEY `masjid_user_masjid_id_foreign` (`masjid_id`),
  CONSTRAINT `masjid_user_masjid_id_foreign` FOREIGN KEY (`masjid_id`) REFERENCES `masjids` (`id`) ON DELETE CASCADE,
  CONSTRAINT `masjid_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `masjid_users` (`id`, `user_id`, `masjid_id`, `created_at`, `updated_at`) VALUES
(3,	3,	12,	'2024-01-12 22:50:26',	'2024-01-12 22:50:26'),
(4,	4,	13,	'2024-01-12 22:58:59',	'2024-01-12 22:58:59'),
(5,	5,	14,	'2024-01-12 23:51:56',	'2024-01-12 23:51:56'),
(6,	6,	15,	'2024-01-13 09:33:28',	'2024-01-13 09:33:28');

DROP TABLE IF EXISTS `masjids`;
CREATE TABLE `masjids` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `toyyibpay_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toyyibpay_collection_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_toyyibpay_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `masjids` (`id`, `name`, `location`, `created_at`, `updated_at`, `toyyibpay_secret_key`, `toyyibpay_collection_id`, `option_toyyibpay_type`, `short_name`, `photo`, `cover`) VALUES
(12,	'Masjid-Selayang',	'Selayang',	'2024-01-12 22:50:26',	'2024-01-12 22:50:26',	NULL,	NULL,	NULL,	'ms',	NULL,	NULL),
(13,	'masjid b',	'batu cave',	'2024-01-12 22:58:59',	'2024-01-12 22:58:59',	NULL,	NULL,	NULL,	'mb',	NULL,	NULL),
(14,	'Masjid-C',	'Selayang',	'2024-01-12 23:51:56',	'2024-01-13 00:08:57',	NULL,	NULL,	NULL,	'mc',	NULL,	NULL),
(15,	'Masjid Selayang Baru',	'Selayang Baru',	'2024-01-13 09:33:28',	'2024-01-15 03:44:10',	NULL,	NULL,	NULL,	'msb',	'masjids/46795284497e1c7a35bf5437e63a4b15.jpg',	'masjids/b78f545458a544b4c4529f03d08182c5.jpg');

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int unsigned DEFAULT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  `lft` int unsigned DEFAULT NULL,
  `rgt` int unsigned DEFAULT NULL,
  `depth` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2020_03_31_114745_remove_backpackuser_model',	2),
(6,	'2023_12_09_154133_create_permission_tables',	2),
(7,	'2016_05_05_115641_create_menu_items_table',	3),
(8,	'2015_08_04_131614_create_settings_table',	4),
(10,	'2023_12_09_162003_create_dakwah_table',	5),
(11,	'2024_01_13_060126_create_masjids_table',	6),
(12,	'2024_01_13_062404_create_masjid_user_table',	6),
(13,	'2024_01_13_070349_create_ramadhan_table',	7),
(14,	'2024_01_13_071535_create_ramadhan_transactions_table',	8),
(15,	'2024_01_13_072150_create_lots_table',	9),
(16,	'2024_01_13_075603_update_masjids_table_add_toyyibpay_columns',	10),
(17,	'2024_01_13_093312_add_masjid_id_to_ramadhan_transactions_table',	11),
(18,	'2024_01_13_140224_add_columns_to_ramadhan_transactions_table',	12),
(19,	'2024_01_13_162058_add_description_to_lots_table',	13),
(20,	'2024_01_15_093710_add_short_name_to_masjids_table',	14),
(21,	'2024_01_15_095308_add_lot_id_to_ramadhan_transactions_table',	15),
(22,	'2024_01_15_105715_add_quota_to_lots_table',	16),
(23,	'2024_01_15_111355_add_photo_and_cover_to_masjids_table',	17);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3,	'App\\Models\\User',	1),
(1,	'App\\Models\\User',	2),
(1,	'App\\Models\\User',	3),
(1,	'App\\Models\\User',	4),
(1,	'App\\Models\\User',	5),
(1,	'App\\Models\\User',	6);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ramadhan`;
CREATE TABLE `ramadhan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `masjid_id` bigint unsigned NOT NULL,
  `tahun` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ramadhan_masjid_id_foreign` (`masjid_id`),
  CONSTRAINT `ramadhan_masjid_id_foreign` FOREIGN KEY (`masjid_id`) REFERENCES `masjids` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ramadhan` (`id`, `masjid_id`, `tahun`, `created_at`, `updated_at`) VALUES
(1,	13,	1445,	'2024-01-12 23:08:29',	'2024-01-12 23:08:29'),
(2,	13,	1445,	'2024-01-12 23:36:46',	'2024-01-12 23:36:46'),
(3,	13,	1445,	'2024-01-12 23:39:28',	'2024-01-12 23:39:28'),
(4,	13,	1445,	'2024-01-12 23:39:34',	'2024-01-12 23:39:34'),
(5,	13,	1445,	'2024-01-12 23:40:10',	'2024-01-12 23:40:10'),
(6,	13,	1445,	'2024-01-12 23:40:12',	'2024-01-12 23:40:12'),
(7,	13,	1445,	'2024-01-12 23:41:05',	'2024-01-12 23:41:05'),
(8,	13,	1445,	'2024-01-12 23:41:10',	'2024-01-12 23:41:10'),
(9,	13,	1445,	'2024-01-12 23:41:25',	'2024-01-12 23:41:25'),
(10,	13,	1445,	'2024-01-12 23:41:31',	'2024-01-12 23:41:31'),
(11,	13,	1445,	'2024-01-12 23:41:32',	'2024-01-12 23:41:32'),
(12,	13,	1445,	'2024-01-12 23:41:39',	'2024-01-12 23:41:39'),
(13,	13,	1445,	'2024-01-12 23:41:41',	'2024-01-12 23:41:41'),
(14,	13,	1445,	'2024-01-12 23:42:03',	'2024-01-12 23:42:03'),
(15,	13,	1445,	'2024-01-12 23:42:04',	'2024-01-12 23:42:04'),
(16,	13,	1445,	'2024-01-12 23:42:11',	'2024-01-12 23:42:11'),
(17,	13,	1445,	'2024-01-12 23:42:12',	'2024-01-12 23:42:12'),
(18,	13,	1445,	'2024-01-12 23:42:22',	'2024-01-12 23:42:22'),
(19,	13,	1445,	'2024-01-12 23:42:42',	'2024-01-12 23:42:42'),
(20,	13,	1445,	'2024-01-12 23:42:57',	'2024-01-12 23:42:57'),
(21,	13,	1445,	'2024-01-12 23:42:58',	'2024-01-12 23:42:58'),
(22,	13,	1445,	'2024-01-12 23:43:35',	'2024-01-12 23:43:35'),
(23,	13,	1445,	'2024-01-12 23:43:40',	'2024-01-12 23:43:40'),
(24,	13,	1445,	'2024-01-12 23:44:02',	'2024-01-12 23:44:02'),
(25,	13,	1445,	'2024-01-12 23:44:10',	'2024-01-12 23:44:10'),
(26,	13,	1445,	'2024-01-12 23:44:13',	'2024-01-12 23:44:13'),
(27,	13,	1445,	'2024-01-12 23:44:24',	'2024-01-12 23:44:24'),
(29,	14,	1445,	'2024-01-13 00:04:19',	'2024-01-13 00:04:19'),
(30,	12,	1445,	'2024-01-13 09:33:48',	'2024-01-13 09:33:48'),
(31,	12,	1445,	'2024-01-14 06:38:57',	'2024-01-14 06:38:57'),
(32,	12,	1445,	'2024-01-14 14:41:10',	'2024-01-14 14:41:10'),
(33,	12,	1445,	'2024-01-14 14:42:39',	'2024-01-14 14:42:39'),
(34,	12,	1445,	'2024-01-14 14:42:56',	'2024-01-14 14:42:56'),
(38,	15,	1445,	'2024-01-15 01:18:53',	'2024-01-15 01:18:53');

DROP TABLE IF EXISTS `ramadhan_transactions`;
CREATE TABLE `ramadhan_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ramadhan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` decimal(8,2) NOT NULL,
  `kuantiti` int NOT NULL,
  `toyyibpay_ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ramadhan_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `masjid_id` bigint unsigned NOT NULL,
  `toyyibpay_refno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toyyibpay_billcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark_as_paid` datetime DEFAULT NULL,
  `lot_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ramadhan_transactions_ramadhan_id_foreign` (`ramadhan_id`),
  KEY `ramadhan_transactions_masjid_id_foreign` (`masjid_id`),
  KEY `ramadhan_transactions_lot_id_foreign` (`lot_id`),
  CONSTRAINT `ramadhan_transactions_lot_id_foreign` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ramadhan_transactions_masjid_id_foreign` FOREIGN KEY (`masjid_id`) REFERENCES `masjids` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ramadhan_transactions_ramadhan_id_foreign` FOREIGN KEY (`ramadhan_id`) REFERENCES `ramadhan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ramadhan_transactions` (`id`, `nama`, `emel`, `telefon`, `ramadhan`, `jumlah`, `kuantiti`, `toyyibpay_ref`, `status`, `ramadhan_id`, `created_at`, `updated_at`, `masjid_id`, `toyyibpay_refno`, `toyyibpay_billcode`, `mark_as_paid`, `lot_id`) VALUES
(44,	'mahfudz',	'mahfudz@richcore.media',	'60132465974',	'1',	100.00,	1,	NULL,	'paid',	38,	'2024-01-15 02:16:19',	'2024-01-15 02:16:19',	15,	NULL,	NULL,	NULL,	180),
(45,	'mahfudz',	'mahfudz@richcore.media',	'60132465974',	'1',	100.00,	1,	NULL,	'paid',	38,	'2024-01-15 02:16:19',	'2024-01-15 02:16:19',	15,	NULL,	NULL,	NULL,	180);

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'web',	'2023-12-16 23:45:56',	'2023-12-16 23:45:56'),
(3,	'Superadmin',	'web',	'2023-12-16 23:46:17',	'2023-12-16 23:46:17');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `field` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `name`, `description`, `value`, `field`, `active`, `created_at`, `updated_at`) VALUES
(1,	'contact_email',	'Contact form email address',	'The email address that all emails from the contact form will go to.',	'admin@updivision.com',	'{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}',	1,	NULL,	NULL),
(2,	'contact_cc',	'Contact form CC field',	'Email addresses separated by comma, to be included as CC in the email sent by the contact form.',	'',	'{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}',	1,	NULL,	NULL),
(3,	'contact_bcc',	'Contact form BCC field',	'Email addresses separated by comma, to be included as BCC in the email sent by the contact form.',	'',	'{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}',	1,	NULL,	NULL),
(4,	'motto',	'Motto',	'Website motto',	'this is the value',	'{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'superadmin',	'superadmin@app.co',	NULL,	'$2y$10$G0pdi2EVQXkyitb0TpT23em36e6aGmlcaTA/2B7GlEqr6T4vhKaTe',	NULL,	'2023-12-09 07:33:14',	'2023-12-09 07:33:14'),
(2,	'admin',	'admin@app.co',	NULL,	'$2y$10$.NYw3/qQEraio/NaEUIDf.Mgs5GUHA4WiJZ6.9KXaBJDRriVb4oLu',	NULL,	'2023-12-16 23:46:52',	'2023-12-16 23:46:52'),
(3,	'masjid a',	'masjida@gmail.com',	NULL,	'$2y$10$aj/G5XOO2lG/dSOqe/EZnO3z/rh/WVCE6AsFLQWtVRD.O5Z/pEn9q',	NULL,	'2024-01-12 22:33:53',	'2024-01-12 22:33:53'),
(4,	'bendahari',	'masjidb@mail.com',	NULL,	'$2y$10$WiW.o67NzbFhMqYQrUGZq.2eYMTsVJPz.49EKKb0cRPfaFQrDixfe',	NULL,	'2024-01-12 22:58:45',	'2024-01-12 22:58:45'),
(5,	'masdjic',	'masjidc@mail.com',	NULL,	'$2y$10$QygW3mC8k7LJLuGUXptlF.RXEP695h6WHWf2kmJ1uN.5cF3y3RI0q',	NULL,	'2024-01-12 23:51:46',	'2024-01-12 23:51:46'),
(6,	'Bendahari Masjid Selayang',	'masjid@selayang.com',	NULL,	'$2y$10$RnZILR5aUk/BL8ogZgGey.6r2qsVHqwscq2RETVQESL/DQPaTeGBC',	NULL,	'2024-01-13 09:33:10',	'2024-01-13 09:33:10');

-- 2024-01-16 09:11:39
