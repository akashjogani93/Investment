<?php
// Check if the request is a POST request
include('../dbcon.php');
header('Access-Control-Allow-Origin:*');
     header('Access-Control-Request-Methods:POST');
     header('Content-Type:multipart/form-data');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 echo "Entered";
    if (isset($_FILES)) {
        $policy_on=$_POST['policy_on'];
        if($policy_on=="Ownname"){
            $Pname=$_POST['Pname'];
            $label1=$_POST['label1'];
            $doc1=$_POST['doc1'];    
            $id=$_POST['id'];
            $email=$_POST['Email'];
            $user=$_POST['user'];
            $Contact= $_POST['Contact'];
            $Whatsapp = $_POST['Whatsapp'];
            $uploadDir = 'uploads/';
            $uploadedImages = [];
            $uploadedImages1 = [];
            $currentDateTime = date('Y-m-d H:i:s');
            $i=0;
            $j=0;
            foreach ($_FILES as $key => $fileInfo) {
                $originalName = $fileInfo['name'];
                $tmpName= $fileInfo['tmp_name'];
                $min = 1;
                $max = 100000;
                $random= rand($min,$max);
                $newFileName = $uploadDir.$random.$fileInfo['name'];                            
                if (move_uploaded_file($tmpName, $newFileName)) {
                    $uploadedImages[$i] = $newFileName;
                    $i++;
                }                
            }
            $imagesString = implode(',', $uploadedImages);
            $imagesString1 = implode(',', $uploadedImages1);
            $query="UPDATE `policy_leads` SET
                    `Pname` = '$Pname',
                    `Contact` = '$Contact',
                    `Whatsapp` = '$Whatsapp',
                    `Documents` = '$doc1',
                    `Other_Documents` = '',
                    `policy_on` = '$policy_on',
                    `email` = '$email',
                    `user` = '$user',
                    `date` = '$currentDateTime',
                    `labels` = '$label1',
                    `label2` = '[]' WHERE `id`=$id;";
            $confirm = mysqli_query($conn,$query) or die(mysqli_error());
            if($confirm){
            echo json_encode(['error' => 'Success']);
            }
        }else{
    
            $Pname=$_POST['Pname'];
            $label1=$_POST['label1'];
            $label2=$_POST['label2'];
            $doc1=$_POST['doc1']; 
            $doc2=$_POST['doc2'];    
            $id=$_POST['id'];
            $email=$_POST['Email'];
            $user=$_POST['user'];
            $Contact= $_POST['Contact'];
            $Whatsapp = $_POST['Whatsapp'];
            $uploadDir = 'uploads/'; // Directory to save the uploaded images
            $uploadedImages = [];
            $uploadedImages1 = [];
            $currentDateTime = date('Y-m-d H:i:s');
            $i=0;
            $j=0;
            
            foreach ($_FILES as $key => $fileInfo) {
                    $originalName = $fileInfo['name'];
                    $tmpName= $fileInfo['tmp_name'];
                    $min = 1;
                    $max = 100000;
                    $random= rand($min,$max);
                    $newFileName = $uploadDir.$random.$fileInfo['name'];                            
                    if (move_uploaded_file($tmpName, $newFileName)) {
                        $uploadedImages[$i] = $newFileName;
                        $i++;
                    } else{
                       echo json_encode(['error' => 'Something went wrong']);
                    }               
            
            }
            $imagesString = implode(',', $uploadedImages);
             $imagesString1 = implode(',', $uploadedImages1);
            $query="UPDATE `policy_leads` SET
                    `Pname` = '$Pname',
                    `Contact` = '$Contact',
                    `Whatsapp` = '$Whatsapp',
                    `Documents` = '$doc1',
                    `Other_Documents` = '$doc2',
                    `policy_on` = '$policy_on',
                    `email` = '$email',
                    `user` = '$user',
                    `date` = '$currentDateTime',
                    `labels` = '$label1',
                    `label2` = '$label2' WHERE `id`=$id;";
             $confirm = mysqli_query($conn,$query) or die(mysqli_error());
             if($confirm){
           echo json_encode(['error' => 'Success']);
             }else{
                echo json_encode(['error' => 'Failed']);
             }
       }
          
    } else {
        echo json_encode(['error' => 'No images were uploaded']);
    }
} else {
        echo json_encode(['error' => 'Invalid request method']);
}

?>