<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FloSun - Mẫu HTML5 của cửa hàng hoa</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
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

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.qhDXWpKopYk.L.W.O/am=wA/d=0/rs=AN8SPfq5gedF4FIOWZgYyMCNZA5tU966ig/m=el_main_css"></head>
    <?php 
        include("KetNoi.php");
        session_start(); 
    ?>
    <?php
        
        /* Hàm tính tổng */
        function calculate_total($cart_items) {
            $total = 0;
            foreach ($cart_items as $cart_item) {
                $total += $cart_item['tong_tien'];
            }
            return $total;
        }

        /* Đặt hàng vào cơ sở dữ liệu */
        $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
        $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $dienthoai = isset($_POST['dienthoai']) ? $_POST['dienthoai'] : '';
        $ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
        $err = "";
        $errEmail = "";
        $errSDT ="";
        if(isset($_POST['btnDatHang'])) {
            if($hoten == '' || $diachi == '' || $email == '' || $dienthoai == '') {
                $err = 'Vui lòng nhập đầy đủ thông tin';
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errEmail = 'Địa chỉ email không hợp lệ';
                } elseif (!preg_match('/^\d{11}$/', $dienthoai)) {
                    $errSDT = 'Số điện thoại phải có 11 chữ số';
                } else {

                    // Truy vấn INSERT vào bảng khách hàng với thông tin họ tên, địa chỉ, số điện thoại, email
                    $sql_insert_khach_hang = "INSERT INTO khach_hang (Ten_KH, Dia_Chi, Dien_Thoai, Email) 
                                              VALUES ('$hoten', '$diachi', '$dienthoai', '$email')";
                    $con->query($sql_insert_khach_hang);
                    $ngayHienTai = new DateTime();
                    $NgayHT = $ngayHienTai->format("Y-m-d");
                    $ma_khach_hang = $con->lastInsertId();
                    $tong_tien = calculate_total($_SESSION['cart_items']);
                    
                    // Truy vấn INSERT vào bảng hóa đơn với thông tin Mã Khách Hàng và Tổng Tiền
                    $sql_insert_hoa_don = "INSERT INTO hoa_don (Ma_KH,ngay_dat,tong_tien, ghi_chu) 
                                           VALUES ('$ma_khach_hang','$NgayHT', '$tong_tien','$ghichu')";
                    
                    // Thêm hóa đơn vào cơ sở dữ liệu và lấy mã hóa đơn vừa thêm           
                    $con->query($sql_insert_hoa_don);
                    $ma_hoa_don = $con->lastInsertId();
                    $kt = 0;

                    // Truy vấn INSERT vào bảng chi tiết hóa đơn với thông tin Mã Hóa Đơn, Mã Sản Phẩm, Số Lượng, Đơn Giá
                    foreach ($_SESSION['cart_items'] as $cart_item) {
                        $ma_san_pham = $cart_item['Ma_Hoa'];
                        $so_luong_san_pham = $cart_item['So_Luong'];
                        $don_gia_san_pham = $cart_item['Don_Gia'];
                        
                        // Thêm chi tiết hóa đơn vào cơ sở dữ liệu
                        $sql_insert_chi_tiet_hoa_don = "INSERT INTO chi_tiet_hoa_don (Ma_HD, Ma_Hoa, so_luong, don_gia) 
                                                        VALUES ('$ma_hoa_don', '$ma_san_pham', '$so_luong_san_pham', '$don_gia_san_pham')";
                        $con->query($sql_insert_chi_tiet_hoa_don);
                        $kt++;
                    }
                    if ($kt>0) {
                        header("Location: DatThanhCong.php");                               
                        exit();
                    } else {
                        header("Location: DatThatBai.php");                               
                        exit();
                    }
                }
            }
        }
        
    ?>
    <!-- Header Area Start Here -->
    <?php 
        require "Layout-Chung/header.php";
    ?>
    <!-- Header Area End Here -->
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thủ tục thanh toán</font></font></h3>
                        <ul>
                            <li><a href="index.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ</font></font></a></li>
                            <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thủ tục thanh toán</font></font></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Checkout Area Start Here -->
    <div class="checkout-area mt-no-text">
        <div class="container custom-container">  
            <form action="checkout.php" method="post">
                <div class="row">
                    <div class="col-lg-6 col-12 col-custom">     
                            <div class="checkbox-form">
                                <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chi tiết thanh toán</font></font></h3>
                                <div class="row">                              
                                    <div class="col-md-12 col-custom">
                                        <div class="checkout-form-list">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Họ và tên</font></font></label>
                                            <input placeholder="" type="text" name="hoten" value="<?php echo $hoten ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-custom">
                                        <div class="checkout-form-list">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Địa chỉ </font></font><span class="required"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*</font></font></span></label>
                                            <input placeholder="Địa chỉ đường phố" type="text" name="diachi"  value="<?php echo $diachi ?>">
                                        </div>
                                    </div>                            
                                    <div class="col-md-6 col-custom">
                                        <div class="checkout-form-list">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Địa chỉ email </font></font><span class="required"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*</font></font></span></label>
                                            <input placeholder="" type="email" name="email"  value="<?php echo $email ?>">
                                            <div class="text-danger mt-3 ">
                                            <?php echo $errEmail ?>                                   
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-custom">
                                        <div class="checkout-form-list">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điện thoại </font></font><span class="required"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*</font></font></span></label>
                                            <br>
                                            <input type="number" class="input input-group p-2" name="dienthoai"  value="<?php echo $dienthoai ?>">
                                            <div class="text-danger mt-3 ">
                                            <?php echo $errSDT ?>                                   
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-custom">
                                        <div class="checkout-form-list create-acc">
                                            <input id="cbox" type="checkbox">
                                            <label for="cbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tạo một tài khoản?</font></font></label>
                                        </div>
                                        <div id="cbox-info" class="checkout-form-list create-account">
                                            <p class="mb-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tạo một tài khoản bằng cách nhập thông tin dưới đây. </font><font style="vertical-align: inherit;">Nếu bạn là khách hàng cũ, vui lòng đăng nhập ở đầu trang.</font></font></p>
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mật khẩu tài khoản </font></font><span class="required"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*</font></font></span></label>
                                            <input placeholder="mật khẩu" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="different-address">                              
                                    <div class="order-notes mt-3">
                                        <div class="checkout-form-list checkout-form-list-2">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ghi chú đặt hàng</font></font></label>
                                            <textarea  name="ghichu" id="checkout-mess" cols="30" rows="10" placeholder="Ghi chú về đơn hàng của bạn, ví dụ như ghi chú đặc biệt khi giao hàng."><?php echo $ghichu ?></textarea>
                                        </div>
                                        <div class="text-danger mt-3 ">
                                            <?php echo $err ?>                                   
                                        </div>
                                    </div>
                                </div>
                            </div>            
                    </div>
                    <div class="col-lg-6 col-12 col-custom">
                        <div class="your-order">
                            <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đơn hàng của bạn</font></font></h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sản phẩm</font></font></th>
                                            <th class="cart-product-total"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tổng cộng</font></font></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Loop through each item in the cart to display its details
                                    foreach ($_SESSION['cart_items'] as $cart_item) {
                                    ?>
                                        <tr class="cart_item">
                                            <td class="cart-product-name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $cart_item['Ten_Hoa']; ?></font></font><strong class="product-quantity"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                        × <?php echo $cart_item['So_Luong']; ?></font></font></strong></td>
                                            <td class="cart-product-total text-center"><span class="amount"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $cart_item['tong_tien']; ?></font></font></span></td>
                                        </tr>              
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>                  
                                        <tr class="order-total">
                                            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tổng số đơn hàng</font></font></th>
                                            <td class="text-center"><strong><span class="amount"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo calculate_total($_SESSION['cart_items']); ?></font></font></span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title mb-3">
                                                    <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        Chuyển khoản trực tiếp.
                                                    </font></font></a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body mb-2 mt-2">
                                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thực hiện thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. </font><font style="vertical-align: inherit;">Vui lòng sử dụng ID đơn hàng của bạn làm tài liệu tham khảo thanh toán. </font><font style="vertical-align: inherit;">Đơn đặt hàng của bạn sẽ không được chuyển cho đến khi tiền đã được xóa trong tài khoản của chúng tôi.</font></font></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-2">
                                                <h5 class="panel-title mb-3">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        Thanh toán séc
                                                    </font></font></a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body mb-2 mt-2">
                                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thực hiện thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. </font><font style="vertical-align: inherit;">Vui lòng sử dụng ID đơn hàng của bạn làm tài liệu tham khảo thanh toán. </font><font style="vertical-align: inherit;">Đơn đặt hàng của bạn sẽ không được chuyển cho đến khi tiền đã được xóa trong tài khoản của chúng tôi.</font></font></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-3">
                                                <h5 class="panel-title mb-3">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        PayPal
                                                    </font></font></a>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body mb-2 mt-2">
                                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thực hiện thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. </font><font style="vertical-align: inherit;">Vui lòng sử dụng ID đơn hàng của bạn làm tài liệu tham khảo thanh toán. </font><font style="vertical-align: inherit;">Đơn đặt hàng của bạn sẽ không được chuyển cho đến khi tiền đã được xóa trong tài khoản của chúng tôi.</font></font></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <button type="submit" name="btnDatHang" class="btn flosun-button secondary-btn black-color rounded-0 w-100"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đặt hàng</font></font></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Area End Here -->
    <!--Footer Area Start-->
    <?php 
        require "Layout-Chung/footer.php";
    ?>
    <!--Footer Area End-->

    <!-- JS
============================================ -->


    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- jQuery Migrate JS -->
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>


    <!-- Swiper Slider JS -->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <!-- nice select JS -->
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <!-- Ajaxchimpt js -->
    <script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Ui js -->
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <!-- Jquery Countdown js -->
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <!-- jquery magnific popup js -->
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script><div id="goog-gt-tt" class="VIpgJd-yAWNEb-L7lbkb skiptranslate" style="border-radius: 12px; margin: 0 0 0 -23px; padding: 0; font-family: 'Google Sans', Arial, sans-serif;" data-id=""><div id="goog-gt-vt" class="VIpgJd-yAWNEb-hvhgNd"><div class=" VIpgJd-yAWNEb-hvhgNd-l4eHX-i3jM8c"><img src="https://fonts.gstatic.com/s/i/productlogos/translate/v14/24px.svg" width="24" height="24" alt=""></div><div class=" VIpgJd-yAWNEb-hvhgNd-k77Iif-i3jM8c"><div class="VIpgJd-yAWNEb-hvhgNd-IuizWc" dir="ltr">Văn bản gốc</div><div id="goog-gt-original-text" class="VIpgJd-yAWNEb-nVMfcd-fmcmS VIpgJd-yAWNEb-hvhgNd-axAV1"></div></div><div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid ltr"><div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid-B7I4Od ltr" dir="ltr"><div class="VIpgJd-yAWNEb-hvhgNd-UTujCb">Đánh giá bản dịch này</div><div class="VIpgJd-yAWNEb-hvhgNd-eO9mKe">Ý kiến phản hồi của bạn sẽ được dùng để góp phần cải thiện Google Dịch</div></div><div class="VIpgJd-yAWNEb-hvhgNd-xgov5 ltr"><button id="goog-gt-thumbUpButton" type="button" class="VIpgJd-yAWNEb-hvhgNd-bgm6sf" title="Bản dịch tốt" aria-label="Bản dịch tốt" aria-pressed="false"><span id="goog-gt-thumbUpIcon"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"><path d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7H2v13h16c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM7 18H4V9h3v9zm14-7l-3 7H9V8l4.34-4.34L12 9h9v2z"></path></svg></span><span id="goog-gt-thumbUpIconFilled"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"><path d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7v13h11c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM5 7H1v13h4V7z"></path></svg></span></button><button id="goog-gt-thumbDownButton" type="button" class="VIpgJd-yAWNEb-hvhgNd-bgm6sf" title="Bản dịch kém" aria-label="Bản dịch kém" aria-pressed="false"><span id="goog-gt-thumbDownIcon"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"><path d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7h5V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zM17 6h3v9h-3V6zM3 13l3-7h9v10l-4.34 4.34L12 15H3v-2z"></path></svg></span><span id="goog-gt-thumbDownIconFilled"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"><path d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zm16 0h4V4h-4v13z"></path></svg></span></button></div></div><div id="goog-gt-votingHiddenPane" class="VIpgJd-yAWNEb-hvhgNd-aXYTce"><form id="goog-gt-votingForm" action="//translate.googleapis.com/translate_voting?client=te_lib" method="post" target="votingFrame" class="VIpgJd-yAWNEb-hvhgNd-aXYTce"><input type="text" name="sl" id="goog-gt-votingInputSrcLang"><input type="text" name="tl" id="goog-gt-votingInputTrgLang"><input type="text" name="query" id="goog-gt-votingInputSrcText"><input type="text" name="gtrans" id="goog-gt-votingInputTrgText"><input type="text" name="vote" id="goog-gt-votingInputVote"></form><iframe name="votingFrame" frameborder="0"></iframe></div></div></div>






</body>