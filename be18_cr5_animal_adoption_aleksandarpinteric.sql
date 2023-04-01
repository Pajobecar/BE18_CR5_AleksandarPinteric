-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 04:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be18_cr5_animal_adoption_aleksandarpinteric`
--
CREATE DATABASE IF NOT EXISTS `be18_cr5_animal_adoption_aleksandarpinteric` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be18_cr5_animal_adoption_aleksandarpinteric`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `vaccination_status` varchar(50) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `adopted` varchar(5) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `size`, `age`, `vaccination_status`, `breed`, `location`, `picture`, `adopted`) VALUES
(1, 'Max', 'Medium', 10, 'Yes', 'Golden Retriever', 'Vienna', 'goldenretriever.jpg', 'no'),
(2, 'Bella', 'Small', 5, 'No', 'Chihuahua', 'Vienna', 'chihuahua.jpg', 'yes'),
(3, 'Rocky', 'Large', 9, 'Yes', 'German Shepherd', 'Graz', '64282aa11c416.jpg', ''),
(4, 'Lucy', 'Medium', 8, 'Yes', 'Labrador Retriever', 'Salzburg', 'labrador.jpg', 'no'),
(5, 'Charlie', 'Small', 12, 'No', 'Dachshund', 'Linz', 'dachshund.jpg', 'no'),
(6, 'Luna', 'Large', 6, 'Yes', 'Husky', 'Salzburg', 'husky.jpg', 'no'),
(7, 'Milo', 'Medium', 7, 'No', 'Beagle', 'Vienna', 'beagle.jpg', 'no'),
(8, 'Daisy', 'Small', 10, 'Yes', 'Poodle', 'Vienna', 'poodle.jpg', 'no'),
(9, 'Maximus', 'Large', 1, 'Yes', 'Rottweiler', 'Linz', 'rottweiler.jpg', 'no'),
(10, 'Buddy', 'Small', 11, 'No', 'Jack Russell Terrier', 'Graz', 'jackrussellterrier.jpg', 'no'),
(11, 'Bailey', 'Medium', 4, 'No', 'Australian Shepherd', 'Vienna', 'australianshepherd.jpg', 'no'),
(12, 'Sasha', 'Large', 8, 'Yes', 'Great Dane', 'Vienna', 'greatdane.jpg', 'no'),
(13, 'Molly', 'Medium', 9, 'Yes', 'Boxer', 'Salzburg', 'boxer.jpg', 'no'),
(14, 'Zoe', 'Small', 8, 'Yes', 'Shih Tzu', 'Graz', 'shihtzu.jpg', 'no'),
(15, 'Harley', 'Large', 10, 'No', 'Doberman Pinscher', 'Linz', 'doberman.jpg', 'no'),
(24, 'Maximusse', 'Small', 1, 'Yes', 'Rottweiler', 'Linz', '6428276d868f4.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `adoption_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
