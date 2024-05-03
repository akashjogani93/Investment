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
                            <table id="example1" class="table table-striped table-bordered table-hover example1">
                                <thead>
                                    <tr>
                                        <th>cid</th>
                                        <th>Full Name</th>
                                        <th>Current Payment</th>
                                        <th>15% Of Current Payment</th>
                                        <th>Payment Amount</th>
                                        <th>Place</th>
                                        <th>Bank Name</th>
                                        <th>Account No</th>
                                        <th>IFSC Code</th>
                                        <th>Pan Card Number</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="mytable1">
                                    
                                </tbody>   
                                <!--<tbody id="searchName" style="display:none">
                                </tbody>-->
                                <tfoot>
                                    <tr class="tfut">
                                        <th colspan="2"></th>
                                        <th id="tpay"></th>
                                        <th id="tfive"></th>
                                        <th id="tamt"></th>
                                        <th colspan="4"></th>
                                    </tr>
                                </tfoot>
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
            var todate='todate';
            var fromdate='from';
            var monthwise="newcurrent";

            var limit = 15;
            var start = -15;
            var t = "true";
            var action = 'inactive';

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
                        if (data == 0) 
                        {
                            action = 'active';
                            $('.tfut:last').show();
                        } else {
                            action = "inactive";
                        }
                    }
                });
                // console.log(log)
            }
            var myVar = setInterval(function() 
            {
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
                    $('#example1 thead th').each(function(i) 
                    {
                        calculateColumn(i);
                    });
                }
            }, 300);

            $('#search1').click(function() 
            {
                $('table tfoot').remove();
                var name = $('#full1').val();
                var type = $('#select').val();
                if (type == 'Search By Name') 
                {
                    //     $.ajax({
                    //         url: "ajax_code/new_payment_report_ajax.php",
                    //         method: "POST",
                    //         data: {
                    //             submit: "submit",
                    //             name: name
                    //         },
                    //         cache: false,
                    //         success: function(data) {
                    //             action = "active";
                    //             $('#mytable').html(data);
                    //             clearInterval(myVar);
                    //         }
                    //     });
                }
                if(type=='Search By Date')
                {
                    var d1 = $('#fromdate').val();
                    var d2 = $('#todate').val();
                    $(document.body).css({
                        'cursor': 'wait'
                    });

                    let log=$.ajax({
                        url: "ajax/new_payment_report_ajax1.php",
                        method: "POST",
                        data: 
                        {
                            submit: "submit",
                            option: type,
                            d1: d1,
                            d2: d2
                        },
                        cache: false,
                        success: function(data) 
                        {
                            $('#mytable1').html(data);
                            $(document.body).css({
                                'cursor': 'default'
                            });
                        }
                    });
                    console.log(log);
                }
            });

            $('#reset').click(function() {
                window.location = 'new_payment_report.php';
            });
        });

        function calculateColumn(index) 
        {
            console.log('running');
            var total= total1 = total2 = 0;
            $('#mytable1 tr').each(function() 
            {
                var value = parseFloat($('.pay', this).eq(index).text());
                var value1 = parseFloat($('.five', this).eq(index).text());
                var value2 = parseFloat($('.famt', this).eq(index).text());
               // alert(value);
                if (!isNaN(value)) 
                {
                    total += value;
                    total1 += value1;
                    total2 += value2;
                }
            });
            $('table tfoot #tpay').eq(index).text(round(total));
            $('table tfoot #tfive').eq(index).text(round(total1));
            $('table tfoot #tamt').eq(index).text(round(total2));
        }
        function round(number) 
        {
            return Math.round(number);
        }
    </script>

<script>
   function exportToExcel() 
   {
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



