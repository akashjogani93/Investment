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
                /* background-color: #E5DCC3; */
                padding:15px; 
            }
            .table-striped>tbody>tr:nth-child(even)>td,
            .table-striped>tbody>tr:nth-child(even)>th 
            {
                /* background-color: #C9CCD5; */
                padding:15px;
            }

            table.dataTable thead {background-color:#D3E4CD}
            .col-sm-4.text-center {
                padding-left: 103px;
            }
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
        <?php require_once("header.php");
        include("js/search.php");
        ?>
        <script>
            $("#dyna").text("Individual Payment Details");
            tex();

            function myFunction() {
                const element = document.getElementById("employee_grid1");
                element.scrollIntoView();
                // <button onclick="myFunction()">Scroll</button>
            }

        </script>
        
        <script type="text/javascript">
            // $(function() {
                
            //     $(".full").autocomplete({

            //         source: 'investment_searchName.php',
            //         focus: function (event, ui) {
            //             event.preventDefault();
            //             $("#full").val(ui.item.label);
            //         },
            //         select: function (event, ui) {
            //             event.preventDefault();
            //             $("#full1").val(ui.item.value);
            //             $("#full").val(ui.item.label);
            //     }
                    
            //     });
                
                
            // });
        </script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" action="store_insert.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <!-- <div class="group-form col-md-2">
                                            <label for="inputEmail3" class="form_label">Apply Filters</label>
                                            <select class="col-sm-4 form-control form-control-sm" id="select" name="option">
                                                <option>Search By Name</option>
                                                <option>Search By Date</option>
                                                <option>Search By Amount</option>
                                                <option>Name & Amount</option>
                                                <option>Name & Date</option>
                                                
                                            </select>                
                                        </div> -->
                                        <div class="group-form col-md-4" id="namewise">
                                            <label for="inputEmail3" class="form_label">Search Name</label>
                                            <!-- <input  type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full" placeholder="Search Full Name" required="required"> -->
                                            <input class="form-control" type="text" id="inputZip1" name="name1" autocomplete="off" placeholder="Search By Name">
                                            <div id="list"></div>
                                            <input type="hidden" name="full1" id="full1">
                                        </div>
                                        <div class="group-form col-md-2" id="datewise1">
                                            <label for="inputEmail3" class="form_label">Select From Date</label>
                                            <input  type="date"  class="col-sm-4 form-control form-control-sm" name="fromdate" id="fromdate">
                                        </div>
                                        <div class="group-form col-md-2" id="datewise2">
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
                                        <div class="group-form col-md-2">
                                            <div class="butto" style="display:flex;  justify-content: space-between; margin-top:25px; width:80%;">
                                                <a type="button" id="search1" class="btn btn-primary">Search</a>
                                                <a href="single_payment_report.php" id="search" class="btn btn-warning">Refresh</a>
                                            </div>
                                        </div>
                                    </div></br>
                                    <!-- <div class="row">
                                        <div class="col-md-2 pt-3">
                                            <input class="b2 btn-sm btn-warning" type="button" onclick="exportTableToExcel('example', 'members')" value="Excel" >
                                            <input class="b2 btn-sm btn-warning" type="button" onclick="printPageArea('tablepdf');"  value="PDF" >
                                        </div>
                                    </div> -->
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
                                    <b> Investment Details</b>
                                </h3>
                            </div>
                        </div></br>
                  
                    <!-- <table id="example1" class="cell-border" cellspacing="0" style="width:100%"> -->
                    <div class="table-responsive" style="overflow-y:scroll; width:100% margin-left: 100px;" id="tablepdf">
                        <table id="employee_grid" class="table table-striped table-bordered table-hover example1">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Account No.</th>
                                    <th>Invest Date</th>
                                    <th>Invest Amount</th>
                                    <th>Assigned %</th>
                                    <th>Per Day</th>
                                    <th>Total Days</th>
                                    <th>Total Interest</th>
                                    <th>Month Amount</th>
                                </tr>
                            </thead>
                            <tbody id="mytable1">
                                
                            </tbody>    
                        </table>
                        <!-- <center><div class="loader"></div></center> -->
                    </div>
                </div>
                <div class="box refral">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-12">
                                <h3>
                                    <b> Referral Amount</b>
                                </h3>
                            </div>
                        </div></br>
                    <div class="table-responsive" style="overflow-y:scroll; height: 560px; width:100% margin-left: 100px;" id="tablepdf">
                        <table id="employee_grid1" class="table table-striped table-bordered table-hover example2" >
                            <thead>
                                <tr>
                                    <th>Invest Id</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Assign %</th>
                                    <th>Per Day</th>
                                    <th>Total Days</th>
                                    <th>Total Interest</th>
                                    <th>Month Amount</th>
                                </tr>
                            </thead>
                            <tbody id="mytable2">

                            </tbody>
                            
                        </table>
                        <!-- <center><div class="loader"></div></center> -->
                        
                    </div>
                </div>
            </section>
            
        </div>
        <?php include('footer.php'); ?>
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
        $(document).ready(function()
        {

            // let log=$('#employee_grid').DataTable({
            //     "lengthMenu": [[100, -1], [100, "All"]],
            //     searching:false,
            //     dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            //                         buttons: [
            //                         'csv', 'excel'
            //                         ],
            //                 "bProcessing": true,
            //         "serverSide": true,
            //         "ajax":{
            //             url :"ajax/allIndividual.php", // json datasource
            //             type: "post",  // type of method ,GET/POST/DELETE
            //             datatype: 'json',
            //             data:{submit:'Submit'},
            //             error: function(){
            //                 $("#employee_grid_processing").css("display","none");
            //             }
            //             // ,
            //             // success:function(data)
            //             // {
            //             //   console.log(data);
            //             // }
            //         }
            //     });  

                // let log2=$('#employee_grid1').DataTable({
                // "lengthMenu": [[100, -1], [100, "All"]],
                // searching:false,
                // dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                //                     buttons: [
                //                     'csv', 'excel'
                //                     ],
                //             "bProcessing": true,
                //     "serverSide": true,
                //     "ajax":{
                //         url :"ajax/allIndividual.php", // json datasource
                //         type: "post",  // type of method ,GET/POST/DELETE
                //         datatype: 'json',
                //         data:{submit1:'Submit'},
                //         error: function(){
                //             $("#employee_grid1_processing").css("display","none");
                //         }
                //         // ,
                //         // success:function(data)
                //         // {
                //         //   console.log(data);
                //         // }
                //     }
                // });

            $('#namewise').show();
            // $('#datewise1').hide();
            // $('#datewise3').hide();
            $('#amt1').hide();
            $('#amt2').hide();
            $('#asign').hide();
            $('#select').change(function()
            {
                var option=$(this).val();
                if(option=="Search By Date")
                {
                    $('#namewise').hide();
                    $('#amt1').hide();
                    $('#amt2').hide();
                    $('#datewise1').show();
                    $('#datewise2').show();
                    
                }
                else if(option=="Search By Name")
                {
                    $('#namewise').show();
                    $('#datewise1').hide();
                    $('#datewise2').hide();
                    $('#amt1').hide();
                    $('#amt2').hide();
                }
                else if(option=="Search By Amount")
                {
                    $('#namewise').hide();
                    $('#datewise1').hide();
                    $('#datewise2').hide();
                    $('#amt1').show();
                    $('#amt2').show();
                }
                else if(option=="Name & Amount")
                {
                    $('#namewise').show();
                    $('#amt1').show();
                    $('#amt2').show();
                    $('#datewise1').hide();
                    $('#datewise2').hide();
                    $('#asign').hide();
                }
                else
                {
                    $('#namewise').show();
                    $('#datewise1').show();
                    $('#datewise2').show();
                    $('#amt1').hide();
                    $('#amt2').hide();
                }
            });
            $('#search1').click(function()
            {
                var cid=$('#full1').val();
                var name=$('#full').val();
                var from=$('#fromdate').val();
                var to= $('#todate').val();
                if(cid=='')
                {
                    alert('Please Select Name');
                    exit();
                }
                if(from=='')
                {
                    alert('Please Select From Date');
                    exit();
                }
                var table=$('#employee_grid').DataTable();
                    table.destroy();
                let log=$('#employee_grid').DataTable({
                    "lengthMenu": [[100, -1], [100, "All"]],
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    buttons:['csv','excel'],
                    "bProcessing": true,
                    "serverSide": true,
                    "ajax":{
                        url :"ajax/allIndividual.php",
                        type: "post",
                        datatype: 'json',
                        data:{submit:'cid',cid:cid,from:from,to:to},
                        error: function()
                        {
                            $("#employee_grid_processing").css("display","none");
                        }
                        //,
                        // success:function(data)
                        // {
                                //console.log(data);
                        // }
                    }
                });

                var table1=$('#employee_grid1').DataTable();
                    table1.destroy(); 
                let log2=$('#employee_grid1').DataTable({
                        "lengthMenu": [[100, -1], [100, "All"]],
                        searching:false,
                        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        buttons: ['csv', 'excel'],
                        "bProcessing": true,
                        "serverSide": true,
                        "ajax":{
                            url :"ajax/allIndividual.php",
                            type: "post",
                            datatype: 'json',
                            // data:{submit1:'cid',cid:cid,from:from,to:to},
                            data:{submit1:'Submit',cid:cid,from:from,to:to},
                            error: function()
                            {
                                $("#employee_grid1_processing").css("display","non");
                            }
                            // ,
                            // success:function(data)
                            // {
                            //   console.log(data);
                            // }
                        }
                    });
                    // console.log(log2)


                // var filter=$('#select').val();
                // if(filter=="Search By Name")
                // {
                //     $('#fromdate').val('');
                //     $('#amtstart').val('');
                //     $('#amtend').val('');
                //     var cid=$('#full1').val();
                //     var name=$('#full').val();
                //     filter=$('#select').val();
                //     if(name=='')
                //     {
                //         alert('Please Select Name');
                //         exit();
                //     }
                //     var table=$('#employee_grid').DataTable();
                //         table.destroy();

                //         let log=$('#employee_grid').DataTable({
                //                     "lengthMenu": [[100, -1], [100, "All"]],
                //                     dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                //                     buttons:['csv','excel'],
                //                     "bProcessing": true,
                //                     "serverSide": true,
                //                     "ajax":{
                //                         url :"ajax/allIndividual.php",
                //                         type: "post",
                //                         datatype: 'json',
                //                         data:{submit:'cid',cid:cid},
                //                         error: function()
                //                         {
                //                             $("#employee_grid_processing").css("display","none");
                //                         }
                //                         //,
                //                         // success:function(data)
                //                         // {
                //                         //   console.log(data);
                //                         // }
                //                 }
                //             });

                //             var table1=$('#employee_grid1').DataTable();
                //                 table1.destroy(); 

                //             let log2=$('#employee_grid1').DataTable({
                //                     "lengthMenu": [[100, -1], [100, "All"]],
                //                     dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                //                     buttons: ['csv', 'excel', 'pdf', 'print'],
                //                     "bProcessing": true,
                //                     "serverSide": true,
                //                     "ajax":{
                //                         url :"ajax/allIndividual.php",
                //                         type: "post",
                //                         datatype: 'json',
                //                         data:{submit1:'cid',cid:cid},
                //                         error: function()
                //                         {
                //                             $("#employee_grid1_processing").css("display","none");
                //                         }
                //                         // ,
                //                         // success:function(data)
                //                         // {
                //                                 //console.log(data);
                //                         // }
                //                     }
                //                 }); 
                // }else if(filter=="Search By Date")
                // {
                //     var from=$('#fromdate').val();
                //     var to= $('#todate').val();

                //     if(from=='')
                //     {
                //         alert('Please Select From Date');
                //         exit();
                //     }
                //     var table=$('#employee_grid').DataTable();
                //         table.destroy();
                    
                //     let log=$('#employee_grid').DataTable({
                //         "lengthMenu": [[100, -1], [100, "All"]],
                //         dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                //                             buttons: [
                //                             'csv', 'excel', 'pdf', 'print'
                //                             ],
                //                     "bProcessing": true,
                //             "serverSide": true,
                //             "ajax":{
                //                 url :"ajax/allIndividual.php",
                //                 type: "post",
                //                 datatype: 'json',
                //                 data:{submit:'date',from:from,to:to},
                //                 error: function()
                //                 {
                //                     $("#employee_grid_processing").css("display","none");
                //                 }
                //                 // ,
                //                 // success:function(data)
                //                 // {
                //                 //   console.log(data);
                //                 // }
                //             }
                //         });
                //         // console.log(log)
                // }
            });
        });
    </script>
    <script type="text/javascript" src="js/single_payment_report.js"></script>
   
</body>