<?php
require_once('phpparts/global_function.php');
self_linkmysql();
$get = $_POST['getInfo'];
$que = mysql_query("select * from up");     //mysql_query("insert into up (info) values ('$get')");
$fetch = mysql_fetch_array($que);
while($fetch) {
	echo "<pre>";
	echo "
";
	echo $fetch[info];
	echo "
";
	echo "</pre>"
	echo "
";
	echo "<p></p>";
	echo "
";
}
?>
