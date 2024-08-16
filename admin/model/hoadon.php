<?php
function del_HD($id){
    $conn = ketnoi();
    $sql ="DELETE FROM hoadon where MaHD=".$id;
    $conn->exec($sql);
}
function edit_HD($id,$makh,$dcgh,$ngaydat,$ghichu,$httt,$tinhtrang)
{
    $conn = ketnoi();
    $sql = "UPDATE hoadon set MaKH='".$makh."',NgayDat='".$ngaydat."',GhiChu='".$ghichu."',DiaChiGiaoHang='".$dcgh."',HinhThucThanhToan='".$httt."',TinhTrang='".$tinhtrang."' where MaHD=".$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function getone_HD($id){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM hoadon where MaHD=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function getall_HD($key, $page, $soluongsp) {
    $batdau = ($page - 1) * $soluongsp;
    $conn = ketnoi();
    $sql = "SELECT * FROM hoadon WHERE 1 ";
    if ($key != "") {
        $sql .= "OR NgayDat LIKE '%" . $key . "%' ";
        $sql .= "OR TinhTrang LIKE '%" . $key . "%' ";
    }
    $sql .= "ORDER BY MaHD ASC LIMIT " . $batdau . "," . $soluongsp;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kh = $stmt->fetchAll();
    return $kh;
}
function getall_HD1($page,$soluongsp){
    $batdau = ($page-1)*$soluongsp;
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM hoadon LIMIT ".$batdau.",".$soluongsp);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function countRowsInTable_HD() {
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_rows FROM hoadon");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_rows'];
}
?>