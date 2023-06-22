<?php include('../dbcon.php');

if(isset($_POST["submit"]))
{
    $submit=$_POST["submit"];
    if($submit=='submit')
    {
        $limit=$_POST["limit"];
        $std=$_POST["start"];
        $query="SELECT `invest`.*,`register`.`full`,`register`.`mobile` FROM `invest`,`register` WHERE `invest`.`cid`=`register`.`cid` ORDER BY `invest`.`id` ASC LIMIT $std, $limit;";
    }

    $retval=mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($retval)) 
    {
        $id=$row['id'];
        $invest=$row['invest'];
        $intro=array();
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
        } ?>
            <tr>
                <td><button onclick="editupdate(<?php echo $row['id']; ?>)" class="btn btn-info">Edit</button></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['full']; ?></td>
                <td><?php echo $row['regdate']; ?></td>
                <td><?php echo $row['invest']; ?></td>  
                <td><?php echo $row['asign']; ?></td>  
                <td><?php echo $row['pday']; ?></td>  
                <td><?php echo $row['pmonth']; ?></td>
               
            </tr>
        <?php
    }

}


