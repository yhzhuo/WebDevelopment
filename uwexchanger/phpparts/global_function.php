<?php
function windtohtm($message) {                        //转换windcode
	$searcharray = array('[u]','[/u]','[b]','[/b]','[i]','[/i]','[list]','[li]','[/li]','[/list]','[sub]', '[/sub]','[sup]','[/sup]','[strike]','[/strike]','[blockquote]','[/blockquote]','[hr]','[/backcolor]', '[/color]','[/font]','[/size]','[/align]'
	);
	$replacearray = array('<u>','</u>','<b>','</b>','<i>','</i>','<ul style="margin:0 0 0 15px">','<li>', '</li>','</ul>','<sub>','</sub>','<sup>','</sup>','<strike>','</strike>','<blockquote>','</blockquote>', '<hr />','</span>','</span>','</font>','</font>','</div>'
	);
	$message = str_replace($searcharray,$replacearray,$message);              //翻译颜色字体成功

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
	$message = preg_replace($searcharray,$replacearray,$message);                                    //翻译具体的颜色等属性成功

        $searcharray = array("[size","[quote]","[/quote]","[table","[/table]","[tr]","[/tr]","[td]","[/td]","[code]","[/code]","[s:","[url=http://","[/url]","[img]http://","/[/img]");
        $replacearray = array("<font size","<blockquote class=\"blockquote3\"><div class=\"quote\">引用 </div><div class=\"text\"> <br />","<br /></div></blockquote><br />","<table border=1 style=border-collapse:collapse bordercolor=#ABC8D0 width","</table>","<tr>","</tr>","<td height=20 bordercolor=#D4EFF7 bgcolor=#F8FCFE>","</td>","<div class=\"f12\">代码</div><div class=\"blockquote2\"><ol><li>","</li></ol></div>","<img src=images/post/smile/default/","<a href=http://","</a>","<img src=http://",">");
        $message = str_replace($searcharray,$replacearray,$message);
                              //<font size=5>色环</font>
        
$message = str_replace("]",">",$message);
return $message;
}


function self_tz($a) {                  //跳转
$url = $a;
include('htmparts/global_tz.txt');
}


function xs_daohang() {                    //小说系统的顶部导航
$n = func_num_args();
$op = func_get_args();
$total = "/";
for($i = 0;$i < $n;$i++) {
$total = $total.$op[$i];
}
include('htmparts/global_xsdh.txt');
}


function self_StringLen($str) {                   //检查此名字是否为有效名字
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
function self_linkmysql() {                                               //未完成
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
     mysql_query($que);                    //前期准备
}
*/

function self_linkmysql() {                                               //未完成
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
     mysql_query($que);                    //前期准备
}


function syphp($uid,$score) {
$que = "update test set A_id=A_id+$score where auto=$uid";
mysql_query($que);
echo $que;
}


function self_findValidName($formalName) {                   //找到合适的未被占用的用户名（使用前必须保证程序已经连接mysql数据库）
$i = 0;
$c = 0;
while($c < 3 && $i < 10) {
if($i == 0) {
	$option = $formalName."90hd";
}
elseif ($i == 1) {
    $option = $formalName."牛B";
}
elseif ($i == 2) {
	$option = $formalName."给力";
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


function self_becomefans($date,$zid,$zz) {                                        //成为粉丝（未测验）
if($_COOKIE[yhm]) {
$queg = mysql_query("select * from xs_fs where uid='$_COOKIE[yhid]' and zid='$zid'");
if(!mysql_fetch_array($queg)) {
     mysql_query("insert into xs_fs (rdrqs,uid,un,zid,zz) values ('$date','$_COOKIE[yhid]','$_COOKIE[yhm]','$zid','$zz')");
$c = mysql_insert_id();
self_setaction("xs_fs",$c,"befans",0);
}
else {
echo "<script language=javascript>alert('我已经关注TA了');</script>";
}
} else {
echo "<script language=javascript>alert('请先登录或注册');</script>";
}
}


function self_love($uid,$username,$table,$auto) {                   //作者id：作者名：mysql表：表中auto字段
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
$auto = $_COOKIE[yhid].":".$loveindex;                    //为了方便split()函数产生的数组，index从0开始
self_setaction($table,$auto,"love",0);
}
else {
echo "<script language=javascript>alert('我已经喜欢这部作品了');</script>";
}
}


function self_changepage() {              //必须连接mysql；参数：$tablename（表名）,$rownum（每页记录数）,$webpage（除page外所有参数的网址）
function arrangepage($ii,$recent,$web) {       //输出中间导航
if($ii != $recent) {
echo "<a href=\"$web&page=$ii\">$ii </a>";
}
else {
echo "[$ii]";
}
}
$n = func_num_args();
$op = func_get_args();
if($n == 3) {                                       //直接输入count,共三个参数($totalrow,$rownum,$webpage)
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
if($_GET['page']) {                        //获取当前页码
$recentpage = $_GET['page'];
}
else {
$recentpage = 1;
}
if($recentpage != 1) {                          //直接翻到上一页
$prepage = $recentpage - 1;
echo "<a href=\"$webpage&page=$prepage\">《上一页 </a>";     //？网址输出和函数中输入网址有待测试
}
if($pagenum <= 11) {                             //中间的数字
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
if($recentpage != $pagenum) {                          //直接翻到下一页
$postpage = $recentpage + 1;
echo "<a href=\"$webpage&page=$postpage\">下一页》 </a>";     //？网址输出和函数中输入网址有待测试
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


function self_doubledate() {                                            //产生double类型的日期值
     ini_set("date.timezone","Asia/Shanghai");
$date = (double)date('ymdHis');
return $date;
}


function self_setaction($formname,$auto,$type,$yinsi) {        //目前对于like、share的action，使用auto_increment:字段中具体位置的方式来表达action的方位
if($_COOKIE[yhm]) {
$query = mysql_query("select money from pw_members where uid='$_COOKIE[yhid]'");          //$formname,$auto为被作用物体所在的表名和其auto字段值，$type为行为类型
$fetch = mysql_fetch_array($query);
$money = $fetch[money];
$action = "$formname,$auto,$type";
$date = self_doubledate();
mysql_query("insert into xs_action (name,action,stime,uid,yinsi,money) values ('$_COOKIE[yhm]','$action','$date','$_COOKIE[yhid]','$yinsi','$money')");
}
}


function self_getaction() {          //当要完整输入时第二个参数统一为T
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


function self_listactions($action) {               //未完成
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
$p[$j] = array_keys($money,$v);         //找出money2中每个元素在money中的指针，在money中的位置就代表了它所对应的外层数组的指针
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
$actiontype = "更新了";
} elseif($type == write) {
$actiontype = "开始写";
} elseif($type == read) {
$actiontype = "看了";
} elseif($type == share) {
$actiontype = "分享了";
} elseif($type == pl) {
$actiontype = "评论了";
} else {
$actiontype = "喜欢";
}
if($type == edit or $type == share) {                            //xsnr本位，点进去后直接是页码
$query3 = mysql_query("select sid,ym,xsm,description,nr from xsnr where ymid='$auto'");
$fetch3 = mysql_fetch_array($query3);
$zyswlj = "xsxt.php?s=$fetch3[sid]&y=$fetch3[ym]";                                        //$zyswlj:作用事物链接
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
$description = "无";
}
}
$quetag = mysql_query("select tags,fq from xssx where sid='$fetch3[sid]'");
$fetchtag = mysql_fetch_array($quetag);
$tags = split('[,]',$fetchtag[tags]);
$fq = $fetchtag[fq];
} elseif($type == pl) {                             //xspl本位
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
} else {                                                          //xssx本位
$query5 = mysql_query("select sid,description,xsm,tags,fq from xssx where sid='$auto'");
$fetch5 = mysql_fetch_array($query5);
$zyswlj = "xsxt.php?s=$fetch5[sid]";
$xsm = $fetch5[xsm];
if($fetch5[description] != "") {
$description = $fetch5[description];
} else {
$description = "无";
}
$fetchtag = mysql_fetch_array($query5);
$tags = split('[,]',$fetchtag[tags]);
$fq = $fetchtag[fq];
}
include('htmparts/global_acreation.htm');
}
elseif($type == befriend or $type == befans or $type == visit) {                       //成好友成粉丝
$uid1 = $action[$z][uid];
$name1 = $action[$z][name];
if($type == befans) {
$hudonglei = "成为了";
$statue = "粉丝";
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
$hudonglei = "成为了";
$statue = "好友";
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
$hudonglei = "访问了";
$statue = "空间";
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
} else {                               //$uid1为做此行为的人
$que = mysql_query("select username,icon,tags from pw_members where uid=$uid1");
$f = mysql_fetch_array($que);

$que = mysql_query("select username,icon,tags from pw_members where uid=$auto");
$f2 = mysql_fetch_array($que);
$name1 = $f[username];
$hudonglei = "给";
$uid2 = $auto;
$name2 = $f2[username];
$statue = "留了言";
$tp1 = $f[icon];
$tp2 = $f2[icon];
$tags1 = split('[,]',$f[tags]);
$tags2 = split('[,]',$f2[tags]);
}
include('htmparts/global_arelation.htm');
}
elseif(($action[$z][yinsi] != 2 && $_GET['grid'] != $_COOKIE[yhid]) or $_GET['grid'] == $_COOKIE[yhid]) {                                              //微博、留言的输出
if($type == wb) {
$query2 = mysql_query("select icon from pw_members where uid = '$auto'");
$fetch = mysql_fetch_array($query2);
$tp = $fetch[icon];
$actiontype = "写了微博";
$zhuanzai = "";                                  //转载微博，用share
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
$actiontype = "给"."<a href=yhgl.php?grid=$f[receiveid]>"."$f3[username]"."</a>"."留了言";
$description = $f[liuyan];
$tags = split('[,]',$f2[tags]);
}
include('htmparts/global_awb.htm');
}
}
}


function self_befriend($date,$bid,$bn,$yzxx) {
if($_COOKIE[yhm]) {
$que = mysql_query("select auto,cjby from xs_hy where cid='$_COOKIE[yhid]' and bid='$bid'");   //c要加b但c已经加b
$que2 = mysql_query("select auto,cjby from xs_hy where cid='$bid' and bid='$_COOKIE[yhid]'");  //1、c要加b但b已经发出信号 2、cb已为好友，只是原先是b加c
if($fetch1 = mysql_fetch_array($que)) {
if($fetch1[cjby] == T) {
echo "<script language=javascript>alert('我已经是TA好友了');</script>";
} else {
echo "<script language=javascript>alert('我已经是TA好友了，但TA还没回应');</script>";
}
$diyi = T;
}
if($fetch2 = mysql_fetch_array($que2)) {
if($fetch2[cjby] == T) {
echo "<script language=javascript>alert('我已经是TA好友了');</script>";
} else {
mysql_query("update xs_hy set cjby='T',bjcy='T' where auto='$fetch2[auto]'");
self_setaction("xs_hy",$fetch2[auto],"befriend",0);                                   //yhgl_jhy模块也要有
}
$dier = T;
}
if($diyi != T && $dier != T) {
     mysql_query("insert into xs_hy (hyrqs,cid,cn,bid,bn,cjby,yzxx) values ('$date','$_COOKIE[yhid]','$_COOKIE[yhm]','$bid','$bn','wei','$yzxx')");
}
} else {
echo "<script language=javascript>alert('请先登录或注册');</script>";
}
}


function self_share($uid,$username,$table,$auto) {                   //作者id：作者名：mysql表：表中auto字段
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
$auto = $_COOKIE[yhid].":".$shareindex;                    //为了方便split()函数产生的数组，index从0开始，由$shu--完成
self_setaction($table,$auto,"share",0);
}
else {
echo "<script language=javascript>alert('我已经分享这部作品了');</script>";
}
}


function self_dropSameElements($input,$ifrsort) {
if($ifrsort == T) {
rsort($input);                   //从大到小排，最后的$return数组也是从大到小
} else {
sort($input);                    //从小到大排，最后的$return数组也是从小到大
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


function self_searcharray($search,$bm) {   //bm为编码，一般为gbk
$wholearray = split('[ ]',$search);
foreach($wholearray as $v) {
$whole .= $v;                         //产生优先级为1的$whole
}
$class2array = $wholearray;           //产生优先级为2的class2array
$d = "的";
$k = " ";
$class3 = str_replace($d,$k,$whole);
$class3array = split('[ ]',$class3);    //产生优先级为3的class3array
$key[0] = $whole;                       //产生$searcharray二维数组，其中元素的[1]用于体现优先级
$key[1] = 1;                            //$whole的优先级为1
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
if($len > 3) {                          //当长度大于3时产生优先级为4的class4array
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
if($_COOKIE[yhm]) {                           //插入搜索词条
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


function self_getsearch($search,$searchtype,$least,$limit) {            //未完成
function self_getLongQue($keyarray,$ifzp,$least2,$shen) {                //要通过一个$_GET变量得知原先这个级别的已经输出了几行来决定$least
if($ifzp == T) {
$q = "select * from xssx where ";                                       //除了$whole和少量别的字符正常翻页，其余的都通过$_GET变量决定输出
$end = count($keyarray);
for($k = 0;$k < $end;$k++) {                                            //翻页器的count(*)函数必须有limit的限制
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
$whole = $keywords[1][0];                                               //优先级为1
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$i++;               //$i为几就有几笔数据
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
$zyswlj = "xsxt.php?s=".$sid[$v[1]];                    //输出作品
$tp = $fm[$v[1]];
$tadeuid = $id[$v[1]];
$name = $zz[$v[1]];
$actiontype = "写的";
$xsm = $xsm1[$v[1]];
$description = $description1[$v[1]];
$tags = split('[,]',$tags1[$v[1]]);
$fq = $fq1[$v[1]];
include('htmparts/global_acreation.htm');
} else {
$tadeuid = $uid[$v[1]];                    //输出人
$tp = $icon[$v[1]];
$name = $username[$v[1]];
$description = $description2[$v[1]];
$tags = split('[,]',$tags2[$v[1]]);
$selfhref = "search.php?search=$search&";
include('htmparts/global_auser.htm');
}
}
} else {
echo "<p align=\"center\">未查到符合的搜索项</p>";
}
}


function self_dropSameEmpty($input2d,$ifrsort,$index) {            //此函数处理二维数组,$index为判断是否值相同的元素的下标。对于self_searcharray()，$index为0
if($ifrsort == T) {
rsort($input2d);                   //从大到小排，最后的$return数组也是从大到小
} else {
sort($input2d);                    //从小到大排，最后的$return数组也是从小到大
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


function self_upload($ifserie,$ifhead,$uploaddir,$maxsize) {     //$ifserie为T时说明上传到图片为作品内容等系列图片，而不是作品封面或人物头像等标志性的唯一图片
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
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploaddir.$finalname)) {         //$uploaddir上传图片时为图片路径
$return = "images/".$finalname;
return $return;
} else {
echo "<script language=javascript>alert('上传失败，图片必须小于".$maxsize."kb');</script>";
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
    echo "<input type=\"image\" name=\"分享至人人\" src=\"images/button_sharetorenren.jpg\" onclick=\"setCookie()\"></input>";
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
 //您的SMTP 服务器供应商，可以是域名或IP地址
 var $smtp = ""; 
 //SMTP需要要身份验证设值为 1 不需要身份验证值为 0，现在大多数的SMTP服务商都要验证，如不清楚请与你的smtp 服务商联系。
 var $check = 1;
 //您的email帐号名称
 var $username = "";
 //您的email密码
 var $password = "";
 //此email 必需是发信服务器上的email
 var $s_from = "";
 
 /* 
  * 功能：发信初始化设置
  * $from      你的发信服务器上的邮箱
  * $password  你的邮箱密码
  * $smtp      您的SMTP 服务器供应商，可以是域名或IP地址
  * $check     SMTP需要要身份验证设值为 1 不需要身份验证值为 0，现在大多数的SMTP服务商都要验证
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
  * 功能：发送邮件
  * $to   目标邮箱
  * $from 来源邮箱
  * $subject 邮件标题
  * $message 邮件内容
  */
 function send ( $to, $from, $subject, $message ) { 
 
  //连接服务器 
  echo "enter<p>";
  $fp = fsockopen ( $this->smtp, 26, $errno, $errstr, 60); 
  if (!$fp ) {
    echo "connecting server failed<p>";
	return "联接服务器失败";
  }
  set_socket_blocking($fp, true ); 
  
  $lastmessage=fgets($fp,512);
  if ( substr($lastmessage,0,3) != 220 ) {
    echo "1<p>";
    return "错误信息1:$lastmessage".__LINE__; 
  }
  
  //HELO
  $yourname = "YOURNAME";
  if($this->check == "1") $lastact="EHLO ".$yourname."\r\n";
  else $lastact="HELO ".$yourname."\r\n";
  
  fputs($fp, $lastact);
  $lastmessage == fgets($fp,512);
  if (substr($lastmessage,0,3) != 220 ) { 
    echo "2<p>";
    return "错误信息2:$lastmessage".__LINE__; 
  }
  while (true) {
   $lastmessage = fgets($fp,512);
   if ( (substr($lastmessage,3,1) != "-")  or  (empty($lastmessage)) )
    break;
  } 
    
  //身份验证
  if ($this->check=="1") {
   //验证开始
   $lastact="AUTH LOGIN"."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) {
     echo "3<br>";
	 echo substr($lastmessage,0,3);
     return "错误信息3:$lastmessage".__LINE__; 
	}
   //用户姓名
   $lastact=base64_encode($this->username)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) {
     echo "4";
     return "错误信息4:$lastmessage".__LINE__;
   }
   //用户密码
   $lastact=base64_encode($this->password)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != "235") {
     echo "5";
     return "错误信息5:$lastmessage".__LINE__;
   }
  }
  
  //FROM:
  $lastact="MAIL FROM: <". $this->s_from . ">\r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) {
    echo "6";
    return "错误信息6:$lastmessage".__LINE__;
  }
  
  //TO:
  $lastact="RCPT TO: <". $to ."> \r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) {
    echo "7";
    return "错误信息7:$lastmessage".__LINE__;
  }
   
  //DATA
  $lastact="DATA\r\n";
  fputs($fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 354) {
    echo "8";
    return "错误信息8:$lastmessage".__LINE__;
  }
  
   
  //处理Subject头
  $head="Subject: $subject\r\n"; 
  $message = $head."\r\n".$message; 
   
  
  //处理From头 
  $head="From: $from\r\n"; 
  $message = $head.$message; 
   
  //处理To头 
  $head="To: $to\r\n";
  $message = $head.$message;
   
  
  //加上结束串 
  $message .= "\r\n.\r\n";
  
  //发送信息 
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