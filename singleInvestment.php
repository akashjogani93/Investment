<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
    <style>
            .error {
                color: red;
            }
            th, td { white-space: nowrap; }
            .table-striped>tbody>tr:nth-child(odd)>td, 
            .table-striped>tbody>tr:nth-child(odd)>th 
            {
                background-color: #E5DCC3;
                padding:15px; 
            }
            .table-striped>tbody>tr:nth-child(even)>td, 
            .table-striped>tbody>tr:nth-child(even)>th 
            {
                background-color: #C9CCD5;
                padding:15px;
            }
            
            table.dataTable thead {background-color:#D3E4CD}

            div.dataTables_wrapper {
                position: relative;
                overflow-x: scroll;
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
        <?php require_once("header.php"); 
            
        ?>
        <script>
            $("#dyna").text("Single Investment Details");
            tex();
        </script>
        <script type="text/javascript" src="js/investment.js"></script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="group-form col-md-4">
                                            <label for="inputEmail3" class="form_label">Search Full Name</label>
                                            
                                                <input  type="text" class="col-sm-4 form-control form-control-sm full" name="full" id="full"
                                                     placeholder="Search Full Name" required="required">
                                                   <input type="hidden" name="full1" id="full1">

                                            
                                        </div>
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" class="form_label" style="color:white;">Interest</label>
                                            <a type="button" id="search1" onclick="searchfullsingle()" class="btn btn-primary">Search</a>
                                        </div>
                                        <div class="group-form col-md-1">
                                            <label for="inputEmail3" class="form_label" style="color:white;">Interest</label>
                                            <a href="singleInvestment.php" id="sea" class="btn btn-warning">Refresh</a>
                                        </div>
                                        <div class="group-form col-md-3">
                                            <label for="inputEmail3" class="form_label">Total Interest</label>
                                            <input type="text" class="form-control" name="totalint"  id="totalint"
                                                    placeholder="Registration Date" readonly>
                                        </div>
                                        <div class="group-form col-md-3">
                                            <label for="inputEmail3" class="form_label">Total Month Amount</label>
                                            <input type="text" class="form-control" name="regdate1"  id="regdate1"
                                                    placeholder="Registration Date"  readonly>

                                        </div>
                                        
                                    </div> 
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
                                    <b>Principle Amount Investment</b>
                                </h3>
                            </div>
                        </div></br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Sl NO</th>
                                    <th>Bank</th>
                                    <th>Account No</th>
                                    <th>Invest Date</th>
                                    <th>Invest Amount</th>
                                    <th>Assigned %</th>
                                    <th>Per Day</th>
                                    <th>Total Days</th>
                                    <th>Total Interest</th>
                                    <th>Month Amount</th>
                                    <th>Payment Mode</th>
                                    <th>Payment Proof</th>
                                    <th>Agreement</th>
                                </tr>
                            </thead>
                            <tbody class="mytable">
                            </tbody>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="totalinvest">0.00</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="totaint">0.00</th>
                                    <th id="totalmonth">0.00</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <center><div class="loader"></div></center> -->
                        <center>
                            <div class="dis_loader">
                                <div class="loader"><div></div><div></div><div></div></div>
                                <div>First Search Name..<div>
                            </div>
                        </center>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-12">
                                <h3>
                                    <b> Referral Amount </b>
                                </h3>   
                            </div>
                        </div></br>
                    <!-- <center><h3>
                        Referal Amount 
                        </h3></center> -->
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Invest Id</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Assign %</th>
                                    <th>Per Day</th>
                                    <th>Total Days</th>
                                    <th>Total Interest</th>
                                    <th>Month Amount</th>
                                </tr>
                            </thead>
                            <tbody class="mytable1">

                            </tbody>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th id="refamount">0.00</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="refint">0.00</th>
                                    <th id="refmonth">0.00</th>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <center><div class="loader"></div></center> -->
                        <center>
                            <div class="dis_loader">
                                <div class="loader"><div></div><div></div><div></div></div>
                                <div>First Search Name..<div>
                            </div>
                        </center>
                    </div>
                </div>
            </section>
        </div>
        <?php include("footer.php"); ?>
    </div>
    <script>
         function editupdate(cid)
        {
            if(confirm("Are you sure?")==true){
                location = "investment_edit.php?cid="+cid;
            }
        }
    </script>
        
</body>
