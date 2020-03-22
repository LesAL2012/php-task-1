-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 22 2020 г., 13:28
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
-- Структура таблицы `php_task_1_tasks`
--

CREATE TABLE `php_task_1_tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(2048) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `status` varchar(16) DEFAULT 'Not confirmed',
  `edit_admin` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `php_task_1_tasks`
--

INSERT INTO `php_task_1_tasks` (`id`, `task`, `user_name`, `email`, `status`, `edit_admin`) VALUES
(1, 'Написать качественно тестовое задание №1 по PHP без использования JS', 'Александр', 'lesal2012@gmail.com', 'Done', NULL),
(2, 'Создайте чекбокс по аналогии с социальной сетью.', 'Ivan', 'ivan@iv.net', 'Not confirmed', NULL),
(3, 'Создайте форму регистрации посетителя сайта', 'Nick', 'Nick@nk.com', 'Not confirmed', NULL),
(4, 'Сверстайте форму диспетчера на сайте.', 'Игорь', 'igor@ig.net', 'Done', 'Edited by admin'),
(5, 'Заполнить массив нулями, кроме первого и последнего элементов, которые должны быть равны единице.', 'Станислав', 'stas@com.ua', 'Not confirmed', NULL),
(6, '&lt;script&gt;alert(‘test’);&lt;/script&gt;', 'test', 'test@test.com', 'Done', 'Edited by admin'),
(7, 'Заполнить массив заданной длины различными простыми числами. Натуральное число, большее единицы, называется простым, если оно делится только на себя и на единицу.', 'Федор', 'fedor@com.ua', 'Not confirmed', NULL),
(8, 'Создать массив, на четных местах в котором стоят единицы, а на нечетных местах - числа, равные остатку от деления своего номера на 5', 'David', 'David@nk', 'Not confirmed', 'Edited by admin'),
(9, 'Сжать массив, удалив из него все элементы, величина которых находится в интервале [а, b]. Освободившиеся в конце массива элементы заполнить нулями.\r\nЗадачу можно разбить на три подзадачи:\r\nУдаление элементов массива, принадлежащих заданному интервалу.\r\nСдвиг оставшихся элементов.\r\nЗаполнение \"освободившейся\" части массива нулями.\r\nНа самом деле первая и вторая подзадача решаются совместно по следующему алгоритму:\r\nВ цикле перебираем элементы массива, начиная с первого.\r\nПри обнаружении элемента, принадлежащего удаляемому интервалу,\r\nразмерность массива уменьшаем на единицу (поэтому лучше использовать цикл while, а не for.),\r\nостальную (правую) часть массива сдвигаем на одну ячейку в лево.\r\nСдвиг правой части массива выполняется в цикле от текущего индекса элемента до размерности массива.', 'Георгий', 'jorik@j.ar', 'Done', 'Edited by admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `php_task_1_tasks`
--
ALTER TABLE `php_task_1_tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `php_task_1_tasks`
--
ALTER TABLE `php_task_1_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
