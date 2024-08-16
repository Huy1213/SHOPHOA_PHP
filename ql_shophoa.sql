-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 16, 2024 lúc 10:42 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_shophoa`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'nhatvy', '123'),
(2, 'baduy', '123'),
(3, 'thanhhuy', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `MaHD` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`MaHD`, `MaSP`, `SoLuong`, `DonGia`) VALUES
(84, 10, 1, 32000),
(85, 10, 1, 32000),
(85, 16, 1, 340000),
(86, 17, 1, 230000),
(86, 19, 1, 40000);

--
-- Bẫy `chitiethoadon`
--
DELIMITER $$
CREATE TRIGGER `after_insert_chitiethoadon` AFTER INSERT ON `chitiethoadon` FOR EACH ROW BEGIN
    -- Trừ số lượng sản phẩm trong bảng sanpham
    UPDATE sanpham
    SET SoLuong = SoLuong - NEW.SoLuong
    WHERE MaSP = NEW.MaSP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `MaDC` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `Duong` varchar(200) NOT NULL,
  `Phuong` varchar(300) NOT NULL,
  `Huyen` varchar(300) NOT NULL,
  `Tinh` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diachi`
--

INSERT INTO `diachi` (`MaDC`, `MaKH`, `Duong`, `Phuong`, `Huyen`, `Tinh`) VALUES
(1, 3, 'Thôn 6', 'Xã Hòa Phong', 'Huyện Krông Bông', 'Tỉnh Đắk Lắk');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanh`
--

CREATE TABLE `hinhanh` (
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(200) NOT NULL,
  `MaSP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhanh`
--

INSERT INTO `hinhanh` (`MaHinh`, `TenHinh`, `MaSP`) VALUES
(29, '17.jpg', 10),
(30, '18.jpg', 10),
(31, '19.jpg', 10),
(32, '20.jpg', 3),
(33, '21.jpg', 3),
(34, '22.jpg', 3),
(38, '26.jpg', 11),
(39, '27.jpg', 11),
(40, '28.jpg', 11),
(44, '32.jpg', 2),
(45, '33.jpg', 2),
(46, '34.jpg', 2),
(47, '35.jpg', 4),
(48, '36.jpg', 4),
(49, '37.jpg', 4),
(50, '38.jpg', 9),
(51, '39.jpg', 9),
(52, '40.jpg', 9),
(56, '44.jpg', 13),
(57, '45.jpg', 13),
(58, '46.jpg', 13),
(65, '53.jpg', 17),
(66, '54.jpg', 17),
(67, '55.jpg', 17),
(68, '56.jpg', 18),
(69, '57.jpg', 18),
(70, '58.jpg', 18),
(71, '59.jpg', 19),
(72, '60.jpg', 19),
(73, '61.jpg', 19),
(74, '62.jpg', 20),
(75, '63.jpg', 20),
(76, '64.jpg', 20),
(77, '65.jpg', 21),
(78, '66.jpg', 21),
(79, '67.jpg', 21),
(80, '47.jpg', 14),
(81, '48.jpg', 14),
(82, '49.jpg', 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `DiaChiGiaoHang` varchar(300) NOT NULL,
  `NgayDat` date DEFAULT NULL,
  `GhiChu` varchar(200) DEFAULT NULL,
  `TongTien` double DEFAULT NULL,
  `HinhThucThanhToan` varchar(100) DEFAULT NULL,
  `TinhTrang` varchar(200) DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `MaKH`, `DiaChiGiaoHang`, `NgayDat`, `GhiChu`, `TongTien`, `HinhThucThanhToan`, `TinhTrang`) VALUES
(84, 23, '4, đường EFH, Xã Vụ Bổn, Huyện Krông Pắc, Tỉnh Đắk Lắk', '2024-05-27', '', 32000, 'thanh toán tiền mặt', 'Chờ xác nhận'),
(85, 14, '3, Đường XYZ, Xã Vĩnh Phong, Huyện Bảo Lâm, Tỉnh Cao Bằng', '2024-05-27', '', 372000, 'thanh toán tiền mặt', 'Chờ xác nhận'),
(86, 19, '4, đường FJK, Xã Danh Thắng, Huyện Hiệp Hòa, Tỉnh Bắc Giang', '2024-05-27', '', 270000, 'thanh toán tiền mặt', 'Chờ xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khohang`
--

CREATE TABLE `khohang` (
  `ID` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuongNhap` int(11) NOT NULL,
  `NgayNhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khohang`
--

INSERT INTO `khohang` (`ID`, `MaNCC`, `MaSP`, `SoLuongNhap`, `NgayNhap`) VALUES
(1, 1, 14, 102, '2024-05-08'),
(2, 2, 11, 290, '2024-05-08'),
(3, 3, 10, 231, '2024-05-08'),
(4, 4, 13, 450, '2024-05-17'),
(8, 4, 9, 3, '2024-05-19'),
(13, 1, 8, 88, '2024-05-16'),
(14, 3, 1, 200, '2024-05-01'),
(15, 1, 1, 90, '2024-05-18'),
(16, 2, 2, 120, '2024-05-18'),
(17, 4, 12, 300, '2024-05-16'),
(18, 1, 3, 200, '2024-05-16'),
(19, 2, 10, 150, '2024-04-30');

--
-- Bẫy `khohang`
--
DELIMITER $$
CREATE TRIGGER `after_insert_khohang` AFTER INSERT ON `khohang` FOR EACH ROW BEGIN
    DECLARE totalQuantity INT;
    
    -- Tính tổng số lượng cho sản phẩm vừa được thêm vào kho
    SELECT SUM(SoLuongNhap) INTO totalQuantity
    FROM khohang
    WHERE MaSP = NEW.MaSP;
    
    -- Cập nhật số lượng trong bảng sanpham
    UPDATE sanpham
    SET SoLuong = totalQuantity
    WHERE MaSP = NEW.MaSP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoai`, `TenLoai`) VALUES
(1, 'Hoa Trang Trí'),
(2, 'Hoa Cưới'),
(3, 'Hoa Cầu Hôn'),
(4, 'Hoa Trang Trí Tết'),
(5, 'Hoa Cỏ'),
(6, 'Hoa Tặng Sinh Nhật');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mausac`
--

CREATE TABLE `mausac` (
  `MaMau` int(11) NOT NULL,
  `TenMau` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mausac`
--

INSERT INTO `mausac` (`MaMau`, `TenMau`) VALUES
(1, 'Xanh'),
(2, 'Trắng'),
(3, 'Đỏ'),
(4, 'Vàng'),
(5, 'Hồng'),
(6, 'Tím');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` varchar(200) NOT NULL,
  `SDT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `SDT`) VALUES
(1, 'DaLat Flowers', '0984993932'),
(2, 'Farmer Good Choice', '0938836854'),
(3, 'Vựa hoa Nhật Minh', '0799485865'),
(4, 'Tiệm hoa La Vie', '0895944952');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(100) DEFAULT NULL,
  `MaLoai` int(11) DEFAULT NULL,
  `DonGia` double DEFAULT NULL,
  `MaMau` int(11) DEFAULT NULL,
  `SoLuong` int(11) NOT NULL,
  `MoTa` varchar(200) DEFAULT NULL,
  `HinhAnh` varchar(100) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `MaLoai`, `DonGia`, `MaMau`, `SoLuong`, `MoTa`, `HinhAnh`, `TrangThai`) VALUES
(1, 'Hoa Hồng Đỏ', 1, 200000, 3, 95, 'Hoa hồng nổi bật với cánh hoa mịn màng, mềm mại và thường có hương thơm ngọt ngào. ', '69.jpg', 1),
(2, 'Hoa Tulip Hồng', 1, 150000, 5, 120, 'Hoa tulip hồng có hình dáng đa dạng, với các cánh hoa dài và mảnh, sắp xếp vòng quanh trung tâm.', '34.jpg', 1),
(3, 'Hoa Tulip Trắng', 2, 250000, 2, 200, ' Tulip trắng là loại hoa có nhiều ý nghĩa tốt đẹp, nó đại diện cho tình yêu thuần khiết', '21.jpg', 1),
(4, 'Hoa Linh Lan', 5, 70000, 2, 56, 'Hoa linh lang trắng mang đến vẻ đẹp tinh khiết và thanh cao.', '35.jpg', 1),
(5, 'Hoa Hồng', 6, 55000, 5, 80, 'Hoa hồng hồng biểu tượng cho sự bí ẩn và độc đáo.', '29.jpg', 1),
(6, 'Hoa Cúc Trắng', 5, 32000, 2, 150, 'Hoa cúc trắng thể hiện sự tinh khiết và chân thật.', '13.jpg', 1),
(8, 'Hoa Ly Tr?ng', 5, 40000, 5, 12, 'Hoa ly tr?ng mang ??n v? ??p tinh khi?t vï¿½ thanh cao.', '25.jpg', 1),
(9, 'Hoa Ly Hồng', 4, 55000, 5, 80, 'Hoa ly hồng biểu tượng cho sự bí ẩn và độc đáo.', '40.jpg', 1),
(10, 'Hoa Hồng Trắng', 2, 32000, 2, 379, 'Hoa Hồng trắng thể hiện sự tinh khiết và chân thật.', '17.jpg', 1),
(11, 'Hoa Mẫu Đơn', 1, 90000, 5, 60, 'Hoa mẫu đơn sang trọng và quý phái.', '26.jpg', 1),
(12, 'Hoa Hướng Dương', 3, 35000, 4, 300, 'Hoa hướng dương tượng trưng cho sự kiên định và niềm tin.', '51.jpg', 1),
(13, 'Hoa Mẫu Đơn Hồng', 3, 47000, 5, 130, 'Hoa mẫu đơn hồng biểu tượng cho tình yêu nồng cháy.', '46.jpg', 1),
(14, 'Hoa Hồng Xanh', 2, 120000, 1, 42, 'Hoa Hồng Xanh rất thích hợp cho những bữa tiệc lãng mạn', '48.jpg', 1),
(16, 'Cẩm Tú Cầu', 4, 340000, 1, 499, 'Cẩm tú cầu rất thích hợp cho những bữa tiệc lãng mạn', '43.jpg', 1),
(17, 'Lavender', 3, 230000, 6, 119, 'Hoa Lavender còn được gọi là herb of love (thảo dược tình yêu). Nó tượng trưng cho tình yêu son sắc, thuỷ chung.', '55.jpg', 1),
(18, 'Hoa Baby Tím', 5, 120000, 6, 600, 'Hoa bi có nhiều màu, mỗi màu lại tượng trưng cho một ý nghĩa khác nhau. Hoa baby tím biểu tượng cho tình yêu chung thủy, không chỉ vậy màu tím mộng mơ', '58.jpg', 1),
(19, 'Hoa Hồng Vàng', 2, 40000, 4, 55, 'Hoa hồng vàng biểu hiện niềm tin, sự hy vọng về tương lai tốt đẹp. Loài hoa hồng vàng biểu trưng cho niềm tin về ngày mai tươi sáng, sẽ đẹp hơn và thành công ', '61.jpg', 1),
(20, 'Hoa Đồng Tiền', 4, 230000, 5, 70, 'Hoa đồng tiền mang nhiều ý nghĩa trong tình yêu và cuộc sống, tượng trưng cho niềm hạnh phúc, sự thịnh vượng, tài lộc. ', '64.jpg', 1),
(21, 'Hoa Tulip Vàng', 2, 260000, 4, 60, 'Hoa tulip vàng. Nếu tulip đỏ đại diện cho tình yêu thì tulip vàng đại diện cho tình bạn, cho ánh nắng mặt trời rực rỡ và may mắn.', '66.jpg', 1);

--
-- Bẫy `sanpham`
--
DELIMITER $$
CREATE TRIGGER `tr_CheckTrangThai` BEFORE INSERT ON `sanpham` FOR EACH ROW BEGIN
    IF NEW.SoLuong > 0 THEN
        SET NEW.TrangThai = 1;
    ELSE
        SET NEW.TrangThai = 0;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_CheckTrangThai_Update` BEFORE UPDATE ON `sanpham` FOR EACH ROW BEGIN
    IF NEW.SoLuong > 0 THEN
        SET NEW.TrangThai = 1;
    ELSE
        SET NEW.TrangThai = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `l_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sdt` text DEFAULT NULL,
  `avatar` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `session` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `code` mediumint(9) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `sdt`, `avatar`, `email`, `userName`, `password`, `session`, `role`, `code`, `status`) VALUES
(3, 'Thành Huy', 'Đỗ', '0337841105', 'https://lh3.googleusercontent.com/a/ACg8ocLSPa7dI8PHb7xKl_Uhv3vOgyt-Xs6b2SOh6ln1G2chLBCIEV_7=s96-c', 'thanhhuy9b@gmail.com', NULL, '123456789a', 'vDyw8Bxx9D', 0, 0, ''),
(4, 'Duy', 'Dương Bá', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocKjb9NMWYWCbRGQ_Mdj1PWlXE232EmZoG9ujm9sIDH4IdcMnGo=s96-c', 'riox.doubled@gmail.com', NULL, '123456789a', '92C7Bw0C0z', 0, 0, 'verified'),
(14, 'Trần', 'Nhật Vy', '0948884833', '', 'trannhatvy281203@gmail.com', 'vytran', '123456789a', '', 0, 0, 'verified'),
(18, 'Trần', 'Nhật Vy', '0983883832', '', 'vytn2812@gmail.com', 'vyduaop', '123456789a', '', 0, 3, ''),
(19, 'duy', 'khùng', '0988998888', '', 'y@gmail.com', 'duy', '123456789a', '', 0, 0, ''),
(20, 'Trần', 'Nhật Vy', '0988998888', '', 'anhhonglenguyen123@gmail.com', 'ledingu', '123456789a', '', 0, 0, ''),
(21, 'Trần', 'Nhật Vy', '0987654321', '', 'qqqq@gmail.com', 'tttt', '123456789a', '', 0, 0, ''),
(22, 'Trần', 'Nhật Vy', '0987654321', '', 'rrr@gmail.com', '12', '123456789a', '', 0, 0, ''),
(23, 'Đặng', 'Quỳnh', '0984738282', '', 'qunh@gmail.com', 'quynh', '12345678a', '', 0, 0, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`MaHD`,`MaSP`),
  ADD KEY `FK_CTHoaDon_HoaDon` (`MaHD`) USING BTREE,
  ADD KEY `FK_CTHoaDon_SanPham` (`MaSP`);

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `FK_DiaChi_KhachHang` (`MaKH`);

--
-- Chỉ mục cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `FK_HinhAnh_SanPham` (`MaSP`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `FK_HoaDon_Users` (`MaKH`);

--
-- Chỉ mục cho bảng `khohang`
--
ALTER TABLE `khohang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_KhoHang_Hoa` (`MaSP`),
  ADD KEY `FK_KhoHang_NCC` (`MaNCC`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `mausac`
--
ALTER TABLE `mausac`
  ADD PRIMARY KEY (`MaMau`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `FK_SanPham_Loai` (`MaLoai`),
  ADD KEY `FK_SanPham_MauSac` (`MaMau`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `diachi`
--
ALTER TABLE `diachi`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `MaHinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `khohang`
--
ALTER TABLE `khohang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `mausac`
--
ALTER TABLE `mausac`
  MODIFY `MaMau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `FK_CTHoaDon_HoaDon` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`),
  ADD CONSTRAINT `FK_CTHoaDon_SanPham` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `FK_DiaChi_KhachHang` FOREIGN KEY (`MaKH`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `FK_HinhAnh_SanPham` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `FK_HoaDon_Users` FOREIGN KEY (`MaKH`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `khohang`
--
ALTER TABLE `khohang`
  ADD CONSTRAINT `FK_KhoHang_Hoa` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `FK_KhoHang_NCC` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SanPham_Loai` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoai`),
  ADD CONSTRAINT `FK_SanPham_MauSac` FOREIGN KEY (`MaMau`) REFERENCES `mausac` (`MaMau`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
