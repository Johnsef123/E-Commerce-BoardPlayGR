-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 17 Μάη 2026 στις 20:47:27
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `boardplaygr_db`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`) VALUES
(15, 10, '2026-05-14 14:55:28'),
(18, 13, '2026-05-15 14:49:19'),
(22, 1, '2026-05-17 17:06:41');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(57, 18, 12, 8);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`) VALUES
(4, 1, 69.97, '2026-05-13 14:50:39'),
(5, 1, 1259.57, '2026-05-13 15:09:42'),
(6, 1, 159.92, '2026-05-13 15:37:04'),
(7, 1, 219.89, '2026-05-14 13:07:03'),
(8, 1, 89.97, '2026-05-14 13:08:47'),
(9, 1, 59.98, '2026-05-14 13:09:27'),
(10, 1, 29.99, '2026-05-14 13:18:26'),
(11, 1, 29.99, '2026-05-14 13:24:40'),
(12, 1, 59.98, '2026-05-14 14:17:44'),
(13, 10, 55.00, '2026-05-14 14:42:26'),
(14, 1, 269.91, '2026-05-14 14:59:18'),
(15, 1, 19.99, '2026-05-14 14:59:28'),
(16, 1, 927.71, '2026-05-16 15:37:24'),
(17, 1, 2639.34, '2026-05-16 16:18:38'),
(18, 1, 27.50, '2026-05-16 16:51:03'),
(19, 1, 239.93, '2026-05-16 16:59:02');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(5, 4, 12, 2, 19.99),
(6, 4, 11, 1, 29.99),
(7, 5, 11, 37, 29.99),
(8, 5, 13, 6, 24.99),
(9, 6, 12, 8, 19.99),
(10, 7, 12, 11, 19.99),
(11, 8, 11, 3, 29.99),
(12, 9, 11, 2, 29.99),
(13, 10, 11, 1, 29.99),
(14, 11, 11, 1, 29.99),
(15, 12, 11, 2, 29.99),
(16, 13, 14, 2, 27.50),
(17, 14, 11, 9, 29.99),
(18, 15, 12, 1, 19.99),
(19, 16, 20, 29, 31.99),
(20, 17, 19, 66, 39.99),
(21, 18, 14, 1, 27.50),
(22, 19, 19, 3, 39.99),
(23, 19, 11, 4, 29.99);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `created_at`) VALUES
(11, 'Monopoly', 'Classic property trading board game where players buy, sell, and build to dominate the board.', 29.99, 15, '/monopoly.png', '2026-05-11 15:52:05'),
(12, 'Jenga', 'Fun block-stacking game that challenges players to remove wooden blocks without collapsing the tower.', 19.99, 20, '/jenga.png', '2026-05-11 15:52:05'),
(13, 'Get Packing', 'Fast-paced puzzle board game where players race to pack items into suitcases.', 24.99, 10, '/get-packing.png', '2026-05-11 15:52:05'),
(14, 'Cluedo', 'Mystery-solving board game where players uncover who committed the crime, where, and with what weapon.', 27.50, 12, '/cluedo.png', '2026-05-11 15:52:05'),
(15, 'Scrabble', 'Classic word-building game where players create words for points using letter tiles.', 22.99, 18, '/scrabble.png', '2026-05-11 15:52:05'),
(16, 'Stratego', 'Strategy board game of battlefield tactics, hidden ranks, and capturing the enemy flag.', 34.99, 8, '/stratego.png', '2026-05-11 15:52:05'),
(17, '5 Seconds', 'Quick-thinking party game where players must answer within five seconds.', 21.99, 14, '/5-seconds.png', '2026-05-11 15:52:05'),
(18, 'Top 10', 'Creative party game where players rank answers from lowest to highest according to a secret theme.', 26.99, 9, '/top-10.png', '2026-05-11 15:52:05'),
(19, 'Villainous', 'Disney strategy game where players take the role of iconic villains trying to achieve their evil goals.', 39.99, 11, '/villainous.png', '2026-05-11 15:52:05'),
(20, 'Trivial Pursuit', 'Trivia board game featuring questions from multiple knowledge categories.', 31.99, 13, '/trivial-pursuit.png', '2026-05-11 15:52:05');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'ioannis seferis', 'ioannisseferis@gmail.com', 'Johnsef', '$2y$10$1fr2lppZNJ5flxSlRI2vXOKqtSGOwq2.fOCCYcQ4VHZVJZy0Bia52', '2026-05-07 11:21:08'),
(3, 'Natasa', 'natidouk22@gmail.com', 'Nat', '$2y$10$wodvxa4FVvMwnlVhJzATUuRA2v1zKI9hMKCP0Gs21qEuP8hi9Qjrq', '2026-05-07 11:22:52'),
(10, 'dada', '2nduser@account.com', '2user@account.com', '$2y$10$/1PzrS5nV4JV4TvCp/yB1OBkrCiOi8bl68P.OrVk4yMSntoZ0tiuC', '2026-05-14 14:41:07'),
(13, 'John', 'bg@gmail.com', 'John', '$2y$10$L1yyJ.TbxqcEtDsBEgbg2OIMr6Ih1/PVs4s.JSs8EzHa4.dyZzEzi', '2026-05-15 14:48:56');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT για πίνακα `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT για πίνακα `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT για πίνακα `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
