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
    $query = "SELECT `cheque`.* FROM `cheque` WHERE `cheque`.`cid`='$cid'";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result))
    {
        ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['party']; ?></td>
                <td><?php echo $row['amount']; ?></td>
            </tr>
        <?php
    }
}


if (isset($_POST['insert']))
{
    $date = $_POST['date'];
    $party = $_POST['party'];
    $amt = $_POST['amt'];
    $cid = $_POST['insert'];

    $query="INSERT INTO `cheque`(`date`, `party`,`amount`,`cid`) VALUES ('$date','$party','$amt','$cid')";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        echo mysqli_insert_id($conn);
    }
}

if (isset($_POST['aggId'])) 
{
    $aggId = $_POST['aggId'];
    $query = "SELECT * FROM `cheque` WHERE `id`='$aggId'";
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

