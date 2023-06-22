<?php 
include("dbcon.php");
session_start();
$id = $_SESSION["id"];
date_default_timezone_set('Asia/Calcutta');
$date=date("Y-m-d H:i:s");
$query="UPDATE `log_info` SET `logout`='$date' WHERE `cid`='$id' ORDER BY `logg_id` DESC LIMIT 1;";
$confirm=mysqli_query($conn,$query) or die(mysqli_error());
session_destroy();
header("location:index.php");
?>
