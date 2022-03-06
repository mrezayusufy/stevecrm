/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `additional` json DEFAULT NULL,
  `schedule_from` datetime DEFAULT NULL,
  `schedule_to` datetime DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_user_id_foreign` (`user_id`),
  CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;

DROP TABLE IF EXISTS `activity_files`;
CREATE TABLE IF NOT EXISTS `activity_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_files_activity_id_foreign` (`activity_id`),
  CONSTRAINT `activity_files_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `activity_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_files` ENABLE KEYS */;

DROP TABLE IF EXISTS `activity_participants`;
CREATE TABLE IF NOT EXISTS `activity_participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_participants_activity_id_foreign` (`activity_id`),
  KEY `activity_participants_user_id_foreign` (`user_id`),
  KEY `activity_participants_person_id_foreign` (`person_id`),
  CONSTRAINT `activity_participants_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `activity_participants_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `activity_participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `activity_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_participants` ENABLE KEYS */;

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lookup_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `quick_add` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attributes_code_entity_type_unique` (`code`,`entity_type`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
INSERT INTO `attributes` (`id`, `code`, `name`, `type`, `lookup_type`, `entity_type`, `sort_order`, `validation`, `is_required`, `is_unique`, `quick_add`, `is_user_defined`, `created_at`, `updated_at`) VALUES
	(1, 'title', 'Title', 'text', NULL, 'leads', 1, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(2, 'description', 'Description', 'textarea', NULL, 'leads', 2, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(3, 'lead_value', 'Lead Value', 'price', NULL, 'leads', 3, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(4, 'lead_source_id', 'Lead Source', 'select', 'lead_sources', 'leads', 4, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-03-05 00:37:52'),
	(5, 'lead_type_id', 'Type', 'select', 'lead_types', 'leads', 5, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(6, 'user_id', 'Sales Owner', 'select', 'users', 'leads', 7, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(7, 'expected_close_date', 'Expected Close Date', 'date', NULL, 'leads', 8, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(9, 'name', 'Name', 'text', NULL, 'persons', 1, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(10, 'emails', 'Emails', 'email', NULL, 'persons', 2, NULL, 1, 1, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(11, 'contact_numbers', 'Contact Numbers', 'phone', NULL, 'persons', 3, 'numeric', 0, 1, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(12, 'organization_id', 'Organization', 'lookup', 'organizations', 'persons', 4, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(13, 'name', 'Name', 'text', NULL, 'organizations', 1, NULL, 1, 1, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(14, 'address', 'Address', 'address', NULL, 'organizations', 2, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(15, 'name', 'Name', 'text', NULL, 'products', 1, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(16, 'description', 'Description', 'textarea', NULL, 'products', 2, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(17, 'sku', 'SKU', 'text', NULL, 'products', 3, NULL, 1, 1, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(18, 'quantity', 'Quantity', 'text', NULL, 'products', 4, 'numeric', 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(19, 'price', 'Price', 'text', NULL, 'products', 5, 'decimal', 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(20, 'user_id', 'Sales Owner', 'select', 'users', 'quotes', 1, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(21, 'subject', 'Subject', 'text', NULL, 'quotes', 2, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(22, 'description', 'Description', 'textarea', NULL, 'quotes', 3, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(23, 'billing_address', 'Billing Address', 'address', NULL, 'quotes', 4, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(24, 'shipping_address', 'Shipping Address', 'address', NULL, 'quotes', 5, NULL, 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(25, 'discount_percent', 'Discount Percent', 'text', NULL, 'quotes', 6, 'decimal', 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(26, 'discount_amount', 'Discount Amount', 'price', NULL, 'quotes', 7, 'decimal', 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(27, 'tax_amount', 'Tax Amount', 'price', NULL, 'quotes', 8, 'decimal', 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(28, 'adjustment_amount', 'Adjustment Amount', 'price', NULL, 'quotes', 9, 'decimal', 0, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(29, 'sub_total', 'Sub Total', 'price', NULL, 'quotes', 10, 'decimal', 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(30, 'grand_total', 'Grand Total', 'price', NULL, 'quotes', 11, 'decimal', 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(31, 'expired_at', 'Expired At', 'date', NULL, 'quotes', 12, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(32, 'person_id', 'Person', 'lookup', 'persons', 'quotes', 13, NULL, 1, 0, 1, 0, '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(34, 'title', 'Title', 'text', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 19:47:57', '2022-03-02 19:47:57'),
	(35, 'date', 'Date', 'date', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:04:49', '2022-03-02 21:04:49'),
	(36, 'time', 'Time', 'time', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:08:55', '2022-03-02 21:08:55'),
	(37, 'duration', 'Duration', 'text', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:11:46', '2022-03-02 21:11:46'),
	(38, 'location', 'Location', 'text', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:12:59', '2022-03-02 21:12:59'),
	(39, 'assign_to', 'Assign To', 'select', 'persons', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:13:45', '2022-03-02 21:13:45'),
	(40, 'link_to', 'Link this task to', 'text', 'leads', 'persons', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:14:34', '2022-03-02 21:14:34'),
	(41, 'associate_with', 'Associate with', 'select', 'persons', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:16:27', '2022-03-02 21:16:27'),
	(42, 'send_notification', 'Send notifications of new task to the assigned people', 'boolean', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:17:35', '2022-03-02 21:17:35'),
	(43, 'notification_from', 'Appointment notification from', 'select', 'persons', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:20:15', '2022-03-02 21:20:15'),
	(44, 'invite', 'Invite', 'multiselect', 'persons', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:21:03', '2022-03-02 21:21:03'),
	(45, 'notes', 'Notes', 'textarea', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:22:08', '2022-03-02 21:22:08'),
	(46, 'subtask', 'Subtask', 'text', 'leads', 'tasks', NULL, NULL, 0, 0, 1, 1, '2022-03-02 21:23:23', '2022-03-02 21:23:23'),
	(47, 'name', 'Name', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 12:11:53', '2022-03-03 12:11:53'),
	(48, 'tags', 'Tags', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 12:13:13', '2022-03-03 12:13:13'),
	(50, 'customer_since', 'Customer Since', 'date', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 12:14:40', '2022-03-03 12:14:40'),
	(52, 'producer', 'Producer', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 12:22:28', '2022-03-03 12:22:28'),
	(53, 'policies', 'Policies', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 12:22:59', '2022-03-03 12:22:59'),
	(54, 'task_count', 'Task Count', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 12:23:22', '2022-03-03 12:23:22'),
	(55, 'email', 'Email', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 15:35:46', '2022-03-03 15:35:46'),
	(56, 'wp_emailed', 'WP Emailed', 'text', 'leads', 'customers', NULL, NULL, 0, 0, 1, 1, '2022-03-03 15:36:10', '2022-03-03 15:36:10'),
	(57, 'location', 'Location', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:50:34', '2022-03-05 03:50:34'),
	(58, 'tags', 'Tags', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:50:52', '2022-03-05 03:50:52'),
	(59, 'assign_to', 'Assign to', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:51:09', '2022-03-05 03:51:09'),
	(60, 'csr', 'CSR', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:51:29', '2022-03-05 03:51:29'),
	(61, 'lead_name', 'Lead Name', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:51:52', '2022-03-05 03:51:52'),
	(62, 'nickname', 'Nickname', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:52:17', '2022-03-05 03:52:17'),
	(63, 'dot', 'Date of Birth', 'date', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:52:46', '2022-03-05 03:52:46'),
	(64, 'marital_status', 'Marital Status', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:53:18', '2022-03-05 03:53:18'),
	(65, 'phone', 'Phone', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:53:39', '2022-03-05 03:53:39'),
	(66, 'email', 'email', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:53:57', '2022-03-05 03:53:57'),
	(67, 'secondary_email', 'Secondary Email', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:54:15', '2022-03-05 03:54:15'),
	(68, 'secondary_phone', 'Secondary Phone', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:54:46', '2022-03-05 03:54:46'),
	(69, 'street_address', 'Street address', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:55:06', '2022-03-05 03:55:06'),
	(70, 'city', 'City', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:55:22', '2022-03-05 03:55:22'),
	(71, 'country', 'Country', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:55:37', '2022-03-05 03:55:37'),
	(72, 'state', 'State', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:55:53', '2022-03-05 03:55:53'),
	(73, 'postal_code', 'Postal code', 'text', 'leads', 'leads', NULL, NULL, 0, 0, 1, 1, '2022-03-05 03:56:19', '2022-03-05 03:56:19');
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;

DROP TABLE IF EXISTS `attribute_options`;
CREATE TABLE IF NOT EXISTS `attribute_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_options_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `attribute_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `attribute_options` ENABLE KEYS */;

DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'leads',
  `text_value` text COLLATE utf8mb4_unicode_ci,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int(11) DEFAULT NULL,
  `float_value` double DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `time_value` time DEFAULT NULL,
  `json_value` json DEFAULT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity_type_attribute_value_index_unique` (`entity_type`,`entity_id`,`attribute_id`),
  KEY `attribute_values_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `attribute_values` DISABLE KEYS */;
INSERT INTO `attribute_values` (`id`, `entity_type`, `text_value`, `boolean_value`, `integer_value`, `float_value`, `datetime_value`, `date_value`, `time_value`, `json_value`, `entity_id`, `attribute_id`) VALUES
	(1, 'persons', 'ali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 9),
	(2, 'persons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{"label": "work", "value": "ali@gmail.com"}]', 1, 10),
	(3, 'persons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{"label": "work", "value": "+93744227255"}]', 1, 11),
	(4, 'leads', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
	(5, 'leads', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2),
	(6, 'leads', NULL, NULL, NULL, 200, NULL, NULL, NULL, NULL, 1, 3),
	(7, 'leads', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 4),
	(8, 'leads', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 5),
	(9, 'leads', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 6),
	(10, 'leads', NULL, NULL, NULL, NULL, NULL, '2022-02-21', NULL, NULL, 1, 7),
	(12, 'persons', 'steve', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 9),
	(13, 'persons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{"label": "work", "value": "steve@gmail.com"}]', 2, 10),
	(14, 'persons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{"label": "work", "value": "066666666"}]', 2, 11),
	(15, 'products', 'clothes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15),
	(16, 'products', 'cloths', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 16),
	(17, 'products', '1001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 17),
	(18, 'products', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 18),
	(19, 'products', '111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 19),
	(20, 'quotes', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 20),
	(21, 'quotes', 'kabul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 21),
	(22, 'quotes', 'kabul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 22),
	(23, 'quotes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{"city": "kabul", "state": "kabul", "address": "kabul", "country": "AF", "postcode": "1001"}', 1, 23),
	(24, 'quotes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{"city": "kabul", "state": "kabul", "address": "kabul", "country": "AF", "postcode": "kabul"}', 1, 24),
	(25, 'quotes', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 1, 26),
	(26, 'quotes', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 27),
	(27, 'quotes', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 28),
	(28, 'quotes', NULL, NULL, NULL, 1221, NULL, NULL, NULL, NULL, 1, 29),
	(29, 'quotes', NULL, NULL, NULL, 1220, NULL, NULL, NULL, NULL, 1, 30),
	(30, 'quotes', NULL, NULL, NULL, NULL, NULL, '2022-02-21', NULL, NULL, 1, 31),
	(31, 'quotes', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, 1, 32);
/*!40000 ALTER TABLE `attribute_values` ENABLE KEYS */;

DROP TABLE IF EXISTS `core_config`;
CREATE TABLE IF NOT EXISTS `core_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `core_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_config` ENABLE KEYS */;

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `code`, `name`) VALUES
	(1, 'AF', 'Afghanistan'),
	(2, 'AX', 'Åland Islands'),
	(3, 'AL', 'Albania'),
	(4, 'DZ', 'Algeria'),
	(5, 'AS', 'American Samoa'),
	(6, 'AD', 'Andorra'),
	(7, 'AO', 'Angola'),
	(8, 'AI', 'Anguilla'),
	(9, 'AQ', 'Antarctica'),
	(10, 'AG', 'Antigua & Barbuda'),
	(11, 'AR', 'Argentina'),
	(12, 'AM', 'Armenia'),
	(13, 'AW', 'Aruba'),
	(14, 'AC', 'Ascension Island'),
	(15, 'AU', 'Australia'),
	(16, 'AT', 'Austria'),
	(17, 'AZ', 'Azerbaijan'),
	(18, 'BS', 'Bahamas'),
	(19, 'BH', 'Bahrain'),
	(20, 'BD', 'Bangladesh'),
	(21, 'BB', 'Barbados'),
	(22, 'BY', 'Belarus'),
	(23, 'BE', 'Belgium'),
	(24, 'BZ', 'Belize'),
	(25, 'BJ', 'Benin'),
	(26, 'BM', 'Bermuda'),
	(27, 'BT', 'Bhutan'),
	(28, 'BO', 'Bolivia'),
	(29, 'BA', 'Bosnia & Herzegovina'),
	(30, 'BW', 'Botswana'),
	(31, 'BR', 'Brazil'),
	(32, 'IO', 'British Indian Ocean Territory'),
	(33, 'VG', 'British Virgin Islands'),
	(34, 'BN', 'Brunei'),
	(35, 'BG', 'Bulgaria'),
	(36, 'BF', 'Burkina Faso'),
	(37, 'BI', 'Burundi'),
	(38, 'KH', 'Cambodia'),
	(39, 'CM', 'Cameroon'),
	(40, 'CA', 'Canada'),
	(41, 'IC', 'Canary Islands'),
	(42, 'CV', 'Cape Verde'),
	(43, 'BQ', 'Caribbean Netherlands'),
	(44, 'KY', 'Cayman Islands'),
	(45, 'CF', 'Central African Republic'),
	(46, 'EA', 'Ceuta & Melilla'),
	(47, 'TD', 'Chad'),
	(48, 'CL', 'Chile'),
	(49, 'CN', 'China'),
	(50, 'CX', 'Christmas Island'),
	(51, 'CC', 'Cocos (Keeling) Islands'),
	(52, 'CO', 'Colombia'),
	(53, 'KM', 'Comoros'),
	(54, 'CG', 'Congo - Brazzaville'),
	(55, 'CD', 'Congo - Kinshasa'),
	(56, 'CK', 'Cook Islands'),
	(57, 'CR', 'Costa Rica'),
	(58, 'CI', 'Côte d’Ivoire'),
	(59, 'HR', 'Croatia'),
	(60, 'CU', 'Cuba'),
	(61, 'CW', 'Curaçao'),
	(62, 'CY', 'Cyprus'),
	(63, 'CZ', 'Czechia'),
	(64, 'DK', 'Denmark'),
	(65, 'DG', 'Diego Garcia'),
	(66, 'DJ', 'Djibouti'),
	(67, 'DM', 'Dominica'),
	(68, 'DO', 'Dominican Republic'),
	(69, 'EC', 'Ecuador'),
	(70, 'EG', 'Egypt'),
	(71, 'SV', 'El Salvador'),
	(72, 'GQ', 'Equatorial Guinea'),
	(73, 'ER', 'Eritrea'),
	(74, 'EE', 'Estonia'),
	(75, 'ET', 'Ethiopia'),
	(76, 'EZ', 'Eurozone'),
	(77, 'FK', 'Falkland Islands'),
	(78, 'FO', 'Faroe Islands'),
	(79, 'FJ', 'Fiji'),
	(80, 'FI', 'Finland'),
	(81, 'FR', 'France'),
	(82, 'GF', 'French Guiana'),
	(83, 'PF', 'French Polynesia'),
	(84, 'TF', 'French Southern Territories'),
	(85, 'GA', 'Gabon'),
	(86, 'GM', 'Gambia'),
	(87, 'GE', 'Georgia'),
	(88, 'DE', 'Germany'),
	(89, 'GH', 'Ghana'),
	(90, 'GI', 'Gibraltar'),
	(91, 'GR', 'Greece'),
	(92, 'GL', 'Greenland'),
	(93, 'GD', 'Grenada'),
	(94, 'GP', 'Guadeloupe'),
	(95, 'GU', 'Guam'),
	(96, 'GT', 'Guatemala'),
	(97, 'GG', 'Guernsey'),
	(98, 'GN', 'Guinea'),
	(99, 'GW', 'Guinea-Bissau'),
	(100, 'GY', 'Guyana'),
	(101, 'HT', 'Haiti'),
	(102, 'HN', 'Honduras'),
	(103, 'HK', 'Hong Kong SAR China'),
	(104, 'HU', 'Hungary'),
	(105, 'IS', 'Iceland'),
	(106, 'IN', 'India'),
	(107, 'ID', 'Indonesia'),
	(108, 'IR', 'Iran'),
	(109, 'IQ', 'Iraq'),
	(110, 'IE', 'Ireland'),
	(111, 'IM', 'Isle of Man'),
	(112, 'IL', 'Israel'),
	(113, 'IT', 'Italy'),
	(114, 'JM', 'Jamaica'),
	(115, 'JP', 'Japan'),
	(116, 'JE', 'Jersey'),
	(117, 'JO', 'Jordan'),
	(118, 'KZ', 'Kazakhstan'),
	(119, 'KE', 'Kenya'),
	(120, 'KI', 'Kiribati'),
	(121, 'XK', 'Kosovo'),
	(122, 'KW', 'Kuwait'),
	(123, 'KG', 'Kyrgyzstan'),
	(124, 'LA', 'Laos'),
	(125, 'LV', 'Latvia'),
	(126, 'LB', 'Lebanon'),
	(127, 'LS', 'Lesotho'),
	(128, 'LR', 'Liberia'),
	(129, 'LY', 'Libya'),
	(130, 'LI', 'Liechtenstein'),
	(131, 'LT', 'Lithuania'),
	(132, 'LU', 'Luxembourg'),
	(133, 'MO', 'Macau SAR China'),
	(134, 'MK', 'Macedonia'),
	(135, 'MG', 'Madagascar'),
	(136, 'MW', 'Malawi'),
	(137, 'MY', 'Malaysia'),
	(138, 'MV', 'Maldives'),
	(139, 'ML', 'Mali'),
	(140, 'MT', 'Malta'),
	(141, 'MH', 'Marshall Islands'),
	(142, 'MQ', 'Martinique'),
	(143, 'MR', 'Mauritania'),
	(144, 'MU', 'Mauritius'),
	(145, 'YT', 'Mayotte'),
	(146, 'MX', 'Mexico'),
	(147, 'FM', 'Micronesia'),
	(148, 'MD', 'Moldova'),
	(149, 'MC', 'Monaco'),
	(150, 'MN', 'Mongolia'),
	(151, 'ME', 'Montenegro'),
	(152, 'MS', 'Montserrat'),
	(153, 'MA', 'Morocco'),
	(154, 'MZ', 'Mozambique'),
	(155, 'MM', 'Myanmar (Burma)'),
	(156, 'NA', 'Namibia'),
	(157, 'NR', 'Nauru'),
	(158, 'NP', 'Nepal'),
	(159, 'NL', 'Netherlands'),
	(160, 'NC', 'New Caledonia'),
	(161, 'NZ', 'New Zealand'),
	(162, 'NI', 'Nicaragua'),
	(163, 'NE', 'Niger'),
	(164, 'NG', 'Nigeria'),
	(165, 'NU', 'Niue'),
	(166, 'NF', 'Norfolk Island'),
	(167, 'KP', 'North Korea'),
	(168, 'MP', 'Northern Mariana Islands'),
	(169, 'NO', 'Norway'),
	(170, 'OM', 'Oman'),
	(171, 'PK', 'Pakistan'),
	(172, 'PW', 'Palau'),
	(173, 'PS', 'Palestinian Territories'),
	(174, 'PA', 'Panama'),
	(175, 'PG', 'Papua New Guinea'),
	(176, 'PY', 'Paraguay'),
	(177, 'PE', 'Peru'),
	(178, 'PH', 'Philippines'),
	(179, 'PN', 'Pitcairn Islands'),
	(180, 'PL', 'Poland'),
	(181, 'PT', 'Portugal'),
	(182, 'PR', 'Puerto Rico'),
	(183, 'QA', 'Qatar'),
	(184, 'RE', 'Réunion'),
	(185, 'RO', 'Romania'),
	(186, 'RU', 'Russia'),
	(187, 'RW', 'Rwanda'),
	(188, 'WS', 'Samoa'),
	(189, 'SM', 'San Marino'),
	(190, 'ST', 'São Tomé & Príncipe'),
	(191, 'SA', 'Saudi Arabia'),
	(192, 'SN', 'Senegal'),
	(193, 'RS', 'Serbia'),
	(194, 'SC', 'Seychelles'),
	(195, 'SL', 'Sierra Leone'),
	(196, 'SG', 'Singapore'),
	(197, 'SX', 'Sint Maarten'),
	(198, 'SK', 'Slovakia'),
	(199, 'SI', 'Slovenia'),
	(200, 'SB', 'Solomon Islands'),
	(201, 'SO', 'Somalia'),
	(202, 'ZA', 'South Africa'),
	(203, 'GS', 'South Georgia & South Sandwich Islands'),
	(204, 'KR', 'South Korea'),
	(205, 'SS', 'South Sudan'),
	(206, 'ES', 'Spain'),
	(207, 'LK', 'Sri Lanka'),
	(208, 'BL', 'St. Barthélemy'),
	(209, 'SH', 'St. Helena'),
	(210, 'KN', 'St. Kitts & Nevis'),
	(211, 'LC', 'St. Lucia'),
	(212, 'MF', 'St. Martin'),
	(213, 'PM', 'St. Pierre & Miquelon'),
	(214, 'VC', 'St. Vincent & Grenadines'),
	(215, 'SD', 'Sudan'),
	(216, 'SR', 'Suriname'),
	(217, 'SJ', 'Svalbard & Jan Mayen'),
	(218, 'SZ', 'Swaziland'),
	(219, 'SE', 'Sweden'),
	(220, 'CH', 'Switzerland'),
	(221, 'SY', 'Syria'),
	(222, 'TW', 'Taiwan'),
	(223, 'TJ', 'Tajikistan'),
	(224, 'TZ', 'Tanzania'),
	(225, 'TH', 'Thailand'),
	(226, 'TL', 'Timor-Leste'),
	(227, 'TG', 'Togo'),
	(228, 'TK', 'Tokelau'),
	(229, 'TO', 'Tonga'),
	(230, 'TT', 'Trinidad & Tobago'),
	(231, 'TA', 'Tristan da Cunha'),
	(232, 'TN', 'Tunisia'),
	(233, 'TR', 'Turkey'),
	(234, 'TM', 'Turkmenistan'),
	(235, 'TC', 'Turks & Caicos Islands'),
	(236, 'TV', 'Tuvalu'),
	(237, 'UM', 'U.S. Outlying Islands'),
	(238, 'VI', 'U.S. Virgin Islands'),
	(239, 'UG', 'Uganda'),
	(240, 'UA', 'Ukraine'),
	(241, 'AE', 'United Arab Emirates'),
	(242, 'GB', 'United Kingdom'),
	(243, 'UN', 'United Nations'),
	(244, 'US', 'United States'),
	(245, 'UY', 'Uruguay'),
	(246, 'UZ', 'Uzbekistan'),
	(247, 'VU', 'Vanuatu'),
	(248, 'VA', 'Vatican City'),
	(249, 'VE', 'Venezuela'),
	(250, 'VN', 'Vietnam'),
	(251, 'WF', 'Wallis & Futuna'),
	(252, 'EH', 'Western Sahara'),
	(253, 'YE', 'Yemen'),
	(254, 'ZM', 'Zambia'),
	(255, 'ZW', 'Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

DROP TABLE IF EXISTS `country_states`;
CREATE TABLE IF NOT EXISTS `country_states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_states_country_id_foreign` (`country_id`),
  CONSTRAINT `country_states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=569 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `country_states` DISABLE KEYS */;
INSERT INTO `country_states` (`id`, `country_code`, `code`, `name`, `country_id`) VALUES
	(1, 'US', 'AL', 'Alabama', 244),
	(2, 'US', 'AK', 'Alaska', 244),
	(3, 'US', 'AS', 'American Samoa', 244),
	(4, 'US', 'AZ', 'Arizona', 244),
	(5, 'US', 'AR', 'Arkansas', 244),
	(6, 'US', 'AE', 'Armed Forces Africa', 244),
	(7, 'US', 'AA', 'Armed Forces Americas', 244),
	(8, 'US', 'AE', 'Armed Forces Canada', 244),
	(9, 'US', 'AE', 'Armed Forces Europe', 244),
	(10, 'US', 'AE', 'Armed Forces Middle East', 244),
	(11, 'US', 'AP', 'Armed Forces Pacific', 244),
	(12, 'US', 'CA', 'California', 244),
	(13, 'US', 'CO', 'Colorado', 244),
	(14, 'US', 'CT', 'Connecticut', 244),
	(15, 'US', 'DE', 'Delaware', 244),
	(16, 'US', 'DC', 'District of Columbia', 244),
	(17, 'US', 'FM', 'Federated States Of Micronesia', 244),
	(18, 'US', 'FL', 'Florida', 244),
	(19, 'US', 'GA', 'Georgia', 244),
	(20, 'US', 'GU', 'Guam', 244),
	(21, 'US', 'HI', 'Hawaii', 244),
	(22, 'US', 'ID', 'Idaho', 244),
	(23, 'US', 'IL', 'Illinois', 244),
	(24, 'US', 'IN', 'Indiana', 244),
	(25, 'US', 'IA', 'Iowa', 244),
	(26, 'US', 'KS', 'Kansas', 244),
	(27, 'US', 'KY', 'Kentucky', 244),
	(28, 'US', 'LA', 'Louisiana', 244),
	(29, 'US', 'ME', 'Maine', 244),
	(30, 'US', 'MH', 'Marshall Islands', 244),
	(31, 'US', 'MD', 'Maryland', 244),
	(32, 'US', 'MA', 'Massachusetts', 244),
	(33, 'US', 'MI', 'Michigan', 244),
	(34, 'US', 'MN', 'Minnesota', 244),
	(35, 'US', 'MS', 'Mississippi', 244),
	(36, 'US', 'MO', 'Missouri', 244),
	(37, 'US', 'MT', 'Montana', 244),
	(38, 'US', 'NE', 'Nebraska', 244),
	(39, 'US', 'NV', 'Nevada', 244),
	(40, 'US', 'NH', 'New Hampshire', 244),
	(41, 'US', 'NJ', 'New Jersey', 244),
	(42, 'US', 'NM', 'New Mexico', 244),
	(43, 'US', 'NY', 'New York', 244),
	(44, 'US', 'NC', 'North Carolina', 244),
	(45, 'US', 'ND', 'North Dakota', 244),
	(46, 'US', 'MP', 'Northern Mariana Islands', 244),
	(47, 'US', 'OH', 'Ohio', 244),
	(48, 'US', 'OK', 'Oklahoma', 244),
	(49, 'US', 'OR', 'Oregon', 244),
	(50, 'US', 'PW', 'Palau', 244),
	(51, 'US', 'PA', 'Pennsylvania', 244),
	(52, 'US', 'PR', 'Puerto Rico', 244),
	(53, 'US', 'RI', 'Rhode Island', 244),
	(54, 'US', 'SC', 'South Carolina', 244),
	(55, 'US', 'SD', 'South Dakota', 244),
	(56, 'US', 'TN', 'Tennessee', 244),
	(57, 'US', 'TX', 'Texas', 244),
	(58, 'US', 'UT', 'Utah', 244),
	(59, 'US', 'VT', 'Vermont', 244),
	(60, 'US', 'VI', 'Virgin Islands', 244),
	(61, 'US', 'VA', 'Virginia', 244),
	(62, 'US', 'WA', 'Washington', 244),
	(63, 'US', 'WV', 'West Virginia', 244),
	(64, 'US', 'WI', 'Wisconsin', 244),
	(65, 'US', 'WY', 'Wyoming', 244),
	(66, 'CA', 'AB', 'Alberta', 40),
	(67, 'CA', 'BC', 'British Columbia', 40),
	(68, 'CA', 'MB', 'Manitoba', 40),
	(69, 'CA', 'NL', 'Newfoundland and Labrador', 40),
	(70, 'CA', 'NB', 'New Brunswick', 40),
	(71, 'CA', 'NS', 'Nova Scotia', 40),
	(72, 'CA', 'NT', 'Northwest Territories', 40),
	(73, 'CA', 'NU', 'Nunavut', 40),
	(74, 'CA', 'ON', 'Ontario', 40),
	(75, 'CA', 'PE', 'Prince Edward Island', 40),
	(76, 'CA', 'QC', 'Quebec', 40),
	(77, 'CA', 'SK', 'Saskatchewan', 40),
	(78, 'CA', 'YT', 'Yukon Territory', 40),
	(79, 'DE', 'NDS', 'Niedersachsen', 88),
	(80, 'DE', 'BAW', 'Baden-Württemberg', 88),
	(81, 'DE', 'BAY', 'Bayern', 88),
	(82, 'DE', 'BER', 'Berlin', 88),
	(83, 'DE', 'BRG', 'Brandenburg', 88),
	(84, 'DE', 'BRE', 'Bremen', 88),
	(85, 'DE', 'HAM', 'Hamburg', 88),
	(86, 'DE', 'HES', 'Hessen', 88),
	(87, 'DE', 'MEC', 'Mecklenburg-Vorpommern', 88),
	(88, 'DE', 'NRW', 'Nordrhein-Westfalen', 88),
	(89, 'DE', 'RHE', 'Rheinland-Pfalz', 88),
	(90, 'DE', 'SAR', 'Saarland', 88),
	(91, 'DE', 'SAS', 'Sachsen', 88),
	(92, 'DE', 'SAC', 'Sachsen-Anhalt', 88),
	(93, 'DE', 'SCN', 'Schleswig-Holstein', 88),
	(94, 'DE', 'THE', 'Thüringen', 88),
	(95, 'AT', 'WI', 'Wien', 16),
	(96, 'AT', 'NO', 'Niederösterreich', 16),
	(97, 'AT', 'OO', 'Oberösterreich', 16),
	(98, 'AT', 'SB', 'Salzburg', 16),
	(99, 'AT', 'KN', 'Kärnten', 16),
	(100, 'AT', 'ST', 'Steiermark', 16),
	(101, 'AT', 'TI', 'Tirol', 16),
	(102, 'AT', 'BL', 'Burgenland', 16),
	(103, 'AT', 'VB', 'Vorarlberg', 16),
	(104, 'CH', 'AG', 'Aargau', 220),
	(105, 'CH', 'AI', 'Appenzell Innerrhoden', 220),
	(106, 'CH', 'AR', 'Appenzell Ausserrhoden', 220),
	(107, 'CH', 'BE', 'Bern', 220),
	(108, 'CH', 'BL', 'Basel-Landschaft', 220),
	(109, 'CH', 'BS', 'Basel-Stadt', 220),
	(110, 'CH', 'FR', 'Freiburg', 220),
	(111, 'CH', 'GE', 'Genf', 220),
	(112, 'CH', 'GL', 'Glarus', 220),
	(113, 'CH', 'GR', 'Graubünden', 220),
	(114, 'CH', 'JU', 'Jura', 220),
	(115, 'CH', 'LU', 'Luzern', 220),
	(116, 'CH', 'NE', 'Neuenburg', 220),
	(117, 'CH', 'NW', 'Nidwalden', 220),
	(118, 'CH', 'OW', 'Obwalden', 220),
	(119, 'CH', 'SG', 'St. Gallen', 220),
	(120, 'CH', 'SH', 'Schaffhausen', 220),
	(121, 'CH', 'SO', 'Solothurn', 220),
	(122, 'CH', 'SZ', 'Schwyz', 220),
	(123, 'CH', 'TG', 'Thurgau', 220),
	(124, 'CH', 'TI', 'Tessin', 220),
	(125, 'CH', 'UR', 'Uri', 220),
	(126, 'CH', 'VD', 'Waadt', 220),
	(127, 'CH', 'VS', 'Wallis', 220),
	(128, 'CH', 'ZG', 'Zug', 220),
	(129, 'CH', 'ZH', 'Zürich', 220),
	(130, 'ES', 'A Coruсa', 'A Coruña', 206),
	(131, 'ES', 'Alava', 'Alava', 206),
	(132, 'ES', 'Albacete', 'Albacete', 206),
	(133, 'ES', 'Alicante', 'Alicante', 206),
	(134, 'ES', 'Almeria', 'Almeria', 206),
	(135, 'ES', 'Asturias', 'Asturias', 206),
	(136, 'ES', 'Avila', 'Avila', 206),
	(137, 'ES', 'Badajoz', 'Badajoz', 206),
	(138, 'ES', 'Baleares', 'Baleares', 206),
	(139, 'ES', 'Barcelona', 'Barcelona', 206),
	(140, 'ES', 'Burgos', 'Burgos', 206),
	(141, 'ES', 'Caceres', 'Caceres', 206),
	(142, 'ES', 'Cadiz', 'Cadiz', 206),
	(143, 'ES', 'Cantabria', 'Cantabria', 206),
	(144, 'ES', 'Castellon', 'Castellon', 206),
	(145, 'ES', 'Ceuta', 'Ceuta', 206),
	(146, 'ES', 'Ciudad Real', 'Ciudad Real', 206),
	(147, 'ES', 'Cordoba', 'Cordoba', 206),
	(148, 'ES', 'Cuenca', 'Cuenca', 206),
	(149, 'ES', 'Girona', 'Girona', 206),
	(150, 'ES', 'Granada', 'Granada', 206),
	(151, 'ES', 'Guadalajara', 'Guadalajara', 206),
	(152, 'ES', 'Guipuzcoa', 'Guipuzcoa', 206),
	(153, 'ES', 'Huelva', 'Huelva', 206),
	(154, 'ES', 'Huesca', 'Huesca', 206),
	(155, 'ES', 'Jaen', 'Jaen', 206),
	(156, 'ES', 'La Rioja', 'La Rioja', 206),
	(157, 'ES', 'Las Palmas', 'Las Palmas', 206),
	(158, 'ES', 'Leon', 'Leon', 206),
	(159, 'ES', 'Lleida', 'Lleida', 206),
	(160, 'ES', 'Lugo', 'Lugo', 206),
	(161, 'ES', 'Madrid', 'Madrid', 206),
	(162, 'ES', 'Malaga', 'Malaga', 206),
	(163, 'ES', 'Melilla', 'Melilla', 206),
	(164, 'ES', 'Murcia', 'Murcia', 206),
	(165, 'ES', 'Navarra', 'Navarra', 206),
	(166, 'ES', 'Ourense', 'Ourense', 206),
	(167, 'ES', 'Palencia', 'Palencia', 206),
	(168, 'ES', 'Pontevedra', 'Pontevedra', 206),
	(169, 'ES', 'Salamanca', 'Salamanca', 206),
	(170, 'ES', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 206),
	(171, 'ES', 'Segovia', 'Segovia', 206),
	(172, 'ES', 'Sevilla', 'Sevilla', 206),
	(173, 'ES', 'Soria', 'Soria', 206),
	(174, 'ES', 'Tarragona', 'Tarragona', 206),
	(175, 'ES', 'Teruel', 'Teruel', 206),
	(176, 'ES', 'Toledo', 'Toledo', 206),
	(177, 'ES', 'Valencia', 'Valencia', 206),
	(178, 'ES', 'Valladolid', 'Valladolid', 206),
	(179, 'ES', 'Vizcaya', 'Vizcaya', 206),
	(180, 'ES', 'Zamora', 'Zamora', 206),
	(181, 'ES', 'Zaragoza', 'Zaragoza', 206),
	(182, 'FR', '1', 'Ain', 81),
	(183, 'FR', '2', 'Aisne', 81),
	(184, 'FR', '3', 'Allier', 81),
	(185, 'FR', '4', 'Alpes-de-Haute-Provence', 81),
	(186, 'FR', '5', 'Hautes-Alpes', 81),
	(187, 'FR', '6', 'Alpes-Maritimes', 81),
	(188, 'FR', '7', 'Ardèche', 81),
	(189, 'FR', '8', 'Ardennes', 81),
	(190, 'FR', '9', 'Ariège', 81),
	(191, 'FR', '10', 'Aube', 81),
	(192, 'FR', '11', 'Aude', 81),
	(193, 'FR', '12', 'Aveyron', 81),
	(194, 'FR', '13', 'Bouches-du-Rhône', 81),
	(195, 'FR', '14', 'Calvados', 81),
	(196, 'FR', '15', 'Cantal', 81),
	(197, 'FR', '16', 'Charente', 81),
	(198, 'FR', '17', 'Charente-Maritime', 81),
	(199, 'FR', '18', 'Cher', 81),
	(200, 'FR', '19', 'Corrèze', 81),
	(201, 'FR', '2A', 'Corse-du-Sud', 81),
	(202, 'FR', '2B', 'Haute-Corse', 81),
	(203, 'FR', '21', 'Côte-d\'Or', 81),
	(204, 'FR', '22', 'Côtes-d\'Armor', 81),
	(205, 'FR', '23', 'Creuse', 81),
	(206, 'FR', '24', 'Dordogne', 81),
	(207, 'FR', '25', 'Doubs', 81),
	(208, 'FR', '26', 'Drôme', 81),
	(209, 'FR', '27', 'Eure', 81),
	(210, 'FR', '28', 'Eure-et-Loir', 81),
	(211, 'FR', '29', 'Finistère', 81),
	(212, 'FR', '30', 'Gard', 81),
	(213, 'FR', '31', 'Haute-Garonne', 81),
	(214, 'FR', '32', 'Gers', 81),
	(215, 'FR', '33', 'Gironde', 81),
	(216, 'FR', '34', 'Hérault', 81),
	(217, 'FR', '35', 'Ille-et-Vilaine', 81),
	(218, 'FR', '36', 'Indre', 81),
	(219, 'FR', '37', 'Indre-et-Loire', 81),
	(220, 'FR', '38', 'Isère', 81),
	(221, 'FR', '39', 'Jura', 81),
	(222, 'FR', '40', 'Landes', 81),
	(223, 'FR', '41', 'Loir-et-Cher', 81),
	(224, 'FR', '42', 'Loire', 81),
	(225, 'FR', '43', 'Haute-Loire', 81),
	(226, 'FR', '44', 'Loire-Atlantique', 81),
	(227, 'FR', '45', 'Loiret', 81),
	(228, 'FR', '46', 'Lot', 81),
	(229, 'FR', '47', 'Lot-et-Garonne', 81),
	(230, 'FR', '48', 'Lozère', 81),
	(231, 'FR', '49', 'Maine-et-Loire', 81),
	(232, 'FR', '50', 'Manche', 81),
	(233, 'FR', '51', 'Marne', 81),
	(234, 'FR', '52', 'Haute-Marne', 81),
	(235, 'FR', '53', 'Mayenne', 81),
	(236, 'FR', '54', 'Meurthe-et-Moselle', 81),
	(237, 'FR', '55', 'Meuse', 81),
	(238, 'FR', '56', 'Morbihan', 81),
	(239, 'FR', '57', 'Moselle', 81),
	(240, 'FR', '58', 'Nièvre', 81),
	(241, 'FR', '59', 'Nord', 81),
	(242, 'FR', '60', 'Oise', 81),
	(243, 'FR', '61', 'Orne', 81),
	(244, 'FR', '62', 'Pas-de-Calais', 81),
	(245, 'FR', '63', 'Puy-de-Dôme', 81),
	(246, 'FR', '64', 'Pyrénées-Atlantiques', 81),
	(247, 'FR', '65', 'Hautes-Pyrénées', 81),
	(248, 'FR', '66', 'Pyrénées-Orientales', 81),
	(249, 'FR', '67', 'Bas-Rhin', 81),
	(250, 'FR', '68', 'Haut-Rhin', 81),
	(251, 'FR', '69', 'Rhône', 81),
	(252, 'FR', '70', 'Haute-Saône', 81),
	(253, 'FR', '71', 'Saône-et-Loire', 81),
	(254, 'FR', '72', 'Sarthe', 81),
	(255, 'FR', '73', 'Savoie', 81),
	(256, 'FR', '74', 'Haute-Savoie', 81),
	(257, 'FR', '75', 'Paris', 81),
	(258, 'FR', '76', 'Seine-Maritime', 81),
	(259, 'FR', '77', 'Seine-et-Marne', 81),
	(260, 'FR', '78', 'Yvelines', 81),
	(261, 'FR', '79', 'Deux-Sèvres', 81),
	(262, 'FR', '80', 'Somme', 81),
	(263, 'FR', '81', 'Tarn', 81),
	(264, 'FR', '82', 'Tarn-et-Garonne', 81),
	(265, 'FR', '83', 'Var', 81),
	(266, 'FR', '84', 'Vaucluse', 81),
	(267, 'FR', '85', 'Vendée', 81),
	(268, 'FR', '86', 'Vienne', 81),
	(269, 'FR', '87', 'Haute-Vienne', 81),
	(270, 'FR', '88', 'Vosges', 81),
	(271, 'FR', '89', 'Yonne', 81),
	(272, 'FR', '90', 'Territoire-de-Belfort', 81),
	(273, 'FR', '91', 'Essonne', 81),
	(274, 'FR', '92', 'Hauts-de-Seine', 81),
	(275, 'FR', '93', 'Seine-Saint-Denis', 81),
	(276, 'FR', '94', 'Val-de-Marne', 81),
	(277, 'FR', '95', 'Val-d\'Oise', 81),
	(278, 'RO', 'AB', 'Alba', 185),
	(279, 'RO', 'AR', 'Arad', 185),
	(280, 'RO', 'AG', 'Argeş', 185),
	(281, 'RO', 'BC', 'Bacău', 185),
	(282, 'RO', 'BH', 'Bihor', 185),
	(283, 'RO', 'BN', 'Bistriţa-Năsăud', 185),
	(284, 'RO', 'BT', 'Botoşani', 185),
	(285, 'RO', 'BV', 'Braşov', 185),
	(286, 'RO', 'BR', 'Brăila', 185),
	(287, 'RO', 'B', 'Bucureşti', 185),
	(288, 'RO', 'BZ', 'Buzău', 185),
	(289, 'RO', 'CS', 'Caraş-Severin', 185),
	(290, 'RO', 'CL', 'Călăraşi', 185),
	(291, 'RO', 'CJ', 'Cluj', 185),
	(292, 'RO', 'CT', 'Constanţa', 185),
	(293, 'RO', 'CV', 'Covasna', 185),
	(294, 'RO', 'DB', 'Dâmboviţa', 185),
	(295, 'RO', 'DJ', 'Dolj', 185),
	(296, 'RO', 'GL', 'Galaţi', 185),
	(297, 'RO', 'GR', 'Giurgiu', 185),
	(298, 'RO', 'GJ', 'Gorj', 185),
	(299, 'RO', 'HR', 'Harghita', 185),
	(300, 'RO', 'HD', 'Hunedoara', 185),
	(301, 'RO', 'IL', 'Ialomiţa', 185),
	(302, 'RO', 'IS', 'Iaşi', 185),
	(303, 'RO', 'IF', 'Ilfov', 185),
	(304, 'RO', 'MM', 'Maramureş', 185),
	(305, 'RO', 'MH', 'Mehedinţi', 185),
	(306, 'RO', 'MS', 'Mureş', 185),
	(307, 'RO', 'NT', 'Neamţ', 185),
	(308, 'RO', 'OT', 'Olt', 185),
	(309, 'RO', 'PH', 'Prahova', 185),
	(310, 'RO', 'SM', 'Satu-Mare', 185),
	(311, 'RO', 'SJ', 'Sălaj', 185),
	(312, 'RO', 'SB', 'Sibiu', 185),
	(313, 'RO', 'SV', 'Suceava', 185),
	(314, 'RO', 'TR', 'Teleorman', 185),
	(315, 'RO', 'TM', 'Timiş', 185),
	(316, 'RO', 'TL', 'Tulcea', 185),
	(317, 'RO', 'VS', 'Vaslui', 185),
	(318, 'RO', 'VL', 'Vâlcea', 185),
	(319, 'RO', 'VN', 'Vrancea', 185),
	(320, 'FI', 'Lappi', 'Lappi', 80),
	(321, 'FI', 'Pohjois-Pohjanmaa', 'Pohjois-Pohjanmaa', 80),
	(322, 'FI', 'Kainuu', 'Kainuu', 80),
	(323, 'FI', 'Pohjois-Karjala', 'Pohjois-Karjala', 80),
	(324, 'FI', 'Pohjois-Savo', 'Pohjois-Savo', 80),
	(325, 'FI', 'Etelä-Savo', 'Etelä-Savo', 80),
	(326, 'FI', 'Etelä-Pohjanmaa', 'Etelä-Pohjanmaa', 80),
	(327, 'FI', 'Pohjanmaa', 'Pohjanmaa', 80),
	(328, 'FI', 'Pirkanmaa', 'Pirkanmaa', 80),
	(329, 'FI', 'Satakunta', 'Satakunta', 80),
	(330, 'FI', 'Keski-Pohjanmaa', 'Keski-Pohjanmaa', 80),
	(331, 'FI', 'Keski-Suomi', 'Keski-Suomi', 80),
	(332, 'FI', 'Varsinais-Suomi', 'Varsinais-Suomi', 80),
	(333, 'FI', 'Etelä-Karjala', 'Etelä-Karjala', 80),
	(334, 'FI', 'Päijät-Häme', 'Päijät-Häme', 80),
	(335, 'FI', 'Kanta-Häme', 'Kanta-Häme', 80),
	(336, 'FI', 'Uusimaa', 'Uusimaa', 80),
	(337, 'FI', 'Itä-Uusimaa', 'Itä-Uusimaa', 80),
	(338, 'FI', 'Kymenlaakso', 'Kymenlaakso', 80),
	(339, 'FI', 'Ahvenanmaa', 'Ahvenanmaa', 80),
	(340, 'EE', 'EE-37', 'Harjumaa', 74),
	(341, 'EE', 'EE-39', 'Hiiumaa', 74),
	(342, 'EE', 'EE-44', 'Ida-Virumaa', 74),
	(343, 'EE', 'EE-49', 'Jõgevamaa', 74),
	(344, 'EE', 'EE-51', 'Järvamaa', 74),
	(345, 'EE', 'EE-57', 'Läänemaa', 74),
	(346, 'EE', 'EE-59', 'Lääne-Virumaa', 74),
	(347, 'EE', 'EE-65', 'Põlvamaa', 74),
	(348, 'EE', 'EE-67', 'Pärnumaa', 74),
	(349, 'EE', 'EE-70', 'Raplamaa', 74),
	(350, 'EE', 'EE-74', 'Saaremaa', 74),
	(351, 'EE', 'EE-78', 'Tartumaa', 74),
	(352, 'EE', 'EE-82', 'Valgamaa', 74),
	(353, 'EE', 'EE-84', 'Viljandimaa', 74),
	(354, 'EE', 'EE-86', 'Võrumaa', 74),
	(355, 'LV', 'LV-DGV', 'Daugavpils', 125),
	(356, 'LV', 'LV-JEL', 'Jelgava', 125),
	(357, 'LV', 'Jēkabpils', 'Jēkabpils', 125),
	(358, 'LV', 'LV-JUR', 'Jūrmala', 125),
	(359, 'LV', 'LV-LPX', 'Liepāja', 125),
	(360, 'LV', 'LV-LE', 'Liepājas novads', 125),
	(361, 'LV', 'LV-REZ', 'Rēzekne', 125),
	(362, 'LV', 'LV-RIX', 'Rīga', 125),
	(363, 'LV', 'LV-RI', 'Rīgas novads', 125),
	(364, 'LV', 'Valmiera', 'Valmiera', 125),
	(365, 'LV', 'LV-VEN', 'Ventspils', 125),
	(366, 'LV', 'Aglonas novads', 'Aglonas novads', 125),
	(367, 'LV', 'LV-AI', 'Aizkraukles novads', 125),
	(368, 'LV', 'Aizputes novads', 'Aizputes novads', 125),
	(369, 'LV', 'Aknīstes novads', 'Aknīstes novads', 125),
	(370, 'LV', 'Alojas novads', 'Alojas novads', 125),
	(371, 'LV', 'Alsungas novads', 'Alsungas novads', 125),
	(372, 'LV', 'LV-AL', 'Alūksnes novads', 125),
	(373, 'LV', 'Amatas novads', 'Amatas novads', 125),
	(374, 'LV', 'Apes novads', 'Apes novads', 125),
	(375, 'LV', 'Auces novads', 'Auces novads', 125),
	(376, 'LV', 'Babītes novads', 'Babītes novads', 125),
	(377, 'LV', 'Baldones novads', 'Baldones novads', 125),
	(378, 'LV', 'Baltinavas novads', 'Baltinavas novads', 125),
	(379, 'LV', 'LV-BL', 'Balvu novads', 125),
	(380, 'LV', 'LV-BU', 'Bauskas novads', 125),
	(381, 'LV', 'Beverīnas novads', 'Beverīnas novads', 125),
	(382, 'LV', 'Brocēnu novads', 'Brocēnu novads', 125),
	(383, 'LV', 'Burtnieku novads', 'Burtnieku novads', 125),
	(384, 'LV', 'Carnikavas novads', 'Carnikavas novads', 125),
	(385, 'LV', 'Cesvaines novads', 'Cesvaines novads', 125),
	(386, 'LV', 'Ciblas novads', 'Ciblas novads', 125),
	(387, 'LV', 'LV-CE', 'Cēsu novads', 125),
	(388, 'LV', 'Dagdas novads', 'Dagdas novads', 125),
	(389, 'LV', 'LV-DA', 'Daugavpils novads', 125),
	(390, 'LV', 'LV-DO', 'Dobeles novads', 125),
	(391, 'LV', 'Dundagas novads', 'Dundagas novads', 125),
	(392, 'LV', 'Durbes novads', 'Durbes novads', 125),
	(393, 'LV', 'Engures novads', 'Engures novads', 125),
	(394, 'LV', 'Garkalnes novads', 'Garkalnes novads', 125),
	(395, 'LV', 'Grobiņas novads', 'Grobiņas novads', 125),
	(396, 'LV', 'LV-GU', 'Gulbenes novads', 125),
	(397, 'LV', 'Iecavas novads', 'Iecavas novads', 125),
	(398, 'LV', 'Ikšķiles novads', 'Ikšķiles novads', 125),
	(399, 'LV', 'Ilūkstes novads', 'Ilūkstes novads', 125),
	(400, 'LV', 'Inčukalna novads', 'Inčukalna novads', 125),
	(401, 'LV', 'Jaunjelgavas novads', 'Jaunjelgavas novads', 125),
	(402, 'LV', 'Jaunpiebalgas novads', 'Jaunpiebalgas novads', 125),
	(403, 'LV', 'Jaunpils novads', 'Jaunpils novads', 125),
	(404, 'LV', 'LV-JL', 'Jelgavas novads', 125),
	(405, 'LV', 'LV-JK', 'Jēkabpils novads', 125),
	(406, 'LV', 'Kandavas novads', 'Kandavas novads', 125),
	(407, 'LV', 'Kokneses novads', 'Kokneses novads', 125),
	(408, 'LV', 'Krimuldas novads', 'Krimuldas novads', 125),
	(409, 'LV', 'Krustpils novads', 'Krustpils novads', 125),
	(410, 'LV', 'LV-KR', 'Krāslavas novads', 125),
	(411, 'LV', 'LV-KU', 'Kuldīgas novads', 125),
	(412, 'LV', 'Kārsavas novads', 'Kārsavas novads', 125),
	(413, 'LV', 'Lielvārdes novads', 'Lielvārdes novads', 125),
	(414, 'LV', 'LV-LM', 'Limbažu novads', 125),
	(415, 'LV', 'Lubānas novads', 'Lubānas novads', 125),
	(416, 'LV', 'LV-LU', 'Ludzas novads', 125),
	(417, 'LV', 'Līgatnes novads', 'Līgatnes novads', 125),
	(418, 'LV', 'Līvānu novads', 'Līvānu novads', 125),
	(419, 'LV', 'LV-MA', 'Madonas novads', 125),
	(420, 'LV', 'Mazsalacas novads', 'Mazsalacas novads', 125),
	(421, 'LV', 'Mālpils novads', 'Mālpils novads', 125),
	(422, 'LV', 'Mārupes novads', 'Mārupes novads', 125),
	(423, 'LV', 'Naukšēnu novads', 'Naukšēnu novads', 125),
	(424, 'LV', 'Neretas novads', 'Neretas novads', 125),
	(425, 'LV', 'Nīcas novads', 'Nīcas novads', 125),
	(426, 'LV', 'LV-OG', 'Ogres novads', 125),
	(427, 'LV', 'Olaines novads', 'Olaines novads', 125),
	(428, 'LV', 'Ozolnieku novads', 'Ozolnieku novads', 125),
	(429, 'LV', 'LV-PR', 'Preiļu novads', 125),
	(430, 'LV', 'Priekules novads', 'Priekules novads', 125),
	(431, 'LV', 'Priekuļu novads', 'Priekuļu novads', 125),
	(432, 'LV', 'Pārgaujas novads', 'Pārgaujas novads', 125),
	(433, 'LV', 'Pāvilostas novads', 'Pāvilostas novads', 125),
	(434, 'LV', 'Pļaviņu novads', 'Pļaviņu novads', 125),
	(435, 'LV', 'Raunas novads', 'Raunas novads', 125),
	(436, 'LV', 'Riebiņu novads', 'Riebiņu novads', 125),
	(437, 'LV', 'Rojas novads', 'Rojas novads', 125),
	(438, 'LV', 'Ropažu novads', 'Ropažu novads', 125),
	(439, 'LV', 'Rucavas novads', 'Rucavas novads', 125),
	(440, 'LV', 'Rugāju novads', 'Rugāju novads', 125),
	(441, 'LV', 'Rundāles novads', 'Rundāles novads', 125),
	(442, 'LV', 'LV-RE', 'Rēzeknes novads', 125),
	(443, 'LV', 'Rūjienas novads', 'Rūjienas novads', 125),
	(444, 'LV', 'Salacgrīvas novads', 'Salacgrīvas novads', 125),
	(445, 'LV', 'Salas novads', 'Salas novads', 125),
	(446, 'LV', 'Salaspils novads', 'Salaspils novads', 125),
	(447, 'LV', 'LV-SA', 'Saldus novads', 125),
	(448, 'LV', 'Saulkrastu novads', 'Saulkrastu novads', 125),
	(449, 'LV', 'Siguldas novads', 'Siguldas novads', 125),
	(450, 'LV', 'Skrundas novads', 'Skrundas novads', 125),
	(451, 'LV', 'Skrīveru novads', 'Skrīveru novads', 125),
	(452, 'LV', 'Smiltenes novads', 'Smiltenes novads', 125),
	(453, 'LV', 'Stopiņu novads', 'Stopiņu novads', 125),
	(454, 'LV', 'Strenču novads', 'Strenču novads', 125),
	(455, 'LV', 'Sējas novads', 'Sējas novads', 125),
	(456, 'LV', 'LV-TA', 'Talsu novads', 125),
	(457, 'LV', 'LV-TU', 'Tukuma novads', 125),
	(458, 'LV', 'Tērvetes novads', 'Tērvetes novads', 125),
	(459, 'LV', 'Vaiņodes novads', 'Vaiņodes novads', 125),
	(460, 'LV', 'LV-VK', 'Valkas novads', 125),
	(461, 'LV', 'LV-VM', 'Valmieras novads', 125),
	(462, 'LV', 'Varakļānu novads', 'Varakļānu novads', 125),
	(463, 'LV', 'Vecpiebalgas novads', 'Vecpiebalgas novads', 125),
	(464, 'LV', 'Vecumnieku novads', 'Vecumnieku novads', 125),
	(465, 'LV', 'LV-VE', 'Ventspils novads', 125),
	(466, 'LV', 'Viesītes novads', 'Viesītes novads', 125),
	(467, 'LV', 'Viļakas novads', 'Viļakas novads', 125),
	(468, 'LV', 'Viļānu novads', 'Viļānu novads', 125),
	(469, 'LV', 'Vārkavas novads', 'Vārkavas novads', 125),
	(470, 'LV', 'Zilupes novads', 'Zilupes novads', 125),
	(471, 'LV', 'Ādažu novads', 'Ādažu novads', 125),
	(472, 'LV', 'Ērgļu novads', 'Ērgļu novads', 125),
	(473, 'LV', 'Ķeguma novads', 'Ķeguma novads', 125),
	(474, 'LV', 'Ķekavas novads', 'Ķekavas novads', 125),
	(475, 'LT', 'LT-AL', 'Alytaus Apskritis', 131),
	(476, 'LT', 'LT-KU', 'Kauno Apskritis', 131),
	(477, 'LT', 'LT-KL', 'Klaipėdos Apskritis', 131),
	(478, 'LT', 'LT-MR', 'Marijampolės Apskritis', 131),
	(479, 'LT', 'LT-PN', 'Panevėžio Apskritis', 131),
	(480, 'LT', 'LT-SA', 'Šiaulių Apskritis', 131),
	(481, 'LT', 'LT-TA', 'Tauragės Apskritis', 131),
	(482, 'LT', 'LT-TE', 'Telšių Apskritis', 131),
	(483, 'LT', 'LT-UT', 'Utenos Apskritis', 131),
	(484, 'LT', 'LT-VL', 'Vilniaus Apskritis', 131),
	(485, 'BR', 'AC', 'Acre', 31),
	(486, 'BR', 'AL', 'Alagoas', 31),
	(487, 'BR', 'AP', 'Amapá', 31),
	(488, 'BR', 'AM', 'Amazonas', 31),
	(489, 'BR', 'BA', 'Bahia', 31),
	(490, 'BR', 'CE', 'Ceará', 31),
	(491, 'BR', 'ES', 'Espírito Santo', 31),
	(492, 'BR', 'GO', 'Goiás', 31),
	(493, 'BR', 'MA', 'Maranhão', 31),
	(494, 'BR', 'MT', 'Mato Grosso', 31),
	(495, 'BR', 'MS', 'Mato Grosso do Sul', 31),
	(496, 'BR', 'MG', 'Minas Gerais', 31),
	(497, 'BR', 'PA', 'Pará', 31),
	(498, 'BR', 'PB', 'Paraíba', 31),
	(499, 'BR', 'PR', 'Paraná', 31),
	(500, 'BR', 'PE', 'Pernambuco', 31),
	(501, 'BR', 'PI', 'Piauí', 31),
	(502, 'BR', 'RJ', 'Rio de Janeiro', 31),
	(503, 'BR', 'RN', 'Rio Grande do Norte', 31),
	(504, 'BR', 'RS', 'Rio Grande do Sul', 31),
	(505, 'BR', 'RO', 'Rondônia', 31),
	(506, 'BR', 'RR', 'Roraima', 31),
	(507, 'BR', 'SC', 'Santa Catarina', 31),
	(508, 'BR', 'SP', 'São Paulo', 31),
	(509, 'BR', 'SE', 'Sergipe', 31),
	(510, 'BR', 'TO', 'Tocantins', 31),
	(511, 'BR', 'DF', 'Distrito Federal', 31),
	(512, 'HR', 'HR-01', 'Zagrebačka županija', 59),
	(513, 'HR', 'HR-02', 'Krapinsko-zagorska županija', 59),
	(514, 'HR', 'HR-03', 'Sisačko-moslavačka županija', 59),
	(515, 'HR', 'HR-04', 'Karlovačka županija', 59),
	(516, 'HR', 'HR-05', 'Varaždinska županija', 59),
	(517, 'HR', 'HR-06', 'Koprivničko-križevačka županija', 59),
	(518, 'HR', 'HR-07', 'Bjelovarsko-bilogorska županija', 59),
	(519, 'HR', 'HR-08', 'Primorsko-goranska županija', 59),
	(520, 'HR', 'HR-09', 'Ličko-senjska županija', 59),
	(521, 'HR', 'HR-10', 'Virovitičko-podravska županija', 59),
	(522, 'HR', 'HR-11', 'Požeško-slavonska županija', 59),
	(523, 'HR', 'HR-12', 'Brodsko-posavska županija', 59),
	(524, 'HR', 'HR-13', 'Zadarska županija', 59),
	(525, 'HR', 'HR-14', 'Osječko-baranjska županija', 59),
	(526, 'HR', 'HR-15', 'Šibensko-kninska županija', 59),
	(527, 'HR', 'HR-16', 'Vukovarsko-srijemska županija', 59),
	(528, 'HR', 'HR-17', 'Splitsko-dalmatinska županija', 59),
	(529, 'HR', 'HR-18', 'Istarska županija', 59),
	(530, 'HR', 'HR-19', 'Dubrovačko-neretvanska županija', 59),
	(531, 'HR', 'HR-20', 'Međimurska županija', 59),
	(532, 'HR', 'HR-21', 'Grad Zagreb', 59),
	(533, 'IN', 'AN', 'Andaman and Nicobar Islands', 106),
	(534, 'IN', 'AP', 'Andhra Pradesh', 106),
	(535, 'IN', 'AR', 'Arunachal Pradesh', 106),
	(536, 'IN', 'AS', 'Assam', 106),
	(537, 'IN', 'BR', 'Bihar', 106),
	(538, 'IN', 'CH', 'Chandigarh', 106),
	(539, 'IN', 'CT', 'Chhattisgarh', 106),
	(540, 'IN', 'DN', 'Dadra and Nagar Haveli', 106),
	(541, 'IN', 'DD', 'Daman and Diu', 106),
	(542, 'IN', 'DL', 'Delhi', 106),
	(543, 'IN', 'GA', 'Goa', 106),
	(544, 'IN', 'GJ', 'Gujarat', 106),
	(545, 'IN', 'HR', 'Haryana', 106),
	(546, 'IN', 'HP', 'Himachal Pradesh', 106),
	(547, 'IN', 'JK', 'Jammu and Kashmir', 106),
	(548, 'IN', 'JH', 'Jharkhand', 106),
	(549, 'IN', 'KA', 'Karnataka', 106),
	(550, 'IN', 'KL', 'Kerala', 106),
	(551, 'IN', 'LD', 'Lakshadweep', 106),
	(552, 'IN', 'MP', 'Madhya Pradesh', 106),
	(553, 'IN', 'MH', 'Maharashtra', 106),
	(554, 'IN', 'MN', 'Manipur', 106),
	(555, 'IN', 'ML', 'Meghalaya', 106),
	(556, 'IN', 'MZ', 'Mizoram', 106),
	(557, 'IN', 'NL', 'Nagaland', 106),
	(558, 'IN', 'OR', 'Odisha', 106),
	(559, 'IN', 'PY', 'Puducherry', 106),
	(560, 'IN', 'PB', 'Punjab', 106),
	(561, 'IN', 'RJ', 'Rajasthan', 106),
	(562, 'IN', 'SK', 'Sikkim', 106),
	(563, 'IN', 'TN', 'Tamil Nadu', 106),
	(564, 'IN', 'TG', 'Telangana', 106),
	(565, 'IN', 'TR', 'Tripura', 106),
	(566, 'IN', 'UP', 'Uttar Pradesh', 106),
	(567, 'IN', 'UT', 'Uttarakhand', 106),
	(568, 'IN', 'WB', 'West Bengal', 106);
/*!40000 ALTER TABLE `country_states` ENABLE KEYS */;

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_since` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wp_emailed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_since` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wp_emailed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `tags`, `email`, `producer`, `policies`, `customer_since`, `wp_emailed`, `task_count`, `created_at`, `updated_at`) VALUES
	(13, 'David', '"David"', 'david@gmail.com', 'Products', 'This is a test', '2022-03-04', NULL, '0', '2022-03-03 15:37:35', '2022-03-03 15:37:35');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `folders` json DEFAULT NULL,
  `from` json DEFAULT NULL,
  `sender` json DEFAULT NULL,
  `reply_to` json DEFAULT NULL,
  `cc` json DEFAULT NULL,
  `bcc` json DEFAULT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_ids` json DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  `lead_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emails_message_id_unique` (`message_id`),
  UNIQUE KEY `emails_unique_id_unique` (`unique_id`),
  KEY `emails_person_id_foreign` (`person_id`),
  KEY `emails_lead_id_foreign` (`lead_id`),
  KEY `emails_parent_id_foreign` (`parent_id`),
  CONSTRAINT `emails_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `emails_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE,
  CONSTRAINT `emails_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;

DROP TABLE IF EXISTS `email_attachments`;
CREATE TABLE IF NOT EXISTS `email_attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_attachments_email_id_foreign` (`email_id`),
  CONSTRAINT `email_attachments_email_id_foreign` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `email_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_attachments` ENABLE KEYS */;

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` (`id`, `name`, `subject`, `content`, `created_at`, `updated_at`) VALUES
	(1, 'Activity created', 'Activity created: {%activities.title%}', '<p style="font-size: 16px; color: #5e5e5e;">You have a new activity, please find the details bellow:</p>\n                                <p><strong style="font-size: 16px;">Details</strong></p>\n                                <table style="height: 97px; width: 952px;">\n                                    <tbody>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Title</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.title%}</td>\n                                        </tr>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Type</td>\n                                                <td style="width: 770.047px; font-size: 16px;">{%activities.type%}</td>\n                                        </tr>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Date</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.schedule_from%} to&nbsp;{%activities.schedule_to%}</td>\n                                        </tr>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px; vertical-align: text-top;">Participants</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.participants%}</td>\n                                        </tr>\n                                    </tbody>\n                                </table>', '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(2, 'Activity modified', 'Activity modified: {%activities.title%}', '<p style="font-size: 16px; color: #5e5e5e;">This activity has been modified, please find the details bellow:</p>\n                                <p><strong style="font-size: 16px;">Details</strong></p>\n                                <table style="height: 97px; width: 952px;">\n                                    <tbody>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Title</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.title%}</td>\n                                        </tr>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Type</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.type%}</td>\n                                        </tr>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Date</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.schedule_from%} to&nbsp;{%activities.schedule_to%}</td>\n                                        </tr>\n                                        <tr>\n                                            <td style="width: 116.953px; color: #546e7a; font-size: 16px; vertical-align: text-top;">Participants</td>\n                                            <td style="width: 770.047px; font-size: 16px;">{%activities.participants%}</td>\n                                        </tr>\n                                    </tbody>\n                                </table>', '2022-02-16 18:11:04', '2022-02-16 18:11:04');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `lead_value` decimal(12,4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `lost_reason` text COLLATE utf8mb4_unicode_ci,
  `closed_at` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `lead_source_id` int(10) unsigned NOT NULL,
  `lead_type_id` int(10) unsigned NOT NULL,
  `lead_pipeline_id` int(10) unsigned DEFAULT NULL,
  `lead_pipeline_stage_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expected_close_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_user_id_foreign` (`user_id`),
  KEY `leads_person_id_foreign` (`person_id`),
  KEY `leads_lead_source_id_foreign` (`lead_source_id`),
  KEY `leads_lead_type_id_foreign` (`lead_type_id`),
  KEY `leads_lead_pipeline_id_foreign` (`lead_pipeline_id`),
  KEY `leads_lead_pipeline_stage_id_foreign` (`lead_pipeline_stage_id`),
  CONSTRAINT `leads_lead_pipeline_id_foreign` FOREIGN KEY (`lead_pipeline_id`) REFERENCES `lead_pipelines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_lead_pipeline_stage_id_foreign` FOREIGN KEY (`lead_pipeline_stage_id`) REFERENCES `lead_pipeline_stages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `leads_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `lead_sources` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_lead_type_id_foreign` FOREIGN KEY (`lead_type_id`) REFERENCES `lead_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` (`id`, `title`, `description`, `lead_value`, `status`, `lost_reason`, `closed_at`, `user_id`, `person_id`, `lead_source_id`, `lead_type_id`, `lead_pipeline_id`, `lead_pipeline_stage_id`, `created_at`, `updated_at`, `expected_close_date`) VALUES
	(1, 'test', 'test', 200.0000, 1, NULL, NULL, 1, 2, 1, 1, 1, 1, '2022-02-18 04:31:26', '2022-03-05 04:30:46', '2022-02-21');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_activities`;
CREATE TABLE IF NOT EXISTS `lead_activities` (
  `activity_id` int(10) unsigned NOT NULL,
  `lead_id` int(10) unsigned NOT NULL,
  KEY `lead_activities_activity_id_foreign` (`activity_id`),
  KEY `lead_activities_lead_id_foreign` (`lead_id`),
  CONSTRAINT `lead_activities_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lead_activities_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_activities` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_pipelines`;
CREATE TABLE IF NOT EXISTS `lead_pipelines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `rotten_days` int(11) NOT NULL DEFAULT '30',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_pipelines` DISABLE KEYS */;
INSERT INTO `lead_pipelines` (`id`, `name`, `is_default`, `rotten_days`, `created_at`, `updated_at`) VALUES
	(1, 'Default Pipeline', 1, 30, '2022-02-16 18:11:04', '2022-02-16 18:11:04');
/*!40000 ALTER TABLE `lead_pipelines` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_pipeline_stages`;
CREATE TABLE IF NOT EXISTS `lead_pipeline_stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `probability` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `lead_pipeline_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lead_pipeline_stages_code_lead_pipeline_id_unique` (`code`,`lead_pipeline_id`),
  UNIQUE KEY `lead_pipeline_stages_name_lead_pipeline_id_unique` (`name`,`lead_pipeline_id`),
  KEY `lead_pipeline_stages_lead_pipeline_id_foreign` (`lead_pipeline_id`),
  CONSTRAINT `lead_pipeline_stages_lead_pipeline_id_foreign` FOREIGN KEY (`lead_pipeline_id`) REFERENCES `lead_pipelines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_pipeline_stages` DISABLE KEYS */;
INSERT INTO `lead_pipeline_stages` (`id`, `code`, `name`, `probability`, `sort_order`, `lead_pipeline_id`) VALUES
	(1, 'new', 'New', 100, 1, 1),
	(2, 'contracted', 'Contracted', 100, 2, 1),
	(3, 'waiting-on-quote', 'Waiting on Quote', 100, 3, 1),
	(4, 'quoted', 'Quoted', 100, 4, 1),
	(5, 'quoted-hot', 'Quoted HOT', 100, 5, 1),
	(6, 'sold', 'Sold', 0, 6, 1);
/*!40000 ALTER TABLE `lead_pipeline_stages` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_products`;
CREATE TABLE IF NOT EXISTS `lead_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` decimal(12,4) DEFAULT NULL,
  `amount` decimal(12,4) DEFAULT NULL,
  `lead_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_products_lead_id_foreign` (`lead_id`),
  KEY `lead_products_product_id_foreign` (`product_id`),
  CONSTRAINT `lead_products_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lead_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_products` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_quotes`;
CREATE TABLE IF NOT EXISTS `lead_quotes` (
  `quote_id` int(10) unsigned NOT NULL,
  `lead_id` int(10) unsigned NOT NULL,
  KEY `lead_quotes_quote_id_foreign` (`quote_id`),
  KEY `lead_quotes_lead_id_foreign` (`lead_id`),
  CONSTRAINT `lead_quotes_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lead_quotes_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_quotes` DISABLE KEYS */;
INSERT INTO `lead_quotes` (`quote_id`, `lead_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `lead_quotes` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_sources`;
CREATE TABLE IF NOT EXISTS `lead_sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_sources` DISABLE KEYS */;
INSERT INTO `lead_sources` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Email', '2022-02-16 18:11:04', '2022-02-16 18:11:04');
/*!40000 ALTER TABLE `lead_sources` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_stages`;
CREATE TABLE IF NOT EXISTS `lead_stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_stages` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_stages` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_tags`;
CREATE TABLE IF NOT EXISTS `lead_tags` (
  `tag_id` int(10) unsigned NOT NULL,
  `lead_id` int(10) unsigned NOT NULL,
  KEY `lead_tags_tag_id_foreign` (`tag_id`),
  KEY `lead_tags_lead_id_foreign` (`lead_id`),
  CONSTRAINT `lead_tags_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lead_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_tags` ENABLE KEYS */;

DROP TABLE IF EXISTS `lead_types`;
CREATE TABLE IF NOT EXISTS `lead_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `lead_types` DISABLE KEYS */;
INSERT INTO `lead_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'New Business', '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(2, 'Existing Business', '2022-02-16 18:11:04', '2022-02-16 18:11:04');
/*!40000 ALTER TABLE `lead_types` ENABLE KEYS */;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_08_19_000000_create_failed_jobs_table', 1),
	(2, '2021_03_12_060658_create_core_config_table', 1),
	(3, '2021_03_12_074578_create_groups_table', 1),
	(4, '2021_03_12_074597_create_roles_table', 1),
	(5, '2021_03_12_074857_create_users_table', 1),
	(6, '2021_03_12_074867_create_user_groups_table', 1),
	(7, '2021_03_12_074957_create_user_password_resets_table', 1),
	(8, '2021_04_02_080709_create_attributes_table', 1),
	(9, '2021_04_02_080837_create_attribute_options_table', 1),
	(10, '2021_04_06_122751_create_attribute_values_table', 1),
	(11, '2021_04_09_051326_create_organizations_table', 1),
	(12, '2021_04_09_065617_create_persons_table', 1),
	(13, '2021_04_09_065617_create_products_table', 1),
	(14, '2021_04_12_173232_create_countries_table', 1),
	(15, '2021_04_12_173344_create_country_states_table', 1),
	(16, '2021_04_21_172825_create_lead_sources_table', 1),
	(17, '2021_04_21_172847_create_lead_types_table', 1),
	(18, '2021_04_22_153258_create_lead_stages_table', 1),
	(19, '2021_04_22_155706_create_lead_pipelines_table', 1),
	(20, '2021_04_22_155838_create_lead_pipeline_stages_table', 1),
	(21, '2021_04_22_164215_create_leads_table', 1),
	(22, '2021_04_22_171805_create_lead_products_table', 1),
	(23, '2021_05_12_150329_create_activities_table', 1),
	(24, '2021_05_12_150329_create_lead_activities_table', 1),
	(25, '2021_05_15_151855_create_activity_files_table', 1),
	(26, '2021_05_20_141230_create_tags_table', 1),
	(27, '2021_05_20_141240_create_lead_tags_table', 1),
	(28, '2021_05_24_075618_create_emails_table', 1),
	(29, '2021_05_25_072700_create_email_attachments_table', 1),
	(30, '2021_06_07_162808_add_lead_view_permission_column_in_users_table', 1),
	(31, '2021_07_01_230345_create_quotes_table', 1),
	(32, '2021_07_01_231317_create_quote_items_table', 1),
	(33, '2021_07_02_201822_create_lead_quotes_table', 1),
	(34, '2021_07_28_142453_create_activity_participants_table', 1),
	(35, '2021_08_26_133538_create_workflows_table', 1),
	(36, '2021_09_03_172713_create_email_templates_table', 1),
	(37, '2021_09_22_194103_add_unique_index_to_name_in_organizations_table', 1),
	(38, '2021_09_22_194622_add_unique_index_to_name_in_groups_table', 1),
	(39, '2021_09_23_221138_add_column_expected_close_date_in_leads_table', 1),
	(40, '2021_09_30_135857_add_column_rotten_days_in_lead_pipelines_table', 1),
	(41, '2021_09_30_154222_alter_lead_pipeline_stages_table', 1),
	(42, '2021_09_30_161722_alter_leads_table', 1),
	(43, '2021_09_30_183825_change_user_id_to_nullable_in_leads_table', 1),
	(44, '2021_10_02_170105_insert_expected_closed_date_column_in_attributes_table', 1),
	(45, '2021_11_11_180804_change_lead_pipeline_stage_id_constraint_in_leads_table', 1),
	(46, '2021_11_12_171510_add_image_column_in_users_table', 1),
	(47, '2021_11_17_190943_add_location_column_in_activities_table', 1),
	(48, '2022_03_01_173453_create_tasks_table', 2),
	(50, '2022_03_03_092341_create_customer_table', 3),
	(51, '2022_03_03_110133_create_customers_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizations_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emails` json NOT NULL,
  `contact_numbers` json DEFAULT NULL,
  `organization_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `persons_organization_id_foreign` (`organization_id`),
  CONSTRAINT `persons_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` (`id`, `name`, `emails`, `contact_numbers`, `organization_id`, `created_at`, `updated_at`) VALUES
	(1, 'ali', '[{"label": "work", "value": "ali@gmail.com"}]', '[{"label": "work", "value": "+93744227255"}]', NULL, '2022-02-18 04:31:26', '2022-02-18 04:31:26'),
	(2, 'steve', '[{"label": "work", "value": "steve@gmail.com"}]', '[{"label": "work", "value": "066666666"}]', NULL, '2022-02-19 05:58:57', '2022-02-19 05:58:57');
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` decimal(12,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `sku`, `name`, `description`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, '1001', 'clothes', 'cloths', 11, 111.0000, '2022-02-19 10:52:53', '2022-02-19 10:52:53');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` json DEFAULT NULL,
  `shipping_address` json DEFAULT NULL,
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT NULL,
  `tax_amount` decimal(12,4) DEFAULT NULL,
  `adjustment_amount` decimal(12,4) DEFAULT NULL,
  `sub_total` decimal(12,4) DEFAULT NULL,
  `grand_total` decimal(12,4) DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotes_person_id_foreign` (`person_id`),
  KEY `quotes_user_id_foreign` (`user_id`),
  CONSTRAINT `quotes_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quotes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` (`id`, `subject`, `description`, `billing_address`, `shipping_address`, `discount_percent`, `discount_amount`, `tax_amount`, `adjustment_amount`, `sub_total`, `grand_total`, `expired_at`, `person_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'kabul', 'kabul', '{"city": "kabul", "state": "kabul", "address": "kabul", "country": "AF", "postcode": "1001"}', '{"city": "kabul", "state": "kabul", "address": "kabul", "country": "AF", "postcode": "kabul"}', 0.0000, 2.0000, 1.0000, 0.0000, 1221.0000, 1220.0000, '2022-02-21 00:00:00', 2, 1, '2022-02-19 10:54:21', '2022-02-19 10:54:21');
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;

DROP TABLE IF EXISTS `quote_items`;
CREATE TABLE IF NOT EXISTS `quote_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `tax_percent` decimal(12,4) DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_id` int(10) unsigned NOT NULL,
  `quote_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_items_quote_id_foreign` (`quote_id`),
  CONSTRAINT `quote_items_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
INSERT INTO `quote_items` (`id`, `sku`, `name`, `quantity`, `price`, `coupon_code`, `discount_percent`, `discount_amount`, `tax_percent`, `tax_amount`, `total`, `product_id`, `quote_id`, `created_at`, `updated_at`) VALUES
	(1, '1001', 'clothes', 11, 111.0000, NULL, 0.0000, 2.0000, 0.0000, 1.0000, 1221.0000, 1, 1, '2022-02-19 10:54:21', '2022-02-19 10:54:21');
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`, `permission_type`, `permissions`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'Administrator role', 'all', NULL, NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tags_user_id_foreign` (`user_id`),
  CONSTRAINT `tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_notification` tinyint(1) DEFAULT NULL,
  `associate_with` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `subtask` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `title`, `date`, `time`, `duration`, `location`, `assign_to`, `link_to`, `notification_from`, `send_notification`, `associate_with`, `invite`, `notes`, `subtask`, `created_at`, `updated_at`) VALUES
	(1, 'Call', '2022-03-02', '20:25:00', '1', 'NYC', '"1"', NULL, '1', 1, '1', '["1","2"]', 'This is a test', '"this is a test"', '2022-03-02 21:24:47', '2022-03-02 21:24:47');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `view_permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'global',
  `role_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `view_permission`, `role_id`, `remember_token`, `created_at`, `updated_at`, `image`) VALUES
	(1, 'Steve', 'admin@example.com', '$2y$10$q8/c4WBHvR6tnT5ri8B2pO05WzG1zYINzw9YR55iIK8OfhhnK5QC2', 1, 'global', 1, NULL, '2022-02-16 18:11:05', '2022-02-19 12:42:21', 'users/1/YCaEwYciRf68yzcWl9UN2aR9nJtTUwgzlUrFeBmI.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `group_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `user_groups_group_id_foreign` (`group_id`),
  KEY `user_groups_user_id_foreign` (`user_id`),
  CONSTRAINT `user_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;

DROP TABLE IF EXISTS `user_password_resets`;
CREATE TABLE IF NOT EXISTS `user_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `user_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `user_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_password_resets` ENABLE KEYS */;

DROP TABLE IF EXISTS `workflows`;
CREATE TABLE IF NOT EXISTS `workflows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'and',
  `conditions` json DEFAULT NULL,
  `actions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `workflows` DISABLE KEYS */;
INSERT INTO `workflows` (`id`, `name`, `description`, `entity_type`, `event`, `condition_type`, `conditions`, `actions`, `created_at`, `updated_at`) VALUES
	(1, 'Emails to participants after activity creation', 'Emails to participants after activity creation', 'activities', 'activity.create.after', 'and', '[{"value": ["call", "meeting", "lunch"], "operator": "{}", "attribute": "type", "attribute_type": "multiselect"}]', '[{"id": "send_email_to_participants", "value": "1"}]', '2022-02-16 18:11:04', '2022-02-16 18:11:04'),
	(2, 'Emails to participants after activity updation', 'Emails to participants after activity updation', 'activities', 'activity.update.after', 'and', '[{"value": ["call", "meeting", "lunch"], "operator": "{}", "attribute": "type", "attribute_type": "multiselect"}]', '[{"id": "send_email_to_participants", "value": "2"}]', '2022-02-16 18:11:04', '2022-02-16 18:11:04');
/*!40000 ALTER TABLE `workflows` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
