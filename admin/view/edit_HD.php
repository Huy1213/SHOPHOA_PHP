<div id="layoutSidenav_content">
<main>
    <form action="index.php?act=edit_HD" method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>SẢN PHẨM</h2>
        <div class="mb-3">
            <label for="MaHD" class="form-label">Mã HD</label>
            <input type="number" class="form-control" name="MaHD" placeholder="" value="<?=$kq1[0]['MaHD']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="MaKH" class="form-label">Mã KH</label>
            <input type="number" class="form-control" name="MaKH" placeholder="" value="<?=$kq1[0]['MaKH']?>">
        </div>
        <div class="mb-3">
            <label for="DCGH" class="form-label">Địa Chỉ Giao Hàng</label>
            <input type="text" class="form-control" name="DCGH" placeholder="" value="<?=$kq1[0]['DiaChiGiaoHang']?>">
        </div>
        <div class="mb-3">
            <label for="NgayDat" class="form-label">Ngày Đặt</label>
            <input type="date" class="form-control" name="NgayDat" placeholder="" value="<?=$kq1[0]['NgayDat']?>">
        </div>
        <div class="mb-3">
            <label for="GhiChu" class="form-label">Ghi Chú</label>
            <input type="text" class="form-control" name="GhiChu" placeholder="" value="<?=$kq1[0]['GhiChu']?>">
        </div>
        <div class="mb-3">
        <label for="HTTT" class="form-label">Hình Thức Thanh Toán</label>
        <select class="form-select" name="HTTT">
            <option value="Tiền mặt" <?php if($kq1[0]['HinhThucThanhToan'] == "Tiền mặt") echo 'selected="selected"'; ?>>Tiền mặt</option>
            <option value="Chuyển khoản" <?php if($kq1[0]['HinhThucThanhToan'] == "Chuyển khoản") echo 'selected="selected"'; ?>>Chuyển khoản</option>
            <option value="Thẻ tín dụng" <?php if($kq1[0]['HinhThucThanhToan'] == "Thẻ tín dụng") echo 'selected="selected"'; ?>>Thẻ tín dụng</option>
            <!-- Thêm các lựa chọn khác tùy thuộc vào nhu cầu của bạn -->
        </select>
</div>
        <div class="mb-3">
            <label for="TinhTrang" class="form-label">Tình Trạng</label>
            <select class="form-select" name="TinhTrang">
                <option value="Chờ xác nhận" <?php if($kq1[0]['TinhTrang'] == "Chờ xác nhận") echo 'selected="selected"'; ?>>Chờ xác nhận</option>
                <option value="Đang giao hàng" <?php if($kq1[0]['TinhTrang'] == "Đang giao hàng") echo 'selected="selected"'; ?>>Đang giao hàng</option>
                <option value="Giao thành công" <?php if($kq1[0]['TinhTrang'] == "Giao thành công") echo 'selected="selected"'; ?>>Giao thành công</option>
                <option value="Đã Hủy" <?php if($kq1[0]['TinhTrang'] == "Đã Hủy") echo 'selected="selected"'; ?>>Đã Hủy</option>
                <!-- Thêm các lựa chọn khác tùy thuộc vào nhu cầu của bạn -->
            </select>
        </div>
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Save" class="btn btn-secondary" name="edit_HD"/>
        </div>
    </div>
    </div>

    </form>
    
    
</main>
</div>
