            <?php include('../dbcon.php');?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Bank</th>
                        <th>IFSC</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $query="SELECT `register`.*,`login`.`username`,`login`.`password` FROM `register`,`login` WHERE `register`.`cid`=`login`.`cid` ORDER BY `register`.`cid`";
                            $retval=mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($retval)) 
                            {
                                ?>
                                    
                                    <tr>
                                        <td><?php echo $row['cid'];?></td>
                                        <td><?php echo $row['full'];?></td>
                                        <td><?php echo $row['mobile'];?></td>
                                        <td><?php echo $row['bank'];?></td>
                                        <td><?php echo $row['ifsc'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td><?php echo $row['password'];?></td>
                                        <td><a href="registration.php?edit=<?php echo $row['cid'];?>" class="btn btn-danger">Edit</a><a href="registration.php?view=<?php echo $row['cid'];?>" class="btn btn-primary">view</a></td>
                                    </tr>
                                    
                                <?php
                            }  
                        ?>
                </tbody>
            
            </table>


        <script>
            $(function () {

                    $('#example1').dataTable({
                        pageLength : 25,
                        aLengthMenu: [
                        [25, 50, 100, 200, -1],
                        [25, 50, 100, 200, "All"]
                    ],
                    iDisplayLength: -1
                });
                    
					
               
                
            });
        </script>