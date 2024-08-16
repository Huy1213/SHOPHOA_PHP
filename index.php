<?php
session_start();
if (!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
ob_start();
include "model/KetNoi.php";
include "model/user.php";
include "model/loai.php";
$loai = getAll_Loai();
include "view/Layout_Chung/header.php";
include "model/sanpham.php";
include "model/SoLuong.php";
include "model/MauSac.php";
include "model/DiaChi.php";
$mausac = get_AllMausac();
include "model/HinhAnh.php";
include "model/HoaDon.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$tong=0;
$errDN = "";
$SP = getAll_SanPham();
if (isset($_GET['page']) && $_GET['page'] != "") {
    switch ($_GET['page']) {
        case 'sanpham':
            if (isset($_POST['keyword'])) {
                $keyword = $_POST['keyword'];
            } else {
                $keyword = "";
            }
            if (!isset($_GET['trang'])) {
                $current_page = 1;
            } else {
                $current_page = (int)$_GET['trang'];
            }
            $soluongsp = 6;
            $sort_option = isset($_GET['sort']) ? $_GET['sort'] : '1'; // Mặc định sắp xếp theo tên
            
            switch ($sort_option) {
                case '1':
                    $kq = sortSanPhamByName($keyword, $current_page, $soluongsp);
                    break;
                case '2':
                    $kq = sortSanPhamByPrice($keyword, $current_page, $soluongsp);
                    break;
                    // Thêm các case khác nếu bạn muốn sắp xếp theo các tiêu chí khác
            }
            $total_rows = countRowsInTable();
            $total_pages = ceil($total_rows / $soluongsp);
            if (isset($_GET['mamau'])) {
                $id = $_GET['mamau'];
                $kq = getSPTheoMau($id);
            }
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $kq = getSPtheoLoai($id);
                include "view/shop.php";
            } else {
                include "view/shop.php";
            }
            break;
        case 'chitietsanpham':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $mausac = get_MauSac($id);
                $sanpham = get_SanPham($id);         
                include "view/product-details.php";
            }
            break;
        case 'addcart':
            if (isset($_POST['addtocart']) && ($_POST['addtocart'])) {
                $id = $_POST['id'];
                $tensp = $_POST['tensp'];
                $img = $_POST['img'];
                $gia = $_POST['gia'];

                if (isset($_POST['soluong']) && $_POST['soluong'] > 0)
                    $soluong = $_POST['soluong'];
                else
                    $soluong = 1;

                $fg = 0;
                $i = 0;
                foreach ($_SESSION['giohang'] as $item) {
                    if ($item[1] == $tensp) {
                        $slnew = $soluong + $item[3];
                        $_SESSION['giohang'][$i][3] = $slnew;
                        $fg = 1;
                        break;
                    }
                    $i++;
                }

                if ($fg == 0) {
                    $item = array($id, $tensp, $img, $soluong, $gia);
                    $_SESSION['giohang'][] = $item;
                }
                header('location: index.php?page=viewcart');
            }
            //include "view/cart.php";
            break;
        case 'updatecart':     
                if (isset($_POST['soluong'])) {
                    $soluong = $_POST['soluong'];
                    foreach ($_SESSION['giohang'] as $key => $item) {
                        if (isset($soluong[$key]) && $soluong[$key] > 0) {
                            $_SESSION['giohang'][$key][3] = $soluong[$key];
                        }
                    }
                    header('location: index.php?page=viewcart');
                }
                break;
            
            
        case 'delcart': {
                    if (isset($_GET['i']) && $_GET['i'] >= 0 && $_GET['i'] < count($_SESSION['giohang'])) {
                        array_splice($_SESSION['giohang'], $_GET['i'], 1);
                    } elseif (isset($_SESSION['giohang'])) {
                        unset($_SESSION['giohang']);
                    }
                
                    // Kiểm tra xem giỏ hàng còn sản phẩm không
                    if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                        header('location: index.php?page=viewcart');
                    } else {
                        header('location: index.php');
                    }
                    break;
                }
        case 'dathang';  
            // Kiểm tra số lượng sản phẩm
            foreach ($_SESSION['giohang'] as $item) {
                $product_info = get_SanPham($item[0]);
                $stock = $product_info[0]['SoLuong'];
                if ($item[3] > $stock) {
                    // Số lượng sản phẩm vượt quá số lượng trong kho
                    header("Location: index.php?page=viewcart");
                    exit();
                }
            }
   
            if(isset($_SESSION['role']) || isset($_COOKIE['id']))
            { 
                if(isset($_COOKIE['id']))
                {
                    $diachi = getDiaChi($_COOKIE['id']);
                }  
                if(isset($_SESSION['role']))
                {
                    $diachi = getDiaChi($_SESSION['iduser']);
                }           
                $errHT ="";
                $errDC ="";
                $errEmail ="";
                $errSDT ="";
                if (isset($_POST['btndathang'])) {
                    if (empty($_SESSION['giohang'])) {
                        // Nếu giỏ hàng trống, quay về trang chính
                        header("Location: index.php");
                        exit(); // Kết thúc script để ngăn mã tiếp tục chạy
                    }
                    $hoten = $_POST['hoten'];           
                    $email = $_POST['email'];
                    $sdt = $_POST['sdt'];
                    $ghichu = $_POST['ghichu'];
                    $ngaydat = date("Y-m-d");
                    if($hoten == "")
                    {
                        $errHT = "Vui lòng cập nhật họ tên <a href='index.php?page=taikhoancuatoi' class='text-primary'>Tại đây</a>";
                    }          
                    else if($email == "")
                    {
                        $errEmail = "Vui lòng cập nhật email <a href='index.php?page=taikhoancuatoi' class='text-primary'>Tại đây</a> ";
                    }
                    else if($sdt == "")
                    {
                        $errSDT = "Vui lòng cập nhật số điện thoại <a href='index.php?page=taikhoancuatoi' class='text-primary'>Tại đây</a>";
                    }
                    else
                    {
                        foreach ($_SESSION['giohang'] as $item) {
                            $tt = $item[3] * $item[4];
                            $tong += $tt;
                        }
                        // Gọi hàm InsertHoaDon() và truyền thông tin vào
                        if (isset($_SESSION['role'])) {
                            if(isset($_POST['diachifull']))
                            {
                                $selectedDC = $_POST['diachifull'];
                                $getoneDC = getOneDiaChi($_SESSION['iduser'],$selectedDC);
                                $diachi = $getoneDC['Duong'] . ", " . $getoneDC['Phuong'] . ", " . $getoneDC['Huyen'] . ", " . $getoneDC['Tinh'];
                                $lastID = InsertHoaDon($_SESSION['iduser'], $diachi, $ngaydat, $ghichu, $tong,'thanh toán tiền mặt');
                            
                                foreach ($_SESSION['giohang'] as $item) 
                                {
                                    InserCTHoaDon($lastID, $item[0], $item[3],$item[4]);
                                } 
                                unset($_SESSION['giohang']);
                                header("Location: index.php?page=DatHangThanhCong");
                                exit();
                            }    
                            else
                            {
                                $errDC = "Địa chỉ không được để trống";
                            }     
                        }
                        if (isset($_COOKIE['id'])) {
                            if(isset($_POST['diachifull']))
                            {
                                $selectedDC = $_POST['diachifull'];
                                $getoneDC = getOneDiaChi($_COOKIE['id'],$selectedDC);
                                $diachi = $getoneDC['Duong'] . ", " . $getoneDC['Phuong'] . ", " . $getoneDC['Huyen'] . ", " . $getoneDC['Tinh'];
                                $lastID = InsertHoaDon($_COOKIE['id'], $diachi, $ngaydat, $ghichu, $tong,'thanh toán tiền mặt');
                                
                                foreach ($_SESSION['giohang'] as $item) 
                                {
                                    InserCTHoaDon($lastID, $item[0], $item[3],$item[4]);
                                }
                                unset($_SESSION['giohang']);
                                header("Location: index.php?page=DatHangThanhCong");
                                exit();
                            }
                            else
                            {
                                $errDC = "Địa chỉ không được để trống";
                            }
                        }
                        // Xóa giỏ hàng sau khi đặt hàng thành công
                    }    
                    
                }
                
                if(isset($_COOKIE['id']))
                    $infor = getInfor($_COOKIE['id']);
                if(isset($_SESSION['role']))
                    $infor = getInfor($_SESSION['iduser']);
                include "view/checkout.php";
            }
            else
            {
                header('Location: index.php');
            }
            
            break;
            case 'quenmatkhau':
                include "view/forgot-password.php";
                break;

            case 'doimatkhau':
                    include "view/change-password.php";
                break;
                
        case 'viewcart':      
            include "view/cart.php";
            break;
        case 'vechungtoi':
            include "view/about-us.php";
            break;
        case 'lienhe':          
            $err ='';
            include "view/contact-us.php";
            break;
        case 'login':
        
            if((isset($_POST['login']) ||isset($_COOKIE['id']) && $_POST['login]']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $kq = getuserinfo($username,$password);
                $KTDN = KTDN($username, $password);
                if($KTDN)
                {
                    $role = $kq[0]['role'];
                    $_SESSION['role'] = $role;
                    $_SESSION['iduser'] = $kq[0]['id'];
                    $_SESSION['userName'] = $kq[0]['userName'];
                    if($role == 1)
                    {
                        $_SESSION['role'] = $role;
                        header('Location: admin/index.php');
                    }
                    else
                    {
                        header('Location: index.php');
                    } 
                    $errDN = ""; 
                }   
                else
                {   
                    $errDN = "Tên đăng nhập hoặc mật khẩu không đúng"; 
                }
            }
            include "view/login.php";
            break;
        case 'logout':
            unset($_SESSION['role']);
            unset($_SESSION['iduser']);
            unset($_SESSION['userName']);
            header('Location:index.php');
            break;
        
            case 'dangky':
                if (!isset($_POST['dangky'])) {
                    include "view/register.php";
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $errors = [];
                
                    // Lấy dữ liệu từ form
                    $f_name = $_POST['f_name'];
                    $l_name = $_POST['l_name'];
                    $diachi = $_POST['diachi'];
                    $tinh = $_POST['hidden_tinh']; // Lấy tên tỉnh từ trường ẩn
                    $quan = $_POST['hidden_quan']; // Lấy tên quận huyện từ trường ẩn
                    $phuong = $_POST['hidden_phuong']; // Lấy giá trị của phường xã
                    $sdt = $_POST['sdt'];
                    $email = $_POST['email'];
                    $userName = $_POST['userName'];
                    $password = $_POST['password'];
                    $confirm_pwd = $_POST['confirm_pwd'];
                
                    // Kết nối cơ sở dữ liệu
                    $conn = ketnoi();
                
                    // Kiểm tra f_name và l_name không được chứa ký tự số
                    if (preg_match('/[0-9]/', $f_name)) {
                        $errors['f_name'] = "Họ không được chứa ký tự số.";
                    }
                    if (preg_match('/[0-9]/', $l_name)) {
                        $errors['l_name'] = "Tên không được chứa ký tự số.";
                    }
                
                    // Kiểm tra sdt chỉ chứa số và có độ dài đúng 10 số
                    if (!preg_match("/^[0-9]{10,11}$/", $sdt)) {
                        $errors['sdt'] = "Số điện thoại phải đúng 10 số";
                    } elseif (!preg_match("/^(03[2-9]|05[6-8]|07[0|6-9]|08[1-9]|09[0-9])[0-9]{7}$/", $sdt) &&
                              !preg_match("/^(09[6-8]|09[0-3]|07[7-9]|07[0-6]|05[8-9]|05[0-3]|03[9]|03[1-4])[0-9]{7}$/", $sdt) &&
                              !preg_match("/^(08[6-9]|08[0-9])[0-9]{7}$/", $sdt) &&
                              !preg_match("/^(01[26-9]|01[0-9])[0-9]{7}$/", $sdt) &&
                              !preg_match("/^(04[3-9]|04[0-9])[0-9]{7}$/", $sdt)) {
                        $errors['sdt'] = "Số điện thoại không hợp lệ.";
                    } 
                
                    // Kiểm tra định dạng email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors['email'] = "Email không hợp lệ.";
                    } else {
                        // Kiểm tra email có trùng lặp không
                        $sql = "SELECT email FROM users WHERE email = :email";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([':email' => $email]);
                        if ($stmt->rowCount() > 0) {
                            $errors['email'] = "Email đã tồn tại.";
                        }
                    }
                
                    // Kiểm tra tên đăng nhập có trùng lặp không
                    $sql = "SELECT userName FROM users WHERE userName = :userName";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([':userName' => $userName]);
                    if ($stmt->rowCount() > 0) {
                        $errors['userName'] = "Tên đăng nhập đã tồn tại.";
                    }
                
                    // Kiểm tra password
                    if (strlen($password) < 8 || !preg_match('/\d/', $password)) {
                        $errors['password'] = "Mật khẩu phải ít nhất 8 ký tự và có ít nhất một số.";
                    }
                
                    // Kiểm tra confirm password
                    if ($password !== $confirm_pwd) {
                        $errors['confirm_pwd'] = "Mật khẩu xác nhận không khớp.";
                    }
                    
                    // Nếu không có lỗi, thực hiện câu lệnh INSERT
                    if (empty($errors)) {
                        try {
                            // Bắt đầu transaction
                            $conn->beginTransaction();
                
                            // Thêm user vào bảng users
                            $sql = "INSERT INTO users (f_name, l_name, sdt, email, userName, password, session, role) 
                                    VALUES (:f_name, :l_name, :sdt, :email, :userName, :password, '', 0)";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([
                                ':f_name' => $f_name,
                                ':l_name' => $l_name,
                                ':sdt' => $sdt,
                                ':email' => $email,
                                ':userName' => $userName,
                                ':password' => $password
                            ]);
                
                            // Lấy user ID vừa insert
                            $user_id = $conn->lastInsertId();
                
                            // Thêm địa chỉ vào bảng diachi
                            $sql = "INSERT INTO diachi (MaKH, Duong, Phuong, Huyen, Tinh) 
                                VALUES (:MaKH, :Duong, :Phuong, :Huyen, :Tinh)";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute([
                                    ':MaKH' => $user_id,
                                    ':Duong' => $diachi,
                                    ':Phuong' => $phuong,
                                    ':Huyen' => $quan,
                                    ':Tinh' => $tinh
                                ]);
                
                            // Commit transaction
                            $conn->commit();
                
                            include "view/login.php";
                        } catch (Exception $e) {
                            // Rollback transaction nếu có lỗi
                            $conn->rollBack();
                            $errors['database'] = "Đã có lỗi xảy ra: " . $e->getMessage();
                            include "view/register.php";
                        }
                    } else {
                        include "view/register.php";
                    }
                }
                break;
            
        case 'taikhoancuatoi':
            $readonly = "";
            $err = "";
            $errDC = "";
            $infor = "";
            if(isset($_SESSION['role']) || isset($_COOKIE['id']))
            {
                if(isset($_SESSION['iduser']))
                {
                    $diachi = getDiaChi($_SESSION['iduser']);
                    $hoadon = getHoaDon($_SESSION['iduser']);
                    $infor = getInfor($_SESSION['iduser']);
                    $countDiaChi = countDiaChi($_SESSION['iduser']);
                }
                if(isset($_COOKIE['id']))
                {
                    $diachi = getDiaChi($_COOKIE['id']);
                    $hoadon = getHoaDon($_COOKIE['id']);
                    $infor = getInfor($_COOKIE['id']);
                    $countDiaChi = countDiaChi($_COOKIE['id']);
                }
                if(isset($_POST['btnThemDC']))
                {
                    $diachinha = $_POST['diachinha'];
                    $tinh = $_POST['hidden_tinh'];
                    $quan = $_POST['hidden_quan'];
                    $phuong = $_POST['hidden_phuong'];
                    if($diachinha == "")
                    {
                        $errDC = "Vui lòng nhập địa chỉ nhà";
                    }
                    else if($tinh == "" || $quan == "" || $phuong == "")
                    {
                        $errDC = "Vui lòng chọn địa chỉ";
                    }           
                    else
                    {
                        if(isset($_SESSION['iduser']))
                        {
                           
                            if($countDiaChi <5)
                            {
                            $insertDC = insertDiaChi($_SESSION['iduser'],$diachinha,$phuong,$quan,$tinh);
                            $errDC = "Thêm địa chỉ thành công";
                            $diachi = getDiaChi($_SESSION['iduser']);
                            }
                            else
                            {
                                $errDC = "Vượt quá số lượng địa chỉ cho phép";
                            }
                        }                   
                        if(isset($_COOKIE['id']))
                        {
                            
                            if($countDiaChi <5)
                            {
                            $insertDC = insertDiaChi($_COOKIE['id'],$diachinha,$phuong,$quan,$tinh);
                            $errDC = "Thêm địa chỉ thành công";
                            $diachi = getDiaChi($_COOKIE['id']);
                            }
                            else
                            {
                                $errDC = "Vượt quá số lượng địa chỉ cho phép";
                            }
                        }         
                    }
                }
                if(isset($_POST['btnXoaDC'])) {         
                    if(isset($_POST['diachifull']))
                    {
                        $selectedDC = $_POST['diachifull'];
                        if(isset($_SESSION['iduser']))
                        {
                            if($selectedDC != '') {
                                DeleteDiaChi($_SESSION['iduser'], $selectedDC);
                                $diachi = getDiaChi($_SESSION['iduser']); // Thay $id bằng ID của người dùng
                            }
                        }              
                        if(isset($_COOKIE['id']))
                        {
                            if($selectedDC != '') {
                            
                                // Thực hiện xóa địa chỉ ở đây với $selectedDC là mã địa chỉ cần xóa
                                DeleteDiaChi($_COOKIE['id'], $selectedDC); 
                                $diachi = getDiaChi($_COOKIE['id']);// Thay $id bằng ID của người dùng
                            }
                        }
                    }
                    else
                    {
                        $errDC = "Không tồn tại địa chỉ để xóa";
                    }
                }
                if(isset($_POST['btnThayDoi']))
                {
           
                    $f_name = $_POST['f_name'];
                    $l_name = $_POST['l_name'];
                    $sdt = $_POST['sdt'];
                    $email = $_POST['email'];
                    
                    if($f_name == "" || $l_name == "" || $sdt == "")
                    {
                        $err = "Vui lòng nhập đầy đủ thông tin";
                    }
                    else
                    {         
                        if(isset($_SESSION['iduser']))
                        {
                            $updateUser = UpdateUser($_SESSION['iduser'],$f_name,$l_name,$sdt,$email);
                            $err = "Thay đổi thành công";
                            $infor = getInfor($_SESSION['iduser']);
                        }                   
                        if(isset($_COOKIE['id']))
                        {
                            $updateUser = UpdateUser($_COOKIE['id'],$f_name,$l_name,$sdt,$email);
                            $err = "Thay đổi thành công";
                            $infor = getInfor($_COOKIE['id']);
                        }         
                    }
                }
                if(isset($_GET['MaHD']))
                {
                    $maHD = $_GET['MaHD'];
                    $deleteHD = DeleteHoaDon($maHD);
                    header('Location: index.php?page=taikhoancuatoi');
                }
                include "view/my-account.php";
            }
            else
            {
                header('Location: index.php');
            }
            break;
        case 'giohang':
            include "view/cart.php";
            break;
        case 'DatHangThanhCong':
            if(isset($_SESSION['role']) || isset($_COOKIE['id']))
            {
                include "view/DatHangThanhCong.php";
            }
            else
            {
                include "view/login.php";
            }
            break;
        case 'sendmail':
            include "view/send-email.php";
            break;
        default:
            break;
    }
} else {
    include "view/home.php";
}
include "view/Layout_Chung/footer.php";
