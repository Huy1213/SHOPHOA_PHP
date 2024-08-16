<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FloSun</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="view/assets/images/favicon.ico">

    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="view/assets/css/vendor/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="view/assets/css/vendor/font.awesome.min.css">
    <!-- Linear Icons CSS -->
    <link rel="stylesheet" href="view/assets/css/vendor/linearicons.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="view/assets/css/plugins/swiper-bundle.min.css">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="view/assets/css/plugins/animate.min.css">
    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="view/assets/css/plugins/jquery-ui.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="view/assets/css/plugins/nice-select.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="view/assets/css/plugins/magnific-popup.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="view/assets/css/style.css">
    

<link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.qhDXWpKopYk.L.W.O/am=wA/d=0/rs=AN8SPfq5gedF4FIOWZgYyMCNZA5tU966ig/m=el_main_css">
</head>
<?php
    $soLuongSanPhamTrongGioHang = 0;
    if(isset($_SESSION['giohang'])) {
        foreach($_SESSION['giohang'] as $item) {
            $soLuongSanPhamTrongGioHang ++; // Số lượng sản phẩm là phần tử thứ 4 trong mỗi mảng sản phẩm trong giỏ hàng
        }
    }
?>
<body style="overflow: visible;">
<header class="main-header-area">
    
        <!-- Main Header Area Start -->
        <div class="main-header header-sticky">
            <div class="container custom-area">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-xl-2 col-md-6 col-6 col-custom">
                        <div class="header-logo d-flex align-items-center">
                            <a href="index.php">
                                <img class="img-full" src="view/assets/images/logo/logo.png" alt="Biểu trưng tiêu đề">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-flex justify-content-center col-custom">
                        <nav class="main-nav d-none d-lg-flex">
                            <ul class="nav">
                                <li>
                                    <a href="index.php">
                                        <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ</font></font></span>
                                      
                                    </a>
                                   
                                </li>
                                <li>
                                    <a href="index.php?page=sanpham">
                                        <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sản phẩm</font></font></span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <?php foreach($loai as $l) { ?>
                                        <li><a href="index.php?page=sanpham&id=<?php echo $l['MaLoai']; ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $l['TenLoai'] ?></font></font></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>               
                                <li>
                                        <a href="index.php?page=vechungtoi">
                                            <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Về chúng tôi</font></font></span>
                                        </a>
                                    </li>
                                <?php if(isset($_COOKIE['id']) || isset($_SESSION['role'])){  ?>
                                    <li>
                                        <a href="index.php?page=taikhoancuatoi">
                                            <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            <?php 
                                                if(isset($_COOKIE['id']))                                      
                                                    echo  $_COOKIE['user_email'];
                                                else
                                                    echo $_SESSION['userName']                                             
                                            ?>    
                                        
                                            </font></font>
                            
                                            </span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        
                                        <ul class="dropdown-submenu dropdown-hover">
                                            <li><a href="index.php?page=lienhe"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Liên hệ</font></font></a></li>
                                            <li><a href="index.php?page=taikhoancuatoi"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tài khoản của tôi</font></font></a></li>                                        
                                        </ul>
                                    </li>
                                    <li>
                                        <?php  if(isset($_COOKIE['id'])) {  ?>   
                                        <a href="view/login/logout.php">
                                            <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng xuất</font></font></span>
                                        </a>
                                        <?php } if(isset($_SESSION['role'])) {?>
                                        <a href="index.php?page=logout">
                                            <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng xuất</font></font></span>
                                        </a>
                                        <?php }?>
                                    </li>
                                <?php } else {?>
                                <li>
                                    <a href="index.php?page=login">
                                        <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng nhập</font></font></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="index.php?page=dangky">
                                        <span class="menu-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng ký</font></font></span>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6 col-custom">
                        <div class="header-right-area main-nav">
                            <ul class="nav">
                                <li class="minicart-wrap">
                                    <a href="index.php?page=giohang" class="minicart-btn toolbar-btn">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="cart-item_count"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                        <?php echo $soLuongSanPhamTrongGioHang; ?>
                                            </font></font></span>
                                    </a>
                                   
                                </li>
                                <li class="sidemenu-wrap">
                                    <a href="#"><i class="fa fa-search"></i> </a>
                                    <ul class="dropdown-sidemenu dropdown-hover-2 dropdown-search">
                                        <li>
                                            <form action="index.php?sanpham&page=sanpham" method="get">
                                                <input name="keyword" id="search" placeholder="Tìm kiếm" type="text">
                                                <button type="submit"  name="timkiem"><i class="fa fa-search"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <li class="account-menu-wrap d-none d-lg-flex">
                                    <a href="#" class="off-canvas-menu-btn">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                                <li class="mobile-menu-btn d-lg-none">
                                    <a class="off-canvas-btn" href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Header Area End -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper" id="mobileMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-times"></i>
                </div>
                <div class="off-canvas-inner">
                <div class="search-box-offcanvas">
                    <form action="shop.php" method="get">
                        <input type="text" name="TimKiemHoa" placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit" class="search-btn"><i class="fa fa-search"></i></button> 
                    </form>
                </div>
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><span class="menu-expand"><i></i></span><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ</font></font></a>
                                    <ul class="dropdown" style="display: none;">
                                        <li><a href="index.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ Trang 1</font></font></a></li>
                                        <li><a href="index-2.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ 2</font></font></a></li>
                                        <li><a href="index-3.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ Trang 3</font></font></a></li>
                                        <li><a href="index-4.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ 4</font></font></a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"><i></i></span><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cửa hàng</font></font></a>
                                    <ul class="megamenu dropdown" style="display: none;">
                                        <li class="mega-title has-children"><span class="menu-expand"><i></i></span><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bố cục cửa hàng</font></font></a>
                                            <ul class="dropdown" style="display: none;">
                                                <li><a href="shop.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mua sắm ở thanh bên trái</font></font></a></li>
                                                <li><a href="shop-right-sidebar.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mua sắm ở thanh bên phải</font></font></a></li>
                                                <li><a href="shop-list-left.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Danh sách cửa hàng Thanh bên trái</font></font></a></li>
                                                <li><a href="shop-list-right.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Danh sách cửa hàng Thanh bên phải</font></font></a></li>
                                                <li><a href="shop-fullwidth.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cửa hàng toàn chiều rộng</font></font></a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-title has-children"><span class="menu-expand"><i></i></span><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thông tin chi tiết sản phẩm</font></font></a>
                                            <ul class="dropdown" style="display: none;">
                                                <li><a href="product-details.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chi tiết sản phẩm duy nhất</font></font></a></li>
                                                <li><a href="variable-product-details.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chi tiết sản phẩm thay đổi</font></font></a></li>
                                                <li><a href="external-product-details.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chi tiết sản phẩm bên ngoài</font></font></a></li>
                                                <li><a href="gallery-product-details.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thư viện ảnh Chi tiết sản phẩm</font></font></a></li>
                                                <li><a href="countdown-product-details.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đếm ngược chi tiết sản phẩm</font></font></a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-title has-children"><span class="menu-expand"><i></i></span><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người khác</font></font></a>
                                            <ul class="dropdown" style="display: none;">
                                                <li><a href="error404.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lỗi 404</font></font></a></li>
                                                <li><a href="compare.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">So sánh trang</font></font></a></li>
                                                <li><a href="cart.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang giỏ hàng</font></font></a></li>
                                                <li><a href="checkout.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang thanh toán</font></font></a></li>
                                                <li><a href="wishlist.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang danh sách mong muốn</font></font></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                             
                                <li class="menu-item-has-children "><span class="menu-expand"><i></i></span><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang</font></font></a>
                                    <ul class="dropdown" style="display: none;">
                                        <li><a href="frequently-questions.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Câu hỏi thường gặp</font></font></a></li>
                                        <li><a href="my-account.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tài khoản của tôi</font></font></a></li>
                                        <li><a href="login-register.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">đăng nhập và đăng ký</font></font></a></li>
                                    </ul>
                                </li>
                                <li><a href="about-us.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Về chúng tôi</font></font></a></li>
                                <li><a href="contact-us.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Liên hệ</font></font></a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->
                    <div class="offcanvas-widget-area">
                        <div class="switcher">
                            <div class="language">
                                <span class="switcher-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngôn ngữ:</font></font></span>
                                <div class="switcher-menu">
                                    <ul>
                                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tiếng Anh</font></font></a>
                                            <ul class="switcher-dropdown">
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">tiếng Đức</font></font></a></li>
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">người Pháp</font></font></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="currency">
                                <span class="switcher-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tiền tệ:</font></font></span>
                                <div class="switcher-menu">
                                    <ul>
                                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">$ USD</font></font></a>
                                            <ul class="switcher-dropdown">
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">€ EUR</font></font></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="top-info-wrap text-left text-black">
                            <ul class="address-info">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a href="info%40yourdomain.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(1245) 2456 012</font></font></a>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="info%40yourdomain.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">info@yourdomain.com</font></font></a>
                                </li>
                            </ul>
                            <div class="widget-social">
                                <a class="facebook-color-bg" title="Facebook-f" href="#"><i class="fa fa-facebook-f"></i></a>
                                <a class="twitter-color-bg" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                                <a class="linkedin-color-bg" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                <a class="youtube-color-bg" title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                                <a class="vimeo-color-bg" title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-menu-wrapper" id="sideMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="off-canvas-inner">
                    <div class="btn-close-off-canvas">
                        <i class="fa fa-times"></i>
                    </div>
                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <ul class="menu-top-menu">
                            <li><a href="about-us.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Về chúng tôi</font></font></a></li>
                        </ul>
                        <p class="desc-content"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labe et dolore magna aliqua. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Với một mục tiêu tối thiểu là có thể làm được, điều này sẽ không xảy ra khi bạn phải làm việc quá sức để có được một giải pháp sau mỗi giao dịch. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bạn aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </font><font style="vertical-align: inherit;">Ngoại trừ tội lỗi không thường xuyên xảy ra, đó là lý do tại sao bạn không thể làm điều đó.</font></font></p>
                        <div class="switcher">
                            <div class="language">
                                <span class="switcher-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngôn ngữ:</font></font></span>
                                <div class="switcher-menu">
                                    <ul>
                                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tiếng Anh</font></font></a>
                                            <ul class="switcher-dropdown">
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">tiếng Đức</font></font></a></li>
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">người Pháp</font></font></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="currency">
                                <span class="switcher-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tiền tệ:</font></font></span>
                                <div class="switcher-menu">
                                    <ul>
                                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">$ USD</font></font></a>
                                            <ul class="switcher-dropdown">
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">€ EUR</font></font></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="top-info-wrap text-left text-black">
                            <ul class="address-info">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a href="info%40yourdomain.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(1245) 2456 012</font></font></a>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="info%40yourdomain.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">info@yourdomain.com</font></font></a>
                                </li>
                            </ul>
                            <div class="widget-social">
                                <a class="facebook-color-bg" title="Facebook-f" href="#"><i class="fa fa-facebook-f"></i></a>
                                <a class="twitter-color-bg" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                                <a class="linkedin-color-bg" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                <a class="youtube-color-bg" title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                                <a class="vimeo-color-bg" title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
    </header>