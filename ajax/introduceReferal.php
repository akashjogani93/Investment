<?php
require_once('../dbcon.php');
include('../sms.php');
use Dompdf\Dompdf;

$cid=$_POST['full1'];
$regdate = $_POST['regdate'];

    $year = date('Y', strtotime($regdate));
    $Month = date('M', strtotime($regdate));
$invest = $_POST['invest'];
$asign = $_POST['asign'];
$pday = $_POST['pday'];
$pmonth = $_POST['pmonth'];
$pmode = $_POST['pmode'];
$image = $_FILES['screen'];
$mobile = $_POST['mobile'];
$profile = upload_Profile($image,"../img/");
$msg = "Rs ".$invest.", successfully Added to your account.\nFrom: SHIVAM ASSOCIATES.\nThank You.";
// $referals =$_POST['referals']; 
    $q="INSERT INTO `invest`(`cid`, `regdate`, `invest`, `asign`, `pday`, `pmonth`,`pmode`,`img`,`year`,`month`)VALUES 
    ('$cid','$regdate','$invest','$asign','$pday','$pmonth','$pmode','$profile','$year','$Month');";
    $conform=mysqli_query($conn,$q);
    if($conform)
    {
        $q1="SELECT `id` FROM `invest` ORDER BY `id` DESC LIMIT 1;";
        $cfm=mysqli_query($conn,$q1);
        $row=mysqli_fetch_array($cfm);
        $invest_id=$row[0];

        require_once './dompdf/autoload.inc.php';
        $dompdf = new Dompdf();
        $agrement='<!DOCTYPE html>
        <html>
        <head>
            <title>Agreement Bond</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <!-- Custom CSS -->
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                h1 {
                    margin-bottom: 30px;
                    text-align: center;
                    font-size: 36px;
                    font-weight: bold;
                    color: #007bff;
                }
                p {
                    font-size: 18px;
                    line-height: 1.5;
                    margin-bottom: 20px;
                }
                .signature-box {
                    margin-top: 50px;
                    border: 1px solid #ccc;
                    padding: 20px;
                    text-align: center;
                    position: relative;
                }
                .signature-box::before {
                    content: "Signature";
                    font-size: 16px;
                    font-weight: bold;
                    position: absolute;
                    top: -15px;
                    left: 50%;
                    transform: translateX(-50%);
                    background-color: #fff;
                    padding: 0 10px;
                }
                .signature-box input[type="text"] {
                    border: none;
                    border-bottom: 1px solid #ccc;
                    width: 80%;
                    padding: 5px 10px;
                    margin-bottom: 20px;
                }
                .signature-box .btn {
                    background-color: #007bff;
                    color: #fff;
                    font-size: 18px;
                    padding: 10px 20px;
                    border-radius: 5px;
                    border: none;
                }
                .signature-box .btn:hover {
                    background-color: #0062cc;
                    cursor: pointer;
                }
                label{
                    position:relative;
                    bottom:20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Agreement Bond</h1>
                <p>This agreement bond ("Agreement") is made and entered into on the date of <strong>['.$regdate.']</strong> by and between <strong>[insert party 1 name]</strong> and <strong>[insert party 2 name]</strong>.</p>
                <p>Whereas, the parties wish to enter into an agreement for Amount Invested<strong>['.$invest.']</strong> on the terms and conditions set forth herein, the parties agree as follows:</p>
                <ol>
                    <li><strong>[insert first term of agreement]</strong></li>
                    <li><strong>[insert second term of agreement]</strong></li>
                    <li><strong>[insert third term of agreement]</strong></li>
                </ol>
                <div class="signature-box">
                    <label for="party1-name">Party 1 Name:</label>
                    <input type="text" id="party1-name" name="party1-name" required></br>
                 
                    <label for="party2-name">Party 2 Name:</label>
                    <input type="text" id="party2-name" name="party2-name" required></br>
                    
                </div>
            </div>
        </body>
        </html>';

        $dompdf->loadHtml($agrement);
        $dompdf->setPaper('A4', 'landscape'); 
        $dompdf->render();
        $output = $dompdf->output();
        $pdf=file_put_contents('./pdf/'.$invest_id.'agrement.pdf', $output);
        $path='./pdf/'.$invest_id.'agrement.pdf';

        $confor=mysqli_query($conn,"UPDATE `invest` SET `path`='$path' WHERE `id`='$invest_id'");
      	sms($mobile,$msg,$conn);
        echo $invest_id;
        // foreach ($referals as $referal)
        // {
        //     $q="INSERT INTO `referal`(`id`, `refcid`, `refasign`, `refpday`, `refpmonth`) VALUES 
        //     ('$row[0]','$referal[0]','$referal[1]','$referal[2]','$referal[3]');";
        //     $conf=mysqli_query($conn,$q);
        // }
        //echo "Invested Successfully";
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
    