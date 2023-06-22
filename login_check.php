<?php session_start();
// ini_set('display_errors', 1);
include("dbcon.php");

$na1=$_POST["uname"];
$na2=$_POST["pass"];
// $user=$_POST["user"];


$query="SELECT * FROM `login` WHERE `username`='$na1' and `password`='$na2'";
$confirm=mysqli_query($conn,$query) or die(mysqli_error());
$result=mysqli_num_rows($confirm);
if($result!=0)
{   
	$out=mysqli_fetch_array($confirm);
	$id=$out['cid'];
	// end data of log infoss
	$qry="SELECT `end_time` FROM `log_permission` ORDER BY `log_per_id` DESC LIMIT 1;";
	$conf=mysqli_query($conn,$qry) or die(mysqli_error());
	$row=mysqli_fetch_array($conf);
	$end_time=$row['end_time'];
	$_SESSION['endtime']=$end_time;
	$type=$out['user'];
	$_SESSION["type"]=$type;
	$_SESSION["id"] = $id;

	date_default_timezone_set('Asia/Calcutta'); 
	//echo date("Y-m-d H:i:s");
	$date=date("Y-m-d H:i:s");
	if($type=='admin')
	{  
		$q="INSERT INTO `log_info`(`cid`,`login`,`logout`)VALUES('$id','$date',' ')";
		$cfm=mysqli_query($conn,$q) or die(mysqli_error());
		?>
        <script>alert("Login successfull");</script>;
		<?php
        echo '<script>location="home.php"</script>';
	}
	else if($type=='manager')
	{
		$q="INSERT INTO `log_info`(`cid`,`login`,`logout`)VALUES('$id','$date',' ')";
		$cfm=mysqli_query($conn,$q) or die(mysqli_error());
		?>
        <script>alert("Login successfull");</script>;
		<?php
        echo '<script>location="home.php"</script>';
	}
	else
	{
		if($_SESSION["endtime"]>$date && $_SESSION["endtime"]!="")
		{
			$q="INSERT INTO `log_info`(`cid`,`login`,`logout`)VALUES('$id','$date',' ')";
			$cfm=mysqli_query($conn,$q) or die(mysqli_error());
			echo '<script>alert("Login successfull");</script>';
			echo '<script>location="home.php"</script>';
			exit;
		}else
		{
			echo '<script>alert("Login Stoped");</script>';
			echo '<script>location="index.php"</script>';
		}
		
	}
	
}else
{
	echo '<script>alert("Login Unsucessfull");</script>';
	echo '<script>location="index.php"</script>';
}
	


?>