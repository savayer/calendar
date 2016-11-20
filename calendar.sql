-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 20 2016 г., 07:49
-- Версия сервера: 10.1.16-MariaDB
-- Версия PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `calendar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `day`
--

CREATE TABLE `day` (
  `id_day` int(11) NOT NULL,
  `timeWakeUp` text NOT NULL,
  `slogan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `day`
--

INSERT INTO `day` (`id_day`, `timeWakeUp`, `slogan`) VALUES
(0, '00:00', 'Слоган дня'),
(141116, '07:00', 'Начало начал'),
(191116, '10:00', 'Доделай сцука календарь'),
(201116, '11:00', 'Воскресный денёк'),
(211116, '09:00', 'Да будет вёрстка ');

-- --------------------------------------------------------

--
-- Структура таблицы `taskdone`
--

CREATE TABLE `taskdone` (
  `id_taskDone` int(11) NOT NULL,
  `text_taskDone` text NOT NULL,
  `id_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `taskdone`
--

INSERT INTO `taskdone` (`id_taskDone`, `text_taskDone`, `id_day`) VALUES
(1, 'Подьем. Завтрак', 141116),
(2, 'Верстка лэндинга', 141116),
(3, 'работа', 141116),
(4, 'Подьем. Завтрак', 191116),
(5, 'В путь до работы', 191116),
(6, 'Поправка фронтенда', 191116),
(7, 'Правка, наполнение таблиц', 191116),
(18, 'Подьем', 201116),
(19, 'Завтрак', 201116),
(20, 'В путь до офиса', 201116),
(21, 'Подготовка рабочего места', 201116),
(22, 'Обновление слогана и времени', 201116),
(23, 'Добавление списка задач на день', 201116),
(24, 'Добавление проделанных дел&nbsp;', 201116),
(25, 'Перерыв', 201116);

-- --------------------------------------------------------

--
-- Структура таблицы `tasksforday`
--

CREATE TABLE `tasksforday` (
  `id_task` int(11) NOT NULL,
  `text_task` varchar(50) NOT NULL,
  `id_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasksforday`
--

INSERT INTO `tasksforday` (`id_task`, `text_task`, `id_day`) VALUES
(1, 'Построить связи', 141116),
(2, 'Наладить считывание из БД', 141116),
(4, 'что то еще', 141116),
(6, 'Создать и связать таблицы', 191116),
(7, 'Настроить считывание из данных из бд', 191116),
(8, 'Настроить запись в бд', 191116),
(30, 'root права ', 201116),
(31, 'insert и update записей бд', 201116),
(32, 'Айсберг', 211116),
(33, 'easycomm', 211116);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id_day`);

--
-- Индексы таблицы `taskdone`
--
ALTER TABLE `taskdone`
  ADD PRIMARY KEY (`id_taskDone`),
  ADD KEY `id_day` (`id_day`);

--
-- Индексы таблицы `tasksforday`
--
ALTER TABLE `tasksforday`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `id_day` (`id_day`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `taskdone`
--
ALTER TABLE `taskdone`
  MODIFY `id_taskDone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `tasksforday`
--
ALTER TABLE `tasksforday`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
