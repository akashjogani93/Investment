<?php
include("../dbcon.php");
if(isset($_POST['cate']))
{
$cate = $_POST['cate'];
$check = $_POST['check'];
$check1 = $_POST['check1'];
$uploadedFiles = [];

if($check==1)
{
    $images = $_FILES['images'];
    foreach ($images['name'] as $key => $name) {
        $uploadResult = upload_Profile($images, $key, "../img/insuGallery/");
        if ($uploadResult) 
        {
            $uploadedFiles[] = $uploadResult;
        }
    }
}

if($check1==1)
{
    $urls = $_POST['url'];
    $urlsString = implode(',', $urls);
}else
{
    $urlsString = '';
}

$uploadedFilesString = implode(',', $uploadedFiles);
$sql="INSERT INTO `insurancegallery`(`category`, `gallery`, `url`) VALUES ('$cate','$uploadedFilesString','$urlsString')";
$exc=mysqli_query($conn,$sql);
if($sql)
{
    echo json_encode('Added Gallery Successfully');
}else
{
    echo json_encode('Something Went Wrong');
}
// echo json_encode($check);
}

if(isset($_POST['submit']))
{
    $cate=$_POST['cat'];
    if($cate==0 || $cate=='All')
    {
        $query="SELECT * FROM `insurancegallery`";
    }else
    {
        $query="SELECT * FROM `insurancegallery` WHERE `category`='$cate'";
    }
    $exc=mysqli_query($conn,$query);
    $rows=[];
    while($row=mysqli_fetch_assoc($exc))
    {
        $rows[]=$row;
    }
    echo json_encode($rows);
}




if(isset($_POST['fetchfun']))
{
    $option=[];
    $query="SELECT * FROM `insurancecategory`";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        // array_push($option,$row['id'],$row['category']);
        $option[]=$row;
    }
    echo json_encode($option);
}

function upload_Profile($images, $key, $target_dir)
{
    $name = $images['name'][$key];
    $tmp_name = $images['tmp_name'][$key];

    if (isset($name) && isset($tmp_name)) {
        $target_file = $target_dir . basename($name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     return "File '$name' already exists.";
        // }

        // Allow certain file formats
        $allowedFormats = ["pdf", "jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            return "Invalid file format for '$name'. Only PDF, JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Error uploading '$name'.";
        } else {
            if (move_uploaded_file($tmp_name, $target_file)) {
                return $target_file;
            } else {
                return "";
            }
        }
    } else {
        return "No file was selected.";
    }
}
?>
