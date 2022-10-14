-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 08:52 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vuphong`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `remark` text DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `register_date` datetime NOT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `updater_date` datetime NOT NULL,
  `del_flg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `price`, `remark`, `register`, `register_date`, `updater`, `updater_date`, `del_flg`) VALUES
(16, 1, 48, 2, 250000, 'remark', 'Tran Van Tuan', '2021-04-16 16:41:09', 'Tran Van Tuan', '2021-04-20 18:20:48', 0),
(23, 1, 46, 1, 100000, 'remark', 'Tran Van Tuan', '2021-04-17 08:02:13', 'Tran Van Tuan', '2021-04-20 18:20:48', 0),
(24, 1, 47, 1, 150000, 'remark', 'Tran Van Tuan', '2021-04-17 08:02:13', 'Tran Van Tuan', '2021-04-20 18:20:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_nm` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `updater_date` datetime DEFAULT NULL,
  `del_flg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_nm`, `parent_id`, `slug`, `register`, `register_date`, `updater`, `updater_date`, `del_flg`) VALUES
(1, 'Tổ chức', 0, 'to-chuc', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(2, 'Giáo dục', 0, 'giao-duc', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(3, 'Other', 0, 'other', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(4, 'Tổ chức loại 1', 1, 'to-chuc-loai-1', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(5, 'Tổ chức loại 22', 1, 'to-chuc-loai-22', 'admin', '2020-01-04 08:31:06', 'vantuant2@gmail.com', '2020-02-03 15:00:11', 0),
(6, 'Giáo dục loại 1', 2, 'giao-duc-loai-1', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(7, 'Giáo dục loại 2', 2, 'giao-duc-loai-2', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(8, 'Giáo dục loại 3', 2, 'giao-duc-loai-3', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(9, 'Other thu nhat', 3, 'to-chuc-loai1-chil13', 'admin', '2020-01-04 08:31:06', 'vantuant2@gmail.com', '2020-02-03 15:08:30', 0),
(10, 'Other thu hai', 3, 'to-chuc-loai1-chil2', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(11, 'tuantv', 0, 'ssv', 'admin', '2020-01-04 08:31:06', 'admin', '2020-01-04 08:31:06', 0),
(16, 'danh muc 1', 0, 'xc', 'admin', '2020-01-11 17:37:08', 'admin', '2020-01-11 17:37:08', 0),
(32, 'tran truong', 0, 'gfgd', 'admin', '2020-02-03 14:44:45', 'admin', '2020-02-03 14:44:45', 0),
(35, 'Áo', 0, 'ao', 'admin', '2021-04-05 14:59:53', 'admin', '2021-04-05 14:59:53', 0),
(36, 'Áo sơ mi', 35, 'ao-so-mi', 'admin', '2021-04-05 15:01:31', 'admin', '2021-04-05 15:01:31', 0),
(37, 'Áo polo', 35, 'ao-po-lo', 'admin', '2021-04-05 15:01:48', 'admin', '2021-04-05 15:01:48', 0),
(38, 'Áo T-Shirt', 35, 'ao-t-shirt', 'admin', '2021-04-05 15:02:07', 'admin', '2021-04-05 15:02:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mime` varchar(255) DEFAULT NULL,
  `original_filename` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `updater_date` datetime DEFAULT NULL,
  `del_flg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `url`, `mime`, `original_filename`, `filename`, `register`, `register_date`, `updater`, `updater_date`, `del_flg`) VALUES
(1, 'a22', 'image/jpeg', 'meomeo.jpg', 'phpAEFE.tmp.jpg', 'vantuant2@gmail.com', '2020-01-19 15:21:41', 'vantuant2@gmail.com', '2020-01-19 15:36:20', 1),
(2, 'dfsdf', 'image/jpeg', 'conkhi.jpg', 'php1E64.tmp.jpg', 'vantuant2@gmail.com', '2020-01-19 15:45:33', 'vantuant2@gmail.com', '2020-01-19 15:45:33', 1),
(3, 'https://sanhruou.com/ruou-chivas-12-nam12.html', 'image/jpeg', 'quelua.jpg', 'phpD839.tmp.jpg', 'vantuant2@gmail.com', '2020-01-20 14:43:18', 'vantuant2@gmail.com', '2020-01-20 14:45:00', 1),
(4, 'https://www.youtube.com/watch?v=Bc_FqzqGCDM', 'image/jpeg', 'gaugau.jpg', 'php3AD1.tmp.jpg', 'vantuant2@gmail.com', '2020-01-20 14:44:20', 'vantuant2@gmail.com', '2020-01-31 15:19:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `updater_date` datetime DEFAULT NULL,
  `del_flg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`id`, `user_id`, `name`, `updater`, `updater_date`, `del_flg`) VALUES
(1, 1, 'Samsung Galaxy', 'tuantv', NULL, NULL),
(2, 1, 'Iphone XSmax', 'tuantv', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `monney` float DEFAULT NULL,
  `featured_article` int(11) DEFAULT NULL,
  `mime` varchar(255) DEFAULT NULL,
  `original_filename` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_other` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `classify_product` int(11) DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `updater_date` datetime DEFAULT NULL,
  `del_flg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `author`, `monney`, `featured_article`, `mime`, `original_filename`, `filename`, `category_id`, `category_other`, `slug`, `classify_product`, `register`, `register_date`, `updater`, `updater_date`, `del_flg`) VALUES
(45, 'Áo blazer nam Aristino ABZ00101', 'Mẫu &aacute;o trẻ trung hot nhất năm 2021', 'tuantv', 80000, 1, 'image/jpeg', 'ao-blazer-nam-aristino-ABZ00101.jpg', 'phpEC72.tmp.jpg', 36, 0, 'ao-dep', 1, 'vantuant2@gmail.com', '2021-04-05 15:05:11', 'vantuant2@gmail.com', '2021-04-05 16:45:11', 0),
(46, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS132S1', 'mẫu &aacute;o đẹp năm nay', 'tuantv', 100000, 1, 'image/jpeg', 'ao-tank-top-nam-aristino-ATT011S1-21x650x650x4.jpg', 'php469A.tmp.jpg', 36, 0, 'ao-so-mi', NULL, 'vantuant2@gmail.com', '2021-04-05 15:06:46', 'vantuant2@gmail.com', '2021-04-05 16:45:34', 0),
(47, 'Áo sơ mi ngắn tay nam Aristino ASS069S1', 'Mẫu &aacute;o được bạn trẻ đ&oacute;n nhận hot nhất h&egrave; năm 2021', 'tuantv', 150000, 1, 'image/jpeg', 'ao-so-mi-nam-aristino-ASS132S1-02.jpg', 'php1D28.tmp.jpg', 36, 0, 'ao-t-shirt', 2, 'vantuant2@gmail.com', '2021-04-05 15:08:16', 'vantuant2@gmail.com', '2021-04-05 16:45:23', 0),
(48, 'Áo tank-top nam Aristino ATT011S1', '&Aacute;o polo đẹp chất lu&ocirc;n', 'tuantv', 250000, 1, 'image/jpeg', 'ao-thun-nam-aristino-ATS019S1-07.jpg', 'php6EE4.tmp.jpg', 37, 0, 'ao-so-mi', 2, 'vantuant2@gmail.com', '2021-04-05 15:15:52', 'vantuant2@gmail.com', '2021-04-05 16:45:44', 0),
(49, 'test', 'sdfsdf', 'sdfs', 2234, 0, 'image/jpeg', 'ao-tank-top-nam-aristino-ATT011S1-21x650x650x4.jpg', 'phpC7A9.tmp.jpg', 38, 0, 'sfsdgs', 1, 'vantuant2@gmail.com', '2021-04-05 16:39:34', 'vantuant2@gmail.com', '2021-04-05 16:39:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_closings`
--

CREATE TABLE `pos_closings` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_closings`
--

INSERT INTO `pos_closings` (`id`, `date`, `name`) VALUES
(1, '2020-10-11', 'closing01'),
(2, '2020-10-12', 'closing02'),
(3, '2020-10-11', 'closing03'),
(4, '2020-10-13', 'closing04');

-- --------------------------------------------------------

--
-- Table structure for table `pos_payments`
--

CREATE TABLE `pos_payments` (
  `id` int(11) NOT NULL,
  `method_payment` int(11) NOT NULL,
  `pos_closing_id` int(11) NOT NULL,
  `total_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_payments`
--

INSERT INTO `pos_payments` (`id`, `method_payment`, `pos_closing_id`, `total_amount`) VALUES
(1, 1, 1, 100),
(2, 0, 2, 300),
(3, 0, 1, 200),
(4, 1, 2, 150),
(5, 1, 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `status` int(11) NOT NULL,
  `del_flg` int(11) NOT NULL,
  `register` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `updater` varchar(255) NOT NULL,
  `updater_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `order_code`, `user_id`, `address`, `phone`, `remark`, `total_quantity`, `total_price`, `status`, `del_flg`, `register`, `register_date`, `updater`, `updater_date`) VALUES
(15, '202104201', 1, 'ngõ 189 nguyễn ngọc vũ, trung hòa, cầu giấy', '0357997234', NULL, 4, 0, 3, 0, 'Tran Van Tuan', '2021-04-20 18:46:32', 'Tran Van Tuan', '2021-04-20 18:46:32'),
(16, '2021042016', 1, 'ngõ 189 nguyễn ngọc vũ, trung hòa, cầu giấy', '0357997234', NULL, 4, 0, 3, 0, 'Tran Van Tuan', '2021-04-20 18:46:45', 'Tran Van Tuan', '2021-04-20 18:46:45'),
(17, '2021042017', 1, 'ngõ 189 nguyễn ngọc vũ, trung hòa, cầu giấy', '0357997234', NULL, 4, 0, 3, 0, 'Tran Van Tuan', '2021-04-20 18:46:56', 'Tran Van Tuan', '2021-04-20 18:46:56'),
(18, 'DH2021042018', 1, 'ngõ 189 nguyễn ngọc vũ, trung hòa, cầu giấy', '0357997234', NULL, 4, 0, 3, 0, 'Tran Van Tuan', '2021-04-20 18:48:03', 'Tran Van Tuan', '2021-04-20 18:48:03'),
(19, 'DH20210420010619', 1, 'ngõ 189 nguyễn ngọc vũ, trung hòa, cầu giấy', '0357997234', NULL, 4, 0, 3, 0, 'Tran Van Tuan', '2021-04-20 18:49:48', 'Tran Van Tuan', '2021-04-20 18:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_order_detail`
--

CREATE TABLE `product_order_detail` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `register` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `updater` varchar(255) NOT NULL,
  `updater_date` datetime NOT NULL,
  `del_flg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_order_detail`
--

INSERT INTO `product_order_detail` (`id`, `order_code`, `cart_id`, `user_id`, `product_id`, `price`, `status`, `register`, `register_date`, `updater`, `updater_date`, `del_flg`) VALUES
(31, '202104201', 16, 1, 48, 500000, 3, 'Tran Van Tuan', '2021-04-20 18:46:32', 'Tran Van Tuan', '2021-04-20 18:46:32', 0),
(32, '202104201', 23, 1, 46, 100000, 3, 'Tran Van Tuan', '2021-04-20 18:46:32', 'Tran Van Tuan', '2021-04-20 18:46:32', 0),
(33, '202104201', 24, 1, 47, 150000, 3, 'Tran Van Tuan', '2021-04-20 18:46:32', 'Tran Van Tuan', '2021-04-20 18:46:32', 0),
(34, '2021042016', 16, 1, 48, 500000, 3, 'Tran Van Tuan', '2021-04-20 18:46:45', 'Tran Van Tuan', '2021-04-20 18:46:45', 0),
(35, '2021042016', 23, 1, 46, 100000, 3, 'Tran Van Tuan', '2021-04-20 18:46:45', 'Tran Van Tuan', '2021-04-20 18:46:45', 0),
(36, '2021042016', 24, 1, 47, 150000, 3, 'Tran Van Tuan', '2021-04-20 18:46:45', 'Tran Van Tuan', '2021-04-20 18:46:45', 0),
(37, '2021042017', 16, 1, 48, 500000, 3, 'Tran Van Tuan', '2021-04-20 18:46:56', 'Tran Van Tuan', '2021-04-20 18:46:56', 0),
(38, '2021042017', 23, 1, 46, 100000, 3, 'Tran Van Tuan', '2021-04-20 18:46:56', 'Tran Van Tuan', '2021-04-20 18:46:56', 0),
(39, '2021042017', 24, 1, 47, 150000, 3, 'Tran Van Tuan', '2021-04-20 18:46:56', 'Tran Van Tuan', '2021-04-20 18:46:56', 0),
(40, 'DH2021042018', 16, 1, 48, 500000, 3, 'Tran Van Tuan', '2021-04-20 18:48:03', 'Tran Van Tuan', '2021-04-20 18:48:03', 0),
(41, 'DH2021042018', 23, 1, 46, 100000, 3, 'Tran Van Tuan', '2021-04-20 18:48:03', 'Tran Van Tuan', '2021-04-20 18:48:03', 0),
(42, 'DH2021042018', 24, 1, 47, 150000, 3, 'Tran Van Tuan', '2021-04-20 18:48:03', 'Tran Van Tuan', '2021-04-20 18:48:03', 0),
(43, 'DH20210420010619', 16, 1, 48, 500000, 3, 'Tran Van Tuan', '2021-04-20 18:49:48', 'Tran Van Tuan', '2021-04-20 18:49:48', 0),
(44, 'DH20210420010619', 23, 1, 46, 100000, 3, 'Tran Van Tuan', '2021-04-20 18:49:48', 'Tran Van Tuan', '2021-04-20 18:49:48', 0),
(45, 'DH20210420010619', 24, 1, 47, 150000, 3, 'Tran Van Tuan', '2021-04-20 18:49:48', 'Tran Van Tuan', '2021-04-20 18:49:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `phone`, `email`, `password`, `level`, `updated_at`, `created_at`) VALUES
(1, 'Tran Van Tuan', 'ngõ 189 nguyễn ngọc vũ, trung hòa, cầu giấy', '0357997234', 'vantuant2@gmail.com', '$2y$10$Huder8xnMpiWytXm7lxFLuDWCOm8Ze2WBbxrr0Nwa1yJnNgoKuQaC', '1', '2020-01-18 05:18:06', '2020-01-18 05:18:06'),
(2, 'Nguyễn Thị Thu', '26 nguyễn thị định, trung hòa, cầu giấy', '058661449', 'thunguyen22@gmail.com', '$2y$10$u9Bz4Xjjr4MWUyJAi7CwD.WzxYglCqXOTjh5WsPgY5lGtlqz2OLYe', '1', '2021-04-04 14:15:19', '2021-04-04 14:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `updater` varchar(255) NOT NULL,
  `updater_date` datetime NOT NULL,
  `del_flg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `url`, `updater`, `updater_date`, `del_flg`) VALUES
(1, 'https://www.youtube.com/embed/0B3X3pVsLCQ', 'vantuant2@gmail.com', '2020-01-31 15:07:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_closings`
--
ALTER TABLE `pos_closings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_payments`
--
ALTER TABLE `pos_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order_detail`
--
ALTER TABLE `product_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pos_closings`
--
ALTER TABLE `pos_closings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pos_payments`
--
ALTER TABLE `pos_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_order_detail`
--
ALTER TABLE `product_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
