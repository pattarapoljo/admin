-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2017 at 07:01 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attr_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีลักษณะ',
  `pro_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ไอดีสินค้า',
  `attr_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT 'ชื่อลักษณะ',
  `attr_value` varchar(250) CHARACTER SET latin1 DEFAULT NULL COMMENT 'จุดเด่น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attr_id`, `pro_id`, `attr_name`, `attr_value`) VALUES
(1, 1, 'Color', 'White,Gray'),
(2, 1, 'Size', 'S,M,L,XL,XXL'),
(3, 2, 'Color', 'Black,Blue'),
(4, 2, 'Size', 'S,M,L,XL,XXL'),
(5, 3, 'Color', 'Red'),
(6, 3, 'Size', 'M,L,XL,XXL'),
(7, 4, 'Color', 'Blue'),
(8, 4, 'Size', 'M,L,XL,XXL');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `item_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีของ',
  `pro_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ไอดีสินค้า',
  `attribute` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'ลักษณะ',
  `quantity` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'จำนวน',
  `date_shop` datetime DEFAULT NULL COMMENT 'วันที่ซื้อ',
  `session_id` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT 'ไอดีผู้ใช้'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` smallint(5) UNSIGNED NOT NULL COMMENT 'ไอดีหมวดหมู่',
  `cat_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ชื่อหมวดหมู่'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'เสื้อการ์ด'),
(2, 'ถุงมือ'),
(3, 'หมวกกันน็อค'),
(4, 'ท่อ'),
(5, 'กางเกง'),
(6, 'กระจก');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีลูกค้า',
  `email` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT 'อีเมลล์',
  `password` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'รหัสผ่าน',
  `firstname` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ชื่อ',
  `lastname` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'นามสกุล',
  `address` text CHARACTER SET utf8 COMMENT 'ที่อยู่',
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'โทรศัพท์'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `email`, `password`, `firstname`, `lastname`, `address`, `phone`) VALUES
(1, 'admin@gmail.com', '1234', 'กิตติธร    ', ' พิเศษฤทธิ์', '12/1 ถ.ข้าวเหนียว ต.กุดป่อง อ.เมือง จ.กรุงเทพมหานคร 10000', '042832299'),
(2, 'user@gmail.com', '1234', 'มหาวิทยาลัยราชภัฎ', 'เลย', '40/9 ถ.นกแก้ว ต.กุดป่อง อ.เมือง จ.เลย 42000', '0908501074'),
(3, 'pattarapol93@gmail.com', '1234', 'ภัทรพล', 'ศรีสุธรรม', '40/9 ต.กุดป่อง อ.เมือง จ.เลย 42000', '042123214'),
(4, 'ppookk@gmail.com', '1234', 'สายทิพย์', 'ไชยชนะ', '52/2 ถ.นาอาน ต.กุดป่อง อ.เมือง จ.เลย 42000', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีรูปภาพ',
  `pro_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ไอดีสินค้า',
  `pro_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รูปภาพสินค้า',
  `news_id` int(5) DEFAULT NULL COMMENT 'ไอดีข่าว',
  `news_image` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'รูปภาพข่าว'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีการสั่ง',
  `cust_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ไอดีลูกค้า',
  `order_date` datetime DEFAULT NULL COMMENT 'วันที่สั่ง',
  `paid` set('no','yes') CHARACTER SET utf8 DEFAULT NULL COMMENT 'จ่ายเงิน',
  `delivery` set('no','yes') CHARACTER SET utf8 DEFAULT NULL COMMENT 'ส่งของ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `order_date`, `paid`, `delivery`) VALUES
(10001, 1, '2017-09-08 21:52:39', 'yes', 'yes'),
(10002, 1, '2017-09-10 21:15:51', 'yes', 'yes'),
(10003, 3, '2017-09-10 21:19:25', 'yes', 'yes'),
(10004, 4, '2017-09-11 09:14:56', 'yes', 'yes'),
(10005, 4, '2017-09-11 09:18:48', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `item_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีของ',
  `order_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ไอดีการสั่ง',
  `pro_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ไอดีสินค้า',
  `attribute` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ลักษณะ',
  `quantity` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'จำนวน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`item_id`, `order_id`, `pro_id`, `attribute`, `quantity`) VALUES
(1, 10001, 1, 'Color: Gray, Size: M', 1),
(2, 10002, 3, '', 1),
(3, 10003, 2, '', 1),
(4, 10003, 1, 'Color: White, Size: M', 1),
(5, 10004, 2, 'Color: Black, Size: M', 1),
(6, 10005, 1, 'Color: White, Size: M', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีจ่ายเงิน',
  `order_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีการสั่งซื้อ',
  `cust_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ไอดีลูกค้า',
  `bank` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ธนาคาร',
  `location` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'สานที่',
  `amount` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'จำนวนเงิน',
  `transfer_date` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'วันที่',
  `confirm` set('no','yes') CHARACTER SET utf8 NOT NULL COMMENT 'สถานะ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `order_id`, `cust_id`, `bank`, `location`, `amount`, `transfer_date`, `confirm`) VALUES
(1, 10001, 1, 'กสิกรไทย', 'หน้ามอ', '3200.00', '2017/09/08 21:54', 'yes'),
(2, 10002, 1, 'กสิกรไทย', 'หน้ามอ', '13500.00', '2017/09/10 21:16', 'yes'),
(3, 10003, 3, 'กรุงไทย', 'กุดป่อง', '3490.00', '2017/09/10 21:20', 'yes'),
(4, 10004, 4, 'ไทยพาณิชย์', 'เมืองเลย', '290.00', '2017/09/11 9:16', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ไอดีสินค้า',
  `cat_id` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'ไอดีตะกร้า',
  `sup_id` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'ไอดีผู้จัดส่ง',
  `pro_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `detail` text CHARACTER SET utf8 COMMENT 'รายละเอียด',
  `price` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'ราคา',
  `balance` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'จำนวน',
  `pro_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รูปภาพสินค้า'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `cat_id`, `sup_id`, `pro_name`, `detail`, `price`, `balance`, `pro_image`) VALUES
(1, 1, 1000, 'เสื้อการ์ด DUHAN D-103', 'สวมใส่สบาย', 3200, 5, 'pr59fca881e3bdc.png'),
(7, 3, 1003, 'หมวกกันน็อค HJC', 'สวมใส่', 18000, 6, 'pr59fca8c0ea7b1.png'),
(8, 2, 1002, 'ถุงมือ Kawasaki', 'สวมใส่', 550, 9, 'pr59fca8c9d0b9e.png'),
(2, 2, 1005, 'ถุงมือ PRO -BIKER MCS-01S', 'ถุงมือ PROBIKER ผลิตจากผ้า Mesh Air Flow ระบายอากาศอย่างดี ที่สุดของคุณภาพ การ์ดพลาสติกแข็งแรงทนทาน ดีไซน์เท่โดนใจ BIKER', 300, 7, 'pr59fca899e06a0.png'),
(3, 3, 1003, 'หมวกกันน็อค NITEK P1 – JORDI TORRES REPLICA 2015', 'หมวกกันน็อคแบบเต็มใบ ดีไซน์ดุดัน กระแทกใจ โดดเด่นที่สุดบนท้องถนน ผลิตจากวัสดุชุั้นดี แข็งแรงทนทาน มีน้ำหนักเบา นักแข่งชั้นนำระดับโลกยังเลือกใช้', 13500, 1, 'pr59fca8a361d67.png'),
(4, 3, 1003, 'หมวกกันน็อค NITEK P1 – CARBON REDBLUE CAMO', 'หมวกกันน็อคเต็มใบรุ่นนี้ พิเศษสุด! เพราะ Nitek Thailand ออกแบบเป็นสีธงชาติไทยมาเพื่อขายในประเทศไทยโดยเฉพาะ ทุกส่วนทำจากวัสดุคุณภาพ ที่คัดมาอย่างดี', 10500, 2, 'pr59fca8aad7dcb.png'),
(5, 4, 1002, 'ท่อ Yochimura', 'ท่อสุดยอดของโลกที่โด่งดังทั้งคุณภาพในการใช้งานและแข่งขัน มีหลากหลายรุ่นสำหรับรถทุกยี่ห้อทำโปรโมชั่นพิเศษครับ เมื่อซื้อท่อYOSHIMURA ที่ร้าน DIRTSHOP ให้บริการฟรี วัดแรงม้า สองครั้ง ก่อนใส่ และหลังใส่ เพื่อพิสูจน์แรงม้าได้แบบเห็นๆ', 19500, 5, 'pr59fca8b2351f6.png'),
(6, 1, 1000, 'เสื้อการ์ด Alpiestar', 'สวมใส่สบาย', 3500, 15, 'pr59fca8b90cef5.png'),
(9, 1, 1001, 'เสื้อการ์ด Duhan FIAT', 'สวมใส่', 4700, 9, 'pr59fca8d04a89f.png'),
(10, 2, 1000, 'ถุงมือ Duhan', 'สวมใส่มือ', 290, 8, 'pr59fca8229d132.png');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sup_id` smallint(5) UNSIGNED NOT NULL COMMENT 'ไอดีผู้จัดส่ง',
  `sup_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ชื่อผู้จัดส่ง',
  `address` text CHARACTER SET utf8 COMMENT 'ที่อยู่',
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'โทรศัพท์',
  `contact_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ชื่อติดต่อ',
  `website` varchar(250) CHARACTER SET utf8 DEFAULT NULL COMMENT 'เว็บไซต์'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sup_id`, `sup_name`, `address`, `phone`, `contact_name`, `website`) VALUES
(1000, 'บริษัท Honda จำกัด', '2754-1 ซอยสุขุมวิท 66/1 ถนนสุขุมวิท เขตบางนา กรุงเทพ 10260', '02-341-7777', 'นายสมบูรณ์  เอื้ออัชฌาสัย', 'https://www.honda.co.th'),
(1001, 'บริษัท Yamaha จำกัด', '173 ถนนดินสอ เสาชิงช้า พระนคร กรุงเทพมหานคร 10200', '0-2263-9999', 'นายสุขุมพันธุ์ บริพัตร', 'https://www.yamaha-motor.co.th'),
(1002, 'บริษัท Kawasaki จำกัด', '119/10 ม.4 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง 21140', ' 038-955059', 'นายสมบูรณ์  เอื้ออัชฌาสัย', 'http://www.kawasaki.co.th'),
(1005, 'บริษัท Gpx จำกัด', '141,141/1-3 ถ.ราชพฤกษ์ แขวงตลิ่งชัน เขตตลิ่งชัน จ.กรุงเทพ 10170', '02-4615800', 'นายไชยยศ ร่วมใจพัฒนกุล', 'http://www.gpxthailand.com'),
(1003, 'บริษัท Suzuki จำกัด', '855 ถ.อ่อนนุช แขวงประเวศ เขตประเวศ กรุงเทพฯ 10250', '02-727-6900', 'นายสมบูรณ์  เอื้ออัชฌาสัย', 'https://www.suzuki.co.th');

-- --------------------------------------------------------

--
-- Table structure for table `tbnews`
--

CREATE TABLE `tbnews` (
  `news_id` int(5) NOT NULL COMMENT 'รหัสข่าว',
  `news_topic` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'หัวข้อข่าว',
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียด',
  `news_date` date NOT NULL COMMENT 'วันที่สร้าง',
  `newstype_id` int(5) NOT NULL COMMENT 'รหัสหัวข้อข่าว',
  `news_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รูปภาพข่าว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbnews`
--

INSERT INTO `tbnews` (`news_id`, `news_topic`, `detail`, `news_date`, `newstype_id`, `news_image`) VALUES
(1, 'หมวกกันน็อคมาใหม่', 'ใส่สบาย นุ่ม', '2017-10-22', 100, 'ne59fcadef733c3.png'),
(2, 'เสื้อการ์ดมาใหม่', 'สวมใส่สบาย', '2017-10-21', 100, 'ne59fcadf4d66e9.png'),
(3, 'ท่อมาใหม่', 'ราคาเบาๆ', '2017-10-23', 200, 'ne59fcadf98244b.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbnewstype`
--

CREATE TABLE `tbnewstype` (
  `newstype_id` int(3) NOT NULL COMMENT 'รหัสหัวข้อข่าว',
  `newstype_detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียดหัวข้อข่าว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbnewstype`
--

INSERT INTO `tbnewstype` (`newstype_id`, `newstype_detail`) VALUES
(100, 'ข่าวทั่วไป'),
(200, 'ข่าวโปรโมชั่น');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attr_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`pro_id`,`attribute`),
  ADD UNIQUE KEY `item_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `email_id` (`email`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `tbnews`
--
ALTER TABLE `tbnews`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `tbnewstype`
--
ALTER TABLE `tbnewstype`
  ADD PRIMARY KEY (`newstype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attr_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีลักษณะ', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `item_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีของ', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีหมวดหมู่', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีลูกค้า', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีรูปภาพ';

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีการสั่ง', AUTO_INCREMENT=10006;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `item_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีของ', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีจ่ายเงิน', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีสินค้า', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sup_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้จัดส่ง', AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `tbnews`
--
ALTER TABLE `tbnews`
  MODIFY `news_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข่าว', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbnewstype`
--
ALTER TABLE `tbnewstype`
  MODIFY `newstype_id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหัวข้อข่าว', AUTO_INCREMENT=201;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
