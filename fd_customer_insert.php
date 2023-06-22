<?php include('dbcon.php'); 
?>

<?php
    if(isset($_POST['submit']))
    {
        $cid=$_POST['cid'];
        $regdate=$_POST['regdate'];
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $mobile=$_POST['mobile'];
        $address=$_POST['address'];
        $gender=$_POST['gen'];
        $nominee=$_POST['nom'];
        $relation=$_POST['rel'];
        $full=$fname." ".$mname." ".$lname;
        $query="INSERT INTO `fd_customers`(`f_cid`, `regdate`, `fname`, `mname`, `lname`, `mobile`, `gen`, `adds`, `nominee`, `relation`, `full`)
        VALUES('$cid','$regdate','$fname','$mname','$lname','$mobile','$gender','$address','$nominee','$relation','$full')";
         $confirm = mysqli_query($conn,$query) or die(mysqli_error());
         if($confirm)
         {
            echo "<script>alert('Registration successfull');</script>";
            echo '<script> window.location="fd_registraion.php"; </script>';
         }
    }
?>