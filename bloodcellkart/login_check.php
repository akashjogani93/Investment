<?php session_start();
include("dbcon.php");

$user=$_POST["user"];
$pass=$_POST["pass"];

$query="SELECT * FROM `bloodcell_login` WHERE `user`='$user' and `pass`='$pass'";
$confirm=mysqli_query($conn,$query) or die(mysqli_error());
$result=mysqli_num_rows($confirm);
if($result!=0)
{   $_SESSION["login"]=true;
    if( $_SESSION["login"]==true){
	echo '<script>location="uploadevents.php"</script>';
    }else{
        echo '<script>location="index.php"</script>';
    }
}else{
  $_SESSION["login"]=false;
	echo '<script>alert("Login Unsucessfull");</script>';
  echo '<script>location="index.php"</script>';
}
?>