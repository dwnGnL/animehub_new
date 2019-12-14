-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 14 2019 г., 12:08
-- Версия сервера: 5.6.43
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
-- База данных: `animehub`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lite_answers`
--

CREATE TABLE `lite_answers` (
  `id_answers` int(5) NOT NULL,
  `id_questions` int(2) NOT NULL,
  `title_answers` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lite_answers`
--

INSERT INTO `lite_answers` (`id_answers`, `id_questions`, `title_answers`) VALUES
(1, 1, 'Верните старый'),
(2, 1, 'Норм'),
(3, 1, 'Нуждается в доработке'),
(4, 1, 'Это шедевр ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lite_answers`
--
ALTER TABLE `lite_answers`
  ADD PRIMARY KEY (`id_answers`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lite_answers`
--
ALTER TABLE `lite_answers`
  MODIFY `id_answers` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
