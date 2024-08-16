<div id="layoutSidenav_content">
<main>
    <h3>CHI TIẾT HÓA ĐƠN</h3>
<table class="table table-light table-striped" style="margin-top: 10px;">
           <th>Mã HD</th>
           <th>Tên sản phẩm</th>
           <th>Ngày Đặt</th>
           <th>Ghi Chú</th>
           <th>Số lượng</th>
           <th>Đơn giá</th>
        </tr>
        <?php
        if(isset($hd)&&(count($hd)>0))
        {
            foreach($hd as $HD)
            {

        ?>
        <tr>
            <td><?php echo $HD['MaHD'] ?></td>
            <td><?php echo $HD['TenSP'] ?></td>
            <td><?php echo $HD['NgayDat'] ?></td>
            <td><?php echo $HD['GhiChu'] ?></td>
            <td><?php echo $HD['SoLuong'] ?></td>
            <td><?php echo $HD['DonGia'] ?></td>
            
</td>
        </tr>
        <?php 
            }
            $con = null;

        } 
           
        ?>
    </table>
    
</main>
</div>
