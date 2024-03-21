-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 20 2024 г., 22:51
-- Версия сервера: 5.6.51
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `notebook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `company`, `phone`, `email`, `date_birth`) VALUES
(1, 'upd_name1710963903', 'upd_company1710963903', 'upd_phone1710963903', 'upd_email1710963903', '2024-03-20'),
(3, '33', '33', '3', '3', '0000-00-00'),
(4, '4', '4', '4', '4', '0000-00-00'),
(5, 'name1710962375', 'company1710962375', 'phone1710962375', 'email1710962375', '2024-03-20'),
(6, 'name1710962392', 'company1710962392', 'phone1710962392', 'email1710962392', '2024-03-20'),
(7, 'name1710962598', 'company1710962598', 'phone1710962598', 'email1710962598', '2024-03-20'),
(8, 'name1710962612', 'company1710962612', 'phone1710962612', 'email1710962612', '2024-03-20'),
(9, 'name1710963492', 'company1710963492', 'phone1710963492', 'email1710963492', '2024-03-20'),
(10, 'name1710963598', 'company1710963598', 'phone1710963598', 'email1710963598', '2024-03-20'),
(11, 'name1710963789', 'company1710963789', 'phone1710963789', 'email1710963789', '2024-03-20'),
(12, 'name1710963799', 'company1710963799', 'phone1710963799', 'email1710963799', '2024-03-20'),
(13, 'name1710963872', 'company1710963872', 'phone1710963872', 'email1710963872', '2024-03-20'),
(14, 'name1710963903', 'company1710963903', 'phone1710963903', 'email1710963903', '2024-03-20');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
