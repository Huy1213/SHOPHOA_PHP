<?php
require('../../tfpdf/tfpdf.php');
require('../model/KetNoi.php');  

function in_HD($mahd) {
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
function tongtien($mahd) {
    $conn = ketnoi();
    $stmt = $conn->prepare("select sum(chitiethoadon.SoLuong*chitiethoadon.DonGia) as TongTien from chitiethoadon where MaHD = '".$mahd."'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result['TongTien'];
}
if (isset($_GET['id'])) {
    
    $pdf = new tFPDF();
    $pdf->AddPage();

    // Add a Unicode font (uses UTF-8)
    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $pdf->SetFont('DejaVu','',18);

    $mahd = $_GET['id'];
    $inHoaDon = in_HD($mahd);
    $tongTien = tongtien($mahd);
    // Title
    $pdf->Write(10, 'FLOWER SHOP');
    $pdf->Ln(10);
    $pdf->SetFont('DejaVu','',16);
    $pdf->Write(10, 'Đơn hàng của bạn gồm có:');
    $pdf->Ln(10);

    // Table Header
    $pdf->SetFillColor(230, 230, 230);
    $pdf->SetFont('DejaVu','',12);
    $pdf->Cell(30, 10, 'Mã HD', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Tên Sản phẩm', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Ngày đặt', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Ghi chú', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Số lượng', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Đơn giá', 1, 1, 'C', true);

    // Table Body
    $pdf->SetFont('DejaVu','',12);
    foreach ($inHoaDon as $row) {
        $pdf->Cell(30, 10, $row['MaHD'], 1);
        $pdf->Cell(40, 10, $row['TenSP'], 1);
        $pdf->Cell(30, 10, $row['NgayDat'], 1);
        $pdf->Cell(50, 10, $row['GhiChu'], 1);
        $pdf->Cell(20, 10, $row['SoLuong'], 1);
        $pdf->Cell(20, 10, $row['DonGia'], 1, 1);
    }

    $pdf->Ln(10);

    $pdf->Write(10, 'Tổng tiền: ' . number_format($tongTien) . ' VND');

    $pdf->Ln(10);
    $pdf->Write(10, 'Cám ơn bạn đã đặt hàng tại website của chúng tôi.');
    $pdf->Ln(10);

    $pdf->Output();
    exit;
}
?>