<?php

if(isset($_POST['Submit']))
{
    $host = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "old_shiv";
    $connN = mysqli_connect($host,$dbuser,$dbpass,$db) or die("Cannot Connect to Database Server");
    // $d = mysqli_select_db($conn, $db) or die("Database does not exist");
    $query="SELECT * FROM `log_info` WHERE `logg_id`>'237224' ORDER BY `logg_id` ASC";
    $retval=mysqli_query($connN, $query);
    while ($row = mysqli_fetch_array($retval)) 
    {
        $w_id=$row['logg_id'];
        $cid=$row['cid'];
        $login=$row['login'];
        $logout=$row['logout'];
        
        $host1 = "localhost";
        $dbuser1 = "root";
        $dbpass1 = "";
        $db1 = "shivinvest2";
        //$db = "resto";
        $conn = mysqli_connect($host1,$dbuser1,$dbpass1,$db1) or die("Cannot Connect to Database Server");
        // $d1 = mysqli_select_db($conn, $db1) or die("Database does not exist");

        $q="INSERT INTO `log_info`(`cid`,`login`,`logout`)VALUES('$cid','$login','$logout')";
        $retval1=mysqli_query($conn, $q);
    }
    echo '<script>alert("passed")</script>';
}

?>