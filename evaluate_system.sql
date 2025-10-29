-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2025 at 01:49 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluate_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `competencies`
--

DROP TABLE IF EXISTS `competencies`;
CREATE TABLE IF NOT EXISTS `competencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competency_created_by_foreign` (`created_by`),
  KEY `competency_updated_by_foreign` (`updated_by`),
  KEY `competency_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competencies`
--

INSERT INTO `competencies` (`id`, `name_en`, `name_ar`, `department_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Leadership', 'القيادة', 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Teamwork', 'العمل الجماعي', 2, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_created_by_foreign` (`created_by`),
  KEY `department_updated_by_foreign` (`updated_by`),
  KEY `department_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name_en`, `name_ar`, `manager_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Human Resources', 'الموارد البشرية', 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'IT Department', 'قسم تقنية المعلومات', 2, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_position_id_foreign` (`position_id`),
  KEY `employee_department_id_foreign` (`department_id`),
  KEY `employee_created_by_foreign` (`created_by`),
  KEY `employee_updated_by_foreign` (`updated_by`),
  KEY `employee_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name_en`, `name_ar`, `start_date`, `position_id`, `user_id`, `manager_id`, `department_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Ali', 'أحمد علي', '2022-01-10', 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Sara Hassan', 'سارة حسن', '2023-03-01', 3, 2, 1, 2, 1, 1, NULL, NULL, NULL, NULL),
(3, 'ِAli Ahmed', 'علي أحمد', '2025-06-01', 2, 3, 2, 2, 1, 1, NULL, NULL, NULL, NULL),
(4, 'Mary William', 'ماري وليم', '2025-10-01', 4, 4, 2, 2, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_competencies_evaluation`
--

DROP TABLE IF EXISTS `employee_competencies_evaluation`;
CREATE TABLE IF NOT EXISTS `employee_competencies_evaluation` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `competency_id` bigint(20) UNSIGNED NOT NULL,
  `score` enum('Needs Improvement','Below Expectations','Meets Expectations','Above Expectations','Exceeds Expectations') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_competencies_evaluation_employee_id_foreign` (`employee_id`),
  KEY `employee_competencies_evaluation_competency_id_foreign` (`competency_id`),
  KEY `employee_competencies_evaluation_created_by_foreign` (`created_by`),
  KEY `employee_competencies_evaluation_updated_by_foreign` (`updated_by`),
  KEY `employee_competencies_evaluation_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_kpis_evaluation`
--

DROP TABLE IF EXISTS `employee_kpis_evaluation`;
CREATE TABLE IF NOT EXISTS `employee_kpis_evaluation` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `kpi_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `weighted_score` double(8,2) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_kpis_evaluation_employee_id_foreign` (`employee_id`),
  KEY `employee_kpis_evaluation_kpi_id_foreign` (`kpi_id`),
  KEY `employee_kpis_evaluation_created_by_foreign` (`created_by`),
  KEY `employee_kpis_evaluation_updated_by_foreign` (`updated_by`),
  KEY `employee_kpis_evaluation_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_position_histories`
--

DROP TABLE IF EXISTS `employee_position_histories`;
CREATE TABLE IF NOT EXISTS `employee_position_histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `duration` double(8,2) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_position_history_employee_id_foreign` (`employee_id`),
  KEY `employee_position_history_position_id_foreign` (`position_id`),
  KEY `employee_position_history_created_by_foreign` (`created_by`),
  KEY `employee_position_history_updated_by_foreign` (`updated_by`),
  KEY `employee_position_history_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_position_histories`
--

INSERT INTO `employee_position_histories` (`id`, `employee_id`, `position_id`, `start_date`, `end_date`, `duration`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-01-10', NULL, 36.00, 1, 1, NULL, NULL, NULL, NULL),
(2, 2, 2, '2023-03-01', NULL, 20.00, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `target_is_set` tinyint(1) NOT NULL,
  `kpis_score` double(8,2) DEFAULT NULL,
  `competencies_score` double(8,2) DEFAULT NULL,
  `total_score` decimal(5,2) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluation_employee_id_foreign` (`employee_id`),
  KEY `evaluation_created_by_foreign` (`created_by`),
  KEY `evaluation_updated_by_foreign` (`updated_by`),
  KEY `evaluation_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kpis`
--

DROP TABLE IF EXISTS `kpis`;
CREATE TABLE IF NOT EXISTS `kpis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baseline` int(11) NOT NULL,
  `is_linear` tinyint(1) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kpi_created_by_foreign` (`created_by`),
  KEY `kpi_updated_by_foreign` (`updated_by`),
  KEY `kpi_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpis`
--

INSERT INTO `kpis` (`id`, `name_en`, `name_ar`, `baseline`, `is_linear`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Project Completion Rate', 'معدل إكمال المشاريع', 80, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Bug Fix Rate', 'معدل إصلاح الأخطاء', 95, 1, 1, 1, NULL, NULL, NULL, NULL),
(3, 'Customer Complaints', 'شكاوى العملاء', 10, 0, 1, 1, NULL, NULL, NULL, NULL),
(4, 'Employee Satisfaction Rate', 'معدل رضا الموظفين', 75, 1, 1, 1, NULL, NULL, NULL, NULL),
(5, 'Turnover Rate', 'معدل دوران الموظفين', 15, 0, 1, 1, NULL, NULL, NULL, NULL),
(6, 'Training Completion Rate', 'معدل إتمام التدريب', 80, 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 2),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_10_27_063003_create_employee_table', 1),
(4, '2025_10_27_063036_create_position_table', 1),
(5, '2025_10_27_063229_create_kpi_table', 1),
(6, '2025_10_27_063248_create_competency_table', 1),
(7, '2025_10_27_065029_create_position_kpis_table', 1),
(8, '2025_10_27_080449_create_position_competencies_table', 1),
(9, '2025_10_27_080540_create_department_table', 1),
(10, '2025_10_27_101734_create_employee_position_history_table', 1),
(12, '2025_10_28_113036_create_employee_kpis_evaluation_table', 3),
(13, '2025_10_28_113051_create_employee_competencies_evaluation_table', 4),
(14, '2025_10_28_113102_create_evaluation_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum(' KPIs & Competencies','Competencies only','No KPIs & Competencies') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position_department_id_foreign` (`department_id`),
  KEY `position_created_by_foreign` (`created_by`),
  KEY `position_updated_by_foreign` (`updated_by`),
  KEY `position_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name_en`, `name_ar`, `type`, `is_active`, `department_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'HR Manager', 'مدير الموارد البشرية', 'Competencies only', 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Software Engineer', 'مهندس برمجيات', ' KPIs & Competencies', 1, 2, 1, 1, NULL, NULL, NULL, NULL),
(3, 'IT Manager', 'مدير تقنية المعلومات', ' KPIs & Competencies', 1, 2, 1, 1, NULL, NULL, NULL, NULL),
(4, 'IT System Admin', ' مسؤول نظم المعلومات', ' KPIs & Competencies', 1, 2, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `position_competencies`
--

DROP TABLE IF EXISTS `position_competencies`;
CREATE TABLE IF NOT EXISTS `position_competencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `competency_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position_competencies_position_id_foreign` (`position_id`),
  KEY `position_competencies_competency_id_foreign` (`competency_id`),
  KEY `position_competencies_created_by_foreign` (`created_by`),
  KEY `position_competencies_updated_by_foreign` (`updated_by`),
  KEY `position_competencies_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position_competencies`
--

INSERT INTO `position_competencies` (`id`, `position_id`, `competency_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 2, 2, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `position_kpis`
--

DROP TABLE IF EXISTS `position_kpis`;
CREATE TABLE IF NOT EXISTS `position_kpis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `target` int(11) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position_kpis_kpi_id_foreign` (`kpi_id`),
  KEY `position_kpis_position_id_foreign` (`position_id`),
  KEY `position_kpis_created_by_foreign` (`created_by`),
  KEY `position_kpis_updated_by_foreign` (`updated_by`),
  KEY `position_kpis_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position_kpis`
--

INSERT INTO `position_kpis` (`id`, `kpi_id`, `position_id`, `target`, `weight`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 90, '40.00', 1, 1, NULL, NULL, NULL, NULL),
(2, 2, 2, 95, '40.00', 1, 1, NULL, NULL, NULL, NULL),
(3, 3, 2, 5, '20.00', 1, 1, NULL, NULL, NULL, NULL),
(4, 4, 1, 85, '40.00', 1, 1, NULL, NULL, NULL, NULL),
(5, 5, 1, 10, '30.00', 1, 1, NULL, NULL, NULL, NULL),
(6, 6, 1, 95, '30.00', 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_employee_id_foreign` (`employee_id`),
  KEY `users_created_by_foreign` (`created_by`),
  KEY `users_updated_by_foreign` (`updated_by`),
  KEY `users_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$12$z5XS2cliV9Scz0O.PO6H4OvHQWxKS8wPLYTIyraHN6z9ZM06VUaZK', NULL, 1, 1, NULL, NULL, NULL, NULL),
(2, 2, 'sara', '$2y$12$JeE41PID5tj2JJobiQ4Pie6UEZx4qyK9eAoWUzqdOkYySWl0Q9tTq', NULL, 1, 1, NULL, NULL, NULL, NULL),
(3, 3, 'ali', '$2y$12$kLjV3KeQgGJpW6OnY1cm..awpSPkYV2VD/4G81W0onI4WwGNtqkhK', NULL, 1, 1, NULL, NULL, NULL, NULL),
(4, 4, 'mary', '$2y$12$fdy9yasTAvFNBlF0uYXuvOdiy8MT/fH7s9t1cGoGQDYqqArxP1goG', NULL, 1, 1, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
