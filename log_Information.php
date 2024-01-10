<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            th, td { white-space: nowrap; }
            
            .table-striped>tbody>tr:nth-child(odd)>td,
            .table-striped>tbody>tr:nth-child(odd)>th
            {
                background-color: #E5DCC3;
                padding:15px;
            }
            .table-striped>tbody>tr:nth-child(even)>td,
            .table-striped>tbody>tr:nth-child(even)>th
            {
                background-color: #C9CCD5;
                padding:15px;
            }
            table.dataTable thead {background-color:#D3E4CD}
        </style>
        <?php 
            require_once("header.php");
        ?>
        <script>
            $("#dyna").text("LOG INFORMATION");
        </script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="coading.php" method="post">
                                <div class="box-body">
                                    <div class="group-form col-md-3" id="namewise">
                                        <label for="inputEmail3" class="form_label">From Date</label>
                                        
                                        <input class="col-sm-4 form-control form-control-sm" type="text" id="date" name="start" autocomplete="off" placeholder="dd-mm-yyyy" id="dat1" required>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                $('#date , #d2').datetimepicker();
                                            });
                                        </script>
                                    </div>
                                    <div class="group-form col-md-3" id="namewise">
                                        <label for="inputEmail3" class="form_label">TO Date</label>
                                        <input class="col-sm-4 form-control form-control-sm" type="text" id="d2" name="end" autocomplete="off" placeholder="dd-mm-yyyy" title="Enter a date in this formart DD-MM-YYYY" id="dat2"  required>
                                    </div>
                                    <div class="group-form col-md-3" id="namewise">
                                     
                                        <?php
                                            if($_SESSION['endtime']<date('Y-m-d h:i:s'))
                                            {
                                                if((date("h")==12) && date("h",strtotime($_SESSION["endtime"]))==1)
                                                {
                                                    ?>
                                                        <a href="coading.php?stop_schedule=stop"onclick="return confirm('Are you sure..?');" style="margin-top:30px;" class="btn btn-danger" type="reset">Stop</a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                        <button class="form-control-sm btn-success" style="margin-top:30px;" type="submit" name="Schedule" id="search">Set Schedule</button>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                        <a href="coading.php?Stop_Schedule=stop" onclick="return confirm('Are you sure..?');" style="margin-top:30px;" class="btn btn-sm btn-danger col-md-12" type="reset">Stop</a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">

                        <center><h3>
                            Log Permission Details
                        </h3></center>
                    <div id="tablepdf" style="overflow-x: auto; height:400px;">
                        <table id="employee_grid" class="table table-striped table-bordered table-hover example1">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Cust-ID</th>
                                    <!-- <th>Full Name</th> -->
                                    <th>Log In</th>
                                    <th>Log Out</th>
                                </tr>
                            </thead>
                            <tbody id="mytable1">
                                
                            </tbody>    
                        
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function()
        {
            let log=$('#employee_grid').DataTable({
                "lengthMenu": [[100, -1], [100, "All"]],
                dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                searching:false,
                buttons: [
                        'csv', 'excel'
                        ],
                        "bProcessing": true,
                    "serverSide": true,
                    "ajax":{
                        url :"ajax/log_info.php", // json datasource
                        type: "post",  // type of method ,GET/POST/DELETE
                        datatype: 'json',
                        data:{submit:'Submit'},
                        error: function(){
                            $("#employee_grid_processing").css("display","none");
                        }
                        // ,
                        // success:function(data)
                        // {
                        //     alert('hii');
                        //   console.log(data);
                        // }
                    }
                });
            // let log=$.ajax({
            //     url:"ajax/log_info.php",
            //     method:"POST",
            //     data:{Submit:"Submit",load:"directload"},
            //     cache:false,
            //     success:function(data)
            //     {
            //         $('#mytable1').append(data);
            //         $('#example1').dataTable({
            //             dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            //             buttons: [
            //             'csv', 'excel', 'pdf', 'print'
            //             ],
            //         "lengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            //         language: {
            //             'paginate': {
            //             'previous': '<a type="button" class="btn btn-primary">Previous</a>',
            //             'next': '<a type="button" class="btn btn-primary">Next</a>'
            //             }
            //         }
            //         });
            //     }
            // });console.log(log);
            $('#search1').click(function()
            {
                //alert('hii');
                
                
                 var cid=$('#full1').val();
                 var name=$('#full').val();
                
                 if(name=='')
                 {
                     alert('Please Select Name');
                     exit();
                 }
                // //console.log(name);
                 let log=$.ajax({
                        url:"ajax/CurrentMonthPayment.php",
                        method:"POST",
                        data:{Submit:"submit",load:"load",cid:cid},
                        cache:false,
                        success:function(data)
                        {
                            $('#mytable1').html(data);
                            
                        }
                     });//console.log(log);
            });
        });
    </script>
</body>

<?php include('footer.php'); ?>

