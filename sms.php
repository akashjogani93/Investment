<?php
//require_once('dbcon.php');
/*
if(isset($_GET['gp_name']))
{
	$gp_name=$_GET['gp_name'];
	$query="DELETE FROM `group_member` WHERE `groups`='$gp_name';";
	$confirm=mysqli_query($conn,$query) or die(mysqli_error());
	if($confirm)
	{
		$query="DELETE FROM `group` WHERE `gp_name`='$gp_name';";
		$confirm=mysqli_query($conn,$query) or die(mysqli_error());
		echo '<script> window.location= "group.php"; </script>';
	}
}	
if(isset($_GET['cid']))
{
	$gp_name=$_GET['gp'];
	$cid=$_GET['cid'];
	$query="DELETE FROM `group_member` WHERE `cid`='$cid';";
	$confirm=mysqli_query($conn,$query) or die(mysqli_error());
	if($confirm)
	{
		echo '<script> window.location="group_member.php?gp='.$gp_name.'"; </script>';
	}
}

if(isset($_POST['send_msg']))
{
	$num=$_POST['number'];
	$msg=$_POST['msg'];
	sms($num,$msg,$conn);
	echo '<script> window.location= "send_message.php"; </script>';
}
*/

function sms($num,$msg,$conn)
{
			$sql = "SELECT COUNT(`sms_id`) AS `nsms` FROM `sms`;";
			$retval = mysqli_query($conn,$sql);
			$row1=mysqli_fetch_array($retval);
			if($row1[0] <= 100000){

			//Your authentication key
			$authKey = "72188f5cc5a04e0fbb0f3659c4502b05";

			//Multiple mobiles numbers separated by comma
			$mobileNumber = $num;

			//Sender ID,While using route4 sender id should be 6 characters long.
			$senderId = "SHIVAM";

			//Your message to send, Add URL encoding here.
			$message = $msg;

			//Define route 
			$route = "default";
			//Prepare you post parameters
			$postData = array(
			    'apikey' => $authKey,
			    'mobile' => $mobileNumber,
			    'msg' => $message,
				// 'pdf'=> './pdf/'.$invest_id.'agrement.pdf',
			);

			//API URL
			$url="http://whatsappapi.fastsmsindia.com/wapp/api/send";

			// init the resource
			$ch = curl_init();
			curl_setopt_array($ch, array(
			    CURLOPT_URL => $url,
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_POST => true,
			    CURLOPT_POSTFIELDS => $postData
			    //,CURLOPT_FOLLOWLOCATION => true
			));


			//Ignore SSL certificate verification
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


			//get response
			$output = curl_exec($ch);

			//Print error if any
			if(curl_errno($ch))
			{
			    echo 'error:' . curl_error($ch);
			}
			curl_close($ch);
			$date=date("Y-m-d");
			$time=date("H:i:s");
			$sql = "INSERT INTO `sms`( `number`, `msg`, `date`, `time`) VALUES ('$num','$msg','$date','$time');";
			$retval = mysqli_query($conn,$sql);
			if($retval){ return "true"; }
		}else{
			return "false";
		}		
}
?>