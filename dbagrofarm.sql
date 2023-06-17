-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 03:54 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbagrofarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `Cart_ID` int(11) NOT NULL,
  `C_ProductID` varchar(20) NOT NULL,
  `C_quantity` int(11) NOT NULL,
  `C_CusNIC` varchar(10) NOT NULL,
  `C_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`Cart_ID`, `C_ProductID`, `C_quantity`, `C_CusNIC`, `C_date`) VALUES
(1, 'E-GS0001', 1, '1111111111', '2021-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `ContactID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `C_NIC` varchar(10) NOT NULL,
  `C_First_Name` varchar(100) NOT NULL,
  `C_Last_Name` varchar(100) NOT NULL,
  `C_gender` varchar(10) NOT NULL,
  `C_age` int(2) NOT NULL,
  `C_address` varchar(200) NOT NULL,
  `C_email` varchar(100) NOT NULL,
  `C_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`C_NIC`, `C_First_Name`, `C_Last_Name`, `C_gender`, `C_age`, `C_address`, `C_email`, `C_phone`) VALUES
('1111111111', 'ccc', 'ccc', 'male', 23, '1wqwq', 'C1@c.c', '1111111111');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_login`
--

CREATE TABLE `tbl_customer_login` (
  `Customer_LoginID` int(11) NOT NULL,
  `CL_CusNIC` varchar(10) NOT NULL,
  `C_username` varchar(20) NOT NULL,
  `C_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_login`
--

INSERT INTO `tbl_customer_login` (`Customer_LoginID`, `CL_CusNIC`, `C_username`, `C_password`) VALUES
(1, '1111111111', 'ccc', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `NotificationID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `CusNIC` varchar(10) NOT NULL,
  `CusStatus` int(1) NOT NULL,
  `AuthStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `Order_ID` int(11) NOT NULL,
  `O_CusNIC` varchar(20) NOT NULL,
  `O_note` varchar(100) NOT NULL,
  `O_totalprice` double NOT NULL,
  `O_date` date NOT NULL,
  `O_nearwarehouse` varchar(200) NOT NULL,
  `O_pickupat` varchar(200) NOT NULL,
  `O_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_product`
--

CREATE TABLE `tbl_order_product` (
  `OrderProduct_ID` int(11) NOT NULL,
  `OP_ProductID` varchar(20) NOT NULL,
  `OP_quantity` int(11) NOT NULL,
  `OP_OrderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `Payment_ID` int(11) NOT NULL,
  `Payment_type` varchar(20) NOT NULL,
  `Payment_status` varchar(20) NOT NULL,
  `Pay_OrderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `Product_ID` varchar(20) NOT NULL,
  `P_name` varchar(200) NOT NULL,
  `P_brandname` varchar(50) NOT NULL,
  `P_title` varchar(250) NOT NULL,
  `P_type` varchar(20) NOT NULL,
  `P_category` varchar(100) NOT NULL,
  `P_details` varchar(250) NOT NULL,
  `P_quantity` int(5) NOT NULL,
  `P_unitprice` double NOT NULL,
  `P_image` varchar(250) NOT NULL,
  `P_itemstatus` varchar(20) NOT NULL,
  `P_warehouse` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`Product_ID`, `P_name`, `P_brandname`, `P_title`, `P_type`, `P_category`, `P_details`, `P_quantity`, `P_unitprice`, `P_image`, `P_itemstatus`, `P_warehouse`) VALUES
('E-GS0001', 'Pruning Sacateur', 'xxx', 'Falcon Pruning Sacateur - FPS 209 Ratchet Type {Size: 190mm} *Newly Launched* Easy Pruning in Short Steps for Thicker and Tougher Stems', 'Equipment', 'E2', 'Non Slip Grip; Lightweight\r\nHigh Quality Spring; Safety Lock\r\nCutting Capacity: 18mm\r\nRatchet Type\r\nOne year warranty against any manufacturing defect', 7, 1500, '81FXSNHcIuS._SL1500_.jpg', 'In Stock', 'WC1234'),
('E-GS0002', '4 Stroke 35cc Brush Cutter', 'xxx', 'Insight Equipments 4 Stroke 35cc Brush Cutter NEW AND IMPROVED Petrol engine Side Pack Crop | Grass Cutter Machine for Agriculture Extra Power | Torque Engine With Extra Attachment', 'Equipment', 'E2 ', 'Brand - Insight Equipments\r\nItem Dimensions (LxWxH) - 72 x 30 x 25 Centimeters\r\nItem Weight - 12 Kilograms\r\n\r\nAbout this item\r\nWe Provide Heavy Duty 35cc 4- Stroke Brush Cutter Machine For Agriculture As Well As Lawn Grass Cutting.\r\nDisplacement : 35', 15, 15000, '81jzGxgyMjL._SL1500_.jpg', 'In Stock', 'WC1234'),
('E-GSC0001', 'Leaf Cutter', 'xxx', 'Xacton Garden Shears Sharp Cutter, Flower Cutter, Leaf Cutter for Potted Plants, Ardening Scissor/Pruning Shear, Pruning Seeds with Grip-Handle Flower Cutter Gardening Tools - Random Color', 'Equipment', 'E4', 'High quality garden shears. Ideal for cutting hedges and bushes. High quality strong steel blade. Great for trimming a variety of bushes and hedges\r\nExceptional quality handles are covered by padded soft grip handle for comfort and reduced hand fatig', 9, 1600, '41GBU6-4dwL.jpg', 'In Stock', 'WC1234'),
('E-MW0001', 'Gardening Hand Tool Kit', 'xxx', 'TrustBasket 5Pcs Durable Gardening Hand Tool Kit for Home Gardening (Weeder, Big Trowel, Hand Fork,Cultivator)', 'Equipment', 'E1', '***Buy Original, sold and fulfilled by Trust basket***\r\nPerfect tool set for all your gardening needs.\r\nContents : Weeder, Cultivator, Big Trowel, Small Trowel, Garden Fork\r\nMetal Parts are Powder Coated for Rust Protection\r\nSpecially Designed Handle', 9, 3500, '61mCS9kj2uS._SL1500_.jpg', 'In Stock', 'WC1234'),
('E-MW0002', 'Brush Cutter 28mm', 'xxx', 'Weeder/Weeding in Fruits and Vegetables//Suitable for All Type of Side Pack Brush Cutter (11 Inch)', 'Equipment', 'E1', 'Brand - Balwaan\r\nItem Dimensions (LxWxH) -	32 x 19 x 20 Centimeters\r\nPower Source - Fuel\r\n\r\nS Type Weeder Attachment for Back Pack Brush Cutter\r\nUseful for Removing Unwanted Weeds, Weeding in Fruits and Vegetables etc.\r\nOnly for 28mm shaft\r\n9 Teeth i', 3, 5000, '51TTksllafL._SL1000_.jpg', 'In Stock', 'WC1234'),
('E-MW0003', 'Garden Hedge Shears/Cutter ', 'xxx', 'Kraft Seeds Gate Garden Hedge Shears/Cutter Comfort Grip Wooden Handles, Heavy Duty Soft Grip (Multicolour)', 'Equipment', 'E1', 'Material: Metal and wood , blade size: 10 inches\r\nGardening hedge shears are an essential tool in your home for perfect results every time.\r\nYour garden will be the talk of the town with these hedge clippers that deliver sharp, smooth cuts for clean ', 5, 2300, '61nPMoO2qkL._SL1500_.jpg', 'In Stock', 'WC1234'),
('E-RS0001', 'Garden Store Rake', 'xxx', 'Garden Store Rake 12 Teeth Hand Cultivator Rake Grass Leaf Rake Without Handle (Red)', 'Equipment', 'E3', '12 teeth without handle.Package Contents: Rake .Attaches to any Wolf-Garten handle .Good quality product for use\r\nPackage Contents: Rake\r\nAttaches to any Wolf-Garden handle', 10, 950, '31mBhx1jFjS.jpg', 'In Stock', 'WC1234'),
('E-RS0002', 'Garden Leaf Rake', 'xxx', 'ALIZ Stainless Steel Tooth Garden Leaf Rake for Gardening and Planting, Multicolor, 1 Piece', 'Equipment', 'E3', 'This hard metal rake is undoubtedly one of the important garden tools that you should have in hand to perform various tasks.\r\nHelps in cleaning tasks in garden.\r\nFor digging out weeds.', 8, 1350, '51TZe9WjouL._SL1024_.jpg', 'In Stock', 'Not Specified'),
('E-RS0003', 'Hand Rake', 'xxx', 'Niyanta 5 Tine Garden Tool | Tooth Harrow Garden Tool | Hand Rake with Plastic Handle | Perfect for loosening,Sculpting Soil, Removing Weeds, Aerated Soil | Non-Slip Grip for Home Garden Lawn Farm', 'Equipment', 'E3', 'Bi-material, soft feel and non slip contoured handle for comfortable use, cranked to eliminate scraped knuckles and provide additional leverage.\r\nThe comfortable rubber handle is ergonomically designed to relieve stress on the wrists and hands. The p', 15, 2200, '51O0cblAA+L._SL1200_.jpg', 'In Stock', 'WC1234'),
('E-RS0004', 'Telescopic Metal Rake', 'xxx', 'Sharpex Telescopic Metal Rake, Adjustable Rake for Quick Clean Up of Lawn and Yard, Garden Leaf Rake, Expanding Handle with Adjustable 31 to 64 Inch Width Folding Head', 'Equipment', 'E3', 'LESS BENDING & BIGGER EFFICIENT HEAD: 64” telescopic garden rake is made longer for less bending down and less fatigue during long time work. The 21.10” Larger head of garden rake collects more debris with each pass efficiently. Adjust garden rake he', 15, 2500, '71Rg+O39m3L._SL1500_.jpg', 'In Stock', 'WC2345'),
('E-RS0005', 'Folding Shovel', 'xxx', 'Multitool Mini Outdoor Camping Folding Shovel', 'Equipment', 'E3', 'This Heavy-Duty Multi purpose Tool Serves Many Functions And Folds Into a Portable Carrying Case With Belt Loop.\r\nPerfect for backpacking, camping, gardening and even field training, outdoor survival', 15, 1300, '31C7V-yJDQL.jpg', 'In Stock', 'WC1234'),
('E-RS0006', 'Flat Blade Spade/Shovel', 'xxx', 'Pretail Glass World Pretail Garden Flat Blade Spade/Shovel (Belcha) with Wooden Handle, Heavy Duty Agricultural Tool', 'Equipment', 'E3', 'Heavy Duty Flat Blade Gardening Spade\r\nStrong Wooden Handle\r\nMade for rough use and long lasting\r\nThis is a big heavy Spade. Material: Mild Steel Blade Size: about 310 * 240 mm Handle Size : About 700 mm Usage: Widely used for digging, moving, liftin', 10, 2500, '61BDEJtZX6L._SL1500_.jpg', 'In Stock', 'WC2345'),
('F-F0001', 'Nutrition Solution', 'xxx', 'Nutrient Solution For Hydroponic Flower And Fertilizer Of Fleshy Plants Universal Nutrient Solution For Hydroponic Plants', 'Fertilizer', 'F6', 'Usage: Add nutrient solution each time you change the water. Each bottle can be used 10 times. Adjust the usage according to the capacity of the water in your container. A single bottle of plants can be used for about 1 month!\r\n\r\nApplicable plants: S', 20, 570, '0-main-1pcs-nutrient-solution-for-hydroponic-flower-and-fertilizer-of-fleshy-plants-universal-nutrient-solution-for-hydroponic-plants (1).png', 'In Stock', 'WC1234'),
('F-F0002', 'Flower Booster', 'xxx', 'TrustBasket Flower Booster (Single) - 500 Gram Provides All Essential Multi Micro nutrients for All Flowering Plants. It Can be diluted to More Than 125 litres', 'Fertilizer', 'F6', 'Weight: 500g\r\n\r\nPackage Contains - Single 500Grams\r\nIt has the ability to increase flower production.\r\nIt keeps the plants healthy, greener and attractive.\r\nIt increases the plant size and number of flowers per plant.\r\nIt imparts original color and a', 25, 370, '81PBD2sx80L._SL1500_.jpg', 'In Stock', 'WC2345'),
('F-P0001', 'Urea ', 'xxx', 'Urea for Paddy fields', 'Fertilizer', 'F1 ', 'Nitrogen - 46%min\r\nMoisture - 1%max\r\nBiuret - 1%max\r\nPrilled - 0.85-2mm\r\nGranular - 2-4mm 90-94%min\r\nColor - Pure White\r\nRadiation - Non-Radiactive\r\nFree Ammonia - 160pxt ppm max', 25, 3500, 'b4dadbac054846c2e919d9a975ef1b20.jpg', 'In Stock', 'WC1234'),
('F-P0002', 'TSP ', 'xxx', 'Tsp (Triple super phosphate) Fertilizer', 'Fertilizer', 'F1', '50Kg\r\nTotal Phosphate%≥	46\r\nAvailable Phosphate(P2O5) %≥	44\r\nsoluble phosphate (P2O5) %≥	38\r\nFree acid (P2O5) %≥\r\nMoisture%≤\r\nMoisture%≤', 20, 4000, 'tsp-triple-super-phosphate-phosphate-fertilizer_1341_84491.jpg', 'In Stock', 'WC2345'),
('F-R0001', 'Triple 10 All Purpose Liquid Fertilizer', 'xxx', 'Rubber (ERP Based) 10-10-10 with Amino Acids (5.5%) & Seaweed Extract (32oz)', 'Fertilizer', 'F3  ', 'ALL PURPOSE: 10-10-10 with Amino Acids (5.5%) & Seaweed Extract is a generic liquid fertilizer designed for all stages of plant growth.\r\n\r\nUSE SITES: Great for gardens, flowers, fruits, vegetables, turf grasses etc.| Suitable for indoor & outdoor use', 10, 2500, '71q791IlIjS._SL1500_.jpg', 'In Stock', 'WC1234'),
('F-T0001', 'T -65 for Tea', 'xxx', 'T -65 for Tea Fertilizer', 'Fertilizer', 'F2', 'Weight: 20Kg\r\nMixing: U 709  (ERP Based)\r\nN:P2O:K2O:  MgO - 28:4:14\r\nAge of Plant - Until 8-11 months\r\nMix 35g into 5 l of water per 120 plants. After 5-6 months mix 70 g into 5 l of water per 120 Plants.\r\nOnce in 2 weeks\r\nApply by using a shower and', 20, 2500, 'Screenshot 2021-09-19 171251.png', 'In Stock', 'WC2345'),
('F-T0002', 'ST/LC 365', 'xxx', 'ST/LC 365 Tea Fertilizer', 'Fertilizer', 'F2', 'Weight: 75Kg\r\nFor mature tea after 1st prune\r\nApply in the shady area around the tree\r\nOnce in 6 months', 15, 7500, 'Screenshot 2021-09-19 171251.png', 'In Stock', 'WC1234'),
('F-V0001', 'Organic Vermicompost Fertilizer', 'xxx', 'TrustBasket Organic Vermicompost Fertilizer Manure for Plants', 'Fertilizer', 'F4', 'Weight: 5Kg\r\n\r\n***Buy Original, sold and fulfilled by Trust basket***\r\nImproves Soil Aeration\r\nEnriches Soil With Micro-Organisms (Adding Enzymes Such As Phosphatase And Cellulase)\r\nMicrobial Activity In Worm Castings Is 10 To 20 Times Higher Than In', 20, 250, '71iPA5LfB7L._SL1500_.jpg', 'In Stock', 'WC2345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_login`
--

CREATE TABLE `tbl_staff_login` (
  `Staff_LoginID` int(11) NOT NULL,
  `SL_StaffID` varchar(10) NOT NULL,
  `S_username` varchar(20) NOT NULL,
  `S_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_member`
--

CREATE TABLE `tbl_staff_member` (
  `Staff_ID` int(11) NOT NULL,
  `S_First_Name` varchar(200) NOT NULL,
  `S_Last_Name` varchar(200) NOT NULL,
  `S_NIC` varchar(10) NOT NULL,
  `S_gender` varchar(10) NOT NULL,
  `S_age` int(11) NOT NULL,
  `S_email` varchar(150) NOT NULL,
  `S_address` varchar(250) NOT NULL,
  `S_phone` varchar(10) NOT NULL,
  `S_type` varchar(15) NOT NULL,
  `S_WarehouseCode` varchar(20) NOT NULL,
  `S_status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `Warehouse_Code` varchar(20) NOT NULL,
  `W_name` varchar(150) NOT NULL,
  `W_address` varchar(200) NOT NULL,
  `W_district` varchar(20) NOT NULL,
  `W_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`Warehouse_Code`, `W_name`, `W_address`, `W_district`, `W_phone`) VALUES
('WC1234', 'AgroFarm - Matara', 'No 93/12, Samarasekara Road, Matara', 'Matara', '0415896589'),
('WC2345', 'AgroFarm - Galle', 'No 123/8, Galle Road, Galle', 'Galle', '0915896589');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`Cart_ID`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`C_NIC`);

--
-- Indexes for table `tbl_customer_login`
--
ALTER TABLE `tbl_customer_login`
  ADD PRIMARY KEY (`Customer_LoginID`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `tbl_order_product`
--
ALTER TABLE `tbl_order_product`
  ADD PRIMARY KEY (`OrderProduct_ID`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `tbl_staff_login`
--
ALTER TABLE `tbl_staff_login`
  ADD PRIMARY KEY (`Staff_LoginID`);

--
-- Indexes for table `tbl_staff_member`
--
ALTER TABLE `tbl_staff_member`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Indexes for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`Warehouse_Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `Cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer_login`
--
ALTER TABLE `tbl_customer_login`
  MODIFY `Customer_LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_product`
--
ALTER TABLE `tbl_order_product`
  MODIFY `OrderProduct_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_staff_login`
--
ALTER TABLE `tbl_staff_login`
  MODIFY `Staff_LoginID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_staff_member`
--
ALTER TABLE `tbl_staff_member`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
