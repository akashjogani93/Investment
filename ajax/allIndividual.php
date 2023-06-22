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
        $sql="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid'";
        
    }
    else if($new=='date')
    {
        $from=$_POST["from"];
        $to=$_POST["to"];
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
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[0];
        $temp[1]=$row[15]; //name
        $temp[2]=$row[13]; //account
        $temp[3]=$row[2]; //date
        $temp[4]=$row[3]; //investamount
        $temp[5]=$row[4]; //asign
        $temp[6]=$row[5]; //pday
        // $temp[7]=$row[6];
        $today=date("d-m-Y");
        $i_days=date_diff1($today,$temp[3]);
        $srch_date=date_diff1($today,$start);

        if($i_days>$srch_date){$date1=$temp[3];}else{$date1=$temp[3];}
        $days=date_diff1($end,$date1);
        $totalinte=$temp[6]*$days;
        $totalmonth=$temp[6]*30;

        $temp[7]=$days;
        $temp[8]=$totalinte;
        $temp[9]=$totalmonth;
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
        $sql = "SELECT `referal`.*,`invest`.`invest`,`invest`.`regdate`,`register`.`full` FROM `referal`,`invest`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `referal`.`id`=`invest`.`id`";
    }else if($new=='cid')
    {
        $cid=$_POST["cid"];
        $query="SELECT `invest`.*,`register`.`bank`,`register`.`account`,`register`.`cid`,`register`.`full` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid'";
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
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[0];
        $temp[1]=$row[2]; //investid
        $temp[2]=$row[8]; //name
        $temp[3]=$row[6]; //amount
        $temp[4]=$row[3]; //asign

        $pday=(($temp[3]*$temp[4]/100)/30);
        $temp[5]=$pday; //pday

        //date Calculation
        $today=date("d-m-Y");
        $i_days=date_diff1($today,$row[7]);
        $srch_date=date_diff1($today,$start);

        if($i_days>$srch_date){$date1=$row[7];}else{$date1=$row[7];}
        $days=date_diff1($end,$date1);
        $totalinte=$pday*$days;
        $totalmonth=$pday*30;

        $temp[6]=$days;
        $temp[7]=$totalinte;
        $temp[8]=$totalmonth;
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
