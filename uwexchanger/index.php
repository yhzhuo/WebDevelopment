<?php
	if(array_key_exists('uid',$_COOKIE)) {
		header("location: swap.php");
	} else {
		header("location: newin.php");
	}
?>