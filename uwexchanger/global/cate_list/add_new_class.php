<?php
//@$_GET['cl_cateName'], $_GET['cl_newClassName']
	require_once('../global.php');
	require_once('cate_function.php');
	self_linkmysql();
	$cateName = $_GET['cl_cateName'];
	$newClassName = $_GET['cl_newClassName'];
	echo addNewClass($cateName, $newClassName);
?>