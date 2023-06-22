<?php


require_once('../dbcon.php');


$cid = $_POST['cid'];


$sql = "SELECT `invest`,`asign`,`pday`,`pmonth`,`regdate` FROM `invest` WHERE `id`='$cid'";


$a = array();
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { 
        array_push($a,$row);
    }
}
echo json_encode($a);
mysqli_close($conn);
?>


