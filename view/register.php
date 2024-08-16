<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            //Lấy tỉnh thành
            $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
                if (data_tinh.error === 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                    });
                    $("#tinh").change(function(e) {
                        var idtinh = $(this).val();
                        var tenTinh = $("#tinh option:selected").text(); // Lấy tên tỉnh được chọn
                        $("#hidden_tinh").val(tenTinh); // Đặt giá trị của trường ẩn để gửi tên tỉnh về server
                        
                        //Lấy quận huyện
                        $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                            if (data_quan.error === 0) {
                                $("#quan").html('<option value="0">Quận Huyện</option>');
                                $("#phuong").html('<option value="0">Phường Xã</option>');
                                $.each(data_quan.data, function(key_quan, val_quan) {
                                    $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                                });
                            }
                        });
                    });
                }
            });
            
            //Lấy phường xã khi chọn quận huyện
            $("#quan").change(function(e) {
                var idquan = $(this).val();
                var tenQuan = $("#quan option:selected").text(); // Lấy tên quận huyện được chọn
                $("#hidden_quan").val(tenQuan); // Đặt giá trị của trường ẩn để gửi tên quận huyện về server
                
                $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                    if (data_phuong.error === 0) {
                        $("#phuong").html('<option value="0">Phường Xã</option>');
                        $.each(data_phuong.data, function(key_phuong, val_phuong) {
                            $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                        });
                    }
                });
            });
            // Lấy phường xã khi chọn phường xã
            $("#phuong").change(function(e) {
                var tenPhuong = $("#phuong option:selected").text(); // Lấy tên phường xã được chọn
                $("#hidden_phuong").val(tenPhuong); // Đặt giá trị của trường ẩn để gửi tên phường xã về server
            });
        }); 
    </script>
</head>
<body>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Đăng nhập-Đăng ký</h3>
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li>Đăng nhập-Đăng ký</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Register Area Start Here -->
    <div class="login-register-area mt-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title-4 mb-2">Tạo tài khoản</h2>
                            <p class="desc-content">Vui lòng đăng ký bằng cách sử dụng chi tiết tài khoản dưới đây.</p>
                        </div>
                        <form action="index.php?page=dangky" method="post">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="single-input-item mb-2">
                                            <input type="text" id="f_name" placeholder="Họ" name="f_name" required>
                                            <div class="text-danger" style="font-size:smaller" id="f_nameError"><?php echo isset($errors['f_name']) ? $errors['f_name'] : ''; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="single-input-item mb-2">
                                            <input type="text" id="l_name" placeholder="Tên" name="l_name" required>
                                            <div class="text-danger" style="font-size:smaller" id="l_nameError"><?php echo isset($errors['l_name']) ? $errors['l_name'] : ''; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="single-input-item mb-2">
                                            <input type="text" id="sdt" placeholder="Số điện thoại" name="sdt" required>
                                            <div class="text-danger" style="font-size:smaller" id="sdtError"><?php echo isset($errors['sdt']) ? $errors['sdt'] : ''; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="single-input-item mb-2">
                                            <input type="email" id="email" placeholder="Email" name="email" required>
                                            <div class="text-danger" style="font-size:smaller" id="emailError"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="single-input-item mb-0">
                                        <input type="text" id="diachi" placeholder="Nhập địa chỉ" name="diachi" required>
                                        <div class="text-danger" style="font-size:smaller" id="diachiError"><?php echo isset($errors['diachi']) ? $errors['diachi'] : ''; ?></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="single-input-item mb-3">
                                            <input type="hidden" id="hidden_tinh" name="hidden_tinh" value="">
                                            <select id="tinh" name="tinh" style="font-size: 14px; border-radius: 0%; border:0;" class="form-control">
                                                <option value="">Chọn tỉnh</option>
                                                <!-- populate options with data from your database or API -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="single-input-item mb-2">
                                            <input type="hidden" id="hidden_quan" name="hidden_quan" value="">
                                            <select id="quan" name="quan" style="font-size: 14px; border-radius: 0%; border:0;" class="form-control">
                                                <option value="">Chọn quận/huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="single-input-item mb-2">
                                            <input type="hidden" id="hidden_phuong" name="hidden_phuong" value="">
                                            <select id="phuong" name="phuong" style="font-size: 14px; border-radius: 0%; border:0;" class="form-control">
                                                <option value="">Chọn xã/phường</option>
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="single-input-item mb-2">
                                        <input type="text" id="userName" placeholder="Tên đăng nhập" name="userName" required>
                                        <div class="text-danger" style="font-size:smaller" id="userNameError"><?php echo isset($errors['userName']) ? $errors['userName'] : ''; ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="single-input-item mb-2">
                                            <input type="password" id="password" placeholder="Nhập mật khẩu" name="password" required>
                                            <div class="text-danger" style="font-size:smaller" id="passwordError"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="single-input-item mb-1">
                                            <input type="password" id="confirm_pwd" placeholder="Xác nhận mật khẩu" name="confirm_pwd" required>
                                            <div class="text-danger" style="font-size:smaller" id="confirm_pwdError"><?php echo isset($errors['confirm_pwd']) ? $errors['confirm_pwd'] : ''; ?></div>
                                        </div>
                                    </div>
                                    <div class="single-input-item mb-1">
                                        <input class="btn flosun-button secondary-btn theme-color rounded-0" type="submit" value="Đăng Ký" name="dangky">
                                        <div><p>Đã có tài khoản? <a class="fw-bold" href="index.php?page=login">Đăng nhập tại đây</a></p></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Area End Here -->
</body>
</html>