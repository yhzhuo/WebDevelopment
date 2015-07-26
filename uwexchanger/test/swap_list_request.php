<?php
	require_once('../phpparts/global_function.php');
	self_linkmysql();
	/*
	$need = $_GET['need'];                   //remember to use certain inputs to test this program
	$exchange = $_GET['dont'];
	$page = $_GET['page'];
	$uid = $_GET['uid'];
	 */
	/*
	$need = "IDE;049;FE;*EFSE;547;*";
	$exchange = "GRY;495;*";
	//$need = "";
	//$exchange = "";
	$page = 1;
	$uid = 15;
	
	
	$need = str_replace("*","#",$need);
	$exchange = str_replace("*","#",$exchange);
	*/
	//$page = $_GET['page'];     //this should be the real used manipulation
	$uid = $_GET['uid'];
	$numPrimary = $_GET['numPrimary'];
	$numSecondary = $_GET['numSecondary'];
	$query = mysql_query("select need,exchange from swap_requestlist where uid=$uid limit 1");
	$f = mysql_fetch_array($query);
	if(!$f) {
		echo "failed";
		exit;
	}
	$need = $f[need];
	$exchange = $f[exchange];
	
	
	
	$need = split('[#]',$need);      //split('[|]',$total);
	$exchange = split('[#]',$exchange);
	array_pop($need);
	array_pop($exchange);
	//begin to create the query sentence
	$counte = count($exchange);
	$countn = count($need);
	if($counte == 0 && $countn == 0) {
		echo "No more";
		exit;
	}
	$sql = "select * from swap_requestlist where ((";
	
	if($countn != 0) {
		foreach($need as $i => $v) {
			if($i < $countn - 1) {
				$sql .= "exchange like '%".$v."%' || ";  //test this sql, may have problems
			} else {
				$sql .= "exchange like '%".$v."%')";
			}
		}
	}
	
	if($countn != 0 && $counte != 0) {
		$sql .= " && (";    //remember to test the output first
	}
	

	if($counte != 0) {
		foreach($exchange as $i => $v) {
			if($i < $counte - 1) {
				$sql .= "need like '%".$v."%' || ";  //test this sql, may have problems
			} else {
				$sql .= "need like '%".$v."%')";
			}
		}
	}
	
	//$selectStart = ($page - 1) * 5;
	$sql .= ") && uid != ".$uid." order by requestTime desc limit -selectStart-,-lines-";     //may have problems here    -selectStart-   -lines-
	//echo $sql;
	$query = $sql;
	//$h = mysql_num_rows($j);
	
	//finish
	/*
	$query = mysql_query($sql);
	if(!$query) {
		echo "failed";
		exit;
	}
	
	
	$numResult = mysql_num_rows($query);       //get number of result
	*/
	$numResultRows = 0;
	if($numSecondary == 0) {   //search the both condition
		$query = str_replace("-selectStart-",$numPrimary*20,$query);
		$query = str_replace("-lines-","20",$query);
		$quePrimary = mysql_query($query);
		$numResultRows += mysql_num_rows($quePrimary);
	}
	$query = $sql;
	if($numSecondary != 0 || $numResultRows < 20) {     //This part only do the single condition
		$query = str_replace(") && (",") xor (",$query);
		//echo "<p>2"."<p>";
		//echo "numSecondary: ".$numSecondary;
		if($numSecondary != 0) {     //all results are secondary
			$query = str_replace("-selectStart-",$numSecondary*20,$query);
			$query = str_replace("-lines-","20",$query);
			//echo "<hr />".$query."<hr />";  //
		} else {   //$numResultRows < 20. here $numSecondary != 0 || $numResultRows < 20 are exclusive, becuuse if $numResultRows < 20, we haven't touch the secondary case, so the $numSecondary != 0
			$query = str_replace("-selectStart-","0",$query);
			$query = str_replace("-lines-",20-$numResultRows,$query);   //may have problems here
		}
		//echo "<hr />".$query."<hr />";
		$queSecondary = mysql_query($query);
	}
	$output = "";
	$fetch = mysql_fetch_row($quePrimary);
	while($fetch) {
		$que = "select username from userinfo where uid='".$fetch[1]."'";
		$qname = mysql_query($que);
		$fname = mysql_fetch_array($qname);
		foreach($fetch as $v) {
			$output .= $v."|";
		}
		$output .= $fname[username]."|1|"."*";
		$fetch = mysql_fetch_row($quePrimary);
	}
	
	
	if($numSecondary != 0 || $numResultRows < 20) {
		$fetch = mysql_fetch_row($queSecondary);
		while($fetch) {
			$que = "select username from userinfo where uid='".$fetch[1]."'";
			$qname = mysql_query($que);
			$fname = mysql_fetch_array($qname);
			foreach($fetch as $v) {
				$output .= $v."|";
			}
			$output .= $fname[username]."|0|"."*";
			$fetch = mysql_fetch_row($queSecondary);
		}
	}
	echo $output;
	
	
	
	
	/*
	
	//begin to generate output
	$fetch = mysql_fetch_row($query);

	$output = "";
	while($fetch) {
		$que = "select username from userinfo where uid='".$fetch[1]."'";
		$qname = mysql_query($que);
		$fname = mysql_fetch_array($qname);
		foreach($fetch as $v) {
			$output .= $v."|";
		}
		$output .= $fname[username]."|"."*";                  //by using this kind of stategy, remember that there is still a one more s
		$fetch = mysql_fetch_row($query);
	}
	//echo "first output: ".$output."<hr />";    //debug
	
	if($numResult < 20 && ($countn != 0 && $counte != 0)) {
		$sql = str_replace(") && (",") xor (",$sql);
		$sql = str_replace(",20",",".(20-$numResult),$sql);
		$query2 = mysql_query($sql);
		if(!$query2) {
			echo "failed";
			exit;
		}
		$fetch = mysql_fetch_row($query2);
		while($fetch) {
			$qname = mysql_query("select username from userinfo where uid='$fetch[1]'");
			$fname = mysql_fetch_array($qname);
			foreach($fetch as $v) {
				$output .= $v."|";
			}
			$output .= $fname[username]."|"."*";                  //by using this kind of stategy, remember that there is still a one more s
			$fetch = mysql_fetch_row($query2);
		}
	}
	if($output == "") {
		echo "No more";
		exit;
	}
	
	/*
	if($numResult < 20 && ($countn != 0 && $counte != 0) && $numResult != 0) {
		$sql = str_replace(") && (",") || (",$sql);
		$sql = str_replace(",20",",".(20-$numResult),$sql);
		$query = mysql_query($sql);
		if(!$query) {
			echo "failed";
			exit;
		}
		$fetch = mysql_fetch_array($query);
		while($fetch) {
			$qname = mysql_query("select username from userinfo where uid='$fetch[uid]'");
			$fname = mysql_fetch_array($qname);
			foreach($fetch as $v) {
				$output .= $v."|";
			}
			$output .= $fname[username]."|"."*";                  //by using this kind of stategy, remember that there is still a one more s
			$fetch = mysql_fetch_array($query);
		}
	}
	
	
	*/
	
	
	
	
	/*
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
	*/
	
	//echo $output;
	
?>