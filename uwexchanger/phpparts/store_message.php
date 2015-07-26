<?php
	include_once('global_function.php');
	self_linkmysql();
	$groupId = $_GET['groupId'];
	$senderId = $_GET['senderId'];
	$content = $_GET['content'];
	$reply = $_GET['reply'];
	//$sreply = split('[;]',$reply);
	$aida = $_GET['aida'];
	//$saida = split('[;]',$aida);
	//remember to write update userInfo bereply and beaida column
	if(mysql_query("insert into sj_messages (groupId,content,senderId,aida,reply) values ('$groupId','$content','$senderId','aida','reply')")) {
		echo "ok";
	} else {
		echo "error";
	}
?>