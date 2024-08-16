<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="layoutSidenav_content">
<main>
    <h3>THỐNG KÊ SẢN PHẨM THEO LOẠI</h3>
    <table>
        <tr>
            <td>
            

                
                <div
                id="myChart" style="width:100%; max-width:600px; height:500px;">
                </div>

                <script>
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                const data = google.visualization.arrayToDataTable([
                ['Loại', 'Số lượng'],
                <?php 
                    $tongloai = count($listtk);
                    $i = 1;
                    foreach($listtk as $thongke){
                        extract($thongke);
                        if($i==$tongloai) $dauphay=""; else $dauphay=",";
                        echo "['".$thongke['Ten_Loai']."',".$thongke['So_Luong']."]".$dauphay;
                        $i+=1;
                    }
                ?>
                ]);

                const options = {
                title:'Sản phẩm theo loại',
                is3D:true
                };

                const chart = new google.visualization.PieChart(document.getElementById('myChart'));
                chart.draw(data, options);
                }
                </script>
            </td>
            <td>
            
        <table class="table table-light table-striped">
                <th>Mã Loại</th>
                <th>Tên Loại</th>
                <th>Số Lượng</th>
                <th></th>
                </tr>
                <?php
                if(isset($listtk)&&(count($listtk)>0))
                {
                    foreach($listtk as $KQ)
                    {

                ?>
                <tr>
                    <td><?php echo $KQ['Ma_Loai'] ?></td>
                    <td><?php echo $KQ['Ten_Loai'] ?></td>
                    <td><?php echo $KQ['So_Luong'] ?></td>
                
                </tr>
                <?php 
                    }
                    $con = null;

                } 
                
                ?>
            
            
                    </td>
                </tr>
                
            </table>
    

          
</main>
</div>


