<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
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
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <form class="form-horizontal" id="addform" action="store_insert.php" method="POST"> -->
                                <div class="box-body">
                                    <div class="group-form col-md-6" id="namewise">
                                        <label for="inputEmail3" class="form_label">Search Name</label>
                                        <input  type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full" placeholder="Search Full Name" required="required">
                                        <input type="hidden" name="full1" id="full1">
                                    </div>
                                    <div class="group-form col-md-1">
                                        <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                        <button id="search1" class="btn btn-primary">Load Data</button>
                                    </div>
                                    <div class="group-form col-md-1">
                                        <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                        <button id="refresh" class="btn btn-warning">Refresh</button>
                                    </div>
                                </div>
                            <!-- </form> -->
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
                        <!-- <center><h3>
                            Current Month Details
                        </h3></center> -->
                        <div id="tablepdf" style="overflow-x: auto; height:400px;">
                            <div id="app">
                                <my-component></my-component>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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

    <script>
        $(document).ready(function()
        {
            var app = new Vue({
                el: '#app',
                data: {
                    limit: 500,
                    start: -500,
                    t: "true",
                    action: 'inactive',
                    records: [],
                    searchResults: [],
                    isLoading: true,
                    showOriginalTable: true,
                    showSearchTable: false
                },
                methods: {
                    load_customer_data: function() 
                    {
                        let self = this;
                        let ss= $.ajax({
                            url: 'ajax/CurrentMonthPayment1.php',
                            type: "POST",
                            data: {
                            currentMonthPayment: 'currentMonthPayment',
                            limit: self.limit,
                            start: self.start,
                            k: 0,
                            },
                            cache: false,
                            success: function(data) 
                            {
                                console.log(data)
                                if (data.length === 0) 
                                {
                                    self.action = 'active';
                                    self.isLoading = false;
                                    // loading();
                                    $('#example').DataTable({
                                        "paging": false,
                                        searching:false,
                                        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                                        buttons: ['csv', 'excel'],
                                    });
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
                    },
                    searchClicked: function() 
                    {
                        var cid = $('#full1').val();
                        var name = $('#full').val();
                        if (name === '') {
                            alert('Please Select Name');
                            return;
                        }
                        var self = this;
                        let co=$.ajax({
                            url: 'ajax/CurrentMonthPayment1.php',
                            type: "POST",
                            data: {
                                currentMonthPayment: 'currentMonthPayment',
                                cid: cid,
                                k: 1,
                            },
                            cache:false,
                            success:function(data)
                            {
                                self.searchResults = data;
                                self.showOriginalTable = false;
                                self.showSearchTable = true;
                                $('#example').DataTable().destroy();
                            }
                        });
                    },
                    refreshClicked: function() 
                    {
                        this.showSearchTable = false;
                        this.showOriginalTable = true;
                    }
                },
                mounted: function() {
                    this.fetchData();
                },
                template: `
                    <div>
                        <div v-if="showOriginalTable && records.length > 0">
                        <table id="example" class="table table-striped table-bordered table-hover example">
                            <thead>
                            <tr>
                                <th>Cust-ID</th>
                                <th>Full Name</th>
                                <th>Total Investment</th>
                                <!--<th>Till Date Payment</th>-->
                                <th>Current Payment</th>
                                <th>Bank Name</th>
                                <th>Account No</th>
                                <th>IFSC Code</th>
                                <th>Pan Card Number</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(record, index) in records" :key="index">
                                    <td>{{ record.custId }}</td>
                                    <td>{{ record.fullName }}</td>
                                    <td>{{ record.totalInvestment }}</td>
                                    <!--<td>{{ record.tillDatePayment }}</td>-->
                                    <td>{{ record.currentPayment }}</td>
                                    <td>{{ record.bankName }}</td>
                                    <td>{{ record.accountNo }}</td>
                                    <td>{{ record.ifscCode }}</td>
                                    <td>{{ record.panCardNumber }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <center><div v-if="isLoading" class="loader">Loading...</div></center>
                        </div>
                        <div v-if="showSearchTable">
                        <table id="example1" class="table table-striped table-bordered table-hover example">
                            <thead>
                                <tr>
                                    <th>Cust-ID</th>
                                    <th>Full Name</th>
                                    <th>Total Investment</th>
                                    <!--<th>Till Date Payment</th>-->
                                    <th>Current Payment</th>
                                    <th>Bank Name</th>
                                    <th>Account No</th>
                                    <th>IFSC Code</th>
                                    <th>Pan Card Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(result, index) in searchResults" :key="index">
                                    <td>{{ result.custId }}</td>
                                    <td>{{ result.fullName }}</td>
                                    <td>{{ result.totalInvestment }}</td>
                                    <!--<td>{{ result.tillDatePayment }}</td>-->
                                    <td>{{ result.currentPayment }}</td>
                                    <td>{{ result.bankName }}</td>
                                    <td>{{ result.accountNo }}</td>
                                    <td>{{ result.ifscCode }}</td>
                                    <td>{{ result.panCardNumber }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                `,
            });

            $('#search1').click(function() {
                app.searchClicked();
            });
            $('#refresh').click(function() 
            {
                $("#full1").val('');
                $("#full").val('');
                app.refreshClicked();

                if ($.fn.DataTable.isDataTable('#example')) {
                    $('#example').DataTable().destroy();
                }

                if (app.showOriginalTable) {
                    $('#example').DataTable({
                        "paging": false,
                        searching: false,
                        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        buttons: ['csv', 'excel'],
                    });
                }
            }); 
        });
    </script>


    <script>
            function loading()
            {
                oTable = $('#example').dataTable({
                    "paging": false,
                    searching:false,
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    buttons: ['csv', 'excel'],
                });
            }
            // function loading1()
            // {
            //     oTable = $('#example1').dataTable({
            //         "paging": false,
            //         searching:false,
            //         dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            //         buttons: ['csv', 'excel'],
            //     });
            // }
        
    </script>
</body>

<?php include('footer.php'); ?>

