<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <title>Document</title>
    <?php 
        include("KetNoi.php");
        $sql = "select * from loai";
        $KH = $con->query($sql);
    ?>
    <style> 
        img{
            width: 50px;
        }  
    </style>
</head>
<body>
    <table class="table table-dark table-striped">
           <th>Mã loại</th>
           <th>Tên loại</th>
           
        </tr>
        <?php 
            foreach($KH as $kh)
            {
        ?>
        <tr>
            <td><?php echo $kh['Ma_Loai'] ?></td>
            <td><?php echo $kh['Ten_Loai'] ?></td>
            
        </tr>
        <?php 
            }
            $con = null;
        ?>
    </table>
</body>
</html>