<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
        </style>
        <?php require_once("header.php"); ?>
            
        
            
        
        
        <div class="content-wrapper" style="border:1px solid black;">
            <section class="content-header">
                <h1>
                    Profile Details
                </h1>
                <ol class="breadcrumb">
                    <li><a href="sub_home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>

            <section class="content">
                <div class="box box-default">
                    <?php
                        $query="SELECT * FROM `register` WHERE `cid`='$id';";
                        $confirm=mysqli_query($conn,$query) or die(mysqli_error());
                        $out=mysqli_fetch_array($confirm);
                        $query="SELECT * FROM `login` WHERE `cid`='$id' AND `user`='Member';";
                        $confirm=mysqli_query($conn,$query) or die(mysqli_error());
                        $logid=mysqli_fetch_array($confirm);
                    ?>
                    <table class="table table-striped" id="profile_table">
                        <tbody>
                            <tr >
                                <th scope="row">Membership Id:</th>
                                <td><?php echo $out['cid']; ?></td>
                                <th scope="row">Full Name:</th>
                                <td><?php echo $out['full']; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile_no1:</th>
                                <td><?php echo $out['mobile']; ?></td>
                                <th>Address:</th>
                                <td><?php echo $out['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Addredd:</th>
                                <td><?php echo $out['address']; ?></td>
                                <th>Gender:</th>
                                <td><?php echo $out['gender']; ?></td>
                            </tr>
                            <tr>
                                <th>Bank:</th>
                                <td><?php echo $out['bank']; ?></td>
                                <th>Bank Branch:</th>
                                <td><?php echo $out['branch']; ?></td>
                            </tr>
                            <tr>
                                <th>Bank Account:</th>
                                <td><?php echo $out['account']; ?></td>
                                <th>Bank IFCF code:</th>
                                <td><?php echo $out['ifsc']; ?></td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td><?php echo $logid['username']; ?></td>
                                <th>Password:</th>
                                <td><?php echo $logid['password']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>        
