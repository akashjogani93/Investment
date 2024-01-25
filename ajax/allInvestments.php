<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $new=$_POST["submit"];
    if($new=='Submit')
    {
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid`";
    }else if($new=='cid')
    {
        $cid=$_POST["cid"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid'";
    }
    else if($new=='date')
    {
        $fromdate=$_POST["fromdate"];
        $todate=$_POST["todate"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`regdate` BETWEEN '$fromdate' AND '$todate'";
    }
    else if($new=='amt')
    {
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST["amtend"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`invest` BETWEEN '$amtstart' AND '$amtend'";
    }
    else if($new=='amt_date')
    {
        $amtstart=$_POST["amtstart"];
     $amtend=$_POST["amtend"];
     $fromdate=$_POST["fromdate"];
     $todate=$_POST["todate"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`invest` BETWEEN '$amtstart' AND '$amtend' AND `invest`.`regdate` BETWEEN '$fromdate' AND '$todate'";
    }
    else if($new=='nameamt')
    {
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST["amtend"];
        $cid=$_POST["cid"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`invest` BETWEEN '$amtstart' AND '$amtend' AND `invest`.`cid`='$cid'";
    }
    else if($new=='asign')
    {
        $asign=$_POST["asign"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`asign`='$asign'";
    }
    else if($new=='namedate')
    {
        $fromdate=$_POST["fromdate"];
     $todate=$_POST["todate"];
     $cid=$_POST["cid"];
        $sql = "SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `invest`.`cid`='$cid' AND `invest`.`regdate` BETWEEN '$fromdate' AND '$todate'";
    }
    $params = $columns = $totalRecords = $data = array(); //all variables declared;

    $params = $_REQUEST; 
    //define index of column
    $columns = array( 
        0 =>'id',
        1 =>'full', 
        2 => 'mobile',
        3 => 'regdate',
        4 =>'asign',
        5 =>'invest', 
        6 => 'pday',
        7 => 'pmonth',
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
    $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[0];
        $temp[1]=$row[12];
        $temp[2]=$row[13];
        $temp[3]=date('d-m-Y', strtotime($row[2]));
        $temp[4]=number_format($row[4],2);
        $temp[5]=$formatter->format($row[3]);
        $temp[6]=$formatter->format($row[5]);
        $temp[7]=$formatter->format($row[6]);
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