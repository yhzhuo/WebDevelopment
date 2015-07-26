<?php
require_once('../phpparts/global_function.php');
self_linkmysql();
/*
$need = $_GET['need'];
$exchange = $_GET['exchange'];
$uid = $_GET['uid'];
*/
$total = $_GET['total'];
$total = str_replace("*","#",$total);
$total = split('[|]',$total);       //split('[%]',$arr3[love]);  
$need = $total[0];
$exchange = $total[1];
$uid = $total[2];
/*
//debug
echo "need: ".$need."<br>";
echo "exchange: ".$exchange."<br>";
echo "uid: ".$uid."<br>";

//debug
 */
//update xsnr set bjyy='$t4',nr='$t3',nrrqs='$date',gs='$gs',xsm='$xsm',zz='$zz',description='$description' where sid='$t9' && ym='$t8'
$q = "update swap_requestlist set exchange='$exchange',need='$need',requestTime=CURRENT_TIMESTAMP where uid='$uid' limit 1";      //CURRENT_TIMESTAMP
//echo $q;
//exit;
$query = mysql_query($q);
if($query) {
	setAction($uid,"changeCoursesInto: "."need: ".$need." exchange: ".$exchange);
	echo "ok";
} else {
	echo "failed";
}
?>