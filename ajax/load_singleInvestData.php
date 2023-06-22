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
                $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid` FROM `invest`,`register` WHERE `invest`.`cid`='$full' AND `invest`.`cid`=`register`.`cid`  ORDER BY `invest`.`id`";
                $retval=mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($retval)) 
                {
                    $id=$row['id'];
                    // $w_value=0;
                    // $q="SELECT * FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
                    // $cfm = mysqli_query($conn,$q) or die(mysqli_error());
                    // $result = mysqli_num_rows($cfm);
                    // if($result>0)
                    // {
                    //     $dat=mysqli_fetch_array($cfm);
                    //     $w_value=$dat['wamt'];
                    //     //echo "<script>alert($w_value);</script>";
                    // }
                    
                    $bank=$row['bank'];
                    $account=$row['account'];
                    $regdate=$row['regdate'];
                    $invest=$row['invest'];
                    $asign=$row['asign'];
                    $pday=$row['pday'];
                    $pmonth=$row['pmonth'];
                    $pmode=$row['pmode'];
                    $path=$row['path'];
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
                    $data.='<tr>
                                <td>'.$id.'</td>
                                <td>'.$bank.'</td>
                                <td>'.$account.'</td>
                                <td>'.date("d-m-Y",strtotime($regdate)).'</td>
                                <td>'.$invest.'</td>
                                <td>'.$asign.'</td>
                                <td>'.$pday.'</td>
                                <td>'.$days.'</td>
                                <td>'.$totalinte.'</td>
                                <td>'.$pmonth.'</td>
                                <td>'.$pmode.'</td>';
                                if($path=='')
                                {
                                    $data.='<td>Invalid</td></tr>';
                                }
                                else
                                {
                                    $data.='<td><a href="ajax/'.$path.'" target="_blank" class="btn btn-info">Agreement</a></td></tr>';
                                }
                }  
                echo json_encode($data);
            } 
            
        ?>


                
                        
                
            
            


            