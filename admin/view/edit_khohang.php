
<div id="layoutSidenav_content">
<main>
    <form action="index.php?act=edit_khohang" method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>SẢN PHẨM</h2>
        <div class="mb-3">
            <label for="MaSP" class="form-label">ID</label>
            <input type="number" class="form-control" name="ID" placeholder="" value="<?=$kq1[0]['ID']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="MaLoai" class="form-label">Tên nhà cung cấp</label>
            <!-- <input type="text" class="form-control" name="Ma_Loai" placeholder="" value=""> -->
            <select name="MaNCC" id="" class="form-control">
                <option value="0">Chọn tên nhà cung cấp</option>
                <?php
                    $mancc1=$kq1[0]['TenNCC'];
                    if(isset($mancc))
                    {
                        foreach($mancc as $KQ)
                        {
                            if($KQ['MaNCC']==$mancc1)
                                echo '<option value="'.$KQ['MaNCC'].'" selected>'.$KQ['TenNCC'].'</option>';
                            else
                                echo'<option value="'.$KQ['MaNCC'].'">'.$KQ['TenNCC'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="MaLoai" class="form-label">Tên sản phẩm</label>
            <!-- <input type="text" class="form-control" name="Ma_Loai" placeholder="" value=""> -->
            <select name="MaSP" id="" class="form-control">
                <option value="0">Chọn tên sản phẩm</option>
                <?php
                    $masp1=$kq1[0]['MaSP'];
                    if(isset($tensp))
                    {
                        foreach($masp as $KQ)
                        {
                            if($KQ['MaSP']==$masp1)
                                echo '<option value="'.$KQ['MaSP'].'" selected>'.$KQ['TenSP'].'</option>';
                            else
                                echo'<option value="'.$KQ['MaSP'].'">'.$KQ['TenSP'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="SoLuongNhap" class="form-label">Số Lượng Nhap</label>
            <input type="number" class="form-control" name="SoLuongNhap" placeholder="" value="<?=$kq1[0]['SoLuongNhap']?>">
        </div>
        <div class="mb-3">
            <label for="MoTa" class="form-label">Ngày Nhập</label>
            <input type="date" class="form-control" name="NgayNhap" placeholder="" value="<?=$kq1[0]['NgayNhap']?>">
        </div>
      
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Save" class="btn btn-secondary" name="edit_khohang"/>
        </div>
    </div>
    </div>

    </form>
    
    
</main>
</div>
