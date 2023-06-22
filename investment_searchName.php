


<?php
include('dbcon.php');
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $sql = "SELECT DISTINCT full,cid FROM  register WHERE full LIKE '".$searchTerm."%'";
    $retval=mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($retval)) 
    {
        $data[] = array("value"=>$row['cid'],"label"=>$row['full']);
        
    }
    // $data1=array_unique($data);
    //return json data
    echo json_encode($data);
?>