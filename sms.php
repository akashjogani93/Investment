<?php
function sms($num,$msg,$conn)
{
        $websiteUrl = "http://whatsappapi.fastsmsindia.com";

        // Check if the website is up
        // $websiteUp = isWebsiteUp($websiteUrl);
        // if (!$websiteUp) {
        //     return "Website is down, unable to send SMS.";
        // }

		$sql = "SELECT COUNT(`sms_id`) AS `nsms` FROM `sms`;";
		$retval = mysqli_query($conn,$sql);
		$row1=mysqli_fetch_array($retval);
		if($row1[0] <= 150000)
		{
		// $authKey = "601fd060540c4372afc68e721d19d575";
        
        $authKey="24bc319aa3d44ebd9cb2373d0456372c";
		$mobileNumber = $num;
		$senderId = "SHIVAM";
		$message = $msg;
		$route = "default";
		$postData = array(
			'apikey' => $authKey,
			'mobile' => $mobileNumber,
			'msg' => $message
		);
		$url="http://whatsappapi.fastsmsindia.com/wapp/api/send";
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
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

function isWebsiteUp($url) {
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200 OK') !== false;
}
?>