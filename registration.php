<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <?php $click="reg"; $fname=$mname=$lname=$mobile=$pan=$email=$address=$blood=$gender=$bank="";
                $ifsc=$branch=$account=$nominee=$relation="";$username='';$password='';
            ?>
        <style>
            .error {
                color:red;
            }
            .required-error {
                border: 2px solid red;
            }
        </style>
        
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("registration");
            tex();
        </script>
        <?php
            require_once("dbcon.php"); 
            $cid = 0;
            $sql = "SELECT max(cid) FROM register";
            $retval = mysqli_query($conn,$sql);

            if(! $retval ) {
                die('Could not get data: ' . mysqli_error($conn));
            }
            while($row = mysqli_fetch_assoc($retval)) {
                $cid=$row['max(cid)'];
                $cid++;
            }
        ?>
        <?php
            if(isset($_GET['edit']))
            {
                $cid=$_GET['edit'];
                $click="edit";
                $qry="SELECT `register`.*,`login`.`username`,`login`.`password` FROM `register`,`login` WHERE `register`.`cid`=`login`.`cid` AND`register`.`cid`='$cid'";
                $conform=mysqli_query($conn, $qry);
                while ($row = mysqli_fetch_array($conform))
                {
                    $regdate=$row['regdate'];
                    $fname=$row['fname'];$mname=$row['mname'];$lname=$row['lname']; $mobile=$row['mobile'];$email=$row['email'];$pan=$row['pan'];
                    $address=$row['address'];$blood=$row['blood'];$gender=$row['gender']; $bank=$row['bank'];$account=$row['account'];$ifsc=$row['ifsc'];
                    $branch=$row['branch'];$nominee=$row['nominee'];$relation=$row['relation'];$username=$row['username'];$password=$row['password'];
                }
            }
            if(isset($_GET['view']))
            {
                ?>
                    <script>
                        $( document ).ready(function() {
                            $('#addform :input').attr('readonly','readonly');
                            $('select[name=blood]').attr("disabled", "disabled"); 
                            $('select[name=gen]').attr("disabled", "disabled");
                        });
                    </script>
                <?php
                $cid=$_GET['view'];
                $click="view";
                $qry="SELECT * FROM `register` WHERE `cid`='$cid'";
                $conform=mysqli_query($conn, $qry);
                while ($row = mysqli_fetch_array($conform)) 
                {
                    $regdate=$row['regdate'];
                    $fname=$row['fname'];$mname=$row['mname'];$lname=$row['lname']; $mobile=$row['mobile'];$email=$row['email'];$pan=$row['pan'];
                    $address=$row['address'];$blood=$row['blood'];$gender=$row['gender']; $bank=$row['bank'];$account=$row['account'];$ifsc=$row['ifsc'];
                    $branch=$row['branch'];$nominee=$row['nominee'];$relation=$row['relation'];
                }
            }
            
        ?>
        <script type="text/javascript" src="js/registration.js"></script>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <form class="form-horizontal" id="addform" action="registration_insert.php" method="POST" autocomplete="off">
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Customer Personal Detail's</b>
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
                                    <?php if($click=="reg")
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
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Blood Group</label>
                                    <select class="form-control form-control-sm" name="blood" id="blood">
                                        <?php if($click=='reg')
                                        {
                                            echo '<option value="";>Blood Group</option>';
                                        }
                                        else
                                        {
                                            echo '<option>'.$blood;'</option>';
                                        }?>
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                    <select>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">First Name *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm"  value="<?php echo $fname;?>" name="fname" id="fname" placeholder="Type Here..." required>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Middle Name</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" value="<?php echo $mname;?>" name="mname" id="mname" placeholder="Type Here...">
                                    <script>
                                        function text(event)
                                        {
                                            var keycode = (event.keyCode ? event.keyCode : event.which);
                                            // alert(keycode);
                                        }
                                    </script>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Last Name *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" value="<?php echo $lname;?>" name="lname" id="lname" placeholder="Type Here..." required>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label" id="lab_mob">Mobile Number *</label>
                                    <input type="text" class="mob col-sm-4 form-control form-control-sm" value="<?php echo $mobile;?>" name="mobile" id="mobile" placeholder="Type Here..." required onkeypress="return isNumberKey(event)" maxlength="10" >
                                </div>
                                
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Email</label>
                                    <input type="email" class=" col-sm-4 form-control form-control-sm" value="<?php echo $email;?>" name="email" id="email" placeholder="Type Here...">
                                    <div id="EMAIL_valid"></div>
                                    <script>
                                        const emailInput = document.getElementById('email');
                                        emailInput.addEventListener('input', function() {
                                        if (!emailInput.checkValidity()) 
                                        {
                                            emailInput.style.borderColor = 'red';
                                            $('#EMAIL_valid').html(`<span style='color:red'>Email Not Valid</span>`);
                                        } else {
                                            emailInput.style.borderColor = '';
                                            $('#EMAIL_valid').html(``);

                                        }
                                        });
                                    </script>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Pan Card *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm pan" name="pan" value="<?php echo $pan;?>" id="pan" placeholder="Type Here..." required>
                                    <div id="pan_valid"></div>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Select Gender *</label>
                                    <select class="form-control form-control-sm" required name="gen" id="gen">
                                        <?php if($click=='reg')
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
                                <div class="group-form col-md-8">
                                    <label for="inputEmail3" class="form_label">Address *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="address" value="<?php echo $address;?>" id="address" placeholder="Type Here..." required>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Customer Bank Detail's</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label" id="checku">Account No *</label>
                                    <input type="text" class="col-sm-4 form-control form-control-sm" value="<?php echo $account;?>" onInput="checku()" name="acc" id="acc" placeholder="Type Here..." required maxlength="20">
                                    <div id="msg"></div>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Bank Name *</label>
                                    <input type="text" class="col-sm-4 form-control form-control-sm" value="<?php echo $bank;?>" name="bank" id="bank" placeholder="Type Here..." required>    
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">IFSC Code *</label>
                                        <input type="text" class="col-sm-4 form-control form-control-sm ifsc" value="<?php echo $ifsc;?>" name="ifsc" id="ifsc"
                                            placeholder="Type Here..." required>
                                        <div id="ifsc_valid"></div>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Branch Name *</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" value="<?php echo $branch;?>" name="branch" id="branch"
                                            placeholder="Type Here..." required>

                                    
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Nominee *</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" value="<?php echo $nominee;?>" name="nom" id="nom" placeholder="Type Here..." required>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Relationship *</label>
                                        <input type="text" class=" col-sm-4 form-control form-control-sm" value="<?php echo $relation;?>" name="rel" id="rel"
                                            placeholder="Type Here..." required>
                                </div>
                            </div></br>
                            <?php 
                                if($click !='view')
                                {
                            ?>
                                    <div class="row">
                                        <div class="group-form col-md-12">
                                            <h3>
                                                <b>Log In Details</b>
                                            </h3>
                                        </div>
                                    </div></br>
                                    <div class="row">
                                        <div class="group-form col-md-4">
                                            <label for="inputEmail3" class="form_label">Username *</label>
                                            <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="username" id="username" placeholder="" required value="<?php echo $username;?>">
                                        </div>
                                        <div class="group-form col-md-4">
                                            <label for="inputEmail3" class="form_label">Password *</label>
                                            <input type="text" class=" col-sm-4 form-control form-control-sm" readonly name="password" id="password" placeholder="" required value="<?php echo $password;?>">
                                        </div>
                                    </div></br>          
                          <?php }  ?>
                        </div>
                        <div class="box-footer">
                            <center>
                                <?php if($click=='reg')
                                    {
                                        ?>
                                            <button type="submit" name="submit" id="sub" class="btn btn-primary regsub">Submit</button>
                                        <?php
                                    }else if($click=='edit')
                                    {
                                        ?>
                                            <button type="submit" name="update" class="btn btn-danger">Update</button>
                                            <a href="register_customer1.php" class="btn btn-primary">Back</a>
                                        <?php
                                    }else if($click=='view')
                                    {
                                        ?>
                                            <a href="register_customer1.php" class="btn btn-primary">Back</a>
                                        <?php
                                    }
                                ?>
                            </center>
                        </div>
                    </form>
                </div>
            </section>
        </div><?php include("footer.php"); ?>

        <div class="control-sidebar-bg"></div>
    </div>
    <script src="conn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
</body>
</html>