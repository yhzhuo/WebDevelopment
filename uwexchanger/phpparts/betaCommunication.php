<?php
	/*if($_GET['msg'] == "") {   //need GET['msg'] and GET['auto'] and GET['self']
		echo "";       //may have problem
		exit;
	}
	*/
	self_linkmysql();
	set_time_limit(0);         //This version is for privateCommunication
	$groupId = $_GET['groupId'];   //"," may cause some problem during "get" passing value
	$self = $_GET['self'];
	if($_GET['auto'] != "") {   //when user open a private communication screen, browser sends $groupId "user1+user2" automatically to websever
		$auto = $_GET['auto'];
		$q = mysql_query("select * from net_privatetalk where groupId = '$groupId' order by auto desc limit 0,1");//check the last one
		$f = mysql_fetch_array($q);
		while($auto == $f[auto] || $self == $f[sender]) {//while(auto == mysql_auto || sender == self)
			$q = mysql_query("select * from net_privatetalk where groupId = '$groupId' order by auto desc limit 0,1");//keep on checking the last one
			$f = mysql_fetch_array($q);
			usleep(30000);   //frequency is 0.03s/check
			clearstatcache();
		}
	} else {
		$q = mysql_query("select * from net_privatetalk where groupId = '$groupId' order by auto desc limit 0,1");
		if($q) {
			$f = mysql_fetch_array($q);
			$auto = $f[auto];
			$fauto = $f[auto];
		} else {   //never talk before
			$auto = 0;
			$fauto = 0;
		}
		while($auto == $fauto || $self == $f[sender]) {//while(auto == mysql_auto || sender == self)
			$q = mysql_query("select * from net_privatetalk where groupId = '$groupId' order by auto desc limit 0,1");//keep on checking the last one
			$f = mysql_fetch_array($q);
			$fauto = $f[auto];
			usleep(30000);   //frequency is 0.03s/check
			clearstatcache();
		}
	}
	echo $f[message].";".$f[auto].";".$f[sender];
	ob_flush();
	flush();
?>