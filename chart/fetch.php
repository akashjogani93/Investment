<?php 
    include('../dbcon.php');

if(isset($_POST["year"]))
{
    $year=$_POST['year'];
    $query="SELECT DISTINCT `month` FROM `invest` WHERE `year`='$year'";
    $exe=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($exe))
    {
        $month=$row["month"];
        $que="SELECT SUM(`invest`) AS `amt` FROM `invest` WHERE `year`='$year' AND `month`='$month'";
        $ex=mysqli_query($conn,$que);
        while($row1=mysqli_fetch_array($ex))
        {
            $amt=$row1['amt'];
            $output[] = array(
                'month'   => $month,
                'profit'  => floatval($amt)
            );
    
        }
    }
    echo json_encode($output);
}


if(isset($_POST["year1"]))
{
    $year=$_POST['year1'];
    $query="SELECT DISTINCT `month` FROM `widraw` WHERE `year`='$year'";
    $exe=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($exe))
    {
        $month=$row["month"];
        $que="SELECT SUM(`wamt`) AS `amt` FROM `widraw` WHERE `year`='$year' AND `month`='$month'";
        $ex=mysqli_query($conn,$que);
        while($row1=mysqli_fetch_array($ex))
        {
            $amt=$row1['amt'];
            $output[] = array(
                'month'   => $month,
                'profit'  => floatval($amt)
            );
    
        }
    }
    echo json_encode($output);
}
?>