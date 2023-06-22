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
?>

<?php if(isset($_POST['full1']))
    {
        $full=$_POST['full1'];
        $start=date("Y-m-01", strtotime("first day of this month"));
        $end=date("Y-m-d");
        if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
        $data="";
        $query="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `referal`.`id`=`invest`.`id` AND `referal`.`refcid`='$full'";
        $retval=mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($retval)) 
        {

                $full=$row['full'];
                $invest=$row['invest'];
                $refasign=$row['refasign'];
                $id=$row['id'];
                $regdate=$row['regdate'];
                $pday=(($invest*$refasign/100)/30);
                $pmonth=($invest*$refasign/100);
                //date Calculation
                $today=date("d-m-Y");

                $i_days=date_diff1($today,$regdate);

                $srch_date=date_diff1($today,$start);
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