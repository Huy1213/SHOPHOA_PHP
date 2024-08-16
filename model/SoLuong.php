<?php 
    function getSoLuong($MaSP,$MaMau)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM soluong where MaSP = '$MaSP' and MaMau = '$MaMau'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham[0]['SoLuong'];
    }
    function getMaMau($MaSP)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM soluong,mausac where MaSP = '$MaSP' and soluong.MaMau = mausac.MaMau");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
?>