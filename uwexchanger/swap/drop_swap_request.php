<?php
//phpparts/drop_swap_request.php?requestType="+requestType+"&content="+finalSend+"&uid="+uid
	require_once('../phpparts/global_function.php');
	self_linkmysql();
	$requestType = $_GET['requestType'];
	$uid = $_GET['uid'];
	$alter = $_GET['content'];
	if(requestType == "dont") {
		$requestType = "exchange";
	}
	$query = "update swap_requestlist set ".$requestType." = '".$alter."' where uid = $uid limit 1";
	if(mysql_query($query)) {
		echo "ok";
	} else {
		echo "failed";
	}
?>