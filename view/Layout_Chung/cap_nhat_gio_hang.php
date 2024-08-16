<?php
session_start();

if(isset($_POST['update_cart'])) {
    // Kiểm tra xem giỏ hàng có tồn tại không và không trống
    if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items'])) {
        // Lặp qua từng mục trong giỏ hàng và cập nhật số lượng
        foreach($_SESSION['cart_items'] as $cartKey => $cartItem) {
            if(isset($_POST['So_Luong'][$cartItem['Ma_Hoa']])) {
                $new_quantity = intval($_POST['So_Luong'][$cartItem['Ma_Hoa']]);
                if($new_quantity > 0) {
                    $_SESSION['cart_items'][$cartKey]['So_Luong'] = $new_quantity;
                    // Cập nhật tổng tiền cho mỗi mặt hàng
                    $_SESSION['cart_items'][$cartKey]['tong_tien'] = $new_quantity * $cartItem['Don_Gia'];
                } else {
                    // Nếu số lượng mới không hợp lệ (<= 0), xóa mục khỏi giỏ hàng
                    unset($_SESSION['cart_items'][$cartKey]);
                }
            }
        }
    }
}

// Chuyển hướng người dùng trở lại trang giỏ hàng sau khi cập nhật
header("Location: cart.php");
exit();
?>
