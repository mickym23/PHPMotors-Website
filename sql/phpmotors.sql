-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 06:01 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(17, 'Admin', 'User', 'admin@cse340.net', '$2y$10$UjqEztnZyhDj9ICXnsa.be5UzqE/Y/F3Vg8x6xRoUdryFxCWVIqZa', '3', NULL),
(18, 'Melinda', 'Cedras', 'melinda.cedras@bloemkolk.com', '$2y$10$1yWkTcXHjfHyzKuG/B6NNOoh67B3ghfsKEaB/Or8uD24XyUosxTG6', '1', NULL),
(21, 'Micky', 'M', 'mickym@gmail.com', '$2y$10$s1Wid.VnVYj77ghm.2G6be8pj12eTnD2XrrVAuUbnhY06TxKFVc5y', '1', NULL),
(25, 'Bob', 'Ross', 'yeah@gmail.com', '$2y$10$v/NPuLs0eUgxRKADmatAt.SqU2N3qweFljZu1GEKRNLWVbo0ATFxa', '1', NULL),
(26, 'Mikhail', 'Cedras', 'test@gmail.com', '$2y$10$kzKbU2RhTIuNb2amENvBdOOPZrZ37P7IX18YRR8lW0QPD.AqMWMzu', '1', NULL),
(27, 'Yo', 'Fredericks', 'yo@gmail.com', '$2y$10$FI3Tg8ZZHNRZPowdcwyn0ee1PyIZyqtqXhfA5yL1bvXsCJadFSj3S', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(31, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-07-07 04:33:18', 1),
(32, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-07-07 04:33:18', 1),
(33, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-07-07 04:33:53', 1),
(34, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-07-07 04:33:53', 1),
(35, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-07-07 04:34:14', 1),
(36, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-07-07 04:34:14', 1),
(37, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-07-07 04:34:29', 1),
(38, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-07-07 04:34:29', 1),
(39, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-07-07 04:34:42', 1),
(40, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-07-07 04:34:42', 1),
(41, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-07-07 04:34:58', 1),
(42, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-07-07 04:34:58', 1),
(43, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-07-07 04:35:09', 1),
(44, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-07-07 04:35:09', 1),
(45, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-07-07 04:35:36', 1),
(46, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-07-07 04:35:37', 1),
(47, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2021-07-07 04:35:53', 1),
(48, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2021-07-07 04:35:53', 1),
(49, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-07-07 04:52:19', 1),
(50, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-07-07 04:52:19', 1),
(51, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-07-07 04:52:30', 1),
(52, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-07-07 04:52:30', 1),
(53, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-07-07 04:52:46', 1),
(54, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-07-07 04:52:46', 1),
(55, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-07-07 04:53:02', 1),
(56, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-07-07 04:53:02', 1),
(57, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-07-07 04:53:22', 1),
(58, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-07-07 04:53:22', 1),
(59, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-07-07 04:53:35', 1),
(60, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-07-07 04:53:35', 1),
(61, 32, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-07-07 05:02:00', 1),
(62, 32, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-07-07 05:02:00', 1),
(63, 1, 'wrangler2.jpg', '/phpmotors/images/vehicles/wrangler2.jpg', '2021-07-07 05:06:04', 0),
(64, 1, 'wrangler2-tn.jpg', '/phpmotors/images/vehicles/wrangler2-tn.jpg', '2021-07-07 05:06:04', 0),
(65, 3, 'aventador2.jpg', '/phpmotors/images/vehicles/aventador2.jpg', '2021-07-07 05:06:23', 0),
(66, 3, 'aventador2-tn.jpg', '/phpmotors/images/vehicles/aventador2-tn.jpg', '2021-07-07 05:06:23', 0),
(67, 10, 'camaro2.jpg', '/phpmotors/images/vehicles/camaro2.jpg', '2021-07-07 05:06:40', 0),
(68, 10, 'camaro2-tn.jpg', '/phpmotors/images/vehicles/camaro2-tn.jpg', '2021-07-07 05:06:40', 0),
(69, 1, 'wrangler3.jpg', '/phpmotors/images/vehicles/wrangler3.jpg', '2021-07-08 00:44:38', 0),
(70, 1, 'wrangler3-tn.jpg', '/phpmotors/images/vehicles/wrangler3-tn.jpg', '2021-07-08 00:44:38', 0),
(71, 3, 'lambo3.jpg', '/phpmotors/images/vehicles/lambo3.jpg', '2021-07-08 00:44:57', 0),
(72, 3, 'lambo3-tn.jpg', '/phpmotors/images/vehicles/lambo3-tn.jpg', '2021-07-08 00:44:57', 0),
(73, 10, 'camaro3.jpg', '/phpmotors/images/vehicles/camaro3.jpg', '2021-07-08 00:45:20', 0),
(74, 10, 'camaro3-tn.jpg', '/phpmotors/images/vehicles/camaro3-tn.jpg', '2021-07-08 00:45:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it&#39;s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '3000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 4, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You&#39;ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month.', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(32, 'DMC', 'DeLorean', 'The DeLorean', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', '50000', 1, 'Grey', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(28, 'This is a really great car to drive!', '2021-07-16 08:36:33', 2, 27),
(30, 'Fly High, Kind Two.', '2021-07-16 08:36:48', 13, 27),
(31, 'This thing was SUPER fast!', '2021-07-16 11:12:38', 3, 27),
(32, 'This car looks amazing!', '2021-07-16 11:16:53', 10, 27),
(33, 'Great drive!', '2021-07-16 13:23:46', 2, 26),
(35, 'I love Jeep! Great experience.', '2021-07-16 14:52:07', 1, 26),
(36, 'An antique for such a cheap price!', '2021-07-16 15:49:46', 2, 26),
(37, 'I&#39;m surprised that they still sell these cars for general use. Pretty cool!', '2021-07-16 15:50:55', 2, 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_inv_reviews` (`invId`),
  ADD KEY `FK_client_reviews` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_client_reviews` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inv_reviews` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
