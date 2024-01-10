<body class="hold-transition skin-blue sidebar-mini">
<!-- <link rel="stylesheet" href="loader.css"> -->
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
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
        <script type="text/javascript" src="js/singleWithdra.js"></script>
        <div class="content-wrapper">
            <script>
                $("#dyna").text("Withdraw Details");
                tex();
            </script>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-8 searchpad">
                                            <label for="inputEmail3" id="search_name" class="col-sm-4 control-label">Search Full Name</label>
                                            <div class="col-sm-8">
                                                <input  type="text" class="form-control full" name="full" id="full"
                                                     placeholder="Search Full Name" required="required">
                                                <input type="hidden" name="full1" id="full1">
                                                <input type="hidden" name="investid" id="investid">
                                            </div>
                                        </div>
                                        <div class="group-form col-md-1 searchpad1">
                                            <a type="button" id="search1" onclick="searchfull()" class="btn btn-primary">Search</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <!-- <form class="form-horizontal" id="addform" action="registration_insert.php" method="POST"> -->
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Withdraw Process</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Invested Date</label>
                                            <input type="date" class="form-control" name="regdate1" readonly id="regdate1"
                                                    placeholder="Registration Date" 
                                                    required>

                                    
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" id="investedamt" class="form_label">Invested Amount:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="amt" id="amt"
                                            placeholder="Invested Amount:"> 
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" id="wamtlable" class="form_label">Withdraw Amount:</label>
                                        <input type="text" class="col-sm-4 form-control form-control-sm wamt investone" name="wamt" id="wamt"
                                            placeholder="Withdraw Amount" pattern="[0-9]{10}">
                                            
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Withdraw Date</label>
                                    <input type="date" class="col-sm-4 form-control form-control-sm" name="regdate" id="regdate" placeholder="Withdraw Date" required>
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Remaining Amount:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="ramt" id="ramt"
                                            placeholder="Remaining Amount">
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" id="asignlable" class="form_label">Assign %:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm investone" name="asign" id="asign" placeholder="Asign %:"> 
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Per Day:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="pday" id="pday"
                                            placeholder="Per Day">

                                    
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Per Month:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="pmonth" id="pmonth"
                                            placeholder="Per Month">
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Agreement:</label>
                                    <!-- <input type="file" class="form-control form-control-smss" placeholder="" name="agreement" id="agreement" accept=".png, .jpeg, .jpg"> -->
                                    <input type="file" class="form-control form-control-smss" placeholder="" name="agreement" id="agreement" accept=".jpg, .jpeg, .png, .gif, .pdf"> 
                                </div>  
                                <div class="group-form col-md-2">
                                    <button onclick="widraw()" id="sub" class="btn btn-info col-sm-4 form-control form-control-sm" style="margin-top:25px;">Withdraw</button>
                                </div>
                            </div></br>
                        </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-12">
                                <h3>
                                    <b>Invested Amount To Withdraw</b>
                                </h3>
                            </div>
                        </div></br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Sl No</th>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                    <th>IFSC</th>
                                    <th>Bank</th>
                                    <th>Invest</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>
                            <tbody class="mytable">
                            
                            </tbody>
                        </table>
                        <!-- <center>
                            <div id="dis_loader">
                                <div class="loader"><div></div><div></div><div></div></div>
                                <div>First Search Name..<div>
                            </div>
                        </center> -->
                    </div>
                </div>
            </section>


        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>
