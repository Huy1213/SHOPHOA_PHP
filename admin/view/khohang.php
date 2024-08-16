<div id="layoutSidenav_content">
<main>
<a class="btn btn-primary" href="index.php?act=insert_khohang" style="margin:20px;">Thêm Mới</a>

<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="post" action="index.php?act=hoadon">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search" name="timkiem"></i></button>
                </div>
</form>
<table class="table table-light table-striped" style="margin-top: 10px;">
           <th>ID</th>
           <th>Tên Nhà Cung Cấp</th>
           <th>Tên Sản Phẩm</th>
           <th>Số Lượng Nhập</th>
           <th>Ngày Nhập</th>
           <th></th>
           <th></th>
        </tr>
        <?php
        if(isset($khohang)&&(count($khohang)>0))
        {
            foreach($khohang as $KH)
            {

        ?>
        <tr>
            <td><?php echo $KH['ID'] ?></td>
            <td><?php echo $KH['TenNCC'] ?></td>
            <td><?php echo $KH['TenSP'] ?></td>
            <td>
                <input type="number" value="<?php echo $KH['SoLuongNhap'] ?>" id="quantity-<?php echo $KH['ID'] ?>" onkeydown="checkEnter(event, <?php echo $KH['ID'] ?>)">
            </td>
            <td><?php echo $KH['NgayNhap'] ?></td>
            <td><a href="index.php?act=edit_khohang&id=<?php echo $KH['ID'] ?>" class="btn btn-primary">Sửa</a></td>
            <td><a href="index.php?act=del_khohang&id=<?php echo $KH['ID'] ?>" class="btn btn-danger">Xóa</a></td>
            <!-- <td><button class="btn btn-success" onclick="updateQuantity(<?php echo $KH['ID'] ?>)">Update</button></td> -->
    
            
</td>
        </tr>
        <?php 
            }
            $con = null;

        } 
           
        ?>
    </table>
    
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkEnter(event, id) {
    if (event.key === "Enter") {
        updateQuantity(id);
    }
}
function updateQuantity(id) {
    var quantity = $('#quantity-' + id).val();
    $.ajax({
        url: 'view/update_soluong.php',
        type: 'POST',
        data: { id: id, quantity: quantity },
        success: function(response) {
            alert(response);
        },
        error: function(xhr, status, error) {
            alert('Error: ' + error);
        }
    });
}
</script>
