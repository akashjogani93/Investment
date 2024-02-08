<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <?php require_once("header.php");
                include("js/search.php"); 
        ?>
        <style>
            .form-group-inline label {
                display: inline-block;
                width: 100px; /* Adjust the width as needed */
            }

            .form-group-inline input {
                display: inline-block;
                width: calc(100% - 110px); /* Adjust the width as needed, considering label width */
            }
            tr:hover {
                    background-color: yellow;
            }
        </style>
        <div class="content-wrapper">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <script>
                $("#dyna").text("CHEque");
                tex();
            </script>
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail3" id="search_name" class="control-label">Search Full Name</label>
                                <input class="form-control" type="text" id="inputZip1" name="name1" autocomplete="off" placeholder="Search By Name">
                                <div id="list"></div>
                            </div>
                            <!-- <div class="form-group col-md-3"> -->
                                <!-- <label for="inputEmail3" id="search_name" class="control-label">Search Customer Id</label> -->
                                <input type="hidden" class="form-control" name="full1" id="full1">
                                <input type="hidden" class="form-control form-control-sm" name="date" id="date">
                            <!-- </div> -->
                            <div class="group-form col-md-1">
                                <a type="button" id="search1" onclick="searchfull()" class="btn btn-primary" style="margin-top:25px;">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <!-- <div class="form-group col-md-5 form-group-inline">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="date" class="form_label">Date:</label>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="customerName" class="form_label">Party:</label>
                                        <input type="text" class="form-control form-control-sm" name="customerName" id="customerName">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Age:</label>
                                        <input type="text" class="form-control form-control-sm" name="age" id="age">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Occupation:</label>
                                        <input type="text" class="form-control form-control-sm" name="occ" id="occ">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Resident:</label>
                                        <input type="text" class="form-control form-control-sm" name="res" id="res">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Amount:</label>
                                        <input type="text" class="form-control form-control-sm" name="amt" id="amt">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Bank:</label>
                                        <input type="text" class="form-control form-control-sm" name="bank" id="bank">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Remark:</label>
                                        <input type="text" class="form-control form-control-sm" name="remark" id="remark">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <center><button class="btn btn-success" id='save'>Save</button></center>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Slno</th>
                                            <th>Date</th>
                                            <th>Party</th>
                                            <th>Age</th>
                                            <th>Occupation</th>
                                            <th>Resident</th>
                                            <th>Amount</th>
                                            <th>Bank</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mytable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        $(document).ready(function()
        {
            var yourDateValue = new Date();
            var formattedDate = yourDateValue.toISOString().substr(0, 10)
            $('#date').val(formattedDate);

            $('input').focus(function() 
            {
                $(this).css('border-color', '');
            });

            $('#example1 tbody').on('dblclick', 'tr', function () 
            {
                var rowData = $(this).find('td').map(function () 
                {
                    return $(this).text();
                }).get();
                var aggid=rowData[0];
                var  cid=$('#full1').val();
                var date=$('#date').val();
                    let log=$.ajax({
                        url: 'ajax/cheque.php',
                        method: 'POST',
                        data: {
                            date: date,
                            insert:cid,
                            aggid:aggid,
                        },
                        success: function(response)
                        {
                            fetch(cid);
                            var chequeid=response.trim();
                            // window.location="agreementPrint.php?aggId="+aggId;
                            // var url = "agreementPrint.php?aggId=" + aggId;
                            // window.open(url, '_blank');
                            var url = "checkqprint.php?aggId=" + aggid +"&cid="+cid; 
                            window.open(url, '_blank');
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error("AJAX Error:", status, error);
                        }
                    });
                    // console.log(log);
            });
        });

        function searchfull()
        {
           var  name=$('#inputZip1').val();
           var  cid=$('#full1').val();
           if(cid=='')
           {
                alert('Customer Not Found..');
                return;
           }
            fetch(cid)
        }

        function fetch(cid)
        {
            let log1=$.ajax({
                url:"ajax/agreement.php",
                method : "POST",
                data :{olddatacid : cid },
                success : function(data)
                {
                    $('.mytable').html(data);
                }
            });
        }
    </script>
</body>