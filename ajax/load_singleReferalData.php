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
          return $days+1;
        }
        
    }
?>

<?php if(isset($_POST['full1']))
    {
        $full=$_POST['full1'];
        $start=date("Y-m-01", strtotime("first day of this month"));
        $end=date("Y-m-d");
        if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
        $data="";
        // $query="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `referal`.`id`=`invest`.`id` AND `referal`.`refcid`='$full' AND `invest`.`regdate`<'$end'";

        $query="SELECT DISTINCT `referal`.`id` AS `id`, `register`.`cid` as `cid`, `register`.`full` as `full`, `invest`.`regdate` AS `regdate`,`invest`.`invest` AS `invest`,`referal`.`refasign` as `refasign` FROM `register`,`referal`, `invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$full' AND `invest`.`regdate`<'$end';";
        $today=date("d-m-Y");
        $srch_date=date_diff1($today,$start);
        $retval=mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($retval)) 
        {

                $full=$row['full'];
                $refasign=$row['refasign'];
                $id=$row['id'];
                $w_value=0;
                $q="SELECT * FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
                $cfm = mysqli_query($conn,$q) or die(mysqli_error());
                $result = mysqli_num_rows($cfm);
                if($result>0)
                {
                    $dat=mysqli_fetch_array($cfm);
                    $w_value=$dat['wamt'];
                }
                $invest=$row['invest']+$w_value;
                $regdate=$row['regdate'];
                $pday=(($invest*$refasign/100)/30);
                $pmonth=($invest*$refasign/100);
                //date Calculation
                

                $i_days=date_diff1($today,$regdate);

                
                if($i_days>$srch_date)
                {
                    $date1=$start;
                }else{
                    $date1=$regdate;
                    
                }
                $days=date_diff1($end,$date1);
                $totalinte=$pday*$days;

                $data.='<tr>
                            <td>'.$id.'</td>
                            <td>'.$full.'</td>
                            <td>'.$invest.'</td>  
                            <td>'.$refasign.'</td>
                            <td>'.round($pday).'</td>
                            <td>'.$days.'</td>
                            <td>'.number_format($totalinte,2).'</td>
                            <td>'.round($pmonth).'</td>
                            
                            
                        </tr>';
        }echo json_encode($data);
    }