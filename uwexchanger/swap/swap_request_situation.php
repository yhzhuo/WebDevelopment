<?php
	require_once('../phpparts/global_function.php');
	self_linkmysql();
	$situation = $_GET['content'];
	$uid = $_GET['uid'];
	$q = "update swap_requestlist set content = '$situation',requestTime=CURRENT_TIMESTAMP where uid = '$uid' limit 1";
	if(mysql_query($q)) {
		$action = "changeSituationInto: ".$situation;
		setAction($uid,$action);
		echo "ok";
	} else {
		echo "failed";
	}
?>