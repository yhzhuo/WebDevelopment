<?php
	//@$_GET['cl_cateName'], $_GET['cl_begin'], $_GET['cl_sortBy'];
	require_once('../global.php');
	self_linkmysql();
	$cateName = $_GET['cl_cateName'];
	$begin = $_GET['cl_begin'];
	$sortBy = $_GET['cl_sortBy'];
	if($sortBy == "alphabet") {
		$orderBy = "class_name";
	} elseif($sortBy == "createTime") {
		$orderBy = "create_date";
	} else {
		$orderBy = "concat(last_use_date, statistic)";
	}
	$q = "select * from class_list where cate_name = '".$cateName."', order by ".$orderBy." desc, limit ".$begin.",200";
	$query = mysql_query($q);
	//$query = mysql_query("select * from class_list where cate_name = '$cateName', order by concat(last_use_date, statistic) desc, limit 0,200");   //use this to not list too much
	$count = 0; $output = "";
	while($f = mysql_fetch_array($query)) {
		$output .= $f[id].";".$f[class_name]."|";
		$count++;
	}
	if($count == 0) {
		echo "empty";
	} else {
		echo $output;
	}
?>