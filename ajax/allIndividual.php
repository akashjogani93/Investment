<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $new=$_POST["submit"];
    if($new=='Submit')
    {
        $sql = "SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid`";
    }else if($new=='cid')
    {
        $cid=$_POST["cid"];
        // $from=$_POST["from"];
        // $to=$_POST["to"];
        $start=date("Y-m-d", strtotime($_POST["from"]));
        $end=date("Y-m-d", strtotime($_POST["to"]));
        if("31"==date("d", strtotime($_POST["to"])))
        {
            $end=date("Y-m-d", strtotime($_POST["to"]));
        }

        $sql="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`regdate`<='$end' AND `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid'";

        // $query ="SELECT `invest`.`i_id` AS `id`,`resister`.`cid` AS `cid`,`resister`.`full_name` as `fullname`,`resister`.`bank` as `bank`, `resister`.`acc_no` as `acc`,`invest`.`i_date` as `date`,`invest`.`temp` as `iv_amt`,`invest`.`pecentage` as `perc`,`invest`.`perday` as `day_amt` FROM `resister`,`invest` WHERE `invest`.`i_date`<='$end' AND `resister`.`cid` = `invest`.`cid` AND `resister`.`full_name`='$name';";

        // $query ="SELECT `invest`.`i_id` AS `id`,`resister`.`cid` AS `cid`,`resister`.`full_name` as `fullname`,`resister`.`bank` as `bank`, `resister`.`acc_no` as `acc`,`invest`.`i_date` as `date`,`invest`.`temp` as `iv_amt`,`invest`.`pecentage` as `perc`,`invest`.`perday` as `day_amt` FROM `resister`,`invest` WHERE  `invest`.`i_date`<='$end' AND `resister`.`cid` = `invest`.`cid` AND `resister`.`full_name`='$name';";
    }
    else if($new=='date')
    {
        $from=date("Y-m-d", strtotime($_POST["from"]));
        $to=date("Y-m-d", strtotime($_POST["to"]));
        if("31"==date("d", strtotime($_POST["to"])))
        {
            $to=date("Y-m-d", strtotime($_POST["to"]));
        }
        $sql="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`regdate` BETWEEN '$from' AND '$to'";
        // $sql = "SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid`";
    }
    $params = $columns = $totalRecords = $data = array(); //all variables declared;

    $params = $_REQUEST; 
    //define index of column
    $columns = array( 
        0 =>'id',
        1 =>'full', 
        2 => 'account',
        3 => 'regdate',
        4 =>'invest',
        5 =>'asign', 
        6 => 'pday',
        7 => 'days',
        8 => 'total_month',
        9 => 'total_month',
    );

    $where = $sqlTot = $sqlRec = "";

    // check search value exist
    if( !empty($params['search']['value']) ) {   
        $where .=" WHERE ";
        $where .=" ( id LIKE '".$params['search']['value']."%' ) ";    
        $where .=" OR full LIKE '".$params['search']['value']."%' ";
        $where .=" OR mobile LIKE '".$params['search']['value']."%' ";
    }

    // getting total number records without any search
    
    $sqlTot .= $sql;
    $sqlRec .= $sql;

    //concatenate search sql if value exist
    if(isset($where) && $where != '')
    {
        $sqlTot .= $where;
        $sqlRec .= $where;
    }	
    if($params['length'] != 100)
    {
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir'];
    }else
    {
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
    }
    $queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


    $totalRecords = mysqli_num_rows($queryTot);

    $queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

    //iterate on results row and create new index array of data
    $data=[];
    $temp=[];
    // $start=date("Y-m-01", strtotime("first day of this month"));
    // $end=date("Y-m-d");
    // if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}

    $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[0];
        $temp[1]=$row[15]; //name
        $temp[2]=$row[13]; //account
        $temp[3]=$row[2]; //date
        $temp[4]=$formatter->format($row[3]); //investamount
        $temp[5]=$row[4]; //asign
        $temp[6]=$row[5]; //pday
        // $temp[7]=$row[6];

        $today=date("d-m-Y");
        $i_days=date_diff1($today,$temp[3]);
        $srch_date=date_diff1($today,$start);
        
        if($i_days>$srch_date){$date1=$start;}else{$date1=$temp[3];}
        $days=date_diff1($end,$date1);
        $totalinte=$temp[6]*$days;
        $totalmonth=$temp[6]*30;

        $temp[7]=$days;
        $temp[8]=number_format($totalinte,2);
        $temp[9]=$formatter->format($totalmonth);
        array_push($data,$temp);
    }
    // $data1[]=array($data);

    $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data // total data array
            );


    echo json_encode($json_data);
}
?>

<?php
if(isset($_POST["submit1"]))
{
    $new=$_POST["submit1"];
    if($new=='Submit')
    {
        $cid=$_POST["cid"];

        $start=date("Y-m-d", strtotime($_POST["from"]));
        $end=date("Y-m-d", strtotime($_POST["to"]));
        if("31"==date("d", strtotime($_POST["to"])))
        {
            $end=date("Y-m-d", strtotime($_POST["to"]));
        }
        // $sql="SELECT 
        //             `referal`.*,
                    // `invest`.`cid`,
                    // `invest`.`invest`,
                    // `invest`.`regdate`,
        //             `register`.`full`
        //         FROM `referal`,`invest`,`register` 
        //         WHERE `invest`.`regdate`<'$end' 
        //         AND `referal`.`refcid`='$cid'
        //         AND `referal`.`id`=`invest`.`id`
        //         AND `invest`.`cid`=`register`.`cid`";

        $sql="SELECT 
                    `referal`.*,
                    `invest`.`cid`,
                    `invest`.`invest`,
                    `invest`.`regdate`,
                    `register`.`full` FROM `referal`,`invest`,`register`
                WHERE `referal`.`refcid`='$cid'
                AND `referal`.`id`=`invest`.`id`
                AND `invest`.`regdate`<'$end'
                AND `invest`.`cid`=`register`.`cid`";
        // $query="SELECT 
        //             `introduce`.`i_id` AS `id`,
        //             `resister`.`cid` as `cid`,
        //             `resister`.`full_name` as `fullname`,
        //             `invest`.`i_date` AS `date`,
        //             `invest`.`temp` AS `value`,
        //             `introduce`.`r_pecentag` as `perc`,
        //             `introduce`.`r_perday` AS `perday`
        //         FROM `resister`,`introduce`, `invest`
        //         WHERE `introduce`.`i_id`=`invest`.`i_id` 
        //         AND `invest`.`cid`=`resister`.`cid` 
        //         AND `introduce`.`r_name`='$name' 
        //         AND `invest`.`i_date`<'$end';";
    }else if($new=='cid')
    {
        $cid=$_POST["cid"];

        $start=date("Y-m-d", strtotime($_POST["from"]));
        $end=date("Y-m-d", strtotime($_POST["to"]));
        if("31"==date("d", strtotime($_POST["to"])))
        {
            $end=date("Y-m-d", strtotime($_POST["to"]));
        }
        // $sql = "SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `referal`.`id`=`invest`.`id`";

        // $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid'";

        // $sql="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$cid' AND `invest`.`regdate`<'$end';";
        // $sql="SELECT `referal`.* FROM `referal` WHERE `referal`.`refcid`='$cid'";

        // $query="SELECT `introduce`.`i_id` AS `id`, `resister`.`cid` as `cid`,`resister`.`full_name` as `fullname`, `invest`.`i_date` AS `date`,`invest`.`temp` AS `value`,`introduce`.`r_pecentag` as `perc`, `introduce`.`r_perday` AS `perday` FROM `resister`,`introduce`, `invest` WHERE `introduce`.`i_id`=`invest`.`i_id` AND `invest`.`cid`=`resister`.`cid` AND `introduce`.`r_name`='$name' AND `invest`.`i_date`<'$end';";
    }
    $params = $columns = $totalRecords = $data = array(); //all variables declared;

    $params = $_REQUEST; 
    //define index of column
    $columns = array( 
        0 =>'refid',
        1 =>'full', 
        2 => 'account',
        3 => 'regdate',
        4 =>'invest',
        5 =>'asign', 
        6 => 'pday',
        7 => 'days',
        8 => 'total_month',
        9 => 'total_month',
    );

    $where = $sqlTot = $sqlRec = "";

    // check search value exist
    if( !empty($params['search']['value']) ) {   
        $where .=" WHERE ";
        $where .=" ( id LIKE '".$params['search']['value']."%' ) ";    
        $where .=" OR full LIKE '".$params['search']['value']."%' ";
        $where .=" OR mobile LIKE '".$params['search']['value']."%' ";
    }

    // getting total number records without any search
    
    $sqlTot .= $sql;
    $sqlRec .= $sql;

    //concatenate search sql if value exist
    if(isset($where) && $where != '')
    {
        $sqlTot .= $where;
        $sqlRec .= $where;
    }	
    if($params['length'] != 100)
    {
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir'];
    }else
    {
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
    }
    $queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


    $totalRecords = mysqli_num_rows($queryTot);

    $queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

    //iterate on results row and create new index array of data
    $data=[];
    $temp=[];
    // $start=date("Y-m-01", strtotime("first day of this month"));
    // $end=date("Y-m-d");
    // if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    $today=date("d-m-Y");
    $srch_date=date_diff1($today,$start);
    // $today=date("d-m-Y");
    $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[1]; //investid
        $temp[1]=$row[10]; //name
        $temp[2]=$formatter->format($row[8]); //amount
        $temp[3]=$row[4]; //asign

        $pday=(($row[8]*$row[4]/100)/30);
        $temp[4]=round($pday); //pday

        // // //date Calculation
        
        $i_days=date_diff1($today,$row[9]);

        if($i_days>$srch_date){$date1=$start;}else{$date1=$row[9];}
        $days=date_diff1($end,$date1);
        $totalinte=$pday*$days;
        $totalmonth=$pday*30;

        $temp[5]=$days;
        $temp[6]=number_format($totalinte,2);
        $temp[7]=$formatter->format($totalmonth);
        array_push($data,$temp);
    }
    $json_data = array(
            "draw"            => intval( $params['draw'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
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

<?php
if(isset($_POST["referal"]))
{
    
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    
    
    
        $query="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `referal`.`id`=`invest`.`id` ORDER BY `referal`.`refid`";
        $retval=mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($retval)) 
        {
                $refid=$row['refid'];
                $id=$row['id'];
                $full=$row['full'];
                $invest=$row['invest'];
                $refasign=$row['refasign'];
                //$id=$row['id'];
                $regdate=$row['regdate'];
                $pday=(($invest*$refasign/100)/30);
                $pmonth=($invest*$refasign/100);

                //date Calculation
                $today=date("d-m-Y");
                $i_days=date_diff1($today,$regdate);
                $srch_date=date_diff1($today,$start);

                if($i_days>$srch_date){$date1=$regdate;}else{$date1=$regdate;}
                $days=date_diff1($end,$date1);
                $totalinte=$pday*$days;
                $totalmonth=$pday*30;
                ?>
            <tr>
                <td><?php echo $refid;?></td>
                <td><?php echo $id;?></td>
                <td><?php echo $full;?></td>
                <td><?php echo $invest;;?></td>
                <td><?php echo $refasign;?></td>
                <td><?php echo $pday;?></td>
                <td><?php echo $days;?></td>
                <td><?php echo $totalinte;?></td>
                <td><?php echo $totalmonth;?></td>
                
            </tr>
            <?php
    }  }
?>


<?php
  
  if(isset($_POST["filter"]))
  {
        $filter=$_POST["filter"];
        
        
      $start=date("Y-m-01", strtotime("first day of this month"));
      $end=date("Y-m-d");
      if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}

      if($filter=="Search By Name")
      {
        $cid=$_POST["cid"];
        $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid'  ORDER BY `invest`.`id`";
        
      }elseif($filter=="Search By Date")
      {
        $fromdate=$_POST["fromdate"];
        $todate=$_POST['todate'];
        $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`regdate` BETWEEN '$fromdate' AND '$todate'  ORDER BY `invest`.`regdate`";
        
      }elseif($filter=="Search By Amount")
      {
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST['amtend'];
        $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`invest` BETWEEN '$amtstart' AND '$amtend'  ORDER BY `invest`.`invest`";
       
      }elseif($filter=="Name & Amount")
      {
        $cid=$_POST["cid"];
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST['amtend'];
        $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`invest` BETWEEN '$amtstart' AND '$amtend' AND `invest`.`cid`='$cid' ORDER BY `invest`.`invest`";
        
      }else
      {
        $cid=$_POST["cid"];
        $fromdate=$_POST["fromdate"];
        $todate=$_POST['todate'];
        $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`regdate` BETWEEN '$fromdate' AND '$todate' AND `invest`.`cid`='$cid' ORDER BY `invest`.`regdate`";

      }
      $retval=mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($retval)) 
      {
          $id=$row['id'];
          $full=$row['full'];
          $account=$row['account'];
          $regdate=$row['regdate'];
          $invest=$row['invest'];
          $asign=$row['asign'];
          $pday=$row['pday'];
          //$pmonth=$row['pmonth'];
  
          //date Calculation
          $today=date("d-m-Y");
          $i_days=date_diff1($today,$regdate);
          $srch_date=date_diff1($today,$start);
  
          if($i_days>$srch_date){$date1=$regdate;}else{$date1=$regdate;}
          $days=date_diff1($end,$date1);
          $totalinte=$pday*$days;
          $totalmonth=$pday*30;
          ?>
              
              <tr>
                  <td><?php echo $id;?></td>
                  <td><?php echo $full;?></td>
                  <td><?php echo $account;?></td>
                  <td><?php echo $regdate;?></td>
                  <td><?php echo $invest;?></td>
                  <td><?php echo $asign;?></td>
                  <td><?php echo $pday;?></td>
                  <td><?php echo $days;?></td>
                  <td><?php echo $totalinte;?></td>
                  <td><?php echo $totalmonth;?></td>
                  
              </tr>
  
          <?php
      }  }
  ?>

  
<?php
if(isset($_POST["filter1"]))
{
    $filter=$_POST["filter1"];
    
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    if($filter=="Search By Name")
    {
        $cid=$_POST["cid"];
        $query="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `referal`.`id`=`invest`.`id` AND `referal`.`refcid`='$cid' ORDER BY `referal`.`refid`";
   
    }
    elseif($filter=="Search By Date")
    {
        $fromdate=$_POST["fromdate"];
        $todate=$_POST['todate'];
        $query="SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `referal`.`id`=`invest`.`id` AND `invest`.`regdate` BETWEEN '$fromdate' AND '$todate'  ORDER BY `invest`.`regdate`";
   
    }
    
    
        $retval=mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($retval)) 
        {
                $refid=$row['refid'];
                $id=$row['id'];
                $full=$row['full'];
                $invest=$row['invest'];
                $refasign=$row['refasign'];
                //$id=$row['id'];
                $regdate=$row['regdate'];
                $pday=(($invest*$refasign/100)/30);
                $pmonth=($invest*$refasign/100);

                //date Calculation
                $today=date("d-m-Y");
                $i_days=date_diff1($today,$regdate);
                $srch_date=date_diff1($today,$start);

                if($i_days>$srch_date){$date1=$regdate;}else{$date1=$regdate;}
                $days=date_diff1($end,$date1);
                $totalinte=$pday*$days;
                $totalmonth=$pday*30;
                ?>
            <tr>
                <td><?php echo $refid;?></td>
                <td><?php echo $id;?></td>
                <td><?php echo $full;?></td>
                <td><?php echo $invest;;?></td>
                <td><?php echo $refasign;?></td>
                <td><?php echo $pday;?></td>
                <td><?php echo $days;?></td>
                <td><?php echo $totalinte;?></td>
                <td><?php echo $totalmonth;?></td>
                
            </tr>
            <?php
    }  }
?>
