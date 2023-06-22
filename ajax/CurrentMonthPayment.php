<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $new=$_POST["submit"];
    if($new=='Submit')
    {
        $i=1;
        // $sql = "SELECT SUM(`invest`.`invest`) as `investment`,`register`.`cid`,`register`.`full`,`register`.`address`,`register`.`bank`,`register`.`account`,`register`.`ifsc`,`register`.`pan` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid`";
        $sql = "SELECT DISTINCT `invest`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid`";
        // $sql = "SELECT `invest`.* FROM `invest`";
    }else if($new=='cid')
    {
       
        $i=0;
        $cid=$_POST["cid"];
        $i=$i+1;
        $sql="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` WHERE `cid`='$cid'";
        
    }
    $params = $columns = $totalRecords = $data = array();
    $params = $_REQUEST; 
    //define index of column
    $columns = array( 
        0 =>'cid',
        1 =>'full', 
        2 => 'invest',
        3 => 'till_date',
        4 =>'pay',
        5 =>'bank', 
        6 => 'account',
        7 => 'ifsc',
        8 => 'pan',
    );

    $where = $sqlTot = $sqlRec = "";

    //check search value exist
    // if( !empty($params['search']['value']) ) {   
    //     $where .=" WHERE ";
    //     $where .=" ( id LIKE '".$params['search']['value']."%' ) ";    
    //     $where .=" OR full LIKE '".$params['search']['value']."%' ";
    //     $where .=" OR mobile LIKE '".$params['search']['value']."%' ";
    // }

    // getting total number records without any search
    
    $sqlTot .= $sql;
    $sqlRec .= $sql;

    //concatenate search sql if value exist
    // if(isset($where) && $where != '')
    // {
    //     $sqlTot .= $where;
    //     $sqlRec .= $where;
    // }	
    if($params['length'] != 100)
    {
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir'];
    }else
    {
        // $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir'];
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
    }
    $queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));
    $totalRecords = mysqli_num_rows($queryTot);
    $queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");
    //iterate on results row and create new index array of data
    $data=[];
    $temp=[];
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    $today=date("d-m-Y");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $days=$srch_date=date_diff1($today,"2000-01-01");
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[0]; //cid
        $temp[1]=$row[1]; //full name

        $total=0;$invest=0;$total1=0;
        $query="SELECT `id`,`regdate`,`invest`,`asign` FROM `invest` WHERE `regdate`<='$end' AND `cid`='$temp[0]'";
        $confirm = mysqli_query($conn,$query) or die(mysqli_error());
        $result = mysqli_num_rows($confirm);
        if($result==0)
        {
            $total=0;
        }
        else
        {
            while($out=mysqli_fetch_array($confirm))
            {
                $id=$out['id'];
                $w_value=Calculation($conn,$id,$end);
                $invest=$invest+$out['invest']+$w_value; //total amount invested;
                $siinvest=$out['invest']+$w_value;
                $asign=$out['asign'];
                $pday=(($siinvest*$asign/100)/30);
                // $days=$srch_date=date_diff1($today,"2000-01-01"); //total profit
                $month_intres=$pday*$days;
                $total=$total+$month_intres;
            }
        }
        $query1="SELECT `referal`.`refasign`,`invest`.`id`,`invest`.`regdate`,`invest`.`invest` FROM `referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `referal`.`refcid`='$temp[0]' AND `invest`.`regdate`<'$end'";
        $confirm1 = mysqli_query($conn,$query1) or die(mysqli_error());
        while($out1=mysqli_fetch_array($confirm1))
        {
            $id=$out1['id'];
            $w_value=Calculation($conn,$id,$end);
            $amt1=$out1['invest']+$w_value;
            $asign1=$out1['refasign'];
            $pday1=(($amt1*$asign1/100)/30);
            $month_intres1=$pday1*$days;
            $total1=$total1+$month_intres1;
        }
            $temp[2]=$invest; //sum of invest
            $temp[3]=round($total+$total1); //total amount last to till by per day
            array_push($data,$temp);
    }
    // $data1[]=array($data);

    $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data // total data array
            );


    echo json_encode($json_data);
}
?>


<?php 
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

    // $load=$_POST["load"];
    // if($load=='directload')
    // {
        $i=1;
        $query="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` ORDER BY `cid` ASC";
    // }
    // else
    // {
    //     $i=0;
    //     $cid=$_POST["cid"];
    //     $i=$i+1;
    //     $query="SELECT DISTINCT `cid`,`full`,`address`,`bank`,`account`,`ifsc`,`pan` FROM `register` WHERE `cid`='$cid' ORDER BY `cid` ASC";
    // } 
    $confirm_query=mysqli_query($conn,$query) or die(mysqli_error());
    while($row=mysqli_fetch_array($confirm_query))
    {
        $cid=$row['cid'];
        $name=$row['full'];
        // $q="SELECT SUM(`invest`.`invest`) as `investment` FROM `invest` WHERE `invest`.`cid`='$cid';";
        // $c=mysqli_query($conn,$q) or die(mysqli_error());
        // $r=mysqli_fetch_array($c);
        // if($r['investment']==""){$invest="-";}else{$invest=$r['investment'];}
        // $pay=payment_Calculation($conn,$cid,$start,$end);               
        //     if($pay > 0)
        //     {
                ?>
                    <tr>
                        <td><?php echo $cid;?></td>
                        <td><?php echo $name;?></td>
                        <!-- <td><?php //echo $invest;?></td>
                        <td><?php //echo payment_Calculation($conn,$cid,"2000-01-01",$end);?></td>
                        <td><?php //echo $pay; ?></td>
                        <td><?php //echo $row['bank'];?></td>
                        <td><?php //echo $row['account'];?></td>
                        <td><?php //echo $row['ifsc'];?></td>
                        <td><?php //echo $row['pan']; ?></td> -->
                    </tr>
                <?php
            // }
    }
}
?>


<?php
    function Calculation($conn,$id,$end)
    {
        $w_value=0;
        $q="SELECT `wamt` FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
        $cfm = mysqli_query($conn,$q) or die(mysqli_error());
        $result = mysqli_num_rows($cfm);
        if($result>0)
        {
            $data=mysqli_fetch_array($cfm);
            $w_value=$data['wamt'];
        }
        return round($w_value);
    }

    function payment_Calculation($conn,$cid,$start,$end)
    {
        $total=$total1=0;
        // $query ="SELECT `invest`.`id`,`register`.`cid`,`register`.`full`,`register`.`bank`,`register`.`account`,`invest`.`regdate`,`invest`.`invest`,`invest`.`asign`,`invest`.`pday` FROM `register`,`invest` WHERE `invest`.`regdate`<='$end' AND `register`.`cid` = `invest`.`cid` AND `register`.`cid`='$cid';";
        $query="SELECT `id`,`regdate`,`invest`,`asign`,`pday` FROM `invest` WHERE `regdate`<='$end' AND `cid`='$cid'";
        $confirm = mysqli_query($conn,$query) or die(mysqli_error());
        $result = mysqli_num_rows($confirm);
        if($result==0)
        {
            $total=0;
        }
        else
        {   
            while($out=mysqli_fetch_array($confirm))
            {
                $id=$out['id'];
                $w_value=0;
                $q="SELECT `wamt` FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
                $cfm = mysqli_query($conn,$q) or die(mysqli_error());
                $result = mysqli_num_rows($cfm);
                if($result>0)
                {
                    $data=mysqli_fetch_array($cfm);
                    $w_value=$data['wamt'];
                }
                $amt=$out['invest']+$w_value;
                $perc=$out['asign'];
                $day_amt=(($amt*$perc/100)/30);
                // $fullname=$out['full'];
                // $cid=$out['cid'];
                $invest_date=$out['regdate'];
                // $invest=$day_amt;
                $today=date("d-m-Y");
                $i_days=date_diff1($today,$invest_date);
                // $total=$i_days;
                $srch_date=date_diff1($today,$start);
                if($i_days>$srch_date)
                {
                    $date1=$start;
                }else{
                    $date1=$invest_date;
                }
                $days=date_diff1($end,$date1);
                // $total=$days;
                $month_intres=$day_amt*$days;
                // $total=$month_intres;
                $total=$total + $month_intres;
            }
        }
        
        // $query="SELECT `referal`.`id`,`referal`.`refasign`,`referal`.`refpday`,`register`.`cid`,`register`.`full`,`invest`.`regdate`,`invest`.`invest` FROM `register`,`referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$cid' AND `invest`.`regdate`<'$end';";
        // $tot1=0;
        // // $id=0;
        $query="SELECT `referal`.`refasign`,`invest`.`id`,`invest`.`regdate`,`invest`.`invest` FROM `referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `referal`.`refcid`='$cid' AND `invest`.`regdate`<'$end'";
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
            $amt1=$out['invest']+$w_value;
            // $tot1=$tot1+$amt1;
            $perc=$out['refasign'];
            // $tot1=$tot1+$perc;
            $day_amt=(($amt1*$perc/100)/30);
            //         $full=$out['full'];
            //         $cid=$out['cid'];
            $invest_date=$out['regdate'];
            //         $invest=$day_amt;
            $today=date("d-m-Y");
            $i_days=date_diff1($today,$invest_date);
            // $total1=$i_days;
            $srch_date=date_diff1($today,$start);
            // $tot1=$srch_date;
            if($i_days>$srch_date)
            {
                $date1=$start;
            }else{
                $date1=$invest_date; 
            }
            $days=date_diff1($end,$date1);
            // $total1=$days;
            $month_intres1=$day_amt*$days;
            $total1=$total1 + $month_intres1; 
        }return round($total+$total1);
            // return round($total1);
    }


    // function payment_Calculation($conn,$cid,$start,$end)
    // {
    //     $total=$total1=0;
    //     $query ="SELECT `invest`.`id`,`register`.`cid`,`register`.`full`,`register`.`bank`,`register`.`account`,`invest`.`regdate`,`invest`.`invest`,`invest`.`asign`,`invest`.`pday` FROM `register`,`invest` WHERE `invest`.`regdate`<='$end' AND `register`.`cid` = `invest`.`cid` AND `register`.`cid`='$cid';";
    //     $confirm = mysqli_query($conn,$query) or die(mysqli_error());
    //     $result = mysqli_num_rows($confirm);
    //     if($result==0)
    //     {
    //         //echo "<script>alert('No investment');</script>";
    //         $total=0;
    //     }
    //     else
    //     { 
    //         while($out=mysqli_fetch_array($confirm))
    //         {
    //             //echo "<script>alert('No investment');</script>";
    //             $id=$out['id'];
    //             $w_value=0;
    //             $q="SELECT * FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
    //             $cfm = mysqli_query($conn,$q) or die(mysqli_error());
    //             $result = mysqli_num_rows($cfm);
    //             if($result>0)
    //             {
    //                 $data=mysqli_fetch_array($cfm);
    //                 $w_value=$data['wamt'];
    //                 //echo "<script>alert($w_value);</script>";
    //             }
    //             $amt=$out['invest']+$w_value;
    //             $perc=$out['asign'];
    //             $day_amt=(($amt*$perc/100)/30);
    //             $fullname=$out['full'];
    //             $cid=$out['cid'];
    //             $invest_date=$out['regdate'];
    //             $invest=$day_amt;
    //             $today=date("d-m-Y");

    //             $i_days=date_diff1($today,$invest_date);
    //             $srch_date=date_diff1($today,$start);
    //             if($i_days>$srch_date)
    //             {
    //                 $date1=$start;
    //             }else{
    //                 $date1=$invest_date;
    //             }

    //             $days=date_diff1($end,$date1);
    //             $month_intres=$invest*$days;
    //             $total=$total + $month_intres; 
    //             // echo "<script>alert($amt);</script>";
    //         }           
    //     }

    //     $query="SELECT `referal`.`id`,`referal`.`refasign`,`referal`.`refpday`,`register`.`cid`,`register`.`full`,`invest`.`regdate`,`invest`.`invest` FROM `register`,`referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$cid' AND `invest`.`regdate`<'$end';";
    //     $confirm = mysqli_query($conn,$query) or die(mysqli_error());
        
    //     while($out=mysqli_fetch_array($confirm))
    //     {
    //         $id=$out['id'];
    //         $w_value=0;
    //         $q="SELECT * FROM `widraw` WHERE `inv_id`='$id' AND `wdate`>'$end';";
    //             $cfm = mysqli_query($conn,$q) or die(mysqli_error());
    //             $result = mysqli_num_rows($cfm);
    //             if($result>0)
    //             {
    //                $data=mysqli_fetch_array($cfm);
    //                $w_value=$data['wamt'];
    //             }
    //             $amt=$out['invest']+$w_value;
    //             $perc=$out['refasign'];
    //             $day_amt=(($amt*$perc/100)/30);
    //             $full=$out['full'];
    //             $cid=$out['cid'];
    //             $invest_date=$out['regdate'];
    //             $invest=$day_amt;
    //             $today=date("d-m-Y");
    //             $i_days=date_diff1($today,$invest_date);
    //             $srch_date=date_diff1($today,$start);
    //             if($i_days>$srch_date)
    //             {
    //               $date1=$start;
    //             }else{
    //               $date1=$invest_date;
    //             }
    //             $days=date_diff1($end,$date1);
    //             $month_intres1=$invest*$days;
    //             $total1=$total1 + $month_intres1; 
    //     } return round($total+$total1);
    // } 


    //Not Important 
?>