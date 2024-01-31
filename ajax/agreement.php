<?php
include("../dbcon.php");

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $query = "SELECT * FROM `register` WHERE `cid`='$cid'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
}

if (isset($_POST['olddatacid']))
{
    $cid = $_POST['olddatacid'];
    $query = "SELECT `agreement`.* FROM `agreement` WHERE `agreement`.`cid`='$cid'";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result))
    {
        ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['party']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['occu']; ?></td>
                <td><?php echo $row['resident']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['bank']; ?></td>
                <td><?php echo $row['remark']; ?></td>
            </tr>
        <?php
    }
}


if (isset($_POST['insert']))
{
    $date = $_POST['date'];
    $party = $_POST['party'];
    $age = $_POST['age'];
    $occ = $_POST['occ'];
    $res = $_POST['res'];
    $amt = $_POST['amt'];
    $bank = $_POST['bank'];
    $remark = $_POST['remark'];
    $cid = $_POST['insert'];

    $query="INSERT INTO `agreement`(`date`, `party`, `age`, `occu`, `resident`, `amount`, `bank`, `remark`, `cid`) VALUES ('$date','$party','$age','$occ','$res','$amt','$bank','$remark','$cid')";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        echo mysqli_insert_id($conn);
    }
}

if (isset($_POST['aggId'])) 
{
    $aggId = $_POST['aggId'];
    $query = "SELECT * FROM `agreement` WHERE `id`='$aggId'";
    $result = mysqli_query($conn, $query);

    if ($result) 
    {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
}
?>

