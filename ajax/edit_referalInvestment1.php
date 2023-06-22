<?php
require_once('../dbcon.php');

$id=$_POST['data'];
$referals =$_POST['referals'];
$q1="DELETE FROM `referal` WHERE `id`='$id'";
$cfm=mysqli_query($conn,$q1);
if($cfm)
{
    if($referals != 0)
    {
        foreach ($referals as $referal)
        {
            $q="INSERT INTO `referal`(`id`, `refcid`, `refasign`, `refpday`, `refpmonth`) VALUES 
            ('$id','$referal[0]','$referal[1]','$referal[2]','$referal[3]');";
            $conf=mysqli_query($conn,$q);
        }
    } 
    echo "Invetment Updated Successfully";
}