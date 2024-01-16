<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            #bottom 
            {
                position: fixed;
                bottom: 0;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                width: 100%; /* Make the table fill the container */
                white-space: nowrap; /* Prevent line breaks in table cells */
            }

            th, td {
                padding: 10px;
                /* Add any other styling you need for your table cells */
            }
        </style>
        <?php require_once("header.php"); ?>
        <div class="content-wrapper">
            <!-- <section class="content-header">
                <h1>
                    Matched Personal Details
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->
            <script>
            $("#dyna").text("payment Details");
            tex();
        </script>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-2">
                                <label for="inputEmail3" class="form_label">ID:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="cid" id="cid" value="<?php echo $id;?>">
                            </div>
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">Full Name:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="name" id="name"
                                        placeholder="Account No">

                                
                            </div>
                            <div class="group-form col-md-3">
                                <label for="inputEmail3" class="form_label">Bank Name:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="bank" id="bank"
                                        placeholder="Mobile Number">

                                
                            </div>
                            <div class="group-form col-md-3">
                                <label for="inputEmail3" class="form_label">Account No:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="acc" id="acc"
                                        placeholder="Mobile Number">
                            </div>
                        </div></br>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-body">
                    <center><h3>
                        Investor Payment
                    </h3></center>
                    <div class="table-container">
                    <table id="example1" class="table table-striped table-bordered table-hover example1">
                            <thead>
                                <tr>
                                    <th>Invt Id</th>
                                    <th>Invt Date</th>
                                    <th>Invt Amount</th>
                                    <th>%</th>
                                    <th>Per Day Amount</th>
                                    <th>Total Days</th>
                                    <th>Total Interest</th>
                                    <th>Month Amount</th>
                                </tr>
                            </thead>
                            <tbody class="mytable">
                            </tbody>    
                        </table>
                        </div>
                    </div>   
                </div>
                
                <div class="box box-default">
                    <center><h3>
                        Introducer Payment
                    </h3></center>
                    <div class="box-body">
                        <div class="table-container">
                    <table id="example2" class="table table-striped table-bordered table-hover example1">
                            <thead>
                                <tr>
                                    <th>Invt Id</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>%</th>
                                    <th>Per Day Amount</th>
                                    <th>Total Days</th>
                                    <th>Total Interest</th>
                                    <th>Month Amount</th>
                                </tr>
                            </thead>
                            <tbody class="mytable1">
                            </tbody>    
                        </table>
                        </div>
                    </div>   
                </div>
            </section>
        </div>                              
    </div>
    <?php include("footer.php"); ?>
        
        <script>
            $(document).ready(function()
            {
                var cid=$('#cid').val();
                console.log(cid);
                let log=$.ajax({
                    url:"ajax/sub_payment_ajax.php",
                    method:"POST",
                    dataType: 'json',
                    data:{cid:cid},
                    
                    success:function(data)
                    {
                        $('#bank').val(data[0].bank);
                        $('#name').val(data[0].full);
                        $('#acc').val(data[0].account);
                       
                    }
                });
                // console.log(log);
                    let log1=$.ajax({
                        url:"ajax/sub_payment_report.php",
                        method:"POST",
                        data:{cid:cid},
                        cache:false,
                        success:function(data)
                        {
                            $('.mytable').append(data);
                            $('#example1').dataTable({
                            pageLength : 10,
                            
                            pageLength : 10,
                            "lengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
                            language: {
                                'paginate': {
                                'previous': '<a type="button" class="btn btn-primary">Previous</a>',
                                'next': '<a type="button" class="btn btn-primary">Next</a>'
                                }
                            },
                            // footerCallback: function( tfoot, data, start, end, display ) {
                            //     $(tfoot).append('<tr><td>Total:</td><td></td><td></td></tr>');
                            // }
                            
                            });
                            moveRowToBottom1("botom1")
                        
                        }
                    });


                    let log2=$.ajax({
                        url:"ajax/sub_payment_report.php",
                        method:"POST",
                        data:{cid1:cid},
                        cache:false,
                        success:function(data)
                        {
                            $('.mytable1').append(data);
                            $('#example2').dataTable({
                            pageLength : 10,
                            
                            pageLength : 10,
                            "lengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
                            language: {
                                'paginate': {
                                'previous': '<a type="button" class="btn btn-primary">Previous</a>',
                                'next': '<a type="button" class="btn btn-primary">Next</a>'
                                }
                            },
                            // "rowCallback": function() 
                            // {
                            //     moveRowToBottom("botom");
                            // }
                                
                            });
                            

                            moveRowToBottom("botom")
                        }
                    });
                    //console.log(log1);
                    
                   
            });
            
            function moveRowToBottom(rowId) {
                var table = document.getElementById("example2");
                var row = document.getElementById(rowId);
                table.appendChild(row);
            }

            function moveRowToBottom1(rowId) {
                var table = document.getElementById("example1");
                var row = document.getElementById(rowId);
                table.appendChild(row);
            }
        </script>
        
        

</body>        
