<?php
	/*
	require('uwnet/phpparts/htmlMail.php');
	//echo date('Y-m-d H:i:s');
	$smtpserver = "smtp.gmail.com";   //SMTP������
	$smtpserverport =587;          //SMTP�������˿�
	$smtpusermail = "yaohuazhuo@gmail.com";  //SMTP���������û�����
	$smtpemailto = "yaohuazhuo@yahoo.com";   //���͸�˭
	$smtpuser = "yaohuazhuo@gmail.com";     //SMTP���������û��ʺ�
	$smtppass = "dawnrevolutionist123";   //SMTP���������û�����  ������ָ��qq������  
	//$mailsubject = "[UW Courses] A method to get already FULL UW courses";     //�ʼ�����
	$mailsubject = "This is a testing email";     //�ʼ�����
	//$mailbody = "Just use uwexchanger.com to swap courses you have but you don't need with other UW students to get the courses you need but you don't have."; //�ʼ�����    "file_get_contents("uwexchanger_txtad.txt");"
	$mailbody = "For the great one Revolutionist Dawn!!!";
	$mailtype = "TXT";           //�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);  //�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
	$smtp->debug = false;   //�Ƿ���ʾ���͵ĵ�����Ϣ
	if($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)=="1"){
	  echo "�ʼ����ͳɹ���";
	}else{
	  echo "�ʼ�����ʧ�ܣ�";
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