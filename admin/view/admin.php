<div id="layoutSidenav_content">
<main>
<a class="btn btn-primary" href="index.php?act=insert_admin" style="margin:20px;">Thêm Mới</a>

<table class="table table-light table-striped">
           <th>ID</th>
           <th>UserName</th>
           <th>Password</th>
           <th></th>
        </tr>
        <?php
        if(isset($admin)&&(count($admin)>0))
        {
            foreach($admin as $KQ)
            {

        ?>
        <tr>
            <td><?php echo $KQ['id'] ?></td>
            <td><?php echo $KQ['username'] ?></td>
            <td><?php echo $KQ['password'] ?></td>
            <td><a href="index.php?act=edit_admin&id=<?php echo $KQ['id'] ?>" class="btn btn-primary">Sửa</a>  <a href="#" onclick="confirmDelete(<?php echo $KQ['id']; ?>)" class="btn btn-danger">Xóa</a></td>
           
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
            window.location.href = "index.php?act=del_admin&id=" + id;
        }
        
    }
</script>


