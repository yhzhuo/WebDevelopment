<?php
/*
	require('uwnet/phpparts/small.php');
	$sm = new smail( "yaohuazhuo@yahoo.com", "19920208", "smtp.mail.yahoo.com" );
	$end = $sm->send( "sexymelondawn@gmail.com", "yaohuazhuo@yahoo.com", "Dear google", "It is not a spam, the formal one is also not a spam!!!" );
	if( $end ) echo $end;
	else echo "success!";
*/
/*
require('uwnet/phpparts/htmlMail.php');
$smtpserver = "smtp.mail.yahoo.com";   //SMTP服务器
$smtpserverport =25;          //SMTP服务器端口
$smtpusermail = "yaohuazhuo@yahoo.com";  //SMTP服务器的用户邮箱
$smtpemailto = "sexymelondawn@gmail.com";   //发送给谁
$smtpuser = "yaohuazhuo";     //SMTP服务器的用户帐号
$smtppass = "19920208";   //SMTP服务器的用户密码  这里是指你qq的密码  
$mailsubject = "Hey google";     //邮件主题
$mailbody = "please don't regard it as a spam! It's from great one zhuoyaohua!!!"; //邮件内容
$mailtype = "HTML";           //邮件格式（HTML/TXT）,TXT为文本邮件
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);  //这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;   //是否显示发送的调试信息
if($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)=="1"){
  echo "邮件发送成功！";
}else{
  echo "邮件发送失败！";
}
*/
/*
echo "two 
line";
*/
/*
$domainName = "http://www.google.com";
echo "<script language=javascript >alert('Sorry the confirmation is failed, please try again.');window.location.href = '$domainName';</script>";
*/
/*
include('uwnet/phpparts/global_function.php');
self_forbidIllegalVisit("aaa");
echo "finish";
*/
//header("location: syphp2.php");

//echo pow(1.2,22);
//$a = "N1";
//echo $_POST[$a];
/*foreach($_POST['N1'] as $i => $v) {
	echo "($i): $v<br>";
}
*/
/*
if(!$_POST['email']) {
	echo "no";
} else {
	echo "yes";
}
*/

/*
if(md5("phoenix123") == "d41d8cd98f00b204e9800998ecf8427e") {
	echo "yes";
} else {
	echo "no";
}
echo "<br>".md5("sexymelon");
*/

/*
$a = "aaa@bbb";
$b = "cccccc";
$aa = split('[@]',$a);
$bb = split('[@]',$b);
echo count($aa)."<br>";
echo count($bb);
*/

/*
	setcookie("username","sdf",time()-10000);
	setcookie("uid","dhsfr",time()-10000);
	setcookie("email","regtwey",time()-10000);
	setcookie("password","rtwet",time()-10000);
	*/
	//echo 4*5/11+4*3/11+3.5*3/11;
	
/*	
$total = "*****";
	$total = str_replace("*","#",$total);
	echo $total;
	*/

/*
$need = "";
$need = str_replace("*","#",$need);
$need = split('[#]',$need);
array_pop($need);
echo count($need);
if($need[0] == "") {
	echo "<br>yes";
} else {
	echo "<br>no";
}
*/


/*
$a = 2;
function ddd() {
	echo $a;
}
*/
	//echo md5("lijun12345e67");
	//echo (4/3)*3.14*(0.5*2.2)*(0.5*3.5)*(0.5*3.5);
	
	
	/*
	require_once('phpparts/global_function.php');
	self_linkmysql();
	$q1 = mysql_query("insert into testunique (name,phone,email) values ('ZHUO, Yaohua','2066737243','yz48@uw.edu')");
	if($q1) {
		echo "query 1 is successful!<br />";
	} else {
		echo "query 1 is failed!<br />";
	}
	$q2 = mysql_query("insert into testunique (name,phone,email) values ('ZHUO, Yaohua','2066737243','yz48@uw.edu')");
	if($q2) {
		echo "query 2 is successful!<br />";
	} else {
		echo "query 2 is failed!<br />";
	}
	*/


	/*
	require_once('global.php');
	self_linkmysql();
	$q = mysql_query("insert into test (col1, col2) values ('aaa','bbb')");
	if($q) {
		echo "ok";
	} else {
		echo "failed";
	}
	*/




/*
	require_once('global.php');
	self_linkmysql();
	$tableName = "test"."";
	$a = "select * from ".$tableName;
	echo "query of getData: ".$a."<p>";
		$getData = mysql_query($a);
		if($getData) {
			echo "getData is ok<p>";
		}
		
		while($fetchData = mysql_fetch_array($getData)) {
			echo "first test: ".$fetchData[auto]."<p>";
			
			echo "<hr>";
			foreach($fetchData as $colName => $value) {
				echo $colName.": ".$value."<p>";
			}
			
			echo "<hr>";
			
			
			$output = 'insert into '.$tableName.' ';
			$colPart = "(";
			$valPart = "(";
			foreach($fetchData as $colName => $value) {
				if(!is_int($colName)) {
					$acolName = $colName."";
					$avalue = $value."";
					$colPart .= $acolName.",";
					$valPart .= '"'.$avalue.'"'.",";
				}
			}
			echo "<hr>";
			//two lines below may have problems




			
			$colPart = substr_replace($colPart,")",strlen($colPart)-1);
			$valPart = substr_replace($valPart,")",strlen($valPart)-1);
			
			$output .= $colPart." values ".$valPart;
			echo $output."<p>";
		}
		*/





/*
	require_once('global.php');
	self_linkmysql();
	$tableName = "test"."";
	
	
	
	
	
	echo $tableName."<p>"."======"."<p>";
		$a = "select * from ".$tableName;
		$getData = mysql_query($a);
		while($fetchData = mysql_fetch_array($getData)) {
			$output = 'insert into '.$tableName.' ';
			$colPart = "(";
			$valPart = "(";
			foreach($fetchData as $colName => $value) {
				if(!is_int($colName)) {
					$acolName = $colName."";
					$avalue = $value."";
					$colPart .= $acolName.",";
					$valPart .= '"'.$avalue.'"'.",";
				}
			}
			//two lines below may have problems
			$colPart = substr_replace($colPart,")",strlen($colPart)-1);
			$valPart = substr_replace($valPart,")",strlen($valPart)-1);
			$output .= $colPart." values ".$valPart.";<br>";
			echo $output;
			//echo $output."<p>";
		}
*/

/*
	require_once('global.php');
	self_linkmysql();
	$a = "success";
	if(mysql_query("insert into test (t1) values ('$a')")) {
		echo "success";
	} else {
		echo "failed";
	}
	*/
	
	
	
	
	/*
	mysql_connect("fdb3.awardspace.com", "1136102_phoenix", "phoenix123") or die(mysql_error());
	echo "Connected to MySQL<br />";
	*/
	
	
/*
	$file = fopen("test.txt","w");
	echo fwrite($file,"Hello	World	Testing!");       //后面用于mailchimp导入邮件地址的代码
	fclose($file);
	*/
	
	
	
	
	/*
	$file = fopen("test.txt","w");
	echo fputs($file,"\r")."<p>";
	echo fputs($file,"Hello World. Testing!
")."<p>";
	echo fputs($file,"The	second	line
")."<p>";
	echo "now"." "."ok"."	"."finished";
	echo "<p> ok2";
	fclose($file);
	*/

/*
	require_once('global.php');
	self_linkmysql();
	$que = mysql_query("select email,name from uwcontact");
	$file = fopen("test.txt","w");
	while($f = mysql_fetch_array($que)) {
		$email = split('[;]',$f[email]);
		$email = $email[0];
		if(count(split('@',$email)) != 1) {              //if($email != "") {
			$name = split('[ ]', $f[name]);
			$firstname = $name[0];
			$lastname = array_pop($name);   //array_pop(array)
			echo $email."	".$firstname."	".$lastname." and new line. Total length: ".fputs($file,$email."	".$firstname."	".$lastname."
")."<p>";
		}
	}
	fclose($file);
	*/
/*
if(!strpos("Hello world!","wo")) {
	echo "not find";
} else {
	echo "find";
}
	*/
	require_once('global.php');
	self_linkmysql();
	$q = mysql_query("select * from userinfo");
	while($f = mysql_fetch_array($q)) {
		foreach($f as $i => $v) {
			echo "(".$i."): ".$v."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		echo "<hr>";
	}
?>