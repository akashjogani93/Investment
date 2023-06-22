<?php include('../dbcon.php');
    function date_diff1($start,$end)
    {
        $diff=strtotime($start)-strtotime($end);
        //echo $diff;
        $days=abs(round($diff/86400));
        if($days==0)
        {
        return $days;
        }
        else
        {
        return $days;
        }
        
    }
    
       
if(isset($_POST["Submit"]))
{
     
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}

    $load=$_POST["load"];
    if($load=='directload')
    {
        $i=1;
        $query="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` ORDER BY `cid` ASC";
    }
    else
    {
        $i=0;
        $cid=$_POST["cid"];
        $i=$i+1;
        $query="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` WHERE `cid`='$cid' ORDER BY `cid` ASC";
    } 
    $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
    while($row=mysqli_fetch_array($confirm_query))
    {
        $cid=$row['cid'];
        $name=$row['full'];
        $q="SELECT SUM(`invest`.`invest`) as `investment` FROM `invest` WHERE `invest`.`cid`='$cid';";
        $c=mysqli_query($conn,$q) or die(mysqli_error());
        $r=mysqli_fetch_array($c);
        if($r['investment']==""){$invest="-";}else{$invest=$r['investment'];}
        $pay=payment_Calculation($conn,$cid,$start,$end);//this month payment calculation                 
            if($pay > 0)
            {
                ?>
                    <tr>
                        <td><?php echo $cid;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $pay;?></td>
                        <td><?php echo $a=round($pay*15/100);?></td>
                        <td><?php echo $k=$pay-$a;?></td>
                        <td><?php echo $row['bank'];?></td>
                        <td><?php echo $row['account'];?></td>
                        <td><?php echo $row['ifsc'];?></td>
                        <td><?php echo $row['pan']; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($end));?></td>
                    </tr>
                <?php
            }
    }
    
}

      
?>
<?php 
    function payment_Calculation($conn,$cid,$start,$end)
    {
        $total=$total1=0;
        $query ="SELECT `invest`.`id`,`register`.`cid`,`register`.`full`,`register`.`bank`,`register`.`account`,`invest`.`regdate`,`invest`.`invest`,`invest`.`asign`,`invest`.`pday` FROM `register`,`invest` WHERE `invest`.`regdate`<='$end' AND `register`.`cid` = `invest`.`cid` AND `register`.`cid`='$cid';";
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
                //echo "<script>alert('No investment');</script>";
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

                $i_days=date_diff1($today,$invest_date);
                $srch_date=date_diff1($today,$start);
                if($i_days>$srch_date)
                {
                    $date1=$start;
                }else{
                    $date1=$invest_date;
                }

                $days=date_diff1($end,$date1);
                $month_intres=$invest*$days;
                $total=$total + $month_intres; 
                // echo "<script>alert($amt);</script>";
            }
            
        }

        $query="SELECT `referal`.`id`,`referal`.`refasign`,`referal`.`refpday`,`register`.`cid`,`register`.`full`,`invest`.`regdate`,`invest`.`invest` FROM `register`,`referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$cid' AND `invest`.`regdate`<'$end';";
        $confirm = mysqli_query($conn,$query) or die(mysqli_error());
        
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
                }
                $amt=$out['invest']+$w_value;
                $perc=$out['refasign'];
                $day_amt=(($amt*$perc/100)/30);
                $full=$out['full'];
                $cid=$out['cid'];
                $invest_date=$out['regdate'];
                $invest=$day_amt;
                $today=date("d-m-Y");
                $i_days=date_diff1($today,$invest_date);
                $srch_date=date_diff1($today,$start);
                if($i_days>$srch_date)
                {
                  $date1=$start;
                }else{
                  $date1=$invest_date;
                }
                $days=date_diff1($end,$date1);
                $month_intres1=$invest*$days;
                $total1=$total1 + $month_intres1; 
        } return round($total+$total1);
    } 


    //NOT Important
?>