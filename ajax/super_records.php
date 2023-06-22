<?php 
    include('../dbcon.php');
    if(isset($_POST['submit']))
    {
        $full1=$_POST['full1'];
        if($full1=='full1')
        {
            $query="SELECT * FROM `invest`";
        }
        else
        {
            $query="SELECT * FROM `invest` WHERE `cid`='$full1'";
        }
        $exc=mysqli_query($conn,$query);
        $new1=0; $wamt1=0;
        while($con=mysqli_fetch_array($exc))
        {
            $new=$con['invest'];
            $new1=$new+$new1;
           
        }


        echo json_encode($new1);
        mysqli_close($conn);
    }
    if(isset($_POST['withdraw']))
    {
        $full1=$_POST['full1'];
        if($full1=='full1')
        {
            $query="SELECT * FROM `widraw`";
        }
        else
        {
            $query="SELECT * FROM `widraw` WHERE `cid`='$full1'";
        }
        $exc=mysqli_query($conn,$query);
        $wamt1=0;
        while($con=mysqli_fetch_array($exc))
        {
            $wamt=$con['wamt'];
            $wamt1=$wamt+$wamt1;
           
        }


        echo json_encode($wamt1);
        mysqli_close($conn);
    }
    
    if(isset($_POST['interest']))
    {
        
        $full1=$_POST['full1'];
        if($full1=='full1')
        {
            $query="SELECT * FROM `widraw`";
        }
        else
        {
            $query="SELECT * FROM `widraw` WHERE `cid`='$full1'";
        }
        $exc=mysqli_query($conn,$query);
        $wamt1=0;
        while($con=mysqli_fetch_array($exc))
        {
            $wamt=$con['wamt'];
            $wamt1=$wamt+$wamt1;
           
        }


        echo json_encode($wamt1);
        mysqli_close($conn);
    }


    if(isset($_POST['search']))
    {
        $full1=$_POST['full1'];
        $q1="SELECT SUM(`invest`) AS `invest` FROM `invest` WHERE `cid`='$full1'";
        $exc1=mysqli_query($conn,$q1);
        $row[0]=mysqli_fetch_array($exc1);

        $q2="SELECT SUM(`wamt`) AS `wamt` FROM `widraw` WHERE `cid`='$full1'";
        $exc2=mysqli_query($conn,$q2);
        $row1[0]=mysqli_fetch_array($exc2);


        $query="SELECT * FROM `invest` WHERE `cid`='$full1' ORDER BY `id` ASC";
        $exc=mysqli_query($conn,$query);
        $a=[$row[0],$row1[0],$full1];
        
        while($row=mysqli_fetch_array($exc))
        {
            $id=$row['id'];
            $invest=$row['invest'];
            $regdate=$row['regdate'];
            $asign=$row['asign'];
            
            // $wi=array();
            // $wisum=0;
            // $query1="SELECT * FROM `widraw` WHERE `inv_id`='$id' ORDER BY `wid` ASC";
            // $ex=mysqli_query($conn,$query1);
            // while($out=mysqli_fetch_array($ex))
            // {
            //     $wdate=$out['wdate'];
            //     $wamt=$out['wamt'];
            //     $wisum +=$wamt;
            //     array_push($wi,$wdate,$wisum);
            // }
        }

        echo json_encode($a);
        mysqli_close($conn);

    }


        // $full1=6405;
        // $q1="SELECT SUM(`invest`) AS `invest` FROM `invest` WHERE `cid`='$full1'";
        // $exc1=mysqli_query($conn,$q1);
        // $row[0]=mysqli_fetch_array($exc1);

        // $q2="SELECT SUM(`wamt`) AS `wamt` FROM `widraw` WHERE `cid`='$full1'";
        // $exc2=mysqli_query($conn,$q2);
        // $row1[0]=mysqli_fetch_array($exc2);

        // $toalinvestment=$row[0]+$row1[0];
        // $a=[$row[0],$row1[0],$full1];

        // $wisum=0;
        // $query="SELECT * FROM `invest` WHERE `cid`='$full1' ORDER BY `id` ASC";
        // $exc=mysqli_query($conn,$query);
        // while($row=mysqli_fetch_array($exc))
        // {
        //     $id=$row['id'];
        //     $invest=$row['invest'];
        //     $regdate=$row['regdate'];
        //     $asign=$row['asign'];
        //     $wi=[];

        //     $query1="SELECT * FROM `widraw` WHERE `inv_id`='$id' ORDER BY `wid` ASC";
        //     $ex=mysqli_query($conn,$query1);
        //     while($out=mysqli_fetch_array($ex))
        //     {
        //         $wdate=$out['wdate'];
        //         $wamt=$out['wamt'];
        //         $wisum +=$wamt;
        //         array_push($wi, array($wdate,$wamt,$wisum));
        //     }
        //     $i=0;
        //     $days1=0;
        //     foreach($wi as $ele)
        //     {
                
        //         $investDate = strtotime($regdate);
        //         $withdraw = strtotime($ele[0]);

        //         $diffInSeconds = abs($withdraw - $investDate);
        //         $days = floor($diffInSeconds / (60 * 60 * 24));
        //         $investamt=$invest+$wisum;
        //         echo $regdate;
        //         echo '</br>';
        //         echo $investamt;
        //         echo '</br>';
        //         echo $ele[0];
        //         echo '</br>';
        //         echo $ele[1];
        //         echo '</br>';
        //         echo $days;
        //         echo '--</br>';
        //         $i++;
        //     }
            
        // }
// echo $regdate;
                // echo '</br>';
                // echo $investamt;
                // echo '</br>';
                // echo $ele[0];
                // echo '</br>';
                // echo $wamt;
                // echo '</br>';
                // echo $days;
                // echo '--</br>';

if(isset($_POST['action']))
{
    $cid=$_POST['cid'];
    if($cid=='submit')
    {
        $limit=$_POST['limit'];
        $std=$_POST['start'];
        $query="SELECT * FROM `register` ORDER BY `cid` ASC  LIMIT $std, $limit";
    }else
    {
        $query="SELECT * FROM `register` WHERE `cid`='$cid'";
    }
    $result=mysqli_query($conn,$query);
    while($out=mysqli_fetch_assoc($result))
    {
        $cid=$out['cid'];
        $full=$out['full'];
        $q1="SELECT SUM(`invest`) AS `invest` FROM `invest` WHERE `cid`='$cid'";
        $exc1=mysqli_query($conn,$q1);
        while($out1=mysqli_fetch_assoc($exc1))
        {
            $invest=$out1['invest'];
        }

        $q2="SELECT SUM(`wamt`) AS `wamt` FROM `widraw` WHERE `cid`='$cid'";
        $exc2=mysqli_query($conn,$q2);
        while($out2=mysqli_fetch_assoc($exc2))
        {
            $wamt=$out2['wamt'];
        }

        if($wamt!=0 && $invest!=0 )     
        {   
            ?>
                <tr>
                    <td><?php echo $cid; ?></td>
                    <td><?php echo $full; ?></td>
                    <td><?php echo $invest+$wamt; ?></td>
                    <td><?php echo $wamt; ?></td>
                    <td><?php echo $invest; ?></td>

                </tr>
            <?php
        }
    }
}
?>

