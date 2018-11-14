-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2018 at 09:53 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blpr_pagewithfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `CategoryDescription` varchar(500) COLLATE utf8_polish_ci DEFAULT NULL,
  `CategoryImage` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `CategoryDescription`, `CategoryImage`) VALUES
(1, 'Toppings', 'A great selection of sauces for your pizza', NULL),
(2, 'Cheeses', 'Different types of cheese that you can compose', NULL),
(3, 'Sauces', 'Sauces thanks to which you can feel the better taste of the pizza', NULL),
(4, 'Crust', 'You can select a size of your favourite pizza', NULL),
(5, 'PreparedPizza', '\r\nYou can taste the best pizza you have prepared', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `Login` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `Date` datetime(6) DEFAULT NULL,
  `Name` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `SurName` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `Address1` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `City` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `ZipCode` varchar(6) COLLATE utf8_polish_ci DEFAULT NULL,
  `PhoneNumber` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Login`, `Password`, `Date`, `Name`, `SurName`, `Email`, `Address1`, `City`, `ZipCode`, `PhoneNumber`) VALUES
(23, 'kowalek', '$2y$10$Vgs/BNXfqT17L4.GZPJ4IeTItpl7Fu7qEVhLxTTfSf7xFGBDe.sQu', '2018-11-13 15:06:43.000000', 'dsadsa', 'kowalek', 'lolopdwdwo@gmail.com', 'jwaroznica 30', 'jaworzno', '32-432', 322143224),
(24, 'admin', '$2y$10$Tlcm2r.Pdo7S84f6oBXhEe9FFvkusD9PhwrBSPER7j58F4i2IaCIe', '2018-11-13 16:52:11.000000', 'pawel', 'miklas', 'pawelmiklas@gmail.com', 'chrzanowska', 'balin', '32-432', 321123444);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL DEFAULT '0',
  `CustomerID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `OrderStatus` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `ShippingID` int(11) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  `ShipPrice` decimal(10,0) DEFAULT NULL,
  `PaymentsID` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `OrderDetails` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentsID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `PaymentAmount` decimal(10,2) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `PaymentMethod` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `MakeTime` time DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Description` text COLLATE utf8_polish_ci,
  `Price` decimal(10,2) DEFAULT NULL,
  `ProductImage` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `MakeTime`, `CategoryID`, `Description`, `Price`, `ProductImage`) VALUES
(1, 'margherita', '00:20:00', 5, 'caputo tipo 1 multigrain,\r\nsan marzano tomatoes D.O.P.,\r\nsea salt, oregano, garlic', '31.00', NULL),
(2, 'capriciosa', '00:25:00', 5, 'honey, calabrese peppers, scallions,\r\nmozzarella, piave cheese, fried caramelized\r\nonions, serrano peppers', '32.00', NULL),
(3, 'parma', '00:27:24', 5, 'tomato sauce, mozzarella, pepperoni,\r\nred onion, asiago, basil, sorghum,\r\n nduja (soft, spicy salami)', '27.00', NULL),
(4, 'campione', '00:21:20', 5, 'mozzarella, potatoes, rosemary, calabrese\r\npeppers, chorizo, quail eggs, guanciale\r\n(pork cheek), fromage blanc, lavender sea salt ', '28.00', NULL),
(5, 'decoro', '00:23:10', 5, 'mozzarella, smoked paprika, chorizo,\r\ntomato cream sauce, prosciutto, manchego\r\ncheese', '28.50', NULL),
(6, 'pepe', '00:18:00', 5, 'sliced aiello mozzarella,\r\namatriciana tomato sauce w/ guanciale,\r\nonion, olive oil, grated romano', '29.30', NULL),
(7, 'napoletana', '00:21:00', 5, 'tomato sauce, mozzarella,\r\nprosciutto di parma, arugula', '31.00', NULL),
(8, 'tarfuto', '00:20:20', 5, 'mozzarella, burrata, peppered\r\ngoat cheese, wild mushrooms, truffle oil', '29.00', NULL),
(9, 'Barbecue', NULL, 3, 'made from tomato puree, mustard, vinegar', '1.00', NULL),
(10, 'Apple', NULL, 3, 'accompaniment to roast pork, but also a good way', '1.00', NULL),
(11, 'Bearnaise', NULL, 3, 'A classic French sauce made with a reduction of vinegar', '2.00', NULL),
(12, 'Chilli', NULL, 3, 'Liven up a dish of eggs, bring zing', '2.00', NULL),
(13, 'Cheese', NULL, 3, 'Makes macaroni cheese in minutes', '1.00', NULL),
(14, 'Bread', NULL, 3, 'This crowd-pleasing bread sauce recipe', '3.00', NULL),
(15, 'Custard', NULL, 3, 'perfect for slathering on crumbles, pies and puddings', '2.00', NULL),
(16, 'Roquefort', NULL, 2, 'The blue pockets of mold that dot a chunk of Roquefort', '3.00', NULL),
(17, 'Camembert', NULL, 2, 'As one of the most widely produced French cheeses', '3.00', NULL),
(18, 'Cotija', NULL, 2, 'Younger cheeeses are mild and salty, somewhat like a young feta', '3.00', NULL),
(19, 'Chevre', NULL, 2, 'he French word chevre literally is used to refer to any cheese made from goat\'s milk.', '2.00', NULL),
(20, 'Feta', NULL, 2, 'Feta is one of the many cheese worldwide to be a protected designation of origin product', '2.00', NULL),
(21, 'Mozzarella', NULL, 2, 'Mozzarella is a fresh, pulled-curd cheese made from the milk of water buffalo', '3.00', NULL),
(22, 'Emmental', NULL, 2, 'Emmental is what many people think of when they hear Swiss cheese', '2.00', NULL),
(23, 'Cheddar', NULL, 2, 'Cheddar is a cow\'s milk cheese that originated in Somerset, England', '4.00', NULL),
(24, 'Pepperoni', NULL, 1, 'Fresh, tasty and delicious toping for you', '1.00', NULL),
(25, 'Bacon', NULL, 1, 'a healthy supplement is for you', '1.00', NULL),
(32, 'Habanero', NULL, 1, 'The chili pepper from Nahuatl chīlli Nahuatl pronunciation', '1.00', NULL),
(33, 'Mushroom', NULL, 1, 'A mushroom, or toadstool, is the fleshy, spore-bearing fruiting body of a fungus', '1.00', NULL),
(34, 'Garlic', NULL, 1, 's a species in the onion genus, Allium. Its close relatives include the onion', '1.00', NULL),
(35, 'Pineapple', NULL, 1, 'Is a tropical plant with an edible multiple fruit consisting of ', '1.00', NULL),
(36, 'Sausages', NULL, 1, 'A sausage is a cylindrical meat product usually made from ground meat', '1.00', NULL),
(37, 'Caramel', NULL, 1, 'is a species in the onion genus, Allium. Its close relatives include the onion', '1.00', NULL),
(38, 'Chicken', NULL, 1, 'The chili pepper from Nahuatl chīlli Nahuatl pronunciation', '1.00', NULL),
(39, 'Cucumber', NULL, 1, 'A mushroom, or toadstool, is the fleshy, spore-bearing fruiting body of a fungus', '1.00', NULL),
(40, 'Lettuce', NULL, 1, 's a species in the onion genus, Allium. Its close relatives include the onion', '1.00', NULL),
(41, 'Spinach', NULL, 1, 'Is a tropical plant with an edible multiple fruit consisting of ', '1.00', NULL),
(42, 'Carrot', NULL, 1, 'A sausage is a cylindrical meat product usually made from ground meat', '1.00', NULL),
(43, 'Onion', NULL, 1, 'is a species in the onion genus, Allium. Its close relatives include the onion', '1.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `ShippingID` int(11) NOT NULL,
  `ShippingMethod` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`ShippingID`, `ShippingMethod`) VALUES
(1, 'DHL courier'),
(2, 'Parcel locker'),
(3, 'Post office');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`,`ProductID`,`ShippingID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `ShippingID` (`ShippingID`),
  ADD KEY `PaymentID` (`PaymentsID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentsID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `Price` (`Price`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ShippingID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ShippingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `Order_ibfk_3` FOREIGN KEY (`ShippingID`) REFERENCES `shipping` (`ShippingID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `Payments_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
