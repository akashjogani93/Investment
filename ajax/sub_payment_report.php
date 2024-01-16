<?php include('../dbcon.php'); 
$formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
$formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
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
          return $days+1;
        }
        
    }
?>


<?php if(isset($_POST['cid']))
    {
        $cid=$_POST['cid'];
        $total=0;$total1=0;$total2=0;$total3=0;
        $month_intres1=$default=$default_total1=$default_total=0;;$amt1=0;
        $start=date("Y-m-01", strtotime("first day of this month"));
        $end=date("Y-m-d");
        if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
        

        // $query ="SELECT `invest`.`i_id` AS `id`,`resister`.`cid` AS `cid`,`resister`.`full_name` as `fullname`,`resister`.`bank` as `bank`, `resister`.`acc_no` as `acc`,`invest`.`i_date` as `date`,`invest`.`temp` as `iv_amt`,`invest`.`pecentage` as `perc`,`invest`.`perday` as `day_amt` FROM `resister`,`invest` WHERE `invest`.`i_date`<='$end' AND `resister`.`cid` = `invest`.`cid` AND `resister`.`full_name`='$name';";
        $query="SELECT * FROM `invest` WHERE `cid`='$cid' AND `regdate`<='$end'";
        $confirm = mysqli_query($conn,$query) or die(mysqli_error());
        $result = mysqli_num_rows($confirm);
        if($result==0)
        {
            
        }
        else
        { $default_total1=$total1=0;
            $amt1=0;
            
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
                // $fullname=$out['full'];
                // $cid=$out['cid'];
                $invest_date=$out['regdate'];
                $invest=$day_amt;
                //$date1=$out['pdate'];
                $today=date("d-m-Y");
                $i_days=date_diff1($today,$invest_date);
                $srch_date=date_diff1($today,$start);
                if($i_days>$srch_date)
                {
                    $date1=$start;
                }else{
                    $date1=$invest_date;
                    // echo "<script>alert('Customer Invested After your Search date');</script>";
                }
                $days=date_diff1($end,$date1);
                $month_intres=$invest*$days;
                $default = $invest*30;
                $default_total =  $default_total + $default;
                ?>
                    <tr>
                        <td><?php echo $out['id']; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($invest_date)); ?></td>
                        <td><?php echo $formatter->format($amt); ?></td>
                        <td><?php echo $out['asign']; ?></td>
                        <td><?php echo $formatter->format($day_amt); ?></td>
                        <td><?php echo $days ?></td>
                        <td><?php echo $formatter->format($month_intres); ?></td>  
                        <td><?php echo $formatter->format($default); ?></td>   
                    </tr>
                <?php
                $amt1=$amt1+$amt;
                $total1=$total1+$month_intres;
                $default_total1=$default_total1+$default;
            }?>
            <tr style="background-color:silver;" id="botom1">
                <th></th>
                <th></th>
                <th><?php echo $formatter->format($amt1); ?></th>  
                <th></th>
                <th></th>
                <th></th>
                <th><?php echo $formatter->format($total1); ?></th>
                <th><?php echo $formatter->format($default_total1); ?></th>
            </tr>
            <?php
        }
    }

?>
<?php if(isset($_POST['cid1']))
{
    $cid1=$_POST['cid1'];
    $amt1=0;
   
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $query="SELECT `referal`.`id`,`referal`.`refasign`,`referal`.`refpday`,`register`.`cid`,`register`.`full`,`invest`.`regdate`,`invest`.`invest` FROM `register`,`referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$cid1' AND `invest`.`regdate`<'$end';";

    $conf=mysqli_query($conn,$query) or die(mysqli_error());
    $default_total1=$total1=0;
    while($out=mysqli_fetch_array($conf))
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
        $amt=$out['invest']+$w_value;
        $perc=$out['refasign'];
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
        }else
        {
            $date1=$invest_date;
            // echo "<script>alert('Customer Invested After your Search date');</script>";
        }

        $days=date_diff1($end,$date1);
        $month_intres1=$invest*$days;
        $default = $invest*30;
        $default_total1 =  $default_total1 + $default;
        $total1=$total1 + $month_intres1;
        $amt1=$amt1+$amt;
        ?>
            <tr>
                <td scope="row"><?php echo $out['id']; ?></td>
                <td><?php echo $fullname; ?></td>
                <td><?php echo $formatter->format($amt); ?></td>
                <td><?php echo $out['refasign']; ?></td>
                <td><?php echo $formatter->format($invest); ?></td>
                <td><?php echo $days; ?></td>  
                <td><?php echo $formatter->format($month_intres1); ?> </td>
                <td><?php echo $formatter->format($default); ?></td>  
            </tr>
        <?php
    }
    ?>
        <tr style="background-color:silver;" id="botom">
            <th></th>
            <th></th>
            <th><?php echo $formatter->format($amt1); ?></th>  
            <th></th>
            <th></th>
            <th></th>
            <th><?php echo $formatter->format($total1); ?></th>
            <th><?php echo $formatter->format($default_total1); ?></th>
        </tr>
    <?php
}
?>