-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 19 2021 г., 14:40
-- Версия сервера: 5.7.34
-- Версия PHP: 7.3.28

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
AUTOCOMMIT = 0;
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `r5763_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Products`
--

CREATE TABLE `Products`
(
    `ID`               int(11) NOT NULL,
    `PRODUCT_ID`       int(11) NOT NULL,
    `PRODUCT_NAME`     varchar(255) NOT NULL,
    `PRODUCT_PRICE`    int(11) NOT NULL,
    `PRODUCT_ARTICLE`  int(11) NOT NULL,
    `PRODUCT_QUANTITY` int(11) NOT NULL,
    `DATE_CREATE`      timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `HIDE`             tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `Products`
--

INSERT INTO `Products` (`ID`, `PRODUCT_ID`, `PRODUCT_NAME`, `PRODUCT_PRICE`, `PRODUCT_ARTICLE`, `PRODUCT_QUANTITY`,
                        `DATE_CREATE`, `HIDE`)
VALUES (1, 1, 'Test', 100, 101, 3, '2021-08-19 15:47:23', 0),
       (2, 2, 'Test2', 200, 201, 6, '2021-08-19 16:18:02', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Products`
--
ALTER TABLE `Products`
    ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `PRODUCT_ID` (`PRODUCT_ID`),
  ADD UNIQUE KEY `PRODUCT_ARTICLE` (`PRODUCT_ARTICLE`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Products`
--
ALTER TABLE `Products`
    MODIFY `ID` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
