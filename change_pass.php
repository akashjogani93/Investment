<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
        </style>
        <?php require_once("header.php"); ?>
		<script>
                $("#dyna").text("Change Password");
            </script>
        <div class="content-wrapper">
            <!-- <section class="content-header">
                <h1>
                    Change Password Admin Side.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->

            <section class="content">
                <div class="box">
                    <div class="box-body">
                    <form action="" method="post" enctype="multipart/form-data">  
          	 	<div class="table-responsive">
          	 	  <table class="table table-bordered">
                    <thead>
                    	<tr>
	                    	<th>Enter Password:</th>
                        <td><input type="text" name="old" class="form-control form-control-sm" required="" style="border:1px solid black;">
                        <input type="text" value="0" name="id" class="form-control form-control-sm" required="" style="display:none;">
                       
                    	</tr>
                    	<tr>
                    		<th>Create password:</th>
                    		<td><input type="text" name="createpass" id="files" class="form-control form-control-sm"  required="" style="border:1px solid black;"/></td>
                    	</tr>
                    	<tr>
                    		<th>Confirm Password</th>
                    		<td><input type="text" class="form-control form-control-sm" name="confirmpass" required="" title="Select Html File" style="border:1px solid black;"></td>
                    	</tr>
                          
                    		<tr>
                    			<td></td>
                    			<td>
                    				<button type="submit" name="New_pass" class="btn btn-sm btn-success col-md-3">Submit</button>
                    				<button type="reset" class="btn btn-sm btn-danger col-md-3">Reset</button>
                    			</td>
                    		</tr>
                    	</thead>
                    	</table>
                    </div>
                    </form></br>
                        </div>
                </div>
            </section>


        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>

<?php  
 //update Password
if(isset($_POST['New_pass']))
{
    $password=$_POST['old'];
    $id=$_POST['id'];
	$create_pass=$_POST['createpass'];
	$confirm_pass=$_POST['confirmpass'];
    if($create_pass==$confirm_pass)
	{
		$query="SELECT * FROM `login` WHERE `cid`='$id' AND `password`='$password' AND `user`='admin';";
		$confirm=mysqli_query($conn,$query) or die(mysqli_error());
		if($confirm)
		{
			$query="UPDATE `login` SET `password`='$confirm_pass' WHERE `user`='admin' AND `cid`='$id';";
			$confirm=mysqli_query($conn,$query) or die(mysqli_error());
			if($confirm)
			{
			    echo "<script>alert('Password Updated');</script>";
				echo "<script>location='logout.php';</script>";
			}
		}
	}else{
		echo "<script>alert('Password Wrong, Try Again');</script>";
		echo "<script>location='change_pass.php';</script>";
	}
}