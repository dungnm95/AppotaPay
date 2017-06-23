-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 23, 2017 lúc 10:46 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'SUCCESS',
  `product_id` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `country_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `status`, `product_id`, `amount`, `currency`, `country_code`) VALUES
(1, 'ASM-0011497947523', 'SUCCESS', 1, '', '', ''),
(2, 'ASM-0011497947956', 'CANCEL', 1, '', '', ''),
(3, 'ASM-0011497947956', 'CANCEL', 1, '', '', ''),
(4, 'ASM-0011497948548', 'CANCEL', 1, '', '', ''),
(6, 'ASM-0011497949331', 'CANCEL', 1, '', '', ''),
(7, 'ASM-0011497950839', 'FAIL', 1, '', '', ''),
(8, 'ASM-0011497950925', 'FAIL', 1, '', '', ''),
(9, 'ASM-0011497950964', 'FAIL', 1, '', '', ''),
(10, 'ASM-0011497950974', 'FAIL', 1, '', '', ''),
(11, 'ASM-0011497951156', 'FAIL', 1, '', '', ''),
(12, 'ASM-0011497951235', 'FAIL', 1, '', '', ''),
(13, 'ASM-0011497951241', 'FAIL', 1, '', '', ''),
(14, 'ASM-0011497951874', 'SUCCESS', 1, '', '', ''),
(15, 'ASM-0011497953460', 'SUCCESS', 1, '', '', ''),
(16, 'ASM-0011497954219', 'SUCCESS', 1, '200000', 'VND', 'VN'),
(17, 'ASM-0011497956043', 'SUCCESS', 1, '200000', 'VND', 'VN'),
(18, 'AP-0011497956523', 'SUCCESS', 2, '150000', 'VND', 'VN'),
(19, 'AP-0011497956721', 'SUCCESS', 2, '150000', 'VND', 'VN'),
(20, 'AP-0011498013587', 'SUCCESS', 2, '150000', 'VND', 'VN'),
(21, 'ASM-0011498013712', 'SUCCESS', 1, '200000', 'VND', 'VN'),
(22, 'ASM-0011498013762', 'CANCEL', 1, '200000', 'VND', 'VN'),
(23, 'AP-0011498018335', 'FAIL', 2, '150000', '', ''),
(24, 'AP-0011498018395', 'FAIL', 2, '150000', '', ''),
(25, 'AP-0011498018440', 'FAIL', 2, '150000', '', ''),
(26, 'AP-0011498018520', 'FAIL', 2, '150000', '', ''),
(27, 'AP-0011498018677', 'FAIL', 2, '150000', '', ''),
(28, 'ASM-0011498018860', 'FAIL', 1, '200000', '', ''),
(29, 'ASM-0011498018935', 'FAIL', 1, '200000', '', ''),
(30, 'ASM-0011498019383', 'FAIL', 1, '200000', '', ''),
(31, 'ASM-0011498019409', 'FAIL', 1, '200000', '', ''),
(32, 'AP-0011498030144', 'FAIL', 2, '150000', '', ''),
(33, 'AP-0011498030162', 'FAIL', 2, '150000', '', ''),
(34, 'AP-0011498030208', 'FAIL', 2, '150000', '', ''),
(35, 'AP-0011498030215', 'FAIL', 2, '150000', '', ''),
(36, 'AP-0011498030233', 'FAIL', 2, '150000', '', ''),
(37, 'AP-0011498030345', 'FAIL', 2, '150000', '', ''),
(38, 'AP-0011498030495', 'FAIL', 2, '150000', '', ''),
(39, 'AP-0011498032858', 'SUCCESS', 2, '150000', 'VND', 'VN'),
(40, 'ASM-0011498033643', 'FAIL', 1, '200000', '', ''),
(41, 'ASM-0011498034831', 'FAIL', 1, '200000', '', ''),
(42, 'ASM-0011498034891', 'FAIL', 1, '200000', '', ''),
(43, 'AP-0011498035194', 'FAIL', 2, '150000', '', ''),
(44, 'AP-0011498035286', 'FAIL', 2, '150000', '', ''),
(45, 'AP-0011498035310', 'FAIL', 2, '150000', '', ''),
(46, 'AP-0011498035425', 'FAIL', 2, '150000', '', ''),
(47, 'AP-0011498035648', 'SUCCESS', 2, '150000', '', ''),
(48, 'AP-0011498036695', 'SUCCESS', 2, '150000', '', ''),
(49, 'AP-0011498037380', 'SUCCESS', 2, '150000', 'VND', 'VN'),
(50, 'ASM-0011498115948', 'FAIL', 1, '200000', '', ''),
(51, 'ASM-0011498115957', 'FAIL', 1, '200000', '', ''),
(52, 'AP-0011498116066', 'FAIL', 2, '150000', '', ''),
(53, 'AP-0011498118592', 'FAIL', 2, '150000', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `code` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `amount` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `img`, `amount`) VALUES
(1, 'Áo sơ mi xinh xinh', 'ASM-001', 'Product/asm_001.jpg', '200000'),
(2, 'Áo phông hay hay', 'AP-001', 'Product/ap_001.jpeg', '150000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `hash` varchar(1000) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `type` varchar(30) NOT NULL,
  `card_code` varchar(20) DEFAULT NULL,
  `expiry_date` varchar(30) DEFAULT NULL,
  `cvv_csc_code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `hash`, `order_id`, `transaction_type`, `type`, `card_code`, `expiry_date`, `cvv_csc_code`) VALUES
(3, 'c2ed3d9d3a0167e3a9653ce68b855901', 16, 'VISA', '', NULL, NULL, NULL),
(4, 'c2ed3d9d3a0167e3a9653ce68b855901', 16, 'VISA', '', NULL, NULL, NULL),
(5, 'c2ed3d9d3a0167e3a9653ce68b855901', 16, 'VISA', '', NULL, NULL, NULL),
(6, 'c2ed3d9d3a0167e3a9653ce68b855901', 16, 'VISA', '', NULL, NULL, NULL),
(7, 'd6dbc24c12bfaedf5905c70098cd2290', 17, 'ATM', '', NULL, NULL, NULL),
(8, 'b8c15830e204be8407202f441d95c1ab', 18, 'ATM', '', NULL, NULL, NULL),
(9, 'a323e502bd1565044e7463ba757c022a', 19, 'VISA', '', NULL, NULL, NULL),
(10, 'a323e502bd1565044e7463ba757c022a', 19, 'VISA', '', NULL, NULL, NULL),
(11, '3aa33385c7cb810f7f5141674227799b', 20, 'ATM', '', NULL, NULL, NULL),
(12, '3d26810f9e8c428c631401750aaddfc4', 21, 'VISA', '', NULL, NULL, NULL),
(13, '09a0d4742a0bb05019221b833e85ba2c', 39, 'BANK', 'ATM', NULL, NULL, NULL),
(14, '09a0d4742a0bb05019221b833e85ba2c', 39, 'BANK', 'ATM', NULL, NULL, NULL),
(15, '09a0d4742a0bb05019221b833e85ba2c', 39, 'BANK', 'ATM', NULL, NULL, NULL),
(16, '09a0d4742a0bb05019221b833e85ba2c', 39, 'BANK', 'ATM', NULL, NULL, NULL),
(17, '09a0d4742a0bb05019221b833e85ba2c', 39, 'BANK', 'ATM', NULL, NULL, NULL),
(18, '30d2896925bd4eb930aa815904e532e2', 49, 'BANK', 'ATM', NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
