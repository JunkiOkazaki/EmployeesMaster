-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020 年 5 月 30 日 15:23
-- サーバのバージョン： 5.5.65-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL COMMENT 'NOT NULL制約',
  `department_code` int(11) NOT NULL COMMENT 'NOT NULL制約',
  `department_name` varchar(128) NOT NULL COMMENT 'NOT NULL制約',
  `delete_flag` int(11) NOT NULL COMMENT 'NOT NULL制約',
  `created_at` date NOT NULL COMMENT 'NOT NULL制約',
  `updated_at` date NOT NULL COMMENT 'NOT NULL制約'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `departments`
--

INSERT INTO `departments` (`department_id`, `department_code`, `department_name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, '営業', 0, '2020-05-01', '2020-05-01'),
(2, 101, '業務', 0, '2020-05-01', '2020-05-01'),
(3, 991, '開発', 0, '2020-05-01', '2020-05-01');

-- --------------------------------------------------------

--
-- テーブルの構造 `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `employee_code` int(11) NOT NULL COMMENT 'NOT NULL制約',
  `employee_name` varchar(128) NOT NULL COMMENT 'NOT NULL制約',
  `department_id` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL COMMENT 'NOT NULL制約',
  `created_at` date NOT NULL COMMENT 'NOT NULL制約',
  `updated_at` date NOT NULL COMMENT 'NOT NULL制約'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_code`, `employee_name`, `department_id`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 31, '足利義満', 2, 0, '2020-05-29', '2020-05-29'),
(3, 89, '細川忠興', 3, 0, '2020-05-01', '2020-05-29'),
(4, 879, '荒木村重', 3, 0, '2020-05-08', '2020-05-29'),
(5, 257, '小堀遠州', 3, 0, '2020-04-10', '2020-05-29'),
(6, 953, '上田宗箇', 1, 0, '2020-05-06', '2020-05-29'),
(7, 1358, '織田信長', 1, 0, '2020-06-06', '2020-05-29'),
(12, 94, 'エジソン', 3, 0, '2020-05-18', '2020-05-29'),
(63, 63, '足利尊氏', 2, 0, '2020-05-29', '2020-05-29'),
(77, 78, '古田織部', 1, 0, '2020-05-29', '2020-05-29'),
(963, 683, 'フォード', 2, 0, '2020-05-29', '2020-05-29');

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
  ADD UNIQUE KEY `my_uniquekey` (`employee_id`),
  ADD KEY `fk_department_id` (`department_id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
