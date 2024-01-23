<?php 
     include('../dbcon.php');
     header('Access-Control-Allow-Origin:*');
     header('Access-Control-Request-Methods:POST');
     header('Content-Type:Application/json');
     header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-Control-Request-Methods,Access-Control-Allow-Headers,Authorization,X-Request-With');
     // $data =json_decode(file_get_contents("php://input"));
     $data =file_get_contents("php://input");
     $data=json_decode($data,TRUE);
     $name=$data['name'];
     $email=$data['email'];
     $phone=$data['phone'];
     $message=$data['message'];
     //echo $data['email'];
     $subject="Insurance Enquiry";
     $to=$data['email'];
     $msg ='<!doctype html>
                <html lang="en">
                  <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Dhaneshwari</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                    <style>
                        .conatiner1{
                            margin-top: 100px;
                            width: 600px;
                            background-color: white;
                            padding-bottom:10px;
                            box-shadow: 0px 2px 2px 1px rgb(120, 119, 119);
                        }
                        .conatiner1 .box{
                            width: 600px;
                            height: 70px;
                            background-color: #191970;
                        }
                        .conatiner1 h1{
                            padding-top: 10px;
                            padding-left:80px;
                            color:white;
                            
                        }
                         .conatiner1 h3{
                            padding-top: 5px;
                            color:white;
                            
                        }
                        .para p{
                            margin: 10px;
                        }
                        .table1{
                            width: 520px;
                            margin: 40px;
                            
                        }
                        table {
                            font-family: arial, sans-serif;
                            border-collapse: collapse;
                            width: 100%;
                            
                            }
                
                            td, th {
                            border: 1px solid #dddddd;
                            text-align: left;
                            padding: 8px;
                        }
                        .box{
                        padding-top:0px;                        
                        }
                   
                    </style>
                  </head>
                  <body>
                    <div class="conatiner1">
                        <div class="box">
                            <h1 >Insurance Enquiry</h1>
                        </div>
                        <p class="para">Name : '.$name.'</p>
                        <p>My Email : '.$email.'</p>
                        <p>Contact Number : '.$phone.'</p>
                         <p>Message : '.$message.'</p>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                  </body>
                </html>';
               
         require './vendor/autoload.php';
         include('./smtp/PHPMailerAutoload.php');
             $html='Msg';
            
             $mail = new PHPMailer(); 
             $mail->SMTPDebug  = 3;
             $mail->IsSMTP(); 
             $mail->SMTPAuth = true; 
             $mail->SMTPSecure = 'tls'; 
             $mail->Host = "mail.evontest.com";
             $mail->Port = 587; 
             $mail->IsHTML(true);
             $mail->CharSet = 'UTF-8';
             $mail->Username = "noreply@evontest.com";
             $mail->Password = "Evon@2015";
             $mail->SetFrom($to);
             $mail->Subject = $subject;
             $mail->Body =$msg;
             $mail->AddAddress("noreply@evontest.com");
             $mail->SMTPOptions=array('ssl'=>array(
                 'verify_peer'=>false,
                 'verify_peer_name'=>false,
                 'allow_self_signed'=>false
             ));
             if(!$mail->Send()){
                 echo $mail->ErrorInfo;
             }else{
                 return 'Sent';
             }
            // echo $mail;
     
 