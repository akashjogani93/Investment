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
                <td><?php echo $row['mobile'];?></td>
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['location'];?></td>
                <td><?php echo $row['fromeDate'];?></td>
                <td><?php echo $row['toDate'];?></td>
                <td><?php echo $row['attend'];?></td>
                <td><a href="<?php echo 'ajax/'.$path ?>" target="_blank"><img src="<?php echo 'ajax/'.$path; ?>" alt="Image" height="100" width="100"></a></td>
                <td>
                    <button class="btn btn-info" onclick="editEvent(this)">Edit</button>
                    <button class="btn btn-danger" onclick="deleteEvent(<?php echo $row['id']; ?>)">Delete</button>
                </td>
            </tr>
        <?php
    }
}


if(isset($_POST['title']))
{
    // $title = $_POST['title'];
    // $location = $_POST['location'];
    // $date = $_POST['date'];
    // $todate = $_POST['todate'];
    // $desc = $_POST['desc'];
    // $file = $_FILES['file'];
    // $mobile = $_POST['mobile'];
    // $attend = $_POST['attend'];
    // $bond1 = upload_Profile($file,"../img/insurance/");

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $cid = mysqli_real_escape_string($conn, $_POST['cid']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $todate = mysqli_real_escape_string($conn, $_POST['todate']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $attend = mysqli_real_escape_string($conn, $_POST['attend']);
    
    $min = 1000;
    $max = 9999;
    $randomNumber = rand($min, $max);
    $fileName = $randomNumber . time();
    if($cid==0)
    {
        $file = $_FILES['file'];
        $bond1 = upload_Profile($file, $fileName, "../img/insurance/");
        $query = "INSERT INTO `insurance`(`title`,`location`,`fromeDate`,`toDate`,`description`,`path`,`mobile`,`attend`)VALUES('$title','$location','$date','$todate','$desc','$bond1','$mobile','$attend')";
    }else
    {
        $file = $_FILES['file'] ?? null;
        if ($file !== null && !empty($file['name']))
        {
            $bond1 = upload_Profile($file, $fileName, "../img/insurance/");
            $query="UPDATE `insurance` SET `title`='$title',`fromeDate`='$date',`toDate`='$todate',`location`='$location',`description`='$desc',`path`='$bond1',`mobile`='$mobile',`attend`='$attend' WHERE `id`=$cid";
        }else
        {
            $query="UPDATE `insurance` SET `title`='$title',`fromeDate`='$date',`toDate`='$todate',`location`='$location',`description`='$desc',`mobile`='$mobile',`attend`='$attend' WHERE `id`=$cid";
        }
    }
    if (mysqli_query($conn, $query))
    {
        if($cid==0)
        {
            echo "<span style='color:green'>New 'Insurance' created successfully</span>";
        }else
        {
            echo "<span style='color:green'>'Insurance' Updated successfully</span>";
        }
    }
    else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
}

function upload_Profile($image, $customFilename, $target_dir)
{
    if ($image['name'] != "") {
        $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $customFilename . "." . $imageFileType;
        $uploadOk = 1;
        $msg = " ";
        try {
            $check = getimagesize($image["tmp_name"]);
            $msg = array();
            if ($check !== false) {
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
            } else {
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    //$msg= "The file ". basename( $image["name"]). " has been uploaded.";
                } else {
                    $msg[4] = "Sorry, there was an error uploading your file.";
                }
            }
            return ltrim($target_file, '');
        } catch (Exception $e) {
            // Handle exceptions if needed
        }
    } else {
        return "";
    }
}
?>