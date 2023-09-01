<?php
require_once('../dbcon.php');

$cid=$_POST['cid'];

$query="SELECT * FROM `register` WHERE `cid`='$cid'";
$exc=mysqli_query($conn,$query);
$rows=array();
while($row=mysqli_fetch_assoc($exc))
{
    $rows[]=$row;
}
echo json_encode($rows);

?>