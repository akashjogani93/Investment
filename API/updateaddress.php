<?php 
     include('../dbcon.php');
     header('Access-Control-Allow-Origin:*');
     header('Access-Control-Request-Methods:POST');
     header('Content-Type:Application/json');
     header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-Control-Request-Methods,Access-Control-Allow-Headers,Authorization,X-Request-With');
     // $data =json_decode(file_get_contents("php://input"));
     $data =file_get_contents("php://input");
     $data=json_decode($data,TRUE);
     $oid=$data['id'];
     $add=$data['address'];
    
   
$add = mysqli_real_escape_string($conn, $add); // Sanitize the address input
$oid = mysqli_real_escape_string($conn, $oid); // Sanitize the customer ID input

$sql = "UPDATE `register` SET `address` = ? WHERE `cid` = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "si", $add, $oid);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["isUpdated"=>"true","Address"=>$add]);
    } else {
        echo json_encode(["isUpdated"=>"false","Address"=>$add]);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "false";
}
    
 