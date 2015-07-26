<?php
	/*
	require('uwnet/phpparts/htmlMail.php');
	//echo date('Y-m-d H:i:s');
	$smtpserver = "smtp.gmail.com";   //SMTP服务器
	$smtpserverport =587;          //SMTP服务器端口
	$smtpusermail = "yaohuazhuo@gmail.com";  //SMTP服务器的用户邮箱
	$smtpemailto = "yaohuazhuo@yahoo.com";   //发送给谁
	$smtpuser = "yaohuazhuo@gmail.com";     //SMTP服务器的用户帐号
	$smtppass = "dawnrevolutionist123";   //SMTP服务器的用户密码  这里是指你qq的密码  
	//$mailsubject = "[UW Courses] A method to get already FULL UW courses";     //邮件主题
	$mailsubject = "This is a testing email";     //邮件主题
	//$mailbody = "Just use uwexchanger.com to swap courses you have but you don't need with other UW students to get the courses you need but you don't have."; //邮件内容    "file_get_contents("uwexchanger_txtad.txt");"
	$mailbody = "For the great one Revolutionist Dawn!!!";
	$mailtype = "TXT";           //邮件格式（HTML/TXT）,TXT为文本邮件
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);  //这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;   //是否显示发送的调试信息
	if($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)=="1"){
	  echo "邮件发送成功！";
	}else{
	  echo "邮件发送失败！";
	}
	*/
	
	
	require_once('phpparts/phpmailer/class.phpmailer.php');
	$mail  = new PHPMailer();
	$mail->IsSMTP();
	 
	//GMAIL config
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the server    //ssl
		$mail->Host       = "box841.bluehost.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server    //465
		$mail->Username   = "announce+uwexchanger.com";  // GMAIL username
		$mail->Password   = "Dphoenix123!";            // GMAIL password
	//End Gmail
	 
	$mail->From       = "announce@uwexchanger.com";
	$mail->FromName   = "uw exchanger";
	
	$mail->Subject    = "testing the sending is ok";      //[UW Courses]A method to get already FULL UW courses
	//Just use uwexchanger.com to swap courses you have but you don't need with other UW students to get the courses you need but you don't have.
	//$mail->MsgHTML("I hope it will be fine!!!");
	$mail->Body = "Just use this to confirm that the sending is still ok.";
	 
		//$mail->AddReplyTo("reply@email.com","reply name");//they answer here, optional
	
	//$mail->AddBCC("865066950@qq.com","xinggua");
	$mail->AddBCC("yz48@u.washington.edu","Yaohua");
	$mail->IsHTML(false); // send as HTML
	 
	if(!$mail->Send()) {//to see if we return a message or a value bolean
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else  echo "Message sent!";
	
?>