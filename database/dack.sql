-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 27, 2018 lúc 04:18 AM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btcn06`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`postid`, `userid`, `content`) VALUES
(39, 6, 'sadsad'),
(63, 6, 'anh yeu'),
(39, 1, 'ây da'),
(63, 6, 'sa'),
(52, 6, 'asdsad'),
(34, 1, 'asd'),
(39, 1, 'asdsa'),
(52, 5, 'sad'),
(52, 1, 'chà');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `friends`
--

CREATE TABLE `friends` (
  `user1id` int(11) NOT NULL,
  `user2id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `friends`
--

INSERT INTO `friends` (`user1id`, `user2id`, `createdAt`) VALUES
(1, 5, '2018-12-26 06:03:04'),
(5, 1, '2018-12-26 06:02:54'),
(6, 5, '2018-12-26 04:41:55'),
(12, 5, '2018-12-26 15:16:12'),
(21, 5, '2018-12-26 22:37:20'),
(22, 1, '2018-12-27 09:34:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `pic` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `content`, `userid`, `createdAt`, `type`, `pic`, `image`) VALUES
(34, '<strong>vinh</strong>', 1, '2018-12-25 16:49:40', 0, 0, ''),
(39, 'sadasd', 1, '2018-12-25 17:20:58', 0, 1, '1545733258BMO_avatar.jpg'),
(40, '', 1, '2018-12-25 17:27:16', 0, 1, '1545733636cỏn.JPG'),
(44, 'zz', 1, '2018-12-25 21:32:07', 0, 1, '1545748327hiepdao.jpg'),
(46, 'ây da', 1, '2018-12-25 21:37:49', 1, 1, ''),
(51, 'sadsadsadsad', 5, '2018-12-26 04:47:45', 0, 1, ''),
(52, 'asdsdfdscsdc', 5, '2018-12-26 04:47:48', 0, 1, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reactions`
--

CREATE TABLE `reactions` (
  `postid` int(11) NOT NULL,
  `reactorid` int(11) NOT NULL,
  `reaction` text NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `reactions`
--

INSERT INTO `reactions` (`postid`, `reactorid`, `reaction`, `comment`, `date`) VALUES
(18, 5, 'liked', '', '2018-12-23 09:20:18'),
(17, 5, 'liked', '', '2018-12-23 09:20:32'),
(12, 1, 'liked', '', '2018-12-23 09:21:13'),
(14, 1, 'liked', '', '2018-12-23 16:12:52'),
(22, 1, 'liked', '', '2018-12-25 07:50:51'),
(5, 1, 'likeds', '', '2018-12-25 07:55:42'),
(5, 1, 'likeds', '', '2018-12-25 07:55:42'),
(5, 1, 'likeds', '', '2018-12-25 07:55:42'),
(5, 1, 'likeds', '', '2018-12-25 07:55:42'),
(5, 1, 'likeds', '', '2018-12-25 07:55:42'),
(5, 1, 'likeds', '', '2018-12-25 07:55:42'),
(5, 1, 'likeds', '', '2018-12-25 07:55:43'),
(5, 1, 'likeds', '', '2018-12-25 07:55:43'),
(5, 1, 'likeds', '', '2018-12-25 07:55:43'),
(5, 1, 'likeds', '', '2018-12-25 07:55:43'),
(5, 1, 'likeds', '', '2018-12-25 07:55:43'),
(5, 1, 'likeds', '', '2018-12-25 07:55:43'),
(5, 1, 'likeds', '', '2018-12-25 07:55:44'),
(5, 1, 'likeds', '', '2018-12-25 07:55:45'),
(5, 1, 'likeds', '', '2018-12-25 07:55:45'),
(5, 1, 'likeds', '', '2018-12-25 07:55:45'),
(5, 1, 'likeds', '', '2018-12-25 07:55:45'),
(5, 1, 'likeds', '', '2018-12-25 07:55:45'),
(30, 1, 'likeds', '', '2018-12-25 07:57:13'),
(29, 1, 'likeds', '', '2018-12-25 07:57:14'),
(20, 1, 'liked', '', '2018-12-25 08:04:23'),
(30, 1, 'likeds', '', '2018-12-25 08:09:59'),
(23, 1, 'likeds', '', '2018-12-25 08:10:00'),
(24, 1, 'liked', '', '2018-12-25 08:11:44'),
(23, 1, 'liked', '', '2018-12-25 08:11:44'),
(25, 1, 'liked', '', '2018-12-25 08:20:05'),
(29, 1, 'likeds', '', '2018-12-25 08:24:23'),
(29, 1, 'likeds', '', '2018-12-25 08:24:25'),
(29, 1, 'likeds', '', '2018-12-25 08:24:25'),
(29, 1, 'likeds', '', '2018-12-25 08:24:26'),
(29, 1, 'likeds', '', '2018-12-25 08:24:26'),
(39, 5, 'liked', '', '2018-12-25 21:03:46'),
(48, 1, 'liked', '', '2018-12-25 21:19:41'),
(35, 1, 'liked', '', '2018-12-25 21:21:04'),
(59, 6, 'likeda', '', '2018-12-25 22:29:11'),
(59, 6, 'likeda', '', '2018-12-25 22:29:11'),
(59, 6, 'likeda', '', '2018-12-25 22:29:12'),
(59, 6, 'likeda', '', '2018-12-25 22:29:12'),
(59, 6, 'likeda', '', '2018-12-25 22:29:12'),
(59, 6, 'likeda', '', '2018-12-25 22:29:12'),
(62, 1, 'liked', '', '2018-12-25 23:04:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reset_passwords`
--

CREATE TABLE `reset_passwords` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `secret` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `reset_passwords`
--

INSERT INTO `reset_passwords` (`id`, `userid`, `secret`, `createdAt`, `used`) VALUES
(42, 3, 'GnfILq8D6', '2018-12-26 16:47:53', 0),
(43, 3, '9n0iPpn5Tp', '2018-12-26 16:48:17', 0),
(44, 3, 'Nrgz7VnT5N', '2018-12-26 16:48:37', 0),
(45, 3, 'XIHoq6GNBu', '2018-12-26 16:51:11', 0),
(46, 3, 'U8MF4oq3QQ', '2018-12-26 16:52:22', 0),
(47, 18, 'x4rsG0LqlI', '2018-12-26 17:35:55', 0),
(48, 18, 'lzeNzDq7qe', '2018-12-26 17:36:22', 0),
(49, 18, 'm1apEBr193', '2018-12-26 17:39:53', 0),
(50, 18, '6nKu4Lpy62', '2018-12-26 18:43:39', 0),
(51, 18, 'FNiaoTd4JY', '2018-12-26 18:44:30', 0),
(52, 20, 'ASzQ71gfsA', '2018-12-26 19:10:13', 0),
(53, 21, 'IBrDtP5qd', '2018-12-26 22:36:55', 0),
(54, 21, 'Qipf0UOAdo', '2018-12-26 22:38:29', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `password`, `active`, `image`) VALUES
(1, 'vinh@gmail.com', 'vinh Do', '$2y$10$/Ysvjk4HsfZQMYzBtCJjv.zEzZoLnZ8tBTsdu/9WkIvc1XTAtFWrS', 1, '1545749735cỏn.JPG'),
(2, 'hthvan93@gmail.com', 'Thanh Vân', '$2y$10$Vx6t8ck/myBJOGTJAgLkU.K3BuS5NVBGJ9U/tZwwlXptFF752Izae', 0, '1545749301hiepdao.jpg'),
(4, 'vinh1@gmail.com', 'vinh joker', '$2y$10$lYqpisOVetJThcO57XNgMOrFxwk/piuJgpdgJzSvy0cp5uDO6YWi.', 0, '1545785250phuc.jpg'),
(5, 'diepvien11a1@gmail.com', 'hà lô anh', '$2y$10$HU3FUUmGE12VeOb3Qi5t2O7/3hjZCLyyWKtcb2j1O2pKw8hytCwQm', 1, '1545749550duy.jpg'),
(6, 'quanly@gmail.com', 'quản lý momstouch', '$2y$10$ewB49DEmzdZu/EZ5fMQhi.fn6q3gWgFe9ZDScwjLnSlxIomPLhw9S', 0, '1545774506BMO_avatar.jpg'),
(8, 'loki@gmail.com', 'Đam hạ', '$2y$10$Bi867wHGZEYLXCO47ds7NO.3wd/TZ90v8nggyrpAf4n4pIRawtNEy', 0, ''),
(12, 'ikm@gmail.com', 'ông can', '$2y$10$IQjyjJG.jXK4UBsHn4YF2OiORhiYymgpO6/OazewrPWWfhXub/VzO', 0, '154581215731743540_598348940537419_626024606179786752_n.jpg'),
(13, 'asdsadsad@lo.z', 'huỳnh hữu  vinh', '$2y$10$Sz2jhuW39JdRYFFUkFl0SuFGkXXlKmVkzsEN4CBsLz8nH2KTPoCAK', 0, ''),
(14, 'lololo@gmail.com', 'tran', '$2y$10$nOj1NvX9RJWzgwTCntLCXO7PitDCVAatea7nR9cTkavG3Naxgic5m', 0, ''),
(15, 'wqewqewq@g.lo', 'sadsadsadsad', '$2y$10$OMOOEza7q03FyqU9oO1TRe2/skpS8W1PvI3YUc2dPINKrfgT1rae2', 0, ''),
(16, 'dsadsad98@jko.z', 'v', '$2y$10$0bhLjf6ACyP5wcfKt72dxuNx7Quq2EARNO5sNsk22/7zXLd9oJD66', 0, 'default_image.jpg'),
(19, 'sadsadsadsad@los.z', 'v', '$2y$10$OWbu1daW5JZ9qImdpLO3/uzLziyFHniJPSpLhmlnncFjKAc965lnC', 0, 'default_image.jpg'),
(22, '1660724hcmus@gmail.com', 'huỳnh hữu  vinh', '$2y$10$1TEmkh/jlfObNS1mzfTrqe.NJ7nsze5V//zBgZBim9D.LEJEMC61q', 1, 'default_image.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user1id`,`user2id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `reset_passwords`
--
ALTER TABLE `reset_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
