<?php
function del_KH($id){
    $conn = ketnoi();
    $sql ="DELETE FROM users where id=".$id;
    $conn->exec($sql);
}
function edit_KH($id,$f_name,$l_name,$email,$username,$password)
{
    $conn = ketnoi();
    $sql = "UPDATE users set f_name='".$f_name."',l_name='".$l_name."',email='".$email."',userName='".$username."',password='".$password."' where id=".$id;
    
   
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function insert_KH($f_name,$l_name,$email,$username,$password)
{
    $conn = ketnoi();
    $sql = "INSERT INTO users (f_name,l_name,email,userName,password) values('$f_name','$l_name','$email','$username','$password')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function getone_KH($id){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM users where id=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function getall_KH($key, $page, $soluongsp) {
    $batdau = ($page - 1) * $soluongsp;
    $conn = ketnoi();
    $sql = "SELECT * FROM users WHERE 1 ";
    if ($key != "") {
        $sql .= "AND f_name LIKE '%" . $key . "%' ";
        $sql .= "OR l_name LIKE '%" . $key . "%' ";
    }
    $sql .= "ORDER BY Id ASC LIMIT " . $batdau . "," . $soluongsp;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kh = $stmt->fetchAll();
    return $kh;
}
function getall_KH1($page,$soluongsp){
    $batdau = ($page-1)*$soluongsp;
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM users LIMIT ".$batdau.",".$soluongsp);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function countRowsInTable_KH() {
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_rows FROM users");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_rows'];
}
