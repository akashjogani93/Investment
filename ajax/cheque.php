<?php
include("../dbcon.php");

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $query = "SELECT * FROM `register` WHERE `cid`='$cid'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
}

if (isset($_POST['insert']))
{
    $date = $_POST['date'];
    $cid = $_POST['insert'];
    $aggid = $_POST['aggid'];

    $query="INSERT INTO `cheque`(`date`,`cid`,`aggid`) VALUES ('$date','$cid','$aggid')";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        echo mysqli_insert_id($conn);
    }
}

if (isset($_POST['aggId'])) 
{
    $aggId = $_POST['aggId'];
    $query = "SELECT * FROM `cheque` WHERE `id`='$aggId'";
    $result = mysqli_query($conn, $query);

    if ($result) 
    {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
}
?>

