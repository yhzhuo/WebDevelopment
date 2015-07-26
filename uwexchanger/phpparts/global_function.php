<?php
function windtohtm($message) {                        //ת��windcode
	$searcharray = array('[u]','[/u]','[b]','[/b]','[i]','[/i]','[list]','[li]','[/li]','[/list]','[sub]', '[/sub]','[sup]','[/sup]','[strike]','[/strike]','[blockquote]','[/blockquote]','[hr]','[/backcolor]', '[/color]','[/font]','[/size]','[/align]'
	);
	$replacearray = array('<u>','</u>','<b>','</b>','<i>','</i>','<ul style="margin:0 0 0 15px">','<li>', '</li>','</ul>','<sub>','</sub>','<sup>','</sup>','<strike>','</strike>','<blockquote>','</blockquote>', '<hr />','</span>','</span>','</font>','</font>','</div>'
	);
	$message = str_replace($searcharray,$replacearray,$message);              //������ɫ����ɹ�

	$searcharray = array(
		"/\[font=([^\[\(&\\;]+?)\]/is",
		"/\[color=([#0-9a-z]{1,15})\]/is",
		"/\[backcolor=([#0-9a-z]{1,10})\]/is",
		"/\[email=([^\[]*)\]([^\[]*)\[\/email\]/is",
	    "/\[email\]([^\[]*)\[\/email\]/is",
		"/\[align=(left|center|right|justify)\]/is",
		"/\[glow=(\d+)\,([0-9a-zA-Z]+?)\,(\d+)\](.+?)\[\/glow\]/is"
	);
	$replacearray = array(
		"<font face=\"\\1 \">",
		"<span style=\"color:\\1 \">",
		"<span style=\"background-color:\\1 \">",
		"<a href=\"mailto:\\1 \">\\2</a>",
		"<a href=\"mailto:\\1 \">\\1</a>",
		"<div align=\"\\1\">",
		"<div style=\"width:\\1px;filter:glow(color=\\2,strength=\\3);\">\\4</div>"
	);
	$message = preg_replace($searcharray,$replacearray,$message);                                    //����������ɫ�����Գɹ�

        $searcharray = array("[size","[quote]","[/quote]","[table","[/table]","[tr]","[/tr]","[td]","[/td]","[code]","[/code]","[s:","[url=http://","[/url]","[img]http://","/[/img]");
        $replacearray = array("<font size","<blockquote class=\"blockquote3\"><div class=\"quote\">���� </div><div class=\"text\"> <br />","<br /></div></blockquote><br />","<table border=1 style=border-collapse:collapse bordercolor=#ABC8D0 width","</table>","<tr>","</tr>","<td height=20 bordercolor=#D4EFF7 bgcolor=#F8FCFE>","</td>","<div class=\"f12\">����</div><div class=\"blockquote2\"><ol><li>","</li></ol></div>","<img src=images/post/smile/default/","<a href=http://","</a>","<img src=http://",">");
        $message = str_replace($searcharray,$replacearray,$message);
                              //<font size=5>ɫ��</font>
        
$message = str_replace("]",">",$message);
return $message;
}


function self_tz($a) {                  //��ת
$url = $a;
include('htmparts/global_tz.txt');
}


function xs_daohang() {                    //С˵ϵͳ�Ķ�������
$n = func_num_args();
$op = func_get_args();
$total = "/";
for($i = 0;$i < $n;$i++) {
$total = $total.$op[$i];
}
include('htmparts/global_xsdh.txt');
}


function self_StringLen($str) {                   //���������Ƿ�Ϊ��Ч����
$len=strlen($str);   
 $i=0; $j=0;  
 while($i<$len)   
 {   
       if(preg_match("/^[".chr(0xa1)."-".chr(0xf9)."]+$/",$str[$i]))   
       {   
         $i+=2;   
        }   
        else  
        {   
         $i+=1;   
       }   
    $j++;
 }   
 return $j;   
}

/*
function self_linkmysql() {                                               //δ���
$target = "wanwang";
if($target == "local") {
  $mysqlip = 'localhost';
  $mysqlusername = 'root';
  $mysqlpassword = 'sexymelon';
  //$mysqldb = 'uwnet2';
  $mysqldb = 'test';
} else {
  $mysqlip = 'bdm-012.hichina.com';
  $mysqlusername = 'bdm0120195';
  $mysqlpassword = 'phoenix123';
  $mysqldb = 'bdm0120195_db';
}
     $link = mysql_pconnect($mysqlip,$mysqlusername,$mysqlpassword);
     mysql_select_db($mysqldb,$link);
     $que='set names "gbk"';      //may have problems here
     mysql_query($que);                    //ǰ��׼��
}
*/

function self_linkmysql() {                                               //δ���
$target = "bluehost";
if($target == "local") {
  $mysqlip = 'localhost';
  $mysqlusername = 'root';
  $mysqlpassword = 'sexymelon';
  $mysqldb = 'uwnet2';
  //$mysqldb = 'test';
} elseif ($target == "wanwang") {
  $mysqlip = 'bdm-012.hichina.com';
  $mysqlusername = 'bdm0120195';
  $mysqlpassword = 'phoenix123';
  $mysqldb = 'bdm0120195_db';
} elseif ($target == "awardspace") {
	$mysqlip = 'fdb3.awardspace.com:3306';
	$mysqlusername = '1136102_phoenix';
	$mysqlpassword = 'phoenix123';
	$mysqldb = '1136102_phoenix';
} elseif ($target == "bluehost") {
	$mysqlip = 'localhost';
	$mysqlusername = 'ninzerhd_phoenix';
	$mysqlpassword = 'Dphoenix123!';
	$mysqldb = 'ninzerhd_phoenix';
}
     $link = mysql_connect($mysqlip,$mysqlusername,$mysqlpassword);
     mysql_select_db($mysqldb,$link);
     $que='set names "gbk"';      //may have problems here
     mysql_query($que);                    //ǰ��׼��
}


function syphp($uid,$score) {
$que = "update test set A_id=A_id+$score where auto=$uid";
mysql_query($que);
echo $que;
}


function self_findValidName($formalName) {                   //�ҵ����ʵ�δ��ռ�õ��û�����ʹ��ǰ���뱣֤�����Ѿ�����mysql���ݿ⣩
$i = 0;
$c = 0;
while($c < 3 && $i < 10) {
if($i == 0) {
	$option = $formalName."90hd";
}
elseif ($i == 1) {
    $option = $formalName."ţB";
}
elseif ($i == 2) {
	$option = $formalName."����";
}
elseif ($i == 3) {
	$option = $formalName."2011";
}
else {
$sz = $i - 2;
	$option = $formalName.$sz;
}
$b = mysql_query("select uid from pw_members where username='$option'");
if(!mysql_fetch_array($b)) {
$choice[$c] = $option;
$c++;
}
$i++;
}
return $choice;
}


function self_becomefans($date,$zid,$zz) {                                        //��Ϊ��˿��δ���飩
if($_COOKIE[yhm]) {
$queg = mysql_query("select * from xs_fs where uid='$_COOKIE[yhid]' and zid='$zid'");
if(!mysql_fetch_array($queg)) {
     mysql_query("insert into xs_fs (rdrqs,uid,un,zid,zz) values ('$date','$_COOKIE[yhid]','$_COOKIE[yhm]','$zid','$zz')");
$c = mysql_insert_id();
self_setaction("xs_fs",$c,"befans",0);
}
else {
echo "<script language=javascript>alert('���Ѿ���עTA��');</script>";
}
} else {
echo "<script language=javascript>alert('���ȵ�¼��ע��');</script>";
}
}


function self_love($uid,$username,$table,$auto) {                   //����id����������mysql������auto�ֶ�
$prove = "$uid:$username:$table:$auto";
$ifHas = mysql_query("select uid from pw_members where uid = '$_COOKIE[yhid]' and love like '%$prove%'");
if(!mysql_fetch_array($ifHas)) {
$oldLove = mysql_query("select love from pw_members where uid='$_COOKIE[yhid]'");
$fetch = mysql_fetch_array($oldLove);
$arrshu = split('[%]',$fetch[love]);
$shu = count($arrshu);
$shu--;
$alter = $fetch[love].$prove."%";
mysql_query("update pw_members set love='$alter' where uid='$_COOKIE[yhid]'");
$loveindex = $shu;
$auto = $_COOKIE[yhid].":".$loveindex;                    //Ϊ�˷���split()�������������飬index��0��ʼ
self_setaction($table,$auto,"love",0);
}
else {
echo "<script language=javascript>alert('���Ѿ�ϲ���ⲿ��Ʒ��');</script>";
}
}


function self_changepage() {              //��������mysql��������$tablename��������,$rownum��ÿҳ��¼����,$webpage����page�����в�������ַ��
function arrangepage($ii,$recent,$web) {       //����м䵼��
if($ii != $recent) {
echo "<a href=\"$web&page=$ii\">$ii </a>";
}
else {
echo "[$ii]";
}
}
$n = func_num_args();
$op = func_get_args();
if($n == 3) {                                       //ֱ������count,����������($totalrow,$rownum,$webpage)
$totalrow = $op[0];
$rownum = $op[1];
$webpage = $op[2];
} else {
$tablename = $op[0];
$rownum = $op[1];
$webpage = $op[2];
$extra = $op[3];
$count = "count(*)";
$que = "select count(*) from $tablename $extra";
$fetchcount = mysql_fetch_array(mysql_query($que));
$totalrow = $fetchcount[$count];
}
if($totalrow != 0) {
$doublepage = $totalrow/$rownum;
if($totalrow%$rownum != 0) {
$pagenum = (int)$doublepage + 1;
}
else {
$pagenum = (int)$doublepage;
}
if($_GET['page']) {                        //��ȡ��ǰҳ��
$recentpage = $_GET['page'];
}
else {
$recentpage = 1;
}
if($recentpage != 1) {                          //ֱ�ӷ�����һҳ
$prepage = $recentpage - 1;
echo "<a href=\"$webpage&page=$prepage\">����һҳ </a>";     //����ַ����ͺ�����������ַ�д�����
}
if($pagenum <= 11) {                             //�м������
$i = 1;
while($i <= $pagenum) {
arrangepage($i,$recentpage,$webpage);
$i++;
}
}
else {
if($recentpage - 5 <= 0) {
$i = 1;
while($i <= 11) {
arrangepage($i,$recentpage,$webpage);
echo "...";
$i++;
}
}
elseif($recentpage + 5 <= $pagenum) {
$i = $recentpage - 5;
echo "...";
while($i <= $recentpage + 5) {
arrangepage($i,$recentpage,$webpage);
$i++;
}
}
else {
$i = $pagenum - 10;
while($i <= $pagenum) {
arrangepage($i,$recentpage,$webpage);
$i++;
}
}
}
if($recentpage != $pagenum) {                          //ֱ�ӷ�����һҳ
$postpage = $recentpage + 1;
echo "<a href=\"$webpage&page=$postpage\">��һҳ�� </a>";     //����ַ����ͺ�����������ַ�д�����
}
}
}


function self_leastQueryIndex($rownum) {
if(!$_GET['page'] or $_GET[page] == "") {
$least = 0;
}
else {
$ye = $_GET['page'];
$least = ($ye - 1) * $rownum;
}
return $least;
}


function self_dlorxx($total) {
if($_COOKIE[yhm]) {
include('htmparts/global_yhxx.htm');
}
else {
include('htmparts/global_dlzc.htm');
}
}


function self_doubledate() {                                            //����double���͵�����ֵ
     ini_set("date.timezone","Asia/Shanghai");
$date = (double)date('ymdHis');
return $date;
}


function self_setaction($formname,$auto,$type,$yinsi) {        //Ŀǰ����like��share��action��ʹ��auto_increment:�ֶ��о���λ�õķ�ʽ�����action�ķ�λ
if($_COOKIE[yhm]) {
$query = mysql_query("select money from pw_members where uid='$_COOKIE[yhid]'");          //$formname,$autoΪ�������������ڵı�������auto�ֶ�ֵ��$typeΪ��Ϊ����
$fetch = mysql_fetch_array($query);
$money = $fetch[money];
$action = "$formname,$auto,$type";
$date = self_doubledate();
mysql_query("insert into xs_action (name,action,stime,uid,yinsi,money) values ('$_COOKIE[yhm]','$action','$date','$_COOKIE[yhid]','$yinsi','$money')");
}
}


function self_getaction() {          //��Ҫ��������ʱ�ڶ�������ͳһΪT
$argnum = func_num_args();
if($argnum == 1) {
$behind = func_get_arg(0);
$query = "select * from xs_action $behind";
} else {
$query = func_get_arg(0);
}
$a = mysql_query($query);
$i = 0;
while ($arr = mysql_fetch_array($a)) {
	$action[$i][did] = $arr[did];
	$action[$i][name] = $arr[name];
	list($action[$i][table],$action[$i][auto],$action[$i][type]) = split('[,]',$arr[action]);
        list($action[$i][auto],$action[$i][position]) = split('[:]',$action[$i][auto]);
	$action[$i][stime] = $arr[stime];
	$action[$i][ztime] = $arr[ztime];
	$action[$i][uid] = $arr[uid];
	$action[$i][yinsi] = $arr[yinsi];
	$action[$i][money] = $arr[money];
	$i++;
}
return $action;
}


function self_listactions($action) {               //δ���
if(!$action) {
return;
}
$i = 0;
foreach($action as $v) {
$money[$i] = $v[money];
$i++; 
}
$money3 = $money;
$money2 = self_dropSameElements($money3,T);
$j = 0;
foreach($money2 as $v) {
$p[$j] = array_keys($money,$v);         //�ҳ�money2��ÿ��Ԫ����money�е�ָ�룬��money�е�λ�þʹ�����������Ӧ����������ָ��
$j++;
}
$k = 0;
foreach($p as $v) {
foreach($v as $v2) {
$q[$k] = $v2;
$k++;
}
}
foreach($q as $z) {
$type = $action[$z][type];
$name = $action[$z][name];
$auto = $action[$z][auto];
$tadeuid = $action[$z][uid];
if($type != wb && $type != befriend && $type != befans && $type != visit && $type != liuyan) {
if($type == edit or $type == write) {
$query = mysql_query("select fm from xssx where sid = '$auto'");
$fetch = mysql_fetch_array($query);
} else {
$query2 = mysql_query("select icon from pw_members where uid = '$auto'");
$fetch = mysql_fetch_array($query2);
}
$tp = $fetch[fm];
if($type == edit){
$actiontype = "������";
} elseif($type == write) {
$actiontype = "��ʼд";
} elseif($type == read) {
$actiontype = "����";
} elseif($type == share) {
$actiontype = "������";
} elseif($type == pl) {
$actiontype = "������";
} else {
$actiontype = "ϲ��";
}
if($type == edit or $type == share) {                            //xsnr��λ�����ȥ��ֱ����ҳ��
$query3 = mysql_query("select sid,ym,xsm,description,nr from xsnr where ymid='$auto'");
$fetch3 = mysql_fetch_array($query3);
$zyswlj = "xsxt.php?s=$fetch3[sid]&y=$fetch3[ym]";                                        //$zyswlj:������������
$xsm = $fetch3[xsm];
$tp = $fetch3[nr];
if($fetch3[description] != "") {
$description = $fetch3[description];
} else {
$query4 = mysql_query("select description from xssx where sid='$fetch3[sid]'");
$fetch4 = mysql_fetch_array($query4);
if($fetch4[description] != "") {
$description = $fetch4[description];
} else {
$description = "��";
}
}
$quetag = mysql_query("select tags,fq from xssx where sid='$fetch3[sid]'");
$fetchtag = mysql_fetch_array($quetag);
$tags = split('[,]',$fetchtag[tags]);
$fq = $fetchtag[fq];
} elseif($type == pl) {                             //xspl��λ
$que = mysql_query("select * from xspl where auto='$auto'");
$f = mysql_fetch_array($que);
$que = mysql_query("select * from xssx where sid='$f[sid]'");
$f2 = mysql_fetch_array($que);
$zyswlj = "xsxt.php?s=$f[sid]&y=$f[ym]";
$tp = $f2[fm];
$tadeuid = $f[fbid];
$name = $f2[zz];
$xsm = $f2[xsm];
$description = $f[pl];
$fq = $f2[fq];
$tags = $f2[tags];
include('htmparts/global_acreation.htm');
} else {                                                          //xssx��λ
$query5 = mysql_query("select sid,description,xsm,tags,fq from xssx where sid='$auto'");
$fetch5 = mysql_fetch_array($query5);
$zyswlj = "xsxt.php?s=$fetch5[sid]";
$xsm = $fetch5[xsm];
if($fetch5[description] != "") {
$description = $fetch5[description];
} else {
$description = "��";
}
$fetchtag = mysql_fetch_array($query5);
$tags = split('[,]',$fetchtag[tags]);
$fq = $fetchtag[fq];
}
include('htmparts/global_acreation.htm');
}
elseif($type == befriend or $type == befans or $type == visit) {                       //�ɺ��ѳɷ�˿
$uid1 = $action[$z][uid];
$name1 = $action[$z][name];
if($type == befans) {
$hudonglei = "��Ϊ��";
$statue = "��˿";
$quename = mysql_query("select zz,zid from xs_fs where aid='$auto'");
$fetchgz = mysql_fetch_array($quename);
$uid2 = $fetchgz[zid];
$name2 = $fetchgz[zz];
$querytp = mysql_query("select icon,tags from pw_members where uid='$uid1' or uid='$uid2'");
$fetchtp1 = mysql_fetch_array($querytp);
$tp1 = $fetchtp1[icon];
$tags1 = split('[,]',$fetchtp1[tags]);
$fetchtp2 = mysql_fetch_array($querytp);
$tp2 = $fetchtp2[icon];
$tags2 = split('[,]',$fetchtp2[tags]);
} elseif($type == befriend) {
$hudonglei = "��Ϊ��";
$statue = "����";
$quename = mysql_query("select cn,cid,bn,bid from xs_hy where auto='$auto'");
$fetchhy = mysql_fetch_array($quename);
if($fetchhy[cid] == $uid1) {
$uid2 = $fetchhy[bid];
$name2 = $fetchhy[bn];
} else {
$uid2 = $fetchhy[cid];
$name2 = $fetchhy[cn];
}
$querytp = mysql_query("select icon,tags from pw_members where uid='$uid1' or uid='$uid2'");
$fetchtp1 = mysql_fetch_array($querytp);
$tp1 = $fetchtp1[icon];
$tags1 = split('[,]',$fetchtp1[tags]);
$fetchtp2 = mysql_fetch_array($querytp);
$tp2 = $fetchtp2[icon];
$tags2 = split('[,]',$fetchtp2[tags]);
} elseif($type == visit) {
$hudonglei = "������";
$statue = "�ռ�";
$que1 = mysql_query("select icon,tags from pw_members where uid='$uid1'");
$que2 = mysql_query("select username,icon,tags from pw_members where uid='$auto'");
$f1 = mysql_fetch_array($que1);
$f2 = mysql_fetch_array($que2);
$uid2 = $auto;
$name2 = $f2[username];
$tp1 = $f1[icon];
$tp2 = $f2[icon];
$tags1 = split('[,]',$f1[tags]);
$tags2 = split('[,]',$f2[tags]);
} else {                               //$uid1Ϊ������Ϊ����
$que = mysql_query("select username,icon,tags from pw_members where uid=$uid1");
$f = mysql_fetch_array($que);

$que = mysql_query("select username,icon,tags from pw_members where uid=$auto");
$f2 = mysql_fetch_array($que);
$name1 = $f[username];
$hudonglei = "��";
$uid2 = $auto;
$name2 = $f2[username];
$statue = "������";
$tp1 = $f[icon];
$tp2 = $f2[icon];
$tags1 = split('[,]',$f[tags]);
$tags2 = split('[,]',$f2[tags]);
}
include('htmparts/global_arelation.htm');
}
elseif(($action[$z][yinsi] != 2 && $_GET['grid'] != $_COOKIE[yhid]) or $_GET['grid'] == $_COOKIE[yhid]) {                                              //΢�������Ե����
if($type == wb) {
$query2 = mysql_query("select icon from pw_members where uid = '$auto'");
$fetch = mysql_fetch_array($query2);
$tp = $fetch[icon];
$actiontype = "д��΢��";
$zhuanzai = "";                                  //ת��΢������share
$querywb = mysql_query("select description from xssx where sid='$auto'");
$description = $querywb[description];
$quetag = mysql_query("select tags from pw_members where sid='$action[$z][uid]'");
$fetchtag = mysql_fetch_array($quetag);
$tags = split('[,]',$fetchtag[tags]);
} else {
$que = mysql_query("select * from xs_liuyan where auto='$auto'");
$f = mysql_fetch_array($que);
$tadeuid = $f[sendid];
$que = mysql_query("select username,icon,description,tags from pw_members where uid='$tadeuid'");
$f2 = mysql_fetch_array($que);
$tp = $f2[icon];
$name = $f2[username];
$que = mysql_query("select username from pw_members where uid='$f[receiveid]'");
$f3 = mysql_fetch_array($que);
$actiontype = "��"."<a href=yhgl.php?grid=$f[receiveid]>"."$f3[username]"."</a>"."������";
$description = $f[liuyan];
$tags = split('[,]',$f2[tags]);
}
include('htmparts/global_awb.htm');
}
}
}


function self_befriend($date,$bid,$bn,$yzxx) {
if($_COOKIE[yhm]) {
$que = mysql_query("select auto,cjby from xs_hy where cid='$_COOKIE[yhid]' and bid='$bid'");   //cҪ��b��c�Ѿ���b
$que2 = mysql_query("select auto,cjby from xs_hy where cid='$bid' and bid='$_COOKIE[yhid]'");  //1��cҪ��b��b�Ѿ������ź� 2��cb��Ϊ���ѣ�ֻ��ԭ����b��c
if($fetch1 = mysql_fetch_array($que)) {
if($fetch1[cjby] == T) {
echo "<script language=javascript>alert('���Ѿ���TA������');</script>";
} else {
echo "<script language=javascript>alert('���Ѿ���TA�����ˣ���TA��û��Ӧ');</script>";
}
$diyi = T;
}
if($fetch2 = mysql_fetch_array($que2)) {
if($fetch2[cjby] == T) {
echo "<script language=javascript>alert('���Ѿ���TA������');</script>";
} else {
mysql_query("update xs_hy set cjby='T',bjcy='T' where auto='$fetch2[auto]'");
self_setaction("xs_hy",$fetch2[auto],"befriend",0);                                   //yhgl_jhyģ��ҲҪ��
}
$dier = T;
}
if($diyi != T && $dier != T) {
     mysql_query("insert into xs_hy (hyrqs,cid,cn,bid,bn,cjby,yzxx) values ('$date','$_COOKIE[yhid]','$_COOKIE[yhm]','$bid','$bn','wei','$yzxx')");
}
} else {
echo "<script language=javascript>alert('���ȵ�¼��ע��');</script>";
}
}


function self_share($uid,$username,$table,$auto) {                   //����id����������mysql������auto�ֶ�
$prove = "$uid:$username:$table:$auto";
$ifHas = mysql_query("select uid from pw_members where uid = '$_COOKIE[yhid]' and share like '%$prove%'");
if(!mysql_fetch_array($ifHas)) {
$oldshare = mysql_query("select share from pw_members where uid='$_COOKIE[yhid]'");
$fetch = mysql_fetch_array($oldshare);
$arrshu = split('[%]',$fetch[share]);
$shu = count($arrshu);
$shu--;
$alter = $fetch[share].$prove."%";
mysql_query("update pw_members set share='$alter' where uid='$_COOKIE[yhid]'");
$shareindex = $shu;
$auto = $_COOKIE[yhid].":".$shareindex;                    //Ϊ�˷���split()�������������飬index��0��ʼ����$shu--���
self_setaction($table,$auto,"share",0);
}
else {
echo "<script language=javascript>alert('���Ѿ������ⲿ��Ʒ��');</script>";
}
}


function self_dropSameElements($input,$ifrsort) {
if($ifrsort == T) {
rsort($input);                   //�Ӵ�С�ţ�����$return����Ҳ�ǴӴ�С
} else {
sort($input);                    //��С�����ţ�����$return����Ҳ�Ǵ�С����
}
$l = 0;
foreach($input as $in => $v) {
if($in != 0){
$inj = $in - 1;
if($v != $input[$inj]) {
$return[$l] = $v;
$l++;
}
} else {
$return[$l] = $v;
$l++;
}
}
return $return;
}


function self_dropEmptyElements($mayHasEmpty) {
$i = 0;
foreach($mayHasEmpty as $v) {
if($v != "") {
$return[$i] = $v;
$i++;
}
}
return $return;
}


function self_searcharray($search,$bm) {   //bmΪ���룬һ��Ϊgbk
$wholearray = split('[ ]',$search);
foreach($wholearray as $v) {
$whole .= $v;                         //�������ȼ�Ϊ1��$whole
}
$class2array = $wholearray;           //�������ȼ�Ϊ2��class2array
$d = "��";
$k = " ";
$class3 = str_replace($d,$k,$whole);
$class3array = split('[ ]',$class3);    //�������ȼ�Ϊ3��class3array
$key[0] = $whole;                       //����$searcharray��ά���飬����Ԫ�ص�[1]�����������ȼ�
$key[1] = 1;                            //$whole�����ȼ�Ϊ1
$searcharray[0] = $key;
$i = 1;
foreach($class2array as $v) {
$key[0] = $v;
$key[1] = 2;
$searcharray[$i] = $key;
$i++;
}
foreach($class3array as $v) {
$key[0] = $v;
$key[1] = 3;
$searcharray[$i] = $key;
$i++;
}
$len = self_StringLen($whole);
if($len > 3) {                          //�����ȴ���3ʱ�������ȼ�Ϊ4��class4array
foreach($class3array as $v) {
$wd .= $v;
}
for($i = 0; $i < $len - 1; $i++) {   //abcd
$class4array[$i] = mb_substr($wd,$i,2,$bm);
}
foreach($class4array as $v) {
$key[0] = $v;
$key[1] = 4;
$searcharray[$i] = $key;
$i++;
}
}
$searcharray = self_dropSameEmpty($searcharray,F,0);
$j[1] = $j[2] = $j[3] = $j[4] = 0;
foreach($searcharray as $v) {
$keywords[$v[1]][$j[$v[1]]] = $v[0];
$j[$v[1]]++;
}
$ip = $_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT'];
if($_COOKIE[yhm]) {                           //������������
$name = $_COOKIE[yhm];
$uid = $_COOKIE[yhid];
} else {
$name = $ip;
$uid = 0;
}
foreach($keywords as $in => $vd) {
$k .= "$in:";
foreach($vd as $v) {
$k .= "$v,";
}
$k .=";";
}
mysql_query("insert into xs_hotwords (uid,name,ip,keywords) values ('$uid','$name','$ip','$k')");
return $keywords;
}


function self_getsearch($search,$searchtype,$least,$limit) {            //δ���
function self_getLongQue($keyarray,$ifzp,$least2,$shen) {                //Ҫͨ��һ��$_GET������֪ԭ�����������Ѿ�����˼���������$least
if($ifzp == T) {
$q = "select * from xssx where ";                                       //����$whole����������ַ�������ҳ������Ķ�ͨ��$_GET�����������
$end = count($keyarray);
for($k = 0;$k < $end;$k++) {                                            //��ҳ����count(*)����������limit������
$q .= "fq='$keyarray[$k]' or description like '%$keyarray[$k]%' or tags like '%$keyarray[$k]%' ";
if($k < $end - 1) {
$q .= "or ";
}
}
$q .= "order by sid desc limit $least2,$shen";
} else {
$q = "select uid,icon,username,description,tags,money from pw_members where ";
$end = count($keyarray);
for($k = 0;$k < $end;$k++) {
$q .= "description like '%$keyarray[$k]%' or tags like '%$keyarray[$k]%' ";
if($k < $end - 1) {
$q .= "or ";
}
}
$q .= "order by money desc limit $least2,$shen";
}
$que = mysql_query($q);
return $que;
}
$keywords = self_searcharray($search,gbk);
$whole = $keywords[1][0];                                               //���ȼ�Ϊ1
if($searchtype == all or $searchtype == zp) {
$zp = T;
$q = "select * from xssx where fq='$whole' or description like '%$whole%' or tags like '%$whole%' order by sid desc limit $least,$limit";
$que = mysql_query($q);
$i = 0;
while($fetch = mysql_fetch_array($que)) {
$sid[$i] = $fetch[sid];
$fm[$i] = $fetch[fm];
$id[$i] = $fetch[id];
$zz[$i] = $fetch[zz];
$xsm1[$i] = $fetch[xsm];
$fq1[$i] = $fetch[fq];
$description1[$i] = $fetch[description];
$tags1[$i] = $fetch[tags];
$i++;               //$iΪ�����м�������
}
if($i < 10 && $keywords[2]) {
$shen = 10 - $i;
$que = self_getLongQue($keywords[2],T,$_GET['two'],$shen);
$two = 0;
while($fetch = mysql_fetch_array($que)) {
$sid[$i] = $fetch[sid];
$fm[$i] = $fetch[fm];
$id[$i] = $fetch[id];
$zz[$i] = $fetch[zz];
$xsm1[$i] = $fetch[xsm];
$fq1[$i] = $fetch[fq];
$description1[$i] = $fetch[description];
$tags1[$i] = $fetch[tags];
$i++;               //$iΪ�����м�������
$two++;
}
} elseif($i < 10 && $keywords[3]) {
$shen = 10 - $i;
$three = 0;
$que = self_getLongQue($keywords[3],T,$_GET['three'],$shen);
while($fetch = mysql_fetch_array($que)) {
$sid[$i] = $fetch[sid];
$fm[$i] = $fetch[fm];
$id[$i] = $fetch[id];
$zz[$i] = $fetch[zz];
$xsm1[$i] = $fetch[xsm];
$fq1[$i] = $fetch[fq];
$description1[$i] = $fetch[description];
$tags1[$i] = $fetch[tags];
$i++;               //$iΪ�����м�������
$three++;
}
} elseif($i < 10 && $keywords[4]) {
$shen = 10 - $i;
$four = 0;
$que = self_getLongQue($keywords[4],T,$_GET['four'],$shen);
while($fetch = mysql_fetch_array($que)) {
$sid[$i] = $fetch[sid];
$fm[$i] = $fetch[fm];
$id[$i] = $fetch[id];
$zz[$i] = $fetch[zz];
$xsm1[$i] = $fetch[xsm];
$fq1[$i] = $fetch[fq];
$description1[$i] = $fetch[description];
$tags1[$i] = $fetch[tags];
$i++;               //$iΪ�����м�������
$four++;
}
}
$zpsl = $i;
}
if($searchtype == all or $searchtype == ren) {
$q = "select uid,icon,username,description,tags,money from pw_members where description like '%$whole%' or tags like '%$whole%' order by money desc limit $least,
$limit";
$i = 0;
$ren = T;
$que = mysql_query($q);
while($fetch = mysql_fetch_array($que)) {
$uid[$i] = $fetch[uid];
$icon[$i] = $fetch[icon];
$username[$i] = $fetch[username];
$description2[$i] = $fetch[description];
$tags2[$i] = $fetch[tags];
$money[$i] = $fetch[money];
$i++;               //$iΪ�����м�������
}
if($i < 10 && $keywords[2]) {
$shen = 10 - $i;
$que = self_getLongQue($keywords[2],"",$_GET['retwo'],$shen);
$retwo = 0;
while($fetch = mysql_fetch_array($que)) {
$uid[$i] = $fetch[uid];
$icon[$i] = $fetch[icon];
$username[$i] = $fetch[username];
$description2[$i] = $fetch[description];
$tags2[$i] = $fetch[tags];
$money[$i] = $fetch[money];
$i++;               //$iΪ�����м�������
$retwo++;
}
} elseif($i < 10 && $keywords[3]) {
$shen = 10 - $i;
$rethree = 0;
$que = self_getLongQue($keywords[3],"",$_GET['rethree'],$shen);
while($fetch = mysql_fetch_array($que)) {
$uid[$i] = $fetch[uid];
$icon[$i] = $fetch[icon];
$username[$i] = $fetch[username];
$description2[$i] = $fetch[description];
$tags2[$i] = $fetch[tags];
$money[$i] = $fetch[money];
$i++;               //$iΪ�����м�������
$rethree++;
}
} elseif($i < 10 && $keywords[4]) {
$shen = 10 - $i;
$refour = 0;
$que = self_getLongQue($keywords[4],"",$_GET['refour'],$shen);
while($fetch = mysql_fetch_array($que)) {
$uid[$i] = $fetch[uid];
$icon[$i] = $fetch[icon];
$username[$i] = $fetch[username];
$description2[$i] = $fetch[description];
$tags2[$i] = $fetch[tags];
$money[$i] = $fetch[money];
$i++;               //$iΪ�����м�������
$refour++;
}
}
}
if($zp == T) {
$j = 0;
if($id) {
foreach($id as $i => $v) {
$queid = mysql_query("select money from pw_members where uid='$v'");
$m = mysql_fetch_array($queid);
$moneyicon[0] = $m[money];
$moneyicon[1] = $i;
$moneyicon[2] = "zp";
$moneyicon[3] = $sid[$i];
$arrange[$j] = $moneyicon;
$j++;
}
$arrange = self_dropSameEmpty($arrange,T,3);
$count1 = count($arrange);
}
}
if($ren == T) {
$h = 0;
if($money) {
foreach($money as $i => $v) {
$moneyicon[0] = $v;
$moneyicon[1] = $i;
$moneyicon[2] = "ren";
$moneyicon[3] = $uid[$i];
$arrange2[$h] = $moneyicon;
$h++;
}
$arrange2 = self_dropSameEmpty($arrange2,T,3);
$count2 = count($arrange2);
for($n = 0;$n < $count2;$n++) {
$arrange[$count1] = $arrange2[$n];
$count1++;
}
}
}
if($arrange) {
rsort($arrange);             //$arrange = self_dropSameEmpty($arrange,T,3);
foreach($arrange as $v) {
if($v[2] == zp) {
$zyswlj = "xsxt.php?s=".$sid[$v[1]];                    //�����Ʒ
$tp = $fm[$v[1]];
$tadeuid = $id[$v[1]];
$name = $zz[$v[1]];
$actiontype = "д��";
$xsm = $xsm1[$v[1]];
$description = $description1[$v[1]];
$tags = split('[,]',$tags1[$v[1]]);
$fq = $fq1[$v[1]];
include('htmparts/global_acreation.htm');
} else {
$tadeuid = $uid[$v[1]];                    //�����
$tp = $icon[$v[1]];
$name = $username[$v[1]];
$description = $description2[$v[1]];
$tags = split('[,]',$tags2[$v[1]]);
$selfhref = "search.php?search=$search&";
include('htmparts/global_auser.htm');
}
}
} else {
echo "<p align=\"center\">δ�鵽���ϵ�������</p>";
}
}


function self_dropSameEmpty($input2d,$ifrsort,$index) {            //�˺��������ά����,$indexΪ�ж��Ƿ�ֵ��ͬ��Ԫ�ص��±ꡣ����self_searcharray()��$indexΪ0
if($ifrsort == T) {
rsort($input2d);                   //�Ӵ�С�ţ�����$return����Ҳ�ǴӴ�С
} else {
sort($input2d);                    //��С�����ţ�����$return����Ҳ�Ǵ�С����
}
$l = 0;
foreach($input2d as $in => $v) {
if($in != 0){
$inj = $in - 1;
if($v[$index] != $input2d[$inj][$index] && $v[$index] != "") {
$return[$l] = $v;
$l++;
}
} elseif($v[$index] != "") {
$return[$l] = $v;
$l++;
}
}
return $return;
}


function self_upload($ifserie,$ifhead,$uploaddir,$maxsize) {     //$ifserieΪTʱ˵���ϴ���ͼƬΪ��Ʒ���ݵ�ϵ��ͼƬ����������Ʒ���������ͷ��ȱ�־�Ե�ΨһͼƬ
if($ifhead == T) {
$front = $_POST['yhm'];
$front = md5($front);
} else {
$front = $_COOKIE[yhid];
}
$md5FileName = $_FILES['userfile']['name'];
if($ifserie == T) {
$finalname = $front.",".self_doubledate().",".mt_rand(1,1000).",".$md5FileName;
} else {
$finalname = $front.",".self_doubledate().",".$md5FileName;
}
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploaddir.$finalname)) {         //$uploaddir�ϴ�ͼƬʱΪͼƬ·��
$return = "images/".$finalname;
return $return;
} else {
echo "<script language=javascript>alert('�ϴ�ʧ�ܣ�ͼƬ����С��".$maxsize."kb');</script>";
return false;
}
}


function self_changescore($uid,$score) {
$que = "update pw_members set money=money+$score where uid=$uid";
mysql_query($que);
}


function self_sharetosina($words,$pic,$ralateuid) {
  include('js/sharetooutside.js');
}


function self_countvisit($page) {
  $stime = self_doubledate();
  $ip = $_SERVER['REMOTE_ADDR'];
  $port = $_SERVER['REMOTE_PORT'];
  mysql_query("insert into xs_countvisit (stime,ip,port,page) values ('$stime','$ip','$port','$page')");
}


function self_landmine($banip,$banaction,$hugefile) {
  $stime = self_doubledate();
  mysql_query("insert into xs_banip (banip,banaction,stime) values ('$banip','$banaction','$stime')");
  if($hugefile != "") {
    header("location: $hugefile");
  }else {
    header("location: http://www.renren.com");
  }
  exit;
}


function self_littlelandmine($hugefile) {
  $ip = $_SERVER['REMOTE_ADDR'];
  $que = mysql_query("select auto from xs_banip where banip = '$ip'");
  if(mysql_fetch_array($que)) {
    if($hugefile != "") {
      header("location: $hugefile");
    }else {
      header("location: http://www.renren.com");
    }
    exit;
  }
}


function self_sharepage($sharepage,$towhere,$yid) {
  if($towhere == renren) {
    echo "<input type=\"image\" name=\"����������\" src=\"images/button_sharetorenren.jpg\" onclick=\"setCookie()\"></input>";
  }
}


function self_numbertoword($number,$prereturn) {
  $wordarray = array("a","b","c","d","e","f","g","h","i","j");
  while($number > 0) {
    $yushu = $number%10;
    $return = $wordarray[$yushu].$return;
    $number = $number/10;
    $number = (int)$number;
  }
  $return = $prereturn.$return;
  return $return;
}

function sendEmail($mailAddress, $password, $smtpSever, $to, $from, $title, $content) {
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
  echo "enter<p>";
  $fp = fsockopen ( $this->smtp, 26, $errno, $errstr, 60); 
  if (!$fp ) {
    echo "connecting server failed<p>";
	return "���ӷ�����ʧ��";
  }
  set_socket_blocking($fp, true ); 
  
  $lastmessage=fgets($fp,512);
  if ( substr($lastmessage,0,3) != 220 ) {
    echo "1<p>";
    return "������Ϣ1:$lastmessage".__LINE__; 
  }
  
  //HELO
  $yourname = "YOURNAME";
  if($this->check == "1") $lastact="EHLO ".$yourname."\r\n";
  else $lastact="HELO ".$yourname."\r\n";
  
  fputs($fp, $lastact);
  $lastmessage == fgets($fp,512);
  if (substr($lastmessage,0,3) != 220 ) { 
    echo "2<p>";
    return "������Ϣ2:$lastmessage".__LINE__; 
  }
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
   if (substr($lastmessage,0,3) != 334) {
     echo "3<br>";
	 echo substr($lastmessage,0,3);
     return "������Ϣ3:$lastmessage".__LINE__; 
	}
   //�û�����
   $lastact=base64_encode($this->username)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) {
     echo "4";
     return "������Ϣ4:$lastmessage".__LINE__;
   }
   //�û�����
   $lastact=base64_encode($this->password)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != "235") {
     echo "5";
     return "������Ϣ5:$lastmessage".__LINE__;
   }
  }
  
  //FROM:
  $lastact="MAIL FROM: <". $this->s_from . ">\r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) {
    echo "6";
    return "������Ϣ6:$lastmessage".__LINE__;
  }
  
  //TO:
  $lastact="RCPT TO: <". $to ."> \r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) {
    echo "7";
    return "������Ϣ7:$lastmessage".__LINE__;
  }
   
  //DATA
  $lastact="DATA\r\n";
  fputs($fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 354) {
    echo "8";
    return "������Ϣ8:$lastmessage".__LINE__;
  }
  
   
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

	$sm = new smail( $mailAddress, $password, $smtpSever );
	$end = $sm->send( $to, $from, $title, $content );      //end processing may be changed
	if( $end ) echo "<script language=\"javascript\">alert(\"$end\")</script>";
	else echo "<script language=\"javascript\">alert(\"$end\")</script>";
}

function self_forbidIllegalVisit($variable) {
	$get = array_key_exists($variable, $_GET);
	$post = array_key_exists($variable, $_POST);
	$cookie = array_key_exists($variable, $_COOKIE);
	if(!$get && !$post && !$cookie) {
		echo "forbidden";
		exit;
	}
}

function login_setCookie($username,$uid,$email,$password) {    //you should add cookie of firends, and polling states here
	setcookie("username",$username,time()+2592000);
	setcookie("uid",$uid,time()+2592000);
	setcookie("email",$email,time()+2592000);
	setcookie("password",$password,time()+2592000);
}

//pre: mysql database is linked
//post: set the action
function setAction($uid,$action) {
	mysql_query("insert into useracativity (uid,activity) values ('$uid','$action')");
}
?>