<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Include your database connection file here
    include('../model/KetNoi.php');
    $conn=ketnoi();
    $sql = "UPDATE khohang SET SoLuongNhap = '".$quantity."' where ID=".$id;;
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        echo 'Quantity updated successfully';
    } else {
        echo 'Failed to update quantity';
    }
}
?>
