<body class="hold-transition skin-blue sidebar-mini">
        <style>
            .error {
                color: red;
            }
        </style> 
    <div class="wrapper" id="form1">
      
        <?php require_once("header.php"); ?>

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
            <!-- <section class="content-header">
                <h1>
                    All Records.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->
            <section class="content">
            <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" action="store_insert.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="inputEmail3" id="search_name" class="col-sm-4 control-label">Search Full Name</label>
                                            <div class="col-sm-8">
                                                <input  type="text" class="form-control full" name="full" id="full"
                                                     placeholder="Search Full Name" required="required">
                                                <input type="hidden" name="full1" id="full1">
                                                <input type="hidden" name="investid" id="investid">
                                            </div>
                                        </div>
                                        <div class="group-form col-md-1">
                                            <a type="button" id="search1" onclick="searchfull()" class="btn btn-primary">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="box">
                    <div class="box-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Investment</h2>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="invest"></b></h4>
                                </div>
                            </div></br>
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Interest</h2>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="interest"></b></h4>
                                </div>
                            </div></br>
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Withdrawal</h2>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;" ><b id="withdraw"></b></h4>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>   -->
                <div class="box">
                    <div class="box-body">
                        <!-- <form action="" method="post" enctype="multipart/form-data">
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Investment</h2>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="totalinvest"></b></h4>
                                </div>
                            </div></br>
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Current Investment</h2>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="currentinvest"></b></h4>
                                </div>
                            </div></br>
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Withdrawal</h2>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="withdra"></b></h4>
                                </div>
                            </div></br>
                        </form> -->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Cid</th>
                                    <th>Member Name</th>
                                    <th>Total Investment</th>
                                    <th>Withdrawal</th>
                                    <th>Current Amount</th>
                                </tr>
                            </thead>
                            <tbody id="mytable">

                            </tbody>
                        </table>
                    </div>  
                </div> 
            </section> 	            
        </div>
    </div>
    <?php include('footer.php');?>

    <script>
        $(document).ready(function()
        {
            var limit = 500;
            var start = -500;
            var t="true";
            var action = 'inactive';
            function load_customer_data(limit,start)
            {
                let log=$.ajax({
                    url:"ajax/super_records.php",
                    method:"POST",
                    datatype:'json',
                    data:{
                        action:"get_super_records",
                        limit: limit,
                        start: start,
                        cid:'submit'
                        },
                    cache:false,
                    success:function(data)
                    {
                        $('#mytable').append(data);
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
                console.log(log);
            }
            var myVar = setInterval(function(){ 
                if(action == 'inactive')
                {
                    start = start + limit;
                    $(document.body).css({'cursor' : 'not-allowed'});
                    load_customer_data(limit, start);
                 }
                 else{
                        clearInterval(myVar);
                        $(document.body).css({'cursor' : 'default'});
                        loading()
                    }
            }, 300);

            function loading()
            {
                oTable = $('#example1').dataTable({
                    // "paging": false,
                    searching:false,
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    buttons: [
                    'csv', 'excel'
                    ],
                });
            }

            // let log=$.ajax({
            //     url:"ajax/super_records.php",
            //     type:'POST',
            //     datatype: 'json',
            //     data:{submit:'submit',full1:'full1'},
            //     success: function(data)
            //     { 
            //         $('#invest').html(data+'/-');
            //         console.log(log);
            //     }
            // });

            // let log1=$.ajax({
            //     url:"ajax/super_records.php",
            //     type:'POST',
            //     datatype: 'json',
            //     data:{withdraw:'withdraw',full1:'full1'},
            //     success: function(data)
            //     { 
            //         $('#withdraw').html(data+'/-');
            //         console.log(log1);
            //     }
            // });

            // let log2=$.ajax({
            //     url:"ajax/super_records.php",
            //     type:'POST',
            //     datatype: 'json',
            //     data:{interest:'interest',full1:'full1'},
            //     success: function(data)
            //     { 
            //         $('#interest').html(data+'/-');
            //         console.log(log2);
            //     }
            // });

        });

        function searchfull()
        {
            full1=$('#full1').val();
            if(full1=='')
            {
                alert("Please Search Customer");
                exit();
            }
            var table = $('#example1').DataTable();
                table.destroy();
            let log=$.ajax({
                url:"ajax/super_records.php",
                type:'POST',
                datatype: 'json',
                data:{
                        action:"get_super_records",
                        cid:full1,
                },
                success: function(data)
                {
                    $('#mytable').html(data);
                    loading();
                }
            });console.log(log);
        }
    </script>
</body>


