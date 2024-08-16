<div id="layoutSidenav_content">
<main>
    <form action="index.php?act=insert_khohang" method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>SẢN PHẨM</h2>
        <div class="mb-3">
            <label for="SoLuong" class="form-label">Số Lượng</label>
            <input type="number" class="form-control" name="SoLuongNhap" placeholder="" >
        </div>
        <div class="mb-3">
            <label for="MoTa" class="form-label">NgayNhap</label>
            <input type="date" class="form-control" name="NgayNhap" placeholder="" >
        </div>
       
        <div class="mb-3">
            <label for="MaLoai" class="form-label">Nhà cung cấp</label>
            <!-- <input type="text" class="form-control" name="Ma_Loai" placeholder="" value=""> -->
            <select name="MaNCC" id="" class="form-control">
                <option value="0">Chọn nhà cung cấp</option>
                <?php
                    $mancc=$kq1[0]['MaNCC'];
                    if(isset($ncc))
                    {
                        foreach($ncc as $KQ)
                        {
                            if($KQ['MaNCC']==$mancc)
                                echo '<option value="'.$KQ['MaNCC'].'" selected>'.$KQ['TenNCC'].'</option>';
                            else
                                echo'<option value="'.$KQ['MaNCC'].'">'.$KQ['TenNCC'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="MaSP" class="form-label">Sản phẩm</label>
            <!-- <input type="text" class="form-control" name="Ma_Loai" placeholder="" value=""> -->
            <select name="MaSP" id="" class="form-control">
                <option value="0">Chọn sản phẩm</option>
                <?php
                    $masp=$kq1[0]['MaSP'];
                    if(isset($sp))
                    {
                        foreach($sp as $KQ1)
                        {
                            if($KQ1['MaSP']==$masp)
                                echo '<option value="'.$KQ1['MaSP'].'" selected>'.$KQ1['TenSP'].'</option>';
                            else
                                echo'<option value="'.$KQ1['MaSP'].'">'.$KQ1['TenSP'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Save" class="btn btn-secondary" name="insert_khohang"/>
        </div>
    </div>
    </div>

    </form>
    
    
</main>
</div>
