<?php
/*
	require_once('global.php');
	self_linkmysql();
	$r = mysql_query("show tables");
	while($row = mysql_fetch_array($r)) {
		$tableName = $row[0]."";
		echo $tableName."<p>"."======"."<p>";
		$a = "select * from ".$tableName;
		$getData = mysql_query($a);
		while($fetchData = mysql_fetch_array($getData)) {
			$output = 'insert into '.$tableName.' ';
			$colPart = "(";
			$valPart = "(";
			foreach($fetchData as $colName => $value) {
				if(!is_int($colName)) {
					$acolName = $colName."";
					$avalue = $value."";
					$colPart .= $acolName.",";
					$valPart .= '"'.$avalue.'"'.",";
				}
			}
			//two lines below may have problems
			$colPart = substr_replace($colPart,")",strlen($colPart)-1);
			$valPart = substr_replace($valPart,")",strlen($valPart)-1);
			$output .= $colPart." values ".$valPart.";<br>";
			echo $output;
		}
	}
	/*
	 * $result = mysql_query("SHOW TABLES"); 
while($row = mysql_fetch_array($result)) 
	 */



	require_once('global.php');
	self_linkmysql();
	set_time_limit(0);

	/*
	foreach($a as $v) {
		echo $v."<br>";
	}
	*/
	
	//$r = mysql_query("show tables");
	
	
	
	
	
/*	
	$tables[0] = "pw_members";
	$tables[1] = "sj_groups";
	$tables[2] = "xs_liuyan";
	$tables[3] = "swap_requestlist";
	$tables[5] = "userinfo";
	$tables[6] = "xsnr";
	$tables[7] = "xspl";
	$tables[8] = "xssx";
	$tables[9] = "xs_action";
	$tables[10] = "xs_banip";
	$tables[11] = "xs_countvisit";
	$tables[12] = "xs_fs";
	$tables[13] = "xs_hotwords";
	$tables[14] = "xs_hy";
	$t2 = Array();
	$a = mysql_list_tables("bdm0120195_db");
	while($b = mysql_fetch_row($a)) {
		if(!in_array($b[0],$tables))
			array_push($t2,$b[0]);
	} 
	
	foreach($t2 as $atable) {
		$tableName = $atable;
		echo $tableName."<p>"."======"."<p>";
		$a = "select * from ".$tableName;
		$getData = mysql_query($a);
		while($fetchData = mysql_fetch_array($getData)) {
			$output = 'insert into '.$tableName.' ';
			$colPart = "(";
			$valPart = "(";
			foreach($fetchData as $colName => $value) {
				if(!is_int($colName)) {
					$acolName = $colName."";
					$avalue = $value."";
					$colPart .= $acolName.",";
					$valPart .= '"'.$avalue.'"'.",";
				}
			}
			//two lines below may have problems
			$colPart = substr_replace($colPart,")",strlen($colPart)-1);
			$valPart = substr_replace($valPart,")",strlen($valPart)-1);
			$output .= $colPart." values ".$valPart.";<br>";
			echo $output;
		}
	}
	*/
	
	
	
	
	$tables[0] = "pw_members";
	$tables[1] = "sj_groups";
	$tables[2] = "xs_liuyan";
	$tables[3] = "swap_requestlist";
	$tables[5] = "userinfo";
	$tables[6] = "xsnr";
	$tables[7] = "xspl";
	$tables[8] = "xssx";
	$tables[9] = "xs_action";
	$tables[10] = "xs_banip";
	$tables[11] = "xs_countvisit";
	$tables[12] = "xs_fs";
	$tables[13] = "xs_hotwords";
	$tables[14] = "xs_hy";
	$count = 0;
	$a = mysql_list_tables("bdm0120195_db");
	/*
	$a = $tables;
	array_push($a,"pw_memberinfo");
	*/
	while($b = mysql_fetch_row($a)) {
		if(!in_array($b[0],$tables)) {
			$que = "select count(*) from ".$b[0];
			echo "<hr />".$b[0]."<hr />";
			$f = mysql_fetch_row(mysql_query($que));
			$count += $f[0];
		}
	} 
	$nque = "select count(*) from swap_requestlist";
	$fetch = mysql_fetch_row(mysql_query($nque));
	echo $count+$fetch[0];
?>