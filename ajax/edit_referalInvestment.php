<?php
require_once('../dbcon.php');

$cid=$_POST['full1'];
$in_id=$_POST['in_id'];
$regdate = $_POST['regdate'];
$invest = $_POST['invest'];
$asign = $_POST['asign'];
$pday = $_POST['pday'];
$pmonth = $_POST['pmonth'];
$pmode = $_POST['pmode'];
$image = $_FILES['screen'];
$profile = upload_Profile($image,"../img/");

    $query="UPDATE `invest` SET `cid`='$cid',`regdate`='$regdate',`invest`='$invest',`asign`='$asign',`pday`='$pday',`pmonth`='$pmonth',`pmode`='$pmode' WHERE `id`='$in_id'";
    if($profile!='')
    {
        $query="UPDATE `invest` SET `img`='$profile' WHERE `id`='$in_id'";  
    }
    $confirm = mysqli_query($conn, $query) or die(mysqli_error());
    if($confirm) 
    {
        echo $in_id;
    }






    //upload images profele & other document in jpg,png format
    function upload_Profile($image, $target_dir)
    {   
        if($image['name']!=""){
        $target_file = $target_dir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $msg = " ";
        try {
            $check = getimagesize($image["tmp_name"]);
            $msg = array();
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $msg[1] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $msg[2] = "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $msg[3] = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    //$msg= "The file ". basename( $image["name"]). " has been uploaded.";
                } else {
                    $msg[4] = "Sorry, there was an error uploading your file.";
                }
            }
            // echo "<pre>";
            // print_r($msg);
            return ltrim($target_file, '');
            } catch (Exception $e) {
            // echo "Message" . $e->getmessage();
        }
    }else{
        return "";
    }
    }
    
    ?>
    