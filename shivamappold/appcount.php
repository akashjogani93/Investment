<?php
  include("../dbcon.php");
  $currentDateTime = date('Y-m-d H:i:s');
  $sql = "INSERT INTO `appcount`( `flag`,`datetime`) VALUES ('Yes','$currentDateTime');";
			$query = mysqli_query($conn,$sql);
			if($query){ return "true"; }else{
                return "false";
            }
?>