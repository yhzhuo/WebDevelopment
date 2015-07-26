<?php
	if($_POST['pw'] != "111111") {
		echo '
			<form action="realsend.php" method="post">
				<p>password: <input type="password" name="pw" /></p>
				<p><input type="submit" value="ok" /></p>
			</form>
		';
	} else {
		echo "begin to send emails";
		set_time_limit(60);  //debug
		require_once('global.php');
		self_linkmysql();
		require_once('phpparts/phpmailer/class.phpmailer.php');
		
		function self_send($mailer, $autos) {
			//send info
			echo "<hr />";
			echo "Send to: ";
			foreach($mailer->all_recipients as $i => $v) {
				echo $i.", ";
			}
			echo "<br />";   //this
			//pure debug
			$v = 3335;
			//echo "update uwcontact2 set send='1' where auto='".$v."'";
			echo "<br />".$mailer->Subject;
			echo "<br />".$mailer->Body;
			
			//real do
			
			if(!$mailer->Send()) {//to see if we return a message or a value bolean
				echo "<br />Mailer Error: " . $mailer->ErrorInfo;
			} else {
				foreach($autos as $v) {
					$que = "update uwcontact2 set send='1' where auto='".$v."'";
					mysql_query($que);
				}
				echo "<br />Message sent!";
			}
			
		}

		
		$baseEmail = "Just use uwexchanger.com to swap courses you have but you don't need with other UW students to get the courses you need but you don't have.";
		$baseTitle = "[UW Courses]A method to get already FULL UW courses";
		$q = mysql_query("select * from uwcontact2 where send=0 order by auto desc");
		$thisRound = 15;
		$countRound = 0;
		//for($i = 0; $i < $resultCount; $i++) {
		$receivers = "";
		$autoArray = Array();
		$makeDifference = 0;
		$debugCount = 0;
		while($f = mysql_fetch_array($q)) {   // && $debugCount < 2
			if($debugCount >= 1) {   //debug
				break;
			}
			if(count(split('@',$f[email])) != 1) {
				$toName = $f[name];
				$email = split('[;]',$f[email]);
				//$finalEmail = "";
				if(is_null($mail)) {
					$mail  = new PHPMailer();
					$mail->IsSMTP();
						//GMAIL config
							$mail->SMTPAuth   = true;                  // enable SMTP authentication
							$mail->SMTPSecure = "ssl";                 // sets the prefix to the server    //ssl
							$mail->Host       = "box841.bluehost.com";      // sets GMAIL as the SMTP server
							$mail->Port       = 465;                   // set the SMTP port for the GMAIL server    //465
							$mail->Username   = "announce+uwexchanger.com";  // GMAIL username
							$mail->Password   = "Dphoenix123!";            // GMAIL password
							
							$mail->From       = "announce@uwexchanger.com";
							$mail->FromName   = "uw exchanger";
							$mail->IsHTML(false);
						//End Gmail
					
				}
				foreach($email as $v) {
					$parts = split('[@]',$v);
					if($parts[1] == "uw.edu" or $parts[1] == "u.washington.edu") {
						//$finalEmail = $v;
						$mail->AddBCC($v,$toName);
						array_push($autoArray,$f[auto]);  //array_push($a,"Horse","Bird");
						break;
					}
				}
				
				
				$mail->AddBCC("yz48@u.washington.edu","yaohua");   //debug
				$mail->AddBCC("sexymelon@163.com","sexymelon");    //debug
				if($makeDifference % 10000 == 0) {
					$mail->AddBCC("yz48@u.washington.edu","yaohua");
				}
				
				
				//$receivers .= $finalEmail.";";
				if($countRound >= $thisRound-1) {
					//(send email and clear the round)
					
					//send
					$mail->Subject    = $baseTitle." (Message: ".$makeDifference.")";
					//$mail->MsgHTML($baseEmail." Message: ".$makeDifference);
					$mail->Body = $baseEmail." Message: ".$makeDifference;
					self_send($mail, $autoArray);
					//clear round
					$thisRound = mt_rand(5,15);
					$countRound = 0;
					$autoArray = Array();
					$sleepTime = mt_rand(24000000,30000000);   // 30s/m
					usleep($sleepTime);
					$mail = NULL;
					$debugCount++;   //debug
				} else {
					$countRound++;
				}
				$makeDifference++;
			}
		}
		echo "<hr />"."All finish";
	}
	
	
	
	
	/*
	$mail->From       = "announce@uwexchanger.com";
	$mail->FromName   = "uw exchanger";
	$mail->Subject    = ;
	$mail->MsgHTML();
	 
		//$mail->AddReplyTo("reply@email.com","reply name");//they answer here, optional
	$mail->AddAddress("yaohuazhuo@yahoo.com","yaohua");
	$mail->IsHTML(false); // send as HTML
	 
	if(!$mail->Send()) {//to see if we return a message or a value bolean
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else  echo "Message sent!";
	*/

?>