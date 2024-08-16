<!DOCTYPE html>
<html>
<head>
    <title>Thống Kê Sản Phẩm Theo Doanh Thu</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div id="layoutSidenav_content">
        <main>
            <h3>THỐNG KÊ SẢN PHẨM THEO DOANH THU</h3>

            <form method="post" id="filterForm" style="margin-left:10px">
                <label for="start_date">Từ ngày:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
                
                <label for="end_date">Đến ngày:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>">
                
                <button type="submit" id="filterButton" class="btn btn-secondary">Thống kê</button>
            </form>

            <div id="myChart" style="width:100%; max-width:600px; height:500px;"></div>

            <script>
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    const data = google.visualization.arrayToDataTable([
                        ['Tên sản phẩm', 'Doanh Thu'],
                        <?php 
                            $tongsp = count($listtkdt);
                            $i = 1;
                            foreach($listtkdt as $thongke){
                                extract($thongke);
                                if($i==$tongsp) $dauphay=""; else $dauphay=",";
                                echo "['".$thongke['Ten_San_Pham']."',".$thongke['Doanh_Thu']."]".$dauphay;
                                $i+=1;
                            }
                        ?>
                    ]);

                    const options = {
                        title:'Sản phẩm theo doanh thu',
                        is3D:true
                    };

                    const chart = new google.visualization.BarChart(document.getElementById('myChart'));
                    chart.draw(data, options);
                }
            </script>

            <table class="table table-light table-striped">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng bán ra</th>
                    <th>Doanh Thu</th>
                </tr>
                <?php
                if(isset($listtkdt) && count($listtkdt) > 0) {
                    foreach($listtkdt as $KQ) {
                ?>
                <tr>
                    <td><?php echo $KQ['Ten_San_Pham'] ?></td>
                    <td><?php echo $KQ['So_Luong_Ban_Ra'] ?></td>
                    <td><?php echo $KQ['Doanh_Thu'] ?></td>
                </tr>
                <?php 
                    }
                    $conn = null;
                } 
                ?>
            </table>
        </main>
    </div>
</body>
</html>
