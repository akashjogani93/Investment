<body class="hold-transition skin-blue sidebar-mini">
<!-- <link rel="stylesheet" href="loader.css"> -->
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
            button.dt-button.buttons-csv.buttons-html5 {
                background-color: #4AA96C;
                color: white;
            }
            button.dt-button.buttons-excel.buttons-html5 {
                background-color: #4AA96C;
                color: white;
            }
            button.dt-button.buttons-print {
                background-color: #AF2D2D;
                color: white;
            }
            button.dt-button.buttons-pdf.buttons-html5 {
                background-color: #AF2D2D;
                color: white;
            }
        </style>
        
        <?php require_once("header.php"); ?>
        <script type="text/javascript">
            $(function() {
                
                $(".full").autocomplete({

                    source: 'widraw_searchName.php',
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
        <div class="content-wrapper" style="border:1px solid black;">
            <section class="content-header">
                <h1>
                   Investment Details
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>
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
                                                <option>Search By Amount</option>
                                                <option>Date & Amount</option>
                                                <option>Name & Amount</option>
                                                <option>Asigned By %</option>
                                                <option>Name & Date</option>
                                                
                                            </select>                
                                        </div>
                                        <div class="group-form col-md-4" id="namewise">
                                            <label for="inputEmail3" class="form_label">Search Name</label>
                                            <input  type="text" class="form-control full" name="full" id="full"
                                                     placeholder="Search Full Name" required="required">
                                            <input type="hidden" name="full1" id="full1">
                                        </div>
                                        <div class="group-form col-md-2" id="datewise1" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Select From Date</label>
                                            <input  type="date"  class="col-sm-4 form-control form-control-sm" name="fromdate" id="fromdate">
                                        </div>
                                        <div class="group-form col-md-2" id="datewise2" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Select To Date</label>
                                            <input type="date"  class="form-control" name="todate"  id="todate">
                                            <script>
                                                $(document).ready( function() {
                                                    var yourDateValue = new Date();
                                                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                                                    $('#todate').val(formattedDate);
                                                });
                                            
                                            </script>
                                        </div>
                                        <div class="group-form col-md-2" id="amt1" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Amount To Start</label>
                                            <input type="text"  class="form-control form-control-sm" name="amtstart"  id="amtstart" placeholder="Amount TO Start">
                                        </div>
                                        <div class="group-form col-md-2" id="amt2" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Amount TO Ending</label>
                                            <input type="text"  class="form-control form-control-sm" name="amtend"  id="amtend" placeholder="Amount TO Ending">
                                        </div>
                                        <div class="group-form col-md-2" id="asign" style="display: none;">
                                            <label for="inputEmail3" class="form_label">Asigned By %</label>
                                            <input type="text"  class="form-control form-control-sm" name="asi"  id="asi" placeholder="Asigned By Percentage">
                                        </div>
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" class="form_label"></label>
                                            <a type="button" id="search1" class="btn btn-primary">Load Data</a>
                                        </div>
                                    </div></br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <center><h3>
                            Investment Details
                        </h3></center>
                <div class="table-responsive" style="overflow-y:scroll; height: 560px; width:100% margin-left: 100px;" id="tablepdf">
                    <table id="employee_grid" class="nowrap table table-striped table-bordered table-hover example1">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Date</th>
                                <th>Percentage</th>
                                <th>Amount</th>
                                <th>Per Day</th>
                                <th>Per Month</th>     
                            </tr>
                        </thead>
                        <tbody id="mytable1">
                            
                        </tbody>    
                        
                    </table>
                    <!-- <center><div class="loader"></div></center> -->
                </div>
                </div>
            </section>
        </div>
        <?php include('footer.php'); ?>
    </div>

    <script>
        $(document).ready(function() 
        {
            alert('hii');
            console.log('hiii');
            // let log=$('#employee_grid').DataTable({
            // "lengthMenu": [[100, -1], [100, "All"]],
            // dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            //                     buttons: [
            //                     'csv', 'excel', 'pdf', 'print'
            //                     ],
            //             "bProcessing": true,
            //     "serverSide": true,
            //     "ajax":{
            //         url :"ajax/allInvestment.php", // json datasource
            //         type: "post",  // type of method ,GET/POST/DELETE
            //         datatype: 'json',
            //         data:{Submit:'Submit'},
            //         error: function(){
            //             $("#employee_grid_processing").css("display","none");
            //         }
            //         ,
            //         success:function(data)
            //         {
            //         console.log(data);
            //         }
            //     }
            // }); 
        });
    </script>
      <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script> -->
    <script type="text/javascript">

            // $(document).ready(function() 
            // {
            //     alert('hii');
            //     let log=$('#employee_grid').DataTable({
            //     "lengthMenu": [[100, -1], [100, "All"]],
            //     dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            //                         buttons: [
            //                         'csv', 'excel', 'pdf', 'print'
            //                         ],
            //                 "bProcessing": true,
            //         "serverSide": true,
            //         "ajax":{
            //             url :"ajax/allInvestment.php", // json datasource
            //             type: "post",  // type of method ,GET/POST/DELETE
            //             datatype: 'json',
            //             data:{Submit:'Submit'},
            //             error: function(){
            //                 $("#employee_grid_processing").css("display","none");
            //             }
            //             ,
            //             success:function(data)
            //             {
            //               console.log(data);
            //             }
            //         }
            //     }); 
            // });




        // $(document).ready(function()
        // {
        //         let log=$('#employee_grid').DataTable({
        //         "lengthMenu": [[100, -1], [100, "All"]],
        //         dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
        //         buttons: ['csv', 'excel', 'pdf', 'print'],
        //         "bProcessing": true,
        //         "serverSide": true,
        //         "ajax":{
        //             url :"ajax/allInvestments.php", // json datasource
        //             type: "post",  // type of method ,GET/POST/DELETE
        //             datatype: 'json',
        //             data:{Submit:'Submit'},
        //             error: function(){
        //                 $("#employee_grid_processing").css("display","none");
        //             }
        //             ,
        //             success:function(data)
        //             {
        //                 console.log(data);
        //             }
        //         }
        //         }); 
            // let log=$.ajax({
            //     url:"ajax/allInvestments.php",
            //     method:"POST",
            //     data:{Submit:"submit"},
            //     cache:false,
            //     success:function(data)
            //     {
            //         $('#mytable1').append(data);
            //         //alert('hii');
            //         $('.loader').fadeOut();
            //         loading();
            //     }
            // });

            // $('#namewise').show();
            // $('#datewise1').hide();
            // $('#datewise3').hide();
            // $('#amt1').hide();
            // $('#amt2').hide();
            // $('#asign').hide();
            // $('#select').change(function()
            // {
            //     var option=$(this).val();
            //     //console.log(option);
            //     if(option=="Search By Date")
            //     {
            //         $('#namewise').hide();
            //         $('#amt1').hide();
            //         $('#amt2').hide();
            //         $('#datewise1').show();
            //         $('#datewise2').show();
                    
            //     }
            //     else if(option=="Search By Name")
            //     {
            //         $('#namewise').show();
            //         $('#datewise1').hide();
            //         $('#datewise2').hide();
            //         $('#amt1').hide();
            //         $('#amt2').hide();
            //     }
            //     else if(option=="Search By Amount")
            //     {
            //         $('#namewise').hide();
            //         $('#datewise1').hide();
            //         $('#datewise2').hide();
            //         $('#amt1').show();
            //         $('#amt2').show();
            //     }
            //     else if(option=="Date & Amount")
            //     {
            //         $('#namewise').hide();
            //         $('#datewise1').show();
            //         $('#datewise2').show();
            //         $('#amt1').show();
            //         $('#amt2').show();
            //     }
            //     else if(option=="Name & Amount")
            //     {
            //         $('#namewise').show();
            //         $('#amt1').show();
            //         $('#amt2').show();
            //         $('#datewise1').hide();
            //         $('#datewise2').hide();
            //         $('#asign').hide();
            //     }
            //     else if(option=="Asigned By %")
            //     {
            //         $('#asign').show();
            //         $('#namewise').hide();
            //         $('#amt1').hide();
            //         $('#amt2').hide();
            //         $('#datewise1').hide();
            //         $('#datewise2').hide();
            //     }
            //     else
            //     {
            //         $('#namewise').show();
            //         $('#datewise1').show();
            //         $('#datewise2').show();
            //         $('#amt1').hide();
            //         $('#amt2').hide();
            //     }
            // });

            // $('#search1').click(function()
            // {
            //     //alert('hii');
                
            //     var table = $('#example1').DataTable();
            //     // $('#tableDestroy').on( 'click', function () {
            //         table.destroy();
            //     // } );
            //     var filter=$('#select').val();
            //     if(filter=="Search By Name")
            //     {
            //         //console.log(filter);
            //         $('#fromdate').val('');
            //         $('#amtstart').val('');
            //         $('#amtend').val('');
            //         $('#asi').val('');
            //         var cid=$('#full1').val();
            //         var name=$('#full').val();
                    
            //         if(name=='')
            //         {
            //             alert('Please Select Name');
            //             exit();
            //         }

            //         //console.log(name);
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{name:"name", cid:cid},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();
            //             }
            //         });console.log(log);
            //     }
            //     else if(filter=="Search By Date")
            //     {
            //         $('#full1').val('');
            //         $('#full').val('');
            //         $('#amtstart').val('');
            //         $('#amtend').val('');
            //         $('#asi').val('');
            //         //console.log(filter);
            //         var fromdate=$('#fromdate').val();
            //         var todate=$('#todate').val();
                    
            //         if(fromdate=='')
            //         {
            //             alert('Please Select From Date');
            //             exit();
            //         }
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{date:"date", fromdate:fromdate,todate:todate},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();

                            
            //             }
            //         });console.log(log);


            //     }
            //     else if(filter=="Search By Amount")
            //     {
            //         $('#full1').val('');
            //         $('#full').val('');
            //         $('#fromdate').val('');
            //         $('#asi').val('');
            //         var amtstart=$('#amtstart').val();
            //         var amtend=$('#amtend').val();
            //         if(amtstart=='')
            //         {
            //             alert('Add Starting Amount');
            //             exit();
            //         }
            //         else if(amtend=='')
            //         {
            //             alert('Add Ending Amount');
            //             exit();
            //         }
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{amt:"amt", amtstart:amtstart,amtend:amtend},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();
                            
            //             }
            //         });console.log(log);

            //     }
            //     else if(filter=="Date & Amount")
            //     {
            //         $('#full1').val('');
            //         $('#full').val('');
            //         $('#asi').val('');
            //         var fromdate=$('#fromdate').val();
            //         var todate=$('#todate').val();
            //         var amtstart=$('#amtstart').val();
            //         var amtend=$('#amtend').val();
            //         if(fromdate=='')
            //         {
            //             alert('Please Select From Date');
            //             exit();
            //         }
            //         else if(amtstart=='')
            //         {
            //             alert('Add Starting Amount');
            //             exit();
            //         }
            //         else if(amtend=='')
            //         {
            //             alert('Add Ending Amount');
            //             exit();
            //         }
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{dateamt:"dateamt", fromdate:fromdate,todate:todate,amtstart:amtstart,amtend:amtend},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();
                            
            //             }
            //         });console.log(log);
                    
                    
            //     }
            //     else if(filter=="Name & Amount")
            //     {
            //         $('#fromdate').val('');
            //         $('#asi').val('');
            //         var cid=$('#full1').val();
            //         var name=$('#full').val();
            //         var amtstart=$('#amtstart').val();
            //         var amtend=$('#amtend').val();
            //         if(name=='')
            //         {
            //             alert('Please Select Name');
            //             exit();
            //         }
            //         else if(amtstart=='')
            //         {
            //             alert('Add Starting Amount');
            //             exit();
            //         }
            //         else if(amtend=='')
            //         {
            //             alert('Add Ending Amount');
            //             exit();
            //         }
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{nameamt:"nameamt", cid:cid,amtstart:amtstart,amtend:amtend},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();
                            
            //             }
            //         });console.log(log);
            //     }
            //     else if(filter=="Asigned By %")
            //     {
            //         $('#full1').val('');
            //         $('#full').val('');
            //         $('#amtstart').val('');
            //         $('#amtend').val('');
            //         $('#fromdate').val('');
            //         var asign=$('#asi').val();
            //         if(asign=='')
            //         {
            //             alert('Please Add Asigned Percentage');
            //             exit();
            //         }
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{asi:"asign", asign:asign},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();
                            
            //             }
            //         });console.log(log);
            //     }
            //     else
            //     {
            //         $('#amtstart').val('');
            //         $('#amtend').val('');
            //         $('#asi').val('');
            //         var cid=$('#full1').val();
            //         var name=$('#full').val();
            //         var fromdate=$('#fromdate').val();
            //         var todate=$('#todate').val();
            //         if(name=='')
            //         {
            //             alert('Please Select Name');
            //             exit();
            //         }
            //         else if(fromdate=='')
            //         {
            //             alert('Please Select From Date');
            //             exit();
            //         }
            //         let log=$.ajax({
            //             url:"ajax/allInvestments.php",
            //             method:"POST",
            //             data:{namedate:"namedate", cid:cid,fromdate:fromdate,todate:todate},
            //             cache:false,
            //             success:function(data)
            //             {
            //                 $('.loader').fadeIn();
            //                 $('#mytable1').html(data);
            //                 $('.loader').fadeOut();
            //                 loading();
                            
            //             }
            //         });console.log(log);
            //     }
                
            // });

            // function loading()
            //     {
            //     //    alert('hii');
            //         oTable = $('#example1').dataTable({
            //             pageLength : 10,
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
        // });
    </script>
</body>