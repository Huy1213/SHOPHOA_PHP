<div id="layoutSidenav_content">
<main>
<a class="btn btn-primary" href="index.php?act=insert_loaihoa" style="margin:20px;">Thêm Mới</a>

<table class="table table-light table-striped">
           <th>Mã loại</th>
           <th>Tên loại</th>
           <th></th>
        </tr>
        <?php
        if(isset($loai)&&(count($loai)>0))
        {
            foreach($loai as $KQ)
            {

        ?>
        <tr>
            <td><?php echo $KQ['MaLoai'] ?></td>
            <td><?php echo $KQ['TenLoai'] ?></td>
            <td><a href="index.php?act=edit_loaihoa&id=<?php echo $KQ['MaLoai'] ?>" class="btn btn-primary">Sửa</a>  <a href="#" onclick="confirmDelete(<?php echo $KQ['MaLoai']; ?>)" class="btn btn-danger">Xóa</a></td>
           
        </tr>
        <?php 
            }
            $con = null;

        } 
           
        ?>
      
    
</main>
</div>
<script>
    function confirmDelete(id) {
        var confirmation = confirm("Bạn có chắc chắn muốn xóa?");
        if (confirmation) {
            window.location.href = "index.php?act=del_loaihoa&id=" + id;
        }
        
    }
</script>


