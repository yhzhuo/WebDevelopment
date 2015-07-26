<?php
	if(array_key_exists('wave',$_GET)) {
		$wave = $_GET['wave'];
		require_once('global.php');
		self_linkmysql();
		mysql_query("insert into ad (wave) values ('$wave')");
	}
	include_once('instruction/instruction.htm');
?>