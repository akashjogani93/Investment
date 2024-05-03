<?php include('../dbcon.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_POST["limit"], $_POST["start"]))
{
    $limit=$_POST["limit"];
    $std=$_POST["start"];
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $i=1;
    // $query="SELECT DISTINCT `resister`.`cid` AS `cid`, `resister`.`full_name` AS `fullname`,`resister`.`address` as `place`, `resister`.`bank` AS `bank`,`resister`.`acc_no` AS `acc_no`,`resister`.`isfc_no` AS `isfc`, `resister`.`pan_card_num` AS `pan_card_num` FROM `resister` ORDER BY `resister`.`cid` ASC LIMIT $std, $limit;";
    // $query="SELECT DISTINCT `register`.`cid` AS `cid`, `register`.`full` AS `fullname`,`register`.`address` AS `place`,`register`.`bank` AS `bank`,`register`.`account` AS `acc_no`,`register`.`ifsc` AS `isfc`";
    $query="SELECT DISTINCT `register`.`cid` AS `cid`, `register`.`full` AS `fullname`,`register`.`address` as `place`, `register`.`bank` AS `bank`,`register`.`account` AS `acc_no`,`register`.`ifsc` AS `isfc`, `register`.`pan` AS `pan_card_num` FROM `register` ORDER BY `register`.`cid` ASC LIMIT $std, $limit;";

    $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
    $num= mysqli_num_rows($confirm_query);
    if($num>0)
    {
    }

}
?>