<?php
//ajax_checkEmailValid.php
require_once('../global.php');
self_forbidIllegalVisit("email");
$email = $_GET['email'];
if(count(split('[@]',$email)) == 1) {
		$email .= '@uw.edu';
}
self_linkmysql();
$query = mysql_query("select uid from userinfo where email='$email'");
if(!$query) {
	echo "failed";
}
if(mysql_fetch_array($query)) {
	echo "no";
} else {
	echo "ok";
}
?>