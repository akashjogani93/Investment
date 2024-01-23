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
    //  $type=$data['Type'];
    //  $mode=$data['mode'];
     // echo $data['status'];
     $start=date("Y-m-01", strtotime("first day of this month"));
    $end=date("Y-m-d");
    if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
    //  $sql = "SELECT `referal`.`id`,`referal`.`refasign`,`referal`.`refpday`,`register`.`cid`,`register`.`full`,`invest`.`regdate`,`invest`.`invest` FROM `register`,`referal`,`invest` WHERE `referal`.`id`=`invest`.`id` AND `invest`.`cid`=`register`.`cid` AND `referal`.`refcid`='$oid' AND `invest`.`regdate`<'$end';";
        $sql="SELECT * FROM `bloodcell_gallery`;";

     $exc=mysqli_query($conn,$sql);
     $row = mysqli_num_rows($exc);
     $arr = array();
     //echo $row;
     if($row>0){
     $i=0;
     while( $data=mysqli_fetch_array($exc)){
      // echo json_encode($data)};
       $arr[$i]=$data;
       $i++;
     }   
       echo json_encode($arr);
    }
    else {
        echo json_encode($arr);
    }
    
 