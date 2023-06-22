<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="loader.css">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            ::-webkit-scrollbar {
                width: 26px;
            }
            ::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }
            ::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 5px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background-color: #555;
            }
        </style>
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("Investment Assign %");
            tex();
        </script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12 searchpad">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail3" id="search_name" class="col-sm-3 control-label">Search Full Name</label>
                                        <div class="col-sm-8">
                                            <input  type="text" class="form-control full" name="full" id="full" placeholder="Search Full Name" required="required">
                                        </div>
                                    </div>
                                    <div class="group-form col-md-1">
                                        <label for="inputEmail3" class="form_label"></label>
                                        <a type="button" id="search1" onclick="searchfull()" class="btn btn-primary">Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form class="form-horizontal" id="form"  method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Matched Personal Details</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Bank Name:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="bank" id="bank" placeholder="First National Bank">
                                    <input type="hidden" name="full1" id="full1">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Account No:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="acc" id="acc" placeholder="1234-5678-9012-3456">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Mobile Number:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="mobile" id="mobile" placeholder="########863">
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Invest Amount:</label>
                                    <input type="text" class="col-sm-4 form-control form-control-sm investOne" required name="invest" id="invest" placeholder="500000/-">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Assign %:</label>
                                    <input type="text" class="col-sm-4 form-control form-control-sm investOne" required name="asign" id="asign" placeholder="2%">
                                    <script>
                                        $('#invest , #asign').keyup(function() 
                                        {
                                            var inputValue = $(this).val();
                                            if(inputValue==0)
                                            {
                                                $(this).val('');
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Per Day:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="pday" id="pday" placeholder="333.33/-">
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Per Month:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="pmonth" id="pmonth" placeholder="10000/-">
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Transaction Date</label>
                                    <input type="date" class="col-sm-4 form-control form-control-sm" required name="regdate" id="regdate" placeholder="Registration Date">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Transaction Type:</label>
                                    <select class="form-control form-control-sm" name="pmode" required id="pmode">
                                        <option value="">Select Mode</option>
                                        <option>Cash</option>
                                        <option>Bank Check</option>
                                        <option>Online</option>
                                    <select>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Confirmation:</label>
                                    <input type="file" class="form-control form-control-smss" placeholder="" name="screen" id="screen">
                                </div>                
                            </div></br>
                            <div id="show">
                                <div class="row">
                                    <div class="group-form col-md-12">
                                        <h3>
                                            <b>Referrals</b>
                                        </h3>
                                    </div>
                                </div></br>
                                <div class="row">
                                    <div class="group-form col-md-4">
                                        <label for="inputEmail3" class="form_label">Search Referral:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm referal" name="referal[]" id="referal" placeholder="Search Referal">
                                        <input type="hidden" name="referal1[]" id="referal1" class="referal1">
                                    </div>
                                    <div class="group-form col-md-2">
                                        <label for="inputEmail3" class="form_label">Assign %:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm asignke" name="refAsign[]" id="refAsign[]" placeholder="0.5%">
                                    </div>
                                    <div class="group-form col-md-2">
                                        <label for="inputEmail3" class="form_label">Per Day:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm perkey" readonly name="refpday[]" id="refpday[]" placeholder="83.33/-">
                                    </div>
                                    <div class="group-form col-md-2">
                                        <label for="inputEmail3" class="form_label">Per Month:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm permkeys" readonly name="refpmonth[]" id="refpmonth[]" placeholder="2500/-">
                                    </div>
                                     <div class="group-form col-md-2">
                                        <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger add_more" id="add_more" style="margin-top:20px;">Add Referrals</a>
                                    </div>
                                </div>
                            </div></br>
                        </div>
                        <div class="box-footer">
                            <center>
                                <button type="submit" id="sub" class="btn btn-primary regsub">Submit</button>
                            </center>
                        </div>
                    </form>
                </div>
            </section>
        </div>                              
    </div>
    <script type="text/javascript" src="js/investment.js"></script>
    <?php include("footer.php"); ?>
</body>        
