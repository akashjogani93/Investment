<?php
include("../dbcon.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
if(isset($_POST["limit"], $_POST["start"]))
{
    $limit=$_POST["limit"];
    $std=$_POST["start"];
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $i=1;
    $query="SELECT DISTINCT `register`.`cid` AS `cid`, `register`.`full` AS `fullname`,`register`.`address` as `place`, `register`.`bank` AS `bank`,`register`.`account` AS `acc_no`,`register`.`ifsc` AS `isfc`, `register`.`pan` AS `pan_card_num` FROM `register` WHERE `register`.`cid`< 50 ORDER BY `register`.`cid` ASC LIMIT $std, $limit;";
     $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
    $num= mysqli_num_rows($confirm_query);
    if($num>0)
    {
     while($row=mysqli_fetch_array($confirm_query))
    {
       $id=$row['cid'];
       $cid=$row['cid'];
        $name=$row['fullname'];
         $q="SELECT SUM(`invest`.`temp`) as `investment` FROM `invest` WHERE `invest`.`cid`='$id';";
       $c=mysqli_query($conn,$q) or die(mysqli_error());
        $r=mysqli_fetch_array($c);
        if($r['investment']==""){$invest="-";}else{$invest=$r['investment'];}

        //goldplan investmet
        // $g="SELECT SUM(`amount`) FROM `plan` WHERE `cid`='$id';";
        // $g_c=mysqli_query($conn,$g) or die(mysqli_error());
        // $gold=mysqli_fetch_array($g_c);
        // if($gold[0]==""){$god="-";}else{$god=$gold[0];}
        $pay=payment_Calculation($conn,$cid,$start,$end);//this month payment calculation                 
          if($pay > 0){?>
        <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $name;?></td>
            <td class="pay"><?php echo $pay;?></td>
            <td class="five"><?php echo $a=round($pay*5/100);?></td>
            <td class="famt"><?php echo $k=$pay-$a;?></td>
            <td><?php echo $row['place']; ?></td>
            <td><?php echo $row['bank'];?></td>
            <td><?php echo $row['acc_no'];?></td>
            <td><?php echo $row['isfc'];?></td>
            <td><?php echo $row['pan_card_num']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($end));?></td>
        </tr>
        <?php 
        } 
    }
    }
}

if(isset($_POST["submit"], $_POST["name"]))
{
    $i=0;
    $name=$_POST["name"];
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $i=$i+1;
    $query="SELECT DISTINCT `resister`.`cid` AS `cid`, `resister`.`full_name` AS `fullname`,`resister`.`address` as `place`, `resister`.`bank` AS `bank`,`resister`.`acc_no` AS `acc_no`,`resister`.`isfc_no` AS `isfc`, `resister`.`pan_card_num` AS `pan_card_num` FROM `resister` WHERE `resister`.`full_name`='$name' ORDER BY `resister`.`cid`;";
     $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
     while($row=mysqli_fetch_array($confirm_query))
    {
        $id=$row['cid'];
        $name=$row['fullname'];
         $q="SELECT SUM(`invest`.`temp`) as `investment` FROM `invest` WHERE `invest`.`cid`='$id';";
       $c=mysqli_query($conn,$q) or die(mysqli_error());
        $r=mysqli_fetch_array($c);
        if($r['investment']==""){$invest="-";}else{$invest=$r['investment'];}

        //goldplan investmet
        $g="SELECT `amount` FROM `plan` WHERE `cid`='$id';";
        $g_c=mysqli_query($conn,$g) or die(mysqli_error());
        $gold=mysqli_fetch_array($g_c);
        if($gold['amount']==""){$god="-";}else{$god=$gold['amount'];}
        $pay=payment_Calculation($conn,$name,$start,$end);//this month payment calculation                 
        if($pay > 0){?>
        <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $pay;?></td>
            <td><?php echo $a=round($pay*5/100);?></td>
            <td><?php echo $k=$pay-$a;?></td>
            <td><?php echo $row['place']; ?></td>
            <td><?php echo $row['bank'];?></td>
            <td><?php echo $row['acc_no'];?></td>
            <td><?php echo $row['isfc'];?></td>
            <td><?php echo $row['pan_card_num']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($end));?></td>
        </tr>
        <?php 
        } 
        $tpay=$tpay+ $pay;
        $ta = $ta+$a;
        $tk = $tk+$k;
    } ?>
    <tr>
        <td colspan="2"></td>
        <td><?php echo $tpay;?></td>
        <td><?php echo $ta;?></td>
        <td><?php echo $tk;?></td>
        <td colspan="5"></td>
    </tr>
    <?php
}
*/
if(isset($_POST["fromdate"]) && isset($_POST["todate"]) && isset($_POST["limit"]) && isset($_POST["start"]))
{
    $limit=$_POST["limit"];
    $std=$_POST["start"];
    $i=0;
    // $name=$_POST["name"];
    $start=date("Y-m-d", strtotime($_POST["fromdate"]));
    $end=date("Y-m-d", strtotime($_POST["todate"]));
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $i=$i+1;
    $query="SELECT DISTINCT `register`.`cid` AS `cid`, `register`.`full` AS `fullname`,`register`.`address` as `place`, `register`.`bank` AS `bank`,`register`.`account` AS `acc_no`,`register`.`ifsc` AS `isfc`, `register`.`pan` AS `pan_card_num` FROM `register` WHERE `register`.`cid`< 50 ORDER BY `register`.`cid` ASC LIMIT $std, $limit;";
     $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
    while($row=mysqli_fetch_array($confirm_query))
    {
        $id=$row['cid'];
        $name=$row['fullname'];
        $q="SELECT SUM(`invest`.`invest`) as `investment` FROM `invest` WHERE `invest`.`cid`='$id';";
       $c=mysqli_query($conn,$q) or die(mysqli_error());
        $r=mysqli_fetch_array($c);
        if($r['investment']==""){$invest="-";}else{$invest=$r['investment'];}
        $cid=$row['cid'];
        //goldplan investmet
        // $g="SELECT `amount` FROM `plan` WHERE `cid`='$id';";
        // $g_c=mysqli_query($conn,$g) or die(mysqli_error());
        // $gold=mysqli_fetch_array($g_c);
        // if($gold['amount']==""){$god="-";}else{$god=$gold['amount'];}
        $pay=payment_Calculation($conn,$cid,$start,$end);//this month payment calculation                 
        if($pay > 0)
        {
            ?>
            <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $name;?></td>
                <td><?php echo $pay;?></td>
                <td><?php echo $a=round($pay*5/100);?></td>
                <td><?php echo $k=$pay-$a;?></td>
                <td><?php echo $row['place']; ?></td>
                <td><?php echo $row['bank'];?></td>
                <td><?php echo $row['acc_no'];?></td>
                <td><?php echo $row['isfc'];?></td>
                <td><?php echo $row['pan_card_num']; ?></td>
                <td><?php echo date("d-m-Y",strtotime($end));?></td>
            </tr>
            <?php }
            //  $tpay=$tpay+ $pay;
            //         $ta = $ta+$a;
            //         $tk = $tk+$k;
    } ?>
        <!-- <tr>
            <td colspan="2"></td>
            <td><?php //echo $tpay;?></td>
            <td><?php //echo $ta;?></td>
            <td><?php //echo $tk;?></td>
            <td colspan="5"></td>
        </tr> -->
        <?php
} ?>


<?php
function payment_Calculation($conn,$cid,$start,$end)
{
    $total=$total1=0;
    // $query ="SELECT `invest`.`i_id` AS `id`,`resister`.`cid` AS `cid`,`resister`.`full_name` as `fullname`,`resister`.`bank` as `bank`, `resister`.`acc_no` as `acc`,`invest`.`i_date` as `date`,`invest`.`temp` as `iv_amt`,`invest`.`pecentage` as `perc`,`invest`.`perday` as `day_amt` FROM `resister`,`invest` WHERE `invest`.`i_date`<='$end' AND `resister`.`cid` = `invest`.`cid` AND `resister`.`full_name`='$name';";

    $query="SELECT `invest`.`id` AS `id`,`register`.`cid` AS `cid`,`register`.`full` AS `fullname`,`register`.`bank` AS `bank`,`register`.`account` AS `acc`,`invest`.`regdate` As `date`,`invest`.`invest` AS `iv_amt`,`invest`.`asign` AS `perc`,`invest`.`pday` AS `day_amt` FROM `register`,`invest` WHERE `invest`.`regdate`<='$end' AND `register`.`cid`=`invest`.`cid` AND `register`.`cid`=$cid";
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
           
            $amt=$out['iv_amt']+$w_value;
            $perc=$out['perc'];
            $day_amt=(($amt*$perc/100)/30);
            $fullname=$out['fullname'];
            $cid=$out['cid'];
            $invest_date=$out['date'];
            $invest=$day_amt;
            //$date1=$out['pdate'];
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
    }
    // $query="SELECT `introduce`.`i_id` AS `id`,
    //                 `resister`.`cid` as `cid`,
    //                 `resister`.`full_name` as `fullname`,
    //                 `invest`.`i_date` AS `date`,
    //                 `invest`.`temp` AS `value`,
    //                 `introduce`.`r_pecentag` as `perc`,
    //                  `introduce`.`r_perday` AS `perday`
    //         FROM `resister`,`introduce`, `invest`
    //         WHERE `introduce`.`i_id`=`invest`.`i_id` 
    //                 AND `invest`.`cid`=`resister`.`cid`
    //                 AND `introduce`.`r_name`='$name' 
    //                 AND `invest`.`i_date`<'$end';";

    $query="SELECT `referal`.`id` AS `id`,
                `register`.`cid` as `cid`,
                `register`.`full` as `fullname`,
                `invest`.`regdate` AS `date`,
                `invest`.`invest` AS `value`,
                `referal`.`refasign` as `perc`,
                `referal`.`refpday` AS `perday`
            FROM `register`,`referal`, `invest`
            WHERE `referal`.`id`=`invest`.`id` 
                AND `invest`.`cid`=`register`.`cid`
                AND `referal`.`refcid`='$cid' 
                AND `invest`.`regdate`<'$end';";

    $confirm = mysqli_query($conn,$query) or die(mysqli_error());
    while($out=mysqli_fetch_array($confirm))
    {
        $i_id=$out['id'];
        $w_value=0;
        $q="SELECT * FROM `widraw` WHERE `inv_id`='$i_id' AND `wdate`>'$end';";
        $cfm = mysqli_query($conn,$q) or die(mysqli_error());
        $result = mysqli_num_rows($cfm);
        if($result>0)
        {
            $data=mysqli_fetch_array($cfm);
            $w_value=$data['wamt'];
        }
        $amt=$out['value']+$w_value;
        $perc=$out['perc'];
        $day_amt=(($amt*$perc/100)/30);
        $fullname=$out['fullname'];
        $cid=$out['cid'];
        $invest_date=$out['date'];
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
        $month_intres1=$invest*$days;
        $total1=$total1 + $month_intres1; 
    }
    return round($total+$total1);
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