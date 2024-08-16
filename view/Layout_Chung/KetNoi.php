<?php 
    try {
        $con = new PDO("mysql:host=localhost;dbname=qlbh",'root','');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->query("set names utf8");
        
    } catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
    }  
try {
    $servername = "localhost:3306";
    $dbname = "qlbh";
    $username = "root";
    $password = "";
  
    $con = new PDO(
        "mysql:host=$servername; dbname=qlbh",
        $username, $password
    );
     
   $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>