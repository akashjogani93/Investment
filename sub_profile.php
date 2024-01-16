<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            
            .table-container {
                max-height: 400px; /* Adjust the maximum height as needed */
                overflow-y: auto;
            }
            
            .scrollable-table {
                width: 100%;
                overflow-x: auto;
            }
        </style>
        <?php require_once("header.php"); ?>
        <?php
            $query="SELECT * FROM `register` WHERE `cid`='$id';";
            $confirm=mysqli_query($conn,$query) or die(mysqli_error());
            $out=mysqli_fetch_array($confirm);
            $query="SELECT * FROM `login` WHERE `cid`='$id' AND `user`='Member';";
            $confirm=mysqli_query($conn,$query) or die(mysqli_error());
            $logid=mysqli_fetch_array($confirm);
        ?>
        <div class="content-wrapper">
            <script>
                $("#dyna").text("profile detail");
                tex();
            </script>
            <section class="content">
                <div class="box box-default">
                    <div class="box-body table-container">
                    <table class="table table-striped scrollable-table" id="profile_table">
                        <tbody>
                            <tr >
                                <th scope="row">Membership Id:</th>
                                <td><?php echo $out['cid']; ?></td>
                                <th scope="row">Full Name:</th>
                                <td><?php echo $out['full']; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile_no:</th>
                                <td><?php echo $out['mobile']; ?></td>
                                <th>Email:</th>
                                <td><?php echo $out['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo $out['address']; ?></td>
                                <th>Gender:</th>
                                <td><?php echo $out['gender']; ?></td>
                            </tr>
                            <tr>
                                <th>Blood Group:</th>
                                <td><?php echo $out['blood']; ?></td>
                                <th>Pan Card:</th>
                                <td><?php echo $out['pan']; ?></td>
                            </tr>
                            <tr>
                                <th>Bank Name:</th>
                                <td><?php echo $out['bank']; ?></td>
                                <th>Branch Name:</th>
                                <td><?php echo $out['branch']; ?></td>
                            </tr>
                            <tr>
                                <th>Bank Account:</th>
                                <td><?php echo $out['account']; ?></td>
                                <th>Bank IFCF code:</th>
                                <td><?php echo $out['ifsc']; ?></td>
                            </tr>
                            <tr>
                                <th>Nominee:</th>
                                <td><?php echo $out['nominee']; ?></td>
                                <th>Relation:</th>
                                <td><?php echo $out['relation']; ?></td>
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
                </div>
            </section>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>        
