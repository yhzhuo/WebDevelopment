<?php
//login.php
	//echo "this is login page, the comment code is not wrong, but it's the old version that need to be modified";
if(array_key_exists('uid',$_COOKIE)) {
	header("location: swap.php");
}

require_once('global.php');
self_linkmysql();
if(!$_GET['code']) {//normal login                //!array_key_exists('code',$_GET)
	//echo "1<br>";
	if(!$_POST['email']) {            //if(!$_POST['email'])                             //!array_key_exists('email',$_POST)
		//echo "3<br>";
		include('login/login.htm');
	} else { //use set cookie replace
		//echo "4<br>";
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);
		$q = mysql_query("select password,uid,username,email,valid from userinfo where email = '$email'");
		$f = mysql_fetch_array($q);
		/*
		  
		foreach($f as $i => $v) {
			echo "($i):$v<br>";
		}
		
		*/
		if($f[password] == $password) {
			//echo "6 ok, pass<br>";
			//set cookies
			if((int)$f[valid] != 1) {
				//echo "5<br> valid: ";
				//echo $f[valid];
				echo "<script language='javascript'>alert('Sorry, you have not pass your validation, please check your email');</script>";
				include('login/login.htm');
				exit;
			}
			login_setCookie($f[username],$f[uid],$f[email],$f[password]);
			//finish cookie seting
			header("location: swap.php");
			setAction($f[uid],"login");
		} else {
			//echo "7<br>";
			echo "<script language=javascript >alert('Sorry, your email or password is not correct, please try again.')</script>";
			include('login/login.htm');
		}
	}
} else {   //comfirmation
	//echo "2<br>";
	if(!$_GET['email']) {                         //!array_key_exists('email',$_GET)
		echo "forbidden!";
		exit;
	} else {
		$email = $_GET['email'];
		
		if($f[valid] != 2) {
			echo "forbidden!";
			exit;
		} else {
			$temp = $email.$webmasterCode;
			$codeHere = md5($temp);
			if($codeHere == $_GET['code']) {
				$q = mysql_query("select valid,username,password,uid,extra from userinfo where email = '$email'");
				$f = mysql_fetch_array($q);
				mysql_query("update userinfo set valid = '1' where uid = '$f[uid]'");
				login_setCookie($f[username],$f[uid],$f[email],$f[password]);
				
				/*
				$tags = split('[#]',$f[extra]);   //split('[%]',$arr3[love]);
				$steps = count($tags) - 1;      //the last element is empty, should be avoided
				$sql = "select groupName,auto from sj_groups where ";   //may have problems here
				for($i = 0; $i < $steps; $i++) {
					$sql .= "tags like %".$tags[$i]."% || "; 
				}
				$sql .= "order by num_members desc limit 0,20";
				$que = mysql_query($sql);
				$fetch = mysql_fetch_array($que);
				$total = "";   //help us get chatboards
				//$f[extra] help us get course they need
				while($fetch) {
					$total .= implode(';',$fetch).";#";
					$fetch = mysql_fetch_array($que);
				}   //implode(',',$arr);
				include('login_chooseLike.htm');
				//let user specify his or her information, include a special page
				*/
				
				header("location: swap.php");
			} else {
				mysql_query("delete from userinfo where uid = '$f[uid]'");
				echo "<script language='javascript' >alert('Sorry the confirmation is failed, please register again.');window.location.href = '$domainName/register.php';</script>";
			}
		}
	}
}

?>