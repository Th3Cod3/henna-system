-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2018 a las 23:32:43
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `henna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `kvk` varchar(10) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_person` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `kvk`, `phone`, `email`, `address`, `contact_person`, `created_at`, `updated_at`) VALUES
(1, 'HFT', '65216542', '68486313', 'asdasd@lala.com', 'Sero Pita z/n', 1, '2018-07-25 16:31:12', '2018-07-25 16:31:12'),
(2, 'RSI', '65216542', '5680101', 'mamawer01230@gmail.com', 'Kamay, 5', 0, '2018-07-27 12:14:23', '2018-07-27 12:14:23'),
(3, 'Interthek', '5465132', '5680101', 'mamawer01230@gmail.com', 'Korvetstraat, 20', 0, '2018-07-27 16:24:00', '2018-07-27 16:24:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(500) NOT NULL,
  `event_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `place` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `name`, `updated_at`, `created_at`, `description`, `event_date`, `user_id`, `place`) VALUES
(7, 'Mi first event', '2018-07-24 00:25:25', '2018-07-24 00:25:25', 'asd{% extends \'layout.twig\' %}\r\n{% block content %}', '2018-07-31', 0, 'asdasd'),
(8, 'Yefri Event', '2018-07-29 13:32:39', '2018-07-29 13:32:39', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', '2018-07-31', 0, 'Playa Pabou'),
(9, 'Cesar evento', '2018-07-29 21:25:40', '2018-07-29 21:22:43', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passagesasd, and more recently with desktop', '2018-07-24', 0, 'Santa cruz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_registers`
--

CREATE TABLE `event_registers` (
  `register_id` int(11) NOT NULL,
  `register_as` int(11) NOT NULL COMMENT 'FK of function',
  `event_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `event_registers`
--

INSERT INTO `event_registers` (`register_id`, `register_as`, `event_id`, `person_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, '2018-07-30 18:18:39', '2018-07-30 18:18:39'),
(7, 1, 7, 1, '2018-07-30 18:34:00', '2018-07-30 18:34:00'),
(8, 1, 7, 2, '2018-07-30 18:47:07', '2018-07-30 18:47:07'),
(9, 2, 7, 3, '2018-07-30 18:47:36', '2018-07-30 18:47:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `functions`
--

CREATE TABLE `functions` (
  `function_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `functions`
--

INSERT INTO `functions` (`function_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Voluntary', '', '2018-07-30 16:24:05', '2018-07-30 16:24:05'),
(2, 'Participant', '', '2018-07-30 16:24:05', '2018-07-30 16:24:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(20) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_type` int(11) NOT NULL COMMENT '1 = invoice; 0 = quote;',
  `invoice_status` int(11) NOT NULL COMMENT '0 = open; 1 = paid;',
  `invoice_file` varchar(50) NOT NULL,
  `event_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `invoice_no`, `invoice_date`, `invoice_type`, `invoice_status`, `invoice_file`, `event_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, '', '0000-00-00', 0, 0, '', 8, 1, '2018-07-25 16:37:43', '2018-07-29 16:57:37'),
(2, '5423165', '2018-07-22', 0, 0, '', 7, 1, '2018-07-27 14:07:00', '2018-07-27 14:07:00'),
(3, '5423165', '2018-07-22', 0, 0, '', 7, 1, '2018-07-27 14:07:53', '2018-07-27 14:07:53'),
(4, '5423165', '2018-07-22', 0, 0, '', 7, 1, '2018-07-27 14:08:08', '2018-07-27 14:08:08'),
(5, '541321', '2018-07-20', 0, 0, '', 8, 2, '2018-07-29 15:00:16', '2018-07-29 15:00:16'),
(6, '456564', '2018-07-28', 0, 0, '', 8, 1, '2018-07-29 16:55:41', '2018-07-29 16:55:41'),
(7, '321654', '2018-07-28', 0, 0, '', 8, 1, '2018-07-29 16:58:13', '2018-07-29 16:58:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_items`
--

CREATE TABLE `invoice_items` (
  `item_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float(10,3) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invoice_items`
--

INSERT INTO `invoice_items` (`item_id`, `invoice_id`, `product_id`, `price`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 10.000, 3, '2018-07-26 15:26:21', '2018-07-26 15:26:21'),
(2, 1, 1, 15.000, 3, '2018-07-26 16:16:44', '2018-07-26 16:16:44'),
(3, 1, 1, 15.000, 3, '2018-07-26 16:17:20', '2018-07-26 16:17:20'),
(4, 1, 1, 15.000, 3, '2018-07-26 16:18:55', '2018-07-26 16:18:55'),
(5, 1, 1, 52.000, 20, '2018-07-29 15:06:26', '2018-07-29 15:06:26'),
(6, 1, 1, 52.000, 20, '2018-07-29 15:09:09', '2018-07-29 15:09:09'),
(7, 1, 2, 25.000, 3, '2018-07-29 15:29:01', '2018-07-29 15:29:01'),
(8, 1, 1, 256.000, 9, '2018-07-29 15:29:14', '2018-07-29 15:29:14'),
(9, 2, 2, 45.000, 2, '2018-07-29 16:35:11', '2018-07-29 16:35:11'),
(10, 6, 1, 25.000, 5, '2018-07-29 16:56:42', '2018-07-29 16:56:42'),
(11, 6, 3, 152.000, 5, '2018-07-29 16:56:57', '2018-07-29 16:56:57'),
(12, 7, 1, 150.000, 3, '2018-07-29 16:58:37', '2018-07-29 16:58:37'),
(13, 1, 4, 56.000, 3, '2018-07-29 21:27:36', '2018-07-29 21:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `azv` varchar(20) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `birthplace` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persons`
--

INSERT INTO `persons` (`person_id`, `address`, `phone`, `birthday`, `azv`, `firstname`, `lastname`, `birthplace`, `email`, `occupation`, `created_at`, `updated_at`) VALUES
(1, 'Korvetstraat, 20', '5680101', '1994-12-30', '6546513215', 'Yefri Alexander', 'Gonzalez Gonzalez', 'Oranjestad', 'mamawer01230@gmail.com', 'This Program', '2018-07-27 17:27:08', '2018-07-27 17:27:08'),
(2, 'Korvetstraat, 20', '5680101', '0000-00-00', '21321654', 'Yefri', 'Gonzalez', 'Oranjestad', 'mamawer01230@gmail.com', '', '2018-07-29 13:07:48', '2018-07-29 13:07:48'),
(3, 'Korvetstraat, 20', '5680101', '0000-00-00', '21321654', 'Yefri', 'Gonzalez', 'Oranjestad', 'mamawer01230@gmail.com', '', '2018-07-29 13:08:37', '2018-07-29 13:08:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `company_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'tomati', 'e ta un berdura cora', 1, '', '2018-07-26 12:52:29', '2018-07-26 12:52:29'),
(2, 'TAX', 'e ta un berdura cora', 1, '', '2018-07-26 12:56:22', '2018-07-26 12:56:22'),
(3, 'TAX', 'e ta un berdura cora', 1, '', '2018-07-26 12:56:27', '2018-07-26 12:56:27'),
(4, 'Tarjeta', 'ajshgdvkahjsdfvjhgfvsadalkcjhb o ajhsd vjhbv asd dfiasddf adfc', 1, '', '2018-07-29 21:27:14', '2018-07-29 21:27:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_id` (`company_id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `event_registers`
--
ALTER TABLE `event_registers`
  ADD PRIMARY KEY (`register_id`);

--
-- Indices de la tabla `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`function_id`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`);

--
-- Indices de la tabla `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `person_id` (`person_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `event_registers`
--
ALTER TABLE `event_registers`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `functions`
--
ALTER TABLE `functions`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
