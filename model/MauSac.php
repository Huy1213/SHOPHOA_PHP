<?php 
    function get_MauSac($mamau)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM mausac where MaMau = '$mamau'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
    function get_AllMauSac()
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM mausac");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
?>