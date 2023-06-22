<?php
$start=date("Y-m-01", strtotime("first day of this month"));
$end=date("Y-m-d");
echo date_diff1($start,$end);
function date_diff1($start,$end)
{
    $diff=strtotime($start)-strtotime($end);
    //echo $diff;
    $days=abs(round($diff/86400));
    return $days;
    // if($days==0)
    // {
    // return $days;
    // }
    // else
    // {
    // return $days;
    // }
}
?>