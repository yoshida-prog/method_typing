-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2019 年 11 月 04 日 10:05
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `method_typing`
--
CREATE DATABASE IF NOT EXISTS `method_typing` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `method_typing`;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL DEFAULT 'Beginner',
  `best` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `user_id`, `user_pass`, `rank`, `best`) VALUES
(52, 'yy', 'yoshidadesu', '$2y$10$BTes8vaFDlUSGBguw9NLBeWSU2NZkmWwHTJ08p3f5D2LaNPbKhDHm', 'ACE', 3.53),
(53, 'test', 'testtest', '$2y$10$pyG5MMerF3rbrYw9Fchp8uWq2TnIA40X8tcq7kDqCUuFMX.Oj588S', 'Beginner', 0),
(54, 'test2', 'password', '$2y$10$wLQc0.w59CjcRlZ87.QrSOIDWgd2HKSoS2.ZlV7cJSBQ/cBGb8666', 'Beginner', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_pass` (`user_pass`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
