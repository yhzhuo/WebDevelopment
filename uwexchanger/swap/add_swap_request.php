<?php    
//"phpparts/add_swap_request.php?requestType="+requestType+"&content="+finalSend+"&uid="+uid
	/*
	require_once('phpparts/global_function.php');
	self_linkmysql();
	$requestType = $_GET['requestType'];
	$uid = $_GET['uid'];
	$add = $_GET['content'];
	if(requestType == "dont") {
		$requestType = "exchange";
	}
	$query = "update swap_requestlist set ".$requestType." = concat(".$requestType.",'".$add."') where uid = $uid limit 1";
	if(!mysql_query($query)) {
		echo "failed";
		exit;
	}
	$query = "select $requestType from swap_requestlist where uid = $uid limit 0,1";
	$fetch = mysql_fetch_array(mysql_query($query));
	if($fetch) {
		echo $fetch[$requestType];
	} else {
		echo "failed";
	}
	*/
	
	
	
	require_once('../phpparts/global_function.php');
	self_linkmysql();
	$uid = $_GET['uid'];
	$need = $_GET['need'];
	$exchange = $_GET['exchange'];
	$query = "update swap_requestlist set need = concat(need,'".$need."') where uid = ".$uid." limit 1";
	if(!mysql_query($query)) {
		echo "failed";
		exit;
	}
	$query = "update swap_requestlist set exchange = concat(exchange,'".$exchange."') where uid = ".$uid." limit 1";
	if(!mysql_query($query)) {
		echo "failed";
		exit;
	}
	$query = "select need,exchange from swap_requestlist where uid = ".$uid." limit 0,1";
	$fetch = mysql_fetch_array(mysql_query($query));
	if($fetch) {
		echo $fetch[need]."|".$fetch[exchange];
	} else {
		echo "failed";
	}
?>