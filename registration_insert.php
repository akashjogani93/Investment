<?php include('dbcon.php'); 
include('sms.php'); 
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
        $email=$_POST['email'];
        $pan=$_POST['pan'];
        $address=$_POST['address'];
        $blood=$_POST['blood'];
        $gender=$_POST['gen'];
        $bank=$_POST['bank'];
        $account=$_POST['acc'];
        $ifsc=$_POST['ifsc'];
        $branch=$_POST['branch'];
        $nominee=$_POST['nom'];
        $relation=$_POST['rel'];
        $full=$fname." ".$mname." ".$lname;
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $msg = "Welcome to SHIVAM ASSOCIATES  log-in link: www.shivambgm.com , user name: $user , password: $pass";
        $query="INSERT INTO `register`(`cid`, `regdate`, `fname`, `mname`, `lname`, `mobile`, `email`, `pan`, `address`, `blood`, `gender`, `bank`, `account`, `ifsc`, `branch`, `nominee`, `relation`,`full`) 
        VALUES('$cid','$regdate','$fname','$mname','$lname','$mobile','$email','$pan','$address','$blood','$gender','$bank','$account','$ifsc','$branch','$nominee','$relation','$full')";
         $confirm = mysqli_query($conn,$query) or die(mysqli_error());
         if($confirm)
         {
            $query="INSERT INTO `login`(`cid`, `username`, `password`, `user`) VALUES('$cid','$user','$pass','Member')";
            $confirm = mysqli_query($conn,$query) or die(mysqli_error());
            if($confirm)
            {
                sms($mobile,$msg,$conn);
                echo "<script>alert('Customer Register Successfully');</script>";
                echo '<script> window.location="registration.php"; </script>';
            }
         }
         else
         {
                echo "<script>alert('Registration Not successfully');</script>";
                echo '<script> window.location="registration.php"; </script>';
         }
    }
?>

<?php
    if(isset($_POST['update']))
    {
        $cid=$_POST['cid'];
        $regdate=$_POST['regdate'];
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $pan=$_POST['pan'];
        $address=$_POST['address'];
        $blood=$_POST['blood'];
        $gender=$_POST['gen'];
        $bank=$_POST['bank'];
        $account=$_POST['acc'];
        $ifsc=$_POST['ifsc'];
        $branch=$_POST['branch'];
        $nominee=$_POST['nom'];
        $relation=$_POST['rel'];
        $full=$fname." ".$mname." ".$lname;
        $user=$_POST['username'];
        $pass=$_POST['password'];

        $query="UPDATE `register` SET  `regdate`='$regdate',`fname`='$fname',`mname`='$mname',`lname`='$lname',`mobile`='$mobile',`email`='$email',`pan`='$pan',`address`='$address',`blood`='$blood',`gender`='$gender',`bank`='$bank',`account`='$account',`ifsc`='$ifsc',`branch`='$branch',`nominee`='$nominee',`relation`='$relation',`full`='$full' WHERE `cid`='$cid'";
        $confirm = mysqli_query($conn,$query) or die(mysqli_error());
         if($confirm)
         {
            $query="UPDATE `login` SET `username`='$user',`password`='$pass' WHERE `cid`='$cid'";
            $confirm = mysqli_query($conn,$query) or die(mysqli_error());
            if($confirm)
            {
                echo "<script>alert('Updated successfully');</script>";
                echo '<script> window.location="register_customer1.php"; </script>';
            }
         }
         else
         {
                echo "<script>alert('Not Updated successfully');</script>";
                echo '<script> window.location="register_customer1.php"; </script>';
         }
    }
?>