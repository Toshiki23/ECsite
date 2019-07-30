-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myapp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `total` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `orders`
--

INSERT INTO `orders` (`id`, `userId`, `total`, `adress`, `credit`, `status`) VALUES
(3, 2, '808', '東京都', '000000', 1),
(5, 2, '860', '東京都', '000000', 1),
(6, 2, '1080', '東京都', '000000', 1),
(7, 2, '1674', '東京都', '000000', 1),
(8, 3, '324', 'ここ', 'mmmmmm', 1),
(9, 2, '324', '東京都', '000000', 1),
(10, 2, '1836', '東京都', '000000', 1),
(11, 2, '1410', '東京都', '000000', 1),
(12, NULL, '1242', NULL, NULL, 1),
(13, 2, '864', '東京都', '000000', 1),
(14, 2, '6048', '東京都', '000000', 1),
(15, 6, '4536', '戸塚', '444444', 1),
(16, 2, '387', '東京都', '000000', 1),
(17, 2, '432', '東京都', '000000', 1),
(18, 2, '430', '東京都', '000000', 1),
(19, 2, '540', '東京都', '000000', 1),
(20, 2, '0', '東京都', '000000', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `productId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `orderId`, `productId`, `num`) VALUES
(3, 3, '6', '5'),
(4, 3, '7', '7'),
(5, 5, '6', '10'),
(6, 6, '5', '10'),
(7, 7, '5', '12'),
(8, 7, '7', '7'),
(9, 8, '5', '3'),
(10, 9, '7', '6'),
(11, 10, '5', '17'),
(12, 11, '8', '8'),
(13, 11, '7', '7'),
(14, 12, '5', '8'),
(15, 12, '7', '7'),
(16, 13, '5', '8'),
(17, 14, '9', '7'),
(18, 15, '5', '7'),
(19, 15, '12', '7'),
(20, 16, '8', '3'),
(21, 17, '5', '4'),
(22, 18, '6', '5'),
(23, 19, '5', '5');

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduce` text COLLATE utf8_unicode_ci,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`productId`, `item_name`, `item_img`, `introduce`, `price`) VALUES
(5, 'もも', 'http://growthseed.jp/wp-content/uploads/2016/12/peach-1.jpg', 'これはももです', '100'),
(6, 'りんご', 'https://kotobank.jp/image/dictionary/nipponica/media/81306024002549.jpg', 'これはりんごです', '80'),
(7, 'みかん', 'https://www.acure-fun.net/lounge/assets_c/2018/01/mikan06-thumb-768xauto-1284.jpg', 'これはみかんです', '50'),
(8, 'かき', 'http://z-center.co.jp/products/fruits/img/persimmon_main.jpg', 'これはかきです', '120'),
(12, 'パイナップル', 'https://previews.123rf.com/images/yvdavyd/yvdavyd1506/yvdavyd150600003/40897933-%E5%88%86%E9%9B%A2%E3%81%95%E3%82%8C%E3%81%9F%E3%83%91%E3%82%A4%E3%83%8A%E3%83%83%E3%83%97%E3%83%AB.jpg', 'これはパイナップルです', '500'),
(13, 'ばなな', 'http://www.gastronomia.jp/pre/wp-content/uploads/2017/04/main-2.png', 'これはばななです', '120');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit` char(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `adress`, `email`, `password`, `credit`) VALUES
(2, '森川　智貴', '東京都', 'steam@oo', 'pppppp', '000000'),
(12, 'mori', 'mori', 'mori@mori', '$2y$10$f3sE/PFQ.1bGFSGjj1z1lu2', 'mori'),
(24, 'fumi', 'fumi', 'fumi@fumi', '$2y$10$ARuDAhp0AkZz/7Gv6UKuPuB10hUY29LbINQ2eIpZSrH/49ri.407.', 'fumi'),
(25, 'aaa', 'aaa', 'aa@aa', '$2y$10$kyhal52x7C2/uniZLlP1O.spTsKdVVmflCr5BL9wt9RQcTVDJkYt.', 'aaa'),
(27, 'momo', NULL, 'steam@oo', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
