<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="login.css">
	<title>Trang Đăng Nhập</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

<!-- CSS
============================================ -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="assets/css/vendor/font.awesome.min.css">
<!-- Linear Icons CSS -->
<link rel="stylesheet" href="assets/css/vendor/linearicons.min.css">
<!-- Swiper CSS -->
<link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
<!-- Animation CSS -->
<link rel="stylesheet" href="assets/css/plugins/animate.min.css">
<!-- Jquery ui CSS -->
<link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="assets/css/plugins/nice-select.min.css">
<!-- Magnific Popup -->
<link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">

<link rel="stylesheet" href="assets/css/login.css">
<!-- Main Style CSS -->
<link rel="stylesheet" href="assets/css/style.css">

<link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.qhDXWpKopYk.L.W.O/am=wA/d=0/rs=AN8SPfq5gedF4FIOWZgYyMCNZA5tU966ig/m=el_main_css">
</head>

<body style="overflow: visible;">
<!-- Header Area Start Here -->
<?php 
        require "Layout-Chung/headerAdmin.php";
    ?>
    <!-- Header Area End Here -->
    <!-- Breadcrumb Area Start Here -->
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
        <form action="validate.php" method="post">
            <div class="login-box">
                <h1 style="color: palevioletred;">LOGIN</h1>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" placeholder="Tài khoản"
                            name="username" value="">
                </div>

                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Mật khẩu"
                            name="password" value="">
                </div>

                <input class="button" type="submit"
                        name="login" value="Đăng nhập">
            </div>
	    </form>
                </div>
            </div>
        </div>
    

</body>

</html>
