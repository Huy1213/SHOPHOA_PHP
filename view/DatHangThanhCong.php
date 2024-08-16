<div class="login-register-area mt-no-text">
    <div class="container container-default-2 custom-area">
        <div class="login-register-wrapper">
            <?php
            if (isset($_GET['orderId']) && isset($_GET['resultCode']) && $_GET['resultCode'] == '0') {
                // Thanh toán thành công
                $orderId = $_GET['orderId'];
                $amount = $_GET['amount'];
                $orderInfo = $_GET['orderInfo'];
                $ngaydat = date("Y-m-d");
               

                // Kiểm tra xem thông tin người dùng có trong session không
                if (isset($_COOKIE['id'])) {
                    $userId = $_COOKIE['id'];
                    $ghichu = 'Ghi chú đơn hàng';
                    $diachi = "Địa chỉ lấy từ người dùng";

                    // Chèn hóa đơn vào cơ sở dữ liệu
                    $lastID = InsertHoaDon($userId, $diachi, $ngaydat, $ghichu, $amount,'thanh toán momo');

                    if ($lastID) {
                        // Chèn chi tiết hóa đơn
                        foreach ($_SESSION['giohang'] as $item) {
                            InserCTHoaDon($lastID, $item[0], $item[3], $item[4]);
                        }
                        // Xóa giỏ hàng sau khi đặt hàng thành công
                        unset($_SESSION['giohang']);

                        echo '<h2 class="fw-bold text-center text-uppercase">Đặt thành công</h2>';
                        echo '<p class="text-center h2">Bấm <a class="text-primary h2" href="index.php?page=sanpham">vào đây</a> để tiếp tục mua hàng</p>';
                    } else {
                        echo "Có lỗi xảy ra khi chèn hóa đơn!";
                    }
                } 
                else if (isset($_SESSION['role'])) {
                    $userId = $_SESSION['iduser'];
                    $diachi = "Địa chỉ lấy từ người dùng"; // Cập nhật địa chỉ của người dùng tại đây
                    $ghichu = "Ghi chú đơn hàng"; // Bạn có thể thay đổi hoặc lấy từ session nếu cần

                    // Chèn hóa đơn vào cơ sở dữ liệu
                    $lastID = InsertHoaDon($userId, $diachi, $ngaydat, $ghichu, $amount,'thanh toán momo');

                    if ($lastID) {
                        // Chèn chi tiết hóa đơn
                        foreach ($_SESSION['giohang'] as $item) {
                            InserCTHoaDon($lastID, $item[0], $item[3], $item[4]);
                        }
                        // Xóa giỏ hàng sau khi đặt hàng thành công
                        unset($_SESSION['giohang']);

                        echo '<h2 class="fw-bold text-center text-uppercase">Đặt thành công</h2>';
                        echo '<p class="text-center h2">Bấm <a class="text-primary h2" href="index.php?page=sanpham">vào đây</a> để tiếp tục mua hàng</p>';
                    } else {
                        echo "Có lỗi xảy ra khi chèn hóa đơn!";
                    }
                } 
                else {
                    echo "Không tìm thấy thông tin người dùng!";
                }
            }
            else if (isset($_GET['orderId']) && isset($_GET['resultCode']) && $_GET['resultCode'] != '0') {
                echo '<h2 class="fw-bold text-center text-uppercase">Thanh toán thất bại</h2>';
                echo '<p class="text-center h2">Bấm <a class="text-primary h2" href="index.php?page=sanpham">vào đây</a> để tiếp tục mua hàng</p>';
            }
                   
            
            else {
                echo '<h2 class="fw-bold text-center text-uppercase">Đặt thành công</h2>';
                echo '<p class="text-center h2">Bấm <a class="text-primary h2" href="index.php?page=sanpham">vào đây</a> để tiếp tục mua hàng</p>';         
            }
            ?>
        </div>
    </div>
</div>
