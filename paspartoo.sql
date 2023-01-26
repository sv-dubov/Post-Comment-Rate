-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Вер 13 2022 р., 13:26
-- Версія сервера: 10.4.21-MariaDB
-- Версія PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `paspartoo`
--

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `visitore_name` varchar(255) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `comment`, `visitore_name`, `post_id`, `created_at`) VALUES
(2, 'gjkhgkghk', 'Commentator1', 1, '2022-08-31 13:46:14'),
(3, 'gjghkxdhf \r\nfgyigyi', 'Commentator2', 1, '2022-08-31 13:50:01'),
(5, 'To post 6', 'Commentator3', 9, '2022-08-31 16:36:20'),
(6, 'to Post 5', 'Commentator5', 5, '2022-09-01 11:14:39'),
(7, 'for post 4', 'Commentator4', 4, '2022-09-01 12:42:52'),
(8, 'to post 6 add', 'admin', 9, '2022-09-01 13:21:59'),
(9, 'to post 4 more', 'admin', 4, '2022-09-01 13:22:31'),
(10, 'to post 7 comment', 'admin', 13, '2022-09-01 15:24:34'),
(11, 'next to post 7', 'Commentator2', 13, '2022-09-01 15:25:51'),
(12, 'to post 8', 'admin', 14, '2022-09-02 09:57:30'),
(15, 'fgfdhfhf', 'qwa', 20, '2022-09-13 11:19:20');

-- --------------------------------------------------------

--
-- Структура таблиці `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` text NOT NULL,
  `visitore_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `posts`
--

INSERT INTO `posts` (`id`, `post`, `visitore_name`, `created_at`) VALUES
(1, 'Post 1', 'Name', '2022-08-25 13:29:00'),
(2, 'Post 2', 'Name2', '2022-08-25 13:33:29'),
(3, 'Post 3', 'Name3', '2022-08-25 15:06:37'),
(4, 'Post 4\r\nPost 4.', 'Name4', '2022-08-31 10:59:48'),
(5, 'Post 5. Card', 'Name5', '2022-08-31 11:54:08'),
(9, 'Post 6', 'Name6', '2022-08-31 13:36:10'),
(13, 'Post 7\r\nfdgtdfhfg\r\nxcgdfhfg', 'Name7', '2022-09-01 15:23:12'),
(14, 'Post 8\r\ndsgdfgdf\r\ngfjgj', 'Name8', '2022-09-02 09:57:11'),
(15, 'Post 9', 'admin', '2022-09-02 09:57:41'),
(16, 'Post 10', 'Name10', '2022-09-06 09:26:11'),
(20, 'Post 11 check', 'admin', '2022-09-06 12:42:00'),
(24, 'Posst 12', 'admin', '2022-09-13 11:19:40');

-- --------------------------------------------------------

--
-- Структура таблиці `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `ratings`
--

INSERT INTO `ratings` (`id`, `post_id`, `rating`) VALUES
(1, 13, 5),
(2, 15, 5),
(3, 1, 4),
(4, 2, 4),
(5, 15, 4),
(6, 14, 5),
(7, 14, 4),
(9, 16, 2),
(11, 16, 5),
(157, 20, 5),
(158, 16, 4),
(159, 15, 3),
(160, 15, 3),
(161, 14, 2),
(162, 24, 5),
(163, 24, 5),
(164, 1, 1),
(165, 1, 1);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Індекси таблиці `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблиці `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблиці `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
