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
        
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("NEw courEnt Month Details");
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
            <section class="content">
                <div class="box box-default">
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
                            <div class="group-form col-md-3">
                                <div class="butto" style="display:flex;  justify-content: space-between; margin-top:25px; width:80%;">
                                    <button type="button" id="search1" class="btn btn-primary">Search</button>
                                    <button id="refresh" class="btn btn-warning">Refresh</button>
                                    <button id="" class="btn btn-success" onclick="exportToExcel()">Excel</button>
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
                                    <b>  Current Month Details</b>
                                </h3>
                            </div>
                        </div></br>
                        <div id="tablepdf" style="overflow-x: auto; height:400px;">
                            <div id="app">
                                <!-- <my-component></my-component> -->
                                <!-- <table id="example" class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>cid</th>
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
                                </table> -->
                            </div>
                            <table id="example1" class="table table-striped table-bordered table-hover example1">
                                <thead>
                                    <tr>
                                        <th>cid</th>
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
                                <tbody id="searchName" style="display:none">
                                    
                                </tbody>    
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('footer.php');?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script src="reports.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function()
        {
            // var app = new Vue({
            //     el: '#app',
            //     data:{
            //         limit:50,
            //         start:-50,
            //         records: [],
            //         searchResults: [],
            //         isLoading: true,
            //         searchLoading: true,
            //         t:'true',
            //         showOriginalTable: true,
            //         showSearchTable: false
            //     },
            //     methods:{
            //         load_customer_data: function() 
            //         {
                        // let self = this;
                        // let loadDirect= $.ajax({
                        //     url: 'ajax/Fetch_data.php',
                        //     type: "POST",
                        //     data: {
                        //         limit: self.limit,
                        //         start: self.start,
                        //     },
                        //     cache: false,
                        //     success: function(data) 
                        //     {
                                
                        //         console.log(data)
                        //         if (data.length === 0) 
                        //         {
                        //             self.isLoading = false;
                        //             // if ($.fn.DataTable.isDataTable('#example')) 
                        //             // {
                        //             //     $('#example').DataTable().destroy();
                        //             // }
                        //             // $('#example').DataTable({
                        //             //     "paging": false,
                        //             //     searching:false,
                        //             //     dom: "<'row'<'col-sm-4 text-left'B><'col-sm-4'f>>tp",
                        //             //     buttons: ['csv', 'excel'],
                        //             // });
                        //         }else 
                        //         {
                        //             console.log(data);
                        //             $('#mytable1').append(data);
                        //             // self.records = self.records.concat(data);
                        //             self.start += self.limit;
                        //              self.load_customer_data();
                        //         }
                        //     },
                        //         error: function(xhr, status, error) {
                        //         console.error(error);
                        //     }
                        // });
                        // console.log(loadDirect);
                    // },
                    // load_search_data: function(searchlimit, srarchstart, fromdate, todate)
            //             {
            //                 var self = this;
            //                 let co=$.ajax({
            //                     url: 'ajax/CurrentMonthPayment1.php',
            //                     type: "POST",
            //                     data: {
            //                         currentMonthPayment:'newCurrentMonth',
            //                         limit: searchlimit,
            //                         start: srarchstart,
            //                         d1: fromdate,
            //                         d2: todate,
            //                         k: 1,
            //                     },
            //                     cache:false,
            //                     success:function(data)
            //                     {
            //                         console.log(data);
            //                         self.showOriginalTable = false;
            //                         self.showSearchTable = true;
            //                         if (data.length === 0) 
            //                         {
            //                             self.searchLoading = false;
                                        
            //                             $('#example1').DataTable({
            //                                 "paging": false,
            //                                 searching:false,
            //                                 dom: "<'row'<'col-sm-4 text-left'B><'col-sm-4'f>>tp",
            //                                 buttons: ['csv', 'excel'],
            //                             });
            //                         } else {
            //                             self.searchResults = self.searchResults.concat(data);
            //                             self.srarchstart += self.searchlimit;
            //                             self.load_search_data(self.searchlimit, self.srarchstart, fromdate, todate);
            //                         }
            //                     }
            //                 });
            //                 console.log(co);
            //             },
                            // searchClicked: function()
            //             {
            //                 var self = this;
            //                 var option=$('#select').val();
                        // if(option=='Search By Name')
                        // {
                        //     var cid=$('#full1').val();
                        //     var name=$('#full').val();
                        //     if(name=='')
                        //     {
                        //         alert('Please Select Name');
                        //         return;
                        //     }
            //                     $('#example').DataTable().destroy();
            //                     $('#example1').DataTable().destroy();
            //                     let co=$.ajax({
            //                         url: 'ajax/CurrentMonthPayment1.php',
            //                         type: "POST",
            //                         data: {
            //                             currentMonthPayment: 'newCurrentMonth',
            //                             cid: cid,
            //                             k: 2,
            //                         },
            //                         cache:false,
            //                         success:function(data)
            //                         {
            //                             // console.log(data)
            //                             self.searchLoading = false;
            //                             self.searchResults = data;
            //                             self.showOriginalTable = false;
            //                             self.showSearchTable = true;
            //                         }
            //                     });
            //                     // console.log(co);
            //                 }else
            //                 {
                                // var todate=$('#todate').val();
                                // var fromdate=$('#fromdate').val();
                                // if(fromdate=='')
                                // {
                                //     alert('Please Select From Date');
                                //     return;
                                // }
            //                     $('#example').DataTable().destroy();
            //                     this.searchResults = [];
            //                     this.searchLoading = true;
            //                     this.searchlimit=300;
            //                     this.srarchstart=-300;
            //                     this.load_search_data(this.searchlimit, this.srarchstart, fromdate, todate);
            //                 }
            //             },
                    //     fetchData: function() 
                    //     {
                    //         var self = this;
                    //         self.load_customer_data();
                    //     },
                    //     refreshClicked: function() 
                    //     {
                    //         this.showSearchTable = false;
                    //         this.showOriginalTable = true;
                    //     }
                    // },
                    // mounted: function() 
                    // {
                    //     this.fetchData();
                    // },
            //         template: `
            //             <div>
            //                 <div v-if="showOriginalTable">
                                // <table id="example" class="table table-striped table-bordered table-hover example">
                                //     <thead>
                                //         <tr>
                                //             <th>cid</th>
                                //             <th>Full Name</th>
                                //             <th>Current Payment</th>
                                //             <th>15% Of Current Payment</th>
                                //             <th>Payment Amount</th>
                                //             <th>Bank Name</th>
                                //             <th>Account No</th>
                                //             <th>IFSC Code</th>
                                //             <th>Pan Card Number</th>
                                //             <th>Date</th>
                                //         </tr>
                                //     </thead>
                                //     <tbody>
                                //         <tr v-for="(record, index) in records" :key="index">
                                //             <td>{{ record.custId }}</td>
                                //             <td>{{ record.fullName }}</td>
                                //             <td>{{ record.amount }}</td>
                                //             <td>{{ record.diduct }}</td>
                                //             <td>{{ record.currentPayment }}</td>
                                //             <td>{{ record.bankName }}</td>
                                //             <td>{{ record.accountNo }}</td>
                                //             <td>{{ record.ifscCode }}</td>
                                //             <td>{{ record.panCardNumber }}</td>
                                //             <td>{{ record.date }}</td>
                                //         </tr>
                                //     </tbody>
                                // </table>
            //                     <center>
            //                         <div v-if="isLoading" class="loader"><div></div><div></div><div></div></div>
            //                     </center>
            //                 </div>
            //                 <div v-if="showSearchTable">
            //                     <table id="example1" class="table table-striped table-bordered table-hover example">
            //                         <thead>
            //                             <tr>
            //                                 <th>cid</th>
            //                                 <th>Full Name</th>
            //                                 <th>Current Payment</th>
            //                                 <th>15% Of Current Payment</th>
            //                                 <th>Payment Amount</th>
            //                                 <th>Bank Name</th>
            //                                 <th>Account No</th>
            //                                 <th>IFSC Code</th>
            //                                 <th>Pan Card Number</th>
            //                                 <th>Date</th>
            //                             </tr>
            //                         </thead>
            //                         <tbody>
            //                             <tr v-for="(result, index) in searchResults" :key="index">
            //                                 <td>{{ result.custId }}</td>
            //                                 <td>{{ result.fullName }}</td>
            //                                 <td>{{ result.amount }}</td>
            //                                 <td>{{ result.diduct }}</td>
            //                                 <td>{{ result.currentPayment }}</td>
            //                                 <td>{{ result.bankName }}</td>
            //                                 <td>{{ result.accountNo }}</td>
            //                                 <td>{{ result.ifscCode }}</td>
            //                                 <td>{{ result.panCardNumber }}</td>
            //                                 <td>{{ result.date }}</td>
            //                             </tr>
            //                         </tbody>
            //                     </table>
            //                     <center>
            //                         <div v-if="searchLoading" class="loader"><div></div><div></div><div></div></div>
            //                     </center>
            //                 </div>
            //             </div>
                    // `,
                // });

                // $('#search1').click(function() {
                //     app.searchClicked();
                // });
            //     $('#refresh').click(function() 
            //     {
            //         if(app.showOriginalTable==false)
            //         {
            //             $("#full1").val('');
            //             $("#full").val('');
            //             $('#fromdate').val('');
            //             app.refreshClicked();
            //         }else
            //         {
            //             alert('First Search Something..');
            //         }

            //         if ($.fn.DataTable.isDataTable('#example')) 
            //         {
            //             $('#example').DataTable().destroy();
            //         }
            //         if ($.fn.DataTable.isDataTable('#example1')) {
            //             $('#example1').DataTable().destroy();
            //         }

            //         if (app.showOriginalTable) 
            //         {
            //             $('#example').DataTable({
            //                 "paging": false,
            //                 searching: false,
            //                 dom: "<'row'<'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            //                 buttons: ['csv', 'excel'],
            //             });
            //         }
            //     }); 

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
        });

        $(document).ready(function()
        {
            var limit = 50;
            var start = -50;
            var ser_limit = 50;
            var ser_start = -50;
            var t = "true";
            var action = 'inactive';
            var search_action='inactive';
            var todate='todate';
            var fromdate='from';
            var monthwise="newcurrent";
            function load_customer_data(limit, start) 
            {
                let log=$.ajax({
                    url: "ajax/Fetch_data.php",
                    method: "POST",
                    data: {
                        limit: limit,
                        start: start,
                        newCurrentMonth:'firstLoad',
                        cid:'cid',
                        todate:todate,
                        fromdate:fromdate,
                        monthwise:monthwise,
                    },
                    cache: false,
                    success: function(data) 
                    {
                        $('#mytable1').append(data);

                        if (data == 0) {
                            action = 'active';
                        } else {
                            action = "inactive";
                        }
                    }
                });
            }
            var myVar = setInterval(function() 
            {
                console.log('running');
                if (action == 'inactive') {
                    start = start + limit;
                    $(document.body).css({
                        'cursor': 'not-allowed'
                    });
                    load_customer_data(limit, start);

                } else {
                    clearInterval(myVar);
                    $(document.body).css({
                        'cursor': 'default'
                    });
                    $('#example thead th').each(function(i) {
                        calculateColumn(i);
                    });
                }
            }, 300);

            $('#search1').click(function() 
            {
                var todate='todate';
                var fromdate='from';
                var option=$('#select').val();
                if(option=='Search By Name')
                {
                    var cid=$('#full1').val();
                    var name=$('#full').val();
                    if(name=='')
                    {
                        alert('Please Select Name');
                        return;
                    }
                    $('#mytable1').hide();
                    $('#searchName').show();

                    let logcheck=$.ajax({
                        url: "ajax/Fetch_data.php",
                        method: "POST",
                        data: {
                            limit: limit,
                            start: start,
                            newCurrentMonth:'searchName',
                            cid:cid,
                            todate:todate,
                            fromdate:fromdate,
                            monthwise:monthwise,
                        },
                        cache: false,
                        success: function(data) 
                        {
                            console.log(data);
                            $('#searchName').empty();
                            $('#searchName').append(data);
                        }
                    });
                    console.log(logcheck);
                }else
                {
                    var todate=$('#todate').val();
                    var fromdate=$('#fromdate').val();
                    if(fromdate=='')
                    {
                        alert('Please Select From Date');
                        return;
                    }
                    $('#mytable1').hide();
                    $('#searchName').show();
                    $('#searchName').empty();
                    var myVar1 = setInterval(function() 
                    {
                        if (search_action == 'inactive') 
                        {
                            ser_start = ser_start + ser_limit;
                            $(document.body).css({
                                'cursor': 'not-allowed'
                            });
                            load_customer_data_date(ser_limit, ser_start);
                        } 
                        else 
                        {
                            clearInterval(myVar1);
                            $(document.body).css({
                                'cursor': 'default'
                            });
                            $('#example thead th').each(function(i) {
                                calculateColumn(i);
                            });
                        }
                    }, 300);

                    function load_customer_data_date(limit, start) 
                    {
                        let log=$.ajax({
                            url: "ajax/Fetch_data.php",
                            method: "POST",
                            data: {
                                limit: limit,
                                start: start,
                                newCurrentMonth:'datesearch',
                                cid:'cid',
                                todate:todate,
                                fromdate:fromdate,
                                monthwise:monthwise,
                            },
                            cache: false,
                            success: function(data) 
                            {

                                $('#searchName').append(data);
                                if (data == 0) {
                                    search_action = 'active';
                                } else {
                                    search_action = "inactive";
                                }
                            }
                        });
                    }
                }
                
            });
            $('#refresh').click(function() 
            {
                $('#searchName').hide();
                $('#mytable1').show();
            });
        });
    </script>
<script>
   function exportToExcel() {
    var table = document.getElementById("example1");
    var data = [];

    // Add the header row data
    var headerRow = [];
    var headerCells = table.getElementsByTagName("th");
    for (var i = 0; i < headerCells.length; i++) {
        headerRow.push(headerCells[i].innerText);
    }
    data.push(headerRow);

    // Add the data rows
    var tbodyToExport = $('#mytable1').is(':visible') ? $('#mytable1') : $('#searchName');
    var rows = tbodyToExport.find('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var rowData = [];

        for (var j = 0; j < cells.length; j++) {
            rowData.push(cells[j].innerText);
        }

        data.push(rowData);
    }

    var ws = XLSX.utils.aoa_to_sheet(data);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

    var fileName = "account_data.xlsx";
    XLSX.writeFile(wb, fileName);
}
</script>
</body>



