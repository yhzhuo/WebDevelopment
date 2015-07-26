<?php
//team_member.php
	
	function login() {
		echo '
		<table style="width: 100%; height: 100%;">
			<tr>
				<td style="width: 100%; height: 100%; vertical-align: middle; text-align: center; font-size:100px;" >
					<form action="team_member.php" method="post" style="margin-left:auto; margin-right:auto;">
						<p>member name: <input type="text" name="name" /></p>
						<p>password: <input type="password" name="password" /></p>
						<p><input type="submit" value="login" style="width:120px;" /></p>
					</form>
				</td>
			</tr>
		</table>
		';
	}
	
	function realDo($id, $name) {
		$processing_mid = $id;
		$processing_name = $name;
		include_once('team_member/processing.php');
		include_once('team_member/show.htm');
	}
	
	require_once('global.php');
	//self_linkmysql();
	if(array_key_exists('name',$_POST)) {     //has login input   @$_POST['name']; $_POST['password'];
		self_linkmysql();
		$name = $_POST['name'];
		$password = $_POST['password'];
		$password = md5($password);
		$q = mysql_query("select * from team_member_info where name = '$name'");
		if(!$q) {
			echo "<script language='javascript'>alert('Failed to connect to the server');</script>";
			login();
		} else {
			$f = mysql_fetch_array($q);
			if($f[password] != $password) {
				echo "<script language='javascript'>alert('Your username or password is wrong');</script>";
				login();
			} else {
				realDo($f['id'], $f['name']);
			}
		}
	} else {
		login();
	}
?>