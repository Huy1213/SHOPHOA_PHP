<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    $mail = new PHPMailer(true);

try {
    if(isset($_POST['btnGui'])) {
        // Xử lý gửi email
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $mail->isSMTP();                                            // Gửi bằng SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Máy chủ SMTP
        $mail->SMTPAuth   = true;                                   // Kích hoạt xác thực SMTP
        $mail->Username   = 'thanhhuy9b@gmail.com';                 // Tên đăng nhập SMTP
        $mail->Password   = 'jfmukdhbnpnhxojr';                     // Mật khẩu SMTP hoặc Mật khẩu ứng dụng
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Kích hoạt mã hóa TLS
        $mail->Port       = 587;                                    // Cổng TCP để kết nối
        
        // Người nhận
        $mail->setFrom('thanhhuy9b@gmail.com', 'Shop Hoa');
        $mail->addAddress('thanhhuy2329@gmail.com', 'Huy');              // Thêm một người nhận

        // Nội dung
        $mail->isHTML(true);                                        // Thiết lập định dạng email là HTML
        $mail->Subject = 'Shop Hoa'; //
        $mail->Body    = "Đóng góp về shop từ: $name <br>Email: $email <br> Nội dung: <b>$message</b>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            echo 'Email đã được gửi thành công!';
        } else {
            echo 'Đã có lỗi xảy ra khi gửi email: ' . $mail->ErrorInfo;
        }
    }
    else {
        $err = '';
    }
} catch (Exception $e) {
    echo "Không thể gửi. Mailer Error: {$mail->ErrorInfo}";
}

?>