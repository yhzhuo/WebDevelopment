<?php
//ret: void
function changeTodayCount($id) {
	$q = mysql_query("select * from class_list where id='$id' limit = 1'");
	$fetch = mysql_fetch_array($q);
	if($fetch[last_use_date] == date("Y-m-d")) {        //may have problems here
		$fetch[t_count]++;
		mysql_query("update class_list set t_count = '$fetch[t_count]' where id = '$id'");  //may have problems here for the sql syntax
	} else {
		$daysToToday = daysToToday($fetch[last_use_date]);
		if($daysToToday == 1) {
			$y_count = $fetch[t_count];
			$statAdd = "+".$fetch[y_count];
		} else {
			$y_count = 0;
			$statAdd = "+".$fetch[t_count]."+".$fetch[y_count];
			for($i = 0; $i < $daysToToday - 1; $i++) {
				$statAdd = "+"."0".$statAdd;      //for stat, more close to today, more close to front
			}
		}
		mysql_query("update class_list set t_count = 1, y_count = '$y_count', last_use_date = CURDATE( ), statistic = concat('$statAdd',statistic), where id='$fetch[id]'");  //may have problems here for the sql syntax
	}
}

//pre: add a new class of a certain category
//post: if the class is already exist, failed and return false, else add and return ture
//ret: boolean
function addNewClass($cateName, $newClassName) {
	$q = mysql_query("select * from class_list where cate_name = '$cateName' and class_name = '$newClassName' limit 0,1");
	if($q) {
		$f = mysql_fetch_array($q);
		return $f[id].";".$newClassName.";has";
	} else {
		mysql_query("insert into class_list (cate_name, class_name,creat_date, last_use_date, y_count,t_count) values ('$cateName','$newClassName',CURDATE( ), '0000-00-00' '0', '0')");
		$id = mysql_insert_id();
		return $id.";".$newClassName;
	}
	/*
	if(mysql_query("insert into class_list (cate_name, class_name,creat_date, last_use_date, y_count,t_count) values ('$cateName','$newClassName',CURDATE( ), '0000-00-00' '0', '0')")) {
		$id = mysql_insert_id();
		return $id.";".$newClassName;
	} else {
		return "failed";
	}
	*/
}
?>