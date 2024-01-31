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
                            <div class="form-group col-md-5 form-group-inline">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <!-- <label for="date" class="form_label">Date:</label> -->
                                        <input type="hidden" class="form-control form-control-sm" name="date" id="date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="customerName" class="form_label">Party:</label>
                                        <input type="text" class="form-control form-control-sm" name="customerName" id="customerName">
                                    </div>
                                </div>
                                <!-- <div class="row">
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
                                </div> -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="age" class="form_label">Amount:</label>
                                        <input type="text" class="form-control form-control-sm" name="amt" id="amt">
                                    </div>
                                </div>
                                <!-- <div class="row">
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
                                </div> -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <center><button class="btn btn-success" id='save'>Save</button></center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Party</th>
                                            <th>Amount</th>
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

            $('#save').on('click',function()
            {
                
                var  name=$('#inputZip1').val();
                var  cid=$('#full1').val();
                var date=$('#date').val();
                var party=$('#customerName').val();
                var amt=$('#amt').val();

                var input = ['#customerName','#amt'];
                for (var i = 0; i < input.length; i++)
                {
                    if($(input[i]).val()=='')
                    {
                        $(input[i]).css('border-color','red');
                        return;
                    }
                }

                    let log=$.ajax({
                        url: 'ajax/cheque.php',
                        method: 'POST',
                        data: {
                            date: date,
                            party: party,
                            amt: amt,
                            insert:cid,
                        },
                        success: function(response)
                        {
                            fetch(cid)
                            for (var i = 0; i < input.length; i++)
                            {
                                $(input[i]).val('');
                            }
                            var aggId=response.trim();
                            // window.location="agreementPrint.php?aggId="+aggId;
                            // var url = "agreementPrint.php?aggId=" + aggId;
                            // window.open(url, '_blank');
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

           let log=$.ajax({
                url: "ajax/cheque.php",
                method: "POST",
                data: { cid: cid },
                dataType: "json",
                success: function (data) 
                {
                    $('#customerName').val(data.full);
                    // $('#age').val('MAJOR');
                    // $('#occ').val('BUSINESS');
                    // $('#res').val(data.address);
                    $('#amt').val();
                    // $('#bank').val();
                    // $('#remark').val('AGREEMENT');
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
            fetch(cid)

        }

        function fetch(cid)
        {
            
            let log1=$.ajax({
                url:"ajax/cheque.php",
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