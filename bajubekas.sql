-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 01:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bajubekas`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `post_code` varchar(10) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `country`, `address`, `post_code`, `city`) VALUES
(1, 6, 'Indonesia', 'asdada', '1234', 'P.bun'),
(2, 4, 'Singapore', 'KOTA PBUN', '123', 'sleman'),
(4, 4, 'Singapore', NULL, NULL, NULL),
(5, 6, 'Indonesia', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `sellerid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `design` varchar(255) DEFAULT NULL,
  `type` enum('men','women','kid','bag','forhim','forher') DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id`, `sellerid`, `title`, `image`, `description`, `material`, `color`, `size`, `design`, `type`, `price`) VALUES
(2, 4, 'asda', '57387.jpg', 'asdsad', 'asda', 'ads', 'ada', 'ad', 'women', '500,000'),
(3, 4, 'asdad', '57375.jpg', 'Interstellar', 'digial artasd', 'asdas', '144x155', 'intricate ', 'kid', '400,000'),
(4, 4, 'adadada', 'Danganronpa-logo.jpg', 'asdas', 'blender', 'asdas', '144x155', 'asd', 'women', '200,000'),
(5, 4, 'sdada', 'Makoto_Naegi_Illustration.png', 'makoto', 'ad', 'dd', 'as', 'sdaa', 'men', '300,000'),
(6, 4, 'Acheron', 'Screenshot 2024-07-16 193919.png', 'MY HUSBAND GRRRRRRRR, NO ONE TAKES HIM AWAY GRRR', 'Dieci clothing', 'Gold & Black', 'big sized body ', 'Limbus Design', 'bag', '95,000'),
(7, 4, 'adasda', '49536.jpg', 'Lofi-aesthetic, enough to make you SLURRRPPT IT DOWN', 'digital art', 'lofi synthesis color', '144x155', 'Lofi', 'women', '145,000'),
(8, 4, 'GOGOGO POWER RANGER', '49527.jpg', 'cat sitting because why not?', 'digital  pixel art', 'pixel color', 'whateva', 'intricate ', 'bag', '150,000'),
(9, 4, 'bag', '6549.jpg', 'space brr', 'blender', 'asdas', 'asdad', 'ad', 'bag', '123,456');

-- --------------------------------------------------------

--
-- Table structure for table `image testing`
--

CREATE TABLE `image testing` (
  `link` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image testing`
--

INSERT INTO `image testing` (`link`) VALUES
('https://pixabay.com/photos/woman-model-black-dress-outdoor-8086721/'),
('https://pixabay.com/photos/woman-portrait-fashion-model-3083453/'),
('https://pixabay.com/photos/woman-model-black-dress-outdoor-8086721/'),
('https://pixabay.com/photos/woman-portrait-fashion-model-3083453/'),
('https://pixabay.com/photos/woman-beauty-model-pose-fashion-6851973/'),
('https://pixabay.com/photos/portrait-woman-bouquet-indonesia-6595821/'),
('https://pixabay.com/photos/woman-beauty-model-pose-fashion-6851973/'),
('https://pixabay.com/photos/portrait-woman-bouquet-indonesia-6595821/'),
('https://pixabay.com/photos/woman-model-portrait-pose-style-716592/'),
('https://pixabay.com/photos/girl-hands-portrait-model-modeling-3033718/'),
('https://pixabay.com/photos/woman-model-portrait-pose-style-716592/'),
('https://pixabay.com/photos/girl-hands-portrait-model-modeling-3033718/');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderby`, `image`, `title`, `color`, `size`, `price`, `created_at`) VALUES
(2, 6, 'Screenshot 2024-07-16 193919.png', 'Acheron', 'Gold & Black', 'big sized body ', 95.00, '2024-12-22 10:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `querycatalog`
--

CREATE TABLE `querycatalog` (
  `id` int(11) NOT NULL,
  `sellerid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `design` varchar(255) DEFAULT NULL,
  `type` enum('men','women','kid','bag') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `type` enum('customer','admin','seller') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `FirstName`, `LastName`, `DOB`, `type`) VALUES
(4, 'sellertest@gmail.com', '$2y$10$sRl2rLdV5T.oaAkVTYbBlu5D/TaIL6510B3zDHZjl.g4ogi0v/84i', 'Lan', 'Aeon of Hunt', '2024-12-20', 'seller'),
(5, 'admin@gmail.com', '$2y$10$6Tk30axryMy8RD0rRCIZ8edDrZXtRUAddsILQyJYvWSP7M4ULlwy6', 'Termina', 'asdsa', '0000-00-00', 'admin'),
(6, 'customer123@gmail.com', '$2y$10$c3wpFyBZ6pZDERzx93PoKe2DLA6GHeUDFEqny16na60DqG45B6q5.', 'rizki', 'ganteng anjay', '2024-12-04', 'customer'),
(7, 'customer1@gmail.com', '$2y$10$SO2N93y3VJXwu9FCAS31y.G4PRcqrpvfLsO6VB/vQi7yo5bkHce4u', 'Lunetta', 'Maheswara Grahawijaya', '0000-00-00', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerid` (`sellerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderby` (`orderby`);

--
-- Indexes for table `querycatalog`
--
ALTER TABLE `querycatalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerid` (`sellerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `querycatalog`
--
ALTER TABLE `querycatalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`sellerid`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`orderby`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
