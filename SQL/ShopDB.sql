-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Lip 2020, 16:49
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `street` text NOT NULL,
  `street_number` text NOT NULL,
  `flat_number` text NOT NULL,
  `email` text NOT NULL,
  `phone_number` text NOT NULL,
  `post_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`) VALUES
(5, 2, 3),
(8, 2, 7),
(9, 2, 4),
(10, 2, 2),
(43, 3, 5),
(46, 3, 5),
(47, 3, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` text NOT NULL,
  `signature` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `delivery_method` text NOT NULL,
  `price` float NOT NULL,
  `payment_status_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `payment_date` datetime NOT NULL,
  `shipped_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `signature`, `user_id`, `billing_address_id`, `delivery_address_id`, `delivery_method`, `price`, `payment_status_id`, `order_status_id`, `create_date`, `payment_date`, `shipped_date`) VALUES
(1, '290620202201436461', 'd0774b06a55a9fc5eb593dfd83efee503ce9408c0b29dbc0e17a03a1ac0a619b', 3, 0, 0, '', 939.99, 3, 1, '2020-06-29 22:01:43', '2020-06-29 22:03:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(96) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `icon_url` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `quantity`, `price`, `icon_url`) VALUES
(4, 'Wódka Adama Mickiewicza', 'Ta wódka jest najlepsza', 5, 24.99, 'https://alkoholezagrosze.pl/364-thickbox_default/wodka-mickiewicz-adam-500ml.jpg'),
(5, 'CIROC VODKA 1,75L', 'Połączenie dwóch rodzajów winogron: Mauzac Blanc z regionu Gaillac i Ugni Blanc z regionu Cognac, zaowocowało wytworzeniem idealnie gładkiej i wyjątkowo delikatnej Ciroc Vodka. Tak, ta wódka zrobiona jest z winogron i jest zupełnie inna niż wszystkie, które znasz. Prezentowana wersja to butelka o pojemności 1,75L.', 5, 449, 'https://vinosonline.es/4046-large_default/ciroc-vodka-1-75l.jpg'),
(6, 'Soplica Orzech Laskowy 0,5l', 'Tradycyjna marka wódki, która dzięki delikatnemu smakowi i łagodnemu aromatowi od lat cieszy się rosnącą popularnością. Soplica o smaku orzecha laskowego z pewnością przypadnie do gustu osobom lubiącym sięgać po produkty na bazie \"natury\".', 5, 29, 'https://smaczajama.pl/environment/cache/images/0_0_productGfx_9106b6a1c7def52e24ff343e6f3e168c.jpg'),
(7, 'Soplica 1L', 'Wyjątkowość wódki Soplica to rezultat doświadczenia i kunsztu pokoleń gorzelników – produkowana jest od 1891 r., odkąd pierwsze butelka opuściła gnieźnieńską Fabrykę Wódek i Likierów. Łagodny, neutralny smak i aromat oraz najwyższa jakość przysporzył jej wielu zwolenników nie tylko w Polsce, ale i na całym świecie.', 5, 55, 'https://hurtum.pl/storage/products/14/98/16/93/21/1498169321_37273426_6c9798746e9b06aff80ba0f66a014b61_hd.jpg'),
(8, 'Stock 0.5L', 'Stock Prestige to wysokiej jakości wódka, będąca efektem pasji, tradycji i ponad 130 lat doświadczenia. Trunek łączy w sobie delikatny smak oraz najwyższą jakość uzyskiwaną w procesie sześciostopniowej destylacji oraz filtracji na zimno. Składniki stosowane do produkcji wódki poddawane są selekcji oraz kontroli.', 5, 27.99, 'https://alkohol-online.pl/1689-large_default/stock-prestige-1000ml.jpg'),
(9, 'Żubrówka 0,5L', 'Żubrówka Biała to czysta wódka o wyjątkowej łagodności oraz, znanej miłośnikom Żubrówki Bison Grass, unikalnej jakości. Naturalny i tradycyjny, a zarazem oryginalny charakter Żubrówki podkreśla także atrakcyjne opakowanie. Czysta z natury Żubrówka Biała wywodzi się z Puszczy Białowieskiej – jednego z najbardziej niedostępnych i dziewiczych rejonów Polski.', 5, 21.5, 'https://irmontri-cdn.sirv.com/polish-shop/img/p/1/4/2/4/zubrowka-white-vodka-40-500ml.jpg'),
(10, 'Soplica Malinowa 0,5l', 'Ta wódka jest najlepsza', 5, 29, 'https://smaczajama.pl/environment/cache/images/0_0_productGfx_fa99e17cc262d05e3db282e0a3297d47.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_hash` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `expire_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `token_hash`, `create_time`, `expire_time`) VALUES
(24, 3, '34f4b56a131f9d07130056527216a8811603e7a4f771121235444cfb05537a4a', 1593279917, 1595871917),
(25, 3, '2d715ea61677be693e8c697694095e1405b648d47cd615eadb26cd6ab45bfc53', 1593279977, 1595871977),
(27, 3, '0f7cea38b0d58a72dfd674372c7cdf51720b440a89cd7c2153ee7530982fada4', 1593280043, 1595872043),
(29, 3, '804a1c995ff06c1d2e7a83863a22b5313c93047ce603f1401eab1d0b4f2663f6', 1593365631, 1595957631),
(30, 3, '5f679c7629a5524850dbebc7569b08894128b508d8135528c3e2c81531a870be', 1593380282, 1595972282),
(31, 3, '5a27033e409e25f1297214eec82ed87c7c315c737e7e22ece9dbf03cf4618f8e', 1593457056, 1596049056);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password_hash` varchar(96) COLLATE utf8_polish_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `is_activated`, `is_admin`) VALUES
(1, 'root', 'michal.gombos@icloud.com', '$2y$10$0eBoWiZXmkHHYawBP7NnheEOdarUVPqcPkMTbB6NKdr7XSiv2UlLy', 1, 0),
(2, 'admin', 'elfreits@gmail.com', '$2y$10$lKHnHb4g8fkmBACvCx8nPe2LMDNh5moQfxnrWu/a6q.jUgoNMNw0u', 1, 0),
(3, 'elfreits', 'xd@gmail.com', '$2y$10$gMoa2ZBvNEWp/7Qkto38AO86G4znczcmWpMG28GY2Ihsv7fe9Kiwi', 1, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
