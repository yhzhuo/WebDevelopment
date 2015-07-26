<?php
	if(array_key_exists('email',$_COOKIE)) {
		include('swap/swap_main.htm');
	} else {
		//echo $_COOKIE[username]."<br>".$_COOKIE[uid]."<br>".$_COOKIE[email]."<br>".$_COOKIE[password]."<br>";
		header("location: newin.php");
	}
	
/*
 * 
	echo "this is swap page<br>";
	echo $_COOKIE[username]."<br>".$_COOKIE[uid]."<br>".$_COOKIE[email]."<br>".$_COOKIE[password]."<br>";
	if($_COOKIE[username]) {
		echo "exist";
	} else {
		echo "no";
	}
	*/

	/*
	setcookie("username","",time()-10);
	setcookie("uid","",time()-10);
	setcookie("email","",time()-10);
	setcookie("password","",time()-10);
	*/
	
	

?>