-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 08:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petmatch_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` varchar(30) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Available',
  `seller_name` varchar(100) DEFAULT NULL,
  `seller_contact` varchar(100) DEFAULT NULL,
  `date_posted` datetime(6) DEFAULT current_timestamp(6),
  `adoption_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `name`, `category`, `breed`, `age`, `gender`, `price`, `description`, `image`, `status`, `seller_name`, `seller_contact`, `date_posted`, `adoption_type`) VALUES
(1, 'Dogo', 'Dog', 'German ', '3', 'Male', 5000.00, 'He is a sweet dog ', 'uploads/cat-with-yellow-face-circle-with-logo-that-says-whiskers_772298-109702.jpg', 'Available', 'Youngtag', '09154042766', '2025-10-24 15:55:12.431655', ''),
(2, 'Cath', 'Cat', 'Random', '1', 'Female', 2000.00, 'Idk', 'uploads/Screenshot 2024-08-14 234600.png', 'Available', 'Upi', 'kingkwane543@gmail.com', '2025-10-24 17:18:47.320804', ''),
(4, 'Turtoos', 'Reptile', 'Random', '4', 'Female', 350.00, 'Just found it in the lake ', 'uploads/zombie.jpg', 'Available', 'OPO', 'kingkwane543@gmail.com', '2025-10-24 18:07:24.824784', ''),
(5, 'asdfasdf', 'Fish', 'asdfsadf', '1', 'Male', 99999999.99, 'wdfasefasdfasdf', 'uploads/OIP.webp', 'Available', 'Upi', 'kingkwane543@gmail.com', '2025-10-24 18:09:08.163766', ''),
(6, 'BIrdy', 'Bird', 'Owl', '1', 'Male', 2000.00, 'It just flew directly into my bird cage', 'uploads/Screenshot 2024-08-14 234600.png', 'Available', 'Mala Oten', 'kingkwane543@gmail.com', '2025-10-24 18:22:03.097675', ''),
(8, 'Pickachu', 'Cat', NULL, '1', NULL, 0.00, 'Awesome cat, have some ability that is electrifying ', 'uploads/images.jpg', 'Adoptable', NULL, NULL, '2025-10-24 18:54:08.282799', ''),
(12, 'qwefwqefwqef', 'Bird', NULL, '1', NULL, 2222.00, 'qwefwdfsd', 'uploads/birdy.jpg', 'For Sale', NULL, NULL, '2025-10-26 10:45:30.468514', ''),
(14, 'wer332ewdwef', 'Reptile', NULL, '777', NULL, 12.00, 'efbernjt h 4 4 24 ', 'uploads/animals.jpg', 'Available', NULL, NULL, '2025-10-26 10:54:59.903917', ''),
(15, 'fasdf', 'Rabbit', NULL, '1', NULL, 200.00, 'wefwdfawdf', 'uploads/saded.png', 'Available', NULL, NULL, '2025-10-26 11:05:02.527571', ''),
(16, '2323r23r23r23r23r', 'Fish', NULL, '2 months ', NULL, 333.00, '344g34rg3434', 'uploads/fish.jpg', 'Available', NULL, NULL, '2025-10-26 11:06:18.700851', ''),
(17, 'bogng', 'Dog', NULL, '5', NULL, 222.00, 'ergqwefwegqweferfwef', 'uploads/broken.png', 'Available', NULL, NULL, '2025-10-26 11:07:00.378295', ''),
(18, 'Browny', 'Dog', NULL, '3', NULL, 22222.00, 'wdfwefwefwefwefwef', 'uploads/ahhhhh.jpg', 'Available', NULL, NULL, '2025-10-26 11:13:11.383470', ''),
(19, 'fasdf', 'Dog', NULL, '2', NULL, 0.00, 'sdfsdfsdf', 'uploads/ahhhhh.jpg', 'Adoptable', NULL, NULL, '2025-10-26 11:13:49.901277', ''),
(20, 'sadfasdfasdfsadf', 'Dog', NULL, '3', NULL, 0.00, 'qwerwerqwqer', 'uploads/ahhhhh.jpg', 'Available', NULL, NULL, '2025-10-26 11:26:58.255325', ''),
(21, 'birdy', 'Bird', NULL, '5', NULL, 0.00, 'ergerg', 'uploads/GiftoftheMagii-1lguwzc.jpg', 'Available', NULL, NULL, '2025-10-26 12:44:18.569827', ''),
(22, 'rabbb', 'Rabbit', NULL, '1', NULL, 0.00, 'gggg', 'uploads/Acer_Wallpaper_03_3840x2400.jpg', 'Available', NULL, NULL, '2025-10-26 12:45:55.202373', ''),
(23, 'ffffff', 'Fish', NULL, '2', NULL, 0.00, 'sdfsdf', 'uploads/Acer_Wallpaper_04_3840x2400.jpg', 'Available', NULL, NULL, '2025-10-26 12:47:15.031144', ''),
(24, 'torto', 'Reptile', NULL, '4', NULL, 0.00, 'sfdgasdfsadfasdf', 'uploads/Acer_Wallpaper_01_3840x2400.jpg', 'Available', NULL, NULL, '2025-10-26 12:48:07.967145', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
