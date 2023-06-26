<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="loader.css">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            /* .col-md-5.fd-pan{
                background: linear-gradient(45deg,#FFB64D,#ffcb80);
                padding: 20px 0px 20px 40px;
                box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5)
            } */
        </style>
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("Fixed Deposit Plan");
        </script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">Full Name:</label>
                                <input type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full" placeholder="Select Full Name" required="required" onkeypress="return isNumberKey(event)">
                                <input type="hidden" name="full1" id="full1">
                            </div>
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">FD Date:</label>
                                <input type="date" class="col-sm-4 form-control form-control-sm" required name="regdate" id="regdate" placeholder="Registration Date" onchange="ch_da()">
                            </div>
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">To Date:</label>
                                <input type="date" class="col-sm-4 form-control form-control-sm investOne" readonly name="to_date" id="to_date" placeholder="Amount">
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">FD Amount:</label>
                                <input type="number" class="col-sm-4 form-control form-control-sm investOne" required name="invest" id="invest" placeholder="Amount" min="1">
                            </div>
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">FD For:</label>
                                <input type="text" class="col-sm-4 form-control form-control-sm investOne" readonly name="Year" id="year" placeholder="5 Year">
                            </div>
                            <div class="group-form col-md-4">
                                <button onclick="t()" name="submit" id="sub" class="btn btn-primary" style=" margin-top:25px; background-color:#1a8e5f;color:#fff;">Submit</button>
                            </div>
                            
                        </div></br>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>FD.No</th>
                                <th>Full Name</th>
                                <th>Amount</th>
                                <th>Year</th>
                                <th>Date</th>
                                <th>ToDate</th>
                            </tr>
                        </thead>
                        <tbody class="mytable">
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once("footer.php"); ?>

    <script>
        $(document).ready(function()
        {

            const urlParams = new URLSearchParams(window.location.search);
            
            if(urlParams=='')
            {
                $("#full1").val('');
                $("#full").val('');
            }else
            {
                const fd_id = urlParams.get('fd_id');
                const fd_name = urlParams.get('fd_name');
                $("#full1").val(fd_id);
                $("#full").val(fd_name);
            }
            

            fetchall();
            //autocomplete names
            $(function() {
                $(".full").autocomplete({
            
                    source: 'fd_searchName.php',
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
            
        });

        function ch_da()
        {
            var fddate = $('#regdate').val();
           
            var date = new Date(fddate);
            date.setFullYear(date.getFullYear() + 5);

            var newDateStr = (date.getDate() < 10 ? '0' : '') + date.getDate() + '-' +
                 (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1) + '-' +
                 date.getFullYear();
            const parts = newDateStr.split("-"); 
            const formattedDateStr = `${parts[2]}-${parts[1]}-${parts[0]}`;
          
            $('#to_date').val(formattedDateStr);

        }
        function t()
        {
            var cid = $('#full1').val();
            var fddate = $('#regdate').val();
            var to_date = $('#to_date').val();
            var invest = $('#invest').val();
            if(invest==0)
            {
                alert("Please Enter Valid Amount");
                exit();
            }
            var year = 5;
            if(cid !='' & fddate !='' & to_date !='' & invest !='')
            {
                log = $.ajax({
                    url: 'ajax/fd_plan.php',
                    type: "POST",
                    data: {
                        cid : cid,
                        fddate : fddate,
                        invest : invest,
                        year: year,
                        to_date: to_date
                    },success: function(data) 
                    {
                        alert(data);   
                        fetchall(); 
                    }
                });
            }
            else
            {
                alert("Please Fill All Feild")
                Exit();
            }
           
        }
        function fetchall()
        {
           let  log = $.ajax({
                    url: 'ajax/fd_plan.php',
                    type: "POST",
                    data: {
                        submit: "submit",
                    },
                    catch: false,
                    success:function(data) 
                    {
                        $(".mytable").html(data);
                    }
            });
            // console.log(log)
        }
        function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if ((charCode < 48 || charCode > 57))
                return true;      
                
                return false;
            }
    </script>
</body>