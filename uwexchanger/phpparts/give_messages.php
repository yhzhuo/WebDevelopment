<?php
	include_once('global_function.php');
	self_linkmysql();
	$groupId = $_GET['groupId'];
	$auto = $_GET['auto'];
	$query = mysql_query("select content,auto from sj_messages where groupId = '$groupId' && auto > '$auto' order by auto desc limit 0,10");       //if user hope to see more than 10 messages, he or she should press the button such as "view records"
	while($content = mysql_fetch_array($query)) {    //may have errors here
		echo $content[content]."`".$content[auto]."`";
	}
?>