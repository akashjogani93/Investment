<?php
include("../dbcon.php");

if(!empty($_POST['acc']))
{
    $acc=$_POST['acc'];
    if(is_numeric($acc))
    {
        $query = "SELECT * FROM `register` WHERE `account`='$acc'";
        $result=mysqli_query($conn,$query);
        $count=mysqli_num_rows($result);
        if($count>0) 
        {
            echo "<span style='color:red'>Account Number already exists..</span>";
            echo "<script>$('#sub').prop('disabled',true);</script>";
        }else
        {
            if(strlen($acc) > 20)
            {
                
                echo "<span style='color:red'>Account Number Is Not Valid..</span>";
            }else
            {
                echo "<span style='color:green'>Account Number Is available To Enter</span>";
                echo "<script>$('#sub').prop('disabled',false)</script>";
            }
        }
    }else
    {
        echo "<span style='color:red'>Account Number Is Not Valid..</span>";
        echo "<script>$('#sub').prop('disabled',true);</script>";
    }
    
}



?>