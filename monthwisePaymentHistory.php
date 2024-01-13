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

            .loader {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
            }
                .loader div {
                display: inline-block;
                position: absolute;
                left: 8px;
                width: 16px;
                background: pink;
                animation: loader 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
            }
                .loader div:nth-child(1) {
                left: 8px;
                animation-delay: -0.24s;
            }
                .loader div:nth-child(2) {
                left: 32px;
                animation-delay: -0.12s;
            }
                .loader div:nth-child(3) {
                left: 56px;
                animation-delay: 0;
            }
                @keyframes loader {
                0% {
                    top: 8px;
                    height: 64px;
                }
                50%, 100% {
                    top: 24px;
                    height: 32px;
                }
            }
        </style>

        <?php require_once("header.php");   ?>

        <script>
            $("#dyna").text("MonthWise Payment History");
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
                    <div class="box-body">
                        <div class="row">
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
                                    <button id="search1" class="btn btn-primary">Search</button>
                                    <button id="refresh" class="btn btn-warning">Refresh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-12">
                                <h3>
                                    <b>Payment History</b>
                                </h3>
                            </div>
                        </div></br>
                        <!-- <center><h3>
                                Investment Details
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
                data:{
                    limit:300,
                    start:-300,
                    records: [],
                    searchResults: [],
                    isLoading: true,
                    searchLoading: true,
                    t:'true',
                    showOriginalTable: true,
                    showSearchTable: false
                },
                methods:{
                    load_customer_data: function() 
                    {
                        let self = this;
                        let loadDirect= $.ajax({
                            url: 'ajax/CurrentMonthPayment1.php',
                            type: "POST",
                            data: {
                                currentMonthPayment:'monthwisepayment',
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
                                    self.isLoading = false;
                                    $('#example').DataTable({
                                        "paging": false,
                                        searching:false,
                                        dom: "<'row'<'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                                        buttons: ['csv', 'excel'],
                                    });
                                }else 
                                {
                                    self.records = self.records.concat(data);
                                    self.start += self.limit;
                                    self.load_customer_data();
                                }
                            },
                                error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                        console.log(loadDirect);
                    },
                    load_search_data: function(searchlimit, srarchstart, fromdate, todate)
                    {
                        var self = this;
                        let co=$.ajax({
                            url: 'ajax/CurrentMonthPayment1.php',
                            type: "POST",
                            data: {
                                currentMonthPayment:'monthwisepayment',
                                limit: searchlimit,
                                start: srarchstart,
                                d1: fromdate,
                                d2: todate,
                                k: 1,
                            },
                            cache:false,
                            success:function(data)
                            {
                                console.log(data);
                                self.showOriginalTable = false;
                                self.showSearchTable = true;
                                if (data.length === 0) 
                                {
                                    self.searchLoading = false;
                                    
                                    $('#example1').DataTable({
                                        "paging": false,
                                        searching:false,
                                        dom: "<'row'<'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                                        buttons: ['csv', 'excel'],
                                    });
                                } else {
                                    self.searchResults = self.searchResults.concat(data);
                                    self.srarchstart += self.searchlimit;
                                    self.load_search_data(self.searchlimit, self.srarchstart, fromdate, todate);
                                }
                            }
                        });
                        console.log(co);
                    },
                    fetchData: function()
                    {
                        var self = this;
                        self.load_customer_data();
                    },
                    searchClicked: function() 
                    {
                        var todate=$('#todate').val();
                        var fromdate=$('#fromdate').val();
                        if(fromdate=='')
                        {
                            alert('Please Select From Date');
                            return;
                        }
                        $('#example').DataTable().destroy();
                        var self = this;
                        // this.records = [];
                        this.searchResults = [];
                        this.searchLoading = true;
                        this.searchlimit=300;
                        this.srarchstart=-300;

                        this.load_search_data(this.searchlimit, this.srarchstart, fromdate, todate);
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
                        <div v-if="showOriginalTable">
                            <table id="example" class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Cust-ID</th>
                                        <th>Full Name</th>
                                        <th>Payment Amount</th>
                                        <th>Address</th>
                                        <th>Payment Date</th>
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
                                        <td>{{ record.place }}</td>
                                        <td>{{ record.date }}</td>
                                        <td>{{ record.bankName }}</td>
                                        <td>{{ record.accountNo }}</td>
                                        <td>{{ record.ifscCode }}</td>
                                        <td>{{ record.panCardNumber }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <center>
                                <div v-if="isLoading" class="loader"><div></div><div></div><div></div></div>
                            </center>
                        </div>
                        <div v-if="showSearchTable">
                            <table id="example1" class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Cust-ID</th>
                                        <th>Full Name</th>
                                        <th>Payment Amount</th>
                                        <th>Place</th>
                                        <th>Payment Date</th>
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
                                        <td>{{ result.place }}</td>
                                        <td>{{ result.date }}</td>
                                        <td>{{ result.bankName }}</td>
                                        <td>{{ result.accountNo }}</td>
                                        <td>{{ result.ifscCode }}</td>
                                        <td>{{ result.panCardNumber }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <center>
                                <div v-if="searchLoading" class="loader"><div></div><div></div><div></div></div>
                            </center>
                        </div>
                    </div>
                `,
            });


            
            $('#search1').click(function() {
                app.searchClicked();
            });

            // Event listener for the "Refresh" button
            $('#refresh').click(function() 
            {
                if ($.fn.DataTable.isDataTable('#example')) {
                    $('#example').DataTable().destroy();
                }
                if ($.fn.DataTable.isDataTable('#example1')) {
                    $('#example1').DataTable().destroy();
                }
                if (app.showOriginalTable) {
                    $('#example').DataTable({
                        "paging": false,
                        searching: false,
                        dom: "<'row'<'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        buttons: ['csv', 'excel'],
                    });
                }
                app.refreshClicked();
            });
        });
    </script>
</body>

