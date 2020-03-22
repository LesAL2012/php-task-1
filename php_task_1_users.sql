-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 22 2020 г., 13:29
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u31600_resume`
--

-- --------------------------------------------------------

--
-- Структура таблицы `php_task_1_users`
--

CREATE TABLE `php_task_1_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `php_task_1_users`
--

INSERT INTO `php_task_1_users` (`id`, `user_name`, `email`, `password`, `hash`) VALUES
(1, 'admin', 'admin@admin.net', '202cb962ac59075b964b07152d234b70', 'SZAdr5nQgqSRPdkIQMy5b2OBDedjTuJ'),
(2, 'Nick', 'Nick@nk.com', '698d51a19d8a121ce581499d7b701668', 'bNIZUxMuxQUzimiYsEb3mnr09wqAuk9');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `php_task_1_users`
--
ALTER TABLE `php_task_1_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `php_task_1_users`
--
ALTER TABLE `php_task_1_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
