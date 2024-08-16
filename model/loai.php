<?php
    function getAll_Loai()
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM loaisp");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $loai = $stmt->fetchAll();
        return $loai;
    }

    function getSPtheoLoai($maloai)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM sanpham WHERE maloai = '$maloai'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $loai = $stmt->fetchAll();
        return $loai;
    }
?>