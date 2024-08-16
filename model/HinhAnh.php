<?php 
    function get_HinhAnh($maSP)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM HinhAnh where MaSP = '$maSP' LIMIT 1");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
    function get_AllHinhAnh($maSP)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM HinhAnh where MaSP = '$maSP'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
?>