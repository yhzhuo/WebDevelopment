<?php
	require_once('../phpparts/global_function.php');
	self_linkmysql();
	$uid = $_GET['uid'];
	$que = mysql_query("select need,exchange,content from swap_requestlist where uid = '$uid' limit 0,1");
	$f = mysql_fetch_array($que);
	echo $f[need]."|".$f[exchange].":".$f[content];
?>