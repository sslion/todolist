-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2020 г., 16:25
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todolist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gc_groups`
--

CREATE TABLE `gc_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gc_groups`
--

INSERT INTO `gc_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Структура таблицы `gc_todolist`
--

CREATE TABLE `gc_todolist` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gc_todolist`
--

INSERT INTO `gc_todolist` (`id`, `title`, `description`, `start_date`, `end_date`, `modify_date`, `priority`, `status`, `creator_id`, `worker_id`) VALUES
(1, 'Какая-то задача', 'Это описание какой-то задачи', '2020-05-06', '2020-05-26', '2020-05-26', 1, 0, 2, 3),
(2, 'Еще одна задача', 'Это описание еще одной задачи', '2020-05-11', '2020-06-03', '2020-05-26', 2, 2, 2, 3),
(3, 'Какая-то другая задача', 'Это описание какой-то задачи', '2020-05-06', '2020-05-28', '2020-05-26', 1, 2, 9, 10),
(4, 'New task', 'Task description', '2020-05-23', '2020-05-31', '2020-05-26', 2, 0, 9, 10),
(5, 'Новая задача', 'Описание новой задачи', '2020-05-26', '2020-06-02', '2020-05-26', 0, 1, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `gc_users`
--

CREATE TABLE `gc_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `salt` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gc_users`
--

INSERT INTO `gc_users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `salt`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$zucPS4zAkKIyuadvWk/ibOXEwncZH4RrxGUhJg8KyPMGoZ2taTguS', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, 'w7oDHTXPM1Cs/H1p0766h.', 1268889823, 1590498517, 1, 'Admin', 'istrator', 'ADMIN', '0', ''),
(2, '127.0.0.1', 'sslion', '$2y$08$SS7.jxLLYHFePiP5b3rkPuPodigq1KBOq8BG.zigYnhETeOJpd9nC', 'sadasd@sds.rr', NULL, NULL, NULL, NULL, NULL, NULL, 'punFyBrJZevCqU.T9gzb/.', 1556194342, 1558676027, 1, 'sss', 'sss', '', '', NULL),
(3, '127.0.0.1', 'aaaa', '$2y$08$3gecxEXYDudfyzHlzQeNo.VElZasUGTDGhMujaYV5WOJ06H346XZq', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1590214522, NULL, 1, 'hhjjj', 'ghgj', '', '', NULL),
(9, '127.0.0.1', 'qwert', '$2y$08$yJKRaHJPEn5oPsdl5p52ie3LJAyr3vUsvWx5CMTeFMx./wkHPJGSW', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1590225883, NULL, 1, 'Другой', 'Руководитель', '', '', NULL),
(10, '127.0.0.1', 'fghghg', '$2y$08$ThL23KWK9VQCZ0Z634H3S.R0WmJQfAEh.wegoDFl0FY9AOkciY2X.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1590227479, NULL, 1, 'Другой', 'Работник', '', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `gc_users_groups`
--

CREATE TABLE `gc_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gc_users_groups`
--

INSERT INTO `gc_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(6, 2, 2),
(8, 3, 2),
(13, 9, 2),
(14, 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `gc_user_profile`
--

CREATE TABLE `gc_user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gc_user_profile`
--

INSERT INTO `gc_user_profile` (`id`, `user_id`, `firstname`, `lastname`, `middlename`, `login`, `password`, `role`) VALUES
(1, 1, 'Администратор', '', '', '', '', -1),
(2, 2, 'Руководитель', '', '', '', '', 0),
(3, 3, 'Работник', '', '', '', '', 2),
(7, 9, 'Другой', 'Руководитель', '', '', '', 0),
(8, 10, 'Другой', 'Работник', '', '', '', 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gc_groups`
--
ALTER TABLE `gc_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gc_todolist`
--
ALTER TABLE `gc_todolist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gc_users`
--
ALTER TABLE `gc_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Индексы таблицы `gc_users_groups`
--
ALTER TABLE `gc_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Индексы таблицы `gc_user_profile`
--
ALTER TABLE `gc_user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gc_groups`
--
ALTER TABLE `gc_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `gc_todolist`
--
ALTER TABLE `gc_todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `gc_users`
--
ALTER TABLE `gc_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `gc_users_groups`
--
ALTER TABLE `gc_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `gc_user_profile`
--
ALTER TABLE `gc_user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
