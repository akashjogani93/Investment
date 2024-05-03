<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $new=$_POST["submit"];
    if($new=='Submit')
    {
        $sql = "SELECT `widraw`.*,`register`.`full`,`register`.`mobile` FROM `widraw`,`register` WHERE `widraw`.`cid`=`register`.`cid`";
    }else if($new=='name')
    {
        $cid=$_POST["cid"];
        $sql="SELECT `widraw`.*,`register`.`full`,`register`.`mobile` FROM `widraw`,`register` WHERE `widraw`.`cid`=`register`.`cid` AND `widraw`.`cid`='$cid'";
    }
    else if($new=='date')
    {
        $fromdate=$_POST["fromdate"];
         $todate=$_POST["todate"];
        $sql="SELECT `widraw`.*,`register`.`full`,`register`.`mobile` FROM `widraw`,`register` WHERE `widraw`.`cid`=`register`.`cid` AND `widraw`.`wdate` BETWEEN '$fromdate' AND '$todate'";
    }
    else if($new=='amt')
    {
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST["amtend"];
        $sql = "SELECT `widraw`.*,`register`.`full`,`register`.`mobile` FROM `widraw`,`register` WHERE `widraw`.`cid`=`register`.`cid` AND `widraw`.`wamt` BETWEEN '$amtstart' AND '$amtend'";
    }
    else if($new=='dateamt')
    {
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST["amtend"];
        $fromdate=$_POST["fromdate"];
        $todate=$_POST["todate"];
        $sql="SELECT `widraw`.*,`register`.`full`,`register`.`mobile` FROM `widraw`,`register` WHERE `widraw`.`cid`=`register`.`cid` AND `widraw`.`wamt` BETWEEN '$amtstart' AND '$amtend' AND `widraw`.`wdate` BETWEEN '$fromdate' AND '$todate'";
    }
    else if($new=='nameamt')
    {
        $amtstart=$_POST["amtstart"];
        $amtend=$_POST["amtend"];
        $cid=$_POST["cid"];
        $query="SELECT `widraw`.*,`register`.`full`,`register`.`mobile` FROM `widraw`,`register` WHERE `widraw`.`cid`=`register`.`cid` AND `widraw`.`wamt` BETWEEN '$amtstart' AND '$amtend' AND `widraw`.`cid`='$cid'";
        $retval=mysqli_query($conn, $query);
    }
    $params = $columns = $totalRecords = $data = array(); //all variables declared;

    $params = $_REQUEST; 
    //define index of column
    $columns = array( 
        0 =>'wid',
        1 =>'full', 
        2 => 'mobile',
        3 => 'wdate',
        4 =>'wamt',
    );

    $where = $sqlTot = $sqlRec = "";

    // check search value exist
    if( !empty($params['search']['value']) ) {   
        $where .=" WHERE ";
        $where .=" ( wid LIKE '".$params['search']['value']."%' ) ";    
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
    while($row = mysqli_fetch_row($queryRecords) )
    {
        $temp[0]=$row[0];
        $temp[1]=$row[8];
        $temp[2]=$row[9];
        // $temp[3]=$row[3];
         $temp[3]=date('d-m-Y', strtotime($row[3]));
        $temp[4]=number_format($row[4],2);
        if($row[7]=='')
        {
            $temp[5]='Not Uploaded';
        }else
        {
            $path='./ajax/'.$row[7];
            $temp[5]='<a href="'.$path.'" target="_blank" class="btn btn-info">Agrement</a>';
        }
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
