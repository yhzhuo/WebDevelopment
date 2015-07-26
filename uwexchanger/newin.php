<?php
	if(array_key_exists('uid',$_COOKIE)) {
		echo "<script language='javascript'>alert('You have already registered');window.location.href='swap.php';</script>";
	} else {
		include('newin/newin.htm');
	}
?>