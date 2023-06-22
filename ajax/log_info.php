<?php
// if(isset($_POST["Submit"]))
// {
//     $load=$_POST["load"];
//     if($load=='directload')
//     {
//         $i=1;
//         $query="SELECT DISTINCT `register`.`full`,`log_info`.`cid`,`log_info`.`login`,`log_info`.`logout` FROM `register`,`log_info` WHERE `log_info`.`cid`=`register`.`cid` ORDER BY `logg_id` DESC";

?>
<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $sql = "SELECT * FROM `log_info` WHERE `cid`!=0";
    $params = $columns = $totalRecords = $data = array(); //all variables declared;

    $params = $_REQUEST; 
    $new=$_POST["submit"];
    //define index of column
    $columns = array( 
        0 =>'cid',
        1 =>'full', 
        2 => 'gender',
        3 => 'address',
        4 =>'mobile',
        5 =>'email', 
        6 => 'bank',
        7 => 'account',
        8 => 'ifsc',
        9 => 'pan',
        10 => 'regdate',
        11 => 'nominee',
        12 => 'relation',
    );

    $where = $sqlTot = $sqlRec = "";

    // check search value exist
    // if( !empty($params['search']['value']) ) {   
    //     $where .=" WHERE ";
    //     $where .=" ( cid LIKE '".$params['search']['value']."%' ) ";    
    //     $where .=" OR full LIKE '".$params['search']['value']."%' ";
    //     $where .=" OR mobile LIKE '".$params['search']['value']."%' ";
    // }

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
        // $temp[0]=$row[0];
        // $temp[1]=$row[17];
        // $temp[2]=$row[10];
        // $temp[3]=$row[8];
        // $temp[4]=$row[5];
        // $temp[5]=$row[6];
        // $temp[6]=$row[12];
        // $temp[7]=$row[13];
        // $temp[8]=$row[14];
        // $temp[9]=$row[7];
        // $temp[10]=$row[2];
        // $temp[11]=$row[16];
        // $temp[12]=$row[15];
        array_push($data,$row);
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