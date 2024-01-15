<?php
                        //$query="SELECT * FROM `resister` ORDER BY `cid` ASC";
                        // $retval=mysqli_query($connN, $query);
                        // while ($row = mysqli_fetch_array($retval)) 
                        // {
                         //      $cid=$row['cid'];
                         //     $f_name=$row['f_name']; $branch=$row['branch'];$relation=$row['relation'];
                         //     $m_name=$row['m_name'];$bank=$row['bank'];$isfc_no=$row['isfc_no'];
                         //     $l_name=$row['l_name'];$acc_no=$row['acc_no'];$pan_card_num=$row['pan_card_num'];
                         //     $blood_gp=$row['blood_gp'];$mobile=$row['mobile'];$date=$row['date'];
                         //     $address=$row['address'];$nominee=$row['nominee'];$full_name=$row['full_name'];


                         //    {
                         //         $acc_no1 = substr($acc_no,1);
                         //    }else
                         //    {
                         //         $acc_no1=$acc_no;
                         //    }
                        //     include('dbcon.php');
                        //     $q="INSERT INTO `register`(`cid`,`regdate`,`fname`,`mname`,`lname`, `mobile`,`pan`, `address`, `blood`,`bank`, `account`, `ifsc`, `branch`, `nominee`, `relation`, `full`)
                        //     VALUES('$cid','$date','$f_name','$m_name','$l_name','$mobile','$pan_card_num','$address','$blood_gp','$bank','$acc_no1','$isfc_no','$branch','$nominee','$relation','$full_name')";
                        //     $retval1=mysqli_query($conn, $q);
                            
                            
                        // }
                        //  echo '<script>alert("passed")</script>';


                        //  $query="SELECT * FROM `login` ORDER BY `logid` ASC";
                        // $retval=mysqli_query($connN, $query);
                        // while ($row = mysqli_fetch_array($retval)) 
                        // {
                         //    $cid=$row['cid'];
                         //    $logid=$row['logid'];
                         //    $username=$row['username'];
                         //    $password=$row['password'];
                         //    $user=$row['user'];
                         //    if($user != 'member')
                         //    {
                         //        $us='Member';
                         //    }else
                         //    {
                         //        $us=$user;
                         //    }
                        //     // include('dbcon.php');
                        //     $q="INSERT INTO `login`(`logid`,`cid`,`username`,`password`,`user`)VALUES('$logid','$cid','$username','$password','$us')";
                        //     $retval1=mysqli_query($conn, $q);
                            
                            
                        // }
                        //  echo '<script>alert("passed")</script>';



                        //  $query="SELECT * FROM `invest` WHERE `i_id` >'14386' ORDER BY `i_id` ASC";
                        // $retval=mysqli_query($connN, $query);
                        // while ($row = mysqli_fetch_array($retval)) 
                        // {
                         //    $i_id=$row['i_id'];
                         //    $cid=$row['cid'];
                         //    $i_date=$row['i_date'];
                         //    $value=$row['value'];
                         //    $pecentage=$row['pecentage'];
                         //    $perday=$row['perday'];
                            
                         //    $permonth=$perday*30;
                        //     // include('dbcon.php');
                        //     $q="INSERT INTO `invest`(`id`,`cid`,`regdate`,`invest`,`asign`,`pday`,`pmonth`)VALUES('$i_id','$cid','$i_date','$value','$pecentage','$perday','$permonth')";
                        //     $retval1=mysqli_query($conn, $q);
                            
                            
                        // }
                        //  echo '<script>alert("passed")</script>';


                         // $query="SELECT `introduce`.*,`resister`.`cid` FROM `introduce`,`resister` WHERE `introduce`.`r_name`=`resister`.`full_name` AND `introduce`.`r_id`>'11730' ORDER BY `introduce`.`r_id` ASC";
                        // $retval=mysqli_query($connN, $query);
                        // while ($row = mysqli_fetch_array($retval)) 
                        // {
                         //    $i_id=$row['i_id'];
                         //    // $r_id=$row['r_id'];
                         //    $cid=$row['cid'];
                         //    // $i_date=$row['i_date'];
                         //    // $value=$row['value'];
                         //    $r_pecentag=$row['r_pecentag'];
                         //    $r_perday=$row['r_perday'];
                         //     $permonth=$r_perday*30;
                        //     include('dbcon.php');
                        //     $q="INSERT INTO `referal`(`id`,`refcid`,`refasign`,`refpday`,`refpmonth`)VALUES('$i_id','$cid','$r_pecentag','$r_perday','$permonth')";
                        //     $retval1=mysqli_query($conn, $q);
                        // }
                        // echo '<script>alert("passed")</script>';



                        
          // Source database connection parameters
      /*    $sourceHostname = 'localhost';
          $sourceUsername = 'root';
          $sourcePassword = '';
          $sourceDatabase = 'old_shiv';
          
          // Destination database connection parameters
          $destinationHostname = 'localhost';
          $destinationUsername = 'root';
          $destinationPassword = '';
          $destinationDatabase = 'shivinvest2';
          
          // Number of records to retrieve and insert in each batch
          $batchSize = 1000;
          
          // Create source database connection
          $sourceConnection = new mysqli($sourceHostname, $sourceUsername, $sourcePassword, $sourceDatabase);
          
          // Check if the source connection was successful
          if ($sourceConnection->connect_error) {
               die('Source connection failed: ' . $sourceConnection->connect_error);
          }
          
          // Create destination database connection
          $destinationConnection = new mysqli($destinationHostname, $destinationUsername, $destinationPassword, $destinationDatabase);
          
          // Check if the destination connection was successful
          if ($destinationConnection->connect_error) {
               die('Destination connection failed: ' . $destinationConnection->connect_error);
          }
          
          // Retrieve data from the source database
          $sourceQuery = "SELECT * FROM `log_permission` ORDER BY `log_per_id` ASC";
          // $sourceQuery="SELECT `introduce`.*,`resister`.`cid` FROM `introduce`,`resister` WHERE `introduce`.`r_name`=`resister`.`full_name` ORDER BY `introduce`.`r_id` ASC";
          $sourceResult = $sourceConnection->query($sourceQuery);
          
          if (!$sourceResult) {
               die('Error retrieving data from source database: ' . $sourceConnection->error);
          }
          
          // Initialize batch variables
          $batchCount = 0;
          $insertValues = '';
          
          // Insert data into the destination database in batches
          while ($row = $sourceResult->fetch_assoc()) 
          {
               $set_time=$row['set_time'];
               $end_time=$row['end_time'];
               $user=$row['user'];

               // $column1Value = $destinationConnection->real_escape_string($row['column1']);
               // $column2Value = $destinationConnection->real_escape_string($row['column2']);

               // Construct the VALUES portion of the INSERT statement
               $insertValues .= "('$set_time','$end_time','$user'),";
          
                $batchCount++;
          
               // Insert the batch when reaching the desired batch size
               if ($batchCount === $batchSize)
               {
                    // Trim the trailing comma and space from the values string
                    $insertValues = rtrim($insertValues, ', ');
                    // Construct the INSERT statement
                    $insertQuery = "INSERT INTO `log_permission`(`set_time`, `end_time`, `user`) $insertValues";
          
                    // Execute the INSERT statement
                    if ($destinationConnection->query($insertQuery) === TRUE) {
                         echo "Inserted $batchCount records successfully.<br>";
                    } else {
                         echo "Error inserting records: " . $destinationConnection->error . "<br>";
                    }
          
                    // Reset batch variables
                    $batchCount = 0;
                    $insertValues = '';
               }
          }
          
          // Insert any remaining records in the last batch
          if ($batchCount > 0) {
               // Trim the trailing comma and space from the values string
               $insertValues = rtrim($insertValues, ', ');
          
          //      // Construct the INSERT statement
               $insertQuery = "INSERT INTO `log_permission`(`set_time`, `end_time`, `user`) $insertValues";

          
          //      // Execute the INSERT statement
               if ($destinationConnection->query($insertQuery) === TRUE) {
                    echo "Inserted $batchCount records successfully.<br>";
               } else {
                    echo "Error inserting records: " . $destinationConnection->error . "<br>";
               }
          }
          
          // Close the source result set
          $sourceResult->close();
          
          // Close the database connections
          $sourceConnection->close();
          $destinationConnection->close();

     */



// Source database connection parameters
$sourceHostname = 'localhost';
$sourceUsername = 'root';
$sourcePassword = '';
$sourceDatabase = 'oldshivam';

// Destination database connection parameters
$destinationHostname = 'localhost';
$destinationUsername = 'root';
$destinationPassword = '';
$destinationDatabase = 'investment1';

// Number of records to retrieve and insert in each batch
$batchSize = 1000;

// Create source database connection
$sourceConnection = new mysqli($sourceHostname, $sourceUsername, $sourcePassword, $sourceDatabase);

// Check if the source connection was successful
if ($sourceConnection->connect_error) {
    die('Source connection failed: ' . $sourceConnection->connect_error);
}

// Create destination database connection
$destinationConnection = new mysqli($destinationHostname, $destinationUsername, $destinationPassword, $destinationDatabase);

// Check if the destination connection was successful
if ($destinationConnection->connect_error) {
    die('Destination connection failed: ' . $destinationConnection->connect_error);
}

// $sourceQuery="SELECT `introduce`.*,`resister`.`cid` FROM `introduce`,`resister` WHERE `introduce`.`r_name`=`resister`.`full_name` ORDER BY `introduce`.`r_id` ASC";

// $sourceResult = $sourceConnection->query($sourceQuery);

// if (!$sourceResult) {
//     die('Error retrieving data from source database: ' . $sourceConnection->error);
// }
// while ($row = $sourceResult->fetch_assoc())
// {
//      $i_id=$row['i_id'];
//      $r_id=$row['r_id'];
//      $cid=$row['cid'];
//      $r_pecentag=$row['r_pecentag'];
//      $r_perday=$row['r_perday'];
//      $permonth=$r_perday*30;
//      $insertQuery = "INSERT INTO `referal`(`refid`, `id`, `refcid`, `refasign`, `refpday`, `refpmonth`) VALUES('$r_id','$i_id','$cid','$r_pecentag','$r_perday','$permonth')";
//      if ($destinationConnection->query($insertQuery) === TRUE) 
//      {
//           echo "Inserted records successfully.<br>";
//      } else {
//           echo "Error inserting records: " . $destinationConnection->error . "<br>";
//      }
// }

// Retrieve data from the source database

// -------------------------------log_permission------------------------------------------
// $sourceQuery = "SELECT * FROM `log_permission` ORDER BY `w_id` ASC";

// -------------------------------log_permission------------------------------------------
// $sourceQuery = "SELECT * FROM `withdraw` ORDER BY `w_id` ASC";

// -------------------------------resister------------------------------------------
// $sourceQuery = "SELECT * FROM `resister` ORDER BY `cid` ASC";

// -------------------------------invest------------------------------------------
// $sourceQuery = "SELECT * FROM `invest` ORDER BY `i_id` ASC";

// -------------------------------withdraw------------------------------------------
$sourceQuery = "SELECT * FROM `withdraw` ORDER BY `w_id` ASC";

// -------------------------------introduce------------------------------------------
// $sourceQuery="SELECT * FROM `introduce` ORDER BY `r_id` ASC";

// -------------------------------login------------------------------------------
// $sourceQuery = "SELECT * FROM `login` ORDER BY `logid` ASC";

// -------------------------------log_info------------------------------------------
// $sourceQuery = "SELECT * FROM `log_info` ORDER BY `logg_id` ASC";

$sourceResult = $sourceConnection->query($sourceQuery);

if (!$sourceResult) {
    die('Error retrieving data from source database: ' . $sourceConnection->error);
}

// Initialize batch variables
$batchCount = 0;
$insertValues = '';

// Insert data into the destination database in batches
while ($row = $sourceResult->fetch_assoc())
{
     // -------------------------------log_permission------------------------------------------
     //      $set_time = $row['set_time'];
     //      $end_time = $row['end_time'];
     //      $user = $row['user'];
     //     $insertValues .= "('$set_time','$end_time','$user'),";
  
     // -------------------------------resister------------------------------------------

     // $cid=$row['cid'];
     // $f_name=$row['f_name']; $branch=$row['branch'];$relation=$row['relation'];
     // $m_name=$row['m_name'];$bank=$row['bank'];$isfc_no=$row['isfc_no'];
     // $l_name=$row['l_name'];$acc_no=$row['acc_no'];$pan_card_num=$row['pan_card_num'];
     // $blood_gp=$row['blood_gp'];$mobile=$row['mobile'];$date=$row['date'];
     // $address=$row['address'];$nominee=$row['nominee'];$full_name=$row['full_name'];

     // if (preg_match('/^[^A-Za-z0-9]/', $acc_no)) 
     // {
     //      $acc_no1 = substr($acc_no, 1);
     // } else {
     //      $acc_no1 = $acc_no;
     // }

     // $insertValues .= "('$cid','$date','$f_name','$m_name','$l_name','$mobile','','$pan_card_num','$address','$blood_gp','','$bank','$acc_no1','$isfc_no','$branch','$nominee','$relation','$full_name'),";

     // -------------------------------WITHDRAW------------------------------------------

          $w_id=$row['w_id'];
          $cid=$row['cid'];
          $i_id=$row['i_id'];
          $w_date=$row['w_date'];
          $w_amt=$row['w_amt'];
          // $perday=$row['perday'];
          // $permonth=$perday*30;

          $year = date('Y', strtotime($w_date));
          $Month = date('M', strtotime($w_date));

          $insertValues .= "('$cid','$i_id','$w_date','$w_amt','$year','$Month',''),";
     
     // -------------------------------INVEST------------------------------------------

     // $i_id=$row['i_id'];
     // $cid=$row['cid'];
     // $i_date=$row['i_date'];
     // $value=$row['value'];
     // $pecentage=$row['pecentage'];
     // $perday=$row['perday'];
     // $permonth=$perday*30;

     // $year = date('Y', strtotime($i_date));
     // $Month = date('M', strtotime($i_date));

     // $insertValues .= "('$i_id','$cid','$i_date','$value','$pecentage','$perday','$permonth','','','$year','$Month',''),";

     // -------------------------------introduce------------------------------------------
          // $i_id=$row['i_id'];
          // $r_id=$row['r_id'];
          // $r_name=$row['r_name'];
          // // $cid=$row['cid'];
          // $r_pecentag=$row['r_pecentag'];
          // $r_perday=$row['r_perday'];
          // $permonth=$r_perday*30;

          // $insertValues .= "('$r_id','$i_id','$r_name','$r_pecentag','$r_perday','$permonth'),";
     // -------------------------------login------------------------------------------
          // $cid=$row['cid'];
          // $logid=$row['logid'];
          // $username=$row['username'];
          // $password=$row['password'];
          // $user=$row['user'];

          // $insertValues .= "('','$cid','$username','$password','$user'),";

     // -------------------------------log_info------------------------------------------
          // $cid=$row['cid'];
          // $login=$row['login'];
          // $logout=$row['logout'];
          // $insertValues .= "('','$cid','$login','$logout'),";

     $batchCount++;
  
     // Insert the batch when reaching the desired batch size
     if ($batchCount === $batchSize)
     {
          // Trim the trailing comma and space from the values string
          $insertValues = rtrim($insertValues, ', ');

          // Construct the INSERT statement

          //    -------------------------------log_permission------------------------------------------
          //  $insertQuery = "INSERT INTO `log_permission`(`set_time`, `end_time`, `user`) VALUES $insertValues";
  
          // -------------------------------resister------------------------------------------
          // $insertQuery = "INSERT INTO `register`(`cid`, `regdate`, `fname`, `mname`, `lname`, `mobile`, `email`, `pan`, `address`, `blood`, `gender`, `bank`, `account`, `ifsc`, `branch`, `nominee`, `relation`, `full`) VALUES $insertValues";

          // -------------------------------invest------------------------------------------
          // $insertQuery = "INSERT INTO `invest`(`id`, `cid`, `regdate`, `invest`, `asign`, `pday`, `pmonth`, `pmode`, `img`, `year`, `month`, `path`) VALUES $insertValues";

          // -------------------------------widraw------------------------------------------
          $insertQuery = "INSERT INTO `widraw`(`cid`, `inv_id`, `wdate`, `wamt`, `year`, `month`, `path`)  VALUES $insertValues";

          // -------------------------------introduce------------------------------------------
          // $insertQuery = "INSERT INTO `referal`(`refid`, `id`, `r_name`, `refasign`, `refpday`, `refpmonth`) VALUES $insertValues";
          // INSERT INTO `log_info`(`logg_id`, `cid`, `login`, `logout`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')

          // -------------------------------login------------------------------------------
          // $insertQuery = "INSERT INTO `login`(`logid`, `cid`, `username`, `password`, `user`) VALUES $insertValues";

           // -------------------------------log_info------------------------------------------
          // $insertQuery = "INSERT INTO `log_info`(`logg_id`, `cid`, `login`, `logout`) VALUES $insertValues";

           // -------------------------------log_info------------------------------------------
          // $insertQuery = "INSERT INTO `widraw`(`wid`, `cid`, `inv_id`, `wdate`, `wamt`, `year`, `month`, `path`) VALUES $insertValues";
          if ($destinationConnection->query($insertQuery) === TRUE) 
          {
               echo "Inserted $batchCount records successfully.<br>";
          } else {
               echo "Error inserting records: " . $destinationConnection->error . "<br>";
          }
  
          // Reset batch variables
          $batchCount = 0;
          $insertValues = '';
     }
}

// Insert any remaining records in the last batch
if ($batchCount > 0) 
{
     // Trim the trailing comma and space from the values string
     $insertValues = rtrim($insertValues, ', ');
  
     // Construct the INSERT statement
     //     -------------------------------log_permission------------------------------------------
     // $insertQuery = "INSERT INTO `log_permission`(`set_time`, `end_time`, `user`) VALUES $insertValues";
  
     // -------------------------------resister------------------------------------------
     // $insertQuery = "INSERT INTO `register`(`cid`, `regdate`, `fname`, `mname`, `lname`, `mobile`, `email`, `pan`, `address`, `blood`, `gender`, `bank`, `account`, `ifsc`, `branch`, `nominee`, `relation`, `full`) VALUES $insertValues";

     // // -------------------------------invest------------------------------------------
     // $insertQuery = "INSERT INTO `invest`(`id`, `cid`, `regdate`, `invest`, `asign`, `pday`, `pmonth`, `pmode`, `img`, `year`, `month`, `path`) VALUES $insertValues";

     // -------------------------------introduce------------------------------------------
     //  $insertQuery = "INSERT INTO `referal`(`refid`, `id`, `r_name`, `refasign`, `refpday`, `refpmonth`) VALUES $insertValues";
      
      // -------------------------------login------------------------------------------
     //  $insertQuery = "INSERT INTO `login`(`logid`, `cid`, `username`, `password`, `user`) VALUES $insertValues";

     // -------------------------------log_info------------------------------------------
     // $insertQuery = "INSERT INTO `log_info`(`logg_id`, `cid`, `login`, `logout`) VALUES $insertValues";


    // -------------------------------widraw------------------------------------------
    $insertQuery = "INSERT INTO `widraw`(`cid`, `inv_id`, `wdate`, `wamt`, `year`, `month`, `path`)  VALUES $insertValues";

    // Execute the INSERT statement
     if ($destinationConnection->query($insertQuery) === TRUE) 
     {
          echo "Inserted $batchCount records successfully.<br>";
     } else {
          echo "Error inserting records: " . $destinationConnection->error . "<br>";
     }
}

// Close the source result set
$sourceResult->close();

// Close the database connections
$sourceConnection->close();
$destinationConnection->close();

                        
?>