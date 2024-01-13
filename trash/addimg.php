<?php
require_once('../dbcon.php');

    $cid = $_POST['cid'];
    //$tmpName = $_FILES["file"]["tmp_name"];
    $file_name = $_FILES['file']['name'];
    $file_tmp  = $_FILES['file']['tmp_name'];
    // $file = addslashes(file_get_contents($_FILES["screen"]["tmp_name"]));
    // $query = "INSERT INTO tbl_images(name) VALUES('$file')";
    // mysqli_query($conn, $query);
    echo $file_name;
?>
