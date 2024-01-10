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
                    $a = array();
                    $total=0;$amt1=0;$totalint=0;
                    $full=$_POST['full1'];
                    $start=date("Y-m-01", strtotime("first day of this month"));
                    $end=date("Y-m-d");
                    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
                    $data="";
                    $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid` FROM `invest`,`register` WHERE `invest`.`cid`='$full' AND `invest`.`cid`=`register`.`cid`  ORDER BY `invest`.`id`";
                    $retval=mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($retval)) 
                    {
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
                        
                        $bank=$row['bank'];
                        $account=$row['account'];
                        $regdate=$row['regdate'];
                        $invest=$row['invest']+$w_value;
                        $asign=$row['asign'];
                        $pday=$row['pday'];
                        $pmonth=$row['pmonth'];

                        //date Calculation
                        $today=date("d-m-Y");

                        $i_days=date_diff1($today,$regdate);
                        
                        
                        $srch_date=date_diff1($today,$start);
                        if($i_days>$srch_date)
                        {
                            $date1=$start;
                        }else{
                            $date1=$regdate;
                            //echo "<script>alert('Customer Invested After your Search date');</script>";
                        }

                        
                        $days=date_diff1($end,$date1);
                        $totalinte=$pday*$days;

                        $total=$total + $pmonth;
                        $amt1=$amt1+$invest;
                        $totalint=$totalint+$totalinte;
                    }
                    $pmonthtotal=0;$totalinterest=0;$refinvest=0;
                    // $query1="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `referal`.`id`=`invest`.`id` AND `referal`.`refcid`='$full'";
                    $query1="SELECT DISTINCT `referal`.`id` AS `id`, `register`.`cid` as `cid`, `register`.`full` as `full`, `invest`.`regdate` AS `regdate`,`invest`.`invest` AS `invest`,`referal`.`refasign` as `refasign` FROM `register`,`referal`, `invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$full' AND `invest`.`regdate`<'$end';";
                    $retval1=mysqli_query($conn, $query1);
                    while ($row1 = mysqli_fetch_array($retval1)) 
                    {

                        // $full=$row['full'];
                        $id1=$row1['id'];
                        $w_value=0;
                        $q="SELECT * FROM `widraw` WHERE `inv_id`='$id1' AND `wdate`>'$end';";
                        $cfm = mysqli_query($conn,$q) or die(mysqli_error());
                        $result = mysqli_num_rows($cfm);
                        if($result>0)
                        {
                            $dat=mysqli_fetch_array($cfm);
                            $w_value=$dat['wamt'];
                        }
                        $invest1=$row1['invest']+$w_value;
                        $refasign=$row1['refasign'];
                        
                        $regdate1=$row1['regdate'];
                        $pday1=(($invest1*$refasign/100)/30);
                        $pmonth1=($invest1*$refasign/100);
                        //date Calculation
                        $today1=date("d-m-Y");

                        $i_days1=date_diff1($today1,$regdate1);

                        $srch_date1=date_diff1($today1,$start);
                        if($i_days1>$srch_date1)
                        {
                            $date2=$start;
                        }else{
                            $date2=$regdate1;
                            //echo "<script>alert('Customer Invested After your Search date');</script>";
                        }
                        $days1=date_diff1($end,$date2);
                        $totalinte1=$pday1*$days1;

                        $pmonthtotal=$pmonthtotal + $pmonth1;
                        $totalinterest=$totalinterest + $totalinte1;
                        $refinvest=$refinvest + $invest1;
                        
                    }
                    $maininterest=$totalint+$totalinterest;
                    $mainmonth=$pmonthtotal+$total;
                    array_push($a,$total,$amt1,round($totalint),$pmonthtotal,round($totalinterest),$refinvest,round($maininterest),$mainmonth);  
                    echo json_encode($a);
            } 
        ?>

            
                
                        
                
            
            


            