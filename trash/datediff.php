<?php include('dbcon.php');
$start=date("Y-m-01", strtotime("first day of this month"));
$end='01-01-2023';
if($end=='31-12-2022'){ $end='30-12-2022';}
// echo $start; echo '</br>';
echo $end;
echo '</br>';


function date_diff1($start,$end)
{
    $diff=strtotime($start)-strtotime($end);
    //echo $diff;
    $days=abs(round($diff/86400));
    if($days==0)
    {
      return $days;
    }
    else
    {
      return $days;
    }
    
}

   $regdate='30-12-2022';
    echo $regdate;echo '</br>';
    
    $days=date_diff1($end,$regdate);
    echo $days;



     // echo $today=date("d-m-Y");echo '</br>';
    
    // $i_days=date_diff1($today,$regdate);
    // echo $i_days;echo '</br>';
    // echo '</br>';
    // echo '</br>';
    // echo '</br>';
    // $srch_date=date_diff1($today,$start);
    // echo $srch_date;echo '</br>';

    
    
?>