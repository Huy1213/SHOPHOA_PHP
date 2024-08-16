<?php 
    function checkuser($user,$pass)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM users WHERE userName = '$user' AND password = '$pass'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        if(count($kq)>0) return $kq[0]['role'];
        else return 0;
    }

    function getuserinfo($user,$pass)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM users WHERE userName = '$user' AND password = '$pass'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }

    function checkusers($email,$pass)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = '$email' AND password = '$pass'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        if(count($kq)>0) return $kq[0]['role'];
        else return 0;
    }

    function getusersinfo($email,$pass)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = '$email' AND password = '$pass'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }

    function getInfor($id)
    {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = '$id'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }

    function UpdateUser($id,$f_name,$l_name,$sdt,$email){
        $conn = ketnoi();
        $sql = "UPDATE users SET f_name = '$f_name',l_name = '$l_name', sdt = '$sdt', email = '$email' where id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sanpham = $stmt->fetchAll();
        return $sanpham;
    }

    function KTDN($userName, $password) {
        $conn = ketnoi();
        $stmt = $conn->prepare("SELECT * FROM users WHERE userName = :username AND password = :password");
        $stmt->execute(['username' => $userName, 'password' => $password]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }
?>