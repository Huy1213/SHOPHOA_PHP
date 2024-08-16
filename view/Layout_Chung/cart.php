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

    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.qhDXWpKopYk.L.W.O/am=wA/d=0/rs=AN8SPfq5gedF4FIOWZgYyMCNZA5tU966ig/m=el_main_css">
</head>

<body style="overflow: visible;">

    <?php
    include("KetNoi.php");
    ?>
    <?php
    session_start();
    // Start the session if it's not already started

    // Check if 'ma_mon' is set in POST
    if (isset($_POST['Ma_Hoa'])) {
        $MaMon = $_POST['Ma_Hoa'];
        $sql1 = "SELECT * FROM san_pham WHERE Ma_Hoa = $MaMon";
        $sp = $con->query($sql1);

        if (isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == 'add to cart') {
            $maMon = intval($_POST['Ma_Hoa']);
            $soLuong = intval($_POST['sl']);
            $tongtien = 0;

            // Kiểm tra xem giỏ hàng có tồn tại không và không trống
            if (isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items'])) {
                // Tạo một mảng để lưu trữ các mã sản phẩm đã có trong giỏ hàng
                $productIDs = array();
                foreach ($_SESSION['cart_items'] as $cartKey => $cartItem) {
                    // Thêm mã sản phẩm vào mảng $productIDs
                    $productIDs[] = $cartItem['Ma_Hoa'];
                    // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng và tổng tiền
                    if ($cartItem['Ma_Hoa'] == $maMon) {
                        $_SESSION['cart_items'][$cartKey]['So_Luong'] += $soLuong;
                        $_SESSION['cart_items'][$cartKey]['tong_tien'] = $_SESSION['cart_items'][$cartKey]['So_Luong'] * $_SESSION['cart_items'][$cartKey]['Don_Gia'];
                        break;
                    }
                }
                // Nếu sản phẩm không tồn tại trong giỏ hàng, thêm mới vào giỏ hàng
                if (!in_array($maMon, $productIDs)) {
                    $sql1 = "SELECT * FROM san_pham WHERE Ma_Hoa = $maMon";
                    $sp = $con->query($sql1);

                    foreach ($sp as $m) {
                        $tongtien = (int)$soLuong * (float)$m['Don_Gia'];
                        $cartArray = array(
                            'Ma_Hoa' => $maMon,
                            'So_Luong' => $soLuong,
                            'Ten_Hoa' => $m['Ten_Hoa'],
                            'Don_Gia' => $m['Don_Gia'],
                            'tong_tien' => $tongtien,
                            'Hinh_anh' => $m['Hinh_anh']
                        );
                    }
                    $_SESSION['cart_items'][] = $cartArray;
                }
            } else {
                // Nếu giỏ hàng trống, thêm sản phẩm vào giỏ hàng
                $sql1 = "SELECT * FROM san_pham WHERE Ma_Hoa = $maMon";
                $sp = $con->query($sql1);

                foreach ($sp as $m) {
                    $tongtien = (int)$soLuong * (float)$m['Don_Gia'];
                    $cartArray = array(
                        'Ma_Hoa' => $maMon,
                        'So_Luong' => $soLuong,
                        'Ten_Hoa' => $m['Ten_Hoa'],
                        'Don_Gia' => $m['Don_Gia'],
                        'tong_tien' => $tongtien,
                        'Hinh_anh' => $m['Hinh_anh']
                    );
                }
                $_SESSION['cart_items'][] = $cartArray;
            }
        }
    }

    // Function to calculate total amount of all items in the cart
    function calculate_total($cart_items)
    {
        $total = 0;
        foreach ($cart_items as $cart_item) {
            $total += $cart_item['So_Luong'] * $cart_item['Don_Gia'];
        }
        return $total;
    }

    function TongSL($cart_items)
    {
        $total = 0;
        foreach ($cart_items as $cart_item) {
            $total += $cart_item['So_Luong'];
        }
        return $total;
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
                        <h3 class="title-3">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Giỏ hàng</font>
                            </font>
                        </h3>
                        <ul>
                            <li><a href="index.php">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Trang chủ</font>
                                    </font>
                                </a></li>
                            <li>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Giỏ hàng</font>
                                </font>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper mt-no-text">
        <div class="container custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <div class="row">
                            <div class="col-11">
                                <form action="cap_nhat_gio_hang.php" method="post">
                                    <table class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th class="pro-thumbnail">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Hình ảnh</font>
                                                    </font>
                                                </th>
                                                <th class="pro-title">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Sản phẩm</font>
                                                    </font>
                                                </th>
                                                <th class="pro-price">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Giá</font>
                                                    </font>
                                                </th>
                                                <th class="pro-quantity">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Số lượng</font>
                                                    </font>
                                                </th>
                                                <th class="pro-subtotal">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Tổng cộng</font>
                                                    </font>
                                                </th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Check if cart items exist in the session
                                            if (isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items'])) {
                                                // Loop through each item in the cart and display its details
                                                foreach ($_SESSION['cart_items'] as $cart_item) {
                                            ?>
                                                    <tr>
                                                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="assets/images/product/small-size/<?php echo $cart_item['Hinh_anh']; ?>" alt="Sản phẩm"></a></td>
                                                        <td class="pro-title"><a href="#">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;"><?php echo $cart_item['Ten_Hoa']; ?></font>
                                                                </font>
                                                            </a></td>
                                                        <td class="pro-price"><span>
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;"><?php echo $cart_item['Don_Gia']; ?>$</font>
                                                                </font>
                                                            </span></td>

                                                        <td class="pro-quantity">
                                                            <div class="quantity">
                                                                <div class="cart-plus-minus">
                                                                    <input class="cart-plus-minus-box" name="So_Luong[<?php echo $cart_item['Ma_Hoa']; ?>]" value="<?php echo $cart_item['So_Luong']; ?>" type="number">
                                                                    <div class="dec qtybutton">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">-</font>
                                                                        </font>
                                                                    </div>
                                                                    <div class="inc qtybutton">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">+</font>
                                                                        </font>
                                                                    </div>
                                                                    <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                                    <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                                    <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                                    <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="pro-subtotal"><span>
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;"><?php echo $cart_item['So_Luong'] * $cart_item['Don_Gia']; ?></font>
                                                                </font>
                                                            </span></td>
                                                            <input type="hidden" name="Ma_Hoa" value="<?php echo $cart_item['Ma_Hoa']; ?>">
                                                        
                                                            <form action="xoa_san_pham.php" method="post">
                                                               
                                                            </form>
                                                       
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td class="pro-remove" colspan="4">
                                                        <form action="xoa_tat_ca.php" method="post">
                                                            <button type="submit">Xóa tất cả</button>
                                                        </form>

                                                    </td>
                                                    
                                                    <td><?php echo calculate_total($_SESSION['cart_items']); ?></td>
                                                    
                                                </tr>
                                            <?php
                                            } else {
                                                // If cart is empty, display a message
                                            ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">Giỏ hàng của bạn đang trống</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>

                                    </table>
                                    <div class="cart-update mt-sm-16">
                                        <button type="submit" name="update_cart" class="btn flosun-button primary-btn rounded-0 black-btn">Cập nhật giỏ hàng</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-1">
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Xóa</font>
                                                </font>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Check if cart items exist in the session
                                        if (isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items'])) {
                                            // Loop through each item in the cart and display its details
                                            foreach ($_SESSION['cart_items'] as $cart_item) {
                                        ?>
                                                <tr>

                                                    <td class="pro-remove">
                                                        <form action="xoa_san_pham.php" method="post">
                                                            <input type="hidden" name="Ma_Hoa" value="<?php echo $cart_item['Ma_Hoa']; ?>">
                                                            <button type="submit" class="p-5"><i class="lnr lnr-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>

                                            <?php
                                        } else {
                                            // If cart is empty, display a message
                                            ?>

                                            <?php
                                        }
                                            ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 ml-auto col-custom">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Tổng số giỏ hàng</font>
                                </font>
                            </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>                               
                                        <tr class="total">
                                            <td>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Tổng cộng</font>
                                                </font>
                                            </td>
                                            <td class="total-amount">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;"><?php echo calculate_total($_SESSION['cart_items']); ?></font>
                                                </font>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form action="checkout.php" method="POST">
                            <!-- Các trường dữ liệu cần thiết -->
                            <button type="submit" class="btn flosun-button primary-btn rounded-0 black-btn w-100"> 
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Tiến hành kiểm tra</font>
                                </font>
                            </button>
                        </form>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
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
    <script src="assets/js/main.js"></script>
    <div id="goog-gt-tt" class="VIpgJd-yAWNEb-L7lbkb skiptranslate" style="border-radius: 12px; margin: 0 0 0 -23px; padding: 0; font-family: 'Google Sans', Arial, sans-serif;" data-id="">
        <div id="goog-gt-vt" class="VIpgJd-yAWNEb-hvhgNd">
            <div class=" VIpgJd-yAWNEb-hvhgNd-l4eHX-i3jM8c"><img src="https://fonts.gstatic.com/s/i/productlogos/translate/v14/24px.svg" width="24" height="24" alt=""></div>
            <div class=" VIpgJd-yAWNEb-hvhgNd-k77Iif-i3jM8c">
                <div class="VIpgJd-yAWNEb-hvhgNd-IuizWc" dir="ltr">Văn bản gốc</div>
                <div id="goog-gt-original-text" class="VIpgJd-yAWNEb-nVMfcd-fmcmS VIpgJd-yAWNEb-hvhgNd-axAV1"></div>
            </div>
            <div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid ltr">
                <div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid-B7I4Od ltr" dir="ltr">
                    <div class="VIpgJd-yAWNEb-hvhgNd-UTujCb">Đánh giá bản dịch này</div>
                    <div class="VIpgJd-yAWNEb-hvhgNd-eO9mKe">Ý kiến phản hồi của bạn sẽ được dùng để góp phần cải thiện Google Dịch</div>
                </div>
                <div class="VIpgJd-yAWNEb-hvhgNd-xgov5 ltr"><button id="goog-gt-thumbUpButton" type="button" class="VIpgJd-yAWNEb-hvhgNd-bgm6sf" title="Bản dịch tốt" aria-label="Bản dịch tốt" aria-pressed="false"><span id="goog-gt-thumbUpIcon"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                <path d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7H2v13h16c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM7 18H4V9h3v9zm14-7l-3 7H9V8l4.34-4.34L12 9h9v2z"></path>
                            </svg></span><span id="goog-gt-thumbUpIconFilled"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                <path d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7v13h11c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM5 7H1v13h4V7z"></path>
                            </svg></span></button><button id="goog-gt-thumbDownButton" type="button" class="VIpgJd-yAWNEb-hvhgNd-bgm6sf" title="Bản dịch kém" aria-label="Bản dịch kém" aria-pressed="false"><span id="goog-gt-thumbDownIcon"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                <path d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7h5V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zM17 6h3v9h-3V6zM3 13l3-7h9v10l-4.34 4.34L12 15H3v-2z"></path>
                            </svg></span><span id="goog-gt-thumbDownIconFilled"><svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                <path d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zm16 0h4V4h-4v13z"></path>
                            </svg></span></button></div>
            </div>
            <div id="goog-gt-votingHiddenPane" class="VIpgJd-yAWNEb-hvhgNd-aXYTce">
                <form id="goog-gt-votingForm" action="//translate.googleapis.com/translate_voting?client=te_lib" method="post" target="votingFrame" class="VIpgJd-yAWNEb-hvhgNd-aXYTce"><input type="text" name="sl" id="goog-gt-votingInputSrcLang"><input type="text" name="tl" id="goog-gt-votingInputTrgLang"><input type="text" name="query" id="goog-gt-votingInputSrcText"><input type="text" name="gtrans" id="goog-gt-votingInputTrgText"><input type="text" name="vote" id="goog-gt-votingInputVote"></form><iframe name="votingFrame" frameborder="0"></iframe>
            </div>
        </div>
    </div>


</body>