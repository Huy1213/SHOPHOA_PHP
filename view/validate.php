<?php
    include_once('KetNoi.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Chuẩn bị truy vấn SQL để lấy thông tin người dùng từ cơ sở dữ liệu
        $stmt = $con->prepare("SELECT * FROM adminlogin WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem có người dùng nào khớp thông tin được nhập không
        if ($user) {
            // Đăng nhập thành công, chuyển hướng đến trang adminpage.php
            header("Location: index.php");
            exit; // Dừng script ngay sau khi chuyển hướng
        } else {
            // Thông tin đăng nhập không đúng, hiển thị thông báo lỗi
            echo "<script language='javascript'>";
            echo "alert('WRONG INFORMATION')";
            echo "</script>";
        }
    }
?>
