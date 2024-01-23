<?php
// Check if the request is a POST request
 include('../dbcon.php');
header('Access-Control-Allow-Origin:*');
     header('Access-Control-Request-Methods:POST');
     header('Content-Type:multipart/form-data');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    // Check if the 'image' files were uploaded
    if (isset($_FILES)) {
        $Pname=$_POST['Pname'];
        $label1=$_POST['label1'];
         $label2=$_POST['label2'];
         //echo $labels;
        
        $policy_on=$_POST['policy_on'];
        $email=$_POST['Email'];
        $imgTrack=$_POST['imgTrack'];
          $user=$_POST['user'];
      
        //echo $policy_on;
        $Contact= $_POST['Contact'];
        $Whatsapp = $_POST['Whatsapp'];
        $uploadDir = 'uploads/'; // Directory to save the uploaded images
        $uploadedImages = [];
        $uploadedImages1 = [];
        $currentDateTime = date('Y-m-d H:i:s');
        
       //echo var_dump($_FILES);
       $i=0;
       $j=0;
       
        foreach ($_FILES as $key => $fileInfo) {
           if($i<$imgTrack){
                $originalName = $fileInfo['name'];
                $tmpName= $fileInfo['tmp_name'];
                $min = 1;
                $max = 100000;
                $random= rand($min,$max);
                $newFileName = $uploadDir.$random.$fileInfo['name']; 
                //echo $newFileName;
                
                if (move_uploaded_file($tmpName, $newFileName)) {
                    $uploadedImages[$i] = $newFileName;
                    $i++;
                }
           }else{
             $originalName = $fileInfo['name'];
                $tmpName= $fileInfo['tmp_name'];
                $min = 1;
                $max = 100000;
                $random= rand($min,$max);
                $newFileName = $uploadDir.$random.$fileInfo['name']; 
                //echo $newFileName;
                
                if (move_uploaded_file($tmpName, $newFileName)) {
                    $uploadedImages1[$j] = $newFileName;
                    $j++;
                }

           }
                
           
        }
        $imagesString = implode(',', $uploadedImages);
         $imagesString1 = implode(',', $uploadedImages1);
          $query1="INSERT INTO `policy_leads`(`Pname`, `Contact`, `Whatsapp`, `Documents`,`Other_Documents`,`policy_on`,`email`,`user`,`date`,`labels`,`label2`) VALUES('$Pname','$Contact','$Whatsapp','$imagesString','$imagesString1','$policy_on','$email','$user','$currentDateTime','$label1','[]')";
        $query="INSERT INTO `policy_leads`(`Pname`, `Contact`, `Whatsapp`, `Documents`,`Other_Documents`,`policy_on`,`email`,`user`,`date`,`labels`,`label2`) VALUES('$Pname','$Contact','$Whatsapp','$imagesString','$imagesString1','$policy_on','$email','$user','$currentDateTime','$label1','$label2')";
        if($policy_on=="Ownname"){
             $confirm = mysqli_query($conn,$query1) or die(mysqli_error());
             if($confirm){
            echo "Inserted";
             }
         } else{
             $confirm = mysqli_query($conn,$query) or die(mysqli_error());
             if($confirm){
            echo "Inserted";
         } 
        }
        
    } else {
        echo json_encode(['error' => 'No images were uploaded']);
    }
} else {
        echo json_encode(['error' => 'Invalid request method']);
}

?>