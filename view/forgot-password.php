<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php


if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'view/config.php';
$msg = "";

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}'");

            if ($query) {
                echo "<div style='display: none;'>";
                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'thanhhuy9b@gmail.com';                     //SMTP username
                $mail->Password   = 'tzyonpbleuufslxc';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('thanhhuy9b@gmail.com');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'no reply';
                $mail->Body    = 'Vui lòng nhấp vào đường dẫn sau để đổi mật khẩu <b><a href="http://localhost/QL_SHOPHOA/index.php?page=doimatkhau&reset='.$code.' ">http://localhost/QL_SHOPHOA/index.php?page=doimatkhau&reset='.$code.' </a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info text-center'>Vui lòng kiểm tra hộp thư email của bạn.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'> Không tìm thấy địa chỉ:  $email.</div>";
    }
}
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Quên mật khẩu</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="view/assets/css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

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
    <div class="login-register-area mt-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title-4 mb-2">QUÊN MẬT KHẨU</h2>
                            <p class="desc-content">Vui lòng nhập email bạn đã đăng ký.</p>
                        </div>
                        <?php echo $msg; ?>
                    <form action="index.php?page=quenmatkhau" method="post">
                            <div class="container">
                                <div class="row">
                                            <div class="single-input-item mb-2">
                                                <input type="email" id="email" placeholder="Email" name="email" required>
                                            </div>
                                </div>
                                <div class="row">
                                    <div class="single-input-item mb-1">
                                        <input class="btn flosun-button secondary-btn theme-color rounded-0" type="submit" value="Gửi" name="submit">
                                        <div><p>Chưa có tài khoản? <a class="fw-bold" href="index.php?page=dangky">Đăng ký tại đây</a></p></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</div>

    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>