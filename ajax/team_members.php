<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $d1=$_POST["d1"];
    if($d1=='not_date')
    {
        $sql = "SELECT `register`.*,`login`.`username`,`login`.`password` FROM `register`,`login` WHERE `register`.`cid`=`login`.`cid`";
    }else
    {
        $d2=$_POST["d2"];
        // $d2=$_POST["d2"];
        $sql = "SELECT `register`.*,`login`.`username`,`login`.`password` FROM `register`,`login` WHERE `register`.`cid`=`login`.`cid`='$d1'";
    }
    $params = $columns = $totalRecords = $data = array(); //all variables declared;

    $params = $_REQUEST; 
    $new=$_POST["submit"];
    //define index of column
    $columns = array( 
        0 =>'cid',
        1 =>'cid',
        2 =>'full', 
        3 => 'gender',
        4 => 'address',
        5 =>'mobile',
        6 =>'email', 
        7 => 'bank',
        8 => 'account',
        9 => 'ifsc',
        10 => 'pan',
        11 => 'regdate',
        12 => 'nominee',
        13 => 'relation',
        14 => 'username',
        15 => 'password',
    );

    $where = $sqlTot = $sqlRec = "";

    // check search value exist
    if( !empty($params['search']['value']) ) {   
        $where .=" WHERE ";
        $where .=" ( cid LIKE '".$params['search']['value']."%' ) ";    
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
        $temp[1]=$row[17];
        $temp[2]=$row[5];

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