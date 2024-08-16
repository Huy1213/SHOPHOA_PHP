<?php 
session_start();
ob_start();
include "model/ketnoi.php";
include "model/hoa.php";
include "model/admin.php";
include "model/donhang.php";
include "model/khachhang.php";
include "model/hoadon.php";
include "view/header.php";

if(isset($_GET['act']))
{
    switch($_GET['act']){
        case 'hoa':
                if(isset($_POST['keyword']))
                {
                    $keyword=$_POST['keyword'];
                }
                else{
                    $keyword="";
                }
                if(!isset($_GET['page']))
                {
                    $page = 1;
                }
                else
                {
                    $page = $_GET['page'];
                } 
                $soluongsp = 5;
                $kq = getall_hoa($keyword,$page,$soluongsp);
                $total_rows = countRowsInTable();
                $total_pages = ceil($total_rows / $soluongsp);
            
          
            include "view/hoa.php";
            break;
        case 'insert':
            $loai = getall_loaiHoa();
            $mau = getall_Mau();
            if (!isset($_POST['insert'])) {
                include "view/inserthoa.php";
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy dữ liệu từ form
                $tensp = $_POST['TenSP'];
                $dongia = $_POST['DonGia'];
                $maloai = $_POST['MaLoai'];
                $mamau = $_POST['MaMau'];
                $mota = $_POST['MoTa'];
                $soluong = $_POST['SoLuong'];
                $trangthai = $_POST['TrangThai'];
                // Kết nối CSDL
                $conn = ketnoi();
    
                // Xử lý hình ảnh được tải lên
                if ($_FILES['hinh']['error'] == UPLOAD_ERR_OK) {
                    $upload_dir = "images/product/"; // Thư mục lưu trữ hình ảnh sản phẩm
                    $tmp_name = $_FILES['hinh']['tmp_name'];
                    $new_image_name = basename($_FILES['hinh']['name']);
                    $new_image_path = $upload_dir . $new_image_name;
    
                    // Di chuyển hình ảnh mới vào thư mục lưu trữ
                    move_uploaded_file($tmp_name, $new_image_path);
    
                    // Cập nhật đường dẫn hình ảnh mới vào CSDL
                    $hinhanh = $new_image_name;
                } else {
                    // Xử lý lỗi tải lên file
                    $hinhanh = null; // Hoặc xử lý theo cách khác
                }
    
                // Chèn sản phẩm mới vào CSDL
                inserthoa($tensp, $maloai, $dongia, $mamau, $soluong, $mota, $hinhanh, $trangthai, $conn);
    
                // Lấy ID của sản phẩm vừa chèn
                $last_id = $conn->lastInsertId();
                $files = $_FILES['hinhs'];
                $target_dir = "images/product/";
                $success = false;
                // Duyệt qua từng file
                for ($i = 0; $i < count($files['name']); $i++) {
                    $target_file = $target_dir . basename($files['name'][$i]);
    
                    // Kiểm tra xem file có phải là hình ảnh không
                    $check = getimagesize($files['tmp_name'][$i]);
                    if ($check !== false) {
                        // Kiểm tra nếu file đã tồn tại thì bỏ qua hoặc xử lý theo cách khác
                       
                            if (move_uploaded_file($files['tmp_name'][$i], $target_file)) {
                                // Chuẩn bị câu lệnh SQL để thêm thông tin vào cơ sở dữ liệu
                                $filename = basename($files['name'][$i]);
                                $stmt = $conn->prepare("INSERT INTO hinhanh (TenHinh,MaSP) VALUES (?, ?)");
                                if ($stmt->execute([$filename,$last_id])) {
                                    $success = true; // Đánh dấu là quá trình thêm ảnh thành công
                                } else {
                                    echo "Lỗi: " . implode(" ", $stmt->errorInfo());
                                }
                            }
                        
                    }
                }
    
                if ($success) {
                    // Nếu thành công, tiếp tục với quy trình điều hướng bao gồm danh sách hoa
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $soluongsp = 5;
                    $kq = getall($page, $soluongsp);
                    $total_rows = countRowsInTable();
                    $total_pages = ceil($total_rows / $soluongsp);
                    include "view/hoa.php";}
            }
            break;

        case 'del':
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                del($id);
            }
            if(!isset($_GET['page']))
            {
                $page = 1;
            }
            else
            {
                $page = $_GET['page'];
            } 
            $soluongsp = 5;
            $kq = getall($page, $soluongsp);
            $total_rows = countRowsInTable();
            $total_pages = ceil($total_rows / $soluongsp);
           
            include "view/hoa.php";
            break;
        case 'edit':
            $mau = getall_Mau();
            $loai = getall_loaiHoa();
        
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $kq1 = getone($id);
                include "view/edithoa.php";
            }
        
            if (isset($_POST['edit'])) {
                $id = $_POST['MaSP'];
                $tensp = $_POST['TenSP'];
                $dongia = $_POST['DonGia'];
                $maloai = $_POST['MaLoai'];
                $mamau = $_POST['MaMau'];
                $mota = $_POST['MoTa'];
                $soluong = $_POST['SoLuong'];
                $conn = ketnoi();
                $success = true; // Initialize $success
        
                try {
                    // Begin a transaction
                    $conn->beginTransaction();
        
                    // Handle main image
                    if ($_FILES['hinh']['error'] == UPLOAD_ERR_OK) {
                        $upload_dir = "images/product/"; // Directory to store product images
                        $tmp_name = $_FILES['hinh']['tmp_name'];
                        $new_image_name = basename($_FILES['hinh']['name']);
                        $new_image_path = $upload_dir . $new_image_name;
        
                        // Move the new image to the storage directory
                        if (move_uploaded_file($tmp_name, $new_image_path)) {
                            $hinhanh = $new_image_name;
                        } else {
                            throw new Exception("Error moving the image.");
                        }
                    } else {
                        // If no new image is selected, retain the old image
                        $hinhanh = ""; // Or fetch the value from the database if necessary
                    }
        
                    // Update main product information
                    edithoa($id, $tensp, $maloai, $dongia, $mamau, $soluong, $mota, $hinhanh);
        
                    // Delete old image records from the database
                    $stmt = $conn->prepare("DELETE FROM hinhanh WHERE MaSP = ?");
                    if (!$stmt->execute([$id])) {
                        throw new Exception("Error deleting old images from the database: " . implode(" ", $stmt->errorInfo()));
                    }
        
                    // Insert new images
                    $files = $_FILES['hinhs'];
                    $target_dir = "images/product/";
                    for ($i = 0; $i < count($files['name']); $i++) {
                        $target_file = $target_dir . basename($files['name'][$i]);
        
                        // Check if the file is an image
                        if (move_uploaded_file($files['tmp_name'][$i], $target_file)) {
                            $filename = basename($files['name'][$i]);
                            $stmt = $conn->prepare("INSERT INTO hinhanh (MaSP, TenHinh) VALUES (?, ?)");
                            if (!$stmt->execute([$id, $filename])) {
                                throw new Exception("Error inserting new image: " . implode(" ", $stmt->errorInfo()));
                            }
                        }
                    }
        
                    // Commit the transaction
                    $conn->commit();
        
                } catch (Exception $e) {
                    // Rollback the transaction if something failed
                    $conn->rollBack();
                    echo "Failed: " . $e->getMessage();
                    $success = false; // If an error occurs, set $success to false
                }
        
                // Check $success before redirecting
                if ($success) {
                    // If successful, continue with the navigation process including the flower list
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $soluongsp = 5;
                    $kq = getall($page, $soluongsp);
                    $total_rows = countRowsInTable();
                    $total_pages = ceil($total_rows / $soluongsp);
                    include "view/hoa.php";
                }
            }
            break;
            
        case 'loaihoa':
            $loai=getall_loaiHoa();
            include "view/loaihoa.php";
            break;
        case 'edit_loaihoa':
                
                if(isset($_GET['id']))
                    {
                        $id=$_GET['id'];
                        $loaihoa1=getone_loaihoa($id);
                       include "view/edit_loaihoa.php";
                    }
                if(isset($_POST['edit_loaihoa']))
                    {
                        $id=$_POST['MaLoai'];
                        $tenloai=$_POST['TenLoai'];
                        edit_loaihoa($id,$tenloai);
                        $loai=getall_loaiHoa();
                        include "view/loaihoa.php";
                    }
        
                break;
            case 'insert_loaihoa':
                    
                    if(!isset($_POST['insert_loaihoa']))
                    {
                        include "view/insert_loaihoa.php";
                
                    }
                    elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Lấy dữ liệu từ form
                        //$id=$_POST['id'];
                        $tenloai = $_POST['TenLoai'];
                       
                        insert_loaihoa($tenloai);
                        $loai=getall_loaiHoa();
                        include "view/loaihoa.php";
                    }
                    
                    break;
                    case 'del_loaihoa':
                        // // if(isset($_GET['id']))
                        // {
                        //     $id=$_GET['id'];
                        //     del_loaihoa($id);
                        // }
                        
// Kiểm tra xem có hoa nào sử dụng mã loại này không
                        if(isset($_GET['act']) && $_GET['act'] == 'del_loaihoa' && isset($_GET['id'])) {
                            $id = $_GET['id'];
                            // Thực hiện hàm xóa loại hoa
                            del_loaihoa($id);
                        }

                        $loai = getall_loaiHoa();
                       
                        include "view/loaihoa.php";
                        break;

                        case 'admin':
                            $admin=getall_admin();
                            include "view/admin.php";
                            break;
                       case 'insert_admin':
                            if(!isset($_POST['insert_admin']))
                            {
                                include "view/insert_admin.php";
                        
                            }
                            elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Lấy dữ liệu từ form
                                //$id=$_POST['id'];
                                $username = $_POST['UserName'];
                                $password = $_POST['Password'];
                                insert_admin($username,$password);
                                $admin=getall_admin();
                                include "view/admin.php";
                            }
                            
                            break;
                    case 'edit_admin':
        
                        if(isset($_GET['id']))
                            {
                                $id=$_GET['id'];
                                $admin1=getone_admin($id);
                                include "view/edit_admin.php";
                            }
                        if(isset($_POST['edit_admin']))
                            {
                                $id=$_POST['id'];
                                $username=$_POST['UserName'];
                                $password = $_POST['Password'];
                                edit_admin($id,$username,$password);
                                $admin=getall_admin();
                                include "view/admin.php";
                            }
                
                        break;
                        case 'del_admin':
                            if(isset($_GET['id']))
                            {
                                $id=$_GET['id'];
                                del_admin($id);
                            }
                            $admin=getall_admin();
                            include "view/admin.php";
                            break;
                        case 'thongke':
                            $listtk=getall_thongke();
                            include "view/thongke/list.php";
                            break;
                        case 'thongke_doanhthu':
                            $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
                            $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
                            
                            $listtkdt = getall_thongke_doanhthu($start_date, $end_date);
                        
                                include "view/thongke/list_doanhthu.php";
                                break;
                        case 'khachhang':
                                    if(isset($_POST['keyword']))
                                    {
                                        $keyword=$_POST['keyword'];
                                    }
                                    else{
                                        $keyword="";
                                    }
                                    if(!isset($_GET['page']))
                                    {
                                        $page = 1;
                                    }
                                    else
                                    {
                                        $page = $_GET['page'];
                                    } 
                                    $soluongsp = 5;
                                    $kh = getall_KH($keyword,$page,$soluongsp);
                                    $total_rows = countRowsInTable_KH();
                                    $total_pages = ceil($total_rows / $soluongsp);
                                
                              
                                include "view/khachhang.php";
                                break;   
                       

                    case 'del_KH':
                        if(isset($_GET['id']))
                        {
                            $id=$_GET['id'];
                            del_KH($id);
                        }
                        if(!isset($_GET['page']))
                        {
                            $page = 1;
                        }
                        else
                        {
                            $page = $_GET['page'];
                        } 
                        $soluongsp = 5;
                        $kh = getall_KH1($page, $soluongsp);
                        $total_rows = countRowsInTable();
                        $total_pages = ceil($total_rows / $soluongsp);
                        
                        include "view/khachhang.php";
                        break;
                        case 'edit_KH':
                            
                            if(isset($_GET['id']))
                                {
                                    $id=$_GET['id'];
                                    $kq1=getone_KH($id);
                                    include "view/edit_KH.php";
                                }
                            if(isset($_POST['edit_KH']))
                                {
                                    $id=$_POST['id'];
                                    $l_name = $_POST['l_name'];
                                    $f_name = $_POST['f_name'];
                                    $username = $_POST['userName'];
                                    $password = $_POST['password'];
                                    $email = $_POST['email'];
                                    edit_KH($id,$f_name,$l_name,$email,$username,$password);
                                    if(!isset($_GET['page']))
                                    {
                                        $page = 1;
                                    }
                                    else
                                    {
                                        $page = $_GET['page'];
                                    } 
                                    $soluongsp = 5;
                                    $kh = getall_KH1($page, $soluongsp);
                                    $total_rows = countRowsInTable();
                                    $total_pages = ceil($total_rows / $soluongsp);
                                    include "view/khachhang.php";
                                }
                        //     $kq = getall();
                        //    include "view/hoa.php";
                            break;
                        case 'hoadon':
                            if(isset($_POST['keyword']))
                            {
                                $keyword=$_POST['keyword'];
                            }
                            else{
                                $keyword="";
                            }
                            if(!isset($_GET['page']))
                            {
                                $page = 1;
                            }
                            else
                            {
                                $page = $_GET['page'];
                            } 
                            $soluongsp = 5;
                            $hd = getall_HD($keyword,$page,$soluongsp);
                            $total_rows = countRowsInTable_HD();
                            $total_pages = ceil($total_rows / $soluongsp);
                        
                        
                        include "view/hoadon.php";
                        break;  
                    case 'edit_HD':
                        
                        if(isset($_GET['id']))
                            {
                                $id=$_GET['id'];
                                $kq1=getone_HD($id);
                                include "view/edit_HD.php";
                            }
                        if(isset($_POST['edit_HD']))
                            {
                                $id=$_POST['MaHD'];
                                $makh = $_POST['MaKH'];
                                $ngaydat = $_POST['NgayDat'];
                                $ghichu = $_POST['GhiChu'];
                                $dcgh = $_POST['DCGH'];
                                $httt = $_POST['HTTT'];
                                $tinhtrang = $_POST['TinhTrang'];
                                edit_HD($id,$makh,$dcgh,$ngaydat,$ghichu,$httt,$tinhtrang);
                                if(!isset($_GET['page']))
                                {
                                    $page = 1;
                                }
                                else
                                {
                                    $page = $_GET['page'];
                                } 
                                $soluongsp = 5;
                                $hd = getall_HD1($page, $soluongsp);
                                $total_rows = countRowsInTable();
                                $total_pages = ceil($total_rows / $soluongsp);
                                include "view/hoadon.php";
                            }
                    //     $kq = getall();
                    //    include "view/hoa.php";
                        break;
                    case 'del_HD':
                        if(isset($_GET['id']))
                        {
                            $id=$_GET['id'];
                            del_HD($id);
                        }
                        if(!isset($_GET['page']))
                        {
                            $page = 1;
                        }
                        else
                        {
                            $page = $_GET['page'];
                        } 
                        $soluongsp = 5;
                        $hd = getall_HD1($page, $soluongsp);
                        $total_rows = countRowsInTable();
                        $total_pages = ceil($total_rows / $soluongsp);
                        
                        include "view/hoadon.php";
                        break;
                        case 'in_HD':
                            
                            require('../tfpdf/tfpdf.php');
                            
                            $pdf = new tFPDF();
                            $pdf->AddPage();

                            // Add a Unicode font (uses UTF-8)
                            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
                            $pdf->SetFont('DejaVu','',14);

                            if(isset($_GET['act']) && $_GET['act'] == 'in_HD' && isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $inHoaDon = in_HD($id);
                            }
                            // Select a standard font (uses windows-1252)
                            $pdf->SetFont('Arial','',14);
                            $pdf->Ln(10);
                            $pdf->Write(10,'Đơn hàng của bạn gồm có:');
                            $pdf->Ln(10);

                            $width_cell=array(5,35,80,20,30,40);

                            $pdf->Cell($width_cell[0],10,'Mã HD',1,0,'C',true);
                            $pdf->Cell($width_cell[1],10,'Tên sản phẩm',1,0,'C',true);
                            $pdf->Cell($width_cell[2],10,'Ngày đặt',1,0,'C',true);
                            $pdf->Cell($width_cell[3],10,'Ghi chú',1,0,'C',true); 
                            $pdf->Cell($width_cell[4],10,'Số lượng',1,0,'C',true);
                            $pdf->Cell($width_cell[5],10,'Đơn giá',1,1,'C',true); 
                            $pdf->SetFillColor(235,236,236); 
                            
                            foreach ($inHoaDon as $row) {
                                $pdf->Cell(50, 10, $row['MaHD'], 1, 0);
                                $pdf->Cell(50, 10, $row['TenSP'], 1, 0);
                                $pdf->Cell(50, 10, $row['NgayDat'], 1, 0);
                                $pdf->Cell(50, 10, $row['GhiChu'], 1, 0);
                                $pdf->Cell(50, 10, $row['SoLuong'], 1, 0);
                                $pdf->Cell(50, 10, $row['DonGia'], 1, 0);
                            }
                            

                            
                            $pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
                            $pdf->Ln(10);

                            $pdf->Output();
                        break;
                        case 'xem_HD':
                            if(isset($_GET['id']))
                                {
                                    $id=$_GET['id'];
                                    $hd=in_HD($id);
                                include "view/xem_HD.php";
                                }
                        break;
                        case 'khohang':
                          
                                $khohang=getall_khohang();
                                include "view/khohang.php";
                                break;    
                         case 'edit_khohang':
                            $mancc = getall_NCC();
                            $masp = getall_SP();
                            if(isset($_GET['id']))
                                {
                                    $id=$_GET['id'];
                                    $kq1=getone_khohang($id);
                                include "view/edit_khohang.php";
                                }
                            if(isset($_POST['edit_khohang']))
                                {
                                    $id=$_POST['ID'];
                                    $mancc=$_POST['MaNCC'];
                                    $masp=$_POST['MaSP'];
                                    $soluongnhap = $_POST['SoLuongNhap'];
                                    $ngaynhap=$_POST['NgayNhap'];
                                    edit_khohang($id,$mancc,$masp,$soluongnhap,$ngaynhap);
                                    $khohang=getall_khohang();
                                    include "view/khohang.php";
                                }
                            break;
                            case 'insert_khohang':
                                  $sp=getall_SP();
                                  $ncc = getall_NCC();
                            if(!isset($_POST['insert_khohang']))
                            {
                                include "view/insert_khohang.php";
                        
                            }
                            elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert_khohang'])) {
                                // Lấy dữ liệu từ form
                                $mancc = $_POST['MaNCC'];
                                $masp = $_POST['MaSP'];
                                $soluongnhap = $_POST['SoLuongNhap'];
                                $ngaynhap = $_POST['NgayNhap'];
                                
                                // Thêm dữ liệu vào cơ sở dữ liệu
                                insert_khohang($mancc, $masp, $soluongnhap, $ngaynhap);
                                
                                // Chuyển hướng người dùng đến một trang khác sau khi thêm dữ liệu thành công
                                header("Location: index.php?act=khohang");
                                exit(); // Dừng script sau khi chuyển hướng
                            }
                            break;
                        case 'del_khohang':
                            if(isset($_GET['act']) && $_GET['act'] == 'del_khohang' && isset($_GET['id'])) {
                                $id = $_GET['id'];
                                // Thực hiện hàm xóa loại hoa
                                del_khohang($id);
                            }
                            $khohang=getall_khohang();
                            include "view/khohang.php";
                            break;
                        default:
                            include "view/home.php";
    }

}
else {
    include"view/home.php";
}

?>

