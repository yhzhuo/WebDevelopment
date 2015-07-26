<?php   //get_match.php @need, @dont
	$need = $_GET['need'];
	$dont = $_GET['dont'];
	if(strpos($need,';') === false) {
		$need = "";
	}
	if(strpos($dont,';') === false) {
		$dont = "";
	}
	if($need == "" && $dont == "") {
		echo "No more";
	} else {
		require_once('../phpparts/global_function.php');
		self_linkmysql();
		$que = "select need, exchange from swap_requestlist where ";
		if($dont != "") {
			$que .= "need like '%".$dont."%' ";
		}
		if($need != "" && $dont != "") {
			$que .= "or ";
		}
		if($need != "") {
			$que .= "exchange like '%".$need."%' order by requestTime desc limit 0,20";
		}
		$q = mysql_query($que);
		$output = "";
		while($f = mysql_fetch_row($q)) {
			foreach($f as $v) {
				$output .= $v."|";
			}
			$output .= "*";
		}
		if($output == "") {
			$output = "No more";
		}
		echo $output;
	}
?>