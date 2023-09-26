<?php
include("../dbcon.php");


if(isset($_POST['Submit']))
{
    $query="SELECT * FROM `insurance` ORDER BY `id` ASC";
    $result=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($result))
    {
        $path=$row['path'];
        ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['location'];?></td>
                <td><?php echo $row['fromeDate'];?></td>
                <td><?php echo $row['toDate'];?></td>
                <td><?php echo $row['attend'];?></td>
                <td><a href="<?php echo 'ajax/'.$path ?>" target="_blank"><img src="<?php echo 'ajax/'.$path; ?>" alt="Image" height="100" width="100"></a></td>

            </tr>
        <?php
    }
}


if(isset($_POST['title']))
{
    $title = $_POST['title'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $todate = $_POST['todate'];
    $desc = $_POST['desc'];
    $file = $_FILES['file'];
    $mobile = $_POST['mobile'];
    $attend = $_POST['attend'];
    $bond1 = upload_Profile($file,"../img/insurance/");
    $query = "INSERT INTO `insurance`(`title`,`location`,`fromeDate`,`toDate`,`description`,`path`,`mobile`,`attend`)VALUES('$title','$location','$date','$todate','$desc','$bond1','$mobile','$attend')";
    if (mysqli_query($conn, $query))
    {
        echo "<span style='color:green'>New 'Insurance' Added Successfully</span>";
    }
    else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
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