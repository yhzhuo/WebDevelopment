<?  
/* 
 * �ʼ�������
 */
class smail {
 //����SMTP ��������Ӧ�̣�������������IP��ַ
 var $smtp = ""; 
 //SMTP��ҪҪ�����֤��ֵΪ 1 ����Ҫ�����ֵ֤Ϊ 0�����ڴ������SMTP�����̶�Ҫ��֤���粻����������smtp ��������ϵ��
 var $check = 1;
 //����email�ʺ�����
 var $username = "";
 //����email����
 var $password = "";
 //��email �����Ƿ��ŷ������ϵ�email
 var $s_from = "";
 
 /* 
  * ���ܣ����ų�ʼ������
  * $from      ��ķ��ŷ������ϵ�����
  * $password  �����������
  * $smtp      ����SMTP ��������Ӧ�̣�������������IP��ַ
  * $check     SMTP��ҪҪ�����֤��ֵΪ 1 ����Ҫ�����ֵ֤Ϊ 0�����ڴ������SMTP�����̶�Ҫ��֤
  */
 function smail ( $from, $password, $smtp, $check = 1 ) {
  if( preg_match("/^[^\d\-_][\w\-]*[^\-_]@[^\-][a-zA-Z\d\-]+[^\-](\.[^\-][a-zA-Z\d\-]*[^\-])*\.[a-zA-Z]{2,3}/", $from ) ) {
   $this->username = substr( $from, 0, strpos( $from , "@" ) );
   $this->password = $password;
   $this->smtp = $smtp ? $smtp : $this->smtp;
   $this->check = $check;
   $this->s_from = $from;
  }
 }
 
 /* 
  * ���ܣ������ʼ�
  * $to   Ŀ������
  * $from ��Դ����
  * $subject �ʼ�����
  * $message �ʼ�����
  */
 function send ( $to, $from, $subject, $message ) { 
 
  //���ӷ����� 
  $fp = fsockopen ( $this->smtp, 25, $errno, $errstr, 60); 
  if (!$fp ) return "���ӷ�����ʧ��".__LINE__;
  set_socket_blocking($fp, true ); 
  
  $lastmessage=fgets($fp,512);
  if ( substr($lastmessage,0,3) != 220 ) return "������Ϣ1:$lastmessage".__LINE__; 
  
  //HELO
  $yourname = "YOURNAME";
  if($this->check == "1") $lastact="EHLO ".$yourname."\r\n";
  else $lastact="HELO ".$yourname."\r\n";
  
  fputs($fp, $lastact);
  $lastmessage == fgets($fp,512);
  if (substr($lastmessage,0,3) != 220 ) return "������Ϣ2:$lastmessage".__LINE__; 
  while (true) {
   $lastmessage = fgets($fp,512);
   if ( (substr($lastmessage,3,1) != "-")  or  (empty($lastmessage)) )
    break;
  } 
    
  //�����֤
  if ($this->check=="1") {
   //��֤��ʼ
   $lastact="AUTH LOGIN"."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) return "������Ϣ3:$lastmessage".__LINE__; 
   //�û�����
   $lastact=base64_encode($this->username)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) return "������Ϣ4:$lastmessage".__LINE__;
   //�û�����
   $lastact=base64_encode($this->password)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != "235") return "������Ϣ5:$lastmessage".__LINE__;
  }
  
  //FROM:
  $lastact="MAIL FROM: <". $this->s_from . ">\r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) return "������Ϣ6:$lastmessage".__LINE__;
  
  //TO:
  $lastact="RCPT TO: <". $to ."> \r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) return "������Ϣ7:$lastmessage".__LINE__;
   
  //DATA
  $lastact="DATA\r\n";
  fputs($fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 354) return "������Ϣ8:$lastmessage".__LINE__;
  
   
  //����Subjectͷ
  $head="Subject: $subject\r\n"; 
  $message = $head."\r\n".$message; 
   
  
  //����Fromͷ 
  $head="From: $from\r\n"; 
  $message = $head.$message; 
   
  //����Toͷ 
  $head="To: $to\r\n";
  $message = $head.$message;
   
  
  //���Ͻ����� 
  $message .= "\r\n.\r\n";
  
  //������Ϣ 
  fputs($fp, $message); 
  $lastact="QUIT\r\n"; 
  
  fputs($fp,$lastace); 
  fclose($fp); 
  return 0;
 } 
}
/*����ʾ��
$sm = new smail( "�û���@163.com", "����", "smtp.163.com" );
$end = $sm->send( "Ŀ������", "��Դ����", "���Ǳ���", "�����ʼ�����" );
if( $end ) echo $end;
else echo "���ͳɹ���";
*/
?>