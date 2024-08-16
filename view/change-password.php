<?php
$msg = "";
include 'view/config.php';

if (isset($_GET['reset'])) {
    $reset_code = mysqli_real_escape_string($conn, $_GET['reset']);
    $reset_query = mysqli_prepare($conn, "SELECT * FROM users WHERE code = ?");
    mysqli_stmt_bind_param($reset_query, "s", $reset_code);
    mysqli_stmt_execute($reset_query);
    $result = mysqli_stmt_get_result($reset_query);

    if (mysqli_num_rows($result) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);

            if ($password === $confirm_password) {
                $update_query = mysqli_prepare($conn, "UPDATE users SET password = ?, code = '' WHERE code = ?");
                mysqli_stmt_bind_param($update_query, "ss", $password, $reset_code);

                if (mysqli_stmt_execute($update_query)) {
                    $msg = "<div class='alert alert-success'>Mật khẩu đã được cập nhật thành công! <a href='index.php?page=login'>Đăng nhập ngay</a></div>";
                } else {
                    $msg = "<div class='alert alert-danger'>An error occurred while updating the password. Please try again.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link does not match.</div>";
    }
} else {
    include "view/forgot-password.php";
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Đổi mật khẩu</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- CSS -->
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>
<body>
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
<!-- form section start -->
<div class="login-register-area mt-no-text">
    <div class="container container-default-2 custom-area">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                <div class="login-register-wrapper">
                    <div class="section-content text-center mb-5">
                        <h2 class="title-4 mb-2">ĐỔI MẬT KHẨU</h2>
                        <p class="desc-content">Vui lòng nhập mật khẩu mới.</p>
                    </div>
                    <?php echo $msg; ?>
                    <div class="container">
                        <form action="index.php?page=doimatkhau&reset=<?php echo htmlentities($_GET['reset']); ?>" method="post">
                            <div class="single-input-item mb-2">
                                <input type="password" class="password" name="password" placeholder="Nhập mật khẩu mới" required>
                            </div>
                            <div class="single-input-item mb-2">
                                <input type="password" class="confirm-password" name="confirm-password" placeholder="Nhập lại mật khẩu mới" required>
                            </div>
                            <div class="single-input-item mb-2 text-center">
                                <button class="btn flosun-button secondary-btn theme-color rounded-0" name="submit" type="submit">Đổi mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //form section start -->
</body>
</html>
