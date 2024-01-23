<?php 
     include('../dbcon.php');
     header('Access-Control-Allow-Origin:*');
     header('Access-Control-Request-Methods:POST');
     header('Content-Type:Application/json');
     header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-Control-Request-Methods,Access-Control-Allow-Headers,Authorization,X-Request-With');
     // $data =json_decode(file_get_contents("php://input"));
     $data =file_get_contents("php://input");
     $data=json_decode($data,TRUE);
     $id=$data['id'];
    //  $type=$data['Type'];
    //  $mode=$data['mode'];
     // echo $data['status'];
    $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){
        $end=date("Y-m-30");
    }
    //$sql="SELECT `introduce`.`i_id`,`introduce`.`refasign`,`introduce`.`refpday`,`resister`.`cid`,`resister`.`full_name`,`invest`.`i_date`,`invest`.`value` FROM `resister`,`introduce`,`invest` WHERE `introduce`.`i_id`=`invest`.`i_id` AND `invest`.`cid`=`resister`.`cid` AND `introduce`.`r_name`='$oid' AND `invest`.`i_date`<'$end';";
    $sql = "SELECT `full` FROM `register` WHERE `cid`='$id';";
    $exc=mysqli_query($conn,$sql);
    $row = mysqli_num_rows($exc);
    $arr = array();
    $data = mysqli_fetch_array($exc);
    if ($row > 0) {
        //"SELECT `introduce`.`i_id`  FROM `introduce` WHERE `r_name`='{$data["full_name"]}';";
        $sql1 = "SELECT *  FROM `referal` WHERE `r_name`='{$data["full"]}';";
        $exc1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_num_rows($exc1);
        if ($row1 > 0) {
            $i = 0;
            while ($data1 = mysqli_fetch_array($exc1)) {
                $s="SELECT  `invest`.`invest`,`invest`.`regdate`,`invest`.`id`, `register`.`full` FROM `invest` JOIN `register` ON `invest`.`cid`=`register`.`cid` WHERE `invest`.`id`='{$data1["id"]}' AND `invest`.`regdate`<'$end';";
                $exc2 = mysqli_query($conn, $s);
                $data2 = mysqli_fetch_array($exc2);
                $arr[$i] = $data2;
                $i++;
            }
            echo json_encode($arr);
        } else {
            echo json_encode($arr);
        }
            
    } else {
        echo json_encode($arr);
    }