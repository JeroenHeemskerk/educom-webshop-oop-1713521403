-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 mei 2024 om 12:06
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `florians_webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`) VALUES
(7, 8, '2024-04-19'),
(8, 8, '2024-04-19'),
(9, 9, '2024-04-19'),
(10, 8, '2024-04-11'),
(11, 8, '2024-04-19'),
(12, 8, '2024-04-23'),
(13, 8, '2024-04-23'),
(14, 8, '2024-04-23'),
(15, 8, '2024-04-23'),
(16, 8, '2024-04-23'),
(17, 8, '2024-04-25'),
(18, 8, '2024-04-25'),
(19, 8, '2024-04-25'),
(20, 8, '2024-04-25'),
(21, 8, '2024-04-25'),
(22, 8, '2024-04-25'),
(23, 8, '2024-04-25'),
(24, 8, '2024-04-25'),
(25, 8, '2024-04-25'),
(26, 8, '2024-04-25'),
(27, 8, '2024-04-25'),
(28, 8, '2024-04-25'),
(29, 8, '2024-04-25'),
(30, 8, '2024-04-25'),
(31, 8, '2024-04-25'),
(32, 8, '2024-04-25'),
(33, 8, '2024-04-25'),
(34, 8, '2024-04-25'),
(35, 18, '2024-04-29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(10, 7, 1, 1),
(11, 8, 4, 3),
(12, 9, 2, 3),
(13, 9, 1, 2),
(14, 9, 5, 1),
(15, 10, 2, 2),
(16, 11, 4, 1),
(17, 13, 2, 3),
(18, 13, 4, 1),
(19, 14, 1, 2),
(20, 15, 2, 19),
(21, 15, 1, 4),
(22, 15, 4, 3),
(23, 16, 6, 4),
(24, 17, 1, 1),
(25, 17, 2, 2),
(26, 17, 4, 1),
(27, 19, 2, 2),
(28, 19, 4, 2),
(29, 20, 2, 1),
(30, 20, 5, 3),
(31, 21, 2, 1),
(32, 22, 2, 1),
(33, 28, 6, 2),
(34, 28, 4, 2),
(35, 28, 2, 1),
(36, 29, 4, 1),
(37, 30, 2, 1),
(38, 30, 1, 5),
(39, 31, 1, 4),
(40, 31, 2, 5),
(41, 31, 4, 1),
(42, 31, 6, 1),
(43, 32, 2, 1),
(44, 32, 4, 3),
(45, 32, 1, 1),
(46, 32, 5, 1),
(47, 33, 1, 8),
(48, 33, 4, 2),
(49, 33, 2, 2),
(50, 34, 2, 1),
(51, 34, 1, 1),
(52, 35, 2, 1),
(53, 35, 4, 3),
(54, 35, 1, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(255) NOT NULL,
  `fname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `fname`) VALUES
(1, 'Origami Dwergspaniël', 'Een Dwergspaniël gevouwen van 15x15cm origami papier. Ontwerp door Jun Maekawa. ', 2000, 'origamihond.jpg'),
(2, 'Origami Wild Zwijn', 'Een Wild Zwijn gevouwen van 24x24cm origami papier. Ontwerp door Jun Maekawa. ', 1500, 'origamizwijn.jpg'),
(4, 'Stuiterei', 'Stuiterei gemaakt van rubber. ', 325, 'stuiterei.jpg'),
(5, 'Mini Kendama', 'Een Japanse kendama ter grootte van een fietsventiel. ', 450, 'minikendama.jpg'),
(6, 'Fidgetspinner', 'Oranje fidgetspinner met kogellagers. ', 275, 'fidgetspinner.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `pswd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pswd`) VALUES
(6, 'nee', 'nee@nee.nl', '$2y$10$AVgE8NNwlQYiERX.QABU.uaRDJeExurIKoLY.LQcDiJXKRIm8dP96'),
(7, 'ja', 'ja@ja.nl', '$2y$10$OAWsH9KV/rMGuttGl7BN/eS9ROgNsXu.bkXZk/4VwZ8Cd0xGwm6YW'),
(8, 'ok', 'ok@ok.nl', '$2y$10$by7qOwTrmmhy5cSLSFhRaOMpA5FSY7BJEVfR0JhJqxVh1X0QAlLhi'),
(9, 'no', 'no@no.nl', '$2y$10$ltnKwN5HAQAkC635c0XJuu8n/RIB6K3VlOyvejFW9teR78xQPls2C'),
(10, 'of', 'of@of.nl', '$2y$10$Ne02QZzsnGTtcwINpucW/ey0jJk1GUnpgIx7.zGWISdfz5y1rBWoC'),
(11, 'fo', 'fo@fo.nl', '$2y$10$An8x7hjWSmpCOIkDOBkLH.x7vzpq/2zdyo8vviATS4w5Mem6IZivm'),
(12, 'neenee', 'neenee@neenee.nl', '$2y$10$4lxOomKgN/4pu6JRTEFPPeFzUPdGrAtOaPIFEv8Vg8FbZQaErQDJu'),
(13, 'yes', 'yes@yes.nl', '$2y$10$g.1tIxR1G0tgPnEMfkV5aOzCmW1Q4Pq.k4WCxkmeV1oaWQL0dXWDa'),
(18, 'sey', 'sey@sey.nl', '$2y$10$DhJeA3HXFzhbGNn1NY112ODeIOFhuPJNM.aEtVEOtk9hE5ULc30t2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_products`
--

CREATE TABLE `users_products` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `rating` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users_products`
--

INSERT INTO `users_products` (`id`, `product_id`, `user_id`, `rating`) VALUES
(1, 5, 18, 5),
(2, 5, 10, 2),
(3, 6, 18, 2),
(4, 6, 7, 3),
(6, 1, 12, 5),
(8, 5, 13, 3),
(14, 1, 13, 3),
(15, 4, 13, 3),
(16, 2, 13, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_places_orders` (`user_id`);

--
-- Indexen voor tabel `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_has_products` (`order_id`),
  ADD KEY `product_has_orders` (`product_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`user_id`),
  ADD KEY `user_rates_products` (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT voor een tabel `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT voor een tabel `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_places_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `order_has_products` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_has_orders` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Beperkingen voor tabel `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `product_has_userratings` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_rates_products` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
