-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2023 lúc 12:48 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `luanvantotnghiep_final`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenxe`
--

CREATE TABLE `chuyenxe` (
  `idchuyenxe` int(10) NOT NULL,
  `giodi` time NOT NULL,
  `gioden` time NOT NULL,
  `ngaydi` date NOT NULL,
  `ngayden` date NOT NULL,
  `noixuatben` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtuyenxe` int(11) NOT NULL,
  `idxe` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyenxe`
--

INSERT INTO `chuyenxe` (`idchuyenxe`, `giodi`, `gioden`, `ngaydi`, `ngayden`, `noixuatben`, `idtuyenxe`, `idxe`, `created_at`, `updated_at`) VALUES
(63, '08:00:00', '11:30:00', '2023-12-02', '2023-12-02', 'Sóc Trăng', 30, 55, '2023-11-30 11:08:37', '2023-11-30 11:08:37'),
(64, '14:00:00', '17:30:00', '2023-12-02', '2023-12-02', 'Sóc Trăng', 28, 56, '2023-11-30 11:10:15', '2023-11-30 11:10:15'),
(65, '10:00:00', '14:00:00', '2023-12-02', '2023-12-02', 'Sóc Trăng', 29, 52, '2023-11-30 11:11:48', '2023-11-30 11:11:48'),
(66, '07:30:00', '11:00:00', '2023-12-15', '2023-12-15', 'Sóc Trăng', 28, 53, '2023-11-30 11:21:41', '2023-11-30 11:21:41'),
(67, '10:30:00', '14:00:00', '2023-12-16', '2023-12-16', 'Sóc Trăng', 29, 54, '2023-11-30 11:22:43', '2023-11-30 11:22:43'),
(68, '08:30:00', '11:30:00', '2023-12-16', '2023-12-16', 'Sóc Trăng', 29, 57, '2023-11-30 11:23:43', '2023-11-30 11:23:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mangxahoi`
--

CREATE TABLE `mangxahoi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(100) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2014_10_12_000000_create_users_table', 1),
(19, '2014_10_12_100000_create_password_resets_table', 1),
(20, '2019_08_19_000000_create_failed_jobs_table', 1),
(21, '2021_05_27_142542_create_xe_table', 1),
(22, '2021_05_27_180922_create_chuyenxe_table', 1),
(23, '2021_05_28_060114_create_tuyenxe_table', 2),
(25, '2021_05_28_060747_create_nguoidi_table', 3),
(27, '2021_05_28_062245_create_ve_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidi`
--

CREATE TABLE `nguoidi` (
  `cmndnguoidi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotennguoidi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioitinhnguoidi` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdtnguoidi` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idve` int(11) NOT NULL,
  `chongoi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinhthanh`
--

CREATE TABLE `tinhthanh` (
  `ma_tinh` int(255) NOT NULL,
  `ten_tinh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tinhthanh`
--

INSERT INTO `tinhthanh` (`ma_tinh`, `ten_tinh`) VALUES
(1, 'An Giang'),
(4, 'Bạc Liêu'),
(8, 'Bến Tre'),
(12, 'Bình Phước'),
(14, 'Cà Mau'),
(16, 'Cần Thơ'),
(22, 'Đồng Tháp'),
(32, 'Sài Gòn'),
(33, 'Hậu Giang'),
(37, 'Kiên Giang'),
(44, 'Tiền Giang'),
(45, 'Vĩnh Long'),
(46, 'Sóc Trăng'),
(48, 'Trà Vinh\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuyenxe`
--

CREATE TABLE `tuyenxe` (
  `idtuyenxe` int(10) NOT NULL,
  `diemdi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diemden` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinhanh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dongia` float NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tuyenxe`
--

INSERT INTO `tuyenxe` (`idtuyenxe`, `diemdi`, `diemden`, `hinhanh`, `dongia`, `created_at`, `updated_at`) VALUES
(28, 'Sóc Trăng', 'An Giang', 'unnamed.jpg', 180000, '2023-10-26 15:02:30', '2023-10-26 15:02:30'),
(29, 'Sóc Trăng', 'Cần Thơ', 'cantho.jpg', 150000, '2023-10-26 15:06:51', '2023-10-26 15:06:51'),
(30, 'Sóc Trăng', 'Vĩnh Long', 'soctrang.jpg', 150000, '2023-10-26 15:07:20', '2023-10-26 15:07:20'),
(31, 'Sóc Trăng', 'Trà Vinh', 'tra_vinh_12-12_53_09_994.jpg', 160000, '2023-10-26 15:08:06', '2023-10-26 15:08:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `idtk` int(10) NOT NULL,
  `tentaikhoan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoten` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioitinh` int(11) DEFAULT NULL,
  `cmnd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT 0,
  `lydo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`idtk`, `tentaikhoan`, `password`, `email`, `hoten`, `gioitinh`, `cmnd`, `sdt`, `diachi`, `level`, `trangthai`, `lydo`, `google_id`, `facebook_id`, `is_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'quocdat', 'e10adc3949ba59abbe56e057f20f883e', 'dattrieu24082001@gmail.com', 'Trieu Quoc Dat', 1, '371921060', '0943144514', 'Vinh Tan, Vinh Chau, Soc Trang', 3, 1, '', NULL, NULL, NULL, NULL, '2023-08-09 19:23:10', '2023-08-29 17:00:00'),
(107, 'trieuquocdat', '$2y$10$qLfoSLR4EV9FDSMnLdzFN.fDv2JMDlBdvgnpUbaeNFCqDRqgd5YR2', 'datb1910052@student.ctu.edu.vn', 'Triệu Quốc Đạt', 1, '123456789', '0362069241', 'Vĩnh Tân, Vĩnh Châu, Sóc Trăng', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-10-26 14:47:22', '2023-10-26 14:47:35'),
(108, 'tranthib', '$2y$10$b/qw/SAGOGubbYYlWws/eex63FY.sAY0ATWqbjGavW3BCu5MqOx7W', 'trieuquocdattc@gmail.com', 'Trần Thị B', 0, '012356789', '0123456789', 'Vĩnh Tân, Vĩnh Châu, Sóc Trăng', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-10-26 14:48:48', '2023-10-26 14:49:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `idve` int(11) NOT NULL,
  `cmnd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioitinh` int(11) NOT NULL,
  `sdt` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soluong` int(11) NOT NULL,
  `tongtien` float NOT NULL,
  `trangthai` tinyint(1) NOT NULL,
  `idchuyenxe` int(11) NOT NULL,
  `idtk` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xe`
--

CREATE TABLE `xe` (
  `idxe` int(10) NOT NULL,
  `bienso` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soghe` int(11) NOT NULL,
  `loaixe` tinyint(4) NOT NULL,
  `hinhxe` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `xe`
--

INSERT INTO `xe` (`idxe`, `bienso`, `soghe`, `loaixe`, `hinhxe`, `trangthai`, `created_at`, `updated_at`) VALUES
(52, '83B - 12345', 42, 1, 'xekhach1 (5).jpg', 1, NULL, '2023-10-26 14:57:11'),
(53, '83B - 12346', 42, 0, 'xekhach1 (10).jpg', 1, NULL, '2023-10-26 14:57:34'),
(54, '83B - 12347', 42, 0, 'xekhach1 (20).jpg', 1, NULL, '2023-10-26 14:58:20'),
(55, '83B - 12348', 42, 1, 'xekhach1 (24).jpg', 1, NULL, '2023-10-27 07:46:51'),
(56, '83B - 12349', 42, 1, 'xekhach1 (14).jpg', 1, NULL, '2023-10-27 07:47:32'),
(57, '83B - 12351', 36, 1, 'xekhach1 (8).jpg', 1, NULL, '2023-10-27 07:52:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chuyenxe`
--
ALTER TABLE `chuyenxe`
  ADD PRIMARY KEY (`idchuyenxe`),
  ADD KEY `idtuyenxe` (`idtuyenxe`),
  ADD KEY `idxe` (`idxe`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mangxahoi`
--
ALTER TABLE `mangxahoi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nguoidi`
--
ALTER TABLE `nguoidi`
  ADD KEY `nguoidi_ibfk_1` (`idve`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `tinhthanh`
--
ALTER TABLE `tinhthanh`
  ADD PRIMARY KEY (`ma_tinh`);

--
-- Chỉ mục cho bảng `tuyenxe`
--
ALTER TABLE `tuyenxe`
  ADD PRIMARY KEY (`idtuyenxe`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idtk`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`idve`),
  ADD KEY `idchuyenxe` (`idchuyenxe`),
  ADD KEY `idtk` (`idtk`);

--
-- Chỉ mục cho bảng `xe`
--
ALTER TABLE `xe`
  ADD PRIMARY KEY (`idxe`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chuyenxe`
--
ALTER TABLE `chuyenxe`
  MODIFY `idchuyenxe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `mangxahoi`
--
ALTER TABLE `mangxahoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tinhthanh`
--
ALTER TABLE `tinhthanh`
  MODIFY `ma_tinh` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `tuyenxe`
--
ALTER TABLE `tuyenxe`
  MODIFY `idtuyenxe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `idtk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `idve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT cho bảng `xe`
--
ALTER TABLE `xe`
  MODIFY `idxe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chuyenxe`
--
ALTER TABLE `chuyenxe`
  ADD CONSTRAINT `chuyenxe_ibfk_1` FOREIGN KEY (`idtuyenxe`) REFERENCES `tuyenxe` (`idtuyenxe`),
  ADD CONSTRAINT `chuyenxe_ibfk_2` FOREIGN KEY (`idxe`) REFERENCES `xe` (`idxe`);

--
-- Các ràng buộc cho bảng `nguoidi`
--
ALTER TABLE `nguoidi`
  ADD CONSTRAINT `nguoidi_ibfk_1` FOREIGN KEY (`idve`) REFERENCES `ve` (`idve`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `ve_ibfk_1` FOREIGN KEY (`idchuyenxe`) REFERENCES `chuyenxe` (`idchuyenxe`),
  ADD CONSTRAINT `ve_ibfk_2` FOREIGN KEY (`idtk`) REFERENCES `users` (`idtk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
