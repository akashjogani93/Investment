<?php
include("../dbcon.php");
if (isset($_POST['deleteid'])) {
    $deleteid=trim($_POST['deleteid']);
    $tabname=trim($_POST['tabname']);
    $query="DELETE FROM $tabname WHERE `id`='$deleteid'";
    $co=mysqli_query($conn,$query);
    echo 'Deleted';
} else {
    echo "No deleteid parameter received.";
}
?>