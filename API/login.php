<?php 
include('../dbcon.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Request-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Request-Methods, Access-Control-Allow-Headers, Authorization, X-Request-With');

$data = file_get_contents("php://input");
$data = json_decode($data, TRUE);
$user = $data['user'];
$pass = $data['pass'];

$sql = "SELECT * FROM `login` WHERE `username`='$user' AND `password`='$pass' AND `user`='Member';";
$exc = mysqli_query($conn, $sql);
$row = mysqli_num_rows($exc);
$arr = array();

if ($row > 0) {
    $data = mysqli_fetch_assoc($exc);  // Fetching the data as an associative array
    
    echo json_encode($data);  // Output the data as JSON
} else {
    echo json_encode(array('message' => 'false'));  // Output a JSON response
}
?>
