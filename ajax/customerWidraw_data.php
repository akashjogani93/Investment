<?php include('../dbcon.php');?>

    <?php if(isset($_POST['full1']))
    {
        $full=$_POST['full1'];
        $data="";
        $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
        $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
        $query="SELECT `invest`.*,`register`.* FROM `invest`,`register` WHERE `invest`.`cid`='$full' AND `invest`.`cid`=`register`.`cid`  ORDER BY `invest`.`id`";
        $retval=mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($retval)) 
        {
                    $id=$row['id'];
                    $full=$row['full'];
                    $mobile=$row['mobile'];
                    $bank=$row['bank'];
                    $ifsc=$row['ifsc'];
                    $invest=$row['invest'];
                    $asign=$row['asign'];
                    $data.='<tr>
                                <td><button onclick="debit('.$id.')" class="btn btn-primary">Debit</button></td>
                                <td>'.$id.'</td>
                                <td>'.$full.'</td>
                                <td>'.$mobile.'</td>
                                <td>'.$ifsc.'</td>
                                <td>'.$bank.'</td>
                                <td>'.$formatter->format($invest).'</td>
                                <td>'.number_format($asign,2).'</td>
                            </tr>';
                }  
                echo json_encode($data);
        } 
            
        ?>

            
                
                        
                
            
            


            