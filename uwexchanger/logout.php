<?php
	if(!array_key_exists('uid',$_COOKIE)) {
		echo "<script language='javascript'>alert('Please don't attact our website!!!')</script>";
		exit;
	}
	require_once('global.php');
	self_linkmysql();
	setAction($_COOKIE[uid],"logout");
	setcookie("username","",time()-10000);
	setcookie("uid","",time()-10000);
	setcookie("email","",time()-10000);
	setcookie("password","",time()-10000);
	header("location: login.php");
?>