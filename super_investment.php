<body class="hold-transition skin-blue sidebar-mini">
        <style>
            .error {
                color: red;
            }
        </style> 
    <div class="wrapper" id="form1">
      
        <?php require_once("header.php"); ?>
        <div class="content-wrapper" style="border:1px solid black;">
            <section class="content-header">
                <h1>
                    All Records.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>
            <section class="content">
                <div class="box">
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
                </div>  
            </section> 	            
        </div>
    </div>
    <?php include('footer.php');?>

    <script>
        $(document).ready(function()
        {
            // alert('hii');
            let log=$.ajax({
                url:"ajax/total_records.php",
                type:'POST',
                datatype: 'json',
                data:{submit:'submit'},
                success: function(data)
                { 
                    $('#invest').html(data+'/-');
                    console.log(log);
                }
            });

            let log1=$.ajax({
                url:"ajax/total_records.php",
                type:'POST',
                datatype: 'json',
                data:{withdraw:'withdraw'},
                success: function(data)
                { 
                    $('#withdraw').html(data+'/-');
                    console.log(log1);
                }
            });

            let log2=$.ajax({
                url:"ajax/total_records.php",
                type:'POST',
                datatype: 'json',
                data:{interest:'interest'},
                success: function(data)
                { 
                    $('#interest').html(data+'/-');
                    console.log(log2);
                }
            });

        });
    </script>
</body>


