<?php
require_once('../dbcon.php');

$id=$_POST['data'];
$referals =$_POST['referals'];
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