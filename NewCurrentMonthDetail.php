<body class="hold-transition skin-blue sidebar-mini">
<!-- <link rel="stylesheet" href="loader.css"> -->
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            
            /* Ensure that the demo table scrolls */
            th, td { white-space: nowrap; }
            
            div.dataTables_wrapper {
               
                
            }
            
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
        
        <?php require_once("header.php"); 
            
        ?>
        <script>
            $("#dyna").text("Investment Details");
            tex();
        </script>
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
            <!-- <section class="content-header">
                <h1>
                   Investment Details
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" action="store_insert.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="group-form col-md-2">
                                            <label for="inputEmail3" class="form_label">Apply Filters</label>
                                            <select class="col-sm-4 form-control form-control-sm" id="select" name="option">
                                                <option>Search By Name</option>
                                                <option>Search By Date</option>
                                                <!--<option>Search By Amount</option>
                                                <option>Name & Amount</option>
                                                <option>Name & Date</option> -->
                                                
                                            </select>                
                                        </div>
                                        <div class="group-form col-md-4" id="namewise">
                                            <label for="inputEmail3" class="form_label">Search Name</label>
                                            <input  type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full" placeholder="Search Full Name" required="required">
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
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                            <a type="button" id="search1" class="btn btn-primary">Load Data</a>
                                        </div>
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                            <a href="NewCurrentMonthDetail.php" id="search" class="btn btn-warning">Refresh</a>
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
                                    <b>  Current Month Details</b>
                                </h3>
                            </div>
                        </div></br>
                        <div id="tablepdf" style="overflow-x: auto; height:400px;">
                            <div id="app">
                                <my-component></my-component>
                            </div>
                            <!-- <table id="example1" class="table table-striped table-bordered table-hover example1">
                                <thead>
                                    <tr>
                                        <th>Cust-ID</th>
                                        <th>Full Name</th>
                                        <th>Current Payment</th>
                                        <th>15% Of Current Payment</th>
                                        <th>Payment Amount</th>
                                        <th>Bank Name</th>
                                        <th>Account No</th>
                                        <th>IFSC Code</th>
                                        <th>Pan Card Number</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="mytable1">
                                    
                                </tbody>    
                                
                            </table> -->
                            
                            <!-- <center><div class="loader"></div></center> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
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

            var app = new Vue({
                el: '#app',
                data: {
                    limit: 500,
                    start: -500,
                    t: "true",
                    action: 'inactive',
                    action1: 'inactive',
                    records: [],
                    searchResults: [],
                    isLoading: true,
                    showOriginalTable: true,
                    showSearchTable: false
                },
                methods:{
                    load_customer_data: function() {
                        let self = this;
                        let ss= $.ajax({
                            url: 'ajax/CurrentMonthPayment1.php',
                            type: "POST",
                            data: {
                                currentMonthPayment:'newCurrentMonth',
                                limit: self.limit,
                                start: self.start,
                                k: 0,
                            },
                            cache: false,
                            success: function(data) 
                            {
                                console.log(data);
                                if (data.length === 0) {
                                    self.action = 'active';
                                    self.isLoading = false;
                                    loading();
                                } else {
                                    self.records = self.records.concat(data);
                                    self.start += self.limit;
                                    self.load_customer_data();
                                }
                            },
                                error: function(xhr, status, error) {
                                console.error(error);
                            }
                       });
                       console.log(ss);
                    },
                    fetchData: function() {
                        var self = this;
                        self.load_customer_data();
                    }

                },
                mounted: function() {
                    this.fetchData();
                },
                template: `
                    <div>
                    <table v-if="showOriginalTable && records.length > 0" id="example" class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <th>Cust-ID</th>
                                <th>Full Name</th>
                                <th>Current Payment</th>
                                <th>15% Of Current Payment</th>
                                <th>Payment Amount</th>
                                <th>Bank Name</th>
                                <th>Account No</th>
                                <th>IFSC Code</th>
                                <th>Pan Card Number</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(record, index) in records" :key="index">
                                <td>{{ record.custId }}</td>
                                <td>{{ record.fullName }}</td>
                                <td>{{ record.amount }}</td>
                                <td>{{ record.diduct }}</td>
                                <td>{{ record.currentPayment }}</td>
                                <td>{{ record.bankName }}</td>
                                <td>{{ record.accountNo }}</td>
                                <td>{{ record.ifscCode }}</td>
                                <td>{{ record.panCardNumber }}</td>
                                <td>{{ record.date }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <div v-if="isLoading" class="loader">Loading...</div>
                    </center>
                    <table v-if="showSearchTable" id="example1" class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <th>Cust-ID</th>
                                <th>Full Name</th>
                                <th>Current Payment</th>
                                <th>15% Of Current Payment</th>
                                <th>Payment Amount</th>
                                <th>Bank Name</th>
                                <th>Account No</th>
                                <th>IFSC Code</th>
                                <th>Pan Card Number</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(result, index) in searchResults" :key="index">
                                <td>{{ result.custId }}</td>
                                <td>{{ result.fullName }}</td>
                                <td>{{ result.totalInvestment }}</td>
                                <td>{{ result.place }}</td>
                                <td>{{ result.date }}</td>
                                <td>{{ result.bankName }}</td>
                                <td>{{ result.accountNo }}</td>
                                <td>{{ result.ifscCode }}</td>
                                <td>{{ result.panCardNumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                `,
            });
            // var limit = 100;
            // var start = -100;
            // var t="true";
            // var action = 'inactive';
            // function load_customer_data(limit,start)
            // {
            //     let log = $.ajax({
            //         url: 'ajax/CurrentMonthPayment1.php',
            //         type: "POST",
            //         data: {
            //             Submit:'submit',
            //             limit: limit,
            //             start: start,
            //             k : 1,
            //         },
            //         cache:false,
            //         success:function(data) 
            //         {
            //             $('#mytable1').append(data);
            //             if(data == 0)
            //             {
            //             action = 'active';
            //             }
            //             else
            //             {
            //             action = "inactive";
            //             }
                                
            //                 }
            //             });
            //             console.log(log)
            // }

            // var myVar = setInterval(function(){ 
            //     if(action == 'inactive')
            //     {
            //         start = start + limit;
            //         $(document.body).css({'cursor' : 'not-allowed'});
            //         load_customer_data(limit, start);
            //      }
            //      else{
            //             clearInterval(myVar);
            //             $(document.body).css({'cursor' : 'default'});
            //             loading()
            //         }
            // }, 300);

            $('#namewise').show();
            $('#datewise1').hide();
            $('#datewise3').hide();
            $('#select').change(function()
            {
                var option=$(this).val();
                //console.log(option);
                if(option=="Search By Date")
                {
                    $('#namewise').hide();
                    $('#datewise1').show();
                    $('#datewise2').show();
                    
                }
                else if(option=="Search By Name")
                {
                    $('#namewise').show();
                    $('#datewise1').hide();
                    $('#datewise2').hide();
                }
            });
            // $('#search1').click(function()
            // {
            //     var option=$('#select').val();
            //     if(option=='Search By Name')
            //     {
            //         var cid=$('#full1').val();
            //         var name=$('#full').val();
            //         if(name=='')
            //         {
            //             alert('Please Select Name');
            //             exit();
            //         }
            //             // var table=$('#example').dataTable()
            //             //     table.destroy();
            //         let log=$.ajax({
            //             url: 'ajax/CurrentMonthPayment1.php',
            //             type: "POST",
            //             data:{Submit:"cid", cid:cid,k:1},
            //             cache:false,
            //             success:function(data)
            //             {
                            
            //                     action="active";
            //                 $('#mytable').html(data);
            //                 clearInterval(myVar);
            //             }
            //         });
            //         console.log(log);
            //     }
            // });
            function loading()
            {
                oTable = $('#example').dataTable({
                    "paging": false,
                    searching:false,
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    buttons: [
                    'csv', 'excel'
                    ],
                });
            }
            function loading1()
            {
                oTable = $('#example1').dataTable({
                    "paging": false,
                    searching:false,
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    buttons: [
                    'csv', 'excel'
                    ],
                });
            }
        });
    </script>


</body>



