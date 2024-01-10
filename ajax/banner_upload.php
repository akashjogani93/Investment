<?php
include("../dbcon.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if(isset($_POST['cate']))
    {
        $uploadedFiles = $_FILES['files'];
        $cate = $_POST['cate'];
        $allFilesInserted = true;
        $imageArray=[];
        for($i = 0; $i < count($uploadedFiles['name']); $i++) 
        {
            $file = array(
                'name'     => $uploadedFiles['name'][$i],
                'type'     => $uploadedFiles['type'][$i],
                'tmp_name' => $uploadedFiles['tmp_name'][$i],
                'error'    => $uploadedFiles['error'][$i],
                'size'     => $uploadedFiles['size'][$i]
            );
            $targetDir = '../img/banner/';
            $uploadedFilePath = upload_Profile($file, $targetDir);
            if ($uploadedFilePath) 
            {
                $imageArray[]=$uploadedFilePath;
            }
        }
        $uploadedFilesString = implode(',', $imageArray);
        // $insertQuery="INSERT INTO `banner`(`cate`,`image`)VALUES('$cate','$uploadedFilesString')";
        $insertQuery="UPDATE `banner` SET `image`='$uploadedFilesString' WHERE `cate`='$cate'";
        if(!mysqli_query($conn, $insertQuery))
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }else if(isset($_POST['submit']) && isset($_POST['functio']))
    {
        $cate=$_POST['functio'];
        if($cate !='' && $cate !=0)
        {
            $query="SELECT * FROM `banner` WHERE `cate`='$cate'";
        }else
        {
            $query="SELECT * FROM `banner`";
        }
        $exc=mysqli_query($conn,$query);
        $option=[];
        while($row=mysqli_fetch_assoc($exc))
        {
            $option[]=$row;
        }
        echo json_encode($option);
    }
    
}else 
{
    echo 1;
}

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