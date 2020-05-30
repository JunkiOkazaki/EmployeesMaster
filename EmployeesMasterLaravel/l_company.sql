-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020 年 5 月 30 日 15:24
-- サーバのバージョン： 5.5.65-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l_company`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL,
  `department_code` int(11) NOT NULL,
  `department_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `departments`
--

INSERT INTO `departments` (`department_id`, `department_code`, `department_name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, '営業', 0, '2020-05-26', '0000-00-00'),
(2, 101, '業務', 0, '2020-05-26', '0000-00-00'),
(3, 991, '開発', 0, '2020-05-26', '0000-00-00');

-- --------------------------------------------------------

--
-- テーブルの構造 `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `employee_code` int(11) NOT NULL,
  `employee_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_code`, `employee_name`, `department_id`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 642, '徳川家康', 3, 0, '2020-05-26', '2020-05-29'),
(2, 78, '徳川秀忠', 1, 0, '2020-05-26', '2020-05-29'),
(3, 96, '徳川家光', 1, 0, '2020-05-26', '2020-05-29'),
(4, 53, 'ラムセス', 1, 0, '2020-05-26', '2020-05-29'),
(5, 43, '徳川綱吉', 2, 0, '2020-05-26', '2020-05-29'),
(6, 19, '荒木村重', 2, 0, '2020-05-29', '2020-05-29'),
(7, 59, '豊臣秀頼', 3, 0, '2020-05-27', '2020-05-29'),
(8, 9376, '徳川吉宗', 2, 0, '2020-05-27', '2020-05-29'),
(9, 72, '足利義持', 3, 0, '2020-05-27', '2020-05-29'),
(10, 62, '北条政子', 2, 0, '2020-05-27', '2020-05-29');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2020_05_26_101840_create_users_table', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employees_department_id_foreign` (`department_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
