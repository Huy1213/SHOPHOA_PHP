<?php
function getall_admin(){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM adminlogin");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $admin = $stmt->fetchAll();
    return $admin;
}
function getone_admin($id){
    $conn = ketnoi();
    $stmt = $conn->prepare("SELECT * FROM adminlogin where id=".$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $adminlogin = $stmt->fetchAll();
    return $adminlogin;
}
function edit_admin($id,$username,$password)
{
    $conn = ketnoi();
    $sql = "UPDATE adminlogin set username='".$username."', password='".$password."' where id=".$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function insert_admin($username,$password)
{
    $conn = ketnoi();
    $sql = "INSERT INTO adminlogin (username,password) values('$username','$password')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function del_admin($id){
    $conn = ketnoi();
    $sql ="DELETE FROM adminlogin where id=".$id;
    $conn->exec($sql);
}
?>