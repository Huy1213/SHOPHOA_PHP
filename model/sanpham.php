<?php 
    function getAll_SanPham()
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM sanpham");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }

    function get_SanPham($maSanPham)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM sanpham where MaSP = '$maSanPham'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }

    function countRowsInTable() {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total_rows FROM sanpham");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_rows'];
    }
    function getall_hoa($key, $page, $soluongsp) {
        $batdau = ($page - 1) * $soluongsp;
        $conn = ketnoi();
        $sql = "SELECT * FROM sanpham WHERE 1 ";
        if ($key != "") {
            $sql .= "AND TenSP LIKE '%" . $key . "%' ";
        }
        $sql .= "ORDER BY MaSP ASC LIMIT " . $batdau . "," . $soluongsp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $loai = $stmt->fetchAll();
        return $loai;
    }

    function sortSanPhamByName($keyword, $current_page, $soluongsp) {
        $batdau = ($current_page - 1) * $soluongsp;
        $conn = ketnoi();
        $sql = "SELECT * FROM sanpham WHERE 1 ";
        if (!empty($keyword)) {
            $sql .= "AND TenSP LIKE '%" . $keyword . "%' ";
        }
        $sql .= "ORDER BY TenSP ASC LIMIT " . $batdau . "," . $soluongsp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }

    function sortSanPhamByPrice($keyword, $current_page, $soluongsp) {
        $batdau = ($current_page - 1) * $soluongsp;
        $conn = ketnoi();
        $sql = "SELECT * FROM sanpham WHERE 1 ";
        if (!empty($keyword)) {
            $sql .= "AND TenSP LIKE '%" . $keyword . "%' ";
        }
        $sql .= "ORDER BY DonGia ASC LIMIT " . $batdau . "," . $soluongsp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
    function getSPTheoMau($mamau)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM sanpham WHERE MaMau = '$mamau'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }
?>