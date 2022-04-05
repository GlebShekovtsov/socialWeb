-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 05 2022 г., 17:00
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `socialwebdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `friend`
--

CREATE TABLE `friend` (
  `id` int NOT NULL,
  `idUser` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idFriend` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `friend`
--

INSERT INTO `friend` (`id`, `idUser`, `idFriend`) VALUES
(2, '5', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `userId` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `userId`, `image`, `description`) VALUES
(1, '5', 'oldfloppa.jpg', 'Пожилой кот Жмышенко Валеры'),
(2, '5', 'cultjmix.jpg', 'Культурный Жмых'),
(3, '5', 'anime.jpg', 'Рэпер'),
(4, '5', 'panki.jpg', 'Панки');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `senderId` varchar(256) NOT NULL,
  `recId` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `status` varchar(256) NOT NULL,
  `pm` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `senderId`, `recId`, `text`, `status`, `pm`) VALUES
(17, '1', '2', '123', 'Не прочитано', ''),
(18, '1', '2', '123', 'Не прочитано', ''),
(19, '1', '2', '123', 'Не прочитано', '');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int NOT NULL,
  `userId` varchar(128) NOT NULL,
  `fullName` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `about` text NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `status` varchar(256) NOT NULL,
  `job` varchar(256) NOT NULL,
  `favGames` varchar(256) NOT NULL,
  `favMusic` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `userId`, `fullName`, `city`, `about`, `avatar`, `status`, `job`, `favGames`, `favMusic`) VALUES
(1, '5', 'Жмышенко Валерий Альбертович', 'Ровеньки', 'Пожилой ветеран донбасса', 'jmix.png', 'Наворовал денег у зяблов и купил себе БМВ в кредит', '228-я Мотострелковая Дивизия', 'LineAge II', 'Песни про танкистов'),
(2, '6', 'Дмитрий -ПепеJIьный- Маршал', 'Волгоград', 'Лучший игрок в PUBG', '7P6bXWlnbbM.jpg', 'Зло трудно измерить, его границы размыты.. И если надо будет выбирать между одним злом и другим.. Я не буду выбирать вовсе. ', 'Отсутствует', 'Witcher 3, Assassins Creed (все части), Mortal Kombat X, Dark Souls 3, Sekiro, Skyrim', 'Тони Раут, Макс Фадеев, Linkin Park');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(2, 'dimkaivanov', '$2y$10$E7UWXN5hj9ys9P0t3ZYBwuDeC8E7E1Rowxdv9zuR3j.xigGv4UR/2'),
(5, 'jmix', '$2y$10$xlyvnDauJHVLkbO3E2sCCeiJFK4rRboWrlGjSckiTcJa5jRrMGNuy'),
(6, '123', '$2y$10$SZfKptlbkpxoQ/L0eqo.S.6tsYW1smwPDfXgfxMM.ieyKFxqOj7V6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
