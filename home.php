<?php 
    include("header.php"); 
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error {
            color: red;
        }
        body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
        </style><?php
        //session_start();
         
        
        // $type=$_SESSION["type"];
        // echo $type;
        ?>
        <script>
            $("#dyna").text("Dashboard");
            tex();
        </script>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<div class="container">

<?php 
include("dbcon.php");
function get_Dash_Data($conn,$query){
    $confirm=mysqli_query($conn,$query) or die(mysqli_error());
    $o=mysqli_fetch_array($confirm);
    return $o['0'];
    
    
}
?>
<?php 
if($_SESSION["type"]<>"member")
{
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Customers</h6>
                        <h2 class="text-right"><i class="fa fa-solid fa-users f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  COUNT(`cid`) FROM `register`;"); ?></span></h2>
                        <p>
                            <?php 
                                // $sel="SELECT `id`,`regdate` FROM `invest` WHERE `regdate`<='2024-01-01' ORDER BY `id`";
                                // $conf=mysqli_query($conn,$sel);
                                // while($row=mysqli_fetch_array($conf))
                                // {
                                //     $reg=$row['regdate'];
                                //     $id=$row['id'];
                                //     $year = date('Y', strtotime($reg));
                                //     $Month = date('M', strtotime($reg));
                                //     echo $year;
                                //     echo $Month;
                                //     $up="UPDATE `invest` SET `year`='$year',`month`='$Month' WHERE `id`='$id'";
                                //     $co=mysqli_query($conn,$up);
                                // }
                                // echo 'true';

                                // $sel="SELECT `wid`,`wdate` FROM `widraw` WHERE `wdate`>='2023-01-01' AND `wdate`<='2024-01-01' ORDER BY `wid`";
                                // $conf=mysqli_query($conn,$sel);
                                // while($row=mysqli_fetch_array($conf))
                                // {
                                //     $reg=$row['wdate'];
                                //     $id=$row['wid'];
                                //     $year = date('Y', strtotime($reg));
                                //     $Month = date('M', strtotime($reg));
                                //     echo $year;
                                //     echo $Month;
                                //     $up="UPDATE `widraw` SET `year`='$year',`month`='$Month' WHERE `wid`='$id'";
                                //     $co=mysqli_query($conn,$up);
                                // }
                                // echo 'true';
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Investment</h6>
                        <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  SUM(`invest`) FROM `invest`;"); ?></span></h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Withdrawal</h6>
                        <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  SUM(`wamt`) FROM `widraw`;"); ?></span></h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">All Reports</h6>
                        <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>9</span></h2>
                    </div>
                </div>
            </div>
	    </div>
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="border:none;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <center><h3 class="panel-title">Month Wise Investment And Withdrawal Amount</h3>
                                </br>
                                <select name="year" class="form-control" id="year" style="width:25%;">
                                    <?php
                                        $query ="SELECT DISTINCT `year` FROM `invest` ORDER BY `year` DESC";
                                        $exe=mysqli_query($conn,$query);
                                        while($row=mysqli_fetch_array($exe))
                                        {
                                            echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                                        }
                                    ?>
                                </select>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="background-color: #e7edf2;">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="chart_area" style="height:300px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="chart_area1" style="height:300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 bg-c-yellow" style="margin-right:10px;">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="bg-warning">FIXED DEPOSIT LATEST</h3>
                </div>
                <div class="col-md-3">
                    <a href="fd_plan.php" class="btn bg-warning" style="margin-top:15px;">View All ></a>
                </div>
            </div>
            <div style="height:250px; overflow-y:scroll;">
            <table class="table table-bordered" style="height:250px;">
                <thead class="table table-bordered">
                    <tr>
                        <th>Full Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query="SELECT `fd`.*,`fd_customers`.`full` FROM `fd`,`fd_customers` WHERE `fd`.`cid`=`fd_customers`.`f_cid` ORDER BY `fd`.`fd_id` DESC LIMIT 10";
                        $con=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($con))
                        {
                            echo "<tr class='bg-warning'>
                            <td>".$row['full']."</td>
                            <td>".$row['amount']."</td>
                            <td>".$row['date']."</td>
                        </tr>";
                        }
                    ?>                     
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20"><b>Total FD Investment</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  SUM(`amount`) FROM `fd`;"); ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20"><b>Total Customer Registered</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  COUNT(`f_cid`) FROM `fd_customers`;"); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <?php
                                $current_month = date('m'); $current_year = date('Y');
                            ?>
                            <h5 class="m-b-20"><b>Current Month FD</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  SUM(`amount`) FROM `fd` WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year;"); ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-dark"><b>Current Month Registered</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  COUNT(`f_cid`) FROM `fd_customers` WHERE MONTH(regdate) = $current_month AND YEAR(regdate) = $current_year;"); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></br>
    <div class="row">
        <div class="col-md-5 bg-c-pink" style="margin-right:10px;">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="bg-warning">REGISTERED CUSTOMER</h3>
                </div>
                <div class="col-md-3">
                    <a href="register_customer1.php" class="btn bg-warning" style="margin-top:15px;">View All ></a>
                </div>
            </div>
            <div style="height:250px; overflow-y:scroll;">
            <table class="table table-bordered">
                <thead class="table table-bordered">
                    <tr>
                        <!-- <th>Cid</th>--->
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query="SELECT * FROM `register` ORDER BY `cid` DESC LIMIT 10";
                        $con=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($con))
                        {
                            echo "<tr class='bg-warning'>
                                <!--<td>".$row['cid']."</td>-->
                                <td>".$row['full']."</td>
                                <td>".$row['mobile']."</td>
                                <td>".$row['regdate']."</td>
                            </tr>";
                        }
                    ?>                     
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h5 class="m-b-20"><b>Number Of Investment</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  COUNT(`id`) FROM `invest`;"); ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-dark"><b>Current Month Investment</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  SUM(`invest`) FROM `invest` WHERE MONTH(regdate) = $current_month AND YEAR(regdate) = $current_year;"); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h5 class="m-b-20"><b>Number Of Withdrawals</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  COUNT(`wid`) FROM `widraw`;"); ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h5 class="m-b-20"><b>Current Month Withdrawals</b></h5>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo get_Dash_Data($conn,"SELECT  SUM(`wamt`) FROM `widraw` WHERE MONTH(wdate) = $current_month AND YEAR(wdate) = $current_year;"); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    </br>
                                </br>
                                </br>
                                </br>
</body>

</html>
<?php //include('footer.php'); ?>     
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="chart/charts.js"></script>
    <?php
}else
{
   

        $sql = "SELECT YEAR(regdate) as year, MONTH(regdate) as month, SUM(invest) as total_amount FROM invest WHERE cid='$id' GROUP BY YEAR(regdate), MONTH(regdate)";
        $result = mysqli_query($conn, $sql);      
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        ?>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <canvas id="myChart" style="background-color:white;" height="90" widht="50"></canvas>
        
        <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var labels = [];
                var amounts = [];
                <?php foreach ($data as $row): ?>
                    labels.push('<?php echo $row['year'] . '-' . $row['month']; ?>');
                    amounts.push(<?php echo $row['total_amount']; ?>);
                <?php endforeach; ?>
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Invested Amount',
                            data: amounts,
                            backgroundColor: {
                                type: 'linear',
                                gradient: {
                                x0: 0,
                                y0: 0,
                                x1: 0,
                                y1: 1
                                },
                                colorStops: [{
                                offset: 0,
                                color: '#ff9f80'
                                }, {
                                offset: 1,
                                color: '#ff7f80'
                                }]
                            },
                            borderColor: '#333',
                            borderWidth: 2
                            }]

                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Invested Amount by Month and Year',
                            fontColor: '#333',
                            fontSize: 24,
                            fontFamily: 'Arial'
                        },
                        legend: {
                            labels: {
                            fontColor: '#333',
                            fontFamily: 'Arial'
                            }
                        },
                        scales: {
                            yAxes: [{
                            ticks: {
                                fontColor: '#333',
                                fontFamily: 'Arial',
                                beginAtZero: true
                            }
                            }],
                            xAxes: [{
                            ticks: {
                                fontColor: '#333',
                                fontFamily: 'Arial',
                                autoSkip: false
                            }
                            }]
                        },
                    }

                });
        </script>
        <?php
        

}
?>
    