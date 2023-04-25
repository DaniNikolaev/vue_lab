SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--

-- --------------------------------------------------------

--
-- Структура таблицы `plots`
--

CREATE TABLE `plots` (
                          `id` int(11) NOT NULL,
                          `plot` int(11) NOT NULL,
                          `price` decimal (15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `plots`
--

INSERT INTO `plots` (`id`, `plot`, `price`) VALUES
                                                           (2, 2,25000),
                                                           (3, 3,15000),
                                                           (4, 4,5000),
                                                           (5, 5,10000),
                                                           (6, 6,40000),
                                                           (7, 7,35000);

-- --------------------------------------------------------

--
-- Структура таблицы `funerals`
--

CREATE TABLE `funerals` (
                            `id` int(11) NOT NULL,
                            `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                            `surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                            `age` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                            `idPlot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `funerals`
--

INSERT INTO `funerals` (`id`, `name`, `surname`, `age`, `idPlot`) VALUES
                          (3, 'артем', 'Ардатович', 53, 3),
                          (4, 'Камиш', 'Мегекян', 92, 4),
                          (5, 'Сас', 'Ардатович', 70, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `plots`
--
ALTER TABLE `plots`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `funerals`
--
ALTER TABLE `funerals`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `plots`
--
ALTER TABLE `plots`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `funerals`
--
ALTER TABLE `funerals`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
