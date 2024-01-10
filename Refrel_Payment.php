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
<?php require_once("header.php");   ?>
    <script>
        $("#dyna").text("Investment & Introducer Details");
        tex();
    </script>
    <script type="text/javascript">
        $(function() 
        {
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
                        <form class="form-horizontal" id="addform" method="POST">
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
                                    <div class="group-form col-md-1">
                                        <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                        <a type="button" id="search1" class="btn btn-primary">Search</a>
                                    </div>
                                    <div class="group-form col-md-1">
                                        <label for="inputEmail3" style="color:white;" class="form_label">..</label>
                                        <a type="button" id="refre" class="btn btn-warning">Refresh</a>
                                    </div>
                                </div></br>
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
                                <b>Investment Details</b>
                            </h3>
                        </div>
                    </div></br>
                    <div id="tablepdf" style="overflow-x: auto; height:400px;">
                        <div id="app">
                            <my-component></my-component>
                        </div>
                    </div>
                    <div id="tablepdf2" style="overflow-x: auto; height:400px; display:none;">
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
            Vue.component('my-component', {
            template: `
                <div>
                    <!-- Your existing HTML content here -->
                    <table id="example1" class="table table-striped table-bordered table-hover example1">
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
                        <tbody id="mytable1">
                        </tbody>    
                    </table>
                    <div v-if="loading" class="loader">Loading...</div>
                    </div>
                </div>
            `,
            data() {
                return {
                limit: 50,
                start: -50,
                action: 'inactive',
                intervalId: null,
                loading: false
                };
            },
            methods: {
                load_customer_data() {
                const self = this;
                self.loading = true;
                $.ajax({
                    url: 'ajax/ReferalIndividual.php',
                    method: 'POST',
                    data: { submit: 'submit', limit: self.limit, start: self.start },
                    cache: false,
                    success: function (data) {
                    $('#example1').append(data);
                    console.log(data);
                    if (data == 0) {
                        self.action = 'active';
                    } else {
                        self.action = 'inactive';
                    }
                    self.loading = false;
                    },
                    error: function () {
                    self.loading = false;
                    }
                });
                },
                startInterval() {
                const self = this;
                self.intervalId = setInterval(function () {
                    if (self.action === 'inactive') {
                    self.start += self.limit;
                    self.load_customer_data();
                    } else {
                    clearInterval(self.intervalId);
                    $(document.body).css({ cursor: 'default' });
                    alert('No more records found!');
                    self.loading = false;
                    }
                }, 300);
                },
            },
            mounted() {
                this.startInterval();
            }
            });

            // Create the Vue app
            var app = new Vue({
            el: '#app'
            });


                //     var limit = 300;
                //     var start = -300;
                //     var t = "true";
                //     var action = 'inactive';
                //     function load_customer_data(limit, start)
                //     {
                //         $.ajax({
                //             url:"ajax/ReferalIndividual.php",
                //             method:"POST",
                //             data:{submit:"submit",limit:limit, start:start},
                //             cache:false,
                //             success:function(data)
                //             {
                //                 $('#mytable1').append(data);
                //                 console.log(data);
                //                 if(data == 0)
                //                 {
                //                     action = 'active';
                //                 }
                //                 else
                //                 {
                //                     action = "inactive";
                //                 }
                //             }
                //         });
                //     }

                // var myVar = setInterval(function()
                // { 
                //     if(action == 'inactive')
                //     {
                //         start = start + limit;
                //         load_customer_data(limit, start);
                //     }else{
                //         clearInterval(myVar);
                //         $(document.body).css({'cursor' : 'default'});
                //         loading()
                //     }
                // }, 300);

        $('#search1').click(function()
        {
            var name=$('#full1').val();
            $.ajax({
                url:"ajax/ReferalIndividual.php",
                method:"POST",
                data:{submit:"name", name:name},
                cache:false,
                success:function(data)
                {
                    $('#tablepdf').hide();
                    $('#tablepdf2').show();
                    $('#mytable2').html(data);
                    loading1();
                }
            });
        });
        $('#refre').click(function()
        {
            $('#tablepdf').show();
            $('#tablepdf2').hide();
        });

    });
        $('#reset').click(function(){
             window.location='Refrel_Payment.php';
        });
        function loading()
        {
            oTable = $('#example1').dataTable({
                pageLength : 10,
                "lengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
                dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                buttons: [
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(:first-child)' // Exclude the first column from the export
                    }
                }
                ],
            });
            // alert('hii');
        }
        function loading1()
        {
            oTable = $('#example2').dataTable({
                pageLength : 10,
                "lengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
                dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                buttons: [
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(:first-child)' // Exclude the first column from the export
                    }
                }
                ],
            });
            // alert('hii');
        }

        </script>

        
<!-- Introducer 1
<td><?php //echo $intro[1][0]; ?></td>
<td><?php //echo $intro[1][1]; ?></td>
<td><?php //echo $intro[1][2]; ?></td>
<td><?php //echo $intro[1][3]; ?></td>

Introducer 2
<td><?php //echo $intro[2][0]; ?></td>
<td><?php //echo $intro[2][1]; ?></td>
<td><?php //echo $intro[2][2]; ?></td>
<td><?php //echo $intro[2][3]; ?></td>

Introducer 3
<td><?php //echo $intro[3][0]; ?></td>
<td><?php //echo $intro[3][1]; ?></td>
<td><?php //echo $intro[3][2]; ?></td>
<td><?php //echo $intro[3][3]; ?></td>

Introducer 4
<td><?php //echo $intro[4][0]; ?></td>
<td><?php //echo $intro[4][1]; ?></td>
<td><?php //echo $intro[4][2]; ?></td>
<td><?php //echo $intro[4][3]; ?></td>

Introducer 5
<td><?php //echo $intro[5][0]; ?></td>
<td><?php //echo $intro[5][1]; ?></td>
<td><?php //echo $intro[5][2]; ?></td>
<td><?php //echo $intro[5][3]; ?></td>

Introducer 6
<td><?php //echo $intro[6][0]; ?></td>
<td><?php //echo $intro[6][1]; ?></td>
<td><?php //echo $intro[6][2]; ?></td>
<td><?php //echo $intro[6][3]; ?></td>

Introducer 7
<td><?php //echo $intro[7][0]; ?></td>
<td><?php //echo $intro[7][1]; ?></td>
<td><?php //echo $intro[7][2]; ?></td>
<td><?php //echo $intro[7][3]; ?></td>

Introducer 8
<td><?php //echo $intro[8][0]; ?></td>
<td><?php //echo $intro[8][1]; ?></td>
<td><?php //echo $intro[8][2]; ?></td>
<td><?php //echo $intro[8][3]; ?></td> -->

</body>