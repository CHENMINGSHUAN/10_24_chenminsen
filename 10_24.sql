-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-07-30 15:47:10
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `10_24`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comment_table`
--

CREATE TABLE `comment_table` (
  `id` int(12) NOT NULL,
  `comment` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `img_table`
--

CREATE TABLE `img_table` (
  `id` int(50) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `img_table`
--

INSERT INTO `img_table` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(5, '海の中道', 'upload/20200730104118aa95e2e52d800768e0fd210800f628d6.jpg', '2020-07-30 17:41:18.000000', '2020-07-30 17:41:18.000000'),
(7, '商店街', 'upload/202007301348367a9c0adcc1648638951f0969e3c722a3.jpg', '2020-07-30 20:48:36.000000', '2020-07-30 20:48:36.000000'),
(8, '阿蘇', 'upload/2020073015084312ef3b468e01071e7701dbbcae7ac1a7.jpg', '2020-07-30 22:08:43.000000', '2020-07-30 22:08:43.000000'),
(9, '黒川温泉、雪', 'upload/2020073015144369878b71e540d2958b245b26377bb835.jpg', '2020-07-30 22:14:43.000000', '2020-07-30 22:14:43.000000'),
(10, '沖縄', 'upload/2020073015164493c461c0fdfdafdca82cd5aef3f53df7.jpg', '2020-07-30 22:16:44.000000', '2020-07-30 22:16:44.000000'),
(11, '夕方', 'upload/2020073015175690fd1e4a1313a257ac0941feaab01dfd.jpg', '2020-07-30 22:17:56.000000', '2020-07-30 22:17:56.000000'),
(12, '黒川温泉', 'upload/20200730154543a14300924ef7167eb6bf3a8daf0e9a61.jpg', '2020-07-30 22:45:43.000000', '2020-07-30 22:45:43.000000');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(3) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, '', 'murooo331@outlook.com', 'mush3131', 0, '2020-07-29 20:12:50.000000', '2020-07-29 20:12:50.000000'),
(2, '', 'muro331@gmail.com', 'mush3131', 0, '2020-07-29 20:13:01.000000', '2020-07-29 20:13:01.000000'),
(3, '陳', '123@gmail.com', 'mush3131', 0, '2020-07-30 17:18:13.000000', '2020-07-30 17:18:13.000000'),
(4, '林', '345@gmail.com', 'mush3131', 0, '2020-07-30 17:18:42.000000', '2020-07-30 17:18:42.000000'),
(5, '王', '678@gmail.com', 'mush3131', 0, '2020-07-30 17:19:15.000000', '2020-07-30 17:19:15.000000');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `img_table`
--
ALTER TABLE `img_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `img_table`
--
ALTER TABLE `img_table`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルのAUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
