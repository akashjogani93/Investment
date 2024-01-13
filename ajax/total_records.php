<?php 
    include('../dbcon.php');
    if(isset($_POST['submit']))
    {
        $option=array();
        $query = "SELECT 
            (SELECT SUM(wamt) FROM widraw) AS inv,
            (SELECT SUM(invest) FROM invest) AS inv_invest";
        $exc=mysqli_query($conn,$query);
        $new1=0; $wamt1=0;
        while($con=mysqli_fetch_array($exc))
        {
            $option[]=$con;
        }
        echo json_encode($option);
        mysqli_close($conn);
    }
    if(isset($_POST['interest']))
    {
        // $current_date = date('Y-m-d');
        $current_date = new DateTime();
        // $last_day_of_last_month = date('Y-m-d', strtotime('last day of previous month', strtotime($current_date)));
        $query="SELECT * FROM `invest` ORDER BY `id` ASC";
        $exc=mysqli_query($conn,$query);
        $wamt1=0;

        while($con=mysqli_fetch_array($exc))
        {
            $regdate=$con['regdate'];
            $stored_date = new DateTime($regdate);
            // $num_days = date_diff($stored_date, $current_date)->format('%a');
            $interval = date_diff($stored_date, $current_date);
            $days = $interval->days;

            $pday=$con['pday'];
            $wamt=$pday*$days;
            $wamt1+=$wamt;
        }
        echo json_encode($wamt1);
        mysqli_close($conn);
    }
?>

<?php   
    // $past_date = date_create('2022-04-29');
    // $current_date = date_create('2023-04-29');
    
    // // Calculate the number of days between the two dates
    // $num_days = date_diff($past_date, $current_date)->format('%a');
    if (isset($_POST['deleteid']))
    {
        echo $_POST['deleteid'];
    }             
?>