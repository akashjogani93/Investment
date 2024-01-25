<?php include('../dbcon.php');
if(isset($_POST["submit"]))
{
    $submit=$_POST["submit"];
    if($submit=='submit')
    {
        $limit=$_POST["limit"];
        $std=$_POST["start"];
        $query="SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` ORDER BY `invest`.`id` ASC LIMIT $std, $limit;";
    }else
    {
        $name=$_POST["name"];
        $query="SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` AND `register`.`cid`='$name'";
    }

    $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);

    $retval=mysqli_query($conn, $query);
    $i=$total1=$total2=$total3=0;
    while ($row = mysqli_fetch_array($retval)) 
    {
        $id=$row['id'];
        $invest=$row['invest'];
        $intro=array();
        // $i=1; 
        $qry="SELECT `referal`.*,`register`.`full`,`register`.`mobile` FROM `referal`,`register` WHERE `referal`.`refcid`=`register`.`cid` AND `id`='$id'";
        $confirm1=mysqli_query($conn,$qry);
        $i=1;
        while($row1=mysqli_fetch_array($confirm1))
        {
            $intro[$i][0]=$row1['full'];
            $intro[$i][1]=$row1['refasign'];
            $intro[$i][2]=$row1['refpday'];
            $intro[$i][3]=$row1['refpmonth'];
            $intro[$i][4]=round($row1['refpday']*30);
            if($invest=='0')
            {
                $intro[$i][2]='0';
                $intro[$i][3]=round(0*30);
            }
            $i=$i+1;
        }
        while($i<9)
        {
            $intro[$i][0]='-';
            $intro[$i][1]='-';
            $intro[$i][2]='-';
            $intro[$i][3]='-';
            $i=$i+1;
        } 

        $total1=$total1+round($row['invest']);
        $total2=$total2+$row['pday'];
        $total3=$total3+round($row['pday']*30);

        ?>
            <tr>
                <td><button onclick="editupdate(<?php echo $row['id']; ?>)" class="btn btn-info">Edit</button></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['full']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['regdate'])); ?></td>
                <td><?php echo $formatter->format($row['invest']); ?></td>  
                <td><?php echo $row['asign']; ?></td>  
                <td><?php echo $formatter->format($row['pday']); ?></td>  
                <td><?php echo $formatter->format($row['pmonth']); ?></td>
                       
                <!-- Introducer 1  -->
                <td><?php echo $intro[1][0]; ?></td>
                <td><?php echo $intro[1][1]; ?></td>
                <td><?php echo $intro[1][2]; ?></td>
                <td><?php echo $intro[1][3]; ?></td>

                <!-- Introducer 2 -->
                <td><?php echo $intro[2][0]; ?></td>
                <td><?php echo $intro[2][1]; ?></td>
                <td><?php echo $intro[2][2]; ?></td>
                <td><?php echo $intro[2][3]; ?></td>

                <!-- Introducer 3 -->
                <td><?php echo $intro[3][0]; ?></td>
                <td><?php echo $intro[3][1]; ?></td>
                <td><?php echo $intro[3][2]; ?></td>
                <td><?php echo $intro[3][3]; ?></td>

                <!-- Introducer 4 -->
                <td><?php echo $intro[4][0]; ?></td>
                <td><?php echo $intro[4][1]; ?></td>
                <td><?php echo $intro[4][2]; ?></td>
                <td><?php echo $intro[4][3]; ?></td>

                <!-- Introducer 5 -->
                <td><?php echo $intro[5][0]; ?></td>
                <td><?php echo $intro[5][1]; ?></td>
                <td><?php echo $intro[5][2]; ?></td>
                <td><?php echo $intro[5][3]; ?></td>

                <!-- Introducer 6 -->
                <td><?php echo $intro[6][0]; ?></td>
                <td><?php echo $intro[6][1]; ?></td>
                <td><?php echo $intro[6][2]; ?></td>
                <td><?php echo $intro[6][3]; ?></td>

                <!-- Introducer 7 -->
                <td><?php echo $intro[7][0]; ?></td>
                <td><?php echo $intro[7][1]; ?></td>
                <td><?php echo $intro[7][2]; ?></td>
                <td><?php echo $intro[7][3]; ?></td>

                <!-- Introducer 8 -->
                <td><?php echo $intro[8][0]; ?></td>
                <td><?php echo $intro[8][1]; ?></td>
                <td><?php echo $intro[8][2]; ?></td>
                <td><?php echo $intro[8][3]; ?></td>

            </tr>
        <?php
    }
    ?>
        <tr class="table-active">
            <!---invester ----->
            <td colspan="1"></td>
            <td colspan="3">-</td>
            <th><?php echo $formatter->format($total1) ?></th>
            <td>-</td>
            <th><?php echo $formatter->format($total2) ?></th>
            <th><?php echo $formatter->format($total3) ?></th>
            <td colspan="32">-</td>
       </tr>
    <?php
}

?>




