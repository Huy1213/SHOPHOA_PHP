<?php
function getall_thongke(){
    $conn = ketnoi();
    $stmt = $conn->prepare("select loaisp.MaLoai as Ma_Loai, loaisp.TenLoai as Ten_Loai, sum(sanpham.SoLuong) as So_Luong from sanpham LEFT JOIN loaisp on loaisp.MaLoai = sanpham.MaLoai GROUP by loaisp.MaLoai, loaisp.TenLoai;");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $listtk = $stmt->fetchAll();
    return $listtk;
}
function getall_thongke_doanhthu($start_date = null, $end_date = null){
    $conn = ketnoi();
    $sql = "SELECT sp.TenSP AS Ten_San_Pham, SUM(cthd.SoLuong) AS So_Luong_Ban_Ra, SUM(cthd.SoLuong * cthd.DonGia) AS Doanh_Thu
            FROM chitiethoadon cthd 
            INNER JOIN sanpham sp ON cthd.MaSP = sp.MaSP
            INNER JOIN hoadon hd ON hd.MaHD = cthd.MaHD";
    
    if ($start_date && $end_date) {
        $sql .= " WHERE hd.NgayDat BETWEEN :start_date AND :end_date";
    } elseif ($start_date) {
        $sql .= " WHERE hd.NgayDat >= :start_date";
    } elseif ($end_date) {
        $sql .= " WHERE hd.NgayDat <= :end_date";
    }
    
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
    
    $sql .= " GROUP BY sp.TenSP";
    $stmt = $conn->prepare($sql);
   

    if ($start_date) {
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    }
    if ($end_date) {
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    }
    
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $listtkdt = $stmt->fetchAll();
    return $listtkdt;
}
function in_HD($mahd)
{
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT h.MaHD,s.TenSP, h.NgayDat, h.GhiChu, c.SoLuong, c.DonGia
        FROM hoadon h
        JOIN chitiethoadon c ON h.MaHD = c.MaHD
        JOIN sanpham s ON c.MaSP = s.MaSP
        WHERE h.MaHD = '".$mahd."'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $in = $stmt->fetchAll();
    return $in;
}
function getall_khohang(){
    $conn = ketnoi();
    $stmt = $conn->prepare("select ID, TenNCC, TenSP, SoLuongNhap, NgayNhap from khohang, sanpham, nhacungcap where khohang.MaNCC = nhacungcap.MaNCC and khohang.MaSP = sanpham.MaSP");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kho = $stmt->fetchAll();
    return $kho;
}
function getone_khohang($id){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM khohang where ID=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $khohang = $stmt->fetchAll();
    return $khohang;
}
function edit_khohang($id,$mancc,$masp,$soluongnhap,$ngaynhap)
{
    $conn = ketnoi();
    $sql = "UPDATE khohang set MaNCC='".$mancc."', MaSP='".$masp."', SoLuongNhap='".$soluongnhap."', NgayNhap='".$ngaynhap."' where ID=".$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function getall_NCC(){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM nhacungcap");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $loai = $stmt->fetchAll();
    return $loai;
}
function getall_SP(){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM sanpham");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $loai = $stmt->fetchAll();
    return $loai;
}
function insert_khohang($mancc,$masp,$soluongnhap,$ngaynhap) {
    $conn = ketnoi();
    $sql = "INSERT INTO khohang (MaNCC, MaSP, SoLuongNhap, NgayNhap) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$mancc,$masp,$soluongnhap,$ngaynhap]);
}
function del_khohang($id){
    $conn = ketnoi();
    $sql ="DELETE FROM khohang where ID=".$id;
    $conn->exec($sql);
}
?>