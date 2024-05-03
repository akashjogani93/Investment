<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" id="form1">
    <style>
        .error {
            color: red;
        }
        th, td { white-space: nowrap; }
        div.dataTables_wrapper { }
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
        /* table.dataTable thead {background-color:#D3E4CD} */
    </style>
<?php require_once("header.php");   
        include("js/search.php");
?>
    <script>
        $("#dyna").text("Investment & Introducer Details");
        tex();
    </script>
    <script type="text/javascript">
        $(function() 
        {
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
                <div class="box-body">
                    <div class="row">
                        <div class="group-form col-md-2" style="display: none;">
                            <label for="inputEmail3" class="form_label">Apply Filters</label>
                            <select class="col-sm-4 form-control form-control-sm" id="select" name="option">
                                <option>Search By Name</option>
                            </select>                
                        </div>
                        <div class="group-form col-md-4" id="namewise">
                            <label for="inputEmail3" class="form_label">Search Name</label>
                            <!--<input  type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full" placeholder="Search Full Name" required="required">
                            <input type="hidden" name="full1" id="full1">-->
                            <input type="hidden" name="full1" id="full1">
                            <input class="form-control" type="text" id="inputZip1" name="name1" autocomplete="off" placeholder="Search By Name">
                            <div id="list"></div>
                        </div>
                        <div class="group-form col-md-2" id="datewise1" style="display: none;">
                            <label for="inputEmail3" class="form_label">Select From Date</label>
                            <input  type="date"  class="col-sm-4 form-control form-control-sm" name="fromdate" id="fromdate">
                        </div>
                        <div class="group-form col-md-2" id="datewise2" style="display: none;">
                            <label for="inputEmail3" class="form_label">Select To Date</label>
                            <input type="date"  class="form-control" name="todate"  id="todate">
                            <script>
                                $(document).ready( function() 
                                {
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
                                <a type="button" id="refre" class="btn btn-warning">Refresh</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div></br>
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="group-form col-md-12">
                            <h3>
                                <b>Investment Details</b>
                            </h3>
                        </div>
                    </div></br>
                    <!-- <div id="tablepdf" style="overflow-x: auto; height:400px;">
                        <div id="app">
                            <my-component></my-component>
                        </div>
                    </div> -->
                    <div id="tablepdf2" style="overflow-x: auto; height:400px;">
                        <table id="example2" class="table table-striped table-bordered table-hover example1">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>In_id</th>
                                    <th>Investor Name</th>
                                    <th>Invest Date</th>
                                    <th>Invest Amount</th>
                                    <th>Assigned %</th>
                                    <th>Per Day</th>
                                    <th>Per Month</th>
                                    <th>1st Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>2nd Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>3th Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>4th Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>5th Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>6th Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>7th Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>

                                    <th>8th Introducer</th>
                                    <th>%</th>
                                    <th>Perday Amount</th>
                                    <th>T.A</th>
                                </tr>
                            </thead>
                            <tbody id="mytable2">
                            </tbody>
                            <tbody id="mytable3" style="display:none;">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script> 
</div>
    <script>
        function editupdate(cid)
        {
            if(confirm("Are you sure?")==true){
                location = "investment_edit.php?cid="+cid;
            }
        }
    </script>

    <script>
        $(document).ready(function()
        {
            var limit = 50;
            var start = -50;
            var t = "true";
            var action = 'inactive';
            function load_customer_data(limit, start)
            {
                let log=$.ajax({
                    url:"ajax/ReferalIndividual.php",
                    method:"POST",
                    data:{submit:"submit",limit:limit, start:start},
                    cache:false,
                    success:function(data)
                    {
                        $('#mytable2').append(data);
                        if(data == 0)
                        {
                            action = 'active';
                        }
                        else
                        {
                            action = "inactive";
                        }
                    }
                });
            }

            var myVar = setInterval(function()
            { 
                if(action == 'inactive')
                {
                    start = start + limit;
                    $(document.body).css({
                        'cursor': 'not-allowed'
                    });
                    load_customer_data(limit, start);
                }else{
                    clearInterval(myVar);
                    $(document.body).css({'cursor' : 'default'});
                }
            }, 300);

        $('#search1').click(function()
        {
            var name=$('#full1').val();
            let log=$.ajax({
                url:"ajax/ReferalIndividual.php",
                method:"POST",
                data:{submit:"name", name:name},
                cache:false,
                success:function(data)
                {
                     $('#mytable2').html(data);
                        action ='active';
                }
            });
        });
        $('#refre').click(function()
        {
            window.location='Refrel_Payment.php';
        });
    });
    </script>
</body>