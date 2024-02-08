<?php
    $host = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "investment1";
    $conn = mysqli_connect($host,$dbuser,$dbpass,$db) or die("Cannot Connect to Database Server");
    $d = mysqli_select_db($conn, $db) or die("Database does not exist");

    // $query="SELECT `cid`,`full` FROM `register` ORDER BY `cid`";
    // $exc=mysqli_query($conn,$query);
    // while($row=mysqli_fetch_assoc($exc))
    // {
    //     $cid=$row['cid'];
    //     $full=$row['full'];
    //     mysqli_query($conn,"UPDATE `referal` SET `refcid`='$cid' WHERE `r_name`='$full'");
    // }
?>

