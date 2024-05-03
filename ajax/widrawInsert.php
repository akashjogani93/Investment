<?php
require_once('../dbcon.php');
include('../sms.php');
// use Dompdf\Dompdf;
$investid = $_POST['investid'];
$full1 = $_POST['full1'];
$regdate = $_POST['regdate'];
$year = date('Y', strtotime($regdate));
$Month = date('M', strtotime($regdate));
$wamt = $_POST['wamt'];
$ramt = $_POST['ramt'];
$asign = $_POST['asign'];
$pday = $_POST['pday'];
$pmonth = $_POST['pmonth'];
$id = $_POST['id'];

if($id==0)
{
    $file = $_FILES['file'];
    $typeamount =$wamt.time();
    $bond1 = upload_Profile($file,$typeamount,"withdra-pdf/");

}else
{
    $bond1='';
}

    $q="UPDATE `invest` SET `invest`='$ramt',`asign`='$asign',`pday`='$pday',`pmonth`='$pmonth' WHERE `id`='$investid' AND `cid`='$full1'";
    $conform=mysqli_query($conn,$q);
    if($conform)
    {
            $q="INSERT INTO `widraw`(`cid`, `inv_id`, `wdate`,`wamt`,`year`,`month`,`path`) VALUES 
            ('$full1','$investid','$regdate','$wamt','$year','$Month','$bond1');";
            $conf=mysqli_query($conn,$q);
            if($conf)
            {
                // $q1="SELECT `wid` FROM `widraw` ORDER BY `wid` DESC LIMIT 1;";
                // $cfm=mysqli_query($conn,$q1);
                // $row1=mysqli_fetch_array($cfm);
                // $widraw1=$row1[0];


                $confo=mysqli_query($conn,"SELECT `mobile` FROM `register` WHERE `cid`='$full1'");
                while($row=mysqli_fetch_assoc($confo))
                {
                    $mobile=$row['mobile'];
                }
                /*require_once './dompdf/autoload.inc.php';
                $dompdf = new Dompdf();
                $dompdf1 = new Dompdf();

                $withdra_agrement='<!DOCTYPE html>
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
                                    <p>Whereas, the parties wish to enter into an agreement for Amount Withdrawaled<strong>['.$wamt.']</strong> on the terms and conditions set forth herein, the parties agree as follows:</p>
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

                    $dompdf->loadHtml($withdra_agrement);
                    $dompdf->setPaper('A4', 'landscape'); 
                    $dompdf->render();
                    $output = $dompdf->output();

                    $pdf=file_put_contents('./withdra-pdf/'.$widraw1.'agrement.pdf', $output);

                    $path='./withdra-pdf/'.$widraw1.'agrement.pdf';
                    $confor=mysqli_query($conn,"UPDATE `widraw` SET `path`='$path' WHERE `wid`='$widraw1'");

                    $folder = './pdf/trash/';
                    $file='./pdf/'.$investid.'agrement.pdf';
                    if (!is_dir($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    
                    if (file_exists($file)) {
                        $newpath = $folder . basename($file);
                        if (rename($file, $newpath)) 
                        {
                            echo 'Debited Amount Successfully.';
                        } else {
                            echo 'Error moving file.';
                        }
                    } else {
                        echo 'File does not exist.';
                    }

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
                                                <p>Whereas, the parties wish to enter into an agreement for Amount Invested<strong>['.$ramt.']</strong> on the terms and conditions set forth herein, the parties agree as follows:</p>
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

                    $dompdf1->loadHtml($agrement);
                    $dompdf1->setPaper('A4', 'landscape'); 
                    $dompdf1->render();
                    $output1 = $dompdf1->output();

                    $pdf1=file_put_contents('./pdf/'.$investid.'agrement.pdf', $output1);


                    $path1='./pdf/'.$investid.'agrement.pdf';
                    $confor1=mysqli_query($conn,"UPDATE `invest` SET `path`='$path1' WHERE `id`='$investid'");*/

                    $msg="Rs :$wamt, Withdrawaled Successfully From Your Account.\nFrom: SHIVAM ASSOCIATES.\nThank You.";

                    sms($mobile,$msg,$conn);
                    echo "Debited Amount Successfully";

            }
        
    }

     //upload images profele & other document in jpg,png format
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