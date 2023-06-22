<?php
include("../dbcon.php");


if(isset($_POST['in_id']))
{
    $in_id=$_POST['in_id'];
    $query="SELECT `invest`.*,`register`.`bank`,`register`.`mobile`,`register`.`account`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`id`='$in_id'";

    $a = array();
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) 
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result))
         {

            array_push($a,$row);
        }
    }
    echo json_encode($a);
    mysqli_close($conn);

}



if(isset($_POST['in_id_referal']))
{

    $in_id=$_POST['in_id_referal'];
    $sql="SELECT `referal`.*,`register`.`full`,`register`.`cid` FROM `referal`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `referal`.`id`='$in_id'";
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
}
?>