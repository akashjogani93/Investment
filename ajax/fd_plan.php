<?php
require_once('../dbcon.php');

if(isset($_POST['cid']))
{
    $cid = $_POST['cid'];
    $fddate = $_POST['fddate'];
    $to_date = $_POST['to_date'];
    $invest = $_POST['invest'];
    $year = $_POST['year'];
    $int = $_POST['int'];
    $mamount = $_POST['mamount'];
    $q="INSERT INTO `fd`(`cid`,`amount`,`date`,`year`,`todate`,`interest`,`mamount`)VALUES('$cid','$invest','$fddate','$year','$to_date','$int','$mamount')";
    $conform=mysqli_query($conn,$q);
    echo 'FD Added Successfully';
}

if(isset($_POST['submit']))
{
    $query="SELECT `fd_customers`.`full`,`fd`.* FROM `fd_customers`,`fd` WHERE `fd_customers`.`f_cid`=`fd`.`cid`";
    $conform=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($conform))
    {
        ?>
            <tr>
                <td><?php echo $row['fd_id']; ?></td>
                <td><?php echo $row['full']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['interest']; ?></td>
                <td><?php echo $row['mamount']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['todate']; ?></td>
            </tr>
        <?php
    }
}   
?>