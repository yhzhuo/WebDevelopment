<?php
	$link = mysql_connect('localhost','ninzerhd_phoenix','Dphoenix123!');
	if(!$link) {
		echo "link failed<p>";
		exit;
	} else {
		echo "link ok<p>";
	}
	$connectdb = mysql_select_db('ninzerhd_phoenix',$link);
	if($connectdb) {
		echo "connect db ok<p>";
	} else {
		echo "connect db failed<p>";
	}
	$que='set names "gbk"';
	mysql_query($que);    
	$que = mysql_query("insert into test (avarchar,atext,adouble,aint) values ('testvarchar','testtext','775.8258','7758258')");
	if($que) {
		echo "insert ok";
	} else {
		echo "insert failed";
	}
	echo "<p>new";

//insert into test (varchar,text,double,int) values ('testvarchar','testtext','775.8258','7758258')
?>