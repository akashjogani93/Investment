<?php include('../dbcon.php');
//not important
if(isset($_POST["Submit"]))
{
    $load=$_POST["load"];
    if($load=='directload')
    {
        $i=1;
        $start=date("Y-m-01", strtotime("first day of last month"));
        $end=date("Y-m-30", strtotime("last day of last month"));
        if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
        $query="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` ORDER BY `cid` ASC";
    }
    else
    {
        $i=1;
        $start=$_POST["fromdate"];
        $end=$_POST["todate"];
        $query="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` ORDER BY `cid` ASC";
    }
    $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
    while($out=mysqli_fetch_array($confirm_query))
    {
        $name=$out['full'];
        $cid=$out['cid'];
        $pay=payment_Calculation($conn,$cid,$start,$end);//this month payment calculation 
        if($pay > 0)
        {?>
        <tr>
            <td> <?php echo $out['cid'];?></td>
            <td> <?php echo $name;?></td>
            <td> <?php echo $pay; ?></td>
            <td> <?php echo date("d-m-Y", strtotime($end)); ?></td>
            <td> <?php echo $out['address']?></td>
            <td> <?php echo $out['bank']?></td>
            <td> <?php echo $out['account']; ?></td>
            <td> <?php echo $out['ifsc']; ?></td>
            <td><?php echo $out['pan']; ?></td>
        </tr>
    <?php }
    }
}
?>


<?php
function payment_Calculation($conn,$cid,$start,$end)
{
    $total=$total1=0;
    // $query ="SELECT `invest`.`i_id` AS `id`,`resister`.`cid` AS `cid`,`resister`.`full_name` as `fullname`,`resister`.`bank` as `bank`, `resister`.`acc_no` as `acc`,`invest`.`i_date` as `date`,`invest`.`temp` as `iv_amt`,`invest`.`pecentage` as `perc`,`invest`.`perday` as `day_amt` FROM `resister`,`invest` WHERE `invest`.`i_date`<='$end' AND `resister`.`cid` = `invest`.`cid` AND `resister`.`full_name`='$name';";
    $query ="SELECT `invest`.`id`,`register`.`cid`,`register`.`full`,`register`.`bank`,`register`.`account`,`invest`.`regdate`,`invest`.`invest`,`invest`.`asign`,`invest`.`pday` FROM `register`,`invest` WHERE `invest`.`regdate`<='$end' AND `register`.`cid`=`invest`.`cid` AND `register`.`cid`='$cid';";
    $confirm = mysqli_query($conn,$query) or die(mysqli_error());
    $result = mysqli_num_rows($confirm);
    if($result==0)
    {
        //echo "<script>alert('No investment');</script>";
        $total=0;
    }
    else
    { 
        while($out=mysqli_fetch_array($confirm))
        {
                $id=$out['id'];
                $w_value=0;
                $q="SELECT * FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
                $cfm = mysqli_query($conn,$q) or die(mysqli_error());
                $result = mysqli_num_rows($cfm);
                if($result>0)
                {
                    $data=mysqli_fetch_array($cfm);
                    $w_value=$data['wamt'];
                    //echo "<script>alert($w_value);</script>";
                }

                $amt=$out['invest']+$w_value;
                $perc=$out['asign'];
                $day_amt=(($amt*$perc/100)/30);
                $fullname=$out['full'];
                $cid=$out['cid'];
                $invest_date=$out['regdate'];
                $invest=$day_amt;
                $today=date("d-m-Y");

                $i_days=date_diff1($invest_date,$today);
                $srch_date=date_diff1($start,$today);
                if($i_days>$srch_date)
                {
                    $date1=$start;
                }else{
                    $date1=$invest_date;
                }
                $days=date_diff1($date1,$end);
                $month_intres=$invest*$days;
                $total=$total + $month_intres;
        }
    }return round($total+$total1);
}



//function thats gives number days bettween two dates
function date_diff1($start,$end)
{
	if((date("m", strtotime($end))=="02") && (date("d", strtotime($end))>"27")&& (date("d", strtotime($end))<"30"))
    {
    	$end = date("Y-m-30", strtotime($end));
    }
    $diff=strtotime($start)-strtotime($end);
    $days=abs(round($diff/86400));
    if($days==0)
    {
      return $days;
    }
    else
    {
      return $days+1;
    }
}

?>