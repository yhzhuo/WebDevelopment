<?php
	require_once('../global.php');
	require_once('cate_function.php');
	self_linkmysql();
	$id = $_GET['cl_id'];
	changeTodayCount($id);
	echo "finish";
?>