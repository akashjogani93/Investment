<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
    
        <style>
            .error {
                color:red;
            }
            
        </style>
        
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("FD Customer Registration");
            tex();
        </script>
        <?php
            require_once("dbcon.php"); 
            $cid = 0;
            $sql = "SELECT max(f_cid) FROM fd_customers";
            $retval = mysqli_query($conn,$sql);

            if(! $retval ) {
                die('Could not get data: ' . mysqli_error($conn));
            }
            while($row = mysqli_fetch_assoc($retval)) {
                $cid=$row['max(f_cid)'];
                $cid++;
                //echo $cid;
            }
            // $username="SHIVAM".$cid; $password="SHIVAM".rand(10000,100000);
        ?>
        
        <!-- <script type="text/javascript" src="js/registration.js"></script> -->
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <form class="form-horizontal" id="addform" action="fd_customer_insert.php" method="POST" autofocus="off">
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Customer Detail's</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Customer Id *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm"  value="<?php echo $cid;?>" name="cid" id="cid" readonly placeholder="Customer ID">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Registration Date *</label>
                                    <?php if("reg"=="reg")
                                        {
                                            ?>
                                                <input type="date" class=" col-sm-4 form-control form-control-sm"  name="regdate" id="regdate" placeholder="Registration Date" required>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <input type="date" class=" col-sm-4 form-control form-control-sm" value="<?php echo $regdate;?>" name="regdate" id="regdate" placeholder="Registration Date" required>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">First Name *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="fname" id="fname" placeholder="Darrell" required autofocus="off">
                                </div>
								<div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Middle Name *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="mname" id="mname" placeholder="C." required autofocus="off">
                                    <script>
                                        function text(event)
                                        {
                                            var keycode = (event.keyCode ? event.keyCode : event.which);
                                            alert(keycode);
                                            // if ((keycode < 48 || keycode > 57))
                                            //     return true;

                                            //     return false;
                                        }
                                    </script>
                                </div>
								<div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Last Name *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="lname" id="lname" placeholder="Thorton" required>
                                </div>
                            </div></br>
                            <div class="row">
								<div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label" id="lab_mob">Mobile Number *</label>
                                    <input type="text" class="mob col-sm-4 form-control form-control-sm" name="mobile" id="mobile" placeholder="#######863" required onkeypress="return isNumberKey(event)" maxlength="10" >
                                </div>
								<div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Select Gender *</label>
                                    <select class="form-control form-control-sm" required name="gen" id="gen">
                                        <?php if('reg'=='reg')
                                        {
                                            echo '<option value="">Select Gender</option>';
                                        }
                                        else
                                        {
                                            echo '<option>'.$gender;'</option>';
                                        }?>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    <select>        
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Address *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="address" id="address" placeholder="2422 Chapel Street Houston, TX 77026" required>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Nominee *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="nom" id="nom" placeholder="Chappel" required>
                                </div>
								<div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Relationship *</label>
									<input type="text" class=" col-sm-4 form-control form-control-sm" name="rel" id="rel" placeholder="Father" required>
                                </div>
								<div class="group-form col-md-4" id="formsub">
                                        <button type="submit" name="submit" id="sub" class="btn btn-primary regsub" style="margin-top:25px;">Submit</button>
                                </div>
								<div class="group-form col-md-4" id="formup" style="display:none;">
                                    <button type="submit" name="update" class="btn btn-danger" style="margin-top:25px;">Update</button>
                                    <a href="fd_customers.php" class="btn btn-primary" style="margin-top:25px;">Back</a>
                                </div>
                            </div></br>
                        </div>
                    </form>
                </div>
                <div class="box box-default">
					<div class="box-body">
						<div class="row">
							<div class="group-form col-md-12">
								<h3>
									<b>Registered Customers</b>
								</h3>
							</div>
						</div></br>
						<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Sl No</th>
                                    <th style="display:none">F Name</th>
                                    <th style="display:none">M Name</th>
                                    <th style="display:none">L Name</th>
                                    <th style="display:none">Date</th>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Nominee</th>
                                    <th>Relation</th>
                                </tr>
                            </thead>
                            <tbody class="mytable">
								
                            </tbody>
                        </table>
					</div>
                </div>
            </section>
            <!-- /.content -->
        </div><?php include("footer.php"); ?>

        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
        
        <!-- /.content-wrapper -->
        <?php //require_once("footer.php"); ?>

        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    
    

    <script src="conn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function()
		{
			let log=$.ajax({
				url: 'ajax/fd_customers.php',
				type: "POST",
				data:{Submit:"submit"},
				cache:false,
				success:function(data)
				{
					$('.mytable').html(data);
				}
			});
			console.log(log);
            
            $('#mname, #lname, #fname, #nom, #rel').keypress(function(event)
            {
	
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if ((keycode < 48 || keycode > 57))
                return true;

                return false;
            });
           
            
		});
            function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if ((charCode < 48 || charCode > 57))
                return false;

                return true;        
            }

            // function edit_fd(id)
            // {
            //     var closestRow =id.closest('tr');
            //     var td1Value = closestRow.find('td:nth-child(1)').text();

            //     console.log(td1Value);
            // }
            var next=true;
            function fdedit(element)
            {
                var closestRow = $(element).closest("tr");
                var id = closestRow.find("td:eq(1)").text();
                var fname = closestRow.find("td:eq(2)").text();
                var mname = closestRow.find("td:eq(3)").text();
                var lname = closestRow.find("td:eq(4)").text();
                var date = closestRow.find("td:eq(5)").text();
                var mobile = closestRow.find("td:eq(7)").text();
                var gender = closestRow.find("td:eq(8)").text();
                var adds = closestRow.find("td:eq(9)").text();
                var nominee = closestRow.find("td:eq(10)").text();
                var relation = closestRow.find("td:eq(11)").text();
                $('#cid').val(id);
                $('#regdate').val(date);
                $('#fname').val(fname);
                $('#mname').val(mname);
                $('#lname').val(lname);
                $('#mobile').val(mobile);
                $('#address').val(adds);
                $('#nom').val(nominee);
                $('#rel').val(relation);
                $('#gen').val(gender);
                $('#formsub').hide();
                $('#formup').show();
                // alert(column2Value)
                // console.log(column2Value)
            }
            
	</script>


    
</body>

</html>