<?php 
    include('../dbcon.php');

    $QUERY="SELECT * FROM `fd_customers` ORDER BY `f_cid` ASC";
    $CONF=MYSQLI_QUERY($conn,$QUERY);
    while($ROW=MYSQLI_FETCH_ARRAY($CONF))
    {
        ?>
        <!-- <a href="#" class="btn btn-info">Edit</a> -->
            <tr>
                <td>
                    <a href="fd_plan.php?fd_id=<?php echo $ROW['f_cid']; ?>&fd_name=<?php echo $ROW['full']; ?>" class="btn btn-info">Invest</a>
                    <button class="btn btn-danger fd-edit" id="editfd" onclick="fdedit(this)">Edit</button>
                </td>
                <td><?php echo $ROW['f_cid']; ?></td>
                <td style="display:none"><?php echo $ROW['fname']; ?></td>
                <td style="display:none"><?php echo $ROW['mname']; ?></td>
                <td style="display:none"><?php echo $ROW['lname']; ?></td>
                <td style="display:none"><?php echo $ROW['regdate']; ?></td>
                <td><?php echo $ROW['full']; ?></td>
                <td><?php echo $ROW['mobile']; ?></td>
                <td><?php echo $ROW['gen']; ?></td>
                <td><?php echo $ROW['adds']; ?></td>
                <td><?php echo $ROW['nominee']; ?></td>
                <td><?php echo $ROW['relation']; ?></td>
            </tr>
        <?php
    }
?>
