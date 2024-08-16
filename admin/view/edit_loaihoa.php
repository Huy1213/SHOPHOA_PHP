<div id="layoutSidenav_content">
<main>
    <form action="index.php?act=edit_loaihoa" method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>CÁC LOẠI HOA</h2>
        <div class="mb-3">
            <label for="MaLoai" class="form-label">Mã Loại</label>
            <input type="text" class="form-control" name="MaLoai" placeholder="" value="<?=$loaihoa1[0]['MaLoai']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="TenLoai" class="form-label">Tên Loại</label>
            <input type="text" class="form-control" name="TenLoai" placeholder="" value="<?=$loaihoa1[0]['TenLoai']?>">
        </div>
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Save" class="btn btn-secondary" name="edit_loaihoa"/>
        </div>
    </div>
    </div>

    </form>
    
    
</main>
</div>
