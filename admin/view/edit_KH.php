<div id="layoutSidenav_content">
<main>
    <form action="index.php?act=edit_KH" method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>SẢN PHẨM</h2>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" name="id" placeholder="" value="<?=$kq1[0]['id']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="l_name" class="form-label">Họ</label>
            <input type="text" class="form-control" name="l_name" placeholder="" value="<?=$kq1[0]['l_name']?>">
        </div>
        <div class="mb-3">
            <label for="f_name" class="form-label">Tên</label>
            <input type="text" class="form-control" name="f_name" placeholder="" value="<?=$kq1[0]['f_name']?>">
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="" value="<?=$kq1[0]['email']?>">
        </div>
        <div class="mb-3">
            <label for="userName" class="form-label">UserName</label>
            <input type="text" class="form-control" name="userName" placeholder="" value="<?=$kq1[0]['userName']?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" placeholder="" value="<?=$kq1[0]['password']?>">
        </div>
        <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Save" class="btn btn-secondary" name="edit_KH"/>
        </div>
    </div>
    </div>

    </form>
    
    
</main>
</div>
