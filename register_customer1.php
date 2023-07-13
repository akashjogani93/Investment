<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="loader.css">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            /* Ensure that the demo table scrolls */
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
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("All Customers Details");
            tex();
        </script>
        <script type="text/javascript">
            $(function() {
                $(".full").autocomplete({
            
                    source: 'investment_searchName.php',
                    focus: function (event, ui) {
                        event.preventDefault();
                        $("#full").val(ui.item.label);
                    },
                    select: function (event, ui) {
                        event.preventDefault();
                        $("#full1").val(ui.item.value);
                        $("#full").val(ui.item.label);
                }
                }); 
            });
        </script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="group-form col-md-2">
                                            <label for="inputEmail3" class="form_label">Apply Filters</label>
                                            <select class="col-sm-4 form-control form-control-sm" id="select" name="option">
                                                <option>Search By Name</option>
                                                <option>Search By Date</option>
                                            </select>                
                                        </div>
                                        <div class="group-form col-md-4" id="namewise">
                                            <label for="inputEmail3" class="form_label">Search Name</label>
                                            <input  type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full" placeholder="Search Full Name" required="required">
                                            <input type="hidden" name="full1" id="full1">
                                        </div>
                                        <div class="group-form col-md-3" id="datewise1" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Select From Date</label>
                                                <input  type="date"  class="col-sm-4 form-control form-control-sm full" name="fromdate" id="fromdate">                
                                        </div>
                                        <div class="group-form col-md-3" id="datewise2" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Select To Date</label>
                                            <input type="date"  class="form-control" name="todate"  id="todate">
                                            <script>
                                                $(document).ready( function() {
                                                    var yourDateValue = new Date();
                                                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                                                    $('#todate').val(formattedDate);
                                                    $('#fromdate').val(formattedDate);
                                                });
                                            </script> 
                                        </div>
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                            <a type="button" id="search" class="btn btn-primary">Load Data</a>
                                        </div>
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                            <a href="register_customer1.php" id="search" class="btn btn-warning">Refresh</a>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-12">
                                <h3>
                                    <b>Registered Customer Details</b>
                                </h3>
                            </div>
                        </div></br>
                        <div class="table-responsive" style="overflow-y:scroll; height: 560px; width:100% margin-left: 100px;">
                            <table id="employee_grid" class="table table-striped table-bordered table-hover example1">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Bank</th>
                                        <th>Account No</th>
                                        <th>IFSC Code</th>
                                        <th>Pan Card Number</th>
                                        <th>Registration Date</th>
                                        <th>Nominee</th>
                                        <th>Relation</th> 
                                        <th>Username</th>
                                        <th>Password</th>     
                                    </tr>
                                </thead>
                                
                                <tbody id="mytable1">
                                    
                                </tbody>    
                                
                            </table> 
                        </div>
                    </div>
                </div>
                            
            </section>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script> 
    <script type="text/javascript">
        $( document ).ready(function() 
        {
            let log=$('#employee_grid').DataTable({
                    "lengthMenu": [[100, -1], [100, "All"]],
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    buttons: [ {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':visible:not(:first-child)' // Exclude the first column from the export
                                }
                            }],
                    "bProcessing": true,
                    "serverSide": true,
                    "searching": false,
                    "ajax":{
                        url :"ajax/load_customers.php", // json datasource
                        type: "post",  // type of method ,GET/POST/DELETE
                        datatype: 'json',
                        data:{submit:'Submit',d1:'not_date'},
                        error: function()
                        {
                            $("#employee_grid_processing").css("display","none");
                        }
                        // ,
                        // success:function(data)
                        // {
                        //   console.log(data);
                        // }
                    }
            });

            $('#select').change(function()
            {
                var option=$(this).val();
                if(option=="Search By Date")
                {
                    $('#namewise').hide();
                    $('#datewise1').show();
                    $('#datewise2').show();
                }else if(option=="Search By Name")
                {
                    $('#namewise').show();
                    $('#datewise1').hide();
                    $('#datewise2').hide();
                }
            });

            $('#search').click(function()
            {
                var filter=$('#select').val();
                if(filter=="Search By Name")
                {
                    var cid=$('#full1').val();
                    var name=$('#full').val();
                    if(name=='')
                    {
                        alert('Please Select Name');
                        exit();
                    }
                    var table = $('#employee_grid').DataTable();
                    table.destroy();

                    let log=$('#employee_grid').DataTable({
                        "lengthMenu": [[100, -1], [100, "All"]],
                        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        buttons: [ {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':visible:not(:first-child)' // Exclude the first column from the export
                                }
                            }],
                        "bProcessing": true,
                        "serverSide": true,
                        "searching": false,
                        "ajax":{
                            url :"ajax/load_customers.php", // json datasource
                            type: "post",  // type of method ,GET/POST/DELETE
                            datatype: 'json',
                            data:{submit:'Submit',d1:"name",cid:cid},
                            error: function(){
                                $("#employee_grid_processing").css("display","none");
                            }
                                // ,
                                // success:function(data)
                                // {
                                //   console.log(data);
                                // }
                        }
                    });
                }else
                {
                    var d1=$('#fromdate').val();
                    var d2=$('#todate').val();
                    if(d1=='')
                    {
                        alert('Please Select From Date');
                        exit();
                    }
                    var table=$('#employee_grid').DataTable();
                    table.destroy();
                    let log=$('#employee_grid').DataTable({
                        "lengthMenu": [[100, -1], [100, "All"]],
                        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        buttons: [ {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':visible:not(:first-child)' // Exclude the first column from the export
                                }
                            }],
                        "bProcessing": true,
                        "serverSide": true,
                        "searching": false,
                        "ajax":{
                            url :"ajax/load_customers.php", // json datasource
                            type: "post",  // type of method ,GET/POST/DELETE
                            datatype: 'json',
                            data:{submit:'Submit',d1:d1,d2:d2},
                            error: function(){
                                $("#employee_grid_processing").css("display","none");
                            }
                                // ,
                                // success:function(data)
                                // {
                                //   console.log(data);
                                // }
                        }
                    });
                }
            });
        });
    </script>
</body>
<?php include("footer.php"); ?>