<?php include('../dbcon.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
?>

<?php
class Main{
    public function fetchData($limit, $std,$newCurrentMonth,$cid,$fromdate,$todate,$conn) 
    {
        $limit=$_POST["limit"];
        $std=$_POST["start"];
        $cid=$_POST["cid"];
        $newCurrentMonth=$_POST["newCurrentMonth"];
        $customerData = array();

        if($newCurrentMonth=='datesearch')
        {
           $start=date("Y-m-d", strtotime($_POST["fromdate"]));
           $end=date("Y-m-d", strtotime($_POST["todate"]));
        }else
        {
            $start=date("Y-m-01", strtotime("first day of this month"));
            $end=date("Y-m-d");
        }

        if(date("d", strtotime($end))=="31"){ $end=date("Y-m-30");}
        $today=date("d-m-Y");
        $srch_date=$this->date_diff1($start,$today);

        if($newCurrentMonth=='searchName')
        {
            $sql = "SELECT * FROM `register` WHERE `cid`='$cid'";
        }else
        {
            $sql = "SELECT * FROM `register` WHERE `cid` ORDER BY `cid` ASC LIMIT $std, $limit";
        }   

        $confirm_query=mysqli_query($conn,$sql) or die(mysqli_error());
        $num= mysqli_num_rows($confirm_query);
        $i=0;
        while($row=mysqli_fetch_array($confirm_query))
        {
            $cid=$row['cid'];
            $name=$row['full'];
            $bank=$row['bank'];
            $acc=$row['account'];
            $ifsc=$row['ifsc'];
            $pan=$row['pan'];
            $pay=$this->payment_Calculation($conn,$cid,$name,$start,$end,$srch_date);
            // $pay=10;
            if($pay>0)
            {
                $a=round($pay*15/100);
                    $c=$pay-$a;
                // $customerData[] = array(
                //     'custId' => $row['cid'],
                //     'fullName' => $row['full'],
                //     'amount' =>round($pay),
                //     'diduct' =>round($a),
                //     'currentPayment' =>round($c),
                //     'bankName' => $row['bank'],
                //     'accountNo' => $row['account'],
                //     'ifscCode' => $row['ifsc'],
                //     'panCardNumber' => $row['pan'],
                //     'date' =>date("d-m-Y",strtotime($end)),
                // );
                ?>
                    <tr>
                        <td><?php echo $row['cid'];?></td>
                        <td><?php echo $row['full']; ?></td>
                        <td><?php echo round($pay); ?></td>
                        <td><?php echo round($a); ?></td>
                        <td><?php echo round($c); ?></td>
                        <td><?php echo $row['bank']; ?></td>
                        <td><?php echo $row['account']; ?></td>
                        <td><?php echo $row['ifsc']; ?></td>
                        <td><?php echo $row['pan']; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($end)); ?></td>
                    </tr>
                <?php
            }
        }
        // header('Content-Type: application/json');
        // echo json_encode($customerData);
    }

    private function date_diff1($invest_date,$today)
    {
        if((date("m", strtotime($today))=="02") && (date("d", strtotime($today))>"27")&& (date("d", strtotime($today))<"30"))
        {
            $today = date("Y-m-30", strtotime($today));
        }
        $diff=strtotime($invest_date)-strtotime($today);
        $days=abs(round($diff/86400));
        if($days==0)
        {
          return $days;
        }
        else
        {
          return $days+1;
        }
    }
    private function payment_Calculation($conn,$cid,$nameFull,$start,$end,$srch_date)
    {
        $today=date("d-m-Y");
        $total=$total1=0;
        $query = "SELECT 
                        `invest`.`id` AS `id`,
                        `invest`.`regdate` AS `date`,
                        `invest`.`invest` AS `invest`,
                        `invest`.`asign` AS `asign`,
                      CASE
                      WHEN MONTH('$end') = 2 AND DAY('$end') > 27 AND DAY('$end') < 30 THEN DATEDIFF('$end', CONCAT(YEAR('$end'), '-02-30'))
                      ELSE DATEDIFF('$end', `invest`.`regdate`)
                      END + 1 AS `i_days`,
                      COALESCE(`widraw`.`wamt`, 0) AS `w_value`
                    FROM
                      `invest`
                    LEFT JOIN
                      `widraw` ON `invest`.`id` = `widraw`.`inv_id` AND `widraw`.`wdate` > '$end'
                    WHERE 
                      `invest`.`regdate` <= '$end' AND 
                      `invest`.`cid` = '$cid'";
            $confirm = mysqli_query($conn,$query) or die(mysqli_error());
            $result = mysqli_num_rows($confirm);
            if($result==0)
            {
                $total=0;
            }
            else
            { 
                while($out=mysqli_fetch_array($confirm))
                { 
                    $id=$out['id'];
                    $w_value=$out['w_value'];
                    $amt=$out['invest']+$w_value;
                    $perc=$out['asign'];
                    $invest_date=$out['date'];
                    $i_days=$out['i_days'];
                    $days=$this->fetch_Calculate($i_days,$srch_date,$amt,$perc);
                    $total=$total+$days;
                } 
            }
            $query1 = "SELECT 
                          `referal`.`id` AS `id`,
                          -- `invest`.`i_id` AS `id`,
                          `invest`.`regdate` AS `date`,
                          `invest`.`invest` AS `invest`,
                          `referal`.`refasign` as `refasign`,
                          CASE
                              WHEN MONTH('$end') = 2 AND DAY('$end') > 27 AND DAY('$end') < 30 THEN DATEDIFF('$end', CONCAT(YEAR('$end'), '-02-30'))
                              ELSE DATEDIFF('$end', `invest`.`regdate`)
                          END + 1 AS `i_days`,
                          COALESCE(`widraw`.`wamt`, 0) AS `w_value`
                      FROM 
                          `referal`
                      JOIN
                        `invest` ON `invest`.`id` = `referal`.`id`
                      LEFT JOIN
                          `widraw` ON `invest`.`id` = `widraw`.`inv_id` AND `widraw`.`wdate` > '$end'
                      WHERE 
                          `invest`.`regdate` <= '$end' AND 
                          `referal`.`r_name` = '$nameFull'";
    
            $confirm = mysqli_query($conn,$query1) or die(mysqli_error());
            if(mysqli_num_rows($confirm)>0)
            {
             while($out=mysqli_fetch_array($confirm))
               {   
                       $i_id=$out['id'];
                    $w_value=$out['w_value'];
    
                    $amt=$out['invest']+$w_value;
                    $perc=$out['refasign'];
                  $i_days=$out['i_days'];
              $days=$this->fetch_Calculate($i_days,$srch_date,$amt,$perc);
                    $total1=$total1+$days;
                }
            }else
            {
                $total1=0;
            }
            return round($total+$total1);
    }

    private function fetch_Calculate($i_days,$srch_date,$amt,$perc)
    {
      if($i_days>$srch_date)
      {
         $days=$srch_date;
      }else
      {
         $days=$i_days;
      }
      $day_amt=(($amt*$perc/100)/30);
      return $month_intres=$day_amt*$days;
    }
}
$mainInstance = new Main();



        
// Get the parameters from the AJAX request
if(isset($_POST['limit']) && isset($_POST['start']) && isset($_POST['newCurrentMonth']) && isset($_POST['cid']) && isset($_POST['todate']) && isset($_POST['fromdate']))
{
    $limit = isset($_POST['limit']);
    $start = isset($_POST['start']);
    $fromdate = isset($_POST['fromdate']);
    $todate = isset($_POST['todate']);
    $cid = isset($_POST['cid']);
    $newCurrentMonth = isset($_POST['newCurrentMonth']);
    $mainInstance->fetchData($limit, $start,$newCurrentMonth,$cid,$fromdate,$todate,$conn);
}

// Close the database connection
mysqli_close($conn);
?>