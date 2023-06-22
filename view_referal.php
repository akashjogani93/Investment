<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="loader.css">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }

            #employee_grid tbody tr:hover {
                background-color: pink;
                }
        </style>
        <?php require_once("header.php"); ?>
        
        
        <div class="content-wrapper">
            <script>
                $("#dyna").text("team referal Details");
                tex();
            </script>
            <section class="content">
                
                <div class="box">
                    <div class="box-body">
        </br>
                        <div class="row">
                            <div class="col-md-10">
                                <center><h3>
                                    <?php echo $nam=$_GET['nam']; ?>
                                </h3></center>
                            </div>
                            <div class="col-md-2">
                                <center><h3>
                                    <a href="team_view.php" class="btn btn-warning">Back</a>
                                </h3></center>
                            </div>
                        </div>
                        <table id="employee_grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody class="mytable1" id="tb">
                            <?php 
                                include('dbcon.php');
                                $cid=$_GET['cid'];
                                
                                $q="SELECT `id` FROM `invest` WHERE `cid`='$cid'";
                                $conf=mysqli_query($conn,$q);   
                                $people = [];
                                while($row=mysqli_fetch_assoc($conf))
                                {
                                    $id=$row['id'];
                                    $q1="SELECT `register`.*, `referal`.`refcid` FROM `register`,`referal` WHERE `referal`.`refcid`=`register`.`cid` AND `id`='$id'";
                                    $conform=mysqli_query($conn,$q1);
                                    while($row1=mysqli_fetch_assoc($conform))
                                    {
                                        $refcid=$row1['refcid'];
                                        $full=$row1['full'];
                                        $mobile=$row1['mobile'];
                                        $match='false';

                                        foreach($people AS $name)
                                        {
                                            $name1=$name['name'];
                                            
                                            if($name1==$full)
                                            {
                                                $match='true';
                                            }
                                        }
                                        if($match=='false')
                                        {
                                            $data = [
                                                'name' => $full,
                                                'mobile' => $mobile,
                                                'cid' => $refcid
                                            ];
                                            array_push($people, $data);
                                            ?>
                                                <tr>
                                                    <td><?php echo $data['cid'];?></td>
                                                    <td><?php echo $data['name'];?></td>
                                                    <td><?php echo $data['mobile'];?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                } 
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


        </div>
    </div>
    <!-- <script type="text/javascript" src="js/team_view.js"></script> -->
    <script>
        $( document ).ready(function() 
        {
            $("#employee_grid tbody").on('dblclick', 'tr', function() 
            {
                var currow = $(this).closest('tr');
                var item_id = currow.find('td:eq(0)').html();
                var name = currow.find('td:eq(1)').html();
                console.log(item_id);
                window.location.href = 'view_referal.php?cid='+item_id + '&nam=' + name;
            });
        });
    </script>
    <?php require_once("footer.php"); ?>
</body>
