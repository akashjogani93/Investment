<?php
require_once('../dbcon.php');
include('../sms.php');
$id=$_POST['data'];
$mobile=$_POST['mobile'];
$invest=$_POST['invest'];
$referals =$_POST['referals'];
$msg = "Rs ".$invest.", Successfully Added to your account.\nFrom: SHIVAM ASSOCIATES.\nThank You.";
if($referals != 0)
{
    foreach ($referals as $referal)
    {
        $q="INSERT INTO `referal`(`id`, `refcid`, `refasign`, `refpday`, `refpmonth`) VALUES 
        ('$id','$referal[0]','$referal[1]','$referal[2]','$referal[3]');";
        $conf=mysqli_query($conn,$q);
    }
} 
echo "Invested Successfully";
sms($mobile,$msg,$conn);
