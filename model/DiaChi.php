<?php 
    function insertDiaChi($MaKH,$Duong,$Phuong,$Huyen,$Tinh)
    {
        $conn = ketnoi();
        $sql = "INSERT INTO diachi (MaKH,Duong,Phuong,Huyen,Tinh) values('$MaKH','$Duong','$Phuong','$Huyen','$Tinh')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastInsertedId = $conn->lastInsertId();
        return $lastInsertedId;
    }

    function getDiaChi($id)
    {
        $conn = ketnoi();
        $sql = "SELECT * FROM diachi WHERE MaKH = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }

    function countDiaChi($id)
    {
    $conn = ketnoi();
    $sql = "SELECT count(*) FROM diachi WHERE MaKH = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn(); // Lấy giá trị của cột đầu tiên
    return $count;
    }

    function DeleteDiaChi($id,$MaDC)
    {
        $conn = ketnoi();
        $sql = "DELETE FROM diachi WHERE MaKH = '$id' and MaDC = '$MaDC'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); 
    }

    function UpdateDiaChi($MaDC,$MaKH,$Duong,$Phuong,$Huyen,$Tinh)
    {
        $conn = ketnoi();
        $sql = "UPDATE diachi SET Duong = '$Duong', Phuong = '$Phuong', Huyen = '$Huyen', Tinh = '$Tinh' WHERE MaDC = '$MaDC' and MaKH = '$MaKH'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }

    function getOneDiaChi($id,$MaDC)
    {
        $conn = ketnoi();
        $sql = "SELECT * FROM diachi WHERE MaKH = '$id' AND MaDC = '$MaDC'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sanpham = $stmt->fetch(); 
        return $sanpham;
    }
    
?>