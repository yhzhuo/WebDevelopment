<?php
if(array_key_exists('uid',$_COOKIE)) {
	echo "<script language='javascript'>alert('You have already registered');window.location.href='swap.php';</script>";
}
//echo "step: ".$_POST['step'];
if(!$_POST['step']) {    //no steps has finished, client is in step 1, fill in basic information
	include_once('register/register.htm');
} elseif($_POST['step'] == 1) {     //step 1 has finished, client is in step 2, send email to client and client confirm.
	//echo "in insert";
	require_once('global.php');
	self_linkmysql();
	$email = $_POST['email'];   //email password1 situationArea sendCourses
	if($email == "") {
		exit;   //forbid others attack database by this page
	}
	$password = $_POST['password1'];
	$situation = $_POST['situation'];
	$needCourseBoards = $_POST['sendCourses'];    //need courses is temporary put in the column extra.
	$username = $_POST['username'];
	$password = md5($password);
	if(count(split('[@]',$email)) == 1) {
		$email .= '@uw.edu';
	}
	$need = $_POST['needAll'];
	$exchange = $_POST['dontAll'];
	//The valid of $query1 should be changed finally. It need to act with the email comfirmation
	$query1 = mysql_query("insert into userinfo (username,password,email,situation,extra,valid) values ('$username','$password','$email','$situation','$needCourseBoards',1)");
	$uid = mysql_insert_id();
	$query2 = mysql_query("insert into swap_requestlist (uid,email,need,exchange,content) values ('$uid','$email','$need','$exchange','$situation')");
	//if(mysql_query("update userinfo set username='$username',password='$password',email='$email',situation='$situation',extra='$needCourses'")) {
	if($query1 && $query2) {
		//echo "setcookie";
	
	
	
	
		//      used for register without confirmation
		login_setCookie($username,$uid,$email,$password);
		echo "<script language='javascript'>alert('Registration is successful! Go to find courses you need!');window.location.href='swap.php';</script>";
		/*
		$mailAddress = "uwexchanger@yahoo.com";
		$password = "phoenix123";
		$smtpSever = "smtp.mail.yahoo.com";   //SSL Port 465
		$to = $email;
		$from = "uwexchanger@yahoo.com";
		$title = "[UWexchanger] This is the confirmation Email";
		//processing the content begin
		//standard url form "http://www.uwexchanger.com/login.php?email=[it's email]&code=md5([it's email].$webmasterCode)"
		$file = fopen("email/uwexchanger_confirmation_letter.htm","r");
		$content = fread($file,filesize("email/uwexchanger_confirmation_letter.htm"));
		fclose($file);
		
		$temp = $email.$webmasterCode;
		$code = md5($temp);
		$replacearray = array($email,$code);
		//processing the content end
		$content = str_replace($searcharray,$replacearray,$content);
		sendEmail($mailAddress, $password, $smtpSever, $to, $from, $title, $content);
		echo "<script language='javascript'>alert('The confirmation email has been sent to ".$email.". Please check!');self.close();</script>";
		
		
		//remember to send email
		/*
		 * default values of these three will set in global.php, remember to fix
		$mailAddress = "my email address";
		$password = "my password";
		$smtpSever = "my used smtpSever";
		*/
	
	
		/*$to = $email;
		$from = $mailAddress;
		$title = "Hi, it's the confirmation email from $domainName";
		$securecode = md5($email.$webmasterCode.$username).$password;
		$content = "
Hey $username: 

please click on the link below to confirm your registration!
http://www.uwclass.com/login.php?code=$securecode&email=$email
if you can't click on this link, please copy it and open it in a new tab.

$domainName
";
		sendEmail($mailAddress, $password, $smtpSever, $to, $from, $title, $content);//sendEmail($mailAddress, $password, $smtpSever, $to, $from, $title, $content)
		//email has sent
		$message = "A electronic confirmation has been sent to ".$email." or any email boxes it fowards to. Please check it and confirm your registration. If you can't reveive this email, please check your spam box";
		include_once('htmparts/global_jumpMessage.htm');
		*/
	
	//finally, it should jump directly to swap page
	
	} else {
		mysql_query("delete from swap_requestlist where email = '$email'");
		mysql_query("delete from userinfo where email = '$email'");
		echo "failed";
	}
}
?>