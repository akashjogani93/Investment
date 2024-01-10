<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
        </style>
        <?php require_once("header.php"); ?>
        <?php include('investment_edit_js.php'); ?>
        <script type="text/javascript">
            $(function() {
                
                $(".full").autocomplete({

                    source: 'investment_searchName.php',
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
            
        <script>
            function handleAuctocomplet()
            {
                var currentEle;
                
                currentEle=$(this);
                let log = $(currentEle).autocomplete({
                    source: 'investment_referalName.php',
                    focus: function (event, ui) {
                        event.preventDefault();
                        $($(this)).val(ui.item.label);
                    },
                    select: function (event, ui) {
                        event.preventDefault();
                        $($(this)).val(ui.item.value);
                        $($(this)).val(ui.item.label);

                        let referal1 = $(this).parent().parent().find('.referal1');
                        $(referal1).val(ui.item.value);
                        //console.log(referal1);
                        
                }
                });
            }
        </script>
        <script>
                $(document).on('focus','.referal',handleAuctocomplet);
        </script>
        <div class="content-wrapper">
            <script>
                $("#dyna").text("Investment & Assign");
                tex();
            </script>
            <!-- <section class="content-header">
                <h1>
                    Investment Asign
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" action="ajax/introduceReferal.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Full Name</label>
                                            <div class="col-sm-8">
                                                <input  type="text" class="form-control full" name="full" id="full" placeholder="Search Full Name" required="required" readonly>
                                            </div>
                                        </div>
                                        <!-- <div class="group-form col-md-1">
                                            <label for="inputEmail3" class="form_label"></label>
                                            <a type="button" id="search1" onclick="searchfull()" class="btn btn-primary">Search</a>
                                        </div> -->
                                        <!-- <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Investment Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="regdate" id="regdate"
                                                    placeholder="Registration Date" value="<?php //echo date('Y-m-d'); ?>"
                                                    required>

                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form class="form-horizontal" id="form"  method="POST">
                        <div class="box-body">
                            <div class="row">
                                <center><h3>
                                        Matched Personal Details
                                    </h3></center></br><hr>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Bank Name:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="bank" id="bank"
                                            placeholder="Back Name">
                                            <input type="hidden" name="full1" id="full1">
                                            <input type="hidden" name="in_id" id="in_id">

                                    
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Account No:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="acc" id="acc"
                                            placeholder="Account No">

                                    
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Mobile Number:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="mobile" id="mobile"
                                            placeholder="Mobile Number">

                                    
                                </div>
                                
                            </div></br>

                            <div class="row">
                                
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Invest Amount:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" required name="invest" id="invest"
                                            placeholder="Invest To Amount">

                                    
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Assign %:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" required name="asign" id="asign"
                                            placeholder="Asign %">

                                    
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Per Day:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="pday" id="pday"
                                            placeholder="Per Day Amount">

                                    
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Per Month:</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="pmonth" id="pmonth"
                                            placeholder="Per Mounth Amount">
                                </div>
                                
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Investment Date</label>
                                    <input type="date" class="col-sm-4 form-control form-control-sm" required name="regdate" id="regdate" placeholder="Registration Date" readonly>
                                </div>
                                <script>
                                    $(document).ready( function() {
                                        var yourDateValue = new Date();
                                        var formattedDate = yourDateValue.toISOString().substr(0, 10)
                                        $('#regdate').val(formattedDate);
                                    });
                                
                                </script>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Payment Mode:</label>
                                    <select class="form-control form-control-sm" name="pmode" required id="pmode">
                                        <option value="">Select Mode</option>
                                        <option>Cash</option>
                                        <option>Bank Check</option>
                                        <option>Online</option>
                                    <select>
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Confirmation:</label>
                                    <input type="file" class="form-control form-control-smss" placeholder="" name="screen" id="screen" accept=".png, .jpeg, .jpg"> 
                                </div>
                                <div class="group-form col-md-2" id="proof" style="display:none;">
                                    <button type="button" onclick="picture()" style="margin-top:25px;">Download</button>
                                    <!-- <button type="button" onclick="viewProf()" style="margin-top:25px;">View</button> -->
                                </div>
                                <div class="group-form col-md-2">
                                    <label for="inputEmail3" class="form_label">Agreement:</label>
                                    <input type="file" class="form-control form-control-smss" placeholder="" name="agreement" id="agreement" accept=".png, .jpeg, .jpg"> 
                                </div>
                                <div class="group-form col-md-2" id="bondagrement" style="display:none;">
                                    <button type="button" onclick="bond()" style="margin-top:25px;">Download</button>
                                    <!-- <button type="button" onclick="viewBond()" style="margin-top:25px;">View Bond</button> -->
                                </div>
                            </div>
                            </br>
                            <div id="show">
                                    <hr><center><h3>
                                            REFERALS
                                    </h3></center></br><hr>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-2">
                                    <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger add_more">Add Referals</a>
                                </div>
                            </div></br>
                        </div>
                        <div class="box-footer">
                            <center>
                                <button type="submit" id="upp" class="btn btn-primary">Update</button>
                            </center>
                        </div>
                    </form>
                </div>
            </section>
        </div>                              
    </div>
    <?php include("footer.php"); ?>
        <script>
            $(document).ready(function() {
                $('.add_more').click(function(e) {
                    e.preventDefault();
                    //console.log("pass");
                    $('#show').after(`<div class="row">
                                    
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">Search Referal:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm referal" name="referal[]" id="referal"
                                        placeholder="Search Referal">
                                    <input type="hidden" name="referal1[]" id="referal1" class="referal1">

                            </div>
                            <div class="group-form col-md-2">
                                <label for="inputEmail3" class="form_label">Asign %:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm asignke" name="refAsign[]" id="refAsign[]"
                                        placeholder="Asign %">

                                
                            </div>
                            <div class="group-form col-md-2">
                                <label for="inputEmail3" class="form_label">Per Day:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm perkey" readonly name="refpday[]" id="refpday[]"
                                        placeholder="Per Day Amount">

                                
                            </div>
                            <div class="group-form col-md-2">
                                <label for="inputEmail3" class="form_label">Per Month:</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm permkeys" readonly name="refpmonth[]" id="refpmonth[]"
                                        placeholder="Per Mounth Amount">
                            </div>
                            <div class="group-form col-md-2">
                                
                                <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger remove" style="margin-top:20px;">Remove</a>
                            </div>
                            
                        </div>`);
                                
                });
            });
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
        </script>

        <script>
            function searchfull()
            {
                 var cid = $('#full1').val();
                //alert('hii')
                //console.log(full);
                let log = $.ajax({
                    url: 'ajax/investSearchDetail.php',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        cid: cid,
                        
                    },
                    success: function(data) {
                        $("#bank").val(data[0].bank);
                        $("#acc").val(data[0].account);
                        $("#mobile").val(data[0].mobile);
                        
                    }
                });
                //console.log(log);
            }
        </script>
        <script>
            $(document).ready(function()
            {
                $('#asign').keyup(function()
                {
                    
                    var invest = $('#invest').val();
                    var asign = $('#asign').val();
                    
                    var calc=(invest/100)*asign;
                    var calx=calc/30;
                    $('#pmonth').val(calc.toFixed(2)); 
                    $('#pday').val(calx.toFixed(2)); 

                });
            });
        </script>
        <script>
            $("#form").on('submit',(function(e)
            {
                e.preventDefault();

                var button = $("#upp");
                    button.text("Updatting");
                    button.prop("disabled", true);
                var cid = $('#full1').val();
                // get all referals
                var vals = [];
                let i = 0;
                $('.referal1').each(function(index, item)
                {
                    vals[i] = [];
                    let asignke = $(item).parent().parent().find('.asignke').val();
                    let perkey = $(item).parent().parent().find('.perkey').val();
                    let permkeys = $(item).parent().parent().find('.permkeys').val();
                    //console.log(perkey);
                    vals[i].push(item.value);
                    vals[i].push(asignke);
                    vals[i].push(perkey);
                    vals[i].push(permkeys);
                    
                    ///console.log();
                    i++;
                });
                if(vals=='')
                {
                    vals='0';
                }
                if(cid=='')
                {
                    alert('Please Select Customer')
                    Exit();
                }else
                {
                    var formData = new FormData(this);
                }
                // formData.append('referals',JSON.stringify(vals));
                let log = $.ajax({
                    url: 'ajax/edit_referalInvestment.php',
                    type: "POST",
                    datatype: 'Json',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    
                    success: function(data)
                    {
                        // console.log(log);
                        let log1 = $.ajax({
                            url: 'ajax/edit_referalInvestment1.php',
                            type: "POST",
                            data: {
                                data : data,
                                referals : vals
                            },
                            success: function(response) 
                            {
                                alert(response)
                                button.text("Submit");
                                button.prop("disabled", false);
                                window.history.back();
                                // $('#full').val('');
                                // $('#full1').val('');
                                // $('#in_id').val('');
                                // $('#invest').val('');
                                // $('#asign').val('');
                                // $('#pday').val('');
                                // $('#pmonth').val('');
                                // $('#bank').val('');
                                // $('#acc').val('');
                                // $('#mobile').val('');
                                // $('.remove:not(:first)').parent().parent().remove();
                                // $('.referal').val('');
                                // $('.referal1').val('');
                                // $('.asignke').val('');
                                // $('.perkey').val('');
                                // $('.addonTot').val('');
                                // $('.permkeys').val('');
                                // $('#pmode').val('');
                                // $('#screen').val('');
                            }
                        });
                    }
                });
                //console.log("error========>",log);
            }));
           
            function addInvest1()
            {
                
                // var cid = $('#full1').val();
                // console.log(cid);

                // // get all details
                // var regdate = $('#regdate').val();
                // var invest = $('#invest').val();
                // var asign = $('#asign').val();
                // var pday = $('#pday').val();
                // var pmonth = $('#pmonth').val();
                // var pmode = $('#pmode').val();
                // //var screen = $('#screen').val();
                // // alert(pmode)
                // if(cid=='')
                // {
                //     alert('Please Select Customer')
                //     Exit();
                // }
                // if(invest=='')
                // {
                //     alert('Please Add Investment Amount')
                //     Exit();
                // }
                // if(asign=='')
                // {
                //     alert('Please Asign% Amount')
                //     Exit();
                // }
                // if(pmode=='')
                // {
                //     alert('Please Select Amount Payment Mode')
                //     Exit();
                // }
                // // get all referals
                // var vals = [];
                // let i = 0;
                // $('.referal1').each(function(index, item)
                // {
                //     vals[i] = [];
                //     let asignke = $(item).parent().parent().find('.asignke').val();
                //     let perkey = $(item).parent().parent().find('.perkey').val();
                //     let permkeys = $(item).parent().parent().find('.permkeys').val();
                //     //console.log(perkey);
                //     vals[i].push(item.value);
                //     vals[i].push(asignke);
                //     vals[i].push(perkey);
                //     vals[i].push(permkeys);
                    
                //     console.log();
                //     i++;
                // });

                // let log = $.ajax({
                //     url: 'ajax/introduceReferal.php',
                //     type: "POST",
                //     data: {
                //         cid : cid,
                //         regdate : regdate,
                //         invest : invest,
                //         asign : asign,
                //         pday : pday,
                //         pmonth : pmonth,
                //         pmode : pmode,
                //         referals : vals
                //     },
                //     success: function(data) {
                //         console.log(log);
                //         alert(data);
                //         //$('#full1').val('');
                //         $('#full').val('');
                //         $('#regdate').val('');
                //         $('#invest').val('');
                //         $('#asign').val('');
                //         $('#pday').val('');
                //         $('#pmonth').val('');
                //         $('#bank').val('');
                //         $('#acc').val('');
                //         $('#mobile').val('');
                //         $('.remove:not(:first)').parent().parent().remove();
                //         $('.referal').val('');
                //         $('.referal1').val('');
                //         $('.asignke').val('');
                //         $('.perkey').val('');
                //         $('.addonTot').val('');
                //         $('.permkeys').val('');
                //         $('#pmode').val('');
                //     }
                // });
            }
        </script>

</body>        
