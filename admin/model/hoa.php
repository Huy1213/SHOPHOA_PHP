<?php
function del($id){
    $conn = ketnoi();

    // Bắt đầu transaction
    $conn->beginTransaction();

    try {
        // Xóa các hình ảnh liên quan khỏi bảng hinhanh
        $sqlHinhAnh = "DELETE FROM hinhanh WHERE MaSP = :id";
        $stmtHinhAnh = $conn->prepare($sqlHinhAnh);
        $stmtHinhAnh->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtHinhAnh->execute();

        // Xóa sản phẩm khỏi bảng sanpham
        $sqlSanPham = "DELETE FROM sanpham WHERE MaSP = :id";
        $stmtSanPham = $conn->prepare($sqlSanPham);
        $stmtSanPham->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtSanPham->execute();

        // Commit transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi
        $conn->rollBack();
        throw $e;  // Ném lại lỗi để xử lý hoặc ghi log nếu cần thiết
    }
}
function edithoa($id,$tensp, $maloai, $dongia, $mamau, $soluong, $mota, $hinhanh)
{
    $conn = ketnoi();
    if($hinhanh=="")
    {
        $sql = "UPDATE sanpham set TenSP='".$tensp."',MaLoai='".$maloai."',DonGia='".$dongia."', MoTa='".$mota."',MaMau='".$mamau."',SoLuong='".$soluong."' where MaSP=".$id;
    }
    else{
        $sql = "UPDATE sanpham set TenSP='".$tensp."',MaLoai='".$maloai."',DonGia='".$dongia."', MoTa='".$mota."',MaMau='".$mamau."',HinhAnh='".$hinhanh."',SoLuong='".$soluong."' where MaSP=".$id;
    }
   
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
// function inserthoa($tenhoa,$soluong,$hinhanh,$dongia,$maloai)
// {
//     $conn = ketnoi();
//     $sql = "INSERT INTO san_pham (Ten_Hoa, So_Luong, Hinh_anh, Don_Gia, Ma_Loai) values('$tenhoa','$soluong','$hinhanh','$dongia','$maloai')";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
// }
function inserthoa($tensp, $maloai, $dongia, $mamau, $soluong, $mota, $hinhanh, $trangthai, $conn) {
    $sql = "INSERT INTO sanpham (TenSP, MaLoai, DonGia, MaMau, SoLuong, MoTa, HinhAnh, TrangThai) VALUES (?, ?, ?, ?, ?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$tensp, $maloai, $dongia, $mamau, $soluong, $mota, $hinhanh, $trangthai]);
}
function getone($id){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM sanpham where MaSP=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function getall($page,$soluongsp){
    $batdau = ($page-1)*$soluongsp;
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM sanpham LIMIT ".$batdau.",".$soluongsp);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function countRowsInTable() {
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_rows FROM sanpham");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_rows'];
}

function getall_loaiHoa(){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM loaisp");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $loai = $stmt->fetchAll();
    return $loai;
}
function getone_loaihoa($id){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM loaisp where MaLoai=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $loai = $stmt->fetchAll();
    return $loai;
}
function edit_loaihoa($id,$tenloai)
{
    $conn = ketnoi();
    $sql = "UPDATE loaisp set TenLoai='".$tenloai."' where MaLoai=".$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function insert_loaihoa($tenloai)
{
    $conn = ketnoi();
    $sql = "INSERT INTO loaisp (TenLoai) values('$tenloai')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function del_loaihoa($id){
    $conn = ketnoi();
    //$sql ="DELETE FROM loai where Ma_Loai=".$id;
    //$conn->exec($sql);
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_hoa FROM sanpham WHERE MaLoai = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result['total_hoa'] > 0) {
        // Nếu có hoa sử dụng mã loại này, thông báo không thể xóa
        echo "<script>alert('Không thể xóa loại hoa này vì có hoa sử dụng mã loại này.'); window.location.href = 'index.php?act=loaihoa';</script>";
    } else {
        // Nếu không có hoa sử dụng mã loại này, thực hiện xóa
        $sql ="DELETE FROM loaisp where MaLoai=".$id;
        $conn->exec($sql);
    }
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
function getall_Mau(){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM mausac");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $loai = $stmt->fetchAll();
    return $loai;
}
function get_MaHinh($MaSP) {
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT MaHinh FROM hinhanh WHERE MaSP = ?");
    $stmt->execute([$MaSP]);
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $result;
}
 ?>
