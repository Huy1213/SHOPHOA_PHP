<div id="layoutSidenav_content">
<main>
<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="post" action="index.php?act=khachhang" style="margin-top: 10px;">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search" name="timkiem"></i></button>
                </div>
</form>
<br>
<table class="table table-light table-striped" style="margin-top: 10px;">
           <th>Mã KH</th>
           <th>Họ</th>
           <th>Tên</th>
           <th>Email</th>
           <th>UserName</th>
           <th>Password</th>
           <th></th>
           <th></th>
        </tr>
        <?php
        if(isset($kh)&&(count($kh)>0))
        {
            foreach($kh as $KH)
            {

        ?>
        <tr>
            <td><?php echo $KH['id'] ?></td>
            <td><?php echo $KH['l_name'] ?></td>
            <td><?php echo $KH['f_name'] ?></td>
            <td><?php echo $KH['email'] ?></td>
            <td><?php echo $KH['userName'] ?></td>
            <td><?php echo $KH['password'] ?></td>
            <td><a href="index.php?act=edit_KH&id=<?php echo $KH['id'] ?>" class="btn btn-primary">Sửa</a> </td>
            <td> <a href="index.php?act=del_KH&id=<?php echo $KH['id'] ?>" class="btn btn-danger">Xóa</a></td>
</td>
        </tr>
        <?php 
            }
            $con = null;

        } 
           
        ?>
    </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                <a class="page-link">Previous</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item"><a class="page-link" href="index.php?act=khachhang&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    
</main>
</div>
