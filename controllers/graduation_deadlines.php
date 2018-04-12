<?php
  include("../includes/connection.php");

	// Get Graduation Deadlines
	$sql = "SELECT * FROM graduation_deadlines";
  $result = mysql_query($sql);

  if(mysql_result($result, 0) != ""){
    $year = mysql_result($result, 0,'year');
    $semester = mysql_result($result, 0,'semester');
    $grad_date = mysql_result($result, 0,'grad_date');
    $order_deadline = mysql_result($result, 0,'order_deadline');
    $return_deadline = mysql_result($result, 0,'return_deadline');
    $gradsalute_week = mysql_result($result, 0,'gradsalute_week');
    $grad_week = mysql_result($result, 0,'grad_week');
		$grad_deadline = mysql_result($result, 0,'grad_deadline');
		$gradsalute1_date = mysql_result($result, 0,'gradsalute1_date');
		$gradsalute2_date = mysql_result($result, 0,'gradsalute2_date');
		$dept_deadline = mysql_result($result, 0,'dept_deadline');
		$homeship = mysql_result($result, 0,'homeship');
		$homeship2 = mysql_result($result, 0,'homeship2');
		$grad_law_date = mysql_result($result, 0,'grad_law_date');
		$comm_term = mysql_result($result, 0,'comm_term');
  }



	// Current Term
	if (date(m) >= '7') {
		$current_term1 = "9";
	} else {$current_term1 = "3"; }
	$current_term = "1"."".date(y)."".$current_term1;


	// Last Term
	if ($current_term1 = "3") {
		$last_term1 = "9";
		$last_year = date(y) - 1;
	} else {
		$last_term1 = "3";
		$last_year = date(y);
	}

	$last_term = "1"."".$last_year."".$last_term1;


	// Get Semester
	$current_year = Date("Y");

  if($current_term1 = "3"){
	  $current_semester="Spring";
  } else {
		$current_semester="Fall";
	}



	$grad_law_date = date("F j",strtotime($grad_law_date));
  $grad_deadline = date("F j",strtotime($grad_deadline));
	$gradsalute1_date = date("F j",strtotime($gradsalute1_date));
	$gradsalute2_date = date("j",strtotime($gradsalute2_date));
	$dept_deadline = date("F j",strtotime($dept_deadline));
	$order_deadline = date("F j",strtotime($order_deadline));
	$homeship = date("F j",strtotime($homeship));
	$homeship2 = date("F j",strtotime($homeship2));
	$grad_date = date("F j",strtotime($grad_date));
	$return_deadline = date("F j",strtotime($return_deadline));

  $gradsalute3_date = date("j",strtotime($gradsalute1_date));
	$gradsalute3_date = $gradsalute3_date+1;
	$gradsalute4_date = date("j",strtotime($gradsalute2_date));
	$gradsalute4_date = $gradsalute2_date-1;
	$gradsalute_month = date("F",strtotime($gradsalute1_date));

	$grad_month = date("F",strtotime($grad_date));
	$grad_date5 = date("j",strtotime($grad_date));
	//$grad_date1 = $grad_date-1;
	$grad_date4 = date("j",strtotime($grad_date));
	$grad_date4 = $grad_date5-1;
	$grad_date3 = date("j",strtotime($grad_date));
	$grad_date3 = $grad_date5-2;
	$grad_date2 = date("j",strtotime($grad_date));
	$grad_date2 = $grad_date5-3;
	$grad_date1 = date("j",strtotime($grad_date));
	$grad_date1 = $grad_date5-4;
?>
