<?php 
     include('../dbcon.php');
     header('Access-Control-Allow-Origin:*');
     header('Access-Control-Request-Methods:POST');
     header('Content-Type:Application/json');
     header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-Control-Request-Methods,Access-Control-Allow-Headers,Authorization,X-Request-With');
     $data =file_get_contents("php://input");
     $data=json_decode($data,TRUE);
     $oid=$data['id'];
     $sql = "SELECT * FROM `invest` WHERE cid=$oid;";
     $exc=mysqli_query($conn,$sql);
     $row = mysqli_num_rows($exc);
     $arr = array();
     if($row>0){
        $i=0;
        while( $data=mysqli_fetch_array($exc)){
        $arr[$i]=$data;
        $i++;
        } 
        echo json_encode($arr);
     }
     else {
        echo json_encode($arr);
     }
    
 