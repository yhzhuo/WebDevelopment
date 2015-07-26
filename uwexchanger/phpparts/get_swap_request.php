<?php
	require_once('global_function.php');
	self_linkmysql();
	$need = $_GET['reneed'];
	$exchange = $_GET['exchange'];
	$page = $_GET['page'];
	$autos = $_GET['autos'];
	$autos = split('[;]',$autos);
	$need = split('[#]',$need);
	$exchange = split('[#]',$exchange);
	$total = 0;   //total less than 20
	$sql = "select * from swap_requestList where (";
	$count = count($need);
	foreach($need as $i => $v) {
		if($i < $count - 1) {
			$sql .= "exchange like '%".$v."%' || ";  //test this sql, may have problems
		} else {
			$sql .= "exchange like '%".$v."%')";
		}
	}
	$sql .= " && (";    //remember to test the output first
	$count = count($exchange);
	foreach($exchange as $i => $v) {
		if($i < $count - 1) {
			$sql .= "need like '%".$v."%' || ";  //test this sql, may have problems
		} else {
			$sql .= "need like '%".$v."%')";
		}
	}
	
	$selectStart = ($page - 1) * 5;
	$sql .= " order by auto desc limit ".$selectStart.",20";
	$query = mysql_query($sql);
	//then fetch it, pass information to js in client, the js judge if it changes, yes, print new list, no, do nothing
	$numResult = mysql_num_rows($query);
	$output = "";
	$bigLoop = 0;
	while($fetch = mysql_fetch_array($query)) {
		//
		if(in_array($fetch[auto],$autos)) {
			$output .= $fetch[auto];
		} else {
			$count = count($fetch);
			$i = 0;
			foreach($fetch as $v) {
				if($i < $count-1) {
					$output .= $v.";";
				} else {
					$output .= $v;
				}
			$i++;
			}
		}
		//
		if($bigLoop < $numResult-1) {
			$output .= "#";
		}
		$bigLoop++;
	}
	echo $output;
	/*
	$result = Array();
	while($fetch = mysql_fetch_array($query)) {
		$result[count($result)] = $fetch;   //may have problems
	}
	*/
	
	/*
	$result = Array();
	foreach($need as $v1) {
		$needIndex = count($result);
		$result[$needIndex] = Array();
		foreach($exchange as $v2) {
			$q = mysql_query("select * from swap_requestList where exchange = '$v1' and need = '$v2' order by auto limit 0,5");
			//$total = $total + count $q;
			$temp = Array();
			while($r = mysql_fetch_array($q)) {
				$temp[count($temp)] = $r;
			}
			$result[$needIndex][count($result[$needIndex])] = $temp;
			if($total >= 20) {
				break 2;   //may has problem here.
			}
		}
	}
	//$q = mysql_query("select * from swap_requestList where ");
	 * /
	 */
?>