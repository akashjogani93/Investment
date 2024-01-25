<?php
include("dbcon.php");

if(isset($_POST["query"]))
{
	$term = $_POST[ "query" ];
	$output = '';
	$sql = "SELECT `cid`,`full` FROM `register` where `full` LIKE '%".$term."%'";
	//$sql ="select * from `resister`";
	$result = $conn->query($sql);
	$output = '<ul class="list-unstyled">';
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc())
		{
			$name=$row['full'];
			$cid=$row['cid'];
			$j = strlen($term);	
				for ($i = 0; $i < $j; $i++) {
					if(strcasecmp($name[$i],$term[$i])==0)
					   {
						$string3="true";
					   }else{
						   $string3="true";
						   break;
					   }
				}
				if($string3=="true")
				{
					$output .='<li id="lii" data-cid="'.$cid.'">'.$name.'</li>';
				}
		   
		} 
	}
	else 
	{
		//echo "0 results";
		 $output .= '<li>"data not found"</li>';
	}
	$output .='</ul>';
	echo $output;
	
	$conn->close();
}


if(isset($_POST['queryformcid']))
{
	$term = $_POST[ "queryformcid" ];
	$sql = "SELECT `cid`,`full` FROM `register` where `cid`='$term' ";
	//$sql ="select * from `resister`";
	$result = $conn->query($sql);
	$name='0';
	// $output = '<ul class="list-unstyled">';
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc())
		{
			$name=$row['full'];
			$cid=$row['cid'];
			// $j = strlen($term);	
			// 	for ($i = 0; $i < $j; $i++) {
			// 		if(strcasecmp($name[$i],$term[$i])==0)
			// 		   {
			// 			$string3="true";
			// 		   }else{
			// 			   $string3="true";
			// 			   break;
			// 		   }
			// 	}
			// 	if($string3=="true")
			// 	{
			// 		$output .='<li id="lii" data-cid="'.$cid.'">'.$name.'</li>';
			// 	}
		   
		} 
	}
	echo trim($name);
}
?>